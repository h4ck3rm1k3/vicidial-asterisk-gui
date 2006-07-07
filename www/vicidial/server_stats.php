<? 
### server_stats.php
### 
### Copyright (C) 2006  Matt Florell <vicidial@gmail.com>    LICENSE: GPLv2
###
# CHANGES
#
# 60620-1037 - Added Link back to Admin section
#            - Added required user/pass to gain access to this page
#

require("dbconnect.php");

$PHP_AUTH_USER=$_SERVER['PHP_AUTH_USER'];
$PHP_AUTH_PW=$_SERVER['PHP_AUTH_PW'];

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


$NOW_DATE = date("Y-m-d");
$NOW_TIME = date("Y-m-d H:i:s");
$STARTtime = date("U");
if (!isset($query_date)) {$query_date = $NOW_DATE;}

$stmt="select * from servers;";
$rslt=mysql_query($stmt, $link);
if ($DB) {echo "$stmt\n";}
$servers_to_print = mysql_num_rows($rslt);
$i=0;
while ($i < $servers_to_print)
	{
	$row=mysql_fetch_row($rslt);
	$server_id[$i] =			$row[0];
	$server_description[$i] =	$row[1];
	$server_ip[$i] =			$row[2];
	$active[$i] =				$row[3];
	$i++;
	}
?>

<HTML>
<HEAD>

<META HTTP-EQUIV="Content-Type" CONTENT="text/html; charset=utf-8">
<TITLE>VICIDIAL: Server Stats and Reports</TITLE></HEAD><BODY BGCOLOR=WHITE>
<FONT SIZE=4><B>VICIDIAL: Server Stats and Reports</B></font> &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;
<a href="./admin.php"><FONT FACE="ARIAL,HELVETICA" COLOR=BLACK SIZE=2>BACK TO ADMIN</FONT></a><BR><BR>
<UL>
<LI><a href="AST_timeonVDADall.php"><FONT FACE="ARIAL,HELVETICA" COLOR=BLACK SIZE=2>TIME ON VDAD (per campaign)</a> | <a href="AST_timeonVDADall_SIPmonitor.php"><FONT FACE="ARIAL,HELVETICA" COLOR=BLACK SIZE=2>SIP Listen Version</a></FONT>
<LI><a href="AST_parkstats.php"><FONT FACE="ARIAL,HELVETICA" COLOR=BLACK SIZE=2>PARK REPORT</a></FONT>
<LI><a href="AST_VDADstats.php"><FONT FACE="ARIAL,HELVETICA" COLOR=BLACK SIZE=2>VDAD REPORT</a></FONT>
<LI><a href="AST_CLOSERstats.php"><FONT FACE="ARIAL,HELVETICA" COLOR=BLACK SIZE=2>CLOSER REPORT</a></FONT>
<LI><a href="AST_agent_performance.php"><FONT FACE="ARIAL,HELVETICA" COLOR=BLACK SIZE=2>AGENT PERFORMANCE</a></FONT>
<LI><a href="AST_agent_performance_detail.php"><FONT FACE="ARIAL,HELVETICA" COLOR=BLACK SIZE=2>AGENT PERFORMANCE DETAIL</a></FONT>
<LI><a href="AST_server_performance.php"><FONT FACE="ARIAL,HELVETICA" COLOR=BLACK SIZE=2>SERVER PERFORMANCE</a></FONT>
</UL>

<PRE><TABLE BORDER=1>
<TR><TD>SERVER</TD><TD>DESCRIPTION</TD><TD>IP ADDRESS</TD><TD>ACTIVE</TD><TD>VDAD time</TD><TD>VDcall time</TD><TD>PARK time</TD><TD>CLOSER/INBOUND time</TD></TR>
<? 

	$o=0;
	while ($servers_to_print > $o)
	{
	echo "<TR>\n";
	echo "<TD>$server_id[$o]</TD>\n";
	echo "<TD>$server_description[$o]</TD>\n";
	echo "<TD>$server_ip[$o]</TD>\n";
	echo "<TD>$active[$o]</TD>\n";
	echo "<TD><a href=\"AST_timeonVDAD.php?server_ip=$server_ip[$o]\">LINK</a></TD>\n";
	echo "<TD><a href=\"AST_timeoncall.php?server_ip=$server_ip[$o]\">LINK</a></TD>\n";
	echo "<TD><a href=\"AST_timeonpark.php?server_ip=$server_ip[$o]\">LINK</a></TD>\n";
	echo "<TD><a href=\"AST_timeonVDAD_closer.php?server_ip=$server_ip[$o]\">LINK</a></TD>\n";
	echo "</TR>\n";
	$o++;
	}

?>
</TABLE>

</BODY></HTML>