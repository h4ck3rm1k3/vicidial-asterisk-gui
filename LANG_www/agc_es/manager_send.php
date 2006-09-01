<?
# manager_send.php
# 
# Copyright (C) 2006  Matt Florell <vicidial@gmail.com>    LICENSE: GPLv2
#
# This script is designed purely to insert records into the vicidial_manager table to signal Actions to an asterisk server
# This script depends on the server_ip being sent and also needs to have a valid user/pass from the vicidial_users table
# 
# required variables:
#  - $server_ip
#  - $session_name
#  - $user
#  - $pass
# optional variables:
#  - $ACTION - ('Originate','Redirect','Hangup','Command','Monitor','StopMonitor','SysCIDOriginate','RedirectName','RedirectNameVmail','MonitorConf','StopMonitorConf','RedirectXtra','RedirectXtraCX','RedirectVD','HangupConfDial')
#  - $queryCID - ('CN012345678901234567',...)
#  - $format - ('text','debug')
#  - $channel - ('Zap/41-1','SIP/test101-1jut','IAX2/iaxy@iaxy',...)
#  - $exten - ('1234','913125551212',...)
#  - $ext_context - ('default','demo',...)
#  - $ext_priority - ('1','2',...)
#  - $filename - ('20050406-125623_44444',...)
#  - $extenName - ('phone100',...)
#  - $parkedby - ('phone100',...)
#  - $extrachannel - ('Zap/41-1','SIP/test101-1jut','IAX2/iaxy@iaxy',...)
#  - $auto_dial_level - ('0','1','1.1',...)
#  - $campaign - ('CLOSER','TESTCAMP',...)
#  - $uniqueid - ('1120232758.2406800',...)
#  - $lead_id - ('1234',...)
#  - $seconds - ('32',...)
#  - $outbound_cid - ('3125551212','0000000000',...)
#  - $agent_log_id - ('123456',...)
#  - $call_server_ip - ('10.10.10.15',...)
#  - $CalLCID - ('VD01234567890123456',...)
# 

# changes
# 50401-1002 - First build of script, Hangup function only
# 50404-1045 - Redirect basic function enabled
# 50406-1522 - Monitor basic function enabled
# 50407-1647 - Monitor and StopMonitor full functions enabled
# 50422-1120 - basic Originate function enabled
# 50428-1451 - basic SysCIDOriginate function enabled for checking voicemail
# 50502-1539 - basic RedirectName and RedirectNameVmail added
# 50503-1227 - added session_name checking for extra security
# 50523-1341 - added Conference call start/stop recording
# 50523-1421 - added OriginateName and OriginateNameVmail for local calls
# 50524-1602 - added RedirectToPark and RedirectFromPark
# 50531-1203 - added RedirecXtra for dual channel redirection
# 50630-1100 - script changed to not use HTTP login vars, user/pass instead
# 50804-1148 - Added RedirectVD for VICIDIAL blind redirection with logging
# 50815-1204 - Added NEXTAVAILABLE to RedirectXtra function
# 50903-2343 - Added HangupConfDial function to hangup in-dial channels in conf
# 50913-1057 - Added outbound_cid set if present to originate call
# 51020-1556 - Added agent_log_id framework for detailed agent activity logging
# 51118-1204 - Fixed Blind transfer bug from VICIDIAL when in manual dial mode
# 51129-1014 - Added ability to accept calls from other VICIDIAL servers
# 51129-1253 - Fixed Hangups of other agents channels in VICIDIAL AD
# 60310-2022 - Fixed NEXTAVAILABLE bug in leave-3way-call redirect function
# 60421-1413 - check GET/POST vars lines with isset to not trigger PHP NOTICES
# 60619-1158 - Added variable filters to close security holes for login form
# 60809-1544 - Added direct transfers to leave-3ways in consultative transfers
#

require("dbconnect.php");

### These are variable assignments for PHP globals off
if (isset($_GET["user"]))					{$user=$_GET["user"];}
	elseif (isset($_POST["user"]))			{$user=$_POST["user"];}
if (isset($_GET["pass"]))					{$pass=$_GET["pass"];}
	elseif (isset($_POST["pass"]))			{$pass=$_POST["pass"];}
if (isset($_GET["server_ip"]))				{$server_ip=$_GET["server_ip"];}
	elseif (isset($_POST["server_ip"]))		{$server_ip=$_POST["server_ip"];}
if (isset($_GET["session_name"]))			{$session_name=$_GET["session_name"];}
	elseif (isset($_POST["session_name"]))	{$session_name=$_POST["session_name"];}
if (isset($_GET["ACTION"]))					{$ACTION=$_GET["ACTION"];}
	elseif (isset($_POST["ACTION"]))		{$ACTION=$_POST["ACTION"];}
if (isset($_GET["queryCID"]))				{$queryCID=$_GET["queryCID"];}
	elseif (isset($_POST["queryCID"]))		{$queryCID=$_POST["queryCID"];}
if (isset($_GET["format"]))					{$format=$_GET["format"];}
	elseif (isset($_POST["format"]))		{$format=$_POST["format"];}
if (isset($_GET["channel"]))				{$channel=$_GET["channel"];}
	elseif (isset($_POST["channel"]))		{$channel=$_POST["channel"];}
if (isset($_GET["exten"]))					{$exten=$_GET["exten"];}
	elseif (isset($_POST["exten"]))			{$exten=$_POST["exten"];}
if (isset($_GET["ext_context"]))			{$ext_context=$_GET["ext_context"];}
	elseif (isset($_POST["ext_context"]))	{$ext_context=$_POST["ext_context"];}
if (isset($_GET["ext_priority"]))			{$ext_priority=$_GET["ext_priority"];}
	elseif (isset($_POST["ext_priority"]))	{$ext_priority=$_POST["ext_priority"];}
if (isset($_GET["filename"]))				{$filename=$_GET["filename"];}
	elseif (isset($_POST["filename"]))		{$filename=$_POST["filename"];}
if (isset($_GET["extenName"]))				{$extenName=$_GET["extenName"];}
	elseif (isset($_POST["extenName"]))		{$extenName=$_POST["extenName"];}
if (isset($_GET["parkedby"]))				{$parkedby=$_GET["parkedby"];}
	elseif (isset($_POST["parkedby"]))		{$parkedby=$_POST["parkedby"];}
if (isset($_GET["extrachannel"]))			{$extrachannel=$_GET["extrachannel"];}
	elseif (isset($_POST["extrachannel"]))	{$extrachannel=$_POST["extrachannel"];}
if (isset($_GET["auto_dial_level"]))			{$auto_dial_level=$_GET["auto_dial_level"];}
	elseif (isset($_POST["auto_dial_level"]))	{$auto_dial_level=$_POST["auto_dial_level"];}
if (isset($_GET["campaign"]))				{$campaign=$_GET["campaign"];}
	elseif (isset($_POST["campaign"]))		{$campaign=$_POST["campaign"];}
if (isset($_GET["uniqueid"]))				{$uniqueid=$_GET["uniqueid"];}
	elseif (isset($_POST["uniqueid"]))		{$uniqueid=$_POST["uniqueid"];}
if (isset($_GET["lead_id"]))				{$lead_id=$_GET["lead_id"];}
	elseif (isset($_POST["lead_id"]))		{$lead_id=$_POST["lead_id"];}
if (isset($_GET["secondS"]))				{$secondS=$_GET["secondS"];}
	elseif (isset($_POST["secondS"]))		{$secondS=$_POST["secondS"];}
if (isset($_GET["outbound_cid"]))			{$outbound_cid=$_GET["outbound_cid"];}
	elseif (isset($_POST["outbound_cid"]))	{$outbound_cid=$_POST["outbound_cid"];}
if (isset($_GET["agent_log_id"]))			{$agent_log_id=$_GET["agent_log_id"];}
	elseif (isset($_POST["agent_log_id"]))	{$agent_log_id=$_POST["agent_log_id"];}
if (isset($_GET["call_server_ip"]))				{$call_server_ip=$_GET["call_server_ip"];}
	elseif (isset($_POST["call_server_ip"]))	{$call_server_ip=$_POST["call_server_ip"];}
if (isset($_GET["CalLCID"]))				{$CalLCID=$_GET["CalLCID"];}
	elseif (isset($_POST["CalLCID"]))		{$CalLCID=$_POST["CalLCID"];}
if (isset($_GET["phone_code"]))				{$phone_code=$_GET["phone_code"];}
	elseif (isset($_POST["phone_code"]))	{$phone_code=$_POST["phone_code"];}
if (isset($_GET["phone_number"]))			{$phone_number=$_GET["phone_number"];}
	elseif (isset($_POST["phone_number"]))	{$phone_number=$_POST["phone_number"];}

$user=ereg_replace("[^0-9a-zA-Z]","",$user);
$pass=ereg_replace("[^0-9a-zA-Z]","",$pass);
$secondS = ereg_replace("[^0-9]","",$secondS);

# default optional vars if not set
if (!isset($ACTION))   {$ACTION="Originate";}
if (!isset($format))   {$format="alert";}
if (!isset($ext_priority))   {$ext_priority="1";}

$version = '0.0.25';
$build = '60809-1544';
$StarTtime = date("U");
$NOW_DATE = date("Y-m-d");
$NOW_TIME = date("Y-m-d H:i:s");
if (!isset($query_date)) {$query_date = $NOW_DATE;}

	$stmt="SELECT count(*) from vicidial_users where user='$user' and pass='$pass' and user_level > 0;";
	if ($DB) {echo "|$stmt|\n";}
	$rslt=mysql_query($stmt, $link);
	$row=mysql_fetch_row($rslt);
	$auth=$row[0];

  if( (strlen($user)<2) or (strlen($pass)<2) or ($auth==0))
	{
    echo "Inválido Nombre del usuario/Contraseña: |$user|$pass|\n";
    exit;
	}
  else
	{

	if( (strlen($server_ip)<6) or (!isset($server_ip)) or ( (strlen($session_name)<12) or (!isset($session_name)) ) )
		{
		echo "Inválido server_ip: |$server_ip|  or  Inválido session_name: |$session_name|\n";
		exit;
		}
	else
		{
		$stmt="SELECT count(*) from web_client_sessions where session_name='$session_name' and server_ip='$server_ip';";
		if ($DB) {echo "|$stmt|\n";}
		$rslt=mysql_query($stmt, $link);
		$row=mysql_fetch_row($rslt);
		$SNauth=$row[0];
		  if($SNauth==0)
			{
			echo "Inválido session_name: |$session_name|$server_ip|\n";
			exit;
			}
		  else
			{
			# do nothing for now
			}
		}
	}

if ($format=='debug')
{
echo "<html>\n";
echo "<head>\n";
echo "<!-- VERSIÓN: $version     CONSTRUCCION: $build    ACTION: $ACTION   server_ip: $server_ip-->\n";
echo "<title>Enviar al Manager: ";
if ($ACTION=="Originate")		{echo "Originate";}
if ($ACTION=="Redirect")		{echo "Redirect";}
if ($ACTION=="RedirectName")	{echo "RedirectName";}
if ($ACTION=="Hangup")			{echo "Hangup";}
if ($ACTION=="Command")			{echo "Command";}
if ($ACTION==99999)	{echo "AYUDA";}
echo "</title>\n";
echo "</head>\n";
echo "<BODY BGCOLOR=white marginheight=0 marginwidth=0 leftmargin=0 topmargin=0>\n";
}





######################
# ACTION=SysCIDOriginate  - insert Originate Manager statement allowing small CIDs for system calls
######################
if ($ACTION=="SysCIDOriginate")
{
	if ( (strlen($exten)<1) or (strlen($channel)<1) or (strlen($ext_context)<1) or (strlen($queryCID)<1) )
	{
		echo "Exten $exten No es válido or queryCID $queryCID No es válido, Originate comando no insertado\n";
	}
	else
	{
	$stmt="INSERT INTO vicidial_manager values('','','$NOW_TIME','NEW','N','$server_ip','','Originate','$queryCID','Channel: $channel','Context: $ext_context','Exten: $exten','Priority: $ext_priority','Callerid: $queryCID','','','','','');";
		if ($format=='debug') {echo "\n<!-- $stmt -->";}
	$rslt=mysql_query($stmt, $link);
	echo "Originate comando enviado a Exten $exten Canal $channel en $server_ip\n";
	}
}



######################
# ACTION=Originate, OriginateName, OriginateNameVmail  - insert Originate Manager statement
######################
if ($ACTION=="OriginateName")
{
	if ( (strlen($channel)<3) or (strlen($queryCID)<15)  or (strlen($extenName)<1)  or (strlen($ext_context)<1)  or (strlen($ext_priority)<1) )
	{
		$channel_live=0;
		echo "Una de estas variables No es válido:\n";
		echo "Canal $channel debe ser mayor de 2 caracteres\n";
		echo "queryCID $queryCID debe ser mayor de 14 caracteres\n";
		echo "extenName $extenName debe ser fijado\n";
		echo "ext_context $ext_context debe ser fijado\n";
		echo "ext_priority $ext_priority debe ser fijado\n";
		echo "\nOriginateName Action no enviado\n";
	}
	else
	{
		$stmt="SELECT dialplan_number FROM phones where server_ip = '$server_ip' and extension='$extenName';";
			if ($format=='debug') {echo "\n<!-- $stmt -->";}
		$rslt=mysql_query($stmt, $link);
		$name_count = mysql_num_rows($rslt);
		if ($name_count>0)
		{
		$row=mysql_fetch_row($rslt);
		$exten = $row[0];
		$ACTION="Originate";
		}
	}
}

if ($ACTION=="OriginateNameVmail")
{
	if ( (strlen($channel)<3) or (strlen($queryCID)<15)  or (strlen($extenName)<1)  or (strlen($exten)<1)  or (strlen($ext_context)<1)  or (strlen($ext_priority)<1) )
	{
		$channel_live=0;
		echo "Una de estas variables No es válido:\n";
		echo "Canal $channel debe ser mayor de 2 caracteres\n";
		echo "queryCID $queryCID debe ser mayor de 14 caracteres\n";
		echo "extenName $extenName debe ser fijado\n";
		echo "exten $exten debe ser fijado\n";
		echo "ext_context $ext_context debe ser fijado\n";
		echo "ext_priority $ext_priority debe ser fijado\n";
		echo "\nOriginateNameVmail Action no enviado\n";
	}
	else
	{
		$stmt="SELECT voicemail_id FROM phones where server_ip = '$server_ip' and extension='$extenName';";
			if ($format=='debug') {echo "\n<!-- $stmt -->";}
		$rslt=mysql_query($stmt, $link);
		$name_count = mysql_num_rows($rslt);
		if ($name_count>0)
		{
		$row=mysql_fetch_row($rslt);
		$exten = "$exten$row[0]";
		$ACTION="Originate";
		}
	}
}

if ($ACTION=="Originate")
{
	if ( (strlen($exten)<1) or (strlen($channel)<1) or (strlen($ext_context)<1) or (strlen($queryCID)<10) )
	{
		echo "Exten $exten No es válido or queryCID $queryCID No es válido, Originate comando no insertado\n";
	}
	else
	{
	if (strlen($outbound_cid)>1)
		{$outCID = "\"$queryCID\" <$outbound_cid>";}
	else
		{$outCID = "$queryCID";}
	$stmt="INSERT INTO vicidial_manager values('','','$NOW_TIME','NEW','N','$server_ip','','Originate','$queryCID','Channel: $channel','Context: $ext_context','Exten: $exten','Priority: $ext_priority','Callerid: $outCID','','','','','');";
		if ($format=='debug') {echo "\n<!-- $stmt -->";}
	$rslt=mysql_query($stmt, $link);
	echo "Originate comando enviado a Exten $exten Canal $channel en $server_ip\n";
	}
}



######################
# ACTION=HangupConfDial  - find the Local channel that is in the conference and needs to be hung up
######################
if ($ACTION=="HangupConfDial")
{
	$row='';   $rowx='';
	$channel_live=1;
	if ( (strlen($exten)<3) or (strlen($queryCID)<15) or (strlen($ext_context)<1) )
	{
		$channel_live=0;
		echo "conference $exten No es válido or ext_context $ext_context or queryCID $queryCID No es válido, Hangup comando no insertado\n";
	}
	else
	{
		$local_DEF = 'Local/';
		$local_AMP = '@';
		$hangup_channel_prefix = "$local_DEF$exten$local_AMP$ext_context";

		$stmt="SELECT count(*) FROM live_sip_channels where server_ip = '$server_ip' and channel LIKE \"$hangup_channel_prefix%\";";
			if ($format=='debug') {echo "\n<!-- $stmt -->";}
		$rslt=mysql_query($stmt, $link);
		$row=mysql_fetch_row($rslt);
		if ($row > 0)
		{
			$stmt="SELECT channel FROM live_sip_channels where server_ip = '$server_ip' and channel LIKE \"$hangup_channel_prefix%\";";
				if ($format=='debug') {echo "\n<!-- $stmt -->";}
			$rslt=mysql_query($stmt, $link);
			$rowx=mysql_fetch_row($rslt);
			$channel=$rowx[0];
			$ACTION="Hangup";
			$queryCID = eregi_replace("^.","G",$queryCID);
		}
	}
}



######################
# ACTION=Hangup  - insert Hangup Manager statement
######################
if ($ACTION=="Hangup")
{
	$row='';   $rowx='';
	$channel_live=1;
	if ( (strlen($channel)<3) or (strlen($queryCID)<15) )
	{
		$channel_live=0;
		echo "Canal $channel No es válido or queryCID $queryCID No es válido, Hangup comando no insertado\n";
	}
	else
	{
		if (strlen($call_server_ip)<7) {$call_server_ip = $server_ip;}

#		$stmt="SELECT count(*) FROM live_channels where server_ip = '$call_server_ip' and channel='$channel';";
#			if ($format=='debug') {echo "\n<!-- $stmt -->";}
#		$rslt=mysql_query($stmt, $link);
#		$row=mysql_fetch_row($rslt);
#		if ($row[0]==0)
#		{
#			$stmt="SELECT count(*) FROM live_sip_channels where server_ip = '$call_server_ip' and channel='$channel';";
#				if ($format=='debug') {echo "\n<!-- $stmt -->";}
#			$rslt=mysql_query($stmt, $link);
#			$rowx=mysql_fetch_row($rslt);
#			if ($rowx[0]==0)
#			{
#				$channel_live=0;
#				echo "Channel $channel is not live on $call_server_ip, Hangup command not inserted\n";
#			}	
#		}
		if ( ($auto_dial_level > 0) and (strlen($CalLCID)>2) and (strlen($exten)>2) and ($secondS > 4))
		{
			$stmt="SELECT count(*) FROM vicidial_auto_calls where channel='$channel' and callerid='$CalLCID';";
				if ($format=='debug') {echo "\n<!-- $stmt -->";}
			$rslt=mysql_query($stmt, $link);
			$rowx=mysql_fetch_row($rslt);
			if ($rowx[0]==0)
			{
			echo "Call $CalLCID $channel no está activo en $call_server_ip, Checking Live Canal...\n";

				$stmt="SELECT count(*) FROM live_channels where server_ip = '$call_server_ip' and channel='$channel' and extension LIKE \"%$exten\";";
					if ($format=='debug') {echo "\n<!-- $stmt -->";}
				$rslt=mysql_query($stmt, $link);
				$row=mysql_fetch_row($rslt);
				if ($row[0]==0)
				{
				$channel_live=0;
				echo "Canal $channel no está activo en $call_server_ip, Hangup comando no insertado $rowx[0]\n$stmt\n";
				}
				else
				{
				echo "$stmt\n";
				}
			}	
		}
		if ($channel_live==1)
		{
		$stmt="INSERT INTO vicidial_manager values('','','$NOW_TIME','NEW','N','$call_server_ip','','Hangup','$queryCID','Channel: $channel','','','','','','','','','');";
			if ($format=='debug') {echo "\n<!-- $stmt -->";}
		$rslt=mysql_query($stmt, $link);
		echo "Hangup comando enviado a Canal $channel en $call_server_ip\n";
		}
	}
}



######################
# ACTION=Redirect, RedirectName, RedirectNameVmail, RedirectToPark, RedirectFromPark, RedirectVD, RedirectXtra, RedirectXtraCX
# - insert Redirect Manager statement using extensions name
######################
if ($ACTION=="RedirectVD")
{
	if ( (strlen($channel)<3) or (strlen($queryCID)<15) or (strlen($exten)<1) or (strlen($campaign)<1) or (strlen($ext_context)<1) or (strlen($ext_priority)<1) or (strlen($uniqueid)<2) or (strlen($lead_id)<1) )
	{
		$channel_live=0;
		echo "Una de estas variables No es válido:\n";
		echo "Canal $channel debe ser mayor de 2 caracteres\n";
		echo "queryCID $queryCID debe ser mayor de 14 caracteres\n";
		echo "exten $exten debe ser fijado\n";
		echo "ext_context $ext_context debe ser fijado\n";
		echo "ext_priority $ext_priority debe ser fijado\n";
		echo "auto_dial_level $auto_dial_level debe ser fijado\n";
		echo "campaign $campaign debe ser fijado\n";
		echo "uniqueid $uniqueid debe ser fijado\n";
		echo "lead_id $lead_id debe ser fijado\n";
		echo "\nRedirectVD Action no enviado\n";
	}
	else
	{
		if (strlen($call_server_ip)>6) {$server_ip = $call_server_ip;}
			if (eregi("CLOSER",$campaign))
				{
				$stmt = "UPDATE vicidial_closer_log set end_epoch='$StarTtime', length_in_sec='$secondS',status='XFER' where lead_id='$lead_id' order by start_epoch desc limit 1;";
					if ($format=='debug') {echo "\n<!-- $stmt -->";}
				$rslt=mysql_query($stmt, $link);
				}
			if ($auto_dial_level < 1)
				{
				$stmt = "UPDATE vicidial_log set end_epoch='$StarTtime', length_in_sec='$secondS',status='XFER' where uniqueid='$uniqueid';";
					if ($format=='debug') {echo "\n<!-- $stmt -->";}
				$rslt=mysql_query($stmt, $link);
				}
			else
				{
				$stmt = "DELETE from vicidial_auto_calls where uniqueid='$uniqueid';";
					if ($format=='debug') {echo "\n<!-- $stmt -->";}
				$rslt=mysql_query($stmt, $link);
				}

		$ACTION="Redirect";
	}
}

if ($ACTION=="RedirectToPark")
{
	if ( (strlen($channel)<3) or (strlen($queryCID)<15) or (strlen($exten)<1) or (strlen($extenName)<1) or (strlen($ext_context)<1) or (strlen($ext_priority)<1) or (strlen($parkedby)<1) )
	{
		$channel_live=0;
		echo "Una de estas variables No es válido:\n";
		echo "Canal $channel debe ser mayor de 2 caracteres\n";
		echo "queryCID $queryCID debe ser mayor de 14 caracteres\n";
		echo "exten $exten debe ser fijado\n";
		echo "extenName $extenName debe ser fijado\n";
		echo "ext_context $ext_context debe ser fijado\n";
		echo "ext_priority $ext_priority debe ser fijado\n";
		echo "parkedby $parkedby debe ser fijado\n";
		echo "\nRedirectToPark Action no enviado\n";
	}
	else
	{
		if (strlen($call_server_ip)>6) {$server_ip = $call_server_ip;}
		$stmt = "INSERT INTO parked_channels values('$channel','$server_ip','','$extenName','$parkedby','$NOW_TIME');";
			if ($format=='debug') {echo "\n<!-- $stmt -->";}
		$rslt=mysql_query($stmt, $link);
		$ACTION="Redirect";
	}
}

if ($ACTION=="RedirectFromPark")
{
	if ( (strlen($channel)<3) or (strlen($queryCID)<15) or (strlen($exten)<1) or (strlen($ext_context)<1) or (strlen($ext_priority)<1) )
	{
		$channel_live=0;
		echo "Una de estas variables No es válido:\n";
		echo "Canal $channel debe ser mayor de 2 caracteres\n";
		echo "queryCID $queryCID debe ser mayor de 14 caracteres\n";
		echo "exten $exten debe ser fijado\n";
		echo "ext_context $ext_context debe ser fijado\n";
		echo "ext_priority $ext_priority debe ser fijado\n";
		echo "\nRedirectFromPark Action no enviado\n";
	}
	else
	{
		if (strlen($call_server_ip)>6) {$server_ip = $call_server_ip;}
		$stmt = "DELETE FROM parked_channels where server_ip='$server_ip' and channel='$channel';";
			if ($format=='debug') {echo "\n<!-- $stmt -->";}
		$rslt=mysql_query($stmt, $link);
		$ACTION="Redirect";
	}
}

if ($ACTION=="RedirectName")
{
	if ( (strlen($channel)<3) or (strlen($queryCID)<15)  or (strlen($extenName)<1)  or (strlen($ext_context)<1)  or (strlen($ext_priority)<1) )
	{
		$channel_live=0;
		echo "Una de estas variables No es válido:\n";
		echo "Canal $channel debe ser mayor de 2 caracteres\n";
		echo "queryCID $queryCID debe ser mayor de 14 caracteres\n";
		echo "extenName $extenName debe ser fijado\n";
		echo "ext_context $ext_context debe ser fijado\n";
		echo "ext_priority $ext_priority debe ser fijado\n";
		echo "\nRedirectName Action no enviado\n";
	}
	else
	{
		$stmt="SELECT dialplan_number FROM phones where server_ip = '$server_ip' and extension='$extenName';";
			if ($format=='debug') {echo "\n<!-- $stmt -->";}
		$rslt=mysql_query($stmt, $link);
		$name_count = mysql_num_rows($rslt);
		if ($name_count>0)
		{
		$row=mysql_fetch_row($rslt);
		$exten = $row[0];
		$ACTION="Redirect";
		}
	}
}

if ($ACTION=="RedirectNameVmail")
{
	if ( (strlen($channel)<3) or (strlen($queryCID)<15)  or (strlen($extenName)<1)  or (strlen($exten)<1)  or (strlen($ext_context)<1)  or (strlen($ext_priority)<1) )
	{
		$channel_live=0;
		echo "Una de estas variables No es válido:\n";
		echo "Canal $channel debe ser mayor de 2 caracteres\n";
		echo "queryCID $queryCID debe ser mayor de 14 caracteres\n";
		echo "extenName $extenName debe ser fijado\n";
		echo "exten $exten debe ser fijado\n";
		echo "ext_context $ext_context debe ser fijado\n";
		echo "ext_priority $ext_priority debe ser fijado\n";
		echo "\nRedirectNameVmail Action no enviado\n";
	}
	else
	{
		$stmt="SELECT voicemail_id FROM phones where server_ip = '$server_ip' and extension='$extenName';";
			if ($format=='debug') {echo "\n<!-- $stmt -->";}
		$rslt=mysql_query($stmt, $link);
		$name_count = mysql_num_rows($rslt);
		if ($name_count>0)
		{
		$row=mysql_fetch_row($rslt);
		$exten = "$exten$row[0]";
		$ACTION="Redirect";
		}
	}
}

if ($ACTION=="RedirectXtraCX")
{
	$row='';   $rowx='';
	$channel_liveX=1;
	$channel_liveY=1;
	if ( (strlen($channel)<3) or (strlen($queryCID)<15) or (strlen($exten)<1) or (strlen($ext_context)<1) or (strlen($ext_priority)<1) or (strlen($extrachannel)<3) )
	{
		$channel_liveX=0;
		$channel_liveY=0;
		echo "Una de estas variables No es válido:\n";
		echo "Canal $channel debe ser mayor de 2 caracteres\n";
		echo "ExtraCanal $extrachannel debe ser mayor de 2 caracteres\n";
		echo "queryCID $queryCID debe ser mayor de 14 caracteres\n";
		echo "exten $exten debe ser fijado\n";
		echo "ext_context $ext_context debe ser fijado\n";
		echo "ext_priority $ext_priority debe ser fijado\n";
		echo "\nRedirect Action no enviado\n";
	}
	else
	{
		if (strlen($call_server_ip)<7) {$call_server_ip = $server_ip;}

		$stmt="SELECT count(*) FROM live_channels where server_ip = '$call_server_ip' and channel='$channel';";
			if ($format=='debug') {echo "\n<!-- $stmt -->";}
		$rslt=mysql_query($stmt, $link);
		$row=mysql_fetch_row($rslt);
		if ($row[0]==0)
		{
			$stmt="SELECT count(*) FROM live_sip_channels where server_ip = '$call_server_ip' and channel='$channel';";
				if ($format=='debug') {echo "\n<!-- $stmt -->";}
			$rslt=mysql_query($stmt, $link);
			$rowx=mysql_fetch_row($rslt);
			if ($rowx[0]==0)
			{
				$channel_liveX=0;
				echo "Canal $channel no está activo en $call_server_ip, Redirect comando no insertado\n";
			}	
		}
		$stmt="SELECT count(*) FROM live_channels where server_ip = '$server_ip' and channel='$extrachannel';";
			if ($format=='debug') {echo "\n<!-- $stmt -->";}
		$rslt=mysql_query($stmt, $link);
		$row=mysql_fetch_row($rslt);
		if ($row[0]==0)
		{
			$stmt="SELECT count(*) FROM live_sip_channels where server_ip = '$server_ip' and channel='$extrachannel';";
				if ($format=='debug') {echo "\n<!-- $stmt -->";}
			$rslt=mysql_query($stmt, $link);
			$rowx=mysql_fetch_row($rslt);
			if ($rowx[0]==0)
			{
				$channel_liveY=0;
				echo "Canal $channel no está activo en $server_ip, Redirect comando no insertado\n";
			}	
		}
		if ( ($channel_liveX==1) && ($channel_liveY==1) )
		{
			$stmt="SELECT count(*) FROM vicidial_live_agents where lead_id='$lead_id' and user!='$user';";
				if ($format=='debug') {echo "\n<!-- $stmt -->";}
			$rslt=mysql_query($stmt, $link);
			$rowx=mysql_fetch_row($rslt);
			if ($rowx[0] < 1)
			{
				$channel_liveY=0;
				echo "No Local agent to send call to, Redirect comando no insertado\n";
			}	
			else
			{
				$stmt="SELECT server_ip,conf_exten,user FROM vicidial_live_agents where lead_id='$lead_id' and user!='$user';";
					if ($format=='debug') {echo "\n<!-- $stmt -->";}
				$rslt=mysql_query($stmt, $link);
				$rowx=mysql_fetch_row($rslt);
				$dest_server_ip = $rowx[0];
				$dest_session_id = $rowx[1];
				$dest_user = $rowx[2];
				$S='*';

				$D_s_ip = explode('.', $dest_server_ip);
				if (strlen($D_s_ip[0])<2) {$D_s_ip[0] = "0$D_s_ip[0]";}
				if (strlen($D_s_ip[0])<3) {$D_s_ip[0] = "0$D_s_ip[0]";}
				if (strlen($D_s_ip[1])<2) {$D_s_ip[1] = "0$D_s_ip[1]";}
				if (strlen($D_s_ip[1])<3) {$D_s_ip[1] = "0$D_s_ip[1]";}
				if (strlen($D_s_ip[2])<2) {$D_s_ip[2] = "0$D_s_ip[2]";}
				if (strlen($D_s_ip[2])<3) {$D_s_ip[2] = "0$D_s_ip[2]";}
				if (strlen($D_s_ip[3])<2) {$D_s_ip[3] = "0$D_s_ip[3]";}
				if (strlen($D_s_ip[3])<3) {$D_s_ip[3] = "0$D_s_ip[3]";}
				$dest_dialstring = "$D_s_ip[0]$S$D_s_ip[1]$S$D_s_ip[2]$S$D_s_ip[3]$S$dest_session_id$S$lead_id$S$dest_user$S$phone_code$S$phone_number$S$campaign$S";

				$stmt="INSERT INTO vicidial_manager values('','','$NOW_TIME','NEW','N','$call_server_ip','','Redirect','$queryCID','Channel: $channel','Context: $ext_context','Exten: $dest_dialstring','Priority: $ext_priority','CallerID: $queryCID','','','','','');";
					if ($format=='debug') {echo "\n<!-- $stmt -->";}
				$rslt=mysql_query($stmt, $link);

				$stmt="INSERT INTO vicidial_manager values('','','$NOW_TIME','NEW','N','$server_ip','','Hangup','$queryCID','Channel: $extrachannel','','','','','','','','','');";
					if ($format=='debug') {echo "\n<!-- $stmt -->";}
				$rslt=mysql_query($stmt, $link);

				echo "RedirectXtraCX comando enviado a Canal $channel en $call_server_ip and \nHungup $extrachannel en $server_ip\n";
			}
		}
		else
		{
			if ($channel_liveX==1)
			{$ACTION="Redirect";   $server_ip = $call_server_ip;}
			if ($channel_liveY==1)
			{$ACTION="Redirect";   $channel=$extrachannel;}

		}
	}
}

if ($ACTION=="RedirectXtra")
{
	if ($channel=="$extrachannel")
	{$ACTION="Redirect";}
	else
	{
		$row='';   $rowx='';
		$channel_liveX=1;
		$channel_liveY=1;
		if ( (strlen($channel)<3) or (strlen($queryCID)<15) or (strlen($exten)<1) or (strlen($ext_context)<1) or (strlen($ext_priority)<1) or (strlen($extrachannel)<3) )
		{
			$channel_liveX=0;
			$channel_liveY=0;
			echo "Una de estas variables No es válido:\n";
			echo "Canal $channel debe ser mayor de 2 caracteres\n";
			echo "ExtraCanal $extrachannel debe ser mayor de 2 caracteres\n";
			echo "queryCID $queryCID debe ser mayor de 14 caracteres\n";
			echo "exten $exten debe ser fijado\n";
			echo "ext_context $ext_context debe ser fijado\n";
			echo "ext_priority $ext_priority debe ser fijado\n";
			echo "\nRedirect Action no enviado\n";
		}
		else
		{
			if ($exten == "NEXTAVAILABLE")
			{
			$stmt="SELECT conf_exten FROM conferences where server_ip='$server_ip' and ((extension='') or (extension is null)) limit 1;";
				if ($format=='debug') {echo "\n<!-- $stmt -->";}
			$rslt=mysql_query($stmt, $link);
			$row=mysql_fetch_row($rslt);
				if (strlen($row[0]) > 3)
				{
				$stmt="UPDATE conferences set extension='$user' where server_ip='$server_ip' and conf_exten='$row[0]';";
					if ($format=='debug') {echo "\n<!-- $stmt -->";}
				$rslt=mysql_query($stmt, $link);
				$exten = $row[0];
				}
				else
				{
				$channel_liveX=0;
				echo "No puede encontrar conferencia vacía en $server_ip, Redirect comando no insertado\n";
				}
			}

		if (strlen($call_server_ip)<7) {$call_server_ip = $server_ip;}

			$stmt="SELECT count(*) FROM live_channels where server_ip = '$call_server_ip' and channel='$channel';";
				if ($format=='debug') {echo "\n<!-- $stmt -->";}
			$rslt=mysql_query($stmt, $link);
			$row=mysql_fetch_row($rslt);
			if ($row[0]==0)
			{
				$stmt="SELECT count(*) FROM live_sip_channels where server_ip = '$call_server_ip' and channel='$channel';";
					if ($format=='debug') {echo "\n<!-- $stmt -->";}
				$rslt=mysql_query($stmt, $link);
				$rowx=mysql_fetch_row($rslt);
				if ($rowx[0]==0)
				{
					$channel_liveX=0;
					echo "Canal $channel no está activo en $call_server_ip, Redirect comando no insertado\n";
				}	
			}
			$stmt="SELECT count(*) FROM live_channels where server_ip = '$server_ip' and channel='$extrachannel';";
				if ($format=='debug') {echo "\n<!-- $stmt -->";}
			$rslt=mysql_query($stmt, $link);
			$row=mysql_fetch_row($rslt);
			if ($row[0]==0)
			{
				$stmt="SELECT count(*) FROM live_sip_channels where server_ip = '$server_ip' and channel='$extrachannel';";
					if ($format=='debug') {echo "\n<!-- $stmt -->";}
				$rslt=mysql_query($stmt, $link);
				$rowx=mysql_fetch_row($rslt);
				if ($rowx[0]==0)
				{
					$channel_liveY=0;
					echo "Canal $channel no está activo en $server_ip, Redirect comando no insertado\n";
				}	
			}
			if ( ($channel_liveX==1) && ($channel_liveY==1) )
			{
				if ( ($server_ip=="$call_server_ip") or (strlen($call_server_ip)<7) )
				{
					$stmt="INSERT INTO vicidial_manager values('','','$NOW_TIME','NEW','N','$server_ip','','Redirect','$queryCID','Channel: $channel','ExtraChannel: $extrachannel','Context: $ext_context','Exten: $exten','Priority: $ext_priority','CallerID: $queryCID','','','','');";
						if ($format=='debug') {echo "\n<!-- $stmt -->";}
					$rslt=mysql_query($stmt, $link);

					echo "RedirectXtra comando enviado a Canal $channel and \nExtraCanal $extrachannel\n to $exten en $server_ip\n";
				}
				else
				{
					$S='*';
					$D_s_ip = explode('.', $server_ip);
					if (strlen($D_s_ip[0])<2) {$D_s_ip[0] = "0$D_s_ip[0]";}
					if (strlen($D_s_ip[0])<3) {$D_s_ip[0] = "0$D_s_ip[0]";}
					if (strlen($D_s_ip[1])<2) {$D_s_ip[1] = "0$D_s_ip[1]";}
					if (strlen($D_s_ip[1])<3) {$D_s_ip[1] = "0$D_s_ip[1]";}
					if (strlen($D_s_ip[2])<2) {$D_s_ip[2] = "0$D_s_ip[2]";}
					if (strlen($D_s_ip[2])<3) {$D_s_ip[2] = "0$D_s_ip[2]";}
					if (strlen($D_s_ip[3])<2) {$D_s_ip[3] = "0$D_s_ip[3]";}
					if (strlen($D_s_ip[3])<3) {$D_s_ip[3] = "0$D_s_ip[3]";}
					$dest_dialstring = "$D_s_ip[0]$S$D_s_ip[1]$S$D_s_ip[2]$S$D_s_ip[3]$S$exten";

					$stmt="INSERT INTO vicidial_manager values('','','$NOW_TIME','NEW','N','$call_server_ip','','Redirect','$queryCID','Channel: $channel','Context: $ext_context','Exten: $dest_dialstring','Priority: $ext_priority','CallerID: $queryCID','','','','','');";
						if ($format=='debug') {echo "\n<!-- $stmt -->";}
					$rslt=mysql_query($stmt, $link);

					$stmt="INSERT INTO vicidial_manager values('','','$NOW_TIME','NEW','N','$server_ip','','Redirect','$queryCID','Channel: $extrachannel','Context: $ext_context','Exten: $exten','Priority: $ext_priority','CallerID: $queryCID','','','','','');";
						if ($format=='debug') {echo "\n<!-- $stmt -->";}
					$rslt=mysql_query($stmt, $link);

					echo "RedirectXtra comando enviado a Canal $channel en $call_server_ip and \nExtraCanal $extrachannel\n to $exten en $server_ip\n";
				}
			}
			else
			{
				if ($channel_liveX==1)
				{$ACTION="Redirect";   $server_ip = $call_server_ip;}
				if ($channel_liveY==1)
				{$ACTION="Redirect";   $channel=$extrachannel;}

			}
		}
	}
}


if ($ACTION=="Redirect")
{
	$row='';   $rowx='';
	$channel_live=1;
	if ( (strlen($channel)<3) or (strlen($queryCID)<15)  or (strlen($exten)<1)  or (strlen($ext_context)<1)  or (strlen($ext_priority)<1) )
	{
		$channel_live=0;
		echo "Una de estas variables No es válido:\n";
		echo "Canal $channel debe ser mayor de 2 caracteres\n";
		echo "queryCID $queryCID debe ser mayor de 14 caracteres\n";
		echo "exten $exten debe ser fijado\n";
		echo "ext_context $ext_context debe ser fijado\n";
		echo "ext_priority $ext_priority debe ser fijado\n";
		echo "\nRedirect Action no enviado\n";
	}
	else
	{
		if (strlen($call_server_ip)>6) {$server_ip = $call_server_ip;}
		$stmt="SELECT count(*) FROM live_channels where server_ip = '$server_ip' and channel='$channel';";
			if ($format=='debug') {echo "\n<!-- $stmt -->";}
		$rslt=mysql_query($stmt, $link);
		$row=mysql_fetch_row($rslt);
		if ($row[0]==0)
		{
			$stmt="SELECT count(*) FROM live_sip_channels where server_ip = '$server_ip' and channel='$channel';";
				if ($format=='debug') {echo "\n<!-- $stmt -->";}
			$rslt=mysql_query($stmt, $link);
			$rowx=mysql_fetch_row($rslt);
			if ($rowx[0]==0)
			{
				$channel_live=0;
				echo "Canal $channel no está activo en $server_ip, Redirect comando no insertado\n";
			}	
		}
		if ($channel_live==1)
		{
		$stmt="INSERT INTO vicidial_manager values('','','$NOW_TIME','NEW','N','$server_ip','','Redirect','$queryCID','Channel: $channel','Context: $ext_context','Exten: $exten','Priority: $ext_priority','CallerID: $queryCID','','','','','');";
			if ($format=='debug') {echo "\n<!-- $stmt -->";}
		$rslt=mysql_query($stmt, $link);

		echo "Redirect comando enviado a Canal $channel en $server_ip\n";
		}
	}
}



######################
# ACTION=Monitor or Stop Monitor  - insert Monitor/StopMonitor Manager statement to start recording on a channel
######################
if ( ($ACTION=="Monitor") || ($ACTION=="StopMonitor") )
{
	if ($ACTION=="StopMonitor")
		{$SQLfile = "";}
	else
		{$SQLfile = "File: $filename";}

	$row='';   $rowx='';
	$channel_live=1;
	if ( (strlen($channel)<3) or (strlen($queryCID)<15) or (strlen($filename)<15) )
	{
		$channel_live=0;
		echo "Canal $channel No es válido or queryCID $queryCID No es válido or filename: $filename No es válido, $ACTION comando no insertado\n";
	}
	else
	{
		$stmt="SELECT count(*) FROM live_channels where server_ip = '$server_ip' and channel='$channel';";
			if ($format=='debug') {echo "\n<!-- $stmt -->";}
		$rslt=mysql_query($stmt, $link);
		$row=mysql_fetch_row($rslt);
		if ($row[0]==0)
		{
			$stmt="SELECT count(*) FROM live_sip_channels where server_ip = '$server_ip' and channel='$channel';";
				if ($format=='debug') {echo "\n<!-- $stmt -->";}
			$rslt=mysql_query($stmt, $link);
			$rowx=mysql_fetch_row($rslt);
			if ($rowx[0]==0)
			{
				$channel_live=0;
				echo "Canal $channel no está activo en $server_ip, $ACTION comando no insertado\n";
			}	
		}
		if ($channel_live==1)
		{
		$stmt="INSERT INTO vicidial_manager values('','','$NOW_TIME','NEW','N','$server_ip','','$ACTION','$queryCID','Channel: $channel','$SQLfile','','','','','','','','');";
			if ($format=='debug') {echo "\n<!-- $stmt -->";}
		$rslt=mysql_query($stmt, $link);

		if ($ACTION=="Monitor")
			{
			$stmt = "INSERT INTO recording_log (channel,server_ip,extension,start_time,start_epoch,filename) values('$channel','$server_ip','$exten','$NOW_TIME','$StarTtime','$filename')";
				if ($format=='debug') {echo "\n<!-- $stmt -->";}
			$rslt=mysql_query($stmt, $link);

			$stmt="SELECT recording_id FROM recording_log where filename='$filename'";
			$rslt=mysql_query($stmt, $link);
			if ($DB) {echo "$stmt\n";}
			$row=mysql_fetch_row($rslt);
			$recording_id = $row[0];
			}
		else
			{
			$stmt="SELECT recording_id,start_epoch FROM recording_log where filename='$filename'";
			$rslt=mysql_query($stmt, $link);
			if ($DB) {echo "$stmt\n";}
			$rec_count = mysql_num_rows($rslt);
				if ($rec_count>0)
				{
				$row=mysql_fetch_row($rslt);
				$recording_id = $row[0];
				$start_time = $row[1];
				$length_in_sec = ($StarTtime - $start_time);
				$length_in_min = ($length_in_sec / 60);
				$length_in_min = sprintf("%8.2f", $length_in_min);

				$stmt = "UPDATE recording_log set end_time='$NOW_TIME',end_epoch='$StarTtime',length_in_sec=$length_in_sec,length_in_min='$length_in_min' where filename='$filename'";
					if ($DB) {echo "$stmt\n";}
				$rslt=mysql_query($stmt, $link);
				}

			}
		echo "$ACTION comando enviado a Canal $channel en $server_ip\nFilename: $filename\nRecorDing_ID: $recording_id\n";
		}
	}
}






######################
# ACTION=MonitorConf or StopMonitorConf  - insert Monitor/StopMonitor Manager statement to start recording on a conference
######################
if ( ($ACTION=="MonitorConf") || ($ACTION=="StopMonitorConf") )
{
	$row='';   $rowx='';
	$channel_live=1;
	if ( (strlen($exten)<3) or (strlen($channel)<4) or (strlen($filename)<15) )
	{
		$channel_live=0;
		echo "Canal $channel No es válido or exten $exten No es válido or filename: $filename No es válido, $ACTION comando no insertado\n";
	}
	else
	{

	if ($ACTION=="MonitorConf")
		{
		$stmt="INSERT INTO vicidial_manager values('','','$NOW_TIME','NEW','N','$server_ip','','Originate','$filename','Channel: $channel','Context: $ext_context','Exten: $exten','Priority: $ext_priority','Callerid: $filename','','','','','');";
			if ($format=='debug') {echo "\n<!-- $stmt -->";}
		$rslt=mysql_query($stmt, $link);

		$stmt = "INSERT INTO recording_log (channel,server_ip,extension,start_time,start_epoch,filename) values('$channel','$server_ip','$exten','$NOW_TIME','$StarTtime','$filename')";
			if ($format=='debug') {echo "\n<!-- $stmt -->";}
		$rslt=mysql_query($stmt, $link);

		$stmt="SELECT recording_id FROM recording_log where filename='$filename'";
		$rslt=mysql_query($stmt, $link);
		if ($DB) {echo "$stmt\n";}
		$row=mysql_fetch_row($rslt);
		$recording_id = $row[0];
		}
	else
		{
		$stmt="SELECT recording_id,start_epoch FROM recording_log where filename='$filename'";
		$rslt=mysql_query($stmt, $link);
		if ($DB) {echo "$stmt\n";}
		$rec_count = mysql_num_rows($rslt);
			if ($rec_count>0)
			{
			$row=mysql_fetch_row($rslt);
			$recording_id = $row[0];
			$start_time = $row[1];
			$length_in_sec = ($StarTtime - $start_time);
			$length_in_min = ($length_in_sec / 60);
			$length_in_min = sprintf("%8.2f", $length_in_min);

			$stmt = "UPDATE recording_log set end_time='$NOW_TIME',end_epoch='$StarTtime',length_in_sec=$length_in_sec,length_in_min='$length_in_min' where filename='$filename'";
				if ($DB) {echo "$stmt\n";}
			$rslt=mysql_query($stmt, $link);
			}

		# find and hang up all recordings going en in this conference # and extension = '$exten' 
		$stmt="SELECT channel FROM live_sip_channels where server_ip = '$server_ip' and channel LIKE \"$channel%\" and channel LIKE \"%,1\";";
			if ($format=='debug') {echo "\n<!-- $stmt -->";}
		$rslt=mysql_query($stmt, $link);
	#	$rec_count = intval(mysql_num_rows($rslt) / 2);
		$rec_count = mysql_num_rows($rslt);
		$h=0;
			while ($rec_count>$h)
			{
			$rowx=mysql_fetch_row($rslt);
			$HUchannel[$h] = $rowx[0];
			$h++;
			}
		$i=0;
			while ($h>$i)
			{
			$stmt="INSERT INTO vicidial_manager values('','','$NOW_TIME','NEW','N','$server_ip','','Hangup','RH12345$StarTtime$i','Channel: $HUchannel[$i]','','','','','','','','','');";
				if ($format=='debug') {echo "\n<!-- $stmt -->";}
			$rslt=mysql_query($stmt, $link);
			$i++;
			}

		}
		echo "$ACTION comando enviado a Canal $channel en $server_ip\nFilename: $filename\nRecorDing_ID: $recording_id\n LA GRABACIÓN DURARÁ HASTA 60 MINUTOS\n";
	}
}












$ENDtime = date("U");
$RUNtime = ($ENDtime - $StarTtime);
if ($format=='debug') {echo "\n<!-- tiempo de ejecución del Script: $RUNtime segundos -->";}
if ($format=='debug') {echo "\n</body>\n</html>\n";}
	
exit; 

?>





