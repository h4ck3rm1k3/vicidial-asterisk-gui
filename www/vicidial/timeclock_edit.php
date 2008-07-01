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
if (isset($_GET["LOGINepoch"]))					{$LOGINepoch=$_GET["LOGINepoch"];}
	elseif (isset($_POST["LOGINepoch"]))		{$LOGINepoch=$_POST["LOGINepoch"];}
if (isset($_GET["LOGOUTepoch"]))				{$LOGOUTepoch=$_GET["LOGOUTepoch"];}
	elseif (isset($_POST["LOGOUTepoch"]))		{$LOGOUTepoch=$_POST["LOGOUTepoch"];}
if (isset($_GET["notes"]))						{$notes=$_GET["notes"];}
	elseif (isset($_POST["notes"]))				{$notes=$_POST["notes"];}
if (isset($_GET["LOGINevent_id"]))				{$LOGINevent_id=$_GET["LOGINevent_id"];}
	elseif (isset($_POST["LOGINevent_id"]))		{$LOGINevent_id=$_POST["LOGINevent_id"];}
if (isset($_GET["LOGOUTevent_id"]))				{$LOGOUTevent_id=$_GET["LOGOUTevent_id"];}
	elseif (isset($_POST["LOGOUTevent_id"]))	{$LOGOUTevent_id=$_POST["LOGOUTevent_id"];}
if (isset($_GET["user"]))						{$user=$_GET["user"];}
	elseif (isset($_POST["user"]))				{$user=$_POST["user"];}
if (isset($_GET["stage"]))						{$stage=$_GET["stage"];}
	elseif (isset($_POST["stage"]))				{$stage=$_POST["stage"];}
if (isset($_GET["timeclock_id"]))				{$timeclock_id=$_GET["timeclock_id"];}
	elseif (isset($_POST["timeclock_id"]))		{$timeclock_id=$_POST["timeclock_id"];}
if (isset($_GET["DB"]))							{$DB=$_GET["DB"];}
	elseif (isset($_POST["DB"]))				{$DB=$_POST["DB"];}
if (isset($_GET["submit"]))						{$submit=$_GET["submit"];}
	elseif (isset($_POST["submit"]))			{$submit=$_POST["submit"];}
if (isset($_GET["SUBMIT"]))						{$SUBMIT=$_GET["SUBMIT"];}
	elseif (isset($_POST["SUBMIT"]))			{$SUBMIT=$_POST["SUBMIT"];}

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

	### 
	if ($invalid_record < 1)
		{
		$stmt="SELECT event_epoch,event_date,login_sec,event,user,user_group,ip_address,shift_id,notes,manager_user,manager_ip,event_datestamp from vicidial_timeclock_log where timeclock_id='$LOGINevent_id';";
		$rslt=mysql_query($stmt, $link);
		if ($DB) {echo "$stmt\n";}
		$tc_logs_to_print = mysql_num_rows($rslt);
		if ($tc_logs_to_print > 0)
			{
			$row=mysql_fetch_row($rslt);
			$LOGINevent_epoch =		$row[0];
			$LOGINevent_date =		$row[1];
			$LOGINlogin_sec =		$row[2];
			$LOGINevent =			$row[3];
			$LOGINuser =			$row[4];
			$LOGINuser_group =		$row[5];
			$LOGINip_address =		$row[6];
			$LOGINshift_id =		$row[7];
			$LOGINnotes =			$row[8];
			$LOGINmanager_user =	$row[9];
			$LOGINmanager_ip =		$row[10];
			$LOGINevent_datestamp =	$row[11];
			}
		$stmt="SELECT event_epoch,event_date,login_sec,event,user,user_group,ip_address,shift_id,notes,manager_user,manager_ip,event_datestamp from vicidial_timeclock_log where timeclock_id='$LOGOUTevent_id';";
		$rslt=mysql_query($stmt, $link);
		if ($DB) {echo "$stmt\n";}
		$tc_logs_to_print = mysql_num_rows($rslt);
		if ($tc_logs_to_print > 0)
			{
			$row=mysql_fetch_row($rslt);
			$LOGOUTevent_epoch =	$row[0];
			$LOGOUTevent_date =		$row[1];
			$LOGOUTlogin_sec =		$row[2];
			$LOGOUTevent =			$row[3];
			$LOGOUTuser =			$row[4];
			$LOGOUTuser_group =		$row[5];
			$LOGOUTip_address =		$row[6];
			$LOGOUTshift_id =		$row[7];
			$LOGOUTnotes =			$row[8];
			$LOGOUTmanager_user =	$row[9];
			$LOGOUTmanager_ip =		$row[10];
			$LOGOUTevent_datestamp =$row[11];
			}
		}
	}



?>
<html>
<head>
<title>VICIDIAL ADMIN: Timeclock Record Edit
<?
echo "</title>\n";
echo "<META HTTP-EQUIV=\"Content-Type\" CONTENT=\"text/html; charset=utf-8\">\n";
echo "<script language=\"Javascript\">\n";
?>

function run_submit()
	{
	calculate_hours();
	var go_submit = document.getElementById("go_submit");
	if (go_submit.disabled == false)
		{
		document.edit_log.submit();
		}
	}

// Calculate login time
function calculate_hours() 
	{
	var i=0;
	var total_percent=0;
	var SPANlogin_time = document.getElementById("LOGINlogin_time");
	var LI_date = document.getElementById("LOGINbegin_date");
	var LO_date = document.getElementById("LOGOUTbegin_date");
	var LI_datetime = LI_date.value;
	var LO_datetime = LO_date.value;
	var LI_datetime_array=LI_datetime.split(" ");
	var LI_date_array=LI_datetime_array[0].split("-");
	var LI_time_array=LI_datetime_array[1].split(":");
	var LO_datetime_array=LO_datetime.split(" ");
	var LO_date_array=LO_datetime_array[0].split("-");
	var LO_time_array=LO_datetime_array[1].split(":");

	// Calculate milliseconds since 1970 for each date string and find diff
	var LI_sec = ( ( (LI_time_array[2] * 1) * 1000) );
	var LI_min = ( ( ( (LI_time_array[1] * 1) * 1000) * 60 ) );
	var LI_hour = ( ( ( (LI_time_array[0] * 1) * 1000) * 3600 ) );
	var LI_date_epoch = Date.parse(LI_date_array[0] + '/' + LI_date_array[1] + '/' + LI_date_array[2]);
	var LI_epoch = (LI_date_epoch + LI_sec + LI_min + LI_hour);
	var LO_sec = ( ( (LO_time_array[2] * 1) * 1000) );
	var LO_min = ( ( ( (LO_time_array[1] * 1) * 1000) * 60 ) );
	var LO_hour = ( ( ( (LO_time_array[0] * 1) * 1000) * 3600 ) );
	var LO_date_epoch = Date.parse(LO_date_array[0] + '/' + LO_date_array[1] + '/' + LO_date_array[2]);
	var LO_epoch = (LO_date_epoch + LO_sec + LO_min + LO_hour);
	var epoch_diff = ( (LO_epoch - LI_epoch) / 1000 );
	var temp_diff = epoch_diff;

	document.getElementById("login_time").innerHTML = "ERROR, Please check date fields";

	var go_submit = document.getElementById("go_submit");
	go_submit.disabled = true;
	if ( (epoch_diff < 86401) && (epoch_diff > 0) )
		{
		go_submit.disabled = false;

		hours = Math.floor(temp_diff / (60 * 60)); 
		temp_diff -= hours * (60 * 60);

		mins = Math.floor(temp_diff / 60); 
		temp_diff -= mins * 60;

		secs = Math.floor(temp_diff); 
		temp_diff -= secs;

		document.getElementById("login_time").innerHTML = hours + ":" + mins;

		var form_LI_epoch = document.getElementById("LOGINepoch");
		var form_LO_epoch = document.getElementById("LOGOUTepoch");
		form_LI_epoch.value = (LI_epoch / 1000);
		form_LO_epoch.value = (LO_epoch / 1000);
		}
	}

</script>
</head>
<BODY BGCOLOR=white marginheight=0 marginwidth=0 leftmargin=0 topmargin=0>
<CENTER>
<TABLE WIDTH=720 BGCOLOR=#D9E6FE cellpadding=2 cellspacing=0><TR BGCOLOR=#015B91><TD ALIGN=LEFT><? echo "<a href=\"./admin.php\">" ?><FONT FACE="ARIAL,HELVETICA" COLOR=WHITE SIZE=2><B> &nbsp; VICIDIAL ADMIN</a>: Timeclock Record Edit for <? echo $user ?></TD><TD ALIGN=RIGHT><FONT FACE="ARIAL,HELVETICA" COLOR=WHITE SIZE=2><B><? echo date("l F j, Y G:i:s A") ?> &nbsp; </TD></TR>




<? 

echo "<TR BGCOLOR=\"#F0F5FE\"><TD ALIGN=LEFT COLSPAN=2><FONT FACE=\"ARIAL,HELVETICA\" COLOR=BLACK SIZE=3><B> &nbsp; \n";


if ( ($invalid_record < 1) or (strlen($timeclock_id)<1) )
{

if ($stage == "edit_TC_log")
	{
	echo "$LOGINepoch<BR>\n";
	echo "$LOGOUTepoch<BR>\n";
	echo "$notes<BR>\n";
	echo "$LOGINevent_id<BR>\n";
	echo "$LOGOUTevent_id<BR>\n";
	echo "$LOGINuser<BR>\n";
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

echo "\n<BR>";

if ($modify_timeclock_log > 0)
	{
	$LOGINevent_id =	$timeclock_id;
	$LOGOUTevent_id =	$tcid_link;

	$event_hours = ($LOGINlogin_sec / 3600);
	$event_hours_int = round($event_hours, 2);
	$event_hours_int = intval("$event_hours_int");
	$event_minutes = ($event_hours - $event_hours_int);
	$event_minutes = ($event_minutes * 60);
	$event_minutes_int = round($event_minutes, 0);
	if ($event_minutes_int < 10) {$event_minutes_int = "0$event_minutes_int";}

	$stmt="SELECT full_name from vicidial_users where user='$LOGINuser';";
	if ($DB) {echo "|$stmt|\n";}
	$rslt=mysql_query($stmt, $link);
	$row=mysql_fetch_row($rslt);
	$full_name =		$row[0];

	echo "<BR><BR>\n";
	echo "<form action=$PHP_SELF method=POST name=edit_log id=edit_log>\n";
	echo "<input type=hidden name=DB value=\"$DB\">\n";
	echo "<input type=hidden name=user value=\"$user\">\n";
	echo "<input type=hidden name=stage value=edit_TC_log>\n";
	echo "<input type=hidden name=LOGINepoch id=LOGINepoch value=\"$LOGINevent_epoch\">\n";
	echo "<input type=hidden name=LOGOUTepoch id=LOGOUTepoch value=\"$LOGOUTevent_epoch\">\n";
	echo "<input type=hidden name=LOGINevent_id id=LOGINevent_id value=\"$LOGINevent_id\">\n";
	echo "<input type=hidden name=LOGOUTevent_id id=LOGOUTevent_id value=\"$LOGOUTevent_id\">\n";
	echo "<input type=hidden name=stage value=edit_TC_log>\n";
	echo "<TABLE BORDER=0><TR><TD COLSPAN=3 ALIGN=LEFT>\n";
	echo " &nbsp; &nbsp; &nbsp; &nbsp;USER: $LOGINuser ($full_name) &nbsp; &nbsp; &nbsp; &nbsp; \n";
	echo "HOURS: <span name=login_time id=login_time> $event_hours_int:$event_minutes_int </span>\n";
	echo "</TD></TR>\n";
	echo "<TR><TD>\n";
	echo "<TABLE BORDER=0>\n";
	echo "<TR><TD ALIGN=RIGHT>LOGIN TIME: </TD><TD ALIGN=RIGHT><input type=text name=LOGINbegin_date id=LOGINbegin_date value=\"$LOGINevent_date\" size=20 maxlength=20 onchange=\"calculate_hours();\"></TD></TR>\n";
	echo "<TR><TD ALIGN=RIGHT>TIMECLOCK ID: </TD><TD ALIGN=RIGHT>$LOGINevent_id</TD></TR>\n";
	echo "<TR><TD ALIGN=RIGHT>USER GROUP: </TD><TD ALIGN=RIGHT>$LOGINuser_group</TD></TR>\n";
	echo "<TR><TD ALIGN=RIGHT>IP ADDRESS: </TD><TD ALIGN=RIGHT>$LOGINip_address</TD></TR>\n";
	echo "<TR><TD ALIGN=RIGHT>MANAGER USER: </TD><TD ALIGN=RIGHT>$LOGINmanager_user</TD></TR>\n";
	echo "<TR><TD ALIGN=RIGHT>MANAGER IP: </TD><TD ALIGN=RIGHT>$LOGINmanager_ip</TD></TR>\n";
	echo "<TR><TD ALIGN=RIGHT>NOTES: </TD><TD ALIGN=RIGHT>$LOGINnotes</TD></TR>\n";
	echo "<TR><TD ALIGN=RIGHT>LAST CHANGE: </TD><TD ALIGN=RIGHT>$LOGINevent_datestamp</TD></TR>\n";
	echo "</TABLE>\n";

	echo "</TD><TD> &nbsp; &nbsp; &nbsp; &nbsp; \n";
	echo "</TD><TD>\n";
	echo "<TABLE BORDER=0>\n";
	echo "<TR><TD ALIGN=RIGHT>LOGOUT TIME: </TD><TD ALIGN=RIGHT><input type=text name=LOGOUTbegin_date id=LOGOUTbegin_date value=\"$LOGOUTevent_date\" size=20 maxlength=20 onchange=\"calculate_hours();\"></TD></TR>\n";
	echo "<TR><TD ALIGN=RIGHT>TIMECLOCK ID: </TD><TD ALIGN=RIGHT>$LOGOUTevent_id</TD></TR>\n";
	echo "<TR><TD ALIGN=RIGHT>USER GROUP: </TD><TD ALIGN=RIGHT>$LOGOUTuser_group</TD></TR>\n";
	echo "<TR><TD ALIGN=RIGHT>IP ADDRESS: </TD><TD ALIGN=RIGHT>$LOGOUTip_address</TD></TR>\n";
	echo "<TR><TD ALIGN=RIGHT>MANAGER USER: </TD><TD ALIGN=RIGHT>$LOGOUTmanager_user</TD></TR>\n";
	echo "<TR><TD ALIGN=RIGHT>MANAGER IP: </TD><TD ALIGN=RIGHT>$LOGOUTmanager_ip</TD></TR>\n";
	echo "<TR><TD ALIGN=RIGHT>NOTES: </TD><TD ALIGN=RIGHT>$LOGOUTnotes</TD></TR>\n";
	echo "<TR><TD ALIGN=RIGHT>LAST CHANGE: </TD><TD ALIGN=RIGHT>$LOGOUTevent_datestamp</TD></TR>\n";
	echo "</TABLE>\n";
	echo "</TD></TR>\n";

	echo "<TR><TD COLSPAN=3 ALIGN=LEFT>\n";
	echo "NEW NOTES: <input type=text name=notes value='' size=80 maxlength=255>\n";
	echo "</TD></TR>\n";
	echo "<TR><TD COLSPAN=3 ALIGN=CENTER>\n";
	echo "<input type=button name=go_submit id=go_submit value=SUBMIT onclick=\"run_submit();\"><BR></form>\n";
	echo "</TD></TR></TABLE>\n";
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

