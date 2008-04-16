#!/usr/bin/perl
#
# ADMIN_area_code_populate.pl    version 2.0.5
#
# Copyright (C) 2008  Joe Johnson,Matt Florell <vicidial@gmail.com>    LICENSE: AGPLv2
#
# Description:
# server application that allows load areacodes into to asterisk list database
#
# CHANGES
# 60615-1514 - Changed to ignore the header row
# 60807-1003 - Changed to DBI
#            - changed to use /etc/astguiclient.conf for configs
# 61122-1902 - Added GMT_USA_zip.txt data import for USA postal GMT data
# 80416-1017 - 


# default path to astguiclient configuration file:
$PATHconf =		"/etc/astguiclient.conf";
$domain   =		"http://phonecodes.vicidial.com";
$URL1     =		"$domain/phone_codes_GMT-latest.txt";
$URL2     =		"$domain/GMT_USA_zip-latest.txt";

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


use Time::HiRes ('gettimeofday','usleep','sleep');  # needed to have perl sleep in increments of less than one second
use DBI;	  

if (!$VARDB_port) {$VARDB_port='3306';}

$dbhA = DBI->connect("DBI:mysql:$VARDB_database:$VARDB_server:$VARDB_port", "$VARDB_user", "$VARDB_pass")
 or die "Couldn't connect to database: " . DBI->errstr;

$slash_star = '\*';

#### download the latest phone code table ####
chdir("$PATHhome");

print STDERR "Downloading latest phone codes tables\n";

`wget $URL1`;
`wget $URL2`;

#### BEGIN vicidial_phone_codes population from phone_codes_GMT.txt file ####
open(codefile, "$PATHhome/phone_codes_GMT-latest.txt") || die "can't open $PATHhome/phone_codes_GMT-latest.txt: $!\n";
@codefile = <codefile>;
close(codefile);
$pc=0;
$ins_stmt="insert into vicidial_phone_codes VALUES ";
foreach (@codefile) 
{
	@row=split(/\t/, $codefile[$pc]);
	if ($codefile[$pc] !~ /GEOGRAPHIC DESCRIPTION/)
	{
		$pc++;
		$row[7] =~ s/\r|\n|\t| $//gi;
		$row[6] =~ s/\r|\n|\t| $//gi;
		$row[5] =~ s/\r|\n|\t| $//gi;
		$row[4] =~ s/\r|\n|\t| $//gi;
		$row[3] =~ s/\r|\n|\t| $//gi;
		$row[2] =~ s/\r|\n|\t| $//gi;
		$row[1] =~ s/\r|\n|\t| $//gi;
		$row[0] =~ s/\r|\n|\t| $//gi;
		$ins_stmt.="('$row[0]', '$row[1]', '$row[2]', '$row[3]', '$row[4]', '$row[5]', '$row[6]', '$row[7]'), ";
		if ($pc =~ /00$/) 
		{
			chop($ins_stmt);
			chop($ins_stmt);
			$affected_rows = $dbhA->do($ins_stmt) || die "can't execute query: |$ins_stmt| $!\n";
			$ins_stmt="insert into vicidial_phone_codes VALUES ";
			print STDERR "$pc\n";
		}
	}
	else {$pc++;}
}

chop($ins_stmt);
chop($ins_stmt);
$affected_rows = $dbhA->do($ins_stmt);
$ins_stmt="insert into vicidial_phone_codes VALUES ";
print STDERR "$pc\n";
#### END vicidial_phone_codes population from phone_codes_GMT.txt file ####


#### BEGIN vicidial_postal_codes population from GMT_USA_zip.txt file ####
open(zipfile, "$PATHhome/GMT_USA_zip-latest.txt") || die "can't open $PATHhome/GMT_USA_zip-latest.txt: $!\n";
@zipfile = <zipfile>;
close(zipfile);
$pc=0;
$ins_stmt="insert into vicidial_postal_codes VALUES ";
foreach (@zipfile) 
{
	@row=split(/\t/, $zipfile[$pc]);
	$pc++;
	$row[0] =~ s/\r|\n|\t| $//gi;
	$row[1] =~ s/\r|\n|\t| $//gi;
	$row[2] =~ s/\r|\n|\t| $//gi;
	$row[3] =~ s/\r|\n|\t| $//gi;
	if ($row[3] =~ /Y/i) {$DST_range = 'SSM-FSN';}
	else {$DST_range = '';}
	$ins_stmt.="('$row[0]', '$row[1]', '$row[2]', '$row[3]', '$DST_range', 'USA', '1'), ";
	if ($pc =~ /00$/) 
	{
		chop($ins_stmt);
		chop($ins_stmt);
		$affected_rows = $dbhA->do($ins_stmt) || die "can't execute query: |$ins_stmt| $!\n";
		$ins_stmt="insert into vicidial_postal_codes VALUES ";
		print STDERR "$pc\n";
	}
}

chop($ins_stmt);
chop($ins_stmt);
$affected_rows = $dbhA->do($ins_stmt);
$ins_stmt="insert into vicidial_postal_codes VALUES ";
print STDERR "$pc\n";
#### END vicidial_postal_codes population from GMT_USA_zip.txt file ####

$dbhA->disconnect();

exit;
