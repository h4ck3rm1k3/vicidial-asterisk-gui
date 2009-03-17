<?
# user_status.php
# 
# Copyright (C) 2009  Matt Florell <vicidial@gmail.com>    LICENSE: AGPLv2
#
# CHANGES
#
# 60619-1738 - Added variable filtering to eliminate SQL injection attack threat
# 80603-1452 - Added manager timeclock force login/logout of user
# 81118-1034 - Disabled change campaign because it does not work
# 90208-0511 - Added link to user multi-day status report
# 90310-0741 - Added admin header
#

header ("Content-type: text/html; charset=utf-8");

require("dbconnect.php");

$PHP_AUTH_USER=$_SERVER['PHP_AUTH_USER'];
$PHP_AUTH_PW=$_SERVER['PHP_AUTH_PW'];
$PHP_SELF=$_SERVER['PHP_SELF'];
if (isset($_GET["begin_date"]))				{$begin_date=$_GET["begin_date"];}
	elseif (isset($_POST["begin_date"]))	{$begin_date=$_POST["begin_date"];}
if (isset($_GET["end_date"]))				{$end_date=$_GET["end_date"];}
	elseif (isset($_POST["end_date"]))		{$end_date=$_POST["end_date"];}
if (isset($_GET["user"]))				{$user=$_GET["user"];}
	elseif (isset($_POST["user"]))		{$user=$_POST["user"];}
if (isset($_GET["group"]))				{$group=$_GET["group"];}
	elseif (isset($_POST["group"]))		{$group=$_POST["group"];}
if (isset($_GET["stage"]))				{$stage=$_GET["stage"];}
	elseif (isset($_POST["stage"]))		{$stage=$_POST["stage"];}
if (isset($_GET["DB"]))					{$DB=$_GET["DB"];}
	elseif (isset($_POST["DB"]))		{$DB=$_POST["DB"];}
if (isset($_GET["submit"]))				{$submit=$_GET["submit"];}
	elseif (isset($_POST["submit"]))	{$submit=$_POST["submit"];}
if (isset($_GET["SUBMIT"]))				{$SUBMIT=$_GET["SUBMIT"];}
	elseif (isset($_POST["SUBMIT"]))	{$SUBMIT=$_POST["SUBMIT"];}

#############################################
##### START SYSTEM_SETTINGS LOOKUP #####
$stmt = "SELECT use_non_latin,webroot_writable FROM system_settings;";
$rslt=mysql_query($stmt, $link);
if ($DB) {echo "$stmt\n";}
$qm_conf_ct = mysql_num_rows($rslt);
$i=0;
while ($i < $qm_conf_ct)
	{
	$row=mysql_fetch_row($rslt);
	$non_latin =		$row[0];
	$webroot_writable =	$row[1];
	$i++;
	}
##### END SETTINGS LOOKUP #####
###########################################

$PHP_AUTH_USER = ereg_replace("[^0-9a-zA-Z]","",$PHP_AUTH_USER);
$PHP_AUTH_PW = ereg_replace("[^0-9a-zA-Z]","",$PHP_AUTH_PW);

$StarTtimE = date("U");
$TODAY = date("Y-m-d");
$NOW_TIME = date("Y-m-d H:i:s");
$ip = getenv("REMOTE_ADDR");

if (!isset($begin_date)) {$begin_date = $TODAY;}
if (!isset($end_date)) {$end_date = $TODAY;}

	$stmt="SELECT count(*) from vicidial_users where user='$PHP_AUTH_USER' and pass='$PHP_AUTH_PW' and user_level > 7 and view_reports='1';";
	if ($non_latin > 0) { $rslt=mysql_query("SET NAMES 'UTF8'");}
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
    echo "Unzulässiges Username/Kennwort:|$PHP_AUTH_USER|$PHP_AUTH_PW|\n";
    exit;
	}
  else
	{

	if($auth>0)
		{
			$stmt="SELECT full_name,change_agent_campaign,modify_timeclock_log from vicidial_users where user='$PHP_AUTH_USER' and pass='$PHP_AUTH_PW'";
			$rslt=mysql_query($stmt, $link);
			$row=mysql_fetch_row($rslt);
			$LOGfullname =				$row[0];
			$change_agent_campaign =	$row[1];
			$modify_timeclock_log =		$row[2];
		if ($webroot_writable > 0)
			{
			fwrite ($fp, "VICIDIAL|GOOD|$date|$PHP_AUTH_USER|$PHP_AUTH_PW|$ip|$browser|$LOGfullname|\n");
			fclose($fp);
			}
		}
	else
		{
		if ($webroot_writable > 0)
			{
			fwrite ($fp, "VICIDIAL|FAIL|$date|$PHP_AUTH_USER|$PHP_AUTH_PW|$ip|$browser|\n");
			fclose($fp);
			echo "Unzulässiges Username/Kennwort:|$PHP_AUTH_USER|$PHP_AUTH_PW|\n";
			exit;
			}
		}

	$stmt="SELECT full_name,user_group from vicidial_users where user='" . mysql_real_escape_string($user) . "';";
	$rslt=mysql_query($stmt, $link);
	$row=mysql_fetch_row($rslt);
	$full_name = $row[0];
	$user_group = $row[1];

	$stmt="SELECT * from vicidial_live_agents where user='" . mysql_real_escape_string($user) . "';";
	$rslt=mysql_query($stmt, $link);
	if ($DB) {echo "$stmt\n";}
	$agents_to_print = mysql_num_rows($rslt);
	$i=0;
	while ($i < $agents_to_print)
		{
		$row=mysql_fetch_row($rslt);
		$Aserver_ip =		$row[2];
		$Asession_id =		$row[3];
		$Aextension =		$row[4];
		$Astatus =			$row[5];
		$Acampaign =		$row[7];
		$Alast_call =		$row[14];
		$Acl_campaigns =	$row[15];
		$i++;
		}

	$stmt="SELECT event_date,status,ip_address from vicidial_timeclock_status where user='" . mysql_real_escape_string($user) . "';";
	$rslt=mysql_query($stmt, $link);
	if ($DB) {echo "$stmt\n";}
	$tc_logs_to_print = mysql_num_rows($rslt);
	if ($tc_logs_to_print > 0)
		{
		$row=mysql_fetch_row($rslt);
		$Tevent_date =		$row[0];
		$Tstatus =			$row[1];
		$Tip_address =		$row[2];
		$i++;
		}

	}

$stmt="select * from vicidial_campaigns;";
$rslt=mysql_query($stmt, $link);
if ($DB) {echo "$stmt\n";}
$groups_to_print = mysql_num_rows($rslt);
$i=0;
while ($i < $groups_to_print)
	{
	$row=mysql_fetch_row($rslt);
	$groups[$i] =$row[0];
	$i++;
	}



?>
<html>
<head>
<META HTTP-EQUIV="Content-Type" CONTENT="text/html; charset=utf-8">
<title>VICIDIAL ADMIN: User Status
<?


##### BEGIN Set variables to make header show properly #####
$ADD =					'3';
$hh =					'users';
$LOGast_admin_access =	'1';
$ADMIN =				'admin.php';
$page_width='770';
$section_width='750';
$header_font_size='3';
$subheader_font_size='2';
$subcamp_font_size='2';
$header_selected_bold='<b>';
$header_nonselected_bold='';
$users_color =		'#FFFF99';
$users_font =		'BLACK';
$users_color =		'#E6E6E6';
$subcamp_color =	'#C6C6C6';
##### END Set variables to make header show properly #####

require("admin_header.php");



?>
<TABLE WIDTH=<? echo $page_width ?> BGCOLOR=#E6E6E6 cellpadding=2 cellspacing=0><TR BGCOLOR=#E6E6E6><TD ALIGN=LEFT><FONT FACE="ARIAL,HELVETICA" SIZE=2><B> &nbsp; User Status for <? echo $user ?></TD><TD ALIGN=RIGHT><FONT FACE="ARIAL,HELVETICA" SIZE=2><B> &nbsp; </TD></TR>




<? 

echo "<TR BGCOLOR=\"#F0F5FE\"><TD ALIGN=LEFT COLSPAN=2><FONT FACE=\"ARIAL,HELVETICA\" COLOR=BLACK SIZE=3><B> &nbsp; \n";

##### EMERGENCY CAMPAIGN CHANGE FOR AN AGENT #####
if ($stage == "live_campaign_change")
	{
	$stmt="UPDATE vicidial_live_agents set campaign_id='" . mysql_real_escape_string($group) . "' where user='" . mysql_real_escape_string($user) . "';";
	$rslt=mysql_query($stmt, $link);

	echo "Agent $user - $full_name changed to $group campaign<BR>\n";
	
	exit;
	}

##### EMERGENCY LOGOUT OF AN AGENT #####
if ($stage == "log_agent_out")
	{
	$stmt="DELETE from vicidial_live_agents where user='" . mysql_real_escape_string($user) . "';";
	$rslt=mysql_query($stmt, $link);

	echo "Agent $user - $full_name has been emergency logged out, make sure they close their web browser<BR>\n";
	
	exit;
	}





##### BEGIN TIMECLOCK LOGOUT OF A USER #####
if ( ( ($stage == "tc_log_user_OUT") or ($stage == "tc_log_user_IN") ) and ($modify_timeclock_log > 0) )
	{
	### get vicidial_timeclock_status record count for this user
	$stmt="SELECT count(*) from vicidial_timeclock_status where user='$user';";
	if ($DB) {echo "|$stmt|\n";}
	$rslt=mysql_query($stmt, $link);
	$row=mysql_fetch_row($rslt);
	$vts_count =	$row[0];

	$LOG_run=0;
	$last_action_sec=99;

	if ($vts_count > 0)
		{
		### vicidial_timeclock_status record found, grab status and date of last activity
		$stmt="SELECT status,event_epoch from vicidial_timeclock_status where user='$user';";
		if ($DB) {echo "|$stmt|\n";}
		$rslt=mysql_query($stmt, $link);
		$row=mysql_fetch_row($rslt);
		$status =		$row[0];
		$event_epoch =	$row[1];
		$last_action_date = date("Y-m-d H:i:s", $event_epoch);
		$last_action_sec = ($StarTtimE - $event_epoch);

		if ($last_action_sec > 0)
			{
			$totTIME_H = ($last_action_sec / 3600);
			$totTIME_H_int = round($totTIME_H, 2);
			$totTIME_H_int = intval("$totTIME_H");
			$totTIME_M = ($totTIME_H - $totTIME_H_int);
			$totTIME_M = ($totTIME_M * 60);
			$totTIME_M_int = round($totTIME_M, 2);
			$totTIME_M_int = intval("$totTIME_M");
			$totTIME_S = ($totTIME_M - $totTIME_M_int);
			$totTIME_S = ($totTIME_S * 60);
			$totTIME_S = round($totTIME_S, 0);
			if (strlen($totTIME_H_int) < 1) {$totTIME_H_int = "0";}
			if ($totTIME_M_int < 10) {$totTIME_M_int = "0$totTIME_M_int";}
			if ($totTIME_S < 10) {$totTIME_S = "0$totTIME_S";}
			$totTIME_HMS = "$totTIME_H_int:$totTIME_M_int:$totTIME_S";
			}
		else 
			{
			$totTIME_HMS='0:00:00';
			}
		}

	else
		{
		### No vicidial_timeclock_status record found, insert one
		$stmt="INSERT INTO vicidial_timeclock_status set status='START', user='$user', user_group='$user_group', event_epoch='$StarTtimE', ip_address='$ip';";
		if ($DB) {echo "$stmt\n";}
		$rslt=mysql_query($stmt, $link);
			$status='START';
			$totTIME_HMS='0:00:00';
		$affected_rows = mysql_affected_rows($link);
		print "<!-- NEW vicidial_timeclock_status record inserted for $user:   |$affected_rows| -->\n";
		}


	##### Run timeclock login queries #####
	if ( ( ($status=='AUTOLOGOUT') or ($status=='START') or ($status=='LOGOUT') ) and ($stage == "tc_log_user_IN") )
		{
		### Add a record to the timeclock log
		$stmtA="INSERT INTO vicidial_timeclock_log set event='LOGIN', user='$user', user_group='$user_group', event_epoch='$StarTtimE', ip_address='$ip', event_date='$NOW_TIME', manager_user='$PHP_AUTH_USER', manager_ip='$ip', notes='Manager LOGIN of user from user status page';";
		if ($DB) {echo "$stmtA\n";}
		$rslt=mysql_query($stmtA, $link);
		$affected_rows = mysql_affected_rows($link);
		$timeclock_id = mysql_insert_id($link);
		print "<!-- NEW vicidial_timeclock_log record inserted for $user:   |$affected_rows|$timeclock_id| -->\n";

		### Update the user's timeclock status record
		$stmtB="UPDATE vicidial_timeclock_status set status='LOGIN', user_group='$user_group', event_epoch='$StarTtimE', ip_address='$ip' where user='$user';";
		if ($DB) {echo "$stmtB\n";}
		$rslt=mysql_query($stmtB, $link);
		$affected_rows = mysql_affected_rows($link);
		print "<!-- vicidial_timeclock_status record updated for $user:   |$affected_rows| -->\n";

		### Add a record to the timeclock audit log
		$stmtC="INSERT INTO vicidial_timeclock_audit_log set timeclock_id='$timeclock_id', event='LOGIN', user='$user', user_group='$user_group', event_epoch='$StarTtimE', ip_address='$ip', event_date='$NOW_TIME';";
		if ($DB) {echo "$stmtC\n";}
		$rslt=mysql_query($stmtC, $link);
		$affected_rows = mysql_affected_rows($link);
		print "<!-- NEW vicidial_timeclock_audit_log record inserted for $user:   |$affected_rows| -->\n";

		### Add a record to the vicidial_admin_log
		$SQL_log = "$stmtA|$stmtB|$stmtC|";
		$SQL_log = ereg_replace(';','',$SQL_log);
		$SQL_log = addslashes($SQL_log);
		$stmt="INSERT INTO vicidial_admin_log set event_date='$NOW_TIME', user='$PHP_AUTH_USER', ip_address='$ip', event_section='TIMECLOCK', event_type='LOGIN', record_id='$user', event_code='USER FORCED LOGIN FROM STATUS PAGE', event_sql=\"$SQL_log\", event_notes='Timeclock ID: $timeclock_id|';";
		if ($DB) {echo "$stmt\n";}
		$rslt=mysql_query($stmt, $link);
		$affected_rows = mysql_affected_rows($link);
		print "<!-- NEW vicidial_admin_log record inserted for $PHP_AUTH_USER:   |$affected_rows| -->\n";

		$LOG_run++;
		$VDdisplayMESSAGE = "You have now logged-in the user: $user - $full_name";
		}

	##### Run timeclock logout queries #####
	if ( ( ($status=='LOGIN') or ($status=='START') ) and ($stage == "tc_log_user_OUT") )
		{
		### Add a record to the timeclock log
		$stmtA="INSERT INTO vicidial_timeclock_log set event='LOGOUT', user='$user', user_group='$user_group', event_epoch='$StarTtimE', ip_address='$ip', login_sec='$last_action_sec', event_date='$NOW_TIME', manager_user='$PHP_AUTH_USER', manager_ip='$ip', notes='Manager LOGOUT of user from user status page';";
		if ($DB) {echo "$stmtA\n";}
		$rslt=mysql_query($stmtA, $link);
		$affected_rows = mysql_affected_rows($link);
		$timeclock_id = mysql_insert_id($link);
		print "<!-- NEW vicidial_timeclock_log record inserted for $user:   |$affected_rows|$timeclock_id| -->\n";

		### Update last login record in the timeclock log
		$stmtB="UPDATE vicidial_timeclock_log set login_sec='$last_action_sec',tcid_link='$timeclock_id' where event='LOGIN' and user='$user' order by timeclock_id desc limit 1;";
		if ($DB) {echo "$stmtB\n";}
		$rslt=mysql_query($stmtB, $link);
		$affected_rows = mysql_affected_rows($link);
		print "<!-- vicidial_timeclock_log record updated for $user:   |$affected_rows| -->\n";

		### Update the user's timeclock status record
		$stmtC="UPDATE vicidial_timeclock_status set status='LOGOUT', user_group='$user_group', event_epoch='$StarTtimE', ip_address='$ip' where user='$user';";
		if ($DB) {echo "$stmtC\n";}
		$rslt=mysql_query($stmtC, $link);
		$affected_rows = mysql_affected_rows($link);
		print "<!-- vicidial_timeclock_status record updated for $user:   |$affected_rows| -->\n";

		### Add a record to the timeclock audit log
		$stmtD="INSERT INTO vicidial_timeclock_audit_log set timeclock_id='$timeclock_id', event='LOGOUT', user='$user', user_group='$user_group', event_epoch='$StarTtimE', ip_address='$ip', login_sec='$last_action_sec', event_date='$NOW_TIME';";
		if ($DB) {echo "$stmtD\n";}
		$rslt=mysql_query($stmtD, $link);
		$affected_rows = mysql_affected_rows($link);
		print "<!-- NEW vicidial_timeclock_audit_log record inserted for $user:   |$affected_rows| -->\n";

		### Update last login record in the timeclock audit log
		$stmtE="UPDATE vicidial_timeclock_audit_log set login_sec='$last_action_sec',tcid_link='$timeclock_id' where event='LOGIN' and user='$user' order by timeclock_id desc limit 1;";
		if ($DB) {echo "$stmtE\n";}
		$rslt=mysql_query($stmtE, $link);
		$affected_rows = mysql_affected_rows($link);
		print "<!-- vicidial_timeclock_audit_log record updated for $user:   |$affected_rows| -->\n";

		### Add a record to the vicidial_admin_log
		$SQL_log = "$stmtA|$stmtB|$stmtC|$stmtD|$stmtE|";
		$SQL_log = ereg_replace(';','',$SQL_log);
		$SQL_log = addslashes($SQL_log);
		$stmt="INSERT INTO vicidial_admin_log set event_date='$NOW_TIME', user='$PHP_AUTH_USER', ip_address='$ip', event_section='TIMECLOCK', event_type='LOGOUT', record_id='$user', event_code='USER FORCED LOGOUT FROM STATUS PAGE', event_sql=\"$SQL_log\", event_notes='User login time: $last_action_sec|Timeclock ID: $timeclock_id|';";
		if ($DB) {echo "$stmt\n";}
		$rslt=mysql_query($stmt, $link);
		$affected_rows = mysql_affected_rows($link);
		print "<!-- NEW vicidial_admin_log record inserted for $PHP_AUTH_USER:   |$affected_rows| -->\n";

		$LOG_run++;
		$VDdisplayMESSAGE = "You have now logged-out the user: $user - $full_name<BR>Amount of time user was logged-in: $totTIME_HMS";
		}
	
	if ($LOG_run < 1)
		{$VDdisplayMESSAGE = "ERROR: timeclock log problem, could not process: $status|$stage";}

	echo "$VDdisplayMESSAGE\n";
	
	exit;
	}

##### END TIMECLOCK LOGOUT OF A USER #####

if ($agents_to_print > 0)
	{
	echo "<BR>\n";
	echo "$user - $full_name \n";
	echo " &nbsp; &nbsp; &nbsp; GROUP: $user_group <BR>\n";

	echo "<TABLE CELLPADDING=0 CELLSPACING=0>";
	echo "<TR><TD ALIGN=RIGHT>Agent Logged in at server:</TD><TD ALIGN=LEFT> &nbsp; $Aserver_ip</TD></TR>\n";
	echo "<TR><TD ALIGN=RIGHT>in session:</TD><TD ALIGN=LEFT> &nbsp; $Asession_id</TD></TR>\n";
	echo "<TR><TD ALIGN=RIGHT>from phone:</TD><TD ALIGN=LEFT> &nbsp; $Aextension</TD></TR>\n";
	echo "<TR><TD ALIGN=RIGHT>Agent is in campaign:</TD><TD ALIGN=LEFT> &nbsp; $Acampaign</TD></TR>\n";
	echo "<TR><TD ALIGN=RIGHT>status:</TD><TD ALIGN=LEFT> &nbsp; $Astatus</TD></TR>\n";
	echo "<TR><TD ALIGN=RIGHT>hungup last call at:</TD><TD ALIGN=LEFT> &nbsp; $Alast_call</TD></TR>\n";
	echo "<TR><TD ALIGN=RIGHT>Closer groups:</TD><TD ALIGN=LEFT> &nbsp; $Acl_campaigns</TD></TR>\n";
	echo "</TABLE>\n<BR>\n";


	if ($change_agent_campaign > 0)
		{
		echo "<form action=$PHP_SELF method=POST>\n";
		echo "<input type=hidden name=DB value=\"$DB\">\n";
		echo "<input type=hidden name=user value=\"$user\">\n";
		echo "<input type=hidden name=stage value=\"live_campaign_change\">\n";
		echo "Current Kampagne: <SELECT SIZE=1 NAME=group>\n";
			$o=0;
			while ($groups_to_print > $o)
			{
				if ($groups[$o] == "$Acampaign") {echo "<option selected value=\"$groups[$o]\">$groups[$o]</option>\n";}
				  else {echo "<option value=\"$groups[$o]\">$groups[$o]</option>\n";}
				$o++;
			}
		echo "</SELECT>\n";
		echo "<input type=submit name=submit value=CHANGE disabled><BR></form>\n";


		echo "<form action=$PHP_SELF method=POST>\n";
		echo "<input type=hidden name=DB value=\"$DB\">\n";
		echo "<input type=hidden name=user value=\"$user\">\n";
		echo "<input type=hidden name=stage value=\"log_agent_out\">\n";
		echo "<input type=submit name=submit value=\"EMERGENCY LOG MITTELOUT\"><BR></form>\n";
		}
	}

else
	{
	echo "Agent is not logged in to VICIDIAL\n<BR>";
	}

echo "\n<BR>";

if ( ($Tstatus == "LOGIN") or ($Tstatus == "START") )
	{
	echo "User $user($full_name) - is logged in to the timeclock. <BR>Login time: $Tevent_date from $Tip_address<BR>\n";
	$TC_log_change_stage =	'tc_log_user_OUT';
	$TC_log_change_button = 'TIMECLOCK LOG THIS USER OUT';
	}
else
	{
	echo "User $user($full_name) - is NOT logged in to the timeclock. <BR>Last logout time: $Tevent_date from $Tip_address<BR>\n";
	$TC_log_change_stage =	'tc_log_user_IN';
	$TC_log_change_button = 'TIMECLOCK LOG THIS USER IN';
	}

if ($modify_timeclock_log > 0)
	{
	echo "<BR><BR>\n";
	echo "<form action=$PHP_SELF method=POST>\n";
	echo "<input type=hidden name=DB value=\"$DB\">\n";
	echo "<input type=hidden name=user value=\"$user\">\n";
	echo "<input type=hidden name=stage value=\"$TC_log_change_stage\">\n";
	echo "<input type=submit name=submit value=\"$TC_log_change_button\"><BR></form>\n";
	echo "<BR><BR>\n";
	}


$REPORTdate = date("Y-m-d");
echo "<center>\n";
echo "<a href=\"./AST_agent_time_sheet.php?agent=$user\">VICIDIAL Time Sheet</a>\n";
echo " | <a href=\"./user_stats.php?user=$user\">User-Statistiken</a>\n";
echo " | <a href=\"./admin.php?ADD=3&user=$user\">Ändern Sie Benutzer</a>\n";
echo " | <a href=\"./AST_agent_days_detail.php?user=$user&query_date=$REPORTdate&end_date=$REPORTdate&group[]=--ALL--&shift=ALL\">User multiple day status detail report</a>";
echo "</center>\n";

echo "</B></TD></TR>\n";
echo "<TR><TD ALIGN=LEFT COLSPAN=2>\n";


$ENDtime = date("U");

$RUNtime = ($ENDtime - $StarTtimE);

echo "\n\n\n<br><br><br>\n\n";


echo "<font size=0>\n\n\n<br><br><br>\nIndexlaufzeit: $RUNtime seconds</font>";

echo "|$stage|$group|";

?>


</TD></TR><TABLE>
</body>
</html>

<?
	
exit; 



?>

