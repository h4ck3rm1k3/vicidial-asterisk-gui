<?

require("dbconnect.php");

require_once("htglobalize.php");

### If you have globals turned off uncomment these lines
//$PHP_AUTH_USER=$_SERVER['PHP_AUTH_USER'];
//$PHP_AUTH_PW=$_SERVER['PHP_AUTH_PW'];
##//$ADD=$_GET["ADD"]; # don't uncomment this line
### AST GUI database administration
### admin.php
### 
### CHANGES
### 50315-1110 - Added Custom Campaign Statuses
### 50317-1438 - Added Fronter Display var to inbound groups
### 50322-1355 - Added custom callerID per campaign
### 50517-1356 - Added user_groups sections and user_group to vicidial_users
### 50517-1440 - Added ability to logout (must click OK with empty user/pass)
### 50602-1622 - Added lead loader pages to load new files into vicidial_list
### 50620-1351 - Added custom vdad transfer AGI extension per campaign
### 50810-1414 - modified in groups to kick out spaces and dashes
### 50908-2136 - Added Custom Campaign HotKeys
###

### make sure you have added a user to the vicidial_users MySQL table with at least user_level 8 to access this page the first time

$version = '1.1.7';
$build = '50908-2136';

$STARTtime = date("U");

if ($force_logout)
{
  if( (strlen($PHP_AUTH_USER)>0) or (strlen($PHP_AUTH_PW)>0) )
	{
    Header("WWW-Authenticate: Basic realm=\"VICI-PROJECTS\"");
    Header("HTTP/1.0 401 Unauthorized");
	}
    echo "You have now logged out. Thank you\n";
    exit;
}

	$stmt="SELECT count(*) from vicidial_users where user='$PHP_AUTH_USER' and pass='$PHP_AUTH_PW' and user_level > 7;";
	if ($DB) {echo "|$stmt|\n";}
	$rslt=mysql_query($stmt, $link);
	$row=mysql_fetch_row($rslt);
	$auth=$row[0];

$fp = fopen ("./project_auth_entries.txt", "a");
$date = date("r");
$ip = getenv("REMOTE_ADDR");
$browser = getenv("HTTP_USER_AGENT");

  if( (strlen($PHP_AUTH_USER)<2) or (strlen($PHP_AUTH_PW)<2) or (!$auth))
	{
    Header("WWW-Authenticate: Basic realm=\"VICI-PROJECTS\"");
    Header("HTTP/1.0 401 Unauthorized");
    echo "Invalid Username/Password: |$PHP_AUTH_USER|$PHP_AUTH_PW|\n";
    exit;
	}
  else
	{

	if($auth>0)
		{
		$office_no=strtoupper($PHP_AUTH_USER);
		$password=strtoupper($PHP_AUTH_PW);
			$stmt="SELECT full_name from vicidial_users where user='$PHP_AUTH_USER' and pass='$PHP_AUTH_PW'";
			$rslt=mysql_query($stmt, $link);
			$row=mysql_fetch_row($rslt);
			$LOGfullname=$row[0];
		fwrite ($fp, "VICIDIAL|GOOD|$date|$PHP_AUTH_USER|$PHP_AUTH_PW|$ip|$browser|$LOGfullname|\n");
		fclose($fp);
		}
	else
		{
		fwrite ($fp, "VICIDIAL|FAIL|$date|$PHP_AUTH_USER|$PHP_AUTH_PW|$ip|$browser|\n");
		fclose($fp);
		}
	}

echo "<html>\n";
echo "<head>\n";
echo "<!-- VERSION: $version     BUILD: $build      ADD: $ADD-->\n";
echo "<title>VICIDIAL ADMIN: ";

if ($ADD==1)		{echo "Add New User";}
if ($ADD==11)		{echo "Add New Campaign";}
if ($ADD==111)		{echo "Add New List";}
if ($ADD==1111)		{echo "Add New In-Group";}
if ($ADD==11111)	{echo "Add New Remote Agents";}
if ($ADD==111111)	{echo "Add New Users Group";}
if ($ADD==2)		{echo "New User Addition";}
if ($ADD==21)		{echo "New Campaign Addition";}
if ($ADD==22)		{echo "New Campaign Status Addition";}
if ($ADD==211)		{echo "New List Addition";}
if ($ADD==2111)		{echo "New In-Group Addition";}
if ($ADD==21111)	{echo "New Remote Agents Addition";}
if ($ADD==211111)	{echo "New Users Group Addition";}
if ($ADD==3)		{echo "Modify User";}
if ($ADD==31)		{echo "Modify Campaign";}
if ($ADD==311)		{echo "Modify List";}
if ($ADD==3111)		{echo "Modify In-Group";}
if ($ADD==31111)	{echo "Modify Remote Agents";}
if ($ADD==311111)	{echo "Modify Users Groups";}
if ($ADD==4)		{echo "Modify User";}
if ($ADD==41)		{echo "Modify Campaign";}
if ($ADD==42)		{echo "Modify Campaign Status";}
if ($ADD==411)		{echo "Modify List";}
if ($ADD==4111)		{echo "Modify In-Group";}
if ($ADD==41111)	{echo "Modify Remote Agents";}
if ($ADD==411111)	{echo "Modify Users Group";}
if ($ADD==0)		{echo "Welcome";}
if ($ADD==10)		{echo "Campaigns";}
if ($ADD==100)		{echo "Lists";}
if ($ADD==1000)		{echo "In-Groups";}
if ($ADD==10000)	{echo "Remote Agents";}
if ($ADD==100000)	{echo "User Groups";}
if ($ADD==5)		{echo "Search Form";}
if ($ADD==6)		{echo "Search Results";}
if ($ADD==99999)	{echo "HELP";}

if ( (strlen($ADD)>4) && ($ADD < 99998) )
	{
	##### get server listing for dynamic pulldown
	$stmt="SELECT server_ip,server_description from servers order by server_ip";
	$rsltx=mysql_query($stmt, $link);
	$servers_to_print = mysql_num_rows($rsltx);
	$servers_list='';

	$o=0;
	while ($servers_to_print > $o)
		{
		$rowx=mysql_fetch_row($rsltx);
		$servers_list .= "<option value=\"$rowx[0]\">$rowx[0] - $rowx[1]</option>\n";
		$o++;
		}

	##### get campaigns listing for dynamic pulldown
	$stmt="SELECT campaign_id,campaign_name from vicidial_campaigns order by campaign_id";
	$rsltx=mysql_query($stmt, $link);
	$campaigns_to_print = mysql_num_rows($rsltx);
	$campaigns_list='';

	$o=0;
	while ($campaigns_to_print > $o)
		{
		$rowx=mysql_fetch_row($rsltx);
		$campaigns_list .= "<option value=\"$rowx[0]\">$rowx[0] - $rowx[1]</option>\n";
		$o++;
		}

	##### get inbound groups listing for checkboxes
	if ( (($ADD==31111) or ($ADD==31111)) and (count($groups)<1) )
	{
	$stmt="SELECT closer_campaigns from vicidial_remote_agents where remote_agent_id='$remote_agent_id';";
	$rslt=mysql_query($stmt, $link);
	$row=mysql_fetch_row($rslt);
	$closer_campaigns =	$row[0];
	$closer_campaigns = preg_replace("/ -$/","",$closer_campaigns);
	$groups = explode(" ", $closer_campaigns);
	}

	$stmt="SELECT group_id,group_name from vicidial_inbound_groups order by group_id";
	$rsltx=mysql_query($stmt, $link);
	$groups_to_print = mysql_num_rows($rsltx);
	$groups_list='';
	$groups_value='';

	$o=0;
	while ($groups_to_print > $o)
		{
		$rowx=mysql_fetch_row($rsltx);
		$group_id_value = $rowx[0];
		$group_name_value = $rowx[1];
		$groups_list .= "<input type=\"checkbox\" name=\"groups[]\" value=\"$group_id_value\"";
		$p=0;
		while ($p<50)
			{
			if ($group_id_value == $groups[$p]) 
				{
				$groups_list .= " CHECKED";
				$groups_value .= " $group_id_value";
				}
			$p++;
			}
		$groups_list .= "> $group_id_value - $group_name_value<BR>\n";
		$o++;
		}
	if (strlen($groups_value)>2) {$groups_value .= " -";}
	}





$NWB = " &nbsp; <a href=\"javascript:openNewWindow('$PHP_SELF?ADD=99999";
$NWE = "')\"><IMG SRC=\"help.gif\" WIDTH=20 HEIGHT=20 BORDER=0 ALT=\"HELP\" ALIGN=TOP></A>";
######################
# ADD=99999 display the HELP SCREENS
######################

if ($ADD==99999)
{
echo "</title>\n";
echo "</head>\n";
echo "<BODY BGCOLOR=white marginheight=0 marginwidth=0 leftmargin=0 topmargin=0>\n";
echo "<CENTER>\n";
echo "<TABLE WIDTH=98% BGCOLOR=#E6E6E6 cellpadding=2 cellspacing=0><TR><TD ALIGN=LEFT><FONT FACE=\"ARIAL,HELVETICA\" COLOR=BLACK SIZE=4><B>VICIDIAL ADMIN: HELP<BR></B></FONT><FONT FACE=\"ARIAL,HELVETICA\" COLOR=BLACK SIZE=2><BR><BR>\n";

?>
<B><FONT SIZE=3>VICIDIAL_USERS TABLE</FONT></B><BR><BR>
<A NAME="vicidial_users-user">
<BR>
<B>User ID - </B> This field is where you put the VICIDIAL user's ID number, can be up to 8 digits in length, Must be at least 2 characters in length.

<BR>
<A NAME="vicidial_users-pass">
<BR>
<B>Password - </B> This field is where you put the VICIDIAL user's password. Must be at least 2 characters in length.

<BR>
<A NAME="vicidial_users-full_name">
<BR>
<B>Full Name - </B> This field is where you put the VICIDIAL user's full name. Must be at least 2 characters in length.

<BR>
<A NAME="vicidial_users-user_level">
<BR>
<B>User Level - </B> This menu is where you select the VICIDIAL user's user level. Must be a level of 1 to log into VICIDIAL, Must be level greater than 2 to log in as a closer, Must be user level 8 or greater to get into admin web section.

<BR>
<A NAME="vicidial_users-user_group">
<BR>
<B>User Group - </B> This menu is where you select the VICIDIAL user's group that this user will belong to. This does not have any restrictions at this time, this is just to subdivide users and allow for future features based upon it.


<BR><BR><BR><BR>

<B><FONT SIZE=3>VICIDIAL_CAMPAIGNS TABLE</FONT></B><BR><BR>
<A NAME="vicidial_campaigns-campaign_id">
<BR>
<B>Campaign ID - </B> This is the short name of the campaign, it is not editable after initial submission, cannot contain spaces and must be between 2 and 8 characters in length.

<BR>
<A NAME="vicidial_campaigns-campaign_name">
<BR>
<B>Campaign Name - </B> This is the description of the campaign, it must be between 6 and 40 characters in length.

<BR>
<A NAME="vicidial_campaigns-active">
<BR>
<B>Active - </B> This is where you set the campaign to Active or Inactive. If Inactive, noone can log into it.

<BR>
<A NAME="vicidial_campaigns-park_ext">
<BR>
<B>Park Extension - </B> This is where you can customize the on-hold music for VICIDIAL. Make sure the extension is in place in the extensions.conf and that it points to the filename below.

<BR>
<A NAME="vicidial_campaigns-park_file_name">
<BR>
<B>Park File Name - </B> This is where you can customize the on-hold music for VICIDIAL. Make sure the filename is 10 characters in length or less and that the file is in place in the /var/lib/asterisk/sounds directory.

<BR>
<A NAME="vicidial_campaigns-web_form_address">
<BR>
<B>Web Form - </B> This is where you can set the custom web page that will be opened when the user clicks on the WEB FORM button.

<BR>
<A NAME="vicidial_campaigns-allow_closers">
<BR>
<B>Allow Closers - </B> This is where you can set whether the users of this campaign will have the option to send the call to a closer.

<BR>
<A NAME="vicidial_campaigns-dial_status">
<BR>
<B>Dial Status - </B> This is where you set the statuses that you are wanting to dial on within the lists that are active for the campaign below

<BR>
<A NAME="vicidial_campaigns-lead_order">
<BR>
<B>List Order - </B> This menu is where you select how the leads(that match the statuses selected above) will be put in the lead hopper:
 <BR> &nbsp; - DOWN: select the first leads loaded into the vicidial_list table
 <BR> &nbsp; - UP: select the last leads loaded into the vicidial_list table
 <BR> &nbsp; - UP PHONE: select the highest phone number and works it's way down
 <BR> &nbsp; - DOWN PHONE: select the lowest phone number and works it's way up
 <BR> &nbsp; - UP LAST NAME: starts with last names starting with Z and works it's way down
 <BR> &nbsp; - DOWN LAST NAME: starts with last names starting with A and works it's way up
 <BR> &nbsp; - UP COUNT: starts with most called leads and works its way down
 <BR> &nbsp; - DOWN COUNT: starts with least called leads and works it's way up
 <BR> &nbsp; - DOWN COUNT 2nd NEW: starts with least called leads and works it's way up inserting a NEW lead in every other lead(Must NOT have NEW selected in the dial statuses)
 <BR> &nbsp; - DOWN COUNT 3nd NEW: starts with least called leads and works it's way up inserting a NEW lead in every third lead(Must NOT have NEW selected in the dial statuses)
 <BR> &nbsp; - DOWN COUNT 4th NEW: starts with least called leads and works it's way up inserting a NEW lead in every forth lead(Must NOT have NEW selected in the dial statuses)

<BR>
<A NAME="vicidial_campaigns-hopper_level">
<BR>
<B>Hopper Level - </B> This is how many leads the VDhopper script tries to keep in the vicidial_hopper table for this campaign. If running VDhopper script every minute, make this slightly greater than the number of leads you go through in a minute.

<BR>
<A NAME="vicidial_campaigns-force_reset_hopper">
<BR>
<B>Force Reset of Hopper - </B> This allows you to wipe out the hopper contents upon form submission. It should be filled again when the VDhopper script runs.

<BR>
<A NAME="vicidial_campaigns-auto_dial_level">
<BR>
<B>Auto Dial Level - </B> This is where you set how many lines VICIDIAL should use per active agent. zero (0) means auto dialing is off and the agents will click to dial each number. Otherwise VICIDIAL will keep dialing lines equal to active agents multiplied by the dial level to arrive at how many lines this campaign on each server should allow.

<BR>
<A NAME="vicidial_campaigns-next_agent_call">
<BR>
<B>Next Agent Call - </B> This determines which agent receives the next call that is available:
 <BR> &nbsp; - random: orders by the random update value in the vicidial_live_agents table
 <BR> &nbsp; - oldest_call_start: orders by the last time an agent was sent a call. Results in agents receiving about the same number of calls overall.
 <BR> &nbsp; - oldest_call_finish: orders by the last time an agent finished a call. AKA agent waiting longest receives first call.

<BR>
<A NAME="vicidial_campaigns-local_call_time">
<BR>
<B>Local Call Time - </B> This is where you set during which hours you would like to dial, as determined by the local time in the are in which you are calling. This is controlled by area code and is adjusted for Daylight Savings time if applicable. General Guidelines in the USA for Business to Business is 9am to 5pm and Business to Consumer calls is 9am to 9pm.

<BR>
<A NAME="vicidial_campaigns-voicemail_ext">
<BR>
<B>Voicemail - </B> If defined, calls that would normally DROP would instead be directed to this voicemail box to hear and leave a message.

<BR>
<A NAME="vicidial_campaigns-dial_timeout">
<BR>
<B>Dial Timeout - </B> If defined, calls that would normally hangup after the timeout defined in extensions.conf would instead timeout at this amount of seconds if it is less than the extensions.conf timeout. This allows for quickly changing dial timeouts from server to server and limiting the effects to a single campaign. If you are having a lot of Answering Machine or Voicemail calls you may want to try changing this value to between 21-26 and see if results improve.

<BR>
<A NAME="vicidial_campaigns-dial_prefix">
<BR>
<B>Dial Prefix - </B> This field allows for more easily changing a path of dialing to go out through a different method without doing a reload in Asterisk. Default is 9 based upon a 91NXXNXXXXXX in the dialplan(extensions.conf).

<BR>
<A NAME="vicidial_campaigns-campaign_cid">
<BR>
<B>Campaign CallerID - </B> This field allows for the sending of a custom callerid number on the outbound calls. This is the number that would show up on the callerid of the person you are calling. The default is UNKNOWN. This option is only available if you are using PRIs(ISDN T1s or E1s) that have the custom callerid feature turned on. This feature may also work with IAX2 trunks depending on what your provider allows. The custom callerID only applies to calls placed for the VICIDIAL campaign directly, any 3rd party calls or transfers will not send the custom callerID. NOTE: Sometimes putting UNKNOWN or PRIVATE in the field will yield the sending of your default callerID number by your carrier with the calls. You may want to test this and put 0000000000 in the callerid field instead if you do not want to send you CallerID.

<BR>
<A NAME="vicidial_campaigns-campaign_vdad_exten">
<BR>
<B>Campaign VDAD extension - </B> This field allows for a custom VDAD transfer extension. This allows you to use different VDADtransfer...agi scripts depending upon your campaign. The default transfer AGI(exten 8365 [agi-VDADtransfer.agi]) just immediately sends the calls on to agents as soon as they are picked up. An additional sample political survey AGI is also now included (8366 [agi-VDADtransferSURVEY.agi]) that plays a message to the called person and allows them to make a choice by pressing buttons(effectively pre-screening the lead). Please note that except for surveys, political calls and charities this form of calling is illegal in the United States.


<BR><BR><BR><BR>

<B><FONT SIZE=3>VICIDIAL_LISTS TABLE</FONT></B><BR><BR>
<A NAME="vicidial_lists-list_id">
<BR>
<B>List ID - </B> This is the numerical name of the list, it is not editable after initial submission, must contain only numbers and must be between 2 and 8 characters in length.

<BR>
<A NAME="vicidial_lists-list_name">
<BR>
<B>List Name - </B> This is the description of the list, it must be between 2 and 20 characters in length.

<BR>
<A NAME="vicidial_lists-campaign_id">
<BR>
<B>Campaign - </B> This is the campaign that this list belongs to. A list can only be dialed on a single campaign at one time.

<BR>
<A NAME="vicidial_lists-active">
<BR>
<B>Active - </B> This defines whether the list is to be dialed on or not.

<BR>
<A NAME="vicidial_lists-reset_list">
<BR>
<B>Reset Lead-Called-Status for this list - </B> This resets all leads in this list to N for "not called since last reset" and means that any lead can now be called if it is the right status as defined in the campaign screen.


<BR><BR><BR><BR>

<B><FONT SIZE=3>VICIDIAL_INBOUND_GROUPS TABLE</FONT></B><BR><BR>
<A NAME="vicidial_inbound_groups-group_id">
<BR>
<B>Group ID - </B> This is the short name of the inbound group, it is not editable after initial submission, must not contain any spaces and must be between 2 and 20 characters in length.

<BR>
<A NAME="vicidial_inbound_groups-group_name">
<BR>
<B>Group Name - </B> This is the description of the group, it must be between 2 and 30 characters in length. Cannot include dashes '-', plusses '+' or spaces ' '.

<BR>
<A NAME="vicidial_inbound_groups-group_color">
<BR>
<B>Group Color - </B> This is the color that displays in the VICIDIAL client app when a call comes in on this group. It must be between 2 and 7 characters long. If this is a hex color definition you must remember to put a # at the beginning of the string or VICIDIAL will not work properly.

<BR>
<A NAME="vicidial_inbound_groups-active">
<BR>
<B>Active - </B> This determines whether this group show up in the selection box when a VICIDIAL agent logs in.

<BR>
<A NAME="vicidial_inbound_groups-web_form_address">
<BR>
<B>Web Form - </B> This is the custom address that clicking on the WEB FORM button in VICIDIAL will take you to for calls that come in on this group.

<BR>
<A NAME="vicidial_inbound_groups-voicemail_ext">
<BR>
<B>Voicemail - </B> If defined, this is the Voicemail box that calls will go to instead of being dropped if no agents are available after the hold time is up.

<BR>
<A NAME="vicidial_inbound_groups-next_agent_call">
<BR>
<B>Next Agent Call - </B> This determines which agent receives the next call that is available:
 <BR> &nbsp; - random: orders by the random update value in the vicidial_live_agents table
 <BR> &nbsp; - oldest_call_start: orders by the last time an agent was sent a call. Results in agents receiving about the same number of calls overall.
 <BR> &nbsp; - oldest_call_finish: orders by the last time an agent finished a call. AKA agent waiting longest receives first call.

<BR>
<A NAME="vicidial_inbound_groups-fronter_display">
<BR>
<B>Fronter Display - </B> This field determines whether the inbound VICIDIAL agent would have the fronter name(if there is one) displayed in the Status field when the call comes to the agent.



<BR><BR><BR><BR>

<B><FONT SIZE=3>VICIDIAL_REMOTE_AGENTS TABLE</FONT></B><BR><BR>
<A NAME="vicidial_remote_agents-user_start">
<BR>
<B>User ID Start - </B> This is the starting User ID that is used when the remote agent entries are inserted into the system. If the Number of Lines is set higher than 1, this number is incremented by one until each line has an entry. Make sure you create a new VICIDIAL user account with a user level of 4 or great if you want them to be able to use the vdremote.php page for remote web access of this account.

<BR>
<A NAME="vicidial_remote_agents-number_of_lines">
<BR>
<B>Number of Lines - </B> This defines how many remote agent entries the system creates, and determines how many lines it thinks it can safely send to the number below.

<BR>
<A NAME="vicidial_remote_agents-server_ip">
<BR>
<B>Server IP - </B> A remote agent entry is only good for one specific server, here is where you select which server you want.

<BR>
<A NAME="vicidial_remote_agents-conf_exten">
<BR>
<B>External Extension - </B> This is the number that you want the calls forwarded to. Make sure that it is a full dialplan number and that if you need a 9 at the beginning you put it in here. Test by dialing this number from a phone on the system.

<BR>
<A NAME="vicidial_remote_agents-status">
<BR>
<B>Status - </B> Here is where you turn the remote agent on and off. As soon as the agent is Active the system assumes that it can send calls to it. It may take up to 30 seconds once you change the status to Inactive to stop receiving calls.

<BR>
<A NAME="vicidial_remote_agents-campaign_id">
<BR>
<B>Campaign - </B> Here is where you select the campaign that these remote agents will be logged into. Inbound needs to use the CLOSER campaign and select the inbound campaigns below that you want to receive calls from.

<BR>
<A NAME="vicidial_remote_agents-closer_campaigns">
<BR>
<B>Inbound Groups - </B> Here is where you select the inbound groups you want to receive calls from if you have selected the CLOSER campaign.


<BR><BR><BR><BR>

<B><FONT SIZE=3>VICIDIAL_CAMPAIGN_LISTS</FONT></B><BR><BR>
<A NAME="vicidial_campaign_lists">
<BR>
<B>The lists within this campaign are listed here, whether they are active is denoted by the Y or N and you can go to the list screen by clicking on the list ID in the first column.</B>


<BR><BR><BR><BR>

<B><FONT SIZE=3>VICIDIAL_CAMPAIGN_STATUSES TABLE</FONT></B><BR><BR>
<A NAME="vicidial_campaign_statuses">
<BR>
<B>Through the use of Custom campaign statuses, you can have statuses that only exist for a specific campaign. The Status must be 1-8 characters in length, the description must be 2-30 characters in length and Selectable defines whether it shows up in VICIDIAL as a disposition.</B>





<BR><BR><BR><BR>

<B><FONT SIZE=3>VICIDIAL_USER_GROUPS TABLE</FONT></B><BR><BR>
<A NAME="vicidial_user_groups-user_group">
<BR>
<B>User Group - </B> This is the short name of a Vicidial User group, try not to use any spaces or punctuation for this field. max 20 characters, minimum of 2 characters.

<BR>
<A NAME="vicidial_user_groups-group_name">
<BR>
<B>Group Name - </B> This is the description of the vicidial user group max of 40 characters.





<BR><BR><BR><BR>

<B><FONT SIZE=3>VICIDIAL LIST LOADER FUNCTIONALITY</FONT></B><BR><BR>
<A NAME="vicidial_list_loader">
<BR>
The VICIDIAL web-based lead loader is designed simply to take a lead file(up to 8MB in size) that is either tab or pipe delimited and load it into the vicidial_list table. The lead loader does not do data validation or check for duplicates in itself or other lists, so that is something you need to do before you load the leads. Also, make sure that you have created the list that these leads are to be under so that you can use them. There is also the matter of time-zone-coding these leads. You may want to increase the frequency that the ADMIN_adjust_GMTnow_on_leads.pl is being run in the cron on your Asterisk server so that any loaded leads can be coded faster. Here is a list of the fields in their proper order for the lead files:
	<OL>
	<LI>Vendor Lead Code - shows up in the Vendor ID field of the GUI
	<LI>Source Code - internal use only for admins and DBAs
	<LI>List ID - the list number that these leads will show up under
	<LI>Phone Code - the prefix for the phone number(1 for US, 01144 for UK, 01161 for AUS, etc)
	<LI>Phone Number - must be at least 8 digits long
	<LI>Title - title of the customer(Mr. Ms. Mrs, etc...)
	<LI>First Name
	<LI>Middle Initial
	<LI>Last Name
	<LI>Address Line 1
	<LI>Address Line 2
	<LI>Address Line 3
	<LI>City
	<LI>State - limited to 2 characters
	<LI>Province
	<LI>Postal Code
	<LI>Country
	<LI>Gender
	<LI>Date of Birth
	<LI>Alternate Phone Number
	<LI>Email Address
	<LI>Security Phrase
	<LI>Comments
	</OL>



<BR><BR><BR><BR><BR><BR><BR><BR>
<BR><BR><BR><BR><BR><BR><BR><BR>
THE END
</TD></TR></TABLE></BODY></HTML>
<?
exit;

#### END HELP SCREENS
}







?>
</title>
<script language="Javascript">
function openNewWindow(url) {
  window.open (url,"",'width=500,height=300,scrollbars=yes,menubar=yes,address=yes');
}
</script>
</head>
<BODY BGCOLOR=white marginheight=0 marginwidth=0 leftmargin=0 topmargin=0>
<CENTER>
<TABLE WIDTH=620 BGCOLOR=#D9E6FE cellpadding=2 cellspacing=0><TR BGCOLOR=#015B91><TD ALIGN=LEFT><FONT FACE="ARIAL,HELVETICA" COLOR=WHITE SIZE=2><B> &nbsp; VICIDIAL ADMIN - <a href="<? echo $PHP_SELF ?>?force_logout=1"><FONT FACE="ARIAL,HELVETICA" COLOR=WHITE SIZE=1>Logout</a></TD><TD ALIGN=RIGHT><FONT FACE="ARIAL,HELVETICA" COLOR=WHITE SIZE=2><B><? echo date("l F j, Y G:i:s A") ?> &nbsp; </TD></TR>
<TR BGCOLOR=#F0F5FE><TD ALIGN=LEFT COLSPAN=2><FONT FACE="ARIAL,HELVETICA" COLOR=BLACK SIZE=1><B> &nbsp; <a href="<? echo $PHP_SELF ?>"><FONT FACE="ARIAL,HELVETICA" COLOR=BLACK SIZE=1>LIST USERS</a> | <a href="<? echo $PHP_SELF ?>?ADD=1"><FONT FACE="ARIAL,HELVETICA" COLOR=BLACK SIZE=1>ADD NEW USER</a> | <a href="<? echo $PHP_SELF ?>?ADD=5"><FONT FACE="ARIAL,HELVETICA" COLOR=BLACK SIZE=1>SEARCH FOR A USER</a> | <a href="<? echo $PHP_SELF ?>?ADD=111111"><FONT FACE="ARIAL,HELVETICA" COLOR=BLACK SIZE=1>ADD USER GROUP</a> | <a href="<? echo $PHP_SELF ?>?ADD=100000"><FONT FACE="ARIAL,HELVETICA" COLOR=BLACK SIZE=1>LIST USER GROUPS</a></TD></TR>
<TR BGCOLOR=#F0F5FE><TD ALIGN=LEFT COLSPAN=2><FONT FACE="ARIAL,HELVETICA" COLOR=BLACK SIZE=1><B> &nbsp; <a href="<? echo $PHP_SELF ?>?ADD=11"><FONT FACE="ARIAL,HELVETICA" COLOR=BLACK SIZE=1>ADD CAMPAIGN</a> | <a href="<? echo $PHP_SELF ?>?ADD=10"><FONT FACE="ARIAL,HELVETICA" COLOR=BLACK SIZE=1>LIST CAMPAIGNS</a> | <a href="<? echo $PHP_SELF ?>?ADD=100"><FONT FACE="ARIAL,HELVETICA" COLOR=BLACK SIZE=1>SHOW LISTS</a> | <a href="<? echo $PHP_SELF ?>?ADD=111"><FONT FACE="ARIAL,HELVETICA" COLOR=BLACK SIZE=1>ADD NEW LIST</a> | &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; | <a href="./listloaderMAIN.php"><FONT FACE="ARIAL,HELVETICA" COLOR=BLACK SIZE=1>LOAD NEW LEADS</a></TD></TR>
<TR BGCOLOR=#F0F5FE><TD ALIGN=LEFT COLSPAN=2><FONT FACE="ARIAL,HELVETICA" COLOR=BLACK SIZE=1><B> &nbsp; <a href="<? echo $PHP_SELF ?>?ADD=1000"><FONT FACE="ARIAL,HELVETICA" COLOR=BLACK SIZE=1>SHOW IN-GROUPS</a> | <a href="<? echo $PHP_SELF ?>?ADD=1111"><FONT FACE="ARIAL,HELVETICA" COLOR=BLACK SIZE=1>ADD NEW IN-GROUP</a> | <a href="<? echo $PHP_SELF ?>?ADD=10000"><FONT FACE="ARIAL,HELVETICA" COLOR=BLACK SIZE=1>SHOW REMOTE AGENTS</a> | <a href="<? echo $PHP_SELF ?>?ADD=11111"><FONT FACE="ARIAL,HELVETICA" COLOR=BLACK SIZE=1>ADD NEW REMOTE AGENTS</a></TD></TR>
<TR BGCOLOR=#F0F5FE><TD ALIGN=LEFT COLSPAN=2><FONT FACE="ARIAL,HELVETICA" COLOR=BLACK SIZE=1><B> &nbsp; <a href="server_stats.php"><FONT FACE="ARIAL,HELVETICA" COLOR=BLACK SIZE=1>SERVER STATS</a> | <a href="AST_parkstats.php"><FONT FACE="ARIAL,HELVETICA" COLOR=BLACK SIZE=1>PARK REPORT</a> | <a href="AST_VDADstats.php"><FONT FACE="ARIAL,HELVETICA" COLOR=BLACK SIZE=1>VDAD REPORT</a> | <a href="AST_CLOSERstats.php"><FONT FACE="ARIAL,HELVETICA" COLOR=BLACK SIZE=1>CLOSER REPORT</a> | &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; | <a href="admin_search_lead.php"><FONT FACE="ARIAL,HELVETICA" COLOR=BLACK SIZE=1>SEARCH FOR A LEAD</a> | <a href="group_hourly_stats.php"><FONT FACE="ARIAL,HELVETICA" COLOR=BLACK SIZE=1>GROUP HOURLY</a></TD></TR>


<TR><TD ALIGN=LEFT COLSPAN=2>
<? 
######################
# ADD=1 display the ADD NEW USER FORM SCREEN
######################

if ($ADD==1)
{
echo "<FONT FACE=\"ARIAL,HELVETICA\" COLOR=BLACK SIZE=2>";

echo "<br>ADD A NEW USER<form action=$PHP_SELF method=POST>\n";
echo "<input type=hidden name=ADD value=2>\n";
echo "<center><TABLE width=600 cellspacing=3>\n";
echo "<tr bgcolor=#B6D3FC><td align=right>User Number: </td><td align=left><input type=text name=user size=20 maxlength=10>$NWB#vicidial_users-user$NWE</td></tr>\n";
echo "<tr bgcolor=#B6D3FC><td align=right>Password: </td><td align=left><input type=text name=pass size=20 maxlength=10>$NWB#vicidial_users-pass$NWE</td></tr>\n";
echo "<tr bgcolor=#B6D3FC><td align=right>Full Name: </td><td align=left><input type=text name=full_name size=20 maxlength=100>$NWB#vicidial_users-full_name$NWE</td></tr>\n";
echo "<tr bgcolor=#B6D3FC><td align=right>User Level: </td><td align=left><select size=1 name=user_level><option>1</option><option>2</option><option>3</option><option>4</option><option>5</option><option>6</option><option>7</option><option>8</option><option>9</option></select>$NWB#vicidial_users-user_level$NWE</td></tr>\n";
echo "<tr bgcolor=#B6D3FC><td align=right>User Group: </td><td align=left><select size=1 name=user_group>\n";

	$stmt="SELECT user_group,group_name from vicidial_user_groups order by user_group";
	$rsltx=mysql_query($stmt, $link);
	$Ugroups_to_print = mysql_num_rows($rsltx);
	$Ugroups_list='';

	$o=0;
	while ($Ugroups_to_print > $o) {
		$rowx=mysql_fetch_row($rsltx);
		$Ugroups_list .= "<option value=\"$rowx[0]\">$rowx[0] - $rowx[1]</option>\n";
		$o++;
	}
echo "$Ugroups_list";
echo "<option SELECTED>$user_group</option>\n";
echo "</select>$NWB#vicidial_users-user_group$NWE</td></tr>\n";
echo "<tr bgcolor=#B6D3FC><td align=center colspan=2><input type=submit name=submit value=submit></td></tr>\n";
echo "</TABLE></center>\n";

}


######################
# ADD=11 display the ADD NEW CAMPAIGN FORM SCREEN
######################

if ($ADD==11)
{
echo "<FONT FACE=\"ARIAL,HELVETICA\" COLOR=BLACK SIZE=2>";

echo "<br>ADD A NEW CAMPAIGN<form action=$PHP_SELF method=POST>\n";
echo "<input type=hidden name=ADD value=21>\n";
echo "<center><TABLE width=600 cellspacing=3>\n";
echo "<tr bgcolor=#B6D3FC><td align=right>Campaign ID: </td><td align=left><input type=text name=campaign_id size=8 maxlength=8>$NWB#vicidial_campaigns-campaign_id$NWE</td></tr>\n";
echo "<tr bgcolor=#B6D3FC><td align=right>Campaign Name: </td><td align=left><input type=text name=campaign_name size=30 maxlength=30>$NWB#vicidial_campaigns-campaign_name$NWE</td></tr>\n";
echo "<tr bgcolor=#B6D3FC><td align=right>Active: </td><td align=left><select size=1 name=active><option>Y</option><option>N</option></select>$NWB#vicidial_campaigns-active$NWE</td></tr>\n";
echo "<tr bgcolor=#B6D3FC><td align=right>Park Extension: </td><td align=left><input type=text name=park_ext size=10 maxlength=10>$NWB#vicidial_campaigns-park_ext$NWE</td></tr>\n";
echo "<tr bgcolor=#B6D3FC><td align=right>Park Filename: </td><td align=left><input type=text name=park_file_name size=10 maxlength=10>$NWB#vicidial_campaigns-park_file_name$NWE</td></tr>\n";
echo "<tr bgcolor=#B6D3FC><td align=right>Web Form: </td><td align=left><input type=text name=web_form_address size=50 maxlength=255>$NWB#vicidial_campaigns-web_form_address$NWE</td></tr>\n";
echo "<tr bgcolor=#B6D3FC><td align=right>Allow Closers: </td><td align=left><select size=1 name=allow_closers><option>Y</option><option>N</option></select>$NWB#vicidial_campaigns-allow_closers$NWE</td></tr>\n";
echo "<tr bgcolor=#B6D3FC><td align=right>Hopper Level: </td><td align=left><select size=1 name=hopper_level><option>1</option><option>5</option><option>10</option><option>50</option><option>100</option><option>200</option><option>500</option></select>$NWB#vicidial_campaigns-hopper_level$NWE</td></tr>\n";
echo "<tr bgcolor=#B6D3FC><td align=right>Auto Dial Level: </td><td align=left><select size=1 name=auto_dial_level><option selected>0</option><option>1</option><option>1.1</option><option>1.2</option><option>1.3</option><option>1.4</option><option>1.5</option><option>1.6</option><option>1.7</option><option>1.8</option><option>1.9</option><option>2.0</option><option>2.2</option><option>2.5</option><option>2.7</option><option>3.0</option><option>3.5</option></select>(0 = off)$NWB#vicidial_campaigns-auto_dial_level$NWE</td></tr>\n";
echo "<tr bgcolor=#B6D3FC><td align=right>Next Agent Call: </td><td align=left><select size=1 name=next_agent_call><option >random</option><option>oldest_call_start</option><option>oldest_call_finish</option></select>$NWB#vicidial_campaigns-next_agent_call$NWE</td></tr>\n";
echo "<tr bgcolor=#B6D3FC><td align=right>Local Call Time: </td><td align=left><select size=1 name=local_call_time><option >24hours</option><option >9am-9pm</option><option>9am-5pm</option><option>12pm-5pm</option><option>12pm-9pm</option><option>5pm-9pm</option></select>$NWB#vicidial_campaigns-local_call_time$NWE</td></tr>\n";
echo "<tr bgcolor=#B6D3FC><td align=right>Voicemail: </td><td align=left><input type=text name=voicemail_ext size=10 maxlength=10 value=\"$voicemail_ext\">$NWB#vicidial_campaigns-voicemail_ext$NWE</td></tr>\n";

echo "<tr bgcolor=#B6D3FC><td align=center colspan=2><input type=submit name=submit value=submit></td></tr>\n";
echo "</TABLE></center>\n";

}


######################
# ADD=111 display the ADD NEW LIST FORM SCREEN
######################

if ($ADD==111)
{
echo "<FONT FACE=\"ARIAL,HELVETICA\" COLOR=BLACK SIZE=2>";

echo "<br>ADD A NEW LIST<form action=$PHP_SELF method=POST>\n";
echo "<input type=hidden name=ADD value=211>\n";
echo "<center><TABLE width=600 cellspacing=3>\n";
echo "<tr bgcolor=#B6D3FC><td align=right>List ID: </td><td align=left><input type=text name=list_id size=8 maxlength=8> (digits only)$NWB#vicidial_lists-list_id$NWE</td></tr>\n";
echo "<tr bgcolor=#B6D3FC><td align=right>List Name: </td><td align=left><input type=text name=list_name size=20 maxlength=20>$NWB#vicidial_lists-list_name$NWE</td></tr>\n";
echo "<tr bgcolor=#B6D3FC><td align=right>Campaign: </td><td align=left><select size=1 name=campaign_id>\n";

	$stmt="SELECT campaign_id,campaign_name from vicidial_campaigns order by campaign_id";
	$rsltx=mysql_query($stmt, $link);
	$campaigns_to_print = mysql_num_rows($rsltx);
	$campaigns_list='';

	$o=0;
	while ($campaigns_to_print > $o) {
		$rowx=mysql_fetch_row($rsltx);
		$campaigns_list .= "<option value=\"$rowx[0]\">$rowx[0] - $rowx[1]</option>\n";
		$o++;
	}
echo "$campaigns_list";
echo "<option SELECTED>$campaign_id</option>\n";
echo "</select>$NWB#vicidial_lists-campaign_id$NWE</td></tr>\n";
echo "<tr bgcolor=#B6D3FC><td align=right>Active: </td><td align=left><select size=1 name=active><option>Y</option><option SELECTED>N</option></select>$NWB#vicidial_lists-active$NWE</td></tr>\n";
echo "<tr bgcolor=#B6D3FC><td align=center colspan=2><input type=submit name=submit value=submit></td></tr>\n";
echo "</TABLE></center>\n";

}


######################
# ADD=1111 display the ADD NEW INBOUND GROUP SCREEN
######################

if ($ADD==1111)
{
echo "<FONT FACE=\"ARIAL,HELVETICA\" COLOR=BLACK SIZE=2>";

echo "<br>ADD A NEW INBOUND GROUP<form action=$PHP_SELF method=POST>\n";
echo "<input type=hidden name=ADD value=2111>\n";
echo "<center><TABLE width=600 cellspacing=3>\n";
echo "<tr bgcolor=#B6D3FC><td align=right>Group ID: </td><td align=left><input type=text name=group_id size=20 maxlength=20> (no spaces)$NWB#vicidial_inbound_groups-group_id$NWE</td></tr>\n";
echo "<tr bgcolor=#B6D3FC><td align=right>Group Name: </td><td align=left><input type=text name=group_name size=30 maxlength=30>$NWB#vicidial_inbound_groups-group_name$NWE</td></tr>\n";
echo "<tr bgcolor=#B6D3FC><td align=right>Group Color: </td><td align=left><input type=text name=group_color size=7 maxlength=7>$NWB#vicidial_inbound_groups-group_color$NWE</td></tr>\n";
echo "<tr bgcolor=#B6D3FC><td align=right>Active: </td><td align=left><select size=1 name=active><option SELECTED>Y</option><option>N</option></select>$NWB#vicidial_inbound_groups-active$NWE</td></tr>\n";
echo "<tr bgcolor=#B6D3FC><td align=right>Web Form: </td><td align=left><input type=text name=web_form_address size=50 maxlength=255 value=\"$web_form_address\">$NWB#vicidial_inbound_groups-web_form_address$NWE</td></tr>\n";
echo "<tr bgcolor=#B6D3FC><td align=right>Voicemail: </td><td align=left><input type=text name=voicemail_ext size=10 maxlength=10 value=\"$voicemail_ext\">$NWB#vicidial_inbound_groups-voicemail_ext$NWE</td></tr>\n";
echo "<tr bgcolor=#B6D3FC><td align=right>Next Agent Call: </td><td align=left><select size=1 name=next_agent_call><option >random</option><option>oldest_call_start</option><option>oldest_call_finish</option></select>$NWB#vicidial_inbound_groups-next_agent_call$NWE</td></tr>\n";
echo "<tr bgcolor=#B6D3FC><td align=right>Fronter Display: </td><td align=left><select size=1 name=fronter_display><option SELECTED>Y</option><option>N</option></select>$NWB#vicidial_inbound_groups-fronter_display$NWE</td></tr>\n";
echo "<tr bgcolor=#B6D3FC><td align=center colspan=2><input type=submit name=submit value=submit></td></tr>\n";
echo "</TABLE></center>\n";

}


######################
# ADD=11111 display the ADD NEW REMOTE AGENTS SCREEN
######################

if ($ADD==11111)
{
echo "<FONT FACE=\"ARIAL,HELVETICA\" COLOR=BLACK SIZE=2>";

echo "<br>ADD NEW REMOTE AGENTS<form action=$PHP_SELF method=POST>\n";
echo "<input type=hidden name=ADD value=21111>\n";
echo "<center><TABLE width=600 cellspacing=3>\n";
echo "<tr bgcolor=#B6D3FC><td align=right>User ID Start: </td><td align=left><input type=text name=user_start size=6 maxlength=6> (numbers only, incremented)$NWB#vicidial_remote_agents-user_start$NWE</td></tr>\n";
echo "<tr bgcolor=#B6D3FC><td align=right>Number of Lines: </td><td align=left><input type=text name=number_of_lines size=3 maxlength=3> (numbers only)$NWB#vicidial_remote_agents-number_of_lines$NWE</td></tr>\n";
echo "<tr bgcolor=#B6D3FC><td align=right>Server IP: </td><td align=left><select size=1 name=server_ip>\n";
echo "$servers_list";
echo "</select>$NWB#vicidial_remote_agents-server_ip$NWE</td></tr>\n";
echo "<tr bgcolor=#B6D3FC><td align=right>External Extension: </td><td align=left><input type=text name=conf_exten size=20 maxlength=20> (dialplan number dialed to reach agents)$NWB#vicidial_remote_agents-conf_exten$NWE</td></tr>\n";
echo "<tr bgcolor=#B6D3FC><td align=right>Status: </td><td align=left><select size=1 name=status><option>ACTIVE</option><option SELECTED>INACTIVE</option></select>$NWB#vicidial_remote_agents-status$NWE</td></tr>\n";
echo "<tr bgcolor=#B6D3FC><td align=right>Campaign: </td><td align=left><select size=1 name=campaign_id>\n";
echo "$campaigns_list";
echo "</select>$NWB#vicidial_remote_agents-campaign_id$NWE</td></tr>\n";
echo "<tr bgcolor=#B6D3FC><td align=right>Inbound Groups: </td><td align=left>\n";
echo "$groups_list";
echo "$NWB#vicidial_remote_agents-closer_campaigns$NWE</td></tr>\n";
echo "<tr bgcolor=#B6D3FC><td align=center colspan=2><input type=submit name=submit value=submit></td></tr>\n";
echo "</TABLE></center>\n";
echo "NOTE: It can take up to 30 seconds for changes submitted on this screen to go live\n";

}


######################
# ADD=111111 display the ADD NEW USERS GROUP SCREEN
######################

if ($ADD==111111)
{
echo "<FONT FACE=\"ARIAL,HELVETICA\" COLOR=BLACK SIZE=2>";

echo "<br>ADD NEW USERS GROUP<form action=$PHP_SELF method=POST>\n";
echo "<input type=hidden name=ADD value=211111>\n";
echo "<center><TABLE width=600 cellspacing=3>\n";
echo "<tr bgcolor=#B6D3FC><td align=right>Group: </td><td align=left><input type=text name=user_group size=15 maxlength=20> (no spaces or punctuation)$NWB#vicidial_user_groups-user_group$NWE</td></tr>\n";
echo "<tr bgcolor=#B6D3FC><td align=right>Description: </td><td align=left><input type=text name=group_name size=40 maxlength=40> (description of group)$NWB#vicidial_user_groups-group_name$NWE</td></tr>\n";
echo "<tr bgcolor=#B6D3FC><td align=center colspan=2><input type=submit name=submit value=submit></td></tr>\n";
echo "</TABLE></center>\n";

}


######################
# ADD=2 adds the new person to the system
######################

if ($ADD==2)
{
	echo "<FONT FACE=\"ARIAL,HELVETICA\" COLOR=BLACK SIZE=2>";
	$stmt="SELECT count(*) from vicidial_users where user='$user';";
	$rslt=mysql_query($stmt, $link);
	$row=mysql_fetch_row($rslt);
	if ($row[0] > 0)
		{echo "<br>USER NOT ADDED - there is already a user in the system with this user number\n";}
	else
		{
		 if ( (strlen($user) < 2) or (strlen($pass) < 2) or (strlen($full_name) < 2) or (strlen($user) > 8) )
			{
			 echo "<br>USER NOT ADDED - Please go back and look at the data you entered\n";
			 echo "<br>user id must be between 2 and 8 characters long\n";
			 echo "<br>full name and password must be at least 2 characters long\n";
			}
		 else
			{
			echo "<br><B>USER ADDED: $user</B>\n";

			$stmt="INSERT INTO vicidial_users values('','$user','$pass','$full_name','$user_level','$user_group');";
			$rslt=mysql_query($stmt, $link);

			### LOG CHANGES TO LOG FILE ###
			$fp = fopen ("./admin_changes_log.txt", "a");
			fwrite ($fp, "$date|ADD A USER          |$PHP_AUTH_USER|$ip|'$user','$pass','$full_name','$user_level'|\n");
			fclose($fp);
			}
		}
$ADD=0;
}

######################
# ADD=21 adds the new campaign to the system
######################

if ($ADD==21)
{

	echo "<FONT FACE=\"ARIAL,HELVETICA\" COLOR=BLACK SIZE=2>";
	$stmt="SELECT count(*) from vicidial_campaigns where campaign_id='$campaign_id';";
	$rslt=mysql_query($stmt, $link);
	$row=mysql_fetch_row($rslt);
	if ($row[0] > 0)
		{echo "<br>CAMPAIGN NOT ADDED - there is already a campaign in the system with this ID\n";}
	else
		{
		 if ( (strlen($campaign_id) < 2) or (strlen($campaign_id) > 8) or (strlen($campaign_name) < 6)  or (strlen($campaign_name) > 40) )
			{
			 echo "<br>CAMPAIGN NOT ADDED - Please go back and look at the data you entered\n";
			 echo "<br>campaign ID must be between 2 and 8 characters in length\n";
			 echo "<br>campaign name must be between 6 and 40 characters in length\n";
			}
		 else
			{
			echo "<br><B>CAMPAIGN ADDED: $campaign_id</B>\n";

			$stmt="INSERT INTO vicidial_campaigns values('$campaign_id','$campaign_name','$active','','','','','','DOWN','$park_ext','$park_file_name','$web_form_address','$allow_closers','$hopper_level','$auto_dial_level','$next_agent_call','$local_call_time','$voicemail_ext','','','','');";
			$rslt=mysql_query($stmt, $link);

			### LOG CHANGES TO LOG FILE ###
			$fp = fopen ("./admin_changes_log.txt", "a");
			fwrite ($fp, "$date|ADD A NEW CAMPAIGN  |$PHP_AUTH_USER|$ip|'$campaign_id','$campaign_name','$active','','','','','','DOWN','$park_ext','$park_file_name','$web_form_address','$allow_closers','$hopper_level','$auto_dial_level','$next_agent_call','$local_call_time','$voicemail_ext','','','',''|\n");
			fclose($fp);

			}
		}
$ADD=31;
}

######################
# ADD=22 adds the new campaign status to the system
######################

if ($ADD==22)
{

	echo "<FONT FACE=\"ARIAL,HELVETICA\" COLOR=BLACK SIZE=2>";
	$stmt="SELECT count(*) from vicidial_campaign_statuses where campaign_id='$campaign_id' and status='$status';";
	$rslt=mysql_query($stmt, $link);
	$row=mysql_fetch_row($rslt);
	if ($row[0] > 0)
		{echo "<br>CAMPAIGN STATUS NOT ADDED - there is already a campaign-status in the system with this name\n";}
	else
		{
		$stmt="SELECT count(*) from vicidial_statuses where status='$status';";
		$rslt=mysql_query($stmt, $link);
		$row=mysql_fetch_row($rslt);
		if ($row[0] > 0)
			{echo "<br>CAMPAIGN STATUS NOT ADDED - there is already a global-status in the system with this name\n";}
		else
			{
			 if ( (strlen($campaign_id) < 2) or (strlen($status) < 1) or (strlen($status_name) < 2) )
				{
				 echo "<br>CAMPAIGN STATUS NOT ADDED - Please go back and look at the data you entered\n";
				 echo "<br>status must be between 1 and 8 characters in length\n";
				 echo "<br>status name must be between 2 and 30 characters in length\n";
				}
			 else
				{
				echo "<br><B>CAMPAIGN STATUS ADDED: $campaign_id - $status</B>\n";

				$stmt="INSERT INTO vicidial_campaign_statuses values('$status','$status_name','$selectable','$campaign_id');";
				$rslt=mysql_query($stmt, $link);

				### LOG CHANGES TO LOG FILE ###
				$fp = fopen ("./admin_changes_log.txt", "a");
				fwrite ($fp, "$date|ADD A NEW CAMPAIGN STATUS |$PHP_AUTH_USER|$ip|'$status','$status_name','$selectable','$campaign_id'|\n");
				fclose($fp);

				}
			}
		}
$ADD=31;
}


######################
# ADD=211 adds the new list to the system
######################

if ($ADD==211)
{
	echo "<FONT FACE=\"ARIAL,HELVETICA\" COLOR=BLACK SIZE=2>";
	$stmt="SELECT count(*) from vicidial_lists where list_id='$list_id';";
	$rslt=mysql_query($stmt, $link);
	$row=mysql_fetch_row($rslt);
	if ($row[0] > 0)
		{echo "<br>LIST NOT ADDED - there is already a list in the system with this ID\n";}
	else
		{
		 if ( (strlen($campaign_id) < 2) or (strlen($list_name) < 2)  or (strlen($list_id) < 2) or (strlen($list_id) > 8) )
			{
			 echo "<br>LIST NOT ADDED - Please go back and look at the data you entered\n";
			 echo "<br>List ID must be between 2 and 8 characters in length\n";
			 echo "<br>List name must be at least 2 characters in length\n";
			 }
		 else
			{
			echo "<br><B>LIST ADDED: $list_id</B>\n";

			$stmt="INSERT INTO vicidial_lists values('$list_id','$list_name','$campaign_id','$active');";
			$rslt=mysql_query($stmt, $link);

			### LOG CHANGES TO LOG FILE ###
			$fp = fopen ("./admin_changes_log.txt", "a");
			fwrite ($fp, "$date|ADD A NEW LIST      |$PHP_AUTH_USER|$ip|'$list_id','$list_name','$campaign_id','$active'|\n");
			fclose($fp);

			}
		}
$ADD=311;
}



######################
# ADD=2111 adds the new inbound group to the system
######################

if ($ADD==2111)
{
	echo "<FONT FACE=\"ARIAL,HELVETICA\" COLOR=BLACK SIZE=2>";
	$stmt="SELECT count(*) from vicidial_inbound_groups where group_id='$group_id';";
	$rslt=mysql_query($stmt, $link);
	$row=mysql_fetch_row($rslt);
	if ($row[0] > 0)
		{echo "<br>GROUP NOT ADDED - there is already a group in the system with this ID\n";}
	else
		{
		 if ( (strlen($group_id) < 2) or (strlen($group_name) < 2)  or (strlen($group_color) < 2) or (strlen($group_id) > 20) or (eregi(' ',$group_id)) or (eregi('-',$group_id)) or (eregi('+',$group_id)) )
			{
			 echo "<br>GROUP NOT ADDED - Please go back and look at the data you entered\n";
			 echo "<br>Group ID must be between 2 and 20 characters in length and contain no ' -+'.\n";
			 echo "<br>Group name and group color must be at least 2 characters in length\n";
			}
		 else
			{
			$stmt="INSERT INTO vicidial_inbound_groups values('$group_id','$group_name','$group_color','$active','$web_form_address','$voicemail_ext','$next_agent_call','$fronter_display');";
			$rslt=mysql_query($stmt, $link);

			echo "<br><B>GROUP ADDED: $group_id</B>\n";

			### LOG CHANGES TO LOG FILE ###
			$fp = fopen ("./admin_changes_log.txt", "a");
			fwrite ($fp, "$date|ADD A NEW GROUP     |$PHP_AUTH_USER|$ip|'$group_id','$group_name','$group_color','$active','$web_form_address','$voicemail_ext','$next_agent_call','$fronter_display'|\n");
			fclose($fp);

			}
		}
$ADD=1000;
}


######################
# ADD=21111 adds new remote agents to the system
######################

if ($ADD==21111)
{
	echo "<FONT FACE=\"ARIAL,HELVETICA\" COLOR=BLACK SIZE=2>";
	$stmt="SELECT count(*) from vicidial_remote_agents where server_ip='$server_ip' and user_start='$user_start';";
	$rslt=mysql_query($stmt, $link);
	$row=mysql_fetch_row($rslt);
	if ($row[0] > 0)
		{echo "<br>REMOTE AGENTS NOT ADDED - there is already a remote agents entry starting with this userID\n";}
	else
		{
		 if ( (strlen($server_ip) < 2) or (strlen($user_start) < 2)  or (strlen($campaign_id) < 2) or (strlen($conf_exten) < 2) )
			{
			 echo "<br>REMOTE AGENTS NOT ADDED - Please go back and look at the data you entered\n";
			 echo "<br>User ID start and external extension must be at least 2 characters in length\n";
			 }
		 else
			{
			$stmt="INSERT INTO vicidial_remote_agents values('','$user_start','$number_of_lines','$server_ip','$conf_exten','$status','$campaign_id','$groups_value');";
			$rslt=mysql_query($stmt, $link);

			echo "<br><B>REMOTE AGENTS ADDED: $user_start</B>\n";

			### LOG CHANGES TO LOG FILE ###
			$fp = fopen ("./admin_changes_log.txt", "a");
			fwrite ($fp, "$date|ADD A NEW REMOTE AGENTS ENTRY     |$PHP_AUTH_USER|$ip|'$user_start','$number_of_lines','$server_ip','$conf_exten','$status','$campaign_id','$groups_value'|\n");
			fclose($fp);

			}
		}
$ADD=10000;
}

######################
# ADD=211111 adds new user group to the system
######################

if ($ADD==211111)
{
	echo "<FONT FACE=\"ARIAL,HELVETICA\" COLOR=BLACK SIZE=2>";
	$stmt="SELECT count(*) from vicidial_user_groups where user_group='$user_group';";
	$rslt=mysql_query($stmt, $link);
	$row=mysql_fetch_row($rslt);
	if ($row[0] > 0)
		{echo "<br>USER GROUP NOT ADDED - there is already a user group entry with this name\n";}
	else
		{
		 if ( (strlen($user_group) < 2) or (strlen($group_name) < 2) )
			{
			 echo "<br>USER GROUP NOT ADDED - Please go back and look at the data you entered\n";
			 echo "<br>Group name and description must be at least 2 characters in length\n";
			 }
		 else
			{
			$stmt="INSERT INTO vicidial_user_groups values('$user_group','$group_name');";
			$rslt=mysql_query($stmt, $link);

			echo "<br><B>USER GROUP ADDED: $user_start</B>\n";

			### LOG CHANGES TO LOG FILE ###
			$fp = fopen ("./admin_changes_log.txt", "a");
			fwrite ($fp, "$date|ADD A NEW USER GROUP ENTRY     |$PHP_AUTH_USER|$ip|'$user_group','$group_name'|\n");
			fclose($fp);

			}
		}
$ADD=100000;
}





######################################################################################################
######################################################################################################
#######   4 series, record modifications submitted and DB is modified, then on to 3 series forms below
######################################################################################################
######################################################################################################



######################
# ADD=4 submit user modifications to the system
######################

if ($ADD==4)
{
	echo "<FONT FACE=\"ARIAL,HELVETICA\" COLOR=BLACK SIZE=2>";

	 if ( (strlen($pass) < 2) or (strlen($full_name) < 2) or (strlen($user_level) < 1) )
		{
		 echo "<br>USER NOT MODIFIED - Please go back and look at the data you entered\n";
		 echo "<br>Password and Full Name each need ot be at least 2 characters in length\n";
		}
	 else
		{
		echo "<br><B>USER MODIFIED: $user</B>\n";

		$stmt="UPDATE vicidial_users set pass='$pass',full_name='$full_name',user_level='$user_level',user_group='$user_group' where user='$user';";
		$rslt=mysql_query($stmt, $link);

		### LOG CHANGES TO LOG FILE ###
		$fp = fopen ("./admin_changes_log.txt", "a");
		fwrite ($fp, "$date|MODIFY USER INFO    |$PHP_AUTH_USER|$ip|pass='$pass',full_name='$full_name',user_level='$user_level',user_group='$user_group' where user='$user'|\n");
		fclose($fp);

		}

$ADD=3;		# go to user modification below
}

######################
# ADD=41 submit campaign modifications to the system
######################

if ($ADD==41)
{
	echo "<FONT FACE=\"ARIAL,HELVETICA\" COLOR=BLACK SIZE=2>";

	 if ( (strlen($campaign_name) < 6) or (strlen($active) < 1) )
		{
		 echo "<br>CAMPAIGN NOT MODIFIED - Please go back and look at the data you entered\n";
		 echo "<br>the campaign name needs to be at least 6 characters in length\n";
		}
	 else
		{
		echo "<br><B>CAMPAIGN MODIFIED: $campaign_id</B>\n";

		$stmt="UPDATE vicidial_campaigns set campaign_name='$campaign_name',active='$active',dial_status_a='$dial_status_a',dial_status_b='$dial_status_b',dial_status_c='$dial_status_c',dial_status_d='$dial_status_d',dial_status_e='$dial_status_e',lead_order='$lead_order',allow_closers='$allow_closers',hopper_level='$hopper_level', auto_dial_level='$auto_dial_level', next_agent_call='$next_agent_call', local_call_time='$local_call_time', voicemail_ext='$voicemail_ext', dial_timeout='$dial_timeout', dial_prefix='$dial_prefix', campaign_cid='$campaign_cid', campaign_vdad_exten='$campaign_vdad_exten' where campaign_id='$campaign_id';";
		$rslt=mysql_query($stmt, $link);

		if ($reset_hopper == 'Y')
			{
			echo "<br>RESETTING CAMPAIGN LEAD HOPPER\n";
			echo "<br> - Wait 1 minute before dialing next number\n";
			$stmt="DELETE from vicidial_hopper where campaign_id='$campaign_id' and status='READY';";
			$rslt=mysql_query($stmt, $link);

			### LOG RESET TO LOG FILE ###
			$fp = fopen ("./admin_changes_log.txt", "a");
			fwrite ($fp, "$date|CAMPAIGN HOPPERRESET|$PHP_AUTH_USER|$ip|campaign_name='$campaign_name'|\n");
			fclose($fp);
			}

		### LOG CHANGES TO LOG FILE ###
		$fp = fopen ("./admin_changes_log.txt", "a");
		fwrite ($fp, "$date|MODIFY CAMPAIGN INFO|$PHP_AUTH_USER|$ip|campaign_name='$campaign_name',active='$active',dial_status_a='$dial_status_a',dial_status_b='$dial_status_b',dial_status_c='$dial_status_c',dial_status_d='$dial_status_d',dial_status_e='$dial_status_e',lead_order='$lead_order',allow_closers='$allow_closers',hopper_level='$hopper_level', auto_dial_level='$auto_dial_level', next_agent_call='$next_agent_call', local_call_time='$local_call_time', voicemail_ext='$voicemail_ext', dial_timeout='$dial_timeout', dial_prefix='$dial_prefix', campaign_cid='$campaign_cid', campaign_vdad_exten='$campaign_vdad_exten' where campaign_id='$campaign_id'|$reset_hopper|\n");
		fclose($fp);

		}

$ADD=31;	# go to campaign modification form below
}

######################
# ADD=42 delete campaign status in the system
######################

if ($ADD==42)
{
	echo "<FONT FACE=\"ARIAL,HELVETICA\" COLOR=BLACK SIZE=2>";

	 if ( (strlen($campaign_id) < 2) or (strlen($status) < 1) )
		{
		 echo "<br>CAMPAIGN STATUS NOT MODIFIED - Please go back and look at the data you entered\n";
		 echo "<br>the campaign id needs to be at least 2 characters in length\n";
		 echo "<br>the campaign status needs to be at least 1 characters in length\n";
		}
	 else
		{
		echo "<br><B>CUSTOM CAMPAIGN STATUS DELETED: $campaign_id - $status</B>\n";

		$stmt="DELETE FROM vicidial_campaign_statuses where campaign_id='$campaign_id' and status='$status';";
		$rslt=mysql_query($stmt, $link);

		### LOG CHANGES TO LOG FILE ###
		$fp = fopen ("./admin_changes_log.txt", "a");
		fwrite ($fp, "$date|DELETE CAMPAIGN STATUS|$PHP_AUTH_USER|$ip|DELETE FROM vicidial_campaign_statuses where campaign_id='$campaign_id' and status='$status'|\n");
		fclose($fp);

		}

$ADD=31;	# go to campaign modification form below
}

######################
# ADD=411 submit list modifications to the system
######################

if ($ADD==411)
{
	echo "<FONT FACE=\"ARIAL,HELVETICA\" COLOR=BLACK SIZE=2>";

	 if ( (strlen($list_name) < 2) or (strlen($campaign_id) < 2) )
		{
		 echo "<br>LIST NOT MODIFIED - Please go back and look at the data you entered\n";
		 echo "<br>list name must be at least 2 characters in length\n";
		}
	 else
		{
		echo "<br><B>LIST MODIFIED: $list_id</B>\n";

		$stmt="UPDATE vicidial_lists set list_name='$list_name',campaign_id='$campaign_id',active='$active' where list_id='$list_id';";
		$rslt=mysql_query($stmt, $link);

		if ($reset_list == 'Y')
			{
			echo "<br>RESETTING LIST-CALLED-STATUS\n";
			$stmt="UPDATE vicidial_list set called_since_last_reset='N' where list_id='$list_id';";
			$rslt=mysql_query($stmt, $link);
			### LOG RESET TO LOG FILE ###
			$fp = fopen ("./admin_changes_log.txt", "a");
			fwrite ($fp, "$date|RESET LIST CALLED   |$PHP_AUTH_USER|$ip|list_name='$list_name'|\n");
			fclose($fp);
			}
		if ($campaign_id != "$old_campaign_id")
			{
			echo "<br>REMOVING LIST HOPPER LEADS FROM OLD CAMPAIGN HOPPER ($old_campaign_id)\n";
			$stmt="DELETE from vicidial_hopper where list_id='$list_id' and campaign_id='$old_campaign_id';";
			$rslt=mysql_query($stmt, $link);
			}

		### LOG CHANGES TO LOG FILE ###
		$fp = fopen ("./admin_changes_log.txt", "a");
		fwrite ($fp, "$date|MODIFY LIST INFO    |$PHP_AUTH_USER|$ip|list_name='$list_name',campaign_id='$campaign_id',active='$active' where list_id='$list_id'|\n");
		fclose($fp);

		}

$ADD=311;	# go to list modification form below
}


######################
# ADD=4111 modify group info in the system
######################

if ($ADD==4111)
{
	echo "<FONT FACE=\"ARIAL,HELVETICA\" COLOR=BLACK SIZE=2>";

	 if ( (strlen($group_name) < 2) or (strlen($group_color) < 2) )
		{
		 echo "<br>GROUP NOT MODIFIED - Please go back and look at the data you entered\n";
		 echo "<br>group name and group color must be at least 2 characters in length\n";
		}
	 else
		{
		echo "<br><B>GROUP MODIFIED: $group_id</B>\n";

		$stmt="UPDATE vicidial_inbound_groups set group_name='$group_name', group_color='$group_color', active='$active', web_form_address='$web_form_address', voicemail_ext='$voicemail_ext', next_agent_call='$next_agent_call', fronter_display='$fronter_display' where group_id='$group_id';";
		$rslt=mysql_query($stmt, $link);

		### LOG CHANGES TO LOG FILE ###
		$fp = fopen ("./admin_changes_log.txt", "a");
		fwrite ($fp, "$date|MODIFY GROUP INFO   |$PHP_AUTH_USER|$ip|group_name='$group_name',group_color='$group_color',active='$active', web_form_address='$web_form_address', voicemail_ext='$voicemail_ext', next_agent_call='$next_agent_call', fronter_display='$fronter_display' where group_id='$group_id'|\n");
		fclose($fp);

		}

$ADD=3111;	# go to group modification form below
}



######################
# ADD=41111 modify remote agents info in the system
######################

if ($ADD==41111)
{
	echo "<FONT FACE=\"ARIAL,HELVETICA\" COLOR=BLACK SIZE=2>";

	 if ( (strlen($server_ip) < 2) or (strlen($user_start) < 2)  or (strlen($campaign_id) < 2) or (strlen($conf_exten) < 2) )
		{
		 echo "<br>REMOTE AGENTS NOT MODIFIED - Please go back and look at the data you entered\n";
		 echo "<br>User ID Start and External Extension must be at least 2 characters in length\n";
		}
	 else
		{
		$stmt="UPDATE vicidial_remote_agents set user_start='$user_start', number_of_lines='$number_of_lines', server_ip='$server_ip', conf_exten='$conf_exten', status='$status', campaign_id='$campaign_id', closer_campaigns='$groups_value' where remote_agent_id='$remote_agent_id';";
		$rslt=mysql_query($stmt, $link);

		echo "<br><B>REMOTE AGENTS MODIFIED</B>\n";

		### LOG CHANGES TO LOG FILE ###
		$fp = fopen ("./admin_changes_log.txt", "a");
		fwrite ($fp, "$date|MODIFY REMOTE AGENTS ENTRY     |$PHP_AUTH_USER|$ip|set user_start='$user_start', number_of_lines='$number_of_lines', server_ip='$server_ip', conf_exten='$conf_exten', status='$status', campaign_id='$campaign_id', closer_campaigns='$groups_value' where remote_agent_id='$remote_agent_id'|\n");
		fclose($fp);

		}

$ADD=31111;	# go to remote agents modification form below
}



######################
# ADD=411111 modify user group info in the system
######################

if ($ADD==411111)
{
	echo "<FONT FACE=\"ARIAL,HELVETICA\" COLOR=BLACK SIZE=2>";

	 if ( (strlen($user_group) < 2) or (strlen($group_name) < 2) )
		{
		 echo "<br>USER GROUP NOT MODIFIED - Please go back and look at the data you entered\n";
		 echo "<br>Group name and description must be at least 2 characters in length\n";
		}
	 else
		{
		$stmt="UPDATE vicidial_user_groups set user_group='$user_group', group_name='$group_name' where user_group='$OLDuser_group';";
		$rslt=mysql_query($stmt, $link);

		echo "<br><B>USER GROUP MODIFIED</B>\n";

		### LOG CHANGES TO LOG FILE ###
		$fp = fopen ("./admin_changes_log.txt", "a");
		fwrite ($fp, "$date|MODIFY USER GROUP ENTRY     |$PHP_AUTH_USER|$ip|UPDATE vicidial_user_groups set user_group='$user_group', group_name='$group_name' where user_group='$OLDuser_group'|\n");
		fclose($fp);

		}

$ADD=311111;	# go to user group modification form below
}








######################################################################################################
######################################################################################################
#######   3 series, record modification forms
######################################################################################################
######################################################################################################




######################
# ADD=3 modify user info in the system
######################

if ($ADD==3)
{
	echo "<FONT FACE=\"ARIAL,HELVETICA\" COLOR=BLACK SIZE=2>";

	$stmt="SELECT * from vicidial_users where user='$user';";
	$rslt=mysql_query($stmt, $link);
	$row=mysql_fetch_row($rslt);
	$user_group =	$row[5];

echo "<br>MODIFY A USER'S RECORD: $row[1]<form action=$PHP_SELF method=POST>\n";
echo "<input type=hidden name=ADD value=4>\n";
echo "<input type=hidden name=user value=\"$row[1]\">\n";
echo "<center><TABLE width=600 cellspacing=3>\n";
echo "<tr bgcolor=#B6D3FC><td align=right>User Number: </td><td align=left><b>$row[1]</b>$NWB#vicidial_users-user$NWE</td></tr>\n";
echo "<tr bgcolor=#B6D3FC><td align=right>Password: </td><td align=left><input type=text name=pass size=20 maxlength=10 value=\"$row[2]\">$NWB#vicidial_users-pass$NWE</td></tr>\n";
echo "<tr bgcolor=#B6D3FC><td align=right>Full Name: </td><td align=left><input type=text name=full_name size=30 maxlength=30 value=\"$row[3]\">$NWB#vicidial_users-full_name$NWE</td></tr>\n";
echo "<tr bgcolor=#B6D3FC><td align=right>User Level: </td><td align=left><select size=1 name=user_level><option>1</option><option>2</option><option>3</option><option>4</option><option>5</option><option>6</option><option>7</option><option>8</option><option>9</option><option SELECTED>$row[4]</option></select>$NWB#vicidial_users-user_level$NWE</td></tr>\n";
echo "<tr bgcolor=#B6D3FC><td align=right>User Group: </td><td align=left><select size=1 name=user_group>\n";

	$stmt="SELECT user_group,group_name from vicidial_user_groups order by user_group";
	$rsltx=mysql_query($stmt, $link);
	$Ugroups_to_print = mysql_num_rows($rsltx);
	$Ugroups_list='';

	$o=0;
	while ($Ugroups_to_print > $o) {
		$rowx=mysql_fetch_row($rsltx);
		$Ugroups_list .= "<option value=\"$rowx[0]\">$rowx[0] - $rowx[1]</option>\n";
		$o++;
	}
echo "$Ugroups_list";
echo "<option SELECTED>$user_group</option>\n";
echo "</select>$NWB#vicidial_users-user_group$NWE</td></tr>\n";
echo "<tr bgcolor=#B6D3FC><td align=center colspan=2><input type=submit name=submit value=submit></td></tr>\n";
echo "</TABLE></center>\n";

echo "<br><br><a href=\"./user_stats.php?user=$row[1]\">Click here for user stats</a>\n";

}


######################
# ADD=31 modify campaign info in the system
######################

if ($ADD==31)
{
	echo "<FONT FACE=\"ARIAL,HELVETICA\" COLOR=BLACK SIZE=2>";

	$stmt="SELECT * from vicidial_campaigns where campaign_id='$campaign_id';";
	$rslt=mysql_query($stmt, $link);
	$row=mysql_fetch_row($rslt);
	$dial_status_a = $row[3];
	$dial_status_b = $row[4];
	$dial_status_c = $row[5];
	$dial_status_d = $row[6];
	$dial_status_e = $row[7];
	$lead_order = $row[8];
	$hopper_level = $row[13];
	$auto_dial_level = $row[14];
	$next_agent_call = $row[15];
	$local_call_time = $row[16];
	$voicemail_ext = $row[17];
	$dial_timeout = $row[18];
	$dial_prefix = $row[19];
	$campaign_cid = $row[20];
	$campaign_vdad_exten = $row[21];

echo "<br>MODIFY A CAMPAIGN'S RECORD: $row[0]<form action=$PHP_SELF method=POST>\n";
echo "<input type=hidden name=ADD value=41>\n";
echo "<input type=hidden name=campaign_id value=\"$campaign_id\">\n";
echo "<center><TABLE width=600 cellspacing=3>\n";
echo "<tr bgcolor=#B6D3FC><td align=right>Campaign ID: </td><td align=left><b>$row[0]</b>$NWB#vicidial_campaigns-campaign_id$NWE</td></tr>\n";
echo "<tr bgcolor=#B6D3FC><td align=right>Campaign Name: </td><td align=left><input type=text name=campaign_name size=40 maxlength=40 value=\"$row[1]\">$NWB#vicidial_campaigns-campaign_name$NWE</td></tr>\n";
echo "<tr bgcolor=#B6D3FC><td align=right>Active: </td><td align=left><select size=1 name=active><option>Y</option><option>N</option><option SELECTED>$row[2]</option></select>$NWB#vicidial_campaigns-active$NWE</td></tr>\n";
echo "<tr bgcolor=#B6D3FC><td align=right>Park Extension: </td><td align=left>$row[9] - $row[10]$NWB#vicidial_campaigns-park_ext$NWE</td></tr>\n";
echo "<tr bgcolor=#B6D3FC><td align=right>Web Form: </td><td align=left>$row[11]$NWB#vicidial_campaigns-web_form_address$NWE</td></tr>\n";
echo "<tr bgcolor=#B6D3FC><td align=right>Allow Closers: </td><td align=left><select size=1 name=allow_closers><option>Y</option><option>N</option><option SELECTED>$row[12]</option></select>$NWB#vicidial_campaigns-allow_closers$NWE</td></tr>\n";
echo "<tr bgcolor=#B6D3FC><td align=right>Dial status 1: </td><td align=left><select size=1 name=dial_status_a>\n";

	$stmt="SELECT * from vicidial_statuses order by status";
	$rsltx=mysql_query($stmt, $link);
	$statuses_to_print = mysql_num_rows($rsltx);
	$statuses_list='';

	$o=0;
	while ($statuses_to_print > $o) {
		$rowx=mysql_fetch_row($rsltx);
		$statuses_list .= "<option value=\"$rowx[0]\">$rowx[0] - $rowx[1]</option>\n";
		$o++;
	}

	$stmt="SELECT * from vicidial_campaign_statuses where campaign_id='$campaign_id' order by status";
	$rsltx=mysql_query($stmt, $link);
	$Cstatuses_to_print = mysql_num_rows($rsltx);

	$o=0;
	while ($Cstatuses_to_print > $o) {
		$rowx=mysql_fetch_row($rsltx);
		$statuses_list .= "<option value=\"$rowx[0]\">$rowx[0] - $rowx[1]</option>\n";
		$o++;
	}
echo "$statuses_list";
echo "<option SELECTED>$dial_status_a</option>\n";
echo "</select>$NWB#vicidial_campaigns-dial_status$NWE</td></tr>\n";

echo "<tr bgcolor=#B6D3FC><td align=right>Dial status 2: </td><td align=left><select size=1 name=dial_status_b>\n";
echo "$statuses_list";
echo "<option SELECTED>$dial_status_b</option>\n";
echo "</select>$NWB#vicidial_campaigns-dial_status$NWE</td></tr>\n";
echo "<tr bgcolor=#B6D3FC><td align=right>Dial status 3: </td><td align=left><select size=1 name=dial_status_c>\n";
echo "$statuses_list";
echo "<option SELECTED>$dial_status_c</option>\n";
echo "</select>$NWB#vicidial_campaigns-dial_status$NWE</td></tr>\n";
echo "<tr bgcolor=#B6D3FC><td align=right>Dial status 4: </td><td align=left><select size=1 name=dial_status_d>\n";
echo "$statuses_list";
echo "<option SELECTED>$dial_status_d</option>\n";
echo "</select>$NWB#vicidial_campaigns-dial_status$NWE</td></tr>\n";
echo "<tr bgcolor=#B6D3FC><td align=right>Dial status 5: </td><td align=left><select size=1 name=dial_status_e>\n";
echo "$statuses_list";
echo "<option SELECTED>$dial_status_e</option>\n";
echo "</select>$NWB#vicidial_campaigns-dial_status$NWE</td></tr>\n";

echo "<tr bgcolor=#B6D3FC><td align=right>List Order: </td><td align=left><select size=1 name=lead_order><option>DOWN</option><option>UP</option><option>UP PHONE</option><option>DOWN PHONE</option><option>UP LAST NAME</option><option>DOWN LAST NAME</option><option>UP COUNT</option><option>DOWN COUNT</option><option>DOWN COUNT 2nd NEW</option><option>DOWN COUNT 3rd NEW</option><option>DOWN COUNT 4th NEW</option><option SELECTED>$lead_order</option></select>$NWB#vicidial_campaigns-lead_order$NWE</td></tr>\n";

echo "<tr bgcolor=#B6D3FC><td align=right>Hopper Level: </td><td align=left><select size=1 name=hopper_level><option>1</option><option>5</option><option>10</option><option>50</option><option>100</option><option>200</option><option>500</option><option SELECTED>$hopper_level</option></select>$NWB#vicidial_campaigns-hopper_level$NWE</td></tr>\n";

echo "<tr bgcolor=#B6D3FC><td align=right>Force Reset of Hopper: </td><td align=left><select size=1 name=reset_hopper><option>Y</option><option SELECTED>N</option></select>$NWB#vicidial_campaigns-force_reset_hopper$NWE</td></tr>\n";

echo "<tr bgcolor=#B6D3FC><td align=right>Auto Dial Level: </td><td align=left><select size=1 name=auto_dial_level><option >0</option><option>1</option><option>1.1</option><option>1.2</option><option>1.3</option><option>1.4</option><option>1.5</option><option>1.6</option><option>1.7</option><option>1.8</option><option>1.9</option><option>2.0</option><option>2.2</option><option>2.5</option><option>2.7</option><option>3.0</option><option>3.5</option><option SELECTED>$auto_dial_level</option></select>(0 = off)$NWB#vicidial_campaigns-auto_dial_level$NWE</td></tr>\n";

echo "<tr bgcolor=#B6D3FC><td align=right>Next Agent Call: </td><td align=left><select size=1 name=next_agent_call><option >random</option><option>oldest_call_start</option><option>oldest_call_finish</option><option SELECTED>$next_agent_call</option></select>$NWB#vicidial_campaigns-next_agent_call$NWE</td></tr>\n";

echo "<tr bgcolor=#B6D3FC><td align=right>Local Call Time: </td><td align=left><select size=1 name=local_call_time><option >24hours</option><option >9am-9pm</option><option>9am-5pm</option><option>12pm-5pm</option><option>12pm-9pm</option><option>5pm-9pm</option><option SELECTED>$local_call_time</option></select>$NWB#vicidial_campaigns-local_call_time$NWE</td></tr>\n";

echo "<tr bgcolor=#B6D3FC><td align=right>Voicemail: </td><td align=left><input type=text name=voicemail_ext size=10 maxlength=10 value=\"$voicemail_ext\">$NWB#vicidial_campaigns-voicemail_ext$NWE</td></tr>\n";

echo "<tr bgcolor=#B6D3FC><td align=right>Dial Timeout: </td><td align=left><input type=text name=dial_timeout size=3 maxlength=3 value=\"$dial_timeout\"> <i>in seconds</i>$NWB#vicidial_campaigns-dial_timeout$NWE</td></tr>\n";

echo "<tr bgcolor=#B6D3FC><td align=right>Dial Prefix: </td><td align=left><input type=text name=dial_prefix size=20 maxlength=20 value=\"$dial_prefix\"> <font size=1>for 91NXXNXXXXXX value would be 9, for no dial prefix use X</font>$NWB#vicidial_campaigns-dial_prefix$NWE</td></tr>\n";

echo "<tr bgcolor=#B6D3FC><td align=right>Campaign CallerID: </td><td align=left><input type=text name=campaign_cid size=20 maxlength=20 value=\"$campaign_cid\">$NWB#vicidial_campaigns-campaign_cid$NWE</td></tr>\n";

echo "<tr bgcolor=#B6D3FC><td align=right>Campaign VDAD exten: </td><td align=left><input type=text name=campaign_vdad_exten size=10 maxlength=20 value=\"$campaign_vdad_exten\">$NWB#vicidial_campaigns-campaign_vdad_exten$NWE</td></tr>\n";

echo "<tr bgcolor=#B6D3FC><td align=center colspan=2><input type=submit name=submit value=submit></td></tr>\n";
echo "</TABLE></center></FORM>\n";

	##### calculate what gmt_offset_now values are within the allowed local_call_time setting
	if ($local_call_time == '24hours')
		{
		$p='13';
		$GMT_allowed = '';
		while ($p > -13)
			{
			$tz = sprintf("%.2f", $p);	$GMT_allowed = "$GMT_allowed'$tz',";
			$p = ($p - 0.25);
			}
		}
	if ($local_call_time == '9am-9pm')
		{
		$p='13';
		$GMT_allowed = '';
		while ($p > -13)
			{
			$pzone=3600 * $p;
			$phour=gmdate("G", time() + $pzone);
			if ( ($phour >= 9) && ($phour <= 20) ){$tz = sprintf("%.2f", $p);	$GMT_allowed = "$GMT_allowed'$tz',";}
			$p = ($p - 0.25);
			}
		}
	if ($local_call_time == '9am-5pm')
		{
		$p='13';
		$GMT_allowed = '';
		while ($p > -13)
			{
			$pzone=3600 * $p;
			$phour=gmdate("G", time() + $pzone);
			if ( ($phour >= 9) && ($phour <= 16) ){$tz = sprintf("%.2f", $p);	$GMT_allowed = "$GMT_allowed'$tz',";}
			$p = ($p - 0.25);
			}
		}
	if ($local_call_time == '12pm-5pm')
		{
		$p='13';
		$GMT_allowed = '';
		while ($p > -13)
			{
			$pzone=3600 * $p;
			$phour=gmdate("G", time() + $pzone);
			if ( ($phour >= 12) && ($phour <= 16) ){$tz = sprintf("%.2f", $p);	$GMT_allowed = "$GMT_allowed'$tz',";}
			$p = ($p - 0.25);
			}
		}
	if ($local_call_time == '12pm-9pm')
		{
		$p='13';
		$GMT_allowed = '';
		while ($p > -13)
			{
			$pzone=3600 * $p;
			$phour=gmdate("G", time() + $pzone);
			if ( ($phour >= 12) && ($phour <= 20) ){$tz = sprintf("%.2f", $p);	$GMT_allowed = "$GMT_allowed'$tz',";}
			$p = ($p - 0.25);
			}
		}
	if ($local_call_time == '5pm-9pm')
		{
		$p='13';
		$GMT_allowed = '';
		while ($p > -13)
			{
			$pzone=3600 * $p;
			$phour=gmdate("G", time() + $pzone);
			if ( ($phour >= 17) && ($phour <= 20) ){$tz = sprintf("%.2f", $p);	$GMT_allowed = "$GMT_allowed'$tz',";}
			$p = ($p - 0.25);
			}
		}

	$GMT_allowed = "$GMT_allowed'99'";










echo "<center>\n";
echo "<br><b>LISTS WITHIN THIS CAMPAIGN: &nbsp; $NWB#vicidial_campaign_lists$NWE</b><br>\n";
echo "<TABLE width=400 cellspacing=3>\n";
echo "<tr><td>LIST ID</td><td>LIST NAME</td><td>ACTIVE</td></tr>\n";

	$active_lists = 0;
	$inactive_lists = 0;
	$stmt="SELECT list_id,active,list_name from vicidial_lists where campaign_id='$campaign_id'";
	$rsltx=mysql_query($stmt, $link);
	$lists_to_print = mysql_num_rows($rsltx);
	$camp_lists='';

	$o=0;
	while ($lists_to_print > $o) {
		$rowx=mysql_fetch_row($rsltx);
		$o++;
	if (ereg("Y", $rowx[1])) {$active_lists++;   $camp_lists .= "'$rowx[0]',";}
	if (ereg("N", $rowx[1])) {$inactive_lists++;}

	if (eregi("1$|3$|5$|7$|9$", $o))
		{$bgcolor='bgcolor="#B9CBFD"';} 
	else
		{$bgcolor='bgcolor="#9BB9FB"';}

	echo "<tr $bgcolor><td><font size=1><a href=\"$PHP_SELF?ADD=311&list_id=$rowx[0]\">$rowx[0]</a></td><td><font size=1>$rowx[2]</td><td><font size=1>$rowx[1]</td></tr>\n";

	}

echo "</table></center><br>\n";
echo "<center><b>\n";

	$camp_lists = eregi_replace(".$","",$camp_lists);
echo "This campaign has $active_lists active lists and $inactive_lists inactive lists<br><br>\n";
	$stmt="SELECT count(*) FROM vicidial_list where called_since_last_reset='N' and status IN('$dial_status_a','$dial_status_b','$dial_status_c','$dial_status_d','$dial_status_e') and list_id IN($camp_lists) and gmt_offset_now IN($GMT_allowed)";
	if ($DB) {echo "$stmt\n";}
	$rsltx=mysql_query($stmt, $link);
	$rsltx_rows = mysql_num_rows($rsltx);
	if ($rsltx_rows)
		{
		$rowx=mysql_fetch_row($rsltx);
		$active_leads = "$rowx[0]";
		}
	else {$active_leads = '0';}

echo "This campaign has $active_leads leads to be dialed in those lists<br><br>\n";
	$stmt="SELECT count(*) FROM vicidial_hopper where campaign_id='$campaign_id' and status IN('READY')";
	if ($DB) {echo "$stmt\n";}
	$rsltx=mysql_query($stmt, $link);
	$rowx=mysql_fetch_row($rsltx);
	$hopper_leads = "$rowx[0]";

echo "This campaign has $hopper_leads leads in the dial hopper<br><br>\n";
echo "<a href=\"./AST_VICIDIAL_hopperlist.php?group=$campaign_id\">Click here to see what leads are in the hopper right now</a><br><br>\n";
echo "</b></center>\n";




echo "<center>\n";
echo "<br><b>CUSTOM STATUSES WITHIN THIS CAMPAIGN: &nbsp; $NWB#vicidial_campaign_statuses$NWE</b><br>\n";
echo "<TABLE width=400 cellspacing=3>\n";
echo "<tr><td>STATUS</td><td>DESCRIPTION</td><td>SELECTABLE</td><td>DELETE</td></tr>\n";

	$stmt="SELECT * from vicidial_campaign_statuses where campaign_id='$campaign_id'";
	$rsltx=mysql_query($stmt, $link);
	$statuses_to_print = mysql_num_rows($rsltx);
	$o=0;
	while ($statuses_to_print > $o) {
		$rowx=mysql_fetch_row($rsltx);
		$o++;

	if (eregi("1$|3$|5$|7$|9$", $o))
		{$bgcolor='bgcolor="#B9CBFD"';} 
	else
		{$bgcolor='bgcolor="#9BB9FB"';}

	echo "<tr $bgcolor><td><font size=1>$rowx[0]</td><td><font size=1>$rowx[1]</td><td><font size=1>$rowx[2]</td><td><font size=1><a href=\"$PHP_SELF?ADD=42&campaign_id=$campaign_id&status=$rowx[0]&action=DELETE\">DELETE</a></td></tr>\n";

	}

echo "</table>\n";

echo "<br>ADD NEW CUSTOM CAMPAIGN STATUS<BR><form action=$PHP_SELF method=POST>\n";
echo "<input type=hidden name=ADD value=22>\n";
echo "<input type=hidden name=campaign_id value=\"$campaign_id\">\n";
echo "Status: <input type=text name=status size=10 maxlength=8> &nbsp; \n";
echo "Description: <input type=text name=status_name size=20 maxlength=30> &nbsp; \n";
echo "Selectable: <select size=1 name=selectable><option>Y</option><option>N</option></select> &nbsp; \n";
echo "<input type=submit name=submit value=ADD><BR>\n";

echo "</center></FORM><br>\n";

}


######################
# ADD=311 modify list info in the system
######################

if ($ADD==311)
{
	echo "<FONT FACE=\"ARIAL,HELVETICA\" COLOR=BLACK SIZE=2>";

	$stmt="SELECT * from vicidial_lists where list_id='$list_id';";
	$rslt=mysql_query($stmt, $link);
	$row=mysql_fetch_row($rslt);
	$campaign_id = $row[2];
	$active = $row[3];

echo "<br>MODIFY A LIST'S RECORD: $row[0]<form action=$PHP_SELF method=POST>\n";
echo "<input type=hidden name=ADD value=411>\n";
echo "<input type=hidden name=list_id value=\"$row[0]\">\n";
echo "<input type=hidden name=old_campaign_id value=\"$row[2]\">\n";
echo "<center><TABLE width=600 cellspacing=3>\n";
echo "<tr bgcolor=#B6D3FC><td align=right>List ID: </td><td align=left><b>$row[0]</b>$NWB#vicidial_lists-list_id$NWE</td></tr>\n";
echo "<tr bgcolor=#B6D3FC><td align=right>List Name: </td><td align=left><input type=text name=list_name size=20 maxlength=20 value=\"$row[1]\">$NWB#vicidial_lists-list_name$NWE</td></tr>\n";
echo "<tr bgcolor=#B6D3FC><td align=right><a href=\"$PHP_SELF?ADD=31&campaign_id=$campaign_id\">Campaign</a>: </td><td align=left><select size=1 name=campaign_id>\n";

	$stmt="SELECT campaign_id,campaign_name from vicidial_campaigns order by campaign_id";
	$rsltx=mysql_query($stmt, $link);
	$campaigns_to_print = mysql_num_rows($rsltx);
	$campaigns_list='';

	$o=0;
	while ($campaigns_to_print > $o) {
		$rowx=mysql_fetch_row($rsltx);
		$campaigns_list .= "<option value=\"$rowx[0]\">$rowx[0] - $rowx[1]</option>\n";
		$o++;
	}
echo "$campaigns_list";
echo "<option SELECTED>$campaign_id</option>\n";
echo "</select>$NWB#vicidial_lists-campaign_id$NWE</td></tr>\n";
echo "<tr bgcolor=#B6D3FC><td align=right>Active: </td><td align=left><select size=1 name=active><option>Y</option><option>N</option><option SELECTED>$active</option></select>$NWB#vicidial_lists-active$NWE</td></tr>\n";
echo "<tr bgcolor=#B6D3FC><td align=right>Reset Lead-Called-Status for this list: </td><td align=left><select size=1 name=reset_list><option>Y</option><option SELECTED>N</option></select>$NWB#vicidial_lists-reset_list$NWE</td></tr>\n";
echo "<tr bgcolor=#B6D3FC><td align=center colspan=2><input type=submit name=submit value=submit></td></tr>\n";
echo "</TABLE></center>\n";

echo "<center>\n";
echo "<br><b>STATUSES WITHIN THIS LIST:</b><br>\n";
echo "<TABLE width=400 cellspacing=3>\n";
echo "<tr><td>STATUS</td><td>CALLED</td><td>NOT CALLED</td></tr>\n";

	$leads_in_list = 0;
	$leads_in_list_N = 0;
	$leads_in_list_Y = 0;
	$stmt="SELECT status,called_since_last_reset,count(*) from vicidial_list where list_id='$list_id' group by status,called_since_last_reset order by status,called_since_last_reset";
	$rsltx=mysql_query($stmt, $link);
	$statuses_to_print = mysql_num_rows($rsltx);

	$o=0;
	while ($statuses_to_print > $o) {
		$rowx=mysql_fetch_row($rsltx);
	$leads_in_list = ($leads_in_list + $rowx[2]);

	if (eregi("1$|3$|5$|7$|9$", $o))
		{$bgcolor='bgcolor="#B9CBFD"';} 
	else
		{$bgcolor='bgcolor="#9BB9FB"';}

	if ($rowx[1] == 'N')
		{
		$leads_in_list_N = ($leads_in_list_N + $rowx[2]);
		echo "<tr $bgcolor><td><font size=1>$rowx[0]</td><td><font size=1> </td><td><font size=1>$rowx[2]</td></tr>\n";
		}
	else 
		{
		$leads_in_list_Y = ($leads_in_list_Y + $rowx[2]);
		echo "<tr $bgcolor><td><font size=1>$rowx[0]</td><td><font size=1>$rowx[2]</td><td><font size=1> </td></tr>\n";

		}

		$o++;
	}

echo "<tr><td><font size=1>SUBTOTALS</td><td><font size=1>$leads_in_list_Y</td><td><font size=1>$leads_in_list_N</td></tr>\n";
echo "<tr bgcolor=\"#9BB9FB\"><td><font size=1>TOTAL</td><td colspan=2 align=center><font size=1>$leads_in_list</td></tr>\n";

echo "</table></center><br>\n";





echo "<center>\n";
echo "<br><b>TIME ZONES WITHIN THIS LIST:</b><br>\n";
echo "<TABLE width=500 cellspacing=3>\n";
echo "<tr><td>GMT OFFSET NOW (local time)</td><td>CALLED</td><td>NOT CALLED</td></tr>\n";

	$leads_in_list = 0;
	$leads_in_list_N = 0;
	$leads_in_list_Y = 0;
	$stmt="SELECT gmt_offset_now,called_since_last_reset,count(*) from vicidial_list where list_id='$list_id' group by gmt_offset_now,called_since_last_reset order by gmt_offset_now,called_since_last_reset";
	$rsltx=mysql_query($stmt, $link);
	$statuses_to_print = mysql_num_rows($rsltx);

	$o=0;
	$plus='+';
	while ($statuses_to_print > $o) {
		$rowx=mysql_fetch_row($rsltx);
	$leads_in_list = ($leads_in_list + $rowx[2]);

	$LOCALzone=3600 * $rowx[0];
	$LOCALdate=gmdate("D M Y H:i", time() + $LOCALzone);

	if ($rowx[0] >= 0) {$rowx[0] = "$plus$rowx[0]";}
	if (eregi("1$|3$|5$|7$|9$", $o))
		{$bgcolor='bgcolor="#B9CBFD"';} 
	else
		{$bgcolor='bgcolor="#9BB9FB"';}

	if ($rowx[1] == 'N')
		{
		$leads_in_list_N = ($leads_in_list_N + $rowx[2]);
		echo "<tr $bgcolor><td><font size=1>$rowx[0] &nbsp; &nbsp; ($LOCALdate)</td><td><font size=1> </td><td><font size=1>$rowx[2]</td></tr>\n";
		}
	else 
		{
		$leads_in_list_Y = ($leads_in_list_Y + $rowx[2]);
		echo "<tr $bgcolor><td><font size=1>$rowx[0] &nbsp; &nbsp; ($LOCALdate)</td><td><font size=1>$rowx[2]</td><td><font size=1> </td></tr>\n";

		}

		$o++;
	}

echo "<tr><td><font size=1>SUBTOTALS</td><td><font size=1>$leads_in_list_Y</td><td><font size=1>$leads_in_list_N</td></tr>\n";
echo "<tr bgcolor=\"#9BB9FB\"><td><font size=1>TOTAL</td><td colspan=2 align=center><font size=1>$leads_in_list</td></tr>\n";

echo "</table></center><br>\n";







	$leads_in_list = 0;
	$leads_in_list_N = 0;
	$leads_in_list_Y = 0;
	$stmt="SELECT status,called_count,count(*) from vicidial_list where list_id='$list_id' group by status,called_count order by status,called_count";
	$rsltx=mysql_query($stmt, $link);
	$status_called_to_print = mysql_num_rows($rsltx);

	$o=0;
	$sts=0;
	$first_row=1;
	$all_called_first=1000;
	$all_called_last=0;
	while ($status_called_to_print > $o) 
	{
	$rowx=mysql_fetch_row($rsltx);
	$leads_in_list = ($leads_in_list + $rowx[2]);
	$count_statuses[$o]			= "$rowx[0]";
	$count_called[$o]			= "$rowx[1]";
	$count_count[$o]			= "$rowx[2]";
	$all_called_count[$rowx[1]] = ($all_called_count[$rowx[1]] + $rowx[2]);

	if ( (strlen($status[$sts]) < 1) or ($status[$sts] != "$rowx[0]") )
		{
		if ($first_row) {$first_row=0;}
		else {$sts++;}
		$status[$sts] = "$rowx[0]";
		$status_called_first[$sts] = "$rowx[1]";
		if ($status_called_first[$sts] < $all_called_first) {$all_called_first = $status_called_first[$sts];}
		}
	$leads_in_sts[$sts] = ($leads_in_sts[$sts] + $rowx[2]);
	$status_called_last[$sts] = "$rowx[1]";
	if ($status_called_last[$sts] > $all_called_last) {$all_called_last = $status_called_last[$sts];}

	$o++;
	}




echo "<center>\n";
echo "<br><b>CALLED COUNTS WITHIN THIS LIST:</b><br>\n";
echo "<TABLE width=500 cellspacing=1>\n";
echo "<tr><td align=center><font size=1>STATUS</td>";
$first = $all_called_first;
while ($first <= $all_called_last)
	{
	echo "<td align=center><font size=1>$first</td>";
	$first++;
	}
echo "<td align=center><font size=1>SUBTOTAL</td></tr>\n";

	$sts=0;
	$statuses_called_to_print = count($status);
	while ($statuses_called_to_print > $sts) 
	{
	if (eregi("1$|3$|5$|7$|9$", $sts))
		{$bgcolor='bgcolor="#B9CBFD"';   $AB='bgcolor="#9BB9FB"';} 
	else
		{$bgcolor='bgcolor="#9BB9FB"';   $AB='bgcolor="#B9CBFD"';}
#	echo "$status[$sts]|$status_called_first[$sts]|$status_called_last[$sts]|$leads_in_sts[$sts]|\n";
#	echo "$status[$sts]|";
	echo "<tr $bgcolor><td><font size=1>$status[$sts]</td>";

	$first = $all_called_first;
	while ($first <= $all_called_last)
		{
		if (eregi("1$|3$|5$|7$|9$", $sts))
			{
			if (eregi("1$|3$|5$|7$|9$", $first)) {$AB='bgcolor="#9BB9FB"';} 
			else{$AB='bgcolor="#B9CBFD"';}
			}
		else
			{
			if (eregi("0$|2$|4$|6$|8$", $first)) {$AB='bgcolor="#9BB9FB"';} 
			else{$AB='bgcolor="#B9CBFD"';}
			}

		$called_printed=0;
		$o=0;
		while ($status_called_to_print > $o) 
			{
			if ( ($count_statuses[$o] == "$status[$sts]") and ($count_called[$o] == "$first") )
				{
				$called_printed++;
				echo "<td $AB><font size=1> $count_count[$o]</td>";
				}


			$o++;
			}
		if (!$called_printed) 
			{echo "<td $AB><font size=1> &nbsp;</td>";}
		$first++;
		}
	echo "<td><font size=1>$leads_in_sts[$sts]</td></tr>\n\n";

	$sts++;
	}

echo "<tr><td align=center><b><font size=1>TOTAL</td>";
$first = $all_called_first;
while ($first <= $all_called_last)
	{
	echo "<td align=center><b><font size=1>$all_called_count[$first]</td>";
	$first++;
	}
echo "<td align=center><b><font size=1>$leads_in_list</td></tr>\n";

echo "</table></center><br>\n";





echo "<center><b>\n";

}



######################
# ADD=3111 modify in-group info in the system
######################

if ($ADD==3111)
{
	echo "<FONT FACE=\"ARIAL,HELVETICA\" COLOR=BLACK SIZE=2>";

	$stmt="SELECT * from vicidial_inbound_groups where group_id='$group_id';";
	$rslt=mysql_query($stmt, $link);
	$row=mysql_fetch_row($rslt);
	$group_name = $row[1];
	$group_color = $row[2];
	$active = $row[3];
	$web_form_address = $row[4];
	$voicemail_ext = $row[5];
	$next_agent_call = $row[6];
	$fronter_display = $row[7];

echo "<br>MODIFY A GROUP'S RECORD: $row[0]<form action=$PHP_SELF method=POST>\n";
echo "<input type=hidden name=ADD value=4111>\n";
echo "<input type=hidden name=group_id value=\"$row[0]\">\n";
echo "<center><TABLE width=600 cellspacing=3>\n";
echo "<tr bgcolor=#B6D3FC><td align=right>Group ID: </td><td align=left><b>$row[0]</b>$NWB#vicidial_inbound_groups-group_id$NWE</td></tr>\n";
echo "<tr bgcolor=#B6D3FC><td align=right>Group Name: </td><td align=left><input type=text name=group_name size=30 maxlength=30 value=\"$row[1]\">$NWB#vicidial_inbound_groups-group_name$NWE</td></tr>\n";
echo "<tr bgcolor=#B6D3FC><td align=right>Group Color: </td><td align=left bgcolor=\"$row[2]\"><input type=text name=group_color size=7 maxlength=7 value=\"$row[2]\">$NWB#vicidial_inbound_groups-group_color$NWE</td></tr>\n";
echo "<tr bgcolor=#B6D3FC><td align=right>Active: </td><td align=left><select size=1 name=active><option>Y</option><option>N</option><option SELECTED>$active</option></select>$NWB#vicidial_inbound_groups-active$NWE</td></tr>\n";
echo "<tr bgcolor=#B6D3FC><td align=right>Web Form: </td><td align=left><input type=text name=web_form_address size=50 maxlength=255 value=\"$web_form_address\">$NWB#vicidial_inbound_groups-web_form_address$NWE</td></tr>\n";
echo "<tr bgcolor=#B6D3FC><td align=right>Voicemail: </td><td align=left><input type=text name=voicemail_ext size=10 maxlength=10 value=\"$voicemail_ext\">$NWB#vicidial_inbound_groups-voicemail_ext$NWE</td></tr>\n";
echo "<tr bgcolor=#B6D3FC><td align=right>Next Agent Call: </td><td align=left><select size=1 name=next_agent_call><option >random</option><option>oldest_call_start</option><option>oldest_call_finish</option><option SELECTED>$next_agent_call</option></select>$NWB#vicidial_inbound_groups-next_agent_call$NWE</td></tr>\n";
echo "<tr bgcolor=#B6D3FC><td align=right>Fronter Display: </td><td align=left><select size=1 name=fronter_display><option>Y</option><option>N</option><option SELECTED>$fronter_display</option></select>$NWB#vicidial_inbound_groups-fronter_display$NWE</td></tr>\n";

echo "<tr bgcolor=#B6D3FC><td align=center colspan=2><input type=submit name=submit value=submit></td></tr>\n";
echo "</TABLE></center>\n";

echo "</table></center><br>\n";

echo "<center><b>\n";

}



######################
# ADD=31111 modify remote agents info in the system
######################

if ($ADD==31111)
{
	echo "<FONT FACE=\"ARIAL,HELVETICA\" COLOR=BLACK SIZE=2>";

	$stmt="SELECT * from vicidial_remote_agents where remote_agent_id='$remote_agent_id';";
	$rslt=mysql_query($stmt, $link);
	$row=mysql_fetch_row($rslt);
	$remote_agent_id =	$row[0];
	$user_start =		$row[1];
	$number_of_lines =	$row[2];
	$server_ip =		$row[3];
	$conf_exten =		$row[4];
	$status =			$row[5];
	$campaign_id =		$row[6];

echo "<br>MODIFY A REMOTE AGENTS ENTRY: $row[0]<form action=$PHP_SELF method=POST>\n";
echo "<input type=hidden name=ADD value=41111>\n";
echo "<input type=hidden name=remote_agent_id value=\"$row[0]\">\n";
echo "<center><TABLE width=600 cellspacing=3>\n";
echo "<tr bgcolor=#B6D3FC><td align=right>User ID Start: </td><td align=left><input type=text name=user_start size=6 maxlength=6 value=\"$user_start\"> (numbers only, incremented)$NWB#vicidial_remote_agents-user_start$NWE</td></tr>\n";
echo "<tr bgcolor=#B6D3FC><td align=right>Number of Lines: </td><td align=left><input type=text name=number_of_lines size=3 maxlength=3 value=\"$number_of_lines\"> (numbers only)$NWB#vicidial_remote_agents-number_of_lines$NWE</td></tr>\n";
echo "<tr bgcolor=#B6D3FC><td align=right>Server IP: </td><td align=left><select size=1 name=server_ip>\n";
echo "$servers_list";
echo "<option SELECTED>$row[3]</option>\n";
echo "</select>$NWB#vicidial_remote_agents-server_ip$NWE</td></tr>\n";
echo "<tr bgcolor=#B6D3FC><td align=right>External Extension: </td><td align=left><input type=text name=conf_exten size=20 maxlength=20 value=\"$conf_exten\"> (dialplan number dialed to reach agents)$NWB#vicidial_remote_agents-conf_exten$NWE</td></tr>\n";
echo "<tr bgcolor=#B6D3FC><td align=right>Status: </td><td align=left><select size=1 name=status><option SELECTED>ACTIVE</option><option>INACTIVE</option><option SELECTED>$status</option></select>$NWB#vicidial_remote_agents-status$NWE</td></tr>\n";
echo "<tr bgcolor=#B6D3FC><td align=right>Campaign: </td><td align=left><select size=1 name=campaign_id>\n";
echo "$campaigns_list";
echo "<option SELECTED>$campaign_id</option>\n";
echo "</select>$NWB#vicidial_remote_agents-campaign_id$NWE</td></tr>\n";
echo "<tr bgcolor=#B6D3FC><td align=right>Inbound Groups: </td><td align=left>\n";
echo "$groups_list";
echo "$NWB#vicidial_remote_agents-closer_campaigns$NWE</td></tr>\n";
echo "<tr bgcolor=#B6D3FC><td align=center colspan=2><input type=submit name=submit value=submit></td></tr>\n";
echo "</TABLE></center>\n";
echo "NOTE: It can take up to 30 seconds for changes submitted on this screen to go live\n";

}


######################
# ADD=311111 modify user group info in the system
######################

if ($ADD==311111)
{
	echo "<FONT FACE=\"ARIAL,HELVETICA\" COLOR=BLACK SIZE=2>";

	$stmt="SELECT * from vicidial_user_groups where user_group='$user_group';";
	$rslt=mysql_query($stmt, $link);
	$row=mysql_fetch_row($rslt);
	$user_group =		$row[0];
	$group_name =		$row[1];
echo "<FONT FACE=\"ARIAL,HELVETICA\" COLOR=BLACK SIZE=2>";

echo "<br>MODIFY A USERS GROUP ENTRY<form action=$PHP_SELF method=POST>\n";
echo "<input type=hidden name=ADD value=411111>\n";
echo "<input type=hidden name=OLDuser_group value=\"$user_group\">\n";
echo "<center><TABLE width=600 cellspacing=3>\n";
echo "<tr bgcolor=#B6D3FC><td align=right>Group: </td><td align=left><input type=text name=user_group size=15 maxlength=20 value=\"$user_group\"> (no spaces or punctuation)$NWB#vicidial_user_groups-user_group$NWE</td></tr>\n";
echo "<tr bgcolor=#B6D3FC><td align=right>Description: </td><td align=left><input type=text name=group_name size=40 maxlength=40 value=\"$group_name\"> (description of group)$NWB#vicidial_user_groups-group_name$NWE</td></tr>\n";
echo "<tr bgcolor=#B6D3FC><td align=center colspan=2><input type=submit name=submit value=submit></td></tr>\n";
echo "</TABLE></center>\n";

}








######################
# ADD=5 search form
######################

if ($ADD==5)
{
echo "<FONT FACE=\"ARIAL,HELVETICA\" COLOR=BLACK SIZE=2>";

echo "<br>SEARCH FOR A USER<form action=$PHP_SELF method=POST>\n";
echo "<input type=hidden name=ADD value=6>\n";
echo "<center><TABLE width=600 cellspacing=3>\n";
echo "<tr bgcolor=#B6D3FC><td align=right>User Number: </td><td align=left><input type=text name=user size=20 maxlength=20></td></tr>\n";
echo "<tr bgcolor=#B6D3FC><td align=right>Full Name: </td><td align=left><input type=text name=full_name size=30 maxlength=30></td></tr>\n";
echo "<tr bgcolor=#B6D3FC><td align=right>User Level: </td><td align=left><select size=1 name=user_level><option selected>0</option><option>1</option><option>2</option><option>3</option><option>4</option><option>5</option><option>6</option><option>7</option><option>8</option><option>9</option></select></td></tr>\n";
echo "<tr bgcolor=#B6D3FC><td align=right>User Group: </td><td align=left><input type=text name=user_group size=15 maxlength=20></td></tr>\n";
echo "<tr bgcolor=#B6D3FC><td align=center colspan=2><input type=submit name=search value=search></td></tr>\n";
echo "</TABLE></center>\n";

}

######################
# ADD=6 user search results
######################

if ($ADD==6)
{
	echo "<FONT FACE=\"ARIAL,HELVETICA\" COLOR=BLACK SIZE=2>";

	$SQL = '';
	if ($user) {$SQL .= " user LIKE \"%$user%\" and";}
	if ($full_name) {$SQL .= " full_name LIKE \"%$full_name%\" and";}
	if ($user_level > 0) {$SQL .= " user_level LIKE \"%$user_level%\" and";}
	if ($user_group) {$SQL .= " user_group LIKE \"%$user_group%\" and";}
	$SQL = eregi_replace(" and$", "", $SQL);
	if (strlen($SQL)>5) {$SQL = "where $SQL";}

	$stmt="SELECT * from vicidial_users $SQL order by full_name desc;";
#	echo "\n|$stmt|\n";
	$rslt=mysql_query($stmt, $link);
	$people_to_print = mysql_num_rows($rslt);

echo "<br>SEARCH RESULTS:\n";
echo "<center><TABLE width=600 cellspacing=0 cellpadding=1>\n";

	$o=0;
	while ($people_to_print > $o) {
		$row=mysql_fetch_row($rslt);
		if (eregi("1$|3$|5$|7$|9$", $o))
			{$bgcolor='bgcolor="#B9CBFD"';} 
		else
			{$bgcolor='bgcolor="#9BB9FB"';}
		echo "<tr $bgcolor><td><font size=1>$row[1]</td><td><font size=1>$row[3]</td><td><font size=1>$row[4]</td><td><font size=1>$row[5]</td>";
		echo "<td><font size=1><a href=\"$PHP_SELF?ADD=3&user=$row[1]\">MODIFY</a> | <a href=\"./user_stats.php?user=$row[1]\">STATS</a></td></tr>\n";
		$o++;
	}

echo "</TABLE></center>\n";

}



######################
# ADD=0 display all active users
######################
if ($ADD==0)
{
	echo "<FONT FACE=\"ARIAL,HELVETICA\" COLOR=BLACK SIZE=2>";

	$stmt="SELECT * from vicidial_users order by full_name";
	$rslt=mysql_query($stmt, $link);
	$people_to_print = mysql_num_rows($rslt);

echo "<br>USER LISTINGS:\n";
echo "<center><TABLE width=600 cellspacing=0 cellpadding=1>\n";

	$o=0;
	while ($people_to_print > $o) {
		$row=mysql_fetch_row($rslt);
		if (eregi("1$|3$|5$|7$|9$", $o))
			{$bgcolor='bgcolor="#B9CBFD"';} 
		else
			{$bgcolor='bgcolor="#9BB9FB"';}
		echo "<tr $bgcolor><td><font size=1>$row[1]</td><td><font size=1>$row[3]</td><td><font size=1>$row[4]</td><td><font size=1>$row[5]</td>";
		echo "<td><font size=1><a href=\"$PHP_SELF?ADD=3&user=$row[1]\">MODIFY</a> | <a href=\"./user_stats.php?user=$row[1]\">STATS</a></td></tr>\n";
		$o++;
	}

echo "</TABLE></center>\n";
}

######################
# ADD=10 display all campaigns
######################
if ($ADD==10)
{
	echo "<FONT FACE=\"ARIAL,HELVETICA\" COLOR=BLACK SIZE=2>";

	$stmt="SELECT * from vicidial_campaigns order by campaign_id";
	$rslt=mysql_query($stmt, $link);
	$people_to_print = mysql_num_rows($rslt);

echo "<br>CAMPAIGN LISTINGS:\n";
echo "<center><TABLE width=600 cellspacing=0 cellpadding=1>\n";

	$o=0;
	while ($people_to_print > $o) {
		$row=mysql_fetch_row($rslt);
		if (eregi("1$|3$|5$|7$|9$", $o))
			{$bgcolor='bgcolor="#B9CBFD"';} 
		else
			{$bgcolor='bgcolor="#9BB9FB"';}
		echo "<tr $bgcolor><td><font size=1>$row[0]</td><td><font size=1>$row[1]</td>";
		echo "<td><font size=1> $row[2]</td>";
		echo "<td><font size=1> $row[3]</td><td><font size=1>$row[4]</td><td><font size=1>$row[5]</td>";
		echo "<td><font size=1> $row[6]</td><td><font size=1>$row[7]</td><td><font size=1> &nbsp;</td>";
		echo "<td><font size=1><a href=\"$PHP_SELF?ADD=31&campaign_id=$row[0]\">MODIFY</a></td></tr>\n";
		$o++;
	}

echo "</TABLE></center>\n";
}


######################
# ADD=100 display all lists
######################
if ($ADD==100)
{
	echo "<FONT FACE=\"ARIAL,HELVETICA\" COLOR=BLACK SIZE=2>";

	$stmt="SELECT * from vicidial_lists order by list_id";
	$rslt=mysql_query($stmt, $link);
	$people_to_print = mysql_num_rows($rslt);

echo "<br>LIST LISTINGS:\n";
echo "<center><TABLE width=600 cellspacing=0 cellpadding=1>\n";

	$o=0;
	while ($people_to_print > $o) {
		$row=mysql_fetch_row($rslt);
		if (eregi("1$|3$|5$|7$|9$", $o))
			{$bgcolor='bgcolor="#B9CBFD"';} 
		else
			{$bgcolor='bgcolor="#9BB9FB"';}
		echo "<tr $bgcolor><td><font size=1>$row[0]</td>";
		echo "<td><font size=1> $row[1]</td>";
		echo "<td><font size=1> $row[2]</td><td><font size=1>$row[4]</td><td><font size=1>$row[5]</td>";
		echo "<td><font size=1> $row[3]</td><td><font size=1>$row[7]</td><td><font size=1> &nbsp;</td>";
		echo "<td><font size=1><a href=\"$PHP_SELF?ADD=311&list_id=$row[0]\">MODIFY</a></td></tr>\n";
		$o++;
	}

echo "</TABLE></center>\n";
}



######################
# ADD=1000 display all inbound groups
######################
if ($ADD==1000)
{
	echo "<FONT FACE=\"ARIAL,HELVETICA\" COLOR=BLACK SIZE=2>";

	$stmt="SELECT * from vicidial_inbound_groups order by group_id";
	$rslt=mysql_query($stmt, $link);
	$people_to_print = mysql_num_rows($rslt);

echo "<br>INBOUND GROUP LISTINGS:\n";
echo "<center><TABLE width=600 cellspacing=0 cellpadding=1>\n";

	$o=0;
	while ($people_to_print > $o) {
		$row=mysql_fetch_row($rslt);
		if (eregi("1$|3$|5$|7$|9$", $o))
			{$bgcolor='bgcolor="#B9CBFD"';} 
		else
			{$bgcolor='bgcolor="#9BB9FB"';}
		echo "<tr $bgcolor><td><font size=1>$row[0]</td>";
		echo "<td><font size=1> $row[1]</td>";
		echo "<td><font size=1> $row[3]</td>";
		echo "<td><font size=1> $row[5]</td>";
		echo "<td bgcolor=\"$row[2]\"><font size=1> &nbsp;</td>";
		echo "<td><font size=1><a href=\"$PHP_SELF?ADD=3111&group_id=$row[0]\">MODIFY</a></td></tr>\n";
		$o++;
	}

echo "</TABLE></center>\n";
}


######################
# ADD=10000 display all remote agents
######################
if ($ADD==10000)
{
	echo "<FONT FACE=\"ARIAL,HELVETICA\" COLOR=BLACK SIZE=2>";

	$stmt="SELECT * from vicidial_remote_agents order by server_ip,campaign_id,user_start";
	$rslt=mysql_query($stmt, $link);
	$people_to_print = mysql_num_rows($rslt);

echo "<br>REMOTE AGENTS LISTINGS:\n";
echo "<center><TABLE width=600 cellspacing=0 cellpadding=1>\n";

	$o=0;
	while ($people_to_print > $o) {
		$row=mysql_fetch_row($rslt);
		if (eregi("1$|3$|5$|7$|9$", $o))
			{$bgcolor='bgcolor="#B9CBFD"';} 
		else
			{$bgcolor='bgcolor="#9BB9FB"';}
		echo "<tr $bgcolor><td><font size=1>$row[1]</td>";
		echo "<td><font size=1> $row[2]</td>";
		echo "<td><font size=1> $row[3]</td>";
		echo "<td><font size=1> $row[4]</td>";
		echo "<td><font size=1> $row[5]</td>";
		echo "<td><font size=1> $row[6]</td>";
		echo "<td><font size=1><a href=\"$PHP_SELF?ADD=31111&remote_agent_id=$row[0]\">MODIFY</a></td></tr>\n";
		$o++;
	}

echo "</TABLE></center>\n";
}


######################
# ADD=100000 display all user groups
######################
if ($ADD==100000)
{
	echo "<FONT FACE=\"ARIAL,HELVETICA\" COLOR=BLACK SIZE=2>";

	$stmt="SELECT * from vicidial_user_groups order by user_group";
	$rslt=mysql_query($stmt, $link);
	$people_to_print = mysql_num_rows($rslt);

echo "<br>USER GROUPS LISTINGS:\n";
echo "<center><TABLE width=600 cellspacing=0 cellpadding=1>\n";

	$o=0;
	while ($people_to_print > $o) {
		$row=mysql_fetch_row($rslt);
		if (eregi("1$|3$|5$|7$|9$", $o))
			{$bgcolor='bgcolor="#B9CBFD"';} 
		else
			{$bgcolor='bgcolor="#9BB9FB"';}
		echo "<tr $bgcolor><td><font size=1>$row[0]</td>";
		echo "<td><font size=1> $row[1]</td>";
		echo "<td><font size=1><a href=\"$PHP_SELF?ADD=311111&user_group=$row[0]\">MODIFY</a></td></tr>\n";
		$o++;
	}

echo "</TABLE></center>\n";
}



$ENDtime = date("U");

$RUNtime = ($ENDtime - $STARTtime);

echo "\n\n\n<br><br><br>\n\n";


echo "<font size=0>\n\n\n<br><br><br>\nscript runtime: $RUNtime seconds</font>";


?>


</TD></TR><TABLE>
</body>
</html>

<?
	
exit; 



?>





