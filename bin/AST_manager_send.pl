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

### Make sure this file is in a libs path or put the absolute path to it
require("/home/cron/AST_SERVER_conf.pl");	# local configuration file

if (!$DB_port) {$DB_port='3306';}

	&get_time_now;

	$event_string='PROGRAM STARTED||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||';
	&event_logger;

#use lib './lib', '../lib';
use Time::HiRes ('gettimeofday','usleep','sleep');  # necessary to have perl sleep command of less than one second
use DBI;
#use Net::Telnet ();
	  
	$dbhA = DBI->connect("DBI:mysql:$DB_database:$DB_server:$DB_port", "$DB_user", "$DB_pass")
    or die "Couldn't connect to database: " . DBI->errstr;

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

	$stmtA = "SELECT count(*) from vicidial_manager where server_ip = '$server_ip' and status = 'NEW'";
	    $sthA = $dbhA->prepare($stmtA) or die "preparing: ",$dbhA->errstr;
		$sthA->execute or die "executing: $stmtA ", $dbhA->errstr;
		$sthArows=$sthA->rows;
		$rec_count=0;
	 	@aryA = $sthA->fetchrow_array;
		if($DB){print STDERR $aryA[0]," NEW Actions to send on server $server_ip      $endless_loop\n";}
		$NEW_actions	 = "$aryA[0]";
		$rec_count++;
	    $sthA->finish();

	if (!$NEW_actions)
		{
		$affected_rows=0;
		}
	else
		{
		$stmtA = "UPDATE vicidial_manager set status='QUEUE' where server_ip = '$server_ip' and status = 'NEW' order by entry_date limit 1";
	    $affected_rows = $dbhA->do($stmtA);
		if ($DB) {print STDERR "rows updated to QUEUE: |$affected_rows|\n";}
		}


	if ($affected_rows)
		{
		$stmtA = "SELECT * FROM vicidial_manager where server_ip = '$server_ip' and status = 'QUEUE' order by entry_date desc limit 1";
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
				$cmd_line_i	 = "$record->[16]";
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
					   $stmtB = "SELECT count(*) FROM vicidial_manager where server_ip = '$server_ip' and callerid='$callid' and status = 'DEAD'";
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

					$launch_string = "/home/cron/AST_send_action_child.pl --data1=$man_id  $callid $uniqueid $channel";
			#		&launch_logger;

					system("/home/cron/AST_send_action_child.pl --data1=$man_id >> /home/cron/action.$action_log_date \&");

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
		if ( (-e '/home/cron/sendmgr.kill') or ($sendonlyone) )
			{
			unlink('/home/cron/sendmgr.kill');
			$endless_loop=0;
			$one_day_interval=0;
			print "\nPROCESS KILLED MANUALLY... EXITING\n\n";
			}

		if ($endless_loop =~ /0$/)
			{
				&get_time_now;

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
				`/usr/bin/at now < /home/cron/ADMIN_keepalive_send_listen.at 2>/dev/null 1>&2`;
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





sub event_logger {
	### open the log file for writing ###
	open(Lout, ">>$MSLOGfile")
			|| die "Can't open $MSLOGfile: $!\n";

	print Lout "$now_date|$event_string|\n";

	close(Lout);

$event_string='';
}

sub launch_logger {
	### open the log file for writing ###
	open(LLout, ">>/home/cron/action_launch.$action_log_date")
			|| die "Can't open /home/cron/action_launch.$action_log_date: $!\n";

	print LLout "$now_date|$launch_string|\n";

	close(LLout);

$event_string='';
}
