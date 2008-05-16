<? 
# AST_CLOSER_service_level.php
# 
# Copyright (C) 2008  Matt Florell <vicidial@gmail.com>    LICENSE: AGPLv2
#
# CHANGES
#
# 80509-0943 - First build
# 80510-1500 - Added fixed scale hold time graph
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
if (isset($_GET["SUBMIT"]))				{$SUBMIT=$_GET["SUBMIT"];}
	elseif (isset($_POST["SUBMIT"]))		{$SUBMIT=$_POST["SUBMIT"];}

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
    echo "Invalid Username/Password: |$PHP_AUTH_USER|$PHP_AUTH_PW|\n";
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
?>

<HTML>
<HEAD>
<STYLE type="text/css">
<!--
   .green {color: black; background-color: #99FF99}
   .red {color: black; background-color: #FF9999}
   .orange {color: black; background-color: #FFCC99}
-->
 </STYLE>

<? 
echo "<META HTTP-EQUIV=\"Content-Type\" CONTENT=\"text/html; charset=utf-8\">\n";
echo "<TITLE>VICIDIAL: VDAD Closer Service Level Stats</TITLE></HEAD><BODY BGCOLOR=WHITE>\n";
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
echo "<INPUT TYPE=submit NAME=SUBMIT VALUE=SUBMIT>\n";
echo "<FONT FACE=\"ARIAL,HELVETICA\" COLOR=BLACK SIZE=2> &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; <a href=\"./admin.php?ADD=3111&group_id=$group\">MODIFY</a> | <a href=\"./admin.php?ADD=999999\">REPORTS</a> </FONT>\n";
echo "</FORM>\n\n";

echo "<PRE><FONT SIZE=2>\n\n";


if (!$group)
{
echo "\n\n";
echo "PLEASE SELECT AN IN-GROUP AND DATE RANGE ABOVE AND CLICK SUBMIT\n";
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



echo "VICIDIAL: Closer Service-Level Stats                      $NOW_TIME\n";

echo "\n";
echo "Time range: $query_date_BEGIN to $query_date_END\n\n";
echo "---------- TOTALS\n";

$stmt="select count(*),sum(length_in_sec) from vicidial_closer_log where call_date >= '$query_date_BEGIN' and call_date <= '$query_date_END' and campaign_id='" . mysql_real_escape_string($group) . "';";
$rslt=mysql_query($stmt, $link);
if ($DB) {echo "$stmt\n";}
$row=mysql_fetch_row($rslt);

$TOTALcalls =	sprintf("%10s", $row[0]);
if ( ($row[0] < 1) or ($row[1] < 1) )
	{$average_call_seconds = '         0';}
else
	{
	$average_call_seconds = ($row[1] / $row[0]);
	$average_call_seconds = round($average_call_seconds, 0);
	$average_call_seconds =	sprintf("%10s", $average_call_seconds);
	}

echo "Total calls taken into this In-Group:  $TOTALcalls\n";
echo "Average Call Length for all Calls:     $average_call_seconds seconds\n";

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

echo "Total DROP Calls:                      $DROPcalls  $DROPpercent%\n";
echo "Average hold time for DROP Calls:      $average_hold_seconds seconds\n";




##############################
#########  CALL QUEUE STATS

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

echo "Total Calls That entered Queue:        $QUEUEcalls  $QUEUEpercent%\n";
echo "Average QUEUE Length for queue calls:  $average_queue_seconds seconds\n";
echo "Average QUEUE Length across all calls: $average_total_queue_seconds seconds\n";



##############################
#########  HOLD TIME, CALL AND DROP STATS

echo "\n";
echo "---------- HOLD TIME, CALL AND DROP STATS\n";

echo "<FONT SIZE=0>";

$hi_hour_count=0;
$hi_hold_count=0;
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
	$stmt="select avg(queue_seconds) from vicidial_closer_log where call_date >= '$query_date $h:00:00' and call_date <= '$query_date $h:14:59' and campaign_id='" . mysql_real_escape_string($group) . "';";
	$rslt=mysql_query($stmt, $link);
	if ($DB) {echo "$stmt\n";}
	$row=mysql_fetch_row($rslt);
	$avg_hold[$i] = $row[0];
	if ($avg_hold[$i] > $hi_hold_count) {$hi_hold_count = $avg_hold[$i];}
	$avg_hold[$i] = round($avg_hold[$i], 0);
	if (strlen($avg_hold[$i])<1) {$avg_hold[$i]=0; $max_hold[$i]=0;}
	$stmt="select max(queue_seconds) from vicidial_closer_log where call_date >= '$query_date $h:00:00' and call_date <= '$query_date $h:14:59' and campaign_id='" . mysql_real_escape_string($group) . "';";
	$rslt=mysql_query($stmt, $link);
	if ($DB) {echo "$stmt\n";}
	$row=mysql_fetch_row($rslt);
	$max_hold[$i] = $row[0];
	$max_hold[$i] = round($max_hold[$i], 0);
	if (strlen($max_hold[$i])<1) {$max_hold[$i]=0;}
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
	$stmt="select avg(queue_seconds) from vicidial_closer_log where call_date >= '$query_date $h:15:00' and call_date <= '$query_date $h:29:59' and campaign_id='" . mysql_real_escape_string($group) . "';";
	$rslt=mysql_query($stmt, $link);
	if ($DB) {echo "$stmt\n";}
	$row=mysql_fetch_row($rslt);
	$avg_hold[$i] = $row[0];
	if ($avg_hold[$i] > $hi_hold_count) {$hi_hold_count = $avg_hold[$i];}
	$avg_hold[$i] = round($avg_hold[$i], 0);
	if (strlen($avg_hold[$i])<1) {$avg_hold[$i]=0; $max_hold[$i]=0;}
	$stmt="select max(queue_seconds) from vicidial_closer_log where call_date >= '$query_date $h:15:00' and call_date <= '$query_date $h:29:59' and campaign_id='" . mysql_real_escape_string($group) . "';";
	$rslt=mysql_query($stmt, $link);
	if ($DB) {echo "$stmt\n";}
	$row=mysql_fetch_row($rslt);
	$max_hold[$i] = $row[0];
	$max_hold[$i] = round($max_hold[$i], 0);
	if (strlen($max_hold[$i])<1) {$max_hold[$i]=0;}
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
	$stmt="select avg(queue_seconds) from vicidial_closer_log where call_date >= '$query_date $h:30:00' and call_date <= '$query_date $h:44:59' and campaign_id='" . mysql_real_escape_string($group) . "';";
	$rslt=mysql_query($stmt, $link);
	if ($DB) {echo "$stmt\n";}
	$row=mysql_fetch_row($rslt);
	$avg_hold[$i] = $row[0];
	if ($avg_hold[$i] > $hi_hold_count) {$hi_hold_count = $avg_hold[$i];}
	$avg_hold[$i] = round($avg_hold[$i], 0);
	if (strlen($avg_hold[$i])<1) {$avg_hold[$i]=0; $max_hold[$i]=0;}
	$stmt="select max(queue_seconds) from vicidial_closer_log where call_date >= '$query_date $h:30:00' and call_date <= '$query_date $h:44:59' and campaign_id='" . mysql_real_escape_string($group) . "';";
	$rslt=mysql_query($stmt, $link);
	if ($DB) {echo "$stmt\n";}
	$row=mysql_fetch_row($rslt);
	$max_hold[$i] = $row[0];
	$max_hold[$i] = round($max_hold[$i], 0);
	if (strlen($max_hold[$i])<1) {$max_hold[$i]=0;}
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
	$stmt="select avg(queue_seconds) from vicidial_closer_log where call_date >= '$query_date $h:45:00' and call_date <= '$query_date $h:59:59' and campaign_id='" . mysql_real_escape_string($group) . "';";
	$rslt=mysql_query($stmt, $link);
	if ($DB) {echo "$stmt\n";}
	$row=mysql_fetch_row($rslt);
	$avg_hold[$i] = $row[0];
	if ($avg_hold[$i] > $hi_hold_count) {$hi_hold_count = $avg_hold[$i];}
	$avg_hold[$i] = round($avg_hold[$i], 0);
	if (strlen($avg_hold[$i])<1) {$avg_hold[$i]=0; $max_hold[$i]=0;}
	$stmt="select max(queue_seconds) from vicidial_closer_log where call_date >= '$query_date $h:45:00' and call_date <= '$query_date $h:59:59' and campaign_id='" . mysql_real_escape_string($group) . "';";
	$rslt=mysql_query($stmt, $link);
	if ($DB) {echo "$stmt\n";}
	$row=mysql_fetch_row($rslt);
	$max_hold[$i] = $row[0];
	$max_hold[$i] = round($max_hold[$i], 0);
	if (strlen($max_hold[$i])<1) {$max_hold[$i]=0;}
	$i++;
	$h++;
	}

if ($hi_hour_count < 1)
	{$hour_multiplier = 0;}
else
	{
	$hour_multiplier = (20 / $hi_hour_count);
	#$hour_multiplier = round($hour_multiplier, 0);
	}
if ($hi_hold_count < 1)
	{$hold_multiplier = 0;}
else
	{
	$hold_multiplier = (20 / $hi_hold_count);
	#$hold_multiplier = round($hold_multiplier, 0);
	}

echo "<!-- HICOUNT CALLS: $hi_hour_count|$hour_multiplier -->";
echo "<!-- HICOUNT HOLD:  $hi_hold_count|$hold_multiplier -->\n";
echo "GRAPH IN 15 MINUTE INCREMENTS OF AVERAGE HOLD TIME FOR CALLS TAKEN INTO THIS IN-GROUP\n";

$k=1;
$Mk=0;
$call_scale = '0';
while ($k <= 22) 
	{
	if ( ($k < 1) or ($hour_multiplier <= 0) )
		{$scale_num = 20;}
	else
		{
		$TMPscale_num=(23 / $hour_multiplier);
		$TMPscale_num = round($TMPscale_num, 0);
		$scale_num=($k / $hour_multiplier);
		$scale_num = round($scale_num, 0);
		}
	$tmpscl = "$call_scale$TMPscale_num";

	if ( ($Mk >= 4) or (strlen($tmpscl)==23) )
		{
		$Mk=0;
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
$k=1;
$Mk=0;
$hold_scale = '0';
while ($k <= 22) 
	{
	if ( ($k < 1) or ($hold_multiplier <= 0) )
		{$scale_num = 20;}
	else
		{
		$TMPscale_num=(23 / $hold_multiplier);
		$TMPscale_num = round($TMPscale_num, 0);
		$scale_num=($k / $hold_multiplier);
		$scale_num = round($scale_num, 0);
		}
	$tmpscl = "$hold_scale$TMPscale_num";

	if ( ($Mk >= 4) or (strlen($tmpscl)==23) )
		{
		$Mk=0;
		$LENscale_num = (strlen($scale_num));
		$k = ($k + $LENscale_num);
		$hold_scale .= "$scale_num";
		}
	else
		{
		$hold_scale .= " ";
		$k++;   $Mk++;
		}
	}


echo "+-------------+-----------------------+-------+-------+  +-----------------------+-------+-------+\n";
echo "|    TIME     |  AVG HOLD TIME (sec)  | (in seconds)  |  |    CALLS HANDLED      |       |       |\n";
echo "| 15 MIN INT  |$hold_scale| AVG   | MAX   |  |$call_scale| DROPS | TOTAL |\n";
echo "+-------------+-----------------------+-------+-------+  +-----------------------+-------+-------+\n";

$YY = '00';
$ZZ = '15';
$i=0;
$h=4;
$hour= -1;
$no_lines_yet=1;
$TOT_AVG=0;
  $TOT_lines=0;
$TOT_MAX=0;
$TOT_DROPS=0;
$TOT_CALLS=0;

while ($i <= 96)
	{

	$TOT_AVG = ($TOT_AVG + $avg_hold[$i]);
	if ($TOT_MAX < $max_hold[$i]) {$TOT_MAX = $max_hold[$i];}
	$TOT_DROPS = ($TOT_DROPS + $drop_count[$i]);
	$TOT_CALLS = ($TOT_CALLS + $hour_count[$i]);

	$char_counter=0;
	$time = '      ';
	if ($h >= 4) 
		{
		$hour++;
		$h=0;
		if ($hour < 10) {$hour = "0$hour";}
		$Stime="$hour:$YY";
		$Etime="$hour:$ZZ";
		$Sdate="$query_date";
		$Edate="$query_date";
		$time = "+$Stime-$Etime+";
		}
	if ($h == 1) 
		{
		$Stime="$hour:15";
		$Etime="$hour:30";
		$Sdate="$query_date";
		$Edate="$query_date";
		$time = " $Stime-$Etime ";
		}
	if ($h == 2)
		{
		$Stime="$hour:30";
		$Etime="$hour:45";
		$Sdate="$query_date";
		$Edate="$query_date";
		$time = " $Stime-$Etime ";
		}
	if ($h == 3) 
		{
		$Zhour=$hour;
		$Zhour++;
		if ($Zhour < 10) {$Zhour = "0$Zhour";}
		if ($Zhour > 23) {$Zhour = "00";}
		$Stime="$hour:45";
		$Etime="$Zhour:00";
		$Sdate="$query_date";
		$Edate="$query_date";
		$time = " $Stime-$Etime ";
		}

	### BEGIN HOLD TIME TOTALS GRAPH ###
		$Ghour_count = $hour_count[$i];
	if ($Ghour_count > 0) {$no_lines_yet=0;}

	$Gavg_hold = $avg_hold[$i];
	if ($Gavg_hold < 1) 
		{
		if ( ($no_lines_yet) or ($i > $last_full_record) )
			{
			$do_nothing=1;
			}
		else
			{
			$SAtime[$TOT_lines] = "$Stime";
			$EAtime[$TOT_lines] = "$Etime";
			$SAdate[$TOT_lines] = "$Sdate $Stime:00";
			$EAdate[$TOT_lines] = "$Edate $Etime:00";
			$Aavg_hold[$TOT_lines] = $avg_hold[$i];
			$TOT_lines++;
			$avg_hold[$i] =	sprintf("%5s", $avg_hold[$i]);
			$max_hold[$i] =	sprintf("%5s", $max_hold[$i]);
			echo "|$time|";
			$k=0;   while ($k <= 22) {echo " ";   $k++;}
			echo "| $avg_hold[$i] | $max_hold[$i] |";
			}
		}
	else
		{
		$SAtime[$TOT_lines] = "$Stime";
		$EAtime[$TOT_lines] = "$Etime";
		$SAdate[$TOT_lines] = "$Sdate $Stime:00";
		$EAdate[$TOT_lines] = "$Edate $Etime:00";
		$Aavg_hold[$TOT_lines] = $avg_hold[$i];
		$TOT_lines++;
		$no_lines_yet=0;
		$Xavg_hold = ($Gavg_hold * $hold_multiplier);
		$Yavg_hold = (19 - $Xavg_hold);

		$avg_hold[$i] =	sprintf("%5s", $avg_hold[$i]);
		$max_hold[$i] =	sprintf("%5s", $max_hold[$i]);

		echo "|$time|<SPAN class=\"orange\">";
		$k=0;   while ($k <= $Xavg_hold) {echo "*";   $k++;   $char_counter++;}
		if ($char_counter >= 22) {echo "H</SPAN>";   $char_counter++;}
		else {echo "*H</SPAN>";   $char_counter++;   $char_counter++;}
		$k=0;   while ($k <= $Yavg_hold) {echo " ";   $k++;   $char_counter++;}
			while ($char_counter <= 22) {echo " ";   $char_counter++;}
		echo "| $avg_hold[$i] | $max_hold[$i] |";
		}
	### END HOLD TIME TOTALS GRAPH ###

	$char_counter=0;
 	### BEGIN CALLS TOTALS GRAPH ###
	$Ghour_count = $hour_count[$i];
	if ($Ghour_count < 1) 
		{
		if ( ($no_lines_yet) or ($i > $last_full_record) )
			{
			$do_nothing=1;
			}
		else
			{
			$hour_count[$i] =	sprintf("%5s", $hour_count[$i]);
			echo "  |";
			$k=0;   while ($k <= 22) {echo " ";   $k++;}
			echo "| $hour_count[$i] |       |\n";
			}
		}
	else
		{
		$no_lines_yet=0;
		$Xhour_count = ($Ghour_count * $hour_multiplier);
		$Yhour_count = (19 - $Xhour_count);

		$Gdrop_count = $drop_count[$i];
		if ($Gdrop_count < 1) 
			{
			$hour_count[$i] =	sprintf("%5s", $hour_count[$i]);

			echo "  |<SPAN class=\"green\">";
			$k=0;   while ($k <= $Xhour_count) {echo "*";   $k++;   $char_counter++;}
			if ($char_counter > 21) {echo "C</SPAN>";   $char_counter++;}
			else {echo "*C</SPAN>";   $char_counter++;   $char_counter++;}
			$k=0;   while ($k <= $Yhour_count) {echo " ";   $k++;   $char_counter++;}
				while ($char_counter <= 22) {echo " ";   $char_counter++;}
			echo "|     0 | $hour_count[$i] |\n";
			}
		else
			{
			$Xdrop_count = ($Gdrop_count * $hour_multiplier);

		#	if ($Xdrop_count >= $Xhour_count) {$Xdrop_count = ($Xdrop_count - 1);}

			$XXhour_count = ( ($Xhour_count - $Xdrop_count) - 1 );

			$hour_count[$i] =	sprintf("%5s", $hour_count[$i]);
			$drop_count[$i] =	sprintf("%5s", $drop_count[$i]);

			echo "  |<SPAN class=\"red\">";
			$k=0;   while ($k <= $Xdrop_count) {echo ">";   $k++;   $char_counter++;}
			echo "D</SPAN><SPAN class=\"green\">";   $char_counter++;
			$k=0;   while ($k <= $XXhour_count) {echo "*";   $k++;   $char_counter++;}
			echo "C</SPAN>";   $char_counter++;
			$k=0;   while ($k <= $Yhour_count) {echo " ";   $k++;   $char_counter++;}
				while ($char_counter <= 22) {echo " ";   $char_counter++;}
			echo "| $drop_count[$i] | $hour_count[$i] |\n";
			}
		}
	### END CALLS TOTALS GRAPH ###
	
	$i++;
	$h++;
	}

	$TOT_AVGraw = ($TOT_AVG / $TOT_lines);

	$TOT_AVG =	sprintf("%5s", $TOT_AVGraw); 
		while (strlen($TOT_AVG)>5) {$TOT_AVG = ereg_replace(".$",'',$TOT_AVG);}
	$TOT_MAX =	sprintf("%5s", $TOT_MAX);
	$TOT_DROPS =	sprintf("%5s", $TOT_DROPS);
	$TOT_CALLS =	sprintf("%5s", $TOT_CALLS);


echo "+-------------+-----------------------+-------+-------+  +-----------------------+-------+-------+\n";
echo "| TOTAL                               | $TOT_AVG | $TOT_MAX |  |                       | $TOT_DROPS | $TOT_CALLS |\n";
echo "+-------------------------------------+-------+-------+  +-----------------------+-------+-------+\n";




##############################
#########  CALL HOLD TIME BREAKDONW IN SECONDS


echo "\n";
echo "---------- CALL HOLD TIME BREAKDOWN IN SECONDS\n";
/*
$TOTALcalls = 0;
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
	if ( ($row[1] > 0) and ($row[1] <= 5) ) {$hd_5 = ($hd_5 + $row[0]);}
	if ( ($row[1] > 5) and ($row[1] <= 10) ) {$hd10 = ($hd10 + $row[0]);}
	if ( ($row[1] > 10) and ($row[1] <= 15) ) {$hd15 = ($hd15 + $row[0]);}
	if ( ($row[1] > 15) and ($row[1] <= 20) ) {$hd20 = ($hd20 + $row[0]);}
	if ( ($row[1] > 20) and ($row[1] <= 25) ) {$hd25 = ($hd25 + $row[0]);}
	if ( ($row[1] > 25) and ($row[1] <= 30) ) {$hd30 = ($hd30 + $row[0]);}
	if ( ($row[1] > 30) and ($row[1] <= 35) ) {$hd35 = ($hd35 + $row[0]);}
	if ( ($row[1] > 35) and ($row[1] <= 40) ) {$hd40 = ($hd40 + $row[0]);}
	if ( ($row[1] > 40) and ($row[1] <= 45) ) {$hd45 = ($hd45 + $row[0]);}
	if ( ($row[1] > 45) and ($row[1] <= 50) ) {$hd50 = ($hd50 + $row[0]);}
	if ( ($row[1] > 50) and ($row[1] <= 55) ) {$hd55 = ($hd55 + $row[0]);}
	if ( ($row[1] > 55) and ($row[1] <= 60) ) {$hd60 = ($hd60 + $row[0]);}
	if ( ($row[1] > 60) and ($row[1] <= 90) ) {$hd90 = ($hd90 + $row[0]);}
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
*/




echo "+-------------+-------+-----------------------------------------+ +------+--------------------------------+\n";
echo "|    TIME     |       |  % OF CALLS GROUPED BY HOLD TIME (SEC)  | |   AVERAGE TIME BEFORE ANSWER (SEC)    |\n";
echo "| 15 MIN INT  | CALLS |    0   20   40   60   80  100  120 120+ | | AVG  |0   20   40   60   80  100  120 |\n";
echo "+-------------+-------+-----------------------------------------+ +------+--------------------------------+\n";

$stmt="select queue_seconds,UNIX_TIMESTAMP(call_date) from vicidial_closer_log where call_date >= '$query_date_BEGIN' and call_date <= '$query_date_END' and  campaign_id='" . mysql_real_escape_string($group) . "';";
$rslt=mysql_query($stmt, $link);
if ($DB) {echo "$stmt\n";}
$records_to_print = mysql_num_rows($rslt);
$i=0;
while ($i < $records_to_print)
	{
	$row=mysql_fetch_row($rslt);
	$qs[$i] = $row[0];
	$ut[$i] = $row[1];
	$i++;
	}

$h=0;
$APhd__0=0; $APhd_20=0; $APhd_40=0; $APhd_60=0; $APhd_80=0; $APhd100=0; $APhd120=0; $APhd121=0;
$SAdate_count = count($SAdate);
while ($h < $SAdate_count)
	{
	$avg_hold_scale='';	$calls=0; 
	$hd__0=0; $hd_20=0; $hd_40=0; $hd_60=0; $hd_80=0; $hd100=0; $hd120=0; $hd121=0;
	$Phd__0=0; $Phd_20=0; $Phd_40=0; $Phd_60=0; $Phd_80=0; $Phd100=0; $Phd120=0; $Phd121=0;
	$SAdate_ARY = explode(' ',$SAdate[$h]);
	$SAday_ARY = explode('-',$SAdate_ARY[0]);
	$SAtime_ARY = explode(':',$SAdate_ARY[1]);
	$EAdate_ARY = explode(' ',$EAdate[$h]);
	$EAday_ARY = explode('-',$EAdate_ARY[0]);
	$EAtime_ARY = explode(':',$EAdate_ARY[1]);

	$SAepoch = mktime($SAtime_ARY[0], $SAtime_ARY[1], $SAtime_ARY[2], $SAday_ARY[1], $SAday_ARY[2], $SAday_ARY[0]);
	$EAepoch = mktime($EAtime_ARY[0], $EAtime_ARY[1], $EAtime_ARY[2], $EAday_ARY[1], $EAday_ARY[2], $EAday_ARY[0]);

	$i=0;
	while ($i < $records_to_print)
		{
		if ( ($ut[$i] >= $SAepoch) and ($ut[$i] < $EAepoch) )
			{
			$calls++;
			if ($qs[$i] == 0) {$hd__0++;}
			if ( ($qs[$i] > 0) and ($qs[$i] <= 20) ) {$hd_20++;}
			if ( ($qs[$i] > 20) and ($qs[$i] <= 40) ) {$hd_40++;}
			if ( ($qs[$i] > 40) and ($qs[$i] <= 60) ) {$hd_60++;}
			if ( ($qs[$i] > 60) and ($qs[$i] <= 80) ) {$hd_80++;}
			if ( ($qs[$i] > 80) and ($qs[$i] <= 100) ) {$hd100++;}
			if ( ($qs[$i] > 100) and ($qs[$i] <= 120) ) {$hd120++;}
			if ($qs[$i] > 120) {$hd121++;}
			}
		$i++;
		}
	
	if ($hd__0 > 0) {$Phd__0 = round( ( ($hd__0 / $calls) * 100) );}
	if ($hd_20 > 0) {$Phd_20 = round( ( ($hd_20 / $calls) * 100) );}
	if ($hd_40 > 0) {$Phd_40 = round( ( ($hd_40 / $calls) * 100) );}
	if ($hd_60 > 0) {$Phd_60 = round( ( ($hd_60 / $calls) * 100) );}
	if ($hd_80 > 0) {$Phd_80 = round( ( ($hd_80 / $calls) * 100) );}
	if ($hd100 > 0) {$Phd100 = round( ( ($hd100 / $calls) * 100) );}
	if ($hd120 > 0) {$Phd120 = round( ( ($hd120 / $calls) * 100) );}
	if ($hd121 > 0) {$Phd121 = round( ( ($hd121 / $calls) * 100) );}
	$Aavg_hold[$h] =	sprintf("%4s", $Aavg_hold[$h]);
	$calls =	sprintf("%5s", $calls);
	$hd__0 =	sprintf("%4s", $hd__0);
	$hd_20 =	sprintf("%4s", $hd_20);
	$hd_40 =	sprintf("%4s", $hd_40);
	$hd_60 =	sprintf("%4s", $hd_60);
	$hd_80 =	sprintf("%4s", $hd_80);
	$hd100 =	sprintf("%4s", $hd100);
	$hd120 =	sprintf("%4s", $hd120);
	$hd121 =	sprintf("%4s", $hd121);
	$Phd__0 =	sprintf("%4s", $Phd__0);
	$Phd_20 =	sprintf("%4s", $Phd_20);
	$Phd_40 =	sprintf("%4s", $Phd_40);
	$Phd_60 =	sprintf("%4s", $Phd_60);
	$Phd_80 =	sprintf("%4s", $Phd_80);
	$Phd100 =	sprintf("%4s", $Phd100);
	$Phd120 =	sprintf("%4s", $Phd120);
	$Phd121 =	sprintf("%4s", $Phd121);

	$ALLcalls = ($ALLcalls + $calls);
	$ALLhd__0 = ($ALLhd__0 + $hd__0);
	$ALLhd_20 = ($ALLhd_20 + $hd_20);
	$ALLhd_40 = ($ALLhd_40 + $hd_40);
	$ALLhd_60 = ($ALLhd_60 + $hd_60);
	$ALLhd_80 = ($ALLhd_80 + $hd_80);
	$ALLhd100 = ($ALLhd100 + $hd100);
	$ALLhd120 = ($ALLhd120 + $hd120);
	$ALLhd121 = ($ALLhd121 + $hd121);

	if ( ($Aavg_hold[$h] < 1) or ($Aavg_hold[$h] > 119) )
		{
		if ($Aavg_hold[$h] < 1)		{$avg_hold_scale = '                                ';}
		if ($Aavg_hold[$h] > 119)	{$avg_hold_scale = '<SPAN class="orange">xxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxx</SPAN>';}
		}
	else
		{
		$avg_hold_val = ( (32 / 120) * $Aavg_hold[$h] );
		$k=0;
		$blank=0;
		while ($k < 32)
			{
			if ($k <= $avg_hold_val) 
				{
				if ($k < 1) {$avg_hold_scale .= '<SPAN class="orange">';}
				$avg_hold_scale .= 'x';
				}
			else 
				{
				if ( ($k > 0) and ($blank < 1) ) {$avg_hold_scale .= '</SPAN>';}
				$avg_hold_scale .= ' ';
				$blank++;
				}
			$k++;
			if ( ($k > 31) and ($blank < 1) ) {$avg_hold_scale .= '</SPAN>';}
			}
		}

	$time = " $SAtime[$h]-$EAtime[$h] ";
	if (ereg(':00-',$time)) {$time = "+$SAtime[$h]-$EAtime[$h]+";}
	echo "|$time| $calls | $Phd__0 $Phd_20 $Phd_40 $Phd_60 $Phd_80 $Phd100 $Phd120 $Phd121 | | $Aavg_hold[$h] |$avg_hold_scale|\n";
	
	$h++;
	}

if ($ALLhd__0 > 0) {$APhd__0 = round( ( ($ALLhd__0 / $ALLcalls) * 100) );}
if ($ALLhd_20 > 0) {$APhd_20 = round( ( ($ALLhd_20 / $ALLcalls) * 100) );}
if ($ALLhd_40 > 0) {$APhd_40 = round( ( ($ALLhd_40 / $ALLcalls) * 100) );}
if ($ALLhd_60 > 0) {$APhd_60 = round( ( ($ALLhd_60 / $ALLcalls) * 100) );}
if ($ALLhd_80 > 0) {$APhd_80 = round( ( ($ALLhd_80 / $ALLcalls) * 100) );}
if ($ALLhd100 > 0) {$APhd100 = round( ( ($ALLhd100 / $ALLcalls) * 100) );}
if ($ALLhd120 > 0) {$APhd120 = round( ( ($ALLhd120 / $ALLcalls) * 100) );}
if ($ALLhd121 > 0) {$APhd121 = round( ( ($ALLhd121 / $ALLcalls) * 100) );}

$ALLcalls =	sprintf("%5s", $ALLcalls);
$APhd__0 =	sprintf("%4s", $APhd__0);
$APhd_20 =	sprintf("%4s", $APhd_20);
$APhd_40 =	sprintf("%4s", $APhd_40);
$APhd_60 =	sprintf("%4s", $APhd_60);
$APhd_80 =	sprintf("%4s", $APhd_80);
$APhd100 =	sprintf("%4s", $APhd100);
$APhd120 =	sprintf("%4s", $APhd120);
$APhd121 =	sprintf("%4s", $APhd121);

$TOT_AVG =	sprintf("%4s", $TOT_AVGraw); 
	while (strlen($TOT_AVG)>4) {$TOT_AVG = ereg_replace(".$",'',$TOT_AVG);}

echo "+-------------+-------+-----------------------------------------+ +------+--------------------------------+\n";
echo "| TOTAL       | $ALLcalls | $APhd__0 $APhd_20 $APhd_40 $APhd_60 $APhd_80 $APhd100 $APhd120 $APhd121 | | $TOT_AVG |\n";
echo "+-------------+-------+-----------------------------------------+ +------+\n";

$ENDtime = date("U");
$RUNtime = ($ENDtime - $STARTtime);
echo "\nRun Time: $RUNtime seconds\n";
}



?>
</PRE>

</BODY></HTML>