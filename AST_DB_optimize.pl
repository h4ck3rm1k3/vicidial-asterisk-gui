#!/usr/bin/perl
#
# AST_DB_optimize.pl version 0.1
#
# DESCRIPTION:
# optimizes the tables used in the asterisk MySQL database
#
# It is recommended that you run this program on the local Asterisk machine
#
# Copyright (C) 2006  Matt Florell <vicidial@gmail.com>    LICENSE: GPLv2
#

### Make sure this file is in a libs path or put the absolute path to it
require("/home/cron/AST_SERVER_conf.pl");	# local configuration file

if (!$DB_port) {$DB_port='3306';}

use Net::MySQL;
	  
	my $dbhA = Net::MySQL->new(hostname => "$DB_server", database => "$DB_database", user => "$DB_user", password => "$DB_pass", port => "$DB_port") 
	or 	die "Couldn't connect to database: $DB_server - $DB_database\n";




	$stmtA = "optimize table call_log;";
		if($DB){print STDERR "\n|$stmtA|\n";}
		if (!$T) {$dbhA->query($stmtA); }
   if ($dbhA->has_selected_record)
	{
   $iterA=$dbhA->create_record_iterator;
	   while ($recordA = $iterA->each)
		{
		if ($DB) {print "|",$recordA->[0],"|",$recordA->[1],"|",$recordA->[2],"|",$recordA->[3],"|","\n";}
		} 
	}


	$stmtA = "optimize table park_log;";
		if($DB){print STDERR "\n|$stmtA|\n";}
		if (!$T) {$dbhA->query($stmtA); }
   if ($dbhA->has_selected_record)
	{
   $iterA=$dbhA->create_record_iterator;
	   while ($recordA = $iterA->each)
		{
		if ($DB) {print "|",$recordA->[0],"|",$recordA->[1],"|",$recordA->[2],"|",$recordA->[3],"|","\n";}
		} 
	}


	$stmtA = "optimize table vicidial_log;";
		if($DB){print STDERR "\n|$stmtA|\n";}
		if (!$T) {$dbhA->query($stmtA); }
   if ($dbhA->has_selected_record)
	{
   $iterA=$dbhA->create_record_iterator;
	   while ($recordA = $iterA->each)
		{
		if ($DB) {print "|",$recordA->[0],"|",$recordA->[1],"|",$recordA->[2],"|",$recordA->[3],"|","\n";}
		} 
	}


	$stmtA = "optimize table vicidial_closer_log;";
		if($DB){print STDERR "\n|$stmtA|\n";}
		if (!$T) {$dbhA->query($stmtA); }
   if ($dbhA->has_selected_record)
	{
   $iterA=$dbhA->create_record_iterator;
	   while ($recordA = $iterA->each)
		{
		if ($DB) {print "|",$recordA->[0],"|",$recordA->[1],"|",$recordA->[2],"|",$recordA->[3],"|","\n";}
		} 
	}


	$stmtA = "optimize table vicidial_xfer_log;";
		if($DB){print STDERR "\n|$stmtA|\n";}
		if (!$T) {$dbhA->query($stmtA); }
   if ($dbhA->has_selected_record)
	{
   $iterA=$dbhA->create_record_iterator;
	   while ($recordA = $iterA->each)
		{
		if ($DB) {print "|",$recordA->[0],"|",$recordA->[1],"|",$recordA->[2],"|",$recordA->[3],"|","\n";}
		} 
	}


	$stmtA = "optimize table vicidial_list;";
		if($DB){print STDERR "\n|$stmtA|\n";}
		if (!$T) {$dbhA->query($stmtA); }
   if ($dbhA->has_selected_record)
	{
   $iterA=$dbhA->create_record_iterator;
	   while ($recordA = $iterA->each)
		{
		if ($DB) {print "|",$recordA->[0],"|",$recordA->[1],"|",$recordA->[2],"|",$recordA->[3],"|","\n";}
		} 
	}


	$stmtA = "optimize table vicidial_manager;";
		if($DB){print STDERR "\n|$stmtA|\n";}
		if (!$T) {$dbhA->query($stmtA); }
   if ($dbhA->has_selected_record)
	{
   $iterA=$dbhA->create_record_iterator;
	   while ($recordA = $iterA->each)
		{
		if ($DB) {print "|",$recordA->[0],"|",$recordA->[1],"|",$recordA->[2],"|",$recordA->[3],"|","\n";}
		} 
	}


	$stmtA = "optimize table vicidial_auto_calls;";
		if($DB){print STDERR "\n|$stmtA|\n";}
		if (!$T) {$dbhA->query($stmtA); }
   if ($dbhA->has_selected_record)
	{
   $iterA=$dbhA->create_record_iterator;
	   while ($recordA = $iterA->each)
		{
		if ($DB) {print "|",$recordA->[0],"|",$recordA->[1],"|",$recordA->[2],"|",$recordA->[3],"|","\n";}
		} 
	}


	$stmtA = "optimize table vicidial_live_agents;";
		if($DB){print STDERR "\n|$stmtA|\n";}
		if (!$T) {$dbhA->query($stmtA); }
   if ($dbhA->has_selected_record)
	{
   $iterA=$dbhA->create_record_iterator;
	   while ($recordA = $iterA->each)
		{
		if ($DB) {print "|",$recordA->[0],"|",$recordA->[1],"|",$recordA->[2],"|",$recordA->[3],"|","\n";}
		} 
	}



	$dbhA->close;


exit;






