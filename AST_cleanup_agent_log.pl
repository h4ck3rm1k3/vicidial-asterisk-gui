#!/usr/bin/perl
#
# AST_cleanup_agent_log.pl version 0.1
#
# DESCRIPTION:
# to be run frequently to clean up the vicidial_agent_log to fix erroneous time 
# calculations due to out-of-order vicidial_agent_log updates. This happens 0.5%
# of the time in our test setups, but that leads to inaccurate time logs so we
# wrote this script to fix the miscalculations
#
# This program only needs to be run by one server
#
# Copyright (C) 2006  Matt Florell <vicidial@gmail.com>    LICENSE: GPLv2
#


# constants
$COUNTER_OUTPUT=1;	# set to 1 to display the counter as the script runs
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
		print "\n----- DEBUGGING -----\n\n";
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
		print "\n----- TEST RUN, NO UPDATES -----\n\n";
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

if (!$DB_port) {$DB_port='3306';}

use Net::MySQL;
	  
	my $dbhA = Net::MySQL->new(hostname => "$DB_server", database => "$DB_database", user => "$DB_user", password => "$DB_pass", port => "$DB_port") 
	or 	die "Couldn't connect to database: $DB_server - $DB_database\n";



	if ($DB) {print " - cleaning up pause time\n";}
	### Grab any pause time record greater than 50000
	$stmtA = "SELECT agent_log_id,pause_epoch,wait_epoch from vicidial_agent_log where pause_sec>50000;";
		if ($DBX) {print "$stmtA\n";}
	$dbhA->query("$stmtA");
	if ($dbhA->has_selected_record)
		{
		$i=0;
		$iter=$dbhA->create_record_iterator;
		   while ( $record = $iter->each)
			{
			$DBout = '';
			$agent_log_id[$i]	=		"$record->[0]";
			$pause_epoch[$i]	=		"$record->[1]";
			$wait_epoch[$i]	=			"$record->[2]";
			$pause_sec[$i] = int($wait_epoch[$i] - $pause_epoch[$i]);
			if ( ($pause_sec[$i] < 0) || ($pause_sec[$i] > 50000) ) 
				{
				$DBout = "Override output: $pause_sec[$i]"; 
				$pause_sec[$i] = 0;
				}
			if ($DBX) {print "$i - $agent_log_id[$i]     |$wait_epoch[$i]|$pause_epoch[$i]|$pause_sec[$i]|$DBout|\n";}
			$i++;
			} 
		}
	$h=0;
	while ($h < $i)
		{
		$stmtA = "UPDATE vicidial_agent_log set pause_sec='$pause_sec[$h]' where agent_log_id='$agent_log_id[$h]';";
			if($DBX){print STDERR "\n|$stmtA|\n";}
		if (!$TEST)	{$dbhA->query($stmtA); }#  or die  "Couldn't execute query: |$stmtA|\n";
		$h++;
		}
	if ($DB) {print STDERR "     Pause times fixed: $h\n";}





	@agent_log_id=@MT;
	@wait_epoch=@MT;

	if ($DBX) {print "\n\n";}
	if ($DB) {print " - cleaning up wait time\n";}
	### Grab any pause time record greater than 50000
	$stmtA = "SELECT agent_log_id,wait_epoch,talk_epoch from vicidial_agent_log where wait_sec>50000;";
		if ($DBX) {print "$stmtA\n";}
	$dbhA->query("$stmtA");
	if ($dbhA->has_selected_record)
		{
		$i=0;
		$iter=$dbhA->create_record_iterator;
		   while ( $record = $iter->each)
			{
			$DBout = '';
			$agent_log_id[$i]	=		"$record->[0]";
			$wait_epoch[$i]	=		"$record->[1]";
			$talk_epoch[$i]	=			"$record->[2]";
			$wait_sec[$i] = int($talk_epoch[$i] - $wait_epoch[$i]);
			if ( ($wait_sec[$i] < 0) || ($wait_sec[$i] > 50000) ) 
				{
				$DBout = "Override output: $wait_sec[$i]"; 
				$wait_sec[$i] = 0;
				}
			if ($DBX) {print "$i - $agent_log_id[$i]     |$talk_epoch[$i]|$wait_epoch[$i]|$wait_sec[$i]|$DBout|\n";}
			$i++;
			} 
		}
	$h=0;
	while ($h < $i)
		{
		$stmtA = "UPDATE vicidial_agent_log set wait_sec='$wait_sec[$h]' where agent_log_id='$agent_log_id[$h]';";
			if($DBX){print STDERR "\n|$stmtA|\n";}
		if (!$TEST)	{$dbhA->query($stmtA); }#  or die  "Couldn't execute query: |$stmtA|\n";
		$h++;
		}
	if ($DB) {print STDERR "     Wait times fixed: $h\n";}





	@agent_log_id=@MT;
	@talk_epoch=@MT;

	if ($DBX) {print "\n\n";}
	if ($DB) {print " - cleaning up talk time\n";}
	### Grab any pause time record greater than 50000
	$stmtA = "SELECT agent_log_id,talk_epoch,dispo_epoch from vicidial_agent_log where talk_sec>50000;";
		if ($DBX) {print "$stmtA\n";}
	$dbhA->query("$stmtA");
	if ($dbhA->has_selected_record)
		{
		$i=0;
		$iter=$dbhA->create_record_iterator;
		   while ( $record = $iter->each)
			{
			$DBout = '';
			$agent_log_id[$i]	=	"$record->[0]";
			$talk_epoch[$i]	=		"$record->[1]";
			$dispo_epoch[$i]	=	"$record->[2]";
			$talk_sec[$i] = int($dispo_epoch[$i] - $talk_epoch[$i]);
			if ( ($talk_sec[$i] < 0) || ($talk_sec[$i] > 50000) ) 
				{
				$DBout = "Override output: $talk_sec[$i]"; 
				$talk_sec[$i] = 0;
				}
			if ($DBX) {print "$i - $agent_log_id[$i]     |$dispo_epoch[$i]|$talk_epoch[$i]|$talk_sec[$i]|$DBout|\n";}
			$i++;
			} 
		}
	$h=0;
	while ($h < $i)
		{
		$stmtA = "UPDATE vicidial_agent_log set talk_sec='$talk_sec[$h]' where agent_log_id='$agent_log_id[$h]';";
			if($DBX){print STDERR "|$stmtA|\n";}
		if (!$TEST)	{$dbhA->query($stmtA); }#  or die  "Couldn't execute query: |$stmtA|\n";
		$h++;
		}
	if ($DB) {print STDERR "     Talk times fixed: $h\n";}





	@agent_log_id=@MT;
	@dispo_epoch=@MT;

	if ($DBX) {print "\n\n";}
	if ($DB) {print " - cleaning up dispo time\n";}
		$stmtA = "UPDATE vicidial_agent_log set dispo_sec='0' where dispo_sec>50000;";
			if($DBX){print STDERR "|$stmtA|\n";}
	if (!$TEST)
		{
		$dbhA->query($stmtA); #  or die  "Couldn't execute query: |$stmtA|\n";
		$affected_rows = $dbhA->get_affected_rows_length;
		}
	if ($DB) {print STDERR "     Bad Dispo times zeroed out: $affected_rows\n";}











	if ($DB) {print STDERR "\nDONE\n";}



	$dbhA->close;


exit;






