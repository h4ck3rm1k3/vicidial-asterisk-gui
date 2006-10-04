#!/usr/bin/perl
#
# AST_send_action_child.pl version 0.4   *DBI-version
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
# 60817-1244 - removed all DB calls and config file open to reduce footprint
# 61004-1728 - added ability to parse volume control and lookup meetme IDs
#

$FULL_LOG = 1; # set to 1 for a full response log to be created in $PATHlogs/action_full.date
$MT[0]='';

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

	if ($ARGS =~ /--help/i)
	{
		print "allowed run time options:\n";
		print "  [--help] = this help screen\n";
		print "required flags:\n";
		print "  [--SYSLOG] = whether to log actions or not\n";
		print "  [--PATHlogs] = logs directory path\n";
		print "  [--telnet_host] = IP address to connect to Asterisk Manager\n";
		print "  [--telnet_port] = port to connect to Asterisk Manager\n";
		print "  [--ASTmgrUSERNAME] = username for Asterisk Manager login\n";
		print "  [--ASTmgrSECRET] = secret or password for Asterisk Manager login\n";
		print "  [--ASTmgrUSERNAMEsend] = username specific for sending actions for Asterisk Manager login\n";
		print "  [--action] = type of manager action to send\n";
		print "  [--cmd_line_X] = lines to send to Manager after action\n";
		print "                   X replaced with b-k (10 lines)\n";
		print "\n";

		exit;
	}
	else
	{
		if ($ARGS =~ /--SYSLOG=1/) # CLI defined SYSLOG
				{$SYSLOG=1;}
		else
				{$SYSLOG=0;}
		if ($ARGS=~ /--PATHlogs=/) # CLI defined PATHlogs
			{
			@CLIARY = split(/--PATHlogs=/,$ARGS);
			@CLIARX = split(/ /,$CLIARY[1]);
			if (length($CLIARX[0])>2)
				{
				$PATHlogs = $CLIARX[0];
				$PATHlogs =~ s/\/$| |\r|\n|\t//gi;
				if ($DB) {print "  PATHlogs:               $PATHlogs\n";}
				}
			@CLIARY = @MT;   @CLIARX = @MT;
			}
		if ($ARGS=~ /--telnet_host=/) # CLI defined telnet_host
			{
			@CLIARY = split(/--telnet_host=/,$ARGS);
			@CLIARX = split(/ /,$CLIARY[1]);
			if (length($CLIARX[0])>2)
				{
				$telnet_host = $CLIARX[0];
				$telnet_host =~ s/\/$| |\r|\n|\t//gi;
				if ($DB) {print "  telnet_host:            $telnet_host\n";}
				}
			@CLIARY = @MT;   @CLIARX = @MT;
			}
		if ($ARGS=~ /--telnet_port=/) # CLI defined telnet_port
			{
			@CLIARY = split(/--telnet_port=/,$ARGS);
			@CLIARX = split(/ /,$CLIARY[1]);
			if (length($CLIARX[0])>2)
				{
				$telnet_port = $CLIARX[0];
				$telnet_port =~ s/\/$| |\r|\n|\t//gi;
				if ($DB) {print "  telnet_port:            $telnet_port\n";}
				}
			@CLIARY = @MT;   @CLIARX = @MT;
			}
		if ($ARGS=~ /--ASTmgrUSERNAME=/) # CLI defined ASTmgrUSERNAME
			{
			@CLIARY = split(/--ASTmgrUSERNAME=/,$ARGS);
			@CLIARX = split(/ /,$CLIARY[1]);
			if (length($CLIARX[0])>2)
				{
				$ASTmgrUSERNAME = $CLIARX[0];
				$ASTmgrUSERNAME =~ s/\/$| |\r|\n|\t//gi;
				if ($DB) {print "  ASTmgrUSERNAME:         $ASTmgrUSERNAME\n";}
				}
			@CLIARY = @MT;   @CLIARX = @MT;
			}
		if ($ARGS=~ /--ASTmgrSECRET=/) # CLI defined ASTmgrSECRET
			{
			@CLIARY = split(/--ASTmgrSECRET=/,$ARGS);
			@CLIARX = split(/ /,$CLIARY[1]);
			if (length($CLIARX[0])>2)
				{
				$ASTmgrSECRET = $CLIARX[0];
				$ASTmgrSECRET =~ s/\/$| |\r|\n|\t//gi;
				if ($DB) {print "  ASTmgrSECRET:           $ASTmgrSECRET\n";}
				}
			@CLIARY = @MT;   @CLIARX = @MT;
			}
		if ($ARGS=~ /--ASTmgrUSERNAMEsend=/) # CLI defined ASTmgrUSERNAMEsend
			{
			@CLIARY = split(/--ASTmgrUSERNAMEsend=/,$ARGS);
			@CLIARX = split(/ /,$CLIARY[1]);
			if (length($CLIARX[0])>2)
				{
				$ASTmgrUSERNAMEsend = $CLIARX[0];
				$ASTmgrUSERNAMEsend =~ s/\/$| |\r|\n|\t//gi;
				if ($DB) {print "  ASTmgrUSERNAMEsend:     $ASTmgrUSERNAMEsend\n";}
				}
			@CLIARY = @MT;   @CLIARX = @MT;
			}
		if ($ARGS=~ /--action=/) # CLI defined action
			{
			@CLIARY = split(/--action=/,$ARGS);
			@CLIARX = split(/ /,$CLIARY[1]);
			if (length($CLIARX[0])>2)
				{
				$action = $CLIARX[0];
				$action =~ s/\/$| |\r|\n|\t//gi;
				if ($DB) {print "  action:                 $action\n";}
				}
			@CLIARY = @MT;   @CLIARX = @MT;
			}
		if ($ARGS=~ /--cmd_line_b=/) # CLI defined cmd_line_b
			{
			@CLIARY = split(/--cmd_line_b=/,$ARGS);
			@CLIARX = split(/ /,$CLIARY[1]);
			if (length($CLIARX[0])>2)
				{
				$cmd_line_b = $CLIARX[0];
				$cmd_line_b =~ s/\/$| |\r|\n|\t//gi;
				if ($DB) {print "  cmd_line_b:             $cmd_line_b\n";}
				}
			@CLIARY = @MT;   @CLIARX = @MT;
			}
		if ($ARGS=~ /--cmd_line_c=/) # CLI defined cmd_line_c
			{
			@CLIARY = split(/--cmd_line_c=/,$ARGS);
			@CLIARX = split(/ /,$CLIARY[1]);
			if (length($CLIARX[0])>2)
				{
				$cmd_line_c = $CLIARX[0];
				$cmd_line_c =~ s/\/$| |\r|\n|\t//gi;
				if ($DB) {print "  cmd_line_c:             $cmd_line_c\n";}
				}
			@CLIARY = @MT;   @CLIARX = @MT;
			}
		if ($ARGS=~ /--cmd_line_d=/) # CLI defined cmd_line_d
			{
			@CLIARY = split(/--cmd_line_d=/,$ARGS);
			@CLIARX = split(/ /,$CLIARY[1]);
			if (length($CLIARX[0])>2)
				{
				$cmd_line_d = $CLIARX[0];
				$cmd_line_d =~ s/\/$| |\r|\n|\t//gi;
				if ($DB) {print "  cmd_line_d:             $cmd_line_d\n";}
				}
			@CLIARY = @MT;   @CLIARX = @MT;
			}
		if ($ARGS=~ /--cmd_line_e=/) # CLI defined cmd_line_e
			{
			@CLIARY = split(/--cmd_line_e=/,$ARGS);
			@CLIARX = split(/ /,$CLIARY[1]);
			if (length($CLIARX[0])>2)
				{
				$cmd_line_e = $CLIARX[0];
				$cmd_line_e =~ s/\/$| |\r|\n|\t//gi;
				if ($DB) {print "  cmd_line_e:             $cmd_line_e\n";}
				}
			@CLIARY = @MT;   @CLIARX = @MT;
			}
		if ($ARGS=~ /--cmd_line_f=/) # CLI defined cmd_line_f
			{
			@CLIARY = split(/--cmd_line_f=/,$ARGS);
			@CLIARX = split(/ /,$CLIARY[1]);
			if (length($CLIARX[0])>2)
				{
				$cmd_line_f = $CLIARX[0];
				$cmd_line_f =~ s/\/$| |\r|\n|\t//gi;
				if ($DB) {print "  cmd_line_f:             $cmd_line_f\n";}
				}
			@CLIARY = @MT;   @CLIARX = @MT;
			}
		if ($ARGS=~ /--cmd_line_g=/) # CLI defined cmd_line_g
			{
			@CLIARY = split(/--cmd_line_g=/,$ARGS);
			@CLIARX = split(/ /,$CLIARY[1]);
			if (length($CLIARX[0])>2)
				{
				$cmd_line_g = $CLIARX[0];
				$cmd_line_g =~ s/\/$| |\r|\n|\t//gi;
				if ($DB) {print "  cmd_line_g:             $cmd_line_g\n";}
				}
			@CLIARY = @MT;   @CLIARX = @MT;
			}
		if ($ARGS=~ /--cmd_line_h=/) # CLI defined cmd_line_h
			{
			@CLIARY = split(/--cmd_line_h=/,$ARGS);
			@CLIARX = split(/ /,$CLIARY[1]);
			if (length($CLIARX[0])>2)
				{
				$cmd_line_h = $CLIARX[0];
				$cmd_line_h =~ s/\/$| |\r|\n|\t//gi;
				if ($DB) {print "  cmd_line_h:             $cmd_line_h\n";}
				}
			@CLIARY = @MT;   @CLIARX = @MT;
			}
		if ($ARGS=~ /--cmd_line_i=/) # CLI defined cmd_line_i
			{
			@CLIARY = split(/--cmd_line_i=/,$ARGS);
			@CLIARX = split(/ /,$CLIARY[1]);
			if (length($CLIARX[0])>2)
				{
				$cmd_line_i = $CLIARX[0];
				$cmd_line_i =~ s/\/$| |\r|\n|\t//gi;
				if ($DB) {print "  cmd_line_i:             $cmd_line_i\n";}
				}
			@CLIARY = @MT;   @CLIARX = @MT;
			}
		if ($ARGS=~ /--cmd_line_j=/) # CLI defined cmd_line_j
			{
			@CLIARY = split(/--cmd_line_j=/,$ARGS);
			@CLIARX = split(/ /,$CLIARY[1]);
			if (length($CLIARX[0])>2)
				{
				$cmd_line_j = $CLIARX[0];
				$cmd_line_j =~ s/\/$| |\r|\n|\t//gi;
				if ($DB) {print "  cmd_line_j:             $cmd_line_j\n";}
				}
			@CLIARY = @MT;   @CLIARX = @MT;
			}
		if ($ARGS=~ /--cmd_line_k=/) # CLI defined cmd_line_k
			{
			@CLIARY = split(/--cmd_line_k=/,$ARGS);
			@CLIARX = split(/ /,$CLIARY[1]);
			if (length($CLIARX[0])>2)
				{
				$cmd_line_k = $CLIARX[0];
				$cmd_line_k =~ s/\/$| |\r|\n|\t//gi;
				if ($DB) {print "  cmd_line_k:             $cmd_line_k\n";}
				}
			@CLIARY = @MT;   @CLIARX = @MT;
			}
		if ($ARGS=~ /-debug/i)
			{
			$DB=1; # Debug flag
			}
		if ($ARGS=~ /--debugX/i)
			{
			$DBX=1;
			print "\n----- SUPER-DUPER DEBUGGING -----\n\n";
			}
		if ($ARGS=~ /-fulllog/i)
			{
			$FULL_LOG=1; # Full response logging enabled
			}

	}
}
else
{
#print "no command line options set\n\n";
}

if (length($action)>1)
	{
	$PATHlogs =~	s/\%([A-Fa-f0-9]{2})/pack('C', hex($1))/seg;
	$cmd_line_b =~	s/\%([A-Fa-f0-9]{2})/pack('C', hex($1))/seg;
	$cmd_line_c =~	s/\%([A-Fa-f0-9]{2})/pack('C', hex($1))/seg;
	$cmd_line_d =~	s/\%([A-Fa-f0-9]{2})/pack('C', hex($1))/seg;
	$cmd_line_e =~	s/\%([A-Fa-f0-9]{2})/pack('C', hex($1))/seg;
	$cmd_line_f =~	s/\%([A-Fa-f0-9]{2})/pack('C', hex($1))/seg;
	$cmd_line_g =~	s/\%([A-Fa-f0-9]{2})/pack('C', hex($1))/seg;
	$cmd_line_h =~	s/\%([A-Fa-f0-9]{2})/pack('C', hex($1))/seg;
	$cmd_line_i =~	s/\%([A-Fa-f0-9]{2})/pack('C', hex($1))/seg;
	$cmd_line_j =~	s/\%([A-Fa-f0-9]{2})/pack('C', hex($1))/seg;
	$cmd_line_k =~	s/\%([A-Fa-f0-9]{2})/pack('C', hex($1))/seg;

	if ($DB) {print "  SYSLOG:                 $SYSLOG\n";}
	if ($DB) {print "  PATHlogs:               $PATHlogs\n";}
	if ($DB) {print "  telnet_host:            $telnet_host\n";}
	if ($DB) {print "  telnet_port:            $telnet_port\n";}
	if ($DB) {print "  ASTmgrSECRET:           $ASTmgrSECRET\n";}
	if ($DB) {print "  ASTmgrUSERNAME:         $ASTmgrUSERNAME\n";}
	if ($DB) {print "  ASTmgrUSERNAMEsend:     $ASTmgrUSERNAMEsend\n";}
	if ($DB) {print "  action:                 $action\n";}
	if ($DB) {print "  cmd_line_b:             $cmd_line_b\n";}
	if ($DB) {print "  cmd_line_c:             $cmd_line_c\n";}
	if ($DB) {print "  cmd_line_d:             $cmd_line_d\n";}
	if ($DB) {print "  cmd_line_e:             $cmd_line_e\n";}
	if ($DB) {print "  cmd_line_f:             $cmd_line_f\n";}
	if ($DB) {print "  cmd_line_g:             $cmd_line_g\n";}
	if ($DB) {print "  cmd_line_h:             $cmd_line_h\n";}
	if ($DB) {print "  cmd_line_i:             $cmd_line_i\n";}
	if ($DB) {print "  cmd_line_j:             $cmd_line_j\n";}
	if ($DB) {print "  cmd_line_k:             $cmd_line_k\n";}

	use Net::Telnet ();
	  
	if (!$telnet_port) {$telnet_port = '5038';}

	### connect to asterisk manager through telnet
	$tn = new Net::Telnet (Port => $telnet_port,
						  Prompt => '/.*[\$%#>] $/',
						  Output_record_separator => '',
						  Errmode    => Return,);
	#$fh = $tn->dump_log("$PATHlogs/SAC_telnet_log.txt");  # uncomment for telnet log
	if (length($ASTmgrUSERNAMEsend) > 3) {$telnet_login = $ASTmgrUSERNAMEsend;}
	else {$telnet_login = $ASTmgrUSERNAME;}
	$tn->open("$telnet_host"); 
	$tn->waitfor('/0\n$/');			# print login
	$tn->print("Action: Login\nUsername: $telnet_login\nSecret: $ASTmgrSECRET\n\n");
	$tn->waitfor('/Authentication accepted/');		# waitfor auth accepted

	$tn->buffer_empty;

	if ($cmd_line_b =~ /XXYYXXYYXXYYXX/) 
		{
		#	Action: Command
		#	Command: meetme list 8600051
		#
		#	Response: Follows
		#	Privilege: Command
		#	User #: 03          261 261iax               Channel: IAX2/261iax-13    (unmonitored)
		#	1 users in that conference.
		#	--END COMMAND--
		$meetme_command = "Action: Command\nCommand: meetme list $cmd_line_k\n\n";
		print "$now_date|$SYSLOG|\n$meetme_command";

		@list_meetme = $tn->cmd(String => "$meetme_command", Prompt => '/--END COMMAND-.*/');
		foreach(@list_meetme)
			{
			if ($list_meetme[$m] =~ /$cmd_line_j /i)
				{
				$list_meetme[$m] =~ s/User \#: //gi;
				@participants = split(/ /, $list_meetme[$m]);
				$participant = ($participants[0] + 0);
				}
		#	print "$m|$participant|$cmd_line_j|$list_meetme[$m]";
			$m++;
			}
		if ($participant > 0) {$cmd_line_b =~ s/XXYYXXYYXXYYXX/$participant/gi;}
		$cmd_line_j = '';
		$cmd_line_k = '';
		}

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


	print "$now_date|$SYSLOG|\n$originate_command";
	$event_string = "0|$SYSLOG|";
	$event_string .= "\n$originate_command";
	if ( ($FULL_LOG) && ($SYSLOG) )
		 {&full_event_logger;}

	@list_channels = $tn->cmd(String => "$originate_command", Prompt => '/.*/'); 

	sleep(3);
	
	if ( ($FULL_LOG) && ($SYSLOG) )
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

	if ( ($FULL_LOG) && ($SYSLOG) )
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
