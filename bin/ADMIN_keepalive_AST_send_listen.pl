#!/usr/bin/perl
#
# ADMIN_keepalive_AST_send_listen.pl version 0.3
#
# designed to keep the AST_manager_listen and manager_send processes alive and check every minute
#
# if you are on an older system you may need to change the @psoutput lines to fit your ps version
#
# Copyright (C) 2006  Matt Florell <vicidial@gmail.com>    LICENSE: GPLv2
#
#
# 50810-1450 - removed '-L' flag for screen logging of output (optimization)
# 50823-1440 - Added commandline debug options with debug printouts
# 60718-1045 - changed to use /etc/astguiclient.conf for configs
# 60718-1213 - fixed double-check and added kill for multiple listen processes
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
	$i++;
	}

#@psoutput = `ps -f -C AST_manager --no-headers`;
#@psoutput = `ps -f --no-headers -C AST_manager_s*; ps -f --no-headers -C AST_manager_l*`;
#@psoutput = `/bin/ps -f --no-headers -A`;
@psoutput = `/bin/ps -o "%p %a" --no-headers -A`;

$running_listen = 0;
$running_send = 0;

$i=0;
foreach (@psoutput)
{
	chomp($psoutput[$i]);
if ($DBX) {print "$i|$psoutput[$i]|     \n";}
@psline = split(/\/usr\/bin\/perl /,$psoutput[$i]);

if ($psline[1] =~ /AST_manager_li/)
	{
	$psoutput[$i] =~ s/ .*|\n|\r|\t| //gi;
	$listen_pid[$running_listen] = $psoutput[$i];
	$running_listen++;
	if ($DB) {print "LISTEN RUNNING: |$psline[1]|$psoutput[$i]|\n";}
	}
if ($psline[1] =~ /AST_manager_se/)
	{
	$psoutput[$i] =~ s/ .*|\n|\r|\t| //gi;
	$send_pid[$running_send] = $psoutput[$i];
	$running_send++;
	if ($DB) {print "SEND RUNNING:   |$psline[1]|$psoutput[$i]|\n";}
	}

$i++;
}


@psline=@MT;
@psoutput=@MT;
@listen_pid=@MT;
@send_pid=@MT;


##### IF MORE THAN ONE LISTEN INSTANCE IS RUNNING, KILL THE SECOND ONE #####
if ($running_listen > 1)
{
$running_listen=0;

	sleep(1);

#@psoutput = `ps -f -C AST_manager --no-headers`;
#@psoutput = `ps -f --no-headers -C AST_manager_s*; ps -f --no-headers -C AST_manager_l*`;
#@psoutput = `/bin/ps -f --no-headers -A`;
@psoutput = `/bin/ps -o "%p %a" --no-headers -A`;

$i=0;
foreach (@psoutput)
	{
		chomp($psoutput[$i]);
	if ($DBX) {print "$i|$psoutput[$i]|     \n";}
	@psline = split(/\/usr\/bin\/perl /,$psoutput[$i]);
	$psoutput[$i] =~ s/ .*|\n|\r|\t| //gi;
	$listen_pid[$running_listen] = $psoutput[$i];

	if ($psline[1] =~ /AST_manager_li/) 
		{
		if ($DB) {print "LISTEN RUNNING: |$psline[1]|$psoutput[$i]|\n";}
		$running_listen++;
		}

	$i++;
	}

if ($running_listen > 1)
	{
	if ($DB) {print "Killing AST_manager_listen... |$listen_pid[1]|\n";}
	`/bin/kill -s 9 $listen_pid[1]`;
	}
}



@psline=@MT;
@psoutput=@MT;
@listen_pid=@MT;
@send_pid=@MT;



##### IF LISTEN IS NOT RUNNING, START IT #####
if (!$running_listen)
{
$running_listen=0;
	sleep(1);

#@psoutput = `ps -f -C AST_manager --no-headers`;
#@psoutput = `ps -f --no-headers -C AST_manager_s*; ps -f --no-headers -C AST_manager_l*`;
#@psoutput = `/bin/ps -f --no-headers -A`;
@psoutput = `/bin/ps -o "%p %a" --no-headers -A`;

$i=0;
foreach (@psoutput)
	{
		chomp($psoutput[$i]);
	if ($DBX) {print "$i|$psoutput[$i]|     \n";}
	@psline = split(/\/usr\/bin\/perl /,$psoutput[$i]);
	$psoutput[$i] =~ s/ .*|\n|\r|\t| //gi;
	$listen_pid[$running_listen] = $psoutput[$i];

	if ($psline[1] =~ /AST_manager_li/) 
		{
		$running_listen++;
		if ($DB) {print "LISTEN RUNNING: |$psline[1]|$psoutput[$i]|\n";}
		}

	$i++;
	}

if (!$running_listen)
	{
	if ($DB) {print "starting AST_manager_listen...\n";}
	# add a '-L' to the command below to activate logging
	`/usr/bin/screen -d -m -S ASTlisten $PATHhome/AST_manager_listen.pl`;
	}
}


@psline=@MT;
@psoutput=@MT;
@listen_pid=@MT;
@send_pid=@MT;




##### IF SEND IS NOT RUNNING, START IT #####
if (!$running_send)
{
$running_send=0;

	sleep(2);

#@psoutput = `ps -f -C AST_manager --no-headers`;
#@psoutput = `ps -f --no-headers -C AST_manager_s*; ps -f --no-headers -C AST_manager_l*`;
#@psoutput = `/bin/ps -f --no-headers -A`;
@psoutput = `/bin/ps -o "%p %a" --no-headers -A`;
$i=0;
foreach (@psoutput)
	{
		chomp($psoutput[$i]);
	if ($DBX) {print "$i|$psoutput[$i]|     \n";}
	@psline = split(/\/usr\/bin\/perl /,$psoutput[$i]);
	$psoutput[$i] =~ s/ .*|\n|\r|\t| //gi;
	$send_pid[$running_send] = $psoutput[$i];

	if ($psline[1] =~ /AST_manager_se/)
		{
		$running_send++;
		if ($DB) {print "SEND RUNNING:   |$psline[1]|$psoutput[$i]|";}
		}

	$i++;
	}

if (!$running_send)
	{
	if ($DB) {print "starting AST_manager_send...\n";}
	# add a '-L' to the command below to activate logging
	`/usr/bin/screen -d -m -S ASTsend $PATHhome/AST_manager_send.pl`;
	}
}




	if ($DB) {print "DONE\n";}

exit;
