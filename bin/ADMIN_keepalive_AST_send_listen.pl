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

	sleep(1);


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
	$running_listen++;
	if ($DB) {print "LISTEN RUNNING: |$psline[1]|\n";}
	}
if ($psline[1] =~ /AST_manager_se/)
	{
	$running_send++;
	if ($DB) {print "SEND RUNNING:   |$psline[1]|\n";}
	}

$i++;
}



if (!$running_listen)
{
	#   print "double check that update_11 is not running\n";

	sleep(1);

#@psoutput = `ps -f -C AST_manager --no-headers`;
#@psoutput = `ps -f --no-headers -C AST_manager_s*; ps -f --no-headers -C AST_manager_l*`;
#@psoutput = `/bin/ps -f --no-headers -A`;
@psoutput = `/bin/ps -o "%p %a" --no-headers -A`;

$i=0;
foreach (@psoutput2)
	{
		chomp($psoutput2[$i]);
	if ($DBX) {print "$i|$psoutput[$i]|     \n";}
	@psline = split(/\/usr\/bin\/perl /,$psoutput2[$i]);

	if ($psline[1] =~ /AST_manager_li/) 
		{
		$running_listen++;
		if ($DB) {print "LISTEN RUNNING: |$psline[1]|\n";}
		}

	$i++;
	}

if (!$running_listen)
	{
	if ($DB) {print "starting AST_manager_listen...\n";}
	# add a '-L' to the command below to activate logging
	`/usr/bin/screen -d -m -S ASTlisten /home/cron/AST_manager_listen.pl`;
	}
}




if (!$running_send)
{
	#   print "double check that update_12 is not running\n";

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

	if ($psline[1] =~ /AST_manager_se/)
		{
		$running_send++;
		if ($DB) {print "SEND RUNNING:   |$psline[1]|";}
		}

	$i++;
	}

if (!$running_send)
	{
	if ($DB) {print "starting AST_manager_send...\n";}
	# add a '-L' to the command below to activate logging
	`/usr/bin/screen -d -m -S ASTsend /home/cron/AST_manager_send.pl`;
	}
}




	if ($DB) {print "DONE\n";}

exit;
