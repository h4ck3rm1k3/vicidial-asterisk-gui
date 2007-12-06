#!/usr/bin/perl
#
# AST_cleanup_agent_log.pl version 0.3   *** DBI version ***
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
# CHANGES
# 60711-0945 - changed to DBI by Marin Blu
# 60715-2301 - changed to use /etc/astguiclient.conf for configs

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


	if ($DB) {print " - cleaning up pause time\n";}
	### Grab any pause time record greater than 43999
	$stmtA = "SELECT agent_log_id,pause_epoch,wait_epoch from vicidial_agent_log where pause_sec>43999;";
		if ($DBX) {print "$stmtA\n";}
	#$dbhA->query("$stmtA");
	$sthA = $dbhA->prepare($stmtA) or die "preparing: ",$dbhA->errstr;
	$sthA->execute or die "executing: $stmtA ", $dbhA->errstr;
	$sthArows=$sthA->rows;
	
	       $i=0;
		   while ($sthArows > $i)
			{
			@aryA = $sthA->fetchrow_array;	
			$DBout = '';
			$agent_log_id[$i]	=		"$aryA[0]";
			$pause_epoch[$i]	=		"$aryA[1]";
			$wait_epoch[$i]	=			"$aryA[2]";
			$pause_sec[$i] = int($wait_epoch[$i] - $pause_epoch[$i]);
			if ( ($pause_sec[$i] < 0) || ($pause_sec[$i] > 43999) ) 
				{
				$DBout = "Override output: $pause_sec[$i]"; 
				$pause_sec[$i] = 0;
				}
			if ($DBX) {print "$i - $agent_log_id[$i]     |$wait_epoch[$i]|$pause_epoch[$i]|$pause_sec[$i]|$DBout|\n";}
			$i++;
			} 
			
		   $sthA->finish();
		   
	$h=0;
	while ($h < $i)
		{
		$stmtA = "UPDATE vicidial_agent_log set pause_sec='$pause_sec[$h]' where agent_log_id='$agent_log_id[$h]';";
			if($DBX){print STDERR "\n|$stmtA|\n";}
		if (!$TEST)	{$affected_rows = $dbhA->do($stmtA); }
		$h++;
		}
	if ($DB) {print STDERR "     Pause times fixed: $h\n";}


	@agent_log_id=@MT;
	@wait_epoch=@MT;

	if ($DBX) {print "\n\n";}
	if ($DB) {print " - cleaning up wait time\n";}
	### Grab any pause time record greater than 43999
	$stmtA = "SELECT agent_log_id,wait_epoch,talk_epoch from vicidial_agent_log where wait_sec>43999;";
		if ($DBX) {print "$stmtA\n";}
	
	$sthA = $dbhA->prepare($stmtA) or die "preparing: ",$dbhA->errstr;
	$sthA->execute or die "executing: $stmtA ", $dbhA->errstr;
	$sthArows=$sthA->rows;
		
		   $i=0;
		   while ( $sthArows > $i)
			{
		    @aryA = $sthA->fetchrow_array;		
			$DBout = '';
			$agent_log_id[$i]	=		"$aryA[0]";
			$wait_epoch[$i]	=		    "$aryA[1]";
			$talk_epoch[$i]	=			"$aryA[2]";
			$wait_sec[$i] = int($talk_epoch[$i] - $wait_epoch[$i]);
			if ( ($wait_sec[$i] < 0) || ($wait_sec[$i] > 43999) ) 
				{
				$DBout = "Override output: $wait_sec[$i]"; 
				$wait_sec[$i] = 0;
				}
			if ($DBX) {print "$i - $agent_log_id[$i]     |$talk_epoch[$i]|$wait_epoch[$i]|$wait_sec[$i]|$DBout|\n";}
			$i++;
			} 
    $sthA->finish();
    
	$h=0;
	while ($h < $i)
		{
		$stmtA = "UPDATE vicidial_agent_log set wait_sec='$wait_sec[$h]' where agent_log_id='$agent_log_id[$h]';";
			if($DBX){print STDERR "\n|$stmtA|\n";}
		if (!$TEST)	{$affected_rows = $dbhA->do($stmtA); }
		$h++;
		}
	if ($DB) {print STDERR "     Wait times fixed: $h\n";}


	@agent_log_id=@MT;
	@talk_epoch=@MT;

	if ($DBX) {print "\n\n";}
	if ($DB) {print " - cleaning up talk time\n";}
	### Grab any pause time record greater than 43999
	$stmtA = "SELECT agent_log_id,talk_epoch,dispo_epoch from vicidial_agent_log where talk_sec>43999;";
		if ($DBX) {print "$stmtA\n";}

	$sthA = $dbhA->prepare($stmtA) or die "preparing: ",$dbhA->errstr;
	$sthA->execute or die "executing: $stmtA ", $dbhA->errstr;
	$sthArows=$sthA->rows;
	
	       $i=0;
		   while ( $sthArows > $i)
			{
		    @aryA = $sthA->fetchrow_array;		
			$DBout = '';
			$agent_log_id[$i]	=	"$aryA[0]";
			$talk_epoch[$i]	=		"$aryA[1]";
			$dispo_epoch[$i]	=	"$aryA[2]";
			$talk_sec[$i] = int($dispo_epoch[$i] - $talk_epoch[$i]);
			if ( ($talk_sec[$i] < 0) || ($talk_sec[$i] > 43999) ) 
				{
				$DBout = "Override output: $talk_sec[$i]"; 
				$talk_sec[$i] = 0;
				}
			if ($DBX) {print "$i - $agent_log_id[$i]     |$dispo_epoch[$i]|$talk_epoch[$i]|$talk_sec[$i]|$DBout|\n";}
			$i++;
			} 
    $sthA->finish();
     
	$h=0;
	while ($h < $i)
		{
		$stmtA = "UPDATE vicidial_agent_log set talk_sec='$talk_sec[$h]' where agent_log_id='$agent_log_id[$h]';";
			if($DBX){print STDERR "|$stmtA|\n";}
		if (!$TEST)	{$affected_rows = $dbhA->do($stmtA);  }
		$h++;
		}
	if ($DB) {print STDERR "     Talk times fixed: $h\n";}



	@agent_log_id=@MT;
	@dispo_epoch=@MT;

	if ($DBX) {print "\n\n";}
	if ($DB) {print " - cleaning up dispo time\n";}
		$stmtA = "UPDATE vicidial_agent_log set dispo_sec='0' where dispo_sec>43999;";
			if($DBX){print STDERR "|$stmtA|\n";}
	if (!$TEST)
		{
		$affected_rows = $dbhA->do($stmtA); 	
	    }
	if ($DB) {print STDERR "     Bad Dispo times zeroed out: $affected_rows\n";}


	if ($DB) {print STDERR "\nDONE\n";}



#	$dbhA->close;


exit;






