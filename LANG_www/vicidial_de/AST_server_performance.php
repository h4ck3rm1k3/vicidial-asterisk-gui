<? 
# AST_server_performance.php
# 
# Copyright (C) 2006  Matt Florell <vicidial@gmail.com>    LICENSE: GPLv2
#
# CHANGES
#
# 60619-1732 - Added variable filtering to eliminate SQL injection attack threat
#            - Added required user/pass to gain access to this page
#

require("dbconnect.php");

$PHP_AUTH_USER=$_SERVER['PHP_AUTH_USER'];
$PHP_AUTH_PW=$_SERVER['PHP_AUTH_PW'];
$PHP_SELF=$_SERVER['PHP_SELF'];
if (isset($_GET["query_date"]))				{$query_date=$_GET["query_date"];}
	elseif (isset($_POST["query_date"]))	{$query_date=$_POST["query_date"];}
if (isset($_GET["group"]))				{$group=$_GET["group"];}
	elseif (isset($_POST["group"]))		{$group=$_POST["group"];}
if (isset($_GET["shift"]))				{$shift=$_GET["shift"];}
	elseif (isset($_POST["shift"]))		{$shift=$_POST["shift"];}
if (isset($_GET["submit"]))				{$submit=$_GET["submit"];}
	elseif (isset($_POST["submit"]))	{$submit=$_POST["submit"];}
if (isset($_GET["SUBMIT"]))				{$SUBMIT=$_GET["SUBMIT"];}
	elseif (isset($_POST["SUBMIT"]))	{$SUBMIT=$_POST["SUBMIT"];}

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
    echo "Unzulässiges Username/Kennwort:|$PHP_AUTH_USER|$PHP_AUTH_PW|\n";
    exit;
	}

# path from root to where ploticus files will be stored
$PLOTroot = "vicidial/ploticus";
$DOCroot = "$WeBServeRRooT/$PLOTroot/";

$NOW_DATE = date("Y-m-d");
$NOW_TIME = date("Y-m-d H:i:s");
$STARTtime = date("U");

if (!isset($query_date)) {$query_date = $NOW_DATE;}
if (!isset($group)) {$group = '';}

$stmt="select server_ip from servers;";
$rslt=mysql_query($stmt, $link);
if ($DB) {echo "$stmt\n";}
$servers_to_print = mysql_num_rows($rslt);
$i=0;
while ($i < $servers_to_print)
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
   .green {color: white; background-color: green}
   .red {color: white; background-color: red}
   .blue {color: white; background-color: blue}
   .purple {color: white; background-color: purple}
-->
 </STYLE>

<? 
echo "<META HTTP-EQUIV=\"Content-Type\" CONTENT=\"text/html; charset=utf-8\">\n";
echo "<TITLE>VICIDIAL: Server Performance</TITLE></HEAD><BODY BGCOLOR=WHITE>\n";
echo "<FORM ACTION=\"$PHP_SELF\" METHOD=GET>\n";
echo "<INPUT TYPE=TEXT NAME=query_date SIZE=19 MAXLENGTH=19 VALUE=\"$query_date\">\n";
echo "<SELECT SIZE=1 NAME=group>\n";
	$o=0;
	while ($servers_to_print > $o)
	{
		if ($groups[$o] == $group) {echo "<option selected value=\"$groups[$o]\">$groups[$o]</option>\n";}
		  else {echo "<option value=\"$groups[$o]\">$groups[$o]</option>\n";}
		$o++;
	}
echo "</SELECT>\n";
echo "<SELECT SIZE=1 NAME=shift>\n";
echo "<option selected value=\"AM\">AM</option>\n";
echo "<option value=\"PM\">PM</option>\n";
echo "</SELECT>\n";
echo "<INPUT TYPE=Submit NAME=SUBMIT VALUE=SUBMIT>\n";
echo "<FONT FACE=\"ARIAL,HELVETICA\" COLOR=BLACK SIZE=2> &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; <a href=\"./server_stats.php\">REPORTS</a> </FONT>\n";
echo "</FORM>\n\n";

echo "<PRE><FONT SIZE=2>\n";


if (!$group)
{
echo "\n";
echo "PLEASE SELECT A BEDIENERAND DATE-TIME ABOVE AND CLICK SUBMIT\n";
echo " NOTE: stats taken from 6 hour shift specified\n";
}

else
{
if ($shift == 'AM') 
	{
	$query_date_BEGIN = "$query_date 08:45:00";   
	$query_date_END = "$query_date 15:30:00";
	$time_BEGIN = "08:45:00";   
	$time_END = "15:55:00";
	}
if ($shift == 'PM') 
	{
	$query_date_BEGIN = "$query_date 15:30:00";   
	$query_date_END = "$query_date 23:15:00";
	$time_BEGIN = "15:30:00";   
	$time_END = "23:55:00";
	}

echo "VICIDIAL: Server Performance                             $NOW_TIME\n";

echo "Time range: $query_date_BEGIN to $query_date_END\n\n";
echo "---------- TOTALS, PEAKS and AVERAGES\n";

$stmt="select sysload from server_performance where start_time <= '" . mysql_real_escape_string($query_date_END) . "' and start_time >= '" . mysql_real_escape_string($query_date_BEGIN) . "' and server_ip='" . mysql_real_escape_string($group) . "' order by sysload desc limit 1;";
$rslt=mysql_query($stmt, $link);
if ($DB) {echo "$stmt\n";}
$row=mysql_fetch_row($rslt);
$HIGHload =	sprintf("%10s", $row[0]);
$HIGHmulti = intval($HIGHload / 100);
#$HIGHmulti = ($HIGHload / 100);

$stmt="select AVG(sysload),AVG(channels_total) from server_performance where start_time <= '" . mysql_real_escape_string($query_date_END) . "' and start_time >= '" . mysql_real_escape_string($query_date_BEGIN) . "' and server_ip='" . mysql_real_escape_string($group) . "';";
$rslt=mysql_query($stmt, $link);
if ($DB) {echo "$stmt\n";}
$row=mysql_fetch_row($rslt);
$AVGload =	sprintf("%10s", $row[0]);
$AVGchannels =	sprintf("%10s", $row[1]);

$stmt="select AVG(cpu_user_percent),AVG(cpu_system_percent),AVG(cpu_idle_percent) from server_performance where start_time <= '" . mysql_real_escape_string($query_date_END) . "' and start_time >= '" . mysql_real_escape_string($query_date_BEGIN) . "' and server_ip='" . mysql_real_escape_string($group) . "';";
$rslt=mysql_query($stmt, $link);
if ($DB) {echo "$stmt\n";}
$row=mysql_fetch_row($rslt);
$AVGcpuUSER =	sprintf("%10s", $row[0]);
$AVGcpuSYSTEM =	sprintf("%10s", $row[1]);
$AVGcpuIDLE =	sprintf("%10s", $row[2]);

$stmt="select usedram from server_performance where start_time <= '" . mysql_real_escape_string($query_date_END) . "' and start_time >= '" . mysql_real_escape_string($query_date_BEGIN) . "' and server_ip='" . mysql_real_escape_string($group) . "' order by usedram desc limit 1;";
$rslt=mysql_query($stmt, $link);
if ($DB) {echo "$stmt\n";}
$row=mysql_fetch_row($rslt);
$USEDram =	sprintf("%10s", $row[0]);

$stmt="select count(*),SUM(length_in_min) from call_log where extension NOT IN('8365','8366','8367') and  start_time <= '" . mysql_real_escape_string($query_date_END) . "' and start_time >= '" . mysql_real_escape_string($query_date_BEGIN) . "' and server_ip='" . mysql_real_escape_string($group) . "';";
$rslt=mysql_query($stmt, $link);
if ($DB) {echo "$stmt\n";}
$row=mysql_fetch_row($rslt);
$TOTALcalls =	sprintf("%10s", $row[0]);
$OFFHOOKtime =	sprintf("%10s", $row[1]);


echo "Total Calls in/out on this server:        $TOTALcalls\n";
echo "Total Off-Hook time on this server (min): $OFFHOOKtime\n";
echo "Average channels in use for server:       $AVGchannels\n";
echo "Average load for server:                  $AVGload\n";
echo "Peak load for server:                     $HIGHload\n";
#echo "Peak used memory for server (in MB):      $USEDram\n";
echo "Average USER process cpu percentage:      $AVGcpuUSER %\n";
echo "Average SYSTEM process cpu percentage:    $AVGcpuSYSTEM %\n";
echo "Average IDLE process cpu percentage:      $AVGcpuIDLE %\n";

echo "\n";
echo "---------- LINE GRAPH:\n";



##############################
#########  Graph stats

$DAT = '.dat';
$HTM = '.htm';
$PNG = '.png';
$filedate = date("Y-m-d_His");
$DATfile = "$group$query_date$shift$filedate$DAT";
$HTMfile = "$group$query_date$shift$filedate$HTM";
$PNGfile = "$group$query_date$shift$filedate$PNG";

$HTMfp = fopen ("$DOCroot/$HTMfile", "a");
$DATfp = fopen ("$DOCroot/$DATfile", "a");

$stmt="select DATE_FORMAT(start_time,'%H:%i:%s') as timex,sysload,processes,channels_total,live_recordings,cpu_user_percent,cpu_system_percent from server_performance where server_ip='" . mysql_real_escape_string($group) . "' and start_time <= '" . mysql_real_escape_string($query_date_END) . "' and start_time >= '" . mysql_real_escape_string($query_date_BEGIN) . "' order by timex;";
$rslt=mysql_query($stmt, $link);
if ($DB) {echo "$stmt\n";}
$rows_to_print = mysql_num_rows($rslt);
$i=0;
while ($i < $rows_to_print)
	{
	$row=mysql_fetch_row($rslt);
	$row[5] = intval(($row[5] + $row[6]) * $HIGHmulti);
	$row[6] = intval($row[6] * $HIGHmulti);
	fwrite ($DATfp, "$row[5]\t$row[6]\t$row[0]\t$row[1]\t$row[2]\t$row[3]\n");
	$i++;
	}
fclose($DATfp);

$rows_to_max = ($rows_to_print + 100);



$HTMcontent  = '';
$HTMcontent .= "#proc page\n";
$HTMcontent .= "#if @DEVICE in png,gif\n";
$HTMcontent .= "   scale: 0.6\n";
$HTMcontent .= "\n";
$HTMcontent .= "#endif\n";
$HTMcontent .= "#proc getdata\n";
$HTMcontent .= "file: $DOCroot/$DATfile\n";
$HTMcontent .= "fieldnames: userproc sysproc time load processes channels\n";
$HTMcontent .= "\n";
$HTMcontent .= "#proc areadef\n";
$HTMcontent .= "title: Server $group   $query_date_BEGIN to $query_date_END\n";
$HTMcontent .= "titledetails: size=14  align=C\n";
$HTMcontent .= "rectangle: 1 1 14 7\n";
$HTMcontent .= "xscaletype: time hh:mm:ss\n";
$HTMcontent .= "xrange: $time_BEGIN $time_END\n";
$HTMcontent .= "yrange: 0 $HIGHload\n";
$HTMcontent .= "\n";
$HTMcontent .= "#proc xaxis\n";
$HTMcontent .= "stubs: inc 30 minutes\n";
$HTMcontent .= "minorticinc: 5 minutes\n";
$HTMcontent .= "stubformat: hh:mm:ssa\n";
$HTMcontent .= "\n";
$HTMcontent .= "#proc yaxis\n";
$HTMcontent .= "stubs: inc 50\n";
$HTMcontent .= "grid: color=yellow\n";
$HTMcontent .= "gridskip: min\n";
$HTMcontent .= "ticincrement: 100 1000\n";
$HTMcontent .= "\n";
$HTMcontent .= "#proc lineplot\n";
$HTMcontent .= "xfield: time\n";
$HTMcontent .= "yfield: userproc\n";
$HTMcontent .= "linedetails: color=purple width=.5\n";
$HTMcontent .= "fill: lavender\n";
$HTMcontent .= "legendlabel: user proc%\n";
$HTMcontent .= "maxinpoints: $rows_to_max\n";
$HTMcontent .= "\n";
$HTMcontent .= "#proc lineplot\n";
$HTMcontent .= "xfield: time\n";
$HTMcontent .= "yfield: sysproc\n";
$HTMcontent .= "linedetails: color=yelloworange width=.5\n";
$HTMcontent .= "fill: dullyellow\n";
$HTMcontent .= "legendlabel: system proc%\n";
$HTMcontent .= "maxinpoints: $rows_to_max\n";
$HTMcontent .= "\n";
$HTMcontent .= "#proc curvefit\n";
$HTMcontent .= "xfield: time\n";
$HTMcontent .= "yfield: load\n";
$HTMcontent .= "linedetails: color=blue width=.5\n";
$HTMcontent .= "legendlabel: load\n";
$HTMcontent .= "maxinpoints: $rows_to_max\n";
$HTMcontent .= "\n";
$HTMcontent .= "#proc curvefit\n";
$HTMcontent .= "xfield: time\n";
$HTMcontent .= "yfield: processes\n";
$HTMcontent .= "linedetails: color=red width=.5\n";
$HTMcontent .= "legendlabel: processes\n";
$HTMcontent .= "maxinpoints: $rows_to_max\n";
$HTMcontent .= "\n";
$HTMcontent .= "#proc curvefit\n";
$HTMcontent .= "xfield: time\n";
$HTMcontent .= "yfield: channels\n";
$HTMcontent .= "linedetails: color=green width=.5\n";
$HTMcontent .= "legendlabel: channels\n";
$HTMcontent .= "maxinpoints: $rows_to_max\n";
$HTMcontent .= "\n";
$HTMcontent .= "#proc legend\n";
$HTMcontent .= "location: max-2 max\n";
$HTMcontent .= "seglen: 0.2\n";
$HTMcontent .= "\n";

fwrite ($HTMfp, "$HTMcontent");
fclose($HTMfp);


passthru("/usr/local/bin/pl -png $DOCroot/$HTMfile -o $DOCroot/$PNGfile");

sleep(1);

echo "</PRE>\n";
echo "\n";
echo "<IMG SRC=\"/$PLOTroot/$PNGfile\">\n";


echo "<!-- /usr/local/bin/pl -png $DOCroot/$HTMfile -o $DOCroot/$PNGfile -->";

}



?>

</BODY></HTML>