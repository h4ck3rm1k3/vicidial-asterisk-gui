#!/usr/bin/perl
#
# Vtiger_OUT_sync2VICIDIAL_file.pl version 2.0.5   *DBI-version*
#
# DESCRIPTION:
# script exports all accounts from the vtiger system table from a PIPE-formatted
# file that is in the proper format for VICIDIAL. (for format see --help)
#
# Copyright (C) 2009  Matt Florell <vicidial@gmail.com>    LICENSE: AGPLv2
#
#
# CHANGES
# 90128-0319 - First build
#

$secX = time();
$MT[0]='';
$Ealert='';

($sec,$min,$hour,$mday,$mon,$year,$wday,$yday,$isdst) = localtime(time);
$year = ($year + 1900);
$mon++;
if ($hour < 10) {$hour = "0$hour";}
if ($min < 10) {$min = "0$min";}
if ($sec < 10) {$sec = "0$sec";}
if ($mon < 10) {$mon = "0$mon";}
if ($mday < 10) {$mday = "0$mday";}
$pulldate0 = "$year-$mon-$mday $hour:$min:$sec";
$NOW_TIME = "$year-$mon-$mday $hour:$min:$sec";
$VDLfile = "Vtiger_account_sync_file_$year$mon$mday$hour$min$sec";
$inSD = $pulldate0;
$dsec = ( ( ($hour * 3600) + ($min * 60) ) + $sec );
$MT[0]='';


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
	if ( ($line =~ /^VARREPORT_host/) && ($CLIREPORT_host < 1) )
		{$VARREPORT_host = $line;   $VARREPORT_host =~ s/.*=//gi;}
	if ( ($line =~ /^VARREPORT_user/) && ($CLIREPORT_user < 1) )
		{$VARREPORT_user = $line;   $VARREPORT_user =~ s/.*=//gi;}
	if ( ($line =~ /^VARREPORT_pass/) && ($CLIREPORT_pass < 1) )
		{$VARREPORT_pass = $line;   $VARREPORT_pass =~ s/.*=//gi;}
	if ( ($line =~ /^VARREPORT_port/) && ($CLIREPORT_port < 1) )
		{$VARREPORT_port = $line;   $VARREPORT_port =~ s/.*=//gi;}
	$i++;
	}

# Customized Variables
$server_ip = $VARserver_ip;		# Asterisk server IP


if (!$VDHLOGfile) {$VDHLOGfile = "$PATHlogs/newleads.$year-$mon-$mday";}

### begin parsing run-time options ###
if (length($ARGV[0])>1)
	{
	$i=0;
	while ($#ARGV >= $i)
		{
		$args = "$args $ARGV[$i]";
		$i++;
		}

	if ($args =~ /--help|-h/i)
		{
		print "allowed run time options:\n";
		print "  [-q] = quiet\n";
		print "  [-t] = test\n";
		print "  [--debug] = debug output\n";
		print "  [--format=standard] = ability to define a format, standard is default, formats allowed shown in examples\n";
		print "  [--forcelistid=1234] = overrides the listID given in the file with the 1234\n";
		print "  [--duplicate-system-check] = checks for the same phone number in the entire system before inserting lead\n";
		print "  [--duplicate-system-vendor] = checks for the same website in the entire system before inserting lead\n";
		print "  [--ftp-pull] = grabs lead files from a remote FTP server, uses REPORTS FTP login information\n";
		print "  [--ftp-dir=leads_in] = remote FTP server directory to grab files from, should have a DONE sub-directory\n";
		print "  [--email-list=test@test.com:test2@test.com] = send email results for each file to these addresses\n";
		print "  [--email-sender=vicidial@localhost] = sender for the email results\n";
		print "  [-h] = this help screen\n\n";
		print "\n";
		print "This script takes in account CSV files in the following order when they are placed in the $PATHhome/VTIGER_IN directory to be imported into the vtiger system (examples):\n\n";
		print "standard:\n";
		print "vendor_lead_code|source_code|list_id|phone_code|phone_number|title|first_name|middle|last_name|address1|address2|address3|city|state|province|postal_code|country|gender|date_of_birth|alt_phone|email|security_phrase|COMMENTS|called_count|status|entry_date\n";
		print "3857822|31022|99|01144|1625551212|MRS|B||BURTON|249 MUNDON ROAD|MALDON|ESSEX||||CM9 6PW|UK||||||COMMENTS|2|B|2007-08-09 00:00:00|7275551212_1_work!7275551213_61_sister house!7275551214_44_neighbor\n\n";

		exit;
		}
	else
		{
		if ($args =~ /-debug/i)
			{
			$DB=1;
			print "\n----- DEBUGGING -----\n\n";
			}
		if ($args =~ /-debugX/i)
			{
			$DBX=1;
			print "\n----- SUPER-DUPER DEBUGGING -----\n\n";
			}
		else {$DBX=0;}

		if ($args =~ /-q/i)
			{
			$q=1;
			}
		if ($args =~ /-t/i)
			{
			$T=1;
			$TEST=1;
			print "\n----- TESTING -----\n\n";
			}

		if ($args =~ /-format=/i)
			{
			@data_in = split(/-format=/,$args);
				$format = $data_in[1];
				$format =~ s/ .*//gi;
			print "\n----- FORMAT OVERRIDE: $format -----\n\n";
			}
		else
			{$format = 'standard';}

		if ($args =~ /-forcelistid=/i)
			{
			@data_in = split(/-forcelistid=/,$args);
				$forcelistid = $data_in[1];
				$forcelistid =~ s/ .*//gi;
			print "\n----- FORCE LISTID OVERRIDE: $forcelistid -----\n\n";
			}
		else
			{$forcelistid = '';}

		if ($args =~ /-duplicate-system-check/i)
			{
			$dupchecksys=1;
			print "\n----- DUPLICATE SYSTEM CHECK PHONE -----\n\n";
			}
		if ($args =~ /-duplicate-system-vendor/i)
			{
			$dupcheckvend=1;
			print "\n----- DUPLICATE SYSTEM CHECK VENDOR -----\n\n";
			}
		if ($args =~ /-ftp-pull/i)
			{
			$ftp_pull=1;
			print "\n----- FTP LEAD FILE PULL -----\n\n";
			}
		if ($args =~ /--ftp-dir=/i)
			{
			@data_in = split(/--ftp-dir=/,$args);
				$ftp_dir = $data_in[1];
				$ftp_dir =~ s/ .*//gi;
			print "\n----- REMOTE FTP DIRECTORY: $ftp_dir -----\n\n";
			}
		else
			{$ftp_dir = '';}

		if ($args =~ /--email-list=/i)
			{
			@data_in = split(/--email-list=/,$args);
				$email_list = $data_in[1];
				$email_list =~ s/ .*//gi;
				$email_list =~ s/:/,/gi;
			print "\n----- EMAIL NOTIFICATION: $email_list -----\n\n";
			}
		else
			{$email_list = '';}

		if ($args =~ /--email-sender=/i)
			{
			@data_in = split(/--email-sender=/,$args);
				$email_sender = $data_in[1];
				$email_sender =~ s/ .*//gi;
				$email_sender =~ s/:/,/gi;
			print "\n----- EMAIL NOTIFICATION SENDER: $email_sender -----\n\n";
			}
		else
			{$email_sender = 'vicidial@localhost';}

		}
	}
else
	{
	print "no command line options set\n";
	$args = "";
	$i=0;
	$forcelistid = '';
	$format='standard';
	}
### end parsing run-time options ###

if ($q < 1)
	{
	print "\n\n\n\n\n\n\n\n\n\n\n\n-- Vtiger_OUT_sync2VICIDIAL_file.pl --\n\n";
	print "This program is designed to export a PIPE delimited file of the Accounts from Vtiger and format it for import into the VICIDIAL system. \n\n";
	}

$i=0;
$US = '_';
$phone_list = '|';

if (!$VARDB_port) {$VARDB_port='3306';}

use DBI;	  

$dbhA = DBI->connect("DBI:mysql:$VARDB_database:$VARDB_server:$VARDB_port", "$VARDB_user", "$VARDB_pass")
 or die "Couldn't connect to database: " . DBI->errstr;

#############################################
##### START SYSTEM_SETTINGS LOOKUP #####
$stmtA = "SELECT use_non_latin,vtiger_server_ip,vtiger_dbname,vtiger_login,vtiger_pass FROM system_settings;";
$sthA = $dbhA->prepare($stmtA) or die "preparing: ",$dbhA->errstr;
$sthA->execute or die "executing: $stmtA ", $dbhA->errstr;
$sthArows=$sthA->rows;
if ($sthArows > 0)
	{
	@aryA = $sthA->fetchrow_array;
	$non_latin = 		"$aryA[0]";
	$vtiger_server_ip =	"$aryA[1]";
	$vtiger_dbname = 	"$aryA[2]";
	$vtiger_login = 	"$aryA[3]";
	$vtiger_pass = 		"$aryA[4]";
	}
$sthA->finish();
##### END SETTINGS LOOKUP #####
###########################################

$dbhB = DBI->connect("DBI:mysql:$vtiger_dbname:$vtiger_server_ip:$VARDB_port", "$vtiger_login", "$vtiger_pass")
 or die "Couldn't connect to database: " . DBI->errstr;

if ($non_latin > 0) {$affected_rows = $dbhA->do("SET NAMES 'UTF8'");}

$list_id = '999';
$phone_code = '1';
$suf = '.txt';
$people_packages_id_update='';
$dir1 = "$PATHhome/LEADS_IN";
$dir2 = "$PATHhome";

if($DBX){print STDERR "\nLEADS_IN directory: |$dir1|\n";}


$i=0;	### each Account counter ###
$b=0;	### status of 'APPROVED' counter ###
$c=0;	### status of 'DECLINED' counter ###
$d=0;	### status of 'REFERRED' counter ###
$e=0;	### status of 'DUPLICATE' vendor counter ###
$f=0;	### number of 'DUPLICATE' phone counter ###
$g=0;	### number of leads with multi-alt-entries


### open the output file for writing ###
open(out, ">$dir2/$VDLfile")
		|| die "Can't open $VDLfile: $!\n";





### Gather all non-deleted Accounts in Vtiger
$stmtB="SELECT crmid from vtiger_crmentity where setype='Accounts' and deleted='0' order by crmid limit 3000000;";
$sthB = $dbhB->prepare($stmtB) or die "preparing: ",$dbhB->errstr;
$sthB->execute or die "executing: $stmtB ", $dbhB->errstr;
$sthBrowsC=$sthB->rows;
$i=0;
while ($sthBrowsC > $i)
	{
	@aryB = $sthB->fetchrow_array;
	$crmid[$i] = $aryB[0];
	$i++;
	}
$sthB->finish();

### Gather all account info and address info on those accounts, also checking for duplicates in vicidial_list if selected
$i=0;
while ($sthBrowsC > $i)
	{
	$VL_dup=0;
	$VL_phone_dup=0;

	$stmtB="SELECT accountname,ownership,siccode,annualrevenue,tickersymbol,phone,otherphone,fax,email1,website from vtiger_account where accountid='$crmid[$i]';";
		if($DBX){print STDERR "\n|$stmtB|\n";}
	$sthB = $dbhB->prepare($stmtB) or die "preparing: ",$dbhB->errstr;
	$sthB->execute or die "executing: $stmtB ", $dbhB->errstr;
	$sthBrows=$sthB->rows;
	if ($sthBrows > 0)
		{
		@aryB = $sthB->fetchrow_array;
		$accountname =		$aryB[0];
		$ownership =		$aryB[1];
		$siccode =			$aryB[2];
		$annualrevenue =	$aryB[3];
		$tickersymbol =		$aryB[4];
		$phone =			$aryB[5];
		$otherphone =		$aryB[6];
		$fax =				$aryB[7];
		$email1 =			$aryB[8];
		$website =			$aryB[9];
		}
	$sthB->finish();

	$stmtB="SELECT bill_city,bill_code,bill_country,bill_state,bill_street,bill_pobox from vtiger_accountbillads where accountaddressid='$crmid[$i]';";
		if($DBX){print STDERR "\n|$stmtB|\n";}
	$sthB = $dbhB->prepare($stmtB) or die "preparing: ",$dbhB->errstr;
	$sthB->execute or die "executing: $stmtB ", $dbhB->errstr;
	$sthBrows=$sthB->rows;
	if ($sthBrows > 0)
		{
		@aryB = $sthB->fetchrow_array;
		$bill_city =		$aryB[0];
		$bill_code =		$aryB[1];
		$bill_country =		$aryB[2];
		$bill_state =		$aryB[3];
		$bill_street =		$aryB[4];
		$bill_pobox =		$aryB[5];
		}
	$sthB->finish();

	if ($dupchecksys > 0)
		{
		$stmtA = "SELECT count(*) FROM vicidial_list where phone_number='$phone';";
		$sthA = $dbhA->prepare($stmtA) or die "preparing: ",$dbhA->errstr;
		$sthA->execute or die "executing: $stmtA ", $dbhA->errstr;
		$sthArows=$sthA->rows;
		if ($sthArows > 0)
			{
			@aryA = $sthA->fetchrow_array;
			$VL_phone_dup = 		"$aryA[0]";
			}
		$sthA->finish();
		}
	if ($dupcheckvend > 0)
		{
		$stmtA = "SELECT count(*) FROM vicidial_list where vendor_lead_code='$crmid[$i]';";
		$sthA = $dbhA->prepare($stmtA) or die "preparing: ",$dbhA->errstr;
		$sthA->execute or die "executing: $stmtA ", $dbhA->errstr;
		$sthArows=$sthA->rows;
		if ($sthArows > 0)
			{
			@aryA = $sthA->fetchrow_array;
			$VL_dup = 		"$aryA[0]";
			}
		$sthA->finish();
		}

	if ($VL_phone_dup > 0)
		{
		if($DB){print "DUPLICATE PHONE: $phone|$crmid[$i]\n";}
		$f++;
		$affected_rowsA=0;
		### update the existing vicidial_list entry ###
		$stmtA = "UPDATE vicidial_list SET first_name='$accountname',last_name='$ownership',address1='$bill_street',address2='$bill_pobox',city='$bill_city',state='$bill_state',postal_code='$bill_code',country='$bill_country',vendor_lead_code='$crmid[$i]',address3='$fax',alt_phone='$otherphone',email='$email1',province='$website',security_phrase='$tickersymbol',comments='$siccode|$annualrevenue' where phone_number='$phone' limit 1;";
			if (!$T) {$affected_rowsA = $dbhA->do($stmtA); } #  or die  "Couldn't execute query: |$stmtB|\n";
			if($DB){print STDERR "\n|$affected_rowsA|$stmtA|\n";}
		$c = ($affected_rowsA + $c);
		}
	else
		{
		if ($VL_dup > 0)
			{
			if($DB){print "DUPLICATE VENDOR_ID: $crmid[$i]\n";}
			$e++;
			$affected_rowsA=0;
			### update the existing vicidial_list entry ###
			$stmtA = "UPDATE vicidial_list SET first_name='$accountname',last_name='$ownership',address1='$bill_street',address2='$bill_pobox',city='$bill_city',state='$bill_state',postal_code='$bill_code',country_code='$bill_country',phone_number='$phone',address3='$fax',alt_phone='$otherphone',email='$email1',province='$website',security_phrase='$tickersymbol',comments='$siccode $annualrevenue' where vendor_lead_code='$crmid[$i]' limit 1;";
				if (!$T) {$affected_rowsA = $dbhA->do($stmtA); } #  or die  "Couldn't execute query: |$stmtB|\n";
				if($DB){print STDERR "\n|$affected_rowsA|$stmtA|\n";}
			$c = ($affected_rowsA + $c);
			}
		else
			{
			### print the output file in proper format
			print out "$crmid[$i]||$list_id|$phone_code|$phone||$accountname||$ownership|$bill_street|$bill_pobox|$fax|$bill_city|$bill_state|$website|$bill_code|$bill_country|||$otherphone|$email1|$ticketsymbol|$siccode $annualrevenue\n";
			$b++;
			}
		}

	$i++;

	if ($i =~ /10$/i) {print STDERR "0     $i\r";}
	if ($i =~ /20$/i) {print STDERR "+     $i\r";}
	if ($i =~ /30$/i) {print STDERR "|     $i\r";}
	if ($i =~ /40$/i) {print STDERR "\\     $i\r";}
	if ($i =~ /50$/i) {print STDERR "-     $i\r";}
	if ($i =~ /60$/i) {print STDERR "/     $i\r";}
	if ($i =~ /70$/i) {print STDERR "|     $i\r";}
	if ($i =~ /80$/i) {print STDERR "+     $i\r";}
	if ($i =~ /90$/i) {print STDERR "0     $i\r";}
	if ($i =~ /00$/i) {print "$i|$b|$c|$d|$e|$f|$g|$crmid[$i]|$phone_number|\n";}
	}



	### open the stats out file for writing ###
	open(Sout, ">>$VDHLOGfile")
			|| die "Can't open $VDHLOGfile: $!\n";


	### close file handler and DB connections ###
	$Falert  = "\n\nTOTALS FOR $FILEname:\n";
	$Falert .= "Records in System:  $i\n";
	$Falert .= "LINES OUTPUTED:     $b\n";
	$Falert .= "LIVE VL UPDATE:     $c\n";
	$Falert .= "ERROR:              $e\n";
#	$Falert .= "MULTI-ALT-PHONE:    $g\n";
	if ($e > 0)
		{$Falert .= "VENDOR DUPLICATES:  $e\n";}
	if ($f > 0)
		{$Falert .= "PHONE DUPLICATES:   $f\n";}

	print "$Falert";
	print Sout "$Falert";
	$Ealert .= "$Falert";

	close(out);
	close(Sout);
	chmod 0777, "$VDHLOGfile";

	### Move file to the LEADS_IN directory locally
	if (!$T) {`mv -f $dir2/$VDLfile $dir1/$VDLfile`;}


$dbhA->disconnect();
$dbhB->disconnect();

### calculate time to run script ###
$secY = time();
$secZ = ($secY - $secX);
$secZm = ($secZ /60);

if ($q < 1)
	{
	print "script execution time in seconds: $secZ     minutes: $secZm\n";
	}

###### EMAIL SECTION

if ( (length($Ealert)>5) && (length($email_list) > 3) )
	{
	print "Sending email: $email_list\n";

	use MIME::QuotedPrint;
	use MIME::Base64;
	use Mail::Sendmail;

	$mailsubject = "VTIGER ACCOUNT FILE LOAD $pulldate0";

	  %mail = ( To      => "$email_list",
							From    => "$email_sender",
							Subject => "$mailsubject",
							Message => "VTIGER ACCOUNT FILE LOAD $pulldate0\n\n$Ealert\n"
					   );
			sendmail(%mail) or die $mail::Sendmail::error;
		   print "ok. log says:\n", $mail::sendmail::log;  ### print mail log for status
	}

exit;

