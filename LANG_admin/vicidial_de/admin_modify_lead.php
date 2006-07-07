<?
# admin_modify_lead.php
# 
# Copyright (C) 2006  Matt Florell <vicidial@gmail.com>    LICENSE: GPLv2
#

require("dbconnect.php");

$PHP_AUTH_USER=$_SERVER['PHP_AUTH_USER'];
$PHP_AUTH_PW=$_SERVER['PHP_AUTH_PW'];
$PHP_SELF=$_SERVER['PHP_SELF'];
if (isset($_GET["vendor_id"]))				{$vendor_id=$_GET["vendor_id"];}
	elseif (isset($_POST["vendor_id"]))		{$vendor_id=$_POST["vendor_id"];}
if (isset($_GET["phone"]))				{$phone=$_GET["phone"];}
	elseif (isset($_POST["phone"]))		{$phone=$_POST["phone"];}
if (isset($_GET["lead_id"]))				{$lead_id=$_GET["lead_id"];}
	elseif (isset($_POST["lead_id"]))		{$lead_id=$_POST["lead_id"];}
if (isset($_GET["first_name"]))				{$first_name=$_GET["first_name"];}
	elseif (isset($_POST["first_name"]))		{$first_name=$_POST["first_name"];}
if (isset($_GET["last_name"]))				{$last_name=$_GET["last_name"];}
	elseif (isset($_POST["last_name"]))		{$last_name=$_POST["last_name"];}
if (isset($_GET["phone_number"]))				{$phone_number=$_GET["phone_number"];}
	elseif (isset($_POST["phone_number"]))		{$phone_number=$_POST["phone_number"];}
if (isset($_GET["end_call"]))				{$end_call=$_GET["end_call"];}
	elseif (isset($_POST["end_call"]))		{$end_call=$_POST["end_call"];}
if (isset($_GET["DB"]))				{$DB=$_GET["DB"];}
	elseif (isset($_POST["DB"]))		{$DB=$_POST["DB"];}
if (isset($_GET["dispo"]))				{$dispo=$_GET["dispo"];}
	elseif (isset($_POST["dispo"]))		{$dispo=$_POST["dispo"];}
if (isset($_GET["list_id"]))				{$list_id=$_GET["list_id"];}
	elseif (isset($_POST["list_id"]))		{$list_id=$_POST["list_id"];}
if (isset($_GET["campaign_id"]))				{$campaign_id=$_GET["campaign_id"];}
	elseif (isset($_POST["campaign_id"]))		{$campaign_id=$_POST["campaign_id"];}
if (isset($_GET["phone_code"]))				{$phone_code=$_GET["phone_code"];}
	elseif (isset($_POST["phone_code"]))		{$phone_code=$_POST["phone_code"];}
if (isset($_GET["server_ip"]))				{$server_ip=$_GET["server_ip"];}
	elseif (isset($_POST["server_ip"]))		{$server_ip=$_POST["server_ip"];}
if (isset($_GET["extension"]))				{$extension=$_GET["extension"];}
	elseif (isset($_POST["extension"]))		{$extension=$_POST["extension"];}
if (isset($_GET["channel"]))				{$channel=$_GET["channel"];}
	elseif (isset($_POST["channel"]))		{$channel=$_POST["channel"];}
if (isset($_GET["call_began"]))				{$call_began=$_GET["call_began"];}
	elseif (isset($_POST["call_began"]))		{$call_began=$_POST["call_began"];}
if (isset($_GET["parked_time"]))				{$parked_time=$_GET["parked_time"];}
	elseif (isset($_POST["parked_time"]))		{$parked_time=$_POST["parked_time"];}
if (isset($_GET["tsr"]))				{$tsr=$_GET["tsr"];}
	elseif (isset($_POST["tsr"]))		{$tsr=$_POST["tsr"];}
if (isset($_GET["address1"]))				{$address1=$_GET["address1"];}
	elseif (isset($_POST["address1"]))		{$address1=$_POST["address1"];}
if (isset($_GET["address2"]))				{$address2=$_GET["address2"];}
	elseif (isset($_POST["address2"]))		{$address2=$_POST["address2"];}
if (isset($_GET["address3"]))				{$address3=$_GET["address3"];}
	elseif (isset($_POST["address3"]))		{$address3=$_POST["address3"];}
if (isset($_GET["city"]))				{$city=$_GET["city"];}
	elseif (isset($_POST["city"]))		{$city=$_POST["city"];}
if (isset($_GET["state"]))				{$state=$_GET["state"];}
	elseif (isset($_POST["state"]))		{$state=$_POST["state"];}
if (isset($_GET["postal_code"]))				{$postal_code=$_GET["postal_code"];}
	elseif (isset($_POST["postal_code"]))		{$postal_code=$_POST["postal_code"];}
if (isset($_GET["province"]))				{$province=$_GET["province"];}
	elseif (isset($_POST["province"]))		{$province=$_POST["province"];}
if (isset($_GET["country_code"]))				{$country_code=$_GET["country_code"];}
	elseif (isset($_POST["country_code"]))		{$country_code=$_POST["country_code"];}
if (isset($_GET["alt_phone"]))				{$alt_phone=$_GET["alt_phone"];}
	elseif (isset($_POST["alt_phone"]))		{$alt_phone=$_POST["alt_phone"];}
if (isset($_GET["email"]))				{$email=$_GET["email"];}
	elseif (isset($_POST["email"]))		{$email=$_POST["email"];}
if (isset($_GET["security"]))				{$security=$_GET["security"];}
	elseif (isset($_POST["security"]))		{$security=$_POST["security"];}
if (isset($_GET["comments"]))				{$comments=$_GET["comments"];}
	elseif (isset($_POST["comments"]))		{$comments=$_POST["comments"];}
if (isset($_GET["status"]))				{$status=$_GET["status"];}
	elseif (isset($_POST["status"]))		{$status=$_POST["status"];}
if (isset($_GET["submit"]))				{$submit=$_GET["submit"];}
	elseif (isset($_POST["submit"]))		{$submit=$_POST["submit"];}
if (isset($_GET["SUBMIT"]))				{$SUBMIT=$_GET["SUBMIT"];}
	elseif (isset($_POST["SUBMIT"]))		{$SUBMIT=$_POST["SUBMIT"];}
if (isset($_GET["CBchangeUSERtoANY"]))				{$CBchangeUSERtoANY=$_GET["CBchangeUSERtoANY"];}
	elseif (isset($_POST["CBchangeUSERtoANY"]))		{$CBchangeUSERtoANY=$_POST["CBchangeUSERtoANY"];}
if (isset($_GET["CBchangeUSERtoUSER"]))				{$CBchangeUSERtoUSER=$_GET["CBchangeUSERtoUSER"];}
	elseif (isset($_POST["CBchangeUSERtoUSER"]))		{$CBchangeUSERtoUSER=$_POST["CBchangeUSERtoUSER"];}
if (isset($_GET["CBchangeANYtoUSER"]))				{$CBchangeANYtoUSER=$_GET["CBchangeANYtoUSER"];}
	elseif (isset($_POST["CBchangeANYtoUSER"]))		{$CBchangeANYtoUSER=$_POST["CBchangeANYtoUSER"];}
if (isset($_GET["callback_id"]))				{$callback_id=$_GET["callback_id"];}
	elseif (isset($_POST["callback_id"]))		{$callback_id=$_POST["callback_id"];}
if (isset($_GET["CBuser"]))				{$CBuser=$_GET["CBuser"];}
	elseif (isset($_POST["CBuser"]))		{$CBuser=$_POST["CBuser"];}


$PHP_AUTH_USER = ereg_replace("[^0-9a-zA-Z]","",$PHP_AUTH_USER);
$PHP_AUTH_PW = ereg_replace("[^0-9a-zA-Z]","",$PHP_AUTH_PW);



### AST GUI database administration modify lead in vicidial_list
### admin_modify_lead.php

# this is the administration lead information modifier screen, the administrator just needs to enter the leadID and then they can view and modify the information in the record for that lead

# CHANGES
#
# 60419-1705 - Added ability to change lead callback record from USERONLY to ANYONE or USERONLY-user
# 60421-1459 - check GET/POST vars lines with isset to not trigger PHP NOTICES
# 60609-1112 - Added DNC list addition if status changed to DNC
# 60619-1539 - Added variable filtering to eliminate SQL injection attack threat
#

$STARTtime = date("U");
$TODAY = date("Y-m-d");
$NOW_TIME = date("Y-m-d H:i:s");


	$stmt="SELECT count(*) from vicidial_users where user='$PHP_AUTH_USER' and pass='$PHP_AUTH_PW' and user_level > 7;";
	if ($DB) {echo "|$stmt|\n";}
	$rslt=mysql_query($stmt, $link);
	$row=mysql_fetch_row($rslt);
	$auth=$row[0];

if ($WeBRooTWritablE > 0)
	{$fp = fopen ("./project_auth_entries.txt", "a");}

$date = date("r");
$ip = getenv("REMOTE_ADDR");
$browser = getenv("HTTP_USER_AGENT");

  if( (strlen($PHP_AUTH_USER)<2) or (strlen($PHP_AUTH_PW)<2) or (!$auth))
	{
    Header("WWW-Authenticate: Basic realm=\"VICI-PROJECTS\"");
    Header("HTTP/1.0 401 Unauthorized");
    echo "Unzulässiges Username/Kennwort:|$PHP_AUTH_USER|$PHP_AUTH_PW|\n";
    exit;
	}
  else
	{

	if($auth>0)
		{
			$stmt="SELECT full_name,modify_leads from vicidial_users where user='$PHP_AUTH_USER' and pass='$PHP_AUTH_PW'";
			$rslt=mysql_query($stmt, $link);
			$row=mysql_fetch_row($rslt);
			$LOGfullname				=$row[0];
			$LOGmodify_leads			=$row[1];

		if ($WeBRooTWritablE > 0)
			{
			fwrite ($fp, "VICIDIAL|GOOD|$date|$PHP_AUTH_USER|$PHP_AUTH_PW|$ip|$browser|$LOGfullname|\n");
			fclose($fp);
			}
		}
	else
		{
		if ($WeBRooTWritablE > 0)
			{
			fwrite ($fp, "VICIDIAL|FAIL|$date|$PHP_AUTH_USER|$PHP_AUTH_PW|$ip|$browser|\n");
			fclose($fp);
			}
		}
	}

?>
<html>
<head>
<META HTTP-EQUIV="Content-Type" CONTENT="text/html; charset=utf-8">
<title>VICIDIAL ADMIN: Leitung notieren Änderung</title>
</head>
<BODY BGCOLOR=white marginheight=0 marginwidth=0 leftmargin=0 topmargin=0>
<CENTER><FONT FACE="Courier" COLOR=BLACK SIZE=3>

<? 

if ($end_call > 0)
{

$call_length = ($STARTtime - $call_began);

	### insert a NEW record to the vicidial_closer_log table 
	$stmt="INSERT INTO vicidial_closer_log (lead_id,list_id,campaign_id,call_date,start_epoch,end_epoch,length_in_sec,status,phone_code,phone_number,user,comments,processed) values('" . mysql_real_escape_string($lead_id) . "','" . mysql_real_escape_string($list_id) . "','" . mysql_real_escape_string($campaign_id) . "','" . mysql_real_escape_string($parked_time) . "','" . mysql_real_escape_string($call_began) . "','$STARTtime','" . mysql_real_escape_string($call_length) . "','" . mysql_real_escape_string($status) . "','" . mysql_real_escape_string($phone_code) . "','" . mysql_real_escape_string($phone_number) . "','$PHP_AUTH_USER','" . mysql_real_escape_string($comments) . "','Y')";
	if ($DB) {echo "|$stmt|\n";}
	$rslt=mysql_query($stmt, $link);

	### update the lead record in the vicidial_list table 
	$stmt="UPDATE vicidial_list set status='" . mysql_real_escape_string($status) . "',first_name='" . mysql_real_escape_string($first_name) . "',last_name='" . mysql_real_escape_string($last_name) . "',address1='" . mysql_real_escape_string($address1) . "',address2='" . mysql_real_escape_string($address2) . "',address3='" . mysql_real_escape_string($address3) . "',city='" . mysql_real_escape_string($city) . "',state='" . mysql_real_escape_string($state) . "',province='" . mysql_real_escape_string($province) . "',postal_code='" . mysql_real_escape_string($postal_code) . "',country_code='" . mysql_real_escape_string($country_code) . "',alt_phone='" . mysql_real_escape_string($alt_phone) . "',email='" . mysql_real_escape_string($email) . "',security_phrase='" . mysql_real_escape_string($security) . "',comments='" . mysql_real_escape_string($comments) . "' where lead_id='" . mysql_real_escape_string($lead_id) . "'";
	if ($DB) {echo "|$stmt|\n";}
	$rslt=mysql_query($stmt, $link);

		echo "Informationen geändert<BR><BR>\n";
		echo "<form><input type=button value=\"Schließen Sie Dieses Fenster\" onClick=\"javascript:window.close();\"></form>\n";
	
	if ( ($dispo != $status) and ($dispo == 'CBHOLD') )
	{
		### inactivate vicidial_callbacks record for this lead 
		$stmt="UPDATE vicidial_callbacks set status='INACTIVE' where lead_id='" . mysql_real_escape_string($lead_id) . "' and status='ACTIVE';";
		if ($DB) {echo "|$stmt|\n";}
		$rslt=mysql_query($stmt, $link);

		echo "<BR>vicidial_callback record inactivated: $lead_id<BR>\n";
	}
	if ( ($dispo != $status) and ($dispo == 'CALLBK') )
	{
		### inactivate vicidial_callbacks record for this lead 
		$stmt="UPDATE vicidial_callbacks set status='INACTIVE' where lead_id='" . mysql_real_escape_string($lead_id) . "' and status IN('ACTIVE','LIVE');";
		if ($DB) {echo "|$stmt|\n";}
		$rslt=mysql_query($stmt, $link);

		echo "<BR>vicidial_callback record inactivated: $lead_id<BR>\n";
	}

	if ( ($dispo != $status) and ($status == 'DNC') )
	{
		### add lead to the internal DNC list 
		$stmt="INSERT INTO vicidial_dnc (phone_number) values('" . mysql_real_escape_string($phone_number) . "');";
		if ($DB) {echo "|$stmt|\n";}
		$rslt=mysql_query($stmt, $link);

		echo "<BR>Lead added to DNC List: $lead_id - $phone_number<BR>\n";
	}

}
else
{

	if ($CBchangeUSERtoANY == 'YES')
		{
		### inactivate vicidial_callbacks record for this lead 
		$stmt="UPDATE vicidial_callbacks set recipient='ANYONE' where callback_id='" . mysql_real_escape_string($callback_id) . "';";
		if ($DB) {echo "|$stmt|\n";}
		$rslt=mysql_query($stmt, $link);

		echo "<BR>vicidial_callback record changed to ANYONE<BR>\n";
		}
	if ($CBchangeUSERtoUSER == 'YES')
		{
		### inactivate vicidial_callbacks record for this lead 
		$stmt="UPDATE vicidial_callbacks set user='" . mysql_real_escape_string($CBuser) . "' where callback_id='" . mysql_real_escape_string($callback_id) . "';";
		if ($DB) {echo "|$stmt|\n";}
		$rslt=mysql_query($stmt, $link);

		echo "<BR>vicidial_callback record user changed to $CBuser<BR>\n";
		}	
	if ($CBchangeANYtoUSER == 'YES')
		{
		### inactivate vicidial_callbacks record for this lead 
		$stmt="UPDATE vicidial_callbacks set user='" . mysql_real_escape_string($CBuser) . "',recipient='USERONLY' where callback_id='" . mysql_real_escape_string($callback_id) . "';";
		if ($DB) {echo "|$stmt|\n";}
		$rslt=mysql_query($stmt, $link);

		echo "<BR>vicidial_callback record changed to USERONLY, user: $CBuser<BR>\n";
		}	
	
	

	$stmt="SELECT count(*) from vicidial_list where lead_id='" . mysql_real_escape_string($lead_id) . "'";
	$rslt=mysql_query($stmt, $link);
	if ($DB) {echo "$stmt\n";}
	$row=mysql_fetch_row($rslt);
	$lead_count = $row[0];

	if ($lead_count > 0)
	{

		$stmt="SELECT * from vicidial_list where lead_id='" . mysql_real_escape_string($lead_id) . "'";
		$rslt=mysql_query($stmt, $link);
		if ($DB) {echo "$stmt\n";}
		$row=mysql_fetch_row($rslt);
		   $lead_id			= "$row[0]";
		   $dispo			= "$row[3]";
		   $tsr				= "$row[4]";
		   $vendor_id		= "$row[5]";
		   $list_id			= "$row[7]";
		   $campaign_id		= "$row[8]";
		   $phone_code		= "$row[10]";
		   $phone_number	= "$row[11]";
		   $title			= "$row[12]";
		   $first_name		= "$row[13]";	#
		   $middle_initial	= "$row[14]";
		   $last_name		= "$row[15]";	#
		   $address1		= "$row[16]";	#
		   $address2		= "$row[17]";	#
		   $address3		= "$row[18]";	#
		   $city			= "$row[19]";	#
		   $state			= "$row[20]";	#
		   $province		= "$row[21]";	#
		   $postal_code		= "$row[22]";	#
		   $country_code	= "$row[23]";	#
		   $gender			= "$row[24]";
		   $date_of_birth	= "$row[25]";
		   $alt_phone		= "$row[26]";	#
		   $email			= "$row[27]";	#
		   $security		= "$row[28]";	#
		   $comments		= "$row[29]";	#

		echo "<br>Anrufinformationen: $first_name $last_name - $phone_number<br><br><form action=$PHP_SELF method=POST>\n";
		echo "<input type=hidden name=end_call value=1>\n";
		echo "<input type=hidden name=DB value=\"$DB\">\n";
		echo "<input type=hidden name=lead_id value=\"$lead_id\">\n";
		echo "<input type=hidden name=dispo value=\"$dispo\">\n";
		echo "<input type=hidden name=list_id value=\"$list_id\">\n";
		echo "<input type=hidden name=campaign_id value=\"$campaign_id\">\n";
		echo "<input type=hidden name=phone_code value=\"$phone_code\">\n";
		echo "<input type=hidden name=phone_number value=\"$phone_number\">\n";
		echo "<input type=hidden name=server_ip value=\"$server_ip\">\n";
		echo "<input type=hidden name=extension value=\"$extension\">\n";
		echo "<input type=hidden name=channel value=\"$channel\">\n";
		echo "<input type=hidden name=call_began value=\"$call_began\">\n";
		echo "<input type=hidden name=parked_time value=\"$parked_time\">\n";
		echo "<table cellpadding=1 cellspacing=0>\n";
		echo "<tr><td colspan=2>Vendor ID: $vendor_id &nbsp; &nbsp; Lead ID: $lead_id</td></tr>\n";
		echo "<tr><td colspan=2>Fronter: <A HREF=\"user_stats.php?user=$tsr\">$tsr</A> &nbsp; &nbsp; Liste Identifikation: $list_id</td></tr>\n";
		echo "<tr><td align=right>Vorname: </td><td align=left><input type=text name=first_name size=15 maxlength=30 value=\"$first_name\"> &nbsp; \n";
		echo " Letzter Name: <input type=text name=last_name size=15 maxlength=30 value=\"$last_name\"> </td></tr>\n";
		echo "<tr><td align=rightAdresse1 : </td><td align=left><input type=text name=address1 size=30 maxlength=30 value=\"$address1\"></td></tr>\n";
		echo "<tr><td align=rightAdresse2 : </td><td align=left><input type=text name=address2 size=30 maxlength=30 value=\"$address2\"></td></tr>\n";
		echo "<tr><td align=rightAdresse3 : </td><td align=left><input type=text name=address3 size=30 maxlength=30 value=\"$address3\"></td></tr>\n";
		echo "<tr><td align=rightStadt: </td><td align=left><input type=text name=city size=30 maxlength=30 value=\"$city\"></td></tr>\n";
		echo "<tr><td align=rightZustand: </td><td align=left><input type=text name=state size=2 maxlength=2 value=\"$state\"> &nbsp; \n";
		echo "Postcode: <input type=text name=postal_code size=10 maxlength=10 value=\"$postal_code\"> </td></tr>\n";

		echo "<tr><td align=rightProvinz: </td><td align=left><input type=text name=province size=30 maxlength=30 value=\"$province\"></td></tr>\n";
		echo "<tr><td align=rightLand: </td><td align=left><input type=text name=country_code size=3 maxlength=3 value=\"$country_code\"></td></tr>\n";
		echo "<tr><td align=rightAlt Telefon: </td><td align=left><input type=text name=alt_phone size=10 maxlength=10 value=\"$alt_phone\"></td></tr>\n";
		echo "<tr><td align=rightEmail: </td><td align=left><input type=text name=email size=30 maxlength=50 value=\"$email\"></td></tr>\n";
		echo "<tr><td align=rightSicherheit: </td><td align=left><input type=text name=security size=30 maxlength=100 value=\"$security\"></td></tr>\n";
		echo "<tr><td align=rightAnmerkungen: </td><td align=left><input type=text name=comments size=30 maxlength=255 value=\"$comments\"></td></tr>\n";
			echo "<tr bgcolor=#B6D3FC><td align=rightEinteilung: </td><td align=left><select size=1 name=status>\n";

				$stmt="SELECT * from vicidial_statuses where selectable='Y' order by status";
				$rslt=mysql_query($stmt, $link);
				$statuses_to_print = mysql_num_rows($rslt);
				$statuses_list='';

				$o=0;
				$DS=0;
				while ($statuses_to_print > $o) 
				{
					$rowx=mysql_fetch_row($rslt);
					if ($dispo == "$rowx[0]")
						{$statuses_list .= "<option SELECTED value=\"$rowx[0]\">$rowx[0] - $rowx[1]</option>\n"; $DS++;}
					else
						{$statuses_list .= "<option value=\"$rowx[0]\">$rowx[0] - $rowx[1]</option>\n";}
					$o++;
				}
				if ($DS < 1) {$statuses_list .= "<option SELECTED value=\"$dispo\">$dispo</option>\n";}
			echo "$statuses_list";
			echo "</select></td></tr>\n";


		echo "<tr><td colspan=2><input type=submit name=submit value=\"SUBMIT\"></td></tr>\n";
		echo "</table></form>\n";
		echo "<BR><BR><BR>\n";

		if ( ($dispo == 'CALLBK') or ($dispo == 'CBHOLD') )
		{
			### find any vicidial_callback records for this lead 
			$stmt="select * from vicidial_callbacks where lead_id='" . mysql_real_escape_string($lead_id) . "' and status IN('ACTIVE','LIVE') order by callback_id desc LIMIT 1;";
			if ($DB) {echo "|$stmt|\n";}
			$rslt=mysql_query($stmt, $link);
			$CB_to_print = mysql_num_rows($rslt);
			$rowx=mysql_fetch_row($rslt);

			if ($CB_to_print>0)
				{
				if ($rowx[9] == 'USERONLY')
					{
					echo "<br><form action=$PHP_SELF method=POST>\n";
					echo "<input type=hidden name=CBchangeUSERtoANY value=\"YES\">\n";
					echo "<input type=hidden name=DB value=\"$DB\">\n";
					echo "<input type=hidden name=lead_id value=\"$lead_id\">\n";
					echo "<input type=hidden name=callback_id value=\"$rowx[0]\">\n";
					echo "<input type=submit name=submit value=\"CHANGE TO ANYONE CALLBACK\"></form><BR>\n";

					echo "<br><form action=$PHP_SELF method=POST>\n";
					echo "<input type=hidden name=CBchangeUSERtoUSER value=\"YES\">\n";
					echo "<input type=hidden name=DB value=\"$DB\">\n";
					echo "<input type=hidden name=lead_id value=\"$lead_id\">\n";
					echo "<input type=hidden name=callback_id value=\"$rowx[0]\">\n";
					echo "New Callback Owner UserID: <input type=text name=CBuser size=8 maxlength=10 value=\"$rowx[8]\"> \n";
					echo "<input type=submit name=submit value=\"CHANGE USERONLY CALLBACK USER\"></form><BR>\n";
					}
				else
					{
					echo "<br><form action=$PHP_SELF method=POST>\n";
					echo "<input type=hidden name=CBchangeANYtoUSER value=\"YES\">\n";
					echo "<input type=hidden name=DB value=\"$DB\">\n";
					echo "<input type=hidden name=lead_id value=\"$lead_id\">\n";
					echo "<input type=hidden name=callback_id value=\"$rowx[0]\">\n";
					echo "New Callback Owner UserID: <input type=text name=CBuser size=8 maxlength=10 value=\"$rowx[8]\"> \n";
					echo "<input type=submit name=submit value=\"CHANGE TO USERONLY CALLBACK\"></form><BR>\n";
					}
				}
			else
				{
				echo "<BR>No Callback records found<BR>\n";
				}
		}






	}
	else
	{
		echo "Leitung Nachschlagen FIEL für lead_id aus $lead_id &nbsp; &nbsp; &nbsp; $NOW_TIME\n<BR><BR>\n";
#		echo "<a href=\"$PHP_SELF\">Close this window</a>\n<BR><BR>\n";
	}



echo "<br><br>\n";

echo "<center>\n";

echo "<B>ANRUFE ZU DIESEM LEITUNG:</B>\n";
echo "<TABLE width=550 cellspacing=0 cellpadding=1>\n";
echo "<tr><td><font size=2>DATE/TIME </td><td align=left><font size=2>LENGTH</td><td align=left><font size=2> STATUS</td><td align=left><font size=2> TSR</td><td align=right><font size=2> KAMPAGNE</td><td align=right><font size=2> LIST</td><td align=right><font size=2> LEAD</td></tr>\n";

	$stmt="select * from vicidial_log where lead_id='" . mysql_real_escape_string($lead_id) . "' order by uniqueid desc limit 50;";
	$rslt=mysql_query($stmt, $link);
	$logs_to_print = mysql_num_rows($rslt);

	$u=0;
	while ($logs_to_print > $u) {
		$row=mysql_fetch_row($rslt);
		if (eregi("1$|3$|5$|7$|9$", $u))
			{$bgcolor='bgcolor="#B9CBFD"';} 
		else
			{$bgcolor='bgcolor="#9BB9FB"';}

			echo "<tr $bgcolor><td><font size=2>$row[4]</td>";
			echo "<td align=left><font size=2> $row[7]</td>\n";
			echo "<td align=left><font size=2> $row[8]</td>\n";
			echo "<td align=left><font size=2> <A HREF=\"user_stats.php?user=$row[11]\" target=\"_blank\">$row[11]</A> </td>\n";
			echo "<td align=right><font size=2> $row[3] </td>\n";
			echo "<td align=right><font size=2> $row[2] </td>\n";
			echo "<td align=right><font size=2> $row[1] </td></tr>\n";

		$u++;
	}


echo "</TABLE></center>\n";



}


$ENDtime = date("U");

$RUNtime = ($ENDtime - $STARTtime);

echo "\n\n\n<br><br><br>\n\n";


echo "<font size=0>\n\n\n<br><br><br>\nIndexlaufzeit: $RUNtime seconds</font>";


?>


</body>
</html>

<?
	
exit; 



?>





