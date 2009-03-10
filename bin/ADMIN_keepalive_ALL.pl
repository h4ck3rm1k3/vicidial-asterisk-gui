#!/usr/bin/perl
#
# ADMIN_keepalive_ALL.pl   version  2.0.5
#
# Designed to keep the astGUIclient processes alive and check every minute
# Replaces all other ADMIN_keepalive scripts
# Uses /etc/astguiclient.conf file to know which processes to keepalive
#
# Copyright (C) 2009  Matt Florell <vicidial@gmail.com>    LICENSE: AGPLv2
#
#
# 61011-1348 - First build
# 61120-2011 - Added option 7 for AST_VDauto_dial_FILL.pl
# 80227-1526 - Added option 8 for ip_relay
# 80526-1350 - Added option 9 for timeclock auto-logout
# 90211-1236 - Added auto-generation of conf files functions
# 90213-0625 - Separated the reloading of Asterisk into 4 separate steps
#

$DB=0; # Debug flag
$MT[0]='';   $MT[1]='';
@psline=@MT;

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
	if ( ($line =~ /^VARactive_keepalives/) && ($CLIactive_keepalives < 1) )
		{$VARactive_keepalives = $line;   $VARactive_keepalives =~ s/.*=//gi;}
	$i++;
	}

##### list of codes for active_keepalives and what processes they correspond to
#	X - NO KEEPALIVE PROCESSES (use only if you want none to be keepalive)\n";
#	1 - AST_update\n";
#	2 - AST_send_listen\n";
#	3 - AST_VDauto_dial\n";
#	4 - AST_VDremote_agents\n";
#	5 - AST_VDadapt (If multi-server system, this must only be on one server)\n";
#	6 - FastAGI_log\n";
#	7 - AST_VDauto_dial_FILL\n";
#	8 - ip_relay for blind monitoring\n";
#	9 - Timeclock auto logout\n";

if ($VARactive_keepalives =~ /X/)
	{
	if ($DB) {print "X in active_keepalives, exiting...\n";}
	exit;
	}

$AST_update=0;
$AST_send_listen=0;
$AST_VDauto_dial=0;
$AST_VDremote_agents=0;
$AST_VDadapt=0;
$FastAGI_log=0;
$AST_VDauto_dial_FILL=0;
$ip_relay=0;
$timeclock_auto_logout=0;
$runningAST_update=0;
$runningAST_send=0;
$runningAST_listen=0;
$runningAST_VDauto_dial=0;
$runningAST_VDremote_agents=0;
$runningAST_VDadapt=0;
$runningFastAGI_log=0;
$runningAST_VDauto_dial_FILL=0;
$runningip_relay=0;

if ($VARactive_keepalives =~ /1/) 
	{
	$AST_update=1;
	if ($DB) {print "AST_update set to keepalive\n";}
	}
if ($VARactive_keepalives =~ /2/) 
	{
	$AST_send_listen=1;
	if ($DB) {print "AST_send_listen set to keepalive\n";}
	}
if ($VARactive_keepalives =~ /3/) 
	{
	$AST_VDauto_dial=1;
	if ($DB) {print "AST_VDauto_dial set to keepalive\n";}
	}
if ($VARactive_keepalives =~ /4/) 
	{
	$AST_VDremote_agents=1;
	if ($DB) {print "AST_VDremote_agents set to keepalive\n";}
	}
if ($VARactive_keepalives =~ /5/) 
	{
	$AST_VDadapt=1;
	if ($DB) {print "AST_VDadapt set to keepalive\n";}
	}
if ($VARactive_keepalives =~ /6/) 
	{
	$FastAGI_log=1;
	if ($DB) {print "FastAGI_log set to keepalive\n";}
	}
if ($VARactive_keepalives =~ /7/) 
	{
	$AST_VDauto_dial_FILL=1;
	if ($DB) {print "AST_VDauto_dial_FILL set to keepalive\n";}
	}
if ($VARactive_keepalives =~ /8/) 
	{
	$ip_relay=1;
	if ($DB) {print "ip_relay set to keepalive\n";}
	}
if ($VARactive_keepalives =~ /9/) 
	{
	$timeclock_auto_logout=1;
	if ($DB) {print "Check to see if Timeclock auto logout should run\n";}
	}

$REGhome = $PATHhome;
$REGhome =~ s/\//\\\//gi;






##### First, check and see which processes are running #####

### you may have to use a different ps command if you're not using Slackware Linux
#	@psoutput = `ps -f -C AST_update --no-headers`;
#	@psoutput = `ps -f -C AST_updat* --no-headers`;
#	@psoutput = `/bin/ps -f --no-headers -A`;
#	@psoutput = `/bin/ps -o pid,args -A`; ### use this one for FreeBSD
@psoutput = `/bin/ps -o "%p %a" --no-headers -A`;

$i=0;
foreach (@psoutput)
{
chomp($psoutput[$i]);
if ($DBX) {print "$i|$psoutput[$i]|     \n";}
@psline = split(/\/usr\/bin\/perl /,$psoutput[$i]);

	if ($psline[1] =~ /$REGhome\/AST_update\.pl/) 
		{
		$runningAST_update++;
		if ($DB) {print "AST_update RUNNING:              |$psline[1]|\n";}
		}
	if ($psline[1] =~ /AST_manager_se/) 
		{
		$runningAST_send++;
		if ($DB) {print "AST_send RUNNING:                |$psline[1]|\n";}
		}
	if ($psline[1] =~ /AST_manager_li/) 
		{
		$psoutput[$i] =~ s/ .*|\n|\r|\t| //gi;
		$listen_pid[$runningAST_listen] = $psoutput[$i];
		$runningAST_listen++;
		if ($DB) {print "AST_listen RUNNING:              |$psline[1]|\n";}
		}
	if ($psline[1] =~ /$REGhome\/AST_VDauto_dial\.pl/) 
		{
		$runningAST_VDauto_dial++;
		if ($DB) {print "AST_VDauto_dial RUNNING:         |$psline[1]|\n";}
		}
	if ($psline[1] =~ /$REGhome\/AST_VDremote_agents\.pl/) 
		{
		$runningAST_VDremote_agents++;
		if ($DB) {print "AST_VDremote_agents RUNNING:     |$psline[1]|\n";}
		}
	if ($psline[1] =~ /$REGhome\/AST_VDadapt\.pl/) 
		{
		$runningAST_VDadapt++;
		if ($DB) {print "AST_VDadapt RUNNING:             |$psline[1]|\n";}
		}
	if ($psline[1] =~ /$REGhome\/FastAGI_log\.pl/) 
		{
		$runningFastAGI_log++;
		if ($DB) {print "FastAGI_log RUNNING:             |$psline[1]|\n";}
		}
	if ($psline[1] =~ /$REGhome\/AST_VDauto_dial_FILL\.pl/) 
		{
		$runningAST_VDauto_dial_FILL++;
		if ($DB) {print "AST_VDauto_dial_FILL RUNNING:    |$psline[1]|\n";}
		}
	if ($psoutput[$i] =~ / ip_relay /) 
		{
		$runningip_relay++;
		if ($DB) {print "ip_relay RUNNING:                |$psoutput[$i]|\n";}
		}
$i++;
}





##### Second, IF MORE THAN ONE LISTEN INSTANCE IS RUNNING, KILL THE SECOND ONE #####
@psline=@MT;
@psoutput=@MT;
@listen_pid=@MT;
if ($runningAST_listen > 1)
{
$runningAST_listen=0;

	sleep(1);

### you may have to use a different ps command if you're not using Slackware Linux
#	@psoutput = `ps -f -C AST_update --no-headers`;
#	@psoutput = `ps -f -C AST_updat* --no-headers`;
#	@psoutput = `/bin/ps -f --no-headers -A`;
#	@psoutput = `/bin/ps -o pid,args -A`; ### use this one for FreeBSD
@psoutput = `/bin/ps -o "%p %a" --no-headers -A`;

$i=0;
foreach (@psoutput)
	{
		chomp($psoutput[$i]);
	if ($DBX) {print "$i|$psoutput[$i]|     \n";}
	@psline = split(/\/usr\/bin\/perl /,$psoutput[$i]);
	$psoutput[$i] =~ s/^ *//gi;
	$psoutput[$i] =~ s/ .*|\n|\r|\t| //gi;

	if ($psline[1] =~ /AST_manager_li/) 
		{
		$listen_pid[$runningAST_listen] = $psoutput[$i];
		if ($DB) {print "AST_listen RUNNING:              |$psline[1]|$listen_pid[$runningAST_listen]|\n";}
		$runningAST_listen++;
		}

	$i++;
	}

if ($runningAST_listen > 1)
	{
	if ($DB) {print "Killing AST_manager_listen... |$listen_pid[1]|\n";}
	`/bin/kill -s 9 $listen_pid[1]`;
	}
}







##### Third, double-check that non-running scripts are not running #####
@psline=@MT;
@psoutput=@MT;

if ( 
	( ($AST_update > 0) && ($runningAST_update < 1) ) ||
	( ($AST_send_listen > 0) && ($runningAST_send < 1) ) ||
	( ($AST_send_listen > 0) && ($runningAST_listen < 1) ) ||
	( ($AST_VDauto_dial > 0) && ($runningAST_VDauto_dial < 1) ) ||
	( ($AST_VDremote_agents > 0) && ($runningAST_VDremote_agents < 1) ) ||
	( ($AST_VDadapt > 0) && ($runningAST_VDadapt < 1) ) ||
	( ($FastAGI_log > 0) && ($runningFastAGI_log < 1) ) ||
	( ($AST_VDauto_dial_FILL > 0) && ($runningAST_VDauto_dial_FILL < 1) ) ||
	( ($ip_relay > 0) && ($runningip_relay < 1) )
   )
{

if ($DB) {print "double check that processes are not running...\n";}

	sleep(1);

`PERL5LIB="$PATHhome/libs"; export PERL5LIB`;
### you may have to use a different ps command if you're not using Slackware Linux
#	@psoutput = `ps -f -C AST_update --no-headers`;
#	@psoutput = `ps -f -C AST_updat* --no-headers`;
#	@psoutput = `/bin/ps -f --no-headers -A`;
#	@psoutput = `/bin/ps -o pid,args -A`; ### use this one for FreeBSD
@psoutput2 = `/bin/ps -o "%p %a" --no-headers -A`;
$i=0;
foreach (@psoutput2)
	{
		chomp($psoutput2[$i]);
	if ($DBX) {print "$i|$psoutput2[$i]|     \n";}
	@psline = split(/\/usr\/bin\/perl /,$psoutput2[$i]);

	if ($psline[1] =~ /$REGhome\/AST_update\.pl/) 
		{
		$runningAST_update++;
		if ($DB) {print "AST_update RUNNING:              |$psline[1]|\n";}
		}
	if ($psline[1] =~ /AST_manager_se/) 
		{
		$runningAST_send++;
		if ($DB) {print "AST_send RUNNING:                |$psline[1]|\n";}
		}
	if ($psline[1] =~ /AST_manager_li/) 
		{
		$runningAST_listen++;
		if ($DB) {print "AST_listen RUNNING:              |$psline[1]|\n";}
		}
	if ($psline[1] =~ /$REGhome\/AST_VDauto_dial\.pl/) 
		{
		$runningAST_VDauto_dial++;
		if ($DB) {print "AST_VDauto_dial RUNNING:         |$psline[1]|\n";}
		}
	if ($psline[1] =~ /$REGhome\/AST_VDremote_agents\.pl/) 
		{
		$runningAST_VDremote_agents++;
		if ($DB) {print "AST_VDremote_agents RUNNING:     |$psline[1]|\n";}
		}
	if ($psline[1] =~ /$REGhome\/AST_VDadapt\.pl/) 
		{
		$runningAST_VDadapt++;
		if ($DB) {print "AST_VDadapt RUNNING:             |$psline[1]|\n";}
		}
	if ($psline[1] =~ /$REGhome\/FastAGI_log\.pl/) 
		{
		$runningFastAGI_log++;
		if ($DB) {print "FastAGI_log RUNNING:             |$psline[1]|\n";}
		}
	if ($psline[1] =~ /$REGhome\/AST_VDauto_dial_FILL\.pl/) 
		{
		$runningAST_VDauto_dial_FILL++;
		if ($DB) {print "AST_VDauto_dial_FILL RUNNING:    |$psline[1]|\n";}
		}
	if ($psoutput2[$i] =~ / ip_relay /) 
		{
		$runningip_relay++;
		if ($DB) {print "ip_relay RUNNING:                |$psoutput2[$i]|\n";}
		}
	$i++;
	}


if ( ($AST_update > 0) && ($runningAST_update < 1) )
	{ 
	if ($DB) {print "starting AST_update...\n";}
	# add a '-L' to the command below to activate logging
	`/usr/bin/screen -d -m -S ASTupdate $PATHhome/AST_update.pl`;
	}
if ( ($AST_send_listen > 0) && ($runningAST_send < 1) )
	{ 
	if ($DB) {print "starting AST_manager_send...\n";}
	# add a '-L' to the command below to activate logging
	`/usr/bin/screen -d -m -S ASTsend $PATHhome/AST_manager_send.pl`;
	}
if ( ($AST_send_listen > 0) && ($runningAST_listen < 1) )
	{ 
	if ($DB) {print "starting AST_manager_listen...\n";}
	# add a '-L' to the command below to activate logging
	`/usr/bin/screen -d -m -S ASTlisten $PATHhome/AST_manager_listen.pl`;
	}
if ( ($AST_VDauto_dial > 0) && ($runningAST_VDauto_dial < 1) )
	{ 
	if ($DB) {print "starting AST_VDauto_dial...\n";}
	# add a '-L' to the command below to activate logging
	`/usr/bin/screen -d -m -S ASTVDauto $PATHhome/AST_VDauto_dial.pl`;
	}
if ( ($AST_VDremote_agents > 0) && ($runningAST_VDremote_agents < 1) )
	{ 
	if ($DB) {print "starting AST_VDremote_agents...\n";}
	# add a '-L' to the command below to activate logging
	`/usr/bin/screen -d -m -S ASTVDremote $PATHhome/AST_VDremote_agents.pl`;
	}
if ( ($AST_VDadapt > 0) && ($runningAST_VDadapt < 1) )
	{ 
	if ($DB) {print "starting AST_VDadapt...\n";}
	# add a '-L' to the command below to activate logging
	`/usr/bin/screen -d -m -S ASTVDadapt $PATHhome/AST_VDadapt.pl --debug`;
	}
if ( ($FastAGI_log > 0) && ($runningFastAGI_log < 1) )
	{ 
	if ($DB) {print "starting FastAGI_log...\n";}
	# add a '-L' to the command below to activate logging
	`/usr/bin/screen -d -m -S ASTfastlog $PATHhome/FastAGI_log.pl --debug`;
	}
if ( ($AST_VDauto_dial_FILL > 0) && ($runningAST_VDauto_dial_FILL < 1) )
	{ 
	if ($DB) {print "starting AST_VDauto_dial_FILL...\n";}
	# add a '-L' to the command below to activate logging
	`/usr/bin/screen -d -m -S ASTVDautoFILL $PATHhome/AST_VDauto_dial_FILL.pl`;
	}
if ( ($ip_relay > 0) && ($runningip_relay < 1) )
	{ 
	if ($DB) {print "starting ip_relay through relay_control...\n";}
	`$PATHhome/ip_relay/relay_control start  2>/dev/null 1>&2`;
	}
}



### run the Timeclock auto-logout process ###
if ($timeclock_auto_logout > 0)
	{
	if ($DB) {print "running Timeclock auto-logout process...\n";}
	`/usr/bin/screen -d -m -S Timeclock $PATHhome/ADMIN_timeclock_auto_logout.pl 2>/dev/null 1>&2`;
	}








################################################################################
#####  START Creation of auto-generated conf files
################################################################################

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
	if ( ($line =~ /^PATHlogs/) && ($CLIlogs < 1) )
		{$PATHlogs = $line;   $PATHlogs =~ s/.*=//gi;}
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

##### Get the settings for this server's server_ip #####
$stmtA = "SELECT active_asterisk_server,generate_vicidial_conf,rebuild_conf_files,asterisk_version FROM servers where server_ip='$server_ip';";
#	print "$stmtA\n";
$sthA = $dbhA->prepare($stmtA) or die "preparing: ",$dbhA->errstr;
$sthA->execute or die "executing: $stmtA ", $dbhA->errstr;
$sthArows=$sthA->rows;
if ($sthArows > 0)
	{
	@aryA = $sthA->fetchrow_array;
	$active_asterisk_server	=	"$aryA[0]";
	$generate_vicidial_conf	=	"$aryA[1]";
	$rebuild_conf_files	=		"$aryA[2]";
	$asterisk_version	=		"$aryA[3]";
	$i++;
	}
$sthA->finish();


if ( ($active_asterisk_server =~ /Y/) && ($generate_vicidial_conf =~ /Y/) && ($rebuild_conf_files =~ /Y/) ) 
	{
	if ($DB) {print "generating new auto-gen conf files\n";}

	if (-e "/root/asterisk_command_reload_iax2")
		{
		$stmtA="UPDATE servers SET rebuild_conf_files='N' where server_ip='$server_ip';";
		$affected_rows = $dbhA->do($stmtA);
		}

	### format the new server_ip dialstring for example to use with extensions.conf
	$S='*';
	if( $VARserver_ip =~ m/(\S+)\.(\S+)\.(\S+)\.(\S+)/ )
		{
		$a = leading_zero($1); 
		$b = leading_zero($2); 
		$c = leading_zero($3); 
		$d = leading_zero($4);
		$VARremDIALstr = "$a$S$b$S$c$S$d";
		}

	$Lext  = "\n";
	$Lext .= "; Local Server: $server_ip\n";
	$Lext .= "exten => _$VARremDIALstr*.,1,Goto(default,\${EXTEN:16},1)\n";

	##### Get the server_id for this server's server_ip #####
	$stmtA = "SELECT server_id FROM servers where server_ip='$server_ip';";
	#	print "$stmtA\n";
	$sthA = $dbhA->prepare($stmtA) or die "preparing: ",$dbhA->errstr;
	$sthA->execute or die "executing: $stmtA ", $dbhA->errstr;
	$sthArows=$sthA->rows;
	if ($sthArows > 0)
		{
		@aryA = $sthA->fetchrow_array;
		$server_id	=	"$aryA[0]";
		$i++;
		}
	$sthA->finish();

	##### Get the server_ips and server_ids of all VICIDIAL servers on the network #####
	$stmtA = "SELECT server_ip,server_id FROM servers where server_ip!='$server_ip' and active_asterisk_server='Y' order by server_ip;";
	#	print "$stmtA\n";
	$sthA = $dbhA->prepare($stmtA) or die "preparing: ",$dbhA->errstr;
	$sthA->execute or die "executing: $stmtA ", $dbhA->errstr;
	$sthArows=$sthA->rows;
	$i=0;
	while ($sthArows > $i)
		{
		@aryA = $sthA->fetchrow_array;
		$server_ip[$i]	=	"$aryA[0]";
		$server_id[$i]	=	"$aryA[1]";

		if( $server_ip[$i] =~ m/(\S+)\.(\S+)\.(\S+)\.(\S+)/ )
			{
			$a = leading_zero($1); 
			$b = leading_zero($2); 
			$c = leading_zero($3); 
			$d = leading_zero($4);
			$VARremDIALstr = "$a$S$b$S$c$S$d";
			}
		$ext  .= "TRUNK$server_id[$i] = IAX2/$server_id:test\@$server_ip[$i]:4569\n";

		$iax  .= "register => $server_id:test\@$server_ip[$i]:4569\n";

		$Lext .= "; Remote Server VDAD extens: $server_id[$i] $server_ip[$i]\n";
		$Lext .= "exten => _$VARremDIALstr*.,1,Dial(\${TRUNK$server_id[$i]}/\${EXTEN:16},55,o)\n";

		$Liax .= "\n";
		$Liax .= "[$server_id[$i]]\n";
		$Liax .= "accountcode=IAX$server_id[$i]\n";
		$Liax .= "secret=test\n";
		$Liax .= "type=friend\n";
		$Liax .= "context=default\n";
		$Liax .= "auth=plaintext\n";
		$Liax .= "host=dynamic\n";
		$Liax .= "permit=0.0.0.0/0.0.0.0\n";
		$Liax .= "disallow=all\n";
		$Liax .= "allow=ulaw\n";
		$Liax .= "qualify=yes\n";

		$i++;
		}
	$sthA->finish();


	##### Get the IAX carriers for this server_ip #####
	$stmtA = "SELECT carrier_id,carrier_name,registration_string,template_id,account_entry,globals_string,dialplan_entry FROM vicidial_server_carriers where server_ip='$server_ip' and active='Y' and protocol='IAX2' order by carrier_id;";
	$sthA = $dbhA->prepare($stmtA) or die "preparing: ",$dbhA->errstr;
	$sthA->execute or die "executing: $stmtA ", $dbhA->errstr;
	$sthArows=$sthA->rows;
	$i=0;
	while ($sthArows > $i)
		{
		@aryA = $sthA->fetchrow_array;
		$carrier_id[$i]	=			"$aryA[0]";
		$carrier_name[$i]	=		"$aryA[1]";
		$registration_string[$i] =	"$aryA[2]";
		$template_id[$i] =			"$aryA[3]";
		$account_entry[$i] =		"$aryA[4]";
		$globals_string[$i] =		"$aryA[5]";
		$dialplan_entry[$i] =		"$aryA[6]";
		$i++;
		}
	$sthA->finish();

	$i=0;
	while ($sthArows > $i)
		{
		$template_contents[$i]='';
		if ( (length($template_id[$i]) > 1) && ($template_id[$i] !~ /--NONE--/) ) 
			{
			$stmtA = "SELECT template_contents FROM vicidial_conf_templates where template_id='$template_id[$i]';";
			$sthA = $dbhA->prepare($stmtA) or die "preparing: ",$dbhA->errstr;
			$sthA->execute or die "executing: $stmtA ", $dbhA->errstr;
			$sthBrows=$sthA->rows;
			if ($sthBrows > 0)
				{
				@aryA = $sthA->fetchrow_array;
				$template_contents[$i]	=	"$aryA[0]";
				}
			$sthA->finish();
			}
		$ext  .= "$globals_string[$i]\n";

		$iax  .= "$registration_string[$i]\n";

		$Lext .= "; VICIDIAL Carrier: $carrier_id[$i] - $carrier_name[$i]\n";
		$Lext .= "$dialplan_entry[$i]\n";

		$Liax .= "; VICIDIAL Carrier: $carrier_id[$i] - $carrier_name[$i]\n";
		$Liax .= "$account_entry[$i]\n";
		$Liax .= "$template_contents[$i]\n";

		$i++;
		}



	##### Get the SIP carriers for this server_ip #####
	$stmtA = "SELECT carrier_id,carrier_name,registration_string,template_id,account_entry,globals_string,dialplan_entry FROM vicidial_server_carriers where server_ip='$server_ip' and active='Y' and protocol='SIP' order by carrier_id;";
	$sthA = $dbhA->prepare($stmtA) or die "preparing: ",$dbhA->errstr;
	$sthA->execute or die "executing: $stmtA ", $dbhA->errstr;
	$sthArows=$sthA->rows;
	$i=0;
	while ($sthArows > $i)
		{
		@aryA = $sthA->fetchrow_array;
		$carrier_id[$i]	=			"$aryA[0]";
		$carrier_name[$i]	=		"$aryA[1]";
		$registration_string[$i] =	"$aryA[2]";
		$template_id[$i] =			"$aryA[3]";
		$account_entry[$i] =		"$aryA[4]";
		$globals_string[$i] =		"$aryA[5]";
		$dialplan_entry[$i] =		"$aryA[6]";
		$i++;
		}
	$sthA->finish();

	$i=0;
	while ($sthArows > $i)
		{
		$template_contents[$i]='';
		if ( (length($template_id[$i]) > 1) && ($template_id[$i] !~ /--NONE--/) ) 
			{
			$stmtA = "SELECT template_contents FROM vicidial_conf_templates where template_id='$template_id[$i]';";
			$sthA = $dbhA->prepare($stmtA) or die "preparing: ",$dbhA->errstr;
			$sthA->execute or die "executing: $stmtA ", $dbhA->errstr;
			$sthBrows=$sthA->rows;
			if ($sthBrows > 0)
				{
				@aryA = $sthA->fetchrow_array;
				$template_contents[$i]	=	"$aryA[0]";
				}
			$sthA->finish();
			}
		$ext  .= "$globals_string[$i]\n";

		$sip  .= "$registration_string[$i]\n";

		$Lext .= "; VICIDIAL Carrier: $carrier_id[$i] - $carrier_name[$i]\n";
		$Lext .= "$dialplan_entry[$i]\n";

		$Lsip .= "; VICIDIAL Carrier: $carrier_id[$i] - $carrier_name[$i]\n";
		$Lsip .= "$account_entry[$i]\n";
		$Lsip .= "$template_contents[$i]\n";

		$i++;
		}



	##### Get the IAX phone entries #####
	$stmtA = "SELECT extension,dialplan_number,voicemail_id,pass,template_id,conf_override,email,template_id,conf_override FROM phones where server_ip='$server_ip' and protocol='IAX2' and active='Y' order by extension;";
	#	print "$stmtA\n";
	$sthA = $dbhA->prepare($stmtA) or die "preparing: ",$dbhA->errstr;
	$sthA->execute or die "executing: $stmtA ", $dbhA->errstr;
	$sthArows=$sthA->rows;
	$i=0;
	while ($sthArows > $i)
		{
		@aryA = $sthA->fetchrow_array;
		$extension[$i] =	"$aryA[0]";
		$dialplan[$i] =		"$aryA[1]";
		$voicemail[$i] =	"$aryA[2]";
		$pass[$i] =			"$aryA[3]";
		$template_id[$i] =	"$aryA[4]";
		$conf_override[$i] ="$aryA[5]";
		$email[$i] =		"$aryA[6]";
		$template_id[$i] =	"$aryA[7]";
		$conf_override[$i] ="$aryA[8]";
		$i++;
		}
	$sthA->finish();

	$i=0;
	while ($sthArows > $i)
		{
		$conf_entry_written=0;
		$template_contents[$i]='';
		if ( (length($template_id[$i]) > 1) && ($template_id[$i] !~ /--NONE--/) ) 
			{
			$stmtA = "SELECT template_contents FROM vicidial_conf_templates where template_id='$template_id[$i]';";
			$sthA = $dbhA->prepare($stmtA) or die "preparing: ",$dbhA->errstr;
			$sthA->execute or die "executing: $stmtA ", $dbhA->errstr;
			$sthBrows=$sthA->rows;
			if ($sthBrows > 0)
				{
				@aryA = $sthA->fetchrow_array;
				$template_contents[$i]	=	"$aryA[0]";

				$Piax .= "\n\[$extension[$i]\]\n";
				$Piax .= "username=$extension[$i]\n";
				$Piax .= "secret=$pass[$i]\n";
				$Piax .= "mailbox=$voicemail[$i]\n";
				$Piax .= "$template_contents[$i]\n";
				
				$conf_entry_written++;
				}
			$sthA->finish();
			}
		if (length($conf_override[$i]) > 10)
			{
			$Piax .= "\n\[$extension[$i]\]\n";
			$Piax .= "$conf_override[$i]\n";
			$conf_entry_written++;
			}
		if ($conf_entry_written < 1)
			{
			$Piax .= "\n\[$extension[$i]\]\n";
			$Piax .= "username=$extension[$i]\n";
			$Piax .= "secret=$pass[$i]\n";
			$Piax .= "mailbox=$voicemail[$i]\n";
			$Piax .= "context=default\n";
			$Piax .= "type=friend\n";
			$Piax .= "auth=md5\n";
			$Piax .= "host=dynamic\n";
			}
		$Pext .= "exten => $dialplan[$i],1,Dial(IAX2/$extension[$i])\n";
		$Pext .= "exten => $dialplan[$i],2,Voicemail,u$voicemail[$i]\n";

		$vm  .= "$voicemail[$i] => $voicemail[$i],$extension[$i] Mailbox,$email[$i]\n";

		$i++;
		}


	##### Get the SIP phone entries #####
	$stmtA = "SELECT extension,dialplan_number,voicemail_id,pass,template_id,conf_override,email,template_id,conf_override FROM phones where server_ip='$server_ip' and protocol='SIP' and active='Y' order by extension;";
	#	print "$stmtA\n";
	$sthA = $dbhA->prepare($stmtA) or die "preparing: ",$dbhA->errstr;
	$sthA->execute or die "executing: $stmtA ", $dbhA->errstr;
	$sthArows=$sthA->rows;
	$i=0;
	while ($sthArows > $i)
		{
		@aryA = $sthA->fetchrow_array;
		$extension[$i] =	"$aryA[0]";
		$dialplan[$i] =		"$aryA[1]";
		$voicemail[$i] =	"$aryA[2]";
		$pass[$i] =			"$aryA[3]";
		$template_id[$i] =	"$aryA[4]";
		$conf_override[$i] ="$aryA[5]";
		$email[$i] =		"$aryA[6]";
		$template_id[$i] =	"$aryA[7]";
		$conf_override[$i] ="$aryA[8]";
		$i++;
		}
	$sthA->finish();

	$i=0;
	while ($sthArows > $i)
		{
		$conf_entry_written=0;
		$template_contents[$i]='';
		if ( (length($template_id[$i]) > 1) && ($template_id[$i] !~ /--NONE--/) ) 
			{
			$stmtA = "SELECT template_contents FROM vicidial_conf_templates where template_id='$template_id[$i]';";
			$sthA = $dbhA->prepare($stmtA) or die "preparing: ",$dbhA->errstr;
			$sthA->execute or die "executing: $stmtA ", $dbhA->errstr;
			$sthBrows=$sthA->rows;
			if ($sthBrows > 0)
				{
				@aryA = $sthA->fetchrow_array;
				$template_contents[$i]	=	"$aryA[0]";

				$Psip .= "\n\[$extension[$i]\]\n";
				$Psip .= "username=$extension[$i]\n";
				$Psip .= "secret=$pass[$i]\n";
				$Psip .= "mailbox=$voicemail[$i]\n";
				$Psip .= "$template_contents[$i]\n";
				
				$conf_entry_written++;
				}
			$sthA->finish();
			}
		if (length($conf_override[$i]) > 10)
			{
			$Psip .= "\n\[$extension[$i]\]\n";
			$Psip .= "$conf_override[$i]\n";
			$conf_entry_written++;
			}
		if ($conf_entry_written < 1)
			{
			$Psip .= "\n\[$extension[$i]\]\n";
			$Psip .= "username=$extension[$i]\n";
			$Psip .= "secret=$pass[$i]\n";
			$Psip .= "mailbox=$voicemail[$i]\n";
			$Psip .= "context=default\n";
			$Psip .= "type=friend\n";
			$Psip .= "host=dynamic\n";
			}
		$Pext .= "exten => $dialplan[$i],1,Dial(SIP/$extension[$i])\n";
		$Pext .= "exten => $dialplan[$i],2,Voicemail,u$voicemail[$i]\n";

		$vm  .= "$voicemail[$i] => $voicemail[$i],$extension[$i] Mailbox,$email[$i]\n";

		$i++;
		}


	if ($DB) {print "writing auto-gen conf files\n";}

	open(ext, ">/etc/asterisk/extensions-vicidial.conf") || die "can't open /etc/asterisk/extensions-vicidial.conf: $!\n";
	open(iax, ">/etc/asterisk/iax-vicidial.conf") || die "can't open /etc/asterisk/iax-vicidial.conf: $!\n";
	open(sip, ">/etc/asterisk/sip-vicidial.conf") || die "can't open /etc/asterisk/sip-vicidial.conf: $!\n";
	open(vm, ">/etc/asterisk/voicemail-vicidial.conf") || die "can't open /etc/asterisk/voicemail-vicidial.conf: $!\n";

	print ext "; WARNING- THIS FILE IS AUTO-GENERATED BY VICIDIAL, ANY EDITS YOU MAKE WILL BE LOST\n";
	print ext "[globals]\n";
	print ext "$ext\n";
	print ext "[vicidial-auto]\n";
	print ext "exten => h,1,DeadAGI(agi://127.0.0.1:4577/call_log--HVcauses--PRI-----NODEBUG-----${HANGUPCAUSE}-----${DIALSTATUS}-----${DIALEDTIME}-----${ANSWEREDTIME})\n";
	print ext "$Lext\n";
	print ext "$Pext\n";

	print iax "; WARNING- THIS FILE IS AUTO-GENERATED BY VICIDIAL, ANY EDITS YOU MAKE WILL BE LOST\n";
	print iax "$iax\n";
	print iax "$Liax\n";
	print iax "$Piax\n";

	print sip "; WARNING- THIS FILE IS AUTO-GENERATED BY VICIDIAL, ANY EDITS YOU MAKE WILL BE LOST\n";
	print sip "$sip\n";
	print sip "$Lsip\n";
	print sip "$Psip\n";

	print vm "; WARNING- THIS FILE IS AUTO-GENERATED BY VICIDIAL, ANY EDITS YOU MAKE WILL BE LOST\n";
	print vm "[vicidial-auto]\n";
	print vm "$vm\n";

	close(ext);
	close(iax);
	close(sip);
	close(vm);


	sleep(1);

	### reload Asterisk
	if ($DB) {print "reloading asterisk\n";}
	if ($asterisk_version =~ /^1.2/)
		{
		`echo iax2\ reload > /root/asterisk_command_reload_iax2`;
		`echo sip\ reload > /root/asterisk_command_reload_sip`;
		`echo extensions\ reload > /root/asterisk_command_reload_extensions`;
		`echo reload\ app_voicemail.so > /root/asterisk_command_reload_voicemail`;
		}
	else
		{
		`echo iax2\ reload > /root/asterisk_command_reload_iax2`;
		`echo sip\ reload > /root/asterisk_command_reload_sip`;
		`echo dialplan\ reload > /root/asterisk_command_reload_extensions`;
		`echo reload\ app_voicemail.so > /root/asterisk_command_reload_voicemail`;
		}
	`screen -XS asterisk readbuf /root/asterisk_command_reload_iax2`;
	sleep(1);
	`screen -XS asterisk paste .`;
	sleep(3);
	`screen -XS asterisk readbuf /root/asterisk_command_reload_sip`;
	sleep(1);
	`screen -XS asterisk paste .`;
	sleep(3);
	`screen -XS asterisk readbuf /root/asterisk_command_reload_extensions`;
	sleep(1);
	`screen -XS asterisk paste .`;
	sleep(3);
	`screen -XS asterisk readbuf /root/asterisk_command_reload_voicemail`;
	sleep(1);
	`screen -XS asterisk paste .`;
	sleep(10);
	}





################################################################################
#####  END Creation of auto-generated conf files
################################################################################





if ($DB) {print "DONE\n";}

exit;



sub leading_zero($) 
{
    $_ = $_[0];
    s/^(\d)$/0$1/;
    s/^(\d\d)$/0$1/;
    return $_;
} # End of the leading_zero() routine.
