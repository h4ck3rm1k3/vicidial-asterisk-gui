<?
# non_agent_api.php
# 
# Copyright (C) 2009  Matt Florell <vicidial@gmail.com>    LICENSE: AGPLv2
#
# This script is designed as an API(Application Programming Interface) to allow
# other programs to interact with all non-agent-screen VICIDIAL functions
# 
# required variables:
#  - $user
#  - $pass
#  - $function - ('add_lead','version')
#  - $source - ('vtiger','webform','adminweb')
#  - $format - ('text','debug')

# CHANGELOG:
# 80724-0021 - First build of script
# 80801-0047 - Added gmt lookup and hopper insert time validation
# 80909-2012 - Added support for campaign-specific DNC lists
# 80910-0020 - Added support for multi-alt-phones, added version function
# 90118-1056 - Added logging of API functions
#

$version = '2.0.5-5';
$build = '90118-1056';

require("dbconnect.php");

### If you have globals turned off uncomment these lines
if (isset($_GET["user"]))						{$user=$_GET["user"];}
	elseif (isset($_POST["user"]))				{$user=$_POST["user"];}
if (isset($_GET["pass"]))						{$pass=$_GET["pass"];}
	elseif (isset($_POST["pass"]))				{$pass=$_POST["pass"];}
if (isset($_GET["function"]))					{$function=$_GET["function"];}
	elseif (isset($_POST["function"]))			{$function=$_POST["function"];}
if (isset($_GET["format"]))						{$format=$_GET["format"];}
	elseif (isset($_POST["format"]))			{$format=$_POST["format"];}
if (isset($_GET["list_id"]))					{$list_id=$_GET["list_id"];}
	elseif (isset($_POST["list_id"]))			{$list_id=$_POST["list_id"];}
if (isset($_GET["phone_code"]))					{$phone_code=$_GET["phone_code"];}
	elseif (isset($_POST["phone_code"]))		{$phone_code=$_POST["phone_code"];}
if (isset($_GET["phone_number"]))				{$phone_number=$_GET["phone_number"];}
	elseif (isset($_POST["phone_number"]))		{$phone_number=$_POST["phone_number"];}
if (isset($_GET["vendor_lead_code"]))			{$vendor_lead_code=$_GET["vendor_lead_code"];}
	elseif (isset($_POST["vendor_lead_code"]))	{$vendor_lead_code=$_POST["vendor_lead_code"];}
if (isset($_GET["source_id"]))					{$source_id=$_GET["source_id"];}
	elseif (isset($_POST["source_id"]))			{$source_id=$_POST["source_id"];}
if (isset($_GET["gmt_offset_now"]))				{$gmt_offset_now=$_GET["gmt_offset_now"];}
	elseif (isset($_POST["gmt_offset_now"]))	{$gmt_offset_now=$_POST["gmt_offset_now"];}
if (isset($_GET["title"]))						{$title=$_GET["title"];}
	elseif (isset($_POST["title"]))				{$title=$_POST["title"];}
if (isset($_GET["first_name"]))					{$first_name=$_GET["first_name"];}
	elseif (isset($_POST["first_name"]))		{$first_name=$_POST["first_name"];}
if (isset($_GET["middle_initial"]))				{$middle_initial=$_GET["middle_initial"];}
	elseif (isset($_POST["middle_initial"]))	{$middle_initial=$_POST["middle_initial"];}
if (isset($_GET["last_name"]))					{$last_name=$_GET["last_name"];}
	elseif (isset($_POST["last_name"]))			{$last_name=$_POST["last_name"];}
if (isset($_GET["address1"]))					{$address1=$_GET["address1"];}
	elseif (isset($_POST["address1"]))			{$address1=$_POST["address1"];}
if (isset($_GET["address2"]))					{$address2=$_GET["address2"];}
	elseif (isset($_POST["address2"]))			{$address2=$_POST["address2"];}
if (isset($_GET["address3"]))					{$address3=$_GET["address3"];}
	elseif (isset($_POST["address3"]))			{$address3=$_POST["address3"];}
if (isset($_GET["city"]))						{$city=$_GET["city"];}
	elseif (isset($_POST["city"]))				{$city=$_POST["city"];}
if (isset($_GET["state"]))						{$state=$_GET["state"];}
	elseif (isset($_POST["state"]))				{$state=$_POST["state"];}
if (isset($_GET["province"]))					{$province=$_GET["province"];}
	elseif (isset($_POST["province"]))			{$province=$_POST["province"];}
if (isset($_GET["postal_code"]))				{$postal_code=$_GET["postal_code"];}
	elseif (isset($_POST["postal_code"]))		{$postal_code=$_POST["postal_code"];}
if (isset($_GET["country_code"]))				{$country_code=$_GET["country_code"];}
	elseif (isset($_POST["country_code"]))		{$country_code=$_POST["country_code"];}
if (isset($_GET["gender"]))						{$gender=$_GET["gender"];}
	elseif (isset($_POST["gender"]))			{$gender=$_POST["gender"];}
if (isset($_GET["date_of_birth"]))				{$date_of_birth=$_GET["date_of_birth"];}
	elseif (isset($_POST["date_of_birth"]))		{$date_of_birth=$_POST["date_of_birth"];}
if (isset($_GET["alt_phone"]))					{$alt_phone=$_GET["alt_phone"];}
	elseif (isset($_POST["alt_phone"]))			{$alt_phone=$_POST["alt_phone"];}
if (isset($_GET["email"]))						{$email=$_GET["email"];}
	elseif (isset($_POST["email"]))				{$email=$_POST["email"];}
if (isset($_GET["security_phrase"]))			{$security_phrase=$_GET["security_phrase"];}
	elseif (isset($_POST["security_phrase"]))	{$security_phrase=$_POST["security_phrase"];}
if (isset($_GET["comments"]))					{$comments=$_GET["comments"];}
	elseif (isset($_POST["comments"]))			{$comments=$_POST["comments"];}
if (isset($_GET["dnc_check"]))					{$dnc_check=$_GET["dnc_check"];}
	elseif (isset($_POST["dnc_check"]))			{$dnc_check=$_POST["dnc_check"];}
if (isset($_GET["campaign_dnc_check"]))				{$campaign_dnc_check=$_GET["campaign_dnc_check"];}
	elseif (isset($_POST["campaign_dnc_check"]))	{$campaign_dnc_check=$_POST["campaign_dnc_check"];}
if (isset($_GET["add_to_hopper"]))				{$add_to_hopper=$_GET["add_to_hopper"];}
	elseif (isset($_POST["add_to_hopper"]))		{$add_to_hopper=$_POST["add_to_hopper"];}
if (isset($_GET["hopper_priority"]))			{$hopper_priority=$_GET["hopper_priority"];}
	elseif (isset($_POST["hopper_priority"]))	{$hopper_priority=$_POST["hopper_priority"];}
if (isset($_GET["hopper_local_call_time_check"]))			{$hopper_local_call_time_check=$_GET["hopper_local_call_time_check"];}
	elseif (isset($_POST["hopper_local_call_time_check"]))	{$hopper_local_call_time_check=$_POST["hopper_local_call_time_check"];}
if (isset($_GET["campaign_id"]))				{$campaign_id=$_GET["campaign_id"];}
	elseif (isset($_POST["campaign_id"]))		{$campaign_id=$_POST["campaign_id"];}
if (isset($_GET["multi_alt_phones"]))			{$multi_alt_phones=$_GET["multi_alt_phones"];}
	elseif (isset($_POST["multi_alt_phones"]))	{$multi_alt_phones=$_POST["multi_alt_phones"];}
if (isset($_GET["source"]))						{$source=$_GET["source"];}
	elseif (isset($_POST["source"]))			{$source=$_POST["source"];}


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
	$function = ereg_replace("[^-\_0-9a-zA-Z]","",$function);
	$format = ereg_replace("[^0-9a-zA-Z]","",$format);
	$list_id = ereg_replace("[^0-9]","",$list_id);
	$phone_code = ereg_replace("[^0-9]","",$phone_code);
	$phone_number = ereg_replace("[^0-9]","",$phone_number);
	$vendor_lead_code = ereg_replace(";","",$vendor_lead_code);
		$vendor_lead_code = ereg_replace("\+"," ",$vendor_lead_code);
	$source_id = ereg_replace(";","",$source_id);
		$source_id = ereg_replace("\+"," ",$source_id);
	$gmt_offset_now = ereg_replace("-\_\.0-9","",$gmt_offset_now);
	$title = ereg_replace("[^- \_\.0-9a-zA-Z]","",$title);
	$first_name = ereg_replace("[^- \+\_\.0-9a-zA-Z]","",$first_name);
		$first_name = ereg_replace("\+"," ",$first_name);
	$middle_initial = ereg_replace("[^0-9a-zA-Z]","",$middle_initial);
	$last_name = ereg_replace("[^- \+\_\.0-9a-zA-Z]","",$last_name);
		$last_name = ereg_replace("\+"," ",$last_name);
	$address1 = ereg_replace("[^- \+\.\:\/\@\_0-9a-zA-Z]","",$address1);
	$address2 = ereg_replace("[^- \+\.\:\/\@\_0-9a-zA-Z]","",$address2);
	$address3 = ereg_replace("[^- \+\.\:\/\@\_0-9a-zA-Z]","",$address3);
		$address1 = ereg_replace("\+"," ",$address1);
		$address2 = ereg_replace("\+"," ",$address2);
		$address3 = ereg_replace("\+"," ",$address3);
	$city = ereg_replace("[^- \+\.\:\/\@\_0-9a-zA-Z]","",$city);
		$city = ereg_replace("\+"," ",$city);
	$state = ereg_replace("[^- 0-9a-zA-Z]","",$state);
	$province = ereg_replace("[^- \+\.\_0-9a-zA-Z]","",$province);
		$province = ereg_replace("\+"," ",$province);
	$postal_code = ereg_replace("[^- \+0-9a-zA-Z]","",$postal_code);
		$postal_code = ereg_replace("\+"," ",$postal_code);
	$country_code = ereg_replace("[^A-Z]","",$country_code);
	$gender = ereg_replace("[^A-Z]","",$gender);
	$date_of_birth = ereg_replace("[^-0-9]","",$date_of_birth);
	$alt_phone = ereg_replace("[^- \+\_\.0-9a-zA-Z]","",$alt_phone);
		$alt_phone = ereg_replace("\+"," ",$alt_phone);
	$email = ereg_replace("[^- \+\.\:\/\@\_0-9a-zA-Z]","",$email);
		$email = ereg_replace("\+"," ",$email);
	$security_phrase = ereg_replace("[^- \+\.\:\/\@\_0-9a-zA-Z]","",$security_phrase);
		$security_phrase = ereg_replace("\+"," ",$security_phrase);
	$comments = ereg_replace(";","",$comments);
		$comments = ereg_replace("\+"," ",$comments);
	$dnc_check = ereg_replace("[^A-Z]","",$dnc_check);
	$campaign_dnc_check = ereg_replace("[^A-Z]","",$campaign_dnc_check);
	$add_to_hopper = ereg_replace("[^A-Z]","",$add_to_hopper);
	$hopper_priority = ereg_replace("-0-9","",$hopper_priority);
	$hopper_local_call_time_check = ereg_replace("[^A-Z]","",$hopper_local_call_time_check);
	$campaign_id = ereg_replace("[^-\_0-9a-zA-Z]","",$campaign_id);
	$multi_alt_phones = ereg_replace("[^- \+\!\:\_0-9a-zA-Z]","",$multi_alt_phones);
		$multi_alt_phones = ereg_replace("\+"," ",$multi_alt_phones);
	$source = ereg_replace("[^0-9a-zA-Z]","",$source);
	}

if (strlen($list_id)<1) {$list_id='999';}
if (strlen($phone_code)<1) {$phone_code='1';}
$USarea = 			substr($phone_number, 0, 3);
if (strlen($hopper_priority)<1) {$hopper_priority=0;}
if (strlen($gender)<1) {$gender='U';}

$StarTtime = date("U");
$NOW_DATE = date("Y-m-d");
$NOW_TIME = date("Y-m-d H:i:s");
$CIDdate = date("mdHis");
$ENTRYdate = date("YmdHis");
$MT[0]='';
$postalgmt='';
$api_script = 'non-agent';
$api_logging = 1;


$secX = date("U");
$hour = date("H");
$min = date("i");
$sec = date("s");
$mon = date("m");
$mday = date("d");
$year = date("Y");
$isdst = date("I");
$Shour = date("H");
$Smin = date("i");
$Ssec = date("s");
$Smon = date("m");
$Smday = date("d");
$Syear = date("Y");
$pulldate0 = "$year-$mon-$mday $hour:$min:$sec";
$inSD = $pulldate0;
$dsec = ( ( ($hour * 3600) + ($min * 60) ) + $sec );

### Grab Server GMT value from the database
$stmt="SELECT local_gmt FROM servers where active='Y' limit 1;";
if ($non_latin > 0) {$rslt=mysql_query("SET NAMES 'UTF8'");}
$rslt=mysql_query($stmt, $link);
$gmt_recs = mysql_num_rows($rslt);
if ($gmt_recs > 0)
	{
	$row=mysql_fetch_row($rslt);
	$DBSERVER_GMT		=		"$row[0]";
	if (strlen($DBSERVER_GMT)>0)	{$SERVER_GMT = $DBSERVER_GMT;}
	if ($isdst) {$SERVER_GMT++;} 
	}
else
	{
	$SERVER_GMT = date("O");
	$SERVER_GMT = eregi_replace("\+","",$SERVER_GMT);
	$SERVER_GMT = ($SERVER_GMT + 0);
	$SERVER_GMT = ($SERVER_GMT / 100);
	}

$LOCAL_GMT_OFF = $SERVER_GMT;
$LOCAL_GMT_OFF_STD = $SERVER_GMT;





################################################################################
### version - show version and date information for the API
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
### add_lead - inserts a lead into the vicidial_list table
################################################################################
if ($function == 'add_lead')
	{
	if(strlen($source)<2)
		{
		$result = 'ERROR';
		$result_reason = "Invalid Source";
		echo "$result: $result_reason - $source\n";
		api_log($link,$api_logging,$api_script,$user,$agent_user,$function,$value,$result,$result_reason,$source,$data);
		echo "ERROR: Invalid Source: |$source|\n";
		exit;
		}
	else
		{
		$stmt="SELECT count(*) from vicidial_users where user='$user' and pass='$pass' and vdc_agent_api_access='1' and modify_leads='1';";
		if ($DB) {echo "|$stmt|\n";}
		$rslt=mysql_query($stmt, $link);
		$row=mysql_fetch_row($rslt);
		$modify_leads=$row[0];

		if ($modify_leads < 1)
			{
			$result = 'ERROR';
			$result_reason = "add_lead USER DOES NOT HAVE PERMISSION TO ADD LEADS TO THE SYSTEM";
			echo "$result: $result_reason: |$user|$modify_leads|\n";
			$data = "$modify_leads";
			api_log($link,$api_logging,$api_script,$user,$agent_user,$function,$value,$result,$result_reason,$source,$data);
			exit;
			}
		else
			{
			if ( (strlen($phone_number)<6) || (strlen($phone_number)>16) )
				{
				$result = 'ERROR';
				$result_reason = "add_lead INVALID PHONE NUMBER";
				echo "$result: $result_reason - $phone_number|$user\n";
				$data = "$phone_number";
				api_log($link,$api_logging,$api_script,$user,$agent_user,$function,$value,$result,$result_reason,$source,$data);
				exit;
				}
			else
				{
				if ($dnc_check == 'Y')
					{
					$stmt="SELECT count(*) from vicidial_dnc where phone_number='$phone_number';";
					if ($DB) {echo "|$stmt|\n";}
					$rslt=mysql_query($stmt, $link);
					$row=mysql_fetch_row($rslt);
					$dnc_found=$row[0];

					if ($dnc_found > 0) 
						{
						$result = 'ERROR';
						$result_reason = "add_lead PHONE NUMBER IN DNC";
						echo "$result: $result_reason - $phone_number|$user\n";
						$data = "$phone_number";
						api_log($link,$api_logging,$api_script,$user,$agent_user,$function,$value,$result,$result_reason,$source,$data);
						exit;
						}
					}
				if ($campaign_dnc_check == 'Y')
					{
					$stmt="SELECT count(*) from vicidial_campaign_dnc where phone_number='$phone_number' and campaign_id='$campaign_id';";
					if ($DB) {echo "|$stmt|\n";}
					$rslt=mysql_query($stmt, $link);
					$row=mysql_fetch_row($rslt);
					$dnc_found=$row[0];

					if ($dnc_found > 0) 
						{
						$result = 'ERROR';
						$result_reason = "add_lead PHONE NUMBER IN CAMPAIGN DNC";
						echo "$result: $result_reason - $phone_number|$campaign_id|$user\n";
						$data = "$phone_number|$campaign_id";
						api_log($link,$api_logging,$api_script,$user,$agent_user,$function,$value,$result,$result_reason,$source,$data);
						exit;
						}
					}
				
				### get current gmt_offset of the phone_number
				$gmt_offset = lookup_gmt($phone_code,$USarea,$state,$LOCAL_GMT_OFF_STD,$Shour,$Smin,$Ssec,$Smon,$Smday,$Syear,$postalgmt,$postal_code);


				### insert a new lead in the system with this phone number
				$stmt = "INSERT INTO vicidial_list SET phone_code='$phone_code',phone_number='$phone_number',list_id='$list_id',status='NEW',user='$user',vendor_lead_code='$vendor_lead_code',source_id='$source_id',gmt_offset_now='$gmt_offset',title='$title',first_name='$first_name',middle_initial='$middle_initial',last_name='$last_name',address1='$address1',address2='$address2',address3='$address3',city='$city',state='$state',province='$province',postal_code='$postal_code',country_code='$country_code',gender='$gender',date_of_birth='$date_of_birth',alt_phone='$alt_phone',email='$email',security_phrase='$security_phrase',comments='$comments',called_since_last_reset='N',entry_date='$ENTRYdate',last_local_call_time='$NOW_TIME';";
				if ($DB) {echo "$stmt\n";}
				$rslt=mysql_query($stmt, $link);
				$affected_rows = mysql_affected_rows($link);
				if ($affected_rows > 0)
					{
					$lead_id = mysql_insert_id($link);

					$result = 'SUCCESS';
					$result_reason = "add_lead LEAD HAS BEEN ADDED";
					echo "$result: $result_reason - $phone_number|$list_id|$lead_id|$gmt_offset|$user\n";
					$data = "$phone_number|$list_id|$lead_id|$gmt_offset";
					api_log($link,$api_logging,$api_script,$user,$agent_user,$function,$value,$result,$result_reason,$source,$data);

					if (strlen($multi_alt_phones) > 5)
						{
						$map=$MT;  $ALTm_phone_code=$MT;  $ALTm_phone_number=$MT;  $ALTm_phone_note=$MT;
						$map = explode('!', $multi_alt_phones);
						$map_count = count($map);
						if ($DB) {echo "multi-al-entry: $a|$map_count|$multi_alt_phones\n";}
						$g++;
						$r=0;   $s=0;   $inserted_alt_phones=0;
						while ($r < $map_count)
							{
							$s++;
							$ncn=$MT;
							$ncn = explode('_', $map[$r]);
							print "$ncn[0]|$ncn[1]|$ncn[2]";

							if (strlen($forcephonecode) > 0)
								{$ALTm_phone_code[$r] =	$forcephonecode;}
							else
								{$ALTm_phone_code[$r] =		$ncn[1];}
							if (strlen($ALTm_phone_code[$r]) < 1)
								{$ALTm_phone_code[$r]='1';}
							$ALTm_phone_number[$r] =	$ncn[0];
							$ALTm_phone_note[$r] =		$ncn[2];
							$stmt = "INSERT INTO vicidial_list_alt_phones (lead_id,phone_code,phone_number,alt_phone_note,alt_phone_count) values('$lead_id','$ALTm_phone_code[$r]','$ALTm_phone_number[$r]','$ALTm_phone_note[$r]','$s');";
							if ($DB) {echo "$stmt\n";}
							$rslt=mysql_query($stmt, $link);
							$Zaffected_rows = mysql_affected_rows($link);
							$inserted_alt_phones = ($inserted_alt_phones + $Zaffected_rows);
							$r++;
							}
						$result = 'NOTICE';
						$result_reason = "add_lead MULTI-ALT-PHONE NUMBERS LOADED";
						echo "$result: $result_reason - $inserted_alt_phones|$lead_id|$user\n";
						$data = "$inserted_alt_phones|$lead_id";
						api_log($link,$api_logging,$api_script,$user,$agent_user,$function,$value,$result,$result_reason,$source,$data);
						}

					if ($add_to_hopper == 'Y')
						{
						$dialable=1;

						$stmt="SELECT local_call_time,vicidial_campaigns.campaign_id from vicidial_campaigns,vicidial_lists where list_id='$list_id' and vicidial_campaigns.campaign_id=vicidial_lists.campaign_id;";
						if ($DB) {echo "|$stmt|\n";}
						$rslt=mysql_query($stmt, $link);
						$row=mysql_fetch_row($rslt);
						$local_call_time=$row[0];
						$VD_campaign_id=$row[1];

						if ($hopper_local_call_time_check == 'Y')
							{
							### call function to determine if lead is dialable
							$dialable = dialable_gmt($DB,$link,$local_call_time,$gmt_offset,$state);
							}
						if ($dialable < 1) 
							{
							$result = 'NOTICE';
							$result_reason = "add_lead NOT ADDED TO HOPPER, OUTSIDE OF LOCAL TIME";
							echo "$result: $result_reason - $phone_number|$lead_id|$gmt_offset|$dialable|$user\n";
							$data = "$phone_number|$lead_id|$gmt_offset|$dialable";
							api_log($link,$api_logging,$api_script,$user,$agent_user,$function,$value,$result,$result_reason,$source,$data);
							}
						else
							{
							### code to insert into hopper goes here

							### insert record into vicidial_hopper for alt_phone call attempt
							$stmt = "INSERT INTO vicidial_hopper SET lead_id='$lead_id',campaign_id='$VD_campaign_id',status='READY',list_id='$list_id',gmt_offset_now='$gmt_offset',state='$state',user='',priority='$hopper_priority';";
							if ($DB) {echo "$stmt\n";}
							$rslt=mysql_query($stmt, $link);
							$Haffected_rows = mysql_affected_rows($link);
							if ($Haffected_rows > 0)
								{
								$hopper_id = mysql_insert_id($link);

								$result = 'NOTICE';
								$result_reason = "add_lead ADDED TO HOPPER";
								echo "$result: $result_reason - $phone_number|$lead_id|$hopper_id|$user\n";
								$data = "$phone_number|$lead_id|$hopper_id";
								api_log($link,$api_logging,$api_script,$user,$agent_user,$function,$value,$result,$result_reason,$source,$data);
								}
							else
								{
								$result = 'NOTICE';
								$result_reason = "add_lead NOT ADDED TO HOPPER";
								echo "$result: $result_reason - $phone_number|$lead_id|$stmt|$user\n";
								$data = "$phone_number|$lead_id|$stmt";
								api_log($link,$api_logging,$api_script,$user,$agent_user,$function,$value,$result,$result_reason,$source,$data);
								}
							}
						}
					}
				else
					{
					$result = 'ERROR';
					$result_reason = "add_lead LEAD HAS NOT BEEN ADDED";
					echo "$result: $result_reason - $phone_number|$list_id|$stmt|$user\n";
					$data = "$phone_number|$list_id|$stmt";
					api_log($link,$api_logging,$api_script,$user,$agent_user,$function,$value,$result,$result_reason,$source,$data);
					}
				}
			}
		exit;
		}
	}



$result = 'ERROR';
$result_reason = "NO FUNCTION SPECIFIED";
echo "$result: $result_reason\n";
api_log($link,$api_logging,$api_script,$user,$agent_user,$function,$value,$result,$result_reason,$source,$data);









if ($format=='debug') 
{
$ENDtime = date("U");
$RUNtime = ($ENDtime - $StarTtime);
echo "\n<!-- script runtime: $RUNtime seconds -->";
echo "\n</body>\n</html>\n";
}
	
exit; 







##### FUNCTIONS #####

##### LOOKUP GMT, FINDS THE CURRENT GMT OFFSET FOR A PHONE NUMBER #####

function lookup_gmt($phone_code,$USarea,$state,$LOCAL_GMT_OFF_STD,$Shour,$Smin,$Ssec,$Smon,$Smday,$Syear,$postalgmt,$postal_code)
{
require("dbconnect.php");

$postalgmt_found=0;
if ( (eregi("POSTAL",$postalgmt)) && (strlen($postal_code)>4) )
	{
	if (preg_match('/^1$/', $phone_code))
		{
		$stmt="select * from vicidial_postal_codes where country_code='$phone_code' and postal_code LIKE \"$postal_code%\";";
		$rslt=mysql_query($stmt, $link);
		$pc_recs = mysql_num_rows($rslt);
		if ($pc_recs > 0)
			{
			$row=mysql_fetch_row($rslt);
			$gmt_offset =	$row[2];	 $gmt_offset = eregi_replace("\+","",$gmt_offset);
			$dst =			$row[3];
			$dst_range =	$row[4];
			$PC_processed++;
			$postalgmt_found++;
			$post++;
			}
		}
	}
if ($postalgmt_found < 1)
	{
	$PC_processed=0;
	### UNITED STATES ###
	if ($phone_code =='1')
		{
		$stmt="select * from vicidial_phone_codes where country_code='$phone_code' and areacode='$USarea';";
		$rslt=mysql_query($stmt, $link);
		$pc_recs = mysql_num_rows($rslt);
		if ($pc_recs > 0)
			{
			$row=mysql_fetch_row($rslt);
			$gmt_offset =	$row[4];	 $gmt_offset = eregi_replace("\+","",$gmt_offset);
			$dst =			$row[5];
			$dst_range =	$row[6];
			$PC_processed++;
			}
		}
	### MEXICO ###
	if ($phone_code =='52')
		{
		$stmt="select * from vicidial_phone_codes where country_code='$phone_code' and areacode='$USarea';";
		$rslt=mysql_query($stmt, $link);
		$pc_recs = mysql_num_rows($rslt);
		if ($pc_recs > 0)
			{
			$row=mysql_fetch_row($rslt);
			$gmt_offset =	$row[4];	 $gmt_offset = eregi_replace("\+","",$gmt_offset);
			$dst =			$row[5];
			$dst_range =	$row[6];
			$PC_processed++;
			}
		}
	### AUSTRALIA ###
	if ($phone_code =='61')
		{
		$stmt="select * from vicidial_phone_codes where country_code='$phone_code' and state='$state';";
		$rslt=mysql_query($stmt, $link);
		$pc_recs = mysql_num_rows($rslt);
		if ($pc_recs > 0)
			{
			$row=mysql_fetch_row($rslt);
			$gmt_offset =	$row[4];	 $gmt_offset = eregi_replace("\+","",$gmt_offset);
			$dst =			$row[5];
			$dst_range =	$row[6];
			$PC_processed++;
			}
		}
	### ALL OTHER COUNTRY CODES ###
	if (!$PC_processed)
		{
		$PC_processed++;
		$stmt="select * from vicidial_phone_codes where country_code='$phone_code';";
		$rslt=mysql_query($stmt, $link);
		$pc_recs = mysql_num_rows($rslt);
		if ($pc_recs > 0)
			{
			$row=mysql_fetch_row($rslt);
			$gmt_offset =	$row[4];	 $gmt_offset = eregi_replace("\+","",$gmt_offset);
			$dst =			$row[5];
			$dst_range =	$row[6];
			$PC_processed++;
			}
		}
	}

### Find out if DST to raise the gmt offset ###
$AC_GMT_diff = ($gmt_offset - $LOCAL_GMT_OFF_STD);
$AC_localtime = mktime(($Shour + $AC_GMT_diff), $Smin, $Ssec, $Smon, $Smday, $Syear);
	$hour = date("H",$AC_localtime);
	$min = date("i",$AC_localtime);
	$sec = date("s",$AC_localtime);
	$mon = date("m",$AC_localtime);
	$mday = date("d",$AC_localtime);
	$wday = date("w",$AC_localtime);
	$year = date("Y",$AC_localtime);
$dsec = ( ( ($hour * 3600) + ($min * 60) ) + $sec );

$AC_processed=0;
if ( (!$AC_processed) and ($dst_range == 'SSM-FSN') )
	{
	if ($DBX) {print "     Second Sunday March to First Sunday November\n";}
	#**********************************************************************
	# SSM-FSN
	#     This is returns 1 if Daylight Savings Time is in effect and 0 if 
	#       Standard time is in effect.
	#     Based on Second Sunday March to First Sunday November at 2 am.
	#     INPUTS:
	#       mm              INTEGER       Month.
	#       dd              INTEGER       Day of the month.
	#       ns              INTEGER       Seconds into the day.
	#       dow             INTEGER       Day of week (0=Sunday, to 6=Saturday)
	#     OPTIONAL INPUT:
	#       timezone        INTEGER       hour difference UTC - local standard time
	#                                      (DEFAULT is blank)
	#                                     make calculations based on UTC time, 
	#                                     which means shift at 10:00 UTC in April
	#                                     and 9:00 UTC in October
	#     OUTPUT: 
	#                       INTEGER       1 = DST, 0 = not DST
	#
	# S  M  T  W  T  F  S
	# 1  2  3  4  5  6  7
	# 8  9 10 11 12 13 14
	#15 16 17 18 19 20 21
	#22 23 24 25 26 27 28
	#29 30 31
	# 
	# S  M  T  W  T  F  S
	#    1  2  3  4  5  6
	# 7  8  9 10 11 12 13
	#14 15 16 17 18 19 20
	#21 22 23 24 25 26 27
	#28 29 30 31
	# 
	#**********************************************************************

		$USACAN_DST=0;
		$mm = $mon;
		$dd = $mday;
		$ns = $dsec;
		$dow= $wday;

		if ($mm < 3 || $mm > 11) {
		$USACAN_DST=0;   
		} elseif ($mm >= 4 and $mm <= 10) {
		$USACAN_DST=1;   
		} elseif ($mm == 3) {
		if ($dd > 13) {
			$USACAN_DST=1;   
		} elseif ($dd >= ($dow+8)) {
			if ($timezone) {
			if ($dow == 0 and $ns < (7200+$timezone*3600)) {
				$USACAN_DST=0;   
			} else {
				$USACAN_DST=1;   
			}
			} else {
			if ($dow == 0 and $ns < 7200) {
				$USACAN_DST=0;   
			} else {
				$USACAN_DST=1;   
			}
			}
		} else {
			$USACAN_DST=0;   
		}
		} elseif ($mm == 11) {
		if ($dd > 7) {
			$USACAN_DST=0;   
		} elseif ($dd < ($dow+1)) {
			$USACAN_DST=1;   
		} elseif ($dow == 0) {
			if ($timezone) { # UTC calculations
			if ($ns < (7200+($timezone-1)*3600)) {
				$USACAN_DST=1;   
			} else {
				$USACAN_DST=0;   
			}
			} else { # local time calculations
			if ($ns < 7200) {
				$USACAN_DST=1;   
			} else {
				$USACAN_DST=0;   
			}
			}
		} else {
			$USACAN_DST=0;   
		}
		} # end of month checks
	if ($DBX) {print "     DST: $USACAN_DST\n";}
	if ($USACAN_DST) {$gmt_offset++;}
	$AC_processed++;
	}

if ( (!$AC_processed) and ($dst_range == 'FSA-LSO') )
	{
	if ($DBX) {print "     First Sunday April to Last Sunday October\n";}
	#**********************************************************************
	# FSA-LSO
	#     This is returns 1 if Daylight Savings Time is in effect and 0 if 
	#       Standard time is in effect.
	#     Based on first Sunday in April and last Sunday in October at 2 am.
	#**********************************************************************
		
		$USA_DST=0;
		$mm = $mon;
		$dd = $mday;
		$ns = $dsec;
		$dow= $wday;

		if ($mm < 4 || $mm > 10) {
		$USA_DST=0;
		} elseif ($mm >= 5 and $mm <= 9) {
		$USA_DST=1;
		} elseif ($mm == 4) {
		if ($dd > 7) {
			$USA_DST=1;
		} elseif ($dd >= ($dow+1)) {
			if ($timezone) {
			if ($dow == 0 and $ns < (7200+$timezone*3600)) {
				$USA_DST=0;
			} else {
				$USA_DST=1;
			}
			} else {
			if ($dow == 0 and $ns < 7200) {
				$USA_DST=0;
			} else {
				$USA_DST=1;
			}
			}
		} else {
			$USA_DST=0;
		}
		} elseif ($mm == 10) {
		if ($dd < 25) {
			$USA_DST=1;
		} elseif ($dd < ($dow+25)) {
			$USA_DST=1;
		} elseif ($dow == 0) {
			if ($timezone) { # UTC calculations
			if ($ns < (7200+($timezone-1)*3600)) {
				$USA_DST=1;
			} else {
				$USA_DST=0;
			}
			} else { # local time calculations
			if ($ns < 7200) {
				$USA_DST=1;
			} else {
				$USA_DST=0;
			}
			}
		} else {
			$USA_DST=0;
		}
		} # end of month checks

	if ($DBX) {print "     DST: $USA_DST\n";}
	if ($USA_DST) {$gmt_offset++;}
	$AC_processed++;
	}

if ( (!$AC_processed) and ($dst_range == 'LSM-LSO') )
	{
	if ($DBX) {print "     Last Sunday March to Last Sunday October\n";}
	#**********************************************************************
	#     This is s 1 if Daylight Savings Time is in effect and 0 if 
	#       Standard time is in effect.
	#     Based on last Sunday in March and last Sunday in October at 1 am.
	#**********************************************************************
		
		$GBR_DST=0;
		$mm = $mon;
		$dd = $mday;
		$ns = $dsec;
		$dow= $wday;

		if ($mm < 3 || $mm > 10) {
		$GBR_DST=0;
		} elseif ($mm >= 4 and $mm <= 9) {
		$GBR_DST=1;
		} elseif ($mm == 3) {
		if ($dd < 25) {
			$GBR_DST=0;
		} elseif ($dd < ($dow+25)) {
			$GBR_DST=0;
		} elseif ($dow == 0) {
			if ($timezone) { # UTC calculations
			if ($ns < (3600+($timezone-1)*3600)) {
				$GBR_DST=0;
			} else {
				$GBR_DST=1;
			}
			} else { # local time calculations
			if ($ns < 3600) {
				$GBR_DST=0;
			} else {
				$GBR_DST=1;
			}
			}
		} else {
			$GBR_DST=1;
		}
		} elseif ($mm == 10) {
		if ($dd < 25) {
			$GBR_DST=1;
		} elseif ($dd < ($dow+25)) {
			$GBR_DST=1;
		} elseif ($dow == 0) {
			if ($timezone) { # UTC calculations
			if ($ns < (3600+($timezone-1)*3600)) {
				$GBR_DST=1;
			} else {
				$GBR_DST=0;
			}
			} else { # local time calculations
			if ($ns < 3600) {
				$GBR_DST=1;
			} else {
				$GBR_DST=0;
			}
			}
		} else {
			$GBR_DST=0;
		}
		} # end of month checks
		if ($DBX) {print "     DST: $GBR_DST\n";}
	if ($GBR_DST) {$gmt_offset++;}
	$AC_processed++;
	}
if ( (!$AC_processed) and ($dst_range == 'LSO-LSM') )
	{
	if ($DBX) {print "     Last Sunday October to Last Sunday March\n";}
	#**********************************************************************
	#     This is s 1 if Daylight Savings Time is in effect and 0 if 
	#       Standard time is in effect.
	#     Based on last Sunday in October and last Sunday in March at 1 am.
	#**********************************************************************
		
		$AUS_DST=0;
		$mm = $mon;
		$dd = $mday;
		$ns = $dsec;
		$dow= $wday;

		if ($mm < 3 || $mm > 10) {
		$AUS_DST=1;
		} elseif ($mm >= 4 and $mm <= 9) {
		$AUS_DST=0;
		} elseif ($mm == 3) {
		if ($dd < 25) {
			$AUS_DST=1;
		} elseif ($dd < ($dow+25)) {
			$AUS_DST=1;
		} elseif ($dow == 0) {
			if ($timezone) { # UTC calculations
			if ($ns < (3600+($timezone-1)*3600)) {
				$AUS_DST=1;
			} else {
				$AUS_DST=0;
			}
			} else { # local time calculations
			if ($ns < 3600) {
				$AUS_DST=1;
			} else {
				$AUS_DST=0;
			}
			}
		} else {
			$AUS_DST=0;
		}
		} elseif ($mm == 10) {
		if ($dd < 25) {
			$AUS_DST=0;
		} elseif ($dd < ($dow+25)) {
			$AUS_DST=0;
		} elseif ($dow == 0) {
			if ($timezone) { # UTC calculations
			if ($ns < (3600+($timezone-1)*3600)) {
				$AUS_DST=0;
			} else {
				$AUS_DST=1;
			}
			} else { # local time calculations
			if ($ns < 3600) {
				$AUS_DST=0;
			} else {
				$AUS_DST=1;
			}
			}
		} else {
			$AUS_DST=1;
		}
		} # end of month checks						
	if ($DBX) {print "     DST: $AUS_DST\n";}
	if ($AUS_DST) {$gmt_offset++;}
	$AC_processed++;
	}

if ( (!$AC_processed) and ($dst_range == 'FSO-LSM') )
	{
	if ($DBX) {print "     First Sunday October to Last Sunday March\n";}
	#**********************************************************************
	#   TASMANIA ONLY
	#     This is s 1 if Daylight Savings Time is in effect and 0 if 
	#       Standard time is in effect.
	#     Based on first Sunday in October and last Sunday in March at 1 am.
	#**********************************************************************
		
		$AUST_DST=0;
		$mm = $mon;
		$dd = $mday;
		$ns = $dsec;
		$dow= $wday;

		if ($mm < 3 || $mm > 10) {
		$AUST_DST=1;
		} elseif ($mm >= 4 and $mm <= 9) {
		$AUST_DST=0;
		} elseif ($mm == 3) {
		if ($dd < 25) {
			$AUST_DST=1;
		} elseif ($dd < ($dow+25)) {
			$AUST_DST=1;
		} elseif ($dow == 0) {
			if ($timezone) { # UTC calculations
			if ($ns < (3600+($timezone-1)*3600)) {
				$AUST_DST=1;
			} else {
				$AUST_DST=0;
			}
			} else { # local time calculations
			if ($ns < 3600) {
				$AUST_DST=1;
			} else {
				$AUST_DST=0;
			}
			}
		} else {
			$AUST_DST=0;
		}
		} elseif ($mm == 10) {
		if ($dd > 7) {
			$AUST_DST=1;
		} elseif ($dd >= ($dow+1)) {
			if ($timezone) {
			if ($dow == 0 and $ns < (7200+$timezone*3600)) {
				$AUST_DST=0;
			} else {
				$AUST_DST=1;
			}
			} else {
			if ($dow == 0 and $ns < 3600) {
				$AUST_DST=0;
			} else {
				$AUST_DST=1;
			}
			}
		} else {
			$AUST_DST=0;
		}
		} # end of month checks						
	if ($DBX) {print "     DST: $AUST_DST\n";}
	if ($AUST_DST) {$gmt_offset++;}
	$AC_processed++;
	}
if ( (!$AC_processed) and ($dst_range == 'FSO-TSM') )
	{
	if ($DBX) {print "     First Sunday October to Third Sunday March\n";}
	#**********************************************************************
	#     This is s 1 if Daylight Savings Time is in effect and 0 if 
	#       Standard time is in effect.
	#     Based on first Sunday in October and third Sunday in March at 1 am.
	#**********************************************************************
		
		$NZL_DST=0;
		$mm = $mon;
		$dd = $mday;
		$ns = $dsec;
		$dow= $wday;

		if ($mm < 3 || $mm > 10) {
		$NZL_DST=1;
		} elseif ($mm >= 4 and $mm <= 9) {
		$NZL_DST=0;
		} elseif ($mm == 3) {
		if ($dd < 14) {
			$NZL_DST=1;
		} elseif ($dd < ($dow+14)) {
			$NZL_DST=1;
		} elseif ($dow == 0) {
			if ($timezone) { # UTC calculations
			if ($ns < (3600+($timezone-1)*3600)) {
				$NZL_DST=1;
			} else {
				$NZL_DST=0;
			}
			} else { # local time calculations
			if ($ns < 3600) {
				$NZL_DST=1;
			} else {
				$NZL_DST=0;
			}
			}
		} else {
			$NZL_DST=0;
		}
		} elseif ($mm == 10) {
		if ($dd > 7) {
			$NZL_DST=1;
		} elseif ($dd >= ($dow+1)) {
			if ($timezone) {
			if ($dow == 0 and $ns < (7200+$timezone*3600)) {
				$NZL_DST=0;
			} else {
				$NZL_DST=1;
			}
			} else {
			if ($dow == 0 and $ns < 3600) {
				$NZL_DST=0;
			} else {
				$NZL_DST=1;
			}
			}
		} else {
			$NZL_DST=0;
		}
		} # end of month checks						
	if ($DBX) {print "     DST: $NZL_DST\n";}
	if ($NZL_DST) {$gmt_offset++;}
	$AC_processed++;
	}

if ( (!$AC_processed) and ($dst_range == 'TSO-LSF') )
	{
	if ($DBX) {print "     Third Sunday October to Last Sunday February\n";}
	#**********************************************************************
	# TSO-LSF
	#     This is returns 1 if Daylight Savings Time is in effect and 0 if 
	#       Standard time is in effect. Brazil
	#     Based on Third Sunday October to Last Sunday February at 1 am.
	#**********************************************************************
		
		$BZL_DST=0;
		$mm = $mon;
		$dd = $mday;
		$ns = $dsec;
		$dow= $wday;

		if ($mm < 2 || $mm > 10) {
		$BZL_DST=1;   
		} elseif ($mm >= 3 and $mm <= 9) {
		$BZL_DST=0;   
		} elseif ($mm == 2) {
		if ($dd < 22) {
			$BZL_DST=1;   
		} elseif ($dd < ($dow+22)) {
			$BZL_DST=1;   
		} elseif ($dow == 0) {
			if ($timezone) { # UTC calculations
			if ($ns < (3600+($timezone-1)*3600)) {
				$BZL_DST=1;   
			} else {
				$BZL_DST=0;   
			}
			} else { # local time calculations
			if ($ns < 3600) {
				$BZL_DST=1;   
			} else {
				$BZL_DST=0;   
			}
			}
		} else {
			$BZL_DST=0;   
		}
		} elseif ($mm == 10) {
		if ($dd < 22) {
			$BZL_DST=0;   
		} elseif ($dd < ($dow+22)) {
			$BZL_DST=0;   
		} elseif ($dow == 0) {
			if ($timezone) { # UTC calculations
			if ($ns < (3600+($timezone-1)*3600)) {
				$BZL_DST=0;   
			} else {
				$BZL_DST=1;   
			}
			} else { # local time calculations
			if ($ns < 3600) {
				$BZL_DST=0;   
			} else {
				$BZL_DST=1;   
			}
			}
		} else {
			$BZL_DST=1;   
		}
		} # end of month checks
	if ($DBX) {print "     DST: $BZL_DST\n";}
	if ($BZL_DST) {$gmt_offset++;}
	$AC_processed++;
	}

if (!$AC_processed)
	{
	if ($DBX) {print "     No DST Method Found\n";}
	if ($DBX) {print "     DST: 0\n";}
	$AC_processed++;
	}

return $gmt_offset;
}





##### DETERMINE IF LEAD IS DIALABLE #####
function dialable_gmt($DB,$link,$local_call_time,$gmt_offset,$state)
{
$dialable=0;

$pzone=3600 * $gmt_offset;
$pmin=(gmdate("i", time() + $pzone));
$phour=( (gmdate("G", time() + $pzone)) * 100);
$pday=gmdate("w", time() + $pzone);
$tz = sprintf("%.2f", $p);	
$GMT_gmt = "$tz";
$GMT_day = "$pday";
$GMT_hour = ($phour + $pmin);

$stmt="SELECT * FROM vicidial_call_times where call_time_id='$local_call_time';";
if ($DB) {echo "$stmt\n";}
$rslt=mysql_query($stmt, $link);
$rowx=mysql_fetch_row($rslt);
$Gct_default_start =	"$rowx[3]";
$Gct_default_stop =		"$rowx[4]";
$Gct_sunday_start =		"$rowx[5]";
$Gct_sunday_stop =		"$rowx[6]";
$Gct_monday_start =		"$rowx[7]";
$Gct_monday_stop =		"$rowx[8]";
$Gct_tuesday_start =	"$rowx[9]";
$Gct_tuesday_stop =		"$rowx[10]";
$Gct_wednesday_start =	"$rowx[11]";
$Gct_wednesday_stop =	"$rowx[12]";
$Gct_thursday_start =	"$rowx[13]";
$Gct_thursday_stop =	"$rowx[14]";
$Gct_friday_start =		"$rowx[15]";
$Gct_friday_stop =		"$rowx[16]";
$Gct_saturday_start =	"$rowx[17]";
$Gct_saturday_stop =	"$rowx[18]";
$Gct_state_call_times = "$rowx[19]";

if ($GMT_day==0)	#### Sunday local time
	{
	if (($Gct_sunday_start==0) and ($Gct_sunday_stop==0))
		{
		if ( ($GMT_hour>=$Gct_default_start) and ($GMT_hour<$Gct_default_stop) )
			{$dialable=1;}
		}
	else
		{
		if ( ($GMT_hour>=$Gct_sunday_start) and ($GMT_hour<$Gct_sunday_stop) )
			{$dialable=1;}
		}
	}
if ($GMT_day==1)	#### Monday local time
	{
	if (($Gct_monday_start==0) and ($Gct_monday_stop==0))
		{
		if ( ($GMT_hour>=$Gct_default_start) and ($GMT_hour<$Gct_default_stop) )
			{$dialable=1;}
		}
	else
		{
		if ( ($GMT_hour>=$Gct_monday_start) and ($GMT_hour<$Gct_monday_stop) )
			{$dialable=1;}
		}
	}
if ($GMT_day==2)	#### Tuesday local time
	{
	if (($Gct_tuesday_start==0) and ($Gct_tuesday_stop==0))
		{
		if ( ($GMT_hour>=$Gct_default_start) and ($GMT_hour<$Gct_default_stop) )
			{$dialable=1;}
		}
	else
		{
		if ( ($GMT_hour>=$Gct_tuesday_start) and ($GMT_hour<$Gct_tuesday_stop) )
			{$dialable=1;}
		}
	}
if ($GMT_day==3)	#### Wednesday local time
	{
	if (($Gct_wednesday_start==0) and ($Gct_wednesday_stop==0))
		{
		if ( ($GMT_hour>=$Gct_default_start) and ($GMT_hour<$Gct_default_stop) )
			{$dialable=1;}
		}
	else
		{
		if ( ($GMT_hour>=$Gct_wednesday_start) and ($GMT_hour<$Gct_wednesday_stop) )
			{$dialable=1;}
		}
	}
if ($GMT_day==4)	#### Thursday local time
	{
	if (($Gct_thursday_start==0) and ($Gct_thursday_stop==0))
		{
		if ( ($GMT_hour>=$Gct_default_start) and ($GMT_hour<$Gct_default_stop) )
			{$dialable=1;}
		}
	else
		{
		if ( ($GMT_hour>=$Gct_thursday_start) and ($GMT_hour<$Gct_thursday_stop) )
			{$dialable=1;}
		}
	}
if ($GMT_day==5)	#### Friday local time
	{
	if (($Gct_friday_start==0) and ($Gct_friday_stop==0))
		{
		if ( ($GMT_hour>=$Gct_default_start) and ($GMT_hour<$Gct_default_stop) )
			{$dialable=1;}
		}
	else
		{
		if ( ($GMT_hour>=$Gct_friday_start) and ($GMT_hour<$Gct_friday_stop) )
			{$dialable=1;}
		}
	}
if ($GMT_day==6)	#### Saturday local time
	{
	if (($Gct_saturday_start==0) and ($Gct_saturday_stop==0))
		{
		if ( ($GMT_hour>=$Gct_default_start) and ($GMT_hour<$Gct_default_stop) )
			{$dialable=1;}
		}
	else
		{
		if ( ($GMT_hour>=$Gct_saturday_start) and ($GMT_hour<$Gct_saturday_stop) )
			{$dialable=1;}
		}
	}

return $dialable;
}

/*
	$ct_states = '';
	$ct_state_gmt_SQL = '';
	$ct_srs=0;
	$b=0;
	if (strlen($Gct_state_call_times)>2)
		{
		$state_rules = explode('|',$Gct_state_call_times);
		$ct_srs = ((count($state_rules)) - 2);
		}
	while($ct_srs >= $b)
		{
		if ( (strlen($state_rules[$b])>1) and (strlen($state)>1) )
			{
			$stmt="SELECT * from vicidial_state_call_times where state_call_time_id='$state_rules[$b]' and state_call_time_state='$state';";
			$rslt=mysql_query($stmt, $link);
			$row=mysql_fetch_row($rslt);
			$Gstate_call_time_id =		"$row[0]";
			$Gstate_call_time_state =	"$row[1]";
			$Gsct_default_start =		"$row[4]";
			$Gsct_default_stop =		"$row[5]";
			$Gsct_sunday_start =		"$row[6]";
			$Gsct_sunday_stop =			"$row[7]";
			$Gsct_monday_start =		"$row[8]";
			$Gsct_monday_stop =			"$row[9]";
			$Gsct_tuesday_start =		"$row[10]";
			$Gsct_tuesday_stop =		"$row[11]";
			$Gsct_wednesday_start =		"$row[12]";
			$Gsct_wednesday_stop =		"$row[13]";
			$Gsct_thursday_start =		"$row[14]";
			$Gsct_thursday_stop =		"$row[15]";
			$Gsct_friday_start =		"$row[16]";
			$Gsct_friday_stop =			"$row[17]";
			$Gsct_saturday_start =		"$row[18]";
			$Gsct_saturday_stop =		"$row[19]";

			$ct_states .="'$Gstate_call_time_state',";

			$r=0;
			$state_gmt='';
			while($r < $g)
				{
				if ($GMT_day[$r]==0)	#### Sunday local time
					{
					if (($Gsct_sunday_start==0) and ($Gsct_sunday_stop==0))
						{
						if ( ($GMT_hour[$r]>=$Gsct_default_start) and ($GMT_hour[$r]<$Gsct_default_stop) )
							{$state_gmt.="'$GMT_gmt[$r]',";}
						}
					else
						{
						if ( ($GMT_hour[$r]>=$Gsct_sunday_start) and ($GMT_hour[$r]<$Gsct_sunday_stop) )
							{$state_gmt.="'$GMT_gmt[$r]',";}
						}
					}
				if ($GMT_day[$r]==1)	#### Monday local time
					{
					if (($Gsct_monday_start==0) and ($Gsct_monday_stop==0))
						{
						if ( ($GMT_hour[$r]>=$Gsct_default_start) and ($GMT_hour[$r]<$Gsct_default_stop) )
							{$state_gmt.="'$GMT_gmt[$r]',";}
						}
					else
						{
						if ( ($GMT_hour[$r]>=$Gsct_monday_start) and ($GMT_hour[$r]<$Gsct_monday_stop) )
							{$state_gmt.="'$GMT_gmt[$r]',";}
						}
					}
				if ($GMT_day[$r]==2)	#### Tuesday local time
					{
					if (($Gsct_tuesday_start==0) and ($Gsct_tuesday_stop==0))
						{
						if ( ($GMT_hour[$r]>=$Gsct_default_start) and ($GMT_hour[$r]<$Gsct_default_stop) )
							{$state_gmt.="'$GMT_gmt[$r]',";}
						}
					else
						{
						if ( ($GMT_hour[$r]>=$Gsct_tuesday_start) and ($GMT_hour[$r]<$Gsct_tuesday_stop) )
							{$state_gmt.="'$GMT_gmt[$r]',";}
						}
					}
				if ($GMT_day[$r]==3)	#### Wednesday local time
					{
					if (($Gsct_wednesday_start==0) and ($Gsct_wednesday_stop==0))
						{
						if ( ($GMT_hour[$r]>=$Gsct_default_start) and ($GMT_hour[$r]<$Gsct_default_stop) )
							{$state_gmt.="'$GMT_gmt[$r]',";}
						}
					else
						{
						if ( ($GMT_hour[$r]>=$Gsct_wednesday_start) and ($GMT_hour[$r]<$Gsct_wednesday_stop) )
							{$state_gmt.="'$GMT_gmt[$r]',";}
						}
					}
				if ($GMT_day[$r]==4)	#### Thursday local time
					{
					if (($Gsct_thursday_start==0) and ($Gsct_thursday_stop==0))
						{
						if ( ($GMT_hour[$r]>=$Gsct_default_start) and ($GMT_hour[$r]<$Gsct_default_stop) )
							{$state_gmt.="'$GMT_gmt[$r]',";}
						}
					else
						{
						if ( ($GMT_hour[$r]>=$Gsct_thursday_start) and ($GMT_hour[$r]<$Gsct_thursday_stop) )
							{$state_gmt.="'$GMT_gmt[$r]',";}
						}
					}
				if ($GMT_day[$r]==5)	#### Friday local time
					{
					if (($Gsct_friday_start==0) and ($Gsct_friday_stop==0))
						{
						if ( ($GMT_hour[$r]>=$Gsct_default_start) and ($GMT_hour[$r]<$Gsct_default_stop) )
							{$state_gmt.="'$GMT_gmt[$r]',";}
						}
					else
						{
						if ( ($GMT_hour[$r]>=$Gsct_friday_start) and ($GMT_hour[$r]<$Gsct_friday_stop) )
							{$state_gmt.="'$GMT_gmt[$r]',";}
						}
					}
				if ($GMT_day[$r]==6)	#### Saturday local time
					{
					if (($Gsct_saturday_start==0) and ($Gsct_saturday_stop==0))
						{
						if ( ($GMT_hour[$r]>=$Gsct_default_start) and ($GMT_hour[$r]<$Gsct_default_stop) )
							{$state_gmt.="'$GMT_gmt[$r]',";}
						}
					else
						{
						if ( ($GMT_hour[$r]>=$Gsct_saturday_start) and ($GMT_hour[$r]<$Gsct_saturday_stop) )
							{$state_gmt.="'$GMT_gmt[$r]',";}
						}
					}
				$r++;
				}
			$state_gmt = "$state_gmt'99'";
			$ct_state_gmt_SQL .= "or (state='$Gstate_call_time_state' and gmt_offset_now IN($state_gmt)) ";
			}

		$b++;
		}
	if (strlen($ct_states)>2)
		{
		$ct_states = eregi_replace(",$",'',$ct_states);
		$ct_statesSQL = "and state NOT IN($ct_states)";
		}
	else
		{
		$ct_statesSQL = "";
		}

*/




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
