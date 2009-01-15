#!/usr/bin/perl
#
# AST_CRON_audio_3_ftp.pl
#
# This is a STEP-3 program in the audio archival process
#
# runs every 3 minutes and copies the recording files to an FTP server
# 
# put an entry into the cron of of your asterisk machine to run this script 
# every 3 minutes or however often you desire
#
# ### recording mixing/compressing/ftping scripts
##0,3,6,9,12,15,18,21,24,27,30,33,36,39,42,45,48,51,54,57 * * * * /usr/share/astguiclient/AST_CRON_audio_1_move_mix.pl
# 0,3,6,9,12,15,18,21,24,27,30,33,36,39,42,45,48,51,54,57 * * * * /usr/share/astguiclient/AST_CRON_audio_1_move_VDonly.pl
# 1,4,7,10,13,16,19,22,25,28,31,34,37,40,43,46,49,52,55,58 * * * * /usr/share/astguiclient/AST_CRON_audio_2_compress.pl --GSM
# 2,5,8,11,14,17,20,23,26,29,32,35,38,41,44,47,50,53,56,59 * * * * /usr/share/astguiclient/AST_CRON_audio_3_ftp.pl --GSM
#
# FLAGS FOR COMPRESSION FILES TO TRANSFER
# --GSM = GSM 6.10 files
# --MP3 = MPEG Layer3 files
# --OGG = OGG Vorbis files
# --WAV = WAV files
#
# FLAG FOR NO DATE DIRECTORY ON FTP
# --NODATEDIR
#
# if pinging is not working, try the 'icmp' Ping command in the code instead
# 
# make sure that the following directories exist:
# /var/spool/asterisk/monitorDONE	# where the mixed -all files are put
# 
# This program assumes that recordings are saved by Asterisk as .wav
# 
# Copyright (C) 2008  Matt Florell <vicidial@gmail.com>    LICENSE: AGPLv2
#
# 
# 80302-1958 - First Build
# 80317-2349 - Added FTP debug if debugX
# 80731-2253 - Changed size comparisons for more efficiency
#

$GSM=0;   $MP3=0;   $OGG=0;   $WAV=0;   $NODATEDIR=0;

# Default variables for FTP
$VARFTP_host = '10.0.0.4';
$VARFTP_user = 'cron';
$VARFTP_pass = 'test';
$VARFTP_port = '21';
$VARFTP_dir  = 'RECORDINGS';
$VARHTTP_path = 'http://10.0.0.4';


### begin parsing run-time options ###
if (length($ARGV[0])>1)
{
	$i=0;
	while ($#ARGV >= $i)
	{
	$args = "$args $ARGV[$i]";
	$i++;
	}

	if ($args =~ /--help/i)
	{
	print "allowed run time options:\n  [--debug] = debug\n  [--debugX] = super debug\n  [-t] = test\n  [--GSM] = copy GSM files\n  [--MP3] = copy MPEG-Layer-3 files\n  [--OGG] = copy OGG Vorbis files\n  [--WAV] = copy WAV files\n  [--NODATEDIR] = do not put into dated directories\n\n";
	exit;
	}
	else
	{
		if ($args =~ /--debug/i)
		{
		$DB=1;
		print "\n----- DEBUG -----\n\n";
		}
		if ($args =~ /--debugX/i)
		{
		$DBX=1;
		print "\n----- SUPER DEBUG -----\n\n";
		}
		if ($args =~ /-t/i)
		{
		$T=1;   $TEST=1;
		print "\n----- TESTING -----\n\n";
		}
		if ($args =~ /-nodatedir/i)
		{
		$NODATEDIR=1;
		if ($DB) {print "\n----- NO DATE DIRECTORIES -----\n\n";}
		}
		if ($args =~ /--GSM/i)
		{
		$GSM=1;
		if ($DB) {print "GSM audio files\n";}
		}
		else
		{
			if ($args =~ /--MP3/i)
			{
			$MP3=1;
			if ($DB) {print "MP3 audio files\n";}
			}
			else
			{
				if ($args =~ /--OGG/i)
				{
				$OGG=1;
				if ($DB) {print "OGG audio files\n";}
				}
				else
				{
					if ($args =~ /--WAV/i)
					{
					$WAV=1;
					if ($DB) {print "WAV audio files\n";}
					}
				}
			}
		}
	}
}
else
{
#print "no command line options set\n";
$WAV=1;
}


# default path to astguiclient configuration file:
$PATHconf =		'/etc/astguiclient.conf';

open(conf, "$PATHconf") || die "can't open $PATHconf: $!\n";
@conf = <conf>;
close(conf);
$i=0;
foreach(@conf)
	{
	$line = $conf[$i];
	$line =~ s/ |>|\n|\r|\t|\#.*|;.*//gi;
	if ( ($line =~ /^PATHhome/) && ($CLIhome < 1) )
		{$PATHhome = $line;   $PATHhome =~ s/.*=//gi;}
	if ( ($line =~ /^PATHlogs/) && ($CLIlogs < 1) )
		{$PATHlogs = $line;   $PATHlogs =~ s/.*=//gi;}
	if ( ($line =~ /^PATHagi/) && ($CLIagi < 1) )
		{$PATHagi = $line;   $PATHagi =~ s/.*=//gi;}
	if ( ($line =~ /^PATHweb/) && ($CLIweb < 1) )
		{$PATHweb = $line;   $PATHweb =~ s/.*=//gi;}
	if ( ($line =~ /^PATHsounds/) && ($CLIsounds < 1) )
		{$PATHsounds = $line;   $PATHsounds =~ s/.*=//gi;}
	if ( ($line =~ /^PATHmonitor/) && ($CLImonitor < 1) )
		{$PATHmonitor = $line;   $PATHmonitor =~ s/.*=//gi;}
	if ( ($line =~ /^PATHDONEmonitor/) && ($CLIDONEmonitor < 1) )
		{$PATHDONEmonitor = $line;   $PATHDONEmonitor =~ s/.*=//gi;}
	if ( ($line =~ /^VARserver_ip/) && ($CLIserver_ip < 1) )
		{$VARserver_ip = $line;   $VARserver_ip =~ s/.*=//gi;}
	if ( ($line =~ /^VARDB_server/) && ($CLIDB_server < 1) )
		{$VARDB_server = $line;   $VARDB_server =~ s/.*=//gi;}
	if ( ($line =~ /^VARDB_database/) && ($CLIDB_database < 1) )
		{$VARDB_database = $line;   $VARDB_database =~ s/.*=//gi;}
	if ( ($line =~ /^VARDB_user/) && ($CLIDB_user < 1) )
		{$VARDB_user = $line;   $VARDB_user =~ s/.*=//gi;}
	if ( ($line =~ /^VARDB_pass/) && ($CLIDB_pass < 1) )
		{$VARDB_pass = $line;   $VARDB_pass =~ s/.*=//gi;}
	if ( ($line =~ /^VARDB_port/) && ($CLIDB_port < 1) )
		{$VARDB_port = $line;   $VARDB_port =~ s/.*=//gi;}
	if ( ($line =~ /^VARFTP_host/) && ($CLIFTP_host < 1) )
		{$VARFTP_host = $line;   $VARFTP_host =~ s/.*=//gi;}
	if ( ($line =~ /^VARFTP_user/) && ($CLIFTP_user < 1) )
		{$VARFTP_user = $line;   $VARFTP_user =~ s/.*=//gi;}
	if ( ($line =~ /^VARFTP_pass/) && ($CLIFTP_pass < 1) )
		{$VARFTP_pass = $line;   $VARFTP_pass =~ s/.*=//gi;}
	if ( ($line =~ /^VARFTP_port/) && ($CLIFTP_port < 1) )
		{$VARFTP_port = $line;   $VARFTP_port =~ s/.*=//gi;}
	if ( ($line =~ /^VARFTP_dir/) && ($CLIFTP_dir < 1) )
		{$VARFTP_dir = $line;   $VARFTP_dir =~ s/.*=//gi;}
	if ( ($line =~ /^VARHTTP_path/) && ($CLIHTTP_path < 1) )
		{$VARHTTP_path = $line;   $VARHTTP_path =~ s/.*=//gi;}
	$i++;
	}

# Customized Variables
$server_ip = $VARserver_ip;		# Asterisk server IP
if (!$VARDB_port) {$VARDB_port='3306';}

use Time::HiRes ('gettimeofday','usleep','sleep');  # necessary to have perl sleep command of less than one second
use DBI;

$dbhA = DBI->connect("DBI:mysql:$VARDB_database:$VARDB_server:$VARDB_port", "$VARDB_user", "$VARDB_pass")
 or die "Couldn't connect to database: " . DBI->errstr;

use Net::Ping;
use Net::FTP;

### directory where -all recordings are
if ($WAV > 0) {$dir2 = "$PATHDONEmonitor";}
if ($MP3 > 0) {$dir2 = "$PATHDONEmonitor/MP3";}
if ($GSM > 0) {$dir2 = "$PATHDONEmonitor/GSM";}
if ($OGG > 0) {$dir2 = "$PATHDONEmonitor/OGG";}

opendir(FILE, "$dir2/");
@FILES = readdir(FILE);

### Loop through files first to gather filesizes
$i=0;
foreach(@FILES)
   {
	$FILEsize1[$i] = 0;
	if ( (length($FILES[$i]) > 4) && (!-d "$dir1/$FILES[$i]") )
		{
		$FILEsize1[$i] = (-s "$dir1/$FILES[$i]");
		if ($DBX) {print "$FILES[$i] $FILEsize1[$i]\n";}
		}
	$i++;
   }

sleep(5);


### Loop through files a second time to gather filesizes again 5 seconds later
$i=0;
foreach(@FILES)
   {
	$FILEsize2[$i] = 0;

	if ( (length($FILES[$i]) > 4) && (!-d "$dir1/$FILES[$i]") )
		{

		$FILEsize2[$i] = (-s "$dir1/$FILES[$i]");
		if ($DBX) {print "$FILES[$i] $FILEsize2[$i]\n\n";}

		if ( ($FILES[$i] !~ /out\.|in\.|lost\+found/i) && ($FILEsize1[$i] eq $FILEsize2[$i]) && (length($FILES[$i]) > 4))
			{
			$recording_id='';
			$ALLfile = $FILES[$i];
			$SQLFILE = $FILES[$i];
			$SQLFILE =~ s/-all\.wav|-all\.gsm|-all\.ogg|-all\.mp3//gi;

			$stmtA = "select recording_id,start_time from recording_log where filename='$SQLFILE' order by recording_id desc LIMIT 1;";
			if($DBX){print STDERR "\n|$stmtA|\n";}
			$sthA = $dbhA->prepare($stmtA) or die "preparing: ",$dbhA->errstr;
			$sthA->execute or die "executing: $stmtA ", $dbhA->errstr;
			$sthArows=$sthA->rows;
			if ($sthArows > 0)
				{
				@aryA = $sthA->fetchrow_array;
				$recording_id =	"$aryA[0]";
				$start_date =	"$aryA[1]";
				$start_date =~ s/ .*//gi;
				}
			$sthA->finish();


			if ($DB) {print "|$recording_id|$start_date|$ALLfile|     |$SQLfile|\n";}

	### BEGIN Remote file transfer
			$p = Net::Ping->new();
	#		$p = Net::Ping->new("icmp");
			$ping_good = $p->ping("$VARFTP_host");

			if ($ping_good)
				{
				$start_date_PATH='';
				$FTPdb=0;
				if ($DBX>0) {$FTPdb=1;}
				$ftp = Net::FTP->new("$VARFTP_host", Port => $VARFTP_port, Debug => $FTPdb);
				$ftp->login("$VARFTP_user","$VARFTP_pass");
				$ftp->cwd("$VARFTP_dir");
				if ($NODATEDIR < 1)
					{
					$ftp->mkdir("$start_date");
					$ftp->cwd("$start_date");
					$start_date_PATH = "$start_date/";
					}
				$ftp->binary();
				$ftp->put("$dir2/$ALLfile", "$ALLfile");
				$ftp->quit;

				$stmtA = "UPDATE recording_log set location='$VARHTTP_path/$start_date_PATH$ALLfile' where recording_id='$recording_id';";
					if($DB){print STDERR "\n|$stmtA|\n";}
				$affected_rows = $dbhA->do($stmtA); #  or die  "Couldn't execute query:|$stmtA|\n";

				if (!$T)
					{
					`mv -f "$dir2/$ALLfile" "$PATHDONEmonitor/FTP/$ALLfile"`;
					}
				}
	### END Remote file transfer

			### sleep for twenty hundredths of a second to not flood the server with disk activity
			usleep(1*200*1000);

			}
		}
	$i++;
	}

if ($DB) {print "DONE... EXITING\n\n";}

$dbhA->disconnect();


exit;
