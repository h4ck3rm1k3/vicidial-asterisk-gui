<?
# new_listloader_superL.php
# 
# Copyright (C) 2006  Matt Florell,Joe Johnson <vicidial@gmail.com>    LICENSE: GPLv2
#
# AST GUI lead loader from formatted file
# 
# CHANGES
# 50602-1640 - First version created by Joe Johnson
# 51128-1108 - Removed PHP global vars requirement
# 60113-1603 - Fixed a few bugs in Excel import
# 60421-1624 - check GET/POST vars lines with isset to not trigger PHP NOTICES
# 60616-1240 - added listID override
# 60616-1604 - added gmt lookup for each lead
# 60619-1651 - Added variable filtering to eliminate SQL injection attack threat
# 60822-1121 - fixed for nonwritable directories
# 60906-1100 - added filter of non-digits in alt_phone field
#
# make sure vicidial_list exists and that your file follows the formatting correctly. This page does not dedupe or do any other lead filtering actions yet at this time.

$version = '2.0.1';
$build = '60906-1100';


require("dbconnect.php");

### links used for testing
#$link=mysql_connect("10.10.10.15", "cron", "1234");
#mysql_select_db("asterisk");
#$WeBServeRRooT = '/home/www/htdocs';

$PHP_AUTH_USER=$_SERVER['PHP_AUTH_USER'];
$PHP_AUTH_PW=$_SERVER['PHP_AUTH_PW'];
$PHP_SELF=$_SERVER['PHP_SELF'];
$leadfile=$_FILES["leadfile"];
	$LF_orig = $_FILES['leadfile']['name'];
	$LF_path = $_FILES['leadfile']['tmp_name'];
if (isset($_GET["submit_file"]))				{$submit_file=$_GET["submit_file"];}
	elseif (isset($_POST["submit_file"]))		{$submit_file=$_POST["submit_file"];}
if (isset($_GET["submit"]))				{$submit=$_GET["submit"];}
	elseif (isset($_POST["submit"]))		{$submit=$_POST["submit"];}
if (isset($_GET["ENVIAR"]))				{$ENVIAR=$_GET["ENVIAR"];}
	elseif (isset($_POST["ENVIAR"]))		{$ENVIAR=$_POST["ENVIAR"];}
if (isset($_GET["leadfile_name"]))				{$leadfile_name=$_GET["leadfile_name"];}
	elseif (isset($_POST["leadfile_name"]))		{$leadfile_name=$_POST["leadfile_name"];}
if (isset($_GET["file_layout"]))				{$file_layout=$_GET["file_layout"];}
	elseif (isset($_POST["file_layout"]))		{$file_layout=$_POST["file_layout"];}
if (isset($_GET["OK_to_process"]))				{$OK_to_process=$_GET["OK_to_process"];}
	elseif (isset($_POST["OK_to_process"]))		{$OK_to_process=$_POST["OK_to_process"];}
if (isset($_GET["vendor_lead_code_field"]))				{$vendor_lead_code_field=$_GET["vendor_lead_code_field"];}
	elseif (isset($_POST["vendor_lead_code_field"]))		{$vendor_lead_code_field=$_POST["vendor_lead_code_field"];}
if (isset($_GET["source_id_field"]))				{$source_id_field=$_GET["source_id_field"];}
	elseif (isset($_POST["source_id_field"]))		{$source_id_field=$_POST["source_id_field"];}
if (isset($_GET["list_id_field"]))				{$list_id_field=$_GET["list_id_field"];}
	elseif (isset($_POST["list_id_field"]))		{$list_id_field=$_POST["list_id_field"];}
if (isset($_GET["phone_code_field"]))				{$phone_code_field=$_GET["phone_code_field"];}
	elseif (isset($_POST["phone_code_field"]))		{$phone_code_field=$_POST["phone_code_field"];}
if (isset($_GET["phone_number_field"]))				{$phone_number_field=$_GET["phone_number_field"];}
	elseif (isset($_POST["phone_number_field"]))		{$phone_number_field=$_POST["phone_number_field"];}
if (isset($_GET["title_field"]))				{$title_field=$_GET["title_field"];}
	elseif (isset($_POST["title_field"]))		{$title_field=$_POST["title_field"];}
if (isset($_GET["first_name_field"]))				{$first_name_field=$_GET["first_name_field"];}
	elseif (isset($_POST["first_name_field"]))		{$first_name_field=$_POST["first_name_field"];}
if (isset($_GET["middle_initial_field"]))				{$middle_initial_field=$_GET["middle_initial_field"];}
	elseif (isset($_POST["middle_initial_field"]))		{$middle_initial_field=$_POST["middle_initial_field"];}
if (isset($_GET["last_name_field"]))				{$last_name_field=$_GET["last_name_field"];}
	elseif (isset($_POST["last_name_field"]))		{$last_name_field=$_POST["last_name_field"];}
if (isset($_GET["address1_field"]))				{$address1_field=$_GET["address1_field"];}
	elseif (isset($_POST["address1_field"]))		{$address1_field=$_POST["address1_field"];}
if (isset($_GET["address2_field"]))				{$address2_field=$_GET["address2_field"];}
	elseif (isset($_POST["address2_field"]))		{$address2_field=$_POST["address2_field"];}
if (isset($_GET["address3_field"]))				{$address3_field=$_GET["address3_field"];}
	elseif (isset($_POST["address3_field"]))		{$address3_field=$_POST["address3_field"];}
if (isset($_GET["city_field"]))				{$city_field=$_GET["city_field"];}
	elseif (isset($_POST["city_field"]))		{$city_field=$_POST["city_field"];}
if (isset($_GET["state_field"]))				{$state_field=$_GET["state_field"];}
	elseif (isset($_POST["state_field"]))		{$state_field=$_POST["state_field"];}
if (isset($_GET["province_field"]))				{$province_field=$_GET["province_field"];}
	elseif (isset($_POST["province_field"]))		{$province_field=$_POST["province_field"];}
if (isset($_GET["postal_code_field"]))				{$postal_code_field=$_GET["postal_code_field"];}
	elseif (isset($_POST["postal_code_field"]))		{$postal_code_field=$_POST["postal_code_field"];}
if (isset($_GET["country_code_field"]))				{$country_code_field=$_GET["country_code_field"];}
	elseif (isset($_POST["country_code_field"]))		{$country_code_field=$_POST["country_code_field"];}
if (isset($_GET["gender_field"]))				{$gender_field=$_GET["gender_field"];}
	elseif (isset($_POST["gender_field"]))		{$gender_field=$_POST["gender_field"];}
if (isset($_GET["date_of_birth_field"]))				{$date_of_birth_field=$_GET["date_of_birth_field"];}
	elseif (isset($_POST["date_of_birth_field"]))		{$date_of_birth_field=$_POST["date_of_birth_field"];}
if (isset($_GET["alt_phone_field"]))				{$alt_phone_field=$_GET["alt_phone_field"];}
	elseif (isset($_POST["alt_phone_field"]))		{$alt_phone_field=$_POST["alt_phone_field"];}
if (isset($_GET["email_field"]))				{$email_field=$_GET["email_field"];}
	elseif (isset($_POST["email_field"]))		{$email_field=$_POST["email_field"];}
if (isset($_GET["security_phrase_field"]))				{$security_phrase_field=$_GET["security_phrase_field"];}
	elseif (isset($_POST["security_phrase_field"]))		{$security_phrase_field=$_POST["security_phrase_field"];}
if (isset($_GET["comments_field"]))				{$comments_field=$_GET["comments_field"];}
	elseif (isset($_POST["comments_field"]))		{$comments_field=$_POST["comments_field"];}
if (isset($_GET["list_id_override"]))				{$list_id_override=$_GET["list_id_override"];}
	elseif (isset($_POST["list_id_override"]))		{$list_id_override=$_POST["list_id_override"];}
	$list_id_override = (preg_replace("/\D/","",$list_id_override));
if (isset($_GET["lead_file"]))					{$lead_file=$_GET["lead_file"];}
	elseif (isset($_POST["lead_file"]))			{$lead_file=$_POST["lead_file"];}

# $country_field=$_GET["country_field"];					if (!$country_field) {$country_field=$_POST["country_field"];}


$PHP_AUTH_USER = ereg_replace("[^0-9a-zA-Z]","",$PHP_AUTH_USER);
$PHP_AUTH_PW = ereg_replace("[^0-9a-zA-Z]","",$PHP_AUTH_PW);
$list_id_override = ereg_replace("[^0-9]","",$list_id_override);


$STARTtime = date("U");
$TODAY = date("Y-m-d");
$NOW_TIME = date("Y-m-d H:i:s");
$FILE_datetime = $STARTtime;

$stmt="SELECT count(*) from vicidial_users where user='$PHP_AUTH_USER' and pass='$PHP_AUTH_PW' and user_level > 7;";
if ($DB) {echo "|$stmt|\n";}
$rslt=mysql_query($stmt, $link);
$row=mysql_fetch_row($rslt);
$auth=$row[0];

if ($WeBRooTWritablE > 0) {$fp = fopen ("./project_auth_entries.txt", "a");}
$date = date("r");
$ip = getenv("REMOTE_ADDR");
$browser = getenv("HTTP_USER_AGENT");

  if( (strlen($PHP_AUTH_USER)<2) or (strlen($PHP_AUTH_PW)<2) or (!$auth))
	{
    Header("WWW-Authenticate: Basic realm=\"VICIDIAL-LEAD-LOADER\"");
    Header("HTTP/1.0 401 Unauthorized");
    echo "Nombre y contraseña inválidos del usuario: |$PHP_AUTH_USER|$PHP_AUTH_PW|\n";
    exit;
	}
  else
	{
	header ("Content-type: text/html; charset=utf-8");
	if($auth>0)
		{
		$office_no=strtoupper($PHP_AUTH_USER);
		$password=strtoupper($PHP_AUTH_PW);
			$stmt="SELECT load_leads from vicidial_users where user='$PHP_AUTH_USER' and pass='$PHP_AUTH_PW'";
			$rslt=mysql_query($stmt, $link);
			$row=mysql_fetch_row($rslt);
			$LOGload_leads				=$row[0];

		if ($LOGload_leads < 1)
			{
			echo "You do not have permissions to load leads\n";
			exit;
			}
		if ($WeBRooTWritablE > 0) 
			{
			fwrite ($fp, "LIST_LOAD|GOOD|$date|$PHP_AUTH_USER|$PHP_AUTH_PW|$ip|$browser|$LOGfullname|\n");
			fclose($fp);
			}
		}
	else
		{
		if ($WeBRooTWritablE > 0) 
			{
			fwrite ($fp, "LIST_LOAD|FAIL|$date|$PHP_AUTH_USER|$PHP_AUTH_PW|$ip|$browser|\n");
			fclose($fp);
			}
		}
	}


$script_name = getenv("SCRIPT_NAME");
$server_name = getenv("SERVER_NAME");
$server_port = getenv("SERVER_PORT");
if (eregi("443",$server_port)) {$HTTPprotocol = 'https://';}
  else {$HTTPprotocol = 'http://';}
$admDIR = "$HTTPprotocol$server_name$script_name";
$admDIR = eregi_replace('new_listloader_superL.php','',$admDIR);
$admSCR = 'admin.php';
$NWB = " &nbsp; <a href=\"javascript:openNewWindow('$admDIR$admSCR?ADD=99999";
$NWE = "')\"><IMG SRC=\"help.gif\" WIDTH=20 HEIGHT=20 Border=0 ALT=\"AYUDA\" ALIGN=TOP></A>";

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
	$stmt="SELECT local_gmt FROM servers where server_ip = '$server_ip';";
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

#if ($DB) {print "SEED TIME  $secX      :   $year-$mon-$mday $hour:$min:$sec  LOCAL GMT OFFSET NOW: $LOCAL_GMT_OFF\n";}


echo "<html>\n";
echo "<head>\n";
echo "<!-- VERSIÓN: $version     CONSTRUCCION: $build -->\n";
echo "<!-- SEED TIME  $secX:   $year-$mon-$mday $hour:$min:$sec  LOCAL DESPLAZAMIENTO GMT AHORA: $LOCAL_GMT_OFF  DST: $isdst -->\n";

function macfontfix($fontsize) {

  $browser = getenv("HTTP_USER_AGENT");
  $pctype = explode("(", $browser);
  if (ereg("Mac",$pctype[1])) {
   /* Browser is a Mac.  If not Netscape 6, raise fonts */

    $blownbrowser = explode('/', $browser);
    $ver = explode(' ', $blownbrowser[1]);
    $ver = $ver[0];
    if ($ver >= 5.0) return $fontsize; else return ($fontsize+2);

  } else return $fontsize;	/* Browser is not a Mac - don't touch fonts */
}

echo "<style type=\"text/css\">\n
<!--\n
.title {  font-family: Arial, Helvetica, sans-serif; font-size: ".macfontfix(18)."pt}\n
.standard {  font-family: Arial, Helvetica, sans-serif; font-size: ".macfontfix(10)."pt}\n
.small_standard {  font-family: Arial, Helvetica, sans-serif; font-size: ".macfontfix(8)."pt}\n
.tiny_standard {  font-family: Arial, Helvetica, sans-serif; font-size: ".macfontfix(6)."pt}\n
.standard_bold {  font-family: Arial, Helvetica, sans-serif; font-size: ".macfontfix(10)."pt; font-weight: bold}\n
.standard_header {  font-family: Arial, Helvetica, sans-serif; font-size: ".macfontfix(14)."pt; font-weight: bold}\n
.standard_bold_highlight {  font-family: Arial, Helvetica, sans-serif; font-size: ".macfontfix(10)."pt; font-weight: bold; color: white; BACKGROUND-COLOR: black}\n
.standard_bold_blue_highlight {  font-family: Arial, Helvetica, sans-serif; font-size: 10pt; font-weight: bold; BACKGROUND-COLOR: blue}\n
A.employee_standard {  font-family: garamond, sans-serif; font-size: ".macfontfix(10)."pt; font-style: normal; font-variant: normal; font-weight: bold; text-decoration: none}\n
.employee_standard {  font-family: garamond, sans-serif; font-size: ".macfontfix(10)."pt; font-weight: bold}\n
.employee_title {  font-family: Garamond, sans-serif; font-size: ".macfontfix(14)."pt; font-weight: bold}\n
\\\\-->\n
</style>\n";

?>


<script language="JavaScript1.2">
function openNewWindow(url) {
  window.open (url,"",'width=500,height=300,scrollbars=yes,menubar=yes,address=yes');
}
function ShowProgress(good, bad, total) {
	parent.lead_count.document.open();
	parent.lead_count.document.write('<html><body><table border=0 width=200 cellpadding=10 cellspacing=0 align=center valign=top><tr bgcolor="#000000"><th colspan=2><font face="arial, helvetica" size=3 color=white>Estado actual del archivo:</font></th></tr><tr bgcolor="#009900"><td align=right><font face="arial, helvetica" size=2 color=white><B>Good:</B></font></td><td align=left><font face="arial, helvetica" size=2 color=white><B>'+good+'</B></font></td></tr><tr bgcolor="#990000"><td align=right><font face="arial, helvetica" size=2 color=white><B>Bad:</B></font></td><td align=left><font face="arial, helvetica" size=2 color=white><B>'+bad+'</B></font></td></tr><tr bgcolor="#000099"><td align=right><font face="arial, helvetica" size=2 color=white><B>Total:</B></font></td><td align=left><font face="arial, helvetica" size=2 color=white><B>'+total+'</B></font></td></tr></table><body></html>');
	parent.lead_count.document.close();
}
function ParseFileName() {
	if (!document.forms[0].OK_to_process) {	
		var endstr=document.forms[0].leadfile.value.lastIndexOf('\\');
		if (endstr>-1) {
			endstr++;
			var filename=document.forms[0].leadfile.value.substring(endstr);
			document.forms[0].leadfile_name.value=filename;
		}
	}
}
</script>
<title>VICIDIAL ADMIN: Super Lead Loader</title>
</head>
<body>
<form action=<?=$PHP_SELF ?> method=post onSubmit="ParseFileName()" enctype="multipart/form-data">
<input type=hidden name='leadfile_name' value="<?=$leadfile_name ?>">
<? if ($file_layout!="custom") { ?>
<table align=center width="500" border=0 cellpadding=5 cellspacing=0 bgcolor=#D9E6FE>
  <tr>
	<td align=right width="35%"><B><font face="arial, helvetica" size=2>Cargar Leads de este archivo:</font></B></td>
	<td align=left width="65%"><input type=file name="leadfile" value="<?=$leadfile ?>"> <? echo "$NWB#vicidial_list_loader$NWE"; ?></td>
  </tr>
  <tr>
	<td align=right width="25%"><font face="arial, helvetica" size=2>ID De la Lista Override: </font></td>
	<td align=left width="75%"><font face="arial, helvetica" size=1><input type=text value="<?=$list_id_override ?>" name='list_id_override' size=10 maxlength=8> (Solamente números or leave blank for values in the file)</td>
  </tr>
  <tr>
	<td align=right><B><font face="arial, helvetica" size=2>Disposición de archivo a utilizar:</font></B></td>
	<td align=left><font face="arial, helvetica" size=2><input type=radio name="file_layout" value="standard" checked>VICIDIAL Estándar&nbsp;&nbsp;&nbsp;&nbsp;<input type=radio name="file_layout" value="custom">Disposición de encargo</td>
  </tr>
  <tr>
	<td align=center colspan=2><input type=submit value="ENVIAR" name='submit_file'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type=button onClick="javascript:document.location='new_listloader_superL.php'" value="RECARGAR" name='reload_page'></td>
  </tr>
  <tr><td colspan=2><font size=1><a href="listloaderMAIN.php" target="_parent">CHASQUE AQUÍ PARA IR AL CARGADOR DEL PLOMO DEL BASIC </a> &nbsp; &nbsp; &nbsp; &nbsp; <a href="admin.php" target="_parent">DE NUEVO AL ADMIN</a></font></td></tr>
  <tr><td colspan=2><font size=1>CARGADOR ESTUPENDO DE LA LISTA- &nbsp; &nbsp; VERSIÓN: <?=$version ?> &nbsp; &nbsp; CONSTRUCCION: <?=$build ?></td></tr>
</table>
<? } ?>

<?

	if ($OK_to_process) {
		print "<script language='JavaScript1.2'>document.forms[0].leadfile.disabled=true;document.forms[0].list_id_override.disabled=true; document.forms[0].submit_file.disabled=true; document.forms[0].reload_page.disabled=true;</script>";
		flush();
		$total=0; $good=0; $bad=0;

		if (!eregi(".csv", $leadfile_name) && !eregi(".xls", $leadfile_name)) {
			# copy($leadfile, "./vicidial_temp_file.txt");
			$file=fopen("$lead_file", "r");
			if ($WeBRooTWritablE > 0)
				{
				$stmt_file=fopen("listloader_stmts.txt", "w");
				}
			$buffer=fgets($file, 4096);
			$tab_count=substr_count($buffer, "\t");
			$pipe_count=substr_count($buffer, "|");

			if ($tab_count>$pipe_count) {$delimiter="\t";  $delim_name="tab";} else {$delimiter="|";  $delim_name="pipe";}
			$field_check=explode($delimiter, $buffer);

			if (count($field_check)>=5) {
				flush();
				$file=fopen("$lead_file", "r");
				print "<center><font face='arial, helvetica' size=3 color='#009900'><B>Procesando$delim_name-delimited file...\n";

			if (strlen($list_id_override)>0) 
				{
				print "<BR><BR>ID DE LA LISTA OVERRIDE FOR THIS FILE: $list_id_override<BR><BR>";
				}

				while (!feof($file)) {
					$record++;
					$buffer=rtrim(fgets($file, 4096));
					$buffer=stripslashes($buffer);

					if (strlen($buffer)>0) {
						$row=explode($delimiter, eregi_replace("[\'\"]", "", $buffer));

						$pulldate=date("Y-m-d H:i:s");
						$entry_date =			"$pulldate";
						$modify_date =			"";
						$status =				"NEW";
						$user ="";
						$vendor_lead_code =		$row[$vendor_lead_code_field];
						$source_code =			$row[$source_id_field];
						$source_id=$source_code;
						$list_id =				$row[$list_id_field];
						$gmt_offset =			'0';
						$called_since_last_reset='N';
						$phone_code =			eregi_replace("[^0-9]", "", $row[$phone_code_field]);
						$phone_number =			eregi_replace("[^0-9]", "", $row[$phone_number_field]);
							$USarea = 			substr($phone_number, 0, 3);
						$title =				$row[$title_field];
						$first_name =			$row[$first_name_field];
						$middle_initial =		$row[$middle_initial_field];
						$last_name =			$row[$last_name_field];
						$address1 =				$row[$address1_field];
						$address2 =				$row[$address2_field];
						$address3 =				$row[$address3_field];
						$city =$row[$city_field];
						$state =				$row[$state_field];
						$province =				$row[$province_field];
						$postal_code =			$row[$postal_code_field];
						$country_code =				$row[$country_code_field];
						$gender =				$row[$gender_field];
						$date_of_birth =		$row[$date_of_birth_field];
						$alt_phone =			eregi_replace("[^0-9]", "", $row[$alt_phone_field]);
						$email =				$row[$email_field];
						$security_phrase =		$row[$security_phrase_field];
						$comments =				trim($row[$comments_field]);

						if (strlen($phone_number)>6) {


							if (strlen($list_id_override)>0) 
								{
							#	print "<BR><BR>ID DE LA LISTA OVERRIDE FOR THIS FILE: $list_id_override<BR><BR>";
								$list_id = $list_id_override;
								}

							$gmt_offset = lookup_gmt($phone_code,$USarea,$state,$LOCAL_GMT_OFF_STD,$Shour,$Smin,$Ssec,$Smon,$Smday,$Syear);

							if ($multi_insert_counter > 8) {
								### insert good deal into pending_transactions table ###
								$stmtZ = "INSERT INTO vicidial_list values$multistmt('','$entry_date','$modify_date','$status','$user','$vendor_lead_code','$source_id','$list_id','$gmt_offset','$called_since_last_reset','$phone_code','$phone_number','$title','$first_name','$middle_initial','$last_name','$address1','$address2','$address3','$city','$state','$province','$postal_code','$country_code','$gender','$date_of_birth','$alt_phone','$email','$security_phrase','$comments',0);";
								$rslt=mysql_query($stmtZ, $link);
								if ($WeBRooTWritablE > 0) 
									{fwrite($stmt_file, $stmtZ."\r\n");}
								$multistmt='';
								$multi_insert_counter=0;

							} else {
								$multistmt .= "('','$entry_date','$modify_date','$status','$user','$vendor_lead_code','$source_id','$list_id','$gmt_offset','$called_since_last_reset','$phone_code','$phone_number','$title','$first_name','$middle_initial','$last_name','$address1','$address2','$address3','$city','$state','$province','$postal_code','$country_code','$gender','$date_of_birth','$alt_phone','$email','$security_phrase','$comments',0),";
								$multi_insert_counter++;
							}

							$good++;
						} else {
							if ($bad < 10) {print "<BR></b><font size=1 color=red>record $total BAD- PHONE: $phone_number ROW: |$row[0]|</font><b>\n";}
							$bad++;
						}
						$total++;
						if ($total%100==0) {
							print "<script language='JavaScript1.2'>ShowProgress($good, $bad, $total)</script>";
							usleep(1000);
							flush();
						}
					}
				}
				if ($multi_insert_counter!=0) {
					$stmtZ = "INSERT INTO vicidial_list values".substr($multistmt, 0, -1).";";
					mysql_query($stmtZ, $link);
					if ($WeBRooTWritablE > 0) 
						{fwrite($stmt_file, $stmtZ."\r\n");}
				}

				print "<BR><BR>Done</B> GOOD: $good &nbsp; &nbsp; &nbsp; BAD: $bad &nbsp; &nbsp; &nbsp; TOTAL: $total</font></center>";

			} else {
				print "<center><font face='arial, helvetica' size=3 color='#990000'><B>ERROR: El archivo no tiene el número requerido de los campos para procesarlo.</B></font></center>";
			}
		} else if (!eregi(".csv", $leadfile_name)) {
			# copy($leadfile, "./vicidial_temp_file.xls");
			$file=fopen("$lead_file", "r");

			print "<center><font face='arial, helvetica' size=3 color='#009900'><B>ProcesandoExcel file... \n";
			if (strlen($list_id_override)>0) 
			{
			print "<BR><BR>ID DE LA LISTA OVERRIDE FOR THIS FILE: $list_id_override<BR><BR>\n";
			}
		# print "|$WeBServeRRooT/vicidial/listloader_super.pl $vendor_lead_code_field,$source_id_field,$list_id_field,$phone_code_field,$phone_number_field,$title_field,$first_name_field,$middle_initial_field,$last_name_field,$address1_field,$address2_field,$address3_field,$city_field,$state_field,$province_field,$postal_code_field,$country_code_field,$gender_field,$date_of_birth_field,$alt_phone_field,$email_field,$security_phrase_field,$comments_field, --forcelistid=$list_id_override --lead_file=$lead_file|";
			passthru("$WeBServeRRooT/vicidial/listloader_super.pl $vendor_lead_code_field,$source_id_field,$list_id_field,$phone_code_field,$phone_number_field,$title_field,$first_name_field,$middle_initial_field,$last_name_field,$address1_field,$address2_field,$address3_field,$city_field,$state_field,$province_field,$postal_code_field,$country_code_field,$gender_field,$date_of_birth_field,$alt_phone_field,$email_field,$security_phrase_field,$comments_field, --forcelistid=$list_id_override --lead-file=$lead_file");
		} else {
			# copy($leadfile, "./vicidial_temp_file.csv");
			$file=fopen("$lead_file", "r");

			if ($WeBRooTWritablE > 0)
				{$stmt_file=fopen("$WeBServeRRooT/vicidial/listloader_stmts.txt", "w");}
			
			print "<center><font face='arial, helvetica' size=3 color='#009900'><B>ProcesandoCSV file... \n";
			if (strlen($list_id_override)>0) 
				{
				print "<BR><BR>ID DE LA LISTA OVERRIDE FOR THIS FILE: $list_id_override<BR><BR>";
				}

			while($row=fgetcsv($file, 1000, ",")) {

				$pulldate=date("Y-m-d H:i:s");
				$entry_date =			"$pulldate";
				$modify_date =			"";
				$status =				"NEW";
				$user ="";
				$vendor_lead_code =		$row[$vendor_lead_code_field];
				$source_code =			$row[$source_id_field];
				$source_id=$source_code;
				$list_id =				$row[$list_id_field];
				$gmt_offset =			'0';
				$called_since_last_reset='N';
				$phone_code =			eregi_replace("[^0-9]", "", $row[$phone_code_field]);
				$phone_number =			eregi_replace("[^0-9]", "", $row[$phone_number_field]);
					$USarea = 			substr($phone_number, 0, 3);
				$title =				$row[$title_field];
				$first_name =			$row[$first_name_field];
				$middle_initial =		$row[$middle_initial_field];
				$last_name =			$row[$last_name_field];
				$address1 =				$row[$address1_field];
				$address2 =				$row[$address2_field];
				$address3 =				$row[$address3_field];
				$city =$row[$city_field];
				$state =				$row[$state_field];
				$province =				$row[$province_field];
				$postal_code =			$row[$postal_code_field];
				$country_code =				$row[$country_code_field];
				$gender =				$row[$gender_field];
				$date_of_birth =		$row[$date_of_birth_field];
				$alt_phone =			eregi_replace("[^0-9]", "", $row[$alt_phone_field]);
				$email =				$row[$email_field];
				$security_phrase =		$row[$security_phrase_field];
				$comments =				trim($row[$comments_field]);

				if (strlen($phone_number)>6) {

					if (strlen($list_id_override)>0) 
						{
					#	print "<BR><BR>ID DE LA LISTA OVERRIDE FOR THIS FILE: $list_id_override<BR><BR>";
						$list_id = $list_id_override;
						}

					$gmt_offset = lookup_gmt($phone_code,$USarea,$state,$LOCAL_GMT_OFF_STD,$Shour,$Smin,$Ssec,$Smon,$Smday,$Syear);


					if ($multi_insert_counter > 8) {
						### insert good deal into pending_transactions table ###
						$stmtZ = "INSERT INTO vicidial_list values$multistmt('','$entry_date','$modify_date','$status','$user','$vendor_lead_code','$source_id','$list_id','$gmt_offset','$called_since_last_reset','$phone_code','$phone_number','$title','$first_name','$middle_initial','$last_name','$address1','$address2','$address3','$city','$state','$province','$postal_code','$country_code','$gender','$date_of_birth','$alt_phone','$email','$security_phrase','$comments',0);";
						$rslt=mysql_query($stmtZ, $link);
						if ($WeBRooTWritablE > 0) 
							{fwrite($stmt_file, $stmtZ."\r\n");}
						$multistmt='';
						$multi_insert_counter=0;

					} else {
						$multistmt .= "('','$entry_date','$modify_date','$status','$user','$vendor_lead_code','$source_id','$list_id','$gmt_offset','$called_since_last_reset','$phone_code','$phone_number','$title','$first_name','$middle_initial','$last_name','$address1','$address2','$address3','$city','$state','$province','$postal_code','$country_code','$gender','$date_of_birth','$alt_phone','$email','$security_phrase','$comments',0),";
						$multi_insert_counter++;
					}

					$good++;
				} else {
					if ($bad < 10) {print "<BR></b><font size=1 color=red>record $total BAD- PHONE: $phone_number ROW: |$row[0]|</font><b>\n";}
					$bad++;
				}
				$total++;
				if ($total%100==0) {
					print "<script language='JavaScript1.2'>ShowProgress($good, $bad, $total)</script>";
					usleep(1000);
					flush();
				}
			}
			if ($multi_insert_counter!=0) {
				$stmtZ = "INSERT INTO vicidial_list values".substr($multistmt, 0, -1).";";
				mysql_query($stmtZ, $link);
				if ($WeBRooTWritablE > 0) 
					{fwrite($stmt_file, $stmtZ."\r\n");}
			}
			print "<BR><BR>Done</B> GOOD: $good &nbsp; &nbsp; &nbsp; BAD: $bad &nbsp; &nbsp; &nbsp; TOTAL: $total</font></center>";
		}
		print "<script language='JavaScript1.2'>document.forms[0].leadfile.disabled=false; document.forms[0].submit_file.disabled=false; document.forms[0].reload_page.disabled=false;</script>";
	} 

if ($leadfile && filesize($LF_path)<=8388608) {
		$total=0; $good=0; $bad=0;
		if ($file_layout=="standard") {

	print "<script language='JavaScript1.2'>document.forms[0].leadfile.disabled=true; document.forms[0].submit_file.disabled=true; document.forms[0].reload_page.disabled=true;</script>";
	flush();

	if (!eregi(".csv", $leadfile_name) && !eregi(".xls", $leadfile_name)) {

		if ($WeBRooTWritablE > 0)
			{
			copy($LF_path, "$WeBServeRRooT/vicidial/vicidial_temp_file.txt");
			$lead_file = "./vicidial_temp_file.txt";
			}
		else
			{
			copy($LF_path, "/tmp/vicidial_temp_file.txt");
			$lead_file = "/tmp/vicidial_temp_file.txt";
			}
		$file=fopen("$lead_file", "r");
		if ($WeBRooTWritablE > 0)
			{$stmt_file=fopen("$WeBServeRRooT/vicidial/listloader_stmts.txt", "w");}

		$buffer=fgets($file, 4096);
		$tab_count=substr_count($buffer, "\t");
		$pipe_count=substr_count($buffer, "|");

		if ($tab_count>$pipe_count) {$delimiter="\t";  $delim_name="tab";} else {$delimiter="|";  $delim_name="pipe";}
		$field_check=explode($delimiter, $buffer);

		if (count($field_check)>=5) {
			flush();
			$file=fopen("$lead_file", "r");
			$total=0; $good=0; $bad=0;
			print "<center><font face='arial, helvetica' size=3 color='#009900'><B>Procesando$delim_name-delimited file... ($tab_count|$pipe_count)\n";
			if (strlen($list_id_override)>0) 
			{
			print "<BR><BR>ID DE LA LISTA OVERRIDE FOR THIS FILE: $list_id_override<BR><BR>";
			}
		while (!feof($file)) {
				$record++;
				$buffer=rtrim(fgets($file, 4096));
				$buffer=stripslashes($buffer);

				if (strlen($buffer)>0) {
					$row=explode($delimiter, eregi_replace("[\'\"]", "", $buffer));

					$pulldate=date("Y-m-d H:i:s");
					$entry_date =			"$pulldate";
					$modify_date =			"";
					$status =				"NEW";
					$user ="";
					$vendor_lead_code =		$row[0];
					$source_code =			$row[1];
					$source_id=$source_code;
					$list_id =				$row[2];
					$gmt_offset =			'0';
					$called_since_last_reset='N';
					$phone_code =			eregi_replace("[^0-9]", "", $row[3]);
					$phone_number =			eregi_replace("[^0-9]", "", $row[4]);
						$USarea = 			substr($phone_number, 0, 3);
					$title =				$row[5];
					$first_name =			$row[6];
					$middle_initial =		$row[7];
					$last_name =			$row[8];
					$address1 =				$row[9];
					$address2 =				$row[10];
					$address3 =				$row[11];
					$city =$row[12];
					$state =				$row[13];
					$province =				$row[14];
					$postal_code =			$row[15];
					$country_code =				$row[16];
					$gender =				$row[17];
					$date_of_birth =		$row[18];
					$alt_phone =			eregi_replace("[^0-9]", "", $row[19]);
					$email =				$row[20];
					$security_phrase =		$row[21];
					$comments =				trim($row[22]);

					if (strlen($phone_number)>6) {

						if (strlen($list_id_override)>0) 
							{
						#	print "<BR><BR>ID DE LA LISTA OVERRIDE FOR THIS FILE: $list_id_override<BR><BR>";
							$list_id = $list_id_override;
							}

						$gmt_offset = lookup_gmt($phone_code,$USarea,$state,$LOCAL_GMT_OFF_STD,$Shour,$Smin,$Ssec,$Smon,$Smday,$Syear);


						if ($multi_insert_counter > 8) {
							### insert good deal into pending_transactions table ###
							$stmtZ = "INSERT INTO vicidial_list values$multistmt('','$entry_date','$modify_date','$status','$user','$vendor_lead_code','$source_id','$list_id','$gmt_offset','$called_since_last_reset','$phone_code','$phone_number','$title','$first_name','$middle_initial','$last_name','$address1','$address2','$address3','$city','$state','$province','$postal_code','$country_code','$gender','$date_of_birth','$alt_phone','$email','$security_phrase','$comments',0);";
							$rslt=mysql_query($stmtZ, $link);
							if ($WeBRooTWritablE > 0) 
								{fwrite($stmt_file, $stmtZ."\r\n");}
							$multistmt='';
							$multi_insert_counter=0;

						} else {
							$multistmt .= "('','$entry_date','$modify_date','$status','$user','$vendor_lead_code','$source_id','$list_id','$gmt_offset','$called_since_last_reset','$phone_code','$phone_number','$title','$first_name','$middle_initial','$last_name','$address1','$address2','$address3','$city','$state','$province','$postal_code','$country_code','$gender','$date_of_birth','$alt_phone','$email','$security_phrase','$comments',0),";
							$multi_insert_counter++;
						}

						$good++;
					} else {
						if ($bad < 10) {print "<BR></b><font size=1 color=red>record $total BAD- PHONE: $phone_number ROW: |$row[0]|</font><b>\n";}
						$bad++;
					}
					$total++;
					if ($total%100==0) {
						print "<script language='JavaScript1.2'>ShowProgress($good, $bad, $total)</script>";
						usleep(1000);
						flush();
					}
				}
			}
			if ($multi_insert_counter!=0) {
				$stmtZ = "INSERT INTO vicidial_list values".substr($multistmt, 0, -1).";";
				mysql_query($stmtZ, $link);
				if ($WeBRooTWritablE > 0) 
					{fwrite($stmt_file, $stmtZ."\r\n");}
			}

			print "<BR><BR>Done</B> GOOD: $good &nbsp; &nbsp; &nbsp; BAD: $bad &nbsp; &nbsp; &nbsp; TOTAL: $total</font></center>";

		} else {
			print "<center><font face='arial, helvetica' size=3 color='#990000'><B>ERROR: El archivo no tiene el número requerido de los campos para procesarlo.</B></font></center>";
		}
	} else if (!eregi(".csv", $leadfile_name)) 
		{
		if ($WeBRooTWritablE > 0)
			{
			copy($LF_path, "$WeBServeRRooT/vicidial/vicidial_temp_file.xls");
			$lead_file = "$WeBServeRRooT/vicidial/vicidial_temp_file.xls";
			}
		else
			{
			copy($LF_path, "/tmp/vicidial_temp_file.xls");
			$lead_file = "/tmp/vicidial_temp_file.xls";
			}
		$file=fopen("$lead_file", "r");

	#	echo "|$WeBServeRRooT/vicidial/listloader.pl --forcelistid=$list_id_override --lead-file=$lead_file|";
		passthru("$WeBServeRRooT/vicidial/listloader.pl --forcelistid=$list_id_override --lead-file=$lead_file");
	
		}
		else 
		{
		if ($WeBRooTWritablE > 0)
			{
			copy($LF_path, "$WeBServeRRooT/vicidial/vicidial_temp_file.csv");
			$lead_file = "$WeBServeRRooT/vicidial/vicidial_temp_file.csv";
			}
		else
			{
			copy($LF_path, "/tmp/vicidial_temp_file.csv");
			$lead_file = "/tmp/vicidial_temp_file.csv";
			}
		$file=fopen("$lead_file", "r");
		if ($WeBRooTWritablE > 0)
			{$stmt_file=fopen("$WeBServeRRooT/vicidial/listloader_stmts.txt", "w");}
		
		print "<center><font face='arial, helvetica' size=3 color='#009900'><B>ProcesandoCSV file... \n";

		if (strlen($list_id_override)>0) 
			{
			print "<BR><BR>ID DE LA LISTA OVERRIDE FOR THIS FILE: $list_id_override<BR><BR>";
			}

		while($row=fgetcsv($file, 1000, ",")) {
				$pulldate=date("Y-m-d H:i:s");
				$entry_date =			"$pulldate";
				$modify_date =			"";
				$status =				"NEW";
				$user ="";
				$vendor_lead_code =		$row[0];
				$source_code =			$row[1];
				$source_id=$source_code;
				$list_id =				$row[2];
				$gmt_offset =			'0';
				$called_since_last_reset='N';
				$phone_code =			eregi_replace("[^0-9]", "", $row[3]);
				$phone_number =			eregi_replace("[^0-9]", "", $row[4]);
					$USarea = 			substr($phone_number, 0, 3);
				$title =				$row[5];
				$first_name =			$row[6];
				$middle_initial =		$row[7];
				$last_name =			$row[8];
				$address1 =				$row[9];
				$address2 =				$row[10];
				$address3 =				$row[11];
				$city =$row[12];
				$state =				$row[13];
				$province =				$row[14];
				$postal_code =			$row[15];
				$country_code =				$row[16];
				$gender =				$row[17];
				$date_of_birth =		$row[18];
				$alt_phone =			eregi_replace("[^0-9]", "", $row[19]);
				$email =				$row[20];
				$security_phrase =		$row[21];
				$comments =				trim($row[22]);

				if (strlen($phone_number)>6) {

					if (strlen($list_id_override)>0) 
						{
					#	print "<BR><BR>ID DE LA LISTA OVERRIDE FOR THIS FILE: $list_id_override<BR><BR>";
						$list_id = $list_id_override;
						}

					$gmt_offset = lookup_gmt($phone_code,$USarea,$state,$LOCAL_GMT_OFF_STD,$Shour,$Smin,$Ssec,$Smon,$Smday,$Syear);


					if ($multi_insert_counter > 8) {
						### insert good deal into pending_transactions table ###
						$stmtZ = "INSERT INTO vicidial_list values$multistmt('','$entry_date','$modify_date','$status','$user','$vendor_lead_code','$source_id','$list_id','$gmt_offset','$called_since_last_reset','$phone_code','$phone_number','$title','$first_name','$middle_initial','$last_name','$address1','$address2','$address3','$city','$state','$province','$postal_code','$country_code','$gender','$date_of_birth','$alt_phone','$email','$security_phrase','$comments',0);";
						$rslt=mysql_query($stmtZ, $link);
						if ($WeBRooTWritablE > 0) 
							{fwrite($stmt_file, $stmtZ."\r\n");}
						$multistmt='';
						$multi_insert_counter=0;

					} else {
						$multistmt .= "('','$entry_date','$modify_date','$status','$user','$vendor_lead_code','$source_id','$list_id','$gmt_offset','$called_since_last_reset','$phone_code','$phone_number','$title','$first_name','$middle_initial','$last_name','$address1','$address2','$address3','$city','$state','$province','$postal_code','$country_code','$gender','$date_of_birth','$alt_phone','$email','$security_phrase','$comments',0),";
						$multi_insert_counter++;
					}

					$good++;
				} else {
					if ($bad < 10) {print "<BR></b><font size=1 color=red>record $total BAD- PHONE: $phone_number ROW: |$row[0]|</font><b>\n";}
					$bad++;
				}
				$total++;
				if ($total%100==0) {
					print "<script language='JavaScript1.2'>ShowProgress($good, $bad, $total)</script>";
					usleep(1000);
					flush();
				}
			}
			if ($multi_insert_counter!=0) {
				$stmtZ = "INSERT INTO vicidial_list values".substr($multistmt, 0, -1).";";
				mysql_query($stmtZ, $link);
				if ($WeBRooTWritablE > 0) 
					{fwrite($stmt_file, $stmtZ."\r\n");}
			}

			print "<BR><BR>Done</B> GOOD: $good &nbsp; &nbsp; &nbsp; BAD: $bad &nbsp; &nbsp; &nbsp; TOTAL: $total</font></center>";

		}
		print "<script language='JavaScript1.2'>document.forms[0].leadfile.disabled=false; document.forms[0].submit_file.disabled=false; document.forms[0].reload_page.disabled=false;</script>";

		} else {
			print "<script language='JavaScript1.2'>document.forms[0].leadfile.disabled=true; document.forms[0].submit_file.disabled=true; document.forms[0].reload_page.disabled=true;</script><HR>";
			flush();
			print "<table border=0 cellpadding=3 cellspacing=0 width=500 align=center>\r\n";
			print "  <tr bgcolor='#330099'>\r\n";
			print "    <th align=right><font class='standard' color='white'>VICIDIAL Columna</font></th>\r\n";
			print "    <th><font class='standard' color='white'>Datos del archivo</font></th>\r\n";
			print "  </tr>\r\n";

			$rslt=mysql_query("select vendor_lead_code, source_id, list_id, phone_code, phone_number, title, first_name, middle_initial, last_name, address1, address2, address3, city, state, province, postal_code, country_code, gender, date_of_birth, alt_phone, email, security_phrase, comments from vicidial_list limit 1", $link);
			

			if (!eregi(".csv", $leadfile_name) && !eregi(".xls", $leadfile_name)) 
				{
				if ($WeBRooTWritablE > 0)
					{
					copy($LF_path, "$WeBServeRRooT/vicidial/vicidial_temp_file.txt");
					$lead_file = "$WeBServeRRooT/vicidial/vicidial_temp_file.txt";
					}
				else
					{
					copy($LF_path, "/tmp/vicidial_temp_file.txt");
					$lead_file = "/tmp/vicidial_temp_file.txt";
					}
				$file=fopen("$lead_file", "r");
				if ($WeBRooTWritablE > 0)
					{$stmt_file=fopen("$WeBServeRRooT/vicidial/listloader_stmts.txt", "w");}

				$buffer=fgets($file, 4096);
				$tab_count=substr_count($buffer, "\t");
				$pipe_count=substr_count($buffer, "|");

				if ($tab_count>$pipe_count) {$delimiter="\t";  $delim_name="tab";} else {$delimiter="|";  $delim_name="pipe";}
				$field_check=explode($delimiter, $buffer);
				flush();
				$file=fopen("$lead_file", "r");
				print "<center><font face='arial, helvetica' size=3 color='#009900'><B>Procesando$delim_name-delimited file...\n";

				if (strlen($list_id_override)>0) 
					{
					print "<BR><BR>ID DE LA LISTA OVERRIDE FOR THIS FILE: $list_id_override<BR><BR>";
					}
				$buffer=rtrim(fgets($file, 4096));
				$buffer=stripslashes($buffer);
				$row=explode($delimiter, eregi_replace("[\'\"]", "", $buffer));
				
				for ($i=0; $i<mysql_num_fields($rslt); $i++) {

					print "  <tr bgcolor=#D9E6FE>\r\n";
					print "    <td align=right><font class=standard>".strtoupper(eregi_replace("_", " ", mysql_field_name($rslt, $i))).": </font></td>\r\n";
					print "    <td align=center><select name='".mysql_field_name($rslt, $i)."_field'>\r\n";
					print "     <option value='-1'>(none)</option>\r\n";

					for ($j=0; $j<count($row); $j++) {
						eregi_replace("\"", "", $row[$j]);
						print "     <option value='$j'>\"$row[$j]\"</option>\r\n";
					}

					print "    </select></td>\r\n";
					print "  </tr>\r\n";

					#print "  <tr bgcolor=#D9E6FE>\r\n";
					#print "    <td align=center><font class=standard>$row[$i]</font></td>\r\n";
					#print "    <td align=center><select name=datafield$i>\r\n";
					#print "     <option value=''>---------------------</option>\r\n";
					#print "     <option value='entry_date'>Entry date</option>\r\n";
					#print "     <option value='modify_date'>Modify date</option>\r\n";
					#print "     <option value='status'>Status</option>\r\n";
					#print "     <option value='user'>User</option>\r\n";
					#print "     <option value='vendor_lead_code'>Vendor lead code</option>\r\n";
					#print "     <option value='source_id'>Source ID</option>\r\n";
					#print "     <option value='list_id'>ID De la Lista</option>\r\n";
					#print "     <option value='gmt_offset'>ID De la Campaña</option>\r\n";
					#print "     <option value='called_since_last_reset'>Called since last reset</option>\r\n";
					#print "     <option value='phone_code'>Phone code</option>\r\n";
					#print "     <option value='phone_number'>Phone number</option>\r\n";
					#print "     <option value='title'>Title</option>\r\n";
					#print "     <option value='first_name'>First name</option>\r\n";
					#print "     <option value='middle_initial'>Middle initial</option>\r\n";
					#print "     <option value='last_name'>Last name</option>\r\n";
					#print "     <option value='address1'>Dirección 1</option>\r\n";
					#print "     <option value='address2'>Dirección 2</option>\r\n";
					#print "     <option value='address3'>Dirección 3</option>\r\n";
					#print "     <option value='city'>Ciudad</option>\r\n";
					#print "     <option value='state'>State</option>\r\n";
					#print "     <option value='province'>Provincia</option>\r\n";
					#print "     <option value='postal_code'>Postal code</option>\r\n";
					#print "     <option value='country_code'>País    code</option>\r\n";
					#print "     <option value='gender'>Sexo</option>\r\n";
					#print "     <option value='date_of_birth'>Date of birth</option>\r\n";
					#print "     <option value='alt_phone'>Alt. phone</option>\r\n";
					#print "     <option value='email'>E-mail</option>\r\n";
					#print "     <option value='security_phrase'>Seguridadphrase</option>\r\n";
					#print "     <option value='comments'>Comentarios</option>\r\n";
					#print "    </td>\r\n";
					#print "  </tr>\r\n";
				}
			} 
			else if (!eregi(".csv", $leadfile_name)) 
			{
				if ($WeBRooTWritablE > 0)
					{
					copy($LF_path, "$WeBServeRRooT/vicidial/vicidial_temp_file.xls");
					$lead_file = "$WeBServeRRooT/vicidial/vicidial_temp_file.xls";
					}
				else
					{
					copy($LF_path, "/tmp/vicidial_temp_file.xls");
					$lead_file = "/tmp/vicidial_temp_file.xls";
					}

			#	echo "|$WeBServeRRooT/vicidial/listloader_rowdisplay.pl --lead-file=$lead_file|";
				passthru("$WeBServeRRooT/vicidial/listloader_rowdisplay.pl --lead-file=$lead_file");
			} 
			else 
			{
				if ($WeBRooTWritablE > 0)
					{
					copy($LF_path, "$WeBServeRRooT/vicidial/vicidial_temp_file.csv");
					$lead_file = "$WeBServeRRooT/vicidial/vicidial_temp_file.csv";
					}
				else
					{
					copy($LF_path, "/tmp/vicidial_temp_file.csv");
					$lead_file = "/tmp/vicidial_temp_file.csv";
					}
				$file=fopen("$lead_file", "r");

				if ($WeBRooTWritablE > 0)
					{$stmt_file=fopen("$WeBServeRRooT/vicidial/listloader_stmts.txt", "w");}
				
				print "<center><font face='arial, helvetica' size=3 color='#009900'><B>ProcesandoCSV file... \n";
				
				if (strlen($list_id_override)>0) 
					{
					print "<BR><BR>ID DE LA LISTA OVERRIDE FOR THIS FILE: $list_id_override<BR><BR>";
					}

				$total=0; $good=0; $bad=0;
				$row=fgetcsv($file, 1000, ",");
				for ($i=0; $i<mysql_num_fields($rslt); $i++) {
					print "  <tr bgcolor=#D9E6FE>\r\n";
					print "    <td align=right><font class=standard>".strtoupper(eregi_replace("_", " ", mysql_field_name($rslt, $i))).": </font></td>\r\n";
					print "    <td align=center><select name='".mysql_field_name($rslt, $i)."_field'>\r\n";
					print "     <option value='-1'>(none)</option>\r\n";

					for ($j=0; $j<count($row); $j++) {
						eregi_replace("\"", "", $row[$j]);
						print "     <option value='$j'>\"$row[$j]\"</option>\r\n";
					}

					print "    </select></td>\r\n";
					print "  </tr>\r\n";

					#print "  <tr bgcolor=#D9E6FE>\r\n";
					#print "    <td align=center><font class=standard>$row[$i]</font></td>\r\n";
					#print "    <td align=center><select name=datafield$i>\r\n";
					#print "     <option value=''>---------------------</option>\r\n";
					#print "     <option value='entry_date'>Entry date</option>\r\n";
					#print "     <option value='modify_date'>Modify date</option>\r\n";
					#print "     <option value='status'>Status</option>\r\n";
					#print "     <option value='user'>User</option>\r\n";
					#print "     <option value='vendor_lead_code'>Vendor lead code</option>\r\n";
					#print "     <option value='source_id'>Source ID</option>\r\n";
					#print "     <option value='list_id'>ID De la Lista</option>\r\n";
					#print "     <option value='gmt_offset'>ID De la Campaña</option>\r\n";
					#print "     <option value='called_since_last_reset'>Called since last reset</option>\r\n";
					#print "     <option value='phone_code'>Phone code</option>\r\n";
					#print "     <option value='phone_number'>Phone number</option>\r\n";
					#print "     <option value='title'>Title</option>\r\n";
					#print "     <option value='first_name'>First name</option>\r\n";
					#print "     <option value='middle_initial'>Middle initial</option>\r\n";
					#print "     <option value='last_name'>Last name</option>\r\n";
					#print "     <option value='address1'>Dirección 1</option>\r\n";
					#print "     <option value='address2'>Dirección 2</option>\r\n";
					#print "     <option value='address3'>Dirección 3</option>\r\n";
					#print "     <option value='city'>Ciudad</option>\r\n";
					#print "     <option value='state'>State</option>\r\n";
					#print "     <option value='province'>Provincia</option>\r\n";
					#print "     <option value='postal_code'>Postal code</option>\r\n";
					#print "     <option value='country_code'>País    code</option>\r\n";
					#print "     <option value='gender'>Sexo</option>\r\n";
					#print "     <option value='date_of_birth'>Date of birth</option>\r\n";
					#print "     <option value='alt_phone'>Alt. phone</option>\r\n";
					#print "     <option value='email'>E-mail</option>\r\n";
					#print "     <option value='security_phrase'>Seguridadphrase</option>\r\n";
					#print "     <option value='comments'>Comentarios</option>\r\n";
					#print "    </td>\r\n";
					#print "  </tr>\r\n";
				}
			}
			print "  <tr bgcolor='#330099'>\r\n";
			print "  <input type=hidden name=lead_file value=\"$lead_file\">\r\n";
			print "  <input type=hidden name=list_id_override value=\"$list_id_override\">\r\n";
			print "    <th colspan=2><input type=submit name='OK_to_process' value='ACEPTABLE PROCESAR'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type=button onClick=\"javascript:document.location='new_listloader_superL.php'\" value=\"RECARGAR\" name='reload_page'></th>\r\n";
			print "  </tr>\r\n";
			print "</table>\r\n";
	# }
		print "<script language='JavaScript1.2'>document.forms[0].leadfile.disabled=false; document.forms[0].submit_file.disabled=false; document.forms[0].reload_page.disabled=false;</script>";
	}
} else if (filesize($leadfile)>8388608) {
		print "<center><font face='arial, helvetica' size=3 color='#990000'><B>ERROR: El archivo excede el límite 8MB.</B></font></center>";
}
?>
</form>
</body>
</html>





<?

exit;



function lookup_gmt($phone_code,$USarea,$state,$LOCAL_GMT_OFF_STD,$Shour,$Smin,$Ssec,$Smon,$Smday,$Syear)
{
require("dbconnect.php");


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
if ( (!$AC_processed) and ($dst_range == 'FSA-LSO') )
	{
	if ($DBX) {print "     First Sunday April to Last Sunday October\n";}
	#**********************************************************************
	# FSA-LSO
	#     This is returns 1 if Daylight Savings Time is in effect and 0 if 
	#       Standard time is in effect.
	#     Based on first Sunday in April and last Sunday in October at 2 am.
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
			} else { # tiempo local calculations
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
			} else { # tiempo local calculations
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
			} else { # tiempo local calculations
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
			} else { # tiempo local calculations
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
			} else { # tiempo local calculations
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
			} else { # tiempo local calculations
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
			} else { # tiempo local calculations
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
if (!$AC_processed)
	{
	if ($DBX) {print "     No DST Method Found\n";}
	if ($DBX) {print "     DST: 0\n";}
	$AC_processed++;
	}

return $gmt_offset;
}