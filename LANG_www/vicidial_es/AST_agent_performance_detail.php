<? 
# AST_agent_performance_detail.php
# 
# Copyright (C) 2009  Matt Florell <vicidial@gmail.com>    LICENSE: AGPLv2
#
# CHANGES
#
# 71119-2359 - First build
# 71121-0144 - Replace existing AST_agent_performance_detail.php script with this one
#            - Fixed zero division bug
# 71218-1155 - added end_date for multi-day reports
# 80428-0144 - UTF8 cleanup
# 80712-1007 - tally bug fixes and time display change
# 81030-0346 - Added pause code stats
# 81030-1924 - Added total non-pause and total logged-in time to pause code section
# 81108-0716 - fixed user same-name bug
# 81110-0056 - fixed pause code display bug
# 90310-2039 - Admin header
#

require("dbconnect.php");

$PHP_AUTH_USER=$_SERVER['PHP_AUTH_USER'];
$PHP_AUTH_PW=$_SERVER['PHP_AUTH_PW'];
$PHP_SELF=$_SERVER['PHP_SELF'];
if (isset($_GET["query_date"]))				{$query_date=$_GET["query_date"];}
	elseif (isset($_POST["query_date"]))	{$query_date=$_POST["query_date"];}
if (isset($_GET["end_date"]))				{$end_date=$_GET["end_date"];}
	elseif (isset($_POST["end_date"]))		{$end_date=$_POST["end_date"];}
if (isset($_GET["group"]))					{$group=$_GET["group"];}
	elseif (isset($_POST["group"]))			{$group=$_POST["group"];}
if (isset($_GET["user_group"]))				{$user_group=$_GET["user_group"];}
	elseif (isset($_POST["user_group"]))	{$user_group=$_POST["user_group"];}
if (isset($_GET["shift"]))					{$shift=$_GET["shift"];}
	elseif (isset($_POST["shift"]))			{$shift=$_POST["shift"];}
if (isset($_GET["stage"]))					{$stage=$_GET["stage"];}
	elseif (isset($_POST["stage"]))			{$stage=$_POST["stage"];}
if (isset($_GET["DB"]))						{$DB=$_GET["DB"];}
	elseif (isset($_POST["DB"]))			{$DB=$_POST["DB"];}
if (isset($_GET["submit"]))					{$submit=$_GET["submit"];}
	elseif (isset($_POST["submit"]))		{$submit=$_POST["submit"];}
if (isset($_GET["ENVIAR"]))					{$ENVIAR=$_GET["ENVIAR"];}
	elseif (isset($_POST["ENVIAR"]))		{$ENVIAR=$_POST["ENVIAR"];}


if (strlen($shift)<2) {$shift='ALL';}

$LINKbase = "$PHP_SELF?query_date=$query_date&end_date=$end_date&group=$group&user_group=$user_group&shift=$shift&DB=$DB";

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

$PHP_AUTH_USER = ereg_replace("[^0-9a-zA-Z]","",$PHP_AUTH_USER);
$PHP_AUTH_PW = ereg_replace("[^0-9a-zA-Z]","",$PHP_AUTH_PW);

$stmt="SELECT count(*) from vicidial_users where user='$PHP_AUTH_USER' and pass='$PHP_AUTH_PW' and user_level > 6 and view_reports='1';";
if ($DB) {echo "|$stmt|\n";}
if ($non_latin > 0) { $rslt=mysql_query("SET NAMES 'UTF8'");}
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

$MT[0]='';
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
$stmt="select user_group from vicidial_user_groups;";
$rslt=mysql_query($stmt, $link);
if ($DB) {echo "$stmt\n";}
$user_groups_to_print = mysql_num_rows($rslt);
$i=0;
while ($i < $user_groups_to_print)
	{
	$row=mysql_fetch_row($rslt);
	$user_groups[$i] =$row[0];
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
echo "<TITLE>VICIDIAL: Agent Performance</TITLE></HEAD><BODY BGCOLOR=WHITE marginheight=0 marginwidth=0 leftmargin=0 topmargin=0>\n";

	$short_header=1;

	require("admin_header.php");

echo "<TABLE CELLPADDING=4 CELLSPACING=0><TR><TD>";

echo "<FORM ACTION=\"$PHP_SELF\" METHOD=GET>\n";
echo "<INPUT TYPE=hidden NAME=DB VALUE=\"$DB\">\n";
echo "<INPUT TYPE=TEXT NAME=query_date SIZE=10 MAXLENGTH=10 VALUE=\"$query_date\">\n";
echo " to <INPUT TYPE=TEXT NAME=end_date SIZE=10 MAXLENGTH=10 VALUE=\"$end_date\">\n";
echo "<SELECT SIZE=1 NAME=group>\n";
	$o=0;
	while ($campaigns_to_print > $o)
	{
		if ($groups[$o] == $group) {echo "<option selected value=\"$groups[$o]\">$groups[$o]</option>\n";}
		  else {echo "<option value=\"$groups[$o]\">$groups[$o]</option>\n";}
		$o++;
	}
echo "</SELECT>\n";
echo "<SELECT SIZE=1 NAME=user_group>\n";
echo "<option value=\"\">-- ALL GRUPOS DE USUARIO --</option>\n";
	$o=0;
	while ($user_groups_to_print > $o)
	{
		if ($user_groups[$o] == $user_group) {echo "<option selected value=\"$user_groups[$o]\">$user_groups[$o]</option>\n";}
		  else {echo "<option value=\"$user_groups[$o]\">$user_groups[$o]</option>\n";}
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
echo "<INPUT TYPE=Submit NAME=ENVIAR VALUE=ENVIAR>\n";
echo "<FONT FACE=\"ARIAL,HELVETICA\" COLOR=BLACK SIZE=2> &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; <a href=\"./admin.php?ADD=34&campaign_id=$group\">MODIFICAR</a> | <a href=\"./admin.php?ADD=999999\">INFORMES</a> </FONT>\n";
echo "</FORM>\n\n";

echo "<PRE><FONT SIZE=2>\n";


if (!$group)
{
echo "\n";
echo "POR FAVOR SELECCIONE UNA CAMPAÑA Y FECHA-TEMNE ANTERIOR Y HAGA CLICK ENVIAR\n";
echo " NOTE: stats taken from shift specified\n";
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

if (strlen($user_group)>0) {$ugSQL="and vicidial_agent_log.user_group='$user_group'";}
else {$ugSQL='';}

echo "VICIDIAL: Agent Performance Detalle                        $NOW_TIME\n";

echo "Time range: $query_date_BEGIN to $query_date_END\n\n";
echo "---------- AGENTS Detalles -------------\n\n";





$statuses='-';
$statusesTXT='';
$statusesHEAD='';
$statusesHTML='';
$statusesARY[0]='';
$j=0;
$users='-';
$usersARY[0]='';
$user_namesARY[0]='';
$k=0;

$stmt="select count(*) as calls,sum(talk_sec) as talk,full_name,vicidial_users.user,sum(pause_sec),sum(wait_sec),sum(dispo_sec),status from vicidial_users,vicidial_agent_log where event_time <= '$query_date_END' and event_time >= '$query_date_BEGIN' and vicidial_users.user=vicidial_agent_log.user and campaign_id='" . mysql_real_escape_string($group) . "' and pause_sec<36000 and wait_sec<36000 and talk_sec<36000 and dispo_sec<36000 $ugSQL group by user,full_name,status order by full_name,user,status desc limit 500000;";
$rslt=mysql_query($stmt, $link);
if ($DB) {echo "$stmt\n";}
$rows_to_print = mysql_num_rows($rslt);
$i=0;
while ($i < $rows_to_print)
	{
	$row=mysql_fetch_row($rslt);
#	$row[0] = ($row[0] - 1);	# subtract 1 for login/logout event compensation
	
	$calls[$i] =		$row[0];
	$talk_sec[$i] =		$row[1];
	$full_name[$i] =	$row[2];
	$user[$i] =			$row[3];
	$pause_sec[$i] =	$row[4];
	$wait_sec[$i] =		$row[5];
	$dispo_sec[$i] =	$row[6];
	$status[$i] =		$row[7];
	if ( (!eregi("-$status[$i]-", $statuses)) and (strlen($status[$i])>0) )
		{
		$statusesTXT = sprintf("%8s", $status[$i]);
		$statusesHEAD .= "----------+";
		$statusesHTML .= " $statusesTXT |";
		$statuses .= "$status[$i]-";
		$statusesARY[$j] = $status[$i];
		$j++;
		}
	if (!eregi("-$user[$i]-", $users))
		{
		$users .= "$user[$i]-";
		$usersARY[$k] = $user[$i];
		$user_namesARY[$k] = $full_name[$i];
		$k++;
		}

	$i++;
	}

echo "CALL STATS BREAKDOWN:\n";
echo "+-----------------+----------+--------+---------+--------+--------+--------+--------+--------+--------+--------+--------+$statusesHEAD\n";
echo "| <a href=\"$LINKbase\">USER NAME</a>       | <a href=\"$LINKbase&stage=ID\">ID</a>       | <a href=\"$LINKbase&stage=CALLS\">CALLS</a>  | <a href=\"$LINKbase&stage=TIME\">TIME</a>    | PAUSE  | PAUSAVG| WAIT   | WAITAVG| TALK   | TALKAVG| DISPO  | DISPAVG|$statusesHTML\n";
echo "+-----------------+----------+--------+---------+--------+--------+--------+--------+--------+--------+--------+--------+$statusesHEAD\n";


### BEGIN loop through each user ###
$m=0;
while ($m < $k)
	{
	$Suser=$usersARY[$m];
	$Sfull_name=$user_namesARY[$m];
	$Stime=0;
	$Scalls=0;
	$Stalk_sec=0;
	$Spause_sec=0;
	$Swait_sec=0;
	$Sdispo_sec=0;
	$SstatusesHTML='';

	### BEGIN loop through each status ###
	$n=0;
	while ($n < $j)
		{
		$Sstatus=$statusesARY[$n];
		$SstatusTXT='';
		### BEGIN loop through each stat line ###
		$i=0; $status_found=0;
		while ($i < $rows_to_print)
			{
			if ( ($Suser=="$user[$i]") and ($Sstatus=="$status[$i]") )
				{
				$Scalls =		($Scalls + $calls[$i]);
				$Stalk_sec =	($Stalk_sec + $talk_sec[$i]);
				$Spause_sec =	($Spause_sec + $pause_sec[$i]);
				$Swait_sec =	($Swait_sec + $wait_sec[$i]);
				$Sdispo_sec =	($Sdispo_sec + $dispo_sec[$i]);
				$SstatusTXT = sprintf("%8s", $calls[$i]);
				$SstatusesHTML .= " $SstatusTXT |";
				$status_found++;
				}
			$i++;
			}
		if ($status_found < 1)
			{
			$SstatusesHTML .= "        0 |";
			}
		### END loop through each stat line ###
		$n++;
		}
	### END loop through each status ###
	$Stime = ($Stalk_sec + $Spause_sec + $Swait_sec + $Sdispo_sec);
	$TOTcalls=($TOTcalls + $Scalls);
	$TOTtime=($TOTtime + $Stime);
	$TOTtotTALK=($TOTtotTALK + $Stalk_sec);
	$TOTtotWAIT=($TOTtotWAIT + $Swait_sec);
	$TOTtotPAUSE=($TOTtotPAUSE + $Spause_sec);
	$TOTtotDISPO=($TOTtotDISPO + $Sdispo_sec);
	$Stime = ($Stalk_sec + $Spause_sec + $Swait_sec + $Sdispo_sec);
	if ( ($Scalls > 0) and ($Stalk_sec > 0) ) {$Stalk_avg = ($Stalk_sec/$Scalls);}
		else {$Stalk_avg=0;}
	if ( ($Scalls > 0) and ($Spause_sec > 0) ) {$Spause_avg = ($Spause_sec/$Scalls);}
		else {$Spause_avg=0;}
	if ( ($Scalls > 0) and ($Swait_sec > 0) ) {$Swait_avg = ($Swait_sec/$Scalls);}
		else {$Swait_avg=0;}
	if ( ($Scalls > 0) and ($Sdispo_sec > 0) ) {$Sdispo_avg = ($Sdispo_sec/$Scalls);}
		else {$Sdispo_avg=0;}

	$RAWuser = $Suser;
	$RAWcalls = $Scalls;
	$Scalls =	sprintf("%6s", $Scalls);

	if ($non_latin < 1)
		{
		 $Sfull_name=	sprintf("%-15s", $Sfull_name); 
			while(strlen($Sfull_name)>15) {$Sfull_name = substr("$Sfull_name", 0, -1);}
		 $Suser =		sprintf("%-8s", $Suser);
			while(strlen($Suser)>8) {$Suser = substr("$Suser", 0, -1);}
		}
	else
		{	
			$Sfull_name=	sprintf("%-45s", $Sfull_name); 
		 while(mb_strlen($Sfull_name,'utf-8')>15) {$Sfull_name = mb_substr("$Sfull_name", 0, -1,'utf-8');}

			$Suser =	sprintf("%-24s", $Suser);
		 while(mb_strlen($Suser,'utf-8')>8) {$Suser = mb_substr("$Suser", 0, -1,'utf-8');}
		}

	$USERtime_M = ($Stime / 60);
	$USERtime_M_int = round($USERtime_M, 2);
	$USERtime_M_int = intval("$USERtime_M_int");
	$USERtime_S = ($USERtime_M - $USERtime_M_int);
	$USERtime_S = ($USERtime_S * 60);
	$USERtime_S = round($USERtime_S, 0);
	if ($USERtime_S < 10) {$USERtime_S = "0$USERtime_S";}
	$USERtime_MS = "$USERtime_M_int:$USERtime_S";
	$pfUSERtime_MS =		sprintf("%7s", $USERtime_MS);

	$USERtotTALK_M = ($Stalk_sec / 60);
	$USERtotTALK_M_int = round($USERtotTALK_M, 2);
	$USERtotTALK_M_int = intval("$USERtotTALK_M_int");
	$USERtotTALK_S = ($USERtotTALK_M - $USERtotTALK_M_int);
	$USERtotTALK_S = ($USERtotTALK_S * 60);
	$USERtotTALK_S = round($USERtotTALK_S, 0);
	if ($USERtotTALK_S < 10) {$USERtotTALK_S = "0$USERtotTALK_S";}
	$USERtotTALK_MS = "$USERtotTALK_M_int:$USERtotTALK_S";
	$pfUSERtotTALK_MS =		sprintf("%6s", $USERtotTALK_MS);

	$USERavgTALK_M = ($Stalk_avg / 60);
	$USERavgTALK_M_int = round($USERavgTALK_M, 2);
	$USERavgTALK_M_int = intval("$USERavgTALK_M_int");
	$USERavgTALK_S = ($USERavgTALK_M - $USERavgTALK_M_int);
	$USERavgTALK_S = ($USERavgTALK_S * 60);
	$USERavgTALK_S = round($USERavgTALK_S, 0);
	if ($USERavgTALK_S < 10) {$USERavgTALK_S = "0$USERavgTALK_S";}
	$USERavgTALK_MS = "$USERavgTALK_M_int:$USERavgTALK_S";
	$pfUSERavgTALK_MS =		sprintf("%6s", $USERavgTALK_MS);

	$USERtotPAUSE_M = ($Spause_sec / 60);
	$USERtotPAUSE_M_int = round($USERtotPAUSE_M, 2);
	$USERtotPAUSE_M_int = intval("$USERtotPAUSE_M_int");
	$USERtotPAUSE_S = ($USERtotPAUSE_M - $USERtotPAUSE_M_int);
	$USERtotPAUSE_S = ($USERtotPAUSE_S * 60);
	$USERtotPAUSE_S = round($USERtotPAUSE_S, 0);
	if ($USERtotPAUSE_S < 10) {$USERtotPAUSE_S = "0$USERtotPAUSE_S";}
	$USERtotPAUSE_MS = "$USERtotPAUSE_M_int:$USERtotPAUSE_S";
	$pfUSERtotPAUSE_MS =		sprintf("%6s", $USERtotPAUSE_MS);
	$PAUSEtotal[$m] = $pfUSERtotPAUSE_MS;

	$USERavgPAUSE_M = ($Spause_avg / 60);
	$USERavgPAUSE_M_int = round($USERavgPAUSE_M, 2);
	$USERavgPAUSE_M_int = intval("$USERavgPAUSE_M_int");
	$USERavgPAUSE_S = ($USERavgPAUSE_M - $USERavgPAUSE_M_int);
	$USERavgPAUSE_S = ($USERavgPAUSE_S * 60);
	$USERavgPAUSE_S = round($USERavgPAUSE_S, 0);
	if ($USERavgPAUSE_S < 10) {$USERavgPAUSE_S = "0$USERavgPAUSE_S";}
	$USERavgPAUSE_MS = "$USERavgPAUSE_M_int:$USERavgPAUSE_S";
	$pfUSERavgPAUSE_MS =		sprintf("%6s", $USERavgPAUSE_MS);

	$USERtotWAIT_M = ($Swait_sec / 60);
	$USERtotWAIT_M_int = round($USERtotWAIT_M, 2);
	$USERtotWAIT_M_int = intval("$USERtotWAIT_M_int");
	$USERtotWAIT_S = ($USERtotWAIT_M - $USERtotWAIT_M_int);
	$USERtotWAIT_S = ($USERtotWAIT_S * 60);
	$USERtotWAIT_S = round($USERtotWAIT_S, 0);
	if ($USERtotWAIT_S < 10) {$USERtotWAIT_S = "0$USERtotWAIT_S";}
	$USERtotWAIT_MS = "$USERtotWAIT_M_int:$USERtotWAIT_S";
	$pfUSERtotWAIT_MS =		sprintf("%6s", $USERtotWAIT_MS);

	$USERavgWAIT_M = ($Swait_avg / 60);
	$USERavgWAIT_M_int = round($USERavgWAIT_M, 2);
	$USERavgWAIT_M_int = intval("$USERavgWAIT_M_int");
	$USERavgWAIT_S = ($USERavgWAIT_M - $USERavgWAIT_M_int);
	$USERavgWAIT_S = ($USERavgWAIT_S * 60);
	$USERavgWAIT_S = round($USERavgWAIT_S, 0);
	if ($USERavgWAIT_S < 10) {$USERavgWAIT_S = "0$USERavgWAIT_S";}
	$USERavgWAIT_MS = "$USERavgWAIT_M_int:$USERavgWAIT_S";
	$pfUSERavgWAIT_MS =		sprintf("%6s", $USERavgWAIT_MS);
	
	$USERtotDISPO_M = ($Sdispo_sec / 60);
	$USERtotDISPO_M_int = round($USERtotDISPO_M, 2);
	$USERtotDISPO_M_int = intval("$USERtotDISPO_M_int");
	$USERtotDISPO_S = ($USERtotDISPO_M - $USERtotDISPO_M_int);
	$USERtotDISPO_S = ($USERtotDISPO_S * 60);
	$USERtotDISPO_S = round($USERtotDISPO_S, 0);
	if ($USERtotDISPO_S < 10) {$USERtotDISPO_S = "0$USERtotDISPO_S";}
	$USERtotDISPO_MS = "$USERtotDISPO_M_int:$USERtotDISPO_S";
	$pfUSERtotDISPO_MS =		sprintf("%6s", $USERtotDISPO_MS);

	$USERavgDISPO_M = ($Sdispo_avg / 60);
	$USERavgDISPO_M_int = round($USERavgDISPO_M, 2);
	$USERavgDISPO_M_int = intval("$USERavgDISPO_M_int");
	$USERavgDISPO_S = ($USERavgDISPO_M - $USERavgDISPO_M_int);
	$USERavgDISPO_S = ($USERavgDISPO_S * 60);
	$USERavgDISPO_S = round($USERavgDISPO_S, 0);
	if ($USERavgDISPO_S < 10) {$USERavgDISPO_S = "0$USERavgDISPO_S";}
	$USERavgDISPO_MS = "$USERavgDISPO_M_int:$USERavgDISPO_S";
	$pfUSERavgDISPO_MS =		sprintf("%6s", $USERavgDISPO_MS);

	$Toutput = "| $Sfull_name | <a href=\"./user_stats.php?user=$RAWuser\">$Suser</a> | $Scalls | $pfUSERtime_MS | $pfUSERtotPAUSE_MS | $pfUSERavgPAUSE_MS | $pfUSERtotWAIT_MS | $pfUSERavgWAIT_MS | $pfUSERtotTALK_MS | $pfUSERavgTALK_MS | $pfUSERtotDISPO_MS | $pfUSERavgDISPO_MS |$SstatusesHTML\n";

	$TOPsorted_output[$m] = $Toutput;

	if ($stage == 'ID')
		{$TOPsort[$m] =	'' . sprintf("%08s", $RAWuser) . '-----' . $m . '-----' . sprintf("%020s", $RAWuser);}
	if ($stage == 'CALLS')
		{$TOPsort[$m] =	'' . sprintf("%08s", $RAWcalls) . '-----' . $m . '-----' . sprintf("%020s", $RAWuser);}
	if ($stage == 'TIME')
		{$TOPsort[$m] =	'' . sprintf("%08s", $Stime) . '-----' . $m . '-----' . sprintf("%020s", $RAWuser);}
	if (!ereg("ID|TIME|CALLS",$stage))
		{echo "$Toutput";}

	$m++;
	}
### END loop through each user ###



### BEGIN sort through output to display properly ###
if (ereg("ID|TIME|CALLS",$stage))
	{
	if (ereg("ID",$stage))
		{sort($TOPsort, SORT_NUMERIC);}
	if (ereg("TIME|CALLS",$stage))
		{rsort($TOPsort, SORT_NUMERIC);}

	$m=0;
	while ($m < $k)
		{
		$sort_split = explode("-----",$TOPsort[$m]);
		$i = $sort_split[1];
		$sort_order[$m] = "$i";
		echo "$TOPsorted_output[$i]";
		$m++;
		}
	}
### END sort through output to display properly ###



###### LAST LINE FORMATTING ##########
### BEGIN loop through each status ###
$SUMstatusesHTML='';
$n=0;
while ($n < $j)
	{
	$Scalls=0;
	$Sstatus=$statusesARY[$n];
	$SUMstatusTXT='';
	### BEGIN loop through each stat line ###
	$i=0; $status_found=0;
	while ($i < $rows_to_print)
		{
		if ($Sstatus=="$status[$i]")
			{
			$Scalls =		($Scalls + $calls[$i]);
			$status_found++;
			}
		$i++;
		}
	### END loop through each stat line ###
	if ($status_found < 1)
		{
		$SUMstatusesHTML .= "        0 |";
		}
	else
		{
		$SUMstatusTXT = sprintf("%8s", $Scalls);
		$SUMstatusesHTML .= " $SUMstatusTXT |";
		}
	$n++;
	}
### END loop through each status ###


	$TOTcalls =	sprintf("%7s", $TOTcalls);
	$TOT_AGENTS = sprintf("%-4s", $m);

	$TOTtime_M = ($TOTtime / 60);
	$TOTtime_M_int = round($TOTtime_M, 2);
	$TOTtime_M_int = intval("$TOTtime_M_int");
	$TOTtime_S = ($TOTtime_M - $TOTtime_M_int);
	$TOTtime_S = ($TOTtime_S * 60);
	$TOTtime_S = round($TOTtime_S, 0);
	if ($TOTtime_S < 10) {$TOTtime_S = "0$TOTtime_S";}
	$TOTtime_MS = "$TOTtime_M_int:$TOTtime_S";
	$TOTtime_MS =		sprintf("%8s", $TOTtime_MS);
		while(strlen($TOTtime_MS)>8) {$TOTtime_MS = substr("$TOTtime_MS", 0, -1);}

	$TOTtotTALK_M = ($TOTtotTALK / 60);
	$TOTtotTALK_M_int = round($TOTtotTALK_M, 2);
	$TOTtotTALK_M_int = intval("$TOTtotTALK_M_int");
	$TOTtotTALK_S = ($TOTtotTALK_M - $TOTtotTALK_M_int);
	$TOTtotTALK_S = ($TOTtotTALK_S * 60);
	$TOTtotTALK_S = round($TOTtotTALK_S, 0);
	if ($TOTtotTALK_S < 10) {$TOTtotTALK_S = "0$TOTtotTALK_S";}
	$TOTtotTALK_MS = "$TOTtotTALK_M_int:$TOTtotTALK_S";
	$TOTtotTALK_MS =		sprintf("%8s", $TOTtotTALK_MS);
		while(strlen($TOTtotTALK_MS)>8) {$TOTtotTALK_MS = substr("$TOTtotTALK_MS", 0, -1);}

	if ($TOTtotDISPO < 1) {$TOTtotDISPO_M = '0';}
	else {$TOTtotDISPO_M = ($TOTtotDISPO / 60);}
	$TOTtotDISPO_M_int = round($TOTtotDISPO_M, 2);
	$TOTtotDISPO_M_int = intval("$TOTtotDISPO_M_int");
	$TOTtotDISPO_S = ($TOTtotDISPO_M - $TOTtotDISPO_M_int);
	$TOTtotDISPO_S = ($TOTtotDISPO_S * 60);
	$TOTtotDISPO_S = round($TOTtotDISPO_S, 0);
	if ($TOTtotDISPO_S < 10) {$TOTtotDISPO_S = "0$TOTtotDISPO_S";}
	$TOTtotDISPO_MS = "$TOTtotDISPO_M_int:$TOTtotDISPO_S";
	$TOTtotDISPO_MS =		sprintf("%8s", $TOTtotDISPO_MS);
		while(strlen($TOTtotDISPO_MS)>8) {$TOTtotDISPO_MS = substr("$TOTtotDISPO_MS", 0, -1);}

	if ($TOTtotPAUSE < 1) {$TOTtotPAUSE_M = '0';}
	else {$TOTtotPAUSE_M = ($TOTtotPAUSE / 60);}
	$TOTtotPAUSE_M_int = round($TOTtotPAUSE_M, 2);
	$TOTtotPAUSE_M_int = intval("$TOTtotPAUSE_M_int");
	$TOTtotPAUSE_S = ($TOTtotPAUSE_M - $TOTtotPAUSE_M_int);
	$TOTtotPAUSE_S = ($TOTtotPAUSE_S * 60);
	$TOTtotPAUSE_S = round($TOTtotPAUSE_S, 0);
	if ($TOTtotPAUSE_S < 10) {$TOTtotPAUSE_S = "0$TOTtotPAUSE_S";}
	$TOTtotPAUSE_MS = "$TOTtotPAUSE_M_int:$TOTtotPAUSE_S";
	$TOTtotPAUSE_MS =		sprintf("%8s", $TOTtotPAUSE_MS);
		while(strlen($TOTtotPAUSE_MS)>8) {$TOTtotPAUSE_MS = substr("$TOTtotPAUSE_MS", 0, -1);}

	if ($TOTtotWAIT < 1) {$TOTtotWAIT_M = '0';}
	else {$TOTtotWAIT_M = ($TOTtotWAIT / 60);}
	$TOTtotWAIT_M_int = round($TOTtotWAIT_M, 2);
	$TOTtotWAIT_M_int = intval("$TOTtotWAIT_M_int");
	$TOTtotWAIT_S = ($TOTtotWAIT_M - $TOTtotWAIT_M_int);
	$TOTtotWAIT_S = ($TOTtotWAIT_S * 60);
	$TOTtotWAIT_S = round($TOTtotWAIT_S, 0);
	if ($TOTtotWAIT_S < 10) {$TOTtotWAIT_S = "0$TOTtotWAIT_S";}
	$TOTtotWAIT_MS = "$TOTtotWAIT_M_int:$TOTtotWAIT_S";
	$TOTtotWAIT_MS =		sprintf("%8s", $TOTtotWAIT_MS);
		while(strlen($TOTtotWAIT_MS)>8) {$TOTtotWAIT_MS = substr("$TOTtotWAIT_MS", 0, -1);}

	if ($TOTtotTALK < 1) {$TOTavgTALK_M = '0';}
	else {$TOTavgTALK_M = ( ($TOTtotTALK / $TOTcalls) / 60);}
	$TOTavgTALK_M_int = round($TOTavgTALK_M, 2);
	$TOTavgTALK_M_int = intval("$TOTavgTALK_M_int");
	$TOTavgTALK_S = ($TOTavgTALK_M - $TOTavgTALK_M_int);
	$TOTavgTALK_S = ($TOTavgTALK_S * 60);
	$TOTavgTALK_S = round($TOTavgTALK_S, 0);
	if ($TOTavgTALK_S < 10) {$TOTavgTALK_S = "0$TOTavgTALK_S";}
	$TOTavgTALK_MS = "$TOTavgTALK_M_int:$TOTavgTALK_S";
	$TOTavgTALK_MS =		sprintf("%6s", $TOTavgTALK_MS);
		while(strlen($TOTavgTALK_MS)>6) {$TOTavgTALK_MS = substr("$TOTavgTALK_MS", 0, -1);}

	if ($TOTtotDISPO < 1) {$TOTavgDISPO_M = '0';}
	else {$TOTavgDISPO_M = ( ($TOTtotDISPO / $TOTcalls) / 60);}
	$TOTavgDISPO_M_int = round($TOTavgDISPO_M, 2);
	$TOTavgDISPO_M_int = intval("$TOTavgDISPO_M_int");
	$TOTavgDISPO_S = ($TOTavgDISPO_M - $TOTavgDISPO_M_int);
	$TOTavgDISPO_S = ($TOTavgDISPO_S * 60);
	$TOTavgDISPO_S = round($TOTavgDISPO_S, 0);
	if ($TOTavgDISPO_S < 10) {$TOTavgDISPO_S = "0$TOTavgDISPO_S";}
	$TOTavgDISPO_MS = "$TOTavgDISPO_M_int:$TOTavgDISPO_S";
	$TOTavgDISPO_MS =		sprintf("%6s", $TOTavgDISPO_MS);
		while(strlen($TOTavgDISPO_MS)>6) {$TOTavgDISPO_MS = substr("$TOTavgDISPO_MS", 0, -1);}

	if ($TOTtotPAUSE < 1) {$TOTavgPAUSE_M = '0';}
	else {$TOTavgPAUSE_M = ( ($TOTtotPAUSE / $TOTcalls) / 60);}
	$TOTavgPAUSE_M_int = round($TOTavgPAUSE_M, 2);
	$TOTavgPAUSE_M_int = intval("$TOTavgPAUSE_M_int");
	$TOTavgPAUSE_S = ($TOTavgPAUSE_M - $TOTavgPAUSE_M_int);
	$TOTavgPAUSE_S = ($TOTavgPAUSE_S * 60);
	$TOTavgPAUSE_S = round($TOTavgPAUSE_S, 0);
	if ($TOTavgPAUSE_S < 10) {$TOTavgPAUSE_S = "0$TOTavgPAUSE_S";}
	$TOTavgPAUSE_MS = "$TOTavgPAUSE_M_int:$TOTavgPAUSE_S";
	$TOTavgPAUSE_MS =		sprintf("%6s", $TOTavgPAUSE_MS);
		while(strlen($TOTavgPAUSE_MS)>6) {$TOTavgPAUSE_MS = substr("$TOTavgPAUSE_MS", 0, -1);}

	if ($TOTtotWAIT < 1) {$TOTavgWAIT_M = '0';}
	else {$TOTavgWAIT_M = ( ($TOTtotWAIT / $TOTcalls) / 60);}
	$TOTavgWAIT_M_int = round($TOTavgWAIT_M, 2);
	$TOTavgWAIT_M_int = intval("$TOTavgWAIT_M_int");
	$TOTavgWAIT_S = ($TOTavgWAIT_M - $TOTavgWAIT_M_int);
	$TOTavgWAIT_S = ($TOTavgWAIT_S * 60);
	$TOTavgWAIT_S = round($TOTavgWAIT_S, 0);
	if ($TOTavgWAIT_S < 10) {$TOTavgWAIT_S = "0$TOTavgWAIT_S";}
	$TOTavgWAIT_MS = "$TOTavgWAIT_M_int:$TOTavgWAIT_S";
	$TOTavgWAIT_MS =		sprintf("%6s", $TOTavgWAIT_MS);
		while(strlen($TOTavgWAIT_MS)>6) {$TOTavgWAIT_MS = substr("$TOTavgWAIT_MS", 0, -1);}


echo "+-----------------+----------+--------+---------+--------+--------+--------+--------+--------+--------+--------+--------+$statusesHEAD\n";
echo "|  TOTALS        AGENTS:$TOT_AGENTS | $TOTcalls| $TOTtime_MS|$TOTtotPAUSE_MS| $TOTavgPAUSE_MS |$TOTtotWAIT_MS| $TOTavgWAIT_MS |$TOTtotTALK_MS| $TOTavgTALK_MS |$TOTtotDISPO_MS| $TOTavgDISPO_MS |$SUMstatusesHTML\n";
echo "+----------------------------+--------+---------+--------+--------+--------+--------+--------+--------+--------+--------+$statusesHEAD\n";

echo "\n\n";















$sub_statuses='-';
$sub_statusesTXT='';
$sub_statusesHEAD='';
$sub_statusesHTML='';
$sub_statusesARY=$MT;
$j=0;
$PCusers='-';
$PCusersARY=$MT;
$PCuser_namesARY=$MT;
$k=0;
$stmt="select full_name,vicidial_users.user,sum(pause_sec),sub_status,sum(wait_sec + talk_sec + dispo_sec) from vicidial_users,vicidial_agent_log where event_time <= '$query_date_END' and event_time >= '$query_date_BEGIN' and vicidial_users.user=vicidial_agent_log.user and campaign_id='" . mysql_real_escape_string($group) . "' and pause_sec<36000 $ugSQL group by user,full_name,sub_status order by user,full_name,sub_status desc limit 100000;";
$rslt=mysql_query($stmt, $link);
if ($DB) {echo "$stmt\n";}
$subs_to_print = mysql_num_rows($rslt);
$i=0;
while ($i < $subs_to_print)
	{
	$row=mysql_fetch_row($rslt);
	$PCfull_name[$i] =	$row[0];
	$PCuser[$i] =		$row[1];
	$PCpause_sec[$i] =	$row[2];
	$sub_status[$i] =	$row[3];
	$PCnon_pause_sec[$i] =	$row[4];

#	echo "$sub_status[$i]|$PCpause_sec[$i]\n";
#	if ( (!eregi("-$sub_status[$i]-", $sub_statuses)) and (strlen($sub_status[$i])>0) )
	if (!eregi("-$sub_status[$i]-", $sub_statuses))
		{
		$sub_statusesTXT = sprintf("%8s", $sub_status[$i]);
		$sub_statusesHEAD .= "----------+";
		$sub_statusesHTML .= " $sub_statusesTXT |";
		$sub_statuses .= "$sub_status[$i]-";
		$sub_statusesARY[$j] = $sub_status[$i];
		$j++;
		}
	if (!eregi("-$PCuser[$i]-", $PCusers))
		{
		$PCusers .= "$PCuser[$i]-";
		$PCusersARY[$k] = $PCuser[$i];
		$PCuser_namesARY[$k] = $PCfull_name[$i];
		$k++;
		}

	$i++;
	}

echo "PAUSE CODE BREAKDOWN:\n";
echo "+-----------------+----------+--------+--------+--------+  +$sub_statusesHEAD\n";
echo "| USER NAME       | ID       | TOTAL  |NONPAUSE| PAUSE  |  |$sub_statusesHTML\n";
echo "+-----------------+----------+--------+--------+--------+  +$sub_statusesHEAD\n";


### BEGIN loop through each user ###
$m=0;
$Suser_ct = count($usersARY);
$TOTtotNONPAUSE = 0;
$TOTtotTOTAL = 0;

while ($m < $k)
	{
	$d=0;
	while ($d < $Suser_ct)
		{
		if ($usersARY[$d] === "$PCusersARY[$m]")
			{$pcPAUSEtotal = $PAUSEtotal[$d];}
		$d++;
		}
	$Suser=$PCusersARY[$m];
	$Sfull_name=$PCuser_namesARY[$m];
	$Spause_sec=0;
	$Snon_pause_sec=0;
	$Stotal_sec=0;
	$SstatusesHTML='';

	### BEGIN loop through each status ###
	$n=0;
	while ($n < $j)
		{
		$Sstatus=$sub_statusesARY[$n];
		$SstatusTXT='';
		### BEGIN loop through each stat line ###
		$i=0; $status_found=0;
		while ($i < $subs_to_print)
			{
			if ( ($Suser=="$PCuser[$i]") and ($Sstatus=="$sub_status[$i]") )
				{
				$Spause_sec =	($Spause_sec + $PCpause_sec[$i]);
				$Snon_pause_sec =	($Snon_pause_sec + $PCnon_pause_sec[$i]);
				$Stotal_sec =	($Stotal_sec + $PCnon_pause_sec[$i] + $PCpause_sec[$i]);

				$USERcodePAUSE_M = ($PCpause_sec[$i] / 60);
				$USERcodePAUSE_M_int = round($USERcodePAUSE_M, 2);
				$USERcodePAUSE_M_int = intval("$USERcodePAUSE_M_int");
				$USERcodePAUSE_S = ($USERcodePAUSE_M - $USERcodePAUSE_M_int);
				$USERcodePAUSE_S = ($USERcodePAUSE_S * 60);
				$USERcodePAUSE_S = round($USERcodePAUSE_S, 0);
				if ($USERcodePAUSE_S < 10) {$USERcodePAUSE_S = "0$USERcodePAUSE_S";}
				$USERcodePAUSE_MS = "$USERcodePAUSE_M_int:$USERcodePAUSE_S";
				$pfUSERcodePAUSE_MS =		sprintf("%6s", $USERcodePAUSE_MS);

				$SstatusTXT = sprintf("%8s", $pfUSERcodePAUSE_MS);
				$SstatusesHTML .= " $SstatusTXT |";
				$status_found++;
				}
			$i++;
			}
		if ($status_found < 1)
			{
			$SstatusesHTML .= "        0 |";
			}
		### END loop through each stat line ###
		$n++;
		}
	### END loop through each status ###
	$TOTtotPAUSE=($TOTtotPAUSE + $Spause_sec);

	if ($non_latin < 1)
		{
		$Sfull_name=	sprintf("%-15s", $Sfull_name); 
		while(strlen($Sfull_name)>15) {$Sfull_name = substr("$Sfull_name", 0, -1);}
		$Suser =		sprintf("%-8s", $Suser);
		while(strlen($Suser)>8) {$Suser = substr("$Suser", 0, -1);}
		}
	else
		{
		$Sfull_name=	sprintf("%-45s", $Sfull_name); 
		while(mb_strlen($Sfull_name,'utf-8')>15) {$Sfull_name = mb_substr("$Sfull_name", 0, -1,'utf-8');}

		$Suser =	sprintf("%-24s", $Suser);
		while(mb_strlen($Suser,'utf-8')>8) {$Suser = mb_substr("$Suser", 0, -1,'utf-8');}
		}

	$TOTtotNONPAUSE = ($TOTtotNONPAUSE + $Snon_pause_sec);
	$TOTtotTOTAL = ($TOTtotTOTAL + $Stotal_sec);

	$USERtotPAUSE_M = ($Spause_sec / 60);
	$USERtotPAUSE_M_int = round($USERtotPAUSE_M, 2);
	$USERtotPAUSE_M_int = intval("$USERtotPAUSE_M_int");
	$USERtotPAUSE_S = ($USERtotPAUSE_M - $USERtotPAUSE_M_int);
	$USERtotPAUSE_S = ($USERtotPAUSE_S * 60);
	$USERtotPAUSE_S = round($USERtotPAUSE_S, 0);
	if ($USERtotPAUSE_S < 10) {$USERtotPAUSE_S = "0$USERtotPAUSE_S";}
	$USERtotPAUSE_MS = "$USERtotPAUSE_M_int:$USERtotPAUSE_S";
	$pfUSERtotPAUSE_MS =		sprintf("%6s", $USERtotPAUSE_MS);

	$USERtotNONPAUSE_M = ($Snon_pause_sec / 60);
	$USERtotNONPAUSE_M_int = round($USERtotNONPAUSE_M, 2);
	$USERtotNONPAUSE_M_int = intval("$USERtotNONPAUSE_M_int");
	$USERtotNONPAUSE_S = ($USERtotNONPAUSE_M - $USERtotNONPAUSE_M_int);
	$USERtotNONPAUSE_S = ($USERtotNONPAUSE_S * 60);
	$USERtotNONPAUSE_S = round($USERtotNONPAUSE_S, 0);
	if ($USERtotNONPAUSE_S < 10) {$USERtotNONPAUSE_S = "0$USERtotNONPAUSE_S";}
	$USERtotNONPAUSE_MS = "$USERtotNONPAUSE_M_int:$USERtotNONPAUSE_S";
	$pfUSERtotNONPAUSE_MS =		sprintf("%6s", $USERtotNONPAUSE_MS);

	$USERtotTOTAL_M = ($Stotal_sec / 60);
	$USERtotTOTAL_M_int = round($USERtotTOTAL_M, 2);
	$USERtotTOTAL_M_int = intval("$USERtotTOTAL_M_int");
	$USERtotTOTAL_S = ($USERtotTOTAL_M - $USERtotTOTAL_M_int);
	$USERtotTOTAL_S = ($USERtotTOTAL_S * 60);
	$USERtotTOTAL_S = round($USERtotTOTAL_S, 0);
	if ($USERtotTOTAL_S < 10) {$USERtotTOTAL_S = "0$USERtotTOTAL_S";}
	$USERtotTOTAL_MS = "$USERtotTOTAL_M_int:$USERtotTOTAL_S";
	$pfUSERtotTOTAL_MS =		sprintf("%6s", $USERtotTOTAL_MS);

	$BOTTOMoutput = "| $Sfull_name | $Suser | $pfUSERtotTOTAL_MS | $pfUSERtotNONPAUSE_MS | $pfUSERtotPAUSE_MS |  |$SstatusesHTML\n";

	$BOTTOMsorted_output[$m] = $BOTTOMoutput;

#	if (!ereg("ID|TIME|CALLS",$stage))
#		{
		echo "$BOTTOMoutput";
#		}

	$m++;
	}
### END loop through each user ###



### BEGIN sort through output to display properly ###
#if (ereg("ID|TIME|CALLS",$stage))
#	{
#	$n=0;
#	while ($n <= $m)
#		{
#		$i = $sort_order[$m];
#		echo "$BOTTOMsorted_output[$i]";
#		$m--;
#		}
#	}
### END sort through output to display properly ###



###### LAST LINE FORMATTING ##########
### BEGIN loop through each status ###
$SUMstatusesHTML='';
$TOTtotPAUSE=0;
$n=0;
while ($n < $j)
	{
	$Scalls=0;
	$Sstatus=$sub_statusesARY[$n];
	$SUMstatusTXT='';
	### BEGIN loop through each stat line ###
	$i=0; $status_found=0;
	while ($i < $subs_to_print)
		{
		if ($Sstatus=="$sub_status[$i]")
			{
			$Scalls =		($Scalls + $PCpause_sec[$i]);
			$status_found++;
			}
		$i++;
		}
	### END loop through each stat line ###
	if ($status_found < 1)
		{
		$SUMstatusesHTML .= "        0 |";
		}
	else
		{
		$TOTtotPAUSE = ($TOTtotPAUSE + $Scalls);

		$USERsumstatPAUSE_M = ($Scalls / 60);
		$USERsumstatPAUSE_M_int = round($USERsumstatPAUSE_M, 2);
		$USERsumstatPAUSE_M_int = intval("$USERsumstatPAUSE_M_int");
		$USERsumstatPAUSE_S = ($USERsumstatPAUSE_M - $USERsumstatPAUSE_M_int);
		$USERsumstatPAUSE_S = ($USERsumstatPAUSE_S * 60);
		$USERsumstatPAUSE_S = round($USERsumstatPAUSE_S, 0);
		if ($USERsumstatPAUSE_S < 10) {$USERsumstatPAUSE_S = "0$USERsumstatPAUSE_S";}
		$USERsumstatPAUSE_MS = "$USERsumstatPAUSE_M_int:$USERsumstatPAUSE_S";
		$pfUSERsumstatPAUSE_MS =		sprintf("%6s", $USERsumstatPAUSE_MS);

		$SUMstatusTXT = sprintf("%8s", $pfUSERsumstatPAUSE_MS);
		$SUMstatusesHTML .= " $SUMstatusTXT |";
		}
	$n++;
	}
### END loop through each status ###

	$TOT_AGENTS = sprintf("%-4s", $m);

	$TOTtotPAUSE_M = ($TOTtotPAUSE / 60);
	$TOTtotPAUSE_M_int = round($TOTtotPAUSE_M, 2);
	$TOTtotPAUSE_M_int = intval("$TOTtotPAUSE_M_int");
	$TOTtotPAUSE_S = ($TOTtotPAUSE_M - $TOTtotPAUSE_M_int);
	$TOTtotPAUSE_S = ($TOTtotPAUSE_S * 60);
	$TOTtotPAUSE_S = round($TOTtotPAUSE_S, 0);
	if ($TOTtotPAUSE_S < 10) {$TOTtotPAUSE_S = "0$TOTtotPAUSE_S";}
	$TOTtotPAUSE_MS = "$TOTtotPAUSE_M_int:$TOTtotPAUSE_S";
	$TOTtotPAUSE_MS =		sprintf("%8s", $TOTtotPAUSE_MS);
		while(strlen($TOTtotPAUSE_MS)>8) {$TOTtotPAUSE_MS = substr("$TOTtotPAUSE_MS", 0, -1);}

	$TOTtotNONPAUSE_M = ($TOTtotNONPAUSE / 60);
	$TOTtotNONPAUSE_M_int = round($TOTtotNONPAUSE_M, 2);
	$TOTtotNONPAUSE_M_int = intval("$TOTtotNONPAUSE_M_int");
	$TOTtotNONPAUSE_S = ($TOTtotNONPAUSE_M - $TOTtotNONPAUSE_M_int);
	$TOTtotNONPAUSE_S = ($TOTtotNONPAUSE_S * 60);
	$TOTtotNONPAUSE_S = round($TOTtotNONPAUSE_S, 0);
	if ($TOTtotNONPAUSE_S < 10) {$TOTtotNONPAUSE_S = "0$TOTtotNONPAUSE_S";}
	$TOTtotNONPAUSE_MS = "$TOTtotNONPAUSE_M_int:$TOTtotNONPAUSE_S";
	$TOTtotNONPAUSE_MS =		sprintf("%8s", $TOTtotNONPAUSE_MS);
		while(strlen($TOTtotNONPAUSE_MS)>8) {$TOTtotNONPAUSE_MS = substr("$TOTtotNONPAUSE_MS", 0, -1);}

	$TOTtotTOTAL_M = ($TOTtotTOTAL / 60);
	$TOTtotTOTAL_M_int = round($TOTtotTOTAL_M, 2);
	$TOTtotTOTAL_M_int = intval("$TOTtotTOTAL_M_int");
	$TOTtotTOTAL_S = ($TOTtotTOTAL_M - $TOTtotTOTAL_M_int);
	$TOTtotTOTAL_S = ($TOTtotTOTAL_S * 60);
	$TOTtotTOTAL_S = round($TOTtotTOTAL_S, 0);
	if ($TOTtotTOTAL_S < 10) {$TOTtotTOTAL_S = "0$TOTtotTOTAL_S";}
	$TOTtotTOTAL_MS = "$TOTtotTOTAL_M_int:$TOTtotTOTAL_S";
	$TOTtotTOTAL_MS =		sprintf("%8s", $TOTtotTOTAL_MS);
		while(strlen($TOTtotTOTAL_MS)>8) {$TOTtotTOTAL_MS = substr("$TOTtotTOTAL_MS", 0, -1);}



echo "+-----------------+----------+--------+--------+--------+  +$sub_statusesHEAD\n";
echo "|  TOTALS        AGENTS:$TOT_AGENTS |$TOTtotTOTAL_MS|$TOTtotNONPAUSE_MS|$TOTtotPAUSE_MS|  |$SUMstatusesHTML\n";
echo "+----------------------------+--------+--------+--------+  +$sub_statusesHEAD\n";

echo "\n\n";

}


?>

</TD></TR></TABLE>

</BODY></HTML>