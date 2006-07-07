<?
# admin.php - astGUIclient administration script
# 
# Copyright (C) 2006  Matt Florell <vicidial@gmail.com>    LICENSE: GPLv2
#
# AST GUI database administration
# 
# CHANGES
# 50913-1118 - Added outbound_cid for web-client calls
# 50926-1356 - Modified to allow for language translation
# 50926-1613 - Added WeBRooTWritablE write controls
# 51128-1254 - Modified to allow PHP global vars off
# 51208-2120 - Added option to login with vicidial_user login if allowed
# 51213-1650 - Added option to delete phones if allowed by vicidial_users
# 60421-1430 - check GET/POST vars lines with isset to not trigger PHP NOTICES
# 60427-1137 - Fixed phone search bug
# 60620-1243 - Added variable filtering to eliminate SQL injection attack threat
#

$version = '1.1.12';
$build = '60620-1243';

require("dbconnect.php");

$PHP_AUTH_USER=$_SERVER['PHP_AUTH_USER'];
$PHP_AUTH_PW=$_SERVER['PHP_AUTH_PW'];
$PHP_SELF=$_SERVER['PHP_SELF'];
if (isset($_GET["ADD"]))				{$ADD=$_GET["ADD"];}
	elseif (isset($_POST["ADD"]))		{$ADD=$_POST["ADD"];}
if (isset($_GET["user"]))				{$user=$_GET["user"];}
	elseif (isset($_POST["user"]))		{$user=$_POST["user"];}
if (isset($_GET["pass"]))				{$pass=$_GET["pass"];}
	elseif (isset($_POST["pass"]))		{$pass=$_POST["pass"];}
if (isset($_GET["full_name"]))				{$full_name=$_GET["full_name"];}
	elseif (isset($_POST["full_name"]))		{$full_name=$_POST["full_name"];}
if (isset($_GET["status"]))				{$status=$_GET["status"];}
	elseif (isset($_POST["status"]))		{$status=$_POST["status"];}
if (isset($_GET["server_ip"]))				{$server_ip=$_GET["server_ip"];}
	elseif (isset($_POST["server_ip"]))		{$server_ip=$_POST["server_ip"];}
if (isset($_GET["server_id"]))				{$server_id=$_GET["server_id"];}
	elseif (isset($_POST["server_id"]))		{$server_id=$_POST["server_id"];}
if (isset($_GET["extension"]))				{$extension=$_GET["extension"];}
	elseif (isset($_POST["extension"]))		{$extension=$_POST["extension"];}
if (isset($_GET["dialplan_number"]))				{$dialplan_number=$_GET["dialplan_number"];}
	elseif (isset($_POST["dialplan_number"]))		{$dialplan_number=$_POST["dialplan_number"];}
if (isset($_GET["voicemail_id"]))				{$voicemail_id=$_GET["voicemail_id"];}
	elseif (isset($_POST["voicemail_id"]))		{$voicemail_id=$_POST["voicemail_id"];}
if (isset($_GET["phone_ip"]))				{$phone_ip=$_GET["phone_ip"];}
	elseif (isset($_POST["phone_ip"]))		{$phone_ip=$_POST["phone_ip"];}
if (isset($_GET["computer_ip"]))				{$computer_ip=$_GET["computer_ip"];}
	elseif (isset($_POST["computer_ip"]))		{$computer_ip=$_POST["computer_ip"];}
if (isset($_GET["login"]))				{$login=$_GET["login"];}
	elseif (isset($_POST["login"]))		{$login=$_POST["login"];}
if (isset($_GET["active"]))				{$active=$_GET["active"];}
	elseif (isset($_POST["active"]))		{$active=$_POST["active"];}
if (isset($_GET["phone_type"]))				{$phone_type=$_GET["phone_type"];}
	elseif (isset($_POST["phone_type"]))		{$phone_type=$_POST["phone_type"];}
if (isset($_GET["fullname"]))				{$fullname=$_GET["fullname"];}
	elseif (isset($_POST["fullname"]))		{$fullname=$_POST["fullname"];}
if (isset($_GET["company"]))				{$company=$_GET["company"];}
	elseif (isset($_POST["company"]))		{$company=$_POST["company"];}
if (isset($_GET["picture"]))				{$picture=$_GET["picture"];}
	elseif (isset($_POST["picture"]))		{$picture=$_POST["picture"];}
if (isset($_GET["protocol"]))				{$protocol=$_GET["protocol"];}
	elseif (isset($_POST["protocol"]))		{$protocol=$_POST["protocol"];}
if (isset($_GET["local_gmt"]))				{$local_gmt=$_GET["local_gmt"];}
	elseif (isset($_POST["local_gmt"]))		{$local_gmt=$_POST["local_gmt"];}
if (isset($_GET["ASTmgrUSERNAME"]))				{$ASTmgrUSERNAME=$_GET["ASTmgrUSERNAME"];}
	elseif (isset($_POST["ASTmgrUSERNAME"]))		{$ASTmgrUSERNAME=$_POST["ASTmgrUSERNAME"];}
if (isset($_GET["ASTmgrSECRET"]))				{$ASTmgrSECRET=$_GET["ASTmgrSECRET"];}
	elseif (isset($_POST["ASTmgrSECRET"]))		{$ASTmgrSECRET=$_POST["ASTmgrSECRET"];}
if (isset($_GET["login_user"]))				{$login_user=$_GET["login_user"];}
	elseif (isset($_POST["login_user"]))		{$login_user=$_POST["login_user"];}
if (isset($_GET["login_pass"]))				{$login_pass=$_GET["login_pass"];}
	elseif (isset($_POST["login_pass"]))		{$login_pass=$_POST["login_pass"];}
if (isset($_GET["login_campaign"]))				{$login_campaign=$_GET["login_campaign"];}
	elseif (isset($_POST["login_campaign"]))		{$login_campaign=$_POST["login_campaign"];}
if (isset($_GET["park_on_extension"]))				{$park_on_extension=$_GET["park_on_extension"];}
	elseif (isset($_POST["park_on_extension"]))		{$park_on_extension=$_POST["park_on_extension"];}
if (isset($_GET["conf_on_extension"]))				{$conf_on_extension=$_GET["conf_on_extension"];}
	elseif (isset($_POST["conf_on_extension"]))		{$conf_on_extension=$_POST["conf_on_extension"];}
if (isset($_GET["VICIDIAL_park_on_extension"]))				{$VICIDIAL_park_on_extension=$_GET["VICIDIAL_park_on_extension"];}
	elseif (isset($_POST["VICIDIAL_park_on_extension"]))		{$VICIDIAL_park_on_extension=$_POST["VICIDIAL_park_on_extension"];}
if (isset($_GET["VICIDIAL_park_on_filename"]))				{$VICIDIAL_park_on_filename=$_GET["VICIDIAL_park_on_filename"];}
	elseif (isset($_POST["VICIDIAL_park_on_filename"]))		{$VICIDIAL_park_on_filename=$_POST["VICIDIAL_park_on_filename"];}
if (isset($_GET["monitor_prefix"]))				{$monitor_prefix=$_GET["monitor_prefix"];}
	elseif (isset($_POST["monitor_prefix"]))		{$monitor_prefix=$_POST["monitor_prefix"];}
if (isset($_GET["recording_exten"]))				{$recording_exten=$_GET["recording_exten"];}
	elseif (isset($_POST["recording_exten"]))		{$recording_exten=$_POST["recording_exten"];}
if (isset($_GET["voicemail_exten"]))				{$voicemail_exten=$_GET["voicemail_exten"];}
	elseif (isset($_POST["voicemail_exten"]))		{$voicemail_exten=$_POST["voicemail_exten"];}
if (isset($_GET["voicemail_dump_exten"]))				{$voicemail_dump_exten=$_GET["voicemail_dump_exten"];}
	elseif (isset($_POST["voicemail_dump_exten"]))		{$voicemail_dump_exten=$_POST["voicemail_dump_exten"];}
if (isset($_GET["ext_context"]))				{$ext_context=$_GET["ext_context"];}
	elseif (isset($_POST["ext_context"]))		{$ext_context=$_POST["ext_context"];}
if (isset($_GET["dtmf_send_extension"]))				{$dtmf_send_extension=$_GET["dtmf_send_extension"];}
	elseif (isset($_POST["dtmf_send_extension"]))		{$dtmf_send_extension=$_POST["dtmf_send_extension"];}
if (isset($_GET["call_out_number_group"]))				{$call_out_number_group=$_GET["call_out_number_group"];}
	elseif (isset($_POST["call_out_number_group"]))		{$call_out_number_group=$_POST["call_out_number_group"];}
if (isset($_GET["client_browser"]))				{$client_browser=$_GET["client_browser"];}
	elseif (isset($_POST["client_browser"]))		{$client_browser=$_POST["client_browser"];}
if (isset($_GET["install_directory"]))				{$install_directory=$_GET["install_directory"];}
	elseif (isset($_POST["install_directory"]))		{$install_directory=$_POST["install_directory"];}
if (isset($_GET["local_web_callerID_URL"]))				{$local_web_callerID_URL=$_GET["local_web_callerID_URL"];}
	elseif (isset($_POST["local_web_callerID_URL"]))		{$local_web_callerID_URL=$_POST["local_web_callerID_URL"];}
if (isset($_GET["VICIDIAL_web_URL"]))				{$VICIDIAL_web_URL=$_GET["VICIDIAL_web_URL"];}
	elseif (isset($_POST["VICIDIAL_web_URL"]))		{$VICIDIAL_web_URL=$_POST["VICIDIAL_web_URL"];}
if (isset($_GET["AGI_call_logging_enabled"]))				{$AGI_call_logging_enabled=$_GET["AGI_call_logging_enabled"];}
	elseif (isset($_POST["AGI_call_logging_enabled"]))		{$AGI_call_logging_enabled=$_POST["AGI_call_logging_enabled"];}
if (isset($_GET["user_switching_enabled"]))				{$user_switching_enabled=$_GET["user_switching_enabled"];}
	elseif (isset($_POST["user_switching_enabled"]))		{$user_switching_enabled=$_POST["user_switching_enabled"];}
if (isset($_GET["conferencing_enabled"]))				{$conferencing_enabled=$_GET["conferencing_enabled"];}
	elseif (isset($_POST["conferencing_enabled"]))		{$conferencing_enabled=$_POST["conferencing_enabled"];}
if (isset($_GET["admin_hangup_enabled"]))				{$admin_hangup_enabled=$_GET["admin_hangup_enabled"];}
	elseif (isset($_POST["admin_hangup_enabled"]))		{$admin_hangup_enabled=$_POST["admin_hangup_enabled"];}
if (isset($_GET["admin_hijack_enabled"]))				{$admin_hijack_enabled=$_GET["admin_hijack_enabled"];}
	elseif (isset($_POST["admin_hijack_enabled"]))		{$admin_hijack_enabled=$_POST["admin_hijack_enabled"];}
if (isset($_GET["admin_monitor_enabled"]))				{$admin_monitor_enabled=$_GET["admin_monitor_enabled"];}
	elseif (isset($_POST["admin_monitor_enabled"]))		{$admin_monitor_enabled=$_POST["admin_monitor_enabled"];}
if (isset($_GET["call_parking_enabled"]))				{$call_parking_enabled=$_GET["call_parking_enabled"];}
	elseif (isset($_POST["call_parking_enabled"]))		{$call_parking_enabled=$_POST["call_parking_enabled"];}
if (isset($_GET["updater_check_enabled"]))				{$updater_check_enabled=$_GET["updater_check_enabled"];}
	elseif (isset($_POST["updater_check_enabled"]))		{$updater_check_enabled=$_POST["updater_check_enabled"];}
if (isset($_GET["AFLogging_enabled"]))				{$AFLogging_enabled=$_GET["AFLogging_enabled"];}
	elseif (isset($_POST["AFLogging_enabled"]))		{$AFLogging_enabled=$_POST["AFLogging_enabled"];}
if (isset($_GET["QUEUE_ACTION_enabled"]))				{$QUEUE_ACTION_enabled=$_GET["QUEUE_ACTION_enabled"];}
	elseif (isset($_POST["QUEUE_ACTION_enabled"]))		{$QUEUE_ACTION_enabled=$_POST["QUEUE_ACTION_enabled"];}
if (isset($_GET["CallerID_popup_enabled"]))				{$CallerID_popup_enabled=$_GET["CallerID_popup_enabled"];}
	elseif (isset($_POST["CallerID_popup_enabled"]))		{$CallerID_popup_enabled=$_POST["CallerID_popup_enabled"];}
if (isset($_GET["voicemail_button_enabled"]))				{$voicemail_button_enabled=$_GET["voicemail_button_enabled"];}
	elseif (isset($_POST["voicemail_button_enabled"]))		{$voicemail_button_enabled=$_POST["voicemail_button_enabled"];}
if (isset($_GET["enable_fast_refresh"]))				{$enable_fast_refresh=$_GET["enable_fast_refresh"];}
	elseif (isset($_POST["enable_fast_refresh"]))		{$enable_fast_refresh=$_POST["enable_fast_refresh"];}
if (isset($_GET["fast_refresh_rate"]))				{$fast_refresh_rate=$_GET["fast_refresh_rate"];}
	elseif (isset($_POST["fast_refresh_rate"]))		{$fast_refresh_rate=$_POST["fast_refresh_rate"];}
if (isset($_GET["enable_persistant_mysql"]))				{$enable_persistant_mysql=$_GET["enable_persistant_mysql"];}
	elseif (isset($_POST["enable_persistant_mysql"]))		{$enable_persistant_mysql=$_POST["enable_persistant_mysql"];}
if (isset($_GET["auto_dial_next_number"]))				{$auto_dial_next_number=$_GET["auto_dial_next_number"];}
	elseif (isset($_POST["auto_dial_next_number"]))		{$auto_dial_next_number=$_POST["auto_dial_next_number"];}
if (isset($_GET["VDstop_rec_after_each_call"]))				{$VDstop_rec_after_each_call=$_GET["VDstop_rec_after_each_call"];}
	elseif (isset($_POST["VDstop_rec_after_each_call"]))		{$VDstop_rec_after_each_call=$_POST["VDstop_rec_after_each_call"];}
if (isset($_GET["DBX_server"]))				{$DBX_server=$_GET["DBX_server"];}
	elseif (isset($_POST["DBX_server"]))		{$DBX_server=$_POST["DBX_server"];}
if (isset($_GET["DBX_database"]))				{$DBX_database=$_GET["DBX_database"];}
	elseif (isset($_POST["DBX_database"]))		{$DBX_database=$_POST["DBX_database"];}
if (isset($_GET["DBX_user"]))				{$DBX_user=$_GET["DBX_user"];}
	elseif (isset($_POST["DBX_user"]))		{$DBX_user=$_POST["DBX_user"];}
if (isset($_GET["DBX_pass"]))				{$DBX_pass=$_GET["DBX_pass"];}
	elseif (isset($_POST["DBX_pass"]))		{$DBX_pass=$_POST["DBX_pass"];}
if (isset($_GET["DBX_port"]))				{$DBX_port=$_GET["DBX_port"];}
	elseif (isset($_POST["DBX_port"]))		{$DBX_port=$_POST["DBX_port"];}
if (isset($_GET["DBY_server"]))				{$DBY_server=$_GET["DBY_server"];}
	elseif (isset($_POST["DBY_server"]))		{$DBY_server=$_POST["DBY_server"];}
if (isset($_GET["DBY_database"]))				{$DBY_database=$_GET["DBY_database"];}
	elseif (isset($_POST["DBY_database"]))		{$DBY_database=$_POST["DBY_database"];}
if (isset($_GET["DBY_user"]))				{$DBY_user=$_GET["DBY_user"];}
	elseif (isset($_POST["DBY_user"]))		{$DBY_user=$_POST["DBY_user"];}
if (isset($_GET["DBY_pass"]))				{$DBY_pass=$_GET["DBY_pass"];}
	elseif (isset($_POST["DBY_pass"]))		{$DBY_pass=$_POST["DBY_pass"];}
if (isset($_GET["DBY_port"]))				{$DBY_port=$_GET["DBY_port"];}
	elseif (isset($_POST["DBY_port"]))		{$DBY_port=$_POST["DBY_port"];}
if (isset($_GET["outbound_cid"]))				{$outbound_cid=$_GET["outbound_cid"];}
	elseif (isset($_POST["outbound_cid"]))		{$outbound_cid=$_POST["outbound_cid"];}
if (isset($_GET["old_extension"]))				{$old_extension=$_GET["old_extension"];}
	elseif (isset($_POST["old_extension"]))		{$old_extension=$_POST["old_extension"];}
if (isset($_GET["old_server_ip"]))				{$old_server_ip=$_GET["old_server_ip"];}
	elseif (isset($_POST["old_server_ip"]))		{$old_server_ip=$_POST["old_server_ip"];}
if (isset($_GET["old_server_id"]))				{$old_server_id=$_GET["old_server_id"];}
	elseif (isset($_POST["old_server_id"]))		{$old_server_id=$_POST["old_server_id"];}
if (isset($_GET["server_description"]))				{$server_description=$_GET["server_description"];}
	elseif (isset($_POST["server_description"]))		{$server_description=$_POST["server_description"];}
if (isset($_GET["asterisk_version"]))				{$asterisk_version=$_GET["asterisk_version"];}
	elseif (isset($_POST["asterisk_version"]))		{$asterisk_version=$_POST["asterisk_version"];}
if (isset($_GET["max_vicidial_trunks"]))				{$max_vicidial_trunks=$_GET["max_vicidial_trunks"];}
	elseif (isset($_POST["max_vicidial_trunks"]))		{$max_vicidial_trunks=$_POST["max_vicidial_trunks"];}
if (isset($_GET["telnet_host"]))				{$telnet_host=$_GET["telnet_host"];}
	elseif (isset($_POST["telnet_host"]))		{$telnet_host=$_POST["telnet_host"];}
if (isset($_GET["telnet_port"]))				{$telnet_port=$_GET["telnet_port"];}
	elseif (isset($_POST["telnet_port"]))		{$telnet_port=$_POST["telnet_port"];}
if (isset($_GET["ASTmgrUSERNAMEupdate"]))				{$ASTmgrUSERNAMEupdate=$_GET["ASTmgrUSERNAMEupdate"];}
	elseif (isset($_POST["ASTmgrUSERNAMEupdate"]))		{$ASTmgrUSERNAMEupdate=$_POST["ASTmgrUSERNAMEupdate"];}
if (isset($_GET["ASTmgrUSERNAMElisten"]))				{$ASTmgrUSERNAMElisten=$_GET["ASTmgrUSERNAMElisten"];}
	elseif (isset($_POST["ASTmgrUSERNAMElisten"]))		{$ASTmgrUSERNAMElisten=$_POST["ASTmgrUSERNAMElisten"];}
if (isset($_GET["ASTmgrUSERNAMEsend"]))				{$ASTmgrUSERNAMEsend=$_GET["ASTmgrUSERNAMEsend"];}
	elseif (isset($_POST["ASTmgrUSERNAMEsend"]))		{$ASTmgrUSERNAMEsend=$_POST["ASTmgrUSERNAMEsend"];}
if (isset($_GET["answer_transfer_agent"]))				{$answer_transfer_agent=$_GET["answer_transfer_agent"];}
	elseif (isset($_POST["answer_transfer_agent"]))		{$answer_transfer_agent=$_POST["answer_transfer_agent"];}
if (isset($_GET["conf_exten"]))				{$conf_exten=$_GET["conf_exten"];}
	elseif (isset($_POST["conf_exten"]))		{$conf_exten=$_POST["conf_exten"];}
if (isset($_GET["old_conf_exten"]))				{$old_conf_exten=$_GET["old_conf_exten"];}
	elseif (isset($_POST["old_conf_exten"]))		{$old_conf_exten=$_POST["old_conf_exten"];}
if (isset($_GET["extension"]))				{$extension=$_GET["extension"];}
	elseif (isset($_POST["extension"]))		{$extension=$_POST["extension"];}
if (isset($_GET["submit"]))				{$submit=$_GET["submit"];}
	elseif (isset($_POST["submit"]))		{$submit=$_POST["submit"];}
if (isset($_GET["ENVIAR"]))				{$ENVIAR=$_GET["ENVIAR"];}
	elseif (isset($_POST["ENVIAR"]))		{$ENVIAR=$_POST["ENVIAR"];}
if (isset($_GET["CoNfIrM"]))				{$CoNfIrM=$_GET["CoNfIrM"];}
	elseif (isset($_POST["CoNfIrM"]))		{$CoNfIrM=$_POST["CoNfIrM"];}

##### BEGIN VARIABLE FILTERING FOR SECURITY #####

### DIGITS and Dots
$phone_ip = ereg_replace("[^\.0-9]","",$phone_ip);
$server_ip = ereg_replace("[^\.0-9]","",$server_ip);
$old_server_ip = ereg_replace("[^\.0-9]","",$old_server_ip);
$computer_ip = ereg_replace("[^\.0-9]","",$computer_ip);

### Y or N ONLY ###
$active = ereg_replace("[^NY]","",$active);

### DIGITS ONLY ###
$dialplan_number = ereg_replace("[^0-9]","",$dialplan_number);
$voicemail_id = ereg_replace("[^0-9]","",$voicemail_id);
$outbound_cid = ereg_replace("[^0-9]","",$outbound_cid);
$VICIDIAL_park_on_extension = ereg_replace("[^0-9]","",$VICIDIAL_park_on_extension);
$park_on_extension = ereg_replace("[^0-9]","",$park_on_extension);
$conf_on_extension = ereg_replace("[^0-9]","",$conf_on_extension);
$conf_exten = ereg_replace("[^0-9]","",$conf_exten);
$old_conf_exten = ereg_replace("[^0-9]","",$old_conf_exten);
$voicemail_exten = ereg_replace("[^0-9]","",$voicemail_exten);
$voicemail_dump_exten = ereg_replace("[^0-9]","",$voicemail_dump_exten);
$recording_exten = ereg_replace("[^0-9]","",$recording_exten);
$monitor_prefix = ereg_replace("[^0-9]","",$monitor_prefix);
$answer_transfer_agent = ereg_replace("[^0-9]","",$answer_transfer_agent);
$DBX_port = ereg_replace("[^0-9]","",$DBX_port);
$DBY_port = ereg_replace("[^0-9]","",$DBY_port);
$telnet_port = ereg_replace("[^0-9]","",$telnet_port);
$max_vicidial_trunks = ereg_replace("[^0-9]","",$max_vicidial_trunks);
$auto_dial_next_number = ereg_replace("[^0-9]","",$auto_dial_next_number);
$VDstop_rec_after_each_call = ereg_replace("[^0-9]","",$VDstop_rec_after_each_call);
$enable_persistant_mysql = ereg_replace("[^0-9]","",$enable_persistant_mysql);
$enable_fast_refresh = ereg_replace("[^0-9]","",$enable_fast_refresh);
$user_switching_enabled = ereg_replace("[^0-9]","",$user_switching_enabled);
$updater_check_enabled = ereg_replace("[^0-9]","",$updater_check_enabled);
$QUEUE_ACTION_enabled = ereg_replace("[^0-9]","",$QUEUE_ACTION_enabled);
$conferencing_enabled = ereg_replace("[^0-9]","",$conferencing_enabled);
$voicemail_button_enabled = ereg_replace("[^0-9]","",$voicemail_button_enabled);
$CallerID_popup_enabled = ereg_replace("[^0-9]","",$CallerID_popup_enabled);
$call_parking_enabled = ereg_replace("[^0-9]","",$call_parking_enabled);
$AGI_call_logging_enabled = ereg_replace("[^0-9]","",$AGI_call_logging_enabled);
$AFLogging_enabled = ereg_replace("[^0-9]","",$AFLogging_enabled);
$admin_monitor_enabled = ereg_replace("[^0-9]","",$admin_monitor_enabled);
$admin_hijack_enabled = ereg_replace("[^0-9]","",$admin_hijack_enabled);
$admin_hangup_enabled = ereg_replace("[^0-9]","",$admin_hangup_enabled);
$fast_refresh_rate = ereg_replace("[^0-9]","",$fast_refresh_rate);
$ADD = ereg_replace("[^0-9]","",$ADD);

### ALPHA-NUMERIC and underscore and dash and slash and at and dot
$extension = ereg_replace("[^-\.\:\/\@\_0-9a-zA-Z]","",$extension);
$old_extension = ereg_replace("[^-\.\:\/\@\_0-9a-zA-Z]","",$old_extension);
$install_directory = ereg_replace("[^-\.\:\/\@\_0-9a-zA-Z]","",$install_directory);
$client_browser = ereg_replace("[^-\.\:\/\@\_0-9a-zA-Z]","",$client_browser);
$dtmf_send_extension = ereg_replace("[^-\.\:\/\@\_0-9a-zA-Z]","",$dtmf_send_extension);
$call_out_number_group = ereg_replace("[^-\.\:\/\@\_0-9a-zA-Z]","",$call_out_number_group);
$telnet_host = ereg_replace("[^-\.\:\/\@\_0-9a-zA-Z]","",$telnet_host);
$DBX_server = ereg_replace("[^-\.\:\/\@\_0-9a-zA-Z]","",$DBX_server);
$DBY_server = ereg_replace("[^-\.\:\/\@\_0-9a-zA-Z]","",$DBY_server);

### ALPHA-NUMERIC (and underscore and dash)
$PHP_AUTH_USER = ereg_replace("[^0-9a-zA-Z]","",$PHP_AUTH_USER);
$PHP_AUTH_PW = ereg_replace("[^0-9a-zA-Z]","",$PHP_AUTH_PW);
$login = ereg_replace("[^-\_0-9a-zA-Z]","",$login);
$user = ereg_replace("[^-\_0-9a-zA-Z]","",$user);
$pass = ereg_replace("[^-\_0-9a-zA-Z]","",$pass);
$status = ereg_replace("[^-\_0-9a-zA-Z]","",$status);
$protocol = ereg_replace("[^-\_0-9a-zA-Z]","",$protocol);
$ASTmgrUSERNAMEupdate = ereg_replace("[^-\_0-9a-zA-Z]","",$ASTmgrUSERNAMEupdate);
$ASTmgrUSERNAMEsend = ereg_replace("[^-\_0-9a-zA-Z]","",$ASTmgrUSERNAMEsend);
$ASTmgrUSERNAMElisten = ereg_replace("[^-\_0-9a-zA-Z]","",$ASTmgrUSERNAMElisten);
$ASTmgrUSERNAME = ereg_replace("[^-\_0-9a-zA-Z]","",$ASTmgrUSERNAME);
$ASTmgrSECRET = ereg_replace("[^-\_0-9a-zA-Z]","",$ASTmgrSECRET);
$login_user = ereg_replace("[^-\_0-9a-zA-Z]","",$login_user);
$login_pass = ereg_replace("[^-\_0-9a-zA-Z]","",$login_pass);
$login_campaign = ereg_replace("[^-\_0-9a-zA-Z]","",$login_campaign);
$DBX_user = ereg_replace("[^-\_0-9a-zA-Z]","",$DBX_user);
$DBY_user = ereg_replace("[^-\_0-9a-zA-Z]","",$DBY_user);
$DBX_pass = ereg_replace("[^-\_0-9a-zA-Z]","",$DBX_pass);
$DBY_pass = ereg_replace("[^-\_0-9a-zA-Z]","",$DBY_pass);
$DBX_database = ereg_replace("[^-\_0-9a-zA-Z]","",$DBX_database);
$DBY_database = ereg_replace("[^-\_0-9a-zA-Z]","",$DBY_database);
$VICIDIAL_park_on_filename = ereg_replace("[^-\_0-9a-zA-Z]","",$VICIDIAL_park_on_filename);
$server_id = ereg_replace("[^-\_0-9a-zA-Z]","",$server_id);
$old_server_id = ereg_replace("[^-\_0-9a-zA-Z]","",$old_server_id);
$ext_context = ereg_replace("[^-\_0-9a-zA-Z]","",$ext_context);
$CoNfIrM = ereg_replace("[^-\_0-9a-zA-Z]","",$CoNfIrM);

### ALPHA-NUMERIC and spaces dots, commas, dashes, underscores
$phone_type = ereg_replace("[^ \.\,-\_0-9a-zA-Z]","",$phone_type);
$full_name = ereg_replace("[^ \.\,-\_0-9a-zA-Z]","",$full_name);
$fullname = ereg_replace("[^ \.\,-\_0-9a-zA-Z]","",$fullname);
$company = ereg_replace("[^ \.\,-\_0-9a-zA-Z]","",$company);
$picture = ereg_replace("[^ \.\,-\_0-9a-zA-Z]","",$picture);
$local_gmt = ereg_replace("[^ \.\,-\_0-9a-zA-Z]","",$local_gmt);
$server_description = ereg_replace("[^ \.\,-\_0-9a-zA-Z]","",$server_description);
$asterisk_version = ereg_replace("[^ \.\,-\_0-9a-zA-Z]","",$asterisk_version);

### VARIABLES TO BE mysql_real_escape_string ###
# $VICIDIAL_web_URL = 
# $local_web_callerID_URL = 

##### END VARIABLE FILTERING FOR SECURITY #####

if ($force_logout)
{
  if( (strlen($PHP_AUTH_USER)>0) or (strlen($PHP_AUTH_PW)>0) )
	{
    Header("WWW-Authenticate: Basic realm=\"VICI-ASTERISK\"");
    Header("HTTP/1.0 401 Unauthorized");
	}
    echo "Usted ahora ha salido. Gracias\n";
    exit;
}

if (!isset($ADD))   {$ADD=0;}

$STARTtime = date("U");
$STARTdate = date("Y-m-d H:i:s");

if ($ADD==1) {$process = 'NUEVO TELÉFONO';}
if ($ADD==11) {$process = 'NUEVO SERVIDOR';}
if ($ADD==111) {$process = 'NUEVA CONFERENCIA';}
if ($ADD==2) {$process = 'CREANDO TELÉFONO';}
if ($ADD==21) {$process = 'CREANDO SERVIDOR';}
if ($ADD==211) {$process = 'CREANDO CONFERENCIA';}
if ($ADD==3) {$process = 'MODIFICAR EL TELÉFONO';}
if ($ADD==31) {$process = 'MODIFICAR EL SERVIDOR';}
if ($ADD==311) {$process = 'MODIFICAR LA CONFERENCIA';}
if ($ADD==4) {$process = 'MODIFICANDO EL TELÉFONO';}
if ($ADD==41) {$process = 'MODIFICANDO EL SERVIDOR';}
if ($ADD==411) {$process = 'MODIFICANDO LA CONFERENCIA';}
if ($ADD==5) {$process = 'DELETE PHONE';}
if ($ADD==6) {$process = 'DELETE PHONE';}
if ($ADD==55) {$process = 'BUSCAR TELÉFONOS';}
if ($ADD==66) {$process = 'RESULTADO DE LA BÚSQUEDA DE TELÉFONOS';}
if ($ADD==0) {$process = 'LISTA DE TELÉFONOS';}
if ($ADD==10) {$process = 'LISTA DE SERVIDORES';}
if ($ADD==100) {$process = 'LISTA DE  CONFERENCIAS';}
if ($ADD==99999) {$process = 'AYUDA';}

	$stmt="SELECT count(*) from phones where login='$PHP_AUTH_USER' and pass='$PHP_AUTH_PW' and active = 'Y' and status='ADMIN';";
	$rslt=mysql_query($stmt, $link);
	$row=mysql_fetch_row($rslt);
	$auth=$row[0];

	if ($auth<1)
	{
	$stmt="SELECT count(*) from vicidial_users where user='$PHP_AUTH_USER' and pass='$PHP_AUTH_PW' and user_level > '6' and ast_admin_access='1';";
	$rslt=mysql_query($stmt, $link);
	$row=mysql_fetch_row($rslt);
	$auth=$row[0];

	if($auth>0)
		{
		$stmt="SELECT * from vicidial_users where user='$PHP_AUTH_USER' and pass='$PHP_AUTH_PW'";
		$rslt=mysql_query($stmt, $link);
		$row=mysql_fetch_row($rslt);
		$LOGfullname				=$row[3];
		$LOGdelete_phones			=$row[17];
		}
	}

if ($WeBRooTWritablE > 0)
	{$fp = fopen ("./project_auth_entries.txt", "a");}
$date = date("r");
$ip = getenv("REMOTE_ADDR");
$browser = getenv("HTTP_USER_AGENT");

  if( (strlen($PHP_AUTH_USER)<2) or (strlen($PHP_AUTH_PW)<2) or (!$auth))
	{
    Header("WWW-Authenticate: Basic realm=\"VICI-ASTERISK\"");
    Header("HTTP/1.0 401 Unauthorized");
    echo "Nombre y contraseña inválidos del usuario: |$PHP_AUTH_USER|$PHP_AUTH_PW|\n";
	echo "|$stmt|\n";
    exit;
	}
  else
	{

	if($auth>0)
		{
		$office_no=strtoupper($PHP_AUTH_USER);
		$password=strtoupper($PHP_AUTH_PW);
		if (strlen($LOGfullname) < 1)
			{
			$stmt="SELECT fullname from phones where login='$PHP_AUTH_USER' and pass='$PHP_AUTH_PW'";
			$rslt=mysql_query($stmt, $link);
			$row=mysql_fetch_row($rslt);
			$LOGfullname=$row[0];
			}
		if ($WeBRooTWritablE > 0)
			{
			fwrite ($fp, "ASTERISK|GOOD|$date|$PHP_AUTH_USER|$PHP_AUTH_PW|$ip|$browser|$LOGfullname|\n");
			fclose($fp);
			}

		##### get server listing for dynamic pulldown
		$stmt="SELECT server_ip,server_description from servers order by server_ip";
		$rsltx=mysql_query($stmt, $link);
		$servers_to_print = mysql_num_rows($rsltx);
		$servers_list='';

		$o=0;
		while ($servers_to_print > $o)
			{
			$rowx=mysql_fetch_row($rsltx);
			$servers_list .= "<option value=\"$rowx[0]\">$rowx[0] - $rowx[1]</option>\n";
			$o++;
			}

		}
	else
		{
		if ($WeBRooTWritablE > 0)
			{
			fwrite ($fp, "ASTERISK|FAIL|$date|$PHP_AUTH_USER|$PHP_AUTH_PW|$ip|$browser|\n");
			fclose($fp);
			}
		}
	}

header ("Content-type: text/html; charset=utf-8");

$NWB = " &nbsp; <a href=\"javascript:openNewWindow('$PHP_SELF?ADD=99999";
$NWE = "')\"><IMG SRC=\"help.gif\" WIDTH=20 HEIGHT=20 Border=0 ALT=\"AYUDA\" ALIGN=TOP></A>";
######################
# ADD=99999 display the HELP SCREENS
######################

if ($ADD==99999)
{
echo "<html>\n";
echo "<head>\n";
echo "<title>ASTERISK ADMIN: Administración - $process </title>\n";
echo "</head>\n";
echo "<BODY BGCOLOR=white marginheight=0 marginwidth=0 leftmargin=0 topmargin=0>\n";
echo "<CENTER>\n";
echo "<TABLE WIDTH=98% BGCOLOR=#E6E6E6 cellpadding=2 cellspacing=0><TR><TD ALIGN=LEFT><FONT FACE=\"ARIAL,HELVETICA\" COLOR=BLACK SIZE=4><B>ASTERISK ADMIN: AYUDA<BR></B></FONT><FONT FACE=\"ARIAL,HELVETICA\" COLOR=BLACK SIZE=2><BR><BR>\n";

?>
<B><FONT SIZE=3>TABLA DE LOS TELÉFONOS</FONT></B><BR><BR>
<A NAME="phones-extension">
<BR>
<B>Extensión del teléfono -</B> este campo es donde usted pone los nombres del teléfono que aparecen al marcar con asterisco no incluyendo el protocolo o la barra vertical del principio. Por ejemplo: para el teléfono SIP/test101 del SIP la extensión del teléfono sería test101. También, para los teléfonos IAX2 compruebe que usted utiliza el nombre del teléfono completo: IAX2/IAXphone1@IAXphone1 sería IAXphone1@IAXphone1. Para zap los teléfonos compruebe que usted pone el canal completo: Zap/25-1 sería 25-1. Otra nota, compruebe que usted fija el protocolo abajo correctamente para su tipo de teléfono.

<BR>
<A NAME="phones-dialplan_number">
<BR>
<B>Número del Dialplan -</B> este campo está para el número que usted marca para tener el anillo del teléfono. Este número se define en el archivo de extensions.conf de su servidor asterisco

<BR>
<A NAME="phones-voicemail_id">
<BR>
<B>Caja de Buzón de Voz -</B> este campo es para la caja del buzón de voz donde van los mensajes para al usuario de este teléfono. Utilizamos esto para comprobar los mensajes del buzón de voz y para que el usuario pueda acceder al Buzón de Voz desde astGUIclient.

<BR>
<A NAME="phones-outbound_cid">
<BR>
<B>CallerID de salida -</B> este campo es donde usted incorporara el número del callerID que usted quiera que aparezca en las llamadas de salida. Esto no funciona en las líneas RTB(non-PRI) T1/E1.

<BR>
<A NAME="phones-phone_ip">
<BR>
<B>Dirección IP del teléfono -</B> este campo es para la dirección IP del teléfono si es un teléfono de VOZIP. Este es un campo opcional

<BR>
<A NAME="phones-computer_ip">
<BR>
<B>Dirección IP del ordenador -</B> este campo es para la dirección IP del ordenador del usuario. Es un campo opcional

<BR>
<A NAME="phones-server_ip">
<BR>
<B>IP del servidor -</B> Este menú es donde usted selecciona en que servidor está el teléfono activo.

<BR>
<A NAME="phones-login">
<BR>
<B>Conexión -</B> la conexión usada para el usuario del teléfono a laconexión a los usos del cliente.

<BR>
<A NAME="phones-pass">
<BR>
<B>Contraseña -</B> la contraseña usada para el usuario del teléfono a laconexión a los usos del cliente.

<BR>
<A NAME="phones-status">
<BR>
<B>Estado -</B> el estado del teléfono en el sistema, puede ser ACTIVO y ADMIN permiten que los clientes del GUI trabajen. ADMIN permite el acceso a este Web site de administración. El resto de los estados no permiten el acceso al GUI o al Web de Admin.

<BR>
<A NAME="phones-active">
<BR>
<B>Cuenta activa -</B> si el teléfono está activado ponerla en la lista del cliente del GUI.

<BR>
<A NAME="phones-phone_type">
<BR>
<B>Tipo de teléfono -</B> solamente para información administrativas.

<BR>
<A NAME="phones-fullname">
<BR>
<B>Nombre completo -</B> usado por el GUIclient en la lista de teléfonos activos.

<BR>
<A NAME="phones-company">
<BR>
<B>Compañía -</B> solamente para las notas administrativas.

<BR>
<A NAME="phones-picture">
<BR>
<B>Cuadro -</B> todavía no puesto en ejecución.

<BR>
<A NAME="phones-messages">
<BR>
<B>Nuevos mensajes -</B> número de los nuevos mensajes del Buzón de Voz para este teléfono en el servidor del asterisco.

<BR>
<A NAME="phones-old_messages">
<BR>
<B>Viejos mensajes -</B> número de los viejos mensajes del Buzón de Voz para este teléfono en el servidor del asterisco.

<BR>
<A NAME="phones-protocol">
<BR>
<B>Protocolo del cliente -</B> el protocolo que el teléfono utiliza para conectar con el servidor del asterisco: El Sip, IAX2, Zap. También, para los números External remotos o los números SpeedDial que usted desea enumerar como teléfonos.

<BR>
<A NAME="phones-local_gmt">
<BR>
<B>GMT local -</B> La diferencia a partir del tiempo malo del ZULÚ del time(or de Greenwich) donde se localiza el teléfono. NO AJUSTE POR TIEMPO DE LOS AHORROS DE LA LUZ DEL DÍA. Esto es utilizada por la campaña de VICIDIAL para exhibir exactamente el tiempo y el tiempo del cliente.

<BR>
<A NAME="phones-ASTmgrUSERNAME">
<BR>
<B>Conexión del encargado -</B> Ésta es la conexión que los clientes del GUI para este teléfono utilizarán tener acceso a la base de datos donde residen los datos del servidor.

<BR>
<A NAME="phones-ASTmgrSECRET">
<BR>
<B>Secreto del encargado -</B> Ésta es la contraseña que los clientes del GUI para este teléfono utilizarán tener acceso a la base de datos donde residen los datos del servidor.

<BR>
<A NAME="phones-login_user">
<BR>
<B>Usuario del defecto de VICIDIAL -</B> éste debe poner un valor prefijado en el campo del usuario de VICIDIAL siempre que este usuario del teléfono abra a cliente app de astVICIDIAL. Deje el espacio en blanco para ningún usuario.

<BR>
<A NAME="phones-login_pass">
<BR>
<B>Paso del defecto de VICIDIAL -</B> éste debe poner un valor prefijado en el campo de la contraseña de VICIDIAL siempre que este usuario del teléfono abra a cliente app de astVICIDIAL. Deje el espacio en blanco para ningún paso.

<BR>
<A NAME="phones-login_campaign">
<BR>
<B>Campaña del defecto de VICIDIAL -</B> éste debe poner un valor prefijado en el campo de la campaña de VICIDIAL siempre que este usuario del teléfono abra a cliente app de astVICIDIAL. Deje el espacio en blanco para ninguna campaña.

<BR>
<A NAME="phones-park_on_extension">
<BR>
<B>Parque Exten -</B> Ésta es la extensión del estacionamiento del defecto para los apps del cliente. Verifique que diverso trabaje antes de que usted cambie esto.

<BR>
<A NAME="phones-conf_on_extension">
<BR>
<B>Extensión de la conferencia -</B> Ésta es la extensión del parque de la conferencia del defecto para los apps del cliente. Verifique que diverso trabaje antes de que usted cambie esto.

<BR>
<A NAME="phones-VICIDIAL_park_on_extension">
<BR>
<B>Parque Exten de VICIDIAL -</B> Ésta es la extensión del estacionamiento del defecto para el cliente app de VICIDIAL. Verifique que diverso trabaje antes de que usted cambie esto.

<BR>
<A NAME="phones-VICIDIAL_park_on_filename">
<BR>
<B>Archivo del parque de VICIDIAL -</B> éste es el nombre del archivo de la extensión del parque del defecto VICIDIAL para los apps del cliente. Verifique que diverso trabaje antes de que usted cambie éste limitado a 10 caracteres.

<BR>
<A NAME="phones-monitor_prefix">
<BR>
<B>Prefijo del monitor -</B> éste es el prefijo dialplan para supervisar de zap los canales automáticamente dentro del app astGUIclient. Cambie solamente según los expedientes de extensiones de extensions.conf ZapBarge.

<BR>
<A NAME="phones-recording_exten">
<BR>
<B>Grabación Exten -</B> Ésta es la extensión dialplan para la extensión de la grabación que se utiliza para caer en conferencias del meetme para registrarlas. Dura generalmente hasta que una hora si no parada verifica con el archivo de extensions.conf antes de cambiar.

<BR>
<A NAME="phones-voicemail_exten">
<BR>
<B>VMAIL Exten principal -</B> Ésta es la extensión dialplan que va a comprobar su voicemail. verifica con el archivo de extensions.conf antes de cambiar.

<BR>
<A NAME="phones-voicemail_dump_exten">
<BR>
<B>Descarga Exten de VMAIL -</B> éste es el prefijo dialplan usado para enviar llamadas directamente al voicemail de un usuario de una llamada viva en el app. astGUIclient verifica con el archivo de extensions.conf antes de cambiar.

<BR>
<A NAME="phones-ext_context">
<BR>
<B>Contexto de Exten -</B> éste es el contexto dialplan que este teléfono utiliza sobre todo. Se asume que todos los números marcados por los apps del cliente están utilizando este contexto así que es una buena idea cerciorarse de que éste es el contexto más amplio posible verifica con el archivo de extensions.conf antes de cambiar.

<BR>
<A NAME="phones-dtmf_send_extension">
<BR>
<B>DTMF envían el canal -</B> Ésta es la secuencia del canal usada para enviar sonidos de DTMF en conferencias del meetme de los apps del cliente. Verifique que exten y contexto con el archivo de extensions.conf.

<BR>
<A NAME="phones-call_out_number_group">
<BR>
<B>Grupo de salida de la llamada -</B> éste es el grupo de canal que las llamadas de salida de este teléfono están puestas de. Hay rutinas de un par en los apps del cliente que utilizan esto. Para zap los canales que usted desea utilizar algo como Zap/g2, porque los troncos IAX2 usted desearía utilizar el prefijo completo de IAX como IAX2/VICItest1:secret@10.10.10.15:4569. Verifique que los troncos con el file(it de extensions.conf sean generalmente lo que usted ha definido como la variable global del TRUNK en la tapa del archivo).

<BR>
<A NAME="phones-client_browser">
<BR>
<B>Localización del browser -</B> esto es aplicable solamente a los clientes de UNIX/LINUX, el camino absoluto a Mozilla o el browser de Firefox en la máquina verifica esto lanzándolo manualmente.

<BR>
<A NAME="phones-install_directory">
<BR>
<B>Instale el directorio -</B> éste es el lugar en donde las escrituras astGUIclient y de astVICIDIAL están situadas en su máquina. Para Win32 debe ser algo como C:\AST_VICI y para UNIX debe ser algo como /usr/local/perl_TK. verifica esto manualmente.

<BR>
<A NAME="phones-local_web_callerID_URL">
<BR>
<B>URL de CallerID -</B> Ústa es la dirección de la tela de la página usada para hacer operaciones de búsqueda de encargo del callerID que es la dirección de prueba del defecto: http://astguiclient.sf.net/test_callerid_output.php

<BR>
<A NAME="phones-VICIDIAL_web_URL">
<BR>
<B>URL del defecto de VICIDIAL -</B> Ésta es la dirección de la tela de la página usada para hacer preguntas de encargo de la forma del Web de VICIDIAL que es la dirección de prueba del defecto: http://astguiclient.sf.net/test_VICIDIAL_output.php

<BR>
<A NAME="phones-AGI_call_logging_enabled">
<BR>
<B>Registración de la llamada -</B> esto se fija para verdad si el archivo de call_log.agi está en lugar en el archivo de extensions.conf para todo el de salida y las extensiones del retraso ' h ' para registrar todo llama. Ústa debe siempre ser 1 porque es manditory para muchos astGUIclient y características de VICIDIAL a trabajar correctamente.

<BR>
<A NAME="phones-user_switching_enabled">
<BR>
<B>Conmutación del usuario -</B> fije para verdad para permitir que el usuario cambie a otra cuenta del usuario. NOTA: Si los interruptores del usuario ellos pueden iniciar la grabación en la conversación de teléfono del nuevo usuario

<BR>
<A NAME="phones-conferencing_enabled">
<BR>
<B>Comunicación -</B> fije para verdad para permitir que el usuario comience llamadas de conferencia con hasta que seis líneas externas.

<BR>
<A NAME="phones-admin_hangup_enabled">
<BR>
<B>Retraso del Admin -</B> sistema a verdad para permitir que el usuario pueda al retraso cualquier línea en la voluntad con astGUIclient. Buena idea de permitir solamente esto para los usuarios del Admin.

<BR>
<A NAME="phones-admin_hijack_enabled">
<BR>
<B>Secuestro del Admin -</B> fije para verdad para permitir que el usuario pueda asir y volver a dirigir a su extensión cualquier línea en la voluntad con astGUIclient. Buena idea de permitir solamente esto para los usuarios del Admin. Pero es muy útil para los encargados.

<BR>
<A NAME="phones-admin_monitor_enabled">
<BR>
<B>Monitor del Admin -</B> fije para verdad para permitir que el usuario pueda asir y volver a dirigir a su extensión cualquier línea en la voluntad con astGUIclient. Buena idea de permitir solamente esto para los usuarios del Admin. Pero es muy útil para los encargados y como herramienta del entrenamiento.

<BR>
<A NAME="phones-call_parking_enabled">
<BR>
<B>Parque de llamada -</B> el sistema a verdad para permitir que el usuario pueda parquear invita el asimiento astGUIclient para ser tomado por cualquier otro usuario astGUIclient en el sistema. Las llamadas permanecen en el asimiento para hasta que un retraso de la media-hora entonces. Permitido generalmente para todos.

<BR>
<A NAME="phones-updater_check_enabled">
<BR>
<B>Cheque de Updater -</B> fije para verdad para exhibir una advertencia del popup que el tiempo del updater no ha cambiado en 20 segundos. Útil para los usuarios del Admin.

<BR>
<A NAME="phones-AFLogging_enabled">
<BR>
<B>Af que registra -</B> fije para verdad para registrar muchas acciones del uso astGUIclient a un archivo de texto en la computadora del usuario.

<BR>
<A NAME="phones-QUEUE_ACTION_enabled">
<BR>
<B>La coleta permitió -</B> al sistema verdad para hacer que los apps del cliente utilicen el sistema central de la coleta del asterisco. Requerido para VICIDIAL y recomendado para todos los usuarios.

<BR>
<A NAME="phones-CallerID_popup_enabled">
<BR>
<B>Ventana emergente del CallerID -</B> sistema a verdad para tener en cuenta los números definidos en el archivo de extensions.conf para enviar las pantallas del popup de CallerID a los usuarios astGUIclient.

<BR>
<A NAME="phones-voicemail_button_enabled">
<BR>
<B>Botón de VMail -</B> fije para verdad para exhibir el botón de VOICEMAIL y los mensajes cuentan la exhibición en astGUIclient.

<BR>
<A NAME="phones-enable_fast_refresh">
<BR>
<B>Rápido restaure -</B> fije para verdad para permitir un nuevo índice de restauran de la información de la llamada para el astGUIclient. La tarifa inhabilitada defecto es el ms 1000 (1 segundo). Puede aumentar la carga de sistema si usted baja este número.

<BR>
<A NAME="phones-fast_refresh_rate">
<BR>
<B>Rápido restaure la tarifa -</B> en milisegundos. Utilizado solamente si es rápido restaure se permite. La tarifa inhabilitada defecto es el ms 1000 (1 segundo). Puede aumentar la carga de sistema si usted baja este número.

<BR>
<A NAME="phones-enable_persistant_mysql">
<BR>
<B>Persistant MySQL -</B> si está permitida la conexión astGUIclient seguirá conectada en vez de conectar cada segundo. Útil si usted hace que un rápido restaure la tarifa fijada. Aumentará el número de conexiones en su máquina de MySQL.

<BR>
<A NAME="phones-auto_dial_next_number">
<BR>
<B>Número siguiente del dial auto -</B> si está permitido el cliente de VICIDIAL marcará el número siguiente en la lista automáticamente sobre la disposición de una llamada a menos que seleccionaran "para parar el marcar" en la pantalla de la disposición.

<BR>
<A NAME="phones-VDstop_rec_after_each_call">
<BR>
<B>Pare Rec después de cada llamada -</B> si está permitido el cliente de VICIDIAL parará se está encendiendo cualquier grabación después de que haya sido cada llamada dispositioned. Útil si usted está haciendo muchos de la grabación o usted están utilizando una forma de la tela para accionar la grabación.

<BR>
<A NAME="phones-DBX_server">
<BR>
<B>Servidor de DBX -</B> el servidor de la base de datos de MySQL con el cual este usuario debe conectar.

<BR>
<A NAME="phones-DBX_database">
<BR>
<B>Base de datos de DBX -</B> la base de datos de MySQL con la cual este usuario debe conectar. El defecto es asterisco.

<BR>
<A NAME="phones-DBX_user">
<BR>
<B>Usuario de DBX -</B> la conexión del usuario de MySQL que este usuario debe utilizar al conectar. El defecto es cron.

<BR>
<A NAME="phones-DBX_pass">
<BR>
<B>Paso de DBX -</B> la contraseña del usuario de MySQL que este usuario debe utilizar al conectar. El defecto es 1234.

<BR>
<A NAME="phones-DBX_port">
<BR>
<B>DBX viran -</B> el puerto de MySQL hacia el lado de babor TCP que este usuario debe utilizar al conectar. El defecto es 3306.

<BR>
<A NAME="phones-DBY_server">
<BR>
<B>Servidor de DBY -</B> el servidor de la base de datos de MySQL con el cual este usuario debe conectar. Secundario server, no utilizado actualmente.

<BR>
<A NAME="phones-DBY_database">
<BR>
<B>Base de datos de DBY -</B> la base de datos de MySQL con la cual este usuario debe conectar. El defecto es asterisco. Secundario server, no utilizado actualmente.

<BR>
<A NAME="phones-DBY_user">
<BR>
<B>Usuario de DBY -</B> la conexión del usuario de MySQL que este usuario debe utilizar al conectar. El defecto es cron. Secundario server, no utilizado actualmente.

<BR>
<A NAME="phones-DBY_pass">
<BR>
<B>Paso de DBY -</B> la contraseña del usuario de MySQL que este usuario debe utilizar al conectar. El defecto es 1234. Secundario server, no utilizado actualmente.

<BR>
<A NAME="phones-DBY_port">
<BR>
<B>DBY viran -</B> el puerto de MySQL hacia el lado de babor TCP que este usuario debe utilizar al conectar. El defecto es 3306. Secundario server, no utilizado actualmente.


<BR><BR><BR><BR>

<B><FONT SIZE=3>TABLA DE LOS SERVIDORES</FONT></B><BR><BR>
<A NAME="servers-server_id">
<BR>
<B>ID Del Servidor -</B>  Este campo es donde usted pone el nombre del servidor del asterisco, no tiene que ser un submarino oficial del dominio, apenas un apodo para identificar el servidor a los usuarios del Admin.

<BR>
<A NAME="servers-server_description">
<BR>
<B>Descripción del servidor -</B> el campo donde usted utiliza una frase pequeña para describir el servidor del asterisco.

<BR>
<A NAME="servers-server_ip">
<BR>
<B>IP address del servidor -</B> el campo donde usted puso el IP address de la red del servidor del asterisco.

<BR>
<A NAME="servers-active">
<BR>
<B>Activo -</B> fije si el servidor del asterisco es activo o inactivo.

<BR>
<A NAME="servers-asterisk_version">
<BR>
<B>Versión del asterisco -</B> fije la versión del asterisco que usted ha instalado en este servidor. Ejemplos: ' 1.2 ', ' 1.0.8 ', ' 1.0.7 ', ' CVS_HEAD ', ' REALMENTE VIEJO ', etc... Se utiliza esto porque las versiones 1.0.8 y 1.0.9 tienen un diverso método de ocuparse del insecto local del channels(a que ha estado fijado en CVS v1.0) y necesidad de ser tratado diferentemente cuando la manipulación de su Local/ acanala. También, CVS_HEAD actual y las 1.2 aplicaciones diverso encargado y comando del árbol del lanzamiento hicieron salir así que debe ser tratado diverso también.

<BR>
<A NAME="servers-max_vicidial_trunks">
<BR>
<B>Troncos máximos de VICIDIAL -</B> este campo determinará el número de las líneas máximo que el auto-dialer de VICIDIAL procurará invitar este servidor. Si usted desea dedicar dos PRI llenos T1 a VICIDIALing en un servidor entonces usted fijaría esto a 46. E1 defecto es 96.

<BR>
<A NAME="servers-telnet_host">
<BR>
<B>Anfitrión del telnet -</B> éste es la dirección o el nombre del servidor del asterisco y es cómo los usos del encargado conectan con él de donde están funcionando. Si están funcionando en el servidor del asterisco, después el defecto del ' localhost ' está muy bien.

<BR>
<A NAME="servers-telnet_port">
<BR>
<B>El telnet vira hacia el lado de babor -</B> éste es el puerto de la conexión del encargado del servidor del asterisco y es cómo los usos del encargado conectan con ella de donde están funcionando. El defecto de ' 5038 ' está para un estándar instala muy bien.

<BR>
<A NAME="servers-ASTmgrUSERNAME">
<BR>
<B>Usuario del encargado -</B> el username o la conexión conectaba genericly con el encargado del servidor del asterisco. El defecto es 'cron'

<BR>
<A NAME="servers-ASTmgrSECRET">
<BR>
<B>Secreto del encargado -</B> el secreto o la contraseña conectaba genericly con el encargado del servidor del asterisco. El defecto es '1234'

<BR>
<A NAME="servers-ASTmgrUSERNAMEupdate">
<BR>
<B>Usuario en modo actualización del encargado -</B> el username o la conexión conectaba con el encargado del servidor del asterisco optimizado para las escrituras de la actualización. Omita es 'updatecron' y asume el mismo secreto que el usuario genérico.

<BR>
<A NAME="servers-ASTmgrUSERNAMElisten">
<BR>
<B>El encargado escucha usuario -</B> el username o la conexión usada para conectar con el encargado del servidor del asterisco optimizado para las escrituras que esperan a escuchar solamente salida. Omita es 'listencron' y asume el mismo secreto que el usuario genérico.

<BR>
<A NAME="servers-ASTmgrUSERNAMEsend">
<BR>
<B>El encargado envía a usuario -</B> el username o la conexión usada para conectar con el encargado del servidor del asterisco optimizado para las escrituras que envían solamente acciones al encargado. Omita es 'sendcron' y asume el mismo secreto que el usuario genérico.

<BR>
<A NAME="servers-local_gmt">
<BR>
<B>El GMT del servidor compensó -</B> la diferencia sobre horas a partir del tiempo del GMT no ajustado según el Luz del di'a-Ahorro-Tiempo del servidor. El defecto es '-5'

<BR>
<A NAME="servers-voicemail_dump_exten">
<BR>
<B>Descarga Exten -</B> el prefijo de VMail de la extensión usado en este servidor para enviar llamadas directamente a través de agc a una caja específica del voicemail. El defecto es '85026666666666'

<BR>
<A NAME="servers-answer_transfer_agent">
<BR>
<B>Extensión del ANUNCIO de VICIDIAL -</B> la extensión del defecto si ninguno está presente en la campaña enviar llamadas para a marcar auto de VICIDIAL. El defecto es '8365'

<BR>
<A NAME="servers-ext_context">
<BR>
<B>Contexto del defecto -</B> el contexto dialplan del defecto usado para las escrituras que funcionan para este servidor. El defecto es 'defecto'


<BR><BR><BR><BR>

<B><FONT SIZE=3>TABLA DE CONFERENCIAS</FONT></B><BR><BR>
<A NAME="conferences-conf_exten">
<BR>
<B>Número de la conferencia -</B> este campo es donde usted pone el número del dialpna de la conferencia del meetme. También se recomienda que el número del meetme en meetme.conf empareja este número para cada entrada. Esto está para las conferencias en astGUIclient y se utiliza para la funcionalidad de leave-3way-call en VICIDIAL.

<BR>
<A NAME="conferences-server_ip">
<BR>
<B>IP del servidor -</B> El menú donde usted selecciona el servidor del asterisco que esta conferencia estará encendido.






<BR><BR><BR><BR><BR><BR><BR><BR>
<BR><BR><BR><BR><BR><BR><BR><BR>
EL EXTREMO
</TD></TR></TABLE></BODY></HTML>
<?
exit;

#### END HELP SCREENS
}








?>
<html>
<head>
<title>ASTERISK ADMIN: Administración - <? echo $process ?></title>
<script language="Javascript">
function openNewWindow(url) {
  window.open (url,"",'width=500,height=300,scrollbars=yes,menubar=yes,address=yes');
}
</script>
</head>
<BODY BGCOLOR=white marginheight=0 marginwidth=0 leftmargin=0 topmargin=0>
<CENTER>
<TABLE WIDTH=620 BGCOLOR=#D9E6FE cellpadding=2 cellspacing=0><TR BGCOLOR=#015B91><TD ALIGN=LEFT><FONT FACE="ARIAL,HELVETICA" COLOR=WHITE SIZE=2><B> &nbsp; ASTERISK ADMIN - <a href="<? echo $PHP_SELF ?>?force_logout=1"><FONT FACE="ARIAL,HELVETICA" COLOR=WHITE SIZE=1>Salir</a></TD><TD ALIGN=RIGHT><FONT FACE="ARIAL,HELVETICA" COLOR=WHITE SIZE=2><B><? echo date("l F j, Y G:i:s A") ?> &nbsp; </TD></TR>
<TR BGCOLOR=#F0F5FE><TD ALIGN=LEFT COLSPAN=2><FONT FACE="ARIAL,HELVETICA" COLOR=BLACK SIZE=1><B> &nbsp; <a href="<? echo $PHP_SELF ?>"><FONT FACE="ARIAL,HELVETICA" COLOR=BLACK SIZE=1>ENUMERE TODOS LOS TELÉFONOS</a> | <a href="<? echo $PHP_SELF ?>?ADD=1"><FONT FACE="ARIAL,HELVETICA" COLOR=BLACK SIZE=1>AGREGUE Un TELÉFONO NUEVO</a> | <a href="<? echo $PHP_SELF ?>?ADD=55"><FONT FACE="ARIAL,HELVETICA" COLOR=BLACK SIZE=1>BÚSQUEDA PARA Un TELÉFONO</a> | <a href="<? echo $PHP_SELF ?>?ADD=11"><FONT FACE="ARIAL,HELVETICA" COLOR=BLACK SIZE=1>AGREGUE Un SERVIDOR</a> | <a href="<? echo $PHP_SELF ?>?ADD=10"><FONT FACE="ARIAL,HELVETICA" COLOR=BLACK SIZE=1>ENUMERE TODOS LOS SERVIDORES</a></TD></TR>
<TR BGCOLOR=#F0F5FE><TD ALIGN=LEFT COLSPAN=2><FONT FACE="ARIAL,HELVETICA" COLOR=BLACK SIZE=1><B> &nbsp; <a href="<? echo $PHP_SELF ?>?ADD=100"><FONT FACE="ARIAL,HELVETICA" COLOR=BLACK SIZE=1>DEMUESTRE TODAS LAS CONFERENCIAS</a> | <a href="<? echo $PHP_SELF ?>?ADD=111"><FONT FACE="ARIAL,HELVETICA" COLOR=BLACK SIZE=1>AGREGUE Una NUEVA CONFERENCIA</a></TD></TR>



<TR><TD ALIGN=LEFT COLSPAN=2>
<? 
######################
# ADD=1 display the ADD NEW PHONE FORM SCREEN
######################

if ($ADD==1)
{
echo "<FONT FACE=\"ARIAL,HELVETICA\" COLOR=BLACK SIZE=2>";

echo "<br>AGREGUE Un TELÉFONO NUEVO<form action=$PHP_SELF method=POST>\n";
echo "<input type=hidden name=ADD value=2>\n";
echo "<center><TABLE width=600 cellspacing=3>\n";

echo "<center><TABLE width=600 cellspacing=3>\n";
echo "<tr bgcolor=#B6D3FC><td align=right>Extensión del teléfono: </td><td align=left><input type=text name=extension size=20 maxlength=100 value=\"\">$NWB#phones-extension$NWE</td></tr>\n";
echo "<tr bgcolor=#B6D3FC><td align=right>Número De Dialplan: </td><td align=left><input type=text name=dialplan_number size=15 maxlength=20 value=\"$row[1]\"> (Solamente dígitos)$NWB#phones-dialplan_number$NWE</td></tr>\n";
echo "<tr bgcolor=#B6D3FC><td align=right>Buzón de voz: </td><td align=left><input type=text name=voicemail_id size=10 maxlength=10 value=\"$row[2]\"> (Solamente dígitos)$NWB#phones-voicemail_id$NWE</td></tr>\n";
echo "<tr bgcolor=#B6D3FC><td align=right>CallerID De salida: </td><td align=left><input type=text name=outbound_cid size=10 maxlength=20 value=\"$row[65]\"> (Solamente dígitos)$NWB#phones-outbound_cid$NWE</td></tr>\n";
echo "<tr bgcolor=#B6D3FC><td align=right>Dirección IP del teléfono: </td><td align=left><input type=text name=phone_ip size=20 maxlength=15 value=\"$row[3]\"> (optional)$NWB#phones-phone_ip$NWE</td></tr>\n";
echo "<tr bgcolor=#B6D3FC><td align=right>Dirección IP del ordenador: </td><td align=left><input type=text name=computer_ip size=20 maxlength=15 value=\"$row[4]\"> (optional)$NWB#phones-computer_ip$NWE</td></tr>\n";
echo "<tr bgcolor=#B6D3FC><td align=right>IP Del Servidor: </td><td align=left><select size=1 name=server_ip>\n";

echo "$servers_list";
echo "<option SELECTED>$row[5]</option>\n";
echo "</select>$NWB#phones-server_ip$NWE</td></tr>\n";
echo "<tr bgcolor=#B6D3FC><td align=right>Login: </td><td align=left><input type=text name=login size=10 maxlength=10 value=\"$row[6]\">$NWB#phones-login$NWE</td></tr>\n";
echo "<tr bgcolor=#B6D3FC><td align=right>Contraseña: </td><td align=left><input type=text name=pass size=10 maxlength=10 value=\"$row[7]\">$NWB#phones-pass$NWE</td></tr>\n";
echo "<tr bgcolor=#B6D3FC><td align=right>Estado: </td><td align=left><select size=1 name=status><option>ACTIVO</option><option>SUSPENDED</option><option>CLOSED</option><option>PENDING</option><option>ADMIN</option><option selected>$row[8]</option></select>$NWB#phones-status$NWE</td></tr>\n";
echo "<tr bgcolor=#B6D3FC><td align=right>Cuenta Activa: </td><td align=left><select size=1 name=active><option>Y</option><option>N</option><option selected>$row[9]</option></select>$NWB#phones-active$NWE</td></tr>\n";
echo "<tr bgcolor=#B6D3FC><td align=right>Tipo Del Teléfono: </td><td align=left><input type=text name=phone_type size=20 maxlength=50 value=\"$row[10]\">$NWB#phones-phone_type$NWE</td></tr>\n";
echo "<tr bgcolor=#B6D3FC><td align=right>Nombre Completo: </td><td align=left><input type=text name=fullname size=20 maxlength=50 value=\"$row[11]\">$NWB#phones-fullname$NWE</td></tr>\n";
echo "<tr bgcolor=#B6D3FC><td align=right>Compañía: </td><td align=left><input type=text name=company size=10 maxlength=10 value=\"$row[12]\">$NWB#phones-company$NWE</td></tr>\n";
echo "<tr bgcolor=#B6D3FC><td align=right>Foto: </td><td align=left><input type=text name=picture size=20 maxlength=19 value=\"$row[13]\">$NWB#phones-picture$NWE</td></tr>\n";
echo "<tr bgcolor=#B6D3FC><td align=right>Protocolo Del Cliente: </td><td align=left><select size=1 name=protocol><option>SIP</option><option>Zap</option><option>IAX2</option><option>EXTERNAL</option><option selected>$row[16]</option></select>$NWB#phones-protocol$NWE</td></tr>\n";
echo "<tr bgcolor=#B6D3FC><td align=right>GMT Local: </td><td align=left><select size=1 name=local_gmt><option>12</option><option>11</option><option>10</option><option>9</option><option>8</option><option>7</option><option>6</option><option>5</option><option>4</option><option>3</option><option>2</option><option>1</option><option>0</option><option>-1</option><option>-2</option><option>-3</option><option>-4</option><option>-5</option><option>-6</option><option>-7</option><option>-8</option><option>-9</option><option>-10</option><option>-11</option><option>-12</option><option selected>$row[17]</option></select> (No ajustar para el DST)$NWB#phones-local_gmt$NWE</td></tr>\n";
echo "<tr bgcolor=#B6D3FC><td align=center colspan=2><input type=submit name=submit VALUE=ENVIAR></td></tr>\n";
echo "</TABLE></center>\n";

}


######################
# ADD=11 display the ADD NEW SERVERS FORM SCREEN
######################

if ($ADD==11)
{
echo "<FONT FACE=\"ARIAL,HELVETICA\" COLOR=BLACK SIZE=2>";

echo "<br>AGREGAR Un SERVIDOR NUEVO<form action=$PHP_SELF method=POST>\n";
echo "<input type=hidden name=ADD value=21>\n";
echo "<center><TABLE width=600 cellspacing=3>\n";
echo "<tr bgcolor=#B6D3FC><td align=right>ID Del Servidor: </td><td align=left><input type=text name=server_id size=10 maxlength=10>$NWB#servers-server_id$NWE</td></tr>\n";
echo "<tr bgcolor=#B6D3FC><td align=right>Descripción Del Servidor: </td><td align=left><input type=text name=server_description size=30 maxlength=255>$NWB#servers-server_description$NWE</td></tr>\n";
echo "<tr bgcolor=#B6D3FC><td align=right>Dirección IP del Servidor: </td><td align=left><input type=text name=server_ip size=20 maxlength=15>$NWB#servers-server_ip$NWE</td></tr>\n";
echo "<tr bgcolor=#B6D3FC><td align=right>Activo: </td><td align=left><select size=1 name=active><option>Y</option><option>N</option></select>$NWB#servers-active$NWE</td></tr>\n";
echo "<tr bgcolor=#B6D3FC><td align=right>Versión De Asterisk: </td><td align=left><input type=text name=asterisk_version size=20 maxlength=20>$NWB#servers-asterisk_version$NWE</td></tr>\n";
echo "<tr bgcolor=#B6D3FC><td align=center colspan=2><input type=submit name=submit VALUE=ENVIAR></td></tr>\n";
echo "</TABLE></center>\n";

}


######################
# ADD=111 display the ADD NEW CONFERENCES FORM SCREEN
######################

if ($ADD==111)
{
echo "<FONT FACE=\"ARIAL,HELVETICA\" COLOR=BLACK SIZE=2>";

echo "<br>AGREGUE Una NUEVA CONFERENCIA<form action=$PHP_SELF method=POST>\n";
echo "<input type=hidden name=ADD value=211>\n";
echo "<center><TABLE width=600 cellspacing=3>\n";
echo "<tr bgcolor=#B6D3FC><td align=right>Número de la Conferencia: </td><td align=left><input type=text name=conf_exten size=8 maxlength=7> (Solamente dígitos)$NWB#conferences-conf_exten$NWE</td></tr>\n";
echo "<tr bgcolor=#B6D3FC><td align=right>IP Del Servidor: </td><td align=left><select size=1 name=server_ip>\n";

echo "$servers_list";
echo "<option SELECTED>$server_ip</option>\n";
echo "</select>$NWB#conferences-server_ip$NWE</td></tr>\n";
echo "<tr bgcolor=#B6D3FC><td align=center colspan=2><input type=submit name=submit VALUE=ENVIAR></td></tr>\n";
echo "</TABLE></center>\n";

}


######################
# ADD=2 adds the new phone to the system
######################

if ($ADD==2)
{
	echo "<FONT FACE=\"ARIAL,HELVETICA\" COLOR=BLACK SIZE=2>";
	$stmt="SELECT count(*) from phones where extension='$extension' and server_ip='$server_ip';";
	$rslt=mysql_query($stmt, $link);
	$row=mysql_fetch_row($rslt);
	if ($row[0] > 0)
		{echo "<br>TELÉFONO NO AGREGADO - hay ya un teléfono en el sistema con esta extensión/servidor\n";}
	else
		{
		 if ( (strlen($extension) < 1) or (strlen($server_ip) < 7) or (strlen($dialplan_number) < 1) or (strlen($voicemail_id) < 1) or (strlen($login) < 1)  or (strlen($pass) < 1))
			{echo "<br>TELÉFONO NO AGREGADO - vaya por favor detrás y mire los datos que usted incorporó\n";}
		 else
			{
			echo "<br>EL TELÉFONO AGREGÚ\n";

			$stmt="INSERT INTO phones (extension,dialplan_number,voicemail_id,phone_ip,computer_ip,server_ip,login,pass,status,active,phone_type,fullname,company,picture,protocol,local_gmt,outbound_cid) values('$extension','$dialplan_number','$voicemail_id','$phone_ip','$computer_ip','$server_ip','$login','$pass','$status','$active','$phone_type','$fullname','$company','$picture','$protocol','$local_gmt','$outbound_cid');";
			$rslt=mysql_query($stmt, $link);
			}
		}
$ADD=3;
}

######################
# ADD=21 adds the new server to the system
######################

if ($ADD==21)
{
	echo "<FONT FACE=\"ARIAL,HELVETICA\" COLOR=BLACK SIZE=2>";
	$stmt="SELECT count(*) from servers where server_id='$server_id';";
	$rslt=mysql_query($stmt, $link);
	$row=mysql_fetch_row($rslt);
	if ($row[0] > 0)
		{echo "<br>SERVIDOR NO AGREGADO - hay ya un servidor en el sistema con esta identificación\n";}
	else
		{
		 if ( (strlen($server_id) < 1) or (strlen($server_ip) < 7) )
			{echo "<br>SERVIDOR NO AGREGADO - vaya por favor detrás y mire los datos que usted incorporó\n";}
		 else
			{
			echo "<br>SERVIDOR AGREGADO\n";

			$stmt="INSERT INTO servers (server_id,server_description,server_ip,active,asterisk_version) values('$server_id','$server_description','$server_ip','$active','$asterisk_version');";
			$rslt=mysql_query($stmt, $link);
			}
		}
$ADD=31;
}


######################
# ADD=211 adds the new conference to the system
######################

if ($ADD==211)
{
	echo "<FONT FACE=\"ARIAL,HELVETICA\" COLOR=BLACK SIZE=2>";
	$stmt="SELECT count(*) from conferences where conf_exten='$conf_exten' and server_ip='$server_ip';";
	$rslt=mysql_query($stmt, $link);
	$row=mysql_fetch_row($rslt);
	if ($row[0] > 0)
		{echo "<br>CONFERENCIA NO AGREGADA - hay ya una conferencia en el sistema con esta identificación y servidor\n";}
	else
		{
		 if ( (strlen($conf_exten) < 1) or (strlen($server_ip) < 7) )
			{echo "<br>CONFERENCIA NO AGREGADA - vaya por favor detrás y mire los datos que usted incorporó\n";}
		 else
			{
			echo "<br>LA CONFERENCIA AGREGÚ\n";

			$stmt="INSERT INTO conferences (conf_exten,server_ip) values('$conf_exten','$server_ip');";
			$rslt=mysql_query($stmt, $link);
			}
		}
$ADD=100;
}


######################################################################################################
######################################################################################################
#######   5 series, delete records confirmation
######################################################################################################
######################################################################################################


######################
# ADD=5 confirmation before deletion of phone
######################

if ($ADD==5)
{
	echo "<FONT FACE=\"ARIAL,HELVETICA\" COLOR=BLACK SIZE=2>";

	 if ( (strlen($extension) < 2) or (strlen($server_ip) < 7) or ($LOGdelete_phones < 1) )
		{
		 echo "<br>TELÉFONO NO SUPRIMIDO - Vaya por favor detrás y mire los datos que usted incorporó\n";
		 echo "<br>Extension be at least 2 characters in length\n";
		 echo "<br>IP Del Servidor be at least 7 characters in length\n";
		}
	 else
		{
		echo "<br><B>CONFIRMACIÓN DE LA CANCELADURA DEL TELÉFONO: $extension - $server_ip</B>\n";
		echo "<br><br><a href=\"$PHP_SELF?ADD=6&extension=$extension&server_ip=$server_ip&CoNfIrM=YES\">Chasque aquí para suprimir el teléfono $extension - $server_ip</a><br><br><br>\n";
		}

$ADD='3';		# go to phone modification below
}




######################################################################################################
######################################################################################################
#######   6 series, delete records
######################################################################################################
######################################################################################################


######################
# ADD=6 delete phone record
######################

if ($ADD==6)
{
	echo "<FONT FACE=\"ARIAL,HELVETICA\" COLOR=BLACK SIZE=2>";

	 if ( (strlen($extension) < 2) or (strlen($server_ip) < 7) or ($CoNfIrM != 'YES') or ($LOGdelete_phones < 1) )
		{
		 echo "<br>TELÉFONO NO SUPRIMIDO - Vaya por favor detrás y mire los datos que usted incorporó\n";
		 echo "<br>Extension be at least 2 characters in length\n";
		 echo "<br>IP Del Servidor be at least 7 characters in length\n";
		}
	 else
		{
		$stmt="DELETE from phones where extension='$extension' and server_ip='$server_ip' limit 1;";
		$rslt=mysql_query($stmt, $link);

		### LOG CHANGES TO LOG FILE ###
		if ($WeBRooTWritablE > 0)
			{
			$fp = fopen ("./admin_changes_log.txt", "a");
			fwrite ($fp, "$date|!!!DELETING PHONE!!!|$PHP_AUTH_USER|$ip|extension='$extension'|server_ip='$server_ip'|\n");
			fclose($fp);
			}
		echo "<br><B>LA CANCELADURA DEL TELÉFONO TERMINÓ: $extension - $server_ip</B>\n";
		echo "<br><br>\n";
		}

$ADD='0';		# go to phone list
}






######################
# ADD=3 modify phone info in the system
######################

if ($ADD==3)
{
	echo "<FONT FACE=\"ARIAL,HELVETICA\" COLOR=BLACK SIZE=2>";

	$stmt="SELECT * from phones where extension='$extension' and server_ip='$server_ip';";
	$rslt=mysql_query($stmt, $link);
	$row=mysql_fetch_row($rslt);

echo "<br>MODIFICANDO EL TELÉFONO: $row[1]<form action=$PHP_SELF method=POST>\n";
echo "<input type=hidden name=ADD value=4>\n";
echo "<input type=hidden name=old_extension value=\"$row[0]\">\n";
echo "<input type=hidden name=old_server_ip value=\"$row[5]\">\n";
echo "<center><TABLE width=600 cellspacing=3>\n";
echo "<tr bgcolor=#B6D3FC><td align=right>Extensión del teléfono: </td><td align=left><input type=text name=extension size=20 maxlength=100 value=\"$row[0]\">$NWB#phones-extension$NWE</td></tr>\n";
echo "<tr bgcolor=#B6D3FC><td align=right>Número De Dialplan: </td><td align=left><input type=text name=dialplan_number size=15 maxlength=20 value=\"$row[1]\"> (Solamente dígitos)$NWB#phones-dialplan_number$NWE</td></tr>\n";
echo "<tr bgcolor=#B6D3FC><td align=right>Buzón de voz: </td><td align=left><input type=text name=voicemail_id size=10 maxlength=10 value=\"$row[2]\"> (Solamente dígitos)$NWB#phones-voicemail_id$NWE</td></tr>\n";
echo "<tr bgcolor=#B6D3FC><td align=right>CallerID De salida: </td><td align=left><input type=text name=outbound_cid size=10 maxlength=20 value=\"$row[65]\"> (Solamente dígitos)$NWB#phones-outbound_cid$NWE</td></tr>\n";
echo "<tr bgcolor=#B6D3FC><td align=right>Dirección IP del teléfono: </td><td align=left><input type=text name=phone_ip size=20 maxlength=15 value=\"$row[3]\"> (optional)$NWB#phones-phone_ip$NWE</td></tr>\n";
echo "<tr bgcolor=#B6D3FC><td align=right>Dirección IP del ordenador: </td><td align=left><input type=text name=computer_ip size=20 maxlength=15 value=\"$row[4]\"> (optional)$NWB#phones-computer_ip$NWE</td></tr>\n";
echo "<tr bgcolor=#B6D3FC><td align=right>IP Del Servidor: </td><td align=left><select size=1 name=server_ip>\n";

echo "$servers_list";
echo "<option SELECTED>$row[5]</option>\n";
echo "</select>$NWB#phones-server_ip$NWE</td></tr>\n";
echo "<tr bgcolor=#B6D3FC><td align=right>Login: </td><td align=left><input type=text name=login size=10 maxlength=10 value=\"$row[6]\">$NWB#phones-login$NWE</td></tr>\n";
echo "<tr bgcolor=#B6D3FC><td align=right>Contraseña: </td><td align=left><input type=text name=pass size=10 maxlength=10 value=\"$row[7]\">$NWB#phones-pass$NWE</td></tr>\n";
echo "<tr bgcolor=#B6D3FC><td align=right>Estado: </td><td align=left><select size=1 name=status><option>ACTIVO</option><option>SUSPENDED</option><option>CLOSED</option><option>PENDING</option><option>ADMIN</option><option selected>$row[8]</option></select>$NWB#phones-status$NWE</td></tr>\n";
echo "<tr bgcolor=#B6D3FC><td align=right>Cuenta Activa: </td><td align=left><select size=1 name=active><option>Y</option><option>N</option><option selected>$row[9]</option></select>$NWB#phones-active$NWE</td></tr>\n";
echo "<tr bgcolor=#B6D3FC><td align=right>Tipo Del Teléfono: </td><td align=left><input type=text name=phone_type size=20 maxlength=50 value=\"$row[10]\">$NWB#phones-phone_type$NWE</td></tr>\n";
echo "<tr bgcolor=#B6D3FC><td align=right>Nombre Completo: </td><td align=left><input type=text name=fullname size=20 maxlength=50 value=\"$row[11]\">$NWB#phones-fullname$NWE</td></tr>\n";
echo "<tr bgcolor=#B6D3FC><td align=right>Compañía: </td><td align=left><input type=text name=company size=10 maxlength=10 value=\"$row[12]\">$NWB#phones-company$NWE</td></tr>\n";
echo "<tr bgcolor=#B6D3FC><td align=right>Foto: </td><td align=left><input type=text name=picture size=20 maxlength=19 value=\"$row[13]\">$NWB#phones-picture$NWE</td></tr>\n";
echo "<tr bgcolor=#B6D3FC><td align=right>Mensajes Nuevos: </td><td align=left><b>$row[14]</b>$NWB#phones-messages$NWE</td></tr>\n";
echo "<tr bgcolor=#B6D3FC><td align=right>Mensajes Viejos: </td><td align=left><b>$row[15]</b>$NWB#phones-old_messages$NWE</td></tr>\n";
echo "<tr bgcolor=#B6D3FC><td align=right>Protocolo Del Cliente: </td><td align=left><select size=1 name=protocol><option>SIP</option><option>Zap</option><option>IAX2</option><option>EXTERNAL</option><option selected>$row[16]</option></select>$NWB#phones-protocol$NWE</td></tr>\n";
echo "<tr bgcolor=#B6D3FC><td align=right>GMT Local: </td><td align=left><select size=1 name=local_gmt><option>12</option><option>11</option><option>10</option><option>9</option><option>8</option><option>7</option><option>6</option><option>5</option><option>4</option><option>3</option><option>2</option><option>1</option><option>0</option><option>-1</option><option>-2</option><option>-3</option><option>-4</option><option>-5</option><option>-6</option><option>-7</option><option>-8</option><option>-9</option><option>-10</option><option>-11</option><option>-12</option><option selected>$row[17]</option></select> (No ajustar para el DST)$NWB#phones-local_gmt$NWE</td></tr>\n";
echo "<tr bgcolor=#B6D3FC><td align=right>Login del Manager: </td><td align=left><input type=text name=ASTmgrUSERNAME size=20 maxlength=20 value=\"$row[18]\">$NWB#phones-ASTmgrUSERNAME$NWE</td></tr>\n";
echo "<tr bgcolor=#B6D3FC><td align=right>Contraseña del Manager: </td><td align=left><input type=text name=ASTmgrSECRET size=20 maxlength=20 value=\"$row[19]\">$NWB#phones-ASTmgrSECRET$NWE</td></tr>\n";
echo "<tr bgcolor=#B6D3FC><td align=right>Usuario por defecto de VICIDIAL: </td><td align=left><input type=text name=login_user size=20 maxlength=20 value=\"$row[20]\">$NWB#phones-login_user$NWE</td></tr>\n";
echo "<tr bgcolor=#B6D3FC><td align=right>Contraseña por defecto  de VICIDIAL: </td><td align=left><input type=text name=login_pass size=20 maxlength=20 value=\"$row[21]\">$NWB#phones-login_pass$NWE</td></tr>\n";
echo "<tr bgcolor=#B6D3FC><td align=right>Campaña por defecto de VICIDIAL: </td><td align=left><input type=text name=login_campaign size=10 maxlength=10 value=\"$row[22]\">$NWB#phones-login_campaign$NWE</td></tr>\n";
echo "<tr bgcolor=#B6D3FC><td align=right>Extensión del parking: </td><td align=left><input type=text name=park_on_extension size=10 maxlength=10 value=\"$row[23]\">$NWB#phones-park_on_extension$NWE</td></tr>\n";
echo "<tr bgcolor=#B6D3FC><td align=right>Extensión de la conferencia: </td><td align=left><input type=text name=conf_on_extension size=10 maxlength=10 value=\"$row[24]\">$NWB#phones-conf_on_extension$NWE</td></tr>\n";
echo "<tr bgcolor=#B6D3FC><td align=right>Exten. Del parking de VICIDIAL: </td><td align=left><input type=text name=VICIDIAL_park_on_extension size=10 maxlength=10 value=\"$row[25]\">$NWB#phones-VICIDIAL_park_on_extension$NWE</td></tr>\n";
echo "<tr bgcolor=#B6D3FC><td align=right>Archivo para música del parking de VICIDIAL: </td><td align=left><input type=text name=VICIDIAL_park_on_filename size=10 maxlength=10 value=\"$row[26]\">$NWB#phones-VICIDIAL_park_on_filename$NWE</td></tr>\n";
echo "<tr bgcolor=#B6D3FC><td align=right>Prefijo al monitorizar: </td><td align=left><input type=text name=monitor_prefix size=10 maxlength=10 value=\"$row[27]\">$NWB#phones-monitor_prefix$NWE</td></tr>\n";
echo "<tr bgcolor=#B6D3FC><td align=right>Exten de Grabación: </td><td align=left><input type=text name=recording_exten size=10 maxlength=10 value=\"$row[28]\">$NWB#phones-recording_exten$NWE</td></tr>\n";
echo "<tr bgcolor=#B6D3FC><td align=right>Exten de VmailMain: </td><td align=left><input type=text name=voicemail_exten size=10 maxlength=10 value=\"$row[29]\">$NWB#phones-voicemail_exten$NWE</td></tr>\n";
echo "<tr bgcolor=#B6D3FC><td align=right>Exten de VmaiDumpl: </td><td align=left><input type=text name=voicemail_dump_exten size=20 maxlength=20 value=\"$row[30]\">$NWB#phones-voicemail_dump_exten$NWE</td></tr>\n";
echo "<tr bgcolor=#B6D3FC><td align=right>Contexto De Exten: </td><td align=left><input type=text name=ext_context size=20 maxlength=20 value=\"$row[31]\">$NWB#phones-ext_context$NWE</td></tr>\n";
echo "<tr bgcolor=#B6D3FC><td align=right>Canal de envío del DTMF: </td><td align=left><input type=text name=dtmf_send_extension size=40 maxlength=100 value=\"$row[32]\">$NWB#phones-dtmf_send_extension$NWE</td></tr>\n";
echo "<tr bgcolor=#B6D3FC><td align=right>Grupo de las llamadas de salida: </td><td align=left><input type=text name=call_out_number_group size=40 maxlength=100 value=\"$row[33]\">$NWB#phones-call_out_number_group$NWE</td></tr>\n";
echo "<tr bgcolor=#B6D3FC><td align=right>Localización del Navegador: </td><td align=left><input type=text name=client_browser size=40 maxlength=100 value=\"$row[34]\">$NWB#phones-client_browser$NWE</td></tr>\n";
echo "<tr bgcolor=#B6D3FC><td align=right>Directorio de instalación: </td><td align=left><input type=text name=install_directory size=40 maxlength=100 value=\"$row[35]\">$NWB#phones-install_directory$NWE</td></tr>\n";
echo "<tr bgcolor=#B6D3FC><td align=right>URL del CallerID: </td><td align=left><input type=text name=local_web_callerID_URL size=40 maxlength=255 value=\"$row[36]\">$NWB#phones-local_web_callerID_URL$NWE</td></tr>\n";
echo "<tr bgcolor=#B6D3FC><td align=right>URL por defecto de VICIDIAL: </td><td align=left><input type=text name=VICIDIAL_web_URL size=40 maxlength=255 value=\"$row[37]\">$NWB#phones-VICIDIAL_web_URL$NWE</td></tr>\n";
echo "<tr bgcolor=#B6D3FC><td align=right>Call Logging: </td><td align=left><select size=1 name=AGI_call_logging_enabled><option>1</option><option>0</option><option selected>$row[38]</option></select>$NWB#phones-AGI_call_logging_enabled$NWE</td></tr>\n";
echo "<tr bgcolor=#B6D3FC><td align=right>Cambio de Usuario: </td><td align=left><select size=1 name=user_switching_enabled><option>1</option><option>0</option><option selected>$row[39]</option></select>$NWB#phones-user_switching_enabled$NWE</td></tr>\n";
echo "<tr bgcolor=#B6D3FC><td align=right>Conferencias: </td><td align=left><select size=1 name=conferencing_enabled><option>1</option><option>0</option><option selected>$row[40]</option></select>$NWB#phones-conferencing_enabled$NWE</td></tr>\n";
echo "<tr bgcolor=#B6D3FC><td align=right>Colgar del Admin: </td><td align=left><select size=1 name=admin_hangup_enabled><option>1</option><option>0</option><option selected>$row[41]</option></select>$NWB#phones-admin_hangup_enabled$NWE</td></tr>\n";
echo "<tr bgcolor=#B6D3FC><td align=right>Captura del Admin: </td><td align=left><select size=1 name=admin_hijack_enabled><option>1</option><option>0</option><option selected>$row[42]</option></select>$NWB#phones-admin_hijack_enabled$NWE</td></tr>\n";
echo "<tr bgcolor=#B6D3FC><td align=right>Monitorización del Admin: </td><td align=left><select size=1 name=admin_monitor_enabled><option>1</option><option>0</option><option selected>$row[43]</option></select>$NWB#phones-admin_monitor_enabled$NWE</td></tr>\n";
echo "<tr bgcolor=#B6D3FC><td align=right>Parking de Llamada: </td><td align=left><select size=1 name=call_parking_enabled><option>1</option><option>0</option><option selected>$row[44]</option></select>$NWB#phones-call_parking_enabled$NWE</td></tr>\n";
echo "<tr bgcolor=#B6D3FC><td align=right>Uptader Check: </td><td align=left><select size=1 name=updater_check_enabled><option>1</option><option>0</option><option selected>$row[45]</option></select>$NWB#phones-updater_check_enabled$NWE</td></tr>\n";
echo "<tr bgcolor=#B6D3FC><td align=right>AF Logging: </td><td align=left><select size=1 name=AFLogging_enabled><option>1</option><option>0</option><option selected>$row[46]</option></select>$NWB#phones-AFLogging_enabled$NWE</td></tr>\n";
echo "<tr bgcolor=#B6D3FC><td align=right>Colas permitidas: </td><td align=left><select size=1 name=QUEUE_ACTION_enabled><option>1</option><option>0</option><option selected>$row[47]</option></select>$NWB#phones-QUEUE_ACTION_enabled$NWE</td></tr>\n";
echo "<tr bgcolor=#B6D3FC><td align=right>Ventana emergente del CallerID: </td><td align=left><select size=1 name=CallerID_popup_enabled><option>1</option><option>0</option><option selected>$row[48]</option></select>$NWB#phones-CallerID_popup_enabled$NWE</td></tr>\n";
echo "<tr bgcolor=#B6D3FC><td align=right>Botón Vmail: </td><td align=left><select size=1 name=voicemail_button_enabled><option>1</option><option>0</option><option selected>$row[49]</option></select>$NWB#phones-voicemail_button_enabled$NWE</td></tr>\n";
echo "<tr bgcolor=#B6D3FC><td align=right>Refresco rápido: </td><td align=left><select size=1 name=enable_fast_refresh><option>1</option><option>0</option><option selected>$row[50]</option></select>$NWB#phones-enable_fast_refresh$NWE</td></tr>\n";
echo "<tr bgcolor=#B6D3FC><td align=right>Refresco rápido de la tarifa: </td><td align=left><input type=text size=5 name=fast_refresh_rate value=\"$row[51]\">(in ms)$NWB#phones-fast_refresh_rate$NWE</td></tr>\n";
echo "<tr bgcolor=#B6D3FC><td align=right>Persistant MySQL: </td><td align=left><select size=1 name=enable_persistant_mysql><option>1</option><option>0</option><option selected>$row[52]</option></select>$NWB#phones-enable_persistant_mysql$NWE</td></tr>\n";
echo "<tr bgcolor=#B6D3FC><td align=right>Auto Marcar el Siguiente Número: </td><td align=left><select size=1 name=auto_dial_next_number><option>1</option><option>0</option><option selected>$row[53]</option></select>$NWB#phones-auto_dial_next_number$NWE</td></tr>\n";
echo "<tr bgcolor=#B6D3FC><td align=right>Parar de Grabar después de cada llamada: </td><td align=left><select size=1 name=VDstop_rec_after_each_call><option>1</option><option>0</option><option selected>$row[54]</option></select>$NWB#phones-VDstop_rec_after_each_call$NWE</td></tr>\n";
echo "<tr bgcolor=#B6D3FC><td align=right>Servidor de DBX: </td><td align=left><input type=text name=DBX_server size=15 maxlength=15 value=\"$row[55]\"> (Primario DB Server)$NWB#phones-DBX_server$NWE</td></tr>\n";
echo "<tr bgcolor=#B6D3FC><td align=right>Base de datos de DBX: </td><td align=left><input type=text name=DBX_database size=15 maxlength=15 value=\"$row[56]\"> (Primario Server Database)$NWB#phones-DBX_database$NWE</td></tr>\n";
echo "<tr bgcolor=#B6D3FC><td align=right>Usuario de DBX: </td><td align=left><input type=text name=DBX_user size=15 maxlength=15 value=\"$row[57]\"> (Primario DB Login)$NWB#phones-DBX_user$NWE</td></tr>\n";
echo "<tr bgcolor=#B6D3FC><td align=right>Contraseña de DBX: </td><td align=left><input type=text name=DBX_pass size=15 maxlength=15 value=\"$row[58]\"> (Primario DB Secret)$NWB#phones-DBX_pass$NWE</td></tr>\n";
echo "<tr bgcolor=#B6D3FC><td align=right>Puerto de DBX: </td><td align=left><input type=text name=DBX_port size=6 maxlength=6 value=\"$row[59]\"> (Primario DB Port)$NWB#phones-DBX_port$NWE</td></tr>\n";
echo "<tr bgcolor=#B6D3FC><td align=right>Servidor de DBY: </td><td align=left><input type=text name=DBY_server size=15 maxlength=15 value=\"$row[60]\"> (Secundario DB Server)$NWB#phones-DBY_server$NWE</td></tr>\n";
echo "<tr bgcolor=#B6D3FC><td align=right>Base de datos de DBY: </td><td align=left><input type=text name=DBY_database size=15 maxlength=15 value=\"$row[61]\"> (Secundario Server Database)$NWB#phones-DBY_database$NWE</td></tr>\n";
echo "<tr bgcolor=#B6D3FC><td align=right>Usuario de DBY: </td><td align=left><input type=text name=DBY_user size=15 maxlength=15 value=\"$row[62]\"> (Secundario DB Login)$NWB#phones-DBY_user$NWE</td></tr>\n";
echo "<tr bgcolor=#B6D3FC><td align=right>Contraseña de DBY: </td><td align=left><input type=text name=DBY_pass size=15 maxlength=15 value=\"$row[63]\"> (Secundario DB Secret)$NWB#phones-DBY_pass$NWE</td></tr>\n";
echo "<tr bgcolor=#B6D3FC><td align=right>Puerto de DBY: </td><td align=left><input type=text name=DBY_port size=6 maxlength=6 value=\"$row[64]\"> (Secundario DB Port)$NWB#phones-DBY_port$NWE</td></tr>\n";
echo "<tr bgcolor=#B6D3FC><td align=center colspan=2><input type=submit name=submit VALUE=ENVIAR></td></tr>\n";
echo "</TABLE></center>\n";

echo "<br><br><a href=\"./phone_stats.php?extension=$row[0]&server_ip=$row[5]\">Pinchar aquí­ para ver las estadísticas del teléfono</a>\n";

if ($LOGdelete_phones > 0)
	{
	echo "<br><br><a href=\"$PHP_SELF?ADD=5&extension=$extension&server_ip=$server_ip\">SUPRIMA ESTE TELÉFONO</a>\n";
	}

}


######################
# ADD=31 modify server info in the system
######################

if ($ADD==31)
{
	echo "<FONT FACE=\"ARIAL,HELVETICA\" COLOR=BLACK SIZE=2>";

	$stmt="SELECT * from servers where server_id='$server_id';";
	$rslt=mysql_query($stmt, $link);
	$row=mysql_fetch_row($rslt);

echo "<br>MODIFICAR UN REGISTRO DEL SERVIDOR: $row[0]<form action=$PHP_SELF method=POST>\n";
echo "<input type=hidden name=ADD value=41>\n";
echo "<input type=hidden name=old_server_id value=\"$server_id\">\n";
echo "<input type=hidden name=old_server_ip value=\"$row[2]\">\n";
echo "<center><TABLE width=600 cellspacing=3>\n";
echo "<tr bgcolor=#B6D3FC><td align=right>ID Del Servidor: </td><td align=left><input type=text name=server_id size=10 maxlength=10 value=\"$row[0]\">$NWB#servers-server_id$NWE</td></tr>\n";
echo "<tr bgcolor=#B6D3FC><td align=right>Descripción Del Servidor: </td><td align=left><input type=text name=server_description size=30 maxlength=255 value=\"$row[1]\">$NWB#servers-server_description$NWE</td></tr>\n";
echo "<tr bgcolor=#B6D3FC><td align=right>Dirección IP del Servidor: </td><td align=left><input type=text name=server_ip size=20 maxlength=15 value=\"$row[2]\">$NWB#servers-server_ip$NWE</td></tr>\n";
echo "<tr bgcolor=#B6D3FC><td align=right>Activo: </td><td align=left><select size=1 name=active><option>Y</option><option>N</option><option selected>$row[3]</option></select>$NWB#servers-active$NWE</td></tr>\n";
echo "<tr bgcolor=#B6D3FC><td align=right>Versión De Asterisk: </td><td align=left><input type=text name=asterisk_version size=20 maxlength=20 value=\"$row[4]\">$NWB#servers-asterisk_version$NWE</td></tr>\n";
echo "<tr bgcolor=#B6D3FC><td align=right>Máx. Trunks en VICIDIAL: </td><td align=left><input type=text name=max_vicidial_trunks size=5 maxlength=4 value=\"$row[5]\">$NWB#servers-max_vicidial_trunks$NWE</td></tr>\n";
echo "<tr bgcolor=#B6D3FC><td align=right>Host Del Telnet: </td><td align=left><input type=text name=telnet_host size=20 maxlength=20 value=\"$row[6]\">$NWB#servers-telnet_host$NWE</td></tr>\n";
echo "<tr bgcolor=#B6D3FC><td align=right>Puerto Del Telnet: </td><td align=left><input type=text name=telnet_port size=6 maxlength=5 value=\"$row[7]\">$NWB#servers-telnet_port$NWE</td></tr>\n";
echo "<tr bgcolor=#B6D3FC><td align=right>Usuario Del Manager: </td><td align=left><input type=text name=ASTmgrUSERNAME size=20 maxlength=20 value=\"$row[8]\">$NWB#servers-ASTmgrUSERNAME$NWE</td></tr>\n";
echo "<tr bgcolor=#B6D3FC><td align=right>Contraseña del Manager: </td><td align=left><input type=text name=ASTmgrSECRET size=20 maxlength=20 value=\"$row[9]\">$NWB#servers-ASTmgrSECRET$NWE</td></tr>\n";
echo "<tr bgcolor=#B6D3FC><td align=right>Usuario del Updater del Manager: </td><td align=left><input type=text name=ASTmgrUSERNAMEupdate size=20 maxlength=20 value=\"$row[10]\">$NWB#servers-ASTmgrUSERNAMEupdate$NWE</td></tr>\n";
echo "<tr bgcolor=#B6D3FC><td align=right>Usuario Listen del Manager: </td><td align=left><input type=text name=ASTmgrUSERNAMElisten size=20 maxlength=20 value=\"$row[11]\">$NWB#servers-ASTmgrUSERNAMElisten$NWE</td></tr>\n";
echo "<tr bgcolor=#B6D3FC><td align=right>Usuario Send del Manager: </td><td align=left><input type=text name=ASTmgrUSERNAMEsend size=20 maxlength=20 value=\"$row[12]\">$NWB#servers-ASTmgrUSERNAMEsend$NWE</td></tr>\n";
echo "<tr bgcolor=#B6D3FC><td align=right>GMT Local: </td><td align=left><select size=1 name=local_gmt><option>12</option><option>11</option><option>10</option><option>9</option><option>8</option><option>7</option><option>6</option><option>5</option><option>4</option><option>3</option><option>2</option><option>1</option><option>0</option><option>-1</option><option>-2</option><option>-3</option><option>-4</option><option>-5</option><option>-6</option><option>-7</option><option>-8</option><option>-9</option><option>-10</option><option>-11</option><option>-12</option><option selected>$row[13]</option></select> (No ajustar para el DST)$NWB#servers-local_gmt$NWE</td></tr>\n";
echo "<tr bgcolor=#B6D3FC><td align=right>Extensión de Vmail Dump : </td><td align=left><input type=text name=voicemail_dump_exten size=20 maxlength=20 value=\"$row[14]\">$NWB#servers-voicemail_dump_exten$NWE</td></tr>\n";
echo "<tr bgcolor=#B6D3FC><td align=right>Extensión del AD de VICIDIAL: </td><td align=left><input type=text name=answer_transfer_agent size=20 maxlength=20 value=\"$row[15]\">$NWB#servers-answer_transfer_agent$NWE</td></tr>\n";
echo "<tr bgcolor=#B6D3FC><td align=right>Contexto por Defecto: </td><td align=left><input type=text name=ext_context size=20 maxlength=20 value=\"$row[16]\">$NWB#servers-ext_context$NWE</td></tr>\n";
echo "<tr bgcolor=#B6D3FC><td align=center colspan=2><input type=submit name=submit VALUE=ENVIAR></td></tr>\n";
echo "</TABLE></center>\n";

echo "<center>\n";
echo "<br><b>TELÉFONOS DENTRO DE ESTE SERVIDOR:</b><br>\n";
echo "<TABLE width=400 cellspacing=3>\n";
echo "<tr><td>EXTENSIÓN</td><td>NOMBRE</td><td>ACTIVO</td></tr>\n";

	$active_lists = 0;
	$inactive_lists = 0;
	$stmt="SELECT extension,active,fullname from phones where server_ip='$row[2]'";
	$rsltx=mysql_query($stmt, $link);
	$lists_to_print = mysql_num_rows($rsltx);
	$camp_lists='';

	$o=0;
	while ($lists_to_print > $o) {
		$rowx=mysql_fetch_row($rsltx);
		$o++;
	if (ereg("Y", $rowx[1])) {$active_lists++;   $camp_lists .= "'$rowx[0]',";}
	if (ereg("N", $rowx[1])) {$inactive_lists++;}

	if (eregi("1$|3$|5$|7$|9$", $o))
		{$bgcolor='bgcolor="#B9CBFD"';} 
	else
		{$bgcolor='bgcolor="#9BB9FB"';}

	echo "<tr $bgcolor><td><font size=1><a href=\"$PHP_SELF?ADD=3&extension=$rowx[0]&server_ip=$row[2]\">$rowx[0]</a></td><td><font size=1>$rowx[2]</td><td><font size=1>$rowx[1]</td></tr>\n";

	}

echo "</table></center><br>\n";
echo "<center><b>\n";

	$camp_lists = eregi_replace(".$","",$camp_lists);
echo "Este servidor tiene $active_lists Teléfonos activos y $inactive_lists Teléfonos inactivos<br><br>\n";
echo "</b></center>\n";
}


######################
# ADD=311 modify conference info in the system
######################

if ($ADD==311)
{
	echo "<FONT FACE=\"ARIAL,HELVETICA\" COLOR=BLACK SIZE=2>";

	$stmt="SELECT * from conferences where conf_exten='$conf_exten' and server_ip='$server_ip';";
	$rslt=mysql_query($stmt, $link);
	$row=mysql_fetch_row($rslt);

echo "<br>MODIFICAR UN REGISTRO DE LA CONFERENCIA: $row[0]<form action=$PHP_SELF method=POST>\n";
echo "<input type=hidden name=ADD value=411>\n";
echo "<input type=hidden name=old_conf_exten value=\"$row[0]\">\n";
echo "<input type=hidden name=old_server_ip value=\"$row[1]\">\n";
echo "<center><TABLE width=600 cellspacing=3>\n";
echo "<tr bgcolor=#B6D3FC><td align=right>Conferencia: </td><td align=left><input type=text name=conf_exten size=10 maxlength=7 value=\"$row[0]\">$NWB#conferences-conf_exten$NWE</td></tr>\n";
echo "<tr bgcolor=#B6D3FC><td align=right>IP Del Servidor: </td><td align=left><select size=1 name=server_ip>\n";

echo "$servers_list";
echo "<option SELECTED>$row[1]</option>\n";
echo "</select>$NWB#conferences-server_ip$NWE</td></tr>\n";
echo "<tr bgcolor=#B6D3FC><td align=right>Extensión Actual: </td><td align=left><input type=text name=extension size=20 maxlength=20 value=\"$row[2]\"></td></tr>\n";
echo "<tr bgcolor=#B6D3FC><td align=center colspan=2><input type=submit name=submit VALUE=ENVIAR></td></tr>\n";
echo "</TABLE></center>\n";

echo "<center><b>\n";

}



######################
# ADD=4 submit phone modifications to the system
######################

if ($ADD==4)
{
	echo "<FONT FACE=\"ARIAL,HELVETICA\" COLOR=BLACK SIZE=2>";

	$stmt="SELECT count(*) from phones where extension='$extension' and server_ip='$server_ip';";
	$rslt=mysql_query($stmt, $link);
	$row=mysql_fetch_row($rslt);
	if ( ($row[0] > 0) && ( ($extension != $old_extension) or ($server_ip != $old_server_ip) ) )
		{echo "<br>TELÉFONO NO MODIFICADO - hay ya un teléfono en el sistema con esta extensión/servidor\n";}
	else
		{
			 if ( (strlen($extension) < 1) or (strlen($server_ip) < 7) or (strlen($dialplan_number) < 1) or (strlen($voicemail_id) < 1) or (strlen($login) < 1)  or (strlen($pass) < 1))
			{echo "<br>TELÉFONO NO MODIFICADO - vaya por favor detrás y mire los datos que usted incorporó\n";}
		 else
			{
			echo "<br>TELÉFONO MODIFICADO: $extension\n";

			$stmt="UPDATE phones set extension='$extension', dialplan_number='$dialplan_number', voicemail_id='$voicemail_id', phone_ip='$phone_ip', computer_ip='$computer_ip', server_ip='$server_ip', login='$login', pass='$pass', status='$status', active='$active', phone_type='$phone_type', fullname='$fullname', company='$company', picture='$picture', protocol='$protocol', local_gmt='$local_gmt', ASTmgrUSERNAME='$ASTmgrUSERNAME', ASTmgrSECRET='$ASTmgrSECRET', login_user='$login_user', login_pass='$login_pass', login_campaign='$login_campaign', park_on_extension='$park_on_extension', conf_on_extension='$conf_on_extension', VICIDIAL_park_on_extension='$VICIDIAL_park_on_extension', VICIDIAL_park_on_filename='$VICIDIAL_park_on_filename', monitor_prefix='$monitor_prefix', recording_exten='$recording_exten', voicemail_exten='$voicemail_exten', voicemail_dump_exten='$voicemail_dump_exten', ext_context='$ext_context', dtmf_send_extension='$dtmf_send_extension', call_out_number_group='$call_out_number_group', client_browser='$client_browser', install_directory='$install_directory', local_web_callerID_URL='" . mysql_real_escape_string($local_web_callerID_URL) . "', VICIDIAL_web_URL='" . mysql_real_escape_string($VICIDIAL_web_URL) . "', AGI_call_logging_enabled='$AGI_call_logging_enabled', user_switching_enabled='$user_switching_enabled', conferencing_enabled='$conferencing_enabled', admin_hangup_enabled='$admin_hangup_enabled', admin_hijack_enabled='$admin_hijack_enabled', admin_monitor_enabled='$admin_monitor_enabled', call_parking_enabled='$call_parking_enabled', updater_check_enabled='$updater_check_enabled', AFLogging_enabled='$AFLogging_enabled', QUEUE_ACTION_enabled='$QUEUE_ACTION_enabled', CallerID_popup_enabled='$CallerID_popup_enabled', voicemail_button_enabled='$voicemail_button_enabled', enable_fast_refresh='$enable_fast_refresh', fast_refresh_rate='$fast_refresh_rate', enable_persistant_mysql='$enable_persistant_mysql', auto_dial_next_number='$auto_dial_next_number', VDstop_rec_after_each_call='$VDstop_rec_after_each_call', DBX_server='$DBX_server', DBX_database='$DBX_database', DBX_user='$DBX_user', DBX_pass='$DBX_pass', DBX_port='$DBX_port', DBY_server='$DBY_server', DBY_database='$DBY_database', DBY_user='$DBY_user', DBY_pass='$DBY_pass', DBY_port='$DBY_port', outbound_cid='$outbound_cid' where extension='$old_extension' and server_ip='$old_server_ip';";
			$rslt=mysql_query($stmt, $link);
			}
		}

	$stmt="SELECT * from phones where extension='$extension' and server_ip='$server_ip';";
	$rslt=mysql_query($stmt, $link);
	$row=mysql_fetch_row($rslt);

echo "<br>MODIFICANDO EL TELÉFONO: $row[1]<form action=$PHP_SELF method=POST>\n";
echo "<input type=hidden name=ADD value=4>\n";
echo "<input type=hidden name=old_extension value=\"$row[0]\">\n";
echo "<input type=hidden name=old_server_ip value=\"$row[5]\">\n";
echo "<center><TABLE width=600 cellspacing=3>\n";
echo "<tr bgcolor=#B6D3FC><td align=right>Extensión del teléfono: </td><td align=left><input type=text name=extension size=20 maxlength=100 value=\"$row[0]\">$NWB#phones-extension$NWE</td></tr>\n";
echo "<tr bgcolor=#B6D3FC><td align=right>Número De Dialplan: </td><td align=left><input type=text name=dialplan_number size=15 maxlength=20 value=\"$row[1]\"> (Solamente dígitos)$NWB#phones-dialplan_number$NWE</td></tr>\n";
echo "<tr bgcolor=#B6D3FC><td align=right>Buzón de voz: </td><td align=left><input type=text name=voicemail_id size=10 maxlength=10 value=\"$row[2]\"> (Solamente dígitos)$NWB#phones-voicemail_id$NWE</td></tr>\n";
echo "<tr bgcolor=#B6D3FC><td align=right>CallerID De salida: </td><td align=left><input type=text name=outbound_cid size=10 maxlength=20 value=\"$row[65]\"> (Solamente dígitos)$NWB#phones-outbound_cid$NWE</td></tr>\n";
echo "<tr bgcolor=#B6D3FC><td align=right>Dirección IP del teléfono: </td><td align=left><input type=text name=phone_ip size=20 maxlength=15 value=\"$row[3]\"> (optional)$NWB#phones-phone_ip$NWE</td></tr>\n";
echo "<tr bgcolor=#B6D3FC><td align=right>Dirección IP del ordenador: </td><td align=left><input type=text name=computer_ip size=20 maxlength=15 value=\"$row[4]\"> (optional)$NWB#phones-computer_ip$NWE</td></tr>\n";
echo "<tr bgcolor=#B6D3FC><td align=right>IP Del Servidor: </td><td align=left><select size=1 name=server_ip>\n";

echo "$servers_list";
echo "<option SELECTED>$row[5]</option>\n";
echo "</select>$NWB#phones-server_ip$NWE</td></tr>\n";
echo "<tr bgcolor=#B6D3FC><td align=right>Login: </td><td align=left><input type=text name=login size=10 maxlength=10 value=\"$row[6]\">$NWB#phones-login$NWE</td></tr>\n";
echo "<tr bgcolor=#B6D3FC><td align=right>Contraseña: </td><td align=left><input type=text name=pass size=10 maxlength=10 value=\"$row[7]\">$NWB#phones-pass$NWE</td></tr>\n";
echo "<tr bgcolor=#B6D3FC><td align=right>Estado: </td><td align=left><select size=1 name=status><option>ACTIVO</option><option>SUSPENDED</option><option>CLOSED</option><option>PENDING</option><option>ADMIN</option><option selected>$row[8]</option></select>$NWB#phones-status$NWE</td></tr>\n";
echo "<tr bgcolor=#B6D3FC><td align=right>Cuenta Activa: </td><td align=left><select size=1 name=active><option>Y</option><option>N</option><option selected>$row[9]</option></select>$NWB#phones-active$NWE</td></tr>\n";
echo "<tr bgcolor=#B6D3FC><td align=right>Tipo Del Teléfono: </td><td align=left><input type=text name=phone_type size=20 maxlength=50 value=\"$row[10]\">$NWB#phones-phone_type$NWE</td></tr>\n";
echo "<tr bgcolor=#B6D3FC><td align=right>Nombre Completo: </td><td align=left><input type=text name=fullname size=20 maxlength=50 value=\"$row[11]\">$NWB#phones-fullname$NWE</td></tr>\n";
echo "<tr bgcolor=#B6D3FC><td align=right>Compañía: </td><td align=left><input type=text name=company size=10 maxlength=10 value=\"$row[12]\">$NWB#phones-company$NWE</td></tr>\n";
echo "<tr bgcolor=#B6D3FC><td align=right>Foto: </td><td align=left><input type=text name=picture size=20 maxlength=19 value=\"$row[13]\">$NWB#phones-picture$NWE</td></tr>\n";
echo "<tr bgcolor=#B6D3FC><td align=right>Mensajes Nuevos: </td><td align=left><b>$row[14]</b>$NWB#phones-messages$NWE</td></tr>\n";
echo "<tr bgcolor=#B6D3FC><td align=right>Mensajes Viejos: </td><td align=left><b>$row[15]</b>$NWB#phones-old_messages$NWE</td></tr>\n";
echo "<tr bgcolor=#B6D3FC><td align=right>Protocolo Del Cliente: </td><td align=left><select size=1 name=protocol><option>SIP</option><option>Zap</option><option>IAX2</option><option>EXTERNAL</option><option selected>$row[16]</option></select>$NWB#phones-protocol$NWE</td></tr>\n";
echo "<tr bgcolor=#B6D3FC><td align=right>GMT Local: </td><td align=left><select size=1 name=local_gmt><option>12</option><option>11</option><option>10</option><option>9</option><option>8</option><option>7</option><option>6</option><option>5</option><option>4</option><option>3</option><option>2</option><option>1</option><option>0</option><option>-1</option><option>-2</option><option>-3</option><option>-4</option><option>-5</option><option>-6</option><option>-7</option><option>-8</option><option>-9</option><option>-10</option><option>-11</option><option>-12</option><option selected>$row[17]</option></select> (No ajustar para el DST)$NWB#phones-local_gmt$NWE</td></tr>\n";
echo "<tr bgcolor=#B6D3FC><td align=right>Login del Manager: </td><td align=left><input type=text name=ASTmgrUSERNAME size=20 maxlength=20 value=\"$row[18]\">$NWB#phones-ASTmgrUSERNAME$NWE</td></tr>\n";
echo "<tr bgcolor=#B6D3FC><td align=right>Contraseña del Manager: </td><td align=left><input type=text name=ASTmgrSECRET size=20 maxlength=20 value=\"$row[19]\">$NWB#phones-ASTmgrSECRET$NWE</td></tr>\n";
echo "<tr bgcolor=#B6D3FC><td align=right>Usuario por defecto de VICIDIAL: </td><td align=left><input type=text name=login_user size=20 maxlength=20 value=\"$row[20]\">$NWB#phones-login_user$NWE</td></tr>\n";
echo "<tr bgcolor=#B6D3FC><td align=right>Contraseña por defecto  de VICIDIAL: </td><td align=left><input type=text name=login_pass size=20 maxlength=20 value=\"$row[21]\">$NWB#phones-login_pass$NWE</td></tr>\n";
echo "<tr bgcolor=#B6D3FC><td align=right>Campaña por defecto de VICIDIAL: </td><td align=left><input type=text name=login_campaign size=10 maxlength=10 value=\"$row[22]\">$NWB#phones-login_campaign$NWE</td></tr>\n";
echo "<tr bgcolor=#B6D3FC><td align=right>Extensión del parking: </td><td align=left><input type=text name=park_on_extension size=10 maxlength=10 value=\"$row[23]\">$NWB#phones-park_on_extension$NWE</td></tr>\n";
echo "<tr bgcolor=#B6D3FC><td align=right>Extensión de la conferencia: </td><td align=left><input type=text name=conf_on_extension size=10 maxlength=10 value=\"$row[24]\">$NWB#phones-conf_on_extension$NWE</td></tr>\n";
echo "<tr bgcolor=#B6D3FC><td align=right>Exten. Del parking de VICIDIAL: </td><td align=left><input type=text name=VICIDIAL_park_on_extension size=10 maxlength=10 value=\"$row[25]\">$NWB#phones-VICIDIAL_park_on_extension$NWE</td></tr>\n";
echo "<tr bgcolor=#B6D3FC><td align=right>Archivo para música del parking de VICIDIAL: </td><td align=left><input type=text name=VICIDIAL_park_on_filename size=10 maxlength=10 value=\"$row[26]\">$NWB#phones-VICIDIAL_park_on_filename$NWE</td></tr>\n";
echo "<tr bgcolor=#B6D3FC><td align=right>Prefijo al monitorizar: </td><td align=left><input type=text name=monitor_prefix size=10 maxlength=10 value=\"$row[27]\">$NWB#phones-monitor_prefix$NWE</td></tr>\n";
echo "<tr bgcolor=#B6D3FC><td align=right>Exten de Grabación: </td><td align=left><input type=text name=recording_exten size=10 maxlength=10 value=\"$row[28]\">$NWB#phones-recording_exten$NWE</td></tr>\n";
echo "<tr bgcolor=#B6D3FC><td align=right>Exten de VmailMain: </td><td align=left><input type=text name=voicemail_exten size=10 maxlength=10 value=\"$row[29]\">$NWB#phones-voicemail_exten$NWE</td></tr>\n";
echo "<tr bgcolor=#B6D3FC><td align=right>Exten de VmaiDumpl: </td><td align=left><input type=text name=voicemail_dump_exten size=20 maxlength=20 value=\"$row[30]\">$NWB#phones-voicemail_dump_exten$NWE</td></tr>\n";
echo "<tr bgcolor=#B6D3FC><td align=right>Contexto De Exten: </td><td align=left><input type=text name=ext_context size=20 maxlength=20 value=\"$row[31]\">$NWB#phones-ext_context$NWE</td></tr>\n";
echo "<tr bgcolor=#B6D3FC><td align=right>Canal de envío del DTMF: </td><td align=left><input type=text name=dtmf_send_extension size=40 maxlength=100 value=\"$row[32]\">$NWB#phones-dtmf_send_extension$NWE</td></tr>\n";
echo "<tr bgcolor=#B6D3FC><td align=right>Grupo de las llamadas de salida: </td><td align=left><input type=text name=call_out_number_group size=40 maxlength=100 value=\"$row[33]\">$NWB#phones-call_out_number_group$NWE</td></tr>\n";
echo "<tr bgcolor=#B6D3FC><td align=right>Localización del Navegador: </td><td align=left><input type=text name=client_browser size=40 maxlength=100 value=\"$row[34]\">$NWB#phones-client_browser$NWE</td></tr>\n";
echo "<tr bgcolor=#B6D3FC><td align=right>Directorio de instalación: </td><td align=left><input type=text name=install_directory size=40 maxlength=100 value=\"$row[35]\">$NWB#phones-install_directory$NWE</td></tr>\n";
echo "<tr bgcolor=#B6D3FC><td align=right>URL del CallerID: </td><td align=left><input type=text name=local_web_callerID_URL size=40 maxlength=255 value=\"$row[36]\">$NWB#phones-local_web_callerID_URL$NWE</td></tr>\n";
echo "<tr bgcolor=#B6D3FC><td align=right>URL por defecto de VICIDIAL: </td><td align=left><input type=text name=VICIDIAL_web_URL size=40 maxlength=255 value=\"$row[37]\">$NWB#phones-VICIDIAL_web_URL$NWE</td></tr>\n";
echo "<tr bgcolor=#B6D3FC><td align=right>Call Logging: </td><td align=left><select size=1 name=AGI_call_logging_enabled><option>1</option><option>0</option><option selected>$row[38]</option></select>$NWB#phones-AGI_call_logging_enabled$NWE</td></tr>\n";
echo "<tr bgcolor=#B6D3FC><td align=right>Cambio de Usuario: </td><td align=left><select size=1 name=user_switching_enabled><option>1</option><option>0</option><option selected>$row[39]</option></select>$NWB#phones-user_switching_enabled$NWE</td></tr>\n";
echo "<tr bgcolor=#B6D3FC><td align=right>Conferencias: </td><td align=left><select size=1 name=conferencing_enabled><option>1</option><option>0</option><option selected>$row[40]</option></select>$NWB#phones-conferencing_enabled$NWE</td></tr>\n";
echo "<tr bgcolor=#B6D3FC><td align=right>Colgar del Admin: </td><td align=left><select size=1 name=admin_hangup_enabled><option>1</option><option>0</option><option selected>$row[41]</option></select>$NWB#phones-admin_hangup_enabled$NWE</td></tr>\n";
echo "<tr bgcolor=#B6D3FC><td align=right>Captura del Admin: </td><td align=left><select size=1 name=admin_hijack_enabled><option>1</option><option>0</option><option selected>$row[42]</option></select>$NWB#phones-admin_hijack_enabled$NWE</td></tr>\n";
echo "<tr bgcolor=#B6D3FC><td align=right>Monitorización del Admin: </td><td align=left><select size=1 name=admin_monitor_enabled><option>1</option><option>0</option><option selected>$row[43]</option></select>$NWB#phones-admin_monitor_enabled$NWE</td></tr>\n";
echo "<tr bgcolor=#B6D3FC><td align=right>Parking de Llamada: </td><td align=left><select size=1 name=call_parking_enabled><option>1</option><option>0</option><option selected>$row[44]</option></select>$NWB#phones-call_parking_enabled$NWE</td></tr>\n";
echo "<tr bgcolor=#B6D3FC><td align=right>Uptader Check: </td><td align=left><select size=1 name=updater_check_enabled><option>1</option><option>0</option><option selected>$row[45]</option></select>$NWB#phones-updater_check_enabled$NWE</td></tr>\n";
echo "<tr bgcolor=#B6D3FC><td align=right>AF Logging: </td><td align=left><select size=1 name=AFLogging_enabled><option>1</option><option>0</option><option selected>$row[46]</option></select>$NWB#phones-AFLogging_enabled$NWE</td></tr>\n";
echo "<tr bgcolor=#B6D3FC><td align=right>Colas permitidas: </td><td align=left><select size=1 name=QUEUE_ACTION_enabled><option>1</option><option>0</option><option selected>$row[47]</option></select>$NWB#phones-QUEUE_ACTION_enabled$NWE</td></tr>\n";
echo "<tr bgcolor=#B6D3FC><td align=right>Ventana emergente del CallerID: </td><td align=left><select size=1 name=CallerID_popup_enabled><option>1</option><option>0</option><option selected>$row[48]</option></select>$NWB#phones-CallerID_popup_enabled$NWE</td></tr>\n";
echo "<tr bgcolor=#B6D3FC><td align=right>Botón Vmail: </td><td align=left><select size=1 name=voicemail_button_enabled><option>1</option><option>0</option><option selected>$row[49]</option></select>$NWB#phones-voicemail_button_enabled$NWE</td></tr>\n";
echo "<tr bgcolor=#B6D3FC><td align=right>Refresco rápido: </td><td align=left><select size=1 name=enable_fast_refresh><option>1</option><option>0</option><option selected>$row[50]</option></select>$NWB#phones-enable_fast_refresh$NWE</td></tr>\n";
echo "<tr bgcolor=#B6D3FC><td align=right>Refresco rápido de la tarifa: </td><td align=left><input type=text size=5 name=fast_refresh_rate value=\"$row[51]\">(in ms)$NWB#phones-fast_refresh_rate$NWE</td></tr>\n";
echo "<tr bgcolor=#B6D3FC><td align=right>Persistant MySQL: </td><td align=left><select size=1 name=enable_persistant_mysql><option>1</option><option>0</option><option selected>$row[52]</option></select>$NWB#phones-enable_persistant_mysql$NWE</td></tr>\n";
echo "<tr bgcolor=#B6D3FC><td align=right>Auto Marcar el Siguiente Número: </td><td align=left><select size=1 name=auto_dial_next_number><option>1</option><option>0</option><option selected>$row[53]</option></select>$NWB#phones-auto_dial_next_number$NWE</td></tr>\n";
echo "<tr bgcolor=#B6D3FC><td align=right>Parar de Grabar después de cada llamada: </td><td align=left><select size=1 name=VDstop_rec_after_each_call><option>1</option><option>0</option><option selected>$row[54]</option></select>$NWB#phones-VDstop_rec_after_each_call$NWE</td></tr>\n";
echo "<tr bgcolor=#B6D3FC><td align=right>Servidor de DBX: </td><td align=left><input type=text name=DBX_server size=15 maxlength=15 value=\"$row[55]\"> (Primario DB Server)$NWB#phones-DBX_server$NWE</td></tr>\n";
echo "<tr bgcolor=#B6D3FC><td align=right>Base de datos de DBX: </td><td align=left><input type=text name=DBX_database size=15 maxlength=15 value=\"$row[56]\"> (Primario Server Database)$NWB#phones-DBX_database$NWE</td></tr>\n";
echo "<tr bgcolor=#B6D3FC><td align=right>Usuario de DBX: </td><td align=left><input type=text name=DBX_user size=15 maxlength=15 value=\"$row[57]\"> (Primario DB Login)$NWB#phones-DBX_user$NWE</td></tr>\n";
echo "<tr bgcolor=#B6D3FC><td align=right>Contraseña de DBX: </td><td align=left><input type=text name=DBX_pass size=15 maxlength=15 value=\"$row[58]\"> (Primario DB Secret)$NWB#phones-DBX_pass$NWE</td></tr>\n";
echo "<tr bgcolor=#B6D3FC><td align=right>Puerto de DBX: </td><td align=left><input type=text name=DBX_port size=6 maxlength=6 value=\"$row[59]\"> (Primario DB Port)$NWB#phones-DBX_port$NWE</td></tr>\n";
echo "<tr bgcolor=#B6D3FC><td align=right>Servidor de DBY: </td><td align=left><input type=text name=DBY_server size=15 maxlength=15 value=\"$row[60]\"> (Secundario DB Server)$NWB#phones-DBY_server$NWE</td></tr>\n";
echo "<tr bgcolor=#B6D3FC><td align=right>Base de datos de DBY: </td><td align=left><input type=text name=DBY_database size=15 maxlength=15 value=\"$row[61]\"> (Secundario Server Database)$NWB#phones-DBY_database$NWE</td></tr>\n";
echo "<tr bgcolor=#B6D3FC><td align=right>Usuario de DBY: </td><td align=left><input type=text name=DBY_user size=15 maxlength=15 value=\"$row[62]\"> (Secundario DB Login)$NWB#phones-DBY_user$NWE</td></tr>\n";
echo "<tr bgcolor=#B6D3FC><td align=right>Contraseña de DBY: </td><td align=left><input type=text name=DBY_pass size=15 maxlength=15 value=\"$row[63]\"> (Secundario DB Secret)$NWB#phones-DBY_pass$NWE</td></tr>\n";
echo "<tr bgcolor=#B6D3FC><td align=right>Puerto de DBY: </td><td align=left><input type=text name=DBY_port size=6 maxlength=6 value=\"$row[64]\"> (Secundario DB Port)$NWB#phones-DBY_port$NWE</td></tr>\n";
echo "<tr bgcolor=#B6D3FC><td align=center colspan=2><input type=submit name=submit VALUE=ENVIAR></td></tr>\n";
echo "</TABLE></center>\n";

echo "<br><br><a href=\"./phone_stats.php?extension=$row[0]&server_ip=$row[5]\">Pinchar aquí­ para ver las estadísticas del teléfono</a>\n";

if ($LOGdelete_phones > 0)
	{
	echo "<br><br><a href=\"$PHP_SELF?ADD=5&extension=$extension&server_ip=$server_ip\">SUPRIMA ESTE TELÉFONO</a>\n";
	}

}

######################
# ADD=41 submit server modifications to the system
######################

if ($ADD==41)
{
	echo "<FONT FACE=\"ARIAL,HELVETICA\" COLOR=BLACK SIZE=2>";

	$stmt="SELECT count(*) from servers where server_id='$server_id';";
	$rslt=mysql_query($stmt, $link);
	$row=mysql_fetch_row($rslt);
	if ( ($row[0] > 0) && ($server_id != $old_server_id) )
		{echo "<br>SERVIDOR NOT MODIFIED - there is already a server in the system with this server_id\n";}
	else
		{
		$stmt="SELECT count(*) from servers where server_ip='$server_ip';";
		$rslt=mysql_query($stmt, $link);
		$row=mysql_fetch_row($rslt);
		if ( ($row[0] > 0) && ($server_ip != $old_server_ip) )
			{echo "<br>SERVIDOR NO MODIFICADO - hay ya un servidor en el sistema con este server_ip\n";}
		else
			{
			 if ( (strlen($server_id) < 1) or (strlen($server_ip) < 7) )
				{echo "<br>SERVIDOR NO MODIFICADO - vaya por favor detrás y mire los datos que usted incorporó\n";}
			 else
				{
				echo "<br>SERVIDOR MODIFICADO: $server_ip\n";

				$stmt="UPDATE servers set server_id='$server_id',server_description='$server_description',server_ip='$server_ip',active='$active',asterisk_version='$asterisk_version', max_vicidial_trunks='$max_vicidial_trunks', telnet_host='$telnet_host', telnet_port='$telnet_port', ASTmgrUSERNAME='$ASTmgrUSERNAME', ASTmgrSECRET='$ASTmgrSECRET', ASTmgrUSERNAMEupdate='$ASTmgrUSERNAMEupdate', ASTmgrUSERNAMElisten='$ASTmgrUSERNAMElisten', ASTmgrUSERNAMEsend='$ASTmgrUSERNAMEsend', local_gmt='$local_gmt', voicemail_dump_exten='$voicemail_dump_exten', answer_transfer_agent='$answer_transfer_agent', ext_context='$ext_context' where server_id='$old_server_id';";
				$rslt=mysql_query($stmt, $link);
				}
			}
		}

	$stmt="SELECT * from servers where server_id='$server_id';";
	$rslt=mysql_query($stmt, $link);
	$row=mysql_fetch_row($rslt);

echo "<br>MODIFICAR UN REGISTRO DEL SERVIDOR: $row[0]<form action=$PHP_SELF method=POST>\n";
echo "<input type=hidden name=ADD value=41>\n";
echo "<input type=hidden name=old_server_id value=\"$server_id\">\n";
echo "<input type=hidden name=old_server_ip value=\"$row[2]\">\n";
echo "<center><TABLE width=600 cellspacing=3>\n";
echo "<tr bgcolor=#B6D3FC><td align=right>ID Del Servidor: </td><td align=left><input type=text name=server_id size=10 maxlength=10 value=\"$row[0]\">$NWB#servers-server_id$NWE</td></tr>\n";
echo "<tr bgcolor=#B6D3FC><td align=right>Descripción Del Servidor: </td><td align=left><input type=text name=server_description size=30 maxlength=255 value=\"$row[1]\">$NWB#servers-server_description$NWE</td></tr>\n";
echo "<tr bgcolor=#B6D3FC><td align=right>Dirección IP del Servidor: </td><td align=left><input type=text name=server_ip size=20 maxlength=15 value=\"$row[2]\">$NWB#servers-server_ip$NWE</td></tr>\n";
echo "<tr bgcolor=#B6D3FC><td align=right>Activo: </td><td align=left><select size=1 name=active><option>Y</option><option>N</option><option selected>$row[3]</option></select>$NWB#servers-active$NWE</td></tr>\n";
echo "<tr bgcolor=#B6D3FC><td align=right>Versión De Asterisk: </td><td align=left><input type=text name=asterisk_version size=20 maxlength=20 value=\"$row[4]\">$NWB#servers-asterisk_version$NWE</td></tr>\n";
echo "<tr bgcolor=#B6D3FC><td align=right>Máx. Trunks en VICIDIAL: </td><td align=left><input type=text name=max_vicidial_trunks size=5 maxlength=4 value=\"$row[5]\">$NWB#servers-max_vicidial_trunks$NWE</td></tr>\n";
echo "<tr bgcolor=#B6D3FC><td align=right>Host Del Telnet: </td><td align=left><input type=text name=telnet_host size=20 maxlength=20 value=\"$row[6]\">$NWB#servers-telnet_host$NWE</td></tr>\n";
echo "<tr bgcolor=#B6D3FC><td align=right>Puerto Del Telnet: </td><td align=left><input type=text name=telnet_port size=6 maxlength=5 value=\"$row[7]\">$NWB#servers-telnet_port$NWE</td></tr>\n";
echo "<tr bgcolor=#B6D3FC><td align=right>Usuario Del Manager: </td><td align=left><input type=text name=ASTmgrUSERNAME size=20 maxlength=20 value=\"$row[8]\">$NWB#servers-ASTmgrUSERNAME$NWE</td></tr>\n";
echo "<tr bgcolor=#B6D3FC><td align=right>Contraseña del Manager: </td><td align=left><input type=text name=ASTmgrSECRET size=20 maxlength=20 value=\"$row[9]\">$NWB#servers-ASTmgrSECRET$NWE</td></tr>\n";
echo "<tr bgcolor=#B6D3FC><td align=right>Usuario del Updater del Manager: </td><td align=left><input type=text name=ASTmgrUSERNAMEupdate size=20 maxlength=20 value=\"$row[10]\">$NWB#servers-ASTmgrUSERNAMEupdate$NWE</td></tr>\n";
echo "<tr bgcolor=#B6D3FC><td align=right>Usuario Listen del Manager: </td><td align=left><input type=text name=ASTmgrUSERNAMElisten size=20 maxlength=20 value=\"$row[11]\">$NWB#servers-ASTmgrUSERNAMElisten$NWE</td></tr>\n";
echo "<tr bgcolor=#B6D3FC><td align=right>Usuario Send del Manager: </td><td align=left><input type=text name=ASTmgrUSERNAMEsend size=20 maxlength=20 value=\"$row[12]\">$NWB#servers-ASTmgrUSERNAMEsend$NWE</td></tr>\n";
echo "<tr bgcolor=#B6D3FC><td align=right>GMT Local: </td><td align=left><select size=1 name=local_gmt><option>12</option><option>11</option><option>10</option><option>9</option><option>8</option><option>7</option><option>6</option><option>5</option><option>4</option><option>3</option><option>2</option><option>1</option><option>0</option><option>-1</option><option>-2</option><option>-3</option><option>-4</option><option>-5</option><option>-6</option><option>-7</option><option>-8</option><option>-9</option><option>-10</option><option>-11</option><option>-12</option><option selected>$row[13]</option></select> (No ajustar para el DST)$NWB#servers-local_gmt$NWE</td></tr>\n";
echo "<tr bgcolor=#B6D3FC><td align=right>Extensión de Vmail Dump : </td><td align=left><input type=text name=voicemail_dump_exten size=20 maxlength=20 value=\"$row[14]\">$NWB#servers-voicemail_dump_exten$NWE</td></tr>\n";
echo "<tr bgcolor=#B6D3FC><td align=right>Extensión del AD de VICIDIAL: </td><td align=left><input type=text name=answer_transfer_agent size=20 maxlength=20 value=\"$row[15]\">$NWB#servers-answer_transfer_agent$NWE</td></tr>\n";
echo "<tr bgcolor=#B6D3FC><td align=right>Contexto por Defecto: </td><td align=left><input type=text name=ext_context size=20 maxlength=20 value=\"$row[16]\">$NWB#servers-ext_context$NWE</td></tr>\n";
echo "<tr bgcolor=#B6D3FC><td align=center colspan=2><input type=submit name=submit VALUE=ENVIAR></td></tr>\n";
echo "</TABLE></center>\n";

echo "<center>\n";
echo "<br><b>TELÉFONOS DENTRO DE ESTE SERVIDOR:</b><br>\n";
echo "<TABLE width=400 cellspacing=3>\n";
echo "<tr><td>EXTENSIÓN</td><td>NOMBRE</td><td>ACTIVO</td></tr>\n";

	$active_lists = 0;
	$inactive_lists = 0;
	$stmt="SELECT extension,active,fullname from phones where server_ip='$row[2]'";
	$rsltx=mysql_query($stmt, $link);
	$lists_to_print = mysql_num_rows($rsltx);
	$camp_lists='';

	$o=0;
	while ($lists_to_print > $o) {
		$rowx=mysql_fetch_row($rsltx);
		$o++;
	if (ereg("Y", $rowx[1])) {$active_lists++;   $camp_lists .= "'$rowx[0]',";}
	if (ereg("N", $rowx[1])) {$inactive_lists++;}

	if (eregi("1$|3$|5$|7$|9$", $o))
		{$bgcolor='bgcolor="#B9CBFD"';} 
	else
		{$bgcolor='bgcolor="#9BB9FB"';}

	echo "<tr $bgcolor><td><font size=1><a href=\"$PHP_SELF?ADD=3&extension=$rowx[0]&server_ip=$row[2]\">$rowx[0]</a></td><td><font size=1>$rowx[2]</td><td><font size=1>$rowx[1]</td></tr>\n";

	}

echo "</table></center><br>\n";
echo "<center><b>\n";

	$camp_lists = eregi_replace(".$","",$camp_lists);
echo "Este servidor tiene $active_lists Teléfonos activos y $inactive_lists Teléfonos inactivos<br><br>\n";
echo "</b></center>\n";

}

######################
# ADD=411 submit conference modifications to the system
######################

if ($ADD==411)
{
	echo "<FONT FACE=\"ARIAL,HELVETICA\" COLOR=BLACK SIZE=2>";

	$stmt="SELECT count(*) from conferences where conf_exten='$conf_exten' and server_ip='$server_ip';";
	$rslt=mysql_query($stmt, $link);
	$row=mysql_fetch_row($rslt);
	if ( ($row[0] > 0) && ( ($conf_exten != $old_conf_exten) or ($server_ip != $old_server_ip) ) )
		{echo "<br>CONFERENCIA - hay ya una conferencia en el sistema con esta extensión - servidor NO MODIFICADO\n";}
	else
		{
		 if ( (strlen($conf_exten) < 1) or (strlen($server_ip) < 7) )
			{echo "<br>CONFERENCIA NO MODIFICADA - vaya por favor detrás y mire los datos que usted incorporó\n";}
		 else
			{
			echo "<br>CONFERENCIA MODIFICADA: $conf_exten\n";

			$stmt="UPDATE conferences set conf_exten='$conf_exten',server_ip='$server_ip',extension='$extension' where conf_exten='$old_conf_exten';";
			$rslt=mysql_query($stmt, $link);
			}
		}

	$stmt="SELECT * from conferences where conf_exten='$conf_exten';";
	$rslt=mysql_query($stmt, $link);
	$row=mysql_fetch_row($rslt);

echo "<br>MODIFICAR UN REGISTRO DE LA CONFERENCIA: $row[0]<form action=$PHP_SELF method=POST>\n";
echo "<input type=hidden name=ADD value=411>\n";
echo "<input type=hidden name=old_conf_exten value=\"$row[0]\">\n";
echo "<input type=hidden name=old_server_ip value=\"$row[1]\">\n";
echo "<center><TABLE width=600 cellspacing=3>\n";
echo "<tr bgcolor=#B6D3FC><td align=right>Conferencia: </td><td align=left><input type=text name=conf_exten size=10 maxlength=7 value=\"$row[0]\">$NWB#conferences-conf_exten$NWE</td></tr>\n";
echo "<tr bgcolor=#B6D3FC><td align=right>IP Del Servidor: </td><td align=left><select size=1 name=server_ip>\n";

echo "$servers_list";
echo "<option SELECTED>$row[1]</option>\n";
echo "</select>$NWB#conferences-server_ip$NWE</td></tr>\n";
echo "<tr bgcolor=#B6D3FC><td align=right>Extensión Actual: </td><td align=left><input type=text name=extension size=20 maxlength=20 value=\"$row[2]\"></td></tr>\n";
echo "<tr bgcolor=#B6D3FC><td align=center colspan=2><input type=submit name=submit VALUE=ENVIAR></td></tr>\n";
echo "</TABLE></center>\n";

echo "<center><b>\n";

}







######################
# ADD=55 search form
######################

if ($ADD==55)
{
echo "<FONT FACE=\"ARIAL,HELVETICA\" COLOR=BLACK SIZE=2>";

echo "<br>BÚSQUEDA PARA Un TELÉFONO<form action=$PHP_SELF method=POST>\n";
echo "<input type=hidden name=ADD value=66>\n";
echo "<center><TABLE width=600 cellspacing=3>\n";
echo "<tr bgcolor=#B6D3FC><td align=right>Extensión: </td><td align=left><input type=text name=extension size=10 maxlength=10></td></tr>\n";
echo "<tr bgcolor=#B6D3FC><td align=right>Nombre Completo: </td><td align=left><input type=text name=fullname size=30 maxlength=30></td></tr>\n";
echo "<tr bgcolor=#B6D3FC><td align=right>Phone type: </td><td align=left><input type=text name=phone_type size=30 maxlength=30></td></tr>\n";
echo "<tr bgcolor=#B6D3FC><td align=center colspan=2><input type=submit name=search value=search></td></tr>\n";
echo "</TABLE></center>\n";

}

######################
# ADD=66 phone search results
######################

if ($ADD==66)
{
	echo "<FONT FACE=\"ARIAL,HELVETICA\" COLOR=BLACK SIZE=2>";

	$SQL = '';
	if ($extension) {$SQL .= "extension LIKE \"%$extension%\" and";}
	if ($fullname) {$SQL .= "fullname LIKE \"%$fullname%\" and";}
	if ($phone_type) {$SQL .= "phone_type LIKE \"%$phone_type%\" and";}
	$SQL = eregi_replace(" and$", "", $SQL);
	if (strlen($SQL)>5) {$SQL = "where $SQL";}

	$stmt="SELECT * from phones $SQL order by extension,server_ip;";
#	echo "\n|$stmt|\n";
	$rslt=mysql_query($stmt, $link);
	$phones_to_print = mysql_num_rows($rslt);

echo "<br>RESULTADOS DE LA BÚSQUEDA:\n";
echo "<center><TABLE width=600 cellspacing=0 cellpadding=1>\n";

	$o=0;
	while ($phones_to_print > $o) {
		$row=mysql_fetch_row($rslt);
		if (eregi("1$|3$|5$|7$|9$", $o))
			{$bgcolor='bgcolor="#B9CBFD"';} 
		else
			{$bgcolor='bgcolor="#9BB9FB"';}
		echo "<tr $bgcolor><td><font size=1>$row[0]</td><td><font size=1>$row[5]</td><td><font size=1>$row[1]</td><td><font size=1>$row[2]</td><td><font size=1>$row[8]</td><td><font size=1>$row[11]</td><td><font size=1>$row[14]</td><td><font size=1>$row[15]</td>";
		echo "<td><font size=1><a href=\"$PHP_SELF?ADD=3&extension=$row[0]&server_ip=$row[5]\">MODIFICAR</a> | <a href=\"./phone_stats.php?extension=$row[0]&server_ip=$row[5]\">ESTADÍSTICAS</a></td></tr>\n";
		$o++;
	}

echo "</TABLE></center>\n";

}



######################
# ADD=0 display all active phones
######################
if ($ADD==0)
{
	echo "<FONT FACE=\"ARIAL,HELVETICA\" COLOR=BLACK SIZE=2>";

	$stmt="SELECT * from phones order by extension,server_ip";
	$rslt=mysql_query($stmt, $link);
	$phones_to_print = mysql_num_rows($rslt);

echo "<br>LISTADOS DE TELÉFONOS:\n";
echo "<center><TABLE width=600 cellspacing=0 cellpadding=1>\n";

	$o=0;
	while ($phones_to_print > $o) {
		$row=mysql_fetch_row($rslt);
		if (eregi("1$|3$|5$|7$|9$", $o))
			{$bgcolor='bgcolor="#B9CBFD"';} 
		else
			{$bgcolor='bgcolor="#9BB9FB"';}
		echo "<tr $bgcolor><td><font size=1>$row[0]</td><td><font size=1>$row[16]</td><td><font size=1>$row[5]</td><td><font size=1>$row[1]</td><td><font size=1>$row[2]</td><td><font size=1>$row[8]</td><td><font size=1>$row[11]</td><td><font size=1>$row[14]</td><td><font size=1>$row[15]</td>";
		echo "<td><font size=1><a href=\"$PHP_SELF?ADD=3&extension=$row[0]&server_ip=$row[5]\">MODIFICAR</a> | <a href=\"./phone_stats.php?extension=$row[0]&server_ip=$row[5]\">ESTADÍSTICAS</a></td></tr>\n";
		$o++;
	}

echo "</TABLE></center>\n";
}

######################
# ADD=10 display all servers
######################
if ($ADD==10)
{
	echo "<FONT FACE=\"ARIAL,HELVETICA\" COLOR=BLACK SIZE=2>";

	$stmt="SELECT * from servers order by server_id";
	$rslt=mysql_query($stmt, $link);
	$phones_to_print = mysql_num_rows($rslt);

echo "<br>LISTADOS DEL SERVIDOR:\n";
echo "<center><TABLE width=600 cellspacing=0 cellpadding=1>\n";

	$o=0;
	while ($phones_to_print > $o) {
		$row=mysql_fetch_row($rslt);
		if (eregi("1$|3$|5$|7$|9$", $o))
			{$bgcolor='bgcolor="#B9CBFD"';} 
		else
			{$bgcolor='bgcolor="#9BB9FB"';}
		echo "<tr $bgcolor><td><font size=1>$row[0]</td><td><font size=1>$row[1]</td>";
		echo "<td><font size=1> $row[2]</td>";
		echo "<td><font size=1> $row[4]</td>";
		echo "<td><font size=1> $row[3]</td><td><font size=1> &nbsp;</td>";
		echo "<td><font size=1><a href=\"$PHP_SELF?ADD=31&server_id=$row[0]\">MODIFICAR</a></td></tr>\n";
		$o++;
	}

echo "</TABLE></center>\n";
}


######################
# ADD=100 display all conferences
######################
if ($ADD==100)
{
	echo "<FONT FACE=\"ARIAL,HELVETICA\" COLOR=BLACK SIZE=2>";

	$stmt="SELECT * from conferences order by conf_exten";
	$rslt=mysql_query($stmt, $link);
	$phones_to_print = mysql_num_rows($rslt);

echo "<br>LISTADOS DE CONFERENCIAS:\n";
echo "<center><TABLE width=600 cellspacing=0 cellpadding=1>\n";

	$o=0;
	while ($phones_to_print > $o) {
		$row=mysql_fetch_row($rslt);
		if (eregi("1$|3$|5$|7$|9$", $o))
			{$bgcolor='bgcolor="#B9CBFD"';} 
		else
			{$bgcolor='bgcolor="#9BB9FB"';}
		echo "<tr $bgcolor><td><font size=1>$row[0]</td>";
		echo "<td><font size=1> $row[1]</td>";
		echo "<td><font size=1> $row[2]</td><td><font size=1>$row[4]</td><td><font size=1> &nbsp;</td>";
		echo "<td><font size=1><a href=\"$PHP_SELF?ADD=311&conf_exten=$row[0]&server_ip=$row[1]\">MODIFICAR</a></td></tr>\n";
		$o++;
	}

echo "</TABLE></center>\n";
}



$ENDtime = date("U");

$RUNtime = ($ENDtime - $STARTtime);

echo "\n\n\n<br><br><br>\n\n";


echo "<font size=0>\n\n\n<br><br><br>\nScript runtime: $RUNtime seconds";
echo " &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; VERSIÓN: $version";
echo " &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; CONSTRUCCION: $build</font>\n";


?>


</TD></TR><TABLE>
</body>
</html>

<?
	
exit; 



?>





