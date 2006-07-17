#!/usr/bin/perl
#
# AST_flush_DBqueue.pl version 0.3   *DBI-version*
#
# DESCRIPTION:
# - clears out mysql records for this server for the ACQS vicidial_manager table
# - optimizes tables used frequently by VICIDIAL
#
# It is recommended that you run this program on the local Asterisk machine
#
# Copyright (C) 2006  Matt Florell <vicidial@gmail.com>    LICENSE: GPLv2
#
# CHANGES
# 60717-1214 - changed to DBI by Marin Blu
#

$secX = time();
	($sec,$min,$hour,$mday,$mon,$year,$wday,$yday,$isdst) = localtime(time);
	$year = ($year + 1900);
	$yy = $year; $yy =~ s/^..//gi;
	$mon++;
	if ($mon < 10) {$mon = "0$mon";}
	if ($mday < 10) {$mday = "0$mday";}
	if ($hour < 10) {$hour = "0$hour";}
	if ($min < 10) {$min = "0$min";}
	if ($sec < 10) {$sec = "0$sec";}
$SQLdate_NOW="$year-$mon-$mday $hour:$min:$sec";

($sec,$min,$hour,$mday,$mon,$year,$wday,$yday,$isdst) = localtime(time()-3600);
	$year = ($year + 1900);
	$yy = $year; $yy =~ s/^..//gi;
	$mon++;
	if ($mon < 10) {$mon = "0$mon";}
	if ($mday < 10) {$mday = "0$mday";}
	if ($hour < 10) {$hour = "0$hour";}
	if ($min < 10) {$min = "0$min";}
	if ($sec < 10) {$sec = "0$sec";}
$SQLdate_NEG_1hour="$year-$mon-$mday $hour:$min:$sec";

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
	print "allowed run time options:\n  [-q] = quiet\n  [-t] = test\n  [--debug] = debugging messages\n\n";
	}
	else
	{
		if ($args =~ /-q/i)
		{
		$q=1;   $Q=1;
		}
		if ($args =~ /--debug/i)
		{
		$DB=1;
		print "\n-----DEBUGGING -----\n\n";
		}
		if ($args =~ /-t|--test/i)
		{
		$T=1; $TEST=1;
		print "\n-----TESTING -----\n\n";
		}
	}
}
else
{
print "no command line options set\n";
}
### end parsing run-time options ###


if (!$Q) {print "TEST\n\n";}
if (!$Q) {print "NOW DATETIME:         $SQLdate_NOW\n";}
if (!$Q) {print "1 HOUR AGO DATETIME:  $SQLdate_NEG_1hour\n\n";}

### Make sure this file is in a libs path or put the absolute path to it
require("/home/cron/AST_SERVER_conf.pl");	# local configuration file

if (!$DB_port) {$DB_port='3306';}

use DBI;	  

$dbhA = DBI->connect("DBI:mysql:$DB_database:$DB_server:$DB_port", "$DB_user", "$DB_pass")
 or die "Couldn't connect to database: " . DBI->errstr;


	$stmtA = "delete from vicidial_manager where server_ip='$server_ip' and entry_date < '$SQLdate_NEG_1hour';";
		if($DB){print STDERR "\n|$stmtA|\n";}
		if (!$T) {	$affected_rows = $dbhA->do($stmtA);}
		if (!$Q) {print " - vicidial_manager 2 hour flush\n";}

	$stmtA = "update park_log set status='HUNGUP' where hangup_time is not null;";
		if($DB){print STDERR "\n|$stmtA|\n";}
		if (!$T) {
					$sthA = $dbhA->prepare($stmtA) or die "preparing: ",$dbhA->errstr;
   					$sthA->execute or die "executing: $stmtA ", $dbhA->errstr;
					$sthA->finish();
				 }

	if (!$Q) {print " - park_log HUNGUP flush          \n";}


        $stmtA = "optimize table vicidial_manager;";
                if($DB){print STDERR "\n|$stmtA|\n";}
                if (!$T) 
				 {
					$sthA = $dbhA->prepare($stmtA) or die "preparing: ",$dbhA->errstr;
   					$sthA->execute or die "executing: $stmtA ", $dbhA->errstr;
   					$sthArows=$sthA->rows;
					 @aryA = $sthA->fetchrow_array;
   					 if (!$Q) {print "|",$aryA[0],"|",$aryA[1],"|",$aryA[2],"|",$aryA[3],"|","\n";}
					$sthA->finish();
				 }
				

        if (!$Q) {print " - optimize vicidial_manager          \n";}


        $stmtA = "optimize table vicidial_live_agents;";
                if($DB){print STDERR "\n|$stmtA|\n";}
                if (!$T) {
					$sthA = $dbhA->prepare($stmtA) or die "preparing: ",$dbhA->errstr;
   					$sthA->execute or die "executing: $stmtA ", $dbhA->errstr;
   					$sthArows=$sthA->rows;
					 @aryA = $sthA->fetchrow_array;
   					 if (!$Q) {print "|",$aryA[0],"|",$aryA[1],"|",$aryA[2],"|",$aryA[3],"|","\n";}             
					$sthA->finish();
				 }
				

        if (!$Q) {print " - optimize vicidial_live_agents          \n";}


        $stmtA = "optimize table vicidial_auto_calls;";
                if($DB){print STDERR "\n|$stmtA|\n";}
                if (!$T) {
					$sthA = $dbhA->prepare($stmtA) or die "preparing: ",$dbhA->errstr;
   					$sthA->execute or die "executing: $stmtA ", $dbhA->errstr;
   					$sthArows=$sthA->rows;
					 @aryA = $sthA->fetchrow_array;
   					 if (!$Q) {print "|",$aryA[0],"|",$aryA[1],"|",$aryA[2],"|",$aryA[3],"|","\n";}
   					 $rec_countY++;
					$sthA->finish();
				 }
				

        if (!$Q) {print " - optimize vicidial_auto_calls          \n";}


        $stmtA = "optimize table vicidial_hopper;";
                if($DB){print STDERR "\n|$stmtA|\n";}
                if (!$T) {
					$sthA = $dbhA->prepare($stmtA) or die "preparing: ",$dbhA->errstr;
   					$sthA->execute or die "executing: $stmtA ", $dbhA->errstr;
   					$sthArows=$sthA->rows;
					 @aryA = $sthA->fetchrow_array;
   					 if (!$Q) {print "|",$aryA[0],"|",$aryA[1],"|",$aryA[2],"|",$aryA[3],"|","\n";}
					$sthA->finish();
				 }
				

        if (!$Q) {print " - optimize vicidial_hopper          \n";}




	$dbhA->disconnect();


exit;






