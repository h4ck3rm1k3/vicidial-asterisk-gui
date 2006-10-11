#!/usr/bin/perl
#
# ADMIN_keepalive_ALL.pl   version  0.1
#
# Designed to keep the astGUIclient processes alive and check every minute
# Replaces all other ADMIN_keepalive scripts
# Uses /etc/astguiclient.conf file to know which processes to keepalive
#
# Copyright (C) 2006  Matt Florell <vicidial@gmail.com>    LICENSE: GPLv2
#
#
# 61011-1348 - first build
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
$runningAST_update=0;
$runningAST_send=0;
$runningAST_listen=0;
$runningAST_VDauto_dial=0;
$runningAST_VDremote_agents=0;
$runningAST_VDadapt=0;
$runningFastAGI_log=0;
$launchAST_update=0;
$launchAST_send=0;
$launchAST_listen=0;
$launchAST_VDauto_dial=0;
$launchAST_VDremote_agents=0;
$launchAST_VDadapt=0;
$launchFastAGI_log=0;

if ($VARactive_keepalives =~ /1/) {$AST_update=1;}
if ($VARactive_keepalives =~ /2/) {$AST_send_listen=1;}
if ($VARactive_keepalives =~ /3/) {$AST_VDauto_dial=1;}
if ($VARactive_keepalives =~ /4/) {$AST_VDremote_agents=1;}
if ($VARactive_keepalives =~ /5/) {$AST_VDadapt=1;}
if ($VARactive_keepalives =~ /6/) {$FastAGI_log=1;}

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
	$psoutput[$i] =~ s/ .*|\n|\r|\t| //gi;
	$listen_pid[$runningAST_listen] = $psoutput[$i];

	if ($psline[1] =~ /AST_manager_li/) 
		{
		if ($DB) {print "AST_listen RUNNING:              |$psline[1]|\n";}
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
	( ($FastAGI_log > 0) && ($runningFastAGI_log < 1) )
   )
{

if ($DB) {print "double check that processes are not running...\n";}

	sleep(1);

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
}




if ($DB) {print "DONE\n";}

exit;
