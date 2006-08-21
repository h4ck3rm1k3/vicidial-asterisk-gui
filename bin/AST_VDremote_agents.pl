#!/usr/bin/perl
#
# AST_VDremote_agents.pl version 0.2   *DBI-version*
#
# DESCRIPTION:
# uses Net::MySQL to keep remote agents logged in to the VICIDIAL system 
#
# SUMMARY:
# This program was designed for people using the Asterisk PBX with VICIDIAL
#
# For the client to use VICIDIAL with remote agents, this must always be running 
# 
# It is recommended that you run this program on the local Asterisk machine
#
# This script is to run perpetually querying every second to update the remote 
# agents that should appear to be logged in so that the calls can be transferred 
# out to them properly.
#
# It is good practice to keep this program running by placing the associated 
# KEEPALIVE script running every minute to ensure this program is always running
#
# Copyright (C) 2006  Matt Florell <vicidial@gmail.com>    LICENSE: GPLv2
#
# changes:
# 50215-0954 - First version of script
# 50810-1615 - Added database server variable definitions lookup
# 60807-1003 - Changed to DBI
#            - changed to use /etc/astguiclient.conf for configs
# 60814-1726 - added option for no logging to file
#

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
	print "allowed run time options:\n  [-t] = test\n  [-v] = verbose debug messages\n  [--delay=XXX] = delay of XXX seconds per loop, default 2 seconds\n\n";
	}
	else
	{
		if ($args =~ /--delay=/i)
		{
		@data_in = split(/--delay=/,$args);
			$loop_delay = $data_in[1];
			print "     LOOP DELAY OVERRIDE!!!!! = $loop_delay seconds\n\n";
			$loop_delay = ($loop_delay * 1000);
		}
		else
		{
		$loop_delay = '2000';
		}
		if ($args =~ /--debug/i)
		{
		$DB=1;
		print "\n-----DEBUGGING -----\n\n";
		}
		if ($args =~ /--debugX/i)
		{
		$DBX=1;
		print "\n----- SUPER-DUPER DEBUGGING -----\n\n";
		}
		if ($args =~ /-t/i)
		{
		$TEST=1;
		$T=1;
		}
	}
}
else
{
print "no command line options set\n";
	$loop_delay = '2000';
}
### end parsing run-time options ###


# constants
$US='__';
$MT[0]='';


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


	&get_time_now;	# update time/date variables

if (!$VDRLOGfile) {$VDRLOGfile = "$PATHlogs/remoteagent.$year-$mon-$mday";}
if (!$VARDB_port) {$VARDB_port='3306';}

use Time::HiRes ('gettimeofday','usleep','sleep');  # necessary to have perl sleep command of less than one second
use DBI;	  

$dbhA = DBI->connect("DBI:mysql:$VARDB_database:$VARDB_server:$VARDB_port", "$VARDB_user", "$VARDB_pass")
 or die "Couldn't connect to database: " . DBI->errstr;

### Grab Server values from the database
	$stmtA = "SELECT vd_server_logs,local_gmt FROM servers where server_ip = '$VARserver_ip';";
	$sthA = $dbhA->prepare($stmtA) or die "preparing: ",$dbhA->errstr;
	$sthA->execute or die "executing: $stmtA ", $dbhA->errstr;
	$sthArows=$sthA->rows;
	$rec_count=0;
	while ($sthArows > $rec_count)
		{
		 @aryA = $sthA->fetchrow_array;
			$DBvd_server_logs =			"$aryA[0]";
			$DBSERVER_GMT		=		"$aryA[1]";
			if ($DBvd_server_logs =~ /Y/)	{$SYSLOG = '1';}
				else {$SYSLOG = '0';}
			if (length($DBSERVER_GMT)>0)	{$SERVER_GMT = $DBSERVER_GMT;}
		 $rec_count++;
		}
	$sthA->finish();


	&get_time_now;	# update time/date variables

	$event_string='PROGRAM STARTED||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||';
	&event_logger;	# writes to the log and if debug flag is set prints to STDOUT


	$event_string='LOGGED INTO MYSQL SERVER ON 1 CONNECTION|';
	&event_logger;

$one_day_interval = 12;		# 1 month loops for one year 
while($one_day_interval > 0)
{

	$endless_loop=5760000;		# 30 days minutes at XXX seconds per loop

	while($endless_loop > 0)
	{
		&get_time_now;

		$VDRLOGfile = "$PATHlogs/remoteagent.$year-$mon-$mday";

		if ($endless_loop =~ /0$|5$/)
		{
		### Grab Server values from the database
			$stmtA = "SELECT vd_server_logs FROM servers where server_ip = '$VARserver_ip';";
			$sthA = $dbhA->prepare($stmtA) or die "preparing: ",$dbhA->errstr;
			$sthA->execute or die "executing: $stmtA ", $dbhA->errstr;
			$sthArows=$sthA->rows;
			$rec_count=0;
			while ($sthArows > $rec_count)
				{
				 @aryA = $sthA->fetchrow_array;
					$DBvd_server_logs =			"$aryA[0]";
					if ($DBvd_server_logs =~ /Y/)	{$SYSLOG = '1';}
						else {$SYSLOG = '0';}
				 $rec_count++;
				}
			$sthA->finish();


		### delete call records that are LIVE for over 10 minutes and last_update_time < '$PDtsSQLdate'
		$stmtA = "DELETE FROM vicidial_live_agents where server_ip='$server_ip' and status IN('PAUSED') and extension LIKE \"R/%\";";
		$affected_rows = $dbhA->do($stmtA);

		$event_string = "|     lagged call vla agent DELETED $affected_rows";
		 &event_logger;


		$stmtA = "UPDATE vicidial_live_agents set status='INCALL', last_call_time='$SQLdate' where server_ip='$server_ip' and status IN('QUEUE') and extension LIKE \"R/%\";";
		$affected_rows = $dbhA->do($stmtA);

		$event_string = "|     QUEUEd call listing vla UPDATEd $affected_rows";
		 &event_logger;

		#@psoutput = `/bin/ps -f --no-headers -A`;
		@psoutput = `/bin/ps -o "%p %a" --no-headers -A`;

		$running_listen = 0;

		$i=0;
		foreach (@psoutput)
		{
			chomp($psoutput[$i]);

		@psline = split(/\/usr\/bin\/perl /,$psoutput[$i]);

		if ($psline[1] =~ /AST_manager_li/) {$running_listen++;}

		$i++;
		}

		if (!$running_listen) 
			{
			$endless_loop=0;
			$one_day_interval=0;
			print "\nPROCESS KILLED NO LISTENER RUNNING... EXITING\n\n";
			}

		if($DB){print "checking to see if listener is dead |$running_listen|\n";}
		}



		$user_counter=0;
		$DELusers='';
		@DBremote_user=@MT;
		@DBremote_server_ip=@MT;
		@DBremote_campaign=@MT;
		@DBremote_conf_exten=@MT;
		@DBremote_closer=@MT;
		@DBremote_random=@MT;
		@loginexistsRANDOM=@MT;
		@loginexistsALL=@MT;
		@VD_user=@MT;
		@VD_extension=@MT;
		@VD_status=@MT;
		@VD_uniqueid=@MT;
		@VD_callerid=@MT;
		@VD_random=@MT;
	###############################################################################
	###### first grab all of the ACTIVE remote agents information from the database
	###############################################################################
		$stmtA = "SELECT * FROM vicidial_remote_agents where status IN('ACTIVE') and server_ip='$server_ip' order by user_start;";
		$sthA = $dbhA->prepare($stmtA) or die "preparing: ",$dbhA->errstr;
		$sthA->execute or die "executing: $stmtA ", $dbhA->errstr;
		$sthArows=$sthA->rows;
		$rec_count=0;
		while ($sthArows > $rec_count)
			{
			@aryA = $sthA->fetchrow_array;
				$user_start =				"$aryA[1]";
				$number_of_lines =			"$aryA[2]";
				$conf_exten =				"$aryA[4]";
				$campaign_id =				"$aryA[6]";
				$closer_campaigns =			"$aryA[7]";

				$y=0;
				while ($y < $number_of_lines)
					{
					$random = int( rand(9999999)) + 10000000;
					$user_id = ($user_start + $y);
					$DBremote_user[$user_counter] =			"$user_id";
					$DBremote_server_ip[$user_counter] =	"$server_ip";
					$DBremote_campaign[$user_counter] =		"$campaign_id";
					$DBremote_conf_exten[$user_counter] =	"$conf_exten";
					$DBremote_closer[$user_counter] =		"$closer_campaigns";
					$DBremote_random[$user_counter] =		"$random";
					
					$y++;
					$user_counter++;
					}
				
			$rec_count++;
			}
		$sthA->finish();
		if ($DB) {print STDERR "$user_counter live remote agents ACTIVE\n";}
   


	###############################################################################
	###### second grab all of the INACTIVE remote agents information from the database
	###############################################################################
		$stmtA = "SELECT * FROM vicidial_remote_agents where status IN('INACTIVE') and server_ip='$server_ip' order by user_start;";
		$sthA = $dbhA->prepare($stmtA) or die "preparing: ",$dbhA->errstr;
		$sthA->execute or die "executing: $stmtA ", $dbhA->errstr;
		$sthArows=$sthA->rows;
		$rec_count=0;
		while ($sthArows > $rec_count)
			{
			@aryA = $sthA->fetchrow_array;
				$Duser_start =				"$aryA[1]";
				$Dnumber_of_lines =			"$aryA[2]";
				$w=0;
				while ($w < $Dnumber_of_lines)
					{
					$Duser_id = ($Duser_start + $w);
					$DELusers .= "R/$Duser_id|";
					$w++;
					}
			$rec_count++;
			}
		$sthA->finish();
#		if ($DBX) {print STDERR "INACTIVE remote agents: |$DELusers|\n";}



	###############################################################################
	###### third traverse array of remote agents to be active and insert or update 
	###### in vicidial_live_agents table 
	###############################################################################
		$h=0;
		foreach(@DBremote_user) 
			{
			if (length($DBremote_user[$h])>1) 
				{
				
				### check to see if the record exists and only needs random number update
				$stmtA = "SELECT count(*) FROM vicidial_live_agents where user='$DBremote_user[$h]' and server_ip='$server_ip' and campaign_id='$DBremote_campaign[$h]' and conf_exten='$DBremote_conf_exten[$h]' and closer_campaigns='$DBremote_closer[$h]';";
				$sthA = $dbhA->prepare($stmtA) or die "preparing: ",$dbhA->errstr;
				$sthA->execute or die "executing: $stmtA ", $dbhA->errstr;
				$sthArows=$sthA->rows;
				$rec_count=0;
				while ($sthArows > $rec_count)
					{
					@aryA = $sthA->fetchrow_array;
					$loginexistsRANDOM[$h] =	"$aryA[0]";
					$rec_count++;
					}
				$sthA->finish();
				
				if ($loginexistsRANDOM[$h] > 0)
					{
					$stmtA = "UPDATE vicidial_live_agents set random_id='$DBremote_random[$h]' where user='$DBremote_user[$h]' and server_ip='$server_ip' and campaign_id='$DBremote_campaign[$h]' and conf_exten='$DBremote_conf_exten[$h]' and closer_campaigns='$DBremote_closer[$h]';";
					$affected_rows = $dbhA->do($stmtA);
					if ($DBX) {print STDERR "$DBremote_user[$h] $DBremote_campaign[$h] ONLY RANDOM ID UPDATE: $affected_rows\n";}
					}
				### check if record for user on server exists at all in vicidial_live_agents
				else
					{
					$stmtA = "SELECT count(*) FROM vicidial_live_agents where user='$DBremote_user[$h]' and server_ip='$server_ip'";
					$sthA = $dbhA->prepare($stmtA) or die "preparing: ",$dbhA->errstr;
					$sthA->execute or die "executing: $stmtA ", $dbhA->errstr;
					$sthArows=$sthA->rows;
					$rec_count=0;
					while ($sthArows > $rec_count)
						{
						@aryA = $sthA->fetchrow_array;
						$loginexistsALL[$h] =	"$aryA[0]";
						$rec_count++;
						}
					$sthA->finish();

					if ($loginexistsALL[$h] > 0)
						{
						$stmtA = "UPDATE vicidial_live_agents set random_id='$DBremote_random[$h]',campaign_id='$DBremote_campaign[$h]',conf_exten='$DBremote_conf_exten[$h]',closer_campaigns='$DBremote_closer[$h]', status='READY' where user='$DBremote_user[$h]' and server_ip='$server_ip';";
						$affected_rows = $dbhA->do($stmtA);
						if ($DBX) {print STDERR "$DBremote_user[$h] ALL UPDATE: $affected_rows\n";}
						}
					### no records exist so insert a new one
					else
						{
						$stmtA = "INSERT INTO vicidial_live_agents (user,server_ip,conf_exten,extension,status,campaign_id,random_id,last_call_time,last_update_time,last_call_finish,closer_campaigns,channel,uniqueid,callerid) values('$DBremote_user[$h]','$server_ip','$DBremote_conf_exten[$h]','R/$DBremote_user[$h]','READY','$DBremote_campaign[$h]','$DBremote_random[$h]','$SQLdate','$tsSQLdate','$SQLdate','$DBremote_closer[$h]','','','');";
						$affected_rows = $dbhA->do($stmtA);
						if ($DBX) {print STDERR "$DBremote_user[$h] NEW INSERT\n";}
						}
					}
				}
			$h++;
			}


	###############################################################################
	###### fourth validate that the calls that the vicidial_live_agents are on are not dead
	###### and if they are wipe out the values and set the agent record back to READY
	###############################################################################
		$stmtA = "SELECT user,extension,status,uniqueid,callerid FROM vicidial_live_agents where extension LIKE \"R/%\" and server_ip='$server_ip' and uniqueid > 10;";
		$sthA = $dbhA->prepare($stmtA) or die "preparing: ",$dbhA->errstr;
		$sthA->execute or die "executing: $stmtA ", $dbhA->errstr;
		$sthArows=$sthA->rows;
		$rec_count=0;
			$z=0;
		while ($sthArows > $rec_count)
			{
			@aryA = $sthA->fetchrow_array;
			$VDuser =				"$aryA[0]";
			$VDextension =			"$aryA[1]";
			$VDstatus =				"$aryA[2]";
			$VDuniqueid =			"$aryA[3]";
			$VDcallerid =			"$aryA[4]";
			$VDrandom = int( rand(9999999)) + 10000000;

			$VD_user[$z] =			"$VDuser";
			$VD_extension[$z] =		"$VDextension";
			$VD_status[$z] =		"$VDstatus";
			$VD_uniqueid[$z] =		"$VDuniqueid";
			$VD_callerid[$z] =		"$VDcallerid";
			$VD_random[$z] =		"$VDrandom";
				
			$z++;				
			$rec_count++;
			}
		$sthA->finish();
		if ($DB) {print STDERR "$z remote agents on calls\n";}

		$z=0;
		foreach(@VD_user) 
			{
			$stmtA = "SELECT count(*) FROM vicidial_auto_calls where uniqueid='$VD_uniqueid[$z]' and server_ip='$server_ip';";
			$sthA = $dbhA->prepare($stmtA) or die "preparing: ",$dbhA->errstr;
			$sthA->execute or die "executing: $stmtA ", $dbhA->errstr;
			$sthArows=$sthA->rows;
			$rec_count=0;
			while ($sthArows > $rec_count)
				{
				@aryA = $sthA->fetchrow_array;
				$autocallexists[$z] =	"$aryA[0]";
				$rec_count++;
				}
			$sthA->finish();
			
			if ($autocallexists[$z] < 1)
				{
				if ($DELusers =~ /R\/$VD_user[$z]\|/)
					{
					$stmtA = "UPDATE vicidial_live_agents set random_id='$VD_random[$z]',status='PAUSED', last_call_finish='$SQLdate',lead_id='',uniqueid='',callerid='',channel=''  where user='$VD_user[$z]' and server_ip='$server_ip';";
					$affected_rows = $dbhA->do($stmtA);
					if ($DB) {print STDERR "$VD_user[$z] CALL WIPE UPDATE: $affected_rows|PAUSED|$VD_uniqueid[$z]|$VD_user[$z]|\n";}
					}
				else
					{
					$stmtA = "UPDATE vicidial_live_agents set random_id='$VD_random[$z]',status='READY', last_call_finish='$SQLdate',lead_id='',uniqueid='',callerid='',channel=''  where user='$VD_user[$z]' and server_ip='$server_ip';";
					$affected_rows = $dbhA->do($stmtA);
					if ($DB) {print STDERR "$VD_user[$z] CALL WIPE UPDATE: $affected_rows|READY|$VD_uniqueid[$z]|$VD_user[$z]|\n";}
					}
				}

			$z++;
			}






	###############################################################################
	###### last, wait for a little bit and repeat the loop
	###############################################################################

		### sleep for X seconds before beginning the loop again
		usleep(1*$loop_delay*1000);

	$endless_loop--;
		if($DB){print STDERR "\nloop counter: |$endless_loop|\n";}

		### putting a blank file called "VDAD.kill" in the directory will automatically safely kill this program
		if (-e "$PATHhome/VDAD.kill")
			{
			unlink("$PATHhome/VDAD.kill");
			$endless_loop=0;
			$one_day_interval=0;
			print "\nPROCESS KILLED MANUALLY... EXITING\n\n"
			}

		$bad_grabber_counter=0;


	}


		if($DB){print "DONE... Exiting... Goodbye... See you later... Not really, initiating next loop...\n";}

		$event_string='HANGING UP|';
		&event_logger;

	$one_day_interval--;

}

		$event_string='CLOSING DB CONNECTION|';
		&event_logger;


$dbhA->disconnect();


	if($DB){print "DONE... Exiting... Goodbye... See you later... Really I mean it this time\n";}


exit;













sub get_time_now	#get the current date and time and epoch for logging call lengths and datetimes
{
	$secX = time();
$secX = time();
	($sec,$min,$hour,$mday,$mon,$year,$wday,$yday,$isdst) = localtime($secX);
	$LOCAL_GMT_OFF = $SERVER_GMT;
	$LOCAL_GMT_OFF_STD = $SERVER_GMT;
	if ($isdst) {$LOCAL_GMT_OFF++;} 

$GMT_now = ($secX - ($LOCAL_GMT_OFF * 3600));
	($sec,$min,$hour,$mday,$mon,$year,$wday,$yday,$isdst) = localtime($GMT_now);
	if ($hour < 10) {$hour = "0$hour";}
	if ($min < 10) {$min = "0$min";}

	if ($DB) {print "TIME DEBUG: $LOCAL_GMT_OFF_STD|$LOCAL_GMT_OFF|$isdst|   GMT: $hour:$min\n";}

($sec,$min,$hour,$mday,$mon,$year,$wday,$yday,$isdst) = localtime(time);
$year = ($year + 1900);
$mon++;
if ($mon < 10) {$mon = "0$mon";}
if ($mday < 10) {$mday = "0$mday";}
if ($hour < 10) {$Fhour = "0$hour";}
if ($min < 10) {$min = "0$min";}
if ($sec < 10) {$sec = "0$sec";}

$now_date_epoch = time();
$now_date = "$year-$mon-$mday $hour:$min:$sec";
	$CIDdate = "$mon$mday$hour$min$sec";
	$tsSQLdate = "$year$mon$mday$hour$min$sec";
	$SQLdate = "$year-$mon-$mday $hour:$min:$sec";
	$filedate = "$year-$mon-$mday";

$BDtarget = ($secX - 10);
($Bsec,$Bmin,$Bhour,$Bmday,$Bmon,$Byear,$Bwday,$Byday,$Bisdst) = localtime($BDtarget);
$Byear = ($Byear + 1900);
$Bmon++;
if ($Bmon < 10) {$Bmon = "0$Bmon";}
if ($Bmday < 10) {$Bmday = "0$Bmday";}
if ($Bhour < 10) {$Bhour = "0$Bhour";}
if ($Bmin < 10) {$Bmin = "0$Bmin";}
if ($Bsec < 10) {$Bsec = "0$Bsec";}
	$BDtsSQLdate = "$Byear$Bmon$Bmday$Bhour$Bmin$Bsec";

$PDtarget = ($secX - 30);
($Psec,$Pmin,$Phour,$Pmday,$Pmon,$Pyear,$Pwday,$Pyday,$Pisdst) = localtime($PDtarget);
$Pyear = ($Pyear + 1900);
$Pmon++;
if ($Pmon < 10) {$Pmon = "0$Pmon";}
if ($Pmday < 10) {$Pmday = "0$Pmday";}
if ($Phour < 10) {$Phour = "0$Phour";}
if ($Pmin < 10) {$Pmin = "0$Pmin";}
if ($Psec < 10) {$Psec = "0$Psec";}
	$PDtsSQLdate = "$Pyear$Pmon$Pmday$Phour$Pmin$Psec";

$XDtarget = ($secX - 120);
($Xsec,$Xmin,$Xhour,$Xmday,$Xmon,$Xyear,$Xwday,$Xyday,$Xisdst) = localtime($XDtarget);
$Xyear = ($Xyear + 1900);
$Xmon++;
if ($Xmon < 10) {$Xmon = "0$Xmon";}
if ($Xmday < 10) {$Xmday = "0$Xmday";}
if ($Xhour < 10) {$Xhour = "0$Xhour";}
if ($Xmin < 10) {$Xmin = "0$Xmin";}
if ($Xsec < 10) {$Xsec = "0$Xsec";}
	$XDSQLdate = "$Xyear-$Xmon-$Xmday $Xhour:$Xmin:$Xsec";

$TDtarget = ($secX - 600);
($Tsec,$Tmin,$Thour,$Tmday,$Tmon,$Tyear,$Twday,$Tyday,$Tisdst) = localtime($TDtarget);
$Tyear = ($Tyear + 1900);
$Tmon++;
if ($Tmon < 10) {$Tmon = "0$Tmon";}
if ($Tmday < 10) {$Tmday = "0$Tmday";}
if ($Thour < 10) {$Thour = "0$Thour";}
if ($Tmin < 10) {$Tmin = "0$Tmin";}
if ($Tsec < 10) {$Tsec = "0$Tsec";}
	$TDSQLdate = "$Tyear-$Tmon-$Tmday $Thour:$Tmin:$Tsec";

}





sub event_logger
{
if ($DB) {print "$now_date|$event_string|\n";}
if ($SYSLOG)
	{
	### open the log file for writing ###
	open(Lout, ">>$VDRLOGfile")
			|| die "Can't open $VDRLOGfile: $!\n";
	print Lout "$now_date|$event_string|\n";
	close(Lout);
	}
$event_string='';
}
