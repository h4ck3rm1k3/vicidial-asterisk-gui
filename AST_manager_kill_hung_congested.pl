#!/usr/bin/perl
#
# AST_manager_kill_hung_congested.pl version 0.2
#
# Part of the Asterisk Central Queue System (ACQS)
#
# DESCRIPTION:
# kills CONGEST local channels every 15 seconds
#
# For the client program to work in ACQS mode, this program must be running
# 
# For this program to work you need to have the "asterisk" MySQL database 
# created and create the tables listed in the CONF_MySQL.txt file, also make sure
# that the machine running this program has read/write/update/delete access 
# to that database
# 
# In your Asterisk server setup you also need to have several things activated
# and defined. See the CONF_Asterisk.txt file for details
#
# put this in the cron to run every minute
#
# Copyright (C) 2006  Matt Florell <vicidial@gmail.com>    LICENSE: GPLv2
#
# 50823-1525 - Added commandline debug options with debug printouts
#

# constants
$DB=0;  # Debug flag, set to 0 for no debug messages, On an active system this will generate thousands of lines of output per minute
$US='__';
$MT[0]='';


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
	print "allowed run time options:\n  [-t] = test\n  [-debug] = verbose debug messages\n[-debugX] = Extra-verbose debug messages\n\n";
	}
	else
	{
		if ($args =~ /-debug/i)
		{
		$DB=1; # Debug flag
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
#	print "no command line options set\n";
}
### end parsing run-time options ###


### Make sure this file is in a libs path or put the absolute path to it
require("/home/cron/AST_SERVER_conf.pl");	# local configuration file


	&get_time_now;

#	$event_string='PROGRAM STARTED||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||';
#	&event_logger;

#use lib './lib', '../lib';
use Net::MySQL;
#use Net::Telnet ();
	  
my $dbhA = Net::MySQL->new(hostname => "$DB_server", database => "$DB_database", user => "$DB_user", password => "$DB_pass") 
or 	die "Couldn't connect to database: \n";

#$event_string='LOGGED INTO MYSQL SERVER ON 1 CONNECTION|';
#&event_logger;

$stmtA = "SELECT channel FROM live_sip_channels where server_ip = '$server_ip' and extension = 'CONGEST' and channel LIKE \"Local%\" limit 99";
#			$event_string="SQL_QUERY|$stmtA|";
#		&event_logger;

$dbhA->query("$stmtA");
if ($dbhA->has_selected_record)
   {
	$iter=$dbhA->create_record_iterator;
	$rec_count=0;
	while ( $record = $iter->each)
		{
		if($DB){print STDERR $record->[0],"\n";}
		$congest_kill[$rec_count] = "$record->[0]";
		$rec_count++;
		}

   }

$i=0;
foreach(@congest_kill)
	{
	$i_count = $i;
	if ($i_count < 10) {$i_count = "0$i_count";}

	if (length($congest_kill[$i])>0)
		{
		### use manager middleware-app to zapbarge call being placed from meetme
			$KCqueryCID = "KC$i_count$CIDdate";

			### insert a NEW record to the vicidial_manager table to be processed
		$stmtA = "INSERT INTO vicidial_manager values('','','$now_date','NEW','N','$server_ip','','Hangup','$KCqueryCID','Channel: $congest_kill[$i]','','','','','','','','','')";

			$event_string = "SUBRT|killing_congest|KC|$KCqueryCID|$congest_kill[$i]|$stmtA|";
		 event_logger;

		if ($DB) {print "KILLING $congest_kill[$i]\n";}
		$dbhA->query($stmtA)  or die  "Couldn't execute query:\n";
		}
	$i++;
	}


sleep(14);

######## 22222 starting another loop
	&get_time_now;
@congest_kill = @MT;



$stmtA = "SELECT channel FROM live_sip_channels where server_ip = '$server_ip' and extension = 'CONGEST' and channel LIKE \"Local%\" limit 99";
#			$event_string="SQL_QUERY|$stmtA|";
#		&event_logger;

$dbhA->query("$stmtA");
if ($dbhA->has_selected_record)
   {
	$iter=$dbhA->create_record_iterator;
	$rec_count=0;
	while ( $record = $iter->each)
		{
		if($DB){print STDERR $record->[0],"\n";}
		$congest_kill[$rec_count] = "$record->[0]";
		$rec_count++;
		}

   }

$i=0;
foreach(@congest_kill)
	{
	$i_count = $i;
	if ($i_count < 10) {$i_count = "0$i_count";}

	if (length($congest_kill[$i])>0)
		{
		### use manager middleware-app to zapbarge call being placed from meetme
			$KCqueryCID = "KC$i_count$CIDdate";

			### insert a NEW record to the vicidial_manager table to be processed
		$stmtA = "INSERT INTO vicidial_manager values('','','$now_date','NEW','N','$server_ip','','Hangup','$KCqueryCID','Channel: $congest_kill[$i]','','','','','','','','','')";

			$event_string = "SUBRT|killing_congest|KC|$KCqueryCID|$congest_kill[$i]|$stmtA|";
		 event_logger;
		
		if ($DB) {print "KILLING $congest_kill[$i]\n";}
		$dbhA->query($stmtA)  or die  "Couldn't execute query:\n";
		}
	$i++;
	}


sleep(15);

######## 33333 starting another loop
	&get_time_now;
@congest_kill = @MT;




$stmtA = "SELECT channel FROM live_sip_channels where server_ip = '$server_ip' and extension = 'CONGEST' and channel LIKE \"Local%\" limit 99";
#			$event_string="SQL_QUERY|$stmtA|";
#		&event_logger;

$dbhA->query("$stmtA");
if ($dbhA->has_selected_record)
   {
	$iter=$dbhA->create_record_iterator;
	$rec_count=0;
	while ( $record = $iter->each)
		{
		if($DB){print STDERR $record->[0],"\n";}
		$congest_kill[$rec_count] = "$record->[0]";
		$rec_count++;
		}

   }

$i=0;
foreach(@congest_kill)
	{
	$i_count = $i;
	if ($i_count < 10) {$i_count = "0$i_count";}

	if (length($congest_kill[$i])>0)
		{
		### use manager middleware-app to zapbarge call being placed from meetme
			$KCqueryCID = "KC$i_count$CIDdate";

			### insert a NEW record to the vicidial_manager table to be processed
		$stmtA = "INSERT INTO vicidial_manager values('','','$now_date','NEW','N','$server_ip','','Hangup','$KCqueryCID','Channel: $congest_kill[$i]','','','','','','','','','')";

			$event_string = "SUBRT|killing_congest|KC|$KCqueryCID|$congest_kill[$i]|$stmtA|";
		 event_logger;
		
		if ($DB) {print "KILLING $congest_kill[$i]\n";}
		$dbhA->query($stmtA)  or die  "Couldn't execute query:\n";
		}
	$i++;
	}


sleep(15);

######## 44444 starting another loop
	&get_time_now;
@congest_kill = @MT;





$stmtA = "SELECT channel FROM live_sip_channels where server_ip = '$server_ip' and extension = 'CONGEST' and channel LIKE \"Local%\" limit 99";
#			$event_string="SQL_QUERY|$stmtA|";
#		&event_logger;

$dbhA->query("$stmtA");
if ($dbhA->has_selected_record)
   {
	$iter=$dbhA->create_record_iterator;
	$rec_count=0;
	while ( $record = $iter->each)
		{
		if($DB){print STDERR $record->[0],"\n";}
		$congest_kill[$rec_count] = "$record->[0]";
		$rec_count++;
		}

   }

$i=0;
foreach(@congest_kill)
	{
	$i_count = $i;
	if ($i_count < 10) {$i_count = "0$i_count";}

	if (length($congest_kill[$i])>0)
		{
		### use manager middleware-app to zapbarge call being placed from meetme
			$KCqueryCID = "KC$i_count$CIDdate";

			### insert a NEW record to the vicidial_manager table to be processed
		$stmtA = "INSERT INTO vicidial_manager values('','','$now_date','NEW','N','$server_ip','','Hangup','$KCqueryCID','Channel: $congest_kill[$i]','','','','','','','','','')";

			$event_string = "SUBRT|killing_congest|KC|$KCqueryCID|$congest_kill[$i]|$stmtA|";
		 event_logger;
		
		if ($DB) {print "KILLING $congest_kill[$i]\n";}
		$dbhA->query($stmtA)  or die  "Couldn't execute query:\n";
		}
	$i++;
	}



#		$event_string='CLOSING DB CONNECTION|';
#		&event_logger;

	$dbhA->close;


	if($DB){print "DONE... Exiting... Goodbye... See you later... \n";}


exit;







sub get_time_now	#get the current date and time and epoch for logging call lengths and datetimes
{
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
$action_log_date = "$year-$mon-$mday";
$CIDdate = "$year$mon$mday$hour$min$sec";
}





sub event_logger {
	### open the log file for writing ###
	open(Lout, ">>$KHLOGfile")
			|| die "Can't open $KHLOGfile: $!\n";

	print Lout "$now_date|$event_string|\n";

	close(Lout);

$event_string='';
}
