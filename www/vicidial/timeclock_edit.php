<?
# timeclock_edit.php
# 
# Copyright (C) 2008  Matt Florell <vicidial@gmail.com>    LICENSE: AGPLv2
#
# CHANGES
#
# 80624-1342 - First build
#

header ("Content-type: text/html; charset=utf-8");

require("dbconnect.php");

$PHP_AUTH_USER=$_SERVER['PHP_AUTH_USER'];
$PHP_AUTH_PW=$_SERVER['PHP_AUTH_PW'];
$PHP_SELF=$_SERVER['PHP_SELF'];
if (isset($_GET["LOGINbegin_date"]))			{$LOGINbegin_date=$_GET["LOGINbegin_date"];}
	elseif (isset($_POST["LOGINbegin_date"]))	{$LOGINbegin_date=$_POST["LOGINbegin_date"];}
if (isset($_GET["LOGINend_date"]))				{$LOGINend_date=$_GET["LOGINend_date"];}
	elseif (isset($_POST["LOGINend_date"]))		{$LOGINend_date=$_POST["LOGINend_date"];}
if (isset($_GET["LOGOUTbegin_date"]))			{$LOGOUTbegin_date=$_GET["LOGOUTbegin_date"];}
	elseif (isset($_POST["LOGOUTbegin_date"]))	{$LOGOUTbegin_date=$_POST["LOGOUTbegin_date"];}
if (isset($_GET["LOGOUTend_date"]))				{$LOGOUTend_date=$_GET["LOGOUTend_date"];}
	elseif (isset($_POST["LOGOUTend_date"]))	{$LOGOUTend_date=$_POST["LOGOUTend_date"];}
if (isset($_GET["end_date"]))				{$end_date=$_GET["end_date"];}
	elseif (isset($_POST["end_date"]))		{$end_date=$_POST["end_date"];}
if (isset($_GET["user"]))				{$user=$_GET["user"];}
	elseif (isset($_POST["user"]))		{$user=$_POST["user"];}
if (isset($_GET["stage"]))				{$stage=$_GET["stage"];}
	elseif (isset($_POST["stage"]))		{$stage=$_POST["stage"];}
if (isset($_GET["timeclock_id"]))				{$timeclock_id=$_GET["timeclock_id"];}
	elseif (isset($_POST["timeclock_id"]))		{$timeclock_id=$_POST["timeclock_id"];}
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
$invalid_record=0;

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
    echo "Invalid Username/Password: |$PHP_AUTH_USER|$PHP_AUTH_PW|\n";
    exit;
	}
  else
	{

	if($auth>0)
		{
			$stmt="SELECT full_name,modify_timeclock_log from vicidial_users where user='$PHP_AUTH_USER' and pass='$PHP_AUTH_PW'";
			$rslt=mysql_query($stmt, $link);
			$row=mysql_fetch_row($rslt);
			$LOGfullname =				$row[0];
			$modify_timeclock_log =		$row[1];
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
			}
		}

	$stmt="SELECT full_name,user_group from vicidial_users where user='" . mysql_real_escape_string($user) . "';";
	$rslt=mysql_query($stmt, $link);
	$row=mysql_fetch_row($rslt);
	$full_name = $row[0];
	$user_group = $row[1];

	$stmt="SELECT event,tcid_link from vicidial_timeclock_log where timeclock_id='" . mysql_real_escape_string($timeclock_id) . "';";
	$rslt=mysql_query($stmt, $link);
	if ($DB) {echo "$stmt\n";}
	$tc_logs_to_print = mysql_num_rows($rslt);
	if ($tc_logs_to_print > 0)
		{
		$row=mysql_fetch_row($rslt);
		$event =		$row[0];
		$tcid_link =	$row[1];
		}
	if (ereg("LOGIN",$event))
		{
		$LOGINevent_id =	$timeclock_id;
		$LOGOUTevent_id =	$tcid_link;
		if ( (ereg('NULL',$LOGOUTevent_id)) or (strlen($LOGOUTevent_id)<1) )
			{$invalid_record++;}
		}
	if (ereg("LOGOUT",$event))
		{
		$LOGOUTevent_id =	$timeclock_id;
		$stmt="SELECT timeclock_id from vicidial_timeclock_log where tcid_link='" . mysql_real_escape_string($timeclock_id) . "';";
		$rslt=mysql_query($stmt, $link);
		if ($DB) {echo "$stmt\n";}
		$tc_logs_to_print = mysql_num_rows($rslt);
		if ($tc_logs_to_print > 0)
			{
			$row=mysql_fetch_row($rslt);
			$LOGINevent_id =		$row[0];
			}
		if ( (ereg('NULL',$LOGOUTevent_id)) or (strlen($LOGOUTevent_id)<1) )
			{$invalid_record++;}
		}
	if (strlen($LOGOUTevent_id)<1)
		{$invalid_record++;}

	}



?>
<html>
<head>
<title>VICIDIAL ADMIN: Timeclock Record Edit</title>
<?
echo "<META HTTP-EQUIV=\"Content-Type\" CONTENT=\"text/html; charset=utf-8\">\n";
?>
</head>
<BODY BGCOLOR=white marginheight=0 marginwidth=0 leftmargin=0 topmargin=0>
<CENTER>
<TABLE WIDTH=620 BGCOLOR=#D9E6FE cellpadding=2 cellspacing=0><TR BGCOLOR=#015B91><TD ALIGN=LEFT><? echo "<a href=\"./admin.php\">" ?><FONT FACE="ARIAL,HELVETICA" COLOR=WHITE SIZE=2><B> &nbsp; VICIDIAL ADMIN</a>: Timeclock Record Edit for <? echo $user ?></TD><TD ALIGN=RIGHT><FONT FACE="ARIAL,HELVETICA" COLOR=WHITE SIZE=2><B><? echo date("l F j, Y G:i:s A") ?> &nbsp; </TD></TR>




<? 

echo "<TR BGCOLOR=\"#F0F5FE\"><TD ALIGN=LEFT COLSPAN=2><FONT FACE=\"ARIAL,HELVETICA\" COLOR=BLACK SIZE=3><B> &nbsp; \n";


if ( ($invalid_record < 1) or (strlen($timeclock_id)<1) )
{
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

echo "\n<BR>";

if ($modify_timeclock_log > 0)
	{
		$LOGINevent_id =	$timeclock_id;
		$LOGOUTevent_id =	$tcid_link;

	echo "<BR><BR>\n";
	echo "<form action=$PHP_SELF method=POST>\n";
	echo "<input type=hidden name=DB value=\"$DB\">\n";
	echo "<input type=hidden name=user value=\"$user\">\n";
	echo "<input type=hidden name=stage value=\"$TC_log_change_stage\">\n";
	echo "<input type=submit name=submit value=\"$TC_log_change_button\"><BR></form>\n";
	echo "<BR><BR>\n";
	}


echo "<a href=\"./AST_agent_time_sheet.php?agent=$user\">VICIDIAL Time Sheet</a>\n";
echo " - <a href=\"./user_stats.php?user=$user\">User Stats</a>\n";
echo " - <a href=\"./admin.php?ADD=3&user=$user\">Modify User</a>\n";

echo "</B></TD></TR>\n";
echo "<TR><TD ALIGN=LEFT COLSPAN=2>\n";


$ENDtime = date("U");

$RUNtime = ($ENDtime - $StarTtimE);

echo "\n\n\n<br><br><br>\n\n";


echo "<font size=0>\n\n\n<br><br><br>\nscript runtime: $RUNtime seconds</font>";

echo "|$stage|$group|";

}
else
{

echo "ERROR! You cannot edit this timeclock record: $timeclock_id\n";
}
?>


</TD></TR><TABLE>
</body>
</html>

<?
	
exit; 



?>

