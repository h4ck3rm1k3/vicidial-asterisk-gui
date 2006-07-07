#!/usr/bin/perl
#
# AST_VDhopper.pl version 0.9
#
# DESCRIPTION:
# uses Net::MySQL to update the VICIDIAL leads hopper for the new streamlined 
# approach of allocating leads to client machines. 
#
# SUMMARY:
# This program was designed for people using the Asterisk PBX with VICIDIAL
#
# For the client to use VICIDIAL, this program must be in the cron running 
# every minute
# 
# For this program to work you need to have the "asterisk" MySQL database 
# created and create the tables listed in the CONF_MySQL.txt file, also make sure
# that the machine running this program has read/write/update/delete access 
# to that database
# 
# It is recommended that you run this program on the local Asterisk machine
#
# If this script is run ever minute and you are getting close to no leads after
# a minute, you may want to play with the variables below to streamline for 
# your usage
#
# Copyright (C) 2006  Matt Florell <vicidial@gmail.com>    LICENSE: GPLv2
#
# 50810-1613 - Added database server variable definitions lookup
# 60215-1106 - Added Scheduled Callback release functionality
# 60228-1623 - Change Callback activation to set the called_since_last_reset=N
# 60228-1735 - Added hopper gmt validation to remove gmt outside of time range
# 60320-0932 - Added inactive lead list hopper deletion (Thanks Vic Jolin)
# 60322-1030 - Added super debug output
# 60418-0947 - Added lead filter per campaign
# 60509-1416 - Rewrite of local_call_time functions
# 60511-1150 - Added inserts into vicidial_campaign_stats table
# 60609-1451 - Added ability to filter by DNC list vicidial_dnc
# 60614-1159 - Added campaign lead recycling ability
#

# constants
$DB=0;  # Debug flag, set to 0 for no debug messages, On an active system this will generate lots of lines of output per minute
$US='__';
$MT[0]='';
#$vicidial_hopper='TEST_vicidial_hopper';	# for testing
$vicidial_hopper='vicidial_hopper';

# options
$insert_auto_CB_to_hopper	= 1; # set to 1 to automatically insert ANYONE callbacks into the hopper


($sec,$min,$hour,$mday,$mon,$year,$wday,$yday,$isdst) = localtime(time);
$year = ($year + 1900);
$mon++;
if ($mon < 10) {$mon = "0$mon";}
if ($mday < 10) {$mday = "0$mday";}
if ($hour < 10) {$Fhour = "0$hour";}
if ($min < 10) {$min = "0$min";}
if ($sec < 10) {$sec = "0$sec";}
$now_date = "$year-$mon-$mday $hour:$min:$sec";
$VDL_date = "$year-$mon-$mday 00:00:01";

if (!$VDHLOGfile) {$VDHLOGfile = "/home/cron/hopper.$year-$mon-$mday";}

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
	print "allowed run time options(must stay in this order):\n  [--debug] = debug\n  [--debugX] = super debug\n [--dbgmt] = show GMT offset of records as they are inserted into hopper\n  [-t] = test\n  [--level=XXX] = force a hopper_level of XXX\n  [--campaign=XXX] = run for campaign XXX only\n\n";
	}
	else
	{
		if ($args =~ /--campaign=/i)
		{
		#	print "\n|$ARGS|\n\n";
		@data_in = split(/--campaign=/,$args);
			$CLIcampaign = $data_in[1];
		}
		else
			{$CLIcampaign = '';}
		if ($args =~ /--level=/i)
		{
		@data_in = split(/--level=/,$args);
			$CLIlevel = $data_in[1];
			$CLIlevel =~ s/ .*$//gi;
			$CLIlevel =~ s/\D//gi;
		print "\n-----HOPPER LEVEL OVERRIDE: $CLIlevel -----\n\n";
		}
		else
			{$CLIlevel = '';}
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
		if ($args =~ /--dbgmt/i)
		{
		$DB_show_offset=1;
		print "\n-----DEBUG GMT -----\n\n";
		}
		if ($args =~ /-t/i)
		{
		$T=1;   $TEST=1;
		print "\n-----TESTING -----\n\n";
		}
		if ($args =~ /--wipe-hopper-clean/i)
		{
		$wipe_hopper_clean=1;
		}
	}
}
else
{
print "no command line options set\n";
}

### Make sure this file is in a libs path or put the absolute path to it
require("/home/cron/AST_SERVER_conf.pl");	# local configuration file

if (!$DB_port) {$DB_port='3306';}

sleep(1);	### sleep for 5 seconds to stagger cron script load

#use lib './lib', '../lib';
use Net::MySQL;
	  

	my $dbhA = Net::MySQL->new(hostname => "$DB_server", database => "$DB_database", user => "$DB_user", password => "$DB_pass", port => "$DB_port") 
	or 	die "Couldn't connect to database: $DB_server - $DB_database\n";

### Grab Server values from the database
$stmtA = "SELECT local_gmt FROM servers where server_ip = '$server_ip';";
$dbhA->query("$stmtA");
if ($dbhA->has_selected_record)
	{
	$iter=$dbhA->create_record_iterator;
	   while ( $record = $iter->each)
		{
		$DBSERVER_GMT		=		"$record->[0]";
		if (length($DBSERVER_GMT)>0)	{$SERVER_GMT = $DBSERVER_GMT;}
		} 
	}


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


	if ($DB) {print "TIME DEBUG: $LOCAL_GMT_OFF_STD|$LOCAL_GMT_OFF|$isdst|   GMT: $hour:$min\n";}

if ($wipe_hopper_clean)
	{
	$stmtA = "DELETE from $vicidial_hopper;";
	$dbhA->query("$stmtA");
	my $affected_rows = $dbhA->get_affected_rows_length;
	if ($DB) {print "Hopper Wiped Clean:  $affected_rows\n";}
		$event_string = "|HOPPER WIPE CLEAN|";
		&event_logger;

	exit;
	}

### Delete leads from inactive lists if there are any
$stmtA = "SELECT * FROM vicidial_lists where active='N';";
if ($DB) {print $stmtA;}
$inactive_lists='';
$inactive_lists_count=0;
$dbhA->query("$stmtA");
if ($dbhA->has_selected_record)
		{
		$iter=$dbhA->create_record_iterator;
		while ( $record = $iter->each)
			{
			$inactive_list = $record->[0];
			$inactive_lists .= "'$inactive_list',";
			$inactive_lists_count++;
			}
		}
if ($DB) {print "Inactive Lists:  $inactive_lists_count\n";}

if ($inactive_lists_count > 0)
	{
	chop($inactive_lists);
	$stmtA = "DELETE from $vicidial_hopper where list_id IN($inactive_lists);";
	$dbhA->query("$stmtA");
	my $affected_rows = $dbhA->get_affected_rows_length;
	if ($DB) {print "Inactive List Leads Deleted:  $affected_rows |$stmtA|\n";}
		$event_string = "|INACTIVE LIST DEL|$affected_rows|";
		&event_logger;
	}


### BEGIN Change CBHOLD status leads to CALLBK if their vicidial_callbacks time has passed
$stmtA = "SELECT count(*) FROM vicidial_callbacks where callback_time <= '$now_date' and status='ACTIVE';";
$dbhA->query("$stmtA");
if ($dbhA->has_selected_record)
	{
	$iter=$dbhA->create_record_iterator;
	while ( $record = $iter->each)
		{
		$CBHOLD_count = "$record->[0]";
		}
	}

	if ($DB) {print "CALLBACK HOLD: $CBHOLD_count|$stmtA|\n";}

if ($CBHOLD_count > 0)
	{
	$update_leads='';
	$stmtA = "SELECT vicidial_callbacks.lead_id,recipient,campaign_id,vicidial_callbacks.list_id,gmt_offset_now FROM vicidial_callbacks,vicidial_list where callback_time <= '$now_date' and vicidial_callbacks.status='ACTIVE' and vicidial_callbacks.lead_id=vicidial_list.lead_id;";
	$dbhA->query("$stmtA");
	if ($dbhA->has_selected_record)
		{
		$iter=$dbhA->create_record_iterator;
		$cbc=0;
		$cba=0;
		while ( $record = $iter->each)
			{
			$lead_ids[$cbc] = $record->[0];
			$recipient = $record->[1];
			$update_leads .= "'$lead_ids[$cbc]',";
			if ($recipient == 'ANYONE')
				{
				$CA_lead_id[$cba] = $record->[0];
				$CA_campaign_id[$cba] = $record->[2];
				$CA_list_id[$cba] = $record->[3];
				$CA_gmt_offset_now[$cba] = $record->[4];
				$cba++;
				}
			$cbc++;
			}
		}
	if ($cbc > 0)
		{
		chop($update_leads);

		$stmtA = "UPDATE vicidial_list set status='CALLBK', called_since_last_reset='N' where lead_id IN($update_leads);";
		$dbhA->query("$stmtA");
		my $affected_rows = $dbhA->get_affected_rows_length;
		if ($DB) {print "Scheduled Callbacks Activated:  $affected_rows\n";}
			$event_string = "|CALLBACKS LISTACT|$affected_rows|";
			&event_logger;

		$stmtA = "UPDATE vicidial_callbacks set status='LIVE' where lead_id IN($update_leads);";
		$dbhA->query("$stmtA");
		my $affected_rows = $dbhA->get_affected_rows_length;
		if ($DB) {print "Scheduled Callbacks Activated:  $affected_rows\n";}
			$event_string = "|CALLBACKS CB ACT |$affected_rows|";
			&event_logger;

		}
	### INSERT ANYONE CALLBACKS INTO HOPPER DIRECTLY ###
	if ( ($cba > 0) && ($insert_auto_CB_to_hopper) )
		{
		if ($DB) {print "ANYONE Scheduled Callbacks Inserted into hopper:  $cba\n";}
			$event_string = "|ANYONE CB HOPPER |$cba|";
			&event_logger;
		$CAu=0;
		foreach(@CA_lead_id)
			{
			$stmtA = "INSERT INTO $vicidial_hopper SET lead_id='$CA_lead_id[$CAu]',campaign_id='$CA_campaign_id[$CAu]',list_id='$CA_list_id[$CAu]',gmt_offset_now='$CA_gmt_offset_now[$CAu]';";
			$dbhA->query("$stmtA");
			$CAu++;
			}
		}
	}
### END Change CBHOLD status leads to CALLBK if their vicidial_callbacks time has passed



@campaign_id=@MT; 

if ($CLIcampaign)
	{
	$stmtA = "SELECT * from vicidial_campaigns where campaign_id='$CLIcampaign'";
	}
else
	{
	$stmtA = "SELECT * from vicidial_campaigns where active='Y'";
	}

$dbhA->query("$stmtA");
if ($dbhA->has_selected_record)
   {
	$iter=$dbhA->create_record_iterator;
	$rec_count=0;
	while ( $record = $iter->each)
		{
		$campaign_id[$rec_count] =		 "$record->[0]";
		$dial_status_a[$rec_count] =	 "$record->[3]";
		$dial_status_b[$rec_count] =	 "$record->[4]";
		$dial_status_c[$rec_count] =	 "$record->[5]";
		$dial_status_d[$rec_count] =	 "$record->[6]";
		$dial_status_e[$rec_count] =	 "$record->[7]";
		$lead_order[$rec_count] =		 "$record->[8]";
		if (!$CLIlevel) 
			{$hopper_level[$rec_count] = "$record->[13]";}
		else
			{$hopper_level[$rec_count] = "$CLIlevel";}
		$local_call_time[$rec_count] =	 "$record->[16]";
		$lead_filter_id[$rec_count] =	 "$record->[35]";
		$use_internal_dnc[$rec_count] =	 "$record->[43]";
		$rec_count++;
		}
   }

$i=0;
foreach(@campaign_id)
	{
	### close out MySQL connection and re-connect to start new connection ###
#	$dbhA->close();
#	my $dbhA = '';

	### Make sure this file is in a libs path or put the absolute path to it
#	require("/home/cron/AST_SERVER_conf.pl");	# local configuration file
#	if (!$DB_port) {$DB_port='3306';}
#	use Net::MySQL;

#	my $dbhA = Net::MySQL->new(hostname => "$DB_server", database => "$DB_database", user => "$DB_user", password => "$DB_pass", port => "$DB_port") 
#	or 	die "Couldn't connect to database: $DB_server - $DB_database\n";


	$VCSdialable_leads=0;
	$VCScalls_today=0;
	$VCSdrops_today=0;
	$VCSdrops_today_pct=0;
	$vicidial_log = 'vicidial_log';

	$stmtA = "SELECT dialable_leads from vicidial_campaign_stats where campaign_id='$campaign_id[$i]';";
	$dbhA->query("$stmtA");
	if ($dbhA->has_selected_record)
	   {
		$iter=$dbhA->create_record_iterator;
		$rec_count=0;
		while ( $record = $iter->each)
			{
			$VCSdialable_leads =		 "$record->[0]";
			}
	   }
	$stmtA = "SELECT count(*) from $vicidial_log where campaign_id='$campaign_id[$i]' and call_date > '$VDL_date';";
	$dbhA->query("$stmtA");
	if ($dbhA->has_selected_record)
	   {
		$iter=$dbhA->create_record_iterator;
		$rec_count=0;
		while ( $record = $iter->each)
			{
			$VCScalls_today =		 "$record->[0]";
			}
	   }
	if ($VCScalls_today > 0)
		{
		$stmtA = "SELECT count(*) from $vicidial_log where campaign_id='$campaign_id[$i]' and call_date > '$VDL_date' and status IN('DROP','XDROP');";
		$dbhA->query("$stmtA");
		if ($dbhA->has_selected_record)
		   {
			$iter=$dbhA->create_record_iterator;
			$rec_count=0;
			while ( $record = $iter->each)
				{
				$VCSdrops_today =		 "$record->[0]";
				if ($VCSdrops_today > 0)
					{
					$VCSdrops_today_pct = ( ($VCSdrops_today / $VCScalls_today) * 100 );
					$VCSdrops_today_pct = sprintf("%.2f", $VCSdrops_today_pct);	
					}
				}
		   }
		}

	$stmtA = "UPDATE vicidial_campaign_stats SET calls_today='$VCScalls_today',drops_today='$VCSdrops_today',drops_today_pct='$VCSdrops_today_pct' where campaign_id='$campaign_id[$i]';";
	$dbhA->query("$stmtA");

	##### BEGIN calculate what gmt_offset_now values are within the allowed local_call_time setting ###
	$g=0;
	$p='13';
	$GMT_gmt[0] = '';
	$GMT_hour[0] = '';
	$GMT_day[0] = '';
		if ($DBX) {print "\n   |GMT-DAY-HOUR|   ";}
	while ($p > -13)
		{
		$pzone = ($GMT_now + ($p * 3600));
			($psec,$pmin,$phour,$pmday,$pmon,$pyear,$pday,$pyday,$pisdst) = localtime($pzone);
		$phour=($phour * 100);
		$tz = sprintf("%.2f", $p);	
		$GMT_gmt[$g] = "$tz";
		$GMT_day[$g] = "$pday";
		$GMT_hour[$g] = ($phour + $pmin);
		$p = ($p - 0.25);
			if ($DBX) {print "|$GMT_gmt[$g]-$GMT_day[$g]-$GMT_hour[$g]|";}
		$g++;
		}
		if ($DBX) {print "\n";}

	$stmtA = "SELECT * FROM vicidial_call_times where call_time_id='$local_call_time[$i]';";
		if ($DBX) {print "   |$stmtA|\n";}
	$dbhA->query("$stmtA");
	if ($dbhA->has_selected_record)
		{
		$iter=$dbhA->create_record_iterator;
		while ( $record = $iter->each)
			{
			$Gct_default_start =	"$record->[3]";
			$Gct_default_stop =		"$record->[4]";
			$Gct_sunday_start =		"$record->[5]";
			$Gct_sunday_stop =		"$record->[6]";
			$Gct_monday_start =		"$record->[7]";
			$Gct_monday_stop =		"$record->[8]";
			$Gct_tuesday_start =	"$record->[9]";
			$Gct_tuesday_stop =		"$record->[10]";
			$Gct_wednesday_start =	"$record->[11]";
			$Gct_wednesday_stop =	"$record->[12]";
			$Gct_thursday_start =	"$record->[13]";
			$Gct_thursday_stop =	"$record->[14]";
			$Gct_friday_start =		"$record->[15]";
			$Gct_friday_stop =		"$record->[16]";
			$Gct_saturday_start =	"$record->[17]";
			$Gct_saturday_stop =	"$record->[18]";
			$Gct_state_call_times = "$record->[19]";
			}
		}

	$ct_states = '';
	$ct_state_gmt_SQL = '';
	$del_state_gmt_SQL = '';
	$ct_srs=0;
	$b=0;
	if (length($Gct_state_call_times)>2)
		{
		@state_rules = split(/\|/,$Gct_state_call_times);
		$ct_srs = ($#state_rules - 2);
		}
	while($ct_srs >= $b)
		{
		if (length($state_rules[$b])>1)
			{
			$stmtA = "SELECT * from vicidial_state_call_times where state_call_time_id='$state_rules[$b]';";
				if ($DBX) {print "   |$stmtA|\n";}
			$dbhA->query("$stmtA");
			if ($dbhA->has_selected_record)
				{
				$iter=$dbhA->create_record_iterator;
				while ( $record = $iter->each)
					{
					$Gstate_call_time_id =		"$record->[0]";
					$Gstate_call_time_state =	"$record->[1]";
					$Gsct_default_start =		"$record->[4]";
					$Gsct_default_stop =		"$record->[5]";
					$Gsct_sunday_start =		"$record->[6]";
					$Gsct_sunday_stop =			"$record->[7]";
					$Gsct_monday_start =		"$record->[8]";
					$Gsct_monday_stop =			"$record->[9]";
					$Gsct_tuesday_start =		"$record->[10]";
					$Gsct_tuesday_stop =		"$record->[11]";
					$Gsct_wednesday_start =		"$record->[12]";
					$Gsct_wednesday_stop =		"$record->[13]";
					$Gsct_thursday_start =		"$record->[14]";
					$Gsct_thursday_stop =		"$record->[15]";
					$Gsct_friday_start =		"$record->[16]";
					$Gsct_friday_stop =			"$record->[17]";
					$Gsct_saturday_start =		"$record->[18]";
					$Gsct_saturday_stop =		"$record->[19]";
					$ct_states .="'$Gstate_call_time_state',";
					}
				}

			$r=0;
			$state_gmt='';
			$del_state_gmt='';
			while($r < $g)
				{
				if ($GMT_day[$r]==0)	#### Sunday local time
					{
					if (($Gsct_sunday_start==0) and ($Gsct_sunday_stop==0))
						{
						if ( ($GMT_hour[$r]>=$Gsct_default_start) and ($GMT_hour[$r]<$Gsct_default_stop) )
							{$state_gmt.="'$GMT_gmt[$r]',";}
						else
							{$del_state_gmt.="'$GMT_gmt[$r]',";}
						}
					else
						{
						if ( ($GMT_hour[$r]>=$Gsct_sunday_start) and ($GMT_hour[$r]<$Gsct_sunday_stop) )
							{$state_gmt.="'$GMT_gmt[$r]',";}
						else
							{$del_state_gmt.="'$GMT_gmt[$r]',";}
						}
					}
				if ($GMT_day[$r]==1)	#### Monday local time
					{
					if (($Gsct_monday_start==0) and ($Gsct_monday_stop==0))
						{
						if ( ($GMT_hour[$r]>=$Gsct_default_start) and ($GMT_hour[$r]<$Gsct_default_stop) )
							{$state_gmt.="'$GMT_gmt[$r]',";}
						else
							{$del_state_gmt.="'$GMT_gmt[$r]',";}
						}
					else
						{
						if ( ($GMT_hour[$r]>=$Gsct_monday_start) and ($GMT_hour[$r]<$Gsct_monday_stop) )
							{$state_gmt.="'$GMT_gmt[$r]',";}
						else
							{$del_state_gmt.="'$GMT_gmt[$r]',";}
						}
					}
				if ($GMT_day[$r]==2)	#### Tuesday local time
					{
					if (($Gsct_tuesday_start==0) and ($Gsct_tuesday_stop==0))
						{
						if ( ($GMT_hour[$r]>=$Gsct_default_start) and ($GMT_hour[$r]<$Gsct_default_stop) )
							{$state_gmt.="'$GMT_gmt[$r]',";}
						else
							{$del_state_gmt.="'$GMT_gmt[$r]',";}
						}
					else
						{
						if ( ($GMT_hour[$r]>=$Gsct_tuesday_start) and ($GMT_hour[$r]<$Gsct_tuesday_stop) )
							{$state_gmt.="'$GMT_gmt[$r]',";}
						else
							{$del_state_gmt.="'$GMT_gmt[$r]',";}
						}
					}
				if ($GMT_day[$r]==3)	#### Wednesday local time
					{
					if (($Gsct_wednesday_start==0) and ($Gsct_wednesday_stop==0))
						{
						if ( ($GMT_hour[$r]>=$Gsct_default_start) and ($GMT_hour[$r]<$Gsct_default_stop) )
							{$state_gmt.="'$GMT_gmt[$r]',";}
						else
							{$del_state_gmt.="'$GMT_gmt[$r]',";}
						}
					else
						{
						if ( ($GMT_hour[$r]>=$Gsct_wednesday_start) and ($GMT_hour[$r]<$Gsct_wednesday_stop) )
							{$state_gmt.="'$GMT_gmt[$r]',";}
						else
							{$del_state_gmt.="'$GMT_gmt[$r]',";}
						}
					}
				if ($GMT_day[$r]==4)	#### Thursday local time
					{
					if (($Gsct_thursday_start==0) and ($Gsct_thursday_stop==0))
						{
						if ( ($GMT_hour[$r]>=$Gsct_default_start) and ($GMT_hour[$r]<$Gsct_default_stop) )
							{$state_gmt.="'$GMT_gmt[$r]',";}
						else
							{$del_state_gmt.="'$GMT_gmt[$r]',";}
						}
					else
						{
						if ( ($GMT_hour[$r]>=$Gsct_thursday_start) and ($GMT_hour[$r]<$Gsct_thursday_stop) )
							{$state_gmt.="'$GMT_gmt[$r]',";}
						else
							{$del_state_gmt.="'$GMT_gmt[$r]',";}
						}
					}
				if ($GMT_day[$r]==5)	#### Friday local time
					{
					if (($Gsct_friday_start==0) and ($Gsct_friday_stop==0))
						{
						if ( ($GMT_hour[$r]>=$Gsct_default_start) and ($GMT_hour[$r]<$Gsct_default_stop) )
							{$state_gmt.="'$GMT_gmt[$r]',";}
						else
							{$del_state_gmt.="'$GMT_gmt[$r]',";}
						}
					else
						{
						if ( ($GMT_hour[$r]>=$Gsct_friday_start) and ($GMT_hour[$r]<$Gsct_friday_stop) )
							{$state_gmt.="'$GMT_gmt[$r]',";}
						else
							{$del_state_gmt.="'$GMT_gmt[$r]',";}
						}
					}
				if ($GMT_day[$r]==6)	#### Saturday local time
					{
					if (($Gsct_saturday_start==0) and ($Gsct_saturday_stop==0))
						{
						if ( ($GMT_hour[$r]>=$Gsct_default_start) and ($GMT_hour[$r]<$Gsct_default_stop) )
							{$state_gmt.="'$GMT_gmt[$r]',";}
						else
							{$del_state_gmt.="'$GMT_gmt[$r]',";}
						}
					else
						{
						if ( ($GMT_hour[$r]>=$Gsct_saturday_start) and ($GMT_hour[$r]<$Gsct_saturday_stop) )
							{$state_gmt.="'$GMT_gmt[$r]',";}
						else
							{$del_state_gmt.="'$GMT_gmt[$r]',";}
						}
					}
				$r++;
				}
			$state_gmt = "$state_gmt'99'";
			$del_state_gmt = "$del_state_gmt'99'";
			$ct_state_gmt_SQL .= "or (state='$Gstate_call_time_state' and gmt_offset_now IN($state_gmt)) ";
			$del_state_gmt_SQL .= "or (state='$Gstate_call_time_state' and gmt_offset_now IN($del_state_gmt)) ";
			}

		$b++;
		}
	if (length($ct_states)>2)
		{
		$ct_states =~ s/,$//gi;
		$ct_statesSQL = "and state NOT IN($ct_states)";
		}
	else
		{
		$ct_statesSQL = "";
		}

	$r=0;
	$default_gmt='';
	$del_default_gmt='';
	while($r < $g)
		{
		if ($GMT_day[$r]==0)	#### Sunday local time
			{
			if (($Gct_sunday_start==0) and ($Gct_sunday_stop==0))
				{
				if ( ($GMT_hour[$r]>=$Gct_default_start) and ($GMT_hour[$r]<$Gct_default_stop) )
					{$default_gmt.="'$GMT_gmt[$r]',";}
				else
					{$del_default_gmt.="'$GMT_gmt[$r]',";}
				}
			else
				{
				if ( ($GMT_hour[$r]>=$Gct_sunday_start) and ($GMT_hour[$r]<$Gct_sunday_stop) )
					{$default_gmt.="'$GMT_gmt[$r]',";}
				else
					{$del_default_gmt.="'$GMT_gmt[$r]',";}
				}
			}
		if ($GMT_day[$r]==1)	#### Monday local time
			{
			if (($Gct_monday_start==0) and ($Gct_monday_stop==0))
				{
				if ( ($GMT_hour[$r]>=$Gct_default_start) and ($GMT_hour[$r]<$Gct_default_stop) )
					{$default_gmt.="'$GMT_gmt[$r]',";}
				else
					{$del_default_gmt.="'$GMT_gmt[$r]',";}
				}
			else
				{
				if ( ($GMT_hour[$r]>=$Gct_monday_start) and ($GMT_hour[$r]<$Gct_monday_stop) )
					{$default_gmt.="'$GMT_gmt[$r]',";}
				else
					{$del_default_gmt.="'$GMT_gmt[$r]',";}
				}
			}
		if ($GMT_day[$r]==2)	#### Tuesday local time
			{
			if (($Gct_tuesday_start==0) and ($Gct_tuesday_stop==0))
				{
				if ( ($GMT_hour[$r]>=$Gct_default_start) and ($GMT_hour[$r]<$Gct_default_stop) )
					{$default_gmt.="'$GMT_gmt[$r]',";}
				else
					{$del_default_gmt.="'$GMT_gmt[$r]',";}
				}
			else
				{
				if ( ($GMT_hour[$r]>=$Gct_tuesday_start) and ($GMT_hour[$r]<$Gct_tuesday_stop) )
					{$default_gmt.="'$GMT_gmt[$r]',";}
				else
					{$del_default_gmt.="'$GMT_gmt[$r]',";}
				}
			}
		if ($GMT_day[$r]==3)	#### Wednesday local time
			{
			if (($Gct_wednesday_start==0) and ($Gct_wednesday_stop==0))
				{
				if ( ($GMT_hour[$r]>=$Gct_default_start) and ($GMT_hour[$r]<$Gct_default_stop) )
					{$default_gmt.="'$GMT_gmt[$r]',";}
				else
					{$del_default_gmt.="'$GMT_gmt[$r]',";}
				}
			else
				{
				if ( ($GMT_hour[$r]>=$Gct_wednesday_start) and ($GMT_hour[$r]<$Gct_wednesday_stop) )
					{$default_gmt.="'$GMT_gmt[$r]',";}
				else
					{$del_default_gmt.="'$GMT_gmt[$r]',";}
				}
			}
		if ($GMT_day[$r]==4)	#### Thursday local time
			{
			if (($Gct_thursday_start==0) and ($Gct_thursday_stop==0))
				{
				if ( ($GMT_hour[$r]>=$Gct_default_start) and ($GMT_hour[$r]<$Gct_default_stop) )
					{$default_gmt.="'$GMT_gmt[$r]',";}
				else
					{$del_default_gmt.="'$GMT_gmt[$r]',";}
				}
			else
				{
				if ( ($GMT_hour[$r]>=$Gct_thursday_start) and ($GMT_hour[$r]<$Gct_thursday_stop) )
					{$default_gmt.="'$GMT_gmt[$r]',";}
				else
					{$del_default_gmt.="'$GMT_gmt[$r]',";}
				}
			}
		if ($GMT_day[$r]==5)	#### Friday local time
			{
			if (($Gct_friday_start==0) and ($Gct_friday_stop==0))
				{
				if ( ($GMT_hour[$r]>=$Gct_default_start) and ($GMT_hour[$r]<$Gct_default_stop) )
					{$default_gmt.="'$GMT_gmt[$r]',";}
				else
					{$del_default_gmt.="'$GMT_gmt[$r]',";}
				}
			else
				{
				if ( ($GMT_hour[$r]>=$Gct_friday_start) and ($GMT_hour[$r]<$Gct_friday_stop) )
					{$default_gmt.="'$GMT_gmt[$r]',";}
				else
					{$del_default_gmt.="'$GMT_gmt[$r]',";}
				}
			}
		if ($GMT_day[$r]==6)	#### Saturday local time
			{
			if (($Gct_saturday_start==0) and ($Gct_saturday_stop==0))
				{
				if ( ($GMT_hour[$r]>=$Gct_default_start) and ($GMT_hour[$r]<$Gct_default_stop) )
					{$default_gmt.="'$GMT_gmt[$r]',";}
				else
					{$del_default_gmt.="'$GMT_gmt[$r]',";}
				}
			else
				{
				if ( ($GMT_hour[$r]>=$Gct_saturday_start) and ($GMT_hour[$r]<$Gct_saturday_stop) )
					{$default_gmt.="'$GMT_gmt[$r]',";}
				else
					{$del_default_gmt.="'$GMT_gmt[$r]',";}
				}
			}
		$r++;
		}

	$default_gmt = "$default_gmt'99'";
	$del_default_gmt = "$del_default_gmt'99'";
	$all_gmtSQL = "(gmt_offset_now IN($default_gmt) $ct_statesSQL) $ct_state_gmt_SQL";
	$del_gmtSQL = "(gmt_offset_now IN($del_default_gmt) $ct_statesSQL) $del_state_gmt_SQL";

	##### END calculate what gmt_offset_now values are within the allowed local_call_time setting ###

	##### BEGIN lead recycling parsing and prep ###

	$stmtA = "SELECT * from vicidial_lead_recycle where campaign_id='$campaign_id[$i]' and active='Y';";
	$dbhA->query("$stmtA");
	$rec_ct=0;
	if ($dbhA->has_selected_record)
		{
		@recycle_status=@MT;
		@recycle_delay=@MT;
		@recycle_maximum=@MT;
		@RSQLdate=@MT;
		$iter=$dbhA->create_record_iterator;
		while ( $record = $iter->each)
			{
			$recycle_status[$rec_ct] =		 $record->[2];
			$recycle_delay[$rec_ct] =		 $record->[3];
			$recycle_maximum[$rec_ct] =		 $record->[4];
			$rec_ct++;
			}
		}

	if ($rec_ct > 0)
		{
		$rc=0;
		$recycle_SQL = "( ";
		while($rc < $rec_ct)
			{
			$secX = time();
			$Rtarget = ($secX - $recycle_delay[$rc]);
			($Rsec,$Rmin,$Rhour,$Rmday,$Rmon,$Ryear,$Rwday,$Ryday,$Risdst) = localtime($Rtarget);
			$Ryear = ($Ryear + 1900);
			$Rmon++;
			if ($Rmon < 10) {$Rmon = "0$Rmon";}
			if ($Rmday < 10) {$Rmday = "0$Rmday";}
			if ($Rhour < 10) {$Rhour = "0$Rhour";}
			if ($Rmin < 10) {$Rmin = "0$Rmin";}
			if ($Rsec < 10) {$Rsec = "0$Rsec";}
				$RSQLdate[$rc] = "$Ryear-$Rmon-$Rmday $Rhour:$Rmin:$Rsec";
			$Y=1;
			$recycle_Y = "'Y'";
			while ($Y < $recycle_maximum[$rc])
				{
				$recycle_Y .= ",'Y$Y'";
				$Y++;
				}
			
			if ($rc > 0) {$recycle_SQL .= " or ";}

			$recycle_SQL .= "( (called_since_last_reset IN($recycle_Y)) and (status='$recycle_status[$rc]') and (modify_date < \"$RSQLdate[$rc]\") )";

			if ($DBX) {print "RECYCLE: |$campaign_id[$i]|$recycle_status[$rc]|$recycle_delay[$rc]|$recycle_maximum[$rc]|$RSQLdate[$rc]|\n";}
			$rc++;
			}

		$recycle_SQL .= " )";

		if ($DBX) {print "RECYCLE SQL: |$recycle_SQL|\n";}
		}
	##### END lead recycling parsing and prep ###

	if ($DB) {print "Starting hopper run for $campaign_id[$i] campaign- GMT: $local_call_time[$i]   HOPPER: $hopper_level[$i] \n";}

	### Delete the DONE leads if there are any
	$stmtA = "DELETE from $vicidial_hopper where campaign_id='$campaign_id[$i]' and status IN('DONE');";
	$dbhA->query("$stmtA");
	my $affected_rows = $dbhA->get_affected_rows_length;
	if ($DB) {print "     hopper DONE cleared:  $affected_rows\n";}
	if ($DBX) {print "     |$stmtA|\n";}

	### Delete the leads that are out of GMT time range if there are any
	$stmtA = "DELETE from $vicidial_hopper where campaign_id='$campaign_id[$i]' and ($del_gmtSQL);";
	$dbhA->query("$stmtA");
	my $affected_rows = $dbhA->get_affected_rows_length;
	if ($DB) {print "     hopper GMT BAD cleared:  $affected_rows\n";}
	if ($DBX) {print "     |$stmtA|\n";}

 	### Find out how many leads are in the hopper from a specific campaign
	$hopper_ready_count=0;
	$stmtA = "SELECT count(*) from $vicidial_hopper where campaign_id='$campaign_id[$i]' and status='READY';";
	$dbhA->query("$stmtA");
	if ($dbhA->has_selected_record)
		{
		$iter=$dbhA->create_record_iterator;
		$rec_countA=0;
		while ( $record = $iter->each)
			{
			$hopper_ready_count = $record->[0];
			if ($DB) {print "     hopper READY count:   $hopper_ready_count\n";}
			if ($DBX) {print "     |$stmtA|\n";}
			$rec_countA++;
			}
		}
		$event_string = "|$campaign_id[$i]|$hopper_level[$i]|$hopper_ready_count|$local_call_time[$i]||";
		&event_logger;

	##### IF hopper level is below set minimum, then try to add more leads #####
	if ($hopper_ready_count < $hopper_level[$i])
		{
		if ($DB) {print "     hopper too low ($hopper_ready_count|$hopper_level[$i]) starting hopper dump\n";}

		### Get list of the lists in the campaign ###
		$stmtA = "SELECT list_id FROM vicidial_lists where campaign_id='$campaign_id[$i]' and active='Y';";
		$dbhA->query("$stmtA");
		if ($dbhA->has_selected_record)
			{
			$iter=$dbhA->create_record_iterator;
			 $rec_countLISTS=0;
			 $camp_lists = '';
			while ( $record = $iter->each)
				{
				   $camp_lists .= "'$record->[0]',";
				$rec_countLISTS++;
				} 
			chop($camp_lists);
			}
		if ($DB) {print "     campaign lists count: $rec_countLISTS | $camp_lists\n";}
		if ($DBX) {print "     |$stmtA|\n";}

		if ( ($lead_filter_id[$i] !~ /NONE/) && (length($lead_filter_id[$i])>0) )
			{
			### Get SQL of lead filter for the campaign ###
			$stmtA = "SELECT lead_filter_sql FROM vicidial_lead_filters where lead_filter_id='$lead_filter_id[$i]';";
			$dbhA->query("$stmtA");
			if ($dbhA->has_selected_record)
				{
				$iter=$dbhA->create_record_iterator;
				while ( $record = $iter->each)
					{
					$lead_filter_sql[$i] = "$record->[0]";
					} 
				}
			$lead_filter_sql[$i] =~ s/^and|and$|^or|or$|^ and|and $|^ or|or $//gi;
			$lead_filter_sql[$i] = "and $lead_filter_sql[$i]";
			if ($DB) {print "     campaign lists count: $rec_countLISTS | $camp_lists\n";}
			if ($DB) {print "     lead filter $lead_filter_id[$i] defined for $campaign_id[$i]\n";}
			if ($DBX) {print "     |$lead_filter_sql[$i]|\n";}
			}
		else
			{
			$lead_filter_sql[$i] = '';
			if ($DB) {print "     no lead filter defined for campaign: $campaign_id[$i]\n";}
			if ($DBX) {print "     |$lead_filter_id[$i]|\n";}
			}

		$stmtA = "SELECT count(*) FROM vicidial_list where called_since_last_reset='N' and status IN('$dial_status_a[$i]','$dial_status_b[$i]','$dial_status_c[$i]','$dial_status_d[$i]','$dial_status_e[$i]') and list_id IN($camp_lists) and ($all_gmtSQL) $lead_filter_sql[$i];";
			if ($DBX) {print "     |$stmtA|\n";}
		$dbhA->query("$stmtA");
		$campaign_leads_to_call=0;
		if ($dbhA->has_selected_record)
			{
			$iter=$dbhA->create_record_iterator;
			while ( $record = $iter->each)
				{
				$campaign_leads_to_call = "$record->[0]";
				if ($DB) {print "     leads to call count:  $campaign_leads_to_call\n";}
				if ($DBX) {print "     |$stmtA|\n";}
				} 
			}
		if ($lead_order[$i] =~ /DOWN COUNT 2nd NEW|DOWN COUNT 3rd NEW|DOWN COUNT 4th NEW/)
			{
			$stmtA = "SELECT count(*) FROM vicidial_list where called_since_last_reset='N' and status IN('NEW') and list_id IN($camp_lists) and ($all_gmtSQL) $lead_filter_sql[$i];";
			$dbhA->query("$stmtA");
			$NEW_campaign_leads_to_call=0;
			if ($dbhA->has_selected_record)
				{
				$iter=$dbhA->create_record_iterator;
				while ( $record = $iter->each)
					{
					$NEW_campaign_leads_to_call = "$record->[0]";
					if ($DB) {print "     NEW leads to call count:  $NEW_campaign_leads_to_call\n";}
					if ($DBX) {print "     |$stmtA|\n";}
					} 
				}
			}

		##### IF no NEW leads to be called, error out of this campaign #####
		if ( ($lead_order[$i] =~ /DOWN COUNT 2nd NEW|DOWN COUNT 3rd NEW|DOWN COUNT 4th NEW/) && ($NEW_campaign_leads_to_call > 0) ) {$GOOD=1;}
		else
			{
			if ($DB) {print "     ERROR CANNOT ADD ANY NEW LEADS TO HOPPER\n";}
			}

		##### IF no leads to be called, error out of this campaign #####
		if ($campaign_leads_to_call < 1)
			{
			if ($DB) {print "     ERROR CANNOT ADD ANY LEADS TO HOPPER\n";}
			if ($VCSdialable_leads > 0)
				{
				$stmtA = "UPDATE vicidial_campaign_stats SET dialable_leads='0' where campaign_id='$campaign_id[$i]';";
				$dbhA->query("$stmtA");
				}
			}
		else
			{
			if ($VCSdialable_leads != $campaign_leads_to_call)
				{
				$stmtA = "UPDATE vicidial_campaign_stats SET dialable_leads='$campaign_leads_to_call' where campaign_id='$campaign_id[$i]';";
				$dbhA->query("$stmtA");
				}
			if ($DB) {print "     Getting Leads to add to hopper\n";}
			### grab leads already in hopper so we don't duplicate
			$stmtA = "SELECT lead_id FROM $vicidial_hopper where campaign_id='$campaign_id[$i]';";
			if ($DBX) {print "     |$stmtA|\n";}
			$dbhA->query("$stmtA");
			 $rec_countLISTS=0;
			 $lead_id_lists = '';
			if ($dbhA->has_selected_record)
				{
				$iter=$dbhA->create_record_iterator;
				while ( $record = $iter->each)
					{
					   $lead_id_lists .= "'$record->[0]',";
					$rec_countLISTS++;
					} 
				$lead_id_lists .= "'0'";
				}
			
				$order_stmt='';
				$NEW_count = 0;
				$NEW_level = 0;
				$OTHER_level = $hopper_level[$i];   
				if ($lead_order[$i] eq "DOWN") {$order_stmt = 'order by lead_id asc';}
				if ($lead_order[$i] eq "UP") {$order_stmt = 'order by lead_id desc';}
				if ($lead_order[$i] eq "UP LAST NAME") {$order_stmt = 'order by last_name desc, lead_id asc';}
				if ($lead_order[$i] eq "DOWN LAST NAME") {$order_stmt = 'order by last_name, lead_id asc';}
				if ($lead_order[$i] eq "UP PHONE") {$order_stmt = 'order by phone_number desc, lead_id asc';}
				if ($lead_order[$i] eq "DOWN PHONE") {$order_stmt = 'order by phone_number, lead_id asc';}
				if ($lead_order[$i] eq "UP COUNT") {$order_stmt = 'order by called_count desc, lead_id asc';}
				if ($lead_order[$i] eq "DOWN COUNT") {$order_stmt = 'order by called_count, lead_id asc';}
				if ($lead_order[$i] eq "DOWN COUNT 2nd NEW") {$NEW_count = 2;}
				if ($lead_order[$i] eq "DOWN COUNT 3rd NEW") {$NEW_count = 3;}
				if ($lead_order[$i] eq "DOWN COUNT 4th NEW") {$NEW_count = 4;}

			### BEGIN recycle grab leads ###
				if ($rec_ct > 0)
					{
					if ($DB) {print "     looking for RECYCLE leads, maximum of 100\n";}

					$stmtA = "SELECT lead_id,list_id,gmt_offset_now,phone_number,state FROM vicidial_list where $recycle_SQL and list_id IN($camp_lists) and lead_id NOT IN($lead_id_lists) and ($all_gmtSQL) $lead_filter_sql[$i] limit 100;";
					if ($DBX) {print "     |$stmtA|\n";}
					 $REC_rec_countLEADS=0;
					 @REC_leads_to_hopper=@MT;
					 @REC_lists_to_hopper=@MT;
					 @REC_phone_to_hopper=@MT;
					$dbhA->query("$stmtA");
					if ($dbhA->has_selected_record)
						{
						$iter=$dbhA->create_record_iterator;
						while ( $record = $iter->each)
							{
							$REC_leads_to_hopper[$REC_rec_countLEADS] = "$record->[0]";
							$REC_lists_to_hopper[$REC_rec_countLEADS] = "$record->[1]";
							$REC_gmt_to_hopper[$REC_rec_countLEADS] = "$record->[2]";
							$REC_phone_to_hopper[$REC_rec_countLEADS] = "$record->[3]";
							$REC_state_to_hopper[$REC_rec_countLEADS] = "$record->[4]";
							if ($DB_show_offset) {print "LEAD_ADD: $record->[2] $record->[3] $record->[4]\n";}
							$REC_rec_countLEADS++;
							}
						}
					if ($DB) {print "     RECYCLE leads to call count:  $REC_rec_countLEADS\n";}
					if ($DBX) {print "     |$stmtA|\n";}
					}
			### END recycle grab leads ###

				if ($NEW_count > 0)
					{
					$NEW_level = int($hopper_level[$i] / $NEW_count);   
					$OTHER_level = ($hopper_level[$i] - $NEW_level);   
					$order_stmt = 'order by called_count, lead_id asc';
					if ($DB) {print "     looking for $NEW_level NEW leads mixed in with $OTHER_level other leads\n";}

					$stmtA = "SELECT lead_id,list_id,gmt_offset_now,phone_number,state FROM vicidial_list where called_since_last_reset='N' and status IN('NEW') and list_id IN($camp_lists) and lead_id NOT IN($lead_id_lists) and ($all_gmtSQL) $lead_filter_sql[$i] $order_stmt limit $NEW_level;";
					if ($DBX) {print "     |$stmtA|\n";}
					$dbhA->query("$stmtA");
					if ($dbhA->has_selected_record)
						{
						$iter=$dbhA->create_record_iterator;
						 $NEW_rec_countLEADS=0;
						 @NEW_leads_to_hopper=@MT;
						 @NEW_lists_to_hopper=@MT;
						 @NEW_phone_to_hopper=@MT;
						while ( $record = $iter->each)
							{
							$NEW_leads_to_hopper[$NEW_rec_countLEADS] = "$record->[0]";
							$NEW_lists_to_hopper[$NEW_rec_countLEADS] = "$record->[1]";
							$NEW_gmt_to_hopper[$NEW_rec_countLEADS] = "$record->[2]";
							$NEW_phone_to_hopper[$NEW_rec_countLEADS] = "$record->[3]";
							$NEW_state_to_hopper[$NEW_rec_countLEADS] = "$record->[4]";
							if ($DB_show_offset) {print "LEAD_ADD: $record->[2] $record->[3] $record->[4]\n";}
							$NEW_rec_countLEADS++;
							} 
						}

					}

			if ($DB) {print "     lead call order:      $order_stmt\n";}
			$stmtA = "SELECT lead_id,list_id,gmt_offset_now,phone_number,state FROM vicidial_list where called_since_last_reset='N' and status IN('$dial_status_a[$i]','$dial_status_b[$i]','$dial_status_c[$i]','$dial_status_d[$i]','$dial_status_e[$i]') and list_id IN($camp_lists) and lead_id NOT IN($lead_id_lists) and ($all_gmtSQL) $lead_filter_sql[$i] $order_stmt limit $OTHER_level;";
			if ($DBX) {print "     |$stmtA|\n";}
			$dbhA->query("$stmtA");
			if ($dbhA->has_selected_record)
				{
				$iter=$dbhA->create_record_iterator;
				 $rec_countLEADS=0;   $NEW_dec=99;   $NEW_in=0;
				 @leads_to_hopper=@MT;
				 @lists_to_hopper=@MT;
				 @gmt_to_hopper=@MT;
				 @state_to_hopper=@MT;
				 @phone_to_hopper=@MT;
				while ( $record = $iter->each)
					{
					if ( ($NEW_count > 0) && ($NEW_rec_countLEADS > $NEW_in) )
						{
						if ($DB_show_offset) {print "NEW_COUNT: $NEW_count|$NEW_dec|$NEW_in|$NEW_rec_countLEADS\n";}
						if ($NEW_count > $NEW_dec) 
							{
							$NEW_dec++;
							}
						else
							{
							$leads_to_hopper[$rec_countLEADS] = "$NEW_leads_to_hopper[$NEW_in]";
							$lists_to_hopper[$rec_countLEADS] = "$NEW_lists_to_hopper[$NEW_in]";
							$gmt_to_hopper[$rec_countLEADS] = "$NEW_gmt_to_hopper[$NEW_in]";
							$state_to_hopper[$rec_countLEADS] = "$NEW_state_to_hopper[$NEW_in]";
							$phone_to_hopper[$rec_countLEADS] = "$NEW_phone_to_hopper[$NEW_in]";
							if ($DB_show_offset) {print "LEAD_ADD:    $NEW_leads_to_hopper[$NEW_in]   $NEW_phone_to_hopper[$NEW_in]\n";}
							$rec_countLEADS++;
							$NEW_in++;
							$NEW_dec=2;
							}
						}
					if ($REC_rec_countLEADS > $REC_insert_count)
						{
						$leads_to_hopper[$rec_countLEADS] = "$REC_leads_to_hopper[$REC_insert_count]";
						$lists_to_hopper[$rec_countLEADS] = "$REC_lists_to_hopper[$REC_insert_count]";
						$gmt_to_hopper[$rec_countLEADS] = "$REC_gmt_to_hopper[$REC_insert_count]";
						$state_to_hopper[$rec_countLEADS] = "$REC_state_to_hopper[$REC_insert_count]";
						$phone_to_hopper[$rec_countLEADS] = "$REC_phone_to_hopper[$REC_insert_count]";
						$rec_countLEADS++;
						$REC_insert_count++;
						}
					$leads_to_hopper[$rec_countLEADS] = "$record->[0]";
					$lists_to_hopper[$rec_countLEADS] = "$record->[1]";
					$gmt_to_hopper[$rec_countLEADS] = "$record->[2]";
					$state_to_hopper[$rec_countLEADS] = "$record->[4]";
					$phone_to_hopper[$rec_countLEADS] = "$record->[3]";
					if ($DB_show_offset) {print "LEAD_ADD: $record->[2] $record->[3] $record->[4]\n";}
					$rec_countLEADS++;
					} 
				}

				if ($DB) {print "     Adding to hopper:     $rec_countLEADS\n";}
				$event_string = "|$campaign_id[$i]|Added to hopper $rec_countLEADS|";
				&event_logger;

			$h=0;
			foreach(@leads_to_hopper)
				{
				if ($leads_to_hopper[$h] != '0')
					{
					$DNClead=0;
					if ($use_internal_dnc[$i] =~ /Y/)
						{
						if ($DB) {print "     Doinbg DNC Check: $phone_to_hopper[$h]\n";}
						$stmtA = "SELECT count(*) from vicidial_dnc where phone_number='$phone_to_hopper[$h]';";
						$dbhA->query("$stmtA");
						if ($dbhA->has_selected_record)
						   {
							$iter=$dbhA->create_record_iterator;
							$rec_count=0;
							while ( $record = $iter->each)
								{
								$DNClead =		 "$record->[0]";
								}
						   }
						if ($DNClead != '0')
							{
							$stmtA = "UPDATE vicidial_list SET status='DNCL' where lead_id='$leads_to_hopper[$h]';";
							$dbhA->query("$stmtA");
							if ($DB) {print "Flagging DNC lead:     $leads_to_hopper[$h]  $phone_to_hopper[$h]\n";}
							}
						}
					if ($DNClead == '0')
						{
						$stmtA = "INSERT INTO $vicidial_hopper (lead_id,campaign_id,status,user,list_id,gmt_offset_now,state) values('$leads_to_hopper[$h]','$campaign_id[$i]','READY','','$lists_to_hopper[$h]','$gmt_to_hopper[$h]','$state_to_hopper[$h]');";
						$dbhA->query("$stmtA");
						}
					}
				$h++;
				}
				if ($DB) {print "     DONE with this campaign\n";}

			}
		}
	
	
	$i++;
	}


$dbhA->close;

if($DB){print "DONE... Exiting... Goodbye... See you later... Really, I mean it :)\n";}

exit;



sub event_logger {
	### open the log file for writing ###
	open(Lout, ">>$VDHLOGfile")
			|| die "Can't open $VDHLOGfile: $!\n";

	print Lout "$now_date|$event_string|\n";

	close(Lout);

$event_string='';
}


