<? 
# AST_CLOSERstats.php
# 
# Copyright (C) 2008  Matt Florell <vicidial@gmail.com>    LICENSE: AGPLv2
#
# CHANGES
#
# 60619-1714 - Added variable filtering to eliminate SQL injection attack threat
#            - Added required user/pass to gain access to this page
# 60905-1326 - Added queue time stats
# 71008-1436 - Added shift to be defined in dbconnect.php
# 71025-0021 - Added status breakdown
# 71218-1155 - Added end_date for multi-day reports
# 80430-1920 - Added Customer hangup cause stats
# 80709-0331 - Added time stats to call statuses
# 80722-2149 - Added Status Category stats
# 81015-0705 - Added IVR calls count
#

require("dbconnect.php");

$PHP_AUTH_USER=$_SERVER['PHP_AUTH_USER'];
$PHP_AUTH_PW=$_SERVER['PHP_AUTH_PW'];
$PHP_SELF=$_SERVER['PHP_SELF'];
if (isset($_GET["group"]))				{$group=$_GET["group"];}
	elseif (isset($_POST["group"]))		{$group=$_POST["group"];}
if (isset($_GET["query_date"]))				{$query_date=$_GET["query_date"];}
	elseif (isset($_POST["query_date"]))	{$query_date=$_POST["query_date"];}
if (isset($_GET["end_date"]))				{$end_date=$_GET["end_date"];}
	elseif (isset($_POST["end_date"]))		{$end_date=$_POST["end_date"];}
if (isset($_GET["shift"]))				{$shift=$_GET["shift"];}
	elseif (isset($_POST["shift"]))		{$shift=$_POST["shift"];}
if (isset($_GET["submit"]))				{$submit=$_GET["submit"];}
	elseif (isset($_POST["submit"]))		{$submit=$_POST["submit"];}
if (isset($_GET["INVIA"]))				{$INVIA=$_GET["INVIA"];}
	elseif (isset($_POST["INVIA"]))		{$INVIA=$_POST["INVIA"];}

$PHP_AUTH_USER = ereg_replace("[^0-9a-zA-Z]","",$PHP_AUTH_USER);
$PHP_AUTH_PW = ereg_replace("[^0-9a-zA-Z]","",$PHP_AUTH_PW);

if (strlen($shift)<2) {$shift='ALL';}

#############################################
##### START SYSTEM_SETTINGS LOOKUP #####
$stmt = "SELECT use_non_latin FROM system_settings;";
$rslt=mysql_query($stmt, $link);
if ($DB) {echo "$stmt\n";}
$qm_conf_ct = mysql_num_rows($rslt);
$i=0;
while ($i < $qm_conf_ct)
	{
	$row=mysql_fetch_row($rslt);
	$non_latin =					$row[0];
	$i++;
	}
##### END SETTINGS LOOKUP #####
###########################################

$stmt="SELECT count(*) from vicidial_users where user='$PHP_AUTH_USER' and pass='$PHP_AUTH_PW' and user_level >= 7 and view_reports='1';";
if ($DB) {echo "|$stmt|\n";}
if ($non_latin > 0) {$rslt=mysql_query("SET NAMES 'UTF8'");}
$rslt=mysql_query($stmt, $link);
$row=mysql_fetch_row($rslt);
$auth=$row[0];


  if( (strlen($PHP_AUTH_USER)<2) or (strlen($PHP_AUTH_PW)<2) or (!$auth))
	{
    Header("WWW-Authenticate: Basic realm=\"VICI-PROJECTS\"");
    Header("HTTP/1.0 401 Unauthorized");
    echo "Username/Password non validi: |$PHP_AUTH_USER|$PHP_AUTH_PW|\n";
    exit;
	}

$NOW_DATE = date("Y-m-d");
$NOW_TIME = date("Y-m-d H:i:s");
$STARTtime = date("U");
if (!isset($group)) {$group = '';}
if (!isset($query_date)) {$query_date = $NOW_DATE;}
if (!isset($end_date)) {$end_date = $NOW_DATE;}

$stmt="select group_id from vicidial_inbound_groups;";
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

$stmt="select vsc_id,vsc_name from vicidial_status_categories;";
$rslt=mysql_query($stmt, $link);
if ($DB) {echo "$stmt\n";}
$statcats_to_print = mysql_num_rows($rslt);
$i=0;
while ($i < $statcats_to_print)
	{
	$row=mysql_fetch_row($rslt);
	$vsc_id[$i] =	$row[0];
	$vsc_name[$i] =	$row[1];
	$vsc_count[$i] = 0;
	$i++;
	}
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
echo "<TITLE>VICIDIAL: Estadísticas de VDAD Closer</TITLE></HEAD><BODY BGCOLOR=WHITE>\n";
echo "<FORM ACTION=\"$PHP_SELF\" METHOD=GET>\n";
echo "<INPUT TYPE=TEXT NAME=query_date SIZE=10 MAXLENGTH=10 VALUE=\"$query_date\">\n";
echo " to <INPUT TYPE=TEXT NAME=end_date SIZE=10 MAXLENGTH=10 VALUE=\"$end_date\">\n";
echo "<SELECT SIZE=1 NAME=group>\n";
	$o=0;
	while ($groups_to_print > $o)
	{
		if ($groups[$o] == $group) {echo "<option selected value=\"$groups[$o]\">$groups[$o]</option>\n";}
		  else {echo "<option value=\"$groups[$o]\">$groups[$o]</option>\n";}
		$o++;
	}
echo "</SELECT>\n";
echo "<SELECT SIZE=1 NAME=shift>\n";
echo "<option selected value=\"$shift\">$shift</option>\n";
echo "<option value=\"\">--</option>\n";
echo "<option value=\"AM\">AM</option>\n";
echo "<option value=\"PM\">PM</option>\n";
echo "<option value=\"ALL\">ALL</option>\n";
echo "</SELECT>\n";
echo "<INPUT TYPE=submit NAME=INVIA VALUE=INVIA>\n";
echo "<FONT FACE=\"ARIAL,HELVETICA\" COLOR=BLACK SIZE=2> &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; <a href=\"./admin.php?ADD=3111&group_id=$group\">MODIFICA</a> | <a href=\"./admin.php?ADD=999999\">REPORT</a> </FONT>\n";
echo "</FORM>\n\n";

echo "<PRE><FONT SIZE=2>\n\n";


if (!$group)
{
echo "\n\n";
echo "PER FAVORE SELEZIONA UN GRUPPO INBOUND E UN INTERVALLO DI TEMPO, POI PREMI INVIA\n";
}

else
{
if ($shift == 'AM') 
	{
	$time_BEGIN=$AM_shift_BEGIN;
	$time_END=$AM_shift_END;
	if (strlen($time_BEGIN) < 6) {$time_BEGIN = "03:45:00";}   
	if (strlen($time_END) < 6) {$time_END = "15:15:00";}
	}
if ($shift == 'PM') 
	{
	$time_BEGIN=$PM_shift_BEGIN;
	$time_END=$PM_shift_END;
	if (strlen($time_BEGIN) < 6) {$time_BEGIN = "15:15:00";}
	if (strlen($time_END) < 6) {$time_END = "23:15:00";}
	}
if ($shift == 'ALL') 
	{
	if (strlen($time_BEGIN) < 6) {$time_BEGIN = "00:00:00";}
	if (strlen($time_END) < 6) {$time_END = "23:59:59";}
	}
$query_date_BEGIN = "$query_date $time_BEGIN";   
$query_date_END = "$end_date $time_END";



echo "VICIDIAL: Estadísticas de Auto-dial en CLOSER                      $NOW_TIME\n";

echo "\n";
echo "Intervallo Di Tempo: $query_date_BEGIN to $query_date_END\n\n";
echo "---------- TOTALI\n";

$stmt="select count(*),sum(length_in_sec) from vicidial_closer_log where call_date >= '$query_date_BEGIN' and call_date <= '$query_date_END' and campaign_id='" . mysql_real_escape_string($group) . "';";
$rslt=mysql_query($stmt, $link);
if ($DB) {echo "$stmt\n";}
$row=mysql_fetch_row($rslt);

$stmt="select count(*) from live_inbound_log where start_time >= '$query_date_BEGIN' and start_time <= '$query_date_END' and comment_a='" . mysql_real_escape_string($group) . "' and comment_b='START';";
$rslt=mysql_query($stmt, $link);
if ($DB) {echo "$stmt\n";}
$rowx=mysql_fetch_row($rslt);

$TOTALcalls =	sprintf("%10s", $row[0]);
$IVRcalls =	sprintf("%10s", $rowx[0]);
$TOTALsec =		$row[1];
if ( ($row[0] < 1) or ($TOTALsec < 1) )
	{$average_call_seconds = '         0';}
else
	{
	$average_call_seconds = ($TOTALsec / $row[0]);
	$average_call_seconds = round($average_call_seconds, 0);
	$average_call_seconds =	sprintf("%10s", $average_call_seconds);
	}

echo "Llamadas totales tomadas in to this In-Gruppo:        $TOTALcalls\n";
echo "Average Call Length for all Calls:            $average_call_seconds seconds\n";
echo "Calls taken into the IVR for this In-Gruppo:   $IVRcalls\n";

echo "\n";
echo "---------- ABBATTUTE\n";

$stmt="select count(*),sum(length_in_sec) from vicidial_closer_log where call_date >= '$query_date_BEGIN' and call_date <= '$query_date_END' and campaign_id='" . mysql_real_escape_string($group) . "' and status='DROP' and (length_in_sec <= 999 or length_in_sec is null);";
$rslt=mysql_query($stmt, $link);
if ($DB) {echo "$stmt\n";}
$row=mysql_fetch_row($rslt);

$DROPcalls =	sprintf("%10s", $row[0]);
if ( ($DROPcalls < 1) or ($TOTALcalls < 1) )
	{$DROPpercent = '0';}
else
	{
	$DROPpercent = (($DROPcalls / $TOTALcalls) * 100);
	$DROPpercent = round($DROPpercent, 0);
	}

if ( ($row[0] < 1) or ($row[1] < 1) )
	{
	$average_hold_seconds = '         0';
	}
else
	{
	$average_hold_seconds = ($row[1] / $row[0]);
	$average_hold_seconds = round($average_hold_seconds, 0);
	$average_hold_seconds =	sprintf("%10s", $average_hold_seconds);
	}

echo "Totale Chiamate ABBATTUTE: $DROPcalls  $DROPpercent%\n";
echo "Average hold time for DROP Calls:             $average_hold_seconds seconds\n";


# GET LIST OF ALL STATUSES and create SQL from human_answered statuses
$q=0;
$stmt = "SELECT status,status_name,human_answered,category from vicidial_statuses;";
$rslt=mysql_query($stmt, $link);
if ($DB) {echo "$stmt\n";}
$statuses_to_print = mysql_num_rows($rslt);
$p=0;
while ($p < $statuses_to_print)
	{
	$row=mysql_fetch_row($rslt);
	$status[$q] =			$row[0];
	$status_name[$q] =		$row[1];
	$human_answered[$q] =	$row[2];
	$category[$q] =			$row[3];
	$statname_list["$status[$q]"] = "$status_name[$q]";
	$statcat_list["$status[$q]"] = "$category[$q]";
	$q++;
	$p++;
	}
$stmt = "SELECT status,status_name,human_answered,category from vicidial_campaign_statuses;";
$rslt=mysql_query($stmt, $link);
if ($DB) {echo "$stmt\n";}
$statuses_to_print = mysql_num_rows($rslt);
$p=0;
while ($p < $statuses_to_print)
	{
	$row=mysql_fetch_row($rslt);
	$status[$q] =			$row[0];
	$status_name[$q] =		$row[1];
	$human_answered[$q] =	$row[2];
	$category[$q] =			$row[3];
	$statname_list["$status[$q]"] = "$status_name[$q]";
	$statcat_list["$status[$q]"] = "$category[$q]";
	$q++;
	$p++;
	}

##############################
#########  CALL QUEUE STATS
echo "\n";
echo "---------- QUEUE STATS\n";

$stmt="select count(*),sum(queue_seconds) from vicidial_closer_log where call_date >= '$query_date_BEGIN' and call_date <= '$query_date_END' and campaign_id='" . mysql_real_escape_string($group) . "' and (queue_seconds > 0);";
$rslt=mysql_query($stmt, $link);
if ($DB) {echo "$stmt\n";}
$row=mysql_fetch_row($rslt);

$QUEUEcalls =	sprintf("%10s", $row[0]);
if ( ($QUEUEcalls < 1) or ($TOTALcalls < 1) )
	{$QUEUEpercent = '0';}
else
	{
	$QUEUEpercent = (($QUEUEcalls / $TOTALcalls) * 100);
	$QUEUEpercent = round($QUEUEpercent, 0);
	}

if ( ($row[0] < 1) or ($row[1] < 1) )
	{$average_queue_seconds = '         0';}
else
	{
	$average_queue_seconds = ($row[1] / $row[0]);
	$average_queue_seconds = round($average_queue_seconds, 2);
	$average_queue_seconds = sprintf("%10.2f", $average_queue_seconds);
	}

if ( ($TOTALcalls < 1) or ($row[1] < 1) )
	{$average_total_queue_seconds = '         0';}
else
	{
	$average_total_queue_seconds = ($row[1] / $TOTALcalls);
	$average_total_queue_seconds = round($average_total_queue_seconds, 2);
	$average_total_queue_seconds = sprintf("%10.2f", $average_total_queue_seconds);
	}

echo "Total Calls That entered Queue:               $QUEUEcalls  $QUEUEpercent%\n";
echo "Average QUEUE Length for queue calls:         $average_queue_seconds seconds\n";
echo "Average QUEUE Length across all calls:        $average_total_queue_seconds seconds\n";



##############################
#########  CALL HOLD TIME BREAKDONW IN SECONDS

$TOTALcalls = 0;

echo "\n";
echo "---------- CALL HOLD TIME BREAKDOWN IN SECONDS\n";
echo "+-------------------------------------------------------------------------------------------+------------+\n";
echo "|     0     5    10    15    20    25    30    35    40    45    50    55    60    90   +90 | TOTAL      |\n";
echo "+-------------------------------------------------------------------------------------------+------------+\n";

$stmt="select count(*),queue_seconds from vicidial_closer_log where call_date >= '$query_date_BEGIN' and call_date <= '$query_date_END' and  campaign_id='" . mysql_real_escape_string($group) . "' group by queue_seconds;";
$rslt=mysql_query($stmt, $link);
if ($DB) {echo "$stmt\n";}
$reasons_to_print = mysql_num_rows($rslt);
$i=0;
while ($i < $reasons_to_print)
	{
	$row=mysql_fetch_row($rslt);

	$TOTALcalls = ($TOTALcalls + $row[0]);

	if ($row[1] == 0) {$hd_0 = ($hd_0 + $row[0]);}
	if ( ($row[1] > 0) and ($row{1} <= 5) ) {$hd_5 = ($hd_5 + $row[0]);}
	if ( ($row[1] > 5) and ($row{1} <= 10) ) {$hd10 = ($hd10 + $row[0]);}
	if ( ($row[1] > 10) and ($row{1} <= 15) ) {$hd15 = ($hd15 + $row[0]);}
	if ( ($row[1] > 15) and ($row{1} <= 20) ) {$hd20 = ($hd20 + $row[0]);}
	if ( ($row[1] > 20) and ($row{1} <= 25) ) {$hd25 = ($hd25 + $row[0]);}
	if ( ($row[1] > 25) and ($row{1} <= 30) ) {$hd30 = ($hd30 + $row[0]);}
	if ( ($row[1] > 30) and ($row{1} <= 35) ) {$hd35 = ($hd35 + $row[0]);}
	if ( ($row[1] > 35) and ($row{1} <= 40) ) {$hd40 = ($hd40 + $row[0]);}
	if ( ($row[1] > 40) and ($row{1} <= 45) ) {$hd45 = ($hd45 + $row[0]);}
	if ( ($row[1] > 45) and ($row{1} <= 50) ) {$hd50 = ($hd50 + $row[0]);}
	if ( ($row[1] > 50) and ($row{1} <= 55) ) {$hd55 = ($hd55 + $row[0]);}
	if ( ($row[1] > 55) and ($row{1} <= 60) ) {$hd60 = ($hd60 + $row[0]);}
	if ( ($row[1] > 60) and ($row{1} <= 90) ) {$hd90 = ($hd90 + $row[0]);}
	if ($row[1] > 90) {$hd99 = ($hd99 + $row[0]);}
	$i++;
	}

$hd_0 =	sprintf("%5s", $hd_0);
$hd_5 =	sprintf("%5s", $hd_5);
$hd10 =	sprintf("%5s", $hd10);
$hd15 =	sprintf("%5s", $hd15);
$hd20 =	sprintf("%5s", $hd20);
$hd25 =	sprintf("%5s", $hd25);
$hd30 =	sprintf("%5s", $hd30);
$hd35 =	sprintf("%5s", $hd35);
$hd40 =	sprintf("%5s", $hd40);
$hd45 =	sprintf("%5s", $hd45);
$hd50 =	sprintf("%5s", $hd50);
$hd55 =	sprintf("%5s", $hd55);
$hd60 =	sprintf("%5s", $hd60);
$hd90 =	sprintf("%5s", $hd90);
$hd99 =	sprintf("%5s", $hd99);

$TOTALcalls =		sprintf("%10s", $TOTALcalls);

echo "| $hd_0 $hd_5 $hd10 $hd15 $hd20 $hd25 $hd30 $hd35 $hd40 $hd45 $hd50 $hd55 $hd60 $hd90 $hd99 | $TOTALcalls |\n";
echo "+-------------------------------------------------------------------------------------------+------------+\n";



##############################
#########  CALL HANGUP REASON STATS

$TOTALcalls = 0;

echo "\n";
echo "---------- CALL HANGUP REASON STATS\n";
echo "+----------------------+------------+\n";
echo "| HANGUP REASON        | CALLS      |\n";
echo "+----------------------+------------+\n";

$stmt="select count(*),term_reason from vicidial_closer_log where call_date >= '$query_date_BEGIN' and call_date <= '$query_date_END' and  campaign_id='" . mysql_real_escape_string($group) . "' group by term_reason;";
$rslt=mysql_query($stmt, $link);
if ($DB) {echo "$stmt\n";}
$reasons_to_print = mysql_num_rows($rslt);
$i=0;
while ($i < $reasons_to_print)
	{
	$row=mysql_fetch_row($rslt);

	$TOTALcalls = ($TOTALcalls + $row[0]);

	$REASONcount =	sprintf("%10s", $row[0]);while(strlen($REASONcount)>10) {$REASONcount = substr("$REASONcount", 0, -1);}
	$reason =	sprintf("%-20s", $row[1]);while(strlen($reason)>20) {$reason = substr("$reason", 0, -1);}
#	if (ereg("NONE",$reason)) {$reason = 'NO ANSWER           ';}

	echo "| $reason | $REASONcount |\n";

	$i++;
	}

$TOTALcalls =		sprintf("%10s", $TOTALcalls);

echo "+----------------------+------------+\n";
echo "| TOTAL:               | $TOTALcalls |\n";
echo "+----------------------+------------+\n";




##############################
#########  CALL STATUS STATS

$TOTALcalls = 0;

echo "\n";
echo "---------- CALL STATUS STATS\n";
echo "+--------+----------------------+----------------------+------------+------------+----------+----------+\n";
echo "| STATUS | DESCRIZIONE          | CATEGORY             | CALLS      | TOTAL TIME | AVG TIME |CALLS/HOUR|\n";
echo "+--------+----------------------+----------------------+------------+------------+----------+----------+\n";


## get counts and time totals for all statuses in this campaign
$stmt="select count(*),status,sum(length_in_sec) from vicidial_closer_log where call_date >= '$query_date_BEGIN' and call_date <= '$query_date_END' and  campaign_id='" . mysql_real_escape_string($group) . "' group by status;";
$rslt=mysql_query($stmt, $link);
if ($DB) {echo "$stmt\n";}
$statuses_to_print = mysql_num_rows($rslt);
$i=0;
while ($i < $statuses_to_print)
	{
	$row=mysql_fetch_row($rslt);

	$STATUScount =	$row[0];
	$RAWstatus =	$row[1];
	$r=0;  $foundstat=0;
	while ($r < $statcats_to_print)
		{
		if ( ($statcat_list[$RAWstatus] == "$vsc_id[$r]") and ($foundstat < 1) )
			{
			$vsc_count[$r] = ($vsc_count[$r] + $STATUScount);
			}
		$r++;
		}

	$TOTALcalls =	($TOTALcalls + $row[0]);
	$STATUSrate =	($STATUScount / ($TOTALsec / 3600) );
		$STATUSrate =	sprintf("%.2f", $STATUSrate);

	$STATUShours_H =	($row[2] / 3600);
	$STATUShours_H_int = round($STATUShours_H, 2);
	$STATUShours_H_int = intval("$STATUShours_H_int");
	$STATUShours_M = ($STATUShours_H - $STATUShours_H_int);
	$STATUShours_M = ($STATUShours_M * 60);
	$STATUShours_M_int = round($STATUShours_M, 2);
	$STATUShours_M_int = intval("$STATUShours_M_int");
	$STATUShours_S = ($STATUShours_M - $STATUShours_M_int);
	$STATUShours_S = ($STATUShours_S * 60);
	$STATUShours_S = round($STATUShours_S, 0);
	if ($STATUShours_S < 10) {$STATUShours_S = "0$STATUShours_S";}
	if ($STATUShours_M_int < 10) {$STATUShours_M_int = "0$STATUShours_M_int";}
	$STATUShours = "$STATUShours_H_int:$STATUShours_M_int:$STATUShours_S";

	$STATUSavg_H =	(($row[2] / 3600) / $STATUScount);
	$STATUSavg_H_int = round($STATUSavg_H, 2);
	$STATUSavg_H_int = intval("$STATUSavg_H_int");
	$STATUSavg_M = ($STATUSavg_H - $STATUSavg_H_int);
	$STATUSavg_M = ($STATUSavg_M * 60);
	$STATUSavg_M_int = round($STATUSavg_M, 2);
	$STATUSavg_M_int = intval("$STATUSavg_M_int");
	$STATUSavg_S = ($STATUSavg_M - $STATUSavg_M_int);
	$STATUSavg_S = ($STATUSavg_S * 60);
	$STATUSavg_S = round($STATUSavg_S, 0);
	if ($STATUSavg_S < 10) {$STATUSavg_S = "0$STATUSavg_S";}
	if ($STATUSavg_M_int < 10) {$STATUSavg_M_int = "0$STATUSavg_M_int";}
	$STATUSavg = "$STATUSavg_H_int:$STATUSavg_M_int:$STATUSavg_S";

	$STATUScount =	sprintf("%10s", $row[0]);while(strlen($STATUScount)>10) {$STATUScount = substr("$STATUScount", 0, -1);}
	$status =	sprintf("%-6s", $row[1]);while(strlen($status)>6) {$status = substr("$status", 0, -1);}
	$STATUShours =	sprintf("%10s", $STATUShours);while(strlen($STATUShours)>10) {$STATUShours = substr("$STATUShours", 0, -1);}
	$STATUSavg =	sprintf("%8s", $STATUSavg);while(strlen($STATUSavg)>8) {$STATUSavg = substr("$STATUSavg", 0, -1);}
	$STATUSrate =	sprintf("%8s", $STATUSrate);while(strlen($STATUSrate)>8) {$STATUSrate = substr("$STATUSrate", 0, -1);}

	if ($non_latin < 1)
		{
		$status_name =	sprintf("%-20s", $statname_list[$RAWstatus]); 
		while(strlen($status_name)>20) {$status_name = substr("$status_name", 0, -1);}	
		$statcat =	sprintf("%-20s", $statcat_list[$RAWstatus]); 
		while(strlen($statcat)>20) {$statcat = substr("$statcat", 0, -1);}	
		}
	else
		{
		$status_name =	sprintf("%-60s", $statname_list[$RAWstatus]); 
		while(mb_strlen($status_name,'utf-8')>20) {$status_name = mb_substr("$status_name", 0, -1,'utf-8');}	
		$statcat =	sprintf("%-60s", $statcat_list[$RAWstatus]); 
		while(mb_strlen($statcat,'utf-8')>20) {$statcat = mb_substr("$statcat", 0, -1,'utf-8');}	
		}


	echo "| $status | $status_name | $statcat | $STATUScount | $STATUShours | $STATUSavg | $STATUSrate |\n";

	$i++;
	}

if ($TOTALcalls < 1)
	{
	$TOTALhours =	'0:00:00';
	$TOTALavg =		'0:00:00';
	$TOTALrate =	'0.00';
	}
else
	{
	$TOTALrate =	($TOTALcalls / ($TOTALsec / 3600) );
		$TOTALrate =	sprintf("%.2f", $TOTALrate);

	$TOTALhours_H =	($TOTALsec / 3600);
	$TOTALhours_H_int = round($TOTALhours_H, 2);
	$TOTALhours_H_int = intval("$TOTALhours_H_int");
	$TOTALhours_M = ($TOTALhours_H - $TOTALhours_H_int);
	$TOTALhours_M = ($TOTALhours_M * 60);
	$TOTALhours_M_int = round($TOTALhours_M, 2);
	$TOTALhours_M_int = intval("$TOTALhours_M_int");
	$TOTALhours_S = ($TOTALhours_M - $TOTALhours_M_int);
	$TOTALhours_S = ($TOTALhours_S * 60);
	$TOTALhours_S = round($TOTALhours_S, 0);
	if ($TOTALhours_S < 10) {$TOTALhours_S = "0$TOTALhours_S";}
	if ($TOTALhours_M_int < 10) {$TOTALhours_M_int = "0$TOTALhours_M_int";}
	$TOTALhours = "$TOTALhours_H_int:$TOTALhours_M_int:$TOTALhours_S";

	$TOTALavg_H =	(($TOTALsec / 3600) / $TOTALcalls);
	$TOTALavg_H_int = round($TOTALavg_H, 2);
	$TOTALavg_H_int = intval("$TOTALavg_H_int");
	$TOTALavg_M = ($TOTALavg_H - $TOTALavg_H_int);
	$TOTALavg_M = ($TOTALavg_M * 60);
	$TOTALavg_M_int = round($TOTALavg_M, 2);
	$TOTALavg_M_int = intval("$TOTALavg_M_int");
	$TOTALavg_S = ($TOTALavg_M - $TOTALavg_M_int);
	$TOTALavg_S = ($TOTALavg_S * 60);
	$TOTALavg_S = round($TOTALavg_S, 0);
	if ($TOTALavg_S < 10) {$TOTALavg_S = "0$TOTALavg_S";}
	if ($TOTALavg_M_int < 10) {$TOTALavg_M_int = "0$TOTALavg_M_int";}
	$TOTALavg = "$TOTALavg_H_int:$TOTALavg_M_int:$TOTALavg_S";
	}
$TOTALcalls =	sprintf("%10s", $TOTALcalls);
$TOTALhours =	sprintf("%10s", $TOTALhours);while(strlen($TOTALhours)>10) {$TOTALhours = substr("$TOTALhours", 0, -1);}
$TOTALavg =	sprintf("%8s", $TOTALavg);while(strlen($TOTALavg)>8) {$TOTALavg = substr("$TOTALavg", 0, -1);}
$TOTALrate =	sprintf("%8s", $TOTALrate);while(strlen($TOTALrate)>8) {$TOTALrate = substr("$TOTALrate", 0, -1);}

echo "+--------+----------------------+----------------------+------------+------------+----------+----------+\n";
echo "| TOTAL:                                               | $TOTALcalls | $TOTALhours | $TOTALavg | $TOTALrate |\n";
echo "+------------------------------------------------------+------------+------------+----------+----------+\n";


##############################
#########  STATUS CATEGORY STATS

echo "\n";
echo "---------- CUSTOM STATUS CATEGORY STATS\n";
echo "+----------------------+------------+--------------------------------+\n";
echo "| CATEGORY             | CALLS      | DESCRIZIONE                    |\n";
echo "+----------------------+------------+--------------------------------+\n";

$TOTCATcalls=0;
$r=0;
while ($r < $statcats_to_print)
	{
	if ($vsc_id[$r] != 'UNDEFINED')
		{
		$TOTCATcalls = ($TOTCATcalls + $vsc_count[$r]);
		$category =	sprintf("%-20s", $vsc_id[$r]); while(strlen($category)>20) {$category = substr("$category", 0, -1);}
		$CATcount =	sprintf("%10s", $vsc_count[$r]); while(strlen($CATcount)>10) {$CATcount = substr("$CATcount", 0, -1);}
		$CATname =	sprintf("%-30s", $vsc_name[$r]); while(strlen($CATname)>30) {$CATname = substr("$CATname", 0, -1);}

		echo "| $category | $CATcount | $CATname |\n";
		}

	$r++;
	}

$TOTCATcalls =	sprintf("%10s", $TOTCATcalls); while(strlen($TOTCATcalls)>10) {$TOTCATcalls = substr("$TOTCATcalls", 0, -1);}

echo "+----------------------+------------+--------------------------------+\n";
echo "| TOTAL                | $TOTCATcalls |\n";
echo "+----------------------+------------+\n";


##############################
#########  USER STATS

$TOTagents=0;
$TOTcalls=0;
$TOTtime=0;
$TOTavg=0;

echo "\n";
echo "---------- STATISTICHE OPERATORE\n";
echo "+--------------------------+------------+----------+--------+\n";
echo "| AGENT                    | CALLS      | TEMPO M   | MEDIA M |\n";
echo "+--------------------------+------------+----------+--------+\n";

$stmt="select vicidial_closer_log.user,full_name,count(*),sum(length_in_sec),avg(length_in_sec) from vicidial_closer_log,vicidial_users where call_date >= '$query_date_BEGIN' and call_date <= '$query_date_END' and  campaign_id='" . mysql_real_escape_string($group) . "' and vicidial_closer_log.user is not null and length_in_sec is not null and length_in_sec > 0 and vicidial_closer_log.user=vicidial_users.user group by vicidial_closer_log.user;";
$rslt=mysql_query($stmt, $link);
if ($DB) {echo "$stmt\n";}
$users_to_print = mysql_num_rows($rslt);
$i=0;
while ($i < $users_to_print)
	{
	$row=mysql_fetch_row($rslt);

	$TOTcalls = ($TOTcalls + $row[2]);
	$TOTtime = ($TOTtime + $row[3]);

	$user =			sprintf("%-6s", $row[0]);
	$full_name =	sprintf("%-15s", $row[1]); while(strlen($full_name)>15) {$full_name = substr("$full_name", 0, -1);}
	$USERcalls =	sprintf("%10s", $row[2]);
	$USERtotTALK =	$row[3];
	$USERavgTALK =	$row[4];

	$USERtotTALK_M = ($USERtotTALK / 60);
	$USERtotTALK_M_int = round($USERtotTALK_M, 2);
	$USERtotTALK_M_int = intval("$USERtotTALK_M_int");
	$USERtotTALK_S = ($USERtotTALK_M - $USERtotTALK_M_int);
	$USERtotTALK_S = ($USERtotTALK_S * 60);
	$USERtotTALK_S = round($USERtotTALK_S, 0);
	if ($USERtotTALK_S < 10) {$USERtotTALK_S = "0$USERtotTALK_S";}
	$USERtotTALK_MS = "$USERtotTALK_M_int:$USERtotTALK_S";
	$USERtotTALK_MS =		sprintf("%8s", $USERtotTALK_MS);

	$USERavgTALK_M = ($USERavgTALK / 60);
	$USERavgTALK_M_int = round($USERavgTALK_M, 2);
	$USERavgTALK_M_int = intval("$USERavgTALK_M_int");
	$USERavgTALK_S = ($USERavgTALK_M - $USERavgTALK_M_int);
	$USERavgTALK_S = ($USERavgTALK_S * 60);
	$USERavgTALK_S = round($USERavgTALK_S, 0);
	if ($USERavgTALK_S < 10) {$USERavgTALK_S = "0$USERavgTALK_S";}
	$USERavgTALK_MS = "$USERavgTALK_M_int:$USERavgTALK_S";
	$USERavgTALK_MS =		sprintf("%6s", $USERavgTALK_MS);

	echo "| $user - $full_name | $USERcalls | $USERtotTALK_MS | $USERavgTALK_MS |\n";

	$i++;
	}

if (!$TOTcalls) {$TOTcalls = 1;}
$TOTavg = ($TOTtime / $TOTcalls);
$TOTavg = round($TOTavg, 0);
$TOTavg_M = ($TOTavg / 60);
$TOTavg_M_int = round($TOTavg_M, 2);
$TOTavg_M_int = intval("$TOTavg_M_int");
$TOTavg_S = ($TOTavg_M - $TOTavg_M_int);
$TOTavg_S = ($TOTavg_S * 60);
$TOTavg_S = round($TOTavg_S, 0);
if ($TOTavg_S < 10) {$TOTavg_S = "0$TOTavg_S";}
$TOTavg_MS = "$TOTavg_M_int:$TOTavg_S";
$TOTavg =		sprintf("%6s", $TOTavg_MS);

$TOTtime_M = ($TOTtime / 60);
$TOTtime_M_int = round($TOTtime_M, 2);
$TOTtime_M_int = intval("$TOTtime_M_int");
$TOTtime_S = ($TOTtime_M - $TOTtime_M_int);
$TOTtime_S = ($TOTtime_S * 60);
$TOTtime_S = round($TOTtime_S, 0);
if ($TOTtime_S < 10) {$TOTtime_S = "0$TOTtime_S";}
$TOTtime_MS = "$TOTtime_M_int:$TOTtime_S";
$TOTtime =		sprintf("%6s", $TOTtime_MS);

$TOTagents =		sprintf("%10s", $i);
$TOTcalls =			sprintf("%10s", $TOTcalls);
$TOTtime =			sprintf("%8s", $TOTtime);
$TOTavg =			sprintf("%6s", $TOTavg);

echo "+--------------------------+------------+----------+--------+\n";
echo "| TOTALE Operatori: $TOTagents | $TOTcalls | $TOTtime | $TOTavg |\n";
echo "+--------------------------+------------+----------+--------+\n";


##############################
#########  TIME STATS

echo "\n";
echo "---------- STATISTICHE TEMPO\n";

echo "<FONT SIZE=0>\n";

$hi_hour_count=0;
$last_full_record=0;
$i=0;
$h=0;
while ($i <= 96)
	{
	$stmt="select count(*) from vicidial_closer_log where call_date >= '$query_date $h:00:00' and call_date <= '$query_date $h:14:59' and campaign_id='" . mysql_real_escape_string($group) . "';";
	$rslt=mysql_query($stmt, $link);
	if ($DB) {echo "$stmt\n";}
	$row=mysql_fetch_row($rslt);
	$hour_count[$i] = $row[0];
	if ($hour_count[$i] > $hi_hour_count) {$hi_hour_count = $hour_count[$i];}
	if ($hour_count[$i] > 0) {$last_full_record = $i;}
	$stmt="select count(*) from vicidial_closer_log where call_date >= '$query_date $h:00:00' and call_date <= '$query_date $h:14:59' and campaign_id='" . mysql_real_escape_string($group) . "' and status='DROP';";
	$rslt=mysql_query($stmt, $link);
	if ($DB) {echo "$stmt\n";}
	$row=mysql_fetch_row($rslt);
	$drop_count[$i] = $row[0];
	$i++;


	$stmt="select count(*) from vicidial_closer_log where call_date >= '$query_date $h:15:00' and call_date <= '$query_date $h:29:59' and campaign_id='$group';";
	$rslt=mysql_query($stmt, $link);
	if ($DB) {echo "$stmt\n";}
	$row=mysql_fetch_row($rslt);
	$hour_count[$i] = $row[0];
	if ($hour_count[$i] > $hi_hour_count) {$hi_hour_count = $hour_count[$i];}
	if ($hour_count[$i] > 0) {$last_full_record = $i;}
	$stmt="select count(*) from vicidial_closer_log where call_date >= '$query_date $h:15:00' and call_date <= '$query_date $h:29:59' and campaign_id='" . mysql_real_escape_string($group) . "' and status='DROP';";
	$rslt=mysql_query($stmt, $link);
	if ($DB) {echo "$stmt\n";}
	$row=mysql_fetch_row($rslt);
	$drop_count[$i] = $row[0];
	$i++;

	$stmt="select count(*) from vicidial_closer_log where call_date >= '$query_date $h:30:00' and call_date <= '$query_date $h:44:59' and campaign_id='" . mysql_real_escape_string($group) . "';";
	$rslt=mysql_query($stmt, $link);
	if ($DB) {echo "$stmt\n";}
	$row=mysql_fetch_row($rslt);
	$hour_count[$i] = $row[0];
	if ($hour_count[$i] > $hi_hour_count) {$hi_hour_count = $hour_count[$i];}
	if ($hour_count[$i] > 0) {$last_full_record = $i;}
	$stmt="select count(*) from vicidial_closer_log where call_date >= '$query_date $h:30:00' and call_date <= '$query_date $h:44:59' and campaign_id='" . mysql_real_escape_string($group) . "' and status='DROP';";
	$rslt=mysql_query($stmt, $link);
	if ($DB) {echo "$stmt\n";}
	$row=mysql_fetch_row($rslt);
	$drop_count[$i] = $row[0];
	$i++;

	$stmt="select count(*) from vicidial_closer_log where call_date >= '$query_date $h:45:00' and call_date <= '$query_date $h:59:59' and campaign_id='" . mysql_real_escape_string($group) . "';";
	$rslt=mysql_query($stmt, $link);
	if ($DB) {echo "$stmt\n";}
	$row=mysql_fetch_row($rslt);
	$hour_count[$i] = $row[0];
	if ($hour_count[$i] > $hi_hour_count) {$hi_hour_count = $hour_count[$i];}
	if ($hour_count[$i] > 0) {$last_full_record = $i;}
	$stmt="select count(*) from vicidial_closer_log where call_date >= '$query_date $h:45:00' and call_date <= '$query_date $h:59:59' and campaign_id='" . mysql_real_escape_string($group) . "' and status='DROP';";
	$rslt=mysql_query($stmt, $link);
	if ($DB) {echo "$stmt\n";}
	$row=mysql_fetch_row($rslt);
	$drop_count[$i] = $row[0];
	$i++;
	$h++;
	}

if ($hi_hour_count < 1)
	{$hour_multiplier = 0;}
else
	{
	$hour_multiplier = (100 / $hi_hour_count);
	#$hour_multiplier = round($hour_multiplier, 0);
	}

echo "<!-- HICOUNT: $hi_hour_count|$hour_multiplier -->\n";
echo "GRAFICO AD INCREMENTO DI 15 MINUTI DEL TOTALE DELLE CHIAMATE TAKEN INTO THIS IN-GROUP\n";

$k=1;
$Mk=0;
$call_scale = '0';
while ($k <= 102) 
	{
	if ($Mk >= 5) 
		{
		$Mk=0;
		if ( ($k < 1) or ($hour_multiplier <= 0) )
			{$scale_num = 100;}
		else
			{
			$scale_num=($k / $hour_multiplier);
			$scale_num = round($scale_num, 0);
			}
		$LENscale_num = (strlen($scale_num));
		$k = ($k + $LENscale_num);
		$call_scale .= "$scale_num";
		}
	else
		{
		$call_scale .= " ";
		$k++;   $Mk++;
		}
	}


echo "+------+-------------------------------------------------------------------------------------------------------+-------+-------+\n";
#echo "| HOUR | GRAPH IN 15 MINUTE INCREMENTS OF TOTAL INCOMING CALLS FOR THIS GROUP                                  | DROPS | TOTAL |\n";
echo "| HOUR |$call_scale| DROPS | TOTAL |\n";
echo "+------+-------------------------------------------------------------------------------------------------------+-------+-------+\n";

$ZZ = '00';
$i=0;
$h=4;
$hour= -1;
$no_lines_yet=1;

while ($i <= 96)
	{
	$char_counter=0;
	$time = '      ';
	if ($h >= 4) 
		{
		$hour++;
		$h=0;
		if ($hour < 10) {$hour = "0$hour";}
		$time = "+$hour$ZZ+";
		}
	if ($h == 1) {$time = "   15 ";}
	if ($h == 2) {$time = "   30 ";}
	if ($h == 3) {$time = "   45 ";}
	$Ghour_count = $hour_count[$i];
	if ($Ghour_count < 1) 
		{
		if ( ($no_lines_yet) or ($i > $last_full_record) )
			{
			$do_nothing=1;
			}
		else
			{
			$hour_count[$i] =	sprintf("%-5s", $hour_count[$i]);
			echo "|$time|";
			$k=0;   while ($k <= 102) {echo " ";   $k++;}
			echo "| $hour_count[$i] |\n";
			}
		}
	else
		{
		$no_lines_yet=0;
		$Xhour_count = ($Ghour_count * $hour_multiplier);
		$Yhour_count = (99 - $Xhour_count);

		$Gdrop_count = $drop_count[$i];
		if ($Gdrop_count < 1) 
			{
			$hour_count[$i] =	sprintf("%-5s", $hour_count[$i]);

			echo "|$time|<SPAN class=\"green\">";
			$k=0;   while ($k <= $Xhour_count) {echo "*";   $k++;   $char_counter++;}
			echo "*X</SPAN>";   $char_counter++;
			$k=0;   while ($k <= $Yhour_count) {echo " ";   $k++;   $char_counter++;}
				while ($char_counter <= 101) {echo " ";   $char_counter++;}
			echo "| 0     | $hour_count[$i] |\n";

			}
		else
			{
			$Xdrop_count = ($Gdrop_count * $hour_multiplier);

		#	if ($Xdrop_count >= $Xhour_count) {$Xdrop_count = ($Xdrop_count - 1);}

			$XXhour_count = ( ($Xhour_count - $Xdrop_count) - 1 );

			$hour_count[$i] =	sprintf("%-5s", $hour_count[$i]);
			$drop_count[$i] =	sprintf("%-5s", $drop_count[$i]);

			echo "|$time|<SPAN class=\"red\">";
			$k=0;   while ($k <= $Xdrop_count) {echo ">";   $k++;   $char_counter++;}
			echo "D</SPAN><SPAN class=\"green\">";   $char_counter++;
			$k=0;   while ($k <= $XXhour_count) {echo "*";   $k++;   $char_counter++;}
			echo "X</SPAN>";   $char_counter++;
			$k=0;   while ($k <= $Yhour_count) {echo " ";   $k++;   $char_counter++;}
				while ($char_counter <= 102) {echo " ";   $char_counter++;}
			echo "| $drop_count[$i] | $hour_count[$i] |\n";
			}
		}
	
	
	$i++;
	$h++;
	}


echo "+------+-------------------------------------------------------------------------------------------------------+-------+-------+\n\n";





$ENDtime = date("U");
$RUNtime = ($ENDtime - $STARTtime);
echo "\nRun Time: $RUNtime seconds\n";
}



?>
</PRE>

</BODY></HTML>