#!/usr/bin/perl
#
# AST_CRON_mix_recordings_VDonly_DATE.pl
#
# IMPORTANT!!! ONLY TO BE USED WHEN ONLY VICIDIAL RECORDINGS ARE ON THE SYSTEM!
#
# runs every 5 minutes and copies the -in recordings in the monitor to a dated
# directory on an FTP server. Creates the FTP directory if it does not exist.
# 
# put an entry into the cron of of your asterisk machine to run this script 
# every 5 minutes or however often you desire
#
# make sure that the following directories exist:
# /var/spool/asterisk/monitor		# default Asterisk recording directory
# /var/spool/asterisk/monitor/ORIG	# where the original in/out files are put
# 
# This program assumes that recordings are saved as .wav
# should be easy to change this code if you use .gsm instead
# 
# This program also sends the ALL combined file to an FTP server for archival
# purposes, you can comment out the Net::Ping and Net::FTP lines as well as the
# file transfer section of the code to deactivate remote copying of the
# recording files
#
# Copyright (C) 2007  Matt Florell <vicidial@gmail.com>    LICENSE: GPLv2
#
# 
# 51021-1058 - Added quotes around CLI executed commands
# 51122-1458 - Added soxmix binary path check
# 60318-0921 - Added ability to mix gsm audio files
# 60807-1308 - Modified to use /etc/astguiclient.conf for settings 
# 70702-1139 - Removed mixing, and added dated folder storage on FTP server 
#

# Customize variables for FTP
$FTP_host = '10.0.0.4';
$FTP_user = 'cron';
$FTP_pass = 'test';
$FTP_dir  = 'RECORDINGS';
$HTTP_path = 'http://10.0.0.4';


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
	$i++;
	}

# Customized Variables
$server_ip = $VARserver_ip;		# Asterisk server IP
if (!$VARDB_port) {$VARDB_port='3306';}

use DBI;	  

$dbhA = DBI->connect("DBI:mysql:$VARDB_database:$VARDB_server:$VARDB_port", "$VARDB_user", "$VARDB_pass")
 or die "Couldn't connect to database: " . DBI->errstr;


### directory where in/out recordings are saved to by Asterisk
$dir1 = "$PATHmonitor";

use Net::Ping;
use Net::FTP;

 opendir(FILE, "$dir1/");
 @FILES = readdir(FILE);

$i=0;
foreach(@FILES)
   {
	$size1 = 0;
	$size2 = 0;

	if ( (length($FILES[$i]) > 4) && (!-d $FILES[$i]) )
		{

		$size1 = (-s "$dir1/$FILES[$i]");
		if ($v) {print "$FILES[$i] $size1\n";}
		sleep(1);
		$size2 = (-s "$dir1/$FILES[$i]");
		if ($v) {print "$FILES[$i] $size2\n\n";}

		if ( ($FILES[$i] !~ /out\.wav|out\.gsm/i) && ($size1 eq $size2) && (length($FILES[$i]) > 4))
			{
			$INfile = $FILES[$i];
			$OUTfile = $FILES[$i];
			$OUTfile =~ s/-in\.wav/-out.wav/gi;
			$OUTfile =~ s/-in\.gsm/-out.gsm/gi;
			$ALLfile = $FILES[$i];
			$ALLfile =~ s/-in\.wav/-all.wav/gi;
			$ALLfile =~ s/-in\.gsm/-all.gsm/gi;
			$SQLFILE = $FILES[$i];
			$SQLFILE =~ s/-in\.wav|-in\.gsm//gi;

			$stmtA = "select recording_id,start_time from recording_log where filename='$SQLFILE' order by recording_id desc LIMIT 1;";
			if($DBX){print STDERR "\n|$stmtA|\n";}
			$sthA = $dbhA->prepare($stmtA) or die "preparing: ",$dbhA->errstr;
			$sthA->execute or die "executing: $stmtA ", $dbhA->errstr;
			$sthArows=$sthA->rows;
			$rec_count=0;
			while ($sthArows > $rec_count)
				{
				@aryA = $sthA->fetchrow_array;
				$recording_id =	"$aryA[0]";
				$start_date =	"$aryA[1]";
				$start_date =~ s/ .*//gi;
				$rec_count++;
				}
			$sthA->finish();

		if ($v) {print "|$INfile|     |$ALLfile|     |$recording_id|$start_date|\n";}
	### BEGIN Remote file transfer
			$p = Net::Ping->new();
			$ping_good = $p->ping("$FTP_host");

			if ($ping_good)
				{
				$ftp = Net::FTP->new("$FTP_host", Port => 21);
				$ftp->login("$FTP_user","$FTP_pass");
				$ftp->cwd("$FTP_dir");
				$ftp->mkdir("$start_date");
				$ftp->cwd("$start_date");
				$ftp->binary();
				$ftp->put("$dir1/$INfile", "$ALLfile");
				$ftp->quit;
				}
	### END Remote file transfer

			$stmtA = "UPDATE recording_log set location='$HTTP_path/$start_date/$ALLfile' where recording_id='$recording_id';";
				if($DB){print STDERR "\n|$stmtA|\n";}
			$affected_rows = $dbhA->do($stmtA); #  or die  "Couldn't execute query:|$stmtA|\n";

			if (!$T)
				{
				`mv -f "$dir1/$INfile" "$dir1/ORIG/$INfile"`;
				`mv -f "$dir1/$OUTfile" "$dir1/ORIG/$OUTfile"`;
				}

			}
		}
	$i++;
	}

if ($v) {print "DONE... EXITING\n\n";}

$dbhA->disconnect();


exit;
