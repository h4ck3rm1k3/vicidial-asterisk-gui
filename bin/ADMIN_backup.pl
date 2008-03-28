#!/usr/bin/perl
#
# ADMIN_backup.pl    version 2.0.5
#
# DESCRIPTION:
# Backs-up the asterisk database, conf/agi/sounds/bin files 
#
# Copyright (C) 2008  Matt Florell <vicidial@gmail.com>    LICENSE: AGPLv2
#
# CHANGELOG
#
# 80316-2211 - First Build
# 80317-1609 - Added Sangoma conf file backup and changed FTP settings
# 80328-0135 - Do not attempt to archive /etc/my.cnf is --without-db flag is set
#


$secT = time();
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
	print "allowed run time options:\n";
	print "  [--all] = *DEFAULT* show GMT offset of records as they are inserted into hopper\n";
	print "  [--db-only] = only backup the database\n";
	print "  [--conf-only] = only backup the asterisk conf files\n";
	print "  [--without-db] = do not backup the database\n";
	print "  [--without-conf] = do not backup the conf files\n";
	print "  [--without-web] = do not backup web files\n";
	print "  [--without-sounds] = do not backup asterisk sounds\n";
	print "  [--ftp-transfer] = Transfer backup to FTP server\n";
	print "  [--debugX] = super debug\n";
	print "  [--debug] = debug\n";
	print "  [-t] = test\n";
	exit;
	}
	else
	{
	if ($args =~ /--debug/i)
		{
		$DB=1; $FTPdebug=1;
		print "\n----- DEBUG -----\n\n";
		}
	if ($args =~ /--debugX/i)
		{
		$DBX=1;
		print "\n----- SUPER DEBUG -----\n\n";
		}
	if ($args =~ /-t/i)
		{
		$T=1;   $TEST=1;
		print "\n-----TESTING -----\n\n";
		}
	if ($args =~ /--db-only/i)
		{
		$db_only=1;
		print "\n----- Backup Database Only -----\n\n";
		}
	if ($args =~ /--conf-only/i)
		{
		$conf_only=1;
		print "\n----- Conf Files Backup Only -----\n\n";
		}
	if ($args =~ /--without-db/i)
		{
		$without_db=1;
		print "\n----- No Database Backup -----\n\n";
		}
	if ($args =~ /--without-conf/i)
		{
		$without_conf=1;
		print "\n----- No Conf Files Backup -----\n\n";
		}
	if ($args =~ /--without-sounds/i)
		{
		$without_sounds=1;
		print "\n----- No Sounds Backup -----\n\n";
		}
	if ($args =~ /--without-web/i)
		{
		$without_web=1;
		print "\n----- No web files Backup -----\n\n";
		}
	if ($args =~ /--ftp-transfer/i)
		{
		$ftp_transfer=1;
		print "\n----- FTP transfer -----\n\n";
		}
	}
}
else
{
print "no command line options set\n";
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
	if ( ($line =~ /^VARREPORT_host/) && ($CLIREPORT_host < 1) )
		{$VARREPORT_host = $line;   $VARREPORT_host =~ s/.*=//gi;}
	if ( ($line =~ /^VARREPORT_user/) && ($CLIREPORT_user < 1) )
		{$VARREPORT_user = $line;   $VARREPORT_user =~ s/.*=//gi;}
	if ( ($line =~ /^VARREPORT_pass/) && ($CLIREPORT_pass < 1) )
		{$VARREPORT_pass = $line;   $VARREPORT_pass =~ s/.*=//gi;}
	if ( ($line =~ /^VARREPORT_port/) && ($CLIREPORT_port < 1) )
		{$VARREPORT_port = $line;   $VARREPORT_port =~ s/.*=//gi;}
	if ( ($line =~ /^VARREPORT_dir/) && ($CLIREPORT_dir < 1) )
		{$VARREPORT_dir = $line;   $VARREPORT_dir =~ s/.*=//gi;}

	$i++;
	}

if (!$ARCHIVEpath) {$ARCHIVEpath = "$PATHlogs/archive";}
if (!$VARDB_port) {$VARDB_port='3306';}

### find tar binary to do the archiving
$tarbin = '';
if ( -e ('/usr/bin/tar')) {$tarbin = '/usr/bin/tar';}
else 
	{
	if ( -e ('/usr/local/bin/tar')) {$tarbin = '/usr/local/bin/tar';}
	else
		{
		if ( -e ('/bin/tar')) {$tarbin = '/bin/tar';}
		else
			{
			print "Can't find tar binary! Exiting...\n";
			exit;
			}
		}
	}

### find gzip binary to do the archiving
$gzipbin = '';
if ( -e ('/usr/bin/gzip')) {$gzipbin = '/usr/bin/gzip';}
else 
	{
	if ( -e ('/usr/local/bin/gzip')) {$gzipbin = '/usr/local/bin/gzip';}
	else
		{
		if ( -e ('/bin/gzip')) {$gzipbin = '/bin/gzip';}
		else
			{
			print "Can't find gzip binary! Exiting...\n";
			exit;
			}
		}
	}

### find mysqldump binary to do the database dump
$mysqldumpbin = '';
if ( -e ('/usr/bin/mysqldump')) {$mysqldumpbin = '/usr/bin/mysqldump';}
else 
	{
	if ( -e ('/usr/local/mysql/bin/mysqldump')) {$mysqldumpbin = '/usr/local/mysql/bin/mysqldump';}
	else
		{
		if ( -e ('/bin/mysqldump')) {$mysqldumpbin = '/bin/mysqldump';}
		else
			{
			print "Can't find mysqldump binary! Exiting...\n";
			exit;
			}
		}
	}

$conf='_CONF_';
$sangoma='_SANGOMA_';
$linux='_LINUX_';
$bin='_BIN_';
$web='_WEB_';
$sounds='_SOUNDS_';
$all='_ALL_';
$tar='.tar';
$gz='.gz';
$sgSTRING='';

`cd $ARCHIVEpath`;
`mkdir $ARCHIVEpath/temp`;

if ( ($without_db < 1) && ($conf_only < 1) )
	{
	### BACKUP THE MYSQL FILES ON THE DB SERVER ###
	`$mysqldumpbin --lock-tables --flush-logs $VARDB_database | $gzipbin > $ARCHIVEpath/temp/$VARserver_ip$VARDB_database$wday.gz`;
	}

if ( ($without_conf < 1) && ($db_only < 1) )
	{
	### BACKUP THE ASTERISK CONF FILES ON THE SERVER ###
	`$tarbin cf $ARCHIVEpath/temp/$VARserver_ip$conf$wday$tar /etc/astguiclient.conf /etc/zaptel.conf /etc/asterisk`;

	### BACKUP THE WANPIPE CONF FILES(if there are any) ###
	if ( -e ('/etc/wanpipe/wanpipe1.conf')) 
		{
		$sgSTRING = '/etc/wanpipe/wanpipe1.conf ';
		if ( -e ('/etc/wanpipe/wanpipe2.conf')) {$sgSTRING .= '/etc/wanpipe/wanpipe2.conf ';}
		if ( -e ('/etc/wanpipe/wanpipe3.conf')) {$sgSTRING .= '/etc/wanpipe/wanpipe3.conf ';}
		if ( -e ('/etc/wanpipe/wanpipe4.conf')) {$sgSTRING .= '/etc/wanpipe/wanpipe4.conf ';}
		if ( -e ('/etc/wanpipe/wanpipe5.conf')) {$sgSTRING .= '/etc/wanpipe/wanpipe5.conf ';}
		if ( -e ('/etc/wanpipe/wanpipe6.conf')) {$sgSTRING .= '/etc/wanpipe/wanpipe6.conf ';}
		if ( -e ('/etc/wanpipe/wanpipe7.conf')) {$sgSTRING .= '/etc/wanpipe/wanpipe7.conf ';}
		if ( -e ('/etc/wanpipe/wanpipe8.conf')) {$sgSTRING .= '/etc/wanpipe/wanpipe8.conf ';}
		if ( -e ('/etc/wanpipe/wanrouter.rc')) {$sgSTRING .= '/etc/wanpipe/wanrouter.rc ';}

		`$tarbin cf $ARCHIVEpath/temp/$VARserver_ip$sangoma$wday$tar $sgSTRING`;
		}

	if ($without_db < 1)
		{
		### BACKUP OTHER CONF FILES ON THE SERVER ###
		`$tarbin cf $ARCHIVEpath/temp/$VARserver_ip$linux$wday$tar /etc/my.cnf /etc/hosts /etc/rc.d/rc.local /etc/resolv.conf`;
		}
	else
		{
		### BACKUP OTHER CONF FILES ON THE SERVER ###
		`$tarbin cf $ARCHIVEpath/temp/$VARserver_ip$linux$wday$tar /etc/hosts /etc/rc.d/rc.local /etc/resolv.conf`;
		}
	}

if ( ($conf_only < 1) && ($db_only < 1) && ($without_web < 1) )
	{
	### BACKUP THE WEB FILES ON THE SERVER ###
	`$tarbin cf $ARCHIVEpath/temp/$VARserver_ip$web$wday$tar $PATHweb`;
	}

if ( ($conf_only < 1) && ($db_only < 1) )
	{
	### BACKUP THE ASTGUICLIENT AND AGI FILES ON THE SERVER ###
	`$tarbin cf $ARCHIVEpath/temp/$VARserver_ip$bin$wday$tar $PATHagi $PATHhome`;
	}

if ( ($conf_only < 1) && ($db_only < 1) && ($without_sounds < 1) )
	{
	### BACKUP THE ASTERISK SOUNDS ON THE SERVER ###
	`$tarbin cf $ARCHIVEpath/temp/$VARserver_ip$sounds$wday$tar $PATHsounds`;
	}

### PUT EVERYTHING TOGETHER TO BE COMPRESSED ###
`$tarbin cf $ARCHIVEpath/$VARserver_ip$all$wday$tar $ARCHIVEpath/temp`;

### REMOVE OLD GZ FILE
`rm -f $ARCHIVEpath/$VARserver_ip$all$wday$tar$gz`;

### COMPRESS THE ALL FILE ###
`$gzipbin -9 $ARCHIVEpath/$VARserver_ip$all$wday$tar`;

### REMOVE TEMP FILES ###
`rm -fR $ARCHIVEpath/temp`;


#### FTP to the Backup server and upload the final file
if ($ftp_transfer > 0)
	{
	use Net::FTP;
	$ftp = Net::FTP->new("$VARREPORT_host", Port => "$VARREPORT_port", Debug => "$FTPdebug");
	$ftp->login("$VARREPORT_user","$VARREPORT_pass");
	$ftp->cwd("$VARREPORT_dir");
	$ftp->binary();
	$ftp->put("$ARCHIVEpath/$VARserver_ip$all$wday$tar$gz", "$VARserver_ip$all$wday$tar$gz");
	$ftp->quit;
	}


exit;
