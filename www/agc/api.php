<?
# api.php
# 
# Copyright (C) 2008  Matt Florell <vicidial@gmail.com>    LICENSE: AGPLv2
#
# This script is designed as an API(Application Programming Interface) to allow
# other programs to interact with the VICIDIAL Agent screen
# 
# required variables:
#  - $user
#  - $pass
#  - $agent_user
#  - $function - ('external_hangup','external_status')
#  - $value
#  - $extra_value
#  - $format - ('text','debug')

# CHANGELOG:
# 80703-2225 - First build of script
#

$version = '2.0.5-1';
$build = '80703-2225';

require("dbconnect.php");

### If you have globals turned off uncomment these lines
if (isset($_GET["user"]))						{$user=$_GET["user"];}
	elseif (isset($_POST["user"]))				{$user=$_POST["user"];}
if (isset($_GET["pass"]))						{$pass=$_GET["pass"];}
	elseif (isset($_POST["pass"]))				{$pass=$_POST["pass"];}
if (isset($_GET["agent_user"]))					{$agent_user=$_GET["agent_user"];}
	elseif (isset($_POST["agent_user"]))		{$agent_user=$_POST["agent_user"];}
if (isset($_GET["function"]))					{$function=$_GET["function"];}
	elseif (isset($_POST["function"]))			{$function=$_POST["function"];}
if (isset($_GET["value"]))						{$value=$_GET["value"];}
	elseif (isset($_POST["value"]))				{$value=$_POST["value"];}
if (isset($_GET["extra_value"]))				{$extra_value=$_GET["extra_value"];}
	elseif (isset($_POST["extra_value"]))		{$extra_value=$_POST["extra_value"];}
if (isset($_GET["format"]))						{$format=$_GET["format"];}
	elseif (isset($_POST["format"]))			{$format=$_POST["format"];}


header ("Content-type: text/html; charset=utf-8");
header ("Cache-Control: no-cache, must-revalidate");  // HTTP/1.1
header ("Pragma: no-cache");                          // HTTP/1.0

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

if ($non_latin < 1)
{
$user=ereg_replace("[^0-9a-zA-Z]","",$user);
$pass=ereg_replace("[^0-9a-zA-Z]","",$pass);
$agent_user=ereg_replace("[^0-9a-zA-Z]","",$agent_user);
}

$StarTtime = date("U");
$NOW_DATE = date("Y-m-d");
$NOW_TIME = date("Y-m-d H:i:s");
$CIDdate = date("mdHis");
$ENTRYdate = date("YmdHis");
$MT[0]='';

if ($ACTION == 'LogiNCamPaigns')
	{
	$skip_user_validation=1;
	}
else
	{
	$stmt="SELECT count(*) from vicidial_users where user='$user' and pass='$pass' and vdc_agent_api_access = '1';";
	if ($DB) {echo "|$stmt|\n";}
	if ($non_latin > 0) {$rslt=mysql_query("SET NAMES 'UTF8'");}
	$rslt=mysql_query($stmt, $link);
	$row=mysql_fetch_row($rslt);
	$auth=$row[0];

	if( (strlen($user)<2) or (strlen($pass)<2) or ($auth==0))
		{
		echo "ERROR: Invalid Username/Password: |$user|$pass|$auth|\n";
		exit;
		}
	else
		{
		$stmt="SELECT count(*) from system_settings where vdc_agent_api_active='1';";
		if ($DB) {echo "|$stmt|\n";}
		$rslt=mysql_query($stmt, $link);
		$row=mysql_fetch_row($rslt);
		$SNauth=$row[0];
		  if($SNauth==0)
			{
			echo "ERROR: System API NOT ACTIVE\n";
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
echo "<!-- VERSION: $version     BUILD: $build    USER: $user\n";
echo "<title>VICIDiaL Agent API";
echo "</title>\n";
echo "</head>\n";
echo "<BODY BGCOLOR=white marginheight=0 marginwidth=0 leftmargin=0 topmargin=0>\n";
}




################################################################################
### external_hangup - hang up the active agent call
################################################################################
if ($function == 'external_hangup')
{
	if ( (strlen($value)<1) || (strlen($agent_user)<1) )
	{
	echo "ERROR: external_hangup not valid - $value|$agent_user\n";
	exit;
	}
	else
	{
	$stmt = "select count(*) from vicidial_live_agents where user='$agent_user';";
	if ($DB) {echo "$stmt\n";}
	$rslt=mysql_query($stmt, $link);
	$row=mysql_fetch_row($rslt);
	if ($row[0] > 0)
		{
		$stmt="UPDATE vicidial_live_agents set external_hangup='$value' where user='$agent_user';";
			if ($format=='debug') {echo "\n<!-- $stmt -->";}
		$rslt=mysql_query($stmt, $link);
		echo "SUCCESS: external_hangup function set - $agent_user|$value\n";
		}
	else
		{
		echo "ERROR: agent_user is not logged in - $agent_user\n";
		}
	}
}





################################################################################
### external_status - set the dispo code or status for a call and move on
################################################################################
if ($function == 'external_status')
{
	if ( (strlen($value)<1) || (strlen($agent_user)<1) )
	{
	echo "ERROR: external_status not valid - $value|$agent_user\n";
	exit;
	}
	else
	{
	$stmt = "select count(*) from vicidial_live_agents where user='$agent_user';";
	if ($DB) {echo "$stmt\n";}
	$rslt=mysql_query($stmt, $link);
	$row=mysql_fetch_row($rslt);
	if ($row[0] > 0)
		{
		$stmt="UPDATE vicidial_live_agents set external_status='$value' where user='$agent_user';";
			if ($format=='debug') {echo "\n<!-- $stmt -->";}
		$rslt=mysql_query($stmt, $link);
		echo "SUCCESS: external_status function set - $agent_user|$value\n";
		}
	else
		{
		echo "ERROR: agent_user is not logged in - $agent_user\n";
		}
	}
}





if ($format=='debug') 
{
$ENDtime = date("U");
$RUNtime = ($ENDtime - $StarTtime);
echo "\n<!-- script runtime: $RUNtime seconds -->";
echo "\n</body>\n</html>\n";
}
	
exit; 

?>
