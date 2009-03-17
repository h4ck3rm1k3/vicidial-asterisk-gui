<?
# admin_header.php - VICIDIAL administration header
#
# Copyright (C) 2009  Matt Florell <vicidial@gmail.com>    LICENSE: AGPLv2
# 

# CHANGES
# 90310-0709 - First Build


######################### SMALL HTML HEADER BEGIN #######################################
if($short_header)
	{
	?>
	<TABLE CELLPADDING=0 CELLSPACING=0 BGCOLOR="#015B91"><TR>
	<TD><IMG SRC="vicidial_admin_web_logo_small.gif" WIDTH=71 HEIGHT=22> &nbsp; </TD>
	<TD> &nbsp; <A HREF="admin.php" ALT="Χρήστες"><FONT FACE="ARIAL,HELVETICA" COLOR=WHITE SIZE=2><B>Χρήστες</B></A> &nbsp; </TD>
	<TD> &nbsp; <A HREF="admin.php?ADD=10" ALT="Εκστρατείες"><FONT FACE="ARIAL,HELVETICA" COLOR=WHITE SIZE=2><B>Εκστρατείες</B></A> &nbsp; </TD>
	<TD> &nbsp; <A HREF="admin.php?ADD=100" ALT="Λίστες"><FONT FACE="ARIAL,HELVETICA" COLOR=WHITE SIZE=2><B>Λίστες</B></A> &nbsp; </TD>
	<TD> &nbsp; <A HREF="admin.php?ADD=1000000" ALT="Βοηθοί"><FONT FACE="ARIAL,HELVETICA" COLOR=WHITE SIZE=2><B>Βοηθοί</B></A> &nbsp; </TD>
	<TD> &nbsp; <A HREF="admin.php?ADD=10000000" ALT="Φίλτρα"><FONT FACE="ARIAL,HELVETICA" COLOR=WHITE SIZE=2><B>Φίλτρα</B></A> &nbsp; </TD>
	<TD> &nbsp; <A HREF="admin.php?ADD=1000" ALT="Εισ-Ομάδες"><FONT FACE="ARIAL,HELVETICA" COLOR=WHITE SIZE=2><B>Εισ-Ομάδες</B></A> &nbsp; </TD>
	<TD> &nbsp; <A HREF="admin.php?ADD=100000" ALT="Ομάδες Χρήστη"><FONT FACE="ARIAL,HELVETICA" COLOR=WHITE SIZE=2><B>Ομάδες Χρήστη</B></A> &nbsp; </TD>
	<TD> &nbsp; <A HREF="admin.php?ADD=10000" ALT="Απομακρυσμένοι Χειριστές"><FONT FACE="ARIAL,HELVETICA" COLOR=WHITE SIZE=2><B>Απομακρυσμένοι Χειριστές</B></A> &nbsp; </TD>
	<TD> &nbsp; <A HREF="admin.php?ADD=10000000000" ALT="Admin"><FONT FACE="ARIAL,HELVETICA" COLOR=WHITE SIZE=2><B>Admin</B></A> &nbsp; </TD>
	<TD> &nbsp; <A HREF="admin.php?ADD=999999" ALT="Εκθέσεις"><FONT FACE="ARIAL,HELVETICA" COLOR=WHITE SIZE=2><B>Εκθέσεις</B></A> &nbsp; </TD>
	</TR>
	</TABLE>
	<?
	}
######################### SMALL HTML HEADER END #######################################


######################### FULL HTML HEADER BEGIN #######################################
else
{
if ($hh=='users') 
	{$users_hh="bgcolor =\"$users_color\""; $users_fc="$users_font"; $users_bold="$header_selected_bold";}
	else {$users_hh=''; $users_fc='WHITE'; $users_bold="$header_nonselected_bold";}
if ($hh=='campaigns') 
	{$campaigns_hh="bgcolor=\"$campaigns_color\""; $campaigns_fc="$campaigns_font"; $campaigns_bold="$header_selected_bold";}
	else {$campaigns_hh=''; $campaigns_fc='WHITE'; $campaigns_bold="$header_nonselected_bold";}
if ($SSoutbound_autodial_active > 0)
	{
	if ($hh=='lists') 
		{$lists_hh="bgcolor=\"$lists_color\""; $lists_fc="$lists_font"; $lists_bold="$header_selected_bold";}
		else {$lists_hh=''; $lists_fc='WHITE'; $lists_bold="$header_nonselected_bold";}
	}
if ($hh=='ingroups') 
	{$ingroups_hh="bgcolor=\"$ingroups_color\""; $ingroups_fc="$ingroups_font"; $ingroups_bold="$header_selected_bold";}
	else {$ingroups_hh=''; $ingroups_fc='WHITE'; $ingroups_bold="$header_nonselected_bold";}
if ($hh=='remoteagent') 
	{$remoteagent_hh="bgcolor=\"$remoteagent_color\""; $remoteagent_fc="$remoteagent_font"; $remoteagent_bold="$header_selected_bold";}
	else {$remoteagent_hh=''; $remoteagent_fc='WHITE'; $remoteagent_bold="$header_nonselected_bold";}
if ($hh=='usergroups') 
	{$usergroups_hh="bgcolor=\"$usergroups_color\""; $usergroups_fc="$usergroups_font"; $usergroups_bold="$header_selected_bold";}
	else {$usergroups_hh=''; $usergroups_fc='WHITE'; $usergroups_bold="$header_nonselected_bold";}
if ($hh=='scripts') 
	{$scripts_hh="bgcolor=\"$scripts_color\""; $scripts_fc="$scripts_font"; $scripts_bold="$header_selected_bold";}
	else {$scripts_hh=''; $scripts_fc='WHITE'; $scripts_bold="$header_nonselected_bold";}
if ($SSoutbound_autodial_active > 0)
	{
	if ($hh=='filters') 
		{$filters_hh="bgcolor=\"$filters_color\""; $filters_fc="$filters_font"; $filters_bold="$header_selected_bold";}
		else {$filters_hh=''; $filters_fc='WHITE'; $filters_bold="$header_nonselected_bold";}
	}
if ($hh=='admin') 
	{$admin_hh="bgcolor=\"$admin_color\""; $admin_fc="$admin_font"; $admin_bold="$header_selected_bold";}
	else {$admin_hh=''; $admin_fc='WHITE'; $admin_bold="$header_nonselected_bold";}
if ($hh=='reports') 
	{$reports_hh="bgcolor=\"$reports_color\""; $reports_fc="$reports_font"; $reports_bold="$header_selected_bold";}
	else {$reports_hh=''; $reports_fc='WHITE'; $reports_bold="$header_nonselected_bold";}

echo "</title>\n";
echo "<script language=\"Javascript\">\n";

if ($TCedit_javascript > 0)
	{
 ?>

function run_submit()
	{
	calculate_hours();
	var go_submit = document.getElementById("go_submit");
	if (go_submit.disabled == false)
		{
		document.edit_log.submit();
		}
	}

// Calculate login time
function calculate_hours() 
	{
	var now_epoch = '<? echo $StarTtimE ?>';
	var i=0;
	var total_percent=0;
	var SPANlogin_time = document.getElementById("LOGINlogin_time");
	var LI_date = document.getElementById("LOGINbegin_date");
	var LO_date = document.getElementById("LOGOUTbegin_date");
	var LI_datetime = LI_date.value;
	var LO_datetime = LO_date.value;
	var LI_datetime_array=LI_datetime.split(" ");
	var LI_date_array=LI_datetime_array[0].split("-");
	var LI_time_array=LI_datetime_array[1].split(":");
	var LO_datetime_array=LO_datetime.split(" ");
	var LO_date_array=LO_datetime_array[0].split("-");
	var LO_time_array=LO_datetime_array[1].split(":");

	// Calculate milliseconds since 1970 for each date string and find diff
	var LI_sec = ( ( (LI_time_array[2] * 1) * 1000) );
	var LI_min = ( ( ( (LI_time_array[1] * 1) * 1000) * 60 ) );
	var LI_hour = ( ( ( (LI_time_array[0] * 1) * 1000) * 3600 ) );
	var LI_date_epoch = Date.parse(LI_date_array[0] + '/' + LI_date_array[1] + '/' + LI_date_array[2]);
	var LI_epoch = (LI_date_epoch + LI_sec + LI_min + LI_hour);
	var LO_sec = ( ( (LO_time_array[2] * 1) * 1000) );
	var LO_min = ( ( ( (LO_time_array[1] * 1) * 1000) * 60 ) );
	var LO_hour = ( ( ( (LO_time_array[0] * 1) * 1000) * 3600 ) );
	var LO_date_epoch = Date.parse(LO_date_array[0] + '/' + LO_date_array[1] + '/' + LO_date_array[2]);
	var LO_epoch = (LO_date_epoch + LO_sec + LO_min + LO_hour);
	var temp_LI_epoch = (LI_epoch / 1000 );
	var temp_LO_epoch = (LO_epoch / 1000 );
	var epoch_diff = ( (LO_epoch - LI_epoch) / 1000 );
	var temp_diff = epoch_diff;

	document.getElementById("login_time").innerHTML = "ERROR, Please check date fields";

	var go_submit = document.getElementById("go_submit");
	go_submit.disabled = true;
	// length is a positive number and no more than 24 hours, datetime is earlier than right now
	if ( (epoch_diff < 86401) && (epoch_diff > 0) && (temp_LI_epoch < now_epoch) && (temp_LO_epoch < now_epoch) )
		{
		go_submit.disabled = false;

		hours = Math.floor(temp_diff / (60 * 60)); 
		temp_diff -= hours * (60 * 60);

		mins = Math.floor(temp_diff / 60); 
		temp_diff -= mins * 60;

		secs = Math.floor(temp_diff); 
		temp_diff -= secs;

		document.getElementById("login_time").innerHTML = hours + ":" + mins;

		var form_LI_epoch = document.getElementById("LOGINepoch");
		var form_LO_epoch = document.getElementById("LOGOUTepoch");
		form_LI_epoch.value = (LI_epoch / 1000);
		form_LO_epoch.value = (LO_epoch / 1000);
		}
	}



<?
	}
######################
# ADD=31 or 34 and SUB=29 for list mixes
######################
if ( ( ($ADD==34) or ($ADD==31) or ($ADD==49) ) and ($SUB==29) and ($LOGmodify_campaigns==1) and ( (eregi("$campaign_id",$LOGallowed_campaigns)) or (eregi("ALL-CAMPAIGNS",$LOGallowed_campaigns)) ) ) 
{

?>
//Μίγμα καταλόγωνstatus add and remove
function mod_mix_status(stage,vcl_id,entry) 
	{
	var mod_status = document.getElementById("dial_status_" + entry + "_" + vcl_id);
	if (mod_status.value.length < 1)
		{
		alert("You must select a status first");
		}
	else
		{
		var old_statuses = document.getElementById("status_" + entry + "_" + vcl_id);
		var ROold_statuses = document.getElementById("ROstatus_" + entry + "_" + vcl_id);
		var MODstatus = new RegExp(" " + mod_status.value + " ","g");
		if (stage=="ADD")
			{
			if (old_statuses.value.match(MODstatus))
				{
				alert("The status " + mod_status.value + " is already present");
				}
			else
				{
				var new_statuses = " " + mod_status.value + "" + old_statuses.value;
				old_statuses.value = new_statuses;
				ROold_statuses.value = new_statuses;
				mod_status.value = "";
				}
			}
		if (stage=="REMOVE")
			{
			var MODstatus = new RegExp(" " + mod_status.value + " ","g");
			old_statuses.value = old_statuses.value.replace(MODstatus, " ");
			ROold_statuses.value = ROold_statuses.value.replace(MODstatus, " ");
			}
		}
	}

//Μίγμα καταλόγωνpercent difference calculation and warning message
function mod_mix_percent(vcl_id,entries) 
	{
	var i=0;
	var total_percent=0;
	var percent_diff='';
	while(i < entries)
		{
		var mod_percent_field = document.getElementById("percentage_" + i + "_" + vcl_id);
		temp_percent = mod_percent_field.value * 1;
		total_percent = (total_percent + temp_percent);
		i++;
		}

	var mod_diff_percent = document.getElementById("PCT_DIFF_" + vcl_id);
	percent_diff = (total_percent - 100);
	if (percent_diff > 0)
		{
		percent_diff = '+' + percent_diff;
		}
	var mix_list_submit = document.getElementById("submit_" + vcl_id);
	if ( (percent_diff > 0) || (percent_diff < 0) )
		{
		mix_list_submit.disabled = true;
		document.getElementById("ERROR_" + vcl_id).innerHTML = "<font color=red><B>The Difference % must be 0</B></font>";
		}
	else
		{
		mix_list_submit.disabled = false;
		document.getElementById("ERROR_" + vcl_id).innerHTML = "";
		}

	mod_diff_percent.value = percent_diff;
	}

function submit_mix(vcl_id,entries) 
	{
	var h=1;
	var j=1;
	var list_mix_container='';
	var mod_list_mix_container_field = document.getElementById("list_mix_container_" + vcl_id);
	while(h < 11)
		{
		var i=0;
		while(i < entries)
			{
			var mod_list_id_field = document.getElementById("list_id_" + i + "_" + vcl_id);
			var mod_priority_field = document.getElementById("priority_" + i + "_" + vcl_id);
			var mod_percent_field = document.getElementById("percentage_" + i + "_" + vcl_id);
			var mod_statuses_field = document.getElementById("status_" + i + "_" + vcl_id);
			if (mod_priority_field.value==h)
				{
				list_mix_container = list_mix_container + mod_list_id_field.value + "|" + j + "|" + mod_percent_field.value + "|" + mod_statuses_field.value + "|:";
				j++
				}
			i++;
			}
		h++
		}
	mod_list_mix_container_field.value = list_mix_container;
	var form_to_submit = document.getElementById("" + vcl_id);
	form_to_submit.submit();
	}
<?
}
?>

function openNewWindow(url) {
  window.open (url,"",'width=620,height=300,scrollbars=yes,menubar=yes,address=yes');
}
function scriptInsertField() {
	openField = '--A--';
	closeField = '--B--';
	var textBox = document.scriptForm.script_text;
	var scriptIndex = document.getElementById("selectedField").selectedIndex;
	var insValue =  document.getElementById('selectedField').options[scriptIndex].value;
  if (document.selection) {
	//IE
	textBox = document.scriptForm.script_text;
	insValue = document.scriptForm.selectedField.options[document.scriptForm.selectedField.selectedIndex].text;
	textBox.focus();
	sel = document.selection.createRange();
	sel.text = openField + insValue + closeField;
  } else if (textBox.selectionStart || textBox.selectionStart == 0) {
	//Mozilla
	var startPos = textBox.selectionStart;
	var endPos = textBox.selectionEnd;
	textBox.value = textBox.value.substring(0, startPos)
	+ openField + insValue + closeField
	+ textBox.value.substring(endPos, textBox.value.length);
  } else {
	textBox.value += openField + insValue + closeField;
  }
}

<?

#### Javascript for auto-generate of user ID Button
if ( ($ADD==1) or ($ADD=="1A") )
{
?>
function user_auto()
	{
	var user_toggle = document.getElementById("user_toggle");
	var user_field = document.getElementById("user");
	if (user_toggle.value < 1)
		{
		user_field.value = 'AUTOGENERATEZZZ';
		user_field.disabled = true;
		user_toggle.value = 1;
		}
	else
		{
		user_field.value = '';
		user_field.disabled = false;
		user_toggle.value = 0;
		}
	}

function user_submit()
	{
	var user_field = document.getElementById("user");
	user_field.disabled = false;
	document.userform.submit();
	}

<?
}

### Javascript for shift end-time calculation and display
if ( ($ADD==131111111) or ($ADD==331111111) or ($ADD==431111111) )
{
?>
function shift_time()
	{
	var start_time = document.getElementById("shift_start_time");
	var end_time = document.getElementById("shift_end_time");
	var length = document.getElementById("shift_length");

	var st_value = start_time.value;
	var et_value = end_time.value;
	while (st_value.length < 4) {st_value = "0" + st_value;}
	while (et_value.length < 4) {et_value = "0" + et_value;}
	var st_hour=st_value.substring(0,2);
	var st_min=st_value.substring(2,4);
	var et_hour=et_value.substring(0,2);
	var et_min=et_value.substring(2,4);
	if (st_hour > 23) {st_hour = 23;}
	if (et_hour > 23) {et_hour = 23;}
	if (st_min > 59) {st_min = 59;}
	if (et_min > 59) {et_min = 59;}
	start_time.value = st_hour + "" + st_min;
	end_time.value = et_hour + "" + et_min;

	var start_time_hour=start_time.value.substring(0,2);
	var start_time_min=start_time.value.substring(2,4);
	var end_time_hour=end_time.value.substring(0,2);
	var end_time_min=end_time.value.substring(2,4);
	start_time_hour=(start_time_hour * 1);
	start_time_min=(start_time_min * 1);
	end_time_hour=(end_time_hour * 1);
	end_time_min=(end_time_min * 1);

	if (start_time.value == end_time.value)
		{
		var shift_length = '24:00';
		}
	else
		{
		if ( (start_time_hour > end_time_hour) || ( (start_time_hour == end_time_hour) && (start_time_min > end_time_min) ) )
			{
			var shift_hour = ( (24 - start_time_hour) + end_time_hour);
			var shift_minute = ( (60 - start_time_min) + end_time_min);
			if (shift_minute >= 60) 
				{
				shift_minute = (shift_minute - 60);
				}
			else
				{
				shift_hour = (shift_hour - 1);
				}
			}
		else
			{
			var shift_hour = (end_time_hour - start_time_hour);
			var shift_minute = (end_time_min - start_time_min);
			}
		if (shift_minute < 0) 
			{
			shift_minute = (shift_minute + 60);
			shift_hour = (shift_hour - 1);
			}

		if (shift_hour < 10) {shift_hour = '0' + shift_hour}
		if (shift_minute < 10) {shift_minute = '0' + shift_minute}
		var shift_length = shift_hour + ':' + shift_minute;
		}
//	alert(start_time_hour + '|' + start_time_min + '|' + end_time_hour + '|' + end_time_min + '|--|' + shift_hour + ':' + shift_minute + '|' + shift_length + '|');

	length.value = shift_length;
	}

<?
}
echo "</script>\n";
echo "</head>\n";
echo "<BODY BGCOLOR=white marginheight=0 marginwidth=0 leftmargin=0 topmargin=0>\n";
echo "<!-- ILPV -->\n";
echo "<TD WIDTH=100 ALIGN=RIGHT VALIGN=TOP  NOWRAP><a href=\"../vicidial_en/admin.php?relogin=YES&VD_login=$VD_login&VD_campaign=$VD_campaign&phone_login=$phone_login&phone_pass=$phone_pass&VD_pass=$VD_pass\">English <img src=\"../agc/images/en.gif\" BORDER=0 HEIGHT=14 WIDTH=20></a></TD>\n";echo "<TD WIDTH=100 ALIGN=RIGHT VALIGN=TOP  BGCOLOR=\"#CCFFCC\" NOWRAP><a href=\"../vicidial_el/admin.php?relogin=YES&VD_login=$VD_login&VD_campaign=$VD_campaign&phone_login=$phone_login&phone_pass=$phone_pass&VD_pass=$VD_pass\">Ελληνικά <img src=\"../agc/images/el.gif\" BORDER=0 HEIGHT=14 WIDTH=20></a></TD>\n";
$stmt="SELECT admin_home_url from system_settings;";
$rslt=mysql_query($stmt, $link);
$row=mysql_fetch_row($rslt);
$admin_home_url_LU =	$row[0];

?>
<CENTER>
<!--<TABLE WIDTH=<?=$page_width ?> BGCOLOR=#D9E6FE cellpadding=2 cellspacing=0><TR BGCOLOR=#015B91><TD ALIGN=LEFT COLSPAN=5><FONT FACE="ARIAL,HELVETICA" COLOR=WHITE SIZE=2><B> &nbsp; ΔΙΑΧΕΙΡΙΣΗ - <a href="<? echo $admin_home_url_LU ?>"><FONT FACE="ARIAL,HELVETICA" COLOR=WHITE SIZE=1>ΣΠΙΤΙ</a> | <A HREF="../agc/timeclock.php?referrer=admin"><FONT FACE="ARIAL,HELVETICA" COLOR=WHITE SIZE=1>Ώρα ρολόι</A> | <a href="<? echo $ADMIN ?>?force_logout=1"><FONT FACE="ARIAL,HELVETICA" COLOR=WHITE SIZE=1>Αποσύνδεση</a></TD><TD ALIGN=RIGHT COLSPAN=6><FONT FACE="ARIAL,HELVETICA" COLOR=WHITE SIZE=2><B><? echo date("l F j, Y G:i:s A") ?> &nbsp; </B></TD></TR>

<TD ALIGN=CENTER <?=$users_hh ?>><a href="<? echo $ADMIN ?>?ADD=0"><FONT FACE="ARIAL,HELVETICA" COLOR=<?=$users_fc ?> SIZE=<?=$header_font_size ?>><?=$users_bold ?> Χρήστες </a></TD>
<TD ALIGN=CENTER <?=$campaigns_hh ?>><a href="<? echo $ADMIN ?>?ADD=10"><FONT FACE="ARIAL,HELVETICA" COLOR=<?=$campaigns_fc ?> SIZE=<?=$header_font_size ?>><?=$campaigns_bold ?> Εκστρατείες </a></TD>
<?
if ($SSoutbound_autodial_active > 0)
	{
	?>
	<TD ALIGN=CENTER <?=$lists_hh ?>><a href="<? echo $ADMIN ?>?ADD=100"><FONT FACE="ARIAL,HELVETICA" COLOR=<?=$lists_fc ?> SIZE=<?=$header_font_size ?>><?=$lists_bold ?> Κατάλογοι </a></TD>
	<?
	}
else
	{echo "<TD></TD>";}
?>
<TD ALIGN=CENTER <?=$scripts_hh ?>><a href="<? echo $ADMIN ?>?ADD=1000000"><FONT FACE="ARIAL,HELVETICA" COLOR=<?=$scripts_fc ?> SIZE=<?=$header_font_size ?>><?=$scripts_bold ?> Χειρόγραφα </a></TD>
<?
if ($SSoutbound_autodial_active > 0)
	{
	?>
	<TD ALIGN=CENTER <?=$filters_hh ?>><a href="<? echo $ADMIN ?>?ADD=10000000"><FONT FACE="ARIAL,HELVETICA" COLOR=<?=$filters_fc ?> SIZE=<?=$header_font_size ?>><?=$filters_bold ?> Φίλτρα </a></TD>
	<?
	}
else
	{echo "<TD></TD>";}
?>
<TD ALIGN=CENTER <?=$ingroups_hh ?>><a href="<? echo $ADMIN ?>?ADD=1000"><FONT FACE="ARIAL,HELVETICA" COLOR=<?=$ingroups_fc ?> SIZE=<?=$header_font_size ?>><?=$ingroups_bold ?> $$$-ΟΜΑΔΕΣ </a></TD>
<TD ALIGN=CENTER <?=$usergroups_hh ?>><a href="<? echo $ADMIN ?>?ADD=100000"><FONT FACE="ARIAL,HELVETICA" COLOR=<?=$usergroups_fc ?> SIZE=<?=$header_font_size ?>><?=$usergroups_bold ?> Ομάδες χρηστών </a></TD>
<TD ALIGN=CENTER <?=$remoteagent_hh ?>><a href="<? echo $ADMIN ?>?ADD=10000"><FONT FACE="ARIAL,HELVETICA" COLOR=<?=$remoteagent_fc ?> SIZE=<?=$header_font_size ?>><?=$remoteagent_bold ?> Μακρινοί πράκτορες </a></TD>
<TD ALIGN=CENTER <?=$admin_hh ?>><a href="<? echo $ADMIN ?>?ADD=10000000000"><FONT FACE="ARIAL,HELVETICA" COLOR=<?=$admin_fc ?> SIZE=<?=$header_font_size ?>><?=$admin_bold ?> Admin </a></TD>
<TD ALIGN=CENTER <?=$reports_hh ?>><a href="<? echo $ADMIN ?>?ADD=999999"><FONT FACE="ARIAL,HELVETICA" COLOR=<?=$reports_fc ?> SIZE=<?=$header_font_size ?>><?=$reports_bold ?> Εκθέσεις </a></TD>
</TR>

<? if (strlen($users_hh) > 1) { 
	?>
<TR BGCOLOR=<?=$users_color ?>><TD ALIGN=LEFT COLSPAN=10><FONT FACE="ARIAL,HELVETICA" COLOR=BLACK SIZE=<?=$subheader_font_size ?>> &nbsp; <a href="<? echo $ADMIN ?>"><FONT FACE="ARIAL,HELVETICA" COLOR=BLACK SIZE=<?=$subheader_font_size ?>> Παρουσιάστε χρήστες </a> &nbsp; | &nbsp; <a href="<? echo $ADMIN ?>?ADD=1"><FONT FACE="ARIAL,HELVETICA" COLOR=BLACK SIZE=<?=$subheader_font_size ?>> Προσθέστε έναν νέο χρήστη </a> &nbsp; | &nbsp; <a href="<? echo $ADMIN ?>?ADD=1A"><FONT FACE="ARIAL,HELVETICA" COLOR=BLACK SIZE=<?=$subheader_font_size ?>> Χρήστης αντιγράφων </a> &nbsp; | &nbsp; <a href="<? echo $ADMIN ?>?ADD=550"><FONT FACE="ARIAL,HELVETICA" COLOR=BLACK SIZE=<?=$subheader_font_size ?>> Αναζήτηση ενός χρήστη </a> &nbsp; | &nbsp; <a href="./user_stats.php?user=<?=$user ?>"><FONT FACE="ARIAL,HELVETICA" COLOR=BLACK SIZE=<?=$subheader_font_size ?>> Στατιστικά Χρήστη </a> &nbsp; | &nbsp; <a href="./user_status.php?user=<?=$user ?>"><FONT FACE="ARIAL,HELVETICA" COLOR=BLACK SIZE=<?=$subheader_font_size ?>> Κατάσταση χρήστη </a> &nbsp; | &nbsp; <a href="./AST_agent_time_sheet.php?agent=<?=$user ?>"><FONT FACE="ARIAL,HELVETICA" COLOR=BLACK SIZE=<?=$subheader_font_size ?>>Ώρα Φύλλο</a> </TD></TR>
<? } 
if (strlen($campaigns_hh) > 1) 
	{ 

#	if ($sh=='basic') {$basic_sh="bgcolor=\"$subcamp_color\""; $basic_fc="$subcamp_font";}
#		else {$basic_sh=''; $basic_fc='BLACK';}
#	if ($sh=='detail') {$detail_sh="bgcolor=\"$subcamp_color\""; $detail_fc="$subcamp_font";}
#		else {$detail_sh=''; $detail_fc='BLACK';}
#	if ($sh=='dialstat') {$dialstat_sh="bgcolor=\"$subcamp_color\""; $dialstat_fc="$subcamp_font";}
#		else {$dialstat_sh=''; $dialstat_fc='BLACK';}

	if ($sh=='basic') {$sh='list';}
	if ($sh=='detail') {$sh='list';}
	if ($sh=='dialstat') {$sh='list';}

	if ($sh=='list') {$list_sh="bgcolor=\"$subcamp_color\""; $list_fc="$subcamp_font";}
		else {$list_sh=''; $list_fc='BLACK';}
	if ($sh=='status') {$status_sh="bgcolor=\"$subcamp_color\""; $status_fc="$subcamp_font";}
		else {$status_sh=''; $status_fc='BLACK';}
	if ($sh=='hotkey') {$hotkey_sh="bgcolor=\"$subcamp_color\""; $hotkey_fc="$subcamp_font";}
		else {$hotkey_sh=''; $hotkey_fc='BLACK';}
	if ($sh=='recycle') {$recycle_sh="bgcolor=\"$subcamp_color\""; $recycle_fc="$subcamp_font";}
		else {$recycle_sh=''; $recycle_fc='BLACK';}
	if ($sh=='autoalt') {$autoalt_sh="bgcolor=\"$subcamp_color\""; $autoalt_fc="$subcamp_font";}
		else {$autoalt_sh=''; $autoalt_fc='BLACK';}
	if ($sh=='pause') {$pause_sh="bgcolor=\"$subcamp_color\""; $pause_fc="$subcamp_font";}
		else {$pause_sh=''; $pause_fc='BLACK';}
	if ($sh=='listmix') {$listmix_sh="bgcolor=\"$subcamp_color\""; $listmix_fc="$subcamp_font";}
		else {$listmix_sh=''; $listmix_fc='BLACK';}

	?>
<TR BGCOLOR=<?=$campaigns_color ?>>
<TD ALIGN=CENTER <?=$list_sh ?> COLSPAN=2><a href="<? echo $ADMIN ?>?ADD=10"><FONT FACE="ARIAL,HELVETICA" COLOR=<?=$list_fc ?> SIZE=<?=$subcamp_font_size ?>>Κεντρικός αγωγός εκστρατειών</a></TD>
<TD ALIGN=LEFT <?=$status_sh ?> COLSPAN=1><a href="<? echo $ADMIN ?>?ADD=32"><FONT FACE="ARIAL,HELVETICA" COLOR=<?=$status_fc ?> SIZE=<?=$subcamp_font_size ?>> Καθεστώτων </a></TD>
<TD ALIGN=LEFT <?=$hotkey_sh ?> COLSPAN=1><a href="<? echo $ADMIN ?>?ADD=33"><FONT FACE="ARIAL,HELVETICA" COLOR=<?=$hotkey_fc ?> SIZE=<?=$subcamp_font_size ?>> HotKeys </a></TD>
<?
if ($SSoutbound_autodial_active > 0)
	{
	?>
	<TD ALIGN=LEFT <?=$recycle_sh ?> COLSPAN=2><a href="<? echo $ADMIN ?>?ADD=35"><FONT FACE="ARIAL,HELVETICA" COLOR=<?=$recycle_fc ?> SIZE=<?=$subcamp_font_size ?>>Μόλυβδος ανακύκλωσης</a></TD>
	<TD ALIGN=LEFT <?=$autoalt_sh ?> COLSPAN=1><a href="<? echo $ADMIN ?>?ADD=36"><FONT FACE="ARIAL,HELVETICA" COLOR=<?=$autoalt_fc ?> SIZE=<?=$subcamp_font_size ?>>Αυτόματος-ALT πίνακας</a></TD>
	<TD ALIGN=LEFT <?=$listmix_sh ?> COLSPAN=2><a href="<? echo $ADMIN ?>?ADD=39"><FONT FACE="ARIAL,HELVETICA" COLOR=<?=$listmix_fc ?> SIZE=<?=$subcamp_font_size ?>>Μίγμα καταλόγων</a></TD>
	<?
	}
else
	{echo "<TD></TD>";}
?>
<TD ALIGN=LEFT <?=$pause_sh ?> COLSPAN=1><a href="<? echo $ADMIN ?>?ADD=37"><FONT FACE="ARIAL,HELVETICA" COLOR=<?=$pause_fc ?> SIZE=<?=$subcamp_font_size ?>>Κώδικες μικρής διακοπής</a></TD>
<?
if ($SSoutbound_autodial_active < 1)
	{
	echo "<TD></TD><TD></TD><TD COLSPAN=2></TD>\n";
	}
?>	
</TR>
	<?
	if (strlen($list_sh) > 1) { 
		?>
	<TR BGCOLOR=<?=$subcamp_color ?>><TD ALIGN=LEFT COLSPAN=10><FONT FACE="ARIAL,HELVETICA" COLOR=BLACK SIZE=<?=$subcamp_font_size ?>> &nbsp; <a href="<? echo $ADMIN ?>?ADD=10"><FONT FACE="ARIAL,HELVETICA" COLOR=BLACK SIZE=<?=$subcamp_font_size ?>> Παρουσιάστε εκστρατείες </a> &nbsp; &nbsp; | &nbsp; &nbsp; <a href="<? echo $ADMIN ?>?ADD=11"><FONT FACE="ARIAL,HELVETICA" COLOR=BLACK SIZE=<?=$subcamp_font_size ?>> Προσθέστε μια νέα εκστρατεία </a> &nbsp; &nbsp; | &nbsp; &nbsp; <a href="<? echo $ADMIN ?>?ADD=12"><FONT FACE="ARIAL,HELVETICA" COLOR=BLACK SIZE=<?=$subcamp_font_size ?>> Εκστρατεία αντιγράφων </a> &nbsp; &nbsp; | &nbsp; &nbsp; <a href="./AST_timeonVDADallSUMMARY.php"><FONT FACE="ARIAL,HELVETICA" COLOR=BLACK SIZE=<?=$subcamp_font_size ?>> Σε πραγματικό χρόνο περίληψη εκστρατειών </a></TD></TR>
		<? } 

	} 
if (strlen($lists_hh) > 1) { 
	?>
<TR BGCOLOR=<?=$lists_color ?>><TD ALIGN=LEFT COLSPAN=10><FONT FACE="ARIAL,HELVETICA" COLOR=BLACK SIZE=<?=$subheader_font_size ?>> &nbsp; <a href="<? echo $ADMIN ?>?ADD=100"><FONT FACE="ARIAL,HELVETICA" COLOR=BLACK SIZE=<?=$subheader_font_size ?>> Παρουσιάστε καταλόγους </a> &nbsp; &nbsp; | &nbsp; &nbsp; <a href="<? echo $ADMIN ?>?ADD=111"><FONT FACE="ARIAL,HELVETICA" COLOR=BLACK SIZE=<?=$subheader_font_size ?>> Προσθέστε έναν νέο κατάλογο </a> &nbsp; &nbsp; | &nbsp; &nbsp; <a href="admin_search_lead.php"><FONT FACE="ARIAL,HELVETICA" COLOR=BLACK SIZE=<?=$subheader_font_size ?>> Αναζήτηση ενός μολύβδου </a> &nbsp; &nbsp; | &nbsp; &nbsp; <a href="<? echo $ADMIN ?>?ADD=121"><FONT FACE="ARIAL,HELVETICA" COLOR=BLACK SIZE=<?=$subheader_font_size ?>> Προσθέστε τον αριθμό σε DNC </a> &nbsp; &nbsp; | &nbsp; &nbsp; <a href="./new_listloader_superL.php"><FONT FACE="ARIAL,HELVETICA" COLOR=BLACK SIZE=<?=$subheader_font_size ?>> Νέοι μόλυβδοι φορτίων </a></TD></TR>
<? } 
if (strlen($scripts_hh) > 1) { 
	?>
<TR BGCOLOR=<?=$scripts_color ?>><TD ALIGN=LEFT COLSPAN=10><FONT FACE="ARIAL,HELVETICA" COLOR=BLACK SIZE=<?=$subheader_font_size ?>> &nbsp; <a href="<? echo $ADMIN ?>?ADD=1000000"><FONT FACE="ARIAL,HELVETICA" COLOR=BLACK SIZE=<?=$subheader_font_size ?>> Παρουσιάστε χειρόγραφα </a> &nbsp; &nbsp; | &nbsp; &nbsp; <a href="<? echo $ADMIN ?>?ADD=1111111"><FONT FACE="ARIAL,HELVETICA" COLOR=BLACK SIZE=<?=$subheader_font_size ?>> Προσθέστε ένα νέο χειρόγραφο </a></TD></TR>
<? } 
if (strlen($filters_hh) > 1) { 
	?>
<TR BGCOLOR=<?=$filters_color ?>><TD ALIGN=LEFT COLSPAN=10><FONT FACE="ARIAL,HELVETICA" COLOR=BLACK SIZE=<?=$subheader_font_size ?>> &nbsp; <a href="<? echo $ADMIN ?>?ADD=10000000"><FONT FACE="ARIAL,HELVETICA" COLOR=BLACK SIZE=<?=$subheader_font_size ?>> Παρουσιάστε φίλτρα </a> &nbsp; &nbsp; | &nbsp; &nbsp; <a href="<? echo $ADMIN ?>?ADD=11111111"><FONT FACE="ARIAL,HELVETICA" COLOR=BLACK SIZE=<?=$subheader_font_size ?>> Προσθέστε ένα νέο φίλτρο </a></TD></TR>
<? } 
if (strlen($ingroups_hh) > 1) { 
	?>
<TR BGCOLOR=<?=$ingroups_color ?>><TD ALIGN=LEFT COLSPAN=10><FONT FACE="ARIAL,HELVETICA" COLOR=BLACK SIZE=<?=$subheader_font_size ?>> &nbsp; <a href="<? echo $ADMIN ?>?ADD=1000"><FONT FACE="ARIAL,HELVETICA" COLOR=BLACK SIZE=<?=$subheader_font_size ?>> Παρουσιάστε-ΟΜΑΔΕΣ </a> &nbsp; &nbsp; | &nbsp; &nbsp; <a href="<? echo $ADMIN ?>?ADD=1111"><FONT FACE="ARIAL,HELVETICA" COLOR=BLACK SIZE=<?=$subheader_font_size ?>> Προσθέστε μια νέα-ΟΜΑΔΑ </a> &nbsp; &nbsp; | &nbsp; &nbsp; <a href="<? echo $ADMIN ?>?ADD=1211"><FONT FACE="ARIAL,HELVETICA" COLOR=BLACK SIZE=<?=$subheader_font_size ?>> $$$-ΟΜΑΔΑ αντιγράφων </a> &nbsp; &nbsp; | &nbsp; &nbsp; <a href="<? echo $ADMIN ?>?ADD=1300"><FONT FACE="ARIAL,HELVETICA" COLOR=BLACK SIZE=<?=$subheader_font_size ?>> Δείτε DIDs </a> &nbsp; | &nbsp; <a href="<? echo $ADMIN ?>?ADD=1311"><FONT FACE="ARIAL,HELVETICA" COLOR=BLACK SIZE=<?=$subheader_font_size ?>> Προστίθεται ένα νέο DID </a> &nbsp; | &nbsp; <a href="<? echo $ADMIN ?>?ADD=1411"><FONT FACE="ARIAL,HELVETICA" COLOR=BLACK SIZE=<?=$subheader_font_size ?>> ΑντιγραφήDID </a></TD></TR>
<? } 
if (strlen($usergroups_hh) > 1) { 
	?>
<TR BGCOLOR=<?=$usergroups_color ?>><TD ALIGN=LEFT COLSPAN=10><FONT FACE="ARIAL,HELVETICA" COLOR=BLACK SIZE=<?=$subheader_font_size ?>> &nbsp; <a href="<? echo $ADMIN ?>?ADD=100000"><FONT FACE="ARIAL,HELVETICA" COLOR=BLACK SIZE=<?=$subheader_font_size ?>> Παρουσιάστε ομάδες χρηστών </a> &nbsp; &nbsp; | &nbsp; &nbsp; <a href="<? echo $ADMIN ?>?ADD=111111"><FONT FACE="ARIAL,HELVETICA" COLOR=BLACK SIZE=<?=$subheader_font_size ?>> Προσθέστε μια νέα ομάδα χρηστών </a> &nbsp; &nbsp; | &nbsp; &nbsp; <a href="group_hourly_stats.php"><FONT FACE="ARIAL,HELVETICA" COLOR=BLACK SIZE=<?=$subheader_font_size ?>> Ωριαία έκθεση ομάδας </a> &nbsp; &nbsp; | &nbsp; &nbsp; <a href="user_group_bulk_change.php"><FONT FACE="ARIAL,HELVETICA" COLOR=BLACK SIZE=<?=$subheader_font_size ?>> Μαζική Αλλαγή ομάδας </a></TD></TR>
<? } 
if (strlen($remoteagent_hh) > 1) { 
	?>
<TR BGCOLOR=<?=$remoteagent_color ?>><TD ALIGN=LEFT COLSPAN=10><FONT FACE="ARIAL,HELVETICA" COLOR=BLACK SIZE=<?=$subheader_font_size ?>> &nbsp; <a href="<? echo $ADMIN ?>?ADD=10000"><FONT FACE="ARIAL,HELVETICA" COLOR=BLACK SIZE=<?=$subheader_font_size ?>> Παρουσιάστε μακρινούς πράκτορες </a> &nbsp; &nbsp; | &nbsp; &nbsp; <a href="<? echo $ADMIN ?>?ADD=11111"><FONT FACE="ARIAL,HELVETICA" COLOR=BLACK SIZE=<?=$subheader_font_size ?>> Προσθέστε τους νέους μακρινούς πράκτορες </a></TD></TR>
<? } 

if (strlen($admin_hh) > 1) { 
	if ($sh=='times') {$times_sh="bgcolor=\"$times_color\""; $times_fc="$times_font";} # hard teal
		else {$times_sh=''; $times_fc='BLACK';}
	if ($sh=='phones') {$phones_sh="bgcolor=\"$server_color\""; $phones_fc="$phones_font";} # pink
		else {$phones_sh=''; $phones_fc='BLACK';}
	if ($sh=='server') {$server_sh="bgcolor=\"$server_color\""; $server_fc="$server_font";} # pink
		else {$server_sh=''; $server_fc='BLACK';}
	if ($sh=='conference') {$conference_sh="bgcolor=\"$server_color\""; $conference_fc="$server_font";} # pink
		else {$conference_sh=''; $conference_fc='BLACK';}
	if ($sh=='settings') {$settings_sh="bgcolor=\"$settings_color\""; $settings_fc="$settings_font";} # pink
		else {$settings_sh=''; $settings_fc='BLACK';}
	if ($sh=='status') {$status_sh="bgcolor=\"$status_color\""; $status_fc="$status_font";} # pink
		else {$status_sh=''; $status_fc='BLACK';}

	?>
<TR BGCOLOR=<?=$admin_color ?>>
<TD ALIGN=LEFT <?=$times_sh ?> COLSPAN=2><a href="<? echo $ADMIN ?>?ADD=100000000"><FONT FACE="ARIAL,HELVETICA" COLOR=<?=$times_fc ?> SIZE=<?=$header_font_size ?>> Χρόνοι κλήσης </a></TD>
<TD ALIGN=LEFT <?=$phones_sh ?> COLSPAN=2><a href="<? echo $ADMIN ?>?ADD=10000000000"><FONT FACE="ARIAL,HELVETICA" COLOR=<?=$phones_fc ?> SIZE=<?=$header_font_size ?>> Τηλέφωνα </a></TD>
<TD ALIGN=LEFT <?=$conference_sh ?> COLSPAN=2><a href="<? echo $ADMIN ?>?ADD=1000000000000"><FONT FACE="ARIAL,HELVETICA" COLOR=<?=$conference_fc ?> SIZE=<?=$header_font_size ?>> Διασκέψεις </a></TD>
<TD ALIGN=LEFT <?=$server_sh ?> COLSPAN=1><a href="<? echo $ADMIN ?>?ADD=100000000000"><FONT FACE="ARIAL,HELVETICA" COLOR=<?=$server_fc ?> SIZE=<?=$header_font_size ?>> Κεντρικοί υπολογιστές </a></TD>
<TD ALIGN=LEFT <?=$settings_sh ?> COLSPAN=1><a href="<? echo $ADMIN ?>?ADD=311111111111111"><FONT FACE="ARIAL,HELVETICA" COLOR=<?=$settings_fc ?> SIZE=<?=$header_font_size ?>> Τοποθετήσεις συστημάτων </a></TD>
<TD ALIGN=LEFT <?=$status_sh ?> COLSPAN=2><a href="<? echo $ADMIN ?>?ADD=321111111111111"><FONT FACE="ARIAL,HELVETICA" COLOR=<?=$status_fc ?> SIZE=<?=$header_font_size ?>>Θέσεις συστημάτων</a></TD>
</TR>
	<?
	if (strlen($times_sh) > 1) { 
		?>
	<TR BGCOLOR=<?=$times_color ?>><TD ALIGN=LEFT COLSPAN=10><FONT FACE="ARIAL,HELVETICA" COLOR=BLACK SIZE=<?=$subheader_font_size ?>><a href="<? echo $ADMIN ?>?ADD=100000000"><FONT FACE="ARIAL,HELVETICA" COLOR=BLACK SIZE=<?=$subheader_font_size ?>> Παρουσιάστε χρόνους κλήσης </a> &nbsp;| <a href="<? echo $ADMIN ?>?ADD=111111111"><FONT FACE="ARIAL,HELVETICA" COLOR=BLACK SIZE=<?=$subheader_font_size ?>> Προσθέστε έναν νέο χρόνο κλήσης </a> &nbsp;| <a href="<? echo $ADMIN ?>?ADD=1000000000"><FONT FACE="ARIAL,HELVETICA" COLOR=BLACK SIZE=<?=$subheader_font_size ?>> Παρουσιάστε χρόνους κρατικής κλήσης </a> &nbsp;| <a href="<? echo $ADMIN ?>?ADD=1111111111"><FONT FACE="ARIAL,HELVETICA" COLOR=BLACK SIZE=<?=$subheader_font_size ?>> Προσθέστε έναν νέο χρόνο κρατικής κλήσης </a> &nbsp;| <a href="<? echo $ADMIN ?>?ADD=130000000"><FONT FACE="ARIAL,HELVETICA" COLOR=BLACK SIZE=<?=$subheader_font_size ?>> Δείτε Βάρδιες </a> &nbsp;| <a href="<? echo $ADMIN ?>?ADD=131111111"><FONT FACE="ARIAL,HELVETICA" COLOR=BLACK SIZE=<?=$subheader_font_size ?>> Προστίθεται ένα νέο Shift </a></TD></TR>
		<? } 
	if (strlen($phones_sh) > 1) { 
		?>
	<TR BGCOLOR=<?=$phones_color ?>><TD ALIGN=LEFT COLSPAN=10><FONT FACE="ARIAL,HELVETICA" COLOR=BLACK SIZE=<?=$subheader_font_size ?>> &nbsp; <a href="<? echo $ADMIN ?>?ADD=10000000000"><FONT FACE="ARIAL,HELVETICA" COLOR=BLACK SIZE=<?=$subheader_font_size ?>> Παρουσιάστε τηλέφωνα </a> &nbsp; | &nbsp; <a href="<? echo $ADMIN ?>?ADD=11111111111"><FONT FACE="ARIAL,HELVETICA" COLOR=BLACK SIZE=<?=$subheader_font_size ?>> Προσθέστε ένα νέο τηλέφωνο </a> &nbsp; | &nbsp; <a href="<? echo $ADMIN ?>?ADD=12000000000"><FONT FACE="ARIAL,HELVETICA" COLOR=BLACK SIZE=<?=$subheader_font_size ?>> Τηλέφωνο Γνωστός Κατάλογος </a> &nbsp; | &nbsp; <a href="<? echo $ADMIN ?>?ADD=12111111111"><FONT FACE="ARIAL,HELVETICA" COLOR=BLACK SIZE=<?=$subheader_font_size ?>> Προστίθεται ένα νέο τηλέφωνο Γνωστός </a></TD></TR>
		<? }
	if (strlen($conference_sh) > 1) { 
		?>
	<TR BGCOLOR=<?=$conference_color ?>><TD ALIGN=LEFT COLSPAN=10><a href="<? echo $ADMIN ?>?ADD=1000000000000"><FONT FACE="ARIAL,HELVETICA" COLOR=BLACK SIZE=<?=$subheader_font_size ?>> Παρουσιάστε διασκέψεις </a> &nbsp; | &nbsp; <a href="<? echo $ADMIN ?>?ADD=1111111111111"><FONT FACE="ARIAL,HELVETICA" COLOR=BLACK SIZE=<?=$subheader_font_size ?>> Προσθέστε μια νέα διάσκεψη </a> &nbsp; | &nbsp; <a href="<? echo $ADMIN ?>?ADD=10000000000000"><FONT FACE="ARIAL,HELVETICA" COLOR=BLACK SIZE=<?=$subheader_font_size ?>> Παρουσιάστε διασκέψεις VICIDIAL </a> &nbsp; | &nbsp; <a href="<? echo $ADMIN ?>?ADD=11111111111111"><FONT FACE="ARIAL,HELVETICA" COLOR=BLACK SIZE=<?=$subheader_font_size ?>> Προσθέστε μια νέα διάσκεψη VICIDIAL </a></TD></TR>
		<? }
	if (strlen($server_sh) > 1) { 
		?>
	<TR BGCOLOR=<?=$server_color ?>><TD ALIGN=LEFT COLSPAN=10><a href="<? echo $ADMIN ?>?ADD=100000000000"><FONT FACE="ARIAL,HELVETICA" COLOR=BLACK SIZE=<?=$subheader_font_size ?>> Παρουσιάστε κεντρικούς υπολογιστές </a> &nbsp; | &nbsp; <a href="<? echo $ADMIN ?>?ADD=111111111111"><FONT FACE="ARIAL,HELVETICA" COLOR=BLACK SIZE=<?=$subheader_font_size ?>> Προσθέστε έναν νέο κεντρικό υπολογιστή </a> &nbsp; | &nbsp; <a href="<? echo $ADMIN ?>?ADD=130000000000"><FONT FACE="ARIAL,HELVETICA" COLOR=BLACK SIZE=<?=$subheader_font_size ?>> Δείτε Πρότυπα </a> &nbsp; | &nbsp; <a href="<? echo $ADMIN ?>?ADD=131111111111"><FONT FACE="ARIAL,HELVETICA" COLOR=BLACK SIZE=<?=$subheader_font_size ?>> Προσθέστε ένα νέο πρότυπο </a> &nbsp; | &nbsp; <a href="<? echo $ADMIN ?>?ADD=140000000000"><FONT FACE="ARIAL,HELVETICA" COLOR=BLACK SIZE=<?=$subheader_font_size ?>> Show Carriers </a> &nbsp; | &nbsp; <a href="<? echo $ADMIN ?>?ADD=141111111111"><FONT FACE="ARIAL,HELVETICA" COLOR=BLACK SIZE=<?=$subheader_font_size ?>> Add A New Carrier </a></TD></TR>
	<?}
	if (strlen($settings_sh) > 1) { 
		?>
	<TR BGCOLOR=<?=$settings_color ?>><TD ALIGN=LEFT COLSPAN=10><a href="<? echo $ADMIN ?>?ADD=311111111111111"><FONT FACE="ARIAL,HELVETICA" COLOR=BLACK SIZE=<?=$subheader_font_size ?>> Τοποθετήσεις συστημάτων </a></TD></TR>
	<?}
	if (strlen($status_sh) > 1) { 
		?>
	<TR BGCOLOR=<?=$status_color ?>><TD ALIGN=LEFT COLSPAN=10><a href="<? echo $ADMIN ?>?ADD=321111111111111"><FONT FACE="ARIAL,HELVETICA" COLOR=BLACK SIZE=<?=$subheader_font_size ?>>Θέσεις συστημάτων</a> &nbsp; | &nbsp; <a href="<? echo $ADMIN ?>?ADD=331111111111111"><FONT FACE="ARIAL,HELVETICA" COLOR=BLACK SIZE=<?=$subheader_font_size ?>>Κατηγορίες θέσης</a> &nbsp; | &nbsp; <a href="<? echo $ADMIN ?>?ADD=341111111111111"><FONT FACE="ARIAL,HELVETICA" COLOR=BLACK SIZE=<?=$subheader_font_size ?>>QC κωδικοί</a></TD></TR>
	<?}

### Do nothing if admin has no permissions
if($LOGast_admin_access < 1) 
	{
	$ADD='99999999999999999999';
	echo "</TABLE></center>\n";
	echo "Δεν έχετε το δικαίωμα για να δείτε την σελίδα. Παρακαλώ επιστρέψτε.\n";
	}

} 
if (strlen($reports_hh) > 1) { 
	?>
<TR BGCOLOR=<?=$reports_color ?>><TD ALIGN=LEFT COLSPAN=10><FONT FACE="ARIAL,HELVETICA" COLOR=BLACK SIZE=<?=$subheader_font_size ?>><B> &nbsp; </B></TD></TR>
<? } ?>


<TR><TD ALIGN=LEFT COLSPAN=10 HEIGHT=2 BGCOLOR=#015B91></TD></TR>
<TR><TD ALIGN=LEFT COLSPAN=10>
-->

<TABLE BGCOLOR=white cellpadding=0 cellspacing=0>
<!-- BEGIN SIDEBAR NAVIGATION -->
<TR><TD VALIGN=TOP WIDTH=170 BGCOLOR=#015B91 ALIGN=CENTER>
<IMG SRC="../vicidial/vicidial_admin_web_logo.gif" WIDTH=170 HEIGHT=45 ALT="VICIDIAL logo">
<B><FONT FACE="ARIAL,HELVETICA" COLOR=white>ADMINISTRATION</FONT></B><BR>
	<TABLE CELLPADDING=2 CELLSPACING=0 BGCOLOR=#015B91 WIDTH=160>
	<!-- ΧΡΗΣΤΕΣ NAVIGATION -->
	<TR WIDTH=160><TD <?=$users_hh ?> WIDTH=160>
	<a href="<? echo $ADMIN ?>?ADD=0"><FONT FACE="ARIAL,HELVETICA" COLOR=<?=$users_fc ?> SIZE=<?=$header_font_size ?>><?=$users_bold ?>Χρήστες</a>
	</TD></TR>
	<? if (strlen($users_hh) > 1) { 
		?>
	<TR BGCOLOR=<?=$users_color ?>><TD ALIGN=LEFT>
	 &nbsp; <a href="<? echo $ADMIN ?>"><FONT FACE="ARIAL,HELVETICA" COLOR=BLACK SIZE=<?=$subheader_font_size ?>>Δείτε Χρήστες </a>
	</TR><TR BGCOLOR=<?=$users_color ?>><TD ALIGN=LEFT>
	 &nbsp; <a href="<? echo $ADMIN ?>?ADD=1"><FONT FACE="ARIAL,HELVETICA" COLOR=BLACK SIZE=<?=$subheader_font_size ?>>Προσθήκη νέου χρήστη </a>
	</TR><TR BGCOLOR=<?=$users_color ?>><TD ALIGN=LEFT>
	 &nbsp; <a href="<? echo $ADMIN ?>?ADD=1A"><FONT FACE="ARIAL,HELVETICA" COLOR=BLACK SIZE=<?=$subheader_font_size ?>>Χρήστης αντιγράφων </a>
	</TR><TR BGCOLOR=<?=$users_color ?>><TD ALIGN=LEFT>
	 &nbsp; <a href="<? echo $ADMIN ?>?ADD=550"><FONT FACE="ARIAL,HELVETICA" COLOR=BLACK SIZE=<?=$subheader_font_size ?>>Αναζήτηση ενός χρήστη </a>
	</TR><TR BGCOLOR=<?=$users_color ?>><TD ALIGN=LEFT>
	 &nbsp; <a href="./user_stats.php?user=<?=$user ?>"><FONT FACE="ARIAL,HELVETICA" COLOR=BLACK SIZE=<?=$subheader_font_size ?>>Στατιστικά Χρήστη </a>
	</TR><TR BGCOLOR=<?=$users_color ?>><TD ALIGN=LEFT>
	 &nbsp; <a href="./user_status.php?user=<?=$user ?>"><FONT FACE="ARIAL,HELVETICA" COLOR=BLACK SIZE=<?=$subheader_font_size ?>>Κατάσταση χρήστη </a>
	</TR><TR BGCOLOR=<?=$users_color ?>><TD ALIGN=LEFT>
	 &nbsp; <a href="./AST_agent_time_sheet.php?agent=<?=$user ?>"><FONT FACE="ARIAL,HELVETICA" COLOR=BLACK SIZE=<?=$subheader_font_size ?>>Ώρα Φύλλο </a> </TD></TR>
	<? } 
	?>
	<!-- ΕΚΣΤΡΑΤΕΙΕΣ NAVIGATION -->
	<TR><TD <?=$campaigns_hh ?>>
	<a href="<? echo $ADMIN ?>?ADD=10"><FONT FACE="ARIAL,HELVETICA" COLOR=<?=$campaigns_fc ?> SIZE=<?=$header_font_size ?>><?=$campaigns_bold ?>Εκστρατείες</a>
	</TD></TR>
	<?
	if (strlen($campaigns_hh) > 1) 
		{ 
		if ($sh=='basic') {$sh='list';}
		if ($sh=='detail') {$sh='list';}
		if ($sh=='dialstat') {$sh='list';}

		if ($sh=='list') {$list_sh="bgcolor=\"$subcamp_color\""; $list_fc="$subcamp_font";}
			else {$list_sh=''; $list_fc='BLACK';}
		if ($sh=='status') {$status_sh="bgcolor=\"$subcamp_color\""; $status_fc="$subcamp_font";}
			else {$status_sh=''; $status_fc='BLACK';}
		if ($sh=='hotkey') {$hotkey_sh="bgcolor=\"$subcamp_color\""; $hotkey_fc="$subcamp_font";}
			else {$hotkey_sh=''; $hotkey_fc='BLACK';}
		if ($sh=='recycle') {$recycle_sh="bgcolor=\"$subcamp_color\""; $recycle_fc="$subcamp_font";}
			else {$recycle_sh=''; $recycle_fc='BLACK';}
		if ($sh=='autoalt') {$autoalt_sh="bgcolor=\"$subcamp_color\""; $autoalt_fc="$subcamp_font";}
			else {$autoalt_sh=''; $autoalt_fc='BLACK';}
		if ($sh=='pause') {$pause_sh="bgcolor=\"$subcamp_color\""; $pause_fc="$subcamp_font";}
			else {$pause_sh=''; $pause_fc='BLACK';}
		if ($sh=='listmix') {$listmix_sh="bgcolor=\"$subcamp_color\""; $listmix_fc="$subcamp_font";}
			else {$listmix_sh=''; $listmix_fc='BLACK';}

		?>
		<TR BGCOLOR=<?=$campaigns_color ?>>
		<TD ALIGN=LEFT <?=$list_sh ?>> &nbsp; <a href="<? echo $ADMIN ?>?ADD=10"><FONT FACE="ARIAL,HELVETICA" COLOR=<?=$list_fc ?> SIZE=<?=$subcamp_font_size ?>>Κύρια Καμπάνιες</a></TD>
		</TR><TR BGCOLOR=<?=$campaigns_color ?>>
		<TD ALIGN=LEFT <?=$status_sh ?>> &nbsp; <a href="<? echo $ADMIN ?>?ADD=32"><FONT FACE="ARIAL,HELVETICA" COLOR=<?=$status_fc ?> SIZE=<?=$subcamp_font_size ?>>Καθεστώτων</a></TD>
		</TR><TR BGCOLOR=<?=$campaigns_color ?>>
		<TD ALIGN=LEFT <?=$hotkey_sh ?>> &nbsp; <a href="<? echo $ADMIN ?>?ADD=33"><FONT FACE="ARIAL,HELVETICA" COLOR=<?=$hotkey_fc ?> SIZE=<?=$subcamp_font_size ?>>HotKeys</a></TD>
		<?
		if ($SSoutbound_autodial_active > 0)
			{
			?>
			</TR><TR BGCOLOR=<?=$campaigns_color ?>>
			<TD ALIGN=LEFT <?=$recycle_sh ?>> &nbsp; <a href="<? echo $ADMIN ?>?ADD=35"><FONT FACE="ARIAL,HELVETICA" COLOR=<?=$recycle_fc ?> SIZE=<?=$subcamp_font_size ?>>Μόλυβδος Ανακύκλωσης</a></TD>
			</TR><TR BGCOLOR=<?=$campaigns_color ?>>
			<TD ALIGN=LEFT <?=$autoalt_sh ?>> &nbsp; <a href="<? echo $ADMIN ?>?ADD=36"><FONT FACE="ARIAL,HELVETICA" COLOR=<?=$autoalt_fc ?> SIZE=<?=$subcamp_font_size ?>>Auto-Alt Dial</a></TD>
			</TR><TR BGCOLOR=<?=$campaigns_color ?>>
			<TD ALIGN=LEFT <?=$listmix_sh ?>> &nbsp; <a href="<? echo $ADMIN ?>?ADD=39"><FONT FACE="ARIAL,HELVETICA" COLOR=<?=$listmix_fc ?> SIZE=<?=$subcamp_font_size ?>>Κατάλογος Mix</a></TD>
			<?
			}
		?>
		</TR><TR BGCOLOR=<?=$campaigns_color ?>>
		<TD ALIGN=LEFT <?=$pause_sh ?>> &nbsp; <a href="<? echo $ADMIN ?>?ADD=37"><FONT FACE="ARIAL,HELVETICA" COLOR=<?=$pause_fc ?> SIZE=<?=$subcamp_font_size ?>>Παύση Κώδικες</a></TD>
	<? } 
	?>
	<!-- ΛΙΣΤΕΣ NAVIGATION -->
	<?
	if ($SSoutbound_autodial_active > 0)
		{
		?>
		<TR><TD ALIGN=LEFT <?=$lists_hh ?>><a href="<? echo $ADMIN ?>?ADD=100"><FONT FACE="ARIAL,HELVETICA" COLOR=<?=$lists_fc ?> SIZE=<?=$header_font_size ?>><?=$lists_bold ?>Λίστες</a></TD></TR>
		<?
		if (strlen($lists_hh) > 1) { 
			?>
		<TR BGCOLOR=<?=$lists_color ?>><TD ALIGN=LEFT> &nbsp; 
		<a href="<? echo $ADMIN ?>?ADD=100"><FONT FACE="ARIAL,HELVETICA" COLOR=BLACK SIZE=<?=$subheader_font_size ?>> Παρουσιάστε καταλόγους </a>
		</TR><TR BGCOLOR=<?=$lists_color ?>><TD ALIGN=LEFT> &nbsp; 
		<a href="<? echo $ADMIN ?>?ADD=111"><FONT FACE="ARIAL,HELVETICA" COLOR=BLACK SIZE=<?=$subheader_font_size ?>> Προσθέστε έναν νέο κατάλογο </a>
		</TR><TR BGCOLOR=<?=$lists_color ?>><TD ALIGN=LEFT> &nbsp; 
		<a href="admin_search_lead.php"><FONT FACE="ARIAL,HELVETICA" COLOR=BLACK SIZE=<?=$subheader_font_size ?>> Αναζήτηση ενός μολύβδου </a>
		</TR><TR BGCOLOR=<?=$lists_color ?>><TD ALIGN=LEFT> &nbsp; 
		<a href="<? echo $ADMIN ?>?ADD=121"><FONT FACE="ARIAL,HELVETICA" COLOR=BLACK SIZE=<?=$subheader_font_size ?>> Προσθέστε τον αριθμό σε DNC </a>
		</TR><TR BGCOLOR=<?=$lists_color ?>><TD ALIGN=LEFT> &nbsp; 
		<a href="./new_listloader_superL.php"><FONT FACE="ARIAL,HELVETICA" COLOR=BLACK SIZE=<?=$subheader_font_size ?>> Νέοι μόλυβδοι φορτίων </a>
		</TD></TR>
		<? } 
		}
	?>
	<!-- ΒΟΗΘΟΙ NAVIGATION -->
	<TR><TD <?=$scripts_hh ?>>
	<a href="<? echo $ADMIN ?>?ADD=1000000"><FONT FACE="ARIAL,HELVETICA" COLOR=<?=$scripts_fc ?> SIZE=<?=$header_font_size ?>><?=$scripts_bold ?> Χειρόγραφα </a>
	</TD></TR>
	<?
	if (strlen($scripts_hh) > 1) 
		{ 
		?>
		<TR BGCOLOR=<?=$scripts_color ?>><TD ALIGN=LEFT> &nbsp; 
		<a href="<? echo $ADMIN ?>?ADD=1000000"><FONT FACE="ARIAL,HELVETICA" COLOR=BLACK SIZE=<?=$subheader_font_size ?>> Παρουσιάστε χειρόγραφα </a>
		</TR><TR BGCOLOR=<?=$scripts_color ?>><TD ALIGN=LEFT> &nbsp; 
		<a href="<? echo $ADMIN ?>?ADD=1111111"><FONT FACE="ARIAL,HELVETICA" COLOR=BLACK SIZE=<?=$subheader_font_size ?>> Προσθέστε ένα νέο χειρόγραφο </a>
		</TD></TR>
		<? } 
	?>
	<!-- ΦΙΛΤΡΑ NAVIGATION -->
	<?
	if ($SSoutbound_autodial_active > 0)
		{
		?>
		<TR><TD ALIGN=LEFT <?=$filters_hh ?>><a href="<? echo $ADMIN ?>?ADD=10000000"><FONT FACE="ARIAL,HELVETICA" COLOR=<?=$filters_fc ?> SIZE=<?=$header_font_size ?>><?=$filters_bold ?> Φίλτρα </a></TD></TR>
		<?
		if (strlen($filters_hh) > 1) 
			{ 
			?>
		<TR BGCOLOR=<?=$filters_color ?>><TD ALIGN=LEFT> &nbsp; 
		<a href="<? echo $ADMIN ?>?ADD=10000000"><FONT FACE="ARIAL,HELVETICA" COLOR=BLACK SIZE=<?=$subheader_font_size ?>> Παρουσιάστε φίλτρα </a>
		</TR><TR BGCOLOR=<?=$filters_color ?>><TD ALIGN=LEFT> &nbsp; 
		<a href="<? echo $ADMIN ?>?ADD=11111111"><FONT FACE="ARIAL,HELVETICA" COLOR=BLACK SIZE=<?=$subheader_font_size ?>> Προσθέστε ένα νέο φίλτρο </a>
		</TD></TR>
		<? } 
		}
	?>
	<!-- INGROUPS NAVIGATION -->
	<TR><TD <?=$ingroups_hh ?>>
	<a href="<? echo $ADMIN ?>?ADD=1000"><FONT FACE="ARIAL,HELVETICA" COLOR=<?=$ingroups_fc ?> SIZE=<?=$header_font_size ?>><?=$ingroups_bold ?> $$$-ΟΜΑΔΕΣ </a>
	</TD></TR>
	<?
	if (strlen($ingroups_hh) > 1) 
		{ 
		?>
		<TR BGCOLOR=<?=$ingroups_color ?>><TD ALIGN=LEFT> &nbsp; 
		<a href="<? echo $ADMIN ?>?ADD=1000"><FONT FACE="ARIAL,HELVETICA" COLOR=BLACK SIZE=<?=$subheader_font_size ?>> Παρουσιάστε-ΟΜΑΔΕΣ </a>
		</TR><TR BGCOLOR=<?=$ingroups_color ?>><TD ALIGN=LEFT> &nbsp; 
		<a href="<? echo $ADMIN ?>?ADD=1111"><FONT FACE="ARIAL,HELVETICA" COLOR=BLACK SIZE=<?=$subheader_font_size ?>> Προσθέστε μια νέα-ΟΜΑΔΑ </a>
		</TR><TR BGCOLOR=<?=$ingroups_color ?>><TD ALIGN=LEFT> &nbsp; 
		<a href="<? echo $ADMIN ?>?ADD=1211"><FONT FACE="ARIAL,HELVETICA" COLOR=BLACK SIZE=<?=$subheader_font_size ?>> $$$-ΟΜΑΔΑ αντιγράφων </a>
		</TR><TR BGCOLOR=<?=$ingroups_color ?>><TD ALIGN=LEFT> &nbsp; 
		<a href="<? echo $ADMIN ?>?ADD=1300"><FONT FACE="ARIAL,HELVETICA" COLOR=BLACK SIZE=<?=$subheader_font_size ?>> Δείτε DIDs </a>
		</TR><TR BGCOLOR=<?=$ingroups_color ?>><TD ALIGN=LEFT> &nbsp; 
		<a href="<? echo $ADMIN ?>?ADD=1311"><FONT FACE="ARIAL,HELVETICA" COLOR=BLACK SIZE=<?=$subheader_font_size ?>> Προστίθεται ένα νέο DID </a>
		</TR><TR BGCOLOR=<?=$ingroups_color ?>><TD ALIGN=LEFT> &nbsp; 
		<a href="<? echo $ADMIN ?>?ADD=1411"><FONT FACE="ARIAL,HELVETICA" COLOR=BLACK SIZE=<?=$subheader_font_size ?>> ΑντιγραφήDID </a>
		</TD></TR>
		<? } 
		?>
	<!-- USERGROUPS NAVIGATION -->
	<TR><TD <?=$usergroups_hh ?>>
	<a href="<? echo $ADMIN ?>?ADD=100000"><FONT FACE="ARIAL,HELVETICA" COLOR=<?=$usergroups_fc ?> SIZE=<?=$header_font_size ?>><?=$usergroups_bold ?> Ομάδες χρηστών </a>
	</TD></TR>
	<?
	if (strlen($usergroups_hh) > 1)
		{ 
		?>
		<TR BGCOLOR=<?=$usergroups_color ?>><TD ALIGN=LEFT> &nbsp; 
		<a href="<? echo $ADMIN ?>?ADD=100000"><FONT FACE="ARIAL,HELVETICA" COLOR=BLACK SIZE=<?=$subheader_font_size ?>> Παρουσιάστε ομάδες χρηστών </a>
		</TR><TR BGCOLOR=<?=$usergroups_color ?>><TD ALIGN=LEFT> &nbsp; 
		<a href="<? echo $ADMIN ?>?ADD=111111"><FONT FACE="ARIAL,HELVETICA" COLOR=BLACK SIZE=<?=$subheader_font_size ?>> Προσθέστε μια νέα ομάδα χρηστών </a>
		</TR><TR BGCOLOR=<?=$usergroups_color ?>><TD ALIGN=LEFT> &nbsp; 
		<a href="group_hourly_stats.php"><FONT FACE="ARIAL,HELVETICA" COLOR=BLACK SIZE=<?=$subheader_font_size ?>> Ωριαία έκθεση ομάδας </a>
		</TR><TR BGCOLOR=<?=$usergroups_color ?>><TD ALIGN=LEFT> &nbsp; 
		<a href="user_group_bulk_change.php"><FONT FACE="ARIAL,HELVETICA" COLOR=BLACK SIZE=<?=$subheader_font_size ?>> Μαζική Αλλαγή ομάδας </a>
		</TD></TR>
		<? } 
	?>
	<!-- REMOTEAGENTS NAVIGATION -->
	<TR><TD <?=$remoteagent_hh ?>>
	<a href="<? echo $ADMIN ?>?ADD=10000"><FONT FACE="ARIAL,HELVETICA" COLOR=<?=$remoteagent_fc ?> SIZE=<?=$header_font_size ?>><?=$remoteagent_bold ?> Μακρινοί πράκτορες </a>
	</TD></TR>
	<?
	if (strlen($remoteagent_hh) > 1) 
		{ 
		?>
		<TR BGCOLOR=<?=$remoteagent_color ?>><TD ALIGN=LEFT> &nbsp; 
		<a href="<? echo $ADMIN ?>?ADD=10000"><FONT FACE="ARIAL,HELVETICA" COLOR=BLACK SIZE=<?=$subheader_font_size ?>> Παρουσιάστε μακρινούς πράκτορες </a>
		</TR><TR BGCOLOR=<?=$remoteagent_color ?>><TD ALIGN=LEFT> &nbsp; 
		<a href="<? echo $ADMIN ?>?ADD=11111"><FONT FACE="ARIAL,HELVETICA" COLOR=BLACK SIZE=<?=$subheader_font_size ?>> Προσθέστε τους νέους μακρινούς πράκτορες </a>
		</TD></TR>
	<? } 
	?>
	<!-- ADMIN NAVIGATION -->
	<TR><TD <?=$admin_hh ?>>
	<a href="<? echo $ADMIN ?>?ADD=10000000000"><FONT FACE="ARIAL,HELVETICA" COLOR=<?=$admin_fc ?> SIZE=<?=$header_font_size ?>><?=$admin_bold ?> Admin </a>
	</TD></TR>
	<?
	if (strlen($admin_hh) > 1) 
		{ 
		if ($sh=='times') {$times_sh="bgcolor=\"$times_color\""; $times_fc="$times_font";} # pink
			else {$times_sh=''; $times_fc='BLACK';}
		if ($sh=='shifts') {$shifts_sh="bgcolor=\"$shifts_color\""; $shifts_fc="$shifts_font";} # pink
			else {$shifts_sh=''; $shifts_fc='BLACK';}
		if ($sh=='templates') {$templates_sh="bgcolor=\"$templates_color\""; $templates_fc="$templates_font";} # pink
			else {$templates_sh=''; $templates_fc='BLACK';}
		if ($sh=='carriers') {$carriers_sh="bgcolor=\"$carriers_color\""; $carriers_fc="$carriers_font";} # pink
			else {$carriers_sh=''; $carriers_fc='BLACK';}
		if ($sh=='phones') {$phones_sh="bgcolor=\"$server_color\""; $phones_fc="$phones_font";} # pink
			else {$phones_sh=''; $phones_fc='BLACK';}
		if ($sh=='server') {$server_sh="bgcolor=\"$server_color\""; $server_fc="$server_font";} # pink
			else {$server_sh=''; $server_fc='BLACK';}
		if ($sh=='conference') {$conference_sh="bgcolor=\"$server_color\""; $conference_fc="$server_font";} # pink
			else {$conference_sh=''; $conference_fc='BLACK';}
		if ($sh=='settings') {$settings_sh="bgcolor=\"$settings_color\""; $settings_fc="$settings_font";} # pink
			else {$settings_sh=''; $settings_fc='BLACK';}
		if ($sh=='status') {$status_sh="bgcolor=\"$status_color\""; $status_fc="$status_font";} # pink
			else {$status_sh=''; $status_fc='BLACK';}

		?>
		<TR BGCOLOR=<?=$admin_color ?>>
		<TD ALIGN=LEFT <?=$times_sh ?> COLSPAN=2> &nbsp; 
		<a href="<? echo $ADMIN ?>?ADD=100000000"><FONT FACE="ARIAL,HELVETICA" COLOR=<?=$times_fc ?> SIZE=<?=$header_font_size ?>> Χρόνοι κλήσης </a></TD>
		</TR><TR BGCOLOR=<?=$admin_color ?>><TD ALIGN=LEFT <?=$shifts_sh ?>> &nbsp; 
		<a href="<? echo $ADMIN ?>?ADD=130000000"><FONT FACE="ARIAL,HELVETICA" COLOR=<?=$shifts_fc ?> SIZE=<?=$header_font_size ?>> Βάρδιες </a></TD>
		</TR><TR BGCOLOR=<?=$admin_color ?>><TD ALIGN=LEFT <?=$phones_sh ?>> &nbsp; 
		<a href="<? echo $ADMIN ?>?ADD=10000000000"><FONT FACE="ARIAL,HELVETICA" COLOR=<?=$phones_fc ?> SIZE=<?=$header_font_size ?>> Τηλέφωνα </a></TD>
		</TR><TR BGCOLOR=<?=$admin_color ?>><TD ALIGN=LEFT <?=$templates_sh ?>> &nbsp; 
		<a href="<? echo $ADMIN ?>?ADD=130000000000"><FONT FACE="ARIAL,HELVETICA" COLOR=<?=$templates_fc ?> SIZE=<?=$header_font_size ?>> Πρότυπα </a></TD>
		</TR><TR BGCOLOR=<?=$admin_color ?>><TD ALIGN=LEFT <?=$carriers_sh ?>> &nbsp; 
		<a href="<? echo $ADMIN ?>?ADD=140000000000"><FONT FACE="ARIAL,HELVETICA" COLOR=<?=$carriers_fc ?> SIZE=<?=$header_font_size ?>> Carriers </a></TD>
		</TR><TR BGCOLOR=<?=$admin_color ?>><TD ALIGN=LEFT <?=$server_sh ?>> &nbsp; 
		<a href="<? echo $ADMIN ?>?ADD=100000000000"><FONT FACE="ARIAL,HELVETICA" COLOR=<?=$server_fc ?> SIZE=<?=$header_font_size ?>> Κεντρικοί υπολογιστές </a></TD>
		</TR><TR BGCOLOR=<?=$admin_color ?>><TD ALIGN=LEFT <?=$conference_sh ?>> &nbsp; 
		<a href="<? echo $ADMIN ?>?ADD=1000000000000"><FONT FACE="ARIAL,HELVETICA" COLOR=<?=$conference_fc ?> SIZE=<?=$header_font_size ?>> Διασκέψεις </a></TD>
		</TR><TR BGCOLOR=<?=$admin_color ?>><TD ALIGN=LEFT <?=$settings_sh ?>> &nbsp; 
		<a href="<? echo $ADMIN ?>?ADD=311111111111111"><FONT FACE="ARIAL,HELVETICA" COLOR=<?=$settings_fc ?> SIZE=<?=$header_font_size ?>> Τοποθετήσεις συστημάτων </a></TD>
		</TR><TR BGCOLOR=<?=$admin_color ?>><TD ALIGN=LEFT <?=$status_sh ?>> &nbsp; 
		<a href="<? echo $ADMIN ?>?ADD=321111111111111"><FONT FACE="ARIAL,HELVETICA" COLOR=<?=$status_fc ?> SIZE=<?=$header_font_size ?>>Θέσεις συστημάτων</a></TD>
		</TR>
		<? }
	?>
	<!-- ΑΝΑΦΟΡΕΣ NAVIGATION -->
	<TR><TD <?=$reports_hh ?>>
	<a href="<? echo $ADMIN ?>?ADD=999999"><FONT FACE="ARIAL,HELVETICA" COLOR=<?=$reports_fc ?> SIZE=<?=$header_font_size ?>><?=$reports_bold ?> Εκθέσεις </a>
	</TD></TR>
	</TABLE>
</TD><TD VALIGN=TOP WIDTH=<?=$page_width ?> BGCOLOR=#D9E6FE>
<!-- END SIDEBAR NAVIGATION -->

<TABLE BGCOLOR=#D9E6FE cellpadding=2 cellspacing=0 WIDTH=<?=$page_width ?> HEIGHT=15>
<TR BGCOLOR=#015B91><TD ALIGN=LEFT BGCOLOR=#015B91><FONT FACE="ARIAL,HELVETICA" COLOR=WHITE SIZE=2><B><a href="<? echo $admin_home_url_LU ?>"><FONT FACE="ARIAL,HELVETICA" COLOR=WHITE SIZE=1>ΣΠΙΤΙ</a> | <A HREF="../agc/timeclock.php?referrer=admin"><FONT FACE="ARIAL,HELVETICA" COLOR=WHITE SIZE=1>Ώρα ρολόι</A> | <a href="<? echo $ADMIN ?>?force_logout=1"><FONT FACE="ARIAL,HELVETICA" COLOR=WHITE SIZE=1>Αποσύνδεση</a></TD><TD ALIGN=RIGHT><FONT FACE="ARIAL,HELVETICA" COLOR=WHITE SIZE=2><B><? echo date("l F j, Y G:i:s A") ?> &nbsp; </B></TD></TR>

<TR BGCOLOR=#015B91>







</TR>
	<?
	if (strlen($list_sh) > 1) { 
		?>
	<TR BGCOLOR=<?=$subcamp_color ?>><TD ALIGN=LEFT COLSPAN=2><FONT FACE="ARIAL,HELVETICA" COLOR=BLACK SIZE=<?=$subcamp_font_size ?>> &nbsp; <a href="<? echo $ADMIN ?>?ADD=10"><FONT FACE="ARIAL,HELVETICA" COLOR=BLACK SIZE=<?=$subcamp_font_size ?>> Παρουσιάστε εκστρατείες </a> &nbsp; &nbsp; | &nbsp; &nbsp; <a href="<? echo $ADMIN ?>?ADD=11"><FONT FACE="ARIAL,HELVETICA" COLOR=BLACK SIZE=<?=$subcamp_font_size ?>> Προσθέστε μια νέα εκστρατεία </a> &nbsp; &nbsp; | &nbsp; &nbsp; <a href="<? echo $ADMIN ?>?ADD=12"><FONT FACE="ARIAL,HELVETICA" COLOR=BLACK SIZE=<?=$subcamp_font_size ?>> Εκστρατεία αντιγράφων </a> &nbsp; &nbsp; | &nbsp; &nbsp; <a href="./AST_timeonVDADallSUMMARY.php"><FONT FACE="ARIAL,HELVETICA" COLOR=BLACK SIZE=<?=$subcamp_font_size ?>> Σε πραγματικό χρόνο περίληψη εκστρατειών </a></TD></TR>
		<? } 

	if (strlen($times_sh) > 1) { 
		?>
	<TR BGCOLOR=<?=$times_color ?>><TD ALIGN=LEFT COLSPAN=2> &nbsp; <a href="<? echo $ADMIN ?>?ADD=100000000"><FONT FACE="ARIAL,HELVETICA" COLOR=BLACK SIZE=<?=$subheader_font_size ?>> Παρουσιάστε χρόνους κλήσης </a> &nbsp;| <a href="<? echo $ADMIN ?>?ADD=111111111"><FONT FACE="ARIAL,HELVETICA" COLOR=BLACK SIZE=<?=$subheader_font_size ?>> Προσθέστε έναν νέο χρόνο κλήσης </a> &nbsp;| <a href="<? echo $ADMIN ?>?ADD=1000000000"><FONT FACE="ARIAL,HELVETICA" COLOR=BLACK SIZE=<?=$subheader_font_size ?>> Παρουσιάστε χρόνους κρατικής κλήσης </a> &nbsp;| <a href="<? echo $ADMIN ?>?ADD=1111111111"><FONT FACE="ARIAL,HELVETICA" COLOR=BLACK SIZE=<?=$subheader_font_size ?>> Προσθέστε έναν νέο χρόνο κρατικής κλήσης </a></TD></TR>
		<? } 
	if (strlen($shifts_sh) > 1) { 
		?>
	<TR BGCOLOR=<?=$shifts_color ?>><TD ALIGN=LEFT COLSPAN=2> &nbsp; <a href="<? echo $ADMIN ?>?ADD=130000000"><FONT FACE="ARIAL,HELVETICA" COLOR=BLACK SIZE=<?=$subheader_font_size ?>> Δείτε Βάρδιες </a> &nbsp;| <a href="<? echo $ADMIN ?>?ADD=131111111"><FONT FACE="ARIAL,HELVETICA" COLOR=BLACK SIZE=<?=$subheader_font_size ?>> Προστίθεται ένα νέο Shift </a></TD></TR>
		<? } 
	if (strlen($phones_sh) > 1) { 
		?>
	<TR BGCOLOR=<?=$phones_color ?>><TD ALIGN=LEFT COLSPAN=2> &nbsp; <a href="<? echo $ADMIN ?>?ADD=10000000000"><FONT FACE="ARIAL,HELVETICA" COLOR=BLACK SIZE=<?=$subheader_font_size ?>> Παρουσιάστε τηλέφωνα </a>&nbsp;|&nbsp;<a href="<? echo $ADMIN ?>?ADD=11111111111"><FONT FACE="ARIAL,HELVETICA" COLOR=BLACK SIZE=<?=$subheader_font_size ?>> Προσθέστε ένα νέο τηλέφωνο </a>&nbsp;|&nbsp;<a href="<? echo $ADMIN ?>?ADD=12000000000"><FONT FACE="ARIAL,HELVETICA" COLOR=BLACK SIZE=<?=$subheader_font_size ?>> Τηλέφωνο Γνωστός Κατάλογος </a>&nbsp;|&nbsp;<a href="<? echo $ADMIN ?>?ADD=12111111111"><FONT FACE="ARIAL,HELVETICA" COLOR=BLACK SIZE=<?=$subheader_font_size ?>> Προστίθεται ένα νέο τηλέφωνο Γνωστός </a>&nbsp;|&nbsp;<a href="<? echo $ADMIN ?>?ADD=13000000000"><FONT FACE="ARIAL,HELVETICA" COLOR=BLACK SIZE=<?=$subheader_font_size ?>> Ομάδα Γνωστός Κατάλογος </a>&nbsp;|&nbsp;<a href="<? echo $ADMIN ?>?ADD=13111111111"><FONT FACE="ARIAL,HELVETICA" COLOR=BLACK SIZE=<?=$subheader_font_size ?>> Προσθέστε μια νέα ομάδα Γνωστός </a></TD></TR>
		<? }
	if (strlen($conference_sh) > 1) { 
		?>
	<TR BGCOLOR=<?=$conference_color ?>><TD ALIGN=LEFT COLSPAN=2> &nbsp; <a href="<? echo $ADMIN ?>?ADD=1000000000000"><FONT FACE="ARIAL,HELVETICA" COLOR=BLACK SIZE=<?=$subheader_font_size ?>> Παρουσιάστε διασκέψεις </a> &nbsp; | &nbsp; <a href="<? echo $ADMIN ?>?ADD=1111111111111"><FONT FACE="ARIAL,HELVETICA" COLOR=BLACK SIZE=<?=$subheader_font_size ?>> Προσθέστε μια νέα διάσκεψη </a> &nbsp; | &nbsp; <a href="<? echo $ADMIN ?>?ADD=10000000000000"><FONT FACE="ARIAL,HELVETICA" COLOR=BLACK SIZE=<?=$subheader_font_size ?>> Παρουσιάστε διασκέψεις VICIDIAL </a> &nbsp; | &nbsp; <a href="<? echo $ADMIN ?>?ADD=11111111111111"><FONT FACE="ARIAL,HELVETICA" COLOR=BLACK SIZE=<?=$subheader_font_size ?>> Προσθέστε μια νέα διάσκεψη VICIDIAL </a></TD></TR>
		<? }
	if ( (strlen($server_sh) > 1) and (strlen($admin_hh) > 1) ) { 
		?>
	<TR BGCOLOR=<?=$server_color ?>><TD ALIGN=LEFT COLSPAN=2> &nbsp; <a href="<? echo $ADMIN ?>?ADD=100000000000"><FONT FACE="ARIAL,HELVETICA" COLOR=BLACK SIZE=<?=$subheader_font_size ?>> Παρουσιάστε κεντρικούς υπολογιστές </a> &nbsp; | &nbsp; <a href="<? echo $ADMIN ?>?ADD=111111111111"><FONT FACE="ARIAL,HELVETICA" COLOR=BLACK SIZE=<?=$subheader_font_size ?>> Προσθέστε έναν νέο κεντρικό υπολογιστή </a></TD></TR>
	<?}
	if ( (strlen($templates_sh) > 1) and (strlen($admin_hh) > 1) ) { 
		?>
	<TR BGCOLOR=<?=$templates_color ?>><TD ALIGN=LEFT COLSPAN=2> &nbsp; <a href="<? echo $ADMIN ?>?ADD=130000000000"><FONT FACE="ARIAL,HELVETICA" COLOR=BLACK SIZE=<?=$subheader_font_size ?>> Δείτε Πρότυπα </a> &nbsp; | &nbsp; <a href="<? echo $ADMIN ?>?ADD=131111111111"><FONT FACE="ARIAL,HELVETICA" COLOR=BLACK SIZE=<?=$subheader_font_size ?>> Προσθέστε ένα νέο πρότυπο </a></TD></TR>
	<?}
	if ( (strlen($carriers_sh) > 1) and (strlen($admin_hh) > 1) ) { 
		?>
	<TR BGCOLOR=<?=$carriers_color ?>><TD ALIGN=LEFT COLSPAN=2> &nbsp; <a href="<? echo $ADMIN ?>?ADD=140000000000"><FONT FACE="ARIAL,HELVETICA" COLOR=BLACK SIZE=<?=$subheader_font_size ?>> Show Carriers </a> &nbsp; | &nbsp; <a href="<? echo $ADMIN ?>?ADD=141111111111"><FONT FACE="ARIAL,HELVETICA" COLOR=BLACK SIZE=<?=$subheader_font_size ?>> Add A New Carrier </a></TD></TR>
	<?}
	if (strlen($settings_sh) > 1) { 
		?>
	<TR BGCOLOR=<?=$settings_color ?>><TD ALIGN=LEFT COLSPAN=2> &nbsp; <a href="<? echo $ADMIN ?>?ADD=311111111111111"><FONT FACE="ARIAL,HELVETICA" COLOR=BLACK SIZE=<?=$subheader_font_size ?>> Τοποθετήσεις συστημάτων </a></TD></TR>
	<?}
	if ( (strlen($status_sh) > 1) and (!eregi('campaign',$hh) ) ) { 
		?>
	<TR BGCOLOR=<?=$status_color ?>><TD ALIGN=LEFT COLSPAN=2> &nbsp; <a href="<? echo $ADMIN ?>?ADD=321111111111111"><FONT FACE="ARIAL,HELVETICA" COLOR=BLACK SIZE=<?=$subheader_font_size ?>>Θέσεις συστημάτων</a> &nbsp; | &nbsp; <a href="<? echo $ADMIN ?>?ADD=331111111111111"><FONT FACE="ARIAL,HELVETICA" COLOR=BLACK SIZE=<?=$subheader_font_size ?>>Κατηγορίες θέσης</a> &nbsp; | &nbsp; <a href="<? echo $ADMIN ?>?ADD=341111111111111"><FONT FACE="ARIAL,HELVETICA" COLOR=BLACK SIZE=<?=$subheader_font_size ?>>QC κωδικοί</a></TD></TR>
	<?}

	if ( ($ADD=='3') or ($ADD=='3') ) { 
		?>
	<TR BGCOLOR=<?=$users_color ?>><TD ALIGN=LEFT COLSPAN=2> &nbsp; <a href="./user_stats.php?user=<?=$user ?>"><FONT FACE="ARIAL,HELVETICA" COLOR=BLACK SIZE=<?=$subheader_font_size ?>>Στατιστικά Χρήστη </a> &nbsp; | &nbsp; <a href="./user_status.php?user=<?=$user ?>"><FONT FACE="ARIAL,HELVETICA" COLOR=BLACK SIZE=<?=$subheader_font_size ?>>Κατάσταση χρήστη </a> &nbsp; | &nbsp; <a href="./AST_agent_time_sheet.php?agent=<?=$user ?>"><FONT FACE="ARIAL,HELVETICA" COLOR=BLACK SIZE=<?=$subheader_font_size ?>>Ώρα Φύλλο </a> &nbsp; | &nbsp; <a href="./AST_agent_days_detail.php?user=<?=$user ?>"><FONT FACE="ARIAL,HELVETICA" COLOR=BLACK SIZE=<?=$subheader_font_size ?>>Ημέρες Status </a></TD></TR>
	<?}


### Do nothing if admin has no permissions
if($LOGast_admin_access < 1) 
	{
	$ADD='99999999999999999999';
	echo "</TABLE></center>\n";
	echo "Δεν έχετε το δικαίωμα για να δείτε την σελίδα. Παρακαλώ επιστρέψτε.\n";
	}

if (strlen($reports_hh) > 1) { 
	?>
<TR BGCOLOR=<?=$reports_color ?>><TD ALIGN=LEFT COLSPAN=2><FONT FACE="ARIAL,HELVETICA" COLOR=BLACK SIZE=<?=$subheader_font_size ?>><B> &nbsp; </B></TD></TR>
<? } ?>


<TR><TD ALIGN=LEFT COLSPAN=2 HEIGHT=2 BGCOLOR=#015B91></TD></TR>
<TR><TD ALIGN=LEFT COLSPAN=2>
<? 
######################### FULL HTML HEADER END #######################################
}
