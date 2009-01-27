#!/usr/bin/perl
#
# AST_VDsales_export.pl                version: 2.0.5
#
# This script is designed to gather sales for a VICIDIAL Outbound-only campaign and
# post them to a directory
#
# /usr/share/astguiclient/AST_VDsales_export.pl --campaign=GOODB-GROUP1-GROUP3-GROUP4-SPECIALS-DNC_BEDS --output-format=fixed-as400 --sale-statuses=SALE --debug --filename=BEDSsaleMMDD.txt --date=yesterday --email-list=test@gmail.com --email-sender=test@test.com
#
# Copyright (C) 2009  Matt Florell <vicidial@gmail.com>    LICENSE: AGPLv2
#
# CHANGES
# 61219-1118 - First version
# 70503-2137 - Added upsell
# 70611-1154 - Added CLI options
# 70709-1411 - Added FTP transfer option
# 71005-0054 - Altered script to use astguiclient.conf for settings
# 90105-1155 - Added AS400 export formats and changed around date override
# 90106-2309 - Added email sending
#

$txt = '.txt';
$US = '_';
$MT[0] = '';

# Default FTP account variables
$VARREPORT_host = '10.0.0.4';
$VARREPORT_user = 'cron';
$VARREPORT_pass = 'test';
$VARREPORT_port = '21';
$VARREPORT_dir  = 'REPORTS';

# default CLI values
$campaign = 'TESTCAMP';
$sale_statuses = 'SALE-UPSELL';
$output_format = 'pipe-standard';


$secX = time();
$time = $secX;
	($sec,$min,$hour,$mday,$mon,$year,$wday,$yday,$isdst) = localtime(time);
$year = ($year + 1900);
$mon++;
if ($mon < 10) {$mon = "0$mon";}
if ($mday < 10) {$mday = "0$mday";}
if ($hour < 10) {$hour = "0$hour";}
if ($min < 10) {$min = "0$min";}
if ($sec < 10) {$sec = "0$sec";}
$timestamp = "$year-$mon-$mday $hour:$min:$sec";
$filedate = "$year$mon$mday";
$ABIfiledate = "$mon-$mday-$year$us$hour$min$sec";
$shipdate = "$year-$mon-$mday";
$datestamp = "$year/$mon/$mday $hour:$min";


use Time::Local;

### find epoch of 2AM today
$TWOAMsec = ( ($secX - ($sec + ($min * 60) + ($hour * 3600) ) ) + 7200);
### find epoch of 2AM yesterday
$TWOAMsecY = ($TWOAMsec - 86400);

($Tsec,$Tmin,$Thour,$Tmday,$Tmon,$Tyear,$Twday,$Tyday,$Tisdst) = localtime($TWOAMsecY);
$Tyear = ($Tyear + 1900);
$Tmon++;
if ($Tmon < 10) {$Tmon = "0$Tmon";}
if ($Tmday < 10) {$Tmday = "0$Tmday";}
if ($Thour < 10) {$Thour = "0$Thour";}
if ($Tmin < 10) {$Tmin = "0$Tmin";}
if ($Tsec < 10) {$Tsec = "0$Tsec";}


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
		print "  [--date=YYYY-MM-DD] = date override\n";
		print "  [--filename=XXX] = Name to be used for file\n";
		print "  [--campaign=XXX] = Campaign that sales will be pulled from\n";
		print "  [--sale-statuses=XXX-XXY] = Statuses that are deemed to be \"Sales\". Default SALE\n";
		print "    NOTE: To include all statuses in the export, use \"--sale-statuses=---ALL---\"\n";
		print "  [--output-format=XXX] = Format of file. Default \"pipe-standard\"\n";
		print "  [--with-inbound=XXX-XXY] = include the following inbound groups\n";
		print "  [--ftp-transfer] = Send results file by FTP to another server\n";
		print "  [--email-list=test@test.com:test2@test.com] = send email results to these addresses\n";
		print "  [--email-sender=vicidial@localhost] = sender for the email results\n";
		print "  [-q] = quiet\n";
		print "  [-t] = test\n";
		print "  [--debug] = debugging messages\n";
		print "  [--debugX] = Super debugging messages\n";
		print "\n";

		exit;
		}
	else
		{
		if ($args =~ /--debug/i)
			{
			$DB=1;
			print "\n----- DEBUG MODE -----\n\n";
			}
		if ($args =~ /--debugX/i)
			{
			$DBX=1;
			print "\n----- SUPER DEBUG MODE -----\n\n";
			}
		if ($args =~ /-q/i)
			{
			$q=1;   $Q=1;
			}

		if ($args =~ /--date=/i)
			{
			@data_in = split(/--date=/,$args);
			$shipdate = $data_in[1];
			$shipdate =~ s/ .*//gi;
			if ($shipdate =~ /today/)
				{
				$shipdate="$year-$mon-$mday";
				$time = $TWOAMsec;
				}
			else
				{
				if ($shipdate =~ /yesterday/)
					{
					$shipdate="$Tyear-$Tmon-$Tmday";
					$year = $Tyear;
					$mon =	$Tmon;
					$mday = $Tmday;
					$time=$TWOAMsecY;
					}
				else
					{
					@cli_date = split("-",$shipdate);
					$year = $cli_date[0];
					$mon =	$cli_date[1];
					$mday = $cli_date[2];
					$cli_date[1] = ($cli_date[1] - 1);
					$time = timelocal(0,0,2,$cli_date[2],$cli_date[1],$cli_date[0]);
					}
				}
			print "\n----- DATE OVERRIDE: $shipdate -----\n\n";
			}
		else
			{
			$time=$TWOAMsec;
			}


		if ($args =~ /--campaign=/i)
			{
			#	print "\n|$ARGS|\n\n";
			@data_in = split(/--campaign=/,$args);
			$campaign = $data_in[1];
			$campaign =~ s/ .*$//gi;
			$campaignSQL = $campaign;
			if ($campaignSQL =~ /-/) 
				{
				$campaignSQL =~ s/-/','/gi;
				}
			$campaignSQL = "'$campaignSQL'";
			}
		if ($args =~ /--filename=/i)
			{
			#	print "\n|$ARGS|\n\n";
			@data_in = split(/--filename=/,$args);
				$filename = $data_in[1];
				$filename =~ s/ .*$//gi;
				$filename =~ s/YYYY/$year/gi;
				$filename =~ s/MM/$mon/gi;
				$filename =~ s/DD/$mday/gi;
			$filename_override=1;
			}
		if ($args =~ /--sale-statuses=/i)
			{
			@data_in = split(/--sale-statuses=/,$args);
				$sale_statuses = $data_in[1];
				$sale_statuses =~ s/ .*$//gi;
				if ($sale_statuses =~ /---ALL---/)
					{if (!$Q) {print "\n----- EXPORT ALL STATUSES -----\n\n";} }
			}
		if ($args =~ /--output-format=/i)
			{
			@data_in = split(/--output-format=/,$args);
				$output_format = $data_in[1];
				$output_format =~ s/ .*$//gi;
			}
		if ($args =~ /--with-inbound=/i)
			{
			@data_in = split(/--with-inbound=/,$args);
				$with_inbound = $data_in[1];
				$with_inbound =~ s/ .*$//gi;
			}
		if ($args =~ /-ftp-transfer/i)
			{
			if (!$Q)
				{print "\n----- FTP TRANSFER MODE -----\n\n";}
			$ftp_transfer=1;
			}
		if ($args =~ /--test/i)
			{
			$T=1;   $TEST=1;
			print "\n----- TESTING -----\n\n";
			}
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
print "no command line options set, using defaults.\n";
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
	if ( ($line =~ /^VARREPORT_dir/) && ($CLIREPORT_dir < 1) )
		{$VARREPORT_dir = $line;   $VARREPORT_dir =~ s/.*=//gi;}
	$i++;
	}

# Customized Variables
$server_ip = $VARserver_ip;		# Asterisk server IP

if ($output_format =~ /^pipe-standard$/) 
	{$DLT = '|';   $txt='.txt';   print "---- pipe-standard ----\n";}
if ($output_format =~ /^csv-standard$/) 
	{$DLT = "','";   $txt='.csv';   print "---- csv-standard ----\n";}
if ($output_format =~ /^tab-standard$/) 
	{$DLT = "\t";   $txt='.txt';   print "---- tab-standard ----\n";}
if ($output_format =~ /^pipe-triplep$/) 
	{$DLT = '';   $txt='.txt';   print "---- pipe-triplep ----\n";}
if ($output_format =~ /^pipe-vici$/) 
	{$DLT = '|';   $txt='.txt';   print "---- pipe-vici ----\n";}
if ($output_format =~ /^html-rec$/) 
	{$DLT = ' ';   $txt='.html';   print "---- html-rec ----\n";}
if ($output_format =~ /^fixed-as400$/) 
	{$DLT = '';   $txt='.txt';   print "---- fixed-as400 ----\n";}

	if ($sale_statuses =~ /---ALL---/)
		{
		$sale_statusesSQL='';
		$close_statusesSQL='';
		}
	else
		{
		$sale_statusesSQL = $sale_statuses;
		$sale_statusesSQL =~ s/-/','/gi;
		$sale_statusesSQL = "'$sale_statusesSQL'";
		$close_statusesSQL = $sale_statusesSQL;
		$sale_statusesSQL = " and vicidial_log.status IN($sale_statusesSQL)";
		$close_statusesSQL = " and vicidial_closer_log.status IN($close_statusesSQL)";
		}

	$with_inboundSQL = $with_inbound;
	$with_inboundSQL =~ s/-/','/gi;
	$with_inboundSQL = "'$with_inboundSQL'";

if (!$Q)
	{
	print "\n\n\n\n\n\n\n\n\n\n\n\n-- AST_VDsales_export.pl --\n\n";
	print "This program is designed to gather sales from a VICIDIAL outbound-only campaign and post them to a file. \n";
	print "\n";
	print "Campaign:      $campaign    $campaignSQL\n";
	print "Sale Statuses: $sale_statuses     $sale_statusesSQL\n";
	print "Output Format: $output_format\n";
	print "With Inbound:  $with_inbound     $with_inboundSQL\n";
	print "\n";
	}

$outfile = "$campaign$US$filedate$US$sale_statuses$txt";
if ($filename_override > 0) {$outfile = $filename;}

### open the X out file for writing ###
$PATHoutfile = "$PATHweb/vicidial/server_reports/$outfile";
open(out, ">$PATHoutfile")
		|| die "Can't open $PATHoutfile: $!\n";

if (!$VARDB_port) {$VARDB_port='3306';}


use DBI;

$dbhA = DBI->connect("DBI:mysql:$VARDB_database:$VARDB_server:$VARDB_port", "$VARDB_user", "$VARDB_pass")
 or die "Couldn't connect to database: " . DBI->errstr;

$dbhB = DBI->connect("DBI:mysql:$VARDB_database:$VARDB_server:$VARDB_port", "$VARDB_user", "$VARDB_pass")
 or die "Couldn't connect to database: " . DBI->errstr;

$TOTAL_SALES=0;


###########################################################################
########### CURRENT DAY SALES GATHERING outbound-only: vicidial_log  ######
###########################################################################
$stmtA = "select vicidial_log.user,first_name,last_name,address1,address2,city,state,postal_code,vicidial_list.phone_number,email,security_phrase,vicidial_list.comments,call_date,vicidial_list.lead_id,vicidial_users.full_name,vicidial_log.status,vicidial_list.vendor_lead_code,vicidial_list.source_id,vicidial_log.list_id,title,address3,last_local_call_time from vicidial_list,vicidial_log,vicidial_users where campaign_id IN($campaignSQL) $sale_statusesSQL and call_date > '$shipdate 00:00:01' and call_date < '$shipdate 23:59:59' and vicidial_log.lead_id=vicidial_list.lead_id and vicidial_users.user=vicidial_log.user;";
#$stmtA = "select vicidial_users.user,first_name,last_name,address1,address2,city,state,postal_code,phone_number,email,security_phrase,comments,last_local_call_time,lead_id,vicidial_users.full_name,status,vendor_lead_code,source_id,list_id,title,address3,last_local_call_time from vicidial_list,vicidial_users where list_id NOT IN('999','998') $sale_statusesSQL and called_count > 0 and vicidial_users.user=vicidial_list.user;";
if ($DB) {print "|$stmtA|\n";}
$sthA = $dbhA->prepare($stmtA) or die "preparing: ",$dbhA->errstr;
$sthA->execute or die "executing: $stmtA ", $dbhA->errstr;
$sthArows=$sthA->rows;
$rec_count=0;
while ($sthArows > $rec_count)
	{
	@aryA = $sthA->fetchrow_array;
	$user =			$aryA[0];
	$first_name =	$aryA[1];
	$last_name =	$aryA[2];
	$address1 =		$aryA[3];
	$address2 =		$aryA[4];
	$city =			$aryA[5];
	$state =		$aryA[6];
	$postal_code =	$aryA[7];
	$phone_number =	$aryA[8];
	$email =		$aryA[9];
	$security =		$aryA[10];
	$comments =		$aryA[11];
	$call_date =	$aryA[12];
	$lead_id =		$aryA[13];
	$agent_name =	$aryA[14];
	$status =		$aryA[15];
	$vendor_id =	$aryA[16];
	$source_id =	$aryA[17];
	$list_id =		$aryA[18];
	$title =		$aryA[19];
	$address3 =		$aryA[20];
	$last_local_call_time = $aryA[21];

	&select_format_loop;

	$TOTAL_SALES++;
	}
$sthA->finish();

if (length($with_inboundSQL)>3)
	{
	###########################################################################
	########### CURRENT DAY SALES GATHERING inbound-only: vicidial_closer_log  ######
	###########################################################################
	$stmtA = "select vicidial_closer_log.user,first_name,last_name,address1,address2,city,state,postal_code,vicidial_list.phone_number,email,security_phrase,vicidial_list.comments,call_date,vicidial_list.lead_id,vicidial_users.full_name,vicidial_closer_log.status,vicidial_list.vendor_lead_code,vicidial_list.source_id,vicidial_closer_log.list_id,campaign_id,title,address3,last_local_call_time from vicidial_list,vicidial_closer_log,vicidial_users where campaign_id IN($with_inboundSQL) $close_statusesSQL and call_date > '$shipdate 00:00:01' and call_date < '$shipdate 23:59:59' and vicidial_closer_log.lead_id=vicidial_list.lead_id and vicidial_users.user=vicidial_closer_log.user;";
	if ($DB) {print "|$stmtA|\n";}
	$sthA = $dbhA->prepare($stmtA) or die "preparing: ",$dbhA->errstr;
	$sthA->execute or die "executing: $stmtA ", $dbhA->errstr;
	$sthArows=$sthA->rows;
	$rec_count=0;
	while ($sthArows > $rec_count)
		{
		@aryA = $sthA->fetchrow_array;
		$closer =		$aryA[0];
		$first_name =	$aryA[1];
		$last_name =	$aryA[2];
		$address1 =		$aryA[3];
		$address2 =		$aryA[4];
		$city =			$aryA[5];
		$state =		$aryA[6];
		$postal_code =	$aryA[7];
		$phone_number =	$aryA[8];
		$email =		$aryA[9];
		$security =		$aryA[10];
		$comments =		$aryA[11];
		$call_date =	$aryA[12];
		$lead_id =		$aryA[13];
		$closer_name =	$aryA[14];
		$status =		$aryA[15];
		$vendor_id =	$aryA[16];
		$source_id =	$aryA[17];
		$list_id =		$aryA[18];
		$campaign_id =	$aryA[19];
		$title =		$aryA[20];
		$address3 =		$aryA[21];
		$last_local_call_time = $aryA[22];

		$user = '';
		$agent_name='';

		$stmtB = "select vicidial_xfer_log.user,full_name from vicidial_xfer_log,vicidial_users where lead_id='$lead_id' and closer='$closer' and call_date > '$shipdate 00:00:01' and call_date < '$shipdate 23:59:59' and vicidial_users.user=vicidial_xfer_log.user order by call_date desc limit 1;";
		$sthB = $dbhB->prepare($stmtB) or die "preparing: ",$dbhB->errstr;
		$sthB->execute or die "executing: $stmtB ", $dbhB->errstr;
		$sthBrows=$sthB->rows;
		$rec_countB=0;
		while ($sthBrows > $rec_countB)
			{
			@aryB = $sthB->fetchrow_array;
			$user = $aryB[0];
			$agent_name = $aryB[1];
			$rec_countB++;
			}
		$sthB->finish();

		&select_format_loop;

		$TOTAL_SALES++;
		}
	$sthA->finish();
	}


close(out);


###### EMAIL SECTION

if ( (length($Ealert)>5) && (length($email_list) > 3) )
	{
	print "Sending email: $email_list\n";

	use MIME::QuotedPrint;
	use MIME::Base64;
	use Mail::Sendmail;

	$mailsubject = "VICIDIAL Lead Export $outfile";

	  %mail = ( To      => "$email_list",
							From    => "$email_sender",
							Subject => "$mailsubject",
					   );
		$boundary = "====" . time() . "====";
		$mail{'content-type'} = "multipart/mixed; boundary=\"$boundary\"";

		$message = encode_qp( "VICIDIAL Lead Export:\n\n Attachment: $outfile\n Total Records: $TOTAL_SALES\n" );

		$Zfile = "$PATHoutfile";

		open (F, $Zfile) or die "Cannot read $Zfile: $!";
		binmode F; undef $/;
		$attachment = encode_base64(<F>);
		close F;

		$boundary = '--'.$boundary;
		$mail{body} .= "$boundary\n";
		$mail{body} .= "Content-Type: text/plain; charset=\"iso-8859-1\"\n";
		$mail{body} .= "Content-Transfer-Encoding: quoted-printable\n\n";
		$mail{body} .= "$message\n";
		$mail{body} .= "$boundary\n";
		$mail{body} .= "Content-Type: application/octet-stream; name=\"$outfile\"\n";
		$mail{body} .= "Content-Transfer-Encoding: base64\n";
		$mail{body} .= "Content-Disposition: attachment; filename=\"$outfile\"\n\n";
		$mail{body} .= "$attachment\n";
		$mail{body} .= "$boundary";
		$mail{body} .= "--\n";

			sendmail(%mail) or die $mail::Sendmail::error;
		   print "ok. log says:\n", $mail::sendmail::log;  ### print mail log for status

	}


if ($ftp_transfer > 0)
{
	use Net::FTP;

	if (!$Q) {print "Sending File Over FTP: $outfile\n";}
	$ftp = Net::FTP->new("$VARREPORT_host", Port => $VARREPORT_port);
	$ftp->login("$VARREPORT_user","$VARREPORT_pass");
	$ftp->cwd("$VARREPORT_dir");
	$ftp->put("$PATHweb/vicidial/server_reports/$outfile", "$outfile");
	$ftp->quit;
}

### calculate time to run script ###
$secY = time();
$secZ = ($secY - $secX);
$secZm = ($secZ /60);

if (!$Q) {print "SALES EXPORT FOR $shipdate: $outfile\n";}
if (!$Q) {print "TOTAL SALES: $TOTAL_SALES\n";}
if (!$Q) {print "script execution time in seconds: $secZ     minutes: $secZm\n";}

exit;





### Subroutine for formatting of the output ###
sub select_format_loop
{

if ($T)
	{
#	$user =			'1234';
	$agent_name =	'Joe Agent';
#	$closer =		'4321';
	$closer_name =	'Jane Closer';
	$security =		'4111111111111111';
	$comments =		'VISA';
	$phone_number =~ s/^\d\d\d\d\d/23456/gi;
	$address1 =~ s/^..../1234 /gi
	}
$ivr_id = '0';
$ivr_filename = '';


$stmtB = "select recording_id,filename,location from recording_log where lead_id='$lead_id' and start_time > '$shipdate 00:00:01' and start_time < '$shipdate 23:59:59' order by length_in_sec desc limit 1;";
$sthB = $dbhB->prepare($stmtB) or die "preparing: ",$dbhB->errstr;
$sthB->execute or die "executing: $stmtB ", $dbhB->errstr;
$sthBrows=$sthB->rows;
$rec_countB=0;
while ($sthBrows > $rec_countB)
	{
	@aryB = $sthB->fetchrow_array;
	$ivr_id = $aryB[0];
	$ivr_filename = $aryB[1];
	$ivr_location = $aryB[2];
	$rec_countB++;
	}
$sthB->finish();

if (length($ivr_id)<3) 
	{
	$stmtB = "select recording_id,filename from recording_log where lead_id='$lead_id' order by length_in_sec desc limit 1;";
	$sthB = $dbhB->prepare($stmtB) or die "preparing: ",$dbhB->errstr;
	$sthB->execute or die "executing: $stmtB ", $dbhB->errstr;
	$sthBrows=$sthB->rows;
	$rec_countB=0;
	while ($sthBrows > $rec_countB)
		{
		@aryB = $sthB->fetchrow_array;
		$ivr_id = $aryB[0];
		$ivr_filename = $aryB[1];
		$rec_countB++;
		}
	$sthB->finish();

	if (length($ivr_id)<3) 
		{
		$stmtB = "select recording_id,filename from recording_log where filename LIKE \"%$phone_number%\" order by length_in_sec desc limit 1;";
		$sthB = $dbhB->prepare($stmtB) or die "preparing: ",$dbhB->errstr;
		$sthB->execute or die "executing: $stmtB ", $dbhB->errstr;
		$sthBrows=$sthB->rows;
		$rec_countB=0;
		while ($sthBrows > $rec_countB)
			{
			@aryB = $sthB->fetchrow_array;
			$ivr_id = $aryB[0];
			$ivr_filename = $aryB[1];
			$rec_countB++;
			}
		$sthB->finish();
		}
	}
if ($status =~ /UPSELL/) {$UPSELL='L5';}
else {$UPSELL='N';}

if ($output_format =~ /^pipe-standard$/) 
	{
	$str = "$first_name|$last_name|$address1|$address2|$city|$state|$postal_code|$phone_number|$email|$security|$comments|$call_date|$lead_id|$list_id|$user|$agent_name|$status|$vendor_id|$source_id|$campaign|$campaign_id|$ivr_id|$closer|$closer_name|\n";
	}

if ($output_format =~ /^csv-standard$/) 
	{
	$str = "\"$first_name\",\"$last_name\",\"$address1\",\"$address2\",\"$city\",\"$state\",\"$postal_code\",\"$phone_number\",\"$email\",\"$security\",\"$comments\",\"$call_date\",\"$lead_id\",\"$list_id\",\"$user\",\"$agent_name\",\"$status\",\"$vendor_id\",\"$source_id\",\"$campaign\",\"$campaign_id\",\"$ivr_id\",\"$closer\",\"$closer_name\"\r\n";
	}

if ($output_format =~ /^tab-standard$/) 
	{
	$str = "$first_name\t$last_name\t$address1\t$address2\t$city\t$state\t$postal_code\t$phone_number\t$email\t$security\t$comments\t$call_date\t$lead_id\t$list_id\t$user\t$agent_name\t$status\t$vendor_id\t$source_id\t$campaign\t$campaign_id\t$ivr_id\t$closer\t$closer_name\t\n";
	}

if ($output_format =~ /^pipe-triplep$/) 
	{
	$str = "$user|$agent_name|$closer|$closer_name|$call_date|$status|$first_name|$last_name|$phone_number|$address1|$address2|$city|$state|$postal_code|$comments|$security|$email|$vendor_id|$source_id|$lead_id|$list_id|$campaign|$campaign_id|$ivr_id|\n";
	}

if ($output_format =~ /^pipe-vici$/) 
	{
	$str = "VDAD|$agent_name|$first_name|$last_name|$address1|$address2|$city|$state|$postal_code|$phone_number|$ivr_id|DU|$UPSELL|N|||$security|$comments||||||$call_date|CBDISC|$email\r\n";
	}
if ($output_format =~ /^html-rec$/) 
	{
	$str = "$user|$agent_name|$closer|$closer_name|$call_date|$status|$first_name|$last_name|$phone_number|$address1|$address2|$city|$state|$postal_code|$comments|$security|$email|$vendor_id|$source_id|$lead_id|$list_id|$campaign|$campaign_id|<a href=\"$ivr_location\">$ivr_id</a>|\n";
	}

if ($output_format =~ /^fixed-as400$/) 
	{
	# 16884259  MRS.      JEAN           BROWN               RISALPUR                      BROMSBERROW HEATYH            LEDBURY                       HEREFORDSHIRE                 ENGLAND             HR8 1PQ  01531650052         1209200809:52NI              3205UK
	$vendor_id =	sprintf("%-10s",$vendor_id);	while(length($vendor_id)>10)	{$vendor_id =~ s/.$//gi;}
	$title =		sprintf("%-10s",$title);		while(length($title)>10)		{$title =~ s/.$//gi;}
	$first_name =	sprintf("%-15s",$first_name);	while(length($first_name)>15)	{$first_name =~ s/.$//gi;}
	$last_name =	sprintf("%-20s",$last_name);	while(length($last_name)>20)	{$last_name =~ s/.$//gi;}
	$address1 =		sprintf("%-30s",$address1);		while(length($address1)>30)		{$address1 =~ s/.$//gi;}
	$address2 =		sprintf("%-30s",$address2);		while(length($address2)>30)		{$address2 =~ s/.$//gi;}
	$address3 =		sprintf("%-30s",$address3);		while(length($address3)>30)		{$address3 =~ s/.$//gi;}
	$city =			sprintf("%-50s",$city);			while(length($city)>50)			{$city =~ s/.$//gi;}
	$postal_code =	sprintf("%-9s",$postal_code);	while(length($postal_code)>9)	{$postal_code =~ s/.$//gi;}
	$phone_number =	sprintf("%-20s",$phone_number);	while(length($phone_number)>20)	{$phone_number =~ s/.$//gi;}
	@dtsplit = split(" ",$last_local_call_time); 
	@datesplit = split("-",$dtsplit[0]);
	$timesplit = substr($dtsplit[1], 0, 5);
	$formatted_date = "$datesplit[1]$datesplit[2]$datesplit[0]$timesplit";
	$user =			sprintf("%-4s",$user);
	if ($status =~ /^AA$/)		{$status = 'A';}
	if ($status =~ /^A$/)		{$status = 'A';}
	if ($status =~ /^B$/)		{$status = 'B';}
	if ($status =~ /^N$/)		{$status = 'N';}
	if ($status =~ /^NA$/)		{$status = 'N';}
	if ($status =~ /^NP$/)		{$status = 'N';}
	if ($status =~ /^PU$/)		{$status = 'N';}
	if ($status =~ /^DROP$/)	{$status = 'N';}
	if ($status =~ /^SALE$/)	{$status = 'AP';}
	if ($status =~ /^A6$/)		{$status = 'A6';}
	if ($status =~ /^DC$/) 		{$status = 'D';}
	if ($status =~ /^DNC$/) 	{$status = 'DC';}
	if ($status =~ /^DNCL$/) 	{$status = 'DC';}
	if ($status =~ /^DIED$/)	{$status = 'DD';}
	if ($status =~ /^COMP$/)	{$status = 'DD';}
	if ($status =~ /^DEC$/)		{$status = 'DD';}
	if ($status =~ /^ERI$/)		{$status = 'DD';}
	if ($status =~ /^INCALL$/)	{$status = 'DD';}
	if ($status =~ /^SP$/)		{$status = 'DD';}
	if ($status =~ /^WRON$/)	{$status = 'DD';}
	if ($status =~ /^HBED$/)	{$status = 'DD';}
	if ($status =~ /^CALLBK$/)	{$status = 'A6';}
	if ($status =~ /^HAP1$/)	{$status = 'NI';}
	if ($status =~ /^HAP2$/)	{$status = 'NI';}
	if ($status =~ /^NI$/)		{$status = 'NI';}

	$status =	sprintf("%-16s",$status);			while(length($status)>16)		{$status =~ s/.$//gi;}
	$user =~ s/VDAD/    /gi;	
	$UK = 'UK';

	$str = "$vendor_id$title$first_name$last_name$address1$address2$address3$city$postal_code$phone_number$formatted_date$status$user$UK\r\n";
	}


$Ealert .= "$str"; 

print out "$str"; 
if ($DBX) {print "$str\n";}

$rec_count++;

}

