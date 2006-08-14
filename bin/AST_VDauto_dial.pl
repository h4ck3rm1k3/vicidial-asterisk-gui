#!/usr/bin/perl
#
# AST_VDauto_dial.pl version 0.12   *DBI-version*
#
# DESCRIPTION:
# uses Net::MySQL to place auto_dial calls on the VICIDIAL dialer system 
#
# SUMMARY:
# This program was designed for people using the Asterisk PBX with VICIDIAL
#
# For the client to use VICIDIAL, this program must be in the cron constantly 
# 
# For this program to work you need to have the "asterisk" MySQL database 
# created and create the tables listed in the CONF_MySQL.txt file, also make sure
# that the machine running this program has read/write/update/delete access 
# to that database
# 
# It is recommended that you run this program on the local Asterisk machine
#
# This script is to run perpetually querying every second to place new phone
# calls from the vicidial_hopper based upon how many available agents there are
# and the value of the auto_dial_level setting in the campaign screen of the 
# admin web page
#
# It is good practice to keep this program running by placing the associated 
# KEEPALIVE script running every minute to ensure this program is always running
#
# Copyright (C) 2006  Matt Florell <vicidial@gmail.com>    LICENSE: GPLv2
#
# changes:
# 50125-1201 - Changed dial timeout to 120 seconds from 180 seconds
# 50317-0954 - Added duplicate check per cycle to account for DB lockups
# 50322-1302 - Added campaign custom callerid feature
# 50324-1353 - Added optional variable to record ring time thru separate diap prefix 
# 50606-2308 - Added code to ensure no calls placed out on inactive campaign
# 50617-1248 - Added code to place LOGOUT entry in auto-paused user logs
# 50620-1349 - Added custom vdad transfer AGI extension per campaign
# 50810-1610 - Added database server variable definitions lookup
# 50810-1630 - Added max_vicidial_trunks server limiter on active lines
# 50812-0957 - corrected max_trunks logic, added update of server every 25 sec
# 60120-1522 - corrected time error for hour variable, caused agi problems
# 60427-1223 - Fixed Blended in/out CLOSER campaign issue
# 60608-1134 - Altered vac table field of call_type for IN OUT distinction
# 60612-1324 - Altered dead call section to accept BUSY detection from VD_hangup
#            - Altered dead call section to accept DISCONNECT detection from VD_hangup
# 60614-1142 - Added code to work with recycled leads, multi called_since_last_reset values
#            - Removed gmt lead validation because it is already done by VDhopper
# 60807-1438 - Changed to DBI
#            - changed to use /etc/astguiclient.conf for configs
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
	print "allowed run time options:\n  [-t] = test\n  [-debug] = verbose debug messages\n  [--delay=XXX] = delay of XXX seconds per loop, default 2.5 seconds\n\n";
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
		$loop_delay = '2500';
		}
		if ($args =~ /-debug/i)
		{
		$DB=1; # Debug flag, set to 0 for no debug messages, On an active system this will generate hundreds of lines of output per minute
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
	$loop_delay = '2500';
	$DB=1;
}
### end parsing run-time options ###


# constants
$US='__';
$MT[0]='';
$RECcount=''; ### leave blank for no REC count
$RECprefix='7'; ### leave blank for no REC prefix


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

	&get_time_now;	# update time/date variables

if (!$VDADLOGfile) {$VDADLOGfile = "$PATHlogs/vdautodial.$year-$mon-$mday";}

	$event_string='PROGRAM STARTED||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||';
	&event_logger;	# writes to the log and if debug flag is set prints to STDOUT

use Time::HiRes ('gettimeofday','usleep','sleep');  # necessary to have perl sleep command of less than one second
use DBI;
	
	### connect to MySQL database defined in the conf file
	$dbhA = DBI->connect("DBI:mysql:$VARDB_database:$VARDB_server:$VARDB_port", "$VARDB_user", "$VARDB_pass")
    or die "Couldn't connect to database: " . DBI->errstr;


### Grab Server values from the database
$stmtA = "SELECT telnet_host,telnet_port,ASTmgrUSERNAME,ASTmgrSECRET,ASTmgrUSERNAMEupdate,ASTmgrUSERNAMElisten,ASTmgrUSERNAMEsend,max_vicidial_trunks,answer_transfer_agent,local_gmt,ext_context FROM servers where server_ip = '$server_ip';";
$sthA = $dbhA->prepare($stmtA) or die "preparing: ",$dbhA->errstr;
$sthA->execute or die "executing: $stmtA ", $dbhA->errstr;
$sthArows=$sthA->rows;
$rec_count=0;
while ($sthArows > $rec_count)
	{
	 @aryA = $sthA->fetchrow_array;
		$DBtelnet_host	=			"$aryA[0]";
		$DBtelnet_port	=			"$aryA[1]";
		$DBASTmgrUSERNAME	=		"$aryA[2]";
		$DBASTmgrSECRET	=			"$aryA[3]";
		$DBASTmgrUSERNAMEupdate	=	"$aryA[4]";
		$DBASTmgrUSERNAMElisten	=	"$aryA[5]";
		$DBASTmgrUSERNAMEsend	=	"$aryA[6]";
		$DBmax_vicidial_trunks	=	"$aryA[7]";
		$DBanswer_transfer_agent=	"$aryA[8]";
		$DBSERVER_GMT		=		"$aryA[9]";
		$DBext_context	=			"$aryA[10]";
		if ($DBtelnet_host)				{$telnet_host = $DBtelnet_host;}
		if ($DBtelnet_port)				{$telnet_port = $DBtelnet_port;}
		if ($DBASTmgrUSERNAME)			{$ASTmgrUSERNAME = $DBASTmgrUSERNAME;}
		if ($DBASTmgrSECRET)			{$ASTmgrSECRET = $DBASTmgrSECRET;}
		if ($DBASTmgrUSERNAMEupdate)	{$ASTmgrUSERNAMEupdate = $DBASTmgrUSERNAMEupdate;}
		if ($DBASTmgrUSERNAMElisten)	{$ASTmgrUSERNAMElisten = $DBASTmgrUSERNAMElisten;}
		if ($DBASTmgrUSERNAMEsend)		{$ASTmgrUSERNAMEsend = $DBASTmgrUSERNAMEsend;}
		if ($DBmax_vicidial_trunks)		{$max_vicidial_trunks = $DBmax_vicidial_trunks;}
		if ($DBanswer_transfer_agent)	{$answer_transfer_agent = $DBanswer_transfer_agent;}
		if ($DBSERVER_GMT)				{$SERVER_GMT = $DBSERVER_GMT;}
		if ($DBext_context)				{$ext_context = $DBext_context;}
	 $rec_count++;
	}
$sthA->finish();

	$event_string='LOGGED INTO MYSQL SERVER ON 1 CONNECTION|';
	&event_logger;

$one_day_interval = 12;		# 1 month loops for one year 
while($one_day_interval > 0)
{

	$endless_loop=5760000;		# 30 days minutes at XXX seconds per loop

	while($endless_loop > 0)
	{
		&get_time_now;

	###############################################################################
	###### first figure out how many calls should be placed for each campaign per server
	###############################################################################
		@DBlive_user=@MT;
		@DBlive_server_ip=@MT;
		@DBlive_campaign=@MT;
		@DBlive_conf_exten=@MT;
		@DBcampaigns=@MT;
		@DBIPaddress=@MT;
		@DBIPcampaign=@MT;
		@DBIPactive=@MT;
		@DBIPvdadexten=@MT;
		@DBIPcount=@MT;
		@DBIPadlevel=@MT;
		@DBIPdialtimeout=@MT;
		@DBIPdialprefix=@MT;
		@DBIPcampaigncid=@MT;
		@DBIPexistcalls=@MT;
		@DBIPgoalcalls=@MT;
		@DBIPmakecalls=@MT;
		@DBIPclosercamp=@MT;

		$active_line_counter=0;
		$user_counter=0;
		$user_campaigns = '|';
		$user_campaigns_counter = 0;
		$user_campaignIP = '|';
		$user_CIPct = 0;

		##### Get a listing of the users that are active and ready to take calls
		##### Also get a listing of the campaigns and campaigns/serverIP that will be used
		$stmtA = "SELECT user,server_ip,campaign_id,conf_exten FROM vicidial_live_agents where status IN('READY','QUEUE','INCALL','DONE') and server_ip='$server_ip' and last_update_time > '$BDtsSQLdate' order by last_call_time";
		$sthA = $dbhA->prepare($stmtA) or die "preparing: ",$dbhA->errstr;
		$sthA->execute or die "executing: $stmtA ", $dbhA->errstr;
		$sthArows=$sthA->rows;
		$rec_count=0;
		while ($sthArows > $rec_count)
			{
			@aryA = $sthA->fetchrow_array;
				$DBlive_user[$user_counter] =		"$aryA[0]";
				$DBlive_server_ip[$user_counter] =	"$aryA[1]";
				$DBlive_campaign[$user_counter] =	"$aryA[2]";
				$DBlive_conf_exten[$user_counter] =	"$aryA[3]";
				
				if ($user_campaigns !~ /\|$DBlive_campaign[$user_counter]\|/i)
					{
					$user_campaigns .= "$DBlive_campaign[$user_counter]|";
					$DBcampaigns[$user_campaigns_counter] = $DBlive_campaign[$user_counter];
					$user_campaigns_counter++;
					}
				if ($user_campaignIP !~ /\|$DBlive_campaign[$user_counter]__$DBlive_server_ip[$user_counter]\|/i)
					{
					$user_campaignIP .= "$DBlive_campaign[$user_counter]__$DBlive_server_ip[$user_counter]|";
					$DBIPcampaign[$user_CIPct] = "$DBlive_campaign[$user_counter]";
					$DBIPaddress[$user_CIPct] = "$DBlive_server_ip[$user_counter]";
					$user_CIPct++;
					}
				$user_counter++;
			$rec_count++;
			}
		$sthA->finish();

		$event_string="LIVE AGENTS LOGGED IN: $user_counter";
		&event_logger;

		$user_CIPct = 0;
		foreach(@DBIPcampaign)
			{
			$user_counter=0;
			foreach(@DBlive_campaign)
				{
				if ( ($DBlive_campaign[$user_counter] =~ /$DBIPcampaign[$user_CIPct]/i) && ($DBlive_server_ip[$user_counter] =~ /$DBIPaddress[$user_CIPct]/i) )
					{
					$DBIPcount[$user_CIPct]++
					}
				$user_counter++;
				}

			### grab the dial_level and multiply by active agents to get your goalcalls
			$DBIPadlevel[$user_CIPct]=0;
			$stmtA = "SELECT auto_dial_level,local_call_time,dial_timeout,dial_prefix,campaign_cid,active,campaign_vdad_exten,closer_campaigns FROM vicidial_campaigns where campaign_id='$DBIPcampaign[$user_CIPct]'";
			$sthA = $dbhA->prepare($stmtA) or die "preparing: ",$dbhA->errstr;
			$sthA->execute or die "executing: $stmtA ", $dbhA->errstr;
			$sthArows=$sthA->rows;
			$rec_count=0;
			while ($sthArows > $rec_count)
				{
				@aryA = $sthA->fetchrow_array;
					$DBIPadlevel[$user_CIPct] =		"$aryA[0]";
					$DBIPcalltime[$user_CIPct] =	"$aryA[1]";
					$DBIPdialtimeout[$user_CIPct] =	"$aryA[2]";
					$DBIPdialprefix[$user_CIPct] =	"$aryA[3]";
					$DBIPcampaigncid[$user_CIPct] =	"$aryA[4]";
					$DBIPactive[$user_CIPct] =		"$aryA[5]";
					$DBIPvdadexten[$user_CIPct] =	"$aryA[6]";
					$DBIPclosercamp[$user_CIPct] =	"$aryA[7]";
				$rec_count++;
				}
			$sthA->finish();

			$DBIPgoalcalls[$user_CIPct] = ($DBIPadlevel[$user_CIPct] * $DBIPcount[$user_CIPct]);
			if ($DBIPactive[$user_CIPct] =~ /N/) {$DBIPgoalcalls[$user_CIPct] = 0;}
			$DBIPgoalcalls[$user_CIPct] = sprintf("%.0f", $DBIPgoalcalls[$user_CIPct]);

			$event_string="$DBIPcampaign[$user_CIPct] $DBIPaddress[$user_CIPct]: agents: $DBIPcount[$user_CIPct]     dial_level: $DBIPadlevel[$user_CIPct]";
			&event_logger;

			$active_line_counter=0;
			$active_line_goal=0;
			### see how many total VDAD calls are going on right now for max limiter
			$stmtA = "SELECT count(*) FROM vicidial_auto_calls where server_ip='$DBIPaddress[$user_CIPct]' and status IN('SENT','RINGING','LIVE','XFER');";
			$sthA = $dbhA->prepare($stmtA) or die "preparing: ",$dbhA->errstr;
			$sthA->execute or die "executing: $stmtA ", $dbhA->errstr;
			$sthArows=$sthA->rows;
			$rec_count=0;
			while ($sthArows > $rec_count)
				{
				@aryA = $sthA->fetchrow_array;
					$active_line_counter = "$aryA[0]";
				$rec_count++;
				}
			$sthA->finish();

			### see how many calls are alrady active per campaign per server and 
			### subtract that number from goalcalls to determine how many new 
			### calls need to be placed in this loop
			if ($DBIPcampaign[$user_CIPct] =~ /CLOSER/)
			   {
				if (length($DBIPclosercamp[$user_CIPct]) > 2)
				   {
					$DBIPclosercamp[$user_CIPct] =~ s/^ | -$//gi;
					$DBIPclosercamp[$user_CIPct] =~ s/ /','/gi;
					$DBIPclosercamp[$user_CIPct] = "'$DBIPclosercamp[$user_CIPct]'";
				   }
				  else {$DBIPclosercamp[$user_CIPct]=''}
				
				$campaign_query = "( (call_type='IN' and campaign_id IN($DBIPclosercamp[$user_CIPct])) or (campaign_id='$DBIPcampaign[$user_CIPct]' and call_type='OUT') )";
				}
			else {$campaign_query = "(campaign_id='$DBIPcampaign[$user_CIPct]' and call_type='OUT')";}
			$stmtA = "SELECT count(*) FROM vicidial_auto_calls where $campaign_query and server_ip='$DBIPaddress[$user_CIPct]' and status IN('SENT','RINGING','LIVE','XFER','CLOSER');";
			$sthA = $dbhA->prepare($stmtA) or die "preparing: ",$dbhA->errstr;
			$sthA->execute or die "executing: $stmtA ", $dbhA->errstr;
			$sthArows=$sthA->rows;
			$rec_count=0;
			while ($sthArows > $rec_count)
				{
				@aryA = $sthA->fetchrow_array;
					$DBIPexistcalls[$user_CIPct] = "$aryA[0]";
				$rec_count++;
				}
			$sthA->finish();

			$DBIPmakecalls[$user_CIPct] = ($DBIPgoalcalls[$user_CIPct] - $DBIPexistcalls[$user_CIPct]);
			$MVT_msg = '';
			$active_line_goal = ($active_line_counter + $DBIPmakecalls[$user_CIPct]);
			if ($active_line_goal > $max_vicidial_trunks) 
				{
				$MVT_msg = "MVT override: $max_vicidial_trunks";
				$DBIPmakecalls[$user_CIPct] = ($max_vicidial_trunks - $active_line_counter);
				}
			$event_string="$DBIPcampaign[$user_CIPct] $DBIPaddress[$user_CIPct]: Calls to place: $DBIPmakecalls[$user_CIPct] ($DBIPgoalcalls[$user_CIPct] - $DBIPexistcalls[$user_CIPct]) $MVT_msg";
			&event_logger;

			$user_CIPct++;
			}

	###############################################################################
	###### second lookup leads and place calls for each campaign/server_ip
	######     go one lead at a time and place the call by inserting a record into vicidial_manager
	###############################################################################

		$user_CIPct = 0;
		foreach(@DBIPcampaign)
			{
			$event_string="$DBIPcampaign[$user_CIPct] $DBIPaddress[$user_CIPct]: CALLING";
			&event_logger;
			$call_CMPIPct=0;
			$lead_id_call_list='|';
			my $UDaffected_rows=0;
			if ($call_CMPIPct < $DBIPmakecalls[$user_CIPct])
				{
				$stmtA = "UPDATE vicidial_hopper set status='QUEUE', user='VDAD_$server_ip' where campaign_id='$DBIPcampaign[$user_CIPct]' and status='READY' order by hopper_id LIMIT $DBIPmakecalls[$user_CIPct]";
				print "|$stmtA|\n";
			   $UDaffected_rows = $dbhA->do($stmtA);
				print "hopper rows updated to QUEUE: |$UDaffected_rows|\n";

					if ($UDaffected_rows)
					{
					$lead_id=''; $phone_code=''; $phone_number=''; $called_count='';
						while ($call_CMPIPct < $UDaffected_rows)
						{
						$stmtA = "SELECT lead_id FROM vicidial_hopper where campaign_id='$DBIPcampaign[$user_CIPct]' and status='QUEUE' and user='VDAD_$server_ip' LIMIT 1";
						print "|$stmtA|\n";
							$sthA = $dbhA->prepare($stmtA) or die "preparing: ",$dbhA->errstr;
							$sthA->execute or die "executing: $stmtA ", $dbhA->errstr;
							$sthArows=$sthA->rows;
							$rec_count=0;
							 $rec_countCUSTDATA=0;
							while ($sthArows > $rec_count)
								{
								@aryA = $sthA->fetchrow_array;
									$lead_id =		"$aryA[0]";
								$rec_count++;
								}
							$sthA->finish();

						if ($lead_id_call_list =~ /\|$lead_id\|/)
							{
							print "!!!!!!!!!!!!!!!!duplicate lead_id for this run: |$lead_id|     $lead_id_call_list\n";
							open(DUPout, ">>$PATHlogs/VDAD_DUPLICATE.$file_date")
									|| die "Can't open $PATHlogs/VDAD_DUPLICATE.$file_date: $!\n";
							print DUPout "$now_date-----$lead_id_call_list-----$lead_id\n";
							close(DUPout);
							}
						else
							{
							$stmtA = "UPDATE vicidial_hopper set status='INCALL' where lead_id='$lead_id'";
							print "|$stmtA|\n";
						   $UQaffected_rows = $dbhA->do($stmtA);
							print "hopper row updated to INCALL: |$UQaffected_rows|$lead_id|\n";

							$stmtA = "SELECT * FROM vicidial_list where lead_id='$lead_id';";
							$sthA = $dbhA->prepare($stmtA) or die "preparing: ",$dbhA->errstr;
							$sthA->execute or die "executing: $stmtA ", $dbhA->errstr;
							$sthArows=$sthA->rows;
							$rec_count=0;
							 $rec_countCUSTDATA=0;
							while ($sthArows > $rec_count)
								{
								@aryA = $sthA->fetchrow_array;
									$gmt_offset_now	=			"$aryA[8]";
									$called_since_last_reset =	"$aryA[9]";
									$phone_code	=				"$aryA[10]";
									$phone_number =				"$aryA[11]";
									$called_count =				"$aryA[30]";

									$rec_countCUSTDATA++;
								$rec_count++;
								}
							$sthA->finish();

							if ($rec_countCUSTDATA)
								{
								### update called_count
								$called_count++;
								if ($called_since_last_reset =~ /^Y/)
									{
									if ($called_since_last_reset =~ /^Y$/) {$CSLR = 'Y1';}
									else
										{
										$called_since_last_reset =~ s/^Y//gi;
										$called_since_last_reset++;
										$CSLR = "Y$called_since_last_reset";
										}
									}
								else {$CSLR = 'Y';}

								$stmtA = "UPDATE vicidial_list set called_since_last_reset='$CSLR', called_count='$called_count',user='VDAD' where lead_id='$lead_id'";
								$affected_rows = $dbhA->do($stmtA);

								$stmtA = "DELETE FROM vicidial_hopper where lead_id='$lead_id'";
								$affected_rows = $dbhA->do($stmtA);

								$CCID_on=0;   $CCID='';
								$local_DEF = 'Local/';
								$local_AMP = '@';
								$Local_out_prefix = '9';
								$Local_dial_timeout = '60';
							   if ($DBIPdialtimeout[$user_CIPct] > 4) {$Local_dial_timeout = $DBIPdialtimeout[$user_CIPct];}
								$Local_dial_timeout = ($Local_dial_timeout * 1000);
							   if (length($DBIPdialprefix[$user_CIPct]) > 0) {$Local_out_prefix = "$DBIPdialprefix[$user_CIPct]";}
							   if (length($DBIPvdadexten[$user_CIPct]) > 0) {$VDAD_dial_exten = "$DBIPvdadexten[$user_CIPct]";}
							   else {$VDAD_dial_exten = "$answer_transfer_agent";}
							   
							   if (length($DBIPcampaigncid[$user_CIPct]) > 6) {$CCID = "$DBIPcampaigncid[$user_CIPct]";   $CCID_on++;}
							   if ($DBIPdialprefix[$user_CIPct] =~ /x/i) {$Local_out_prefix = '';}

								if ($RECcount)
									{
								    if ( (length($RECprefix)>0) && ($called_count < $RECcount) )
									   {$Local_out_prefix .= "$RECprefix";}
									}
								$PADlead_id = sprintf("%09s", $lead_id);	while (length($PADlead_id) > 9) {chop($PADlead_id);}

							   $lead_id_call_list .= "$lead_id|";

								### use manager middleware-app to connect the next call to the meetme room
								# VmmddhhmmssLLLLLLLLL
									$VqueryCID = "V$CIDdate$PADlead_id";
								if ($CCID_on) {$CIDstring = "\"$VqueryCID\" <$CCID>";}
								else {$CIDstring = "$VqueryCID";}

								### insert a NEW record to the vicidial_manager table to be processed
									$stmtA = "INSERT INTO vicidial_manager values('','','$SQLdate','NEW','N','$DBIPaddress[$user_CIPct]','','Originate','$VqueryCID','Exten: $VDAD_dial_exten','Context: $ext_context','Channel: $local_DEF$Local_out_prefix$phone_code$phone_number$local_AMP$ext_context','Priority: 1','Callerid: $CIDstring','Timeout: $Local_dial_timeout','','','','')";
									$affected_rows = $dbhA->do($stmtA);

									$event_string = "|     number call dialed|$DBIPcampaign[$user_CIPct]|$VqueryCID|$stmtA|$gmt_offset_now|";
									 &event_logger;

								### insert a SENT record to the vicidial_auto_calls table 
									$stmtA = "INSERT INTO vicidial_auto_calls (server_ip,campaign_id,status,lead_id,callerid,phone_code,phone_number,call_time,call_type) values('$DBIPaddress[$user_CIPct]','$DBIPcampaign[$user_CIPct]','SENT','$lead_id','$VqueryCID','$phone_code','$phone_number','$SQLdate','OUT')";
									$affected_rows = $dbhA->do($stmtA);

								### sleep for a tenth of a second to not flood the server with new calls
								usleep(1*100*1000);

								}
							}
						$call_CMPIPct++;
						}
					}

			}

		$user_CIPct++;
		}







	&get_time_now;

	###############################################################################
	###### third we will grab the callerids of the vicidial_auto_calls records and check for dead calls
	######    we also check to make sure that it isn't a call that has been transferred, 
	######    if it has been we need to leave the vicidial_list status alone
	###############################################################################

		@KLcallerid = @MT;
		@KLserver_ip = @MT;
		@KLchannel = @MT;
		$kill_vac=0;

		$stmtA = "SELECT callerid,server_ip,channel,uniqueid FROM vicidial_auto_calls where server_ip='$server_ip' order by call_time;";
		$sthA = $dbhA->prepare($stmtA) or die "preparing: ",$dbhA->errstr;
		$sthA->execute or die "executing: $stmtA ", $dbhA->errstr;
		$sthArows=$sthA->rows;
		$rec_count=0;
		 $rec_countCUSTDATA=0;
		 $kill_vac=0;
		while ($sthArows > $rec_count)
			{
			@aryA = $sthA->fetchrow_array;
				$KLcallerid[$kill_vac]		= "$aryA[0]";
				$KLserver_ip[$kill_vac]		= "$aryA[1]";
				$KLchannel[$kill_vac]		= "$aryA[2]";
				$KLuniqueid[$kill_vac]		= "$aryA[3]";
			$kill_vac++;
			$rec_count++;
			}
		$sthA->finish();

		$kill_vac=0;
		foreach(@KLcallerid)
			{
			if (length($KLserver_ip[$kill_vac]) > 7)
				{
				$end_epoch=0;   $CLuniqueid='';

				$stmtA = "SELECT end_epoch,uniqueid FROM call_log where caller_code='$KLcallerid[$kill_vac]' and server_ip='$KLserver_ip[$kill_vac]' order by end_epoch, start_time desc limit 1;";
				$sthA = $dbhA->prepare($stmtA) or die "preparing: ",$dbhA->errstr;
				$sthA->execute or die "executing: $stmtA ", $dbhA->errstr;
				$sthArows=$sthA->rows;
				$rec_count=0;
				 $rec_countCUSTDATA=0;
				while ($sthArows > $rec_count)
					{
					@aryA = $sthA->fetchrow_array;
						$end_epoch		= "$aryA[0]";
						$CLuniqueid		= "$aryA[1]";
					$rec_count++;
					}
				$sthA->finish();

				if ( (length($KLuniqueid[$kill_vac]) > 15) && (length($CLuniqueid) < 15) )
					{
					$stmtA = "SELECT end_epoch,uniqueid FROM call_log where uniqueid='$KLuniqueid[$kill_vac]' and server_ip='$KLserver_ip[$kill_vac]' order by end_epoch, start_time desc limit 1;";
					$sthA = $dbhA->prepare($stmtA) or die "preparing: ",$dbhA->errstr;
					$sthA->execute or die "executing: $stmtA ", $dbhA->errstr;
					$sthArows=$sthA->rows;
					$rec_count=0;
					 $rec_countCUSTDATA=0;
					while ($sthArows > $rec_count)
						{
						@aryA = $sthA->fetchrow_array;
							$end_epoch		= "$aryA[0]";
							$CLuniqueid		= "$aryA[1]";
						$rec_count++;
						}
					$sthA->finish();
					}
				if ($end_epoch > 1000)
					{
					$CLlead_id=''; $auto_call_id=''; $CLstatus=''; $CLcampaign_id=''; $CLphone_number=''; $CLphone_code='';

					$stmtA = "SELECT auto_call_id,lead_id,phone_number,status,campaign_id,phone_code FROM vicidial_auto_calls where callerid='$KLcallerid[$kill_vac]'";
					$sthA = $dbhA->prepare($stmtA) or die "preparing: ",$dbhA->errstr;
					$sthA->execute or die "executing: $stmtA ", $dbhA->errstr;
					$sthArows=$sthA->rows;
					$rec_count=0;
					 $rec_countCUSTDATA=0;
					while ($sthArows > $rec_count)
						{
						@aryA = $sthA->fetchrow_array;
							$auto_call_id	= "$aryA[0]";
							$CLlead_id		= "$aryA[1]";
							$CLphone_number	= "$aryA[2]";
							$CLstatus		= "$aryA[3]";
							$CLcampaign_id	= "$aryA[4]";
							$CLphone_code	= "$aryA[5]";
						$rec_count++;
						}
					$sthA->finish();

					$stmtA = "DELETE from vicidial_auto_calls where auto_call_id='$auto_call_id'";
		#			$stmtA = "UPDATE vicidial_auto_calls set status='PAUSED' where callerid='$KLcallerid[$kill_vac]'";
					$affected_rows = $dbhA->do($stmtA);

					$event_string = "|     dead call vac deleted|$auto_call_id|$CLlead_id|$KLcallerid[$kill_vac]|$end_epoch|$affected_rows|$KLchannel[$kill_vac]|";
					 &event_logger;

					if ($CLstatus !~ /XFER|CLOSER/) 
						{
						if ($CLstatus =~ /BUSY/) {$CLnew_status = 'B';}
						else
							{
							if ($CLstatus =~ /DISCONNECT/) {$CLnew_status = 'DC';}
							else {$CLnew_status = 'NA';}
							}
						if ($CLstatus =~ /LIVE/) {$CLnew_status = 'DROP';}
						else 
							{
							$end_epoch = ($now_date_epoch + 1);
							$stmtA = "INSERT INTO vicidial_log (uniqueid,lead_id,campaign_id,call_date,start_epoch,status,phone_code,phone_number,user,processed,length_in_sec,end_epoch) values('$CLuniqueid','$CLlead_id','$CLcampaign_id','$SQLdate','$now_date_epoch','$CLnew_status','$CLphone_code','$CLphone_number','VDAD','N','1','$end_epoch')";
								if($M){print STDERR "\n|$stmtA|\n";}
							$affected_rows = $dbhA->do($stmtA);

							$event_string = "|     dead NA call added to log $CLuniqueid|$CLlead_id|$CLphone_number|$CLstatus|$CLnew_status|$affected_rows|";
							 &event_logger;

							}

						$stmtA = "UPDATE vicidial_list set status='$CLnew_status' where lead_id='$CLlead_id'";
						$affected_rows = $dbhA->do($stmtA);

						$event_string = "|     dead call vac lead marked $CLnew_status|$CLlead_id|$CLphone_number|$CLstatus|";
						 &event_logger;

						$stmtA = "UPDATE vicidial_live_agents set status='PAUSED',random_id='10' where  callerid='$KLcallerid[$kill_vac]';";
						$affected_rows = $dbhA->do($stmtA);

						$event_string = "|     dead call vla agent PAUSED $affected_rows|$CLlead_id|$CLphone_number|$CLstatus|";
						 &event_logger;
						}
					else
						{
						$event_string = "|     dead call vac XFERd do nothing|$CLlead_id|$CLphone_number|$CLstatus|";
						 &event_logger;
						}
					}
				}
			$kill_vac++;
			}



		### pause agents that have disconnected or closed their apps over 30 seconds ago
		$stmtA = "UPDATE vicidial_live_agents set status='PAUSED',random_id='10' where server_ip='$server_ip' and last_update_time < '$PDtsSQLdate' and status NOT IN('PAUSED')";
		$affected_rows = $dbhA->do($stmtA);

		$event_string = "|     lagged call vla agent PAUSED $affected_rows|$PDtsSQLdate|$BDtsSQLdate|$tsSQLdate|";
		 &event_logger;

		if ($affected_rows > 0)
			{
			@VALOuser=@MT; @VALOcampaign=@MT; @VALOtimelog=@MT; @VALOextension=@MT;
			$logcount=0;
			$stmtA = "SELECT user,campaign_id,last_update_time,extension FROM vicidial_live_agents where server_ip='$server_ip' and status = 'PAUSED' and random_id='10' order by last_update_time desc limit $affected_rows";
			$sthA = $dbhA->prepare($stmtA) or die "preparing: ",$dbhA->errstr;
			$sthA->execute or die "executing: $stmtA ", $dbhA->errstr;
			$sthArows=$sthA->rows;
			$rec_count=0;
			 $rec_countCUSTDATA=0;
			while ($sthArows > $rec_count)
				{
				@aryA = $sthA->fetchrow_array;
					$VALOuser[$logcount] =		"$aryA[0]";
					$VALOcampaign[$logcount] =	"$aryA[1]";
					$VALOtimelog[$logcount]	=	"$aryA[2]";
					$VALOextension[$logcount] = "$aryA[3]";
					$logcount++;
				$rec_count++;
				}
			$sthA->finish();
			$logrun=0;
			foreach(@VALOuser)
				{
				$stmtA = "INSERT INTO vicidial_user_log (user,event,campaign_id,event_date,event_epoch) values('$VALOuser[$logrun]','LOGOUT','$VALOcampaign[$logrun]','$SQLdate','$now_date_epoch');";
				$affected_rows = $dbhA->do($stmtA);

				$event_string = "|          lagged agent LOGOUT entry inserted $VALOuser[$logrun]|$VALOcampaign[$logrun]|$VALOextension[$logcount]|";
				 &event_logger;

				$logrun++;
				}

			}


		### delete call records that are SENT for over 3 minutes
		$stmtA = "DELETE FROM vicidial_auto_calls where server_ip='$server_ip' and call_time < '$XDSQLdate' and status NOT IN('XFER','CLOSER','LIVE')";
		$affected_rows = $dbhA->do($stmtA);

		$event_string = "|     lagged call vac agent DELETED $affected_rows|$XDSQLdate|";
		 &event_logger;





	###############################################################################
	###### last, wait for a little bit and repeat the loop
	###############################################################################

		### sleep for 2 and a half seconds before beginning the loop again
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
		if ($endless_loop =~ /0$/)	# run every ten cycles (about 25 seconds)
			{
			### delete call records that are LIVE for over 10 minutes
			$stmtA = "DELETE FROM vicidial_auto_calls where server_ip='$server_ip' and call_time < '$TDSQLdate' and status NOT IN('XFER','CLOSER')";
			$affected_rows = $dbhA->do($stmtA);

			$event_string = "|     lagged call vac agent DELETED $affected_rows|$TDSQLdate|LIVE|";
			 &event_logger;

			### Grab Server values from the database in case they've changed
			$stmtA = "SELECT max_vicidial_trunks,answer_transfer_agent,local_gmt,ext_context FROM servers where server_ip = '$server_ip';";
			$sthA = $dbhA->prepare($stmtA) or die "preparing: ",$dbhA->errstr;
			$sthA->execute or die "executing: $stmtA ", $dbhA->errstr;
			$sthArows=$sthA->rows;
			$rec_count=0;
			while ($sthArows > $rec_count)
				{
				@aryA = $sthA->fetchrow_array;
					$DBmax_vicidial_trunks	=	"$aryA[0]";
					$DBanswer_transfer_agent=	"$aryA[1]";
					$DBSERVER_GMT		=		"$aryA[2]";
					$DBext_context	=			"$aryA[3]";
					if ($DBmax_vicidial_trunks)		{$max_vicidial_trunks = $DBmax_vicidial_trunks;}
					if ($DBanswer_transfer_agent)	{$answer_transfer_agent = $DBanswer_transfer_agent;}
					if ($DBSERVER_GMT)				{$SERVER_GMT = $DBSERVER_GMT;}
					if ($DBext_context)				{$ext_context = $DBext_context;}
				$rec_count++;
				}
			$sthA->finish();

			$event_string = "|     updating server parameters $max_vicidial_trunks|$answer_transfer_agent|$SERVER_GMT|$ext_context|";
			 &event_logger;

				&get_time_now;

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
if ($hour < 10) {$hour = "0$hour";}
if ($min < 10) {$min = "0$min";}
if ($sec < 10) {$sec = "0$sec";}

$now_date_epoch = time();
$now_date = "$year-$mon-$mday $hour:$min:$sec";
$file_date = "$year-$mon-$mday";
	$CIDdate = "$mon$mday$hour$min$sec";
	$tsSQLdate = "$year$mon$mday$hour$min$sec";
	$SQLdate = "$year-$mon-$mday $hour:$min:$sec";

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
	### open the log file for writing ###
	open(Lout, ">>$VDADLOGfile")
			|| die "Can't open $VDADLOGfile: $!\n";

	print Lout "$now_date|$event_string|\n";

	close(Lout);

$event_string='';
}
