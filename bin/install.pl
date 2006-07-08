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
# default path to home directory:
$home =		'/usr/share/astguiclient';

# default path to agi-bin directory: 
$agibin =	'/var/lib/asterisk/agi-bin';

# default path to web root directory: 
#$webroot =	'/var/www/html';
#$webroot =	'/home/www/htdocs';
$webroot =	'/usr/local/apache2/htdocs';

# default path to asterisk sounds directory: 
$sounds =	'/var/lib/asterisk/sounds';

# default path to asterisk recordings directory: 
$monitor =	'/var/spool/asterisk';

############################################

$secX = time();

# constants
$DB=1;  # Debug flag, set to 0 for no debug messages, lots of output
$US='_';
$MT[0]='';
$language_admin_file = 'language_admin.txt';
$language_file = 'language.txt';

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
	print "if not present will prompt for proper information.\n";
	print "\n";
	print "allowed run time options:\n  [-t] = test\n  [-debug] = verbose debug messages\n\n";

	exit;
	}
	else
	{
		if ($args =~ /-debug/i)
		{
		$DB=1; # Debug flag
		}
		if ($args =~ /--language=/i)
		{
		@data_in = split(/--language=/,$args);
			$CLIlanguage = $data_in[1];
		}
		else
			{$CLIlanguage = 'es';}	# default to build all languages
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


print "\n----- INSTALL BUILD: $CLIlanguage -----\n\n";
$LANG_FILE_ADMIN = "./translations/$CLIlanguage$US$language_admin_file";
open(lang, "$LANG_FILE_ADMIN") || die "can't open $LANG_FILE_ADMIN: $!\n";
@lang = <lang>;
close(lang);


else
{
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

}



$secy = time();		$secz = ($secy - $secX);		$minz = ($secz/60);		# calculate script runtime so far
print "\n     - process runtime      ($secz sec) ($minz minutes)\n";
print "\n\nDONE and EXITING\n";


exit;
