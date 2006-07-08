#!/usr/bin/perl
#
# ADMIN_keepalive_AST_VDremote_agents.pl   version  0.3
#
# designed to keep the AST_update processes aline and check every minute
#
# Copyright (C) 2006  Matt Florell <vicidial@gmail.com>    LICENSE: GPLv2
#
#
# 50810-1453 - removed '-L' flag for screen logging of output (optimization)
# 50823-1459 - Added commandline debug options with debug printouts
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

#@psoutput = `ps -f -C AST_update --no-headers`;
#@psoutput = `ps -f -C AST_updat* --no-headers`;
#@psoutput = `/bin/ps -f --no-headers -A`;
@psoutput = `/bin/ps -o "%p %a" --no-headers -A`;

$running_VDra = 0;

$i=0;
foreach (@psoutput)
{
	chomp($psoutput[$i]);
if ($DBX) {print "$i|$psoutput[$i]|     \n";}
@psline = split(/\/usr\/bin\/perl /,$psoutput[$i]);

if ($psline[1] =~ /\/home\/cron\/AST_VDremote_agents\.pl/) 
	{
	$running_VDra++;
	if ($DB) {print "VDra RUNNING: |$psline[1]|\n";}
	}

$i++;
}


if (!$running_VDra)
{
#	   print "double check that update is not running\n";

	sleep(5);

#@psoutput = `ps -f -C AST_update --no-headers`;
#@psoutput = `ps -f -C AST_updat* --no-headers`;
#@psoutput = `/bin/ps -f --no-headers -A`;
@psoutput = `/bin/ps -o "%p %a" --no-headers -A`;
$i=0;
foreach (@psoutput2)
	{
		chomp($psoutput2[$i]);
	if ($DBX) {print "$i|$psoutput[$i]|     \n";}
	@psline = split(/\/usr\/bin\/perl /,$psoutput2[$i]);

	if ($psline[1] =~ /\/home\/cron\/AST_VDremote_agents\.pl/)
		{
		$running_VDra++;
		if ($DB) {print "VDra RUNNING: |$psline[1]|\n";}
		}

	$i++;
	}

if (!$running_VDra)
	{ 
	if ($DB) {print "starting AST_VDremote_agents...\n";}
	# add a '-L' to the command below to activate logging
	`/usr/bin/screen -d -m -S ASTVDremote /home/cron/AST_VDremote_agents.pl`;
	}
}




	if ($DB) {print "DONE\n";}

exit;
