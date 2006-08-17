#!/usr/bin/perl
#
# AST_manager_send.pl version 0.3   *DBI-version*
#
# Part of the Asterisk Central Queue System (ACQS)
#
# DESCRIPTION:
# spawns child processes (AST_send_action_child.pl) to execute action commands 
# on the Asterisk manager interface from records in the vicidial_manager table
# of the asterisk database in MySQL that are marked as a status of NEW
#
# SUMMARY:
# This program was designed as the send-only part of the ACQS. It's job is to
# pick NEW actions from the vicidial_manager table and send them to be executed
# by separate child process. This allows for a higher degree of flexibility and
# scalability over just using a single process. Also, this means that a single
# action execution lock cannot bring the entire system down.
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
# 50823-1514 - Added commandline debug options with debug printouts
# 50902-1051 - Added extra debug output launch sub(commented out)
# 60718-0909 - changed to DBI by Marin Blu
# 60718-1005 - changed to use /etc/astguiclient.conf for configs
# 60718-1211 - removed need for ADMIN_keepalive_send_listen.at launching
# 60814-1712 - added option for no logging to file
# 60817-1211 - added more ARGS to go to child process to remove DBI from child
#

# constants
$COUNTER_OUTPUT=1;	# set to 1 to display the counter as the script runs
$US='__';
$MT[0]='';

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
		if ($args =~ /-sendonlyone/i)
		{
		$sendonlyone=1;
		print "\n-----SEND ONLY ONE COMMAND -----\n\n";
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

if (!$VARDB_port) {$VARDB_port='3306';}

	&get_time_now;

#use lib './lib', '../lib';
use Time::HiRes ('gettimeofday','usleep','sleep');  # necessary to have perl sleep command of less than one second
use DBI;
	  
	$dbhA = DBI->connect("DBI:mysql:$VARDB_database:$VARDB_server:$VARDB_port", "$VARDB_user", "$VARDB_pass")
    or die "Couldn't connect to database: " . DBI->errstr;

	### Grab Server values from the database
	$stmtA = "SELECT telnet_host,telnet_port,ASTmgrUSERNAME,ASTmgrSECRET,ASTmgrUSERNAMEsend,vd_server_logs FROM servers where server_ip = '$VARserver_ip';";
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


	$event_string='LOGGED INTO MYSQL SERVER ON 1 CONNECTION|';
	&event_logger;

$one_day_interval = 90;		# 1 day loops for 3 months
while($one_day_interval > 0)
{


	$endless_loop=864000;		# 10 days at .20 seconds per loop

	while($endless_loop > 0)
	{

	$affected_rows=0;
	$NEW_actions=0;

	$stmtA = "SELECT count(*) from vicidial_manager where server_ip = '$VARserver_ip' and status = 'NEW'";
	    $sthA = $dbhA->prepare($stmtA) or die "preparing: ",$dbhA->errstr;
		$sthA->execute or die "executing: $stmtA ", $dbhA->errstr;
		$sthArows=$sthA->rows;
		$rec_count=0;
	 	@aryA = $sthA->fetchrow_array;
		if($DB){print STDERR $aryA[0]," NEW Actions to send on server $VARserver_ip      $endless_loop\n";}
		$NEW_actions	 = "$aryA[0]";
		$rec_count++;
	    $sthA->finish();

	if (!$NEW_actions)
		{
		$affected_rows=0;
		}
	else
		{
		$stmtA = "UPDATE vicidial_manager set status='QUEUE' where server_ip = '$VARserver_ip' and status = 'NEW' order by entry_date limit 1";
	    $affected_rows = $dbhA->do($stmtA);
		if ($DB) {print STDERR "rows updated to QUEUE: |$affected_rows|\n";}
		}


	if ($affected_rows)
		{
		$stmtA = "SELECT * FROM vicidial_manager where server_ip = '$VARserver_ip' and status = 'QUEUE' order by entry_date desc limit 1";
					$event_string="SQL_QUERY|$stmtA|";
				&event_logger;

		$sthA = $dbhA->prepare($stmtA) or die "preparing: ",$dbhA->errstr;
		$sthA->execute or die "executing: $stmtA ", $dbhA->errstr;
		$sthArows=$sthA->rows;
		$rec_count=0;
		 while ($sthArows > $rec_count)
		 {
     	 	@aryA = $sthA->fetchrow_array;

				if($DB){print STDERR $aryA[0],"|", $aryA[1],"|", $aryA[6],"|", $aryA[7],"|", $aryA[8],"\n";}
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

				$SENDNOW=1;
				if ($originate_command =~ /Action: Hangup|Action: Redirect/)
					{
					$SENDNOW=0;
					if($DB){print STDERR "\n|checking for dead call before executing|$callid|$uniqueid|\n";}
					   $stmtB = "SELECT count(*) FROM vicidial_manager where server_ip = '$VARserver_ip' and callerid='$callid' and status = 'DEAD'";
					   $sthB = $dbhA->prepare($stmtB) or die "preparing: ",$dbhA->errstr;
					   $sthB->execute or die "executing: $stmtA ", $dbhA->errstr;
					   $sthArows=$sthB->rows;
		               $rec_countH=0;
     	 				 @aryB = $sthB->fetchrow_array;
						$rec_countH = "$aryB[0]";
		   
						  if (!$rec_countH){$SENDNOW=1;}
						  else 
							{
							$launch_string = "|not sending command line is dead|$callid|$uniqueid|";
							if($DB){print STDERR "\n$launch_string\n";}
							}
						 $sthB->finish();
					   

					}

					$event_string="----BEGIN NEW COMMAND----\n$originate_command----END NEW COMMAND----\n";
				&event_logger;

				if ($SENDNOW)
					{
	#				$tn->buffer_empty;

#	encode
#	$str =~ s/([^A-Za-z0-9])/sprintf("%%%02X", ord($1))/seg;
#	decode
#	$str =~ s/\%([A-Fa-f0-9]{2})/pack('C', hex($1))/seg;
#
#	 --SYSLOG=$SYSLOG --PATHlogs=$PATHlogs --telnet_host=$telnet_host --telnet_port=$telnet_port --ASTmgrUSERNAME=$ASTmgrUSERNAME --ASTmgrSECRET=$ASTmgrSECRET --ASTmgrUSERNAMEsend=$ASTmgrUSERNAMEsend --action=$action --cmd_line_b=$cmd_line_b --cmd_line_c=$cmd_line_c --cmd_line_d=$cmd_line_d --cmd_line_e=$cmd_line_e --cmd_line_f=$cmd_line_f --cmd_line_g=$cmd_line_g --cmd_line_h=$cmd_line_h --cmd_line_i=$cmd_line_i --cmd_line_j=$cmd_line_j --cmd_line_k=$cmd_line_k

					$cPATHlogs =	$PATHlogs;
					$cPATHlogs =~	s/([^A-Za-z0-9])/sprintf("%%%02X", ord($1))/seg;
					$cmd_line_b =~	s/([^A-Za-z0-9])/sprintf("%%%02X", ord($1))/seg;
					$cmd_line_c =~	s/([^A-Za-z0-9])/sprintf("%%%02X", ord($1))/seg;
					$cmd_line_d =~	s/([^A-Za-z0-9])/sprintf("%%%02X", ord($1))/seg;
					$cmd_line_e =~	s/([^A-Za-z0-9])/sprintf("%%%02X", ord($1))/seg;
					$cmd_line_f =~	s/([^A-Za-z0-9])/sprintf("%%%02X", ord($1))/seg;
					$cmd_line_g =~	s/([^A-Za-z0-9])/sprintf("%%%02X", ord($1))/seg;
					$cmd_line_h =~	s/([^A-Za-z0-9])/sprintf("%%%02X", ord($1))/seg;
					$cmd_line_i =~	s/([^A-Za-z0-9])/sprintf("%%%02X", ord($1))/seg;
					$cmd_line_j =~	s/([^A-Za-z0-9])/sprintf("%%%02X", ord($1))/seg;
					$cmd_line_k =~	s/([^A-Za-z0-9])/sprintf("%%%02X", ord($1))/seg;

					$launch_string = "$PATHhome/AST_send_action_child.pl --SYSLOG=$SYSLOG --PATHlogs=$cPATHlogs --telnet_host=$telnet_host --telnet_port=$telnet_port --ASTmgrUSERNAME=$ASTmgrUSERNAME --ASTmgrSECRET=$ASTmgrSECRET --ASTmgrUSERNAMEsend=$ASTmgrUSERNAMEsend --action=$action --cmd_line_b=$cmd_line_b --cmd_line_c=$cmd_line_c --cmd_line_d=$cmd_line_d --cmd_line_e=$cmd_line_e --cmd_line_f=$cmd_line_f --cmd_line_g=$cmd_line_g --cmd_line_h=$cmd_line_h --cmd_line_i=$cmd_line_i --cmd_line_j=$cmd_line_j --cmd_line_k=$cmd_line_k  $callid $uniqueid $channel";
					&launch_logger;


					if ($SYSLOG)
						{
						system("$PATHhome/AST_send_action_child.pl --SYSLOG=$SYSLOG --PATHlogs=$PATHlogs --telnet_host=$telnet_host --telnet_port=$telnet_port --ASTmgrUSERNAME=$ASTmgrUSERNAME --ASTmgrSECRET=$ASTmgrSECRET --ASTmgrUSERNAMEsend=$ASTmgrUSERNAMEsend --action=$action --cmd_line_b=$cmd_line_b --cmd_line_c=$cmd_line_c --cmd_line_d=$cmd_line_d --cmd_line_e=$cmd_line_e --cmd_line_f=$cmd_line_f --cmd_line_g=$cmd_line_g --cmd_line_h=$cmd_line_h --cmd_line_i=$cmd_line_i --cmd_line_j=$cmd_line_j --cmd_line_k=$cmd_line_k >> $PATHlogs/action_send.$action_log_date \&");
						}
					else
						{
						system("$PATHhome/AST_send_action_child.pl --SYSLOG=$SYSLOG --PATHlogs=$PATHlogs --telnet_host=$telnet_host --telnet_port=$telnet_port --ASTmgrUSERNAME=$ASTmgrUSERNAME --ASTmgrSECRET=$ASTmgrSECRET --ASTmgrUSERNAMEsend=$ASTmgrUSERNAMEsend --action=$action --cmd_line_b=$cmd_line_b --cmd_line_c=$cmd_line_c --cmd_line_d=$cmd_line_d --cmd_line_e=$cmd_line_e --cmd_line_f=$cmd_line_f --cmd_line_g=$cmd_line_g --cmd_line_h=$cmd_line_h --cmd_line_i=$cmd_line_i --cmd_line_j=$cmd_line_j --cmd_line_k=$cmd_line_k \&");
						}

					$launch_string = "SENT $man_id  $callid $uniqueid $channel";
			#		&launch_logger;

					$stmtA = "UPDATE vicidial_manager set status='SENT' where man_id='$man_id'";
						if($DB){print STDERR "\n|$stmtA|\n";}
					$affected_rows = $dbhA->do($stmtA);

						$event_string="SQL_QUERY|$stmtA|";
					&event_logger;
					}
				else
					{
					$stmtA = "UPDATE vicidial_manager set status='DEAD' where man_id='$man_id'";
						if($DB){print STDERR "\n|$stmtA|\n";}
					$affected_rows = $dbhA->do($stmtA);
						$event_string="COMMAND NOT SENT, SQL_QUERY|$stmtA|";
					&event_logger;
					}
          $rec_count++;
		 }
		  $sthA->finish();
		}

	if ($affected_rows)
		{
		### sleep for 10 hundredths of a second
		usleep(1*100*1000);
		}
	else
		{
		### sleep for 20 hundredths of a second
		usleep(1*200*1000);
		}

	$endless_loop--;
		if( ($COUNTER_OUTPUT) or ($DB) ){print STDERR "loop counter: |$endless_loop|\r";}

		### putting a blank file called "sendmgr.kill" in a directory will automatically safely kill this program
		if ( (-e '$PATHhome/sendmgr.kill') or ($sendonlyone) )
			{
			unlink('$PATHhome/sendmgr.kill');
			$endless_loop=0;
			$one_day_interval=0;
			print "\nPROCESS KILLED MANUALLY... EXITING\n\n";
			}

		if ($endless_loop =~ /0$/)
			{
				&get_time_now;

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


			if( ($COUNTER_OUTPUT) or ($DB) ){print "checking to see if listener is dead |$sendonlyone|$running_listen|\n";}
			#@psoutput = `/bin/ps -f --no-headers -A`;
			@psoutput = `/bin/ps -o "%p %a" --no-headers -A`;

			$running_listen = 0;

			$i=0;
			foreach (@psoutput)
			{
				chomp($psoutput[$i]);

			if ($DBX) {print "$i|$psoutput[$i]|     \n";}
			@psline = split(/\/usr\/bin\/perl /,$psoutput[$i]);

			if ($psline[1] =~ /AST_manager_li/) 
				{
				$running_listen++;
				if ($DB) {print "SEND RUNNING: |$psline[1]|\n";}
				}

			$i++;
			}

			if (!$running_listen) 
				{
				$sendonlyone++;
				if( ($COUNTER_OUTPUT) or ($DB) ){print "LISTENER DEAD STOPPING PROGRAM... ATTEMPTING TO START keepalive SCRIPT\n";}
				$event_string='LISTENER DEAD STOPPING PROGRAM... ATTEMPTING TO START keepalive SCRIPT|';
				&event_logger;
			#	`/usr/bin/at now < $PATHhome/ADMIN_keepalive_send_listen.at 2>/dev/null 1>&2`;
				`/usr/bin/screen -d -m $PATHhome/ADMIN_keepalive_AST_send_listen.pl 2>/dev/null 1>&2`
				}
			}


	}


		if( ($COUNTER_OUTPUT) or ($DB) ){print "DONE... Exiting... Goodbye... See you later... Not really, initiating next loop...$one_day_interval left\n";}

	$one_day_interval--;

}

		$event_string='CLOSING DB CONNECTION|';
		&event_logger;


		$dbhA->disconnect();


	if( ($COUNTER_OUTPUT) or ($DB) ){print "DONE... Exiting... Goodbye... See you later... Really I mean it this time\n";}


exit;







sub get_time_now	#get the current date and time and epoch for logging call lengths and datetimes
{
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
}





sub event_logger 
{
if ($SYSLOG)
	{
	### open the log file for writing ###
	open(Lout, ">>$PATHlogs/action_process.$action_log_date")
			|| die "Can't open $PATHlogs/action_process.$action_log_date: $!\n";
	print Lout "$now_date|$event_string|\n";
	close(Lout);
	}
$event_string='';
}

sub launch_logger
{
if ($SYSLOG)
	{
	### open the log file for writing ###
	open(LLout, ">>$PATHlogs/action_launch.$action_log_date")
			|| die "Can't open $PATHlogs/action_launch.$action_log_date: $!\n";
	print LLout "$now_date|$launch_string|\n";
	close(LLout);
	}
$event_string='';
}
