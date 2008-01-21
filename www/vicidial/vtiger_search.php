<?
### vtiger_search.php
### 
### Copyright (C) 2006  Matt Florell <vicidial@gmail.com>    LICENSE: GPLv2
###
# This page does a search against a standard vtiger CRM system. If the record 
# is not present, it will create a new one and send the agent's screen to that new page.
#
# This code is tested against vtiger 5.0.3
#
# CHANGES
# 60719-1615 - First version
# 60801-2304 - added mysql debug and auto-forward
# 60802-1111 - added insertion of not-found record into vtiger system
# 80120-1934 - added changes for compatibility with vtiger 5.0.3
#

#Asterisk/VICIDIAL Server (ASTERISK)
#Internal : 10.10.10.15
#External : 55.55.55.55

#vtiger Server(TEST1)
#Internal : 10.10.10.16
#External : 55.55.55.56

### Modified 20.Dec.2007 by I. Taushanov for VTiger 5.03- search/create lead


### alter to connect to your vtiger database, "IP", "username for DB", 'password for DB')
$link=mysql_connect("xxx.xxx.xxx.xxx", "dbuser",'dbpassword');
if (!$link) {die('Could not connect: ' . mysql_error());}
echo 'Connected successfully';
mysql_select_db("vtigercrm503");


$PHP_SELF=$_SERVER['PHP_SELF'];
if (isset($_GET["address1"]))				{$address1=$_GET["address1"];}
	elseif (isset($_POST["address1"]))		{$address1=$_POST["address1"];}
if (isset($_GET["address2"]))				{$address2=$_GET["address2"];}
	elseif (isset($_POST["address2"]))		{$address2=$_POST["address2"];}
if (isset($_GET["address3"]))				{$address3=$_GET["address3"];}
	elseif (isset($_POST["address3"]))		{$address3=$_POST["address3"];}
if (isset($_GET["alt_phone"]))				{$alt_phone=$_GET["alt_phone"];}
	elseif (isset($_POST["alt_phone"]))		{$alt_phone=$_POST["alt_phone"];}
if (isset($_GET["call_began"]))				{$call_began=$_GET["call_began"];}
	elseif (isset($_POST["call_began"]))		{$call_began=$_POST["call_began"];}
if (isset($_GET["campaign_id"]))				{$campaign_id=$_GET["campaign_id"];}
	elseif (isset($_POST["campaign_id"]))		{$campaign_id=$_POST["campaign_id"];}
if (isset($_GET["channel"]))				{$channel=$_GET["channel"];}
	elseif (isset($_POST["channel"]))		{$channel=$_POST["channel"];}
if (isset($_GET["channel_group"]))				{$channel_group=$_GET["channel_group"];}
	elseif (isset($_POST["channel_group"]))		{$channel_group=$_POST["channel_group"];}
if (isset($_GET["city"]))				{$city=$_GET["city"];}
	elseif (isset($_POST["city"]))		{$city=$_POST["city"];}
if (isset($_GET["comments"]))				{$comments=$_GET["comments"];}
	elseif (isset($_POST["comments"]))		{$comments=$_POST["comments"];}
if (isset($_GET["country_code"]))				{$country_code=$_GET["country_code"];}
	elseif (isset($_POST["country_code"]))		{$country_code=$_POST["country_code"];}
if (isset($_GET["customer_zap_channel"]))				{$customer_zap_channel=$_GET["customer_zap_channel"];}
	elseif (isset($_POST["customer_zap_channel"]))		{$customer_zap_channel=$_POST["customer_zap_channel"];}
if (isset($_GET["DB"]))				{$DB=$_GET["DB"];}
	elseif (isset($_POST["DB"]))		{$DB=$_POST["DB"];}
if (isset($_GET["dispo"]))				{$dispo=$_GET["dispo"];}
	elseif (isset($_POST["dispo"]))		{$dispo=$_POST["dispo"];}
if (isset($_GET["email"]))				{$email=$_GET["email"];}
	elseif (isset($_POST["email"]))		{$email=$_POST["email"];}
if (isset($_GET["end_call"]))				{$end_call=$_GET["end_call"];}
	elseif (isset($_POST["end_call"]))		{$end_call=$_POST["end_call"];}
if (isset($_GET["extension"]))				{$extension=$_GET["extension"];}
	elseif (isset($_POST["extension"]))		{$extension=$_POST["extension"];}
if (isset($_GET["first_name"]))				{$first_name=$_GET["first_name"];}
	elseif (isset($_POST["first_name"]))		{$first_name=$_POST["first_name"];}
if (isset($_GET["group"]))				{$group=$_GET["group"];}
	elseif (isset($_POST["group"]))		{$group=$_POST["group"];}
if (isset($_GET["last_name"]))				{$last_name=$_GET["last_name"];}
	elseif (isset($_POST["last_name"]))		{$last_name=$_POST["last_name"];}
if (isset($_GET["lead_id"]))				{$lead_id=$_GET["lead_id"];}
	elseif (isset($_POST["lead_id"]))		{$lead_id=$_POST["lead_id"];}
if (isset($_GET["list_id"]))				{$list_id=$_GET["list_id"];}
	elseif (isset($_POST["list_id"]))		{$list_id=$_POST["list_id"];}
if (isset($_GET["parked_time"]))				{$parked_time=$_GET["parked_time"];}
	elseif (isset($_POST["parked_time"]))		{$parked_time=$_POST["parked_time"];}
if (isset($_GET["pass"]))				{$pass=$_GET["pass"];}
	elseif (isset($_POST["pass"]))		{$pass=$_POST["pass"];}
if (isset($_GET["phone_code"]))				{$phone_code=$_GET["phone_code"];}
	elseif (isset($_POST["phone_code"]))		{$phone_code=$_POST["phone_code"];}
if (isset($_GET["phone_number"]))				{$phone_number=$_GET["phone_number"];}
	elseif (isset($_POST["phone_number"]))		{$phone_number=$_POST["phone_number"];}
if (isset($_GET["phone"]))				{$phone=$_GET["phone"];}
	elseif (isset($_POST["phone"]))		{$phone=$_POST["phone"];}
if (isset($_GET["postal_code"]))				{$postal_code=$_GET["postal_code"];}
	elseif (isset($_POST["postal_code"]))		{$postal_code=$_POST["postal_code"];}
if (isset($_GET["province"]))				{$province=$_GET["province"];}
	elseif (isset($_POST["province"]))		{$province=$_POST["province"];}
if (isset($_GET["security"]))				{$security=$_GET["security"];}
	elseif (isset($_POST["security"]))		{$security=$_POST["security"];}
if (isset($_GET["server_ip"]))				{$server_ip=$_GET["server_ip"];}
	elseif (isset($_POST["server_ip"]))		{$server_ip=$_POST["server_ip"];}
if (isset($_GET["server_ip"]))				{$server_ip=$_GET["server_ip"];}
	elseif (isset($_POST["server_ip"]))		{$server_ip=$_POST["server_ip"];}
if (isset($_GET["session_id"]))				{$session_id=$_GET["session_id"];}
	elseif (isset($_POST["session_id"]))		{$session_id=$_POST["session_id"];}
if (isset($_GET["state"]))				{$state=$_GET["state"];}
	elseif (isset($_POST["state"]))		{$state=$_POST["state"];}
if (isset($_GET["status"]))				{$status=$_GET["status"];}
	elseif (isset($_POST["status"]))		{$status=$_POST["status"];}
if (isset($_GET["tsr"]))				{$tsr=$_GET["tsr"];}
	elseif (isset($_POST["tsr"]))		{$tsr=$_POST["tsr"];}
if (isset($_GET["user"]))				{$user=$_GET["user"];}
	elseif (isset($_POST["user"]))		{$user=$_POST["user"];}
if (isset($_GET["vendor_id"]))				{$vendor_id=$_GET["vendor_id"];}
	elseif (isset($_POST["vendor_id"]))		{$vendor_id=$_POST["vendor_id"];}
if (isset($_GET["submit"]))				{$submit=$_GET["submit"];}
	elseif (isset($_POST["submit"]))		{$submit=$_POST["submit"];}
if (isset($_GET["SUBMIT"]))				{$SUBMIT=$_GET["SUBMIT"];}
	elseif (isset($_POST["SUBMIT"]))		{$SUBMIT=$_POST["SUBMIT"];}

#$PHP_AUTH_USER = ereg_replace("[^0-9a-zA-Z]","",$PHP_AUTH_USER);
#$PHP_AUTH_PW = ereg_replace("[^0-9a-zA-Z]","",$PHP_AUTH_PW);

#$DB = '1';	# DEBUG override
$US = '_';
$STARTtime = date("U");
$TODAY = date("Y-m-d");
$NOW_TIME = date("Y-m-d H:i:s");
$REC_TIME = date("Ymd-His");
$FILE_datetime = $STARTtime;
$parked_time = $STARTtime;

echo "<html>\n";
echo "<head>\n";
echo "<title>VICIDIAL Vtiger Lookup</title>\n";
echo "<META HTTP-EQUIV=\"Content-Type\" CONTENT=\"text/html; charset=utf-8\">\n";


$stmt="SELECT count(*) from vtiger_leadaddress where phone='$phone' or mobile='$phone' or fax='$phone';";
$rslt=mysql_query($stmt, $link);
if ($DB) {echo "$stmt\n";}
if (!$rslt) {
   die('Could not execute: ' . mysql_error());
}
$row=mysql_fetch_row($rslt);
$found_count = $row[0];

#echo "<BR>\n|$phone|$found_count|\n";

if ($found_count < 1)
{
	echo "</head>\n";
	echo "<BODY BGCOLOR=white marginheight=0 marginwidth=0 leftmargin=0 topmargin=0 onLoad=\"document.forms[0].search_phone.focus(); setTimeout('document.forms[0].phone.focus()', 1000); self.focus()\">\n";
	echo "<CENTER><FONT FACE=\"Courier\" COLOR=BLACK SIZE=3>\n";
	echo "$phone not found, creating account...\n";
#Get logged in user ID
	if ($DB) {echo "<PRE>";}
	$stmt="SELECT id from vtiger_users where user_name='$user';";
	if ($DB) {echo "$stmt\n";}
	$rslt=mysql_query($stmt, $link);
	$row=mysql_fetch_row($rslt);
	$user_id = $row[0];
	if (!$rslt) {die('Could not execute: ' . mysql_error());}
	
#Vtiger no longer use auto increment for vtiger_crmentity crmid, vtiger_crmentity_seq is used instead to list next aviable entity ID
# Get next aviable id to use as  crmid in vtiger_crmentity	
	$stmt="SELECT id from vtiger_crmentity_seq ;";
	if ($DB) {echo "$stmt\n";}
	$rslt=mysql_query($stmt, $link);
	$row=mysql_fetch_row($rslt);
	$leadid = $row[0];
	if (!$rslt) {die('Could not execute: ' . mysql_error());}

# Increase 	next aviable crmid with 1 so next record gets proper id
	$stmt="UPDATE vtiger_crmentity_seq SET `id` = `id` + 1;";
	if ($DB) {echo "$stmt\n";}
	$rslt=mysql_query($stmt, $link);
	if (!$rslt) {die('Could not execute: ' . mysql_error());}
	
	
#Insert values into tiger_crmentity
	$stmt = "INSERT INTO vtiger_crmentity (crmid, smcreatorid, smownerid, modifiedby, setype, description, createdtime, modifiedtime, viewedtime, status, version, presence, deleted) VALUES ('$leadid', '$user_id', '$user_id','$user_id', 'Leads', '(Memo)', '$NOW_TIME', '$NOW_TIME', '$NOW_TIME', NULL, '0', '1', '0');";
	if ($DB) {echo "|$stmt|\n";}
	$rslt=mysql_query($stmt, $link);
	if ($DB) {echo "|$leadid|\n";}
	if (!$rslt) {die('Could not execute: ' . mysql_error());}

#Insert values into vtiger_leaddetails	
	$stmt = "INSERT INTO vtiger_leaddetails (leadid,firstname,lastname,company) values('$leadid','$first_name','$last_name','$first_name $last_name');";
	if ($DB) {echo "|$stmt|\n";}
	$rslt=mysql_query($stmt, $link);
	if (!$rslt) {die('Could not execute: ' . mysql_error());}

#Insert values into vtiger_leaddetails
	$stmt = "INSERT INTO vtiger_leadaddress (leadaddressid,city,code,state,country,phone,mobile,lane) values('$leadid','$city','$postal_code','$province','$country','$phone','$alt_phone','$address1 $address2');";
	if ($DB) {echo "|$stmt|\n";}
	$rslt=mysql_query($stmt, $link);
	if (!$rslt) {die('Could not execute: ' . mysql_error());}

#Insert values into vtiger_leadsubdetails	
	$stmt = "INSERT INTO vtiger_leadsubdetails (leadsubscriptionid) VALUES ('$leadid');";
	if ($DB) {echo "|$stmt|\n";}
	$rslt=mysql_query($stmt, $link);
	if (!$rslt) {die('Could not execute: ' . mysql_error());}
	
#Insert values into vtiger_leadscf, these are custom created fields example	
#	$stmt = "INSERT INTO vtiger_leadscf (leadid,cf_452,cf_454,cf_456) VALUES ('$leadid','$email','$address3','$security');";
#	if ($DB) {echo "|$stmt|\n";}
#	$rslt=mysql_query($stmt, $link);
#	if (!$rslt) {die('Could not execute: ' . mysql_error());}

	if ($DB) {echo "DONE\n";}

#ammend with your Vtiger Address	
	$account_URL = "http://mysite.com/vtigercrm/index.php?module=Leads&action=DetailView&record=$leadid";
	echo "<META HTTP-EQUIV=Refresh CONTENT=\"0; URL=$account_URL\">\n";
	echo "</head>\n";
	echo "<BODY BGCOLOR=white marginheight=0 marginwidth=0 leftmargin=0 topmargin=0 onLoad=\"document.forms[0].search_phone.focus(); setTimeout('document.forms[0].phone.focus()', 1000); self.focus()\">\n";
	echo "<CENTER><FONT FACE=\"Courier\" COLOR=BLACK SIZE=3>\n";

	echo "<PRE>";
	echo "account created!\n";
	echo "accountid:   <a href=\"$account_URL\">$leadid</a>\n";
	echo "phone:       $phone\n";
	echo "</PRE><BR>";

}
else
{
	$stmt="SELECT leadaddressid from vtiger_leadaddress where phone='$phone' or mobile='$phone' or fax='$phone';";
	$rslt=mysql_query($stmt, $link);
	if ($DB) {echo "$stmt\n";}
	$row=mysql_fetch_row($rslt);
	$leadid = $row[0];

	
#ammend with your Vtiger Address
	$account_URL = "http://mysite.com/vtigercrm/index.php?module=Leads&action=DetailView&record=$leadid";
	echo "<META HTTP-EQUIV=Refresh CONTENT=\"0; URL=$account_URL\">\n";
	echo "</head>\n";
	echo "<BODY BGCOLOR=white marginheight=0 marginwidth=0 leftmargin=0 topmargin=0 onLoad=\"document.forms[0].search_phone.focus(); setTimeout('document.forms[0].phone.focus()', 1000); self.focus()\">\n";
	echo "<CENTER><FONT FACE=\"Courier\" COLOR=BLACK SIZE=3>\n";

	echo "<PRE>";
	echo "account found!\n";
	echo "accountid:   <a href=\"$account_URL\">$leadid</a>\n";
	echo "phone:       $phone\n";
	echo "</PRE><BR>";

}



$ENDtime = date("U");

$RUNtime = ($ENDtime - $STARTtime);

echo "\n\n\n<br><br><br>\n\n";


echo "<font size=0>\n\n\n<br><br><br>\nscript runtime: $RUNtime seconds</font>";


?>


</body>
</html>

<?
	
exit; 



?>





