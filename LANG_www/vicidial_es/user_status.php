<?
### user_status.php
### 
### Copyright (C) 2006  Matt Florell <vicidial@gmail.com>    LICENSE: GPLv2
###
# CHANGES
#
# 60619-1738 - Added variable filtering to eliminate SQL injection attack threat
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
if (isset($_GET["group"]))				{$group=$_GET["group"];}
	elseif (isset($_POST["group"]))		{$group=$_POST["group"];}
if (isset($_GET["stage"]))				{$stage=$_GET["stage"];}
	elseif (isset($_POST["stage"]))		{$stage=$_POST["stage"];}
if (isset($_GET["submit"]))				{$submit=$_GET["submit"];}
	elseif (isset($_POST["submit"]))		{$submit=$_POST["submit"];}
if (isset($_GET["ENVIAR"]))				{$ENVIAR=$_GET["ENVIAR"];}
	elseif (isset($_POST["ENVIAR"]))		{$ENVIAR=$_POST["ENVIAR"];}

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
    echo "Nombre y contraseña inválidos del usuario: |$PHP_AUTH_USER|$PHP_AUTH_PW|\n";
    exit;
	}
  else
	{

	if($auth>0)
		{
			$stmt="SELECT full_name,change_agent_campaign from vicidial_users where user='$PHP_AUTH_USER' and pass='$PHP_AUTH_PW'";
			$rslt=mysql_query($stmt, $link);
			$row=mysql_fetch_row($rslt);
			$LOGfullname=$row[0];
			$change_agent_campaign=$row[1];
		fwrite ($fp, "VICIDIAL|GOOD|$date|$PHP_AUTH_USER|$PHP_AUTH_PW|$ip|$browser|$LOGfullname|\n");
		fclose($fp);
		}
	else
		{
		fwrite ($fp, "VICIDIAL|FAIL|$date|$PHP_AUTH_USER|$PHP_AUTH_PW|$ip|$browser|\n");
		fclose($fp);
		}

	$stmt="SELECT full_name from vicidial_users where user='" . mysql_real_escape_string($user) . "';";
	$rslt=mysql_query($stmt, $link);
	$row=mysql_fetch_row($rslt);
	$full_name = $row[0];

	$stmt="SELECT * from vicidial_live_agents where user='" . mysql_real_escape_string($user) . "';";
	$rslt=mysql_query($stmt, $link);
	if ($DB) {echo "$stmt\n";}
	$agents_to_print = mysql_num_rows($rslt);
	$i=0;
	while ($i < $agents_to_print)
		{
		$row=mysql_fetch_row($rslt);
		$Aserver_ip =		$row[2];
		$Asession_id =		$row[3];
		$Aextension =		$row[4];
		$Astatus =			$row[5];
		$Acampaign =		$row[7];
		$Alast_call =		$row[14];
		$Acl_campaigns =	$row[15];
		$i++;
		}

	}

$stmt="select * from vicidial_campaigns;";
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
<html>
<head>
<title>VICIDIAL ADMIN: User Status</title>
<?
echo "<META HTTP-EQUIV=\"Content-Type\" CONTENT=\"text/html; charset=utf-8\">\n";
?>
</head>
<BODY BGCOLOR=white marginheight=0 marginwidth=0 leftmargin=0 topmargin=0>
<CENTER>
<TABLE WIDTH=620 BGCOLOR=#D9E6FE cellpadding=2 cellspacing=0><TR BGCOLOR=#015B91><TD ALIGN=LEFT><? echo "<a href=\"./admin.php\">" ?><FONT FACE="ARIAL,HELVETICA" COLOR=WHITE SIZE=2><B> &nbsp; VICIDIAL ADMIN</a>: User Status for <? echo $user ?></TD><TD ALIGN=RIGHT><FONT FACE="ARIAL,HELVETICA" COLOR=WHITE SIZE=2><B><? echo date("l F j, Y G:i:s A") ?> &nbsp; </TD></TR>




<? 

echo "<TR BGCOLOR=\"#F0F5FE\"><TD ALIGN=LEFT COLSPAN=2><FONT FACE=\"ARIAL,HELVETICA\" COLOR=BLACK SIZE=3><B> &nbsp; \n";

if ($stage == "live_campaign_change")
{
	$stmt="UPDATE vicidial_live_agents set campaign_id='" . mysql_real_escape_string($group) . "' where user='" . mysql_real_escape_string($user) . "';";
	$rslt=mysql_query($stmt, $link);

	echo "Agent $user - $full_name changed to $group campaign<BR>\n";
	
	exit;
}

if ($stage == "log_agent_out")
{
	$stmt="DELETE from vicidial_live_agents where user='" . mysql_real_escape_string($user) . "';";
	$rslt=mysql_query($stmt, $link);

	echo "Agent $user - $full_name has been emergency logged out, make sure they close their web browser<BR>\n";
	
	exit;
}

if ($agents_to_print > 0)
{
	echo "<PRE>";
	echo "Agent Logged in at server:  $Aserver_ip\n";
	echo "               in session:  $Asession_id\n";
	echo "               from phone:  $Aextension\n";
	echo "Agent is in campaign:       $Acampaign\n";
	echo "              status:       $Astatus\n";
	echo " hungup last call at:       $Alast_call\n";
	echo "       Closer groups:       $Acl_campaigns\n\n";

	echo "</PRE>";


	if ($change_agent_campaign > 0)
	{
		echo "<form action=$PHP_SELF method=POST>\n";
		echo "<input type=hidden name=user value=\"$user\">\n";
		echo "<input type=hidden name=stage value=\"live_campaign_change\">\n";
		echo "Current Campaña: <SELECT SIZE=1 NAME=group>\n";
			$o=0;
			while ($groups_to_print > $o)
			{
				if ($groups[$o] == "$Acampaign") {echo "<option selected value=\"$groups[$o]\">$groups[$o]</option>\n";}
				  else {echo "<option value=\"$groups[$o]\">$groups[$o]</option>\n";}
				$o++;
			}
		echo "</SELECT>\n";
		echo "<input type=submit name=submit value=CHANGE><BR></form>\n";


		echo "<form action=$PHP_SELF method=POST>\n";
		echo "<input type=hidden name=user value=\"$user\">\n";
		echo "<input type=hidden name=stage value=\"log_agent_out\">\n";
		echo "<input type=submit name=submit value=\"EMERGENCY LOG AGENTE OUT\"><BR></form>\n";
	}
}

else
{
	echo "Agent is not logged in\n<BR>";

}


echo " &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; $user - $full_name - \n";

echo "<a href=\"./AST_agent_time_sheet.php?agent=$user\">VICIDIAL Time Sheet</a>\n";

echo "</B></TD></TR>\n";
echo "<TR><TD ALIGN=LEFT COLSPAN=2>\n";


$ENDtime = date("U");

$RUNtime = ($ENDtime - $STARTtime);

echo "\n\n\n<br><br><br>\n\n";


echo "<font size=0>\n\n\n<br><br><br>\nScript runtime: $RUNtime seconds</font>";

echo "|$stage|$group|";

?>


</TD></TR><TABLE>
</body>
</html>

<?
	
exit; 



?>





