<? 
# AST_agent_time_sheet.php
# 
# Copyright (C) 2009  Matt Florell <vicidial@gmail.com>    LICENSE: AGPLv2
#
# CHANGES
#
# 60619-1729 - Added variable filtering to eliminate SQL injection attack threat
#            - Added required user/pass to gain access to this page
# 80624-0132 - Added vicidial_timeclock entries
# 90310-0745 - Added admin header
#

require("dbconnect.php");

$PHP_AUTH_USER=$_SERVER['PHP_AUTH_USER'];
$PHP_AUTH_PW=$_SERVER['PHP_AUTH_PW'];
$PHP_SELF=$_SERVER['PHP_SELF'];
if (isset($_GET["agent"]))				{$agent=$_GET["agent"];}
	elseif (isset($_POST["agent"]))		{$agent=$_POST["agent"];}
if (isset($_GET["query_date"]))				{$query_date=$_GET["query_date"];}
	elseif (isset($_POST["query_date"]))	{$query_date=$_POST["query_date"];}
if (isset($_GET["calls_summary"]))			{$calls_summary=$_GET["calls_summary"];}
	elseif (isset($_POST["calls_summary"]))	{$calls_summary=$_POST["calls_summary"];}
if (isset($_GET["submit"]))				{$submit=$_GET["submit"];}
	elseif (isset($_POST["submit"]))	{$submit=$_POST["submit"];}
if (isset($_GET["ENVIAR"]))				{$ENVIAR=$_GET["ENVIAR"];}
	elseif (isset($_POST["ENVIAR"]))	{$ENVIAR=$_POST["ENVIAR"];}

$user=$agent;

$PHP_AUTH_USER = ereg_replace("[^0-9a-zA-Z]","",$PHP_AUTH_USER);
$PHP_AUTH_PW = ereg_replace("[^0-9a-zA-Z]","",$PHP_AUTH_PW);

	$stmt="SELECT count(*) from vicidial_users where user='$PHP_AUTH_USER' and pass='$PHP_AUTH_PW' and user_level > 6 and view_reports='1';";
	if ($DB) {echo "|$stmt|\n";}
	$rslt=mysql_query($stmt, $link);
	$row=mysql_fetch_row($rslt);
	$auth=$row[0];

  if( (strlen($PHP_AUTH_USER)<2) or (strlen($PHP_AUTH_PW)<2) or (!$auth))
	{
    Header("WWW-Authenticate: Basic realm=\"VICI-PROJECTS\"");
    Header("HTTP/1.0 401 Unauthorized");
    echo "Nombre y contraseña inválidos del usuario: |$PHP_AUTH_USER|$PHP_AUTH_PW|\n";
    exit;
	}

$NOW_DATE = date("Y-m-d");
$NOW_TIME = date("Y-m-d H:i:s");
$STARTtime = date("U");
if (!isset($query_date)) {$query_date = $NOW_DATE;}

?>

<HTML>
<HEAD>
<STYLE type="text/css">
<!--
   .green {color: white; background-color: green}
   .red {color: white; background-color: red}
   .blue {color: white; background-color: blue}
   .purple {color: white; background-color: purple}
-->
 </STYLE>

<? 
echo "<META HTTP-EQUIV=\"Content-Type\" CONTENT=\"text/html; charset=utf-8\">\n";
echo "<TITLE>VICIDIAL: Agent Hoja de tiempo";


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

echo "<TABLE WIDTH=$page_width BGCOLOR=\"#F0F5FE\" cellpadding=2 cellspacing=0><TR BGCOLOR=\"#F0F5FE\"><TD>\n";

echo "AgentHoja de tiempofor: $user\n";
echo "<BR>\n";
echo "<FORM ACTION=\"$PHP_SELF\" METHOD=GET> &nbsp; \n";
echo "Date: <INPUT TYPE=TEXT NAME=query_date SIZE=19 MAXLENGTH=19 VALUE=\"$query_date\">\n";
echo "Usuario ID: <INPUT TYPE=TEXT NAME=agent SIZE=10 MAXLENGTH=20 VALUE=\"$agent\">\n";
echo "<INPUT TYPE=Submit NAME=ENVIAR VALUE=ENVIAR>\n";
echo "</FORM>\n\n";

echo "<PRE><FONT SIZE=3>\n";


if (!$agent)
{
echo "\n";
echo "PLEASE SELECT AN AGENTE ID AND DATE-TIME ABOVE AND CLICK ENVIAR\n";
echo " NOTE: stats taken from available agent log data\n";
}

else
{
$query_date_BEGIN = "$query_date 00:00:00";   
$query_date_END = "$query_date 23:59:59";
$time_BEGIN = "00:00:00";   
$time_END = "23:59:59";

$stmt="select full_name from vicidial_users where user='$agent';";
$rslt=mysql_query($stmt, $link);
if ($DB) {echo "$stmt\n";}
$row=mysql_fetch_row($rslt);
$full_name = $row[0];

echo "VICIDIAL: AgentHoja de tiempo                            $NOW_TIME\n";

echo "Time range: $query_date_BEGIN to $query_date_END\n\n";
echo "---------- AGENTE TIME SHEET: $agent - $full_name -------------\n\n";

if ($calls_summary)
	{
	$stmt="select count(*) as calls,sum(talk_sec) as talk,avg(talk_sec),sum(pause_sec),avg(pause_sec),sum(wait_sec),avg(wait_sec),sum(dispo_sec),avg(dispo_sec) from vicidial_agent_log where event_time <= '" . mysql_real_escape_string($query_date_END) . "' and event_time >= '" . mysql_real_escape_string($query_date_BEGIN) . "' and user='" . mysql_real_escape_string($agent) . "' and pause_sec<48800 and wait_sec<48800 and talk_sec<48800 and dispo_sec<48800 limit 1;";
	$rslt=mysql_query($stmt, $link);
	if ($DB) {echo "$stmt\n";}
	$row=mysql_fetch_row($rslt);

	$TOTAL_TIME = ($row[1] + $row[3] + $row[5] + $row[7]);

		$TOTAL_TIME_H = ($TOTAL_TIME / 3600);
		$TOTAL_TIME_H = round($TOTAL_TIME_H, 2);
		$TOTAL_TIME_H_int = intval("$TOTAL_TIME_H");
		$TOTAL_TIME_M = ($TOTAL_TIME_H - $TOTAL_TIME_H_int);
		$TOTAL_TIME_M = ($TOTAL_TIME_M * 60);
		$TOTAL_TIME_M = round($TOTAL_TIME_M, 2);
		$TOTAL_TIME_M_int = intval("$TOTAL_TIME_M");
		$TOTAL_TIME_S = ($TOTAL_TIME_M - $TOTAL_TIME_M_int);
		$TOTAL_TIME_S = ($TOTAL_TIME_S * 60);
		$TOTAL_TIME_S = round($TOTAL_TIME_S, 0);
		if ($TOTAL_TIME_S < 10) {$TOTAL_TIME_S = "0$TOTAL_TIME_S";}
		if ($TOTAL_TIME_M_int < 10) {$TOTAL_TIME_M_int = "0$TOTAL_TIME_M_int";}
		$TOTAL_TIME_HMS = "$TOTAL_TIME_H_int:$TOTAL_TIME_M_int:$TOTAL_TIME_S";
		$pfTOTAL_TIME_HMS =		sprintf("%8s", $TOTAL_TIME_HMS);

		$TALK_TIME_H = ($row[1] / 3600);
		$TALK_TIME_H = round($TALK_TIME_H, 2);
		$TALK_TIME_H_int = intval("$TALK_TIME_H");
		$TALK_TIME_M = ($TALK_TIME_H - $TALK_TIME_H_int);
		$TALK_TIME_M = ($TALK_TIME_M * 60);
		$TALK_TIME_M = round($TALK_TIME_M, 2);
		$TALK_TIME_M_int = intval("$TALK_TIME_M");
		$TALK_TIME_S = ($TALK_TIME_M - $TALK_TIME_M_int);
		$TALK_TIME_S = ($TALK_TIME_S * 60);
		$TALK_TIME_S = round($TALK_TIME_S, 0);
		if ($TALK_TIME_S < 10) {$TALK_TIME_S = "0$TALK_TIME_S";}
		if ($TALK_TIME_M_int < 10) {$TALK_TIME_M_int = "0$TALK_TIME_M_int";}
		$TALK_TIME_HMS = "$TALK_TIME_H_int:$TALK_TIME_M_int:$TALK_TIME_S";
		$pfTALK_TIME_HMS =		sprintf("%8s", $TALK_TIME_HMS);

		$PAUSE_TIME_H = ($row[3] / 3600);
		$PAUSE_TIME_H = round($PAUSE_TIME_H, 2);
		$PAUSE_TIME_H_int = intval("$PAUSE_TIME_H");
		$PAUSE_TIME_M = ($PAUSE_TIME_H - $PAUSE_TIME_H_int);
		$PAUSE_TIME_M = ($PAUSE_TIME_M * 60);
		$PAUSE_TIME_M = round($PAUSE_TIME_M, 2);
		$PAUSE_TIME_M_int = intval("$PAUSE_TIME_M");
		$PAUSE_TIME_S = ($PAUSE_TIME_M - $PAUSE_TIME_M_int);
		$PAUSE_TIME_S = ($PAUSE_TIME_S * 60);
		$PAUSE_TIME_S = round($PAUSE_TIME_S, 0);
		if ($PAUSE_TIME_S < 10) {$PAUSE_TIME_S = "0$PAUSE_TIME_S";}
		if ($PAUSE_TIME_M_int < 10) {$PAUSE_TIME_M_int = "0$PAUSE_TIME_M_int";}
		$PAUSE_TIME_HMS = "$PAUSE_TIME_H_int:$PAUSE_TIME_M_int:$PAUSE_TIME_S";
		$pfPAUSE_TIME_HMS =		sprintf("%8s", $PAUSE_TIME_HMS);

		$WAIT_TIME_H = ($row[5] / 3600);
		$WAIT_TIME_H = round($WAIT_TIME_H, 2);
		$WAIT_TIME_H_int = intval("$WAIT_TIME_H");
		$WAIT_TIME_M = ($WAIT_TIME_H - $WAIT_TIME_H_int);
		$WAIT_TIME_M = ($WAIT_TIME_M * 60);
		$WAIT_TIME_M = round($WAIT_TIME_M, 2);
		$WAIT_TIME_M_int = intval("$WAIT_TIME_M");
		$WAIT_TIME_S = ($WAIT_TIME_M - $WAIT_TIME_M_int);
		$WAIT_TIME_S = ($WAIT_TIME_S * 60);
		$WAIT_TIME_S = round($WAIT_TIME_S, 0);
		if ($WAIT_TIME_S < 10) {$WAIT_TIME_S = "0$WAIT_TIME_S";}
		if ($WAIT_TIME_M_int < 10) {$WAIT_TIME_M_int = "0$WAIT_TIME_M_int";}
		$WAIT_TIME_HMS = "$WAIT_TIME_H_int:$WAIT_TIME_M_int:$WAIT_TIME_S";
		$pfWAIT_TIME_HMS =		sprintf("%8s", $WAIT_TIME_HMS);

		$WRAPUP_TIME_H = ($row[7] / 3600);
		$WRAPUP_TIME_H = round($WRAPUP_TIME_H, 2);
		$WRAPUP_TIME_H_int = intval("$WRAPUP_TIME_H");
		$WRAPUP_TIME_M = ($WRAPUP_TIME_H - $WRAPUP_TIME_H_int);
		$WRAPUP_TIME_M = ($WRAPUP_TIME_M * 60);
		$WRAPUP_TIME_M = round($WRAPUP_TIME_M, 2);
		$WRAPUP_TIME_M_int = intval("$WRAPUP_TIME_M");
		$WRAPUP_TIME_S = ($WRAPUP_TIME_M - $WRAPUP_TIME_M_int);
		$WRAPUP_TIME_S = ($WRAPUP_TIME_S * 60);
		$WRAPUP_TIME_S = round($WRAPUP_TIME_S, 0);
		if ($WRAPUP_TIME_S < 10) {$WRAPUP_TIME_S = "0$WRAPUP_TIME_S";}
		if ($WRAPUP_TIME_M_int < 10) {$WRAPUP_TIME_M_int = "0$WRAPUP_TIME_M_int";}
		$WRAPUP_TIME_HMS = "$WRAPUP_TIME_H_int:$WRAPUP_TIME_M_int:$WRAPUP_TIME_S";
		$pfWRAPUP_TIME_HMS =		sprintf("%8s", $WRAPUP_TIME_HMS);

		$TALK_AVG_M = ($row[2] / 60);
		$TALK_AVG_M = round($TALK_AVG_M, 2);
		$TALK_AVG_M_int = intval("$TALK_AVG_M");
		$TALK_AVG_S = ($TALK_AVG_M - $TALK_AVG_M_int);
		$TALK_AVG_S = ($TALK_AVG_S * 60);
		$TALK_AVG_S = round($TALK_AVG_S, 0);
		if ($TALK_AVG_S < 10) {$TALK_AVG_S = "0$TALK_AVG_S";}
		$TALK_AVG_MS = "$TALK_AVG_M_int:$TALK_AVG_S";
		$pfTALK_AVG_MS =		sprintf("%6s", $TALK_AVG_MS);

		$PAUSE_AVG_M = ($row[4] / 60);
		$PAUSE_AVG_M = round($PAUSE_AVG_M, 2);
		$PAUSE_AVG_M_int = intval("$PAUSE_AVG_M");
		$PAUSE_AVG_S = ($PAUSE_AVG_M - $PAUSE_AVG_M_int);
		$PAUSE_AVG_S = ($PAUSE_AVG_S * 60);
		$PAUSE_AVG_S = round($PAUSE_AVG_S, 0);
		if ($PAUSE_AVG_S < 10) {$PAUSE_AVG_S = "0$PAUSE_AVG_S";}
		$PAUSE_AVG_MS = "$PAUSE_AVG_M_int:$PAUSE_AVG_S";
		$pfPAUSE_AVG_MS =		sprintf("%6s", $PAUSE_AVG_MS);

		$WAIT_AVG_M = ($row[6] / 60);
		$WAIT_AVG_M = round($WAIT_AVG_M, 2);
		$WAIT_AVG_M_int = intval("$WAIT_AVG_M");
		$WAIT_AVG_S = ($WAIT_AVG_M - $WAIT_AVG_M_int);
		$WAIT_AVG_S = ($WAIT_AVG_S * 60);
		$WAIT_AVG_S = round($WAIT_AVG_S, 0);
		if ($WAIT_AVG_S < 10) {$WAIT_AVG_S = "0$WAIT_AVG_S";}
		$WAIT_AVG_MS = "$WAIT_AVG_M_int:$WAIT_AVG_S";
		$pfWAIT_AVG_MS =		sprintf("%6s", $WAIT_AVG_MS);

		$WRAPUP_AVG_M = ($row[8] / 60);
		$WRAPUP_AVG_M = round($WRAPUP_AVG_M, 2);
		$WRAPUP_AVG_M_int = intval("$WRAPUP_AVG_M");
		$WRAPUP_AVG_S = ($WRAPUP_AVG_M - $WRAPUP_AVG_M_int);
		$WRAPUP_AVG_S = ($WRAPUP_AVG_S * 60);
		$WRAPUP_AVG_S = round($WRAPUP_AVG_S, 0);
		if ($WRAPUP_AVG_S < 10) {$WRAPUP_AVG_S = "0$WRAPUP_AVG_S";}
		$WRAPUP_AVG_MS = "$WRAPUP_AVG_M_int:$WRAPUP_AVG_S";
		$pfWRAPUP_AVG_MS =		sprintf("%6s", $WRAPUP_AVG_MS);

	echo "LLAMADAS TOTALES TAKEN: $row[0]\n";
	echo "TALK TIME:               $pfTALK_TIME_HMS     AVERAGE: $pfTALK_AVG_MS\n";
	echo "PAUSE TIME:              $pfPAUSE_TIME_HMS     AVERAGE: $pfPAUSE_AVG_MS\n";
	echo "WAIT TIME:               $pfWAIT_TIME_HMS     AVERAGE: $pfWAIT_AVG_MS\n";
	echo "WRAPUP TIME:             $pfWRAPUP_TIME_HMS     AVERAGE: $pfWRAPUP_AVG_MS\n";
	echo "----------------------------------------------------------------\n";
	echo "TOTAL ACTIVE AGENTE TIME: $pfTOTAL_TIME_HMS\n";

	echo "\n";
	}
else
	{
	echo "<a href=\"$PHP_SELF?calls_summary=1&agent=$agent&query_date=$query_date\">Call Activity Summary</a>\n\n";

	}

$stmt="select event_time,UNIX_TIMESTAMP(event_time) from vicidial_agent_log where event_time <= '" . mysql_real_escape_string($query_date_END) . "' and event_time >= '" . mysql_real_escape_string($query_date_BEGIN) . "' and user='" . mysql_real_escape_string($agent) . "' order by event_time limit 1;";
$rslt=mysql_query($stmt, $link);
if ($DB) {echo "$stmt\n";}
$row=mysql_fetch_row($rslt);

echo "FIRST LOGIN:          $row[0]\n";
$start = $row[1];

$stmt="select event_time,UNIX_TIMESTAMP(event_time) from vicidial_agent_log where event_time <= '" . mysql_real_escape_string($query_date_END) . "' and event_time >= '" . mysql_real_escape_string($query_date_BEGIN) . "' and user='" . mysql_real_escape_string($agent) . "' order by event_time desc limit 1;";
$rslt=mysql_query($stmt, $link);
if ($DB) {echo "$stmt\n";}
$row=mysql_fetch_row($rslt);

echo "LAST LOG ACTIVITY:    $row[0]\n";
$end = $row[1];

$login_time = ($end - $start);
	$LOGIN_TIME_H = ($login_time / 3600);
	$LOGIN_TIME_H = round($LOGIN_TIME_H, 2);
	$LOGIN_TIME_H_int = intval("$LOGIN_TIME_H");
	$LOGIN_TIME_M = ($LOGIN_TIME_H - $LOGIN_TIME_H_int);
	$LOGIN_TIME_M = ($LOGIN_TIME_M * 60);
	$LOGIN_TIME_M = round($LOGIN_TIME_M, 2);
	$LOGIN_TIME_M_int = intval("$LOGIN_TIME_M");
	$LOGIN_TIME_S = ($LOGIN_TIME_M - $LOGIN_TIME_M_int);
	$LOGIN_TIME_S = ($LOGIN_TIME_S * 60);
	$LOGIN_TIME_S = round($LOGIN_TIME_S, 0);
	if ($LOGIN_TIME_S < 10) {$LOGIN_TIME_S = "0$LOGIN_TIME_S";}
	if ($LOGIN_TIME_M_int < 10) {$LOGIN_TIME_M_int = "0$LOGIN_TIME_M_int";}
	$LOGIN_TIME_HMS = "$LOGIN_TIME_H_int:$LOGIN_TIME_M_int:$LOGIN_TIME_S";
	$pfLOGIN_TIME_HMS =		sprintf("%8s", $LOGIN_TIME_HMS);

echo "-----------------------------------------\n";
echo "TOTAL LOGGED-IN TIME:    $pfLOGIN_TIME_HMS\n";


### timeclock records


##### vicidial_timeclock log records for user #####

$total_login_time=0;
$SQday_ARY =	explode('-',$query_date_BEGIN);
$EQday_ARY =	explode('-',$query_date_END);
$SQepoch = mktime(0, 0, 0, $SQday_ARY[1], $SQday_ARY[2], $SQday_ARY[0]);
$EQepoch = mktime(23, 59, 59, $EQday_ARY[1], $EQday_ARY[2], $EQday_ARY[0]);

echo "\n";

echo "<B>TIMECLOCK TIEMPO LOGIN/LOGOUT:</B>\n";
echo "<TABLE width=550 cellspacing=0 cellpadding=1>\n";
echo "<tr><td><font size=2>ID </td><td><font size=2>EDIT </td><td align=right><font size=2>EVENTO</td><td align=right><font size=2> FECHA</td><td align=right><font size=2> IP ADDRESS</td><td align=right><font size=2> GROUP</td><td align=right><font size=2>HORAS:MINUTOS</td></tr>\n";

	$stmt="SELECT event,event_epoch,user_group,login_sec,ip_address,timeclock_id,manager_user from vicidial_timeclock_log where user='$agent' and event_epoch >= '$SQepoch'  and event_epoch <= '$EQepoch';";
	if ($DB>0) {echo "|$stmt|";}
	$rslt=mysql_query($stmt, $link);
	$events_to_print = mysql_num_rows($rslt);

	$total_logs=0;
	$o=0;
	while ($events_to_print > $o) {
		$row=mysql_fetch_row($rslt);
		if ( ($row[0]=='START') or ($row[0]=='LOGIN') )
			{$bgcolor='bgcolor="#B9CBFD"';} 
		else
			{$bgcolor='bgcolor="#9BB9FB"';}

		$TC_log_date = date("Y-m-d H:i:s", $row[1]);

		$manager_edit='';
		if (strlen($row[6])>0) {$manager_edit = ' * ';}

		if (ereg("LOGIN", $row[0]))
			{
			$login_sec='';
			echo "<tr $bgcolor><td><font size=2><A HREF=\"./timeclock_edit.php?timeclock_id=$row[5]\">$row[5]</A></td>";
			echo "<td align=right><font size=2>$manager_edit</td>";
			echo "<td align=right><font size=2>$row[0]</td>";
			echo "<td align=right><font size=2> $TC_log_date</td>\n";
			echo "<td align=right><font size=2> $row[4]</td>\n";
			echo "<td align=right><font size=2> $row[2]</td>\n";
			echo "<td align=right><font size=2> </td></tr>\n";
			}
		if (ereg("LOGOUT", $row[0]))
			{
			$login_sec = $row[3];
			$total_login_time = ($total_login_time + $login_sec);
			$event_hours = ($login_sec / 3600);
			$event_hours_int = round($event_hours, 2);
			$event_hours_int = intval("$event_hours_int");
			$event_minutes = ($event_hours - $event_hours_int);
			$event_minutes = ($event_minutes * 60);
			$event_minutes_int = round($event_minutes, 0);
			if ($event_minutes_int < 10) {$event_minutes_int = "0$event_minutes_int";}
			echo "<tr $bgcolor><td><font size=2><A HREF=\"./timeclock_edit.php?timeclock_id=$row[5]\">$row[5]</A></td>";
			echo "<td align=right><font size=2>$manager_edit</td>";
			echo "<td align=right><font size=2>$row[0]</td>";
			echo "<td align=right><font size=2> $TC_log_date</td>\n";
			echo "<td align=right><font size=2> $row[4]</td>\n";
			echo "<td align=right><font size=2> $row[2]</td>\n";
			echo "<td align=right><font size=2> $event_hours_int:$event_minutes_int";
			if ($DB) {echo " - $total_login_time - $login_sec";}
			echo "</td></tr>\n";
			}
		$o++;
	}
if (strlen($login_sec)<1)
	{
	$login_sec = ($STARTtime - $row[1]);
	$total_login_time = ($total_login_time + $login_sec);
		if ($DB) {echo "LOGIN ONLY - $total_login_time - $login_sec";}
	}
$total_login_hours = ($total_login_time / 3600);
$total_login_hours_int = round($total_login_hours, 2);
$total_login_hours_int = intval("$total_login_hours_int");
$total_login_minutes = ($total_login_hours - $total_login_hours_int);
$total_login_minutes = ($total_login_minutes * 60);
$total_login_minutes_int = round($total_login_minutes, 0);
if ($total_login_minutes_int < 10) {$total_login_minutes_int = "0$total_login_minutes_int";}

	if ($DB) {echo " - $total_login_time - $login_sec";}

echo "<tr><td align=right><font size=2> </td>";
echo "<td align=right><font size=2> </td>\n";
echo "<td align=right><font size=2> </td>\n";
echo "<td align=right><font size=2> </td>\n";
echo "<td align=right><font size=2><font size=2>TOTAL </td>\n";
echo "<td align=right><font size=2> $total_login_hours_int:$total_login_minutes_int  </td></tr>\n";

echo "</TABLE>\n";



}



?>

</BODY></HTML>