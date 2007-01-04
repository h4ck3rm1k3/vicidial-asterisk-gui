<?
### user_stats.php
### 
### Copyright (C) 2006  Matt Florell <vicidial@gmail.com>    LICENSE: GPLv2
###
# CHANGES
#
# 60619-1743 - Added variable filtering to eliminate SQL injection attack threat
# 61201-1136 - Added recordings display and changed calls to time range with 10000 limit
#

header ("Content-type: text/html; charset=utf-8");

require("dbconnect.php");

$PHP_AUTH_USER=$_SERVER['PHP_AUTH_USER'];
$PHP_AUTH_PW=$_SERVER['PHP_AUTH_PW'];
$PHP_SELF=$_SERVER['PHP_SELF'];
if (isset($_GET["begin_date"]))				{$begin_date=$_GET["begin_date"];}
	elseif (isset($_POST["begin_date"]))		{$begin_date=$_POST["begin_date"];}
if (isset($_GET["end_date"]))				{$end_date=$_GET["end_date"];}
	elseif (isset($_POST["end_date"]))		{$end_date=$_POST["end_date"];}
if (isset($_GET["user"]))				{$user=$_GET["user"];}
	elseif (isset($_POST["user"]))		{$user=$_POST["user"];}
if (isset($_GET["campaign"]))				{$campaign=$_GET["campaign"];}
	elseif (isset($_POST["campaign"]))		{$campaign=$_POST["campaign"];}
if (isset($_GET["submit"]))				{$submit=$_GET["submit"];}
	elseif (isset($_POST["submit"]))		{$submit=$_POST["submit"];}
if (isset($_GET["SUBMIT"]))				{$SUBMIT=$_GET["SUBMIT"];}
	elseif (isset($_POST["SUBMIT"]))		{$SUBMIT=$_POST["SUBMIT"];}

$PHP_AUTH_USER = ereg_replace("[^0-9a-zA-Z]","",$PHP_AUTH_USER);
$PHP_AUTH_PW = ereg_replace("[^0-9a-zA-Z]","",$PHP_AUTH_PW);

$STARTtime = date("U");
$TODAY = date("Y-m-d");

if (!isset($begin_date)) {$begin_date = $TODAY;}
if (!isset($end_date)) {$end_date = $TODAY;}

	$stmt="SELECT count(*) from vicidial_users where user='$PHP_AUTH_USER' and pass='$PHP_AUTH_PW' and user_level > 7;";
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

	$stmt="SELECT full_name from vicidial_users where user='$user';";
	$rslt=mysql_query($stmt, $link);
	$row=mysql_fetch_row($rslt);
	$full_name = $row[0];

	}




?>
<html>
<head>
<title>VICIDIAL ADMIN: User Stats</title>
<?
echo "<META HTTP-EQUIV=\"Content-Type\" CONTENT=\"text/html; charset=utf-8\">\n";
?>
</head>
<BODY BGCOLOR=white marginheight=0 marginwidth=0 leftmargin=0 topmargin=0>
<CENTER>
<TABLE WIDTH=620 BGCOLOR=#D9E6FE cellpadding=2 cellspacing=0><TR BGCOLOR=#015B91><TD ALIGN=LEFT><? echo "<a href=\"./admin.php\">" ?><FONT FACE="ARIAL,HELVETICA" COLOR=WHITE SIZE=2><B> &nbsp; VICIDIAL ADMIN</a>: User Stats for <? echo $user ?></TD><TD ALIGN=RIGHT><FONT FACE="ARIAL,HELVETICA" COLOR=WHITE SIZE=2><B><? echo date("l F j, Y G:i:s A") ?> &nbsp; </TD></TR>




<? 

echo "<TR BGCOLOR=\"#F0F5FE\"><TD ALIGN=LEFT COLSPAN=2><FONT FACE=\"ARIAL,HELVETICA\" COLOR=BLACK SIZE=2><B> &nbsp; \n";

echo "<form action=$PHP_SELF method=POST>\n";
echo "<input type=hidden name=user value=\"$user\">\n";
echo "<input type=text name=begin_date value=\"$begin_date\" size=10 maxsize=10> to \n";
echo "<input type=text name=end_date value=\"$end_date\" size=10 maxsize=10> &nbsp;\n";
echo "<input type=submit name=submit value=submit>\n";


echo " &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; $user - $full_name\n";

echo " - <a href=\"./AST_agent_time_sheet.php?agent=$user\">VICIDIAL Time Sheet</a>\n";
echo " - <a href=\"./user_status.php?user=$user\">User Status</a>\n";
echo " - <a href=\"./admin.php?ADD=3&user=$user\">Modify User</a>\n";


echo "</B></TD></TR>\n";
echo "<TR><TD ALIGN=LEFT COLSPAN=2>\n";


	$stmt="SELECT count(*),status, sum(length_in_sec) from vicidial_log where user='" . mysql_real_escape_string($user) . "' and call_date >= '" . mysql_real_escape_string($begin_date) . " 0:00:01'  and call_date <= '" . mysql_real_escape_string($end_date) . " 23:59:59' group by status order by status";
	$rslt=mysql_query($stmt, $link);
	$statuses_to_print = mysql_num_rows($rslt);

echo "<br><center>\n";

echo "<B>TALK TIME AND STATUS:</B>\n";

echo "<center><TABLE width=300 cellspacing=0 cellpadding=1>\n";
echo "<tr><td><font size=2>STATUS</td><td align=right><font size=2>COUNT</td><td align=right><font size=2>HOURS:MINUTES</td></tr>\n";

	$total_calls=0;
	$o=0;
	while ($statuses_to_print > $o) {
		$row=mysql_fetch_row($rslt);
		if (eregi("1$|3$|5$|7$|9$", $o))
			{$bgcolor='bgcolor="#B9CBFD"';} 
		else
			{$bgcolor='bgcolor="#9BB9FB"';}

		$call_seconds = $row[2];
		$call_hours = ($call_seconds / 3600);
		$call_hours = round($call_hours, 2);
		$call_hours_int = intval("$call_hours");
		$call_minutes = ($call_hours - $call_hours_int);
		$call_minutes = ($call_minutes * 60);
		$call_minutes_int = round($call_minutes, 0);
		if ($call_minutes_int < 10) {$call_minutes_int = "0$call_minutes_int";}

		echo "<tr $bgcolor><td><font size=2>$row[1]</td>";
		echo "<td align=right><font size=2> $row[0]</td>\n";
		echo "<td align=right><font size=2> $call_hours_int:$call_minutes_int</td></tr>\n";
		$total_calls = ($total_calls + $row[0]);

		$call_seconds=0;
		$o++;
	}

	$stmt="SELECT sum(length_in_sec) from vicidial_log where user='" . mysql_real_escape_string($user) . "' and call_date >= '" . mysql_real_escape_string($begin_date) . " 0:00:01'  and call_date <= '" . mysql_real_escape_string($end_date) . " 23:59:59'";
	$rslt=mysql_query($stmt, $link);
	$counts_to_print = mysql_num_rows($rslt);
		$row=mysql_fetch_row($rslt);
	$call_seconds = $row[0];
	$call_hours = ($call_seconds / 3600);
	$call_hours = round($call_hours, 2);
	$call_hours_int = intval("$call_hours");
	$call_minutes = ($call_hours - $call_hours_int);
	$call_minutes = ($call_minutes * 60);
	$call_minutes_int = round($call_minutes, 0);
	if ($call_minutes_int < 10) {$call_minutes_int = "0$call_minutes_int";}

echo "<tr><td><font size=2>TOTAL CALLS </td><td align=right><font size=2> $total_calls</td><td align=right><font size=2> $call_hours_int:$call_minutes_int</td></tr>\n";
echo "</TABLE></center>\n";
echo "<br><br>\n";

echo "<center>\n";

echo "<B>LOGIN/LOGOUT TIME:</B>\n";
echo "<TABLE width=400 cellspacing=0 cellpadding=1>\n";
echo "<tr><td><font size=2>EVENT </td><td align=right><font size=2> DATE</td><td align=right><font size=2> CAMPAIGN</td><td align=right><font size=2>HOURS:MINUTES</td></tr>\n";

	$stmt="SELECT event,event_epoch,event_date,campaign_id from vicidial_user_log where user='" . mysql_real_escape_string($user) . "' and event_date >= '" . mysql_real_escape_string($begin_date) . " 0:00:01'  and event_date <= '" . mysql_real_escape_string($end_date) . " 23:59:59'";
	$rslt=mysql_query($stmt, $link);
	$events_to_print = mysql_num_rows($rslt);

	$total_calls=0;
	$o=0;
	$event_start_seconds='';
	$event_stop_seconds='';
	while ($events_to_print > $o) {
		$row=mysql_fetch_row($rslt);
		if (eregi("LOGIN", $row[0]))
			{$bgcolor='bgcolor="#B9CBFD"';} 
		else
			{$bgcolor='bgcolor="#9BB9FB"';}

		if (ereg("LOGIN", $row[0]))
			{
			$event_start_seconds = $row[1];
			echo "<tr $bgcolor><td><font size=2>$row[0]</td>";
			echo "<td align=right><font size=2> $row[2]</td>\n";
			echo "<td align=right><font size=2> $row[3]</td>\n";
			echo "<td align=right><font size=2> </td></tr>\n";
			}
		if (ereg("LOGOUT", $row[0]))
			{
			if ($event_start_seconds)
				{
				$event_stop_seconds = $row[1];
				$event_seconds = ($event_stop_seconds - $event_start_seconds);
				$total_login_time = ($total_login_time + $event_seconds);
				$event_hours = ($event_seconds / 3600);
				$event_hours = round($event_hours, 2);
				$event_hours_int = intval("$event_hours");
				$event_minutes = ($event_hours - $event_hours_int);
				$event_minutes = ($event_minutes * 60);
				$event_minutes_int = round($event_minutes, 0);
				if ($event_minutes_int < 10) {$event_minutes_int = "0$event_minutes_int";}
				echo "<tr $bgcolor><td><font size=2>$row[0]</td>";
				echo "<td align=right><font size=2> $row[2]</td>\n";
				echo "<td align=right><font size=2> $row[3]</td>\n";
				echo "<td align=right><font size=2> $event_hours_int:$event_minutes_int</td></tr>\n";
				$event_start_seconds='';
				$event_stop_seconds='';
				}
			else
				{
				echo "<tr $bgcolor><td><font size=2>$row[0]</td>";
				echo "<td align=right><font size=2> $row[2]</td>\n";
				echo "<td align=right><font size=2> $row[3]</td>\n";
				echo "<td align=right><font size=2> </td></tr>\n";
				}
			}

		$total_calls = ($total_calls + $row[0]);

		$call_seconds=0;
		$o++;
	}

$total_login_hours = ($total_login_time / 3600);
$total_login_hours = round($total_login_hours, 2);
$total_login_hours_int = intval("$total_login_hours");
$total_login_minutes = ($total_login_hours - $total_login_hours_int);
$total_login_minutes = ($total_login_minutes * 60);
$total_login_minutes_int = round($total_login_minutes, 0);
if ($total_login_minutes_int < 10) {$total_login_minutes_int = "0$total_login_minutes_int";}

echo "<tr><td><font size=2>TOTAL</td>";
echo "<td align=right><font size=2> </td>\n";
echo "<td align=right><font size=2> </td>\n";
echo "<td align=right><font size=2> $total_login_hours_int:$total_login_minutes_int</td></tr>\n";

echo "</TABLE></center>\n";


echo "<br><br>\n";

echo "<center>\n";

echo "<B>CALLS FOR THIS TIME PERIOD: (10000 record limit)</B>\n";
echo "<TABLE width=550 cellspacing=0 cellpadding=1>\n";
echo "<tr><td><font size=1># </td><td><font size=2>DATE/TIME </td><td align=left><font size=2>LENGTH</td><td align=left><font size=2> STATUS</td><td align=left><font size=2> PHONE</td><td align=right><font size=2> CAMPAIGN</td><td align=right><font size=2> LIST</td><td align=right><font size=2> LEAD</td></tr>\n";

	$stmt="select * from vicidial_log where user='" . mysql_real_escape_string($user) . "' and call_date >= '" . mysql_real_escape_string($begin_date) . " 0:00:01'  and call_date <= '" . mysql_real_escape_string($end_date) . " 23:59:59' order by call_date desc limit 10000;";
	$rslt=mysql_query($stmt, $link);
	$logs_to_print = mysql_num_rows($rslt);

	$u=0;
	while ($logs_to_print > $u) {
		$row=mysql_fetch_row($rslt);
		if (eregi("1$|3$|5$|7$|9$", $u))
			{$bgcolor='bgcolor="#B9CBFD"';} 
		else
			{$bgcolor='bgcolor="#9BB9FB"';}

			$u++;
			echo "<tr $bgcolor>";
			echo "<td><font size=1>$u</td>";
			echo "<td><font size=2>$row[4]</td>";
			echo "<td align=left><font size=2> $row[7]</td>\n";
			echo "<td align=left><font size=2> $row[8]</td>\n";
			echo "<td align=left><font size=2> $row[10] </td>\n";
			echo "<td align=right><font size=2> $row[3] </td>\n";
			echo "<td align=right><font size=2> $row[2] </td>\n";
			echo "<td align=right><font size=2> <A HREF=\"admin_modify_lead.php?lead_id=$row[1]\" target=\"_blank\">$row[1]</A> </td></tr>\n";

	}


echo "</TABLE></center>\n";



echo "<B>RECORDINGS FOR THIS TIME PERIOD: (10000 record limit)</B>\n";
echo "<TABLE width=750 cellspacing=0 cellpadding=1>\n";
echo "<tr><td><font size=1># </td><td align=left><font size=2> LEAD</td><td><font size=2>DATE/TIME </td><td align=left><font size=2>SECONDS </td><td align=left><font size=2> &nbsp; RECID</td><td align=center><font size=2>FILENAME</td><td align=left><font size=2>LOCATION</td></tr>\n";

	$stmt="select * from recording_log where user='" . mysql_real_escape_string($user) . "' and start_time >= '" . mysql_real_escape_string($begin_date) . " 0:00:01'  and start_time <= '" . mysql_real_escape_string($end_date) . " 23:59:59' order by recording_id desc limit 10000;";
	$rslt=mysql_query($stmt, $link);
	$logs_to_print = mysql_num_rows($rslt);

	$u=0;
	while ($logs_to_print > $u) 
		{
		$row=mysql_fetch_row($rslt);
		if (eregi("1$|3$|5$|7$|9$", $u))
			{$bgcolor='bgcolor="#B9CBFD"';} 
		else
			{$bgcolor='bgcolor="#9BB9FB"';}

			$u++;
			echo "<tr $bgcolor>";
			echo "<td><font size=1>$u</td>";
			echo "<td align=left><font size=2> <A HREF=\"admin_modify_lead.php?lead_id=$row[12]\" target=\"_blank\">$row[12]</A> </td>";
			echo "<td align=left><font size=2> $row[4] </td>\n";
			echo "<td align=left><font size=2> $row[8] </td>\n";
			echo "<td align=left><font size=2> $row[0] </td>\n";
			echo "<td align=center><font size=2> $row[10] </td>\n";
			echo "<td align=right><font size=2> $row[11] </td>\n";
			echo "</tr>\n";

		}


echo "</TABLE></center>\n";

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





