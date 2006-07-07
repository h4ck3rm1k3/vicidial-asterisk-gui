<?
### remote_inbound.php
### 
### Copyright (C) 2006  Matt Florell <vicidial@gmail.com>    LICENSE: GPLv2
###
# the purpose of this script and webpage is to allow for remote or local users of the system to log in and grab phone calls that are coming inbound into the Asterisk server and being put in the parked_channels table while they hear a soundfile for a limited amount of time before being forwarded on to either a set extension or a voicemail box. This gives remote or local agents a way to grab calls without tying up their phone lines all day. The agent sees the refreshing screen of calls on park and when they want to take one they just click on it, and a small window opens that will allow them to grab the call and/or look up more information on the caller through the callerID that is given(if available)

require("dbconnect.php");

$PHP_AUTH_USER=$_SERVER['PHP_AUTH_USER'];
$PHP_AUTH_PW=$_SERVER['PHP_AUTH_PW'];
$PHP_SELF=$_SERVER['PHP_SELF'];
$submit=$_GET["submit"];				if (!$submit) {$submit=$_POST["submit"];}
$SUBMIT=$_GET["SUBMIT"];				if (!$SUBMIT) {$SUBMIT=$_POST["SUBMIT"];}


$STARTtime = date("U");
$TODAY = date("Y-m-d");
$NOW_TIME = date("Y-m-d H:i:s");
$popup_page = './inbound_popup.php';

	$stmt="SELECT count(*) from phones where login='$PHP_AUTH_USER' and pass='$PHP_AUTH_PW' and active = 'Y' and status IN('ACTIVE','ADMIN');";
	$rslt=mysql_query($stmt, $link);
	$row=mysql_fetch_row($rslt);
	$auth=$row[0];

$fp = fopen ("./project_auth_entries.txt", "a");
$date = date("r");
$ip = getenv("REMOTE_ADDR");
$browser = getenv("HTTP_USER_AGENT");

  if( (strlen($PHP_AUTH_USER)<2) or (strlen($PHP_AUTH_PW)<2) or (!$auth))
	{
    Header("WWW-Authenticate: Basic realm=\"VICI-ASTERISK\"");
    Header("HTTP/1.0 401 Unauthorized");
    echo "Unzulässiges Username/Kennwort:|$PHP_AUTH_USER|$PHP_AUTH_PW|\n";
    exit;
	}
  else
	{

	if($auth>0)
		{
		$office_no=strtoupper($PHP_AUTH_USER);
		$password=strtoupper($PHP_AUTH_PW);
			$stmt="SELECT fullname,dialplan_number from phones where login='$PHP_AUTH_USER' and pass='$PHP_AUTH_PW'";
			if ($DB) {echo "$stmt\n";}
			$rslt=mysql_query($stmt, $link);
			$row=mysql_fetch_row($rslt);
			$LOGfullname=$row[0];
		fwrite ($fp, "ASTERISK|GOOD|$date|$PHP_AUTH_USER|$PHP_AUTH_PW|$ip|$browser|$LOGfullname|\n");
		fclose($fp);

		##### get server listing for dynamic pulldown
		$stmt="SELECT fullname,dialplan_number,server_ip from phones where login='$PHP_AUTH_USER' and pass='$PHP_AUTH_PW'";
		if ($DB) {echo "$stmt\n";}
		$rsltx=mysql_query($stmt, $link);
		$rowx=mysql_fetch_row($rsltx);
		$fullname = $rowx[0];
		$dialplan_number = $rowx[1];
		$user_server_ip = $rowx[2];
		if ($DB) {echo "|$rowx[0]|$rowx[1]|$rowx[2]|\n";}
		}
	else
		{
		fwrite ($fp, "ASTERISK|FAIL|$date|$PHP_AUTH_USER|$PHP_AUTH_PW|$ip|$browser|\n");
		fclose($fp);
		}
	}

	echo"<HTML><HEAD>\n";
	echo"<TITLE>ASTERISK ENTFERNTINBOUND: Hauptsächlich</TITLE></HEAD>\n";
	echo"<META HTTP-EQUIV=\"Content-Type\" CONTENT=\"text/html; charset=iso-8859-1\">\n";
	echo"<META HTTP-EQUIV=Refresh CONTENT=\"5; URL=$PHP_SELF\">\n";
	echo"</HEAD>\n";

?>

<BODY BGCOLOR=white marginheight=0 marginwidth=0 leftmargin=0 topmargin=0>
<CENTER><FONT FACE="Courier" COLOR=BLACK SIZE=3>

<? 


echo "$NOW_TIME &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; $PHP_AUTH_USER - $fullname -  ANRUFE GESCHICKT ZU: $dialplan_number<BR><BR>\n";

echo "Klicken Sie an die Führung unter der, die Sie auf Ihr Telefonverwiesen haben möchten<BR><BR>\n";

echo "<PRE>\n";
echo "CHANNEL    BEDIENER       CHANNEL_GROUP   EXTENSION    PARKED_BY            PARKED_TIME        \n";
echo "----------------------------------------------------------------------------------------------\n";





$stmt="SELECT count(*) from parked_channels where server_ip='$user_server_ip' order by parked_time";
$rslt=mysql_query($stmt, $link);
if ($DB) {echo "$stmt\n";}
$row=mysql_fetch_row($rslt);
$parked_count = $row[0];
	if ($parked_count > 0)
	{
	$stmt="SELECT * from parked_channels where server_ip='$user_server_ip' and channel_group LIKE \"IN_%\" order by parked_time";
	$rslt=mysql_query($stmt, $link);
	if ($DB) {echo "$stmt\n";}
	$parked_to_print = mysql_num_rows($rslt);
	$i=0;
	while ($i < $parked_to_print)
		{
		$row=mysql_fetch_row($rslt);
		$channel =			sprintf("%-11s", $row[0]);
		$server =			sprintf("%-14s", $row[1]);
		$channel_group =	sprintf("%-16s", $row[2]);
		$extension =		sprintf("%-13s", $row[3]);
		$parked_by =		sprintf("%-21s", $row[4]);
		$parked_time =		sprintf("%-19s", $row[5]);

		echo "<A HREF=\"$popup_page?phone=$row[4]&channel=$row[0]&parked_time=$row[5]&server_ip=$user_server_ip&DB=\" target=\"_blank\">$channel</A>$server$channel_group$extension$parked_by$parked_time\n";

		$i++;
		}

	}
	else
	{
	echo "**********************************************************************************************\n";
	echo "**********************************************************************************************\n";
	echo "*************************************** NO PARKED CALLS **************************************\n";
	echo "**********************************************************************************************\n";
	echo "**********************************************************************************************\n";
	}


$ENDtime = date("U");

$RUNtime = ($ENDtime - $STARTtime);

echo "</PRE>\n\n\n<br><br><br>\n\n";


echo "<font size=0>\n\n\n<br><br><br>\nIndexlaufzeit: $RUNtime seconds</font>";


?>


</body>
</html>

<?
	
exit; 



?>





