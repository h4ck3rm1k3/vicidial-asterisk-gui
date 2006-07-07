#!/usr/bin/perl
#
# AST_send_action_child.pl version 0.2
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
# 50810-1547 - Added database server variable definitions lookup
# 50823-1527 - Altered commandline debug options with debug printouts
# 50902-1032 - Changed default logging to fulllog
#

$FULL_LOG = 1; # set to 1 for a full response log to be created in /home/cron/action_full.date

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

### Make sure this file is in a libs path or put the absolute path to it
require("/home/cron/AST_SERVER_conf.pl");	# local configuration file

if (!$DB_port) {$DB_port='3306';}

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

use Net::MySQL;
use Net::Telnet ();
	  
	my $dbhA = Net::MySQL->new(hostname => "$DB_server", database => "$DB_database", user => "$DB_user", password => "$DB_pass", port => "$DB_port") 
	or 	die "Couldn't connect to database: $DB_server - $DB_database\n";

	### Grab Server values from the database
	$stmtA = "SELECT telnet_host,telnet_port,ASTmgrUSERNAME,ASTmgrSECRET,ASTmgrUSERNAMEsend FROM servers where server_ip = '$server_ip';";
	$dbhA->query("$stmtA");
	if ($dbhA->has_selected_record)
		{
		$iter=$dbhA->create_record_iterator;
		   while ( $record = $iter->each)
			{
			$DBtelnet_host	=			"$record->[0]";
			$DBtelnet_port	=			"$record->[1]";
			$DBASTmgrUSERNAME	=		"$record->[2]";
			$DBASTmgrSECRET	=			"$record->[3]";
			$DBASTmgrUSERNAMEsend	=	"$record->[4]";
			if ($DBtelnet_host)				{$telnet_host = $DBtelnet_host;}
			if ($DBtelnet_port)				{$telnet_port = $DBtelnet_port;}
			if ($DBASTmgrUSERNAME)			{$ASTmgrUSERNAME = $DBASTmgrUSERNAME;}
			if ($DBASTmgrSECRET)			{$ASTmgrSECRET = $DBASTmgrSECRET;}
			if ($DBASTmgrUSERNAMEsend)		{$ASTmgrUSERNAMEsend = $DBASTmgrUSERNAMEsend;}
			} 
		}


	$stmtA = "SELECT * FROM vicidial_manager where man_id = '$data1'";
	$dbhA->query("$stmtA");
	if ($dbhA->has_selected_record)
	   {
		$iter=$dbhA->create_record_iterator;
		$rec_count=0;
		while ( $record = $iter->each)
			{
			$man_id		 = "$record->[0]";
			$uniqueid	 = "$record->[1]";
			$channel	 = "$record->[6]";
			$action		 = "$record->[7]";
			$callid		 = "$record->[8]";
			$cmd_line_b	 = "$record->[9]";
			$cmd_line_c	 = "$record->[10]";
			$cmd_line_d	 = "$record->[11]";
			$cmd_line_e	 = "$record->[12]";
			$cmd_line_f	 = "$record->[13]";
			$cmd_line_g	 = "$record->[14]";
			$cmd_line_h	 = "$record->[15]";
			$cmd_line_i	 = "$record->[16]";
			$cmd_line_j	 = "$record->[17]";
			$cmd_line_k	 = "$record->[18]";

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
			}
	   }

	$dbhA->close;


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

sub full_event_logger {
	### open the log file for writing ###
	open(Lout, ">>/home/cron/action_full.$action_log_date")
			|| die "Can't open /home/cron/action_full.$action_log_date: $!\n";

	print Lout "$now_date|$event_string|\n";

	close(Lout);

$event_string='';
}
