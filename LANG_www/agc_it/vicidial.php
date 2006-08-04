<?
# vicidial.php - the web-based version of the astVICIDIAL client application
# 
# Copyright (C) 2006  Matt Florell <vicidial@gmail.com>    LICENSE: GPLv2
#
# make sure you have added a user to the vicidial_users MySQL table with at least
# user_level 1 or greater to access this page. Also, you need to have the login
# and pass of a phone listed in the asterisk.phones table. The page grabs the 
# server info and other details from this login and pass.
#
# This script works best with Firefox or Mozilla, but will run for a couple
# hours on Internet Explorer before the memory leaks cause a crash.
#
# Other scripts that this application depends on:
# - vdc_db_query.php: Updates information in the database
# - manager_send.php: Sends manager actions to the DB for execution
#
# CHANGES
# 50607-1426 - First Build of VICIDIAL web client basic login process finished
# 50628-1620 - Added some basic formatting and worked on process flow
# 50628-1715 - Startup variables mapped to javascript variables
# 50629-1303 - Added Login Closer in-groups selection box and vla update
# 50629-1530 - Rough layout for customer info form section and button links
# 50630-1453 - Rough Manual Dial/Hangup with customer info displayed
# 50701-1450 - Added vicidial_log entries on dial and hangup
# 50701-1634 - Added Logout function
# 50705-1259 - Added call disposition functionality
# 50705-1432 - Added lead info DB update function
# 50705-1658 - Added web form functionality
# 50706-1043 - Added call park and pickup functions
# 50706-1234 - Added Start/Stop Recording functionality
# 50706-1614 - Added conference channels display option
# 50711-1333 - Removed call check redundancy and fixed a span bug
# 50727-1424 - Added customer channel and participant present sensing/alerts
# 50804-1057 - Added SendDTMF function and reconfigured the transfer span
# 50804-1224 - Added Local and Internal Closer transfer functions
# 50804-1628 - Added Blind transfer, activated LIVE CALL image and fixed bugs
# 50804-1808 - Added button images for left buttons
# 50815-1151 - Added 3Way calling functions to Transfer-conf frame
# 50815-1602 - Added images and buttons for xfer functions
# 50816-1813 - Added basic autodial outbound call pickup functions
# 50817-1113 - Fixes to auto_dialing call receipt
# 50817-1234 - Added inbound call receipt capability
# 50817-1541 - Added customer time display
# 50817-1541 - Added customer time display
# 50818-1327 - Added stop-all-recordings-after-each-vicidial-call option
# 50818-1703 - Added pretty login section
# 50825-1200 - Modified form field lengths, added double-click dispositions
# 50831-1603 - Fixed customer time bug and fronter display bug for CLOSER
# 50901-1314 - Fixed CLOSER IN-GROUP Web Form bug
# 50903-0904 - Added preview-lead code for manual dialing
# 50904-0016 - Added ability to hangup manual dials before pickup
# 50906-1319 - Added override for filters on xfer calls, fixed login display bug
# 50909-1243 - Added hotkeys functionality for quick dispoing in auto-dial mode
# 50912-0958 - Modified hotkeys function, agent must have user_level >= 5 to use
# 50913-1212 - Added campaign_cid to 3rd party calls
# 50923-1546 - Modified to work with language translation
# 50926-1656 - Added campaign pull-down at login of active campaigns
# 50928-1633 - Added manual dial alternate number dial option
# 50930-1538 - Added session_id empty login failure and fixed 2 minor bugs
# 51004-1656 - Fixed recording filename bug and new Spanish translation
# 51020-1103 - Added campaign-specific recording control abilities
# 51020-1352 - Added Basic vicidial_agent_log framework
# 51021-1050 - Fixed custtime display and disable Enter/Return keypresses
# 51021-1718 - Allows for multi-line comments (changes \n to !N in database)
# 51110-1432 - Fixed non-standard http port issue
# 51111-1047 - Added vicidial_agent_log lead_id earlier for manual dial
# 51118-1305 - Activate multi-line comments from $multi_line_comments var
# 51118-1313 - Move Transfer DIV to a floating span to preserve 800x600 view
# 51121-1506 - Small PHP optimizations in many scripts and disabled globalize
# 51129-1010 - Added ability to accept calls from other VICIDIAL servers
# 51129-1254 - Fixed Hangups of other agents channels when customer hangs up
# 51208-1732 - Created user-first login that looks for default phone info
# 51219-1526 - Added variable framework for campaign and in-group scripts
# 51221-1200 - Added SCRIPT tab, layout and functionality
# 51221-1714 - Added auto-switch-to-SCRIPT-tab and auto-webform-popup
# 51222-1605 - Added VMail message blind transfer button to xfer-conf frame
# 51229-1028 - Added checks on web_form_address to allow for var in the DB value
# 60117-1312 - Added Transfer-conf frame toggle on button press
# 60208-1152 - Added DTMF-xfernumber preset links to xfer-conf frame
# 60213-1129 - Added vicidial_users.hotkeys_active  for any user hotkeys
# 60213-1210 - Added ability to sort routing of calls by user_level
# 60214-0932 - Initial Callback calendar display framework
# 60214-1407 - Added ability to minimize the dispo screen to see info below
# 60215-1104 - Added ANYONE scheduled callbacks functionality
# 60410-1116 - Added persistant pause after dispo option and change dispo text
#            - Added web form submit that opens new window with dispo on submit
#            - Added PREVIOUS CALLBACK in customer info to flag callbacks
#            - Added link to try to hangup the call again in the dispo screen
#            - Added link noone-in-session screen to call agent phone again
#            - Added link customer-hungup screen to go straight to dispo screen
# 60410-1532 - Added agent status and campaign calls dialing display option
# 60411-1547 - Add ability to set callback as USERONLY and some basic formatting
# 60413-1752 - Add basic USERONLY callback frame and listings
# 60414-1039 - Changed manual dial preview and alt dial checkboxes to spans
#            - Added beta-level USERONLY callback functionality
#            - Added beta-level manual dialing with lead insertion functionality
# 60415-1534 - Fixed manual dial lead preview and fixed manuald dial override bug
# 60417-1108 - Added capability to do alt-number-dialing in auto-dial mode
#            - Changed several permissions to database-defined
# 60419-1529 - Prevent manual dial or callbacks when alt-dial lead not finished
# 60420-1647 - Fixed DiaLDiaLAltPhonE error, Call Agent Again DialControl error
# 60421-1229 - Check GET/POST vars lines with isset to not trigger PHP NOTICES
# 60424-1005 - Fixed Alt phone disabled bug for callbacks and manual dials
# 60426-1058 - Added vicidial_user setting for default blended check for CLOSER
# 60501-1008 - Added option to manual dial screen to manually lookup phone number
# 60503-1653 - Fixed agentonly_callback not-defined bug in scheduled callbacks screen
# 60504-1032 - Fixed manual dial display bug and transfer dispo alert bug
#            - Fixed recording filename display to not overrun 25 characters
# 60510-1051 - Added Wrapup timer and wrapup message on wrapup screen after dispo
# 60608-1453 - Added CLOSER campaign allowable in-groups limitations
# 60609-1123 - Added add-number-to-DNC-list function and manual dial check DNC
# 60619-1047 - Added variable filters to close security holes for login form
# 60804-1710 - fixed scheduled CALLBK for other languages build
#

require("dbconnect.php");

if (isset($_GET["DB"]))						    {$DB=$_GET["DB"];}
        elseif (isset($_POST["DB"]))            {$DB=$_POST["DB"];}
if (isset($_GET["phone_login"]))                {$phone_login=$_GET["phone_login"];}
        elseif (isset($_POST["phone_login"]))   {$phone_login=$_POST["phone_login"];}
if (isset($_GET["phone_pass"]))					{$phone_pass=$_GET["phone_pass"];}
        elseif (isset($_POST["phone_pass"]))    {$phone_pass=$_POST["phone_pass"];}
if (isset($_GET["VD_login"]))					{$VD_login=$_GET["VD_login"];}
        elseif (isset($_POST["VD_login"]))      {$VD_login=$_POST["VD_login"];}
if (isset($_GET["VD_pass"]))					{$VD_pass=$_GET["VD_pass"];}
        elseif (isset($_POST["VD_pass"]))       {$VD_pass=$_POST["VD_pass"];}
if (isset($_GET["VD_campaign"]))                {$VD_campaign=$_GET["VD_campaign"];}
        elseif (isset($_POST["VD_campaign"]))   {$VD_campaign=$_POST["VD_campaign"];}
if (isset($_GET["relogin"]))					{$relogin=$_GET["relogin"];}
        elseif (isset($_POST["relogin"]))       {$relogin=$_POST["relogin"];}
	if (!isset($phone_login)) 
		{
		if (isset($_GET["pl"]))                {$phone_login=$_GET["pl"];}
				elseif (isset($_POST["pl"]))   {$phone_login=$_POST["pl"];}
		}
	if (!isset($phone_pass))
		{
		if (isset($_GET["pp"]))                {$phone_pass=$_GET["pp"];}
				elseif (isset($_POST["pp"]))   {$phone_pass=$_POST["pp"];}
		}
	if (isset($VD_campaign))
		{
		$VD_campaign = strtoupper($VD_campaign);
		$VD_campaign = eregi_replace(" ",'',$VD_campaign);
		}

### security strip all non-alphanumeric characters out of the variables ###
	$DB=ereg_replace("[^0-9a-z]","",$DB);
	$phone_login=ereg_replace("[^0-9a-zA-Z]","",$phone_login);
	$phone_pass=ereg_replace("[^0-9a-zA-Z]","",$phone_pass);
	$VD_login=ereg_replace("[^0-9a-zA-Z]","",$VD_login);
	$VD_pass=ereg_replace("[^0-9a-zA-Z]","",$VD_pass);
	$VD_campaign=ereg_replace("[^0-9a-zA-Z]","",$VD_campaign);


$forever_stop=0;

$version = '1.1.86';
$build = '60804-1710';

if ($force_logout)
{
    echo "Ora siete non Loggati . Grazie\n";
    exit;
}

$StarTtimE = date("U");
$NOW_TIME = date("Y-m-d H:i:s");
$tsNOW_TIME = date("YmdHis");
$FILE_TIME = date("Ymd-His");
$CIDdate = date("ymdHis");
	$month_old = mktime(0, 0, 0, date("m"), date("d")-2,  date("Y"));
	$past_month_date = date("Y-m-d H:i:s",$month_old);

$random = (rand(1000000, 9999999) + 10000000);

$conf_silent_prefix		= '7';	# vicidial_conferences prefix to enter silently
$HKuser_level			= '5';	# minimum vicidial user_level for HotKeys
$campaign_login_list	= '1';	# show drop-down list of campaigns at login	
$manual_dial_preview	= '1';	# allow preview lead option when manual dial
$multi_line_comments	= '1';	# set to 1 to allow multi-line comment box
$user_login_first		= '0';	# set to 1 to have the vicidial_user login before the phone login
$view_scripts			= '1';	# set to 1 to show the SCRIPTS tab
$dispo_check_all_pause	= '0';	# set to 1 to allow for persistent pause after dispo
$agentcallsstatus		= '0';	# set to 1 to show agent status and call count
   $campagentstatctmax	= '0';	# Number of secondi for campaign call and agent stats

$TEST_all_statuses		= '0';	# TEST variable allows all statuses in dispo screen

# options now set in DB:
#$alt_phone_dialing		= '1';	# allow agents to call alt phone numbers
#$scheduled_callbacks	= '1';	# set to 1 to allow agent to choose scheduled callbacks
#   $agentonly_callbacks	= '1';	# set to 1 to allow agent to choose agent-only scheduled callbacks
#$agentcall_manual		= '1';	# set to 1 to allow agent to make manual calls during autodial session

$US='_';
$CL=':';
$AT='@';
$date = date("r");
$ip = getenv("REMOTE_ADDR");
$browser = getenv("HTTP_USER_AGENT");
$script_name = getenv("SCRIPT_NAME");
$server_name = getenv("SERVER_NAME");
$server_port = getenv("SERVER_PORT");
if (eregi("443",$server_port)) {$HTTPprotocol = 'https://';}
  else {$HTTPprotocol = 'http://';}
if (($server_port == '80') or ($server_port == '443') ) {$server_port='';}
else {$server_port = "$CL$server_port";}
$agcPAGE = "$HTTPprotocol$server_name$server_port$script_name";
$agcDIR = eregi_replace('vicidial.php','',$agcPAGE);

header ("Content-type: text/html; charset=utf-8");
header ("Cache-Control: no-cache, must-revalidate");  // HTTP/1.1
header ("Pragma: no-cache");                          // HTTP/1.0
echo "<html>\n";
echo "<head>\n";
echo "<!-- VERSIONE: $version     CONFIGURAZIONE: $build -->\n";

if ($campaign_login_list > 0)
{
$camp_form_code  = "<select size=1 name=VD_campaign>\n";
$camp_form_code .= "<option value=\"\"></option>\n";

$stmt="SELECT campaign_id from vicidial_campaigns where active='Y' order by campaign_id";
$rslt=mysql_query($stmt, $link);
$camps_to_print = mysql_num_rows($rslt);

$o=0;
while ($camps_to_print > $o) 
	{
	$rowx=mysql_fetch_row($rslt);
	if ($VD_campaign)
		{
		if (eregi("$VD_campaign",$rowx[0]))
			{$camp_form_code .= "<option value=\"$rowx[0]\" SELECTED>$rowx[0]</option>\n";}
		else
			{$camp_form_code .= "<option value=\"$rowx[0]\">$rowx[0]</option>\n";}
		}
	else
		{$camp_form_code .= "<option value=\"$rowx[0]\">$rowx[0]</option>\n";}
	$o++;
	}
$camp_form_code .= "</select>\n";
}
else
{
$camp_form_code = "<INPUT TYPE=TEXT NAME=VD_campaign SIZE=10 maxlength=20 VALUE=\"$VD_campaign\">\n";
}



if ($relogin == 'YES')
{
echo "<title>Web client di VICICHIAMA: Re-login attività</title>\n";
echo "</head>\n";
echo "<BODY BGCOLOR=WHITE MARGINHEIGHT=0 MARGINWIDTH=0>\n";
echo "<TABLE WIDTH=100%><TR><TD></TD>\n";
echo "<!-- ILPV -->\n";
echo "<TD WIDTH=100 ALIGN=RIGHT VALIGN=TOP  NOWRAP><a href=\"../agc_en/vicidial.php?relogin=YES&VD_login=$VD_login&VD_campaign=$VD_campaign&phone_login=$phone_login&phone_pass=$phone_pass&VD_pass=$VD_pass\">English <img src=\"../agc/images/en.gif\" BORDER=0 HEIGHT=14 WIDTH=20></a></TD>\n";echo "<TD WIDTH=100 ALIGN=RIGHT VALIGN=TOP  BGCOLOR=\"#CCFFCC\" NOWRAP><a href=\"../agc_it/vicidial.php?relogin=YES&VD_login=$VD_login&VD_campaign=$VD_campaign&phone_login=$phone_login&phone_pass=$phone_pass&VD_pass=$VD_pass\">Italiano <img src=\"../agc/images/it.gif\" BORDER=0 HEIGHT=14 WIDTH=20></a></TD>\n";echo "</TR></TABLE>\n";
echo "<FORM ACTION=\"$agcPAGE\" METHOD=POST>\n";
echo "<INPUT TYPE=HIDDEN NAME=DB VALUE=\"$DB\">\n";
echo "<BR><BR><BR><CENTER><TABLE WIDTH=360 CELLPADDING=0 CELLSPACING=0 BGCOLOR=\"#E0C2D6\"><TR BGCOLOR=WHITE>";
echo "<TD ALIGN=LEFT VALIGN=BOTTOM><IMG SRC=\"../agc/images/vdc_tab_vicidial.gif\" Border=0></TD>";
echo "<TD ALIGN=CENTER VALIGN=MIDDLE> Re-login attività </TD>";
echo "</TR>\n";
echo "<TR><TD ALIGN=LEFT COLSPAN=2><font size=1> &nbsp; </TD></TR>\n";
echo "<TR><TD ALIGN=RIGHT>Inizio attività Telefono: </TD>";
echo "<TD ALIGN=LEFT><INPUT TYPE=TEXT NAME=phone_login SIZE=10 maxlength=20 VALUE=\"$phone_login\"></TD></TR>\n";
echo "<TR><TD ALIGN=RIGHT>Parola d`accesso del Telefono:  </TD>";
echo "<TD ALIGN=LEFT><INPUT TYPE=PASSWORD NAME=phone_pass SIZE=10 maxlength=20 VALUE=\"$phone_pass\"></TD></TR>\n";
echo "<TR><TD ALIGN=RIGHT>Inizio attività dell`Utente:  </TD>";
echo "<TD ALIGN=LEFT><INPUT TYPE=TEXT NAME=VD_login SIZE=10 maxlength=20 VALUE=\"$VD_login\"></TD></TR>\n";
echo "<TR><TD ALIGN=RIGHT>Parola d`accesso Dell`Utente:  </TD>";
echo "<TD ALIGN=LEFT><INPUT TYPE=PASSWORD NAME=VD_pass SIZE=10 maxlength=20 VALUE=\"$VD_pass\"></TD></TR>\n";
echo "<TR><TD ALIGN=RIGHT>Campagna:  </TD>";
echo "<TD ALIGN=LEFT>$camp_form_code</TD></TR>\n";
echo "<TR><TD ALIGN=CENTER COLSPAN=2><INPUT TYPE=Submit NAME=INVIA VALUE=INVIA></TD></TR>\n";
echo "<TR><TD ALIGN=LEFT COLSPAN=2><font size=1><BR>VERSIONE: $version &nbsp; &nbsp; &nbsp; CONFIGURAZIONE: $build</TD></TR>\n";
echo "</TABLE>\n";
echo "</FORM>\n\n";
echo "</body>\n\n";
echo "</html>\n\n";
exit;
}

if ($user_login_first == 1)
{
	if ( (strlen($VD_login)<1) or (strlen($VD_pass)<1) or (strlen($VD_campaign)<1) )
	{
	echo "<title>Web client di VICICHIAMA: Inizio attività della Campagna</title>\n";
	echo "</head>\n";
	echo "<BODY BGCOLOR=WHITE MARGINHEIGHT=0 MARGINWIDTH=0>\n";
	echo "<TABLE WIDTH=100%><TR><TD></TD>\n";
	echo "<!-- ILPV -->\n";
echo "<TD WIDTH=100 ALIGN=RIGHT VALIGN=TOP  NOWRAP><a href=\"../agc_en/vicidial.php?relogin=YES&VD_login=$VD_login&VD_campaign=$VD_campaign&phone_login=$phone_login&phone_pass=$phone_pass&VD_pass=$VD_pass\">English <img src=\"../agc/images/en.gif\" BORDER=0 HEIGHT=14 WIDTH=20></a></TD>\n";echo "<TD WIDTH=100 ALIGN=RIGHT VALIGN=TOP  BGCOLOR=\"#CCFFCC\" NOWRAP><a href=\"../agc_it/vicidial.php?relogin=YES&VD_login=$VD_login&VD_campaign=$VD_campaign&phone_login=$phone_login&phone_pass=$phone_pass&VD_pass=$VD_pass\">Italiano <img src=\"../agc/images/it.gif\" BORDER=0 HEIGHT=14 WIDTH=20></a></TD>\n";	echo "</TR></TABLE>\n";
	echo "<FORM ACTION=\"$agcPAGE\" METHOD=POST>\n";
	echo "<INPUT TYPE=HIDDEN NAME=DB VALUE=\"$DB\">\n";
	#echo "<INPUT TYPE=HIDDEN NAME=phone_login VALUE=\"$phone_login\">\n";
	#echo "<INPUT TYPE=HIDDEN NAME=phone_pass VALUE=\"$phone_pass\">\n";
	echo "<CENTER><BR><B>Inizio attività dell`Utente</B><BR><BR>";
	echo "<TABLE WIDTH=360 CELLPADDING=0 CELLSPACING=0 BGCOLOR=\"#E0C2D6\"><TR BGCOLOR=WHITE>";
	echo "<TD ALIGN=LEFT VALIGN=BOTTOM><IMG SRC=\"../agc/images/vdc_tab_vicidial.gif\" Border=0></TD>";
	echo "<TD ALIGN=CENTER VALIGN=MIDDLE> Inizio attività della Campagna </TD>";
	echo "</TR>\n";
	echo "<TR><TD ALIGN=LEFT COLSPAN=2><font size=1> &nbsp; </TD></TR>\n";
	echo "<TR><TD ALIGN=RIGHT>Inizio attività dell`Utente:  </TD>";
	echo "<TD ALIGN=LEFT><INPUT TYPE=TEXT NAME=VD_login SIZE=10 maxlength=20 VALUE=\"$VD_login\"></TD></TR>\n";
	echo "<TR><TD ALIGN=RIGHT>Parola d`accesso Dell`Utente:  </TD>";
	echo "<TD ALIGN=LEFT><INPUT TYPE=PASSWORD NAME=VD_pass SIZE=10 maxlength=20 VALUE=\"$VD_pass\"></TD></TR>\n";
	echo "<TR><TD ALIGN=RIGHT>Campagna:  </TD>";
	echo "<TD ALIGN=LEFT>$camp_form_code</TD></TR>\n";
	echo "<TR><TD ALIGN=CENTER COLSPAN=2><INPUT TYPE=Submit NAME=INVIA VALUE=INVIA></TD></TR>\n";
	echo "<TR><TD ALIGN=LEFT COLSPAN=2><font size=1><BR>VERSIONE: $version &nbsp; &nbsp; &nbsp; CONFIGURAZIONE: $build</TD></TR>\n";
	echo "</TABLE>\n";
	echo "</FORM>\n\n";
	echo "</body>\n\n";
	echo "</html>\n\n";
	exit;
	}
	else
	{
		if ( (strlen($phone_login)<2) or (strlen($phone_pass)<2) )
		{
		$stmt="SELECT phone_login,phone_pass from vicidial_users where user='$VD_login' and pass='$VD_pass' and user_level > 0;";
		if ($DB) {echo "|$stmt|\n";}
		$rslt=mysql_query($stmt, $link);
		$row=mysql_fetch_row($rslt);
		$phone_login=$row[0];
		$phone_pass=$row[1];

		echo "<title>Web client di VICICHIAMA: Inizio attività</title>\n";
		echo "</head>\n";
		echo "<BODY BGCOLOR=WHITE MARGINHEIGHT=0 MARGINWIDTH=0>\n";
		echo "<TABLE WIDTH=100%><TR><TD></TD>\n";
		echo "<!-- ILPV -->\n";
echo "<TD WIDTH=100 ALIGN=RIGHT VALIGN=TOP  NOWRAP><a href=\"../agc_en/vicidial.php?relogin=YES&VD_login=$VD_login&VD_campaign=$VD_campaign&phone_login=$phone_login&phone_pass=$phone_pass&VD_pass=$VD_pass\">English <img src=\"../agc/images/en.gif\" BORDER=0 HEIGHT=14 WIDTH=20></a></TD>\n";echo "<TD WIDTH=100 ALIGN=RIGHT VALIGN=TOP  BGCOLOR=\"#CCFFCC\" NOWRAP><a href=\"../agc_it/vicidial.php?relogin=YES&VD_login=$VD_login&VD_campaign=$VD_campaign&phone_login=$phone_login&phone_pass=$phone_pass&VD_pass=$VD_pass\">Italiano <img src=\"../agc/images/it.gif\" BORDER=0 HEIGHT=14 WIDTH=20></a></TD>\n";		echo "</TR></TABLE>\n";
		echo "<FORM ACTION=\"$agcPAGE\" METHOD=POST>\n";
		echo "<INPUT TYPE=HIDDEN NAME=DB VALUE=\"$DB\">\n";
		echo "<BR><BR><BR><CENTER><TABLE WIDTH=360 CELLPADDING=0 CELLSPACING=0 BGCOLOR=\"#E0C2D6\"><TR BGCOLOR=WHITE>";
		echo "<TD ALIGN=LEFT VALIGN=BOTTOM><IMG SRC=\"../agc/images/vdc_tab_vicidial.gif\" Border=0></TD>";
		echo "<TD ALIGN=CENTER VALIGN=MIDDLE> Inizio attività </TD>";
		echo "</TR>\n";
		echo "<TR><TD ALIGN=LEFT COLSPAN=2><font size=1> &nbsp; </TD></TR>\n";
		echo "<TR><TD ALIGN=RIGHT>Inizio attività Telefono: </TD>";
		echo "<TD ALIGN=LEFT><INPUT TYPE=TEXT NAME=phone_login SIZE=10 maxlength=20 VALUE=\"$phone_login\"></TD></TR>\n";
		echo "<TR><TD ALIGN=RIGHT>Parola d`accesso del Telefono:  </TD>";
		echo "<TD ALIGN=LEFT><INPUT TYPE=PASSWORD NAME=phone_pass SIZE=10 maxlength=20 VALUE=\"$phone_pass\"></TD></TR>\n";
		echo "<TR><TD ALIGN=RIGHT>Inizio attività dell`Utente:  </TD>";
		echo "<TD ALIGN=LEFT><INPUT TYPE=TEXT NAME=VD_login SIZE=10 maxlength=20 VALUE=\"$VD_login\"></TD></TR>\n";
		echo "<TR><TD ALIGN=RIGHT>Parola d`accesso Dell`Utente:  </TD>";
		echo "<TD ALIGN=LEFT><INPUT TYPE=PASSWORD NAME=VD_pass SIZE=10 maxlength=20 VALUE=\"$VD_pass\"></TD></TR>\n";
		echo "<TR><TD ALIGN=RIGHT>Campagna:  </TD>";
		echo "<TD ALIGN=LEFT>$camp_form_code</TD></TR>\n";
		echo "<TR><TD ALIGN=CENTER COLSPAN=2><INPUT TYPE=Submit NAME=INVIA VALUE=INVIA></TD></TR>\n";
		echo "<TR><TD ALIGN=LEFT COLSPAN=2><font size=1><BR>VERSIONE: $version &nbsp; &nbsp; &nbsp; CONFIGURAZIONE: $build</TD></TR>\n";
		echo "</TABLE>\n";
		echo "</FORM>\n\n";
		echo "</body>\n\n";
		echo "</html>\n\n";
		exit;

		}
	}
}

if ( (strlen($phone_login)<2) or (strlen($phone_pass)<2) )
{
echo "<title>Web client di VICICHIAMA:  Inizio attività Telefono</title>\n";
echo "</head>\n";
echo "<BODY BGCOLOR=WHITE MARGINHEIGHT=0 MARGINWIDTH=0>\n";
echo "<TABLE WIDTH=100%><TR><TD></TD>\n";
echo "<!-- ILPV -->\n";
echo "<TD WIDTH=100 ALIGN=RIGHT VALIGN=TOP  NOWRAP><a href=\"../agc_en/vicidial.php?relogin=YES&VD_login=$VD_login&VD_campaign=$VD_campaign&phone_login=$phone_login&phone_pass=$phone_pass&VD_pass=$VD_pass\">English <img src=\"../agc/images/en.gif\" BORDER=0 HEIGHT=14 WIDTH=20></a></TD>\n";echo "<TD WIDTH=100 ALIGN=RIGHT VALIGN=TOP  BGCOLOR=\"#CCFFCC\" NOWRAP><a href=\"../agc_it/vicidial.php?relogin=YES&VD_login=$VD_login&VD_campaign=$VD_campaign&phone_login=$phone_login&phone_pass=$phone_pass&VD_pass=$VD_pass\">Italiano <img src=\"../agc/images/it.gif\" BORDER=0 HEIGHT=14 WIDTH=20></a></TD>\n";echo "</TR></TABLE>\n";
echo "<FORM ACTION=\"$agcPAGE\" METHOD=POST>\n";
echo "<INPUT TYPE=HIDDEN NAME=DB VALUE=\"$DB\">\n";
echo "<BR><BR><BR><CENTER><TABLE WIDTH=360 CELLPADDING=0 CELLSPACING=0 BGCOLOR=\"#E0C2D6\"><TR BGCOLOR=WHITE>";
echo "<TD ALIGN=LEFT VALIGN=BOTTOM><IMG SRC=\"../agc/images/vdc_tab_vicidial.gif\" Border=0></TD>";
echo "<TD ALIGN=CENTER VALIGN=MIDDLE> Inizio attività Telefono </TD>";
echo "</TR>\n";
echo "<TR><TD ALIGN=LEFT COLSPAN=2><font size=1> &nbsp; </TD></TR>\n";
echo "<TR><TD ALIGN=RIGHT>Inizio attività Telefono: </TD>";
echo "<TD ALIGN=LEFT><INPUT TYPE=TEXT NAME=phone_login SIZE=10 maxlength=20 VALUE=\"\"></TD></TR>\n";
echo "<TR><TD ALIGN=RIGHT>Parola d`accesso del Telefono:  </TD>";
echo "<TD ALIGN=LEFT><INPUT TYPE=PASSWORD NAME=phone_pass SIZE=10 maxlength=20 VALUE=\"\"></TD></TR>\n";
echo "<TR><TD ALIGN=CENTER COLSPAN=2><INPUT TYPE=Submit NAME=INVIA VALUE=INVIA></TD></TR>\n";
echo "<TR><TD ALIGN=LEFT COLSPAN=2><font size=1><BR>VERSIONE: $version &nbsp; &nbsp; &nbsp; CONFIGURAZIONE: $build</TD></TR>\n";
echo "</TABLE>\n";
echo "</FORM>\n\n";
echo "</body>\n\n";
echo "</html>\n\n";
exit;
}
else
{
$fp = fopen ("./vicidial_auth_entries.txt", "a");
$VDloginDISPLAY=0;

	if ( (strlen($VD_login)<2) or (strlen($VD_pass)<2) or (strlen($VD_campaign)<2) )
	{
	$VDloginDISPLAY=1;
	}
	else
	{
	$stmt="SELECT count(*) from vicidial_users where user='$VD_login' and pass='$VD_pass' and user_level > 0;";
	if ($DB) {echo "|$stmt|\n";}
	$rslt=mysql_query($stmt, $link);
	$row=mysql_fetch_row($rslt);
	$auth=$row[0];

	if($auth>0)
		{
		$login=strtoupper($VD_login);
		$password=strtoupper($VD_pass);
		##### grab the full name of the agent
		$stmt="SELECT full_name,user_level,hotkeys_active,agent_choose_ingroups,scheduled_callbacks,agentonly_callbacks,agentcall_manual,vicidial_recording,vicidial_transfers,closer_default_blended from vicidial_users where user='$VD_login' and pass='$VD_pass'";
		$rslt=mysql_query($stmt, $link);
		$row=mysql_fetch_row($rslt);
		$LOGfullname=$row[0];
		$user_level=$row[1];
		$VU_hotkeys_active=$row[2];
		$VU_agent_choose_ingroups=$row[3];
		$VU_scheduled_callbacks=$row[4];
		$agentonly_callbacks=$row[5];
		$agentcall_manual=$row[6];
		$VU_vicidial_recording=$row[7];
		$VU_vicidial_transfers=$row[8];
		$VU_closer_default_blended=$row[9];
		fwrite ($fp, "vdweb|GOOD|$date|$VD_login|$VD_pass|$ip|$browser|$LOGfullname|\n");
		fclose($fp);

		$user_abb = "$VD_login$VD_login$VD_login$VD_login";
		while ( (strlen($user_abb) > 4) and ($forever_stop < 200) )
			{$user_abb = eregi_replace("^.","",$user_abb);   $forever_stop++;}

		##### check to see that the campaign is active
		$stmt="SELECT count(*) FROM vicidial_campaigns where campaign_id='$VD_campaign' and active='Y';";
		if ($DB) {echo "|$stmt|\n";}
		$rslt=mysql_query($stmt, $link);
		$row=mysql_fetch_row($rslt);
		$CAMPactive=$row[0];
		if($CAMPactive>0)
			{
			if ($TEST_all_statuses > 0) {$selectableSQL = '';}
			else {$selectableSQL = "selectable='Y' and";}
			$VARstatuses='';
			$VARstatusnames='';
			##### grab the statuses that can be used for dispositioning by an agent
			$stmt="SELECT status,status_name FROM vicidial_statuses WHERE $selectableSQL status != 'NEW' order by status limit 50;";
			$rslt=mysql_query($stmt, $link);
			if ($DB) {echo "$stmt\n";}
			$VD_statuses_ct = mysql_num_rows($rslt);
			$i=0;
			while ($i < $VD_statuses_ct)
				{
				$row=mysql_fetch_row($rslt);
				$statuses[$i] =$row[0];
				$status_names[$i] =$row[1];
				$VARstatuses = "$VARstatuses'$statuses[$i]',";
				$VARstatusnames = "$VARstatusnames'$status_names[$i]',";
				$i++;
				}

			##### grab the campaign-specific statuses that can be used for dispositioning by an agent
			$stmt="SELECT status,status_name FROM vicidial_campaign_statuses WHERE $selectableSQL status != 'NEW' and campaign_id='$VD_campaign' order by status limit 50;";
			$rslt=mysql_query($stmt, $link);
			if ($DB) {echo "$stmt\n";}
			$VD_statuses_camp = mysql_num_rows($rslt);
			$j=0;
			while ($j < $VD_statuses_camp)
				{
				$row=mysql_fetch_row($rslt);
				$statuses[$i] =$row[0];
				$status_names[$i] =$row[1];
				$VARstatuses = "$VARstatuses'$statuses[$i]',";
				$VARstatusnames = "$VARstatusnames'$status_names[$i]',";
				$i++;
				$j++;
				}
			$VD_statuses_ct = ($VD_statuses_ct+$VD_statuses_camp);
			$VARstatuses = substr("$VARstatuses", 0, -1); 
			$VARstatusnames = substr("$VARstatusnames", 0, -1); 

			##### grab the campaign-specific HotKey statuses that can be used for dispositioning by an agent
			$stmt="SELECT hotkey,status,status_name FROM vicidial_campaign_hotkeys WHERE selectable='Y' and status != 'NEW' and campaign_id='$VD_campaign' order by hotkey limit 9;";
			$rslt=mysql_query($stmt, $link);
			if ($DB) {echo "$stmt\n";}
			$HK_statuses_camp = mysql_num_rows($rslt);
			$w=0;
			$HKboxA='';
			$HKboxB='';
			$HKboxC='';
			while ($w < $HK_statuses_camp)
				{
				$row=mysql_fetch_row($rslt);
				$HKhotkey[$w] =$row[0];
				$HKstatus[$w] =$row[1];
				$HKstatus_name[$w] =$row[2];
				$HKhotkeys = "$HKhotkeys'$HKhotkey[$w]',";
				$HKstatuses = "$HKstatuses'$HKstatus[$w]',";
				$HKstatusnames = "$HKstatusnames'$HKstatus_name[$w]',";
				if ($w < 3)
					{$HKboxA = "$HKboxA <font class=\"skb_text\">$HKhotkey[$w]</font> - $HKstatus[$w] - $HKstatus_name[$w]<BR>";}
				if ( ($w >= 3) and ($w < 6) )
					{$HKboxB = "$HKboxB <font class=\"skb_text\">$HKhotkey[$w]</font> - $HKstatus[$w] - $HKstatus_name[$w]<BR>";}
				if ($w >= 6)
					{$HKboxC = "$HKboxC <font class=\"skb_text\">$HKhotkey[$w]</font> - $HKstatus[$w] - $HKstatus_name[$w]<BR>";}
				$w++;
				}
			$HKhotkeys = substr("$HKhotkeys", 0, -1); 
			$HKstatuses = substr("$HKstatuses", 0, -1); 
			$HKstatusnames = substr("$HKstatusnames", 0, -1); 

			##### grab the statuses to be dialed for your campaign as well as other campaign settings
			$stmt="SELECT dial_status_a,dial_status_b,dial_status_c,dial_status_d,dial_status_e,park_ext,park_file_name,web_form_address,allow_closers,auto_dial_level,dial_timeout,dial_prefix,campaign_cid,campaign_vdad_exten,campaign_rec_exten,campaign_recording,campaign_rec_filename,campaign_script,get_call_launch,am_message_exten,xferconf_a_dtmf,xferconf_a_number,xferconf_b_dtmf,xferconf_b_number,alt_number_dialing,scheduled_callbacks,wrapup_seconds,wrapup_message,closer_campaigns,use_internal_dnc FROM vicidial_campaigns where campaign_id = '$VD_campaign';";
			$rslt=mysql_query($stmt, $link);
			if ($DB) {echo "$stmt\n";}
			$row=mysql_fetch_row($rslt);
			   $status_A = $row[0];
			   $status_B = $row[1];
			   $status_C = $row[2];
			   $status_D = $row[3];
			   $status_E = $row[4];
			   $park_ext = $row[5];
			   $park_file_name = $row[6];
			   $web_form_address = $row[7];
			   $allow_closers = $row[8];
			   $auto_dial_level = $row[9];
			   $dial_timeout = $row[10];
			   $dial_prefix = $row[11];
			   $campaign_cid = $row[12];
			   $campaign_vdad_exten = $row[13];
			   $campaign_rec_exten = $row[14];
			   $campaign_recording = $row[15];
			   $campaign_rec_filename = $row[16];
			   $campaign_script = $row[17];
			   $get_call_launch = $row[18];
			   $campaign_am_message_exten = $row[19];
			   $xferconf_a_dtmf = $row[20];
			   $xferconf_a_number = $row[21];
			   $xferconf_b_dtmf = $row[22];
			   $xferconf_b_number = $row[23];
			   $alt_number_dialing=$row[24];
			   $VC_scheduled_callbacks=$row[25];
			   $wrapup_secondi=$row[26];
			   $wrapup_message=$row[27];
			   $closer_campaigns=$row[28];
			   $use_internal_dnc=$row[29];

			if ( ($VC_scheduled_callbacks=='Y') and ($VU_scheduled_callbacks=='1') )
				{$scheduled_callbacks='1';}
			if ($VU_vicidial_recording=='0')
				{$campaign_recording='NEVER';}
			if ($alt_number_dialing=='Y')
				{$alt_phone_dialing='1';}
			else
				{$alt_phone_dialing='0';}
			$closer_campaigns = preg_replace("/^ | -$/","",$closer_campaigns);
			$closer_campaigns = preg_replace("/ /","','",$closer_campaigns);
			$closer_campaigns = "'$closer_campaigns'";

			##### grab the inbound groups to choose from if campaign contains CLOSER
			$VARingroups="''";
			if (eregi("CLOSER", $VD_campaign))
				{
				$VARingroups='';
				$stmt="select group_id from vicidial_inbound_groups where active = 'Y' and group_id IN($closer_campaigns) order by group_id limit 20;";
				$rslt=mysql_query($stmt, $link);
				if ($DB) {echo "$stmt\n";}
				$closer_ct = mysql_num_rows($rslt);
				$INgrpCT=0;
				while ($INgrpCT < $closer_ct)
					{
					$row=mysql_fetch_row($rslt);
					$closer_groups[$INgrpCT] =$row[0];
					$VARingroups = "$VARingroups'$closer_groups[$INgrpCT]',";
					$INgrpCT++;
					}
				$VARingroups = substr("$VARingroups", 0, -1); 
				}

			##### grab the number of leads in the hopper for this campaign
			$stmt="SELECT count(*) FROM vicidial_hopper where campaign_id = '$VD_campaign' and status='READY';";
			$rslt=mysql_query($stmt, $link);
			if ($DB) {echo "$stmt\n";}
			$row=mysql_fetch_row($rslt);
			   $campaign_leads_to_call = $row[0];
			   print "<!-- $campaign_leads_to_call - Contatti che rimangono nella Lista  -->\n";

			}
		else
			{
			$VDloginDISPLAY=1;
			$VDdisplayMESSAGE = "La campagna non attiva, prova di nuovo<BR>";
			}
		}
	else
		{
		fwrite ($fp, "vdweb|FAIL|$date|$VD_login|$VD_pass|$ip|$browser|\n");
		fclose($fp);
		$VDloginDISPLAY=1;
		$VDdisplayMESSAGE = "Inizio attività errato, prova di nuovo<BR>";
		}
	}
	if ($VDloginDISPLAY)
	{
	echo "<title>Web client di VICICHIAMA: Inizio attività della Campagna</title>\n";
	echo "</head>\n";
	echo "<BODY BGCOLOR=WHITE MARGINHEIGHT=0 MARGINWIDTH=0>\n";
	echo "<TABLE WIDTH=100%><TR><TD></TD>\n";
	echo "<!-- ILPV -->\n";
echo "<TD WIDTH=100 ALIGN=RIGHT VALIGN=TOP  NOWRAP><a href=\"../agc_en/vicidial.php?relogin=YES&VD_login=$VD_login&VD_campaign=$VD_campaign&phone_login=$phone_login&phone_pass=$phone_pass&VD_pass=$VD_pass\">English <img src=\"../agc/images/en.gif\" BORDER=0 HEIGHT=14 WIDTH=20></a></TD>\n";echo "<TD WIDTH=100 ALIGN=RIGHT VALIGN=TOP  BGCOLOR=\"#CCFFCC\" NOWRAP><a href=\"../agc_it/vicidial.php?relogin=YES&VD_login=$VD_login&VD_campaign=$VD_campaign&phone_login=$phone_login&phone_pass=$phone_pass&VD_pass=$VD_pass\">Italiano <img src=\"../agc/images/it.gif\" BORDER=0 HEIGHT=14 WIDTH=20></a></TD>\n";	echo "</TR></TABLE>\n";
	echo "<FORM ACTION=\"$agcPAGE\" METHOD=POST>\n";
	echo "<INPUT TYPE=HIDDEN NAME=DB VALUE=\"$DB\">\n";
	echo "<INPUT TYPE=HIDDEN NAME=phone_login VALUE=\"$phone_login\">\n";
	echo "<INPUT TYPE=HIDDEN NAME=phone_pass VALUE=\"$phone_pass\">\n";
	echo "<CENTER><BR><B>$VDdisplayMESSAGE</B><BR><BR>";
	echo "<TABLE WIDTH=360 CELLPADDING=0 CELLSPACING=0 BGCOLOR=\"#E0C2D6\"><TR BGCOLOR=WHITE>";
	echo "<TD ALIGN=LEFT VALIGN=BOTTOM><IMG SRC=\"../agc/images/vdc_tab_vicidial.gif\" Border=0></TD>";
	echo "<TD ALIGN=CENTER VALIGN=MIDDLE> Inizio attività della Campagna </TD>";
	echo "</TR>\n";
	echo "<TR><TD ALIGN=LEFT COLSPAN=2><font size=1> &nbsp; </TD></TR>\n";
	echo "<TR><TD ALIGN=RIGHT>Inizio attività dell`Utente:  </TD>";
	echo "<TD ALIGN=LEFT><INPUT TYPE=TEXT NAME=VD_login SIZE=10 maxlength=20 VALUE=\"$VD_login\"></TD></TR>\n";
	echo "<TR><TD ALIGN=RIGHT>Parola d`accesso Dell`Utente:  </TD>";
	echo "<TD ALIGN=LEFT><INPUT TYPE=PASSWORD NAME=VD_pass SIZE=10 maxlength=20 VALUE=\"$VD_pass\"></TD></TR>\n";
	echo "<TR><TD ALIGN=RIGHT>Campagna:  </TD>";
	echo "<TD ALIGN=LEFT>$camp_form_code</TD></TR>\n";
	echo "<TR><TD ALIGN=CENTER COLSPAN=2><INPUT TYPE=Submit NAME=INVIA VALUE=INVIA></TD></TR>\n";
	echo "<TR><TD ALIGN=LEFT COLSPAN=2><font size=1><BR>VERSIONE: $version &nbsp; &nbsp; &nbsp; CONFIGURAZIONE: $build</TD></TR>\n";
	echo "</TABLE>\n";
	echo "</FORM>\n\n";
	echo "</body>\n\n";
	echo "</html>\n\n";
	exit;
	}

$authphone=0;
$stmt="SELECT count(*) from phones where login='$phone_login' and pass='$phone_pass' and active = 'Y';";
if ($DB) {echo "|$stmt|\n";}
$rslt=mysql_query($stmt, $link);
$row=mysql_fetch_row($rslt);
$authphone=$row[0];
if (!$authphone)
	{
	echo "<title>Web client di VICICHIAMA: Inizio attività Telefono Error</title>\n";
	echo "</head>\n";
	echo "<BODY BGCOLOR=WHITE MARGINHEIGHT=0 MARGINWIDTH=0>\n";
	echo "<TABLE WIDTH=100%><TR><TD></TD>\n";
	echo "<!-- ILPV -->\n";
echo "<TD WIDTH=100 ALIGN=RIGHT VALIGN=TOP  NOWRAP><a href=\"../agc_en/vicidial.php?relogin=YES&VD_login=$VD_login&VD_campaign=$VD_campaign&phone_login=$phone_login&phone_pass=$phone_pass&VD_pass=$VD_pass\">English <img src=\"../agc/images/en.gif\" BORDER=0 HEIGHT=14 WIDTH=20></a></TD>\n";echo "<TD WIDTH=100 ALIGN=RIGHT VALIGN=TOP  BGCOLOR=\"#CCFFCC\" NOWRAP><a href=\"../agc_it/vicidial.php?relogin=YES&VD_login=$VD_login&VD_campaign=$VD_campaign&phone_login=$phone_login&phone_pass=$phone_pass&VD_pass=$VD_pass\">Italiano <img src=\"../agc/images/it.gif\" BORDER=0 HEIGHT=14 WIDTH=20></a></TD>\n";	echo "</TR></TABLE>\n";
	echo "<FORM ACTION=\"$agcPAGE\" METHOD=POST>\n";
	echo "<INPUT TYPE=HIDDEN NAME=DB VALUE=\"$DB\">\n";
	echo "<INPUT TYPE=HIDDEN NAME=VD_login VALUE=\"$VD_login\">\n";
	echo "<INPUT TYPE=HIDDEN NAME=VD_pass VALUE=\"$VD_pass\">\n";
	echo "<INPUT TYPE=HIDDEN NAME=VD_campaign VALUE=\"$VD_campaign\">\n";
	echo "<BR><BR><BR><CENTER><TABLE WIDTH=360 CELLPADDING=0 CELLSPACING=0 BGCOLOR=\"#E0C2D6\"><TR BGCOLOR=WHITE>";
	echo "<TD ALIGN=LEFT VALIGN=BOTTOM><IMG SRC=\"../agc/images/vdc_tab_vicidial.gif\" Border=0></TD>";
	echo "<TD ALIGN=CENTER VALIGN=MIDDLE> Inizio attività Error</TD>";
	echo "</TR>\n";
	echo "<TR><TD ALIGN=CENTER COLSPAN=2><font size=1> &nbsp; <BR><FONT SIZE=3>Spiacente, la vostra password e login non sono attivi in questo sistema, riprova di nuovo: <BR> &nbsp;</TD></TR>\n";
	echo "<TR><TD ALIGN=RIGHT>Inizio attività Telefono: </TD>";
	echo "<TD ALIGN=LEFT><INPUT TYPE=TEXT NAME=phone_login SIZE=10 maxlength=20 VALUE=\"$phone_login\"></TD></TR>\n";
	echo "<TR><TD ALIGN=RIGHT>Parola d`accesso del Telefono:  </TD>";
	echo "<TD ALIGN=LEFT><INPUT TYPE=PASSWORD NAME=phone_pass SIZE=10 maxlength=20 VALUE=\"$phone_pass\"></TD></TR>\n";
	echo "<TR><TD ALIGN=CENTER COLSPAN=2><INPUT TYPE=Submit NAME=INVIA VALUE=INVIA></TD></TR>\n";
	echo "<TR><TD ALIGN=LEFT COLSPAN=2><font size=1><BR>VERSIONE: $version &nbsp; &nbsp; &nbsp; CONFIGURAZIONE: $build</TD></TR>\n";
	echo "</TABLE>\n";
	echo "</FORM>\n\n";
	echo "</body>\n\n";
	echo "</html>\n\n";
	exit;
	}
else
	{
	echo "<title>Web client di VICICHIAMA</title>\n";
	$stmt="SELECT * from phones where login='$phone_login' and pass='$phone_pass' and active = 'Y';";
	if ($DB) {echo "|$stmt|\n";}
	$rslt=mysql_query($stmt, $link);
	$row=mysql_fetch_row($rslt);
	$extension=$row[0];
	$dialplan_number=$row[1];
	$voicemail_id=$row[2];
	$phone_ip=$row[3];
	$computer_ip=$row[4];
	$server_ip=$row[5];
	$login=$row[6];
	$pass=$row[7];
	$status=$row[8];
	$active=$row[9];
	$phone_type=$row[10];
	$fullname=$row[11];
	$company=$row[12];
	$picture=$row[13];
	$messages=$row[14];
	$old_messages=$row[15];
	$protocol=$row[16];
	$local_gmt=$row[17];
	$ASTmgrUSERNAME=$row[18];
	$ASTmgrSECRET=$row[19];
	$login_user=$row[20];
	$login_pass=$row[21];
	$login_campaign=$row[22];
	$park_on_extension=$row[23];
	$conf_on_extension=$row[24];
	$VICIDiaL_park_on_extension=$row[25];
	$VICIDiaL_park_on_filename=$row[26];
	$monitor_prefix=$row[27];
	$recording_exten=$row[28];
	$voicemail_exten=$row[29];
	$voicemail_dump_exten=$row[30];
	$ext_context=$row[31];
	$dtmf_send_extension=$row[32];
	$call_out_number_group=$row[33];
	$client_browser=$row[34];
	$install_directory=$row[35];
	$local_web_callerID_URL=$row[36];
	$VICIDiaL_web_URL=$row[37];
	$AGI_call_logging_enabled=$row[38];
	$user_switching_enabled=$row[39];
	$conferencing_enabled=$row[40];
	$admin_hangup_enabled=$row[41];
	$admin_hijack_enabled=$row[42];
	$admin_monitor_enabled=$row[43];
	$call_parking_enabled=$row[44];
	$updater_check_enabled=$row[45];
	$AFLogging_enabled=$row[46];
	$QUEUE_ACTION_enabled=$row[47];
	$CallerID_popup_enabled=$row[48];
	$voicemail_button_enabled=$row[49];
	$enable_fast_refresh=$row[50];
	$fast_refresh_rate=$row[51];
	$enable_persistant_mysql=$row[52];
	$auto_dial_next_number=$row[53];
	$VDstop_rec_after_each_call=$row[54];
	$DBX_server=$row[55];
	$DBX_database=$row[56];
	$DBX_user=$row[57];
	$DBX_pass=$row[58];
	$DBX_port=$row[59];

	if ($protocol == 'EXTERNAL')
		{
		$protocol = 'Local';
		$extension = "$dialplan_number$AT$ext_context";
		}
	$SIP_user = "$protocol/$extension";

	$stmt="SELECT asterisk_version from servers where server_ip='$server_ip';";
	if ($DB) {echo "|$stmt|\n";}
	$rslt=mysql_query($stmt, $link);
	$row=mysql_fetch_row($rslt);
	$asterisk_version=$row[0];

	# If a park extension is not set, use the default one
	if ( (strlen($park_ext)>0) && (strlen($park_file_name)>0) )
		{
		$VICIDiaL_park_on_extension = "$park_ext";
		$VICIDiaL_park_on_filename = "$park_file_name";
		print "<!-- PARCHEGGIO CLIENTE DELLA CAMPAGNA:  |$VICIDiaL_park_on_extension|$VICIDiaL_park_on_filename| -->\n";
		}
		print "<!-- PARCHEGGIO PREDEFINITO DELLA CAMPAGNA: |$VICIDiaL_park_on_extension|$VICIDiaL_park_on_filename| -->\n";

	# If a web form address is not set, use the default one
	if (strlen($web_form_address)>0)
		{
		$VICIDiaL_web_form_address = "$web_form_address";
		print "<!-- INTERFACCIA WEB DEI CLIENTI PER LA CAMPAGNA :   |$VICIDiaL_web_form_address| -->\n";
		}
	else
		{
		$VICIDiaL_web_form_address = "$VICIDiaL_web_URL";
		print "<!-- INTERFACCIA WEB DELLA CAMPAGNA:  |$VICIDiaL_web_form_address| -->\n";
		$VICIDiaL_web_form_address_enc = rawurlencode($VICIDiaL_web_form_address);

		}
	$VICIDiaL_web_form_address_enc = rawurlencode($VICIDiaL_web_form_address);

	# If closers are allowed su this campaign
	if ($allow_closers=="Y")
		{
		$VICIDiaL_allow_closers = 1;
		print "<!-- LA CAMPAGNA PERMETTE FUORI LISTA:    |$VICIDiaL_allow_closers| -->\n";
		}
	else
		{
		$VICIDiaL_allow_closers = 0;
		print "<!-- LA CAMPAGNA NON PERMETTE FUORI LISTA: |$VICIDiaL_allow_closers| -->\n";
		}


	$session_ext = eregi_replace("[^a-z0-9]", "", $extension);
	if (strlen($session_ext) > 10) {$session_ext = substr($session_ext, 0, 10);}
	$session_rand = (rand(1,9999999) + 10000000);
	$session_name = "$StarTtimE$US$session_ext$session_rand";

	$stmt="DELETE from web_client_sessions where start_time < '$past_month_date' and extension='$extension' and server_ip = '$server_ip' and program = 'vicidial';";
	if ($DB) {echo "|$stmt|\n";}
	$rslt=mysql_query($stmt, $link);

	$stmt="INSERT INTO web_client_sessions values('$extension','$server_ip','vicidial','$NOW_TIME','$session_name');";
	if ($DB) {echo "|$stmt|\n";}
	$rslt=mysql_query($stmt, $link);

	if ( (eregi("CLOSER", $VD_campaign)) || ($campaign_leads_to_call > 0) )
		{
		### insert an entry into the user log for the login event
		$stmt = "INSERT INTO vicidial_user_log values('','$VD_login','LOGIN','$VD_campaign','$NOW_TIME','$StarTtimE')";
		if ($DB) {echo "|$stmt|\n";}
		$rslt=mysql_query($stmt, $link);

		##### check to see if the user has a conf extension already, this happens if they previously exited uncleanly
		$stmt="SELECT conf_exten FROM vicidial_conferences where extension='$SIP_user' and server_ip = '$server_ip' LIMIT 1;";
		$rslt=mysql_query($stmt, $link);
		if ($DB) {echo "$stmt\n";}
		$prev_login_ct = mysql_num_rows($rslt);
		$i=0;
		while ($i < $prev_login_ct)
			{
			$row=mysql_fetch_row($rslt);
			$session_id =$row[0];
			$i++;
			}
		if ($prev_login_ct > 0)
			{print "<!-- USA LA STANZA PER LA CONFERENZA PRECEDENTE - $session_id - $NOW_TIME - $SIP_user -->\n";}
		else
			{
			##### grab the next available vicidial_conference room and reserve it
			$stmt="SELECT conf_exten FROM vicidial_conferences where server_ip = '$server_ip' and ((extension='') or (extension is null)) LIMIT 1;";
			$rslt=mysql_query($stmt, $link);
			if ($DB) {echo "$stmt\n";}
			$free_conf_ct = mysql_num_rows($rslt);
			$i=0;
			while ($i < $free_conf_ct)
				{
				$row=mysql_fetch_row($rslt);
				$session_id =$row[0];
				$i++;
				}
			$stmt="UPDATE vicidial_conferences set extension='$SIP_user' where server_ip='$server_ip' and conf_exten='$session_id';";
			$rslt=mysql_query($stmt, $link);
			print "<!-- USA UNA NUOVA STANZA PER LA CONFERENZA - $session_id - $NOW_TIME - $SIP_user -->\n";

			}

		$stmt="UPDATE vicidial_list set status='N', user='' where status IN('QUEUE','INCALL') and user ='$VD_login';";
		if ($DB) {echo "$stmt\n";}
		$rslt=mysql_query($stmt, $link);
		$affected_rows = mysql_affected_rows($link);
		print "<!-- vecchia CODA e lista ritornata DA RICHIAMARE:   |$affected_rows| -->\n";

		$stmt="DELETE from vicidial_hopper where status IN('QUEUE','INCALL','DONE') and user ='$VD_login';";
		if ($DB) {echo "$stmt\n";}
		$rslt=mysql_query($stmt, $link);
		$affected_rows = mysql_affected_rows($link);
		print "<!-- vecchia CODA e Lista ATTIVA da richiamare: |$affected_rows| -->\n";

		$stmt="DELETE from vicidial_live_agents where user ='$VD_login';";
		if ($DB) {echo "$stmt\n";}
		$rslt=mysql_query($stmt, $link);
		$affected_rows = mysql_affected_rows($link);
		print "<!-- vecchie annotazioni dei vicidial_live_agents eliminate: |$affected_rows| -->\n";

	#	print "<B>You have logged in as user: $VD_login su phone: $SIP_user vai alla campagna: $VD_campaign</B><BR>\n";
		$VICIDiaL_is_logged_in=1;

		### use manager middleware-app to connect the phone to the user
		$SIqueryCID = "S$CIDdate$session_id";
		### insert a NUOVO record to the vicidial_manager table to be processed
		$stmt="INSERT INTO vicidial_manager values('','','$NOW_TIME','NEW','N','$server_ip','','Originate','$SIqueryCID','Channel: $SIP_user','Context: $ext_context','Exten: $session_id','Priority: 1','Callerid: $SIqueryCID','','','','','');";
		if ($DB) {echo "$stmt\n";}
		$rslt=mysql_query($stmt, $link);
		$affected_rows = mysql_affected_rows($link);
		print "<!-- call placed to session_id: $session_id from phone: $SIP_user -->\n";

		if ($auto_dial_level > 0)
			{
			print "<!-- la campagna è regola per l`auto chiamata: $auto_dial_level -->\n";

			$closer_chooser_string='';
			$stmt="INSERT INTO vicidial_live_agents (user,server_ip,conf_exten,extension,status,lead_id,campaign_id,uniqueid,callerid,channel,random_id,last_call_time,last_update_time,last_call_finish,closer_campaigns,user_level) values('$VD_login','$server_ip','$session_id','$SIP_user','PAUSED','','$VD_campaign','','','','$random','$NOW_TIME','$tsNOW_TIME','$NOW_TIME','$closer_chooser_string','$user_level');";
			if ($DB) {echo "$stmt\n";}
			$rslt=mysql_query($stmt, $link);
			$affected_rows = mysql_affected_rows($link);
			print "<!-- nuovo record operatore attivo inserito: |$affected_rows| -->\n";

			if (eregi("CLOSER", $VD_campaign))
				{
				print "<!-- code to trigger window to pick closer groups goes here -->\n";
				}
			}
		else
			{
			print "<!-- la campagna è regolata per la chiamata manuale: $auto_dial_level -->\n";



			}
		}
	else
		{
		echo "<title>Web client di VICICHIAMA: VICICHIAMA Inizio attività della Campagna</title>\n";
		echo "</head>\n";
		echo "<BODY BGCOLOR=WHITE MARGINHEIGHT=0 MARGINWIDTH=0>\n";
		echo "<TABLE WIDTH=100%><TR><TD></TD>\n";
		echo "<!-- ILPV -->\n";
echo "<TD WIDTH=100 ALIGN=RIGHT VALIGN=TOP  NOWRAP><a href=\"../agc_en/vicidial.php?relogin=YES&VD_login=$VD_login&VD_campaign=$VD_campaign&phone_login=$phone_login&phone_pass=$phone_pass&VD_pass=$VD_pass\">English <img src=\"../agc/images/en.gif\" BORDER=0 HEIGHT=14 WIDTH=20></a></TD>\n";echo "<TD WIDTH=100 ALIGN=RIGHT VALIGN=TOP  BGCOLOR=\"#CCFFCC\" NOWRAP><a href=\"../agc_it/vicidial.php?relogin=YES&VD_login=$VD_login&VD_campaign=$VD_campaign&phone_login=$phone_login&phone_pass=$phone_pass&VD_pass=$VD_pass\">Italiano <img src=\"../agc/images/it.gif\" BORDER=0 HEIGHT=14 WIDTH=20></a></TD>\n";		echo "</TR></TABLE>\n";
		echo "<B>Spiacenti, non contatti da richiamare per questa campagna</B>\n";
		echo "<FORM ACTION=\"$PHP_SELF\" METHOD=POST>\n";
		echo "<INPUT TYPE=HIDDEN NAME=DB VALUE=\"$DB\">\n";
		echo "<INPUT TYPE=HIDDEN NAME=phone_login VALUE=\"$phone_login\">\n";
		echo "<INPUT TYPE=HIDDEN NAME=phone_pass VALUE=\"$phone_pass\">\n";
		echo "Inizio attività: <INPUT TYPE=TEXT NAME=VD_login SIZE=10 maxlength=20 VALUE=\"$VD_login\">\n<br>";
		echo "Parola d`accesso: <INPUT TYPE=PASSWORD NAME=VD_pass SIZE=10 maxlength=20 VALUE=\"$VD_pass\"><br>\n";
		echo "Campagna: $camp_form_code<br>\n";
		echo "<INPUT TYPE=Submit NAME=INVIA VALUE=INVIA>\n";
		echo "</FORM>\n\n";
		echo "</body>\n\n";
		echo "</html>\n\n";
		exit;
		}
	if (strlen($session_id) < 1)
		{
		echo "<title>Web client di VICICHIAMA: VICICHIAMA Inizio attività della Campagna</title>\n";
		echo "</head>\n";
		echo "<BODY BGCOLOR=WHITE MARGINHEIGHT=0 MARGINWIDTH=0>\n";
		echo "<TABLE WIDTH=100%><TR><TD></TD>\n";
		echo "<!-- ILPV -->\n";
echo "<TD WIDTH=100 ALIGN=RIGHT VALIGN=TOP  NOWRAP><a href=\"../agc_en/vicidial.php?relogin=YES&VD_login=$VD_login&VD_campaign=$VD_campaign&phone_login=$phone_login&phone_pass=$phone_pass&VD_pass=$VD_pass\">English <img src=\"../agc/images/en.gif\" BORDER=0 HEIGHT=14 WIDTH=20></a></TD>\n";echo "<TD WIDTH=100 ALIGN=RIGHT VALIGN=TOP  BGCOLOR=\"#CCFFCC\" NOWRAP><a href=\"../agc_it/vicidial.php?relogin=YES&VD_login=$VD_login&VD_campaign=$VD_campaign&phone_login=$phone_login&phone_pass=$phone_pass&VD_pass=$VD_pass\">Italiano <img src=\"../agc/images/it.gif\" BORDER=0 HEIGHT=14 WIDTH=20></a></TD>\n";		echo "</TR></TABLE>\n";
		echo "<B>Sorry, there are no available sessions</B>\n";
		echo "<FORM ACTION=\"$PHP_SELF\" METHOD=POST>\n";
		echo "<INPUT TYPE=HIDDEN NAME=DB VALUE=\"$DB\">\n";
		echo "<INPUT TYPE=HIDDEN NAME=phone_login VALUE=\"$phone_login\">\n";
		echo "<INPUT TYPE=HIDDEN NAME=phone_pass VALUE=\"$phone_pass\">\n";
		echo "Inizio attività: <INPUT TYPE=TEXT NAME=VD_login SIZE=10 maxlength=20 VALUE=\"$VD_login\">\n<br>";
		echo "Parola d`accesso: <INPUT TYPE=PASSWORD NAME=VD_pass SIZE=10 maxlength=20 VALUE=\"$VD_pass\"><br>\n";
		echo "Campagna: $camp_form_code<br>\n";
		echo "<INPUT TYPE=Submit NAME=INVIA VALUE=INVIA>\n";
		echo "</FORM>\n\n";
		echo "</body>\n\n";
		echo "</html>\n\n";
		exit;
		}

	$StarTtimE = date("U");
	$NOW_TIME = date("Y-m-d H:i:s");
	##### Agent is going to log in so insert the vicidial_agent_log entry now
	$stmt="INSERT INTO vicidial_agent_log (user,server_ip,event_time,campaign_id,pause_epoch,pause_sec,wait_epoch) values('$VD_login','$server_ip','$NOW_TIME','$VD_campaign','$StarTtimE','0','$StarTtimE');";
	if ($DB) {echo "$stmt\n";}
	$rslt=mysql_query($stmt, $link);
	$affected_rows = mysql_affected_rows($link);
	$agent_log_id = mysql_insert_id();
	print "<!-- vicidial_agent_log record inserted: |$affected_rows|$agent_log_id| -->\n";

	$S='*';
	$D_s_ip = explode('.', $server_ip);
	if (strlen($D_s_ip[0])<2) {$D_s_ip[0] = "0$D_s_ip[0]";}
	if (strlen($D_s_ip[0])<3) {$D_s_ip[0] = "0$D_s_ip[0]";}
	if (strlen($D_s_ip[1])<2) {$D_s_ip[1] = "0$D_s_ip[1]";}
	if (strlen($D_s_ip[1])<3) {$D_s_ip[1] = "0$D_s_ip[1]";}
	if (strlen($D_s_ip[2])<2) {$D_s_ip[2] = "0$D_s_ip[2]";}
	if (strlen($D_s_ip[2])<3) {$D_s_ip[2] = "0$D_s_ip[2]";}
	if (strlen($D_s_ip[3])<2) {$D_s_ip[3] = "0$D_s_ip[3]";}
	if (strlen($D_s_ip[3])<3) {$D_s_ip[3] = "0$D_s_ip[3]";}
	$server_ip_dialstring = "$D_s_ip[0]$S$D_s_ip[1]$S$D_s_ip[2]$S$D_s_ip[3]$S";

	##### grab the datails of all active scripts in the system
	$stmt="SELECT script_id,script_name,script_text FROM vicidial_scripts WHERE active='Y' order by script_id limit 100;";
	$rslt=mysql_query($stmt, $link);
	if ($DB) {echo "$stmt\n";}
	$MM_scripts = mysql_num_rows($rslt);
	$e=0;
	while ($e < $MM_scripts)
		{
		$row=mysql_fetch_row($rslt);
		$MMscriptid[$e] =$row[0];
		$MMscriptname[$e] = rawurlencode($row[1]);
		$MMscripttext[$e] = rawurlencode($row[2]);
		$MMscriptids = "$MMscriptids'$MMscriptid[$e]',";
		$MMscriptnames = "$MMscriptnames'$MMscriptname[$e]',";
		$MMscripttexts = "$MMscripttexts'$MMscripttext[$e]',";
		$e++;
		}
	$MMscriptids = substr("$MMscriptids", 0, -1); 
	$MMscriptnames = substr("$MMscriptnames", 0, -1); 
	$MMscripttexts = substr("$MMscripttexts", 0, -1); 

	}
}

################################################################
### BEGIN - build the callback calendar (12 months)          ###
################################################################
define ('ADAY', (60*60*24));
$CdayARY = getdate();
$Cmon = $CdayARY['mon'];
$Cyear = $CdayARY['year'];
$CTODAY = date("Y-m");
$CTODAYmday = date("j");
$CINC=0;

$Cmonths = Array('January','February','March','April','May','June',
				'July','August','September','October','November','December');
$Cdays = Array('Sun','Mon','Tue','Wed','Thu','Fri','Sat');

$CCAL_OUT = '';

$CCAL_OUT .= "<table border=0 cellpadding=2 cellspacing=2>";

while ($CINC < 12)
{
if ( ($CINC == 0) || ($CINC == 4) ||($CINC == 8) )
	{$CCAL_OUT .= "<tr>";}

$CCAL_OUT .= "<td valign=top>";

$CYyear = $Cyear;
$Cmonth=	($Cmon + $CINC);
if ($Cmonth > 12)
	{
	$Cmonth = ($Cmonth - 12);
	$CYyear++;
	}
$Cstart= mktime(0,0,0,$Cmonth,1,$CYyear);
$CfirstdayARY = getdate($Cstart);
#echo "|$Cmon|$Cmonth|$CINC|\n";
$CPRNTDAY = date("Y-m", $Cstart);

$CCAL_OUT .= "<table border=1 cellpadding=1 bordercolor=\"000000\" cellspacing=\"0\" bgcolor=\"white\">";
$CCAL_OUT .= "<tr>";
$CCAL_OUT .= "<td colspan=7 bordercolor=\"#ffffff\" bgcolor=\"#FFFFCC\">";
$CCAL_OUT .= "<div align=center><font color=\"#000066\"><b><font face=\"Arial, Helvetica, sans-serif\" size=2>";
$CCAL_OUT .= "$CfirstdayARY[month] $CfirstdayARY[year]";
$CCAL_OUT .= "</font></b></font></div>";
$CCAL_OUT .= "</td>";
$CCAL_OUT .= "</tr>";

foreach($Cdays as $Cday)
{
	$CDCLR="#ffffff";
$CCAL_OUT .= "<td bordercolor=\"$CDCLR\">";
$CCAL_OUT .= "<div align=center><font color=\"#000066\"><b><font face=\"Arial, Helvetica, sans-serif\" size=1>";
$CCAL_OUT .= "$Cday";
$CCAL_OUT .= "</font></b></font></div>";
$CCAL_OUT .= "</td>";
}

for( $Ccount=0;$Ccount<(6*7);$Ccount++)
{
	$Cdayarray = getdate($Cstart);
	if((($Ccount) % 7) == 0)
	{
		if($Cdayarray['mon'] != $CfirstdayARY['mon'])
			break;
		$CCAL_OUT .= "</tr><tr>";
	}
	if($Ccount < $CfirstdayARY['wday'] || $Cdayarray['mon'] != $Cmonth)
	{
		$CCAL_OUT .= "<td bordercolor=\"#ffffff\"><font color=\"#000066\"><b><font face=\"Arial, Helvetica, sans-serif\" size=\"1\">&nbsp;</font></b></font></td>";
	}
	else
	{
		if( ($Cdayarray['mday'] == $CTODAYmday) and ($CPRNTDAY == $CTODAY) )
		{
		$CPRNTmday = $Cdayarray['mday'];
		if ($CPRNTmday < 10) {$CPRNTmday = "0$CPRNTmday";}
		$CBL = "<a href=\"#\" onclick=\"CB_date_pick('$CPRNTDAY-$CPRNTmday');return false;\">";
		$CEL = "</a>";

		$CCAL_OUT .= "<td bgcolor=\"#FFCCCC\" bordercolor=\"#FFCCCC\">";
		$CCAL_OUT .= "<div align=center><font face=\"Arial, Helvetica, sans-serif\" size=1>";
		$CCAL_OUT .= "$CBL$Cdayarray[mday]$CEL";
		$CCAL_OUT .= "</font></div>";
		$CCAL_OUT .= "</td>";
			$Cstart += ADAY;
		}
		else
		{
	$CDCLR="#ffffff";
	if ( ($Cdayarray['mday'] < $CTODAYmday) and ($CPRNTDAY == $CTODAY) )
		{
		$CDCLR="#CCCCCC";
		$CBL = '';
		$CEL = '';
		}
	else
		{
		$CPRNTmday = $Cdayarray['mday'];
		if ($CPRNTmday < 10) {$CPRNTmday = "0$CPRNTmday";}
		$CBL = "<a href=\"#\" onclick=\"CB_date_pick('$CPRNTDAY-$CPRNTmday');return false;\">";
		$CEL = "</a>";
		}

	$CCAL_OUT .= "<td bgcolor=\"$CDCLR\" bordercolor=\"#ffffff\">";
	$CCAL_OUT .= "<div align=center><font face=\"Arial, Helvetica, sans-serif\" size=1>";
	$CCAL_OUT .= "$CBL$Cdayarray[mday]$CEL";
	$CCAL_OUT .= "</font></div>";
	$CCAL_OUT .= "</td>";
		$Cstart += ADAY;
		}
	}
}
$CCAL_OUT .= "</tr>";
$CCAL_OUT .= "</table>";
$CCAL_OUT .= "</td>";

if ( ($CINC == 3) || ($CINC == 7) ||($CINC == 11) )
	{$CCAL_OUT .= "</tr>";}
$CINC++;
}

$CCAL_OUT .= "</table>";

#echo "$CCAL_OUT\n";
################################################################
### END - build the callback calendar (12 months)            ###
################################################################


?>
	<script language="Javascript">	
	var MTvar;
	var NOW_TIME = '<? echo $NOW_TIME ?>';
	var SQLdate = '<? echo $NOW_TIME ?>';
	var StarTtimE = '<? echo $StarTtimE ?>';
	var UnixTime = '<? echo $StarTtimE ?>';
	var UnixTimeMS = 0;
	var t = new Date();
	var c = new Date();
	LCAe = new Array('','','','','','');
	LCAc = new Array('','','','','','');
	LCAt = new Array('','','','','','');
	LMAe = new Array('','','','','','');
	var CalL_XC_a_Dtmf = '<? echo $xferconf_a_dtmf ?>';
	var CalL_XC_a_NuMber = '<? echo $xferconf_a_number ?>';
	var CalL_XC_b_Dtmf = '<? echo $xferconf_b_dtmf ?>';
	var CalL_XC_b_NuMber = '<? echo $xferconf_b_number ?>';
	var VU_hotkeys_active = '<? echo $VU_hotkeys_active ?>';
	var VU_agent_choose_ingroups = '<? echo $VU_agent_choose_ingroups ?>';
	var VU_agent_choose_ingroups_DV = '';
	var CallBackDatETimE = '';
	var CallBackrecipient = '';
	var CallBackCommenTs = '';
	var scheduled_callbacks = '<? echo $scheduled_callbacks ?>';
	var dispo_check_all_pause = '<? echo $dispo_check_all_pause ?>';
	VARstatuses = new Array(<? echo $VARstatuses ?>);
	VARstatusnames = new Array(<? echo $VARstatusnames ?>);
	var VD_statuses_ct = '<? echo $VD_statuses_ct ?>';
	VARingroups = new Array(<? echo $VARingroups ?>);
	var INgroupCOUNT = '<? echo $INgrpCT ?>';
	var HK_statuses_camp = '<? echo $HK_statuses_camp ?>';
	HKhotkeys = new Array(<? echo $HKhotkeys ?>);
	HKstatuses = new Array(<? echo $HKstatuses ?>);
	HKstatusnames = new Array(<? echo $HKstatusnames ?>);
	var hotkeys = new Array();
	<? $h=0;
	while ($HK_statuses_camp > $h)
	{
	echo "hotkeys['$HKhotkey[$h]'] = \"$HKstatus[$h] ----- $HKstatus_name[$h]\";\n";
	$h++;
	}
	?>
	var HKdispo_display = 0;
	var HKbutton_allowed = 1;
	var HKfinish = 0;
	var scriptnames = new Array();
	<? $h=0;
	while ($MM_scripts > $h)
	{
	echo "scriptnames['$MMscriptid[$h]'] = \"$MMscriptname[$h]\";\n";
	$h++;
	}
	?>
	var scripttexts = new Array();
	<? $h=0;
	while ($MM_scripts > $h)
	{
	echo "scripttexts['$MMscriptid[$h]'] = \"$MMscripttext[$h]\";\n";
	$h++;
	}
	?>
	var decoded = '';
	var view_scripts = '<? echo $view_scripts ?>';
	var LOGfullname = '<? echo $LOGfullname ?>';
	var recLIST = '';
	var filename = '';
	var last_filename = '';
	var LCAcount = 0;
	var LMAcount = 0;
	var filedate = '<? echo $FILE_TIME ?>';
	var agcDIR = '<? echo $agcDIR ?>';
	var agcPAGE = '<? echo $agcPAGE ?>';
	var extension = '<? echo $extension ?>';
	var extension_xfer = '<? echo $extension ?>';
	var dialplan_number = '<? echo $dialplan_number ?>';
	var ext_context = '<? echo $ext_context ?>';
	var protocol = '<? echo $protocol ?>';
	var local_gmt ='<? echo $local_gmt ?>';
	var server_ip = '<? echo $server_ip ?>';
	var server_ip_dialstring = '<? echo $server_ip_dialstring ?>';
	var asterisk_version = '<? echo $asterisk_version ?>';
<?
if ($enable_fast_refresh < 1) {echo "\tvar refresh_interval = 1000;\n";}
	else {echo "\tvar refresh_interval = $fast_refresh_rate;\n";}
?>
	var session_id = '<? echo $session_id ?>';
	var VICIDiaL_closer_login_checked = 0;
	var VICIDiaL_closer_login_selected = 0;
	var VICIDiaL_pause_calling = 1;
	var CalLCID = '';
	var MDnextCID = '';
	var XDnextCID = '';
	var lead_dial_number = '';
	var MD_channel_look = 0;
	var XD_channel_look = 0;
	var MDuniqueid = '';
	var MDchannel = '';
	var MD_ring_secondS = 0;
	var MDlogEPOCH = 0;
	var VD_live_customer_call = 0;
	var VD_live_call_secondS = 0;
	var XD_live_customer_call = 0;
	var XD_live_call_secondS = 0;
	var open_dispo_screen = 0;
	var AgentDispoing = 0;
	var logout_stop_timeouts = 0;
	var VICIDiaL_allow_closers = '<? echo $VICIDiaL_allow_closers ?>';
	var VICIDiaL_closer_blended = '0';
	var VU_closer_default_blended = '<? echo $VU_closer_default_blended ?>';
	var VDstop_rec_after_each_call = '<? echo $VDstop_rec_after_each_call ?>';
	var phone_login = '<? echo $phone_login ?>';
	var phone_pass = '<? echo $phone_pass ?>';
	var user = '<? echo $VD_login ?>';
	var user_abb = '<? echo $user_abb ?>';
	var pass = '<? echo $VD_pass ?>';
	var campaign = '<? echo $VD_campaign ?>';
	var VICIDiaL_web_form_address_enc = '<? echo $VICIDiaL_web_form_address_enc ?>';
	var VICIDiaL_web_form_address = '<? echo $VICIDiaL_web_form_address ?>';
	var VDIC_web_form_address = '<? echo $VICIDiaL_web_form_address ?>';
	var CalL_ScripT_id = '';
	var CalL_AutO_LauncH = '';
	var panel_bgcolor = '#E0C2D6';
	var CusTCB_bgcolor = '#FFFF66';
	var status_A = '<? echo $status_A ?>';
	var status_B = '<? echo $status_B ?>';
	var status_C = '<? echo $status_C ?>';
	var status_D = '<? echo $status_D ?>';
	var status_E = '<? echo $status_E ?>';
	var auto_dial_level = '<? echo $auto_dial_level ?>';
	var starting_dial_level = '<? echo $auto_dial_level ?>';
	var dial_timeout = '<? echo $dial_timeout ?>';
	var dial_prefix = '<? echo $dial_prefix ?>';
	var campaign_cid = '<? echo $campaign_cid ?>';
	var campaign_vdad_exten = '<? echo $campaign_vdad_exten ?>';
	var campaign_leads_to_call = '<? echo $campaign_leads_to_call ?>';
	var epoch_sec = <? echo $StarTtimE ?>;
	var dtmf_send_extension = '<? echo $dtmf_send_extension ?>';
	var recording_exten = '<? echo $campaign_rec_exten ?>';
	var campaign_recording = '<? echo $campaign_recording ?>';
	var campaign_rec_filename = '<? echo $campaign_rec_filename ?>';
	var campaign_script = '<? echo $campaign_script ?>';
	var get_call_launch = '<? echo $get_call_launch ?>';
	var campaign_am_message_exten = '<? echo $campaign_am_message_exten ?>';
	var park_on_extension = '<? echo $VICIDiaL_park_on_extension ?>';
	var park_count=0;
	var park_refresh=0;
	var customerparked=0;
	var check_n = 0;
	var conf_check_recheck = 0;
	var lastconf='';
	var lastcustchannel='';
	var lastcustserverip='';
	var lastxferchannel='';
	var custchannellive=0;
	var xferchannellive=0;
	var nochannelinsession=0;
	var agc_dial_prefix = '91';
	var conf_silent_prefix = '<? echo $conf_silent_prefix ?>';
	var menuheight = 30;
	var menuwidth = 30;
	var menufontsize = 8;
	var textareafontsize = 10;
	var check_s;
	var active_display = 1;
	var conf_channels_xtra_display = 0;
	var display_message = '';
	var web_form_vars = '';
	var Nactiveext;
	var Nbusytrunk;
	var Nbusyext;
	var extvalue = extension;
	var activeext_query;
	var busytrunk_query;
	var busyext_query;
	var busytrunkhangup_query;
	var busylocalhangup_query;
	var activeext_order='asc';
	var busytrunk_order='asc';
	var busyext_order='asc';
	var busytrunkhangup_order='asc';
	var busylocalhangup_order='asc';
	var xmlhttp=false;
	var XfeR_channel = '';
	var XDcheck = '';
	var agent_log_id = '<? echo $agent_log_id ?>';
	var session_name = '<? echo $session_name ?>';
	var AutoDialReady = 0;
	var AutoDialWaiting = 0;
	var fronter = '';
	var VDCL_group_id = '';
	var previous_dispo = '';
	var previous_called_count = '';
	var hot_keys_active = 0;
	var all_record = 'NO';
	var LeaDDispO = '';
	var LeaDPreVDispO = '';
	var AgaiNHanguPChanneL = '';
	var AgaiNHanguPServeR = '';
	var AgainCalLSecondS = '';
	var AgaiNCalLCID = '';
	var CB_count_check = 60;
	var agentcallsstatus = '<? echo $agentcallsstatus ?>';
	var campagentstatctmax = '<? echo $campagentstatctmax ?>';
	var campagentstatct = '0';
	var manual_dial_in_progress = 0;
	var auto_dial_alt_dial = 0;
	var reselect_preview_dial = 0;
	var reselect_alt_dial = 0;
	var alt_dial_active = 0;
	var mdnLisT_id = '999';
	var VU_vicidial_transfers = '<? echo $VU_vicidial_transfers ?>';
	var agentonly_callbacks = '<? echo $agentonly_callbacks ?>';
	var agentcall_manual = '<? echo $agentcall_manual ?>';
	var manual_dial_preview = '<? echo $manual_dial_preview ?>';
	var starting_alt_phone_dialing = '<? echo $alt_phone_dialing ?>';
	var alt_phone_dialing = '<? echo $alt_phone_dialing ?>';
	var wrapup_secondi = '<? echo $wrapup_secondi ?>';
	var wrapup_message = '<? echo $wrapup_message ?>';
	var wrapup_counter = 0;
	var wrapup_waiting = 0;
	var use_internal_dnc = '<? echo $use_internal_dnc ?>'
	var DiaLControl_auto_HTML = "<IMG SRC=\"../agc/images/vdc_LB_pause_OFF_it.gif\" border=0 alt=\"Pausa\"><a href=\"#\" onclick=\"AutoDial_ReSume_PauSe('VDADready');\"><IMG SRC=\"../agc/images/vdc_LB_resume_it.gif\" border=0 alt=\"Riprendi\"></a>";
	var DiaLControl_auto_HTML_ready = "<a href=\"#\" onclick=\"AutoDial_ReSume_PauSe('VDADpause');\"><IMG SRC=\"../agc/images/vdc_LB_pause_it.gif\" border=0 alt=\"Pausa\"></a><IMG SRC=\"../agc/images/vdc_LB_resume_OFF_it.gif\" border=0 alt=\"Riprendi\">";
	var DiaLControl_auto_HTML_OFF = "<IMG SRC=\"../agc/images/vdc_LB_pause_OFF_it.gif\" border=0 alt=\"Pausa\"><IMG SRC=\"../agc/images/vdc_LB_resume_OFF_it.gif\" border=0 alt=\"Riprendi\">";
	var DiaLControl_manual_HTML = "<a href=\"#\" onclick=\"ManualDialNext('','','','','');\"><IMG SRC=\"../agc/images/vdc_LB_dialnextnumber_it.gif\" border=0 alt=\"Chiama il numero seguente\"></a>";
	var image_blank = new Image();
		image_blank.src="../agc/images/blank.gif";
	var image_livecall_OFF = new Image();
		image_livecall_OFF.src="../agc/images/agc_live_call_OFF_it.gif";
	var image_livecall_ON = new Image();
		image_livecall_ON.src="../agc/images/agc_live_call_ON_it.gif";
	var image_LB_dialnextnumber = new Image();
		image_LB_dialnextnumber.src="../agc/images/vdc_LB_dialnextnumber_it.gif";
	var image_LB_hangupcustomer = new Image();
		image_LB_hangupcustomer.src="../agc/images/vdc_LB_hangupcustomer_it.gif";
	var image_LB_transferconf = new Image();
		image_LB_transferconf.src="../agc/images/vdc_LB_transferconf_it.gif";
	var image_LB_grabparkedcall = new Image();
		image_LB_grabparkedcall.src="../agc/images/vdc_LB_grabparkedcall_it.gif";
	var image_LB_parkcall = new Image();
		image_LB_parkcall.src="../agc/images/vdc_LB_parkcall_it.gif";
	var image_LB_webform = new Image();
		image_LB_webform.src="../agc/images/vdc_LB_webform_it.gif";
	var image_LB_stoprecording = new Image();
		image_LB_stoprecording.src="../agc/images/vdc_LB_stoprecording_it.gif";
	var image_LB_startrecording = new Image();
		image_LB_startrecording.src="../agc/images/vdc_LB_startrecording_it.gif";
	var image_LB_pause = new Image();
		image_LB_pause.src="../agc/images/vdc_LB_pause_it.gif";
	var image_LB_resume = new Image();
		image_LB_resume.src="../agc/images/vdc_LB_resume_it.gif";
	var image_LB_senddtmf = new Image();
		image_LB_senddtmf.src="../agc/images/vdc_LB_senddtmf_it.gif";
	var image_LB_dialnextnumber_OFF = new Image();
		image_LB_dialnextnumber_OFF.src="../agc/images/vdc_LB_dialnextnumber_OFF_it.gif";
	var image_LB_hangupcustomer_OFF = new Image();
		image_LB_hangupcustomer_OFF.src="../agc/images/vdc_LB_hangupcustomer_OFF_it.gif";
	var image_LB_transferconf_OFF = new Image();
		image_LB_transferconf_OFF.src="../agc/images/vdc_LB_transferconf_OFF_it.gif";
	var image_LB_grabparkedcall_OFF = new Image();
		image_LB_grabparkedcall_OFF.src="../agc/images/vdc_LB_grabparkedcall_OFF.gif";
	var image_LB_parkcall_OFF = new Image();
		image_LB_parkcall_OFF.src="../agc/images/vdc_LB_parkcall_OFF_it.gif";
	var image_LB_webform_OFF = new Image();
		image_LB_webform_OFF.src="../agc/images/vdc_LB_webform_OFF_it.gif";
	var image_LB_stoprecording_OFF = new Image();
		image_LB_stoprecording_OFF.src="../agc/images/vdc_LB_stoprecording_OFF.gif";
	var image_LB_startrecording_OFF = new Image();
		image_LB_startrecording_OFF.src="../agc/images/vdc_LB_startrecording_OFF.gif";
	var image_LB_pause_OFF = new Image();
		image_LB_pause_OFF.src="../agc/images/vdc_LB_pause_OFF_it.gif";
	var image_LB_resume_OFF = new Image();
		image_LB_resume_OFF.src="../agc/images/vdc_LB_resume_OFF_it.gif";
	var image_LB_senddtmf_OFF = new Image();
		image_LB_senddtmf_OFF.src="../agc/images/vdc_LB_senddtmf_OFF_it.gif";



// ################################################################################
// Send Hangup command for Live call connected to phone now to Manager
	function livehangup_send_hangup(taskvar) 
		{
		var xmlhttp=false;
		/*@cc_on @*/
		/*@if (@_jscript_version >= 5)
		// JScript gives us Conditional compilation, we can cope with old IE versions.
		// and security blocked creation of the objects.
		 try {
		  xmlhttp = new ActiveXObject("Msxml2.XMLHTTP");
		 } catch (e) {
		  try {
		   xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
		  } catch (E) {
		   xmlhttp = false;
		  }
		 }
		@end @*/
		if (!xmlhttp && typeof XMLHttpRequest!='undefined')
			{
			xmlhttp = new XMLHttpRequest();
			}
		if (xmlhttp) 
			{ 
			var queryCID = "HLagcW" + epoch_sec + user_abb;
			var hangupvalue = taskvar;
			livehangup_query = "server_ip=" + server_ip + "&session_name=" + session_name + "&user=" + user + "&pass=" + pass + "&ACTION=Hangup&format=text&channel=" + hangupvalue + "&queryCID=" + queryCID;
			xmlhttp.open('POST', 'manager_send.php'); 
			xmlhttp.setRequestHeader('Content-Type','application/x-www-form-urlencoded; charset=UTF-8');
			xmlhttp.send(livehangup_query); 
			xmlhttp.onreadystatechange = function() 
				{ 
				if (xmlhttp.readyState == 4 && xmlhttp.status == 200) 
					{
					Nactiveext = null;
					Nactiveext = xmlhttp.responseText;
					alert(xmlhttp.responseText);
					}
				}
			delete xmlhttp;
			}
		}

// ################################################################################
// park customer and place 3way call
	function xfer_park_dial()
		{
		mainxfer_send_redirect('ParK',lastcustchannel,lastcustserverip);

		SendManualDial('YES');
		}

// ################################################################################
// place 3way and customer into other conference and fake-hangup the lines
	function leave_3way_call()
		{
		mainxfer_send_redirect('3WAY');

		document.vicidial_form.callchannel.value = '';
		document.vicidial_form.callserverip.value = '';
		if( document.images ) { document.images['livecall'].src = image_livecall_OFF.src;}
		dialedcall_send_hangup();

		document.vicidial_form.xferchannel.value = '';
		xfercall_send_hangup();
		}

// ################################################################################
// filter manual dialstring and pass su to originate call
	function SendManualDial(taskFromConf)
		{
		if (taskFromConf == 'YES')
			{
			var manual_number = document.vicidial_form.xfernumber.value;
			var manual_string = manual_number.toString();
			var dial_conf_exten = session_id;
			}
		else
			{
			var manual_number = document.vicidial_form.xfernumber.value;
			var manual_string = manual_number.toString();
			}
		if (document.vicidial_form.xferoverride.checked==false)
			{
			if (manual_string.length=='11')
				{manual_string = "9" + manual_string;}
			 else
				{
				if (manual_string.length=='10')
					{manual_string = "91" + manual_string;}
				 else
					{
					if (manual_string.length=='7')
						{manual_string = "9" + manual_string;}
					}
				}
			}
		if (taskFromConf == 'YES')
			{basic_originate_call(manual_string,'NO','YES',dial_conf_exten);}
		else
			{basic_originate_call(manual_string,'NO','NO');}

		MD_ring_secondS=0;
		}

// ################################################################################
// Send Originate command to manager to place a phone call
	function basic_originate_call(tasknum,taskprefix,taskreverse,taskdialvalue,tasknowait) 
		{
		var xmlhttp=false;
		/*@cc_on @*/
		/*@if (@_jscript_version >= 5)
		// JScript gives us Conditional compilation, we can cope with old IE versions.
		// and security blocked creation of the objects.
		 try {
		  xmlhttp = new ActiveXObject("Msxml2.XMLHTTP");
		 } catch (e) {
		  try {
		   xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
		  } catch (E) {
		   xmlhttp = false;
		  }
		 }
		@end @*/
		if (!xmlhttp && typeof XMLHttpRequest!='undefined')
			{
			xmlhttp = new XMLHttpRequest();
			}
		if (xmlhttp) 
			{ 

			if (taskprefix == 'NO') {var orig_prefix = '';}
			  else {var orig_prefix = agc_dial_prefix;}
			if (taskreverse == 'YES')
				{
				if (taskdialvalue.length < 2)
					{var dialnum = dialplan_number;}
				else
					{var dialnum = taskdialvalue;}
				var originatevalue = "Local/" + tasknum + "@" + ext_context;
				}
			  else 
				{
				var dialnum = tasknum;
				if (protocol == 'EXTERNAL')
					{
					var protodial = 'Local';
					var extendial = extension + "@" + ext_context;
					}
				else
					{
					var protodial = protocol;
					var extendial = extension;
					}
				var originatevalue = protodial + "/" + extendial;
				}
			var queryCID = "DVagcW" + epoch_sec + user_abb;

			VMCoriginate_query = "server_ip=" + server_ip + "&session_name=" + session_name + "&user=" + user + "&pass=" + pass + "&ACTION=Originate&format=text&channel=" + originatevalue + "&queryCID=" + queryCID + "&exten=" + orig_prefix + "" + dialnum + "&ext_context=" + ext_context + "&ext_priority=1&outbound_cid=" + campaign_cid;
			xmlhttp.open('POST', 'manager_send.php'); 
			xmlhttp.setRequestHeader('Content-Type','application/x-www-form-urlencoded; charset=UTF-8');
			xmlhttp.send(VMCoriginate_query); 
			xmlhttp.onreadystatechange = function() 
				{ 
				if (xmlhttp.readyState == 4 && xmlhttp.status == 200) 
					{
					alert(xmlhttp.responseText);

					if ((taskdialvalue.length > 0) && (tasknowait != 'YES'))
						{
						XDnextCID = queryCID;
						MD_channel_look=1;
						XDcheck = 'YES';

				//		document.getElementById("HangupXferLine").innerHTML ="<a href=\"#\" onclick=\"xfercall_send_hangup();return false;\"><IMG SRC=\"../agc/images/vdc_XB_hangupxferline_it.gif\" border=0 alt=\"Attacca la linea trasferita\"></a>";
						}
					}
				}
			delete xmlhttp;
			}
		}

// ################################################################################
// filter conf_dtmf send string and pass su to originate call
	function SendConfDTMF(taskconfdtmf)
		{
		var dtmf_number = document.vicidial_form.conf_dtmf.value;
		var dtmf_string = dtmf_number.toString();
		var conf_dtmf_room = taskconfdtmf;

		var xmlhttp=false;
		/*@cc_on @*/
		/*@if (@_jscript_version >= 5)
		// JScript gives us Conditional compilation, we can cope with old IE versions.
		// and security blocked creation of the objects.
		 try {
		  xmlhttp = new ActiveXObject("Msxml2.XMLHTTP");
		 } catch (e) {
		  try {
		   xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
		  } catch (E) {
		   xmlhttp = false;
		  }
		 }
		@end @*/
		if (!xmlhttp && typeof XMLHttpRequest!='undefined')
			{
			xmlhttp = new XMLHttpRequest();
			}
		if (xmlhttp) 
			{ 
			var queryCID = dtmf_string;
			VMCoriginate_query = "server_ip=" + server_ip + "&session_name=" + session_name + "&user=" + user + "&pass=" + pass  + "&ACTION=SysCIDOriginate&format=text&channel=" + dtmf_send_extension + "&queryCID=" + queryCID + "&exten=" + conf_silent_prefix + '' + conf_dtmf_room + "&ext_context=" + ext_context + "&ext_priority=1";
			xmlhttp.open('POST', 'manager_send.php'); 
			xmlhttp.setRequestHeader('Content-Type','application/x-www-form-urlencoded; charset=UTF-8');
			xmlhttp.send(VMCoriginate_query); 
			xmlhttp.onreadystatechange = function() 
				{ 
				if (xmlhttp.readyState == 4 && xmlhttp.status == 200) 
					{
			//		alert(xmlhttp.responseText);
					}
				}
			delete xmlhttp;
			}
		document.vicidial_form.conf_dtmf.value = '';
		}

// ################################################################################
// Check to see if there are any channels live in the agent's conference meetme room
	function check_for_conf_calls(taskconfnum,taskforce)
		{
		custchannellive--;
		if (agentcallsstatus == '1')
			{
			campagentstatct++;
			if (campagentstatct > campagentstatctmax) 
				{
				campagentstatct=0;
				var campagentstdisp = 'YES';
				}
			else
				{
				var campagentstdisp = 'NO';
				}
			}
		else
			{
			var campagentstdisp = 'NO';
			}
		var xmlhttp=false;
		/*@cc_on @*/
		/*@if (@_jscript_version >= 5)
		// JScript gives us Conditional compilation, we can cope with old IE versions.
		// and security blocked creation of the objects.
		 try {
		  xmlhttp = new ActiveXObject("Msxml2.XMLHTTP");
		 } catch (e) {
		  try {
		   xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
		  } catch (E) {
		   xmlhttp = false;
		  }
		 }
		@end @*/
		if (!xmlhttp && typeof XMLHttpRequest!='undefined')
			{
			xmlhttp = new XMLHttpRequest();
			}
		if (xmlhttp) 
			{ 
			checkconf_query = "server_ip=" + server_ip + "&session_name=" + session_name + "&user=" + user + "&pass=" + pass + "&client=vdc&conf_exten=" + taskconfnum + "&auto_dial_level=" + auto_dial_level + "&campagentstdisp=" + campagentstdisp;
			xmlhttp.open('POST', 'conf_exten_check.php'); 
			xmlhttp.setRequestHeader('Content-Type','application/x-www-form-urlencoded; charset=UTF-8');
			xmlhttp.send(checkconf_query); 
			xmlhttp.onreadystatechange = function() 
				{ 
				if (xmlhttp.readyState == 4 && xmlhttp.status == 200) 
					{
					var check_conf = null;
					var LMAforce = taskforce;
					check_conf = xmlhttp.responseText;
				//	alert(checkconf_query);
				//	alert(xmlhttp.responseText);
					var check_ALL_array=check_conf.split("\n");
					var check_time_array=check_ALL_array[0].split("|");
					var Time_array = check_time_array[1].split("UnixTime: ");
					 UnixTime = Time_array[1];
					 UnixTime = parseInt(UnixTime);
					 UnixTimeMS = (UnixTime * 1000);
					t.setTime(UnixTimeMS);
					if (agentcallsstatus == '1')
						{
						var Astatus_array = check_time_array[2].split("Status: ");
						var AGStatuS = Astatus_array[1];
						var CamPCalLs_array = check_time_array[3].split("CampCalls: ");
						var CamPCalLs = CamPCalLs_array[1];
						if (AGStatuS != 'N')
							{
							document.getElementById("AgentStatusStatus").innerHTML = AGStatuS;
							}
						if (CamPCalLs != 'N')
							{
							document.getElementById("AgentStatusCalls").innerHTML = CamPCalLs;
							}
						}
					var check_conf_array=check_ALL_array[1].split("|");
					var live_conf_calls = check_conf_array[0];
					var conf_chan_array = check_conf_array[1].split(" ~");
					if ( (conf_channels_xtra_display == 1) || (conf_channels_xtra_display == 0) )
						{
						if (live_conf_calls > 0)
							{
							var loop_ct=0;
							var ARY_ct=0;
							var LMAalter=0;
							var LMAcontent_change=0;
							var LMAcontent_match=0;
							var conv_start=-1;
				//			var live_conf_HTML = "<font face=\"Arial,Helvetica\"><B>CHIAMATE ATTIVE IN QUESTA CONFERENZA:</B></font><BR><TABLE WIDTH=500><TR BGCOLOR=#E6E6E6><TD><font class=\"log_title\">#</TD><TD><font class=\"log_title\">CANALE REMOTO</TD><TD><font class=\"log_title\">ATTACCA</TD><TD><font class=\"log_title\">TRASF</TD></TR>";
							var live_conf_HTML = "<font face=\"Arial,Helvetica\"><B>CHIAMATE ATTIVE NELLA VOSTRA SESSIONE:</B></font><BR><TABLE WIDTH=500><TR BGCOLOR=#E6E6E6><TD><font class=\"log_title\">#</TD><TD><font class=\"log_title\">CANALE REMOTO</TD><TD><font class=\"log_title\">ATTACCA</TD></TR>";
							if ( (LMAcount > live_conf_calls)  || (LMAcount < live_conf_calls) || (LMAforce > 0))
								{
								LMAe[0]=''; LMAe[1]=''; LMAe[2]=''; LMAe[3]=''; LMAe[4]=''; LMAe[5]=''; 
								LMAcount=0;   LMAcontent_change++;
								}
							while (loop_ct < live_conf_calls)
								{
								loop_ct++;
								loop_s = loop_ct.toString();
								if (loop_s.match(/1$|3$|5$|7$|9$/)) 
									{var row_color = '#DDDDFF';}
								else
									{var row_color = '#CCCCFF';}
								var conv_ct = (loop_ct + conv_start);
								var channelfieldA = conf_chan_array[conv_ct];
					//			live_conf_HTML = live_conf_HTML + "<tr bgcolor=\"" + row_color + "\"><td><font class=\"log_text\">" + loop_ct + "</td><td><font class=\"log_text\">" + channelfieldA + "</td><td><font class=\"log_text\"><a href=\"#\" onclick=\"livehangup_send_hangup('" + channelfieldA + "');return false;\">Hangup</td><td><font class=\"log_text\"><a href=\"#\" onclick=\"showMainXfeR('MainXfeRBox','" + channelfieldA + "');return false;\">TRASF</td></tr>";
								live_conf_HTML = live_conf_HTML + "<tr bgcolor=\"" + row_color + "\"><td><font class=\"log_text\">" + loop_ct + "</td><td><font class=\"log_text\">" + channelfieldA + "</td><td><font class=\"log_text\"><a href=\"#\" onclick=\"livehangup_send_hangup('" + channelfieldA + "');return false;\">ATTACCA</td></tr>";

			//		var debugspan = document.getElementById("debugbottomspan").innerHTML;

								if (channelfieldA == lastcustchannel) {custchannellive++;}
								else
									{
									if(customerparked == 1)
										{custchannellive++;}
									// allow for no customer hungup errors if call from another server
									if(server_ip == lastcustserverip)
										{var nothing='';}
									else
										{custchannellive++;}
									}

			//		document.getElementById("debugbottomspan").innerHTML = debugspan + '<BR>' + channelfieldA + '|' + lastcustchannel + '|' + custchannellive + '|' + LMAcontent_change + '|' + LMAalter;

								if (!LMAe[ARY_ct]) 
									{LMAe[ARY_ct] = channelfieldA;   LMAcontent_change++;  LMAalter++;}
								else
									{
									if (LMAe[ARY_ct].length < 1) 
										{LMAe[ARY_ct] = channelfieldA;   LMAcontent_change++;  LMAalter++;}
									else
										{
										if (LMAe[ARY_ct] == channelfieldA) {LMAcontent_match++;}
										 else {LMAcontent_change++;   LMAe[ARY_ct] = channelfieldA;}
										}
									}
								if (LMAalter > 0) {LMAcount++;}
								
								ARY_ct++;
								}
	//	var debug_LMA = LMAcontent_match+"|"+LMAcontent_change+"|"+LMAcount+"|"+live_conf_calls+"|"+LMAe[0]+LMAe[1]+LMAe[2]+LMAe[3]+LMAe[4]+LMAe[5];
	//							document.getElementById("confdebug").innerHTML = debug_LMA + "<BR>";

							live_conf_HTML = live_conf_HTML + "</table>";

							if (LMAcontent_change > 0)
								{
								if (conf_channels_xtra_display == 1)
									{document.getElementById("outboundcallsspan").innerHTML = live_conf_HTML;}
								}
							nochannelinsession=0;
							}
						else
							{
							LMAe[0]=''; LMAe[1]=''; LMAe[2]=''; LMAe[3]=''; LMAe[4]=''; LMAe[5]=''; 
							LMAcount=0;
							if (conf_channels_xtra_display == 1)
								{
								if (document.getElementById("outboundcallsspan").innerHTML.length > 2)
									{
									document.getElementById("outboundcallsspan").innerHTML = '';
									}
								}
							custchannellive = -99;
							nochannelinsession++;
							}
						}
					}
				}
			delete xmlhttp;
			}
		}

// ################################################################################
// Send MonitorConf/StopMonitorConf command for recording of conferences
	function conf_send_recording(taskconfrectype,taskconfrec,taskconffile) 
		{
		var xmlhttp=false;
		/*@cc_on @*/
		/*@if (@_jscript_version >= 5)
		// JScript gives us Conditional compilation, we can cope with old IE versions.
		// and security blocked creation of the objects.
		 try {
		  xmlhttp = new ActiveXObject("Msxml2.XMLHTTP");
		 } catch (e) {
		  try {
		   xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
		  } catch (E) {
		   xmlhttp = false;
		  }
		 }
		@end @*/
		if (!xmlhttp && typeof XMLHttpRequest!='undefined')
			{
			xmlhttp = new XMLHttpRequest();
			}
		if (xmlhttp) 
			{ 
			if (taskconfrectype == 'MonitorConf')
				{
				// 	var campaign_recording = '<? echo $campaign_recording ?>';
				//	var campaign_rec_filename = '<? echo $campaign_rec_filename ?>';
				//	CAMPAIGN CUSTPHONE FULLDATE TINYDATE EPOCH AGENT
				var REGrecCAMPAIGN = new RegExp("CAMPAIGN","g");
				var REGrecCUSTPHONE = new RegExp("CUSTPHONE","g");
				var REGrecFULLDATE = new RegExp("FULLDATE","g");
				var REGrecTINYDATE = new RegExp("TINYDATE","g");
				var REGrecEPOCH = new RegExp("EPOCH","g");
				var REGrecAGENT = new RegExp("AGENT","g");
				filename = campaign_rec_filename;
				filename = filename.replace(REGrecCAMPAIGN, campaign);
				filename = filename.replace(REGrecCUSTPHONE, lead_dial_number);
				filename = filename.replace(REGrecFULLDATE, filedate);
				filename = filename.replace(REGrecTINYDATE, tinydate);
				filename = filename.replace(REGrecEPOCH, epoch_sec);
				filename = filename.replace(REGrecAGENT, user);
			//	filename = filedate + "_" + user_abb;
				var query_recording_exten = recording_exten;
				var channelrec = "Local/" + conf_silent_prefix + '' + taskconfrec + "@" + ext_context;
				var conf_rec_start_html = "<a href=\"#\" onclick=\"conf_send_recording('StopMonitorConf','" + taskconfrec + "','" + filename + "');return false;\"><IMG SRC=\"../agc/images/vdc_LB_stoprecording_it.gif\" border=0 alt=\"Stop Registrazione\"></a>";
				document.getElementById("RecorDControl").innerHTML = conf_rec_start_html;
			}
			if (taskconfrectype == 'StopMonitorConf')
				{
				filename = taskconffile;
				var query_recording_exten = session_id;
				var channelrec = "Local/" + conf_silent_prefix + '' + taskconfrec + "@" + ext_context;
				var conf_rec_start_html = "<a href=\"#\" onclick=\"conf_send_recording('MonitorConf','" + taskconfrec + "','');return false;\"><IMG SRC=\"../agc/images/vdc_LB_startrecording_it.gif\" border=0 alt=\"Inizia la Registrazione\"></a>";
				document.getElementById("RecorDControl").innerHTML = conf_rec_start_html;
				}
			confmonitor_query = "server_ip=" + server_ip + "&session_name=" + session_name + "&user=" + user + "&pass=" + pass + "&ACTION=" + taskconfrectype + "&format=text&channel=" + channelrec + "&filename=" + filename + "&exten=" + query_recording_exten + "&ext_context=" + ext_context + "&ext_priority=1";
			xmlhttp.open('POST', 'manager_send.php'); 
			xmlhttp.setRequestHeader('Content-Type','application/x-www-form-urlencoded; charset=UTF-8');
			xmlhttp.send(confmonitor_query); 
			xmlhttp.onreadystatechange = function() 
				{ 
				if (xmlhttp.readyState == 4 && xmlhttp.status == 200) 
					{
					var RClookResponse = null;
			//	document.getElementById("busycallsdebug").innerHTML = confmonitor_query;
			//		alert(xmlhttp.responseText);
					RClookResponse = xmlhttp.responseText;
					var RClookResponse_array=RClookResponse.split("\n");
					var RClookFILE = RClookResponse_array[1];
					var RClookID = RClookResponse_array[2];
					var RClookFILE_array = RClookFILE.split("Filename: ");
					var RClookID_array = RClookID.split("RecorDing_ID: ");
					if (RClookID_array.length > 0)
						{
						var RecDispNamE = RClookFILE_array[1];
						if (RecDispNamE.length > 25)
							{
							RecDispNamE = RecDispNamE.substr(0,22);
							RecDispNamE = RecDispNamE + '...';
							}
						document.getElementById("RecorDingFilename").innerHTML = RecDispNamE;
						document.getElementById("RecorDID").innerHTML = RClookID_array[1];
						}
					}
				}
			delete xmlhttp;
			}
		}

// ################################################################################
// Send Redirect command for live call to Manager sends phone name where call is going to
// Covers the following types: TRASF, VMAIL, ENTRY, CONF, PARK, FROMPARK, XfeRLOCAL, XfeRINTERNAL, XfeRBLIND, VfeRVMAIL
	function mainxfer_send_redirect(taskvar,taskxferconf,taskserverip) 
		{
		var xmlhttp=false;
		/*@cc_on @*/
		/*@if (@_jscript_version >= 5)
		// JScript gives us Conditional compilation, we can cope with old IE versions.
		// and security blocked creation of the objects.
		 try {
		  xmlhttp = new ActiveXObject("Msxml2.XMLHTTP");
		 } catch (e) {
		  try {
		   xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
		  } catch (E) {
		   xmlhttp = false;
		  }
		 }
		@end @*/
		if (!xmlhttp && typeof XMLHttpRequest!='undefined')
			{
			xmlhttp = new XMLHttpRequest();
			}
		if (xmlhttp) 
			{ 
			var redirectvalue = MDchannel;
			var redirectserverip = lastcustserverip;
			if (redirectvalue.length < 2)
				{redirectvalue = lastcustchannel}
			if ( (taskvar == 'XfeRBLIND') || (taskvar == 'XfeRVMAIL') )
				{
				var queryCID = "XBvdcW" + epoch_sec + user_abb;
				var blindxferdialstring = document.vicidial_form.xfernumber.value;
				if (document.vicidial_form.xferoverride.checked==false)
					{
					if (blindxferdialstring.length=='11')
						{blindxferdialstring = dial_prefix + "" + blindxferdialstring;}
					 else
						{
						if (blindxferdialstring.length=='10')
							{blindxferdialstring = dial_prefix + "1" + blindxferdialstring;}
						 else
							{
							if (blindxferdialstring.length=='7')
								{blindxferdialstring = dial_prefix + ""  + blindxferdialstring;}
							}
						}
					}
				if (taskvar == 'XfeRVMAIL')
					{var blindxferdialstring = campaign_am_message_exten;}
				if (blindxferdialstring.length<'2')
					{
					xferredirect_query='';
					taskvar = 'NOTHING';
					alert("Il numero per il trasferimento deve avere più di 1 carattere:" + blindxferdialstring);
					}
				else
					{
					xferredirect_query = "server_ip=" + server_ip + "&session_name=" + session_name + "&user=" + user + "&pass=" + pass + "&ACTION=RedirectVD&format=text&channel=" + redirectvalue + "&call_server_ip=" + redirectserverip + "&queryCID=" + queryCID + "&exten=" + blindxferdialstring + "&ext_context=" + ext_context + "&ext_priority=1&auto_dial_level=" + auto_dial_level + "&campaign=" + campaign + "&uniqueid=" + document.vicidial_form.uniqueid.value + "&lead_id=" + document.vicidial_form.lead_id.value + "&secondS=" + VD_live_call_secondS;
					}
				}
			if (taskvar == 'XfeRINTERNAL') 
				{
				var closerxferinternal = '';
				taskvar = 'XfeRLOCAL';
				}
			else 
				{
				var closerxferinternal = '9';
				}
			if (taskvar == 'XfeRLOCAL')
				{
				var closerxfercamptail = '_L' + document.vicidial_form.xfercode.value;
				var queryCID = "XLvdcW" + epoch_sec + user_abb;
				// 		 "90009*CL_$campaign$park_exten_suffix**$lead_id**$phone_number*$user*";
				var redirectdestination = closerxferinternal + '90009*CL_' + campaign + '' + closerxfercamptail + '**' + document.vicidial_form.lead_id.value + '**' + document.vicidial_form.phone_number.value + '*' + user + '*';

				xferredirect_query = "server_ip=" + server_ip + "&session_name=" + session_name + "&user=" + user + "&pass=" + pass + "&ACTION=RedirectVD&format=text&channel=" + redirectvalue + "&call_server_ip=" + redirectserverip + "&queryCID=" + queryCID + "&exten=" + redirectdestination + "&ext_context=" + ext_context + "&ext_priority=1&auto_dial_level=" + auto_dial_level + "&campaign=" + campaign + "&uniqueid=" + document.vicidial_form.uniqueid.value + "&lead_id=" + document.vicidial_form.lead_id.value + "&secondS=" + VD_live_call_secondS;
				}
			if (taskvar == 'XfeR')
				{
				var queryCID = "LRvdcW" + epoch_sec + user_abb;
				var redirectdestination = document.vicidial_form.extension_xfer.value;
				xferredirect_query = "server_ip=" + server_ip + "&session_name=" + session_name + "&user=" + user + "&pass=" + pass + "&ACTION=RedirectName&format=text&channel=" + redirectvalue + "&call_server_ip=" + redirectserverip + "&queryCID=" + queryCID + "&extenName=" + redirectdestination + "&ext_context=" + ext_context + "&ext_priority=1";
				}
			if (taskvar == 'VMAIL')
				{
				var queryCID = "LVvdcW" + epoch_sec + user_abb;
				var redirectdestination = document.vicidial_form.extension_xfer.value;
				xferredirect_query = "server_ip=" + server_ip + "&session_name=" + session_name + "&user=" + user + "&pass=" + pass + "&ACTION=RedirectNameVmail&format=text&channel=" + redirectvalue + "&call_server_ip=" + redirectserverip + "&queryCID=" + queryCID + "&exten=" + voicemail_dump_exten + "&extenName=" + redirectdestination + "&ext_context=" + ext_context + "&ext_priority=1";
				}
			if (taskvar == 'ENTRY')
				{
				var queryCID = "LEvdcW" + epoch_sec + user_abb;
				var redirectdestination = document.vicidial_form.extension_xfer_entry.value;
				xferredirect_query = "server_ip=" + server_ip + "&session_name=" + session_name + "&user=" + user + "&pass=" + pass + "&ACTION=Redirect&format=text&channel=" + redirectvalue + "&call_server_ip=" + redirectserverip + "&queryCID=" + queryCID + "&exten=" + redirectdestination + "&ext_context=" + ext_context + "&ext_priority=1";
				}
			if (taskvar == '3WAY')
				{
				var queryCID = "VXvdcW" + epoch_sec + user_abb;
				var redirectdestination = "NEXTAVAILABLE";
				var redirectXTRAvalue = XDchannel;
				xferredirect_query = "server_ip=" + server_ip + "&session_name=" + session_name + "&user=" + user + "&pass=" + pass + "&ACTION=RedirectXtra&format=text&channel=" + redirectvalue + "&call_server_ip=" + redirectserverip + "&queryCID=" + queryCID + "&exten=" + redirectdestination + "&ext_context=" + ext_context + "&ext_priority=1&extrachannel=" + redirectXTRAvalue;
				}
			if (taskvar == 'ParK')
				{
				var queryCID = "LPvdcW" + epoch_sec + user_abb;
				var redirectdestination = taskxferconf;
				var redirectdestserverip = taskserverip;
				var parkedby = protocol + "/" + extension;
				xferredirect_query = "server_ip=" + server_ip + "&session_name=" + session_name + "&user=" + user + "&pass=" + pass + "&ACTION=RedirectToPark&format=text&channel=" + redirectdestination + "&call_server_ip=" + redirectdestserverip + "&queryCID=" + queryCID + "&exten=" + park_on_extension + "&ext_context=" + ext_context + "&ext_priority=1&extenName=park&parkedby=" + parkedby;

				document.getElementById("ParkControl").innerHTML ="<a href=\"#\" onclick=\"mainxfer_send_redirect('FROMParK','" + redirectdestination + "','" + redirectdestserverip + "');return false;\"><IMG SRC=\"../agc/images/vdc_LB_grabparkedcall_it.gif\" border=0 alt=\"Riprendi la chiamata parcheggiata\"></a>";
				customerparked=1;
				}
			if (taskvar == 'FROMParK')
				{
				var queryCID = "FPvdcW" + epoch_sec + user_abb;
				var redirectdestination = taskxferconf;
				var redirectdestserverip = taskserverip;

				if( (server_ip == taskserverip) && (taskserverip.length > 6) )
					{var dest_dialstring = session_id;}
				else
					{
					if(taskserverip.length > 6)
						{var dest_dialstring = server_ip_dialstring + "" + session_id;}
					else
						{var dest_dialstring = session_id;}
					}

				xferredirect_query = "server_ip=" + server_ip + "&session_name=" + session_name + "&user=" + user + "&pass=" + pass + "&ACTION=RedirectFromPark&format=text&channel=" + redirectdestination + "&call_server_ip=" + redirectdestserverip + "&queryCID=" + queryCID + "&exten=" + dest_dialstring + "&ext_context=" + ext_context + "&ext_priority=1";

				document.getElementById("ParkControl").innerHTML ="<a href=\"#\" onclick=\"mainxfer_send_redirect('ParK','" + redirectdestination + "','" + redirectdestserverip + "');return false;\"><IMG SRC=\"../agc/images/vdc_LB_parkcall_it.gif\" border=0 alt=\"Parcheggia la chiamata\"></a>";
				customerparked=0;
				}


			xmlhttp.open('POST', 'manager_send.php'); 
			xmlhttp.setRequestHeader('Content-Type','application/x-www-form-urlencoded; charset=UTF-8');
			xmlhttp.send(xferredirect_query); 
			xmlhttp.onreadystatechange = function() 
				{ 
				if (xmlhttp.readyState == 4 && xmlhttp.status == 200) 
					{
					Nactiveext = null;
					Nactiveext = xmlhttp.responseText;
			//		alert(xmlhttp.responseText);
					hideMainXfeR();
					}
				}
			delete xmlhttp;
			}
		if ( (taskvar == 'XfeRLOCAL') || (taskvar == 'XfeRBLIND') || (taskvar == 'XfeRVMAIL') )
			{
			document.vicidial_form.callchannel.value = '';
			document.vicidial_form.callserverip.value = '';
			if( document.images ) { document.images['livecall'].src = image_livecall_OFF.src;}
			dialedcall_send_hangup();
			}

		}

// ################################################################################
// Finish the alternate dialing and move su to disposition the call
	function ManualDialAltDonE()
		{
		alt_phone_dialing=starting_alt_phone_dialing;
		alt_dial_active = 0;
		open_dispo_screen=1;
		document.getElementById("MainStatuSSpan").innerHTML = "Chiama il numero seguente";
		}
// ################################################################################
// Insert or update the vicidial_log entry for a customer call
	function DialLog(taskMDstage)
		{
		if (taskMDstage == "start") {var MDlogEPOCH = 0;}
		else
			{
			if (alt_phone_dialing == 1)
				{
				if (document.vicidial_form.DiaLAltPhonE.checked==true)
					{
					reselect_alt_dial = 1;
					alt_dial_active = 1;
					var man_status = "Chiama Alt Numero: <a href=\"#\" onclick=\"ManualDialOnly('MaiNPhonE')\"><font class=\"preview_text\">TELEFONO PRINCIPALE</font></a> or <a href=\"#\" onclick=\"ManualDialOnly('ALTTelefonoE')\"><font class=\"preview_text\">ALT TELEFONO</font></a> or <a href=\"#\" onclick=\"ManualDialOnly('AddresS3')\"><font class=\"preview_text\">INDIRIZZO3</font></a> or <a href=\"#\" onclick=\"ManualDialAltDonE()\"><font class=\"preview_text_red\">CONTATTO FINITO</font></a>"; 
					document.getElementById("MainStatuSSpan").innerHTML = man_status;
					}
				}
			}
		var xmlhttp=false;
		/*@cc_on @*/
		/*@if (@_jscript_version >= 5)
		// JScript gives us Conditional compilation, we can cope with old IE versions.
		// and security blocked creation of the objects.
		 try {
		  xmlhttp = new ActiveXObject("Msxml2.XMLHTTP");
		 } catch (e) {
		  try {
		   xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
		  } catch (E) {
		   xmlhttp = false;
		  }
		 }
		@end @*/
		if (!xmlhttp && typeof XMLHttpRequest!='undefined')
			{
			xmlhttp = new XMLHttpRequest();
			}
		if (xmlhttp) 
			{ 
			manDiaLlog_query = "server_ip=" + server_ip + "&session_name=" + session_name + "&ACTION=manDiaLlogCaLL&stage=" + taskMDstage + "&uniqueid=" + document.vicidial_form.uniqueid.value + 
			"&user=" + user + "&pass=" + pass + "&campaign=" + campaign + 
			"&lead_id=" + document.vicidial_form.lead_id.value + 
			"&list_id=" + document.vicidial_form.list_id.value + 
			"&length_in_sec=0&phone_code=" + document.vicidial_form.phone_code.value + 
			"&phone_number=" + lead_dial_number + 
			"&exten=" + extension + "&channel=" + lastcustchannel + "&start_epoch=" + MDlogEPOCH + "&auto_dial_level=" + auto_dial_level + "&VDstop_rec_after_each_call=" + VDstop_rec_after_each_call + "&conf_silent_prefix=" + conf_silent_prefix + "&protocol=" + protocol + "&extension=" + extension + "&ext_context=" + ext_context + "&conf_exten=" + session_id + "&user_abb=" + user_abb + "&agent_log_id=" + agent_log_id;
			xmlhttp.open('POST', 'vdc_db_query.php'); 
			xmlhttp.setRequestHeader('Content-Type','application/x-www-form-urlencoded; charset=UTF-8');
		//		document.getElementById("busycallsdebug").innerHTML = "vdc_db_query.php?" + manDiaLlog_query;
			xmlhttp.send(manDiaLlog_query); 
			xmlhttp.onreadystatechange = function() 
				{ 
				if (xmlhttp.readyState == 4 && xmlhttp.status == 200) 
					{
					var MDlogResponse = null;
				//	alert(xmlhttp.responseText);
					MDlogResponse = xmlhttp.responseText;
					var MDlogResponse_array=MDlogResponse.split("\n");
					MDlogLINE = MDlogResponse_array[0];
					if ( (MDlogLINE == "LOG NON INSERITO") && (VDstop_rec_after_each_call != 1) )
						{
				//		alert("error: log not entered\n");
						}
					else
						{
						MDlogEPOCH = MDlogResponse_array[1];
				//		alert("VICICHIAMA Call log entered:\n" + document.vicidial_form.uniqueid.value);
						if ( (taskMDstage != "start") && (VDstop_rec_after_each_call == 1) )
							{
							var conf_rec_start_html = "<a href=\"#\" onclick=\"conf_send_recording('MonitorConf','" + session_id + "','');return false;\"><IMG SRC=\"../agc/images/vdc_LB_startrecording_it.gif\" border=0 alt=\"Inizia la Registrazione\"></a>";
							if (campaign_recording == 'NEVER')
								{
								document.getElementById("RecorDControl").innerHTML = "<IMG SRC=\"../agc/images/vdc_LB_startrecording_OFF.gif\" border=0 alt=\"Inizia la Registrazione\">";
								}
							else
								{document.getElementById("RecorDControl").innerHTML = conf_rec_start_html;}
							
							MDlogRecorDings = MDlogResponse_array[3];
							if (window.MDlogRecorDings)
								{
								var MDlogRecorDings_array=MDlogRecorDings.split("|");
								var RecDispNamE = MDlogRecorDings_array[2];
								if (RecDispNamE.length > 25)
									{
									RecDispNamE = RecDispNamE.substr(0,22);
									RecDispNamE = RecDispNamE + '...';
									}
								document.getElementById("RecorDingFilename").innerHTML = RecDispNamE;
								document.getElementById("RecorDID").innerHTML = MDlogRecorDings_array[3];
								}
							}
						}
					}
				}
			delete xmlhttp;
			}
		}


// ################################################################################
// Request number of USERONLY callbacks for this agent
	function CalLBacKsCounTCheck()
		{
		var xmlhttp=false;
		/*@cc_on @*/
		/*@if (@_jscript_version >= 5)
		// JScript gives us Conditional compilation, we can cope with old IE versions.
		// and security blocked creation of the objects.
		 try {
		  xmlhttp = new ActiveXObject("Msxml2.XMLHTTP");
		 } catch (e) {
		  try {
		   xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
		  } catch (E) {
		   xmlhttp = false;
		  }
		 }
		@end @*/
		if (!xmlhttp && typeof XMLHttpRequest!='undefined')
			{
			xmlhttp = new XMLHttpRequest();
			}
		if (xmlhttp) 
			{ 
			CBcount_query = "server_ip=" + server_ip + "&session_name=" + session_name + "&user=" + user + "&pass=" + pass + "&ACTION=CalLBacKCounT&format=text";
			xmlhttp.open('POST', 'vdc_db_query.php'); 
			xmlhttp.setRequestHeader('Content-Type','application/x-www-form-urlencoded; charset=UTF-8');
			xmlhttp.send(CBcount_query); 
			xmlhttp.onreadystatechange = function() 
				{ 
				if (xmlhttp.readyState == 4 && xmlhttp.status == 200) 
					{
				//	alert(xmlhttp.responseText);
					var CBcounT = xmlhttp.responseText;
					if (CBcounT == 0) {var CBprint = "NO";}
					else {var CBprint = CBcounT;}
						document.getElementById("CBstatusSpan").innerHTML ="<a href=\"#\" onclick=\"CalLBacKsLisTCheck();return false;\">" + CBprint + " RICHIAMATE ATTIVE</a>";
						
					}
				}
			delete xmlhttp;
			}
		}


// ################################################################################
// Request list of USERONLY callbacks for this agent
	function CalLBacKsLisTCheck()
		{
		if ( (AutoDialWaiting == 1) || (VD_live_customer_call==1) || (alt_dial_active==1) )
			{
			alert("DOVETE ESSERE IN PAUSA PER CONTROLLARE LE RICHIAMATE IN MODALITA AUTOMATICA");
			}
		else
			{
			showDiv('CallBacKsLisTBox');

			var xmlhttp=false;
			/*@cc_on @*/
			/*@if (@_jscript_version >= 5)
			// JScript gives us Conditional compilation, we can cope with old IE versions.
			// and security blocked creation of the objects.
			 try {
			  xmlhttp = new ActiveXObject("Msxml2.XMLHTTP");
			 } catch (e) {
			  try {
			   xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
			  } catch (E) {
			   xmlhttp = false;
			  }
			 }
			@end @*/
			if (!xmlhttp && typeof XMLHttpRequest!='undefined')
				{
				xmlhttp = new XMLHttpRequest();
				}
			if (xmlhttp) 
				{ 
				var CBlist_query = "server_ip=" + server_ip + "&session_name=" + session_name + "&user=" + user + "&pass=" + pass + "&ACTION=CalLBacKLisT&format=text";
				xmlhttp.open('POST', 'vdc_db_query.php'); 
				xmlhttp.setRequestHeader('Content-Type','application/x-www-form-urlencoded; charset=UTF-8');
				xmlhttp.send(CBlist_query); 
				xmlhttp.onreadystatechange = function() 
					{ 
					if (xmlhttp.readyState == 4 && xmlhttp.status == 200) 
						{
					//	alert(xmlhttp.responseText);
						var all_CBs = null;
						all_CBs = xmlhttp.responseText;
						var all_CBs_array=all_CBs.split("\n");
						var CB_calls = all_CBs_array[0];
						var loop_ct=0;
						var conv_start=0;
						var CB_HTML = "<table width=610><tr bgcolor=#E6E6E6><td><font class=\"log_title\">#</td><td><font class=\"log_title\"> CHIAMATABACK DATE/TIME</td><td><font class=\"log_title\">NUMERO</td><td><font class=\"log_title\">NAME</td><td><font class=\"log_title\">STATUS</td><td align=right><font class=\"log_title\">CAMPAIGN</td><td><font class=\"log_title\">LAST DATE/TIME DI CHIAMATA</td><td align=left><font class=\"log_title\"> COMMENTS</td></tr>"
						while (loop_ct < CB_calls)
							{
							loop_ct++;
							loop_s = loop_ct.toString();
							if (loop_s.match(/1$|3$|5$|7$|9$/)) 
								{var row_color = '#DDDDFF';}
							else
								{var row_color = '#CCCCFF';}
							var conv_ct = (loop_ct + conv_start);
							var call_array = all_CBs_array[conv_ct].split(" ~");
							var CB_name = call_array[0] + " " + call_array[1];
							var CB_phone = call_array[2];
							var CB_id = call_array[3];
							var CB_lead_id = call_array[4];
							var CB_campaign = call_array[5];
							var CB_status = call_array[6];
							var CB_lastcall_time = call_array[7];
							var CB_callback_time = call_array[8];
							var CB_comments = call_array[9];
							CB_HTML = CB_HTML + "<tr bgcolor=\"" + row_color + "\"><td><font class=\"log_text\">" + loop_ct + "</td><td><font class=\"log_text\">" + CB_callback_time + "</td><td><font class=\"log_text\"><a href=\"#\" onclick=\"new_callback_call('" + CB_id + "','" + CB_lead_id + "');return false;\">" + CB_phone + "</a></td><td><font class=\"log_text\">" + CB_name + "</td><td><font class=\"log_text\">" + CB_status + "</td><td><font class=\"log_text\">" + CB_campaign + "</td><td align=right><font class=\"log_text\">" + CB_lastcall_time + "&nbsp;</td><td align=right><font class=\"log_text\">" + CB_comments + "&nbsp;</td></tr>";
					
							}
						CB_HTML = CB_HTML + "</table>";
						document.getElementById("CallBacKsLisT").innerHTML = CB_HTML;
						}
					}
				delete xmlhttp;
				}
			}
		}


// ################################################################################
// Open up a callback customer record as manual dial preview mode
	function new_callback_call(taskCBid,taskLEADid)
		{
		alt_phone_dialing=1;
		auto_dial_level=0;
		manual_dial_in_progress=1;
		MainPanelToFront();
		buildDiv('DiaLLeaDPrevieW');
		buildDiv('DiaLDiaLAltPhonE');
		document.vicidial_form.LeadPreview.checked=true;
		document.vicidial_form.DiaLAltPhonE.checked=true;
		hideDiv('CallBacKsLisTBox');
		ManualDialNext(taskCBid,taskLEADid,'','','');
		}


// ################################################################################
// Finish Callback and go back to original screen
	function manual_dial_finished()
		{
		alt_phone_dialing=starting_alt_phone_dialing;
		auto_dial_level=starting_dial_level;
		MainPanelToFront();
		CalLBacKsCounTCheck();
		manual_dial_in_progress=0;
		}


// ################################################################################
// Open page to enter details for a new manual dial lead
	function NeWManuaLDiaLCalL()
		{
		if ( (AutoDialWaiting == 1) || (VD_live_customer_call==1) || (alt_dial_active==1) )
			{
			alert("DEVI METTERE IN PAUSA LA CHIAMATA MANUALE PER ESEGUIRE UNA CHIAMATA DEL CONTATTO IN AUTOMATICO");
			}
		else
			{
			showDiv('NeWManuaLDiaLBox');
			}
		}


// ################################################################################
// Insert the new manual dial as a lead and go to manual dial screen
	function NeWManuaLDiaLCalLSubmiT()
		{
		hideDiv('NeWManuaLDiaLBox');
		var MDDiaLCodEform = document.vicidial_form.MDDiaLCodE.value;
		var MDPhonENumbeRform = document.vicidial_form.MDPhonENumbeR.value;
		var MDDiaLOverridEform = document.vicidial_form.MDDiaLOverridE.value;
		var MDLookuPLeaD = 'new';
		if (document.vicidial_form.LeadLookuP.checked==true)
			{MDLookuPLeaD = 'lookup';}

		if (MDDiaLOverridEform.length > 0)
			{
			basic_originate_call(session_id,'NO','YES',MDDiaLOverridEform,'YES');
			}
		else
			{
			alt_phone_dialing=1;
			auto_dial_level=0;
			manual_dial_in_progress=1;
			MainPanelToFront();
			buildDiv('DiaLLeaDPrevieW');
			buildDiv('DiaLDiaLAltPhonE');
			document.vicidial_form.LeadPreview.checked=true;
			document.vicidial_form.DiaLAltPhonE.checked=true;
			ManualDialNext("","",MDDiaLCodEform,MDPhonENumbeRform,MDLookuPLeaD);
			}

		document.vicidial_form.MDPhonENumbeR.value = '';
		document.vicidial_form.MDDiaLOverridE.value = '';
		}


// ################################################################################
// Request lookup of manual dial channel
	function ManualDialCheckChanneL(taskCheckOR)
		{
		if (taskCheckOR == 'YES')
			{
			var CIDcheck = XDnextCID;
			}
		else
			{
			var CIDcheck = MDnextCID;
			}
		var xmlhttp=false;
		/*@cc_on @*/
		/*@if (@_jscript_version >= 5)
		// JScript gives us Conditional compilation, we can cope with old IE versions.
		// and security blocked creation of the objects.
		 try {
		  xmlhttp = new ActiveXObject("Msxml2.XMLHTTP");
		 } catch (e) {
		  try {
		   xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
		  } catch (E) {
		   xmlhttp = false;
		  }
		 }
		@end @*/
		if (!xmlhttp && typeof XMLHttpRequest!='undefined')
			{
			xmlhttp = new XMLHttpRequest();
			}
		if (xmlhttp) 
			{ 
			manDiaLlook_query = "server_ip=" + server_ip + "&session_name=" + session_name + "&ACTION=manDiaLlookCaLL&conf_exten=" + session_id + "&user=" + user + "&pass=" + pass + "&MDnextCID=" + CIDcheck + "&agent_log_id=" + agent_log_id + "&lead_id=" + document.vicidial_form.lead_id.value;
			xmlhttp.open('POST', 'vdc_db_query.php'); 
			xmlhttp.setRequestHeader('Content-Type','application/x-www-form-urlencoded; charset=UTF-8');
			xmlhttp.send(manDiaLlook_query); 
			xmlhttp.onreadystatechange = function() 
				{ 
				if (xmlhttp.readyState == 4 && xmlhttp.status == 200) 
					{
					var MDlookResponse = null;
				//	alert(xmlhttp.responseText);
					MDlookResponse = xmlhttp.responseText;
					var MDlookResponse_array=MDlookResponse.split("\n");
					var MDlookCID = MDlookResponse_array[0];
					if (MDlookCID == "NO")
						{
						MD_ring_secondS++;
						document.getElementById("MainStatuSSpan").innerHTML = " In Chiamata: " + lead_dial_number + " UID: " + CIDcheck + " &nbsp; Attendi lo squillo... " + MD_ring_secondS + " secondi";
				//		alert("channel not found yet:\n" + campaign);
						}
					else
						{
						var regMDL = new RegExp("^Local","ig");
						if (taskCheckOR == 'YES')
							{
							XDuniqueid = MDlookResponse_array[0];
							XDchannel = MDlookResponse_array[1];
							if ( (XDchannel.match(regMDL)) && (asterisk_version != '1.0.8') && (asterisk_version != '1.0.9') )
								{
								// bad grab of Local channel, try again
								MD_ring_secondS++;
								}
							else
								{
								document.vicidial_form.xferuniqueid.value	= MDlookResponse_array[0];
								document.vicidial_form.xferchannel.value	= MDlookResponse_array[1];
								lastxferchannel = MDlookResponse_array[1];
								document.vicidial_form.xferlength.value		= 0;

								XD_live_customer_call = 1;
								XD_live_call_secondS = 0;
								MD_channel_look=0;

								document.getElementById("MainStatuSSpan").innerHTML = " Chiamata l`altro chiamante: " + document.vicidial_form.xfernumber.value + " UID: " + CIDcheck;

								document.getElementById("Leave3WayCall").innerHTML ="<a href=\"#\" onclick=\"leave_3way_call();return false;\"><IMG SRC=\"../agc/images/vdc_XB_leave3waycall_it.gif\" border=0 alt=\"LASCIA LA CONFERENZA\"></a>";

								document.getElementById("DialWithCustomer").innerHTML ="<IMG SRC=\"../agc/images/vdc_XB_dialwithcustomer_OFF_it.gif\" border=0 alt=\"Chiama il Cliente\">";

								document.getElementById("ParkCustomerDial").innerHTML ="<IMG SRC=\"../agc/images/vdc_XB_parkcustomerdial_OFF_it.gif\" border=0 alt=\"Parcheggia il cliente in chiamata\">";

								document.getElementById("HangupXferLine").innerHTML ="<a href=\"#\" onclick=\"xfercall_send_hangup();return false;\"><IMG SRC=\"../agc/images/vdc_XB_hangupxferline_it.gif\" border=0 alt=\"Attacca la linea trasferita\"></a>";

								document.getElementById("HangupBothLines").innerHTML ="<a href=\"#\" onclick=\"bothcall_send_hangup();return false;\"><IMG SRC=\"../agc/images/vdc_XB_hangupbothlines_it.gif\" border=0 alt=\"Attacca ciascun linea\"></a>";

								xferchannellive=1;
								XDcheck = '';
								}
							}
						else
							{
							MDuniqueid = MDlookResponse_array[0];
							MDchannel = MDlookResponse_array[1];
							if ( (MDchannel.match(regMDL)) && (asterisk_version != '1.0.8') && (asterisk_version != '1.0.9') )
								{
								// bad grab of Local channel, try again
								MD_ring_secondS++;
								}
							else
								{
								custchannellive=1;

								document.vicidial_form.uniqueid.value		= MDlookResponse_array[0];
								document.vicidial_form.callchannel.value	= MDlookResponse_array[1];
								lastcustchannel = MDlookResponse_array[1];
								if( document.images ) { document.images['livecall'].src = image_livecall_ON.src;}
								document.vicidial_form.SecondS.value		= 0;

								VD_live_customer_call = 1;
								VD_live_call_secondS = 0;

								MD_channel_look=0;
								document.getElementById("MainStatuSSpan").innerHTML = " Chiamato: " + lead_dial_number + " UID: " + CIDcheck + " &nbsp;"; 

								document.getElementById("ParkControl").innerHTML ="<a href=\"#\" onclick=\"mainxfer_send_redirect('ParK','" + lastcustchannel + "','" + lastcustserverip + "');return false;\"><IMG SRC=\"../agc/images/vdc_LB_parkcall_it.gif\" border=0 alt=\"Parcheggia la chiamata\"></a>";

								document.getElementById("HangupControl").innerHTML = "<a href=\"#\" onclick=\"dialedcall_send_hangup();\"><IMG SRC=\"../agc/images/vdc_LB_hangupcustomer_it.gif\" border=0 alt=\"Disconnetti il cliente\"></a>";

								document.getElementById("XferControl").innerHTML = "<a href=\"#\" onclick=\"ShoWTransferMain('ON');\"><IMG SRC=\"../agc/images/vdc_LB_transferconf_it.gif\" border=0 alt=\"Trasferimento - Conferenza\"></a>";

								document.getElementById("LocalCloser").innerHTML = "<a href=\"#\" onclick=\"mainxfer_send_redirect('XfeRLOCAL','" + lastcustchannel + "','" + lastcustserverip + "');return false;\"><IMG SRC=\"../agc/images/vdc_XB_localcloser_it.gif\" border=0 alt=\"LOCALE PIÙ VICINO\"></a>";

								document.getElementById("InternalCloser").innerHTML = "<a href=\"#\" onclick=\"mainxfer_send_redirect('XfeRINTERNAL','" + lastcustchannel + "','" + lastcustserverip + "');return false;\"><IMG SRC=\"../agc/images/vdc_XB_internalcloser_it.gif\" border=0 alt=\"INTERNO PIU` VICINO\"></a>";

								document.getElementById("DialBlindTransfer").innerHTML = "<a href=\"#\" onclick=\"mainxfer_send_redirect('XfeRBLIND','" + lastcustchannel + "','" + lastcustserverip + "');return false;\"><IMG SRC=\"../agc/images/vdc_XB_blindtransfer_it.gif\" border=0 alt=\"Effettua il trasferimento cieco \"></a>";

								document.getElementById("DialBlindVMail").innerHTML = "<a href=\"#\" onclick=\"mainxfer_send_redirect('XfeRVMAIL','" + lastcustchannel + "','" + lastcustserverip + "');return false;\"><IMG SRC=\"../agc/images/vdc_XB_ammessage.gif\" border=0 alt=\"Blind Transfer VMail Message\"></a>";


								// INSERT VICICHIAMA_LOG ENTRY FOR THIS CHIAMATA PROCESS
								DialLog("start");

								custchannellive=1;
								}
							}
						}
					}
				}
			delete xmlhttp;
			}

		if (MD_ring_secondS > 49) 
			{
			MD_channel_look=0;
			MD_ring_secondS=0;
			alert("Tempo di chiamata scaduto, contatta l`amministratore del sistema\n");
			}

		}

// ################################################################################
// Send the Manual Chiama il numero seguente request
	function ManualDialNext(mdnCBid,mdnBDleadid,mdnDiaLCodE,mdnPhonENumbeR,mdnStagE)
		{
		all_record = 'NO';
		document.getElementById("DiaLControl").innerHTML = "<IMG SRC=\"../agc/images/vdc_LB_dialnextnumber_OFF_it.gif\" border=0 alt=\"Chiama il numero seguente\">";
		if (document.vicidial_form.LeadPreview.checked==true)
			{
			reselect_preview_dial = 1;
			var man_preview = 'YES';
			var man_status = "Anteprima del contatto <a href=\"#\" onclick=\"ManualDialOnly()\"><font class=\"preview_text\">CHIAMA CONTATTO</font></a> or <a href=\"#\" onclick=\"ManualDialSkip()\"><font class=\"preview_text\">SALTA CONTATTO</font></a>"; 
			}
		else
			{
			reselect_preview_dial = 0;
			var man_preview = 'NO';
			var man_status = "Attendi lo squillo..."; 
			}

		var xmlhttp=false;
		/*@cc_on @*/
		/*@if (@_jscript_version >= 5)
		// JScript gives us Conditional compilation, we can cope with old IE versions.
		// and security blocked creation of the objects.
		 try {
		  xmlhttp = new ActiveXObject("Msxml2.XMLHTTP");
		 } catch (e) {
		  try {
		   xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
		  } catch (E) {
		   xmlhttp = false;
		  }
		 }
		@end @*/
		if (!xmlhttp && typeof XMLHttpRequest!='undefined')
			{
			xmlhttp = new XMLHttpRequest();
			}
		if (xmlhttp) 
			{ 
			manDiaLnext_query = "server_ip=" + server_ip + "&session_name=" + session_name + "&ACTION=manDiaLnextCaLL&conf_exten=" + session_id + "&user=" + user + "&pass=" + pass + "&campaign=" + campaign + "&ext_context=" + ext_context + "&dial_timeout=" + dial_timeout + "&dial_prefix=" + dial_prefix + "&campaign_cid=" + campaign_cid + "&preview=" + man_preview + "&agent_log_id=" + agent_log_id + "&callback_id=" + mdnCBid + "&lead_id=" + mdnBDleadid + "&phone_code=" + mdnDiaLCodE + "&phone_number=" + mdnPhonENumbeR + "&list_id=" + mdnLisT_id + "&stage=" + mdnStagE  + "&use_internal_dnc=" + use_internal_dnc ;
			xmlhttp.open('POST', 'vdc_db_query.php'); 
			xmlhttp.setRequestHeader('Content-Type','application/x-www-form-urlencoded; charset=UTF-8');
			xmlhttp.send(manDiaLnext_query); 
			xmlhttp.onreadystatechange = function() 
				{ 
				if (xmlhttp.readyState == 4 && xmlhttp.status == 200) 
					{
					var MDnextResponse = null;
				//	alert(xmlhttp.responseText);
					MDnextResponse = xmlhttp.responseText;

					var MDnextResponse_array=MDnextResponse.split("\n");
					MDnextCID = MDnextResponse_array[0];
					if ( (MDnextCID == "LISTA DI CHIAMATA VUOTA") || (MDnextCID == "DNC NUMERO") )
						{
						if (MDnextCID == "LISTA DI CHIAMATA VUOTA")
							{alert("Non ci sono contatti nella lista per la campagna:\n" + campaign);}
						else
							{alert("This phone number is in the DNC list:\n" + mdnPhonENumbeR);}
						}
					else
						{
						fronter = user;
						document.vicidial_form.lead_id.value			= MDnextResponse_array[1];
						LeaDPreVDispO									= MDnextResponse_array[2];
						document.vicidial_form.vendor_lead_code.value	= MDnextResponse_array[4];
						document.vicidial_form.list_id.value			= MDnextResponse_array[5];
						document.vicidial_form.gmt_offset_now.value		= MDnextResponse_array[6];
						document.vicidial_form.phone_code.value			= MDnextResponse_array[7];
						document.vicidial_form.phone_number.value		= MDnextResponse_array[8];
						document.vicidial_form.title.value				= MDnextResponse_array[9];
						document.vicidial_form.first_name.value			= MDnextResponse_array[10];
						document.vicidial_form.middle_initial.value		= MDnextResponse_array[11];
						document.vicidial_form.last_name.value			= MDnextResponse_array[12];
						document.vicidial_form.address1.value			= MDnextResponse_array[13];
						document.vicidial_form.address2.value			= MDnextResponse_array[14];
						document.vicidial_form.address3.value			= MDnextResponse_array[15];
						document.vicidial_form.city.value				= MDnextResponse_array[16];
						document.vicidial_form.state.value				= MDnextResponse_array[17];
						document.vicidial_form.province.value			= MDnextResponse_array[18];
						document.vicidial_form.postal_code.value		= MDnextResponse_array[19];
						document.vicidial_form.country_code.value		= MDnextResponse_array[20];
						document.vicidial_form.gender.value				= MDnextResponse_array[21];
						document.vicidial_form.date_of_birth.value		= MDnextResponse_array[22];
						document.vicidial_form.alt_phone.value			= MDnextResponse_array[23];
						document.vicidial_form.email.value				= MDnextResponse_array[24];
						document.vicidial_form.security_phrase.value	= MDnextResponse_array[25];
						var REGcommentsNL = new RegExp("!N","g");
						MDnextResponse_array[26] = MDnextResponse_array[26].replace(REGcommentsNL, "\n");
						document.vicidial_form.comments.value			= MDnextResponse_array[26];
						document.vicidial_form.called_count.value		= MDnextResponse_array[27];
						previous_called_count							= MDnextResponse_array[27];
						previous_dispo									= MDnextResponse_array[2];

						lead_dial_number = document.vicidial_form.phone_number.value;
						document.getElementById("MainStatuSSpan").innerHTML = " In Chiamata: " + document.vicidial_form.phone_number.value + " UID: " + MDnextCID + " &nbsp; " + man_status;

						web_form_vars = 
						"lead_id=" + document.vicidial_form.lead_id.value + 
						"&vendor_id=" + document.vicidial_form.vendor_lead_code.value + 
						"&list_id=" + document.vicidial_form.list_id.value + 
						"&gmt_offset_now=" + document.vicidial_form.gmt_offset_now.value + 
						"&phone_code=" + document.vicidial_form.phone_code.value + 
						"&phone_number=" + document.vicidial_form.phone_number.value + 
						"&title=" + document.vicidial_form.title.value + 
						"&first_name=" + document.vicidial_form.first_name.value + 
						"&middle_initial=" + document.vicidial_form.middle_initial.value + 
						"&last_name=" + document.vicidial_form.last_name.value + 
						"&address1=" + document.vicidial_form.address1.value + 
						"&address2=" + document.vicidial_form.address2.value + 
						"&address3=" + document.vicidial_form.address3.value + 
						"&city=" + document.vicidial_form.city.value + 
						"&state=" + document.vicidial_form.state.value + 
						"&province=" + document.vicidial_form.province.value + 
						"&postal_code=" + document.vicidial_form.postal_code.value + 
						"&country_code=" + document.vicidial_form.country_code.value + 
						"&gender=" + document.vicidial_form.gender.value + 
						"&date_of_birth=" + document.vicidial_form.date_of_birth.value + 
						"&alt_phone=" + document.vicidial_form.alt_phone.value + 
						"&email=" + document.vicidial_form.email.value + 
						"&security_phrase=" + document.vicidial_form.security_phrase.value + 
						"&comments=" + document.vicidial_form.comments.value + 
						"&user=" + user + 
						"&pass=" + pass + 
						"&campaign=" + campaign + 
						"&phone_login=" + phone_login + 
						"&phone_pass=" + phone_pass + 
						"&fronter=" + fronter + 
						"&closer=" + user + 
						"&group=" + campaign + 
						"&channel_group=" + campaign + 
						"&SQLdate=" + SQLdate + 
						"&epoch=" + UnixTime + 
						"&uniqueid=" + document.vicidial_form.uniqueid.value + 
						"&customer_zap_channel=" + lastcustchannel + 
						"&server_ip=" + server_ip + 
						"&SIPexten=" + extension + 
						"&session_id=" + session_id + 
						"&phone=" + document.vicidial_form.phone_number.value + 
						"&parked_by=" + document.vicidial_form.lead_id.value +
						"&dispo=" + LeaDDispO;
						
// $VICICHIAMA_web_QUERY_STRING =~ s/ /+/gi;
// $VICICHIAMA_web_QUERY_STRING =~ s/\`|\~|\:|\;|\#|\'|\"|\{|\}|\(|\)|\*|\^|\%|\$|\!|\%|\r|\t|\n//gi;

						var regWFspace = new RegExp(" ","ig");
						web_form_vars = web_form_vars.replace(regWF, '');
						var regWF = new RegExp("\\`|\\~|\\:|\\;|\\#|\\'|\\\"|\\{|\\}|\\(|\\)|\\*|\\^|\\%|\\$|\\!|\\%|\\r|\\t|\\n","ig");
						web_form_vars = web_form_vars.replace(regWFspace, '+');
						web_form_vars = web_form_vars.replace(regWF, '');

						VDIC_web_form_address = VICIDiaL_web_form_address;

						if (LeaDPreVDispO == 'CALLBK')
							{
							document.getElementById("CusTInfOSpaN").innerHTML = " <B> PREVIOUS CHIAMATABACK </B>";
							document.getElementById("CusTInfOSpaN").style.background = CusTCB_bgcolor;
							}

						var regWFAvars = new RegExp("\\?","ig");
						if (VDIC_web_form_address.match(regWFAvars))
							{web_form_vars = '&' + web_form_vars}
						else
							{web_form_vars = '?' + web_form_vars}

						document.getElementById("WebFormSpan").innerHTML = "<a href=\"" + VDIC_web_form_address + web_form_vars + "\" target=\"vdcwebform\" onMouseOver=\"WebFormRefresH();\"><IMG SRC=\"../agc/images/vdc_LB_webform_it.gif\" border=0 alt=\"Interfacccia Web\"></a>\n";

						if (document.vicidial_form.LeadPreview.checked==false)
							{
							reselect_preview_dial = 0;
							MD_channel_look=1;
							custchannellive=1;

							document.getElementById("HangupControl").innerHTML = "<a href=\"#\" onclick=\"dialedcall_send_hangup();\"><IMG SRC=\"../agc/images/vdc_LB_hangupcustomer_it.gif\" border=0 alt=\"Disconnetti il cliente\"></a>";

							if (campaign_recording == 'ALLCALLS')
								{all_record = 'YES';}

							if ( (view_scripts == 1) && (campaign_script.length > 0) )
								{
								// test code for scripts output
								URLDecode(scriptnames[campaign_script],'NO');
								var textname = decoded;
								URLDecode(scripttexts[campaign_script],'YES');
								var texttext = decoded;
								var testscript = "<B>" + textname + "</B>\n\n<BR><BR>\n\n" + texttext;
								document.getElementById("ScriptContents").innerHTML = testscript;
								}

							if (get_call_launch == 'SCRIPT')
								{
								ScriptPanelToFront();
								}

							if (get_call_launch == 'WEBFORM')
								{
								window.open(VDIC_web_form_address + "" + web_form_vars, 'webform', 'toolbar=1,scrollbars=1,location=1,statusbar=1,menubar=1,resizable=1,width=640,height=450');
								}

							}
						else
							{
							reselect_preview_dial = 1;
							}
						}
					}
				}
			delete xmlhttp;
			}
		}


// ################################################################################
// Send the Manual Dial Skip
	function ManualDialSkip()
		{
		if (manual_dial_in_progress==1)
			{
			alert('NON PUOI SALTARE UNA RICHIAMATA O FARE UNA CHIAMATA. DEVI CHIAMARE IL CONTATTO');
			}
		else
			{
			document.getElementById("DiaLControl").innerHTML = "<IMG SRC=\"../agc/images/vdc_LB_dialnextnumber_OFF_it.gif\" border=0 alt=\"Chiama il numero seguente\">";

			var xmlhttp=false;
			/*@cc_on @*/
			/*@if (@_jscript_version >= 5)
			// JScript gives us Conditional compilation, we can cope with old IE versions.
			// and security blocked creation of the objects.
			 try {
			  xmlhttp = new ActiveXObject("Msxml2.XMLHTTP");
			 } catch (e) {
			  try {
			   xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
			  } catch (E) {
			   xmlhttp = false;
			  }
			 }
			@end @*/
			if (!xmlhttp && typeof XMLHttpRequest!='undefined')
				{
				xmlhttp = new XMLHttpRequest();
				}
			if (xmlhttp) 
				{ 
				manDiaLskip_query = "server_ip=" + server_ip + "&session_name=" + session_name + "&ACTION=manDiaLskip&conf_exten=" + session_id + "&user=" + user + "&pass=" + pass + "&lead_id=" + document.vicidial_form.lead_id.value + "&stage=" + previous_dispo + "&called_count=" + previous_called_count;
				xmlhttp.open('POST', 'vdc_db_query.php'); 
				xmlhttp.setRequestHeader('Content-Type','application/x-www-form-urlencoded; charset=UTF-8');
				xmlhttp.send(manDiaLskip_query); 
				xmlhttp.onreadystatechange = function() 
					{ 
					if (xmlhttp.readyState == 4 && xmlhttp.status == 200) 
						{
						var MDSnextResponse = null;
					//	alert(manDiaLskip_query);
					//	alert(xmlhttp.responseText);
						MDSnextResponse = xmlhttp.responseText;

						var MDSnextResponse_array=MDSnextResponse.split("\n");
						MDSnextCID = MDSnextResponse_array[0];
						if (MDSnextCID == "LEAD NOT REVERTED")
							{
							alert("Il contatto non è ritornato, c`è un errore  :\n" + MDSnextResponse);
							}
						else
							{
							document.vicidial_form.lead_id.value		='';
							document.vicidial_form.vendor_lead_code.value='';
							document.vicidial_form.list_id.value		='';
							document.vicidial_form.gmt_offset_now.value	='';
							document.vicidial_form.phone_code.value		='';
							document.vicidial_form.phone_number.value	='';
							document.vicidial_form.title.value			='';
							document.vicidial_form.first_name.value		='';
							document.vicidial_form.middle_initial.value	='';
							document.vicidial_form.last_name.value		='';
							document.vicidial_form.address1.value		='';
							document.vicidial_form.address2.value		='';
							document.vicidial_form.address3.value		='';
							document.vicidial_form.city.value			='';
							document.vicidial_form.state.value			='';
							document.vicidial_form.province.value		='';
							document.vicidial_form.postal_code.value	='';
							document.vicidial_form.country_code.value	='';
							document.vicidial_form.gender.value			='';
							document.vicidial_form.date_of_birth.value	='';
							document.vicidial_form.alt_phone.value		='';
							document.vicidial_form.email.value			='';
							document.vicidial_form.security_phrase.value='';
							document.vicidial_form.comments.value		='';
							document.vicidial_form.called_count.value	='';
							VDCL_group_id = '';
							fronter = '';
							previous_called_count = '';
							previous_dispo = '';
							custchannellive=1;

							document.getElementById("MainStatuSSpan").innerHTML = " Lead skipped, go su to next lead";

							document.getElementById("DiaLControl").innerHTML = "<a href=\"#\" onclick=\"ManualDialNext('','','','','');\"><IMG SRC=\"../agc/images/vdc_LB_dialnextnumber_it.gif\" border=0 alt=\"Chiama il numero seguente\"></a>";
							}
						}
					}
				delete xmlhttp;
				}
			}
		}


// ################################################################################
// Send the Manual Dial Only - dial the previewed lead
	function ManualDialOnly(taskaltnum)
		{
		all_record = 'NO';
		if (taskaltnum == 'ALTTelefonoE')
			{
			var manDiaLonly_num = document.vicidial_form.alt_phone.value;
			lead_dial_number = document.vicidial_form.alt_phone.value;
			}
		else
			{
			if (taskaltnum == 'AddresS3')
				{
				var manDiaLonly_num = document.vicidial_form.address3.value;
				lead_dial_number = document.vicidial_form.address3.value;
				}
			else
				{
				var manDiaLonly_num = document.vicidial_form.phone_number.value;
				lead_dial_number = document.vicidial_form.phone_number.value;
				}
			}
		var xmlhttp=false;
		/*@cc_on @*/
		/*@if (@_jscript_version >= 5)
		// JScript gives us Conditional compilation, we can cope with old IE versions.
		// and security blocked creation of the objects.
		 try {
		  xmlhttp = new ActiveXObject("Msxml2.XMLHTTP");
		 } catch (e) {
		  try {
		   xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
		  } catch (E) {
		   xmlhttp = false;
		  }
		 }
		@end @*/
		if (!xmlhttp && typeof XMLHttpRequest!='undefined')
			{
			xmlhttp = new XMLHttpRequest();
			}
		if (xmlhttp) 
			{ 
			manDiaLonly_query = "server_ip=" + server_ip + "&session_name=" + session_name + "&ACTION=manDiaLonly&conf_exten=" + session_id + "&user=" + user + "&pass=" + pass + "&lead_id=" + document.vicidial_form.lead_id.value + "&phone_number=" + manDiaLonly_num + "&phone_code=" + document.vicidial_form.phone_code.value + "&campaign=" + campaign + "&ext_context=" + ext_context + "&dial_timeout=" + dial_timeout + "&dial_prefix=" + dial_prefix + "&campaign_cid=" + campaign_cid;
			xmlhttp.open('POST', 'vdc_db_query.php'); 
			xmlhttp.setRequestHeader('Content-Type','application/x-www-form-urlencoded; charset=UTF-8');
			xmlhttp.send(manDiaLonly_query); 
			xmlhttp.onreadystatechange = function() 
				{ 
				if (xmlhttp.readyState == 4 && xmlhttp.status == 200) 
					{
					var MDOnextResponse = null;
			//		alert(xmlhttp.responseText);
					MDOnextResponse = xmlhttp.responseText;

					var MDOnextResponse_array=MDOnextResponse.split("\n");
					MDnextCID = MDOnextResponse_array[0];
					if (MDnextCID == " CHIAMATA NOT PLACED")
						{
						alert("chiamata non effettuata, c`è un errore:\n" + MDOnextResponse);
						}
					else
						{
						MD_channel_look=1;
						custchannellive=1;

						document.getElementById("MainStatuSSpan").innerHTML = " In Chiamata: " + manDiaLonly_num + " UID: " + MDnextCID + " &nbsp; Attendi lo squillo...";

						document.getElementById("HangupControl").innerHTML = "<a href=\"#\" onclick=\"dialedcall_send_hangup();\"><IMG SRC=\"../agc/images/vdc_LB_hangupcustomer_it.gif\" border=0 alt=\"Disconnetti il cliente\"></a>";

						if (campaign_recording == 'ALLCALLS')
							{all_record = 'YES';}

						if ( (view_scripts == 1) && (campaign_script.length > 0) )
							{
							// test code for scripts output
							URLDecode(scriptnames[campaign_script],'NO');
							var textname = decoded;
							URLDecode(scripttexts[campaign_script],'YES');
							var texttext = decoded;
							var testscript = "<B>" + textname + "</B>\n\n<BR><BR>\n\n" + texttext;
							document.getElementById("ScriptContents").innerHTML = testscript;
							}

						if (get_call_launch == 'SCRIPT')
							{
							ScriptPanelToFront();
							}

						if (get_call_launch == 'WEBFORM')
							{
							window.open(VDIC_web_form_address + "" + web_form_vars, 'webform', 'toolbar=1,scrollbars=1,location=1,statusbar=1,menubar=1,resizable=1,width=640,height=450');
							}

						}
					}
				}
			delete xmlhttp;
			}

		}


// ################################################################################
// Set the client to READY and start looking for calls (VDADready, VDADpause)
	function AutoDial_ReSume_PauSe(taskaction,taskagentlog)
		{
		if (taskaction == 'VDADready')
			{
			var VDRP_stage = 'READY';
			if (INgroupCOUNT > 0)
				{
				if (VICIDiaL_closer_blended == 0)
					{VDRP_stage = 'CLOSER';}
				else 
					{VDRP_stage = 'READY';}
				}
			AutoDialReady = 1;
			AutoDialWaiting = 1;
			document.getElementById("DiaLControl").innerHTML = DiaLControl_auto_HTML_ready;
			}
		else
			{
			var VDRP_stage = 'PAUSED';
			AutoDialReady = 0;
			AutoDialWaiting = 0;
			document.getElementById("DiaLControl").innerHTML = DiaLControl_auto_HTML;
			}

		var xmlhttp=false;
		/*@cc_on @*/
		/*@if (@_jscript_version >= 5)
		// JScript gives us Conditional compilation, we can cope with old IE versions.
		// and security blocked creation of the objects.
		 try {
		  xmlhttp = new ActiveXObject("Msxml2.XMLHTTP");
		 } catch (e) {
		  try {
		   xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
		  } catch (E) {
		   xmlhttp = false;
		  }
		 }
		@end @*/
		if (!xmlhttp && typeof XMLHttpRequest!='undefined')
			{
			xmlhttp = new XMLHttpRequest();
			}
		if (xmlhttp) 
			{ 
			autoDiaLready_query = "server_ip=" + server_ip + "&session_name=" + session_name + "&ACTION=" + taskaction + "&user=" + user + "&pass=" + pass + "&stage=" + VDRP_stage + "&agent_log_id=" + agent_log_id + "&agent_log=" + taskagentlog;
			xmlhttp.open('POST', 'vdc_db_query.php'); 
			xmlhttp.setRequestHeader('Content-Type','application/x-www-form-urlencoded; charset=UTF-8');
			xmlhttp.send(autoDiaLready_query); 
			xmlhttp.onreadystatechange = function() 
				{ 
				if (xmlhttp.readyState == 4 && xmlhttp.status == 200) 
					{
			//		alert(xmlhttp.responseText);
					}
				}
			delete xmlhttp;
			}
		}


// ################################################################################
// Check to see if there is a call being sent from the auto-dialer to agent conf
	function check_for_auto_incoming()
		{
		all_record = 'NO';
		document.vicidial_form.lead_id.value = '';
		var xmlhttp=false;
		/*@cc_on @*/
		/*@if (@_jscript_version >= 5)
		// JScript gives us Conditional compilation, we can cope with old IE versions.
		// and security blocked creation of the objects.
		 try {
		  xmlhttp = new ActiveXObject("Msxml2.XMLHTTP");
		 } catch (e) {
		  try {
		   xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
		  } catch (E) {
		   xmlhttp = false;
		  }
		 }
		@end @*/
		if (!xmlhttp && typeof XMLHttpRequest!='undefined')
			{
			xmlhttp = new XMLHttpRequest();
			}
		if (xmlhttp) 
			{ 
			checkVDAI_query = "server_ip=" + server_ip + "&session_name=" + session_name + "&user=" + user + "&pass=" + pass + "&campaign=" + campaign + "&ACTION=VDADcheckINCOMING" + "&agent_log_id=" + agent_log_id;
			xmlhttp.open('POST', 'vdc_db_query.php'); 
			xmlhttp.setRequestHeader('Content-Type','application/x-www-form-urlencoded; charset=UTF-8');
			xmlhttp.send(checkVDAI_query); 
			xmlhttp.onreadystatechange = function() 
				{ 
				if (xmlhttp.readyState == 4 && xmlhttp.status == 200) 
					{
					var check_incoming = null;
					check_incoming = xmlhttp.responseText;
				//	alert(checkVDAI_query);
				//	alert(xmlhttp.responseText);
					var check_VDIC_array=check_incoming.split("\n");
					if (check_VDIC_array[0] == '1')
						{
				//		alert(xmlhttp.responseText);
						AutoDialWaiting = 0;

						var VDIC_data_VDAC=check_VDIC_array[1].split("|");
						VDIC_web_form_address = VICIDiaL_web_form_address
						var VDIC_fronter='';

						var VDIC_data_VDIG=check_VDIC_array[2].split("|");
						if (VDIC_data_VDIG[0].length > 5)
							{VDIC_web_form_address = VDIC_data_VDIG[0];}
						var VDCL_group_name			= VDIC_data_VDIG[1];
						var VDCL_group_color		= VDIC_data_VDIG[2];
						var VDCL_fronter_display	= VDIC_data_VDIG[3];
						 VDCL_group_id				= VDIC_data_VDIG[4];
						 CalL_ScripT_id				= VDIC_data_VDIG[5];
						 CalL_AutO_LauncH			= VDIC_data_VDIG[6];
						 CalL_XC_a_Dtmf				= VDIC_data_VDIG[7];
						 CalL_XC_a_NuMber			= VDIC_data_VDIG[8];
						 CalL_XC_b_Dtmf				= VDIC_data_VDIG[9];
						 CalL_XC_b_NuMber			= VDIC_data_VDIG[10];

						var VDIC_data_VDFR=check_VDIC_array[3].split("|");
						if ( (VDIC_data_VDFR[1].length > 1) && (VDCL_fronter_display == 'Y') )
							{VDIC_fronter = "  Fronter: " + VDIC_data_VDFR[0] + " - " + VDIC_data_VDFR[1];}
						
						document.vicidial_form.lead_id.value		= VDIC_data_VDAC[0];
						document.vicidial_form.uniqueid.value		= VDIC_data_VDAC[1];
						CIDcheck									= VDIC_data_VDAC[2];
						CalLCID										= VDIC_data_VDAC[2];
						document.vicidial_form.callchannel.value	= VDIC_data_VDAC[3];
						lastcustchannel = VDIC_data_VDAC[3];
						document.vicidial_form.callserverip.value	= VDIC_data_VDAC[4];
						lastcustserverip = VDIC_data_VDAC[4];
						if( document.images ) { document.images['livecall'].src = image_livecall_ON.src;}
						document.vicidial_form.SecondS.value		= 0;

						VD_live_customer_call = 1;
						VD_live_call_secondS = 0;

						// INSERT VICICHIAMA_LOG ENTRY FOR THIS CHIAMATA PROCESS
					//	DialLog("start");

						custchannellive=1;

						LeaDPreVDispO									= check_VDIC_array[6];
						fronter											= check_VDIC_array[7];
						document.vicidial_form.vendor_lead_code.value	= check_VDIC_array[8];
						document.vicidial_form.list_id.value			= check_VDIC_array[9];
						document.vicidial_form.gmt_offset_now.value		= check_VDIC_array[10];
						document.vicidial_form.phone_code.value			= check_VDIC_array[11];
						document.vicidial_form.phone_number.value		= check_VDIC_array[12];
						document.vicidial_form.title.value				= check_VDIC_array[13];
						document.vicidial_form.first_name.value			= check_VDIC_array[14];
						document.vicidial_form.middle_initial.value		= check_VDIC_array[15];
						document.vicidial_form.last_name.value			= check_VDIC_array[16];
						document.vicidial_form.address1.value			= check_VDIC_array[17];
						document.vicidial_form.address2.value			= check_VDIC_array[18];
						document.vicidial_form.address3.value			= check_VDIC_array[19];
						document.vicidial_form.city.value				= check_VDIC_array[20];
						document.vicidial_form.state.value				= check_VDIC_array[21];
						document.vicidial_form.province.value			= check_VDIC_array[22];
						document.vicidial_form.postal_code.value		= check_VDIC_array[23];
						document.vicidial_form.country_code.value		= check_VDIC_array[24];
						document.vicidial_form.gender.value				= check_VDIC_array[25];
						document.vicidial_form.date_of_birth.value		= check_VDIC_array[26];
						document.vicidial_form.alt_phone.value			= check_VDIC_array[27];
						document.vicidial_form.email.value				= check_VDIC_array[28];
						document.vicidial_form.security_phrase.value	= check_VDIC_array[29];
						var REGcommentsNL = new RegExp("!N","g");
						check_VDIC_array[30] = check_VDIC_array[30].replace(REGcommentsNL, "\n");
						document.vicidial_form.comments.value			= check_VDIC_array[30];
						document.vicidial_form.called_count.value		= check_VDIC_array[31];

						lead_dial_number = document.vicidial_form.phone_number.value;
						document.getElementById("MainStatuSSpan").innerHTML = " In entrata: " + document.vicidial_form.phone_number.value + " UID: " + CIDcheck + " &nbsp; " + VDIC_fronter; 

						if (LeaDPreVDispO == 'CALLBK')
							{
							document.getElementById("CusTInfOSpaN").innerHTML = " <B> PREVIOUS CHIAMATABACK </B>";
							document.getElementById("CusTInfOSpaN").style.background = CusTCB_bgcolor;
							}

						if (VDIC_data_VDIG[1].length > 0)
							{
							if (VDIC_data_VDIG[2].length > 2)
								{
								document.getElementById("MainStatuSSpan").style.background = VDIC_data_VDIG[2];
								}
							document.getElementById("MainStatuSSpan").innerHTML = " In entrata: " + document.vicidial_form.phone_number.value + " Group- " + VDIC_data_VDIG[1] + " &nbsp; " + VDIC_fronter; 
							}

						document.getElementById("ParkControl").innerHTML ="<a href=\"#\" onclick=\"mainxfer_send_redirect('ParK','" + lastcustchannel + "','" + lastcustserverip + "');return false;\"><IMG SRC=\"../agc/images/vdc_LB_parkcall_it.gif\" border=0 alt=\"Parcheggia la chiamata\"></a>";

						document.getElementById("HangupControl").innerHTML = "<a href=\"#\" onclick=\"dialedcall_send_hangup();\"><IMG SRC=\"../agc/images/vdc_LB_hangupcustomer_it.gif\" border=0 alt=\"Disconnetti il cliente\"></a>";

						document.getElementById("XferControl").innerHTML = "<a href=\"#\" onclick=\"ShoWTransferMain('ON');\"><IMG SRC=\"../agc/images/vdc_LB_transferconf_it.gif\" border=0 alt=\"Trasferimento - Conferenza\"></a>";

						document.getElementById("LocalCloser").innerHTML = "<a href=\"#\" onclick=\"mainxfer_send_redirect('XfeRLOCAL','" + lastcustchannel + "','" + lastcustserverip + "');return false;\"><IMG SRC=\"../agc/images/vdc_XB_localcloser_it.gif\" border=0 alt=\"LOCALE PIÙ VICINO\"></a>";

						document.getElementById("InternalCloser").innerHTML = "<a href=\"#\" onclick=\"mainxfer_send_redirect('XfeRINTERNAL','" + lastcustchannel + "','" + lastcustserverip + "');return false;\"><IMG SRC=\"../agc/images/vdc_XB_internalcloser_it.gif\" border=0 alt=\"INTERNO PIU` VICINO\"></a>";

						document.getElementById("DialBlindTransfer").innerHTML = "<a href=\"#\" onclick=\"mainxfer_send_redirect('XfeRBLIND','" + lastcustchannel + "','" + lastcustserverip + "');return false;\"><IMG SRC=\"../agc/images/vdc_XB_blindtransfer_it.gif\" border=0 alt=\"Effettua il trasferimento cieco \"></a>";

						document.getElementById("DialBlindVMail").innerHTML = "<a href=\"#\" onclick=\"mainxfer_send_redirect('XfeRVMAIL','" + lastcustchannel + "','" + lastcustserverip + "');return false;\"><IMG SRC=\"../agc/images/vdc_XB_ammessage.gif\" border=0 alt=\"Blind Transfer VMail Message\"></a>";
	
						document.getElementById("DiaLControl").innerHTML = DiaLControl_auto_HTML_OFF;

						if (VDCL_group_id.length > 1)
							{var group = VDCL_group_id;}
						else
							{var group = campaign;}

						web_form_vars = 
						"lead_id=" + document.vicidial_form.lead_id.value + 
						"&vendor_id=" + document.vicidial_form.vendor_lead_code.value + 
						"&list_id=" + document.vicidial_form.list_id.value + 
						"&gmt_offset_now=" + document.vicidial_form.gmt_offset_now.value + 
						"&phone_code=" + document.vicidial_form.phone_code.value + 
						"&phone_number=" + document.vicidial_form.phone_number.value + 
						"&title=" + document.vicidial_form.title.value + 
						"&first_name=" + document.vicidial_form.first_name.value + 
						"&middle_initial=" + document.vicidial_form.middle_initial.value + 
						"&last_name=" + document.vicidial_form.last_name.value + 
						"&address1=" + document.vicidial_form.address1.value + 
						"&address2=" + document.vicidial_form.address2.value + 
						"&address3=" + document.vicidial_form.address3.value + 
						"&city=" + document.vicidial_form.city.value + 
						"&state=" + document.vicidial_form.state.value + 
						"&province=" + document.vicidial_form.province.value + 
						"&postal_code=" + document.vicidial_form.postal_code.value + 
						"&country_code=" + document.vicidial_form.country_code.value + 
						"&gender=" + document.vicidial_form.gender.value + 
						"&date_of_birth=" + document.vicidial_form.date_of_birth.value + 
						"&alt_phone=" + document.vicidial_form.alt_phone.value + 
						"&email=" + document.vicidial_form.email.value + 
						"&security_phrase=" + document.vicidial_form.security_phrase.value + 
						"&comments=" + document.vicidial_form.comments.value + 
						"&user=" + user + 
						"&pass=" + pass + 
						"&campaign=" + campaign + 
						"&phone_login=" + phone_login + 
						"&phone_pass=" + phone_pass + 
						"&fronter=" + fronter + 
						"&closer=" + user + 
						"&group=" + group + 
						"&channel_group=" + group + 
						"&SQLdate=" + SQLdate + 
						"&epoch=" + UnixTime + 
						"&uniqueid=" + document.vicidial_form.uniqueid.value + 
						"&customer_zap_channel=" + lastcustchannel + 
						"&customer_server_ip=" + lastcustserverip +
						"&server_ip=" + server_ip + 
						"&SIPexten=" + extension + 
						"&session_id=" + session_id + 
						"&phone=" + document.vicidial_form.phone_number.value + 
						"&parked_by=" + document.vicidial_form.lead_id.value +
						"&dispo=" + LeaDDispO;
						
						var regWFspace = new RegExp(" ","ig");
						web_form_vars = web_form_vars.replace(regWF, '');
						var regWF = new RegExp("\\`|\\~|\\:|\\;|\\#|\\'|\\\"|\\{|\\}|\\(|\\)|\\*|\\^|\\%|\\$|\\!|\\%|\\r|\\t|\\n","ig");
						web_form_vars = web_form_vars.replace(regWFspace, '+');
						web_form_vars = web_form_vars.replace(regWF, '');

						var regWFAvars = new RegExp("\\?","ig");
						if (VDIC_web_form_address.match(regWFAvars))
							{web_form_vars = '&' + web_form_vars}
						else
							{web_form_vars = '?' + web_form_vars}

						document.getElementById("WebFormSpan").innerHTML = "<a href=\"" + VDIC_web_form_address + web_form_vars + "\" target=\"vdcwebform\" onMouseOver=\"WebFormRefresH();\"><IMG SRC=\"../agc/images/vdc_LB_webform_it.gif\" border=0 alt=\"Interfacccia Web\"></a>\n";

						if (campaign_recording == 'ALLCALLS')
							{all_record = 'YES';}

						if ( (view_scripts == 1) && (CalL_ScripT_id.length > 0) )
							{
							// test code for scripts output
							URLDecode(scriptnames[CalL_ScripT_id],'NO');
							var textname = decoded;
							URLDecode(scripttexts[CalL_ScripT_id],'YES');
							var texttext = decoded;
							var testscript = "<B>" + textname + "</B>\n\n<BR><BR>\n\n" + texttext;
							document.getElementById("ScriptContents").innerHTML = testscript;
							}

						if (CalL_AutO_LauncH == 'SCRIPT')
							{
							ScriptPanelToFront();
							}

						if (CalL_AutO_LauncH == 'WEBFORM')
							{
							window.open(VDIC_web_form_address + "" + web_form_vars, 'webform', 'toolbar=1,scrollbars=1,location=1,statusbar=1,menubar=1,resizable=1,width=640,height=450');
							}


						}
					else
						{
						// do nothing
						}
					}
				}
			delete xmlhttp;
			}
		}


// ################################################################################
// refresh the content of the web form URL
	function WebFormRefresH(taskrefresh) 
		{
		if (VDCL_group_id.length > 1)
			{var group = VDCL_group_id;}
		else
			{var group = campaign;}

		web_form_vars = 
		"lead_id=" + document.vicidial_form.lead_id.value + 
		"&vendor_id=" + document.vicidial_form.vendor_lead_code.value + 
		"&list_id=" + document.vicidial_form.list_id.value + 
		"&gmt_offset_now=" + document.vicidial_form.gmt_offset_now.value + 
		"&phone_code=" + document.vicidial_form.phone_code.value + 
		"&phone_number=" + document.vicidial_form.phone_number.value + 
		"&title=" + document.vicidial_form.title.value + 
		"&first_name=" + document.vicidial_form.first_name.value + 
		"&middle_initial=" + document.vicidial_form.middle_initial.value + 
		"&last_name=" + document.vicidial_form.last_name.value + 
		"&address1=" + document.vicidial_form.address1.value + 
		"&address2=" + document.vicidial_form.address2.value + 
		"&address3=" + document.vicidial_form.address3.value + 
		"&city=" + document.vicidial_form.city.value + 
		"&state=" + document.vicidial_form.state.value + 
		"&province=" + document.vicidial_form.province.value + 
		"&postal_code=" + document.vicidial_form.postal_code.value + 
		"&country_code=" + document.vicidial_form.country_code.value + 
		"&gender=" + document.vicidial_form.gender.value + 
		"&date_of_birth=" + document.vicidial_form.date_of_birth.value + 
		"&alt_phone=" + document.vicidial_form.alt_phone.value + 
		"&email=" + document.vicidial_form.email.value + 
		"&security_phrase=" + document.vicidial_form.security_phrase.value + 
		"&comments=" + document.vicidial_form.comments.value + 
		"&user=" + user + 
		"&pass=" + pass + 
		"&campaign=" + campaign + 
		"&phone_login=" + phone_login + 
		"&phone_pass=" + phone_pass + 
		"&fronter=" + fronter + 
		"&closer=" + user + 
		"&group=" + group + 
		"&channel_group=" + group + 
		"&SQLdate=" + SQLdate + 
		"&epoch=" + UnixTime + 
		"&uniqueid=" + document.vicidial_form.uniqueid.value + 
		"&customer_zap_channel=" + lastcustchannel + 
		"&customer_server_ip=" + lastcustserverip +
		"&server_ip=" + server_ip + 
		"&SIPexten=" + extension + 
		"&session_id=" + session_id + 
		"&phone=" + document.vicidial_form.phone_number.value + 
		"&parked_by=" + document.vicidial_form.lead_id.value +
		"&dispo=" + LeaDDispO;
		
		var regWFspace = new RegExp(" ","ig");
		web_form_vars = web_form_vars.replace(regWF, '');
		var regWF = new RegExp("\\`|\\~|\\:|\\;|\\#|\\'|\\\"|\\{|\\}|\\(|\\)|\\*|\\^|\\%|\\$|\\!|\\%|\\r|\\t|\\n","ig");
		web_form_vars = web_form_vars.replace(regWFspace, '+');
		web_form_vars = web_form_vars.replace(regWF, '');

		var regWFAvars = new RegExp("\\?","ig");
		if (VDIC_web_form_address.match(regWFAvars))
			{web_form_vars = '&' + web_form_vars}
		else
			{web_form_vars = '?' + web_form_vars}


		if (taskrefresh == 'OUT')
			{
			document.getElementById("WebFormSpan").innerHTML = "<a href=\"" + VDIC_web_form_address + web_form_vars + "\" target=\"vdcwebform\" onMouseOver=\"WebFormRefresH('IN');\"><IMG SRC=\"../agc/images/vdc_LB_webform_it.gif\" border=0 alt=\"Interfacccia Web\"></a>\n";
			}
		else 
			{
			document.getElementById("WebFormSpan").innerHTML = "<a href=\"" + VDIC_web_form_address + web_form_vars + "\" target=\"vdcwebform\" onMouseOut=\"WebFormRefresH('OUT');\"><IMG SRC=\"../agc/images/vdc_LB_webform_it.gif\" border=0 alt=\"Interfacccia Web\"></a>\n";
			}
		}


// ################################################################################
// Send hangup a second time from the dispo screen 
	function DispoHanguPAgaiN() 
	{
	form_cust_channel = AgaiNHanguPChanneL;
	document.vicidial_form.callchannel.value = AgaiNHanguPChanneL;
	document.vicidial_form.callserverip.value = AgaiNHanguPServeR;
	lastcustchannel = AgaiNHanguPChanneL;
	lastcustserverip = AgaiNHanguPServeR;
	VD_live_call_secondS = AgainCalLSecondS;
	CalLCID = AgaiNCalLCID;

	document.getElementById("DispoSelectHAspan").innerHTML = "";

	dialedcall_send_hangup();
	}


// ################################################################################
// Start Hangup Functions for both 
	function bothcall_send_hangup() 
		{
		if (lastcustchannel.length > 3)
			{dialedcall_send_hangup();}
		if (lastxferchannel.length > 3)
			{xfercall_send_hangup();}
		}

// ################################################################################
// Send Hangup command for customer call connected to the conference now to Manager
	function dialedcall_send_hangup(dispowindow) 
		{
		var form_cust_channel = document.vicidial_form.callchannel.value;
		var form_cust_serverip = document.vicidial_form.callserverip.value;
		var customer_channel = lastcustchannel;
		var customer_server_ip = lastcustserverip;
		AgaiNHanguPChanneL = lastcustchannel;
		AgaiNHanguPServeR = lastcustserverip;
		AgainCalLSecondS = VD_live_call_secondS;
		AgaiNCalLCID = CalLCID;
		var process_post_hangup=0;
		if (MD_channel_look==1)
			{
			MD_channel_look=0;
			DialTimeHangup();
			}
		if (form_cust_channel.length > 3)
			{
			var xmlhttp=false;
			/*@cc_on @*/
			/*@if (@_jscript_version >= 5)
			// JScript gives us Conditional compilation, we can cope with old IE versions.
			// and security blocked creation of the objects.
			 try {
			  xmlhttp = new ActiveXObject("Msxml2.XMLHTTP");
			 } catch (e) {
			  try {
			   xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
			  } catch (E) {
			   xmlhttp = false;
			  }
			 }
			@end @*/
			if (!xmlhttp && typeof XMLHttpRequest!='undefined')
				{
				xmlhttp = new XMLHttpRequest();
				}
			if (xmlhttp) 
				{ 
				var queryCID = "HLvdcW" + epoch_sec + user_abb;
				var hangupvalue = customer_channel;
				//		alert(auto_dial_level + "|" + CalLCID + "|" + customer_server_ip + "|" + hangupvalue + "|" + VD_live_call_secondS);
				custhangup_query = "server_ip=" + server_ip + "&session_name=" + session_name + "&ACTION=Hangup&format=text&user=" + user + "&pass=" + pass + "&channel=" + hangupvalue + "&call_server_ip=" + customer_server_ip + "&queryCID=" + queryCID + "&auto_dial_level=" + auto_dial_level + "&CalLCID=" + CalLCID + "&secondS=" + VD_live_call_secondS + "&exten=" + session_id;
				xmlhttp.open('POST', 'manager_send.php'); 
				xmlhttp.setRequestHeader('Content-Type','application/x-www-form-urlencoded; charset=UTF-8');
				xmlhttp.send(custhangup_query); 
				xmlhttp.onreadystatechange = function() 
					{ 
					if (xmlhttp.readyState == 4 && xmlhttp.status == 200) 
						{
						Nactiveext = null;
						Nactiveext = xmlhttp.responseText;
					//		alert(xmlhttp.responseText);
					//	var HU_debug = xmlhttp.responseText;
					//	var HU_debug_array=HU_debug.split(" ");
					//	if (HU_debug_array[0] == 'Call')
					//		{
					//		alert(xmlhttp.responseText);
					//		}

						}
					}
				process_post_hangup=1;
				delete xmlhttp;
				}
			}
			else {process_post_hangup=1;}
			if (process_post_hangup==1)
			{
			VD_live_customer_call = 0;
			VD_live_call_secondS = 0;
			MD_ring_secondS = 0;
			CalLCID = '';

		//	UPDATE VICICHIAMA_LOG ENTRY FOR THIS CHIAMATA PROCESS
			DialLog("end");
			if (dispowindow == 'NO')
				{
				open_dispo_screen=0;
				}
			else
				{
				if (auto_dial_level == 0)			
					{
					if (document.vicidial_form.DiaLAltPhonE.checked==true)
						{
						reselect_alt_dial = 1;
						open_dispo_screen=0;
						}
					else
						{
						reselect_alt_dial = 0;
						open_dispo_screen=1;
						}
					}
				else
					{
					if (document.vicidial_form.DiaLAltPhonE.checked==true)
						{
						reselect_alt_dial = 1;
						open_dispo_screen=0;
						auto_dial_level=0;
						manual_dial_in_progress=1;
						auto_dial_alt_dial=1;
						}
					else
						{
						reselect_alt_dial = 0;
						open_dispo_screen=1;
						}
					}
				}

		//  DEACTIVATE CHANNEL-DEPENDANT BUTTONS AND VARIABLES
			document.vicidial_form.callchannel.value = '';
			document.vicidial_form.callserverip.value = '';
			lastcustchannel='';
			lastcustserverip='';

			if( document.images ) { document.images['livecall'].src = image_livecall_OFF.src;}
			document.getElementById("WebFormSpan").innerHTML = "<IMG SRC=\"../agc/images/vdc_LB_webform_OFF_it.gif\" border=0 alt=\"Interfacccia Web\">";
			document.getElementById("ParkControl").innerHTML = "<IMG SRC=\"../agc/images/vdc_LB_parkcall_OFF_it.gif\" border=0 alt=\"Parcheggia la chiamata\">";
			document.getElementById("HangupControl").innerHTML = "<IMG SRC=\"../agc/images/vdc_LB_hangupcustomer_OFF_it.gif\" border=0 alt=\"Disconnetti il cliente\">";
			document.getElementById("XferControl").innerHTML = "<IMG SRC=\"../agc/images/vdc_LB_transferconf_OFF_it.gif\" border=0 alt=\"Trasferimento - Conferenza\">";
			document.getElementById("LocalCloser").innerHTML = "<IMG SRC=\"../agc/images/vdc_XB_localcloser_OFF_it.gif\" border=0 alt=\"LOCALE PIÙ VICINO\">";
			document.getElementById("InternalCloser").innerHTML = "<IMG SRC=\"../agc/images/vdc_XB_internalcloser_OFF_it.gif\" border=0 alt=\"INTERNO PIU` VICINO\">";
			document.getElementById("DialBlindTransfer").innerHTML = "<IMG SRC=\"../agc/images/vdc_XB_blindtransfer_OFF_it.gif\" border=0 alt=\"Effettua il trasferimento cieco \">";
			document.getElementById("DialBlindVMail").innerHTML = "<IMG SRC=\"../agc/images/vdc_XB_ammessage_OFF.gif\" border=0 alt=\"Blind Transfer VMail Message\">";
			
			document.vicidial_form.custdatetime.value		= '';

			if (auto_dial_level == 0)
				{
				if (document.vicidial_form.DiaLAltPhonE.checked==true)
					{
					reselect_alt_dial = 1;
					}
				else
					{
					document.getElementById("DiaLControl").innerHTML = "<a href=\"#\" onclick=\"ManualDialNext('','','','','');\"><IMG SRC=\"../agc/images/vdc_LB_dialnextnumber_it.gif\" border=0 alt=\"Chiama il numero seguente\"></a>";
					reselect_alt_dial = 0;
					}
				}
			else
				{
				if (document.vicidial_form.DiaLAltPhonE.checked==true)
					{
					reselect_alt_dial = 1;
					}
				else
					{
					document.getElementById("MainStatuSSpan").style.background = panel_bgcolor;
					document.getElementById("DiaLControl").innerHTML = DiaLControl_auto_HTML_OFF;
					reselect_alt_dial = 0;
					}
				}

			ShoWTransferMain('OFF');

			}
		}


// ################################################################################
// Send Hangup command for 3rd party call connected to the conference now to Manager
	function xfercall_send_hangup() 
		{
		var xferchannel = document.vicidial_form.xferchannel.value;
		var xfer_channel = lastxferchannel;
		var process_post_hangup=0;
		if (MD_channel_look==1)
			{
			MD_channel_look=0;
			DialTimeHangup();
			}
		if (xferchannel.length > 3)
			{
			var xmlhttp=false;
			/*@cc_on @*/
			/*@if (@_jscript_version >= 5)
			// JScript gives us Conditional compilation, we can cope with old IE versions.
			// and security blocked creation of the objects.
			 try {
			  xmlhttp = new ActiveXObject("Msxml2.XMLHTTP");
			 } catch (e) {
			  try {
			   xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
			  } catch (E) {
			   xmlhttp = false;
			  }
			 }
			@end @*/
			if (!xmlhttp && typeof XMLHttpRequest!='undefined')
				{
				xmlhttp = new XMLHttpRequest();
				}
			if (xmlhttp) 
				{ 
				var queryCID = "HXvdcW" + epoch_sec + user_abb;
				var hangupvalue = xfer_channel;
				custhangup_query = "server_ip=" + server_ip + "&session_name=" + session_name + "&ACTION=Hangup&format=text&user=" + user + "&pass=" + pass + "&channel=" + hangupvalue + "&queryCID=" + queryCID;
				xmlhttp.open('POST', 'manager_send.php'); 
				xmlhttp.setRequestHeader('Content-Type','application/x-www-form-urlencoded; charset=UTF-8');
				xmlhttp.send(custhangup_query); 
				xmlhttp.onreadystatechange = function() 
					{ 
					if (xmlhttp.readyState == 4 && xmlhttp.status == 200) 
						{
						Nactiveext = null;
						Nactiveext = xmlhttp.responseText;
				//		alert(xmlhttp.responseText);
						}
					}
				process_post_hangup=1;
				delete xmlhttp;
				}
			}
			else {process_post_hangup=1;}
			if (process_post_hangup==1)
			{
			XD_live_customer_call = 0;
			XD_live_call_secondS = 0;
			MD_ring_secondS = 0;
			MD_channel_look=0;
			XDnextCID = '';
			XDcheck = '';
			xferchannellive=0;

		//  DEACTIVATE CHANNEL-DEPENDANT BUTTONS AND VARIABLES
			document.vicidial_form.xferchannel.value = "";
			lastxferchannel='';

			document.getElementById("Leave3WayCall").innerHTML ="<IMG SRC=\"../agc/images/vdc_XB_leave3waycall_OFF_it.gif\" border=0 alt=\"LASCIA LA CONFERENZA\">";

			document.getElementById("DialWithCustomer").innerHTML ="<a href=\"#\" onclick=\"SendManualDial('YES');return false;\"><IMG SRC=\"../agc/images/vdc_XB_dialwithcustomer_it.gif\" border=0 alt=\"Chiama il Cliente\"></a>";

			document.getElementById("ParkCustomerDial").innerHTML ="<a href=\"#\" onclick=\"xfer_park_dial();return false;\"><IMG SRC=\"../agc/images/vdc_XB_parkcustomerdial_it.gif\" border=0 alt=\"Parcheggia il cliente in chiamata\"></a>";

			document.getElementById("HangupXferLine").innerHTML ="<IMG SRC=\"../agc/images/vdc_XB_hangupxferline_OFF_it.gif\" border=0 alt=\"Attacca la linea trasferita\">";

			document.getElementById("HangupBothLines").innerHTML ="<a href=\"#\" onclick=\"bothcall_send_hangup();return false;\"><IMG SRC=\"../agc/images/vdc_XB_hangupbothlines_it.gif\" border=0 alt=\"Attacca ciascun linea\"></a>";
			}
		}

// ################################################################################
// Send Hangup command for any Local call that is not in the quiet(7) entry - used to stop manual dials even if no connect
	function DialTimeHangup() 
		{
		MD_channel_look=0;
		var xmlhttp=false;
		/*@cc_on @*/
		/*@if (@_jscript_version >= 5)
		// JScript gives us Conditional compilation, we can cope with old IE versions.
		// and security blocked creation of the objects.
		 try {
		  xmlhttp = new ActiveXObject("Msxml2.XMLHTTP");
		 } catch (e) {
		  try {
		   xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
		  } catch (E) {
		   xmlhttp = false;
		  }
		 }
		@end @*/
		if (!xmlhttp && typeof XMLHttpRequest!='undefined')
			{
			xmlhttp = new XMLHttpRequest();
			}
		if (xmlhttp) 
			{ 
			var queryCID = "HTvdcW" + epoch_sec + user_abb;
			custhangup_query = "server_ip=" + server_ip + "&session_name=" + session_name + "&ACTION=HangupConfDial&format=text&user=" + user + "&pass=" + pass + "&exten=" + session_id + "&ext_context=" + ext_context + "&queryCID=" + queryCID;
			xmlhttp.open('POST', 'manager_send.php'); 
			xmlhttp.setRequestHeader('Content-Type','application/x-www-form-urlencoded; charset=UTF-8');
			xmlhttp.send(custhangup_query); 
			xmlhttp.onreadystatechange = function() 
				{ 
				if (xmlhttp.readyState == 4 && xmlhttp.status == 200) 
					{
					Nactiveext = null;
					Nactiveext = xmlhttp.responseText;
				//	alert(xmlhttp.responseText);
					}
				}
			delete xmlhttp;
			}
		}


// ################################################################################
// Update vicidial_list lead record with all altered values from form
	function CustomerData_update()
		{
		var xmlhttp=false;
		/*@cc_on @*/
		/*@if (@_jscript_version >= 5)
		// JScript gives us Conditional compilation, we can cope with old IE versions.
		// and security blocked creation of the objects.
		 try {
		  xmlhttp = new ActiveXObject("Msxml2.XMLHTTP");
		 } catch (e) {
		  try {
		   xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
		  } catch (E) {
		   xmlhttp = false;
		  }
		 }
		@end @*/
		if (!xmlhttp && typeof XMLHttpRequest!='undefined')
			{
			xmlhttp = new XMLHttpRequest();
			}
		if (xmlhttp) 
			{ 
			VLupdate_query = "server_ip=" + server_ip + "&session_name=" + session_name + "&ACTION=updateLEAD&format=text&user=" + user + "&pass=" + pass + 
			"&lead_id=" + document.vicidial_form.lead_id.value + 
			"&vendor_lead_code=" + document.vicidial_form.vendor_lead_code.value + 
			"&phone_number=" + document.vicidial_form.phone_number.value + 
			"&title=" + document.vicidial_form.title.value + 
			"&first_name=" + document.vicidial_form.first_name.value + 
			"&middle_initial=" + document.vicidial_form.middle_initial.value + 
			"&last_name=" + document.vicidial_form.last_name.value + 
			"&address1=" + document.vicidial_form.address1.value + 
			"&address2=" + document.vicidial_form.address2.value + 
			"&address3=" + document.vicidial_form.address3.value + 
			"&city=" + document.vicidial_form.city.value + 
			"&state=" + document.vicidial_form.state.value + 
			"&province=" + document.vicidial_form.province.value + 
			"&postal_code=" + document.vicidial_form.postal_code.value + 
			"&country_code=" + document.vicidial_form.country_code.value + 
			"&gender=" + document.vicidial_form.gender.value + 
			"&date_of_birth=" + document.vicidial_form.date_of_birth.value + 
			"&alt_phone=" + document.vicidial_form.alt_phone.value + 
			"&email=" + document.vicidial_form.email.value + 
			"&security_phrase=" + document.vicidial_form.security_phrase.value + 
			"&comments=" + document.vicidial_form.comments.value;
			xmlhttp.open('POST', 'vdc_db_query.php'); 
			xmlhttp.setRequestHeader('Content-Type','application/x-www-form-urlencoded; charset=UTF-8');
			xmlhttp.send(VLupdate_query); 
			xmlhttp.onreadystatechange = function() 
				{ 
				if (xmlhttp.readyState == 4 && xmlhttp.status == 200) 
					{
				//	alert(xmlhttp.responseText);
					}
				}
			delete xmlhttp;
			}

		}

// ################################################################################
// Generate the Call Disposition Chooser panel
	function DispoSelectContent_create(taskDSgrp,taskDSstage)
		{
		AgentDispoing = 1;
		var VD_statuses_ct_half = parseInt(VD_statuses_ct / 2);
		var dispo_HTML = "<table cellpadding=5 cellspacing=5 width=500><tr><td colspan=2><B> CHIAMATA DISPOSITION</B></td></tr><tr><td bgcolor=\"#99FF99\" height=300 width=240 valign=top><font class=\"log_text\"><span id=DispoSelectA>";
		var loop_ct = 0;
		while (loop_ct < VD_statuses_ct)
			{
			if (taskDSgrp == VARstatuses[loop_ct]) 
				{
				dispo_HTML = dispo_HTML + "<font size=3 style=\"BACKGROUND-COLOR: #FFFFCC\"><b><a href=\"#\" onclick=\"DispoSelect_submit();return false;\">" + VARstatuses[loop_ct] + " - " + VARstatusnames[loop_ct] + "</a></b></font><BR><BR>";
				}
			else
				{
				dispo_HTML = dispo_HTML + "<a href=\"#\" onclick=\"DispoSelectContent_create('" + VARstatuses[loop_ct] + "','ADD');return false;\">" + VARstatuses[loop_ct] + " - " + VARstatusnames[loop_ct] + "</a><BR><BR>";
				}
			if (loop_ct == VD_statuses_ct_half) 
				{dispo_HTML = dispo_HTML + "</span></font></td><td bgcolor=\"#99FF99\" height=300 width=240 valign=top><font class=\"log_text\"><span id=DispoSelectB>";}
			loop_ct++;
			}
		dispo_HTML = dispo_HTML + "</span></font></td></tr></table>";

		if (taskDSstage == 'ReSET') {document.vicidial_form.DispoSelection.value = '';}
		else {document.vicidial_form.DispoSelection.value = taskDSgrp;}
		
		document.getElementById("DispoSelectContent").innerHTML = dispo_HTML;
		}


// ################################################################################
// open web form, then submit disposition
	function WeBForMDispoSelect_submit()
		{
		var DispoChoice = document.vicidial_form.DispoSelection.value;

		if (DispoChoice.length < 1) {alert("Selezionare una Disposizione");}
		else
			{
			document.getElementById("CusTInfOSpaN").innerHTML = "";
			document.getElementById("CusTInfOSpaN").style.background = panel_bgcolor;

			LeaDDispO = DispoChoice;
	
			WebFormRefresH();

			window.open(VDIC_web_form_address + "" + web_form_vars, 'webform', 'toolbar=1,scrollbars=1,location=1,statusbar=1,menubar=1,resizable=1,width=640,height=450');

			DispoSelect_submit();
			}
		}


// ################################################################################
// Update vicidial_list lead record with disposition selection
	function DispoSelect_submit()
		{

		var DispoChoice = document.vicidial_form.DispoSelection.value;

		if (DispoChoice.length < 1) {alert("Selezionare una Disposizione");}
		else
			{
			document.getElementById("CusTInfOSpaN").innerHTML = "";
			document.getElementById("CusTInfOSpaN").style.background = panel_bgcolor;

			if ( (DispoChoice == 'CALLBK') && (scheduled_callbacks > 0) ) {showDiv('CallBackSelectBox');}
			else
				{
				var xmlhttp=false;
				/*@cc_on @*/
				/*@if (@_jscript_version >= 5)
				// JScript gives us Conditional compilation, we can cope with old IE versions.
				// and security blocked creation of the objects.
				 try {
				  xmlhttp = new ActiveXObject("Msxml2.XMLHTTP");
				 } catch (e) {
				  try {
				   xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
				  } catch (E) {
				   xmlhttp = false;
				  }
				 }
				@end @*/
				if (!xmlhttp && typeof XMLHttpRequest!='undefined')
					{
					xmlhttp = new XMLHttpRequest();
					}
				if (xmlhttp) 
					{ 
					DSupdate_query = "server_ip=" + server_ip + "&session_name=" + session_name + "&ACTION=updateDISPO&format=text&user=" + user + "&pass=" + pass + "&dispo_choice=" + DispoChoice + "&lead_id=" + document.vicidial_form.lead_id.value + "&campaign=" + campaign + "&auto_dial_level=" + auto_dial_level + "&agent_log_id=" + agent_log_id + "&CallBackDatETimE=" + CallBackDatETimE + "&list_id=" + document.vicidial_form.list_id.value + "&recipient=" + CallBackrecipient + "&use_internal_dnc=" + use_internal_dnc + "&comments=" + CallBackCommenTs;
					xmlhttp.open('POST', 'vdc_db_query.php'); 
					xmlhttp.setRequestHeader('Content-Type','application/x-www-form-urlencoded; charset=UTF-8');
					xmlhttp.send(DSupdate_query); 
					xmlhttp.onreadystatechange = function() 
						{ 
						if (xmlhttp.readyState == 4 && xmlhttp.status == 200) 
							{
							var check_dispo = null;
							check_dispo = xmlhttp.responseText;
						//	alert(xmlhttp.responseText);
							var check_DS_array=check_dispo.split("\n");
							if (check_DS_array[1] == 'Next agent_log_id:')
								{
								agent_log_id = check_DS_array[2];
								}
							}
						}
					delete xmlhttp;
					}
				// CLEAR ALL FORM VARIABLES
				document.vicidial_form.lead_id.value		='';
				document.vicidial_form.vendor_lead_code.value='';
				document.vicidial_form.list_id.value		='';
				document.vicidial_form.gmt_offset_now.value	='';
				document.vicidial_form.phone_code.value		='';
				document.vicidial_form.phone_number.value	='';
				document.vicidial_form.title.value			='';
				document.vicidial_form.first_name.value		='';
				document.vicidial_form.middle_initial.value	='';
				document.vicidial_form.last_name.value		='';
				document.vicidial_form.address1.value		='';
				document.vicidial_form.address2.value		='';
				document.vicidial_form.address3.value		='';
				document.vicidial_form.city.value			='';
				document.vicidial_form.state.value			='';
				document.vicidial_form.province.value		='';
				document.vicidial_form.postal_code.value	='';
				document.vicidial_form.country_code.value	='';
				document.vicidial_form.gender.value			='';
				document.vicidial_form.date_of_birth.value	='';
				document.vicidial_form.alt_phone.value		='';
				document.vicidial_form.email.value			='';
				document.vicidial_form.security_phrase.value='';
				document.vicidial_form.comments.value		='';
				document.vicidial_form.called_count.value	='';
				VDCL_group_id = '';
				fronter = '';

				if (manual_dial_in_progress==1)
					{
					manual_dial_finished();
					}
				hideDiv('DispoSelectBox');
				hideDiv('DispoButtonHideA');
				hideDiv('DispoButtonHideB');
				hideDiv('DispoButtonHideC');
				document.getElementById("DispoSelectBox").style.top = 1;
				document.getElementById("DispoSelectMaxMin").innerHTML = "<a href=\"#\" onclick=\"DispoMinimize()\">minimizza</a>";
				document.getElementById("DispoSelectHAspan").innerHTML = "<a href=\"#\" onclick=\"DispoHanguPAgaiN()\">Attacca ancora</a>";

				AgentDispoing = 0;

				if (wrapup_waiting == 0)
					{
					if (document.vicidial_form.DispoSelectStop.checked==true)
						{
						if (auto_dial_level != '0')
							{
							AutoDialWaiting = 0;
							AutoDial_ReSume_PauSe("VDADpause","NO");
					//		document.getElementById("DiaLControl").innerHTML = DiaLControl_auto_HTML;
							}
						VICIDiaL_pause_calling = 1;
						if (dispo_check_all_pause != '1')
							{
							document.vicidial_form.DispoSelectStop.checked=false;
							}
						}
					else
						{
						if (auto_dial_level != '0')
							{
							AutoDialWaiting = 1;
							AutoDial_ReSume_PauSe("VDADready","NO");
					//		document.getElementById("DiaLControl").innerHTML = DiaLControl_auto_HTML_ready;
							}
						}
					}
				}
			}
		}

// ################################################################################
// Populate the dtmf and xfer number for each preset link in xfer-conf frame
	function DtMf_PreSet_a()
		{
		document.vicidial_form.conf_dtmf.value = CalL_XC_a_Dtmf;
		document.vicidial_form.xfernumber.value = CalL_XC_a_NuMber;
		}
	function DtMf_PreSet_b()
		{
		document.vicidial_form.conf_dtmf.value = CalL_XC_b_Dtmf;
		document.vicidial_form.xfernumber.value = CalL_XC_b_NuMber;
		}
// ################################################################################
// Mostra message that customer has hungup the call before agent has
	function CustomerChanneLGone()
		{
		showDiv('CustomerGoneBox');

		document.vicidial_form.callchannel.value = '';
		document.vicidial_form.callserverip.value = '';
		document.getElementById("CustomerGoneChanneL").innerHTML = lastcustchannel;
		if( document.images ) { document.images['livecall'].src = image_livecall_OFF.src;}
		WaitingForNextStep=1;
		}
	function CustomerGoneOK()
		{
		hideDiv('CustomerGoneBox');
		WaitingForNextStep=0;
		custchannellive=0;
		}
	function CustomerGoneHangup()
		{
		hideDiv('CustomerGoneBox');
		WaitingForNextStep=0;
		custchannellive=0;

		dialedcall_send_hangup();
		}
// ################################################################################
// Mostra message that there are no voice channels in the VICICHIAMA session
	function NoneInSession()
		{
		showDiv('NoneInSessionBox');

		document.getElementById("NoneInSessionID").innerHTML = session_id;
		WaitingForNextStep=1;
		}
	function NoneInSessionOK()
		{
		hideDiv('NoneInSessionBox');
		WaitingForNextStep=0;
		nochannelinsession=0;
		}
	function NoneInSessionCalL()
		{
		hideDiv('NoneInSessionBox');
		WaitingForNextStep=0;
		nochannelinsession=0;

		if (protocol == 'EXTERNAL')
			{
			var protodial = 'Local';
			var extendial = extension + "@" + ext_context;
			}
		else
			{
			var protodial = protocol;
			var extendial = extension;
			}
		var originatevalue = protodial + "/" + extendial;
		var queryCID = "ACagcW" + epoch_sec + user_abb;

		var xmlhttp=false;
		/*@cc_on @*/
		/*@if (@_jscript_version >= 5)
		// JScript gives us Conditional compilation, we can cope with old IE versions.
		// and security blocked creation of the objects.
		 try {
		  xmlhttp = new ActiveXObject("Msxml2.XMLHTTP");
		 } catch (e) {
		  try {
		   xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
		  } catch (E) {
		   xmlhttp = false;
		  }
		 }
		@end @*/
		if (!xmlhttp && typeof XMLHttpRequest!='undefined')
			{
			xmlhttp = new XMLHttpRequest();
			}
		if (xmlhttp) 
			{ 
			VMCoriginate_query = "server_ip=" + server_ip + "&session_name=" + session_name + "&user=" + user + "&pass=" + pass  + "&ACTION=Originate&format=text&channel=" + originatevalue + "&queryCID=" + queryCID + "&exten=" + session_id + "&ext_context=" + ext_context + "&ext_priority=1";
			xmlhttp.open('POST', 'manager_send.php'); 
			xmlhttp.setRequestHeader('Content-Type','application/x-www-form-urlencoded; charset=UTF-8');
			xmlhttp.send(VMCoriginate_query); 
			xmlhttp.onreadystatechange = function() 
				{ 
				if (xmlhttp.readyState == 4 && xmlhttp.status == 200) 
					{
			//		alert(xmlhttp.responseText);
					}
				}
			delete xmlhttp;
			}
		if (auto_dial_level > 0)
			{
			AutoDial_ReSume_PauSe("VDADpause","NO");
			}
		}


// ################################################################################
// Generate the Closer In Group Chooser panel
	function CloserSelectContent_create()
		{
		if (VU_agent_choose_ingroups == '1')
			{
			var live_CSC_HTML = "<table cellpadding=5 cellspacing=5 width=500><tr><td><B>GRUPPI NON SELEZIONATI</B></td><td><B>GRUPPI SELEZIONATI</B></td></tr><tr><td bgcolor=\"#99FF99\" height=300 width=240 valign=top><font class=\"log_text\"><span id=CloserSelectAdd>";
			var loop_ct = 0;
			while (loop_ct < INgroupCOUNT)
				{
				live_CSC_HTML = live_CSC_HTML + "<a href=\"#\" onclick=\"CloserSelect_change('" + VARingroups[loop_ct] + "','ADD');return false;\">" + VARingroups[loop_ct] + "<BR>";
				loop_ct++;
				}
			live_CSC_HTML = live_CSC_HTML + "</span></font></td><td bgcolor=\"#99FF99\" height=300 width=240 valign=top><font class=\"log_text\"><span id=CloserSelectDelete></span></font></td></tr></table>";

			document.vicidial_form.CloserSelectList.value = '';
			document.getElementById("CloserSelectContent").innerHTML = live_CSC_HTML;
			}
		else
			{
			VU_agent_choose_ingroups_DV = "MGRLOCK";
			var live_CSC_HTML = "Manager has selected groups for you<BR>";
			document.vicidial_form.CloserSelectList.value = '';
			document.getElementById("CloserSelectContent").innerHTML = live_CSC_HTML;
			}
		}

// ################################################################################
// Move a Closer In Group record to the selected column or reverse
	function CloserSelect_change(taskCSgrp,taskCSchange)
		{
		var CloserSelectListValue = document.vicidial_form.CloserSelectList.value;
		var CSCchange = 0;
		var regCS = new RegExp(" "+taskCSgrp+" ","ig");
		if ( (CloserSelectListValue.match(regCS)) && (CloserSelectListValue.length > 3) )
			{
			if (taskCSchange == 'DELETE') {CSCchange = 1;}
			}
		else
			{
			if (taskCSchange == 'ADD') {CSCchange = 1;}
			}

	//	alert(taskCSgrp+"|"+taskCSchange+"|"+CloserSelectListValue.length+"|"+CSCchange+"|"+CSCcolumn)

		if (CSCchange==1) 
			{
			var loop_ct = 0;
			var CSCcolumn = '';
			var live_CSC_HTML_ADD = '';
			var live_CSC_HTML_DELETE = '';
			var live_CSC_LIST_value = " ";
			while (loop_ct < INgroupCOUNT)
				{
				var regCSL = new RegExp(" "+VARingroups[loop_ct]+" ","ig");
				if (CloserSelectListValue.match(regCSL)) {CSCcolumn = 'DELETE';}
				else {CSCcolumn = 'ADD';}
				if ( (VARingroups[loop_ct] == taskCSgrp) && (taskCSchange == 'DELETE') ) {CSCcolumn = 'ADD';}
				if ( (VARingroups[loop_ct] == taskCSgrp) && (taskCSchange == 'ADD') ) {CSCcolumn = 'DELETE';}
					

				if (CSCcolumn == 'DELETE')
					{
					live_CSC_HTML_DELETE = live_CSC_HTML_DELETE + "<a href=\"#\" onclick=\"CloserSelect_change('" + VARingroups[loop_ct] + "','DELETE');return false;\">" + VARingroups[loop_ct] + "<BR>";
					live_CSC_LIST_value = live_CSC_LIST_value + VARingroups[loop_ct] + " ";
					}
				else
					{
					live_CSC_HTML_ADD = live_CSC_HTML_ADD + "<a href=\"#\" onclick=\"CloserSelect_change('" + VARingroups[loop_ct] + "','ADD');return false;\">" + VARingroups[loop_ct] + "<BR>";
					}
				loop_ct++;
				}

			document.vicidial_form.CloserSelectList.value = live_CSC_LIST_value;
			document.getElementById("CloserSelectAdd").innerHTML = live_CSC_HTML_ADD;
			document.getElementById("CloserSelectDelete").innerHTML = live_CSC_HTML_DELETE;
			}
		}

// ################################################################################
// Update vicidial_live_agents record with closer in group choices
	function CloserSelect_submit()
		{
		if (document.vicidial_form.CloserSelectBlended.checked==true)
			{VICIDiaL_closer_blended = 1;}

		var CloserSelectChoices = document.vicidial_form.CloserSelectList.value;

		if (VU_agent_choose_ingroups_DV == "MGRLOCK")
			{CloserSelectChoices = "MGRLOCK";}

		var xmlhttp=false;
		/*@cc_on @*/
		/*@if (@_jscript_version >= 5)
		// JScript gives us Conditional compilation, we can cope with old IE versions.
		// and security blocked creation of the objects.
		 try {
		  xmlhttp = new ActiveXObject("Msxml2.XMLHTTP");
		 } catch (e) {
		  try {
		   xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
		  } catch (E) {
		   xmlhttp = false;
		  }
		 }
		@end @*/
		if (!xmlhttp && typeof XMLHttpRequest!='undefined')
			{
			xmlhttp = new XMLHttpRequest();
			}
		if (xmlhttp) 
			{ 
			CSCupdate_query = "server_ip=" + server_ip + "&session_name=" + session_name + "&ACTION=regCLOSER&format=text&user=" + user + "&pass=" + pass + "&comments=" + VU_agent_choose_ingroups_DV + "&closer_choice=" + CloserSelectChoices + "-";
			xmlhttp.open('POST', 'vdc_db_query.php'); 
			xmlhttp.setRequestHeader('Content-Type','application/x-www-form-urlencoded; charset=UTF-8');
			xmlhttp.send(CSCupdate_query); 
			xmlhttp.onreadystatechange = function() 
				{ 
				if (xmlhttp.readyState == 4 && xmlhttp.status == 200) 
					{
		//			alert(xmlhttp.responseText);
					}
				}
			delete xmlhttp;
			}

		hideDiv('CloserSelectBox');
		MainPanelToFront();
		CloserSelecting = 0;
		}


// ################################################################################
// Log the user out of the system, if active call or active dial is occuring, don't let them.
	function LogouT()
		{
		if (MD_channel_look==1)
			{alert("Non potete disconnettervi durante una chiamata in attesa. \nAttendere 50 secondi finchè la chiamata non è risposta");}
		else
			{
			if (VD_live_customer_call==1)
				{
				alert("CHIAMATA ATTIVA IN CORSO! Attaccate e poi sconettetevi.\n" + VD_live_customer_call);
				}
			else
				{
				var xmlhttp=false;
				/*@cc_on @*/
				/*@if (@_jscript_version >= 5)
				// JScript gives us Conditional compilation, we can cope with old IE versions.
				// and security blocked creation of the objects.
				 try {
				  xmlhttp = new ActiveXObject("Msxml2.XMLHTTP");
				 } catch (e) {
				  try {
				   xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
				  } catch (E) {
				   xmlhttp = false;
				  }
				 }
				@end @*/
				if (!xmlhttp && typeof XMLHttpRequest!='undefined')
					{
					xmlhttp = new XMLHttpRequest();
					}
				if (xmlhttp) 
					{ 
					VDlogout_query = "server_ip=" + server_ip + "&session_name=" + session_name + "&ACTION=userLOGout&format=text&user=" + user + "&pass=" + pass + "&campaign=" + campaign + "&conf_exten=" + session_id + "&extension=" + extension + "&protocol=" + protocol;
					xmlhttp.open('POST', 'vdc_db_query.php'); 
					xmlhttp.setRequestHeader('Content-Type','application/x-www-form-urlencoded; charset=UTF-8');
					xmlhttp.send(VDlogout_query); 
					xmlhttp.onreadystatechange = function() 
						{ 
						if (xmlhttp.readyState == 4 && xmlhttp.status == 200) 
							{
				//			alert(xmlhttp.responseText);
							}
						}
					delete xmlhttp;
					}

				hideDiv('MainPanel');
				showDiv('LogouTBox');

				document.getElementById("LogouTBoxLink").innerHTML = "<a href=\"" + agcPAGE + "?relogin=YES&session_epoch=" + epoch_sec + "&session_id=" + session_id + "&session_name=" + session_name + "&VD_login=" + user + "&VD_campaign=" + campaign + "&phone_login=" + phone_login + "&phone_pass=" + phone_pass + "&VD_pass=" + pass + "\">FAI CLICK QUI PER LOGGARTI DI NUOVO </a>\n";

				logout_stop_timeouts = 1;
					
				//	window.location= agcPAGE + "?relogin=YES&session_epoch=" + epoch_sec + "&session_id=" + session_id + "&session_name=" + session_name + "&VD_login=" + user + "&VD_campaign=" + campaign + "&phone_login=" + phone_login + "&phone_pass=" + phone_pass + "&VD_pass=" + pass;

				}
			}

		}

// ################################################################################
// hotkeypress function to bind hotkeys defined in the campaign to dispositions
	function hotkeypress(evt)
		{
		enter_disable();
		if ( (hot_keys_active==1) && (VD_live_customer_call==1) )
			{
			var e = evt? evt : window.event;
			if(!e) return;
			var key = 0;
			if (e.keyCode) { key = e.keyCode; } // for moz/fb, if keyCode==0 use 'which'
			else if (typeof(e.which)!= 'undefined') { key = e.which; }
			//
			var HKdispo = hotkeys[String.fromCharCode(key)];
			if (HKdispo) 
				{
				document.vicidial_form.inert_button.focus();
				document.vicidial_form.inert_button.blur();
				CustomerData_update();
				HKdispo_display = 4;
				HKfinish=1;
				var HKdispo_ary = HKdispo.split(" ----- ");
				document.getElementById("HotKeyDispo").innerHTML = HKdispo_ary[0] + " - " + HKdispo_ary[1];
				showDiv('HotKeyActionBox');
				hideDiv('HotKeyEntriesBox');
				document.vicidial_form.DispoSelection.value = HKdispo_ary[0];
				dialedcall_send_hangup('NO');
			//	DispoSelect_submit();
			//	AutoDialWaiting = 1;
			//	AutoDial_ReSume_PauSe("VDADready");
			//	alert(HKdispo + " - " + HKdispo_ary[0] + " - " + HKdispo_ary[1]);
				}
			}
		}

// ################################################################################
// disable enter/return keys to not clear out vars su customer info
	function enter_disable(evt)
		{
		var e = evt? evt : window.event;
		if(!e) return;
		var key = 0;
		if (e.keyCode) { key = e.keyCode; } // for moz/fb, if keyCode==0 use 'which'
		else if (typeof(e.which)!= 'undefined') { key = e.which; }
		return key != 13;
		}


// ################################################################################
// decode the scripttext and scriptname so that it can be didsplayed
	function URLDecode(encodedvar,scriptformat)
	{
	   // Replace %ZZ with equivalent character
	   // Put [ERR] in output if %ZZ is invalid.
	   var HEXCHAR = "0123456789ABCDEFabcdef"; 
	   var encoded = encodedvar;
	   decoded = '';
	   var i = 0;
	   if (scriptformat == 'YES')
		{
		var RGvendor_lead_code = new RegExp("--A--vendor_lead_code--B--","g");
		var RGsource_id = new RegExp("--A--source_id--B--","g");
		var RGlist_id = new RegExp("--A--list_id--B--","g");
		var RGgmt_offset_now = new RegExp("--A--gmt_offset_now--B--","g");
		var RGcalled_since_last_reset = new RegExp("--A--called_since_last_reset--B--","g");
		var RGphone_code = new RegExp("--A--phone_code--B--","g");
		var RGphone_number = new RegExp("--A--phone_number--B--","g");
		var RGtitle = new RegExp("--A--title--B--","g");
		var RGfirst_name = new RegExp("--A--first_name--B--","g");
		var RGmiddle_initial = new RegExp("--A--middle_initial--B--","g");
		var RGlast_name = new RegExp("--A--last_name--B--","g");
		var RGaddress1 = new RegExp("--A--address1--B--","g");
		var RGaddress2 = new RegExp("--A--address2--B--","g");
		var RGaddress3 = new RegExp("--A--address3--B--","g");
		var RGcity = new RegExp("--A--city--B--","g");
		var RGstate = new RegExp("--A--state--B--","g");
		var RGprovince = new RegExp("--A--province--B--","g");
		var RGpostal_code = new RegExp("--A--postal_code--B--","g");
		var RGcountry_code = new RegExp("--A--country_code--B--","g");
		var RGgender = new RegExp("--A--gender--B--","g");
		var RGdate_of_birth = new RegExp("--A--date_of_birth--B--","g");
		var RGalt_phone = new RegExp("--A--alt_phone--B--","g");
		var RGemail = new RegExp("--A--email--B--","g");
		var RGsecurity_phrase = new RegExp("--A--security_phrase--B--","g");
		var RGcomments = new RegExp("--A--comments--B--","g");
		var RGfullname = new RegExp("--A--fullname--B--","g");
		var RGfronter = new RegExp("--A--fronter--B--","g");
		var RGuser = new RegExp("--A--user--B--","g");
		var RGnl = new RegExp("\n","g");

		encoded = encoded.replace(RGvendor_lead_code, document.vicidial_form.vendor_lead_code.value);
		encoded = encoded.replace(RGsource_id, "");
		encoded = encoded.replace(RGlist_id, document.vicidial_form.list_id.value);
		encoded = encoded.replace(RGgmt_offset_now, document.vicidial_form.gmt_offset_now.value);
		encoded = encoded.replace(RGcalled_since_last_reset, "");
		encoded = encoded.replace(RGphone_code, document.vicidial_form.phone_code.value);
		encoded = encoded.replace(RGphone_number, document.vicidial_form.phone_number.value);
		encoded = encoded.replace(RGtitle, document.vicidial_form.title.value);
		encoded = encoded.replace(RGfirst_name, document.vicidial_form.first_name.value);
		encoded = encoded.replace(RGmiddle_initial, document.vicidial_form.middle_initial.value);
		encoded = encoded.replace(RGlast_name, document.vicidial_form.last_name.value);
		encoded = encoded.replace(RGaddress1, document.vicidial_form.address1.value);
		encoded = encoded.replace(RGaddress2, document.vicidial_form.address2.value);
		encoded = encoded.replace(RGaddress3, document.vicidial_form.address3.value);
		encoded = encoded.replace(RGcity, document.vicidial_form.city.value);
		encoded = encoded.replace(RGstate, document.vicidial_form.state.value);
		encoded = encoded.replace(RGprovince, document.vicidial_form.province.value);
		encoded = encoded.replace(RGpostal_code, document.vicidial_form.postal_code.value);
		encoded = encoded.replace(RGcountry_code, document.vicidial_form.country_code.value);
		encoded = encoded.replace(RGgender, document.vicidial_form.gender.value);
		encoded = encoded.replace(RGdate_of_birth, document.vicidial_form.date_of_birth.value);
		encoded = encoded.replace(RGalt_phone, document.vicidial_form.alt_phone.value);
		encoded = encoded.replace(RGemail, document.vicidial_form.email.value);
		encoded = encoded.replace(RGsecurity_phrase, document.vicidial_form.security_phrase.value);
		encoded = encoded.replace(RGcomments, document.vicidial_form.comments.value);
		encoded = encoded.replace(RGfullname, LOGfullname);
		encoded = encoded.replace(RGfronter, fronter);
		encoded = encoded.replace(RGuser, user);
		}
	   while (i < encoded.length) {
		   var ch = encoded.charAt(i);
		   if (ch == "%") {
				if (i < (encoded.length-2) 
						&& HEXCHAR.indexOf(encoded.charAt(i+1)) != -1 
						&& HEXCHAR.indexOf(encoded.charAt(i+2)) != -1 ) {
					decoded += unescape( encoded.substr(i,3) );
					i += 3;
				} else {
					alert( 'Bad escape combo near ...' + encoded.substr(i) );
					decoded += "%[ERR]";
					i++;
				}
			} else {
			   decoded += ch;
			   i++;
			}
		} // while
		decoded = decoded.replace(RGnl, "<BR>");

	   return false;
	};



// ################################################################################
// Move the Dispo frame out of the way and change the link to ingrandisci
	function DispoMinimize()
		{
			showDiv('DispoButtonHideA');
			showDiv('DispoButtonHideB');
			showDiv('DispoButtonHideC');
		document.getElementById("DispoSelectBox").style.top = 340;
		document.getElementById("DispoSelectMaxMin").innerHTML = "<a href=\"#\" onclick=\"DispoMaximize()\">ingrandisci</a>";
		}


// ################################################################################
// Move the Dispo frame to the top and change the link to minimizza
	function DispoMaximize()
		{
		document.getElementById("DispoSelectBox").style.top = 1;
		document.getElementById("DispoSelectMaxMin").innerHTML = "<a href=\"#\" onclick=\"DispoMinimize()\">minimizza</a>";
			hideDiv('DispoButtonHideA');
			hideDiv('DispoButtonHideB');
			hideDiv('DispoButtonHideC');
		}


// ################################################################################
// Populating the date field in the callback frame prior to submission
	function CB_date_pick(taskdate)
		{
		document.vicidial_form.CallBackDatESelectioN.value = taskdate;
		document.getElementById("CallBackDatEPrinT").innerHTML = taskdate;
		}


// ################################################################################
// Submitting the callback date and time to the system
	function CallBackDatE_submit()
		{
		CallBackDatEForM = document.vicidial_form.CallBackDatESelectioN.value;
		CallBackCommenTs = document.vicidial_form.CallBackCommenTsField.value;
		if (CallBackDatEForM.length < 2)
			{alert("Dovete scegliere una data");}
		else
			{
			CallBackTimEHouR = document.vicidial_form.CBT_hour.value;
			CallBackTimEMinuteS = document.vicidial_form.CBT_minute.value;
			CallBackTimEAmpM = document.vicidial_form.CBT_ampm.value;
			if (CallBackTimEHouR == '12')
				{
				if (CallBackTimEAmpM == 'AM')
					{
					CallBackTimEHouR = '00';
					}
				}
			else
				{
				if (CallBackTimEAmpM == 'PM')
					{
					CallBackTimEHouR = CallBackTimEHouR * 1;
					CallBackTimEHouR = (CallBackTimEHouR + 12);
					}
				}
			CallBackDatETimE = CallBackDatEForM + " " + CallBackTimEHouR + ":" + CallBackTimEMinuteS + ":00";

			document.getElementById("CallBackDatEPrinT").innerHTML = "Selezioni una data sotto";
			document.vicidial_form.CallBackDatESelectioN.value = '';
			document.vicidial_form.CallBackCommenTsField.value = '';
			document.vicidial_form.CBT_hour.value = '01';
			document.vicidial_form.CBT_minute.value = '00';
			document.vicidial_form.CBT_ampm.value = 'PM';

			if (document.vicidial_form.CallBackOnlyMe.checked==true)
				{
				CallBackrecipient = 'USERONLY';
				}
			else
				{
				CallBackrecipient = 'ANYONE';
				}
			document.vicidial_form.CallBackOnlyMe.checked=false;

		//	alert(CallBackDatETimE + "|" + CallBackCommenTs);

			document.vicidial_form.DispoSelection.value = 'CBHVECCHIO';
			hideDiv('CallBackSelectBox');
			DispoSelect_submit();
			}
		}


// ################################################################################
// Finish the wrapup timer early
	function WrapupFinish()
		{
		wrapup_counter=999;
		}


// ################################################################################
// GLOBAL FUNCTIONS
	function begin_all_refresh()
		{
		<? if ( ($HK_statuses_camp > 0) && ( ($user_level>=$HKuser_level) or ($VU_hotkeys_active > 0) ) ) {echo "document.onkeypress = hotkeypress;\n";} ?>
		all_refresh();
		}
	function start_all_refresh()
		{
		if (VICIDiaL_closer_login_checked==0)
			{
			hideDiv('NothingBox');
			hideDiv('HotKeyActionBox');
			hideDiv('HotKeyEntriesBox');
			hideDiv('MainXfeRBox');
			hideDiv('MainPanel');
			hideDiv('ScriptPanel');
			hideDiv('DispoSelectBox');
			hideDiv('LogouTBox');
			hideDiv('CustomerGoneBox');
			hideDiv('NoneInSessionBox');
			hideDiv('WrapupBox');
			hideDiv('TransferMain');
			hideDiv('BenvenutoBoxA');
			hideDiv('CallBackSelectBox');
			hideDiv('DispoButtonHideA');
			hideDiv('DispoButtonHideB');
			hideDiv('DispoButtonHideC');
			hideDiv('CallBacKsLisTBox');
			hideDiv('NeWManuaLDiaLBox');
			if (agentonly_callbacks != '1')
				{hideDiv('CallbacksButtons');}
		//	if ( (agentcall_manual != '1') && (starting_dial_level > 0) )
			if (agentcall_manual != '1')
				{hideDiv('ManuaLDiaLButtons');}
			if (agentcallsstatus != '1')
				{hideDiv('AgentStatusSpan');}
			if ( (auto_dial_level != 0) || (manual_dial_preview != 1) )
				{clearDiv('DiaLLeaDPrevieW');}
			if (alt_phone_dialing != 1)
				{clearDiv('DiaLDiaLAltPhonE');}
			document.vicidial_form.LeadLookuP.checked=true;

			document.getElementById("sessionIDspan").innerHTML = session_id;
			if (campaign_recording == 'NEVER')
				{
				document.getElementById("RecorDControl").innerHTML = "<IMG SRC=\"../agc/images/vdc_LB_startrecording_OFF.gif\" border=0 alt=\"Inizia la Registrazione\">";
				}
			if (INgroupCOUNT > 0)
				{
				if (VU_closer_default_blended == 1)
					{document.vicidial_form.CloserSelectBlended.checked=true}
				showDiv('CloserSelectBox');
				var CloserSelecting = 1;
				CloserSelectContent_create();
				}
			else
				{
				hideDiv('CloserSelectBox');
				MainPanelToFront();
				var CloserSelecting = 0;
				}
			VICIDiaL_closer_login_checked = 1;
			}
		else
			{

			var WaitingForNextStep=0;
			if (CloserSelecting==1)	{WaitingForNextStep=1;}
			if (open_dispo_screen==1)
				{
				wrapup_counter=0;
				if (wrapup_secondi > 0)	
					{
					showDiv('WrapupBox');
					wrapup_waiting=1;
					}
				CustomerData_update();
				showDiv('DispoSelectBox');
				DispoSelectContent_create('','ReSET');
				WaitingForNextStep=1;
				open_dispo_screen=0;
				document.getElementById("DispoSelectPhonE").innerHTML = document.vicidial_form.phone_number.value;
				if (auto_dial_level == 0)
					{
					if (document.vicidial_form.DiaLAltPhonE.checked==true)
						{
						reselect_alt_dial = 1;
						document.getElementById("DiaLControl").innerHTML = "<a href=\"#\" onclick=\"ManualDialNext('','','','','');\"><IMG SRC=\"../agc/images/vdc_LB_dialnextnumber_it.gif\" border=0 alt=\"Chiama il numero seguente\"></a>";

						document.getElementById("MainStatuSSpan").innerHTML = "Dial Next Call";
						}
					else
						{
						reselect_alt_dial = 0;
						}
					}
				}
			if (AgentDispoing==1)	
				{
				WaitingForNextStep=1;
				check_for_conf_calls(session_id, '0');
				}
			if (logout_stop_timeouts==1)	{WaitingForNextStep=1;}
			if ( (custchannellive < -30) && (lastcustchannel.length > 3) ) {CustomerChanneLGone();}
			if ( (nochannelinsession > 16) && (check_n > 15) ) {NoneInSession();}
			if (wrapup_secondi > 0)	
				{
				document.getElementById("WrapupTimer").innerHTML = (wrapup_secondi - wrapup_counter);
				wrapup_counter++;
				if ( (wrapup_counter > wrapup_secondi) && (document.getElementById("WrapupBox").style.visibility == 'visible') )
					{
					wrapup_waiting=0;
					hideDiv('WrapupBox');
					if (document.vicidial_form.DispoSelectStop.checked==true)
						{
						if (auto_dial_level != '0')
							{
							AutoDialWaiting = 0;
							AutoDial_ReSume_PauSe("VDADpause","NO");
					//		document.getElementById("DiaLControl").innerHTML = DiaLControl_auto_HTML;
							}
						VICIDiaL_pause_calling = 1;
						if (dispo_check_all_pause != '1')
							{
							document.vicidial_form.DispoSelectStop.checked=false;
							}
						}
					else
						{
						if (auto_dial_level != '0')
							{
							AutoDialWaiting = 1;
							AutoDial_ReSume_PauSe("VDADready","NO");
					//		document.getElementById("DiaLControl").innerHTML = DiaLControl_auto_HTML_ready;
							}
						}
					}
				}
			if (WaitingForNextStep==0)
				{
				// check for live channels in conference room and get current datetime
				check_for_conf_calls(session_id, '0');
				if (agentonly_callbacks == '1')
					{CB_count_check++;}

				if (AutoDialWaiting == 1)
					{
					check_for_auto_incoming();
					}
				// look for a channel name for the manually dialed call
				if (MD_channel_look==1)
					{
					ManualDialCheckChanneL(XDcheck);
					}
				if ( (CB_count_check > 19) && (agentonly_callbacks == '1') )
					{
					CalLBacKsCounTCheck();
					CB_count_check=0;
					}
				if (VD_live_customer_call==1)
					{
					VD_live_call_secondS++;
					document.vicidial_form.SecondS.value		= VD_live_call_secondS;
					}
				if (XD_live_customer_call==1)
					{
					XD_live_call_secondS++;
					document.vicidial_form.xferlength.value		= XD_live_call_secondS;
					}
				if (HKdispo_display > 0)
					{
					if ( (HKdispo_display == 3) && (HKfinish==1) )
						{
						HKfinish=0;
						DispoSelect_submit();
					//	AutoDialWaiting = 1;
					//	AutoDial_ReSume_PauSe("VDADready");
						}
					if (HKdispo_display == 1)
						{
						if (hot_keys_active==1)
							{showDiv('HotKeyEntriesBox');}
						hideDiv('HotKeyActionBox');
						}
					HKdispo_display--;
					}
				if (all_record == 'YES')
					{
					conf_send_recording('MonitorConf',session_id ,'');
					all_record = 'NO';
					}


				if (active_display==1)
					{
					check_s = check_n.toString();
						if ( (check_s.match(/00$/)) || (check_n<2) ) 
							{
						//	check_for_conf_calls();
							}
					}
				if (check_n<2) 
					{
					}
				else
					{
				//	check_for_live_calls();
					check_s = check_n.toString();
					if ( (park_refresh > 0) && (check_s.match(/0$|5$/)) ) 
						{
					//	parked_calls_display_refresh();
					}
					}
				}
			}
		setTimeout("all_refresh()", refresh_interval);
		}
	function all_refresh()
		{
		epoch_sec++;
		check_n++;
		var year= t.getYear()
		var month= t.getMonth()
			month++;
		var daym= t.getDate()
		var hours = t.getHours();
		var min = t.getMinutes();
		var sec = t.getSeconds();
		if (year < 1000) {year+=1900}
		if (month< 10) {month= "0" + month}
		if (daym< 10) {daym= "0" + daym}
		if (hours < 10) {hours = "0" + hours;}
		if (min < 10) {min = "0" + min;}
		if (sec < 10) {sec = "0" + sec;}
		var Tyear = (year-2000);
		filedate = year + "" + month + "" + daym + "-" + hours + "" + min + "" + sec;
		tinydate = Tyear + "" + month + "" + daym + "" + hours + "" + min + "" + sec;
		SQLdate = year + "-" + month + "-" + daym + " " + hours + ":" + min + ":" + sec;
		document.getElementById("status").innerHTML = year + "-" + month + "-" + daym + " " + hours + ":" + min + ":" + sec  + display_message;
		if (VD_live_customer_call==1)
			{
			var customer_gmt = parseFloat(document.vicidial_form.gmt_offset_now.value);
			var AMPM = 'AM';
			var customer_gmt_diff = (customer_gmt - local_gmt);
			var UnixTimec = (UnixTime + (3600 * customer_gmt_diff));
			var UnixTimeMSc = (UnixTimec * 1000);
			c.setTime(UnixTimeMSc);
			var Cmon= c.getMonth()
		//		Cmon++;
			var Cdaym= c.getDate()
			var Chours = c.getHours();
			var Cmin = c.getMinutes();
			var Csec = c.getSeconds();
			if (Cmon < 10) {Cmon= "0" + Cmon}
			if (Cdaym < 10) {Cdaym= "0" + Cdaym}
			if (Chours < 10) {Chours = "0" + Chours;}
			if ( (Cmin < 10) && (Cmin.length < 2) ) {Cmin = "0" + Cmin;}
			if ( (Csec < 10) && (Csec.length < 2) ) {Csec = "0" + Csec;}
			if (Cmon == 0) {Cmon = "GEN";}
			if (Cmon == 1) {Cmon = "FEB";}
			if (Cmon == 2) {Cmon = "MAR";}
			if (Cmon == 3) {Cmon = "APR";}
			if (Cmon == 4) {Cmon = "POS";}
			if (Cmon == 5) {Cmon = "GIU";}
			if (Cmon == 6) {Cmon = "LUG";}
			if (Cmon == 7) {Cmon = "AGO";}
			if (Cmon == 8) {Cmon = "SET";}
			if (Cmon == 9) {Cmon = "OTT";}
			if (Cmon == 10) {Cmon = "NOV";}
			if (Cmon == 11) {Cmon = "DIC";}
			if (Chours > 12) {Chours = (Chours - 12);   AMPM = 'PM';}
			if (Cmin < 10) {Cmin = "0" + Cmin;}
			if (Csec < 10) {Csec = "0" + Csec;}

			var customer_local_time = Cmon + " " + Cdaym + "   " + Chours + ":" + Cmin + ":" + Csec + " " + AMPM;
			document.vicidial_form.custdatetime.value		= customer_local_time;

			}
		start_all_refresh();
		}
	function pause()	// Pauses the refreshing of the lists
		{active_display=2;  display_message="  - DISPLAY ATTIVO IN PAUSA - ";}
	function start()	// resumes the refreshing of the lists
		{active_display=1;  display_message='';}
	function faster()	// lowers by 1000 milliseconds the time until the next refresh
		{
		 if (refresh_interval>1001)
			{refresh_interval=(refresh_interval - 1000);}
		}
	function slower()	// raises by 1000 milliseconds the time until the next refresh
		{
		refresh_interval=(refresh_interval + 1000);
		}

	// activeext-specific functions
	function activeext_force_refresh()	// forces immediate refresh of list content
		{getactiveext();}
	function activeext_order_asc()	// changes order of activeext list to ascending
		{
		activeext_order="asc";   getactiveext();
		desc_order_HTML ='<a href="#" onclick="activeext_order_desc();return false;">ORDINE</a>';
		document.getElementById("activeext_order").innerHTML = desc_order_HTML;
		}
	function activeext_order_desc()	// changes order of activeext list to descending
		{
		activeext_order="desc";   getactiveext();
		asc_order_HTML ='<a href="#" onclick="activeext_order_asc();return false;">ORDINE</a>';
		document.getElementById("activeext_order").innerHTML = asc_order_HTML;
		}

	// busytrunk-specific functions
	function busytrunk_force_refresh()	// forces immediate refresh of list content
		{getbusytrunk();}
	function busytrunk_order_asc()	// changes order of busytrunk list to ascending
		{
		busytrunk_order="asc";   getbusytrunk();
		desc_order_HTML ='<a href="#" onclick="busytrunk_order_desc();return false;">ORDINE</a>';
		document.getElementById("busytrunk_order").innerHTML = desc_order_HTML;
		}
	function busytrunk_order_desc()	// changes order of busytrunk list to descending
		{
		busytrunk_order="desc";   getbusytrunk();
		asc_order_HTML ='<a href="#" onclick="busytrunk_order_asc();return false;">ORDINE</a>';
		document.getElementById("busytrunk_order").innerHTML = asc_order_HTML;
		}
	function busytrunkhangup_force_refresh()	// forces immediate refresh of list content
		{busytrunkhangup();}

	// busyext-specific functions
	function busyext_force_refresh()	// forces immediate refresh of list content
		{getbusyext();}
	function busyext_order_asc()	// changes order of busyext list to ascending
		{
		busyext_order="asc";   getbusyext();
		desc_order_HTML ='<a href="#" onclick="busyext_order_desc();return false;">ORDINE</a>';
		document.getElementById("busyext_order").innerHTML = desc_order_HTML;
		}
	function busyext_order_desc()	// changes order of busyext list to descending
		{
		busyext_order="desc";   getbusyext();
		asc_order_HTML ='<a href="#" onclick="busyext_order_asc();return false;">ORDINE</a>';
		document.getElementById("busyext_order").innerHTML = asc_order_HTML;
		}
	function busylocalhangup_force_refresh()	// forces immediate refresh of list content
		{busylocalhangup();}


	// functions to hide and show different DIVs
	function showDiv(divvar) 
		{
		if (document.getElementById(divvar))
			{
			divref = document.getElementById(divvar).style;
			divref.visibility = 'visible';
			}
		}
	function hideDiv(divvar)
		{
		if (document.getElementById(divvar))
			{
			divref = document.getElementById(divvar).style;
			divref.visibility = 'hidden';
			}
		}
	function clearDiv(divvar)
		{
		if (document.getElementById(divvar))
			{
			document.getElementById(divvar).innerHTML = '';
			if (divvar == 'DiaLLeaDPrevieW')
				{
				var buildDivHTML = "<font class=\"preview_text\"> <input type=checkbox name=LeadPreview size=1 value=\"0\"> ANTEPRIMA CONTATTO<BR></font>";
				document.getElementById("DiaLLeaDPrevieWHide").innerHTML = buildDivHTML;
				}
			if (divvar == 'DiaLDiaLAltPhonE')
				{
				var buildDivHTML = "<font class=\"preview_text\"> <input type=checkbox name=DiaLAltPhonE size=1 value=\"0\"> ALT CHIAMATE<BR></font>";
				document.getElementById("DiaLDiaLAltPhonEHide").innerHTML = buildDivHTML;
				}
			}
		}
	function buildDiv(divvar)
		{
		if (document.getElementById(divvar))
			{
			var buildDivHTML = "";
			if (divvar == 'DiaLLeaDPrevieW')
				{
				document.getElementById("DiaLLeaDPrevieWHide").innerHTML = '';
				var buildDivHTML = "<font class=\"preview_text\"> <input type=checkbox name=LeadPreview size=1 value=\"0\"> ANTEPRIMA CONTATTO<BR></font>";
				document.getElementById(divvar).innerHTML = buildDivHTML;
				if (reselect_preview_dial==1)
					{document.vicidial_form.LeadPreview.checked=true}
				}
			if (divvar == 'DiaLDiaLAltPhonE')
				{
				document.getElementById("DiaLDiaLAltPhonEHide").innerHTML = '';
				var buildDivHTML = "<font class=\"preview_text\"> <input type=checkbox name=DiaLAltPhonE size=1 value=\"0\"> ALT CHIAMATE<BR></font>";
				document.getElementById(divvar).innerHTML = buildDivHTML;
				if (reselect_alt_dial==1)
					{document.vicidial_form.DiaLAltPhonE.checked=true}
				}
			}
		}


	function showMainXfeR(divvar,taskxferchan,taskxferchanmain) 
		{
		document.getElementById("MainXfeRBox").style.visibility = 'visible';
		getactiveext("MainXfeRBox");
		conference_list_display_refresh("MainXfeRconfContent");
		var XfeR_channel = taskxferchan;
		document.vicidial_form.H_XfeR_channel.value = XfeR_channel;
		document.vicidial_form.M_XfeR_channel.value = taskxferchanmain;
		document.getElementById("MainXfeRChanneL").innerHTML = XfeR_channel;
		}
	function hideMainXfeR(divvar) 
		{
		document.getElementById("MainXfeRBox").style.visibility = 'hidden';
		var XfeR_channel = '';
		document.vicidial_form.H_XfeR_channel.value = '';
		document.vicidial_form.M_XfeR_channel.value = '';
		document.getElementById("MainXfeRChanneL").innerHTML = '';
		}
	function conf_channels_detail(divvar) 
		{
		if (divvar == 'SHOW')
			{
			conf_channels_xtra_display = 1;
			document.getElementById("busycallsdisplay").innerHTML = "<a href=\"#\"  onclick=\"conf_channels_detail('HIDE');\">Nascondete le informazioni sul canale della conferenza</a>";
			LMAe[0]=''; LMAe[1]=''; LMAe[2]=''; LMAe[3]=''; LMAe[4]=''; LMAe[5]=''; 
			LMAcount=0;
			}
		else
			{
			conf_channels_xtra_display = 0;
			document.getElementById("busycallsdisplay").innerHTML = "<a href=\"#\"  onclick=\"conf_channels_detail('SHOW');\">Mostrate le informazioni sul canale della conferenza</a>";
			document.getElementById("outboundcallsspan").innerHTML = '';
			LMAe[0]=''; LMAe[1]=''; LMAe[2]=''; LMAe[3]=''; LMAe[4]=''; LMAe[5]=''; 
			LMAcount=0;
			}
		}

	function HotKeys(HKstate) 
		{
		if ( (HKstate == 'ON') && (HKbutton_allowed == 1) )
			{
			showDiv('HotKeyEntriesBox');
			hot_keys_active = 1;
			document.getElementById("hotkeysdisplay").innerHTML = "<a href=\"#\" onMouseOut=\"HotKeys('OFF')\"><IMG SRC=\"../agc/images/vdc_XB_hotkeysactive_it.gif\" border=0 alt=\"TASTI FUNZIONE ATTIVI\"></a>";
			}
		else
			{
			hideDiv('HotKeyEntriesBox');
			hot_keys_active = 0;
			document.getElementById("hotkeysdisplay").innerHTML = "<a href=\"#\" onMouseOver=\"HotKeys('ON')\"><IMG SRC=\"../agc/images/vdc_XB_hotkeysactive_OFF_it.gif\" border=0 alt=\"TASTI FUNZIONE INATTIVI\"></a>";
			}
		}

	function ShoWTransferMain(showxfervar,showoffvar)
		{
		if (VU_vicidial_transfers == '1')
			{
			if (showxfervar == 'ON')
				{
				HKbutton_allowed = 0;
				showDiv('TransferMain');
				document.getElementById("XferControl").innerHTML = "<a href=\"#\" onclick=\"ShoWTransferMain('OFF','YES');\"><IMG SRC=\"../agc/images/vdc_LB_transferconf_it.gif\" border=0 alt=\"Trasferimento - Conferenza\"></a>";
				}
			else
				{
				HKbutton_allowed = 1;
				hideDiv('TransferMain');
				if (showoffvar == 'YES')
					{
					document.getElementById("XferControl").innerHTML = "<a href=\"#\" onclick=\"ShoWTransferMain('ON');\"><IMG SRC=\"../agc/images/vdc_LB_transferconf_it.gif\" border=0 alt=\"Trasferimento - Conferenza\"></a>";
					}
				}
			}
		else
			{
			if (showxfervar != 'OFF')
				{
				alert('NON AVETE PERMESSI PER TRASFERIRE CHIAMATE');
				}
			}
		}

	function MainPanelToFront(resumevar)
		{
		document.getElementById("MainTable").style.backgroundColor="#E0C2D6";
		hideDiv('ScriptPanel');
		showDiv('MainPanel');
		if (resumevar != 'NO')
			{
			if (alt_phone_dialing == 1)
				{buildDiv('DiaLDiaLAltPhonE');}
			else
				{clearDiv('DiaLDiaLAltPhonE');}
			if (auto_dial_level == 0)
				{
				if (auto_dial_alt_dial==1)
					{
					auto_dial_alt_dial=0;
					document.getElementById("DiaLControl").innerHTML = DiaLControl_auto_HTML_OFF;
					}
				else
					{
					document.getElementById("DiaLControl").innerHTML = DiaLControl_manual_HTML;
					if (manual_dial_preview == 1)
						{buildDiv('DiaLLeaDPrevieW');}
					}
				}
			else
				{
				document.getElementById("DiaLControl").innerHTML = DiaLControl_auto_HTML;
				clearDiv('DiaLLeaDPrevieW');
				}
			}
		panel_bgcolor='#E0C2D6';
		document.getElementById("MainStatuSSpan").style.background = panel_bgcolor;
		}

	function ScriptPanelToFront()
		{
		showDiv('ScriptPanel');
		document.getElementById("MainTable").style.backgroundColor="#FFE7D0";
		panel_bgcolor='#FFE7D0';
		document.getElementById("MainStatuSSpan").style.background = panel_bgcolor;
		}

	</script>

    <STYLE type="text/css">
    </STYLE>


<style type="text/css">
<!--
	div.scroll_log {height: 135px; width: 600px; overflow: scroll;}
	div.scroll_callback {height: 300px; width: 620px; overflow: scroll;}
	div.scroll_park {height: 400px; width: 620px; overflow: scroll;}
	div.scroll_list {height: 400px; width: 140px; overflow: scroll;}
	div.scroll_script {height: 331px; width: 480px; background: #FFF5EC; overflow: scroll; font-size: 12px;  font-family: sans-serif;}
   .body_text {font-size: 13px;  font-family: sans-serif;}
   .preview_text {font-size: 13px;  font-family: sans-serif; background: #CCFFCC}
   .preview_text_red {font-size: 13px;  font-family: sans-serif; background: #FFCCCC}
   .body_small {font-size: 11px;  font-family: sans-serif;}
   .body_tiny {font-size: 10px;  font-family: sans-serif;}
   .log_text {font-size: 11px;  font-family: monospace;}
   .log_title {font-size: 12px;  font-family: monospace; font-weight: bold;}
   .sd_text {font-size: 16px;  font-family: sans-serif; font-weight: bold;}
   .sh_text {font-size: 14px;  font-family: sans-serif; font-weight: bold;}
   .sb_text {font-size: 12px;  font-family: sans-serif;}
   .sk_text {font-size: 11px;  font-family: sans-serif;}
   .skb_text {font-size: 13px;  font-family: sans-serif; font-weight: bold;}
   .ON_conf {font-size: 11px;  font-family: monospace; color: black ; background: #FFFF99}
   .OFF_conf {font-size: 11px;  font-family: monospace; color: black ; background: #FFCC77}
   .cust_form {font-family : sans-serif; font-size : 10px}

-->
</style>
<?
echo "</head>\n";


?>
<BODY onload="begin_all_refresh();">
<FORM name=vicidial_form>
<span style="position:absolute;left:0px;top:0px;z-index:2;" id="Header">
<TABLE Border=0 CELLPADDING=0 CELLSPACING=0 BGCOLOR=white WIDTH=640 MARGINWIDTH=0 MARGINHEIGHT=0 LEFTMARGIN=0 TOPMARGIN=0 VALIGN=TOP ALIGN=LEFT>
<TR VALIGN=TOP ALIGN=LEFT><TD COLSPAN=3 VALIGN=TOP ALIGN=LEFT>
<INPUT TYPE=HIDDEN NAME=extension>
<font class="body_text">
<?	echo "Inizio attività come Utente: $VD_login su Telefono: $SIP_user vai alla campagna: $VD_campaign&nbsp; \n"; ?>
</TD><TD COLSPAN=3 VALIGN=TOP ALIGN=RIGHT><font class="body_text"><?	echo "<a href=\"#\" onclick=\"LogouT();return false;\">LOGOUT</a>\n"; ?>
</TD></TR></TABLE>
</SPAN>

<span style="position:absolute;left:0px;top:13px;z-index:1;" id="Tabs">
    <table border=0 bgcolor="#FFFFFF" width=640 height=30>
<TR VALIGN=TOP ALIGN=LEFT>
<TD ALIGN=LEFT WIDTH=115><A HREF="#" onclick="MainPanelToFront('NO');"><IMG SRC="../agc/images/vdc_tab_vicidial.gif" ALT="VICICHIAMA" WIDTH=115 HEIGHT=30 Border=0></A></TD>
<TD ALIGN=LEFT WIDTH=105><A HREF="#" onclick="ScriptPanelToFront();"><IMG SRC="../agc/images/vdc_tab_script.gif" ALT="SCRIPT" WIDTH=105 HEIGHT=30 Border=0></A></TD>
<TD WIDTH=309 VALIGN=MIDDLE ALIGN=CENTER><font class="body_text"> &nbsp; <span id=status>LIVE</span> &nbsp; &nbsp; ID di sessione: <span id=sessionIDspan></span></TD>
<TD WIDTH=109><IMG SRC="../agc/images/agc_live_call_OFF_it.gif" NAME=livecall ALT="Chimate Attive" WIDTH=109 HEIGHT=30 Border=0></TD>
</TR></TABLE>
</span>



<span style="position:absolute;left:0px;top:0px;z-index:3;" id="BenvenutoBoxA">
    <table border=0 bgcolor="#FFFFFF" width=650 height=500><TR><TD align=center><BR><span id="BenvenutoBoxAt">VICICHIAMA</span></TD></TR></TABLE>
</span>

<span style="position:absolute;left:300px;top:365px;z-index:13;" id="ManuaLDiaLButtons"><font class="body_text">
<span id="MDstatusSpan"><a href="#" onclick="NeWManuaLDiaLCalL();return false;">Chiamata Manuale</a></span> <BR>
</font></span>

<span style="position:absolute;left:300px;top:350px;z-index:14;" id="CallbacksButtons"><font class="body_text">
<span id="CBstatusSpan">X RICHIAMATE ATTIVE</span> <BR>
</font></span>

<span style="position:absolute;left:0px;top:0px;z-index:35;" id="CallBacKsLisTBox">
    <table border=1 bgcolor="#CCFFCC" width=650 height=460><TR><TD align=center VALIGN=top> RICHIAMATE PER OPERATORE <? echo $VD_login ?>:<BR>Click su a callback below to call the customer back now. If you click su a record below to call it, it will be removed from the list.
	<BR>
	<div class="scroll_callback" id="CallBacKsLisT"></div>
	<BR> &nbsp; 
	<a href="#" onclick="CalLBacKsLisTCheck();return false;">Aggiorna</a>
	 &nbsp;  &nbsp;  &nbsp;  &nbsp;  &nbsp;  &nbsp;  &nbsp;  &nbsp; 
	<a href="#" onclick="hideDiv('CallBacKsLisTBox');return false;">Torna Indietro</a>
	</TD></TR></TABLE>
</span>

<span style="position:absolute;left:0px;top:0px;z-index:36;" id="NeWManuaLDiaLBox">
    <table border=1 bgcolor="#CCFFCC" width=650 height=460><TR><TD align=center VALIGN=top> NUOVA CHIAMATA MANUALE PER IL CONTATTO <? echo "$VD_login in campaign $VD_campaign" ?>:<BR><BR>Inserisci le informazioni sotto per il nuovo contatto da chiamare.
	<BR>
	<? 
	if (eregi("X",dial_prefix))
		{
		echo "Nota: prefisso di chiamata  $dial_prefix sarà aggiunto all`inizio di questo numero<BR>\n";
		}
	?>
	Nota: tutti i nuovi contatti da richiamare manualmente andranno nella lista 999<BR><BR>
	<table><tr>
	<td align=right><font class="body_text"> Codice di Chiamata: </td>
	<td align=left><font class="body_text"><input type=text size=7 maxlength=10 name=MDDiaLCodE class="cust_form" value="1">&nbsp; (E solitamente un 1 negli USA e Canada)</td>
	</tr><tr>
	<td align=right><font class="body_text"> Telefono Number: </td>
	<td align=left><font class="body_text"><input type=text size=12 maxlength=10 name=MDPhonENumbeR class="cust_form" value="">&nbsp; (10 cifre massimo, digita solo)</td>
	</tr><tr>
	<td align=right><font class="body_text"> Cerca Contatti esistenti: </td>
	<td align=left><font class="body_text"><input type=checkbox name=LeadLookuP size=1 value="0">&nbsp; (Questa opzione tenterà di trovare il numero di telefono nel sistema prima di inserire un nuovo contatto)</td>
	</tr><tr>

	<td align=right colspan=2><BR><BR>If you want to dial a number and have it NOT be added as a new lead, enter in the exact dialstring that you want to call in the Chiamata automatica field below. To hangup this call you will have to open the CHIAMATAS IN THIS SESSION link at the bottom of the screen and hang it up by clicking su its channel link there.<BR> &nbsp; </td>
	</tr><tr>
	<td align=right><font class="body_text"> Chiamata automatica: </td>
	<td align=left><font class="body_text"><input type=text size=24 maxlength=20 name=MDDiaLOverridE class="cust_form" value="">&nbsp; (solo cifre grazie)</td>
	</tr></table>
	<BR>
	<a href="#" onclick="NeWManuaLDiaLCalLSubmiT();return false;">Chiama Ora</a>
	 &nbsp;  &nbsp;  &nbsp;  &nbsp;  &nbsp;  &nbsp;  &nbsp;  &nbsp; 
	<a href="#" onclick="hideDiv('NeWManuaLDiaLBox');return false;">Torna Indietro</a>
	</TD></TR></TABLE>
</span>



<span style="position:absolute;left:5px;top:350px;z-index:20;" id="AgentStatusSpan"><font class="body_text">
Vostro Status: <span id="AgentStatusStatus"></span> <BR>Calls Dialing: <span id="AgentStatusCalls"></span> 
</font></span>


<span style="position:absolute;left:5px;top:310px;z-index:21;" id="TransferMain">
	<table bgcolor="#CCCCFF" width=630><tr>
	<td align=left>
	<font class="body_text">
	 <IMG SRC="../agc/images/vdc_XB_header_it.gif" border=0 alt="Trasferimento - Conferenza"><BR>
	<span STYLE="background-color: #CCCCCC" id="InternalCloser"><IMG SRC="../agc/images/vdc_XB_internalcloser_it.gif" border=0 alt="INTERNO PIU` VICINO"></span>
	<span STYLE="background-color: #CCCCCC" id="LocalCloser"><IMG SRC="../agc/images/vdc_XB_localcloser_OFF_it.gif" border=0 alt="LOCALE PIÙ VICINO"></span> 
	<span STYLE="background-color: #CCCCCC" id="CloserCode"><IMG SRC="../agc/images/vdc_XB_code.gif" border=0 alt="CODE"> <input type=text size=1 name=xfercode maxlength=2 class="cust_form"></span>
	<span STYLE="background-color: #CCCCCC" id="HangupXferLine"><IMG SRC="../agc/images/vdc_XB_hangupxferline_OFF_it.gif" border=0 alt="Attacca la linea trasferita"></span>
	<span STYLE="background-color: #CCCCCC" id="HangupBothLines"><a href="#" onclick="bothcall_send_hangup();return false;"><IMG SRC="../agc/images/vdc_XB_hangupbothlines_it.gif" border=0 alt="Attacca ciascun linea"></a></span>
	
	<BR>

	<IMG SRC="../agc/images/vdc_XB_number_it.gif" border=0 alt="Numero da chiamare"> <input type=text size=15 name=xfernumber maxlength=25 class="cust_form"> &nbsp; 
	<IMG SRC="../agc/images/vdc_XB_secondi_it.gif" border=0 alt="secondi"> <input type=text size=2 name=xferlength maxlength=4 class="cust_form"> &nbsp; 
	<IMG SRC="../agc/images/vdc_XB_channel_it.gif" border=0 alt="channel"> <input type=text size=12 name=xferchannel maxlength=100 class="cust_form"> 
	<input type=hidden name=xferuniqueid>
	<input type=checkbox name=xferoverride size=1 value="0"><font class="body_tiny">OVERRIDE</font> &nbsp;
	<a href="#" onclick="DtMf_PreSet_a();return false;"><font class="body_tiny">D1</font></a> 
	<a href="#" onclick="DtMf_PreSet_b();return false;"><font class="body_tiny">D2</font></a>
	<BR>

	<span STYLE="background-color: #CCCCCC" id="DialWithCustomer"><a href="#" onclick="SendManualDial('YES');return false;"><IMG SRC="../agc/images/vdc_XB_dialwithcustomer_it.gif" border=0 alt="Chiama il Cliente"></a></span> 
	<span STYLE="background-color: #CCCCCC" id="ParkCustomerDial"><a href="#" onclick="xfer_park_dial();return false;"><IMG SRC="../agc/images/vdc_XB_parkcustomerdial_it.gif" border=0 alt="Parcheggia il cliente in chiamata"></a></span> 
	<span STYLE="background-color: #CCCCCC" id="Leave3WayCall"><IMG SRC="../agc/images/vdc_XB_leave3waycall_OFF_it.gif" border=0 alt="LASCIA LA CONFERENZA"></span> 
	<span STYLE="background-color: #CCCCCC" id="DialBlindTransfer"><IMG SRC="../agc/images/vdc_XB_blindtransfer_OFF_it.gif" border=0 alt="Effettua il trasferimento cieco "></span>
	<span STYLE="background-color: #CCCCCC" id="DialBlindVMail"><IMG SRC="../agc/images/vdc_XB_ammessage_OFF.gif" border=0 alt="Blind Transfer VMail Message"></span>
	</font>
	</td>
	</tr></table>
</span>

<span style="position:absolute;left:5px;top:310px;z-index:22;" id="HotKeyActionBox">
    <table border=0 bgcolor="#FFDD99" width=620 height=70>
	<TR bgcolor="#FFEEBB"><TD height=70><font class="sh_text"> Contatto disposto come: </font><BR><BR><CENTER>
	<font class="sd_text"><span id="HotKeyDispo"> - </span></font></CENTER>
	</TD>
	</TR></TABLE>
</span>

<span style="position:absolute;left:5px;top:310px;z-index:23;" id="HotKeyEntriesBox">
    <table border=0 bgcolor="#FFDD99" width=620 height=70>
	<TR bgcolor="#FFEEBB"><TD width=200><font class="sh_text"> tasti funzione per la disposizione: </font></td><td colspan=2>
	<font class="body_small">Una volta attiva, premi sulla tastiera per la disposizione sulla chiamata sarà attaccata e disposta automaticamente:</font></td></tr><tr>
	<TD width=200><font class="sk_text">
	<span id="HotKeyBoxA"><? echo $HKboxA ?></span>
	</font></TD>
	<TD width=200><font class="sk_text">
	<span id="HotKeyBoxB"><? echo $HKboxB ?></span>
	</font></TD>
	<TD><font class="sk_text">
	<span id="HotKeyBoxC"><? echo $HKboxC ?></span>
	</font></TD>
	</TR></TABLE>
</span>

<span style="position:absolute;left:0px;top:12px;z-index:24;" id="NoneInSessionBox">
    <table border=1 bgcolor="#CCFFFF" width=600 height=500><TR><TD align=center> Nessuno è nella vostra sessione: <span id="NoneInSessionID"></span><BR>
	<a href="#" onclick="NoneInSessionOK();return false;">Torna Indietro</a>
	<BR><BR>
	<a href="#" onclick="NoneInSessionCalL();return false;">Ancora Operatore di chiamata</a>
	</TD></TR></TABLE>
</span>

<span style="position:absolute;left:0px;top:0px;z-index:25;" id="CustomerGoneBox">
    <table border=1 bgcolor="#CCFFFF" width=650 height=500><TR><TD align=center> Il cliente ha attaccato: <span id="CustomerGoneChanneL"></span><BR>
	<a href="#" onclick="CustomerGoneOK();return false;">Torna Indietro</a>
	<BR><BR>
	<a href="#" onclick="CustomerGoneHangup();return false;">Termina e disponi la chiamata</a>

	</TD></TR></TABLE>
</span>

<span style="position:absolute;left:0px;top:0px;z-index:26;" id="WrapupBox">
    <table border=1 bgcolor="#CCFFCC" width=650 height=550><TR><TD align=center> Chiamata tempo di pausa: <span id="WrapupTimer"></span> secondi restanti prima di nuova chiamata<BR><BR>
	<span id="WrapupMessage"><?=$wrapup_message ?></span>
	<BR><BR>
	<a href="#" onclick="WrapupFinish();return false;">Tempo scaduto, sbrigarsi  </a>

	</TD></TR></TABLE>
</span>

<span style="position:absolute;left:0px;top:0px;z-index:27;" id="LogouTBox">
    <table border=1 bgcolor="#FFFFFF" width=650 height=500><TR><TD align=center><BR><span id="LogouTBoxLink">LOGOUT</span></TD></TR></TABLE>
</span>

<span style="position:absolute;left:0px;top:70px;z-index:28;" id="DispoButtonHideA">
    <table border=0 bgcolor="#CCFFCC" width=165 height=22><TR><TD align=center VALIGN=top></TD></TR></TABLE>
</span>

<span style="position:absolute;left:0px;top:138px;z-index:29;" id="DispoButtonHideB">
    <table border=0 bgcolor="#CCFFCC" width=165 height=250><TR><TD align=center VALIGN=top>&nbsp;</TD></TR></TABLE>
</span>

<span style="position:absolute;left:0px;top:0px;z-index:30;" id="DispoButtonHideC">
    <table border=0 bgcolor="#CCFFCC" width=650 height=47><TR><TD align=center VALIGN=top>Tutti i cambiamenti fatti sulle informazioni del cliente sotto non saranno effettuate, cambiare le informazioni prima di attaccare. </TD></TR></TABLE>
</span>

<span style="position:absolute;left:0px;top:0px;z-index:31;" id="DispoSelectBox">
    <table border=1 bgcolor="#CCFFCC" width=650 height=460><TR><TD align=center VALIGN=top> DISPOSIZIONE CHIAMATA :<span id="DispoSelectPhonE"></span> &nbsp; &nbsp; &nbsp; <span id="DispoSelectHAspan"><a href="#" onclick="DispoHanguPAgaiN()">Attacca ancora</a></span> &nbsp; &nbsp; &nbsp; <span id="DispoSelectMaxMin"><a href="#" onclick="DispoMinimize()">minimizza</a></span><BR>
	<span id="DispoSelectContent"> Selezione di fine chiamata </span>
	<input type=hidden name=DispoSelection><BR>
	<input type=checkbox name=DispoSelectStop size=1 value="0"> PAUSA OPERATORE <BR>
	<a href="#" onclick="DispoSelectContent_create('','ReSET');return false;">PULISCI SCHERMATA</a> | 
	<a href="#" onclick="DispoSelect_submit();return false;">INVIA</a>
	<BR><BR>
	<a href="#" onclick="WeBForMDispoSelect_submit();return false;">WEB FORM INVIA</a>
	<BR><BR> &nbsp; 
	</TD></TR></TABLE>
</span>


<span style="position:absolute;left:0px;top:0px;z-index:32;" id="CallBackSelectBox">
    <table border=1 bgcolor="#CCFFCC" width=650 height=460><TR><TD align=center VALIGN=top> Selezionate una richiamata :<span id="CallBackDatE"></span><BR>
	<input type=hidden name=CallBackDatESelectioN>
	<input type=hidden name=CallBackTimESelectioN>
	<span id="CallBackDatEPrinT">Selezioni una data sotto</span> &nbsp;
	<span id="CallBackTimEPrinT"></span> &nbsp; &nbsp;
	Hour: 
	<SELECT SIZE=1 NAME="CBT_hour">
	<option>01</option>
	<option>02</option>
	<option>03</option>
	<option>04</option>
	<option>05</option>
	<option>06</option>
	<option>07</option>
	<option>08</option>
	<option>09</option>
	<option>10</option>
	<option>11</option>
	<option>12</option>
	</select> &nbsp;
	Minutes: 
	<SELECT SIZE=1 NAME="CBT_minute">
	<option>00</option>
	<option>30</option>
	</select> &nbsp;

	<SELECT SIZE=1 NAME="CBT_ampm">
	<option>AM</option>
	<option selected>PM</option>
	</select> &nbsp;<BR>
	<?
	if ($agentonly_callbacks)
		{echo "<input type=checkbox name=CallBackOnlyMe size=1 value=\"0\"> SOLTANTO LE MIE RICHIAMATE <BR>";}
	?>
	Commenti del CB : <input type=text name="CallBackCommenTsField" size=50><BR><BR>

	<a href="#" onclick="CallBackDatE_submit();return false;">INVIA</a><BR><BR>
	<span id="CallBackDateContent"><?echo"$CCAL_OUT"?></span>
	<BR><BR> &nbsp; 
	</TD></TR></TABLE>
</span>

<span style="position:absolute;left:0px;top:0px;z-index:33;" id="CloserSelectBox">
    <table border=1 bgcolor="#CCFFCC" width=650 height=460><TR><TD align=center VALIGN=top> SELEZIONE DI GRUPPO INBOUND PIÙ VICINO <BR>
	<span id="CloserSelectContent"> Selezione di Gruppo Inbound più vicino </span>
	<input type=hidden name=CloserSelectList><BR>
	<input type=checkbox name=CloserSelectBlended size=1 value="0"> CHIAMATA MESCOLATA(outbound attivato) <BR>
	<a href="#" onclick="CloserSelectContent_create();return false;">RESET</a> | 
	<a href="#" onclick="CloserSelect_submit();return false;">INVIA</a>
	<BR><BR><BR><BR> &nbsp; 
	</TD></TR></TABLE>
</span>

<span style="position:absolute;left:0px;top:0px;z-index:34;" id="NothingBox">
    <BUTTON Type=button name="inert_button"><img src="../agc/images/blank.gif"></BUTTON>
	<span id="DiaLLeaDPrevieWHide">Canale</span>
	<span id="DiaLDiaLAltPhonEHide">Canale</span>
	<?
	if (!$agentonly_callbacks)
		{echo "<input type=checkbox name=CallBackOnlyMe size=1 value=\"0\"> SOLTANTO LE MIE RICHIAMATE <BR>";}
	?>
</span>

<span style="position:absolute;left:80px;top:12px;z-index:42;" id="MainXfeRBox">
	<input type=hidden name=H_XfeR_channel>
	<input type=hidden name=M_XfeR_channel>
    <table border=0 bgcolor="#FFFFCC" width=600 height=500 cellpadding=3><TR><TD COLSPAN=3 ALIGN=CENTER><b> TRASFERIMENTO CHIAMATA ATTIVA</b> <BR>Canale trasferito: <span id="MainXfeRChanneL">Canale</span><BR></tr>
	<tr><td>Interni:<BR><span id="MainXfeRContent"> Menu degli Interni </span></td>
	<td>
	<BR>
	<a href="#" onclick="mainxfer_send_redirect('XfeR');return false;">Invia all` interno selezionato</a> <BR><BR>
	<a href="#" onclick="mainxfer_send_redirect('VMAIL');return false;">Invia alla VoiceMail selezionata</a> <BR><BR>
	<a href="#" onclick="mainxfer_send_redirect('ENTRY');return false;">Invia a questo numero </a>:<BR><input type=text name=extension_xfer_entry size=20 maxlength=50> <BR><BR>
	<a href="#" onclick="getactiveext('MainXfeRBox');return false;">AGGIORNA</a> <BR><BR><BR>
	<a href="#" onclick="hideMainXfeR('MainXfeRBox');">Tornate alla schermata principale</a> <BR><BR>
	</TD>
	<TD>Conferenze:<BR><font size=1>(Seleziona il numero sopra per inviarlo ad una conferenza)<BR><input type=checkbox name=MainXfeRconfXTRA size=1 value="1"> Invia anche il mio canale<div class="scroll_list" id="MainXfeRconfContent"> Menu Conferenza </div></td></TR></TABLE>
</span>



<span style="position:absolute;left:154px;top:65px;z-index:15;" id="ScriptPanel">
    <table border=0 bgcolor="#FFE7D0" width=486 height=331><TR><TD align=left valign=top><font class="sb_text"><div class="scroll_script" id="ScriptContents">VICICHIAMA SCRIPT</div></font></TD></TR></TABLE>
</span>






<!-- BEGIN *********   Here is the main VICICHIAMA display panel -->
<span style="position:absolute;left:0px;top:46px;z-index:10;" id="MainPanel">
<TABLE border=0 BGCOLOR="#E0C2D6" width=640 id="MainTable">
<TR><TD colspan=3><font class="body_text"> STATUS: <span id="MainStatuSSpan"></span></font></TD></TR>
<tr><td colspan=3><span id="busycallsdebug"></span></td></tr>
<tr><td width=150 align=left valign=top>
<font class="body_text"><center>
<span STYLE="background-color: #CCFFCC" id="DiaLControl"><a href="#" onclick="ManualDialNext('','','','','');"><IMG SRC="../agc/images/vdc_LB_dialnextnumber_OFF_it.gif" border=0 alt="Chiama il numero seguente"></a></span><BR>
<span id="DiaLLeaDPrevieW"><font class="preview_text"> <input type=checkbox name=LeadPreview size=1 value="0"> ANTEPRIMA CONTATTO<BR></font></span>
<span id="DiaLDiaLAltPhonE"><font class="preview_text"> <input type=checkbox name=DiaLAltPhonE size=1 value="0"> ALT CHIAMATE<BR></font></span>

<!--
<?
if ( ($manual_dial_preview) and ($auto_dial_level==0) )
	{echo "<font class=\"preview_text\"> <input type=checkbox name=LeadPreview size=1 value=\"0\"> ANTEPRIMA CONTATTO<BR></font>";}
if ( ($alt_phone_dialing) and ($auto_dial_level==0) )
	{echo "<font class=\"preview_text\"> <input type=checkbox name=DiaLAltPhonE size=1 value=\"0\"> ALT CHIAMATE<BR></font>";}


?> -->
REGISTRAZIONE DOCUMENTO:<BR>
</center>
<font class="body_tiny"><span id="RecorDingFilename"></span></font><BR>
IDENTIFICAZIONE Registrazione: <font class="body_small"><span id="RecorDID"></span></font><BR>
<center>
<!-- <a href=\"#\" onclick=\"conf_send_recording('MonitorConf','" + head_conf + "','');return false;\">Registrazione</a> -->
<span STYLE="background-color: #CCCCCC" id="RecorDControl"><a href="#" onclick="conf_send_recording('MonitorConf','<?=$session_id ?>','');return false;"><IMG SRC="../agc/images/vdc_LB_startrecording_it.gif" border=0 alt="Inizia la Registrazione"></a></span><BR>
<span id="SpacerSpanA"><IMG SRC="../agc/images/blank.gif" width=145 height=16 border=0></span><BR>
<span STYLE="background-color: #FFFFFF" id="WebFormSpan"><IMG SRC="../agc/images/vdc_LB_webform_OFF_it.gif" border=0 alt="Interfacccia Web"></span><BR>
<span id="SpacerSpanB"><IMG SRC="../agc/images/blank.gif" width=145 height=16 border=0></span><BR>
<span STYLE="background-color: #CCCCCC" id="ParkControl"><IMG SRC="../agc/images/vdc_LB_parkcall_OFF_it.gif" border=0 alt="Parcheggia la chiamata"></span><BR>
<span STYLE="background-color: #CCCCCC" id="XferControl"><IMG SRC="../agc/images/vdc_LB_transferconf_OFF_it.gif" border=0 alt="Trasferimento - Conferenza"></span><BR>
<span id="SpacerSpanC"><IMG SRC="../agc/images/blank.gif" width=145 height=16 border=0></span><BR>
<span STYLE="background-color: #FFCCFF" id="HangupControl"><IMG SRC="../agc/images/vdc_LB_hangupcustomer_OFF_it.gif" border=0 alt="Disconnetti il cliente"></span><BR>
<span id="SpacerSpanD"><IMG SRC="../agc/images/blank.gif" width=145 height=16 border=0></span><BR>
<span STYLE="background-color: #CCCCCC" id="SendDTMF"><a href="#" onclick="SendConfDTMF('<?=$session_id ?>');return false;"><IMG SRC="../agc/images/vdc_LB_senddtmf_it.gif" border=0 alt="Trasmetta DTMF"></a>  <input type=text size=5 name=conf_dtmf class="cust_form" value=""></span><BR>
</center>
</font>
</td>
<td width=480 align=left valign=top>
<input type=hidden name=lead_id value="">
<input type=hidden name=list_id value="">
<input type=hidden name=called_count value="">
<input type=hidden name=gmt_offset_now value="">
<input type=hidden name=gender value="">
<input type=hidden name=date_of_birth value="">
<input type=hidden name=country_code value="">
<input type=hidden name=uniqueid value="">
<input type=hidden name=callserverip value="">
<table><tr>
<td align=right><font class="body_text"> secondi: </td>
<td align=left><font class="body_text"><input type=text size=3 name=SecondS class="cust_form" value="">&nbsp; Canale: <input type=text size=6 name=callchannel class="cust_form" value="">&nbsp; Tempo Di Cust: <input type=text size=22 name=custdatetime class="cust_form" value=""></td>
</tr><tr>
<td colspan=2 align=center> Informazioni Cliente: <span id="CusTInfOSpaN"></span></td>
</tr><tr>
<td align=right><font class="body_text"> Titolo: </td>
<td align=left><font class="body_text"><input type=text size=4 name=title maxlength=4 class="cust_form" value="">&nbsp; Primo: <input type=text size=12 name=first_name maxlength=30 class="cust_form" value="">&nbsp; Mi:<input type=text size=1 name=middle_initial maxlength=1 class="cust_form" value="">&nbsp; Ultimo: <input type=text size=15 name=last_name maxlength=30 class="cust_form" value=""></td>
</tr><tr>
<td align=right><font class="body_text"> Indirizzo1: </td>
<td align=left><font class="body_text"><input type=text size=50 name=address1 maxlength=100 class="cust_form" value=""></td>
</tr><tr>
<td align=right><font class="body_text"> Indirizzo2: </td>
<td align=left><font class="body_text"><input type=text size=17 name=address2 maxlength=100 class="cust_form" value="">&nbsp; Indirizzo3: <input type=text size=25 name=address3 maxlength=100 class="cust_form" value=""></td>
</tr><tr>
<td align=right><font class="body_text"> Città: </td>
<td align=left><font class="body_text"><input type=text size=20 name=city maxlength=50 class="cust_form" value="">&nbsp; Stato: <input type=text size=2 name=state maxlength=2 class="cust_form" value="">&nbsp; Codice postale: <input type=text size=9 name=postal_code maxlength=10 class="cust_form" value=""></td>
</tr><tr>
<td align=right><font class="body_text"> Provincia: </td>
<td align=left><font class="body_text"><input type=text size=20 name=province maxlength=50 class="cust_form" value="">&nbsp; ID Fornitore: <input type=text size=15 name=vendor_lead_code maxlength=20 class="cust_form" value=""></td>
</tr><tr>
<td align=right><font class="body_text"> Telefono: </td>
<td align=left><font class="body_text"><input type=text size=11 name=phone_number maxlength=10 class="cust_form" value="">&nbsp; Prefisso: <input type=text size=4 name=phone_code maxlength=10 class="cust_form" value="">&nbsp; Alt. Telefono: <input type=text size=11 name=alt_phone maxlength=10 class="cust_form" value=""></td>
</tr><tr>
<td align=right><font class="body_text"> Mostra: </td>
<td align=left><font class="body_text"><input type=text size=20 name=security_phrase maxlength=100 class="cust_form" value="">&nbsp; Email: <input type=text size=25 name=email maxlength=70 class="cust_form" value=""></td>
</tr><tr>
<td align=right valign=top><font class="body_text"> Note: </td>
<?
if ( ($multi_line_comments) )
	{echo "<td align=left><font class=\"body_text\"><TEXTAREA NAME=comments ROWS=2 COLS=65 class=\"cust_form\" value=\"\"></TEXTAREA></td>\n";}
else
	{echo "<td align=left><font class=\"body_text\"><input type=text size=65 name=comments maxlength=255 class=\"cust_form\" value=\"\"></td>\n";}
?>

</tr></table>
</font>
</td>
<td width=1 align=center>
</td>
</tr>
<tr><td align=left colspan=3>
&nbsp;<BR><BR>&nbsp;

</td></tr>

<tr><td align=left colspan=3>
<table><tr height=32><td height=32><font face="Arial,Helvetica" size=1>Versione del webclient di VICICHIAMA: <? echo $version ?> &nbsp; &nbsp; CONFIGURAZIONE: <? echo $build ?> &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; Server: <? echo $server_ip ?>  &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;</font><BR>
<font class="body_small"><span id="busycallsdisplay"><a href="#"  onclick="conf_channels_detail('SHOW');">Mostrate le informazioni sul canale della conferenza</a></span></font></td><td align=right height=32>
<? if ( ($HK_statuses_camp > 0) && ( ($user_level>=$HKuser_level) or ($VU_hotkeys_active > 0) ) ) { ?>
<span id="hotkeysdisplay"><a href="#" onMouseOver="HotKeys('ON')"><IMG SRC="../agc/images/vdc_XB_hotkeysactive_OFF_it.gif" border=0 alt="TASTI FUNZIONE INATTIVI"></a></span>
<? } ?>
</td></tr>
<tr><td colspan=3><span id="outboundcallsspan"></span></td></tr>

<tr><td colspan=3>
<font class="body_small">
<span id="debugbottomspan"></span>
</font>
</td></tr>
</TABLE>
</span>
<!-- END *********   Here is the main VICICHIAMA display panel -->


</TD></TR></TABLE>
</FORM>


</body>
</html>

<?
	
exit; 



?>





