#!/usr/bin/perl

# install.pl
#
# Copyright (C) 2006  Matt Florell <vicidial@gmail.com>    LICENSE: GPLv2
#

############################################
# install.pl - puts server files in the right places and creates conf file
#
# default paths.
#
# default path to astguiclient configuration file:
$PATHconf =		'/etc/astguiclient.conf';
# default path to home directory:
$PATHhome =		'/usr/share/astguiclient';
# default path to astguiclient logs directory: 
$PATHlogs =		'/var/logs/astguiclient';
# default path to asterisk agi-bin directory: 
$PATHagi =		'/var/lib/asterisk/agi-bin';
# default path to web root directory: 
#$PATHweb =		'/var/www/html';
#$PATHweb =		'/home/www/htdocs';
$PATHweb =		'/usr/local/apache2/htdocs';
# default path to asterisk sounds directory: 
$PATHsounds =	'/var/lib/asterisk/sounds';
# default path to asterisk recordings directory: 
$PATHmonitor =	'/var/spool/asterisk';
# default database server variable: 
$VARDB_server =	'localhost';

############################################

$CLIhome=0;
$CLIlogs=0;
$CLIagi=0;
$CLIweb=0;
$CLIsounds=0;
$CLImonitor=0;
$CLIserver_ip=0;
$CLIDB_server=0;

$COPYhome=0;
$COPYlogs=0;
$COPYagi=0;
$COPYweb=0;
$COPYsounds=0;
$COPYmonitor=0;

$secX = time();

# constants
$DB=1;  # Debug flag, set to 0 for no debug messages, lots of output
$US='_';
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
	print "install.pl - installs astGUIclient server files in the proper places, this\n";
	print "script will look for an /etc/astguiclient.conf file for existing settings, and\n";
	print "if not present will prompt for proper information then copy files.\n";
	print "\n";
	print "allowed run time options:\n";
	print "  [--help] = this help screen\n";
	print "  [--test] = test (will not copy files)\n";
	print "  [--debug] = verbose debug messages\n";
	print "  [--home=/path/from/root] = define home path from root at runtime\n";
	print "  [--logs=/path/from/root] = define logs path from root at runtime\n";
	print "  [--agi=/path/from/root] = define agi-bin path from root at runtime\n";
	print "  [--web=/path/from/root] = define webroot path from root at runtime\n";
	print "  [--sounds=/path/from/root] = define sounds path from root at runtime\n";
	print "  [--monitor=/path/from/root] = define monitor path from root at runtime\n";
	print "  [--server_ip=192.168.0.1] = define server IP address at runtime\n";
	print "  [--DB_server=localhost] = define Database server IP address at runtime\n";
	print "\n";

	exit;
	}
	else
	{
		if ($args =~ /--debug/i) # Debug flag
		{
		$DB=1;
		}
		if ($args =~ /--test/i) # test flag
		{
		$TEST=1;   $T=1;
		}
		if ($args =~ /--home=/i) # CLI defined home path
		{
		@CLIhomeARY = split(/--home=/,$args);
		@CLIhomeARX = split(/ /,$CLIhomeARY[1]);
		if (length($CLIhomeARX[0])>2)
			{
			$PATHhome = $CLIhomeARX[0];
			$PATHhome =~ s/\/$//gi;
			$CLIhome=1;
			print "  CLI defined home path:      $PATHhome\n";
			}
		}
		if ($args =~ /--logs=/i) # CLI defined logs path
		{
		@CLIlogsARY = split(/--logs=/,$args);
		@CLIlogsARX = split(/ /,$CLIlogsARY[1]);
		if (length($CLIlogsARX[0])>2)
			{
			$PATHlogs = $CLIlogsARX[0];
			$PATHlogs =~ s/\/$//gi;
			$CLIlogs=1;
			print "  CLI defined logs path:      $PATHlogs\n";
			}
		}
		if ($args =~ /--agi=/i) # CLI defined agi-bin path
		{
		@CLIagiARY = split(/--agi=/,$args);
		@CLIagiARX = split(/ /,$CLIagiARY[1]);
		if (length($CLIagiARX[0])>2)
			{
			$PATHagi = $CLIagiARX[0];
			$PATHagi =~ s/\/$//gi;
			$CLIagi=1;
			print "  CLI defined agi-bin path:   $PATHagi\n";
			}
		}
		if ($args =~ /--web=/i) # CLI defined webroot path
		{
		@CLIwebARY = split(/--web=/,$args);
		@CLIwebARX = split(/ /,$CLIwebARY[1]);
		if (length($CLIwebARX[0])>2)
			{
			$PATHweb = $CLIwebARX[0];
			$PATHweb =~ s/\/$//gi;
			$CLIweb=1;
			print "  CLI defined webroot path:   $PATHweb\n";
			}
		}
		if ($args =~ /--sounds=/i) # CLI defined sounds path
		{
		@CLIsoundsARY = split(/--sounds=/,$args);
		@CLIsoundsARX = split(/ /,$CLIsoundsARY[1]);
		if (length($CLIsoundsARX[0])>2)
			{
			$PATHsounds = $CLIsoundsARX[0];
			$PATHsounds =~ s/\/$//gi;
			$CLIsounds=1;
			print "  CLI defined sounds path:    $PATHsounds\n";
			}
		}
		if ($args =~ /--monitor=/i) # CLI defined monitor path
		{
		@CLImonitorARY = split(/--monitor=/,$args);
		@CLImonitorARX = split(/ /,$CLImonitorARY[1]);
		if (length($CLImonitorARX[0])>2)
			{
			$PATHmonitor = $CLImonitorARX[0];
			$PATHmonitor =~ s/\/$//gi;
			$CLImonitor=1;
			print "  CLI defined monitor path:   $PATHmonitor\n";
			}
		}
		if ($args =~ /--server_ip=/i) # CLI defined server IP address
		{
		@CLIserver_ipARY = split(/--server_ip=/,$args);
		@CLIserver_ipARX = split(/ /,$CLIserver_ipARY[1]);
		if (length($CLIserver_ipARX[0])>2)
			{
			$VARserver_ip = $CLIserver_ipARX[0];
			$VARserver_ip =~ s/\/$//gi;
			$CLIserver_ip=1;
			print "  CLI defined server IP:      $VARserver_ip\n";
			}
		}
		if ($args =~ /--DB_server=/i) # CLI defined Database server address
		{
		@CLIDB_serverARY = split(/--DB_server=/,$args);
		@CLIDB_serverARX = split(/ /,$CLIDB_serverARY[1]);
		if (length($CLIDB_serverARX[0])>2)
			{
			$VARDB_server = $CLIDB_serverARX[0];
			$VARDB_server =~ s/\/$//gi;
			$CLIDB_server=1;
			print "  CLI defined DB server:      $VARDB_server\n";
			}
		}
	}
}
else
{
#	print "no command line options set\n";
}
### end parsing run-time options ###

if (-e "$PATHconf") 
	{
	print "Previous astGUIclient configuration file found at: $PATHconf\n";
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
		$i++;
		}
	}

print("\nWould you like to use manual configuration(y/n): [y] ");
$manual = <STDIN>;
chomp($manual);
if ($manual =~ /n/i)
	{
	$manual=0;
	}
else
	{
	##### BEGIN astguiclient home directory prompting and existence check #####
	$continue='NO';
	while ($continue =~/NO/)
		{
		print("\nastguiclient home path or press enter for default: [$PATHhome] ");
		$PROMPThome = <STDIN>;
		chomp($PROMPThome);
		if (length($PROMPThome)>2)
			{
			$PROMPThome =~ s/ |\n|\r|\t|\/$//gi;
			if (!-e "$PROMPThome")
				{
				print("$PROMPThome does not exist, would you like me to create it?(y/n) [y] ");
				$createPROMPThome = <STDIN>;
				chomp($createPROMPThome);
				if ($createPROMPThome =~ /n/i)
					{
					$continue='NO';
					}
				else
					{
					`mkdir -p $PROMPThome`;
						print "     $PROMPThome directory created\n";
					$PATHhome=$PROMPThome;
					$continue='YES';
					}
				}
			else
				{
				$PATHhome=$PROMPThome;
				$continue='YES';
				}
			}
		else
			{
			if (!-e "$PATHhome")
				{
				print("$PATHhome does not exist, would you like me to create it?(y/n) [y] ");
				$createPATHhome = <STDIN>;
				chomp($createPATHhome);
				if ($createPATHhome =~ /n/i)
					{
					$continue='NO';
					}
				else
					{
					`mkdir -p $PATHhome`;
						print "     $PATHhome directory created\n";
					$continue='YES';
					}
				}
			else
				{
				$continue='YES';
				}
			}
		}
	##### END astguiclient home directory prompting and existence check #####

	##### BEGIN astguiclient logs directory prompting and existence check #####
	$continue='NO';
	while ($continue =~/NO/)
		{
		print("\nastguiclient logs path or press enter for default: [$PATHlogs] ");
		$PROMPTlogs = <STDIN>;
		chomp($PROMPTlogs);
		if (length($PROMPTlogs)>2)
			{
			$PROMPTlogs =~ s/ |\n|\r|\t|\/$//gi;
			if (!-e "$PROMPTlogs")
				{
				print("$PROMPTlogs does not exist, would you like me to create it?(y/n) [y] ");
				$createPROMPTlogs = <STDIN>;
				chomp($createPROMPTlogs);
				if ($createPROMPTlogs =~ /n/i)
					{
					$continue='NO';
					}
				else
					{
					`mkdir -p $PROMPTlogs`;
						print "     $PROMPTlogs directory created\n";
					$PATHlogs=$PROMPTlogs;
					$continue='YES';
					}
				}
			else
				{
				$PATHlogs=$PROMPTlogs;
				$continue='YES';
				}
			}
		else
			{
			if (!-e "$PATHlogs")
				{
				print("$PATHlogs does not exist, would you like me to create it?(y/n) [y] ");
				$createPATHlogs = <STDIN>;
				chomp($createPATHlogs);
				if ($createPATHlogs =~ /n/i)
					{
					$continue='NO';
					}
				else
					{
					`mkdir -p $PATHlogs`;
					print "     $PATHlogs directory created\n";
					$continue='YES';
					}
				}
			else
				{
				$continue='YES';
				}
			}
		}
	##### END astguiclient logs directory prompting and existence check #####

	##### BEGIN asterisk agi-bin directory prompting and existence check #####
	$continue='NO';
	while ($continue =~/NO/)
		{
		print("\nasterisk agi-bin path or press enter for default: [$PATHagi] ");
		$PROMPTagi = <STDIN>;
		chomp($PROMPTagi);
		if (length($PROMPTagi)>2)
			{
			$PROMPTagi =~ s/ |\n|\r|\t|\/$//gi;
			if (!-e "$PROMPTagi")
				{
				print("$PROMPTagi does not exist, would you like me to create it?(y/n) [y] ");
				$createPROMPTagi = <STDIN>;
				chomp($createPROMPTagi);
				if ($createPROMPTagi =~ /n/i)
					{
					$continue='NO';
					}
				else
					{
					`mkdir -p $PROMPTagi`;
						print "     $PROMPTagi directory created\n";
					$PATHagi=$PROMPTagi;
					$continue='YES';
					}
				}
			else
				{
				$PATHagi=$PROMPTagi;
				$continue='YES';
				}
			}
		else
			{
			if (!-e "$PATHagi")
				{
				print("$PATHagi does not exist, would you like me to create it?(y/n) [y] ");
				$createPATHagi = <STDIN>;
				chomp($createPATHagi);
				if ($createPATHagi =~ /n/i)
					{
					$continue='NO';
					}
				else
					{
					`mkdir -p $PATHagi`;
					print "     $PATHagi directory created\n";
					$continue='YES';
					}
				}
			else
				{
				$continue='YES';
				}
			}
		}
	##### END asterisk agi-bin directory prompting and existence check #####

	##### BEGIN server webroot directory prompting and existence check #####
	$continue='NO';
	while ($continue =~/NO/)
		{
		print("\nserver webroot path or press enter for default: [$PATHweb] ");
		$PROMPTweb = <STDIN>;
		chomp($PROMPTweb);
		if (length($PROMPTweb)>2)
			{
			$PROMPTweb =~ s/ |\n|\r|\t|\/$//gi;
			if (!-e "$PROMPTweb")
				{
				print("$PROMPTweb does not exist, would you like me to create it?(y/n) [y] ");
				$createPROMPTweb = <STDIN>;
				chomp($createPROMPTweb);
				if ($createPROMPTweb =~ /n/i)
					{
					$continue='NO';
					}
				else
					{
					`mkdir -p $PROMPTweb`;
						print "     $PROMPTweb directory created\n";
					$PATHweb=$PROMPTweb;
					$continue='YES';
					}
				}
			else
				{
				$PATHweb=$PROMPTweb;
				$continue='YES';
				}
			}
		else
			{
			if (!-e "$PATHweb")
				{
				print("$PATHweb does not exist, would you like me to create it?(y/n) [y] ");
				$createPATHweb = <STDIN>;
				chomp($createPATHweb);
				if ($createPATHweb =~ /n/i)
					{
					$continue='NO';
					}
				else
					{
					`mkdir -p $PATHweb`;
					print "     $PATHweb directory created\n";
					$continue='YES';
					}
				}
			else
				{
				$continue='YES';
				}
			}
		}
	##### END server webroot directory prompting and existence check #####

	##### BEGIN asterisk sounds directory prompting and existence check #####
	$continue='NO';
	while ($continue =~/NO/)
		{
		print("\nasterisk sounds path or press enter for default: [$PATHsounds] ");
		$PROMPTsounds = <STDIN>;
		chomp($PROMPTsounds);
		if (length($PROMPTsounds)>2)
			{
			$PROMPTsounds =~ s/ |\n|\r|\t|\/$//gi;
			if (!-e "$PROMPTsounds")
				{
				print("$PROMPTsounds does not exist, would you like me to create it?(y/n) [y] ");
				$createPROMPTsounds = <STDIN>;
				chomp($createPROMPTsounds);
				if ($createPROMPTsounds =~ /n/i)
					{
					$continue='NO';
					}
				else
					{
					`mkdir -p $PROMPTsounds`;
						print "     $PROMPTsounds directory created\n";
					$PATHsounds=$PROMPTsounds;
					$continue='YES';
					}
				}
			else
				{
				$PATHsounds=$PROMPTsounds;
				$continue='YES';
				}
			}
		else
			{
			if (!-e "$PATHsounds")
				{
				print("$PATHsounds does not exist, would you like me to create it?(y/n) [y] ");
				$createPATHsounds = <STDIN>;
				chomp($createPATHsounds);
				if ($createPATHsounds =~ /n/i)
					{
					$continue='NO';
					}
				else
					{
					`mkdir -p $PATHsounds`;
					print "     $PATHsounds directory created\n";
					$continue='YES';
					}
				}
			else
				{
				$continue='YES';
				}
			}
		}
	##### END asterisk sounds directory prompting and existence check #####

	##### BEGIN asterisk monitor directory prompting and existence check #####
	$continue='NO';
	while ($continue =~/NO/)
		{
		print("\nasterisk monitor path or press enter for default: [$PATHmonitor] ");
		$PROMPTmonitor = <STDIN>;
		chomp($PROMPTmonitor);
		if (length($PROMPTmonitor)>2)
			{
			$PROMPTmonitor =~ s/ |\n|\r|\t|\/$//gi;
			if (!-e "$PROMPTmonitor")
				{
				print("$PROMPTmonitor does not exist, would you like me to create it?(y/n) [y] ");
				$createPROMPTmonitor = <STDIN>;
				chomp($createPROMPTmonitor);
				if ($createPROMPTmonitor =~ /n/i)
					{
					$continue='NO';
					}
				else
					{
					`mkdir -p $PROMPTmonitor`;
						print "     $PROMPTmonitor directory created\n";
					$PATHmonitor=$PROMPTmonitor;
					$continue='YES';
					}
				}
			else
				{
				$PATHmonitor=$PROMPTmonitor;
				$continue='YES';
				}
			}
		else
			{
			if (!-e "$PATHmonitor")
				{
				print("$PATHmonitor does not exist, would you like me to create it?(y/n) [y] ");
				$createPATHmonitor = <STDIN>;
				chomp($createPATHmonitor);
				if ($createPATHmonitor =~ /n/i)
					{
					$continue='NO';
					}
				else
					{
					`mkdir -p $PATHmonitor`;
					print "     $PATHmonitor directory created\n";
					$continue='YES';
					}
				}
			else
				{
				$continue='YES';
				}
			}
		}
	##### END asterisk monitor directory prompting and existence check #####

	##### BEGIN server_ip propmting and check #####
	if (length($VARserver_ip)<7)
		{	
		### get best guess of IP address from ifconfig output ###
		# inet addr:10.10.11.17  Bcast:10.10.255.255  Mask:255.255.0.0
		@ip = `/sbin/ifconfig`;
		$j=0;
		while($#ip>=$j)
			{
			if ($ip[$j] =~ /inet addr/) {$VARserver_ip = $ip[$j]; $j=1000;}
			$j++;
			}
		$VARserver_ip =~ s/.*addr:| Bcast.*|\r|\n|\t| //gi;
		}

	$continue='NO';
	while ($continue =~/NO/)
		{
		print("\nserver IP address or press enter for default: [$VARserver_ip] ");
		$PROMPTserver_ip = <STDIN>;
		chomp($PROMPTserver_ip);
		if (length($PROMPTserver_ip)>6)
			{
			$PROMPTserver_ip =~ s/ |\n|\r|\t|\/$//gi;
			$VARserver_ip=$PROMPTserver_ip;
			$continue='YES';
			}
		else
			{
			$continue='YES';
			}
		}
	##### END server_ip propmting and check  #####


	##### BEGIN DB_server propmting and check #####
	if (length($VARDB_server)<7)
		{	
		$VARDB_server = 'localhost';
		}
	$continue='NO';
	while ($continue =~/NO/)
		{
		print("\nDB server address or press enter for default: [$VARDB_server] ");
		$PROMPTserver_ip = <STDIN>;
		chomp($PROMPTDB_server);
		if (length($PROMPTDB_server)>6)
			{
			$PROMPTDB_server =~ s/ |\n|\r|\t|\/$//gi;
			$VARDB_server=$PROMPTDB_server;
			$continue='YES';
			}
		else
			{
			$continue='YES';
			}
		}
	##### END DB_server propmting and check  #####

print "Writing to astguiclient.conf file: $PATHconf\n";

open(conf, ">$PATHconf") || die "can't open $PATHconf: $!\n";
print conf "# astguiclient.conf - configuration elements for the astguiclient package\n";
print conf "# this is the astguiclient configuration file \n";
print conf "# all comments will be lost if you run install.pl again\n";
print conf "\n";
print conf "PATHhome => $PATHhome\n";
print conf "PATHlogs => $PATHlogs\n";
print conf "PATHagi => $PATHagi\n";
print conf "PATHweb => $PATHweb\n";
print conf "PATHsounds => $PATHsounds\n";
print conf "PATHmonitor => $PATHmonitor\n\n";
print conf "VARserver_ip => $VARserver_ip\n";
print conf "VARDB_server => $VARDB_server\n";
close(conf);

print "  defined home path:      $PATHhome\n";
print "  defined logs path:      $PATHlogs\n";
print "  defined agi-bin path:   $PATHagi\n";
print "  defined webroot path:   $PATHweb\n";
print "  defined sounds path:    $PATHsounds\n";
print "  defined monitor path:   $PATHmonitor\n";
print "  defined server_ip:      $VARserver_ip\n";
print "  defined DB_server:      $VARDB_server\n";


	}
exit;









print "\n----- INSTALL BUILD: $CLIlanguage -----\n\n";
$LANG_FILE_ADMIN = "./translations/$CLIlanguage$US$language_admin_file";
open(lang, "$LANG_FILE_ADMIN") || die "can't open $LANG_FILE_ADMIN: $!\n";
@lang = <lang>;
close(lang);


print "INSTALLING SERVER SIDE COMPONENTS...\n";

print "Creating cron/LOGS directory...\n";
`mkdir $home/LOGS/`;

print "setting LOGS directory to executable...\n";
`chmod 0766 $home/LOGS`;

print "Creating $home/VICIDIAL/LEADS_IN/DONE directory...\n";
`mkdir $home/VICIDIAL`;
`mkdir $home/VICIDIAL/LEADS_IN`;
`mkdir $home/VICIDIAL/LEADS_IN/DONE`;
`chmod -R 0766 $home/VICIDIAL`;

print "Creating $monitor directories...\n";
`mkdir $monitor/monitor`;
`mkdir $monitor/monitor/ORIG`;
`mkdir $monitor/monitor/DONE`;
`chmod -R 0766 $monitor/monitor`;

print "Copying cron scripts...\n";
`cp -f ./ADMIN_adjust_GMTnow_on_leads.pl $home/`;
`cp -f ./ADMIN_area_code_populate.pl $home/`;
`cp -f ./ADMIN_keepalive_AST_send_listen.pl $home/`;
`cp -f ./ADMIN_keepalive_send_listen.at $home/`;
`cp -f ./ADMIN_keepalive_AST_update.pl $home/`;
`cp -f ./ADMIN_keepalive_AST_VDautodial.pl $home/`;
`cp -f ./ADMIN_keepalive_AST_VDremote_agents.pl $home/`;
`cp -f ./ADMIN_restart_roll_logs.pl $home/`;
`cp -f ./AST_agent_week.pl $home/`;
`cp -f ./AST_cleanup_agent_log.pl $home/`;
`cp -f ./AST_conf_update.pl $home/`;
`cp -f ./AST_CRON_mix_recordings.pl $home/`;
`cp -f ./AST_CRON_mix_recordings_BASIC.pl $home/`;
`cp -f ./AST_CRON_mix_recordings_GSM.pl $home/`;
`cp -f ./AST_DB_optimize.pl $home/`;
`cp -f ./AST_flush_DBqueue.pl $home/`;
`cp -f ./AST_manager_kill_hung_congested.pl $home/`;
`cp -f ./AST_manager_listen.pl $home/`;
`cp -f ./AST_manager_send.pl $home/`;
`cp -f ./AST_reset_mysql_vars.pl $home/`;
`cp -f ./AST_send_action_child.pl $home/`;
`cp -f ./AST_SERVER_conf.pl $home/`;
`cp -f ./AST_update.pl $home/`;
`cp -f ./AST_VDauto_dial.pl $home/`;
`cp -f ./AST_VDhopper.pl $home/`;
`cp -f ./AST_VDremote_agents.pl $home/`;
`cp -f ./AST_vm_update.pl $home/`;
`cp -f ./phone_codes_GMT.txt $home/`;
`cp -f ./start_asterisk_boot.pl $home/`;
`cp -f ./VICIDIAL_IN_new_leads_file.pl $home/`;
`cp -f ./test_VICIDIAL_lead_file.txt $home/VICIDIAL/LEADS_IN/`;


print "setting cron scripts to executable...\n";
`chmod 0755 $home/*`;

print "Copying agi-bin scripts...\n";
`cp -f ./agi-dtmf.agi $agibin/`;
`cp -f ./agi-record_prompts.agi $agibin/`;
`cp -f ./agi-VDAD_LB_closer.agi $agibin/`;
`cp -f ./agi-VDAD_LB_closer_inbound.agi $agibin/`;
`cp -f ./agi-VDAD_LB_transfer.agi $agibin/`;
`cp -f ./agi-VDAD_LO_closer.agi $agibin/`;
`cp -f ./agi-VDAD_LO_closer_inbound.agi $agibin/`;
`cp -f ./agi-VDAD_LO_transfer.agi $agibin/`;
`cp -f ./agi-VDADautoREMINDER.agi $agibin/`;
`cp -f ./agi-VDADautoREMINDERxfer.agi $agibin/`;
`cp -f ./agi-VDADcloser.agi $agibin/`;
`cp -f ./agi-VDADcloser_inbound.agi $agibin/`;
`cp -f ./agi-VDADcloser_inbound_5ID.agi $agibin/`;
`cp -f ./agi-VDADcloser_inbound_NOCID.agi $agibin/`;
`cp -f ./agi-VDADcloser_inboundANI.agi $agibin/`;
`cp -f ./agi-VDADcloser_inboundCID.agi $agibin/`;
`cp -f ./agi-VDADcloser_inboundCIDlookup.agi $agibin/`;
`cp -f ./agi-VDADcloser_PHONE.agi $agibin/`;
`cp -f ./agi-VDADtransfer.agi $agibin/`;
`cp -f ./agi-VDADtransferSURVEY.agi $agibin/`;
`cp -f ./call_inbound.agi $agibin/`;
`cp -f ./call_log.agi $agibin/`;
`cp -f ./call_logCID.agi $agibin/`;
`cp -f ./call_park.agi $agibin/`;
`cp -f ./call_park_EXT.agi $agibin/`;
`cp -f ./call_park_I.agi $agibin/`;
`cp -f ./call_park_L.agi $agibin/`;
`cp -f ./call_park_W.agi $agibin/`;
`cp -f ./debug_speak.agi $agibin/`;
`cp -f ./invalid_speak.agi $agibin/`;
`cp -f ./park_CID.agi $agibin/`;
`cp -f ./VD_amd.agi $agibin/`;
`cp -f ./VD_amd_post.agi $agibin/`;
`cp -f ./VD_hangup.agi $agibin/`;


print "setting agi-bin scripts to executable...\n";
`chmod 0755 $agibin/*`;

print "Copying sounds...\n";
`cp -f ./DTMF_sounds/* $sounds/`;

print "Creating vicidial web directory...\n";
`mkdir $webroot/vicidial/`;
`mkdir $webroot/vicidial/ploticus/`;
`mkdir $webroot/vicidial/agent_reports/`;

print "Copying VICIDIALweb php files...\n";
`cp -f ./VICIDIAL_web/* $webroot/vicidial/`;

print "setting VICIDIALweb scripts to executable...\n";
`chmod -R 0755 $webroot/vicidial/`;
`chmod 0777 $webroot/vicidial/`;
`chmod 0777 $webroot/vicidial/ploticus/`;
`chmod 0777 $webroot/vicidial/agent_reports/`;

print "Creating agc web directory...\n";
`mkdir $webroot/agc/`;

print "Copying agc php files...\n";
`cp -R -f ./agc/* $webroot/agc/`;

print "setting agc scripts to executable...\n";
`chmod -R 0755 $webroot/agc/`;
`chmod 0777 $webroot/agc/`;

print "Creating astguiclient web directory...\n";
`mkdir $webroot/astguiclient/`;

print "Copying astguiclient web php files...\n";
`cp -f ./astguiclient_web/* $webroot/astguiclient/`;

print "setting astguiclient web scripts to executable...\n";
`chmod -R 0755 $webroot/astguiclient/`;
`chmod 0777 $webroot/astguiclient/`;




$secy = time();		$secz = ($secy - $secX);		$minz = ($secz/60);		# calculate script runtime so far
print "\n     - process runtime      ($secz sec) ($minz minutes)\n";
print "\n\nDONE and EXITING\n";


exit;
