<? 
# AST_VDADstats.php
# 
# Copyright (C) 2009  Matt Florell <vicidial@gmail.com>    LICENSE: AGPLv2
#
# CHANGES
# 60619-1718 - Added variable filtering to eliminate SQL injection attack threat
#            - Added required user/pass to gain access to this page
# 61215-1139 - Added drop percentage of answered and round-2 decimal
# 71008-1436 - Added shift to be defined in dbconnect.php
# 71218-1155 - Added end_date for multi-day reports
# 80430-1920 - Added Customer hangup cause stats
# 80620-0031 - Fixed human answered calculation for drop perfentage
# 80709-0230 - Added time stats to call statuses
# 80717-2118 - Added calls/hour out of agent login time in status summary
# 80722-2049 - Added Status Category stats
# 81109-2341 - Added Productivity Rating
# 90225-1140 - Changed to multi-campaign capability
# 90310-2034 - Admin header
#

header ("Content-type: text/html; charset=utf-8");

require("dbconnect.php");

$PHP_AUTH_USER=$_SERVER['PHP_AUTH_USER'];
$PHP_AUTH_PW=$_SERVER['PHP_AUTH_PW'];
$PHP_SELF=$_SERVER['PHP_SELF'];
if (isset($_GET["agent_hours"]))				{$agent_hours=$_GET["agent_hours"];}
	elseif (isset($_POST["agent_hours"]))		{$agent_hours=$_POST["agent_hours"];}
if (isset($_GET["group"]))				{$group=$_GET["group"];}
	elseif (isset($_POST["group"]))		{$group=$_POST["group"];}
if (isset($_GET["query_date"]))				{$query_date=$_GET["query_date"];}
	elseif (isset($_POST["query_date"]))	{$query_date=$_POST["query_date"];}
if (isset($_GET["end_date"]))				{$end_date=$_GET["end_date"];}
	elseif (isset($_POST["end_date"]))		{$end_date=$_POST["end_date"];}
if (isset($_GET["shift"]))				{$shift=$_GET["shift"];}
	elseif (isset($_POST["shift"]))		{$shift=$_POST["shift"];}
if (isset($_GET["DB"]))					{$DB=$_GET["DB"];}
	elseif (isset($_POST["DB"]))		{$DB=$_POST["DB"];}
if (isset($_GET["submit"]))				{$submit=$_GET["submit"];}
	elseif (isset($_POST["submit"]))	{$submit=$_POST["submit"];}
if (isset($_GET["ENVIAR"]))				{$ENVIAR=$_GET["ENVIAR"];}
	elseif (isset($_POST["ENVIAR"]))	{$ENVIAR=$_POST["ENVIAR"];}

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
    echo "Nombre y contraseña inválidos del usuario: |$PHP_AUTH_USER|$PHP_AUTH_PW|\n";
    exit;
	}

$NOW_DATE = date("Y-m-d");
$NOW_TIME = date("Y-m-d H:i:s");
$STARTtime = date("U");
if (!isset($group)) {$group = '';}
if (!isset($query_date)) {$query_date = $NOW_DATE;}
if (!isset($end_date)) {$end_date = $NOW_DATE;}

$stmt="select campaign_id from vicidial_campaigns;";
$rslt=mysql_query($stmt, $link);
if ($DB) {echo "$stmt\n";}
$campaigns_to_print = mysql_num_rows($rslt);
$i=0;
while ($i < $campaigns_to_print)
	{
	$row=mysql_fetch_row($rslt);
	$groups[$i] =$row[0];
	$i++;
	}

$i=0;
$group_string='|';
$group_ct = count($group);
while($i < $group_ct)
	{
	$group_string .= "$group[$i]|";
	$group_SQL .= "'$group[$i]',";
	$groupQS .= "&group[]=$group[$i]";
	$i++;
	}
if ( (ereg("--ALL--",$group_string) ) or ($group_ct < 1) )
	{$group_SQL = "";}
else
	{
	$group_SQL = eregi_replace(",$",'',$group_SQL);
	$group_SQLand = "and campaign_id IN($group_SQL)";
	$group_SQL = "where campaign_id IN($group_SQL)";
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
echo "<TITLE>VICIDIAL: VDAD Stats</TITLE></HEAD><BODY BGCOLOR=WHITE marginheight=0 marginwidth=0 leftmargin=0 topmargin=0>\n";

$short_header=1;

require("admin_header.php");

echo "<TABLE CELLPADDING=4 CELLSPACING=0><TR><TD>";

echo "<FORM ACTION=\"$PHP_SELF\" METHOD=GET>\n";
echo "<TABLE CELLSPACING=3><TR><TD VALIGN=TOP> Fechas:<BR>";
echo "<INPUT TYPE=HIDDEN NAME=agent_hours VALUE=\"$agent_hours\">\n";
echo "<INPUT TYPE=HIDDEN NAME=DB VALUE=\"$DB\">\n";
echo "<INPUT TYPE=TEXT NAME=query_date SIZE=10 MAXLENGTH=10 VALUE=\"$query_date\">\n";
echo "<BR> to <BR><INPUT TYPE=TEXT NAME=end_date SIZE=10 MAXLENGTH=10 VALUE=\"$end_date\">\n";
echo "</TD><TD VALIGN=TOP> Campañas:<BR>";
echo "<SELECT SIZE=5 NAME=group[] multiple>\n";
if  (eregi("--ALL--",$group_string))
	{echo "<option value=\"--ALL--\" selected>-- ALL CAMPAÑAS --</option>\n";}
else
	{echo "<option value=\"--ALL--\">-- ALL CAMPAÑAS --</option>\n";}
$o=0;
while ($campaigns_to_print > $o)
{
	if (eregi("$groups[$o]\|",$group_string)) {echo "<option selected value=\"$groups[$o]\">$groups[$o]</option>\n";}
	  else {echo "<option value=\"$groups[$o]\">$groups[$o]</option>\n";}
	$o++;
}
echo "</SELECT>\n";
echo "</TD><TD VALIGN=TOP>Shift:<BR>";
echo "<SELECT SIZE=1 NAME=shift>\n";
echo "<option selected value=\"$shift\">$shift</option>\n";
echo "<option value=\"\">--</option>\n";
echo "<option value=\"AM\">AM</option>\n";
echo "<option value=\"PM\">PM</option>\n";
echo "<option value=\"ALL\">ALL</option>\n";
echo "</SELECT><BR><BR>\n";
echo "<INPUT type=submit NAME=ENVIAR VALUE=ENVIAR>\n";
echo "</TD><TD VALIGN=TOP> &nbsp; &nbsp; &nbsp; &nbsp; ";
echo "<FONT FACE=\"ARIAL,HELVETICA\" COLOR=BLACK SIZE=2>";
if (strlen($group[0]) > 1)
	{
	echo " <a href=\"./admin.php?ADD=34&campaign_id=$group[0]\">MODIFICAR</a> | \n";
	echo " <a href=\"./admin.php?ADD=999999\">INFORMES</a> </FONT>\n";
	}
else
	{
	echo " <a href=\"./admin.php?ADD=10\">CAMPAIGNS</a> | \n";
	echo " <a href=\"./admin.php?ADD=999999\">INFORMES</a> </FONT>\n";
	}
echo "</TD></TR></TABLE>";
echo "</FORM>\n\n";

echo "<PRE><FONT SIZE=2>\n\n";


if (strlen($group[0]) < 1)
{
echo "\n\n";
echo "SELECCIONE POR FAVOR Una CAMPAÚA Y La FECHA ARRIBA Y El TECLEO SOMETEN\n";
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



echo "VICIDIAL: Auto-dial Stats                             $NOW_TIME\n";

echo "\n";
echo "Time range: $query_date_BEGIN to $query_date_END\n\n";
echo "---------- TOTALS\n";

$stmt="select count(*),sum(length_in_sec) from vicidial_log where call_date >= '$query_date_BEGIN' and call_date <= '$query_date_END' $group_SQLand;";
$rslt=mysql_query($stmt, $link);
if ($DB) {echo "$stmt\n";}
$row=mysql_fetch_row($rslt);

$TOTALcalls =	sprintf("%10s", $row[0]);
$TOTALsec =		$row[1];
if ( ($row[0] < 1) or ($TOTALsec < 1) )
	{$average_hold_seconds = '         0';}
else
	{
	$average_hold_seconds = ($TOTALsec / $row[0]);
	$average_hold_seconds = round($average_hold_seconds, 2);
	$average_hold_seconds =	sprintf("%10s", $average_hold_seconds);
	}
echo "Llamadas dentro de esta campaña $TOTALcalls\n";
echo "Longitud media para las llamadas en segundos: $average_hold_seconds\n";


echo "\n";
echo "---------- DROPS\n";

$stmt="select count(*),sum(length_in_sec) from vicidial_log where call_date >= '$query_date_BEGIN' and call_date <= '$query_date_END' $group_SQLand and status='DROP' and (length_in_sec <= 6000 or length_in_sec is null);";
$rslt=mysql_query($stmt, $link);
if ($DB) {echo "$stmt\n";}
$row=mysql_fetch_row($rslt);
$DROPcalls =	sprintf("%10s", $row[0]);
$DROPcallsRAW =	$row[0];
$DROPseconds =	$row[1];


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
	if ($human_answered[$q]=='Y')
		{$camp_ANS_STAT_SQL .=	 "'$row[0]',";}
	$q++;
	$p++;
	}

$stmt = "SELECT distinct status,status_name,human_answered,category from vicidial_campaign_statuses $group_SQL;";
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
	if ($human_answered[$q]=='Y')
		{$camp_ANS_STAT_SQL .=	 "'$row[0]',";}
	$q++;
	$p++;
	}
$camp_ANS_STAT_SQL = eregi_replace(",$",'',$camp_ANS_STAT_SQL);


$stmt="select count(*) from vicidial_log where call_date >= '$query_date_BEGIN' and call_date <= '$query_date_END' $group_SQLand and status IN($camp_ANS_STAT_SQL);";
$rslt=mysql_query($stmt, $link);
if ($DB) {echo "$stmt\n";}
$row=mysql_fetch_row($rslt);
$RESPUESTAcalls =	$row[0];

if ( ($DROPcalls < 1) or ($TOTALcalls < 1) )
	{$DROPpercent = '0';}
else
	{
	$DROPpercent = (($DROPcallsRAW / $TOTALcalls) * 100);
	$DROPpercent = round($DROPpercent, 2);
	}

if ( ($DROPcalls < 1) or ($RESPUESTAcalls < 1) )
	{$DROPRESPUESTApercent = '0';}
else
	{
	$DROPRESPUESTApercent = (($DROPcallsRAW / $RESPUESTAcalls) * 100);
	$DROPRESPUESTApercent = round($DROPRESPUESTApercent, 2);
	}

if ( ($DROPseconds < 1) or ($DROPcallsRAW < 1) )
	{$average_hold_seconds = '         0';}
else
	{
	$average_hold_seconds = ($DROPseconds / $DROPcallsRAW);
	$average_hold_seconds = round($average_hold_seconds, 2);
	$average_hold_seconds =	sprintf("%10s", $average_hold_seconds);
	}

echo "Total DROP Calls: $DROPcalls  $DROPpercent%\n";
echo "Percent of DROP Calls taken out of Answers:   $DROPcalls / $RESPUESTAcalls  $DROPRESPUESTApercent%\n";
echo "Longitud media para las llamadas DROP en segundos:    $average_hold_seconds\n";


$stmt = "select closer_campaigns from vicidial_campaigns $group_SQL;";
$rslt=mysql_query($stmt, $link);
$ccamps_to_print = mysql_num_rows($rslt);
$c=0;
while ($ccamps_to_print > $c)
	{
	$row=mysql_fetch_row($rslt);
	$closer_campaigns = $row[0];
	$closer_campaigns = preg_replace("/^ | -$/","",$closer_campaigns);
	$closer_campaigns = preg_replace("/ /","','",$closer_campaigns);
	$closer_campaignsSQL .= "'$closer_campaigns',";
	$c++;
	}
$closer_campaignsSQL = eregi_replace(",$",'',$closer_campaignsSQL);

$stmt="select count(*) from vicidial_closer_log where call_date >= '$query_date_BEGIN' and call_date <= '$query_date_END' and  campaign_id IN($closer_campaignsSQL) and status NOT IN('DROP','XDROP','HXFER','QVMAIL','HOLDTO','LIVE','QUEUE');";
$rslt=mysql_query($stmt, $link);
if ($DB) {echo "$stmt\n";}
$row=mysql_fetch_row($rslt);
$TOTALanswers = ($row[0] + $RESPUESTAcalls);


$stmt = "SELECT sum(wait_sec + talk_sec + dispo_sec) from vicidial_agent_log where event_time >= '$query_date_BEGIN' and event_time <= '$query_date_END' $group_SQLand;";
$rslt=mysql_query($stmt, $link);
if ($DB) {echo "$stmt\n";}
$row=mysql_fetch_row($rslt);
$agent_non_pause_sec = $row[0];

if ($agent_non_pause_sec > 0)
	{
	$AVG_RESPUESTAagent_non_pause_sec = (($TOTALanswers / $agent_non_pause_sec) * 60);
	$AVG_RESPUESTAagent_non_pause_sec = round($AVG_RESPUESTAagent_non_pause_sec, 2);
	}
else
	{$AVG_RESPUESTAagent_non_pause_sec=0;}
$AVG_RESPUESTAagent_non_pause_sec = sprintf("%10s", $AVG_RESPUESTAagent_non_pause_sec);

echo "Productivity Rating:                          $AVG_RESPUESTAagent_non_pause_sec\n";




echo "\n";
echo "---------- AUTO-DIAL SIN RESPUESTA\n";

$stmt="select count(*),sum(length_in_sec) from vicidial_log where call_date >= '$query_date_BEGIN' and call_date <= '$query_date_END' $group_SQLand and status IN('NA','B') and (length_in_sec <= 60 or length_in_sec is null);";
$rslt=mysql_query($stmt, $link);
if ($DB) {echo "$stmt\n";}
$row=mysql_fetch_row($rslt);

$NAcalls =	sprintf("%10s", $row[0]);
if ( ($NAcalls < 1) or ($TOTALcalls < 1) )
	{$NApercent = '0';}
else
	{
	$NApercent = (($NAcalls / $TOTALcalls) * 100);
	$NApercent = round($NApercent, 2);
	}

if ( ($row[0] < 1) or ($row[1] < 1) )
	{$average_na_seconds = '         0';}
else
	{
	$average_na_seconds = ($row[1] / $row[0]);
	$average_na_seconds = round($average_na_seconds, 2);
	$average_na_seconds =	sprintf("%10s", $average_na_seconds);
	}

echo "Total NA calls -Busy,Disconnect,RingNoAnswer: $NAcalls  $NApercent%\n";
echo "Longitud media para las Llamadas sin Respuesta en segundos:       $average_na_seconds\n";


##############################
#########  CALL HANGUP REASON STATS

$TOTALcalls = 0;

echo "\n";
echo "---------- CONVOCATORIA colgar RAZÓN ESTADÍSTICAS\n";
echo "+----------------------+------------+\n";
echo "| HANGUP REASON        | CALLS      |\n";
echo "+----------------------+------------+\n";

$stmt="select count(*),term_reason from vicidial_log where call_date >= '$query_date_BEGIN' and call_date <= '$query_date_END' $group_SQLand group by term_reason;";
if ($non_latin > 0) {$rslt=mysql_query("SET NAMES 'UTF8'");}
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
	if (ereg("NONE",$reason))	{$reason = 'NO RESPUESTA           ';}
	if (ereg("CALLER",$reason)) {$reason = 'CUSTOMER            ';}

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
echo "+--------+----------------------+----------------------+------------+----------------------------------+----------+\n";
echo "|        |                      |                      |            |      CALL TIME                   |AGENTE TIME|\n";
echo "| STATUS | DESCRIPTION          | CATEGORÍA             | CALLS      | TOTAL TIME | AVG TIME |CALLS/HOUR|CALLS/HOUR|\n";
echo "+--------+----------------------+----------------------+------------+------------+----------+----------+----------+\n";


## Pull the count of agent seconds for the total tally
$stmt="SELECT sum(pause_sec + wait_sec + talk_sec + dispo_sec) from vicidial_agent_log where event_time >= '$query_date_BEGIN' and event_time <= '$query_date_END' $group_SQLand and pause_sec<36000 and wait_sec<36000 and talk_sec<36000 and dispo_sec<36000;";
$rslt=mysql_query($stmt, $link);
$Ctally_to_print = mysql_num_rows($rslt);
if ($Ctally_to_print > 0) 
	{
	$rowx=mysql_fetch_row($rslt);
	$AGENTsec = "$rowx[0]";
	}


## get counts and time totals for all statuses in this campaign
$stmt="select count(*),status,sum(length_in_sec) from vicidial_log where call_date >= '$query_date_BEGIN' and call_date <= '$query_date_END'  $group_SQLand group by status;";
if ($non_latin > 0) {$rslt=mysql_query("SET NAMES 'UTF8'");}
$rslt=mysql_query($stmt, $link);
if ($DB) {echo "$stmt\n";}
$statuses_to_print = mysql_num_rows($rslt);
$i=0;
while ($i < $statuses_to_print)
	{
	$row=mysql_fetch_row($rslt);

	$STATUScount =	$row[0];
	$RAWstatus =	$row[1];
	$r=0;
	while ($r < $statcats_to_print)
		{
		if ($statcat_list[$RAWstatus] == "$vsc_id[$r]")
			{
			$vsc_count[$r] = ($vsc_count[$r] + $STATUScount);
			}
		$r++;
		}
	if ($AGENTsec < 1) {$AGENTsec=1;}
	$TOTALcalls =	($TOTALcalls + $row[0]);
	$STATUSrate =	($STATUScount / ($TOTALsec / 3600) );
		$STATUSrate =	sprintf("%.2f", $STATUSrate);
	$AGENTrate =	($STATUScount / ($AGENTsec / 3600) );
		$AGENTrate =	sprintf("%.2f", $AGENTrate);

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
	$AGENTrate =	sprintf("%8s", $AGENTrate);while(strlen($AGENTrate)>8) {$AGENTrate = substr("$AGENTrate", 0, -1);}

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

	echo "| $status | $status_name | $statcat | $STATUScount | $STATUShours | $STATUSavg | $STATUSrate | $AGENTrate |\n";

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
	$aTOTALrate =	($TOTALcalls / ($AGENTsec / 3600) );
		$aTOTALrate =	sprintf("%.2f", $aTOTALrate);

	$aTOTALhours_H =	($AGENTsec / 3600);
	$aTOTALhours_H_int = round($aTOTALhours_H, 2);
	$aTOTALhours_H_int = intval("$aTOTALhours_H_int");
	$aTOTALhours_M = ($aTOTALhours_H - $aTOTALhours_H_int);
	$aTOTALhours_M = ($aTOTALhours_M * 60);
	$aTOTALhours_M_int = round($aTOTALhours_M, 2);
	$aTOTALhours_M_int = intval("$aTOTALhours_M_int");
	$aTOTALhours_S = ($aTOTALhours_M - $aTOTALhours_M_int);
	$aTOTALhours_S = ($aTOTALhours_S * 60);
	$aTOTALhours_S = round($aTOTALhours_S, 0);
	if ($aTOTALhours_S < 10) {$aTOTALhours_S = "0$aTOTALhours_S";}
	if ($aTOTALhours_M_int < 10) {$aTOTALhours_M_int = "0$aTOTALhours_M_int";}
	$aTOTALhours = "$aTOTALhours_H_int:$aTOTALhours_M_int:$aTOTALhours_S";

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
$aTOTALhours =	sprintf("%10s", $aTOTALhours);while(strlen($aTOTALhours)>10) {$aTOTALhours = substr("$aTOTALhours", 0, -1);}
$TOTALavg =	sprintf("%8s", $TOTALavg);while(strlen($TOTALavg)>8) {$TOTALavg = substr("$TOTALavg", 0, -1);}
$TOTALrate =	sprintf("%8s", $TOTALrate);while(strlen($TOTALrate)>8) {$TOTALrate = substr("$TOTALrate", 0, -1);}
$aTOTALrate =	sprintf("%8s", $aTOTALrate);while(strlen($aTOTALrate)>8) {$aTOTALrate = substr("$aTOTALrate", 0, -1);}

echo "+--------+----------------------+----------------------+------------+------------+----------+----------+----------+\n";
echo "| TOTAL:                                               | $TOTALcalls | $TOTALhours | $TOTALavg | $TOTALrate |          |\n";
echo "|   AGENTE TIME                                                      | $aTOTALhours |                     | $aTOTALrate |\n";
echo "+------------------------------------------------------+------------+------------+---------------------+----------+\n";



##############################
#########  STATUS CATEGORY STATS

echo "\n";
echo "---------- CUSTOM STATUS CATEGORÍA STATS\n";
echo "+----------------------+------------+--------------------------------+\n";
echo "| CATEGORÍA             | CALLS      | DESCRIPTION                    |\n";
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
echo "---------- AGENTE STATS\n";
echo "+--------------------------+------------+----------+--------+\n";
echo "| AGENTE                    | CALLS      | TIME M   | AVRG M |\n";
echo "+--------------------------+------------+----------+--------+\n";

$stmt="select vicidial_log.user,full_name,count(*),sum(length_in_sec),avg(length_in_sec) from vicidial_log,vicidial_users where call_date >= '$query_date_BEGIN' and call_date <= '$query_date_END' $group_SQLand and vicidial_log.user is not null and length_in_sec is not null and length_in_sec > 0 and vicidial_log.user=vicidial_users.user group by vicidial_log.user;";
if ($non_latin > 0) {$rslt=mysql_query("SET NAMES 'UTF8'");}
$rslt=mysql_query($stmt, $link);
if ($DB) {echo "$stmt\n";}
$users_to_print = mysql_num_rows($rslt);
$i=0;
while ($i < $users_to_print)
	{
	$row=mysql_fetch_row($rslt);

	$TOTcalls = ($TOTcalls + $row[2]);
	$TOTtime = ($TOTtime + $row[3]);

	$user =	sprintf("%-6s", $row[0]);while(strlen($user)>6) {$user = substr("$user", 0, -1);}
	if ($non_latin < 1)
	{
 	 $full_name =	sprintf("%-15s", $row[1]); while(strlen($full_name)>15) {$full_name = substr("$full_name", 0, -1);}	
	}
	else
	{
	 $full_name =	sprintf("%-45s", $row[1]); while(mb_strlen($full_name,'utf-8')>15) {$full_name = mb_substr("$full_name", 0, -1,'utf-8');}	
	}
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
	$USERtotTALK_MS =		sprintf("%6s", $USERtotTALK_MS);

	$USERavgTALK_M = ($USERavgTALK / 60);
	$USERavgTALK_M_int = round($USERavgTALK_M, 2);
	$USERavgTALK_M_int = intval("$USERavgTALK_M_int");
	$USERavgTALK_S = ($USERavgTALK_M - $USERavgTALK_M_int);
	$USERavgTALK_S = ($USERavgTALK_S * 60);
	$USERavgTALK_S = round($USERavgTALK_S, 0);
	if ($USERavgTALK_S < 10) {$USERavgTALK_S = "0$USERavgTALK_S";}
	$USERavgTALK_MS = "$USERavgTALK_M_int:$USERavgTALK_S";
	$USERavgTALK_MS =		sprintf("%6s", $USERavgTALK_MS);

	echo "| $user - $full_name | $USERcalls |   $USERtotTALK_MS | $USERavgTALK_MS |\n";

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

$stmt="select avg(wait_sec) from vicidial_agent_log where event_time >= '$query_date_BEGIN' and event_time <= '$query_date_END' $group_SQLand;";
$rslt=mysql_query($stmt, $link);
if ($DB) {echo "$stmt\n";}
$row=mysql_fetch_row($rslt);

$AVGwait = $row[0];
$AVGwait_M = ($AVGwait / 60);
$AVGwait_M_int = round($AVGwait_M, 2);
$AVGwait_M_int = intval("$AVGwait_M_int");
$AVGwait_S = ($AVGwait_M - $AVGwait_M_int);
$AVGwait_S = ($AVGwait_S * 60);
$AVGwait_S = round($AVGwait_S, 0);
if ($AVGwait_S < 10) {$AVGwait_S = "0$AVGwait_S";}
$AVGwait_MS = "$AVGwait_M_int:$AVGwait_S";
$AVGwait =		sprintf("%6s", $AVGwait_MS);

echo "+--------------------------+------------+----------+--------+\n";
echo "| TOTAL Agents: $TOTagents | $TOTcalls | $TOTtime | $TOTavg |\n";
echo "+--------------------------+------------+----------+--------+\n";
echo "| Average Wait time between calls                    $AVGwait |\n";
echo "+-----------------------------------------------------------+\n";

##############################
#########  TIME STATS

echo "\n";
echo "---------- ESTADÍSTICAS DEL TIEMPO\n";

echo "<FONT SIZE=0>\n";

$hi_hour_count=0;
$last_full_record=0;
$i=0;
$h=0;
while ($i <= 96)
	{
	$stmt="select count(*) from vicidial_log where call_date >= '$query_date $h:00:00' and call_date <= '$query_date $h:14:59' $group_SQLand;";
	$rslt=mysql_query($stmt, $link);
	if ($DB) {echo "$stmt\n";}
	$row=mysql_fetch_row($rslt);
	$hour_count[$i] = $row[0];
	if ($hour_count[$i] > $hi_hour_count) {$hi_hour_count = $hour_count[$i];}
	if ($hour_count[$i] > 0) {$last_full_record = $i;}
	$stmt="select count(*) from vicidial_log where call_date >= '$query_date $h:00:00' and call_date <= '$query_date $h:14:59' $group_SQLand and status='DROP';";
	$rslt=mysql_query($stmt, $link);
	if ($DB) {echo "$stmt\n";}
	$row=mysql_fetch_row($rslt);
	$drop_count[$i] = $row[0];
	$i++;


	$stmt="select count(*) from vicidial_log where call_date >= '$query_date $h:15:00' and call_date <= '$query_date $h:29:59' $group_SQLand;";
	$rslt=mysql_query($stmt, $link);
	if ($DB) {echo "$stmt\n";}
	$row=mysql_fetch_row($rslt);
	$hour_count[$i] = $row[0];
	if ($hour_count[$i] > $hi_hour_count) {$hi_hour_count = $hour_count[$i];}
	if ($hour_count[$i] > 0) {$last_full_record = $i;}
	$stmt="select count(*) from vicidial_log where call_date >= '$query_date $h:15:00' and call_date <= '$query_date $h:29:59' $group_SQLand and status='DROP';";
	$rslt=mysql_query($stmt, $link);
	if ($DB) {echo "$stmt\n";}
	$row=mysql_fetch_row($rslt);
	$drop_count[$i] = $row[0];
	$i++;

	$stmt="select count(*) from vicidial_log where call_date >= '$query_date $h:30:00' and call_date <= '$query_date $h:44:59' $group_SQLand;";
	$rslt=mysql_query($stmt, $link);
	if ($DB) {echo "$stmt\n";}
	$row=mysql_fetch_row($rslt);
	$hour_count[$i] = $row[0];
	if ($hour_count[$i] > $hi_hour_count) {$hi_hour_count = $hour_count[$i];}
	if ($hour_count[$i] > 0) {$last_full_record = $i;}
	$stmt="select count(*) from vicidial_log where call_date >= '$query_date $h:30:00' and call_date <= '$query_date $h:44:59' $group_SQLand and status='DROP';";
	$rslt=mysql_query($stmt, $link);
	if ($DB) {echo "$stmt\n";}
	$row=mysql_fetch_row($rslt);
	$drop_count[$i] = $row[0];
	$i++;

	$stmt="select count(*) from vicidial_log where call_date >= '$query_date $h:45:00' and call_date <= '$query_date $h:59:59' $group_SQLand;";
	$rslt=mysql_query($stmt, $link);
	if ($DB) {echo "$stmt\n";}
	$row=mysql_fetch_row($rslt);
	$hour_count[$i] = $row[0];
	if ($hour_count[$i] > $hi_hour_count) {$hi_hour_count = $hour_count[$i];}
	if ($hour_count[$i] > 0) {$last_full_record = $i;}
	$stmt="select count(*) from vicidial_log where call_date >= '$query_date $h:45:00' and call_date <= '$query_date $h:59:59' $group_SQLand and status='DROP';";
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
echo "GRÁFICO EN 15 INCREMENTOS MINUCIOSOS DE LAS LLAMADAS TOTALES PUESTAS DE ESTA CAMPAÚA\n";

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


echo "+------+-------------------------------------------------------------------------------------------------------+-------+-------+\n";






$ENDtime = date("U");
$RUNtime = ($ENDtime - $STARTtime);
echo "\nRun Time: $RUNtime seconds\n";

}



?>
</PRE>
</TD></TR></TABLE>

</BODY></HTML>