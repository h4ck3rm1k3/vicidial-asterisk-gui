#!/usr/bin/perl
#
# AST_send_action_child.pl version 0.3   *DBI-version
# 
# Part of the Asterisk Central Queue System (ACQS)
#
# DESCRIPTION:
# This script is spawned every time an action is to be executed by the main
# AST_manager_send.pl script and sends actions blindly to the Asterisk manager
# 
# SUMMARY:
# This program was designed as the blind-send part of the ACQS. It's job is to
# be spawned by the AST_manager_send.pl script lookup the record in the MySQL DB
# to be executed. connect to the manager interface, send the action and logoff
# then exit.
# 
# Win32 - ActiveState Perl 5.8.0
# UNIX - Gnome or KDE with Tk/Tcl and perl Tk/Tcl modules loaded
# Both - Net::MySQL, Net::Telnet and Time::HiRes perl modules loaded
#
# For the client program to work in ACQS mode, this program must be running
# 
# For this program to work you need to have the "asterisk" MySQL database 
# created and create the tables listed in the CONF_MySQL.txt file, also make sure
# that the machine running this program has read/write/update/delete access 
# to that database
# 
# In your Asterisk server setup you also need to have several things activated
# and defined. See the CONF_Asterisk.txt file for details
#
# Copyright (C) 2006  Matt Florell <vicidial@gmail.com>    LICENSE: GPLv2
#
# CHANGES
# 50810-1547 - Added database server variable definitions lookup
# 50823-1527 - Altered commandline debug options with debug printouts
# 50902-1032 - Changed default logging to fulllog
# 60718-0909 - changed to DBI by Marin Blu
# 60718-1024 - changed to use /etc/astguiclient.conf for configs
# 60814-1720 - added option for no logging to file
#

$FULL_LOG = 1; # set to 1 for a full response log to be created in $PATHlogs/action_full.date

$secX = time();

($sec,$min,$hour,$mday,$mon,$year,$wday,$yday,$isdst) = localtime(time);
$year = ($year + 1900);
$mon++;
if ($mon < 10) {$mon = "0$mon";}
if ($mday < 10) {$mday = "0$mday";}
if ($hour < 10) {$Fhour = "0$hour";}
if ($min < 10) {$min = "0$min";}
if ($sec < 10) {$sec = "0$sec";}

$now_date_epoch = time();
$now_date = "$year-$mon-$mday $hour:$min:$sec";
$action_log_date = "$year-$mon-$mday";

### begin parsing run-time options ###
if (length($ARGV[0])>1)
{
	$i=0;
	while ($#ARGV >= $i)
	{
	$ARGS = "$ARGS $ARGV[$i]\n";
	$i++;
	}

#			print "DB0: |$ARGS|$#ARGV|$i|\n";

	if ($ARGS =~ /--help/i)
	{
	print "allowed run time options:\n  [-debug] = debug output\n  [-debugX] = Extra-debug output\n  [-fulllog] = full response logging\n  [--data1=XXXXXXX] = vicidial_manager record\n\n\n";
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
		if ($args =~ /-fulllog/i)
		{
		$FULL_LOG=1; # Full response logging enabled
		}
		if ($ARGS =~ /--data1=/i)
		{
		$data1 = $ARGS;
#			print "DB1: |$ARGS|\n";
		$data1 =~ s/^.*--data1=//gi;
#			print "DB2: |$data1|\n";
		$data1 =~ s/ .*$//gi;
#			print "DB3: |$data1|\n";
		}

	}
}
else
{
#print "no command line options set\n\n";
}

if (length($data1)>1)
	{
#	print "Data1 value = |$data1|\n";

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
	$i++;
	}

# Customized Variables
$server_ip = $VARserver_ip;		# Asterisk server IP

if (!$VARDB_port) {$VARDB_port='3306';}

use DBI;
use Net::Telnet ();
	  
	$dbhA = DBI->connect("DBI:mysql:$VARDB_database:$VARDB_server:$VARDB_port", "$VARDB_user", "$VARDB_pass")
    or die "Couldn't connect to database: " . DBI->errstr;
    
	### Grab Server values from the database
	$stmtA = "SELECT telnet_host,telnet_port,ASTmgrUSERNAME,ASTmgrSECRET,ASTmgrUSERNAMEsend,vd_server_logs FROM servers where server_ip = '$server_ip';";
	    $sthA = $dbhA->prepare($stmtA) or die "preparing: ",$dbhA->errstr;
		$sthA->execute or die "executing: $stmtA ", $dbhA->errstr;
		$sthArows=$sthA->rows;
		$rec_count=0;
		 while ($sthArows > $rec_count)
		 {
     	 	@aryA = $sthA->fetchrow_array;
			$DBtelnet_host	=			"$aryA[0]";
			$DBtelnet_port	=			"$aryA[1]";
			$DBASTmgrUSERNAME	=		"$aryA[2]";
			$DBASTmgrSECRET	=			"$aryA[3]";
			$DBASTmgrUSERNAMEsend	=	"$aryA[4]";
			$DBvd_server_logs =			"$aryA[5]";
			if ($DBtelnet_host)				{$telnet_host = $DBtelnet_host;}
			if ($DBtelnet_port)				{$telnet_port = $DBtelnet_port;}
			if ($DBASTmgrUSERNAME)			{$ASTmgrUSERNAME = $DBASTmgrUSERNAME;}
			if ($DBASTmgrSECRET)			{$ASTmgrSECRET = $DBASTmgrSECRET;}
			if ($DBASTmgrUSERNAMEsend)		{$ASTmgrUSERNAMEsend = $DBASTmgrUSERNAMEsend;}
			if ($DBvd_server_logs =~ /Y/)	{$SYSLOG = '1';}
				else {$SYSLOG = '0';}
	      $rec_count++;
		 } 
         $sthA->finish();

	$stmtA = "SELECT * FROM vicidial_manager where man_id = '$data1'";
	    $sthA = $dbhA->prepare($stmtA) or die "preparing: ",$dbhA->errstr;
		$sthA->execute or die "executing: $stmtA ", $dbhA->errstr;
		$sthArows=$sthA->rows;
		$rec_count=0;
		 while ($sthArows > $rec_count)
		 {
     	 	@aryA = $sthA->fetchrow_array;
		
			$man_id		 = "$aryA[0]";
			$uniqueid	 = "$aryA[1]";
			$channel	 = "$aryA[6]";
			$action		 = "$aryA[7]";
			$callid		 = "$aryA[8]";
			$cmd_line_b	 = "$aryA[9]";
			$cmd_line_c	 = "$aryA[10]";
			$cmd_line_d	 = "$aryA[11]";
			$cmd_line_e	 = "$aryA[12]";
			$cmd_line_f	 = "$aryA[13]";
			$cmd_line_g	 = "$aryA[14]";
			$cmd_line_h	 = "$aryA[15]";
			$cmd_line_i	 = "$aryA[16]";
			$cmd_line_j	 = "$aryA[17]";
			$cmd_line_k	 = "$aryA[18]";

			$originate_command  = '';
			$originate_command .= "Action: $action\n";
			if (length($cmd_line_b)>3) {$originate_command .= "$cmd_line_b\n";}
			if (length($cmd_line_c)>3) {$originate_command .= "$cmd_line_c\n";}
			if (length($cmd_line_d)>3) {$originate_command .= "$cmd_line_d\n";}
			if (length($cmd_line_e)>3) {$originate_command .= "$cmd_line_e\n";}
			if (length($cmd_line_f)>3) {$originate_command .= "$cmd_line_f\n";}
			if (length($cmd_line_g)>3) {$originate_command .= "$cmd_line_g\n";}
			if (length($cmd_line_h)>3) {$originate_command .= "$cmd_line_h\n";}
			if (length($cmd_line_i)>3) {$originate_command .= "$cmd_line_i\n";}
			if (length($cmd_line_j)>3) {$originate_command .= "$cmd_line_j\n";}
			if (length($cmd_line_k)>3) {$originate_command .= "$cmd_line_k\n";}
			$originate_command .= "\n";
		$rec_count++;
	   }
       $sthA->finish();
       
		$dbhA->disconnect();


	print "$now_date|$data1|\n$originate_command";
	$event_string = "0|$data1|";
	$event_string .= "\n$originate_command";
		if ($FULL_LOG) {&full_event_logger;}

if (!$telnet_port) {$telnet_port = '5038';}

	### connect to asterisk manager through telnet
	$tn = new Net::Telnet (Port => $telnet_port,
						  Prompt => '/.*[\$%#>] $/',
						  Output_record_separator => '',
						  Errmode    => Return,);
	#$MStelnetlog = "$PATHlogs/SAC_telnet_log.txt";
	#$fh = $tn->dump_log("$MStelnetlog");  # uncomment for telnet log
	if (length($ASTmgrUSERNAMEsend) > 3) {$telnet_login = $ASTmgrUSERNAMEsend;}
	else {$telnet_login = $ASTmgrUSERNAME;}
	$tn->open("$telnet_host"); 
	$tn->waitfor('/0\n$/');			# print login
	$tn->print("Action: Login\nUsername: $telnet_login\nSecret: $ASTmgrSECRET\n\n");
	$tn->waitfor('/Authentication accepted/');		# waitfor auth accepted

	$tn->buffer_empty;

	@list_channels = $tn->cmd(String => "$originate_command", Prompt => '/.*/'); 

sleep(3);
	
	if ($FULL_LOG) 
		{
		$event_string = "1|$data1|";   $k=0;
		foreach(@list_channels) {$event_string .= "$list_channels[$k]";   $k++;}
		$read_input_buf = $tn->get(Errmode    => Return, Timeout    => 1,);
		$event_string .= "$read_input_buf";
			&full_event_logger;
		}

	$tn->buffer_empty;

	@hangup = $tn->cmd(String => "Action: Logoff\n\n", Prompt => "/.*/"); 

sleep(2);

	if ($FULL_LOG) 
		{
		$event_string = "2|$data1|";   $k=0;
		foreach(@list_channels) {$event_string .= "$list_channels[$k]";   $k++;}
		$read_input_buf = $tn->get(Errmode    => Return, Timeout    => 1,);
		$event_string .= "$read_input_buf";
			&full_event_logger;
		}

	$tn->buffer_empty;

	$ok = $tn->close;




	}

$secZ = time();
$script_time = ($secZ - $secX);
print "DONE execute time: $script_time seconds\n";

exit;

sub full_event_logger 
{
if ($SYSLOG)
	{
	### open the log file for writing ###
	open(Lout, ">>$PATHlogs/action_full.$action_log_date")
			|| die "Can't open $PATHlogs/action_full.$action_log_date: $!\n";
	print Lout "$now_date|$event_string|\n";
	close(Lout);
	}
$event_string='';
}
