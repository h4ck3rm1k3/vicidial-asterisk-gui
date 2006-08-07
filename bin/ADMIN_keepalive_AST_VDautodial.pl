#!/usr/bin/perl
#
# ADMIN_keepalive_AST_VDauto_dial.pl   version  0.4
#
# designed to keep the AST_update processes aline and check every minute
#
# Copyright (C) 2006  Matt Florell <vicidial@gmail.com>    LICENSE: GPLv2
#
#
# 50810-1452 - removed '-L' flag for screen logging of output (optimization)
# 50823-1454 - Added commandline debug options with debug printouts
# 60807-1315 - changed to use /etc/astguiclient.conf for settings
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

$REGhome = $PATHhome;
$REGhome =~ s/\//\\\//gi;

#@psoutput = `ps -f -C AST_update --no-headers`;
#@psoutput = `ps -f -C AST_updat* --no-headers`;
#@psoutput = `/bin/ps -f --no-headers -A`;
@psoutput = `/bin/ps -o "%p %a" --no-headers -A`;

$running_VDAD = 0;

$i=0;
foreach (@psoutput)
{
	chomp($psoutput[$i]);
if ($DBX) {print "$i|$psoutput[$i]|     \n";}
@psline = split(/\/usr\/bin\/perl /,$psoutput[$i]);

if ($psline[1] =~ /$REGhome\/AST_VDauto_dial\.pl/) 
	{
	$running_VDAD++;
	if ($DB) {print "VDAD RUNNING: |$psline[1]|\n";}
	}

$i++;
}


if (!$running_VDAD)
{
#	   print "double check that VDAD is not running\n";

	sleep(4);

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

	if ($psline[1] =~ /$REGhome\/AST_VDauto_dial\.pl/) 
		{
		$running_VDAD++;
		if ($DB) {print "VDAD RUNNING: |$psline[1]|\n";}
		}

	$i++;
	}

if (!$running_VDAD)
	{ 
	if ($DB) {print "starting AST_VDauto_dial...\n";}
	# add a '-L' to the command below to activate logging
	`/usr/bin/screen -d -m -S ASTVDauto $PATHhome/AST_VDauto_dial.pl`;
	}
}




	if ($DB) {print "DONE\n";}

exit;
