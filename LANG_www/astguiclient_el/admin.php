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
# 60814-1402 - Added off-hour gmt values (India, Australia, etc...)
# 60814-1540 - Added system performance logging and script logging options
# 60815-1016 - Added agi output option
#

$version = '2.0.1';
$build = '60815-1016';

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
if (isset($_GET["ΕΠΙΒΕΒΑΙΩΣΗ"]))				{$ΕΠΙΒΕΒΑΙΩΣΗ=$_GET["ΕΠΙΒΕΒΑΙΩΣΗ"];}
	elseif (isset($_POST["ΕΠΙΒΕΒΑΙΩΣΗ"]))		{$ΕΠΙΒΕΒΑΙΩΣΗ=$_POST["ΕΠΙΒΕΒΑΙΩΣΗ"];}
if (isset($_GET["CoNfIrM"]))				{$CoNfIrM=$_GET["CoNfIrM"];}
	elseif (isset($_POST["CoNfIrM"]))		{$CoNfIrM=$_POST["CoNfIrM"];}
if (isset($_GET["sys_perf_log"]))			{$sys_perf_log=$_GET["sys_perf_log"];}
	elseif (isset($_POST["sys_perf_log"]))	{$sys_perf_log=$_POST["sys_perf_log"];}
if (isset($_GET["vd_server_logs"]))				{$vd_server_logs=$_GET["vd_server_logs"];}
	elseif (isset($_POST["vd_server_logs"]))	{$vd_server_logs=$_POST["vd_server_logs"];}
if (isset($_GET["agi_output"]))				{$agi_output=$_GET["agi_output"];}
	elseif (isset($_POST["agi_output"]))	{$agi_output=$_POST["agi_output"];}

##### BEGIN VARIABLE FILTERING FOR SECURITY #####

### DIGITS and Dots
$phone_ip = ereg_replace("[^\.0-9]","",$phone_ip);
$server_ip = ereg_replace("[^\.0-9]","",$server_ip);
$old_server_ip = ereg_replace("[^\.0-9]","",$old_server_ip);
$computer_ip = ereg_replace("[^\.0-9]","",$computer_ip);

### Y or N ONLY ###
$active = ereg_replace("[^NY]","",$active);
$sys_perf_log = ereg_replace("[^NY]","",$sys_perf_log);
$vd_server_logs = ereg_replace("[^NY]","",$vd_server_logs);

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
$agi_output = ereg_replace("[^-\_0-9a-zA-Z]","",$agi_output);

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
    echo "Έχετε αποσυνδεθεί. Σας ευχαριστούμε\n";
    exit;
}

if (!isset($ADD))   {$ADD=0;}

$STARTtime = date("U");
$STARTdate = date("Y-m-d H:i:s");

if ($ADD==1) {$process = 'ΠΡΟΣΘΕΣΕ ΝΕΟ ΤΗΛΕΦΩΝΟ';}
if ($ADD==11) {$process = 'ΠΡΟΣΘΕΣΕ ΝΕΟ ΔΙΑΚΟΜΙΣΤΗ';}
if ($ADD==111) {$process = 'ΠΡΟΣΘΕΣΕ ΝΕΑ ΣΥΝΔΙΑΛΕΞΗ';}
if ($ADD==2) {$process = 'ΠΡΟΣΘΗΚΗ ΝΕΟΥ ΤΗΛΕΦΩΝΟΥ';}
if ($ADD==21) {$process = 'ΠΡΟΣΘΗΚΗ ΝΕΟΥ ΔΙΑΚΟΜΙΣΤΗ';}
if ($ADD==211) {$process = 'ΠΡΟΣΘΗΚΗ ΝΕΑΣ ΣΥΝΔΙΑΛΕΞΗΣ';}
if ($ADD==3) {$process = 'ΤΡΟΠΟΠΟΙΗΣΕ ΤΗΛΕΦΩΝΟ';}
if ($ADD==31) {$process = 'ΤΡΟΠΟΠΟΙΗΣΕ ΔΙΑΚΟΜΙΣΤΗ';}
if ($ADD==311) {$process = 'ΤΡΟΠΟΠΟΙΗΣΕ ΣΥΝΔΙΑΛΕΞΗ';}
if ($ADD==4) {$process = 'ΤΡΟΠΟΠΟΙΗΣΗ ΤΗΛΕΦΩΝΟΥ';}
if ($ADD==41) {$process = 'ΤΡΟΠΟΠΟΙΗΣΗ ΔΙΑΚΟΜΙΣΤΗ';}
if ($ADD==411) {$process = 'ΤΡΟΠΟΠΟΙΗΣΗ ΣΥΝΔΙΑΛΕΞΗΣ';}
if ($ADD==5) {$process = 'DELETE PHONE';}
if ($ADD==6) {$process = 'DELETE PHONE';}
if ($ADD==55) {$process = 'ΑΝΑΖΗΤΗΣΗ ΤΗΛΕΦΩΝΩΝ';}
if ($ADD==66) {$process = 'ΑΝΑΖΗΤΗΣΗ ΑΠΟΤΕΛΕΣΜΑΤΩΝ ΤΗΛΕΦΩΝΩΝ';}
if ($ADD==0) {$process = 'ΛΙΣΤΑ ΤΗΛΕΦΩΝΟΥ';}
if ($ADD==10) {$process = 'ΛΙΣΤΑ ΔΙΑΚΟΜΙΣΤΗ';}
if ($ADD==100) {$process = 'ΛΙΣΤΑ ΣΥΝΔΙΑΛΕΞΕΩΝ';}
if ($ADD==99999) {$process = 'ΒΟΗΘΕΙΑ';}

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
    echo "Ακυρο Ονομα Χρήστη/Κωδικός Πρόσβασης: |$PHP_AUTH_USER|$PHP_AUTH_PW|\n";
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
$NWE = "')\"><IMG SRC=\"help.gif\" WIDTH=20 HEIGHT=20 Border=0 ALT=\"ΒΟΗΘΕΙΑ\" ALIGN=TOP></A>";
######################
# ADD=99999 display the HELP SCREENS
######################

if ($ADD==99999)
{
echo "<html>\n";
echo "<head>\n";
echo "<title>ΣΥΣΤΗΜΑ ΚΛΗΣΕΩΝ: Διαχείριση - $process </title>\n";
echo "</head>\n";
echo "<BODY BGCOLOR=white marginheight=0 marginwidth=0 leftmargin=0 topmargin=0>\n";
echo "<CENTER>\n";
echo "<TABLE WIDTH=98% BGCOLOR=#E6E6E6 cellpadding=2 cellspacing=0><TR><TD ALIGN=LEFT><FONT FACE=\"ARIAL,HELVETICA\" COLOR=BLACK SIZE=4><B>ASTERISK ADMIN: ΒΟΗΘΕΙΑ<BR></B></FONT><FONT FACE=\"ARIAL,HELVETICA\" COLOR=BLACK SIZE=2><BR><BR>\n";

?>
<B><FONT SIZE=3>ΠΙΝΑΚΑΣ ΤΗΛΕΦΩΝΩΝ</FONT></B><BR><BR>
<A NAME="phones-extension">
<BR>
<B>Εσωτ.Σύνδεση Τηλεφώνου -</B> Αυτό το πεδίο είναι για την καταχώρηση του ονόματος του τηλεφώνου, όπως αυτό εμφανίζεται στο Asterisk, χωρίς να συμπεριλαμβάνει το πρωτόκολλο ή slash στην αρχή. Για παράδειγμα: για SIP τηλέφωνο SIPVtest101 η Εσω.Γραμμή Τηλεφώνου θα είναι test101. Επίσης, για IAX2 τηλέφωνα χρησιμοποιείστε τα πλήρης ονόματα: IAX2/IAXphone1@IAXphone1 θα είναι IAXphone1@IAXphone1. Για Zap τηλέφωνα καταχωρήστε το πλήρες κανάλι: Zap/25-1 θα είναι 25-1. Αλλη σημείωση, ορίστε το πρωτόκολλο παρακάτω σωστά για τον τύπο του τηλεφώνου.

<BR>
<A NAME="phones-dialplan_number">
<BR>
<B>Αριθμός Σχεδίου Κλήσεων -</B> Αυτό το πεδίο είναι για τον αριθμό που καλείται για να κουδουνίζει το τηλέφωνο. Αυτός ο αριθμός ορίζεται στο αρχείο extensions.conf του διακομιστή Asterisk

<BR>
<A NAME="phones-voicemail_id">
<BR>
<B>Περιεχόμενο Φωνητικού Ταχυδρομείου -</B> Αυτό το πεδίο είναι για το περιεχόμενο του φωνητικού ταχυδρομείου, όπου πηγαίνουν τα μηνύματα του τηλεφώνου του χρήστη. Το χρησιμοποιούμαι για να  ελέγξουμε τα φωνητικά μηνύματα και για να μπορεί ο χρήστης να χρησιμοποιήσει το πλήκτρο VOICEMAIL.

<BR>
<A NAME="phones-outbound_cid">
<BR>
<B>CallerID Εξερχομένων -</B> Αυτό το πεδίο είναι για την καταχώριση του αριθμού  callerID που θα θέλατε να εμφανίζεται στις εξερχόμενες κλήσεις.

<BR>
<A NAME="phones-phone_ip">
<BR>
<B>Δνση IP Τηλεφώνου -</B> Αυτό το πεδίο είναι για την δνση IP του τηλέφωνου εάν είναι ένα VOIP τηλέφωνο. Αυτό είναι ένα προαιρετικό πεδίο

<BR>
<A NAME="phones-computer_ip">
<BR>
<B>Δνση IP Υπολογιστού -</B> Αυτό το πεδίο είναι για την δνση IP του υπολογιστή του χρήστη. Αυτό είναι ένα προαιρετικό πεδίο

<BR>
<A NAME="phones-server_ip">
<BR>
<B>IP Διακομιστή -</B> Αυτός ο κατάλογος επιλογών είναι που επιλέγετε σε ποιον διακομιστή το τηλέφωνο είναι ενεργό.

<BR>
<A NAME="phones-login">
<BR>
<B>Σύνδεση -</B> η σύνδεση που χρησιμοποιείται για τον τηλεφωνικό χρήστηστη σύνδεση στις εφαρμογές πελατών.

<BR>
<A NAME="phones-pass">
<BR>
<B>Κωδικός πρόσβασης -</B> ο κωδικός πρόσβασης που χρησιμοποιείται γιατον τηλεφωνικό χρήστη στη σύνδεση στις εφαρμογές πελατών.

<BR>
<A NAME="phones-status">
<BR>
<B>Κατάσταση -</B> Η κατάσταση του τηλεφώνου στο σύστημα, ΕΝΕΡΓΗ και ΔΙΑΧ επιτρέπουν στους GUI πελάτες να δουλέψουν. Η ΔΙΑΧ επιτρέπει την πρόσβαση στην ιστοσελίδα διαχείρισης.

<BR>
<A NAME="phones-active">
<BR>
<B>Ενεργός Λογαριασμός -</B> Κατά πόσο το τηλέφωνο είναι ενεργό για να τοποθετηθεί στην λίστα στο GUI.

<BR>
<A NAME="phones-phone_type">
<BR>
<B>Τύπος Τηλεφώνου -</B> Απλά για σημειώσεις διαχείρισης.

<BR>
<A NAME="phones-fullname">
<BR>
<B>Πλήρες Ονομα -</B> Χρησιμοποιείται από τον χρήστη GUI στην λίστα ενεργών τηλεφώνων.

<BR>
<A NAME="phones-company">
<BR>
<B>Εταιρία -</B> Απλά για σημειώσεις διαχείρισης.

<BR>
<A NAME="phones-picture">
<BR>
<B>Εικόνα -</B> Δεν έχει υλοποιηθεί ακόμα.

<BR>
<A NAME="phones-messages">
<BR>
<B>Νέα Μηνύματα -</B> Αριθμός νέων φωνητικών μηνυμάτων για αυτό το τηλέφωνο στον διακομιστή Asterisk.

<BR>
<A NAME="phones-old_messages">
<BR>
<B>Παλαιά Μηνύματα -</B> Αριθμός παλαιών φωνητικών μηνυμάτων για αυτό το τηλέφωνο στον διακομιστή Asterisk.

<BR>
<A NAME="phones-protocol">
<BR>
<B>Πρωτόκολλο Πελάτη -</B> Το πρωτόκολλο που χρησιμοποιεί το τηλέφωνο για συνδεθεί στον διακομιστή Asterisk: SIP, IAX2, Zap.

<BR>
<A NAME="phones-local_gmt">
<BR>
<B>οπική GMT -</B> Η διαφορά από την GMT όπου το τηλέφωνο βρίσκεται. Μην το ρυθμίσετε για DAYLIGHT SAVINGS ΩΡΑ. Αυτή χρησιμοποιείται από την VICIDIAL εκστρατεία για την επακριβή εμφάνιση της ώρας.

<BR>
<A NAME="phones-ASTmgrUSERNAME">
<BR>
<B>Σύνδεση Διαχειριστή -</B> Αυτή είναι η σύνδεση που χρησιμοποιούν οι GUI χρήστες του τηλεφώνου, για πρόσβαση στην Βάση Δεδομένων όπου ο διακομιστής δεδομένων βρίσκεται.

<BR>
<A NAME="phones-ASTmgrSECRET">
<BR>
<B>Μυστικό Διαχειριστή -</B> Αυτός είναι ο κωδικός που χρησιμοποιούν οι GUI χρήστες του τηλεφώνου, για πρόσβαση στην Βάση Δεδομένων όπου ο διακομιστής δεδομένων βρίσκεται.

<BR>
<A NAME="phones-login_user">
<BR>
<B>Προκαθορισμένος VICIDIAL Χρήστης -</B> Εδώ ορίζεται μία προκαθορισμένη τιμή χρήστη, οπουδήποτε αυτός ο χρήστης τηλεφώνου ανοίξει την εφαρμογή VICIDIAL. Αφήστε κενό για κανένα χρήστη.

<BR>
<A NAME="phones-login_pass">
<BR>
<B>Προκαθορισμένος VICIDIAL Κωδικός -</B> Εδώ ορίζεται μία προκαθορισμένη τιμή κωδικού, οπουδήποτε αυτός ο χρήστης τηλεφώνου ανοίξει την εφαρμογή VICIDIAL. Αφήστε κενό για κανένα κωδικό.

<BR>
<A NAME="phones-login_campaign">
<BR>
<B>VICIDIAL Προκαθορισμένη Εκστρατεία -</B> Εδώ ορίζεται μα προκαθορισμένη τιμή εκστρατείας, οπουδήποτε αυτός ο χρήστης τηλεφώνου ανοίξει την εφαρμογή VICIDIAL. Αφήστε κενό για καμία εκστρατεία.

<BR>
<A NAME="phones-park_on_extension">
<BR>
<B>Εσ.Σύνδ. Στάθμευσης -</B> Αυτή είναι η προκαθορισμένη εσωτ.σύνδεση Στάθμευσης για τις εφαρμογές του χρήστη.

<BR>
<A NAME="phones-conf_on_extension">
<BR>
<B>Εσ.Σύνδ. Συνδιάλεξης -</B> Αυτή είναι η προκαθορισμένη εσωτ.σύνδεση Συνδιάλεξης για τις εφαρμογές του χρήστη.

<BR>
<A NAME="phones-VICIDIAL_park_on_extension">
<BR>
<B>Εσωτ.Σύνδεση Στάθμευσης VICIDIAL -</B> Η προκαθορισμένη εσωτ.σύνδεση στάθμευσης. Εξακριβώστε ότι κάποια διαφορετική δουλεύει πριν την αλλάξετε.

<BR>
<A NAME="phones-VICIDIAL_park_on_filename">
<BR>
<B> Αρχείο Στάθμευσης VICIDIAL -</B> Το προκαθορισμένο αρχείο στάθμευσης. Μέχρι 10 χαρακτήρες.

<BR>
<A NAME="phones-monitor_prefix">
<BR>
<B>Πρόθεμα παρακολούθησης -</B> Αυτό είναι το πρόθεμα παρακολούθησης των καναλιών ZAP.

<BR>
<A NAME="phones-recording_exten">
<BR>
<B>Εσωτ.Σύνδεση Ηχογράφησης -</B> Αυτή είναι η εσωτ.σύνδεση του πλάνου κλήσεων για την εσωτ.σύνδεση ηχογράφησης που χρησιμοποιείται για μεταφορά στις συνδιαλέξεις, ώστε να ηχογραφηθούν.Extensions.conf .

<BR>
<A NAME="phones-voicemail_exten">
<BR>
<B>Βασική Εσωτ.Σύνδεση VMAIL -</B> Αυτή είναι η εσωτ.σύνδεση του πλάνου κλήσεων που ελέγχει την θυρίδα ηχητικών μηνυμάτων.

<BR>
<A NAME="phones-voicemail_dump_exten">
<BR>
<B>Εσωτ.Σύνδεση απόρριψης VMAIL -</B> Αυτο είναι το πρόθεμα του πλάνου κλήσεων που χρησιμοποιείται στο να στέλνει κλήσεις κατευθείαν στη θυρίδα του χρήστη από μία κλήση.

<BR>
<A NAME="phones-ext_context">
<BR>
<B>Περιεχόμενο Εσωτ.Σύνδεσης -</B> Αυτό είναι το περιεχόμενο του πλάνου κλήσεων όπου το τηλέφωνο χρησιμοποιεί.

<BR>
<A NAME="phones-dtmf_send_extension">
<BR>
<B>Κανάλι αποστολής DTMF -</B> Αυτό είναι το κανάλι του χρησιμοποιείται για την αποστολή DTMF ήχων στις συνδιαλέξεις.

<BR>
<A NAME="phones-call_out_number_group">
<BR>
<B>Εξερχόμεη ομάδα κλήσης -</B> αυτή είναι η ομάδα καναλιού όπου οι εξερχόμενες κλήσεις από αυτό το τηλέφωνο τοποθετούνται. Υπάρχουν ρουτίνες που την χρησιμοποιούν. Για τα κανάλια Zap θέλετε να χρησιμοποιήσετε κάτι σαν Zap/g2, για IAX2 trunks θα θέλετε να χρησιμοποιήσετε το πλήρες πρόθεμα IAX όπως IAX2/VICItest1:secret@10.10.10.15:4569. Ελέγξτε τα trunks με το αρχείο extensions.conf.

<BR>
<A NAME="phones-client_browser">
<BR>
<B>Περιοχή Ιστο-Πλοηγού -</B> Αυτό χρειάζεται μόνο σε Linux συστήματα.

<BR>
<A NAME="phones-install_directory">
<BR>
<B>Κατάλογος Εγκατάστασης -</B> .

<BR>
<A NAME="phones-local_web_callerID_URL">
<BR>
<B>CallerID URL -</B> Αυτή είναι η Δνση της ιστοσελίδας που χρησιμοποιείται για αναζήτηση με callerID

<BR>
<A NAME="phones-VICIDIAL_web_URL">
<BR>
<B>Προκαθορισμένο VICIDIAL URL -</B>  Αυτή είναι η δνση ιστοσελίδας που χρησιμοποιείται για προσαρμοσμένα VICIDIAL ερωτήματα ιστοσελίδας

<BR>
<A NAME="phones-AGI_call_logging_enabled">
<BR>
<B>Καταγραφή Γεγονότων Κλήσης -</B> Αυτό τοποθετείται σε αληθές εάν  το αρχείο call_log.agi βρίσκεται στο αρχείο extensions.conf για τις εξερχόμενες κλήσεις και για τις εσωτ.συνδέσεις  'h'  που κλείνουν. Αυτό πρέπει πάντα να είναι 1 για να δουλεύουν σωστά πολλά χαρακτηριστικά των εφαρμογών.

<BR>
<A NAME="phones-user_switching_enabled">
<BR>
<B>Μεταγωγή Χρήστη -</B> Εάν το θέσετε σε αληθές θα επιτρέπετε στους χρήστες να μεταβούν σε άλλον λογαριασμό χρήστη

<BR>
<A NAME="phones-conferencing_enabled">
<BR>
<B>Σε συνδιάλεξη -</B> Εάν το θέσετε σε αληθές θα επιτρέπετε στους χρήστες να ξεκινούν συνδιαλέξεις μέχρι 6 εξωτερικές γραμμές.

<BR>
<A NAME="phones-admin_hangup_enabled">
<BR>
<B>Διαχειριστού Κλείσιμο-</B> Εάν το θέσετε σε αληθές θα επιτρέπετε στους χρήστες να κλείνουν κάθε γραμμή.

<BR>
<A NAME="phones-admin_hijack_enabled">
<BR>
<B>Διαχειριστού Κλέψιμο -</B> Εάν το θέσετε σε αληθές θα επιτρέπετε στους χρήστες να λαμβάνουν και να ανακατευθύνουν στην εσωτ.σύνδεσή τους οποιαδήποτε γραμμή.

<BR>
<A NAME="phones-admin_monitor_enabled">
<BR>
<B>Διαχειριστού Παρακολούθηση -</B> Εάν το θέσετε σε αληθές θα επιτρέπετε στους χρήστες να λαμβάνουν και να ανακατευθύνουν στην εσωτ.σύνδεσή τους οποιαδήποτε γραμμή.

<BR>
<A NAME="phones-call_parking_enabled">
<BR>
<B>Στάθμευση Κλήσης -</B> Εάν το θέσετε σε αληθές θα επιτρέπετε σε χρήστες να σταθμεύουν κλήσεις και κλήσεις σε αναμονή να διαχειρίζονται από οποιοδήποτε άλλο χρήστη. Οι κλήσεις μένουν σε αναμονή για 30 δευτερόλεπτα και μετά κλείνουν.  Συνήθως ενεργοποιημένη για όλους.

<BR>
<A NAME="phones-updater_check_enabled">
<BR>
<B>Ενεργοποιημένη Ουρά -</B> Εάν το θέσετε σε αληθές θα εμφανίζεται ένα παράθυρο ειδοποίησης, ότι η ώρα ενημέρωσης δεν έχει αλλάξει σε 20 δευτερόλεπτα.

<BR>
<A NAME="phones-AFLogging_enabled">
<BR>
<B>AF Καταγραφή Γεγονότος -</B> Εάν το θέσετε σε αληθές θα καταγράφονται οι ενέργειες χρήσης του astGUIclient σε ένα αρχείο στον υπολογιστή του χρήστη.

<BR>
<A NAME="phones-QUEUE_ACTION_enabled">
<BR>
<B>Ενεργοποιημένη Ουρά -</B> Εάν το θέσετε σε αληθές οι εφαρμογές θα χρησιμοποιούν το ACQS.

<BR>
<A NAME="phones-CallerID_popup_enabled">
<BR>
<B>Υπερεμφανιζόμενο παραθύρο CallerID -</B> Εάν το θέσετε σε αληθές θα επιτρέψετε σε αριθμούς ορισμένους στο αρχείο extensions.conf, να στέλνουν οθόνες με CallerID στους astGUIclient χρήστες.

<BR>
<A NAME="phones-voicemail_button_enabled">
<BR>
<B>VMail Πλήκτρο -</B> Εάν το θέσετε σε αληθές θα εμφανιστεί το πλήκτρο VOICEMAIL και τα μηνύματα μπορούν να εμφανίζονται στο astGUIclient.

<BR>
<A NAME="phones-enable_fast_refresh">
<BR>
<B>Ταχύτητα Ανανέωσης -</B> Εάν το θέσετε σε αληθές ενεργοποιείται ένα νέο ρυθμό ανανέωσης πληροφοριών κλήσης για το astGUIclient. Προκαθορισμένος απενεργοποιημένος ρυθμός είναι 1000 ms (1 δευτερόλεπτο).

<BR>
<A NAME="phones-fast_refresh_rate">
<BR>
<B>Ρυθμός Ανανέωσης Ταχύτητας -</B> σε χιλιοστά δευτερολέπτου. Χρημοποιείται μόνο εάν η Ταχύτητα Ανανέωσης είναι ενεργοποιημένη. Προκαθορισμένος απενεργοποιημένος ρυθμός είναι 1000 ms (1 δευτερόλεπτο).

<BR>
<A NAME="phones-enable_persistant_mysql">
<BR>
<B>Συνεχής MySQL -</B> Εάν είναι ενεργοποιημένο, το astGUIclient θα παραμένει συνδεμένο αντί να συνδέεται κάθε δευτερόλεπτο.

<BR>
<A NAME="phones-auto_dial_next_number">
<BR>
<B>Αυτόματη Κλήση Επόμενου Αριθμού -</B> Εάν είναι ενεργοποιημένο, μετά από τον τερματισμό θα γίνει κλήση του επόμενου αριθμού, εκτός εάν επιλέξουμε "Μη κάνεις κλήσεις".

<BR>
<A NAME="phones-VDstop_rec_after_each_call">
<BR>
<B>Σταμάτα την ηχογράφηση μετά από κάθε κλήση -</B> Εάν είναι ενεργοποιημένο η ηχογράφηση θα σταματήσει μετά τον τερματισμό.

<BR>
<A NAME="phones-DBX_server">
<BR>
<B>DBΧ Διακομιστής -</B> Ο διακομιστής της Βάσης Δεδομένων MySQL που ο χρήστης θα συνδεθεί.

<BR>
<A NAME="phones-DBX_database">
<BR>
<B>DBΧ Βάση Δεδομένων -</B> Η βάση δεδομένων MySQL στην οποία ο χρήστης θα συνδεθεί. Η προκαθορισμένη είναι asterisk.

<BR>
<A NAME="phones-DBX_user">
<BR>
<B>DBΧ Χρήστης -</B> Ο χρήστης MySQL για την σύνδεση. Ο προκαθορισμένος είναι cron.

<BR>
<A NAME="phones-DBX_pass">
<BR>
<B>DBΧ Κωδικός -</B> Ο κωδικός χρήστη MySQL που ο χρήστης χρησιμοποιεί όταν συνδέεται. Ο προκαθορισμένος είναι 1234.

<BR>
<A NAME="phones-DBX_port">
<BR>
<B>DBΧ Πόρτα -</B> Η MySQL TCP πόρτα που ο χρήστης χρησιμοποιεί όταν συνδέεται. Η προκαθορισμένη είναι 3306.

<BR>
<A NAME="phones-DBY_server">
<BR>
<B>DBY Διακομιστής -</B> Ο διακομιστής της Βάσης Δεδομένων MySQL που ο χρήστης θα συνδεθεί. Δευτερεύονserver, μην χρησιμοποιημένος αυτήν την περίοδο.

<BR>
<A NAME="phones-DBY_database">
<BR>
<B>DBY Βάση Δεδομένων -</B> Η βάση δεδομένων MySQL στην οποία ο χρήστης θα συνδεθεί. Η προκαθορισμένη είναι asterisk. Δευτερεύονserver, μην χρησιμοποιημένος αυτήν την περίοδο.

<BR>
<A NAME="phones-DBY_user">
<BR>
<B>DBY Χρήστης -</B> Ο χρήστης MySQL για την σύνδεση. Ο προκαθορισμένος είναι cron. Δευτερεύονserver, μην χρησιμοποιημένος αυτήν την περίοδο.

<BR>
<A NAME="phones-DBY_pass">
<BR>
<B>DBY Κωδικός -</B> Ο κωδικός χρήστη MySQL που ο χρήστης χρησιμοποιεί όταν συνδέεται. Ο προκαθορισμένος είναι 1234. Δευτερεύονserver, μην χρησιμοποιημένος αυτήν την περίοδο.

<BR>
<A NAME="phones-DBY_port">
<BR>
<B>DBY Πόρτα -</B> Η MySQL TCP πόρτα που ο χρήστης χρησιμοποιεί όταν συνδέεται. Η προκαθορισμένη είναι 3306. Δευτερεύονserver, μην χρησιμοποιημένος αυτήν την περίοδο.


<BR><BR><BR><BR>

<B><FONT SIZE=3>ΠΙΝΑΚΑΣ ΔΙΑΚΟΜΙΣΤΩΝ</FONT></B><BR><BR>
<A NAME="servers-server_id">
<BR>
<B>ID Διακομιστή -</B> Σε αυτό το πεδίο ορίζεται το όνομα του διακομιστή Asterisk, είναι μόνο μία επωνυμία ώστε να αναγνωρίζεται από τους διαχειριστές.

<BR>
<A NAME="servers-server_description">
<BR>
<B>Περιγραφή Διακομιστή -</B> Το πεδίο στο οποίο περιγράφεται με μία φράση τον διακομιστή Asterisk.

<BR>
<A NAME="servers-server_ip">
<BR>
<B>Δνση IP Διακομιστή -</B> Το πεδίο που ορίζεται η δνση IP του δικτύου του διακομιστή Asterisk.

<BR>
<A NAME="servers-active">
<BR>
<B>Ενεργός -</B> Ορίζει κατά πόσον ο διακομιστής Asterisk είναι ενεργός ή μη ενεργός.

<BR>
<A NAME="servers-asterisk_version">
<BR>
<B>Εκδοση Asterisk.

<BR>
<A NAME="servers-max_vicidial_trunks">
<BR>
<B>Μέγιστος Αριθμός Trunk του VICIDIAL -</B> Αυτό το πεδίο θα προσδιορίσει τον μέγιστο αριθμό γραμμών, τις οποίες θα χρησιμοποιήσει η διεργασία αυτόματης κλήσης. Εάν θέλετε να αφιερώσετε δύο PRI σε ένα διακομιστή τότε θα πρέπει να το ορίσετε σε 46. Το προκαθορισμένο είναι 96.

<BR>
<A NAME="servers-telnet_host">
<BR>
<B>Telnet Πελάτης -</B> Αυτή είναι η δνση ή το όνομα του διακομιστή Asterisk και το πώς οι εφαρμογές διαχείρισης συνδέονται σε αυτόν, όπου τρέχουν. Το προκαθορισμένο είναι 'localhost'.

<BR>
<A NAME="servers-telnet_port">
<BR>
<B>Πόρτα Telnet -</B> Αυτή είναι η πόρτα της σύνδεσης με τον διαχειριστή του διακομιστή Asterisk και το πώς οι εφαρμογές διαχείρισης συνδέονται σε αυτόν, όπου τρέχουν. Το προκαθορισμένο είναι '5038'.

<BR>
<A NAME="servers-ASTmgrUSERNAME">
<BR>
<B> Διαχειριστής Χρήστης -</B> Το όνομα χρήστη που χρησιμοποιείτε γενικά για τον διαχειριστή του διακομιστή Asterisk. Το προκαθορισμένο είναι 'cron'

<BR>
<A NAME="servers-ASTmgrSECRET">
<BR>
<B>Μυστικό Διαχειριστή -</B> Το μυστικό ή κωδικός που χρησιμοποιείτε γενικά για τον διαχειριστή του διακομιστή Asterisk. Το προκαθορισμένο είναι '1111'

<BR>
<A NAME="servers-ASTmgrUSERNAMEupdate">
<BR>
<B>Ενημέρωση Χρήστη Διαχειριστή -</B> Το όνομα χρήστη που χρησιμοποιείτε για σύνδεση στον διακομιστή Asterisk, βελτιστοποιημένο για διεργασίες ενημέρωσης. Το προκαθορισμένο είναι 'updatecron'.

<BR>
<A NAME="servers-ASTmgrUSERNAMElisten">
<BR>
<B>Ακουσμα Χρήστη Διαχειριστή-</B> Το όνομα χρήστη που χρησιμοποιείτε για σύνδεση στον διακομιστή Asterisk, βελτιστοποιημένο για διεργασίες που μόνο ακούν για έξοδο. Το προκαθορισμένο είναι 'listencron'.

<BR>
<A NAME="servers-ASTmgrUSERNAMEsend">
<BR>
<B>Αποστολή Διακομιστή Διαχειριστή-</B> Το όνομα χρήστη που χρησιμοποιείτε για σύνδεση στον διακομιστή Asterisk, βελτιστοποιημένο για διεργασίες που μόνο στέλνουν Ενέργειες στον διαχειριστή.Το προκαθορισμένο είναι 'sendcron'.

<BR>
<A NAME="servers-local_gmt">
<BR>
<B>GMT offset Διακομιστής -</B> Η διαφορά σε ώρες από την GMT ώρα που δεν έχει ρυθμιστεί με Daylight-Savings-Time. Το προκαθορισμένο είναι '-5'

<BR>
<A NAME="servers-voicemail_dump_exten">
<BR>
<B>Εσωτ.σύνδεση απόρριψης VMail -</B> Το πρόθεμα εσωτ.σύνδεσης που χρησιμοποιείται στον διακομιστή για να στείλει τις κλήσεις κατευθείαν μέσω agc σε ένα συγκεκριμένο φωνητικό ταχυδρομείο. Το προκαθορισμένο είναι '85026666666666'

<BR>
<A NAME="servers-answer_transfer_agent">
<BR>
<B>VICIDIAL AD εσωτ.σύνδεση -</B> Η προκαθορισμένη εσωτ.σύνδεση εάν δεν έχει οριστεί στην εκστρατεία για να στείλει τις κλήσεις στην διεργασία αυτόματης κλήσης. Η προκαθορισμένη είναι '8365'

<BR>
<A NAME="servers-ext_context">
<BR>
<B>Προκαθορισμένο Περιεχόμενο -</B> Το προκαθορισμένο περιεχόμενο του πλάνου κλήσεων για διεργασίες του διακομιστή. Το προκαθορισμένο είναι 'προκαθορισμένο'

<BR>
<A NAME="servers-sys_perf_log">
<BR>
<B>System Performance -</B> Setting this option to Y will enable logging of system performance stats for the server machine including system load, system processes and Asterisk channels in use. Default is N.

<BR>
<A NAME="servers-vd_server_logs">
<BR>
<B>Server Logs -</B> Setting this option to Y will enable logging of all VICIDIAL related scripts to their text log files. Setting this to N will stop writing logs to files for these processes, also the screen logging of asterisk will be disabled if this is set to N when Asterisk is started. Default is Y.

<BR>
<A NAME="servers-agi_output">
<BR>
<B>AGI Output -</B> Setting this option to NONE will disable output from all VICIDIAL related AGI scripts. Setting this to STDERR will send the AGI output to the Asterisk CLI. Setting this to FILE will send the output to a file in the logs directory. Setting this to BOTH will send output to both the Asterisk CLI and a log file. Default is FILE.


<BR><BR><BR><BR>

<B><FONT SIZE=3>ΠΙΝΑΚΑΣ ΣΥΝΔΙΑΛΕΞΕΩΝ</FONT></B><BR><BR>
<A NAME="conferences-conf_exten">
<BR>
<B>Αριθμός Συνδιάλεξης -</B> Αυτό το πεδίο είναι για τον αριθμό συνδιάλεξης meetme στο σχέδιο κλήσεων. Επίσης, συνιστούμε ο αριθμός meetme στο meetme.conf να ταιριάζει με αυτό τον αριθμό για κάθε καταχώρηση. Αυτό είναι για τις συνδιαλέξε στο astGUIclient και χρησιμοποιείται για την λειτουργία αποχώρησης από κλήση με 3 γραμμές στο VICIDIAL.

<BR>
<A NAME="conferences-server_ip">
<BR>
<B>IP Διακομιστή-</B> Ο κατάλογος που επιλέξατε τον διακομιστή ASTERISK όπου η συνδιάλεξη θα είναι.






<BR><BR><BR><BR><BR><BR><BR><BR>
<BR><BR><BR><BR><BR><BR><BR><BR>
ΤΕΛΟΣ
</TD></TR></TABLE></BODY></HTML>
<?
exit;

#### END HELP SCREENS
}








?>
<html>
<head>
<title>ΣΥΣΤΗΜΑ ΚΛΗΣΕΩΝ: Διαχείριση - <? echo $process ?></title>
<script language="Javascript">
function openNewWindow(url) {
  window.open (url,"",'width=500,height=300,scrollbars=yes,menubar=yes,address=yes');
}
</script>
</head>
<BODY BGCOLOR=white marginheight=0 marginwidth=0 leftmargin=0 topmargin=0>
<CENTER>
<TABLE WIDTH=620 BGCOLOR=#D9E6FE cellpadding=2 cellspacing=0><TR BGCOLOR=#015B91><TD ALIGN=LEFT><FONT FACE="ARIAL,HELVETICA" COLOR=WHITE SIZE=2><B> &nbsp; ASTERISK ADMIN - <a href="<? echo $PHP_SELF ?>?force_logout=1"><FONT FACE="ARIAL,HELVETICA" COLOR=WHITE SIZE=1>Αποσύνδεση</a></TD><TD ALIGN=RIGHT><FONT FACE="ARIAL,HELVETICA" COLOR=WHITE SIZE=2><B><? echo date("l F j, Y G:i:s A") ?> &nbsp; </TD></TR>
<TR BGCOLOR=#F0F5FE><TD ALIGN=LEFT COLSPAN=2><FONT FACE="ARIAL,HELVETICA" COLOR=BLACK SIZE=1><B> &nbsp; <a href="<? echo $PHP_SELF ?>"><FONT FACE="ARIAL,HELVETICA" COLOR=BLACK SIZE=1>ΛΙΣΤΑ ΤΗΛΕΦΩΝΩΝ</a> | <a href="<? echo $PHP_SELF ?>?ADD=1"><FONT FACE="ARIAL,HELVETICA" COLOR=BLACK SIZE=1>ΠΡΟΣΘΗΚΗ ΤΗΛΕΦΩΝΟΥ</a> | <a href="<? echo $PHP_SELF ?>?ADD=55"><FONT FACE="ARIAL,HELVETICA" COLOR=BLACK SIZE=1>ΑΝΑΖΗΤΗΣΗ ΤΗΛΕΦΩΝΟΥ</a> | <a href="<? echo $PHP_SELF ?>?ADD=11"><FONT FACE="ARIAL,HELVETICA" COLOR=BLACK SIZE=1>ΠΡΟΣΘΗΚΗ ΔΙΑΚΟΜΙΣΤΗ</a> | <a href="<? echo $PHP_SELF ?>?ADD=10"><FONT FACE="ARIAL,HELVETICA" COLOR=BLACK SIZE=1>ΛΙΣΤΑ ΔΙΑΚΟΜΙΣΤΩΝ</a></TD></TR>
<TR BGCOLOR=#F0F5FE><TD ALIGN=LEFT COLSPAN=2><FONT FACE="ARIAL,HELVETICA" COLOR=BLACK SIZE=1><B> &nbsp; <a href="<? echo $PHP_SELF ?>?ADD=100"><FONT FACE="ARIAL,HELVETICA" COLOR=BLACK SIZE=1>ΕΜΦΑΝΙΣΗ ΣΥΝΔΙΑΛΕΞΕΩΝ</a> | <a href="<? echo $PHP_SELF ?>?ADD=111"><FONT FACE="ARIAL,HELVETICA" COLOR=BLACK SIZE=1>ΠΡΟΣΘΗΚΗ ΣΥΝΔΙΑΛΕΞΗΣ</a></TD></TR>



<TR><TD ALIGN=LEFT COLSPAN=2>
<? 
######################
# ADD=1 display the ADD NEW PHONE FORM SCREEN
######################

if ($ADD==1)
{
echo "<FONT FACE=\"ARIAL,HELVETICA\" COLOR=BLACK SIZE=2>";

echo "<br>ΠΡΟΣΘΗΚΗ ΤΗΛΕΦΩΝΟΥ<form action=$PHP_SELF method=POST>\n";
echo "<input type=hidden name=ADD value=2>\n";
echo "<center><TABLE width=600 cellspacing=3>\n";

echo "<center><TABLE width=600 cellspacing=3>\n";
echo "<tr bgcolor=#B6D3FC><td align=right>Τηλ.σύνδεσης τηλεφώνου: </td><td align=left><input type=text name=extension size=20 maxlength=100 value=\"\">$NWB#phones-extension$NWE</td></tr>\n";
echo "<tr bgcolor=#B6D3FC><td align=right>Αριθμός Σχεδίου Κλήσεων: </td><td align=left><input type=text name=dialplan_number size=15 maxlength=20 value=\"$row[1]\"> (μόνο αριθμοί)$NWB#phones-dialplan_number$NWE</td></tr>\n";
echo "<tr bgcolor=#B6D3FC><td align=right>Περιεχόμενο Φωνητικού Ταχυδρομείου: </td><td align=left><input type=text name=voicemail_id size=10 maxlength=10 value=\"$row[2]\"> (μόνο αριθμοί)$NWB#phones-voicemail_id$NWE</td></tr>\n";
echo "<tr bgcolor=#B6D3FC><td align=right>Εξερχόμενο CallerID: </td><td align=left><input type=text name=outbound_cid size=10 maxlength=20 value=\"$row[65]\"> (μόνο αριθμοί)$NWB#phones-outbound_cid$NWE</td></tr>\n";
echo "<tr bgcolor=#B6D3FC><td align=right>Δνση IP Τηλεφώνου: </td><td align=left><input type=text name=phone_ip size=20 maxlength=15 value=\"$row[3]\"> (optional)$NWB#phones-phone_ip$NWE</td></tr>\n";
echo "<tr bgcolor=#B6D3FC><td align=right>Δνση IP Υπολογιστή: </td><td align=left><input type=text name=computer_ip size=20 maxlength=15 value=\"$row[4]\"> (optional)$NWB#phones-computer_ip$NWE</td></tr>\n";
echo "<tr bgcolor=#B6D3FC><td align=right>IP Διακομιστή: </td><td align=left><select size=1 name=server_ip>\n";

echo "$servers_list";
echo "<option SELECTED>$row[5]</option>\n";
echo "</select>$NWB#phones-server_ip$NWE</td></tr>\n";
echo "<tr bgcolor=#B6D3FC><td align=right>Σύνδεση:</td><td align=left><input type=text name=login size=10 maxlength=10 value=\"$row[6]\">$NWB#phones-login$NWE</td></tr>\n";
echo "<tr bgcolor=#B6D3FC><td align=right>Κωδικός:</td><td align=left><input type=text name=pass size=10 maxlength=10 value=\"$row[7]\">$NWB#phones-pass$NWE</td></tr>\n";
echo "<tr bgcolor=#B6D3FC><td align=right>Κατάσταση:</td><td align=left><select size=1 name=status><option>ΕΝΕΡΓΑ</option><option>SUSPENDED</option><option>CLOSED</option><option>PENDING</option><option>ADMIN</option><option selected>$row[8]</option></select>$NWB#phones-status$NWE</td></tr>\n";
echo "<tr bgcolor=#B6D3FC><td align=right>Ενεργός Λογαριασμός: </td><td align=left><select size=1 name=active><option>Y</option><option>N</option><option selected>$row[9]</option></select>$NWB#phones-active$NWE</td></tr>\n";
echo "<tr bgcolor=#B6D3FC><td align=right>Τύπος τηλεφώνου: </td><td align=left><input type=text name=phone_type size=20 maxlength=50 value=\"$row[10]\">$NWB#phones-phone_type$NWE</td></tr>\n";
echo "<tr bgcolor=#B6D3FC><td align=right>Πλήρες Ονομα: </td><td align=left><input type=text name=fullname size=20 maxlength=50 value=\"$row[11]\">$NWB#phones-fullname$NWE</td></tr>\n";
echo "<tr bgcolor=#B6D3FC><td align=right>Εταιρία:</td><td align=left><input type=text name=company size=10 maxlength=10 value=\"$row[12]\">$NWB#phones-company$NWE</td></tr>\n";
echo "<tr bgcolor=#B6D3FC><td align=right>Εικόνα:</td><td align=left><input type=text name=picture size=20 maxlength=19 value=\"$row[13]\">$NWB#phones-picture$NWE</td></tr>\n";
echo "<tr bgcolor=#B6D3FC><td align=right>Προτόκολο Πελάτη: </td><td align=left><select size=1 name=protocol><option>SIP</option><option>Zap</option><option>IAX2</option><option>EXTERNAL</option><option selected>$row[16]</option></select>$NWB#phones-protocol$NWE</td></tr>\n";
echo "<tr bgcolor=#B6D3FC><td align=right>Τοπικό GMT: </td><td align=left><select size=1 name=local_gmt><option>12.75</option><option>12.00</option><option>11.00</option><option>10.00</option><option>9.50</option><option>9.00</option><option>8.00</option><option>7.00</option><option>6.50</option><option>6.00</option><option>5.75</option><option>5.50</option><option>5.00</option><option>4.50</option><option>4.00</option><option>3.50</option><option>3.00</option><option>2.00</option><option>1.00</option><option>0.00</option><option>-1.00</option><option>-2.00</option><option>-3.00</option><option>-3.50</option><option>-4.00</option><option>-5.00</option><option>-6.00</option><option>-7.00</option><option>-8.00</option><option>-9.00</option><option>-10.00</option><option>-11.00</option><option>-12.00</option><option selected>$row[17]</option></select> (Μην ρυθμίσεις για DST)$NWB#phones-local_gmt$NWE</td></tr>\n";
echo "<tr bgcolor=#B6D3FC><td align=center colspan=2><input type=submit name=submit VALUE=ΥΠΟΒΑΛΛΩ></td></tr>\n";
echo "</TABLE></center>\n";

}


######################
# ADD=11 display the ADD NEW SERVERS FORM SCREEN
######################

if ($ADD==11)
{
echo "<FONT FACE=\"ARIAL,HELVETICA\" COLOR=BLACK SIZE=2>";

echo "<br>ΠΡΟΣΘΗΚΗ ΔΙΑΚΟΜΙΣΤΗ<form action=$PHP_SELF method=POST>\n";
echo "<input type=hidden name=ADD value=21>\n";
echo "<center><TABLE width=600 cellspacing=3>\n";
echo "<tr bgcolor=#B6D3FC><td align=right>ID Διακομιστή: </td><td align=left><input type=text name=server_id size=10 maxlength=10>$NWB#servers-server_id$NWE</td></tr>\n";
echo "<tr bgcolor=#B6D3FC><td align=right>Περιγραφή Διακομιστή: </td><td align=left><input type=text name=server_description size=30 maxlength=255>$NWB#servers-server_description$NWE</td></tr>\n";
echo "<tr bgcolor=#B6D3FC><td align=right>Δνση IP Διακομιστή: </td><td align=left><input type=text name=server_ip size=20 maxlength=15>$NWB#servers-server_ip$NWE</td></tr>\n";
echo "<tr bgcolor=#B6D3FC><td align=right>Ενεργή:</td><td align=left><select size=1 name=active><option>Y</option><option>N</option></select>$NWB#servers-active$NWE</td></tr>\n";
echo "<tr bgcolor=#B6D3FC><td align=right>Εκδοση Asterisk: </td><td align=left><input type=text name=asterisk_version size=20 maxlength=20>$NWB#servers-asterisk_version$NWE</td></tr>\n";
echo "<tr bgcolor=#B6D3FC><td align=center colspan=2><input type=submit name=submit VALUE=ΥΠΟΒΑΛΛΩ></td></tr>\n";
echo "</TABLE></center>\n";

}


######################
# ADD=111 display the ADD NEW CONFERENCES FORM SCREEN
######################

if ($ADD==111)
{
echo "<FONT FACE=\"ARIAL,HELVETICA\" COLOR=BLACK SIZE=2>";

echo "<br>ΠΡΟΣΘΗΚΗ ΣΥΝΔΙΑΛΕΞΗΣ<form action=$PHP_SELF method=POST>\n";
echo "<input type=hidden name=ADD value=211>\n";
echo "<center><TABLE width=600 cellspacing=3>\n";
echo "<tr bgcolor=#B6D3FC><td align=right>Αριθμός Συνδιάλεξης: </td><td align=left><input type=text name=conf_exten size=8 maxlength=7> (μόνο αριθμοί)$NWB#conferences-conf_exten$NWE</td></tr>\n";
echo "<tr bgcolor=#B6D3FC><td align=right>IP Διακομιστή: </td><td align=left><select size=1 name=server_ip>\n";

echo "$servers_list";
echo "<option SELECTED>$server_ip</option>\n";
echo "</select>$NWB#conferences-server_ip$NWE</td></tr>\n";
echo "<tr bgcolor=#B6D3FC><td align=center colspan=2><input type=submit name=submit VALUE=ΥΠΟΒΑΛΛΩ></td></tr>\n";
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
		{echo "<br>ΤΟ ΤΗΛΕΦΩΝΟ ΔΕΝ ΠΡΟΣΤΕΘΗΚΕ - υπάρχει ήδη ένα τηλέφωνο με αυτή την εσωτ.σύνδεση/διακομιστή\n";}
	else
		{
		 if ( (strlen($extension) < 1) or (strlen($server_ip) < 7) or (strlen($dialplan_number) < 1) or (strlen($voicemail_id) < 1) or (strlen($login) < 1)  or (strlen($pass) < 1))
			{echo "<br>ΤΟ ΤΗΛΕΦΩΝΟ ΔΕΝ ΠΡΟΣΤΕΘΗΚΕ - Παρακαλώ ελέγξτε τα δεδομένα που καταχωρήσατε\n";}
		 else
			{
			echo "<br>ΤΟ ΤΗΛΕΦΩΝΟ ΠΡΟΣΤΕΘΗΚΕ\n";

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
		{echo "<br>Ο ΔΙΑΚΟΜΙΣΤΗΣ ΔΕΝ ΠΡΟΣΤΕΘΗΚΕ - υπάρχει ήδη ένας διακομιστής με αυτό το ID\n";}
	else
		{
		 if ( (strlen($server_id) < 1) or (strlen($server_ip) < 7) )
			{echo "<br>Ο ΔΙΑΚΟΜΙΣΤΗΣ ΔΕΝ ΠΡΟΣΤΕΘΗΚΕ - Παρακαλώ ελέγξτε τα δεδομένα που καταχωρήσατε\n";}
		 else
			{
			echo "<br>Ο ΔΙΑΚΟΜΙΣΤΗΣ ΠΡΟΣΤΕΘΗΚΕ\n";

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
		{echo "<br>Η ΣΥΝΔΙΑΛΕΞΗ ΔΕΝ ΠΡΟΣΤΕΘΗΚΕ - υπάρχει ήδη μία συνδιάλεξη με αυτό το ID και διακομιστή\n";}
	else
		{
		 if ( (strlen($conf_exten) < 1) or (strlen($server_ip) < 7) )
			{echo "<br>Η ΣΥΝΔΙΑΛΕΞΗ ΔΕΝ ΠΡΟΣΤΕΘΗΚΕ - Παρακαλώ ελέγξτε τα δεδομένα που καταχωρήσατε\n";}
		 else
			{
			echo "<br>Η ΣΥΝΔΙΑΛΕΞΗ ΠΡΟΣΤΕΘΗΚΕ\n";

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
		 echo "<br>ΤΟ ΤΗΛΕΦΩΝΟ ΔΕΝ ΔΙΑΓΡΑΦΗΚΕ - Παρακαλώ επιστρέψτε πίσω και κάνετε έλεγχο των δεδομένων που καταχωρήσατε\n";
		 echo "<br>Extension be at least 2 characters in length\n";
		 echo "<br>IP Διακομιστή be at least 7 characters in length\n";
		}
	 else
		{
		echo "<br><B>ΕΠΙΒΕΒΑΙΩΣΗ ΔΙΑΓΡΑΦΗΣ ΤΗΛΕΦΩΝΟΥ: $extension - $server_ip</B>\n";
		echo "<br><br><a href=\"$PHP_SELF?ADD=6&extension=$extension&server_ip=$server_ip&CoNfIrM=YES\">Χτυπήστε εδώ για να διαγράψετε το τηλέφωνο $extension - $server_ip</a><br><br><br>\n";
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
		 echo "<br>ΤΟ ΤΗΛΕΦΩΝΟ ΔΕΝ ΔΙΑΓΡΑΦΗΚΕ - Παρακαλώ επιστρέψτε πίσω και κάνετε έλεγχο των δεδομένων που καταχωρήσατε\n";
		 echo "<br>Extension be at least 2 characters in length\n";
		 echo "<br>IP Διακομιστή be at least 7 characters in length\n";
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
		echo "<br><B>Η ΔΙΑΓΡΑΦΗ ΤΟΥ ΤΗΛΕΦΩΝΟΥ ΟΛΟΚΛΗΡΩΘΗΚΕ: $extension - $server_ip</B>\n";
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

echo "<br>ΤΡΟΠΟΠΟΙΗΣΗ ΕΓΓΡΑΦΗΣ ΤΗΛΕΦΩΝΟΥ: $row[1]<form action=$PHP_SELF method=POST>\n";
echo "<input type=hidden name=ADD value=4>\n";
echo "<input type=hidden name=old_extension value=\"$row[0]\">\n";
echo "<input type=hidden name=old_server_ip value=\"$row[5]\">\n";
echo "<center><TABLE width=600 cellspacing=3>\n";
echo "<tr bgcolor=#B6D3FC><td align=right>Τηλ.σύνδεσης τηλεφώνου: </td><td align=left><input type=text name=extension size=20 maxlength=100 value=\"$row[0]\">$NWB#phones-extension$NWE</td></tr>\n";
echo "<tr bgcolor=#B6D3FC><td align=right>Αριθμός Σχεδίου Κλήσεων: </td><td align=left><input type=text name=dialplan_number size=15 maxlength=20 value=\"$row[1]\"> (μόνο αριθμοί)$NWB#phones-dialplan_number$NWE</td></tr>\n";
echo "<tr bgcolor=#B6D3FC><td align=right>Περιεχόμενο Φωνητικού Ταχυδρομείου: </td><td align=left><input type=text name=voicemail_id size=10 maxlength=10 value=\"$row[2]\"> (μόνο αριθμοί)$NWB#phones-voicemail_id$NWE</td></tr>\n";
echo "<tr bgcolor=#B6D3FC><td align=right>Εξερχόμενο CallerID: </td><td align=left><input type=text name=outbound_cid size=10 maxlength=20 value=\"$row[65]\"> (μόνο αριθμοί)$NWB#phones-outbound_cid$NWE</td></tr>\n";
echo "<tr bgcolor=#B6D3FC><td align=right>Δνση IP Τηλεφώνου: </td><td align=left><input type=text name=phone_ip size=20 maxlength=15 value=\"$row[3]\"> (optional)$NWB#phones-phone_ip$NWE</td></tr>\n";
echo "<tr bgcolor=#B6D3FC><td align=right>Δνση IP Υπολογιστή: </td><td align=left><input type=text name=computer_ip size=20 maxlength=15 value=\"$row[4]\"> (optional)$NWB#phones-computer_ip$NWE</td></tr>\n";
echo "<tr bgcolor=#B6D3FC><td align=right>IP Διακομιστή: </td><td align=left><select size=1 name=server_ip>\n";

echo "$servers_list";
echo "<option SELECTED>$row[5]</option>\n";
echo "</select>$NWB#phones-server_ip$NWE</td></tr>\n";
echo "<tr bgcolor=#B6D3FC><td align=right>Σύνδεση:</td><td align=left><input type=text name=login size=10 maxlength=10 value=\"$row[6]\">$NWB#phones-login$NWE</td></tr>\n";
echo "<tr bgcolor=#B6D3FC><td align=right>Κωδικός:</td><td align=left><input type=text name=pass size=10 maxlength=10 value=\"$row[7]\">$NWB#phones-pass$NWE</td></tr>\n";
echo "<tr bgcolor=#B6D3FC><td align=right>Κατάσταση:</td><td align=left><select size=1 name=status><option>ΕΝΕΡΓΑ</option><option>SUSPENDED</option><option>CLOSED</option><option>PENDING</option><option>ADMIN</option><option selected>$row[8]</option></select>$NWB#phones-status$NWE</td></tr>\n";
echo "<tr bgcolor=#B6D3FC><td align=right>Ενεργός Λογαριασμός: </td><td align=left><select size=1 name=active><option>Y</option><option>N</option><option selected>$row[9]</option></select>$NWB#phones-active$NWE</td></tr>\n";
echo "<tr bgcolor=#B6D3FC><td align=right>Τύπος τηλεφώνου: </td><td align=left><input type=text name=phone_type size=20 maxlength=50 value=\"$row[10]\">$NWB#phones-phone_type$NWE</td></tr>\n";
echo "<tr bgcolor=#B6D3FC><td align=right>Πλήρες Ονομα: </td><td align=left><input type=text name=fullname size=20 maxlength=50 value=\"$row[11]\">$NWB#phones-fullname$NWE</td></tr>\n";
echo "<tr bgcolor=#B6D3FC><td align=right>Εταιρία:</td><td align=left><input type=text name=company size=10 maxlength=10 value=\"$row[12]\">$NWB#phones-company$NWE</td></tr>\n";
echo "<tr bgcolor=#B6D3FC><td align=right>Εικόνα:</td><td align=left><input type=text name=picture size=20 maxlength=19 value=\"$row[13]\">$NWB#phones-picture$NWE</td></tr>\n";
echo "<tr bgcolor=#B6D3FC><td align=right>Νέα Μηνύματα: </td><td align=left><b>$row[14]</b>$NWB#phones-messages$NWE</td></tr>\n";
echo "<tr bgcolor=#B6D3FC><td align=right>Παλαιά Μηνύματα: </td><td align=left><b>$row[15]</b>$NWB#phones-old_messages$NWE</td></tr>\n";
echo "<tr bgcolor=#B6D3FC><td align=right>Προτόκολο Πελάτη: </td><td align=left><select size=1 name=protocol><option>SIP</option><option>Zap</option><option>IAX2</option><option>EXTERNAL</option><option selected>$row[16]</option></select>$NWB#phones-protocol$NWE</td></tr>\n";
echo "<tr bgcolor=#B6D3FC><td align=right>Τοπικό GMT: </td><td align=left><select size=1 name=local_gmt><option>12.75</option><option>12.00</option><option>11.00</option><option>10.00</option><option>9.50</option><option>9.00</option><option>8.00</option><option>7.00</option><option>6.50</option><option>6.00</option><option>5.75</option><option>5.50</option><option>5.00</option><option>4.50</option><option>4.00</option><option>3.50</option><option>3.00</option><option>2.00</option><option>1.00</option><option>0.00</option><option>-1.00</option><option>-2.00</option><option>-3.00</option><option>-3.50</option><option>-4.00</option><option>-5.00</option><option>-6.00</option><option>-7.00</option><option>-8.00</option><option>-9.00</option><option>-10.00</option><option>-11.00</option><option>-12.00</option><option selected>$row[17]</option></select> (Μην ρυθμίσεις για DST)$NWB#phones-local_gmt$NWE</td></tr>\n";
echo "<tr bgcolor=#B6D3FC><td align=right>Διαχειριστή Σύνδεση: </td><td align=left><input type=text name=ASTmgrUSERNAME size=20 maxlength=20 value=\"$row[18]\">$NWB#phones-ASTmgrUSERNAME$NWE</td></tr>\n";
echo "<tr bgcolor=#B6D3FC><td align=right>Κωδικός Διαχειριστή: </td><td align=left><input type=text name=ASTmgrSECRET size=20 maxlength=20 value=\"$row[19]\">$NWB#phones-ASTmgrSECRET$NWE</td></tr>\n";
echo "<tr bgcolor=#B6D3FC><td align=right>VICIDIAL Προκαθορισμένος Χρήστης: </td><td align=left><input type=text name=login_user size=20 maxlength=20 value=\"$row[20]\">$NWB#phones-login_user$NWE</td></tr>\n";
echo "<tr bgcolor=#B6D3FC><td align=right>VICIDIAL Προκαθορισμένος Κωδικός: </td><td align=left><input type=text name=login_pass size=20 maxlength=20 value=\"$row[21]\">$NWB#phones-login_pass$NWE</td></tr>\n";
echo "<tr bgcolor=#B6D3FC><td align=right>VICIDIAL Προκαθορισμένη εκστρατεία: </td><td align=left><input type=text name=login_campaign size=10 maxlength=10 value=\"$row[22]\">$NWB#phones-login_campaign$NWE</td></tr>\n";
echo "<tr bgcolor=#B6D3FC><td align=right>Τηλ.σύνδ. Στάθμευσης: </td><td align=left><input type=text name=park_on_extension size=10 maxlength=10 value=\"$row[23]\">$NWB#phones-park_on_extension$NWE</td></tr>\n";
echo "<tr bgcolor=#B6D3FC><td align=right>Τηλ.σύνδ. Συνδ.: </td><td align=left><input type=text name=conf_on_extension size=10 maxlength=10 value=\"$row[24]\">$NWB#phones-conf_on_extension$NWE</td></tr>\n";
echo "<tr bgcolor=#B6D3FC><td align=right>VICIDIAL Τηλ.σύνδ. Στάθμευσης: </td><td align=left><input type=text name=VICIDIAL_park_on_extension size=10 maxlength=10 value=\"$row[25]\">$NWB#phones-VICIDIAL_park_on_extension$NWE</td></tr>\n";
echo "<tr bgcolor=#B6D3FC><td align=right>VICIDIAL Αρχείο Στάθμευσης: </td><td align=left><input type=text name=VICIDIAL_park_on_filename size=10 maxlength=10 value=\"$row[26]\">$NWB#phones-VICIDIAL_park_on_filename$NWE</td></tr>\n";
echo "<tr bgcolor=#B6D3FC><td align=right>Πρόθεμα Παρακολούθησης: </td><td align=left><input type=text name=monitor_prefix size=10 maxlength=10 value=\"$row[27]\">$NWB#phones-monitor_prefix$NWE</td></tr>\n";
echo "<tr bgcolor=#B6D3FC><td align=right>Ηχογράφηση εσωτ.σύνδ.: </td><td align=left><input type=text name=recording_exten size=10 maxlength=10 value=\"$row[28]\">$NWB#phones-recording_exten$NWE</td></tr>\n";
echo "<tr bgcolor=#B6D3FC><td align=right>VMailMain Τηλ.σύνδ.: </td><td align=left><input type=text name=voicemail_exten size=10 maxlength=10 value=\"$row[29]\">$NWB#phones-voicemail_exten$NWE</td></tr>\n";
echo "<tr bgcolor=#B6D3FC><td align=right>VMailDump Τηλ.σύνδ.: </td><td align=left><input type=text name=voicemail_dump_exten size=20 maxlength=20 value=\"$row[30]\">$NWB#phones-voicemail_dump_exten$NWE</td></tr>\n";
echo "<tr bgcolor=#B6D3FC><td align=right>Περιεχόμενο Τηλ.σύνδ: </td><td align=left><input type=text name=ext_context size=20 maxlength=20 value=\"$row[31]\">$NWB#phones-ext_context$NWE</td></tr>\n";
echo "<tr bgcolor=#B6D3FC><td align=right>DTMFSend Κανάλι: </td><td align=left><input type=text name=dtmf_send_extension size=40 maxlength=100 value=\"$row[32]\">$NWB#phones-dtmf_send_extension$NWE</td></tr>\n";
echo "<tr bgcolor=#B6D3FC><td align=right>Ομάδα Εξερχομένων Κλήσεων: </td><td align=left><input type=text name=call_out_number_group size=40 maxlength=100 value=\"$row[33]\">$NWB#phones-call_out_number_group$NWE</td></tr>\n";
echo "<tr bgcolor=#B6D3FC><td align=right>Θέση Φυλλομετρητή: </td><td align=left><input type=text name=client_browser size=40 maxlength=100 value=\"$row[34]\">$NWB#phones-client_browser$NWE</td></tr>\n";
echo "<tr bgcolor=#B6D3FC><td align=right>Κατάλογος εγκατάστασης: </td><td align=left><input type=text name=install_directory size=40 maxlength=100 value=\"$row[35]\">$NWB#phones-install_directory$NWE</td></tr>\n";
echo "<tr bgcolor=#B6D3FC><td align=right>CallerID URL: </td><td align=left><input type=text name=local_web_callerID_URL size=40 maxlength=255 value=\"$row[36]\">$NWB#phones-local_web_callerID_URL$NWE</td></tr>\n";
echo "<tr bgcolor=#B6D3FC><td align=right>VICIDIAL Προκαθορισμένο URL: </td><td align=left><input type=text name=VICIDIAL_web_URL size=40 maxlength=255 value=\"$row[37]\">$NWB#phones-VICIDIAL_web_URL$NWE</td></tr>\n";
echo "<tr bgcolor=#B6D3FC><td align=right>Καταγραφή Γεγονότος Κλήσης: </td><td align=left><select size=1 name=AGI_call_logging_enabled><option>1</option><option>0</option><option selected>$row[38]</option></select>$NWB#phones-AGI_call_logging_enabled$NWE</td></tr>\n";
echo "<tr bgcolor=#B6D3FC><td align=right>Μεταγωγή Χρήστη: </td><td align=left><select size=1 name=user_switching_enabled><option>1</option><option>0</option><option selected>$row[39]</option></select>$NWB#phones-user_switching_enabled$NWE</td></tr>\n";
echo "<tr bgcolor=#B6D3FC><td align=right>Σε συνδιαλέξη: </td><td align=left><select size=1 name=conferencing_enabled><option>1</option><option>0</option><option selected>$row[40]</option></select>$NWB#phones-conferencing_enabled$NWE</td></tr>\n";
echo "<tr bgcolor=#B6D3FC><td align=right>Διαχειριστού Κλείσιμο: </td><td align=left><select size=1 name=admin_hangup_enabled><option>1</option><option>0</option><option selected>$row[41]</option></select>$NWB#phones-admin_hangup_enabled$NWE</td></tr>\n";
echo "<tr bgcolor=#B6D3FC><td align=right>Διαχειριστού Κλέψιμο: </td><td align=left><select size=1 name=admin_hijack_enabled><option>1</option><option>0</option><option selected>$row[42]</option></select>$NWB#phones-admin_hijack_enabled$NWE</td></tr>\n";
echo "<tr bgcolor=#B6D3FC><td align=right>Διαχειριστού Παρακολούθηση: </td><td align=left><select size=1 name=admin_monitor_enabled><option>1</option><option>0</option><option selected>$row[43]</option></select>$NWB#phones-admin_monitor_enabled$NWE</td></tr>\n";
echo "<tr bgcolor=#B6D3FC><td align=right>Στάθμευση Κλήσης: </td><td align=left><select size=1 name=call_parking_enabled><option>1</option><option>0</option><option selected>$row[44]</option></select>$NWB#phones-call_parking_enabled$NWE</td></tr>\n";
echo "<tr bgcolor=#B6D3FC><td align=right>Ελεγχος ενημερωτή: </td><td align=left><select size=1 name=updater_check_enabled><option>1</option><option>0</option><option selected>$row[45]</option></select>$NWB#phones-updater_check_enabled$NWE</td></tr>\n";
echo "<tr bgcolor=#B6D3FC><td align=right>AF Καταγραφή Γεγονότος: </td><td align=left><select size=1 name=AFLogging_enabled><option>1</option><option>0</option><option selected>$row[46]</option></select>$NWB#phones-AFLogging_enabled$NWE</td></tr>\n";
echo "<tr bgcolor=#B6D3FC><td align=right>Ενεργή Ουρά: </td><td align=left><select size=1 name=QUEUE_ACTION_enabled><option>1</option><option>0</option><option selected>$row[47]</option></select>$NWB#phones-QUEUE_ACTION_enabled$NWE</td></tr>\n";
echo "<tr bgcolor=#B6D3FC><td align=right>Υπερεμφανιζόμενο παραθύρο CallerID: </td><td align=left><select size=1 name=CallerID_popup_enabled><option>1</option><option>0</option><option selected>$row[48]</option></select>$NWB#phones-CallerID_popup_enabled$NWE</td></tr>\n";
echo "<tr bgcolor=#B6D3FC><td align=right>Πλήκτρο VMail: </td><td align=left><select size=1 name=voicemail_button_enabled><option>1</option><option>0</option><option selected>$row[49]</option></select>$NWB#phones-voicemail_button_enabled$NWE</td></tr>\n";
echo "<tr bgcolor=#B6D3FC><td align=right>Ταχύτητα Ανανέωσης: </td><td align=left><select size=1 name=enable_fast_refresh><option>1</option><option>0</option><option selected>$row[50]</option></select>$NWB#phones-enable_fast_refresh$NWE</td></tr>\n";
echo "<tr bgcolor=#B6D3FC><td align=right>Ρυθμός Ανανέωσης Ταχύτητας: </td><td align=left><input type=text size=5 name=fast_refresh_rate value=\"$row[51]\">(in ms)$NWB#phones-fast_refresh_rate$NWE</td></tr>\n";
echo "<tr bgcolor=#B6D3FC><td align=right>Συνεχής MySQL: </td><td align=left><select size=1 name=enable_persistant_mysql><option>1</option><option>0</option><option selected>$row[52]</option></select>$NWB#phones-enable_persistant_mysql$NWE</td></tr>\n";
echo "<tr bgcolor=#B6D3FC><td align=right>Αυτόματη Κλήση Επόμενου Αριθμού: </td><td align=left><select size=1 name=auto_dial_next_number><option>1</option><option>0</option><option selected>$row[53]</option></select>$NWB#phones-auto_dial_next_number$NWE</td></tr>\n";
echo "<tr bgcolor=#B6D3FC><td align=right>Σταμάτα την ηχογράφηση μετά από κάθε κλήση: </td><td align=left><select size=1 name=VDstop_rec_after_each_call><option>1</option><option>0</option><option selected>$row[54]</option></select>$NWB#phones-VDstop_rec_after_each_call$NWE</td></tr>\n";
echo "<tr bgcolor=#B6D3FC><td align=right>DBX Διακομιστής: </td><td align=left><input type=text name=DBX_server size=15 maxlength=15 value=\"$row[55]\"> (Πρωταρχικό DB Server)$NWB#phones-DBX_server$NWE</td></tr>\n";
echo "<tr bgcolor=#B6D3FC><td align=right>DBX Βάση Δεδομένων: </td><td align=left><input type=text name=DBX_database size=15 maxlength=15 value=\"$row[56]\"> (Πρωταρχικό Server Database)$NWB#phones-DBX_database$NWE</td></tr>\n";
echo "<tr bgcolor=#B6D3FC><td align=right>DBX Χρήστης: </td><td align=left><input type=text name=DBX_user size=15 maxlength=15 value=\"$row[57]\"> (Πρωταρχικό DB Login)$NWB#phones-DBX_user$NWE</td></tr>\n";
echo "<tr bgcolor=#B6D3FC><td align=right>DBX Κωδικός: </td><td align=left><input type=text name=DBX_pass size=15 maxlength=15 value=\"$row[58]\"> (Πρωταρχικό DB Secret)$NWB#phones-DBX_pass$NWE</td></tr>\n";
echo "<tr bgcolor=#B6D3FC><td align=right>DBX Πόρτα: </td><td align=left><input type=text name=DBX_port size=6 maxlength=6 value=\"$row[59]\"> (Πρωταρχικό DB Port)$NWB#phones-DBX_port$NWE</td></tr>\n";
echo "<tr bgcolor=#B6D3FC><td align=right>DBY Διακομιστής: </td><td align=left><input type=text name=DBY_server size=15 maxlength=15 value=\"$row[60]\"> (ΔευτερεύονDB Server)$NWB#phones-DBY_server$NWE</td></tr>\n";
echo "<tr bgcolor=#B6D3FC><td align=right>DBY Βάση Δεδομένων: </td><td align=left><input type=text name=DBY_database size=15 maxlength=15 value=\"$row[61]\"> (ΔευτερεύονServer Database)$NWB#phones-DBY_database$NWE</td></tr>\n";
echo "<tr bgcolor=#B6D3FC><td align=right>DBY Χρήστης: </td><td align=left><input type=text name=DBY_user size=15 maxlength=15 value=\"$row[62]\"> (ΔευτερεύονDB Login)$NWB#phones-DBY_user$NWE</td></tr>\n";
echo "<tr bgcolor=#B6D3FC><td align=right>DBY Κωδικός: </td><td align=left><input type=text name=DBY_pass size=15 maxlength=15 value=\"$row[63]\"> (ΔευτερεύονDB Secret)$NWB#phones-DBY_pass$NWE</td></tr>\n";
echo "<tr bgcolor=#B6D3FC><td align=right>DBY Πόρτα: </td><td align=left><input type=text name=DBY_port size=6 maxlength=6 value=\"$row[64]\"> (ΔευτερεύονDB Port)$NWB#phones-DBY_port$NWE</td></tr>\n";
echo "<tr bgcolor=#B6D3FC><td align=center colspan=2><input type=submit name=submit VALUE=ΥΠΟΒΑΛΛΩ></td></tr>\n";
echo "</TABLE></center>\n";

echo "<br><br><a href=\"./phone_stats.php?extension=$row[0]&server_ip=$row[5]\">Επιλέξτε εδώ για στατιστικά τηλεφώνου</a>\n";

if ($LOGdelete_phones > 0)
	{
	echo "<br><br><a href=\"$PHP_SELF?ADD=5&extension=$extension&server_ip=$server_ip\">ΔΙΑΓΡΑΨΕ ΑΥΤΟ ΤΟ ΤΗΛΕΦΩΝΟ</a>\n";
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

echo "<br>ΤΡΟΠΟΠΟΙΗΣΗ ΕΓΓΡΑΦΗΣ ΔΙΑΚΟΜΙΣΤΗ: $row[0]<form action=$PHP_SELF method=POST>\n";
echo "<input type=hidden name=ADD value=41>\n";
echo "<input type=hidden name=old_server_id value=\"$server_id\">\n";
echo "<input type=hidden name=old_server_ip value=\"$row[2]\">\n";
echo "<center><TABLE width=600 cellspacing=3>\n";
echo "<tr bgcolor=#B6D3FC><td align=right>ID Διακομιστή: </td><td align=left><input type=text name=server_id size=10 maxlength=10 value=\"$row[0]\">$NWB#servers-server_id$NWE</td></tr>\n";
echo "<tr bgcolor=#B6D3FC><td align=right>Περιγραφή Διακομιστή: </td><td align=left><input type=text name=server_description size=30 maxlength=255 value=\"$row[1]\">$NWB#servers-server_description$NWE</td></tr>\n";
echo "<tr bgcolor=#B6D3FC><td align=right>Δνση IP Διακομιστή: </td><td align=left><input type=text name=server_ip size=20 maxlength=15 value=\"$row[2]\">$NWB#servers-server_ip$NWE</td></tr>\n";
echo "<tr bgcolor=#B6D3FC><td align=right>Ενεργή:</td><td align=left><select size=1 name=active><option>Y</option><option>N</option><option selected>$row[3]</option></select>$NWB#servers-active$NWE</td></tr>\n";
echo "<tr bgcolor=#B6D3FC><td align=right>Εκδοση Asterisk: </td><td align=left><input type=text name=asterisk_version size=20 maxlength=20 value=\"$row[4]\">$NWB#servers-asterisk_version$NWE</td></tr>\n";
echo "<tr bgcolor=#B6D3FC><td align=right>Μέγιστος Αριθμός Trunk: </td><td align=left><input type=text name=max_vicidial_trunks size=5 maxlength=4 value=\"$row[5]\">$NWB#servers-max_vicidial_trunks$NWE</td></tr>\n";
echo "<tr bgcolor=#B6D3FC><td align=right>Λήπτης Telnet: </td><td align=left><input type=text name=telnet_host size=20 maxlength=20 value=\"$row[6]\">$NWB#servers-telnet_host$NWE</td></tr>\n";
echo "<tr bgcolor=#B6D3FC><td align=right>Πόρτα Telnet: </td><td align=left><input type=text name=telnet_port size=6 maxlength=5 value=\"$row[7]\">$NWB#servers-telnet_port$NWE</td></tr>\n";
echo "<tr bgcolor=#B6D3FC><td align=right>Χρήστη Διαχειριστή: </td><td align=left><input type=text name=ASTmgrUSERNAME size=20 maxlength=20 value=\"$row[8]\">$NWB#servers-ASTmgrUSERNAME$NWE</td></tr>\n";
echo "<tr bgcolor=#B6D3FC><td align=right>Κωδικός Διαχειριστή: </td><td align=left><input type=text name=ASTmgrSECRET size=20 maxlength=20 value=\"$row[9]\">$NWB#servers-ASTmgrSECRET$NWE</td></tr>\n";
echo "<tr bgcolor=#B6D3FC><td align=right>Ενημέρωση Χρήστη Διαχειριστή: </td><td align=left><input type=text name=ASTmgrUSERNAMEupdate size=20 maxlength=20 value=\"$row[10]\">$NWB#servers-ASTmgrUSERNAMEupdate$NWE</td></tr>\n";
echo "<tr bgcolor=#B6D3FC><td align=right>Παρακολούθηση Χρήστη Διαχειριστή: </td><td align=left><input type=text name=ASTmgrUSERNAMElisten size=20 maxlength=20 value=\"$row[11]\">$NWB#servers-ASTmgrUSERNAMElisten$NWE</td></tr>\n";
echo "<tr bgcolor=#B6D3FC><td align=right>Αποστολή Χρήστη Διαχειριστή: </td><td align=left><input type=text name=ASTmgrUSERNAMEsend size=20 maxlength=20 value=\"$row[12]\">$NWB#servers-ASTmgrUSERNAMEsend$NWE</td></tr>\n";
echo "<tr bgcolor=#B6D3FC><td align=right>Τοπικό GMT: </td><td align=left><select size=1 name=local_gmt><option>12.75</option><option>12.00</option><option>11.00</option><option>10.00</option><option>9.50</option><option>9.00</option><option>8.00</option><option>7.00</option><option>6.50</option><option>6.00</option><option>5.75</option><option>5.50</option><option>5.00</option><option>4.50</option><option>4.00</option><option>3.50</option><option>3.00</option><option>2.00</option><option>1.00</option><option>0.00</option><option>-1.00</option><option>-2.00</option><option>-3.00</option><option>-3.50</option><option>-4.00</option><option>-5.00</option><option>-6.00</option><option>-7.00</option><option>-8.00</option><option>-9.00</option><option>-10.00</option><option>-11.00</option><option>-12.00</option><option selected>$row[13]</option></select> (Μην ρυθμίσεις για DST)$NWB#servers-local_gmt$NWE</td></tr>\n";
echo "<tr bgcolor=#B6D3FC><td align=right>VMail εσωτ.σύνδεση απόρριψης: </td><td align=left><input type=text name=voicemail_dump_exten size=20 maxlength=20 value=\"$row[14]\">$NWB#servers-voicemail_dump_exten$NWE</td></tr>\n";
echo "<tr bgcolor=#B6D3FC><td align=right>AD εσωτ.σύνδεση: </td><td align=left><input type=text name=answer_transfer_agent size=20 maxlength=20 value=\"$row[15]\">$NWB#servers-answer_transfer_agent$NWE</td></tr>\n";
echo "<tr bgcolor=#B6D3FC><td align=right>Προκαθορισμένο Περιεχόμενο: </td><td align=left><input type=text name=ext_context size=20 maxlength=20 value=\"$row[16]\">$NWB#servers-ext_context$NWE</td></tr>\n";
echo "<tr bgcolor=#B6D3FC><td align=right>System Performance: </td><td align=left><select size=1 name=sys_perf_log><option>Y</option><option>N</option><option selected>$row[17]</option></select>$NWB#servers-sys_perf_log$NWE</td></tr>\n";
echo "<tr bgcolor=#B6D3FC><td align=right>Server Logs: </td><td align=left><select size=1 name=vd_server_logs><option>Y</option><option>N</option><option selected>$row[18]</option></select>$NWB#servers-vd_server_logs$NWE</td></tr>\n";
echo "<tr bgcolor=#B6D3FC><td align=right>AGI Output: </td><td align=left><select size=1 name=agi_output><option>NONE</option><option>STDERR</option><option>FILE</option><option>BOTH</option><option selected>$row[19]</option></select>$NWB#servers-agi_output$NWE</td></tr>\n";
echo "<tr bgcolor=#B6D3FC><td align=center colspan=2><input type=submit name=submit VALUE=ΥΠΟΒΑΛΛΩ></td></tr>\n";
echo "</TABLE></center>\n";

echo "<center>\n";
echo "<br><b>ΤΗΛΕΦΩΝΑ ΣΤΟΝ ΔΙΑΚΟΜΙΣΤΗ:</b><br>\n";
echo "<TABLE width=400 cellspacing=3>\n";
echo "<tr><td>ΤΗΛ.ΣΥΝΔΕΣΗ</td><td>ΟΝΟΜΑ</td><td>ΕΝΕΡΓΑ</td></tr>\n";

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
echo "Αυτός ο διακομιστής έχει $active_lists ενεργά τηλέφωνα και $inactive_lists μη ενεργά τηλέφωνα<br><br>\n";
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

echo "<br>ΤΡΟΠΟΠΟΙΗΣΗ ΕΓΓΡΑΦΗΣ ΣΥΝΔΙΑΛΕΞΗΣ: $row[0]<form action=$PHP_SELF method=POST>\n";
echo "<input type=hidden name=ADD value=411>\n";
echo "<input type=hidden name=old_conf_exten value=\"$row[0]\">\n";
echo "<input type=hidden name=old_server_ip value=\"$row[1]\">\n";
echo "<center><TABLE width=600 cellspacing=3>\n";
echo "<tr bgcolor=#B6D3FC><td align=right>Συνδιαλέξη:</td><td align=left><input type=text name=conf_exten size=10 maxlength=7 value=\"$row[0]\">$NWB#conferences-conf_exten$NWE</td></tr>\n";
echo "<tr bgcolor=#B6D3FC><td align=right>IP Διακομιστή: </td><td align=left><select size=1 name=server_ip>\n";

echo "$servers_list";
echo "<option SELECTED>$row[1]</option>\n";
echo "</select>$NWB#conferences-server_ip$NWE</td></tr>\n";
echo "<tr bgcolor=#B6D3FC><td align=right>Ισχύουσα εσωτ.σύνδεση: </td><td align=left><input type=text name=extension size=20 maxlength=20 value=\"$row[2]\"></td></tr>\n";
echo "<tr bgcolor=#B6D3FC><td align=center colspan=2><input type=submit name=submit VALUE=ΥΠΟΒΑΛΛΩ></td></tr>\n";
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
		{echo "<br>ΤΟ ΤΗΛΕΦΩΝΟ ΔΕΝ ΤΡΟΠΟΠΟΙΗΘΗΚΕ - υπάρχει ήδη ένα τηλέφωνο με αυτή την εσωτ.σύνδεση/διακομιστή\n";}
	else
		{
			 if ( (strlen($extension) < 1) or (strlen($server_ip) < 7) or (strlen($dialplan_number) < 1) or (strlen($voicemail_id) < 1) or (strlen($login) < 1)  or (strlen($pass) < 1))
			{echo "<br>ΤΟ ΤΗΛΕΦΩΝΟ ΔΕΝ ΤΡΟΠΟΠΟΙΗΘΗΚΕ - Παρακαλώ ελέγξτε τα δεδομένα που καταχωρήσατε\n";}
		 else
			{
			echo "<br>ΤΟ ΤΗΛΕΦΩΝΟ ΤΡΟΠΟΠΟΙΗΘΗΚΕ: $extension\n";

			$stmt="UPDATE phones set extension='$extension', dialplan_number='$dialplan_number', voicemail_id='$voicemail_id', phone_ip='$phone_ip', computer_ip='$computer_ip', server_ip='$server_ip', login='$login', pass='$pass', status='$status', active='$active', phone_type='$phone_type', fullname='$fullname', company='$company', picture='$picture', protocol='$protocol', local_gmt='$local_gmt', ASTmgrUSERNAME='$ASTmgrUSERNAME', ASTmgrSECRET='$ASTmgrSECRET', login_user='$login_user', login_pass='$login_pass', login_campaign='$login_campaign', park_on_extension='$park_on_extension', conf_on_extension='$conf_on_extension', VICIDIAL_park_on_extension='$VICIDIAL_park_on_extension', VICIDIAL_park_on_filename='$VICIDIAL_park_on_filename', monitor_prefix='$monitor_prefix', recording_exten='$recording_exten', voicemail_exten='$voicemail_exten', voicemail_dump_exten='$voicemail_dump_exten', ext_context='$ext_context', dtmf_send_extension='$dtmf_send_extension', call_out_number_group='$call_out_number_group', client_browser='$client_browser', install_directory='$install_directory', local_web_callerID_URL='" . mysql_real_escape_string($local_web_callerID_URL) . "', VICIDIAL_web_URL='" . mysql_real_escape_string($VICIDIAL_web_URL) . "', AGI_call_logging_enabled='$AGI_call_logging_enabled', user_switching_enabled='$user_switching_enabled', conferencing_enabled='$conferencing_enabled', admin_hangup_enabled='$admin_hangup_enabled', admin_hijack_enabled='$admin_hijack_enabled', admin_monitor_enabled='$admin_monitor_enabled', call_parking_enabled='$call_parking_enabled', updater_check_enabled='$updater_check_enabled', AFLogging_enabled='$AFLogging_enabled', QUEUE_ACTION_enabled='$QUEUE_ACTION_enabled', CallerID_popup_enabled='$CallerID_popup_enabled', voicemail_button_enabled='$voicemail_button_enabled', enable_fast_refresh='$enable_fast_refresh', fast_refresh_rate='$fast_refresh_rate', enable_persistant_mysql='$enable_persistant_mysql', auto_dial_next_number='$auto_dial_next_number', VDstop_rec_after_each_call='$VDstop_rec_after_each_call', DBX_server='$DBX_server', DBX_database='$DBX_database', DBX_user='$DBX_user', DBX_pass='$DBX_pass', DBX_port='$DBX_port', DBY_server='$DBY_server', DBY_database='$DBY_database', DBY_user='$DBY_user', DBY_pass='$DBY_pass', DBY_port='$DBY_port', outbound_cid='$outbound_cid' where extension='$old_extension' and server_ip='$old_server_ip';";
			$rslt=mysql_query($stmt, $link);
			}
		}

	$stmt="SELECT * from phones where extension='$extension' and server_ip='$server_ip';";
	$rslt=mysql_query($stmt, $link);
	$row=mysql_fetch_row($rslt);

echo "<br>ΤΡΟΠΟΠΟΙΗΣΗ ΕΓΓΡΑΦΗΣ ΤΗΛΕΦΩΝΟΥ: $row[1]<form action=$PHP_SELF method=POST>\n";
echo "<input type=hidden name=ADD value=4>\n";
echo "<input type=hidden name=old_extension value=\"$row[0]\">\n";
echo "<input type=hidden name=old_server_ip value=\"$row[5]\">\n";
echo "<center><TABLE width=600 cellspacing=3>\n";
echo "<tr bgcolor=#B6D3FC><td align=right>Τηλ.σύνδεσης τηλεφώνου: </td><td align=left><input type=text name=extension size=20 maxlength=100 value=\"$row[0]\">$NWB#phones-extension$NWE</td></tr>\n";
echo "<tr bgcolor=#B6D3FC><td align=right>Αριθμός Σχεδίου Κλήσεων: </td><td align=left><input type=text name=dialplan_number size=15 maxlength=20 value=\"$row[1]\"> (μόνο αριθμοί)$NWB#phones-dialplan_number$NWE</td></tr>\n";
echo "<tr bgcolor=#B6D3FC><td align=right>Περιεχόμενο Φωνητικού Ταχυδρομείου: </td><td align=left><input type=text name=voicemail_id size=10 maxlength=10 value=\"$row[2]\"> (μόνο αριθμοί)$NWB#phones-voicemail_id$NWE</td></tr>\n";
echo "<tr bgcolor=#B6D3FC><td align=right>Εξερχόμενο CallerID: </td><td align=left><input type=text name=outbound_cid size=10 maxlength=20 value=\"$row[65]\"> (μόνο αριθμοί)$NWB#phones-outbound_cid$NWE</td></tr>\n";
echo "<tr bgcolor=#B6D3FC><td align=right>Δνση IP Τηλεφώνου: </td><td align=left><input type=text name=phone_ip size=20 maxlength=15 value=\"$row[3]\"> (optional)$NWB#phones-phone_ip$NWE</td></tr>\n";
echo "<tr bgcolor=#B6D3FC><td align=right>Δνση IP Υπολογιστή: </td><td align=left><input type=text name=computer_ip size=20 maxlength=15 value=\"$row[4]\"> (optional)$NWB#phones-computer_ip$NWE</td></tr>\n";
echo "<tr bgcolor=#B6D3FC><td align=right>IP Διακομιστή: </td><td align=left><select size=1 name=server_ip>\n";

echo "$servers_list";
echo "<option SELECTED>$row[5]</option>\n";
echo "</select>$NWB#phones-server_ip$NWE</td></tr>\n";
echo "<tr bgcolor=#B6D3FC><td align=right>Σύνδεση:</td><td align=left><input type=text name=login size=10 maxlength=10 value=\"$row[6]\">$NWB#phones-login$NWE</td></tr>\n";
echo "<tr bgcolor=#B6D3FC><td align=right>Κωδικός:</td><td align=left><input type=text name=pass size=10 maxlength=10 value=\"$row[7]\">$NWB#phones-pass$NWE</td></tr>\n";
echo "<tr bgcolor=#B6D3FC><td align=right>Κατάσταση:</td><td align=left><select size=1 name=status><option>ΕΝΕΡΓΑ</option><option>SUSPENDED</option><option>CLOSED</option><option>PENDING</option><option>ADMIN</option><option selected>$row[8]</option></select>$NWB#phones-status$NWE</td></tr>\n";
echo "<tr bgcolor=#B6D3FC><td align=right>Ενεργός Λογαριασμός: </td><td align=left><select size=1 name=active><option>Y</option><option>N</option><option selected>$row[9]</option></select>$NWB#phones-active$NWE</td></tr>\n";
echo "<tr bgcolor=#B6D3FC><td align=right>Τύπος τηλεφώνου: </td><td align=left><input type=text name=phone_type size=20 maxlength=50 value=\"$row[10]\">$NWB#phones-phone_type$NWE</td></tr>\n";
echo "<tr bgcolor=#B6D3FC><td align=right>Πλήρες Ονομα: </td><td align=left><input type=text name=fullname size=20 maxlength=50 value=\"$row[11]\">$NWB#phones-fullname$NWE</td></tr>\n";
echo "<tr bgcolor=#B6D3FC><td align=right>Εταιρία:</td><td align=left><input type=text name=company size=10 maxlength=10 value=\"$row[12]\">$NWB#phones-company$NWE</td></tr>\n";
echo "<tr bgcolor=#B6D3FC><td align=right>Εικόνα:</td><td align=left><input type=text name=picture size=20 maxlength=19 value=\"$row[13]\">$NWB#phones-picture$NWE</td></tr>\n";
echo "<tr bgcolor=#B6D3FC><td align=right>Νέα Μηνύματα: </td><td align=left><b>$row[14]</b>$NWB#phones-messages$NWE</td></tr>\n";
echo "<tr bgcolor=#B6D3FC><td align=right>Παλαιά Μηνύματα: </td><td align=left><b>$row[15]</b>$NWB#phones-old_messages$NWE</td></tr>\n";
echo "<tr bgcolor=#B6D3FC><td align=right>Προτόκολο Πελάτη: </td><td align=left><select size=1 name=protocol><option>SIP</option><option>Zap</option><option>IAX2</option><option>EXTERNAL</option><option selected>$row[16]</option></select>$NWB#phones-protocol$NWE</td></tr>\n";
echo "<tr bgcolor=#B6D3FC><td align=right>Τοπικό GMT: </td><td align=left><select size=1 name=local_gmt><option>12.75</option><option>12.00</option><option>11.00</option><option>10.00</option><option>9.50</option><option>9.00</option><option>8.00</option><option>7.00</option><option>6.50</option><option>6.00</option><option>5.75</option><option>5.50</option><option>5.00</option><option>4.50</option><option>4.00</option><option>3.50</option><option>3.00</option><option>2.00</option><option>1.00</option><option>0.00</option><option>-1.00</option><option>-2.00</option><option>-3.00</option><option>-3.50</option><option>-4.00</option><option>-5.00</option><option>-6.00</option><option>-7.00</option><option>-8.00</option><option>-9.00</option><option>-10.00</option><option>-11.00</option><option>-12.00</option><option selected>$row[17]</option></select> (Μην ρυθμίσεις για DST)$NWB#phones-local_gmt$NWE</td></tr>\n";
echo "<tr bgcolor=#B6D3FC><td align=right>Διαχειριστή Σύνδεση: </td><td align=left><input type=text name=ASTmgrUSERNAME size=20 maxlength=20 value=\"$row[18]\">$NWB#phones-ASTmgrUSERNAME$NWE</td></tr>\n";
echo "<tr bgcolor=#B6D3FC><td align=right>Κωδικός Διαχειριστή: </td><td align=left><input type=text name=ASTmgrSECRET size=20 maxlength=20 value=\"$row[19]\">$NWB#phones-ASTmgrSECRET$NWE</td></tr>\n";
echo "<tr bgcolor=#B6D3FC><td align=right>VICIDIAL Προκαθορισμένος Χρήστης: </td><td align=left><input type=text name=login_user size=20 maxlength=20 value=\"$row[20]\">$NWB#phones-login_user$NWE</td></tr>\n";
echo "<tr bgcolor=#B6D3FC><td align=right>VICIDIAL Προκαθορισμένος Κωδικός: </td><td align=left><input type=text name=login_pass size=20 maxlength=20 value=\"$row[21]\">$NWB#phones-login_pass$NWE</td></tr>\n";
echo "<tr bgcolor=#B6D3FC><td align=right>VICIDIAL Προκαθορισμένη εκστρατεία: </td><td align=left><input type=text name=login_campaign size=10 maxlength=10 value=\"$row[22]\">$NWB#phones-login_campaign$NWE</td></tr>\n";
echo "<tr bgcolor=#B6D3FC><td align=right>Τηλ.σύνδ. Στάθμευσης: </td><td align=left><input type=text name=park_on_extension size=10 maxlength=10 value=\"$row[23]\">$NWB#phones-park_on_extension$NWE</td></tr>\n";
echo "<tr bgcolor=#B6D3FC><td align=right>Τηλ.σύνδ. Συνδ.: </td><td align=left><input type=text name=conf_on_extension size=10 maxlength=10 value=\"$row[24]\">$NWB#phones-conf_on_extension$NWE</td></tr>\n";
echo "<tr bgcolor=#B6D3FC><td align=right>VICIDIAL Τηλ.σύνδ. Στάθμευσης: </td><td align=left><input type=text name=VICIDIAL_park_on_extension size=10 maxlength=10 value=\"$row[25]\">$NWB#phones-VICIDIAL_park_on_extension$NWE</td></tr>\n";
echo "<tr bgcolor=#B6D3FC><td align=right>VICIDIAL Αρχείο Στάθμευσης: </td><td align=left><input type=text name=VICIDIAL_park_on_filename size=10 maxlength=10 value=\"$row[26]\">$NWB#phones-VICIDIAL_park_on_filename$NWE</td></tr>\n";
echo "<tr bgcolor=#B6D3FC><td align=right>Πρόθεμα Παρακολούθησης: </td><td align=left><input type=text name=monitor_prefix size=10 maxlength=10 value=\"$row[27]\">$NWB#phones-monitor_prefix$NWE</td></tr>\n";
echo "<tr bgcolor=#B6D3FC><td align=right>Ηχογράφηση εσωτ.σύνδ.: </td><td align=left><input type=text name=recording_exten size=10 maxlength=10 value=\"$row[28]\">$NWB#phones-recording_exten$NWE</td></tr>\n";
echo "<tr bgcolor=#B6D3FC><td align=right>VMailMain Τηλ.σύνδ.: </td><td align=left><input type=text name=voicemail_exten size=10 maxlength=10 value=\"$row[29]\">$NWB#phones-voicemail_exten$NWE</td></tr>\n";
echo "<tr bgcolor=#B6D3FC><td align=right>VMailDump Τηλ.σύνδ.: </td><td align=left><input type=text name=voicemail_dump_exten size=20 maxlength=20 value=\"$row[30]\">$NWB#phones-voicemail_dump_exten$NWE</td></tr>\n";
echo "<tr bgcolor=#B6D3FC><td align=right>Περιεχόμενο Τηλ.σύνδ: </td><td align=left><input type=text name=ext_context size=20 maxlength=20 value=\"$row[31]\">$NWB#phones-ext_context$NWE</td></tr>\n";
echo "<tr bgcolor=#B6D3FC><td align=right>DTMFSend Κανάλι: </td><td align=left><input type=text name=dtmf_send_extension size=40 maxlength=100 value=\"$row[32]\">$NWB#phones-dtmf_send_extension$NWE</td></tr>\n";
echo "<tr bgcolor=#B6D3FC><td align=right>Ομάδα Εξερχομένων Κλήσεων: </td><td align=left><input type=text name=call_out_number_group size=40 maxlength=100 value=\"$row[33]\">$NWB#phones-call_out_number_group$NWE</td></tr>\n";
echo "<tr bgcolor=#B6D3FC><td align=right>Θέση Φυλλομετρητή: </td><td align=left><input type=text name=client_browser size=40 maxlength=100 value=\"$row[34]\">$NWB#phones-client_browser$NWE</td></tr>\n";
echo "<tr bgcolor=#B6D3FC><td align=right>Κατάλογος εγκατάστασης: </td><td align=left><input type=text name=install_directory size=40 maxlength=100 value=\"$row[35]\">$NWB#phones-install_directory$NWE</td></tr>\n";
echo "<tr bgcolor=#B6D3FC><td align=right>CallerID URL: </td><td align=left><input type=text name=local_web_callerID_URL size=40 maxlength=255 value=\"$row[36]\">$NWB#phones-local_web_callerID_URL$NWE</td></tr>\n";
echo "<tr bgcolor=#B6D3FC><td align=right>VICIDIAL Προκαθορισμένο URL: </td><td align=left><input type=text name=VICIDIAL_web_URL size=40 maxlength=255 value=\"$row[37]\">$NWB#phones-VICIDIAL_web_URL$NWE</td></tr>\n";
echo "<tr bgcolor=#B6D3FC><td align=right>Καταγραφή Γεγονότος Κλήσης: </td><td align=left><select size=1 name=AGI_call_logging_enabled><option>1</option><option>0</option><option selected>$row[38]</option></select>$NWB#phones-AGI_call_logging_enabled$NWE</td></tr>\n";
echo "<tr bgcolor=#B6D3FC><td align=right>Μεταγωγή Χρήστη: </td><td align=left><select size=1 name=user_switching_enabled><option>1</option><option>0</option><option selected>$row[39]</option></select>$NWB#phones-user_switching_enabled$NWE</td></tr>\n";
echo "<tr bgcolor=#B6D3FC><td align=right>Σε συνδιαλέξη: </td><td align=left><select size=1 name=conferencing_enabled><option>1</option><option>0</option><option selected>$row[40]</option></select>$NWB#phones-conferencing_enabled$NWE</td></tr>\n";
echo "<tr bgcolor=#B6D3FC><td align=right>Διαχειριστού Κλείσιμο: </td><td align=left><select size=1 name=admin_hangup_enabled><option>1</option><option>0</option><option selected>$row[41]</option></select>$NWB#phones-admin_hangup_enabled$NWE</td></tr>\n";
echo "<tr bgcolor=#B6D3FC><td align=right>Διαχειριστού Κλέψιμο: </td><td align=left><select size=1 name=admin_hijack_enabled><option>1</option><option>0</option><option selected>$row[42]</option></select>$NWB#phones-admin_hijack_enabled$NWE</td></tr>\n";
echo "<tr bgcolor=#B6D3FC><td align=right>Διαχειριστού Παρακολούθηση: </td><td align=left><select size=1 name=admin_monitor_enabled><option>1</option><option>0</option><option selected>$row[43]</option></select>$NWB#phones-admin_monitor_enabled$NWE</td></tr>\n";
echo "<tr bgcolor=#B6D3FC><td align=right>Στάθμευση Κλήσης: </td><td align=left><select size=1 name=call_parking_enabled><option>1</option><option>0</option><option selected>$row[44]</option></select>$NWB#phones-call_parking_enabled$NWE</td></tr>\n";
echo "<tr bgcolor=#B6D3FC><td align=right>Ελεγχος ενημερωτή: </td><td align=left><select size=1 name=updater_check_enabled><option>1</option><option>0</option><option selected>$row[45]</option></select>$NWB#phones-updater_check_enabled$NWE</td></tr>\n";
echo "<tr bgcolor=#B6D3FC><td align=right>AF Καταγραφή Γεγονότος: </td><td align=left><select size=1 name=AFLogging_enabled><option>1</option><option>0</option><option selected>$row[46]</option></select>$NWB#phones-AFLogging_enabled$NWE</td></tr>\n";
echo "<tr bgcolor=#B6D3FC><td align=right>Ενεργή Ουρά: </td><td align=left><select size=1 name=QUEUE_ACTION_enabled><option>1</option><option>0</option><option selected>$row[47]</option></select>$NWB#phones-QUEUE_ACTION_enabled$NWE</td></tr>\n";
echo "<tr bgcolor=#B6D3FC><td align=right>Υπερεμφανιζόμενο παραθύρο CallerID: </td><td align=left><select size=1 name=CallerID_popup_enabled><option>1</option><option>0</option><option selected>$row[48]</option></select>$NWB#phones-CallerID_popup_enabled$NWE</td></tr>\n";
echo "<tr bgcolor=#B6D3FC><td align=right>Πλήκτρο VMail: </td><td align=left><select size=1 name=voicemail_button_enabled><option>1</option><option>0</option><option selected>$row[49]</option></select>$NWB#phones-voicemail_button_enabled$NWE</td></tr>\n";
echo "<tr bgcolor=#B6D3FC><td align=right>Ταχύτητα Ανανέωσης: </td><td align=left><select size=1 name=enable_fast_refresh><option>1</option><option>0</option><option selected>$row[50]</option></select>$NWB#phones-enable_fast_refresh$NWE</td></tr>\n";
echo "<tr bgcolor=#B6D3FC><td align=right>Ρυθμός Ανανέωσης Ταχύτητας: </td><td align=left><input type=text size=5 name=fast_refresh_rate value=\"$row[51]\">(in ms)$NWB#phones-fast_refresh_rate$NWE</td></tr>\n";
echo "<tr bgcolor=#B6D3FC><td align=right>Συνεχής MySQL: </td><td align=left><select size=1 name=enable_persistant_mysql><option>1</option><option>0</option><option selected>$row[52]</option></select>$NWB#phones-enable_persistant_mysql$NWE</td></tr>\n";
echo "<tr bgcolor=#B6D3FC><td align=right>Αυτόματη Κλήση Επόμενου Αριθμού: </td><td align=left><select size=1 name=auto_dial_next_number><option>1</option><option>0</option><option selected>$row[53]</option></select>$NWB#phones-auto_dial_next_number$NWE</td></tr>\n";
echo "<tr bgcolor=#B6D3FC><td align=right>Σταμάτα την ηχογράφηση μετά από κάθε κλήση: </td><td align=left><select size=1 name=VDstop_rec_after_each_call><option>1</option><option>0</option><option selected>$row[54]</option></select>$NWB#phones-VDstop_rec_after_each_call$NWE</td></tr>\n";
echo "<tr bgcolor=#B6D3FC><td align=right>DBX Διακομιστής: </td><td align=left><input type=text name=DBX_server size=15 maxlength=15 value=\"$row[55]\"> (Πρωταρχικό DB Server)$NWB#phones-DBX_server$NWE</td></tr>\n";
echo "<tr bgcolor=#B6D3FC><td align=right>DBX Βάση Δεδομένων: </td><td align=left><input type=text name=DBX_database size=15 maxlength=15 value=\"$row[56]\"> (Πρωταρχικό Server Database)$NWB#phones-DBX_database$NWE</td></tr>\n";
echo "<tr bgcolor=#B6D3FC><td align=right>DBX Χρήστης: </td><td align=left><input type=text name=DBX_user size=15 maxlength=15 value=\"$row[57]\"> (Πρωταρχικό DB Login)$NWB#phones-DBX_user$NWE</td></tr>\n";
echo "<tr bgcolor=#B6D3FC><td align=right>DBX Κωδικός: </td><td align=left><input type=text name=DBX_pass size=15 maxlength=15 value=\"$row[58]\"> (Πρωταρχικό DB Secret)$NWB#phones-DBX_pass$NWE</td></tr>\n";
echo "<tr bgcolor=#B6D3FC><td align=right>DBX Πόρτα: </td><td align=left><input type=text name=DBX_port size=6 maxlength=6 value=\"$row[59]\"> (Πρωταρχικό DB Port)$NWB#phones-DBX_port$NWE</td></tr>\n";
echo "<tr bgcolor=#B6D3FC><td align=right>DBY Διακομιστής: </td><td align=left><input type=text name=DBY_server size=15 maxlength=15 value=\"$row[60]\"> (ΔευτερεύονDB Server)$NWB#phones-DBY_server$NWE</td></tr>\n";
echo "<tr bgcolor=#B6D3FC><td align=right>DBY Βάση Δεδομένων: </td><td align=left><input type=text name=DBY_database size=15 maxlength=15 value=\"$row[61]\"> (ΔευτερεύονServer Database)$NWB#phones-DBY_database$NWE</td></tr>\n";
echo "<tr bgcolor=#B6D3FC><td align=right>DBY Χρήστης: </td><td align=left><input type=text name=DBY_user size=15 maxlength=15 value=\"$row[62]\"> (ΔευτερεύονDB Login)$NWB#phones-DBY_user$NWE</td></tr>\n";
echo "<tr bgcolor=#B6D3FC><td align=right>DBY Κωδικός: </td><td align=left><input type=text name=DBY_pass size=15 maxlength=15 value=\"$row[63]\"> (ΔευτερεύονDB Secret)$NWB#phones-DBY_pass$NWE</td></tr>\n";
echo "<tr bgcolor=#B6D3FC><td align=right>DBY Πόρτα: </td><td align=left><input type=text name=DBY_port size=6 maxlength=6 value=\"$row[64]\"> (ΔευτερεύονDB Port)$NWB#phones-DBY_port$NWE</td></tr>\n";
echo "<tr bgcolor=#B6D3FC><td align=center colspan=2><input type=submit name=submit VALUE=ΥΠΟΒΑΛΛΩ></td></tr>\n";
echo "</TABLE></center>\n";

echo "<br><br><a href=\"./phone_stats.php?extension=$row[0]&server_ip=$row[5]\">Επιλέξτε εδώ για στατιστικά τηλεφώνου</a>\n";

if ($LOGdelete_phones > 0)
	{
	echo "<br><br><a href=\"$PHP_SELF?ADD=5&extension=$extension&server_ip=$server_ip\">ΔΙΑΓΡΑΨΕ ΑΥΤΟ ΤΟ ΤΗΛΕΦΩΝΟ</a>\n";
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
		{echo "<br>ΔΙΑΚΟΜΙΣΤΗΣ NOT MODIFIED - there is already a server in the system with this server_id\n";}
	else
		{
		$stmt="SELECT count(*) from servers where server_ip='$server_ip';";
		$rslt=mysql_query($stmt, $link);
		$row=mysql_fetch_row($rslt);
		if ( ($row[0] > 0) && ($server_ip != $old_server_ip) )
			{echo "<br>Ο ΔΙΑΚΟΜΙΣΤΗΣ ΔΕΝ ΤΡΟΠΟΠΟΙΗΘΗΚΕ - υπάρχει ήδη ένας διακομιστής με αυτό το IP\n";}
		else
			{
			 if ( (strlen($server_id) < 1) or (strlen($server_ip) < 7) )
				{echo "<br>Ο ΔΙΑΚΟΜΙΣΤΗΣ ΔΕΝ ΤΡΟΠΟΠΟΙΗΘΗΚΕ - Παρακαλώ ελέγξτε τα δεδομένα που καταχωρήσατε\n";}
			 else
				{
				echo "<br>Ο ΔΙΑΚΟΜΙΣΤΗΣ ΤΡΟΠΟΠΟΙΗΘΗΚΕ: $server_ip\n";

				$stmt="UPDATE servers set server_id='$server_id',server_description='$server_description',server_ip='$server_ip',active='$active',asterisk_version='$asterisk_version', max_vicidial_trunks='$max_vicidial_trunks', telnet_host='$telnet_host', telnet_port='$telnet_port', ASTmgrUSERNAME='$ASTmgrUSERNAME', ASTmgrSECRET='$ASTmgrSECRET', ASTmgrUSERNAMEupdate='$ASTmgrUSERNAMEupdate', ASTmgrUSERNAMElisten='$ASTmgrUSERNAMElisten', ASTmgrUSERNAMEsend='$ASTmgrUSERNAMEsend', local_gmt='$local_gmt', voicemail_dump_exten='$voicemail_dump_exten', answer_transfer_agent='$answer_transfer_agent', ext_context='$ext_context', sys_perf_log='$sys_perf_log', vd_server_logs='$vd_server_logs', agi_output='$agi_output' where server_id='$old_server_id';";
				$rslt=mysql_query($stmt, $link);
				}
			}
		}

	$stmt="SELECT * from servers where server_id='$server_id';";
	$rslt=mysql_query($stmt, $link);
	$row=mysql_fetch_row($rslt);

echo "<br>ΤΡΟΠΟΠΟΙΗΣΗ ΕΓΓΡΑΦΗΣ ΔΙΑΚΟΜΙΣΤΗ: $row[0]<form action=$PHP_SELF method=POST>\n";
echo "<input type=hidden name=ADD value=41>\n";
echo "<input type=hidden name=old_server_id value=\"$server_id\">\n";
echo "<input type=hidden name=old_server_ip value=\"$row[2]\">\n";
echo "<center><TABLE width=600 cellspacing=3>\n";
echo "<tr bgcolor=#B6D3FC><td align=right>ID Διακομιστή: </td><td align=left><input type=text name=server_id size=10 maxlength=10 value=\"$row[0]\">$NWB#servers-server_id$NWE</td></tr>\n";
echo "<tr bgcolor=#B6D3FC><td align=right>Περιγραφή Διακομιστή: </td><td align=left><input type=text name=server_description size=30 maxlength=255 value=\"$row[1]\">$NWB#servers-server_description$NWE</td></tr>\n";
echo "<tr bgcolor=#B6D3FC><td align=right>Δνση IP Διακομιστή: </td><td align=left><input type=text name=server_ip size=20 maxlength=15 value=\"$row[2]\">$NWB#servers-server_ip$NWE</td></tr>\n";
echo "<tr bgcolor=#B6D3FC><td align=right>Ενεργή:</td><td align=left><select size=1 name=active><option>Y</option><option>N</option><option selected>$row[3]</option></select>$NWB#servers-active$NWE</td></tr>\n";
echo "<tr bgcolor=#B6D3FC><td align=right>Εκδοση Asterisk: </td><td align=left><input type=text name=asterisk_version size=20 maxlength=20 value=\"$row[4]\">$NWB#servers-asterisk_version$NWE</td></tr>\n";
echo "<tr bgcolor=#B6D3FC><td align=right>Μέγιστος Αριθμός Trunk: </td><td align=left><input type=text name=max_vicidial_trunks size=5 maxlength=4 value=\"$row[5]\">$NWB#servers-max_vicidial_trunks$NWE</td></tr>\n";
echo "<tr bgcolor=#B6D3FC><td align=right>Λήπτης Telnet: </td><td align=left><input type=text name=telnet_host size=20 maxlength=20 value=\"$row[6]\">$NWB#servers-telnet_host$NWE</td></tr>\n";
echo "<tr bgcolor=#B6D3FC><td align=right>Πόρτα Telnet: </td><td align=left><input type=text name=telnet_port size=6 maxlength=5 value=\"$row[7]\">$NWB#servers-telnet_port$NWE</td></tr>\n";
echo "<tr bgcolor=#B6D3FC><td align=right>Χρήστη Διαχειριστή: </td><td align=left><input type=text name=ASTmgrUSERNAME size=20 maxlength=20 value=\"$row[8]\">$NWB#servers-ASTmgrUSERNAME$NWE</td></tr>\n";
echo "<tr bgcolor=#B6D3FC><td align=right>Κωδικός Διαχειριστή: </td><td align=left><input type=text name=ASTmgrSECRET size=20 maxlength=20 value=\"$row[9]\">$NWB#servers-ASTmgrSECRET$NWE</td></tr>\n";
echo "<tr bgcolor=#B6D3FC><td align=right>Ενημέρωση Χρήστη Διαχειριστή: </td><td align=left><input type=text name=ASTmgrUSERNAMEupdate size=20 maxlength=20 value=\"$row[10]\">$NWB#servers-ASTmgrUSERNAMEupdate$NWE</td></tr>\n";
echo "<tr bgcolor=#B6D3FC><td align=right>Παρακολούθηση Χρήστη Διαχειριστή: </td><td align=left><input type=text name=ASTmgrUSERNAMElisten size=20 maxlength=20 value=\"$row[11]\">$NWB#servers-ASTmgrUSERNAMElisten$NWE</td></tr>\n";
echo "<tr bgcolor=#B6D3FC><td align=right>Αποστολή Χρήστη Διαχειριστή: </td><td align=left><input type=text name=ASTmgrUSERNAMEsend size=20 maxlength=20 value=\"$row[12]\">$NWB#servers-ASTmgrUSERNAMEsend$NWE</td></tr>\n";
echo "<tr bgcolor=#B6D3FC><td align=right>Τοπικό GMT: </td><td align=left><select size=1 name=local_gmt><option>12.75</option><option>12.00</option><option>11.00</option><option>10.00</option><option>9.50</option><option>9.00</option><option>8.00</option><option>7.00</option><option>6.50</option><option>6.00</option><option>5.75</option><option>5.50</option><option>5.00</option><option>4.50</option><option>4.00</option><option>3.50</option><option>3.00</option><option>2.00</option><option>1.00</option><option>0.00</option><option>-1.00</option><option>-2.00</option><option>-3.00</option><option>-3.50</option><option>-4.00</option><option>-5.00</option><option>-6.00</option><option>-7.00</option><option>-8.00</option><option>-9.00</option><option>-10.00</option><option>-11.00</option><option>-12.00</option><option selected>$row[13]</option></select> (Μην ρυθμίσεις για DST)$NWB#servers-local_gmt$NWE</td></tr>\n";
echo "<tr bgcolor=#B6D3FC><td align=right>VMail εσωτ.σύνδεση απόρριψης: </td><td align=left><input type=text name=voicemail_dump_exten size=20 maxlength=20 value=\"$row[14]\">$NWB#servers-voicemail_dump_exten$NWE</td></tr>\n";
echo "<tr bgcolor=#B6D3FC><td align=right>AD εσωτ.σύνδεση: </td><td align=left><input type=text name=answer_transfer_agent size=20 maxlength=20 value=\"$row[15]\">$NWB#servers-answer_transfer_agent$NWE</td></tr>\n";
echo "<tr bgcolor=#B6D3FC><td align=right>Προκαθορισμένο Περιεχόμενο: </td><td align=left><input type=text name=ext_context size=20 maxlength=20 value=\"$row[16]\">$NWB#servers-ext_context$NWE</td></tr>\n";
echo "<tr bgcolor=#B6D3FC><td align=right>System Performance: </td><td align=left><select size=1 name=sys_perf_log><option>Y</option><option>N</option><option selected>$row[17]</option></select>$NWB#servers-sys_perf_log$NWE</td></tr>\n";
echo "<tr bgcolor=#B6D3FC><td align=right>Server Logs: </td><td align=left><select size=1 name=vd_server_logs><option>Y</option><option>N</option><option selected>$row[18]</option></select>$NWB#servers-vd_server_logs$NWE</td></tr>\n";
echo "<tr bgcolor=#B6D3FC><td align=right>AGI Output: </td><td align=left><select size=1 name=agi_output><option>NONE</option><option>STDERR</option><option>FILE</option><option>BOTH</option><option selected>$row[19]</option></select>$NWB#servers-agi_output$NWE</td></tr>\n";
echo "<tr bgcolor=#B6D3FC><td align=center colspan=2><input type=submit name=submit VALUE=ΥΠΟΒΑΛΛΩ></td></tr>\n";
echo "</TABLE></center>\n";

echo "<center>\n";
echo "<br><b>ΤΗΛΕΦΩΝΑ ΣΤΟΝ ΔΙΑΚΟΜΙΣΤΗ:</b><br>\n";
echo "<TABLE width=400 cellspacing=3>\n";
echo "<tr><td>ΤΗΛ.ΣΥΝΔΕΣΗ</td><td>ΟΝΟΜΑ</td><td>ΕΝΕΡΓΑ</td></tr>\n";

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
echo "Αυτός ο διακομιστής έχει $active_lists ενεργά τηλέφωνα και $inactive_lists μη ενεργά τηλέφωνα<br><br>\n";
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
		{echo "<br>Η ΣΥΝΔΙΑΛΕΞΗ ΔΕΝ ΤΡΟΠΟΠΟΙΗΘΗΚΕ - υπάρχει ήδη μία συνδιάλεξη με αυτή την εσωτ.σύνδεση-διακομιστή\n";}
	else
		{
		 if ( (strlen($conf_exten) < 1) or (strlen($server_ip) < 7) )
			{echo "<br>Η ΣΥΝΔΙΑΛΕΞΗ ΔΕΝ ΤΡΟΠΟΠΟΙΗΘΗΚΕ - Παρακαλώ ελέγξτε τα δεδομένα που καταχωρήσατε\n";}
		 else
			{
			echo "<br>Η ΣΥΝΔΙΑΛΕΞΗ ΤΡΟΠΟΠΟΙΗΘΗΚΕ: $conf_exten\n";

			$stmt="UPDATE conferences set conf_exten='$conf_exten',server_ip='$server_ip',extension='$extension' where conf_exten='$old_conf_exten';";
			$rslt=mysql_query($stmt, $link);
			}
		}

	$stmt="SELECT * from conferences where conf_exten='$conf_exten';";
	$rslt=mysql_query($stmt, $link);
	$row=mysql_fetch_row($rslt);

echo "<br>ΤΡΟΠΟΠΟΙΗΣΗ ΕΓΓΡΑΦΗΣ ΣΥΝΔΙΑΛΕΞΗΣ: $row[0]<form action=$PHP_SELF method=POST>\n";
echo "<input type=hidden name=ADD value=411>\n";
echo "<input type=hidden name=old_conf_exten value=\"$row[0]\">\n";
echo "<input type=hidden name=old_server_ip value=\"$row[1]\">\n";
echo "<center><TABLE width=600 cellspacing=3>\n";
echo "<tr bgcolor=#B6D3FC><td align=right>Συνδιαλέξη:</td><td align=left><input type=text name=conf_exten size=10 maxlength=7 value=\"$row[0]\">$NWB#conferences-conf_exten$NWE</td></tr>\n";
echo "<tr bgcolor=#B6D3FC><td align=right>IP Διακομιστή: </td><td align=left><select size=1 name=server_ip>\n";

echo "$servers_list";
echo "<option SELECTED>$row[1]</option>\n";
echo "</select>$NWB#conferences-server_ip$NWE</td></tr>\n";
echo "<tr bgcolor=#B6D3FC><td align=right>Ισχύουσα εσωτ.σύνδεση: </td><td align=left><input type=text name=extension size=20 maxlength=20 value=\"$row[2]\"></td></tr>\n";
echo "<tr bgcolor=#B6D3FC><td align=center colspan=2><input type=submit name=submit VALUE=ΥΠΟΒΑΛΛΩ></td></tr>\n";
echo "</TABLE></center>\n";

echo "<center><b>\n";

}







######################
# ADD=55 search form
######################

if ($ADD==55)
{
echo "<FONT FACE=\"ARIAL,HELVETICA\" COLOR=BLACK SIZE=2>";

echo "<br>ΑΝΑΖΗΤΗΣΗ ΤΗΛΕΦΩΝΟΥ<form action=$PHP_SELF method=POST>\n";
echo "<input type=hidden name=ADD value=66>\n";
echo "<center><TABLE width=600 cellspacing=3>\n";
echo "<tr bgcolor=#B6D3FC><td align=right>Εσωτ.σύνδεση:</td><td align=left><input type=text name=extension size=10 maxlength=10></td></tr>\n";
echo "<tr bgcolor=#B6D3FC><td align=right>Πλήρες Ονομα: </td><td align=left><input type=text name=fullname size=30 maxlength=30></td></tr>\n";
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

echo "<br>ΑΝΑΖΗΤΗΣΗ ΑΠΟΤΕΛΕΣΜΑΤΩΝ:\n";
echo "<center><TABLE width=600 cellspacing=0 cellpadding=1>\n";

	$o=0;
	while ($phones_to_print > $o) {
		$row=mysql_fetch_row($rslt);
		if (eregi("1$|3$|5$|7$|9$", $o))
			{$bgcolor='bgcolor="#B9CBFD"';} 
		else
			{$bgcolor='bgcolor="#9BB9FB"';}
		echo "<tr $bgcolor><td><font size=1>$row[0]</td><td><font size=1>$row[5]</td><td><font size=1>$row[1]</td><td><font size=1>$row[2]</td><td><font size=1>$row[8]</td><td><font size=1>$row[11]</td><td><font size=1>$row[14]</td><td><font size=1>$row[15]</td>";
		echo "<td><font size=1><a href=\"$PHP_SELF?ADD=3&extension=$row[0]&server_ip=$row[5]\">ΤΡΟΠΟΠΟΙΗΣΗ</a> | <a href=\"./phone_stats.php?extension=$row[0]&server_ip=$row[5]\">ΣΤΑΤΙΣΤΙΚΑ</a></td></tr>\n";
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

echo "<br>ΕΝΤΑΓΜΕΝΑ ΤΗΛΕΦΩΝΑ:\n";
echo "<center><TABLE width=600 cellspacing=0 cellpadding=1>\n";

	$o=0;
	while ($phones_to_print > $o) {
		$row=mysql_fetch_row($rslt);
		if (eregi("1$|3$|5$|7$|9$", $o))
			{$bgcolor='bgcolor="#B9CBFD"';} 
		else
			{$bgcolor='bgcolor="#9BB9FB"';}
		echo "<tr $bgcolor><td><font size=1>$row[0]</td><td><font size=1>$row[16]</td><td><font size=1>$row[5]</td><td><font size=1>$row[1]</td><td><font size=1>$row[2]</td><td><font size=1>$row[8]</td><td><font size=1>$row[11]</td><td><font size=1>$row[14]</td><td><font size=1>$row[15]</td>";
		echo "<td><font size=1><a href=\"$PHP_SELF?ADD=3&extension=$row[0]&server_ip=$row[5]\">ΤΡΟΠΟΠΟΙΗΣΗ</a> | <a href=\"./phone_stats.php?extension=$row[0]&server_ip=$row[5]\">ΣΤΑΤΙΣΤΙΚΑ</a></td></tr>\n";
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

echo "<br>ΕΝΤΑΓΜΕΝΟΙ ΔΙΑΚΟΜΙΣΤΕΣ:\n";
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
		echo "<td><font size=1><a href=\"$PHP_SELF?ADD=31&server_id=$row[0]\">ΤΡΟΠΟΠΟΙΗΣΗ</a></td></tr>\n";
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

echo "<br>ΕΝΤΑΓΜΕΝΕΣ ΣΥΝΔΙΑΛΕΞΕΙΣ:\n";
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
		echo "<td><font size=1><a href=\"$PHP_SELF?ADD=311&conf_exten=$row[0]&server_ip=$row[1]\">ΤΡΟΠΟΠΟΙΗΣΗ</a></td></tr>\n";
		$o++;
	}

echo "</TABLE></center>\n";
}



$ENDtime = date("U");

$RUNtime = ($ENDtime - $STARTtime);

echo "\n\n\n<br><br><br>\n\n";


echo "<font size=0>\n\n\n<br><br><br>\nχρόνος εκτέλεσης διαδικασίας: $RUNtime seconds";
echo " &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; ΕΚΔΟΣΗ: $version";
echo " &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; ΔΗΜΙΟΥΡΓΙΑ: $build</font>\n";


?>


</TD></TR><TABLE>
</body>
</html>

<?
	
exit; 



?>





