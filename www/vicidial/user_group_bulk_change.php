<?
# user_group_bulk_change.php
# 
# Copyright (C) 2008  Matt Florell <vicidial@gmail.com>    LICENSE: AGPLv2
#
# CHANGES
# 81119-0918 - First build
#

header ("Content-type: text/html; charset=utf-8");

require("dbconnect.php");

$PHP_AUTH_USER=$_SERVER['PHP_AUTH_USER'];
$PHP_AUTH_PW=$_SERVER['PHP_AUTH_PW'];
$PHP_SELF=$_SERVER['PHP_SELF'];
if (isset($_GET["old_group"]))			{$old_group=$_GET["old_group"];}
	elseif (isset($_POST["old_group"]))	{$old_group=$_POST["old_group"];}
if (isset($_GET["group"]))				{$group=$_GET["group"];}
	elseif (isset($_POST["group"]))		{$group=$_POST["group"];}
if (isset($_GET["stage"]))				{$stage=$_GET["stage"];}
	elseif (isset($_POST["stage"]))		{$stage=$_POST["stage"];}
if (isset($_GET["DB"]))					{$DB=$_GET["DB"];}
	elseif (isset($_POST["DB"]))		{$DB=$_POST["DB"];}
if (isset($_GET["submit"]))				{$submit=$_GET["submit"];}
	elseif (isset($_POST["submit"]))	{$submit=$_POST["submit"];}
if (isset($_GET["SUBMIT"]))				{$SUBMIT=$_GET["SUBMIT"];}
	elseif (isset($_POST["SUBMIT"]))	{$SUBMIT=$_POST["SUBMIT"];}

#############################################
##### START SYSTEM_SETTINGS LOOKUP #####
$stmt = "SELECT use_non_latin,webroot_writable FROM system_settings;";
$rslt=mysql_query($stmt, $link);
if ($DB) {echo "$stmt\n";}
$qm_conf_ct = mysql_num_rows($rslt);
$i=0;
while ($i < $qm_conf_ct)
	{
	$row=mysql_fetch_row($rslt);
	$non_latin =		$row[0];
	$webroot_writable =	$row[1];
	$i++;
	}
##### END SETTINGS LOOKUP #####
###########################################

$PHP_AUTH_USER = ereg_replace("[^0-9a-zA-Z]","",$PHP_AUTH_USER);
$PHP_AUTH_PW = ereg_replace("[^0-9a-zA-Z]","",$PHP_AUTH_PW);

$StarTtimE = date("U");
$TODAY = date("Y-m-d");
$NOW_TIME = date("Y-m-d H:i:s");
$ip = getenv("REMOTE_ADDR");

if (!isset($begin_date)) {$begin_date = $TODAY;}
if (!isset($end_date)) {$end_date = $TODAY;}

	$stmt="SELECT count(*) from vicidial_users where user='$PHP_AUTH_USER' and pass='$PHP_AUTH_PW' and user_level > 7 and view_reports='1';";
	if ($non_latin > 0) { $rslt=mysql_query("SET NAMES 'UTF8'");}
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
    echo "Invalid Username/Password: |$PHP_AUTH_USER|$PHP_AUTH_PW|\n";
    exit;
	}
  else
	{

	if($auth>0)
		{
			$stmt="SELECT full_name,change_agent_campaign,modify_timeclock_log from vicidial_users where user='$PHP_AUTH_USER' and pass='$PHP_AUTH_PW'";
			$rslt=mysql_query($stmt, $link);
			$row=mysql_fetch_row($rslt);
			$LOGfullname =				$row[0];
			$change_agent_campaign =	$row[1];
			$modify_timeclock_log =		$row[2];
		if ($webroot_writable > 0)
			{
			fwrite ($fp, "VICIDIAL|GOOD|$date|$PHP_AUTH_USER|$PHP_AUTH_PW|$ip|$browser|$LOGfullname|\n");
			fclose($fp);
			}
		}
	else
		{
		if ($webroot_writable > 0)
			{
			fwrite ($fp, "VICIDIAL|FAIL|$date|$PHP_AUTH_USER|$PHP_AUTH_PW|$ip|$browser|\n");
			fclose($fp);
			}
		}
	}

$stmt="select * from vicidial_user_groups order by user_group desc;";
$rslt=mysql_query($stmt, $link);
if ($DB) {echo "$stmt\n";}
$groups_to_print = mysql_num_rows($rslt);
$i=0;
while ($i < $groups_to_print)
	{
	$row=mysql_fetch_row($rslt);
	$groups[$i] =		$row[0];
	$group_names[$i] =	$row[1];
	$i++;
	}



?>
<html>
<head>
<title>VICIDIAL ADMIN: User Group Bulk Change</title>
<?
echo "<META HTTP-EQUIV=\"Content-Type\" CONTENT=\"text/html; charset=utf-8\">\n";
?>
</head>
<BODY BGCOLOR=white marginheight=0 marginwidth=0 leftmargin=0 topmargin=0>
<CENTER>
<TABLE WIDTH=620 BGCOLOR=#D9E6FE cellpadding=2 cellspacing=0><TR BGCOLOR=#015B91><TD ALIGN=LEFT><? echo "<a href=\"./admin.php?ADD=100000\">" ?><FONT FACE="ARIAL,HELVETICA" COLOR=WHITE SIZE=2><B> &nbsp; VICIDIAL ADMIN</a>: User Group Bulk Change</TD><TD ALIGN=RIGHT><FONT FACE="ARIAL,HELVETICA" COLOR=WHITE SIZE=2><B><? echo date("l F j, Y G:i:s A") ?> &nbsp; </TD></TR>




<? 

echo "<TR BGCOLOR=\"#F0F5FE\"><TD ALIGN=LEFT COLSPAN=2><FONT FACE=\"ARIAL,HELVETICA\" COLOR=BLACK SIZE=3><B> &nbsp; \n";

##### GROUP CHANGE FOR ALL USERS IN A USER GROUP #####
if ($stage == "one_user_group_change")
	{
	$stmt="UPDATE vicidial_users set user_group='" . mysql_real_escape_string($group) . "' where user_group='" . mysql_real_escape_string($old_group) . "';";
	$rslt=mysql_query($stmt, $link);

	echo "All User Group $old_group Users changed to the $group User Group<BR>\n";
	
	exit;
	}

##### GROUP CHANGE FOR ALL USERS IN THE SYSTEM EXCEPT FOR LEVEL > 6 AND ADMIN GROUP #####
if ($stage == "all_user_group_change")
	{
	$stmt="UPDATE vicidial_users set user_group='" . mysql_real_escape_string($group) . "' where user_group!='ADMIN' and user_group < 7;";
	$rslt=mysql_query($stmt, $link);

	echo "All non-Admin Users changed to the $group User Group<BR>\n";
	
	exit;
	}

### one user_group change
echo "<form action=$PHP_SELF method=POST>\n";
echo "<input type=hidden name=DB value=\"$DB\">\n";
echo "<input type=hidden name=stage value=\"one_user_group_change\">\n";
echo "Change Users in this group: <SELECT SIZE=1 NAME=old_group>\n";
$o=0;
while ($groups_to_print > $o)
	{
	echo "<option value=\"$groups[$o]\">$groups[$o] - $group_names[$o]</option>\n";
	$o++;
	}
echo "</SELECT>\n";
echo "<BR> &nbsp; to this group: <SELECT SIZE=1 NAME=group>\n";
$o=0;
while ($groups_to_print > $o)
	{
	echo "<option value=\"$groups[$o]\">$groups[$o] - $group_names[$o]</option>\n";
	$o++;
	}
echo "</SELECT>\n";
echo "<BR><CENTER><input type=submit name=submit value=SUBMIT></CENTER><BR></form>\n";

echo "\n<BR><BR><BR>";



### all user_group change
echo "<form action=$PHP_SELF method=POST>\n";
echo "<input type=hidden name=DB value=\"$DB\">\n";
echo "<input type=hidden name=stage value=\"all_user_group_change\">\n";
echo "Change ALL non-Admin Users to this group: <BR><SELECT SIZE=1 NAME=group>\n";
$o=0;
while ($groups_to_print > $o)
	{
	echo "<option value=\"$groups[$o]\">$groups[$o] - $group_names[$o]</option>\n";
	$o++;
	}
echo "</SELECT>\n";
echo "<BR><CENTER><input type=submit name=submit value=SUBMIT></CENTER><BR></form>\n";

echo "\n<BR>";



$ENDtime = date("U");

$RUNtime = ($ENDtime - $StarTtimE);

echo "\n\n\n<br><br><br>\n\n";


echo "<font size=0>\n\n\n<br><br><br>\nscript runtime: $RUNtime seconds</font>";

echo "|$stage|$group|";

?>


</TD></TR><TABLE>
</body>
</html>

<?
	
exit; 



?>

