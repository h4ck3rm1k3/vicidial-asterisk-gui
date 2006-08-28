#!/usr/bin/perl
#
# AST_VDadapt.pl version 2.0.1   *DBI-version*
#
# DESCRIPTION:
# adjusts the auto_dial_level for vicidial adaptive-predictive campaigns. 
#
# Copyright (C) 2006  Matt Florell <vicidial@gmail.com>    LICENSE: GPLv2
#
# 60823-1302 - first build from AST_VDhopper.pl
# 60825-1734 - functional alpha version, no loop
# 60826-0857 - added loop and CLI flag options
# 60827-0035 - separate Drop calculation and target dial level calculation into different subroutines
#            - alter code so that DROP percentages would calculate only about once a minute no matter he loop delay
# 60828-1149 - add field for target dial_level difference, -1 would target one agent waiting, +1 would target 1 customer waiting
#

# constants
$DB=0;  # Debug flag, set to 0 for no debug messages, On an active system this will generate lots of lines of output per minute
$US='__';
$MT[0]='';

$drop_count_updater=0;
$VCScalls_today=0;
$VCSdrops_today=0;
$VCSdrops_today_pct=0;
$VCScalls_hour=0;
$VCSdrops_hour=0;
$VCSdrops_hour_pct=0;
$VCScalls_halfhour=0;
$VCSdrops_halfhour=0;
$VCSdrops_halfhour_pct=0;
$VCScalls_five=0;
$VCSdrops_five=0;
$VCSdrops_five_pct=0;
$VCScalls_one=0;
$VCSdrops_one=0;
$VCSdrops_one_pct=0;
$total_agents=0;
$ready_agents=0;
$waiting_calls=0;
$stat_it=15;
$ready_diff_total=0;
$waiting_diff_total=0;
$total_agents_total=0;
$ready_diff_avg=0;
$waiting_diff_avg=0;
$total_agents_avg=0;
$stat_differential=0;
$diff_ratio_updater=0;
$VCSINCALL=0;
$VCSREADY=0;
$VCSCLOSER=0;
$VCSPAUSED=0;
$VCSagents=0;
$VCSagents_calc=0;
$VCSagents_active=0;
$diff_ratio_updater=0;
$stat_count=1;

# set to 61 initially so that a baseline drop count is pulled
$drop_count_updater=61;

$secT = time();
	&get_time_now;

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
	print "allowed run time options(must stay in this order):\n  [--debug] = debug\n  [--debugX] = super debug\n  [-t] = test\n  [--loops=XXX] = force a number of loops of XXX\n  [--delay=XXX] = force a loop delay of XXX seconds\n  [--campaign=XXX] = run for campaign XXX only\n  [-force] = force calculation of suggested predictive dial_level\n  [-test] = test only, do not alter dial_level\n\n";
	}
	else
	{
		if ($args =~ /--campaign=/i) # CLI defined campaign
			{
			@CLIvarARY = split(/--campaign=/,$args);
			@CLIvarARX = split(/ /,$CLIvarARY[1]);
			if (length($CLIvarARX[0])>2)
				{
				$CLIcampaign = $CLIvarARX[0];
				$CLIcampaign =~ s/\/$| |\r|\n|\t//gi;
				}
			else
				{$CLIcampaign = '';}
			@CLIvarARY=@MT;   @CLIvarARY=@MT;
			}
		else
			{$CLIcampaign = '';}
		if ($args =~ /--level=/i) # CLI defined level
			{
			@CLIvarARY = split(/--level=/,$args);
			@CLIvarARX = split(/ /,$CLIvarARY[1]);
			if (length($CLIvarARX[0])>2)
				{
				$CLIlevel = $CLIvarARX[0];
				$CLIlevel =~ s/\/$| |\r|\n|\t//gi;
				$CLIlevel =~ s/\D//gi;
				}
			else
				{$CLIlevel = '';}
			@CLIvarARY=@MT;   @CLIvarARY=@MT;
			}
		else
			{$CLIlevel = '';}
		if ($args =~ /--loops=/i) # CLI defined loops
			{
			@CLIvarARY = split(/--loops=/,$args);
			@CLIvarARX = split(/ /,$CLIvarARY[1]);
			if (length($CLIvarARX[0])>2)
				{
				$CLIloops = $CLIvarARX[0];
				$CLIloops =~ s/\/$| |\r|\n|\t//gi;
				$CLIloops =~ s/\D//gi;
				}
			else
				{$CLIloops = '1000000';}
			@CLIvarARY=@MT;   @CLIvarARY=@MT;
			}
		else
			{$CLIloops = '1000000';}
		if ($args =~ /--delay=/i) # CLI defined delay
			{
			@CLIvarARY = split(/--delay=/,$args);
			@CLIvarARX = split(/ /,$CLIvarARY[1]);
			if (length($CLIvarARX[0])>2)
				{
				$CLIdelay = $CLIvarARX[0];
				$CLIdelay =~ s/\/$| |\r|\n|\t//gi;
				$CLIdelay =~ s/\D//gi;
				}
			else
				{$CLIdelay = '1';}
			@CLIvarARY=@MT;   @CLIvarARY=@MT;
			}
		else
			{$CLIdelay = '1';}
		if ($args =~ /--debug/i)
			{
			$DB=1;
			print "\n----- DEBUG -----\n\n";
			}
		if ($args =~ /--debugX/i)
			{
			$DBX=1;
			print "\n";
			print "----- SUPER DEBUG -----\n";
			print "VARS-\n";
			print "CLIcampaign- $CLIcampaign\n";
			print "CLIlevel-    $CLIlevel\n";
			print "CLIloops-    $CLIloops\n";
			print "CLIdelay-    $CLIdelay\n";
			print "\n";
			}
		if ($args =~ /-force/i)
			{
			$force_test=1;
			print "\n----- FORCE TESTING -----\n\n";
			}
		if ($args =~ /-t/i)
			{
			$T=1;   $TEST=1;
			print "\n-----TESTING -----\n\n";
			}
	}
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

if (!$VARDB_port) {$VARDB_port='3306';}

use DBI;	  

$dbhA = DBI->connect("DBI:mysql:$VARDB_database:$VARDB_server:$VARDB_port", "$VARDB_user", "$VARDB_pass")
 or die "Couldn't connect to database: " . DBI->errstr;

if ($DBX) {print "CONNECTED TO DATABASE:  $VARDB_server|$VARDB_database\n";}


$master_loop=0;

### Start master loop ###
while ($master_loop<$CLIloops) 
{
	&get_time_now;

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



	$secX = time();
	($sec,$min,$hour,$mday,$mon,$year,$wday,$yday,$isdst) = localtime($secX);
	$LOCAL_GMT_OFF = $SERVER_GMT;
	$LOCAL_GMT_OFF_STD = $SERVER_GMT;
	if ($isdst) {$LOCAL_GMT_OFF++;} 

	$GMT_now = ($secX - ($LOCAL_GMT_OFF * 3600));
	($sec,$min,$hour,$mday,$mon,$year,$wday,$yday,$isdst) = localtime($GMT_now);
	$mon++;
	$year = ($year + 1900);
	if ($mon < 10) {$mon = "0$mon";}
	if ($mday < 10) {$mday = "0$mday";}
	if ($hour < 10) {$hour = "0$hour";}
	if ($min < 10) {$min = "0$min";}
	if ($sec < 10) {$sec = "0$sec";}

#	if ($DB) {print "TIME DEBUG: $master_loop   $LOCAL_GMT_OFF_STD|$LOCAL_GMT_OFF|$isdst|   GMT: $hour:$min\n";}

@campaign_id=@MT; 

if ($CLIcampaign)
	{
	$stmtA = "SELECT * from vicidial_campaigns where campaign_id='$CLIcampaign'";
	}
else
	{
	$stmtA = "SELECT * from vicidial_campaigns where active='Y'";
	}
$sthA = $dbhA->prepare($stmtA) or die "preparing: ",$dbhA->errstr;
$sthA->execute or die "executing: $stmtA ", $dbhA->errstr;
$sthArows=$sthA->rows;
$rec_count=0;
while ($sthArows > $rec_count)
	{
	@aryA = $sthA->fetchrow_array;
	$campaign_id[$rec_count] =		 "$aryA[0]";
	$dial_status_a[$rec_count] =	 "$aryA[3]";
	$dial_status_b[$rec_count] =	 "$aryA[4]";
	$dial_status_c[$rec_count] =	 "$aryA[5]";
	$dial_status_d[$rec_count] =	 "$aryA[6]";
	$dial_status_e[$rec_count] =	 "$aryA[7]";
	$lead_order[$rec_count] =		 "$aryA[8]";
	if (!$CLIlevel) 
		{$hopper_level[$rec_count] = "$aryA[13]";}
	else
		{$hopper_level[$rec_count] = "$CLIlevel";}
	$auto_dial_level[$rec_count] =	 "$aryA[14]";
	$local_call_time[$rec_count] =	 "$aryA[16]";
	$lead_filter_id[$rec_count] =	 "$aryA[35]";
	$use_internal_dnc[$rec_count] =	 "$aryA[43]";
	$dial_method[$rec_count] =					$aryA[46];
	$available_only_ratio_tally[$rec_count] =	$aryA[47];
	$adaptive_dropped_percentage[$rec_count] =	$aryA[48];
	$adaptive_maximum_level[$rec_count] =		$aryA[49];
	$adaptive_latest_server_time[$rec_count] =	$aryA[50];
	$adaptive_intensity[$rec_count] =			$aryA[51];
	$adaptive_dl_diff_target[$rec_count] =		$aryA[52];

	$rec_count++;
	}
$sthA->finish();
if ($DB) {print "$now_date CAMPAIGNS TO PROCESSES ADAPT FOR:  $rec_count|$#campaign_id       IT: $master_loop\n";}


##### LOOP THROUGH EACH CAMPAIGN AND PROCESS THE HOPPER #####
$i=0;
foreach(@campaign_id)
	{
 	### Find out how many leads are in the hopper from a specific campaign
	$hopper_ready_count=0;
	$stmtA = "SELECT count(*) from vicidial_hopper where campaign_id='$campaign_id[$i]' and status='READY';";
	$sthA = $dbhA->prepare($stmtA) or die "preparing: ",$dbhA->errstr;
	$sthA->execute or die "executing: $stmtA ", $dbhA->errstr;
	$sthArows=$sthA->rows;
	$rec_count=0;
	while ($sthArows > $rec_count)
		{
		@aryA = $sthA->fetchrow_array;
		$hopper_ready_count = $aryA[0];
		if ($DB) {print "     $campaign_id[$i] hopper READY count:   $hopper_ready_count";}
#		if ($DBX) {print "     |$stmtA|\n";}
		$rec_count++;
		}
	$sthA->finish();
	$event_string = "|$campaign_id[$i]|$hopper_level[$i]|$hopper_ready_count|$local_call_time[$i]||";
		if ($DBX) {print "$i     $event_string\n";}
	&event_logger;	

	##### IF THERE ARE NO LEADS IN THE HOPPER FOR THE CAMPAIGN WE DO NOT WANT TO ADJUST THE DIAL_LEVEL
	if ($hopper_ready_count>0)
		{
		### BEGIN - GATHER STATS FOR THE vicidial_campaign_stats TABLE ###
		$vicidial_log = 'vicidial_log';
		$differential_onemin=0;
		$agents_average_onemin=0;

		### Grab the count of agents and lines
		if ($campaign_id[$i] !~ /CLOSER/)
			{
			&count_agents_lines;
			}
		else
			{
			if ($DB) {print "     CLOSER CAMPAIGN\n";}
			}

		if ($total_agents_avg > 0)
			{
			### Update Drop counter every 60 seconds
			if ($drop_count_updater>=60)
				{
				&calculate_drops;
				}

			### Calculate and update Dial level every 15 seconds
			if ($diff_ratio_updater>=15)
				{
				&calculate_dial_level;
				}
			}
		}
	$i++;
	}

$diff_ratio_updater = ($diff_ratio_updater + $CLIdelay);
$drop_count_updater = ($drop_count_updater + $CLIdelay);

sleep($CLIdelay);

$stat_count++;
$master_loop++;
}

$dbhA->disconnect();

if($DB)
{
### calculate time to run script ###
$secY = time();
$secZ = ($secY - $secT);

if (!$q) {print "DONE. Script execution time in seconds: $secZ\n";}
}

exit;





### SUBROUTINES ###############################################################

sub event_logger
{
if ($SYSLOG)
	{
	if (!$VDHLOGfile) {$VDHLOGfile = "$PATHlogs/adapt.$year-$mon-$mday";}

	### open the log file for writing ###
	open(Lout, ">>$VDHLOGfile")
			|| die "Can't open $VDHLOGfile: $!\n";
	print Lout "$now_date|$event_string|\n";
	close(Lout);
	}
$event_string='';
}


sub adaptive_logger
{
if ($SYSLOG)
	{
	$VDHCLOGfile = "$PATHlogs/VDadaptive-$campaign_id[$i].$file_date";

	### open the log file for writing ###
	open(Aout, ">>$VDHCLOGfile")
			|| die "Can't open $VDHCLOGfile: $!\n";
	print Aout "$now_date$adaptive_string\n";
	close(Aout);
	}
$adaptive_string='';
}

sub get_time_now
{
$secX = time();
($sec,$min,$hour,$mday,$mon,$year,$wday,$yday,$isdst) = localtime(time);
$year = ($year + 1900);
$mon++;
if ($mon < 10) {$mon = "0$mon";}
if ($mday < 10) {$mday = "0$mday";}
if ($hour < 10) {$Fhour = "0$hour";}
if ($min < 10) {$min = "0$min";}
if ($sec < 10) {$sec = "0$sec";}
$file_date = "$year-$mon-$mday";
$now_date = "$year-$mon-$mday $hour:$min:$sec";
$VDL_date = "$year-$mon-$mday 00:00:01";
$current_hourmin = "$hour$min";

### get date-time of one hour ago ###
	$VDL_hour = ($secX - (60 * 60));
($Vsec,$Vmin,$Vhour,$Vmday,$Vmon,$Vyear,$Vwday,$Vyday,$Visdst) = localtime($VDL_hour);
$Vyear = ($Vyear + 1900);
$Vmon++;
if ($Vmon < 10) {$Vmon = "0$Vmon";}
if ($Vmday < 10) {$Vmday = "0$Vmday";}
$VDL_hour = "$Vyear-$Vmon-$Vmday $Vhour:$Vmin:$Vsec";

### get date-time of half hour ago ###
	$VDL_halfhour = ($secX - (30 * 60));
($Vsec,$Vmin,$Vhour,$Vmday,$Vmon,$Vyear,$Vwday,$Vyday,$Visdst) = localtime($VDL_halfhour);
$Vyear = ($Vyear + 1900);
$Vmon++;
if ($Vmon < 10) {$Vmon = "0$Vmon";}
if ($Vmday < 10) {$Vmday = "0$Vmday";}
$VDL_halfhour = "$Vyear-$Vmon-$Vmday $Vhour:$Vmin:$Vsec";

### get date-time of five minutes ago ###
	$VDL_five = ($secX - (5 * 60));
($Vsec,$Vmin,$Vhour,$Vmday,$Vmon,$Vyear,$Vwday,$Vyday,$Visdst) = localtime($VDL_five);
$Vyear = ($Vyear + 1900);
$Vmon++;
if ($Vmon < 10) {$Vmon = "0$Vmon";}
if ($Vmday < 10) {$Vmday = "0$Vmday";}
$VDL_five = "$Vyear-$Vmon-$Vmday $Vhour:$Vmin:$Vsec";

### get date-time of one minute ago ###
	$VDL_one = ($secX - (1 * 60));
($Vsec,$Vmin,$Vhour,$Vmday,$Vmon,$Vyear,$Vwday,$Vyday,$Visdst) = localtime($VDL_one);
$Vyear = ($Vyear + 1900);
$Vmon++;
if ($Vmon < 10) {$Vmon = "0$Vmon";}
if ($Vmday < 10) {$Vmday = "0$Vmday";}
$VDL_one = "$Vyear-$Vmon-$Vmday $Vhour:$Vmin:$Vsec";
}


sub count_agents_lines
{
### Calculate campaign-wide agent waiting and calls waiting differential
$total_agents=0;
$ready_agents=0;
$waiting_calls=0;
$stat_it=15;
$ready_diff_total=0;
$waiting_diff_total=0;
$total_agents_total=0;
$ready_diff_avg=0;
$waiting_diff_avg=0;
$total_agents_avg=0;
$stat_differential=0;

$stmtA = "SELECT count(*),status from vicidial_live_agents where campaign_id='$campaign_id[$i]' and last_update_time > '$VDL_one' group by status;";
$sthA = $dbhA->prepare($stmtA) or die "preparing: ",$dbhA->errstr;
$sthA->execute or die "executing: $stmtA ", $dbhA->errstr;
$sthArows=$sthA->rows;
$rec_count=0;
while ($sthArows > $rec_count)
	{
	@aryA = $sthA->fetchrow_array;
	$VCSagent_count =		 "$aryA[0]";
	$VCSagent_status =		 "$aryA[1]";
	$rec_count++;
	if ($VCSagent_status =~ /READY|DONE/) {$ready_agents = ($ready_agents + $VCSagent_count);}
	$total_agents = ($total_agents + $VCSagent_count);
	}
$sthA->finish();

$stmtA = "SELECT count(*) FROM vicidial_auto_calls where campaign_id='$campaign_id[$i]' and status IN('LIVE');";
$sthA = $dbhA->prepare($stmtA) or die "preparing: ",$dbhA->errstr;
$sthA->execute or die "executing: $stmtA ", $dbhA->errstr;
$sthArows=$sthA->rows;
$rec_count=0;
while ($sthArows > $rec_count)
	{
	@aryA = $sthA->fetchrow_array;
		$waiting_calls = "$aryA[0]";
	$rec_count++;
	}
$sthA->finish();

$stat_ready_agents[$i][$stat_count] = $ready_agents;
$stat_waiting_calls[$i][$stat_count] = $waiting_calls;
$stat_total_agents[$i][$stat_count] = $total_agents;

if ($stat_count < 15) 
	{
	$stat_it = $stat_count;
	$stat_B = 1;
	}
else
	{
	$stat_B = ($stat_count - 14);
	}

$it=0;
while($it < $stat_it)
	{
	$it_ary = ($it + $stat_B);
	$ready_diff_total = ($ready_diff_total + $stat_ready_agents[$i][$it_ary]);
	$waiting_diff_total = ($waiting_diff_total + $stat_waiting_calls[$i][$it_ary]);
	$total_agents_total = ($total_agents_total + $stat_total_agents[$i][$it_ary]);
#		$event_string="$stat_count $it_ary   $stat_total_agents[$i][$it_ary]|$stat_ready_agents[$i][$it_ary]|$stat_waiting_calls[$i][$it_ary]";
#		if ($DB) {print "     $event_string\n";}
#		&event_logger;
	$it++;
	}

if ($ready_diff_total > 0) 
	{$ready_diff_avg = ($ready_diff_total / $stat_it);}
if ($waiting_diff_total > 0) 
	{$waiting_diff_avg = ($waiting_diff_total / $stat_it);}
if ($total_agents_total > 0) 
	{$total_agents_avg = ($total_agents_total / $stat_it);}
$stat_differential = ($ready_diff_avg - $waiting_diff_avg);

$event_string="CAMPAIGN DIFFERENTIAL: $total_agents_avg   $stat_differential   ($ready_diff_avg - $waiting_diff_avg)";
if ($DBX) {print "$campaign_id[$i]|$event_string\n";}
if ($DB) {print "     $event_string\n";}

&event_logger;

#	$stmtA = "UPDATE vicidial_campaign_stats SET differential_onemin='$stat_differential', agents_average_onemin='$total_agents_avg' where campaign_id='$DBIPcampaign[$i]';";
#	$affected_rows = $dbhA->do($stmtA);
}


sub calculate_drops
{
$drop_count_updater=0;
$VCScalls_today=0;
$VCSdrops_today=0;
$VCSdrops_today_pct=0;
$VCScalls_hour=0;
$VCSdrops_hour=0;
$VCSdrops_hour_pct=0;
$VCScalls_halfhour=0;
$VCSdrops_halfhour=0;
$VCSdrops_halfhour_pct=0;
$VCScalls_five=0;
$VCSdrops_five=0;
$VCSdrops_five_pct=0;
$VCScalls_one=0;
$VCSdrops_one=0;
$VCSdrops_one_pct=0;

# LAST ONE MINUTE CALL AND DROP STATS
$stmtA = "SELECT count(*) from $vicidial_log where campaign_id='$campaign_id[$i]' and call_date > '$VDL_one';";
$sthA = $dbhA->prepare($stmtA) or die "preparing: ",$dbhA->errstr;
$sthA->execute or die "executing: $stmtA ", $dbhA->errstr;
$sthArows=$sthA->rows;
$rec_count=0;
while ($sthArows > $rec_count)
	{
	@aryA = $sthA->fetchrow_array;
	$VCScalls_one =		 "$aryA[0]";
	$rec_count++;
	}
$sthA->finish();
if ($VCScalls_one > 0)
	{
	$stmtA = "SELECT count(*) from $vicidial_log where campaign_id='$campaign_id[$i]' and call_date > '$VDL_one' and status IN('DROP','XDROP');";
	$sthA = $dbhA->prepare($stmtA) or die "preparing: ",$dbhA->errstr;
	$sthA->execute or die "executing: $stmtA ", $dbhA->errstr;
	$sthArows=$sthA->rows;
	$rec_count=0;
	while ($sthArows > $rec_count)
		{
		@aryA = $sthA->fetchrow_array;
		$VCSdrops_one =		 "$aryA[0]";
		if ($VCSdrops_one > 0)
			{
			$VCSdrops_one_pct = ( ($VCSdrops_one / $VCScalls_one) * 100 );
			$VCSdrops_one_pct = sprintf("%.2f", $VCSdrops_one_pct);	
			}
		$rec_count++;
		}
	$sthA->finish();
	}

# TODAY CALL AND DROP STATS
$stmtA = "SELECT count(*) from $vicidial_log where campaign_id='$campaign_id[$i]' and call_date > '$VDL_date';";
$sthA = $dbhA->prepare($stmtA) or die "preparing: ",$dbhA->errstr;
$sthA->execute or die "executing: $stmtA ", $dbhA->errstr;
$sthArows=$sthA->rows;
$rec_count=0;
while ($sthArows > $rec_count)
	{
	@aryA = $sthA->fetchrow_array;
	$VCScalls_today =		 "$aryA[0]";
	$rec_count++;
	}
$sthA->finish();
if ($VCScalls_today > 0)
	{
	$stmtA = "SELECT count(*) from $vicidial_log where campaign_id='$campaign_id[$i]' and call_date > '$VDL_date' and status IN('DROP','XDROP');";
	$sthA = $dbhA->prepare($stmtA) or die "preparing: ",$dbhA->errstr;
	$sthA->execute or die "executing: $stmtA ", $dbhA->errstr;
	$sthArows=$sthA->rows;
	$rec_count=0;
	while ($sthArows > $rec_count)
		{
		@aryA = $sthA->fetchrow_array;
		$VCSdrops_today =		 "$aryA[0]";
		if ($VCSdrops_today > 0)
			{
			$VCSdrops_today_pct = ( ($VCSdrops_today / $VCScalls_today) * 100 );
			$VCSdrops_today_pct = sprintf("%.2f", $VCSdrops_today_pct);	
			}
		$rec_count++;
		}
	$sthA->finish();
	}

# LAST HOUR CALL AND DROP STATS
$stmtA = "SELECT count(*) from $vicidial_log where campaign_id='$campaign_id[$i]' and call_date > '$VDL_hour';";
$sthA = $dbhA->prepare($stmtA) or die "preparing: ",$dbhA->errstr;
$sthA->execute or die "executing: $stmtA ", $dbhA->errstr;
$sthArows=$sthA->rows;
$rec_count=0;
while ($sthArows > $rec_count)
	{
	@aryA = $sthA->fetchrow_array;
	$VCScalls_hour =		 "$aryA[0]";
	$rec_count++;
	}
$sthA->finish();
if ($VCScalls_hour > 0)
	{
	$stmtA = "SELECT count(*) from $vicidial_log where campaign_id='$campaign_id[$i]' and call_date > '$VDL_hour' and status IN('DROP','XDROP');";
	$sthA = $dbhA->prepare($stmtA) or die "preparing: ",$dbhA->errstr;
	$sthA->execute or die "executing: $stmtA ", $dbhA->errstr;
	$sthArows=$sthA->rows;
	$rec_count=0;
	while ($sthArows > $rec_count)
		{
		@aryA = $sthA->fetchrow_array;
		$VCSdrops_hour =		 "$aryA[0]";
		if ($VCSdrops_hour > 0)
			{
			$VCSdrops_hour_pct = ( ($VCSdrops_hour / $VCScalls_hour) * 100 );
			$VCSdrops_hour_pct = sprintf("%.2f", $VCSdrops_hour_pct);	
			}
		$rec_count++;
		}
	$sthA->finish();
	}

# LAST HALFHOUR CALL AND DROP STATS
$stmtA = "SELECT count(*) from $vicidial_log where campaign_id='$campaign_id[$i]' and call_date > '$VDL_halfhour';";
$sthA = $dbhA->prepare($stmtA) or die "preparing: ",$dbhA->errstr;
$sthA->execute or die "executing: $stmtA ", $dbhA->errstr;
$sthArows=$sthA->rows;
$rec_count=0;
while ($sthArows > $rec_count)
	{
	@aryA = $sthA->fetchrow_array;
	$VCScalls_halfhour =		 "$aryA[0]";
	$rec_count++;
	}
$sthA->finish();
if ($VCScalls_halfhour > 0)
	{
	$stmtA = "SELECT count(*) from $vicidial_log where campaign_id='$campaign_id[$i]' and call_date > '$VDL_halfhour' and status IN('DROP','XDROP');";
	$sthA = $dbhA->prepare($stmtA) or die "preparing: ",$dbhA->errstr;
	$sthA->execute or die "executing: $stmtA ", $dbhA->errstr;
	$sthArows=$sthA->rows;
	$rec_count=0;
	while ($sthArows > $rec_count)
		{
		@aryA = $sthA->fetchrow_array;
		$VCSdrops_halfhour =		 "$aryA[0]";
		if ($VCSdrops_halfhour > 0)
			{
			$VCSdrops_halfhour_pct = ( ($VCSdrops_halfhour / $VCScalls_halfhour) * 100 );
			$VCSdrops_halfhour_pct = sprintf("%.2f", $VCSdrops_halfhour_pct);	
			}
		$rec_count++;
		}
	$sthA->finish();
	}

# LAST FIVE MINUTE CALL AND DROP STATS
$stmtA = "SELECT count(*) from $vicidial_log where campaign_id='$campaign_id[$i]' and call_date > '$VDL_five';";
$sthA = $dbhA->prepare($stmtA) or die "preparing: ",$dbhA->errstr;
$sthA->execute or die "executing: $stmtA ", $dbhA->errstr;
$sthArows=$sthA->rows;
$rec_count=0;
while ($sthArows > $rec_count)
	{
	@aryA = $sthA->fetchrow_array;
	$VCScalls_five =		 "$aryA[0]";
	$rec_count++;
	}
$sthA->finish();
if ($VCScalls_five > 0)
	{
	$stmtA = "SELECT count(*) from $vicidial_log where campaign_id='$campaign_id[$i]' and call_date > '$VDL_five' and status IN('DROP','XDROP');";
	$sthA = $dbhA->prepare($stmtA) or die "preparing: ",$dbhA->errstr;
	$sthA->execute or die "executing: $stmtA ", $dbhA->errstr;
	$sthArows=$sthA->rows;
	$rec_count=0;
	while ($sthArows > $rec_count)
		{
		@aryA = $sthA->fetchrow_array;
		$VCSdrops_five =		 "$aryA[0]";
		if ($VCSdrops_five > 0)
			{
			$VCSdrops_five_pct = ( ($VCSdrops_five / $VCScalls_five) * 100 );
			$VCSdrops_five_pct = sprintf("%.2f", $VCSdrops_five_pct);	
			}
		$rec_count++;
		}
	$sthA->finish();
	}
if ($DBX) {print "$campaign_id[$i]|$VCSdrops_five_pct|$VCSdrops_today_pct\n";}

}



sub calculate_dial_level
{
$diff_ratio_updater=0;
$VCSINCALL=0;
$VCSREADY=0;
$VCSCLOSER=0;
$VCSPAUSED=0;
$VCSagents=0;
$VCSagents_calc=0;
$VCSagents_active=0;

# COUNTS OF STATUSES OF AGENTS IN THIS CAMPAIGN
$stmtA = "SELECT count(*),status from vicidial_live_agents where campaign_id='$campaign_id[$i]' and last_update_time > '$VDL_one' group by status;";
$sthA = $dbhA->prepare($stmtA) or die "preparing: ",$dbhA->errstr;
$sthA->execute or die "executing: $stmtA ", $dbhA->errstr;
$sthArows=$sthA->rows;
$rec_count=0;
while ($sthArows > $rec_count)
	{
	@aryA = $sthA->fetchrow_array;
	$VCSagent_count =		 "$aryA[0]";
	$VCSagent_status =		 "$aryA[1]";
	$rec_count++;
	if ($VCSagent_status =~ /INCALL|QUEUE/) {$VCSINCALL = ($VCSINCALL + $VCSagent_count);}
	if ($VCSagent_status =~ /READY/) {$VCSREADY = ($VCSREADY + $VCSagent_count);}
	if ($VCSagent_status =~ /CLOSER/) {$VCSCLOSER = ($VCSCLOSER + $VCSagent_count);}
	if ($VCSagent_status =~ /PAUSED/) {$VCSPAUSED = ($VCSPAUSED + $VCSagent_count);}
	$VCSagents = ($VCSagents + $VCSagent_count);
	}
$sthA->finish();

if ($available_only_ratio_tally =~ /Y/) 
	{$VCSagents_calc = $VCSREADY;}
else
	{$VCSagents_calc = ($VCSINCALL + $VCSREADY);}
$VCSagents_active = ($VCSINCALL + $VCSREADY + $VCSCLOSER);

### END - GATHER STATS FOR THE vicidial_campaign_stats TABLE ###

if ($campaign_id[$i] =~ /CLOSER/)
	{
	# GET AVERAGES FROM THIS CAMPAIGN
	$stmtA = "SELECT differential_onemin,agents_average_onemin from vicidial_campaign_stats where campaign_id='$campaign_id[$i]';";
	$sthA = $dbhA->prepare($stmtA) or die "preparing: ",$dbhA->errstr;
	$sthA->execute or die "executing: $stmtA ", $dbhA->errstr;
	$sthArows=$sthA->rows;
	$rec_count=0;
	while ($sthArows > $rec_count)
		{
		@aryA = $sthA->fetchrow_array;
		$differential_onemin =		 "$aryA[0]";
		$agents_average_onemin =	 "$aryA[1]";
		$rec_count++;
		}
	$sthA->finish();
	}
else
	{
	$agents_average_onemin =	$total_agents_avg;  
	$differential_onemin =		$stat_differential;
	}

## UPDATE STATS FOR CAMPAIGN
$stmtA = "UPDATE vicidial_campaign_stats SET calls_today='$VCScalls_today',drops_today='$VCSdrops_today',drops_today_pct='$VCSdrops_today_pct',calls_hour='$VCScalls_hour',drops_hour='$VCSdrops_hour',drops_hour_pct='$VCSdrops_hour_pct',calls_halfhour='$VCScalls_halfhour',drops_halfhour='$VCSdrops_halfhour',drops_halfhour_pct='$VCSdrops_halfhour_pct',calls_fivemin='$VCScalls_five',drops_fivemin='$VCSdrops_five',drops_fivemin_pct='$VCSdrops_five_pct',calls_onemin='$VCScalls_one',drops_onemin='$VCSdrops_one',drops_onemin_pct='$VCSdrops_one_pct' where campaign_id='$campaign_id[$i]';";
$affected_rows = $dbhA->do($stmtA);
if ($DBX) {print "$campaign_id[$i]|$stmtA|\n";}


if ( ($dial_method[$i] =~ /ADAPT_HARD_LIMIT|ADAPT_AVERAGE|ADAPT_TAPERED/) || ($force_test>0) )
	{
	# Calculate the optimal dial_level differential for the past minute
	$differential_target = ($differential_onemin + $adaptive_dl_diff_target[$i]);
	$differential_mul = ($differential_target / $agents_average_onemin);
	$differential_pct_raw = ($differential_mul * 100);
	$differential_pct = sprintf("%.2f", $differential_pct_raw);

	# Factor in the intensity setting
	$intensity_mul = ($adaptive_intensity[$i] / 100);
	if ($differential_pct_raw < 0)
		{
		$abs_intensity_mul = abs($intensity_mul - 1);
		$intensity_diff = ($differential_pct_raw * $abs_intensity_mul);
		}
	else
		{$intensity_diff = ($differential_pct_raw * ($intensity_mul + 1) );}
	$intensity_pct = sprintf("%.2f", $intensity_diff);	
	$intensity_diff_mul = ($intensity_diff / 100);

	# Suggested dial_level based on differential
	$suggested_dial_level = ($auto_dial_level[$i] * ($differential_mul + 1) );
	$suggested_dial_level = sprintf("%.3f", $suggested_dial_level);

	# Suggested dial_level based on differential with intensity setting
	$intensity_dial_level = ($auto_dial_level[$i] * ($intensity_diff_mul + 1) );
	$intensity_dial_level = sprintf("%.3f", $intensity_dial_level);

	# Calculate last timezone target for ADAPT_TAPERED
	$last_target_hour_final = $adaptive_latest_server_time[$i];
#	if ($last_target_hour_final>2400) {$last_target_hour_final=2400;}
	$tapered_hours_left = ($last_target_hour_final - $current_hourmin);
	if ($tapered_hours_left > 1000)
		{$tapered_rate = 1;}
	else
		{$tapered_rate = ($tapered_hours_left / 1000);}

	$adaptive_string  = "\n";
	$adaptive_string .= "CAMPAIGN:   $campaign_id[$i]\n";
	$adaptive_string .= "SETTINGS-\n";
	$adaptive_string .= "   DIAL LEVEL:    $auto_dial_level[$i]\n";
	$adaptive_string .= "   DIAL METHOD:   $dial_method[$i]\n";
	$adaptive_string .= "   AVAIL ONLY:    $available_only_ratio_tally[$i]\n";
	$adaptive_string .= "   DROP PERCENT:  $adaptive_dropped_percentage[$i]\n";
	$adaptive_string .= "   MAX LEVEL:     $adaptive_maximum_level[$i]\n";
	$adaptive_string .= "   SERVER TIME:   $current_hourmin\n";
	$adaptive_string .= "   LATE TARGET:   $last_target_hour_final     ($tapered_hours_left left|$tapered_rate)\n";
	$adaptive_string .= "   INTENSITY:     $adaptive_intensity[$i]\n";
	$adaptive_string .= "   DLDIFF TARGET: $adaptive_dl_diff_target[$i]\n";
	$adaptive_string .= "CURRENT STATS-\n";
	$adaptive_string .= "   AVG AGENTS:      $agents_average_onemin\n";
	$adaptive_string .= "   AGENTS:          $VCSagents  ACTIVE: $VCSagents_active   CALC: $VCSagents_calc  INCALL: $VCSINCALL    READY: $VCSREADY\n";
	$adaptive_string .= "   DL DIFFERENTIAL: $differential_target = ($differential_onemin + $adaptive_dl_diff_target[$i])\n";
	$adaptive_string .= "DIAL LEVEL SUGGESTION-\n";
	$adaptive_string .= "      PERCENT DIFF: $differential_pct\n";
	$adaptive_string .= "      SUGGEST DL:   $suggested_dial_level = ($auto_dial_level[$i] * ($differential_mul + 1) )\n";
	$adaptive_string .= "      INTENSE DIFF: $intensity_pct\n";
	$adaptive_string .= "      INTENSE DL:   $intensity_dial_level = ($auto_dial_level[$i] * ($intensity_diff_mul + 1) )\n";
	if ($intensity_dial_level > $adaptive_maximum_level[$i])
		{
		$adaptive_string .= "      DIAL LEVEL OVER CAP! SETTING TO CAP: $adaptive_maximum_level[$i]\n";
		$intensity_dial_level = $adaptive_maximum_level[$i];
		}
	if ($intensity_dial_level < 1)
		{
		$adaptive_string .= "      DIAL LEVEL TOO LOW! SETTING TO 1\n";
		$intensity_dial_level = "1.0";
		}
	$adaptive_string .= "DROP STATS-\n";
	$adaptive_string .= "   TODAY DROPS:     $VCScalls_today   $VCSdrops_today   $VCSdrops_today_pct%\n";
	$adaptive_string .= "   ONE HOUR DROPS:  $VCScalls_hour   $VCSdrops_hour   $VCSdrops_hour_pct%\n";
	$adaptive_string .= "   HALF HOUR DROPS: $VCScalls_halfhour   $VCSdrops_halfhour   $VCSdrops_halfhour_pct%\n";
	$adaptive_string .= "   FIVE MIN DROPS:  $VCScalls_five   $VCSdrops_five   $VCSdrops_five_pct%\n";
	$adaptive_string .= "   ONE MIN DROPS:   $VCScalls_one   $VCSdrops_one   $VCSdrops_one_pct%\n";

	### DROP PERCENTAGE RULES TO LOWER DIAL_LEVEL ###
	if ( ($VCScalls_one > 20) && ($VCSdrops_one_pct > 50) )
		{
		$intensity_dial_level = ($intensity_dial_level / 2);
		$adaptive_string .= "      DROP RATE OVER 50% FOR LAST MINUTE! CUTTING DIAL LEVEL TO: $intensity_dial_level\n";
		}
	if ( ($VCScalls_today > 50) && ($VCSdrops_today_pct > $adaptive_dropped_percentage[$i]) )
		{
		if ($dial_method[$i] =~ /ADAPT_HARD_LIMIT/) 
			{
			$intensity_dial_level = "1.0";
			$adaptive_string .= "      DROP RATE OVER HARD LIMIT FOR TODAY! HARD DIAL LEVEL TO: 1.0\n";
			}
		if ($dial_method[$i] =~ /ADAPT_AVERAGE/) 
			{
			$intensity_dial_level = ($intensity_dial_level / 2);
			$adaptive_string .= "      DROP RATE OVER LIMIT FOR TODAY! AVERAGING DIAL LEVEL TO: $intensity_dial_level\n";
			}
		if ($dial_method[$i] =~ /ADAPT_TAPERED/) 
			{
			if ($tapered_hours_left < 0) 
				{
				$intensity_dial_level = "1.0";
				$adaptive_string .= "      DROP RATE OVER LAST HOUR LIMIT FOR TODAY! TAPERING DIAL LEVEL TO: 1.0\n";
				}
			else
				{
				$intensity_dial_level = ($intensity_dial_level * $tapered_rate);
				$adaptive_string .= "      DROP RATE OVER LIMIT FOR TODAY! TAPERING DIAL LEVEL TO: $intensity_dial_level\n";
				}
			}
		}

	### ALWAYS RAISE DIAL_LEVEL TO 1.0 IF IT IS LOWER ###
	if ($intensity_dial_level < 1)
		{
		$adaptive_string .= "      DIAL LEVEL TOO LOW! SETTING TO 1\n";
		$intensity_dial_level = "1.0";
		}

	if (!$TEST)
		{
		$stmtA = "UPDATE vicidial_campaigns SET auto_dial_level='$intensity_dial_level' where campaign_id='$campaign_id[$i]';";
		$Uaffected_rows = $dbhA->do($stmtA);
		}

	$adaptive_string .= "DIAL LEVEL UPDATED TO: $intensity_dial_level          CONFIRM: $Uaffected_rows\n";
	}

if ($DB) {print "campaign stats updated:  $campaign_id[$i]   $adaptive_string\n";}

	&adaptive_logger;
}
