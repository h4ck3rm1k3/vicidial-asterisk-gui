#!/usr/bin/perl
#
# start_asterisk_boot.pl    version 2.0.5
#
# Copyright (C) 2009  Matt Florell <vicidial@gmail.com>    LICENSE: AGPLv2
#
# CHANGES
#
# 60814-1658 - added option to start without logging through servers table setting
# 90309-0905 - Added deleting of asterisk command files
#

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

`PERL5LIB="$PATHhome/libs"; export PERL5LIB`;

use DBI;	  

$dbhA = DBI->connect("DBI:mysql:$VARDB_database:$VARDB_server:$VARDB_port", "$VARDB_user", "$VARDB_pass")
 or die "Couldn't connect to database: " . DBI->errstr;

### Grab Server values from the database
	$stmtA = "SELECT vd_server_logs FROM servers where server_ip = '$VARserver_ip';";
	$sthA = $dbhA->prepare($stmtA) or die "preparing: ",$dbhA->errstr;
	$sthA->execute or die "executing: $stmtA ", $dbhA->errstr;
	$sthArows=$sthA->rows;
	$rec_count=0;
	while ($sthArows > $rec_count)
		{
		 @aryA = $sthA->fetchrow_array;
			$DBvd_server_logs =			"$aryA[0]";
			if ($DBvd_server_logs =~ /Y/)	{$SYSLOG = '1';}
				else {$SYSLOG = '0';}
		 $rec_count++;
		}
	$sthA->finish();

if (-e "/root/asterisk_command_reload_iax2")
	{
	### find the find binary
	$findbin = '';
	if ( -e ('/bin/find')) {$findbin = '/bin/find';}
	else 
		{
		if ( -e ('/sbin/find')) {$findbin = '/sbin/find';}
		else 
			{
			if ( -e ('/usr/bin/find')) {$findbin = '/usr/bin/find';}
			else 
				{
				if ( -e ('/usr/local/bin/find')) {$findbin = '/usr/local/bin/find';}
				else
					{
					print "Can't find find binary! Exiting...\n";
					}
				}
			}
		}

	`$findbin /root/ -maxdepth 1 -name "asterisk_command*" -print | xargs rm -f`;

	`ulimit -n 65536`;

	}

if ($SYSLOG) 
	{
	print "\nStarting Asterisk... screen logging on\n";
	`/usr/bin/screen -L -d -m -S asterisk /usr/sbin/asterisk -vvvvvvvvvvvvvvvvvvvvvgc`;
	}
else
	{
	print "\nStarting Asterisk... screen logging off\n";
	`/usr/bin/screen -d -m -S asterisk /usr/sbin/asterisk -vvvvgc`;
	}

print "Asterisk started\n";

sleep(10);

