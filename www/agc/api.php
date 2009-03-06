<?
# api.php
# 
# Copyright (C) 2009  Matt Florell <vicidial@gmail.com>    LICENSE: AGPLv2
#
# This script is designed as an API(Application Programming Interface) to allow
# other programs to interact with the VICIDIAL Agent screen
# 
# required variables:
#  - $user
#  - $pass
#  - $agent_user
#  - $function - ('external_hangup','external_status','external_pause')
#  - $value
#  - $vendor_id
#  - $focus
#  - $preview
#  - $notes
#  - $phone_code
#  - $search
#  - $group_alias
#  - $dial_prefix
#  - $source - ('vtiger','webform','adminweb')
#  - $format - ('text','debug')

# CHANGELOG:
# 80703-2225 - First build of script
# 90116-1229 - Added external_pause and external_dial functions
# 90118-1051 - Added logging of API functions
# 90128-0229 - Added vendor_id to dial function
# 90303-0723 - Added group alias and dial prefix
#

$version = '2.0.5-5';
$build = '90303-0723';

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
if (isset($_GET["vendor_id"]))					{$vendor_id=$_GET["vendor_id"];}
	elseif (isset($_POST["vendor_id"]))			{$vendor_id=$_POST["vendor_id"];}
if (isset($_GET["focus"]))						{$focus=$_GET["focus"];}
	elseif (isset($_POST["focus"]))				{$focus=$_POST["focus"];}
if (isset($_GET["preview"]))					{$preview=$_GET["preview"];}
	elseif (isset($_POST["preview"]))			{$preview=$_POST["preview"];}
if (isset($_GET["notes"]))						{$notes=$_GET["notes"];}
	elseif (isset($_POST["notes"]))				{$notes=$_POST["notes"];}
if (isset($_GET["phone_code"]))					{$phone_code=$_GET["phone_code"];}
	elseif (isset($_POST["phone_code"]))		{$phone_code=$_POST["phone_code"];}
if (isset($_GET["search"]))						{$search=$_GET["search"];}
	elseif (isset($_POST["search"]))			{$search=$_POST["search"];}
if (isset($_GET["group_alias"]))				{$group_alias=$_GET["group_alias"];}
	elseif (isset($_POST["group_alias"]))		{$group_alias=$_POST["group_alias"];}
if (isset($_GET["dial_prefix"]))				{$dial_prefix=$_GET["dial_prefix"];}
	elseif (isset($_POST["dial_prefix"]))		{$dial_prefix=$_POST["dial_prefix"];}
if (isset($_GET["source"]))						{$source=$_GET["source"];}
	elseif (isset($_POST["source"]))			{$source=$_POST["source"];}
if (isset($_GET["format"]))						{$format=$_GET["format"];}
	elseif (isset($_POST["format"]))			{$format=$_POST["format"];}

$group_alias = ereg_replace("[^0-9a-zA-Z]","",$group_alias);
$dial_prefix = ereg_replace("[^0-9a-zA-Z]","",$dial_prefix);

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
$function = ereg_replace("[^-\_0-9a-zA-Z]","",$function);
$value = ereg_replace("[^-\_0-9a-zA-Z]","",$value);
$vendor_id = ereg_replace("[^-\_0-9a-zA-Z]","",$vendor_id);
$focus = ereg_replace("[^-\_0-9a-zA-Z]","",$focus);
$preview = ereg_replace("[^-\_0-9a-zA-Z]","",$preview);
	$notes = ereg_replace("\+"," ",$notes);
$notes = ereg_replace("[^ -\_0-9a-zA-Z]","",$notes);
$phone_code = ereg_replace("[^0-9X]","",$phone_code);
$search = ereg_replace("[^-\_0-9a-zA-Z]","",$search);
$group_alias = ereg_replace("[^0-9a-zA-Z]","",$group_alias);
$dial_prefix = ereg_replace("[^0-9a-zA-Z]","",$dial_prefix);
$source = ereg_replace("[^0-9a-zA-Z]","",$source);
$format = ereg_replace("[^0-9a-zA-Z]","",$format);
}

### date and fixed variables
$epoch = date("U");
$StarTtime = date("U");
$NOW_DATE = date("Y-m-d");
$NOW_TIME = date("Y-m-d H:i:s");
$CIDdate = date("mdHis");
$ENTRYdate = date("YmdHis");
$MT[0]='';
$api_script = 'agent';
$api_logging = 1;


################################################################################
### BEGIN - version - show version and date information for the API
################################################################################
if ($function == 'version')
	{
	$data = "VERSION: $version|BUILD: $build|DATE: $NOW_TIME|EPOCH: $StarTtime";
	$result = 'SUCCESS';
	echo "$data\n";
	api_log($link,$api_logging,$api_script,$user,$agent_user,$function,$value,$result,$result_reason,$source,$data);
	exit;
	}
################################################################################
### END - version
################################################################################





################################################################################
### BEGIN - user validation section
################################################################################

if ($ACTION == 'LogiNCamPaigns')
	{
	$skip_user_validation=1;
	}
else
	{
	if(strlen($source)<2)
		{
		$result = 'ERROR';
		$result_reason = "Invalid Source";
		echo "$result: $result_reason - $source\n";
		api_log($link,$api_logging,$api_script,$user,$agent_user,$function,$value,$result,$result_reason,$source,$data);
		exit;
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
			$result = 'ERROR';
			$result_reason = "Invalid Username/Password";
			echo "$result: $result_reason: |$user|$pass|$auth|\n";
			$data = "$user|$pass|$auth";
			api_log($link,$api_logging,$api_script,$user,$agent_user,$function,$value,$result,$result_reason,$source,$data);
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
				$result = 'ERROR';
				$result_reason = "System API NOT ACTIVE";
				echo "$result: $result_reason\n";
				api_log($link,$api_logging,$api_script,$user,$agent_user,$function,$value,$result,$result_reason,$source,$data);
				exit;
				}
			  else
				{
				# do nothing for now
				}
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
### END - user validation section
################################################################################





################################################################################
### BEGIN - external_hangup - hang up the active agent call
################################################################################
if ($function == 'external_hangup')
{
	if ( (strlen($value)<1) || (strlen($agent_user)<1) )
	{
	$result = 'ERROR';
	$result_reason = "external_hangup not valid";
	echo "$result: $result_reason - $value|$agent_user\n";
	api_log($link,$api_logging,$api_script,$user,$agent_user,$function,$value,$result,$result_reason,$source,$data);
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
		$result = 'SUCCESS';
		$result_reason = "external_hangup function set";
		echo "$result: $result_reason - $value|$agent_user\n";
		api_log($link,$api_logging,$api_script,$user,$agent_user,$function,$value,$result,$result_reason,$source,$data);
		}
	else
		{
		$result = 'ERROR';
		$result_reason = "agent_user is not logged in";
		echo "$result: $result_reason - $agent_user\n";
		api_log($link,$api_logging,$api_script,$user,$agent_user,$function,$value,$result,$result_reason,$source,$data);
		}
	}
}
################################################################################
### END - external_hangup
################################################################################





################################################################################
### BEGIN - external_status - set the dispo code or status for a call and move on
################################################################################
if ($function == 'external_status')
{
	if ( (strlen($value)<1) || (strlen($agent_user)<1) )
	{
	$result = 'ERROR';
	$result_reason = "external_status not valid";
	echo "$result: $result_reason - $value|$agent_user\n";
	api_log($link,$api_logging,$api_script,$user,$agent_user,$function,$value,$result,$result_reason,$source,$data);
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
		$result = 'SUCCESS';
		$result_reason = "external_status function set";
		echo "$result: $result_reason - $value|$agent_user\n";
		api_log($link,$api_logging,$api_script,$user,$agent_user,$function,$value,$result,$result_reason,$source,$data);
		}
	else
		{
		$result = 'ERROR';
		$result_reason = "agent_user is not logged in";
		echo "$result: $result_reason - $agent_user\n";
		api_log($link,$api_logging,$api_script,$user,$agent_user,$function,$value,$result,$result_reason,$source,$data);
		}
	}
}
################################################################################
### END - external_status
################################################################################





################################################################################
### BEGIN - external_pause - pause or resume the agent
################################################################################
if ($function == 'external_pause')
{
	if ( (strlen($value)<1) || (strlen($agent_user)<1) || (!ereg("PAUSE|RESUME",$value)) )
	{
	$result = 'ERROR';
	$result_reason = "external_pause not valid";
	echo "$result: $result_reason - $value|$agent_user\n";
	api_log($link,$api_logging,$api_script,$user,$agent_user,$function,$value,$result,$result_reason,$source,$data);
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
		if (ereg("RESUME",$value))
			{
			$stmt = "select count(*) from vicidial_live_agents where user='$agent_user' and status IN('READY','QUEUE','INCALL','CLOSER');";
			if ($DB) {echo "$stmt\n";}
			$rslt=mysql_query($stmt, $link);
			$row=mysql_fetch_row($rslt);
			if ($row[0] > 0)
				{
				$result = 'ERROR';
				$result_reason = "external_pause agent is not paused";
				echo "$result: $result_reason - $value|$agent_user\n";
				api_log($link,$api_logging,$api_script,$user,$agent_user,$function,$value,$result,$result_reason,$source,$data);
				exit;
				}
			}
		$stmt="UPDATE vicidial_live_agents set external_pause='$value!$epoch' where user='$agent_user';";
			if ($format=='debug') {echo "\n<!-- $stmt -->";}
		$rslt=mysql_query($stmt, $link);
		$result = 'SUCCESS';
		$result_reason = "external_pause function set";
		echo "$result: $result_reason - $value|$epoch|$agent_user\n";
		$data = "$epoch";
		api_log($link,$api_logging,$api_script,$user,$agent_user,$function,$value,$result,$result_reason,$source,$data);
		}
	else
		{
		$result = 'ERROR';
		$result_reason = "agent_user is not logged in";
		echo "$result: $result_reason - $agent_user\n";
		api_log($link,$api_logging,$api_script,$user,$agent_user,$function,$value,$result,$result_reason,$source,$data);
		}
	}
}
################################################################################
### END - external_pause
################################################################################





################################################################################
### BEGIN - external_dial - place a manual dial phone call
################################################################################
if ($function == 'external_dial')
{
	$value = ereg_replace("[^0-9]","",$value);

	if ( (strlen($value)<2) || (strlen($agent_user)<2) || (strlen($search)<2) || (strlen($preview)<2) || (strlen($focus)<2) )
	{
	$result = 'ERROR';
	$result_reason = "external_dial not valid";
	$data = "$phone_code|$search|$preview|$focus";
	echo "$result: $result_reason - $value|$data|$agent_user\n";
	api_log($link,$api_logging,$api_script,$user,$agent_user,$function,$value,$result,$result_reason,$source,$data);
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
		$stmt = "select count(*) from vicidial_live_agents where user='$agent_user' and status='PAUSED' and lead_id < 1;";
		if ($DB) {echo "$stmt\n";}
		$rslt=mysql_query($stmt, $link);
		$row=mysql_fetch_row($rslt);
		if ($row[0] > 0)
			{
			$stmt = "select count(*) from vicidial_users where user='$agent_user' and agentcall_manual='1';";
			if ($DB) {echo "$stmt\n";}
			$rslt=mysql_query($stmt, $link);
			$row=mysql_fetch_row($rslt);
			if ($row[0] > 0)
				{
				if (strlen($group_alias)>1)
					{
					$stmt = "select caller_id_number from groups_alias where group_alias_id='$group_alias';";
					if ($DB) {echo "$stmt\n";}
					$rslt=mysql_query($stmt, $link);
					$VDIG_cidnum_ct = mysql_num_rows($rslt);
					if ($VDIG_cidnum_ct > 0)
						{
						$row=mysql_fetch_row($rslt);
						$caller_id_number	= $row[0];
						if ($caller_id_number < 4)
							{
							$result = 'ERROR';
							$result_reason = "caller_id_number from group_alias is not valid";
							$data = "$group_alias|$caller_id_number";
							echo "$result: $result_reason - $agent_user|$data\n";
							api_log($link,$api_logging,$api_script,$user,$agent_user,$function,$value,$result,$result_reason,$source,$data);
							exit;
							}
						}
					else
						{
						$result = 'ERROR';
						$result_reason = "group_alias is not valid";
						$data = "$group_alias";
						echo "$result: $result_reason - $agent_user|$data\n";
						api_log($link,$api_logging,$api_script,$user,$agent_user,$function,$value,$result,$result_reason,$source,$data);
						exit;
						}
					}
				$stmt="UPDATE vicidial_live_agents set external_dial='$value!$phone_code!$search!$preview!$focus!$vendor_id!$epoch!$dial_prefix!$group_alias!$caller_id_number' where user='$agent_user';";
					if ($format=='debug') {echo "\n<!-- $stmt -->";}
				$rslt=mysql_query($stmt, $link);
				$result = 'SUCCESS';
				$result_reason = "external_dial function set";
				$data = "$phone_code|$search|$preview|$focus|$vendor_id|$epoch|$dial_prefix|$group_alias|$caller_id_number";
				echo "$result: $result_reason - $value|$agent_user|$data\n";
				api_log($link,$api_logging,$api_script,$user,$agent_user,$function,$value,$result,$result_reason,$source,$data);
				}
			else
				{
				$result = 'ERROR';
				$result_reason = "agent_user is not allowed to place manual dial calls";
				echo "$result: $result_reason - $agent_user\n";
				api_log($link,$api_logging,$api_script,$user,$agent_user,$function,$value,$result,$result_reason,$source,$data);
				}
			}
		else
			{
			$result = 'ERROR';
			$result_reason = "agent_user is not paused";
			echo "$result: $result_reason - $agent_user\n";
			api_log($link,$api_logging,$api_script,$user,$agent_user,$function,$value,$result,$result_reason,$source,$data);
			}
		}
	else
		{
		$result = 'ERROR';
		$result_reason = "agent_user is not logged in";
		echo "$result: $result_reason - $agent_user\n";
		api_log($link,$api_logging,$api_script,$user,$agent_user,$function,$value,$result,$result_reason,$source,$data);
		}
	}
}
################################################################################
### END - external_dial
################################################################################





if ($format=='debug') 
{
$ENDtime = date("U");
$RUNtime = ($ENDtime - $StarTtime);
echo "\n<!-- script runtime: $RUNtime seconds -->";
echo "\n</body>\n</html>\n";
}
	
exit; 






##### FUNCTIONS #####

##### Logging #####
function api_log($link,$api_logging,$api_script,$user,$agent_user,$function,$value,$result,$result_reason,$source,$data)
{
if ($api_logging > 0)
	{
	$NOW_TIME = date("Y-m-d H:i:s");
#	api_log($link,$api_logging,$api_script,$user,$agent_user,$function,$value,$result,$result_reason,$source,$data);
	$stmt="INSERT INTO vicidial_api_log set user='$user',agent_user='$agent_user',function='$function',value='$value',result='$result',result_reason='$result_reason',source='$source',data='$data',api_date='$NOW_TIME',api_script='$api_script';";
	$rslt=mysql_query($stmt, $link);
	}
return 1;
}

?>
