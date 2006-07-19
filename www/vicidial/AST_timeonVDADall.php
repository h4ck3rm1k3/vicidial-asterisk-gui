<? 
# AST_timeonVDADall.php
# 
# Copyright (C) 2006  Matt Florell <vicidial@gmail.com>    LICENSE: GPLv2
#
# live real-time stats for the VICIDIAL Auto-Dialer all servers
# 
# changes:
# 50406-0920 - Added Paused agents < 1 min (Chris Doyle)
# 51130-1218 - Modified layout and info to show all servers in a vicidial system
# 60421-1043 - check GET/POST vars lines with isset to not trigger PHP NOTICES
# 60511-1343 - Added leads and drop info at the top of the screen
# 60608-1539 - Fixed CLOSER tallies for active calls
# 60619-1658 - Added variable filtering to eliminate SQL injection attack threat
#            - Added required user/pass to gain access to this page
# 60626-1453 - Added display of system load to bottom (Angelito Manansala)
#

header ("Content-type: text/html; charset=utf-8");

require("dbconnect.php");

$PHP_AUTH_USER=$_SERVER['PHP_AUTH_USER'];
$PHP_AUTH_PW=$_SERVER['PHP_AUTH_PW'];
$PHP_SELF=$_SERVER['PHP_SELF'];
if (isset($_GET["server_ip"]))				{$server_ip=$_GET["server_ip"];}
	elseif (isset($_POST["server_ip"]))		{$server_ip=$_POST["server_ip"];}
if (isset($_GET["reset_counter"]))				{$reset_counter=$_GET["reset_counter"];}
	elseif (isset($_POST["reset_counter"]))		{$reset_counter=$_POST["reset_counter"];}
if (isset($_GET["RR"]))				{$RR=$_GET["RR"];}
	elseif (isset($_POST["RR"]))		{$RR=$_POST["RR"];}
if (isset($_GET["group"]))				{$group=$_GET["group"];}
	elseif (isset($_POST["group"]))		{$group=$_POST["group"];}
if (isset($_GET["DB"]))				{$DB=$_GET["DB"];}
	elseif (isset($_POST["DB"]))		{$DB=$_POST["DB"];}
if (isset($_GET["submit"]))				{$submit=$_GET["submit"];}
	elseif (isset($_POST["submit"]))		{$submit=$_POST["submit"];}
if (isset($_GET["SUBMIT"]))				{$SUBMIT=$_GET["SUBMIT"];}
	elseif (isset($_POST["SUBMIT"]))		{$SUBMIT=$_POST["SUBMIT"];}

if (!isset($group))   {$group='';}

function get_server_load($windows = false) {
$os = strtolower(PHP_OS);
if(strpos($os, "win") === false) {
if(file_exists("/proc/loadavg")) {
$load = file_get_contents("/proc/loadavg");
$load = explode(' ', $load);
return $load[0];
}
elseif(function_exists("shell_exec")) {
$load = explode(' ', `uptime`);
return $load[count($load)-1];
}
else {
return false;
}
}
elseif($windows) {
if(class_exists("COM")) {
$wmi = new COM("WinMgmts:\\\\.");
$cpus = $wmi->InstancesOf("Win32_Processor");

$cpuload = 0;
$i = 0;
while ($cpu = $cpus->Next()) {
$cpuload += $cpu->LoadPercentage;
$i++;
}

$cpuload = round($cpuload / $i, 2);
return "$cpuload%";
}
else {
return false;
}
}
}

$load_ave = get_server_load(true);


$PHP_AUTH_USER = ereg_replace("[^0-9a-zA-Z]","",$PHP_AUTH_USER);
$PHP_AUTH_PW = ereg_replace("[^0-9a-zA-Z]","",$PHP_AUTH_PW);

	$stmt="SELECT count(*) from vicidial_users where user='$PHP_AUTH_USER' and pass='$PHP_AUTH_PW' and user_level > 6;";
	if ($DB) {echo "|$stmt|\n";}
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

$NOW_TIME = date("Y-m-d H:i:s");
$NOW_DAY = date("Y-m-d");
$NOW_HOUR = date("H:i:s");
$STARTtime = date("U");
$epochSIXhoursAGO = ($STARTtime - 21600);
$timeSIXhoursAGO = date("Y-m-d H:i:s",$epochSIXhoursAGO);

$stmt="select campaign_id from vicidial_campaigns where active='Y';";
$rslt=mysql_query($stmt, $link);
if (!isset($DB))   {$DB=0;}
if ($DB) {echo "$stmt\n";}
$groups_to_print = mysql_num_rows($rslt);
$i=0;
while ($i < $groups_to_print)
	{
	$row=mysql_fetch_row($rslt);
	$groups[$i] =$row[0];
	$i++;
	}

if (!isset($RR))   {$RR=40;}

$NFB = '<b><font size=6 face="courier">';
$NFE = '</font></b>';
$F=''; $FG=''; $B=''; $BG='';
$reset_counter++;

if (!isset($reset_counter))   {$reset_counter=0;}
if ($reset_counter > 7)
	{
	$reset_counter=0;
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
   .yellow {color: black; background-color: yellow}
   .orange {color: black; background-color: orange}

   .r1 {color: black; background-color: #FFCCCC}
   .r2 {color: black; background-color: #FF9999}
   .r3 {color: black; background-color: #FF6666}
   .r4 {color: white; background-color: #FF0000}
   .b1 {color: black; background-color: #CCCCFF}
   .b2 {color: black; background-color: #9999FF}
   .b3 {color: black; background-color: #6666FF}
   .b4 {color: white; background-color: #0000FF}
-->
 </STYLE>

<? 
echo "<META HTTP-EQUIV=\"Content-Type\" CONTENT=\"text/html; charset=utf-8\">\n";
echo"<META HTTP-EQUIV=Refresh CONTENT=\"$RR; URL=$PHP_SELF?RR=$RR&DB=$DB&group=$group\">\n";
echo "<TITLE>VICIDIAL: Time On VDAD Campaign: $group</TITLE></HEAD><BODY BGCOLOR=WHITE>\n";
echo "<FORM ACTION=\"$PHP_SELF\" METHOD=GET>\n";
echo "VICIDIAL: Realtime Campaign: \n";
echo "<INPUT TYPE=HIDDEN NAME=RR VALUE=4>\n";
echo "<INPUT TYPE=HIDDEN NAME=DB VALUE=\"$DB\">\n";
echo "<SELECT SIZE=1 NAME=group>\n";
	$o=0;
	while ($groups_to_print > $o)
	{
		if ($groups[$o] == $group) {echo "<option selected value=\"$groups[$o]\">$groups[$o]</option>\n";}
		  else {echo "<option value=\"$groups[$o]\">$groups[$o]</option>\n";}
		$o++;
	}
echo "</SELECT>\n";
echo "<INPUT type=submit NAME=SUBMIT VALUE=SUBMIT><FONT FACE=\"ARIAL,HELVETICA\" COLOR=BLACK SIZE=2> &nbsp; &nbsp; &nbsp; &nbsp; \n";
echo "<a href=\"$PHP_SELF?group=$group&RR=40&DB=$DB\">STOP</a> | <a href=\"$PHP_SELF?group=$group&RR=4&DB=$DB\">GO</a>";
echo " &nbsp; &nbsp; &nbsp; &nbsp; <a href=\"./admin.php?ADD=34&campaign_id=$group\">MODIFY</a> | <a href=\"./server_stats.php\">REPORTS</a> </FONT>\n";
echo "\n\n";


if (!$group) {echo "<BR><BR>please select a campaign from the pulldown above</FORM>\n"; exit;}
else
{
$stmt="select auto_dial_level,dial_status_a,dial_status_b,dial_status_c,dial_status_d,dial_status_e,lead_order,lead_filter_id,hopper_level from vicidial_campaigns where campaign_id='" . mysql_real_escape_string($group) . "';";
$rslt=mysql_query($stmt, $link);
$row=mysql_fetch_row($rslt);
$HOPlev = $row[8];

echo "<BR><table cellpadding=0 cellspacing=0><TR>";
echo "<TD ALIGN=RIGHT><font size=2><B>DIAL LEVEL:</B></TD><TD ALIGN=LEFT><font size=2>&nbsp; $row[0]&nbsp; &nbsp; </TD>";
echo "<TD ALIGN=RIGHT><font size=2><B>STATUSES:</B></TD><TD ALIGN=LEFT><font size=2>&nbsp; $row[1], $row[2], $row[3], $row[4], $row[5] &nbsp; &nbsp; </TD>";
echo "<TD ALIGN=RIGHT><font size=2><B>ORDER:</B></TD><TD ALIGN=LEFT><font size=2>&nbsp; $row[6] &nbsp; &nbsp; </TD>";
echo "<TD ALIGN=RIGHT><font size=2><B>FILTER:</B></TD><TD ALIGN=LEFT><font size=2>&nbsp; $row[7] &nbsp; &nbsp; </TD>";
echo "</TR>";

$stmt="select count(*) from vicidial_hopper where campaign_id='" . mysql_real_escape_string($group) . "';";
$rslt=mysql_query($stmt, $link);
$row=mysql_fetch_row($rslt);
$VDhop = $row[0];

$stmt="select dialable_leads,calls_today,drops_today,drops_today_pct from vicidial_campaign_stats where campaign_id='" . mysql_real_escape_string($group) . "';";
$rslt=mysql_query($stmt, $link);
$row=mysql_fetch_row($rslt);
$DAleads = $row[0];
$callsTODAY = $row[1];
$dropsTODAY = $row[2];
$drpctTODAY = $row[3];

echo "<TR>";
echo "<TD ALIGN=RIGHT><font size=2><B>HOPPER LEVEL:</B></TD><TD ALIGN=LEFT><font size=2>&nbsp; $HOPlev &nbsp; &nbsp; </TD>";
echo "<TD ALIGN=RIGHT><font size=2><B>LEADS IN HOPPER:</B></TD><TD ALIGN=LEFT><font size=2>&nbsp; $VDhop &nbsp; &nbsp; </TD>";
echo "<TD ALIGN=RIGHT><font size=2><B>DIALABLE LEADS:</B></TD><TD ALIGN=LEFT><font size=2>&nbsp; $DAleads &nbsp; &nbsp; </TD>";
echo "<TD ALIGN=CENTER COLSPAN=2><font size=2> &nbsp; <B> TIME:</B> </TD>";
echo "</TR>";
echo "<TR>";
echo "<TD ALIGN=RIGHT><font size=2><B>CALLS TODAY:</B></TD><TD ALIGN=LEFT><font size=2>&nbsp; $callsTODAY &nbsp; &nbsp; </TD>";
echo "<TD ALIGN=RIGHT><font size=2><B>CALLS DROPPED:</B></TD><TD ALIGN=LEFT><font size=2>&nbsp; $dropsTODAY &nbsp; &nbsp; </TD>";
echo "<TD ALIGN=RIGHT><font size=2><B>DROPPED PERCENT:</B></TD><TD ALIGN=LEFT><font size=2>&nbsp; $drpctTODAY% &nbsp; &nbsp; </TD>";
echo "<TD ALIGN=CENTER COLSPAN=2><font size=2> &nbsp; $NOW_TIME </TD>";
echo "</TR></TABLE>";


echo "</FORM>\n\n";
}
###################################################################################
###### OUTBOUND CALLS
###################################################################################
if (eregi("CLOSER",$group))
	{
	$stmt="select closer_campaigns from vicidial_campaigns where campaign_id='" . mysql_real_escape_string($group) . "';";
	$rslt=mysql_query($stmt, $link);
	$row=mysql_fetch_row($rslt);
	$closer_campaigns = preg_replace("/^ | -$/","",$row[0]);
	$closer_campaigns = preg_replace("/ /","','",$closer_campaigns);
	$closer_campaigns = "'$closer_campaigns'";

	$stmt="select status from vicidial_auto_calls where status NOT IN('XFER') and ( (call_type='IN' and campaign_id IN($closer_campaigns)) or (campaign_id='" . mysql_real_escape_string($group) . "' and call_type='OUT') );";
	}
else
	{$stmt="select status from vicidial_auto_calls where status NOT IN('XFER') and campaign_id='" . mysql_real_escape_string($group) . "';";}
$rslt=mysql_query($stmt, $link);
if ($DB) {echo "$stmt\n";}
$parked_to_print = mysql_num_rows($rslt);
	if ($parked_to_print > 0)
	{
	$i=0;
	$out_total=0;
	$out_ring=0;
	$out_live=0;
	while ($i < $parked_to_print)
		{
		$row=mysql_fetch_row($rslt);

		if (eregi("LIVE",$row[0])) 
			{$out_live++;}
		else
			{
			if (eregi("CLOSER",$row[0])) 
				{$nothing=1;}
			else 
				{$out_ring++;}
			}
		$out_total++;
		$i++;
		}

		if ($out_live > 0) {$F='<FONT class="r1">'; $FG='</FONT>';}
		if ($out_live > 4) {$F='<FONT class="r2">'; $FG='</FONT>';}
		if ($out_live > 9) {$F='<FONT class="r3">'; $FG='</FONT>';}
		if ($out_live > 14) {$F='<FONT class="r4">'; $FG='</FONT>';}

		if (eregi("CLOSER",$group))
			{echo "$NFB$out_total$NFE current active calls&nbsp; &nbsp; &nbsp; \n";}
		else
			{echo "$NFB$out_total$NFE calls being placed &nbsp; &nbsp; &nbsp; \n";}
		
		echo "$NFB$out_ring$NFE calls ringing &nbsp; &nbsp; &nbsp; &nbsp; \n";
		echo "$NFB$F &nbsp;$out_live $FG$NFE calls waiting for agents &nbsp; &nbsp; &nbsp; \n";
		}
	else
	{
	echo " NO LIVE CALLS WAITING \n";
	}


###################################################################################
###### TIME ON SYSTEM
###################################################################################

$agent_incall=0;
$agent_ready=0;
$agent_paused=0;
$agent_total=0;

$Aecho = '';
$Aecho .= "VICIDIAL: Agents Time On Calls Campaign: $group                      $NOW_TIME\n\n";
$Aecho .= "+------------|--------+-----------+--------+-----------------+-----------------+---------+------------+\n";
$Aecho .= "| STATION    | USER   | SESSIONID | STATUS | SERVER IP       | CALL SERVER IP  | MM:SS   | CAMPAIGN   |\n";
$Aecho .= "+------------|--------+-----------+--------+-----------------+-----------------+---------+------------+\n";


$stmt="select extension,user,conf_exten,status,server_ip,UNIX_TIMESTAMP(last_call_time),UNIX_TIMESTAMP(last_call_finish),call_server_ip,campaign_id from vicidial_live_agents where campaign_id='" . mysql_real_escape_string($group) . "' order by status,last_call_time;";
$rslt=mysql_query($stmt, $link);
if ($DB) {echo "$stmt\n";}
$talking_to_print = mysql_num_rows($rslt);
	if ($talking_to_print > 0)
	{
	$i=0;
	$agentcount=0;
	while ($i < $talking_to_print)
		{
		$row=mysql_fetch_row($rslt);
			if (eregi("READY|PAUSED",$row[4]))
			{
			$row[5]=$row[6];
			}
		$extension =		sprintf("%-10s", $row[0]);
		$user =				sprintf("%-6s", $row[1]);
		$sessionid =		sprintf("%-9s", $row[2]);
		$status =			sprintf("%-6s", $row[3]);
		$server_ip =		sprintf("%-15s", $row[4]);
		$call_server_ip =	sprintf("%-15s", $row[7]);
		$campaign_id =		sprintf("%-10s", $row[8]);
		$call_time_S = ($STARTtime - $row[5]);

		$call_time_M = ($call_time_S / 60);
		$call_time_M = round($call_time_M, 2);
		$call_time_M_int = intval("$call_time_M");
		$call_time_SEC = ($call_time_M - $call_time_M_int);
		$call_time_SEC = ($call_time_SEC * 60);
		$call_time_SEC = round($call_time_SEC, 0);
		if ($call_time_SEC < 10) {$call_time_SEC = "0$call_time_SEC";}
		$call_time_MS = "$call_time_M_int:$call_time_SEC";
		$call_time_MS =		sprintf("%7s", $call_time_MS);
		$G = '';		$EG = '';
		if ($call_time_M_int >= 5) {$G='<SPAN class="purple"><B>'; $EG='</B></SPAN>';}
#		if ($call_time_M_int >= 10) {$G='<SPAN class="purple"><B>'; $EG='</B></SPAN>';}
		if (eregi("PAUSED",$row[3])) 
			{
			if ($call_time_M_int >= 5) 
				{$i++; continue;} 
			else
				{$G='<SPAN class="yellow"><B>'; $EG='</B></SPAN>'; $agent_paused++;  $agent_total++;}
			}
#		if ( (strlen($row[7])> 4) and ($row[7] != "$row[4]") )
#				{$G='<SPAN class="orange"><B>'; $EG='</B></SPAN>';}

		if ( (eregi("INCALL",$status)) or (eregi("QUEUE",$status)) ) {$agent_incall++;  $agent_total++;}
		if ( (eregi("READY",$status)) or (eregi("CLOSER",$status)) ) {$agent_ready++;  $agent_total++;}
		if ( (eregi("READY",$status)) or (eregi("CLOSER",$status)) ) {$G='<SPAN class="blue"><B>'; $EG='</B></SPAN>';}

		$agentcount++;
		$Aecho .= "| $G$extension$EG | <a href=\"./user_status.php?user=$user\" target=\"_blank\">$G$user$EG</a> | $G$sessionid$EG | $G$status$EG | $G$server_ip$EG | $G$call_server_ip$EG | $G$call_time_MS$EG | $G$campaign_id$EG |\n";

		$i++;
		}

		$Aecho .= "+------------|--------+-----------+--------+-----------------+-----------------+---------+------------+\n";
		$Aecho .= "  $agentcount agents logged in on all servers\n";
		$Aecho .= "  System Load Average: $load_ave\n\n";

		$Aecho .= "  <SPAN class=\"yellow\"><B>          </SPAN> - Paused agents</B>\n";
	#	$Aecho .= "  <SPAN class=\"orange\"><B>          </SPAN> - Balanced call</B>\n";
		$Aecho .= "  <SPAN class=\"blue\"><B>          </SPAN> - Agent waiting for call</B>\n";
		$Aecho .= "  <SPAN class=\"purple\"><B>          </SPAN> - Over 5 minutes on call</B>\n";

		if ($agent_ready > 0) {$B='<FONT class="b1">'; $BG='</FONT>';}
		if ($agent_ready > 4) {$B='<FONT class="b2">'; $BG='</FONT>';}
		if ($agent_ready > 9) {$B='<FONT class="b3">'; $BG='</FONT>';}
		if ($agent_ready > 14) {$B='<FONT class="b4">'; $BG='</FONT>';}


		echo "\n<BR>\n";

		echo "$NFB$agent_total$NFE agents logged in &nbsp; &nbsp; &nbsp; &nbsp; \n";
		echo "$NFB$agent_incall$NFE agents in calls &nbsp; &nbsp; &nbsp; \n";
		echo "$NFB$B &nbsp;$agent_ready $BG$NFE agents waiting &nbsp; &nbsp; &nbsp; \n";
		echo "$NFB$agent_paused$NFE paused agents &nbsp; &nbsp; &nbsp; \n";
		
		echo "<PRE><FONT SIZE=2>";
		echo "";
		echo "$Aecho";
	}
	else
	{
	echo " NO AGENTS ON CALLS \n";
	}

?>
</PRE>

</BODY></HTML>
