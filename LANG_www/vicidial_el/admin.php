<?
# admin.php - VICIDIAL administration page
# 
# 
# Copyright (C) 2007  Matt Florell <vicidial@gmail.com>    LICENSE: GPLv2
#


require("dbconnect.php");

$page_width='750';
$section_width='700';
$header_font_size='3';
$subheader_font_size='2';
$header_selected_bold='<b>';
$header_nonselected_bold='';
$users_color =		'#FFFF99';
$campaigns_color =	'#FFCC99';
$lists_color =		'#FFCCCC';
$ingroups_color =	'#CC99FF';
$remoteagent_color ='#CCFFCC';
$usergroups_color =	'#CCFFFF';
$scripts_color =	'#99FFCC';
$filters_color =	'#CCCCCC';
$admin_color =		'#FF99FF';
$reports_color =	'#99FF33';
#$users_color =		'#FFFF99';
#$campaigns_color =	'#FFFF99';
#$lists_color =		'#FFFF99';
#$ingroups_color =	'#FFFF99';
#$remoteagent_color ='#FFFF99';
#$usergroups_color =	'#FFFF99';
#$scripts_color =	'#FFFF99';
#$filters_color =	'#FFFF99';
#$admin_color =		'#FFFF99';
#$reports_color =	'#FFFF99';
	$times_color =		'#CCCC00';
	$phones_color =		'#CCCC00';
	$conference_color =	'#CCCC00';
	$server_color =		'#CCCC00';
	$settings_color = 	'#CCCC00';
$users_font =		'BLACK';
$campaigns_font =	'BLACK';
$lists_font =		'BLACK';
$ingroups_font =	'BLACK';
$remoteagent_font =	'BLACK';
$usergroups_font =	'BLACK';
$scripts_font =		'BLACK';
$filters_font =		'BLACK';
$admin_font =		'BLACK';
$reports_font =		'BLACK';
	$times_font =		'BLACK';
	$phones_font =		'BLACK';
	$conference_font =	'BLACK';
	$server_font =		'BLACK';
	$settings_font = 	'BLACK';

$PHP_AUTH_USER=$_SERVER['PHP_AUTH_USER'];
$PHP_AUTH_PW=$_SERVER['PHP_AUTH_PW'];
$PHP_SELF=$_SERVER['PHP_SELF'];

if (isset($_GET["DB"]))				{$DB=$_GET["DB"];}
	elseif (isset($_POST["DB"]))	{$DB=$_POST["DB"];}
if (isset($_GET["active"]))	{$active=$_GET["active"];}
	elseif (isset($_POST["active"]))	{$active=$_POST["active"];}
if (isset($_GET["adaptive_dl_diff_target"]))	{$adaptive_dl_diff_target=$_GET["adaptive_dl_diff_target"];}
	elseif (isset($_POST["adaptive_dl_diff_target"]))	{$adaptive_dl_diff_target=$_POST["adaptive_dl_diff_target"];}
if (isset($_GET["adaptive_dropped_percentage"]))	{$adaptive_dropped_percentage=$_GET["adaptive_dropped_percentage"];}
	elseif (isset($_POST["adaptive_dropped_percentage"])){$adaptive_dropped_percentage=$_POST["adaptive_dropped_percentage"];}
if (isset($_GET["adaptive_intensity"]))	{$adaptive_intensity=$_GET["adaptive_intensity"];}
	elseif (isset($_POST["adaptive_intensity"]))	{$adaptive_intensity=$_POST["adaptive_intensity"];}
if (isset($_GET["adaptive_latest_server_time"]))	{$adaptive_latest_server_time=$_GET["adaptive_latest_server_time"];}
	elseif (isset($_POST["adaptive_latest_server_time"])){$adaptive_latest_server_time=$_POST["adaptive_latest_server_time"];}
if (isset($_GET["adaptive_maximum_level"]))	{$adaptive_maximum_level=$_GET["adaptive_maximum_level"];}
	elseif (isset($_POST["adaptive_maximum_level"]))	{$adaptive_maximum_level=$_POST["adaptive_maximum_level"];}
if (isset($_GET["ADD"]))	{$ADD=$_GET["ADD"];}
	elseif (isset($_POST["ADD"]))	{$ADD=$_POST["ADD"];}
if (isset($_GET["admin_hangup_enabled"]))	{$admin_hangup_enabled=$_GET["admin_hangup_enabled"];}
	elseif (isset($_POST["admin_hangup_enabled"]))	{$admin_hangup_enabled=$_POST["admin_hangup_enabled"];}
if (isset($_GET["admin_hijack_enabled"]))	{$admin_hijack_enabled=$_GET["admin_hijack_enabled"];}
	elseif (isset($_POST["admin_hijack_enabled"]))	{$admin_hijack_enabled=$_POST["admin_hijack_enabled"];}
if (isset($_GET["admin_monitor_enabled"]))	{$admin_monitor_enabled=$_GET["admin_monitor_enabled"];}
	elseif (isset($_POST["admin_monitor_enabled"]))	{$admin_monitor_enabled=$_POST["admin_monitor_enabled"];}
if (isset($_GET["AFLogging_enabled"]))	{$AFLogging_enabled=$_GET["AFLogging_enabled"];}
	elseif (isset($_POST["AFLogging_enabled"]))	{$AFLogging_enabled=$_POST["AFLogging_enabled"];}
if (isset($_GET["agent_choose_ingroups"]))	{$agent_choose_ingroups=$_GET["agent_choose_ingroups"];}
	elseif (isset($_POST["agent_choose_ingroups"]))	{$agent_choose_ingroups=$_POST["agent_choose_ingroups"];}
if (isset($_GET["agentcall_manual"]))	{$agentcall_manual=$_GET["agentcall_manual"];}
	elseif (isset($_POST["agentcall_manual"]))	{$agentcall_manual=$_POST["agentcall_manual"];}
if (isset($_GET["agentonly_callbacks"]))	{$agentonly_callbacks=$_GET["agentonly_callbacks"];}
	elseif (isset($_POST["agentonly_callbacks"]))	{$agentonly_callbacks=$_POST["agentonly_callbacks"];}
if (isset($_GET["AGI_call_logging_enabled"]))	{$AGI_call_logging_enabled=$_GET["AGI_call_logging_enabled"];}
	elseif (isset($_POST["AGI_call_logging_enabled"]))	{$AGI_call_logging_enabled=$_POST["AGI_call_logging_enabled"];}
if (isset($_GET["agi_output"]))	{$agi_output=$_GET["agi_output"];}
	elseif (isset($_POST["agi_output"]))	{$agi_output=$_POST["agi_output"];}
if (isset($_GET["allcalls_delay"]))	{$allcalls_delay=$_GET["allcalls_delay"];}
	elseif (isset($_POST["allcalls_delay"]))	{$allcalls_delay=$_POST["allcalls_delay"];}
if (isset($_GET["allow_closers"]))	{$allow_closers=$_GET["allow_closers"];}
	elseif (isset($_POST["allow_closers"]))	{$allow_closers=$_POST["allow_closers"];}
if (isset($_GET["alt_number_dialing"]))	{$alt_number_dialing=$_GET["alt_number_dialing"];}
	elseif (isset($_POST["alt_number_dialing"]))	{$alt_number_dialing=$_POST["alt_number_dialing"];}
if (isset($_GET["alter_agent_interface_options"]))	{$alter_agent_interface_options=$_GET["alter_agent_interface_options"];}
	elseif (isset($_POST["alter_agent_interface_options"]))	{$alter_agent_interface_options=$_POST["alter_agent_interface_options"];}
if (isset($_GET["am_message_exten"]))	{$am_message_exten=$_GET["am_message_exten"];}
	elseif (isset($_POST["am_message_exten"]))	{$am_message_exten=$_POST["am_message_exten"];}
if (isset($_GET["amd_send_to_vmx"]))	{$amd_send_to_vmx=$_GET["amd_send_to_vmx"];}
	elseif (isset($_POST["amd_send_to_vmx"]))	{$amd_send_to_vmx=$_POST["amd_send_to_vmx"];}
if (isset($_GET["answer_transfer_agent"]))	{$answer_transfer_agent=$_GET["answer_transfer_agent"];}
	elseif (isset($_POST["answer_transfer_agent"]))	{$answer_transfer_agent=$_POST["answer_transfer_agent"];}
if (isset($_GET["ast_admin_access"]))	{$ast_admin_access=$_GET["ast_admin_access"];}
	elseif (isset($_POST["ast_admin_access"]))	{$ast_admin_access=$_POST["ast_admin_access"];}
if (isset($_GET["ast_delete_phones"]))	{$ast_delete_phones=$_GET["ast_delete_phones"];}
	elseif (isset($_POST["ast_delete_phones"]))	{$ast_delete_phones=$_POST["ast_delete_phones"];}
if (isset($_GET["asterisk_version"]))	{$asterisk_version=$_GET["asterisk_version"];}
	elseif (isset($_POST["asterisk_version"]))	{$asterisk_version=$_POST["asterisk_version"];}
if (isset($_GET["ASTmgrSECRET"]))	{$ASTmgrSECRET=$_GET["ASTmgrSECRET"];}
	elseif (isset($_POST["ASTmgrSECRET"]))	{$ASTmgrSECRET=$_POST["ASTmgrSECRET"];}
if (isset($_GET["ASTmgrUSERNAME"]))	{$ASTmgrUSERNAME=$_GET["ASTmgrUSERNAME"];}
	elseif (isset($_POST["ASTmgrUSERNAME"]))	{$ASTmgrUSERNAME=$_POST["ASTmgrUSERNAME"];}
if (isset($_GET["ASTmgrUSERNAMElisten"]))	{$ASTmgrUSERNAMElisten=$_GET["ASTmgrUSERNAMElisten"];}
	elseif (isset($_POST["ASTmgrUSERNAMElisten"]))	{$ASTmgrUSERNAMElisten=$_POST["ASTmgrUSERNAMElisten"];}
if (isset($_GET["ASTmgrUSERNAMEsend"]))	{$ASTmgrUSERNAMEsend=$_GET["ASTmgrUSERNAMEsend"];}
	elseif (isset($_POST["ASTmgrUSERNAMEsend"]))	{$ASTmgrUSERNAMEsend=$_POST["ASTmgrUSERNAMEsend"];}
if (isset($_GET["ASTmgrUSERNAMEupdate"]))	{$ASTmgrUSERNAMEupdate=$_GET["ASTmgrUSERNAMEupdate"];}
	elseif (isset($_POST["ASTmgrUSERNAMEupdate"]))	{$ASTmgrUSERNAMEupdate=$_POST["ASTmgrUSERNAMEupdate"];}
if (isset($_GET["attempt_delay"]))	{$attempt_delay=$_GET["attempt_delay"];}
	elseif (isset($_POST["attempt_delay"]))	{$attempt_delay=$_POST["attempt_delay"];}
if (isset($_GET["attempt_maximum"]))	{$attempt_maximum=$_GET["attempt_maximum"];}
	elseif (isset($_POST["attempt_maximum"]))	{$attempt_maximum=$_POST["attempt_maximum"];}
if (isset($_GET["auto_dial_level"]))	{$auto_dial_level=$_GET["auto_dial_level"];}
	elseif (isset($_POST["auto_dial_level"]))	{$auto_dial_level=$_POST["auto_dial_level"];}
if (isset($_GET["auto_dial_next_number"]))	{$auto_dial_next_number=$_GET["auto_dial_next_number"];}
	elseif (isset($_POST["auto_dial_next_number"]))	{$auto_dial_next_number=$_POST["auto_dial_next_number"];}
if (isset($_GET["available_only_ratio_tally"]))	{$available_only_ratio_tally=$_GET["available_only_ratio_tally"];}
	elseif (isset($_POST["available_only_ratio_tally"])){$available_only_ratio_tally=$_POST["available_only_ratio_tally"];}
if (isset($_GET["call_out_number_group"]))	{$call_out_number_group=$_GET["call_out_number_group"];}
	elseif (isset($_POST["call_out_number_group"]))	{$call_out_number_group=$_POST["call_out_number_group"];}
if (isset($_GET["call_parking_enabled"]))	{$call_parking_enabled=$_GET["call_parking_enabled"];}
	elseif (isset($_POST["call_parking_enabled"]))	{$call_parking_enabled=$_POST["call_parking_enabled"];}
if (isset($_GET["call_time_comments"]))	{$call_time_comments=$_GET["call_time_comments"];}
	elseif (isset($_POST["call_time_comments"]))	{$call_time_comments=$_POST["call_time_comments"];}
if (isset($_GET["call_time_id"]))	{$call_time_id=$_GET["call_time_id"];}
	elseif (isset($_POST["call_time_id"]))	{$call_time_id=$_POST["call_time_id"];}
if (isset($_GET["call_time_name"]))	{$call_time_name=$_GET["call_time_name"];}
	elseif (isset($_POST["call_time_name"]))	{$call_time_name=$_POST["call_time_name"];}
if (isset($_GET["CallerID_popup_enabled"]))	{$CallerID_popup_enabled=$_GET["CallerID_popup_enabled"];}
	elseif (isset($_POST["CallerID_popup_enabled"]))	{$CallerID_popup_enabled=$_POST["CallerID_popup_enabled"];}
if (isset($_GET["campaign_cid"]))	{$campaign_cid=$_GET["campaign_cid"];}
	elseif (isset($_POST["campaign_cid"]))	{$campaign_cid=$_POST["campaign_cid"];}
if (isset($_GET["campaign_detail"]))	{$campaign_detail=$_GET["campaign_detail"];}
	elseif (isset($_POST["campaign_detail"]))	{$campaign_detail=$_POST["campaign_detail"];}
if (isset($_GET["campaign_id"]))	{$campaign_id=$_GET["campaign_id"];}
	elseif (isset($_POST["campaign_id"]))	{$campaign_id=$_POST["campaign_id"];}
if (isset($_GET["campaign_name"]))	{$campaign_name=$_GET["campaign_name"];}
	elseif (isset($_POST["campaign_name"]))	{$campaign_name=$_POST["campaign_name"];}
if (isset($_GET["campaign_rec_exten"]))	{$campaign_rec_exten=$_GET["campaign_rec_exten"];}
	elseif (isset($_POST["campaign_rec_exten"]))	{$campaign_rec_exten=$_POST["campaign_rec_exten"];}
if (isset($_GET["campaign_rec_filename"]))	{$campaign_rec_filename=$_GET["campaign_rec_filename"];}
	elseif (isset($_POST["campaign_rec_filename"]))	{$campaign_rec_filename=$_POST["campaign_rec_filename"];}
if (isset($_GET["campaign_recording"]))	{$campaign_recording=$_GET["campaign_recording"];}
	elseif (isset($_POST["campaign_recording"]))	{$campaign_recording=$_POST["campaign_recording"];}
if (isset($_GET["campaign_vdad_exten"]))	{$campaign_vdad_exten=$_GET["campaign_vdad_exten"];}
	elseif (isset($_POST["campaign_vdad_exten"]))	{$campaign_vdad_exten=$_POST["campaign_vdad_exten"];}
if (isset($_GET["change_agent_campaign"]))	{$change_agent_campaign=$_GET["change_agent_campaign"];}
	elseif (isset($_POST["change_agent_campaign"]))	{$change_agent_campaign=$_POST["change_agent_campaign"];}
if (isset($_GET["client_browser"]))	{$client_browser=$_GET["client_browser"];}
	elseif (isset($_POST["client_browser"]))	{$client_browser=$_POST["client_browser"];}
if (isset($_GET["closer_default_blended"]))	{$closer_default_blended=$_GET["closer_default_blended"];}
	elseif (isset($_POST["closer_default_blended"]))	{$closer_default_blended=$_POST["closer_default_blended"];}
if (isset($_GET["company"]))	{$company=$_GET["company"];}
	elseif (isset($_POST["company"]))	{$company=$_POST["company"];}
if (isset($_GET["computer_ip"]))	{$computer_ip=$_GET["computer_ip"];}
	elseif (isset($_POST["computer_ip"]))	{$computer_ip=$_POST["computer_ip"];}
if (isset($_GET["conf_exten"]))	{$conf_exten=$_GET["conf_exten"];}
	elseif (isset($_POST["conf_exten"]))	{$conf_exten=$_POST["conf_exten"];}
if (isset($_GET["conf_on_extension"]))	{$conf_on_extension=$_GET["conf_on_extension"];}
	elseif (isset($_POST["conf_on_extension"]))	{$conf_on_extension=$_POST["conf_on_extension"];}
if (isset($_GET["conferencing_enabled"]))	{$conferencing_enabled=$_GET["conferencing_enabled"];}
	elseif (isset($_POST["conferencing_enabled"]))	{$conferencing_enabled=$_POST["conferencing_enabled"];}
if (isset($_GET["CoNfIrM"]))	{$CoNfIrM=$_GET["CoNfIrM"];}
	elseif (isset($_POST["CoNfIrM"]))	{$CoNfIrM=$_POST["CoNfIrM"];}
if (isset($_GET["ct_default_start"]))	{$ct_default_start=$_GET["ct_default_start"];}
	elseif (isset($_POST["ct_default_start"]))	{$ct_default_start=$_POST["ct_default_start"];}
if (isset($_GET["ct_default_stop"]))	{$ct_default_stop=$_GET["ct_default_stop"];}
	elseif (isset($_POST["ct_default_stop"]))	{$ct_default_stop=$_POST["ct_default_stop"];}
if (isset($_GET["ct_friday_start"]))	{$ct_friday_start=$_GET["ct_friday_start"];}
	elseif (isset($_POST["ct_friday_start"]))	{$ct_friday_start=$_POST["ct_friday_start"];}
if (isset($_GET["ct_friday_stop"]))	{$ct_friday_stop=$_GET["ct_friday_stop"];}
	elseif (isset($_POST["ct_friday_stop"]))	{$ct_friday_stop=$_POST["ct_friday_stop"];}
if (isset($_GET["ct_monday_start"]))	{$ct_monday_start=$_GET["ct_monday_start"];}
	elseif (isset($_POST["ct_monday_start"]))	{$ct_monday_start=$_POST["ct_monday_start"];}
if (isset($_GET["ct_monday_stop"]))	{$ct_monday_stop=$_GET["ct_monday_stop"];}
	elseif (isset($_POST["ct_monday_stop"]))	{$ct_monday_stop=$_POST["ct_monday_stop"];}
if (isset($_GET["ct_saturday_start"]))	{$ct_saturday_start=$_GET["ct_saturday_start"];}
	elseif (isset($_POST["ct_saturday_start"]))	{$ct_saturday_start=$_POST["ct_saturday_start"];}
if (isset($_GET["ct_saturday_stop"]))	{$ct_saturday_stop=$_GET["ct_saturday_stop"];}
	elseif (isset($_POST["ct_saturday_stop"]))	{$ct_saturday_stop=$_POST["ct_saturday_stop"];}
if (isset($_GET["ct_sunday_start"]))	{$ct_sunday_start=$_GET["ct_sunday_start"];}
	elseif (isset($_POST["ct_sunday_start"]))	{$ct_sunday_start=$_POST["ct_sunday_start"];}
if (isset($_GET["ct_sunday_stop"]))	{$ct_sunday_stop=$_GET["ct_sunday_stop"];}
	elseif (isset($_POST["ct_sunday_stop"]))	{$ct_sunday_stop=$_POST["ct_sunday_stop"];}
if (isset($_GET["ct_thursday_start"]))	{$ct_thursday_start=$_GET["ct_thursday_start"];}
	elseif (isset($_POST["ct_thursday_start"]))	{$ct_thursday_start=$_POST["ct_thursday_start"];}
if (isset($_GET["ct_thursday_stop"]))	{$ct_thursday_stop=$_GET["ct_thursday_stop"];}
	elseif (isset($_POST["ct_thursday_stop"]))	{$ct_thursday_stop=$_POST["ct_thursday_stop"];}
if (isset($_GET["ct_tuesday_start"]))	{$ct_tuesday_start=$_GET["ct_tuesday_start"];}
	elseif (isset($_POST["ct_tuesday_start"]))	{$ct_tuesday_start=$_POST["ct_tuesday_start"];}
if (isset($_GET["ct_tuesday_stop"]))	{$ct_tuesday_stop=$_GET["ct_tuesday_stop"];}
	elseif (isset($_POST["ct_tuesday_stop"]))	{$ct_tuesday_stop=$_POST["ct_tuesday_stop"];}
if (isset($_GET["ct_wednesday_start"]))	{$ct_wednesday_start=$_GET["ct_wednesday_start"];}
	elseif (isset($_POST["ct_wednesday_start"]))	{$ct_wednesday_start=$_POST["ct_wednesday_start"];}
if (isset($_GET["ct_wednesday_stop"]))	{$ct_wednesday_stop=$_GET["ct_wednesday_stop"];}
	elseif (isset($_POST["ct_wednesday_stop"]))	{$ct_wednesday_stop=$_POST["ct_wednesday_stop"];}
if (isset($_GET["DBX_database"]))	{$DBX_database=$_GET["DBX_database"];}
	elseif (isset($_POST["DBX_database"]))	{$DBX_database=$_POST["DBX_database"];}
if (isset($_GET["DBX_pass"]))	{$DBX_pass=$_GET["DBX_pass"];}
	elseif (isset($_POST["DBX_pass"]))	{$DBX_pass=$_POST["DBX_pass"];}
if (isset($_GET["DBX_port"]))	{$DBX_port=$_GET["DBX_port"];}
	elseif (isset($_POST["DBX_port"]))	{$DBX_port=$_POST["DBX_port"];}
if (isset($_GET["DBX_server"]))	{$DBX_server=$_GET["DBX_server"];}
	elseif (isset($_POST["DBX_server"]))	{$DBX_server=$_POST["DBX_server"];}
if (isset($_GET["DBX_user"]))	{$DBX_user=$_GET["DBX_user"];}
	elseif (isset($_POST["DBX_user"]))	{$DBX_user=$_POST["DBX_user"];}
if (isset($_GET["DBY_database"]))	{$DBY_database=$_GET["DBY_database"];}
	elseif (isset($_POST["DBY_database"]))	{$DBY_database=$_POST["DBY_database"];}
if (isset($_GET["DBY_pass"]))	{$DBY_pass=$_GET["DBY_pass"];}
	elseif (isset($_POST["DBY_pass"]))	{$DBY_pass=$_POST["DBY_pass"];}
if (isset($_GET["DBY_port"]))	{$DBY_port=$_GET["DBY_port"];}
	elseif (isset($_POST["DBY_port"]))	{$DBY_port=$_POST["DBY_port"];}
if (isset($_GET["DBY_server"]))	{$DBY_server=$_GET["DBY_server"];}
	elseif (isset($_POST["DBY_server"]))	{$DBY_server=$_POST["DBY_server"];}
if (isset($_GET["DBY_user"]))	{$DBY_user=$_GET["DBY_user"];}
	elseif (isset($_POST["DBY_user"]))	{$DBY_user=$_POST["DBY_user"];}
if (isset($_GET["delete_call_times"]))	{$delete_call_times=$_GET["delete_call_times"];}
	elseif (isset($_POST["delete_call_times"]))	{$delete_call_times=$_POST["delete_call_times"];}
if (isset($_GET["delete_campaigns"]))	{$delete_campaigns=$_GET["delete_campaigns"];}
	elseif (isset($_POST["delete_campaigns"]))	{$delete_campaigns=$_POST["delete_campaigns"];}
if (isset($_GET["delete_filters"]))	{$delete_filters=$_GET["delete_filters"];}
	elseif (isset($_POST["delete_filters"]))	{$delete_filters=$_POST["delete_filters"];}
if (isset($_GET["delete_ingroups"]))	{$delete_ingroups=$_GET["delete_ingroups"];}
	elseif (isset($_POST["delete_ingroups"]))	{$delete_ingroups=$_POST["delete_ingroups"];}
if (isset($_GET["delete_lists"]))	{$delete_lists=$_GET["delete_lists"];}
	elseif (isset($_POST["delete_lists"]))	{$delete_lists=$_POST["delete_lists"];}
if (isset($_GET["delete_remote_agents"]))	{$delete_remote_agents=$_GET["delete_remote_agents"];}
	elseif (isset($_POST["delete_remote_agents"]))	{$delete_remote_agents=$_POST["delete_remote_agents"];}
if (isset($_GET["delete_scripts"]))	{$delete_scripts=$_GET["delete_scripts"];}
	elseif (isset($_POST["delete_scripts"]))	{$delete_scripts=$_POST["delete_scripts"];}
if (isset($_GET["delete_user_groups"]))	{$delete_user_groups=$_GET["delete_user_groups"];}
	elseif (isset($_POST["delete_user_groups"]))	{$delete_user_groups=$_POST["delete_user_groups"];}
if (isset($_GET["delete_users"]))	{$delete_users=$_GET["delete_users"];}
	elseif (isset($_POST["delete_users"]))	{$delete_users=$_POST["delete_users"];}
if (isset($_GET["dial_method"]))	{$dial_method=$_GET["dial_method"];}
	elseif (isset($_POST["dial_method"]))	{$dial_method=$_POST["dial_method"];}
if (isset($_GET["dial_prefix"]))	{$dial_prefix=$_GET["dial_prefix"];}
	elseif (isset($_POST["dial_prefix"]))	{$dial_prefix=$_POST["dial_prefix"];}
if (isset($_GET["dial_status_a"]))	{$dial_status_a=$_GET["dial_status_a"];}
	elseif (isset($_POST["dial_status_a"]))	{$dial_status_a=$_POST["dial_status_a"];}
if (isset($_GET["dial_status_b"]))	{$dial_status_b=$_GET["dial_status_b"];}
	elseif (isset($_POST["dial_status_b"]))	{$dial_status_b=$_POST["dial_status_b"];}
if (isset($_GET["dial_status_c"]))	{$dial_status_c=$_GET["dial_status_c"];}
	elseif (isset($_POST["dial_status_c"]))	{$dial_status_c=$_POST["dial_status_c"];}
if (isset($_GET["dial_status_d"]))	{$dial_status_d=$_GET["dial_status_d"];}
	elseif (isset($_POST["dial_status_d"]))	{$dial_status_d=$_POST["dial_status_d"];}
if (isset($_GET["dial_status_e"]))	{$dial_status_e=$_GET["dial_status_e"];}
	elseif (isset($_POST["dial_status_e"]))	{$dial_status_e=$_POST["dial_status_e"];}
if (isset($_GET["dial_timeout"]))	{$dial_timeout=$_GET["dial_timeout"];}
	elseif (isset($_POST["dial_timeout"]))	{$dial_timeout=$_POST["dial_timeout"];}
if (isset($_GET["dialplan_number"]))	{$dialplan_number=$_GET["dialplan_number"];}
	elseif (isset($_POST["dialplan_number"]))	{$dialplan_number=$_POST["dialplan_number"];}
if (isset($_GET["drop_call_seconds"]))	{$drop_call_seconds=$_GET["drop_call_seconds"];}
	elseif (isset($_POST["drop_call_seconds"]))	{$drop_call_seconds=$_POST["drop_call_seconds"];}
if (isset($_GET["drop_exten"]))	{$drop_exten=$_GET["drop_exten"];}
	elseif (isset($_POST["drop_exten"]))	{$drop_exten=$_POST["drop_exten"];}
if (isset($_GET["drop_message"]))	{$drop_message=$_GET["drop_message"];}
	elseif (isset($_POST["drop_message"]))	{$drop_message=$_POST["drop_message"];}
if (isset($_GET["dtmf_send_extension"]))	{$dtmf_send_extension=$_GET["dtmf_send_extension"];}
	elseif (isset($_POST["dtmf_send_extension"]))	{$dtmf_send_extension=$_POST["dtmf_send_extension"];}
if (isset($_GET["enable_fast_refresh"]))	{$enable_fast_refresh=$_GET["enable_fast_refresh"];}
	elseif (isset($_POST["enable_fast_refresh"]))	{$enable_fast_refresh=$_POST["enable_fast_refresh"];}
if (isset($_GET["enable_persistant_mysql"]))	{$enable_persistant_mysql=$_GET["enable_persistant_mysql"];}
	elseif (isset($_POST["enable_persistant_mysql"]))	{$enable_persistant_mysql=$_POST["enable_persistant_mysql"];}
if (isset($_GET["ext_context"]))	{$ext_context=$_GET["ext_context"];}
	elseif (isset($_POST["ext_context"]))	{$ext_context=$_POST["ext_context"];}
if (isset($_GET["extension"]))	{$extension=$_GET["extension"];}
	elseif (isset($_POST["extension"]))	{$extension=$_POST["extension"];}
if (isset($_GET["fast_refresh_rate"]))	{$fast_refresh_rate=$_GET["fast_refresh_rate"];}
	elseif (isset($_POST["fast_refresh_rate"]))	{$fast_refresh_rate=$_POST["fast_refresh_rate"];}
if (isset($_GET["force_logout"]))	{$force_logout=$_GET["force_logout"];}
	elseif (isset($_POST["force_logout"]))	{$force_logout=$_POST["force_logout"];}
if (isset($_GET["fronter_display"]))	{$fronter_display=$_GET["fronter_display"];}
	elseif (isset($_POST["fronter_display"]))	{$fronter_display=$_POST["fronter_display"];}
if (isset($_GET["full_name"]))	{$full_name=$_GET["full_name"];}
	elseif (isset($_POST["full_name"]))	{$full_name=$_POST["full_name"];}
if (isset($_GET["fullname"]))	{$fullname=$_GET["fullname"];}
	elseif (isset($_POST["fullname"]))	{$fullname=$_POST["fullname"];}
if (isset($_GET["get_call_launch"]))	{$get_call_launch=$_GET["get_call_launch"];}
	elseif (isset($_POST["get_call_launch"]))	{$get_call_launch=$_POST["get_call_launch"];}
if (isset($_GET["group_color"]))	{$group_color=$_GET["group_color"];}
	elseif (isset($_POST["group_color"]))	{$group_color=$_POST["group_color"];}
if (isset($_GET["group_id"]))	{$group_id=$_GET["group_id"];}
	elseif (isset($_POST["group_id"]))	{$group_id=$_POST["group_id"];}
if (isset($_GET["group_name"]))	{$group_name=$_GET["group_name"];}
	elseif (isset($_POST["group_name"]))	{$group_name=$_POST["group_name"];}
if (isset($_GET["groups"]))	{$groups=$_GET["groups"];}
	elseif (isset($_POST["groups"]))	{$groups=$_POST["groups"];}
if (isset($_GET["HKstatus"]))	{$HKstatus=$_GET["HKstatus"];}
	elseif (isset($_POST["HKstatus"]))	{$HKstatus=$_POST["HKstatus"];}
if (isset($_GET["hopper_level"]))	{$hopper_level=$_GET["hopper_level"];}
	elseif (isset($_POST["hopper_level"]))	{$hopper_level=$_POST["hopper_level"];}
if (isset($_GET["hotkey"]))	{$hotkey=$_GET["hotkey"];}
	elseif (isset($_POST["hotkey"]))	{$hotkey=$_POST["hotkey"];}
if (isset($_GET["hotkeys_active"]))	{$hotkeys_active=$_GET["hotkeys_active"];}
	elseif (isset($_POST["hotkeys_active"]))	{$hotkeys_active=$_POST["hotkeys_active"];}
if (isset($_GET["install_directory"]))	{$install_directory=$_GET["install_directory"];}
	elseif (isset($_POST["install_directory"]))	{$install_directory=$_POST["install_directory"];}
if (isset($_GET["lead_filter_comments"]))	{$lead_filter_comments=$_GET["lead_filter_comments"];}
	elseif (isset($_POST["lead_filter_comments"]))	{$lead_filter_comments=$_POST["lead_filter_comments"];}
if (isset($_GET["lead_filter_id"]))	{$lead_filter_id=$_GET["lead_filter_id"];}
	elseif (isset($_POST["lead_filter_id"]))	{$lead_filter_id=$_POST["lead_filter_id"];}
if (isset($_GET["lead_filter_name"]))	{$lead_filter_name=$_GET["lead_filter_name"];}
	elseif (isset($_POST["lead_filter_name"]))	{$lead_filter_name=$_POST["lead_filter_name"];}
if (isset($_GET["lead_filter_sql"]))	{$lead_filter_sql=$_GET["lead_filter_sql"];}
	elseif (isset($_POST["lead_filter_sql"]))	{$lead_filter_sql=$_POST["lead_filter_sql"];}
if (isset($_GET["lead_order"]))	{$lead_order=$_GET["lead_order"];}
	elseif (isset($_POST["lead_order"]))	{$lead_order=$_POST["lead_order"];}
if (isset($_GET["list_id"]))	{$list_id=$_GET["list_id"];}
	elseif (isset($_POST["list_id"]))	{$list_id=$_POST["list_id"];}
if (isset($_GET["list_name"]))	{$list_name=$_GET["list_name"];}
	elseif (isset($_POST["list_name"]))	{$list_name=$_POST["list_name"];}
if (isset($_GET["load_leads"]))	{$load_leads=$_GET["load_leads"];}
	elseif (isset($_POST["load_leads"]))	{$load_leads=$_POST["load_leads"];}
if (isset($_GET["local_call_time"]))	{$local_call_time=$_GET["local_call_time"];}
	elseif (isset($_POST["local_call_time"]))	{$local_call_time=$_POST["local_call_time"];}
if (isset($_GET["local_gmt"]))	{$local_gmt=$_GET["local_gmt"];}
	elseif (isset($_POST["local_gmt"]))	{$local_gmt=$_POST["local_gmt"];}
if (isset($_GET["local_web_callerID_URL"]))	{$local_web_callerID_URL=$_GET["local_web_callerID_URL"];}
	elseif (isset($_POST["local_web_callerID_URL"]))	{$local_web_callerID_URL=$_POST["local_web_callerID_URL"];}
if (isset($_GET["login"]))	{$login=$_GET["login"];}
	elseif (isset($_POST["login"]))	{$login=$_POST["login"];}
if (isset($_GET["login_campaign"]))	{$login_campaign=$_GET["login_campaign"];}
	elseif (isset($_POST["login_campaign"]))	{$login_campaign=$_POST["login_campaign"];}
if (isset($_GET["login_pass"]))	{$login_pass=$_GET["login_pass"];}
	elseif (isset($_POST["login_pass"]))	{$login_pass=$_POST["login_pass"];}
if (isset($_GET["login_user"]))	{$login_user=$_GET["login_user"];}
	elseif (isset($_POST["login_user"]))	{$login_user=$_POST["login_user"];}
if (isset($_GET["max_vicidial_trunks"]))	{$max_vicidial_trunks=$_GET["max_vicidial_trunks"];}
	elseif (isset($_POST["max_vicidial_trunks"]))	{$max_vicidial_trunks=$_POST["max_vicidial_trunks"];}
if (isset($_GET["modify_call_times"]))	{$modify_call_times=$_GET["modify_call_times"];}
	elseif (isset($_POST["modify_call_times"]))	{$modify_call_times=$_POST["modify_call_times"];}
if (isset($_GET["modify_leads"]))	{$modify_leads=$_GET["modify_leads"];}
	elseif (isset($_POST["modify_leads"]))	{$modify_leads=$_POST["modify_leads"];}
if (isset($_GET["monitor_prefix"]))	{$monitor_prefix=$_GET["monitor_prefix"];}
	elseif (isset($_POST["monitor_prefix"]))	{$monitor_prefix=$_POST["monitor_prefix"];}
if (isset($_GET["next_agent_call"]))	{$next_agent_call=$_GET["next_agent_call"];}
	elseif (isset($_POST["next_agent_call"]))	{$next_agent_call=$_POST["next_agent_call"];}
if (isset($_GET["number_of_lines"]))	{$number_of_lines=$_GET["number_of_lines"];}
	elseif (isset($_POST["number_of_lines"]))	{$number_of_lines=$_POST["number_of_lines"];}
if (isset($_GET["old_campaign_id"]))	{$old_campaign_id=$_GET["old_campaign_id"];}
	elseif (isset($_POST["old_campaign_id"]))	{$old_campaign_id=$_POST["old_campaign_id"];}
if (isset($_GET["old_conf_exten"]))	{$old_conf_exten=$_GET["old_conf_exten"];}
	elseif (isset($_POST["old_conf_exten"]))	{$old_conf_exten=$_POST["old_conf_exten"];}
if (isset($_GET["old_extension"]))	{$old_extension=$_GET["old_extension"];}
	elseif (isset($_POST["old_extension"]))	{$old_extension=$_POST["old_extension"];}
if (isset($_GET["old_server_id"]))	{$old_server_id=$_GET["old_server_id"];}
	elseif (isset($_POST["old_server_id"]))	{$old_server_id=$_POST["old_server_id"];}
if (isset($_GET["old_server_ip"]))	{$old_server_ip=$_GET["old_server_ip"];}
	elseif (isset($_POST["old_server_ip"]))	{$old_server_ip=$_POST["old_server_ip"];}
if (isset($_GET["OLDuser_group"]))	{$OLDuser_group=$_GET["OLDuser_group"];}
	elseif (isset($_POST["OLDuser_group"]))	{$OLDuser_group=$_POST["OLDuser_group"];}
if (isset($_GET["omit_phone_code"]))	{$omit_phone_code=$_GET["omit_phone_code"];}
	elseif (isset($_POST["omit_phone_code"]))	{$omit_phone_code=$_POST["omit_phone_code"];}
if (isset($_GET["outbound_cid"]))	{$outbound_cid=$_GET["outbound_cid"];}
	elseif (isset($_POST["outbound_cid"]))	{$outbound_cid=$_POST["outbound_cid"];}
if (isset($_GET["park_ext"]))	{$park_ext=$_GET["park_ext"];}
	elseif (isset($_POST["park_ext"]))	{$park_ext=$_POST["park_ext"];}
if (isset($_GET["park_file_name"]))	{$park_file_name=$_GET["park_file_name"];}
	elseif (isset($_POST["park_file_name"]))	{$park_file_name=$_POST["park_file_name"];}
if (isset($_GET["park_on_extension"]))	{$park_on_extension=$_GET["park_on_extension"];}
	elseif (isset($_POST["park_on_extension"]))	{$park_on_extension=$_POST["park_on_extension"];}
if (isset($_GET["pass"]))	{$pass=$_GET["pass"];}
	elseif (isset($_POST["pass"]))	{$pass=$_POST["pass"];}
if (isset($_GET["phone_ip"]))	{$phone_ip=$_GET["phone_ip"];}
	elseif (isset($_POST["phone_ip"]))	{$phone_ip=$_POST["phone_ip"];}
if (isset($_GET["phone_login"]))	{$phone_login=$_GET["phone_login"];}
	elseif (isset($_POST["phone_login"]))	{$phone_login=$_POST["phone_login"];}
if (isset($_GET["phone_number"]))	{$phone_number=$_GET["phone_number"];}
	elseif (isset($_POST["phone_number"]))	{$phone_number=$_POST["phone_number"];}
if (isset($_GET["phone_pass"]))	{$phone_pass=$_GET["phone_pass"];}
	elseif (isset($_POST["phone_pass"]))	{$phone_pass=$_POST["phone_pass"];}
if (isset($_GET["phone_type"]))	{$phone_type=$_GET["phone_type"];}
	elseif (isset($_POST["phone_type"]))	{$phone_type=$_POST["phone_type"];}
if (isset($_GET["picture"]))	{$picture=$_GET["picture"];}
	elseif (isset($_POST["picture"]))	{$picture=$_POST["picture"];}
if (isset($_GET["protocol"]))	{$protocol=$_GET["protocol"];}
	elseif (isset($_POST["protocol"]))	{$protocol=$_POST["protocol"];}
if (isset($_GET["QUEUE_ACTION_enabled"]))	{$QUEUE_ACTION_enabled=$_GET["QUEUE_ACTION_enabled"];}
	elseif (isset($_POST["QUEUE_ACTION_enabled"]))	{$QUEUE_ACTION_enabled=$_POST["QUEUE_ACTION_enabled"];}
if (isset($_GET["recording_exten"]))	{$recording_exten=$_GET["recording_exten"];}
	elseif (isset($_POST["recording_exten"]))	{$recording_exten=$_POST["recording_exten"];}
if (isset($_GET["remote_agent_id"]))	{$remote_agent_id=$_GET["remote_agent_id"];}
	elseif (isset($_POST["remote_agent_id"]))	{$remote_agent_id=$_POST["remote_agent_id"];}
if (isset($_GET["reset_hopper"]))	{$reset_hopper=$_GET["reset_hopper"];}
	elseif (isset($_POST["reset_hopper"]))	{$reset_hopper=$_POST["reset_hopper"];}
if (isset($_GET["reset_list"]))	{$reset_list=$_GET["reset_list"];}
	elseif (isset($_POST["reset_list"]))	{$reset_list=$_POST["reset_list"];}
if (isset($_GET["safe_harbor_exten"]))	{$safe_harbor_exten=$_GET["safe_harbor_exten"];}
	elseif (isset($_POST["safe_harbor_exten"]))	{$safe_harbor_exten=$_POST["safe_harbor_exten"];}
if (isset($_GET["safe_harbor_message"]))	{$safe_harbor_message=$_GET["safe_harbor_message"];}
	elseif (isset($_POST["safe_harbor_message"]))	{$safe_harbor_message=$_POST["safe_harbor_message"];}
if (isset($_GET["scheduled_callbacks"]))	{$scheduled_callbacks=$_GET["scheduled_callbacks"];}
	elseif (isset($_POST["scheduled_callbacks"]))	{$scheduled_callbacks=$_POST["scheduled_callbacks"];}
if (isset($_GET["script_comments"]))	{$script_comments=$_GET["script_comments"];}
	elseif (isset($_POST["script_comments"]))	{$script_comments=$_POST["script_comments"];}
if (isset($_GET["script_id"]))	{$script_id=$_GET["script_id"];}
	elseif (isset($_POST["script_id"]))	{$script_id=$_POST["script_id"];}
if (isset($_GET["script_name"]))	{$script_name=$_GET["script_name"];}
	elseif (isset($_POST["script_name"]))	{$script_name=$_POST["script_name"];}
if (isset($_GET["script_text"]))	{$script_text=$_GET["script_text"];}
	elseif (isset($_POST["script_text"]))	{$script_text=$_POST["script_text"];}
if (isset($_GET["selectable"]))	{$selectable=$_GET["selectable"];}
	elseif (isset($_POST["selectable"]))	{$selectable=$_POST["selectable"];}
if (isset($_GET["server_description"]))	{$server_description=$_GET["server_description"];}
	elseif (isset($_POST["server_description"]))	{$server_description=$_POST["server_description"];}
if (isset($_GET["server_id"]))	{$server_id=$_GET["server_id"];}
	elseif (isset($_POST["server_id"]))	{$server_id=$_POST["server_id"];}
if (isset($_GET["server_ip"]))	{$server_ip=$_GET["server_ip"];}
	elseif (isset($_POST["server_ip"]))	{$server_ip=$_POST["server_ip"];}
if (isset($_GET["stage"]))	{$stage=$_GET["stage"];}
	elseif (isset($_POST["stage"]))	{$stage=$_POST["stage"];}
if (isset($_GET["state_call_time_state"]))	{$state_call_time_state=$_GET["state_call_time_state"];}
	elseif (isset($_POST["state_call_time_state"]))	{$state_call_time_state=$_POST["state_call_time_state"];}
if (isset($_GET["state_rule"]))	{$state_rule=$_GET["state_rule"];}
	elseif (isset($_POST["state_rule"]))	{$state_rule=$_POST["state_rule"];}
if (isset($_GET["status"]))	{$status=$_GET["status"];}
	elseif (isset($_POST["status"]))	{$status=$_POST["status"];}
if (isset($_GET["status_name"]))	{$status_name=$_GET["status_name"];}
	elseif (isset($_POST["status_name"]))	{$status_name=$_POST["status_name"];}
if (isset($_GET["submit"]))	{$submit=$_GET["submit"];}
	elseif (isset($_POST["submit"]))	{$submit=$_POST["submit"];}
if (isset($_GET["ΕΠΙΒΕΒΑΙΩΣΗ"]))	{$ΕΠΙΒΕΒΑΙΩΣΗ=$_GET["ΕΠΙΒΕΒΑΙΩΣΗ"];}
	elseif (isset($_POST["ΕΠΙΒΕΒΑΙΩΣΗ"]))	{$ΕΠΙΒΕΒΑΙΩΣΗ=$_POST["ΕΠΙΒΕΒΑΙΩΣΗ"];}
if (isset($_GET["sys_perf_log"]))	{$sys_perf_log=$_GET["sys_perf_log"];}
	elseif (isset($_POST["sys_perf_log"]))	{$sys_perf_log=$_POST["sys_perf_log"];}
if (isset($_GET["telnet_host"]))	{$telnet_host=$_GET["telnet_host"];}
	elseif (isset($_POST["telnet_host"]))	{$telnet_host=$_POST["telnet_host"];}
if (isset($_GET["telnet_port"]))	{$telnet_port=$_GET["telnet_port"];}
	elseif (isset($_POST["telnet_port"]))	{$telnet_port=$_POST["telnet_port"];}
if (isset($_GET["updater_check_enabled"]))	{$updater_check_enabled=$_GET["updater_check_enabled"];}
	elseif (isset($_POST["updater_check_enabled"]))	{$updater_check_enabled=$_POST["updater_check_enabled"];}
if (isset($_GET["use_internal_dnc"]))	{$use_internal_dnc=$_GET["use_internal_dnc"];}
	elseif (isset($_POST["use_internal_dnc"]))	{$use_internal_dnc=$_POST["use_internal_dnc"];}
if (isset($_GET["user"]))	{$user=$_GET["user"];}
	elseif (isset($_POST["user"]))	{$user=$_POST["user"];}
if (isset($_GET["user_group"]))	{$user_group=$_GET["user_group"];}
	elseif (isset($_POST["user_group"]))	{$user_group=$_POST["user_group"];}
if (isset($_GET["user_level"]))	{$user_level=$_GET["user_level"];}
	elseif (isset($_POST["user_level"]))	{$user_level=$_POST["user_level"];}
if (isset($_GET["user_start"]))	{$user_start=$_GET["user_start"];}
	elseif (isset($_POST["user_start"]))	{$user_start=$_POST["user_start"];}
if (isset($_GET["user_switching_enabled"]))	{$user_switching_enabled=$_GET["user_switching_enabled"];}
	elseif (isset($_POST["user_switching_enabled"]))	{$user_switching_enabled=$_POST["user_switching_enabled"];}
if (isset($_GET["vd_server_logs"]))	{$vd_server_logs=$_GET["vd_server_logs"];}
	elseif (isset($_POST["vd_server_logs"]))	{$vd_server_logs=$_POST["vd_server_logs"];}
if (isset($_GET["VDstop_rec_after_each_call"]))	{$VDstop_rec_after_each_call=$_GET["VDstop_rec_after_each_call"];}
	elseif (isset($_POST["VDstop_rec_after_each_call"]))	{$VDstop_rec_after_each_call=$_POST["VDstop_rec_after_each_call"];}
if (isset($_GET["VICIDIAL_park_on_extension"]))	{$VICIDIAL_park_on_extension=$_GET["VICIDIAL_park_on_extension"];}
	elseif (isset($_POST["VICIDIAL_park_on_extension"]))	{$VICIDIAL_park_on_extension=$_POST["VICIDIAL_park_on_extension"];}
if (isset($_GET["VICIDIAL_park_on_filename"]))	{$VICIDIAL_park_on_filename=$_GET["VICIDIAL_park_on_filename"];}
	elseif (isset($_POST["VICIDIAL_park_on_filename"]))	{$VICIDIAL_park_on_filename=$_POST["VICIDIAL_park_on_filename"];}
if (isset($_GET["vicidial_recording"]))	{$vicidial_recording=$_GET["vicidial_recording"];}
	elseif (isset($_POST["vicidial_recording"]))	{$vicidial_recording=$_POST["vicidial_recording"];}
if (isset($_GET["vicidial_transfers"]))	{$vicidial_transfers=$_GET["vicidial_transfers"];}
	elseif (isset($_POST["vicidial_transfers"]))	{$vicidial_transfers=$_POST["vicidial_transfers"];}
if (isset($_GET["VICIDIAL_web_URL"]))	{$VICIDIAL_web_URL=$_GET["VICIDIAL_web_URL"];}
	elseif (isset($_POST["VICIDIAL_web_URL"]))	{$VICIDIAL_web_URL=$_POST["VICIDIAL_web_URL"];}
if (isset($_GET["voicemail_button_enabled"]))	{$voicemail_button_enabled=$_GET["voicemail_button_enabled"];}
	elseif (isset($_POST["voicemail_button_enabled"]))	{$voicemail_button_enabled=$_POST["voicemail_button_enabled"];}
if (isset($_GET["voicemail_dump_exten"]))	{$voicemail_dump_exten=$_GET["voicemail_dump_exten"];}
	elseif (isset($_POST["voicemail_dump_exten"]))	{$voicemail_dump_exten=$_POST["voicemail_dump_exten"];}
if (isset($_GET["voicemail_ext"]))	{$voicemail_ext=$_GET["voicemail_ext"];}
	elseif (isset($_POST["voicemail_ext"]))	{$voicemail_ext=$_POST["voicemail_ext"];}
if (isset($_GET["voicemail_exten"]))	{$voicemail_exten=$_GET["voicemail_exten"];}
	elseif (isset($_POST["voicemail_exten"]))	{$voicemail_exten=$_POST["voicemail_exten"];}
if (isset($_GET["voicemail_id"]))	{$voicemail_id=$_GET["voicemail_id"];}
	elseif (isset($_POST["voicemail_id"]))	{$voicemail_id=$_POST["voicemail_id"];}
if (isset($_GET["web_form_address"]))	{$web_form_address=$_GET["web_form_address"];}
	elseif (isset($_POST["web_form_address"]))	{$web_form_address=$_POST["web_form_address"];}
if (isset($_GET["wrapup_message"]))	{$wrapup_message=$_GET["wrapup_message"];}
	elseif (isset($_POST["wrapup_message"]))	{$wrapup_message=$_POST["wrapup_message"];}
if (isset($_GET["wrapup_seconds"]))	{$wrapup_seconds=$_GET["wrapup_seconds"];}
	elseif (isset($_POST["wrapup_seconds"]))	{$wrapup_seconds=$_POST["wrapup_seconds"];}
if (isset($_GET["xferconf_a_dtmf"]))	{$xferconf_a_dtmf=$_GET["xferconf_a_dtmf"];}
	elseif (isset($_POST["xferconf_a_dtmf"]))	{$xferconf_a_dtmf=$_POST["xferconf_a_dtmf"];}
if (isset($_GET["xferconf_a_number"]))	{$xferconf_a_number=$_GET["xferconf_a_number"];}
	elseif (isset($_POST["xferconf_a_number"]))	{$xferconf_a_number=$_POST["xferconf_a_number"];}
if (isset($_GET["xferconf_b_dtmf"]))	{$xferconf_b_dtmf=$_GET["xferconf_b_dtmf"];}
	elseif (isset($_POST["xferconf_b_dtmf"]))	{$xferconf_b_dtmf=$_POST["xferconf_b_dtmf"];}
if (isset($_GET["xferconf_b_number"]))	{$xferconf_b_number=$_GET["xferconf_b_number"];}
	elseif (isset($_POST["xferconf_b_number"]))	{$xferconf_b_number=$_POST["xferconf_b_number"];}
if (isset($_GET["vicidial_balance_active"]))	{$vicidial_balance_active=$_GET["vicidial_balance_active"];}
	elseif (isset($_POST["vicidial_balance_active"]))	{$vicidial_balance_active=$_POST["vicidial_balance_active"];}
if (isset($_GET["balance_trunks_offlimits"]))	{$balance_trunks_offlimits=$_GET["balance_trunks_offlimits"];}
	elseif (isset($_POST["balance_trunks_offlimits"]))	{$balance_trunks_offlimits=$_POST["balance_trunks_offlimits"];}
if (isset($_GET["dedicated_trunks"]))	{$dedicated_trunks=$_GET["dedicated_trunks"];}
	elseif (isset($_POST["dedicated_trunks"]))	{$dedicated_trunks=$_POST["dedicated_trunks"];}
if (isset($_GET["trunk_restriction"]))	{$trunk_restriction=$_GET["trunk_restriction"];}
	elseif (isset($_POST["trunk_restriction"]))	{$trunk_restriction=$_POST["trunk_restriction"];}
if (isset($_GET["campaigns"]))						{$campaigns=$_GET["campaigns"];}
	elseif (isset($_POST["campaigns"]))				{$campaigns=$_POST["campaigns"];}
if (isset($_GET["dial_level_override"]))			{$dial_level_override=$_GET["dial_level_override"];}
	elseif (isset($_POST["dial_level_override"]))	{$dial_level_override=$_POST["dial_level_override"];}
if (isset($_GET["concurrent_transfers"]))			{$concurrent_transfers=$_GET["concurrent_transfers"];}
	elseif (isset($_POST["concurrent_transfers"]))	{$concurrent_transfers=$_POST["concurrent_transfers"];}
if (isset($_GET["auto_alt_dial"]))			{$auto_alt_dial=$_GET["auto_alt_dial"];}
	elseif (isset($_POST["auto_alt_dial"]))	{$auto_alt_dial=$_POST["auto_alt_dial"];}
if (isset($_GET["modify_users"]))				{$modify_users=$_GET["modify_users"];}
	elseif (isset($_POST["modify_users"]))		{$modify_users=$_POST["modify_users"];}
if (isset($_GET["modify_campaigns"]))			{$modify_campaigns=$_GET["modify_campaigns"];}
	elseif (isset($_POST["modify_campaigns"]))	{$modify_campaigns=$_POST["modify_campaigns"];}
if (isset($_GET["modify_lists"]))				{$modify_lists=$_GET["modify_lists"];}
	elseif (isset($_POST["modify_lists"]))		{$modify_lists=$_POST["modify_lists"];}
if (isset($_GET["modify_scripts"]))				{$modify_scripts=$_GET["modify_scripts"];}
	elseif (isset($_POST["modify_scripts"]))	{$modify_scripts=$_POST["modify_scripts"];}
if (isset($_GET["modify_filters"]))				{$modify_filters=$_GET["modify_filters"];}
	elseif (isset($_POST["modify_filters"]))	{$modify_filters=$_POST["modify_filters"];}
if (isset($_GET["modify_ingroups"]))			{$modify_ingroups=$_GET["modify_ingroups"];}
	elseif (isset($_POST["modify_ingroups"]))	{$modify_ingroups=$_POST["modify_ingroups"];}
if (isset($_GET["modify_usergroups"]))			{$modify_usergroups=$_GET["modify_usergroups"];}
	elseif (isset($_POST["modify_usergroups"]))	{$modify_usergroups=$_POST["modify_usergroups"];}
if (isset($_GET["modify_remoteagents"]))			{$modify_remoteagents=$_GET["modify_remoteagents"];}
	elseif (isset($_POST["modify_remoteagents"]))	{$modify_remoteagents=$_POST["modify_remoteagents"];}
if (isset($_GET["modify_servers"]))				{$modify_servers=$_GET["modify_servers"];}
	elseif (isset($_POST["modify_servers"]))	{$modify_servers=$_POST["modify_servers"];}
if (isset($_GET["view_reports"]))				{$view_reports=$_GET["view_reports"];}
	elseif (isset($_POST["view_reports"]))		{$view_reports=$_POST["view_reports"];}
if (isset($_GET["agent_pause_codes_active"]))			{$agent_pause_codes_active=$_GET["agent_pause_codes_active"];}
	elseif (isset($_POST["agent_pause_codes_active"]))	{$agent_pause_codes_active=$_POST["agent_pause_codes_active"];}
if (isset($_GET["pause_code"]))					{$pause_code=$_GET["pause_code"];}
	elseif (isset($_POST["pause_code"]))		{$pause_code=$_POST["pause_code"];}
if (isset($_GET["pause_code_name"]))			{$pause_code_name=$_GET["pause_code_name"];}
	elseif (isset($_POST["pause_code_name"]))	{$pause_code_name=$_POST["pause_code_name"];}
if (isset($_GET["billable"]))					{$billable=$_GET["billable"];}
	elseif (isset($_POST["billable"]))			{$billable=$_POST["billable"];}
if (isset($_GET["campaign_description"]))			{$campaign_description=$_GET["campaign_description"];}
	elseif (isset($_POST["campaign_description"]))	{$campaign_description=$_POST["campaign_description"];}
if (isset($_GET["campaign_stats_refresh"]))			{$campaign_stats_refresh=$_GET["campaign_stats_refresh"];}
	elseif (isset($_POST["campaign_stats_refresh"])){$campaign_stats_refresh=$_POST["campaign_stats_refresh"];}
if (isset($_GET["list_description"]))			{$list_description=$_GET["list_description"];}
	elseif (isset($_POST["list_description"]))	{$list_description=$_POST["list_description"];}
if (isset($_GET["vicidial_recording_override"]))		{$vicidial_recording_override=$_GET["vicidial_recording_override"];}		elseif (isset($_POST["vicidial_recording_override"]))	{$vicidial_recording_override=$_POST["vicidial_recording_override"];}
if (isset($_GET["use_non_latin"]))				{$use_non_latin=$_GET["use_non_latin"];}
	elseif (isset($_POST["use_non_latin"]))		{$use_non_latin=$_POST["use_non_latin"];}
if (isset($_GET["webroot_writable"]))			{$webroot_writable=$_GET["webroot_writable"];}
	elseif (isset($_POST["webroot_writable"]))	{$webroot_writable=$_POST["webroot_writable"];}
if (isset($_GET["enable_queuemetrics_logging"]))	{$enable_queuemetrics_logging=$_GET["enable_queuemetrics_logging"];}
	elseif (isset($_POST["enable_queuemetrics_logging"]))	{$enable_queuemetrics_logging=$_POST["enable_queuemetrics_logging"];}
if (isset($_GET["queuemetrics_server_ip"]))				{$queuemetrics_server_ip=$_GET["queuemetrics_server_ip"];}
	elseif (isset($_POST["queuemetrics_server_ip"]))	{$queuemetrics_server_ip=$_POST["queuemetrics_server_ip"];}
if (isset($_GET["queuemetrics_dbname"]))			{$queuemetrics_dbname=$_GET["queuemetrics_dbname"];}
	elseif (isset($_POST["queuemetrics_dbname"]))	{$queuemetrics_dbname=$_POST["queuemetrics_dbname"];}
if (isset($_GET["queuemetrics_login"]))				{$queuemetrics_login=$_GET["queuemetrics_login"];}
	elseif (isset($_POST["queuemetrics_login"]))	{$queuemetrics_login=$_POST["queuemetrics_login"];}
if (isset($_GET["queuemetrics_pass"]))			{$queuemetrics_pass=$_GET["queuemetrics_pass"];}
	elseif (isset($_POST["queuemetrics_pass"]))	{$queuemetrics_pass=$_POST["queuemetrics_pass"];}
if (isset($_GET["queuemetrics_url"]))			{$queuemetrics_url=$_GET["queuemetrics_url"];}
	elseif (isset($_POST["queuemetrics_url"]))	{$queuemetrics_url=$_POST["queuemetrics_url"];}
if (isset($_GET["queuemetrics_log_id"]))			{$queuemetrics_log_id=$_GET["queuemetrics_log_id"];}
	elseif (isset($_POST["queuemetrics_log_id"]))	{$queuemetrics_log_id=$_POST["queuemetrics_log_id"];}
if (isset($_GET["dial_status"]))				{$dial_status=$_GET["dial_status"];}
	elseif (isset($_POST["dial_status"]))		{$dial_status=$_POST["dial_status"];}
if (isset($_GET["queuemetrics_eq_prepend"]))			{$queuemetrics_eq_prepend=$_GET["queuemetrics_eq_prepend"];}
	elseif (isset($_POST["queuemetrics_eq_prepend"]))	{$queuemetrics_eq_prepend=$_POST["queuemetrics_eq_prepend"];}
if (isset($_GET["vicidial_agent_disable"]))				{$vicidial_agent_disable=$_GET["vicidial_agent_disable"];}
	elseif (isset($_POST["vicidial_agent_disable"]))	{$vicidial_agent_disable=$_POST["vicidial_agent_disable"];}
if (isset($_GET["disable_alter_custdata"]))				{$disable_alter_custdata=$_GET["disable_alter_custdata"];}
	elseif (isset($_POST["disable_alter_custdata"]))	{$disable_alter_custdata=$_POST["disable_alter_custdata"];}
if (isset($_GET["alter_custdata_override"]))			{$alter_custdata_override=$_GET["alter_custdata_override"];}
	elseif (isset($_POST["alter_custdata_override"]))	{$alter_custdata_override=$_POST["alter_custdata_override"];}
if (isset($_GET["no_hopper_leads_logins"]))				{$no_hopper_leads_logins=$_GET["no_hopper_leads_logins"];}
	elseif (isset($_POST["no_hopper_leads_logins"]))	{$no_hopper_leads_logins=$_POST["no_hopper_leads_logins"];}
if (isset($_GET["enable_sipsak_messages"]))				{$enable_sipsak_messages=$_GET["enable_sipsak_messages"];}
	elseif (isset($_POST["enable_sipsak_messages"]))	{$enable_sipsak_messages=$_POST["enable_sipsak_messages"];}
if (isset($_GET["allow_sipsak_messages"]))				{$allow_sipsak_messages=$_GET["allow_sipsak_messages"];}
	elseif (isset($_POST["allow_sipsak_messages"]))		{$allow_sipsak_messages=$_POST["allow_sipsak_messages"];}
if (isset($_GET["admin_home_url"]))				{$admin_home_url=$_GET["admin_home_url"];}
	elseif (isset($_POST["admin_home_url"]))	{$admin_home_url=$_POST["admin_home_url"];}


	if (isset($script_id)) {$script_id= strtoupper($script_id);}
	if (isset($lead_filter_id)) {$lead_filter_id = strtoupper($lead_filter_id);}

if (strlen($dial_status) > 0) 
	{
	$ADD='28';
	$status = $dial_status;
	}

##### BEGIN VARIABLE FILTERING FOR SECURITY #####

if ($non_latin < 1)
{
### DIGITS ONLY ###
$adaptive_dropped_percentage = ereg_replace("[^0-9]","",$adaptive_dropped_percentage);
$adaptive_latest_server_time = ereg_replace("[^0-9]","",$adaptive_latest_server_time);
$admin_hangup_enabled = ereg_replace("[^0-9]","",$admin_hangup_enabled);
$admin_hijack_enabled = ereg_replace("[^0-9]","",$admin_hijack_enabled);
$admin_monitor_enabled = ereg_replace("[^0-9]","",$admin_monitor_enabled);
$AFLogging_enabled = ereg_replace("[^0-9]","",$AFLogging_enabled);
$agent_choose_ingroups = ereg_replace("[^0-9]","",$agent_choose_ingroups);
$agentcall_manual = ereg_replace("[^0-9]","",$agentcall_manual);
$agentonly_callbacks = ereg_replace("[^0-9]","",$agentonly_callbacks);
$AGI_call_logging_enabled = ereg_replace("[^0-9]","",$AGI_call_logging_enabled);
$allcalls_delay = ereg_replace("[^0-9]","",$allcalls_delay);
$alter_agent_interface_options = ereg_replace("[^0-9]","",$alter_agent_interface_options);
$am_message_exten = ereg_replace("[^0-9]","",$am_message_exten);
$answer_transfer_agent = ereg_replace("[^0-9]","",$answer_transfer_agent);
$ast_admin_access = ereg_replace("[^0-9]","",$ast_admin_access);
$ast_delete_phones = ereg_replace("[^0-9]","",$ast_delete_phones);
$attempt_delay = ereg_replace("[^0-9]","",$attempt_delay);
$attempt_maximum = ereg_replace("[^0-9]","",$attempt_maximum);
$auto_dial_next_number = ereg_replace("[^0-9]","",$auto_dial_next_number);
$balance_trunks_offlimits = ereg_replace("[^0-9]","",$balance_trunks_offlimits);
$call_parking_enabled = ereg_replace("[^0-9]","",$call_parking_enabled);
$CallerID_popup_enabled = ereg_replace("[^0-9]","",$CallerID_popup_enabled);
$campaign_detail = ereg_replace("[^0-9]","",$campaign_detail);
$campaign_rec_exten = ereg_replace("[^0-9]","",$campaign_rec_exten);
$campaign_vdad_exten = ereg_replace("[^0-9]","",$campaign_vdad_exten);
$change_agent_campaign = ereg_replace("[^0-9]","",$change_agent_campaign);
$closer_default_blended = ereg_replace("[^0-9]","",$closer_default_blended);
$conf_exten = ereg_replace("[^0-9]","",$conf_exten);
$conf_on_extension = ereg_replace("[^0-9]","",$conf_on_extension);
$conferencing_enabled = ereg_replace("[^0-9]","",$conferencing_enabled);
$ct_default_start = ereg_replace("[^0-9]","",$ct_default_start);
$ct_default_stop = ereg_replace("[^0-9]","",$ct_default_stop);
$ct_friday_start = ereg_replace("[^0-9]","",$ct_friday_start);
$ct_friday_stop = ereg_replace("[^0-9]","",$ct_friday_stop);
$ct_monday_start = ereg_replace("[^0-9]","",$ct_monday_start);
$ct_monday_stop = ereg_replace("[^0-9]","",$ct_monday_stop);
$ct_saturday_start = ereg_replace("[^0-9]","",$ct_saturday_start);
$ct_saturday_stop = ereg_replace("[^0-9]","",$ct_saturday_stop);
$ct_sunday_start = ereg_replace("[^0-9]","",$ct_sunday_start);
$ct_sunday_stop = ereg_replace("[^0-9]","",$ct_sunday_stop);
$ct_thursday_start = ereg_replace("[^0-9]","",$ct_thursday_start);
$ct_thursday_stop = ereg_replace("[^0-9]","",$ct_thursday_stop);
$ct_tuesday_start = ereg_replace("[^0-9]","",$ct_tuesday_start);
$ct_tuesday_stop = ereg_replace("[^0-9]","",$ct_tuesday_stop);
$ct_wednesday_start = ereg_replace("[^0-9]","",$ct_wednesday_start);
$ct_wednesday_stop = ereg_replace("[^0-9]","",$ct_wednesday_stop);
$DBX_port = ereg_replace("[^0-9]","",$DBX_port);
$DBY_port = ereg_replace("[^0-9]","",$DBY_port);
$dedicated_trunks = ereg_replace("[^0-9]","",$dedicated_trunks);
$delete_call_times = ereg_replace("[^0-9]","",$delete_call_times);
$delete_campaigns = ereg_replace("[^0-9]","",$delete_campaigns);
$delete_filters = ereg_replace("[^0-9]","",$delete_filters);
$delete_ingroups = ereg_replace("[^0-9]","",$delete_ingroups);
$delete_lists = ereg_replace("[^0-9]","",$delete_lists);
$delete_remote_agents = ereg_replace("[^0-9]","",$delete_remote_agents);
$delete_scripts = ereg_replace("[^0-9]","",$delete_scripts);
$delete_user_groups = ereg_replace("[^0-9]","",$delete_user_groups);
$delete_users = ereg_replace("[^0-9]","",$delete_users);
$dial_timeout = ereg_replace("[^0-9]","",$dial_timeout);
$dialplan_number = ereg_replace("[^0-9]","",$dialplan_number);
$drop_call_seconds = ereg_replace("[^0-9]","",$drop_call_seconds);
$drop_exten = ereg_replace("[^0-9]","",$drop_exten);
$enable_fast_refresh = ereg_replace("[^0-9]","",$enable_fast_refresh);
$enable_persistant_mysql = ereg_replace("[^0-9]","",$enable_persistant_mysql);
$fast_refresh_rate = ereg_replace("[^0-9]","",$fast_refresh_rate);
$hopper_level = ereg_replace("[^0-9]","",$hopper_level);
$hotkey = ereg_replace("[^0-9]","",$hotkey);
$hotkeys_active = ereg_replace("[^0-9]","",$hotkeys_active);
$list_id = ereg_replace("[^0-9]","",$list_id);
$load_leads = ereg_replace("[^0-9]","",$load_leads);
$max_vicidial_trunks = ereg_replace("[^0-9]","",$max_vicidial_trunks);
$modify_call_times = ereg_replace("[^0-9]","",$modify_call_times);
$modify_users = ereg_replace("[^0-9]","",$modify_users);
$modify_campaigns = ereg_replace("[^0-9]","",$modify_campaigns);
$modify_lists = ereg_replace("[^0-9]","",$modify_lists);
$modify_scripts = ereg_replace("[^0-9]","",$modify_scripts);
$modify_filters = ereg_replace("[^0-9]","",$modify_filters);
$modify_ingroups = ereg_replace("[^0-9]","",$modify_ingroups);
$modify_usergroups = ereg_replace("[^0-9]","",$modify_usergroups);
$modify_remoteagents = ereg_replace("[^0-9]","",$modify_remoteagents);
$modify_servers = ereg_replace("[^0-9]","",$modify_servers);
$view_reports = ereg_replace("[^0-9]","",$view_reports);
$modify_leads = ereg_replace("[^0-9]","",$modify_leads);
$monitor_prefix = ereg_replace("[^0-9]","",$monitor_prefix);
$number_of_lines = ereg_replace("[^0-9]","",$number_of_lines);
$old_conf_exten = ereg_replace("[^0-9]","",$old_conf_exten);
$outbound_cid = ereg_replace("[^0-9]","",$outbound_cid);
$park_ext = ereg_replace("[^0-9]","",$park_ext);
$park_on_extension = ereg_replace("[^0-9]","",$park_on_extension);
$phone_number = ereg_replace("[^0-9]","",$phone_number);
$QUEUE_ACTION_enabled = ereg_replace("[^0-9]","",$QUEUE_ACTION_enabled);
$recording_exten = ereg_replace("[^0-9]","",$recording_exten);
$remote_agent_id = ereg_replace("[^0-9]","",$remote_agent_id);
$safe_harbor_exten = ereg_replace("[^0-9]","",$safe_harbor_exten);
$telnet_port = ereg_replace("[^0-9]","",$telnet_port);
$updater_check_enabled = ereg_replace("[^0-9]","",$updater_check_enabled);
$user_level = ereg_replace("[^0-9]","",$user_level);
$user_start = ereg_replace("[^0-9]","",$user_start);
$user_switching_enabled = ereg_replace("[^0-9]","",$user_switching_enabled);
$VDstop_rec_after_each_call = ereg_replace("[^0-9]","",$VDstop_rec_after_each_call);
$VICIDIAL_park_on_extension = ereg_replace("[^0-9]","",$VICIDIAL_park_on_extension);
$vicidial_recording = ereg_replace("[^0-9]","",$vicidial_recording);
$vicidial_transfers = ereg_replace("[^0-9]","",$vicidial_transfers);
$voicemail_button_enabled = ereg_replace("[^0-9]","",$voicemail_button_enabled);
$voicemail_dump_exten = ereg_replace("[^0-9]","",$voicemail_dump_exten);
$voicemail_ext = ereg_replace("[^0-9]","",$voicemail_ext);
$voicemail_exten = ereg_replace("[^0-9]","",$voicemail_exten);
$voicemail_id = ereg_replace("[^0-9]","",$voicemail_id);
$wrapup_seconds = ereg_replace("[^0-9]","",$wrapup_seconds);
$use_non_latin = ereg_replace("[^0-9]","",$use_non_latin);
$webroot_writable = ereg_replace("[^0-9]","",$webroot_writable);
$enable_queuemetrics_logging = ereg_replace("[^0-9]","",$enable_queuemetrics_logging);
$enable_sipsak_messages = ereg_replace("[^0-9]","",$enable_sipsak_messages);
$allow_sipsak_messages = ereg_replace("[^0-9]","",$allow_sipsak_messages);

### Y or N ONLY ###
$active = ereg_replace("[^NY]","",$active);
$allow_closers = ereg_replace("[^NY]","",$allow_closers);
$reset_hopper = ereg_replace("[^NY]","",$reset_hopper);
$amd_send_to_vmx = ereg_replace("[^NY]","",$amd_send_to_vmx);
$alt_number_dialing = ereg_replace("[^NY]","",$alt_number_dialing);
$safe_harbor_message = ereg_replace("[^NY]","",$safe_harbor_message);
$selectable = ereg_replace("[^NY]","",$selectable);
$reset_list = ereg_replace("[^NY]","",$reset_list);
$fronter_display = ereg_replace("[^NY]","",$fronter_display);
$drop_message = ereg_replace("[^NY]","",$drop_message);
$use_internal_dnc = ereg_replace("[^NY]","",$use_internal_dnc);
$omit_phone_code = ereg_replace("[^NY]","",$omit_phone_code);
$available_only_ratio_tally = ereg_replace("[^NY]","",$available_only_ratio_tally);
$sys_perf_log = ereg_replace("[^NY]","",$sys_perf_log);
$vicidial_balance_active = ereg_replace("[^NY]","",$vicidial_balance_active);
$vd_server_logs = ereg_replace("[^NY]","",$vd_server_logs);
$agent_pause_codes_active = ereg_replace("[^NY]","",$agent_pause_codes_active);
$campaign_stats_refresh = ereg_replace("[^NY]","",$campaign_stats_refresh);
$disable_alter_custdata = ereg_replace("[^NY]","",$disable_alter_custdata);
$no_hopper_leads_logins = ereg_replace("[^NY]","",$no_hopper_leads_logins);

### ALPHA-NUMERIC ONLY ###
$PHP_AUTH_USER = ereg_replace("[^0-9a-zA-Z]","",$PHP_AUTH_USER);
$PHP_AUTH_PW = ereg_replace("[^0-9a-zA-Z]","",$PHP_AUTH_PW);
$script_id = ereg_replace("[^0-9a-zA-Z]","",$script_id);
$submit = ereg_replace("[^0-9a-zA-Z]","",$submit);
$campaign_cid = ereg_replace("[^0-9a-zA-Z]","",$campaign_cid);
$get_call_launch = ereg_replace("[^0-9a-zA-Z]","",$get_call_launch);
$campaign_recording = ereg_replace("[^0-9a-zA-Z]","",$campaign_recording);
$ADD = ereg_replace("[^0-9a-zA-Z]","",$ADD);
$dial_prefix = ereg_replace("[^0-9a-zA-Z]","",$dial_prefix);
$state_call_time_state = ereg_replace("[^0-9a-zA-Z]","",$state_call_time_state);
$scheduled_callbacks = ereg_replace("[^0-9a-zA-Z]","",$scheduled_callbacks);
$concurrent_transfers = ereg_replace("[^0-9a-zA-Z]","",$concurrent_transfers);
$billable = ereg_replace("[^0-9a-zA-Z]","",$billable);
$pause_code = ereg_replace("[^0-9a-zA-Z]","",$pause_code);
$vicidial_recording_override = ereg_replace("[^0-9a-zA-Z]","",$vicidial_recording_override);
$queuemetrics_log_id = ereg_replace("[^0-9a-zA-Z]","",$queuemetrics_log_id);

### DIGITS and Dots
$server_ip = ereg_replace("[^\.0-9]","",$server_ip);
$auto_dial_level = ereg_replace("[^\.0-9]","",$auto_dial_level);
$adaptive_maximum_level = ereg_replace("[^\.0-9]","",$adaptive_maximum_level);
$phone_ip = ereg_replace("[^\.0-9]","",$phone_ip);
$old_server_ip = ereg_replace("[^\.0-9]","",$old_server_ip);
$computer_ip = ereg_replace("[^\.0-9]","",$computer_ip);
$queuemetrics_server_ip = ereg_replace("[^\.0-9]","",$queuemetrics_server_ip);

### ALPHA-NUMERIC and spaces and hash and star and comma
$xferconf_a_dtmf = ereg_replace("[^ \,\*\#0-9a-zA-Z]","",$xferconf_a_dtmf);
$xferconf_b_dtmf = ereg_replace("[^ \,\*\#0-9a-zA-Z]","",$xferconf_b_dtmf);

### ALPHACAPS-NUMERIC
$xferconf_a_number = ereg_replace("[^0-9A-Z]","",$xferconf_a_number);
$xferconf_b_number = ereg_replace("[^0-9A-Z]","",$xferconf_b_number);

### ALPHA-NUMERIC and underscore and dash
$agi_output = ereg_replace("[^-\_0-9a-zA-Z]","",$agi_output);
$ASTmgrSECRET = ereg_replace("[^-\_0-9a-zA-Z]","",$ASTmgrSECRET);
$ASTmgrUSERNAME = ereg_replace("[^-\_0-9a-zA-Z]","",$ASTmgrUSERNAME);
$ASTmgrUSERNAMElisten = ereg_replace("[^-\_0-9a-zA-Z]","",$ASTmgrUSERNAMElisten);
$ASTmgrUSERNAMEsend = ereg_replace("[^-\_0-9a-zA-Z]","",$ASTmgrUSERNAMEsend);
$ASTmgrUSERNAMEupdate = ereg_replace("[^-\_0-9a-zA-Z]","",$ASTmgrUSERNAMEupdate);
$call_time_id = ereg_replace("[^-\_0-9a-zA-Z]","",$call_time_id);
$campaign_id = ereg_replace("[^-\_0-9a-zA-Z]","",$campaign_id);
$CoNfIrM = ereg_replace("[^-\_0-9a-zA-Z]","",$CoNfIrM);
$DBX_database = ereg_replace("[^-\_0-9a-zA-Z]","",$DBX_database);
$DBX_pass = ereg_replace("[^-\_0-9a-zA-Z]","",$DBX_pass);
$DBX_user = ereg_replace("[^-\_0-9a-zA-Z]","",$DBX_user);
$DBY_database = ereg_replace("[^-\_0-9a-zA-Z]","",$DBY_database);
$DBY_pass = ereg_replace("[^-\_0-9a-zA-Z]","",$DBY_pass);
$DBY_user = ereg_replace("[^-\_0-9a-zA-Z]","",$DBY_user);
$dial_method = ereg_replace("[^-\_0-9a-zA-Z]","",$dial_method);
$dial_status_a = ereg_replace("[^-\_0-9a-zA-Z]","",$dial_status_a);
$dial_status_b = ereg_replace("[^-\_0-9a-zA-Z]","",$dial_status_b);
$dial_status_c = ereg_replace("[^-\_0-9a-zA-Z]","",$dial_status_c);
$dial_status_d = ereg_replace("[^-\_0-9a-zA-Z]","",$dial_status_d);
$dial_status_e = ereg_replace("[^-\_0-9a-zA-Z]","",$dial_status_e);
$ext_context = ereg_replace("[^-\_0-9a-zA-Z]","",$ext_context);
$group_id = ereg_replace("[^-\_0-9a-zA-Z]","",$group_id);
$lead_filter_id = ereg_replace("[^-\_0-9a-zA-Z]","",$lead_filter_id);
$local_call_time = ereg_replace("[^-\_0-9a-zA-Z]","",$local_call_time);
$login = ereg_replace("[^-\_0-9a-zA-Z]","",$login);
$login_campaign = ereg_replace("[^-\_0-9a-zA-Z]","",$login_campaign);
$login_pass = ereg_replace("[^-\_0-9a-zA-Z]","",$login_pass);
$login_user = ereg_replace("[^-\_0-9a-zA-Z]","",$login_user);
$next_agent_call = ereg_replace("[^-\_0-9a-zA-Z]","",$next_agent_call);
$old_campaign_id = ereg_replace("[^-\_0-9a-zA-Z]","",$old_campaign_id);
$old_server_id = ereg_replace("[^-\_0-9a-zA-Z]","",$old_server_id);
$OLDuser_group = ereg_replace("[^-\_0-9a-zA-Z]","",$OLDuser_group);
$park_file_name = ereg_replace("[^-\_0-9a-zA-Z]","",$park_file_name);
$pass = ereg_replace("[^-\_0-9a-zA-Z]","",$pass);
$phone_login = ereg_replace("[^-\_0-9a-zA-Z]","",$phone_login);
$phone_pass = ereg_replace("[^-\_0-9a-zA-Z]","",$phone_pass);
$PHP_AUTH_PW = ereg_replace("[^0-9a-zA-Z]","",$PHP_AUTH_PW);
$PHP_AUTH_USER = ereg_replace("[^0-9a-zA-Z]","",$PHP_AUTH_USER);
$protocol = ereg_replace("[^-\_0-9a-zA-Z]","",$protocol);
$server_id = ereg_replace("[^-\_0-9a-zA-Z]","",$server_id);
$stage = ereg_replace("[^-\_0-9a-zA-Z]","",$stage);
$state_rule = ereg_replace("[^-\_0-9a-zA-Z]","",$state_rule);
$status = ereg_replace("[^-\_0-9a-zA-Z]","",$status);
$trunk_restriction = ereg_replace("[^-\_0-9a-zA-Z]","",$trunk_restriction);
$user = ereg_replace("[^-\_0-9a-zA-Z]","",$user);
$user_group = ereg_replace("[^-\_0-9a-zA-Z]","",$user_group);
$VICIDIAL_park_on_filename = ereg_replace("[^-\_0-9a-zA-Z]","",$VICIDIAL_park_on_filename);
$auto_alt_dial = ereg_replace("[^-\_0-9a-zA-Z]","",$auto_alt_dial);
$dial_status = ereg_replace("[^-\_0-9a-zA-Z]","",$dial_status);
$queuemetrics_eq_prepend = ereg_replace("[^-\_0-9a-zA-Z]","",$queuemetrics_eq_prepend);
$vicidial_agent_disable = ereg_replace("[^-\_0-9a-zA-Z]","",$vicidial_agent_disable);
$alter_custdata_override = ereg_replace("[^-\_0-9a-zA-Z]","",$alter_custdata_override);

### ALPHA-NUMERIC and spaces
$lead_order = ereg_replace("[^ 0-9a-zA-Z]","",$lead_order);
### ALPHA-NUMERIC and hash
$group_color = ereg_replace("[^\#0-9a-zA-Z]","",$group_color);

### ALPHA-NUMERIC and spaces dots, commas, dashes, underscores
$adaptive_dl_diff_target = ereg_replace("[^ \.\,-\_0-9a-zA-Z]","",$adaptive_dl_diff_target);
$adaptive_intensity = ereg_replace("[^ \.\,-\_0-9a-zA-Z]","",$adaptive_intensity);
$asterisk_version = ereg_replace("[^ \.\,-\_0-9a-zA-Z]","",$asterisk_version);
$call_time_comments = ereg_replace("[^ \.\,-\_0-9a-zA-Z]","",$call_time_comments);
$call_time_name = ereg_replace("[^ \.\,-\_0-9a-zA-Z]","",$call_time_name);
$campaign_name = ereg_replace("[^ \.\,-\_0-9a-zA-Z]","",$campaign_name);
$campaign_rec_filename = ereg_replace("[^ \.\,-\_0-9a-zA-Z]","",$campaign_rec_filename);
$company = ereg_replace("[^ \.\,-\_0-9a-zA-Z]","",$company);
$full_name = ereg_replace("[^ \.\,-\_0-9a-zA-Z]","",$full_name);
$fullname = ereg_replace("[^ \.\,-\_0-9a-zA-Z]","",$fullname);
$group_name = ereg_replace("[^ \.\,-\_0-9a-zA-Z]","",$group_name);
$HKstatus = ereg_replace("[^ \.\,-\_0-9a-zA-Z]","",$HKstatus);
$lead_filter_comments = ereg_replace("[^ \.\,-\_0-9a-zA-Z]","",$lead_filter_comments);
$lead_filter_name = ereg_replace("[^ \.\,-\_0-9a-zA-Z]","",$lead_filter_name);
$list_name = ereg_replace("[^ \.\,-\_0-9a-zA-Z]","",$list_name);
$local_gmt = ereg_replace("[^ \.\,-\_0-9a-zA-Z]","",$local_gmt);
$phone_type = ereg_replace("[^ \.\,-\_0-9a-zA-Z]","",$phone_type);
$picture = ereg_replace("[^ \.\,-\_0-9a-zA-Z]","",$picture);
$script_comments = ereg_replace("[^ \.\,-\_0-9a-zA-Z]","",$script_comments);
$script_name = ereg_replace("[^ \.\,-\_0-9a-zA-Z]","",$script_name);
$server_description = ereg_replace("[^ \.\,-\_0-9a-zA-Z]","",$server_description);
$status = ereg_replace("[^ \.\,-\_0-9a-zA-Z]","",$status);
$status_name = ereg_replace("[^ \.\,-\_0-9a-zA-Z]","",$status_name);
$wrapup_message = ereg_replace("[^ \.\,-\_0-9a-zA-Z]","",$wrapup_message);
$pause_code_name = ereg_replace("[^ \.\,-\_0-9a-zA-Z]","",$pause_code_name);
$campaign_description = ereg_replace("[^ \.\,-\_0-9a-zA-Z]","",$campaign_description);
$list_description = ereg_replace("[^ \.\,-\_0-9a-zA-Z]","",$list_description);

### ALPHA-NUMERIC and underscore and dash and slash and at and dot
$call_out_number_group = ereg_replace("[^-\.\:\/\@\_0-9a-zA-Z]","",$call_out_number_group);
$client_browser = ereg_replace("[^-\.\:\/\@\_0-9a-zA-Z]","",$client_browser);
$DBX_server = ereg_replace("[^-\.\:\/\@\_0-9a-zA-Z]","",$DBX_server);
$DBY_server = ereg_replace("[^-\.\:\/\@\_0-9a-zA-Z]","",$DBY_server);
$dtmf_send_extension = ereg_replace("[^-\.\:\/\@\_0-9a-zA-Z]","",$dtmf_send_extension);
$extension = ereg_replace("[^-\.\:\/\@\_0-9a-zA-Z]","",$extension);
$install_directory = ereg_replace("[^-\.\:\/\@\_0-9a-zA-Z]","",$install_directory);
$old_extension = ereg_replace("[^-\.\:\/\@\_0-9a-zA-Z]","",$old_extension);
$telnet_host = ereg_replace("[^-\.\:\/\@\_0-9a-zA-Z]","",$telnet_host);
$queuemetrics_dbname = ereg_replace("[^-\.\:\/\@\_0-9a-zA-Z]","",$queuemetrics_dbname);
$queuemetrics_login = ereg_replace("[^-\.\:\/\@\_0-9a-zA-Z]","",$queuemetrics_login);
$queuemetrics_pass = ereg_replace("[^-\.\:\/\@\_0-9a-zA-Z]","",$queuemetrics_pass);

### remove semi-colons ###
$lead_filter_sql = ereg_replace(";","",$lead_filter_sql);

### VARIABLES TO BE mysql_real_escape_string ###
# $web_form_address
# $queuemetrics_url
# $admin_home_url

### VARIABLES not filtered at all ###
# $script_text

}	# end of non_latin


##### END VARIABLE FILTERING FOR SECURITY #####


# AST GUI database administration
# admin.php
# 
# CHANGELOG:
# 50315-1110 - Added Custom Campaign Statuses
# 50317-1438 - Added Fronter Display var to inbound groups
# 50322-1355 - Added custom callerID per campaign
# 50517-1356 - Added user_groups sections and user_group to vicidial_users
# 50517-1440 - Added ability to logout (must click OK with empty user/pass)
# 50602-1622 - Added lead loader pages to load new files into vicidial_list
# 50620-1351 - Added custom vdad transfer AGI extension per campaign
# 50810-1414 - modified in groups to kick out spaces and dashes
# 50908-2136 - Added Custom Campaign HotKeys
# 50914-0950 - Fixed user search by user_group
# 50926-1358 - Modified to allow for language translation
# 50926-1615 - Added WeBRooTWritablE write controls
# 51020-1008 - Added editable web address and park ext - NEW dial campaigns
# 51020-1056 - Added fields and help for campaign recording control
# 51123-1335 - Altered code to function in php globals=off
# 51208-1038 - Added user_level changes, function controls and default user phones
# 51208-1556 - Added deletion of users/lists/campaigns/in groups/remote agents
# 51213-1706 - Added add/delete/modify vicidial scripts
# 51214-1737 - Added preview of vicidial script in popup window
# 51219-1225 - Added campaign and ingroups script selector and get_call_launch field
# 51222-1055 - Added am_message_exten to campaigns to allow for AM Message button
# 51222-1125 - Fixed new vicidial_campaigns default values not being assigned bug
# 51222-1156 - Added LOG OUT ALL AGENTS ON THIS CAMPAIGN button to campaign screen
# 60204-0659 - Fixed hopper reset bug
# 60207-1413 - Added AMD send to voicemail extension and xfer-conf dtmf presets
# 60213-1100 - Added several vicidial_users permissions fields
# 60215-1319 - Added On-hold CallBacks display and links
# 60227-1226 - Fixed vicidial_inbound_groups insert bug
# 60413-1308 - Fixed list display to have 1 row/status: count and time zone tables
#            - Added status name in selected dial statuses in campaign screen
# 60417-1416 - Added vicidial_lead_filters sections
#            - Changed the header links to color-coded sectional with sublinks below
#            - Added filter name and script name to campaign and in-group modify sections
#            - Added callback and alt dial options to campaigns section
#            - Added callback, alt dial and other options to users section
# 60419-1628 - Alter Callbacks display to include status and LIVE listings, reordered
# 60421-1441 - check GET/POST vars lines with isset to not trigger PHP NOTICES
# 60425-2355 - Added agent options to vicidial_users, reformatted user page
# 60502-1627 - Added drop_call_seconds and safe_harbor_ fields to campaign screen
# 60503-1228 - Added drop_call_seconds and drop_ fields to inbound groups screen
# 60505-1117 - Added initial framework for new local_call_times tables and definitions
# 60506-1033 - More revisions to the local_call_time section
# 60508-1354 - Finished call_times and state_call_times sections
#            - Added modify/delete options for call_times
# 60509-1311 - Functionalize campaign dialable leads calculation
#            - Change state_call_times selection from call_times to only allow one per state
#            - Added dialable leads count popup to campaign screen if auto-calc is disabled
#            - Added test dialable leads count popup to filter screen 
# 60510-1050 - Added Wrapup seconds and Wrapup message to campaigns screen
# 60608-1401 - Added allowable inbound_groups checkboxes to CLOSER campaign detail screen
# 60609-1051 - Added add-to-dnc in LISTS section
# 60613-1415 - Added lead recycling options to campaign detail screen
# 60619-1523 - Added variable filtering to eliminate SQL injection attack threat
# 60622-1216 - Fixed HotKey addition form issues and variable filtering
# 60623-1159 - Fixed Scheduled Callbacks over-filtering bug and filter_sql bug
# 60808-1147 - Changed filtering for and added instructions for consutative transfers
# 60816-1552 - Added allcalls_delay start delay for recordings in vicidial.php
# 60817-2226 - Fixed bug that would not allow lead recycling of non-selectable statuses
# 60821-1543 - Added option to Omit Phone Code while dialing in vicidial
# 60821-1625 - Added ALLFORCE recording option for campaign_recording
# 60823-1154 - Added fields for adaptive dialing
# 60824-1326 - Added adaptive_latest_target_gmt for ADAPT_TAPERED dial method
# 60825-1205 - Added adaptive_intensity for ADAPT_ dial methods
# 60828-1019 - Changed adaptive_latest_target_gmt to adaptive_latest_server_time
# 60828-1115 - Added adaptive_dl_diff_target and changed intensity dropdown
# 60927-1246 - Added astguiclient/admin.php functions under SERVERS tab
# 61002-1402 - Added fields for vicidial balance trunk controls
# 61003-1123 - Added functions for vicidial_server_trunks records
# 61109-1022 - Added Emergency VDAC Jam Clear function to Campaign Detail screen
# 61110-1502 - Add ability to select NONE in dial statuses, new list_id must not be < 100
# 61122-1228 - Added user group campaign restrictions
# 61122-1535 - Changed script_text to unfiltered and added more variables to SCRIPTS
# 61129-1028 - Added headers to Users and Phones with clickable order-by titles
# 70108-1405 - Added ADAPT OVERRIDE to allow for forced dial_level changes in ADAPT dial methods
#            - Screen width definable at top of script, merged server_stats into this script
# 70109-1638 - Added ALTPH2 and ADDR3 hotkey options for alt number dialing with HotKeys
# 70109-1716 - Added concurrent_transfers option to vicidial_campaigns
# 70115-1152 - Aded (CLOSER|BLEND|INBND|_C$|_B$|_I$) options for CLOSER-type campaigns
# 70115-1532 - Added auto_alt_dial field to campaign screen for auto-dialing of alt numbers
# 70116-1200 - Added auto_alt_dial_status functionality to campaign screen
# 70117-1235 - Added header formatting variables at top of script
#            - Moved Call Times and Phones/Server functions to Admin section
# 70118-1706 - Added new user group displays and links
# 70123-1519 - Added user permission settings for all sections
# 70124-1346 - Fixed spelling errors and formatting consistency
# 70202-1120 - Added agent_pause_codes section to campaigns
# 70205-1204 - Added memo, last dialed, timestamp and stats-refresh fields to vicidial_campaigns/lists
# 70206-1323 - Added user setting for vicidial_recording_override
# 70212-1412 - Added system settings section
# 70214-1226 - Added QueueMetrics Log ID field to system settings section
# 70219-1102 - Changed campaign dial statuses to be one string allowing for high limit
# 70223-0957 - Added queuemetrics_eq_prepend for custom ENTERQUEUE prepending of a field
# 70302-1111 - Fixed small bug in dialable leads calculation
# 70314-1133 - Added insert selection on script forms
# 70319-1423 - Added Alter Customer Data and agent disable display functions
# 70319-1625 - Added option to allow agents to login to outbound campaigns with no leads in the hopper
# 70322-1455 - Added sipsak messages parameters
# 70402-1157 - Added HOME link and entry to system_settings table, added QM link on reports section

# make sure you have added a user to the vicidial_users MySQL table with at least user_level 8 to access this page the first time

$admin_version = '2.0.95';
$build = '70402-1157';

$STARTtime = date("U");
$SQLdate = date("Y-m-d H:i:s");


if ($force_logout)
{
  if( (strlen($PHP_AUTH_USER)>0) or (strlen($PHP_AUTH_PW)>0) )
	{
    Header("WWW-Authenticate: Basic realm=\"VICI-PROJECTS\"");
    Header("HTTP/1.0 401 Unauthorized");
	}
    echo "Έχετε αποσυνδεθεί. Σας ευχαριστούμε\n";
    exit;
}

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

  if( (strlen($PHP_AUTH_USER)<2) or (strlen($PHP_AUTH_PW)<2) or ($auth<1))
	{
    Header("WWW-Authenticate: Basic realm=\"VICI-PROJECTS\"");
    Header("HTTP/1.0 401 Unauthorized");
    echo "Ακυρο Ονομα Χρήστη/Κωδικός Πρόσβασης: |$PHP_AUTH_USER|$PHP_AUTH_PW|\n";
    exit;
	}
  else
	{

	if($auth>0)
		{
		$office_no=strtoupper($PHP_AUTH_USER);
		$password=strtoupper($PHP_AUTH_PW);
			$stmt="SELECT * from vicidial_users where user='$PHP_AUTH_USER' and pass='$PHP_AUTH_PW';";
			$rslt=mysql_query($stmt, $link);
			$row=mysql_fetch_row($rslt);
			$LOGfullname				=$row[3];
			$LOGuser_level				=$row[4];
			$LOGuser_group				=$row[5];
			$LOGdelete_users			=$row[8];
			$LOGdelete_user_groups		=$row[9];
			$LOGdelete_lists			=$row[10];
			$LOGdelete_campaigns		=$row[11];
			$LOGdelete_ingroups			=$row[12];
			$LOGdelete_remote_agents	=$row[13];
			$LOGload_leads				=$row[14];
			$LOGcampaign_detail			=$row[15];
			$LOGast_admin_access		=$row[16];
			$LOGast_delete_phones		=$row[17];
			$LOGdelete_scripts			=$row[18];
			$LOGdelete_filters			=$row[29];
			$LOGalter_agent_interface	=$row[30];
			$LOGdelete_call_times		=$row[32];
			$LOGmodify_call_times		=$row[33];
			$LOGmodify_users			=$row[34];
			$LOGmodify_campaigns		=$row[35];
			$LOGmodify_lists			=$row[36];
			$LOGmodify_scripts			=$row[37];
			$LOGmodify_filters			=$row[38];
			$LOGmodify_ingroups			=$row[39];
			$LOGmodify_usergroups		=$row[40];
			$LOGmodify_remoteagents		=$row[41];
			$LOGmodify_servers			=$row[42];
			$LOGview_reports			=$row[43];

			$stmt="SELECT allowed_campaigns from vicidial_user_groups where user_group='$LOGuser_group';";
			$rslt=mysql_query($stmt, $link);
			$row=mysql_fetch_row($rslt);
			$LOGallowed_campaigns		=$row[0];

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

header ("Content-type: text/html; charset=utf-8");
echo "<html>\n";
echo "<head>\n";
echo "<!-- ΕΚΔΟΣΗ: $admin_version   ΔΗΜΙΟΥΡΓΙΑ: $build   ADD: $ADD   PHP_SELF: $PHP_SELF-->\n";
echo "<title>ΔΙΑΧΕΙΡΙΣΗ: ";

if (!isset($ADD))   {$ADD=0;}

if ($ADD==1)			{$hh='users';		echo "Πρόσθεσε Νέο Χρήστη";}
if ($ADD==11)			{$hh='campaigns';	echo "Πρόσθεσε Νέα Εκστρατεία";}
if ($ADD==111)			{$hh='lists';		echo "Πρόσθεσε Νέα Λίστα";}
if ($ADD==121)			{$hh='lists';		echo "Προσθέστε νέο DNC";}
if ($ADD==1111)			{$hh='ingroups';	echo "Πρόσθεσε Νέα Εισ-Ομάδα";}
if ($ADD==11111)		{$hh='remoteagent';	echo "Πρόσθεσε Νέους Απομακρυσμένους Χειριστές";}
if ($ADD==111111)		{$hh='usergroups';	echo "Πρόσθεσε Νέα Ομάδα Χρηστών";}
if ($ADD==1111111)		{$hh='scripts';		echo "Πρόσθεσε Νέο Βοηθό";}
if ($ADD==11111111)		{$hh='filters';		echo "Πρόσθεσε Φίλτρο";}
if ($ADD==111111111)	{$hh='admin';	$sh='times';	echo "Πρόσθεσε Νέο Χρόνο Κλήσης";}
if ($ADD==1111111111)	{$hh='admin';	$sh='times';	echo "Πρόσθεσε Νέο Χρόνο Κλήσης Κατάστασης";}
if ($ADD==11111111111)	{$hh='admin';	$sh='phones';	echo "ΠΡΟΣΘΕΣΕ ΝΕΟ ΤΗΛΕΦΩΝΟ";}
if ($ADD==111111111111)	{$hh='admin';	$sh='server';	echo "ΠΡΟΣΘΕΣΕ ΝΕΟ ΔΙΑΚΟΜΙΣΤΗ";}
if ($ADD==1111111111111)	{$hh='admin';	$sh='conference';	echo "ΠΡΟΣΘΕΣΕ ΝΕΑ ΣΥΝΔΙΑΛΕΞΗ";}
if ($ADD==11111111111111)	{$hh='admin';	$sh='conference';	echo "ADD NEW VICIDIAL CONFERENCE";}
if ($ADD==2)			{$hh='users';		echo "Προσθήκη Νέου Χρήστη";}
if ($ADD==21)			{$hh='campaigns';	echo "Προσθήκη Νέας Εκστρατείας";}
if ($ADD==22)			{$hh='campaigns';	echo "Προσθήκη Νέας Κατάστασης Εκστρατείας";}
if ($ADD==23)			{$hh='campaigns';	echo "New Εκστρατεία HotKey Addition";}
if ($ADD==25)			{$hh='campaigns';	echo "Νέα προσθήκη οδηγού ανακύκλωσης εκστρατείας";}
if ($ADD==26)			{$hh='campaigns';	echo "Νέα αυτόματη θέση πινάκων ALT";}
if ($ADD==27)			{$hh='campaigns';	echo "Νέος κώδικας μικρής διακοπής πρακτόρων";}
if ($ADD==28)			{$hh='campaigns';	echo "Θέση πινάκων εκστρατείας προστιθέμενη";}
if ($ADD==211)			{$hh='lists';		echo "Προσθήκη Νέας Λίστας";}
if ($ADD==2111)			{$hh='ingroups';	echo "Προσθήκη Νέας Εισ-Ομάδας";}
if ($ADD==21111)		{$hh='remoteagent';	echo "Προσθήκη Νέων Απομακρυσμένων Χειριστών";}
if ($ADD==211111)		{$hh='usergroups';	echo "Προσθήκη Νέας Ομάδας Χρηστών";}
if ($ADD==2111111)		{$hh='scripts';		echo "Νέα προσθήκη Βοηθού";}
if ($ADD==21111111)		{$hh='filters';		echo "Προσθήκη Νέου Φίλτρου";}
if ($ADD==211111111)	{$hh='admin';	$sh='times';	echo "Προσθήκη Νέου Χρόνου Κλήσης";}
if ($ADD==2111111111)	{$hh='admin';	$sh='times';	echo "Προσθήκη Νέου Χρόνου Κλήσης Κατάστασης";}
if ($ADD==21111111111)	{$hh='admin';	$sh='phones';	echo "ΠΡΟΣΘΗΚΗ ΝΕΟΥ ΤΗΛΕΦΩΝΟΥ";}
if ($ADD==211111111111)	{$hh='admin';	$sh='server';	echo "ΠΡΟΣΘΗΚΗ ΝΕΟΥ ΔΙΑΚΟΜΙΣΤΗ";}
if ($ADD==221111111111)	{$hh='admin';	$sh='server';	echo "ΠΡΟΣΘΕΤΕΙ ΝΕΑ ΕΓΓΡΑΦΗ ΕΞΥΠΗΡΕΤΗΤΗ ΚΟΡΜΟΥ";}
if ($ADD==2111111111111)	{$hh='admin';	$sh='conference';	echo "ΠΡΟΣΘΗΚΗ ΝΕΑΣ ΣΥΝΔΙΑΛΕΞΗΣ";}
if ($ADD==21111111111111)	{$hh='admin';	$sh='conference';	echo "ADDING NEW VICIDIAL CONFERENCE";}
if ($ADD==3)			{$hh='users';		echo "Τροποποίηση Χρήστη";}
if ($ADD==30)			{$hh='campaigns';	echo "Εκστρατεία δεν επιτρέπεται";}
if ($ADD==31)			{$hh='campaigns';	echo "Τροποποίηση Εκστρατείας";}
if ($ADD==34)			{$hh='campaigns';	echo "Τροποποίηση Εκστρατείας - Βασική Επισκόπηση";}
if ($ADD==311)			{$hh='lists';		echo "Τροποποίηση Λίστας";}
if ($ADD==3111)			{$hh='ingroups';	echo "Τροποποίηση Εισ-Ομάδων";}
if ($ADD==31111)		{$hh='remoteagent';	echo "Τροποποίηση Απομακρυσμένων Χειριστών";}
if ($ADD==311111)		{$hh='usergroups';	echo "Τροποποίηση Ομάδων Χρηστών";}
if ($ADD==3111111)		{$hh='scripts';		echo "Τροποποιήστε τον Βοηθό";}
if ($ADD==31111111)		{$hh='filters';		echo "Τροποποίηση Φίλτρου";}
if ($ADD==311111111)	{$hh='admin';	$sh='times';	echo "Τροποποίηση Χρόνου Κλήσης";}
if ($ADD==321111111)	{$hh='admin';	$sh='times';	echo "Τροποποίηση Λίστας Ορισμών Χρόνου Κλήσης Κατάστασης ";}
if ($ADD==3111111111)	{$hh='admin';	$sh='times';	echo "Τροποπίηση Χρόνου Κλήσης Κατάστασης";}
if ($ADD==31111111111)	{$hh='admin';	$sh='phones';	echo "ΤΡΟΠΟΠΟΙΗΣΕ ΤΗΛΕΦΩΝΟ";}
if ($ADD==311111111111)	{$hh='admin';	$sh='server';	echo "ΤΡΟΠΟΠΟΙΗΣΕ ΔΙΑΚΟΜΙΣΤΗ";}
if ($ADD==3111111111111)	{$hh='admin';	$sh='conference';	echo "ΤΡΟΠΟΠΟΙΗΣΕ ΣΥΝΔΙΑΛΕΞΗ";}
if ($ADD==31111111111111)	{$hh='admin';	$sh='conference';	echo "MODIFY VICIDIAL CONFERENCE";}
if ($ADD==311111111111111)	{$hh='admin';	$sh='settings';	echo "ΤΡΟΠΟΠΟΙΗΣΤΕ ΤΙΣ ΤΟΠΟΘΕΤΉΣΕΙΣ ΣΥΣΤΗΜΑΤΩΝ VICIDIAL";}
if ($ADD=="4A")			{$hh='users';		echo "Τροποποίηση Χρήστη - Admin";}
if ($ADD=="4B")			{$hh='users';		echo "Τροποποίηση Χρήστη - Admin";}
if ($ADD==4)			{$hh='users';		echo "Τροποποίηση Χρήστη";}
if ($ADD==41)			{$hh='campaigns';	echo "Τροποποίηση Εκστρατείας";}
if ($ADD==42)			{$hh='campaigns';	echo "Τροποποίηση Εκστρατείας Status";}
if ($ADD==43)			{$hh='campaigns';	echo "Τροποποίηση Εκστρατείας HotKey";}
if ($ADD==44)			{$hh='campaigns';	echo "Τροποποίηση Εκστρατείας - Βασική Επισκόπηση";}
if ($ADD==45)			{$hh='campaigns';	echo "Τροποποιήστε τον οδηγό εκστρατείας ανακύκλωσης";}
if ($ADD==47)			{$hh='campaigns';	echo "Τροποποιήστε τον κώδικα μικρής διακοπής πρακτόρων";}
if ($ADD==411)			{$hh='lists';		echo "Τροποποίηση Λίστας";}
if ($ADD==4111)			{$hh='ingroups';	echo "Τροποποίηση Εισ-Ομάδων";}
if ($ADD==41111)		{$hh='remoteagent';	echo "Τροποποίηση Απομακρυσμένων Χειριστών";}
if ($ADD==411111)		{$hh='usergroups';	echo "Τροποποίηση Ομάδων Χρηστών";}
if ($ADD==4111111)		{$hh='scripts';		echo "Τροποποιήστε τον Βοηθό";}
if ($ADD==41111111)		{$hh='filters';		echo "Τροποποίηση Φίλτρου";}
if ($ADD==411111111)	{$hh='admin';	$sh='times';	echo "Τροποποίηση Χρόνου Κλήσης";}
if ($ADD==4111111111)	{$hh='admin';	$sh='times';	echo "Τροποπίηση Χρόνου Κλήσης Κατάστασης";}
if ($ADD==41111111111)	{$hh='admin';	$sh='phones';	echo "ΤΡΟΠΟΠΟΙΗΣΕ ΤΗΛΕΦΩΝΟ";}
if ($ADD==411111111111)	{$hh='admin';	$sh='server';	echo "ΤΡΟΠΟΠΟΙΗΣΕ ΔΙΑΚΟΜΙΣΤΗ";}
if ($ADD==421111111111)	{$hh='admin';	$sh='server';	echo "ΤΡΟΠΟΠΟΙΗΣΗ ΕΓΓΡΑΦΗΣ ΕΞΥΠΗΡΕΤΗΤΗ ΚΟΡΜΟΥ";}
if ($ADD==4111111111111)	{$hh='admin';	$sh='conference';	echo "ΤΡΟΠΟΠΟΙΗΣΕ ΣΥΝΔΙΑΛΕΞΗ";}
if ($ADD==41111111111111)	{$hh='admin';	$sh='conference';	echo "MODIFY VICIDIAL CONFERENCE";}
if ($ADD==411111111111111)	{$hh='admin';	$sh='settings';	echo "ΤΡΟΠΟΠΟΙΗΣΤΕ ΤΙΣ ΤΟΠΟΘΕΤΉΣΕΙΣ ΣΥΣΤΗΜΑΤΩΝ VICIDIAL";}
if ($ADD==5)			{$hh='users';		echo "Delete User";}
if ($ADD==51)			{$hh='campaigns';	echo "Delete Εκστρατεία";}
if ($ADD==52)			{$hh='campaigns';	echo "Αποσυνδεμένοι Χειριστές";}
if ($ADD==53)			{$hh='campaigns';	echo "έκτακτης ανάγκης καθαρισμού VDAC";}
if ($ADD==511)			{$hh='lists';		echo "Delete List";}
if ($ADD==5111)			{$hh='ingroups';	echo "Delete In-Group";}
if ($ADD==51111)		{$hh='remoteagent';	echo "Διάγραψε τους Απομακρυσμένους Χειριστές";}
if ($ADD==511111)		{$hh='usergroups';	echo "Διάγραψε  τους χρήστες Group";}
if ($ADD==5111111)		{$hh='scripts';		echo "Διάγραψε τον Βοηθό";}
if ($ADD==51111111)		{$hh='filters';		echo "Διαγραφή Φίλτρου";}
if ($ADD==511111111)	{$hh='admin';	$sh='times';	echo "Διαγραφή Χρόνου Κλήσης";}
if ($ADD==5111111111)	{$hh='admin';	$sh='times';	echo "Διαγραφή Χρόνου Κλήσης Κατάστασης";}
if ($ADD==51111111111)	{$hh='admin';	$sh='phones';	echo "DELETE PHONE";}
if ($ADD==511111111111)	{$hh='admin';	$sh='server';	echo "DELETE SERVER";}
if ($ADD==5111111111111)	{$hh='admin';	$sh='conference';	echo "DELETE CONFERENCE";}
if ($ADD==51111111111111)	{$hh='admin';	$sh='conference';	echo "DELETE VICIDIAL CONFERENCE";}
if ($ADD==6)			{$hh='users';		echo "Delete User";}
if ($ADD==61)			{$hh='campaigns';	echo "Delete Εκστρατεία";}
if ($ADD==62)			{$hh='campaigns';	echo "Αποσυνδεμένοι Χειριστές";}
if ($ADD==63)			{$hh='campaigns';	echo "έκτακτης ανάγκης καθαρισμού VDAC";}
if ($ADD==65)			{$hh='campaigns';	echo "Διαγράψτε τον οδηγό ανακύκλωσης";}
if ($ADD==66)			{$hh='campaigns';	echo "Διαγράψτε την αυτόματη θέση πινάκων ALT";}
if ($ADD==67)			{$hh='campaigns';	echo "Διαγράψτε τον κώδικα μικρής διακοπής πρακτόρων";}
if ($ADD==68)			{$hh='campaigns';	echo "Θέση πινάκων εκστρατείας αφαιρούμενη";}
if ($ADD==611)			{$hh='lists';		echo "Delete List";}
if ($ADD==6111)			{$hh='ingroups';	echo "Delete In-Group";}
if ($ADD==61111)		{$hh='remoteagent';	echo "Διάγραψε τους Απομακρυσμένους Χειριστές";}
if ($ADD==611111)		{$hh='usergroups';	echo "Διάγραψε  τους χρήστες Group";}
if ($ADD==6111111)		{$hh='scripts';		echo "Διάγραψε τον Βοηθό";}
if ($ADD==61111111)		{$hh='filters';		echo "Διαγραφή Φίλτρου";}
if ($ADD==611111111)	{$hh='admin';	$sh='times';	echo "Διαγραφή Χρόνου Κλήσης";}
if ($ADD==6111111111)	{$hh='admin';	$sh='times';	echo "Διαγραφή Χρόνου Κλήσης Κατάστασης";}
if ($ADD==61111111111)	{$hh='admin';	$sh='phones';	echo "DELETE PHONE";}
if ($ADD==611111111111)	{$hh='admin';	$sh='server';	echo "DELETE SERVER";}
if ($ADD==621111111111)	{$hh='admin';	$sh='server';	echo "ΔΙΑΓΡΑΦΗ ΕΓΓΡΑΦΗΣ ΕΞΥΠΗΡΕΤΗΤΗ ΚΟΡΜΟΥ";}
if ($ADD==6111111111111)	{$hh='admin';	$sh='conference';	echo "DELETE CONFERENCE";}
if ($ADD==61111111111111)	{$hh='admin';	$sh='conference';	echo "DELETE VICIDIAL CONFERENCE";}
if ($ADD==73)			{$hh='campaigns';	echo "Μετρητής Κληθέντων Οδηγών";}
if ($ADD==7111111)		{$hh='scripts';		echo "Προεπισκόπιση Βοηθού";}
if ($ADD==0)			{$hh='users';		echo "Λίστα Χρηστών";}
if ($ADD==8)			{$hh='users';		echo "Επανακλήσεις μέσα στον χειριστή";}
if ($ADD==81)			{$hh='campaigns';	echo "Επανακλήσεις μέσα στην εκστρατεία";}
if ($ADD==811)			{$hh='lists';	echo "Επανακλήσεις μέσα στην λίστα";}
if ($ADD==8111)			{$hh='usergroups';	echo "CallBacks μέσα στην ομάδα χρηστών ";}
if ($ADD==10)			{$hh='campaigns';	echo "Εκστρατείες";}
if ($ADD==100)			{$hh='lists';		echo "Λίστες";}
if ($ADD==1000)			{$hh='ingroups';	echo "Εισ-Ομάδες";}
if ($ADD==10000)		{$hh='remoteagent';	echo "Απομακρυσμένοι Χειριστές";}
if ($ADD==100000)		{$hh='usergroups';	echo "Ομάδες Χρήστη";}
if ($ADD==1000000)		{$hh='scripts';		echo "Βοηθοί";}
if ($ADD==10000000)		{$hh='filters';		echo "Φίλτρα";}
if ($ADD==100000000)	{$hh='admin';	$sh='times';	echo "Χρόνοι Κλήσεων";}
if ($ADD==1000000000)	{$hh='admin';	$sh='times';	echo "";}
if ($ADD==10000000000)	{$hh='admin';	$sh='phones';	echo "ΛΙΣΤΑ ΤΗΛΕΦΩΝΟΥ";}
if ($ADD==100000000000)	{$hh='admin';	$sh='server';	echo "ΛΙΣΤΑ ΔΙΑΚΟΜΙΣΤΗ";}
if ($ADD==1000000000000)	{$hh='admin';	$sh='conference';	echo "ΛΙΣΤΑ ΣΥΝΔΙΑΛΕΞΕΩΝ";}
if ($ADD==10000000000000)	{$hh='admin';	$sh='conference';	echo "VICIDIAL ΛΙΣΤΑ ΣΥΝΔΙΑΛΕΞΕΩΝ";}
if ($ADD==550)			{$hh='users';		echo "Φόρμα Αναζήτησης";}
if ($ADD==551)			{$hh='users';		echo "ΑΝΑΖΗΤΗΣΗ ΤΗΛΕΦΩΝΩΝ";}
if ($ADD==660)			{$hh='users';		echo "Αποτελέσματα Αναζήτησης";}
if ($ADD==661)			{$hh='users';		echo "ΑΝΑΖΗΤΗΣΗ ΑΠΟΤΕΛΕΣΜΑΤΩΝ ΤΗΛΕΦΩΝΩΝ";}
if ($ADD==99999)		{$hh='users';		echo "ΒΟΗΘΕΙΑ";}
if ($ADD==999999)		{$hh='reports';		echo "ΑΝΑΦΟΡΕΣ";}

if ( ($ADD>9) && ($ADD < 99998) )
	{
	##### get scripts listing for dynamic pulldown
	$stmt="SELECT script_id,script_name from vicidial_scripts order by script_id";
	$rslt=mysql_query($stmt, $link);
	$scripts_to_print = mysql_num_rows($rslt);
	$scripts_list="<option value=\"\">NONE</option>\n";

	$o=0;
	while ($scripts_to_print > $o)
		{
		$rowx=mysql_fetch_row($rslt);
		$scripts_list .= "<option value=\"$rowx[0]\">$rowx[0] - $rowx[1]</option>\n";
		$scriptname_list["$rowx[0]"] = "$rowx[1]";
		$o++;
		}

	##### get filters listing for dynamic pulldown
	$stmt="SELECT lead_filter_id,lead_filter_name,lead_filter_sql from vicidial_lead_filters order by lead_filter_id";
	$rslt=mysql_query($stmt, $link);
	$filters_to_print = mysql_num_rows($rslt);
	$filters_list="<option value=\"\">NONE</option>\n";

	$o=0;
	while ($filters_to_print > $o)
		{
		$rowx=mysql_fetch_row($rslt);
		$filters_list .= "<option value=\"$rowx[0]\">$rowx[0] - $rowx[1]</option>\n";
		$filtername_list["$rowx[0]"] = "$rowx[1]";
		$filtersql_list["$rowx[0]"] = "$rowx[2]";
		$o++;
		}

	##### get call_times listing for dynamic pulldown
	$stmt="SELECT call_time_id,call_time_name from vicidial_call_times order by call_time_id";
	$rslt=mysql_query($stmt, $link);
	$times_to_print = mysql_num_rows($rslt);

	$o=0;
	while ($times_to_print > $o)
		{
		$rowx=mysql_fetch_row($rslt);
		$call_times_list .= "<option value=\"$rowx[0]\">$rowx[0] - $rowx[1]</option>\n";
		$call_timename_list["$rowx[0]"] = "$rowx[1]";
		$o++;
		}
	}

if ( ( (strlen($ADD)>4) && ($ADD < 99998) ) or ($ADD==3) or (($ADD>20) and ($ADD<70)) or ($ADD=="4A")  or ($ADD=="4B") or (strlen($ADD)==12) )
	{
	##### get server listing for dynamic pulldown
	$stmt="SELECT server_ip,server_description from servers order by server_ip";
	$rslt=mysql_query($stmt, $link);
	$servers_to_print = mysql_num_rows($rslt);
	$servers_list='';

	$o=0;
	while ($servers_to_print > $o)
		{
		$rowx=mysql_fetch_row($rslt);
		$servers_list .= "<option value=\"$rowx[0]\">$rowx[0] - $rowx[1]</option>\n";
		$o++;
		}

	##### get campaigns listing for dynamic pulldown
	$stmt="SELECT campaign_id,campaign_name from vicidial_campaigns order by campaign_id";
	$rslt=mysql_query($stmt, $link);
	$campaigns_to_print = mysql_num_rows($rslt);
	$campaigns_list='';

	$o=0;
	while ($campaigns_to_print > $o)
		{
		$rowx=mysql_fetch_row($rslt);
		$campaigns_list .= "<option value=\"$rowx[0]\">$rowx[0] - $rowx[1]</option>\n";
		$o++;
		}

	##### BEGIN get inbound groups listing for checkboxes #####
	if ( (($ADD>20) and ($ADD<70)) and ($ADD!=41) )
	{
	$stmt="SELECT closer_campaigns from vicidial_campaigns where campaign_id='$campaign_id';";
	$rslt=mysql_query($stmt, $link);
	$row=mysql_fetch_row($rslt);
	$closer_campaigns =	$row[0];
	$closer_campaigns = preg_replace("/ -$/","",$closer_campaigns);
	$groups = explode(" ", $closer_campaigns);
	}

	if ( (($ADD==31111) or ($ADD==31111)) and (count($groups)<1) )
	{
	$stmt="SELECT closer_campaigns from vicidial_remote_agents where remote_agent_id='$remote_agent_id';";
	$rslt=mysql_query($stmt, $link);
	$row=mysql_fetch_row($rslt);
	$closer_campaigns =	$row[0];
	$closer_campaigns = preg_replace("/ -$/","",$closer_campaigns);
	$groups = explode(" ", $closer_campaigns);
	}

	if ($ADD==3)
	{
	$stmt="SELECT closer_campaigns from vicidial_users where user='$user';";
	$rslt=mysql_query($stmt, $link);
	$row=mysql_fetch_row($rslt);
	$closer_campaigns =	$row[0];
	$closer_campaigns = preg_replace("/ -$/","",$closer_campaigns);
	$groups = explode(" ", $closer_campaigns);
	}

	$stmt="SELECT group_id,group_name from vicidial_inbound_groups order by group_id";
	$rslt=mysql_query($stmt, $link);
	$groups_to_print = mysql_num_rows($rslt);
	$groups_list='';
	$groups_value='';

	$o=0;
	while ($groups_to_print > $o)
		{
		$rowx=mysql_fetch_row($rslt);
		$group_id_value = $rowx[0];
		$group_name_value = $rowx[1];
		$groups_list .= "<input type=\"checkbox\" name=\"groups[]\" value=\"$group_id_value\"";
		$p=0;
		while ($p<100)
			{
			if ($group_id_value == $groups[$p]) 
				{
				$groups_list .= " CHECKED";
				$groups_value .= " $group_id_value";
				}
			$p++;
			}
		$groups_list .= "> $group_id_value - $group_name_value<BR>\n";
		$o++;
		}
	if (strlen($groups_value)>2) {$groups_value .= " -";}
	}
	##### END get inbound groups listing for checkboxes #####


	##### BEGIN get campaigns listing for checkboxes #####
	if ( ($ADD==211111) or ($ADD==311111) or ($ADD==411111) or ($ADD==511111) or ($ADD==611111) )
	{
		if ( ($ADD==211111) or ($ADD==311111) or ($ADD==511111) or ($ADD==611111) )
		{
		$stmt="SELECT allowed_campaigns from vicidial_user_groups where user_group='$user_group';";
		$rslt=mysql_query($stmt, $link);
		$row=mysql_fetch_row($rslt);
		$allowed_campaigns =	$row[0];
		$allowed_campaigns = preg_replace("/ -$/","",$allowed_campaigns);
		$campaigns = explode(" ", $allowed_campaigns);
		echo "<!--  $allowed_campaigns -->";
		}

	$campaigns_value='';
	$campaigns_list='<B><input type="checkbox" name="campaigns[]" value="-ALL-CAMPAIGNS-"';
		$p=0;
		while ($p<100)
			{
			if (eregi('ALL-CAMPAIGNS',$campaigns[$p])) 
				{
				$campaigns_list.=" CHECKED";
				$campaigns_value .= " -ALL-CAMPAIGNS- -";
				}
			$p++;
			}
	$campaigns_list.="> ALL-CAMPAIGNS - ΟΙ ΧΡΗΣΤΕΣ ΜΠΟΡΟΥΝ ΝΑ ΔΟΥΝ ΟΠΟΙΑΔΗΠΟΤΕ ΕΚΣΤΡΑΤΕΙΑ</B><BR>\n";

	$stmt="SELECT campaign_id,campaign_name from vicidial_campaigns order by campaign_id";
	$rslt=mysql_query($stmt, $link);
	$campaigns_to_print = mysql_num_rows($rslt);

	$o=0;
	while ($campaigns_to_print > $o)
		{
		$rowx=mysql_fetch_row($rslt);
		$campaign_id_value = $rowx[0];
		$campaign_name_value = $rowx[1];
		$campaigns_list .= "<input type=\"checkbox\" name=\"campaigns[]\" value=\"$campaign_id_value\"";
		$p=0;
		while ($p<100)
			{
			if ($campaign_id_value == $campaigns[$p]) 
				{
			#	echo "<!--  X $p|$campaign_id_value|$campaigns[$p]| -->";
				$campaigns_list .= " CHECKED";
				$campaigns_value .= " $campaign_id_value";
				}
		#	echo "<!--  O $p|$campaign_id_value|$campaigns[$p]| -->";
			$p++;
			}
		$campaigns_list .= "> $campaign_id_value - $campaign_name_value<BR>\n";
		$o++;
		}
	if (strlen($campaigns_value)>2) {$campaigns_value .= " -";}
	}
	##### END get campaigns listing for checkboxes #####


	if ( (strlen($ADD)==11) or (strlen($ADD)>12) )
	{
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



$NWB = " &nbsp; <a href=\"javascript:openNewWindow('$PHP_SELF?ADD=99999";
$NWE = "')\"><IMG SRC=\"help.gif\" WIDTH=20 HEIGHT=20 Border=0 ALT=\"ΒΟΗΘΕΙΑ\" ALIGN=TOP></A>";
######################
# ADD=99999 display the HELP SCREENS
######################

if ($ADD==99999)
{
echo "</title>\n";
echo "</head>\n";
echo "<BODY BGCOLOR=white marginheight=0 marginwidth=0 leftmargin=0 topmargin=0>\n";
echo "<CENTER>\n";
echo "<TABLE WIDTH=98% BGCOLOR=#E6E6E6 cellpadding=2 cellspacing=0><TR><TD ALIGN=LEFT><FONT FACE=\"ARIAL,HELVETICA\" COLOR=BLACK SIZE=4><B>ΔΙΑΧΕΙΡΙΣΗ: ΒΟΗΘΕΙΑ<BR></B></FONT><FONT FACE=\"ARIAL,HELVETICA\" COLOR=BLACK SIZE=2><BR><BR>\n";

?>
<B><FONT SIZE=3>VICIDIAL_ΧΡΗΣΤΕΣ ΠΙΝΑΚΑΣ</FONT></B><BR><BR>
<A NAME="vicidial_users-user">
<BR>
<B>ID Χρήστη -</B> Σε αυτό το πεδίο τοποθετείται ο αριθμός ID του χρήστη, μπορεί να είναι μεταξύ 2 και 8 ψηφία.

<BR>
<A NAME="vicidial_users-pass">
<BR>
<B>Κωδικός -</B> Σε αυτό το πεδίο τοποθετείται ο κωδικός του χρήστη στο VICIDIAL. Πρέπει να είναι τουλάχιστον 2 χαρακτήρες.

<BR>
<A NAME="vicidial_users-full_name">
<BR>
<B>Πλήρες Ονομα -</B> Αυτό το πεδίο είναι που μπορείτε να ορίσετε το πλήρες όνομα των χρηστών VICIDIAL. Πρέπει να είναι τουλάχιστον 2 χαρακτήρες.

<BR>
<A NAME="vicidial_users-user_level">
<BR>
<B>Επίπεδο Χρήστη -</B> Αυτός ο κατάλογος επιλογών είναι που μπορείτε να επιλέξετε το επίπεδο χρήστη των VICIDIAL χρηστών. Πρέπει να έχει επίπεδο 1 για να συνδεθεί στο σύστημα. Πρέπει να έχει επίπεδο μεγαλύτερο από 2 για να συνδεθεί ως closer. Πρέπει να έχει επίπεδο 8 ή μεγαλύερο για ενέργειες διαχειριστή.

<BR>
<A NAME="vicidial_users-user_group">
<BR>
<B>Ομάδα Χρήστη -</B> Αυτός ο κατάλογος επιλογών είναι που μπορείτε να επιλέξετε την ομάδα χρηστών που ανήκει ο χρήστης.

<BR>
<A NAME="vicidial_users-phone_login">
<BR>
<B>Σύνδεση Τηλεφώνου -</B> εδώ μπορείτε να θέσετε μία προκαθορισμένη σύνδεση τηλεφώνου κατά την είσοδο του χειριστή στο vicidial.php.

<BR>
<A NAME="vicidial_users-phone_pass">
<BR>
<B>Κωδικός Τηλεφώνου -</B> εδώ μπορείτε να θέσετε ένα προκαθορισμένο κωδικό τηλεφώνου κατά την είσοδο του χειριστή στο vicidial.php.

<BR>
<A NAME="vicidial_users-hotkeys_active">
<BR>
<B>Hot Keys ενεργός -</B> εάν θέσετε σε 1 αυτή την επιλογή, επιτρέπει στο χρήστη να χρησιμοποιήσει τα πλήκτρα γρήγορου τερματισμού vicidial.php.

<BR>
<A NAME="vicidial_users-agent_choose_ingroups">
<BR>
<B>Ο πράκτορας επιλέγει Ingroups -</B> εάν θέσετε σε 1 αυτή την επιλογή επιτρέπει στο χρήστη να επιλέξει τις εισ-ομάδες που θα λάβουν τις κλήσεις. Διαφορετικά ο Manager θα πρέπει να το θέσει αυτό στην σελίδα διαχείρισης.

<BR>
<A NAME="vicidial_users-closer_campaigns">
<BR>
<B>Εισερχόμενες Ομάδες -</B> Εδώ μπορείτε να επιλέξετε τις εισερχόμενες ομάδες που θέλετε να λαμβάνουν τις κλήσεις , εάν έχετε επιλέξει την εκστρατεία CLOSER.

<BR>
<A NAME="vicidial_users-scheduled_callbacks">
<BR>
<B>Προγραμματισμένες Επανακλήσεις -</B> Αυτή η επιλογή επιτρέπει στον χειριστή να τερματίσει μία κλήση ως CALLBK και να επιλέξει τα δεδομένα και την ώρα κατά την οποία ο οδηγός θα ξανα-ενεργοποιηθεί.

<BR>
<A NAME="vicidial_users-agentonly_callbacks">
<BR>
<B>Μόνο του Χρήστη Επανακλήσεις-</B> Αυτή η επιλογή επιτρέπει στον χρήστη να θέσει μία επανάκληση με τέτοιο τρόπο, ώστε μόνο αυτός να μπορεί να καλέσει τον πελάτη. Επίσης, επιτρέπει στον χρήστη να δει τις λίστες των επανακλήσεων και να τις καλέσει οποιαδήποτε στιγμή.

<BR>
<A NAME="vicidial_users-agentcall_manual">
<BR>
<B>Χειροκίνητη Κλήση Χρήστη -</B> Αυτή η επιλογή επιτρέπει στον χειριστή να καταχωρήσει χειροκίνητα ένα νέο οδηγό στο σύστημα και να τον καλέσε.

<BR>
<A NAME="vicidial_users-vicidial_recording">
<BR>
<B>Ηχογράφηση -</B> Αυτή η επιλογή μπορεί να απαγορεύσει σε έναν χειριστή να κάνει ηχογραφήσεις και θα πρέπει να ακολουθεί την διαδικασία ηχογράφησης της εκστρατείας.

<BR>
<A NAME="vicidial_users-vicidial_transfers">
<BR>
<B>Μεταφορές-</B> Αυτή η επιλογή μπορεί να απαγορεύσει σε έναν χειριστή να ανοίξει την διαδικασία μεταφορά-συνδιάσκεψη. Αν είναι απενεργοποιημένη, ο χρήστης δεν μπορεί να μεαφέρει κλήσεις ή να κάνει κλήση σε τρίτο.

<BR>
<A NAME="vicidial_users-closer_default_blended">
<BR>
<B>Πιό στενή προεπιλογή που συνδυάζεται -</B> αυτή η επιλογή προκαθορίζει απλά το συνδυασμένο τετραγωνίδιο σε μια ΠΙΟ ΣΤΕΝΉ οθόνη σύνδεσης.

<BR>
<A NAME="vicidial_users-vicidial_recording_override">
<BR>
<B>VICIDIAL συμπληρωματική προμήθεια καταγραφής -</B> αυτή η επιλογήθα αγνοήσει οποιο δήποτε η επιλογή είναι στην εκστρατεία για τηνκαταγραφή. Τα ΑΤΟΜΑ ΜΕ ΕΙΔΙΚΈΣ ΑΝΑΓΚΕΣ δεν θα αγνοήσουν τηρύθμιση καταγραφής εκστρατείας. Δεν θα θέσει εκτός λειτουργίαςΠΟΤΕ την καταγραφή στον πελάτη.  ONDEMAND είναι η προεπιλογήκαι επιτρέπει στον πράκτορα για να αρχίσει και να σταματήσει όπωςαπαιτείται.  ALLCALLS θα αρχίσει την καταγραφή στον πελάτηόποτε μια κλήση στέλνεται σε έναν πράκτορα.  ALLFORCE θααρχίσει την καταγραφή στον πελάτη όποτε μια κλήση στέλνεται σεέναν πράκτορα που δεν δίνει στον πράκτορα καμία επιλογή νασταματήσει. Για ALLCALLS και ALLFORCE υπάρχει μια επιλογή ναχρησιμοποιηθεί η καθυστέρηση καταγραφής για να περικόψει στιςπολύ σύντομα καταγραφές και recude το φορτίο συστημάτων.

<BR>
<A NAME="vicidial_users-alter_custdata_override">
<BR>
<B>Ο πράκτορας αλλάζει τη συμπληρωματική προμήθεια στοιχείωνπελατών -</B> αυτή η επιλογή θα αγνοήσει οποιος δήποτε η επιλογήείναι στην εκστρατεία για την αλλαγή των στοιχείων πελατών.NOT_ACTIVE θα χρησιμοποιήσει οποιου δήποτε που θέτει είναιπαρών για την εκστρατεία.  ALLOW_ALTER θα επιτρέψει πάντα τονπράκτορα να αλλάξει τα στοιχεία πελατών, η των οποίων ρύθμισηεκστρατείας είναι. Η προεπιλογή είναι NOT_ACTIVE.

<BR>
<A NAME="vicidial_users-alter_agent_interface_options">
<BR>
<B>Αλλάξτε τις επιλογές διεπαφών Χειριστών -</B> εάν θέσετε σε 1 αυτή την επιλογή, επιτρέπει στο διαχειριστή να τροποποιήσει τις επιλογές διεπαφών χειριστών στην admin.php.

<BR>
<A NAME="vicidial_users-delete_users">
<BR>
<B>Διαγραφή Χρηστών -</B> εάν θέσετε σε 1 αυτή την επιλογή, επιτρέπει στο χρήστη να διαγράψει άλλους χρήστες ίσου ή μικρότερου επιπέδου από το σύστημα.

<BR>
<A NAME="vicidial_users-delete_user_groups">
<BR>
<B>Διαγραφή Ομάδων Χρηστών -</B> εάν θέσετε σε 1 αυτή την επιλογή, επιτρέπει στο χρήστη να διαγράψει τις ομάδες χρηστών από το σύστημα.

<BR>
<A NAME="vicidial_users-delete_lists">
<BR>
<B>Διαγραφή Λιστών -</B> εάν θέσετε σε 1 αυτή την επιλογή, επιτρέπει στο χρήστη να διαγράψει τις λίστες από το σύστημα.

<BR>
<A NAME="vicidial_users-delete_campaigns">
<BR>
<B>Διαγραφή Εκστρατειών -</B> εάν θέσετε σε 1 αυτή την επιλογή, επιτρέπει στο χρήστη να διαγράψει τις εκστρατείες από το σύστημα.

<BR>
<A NAME="vicidial_users-delete_ingroups">
<BR>
<B>Διαγραφή Εισ-Ομάδων -</B> εάν θέσετε σε 1 αυτή την επιλογή, επιτρέπει στο χρήστη να διαγράψει τις Εισ-Ομάδες από το σύστημα.

<BR>
<A NAME="vicidial_users-delete_remote_agents">
<BR>
<B>Διαγράψτε τους Απομακρυσμένους Χειριστές -</B> εάν θέσετε σε 1 αυτή την επιλογή, επιτρέπει στο χρήστη να διαγράψει τους απομακρυσμένους χειριστές από το σύστημα.

<BR>
<A NAME="vicidial_users-load_leads">
<BR>
<B>Εισαγωγή Οδηγών -</B> εάν θέσετε σε 1 αυτή την επιλογή, επιτρέπει στο χρήστη να εισάγει τους οδηγούς στον πίνακα vicidial_list μέσω του βασισμένου σε Ιστοσελίδα Εισαγωγέα οδηγών.

<BR>
<A NAME="vicidial_users-campaign_detail">
<BR>
<B>Λεπτομέρειες Εκστρατείας -</B> εάν θέσετε σε 1 αυτή την επιλογή, επιτρέπει στο χρήστη να δει και να τροποποιήσει τα λεπτομερή στοιχεία της εκστρατείας.

<BR>
<A NAME="vicidial_users-ast_admin_access">
<BR>
<B>AGC Πρόσβαση Διαχειριστή -</B> εάν θέσετε σε 1 αυτή την επιλογή, επιτρέπει στο χρήστη να συνδεθεί στις σελίδες του astGUIclient ως διαχειριστής.

<BR>
<A NAME="vicidial_users-ast_delete_phones">
<BR>
<B>AGC διαγραφή τηλεφώνων -</B> εάν θέσετε σε 1 αυτή την επιλογή, επιτρέπει στο χρήστη να διαγράψει τα τηλέφωνα στις σελίδες του διαχειριστή του astGUIclient.

<BR>
<A NAME="vicidial_users-delete_scripts">
<BR>
<B>Διαγραφή Βοηθού -</B> εάν θέσετε σε 1 αυτή την επιλογή, επιτρέπει στο χρήστη να διαγράψει τους οδηγούς της εκστρατείας .

<BR>
<A NAME="vicidial_users-modify_leads">
<BR>
<B>Τροποποιήστε τους οδηγούς -</B> αυτή η επιλογή εάν τη θέσετε σε 1, επιτρέπει στο χρήστη να τροποποιήσει τους οδηγούς στη σελίδα αποτελεσμάτων αναζήτησης οδηγών.

<BR>
<A NAME="vicidial_users-change_agent_campaign">
<BR>
<B>Αλλαγή Εκστρατείας Χειριστού -</B> εάν θέσετε σε 1 αυτή την επιλογή, επιτρέπει στο χρήστη να αλλάξει την εκτρατεία όπου ένας πράκτορας έχει συνδεθεί .

<BR>
<A NAME="vicidial_users-delete_filters">
<BR>
<B>Διαγραφή Φίλτρων -</B> Αυτή η επιλογή επιτρέπει στον χειριστή να διαγράφει φίλτρα από το σύστημα.

<BR>
<A NAME="vicidial_users-delete_call_times">
<BR>
<B>Διαγραφή Χρόνων Κλήσεων -</B> Αυτή η επιλογή επιτρέπει στον χρήστη να διαγράφει εγγραφές χρόνων κλήσεων και καταστάσεων από το σύστημα.

<BR>
<A NAME="vicidial_users-modify_call_times">
<BR>
<B>Τροποποίηση Χρόνων Κλήσεων -</B> Αυτή η επιλογή επιτρέπει στον χρήστη εμφανίσει και να τροποποιήσει τους χρόνους κλήσεων και τις εγγραφές χρόνων κλήσεων κατάστασης. Δεν χρειάζεται να είναι ενεργή αυτή η επιλογή εάν μόνο χρειάζεται η αλλαγή της επιλογής των χρόνων κλήσεων στην οθόνη των εκστρατειών.

<BR>
<A NAME="vicidial_users-modify_sections">
<BR>
<B>Τροποποιήστε τα τμήματα -</B> αυτές οι επιλογές επιτρέπουν στοχρήστη για να δουν και να τροποποιήσουν κάθε ένας αρχείατμημάτων. Εάν θέστε 0, ο χρήστης θα είναι σε θέση ναδει τον κατάλογο τμημάτων, αλλά όχι την οθόνηλεπτομέρειας ή τροποποίησης ενός αρχείου σε εκείνο το τμήμα.

<BR>
<A NAME="vicidial_users-view_reports">
<BR>
<B>Εκθέσεις άποψης -</B> αυτή η επιλογή επιτρέπει στο χρήστη για να δειτις εκθέσεις VICIDIAL.




<BR><BR><BR><BR>

<B><FONT SIZE=3>VICIDIAL_CAMPAIGNS ΠΙΝΑΚΑΣ</FONT></B><BR><BR>
<A NAME="vicidial_campaigns-campaign_id">
<BR>
<B>ID Εκστρατείας -</B> Αυτό είναι το σύντομο όνομα της εκστρατείας, δεν μπορεί να διορθωθεί μετά από την αρχική παράδοση, δεν μπορεί να περιέχει κενά και πρέπει να είναι μεταξύ 2 και 8 χαρακτήεςh.

<BR>
<A NAME="vicidial_campaigns-campaign_name">
<BR>
<B>Ονομα Εκστρατείας -</B> Αυτό είναι η περιγραφή της εκστρατείας, πρέπει να είναι μεταξύ 6 και 40 χαρακτήρες.

<BR>
<A NAME="vicidial_campaigns-campaign_description">
<BR>
<B>Περιγραφή εκστρατείας -</B> αυτό είναι ένας τομέας υπομνημάτων γιατην εκστρατεία, είναι προαιρετικό και μπορεί να είναι έναμέγιστο 255 χαρακτήρων στο μήκος.

<BR>
<A NAME="vicidial_campaigns-campaign_changedate">
<BR>
<B>Ημερομηνία αλλαγής εκστρατείας -</B> αυτό είναι η τελευταία φοράότι οι τοποθετήσεις για αυτήν την εκστρατεία τροποποιήθηκαν απόκαμιά άποψη.

<BR>
<A NAME="vicidial_campaigns-campaign_logindate">
<BR>
<B>Τελευταία ημερομηνία σύνδεσης εκστρατείας -</B> αυτό είναι ητελευταία φορά ότι ένας πράκτορας καταγράφηκε σε αυτήν τηνεκστρατεία.

<BR>
<A NAME="vicidial_campaigns-campaign_stats_refresh">
<BR>
<B>Η εκστρατεία Stats αναζωογονεί -</B> αυτό το τετραγωνίδιο θαεπιτρέψει ότι για να αναγκάσετε τα vicidial statsαναζωογονείτε, ακόμα κι αν η εκστρατεία δεν είναι ενεργός.

<BR>
<A NAME="vicidial_campaigns-active">
<BR>
<B>Ενεργοποίηση -</B> Εδώ μπορείτε να θέσετε την εκστρατεία ενεργή ή μη ενεργή. Εάν είναι μη ενεργή, κανένας δεν μπορεί να συνδεθεί σε αυτήν.

<BR>
<A NAME="vicidial_campaigns-park_ext">
<BR>
<B>Τηλ.Σύνδεση Στάθμευσης -</B> Εδώ μπορείτε να ορίσετε την μουσική αναμονής για το VICIDIAL. Επιβεβαιώστε, ότι η εσωτ.σύνδεση βρίσκεται στο extensions.conf και ότι δείχνει το αρχείο παρακάτω.

<BR>
<A NAME="vicidial_campaigns-park_file_name">
<BR>
<B>ν Αρχείου Στάθμευσης -</B> Εδώ μπορείτε να προσαρμόσετε την μουσική αναμονής για το VICIDIAL. Επιβεβαιώστε ότι το αρχείο έχει 10 χαρακτήρες ή λιγότερους και ότι το αρχείο βρίσκεται στον κατάλογο /var/lib/asterisk/sounds.

<BR>
<A NAME="vicidial_campaigns-web_form_address">
<BR>
<B>Ιστοσελίδα -</B> Αυτή είναι η προσαρμοσμένη διεύθυνση που θα σας κατευθύνει για κλήσεις που έρχονται σε αυτήν την ομάδα.

<BR>
<A NAME="vicidial_campaigns-allow_closers">
<BR>
<B>Επιτρέπει τους Closers -</B> Εδώ ορίζετε εάν οι χρήστες της εκστρατείας θα έχουν την επιλογή να στείλουν την κλήση σε έναν closer.

<BR>
<A NAME="vicidial_campaigns-dial_status">
<BR>
<B>Κατάσταση Κλήσης -</B> Εδώ ορίζετε τις καταστάσεις που θέλετε να κληθούν μέσα στις λίστες, οι οποίες είναι ενεργές για   την εκστρατεία παρακάτω. Να προσθέσει μια άλλη θέση στον πίνακα, να το επιλέξει από τονεξελισσόμενους κατάλογο και τον κρότο ΠΡΟΣΘΕΤΕΙ. Για να αφαιρέσετεμια από τις θέσεις πινάκων, χτυπήστε στη REMOVE σύνδεση δίπλαστη θέση που θέλετε να αφαιρέσετε.

<BR>
<A NAME="vicidial_campaigns-lead_order">
<BR>
<B>Ταξινόμηση Λίστας -</B> Σε αυτόν τον κατάλογο επιλογών μπορείτε να επιλέξετε πώς οι οδηγοί, που ταιριάζουν με τις καταστάσεις που επιλέξατε παραπάνω, θα τοποθετηθούν στον hopper:
 <BR> &nbsp; - DOWN: επιλογή των πρώτων οδηγών που εισήχθησαν στον πίνακα vicidial_list
 <BR> &nbsp; - UP: επιλογή των τελευταίων οδηγών που εισήχθησαν στον πίνακα vicidial_list
 <BR> &nbsp; - UP PHONE: επιλογή του υψηλότερου τηλεφωνικού αριθμού και συνεχίζει προς τα κάτω
 <BR> &nbsp; - DOWN PHONE: επιλογή του χαμηλότερου τηλεφωνικού αριθμού και συνεχίζει προς τα πάνω
 <BR> &nbsp; - UP LAST NAME: έναρξη με τα επίθετα να ξεκινάνε με Ζ και συνεχίζει προς τα κάτω
 <BR> &nbsp; - DOWN LAST NAME: έναρξη με τα επίθετα να ξεκινάνε με Α και συνεχίζει προς τα πάνω
 <BR> &nbsp; - UP COUNT: έναρξη με τους λιγότερους σε κλήση οδηγούς και συνεχίζει προς τα κάτω
 <BR> &nbsp; - DOWN COUNT: έναρξη με τους λιγότερους σε κλήση οδηγούς και συνεχίζει
 <BR> &nbsp; - DOWN COUNT 2nd NEW: έναρξη με τους λιγότερους σε κλήση οδηγούς και συνεχίζει προς τα πάνω με την εισαγωγή ενός ΝΕΟΥ οδηγού για κάθε άλλο οδηγό - Πρέπει να ΜΗΝ έχει νέα επιλεγμένα στις καταστάσεις κλήσεων
 <BR> &nbsp; - DOWN COUNT 3nd NEW: έναρξη με τους λιγότερους σε κλήση οδηγούς και συνεχίζει προς τα πάνω με την εισαγωγή ενός ΝΕΟΥ οδηγού για κάθε τρίτο οδηγό - Πρέπει να ΜΗΝ έχει νέα επιλεγμένα στις καταστάσεις κλήσεων
 <BR> &nbsp; - DOWN COUNT 4th NEW: έναρξη με τους λιγότερους σε κλήση οδηγούς και συνεχίζει προς τα πάνω με την εισαγωγή ενός ΝΕΟΥ οδηγού για κάθε τέταρτο οδηγό - Πρέπει να ΜΗΝ έχει νέα επιλεγμένα στις καταστάσεις κλήσεων

<BR>
<A NAME="vicidial_campaigns-hopper_level">
<BR>
<B>Επίπεδο Hopper -</B> Αυτό είναι το πόσους οδηγούς η διαδικασία VDhopper, προσπαθεί να διατηρήσει στον πίνακα vicidial_hopper για αυτήν την εκστρατεία. Εάν η διαδικασία VDhopper τρέχει κάθε λεπτό, ρυθμίστε αυτό λίγο περισσότερο από τον αριθμό των οδηγών που περνούν σε ένα λεπτό.

<BR>
<A NAME="vicidial_campaigns-lead_filter_id">
<BR>
<B>Φίλτρο Οδηγοιύ -</B> αυτή είναι μία μέθοδος για να δημιουργήτε φίλτρα για την SQL ερώτηση. Χρησιμοποιήστε αυτό το χαρακτηριστικό με προσοχή, είναι εύκολο να σταματήσει το σύστημα με μία μικρή αλλαγή στη δήλωση SQL. Η προεπιλογή είναι ΚΑΜΙΑ.

<BR>
<A NAME="vicidial_campaigns-force_reset_hopper">
<BR>
<B>Υποχρεωτική Επαναφορά του Hopper -</B> Αυτό σας επιτρέπει καθαρίσετε τα περιεχόμενα κατά την επιβεβαίωση της φόρμας. Αυτό θα συμβεί πάλι όταν η διαδικασία VDhopper θα τρέξει.

<BR>
<A NAME="vicidial_campaigns-dial_method">
<BR>
<B>Μέθοδος Κλήσης
 -</B> This field is the way to define how dialing is to take place. If MANUAL then the auto_dial_level will be locked at 0 unless Μέθοδος Κλήσης
 is changed. If RATIO then the normal dialing a number of lines for Active agents. ADAPT_HARD_LIMIT will dial predictively up to the dropped percentage and then not allow aggressive dialing once the drop limit is reached until the percentage goes down again. ADAPT_TAPERED allows for running over the dropped percentage in the first half of the shift -as defined by call_time selected for campaign- and gets more strict as the shift goes on. ADAPT_AVERAGE tries to maintain an average or the dropped percentage not imposing hard limits as aggressively as the other two methods. Δεν μπορείτε να αλλάξετε το επίπεδο Αυτόματης Κλήσης, εάν έχετε ορίσει κάποια μέθοδο Προσαρμογής Κλήσεων. Μόνο ο διακομιστής μπορεί να το αλλάξει όταν είναι σε διαδικασία αυτόματων κλήσεων.
.

<BR>
<A NAME="vicidial_campaigns-auto_dial_level">
<BR>
<B>Επίπεδο Αυτόματης Κλήσης -</B> Εδώ είναι που καθορίζεται πόσες γραμμές θα χρησιμοποιούνται ανά ενεργό χρήστη. Μηδέν (0) σημαίνει ότι η αυτόματη κλήση είναι μη ενεργή και οι χρήστες πατούν το πλήκτρο για την κλήση κάθε αριθμού. Διαφορετικά, το σύστημα καλεί γραμμές ίσες με τους ενεργούς χρήστες, πολλαπλασιασμένους με το επίπεδο κλήσης και σύμφωνα με το πόσες γραμμές η εκστρτεία σε κάθε διακομιστή επιτρέπει. Το ADAPT τετραγωνίδιο ΣΥΜΠΛΗΡΩΜΑΤΙΚΗΣ ΠΡΟΜΉΘΕΙΑΣ επιτρέπει σεσας για να αναγκάσει ένα νέο επίπεδο πινάκων ακόμα κι αν ημέθοδος πινάκων είναι σε έναν ADAPT τρόπο. Αυτό είναιχρήσιμο εάν υπάρχει μια δραματική μετατόπιση στην ποιότητα τωνμολύβδων και θέλετε να αλλάξετε δραστικά το dial_level με τοχέρι.

<BR>
<A NAME="vicidial_campaigns-available_only_ratio_tally">
<BR>
<B>Διαθέσιμα μόνο ετικέτες  -</B> Εάν θέσετε σε Ν αυτό το πεδίο, θα αφήσει εκτός τις καταστάσεις των χειριστών out INCALL και QUEUE, καθώς υπολογίζεται ο αριθμός των κλήσεων όταν δεν είναι σε κατάσταση κλήσης MANUAL. Προκαθορισμένα είναι Ο.

<BR>
<A NAME="vicidial_campaigns-adaptive_dropped_percentage">
<BR>
<B>Ποσοστό Ορίου Εγκατ. Κλήσεων -</B> Σε αυτό το πεδίο μπορείτε να θέσετε το όριο του ποσοστού εγκατ. κλήσεων καθώς χρησιμοποιείτε μία μέθοδος προσαρμοσμένης-πρόβλεψη κλήσεων, όχι MANUAL ή RATIO.

<BR>
<A NAME="vicidial_campaigns-adaptive_maximum_level">
<BR>
<B>Μέγιστο Επίπεδο Προσαρμογής Κλήσεων -</B> Σε αυτό το πεδίο μπορείτε να θέσετε το όριο για το όριο του αριθμού γραμμών για κάθε χειριστή καθώς χρησιμοποιείτε μία μέθοδος προσαρμοσμένης-πρόβλεψη κλήσεων, όχι MANUAL ή RATIO. Αυτός ο αριθμός μπορεί να είναι μεγαλύτερος από το επίπεδο αυτόματης κλήσης εάν το υλικό σας το υποστηρίζει. Η τιμή πρέπει να είναι θετικός αριθμός μεγαλύτερος από ένα και μπορεί να έχει δεκαδικά. Προκαθορισμένα είναι 3.0.

<BR>
<A NAME="vicidial_campaigns-adaptive_latest_server_time">
<BR>
<B>Τελευταίος Χρόνος Διακομιστή -</B> Αυτό το πεδίο χρησιμοποιείτε μόνο από την μέθοδο ADAPT_TAPERED. Θα πρέπει να καταχωρήσετε την ώρα και τα λεπτά που θα σταματήσει τις κλήσεις η εκστρατεία. Αυτό επιτρέπει στον αλγόριθμο να αποφασίσει πόσο επιθετικά θα κάνει κλήσεις και πόσο χρόνο.

<BR>
<A NAME="vicidial_campaigns-adaptive_intensity">
<BR>
<B>Ενταση Τροποποίησης Προσαρμογής -</B> Αυτό το πεδίο χρησιμοποιείτε για να αλλάζει ένταση προβλέψεων είτε υψηλότερα ή χαμηλότερα. Προκαθορισμένα είναι 0. Αυτό το πεδίο δεν χρησιμοποιείται από τις μεθόδους  MANUAL ή RATIO.

<BR>
<A NAME="vicidial_campaigns-adaptive_dl_diff_target">
<BR>
<B>Επίπεδο Κλήσεων Μεταβολής Στόχου -</B> Αυτό το πεδίο χρησιμοποιείτε για να έχει στόχο ένα συγκεκριμένο αριθμό χειριστών να περιμένουν κλήσεις ή κλήσεις να περιμένουν για χειριστές. Π.χ. εάν θέλετε πάντα να έχετε κατά μέσο όρο έναν χειριστή ελεύθερο για ν παίρνει τις κλήσεις, τότε πρέπει να το θέσετε σε -1. Εάν στόχος είναι να έχετε πάντα μία κλήση σε αναμονή για ένα χειριστή, τότε πρέπει να το θέσετε σε 1. Προκαθορισμένα είναι 0. Αυτό το πεδίο δεν χρησιμοποιείται από τις μεθόδους  MANUAL ή RATIO.

<BR>
<A NAME="vicidial_campaigns-concurrent_transfers">
<BR>
<B>Ταυτόχρονες μεταφορές -</B> αυτή η ρύθμιση χρησιμοποιείται για νακαθορίσει τον αριθμό κλήσεων που μπορεί να σταλεί στουςπράκτορες συγχρόνως. Συνιστάται αυτή η ρύθμιση να αφήνεται στοΑΥΤΟΚΙΝΗΤΟ. Αυτός ο τομέας δεν χρησιμοποιείται με τη ΧΕΙΡΩΝΑΚΤΙΚΗμέθοδο πινάκων.

<BR>
<A NAME="vicidial_campaigns-auto_alt_dial">
<BR>
<B>Αυτόματος ALT-ARJCMO'S που σχηματίζει -</B> αυτή η ρύθμισηχρησιμοποιείται για να σχηματίσει αυτόματα τους εναλλάσσομαιτομείς αριθμού σχηματίζοντας σε ΑΝΑΛΟΓΙΑ και ΝΑ ΠΡΟΣΑΡΜΟΣΕΙ τιςμεθόδους πινάκων όταν δεν υπάρχει καμία επαφή στον κύριοτηλεφωνικό αριθμό για έναν μόλυβδο, τις θέσεις NA, β,συνεχούς ρεύματος και ν. Αυτή η ρύθμιση δεν χρησιμοποιείται με τηΧΕΙΡΩΝΑΚΤΙΚΗ μέθοδο πινάκων.

<BR>
<A NAME="vicidial_campaigns-next_agent_call">
<BR>
<B>Επόμενη Κλήση Χρήστη -</B> Αυτό προσδιορίζει ποιος χρήστης λαμβάνει την επόμενη κλήση που είναι διαθέσιμη:
 <BR> &nbsp; - random: ταξινομημένο με τυχαία τιμή ενημέρωσης στον πίνακα vicidial_live_agents
 <BR> &nbsp; - oldest_call_start: ταξινομημένο με την τελευταία φορά που σε ένα χρήστη στάλθηκε  μία κλήση. Με αποτέλεσμα, ο χρήστης να λαμβάνει συνολικά το ίδιο αριθό κλήσεων.
 <BR> &nbsp; - oldest_call_finish: ταξινομημένο με την τελευταία φορά που ένας χρήστης τελείωσε μία κλήση. Ο χρήστης που περιμένει περισσότερο λαμβάνει την πρώτη κλήση.
 <BR> &nbsp; - overall_user_level: οι διαταγές από το user_level του χειριστή όπως καθορίζεται στα vicidial_users παρουσιάζουν ένα υψηλότερο user_level θα άβουν περισσότερες κλήσεις.

<BR>
<A NAME="vicidial_campaigns-local_call_time">
<BR>
<B>Τοπική Ωρα Κλήσης -</B> Εδώ, μπορείτε να ορίσετε τις ώρες που θα θέλατε να γίνουν οι κλήσεις. Αυτό ελέγχετε από τον κωδικό περις και ρυθμίζεται για Daylight Savings εάν είναι εφαρμόσιμο.

<BR>
<A NAME="vicidial_campaigns-dial_timeout">
<BR>
<B>Κλήση Εκτός Χρόνου -</B> άν έχει οριστεί, οι κλήσεις που φυσιολογικά θα έκλειναν μετά το χρόνο που έχει οριστεί στο extensions.conf, θα κλείσουν σε αυτόν τον χρόνο εάν είναι μικρότερος του extensions.conf. Αυτό επιτρέπει στην γρήγορη αλλαγή των χρόνων από διακομιστή σε διακομιστή και περιορίζοντας τα αοτελέσματα σε μία εκστρατεία. Εάν έχετε πολλές κλήσεις με Αυτόματους Τηλεφωνητές ή Φωνητικών Ταχυδρομείων, μπορείτε να αλλάξετε αυτή την τιμή μεταξύ 21-26 και να δείτε αν τα αποτελέσματα είναι καλύτερα.

<BR>
<A NAME="vicidial_campaigns-dial_prefix">
<BR>
<B>Πρόθεμα Κλήσης -</B> Αυτό το ο επιτρέπει την πιο εύκολη αλλαγή της διαδρομής της κλήσης να βγει έξω μέσω διαφορετικής μεθόδου, χωρίς να γίνει επαναφόρτωση στο Asterisk. Προκαθορισμένο είναι το 9 βασισμένο σύμφωνα με το 91NXXNXXXXXX στο σχέδιο κλήσεων - extensions.conf.

<BR>
<A NAME="vicidial_campaigns-omit_phone_code">
<BR>
<B>Παράλειψη Κωδικού Τηλεφώνου -</B> Αυτό το πεδίο σας επιτρέπει  να αφήσετε εκτός το πεδίο phone_code καθώς γίνονται οι κλήσεις. Προκαθορισμένα είναι Ο.

<BR>
<A NAME="vicidial_campaigns-campaign_cid">
<BR>
<B>CallerID Εκστρατείας -</B> Αυτός ο τομέας επιτρέπει την αποστολή ενός αριθμού συνήθειας callerid στις εξερχόμενες κλήσεις. Αυτό είναι ο αριθμός που θα παρουσίαζε στο callerid του προσώπου που καλείτε. Η προεπιλογή είναι ΑΓΝΩΣΤΗ. Εάν χρησιμοποιείτε το T1 ή Eί να σχηματίσει έξω αυτήν την επιλογή είναι μόνο διαθέσιμος εάν χρησιμοποιετε PRIs - ISDN Tί ή Eί - που ανοίγουν το χαρακτηριστικό γνώρισμα συνήθειας callerid, αυτό δεν θα λειτουργήσει με την υπηρεσία ληστεύω-κομματιών - RBS - κυκλώματα. Αυτό θα λειτουργήσει επίσης μέσω του περισσότερου VOIP - ΓΟΥΛΙΑ ή κορμοί IAX - προμηθευτές που επιτρέπουν δυναμικό εξερχόμενο callerID. Η σνήθεια callerID ισχύει μόνο για τις κλήσεις που τοποθετούνται για την εκστρατεία VICIDIAL άμεσα, οποιεσδήποτε κλήσεις ή μεταφορές 3$ων συμβαλλόμενων μερών δεν θα στείλουν τη συνήθεια callerID. ΣΗΜΕΙΩΣΗ: Μερικές φορές να βάλει ΑΓΝΩΣΤΗ ή ΙΔΙΩΤΙΚΗ στον τομέα θα παραγάγει την αποστολή του αριθμού προεπιλογής σας callerID από το μεταφορέα σας με τις κλήσεις. Μπορείτε να θελήσετε να εξετάσετε αυτό και να υποβάλετε 0000000000 ο τομέας callerid αντ' αυτού εάν δεν θέλετε να σας στείλετε CallerID.

<BR>
<A NAME="vicidial_campaigns-campaign_vdad_exten">
<BR>
<B>Τηλ.Σύνδεση Εκστρατείας VDAD -</B> Αυτό το πεδίο επιτρέπει γαι μία προσαρμόσιμη VDAD  εσωτ.σύνδεση μεταφοράς. Αυτό σας επιτρέπει να χρησιμοποιήσετε διαφορετικές διαδικασίες VDADtransfer.agi, σύμφωνα με την κστρατεία. Η προκαθορισμένη AGI μεταφορά - εσωτ.σύνδ. 8365 agi VDADtransfer.agi - στέλνει αμέσως τις κλήσεις στον χρήστη, μόλις το σηκώσουν. Ενα πρόσθετο AGI παράεα πολιτικής έρευνας συμπεριλαμβάνεται - 8366 agi - VDADtransferSURVEY.agi - όπου παίζει ένα μήνυμα στο κληθέν πρόσωπο και επιτρέπει να κάνουν επιλογς με τα πλήκτρα.

<BR>
<A NAME="vicidial_campaigns-campaign_rec_exten">
<BR>
<B>Τηλ.Επέκταση εκσρατείας Ηχογρ -</B> αυτό το πεδίο επιτρέπει να ορίσετε μία επέκταση ηχογράφησης που χρησιμοποιείται με το VICIDIAL. Αυτό επιτρέπει να χρησιμοποιήσετε διαφορετικές επεκτάσεις ανάλογα με πόσο χρόνο θέλετε να επιτρέψετε μία ηχογράφηση και ποιο τύπος κωδικοποιητή-αποκωδικοποιητή θα χρσιμοποιηθεί. Η προεπιλογή είναι 8309 και θα καταγράψει με το σχήμα WAV μέχρι μια ώρα. Μια άλλη επιλογή που περιλαμβάνεται στα παραδείγματα είναι 8310 που θα καταγράψουν με το σχήμα GSM για μέχρι μια ώρα.

<BR>
<A NAME="vicidial_campaigns-campaign_recording">
<BR>
<B>Ηχογράφηση Εκστρατείας -</B> Αυτές οι επιλογές σας επιτρέπουν να διαλέξετε πιο επίπεδο ηχογράφησης επιτρέπετε στην εκστρατεία. NEVER θα απενεργοποιήσει την ηχογράφηση στον πελάτη. ONDEMAND είναι το προκαθορισμένο και επιτρέπει στον χειριστή να ξεκινάει και να σταματάει την ηχογράφηση. ALLCALLS ξεκινάει η ηχογράφηση όποτε η κλήση μεταφέρετε στον χειριστή.

<BR>
<A NAME="vicidial_campaigns-campaign_rec_filename">
<BR>
<B>Όνομα αρχείου ηχογρ εκστρατείας -</B> αυτό το πεδίο επιτρέπει να προσαρμόσετε το όνομα της ηχογράφησης, όταν η ηχογράφηση της εκστρατείας είναι ONDEMAND ή ALLCALLS. Οι μεταβλητές είναι CAMPAIGN CUSTPHONE FULLDATE TINYDATE EPOCH AGENT. Η προεπιλογή είναι FULLDATE_ΧΕΙΡΙΣΤΗΣκαι θα μοιάζει με  το 20051020-103108_6666. Ένα άλλο παράδειγμα είναι CAMPAIGN_TINYDATE_CUSTPHONE που θα μοιάζει με το TESTCAMP_51020103108_3125551212. 50 char max.

<BR>
<A NAME="vicidial_campaigns-allcalls_delay">
<BR>
<B>Καθυστέρηση Ηχογράφησης -</B> Μόνο για ηχογραφήσεις ALLCALLS και ALLFORCE. Προκαθορισμένα είναι 0.

<BR>
<A NAME="vicidial_campaigns-campaign_script">
<BR>
<B>Βοηθός εκστρατείας -</B> αυτές οι επιλογές επιτρέπουν να επιλέξετε τον Βοηθό που θα εμφανιστεί στην οθόνη των χειριστών για αυτήν την εκστρατεία. Επιλέξτε NONE για να μην παρουσιάσετε κανένα χειρόγραφο για αυτήν την εκστρατεία.

<BR>
<A NAME="vicidial_campaigns-get_call_launch">
<BR>
<B>Κατά την έναρξη κλήσης -</B> αυτές οι επιλογές επιτρέπουν να επιλέξετε εάν θέλετε την αυτόματη έναρξη μίας ιστο σελίδας σε ένα διαφορετικό παράθυρο, αυτόματη μεάβαση στον Βοηθό ή τίποτα. 

<BR>
<A NAME="vicidial_campaigns-am_message_exten">
<BR>
<B>Μήνυμα αυτόματου τηλεφωνητού -</B> αυτός το πεδίο χρησιμοποιείτε για τις τυφλές κλήσεις μεταφοράς όταν παίρνει ο χειριστής έναν αυτόματο τηλεφωνητή και χτυπά στο πλήκτρο μηνυμάτων αυτόματων τηλεφωνητών στο πλαίσιο διασκέψεων μεταφοράς. Πρέπει το θέσετε αυτό στο dial plan - extensions.conf - και σιγουρευτείτε ότι παίζει ένα αρχείο μουσικής κατόπιν κλείνει το τηλέφωνο. 

<BR>
<A NAME="vicidial_campaigns-amd_send_to_vmx">
<BR>
<B>AMD στέλνει στο VM -</B> αυτές οι επιλογές επιτρέπουν να καθορίσετε εάν ένα μήνυμα αφήνεται σε έναν αυτόματο τηλεφωνητή όταν ανιχνεύεται ότι η κλήση είναι ένας αυτόματος τηλεφωνητής και εάν το AMD είναι ενεργό.

<BR>
<A NAME="vicidial_campaigns-xferconf_a_dtmf">
<BR>
<B>Xfer- Συνδ DTMF -</B> αυτά τα τέσσερα πεδία επιτρέπουν να έχετε δύο σύνολα συνδιάσκεψης μεταφοράς και DTMF. Όταν η κλήση ή η εκστρατεία φορτώνεται, ο Βοηθός θα παρουσιάσει δύο πλήκτρα στο πλαίσιο μεταφορά-διασκέψεων και αυτόματα θα παρουσιάσει τα πεδία αριθμό για κλήση και στείλε DTMF όταν πατηθεί. Εάν θέλετε να επιτρέψετε τις μεταφορές σε σύμβουλο, ενός fronter σε έναν closer,  θα πρέπει να θέσετε CXFER στο πεδίο number-to-dial και το σωστό κείμενο κλήσης θα σταλεί να κάνει μία τοπική μεταφορά σε σύμβουλο. Καθώς η κλήση θα απαντηθεί, μπορείτε να αφήσετε το πελάτη με τον χειριστή closer και να συνεχίσετε στην επόμενη κλήση πατώντας το πλήκτρο ΑΠΟΧΩΡΗΣΗ 3μελής ΚΛΗΣΗΣ. Εάν θέλετε να μεταφέρετε τους πελάτες σε AGI διαδικασία ή σε IVR, τότε θα πρέπει να θέσετε AXFER στο πεδίο number-to-dial. Μπορείτε επίσης να θέσετε και μία προσωπική τηλ. σύνδεση μετά το AXFER ή CXFER.

<BR>
<A NAME="vicidial_campaigns-alt_number_dialing">
<BR>
<B>Κλήση Εναλ Αρ Χρήστη -</B> Αυτή η επιλογή επιτρέπει στον χειριστή να κάνει χειροκίνητη κλήση του εναλλακτικού αριθμού τηλεφώνου ή το πεδίο address3 μετά την κλήση του κυρίου αριθμού.

<BR>
<A NAME="vicidial_campaigns-scheduled_callbacks">
<BR>
<B>Προγραμματισμένες Επανακλήσεις -</B> Αυτή η επιλογή επιτρέπει στον χειριστή να τερματίσει μία κλήση ως CALLBK και να επιλέξει τα δεδομένα και την ώρα κατά την οποία ο οδηγός θα ξανα-ενεργοποιηθεί.

<BR>
<A NAME="vicidial_campaigns-drop_call_seconds">
<BR>
<B>Δευτερ. Εγκαταλ. Κλήσης -</B> Ο αριθμός των δευτερολέπτων από την στιγμή που ο πελάτης σηκώνει το τηλ μέχρι η κλήση να θεωρηθεί εγκαταλειμένη. Μόνο για εξερχόμενες κλήσεις  .

<BR>
<A NAME="vicidial_campaigns-voicemail_ext">
<BR>
<B>Φωνητικό Ταχυδρομείο -</B> Εάν έχει οριστεί, οι κλήσεις που φυσιολογικά θα ΕΓΚΑΤΑΛΕΙΠΟΝΤΑΝ, θα κατευθυνθούν σε αυό το φωνητικό ταχυδρομείο, ώστε να ακούσετε και να αφήσετε ένα μήνυμα.

<BR>
<A NAME="vicidial_campaigns-safe_harbor_message">
<BR>
<B>Μήνυμα Ασφαλούς Φύλαξης -</B> Εάν είναι Υ θα παίξει ένα μήνυμα στον πελάτη μετά το πέρας των δευτερολέπτων ασφαλούς εγκατάλειψης, χωρίς να μεταφερθεί σε ένν χειριστή. Αυτή η επιλογή υπερβαίνει την αποστολή σε θυρίδα ηχητικού μηνύματος εάν είναι Υ.

<BR>
<A NAME="vicidial_campaigns-safe_harbor_exten">
<BR>
<B>Εσωτ.σύνδεση Ασφαλούς Φύλαξης -</B> Αυτή είναι η εσωτ.σύνδεση του πλάνου κλήσεων, όπου βρίσκεται το ηχητικό αρχείο της Ασφαλής Φύλαξης στον διακομιστή.

<BR>
<A NAME="vicidial_campaigns-wrapup_seconds">
<BR>
<B>Δευτερ. Τυλίγματος -</B> Ο αριθμός των δευερολέπτων που αναγκάζει έναν χειριστή να περιμένει πριν του επιτραπεί να λάβει ή να κάνει άλλη κλήση. Ο χρόνος ξεκινάει μόλις τερματίσει μία κλήση. Προκαθορισμένα είναι 0 δευτερ. Αν ο χρόνος περάσει πριν ο χειριστής τερματίσει την κλήση, δεν θα μετακινηθεί στην άλλη κλήση πριν συβεί αυτό.

<BR>
<A NAME="vicidial_campaigns-wrapup_message">
<BR>
<B>Μήνυμα Τυλίγματος -</B> Αυτό είναι ένα συγκεκριμένο μήνυμα εκστρατείας που εμφανίζεται στην οθόνη τυλίγματος όταν έχει οριστεί ο χρόνος τυλίγματος.

<BR>
<A NAME="vicidial_campaigns-use_internal_dnc">
<BR>
<B>Εσωτερικός κατάλογος DNC χρήσης -</B> αυτό καθορίζει εάν αυτή ηεκστρατεία είναι στους μολύβδους φίλτν ενάντια στον εσωτερικόκατάλογο DNC. Εάν τίθεται το Υ, η χοάνη θα ψάξει κάθετηλεφωνικό αριθμό στον κατάλογο DNC πρίν τοποθετεί τον στηχοάνη. Εάν είναι στον κατάλογο DNC έπειτα θα αλλάξει ότιθέση μολύβδου σε DNCL έτσι που δεν μπορεί να σχηματιστεί. Ηπροεπιλογή είναι ν.

<BR>
<A NAME="vicidial_campaigns-closer_campaigns">
<BR>
<B>Εισερχόμενες ομάδες -</B> For CLOSER campaigns only. Here is where you select the inbound groups you want agents in this CLOSER campaign to be able to take calls from. It is important for BLENDED inbound-outbound campaigns only to select the inbound groups that are used for agents in this campaign. The calls coming into the inbound groups selected here will be counted as active calls for a blended campaign even if all agents in the campaign are not logged in to receive calls from all of those selected inbound groups.

<BR>
<A NAME="vicidial_campaigns-agent_pause_codes_active">
<BR>
<B>Η μικρή διακοπή πρακτόρων κωδικοποιεί ενεργό -</B> επιτρέπει στουςπράκτορες για να επιλέξει έναν κώδικα μικρής διακοπής ότανχτυπούν στο κουμπί ΜΙΚΡΗΣ ΔΙΑΚΟΠΉΣ στους κώδικες μικρής διακοπήςvicidial.php. είναι ευπροσδιόριστοι ανά εκστρατεία στοκατώτατο σημείο της οθόνης λεπτομέρειας άποψης εκστρατείας καιαποθηκεύονται στον πίνακα vicidial_agent_log. Η προεπιλογήείναι ν.

<BR>
<A NAME="vicidial_campaigns-disable_alter_custdata">
<BR>
<B>Θέστε εκτός λειτουργίας αλλάζει τα στοιχεία πελατών -</B> εάνθέστε το Υ, δεν αλλάζει οποιων δήποτε από το αρχείο στοιχείωνπελατών όταν διαθέσεις πρακτόρων η κλήση. Η προεπιλογή είναι ν.

<BR>
<A NAME="vicidial_campaigns-no_hopper_leads_logins">
<BR>
<B>Επιτρέψτε τους κανένας-χοάνη-μολύβδους Logins -</B> εάν θέστε τοΥ, επιτρέπει στους πράκτορες στη σύνδεση στην εκστρατεία ακόμα κιαν δεν υπάρχει κανένας μόλυβδος που φορτώνεται στη χοάνη γιαεκείνη την εκστρατεία. Αυτή η λειτουργία δεν απαιτείται στιςεκστρατείες στενός-τύπων. Η προεπιλογή είναι ν.



<BR><BR><BR><BR>

<B><FONT SIZE=3>VICIDIAL_ΛΙΣΤΕΣ ΠΙΝΑΚΑΣ</FONT></B><BR><BR>
<A NAME="vicidial_lists-list_id">
<BR>
<B>ID Λίστας -</B> Αυτό είναι το αριθμητικό όνομα της λίστας, δεν μπορεί να διορθωθεί μετά από την αρχική εισαγωγή, πρέπει να περιέχει μόνο αριθμούς και πρέπει να είναι μεταξύ 2 και 8 χαρακτήρες. Must be a number greater than 100.

<BR>
<A NAME="vicidial_lists-list_name">
<BR>
<B>Ονομα Λίστας -</B> Αυτή είναι η περιγραφή της λίστας, πρέπει να είναι μεταξύ 2 και 20 χαρακτήρες.

<BR>
<A NAME="vicidial_lists-list_description">
<BR>
<B>Περιγραφή καταλόγων -</B> αυτό είναι ο τομέας υπομνημάτων για τονκατάλογο, είναι προαιρετικό.

<BR>
<A NAME="vicidial_lists-list_changedate">
<BR>
<B>Ημερομηνία αλλαγής καταλόγων -</B> αυτό είναι η τελευταία φορά ότιοι τοποθετήσεις για αυτόν τον κατάλογο τροποποιήθηκαν από καμιάάποψη.

<BR>
<A NAME="vicidial_lists-list_lastcalldate">
<BR>
<B>Τελευταία ημερομηνία κλήσης καταλόγων -</B> αυτό είναι η τελευταίαφορά ότι ο μόλυβδος σχηματίστηκε από αυτόν τον κατάλογο.

<BR>
<A NAME="vicidial_lists-campaign_id">
<BR>
<B>Εκστρατεία -</B> Αυτή είναι η εκστρατεία όπου ανήκει η λίστα. Μία λίστα μπορεί μόνο να κληθεί από μία εκστρατεία κάθε φορά.

<BR>
<A NAME="vicidial_lists-active">
<BR>
<B>Ενεργή -</B> Αυτό ορίζει κατά πόσον η λίστα πρόκειται να κληθεί ή όχι.

<BR>
<A NAME="vicidial_lists-reset_list">
<BR>
<B>Επαναφορά Κατάστασης-Κλήσης-Καθοδήγησης για την λίστα -</B> Αυτό επαναφέρει τους οδηγούς σε αυτή την λίστα στο Ν σε  \"μη κληθέντα  από την τελευταία επαναφορά\" και σημαίνει ότι για οποιαδήποτε καθοδήγηση μπορεί να γίνει κλήση εάν είναι η σωστή κατάσταση, όπως ορίσθηκε στην οθόνη τις εκστρατείας.

<BR>
<A NAME="vicidial_list-dnc">
<BR>
<B>Κατάλογος VICIDIAL DNC -</B> αυτό δεν καλεί τον κατάλογοπεριέχει κάθε μόλυβδο που έχει τεθεί μια θέση DNC στοσύστημα. Μέσω των ΚΑΤΑΛΩΝ - ΠΡΟΣΘΕΣΤΕ τον ΑΡΙΘΜΟ στη σελίδαDNC που είστε σε θέση να προσθέσετε με το χέρι έναν αριθμό σεαυτόν τον κατάλογο έτσι ώστε δεν θα κληθεί από τις εκστρατείεςπου χρησιμοποιούν τον εσωτερικό κατάλογο DNC.



<BR><BR><BR><BR>

<B><FONT SIZE=3>VICIDIAL_INBOUND_GROUPS ΠΙΝΑΚΑΣ</FONT></B><BR><BR>
<A NAME="vicidial_inbound_groups-group_id">
<BR>
<B>ID Ομάδας -</B> Αυτό είναι το σύντομο όνομα της εισερχόμενης ομάδας, δεν μπορεί να διορθωθεί μετά από την αρχική παράδοση, δεν μπορεί να περιέχει κενά και πρέπει να είναι μεταξύ 2 και 20χαρακτήρες.

<BR>
<A NAME="vicidial_inbound_groups-group_name">
<BR>
<B>Ονομα Ομάδας -</B> Αυτή είναι η περιγραφή της ομάδας, πρέπει να είναι μεταξύ 2 και 30 χαρακτήρες. Δεν μπορεί να συμπεριαμβάνει παύλες, συν ή κενά .

<BR>
<A NAME="vicidial_inbound_groups-group_color">
<BR>
<B>Χρώμα Ομάδας -</B> Αυτό είναι το χρώμα που εμφανίζεται στην VICIDIAL  εφαρμογή όταν η κλήση έρχεται σε αυτή την ομάδα. Πρέπει να είναι μεταξύ 2 και 7 χαρακτήρες. Εάν αυτό είναι ορισμένο ως hex , θα πρέπει να τοποθετήσετε ένα # στην αρχή του κειμένου ή το VICIDIAL δεν θα δουλεύει σωστά.

<BR>
<A NAME="vicidial_inbound_groups-active">
<BR>
<B>Ενεργοποίηση -</B> Αυτό καθορίζει κατά πόσον αυτή η ομάδα εμφανίζεται στο κουτί επιλογής όταν ένας χρήστης συνδέεται.

<BR>
<A NAME="vicidial_inbound_groups-web_form_address">
<BR>
<B>Ιστοσελίδα -</B> Αυτή είναι η προσαρμοσμένη διεύθυνση που θα σας κατευθύνει για κλήσεις που έρχονται σε αυ την ομάδα.

<BR>
<A NAME="vicidial_inbound_groups-next_agent_call">
<BR>
<B>Επόμενη Κλήση Χρήστη -</B> Αυτό προσδιορίζει ποιος χρήστης λαμβάνει την επόμενη κλήση που είναι διαθέσιμη:
 <BR> &nbsp; - random: ταξινομημένο με τυχαία τιμή ενημέρωσης στον πίνακα vicidial_live_agents
 <BR> &nbsp; - oldest_call_start: ταξινομημένο με την τελευταία φορά που σε ένα χρήστη στάλθηκε  μία κλήση. Με αποτέλεσμα, ο χρήστης να λαμβάνει συνολικά το ίδιο αριθό κλήσεων.
 <BR> &nbsp; - oldest_call_finish: ταξινομημένο με την τελευταία φορά που ένας χρήστης τελείωσε μία κλήση. Ο χρήστης που περιμένει περισσότερο λαμβάνει την πρώτη κλήση.
 <BR> &nbsp; - overall_user_level: οι διαταγές από το user_level του χειριστή όπως καθορίζεται στα vicidial_users παρουσιάζουν ένα υψηλότερο user_level θα άβουν περισσότερες κλήσεις.

<BR>
<A NAME="vicidial_inbound_groups-fronter_display">
<BR>
<B>Οθόνη Μπροστινού -</B> Αυτό το πεδίο καθορίζει κατά πόσον στον VICIDIAL  χόμενος χρήστης θα εμφανίζεται το όνομα του μπροστινού - εάν υπάρχει κάποιο - στο πεδίο κατάστασης όταν η κλήση έρχεται στον χρήστη.

<BR>
<A NAME="vicidial_inbound_groups-ingroup_script">
<BR>
<B>Βοηθός εκστρατείας -</B> αυτές οι επιλογές επιτρέπουν να επιλέξετε τον Βοηθό που θα εμφανιστεί στην οθόνη των χειριστών για αυτήν την εκστρατεία. Επιλέξτε NONE για να μην παρουσιάσετε κανένα χειρόγραφο για αυτήν την εκστρατεία.

<BR>
<A NAME="vicidial_inbound_groups-get_call_launch">
<BR>
<B>Κατά την έναρξη κλήσης -</B> αυτές οι επιλογές επιτρέπουν να επιλέξετε εάν θέλετε την αυτόματη έναρξη μίας ιστο σελίδας σε ένα διαφορετικό παράθυρο, αυτόματη μεάβαση στον Βοηθό ή τίποτα. 

<BR>
<A NAME="vicidial_inbound_groups-xferconf_a_dtmf">
<BR>
<B>Xfer- Συνδ DTMF -</B> αυτά τα τέσσερα πεδία επιτρέπουν να έχετε δύο σύνολα συνδιάσκεψης μεταφοράς και DTMF. Όταν η κλήση ή η εκστρατεία φορτώνεται, ο Βοηθός θα παρουσιάσει δύο πλήκτρα στο πλαίσιο μεταφορά-διασκέψεων και αυτόματα θα παρουσιάσει τα πεδία αριθμό για κλήση και στείλε DTMF όταν πατηθεί. Εάν θέλετε να επιτρέψετε τις μεταφορές σε σύμβουλο, ενός fronter σε έναν closer,  θα πρέπει να θέσετε CXFER στο πεδίο number-to-dial και το σωστό κείμενο κλήσης θα σταλεί να κάνει μία τοπική μεταφορά σε σύμβουλο. Καθώς η κλήση θα απαντηθεί, μπορείτε να αφήσετε το πελάτη με τον χειριστή closer και να συνεχίσετε στην επόμενη κλήση πατώντας το πλήκτρο ΑΠΟΧΩΡΗΣΗ 3μελής ΚΛΗΣΗΣ. Εάν θέλετε να μεταφέρετε τους πελάτες σε AGI διαδικασία ή σε IVR, τότε θα πρέπει να θέσετε AXFER στο πεδίο number-to-dial. Μπορείτε επίσης να θέσετε και μία προσωπική τηλ. σύνδεση μετά το AXFER ή CXFER.

<BR>
<A NAME="vicidial_inbound_groups-drop_call_seconds">
<BR>
<B>Δευτερ. Εγκαταλ. Κλήσης -</B> Ο αριθμός των δευτερολέπτων από την στιγμή που ο πελάτης σηκώνει το τηλ μέχρι η κλήση να θεωρηθεί εγκαταλειμένη. Μόνο για εξερχόμενες κλήσεις  .

<BR>
<A NAME="vicidial_inbound_groups-voicemail_ext">
<BR>
<B>Φωνητικό Ταχυδρομείο -</B> Εάν έχει οριστεί, οι κλήσεις που φυσιολογικά θα ΕΓΚΑΤΑΛΕΙΠΟΝΤΑΝ, θα κατευθυνθούν σε αυό το φωνητικό ταχυδρομείο, ώστε να ακούσετε και να αφήσετε ένα μήνυμα.

<BR>
<A NAME="vicidial_inbound_groups-drop_message">
<BR>
<B>Μήνυμα Εγκατάλειψης -</B> Εάν είναι Υ θα παίξει ένα μήνυμα στον πελάτη μετά το πέρας των δευτερολέπτων Εγκατάλειψης, χωρίς να μεταφερθεί σε έναν χειριστή. Αυτή η επιλογή υπερβαίνει την αποστολή σε θυρίδα ηχητικού μηνύματος εάν είναι Υ.

<BR>
<A NAME="vicidial_inbound_groups-drop_exten">
<BR>
<B>Εσωτ.Σύνδεση Εγκατάλειψης -</B> Αυτή είναι η εσωτ.σύνδεση του πλάνου κλήσεων, όπου βρίσκεται το ηχητικό αρχείο της Εγκατάλειψης στον διακομιστή.



<BR><BR><BR><BR>

<B><FONT SIZE=3>VICIDIAL_REMOTE_AGENTS ΠΙΝΑΚΑΣ</FONT></B><BR><BR>
<A NAME="vicidial_remote_agents-user_start">
<BR>
<B>Αρχή ID Χρήστη -</B> Αυτό είναι η αρχή του ID Χρήστη που χρησιοποιείται όταν οι καταχωρήσεις των απομακρυσμένων χρηστών παρεμβάλλονται στο σύστημα. Εάν ο αριθμός των γραμμών είναι μεγαλύτερος από 1, αυτός ο αριθμός αυξάνει κατά ένα μέχρι κάθε γραμμή να έχει μία καταχώρηση. Επιβεβαιώστε, ότι δημιουργήσατε ένα νέο VICIDIAL λογαριασμό η με επίπεο χρήσης 4 ή μεγαλύτερο, εάν θέλετε να μπορεί να χρησιμοποιήσει την σελίδα vdremote για απομακρυσμένη πρόσβαση του λογαριασμού του.

<BR>
<A NAME="vicidial_remote_agents-number_of_lines">
<BR>
<B>Αριθμός Γραμμών -</B> Αυτό ορίζει πόσες καταχωρήσεις απομακρυσμένων χρηστών το σύστημα δημιουρ, και καθορίζει πόσες γραμμές μπορεί με ασφάλεια να στείλει στον αριθμό παρακάτω.

<BR>
<A NAME="vicidial_remote_agents-server_ip">
<BR>
<B>IP Διακομιστή -</B> Μία καταχώρηση απομακρυσμένου χρήστη είναι μόνο καλό για ένα συγκεκριμένο διακομιστή, εδώ επιλέγετε τον διακομιστή που ανήκει.

<BR>
<A NAME="vicidial_remote_agents-conf_exten">
<BR>
<B>Εξωτερική Τηλ.Σύνδεση -</B> Αυτός είναι ο αριθμός που θέλετε οι κλήσεις να προωθούνται. Επιβεβαιώστε ότι είναι ένας πλήρης αριθμός από το σχέδιο κλήεων και εάν θέλετε ένα 9 στην αρχή το βάζετε εδώ. Κάντε μία δοκιμή καλώντας αυτόν τον αριθμό από ένα τηλέφωνο του συστήματος.

<BR>
<A NAME="vicidial_remote_agents-status">
<BR>
<B>Κτάσταση -</B> Εδώ μπορείτε να θέσετε τον απομακρυσμένο χρήστη σε ενεργό και μη ενεργό. Μόλις ο χρήστης γίνει ενεργός το σύστημα μπορεί να στείλει κλήσεις σε αυτόν. Μπορεί να διαρκέσει μέχρι 30 δευτερόλεπτα μετά την αλλαγή της κατάστασης σε μη ενεργός, ώστε να σταματήσει να δέχεται κ.

<BR>
<A NAME="vicidial_remote_agents-campaign_id">
<BR>
<B>Εκστρατεία -</B> Εδώ μπορείτε να επιλέξετε την εκστρατεία όπου οι απομακρυσμένοι χρήστες θα συνδεθούν. Για εισερχόμενες πρέπει να χρησιμοποιηθεί η εκστρατεία CLOSER και επιλέξτε τις εισερχόμενες εκστρατείες παρακάτω, από που θέλετε να λαμβάνεται τις κλήσεις.

<BR>
<A NAME="vicidial_remote_agents-closer_campaigns">
<BR>
<B>Εισερχόμενες Ομάδες -</B> Εδώ μπορείτε να επιλέξετε τις εισερχόμενες ομάδες που θέλετε να λαμβάνουν τις κλήσεις , εάν έχετε επιλέξει την εκστρατεία CLOSER.


<BR><BR><BR><BR>

<B><FONT SIZE=3>VICIDIAL_CAMPAIGN_ΛΙΣΤΕΣ</FONT></B><BR><BR>
<A NAME="vicidial_campaign_lists">
<BR>
<B>Οι λίστες της εκστρατείας παρουσιάζονται εδώ,  και εάν είναι ενεργές (Υ ή Ν) μπορείτε να πάτε στην οθόνη λίστας με το να πατήσετε στο ID λίστας, στην πρώτη στήλη.</B>


<BR><BR><BR><BR>

<B><FONT SIZE=3>VICIDIAL_CAMPAIGN_STATUSES ΠΙΝΑΚΑΣ</FONT></B><BR><BR>
<A NAME="vicidial_campaign_statuses">
<BR>
<B>Με την χρήση προσαρμοσμένων καταστάσεων εκστρατείας, μπορείτε να έχετε καταστάσεις μόνο για συγκεκριμένες εκστρατείες. Η κατάσταση πρέπει να είναι 1-8 χαρακτήρες, η περιγραφή 2-30 χαρακτήρες και Επιλέξιμα καθορίζεται αν εμφανίζεται στο VICIDIAL ως τερματισμός.</B>



<BR><BR><BR><BR>

<B><FONT SIZE=3>VICIDIAL_CAMPAIGN_HOTKEYS ΠΙΝΑΚΑΣ</FONT></B><BR><BR>
<A NAME="vicidial_campaign_hotkeys">
<BR>
<B>Με την χρήση προσαρμοσμένων κλειδιών εκστρατείας, οι χρήστες που χρησιμοποιούν την εφαρμογή vicidial μπορούν να κλείσουν και να τερματίσουν την κλήση, με ένα μόνο πάτημα πλήκτρου.</B> There are two special HotKey options that you can use in conjunction with Alternate Phone number dialing, ALTPH2 - Alternate Phone Hot Dial and ADDR3-----Address3 Hot Dial allow an agent to use a hotkey to hang up their call, stay on the same lead, and dial another contact number from that lead. 





<BR><BR><BR><BR>

<B><FONT SIZE=3>VICIDIAL_LEAD_RECYCLE ΠΙΝΑΚΑΣ</FONT></B><BR><BR>
<A NAME="vicidial_lead_recycle">
<BR>
<B>Through the use of lead recycling, you can call specific statuses of leads again at a specified interval without resetting the entire list. Lead recycling is campaign-specific and does not have to be a selected dialable status in your campaign. The attempt delay field is the number of seconds until the lead can be placed back in the hopper, this number must be at least 120 seconds. The attempt maximum field is the maximum number of times that a lead of this status can be attempted before the list needs to be reset, this number can be from 1 to 10. You can activate and deactivate a lead recycle entry with the provided links.</B>





<BR><BR><BR><BR>

<B><FONT SIZE=3>VICIDIAL ΑΥΤΟΜΑΤΕΣ ΘΈΣΕΙΣ ΠΙΝΑΚΩΝ ALT</FONT></B><BR><BR>
<A NAME="vicidial_auto_alt_dial_statuses">
<BR>
<B>Εάν ο αυτόματος τομέας σχηματισμού ALT-ARJCMOY' τίθεται,κατόπιν οι μόλυβδοι που είναι κάτω από αυτές τις αυτόματεςθέσεις πινάκων ALT θα σχηματίσουν το alt_phone και-ή τουςτομείς address3 τους αφότου τίθενται οποιεσδήποτε από αυτέςτις θέσεις κανένας-απάντησης.</B>





<BR><BR><BR><BR>

<B><FONT SIZE=3>VICIDIAL ΚΩΔΙΚΕΣ ΜΙΚΡΗΣ ΔΙΑΚΟΠΉΣ ΠΡΑΚΤΟΡΩΝ</FONT></B><BR><BR>
<A NAME="vicidial_pause_codes">
<BR>
<B>_ εάν ο πράκτορας διακοπή κωδικοποιώ ενεργός τομέας είμαι θέτωνα ενεργός έπειτα ο πράκτορας θα είμαι σε θέση να επι:λέγω απόαυτός διακοπή κώδικας όταν αυτός χτυπώ ο ΔΙΑΚΟΠΉ κουμπί τουςοθόνη. Αυτό το στοιχείο αποθηκεύεται έπειτα στο vicidialκούτσουρο πρακτόρων. Ο κώδικας μικρής διακοπής πρέπει ναπεριέχει μόνο τα γράμματα και τους αριθμούς και να είναιλιγότερο από 7 χαρακτήρες μακροχρόνιοι. Το όνομα κώδικα μικρήςδιακοπής δεν μπορεί να είναι πλέον από 30 χαρακτήρες.</B>





<BR><BR><BR><BR>

<B><FONT SIZE=3>VICIDIAL_USER_GROUPS ΠΙΝΑΚΑΣ</FONT></B><BR><BR>
<A NAME="vicidial_user_groups-user_group">
<BR>
<B>Ομάδα Χρήστη  -</B> Αυτό είναι το σύντομο όνομα της Vicidial ομάδας χρήστη, πρσπαθήστε να μην χρησιμοποιήσετε κενά ή στίξεις για αυτό το πεδίο. Από 2 μέχρι 20 χαρακτήρες.

<BR>
<A NAME="vicidial_user_groups-group_name">
<BR>
<B>Ονομα Ομάδας-</B> Αυτή είναι η περιγραφή της vicidial ομάδας χρήστη μέχρι 40 χαρακτήρες.

<BR>
<A NAME="vicidial_user_groups-allowed_campaigns">
<BR>
<B>Εκστρατείες -</B> αυτό είναι ένας επιλέξιμος κατάλογος εκστρατειώνστον οποίο τα μέλη αυτής της ομάδας χρηστών μπορούν νασυνδεθούν. Η επιλογή όλος-ΕΚΣΤΡΑΤΕΙΩΝ επιτρέπει στους χρήστες σεαυτήν την ομάδα για να δει και να συνδεθεί σε οποιαδήποτεεκστρατεία στο σύστημα.





<BR><BR><BR><BR>

<B><FONT SIZE=3>VICIDIAL_ΒΟΗΘΟΙ ΠΙΝΑΚΑΣ</FONT></B><BR><BR>
<A NAME="vicidial_scripts-script_id">
<BR>
<B>Ταυτότητα Βοηθού -</B> αυτό είναι το σύντομο όνομα ενός Βοπηθού. Πρέπει να είναι ένα μοναδικό προσδιοριστικό. Προσπαθήστε να μην χρησιμοποιήσετε οποιαδήποτε διαστήμα ή στίξη για τους 10 χαρακτήρες αυτού του πεδίου, ελάχιστο 2 χαρακτήρων.

<BR>
<A NAME="vicidial_scripts-script_name">
<B>Όνομα Βοηθού -</B> αυτός είναι ο τίτλος ενός Βοηθού. Αυτή είναι μια σύντομη περίληψη. 2-50 χαρακτήρες. Δεν πρέπει να υπάρξουν διάστηματα ή στίξεις σε αυτό το πεδίο.

<BR>
<A NAME="vicidial_scripts-script_comments">
<B>Σχόλια Βοηθού -</B> εδώ μπορείτε να τοποθετήσετε τα σχόλια για έναν Βοηθό. 2-255 χαρακτήρες .

<BR>
<A NAME="vicidial_scripts-script_text">
<B>Κείμενο χειρόγραφου -</B> This is where you place the content of a Vicidial Script. Minimum of 2 characters. You can have customer information be auto-populated in this script using "--A--field--B--" where field is one of the following fieldnames: vendor_lead_code, source_id, list_id, gmt_offset_now, called_since_last_reset, phone_code, phone_number, title, first_name, middle_initial, last_name, address1, address2, address3, city, state, province, postal_code, country_code, gender, date_of_birth, alt_phone, email, security_phrase, comments, lead_id, campaign, phone_login, group, channel_group, SQLdate, epoch, uniqueid, customer_zap_channel, server_ip, SIPexten, session_id. For example, this sentence would print the persons name in it----<BR><BR>  Hello, can I speak with --A--first_name--B-- --A--last_name--B-- please? Well hello --A--title--B-- --A--last_name--B-- how are you today?<BR><BR> This would read----<BR><BR>Hello, can I speak with John Doe please? Well hello Mr. Doe how are you today?<BR><BR> You can also use an iframe to load a separate window within the SCRIPT tab, here is an example with prepopulated variables:

<DIV style="height:200px;width:400px;background:white;overflow:scroll;font-size:12px;font-family:sans-serif;" id=iframe_example>
&#60;iframe src="http://astguiclient.sf.net/test_VICIDIAL_output.php?lead_id=--A--lead_id--B--&#38;vendor_id=--A--vendor_lead_code--B--&#38;list_id=--A--list_id--B--&#38;gmt_offset_now=--A--gmt_offset_now--B--&#38;phone_code=--A--phone_code--B--&#38;phone_number=--A--phone_number--B--&#38;title=--A--title--B--&#38;first_name=--A--first_name--B--&#38;middle_initial=--A--middle_initial--B--&#38;last_name=--A--last_name--B--&#38;address1=--A--address1--B--&#38;address2=--A--address2--B--&#38;address3=--A--address3--B--&#38;city=--A--city--B--&#38;state=--A--state--B--&#38;province=--A--province--B--&#38;postal_code=--A--postal_code--B--&#38;country_code=--A--country_code--B--&#38;gender=--A--gender--B--&#38;date_of_birth=--A--date_of_birth--B--&#38;alt_phone=--A--alt_phone--B--&#38;email=--A--email--B--&#38;security_phrase=--A--security_phrase--B--&#38;comments=--A--comments--B--&#38;user=--A--user--B--&#38;campaign=--A--campaign--B--&#38;phone_login=--A--phone_login--B--&#38;fronter=--A--fronter--B--&#38;closer=--A--user--B--&#38;group=--A--group--B--&#38;channel_group=--A--group--B--&#38;SQLdate=--A--SQLdate--B--&#38;epoch=--A--epoch--B--&#38;uniqueid=--A--uniqueid--B--&#38;customer_zap_channel=--A--customer_zap_channel--B--&#38;server_ip=--A--server_ip--B--&#38;SIPexten=--A--SIPexten--B--&#38;session_id=--A--session_id--B--&#38;phone=--A--phone--B--" style="width:580;height:290;background-color:transparent;" scrolling="auto" frameborder="0" allowtransparency="true" id="popupFrame" name="popupFrame" width="460" height="290"&#62;
&#60;/iframe&#62;
</DIV>

<BR>
<A NAME="vicidial_scripts-active">
<BR>
<B>Ενεργός -</B> αυτό καθορίζει εάν αυτός ο οδηγός μπορεί να επιλεχτεί για να χρησιμοποιηθεί από μια εκστρατεία.





<BR><BR><BR><BR>

<B><FONT SIZE=3>VICIDIAL_LEAD_ΦΙΛΤΡΑ ΠΙΝΑΚΑΣ</FONT></B><BR><BR>
<A NAME="vicidial_lead_filters-lead_filter_id">
<BR>
<B>ID Φίλτρου -</B> Αυτό είναι το σύντομο όνομα ενός Φίλτρου Οδηγού. Πρέπει να είναι ένας μοναδικός κωδικός. Μην χρησιμοποιήσετε κενά ή στίξη για αυτό το πεδίο. Χαρακτήρες 2 με 10.

<BR>
<A NAME="vicidial_lead_filters-lead_filter_name">
<B>Ονομα Φίλτρου -</B> Αυτό είναι ένα πιο περιγραφικό όνομα για το Φίλτρο. Είναι μία σύντομη περιγρφή του φίλτρου. Χαρακτήρες 2 με 30.

<BR>
<A NAME="vicidial_lead_filters-lead_filter_comments">
<B>Σχόλια Φίλτρου -</B> Εδώ μπορείτε σχολιάσετε το φίλτρο. Χαρακτήρες 2 με 255.

<BR>
<A NAME="vicidial_lead_filters-lead_filter_sql">
<B>SQL Φίλτρου -</B>  Εδώ μπορείτε να ορίσετε SQL ερώτημα για το φίλτρο. Μην ξεκινήσετε ή τελειώσετε με ένα AND, αυτό θα γίνει αυτόματα από το hopper. Ένα παράδειγμα είναι- called_count > 4 and called_count < 8 -.





<BR><BR><BR><BR>

<B><FONT SIZE=3>VICIDIAL_ΧΡΟΝΟΙ ΚΛΗΣΕΩΝ ΠΙΝΑΚΑΣ</FONT></B><BR><BR>
<A NAME="vicidial_call_times-call_time_id">
<BR>
<B>ID Χρόνου Κλήσης -</Β> Αυτό είναι το σύντομο όνομα του Ορισμού Χρόνου Κλήσης. Πρέπει να είναι ένα μοναδικό στοιχείο. Μην χρησιμοποιηθούν διαστήματα ή στίξεις. 2-10 χαρατήρες.

<BR>
<A NAME="vicidial_call_times-call_time_name">
<B>Ονομα Χρόνου Κλήσης -</B> Αυτό είναι ένα πιο περιγραφικό όνομα του Ορισμού Χρόνου Κλήσης. Είναι μία σύντομη περιγραφή. 2-30 χαρακτήρεςΣχόλια Χρόνου Κλήσης -</B> This is where you can place comments for a Vicidial Call Time Definition such as -10am to 4pm with extra call state restrictions-.  max 255 characters.

<BR>
<A NAME="vicidial_call_times-call_time_comments">
<B>Σχόλια Χρόνου Κλήσης -</B> This is where you can place comments for a Vicidial Call Time Definition such as -10am to 4pm with extra call state restrictions-.  max 255 characters.

<BR>
<A NAME="vicidial_call_times-ct_default_start">
<B>Προκαθορισμένοι Χρόνοι Εκκίνησης και Παύσης -</B> Αυτός είναι ο προκαορισμένος χρόνος όπου θα επιτρέπετε οι κλήσεις εάν δεν έχει οριστεί ο χρόνος εκκίνησης της ημέρας-της-εβδομάδας. 0 είναι μεσάνυχτα. Εάν δεν θέλετε καμία κλήση θέστε αυτό το πεδίο σε 2400 και το προκαθορισμένο χρόνο Παύσης σε 2400. Για να επιτρέψετε την 24ωρη κλήση την ημέρα θέστε σε 0 τον χρόνο εκκίνησης και σε 2400 τον χρόνο παύσης
.

<BR>
<A NAME="vicidial_call_times-ct_sunday_start">
<B>Εβδομαδιαίοι Χρόνοι Εκκίνησης και Παύσης -</B> Αυτοί είναι προσαρμόσιμοι χρόνοι ανά ημέρα για τον ορισμό χρόνων κλήσεων.

<BR>
<A NAME="vicidial_call_times-ct_state_call_times">
<B>Ορισμοί Χρόνων Κλήσεων Καταστάσεων -</B> Είναι η λίστα συγκεκριμένων Ορισμών Χρόνων Κλήσεων Καταστάσεων.

<BR>
<A NAME="vicidial_call_times-state_call_time_state">
<B>Κατάσταση Χρόνου Κλήσης Κατάστασης -</B> Αυτό είναι ο δύο γραμμάτων κωδικός για την κατάσταση όπου ο ορισμός χρόνου κλήης είναι για. Θα πρέπει και οι Οδηγοί της εκστρατείας να έχουν δύο γράμματα κωδικούς κατάστασης για τον χρόνο κλήσης κατάστασης.




<BR><BR><BR><BR>

<B><FONT SIZE=3>ΛΕΙΤΟΥΡΓΙΑ ΕΙΣΑΓΩΓΗΣ ΛΙΣΤΑΣ</FONT></B><BR><BR>
<A NAME="vicidial_list_loader">
<BR>
Ο VICIDIAL εισαγωγέας οδηγών είναι απλά σχεδιασμένος, ώστε να παίρνι ένα αρχείο - μέχρι 8ΜΒ - που είναι  διαχωρισμένο με tab ή pipe και να το φορτώνει στον πίνακα vicidial_list. Υπάρχει επίσης ένας νέος βήτα φορτωτής οδηγών έκδοσης έξοχος που επιτρέπει τον τομέα επιλέγοντας και TXT - σαφές κείμενο, CSV - κόμμα χώρισε τις τιμέ και XLS - σχήματα αρχείων Excel. Ο φορτωτής δεν κάνει εξακρίβωση δεδομένων ή έλεγχο σε διπλές καταχωρήσεις, το οποί είναι κάτι που πρέπει να κάνετε πριν την φόρτωση. Επίσης, διευκρινίστε ότι έχετε δημιουργήσει την λίστα όπου οι οδηγοί θα είναι από κάτω, ώστε να τους χρησιμοποιήστε.Υπάρχει επίσης το θέμα με τις ζώνες κωδικοποίησης χρόνου των οδηγών. Μπορεί να θέλετε να αυξήσετε την συχνότητα όπου το ADMIN_adjust_GMTnow_on_leads.pl τρέχει στον cron, ώστε οποιαδήποτε φόρτωση οδηγών να κωδικοποιείται πιο γρήγορα. Εδώ είναι μία λίστα από πεδία στην πρέπουσα ταξινόμηση για τα αρχεία καθοδήγησης.:
	<OL>
	<LI>Κωδικός Οδηγού Προμηθευτού
	<LI>Πηγαίος Κώδικας - εσωτερική χρήση μόνο από διαχειριστές και DBAs
	<LI>ID λίστας - ο αριθμός λίστας που οι οδηγοί θα παρουσιαστούν κάτω από
	<LI>Κωδικός τηλεφώνου - το πρόθεμα του τηλεφωνικού αριθμού (1 για ΗΠΑ, 01144 για Βρετανία κλπ)
	<LI>Ο αριθμός τηλεφώνου - πρέπει να είναι τουλάχιστον 8 ψηφία
	<LI>Τίτλος - ο τίτλος του πελάτη (κος. κα. κλπ)
	<LI>Ονομα
	<LI>Μεσαίο Αρχικό
	<LI>Επίθετο
	<LI>1 Γραμμή Διεύθυνσης
	<LI>2 Γραμμή Διεύθυνσης
	<LI>3 Γραμμή Διεύθυνσης
	<LI>Πόλη
	<LI>Κράτος - περιορισμός σε 2 χαρακτήρες
	<LI>Επαρχία
	<LI>Ταχ.Κωδ.
	<LI>Χώρα
	<LI>Φύλο
	<LI>Ημερ. Γέννησης
	<LI>Εναλ. Αριθμός Τηλ.
	<LI>Διεύθυνση Ηλεκτρ.Ταχυδρομείου
	<LI>Φράση Ασφαλείας
	<LI>Σχόλια
	</OL>

<BR>NOTES: The Excel Lead loader functionality is enabled by a series of perl scripts and needs to have a properly configured /etc/astguiclient.conf file in place on the web server. Also, a couple perl modules must be loaded for it to work as well - OLE-Storage_Lite and Spreadsheet-ParseExcel. You can check for runtime errors in these by looking at your apache error_log file.




<BR><BR><BR><BR>






<B><FONT SIZE=3>ΠΙΝΑΚΑΣ ΤΗΛΕΦΩΝΩΝ</FONT></B><BR><BR>
<A NAME="phones-extension">
<BR>
<B>Εωτ.Σύνδεση Τηλεφώνου -</B> Αυτό το πεδίο είναι για την καταχώρηση του ονόματος του τηλεφώνου, όπως αυτό εμφανίζεται στο Asterisk, χωρίς να συμπεριλαμβάνει το πρωτόκολλο ή slash στην αρχή. Για παράδειγμα: για SIP τηλέφωνο SIPVtest101 η Εσω.Γραμμή Τηλεφώνου θα είναι test101. Επίσης, για IAX2 τηλέφωνα χρησιμοποιείστε τα πλήρης ονόματα: IAX2/IAXphone1@IAXphone1 θα είναι IAXphone1@IAXphone1. Για Zap τηλέφωνα καταχωρήστε το πλήρες κανάλι: Zap/25-1 θα είναι 25-1. Αλλη σημείωση, ορίστε το πρωτόκολλο παρακάτω σωστά για τον τύπο του τηλεφώνου.

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
<B>Διαχειριστού Παρακολούθηση -</B> Εάν το θέσετε σε αληθές θα επιτρέπετε στους χρήστες να λαμβάνουν και να ανακατευθύνουν στην εσωτ.σύνδεσή τους οποιαδποτε γραμμή.

<BR>
<A NAME="phones-call_parking_enabled">
<BR>
<B>Στάθμευση Κλήσης -</B> Εάν το θέσετε σε αληθές θα επιτρέπετε σε χρήστες να σταθμεύουν κλήσεις και κλήσεις σε αναμονή να διαχειρίζονται από οποιοδήποτε άλλο ρήστη. Οι κλήσεις μένουν σε αναμονή για 30 δευτερόλεπτα και μετά κλείνουν.  Συνήθως ενεργοποιημένη για όλους.

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
<B>Ρυθμός Ανανέωσης Ταχύτητας -</B> σε χιλιοστά δευτερολέπτου. Χρημοποιείται μόνο εάν η Ταχύτητα Ανανέωσης είναι ενεργοποιημένη. Προκαθορισμένος απενεργοποιημένος ρυθμός είναι 1000 ms (1 δευερόλεπτο).

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
<A NAME="phones-enable_sipsak_messages">
<BR>
<B>Επιτρέψτε τα μηνύματα SIPSAK -</B> εάν επιτρέπεται ο κεντρικόςυπολογιστής θα στείλει τα μηνύματα στο τηλέφωνο ΓΟΥΛΙΏΝ στηνεπίδειξη στην τηλεφωνική LCD επίδειξη όταν συνδέεται μεVICIDIAL. Το χαρακτηριστικό γνώρισμα λειτουργεί μόνο με τατηλέφωνα ΓΟΥΛΙΩΝ και απαιτεί sipsak την εφαρμογή για ναεγκατασταθεί στον κεντρικό υπολογιστή δικτύου. Η προεπιλογήείναι 0.

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
<B>Εκδοση Asterisk</B>.

<BR>
<A NAME="servers-max_vicidial_trunks">
<BR>
<B>Μέγιστος Αριθμός Trunk του VICIDIAL -</B> Αυτό το πεδίο θα προσδιορίσει τον μέγιστο αριθμό γραμμών, τις οποίες θα χρησιμοποιήσει η διεργασία αυτόατης κλήσης. Εάν θέλετε να αφιερώσετε δύο PRI σε ένα διακομιστή τότε θα πρέπει να το ορίσετε σε 46. Το προκαθορισμένο είναι 96.

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
<B>Ενημέρωση Χρήστη Διαχειριστή -</B> Το όνομα χρήστη που χρησιμοποιείτε για σύνδεση στον διακομιστή Asterisk, βελτιστοποιημένο για διεργασίες ενημέρωσης. Το προκαθορισμένο είαι 'updatecron'.

<BR>
<A NAME="servers-ASTmgrUSERNAMElisten">
<BR>
<B>Ακουσμα Χρήστη Διαχειριστή-</B> Το όνομα χρήστη που χρησιμοποιείτε για σύνδεση στον διακομιστή Asterisk, βελτιστοποιημένο για διεργασίες που μόνο ακούν για έξοδο. Τ προκαθορισμένο είναι 'listencron'.

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
<B>Επίδοση Συστήματος -</B> Θέτοντας αυτήν την επιλογή σε Ν, θα ενεργοποιήσετε την καταγραφή στατιστικών γεγονότων επίδοσης για τον διακομιστή, συμπεριλαμβάνοντας το φόρτο του συστήματος, τις διεργασίες και τα κανάλια που χρησιμοποιεί. Προκαθορισμένα είναι Ο.

<BR>
<A NAME="servers-vd_server_logs">
<BR>
<B>Γεγονότα Διακομιστή -</B> Θέτοντας αυτήν την επιλογή σε Ν θα ενεργοποιήσετε την καταγραφή των γεγονότων για όλες τις διεργασίες. Επίσης, η καταγραφή γεγονότων της οθόνης θα είναι απενεργοποιημένη, εάν είναι  Ν όταν το σύστημα ξεκινήσει. Προκαθορισμένα είναι Ν.

<BR>
<A NAME="servers-agi_output">
<BR>
<B>Εξοδος AGI -</B> Θέτοντας αυτήν την επιλογή σε NONE θα απενεργοποιήσετε την έξοδο από όλες τις διαδικασίες AGI. Αν θέσετε STDERR θα σταλεί η έξοδος των AGI στο CLI. Επίσης υπάρχουν οι επιλογές FILE και BOTH. Προκαθορισμένα είναι FILE.

<BR>
<A NAME="servers-vicidial_balance_active">
<BR>
<B>Διακύμανση Τηλεφωνικής Κλήσης -</B> Καθορίζοντας αυτό το πεδίο σε Ν θα επιτρέψει στον εξυπηρετητή να ορίζει κλήσεις διακύμανσης για την εκστρατεία, ώστε το καθορισμένο επίπεδο κλήσης να μπορεί να ικανοποιείται έστω και εάν δεν υπάρχουν συνδεμένοι χειριστές σε αυτήν την εκστρατεία. Προκαθορισμένα είναι Ο.

<BR>
<A NAME="servers-balance_trunks_offlimits">
<BR>
<B>Διακύμανση εκτός ορίων -</B> Καθορίζει τον αριθμό των τηλ.κυκλ.συνδ. που δεν επιτρέπετε στο σύστημα να χειριστεί για Διακύμανση Τηλεφωνικής Κλήσης.


<BR><BR><BR><BR>

<B><FONT SIZE=3>ΠΙΝΑΚΑΣ ΣΥΝΔΙΑΛΕΞΕΩΝ</FONT></B><BR><BR>
<A NAME="conferences-conf_exten">
<BR>
<B>Αριθμός Συνδιάλεξης -</B> Αυτό το πεδίο είναι για τον αριθμό συνδιάλεξης meetme στο σχέδιο κλήσεων. Επίσης, συνιστούμε ο αριθμς meetme στο meetme.conf να ταιριάζει με αυτό τον αριθμό για κάθε καταχώρηση. Αυτό είναι για τις συνδιαλέξε στο astGUIclient και χρησιμοποιείται για την λειτουργία αποχώρησης από κλήση με 3 γραμμές στο VICIDIAL.

<BR>
<A NAME="conferences-server_ip">
<BR>
<B>IP Διακομιστή-</B> Ο κατάλογος που επιλέξατε τον διακομιστή ASTERISK όπου η συνδιάλεξη θα είναι.




<BR><BR><BR><BR>

<B><FONT SIZE=3>VICIDIAL_SERVER_TRUNKS ΠΙΝΑΚΑΣ</FONT></B><BR><BR>
<A NAME="vicidial_server_trunks">
<BR>
<B>Οι Τηλ.Κυκλ.Συνδ. του εξυπηρετητή σας επιτρέπουν να περιορίσετε τις εξερχόμενες γραμμές που χρησιμοποιούνται στον εξυπηρετητή ανά εκστρατεία. Χωρίς αυτές τις εγγραφές, επιτρέπετε στην εκστρατεία να έχει όσες γραμμές μπορεί να έχει, μέχρι τον μέγιστο καθορισμένο αριθμό Τηλ.Κυκλ.Συνδ..</B>





<BR><BR><BR><BR>

<B><FONT SIZE=3>SYSTEM_SETTINGS ΠΙΝΑΚΑΣ</FONT></B><BR><BR>
<A NAME="settings-use_non_latin">
<BR>
<B>Μη-λατινικά χρήσης -</B> αυτή η επιλογή επιτρέπει σε σας για ναπροκαθορίσει το χειρόγραφο επίδειξης Ιστού για να χρησιμοποιήσειUTF8 τους χαρακτήρες και να μην κάνει οποιαδήποτε φιλτράρισμαλατινικός-χαρακτήρας-οικογενειακής κανονική έκφρασης ήμορφοποίηση επίδειξης. Η προεπιλογή είναι 0.

<BR>
<A NAME="settings-webroot_writable">
<BR>
<B>Webroot writable -</B> αυτή η ρύθμιση επιτρέπει σε σας για νακαθορίσει εάν temp τα αρχεία και τα αρχεία επικύρωσης πρέπεινα τοποθετηθούν στο webroot στον κεντρικό υπολογιστή δικτύουσας. Η προεπιλογή είναι 1.

<BR>
<A NAME="settings-enable_queuemetrics_logging">
<BR>
<B>Επιτρέψτε την αναγραφή QueueMetrics -</B> αυτή η ρύθμιση επιτρέπεισε σας για να καθορίσει εάν VICIDIAL θα παρεμβάλει τιςκαταχωρήσεις κούτσουρων στον πίνακα βάσεων δεδομένων queue_logόπως η δραστηριότητα σειρών αναμονής αστερίσκων. ΤοQueueMetrics είναι ένα πρόγραμμα αυτόνομης, ανάλυσηςκλείνω-πηγής στατιστικό. Πρέπει που εγκαταστάθηκε ήδη ναδιαμορφώσετε QueueMetrics και πρίν επιτρέπετε αυτό τοχαρακτηριστικό γνώρισμα. Η προεπιλογή είναι 0.

<BR>
<A NAME="settings-queuemetrics_server_ip">
<BR>
<B>QueueMetrics κεντρικός υπολογιστής IP -</B> αυτό είναι ηδιεύθυνση IP της βάσης δεδομένων για την εγκατάστασηQueueMetrics σας.

<BR>
<A NAME="settings-queuemetrics_dbname">
<BR>
<B>QueueMetrics όνομα βάσεων δεδομένων -</B> αυτό είναι το όνομαβάσεων δεδομένων για τη βάση δεδομένων QueueMetrics σας.

<BR>
<A NAME="settings-queuemetrics_login">
<BR>
<B>QueueMetrics σύνδεση βάσεων δεδομένων -</B> αυτό είναι το όνομαχρηστών που χρησιμοποιείται για να συνδεθεί στη βάση δεδομένωνQueueMetrics σας.

<BR>
<A NAME="settings-queuemetrics_pass">
<BR>
<B>QueueMetrics κωδικός πρόσβασης βάσεων δεδομένων -</B> αυτό είναιο κωδικός πρόσβασης που χρησιμοποιείται για να συνδεθεί στη βάσηδεδομένων QueueMetrics σας.

<BR>
<A NAME="settings-queuemetrics_url">
<BR>
<B>QueueMetrics URL -</B> αυτό είναι η διεύθυνση URL ήιστοχώρων που χρησιμοποιείται για να φτάσει στην εγκατάστασηQueueMetrics σας.

<BR>
<A NAME="settings-queuemetrics_log_id">
<BR>
<B>QueueMetrics ταυτότητα κούτσουρων -</B> αυτό είναι η ταυτότητακεντρικών υπολογιστών που όλα τα κούτσουρα VICIDIAL πουπηγαίνουν στη βάση δεδομένων QueueMetrics θα χρησιμοποιήσουν ωςπροσδιοριστικό για κάθε αρχείο.

<BR>
<A NAME="settings-queuemetrics_eq_prepend">
<BR>
<B>QueueMetrics EnterQueue Prepend -</B> αυτός ο τομέαςχρησιμοποιείται για να επιτρέψει ένας από τους τομείς στοιχείωνvicidial_list μπροστά από τον τηλεφωνικό αριθμό του πελάτη γιατις προσαρμοσμένες εκθέσεις QueueMetrics. Η προεπιλογή δενείναι ΚΑΜΙΑ για να μην εποικήσει τίποτα.

<BR>
<A NAME="settings-vicidial_agent_disable">
<BR>
<B>VICIDIAL ο πράκτορας θέτει εκτός λειτουργίας την επίδειξη -</B> αυτός ο τομέας χρησιμοποιείται για να επιλέξει πότε για ναπαρουσιάσει σε έναν πράκτορα πότε η σύνοδός τους έχει τεθείεκτός λειτουργίας από το σύστημα, μια δράση διευθυντών ή απόένα εξωτερικό μέτρο. Η ρύθμιση NOT_ACTIVE θα θέσει εκτόςλειτουργίας το μήνυμα στην οθόνη πρακτόρων. Η ρύθμισηLIVE_ΧΕΙΡΙΣΤΗΣθα επιδείξει μόνο το εκτός λειτουργίας μήνυμα όταναφαιρεθεί το αρχείο πρακτόρων vicidial_auto_calls, όπως κατάτη διάρκεια μιας αποσύνδεσης δύναμης ή της αποσύνδεσης έκτακτηςανάγκης. 

<BR>
<A NAME="settings-allow_sipsak_messages">
<BR>
<B>Επιτρέψτε τα μηνύματα SIPSAK -</B> εάν θέστε 1, αυτό θα επιτρέψειτον τηλεφωνικό πίνακα θέτοντας για να εργαστεί κατάλληλα, οκεντρικός υπολογιστής θα στείλει τα μηνύματα στο τηλέφωνοΓΟΥΛΙΏΝ στην επίδειξη στην τηλεφωνική LCD επίδειξη ότανσυνδέεται με VICIDIAL. Αυτό το χαρακτηριστικό γνώρισμαλειτουργεί μόνο με τα τηλέφωνα ΓΟΥΛΙΩΝ και απαιτεί sipsak τηνεφαρμογή για να εγκατασταθεί στον κεντρικό υπολογιστή δικτύου. Ηπροεπιλογή είναι 0. 

<BR>
<A NAME="settings-admin_home_url">
<BR>
<B>Σπίτι URL Admin -</B> αυτό είναι η διεύθυνση URL ήιστοχώρων ότι θα πάτε εάν χτυπήσετε στην ΕΓΧΏΡΙΑ σύνδεση στηνκορυφή της σελίδας admin.php.




<BR><BR><BR><BR><BR><BR><BR><BR>
<BR><BR><BR><BR><BR><BR><BR><BR>
ΤΕΛΟΣ
</TD></TR></TABLE></BODY></HTML>
<?
exit;

#### END HELP SCREENS
}





######################
# ADD=73 view dialable leads from a filter and a campaign
######################

if ($ADD==73)
{
	if ($LOGmodify_campaigns==1)
	{
	echo "</title>\n";
	echo "</head>\n";
	echo "<BODY BGCOLOR=white marginheight=0 marginwidth=0 leftmargin=0 topmargin=0>\n";
	echo "<FONT FACE=\"ARIAL,HELVETICA\" COLOR=BLACK SIZE=2>";

	$stmt="SELECT dial_statuses,local_call_time,lead_filter_id from vicidial_campaigns where campaign_id='$campaign_id';";
	$rslt=mysql_query($stmt, $link);
	$row=mysql_fetch_row($rslt);
	$dial_statuses =		$row[0];
	$local_call_time =		$row[1];
	if ($lead_filter_id=='')
		{
		$lead_filter_id =	$row[2];
		if ($lead_filter_id=='') 
			{
			$lead_filter_id='NONE';
			}
		}

	$stmt="SELECT list_id,active,list_name from vicidial_lists where campaign_id='$campaign_id'";
	$rslt=mysql_query($stmt, $link);
	$lists_to_print = mysql_num_rows($rslt);
	$camp_lists='';
	$o=0;
	while ($lists_to_print > $o) {
		$rowx=mysql_fetch_row($rslt);
		$o++;
	if (ereg("Y", $rowx[1])) {$camp_lists .= "'$rowx[0]',";}
	}
	$camp_lists = eregi_replace(".$","",$camp_lists);

	$filterSQL = $filtersql_list[$lead_filter_id];
	$filterSQL = eregi_replace("^and|and$|^or|or$","",$filterSQL);
	if (strlen($filterSQL)>4)
		{$fSQL = "and $filterSQL";}
	else
		{$fSQL = '';}


	echo "<BR><BR>\n";
	echo "<B>Εμφάνιση Μετρητή Κληθέντων Οδηγών</B> -<BR><BR>\n";
	echo "<B>CAMPAIGN:</B> $campaign_id<BR>\n";
	echo "<B>ΛΙΣΤΕΣ:</B> $camp_lists<BR>\n";
	echo "<B>STATUSES:</B> $dial_statuses<BR>\n";
	echo "<B>FILTER:</B> $lead_filter_id<BR>\n";
	echo "<B>CALL TIME:</B> $local_call_time<BR><BR>\n";

	### call function to calculate and print dialable leads
	dialable_leads($DB,$link,$local_call_time,$dial_statuses,$camp_lists,$fSQL);

	echo "<BR><BR>\n";
	echo "</BODY></HTML>\n";

	exit;
	}
	else
	{
	echo "Δεν έχετε την άδεια να δείτε αυτήν την σελίδα\n";
	exit;
	}
}


######################
# ADD=7111111 view sample script with test variables
######################

if ($ADD==7111111)
{
	##### TEST VARIABLES #####
	$vendor_lead_code = 'VENDOR:LEAD;CODE';
	$list_id = 'LISTID';
	$gmt_offset_now = 'GMTOFFSET';
	$phone_code = '1';
	$phone_number = '7275551212';
	$title = 'Mr.';
	$first_name = 'JOHN';
	$middle_initial = 'Q';
	$last_name = 'PUBLIC';
	$address1 = '1234 Main St.';
	$address2 = 'Apt. 3';
	$address3 = 'ADDRESS3';
	$city = 'CHICAGO';
	$state = 'IL';
	$province = 'PROVINCE';
	$postal_code = '33760';
	$country_code = 'USA';
	$gender = 'M';
	$date_of_birth = '1970-01-01';
	$alt_phone = '3125551212';
	$email = 'test@test.com';
	$security_phrase = 'SECUTIRY';
	$comments = 'COMMENTS FIELD';
	$RGfullname = 'JOE AGENT';
	$RGuser = '6666';
	$RGlead_id = '1234';
	$RGcampaign = 'TESTCAMP';
	$RGphone_login = 'gs102';
	$RGgroup = 'TESTCAMP';
	$RGchannel_group = 'TESTCAMP';
	$RGSQLdate = date("Y-m-d H:i:s");
	$RGepoch = date("U");
	$RGuniqueid = '1163095830.4136';
	$RGcustomer_zap_channel = 'Zap/1-1';
	$RGserver_ip = '10.10.10.15';
	$RGSIPexten = 'SIP/gs102';
	$RGsession_id = '8600051';

echo "</title>\n";
echo "</head>\n";
echo "<BODY BGCOLOR=white marginheight=0 marginwidth=0 leftmargin=0 topmargin=0>\n";
echo "<FONT FACE=\"ARIAL,HELVETICA\" COLOR=BLACK SIZE=2>";

$stmt="SELECT * from vicidial_scripts where script_id='$script_id';";
$rslt=mysql_query($stmt, $link);
$row=mysql_fetch_row($rslt);
$script_name =		$row[1];
$script_text =		$row[3];

if (eregi("iframe src",$script_text))
	{
	$vendor_lead_code = eregi_replace(' ','+',$vendor_lead_code);
	$list_id = eregi_replace(' ','+',$list_id);
	$gmt_offset_now = eregi_replace(' ','+',$gmt_offset_now);
	$phone_code = eregi_replace(' ','+',$phone_code);
	$phone_number = eregi_replace(' ','+',$phone_number);
	$title = eregi_replace(' ','+',$title);
	$first_name = eregi_replace(' ','+',$first_name);
	$middle_initial = eregi_replace(' ','+',$middle_initial);
	$last_name = eregi_replace(' ','+',$last_name);
	$address1 = eregi_replace(' ','+',$address1);
	$address2 = eregi_replace(' ','+',$address2);
	$address3 = eregi_replace(' ','+',$address2);
	$city = eregi_replace(' ','+',$city);
	$state = eregi_replace(' ','+',$state);
	$province = eregi_replace(' ','+',$province);
	$postal_code = eregi_replace(' ','+',$postal_code);
	$country_code = eregi_replace(' ','+',$country_code);
	$gender = eregi_replace(' ','+',$gender);
	$date_of_birth = eregi_replace(' ','+',$date_of_birth);
	$alt_phone = eregi_replace(' ','+',$alt_phone);
	$email = eregi_replace(' ','+',$email);
	$security_phrase = eregi_replace(' ','+',$security_phrase);
	$comments = eregi_replace(' ','+',$comments);
	$RGfullname = eregi_replace(' ','+',$RGfullname);
	$RGuser = eregi_replace(' ','+',$RGuser);
	$RGlead_id = eregi_replace(' ','+',$RGlead_id);
	$RGcampaign = eregi_replace(' ','+',$RGcampaign);
	$RGphone_login = eregi_replace(' ','+',$RGphone_login);
	$RGgroup = eregi_replace(' ','+',$RGgroup);
	$RGchannel_group = eregi_replace(' ','+',$RGchannel_group);
	$RGSQLdate = eregi_replace(' ','+',$RGSQLdate);
	$RGepoch = eregi_replace(' ','+',$RGepoch);
	$RGuniqueid = eregi_replace(' ','+',$RGuniqueid);
	$RGcustomer_zap_channel = eregi_replace(' ','+',$RGcustomer_zap_channel);
	$RGserver_ip = eregi_replace(' ','+',$RGserver_ip);
	$RGSIPexten = eregi_replace(' ','+',$RGSIPexten);
	$RGsession_id = eregi_replace(' ','+',$RGsession_id);
	}

$script_text = eregi_replace('--A--vendor_lead_code--B--',"$vendor_lead_code",$script_text);
$script_text = eregi_replace('--A--list_id--B--',"$list_id",$script_text);
$script_text = eregi_replace('--A--gmt_offset_now--B--',"$gmt_offset_now",$script_text);
$script_text = eregi_replace('--A--phone_code--B--',"$phone_code",$script_text);
$script_text = eregi_replace('--A--phone_number--B--',"$phone_number",$script_text);
$script_text = eregi_replace('--A--title--B--',"$title",$script_text);
$script_text = eregi_replace('--A--first_name--B--',"$first_name",$script_text);
$script_text = eregi_replace('--A--middle_initial--B--',"$middle_initial",$script_text);
$script_text = eregi_replace('--A--last_name--B--',"$last_name",$script_text);
$script_text = eregi_replace('--A--address1--B--',"$address1",$script_text);
$script_text = eregi_replace('--A--address2--B--',"$address2",$script_text);
$script_text = eregi_replace('--A--address3--B--',"$address3",$script_text);
$script_text = eregi_replace('--A--city--B--',"$city",$script_text);
$script_text = eregi_replace('--A--state--B--',"$state",$script_text);
$script_text = eregi_replace('--A--province--B--',"$province",$script_text);
$script_text = eregi_replace('--A--postal_code--B--',"$postal_code",$script_text);
$script_text = eregi_replace('--A--country_code--B--',"$country_code",$script_text);
$script_text = eregi_replace('--A--gender--B--',"$gender",$script_text);
$script_text = eregi_replace('--A--date_of_birth--B--',"$date_of_birth",$script_text);
$script_text = eregi_replace('--A--alt_phone--B--',"$alt_phone",$script_text);
$script_text = eregi_replace('--A--email--B--',"$email",$script_text);
$script_text = eregi_replace('--A--security_phrase--B--',"$security_phrase",$script_text);
$script_text = eregi_replace('--A--comments--B--',"$comments",$script_text);
$script_text = eregi_replace('--A--fullname--B--',"$RGfullname",$script_text);
$script_text = eregi_replace('--A--fronter--B--',"$RGuser",$script_text);
$script_text = eregi_replace('--A--user--B--',"$RGuser",$script_text);
$script_text = eregi_replace('--A--lead_id--B--',"$RGlead_id",$script_text);
$script_text = eregi_replace('--A--campaign--B--',"$RGcampaign",$script_text);
$script_text = eregi_replace('--A--phone_login--B--',"$RGphone_login",$script_text);
$script_text = eregi_replace('--A--group--B--',"$RGgroup",$script_text);
$script_text = eregi_replace('--A--channel_group--B--',"$RGchannel_group",$script_text);
$script_text = eregi_replace('--A--SQLdate--B--',"$RGSQLdate",$script_text);
$script_text = eregi_replace('--A--epoch--B--',"$RGepoch",$script_text);
$script_text = eregi_replace('--A--uniqueid--B--',"$RGuniqueid",$script_text);
$script_text = eregi_replace('--A--customer_zap_channel--B--',"$RGcustomer_zap_channel",$script_text);
$script_text = eregi_replace('--A--server_ip--B--',"$RGserver_ip",$script_text);
$script_text = eregi_replace('--A--SIPexten--B--',"$RGSIPexten",$script_text);
$script_text = eregi_replace('--A--session_id--B--',"$RGsession_id",$script_text);
$script_text = eregi_replace("\n","<BR>",$script_text);


echo "<FONT FACE=\"ARIAL,HELVETICA\" COLOR=BLACK SIZE=2>";

echo "Προεπισκόπιση Βοηθού: $script_id<BR>\n";
echo "<TABLE WIDTH=600><TR><TD>\n";
echo "<center><B>$script_name</B><BR></center>\n";
echo "$script_text\n";
echo "</TD></TR></TABLE></center>\n";

echo "</BODY></HTML>\n";

exit;
}




######################### HTML HEADER BEGIN #######################################
if ($hh=='users') 
	{$users_hh="bgcolor =\"$users_color\""; $users_fc="$users_font"; $users_bold="$header_selected_bold";}
	else {$users_hh=''; $users_fc='WHITE'; $users_bold="$header_nonselected_bold";}
if ($hh=='campaigns') 
	{$campaigns_hh="bgcolor=\"$campaigns_color\""; $campaigns_fc="$campaigns_font"; $campaigns_bold="$header_selected_bold";}
	else {$campaigns_hh=''; $campaigns_fc='WHITE'; $campaigns_bold="$header_nonselected_bold";}
if ($hh=='lists') 
	{$lists_hh="bgcolor=\"$lists_color\""; $lists_fc="$lists_font"; $lists_bold="$header_selected_bold";}
	else {$lists_hh=''; $lists_fc='WHITE'; $lists_bold="$header_nonselected_bold";}
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
if ($hh=='filters') 
	{$filters_hh="bgcolor=\"$filters_color\""; $filters_fc="$filters_font"; $filters_bold="$header_selected_bold";}
	else {$filters_hh=''; $filters_fc='WHITE'; $filters_bold="$header_nonselected_bold";}
if ($hh=='admin') 
	{$admin_hh="bgcolor=\"$admin_color\""; $admin_fc="$admin_font"; $admin_bold="$header_selected_bold";}
	else {$admin_hh=''; $admin_fc='WHITE'; $admin_bold="$header_nonselected_bold";}
if ($hh=='reports') 
	{$reports_hh="bgcolor=\"$reports_color\""; $reports_fc="$reports_font"; $reports_bold="$header_selected_bold";}
	else {$reports_hh=''; $reports_fc='WHITE'; $reports_bold="$header_nonselected_bold";}

?>
</title>
<script language="Javascript">
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

</script>
</head>
<BODY BGCOLOR=white marginheight=0 marginwidth=0 leftmargin=0 topmargin=0>
<?
echo "<!-- ILPV -->\n";
echo "<TD WIDTH=100 ALIGN=RIGHT VALIGN=TOP  NOWRAP><a href=\"../vicidial_en/admin.php?relogin=YES&VD_login=$VD_login&VD_campaign=$VD_campaign&phone_login=$phone_login&phone_pass=$phone_pass&VD_pass=$VD_pass\">English <img src=\"../agc/images/en.gif\" BORDER=0 HEIGHT=14 WIDTH=20></a></TD>\n";echo "<TD WIDTH=100 ALIGN=RIGHT VALIGN=TOP  BGCOLOR=\"#CCFFCC\" NOWRAP><a href=\"../vicidial_el/admin.php?relogin=YES&VD_login=$VD_login&VD_campaign=$VD_campaign&phone_login=$phone_login&phone_pass=$phone_pass&VD_pass=$VD_pass\">Ελληνικά <img src=\"../agc/images/el.gif\" BORDER=0 HEIGHT=14 WIDTH=20></a></TD>\n";
$stmt="SELECT admin_home_url from system_settings;";
$rslt=mysql_query($stmt, $link);
$row=mysql_fetch_row($rslt);
$admin_home_url_LU =	$row[0];

?>
<CENTER>
<TABLE WIDTH=<?=$page_width ?> BGCOLOR=#D9E6FE cellpadding=2 cellspacing=0><TR BGCOLOR=#015B91><TD ALIGN=LEFT COLSPAN=5><FONT FACE="ARIAL,HELVETICA" COLOR=WHITE SIZE=2><B> &nbsp; ΔΙΑΧΕΙΡΙΣΗ - <a href="<? echo $admin_home_url_LU ?>"><FONT FACE="ARIAL,HELVETICA" COLOR=WHITE SIZE=1>ΣΠΙΤΙ</a> | <a href="<? echo $PHP_SELF ?>?force_logout=1"><FONT FACE="ARIAL,HELVETICA" COLOR=WHITE SIZE=1>Αποσύνδεση</a></TD><TD ALIGN=RIGHT COLSPAN=6><FONT FACE="ARIAL,HELVETICA" COLOR=WHITE SIZE=2><B><? echo date("l F j, Y G:i:s A") ?> &nbsp; </TD></TR>

<TR BGCOLOR=#015B91>
<TD ALIGN=CENTER <?=$users_hh ?>><a href="<? echo $PHP_SELF ?>?ADD=0"><FONT FACE="ARIAL,HELVETICA" COLOR=<?=$users_fc ?> SIZE=<?=$header_font_size ?>><?=$users_bold ?> Χρήστες </a></TD>
<TD ALIGN=CENTER <?=$campaigns_hh ?>><a href="<? echo $PHP_SELF ?>?ADD=10"><FONT FACE="ARIAL,HELVETICA" COLOR=<?=$campaigns_fc ?> SIZE=<?=$header_font_size ?>><?=$campaigns_bold ?> Εκστρατείες </a></TD>
<TD ALIGN=CENTER <?=$lists_hh ?>><a href="<? echo $PHP_SELF ?>?ADD=100"><FONT FACE="ARIAL,HELVETICA" COLOR=<?=$lists_fc ?> SIZE=<?=$header_font_size ?>><?=$lists_bold ?> Κατάλογοι </a></TD>
<TD ALIGN=CENTER <?=$scripts_hh ?>><a href="<? echo $PHP_SELF ?>?ADD=1000000"><FONT FACE="ARIAL,HELVETICA" COLOR=<?=$scripts_fc ?> SIZE=<?=$header_font_size ?>><?=$scripts_bold ?> Χειρόγραφα </a></TD>
<TD ALIGN=CENTER <?=$filters_hh ?>><a href="<? echo $PHP_SELF ?>?ADD=10000000"><FONT FACE="ARIAL,HELVETICA" COLOR=<?=$filters_fc ?> SIZE=<?=$header_font_size ?>><?=$filters_bold ?> Φίλτρα </a></TD>
<TD ALIGN=CENTER <?=$ingroups_hh ?>><a href="<? echo $PHP_SELF ?>?ADD=1000"><FONT FACE="ARIAL,HELVETICA" COLOR=<?=$ingroups_fc ?> SIZE=<?=$header_font_size ?>><?=$ingroups_bold ?> $$$-ΟΜΑΔΕΣ </a></TD>
<TD ALIGN=CENTER <?=$usergroups_hh ?>><a href="<? echo $PHP_SELF ?>?ADD=100000"><FONT FACE="ARIAL,HELVETICA" COLOR=<?=$usergroups_fc ?> SIZE=<?=$header_font_size ?>><?=$usergroups_bold ?> Ομάδες χρηστών </a></TD>
<TD ALIGN=CENTER <?=$remoteagent_hh ?>><a href="<? echo $PHP_SELF ?>?ADD=10000"><FONT FACE="ARIAL,HELVETICA" COLOR=<?=$remoteagent_fc ?> SIZE=<?=$header_font_size ?>><?=$remoteagent_bold ?> Μακρινοί πράκτορες </a></TD>
<TD ALIGN=CENTER <?=$admin_hh ?>><a href="<? echo $PHP_SELF ?>?ADD=10000000000"><FONT FACE="ARIAL,HELVETICA" COLOR=<?=$admin_fc ?> SIZE=<?=$header_font_size ?>><?=$admin_bold ?> Admin </a></TD>
<TD ALIGN=CENTER <?=$reports_hh ?>><a href="<? echo $PHP_SELF ?>?ADD=999999"><FONT FACE="ARIAL,HELVETICA" COLOR=<?=$reports_fc ?> SIZE=<?=$header_font_size ?>><?=$reports_bold ?> Εκθέσεις </a></TD>
</TR>

<? if (strlen($users_hh) > 1) { 
	?>
<TR BGCOLOR=<?=$users_color ?>><TD ALIGN=LEFT COLSPAN=10><FONT FACE="ARIAL,HELVETICA" COLOR=BLACK SIZE=<?=$subheader_font_size ?>> &nbsp; <a href="<? echo $PHP_SELF ?>"><FONT FACE="ARIAL,HELVETICA" COLOR=BLACK SIZE=<?=$subheader_font_size ?>> Παρουσιάστε χρήστες </a> &nbsp; &nbsp; | &nbsp; &nbsp; <a href="<? echo $PHP_SELF ?>?ADD=1"><FONT FACE="ARIAL,HELVETICA" COLOR=BLACK SIZE=<?=$subheader_font_size ?>> Προσθέστε έναν νέο χρήστη </a> &nbsp; &nbsp; | &nbsp; &nbsp; <a href="<? echo $PHP_SELF ?>?ADD=550"><FONT FACE="ARIAL,HELVETICA" COLOR=BLACK SIZE=<?=$subheader_font_size ?>> Αναζήτηση ενός χρήστη </a></TD></TR>
<? } 
if (strlen($campaigns_hh) > 1) { 
	?>
<TR BGCOLOR=<?=$campaigns_color ?>><TD ALIGN=LEFT COLSPAN=10><FONT FACE="ARIAL,HELVETICA" COLOR=BLACK SIZE=<?=$subheader_font_size ?>> &nbsp; <a href="<? echo $PHP_SELF ?>?ADD=10"><FONT FACE="ARIAL,HELVETICA" COLOR=BLACK SIZE=<?=$subheader_font_size ?>> Παρουσιάστε εκστρατείες </a> &nbsp; &nbsp; | &nbsp; &nbsp; <a href="<? echo $PHP_SELF ?>?ADD=11"><FONT FACE="ARIAL,HELVETICA" COLOR=BLACK SIZE=<?=$subheader_font_size ?>> Προσθέστε μια νέα εκστρατεία </a> &nbsp; &nbsp; | &nbsp; &nbsp; <a href="./AST_timeonVDADallSUMMARY.php"><FONT FACE="ARIAL,HELVETICA" COLOR=BLACK SIZE=<?=$subheader_font_size ?>> Σε πραγματικό χρόνο περίληψη εκστρατειών </a></TD></TR>
<? } 
if (strlen($lists_hh) > 1) { 
	?>
<TR BGCOLOR=<?=$lists_color ?>><TD ALIGN=LEFT COLSPAN=10><FONT FACE="ARIAL,HELVETICA" COLOR=BLACK SIZE=<?=$subheader_font_size ?>> &nbsp; <a href="<? echo $PHP_SELF ?>?ADD=100"><FONT FACE="ARIAL,HELVETICA" COLOR=BLACK SIZE=<?=$subheader_font_size ?>> Παρουσιάστε καταλόγους </a> &nbsp; &nbsp; | &nbsp; &nbsp; <a href="<? echo $PHP_SELF ?>?ADD=111"><FONT FACE="ARIAL,HELVETICA" COLOR=BLACK SIZE=<?=$subheader_font_size ?>> Προσθέστε έναν νέο κατάλογο </a> &nbsp; &nbsp; | &nbsp; &nbsp; <a href="admin_search_lead.php"><FONT FACE="ARIAL,HELVETICA" COLOR=BLACK SIZE=<?=$subheader_font_size ?>> Αναζήτηση ενός μολύβδου </a> &nbsp; &nbsp; | &nbsp; &nbsp; <a href="<? echo $PHP_SELF ?>?ADD=121"><FONT FACE="ARIAL,HELVETICA" COLOR=BLACK SIZE=<?=$subheader_font_size ?>> Προσθέστε τον αριθμό σε DNC </a> &nbsp; &nbsp; | &nbsp; &nbsp; <a href="./listloaderMAIN.php"><FONT FACE="ARIAL,HELVETICA" COLOR=BLACK SIZE=<?=$subheader_font_size ?>> Νέοι μόλυβδοι φορτίων </a></TD></TR>
<? } 
if (strlen($scripts_hh) > 1) { 
	?>
<TR BGCOLOR=<?=$scripts_color ?>><TD ALIGN=LEFT COLSPAN=10><FONT FACE="ARIAL,HELVETICA" COLOR=BLACK SIZE=<?=$subheader_font_size ?>> &nbsp; <a href="<? echo $PHP_SELF ?>?ADD=1000000"><FONT FACE="ARIAL,HELVETICA" COLOR=BLACK SIZE=<?=$subheader_font_size ?>> Παρουσιάστε χειρόγραφα </a> &nbsp; &nbsp; | &nbsp; &nbsp; <a href="<? echo $PHP_SELF ?>?ADD=1111111"><FONT FACE="ARIAL,HELVETICA" COLOR=BLACK SIZE=<?=$subheader_font_size ?>> Προσθέστε ένα νέο χειρόγραφο </a></TD></TR>
<? } 
if (strlen($filters_hh) > 1) { 
	?>
<TR BGCOLOR=<?=$filters_color ?>><TD ALIGN=LEFT COLSPAN=10><FONT FACE="ARIAL,HELVETICA" COLOR=BLACK SIZE=<?=$subheader_font_size ?>> &nbsp; <a href="<? echo $PHP_SELF ?>?ADD=10000000"><FONT FACE="ARIAL,HELVETICA" COLOR=BLACK SIZE=<?=$subheader_font_size ?>> Παρουσιάστε φίλτρα </a> &nbsp; &nbsp; | &nbsp; &nbsp; <a href="<? echo $PHP_SELF ?>?ADD=11111111"><FONT FACE="ARIAL,HELVETICA" COLOR=BLACK SIZE=<?=$subheader_font_size ?>> Προσθέστε ένα νέο φίλτρο </a></TD></TR>
<? } 
if (strlen($ingroups_hh) > 1) { 
	?>
<TR BGCOLOR=<?=$ingroups_color ?>><TD ALIGN=LEFT COLSPAN=10><FONT FACE="ARIAL,HELVETICA" COLOR=BLACK SIZE=<?=$subheader_font_size ?>> &nbsp; <a href="<? echo $PHP_SELF ?>?ADD=1000"><FONT FACE="ARIAL,HELVETICA" COLOR=BLACK SIZE=<?=$subheader_font_size ?>> Παρουσιάστε-ΟΜΑΔΕΣ </a> &nbsp; &nbsp; | &nbsp; &nbsp; <a href="<? echo $PHP_SELF ?>?ADD=1111"><FONT FACE="ARIAL,HELVETICA" COLOR=BLACK SIZE=<?=$subheader_font_size ?>> Προσθέστε μια νέα-ΟΜΑΔΑ </a></TD></TR>
<? } 
if (strlen($usergroups_hh) > 1) { 
	?>
<TR BGCOLOR=<?=$usergroups_color ?>><TD ALIGN=LEFT COLSPAN=10><FONT FACE="ARIAL,HELVETICA" COLOR=BLACK SIZE=<?=$subheader_font_size ?>> &nbsp; <a href="<? echo $PHP_SELF ?>?ADD=100000"><FONT FACE="ARIAL,HELVETICA" COLOR=BLACK SIZE=<?=$subheader_font_size ?>> Παρουσιάστε ομάδες χρηστών </a> &nbsp; &nbsp; | &nbsp; &nbsp; <a href="<? echo $PHP_SELF ?>?ADD=111111"><FONT FACE="ARIAL,HELVETICA" COLOR=BLACK SIZE=<?=$subheader_font_size ?>> Προσθέστε μια νέα ομάδα χρηστών </a> &nbsp; &nbsp; | &nbsp; &nbsp; <a href="group_hourly_stats.php"><FONT FACE="ARIAL,HELVETICA" COLOR=BLACK SIZE=<?=$subheader_font_size ?>> Ωριαία έκθεση ομάδας </a></TD></TR>
<? } 
if (strlen($remoteagent_hh) > 1) { 
	?>
<TR BGCOLOR=<?=$remoteagent_color ?>><TD ALIGN=LEFT COLSPAN=10><FONT FACE="ARIAL,HELVETICA" COLOR=BLACK SIZE=<?=$subheader_font_size ?>> &nbsp; <a href="<? echo $PHP_SELF ?>?ADD=10000"><FONT FACE="ARIAL,HELVETICA" COLOR=BLACK SIZE=<?=$subheader_font_size ?>> Παρουσιάστε μακρινούς πράκτορες </a> &nbsp; &nbsp; | &nbsp; &nbsp; <a href="<? echo $PHP_SELF ?>?ADD=11111"><FONT FACE="ARIAL,HELVETICA" COLOR=BLACK SIZE=<?=$subheader_font_size ?>> Προσθέστε τους νέους μακρινούς πράκτορες </a></TD></TR>
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
	if ($sh=='settings') {$settings_sh="bgcolor=\"$server_color\""; $settings_fc="$server_font";} # pink
		else {$settings_sh=''; $settings_fc='BLACK';}

	?>
<TR BGCOLOR=<?=$admin_color ?>>
<TD ALIGN=LEFT <?=$times_sh ?> COLSPAN=2><a href="<? echo $PHP_SELF ?>?ADD=100000000"><FONT FACE="ARIAL,HELVETICA" COLOR=<?=$times_fc ?> SIZE=<?=$header_font_size ?>> Χρόνοι κλήσης </a></TD>
<TD ALIGN=LEFT <?=$phones_sh ?> COLSPAN=2><a href="<? echo $PHP_SELF ?>?ADD=10000000000"><FONT FACE="ARIAL,HELVETICA" COLOR=<?=$phones_fc ?> SIZE=<?=$header_font_size ?>> Τηλέφωνα </a></TD>
<TD ALIGN=LEFT <?=$conference_sh ?> COLSPAN=2><a href="<? echo $PHP_SELF ?>?ADD=1000000000000"><FONT FACE="ARIAL,HELVETICA" COLOR=<?=$conference_fc ?> SIZE=<?=$header_font_size ?>> Διασκέψεις </a></TD>
<TD ALIGN=LEFT <?=$server_sh ?> COLSPAN=1><a href="<? echo $PHP_SELF ?>?ADD=100000000000"><FONT FACE="ARIAL,HELVETICA" COLOR=<?=$server_fc ?> SIZE=<?=$header_font_size ?>> Κεντρικοί υπολογιστές </a></TD>
<TD ALIGN=LEFT <?=$settings_sh ?> COLSPAN=3><a href="<? echo $PHP_SELF ?>?ADD=311111111111111"><FONT FACE="ARIAL,HELVETICA" COLOR=<?=$settings_fc ?> SIZE=<?=$header_font_size ?>> Τοποθετήσεις συστημάτων </a></TD>
</TR>
	<?
	if (strlen($times_sh) > 1) { 
		?>
	<TR BGCOLOR=<?=$times_color ?>><TD ALIGN=LEFT COLSPAN=10><FONT FACE="ARIAL,HELVETICA" COLOR=BLACK SIZE=<?=$subheader_font_size ?>> &nbsp; <a href="<? echo $PHP_SELF ?>?ADD=100000000"><FONT FACE="ARIAL,HELVETICA" COLOR=BLACK SIZE=<?=$subheader_font_size ?>> Παρουσιάστε χρόνους κλήσης </a> &nbsp; &nbsp; | &nbsp; &nbsp; <a href="<? echo $PHP_SELF ?>?ADD=111111111"><FONT FACE="ARIAL,HELVETICA" COLOR=BLACK SIZE=<?=$subheader_font_size ?>> Προσθέστε έναν νέο χρόνο κλήσης </a> &nbsp; &nbsp; | &nbsp; &nbsp; <a href="<? echo $PHP_SELF ?>?ADD=1000000000"><FONT FACE="ARIAL,HELVETICA" COLOR=BLACK SIZE=<?=$subheader_font_size ?>> Παρουσιάστε χρόνους κρατικής κλήσης </a> &nbsp; &nbsp; |  &nbsp; &nbsp; <a href="<? echo $PHP_SELF ?>?ADD=1111111111"><FONT FACE="ARIAL,HELVETICA" COLOR=BLACK SIZE=<?=$subheader_font_size ?>> Προσθέστε έναν νέο χρόνο κρατικής κλήσης </a> &nbsp; </TD></TR>
		<? } 
	if (strlen($phones_sh) > 1) { 
		?>
	<TR BGCOLOR=<?=$phones_color ?>><TD ALIGN=LEFT COLSPAN=10><FONT FACE="ARIAL,HELVETICA" COLOR=BLACK SIZE=<?=$subheader_font_size ?>> &nbsp; <a href="<? echo $PHP_SELF ?>?ADD=10000000000"><FONT FACE="ARIAL,HELVETICA" COLOR=BLACK SIZE=<?=$subheader_font_size ?>> Παρουσιάστε τηλέφωνα </a> &nbsp; | &nbsp; <a href="<? echo $PHP_SELF ?>?ADD=11111111111"><FONT FACE="ARIAL,HELVETICA" COLOR=BLACK SIZE=<?=$subheader_font_size ?>> Προσθέστε ένα νέο τηλέφωνο </a></TD></TR>
		<? }
	if (strlen($conference_sh) > 1) { 
		?>
	<TR BGCOLOR=<?=$conference_color ?>><TD ALIGN=LEFT COLSPAN=10><a href="<? echo $PHP_SELF ?>?ADD=1000000000000"><FONT FACE="ARIAL,HELVETICA" COLOR=BLACK SIZE=<?=$subheader_font_size ?>> Παρουσιάστε διασκέψεις </a> &nbsp; | &nbsp; <a href="<? echo $PHP_SELF ?>?ADD=1111111111111"><FONT FACE="ARIAL,HELVETICA" COLOR=BLACK SIZE=<?=$subheader_font_size ?>> Προσθέστε μια νέα διάσκεψη </a> &nbsp; | &nbsp; <a href="<? echo $PHP_SELF ?>?ADD=10000000000000"><FONT FACE="ARIAL,HELVETICA" COLOR=BLACK SIZE=<?=$subheader_font_size ?>> Παρουσιάστε διασκέψεις VICIDIAL </a> &nbsp; | &nbsp; <a href="<? echo $PHP_SELF ?>?ADD=11111111111111"><FONT FACE="ARIAL,HELVETICA" COLOR=BLACK SIZE=<?=$subheader_font_size ?>> Προσθέστε μια νέα διάσκεψη VICIDIAL </a></TD></TR>
		<? }
	if (strlen($server_sh) > 1) { 
		?>
	<TR BGCOLOR=<?=$server_color ?>><TD ALIGN=LEFT COLSPAN=10><a href="<? echo $PHP_SELF ?>?ADD=100000000000"><FONT FACE="ARIAL,HELVETICA" COLOR=BLACK SIZE=<?=$subheader_font_size ?>> Παρουσιάστε κεντρικούς υπολογιστές </a> &nbsp; | &nbsp; <a href="<? echo $PHP_SELF ?>?ADD=111111111111"><FONT FACE="ARIAL,HELVETICA" COLOR=BLACK SIZE=<?=$subheader_font_size ?>> Προσθέστε έναν νέο κεντρικό υπολογιστή </a></TD></TR>
	<?}
	if (strlen($settings_sh) > 1) { 
		?>
	<TR BGCOLOR=<?=$settings_color ?>><TD ALIGN=LEFT COLSPAN=10><a href="<? echo $PHP_SELF ?>?ADD=311111111111111"><FONT FACE="ARIAL,HELVETICA" COLOR=BLACK SIZE=<?=$subheader_font_size ?>> Τοποθετήσεις συστημάτων </a></TD></TR>
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
<TR BGCOLOR=<?=$reports_color ?>><TD ALIGN=LEFT COLSPAN=10><FONT FACE="ARIAL,HELVETICA" COLOR=BLACK SIZE=<?=$subheader_font_size ?>><B> &nbsp; </TD></TR>
<? } ?>


<TR><TD ALIGN=LEFT COLSPAN=10 HEIGHT=2 BGCOLOR=#015B91></TD></TR>
<TR><TD ALIGN=LEFT COLSPAN=10>
<? 
######################### HTML HEADER BEGIN #######################################





######################################################################################################
######################################################################################################
#######   1 series, ADD NEW forms for inserting new records into the database
######################################################################################################
######################################################################################################


######################
# ADD=1 display the ADD NEW USER FORM SCREEN
######################

if ($ADD==1)
{
	if ($LOGmodify_users==1)
	{
	echo "<TABLE><TR><TD>\n";
	echo "<FONT FACE=\"ARIAL,HELVETICA\" COLOR=BLACK SIZE=2>";

	echo "<br>ΠΡΟΣΘΗΚΗ ΝΕΟΥ ΧΡΗΣΤΗ<form action=$PHP_SELF method=POST>\n";
	echo "<input type=hidden name=ADD value=2>\n";
	echo "<center><TABLE width=$section_width cellspacing=3>\n";
	echo "<tr bgcolor=#B6D3FC><td align=right>Αριθμός Χρήστη: </td><td align=left><input type=text name=user size=20 maxlength=10>$NWB#vicidial_users-user$NWE</td></tr>\n";
	echo "<tr bgcolor=#B6D3FC><td align=right>Κωδικός:</td><td align=left><input type=text name=pass size=20 maxlength=10>$NWB#vicidial_users-pass$NWE</td></tr>\n";
	echo "<tr bgcolor=#B6D3FC><td align=right>Πλήρες Ονομα: </td><td align=left><input type=text name=full_name size=20 maxlength=100>$NWB#vicidial_users-full_name$NWE</td></tr>\n";
	echo "<tr bgcolor=#B6D3FC><td align=right>Επίπεδο Χρήστη: </td><td align=left><select size=1 name=user_level>";
	$h=1;
	while ($h<=$LOGuser_level)
		{
		echo "<option>$h</option>";
		$h++;
		}
	echo "</select>$NWB#vicidial_users-user_level$NWE</td></tr>\n";
	echo "<tr bgcolor=#B6D3FC><td align=right>Ομάδα Χρήστη: </td><td align=left><select size=1 name=user_group>\n";

		$stmt="SELECT user_group,group_name from vicidial_user_groups order by user_group";
		$rslt=mysql_query($stmt, $link);
		$Ugroups_to_print = mysql_num_rows($rslt);
		$Ugroups_list='';

		$o=0;
		while ($Ugroups_to_print > $o) {
			$rowx=mysql_fetch_row($rslt);
			$Ugroups_list .= "<option value=\"$rowx[0]\">$rowx[0] - $rowx[1]</option>\n";
			$o++;
		}
	echo "$Ugroups_list";
	echo "<option SELECTED>$user_group</option>\n";
	echo "<tr bgcolor=#B6D3FC><td align=right>Τηλέφωνο Σύνδεσης: </td><td align=left><input type=text name=phone_login size=20 maxlength=20>$NWB#vicidial_users-phone_login$NWE</td></tr>\n";
	echo "<tr bgcolor=#B6D3FC><td align=right>Κωδικός Πρόσβασης Τηλεφώνου: </td><td align=left><input type=text name=phone_pass size=20 maxlength=20>$NWB#vicidial_users-phone_pass$NWE</td></tr>\n";
	echo "</select>$NWB#vicidial_users-user_group$NWE</td></tr>\n";
	echo "<tr bgcolor=#B6D3FC><td align=center colspan=2><input type=submit name=ΕΠΙΒΕΒΑΙΩΣΗ value=ΕΠΙΒΕΒΑΙΩΣΗ></td></tr>\n";
	echo "</TABLE></center>\n";
	}
	else
	{
	echo "Δεν έχετε την άδεια να δείτε αυτήν την σελίδα\n";
	exit;
	}
}


######################
# ADD=11 display the ADD NEW CAMPAIGN FORM SCREEN
######################

if ($ADD==11)
{
	if ($LOGmodify_campaigns==1)
	{
	echo "<TABLE><TR><TD>\n";
	echo "<FONT FACE=\"ARIAL,HELVETICA\" COLOR=BLACK SIZE=2>";

	echo "<br>ΠΡΟΣΘΗΚΗ ΝΕΑΣ ΕΚΣΤΡΑΤΕΙΑΣ<form action=$PHP_SELF method=POST>\n";
	echo "<input type=hidden name=ADD value=21>\n";
	echo "<center><TABLE width=$section_width cellspacing=3>\n";
	echo "<tr bgcolor=#B6D3FC><td align=right>ID Εκστρατείας: </td><td align=left><input type=text name=campaign_id size=10 maxlength=8>$NWB#vicidial_campaigns-campaign_id$NWE</td></tr>\n";
	echo "<tr bgcolor=#B6D3FC><td align=right>Ονομα Εκστρατείας: </td><td align=left><input type=text name=campaign_name size=30 maxlength=30>$NWB#vicidial_campaigns-campaign_name$NWE</td></tr>\n";
	echo "<tr bgcolor=#B6D3FC><td align=right>Περιγραφή εκστρατείας: </td><td align=left><input type=text name=campaign_description size=30 maxlength=255>$NWB#vicidial_campaigns-campaign_description$NWE</td></tr>\n";
	echo "<tr bgcolor=#B6D3FC><td align=right>Ενεργή:</td><td align=left><select size=1 name=active><option>Y</option><option>N</option></select>$NWB#vicidial_campaigns-active$NWE</td></tr>\n";
	echo "<tr bgcolor=#B6D3FC><td align=right>Τηλ.σύνδ. Στάθμευσης: </td><td align=left><input type=text name=park_ext size=10 maxlength=10>$NWB#vicidial_campaigns-park_ext$NWE</td></tr>\n";
	echo "<tr bgcolor=#B6D3FC><td align=right>Ονομα Αρχείου Στάθμευσης: </td><td align=left><input type=text name=park_file_name size=10 maxlength=10>$NWB#vicidial_campaigns-park_file_name$NWE</td></tr>\n";
	echo "<tr bgcolor=#B6D3FC><td align=right>Ιστο-σελίδα: </td><td align=left><input type=text name=web_form_address size=50 maxlength=255>$NWB#vicidial_campaigns-web_form_address$NWE</td></tr>\n";
	echo "<tr bgcolor=#B6D3FC><td align=right>Επιτρέπω τους Closers: </td><td align=left><select size=1 name=allow_closers><option>Y</option><option>N</option></select>$NWB#vicidial_campaigns-allow_closers$NWE</td></tr>\n";
	echo "<tr bgcolor=#B6D3FC><td align=right>Επίπεδο Hopper: </td><td align=left><select size=1 name=hopper_level><option>1</option><option>5</option><option>10</option><option>50</option><option>100</option><option>200</option><option>500</option><option>1000</option><option>2000</option></select>$NWB#vicidial_campaigns-hopper_level$NWE</td></tr>\n";
	echo "<tr bgcolor=#B6D3FC><td align=right>ΕΠΙΠΕΔΟ ΑΥΤΟΜΑΤΗΣ ΚΛΗΣΗΣ: </td><td align=left><select size=1 name=auto_dial_level><option selected>0</option><option>1</option><option>1.1</option><option>1.2</option><option>1.3</option><option>1.4</option><option>1.5</option><option>1.6</option><option>1.7</option><option>1.8</option><option>1.9</option><option>2.0</option><option>2.2</option><option>2.5</option><option>2.7</option><option>3.0</option><option>3.5</option><option>4.0</option></select>(0 = off)$NWB#vicidial_campaigns-auto_dial_level$NWE</td></tr>\n";
	echo "<tr bgcolor=#B6D3FC><td align=right>Επόμενη Κλήση Χειριστή: </td><td align=left><select size=1 name=next_agent_call><option >random</option><option>oldest_call_start</option><option>oldest_call_finish</option><option>overall_user_level</option></select>$NWB#vicidial_campaigns-next_agent_call$NWE</td></tr>\n";
	echo "<tr bgcolor=#B6D3FC><td align=right>Χρόνος Τοπικής Κλήσης: </td><td align=left><select size=1 name=local_call_time><option>24hours</option><option>9am-9pm</option><option>9am-5pm</option><option>12pm-5pm</option><option>12pm-9pm</option><option>5pm-9pm</option></select>$NWB#vicidial_campaigns-local_call_time$NWE</td></tr>\n";
	echo "<tr bgcolor=#B6D3FC><td align=right>ΦΩΝΗΤΙΚΟ ΤΑΧΥΔΡΟΜΕΙΟ: </td><td align=left><input type=text name=voicemail_ext size=10 maxlength=10 value=\"$voicemail_ext\">$NWB#vicidial_campaigns-voicemail_ext$NWE</td></tr>\n";
	echo "<tr bgcolor=#B6D3FC><td align=right>Βοηθός: </td><td align=left><select size=1 name=script_id>\n";
	echo "$scripts_list";
	echo "</select>$NWB#vicidial_campaigns-campaign_script$NWE</td></tr>\n";
	echo "<tr bgcolor=#B6D3FC><td align=right>Κατά την έναρξη κλήσης: </td><td align=left><select size=1 name=get_call_launch><option selected>NONE</option><option>SCRIPT</option><option>WEBFORM</option></select>$NWB#vicidial_campaigns-get_call_launch$NWE</td></tr>\n";
	echo "<tr bgcolor=#B6D3FC><td align=center colspan=2><input type=submit name=ΕΠΙΒΕΒΑΙΩΣΗ value=ΕΠΙΒΕΒΑΙΩΣΗ></td></tr>\n";
	echo "</TABLE></center>\n";
	}
	else
	{
	echo "Δεν έχετε την άδεια να δείτε αυτήν την σελίδα\n";
	exit;
	}
}


######################
# ADD=111 display the ADD NEW LIST FORM SCREEN
######################

if ($ADD==111)
{
	if ($LOGmodify_lists==1)
	{
	echo "<TABLE><TR><TD>\n";
	echo "<FONT FACE=\"ARIAL,HELVETICA\" COLOR=BLACK SIZE=2>";

	echo "<br>ADD A NEW LIST<form action=$PHP_SELF method=POST>\n";
	echo "<input type=hidden name=ADD value=211>\n";
	echo "<center><TABLE width=$section_width cellspacing=3>\n";
	echo "<tr bgcolor=#B6D3FC><td align=right>ID Λίστας: </td><td align=left><input type=text name=list_id size=8 maxlength=8> (μόνο αριθμοί)$NWB#vicidial_lists-list_id$NWE</td></tr>\n";
	echo "<tr bgcolor=#B6D3FC><td align=right>Ονομα Λίστας: </td><td align=left><input type=text name=list_name size=20 maxlength=20>$NWB#vicidial_lists-list_name$NWE</td></tr>\n";
	echo "<tr bgcolor=#B6D3FC><td align=right>Περιγραφή καταλόγων: </td><td align=left><input type=text name=list_description size=30 maxlength=255>$NWB#vicidial_lists-list_description$NWE</td></tr>\n";
	echo "<tr bgcolor=#B6D3FC><td align=right>Εκστρατεία: </td><td align=left><select size=1 name=campaign_id>\n";

		$stmt="SELECT campaign_id,campaign_name from vicidial_campaigns order by campaign_id";
		$rslt=mysql_query($stmt, $link);
		$campaigns_to_print = mysql_num_rows($rslt);
		$campaigns_list='';

		$o=0;
		while ($campaigns_to_print > $o) {
			$rowx=mysql_fetch_row($rslt);
			$campaigns_list .= "<option value=\"$rowx[0]\">$rowx[0] - $rowx[1]</option>\n";
			$o++;
		}
	echo "$campaigns_list";
	echo "<option SELECTED>$campaign_id</option>\n";
	echo "</select>$NWB#vicidial_lists-campaign_id$NWE</td></tr>\n";
	echo "<tr bgcolor=#B6D3FC><td align=right>Ενεργή:</td><td align=left><select size=1 name=active><option>Y</option><option SELECTED>N</option></select>$NWB#vicidial_lists-active$NWE</td></tr>\n";
	echo "<tr bgcolor=#B6D3FC><td align=center colspan=2><input type=submit name=ΕΠΙΒΕΒΑΙΩΣΗ value=ΕΠΙΒΕΒΑΙΩΣΗ></td></tr>\n";
	echo "</TABLE></center>\n";
	}
	else
	{
	echo "Δεν έχετε την άδεια να δείτε αυτήν την σελίδα\n";
	exit;
	}
}


######################
# ADD=121 display the ADD NUMBER TO DNC FORM SCREEN and add a new number
######################

if ($ADD==121)
{
echo "<TABLE><TR><TD>\n";
echo "<FONT FACE=\"ARIAL,HELVETICA\" COLOR=BLACK SIZE=2>";

if (strlen($phone_number) > 2)
	{
	$stmt="SELECT count(*) from vicidial_dnc where phone_number='$phone_number';";
	$rslt=mysql_query($stmt, $link);
	$row=mysql_fetch_row($rslt);
	if ($row[0] > 0)
		{echo "<br>DNC ΠΡΟΣΤΙΘΈΜΕΝΟ - αυτός ο τηλεφωνικός αριθμός είναι ήδη δενκαλεί τον κατάλογο: $phone_number<BR><BR>\n";}
	else
		{
		$stmt="INSERT INTO vicidial_dnc (phone_number) values('$phone_number');";
		$rslt=mysql_query($stmt, $link);

		echo "<br><B>DNC ΠΡΟΣΤΙΘΈΜΕΝΟ: $phone_number</B><BR><BR>\n";

		### LOG INSERTION TO LOG FILE ###
		if ($WeBRooTWritablE > 0)
			{
			$fp = fopen ("./admin_changes_log.txt", "a");
			fwrite ($fp, "$date|ADD A NEW DNC NUMBER|$PHP_AUTH_USER|$ip|'$phone_number'|\n");
			fclose($fp);
			}
		}
	}

echo "<br>ΠΡΟΣΘΕΣΤΕ έναν ΑΡΙΘΜΟ στον ΚΑΤΑΛΟΓΟ DNC<form action=$PHP_SELF method=POST>\n";
echo "<input type=hidden name=ADD value=121>\n";
echo "<center><TABLE width=$section_width cellspacing=3>\n";
echo "<tr bgcolor=#B6D3FC><td align=right>Τηλεφωνικός αριθμός: </td><td align=left><input type=text name=phone_number size=14 maxlength=12> (μόνο αριθμοί)$NWB#vicidial_list-dnc$NWE</td></tr>\n";
echo "<tr bgcolor=#B6D3FC><td align=center colspan=2><input type=submit name=ΕΠΙΒΕΒΑΙΩΣΗ value=ΕΠΙΒΕΒΑΙΩΣΗ></td></tr>\n";
echo "</TABLE></center>\n";

}


######################
# ADD=1111 display the ADD NEW INBOUND GROUP SCREEN
######################

if ($ADD==1111)
{
	if ($LOGmodify_ingroups==1)
	{
	echo "<TABLE><TR><TD>\n";
	echo "<FONT FACE=\"ARIAL,HELVETICA\" COLOR=BLACK SIZE=2>";

	echo "<br>ΠΡΟΣΘΗΚΗ ΕΙΣΕΡΧΟΜΕΝΗΣ ΟΜΑΔΑΣ<form action=$PHP_SELF method=POST>\n";
	echo "<input type=hidden name=ADD value=2111>\n";
	echo "<center><TABLE width=$section_width cellspacing=3>\n";
	echo "<tr bgcolor=#B6D3FC><td align=right>ID Ομάδας: </td><td align=left><input type=text name=group_id size=20 maxlength=20> (no spaces)$NWB#vicidial_inbound_groups-group_id$NWE</td></tr>\n";
	echo "<tr bgcolor=#B6D3FC><td align=right>Ονομα Ομάδας: </td><td align=left><input type=text name=group_name size=30 maxlength=30>$NWB#vicidial_inbound_groups-group_name$NWE</td></tr>\n";
	echo "<tr bgcolor=#B6D3FC><td align=right>Χρώμα Ομάδας: </td><td align=left><input type=text name=group_color size=7 maxlength=7>$NWB#vicidial_inbound_groups-group_color$NWE</td></tr>\n";
	echo "<tr bgcolor=#B6D3FC><td align=right>Ενεργή:</td><td align=left><select size=1 name=active><option SELECTED>Y</option><option>N</option></select>$NWB#vicidial_inbound_groups-active$NWE</td></tr>\n";
	echo "<tr bgcolor=#B6D3FC><td align=right>Ιστο-σελίδα: </td><td align=left><input type=text name=web_form_address size=50 maxlength=255 value=\"$web_form_address\">$NWB#vicidial_inbound_groups-web_form_address$NWE</td></tr>\n";
	echo "<tr bgcolor=#B6D3FC><td align=right>ΦΩΝΗΤΙΚΟ ΤΑΧΥΔΡΟΜΕΙΟ: </td><td align=left><input type=text name=voicemail_ext size=10 maxlength=10 value=\"$voicemail_ext\">$NWB#vicidial_inbound_groups-voicemail_ext$NWE</td></tr>\n";
	echo "<tr bgcolor=#B6D3FC><td align=right>Επόμενη Κλήση Χειριστή: </td><td align=left><select size=1 name=next_agent_call><option >random</option><option>oldest_call_start</option><option>oldest_call_finish</option><option>overall_user_level</option></select>$NWB#vicidial_inbound_groups-next_agent_call$NWE</td></tr>\n";
	echo "<tr bgcolor=#B6D3FC><td align=right>Μπροστινή Οθόνη: </td><td align=left><select size=1 name=fronter_display><option SELECTED>Y</option><option>N</option></select>$NWB#vicidial_inbound_groups-fronter_display$NWE</td></tr>\n";
	echo "<tr bgcolor=#B6D3FC><td align=right>Βοηθός: </td><td align=left><select size=1 name=script_id>\n";
	echo "$scripts_list";
	echo "</select>$NWB#vicidial_inbound_groups-ingroup_script$NWE</td></tr>\n";
	echo "<tr bgcolor=#B6D3FC><td align=right>Κατά την έναρξη κλήσης: </td><td align=left><select size=1 name=get_call_launch><option selected>NONE</option><option>SCRIPT</option><option>WEBFORM</option></select>$NWB#vicidial_inbound_groups-get_call_launch$NWE</td></tr>\n";
	echo "<tr bgcolor=#B6D3FC><td align=center colspan=2><input type=submit name=ΕΠΙΒΕΒΑΙΩΣΗ value=ΕΠΙΒΕΒΑΙΩΣΗ></td></tr>\n";
	echo "</TABLE></center>\n";
	}
	else
	{
	echo "Δεν έχετε την άδεια να δείτε αυτήν την σελίδα\n";
	exit;
	}
}


######################
# ADD=11111 display the ADD NEW REMOTE AGENTS SCREEN
######################

if ($ADD==11111)
{
	if ($LOGmodify_remoteagents==1)
	{
	echo "<TABLE><TR><TD>\n";
	echo "<FONT FACE=\"ARIAL,HELVETICA\" COLOR=BLACK SIZE=2>";

	echo "<br>ΠΡΟΣΘΗΚΗ ΝΕΩΝ ΑΠΟΜΑΚΡΥΣΜΕΝΩΝ ΧΕΙΡΙΣΤΩΝ<form action=$PHP_SELF method=POST>\n";
	echo "<input type=hidden name=ADD value=21111>\n";
	echo "<center><TABLE width=$section_width cellspacing=3>\n";
	echo "<tr bgcolor=#B6D3FC><td align=right>ID Χρήστη Ξεκινά: </td><td align=left><input type=text name=user_start size=6 maxlength=6> (μόνο αριθμοί, incremented)$NWB#vicidial_remote_agents-user_start$NWE</td></tr>\n";
	echo "<tr bgcolor=#B6D3FC><td align=right>Αριθμός Γραμμών: </td><td align=left><input type=text name=number_of_lines size=3 maxlength=3> (μόνο αριθμοί)$NWB#vicidial_remote_agents-number_of_lines$NWE</td></tr>\n";
	echo "<tr bgcolor=#B6D3FC><td align=right>IP Διακομιστή: </td><td align=left><select size=1 name=server_ip>\n";
	echo "$servers_list";
	echo "</select>$NWB#vicidial_remote_agents-server_ip$NWE</td></tr>\n";
	echo "<tr bgcolor=#B6D3FC><td align=right>Εξωτερική Τηλ. Σύνδεση: </td><td align=left><input type=text name=conf_exten size=20 maxlength=20> (ο αριθμός που κλήθηκε από το πλάνο κλήσεων για να καλέσει τους χειριστές)$NWB#vicidial_remote_agents-conf_exten$NWE</td></tr>\n";
	echo "<tr bgcolor=#B6D3FC><td align=right>Κατάσταση:</td><td align=left><select size=1 name=status><option>ΕΝΕΡΓΟ</option><option SELECTED>INACTIVE</option></select>$NWB#vicidial_remote_agents-status$NWE</td></tr>\n";
	echo "<tr bgcolor=#B6D3FC><td align=right>Εκστρατεία: </td><td align=left><select size=1 name=campaign_id>\n";
	echo "$campaigns_list";
	echo "</select>$NWB#vicidial_remote_agents-campaign_id$NWE</td></tr>\n";
	echo "<tr bgcolor=#B6D3FC><td align=right>Εισερχόμενες Ομάδες: </td><td align=left>\n";
	echo "$groups_list";
	echo "$NWB#vicidial_remote_agents-closer_campaigns$NWE</td></tr>\n";
	echo "<tr bgcolor=#B6D3FC><td align=center colspan=2><input type=submit name=ΕΠΙΒΕΒΑΙΩΣΗ value=ΕΠΙΒΕΒΑΙΩΣΗ></td></tr>\n";
	echo "</TABLE></center>\n";
	echo "ΣΗΜΕΙΩΣΗ: Μπορεί να διαρκέσει και 30 δευτερόλεπτα για να καταχωρηθούν οι αλλαγές της οθόνης\n";
	}
	else
	{
	echo "Δεν έχετε την άδεια να δείτε αυτήν την σελίδα\n";
	exit;
	}
}


######################
# ADD=111111 display the ADD NEW USERS GROUP SCREEN
######################

if ($ADD==111111)
{
	if ($LOGmodify_usergroups==1)
	{
	echo "<TABLE><TR><TD>\n";
	echo "<FONT FACE=\"ARIAL,HELVETICA\" COLOR=BLACK SIZE=2>";

	echo "<br>ΠΡΟΣΘΗΚΗ ΟΜΑΔΑΣ ΧΡΗΣΤΩΝ<form action=$PHP_SELF method=POST>\n";
	echo "<input type=hidden name=ADD value=211111>\n";
	echo "<center><TABLE width=$section_width cellspacing=3>\n";
	echo "<tr bgcolor=#B6D3FC><td align=right>Ομάδα:</td><td align=left><input type=text name=user_group size=15 maxlength=20> (όχι κενά ή στίξη)$NWB#vicidial_user_groups-user_group$NWE</td></tr>\n";
	echo "<tr bgcolor=#B6D3FC><td align=right>Περιγραφή:</td><td align=left><input type=text name=group_name size=40 maxlength=40> (περιγραφή ομάδας)$NWB#vicidial_user_groups-group_name$NWE</td></tr>\n";
	echo "<tr bgcolor=#B6D3FC><td align=center colspan=2><input type=submit name=ΕΠΙΒΕΒΑΙΩΣΗ value=ΕΠΙΒΕΒΑΙΩΣΗ></td></tr>\n";
	echo "</TABLE></center>\n";
	}
	else
	{
	echo "Δεν έχετε την άδεια να δείτε αυτήν την σελίδα\n";
	exit;
	}
}


######################
# ADD=1111111 display the ADD NEW SCRIPT SCREEN
######################

if ($ADD==1111111)
{
	if ($LOGmodify_scripts==1)
	{
	echo "<TABLE><TR><TD>\n";
	echo "<FONT FACE=\"ARIAL,HELVETICA\" COLOR=BLACK SIZE=2>";

	echo "<br>ADD NEW SCRIPT<form name=scriptForm action=$PHP_SELF method=POST>\n";
	echo "<input type=hidden name=ADD value=2111111>\n";
	echo "<center><TABLE width=$section_width cellspacing=3>\n";
	echo "<tr bgcolor=#B6D3FC><td align=right>Ταυτότητα χειρογράφων:: </td><td align=left><input type=text name=script_id size=12 maxlength=10> (όχι κενά ή στίξη)$NWB#vicidial_scripts-script_id$NWE</td></tr>\n";
	echo "<tr bgcolor=#B6D3FC><td align=right>Όνομα χειρογράφων: </td><td align=left><input type=text name=script_name size=40 maxlength=50> (τίτλος του βοηθού)$NWB#vicidial_scripts-script_name$NWE</td></tr>\n";
	echo "<tr bgcolor=#B6D3FC><td align=right>Σχόλια χειρόγραφου: </td><td align=left><input type=text name=script_comments size=50 maxlength=255> $NWB#vicidial_scripts-script_comments$NWE</td></tr>\n";
	echo "<tr bgcolor=#B6D3FC><td align=right>Ενεργή:</td><td align=left><select size=1 name=active><option SELECTED>Y</option><option>N</option></select>$NWB#vicidial_scripts-active$NWE</td></tr>\n";
	echo "<tr bgcolor=#B6D3FC><td align=right>Κείμενο χειρόγραφου: </td><td align=left>";
	# BEGIN Insert Field
	echo "<select id=\"selectedField\" name=\"selectedField\">";
	echo "<option>vendor_lead_code</option>";
	echo "<option>source_id</option>";
	echo "<option>list_id</option>";
	echo "<option>gmt_offset_now</option>";
	echo "<option>called_since_last_reset</option>";
	echo "<option>phone_code</option>";
	echo "<option>phone_number</option>";
	echo "<option>title</option>";
	echo "<option>first_name</option>";
	echo "<option>middle_initial</option>";
	echo "<option>last_name</option>";
	echo "<option>address1</option>";
	echo "<option>address2</option>";
	echo "<option>address3</option>";
	echo "<option>city</option>";
	echo "<option>state</option>";
	echo "<option>province</option>";
	echo "<option>postal_code</option>";
	echo "<option>country_code</option>";
	echo "<option>gender</option>";
	echo "<option>date_of_birth</option>";
	echo "<option>alt_phone</option>";
	echo "<option>email</option>";
	echo "<option>security_phrase</option>";
	echo "<option>comments</option>";
	echo "<option>lead_id</option>";
	echo "<option>campaign</option>";
	echo "<option>phone_login</option>";
	echo "<option>group</option>";
	echo "<option>channel_group</option>";
	echo "<option>SQLdate</option>";
	echo "<option>epoch</option>";
	echo "<option>uniqueid</option>";
	echo "<option>customer_zap_channel</option>";
	echo "<option>server_ip</option>";
	echo "<option>SIPexten</option>";
	echo "<option>session_id</option>";
	echo "</select>";
	echo "<input type=\"button\" name=\"insertField\" value=\"Insert\" onClick=\"scriptInsertField();\"><BR>";
	# END Insert Field
	echo "<TEXTAREA NAME=script_text ROWS=20 COLS=50 value=\"\"></TEXTAREA> $NWB#vicidial_scripts-script_text$NWE</td></tr>\n";
	echo "<tr bgcolor=#B6D3FC><td align=center colspan=2><input type=submit name=ΕΠΙΒΕΒΑΙΩΣΗ value=ΕΠΙΒΕΒΑΙΩΣΗ></td></tr>\n";
	echo "</TABLE></center>\n";
	}
	else
	{
	echo "Δεν έχετε την άδεια να δείτε αυτήν την σελίδα\n";
	exit;
	}
}


######################
# ADD=11111111 display the ADD NEW FILTER SCREEN
######################

if ($ADD==11111111)
{
	if ($LOGmodify_filters==1)
	{
	echo "<TABLE><TR><TD>\n";
	echo "<FONT FACE=\"ARIAL,HELVETICA\" COLOR=BLACK SIZE=2>";

	echo "<br>ΠΡΟΣΘΕΣΕ ΦΙΛΤΡΟ<form action=$PHP_SELF method=POST>\n";
	echo "<input type=hidden name=ADD value=21111111>\n";
	echo "<center><TABLE width=$section_width cellspacing=3>\n";
	echo "<tr bgcolor=#B6D3FC><td align=right>ID Φίλτρου: </td><td align=left><input type=text name=lead_filter_id size=12 maxlength=10> (όχι κενά ή στίξη)$NWB#vicidial_lead_filters-lead_filter_id$NWE</td></tr>\n";
	echo "<tr bgcolor=#B6D3FC><td align=right>Όνομα Φίλτρου:</td><td align=left><input type=text name=lead_filter_name size=30 maxlength=30> (σύντομη περιγραφή του φίλτρου)$NWB#vicidial_lead_filters-lead_filter_name$NWE</td></tr>\n";
	echo "<tr bgcolor=#B6D3FC><td align=right>Σχόλια Φίλτρου: </td><td align=left><input type=text name=lead_filter_comments size=50 maxlength=255> $NWB#vicidial_lead_filters-lead_filter_comments$NWE</td></tr>\n";
	echo "<tr bgcolor=#B6D3FC><td align=right>SQL Φίλτρου:  </td><td align=left><TEXTAREA NAME=lead_filter_sql ROWS=20 COLS=50 value=\"\"></TEXTAREA> $NWB#vicidial_lead_filters-lead_filter_sql$NWE</td></tr>\n";
	echo "<tr bgcolor=#B6D3FC><td align=center colspan=2><input type=submit name=ΕΠΙΒΕΒΑΙΩΣΗ value=ΕΠΙΒΕΒΑΙΩΣΗ></td></tr>\n";
	echo "</TABLE></center>\n";
	}
	else
	{
	echo "Δεν έχετε την άδεια να δείτε αυτήν την σελίδα\n";
	exit;
	}
}


######################
# ADD=111111111 display the ADD NEW CALL TIME SCREEN
######################

if ($ADD==111111111)
{
	if ($LOGmodify_call_times==1)
	{
	echo "<TABLE><TR><TD>\n";
	echo "<FONT FACE=\"ARIAL,HELVETICA\" COLOR=BLACK SIZE=2>";

	echo "<br>ΠΡΟΣΘΗΚΗ ΝΕΟΥ ΧΡΟΝΟΥ ΚΛΗΣΗΣ<form action=$PHP_SELF method=POST>\n";
	echo "<input type=hidden name=ADD value=211111111>\n";
	echo "<center><TABLE width=$section_width cellspacing=3>\n";
	echo "<tr bgcolor=#B6D3FC><td align=right>ID Χρόνου Κλήσης: </td><td align=left><input type=text name=call_time_id size=12 maxlength=10> (όχι κενά ή στίξη)$NWB#vicidial_call_times-call_time_id$NWE</td></tr>\n";
	echo "<tr bgcolor=#B6D3FC><td align=right>Ονομα Χρόνου Κλήσης: </td><td align=left><input type=text name=call_time_name size=30 maxlength=30> (σύντομη περιγραφή του χρόνου κλήσης)$NWB#vicidial_call_times-call_time_name$NWE</td></tr>\n";
	echo "<tr bgcolor=#B6D3FC><td align=right>Σχόλια Χρόνου Κλήσης: </td><td align=left><input type=text name=call_time_comments size=50 maxlength=255> $NWB#vicidial_call_times-call_time_comments$NWE</td></tr>\n";

	echo "<tr bgcolor=#B6D3FC><td align=center colspan=2>Οι επιλογές Ημέρας και ώρας θα εμφανιστούν όταν θα δημιουργήσετε τον Ορισμό Χρόνου Κλήσης</td></tr>\n";
	echo "<tr bgcolor=#B6D3FC><td align=center colspan=2><input type=submit name=ΕΠΙΒΕΒΑΙΩΣΗ value=ΕΠΙΒΕΒΑΙΩΣΗ></td></tr>\n";
	echo "</TABLE></center>\n";
	}
	else
	{
	echo "Δεν έχετε την άδεια να δείτε αυτήν την σελίδα\n";
	exit;
	}
}


######################
# ADD=1111111111 display the ADD NEW STATE CALL TIME SCREEN
######################

if ($ADD==1111111111)
{
	if ($LOGmodify_call_times==1)
	{
	echo "<TABLE><TR><TD>\n";
	echo "<FONT FACE=\"ARIAL,HELVETICA\" COLOR=BLACK SIZE=2>";

	echo "<br>ΠΡΟΣΘΗΚΗ ΝΕΟΥ ΧΡΟΝΟΥ ΚΛΗΣΗΣ ΚΑΤΑΣΤΑΣΗΣ<form action=$PHP_SELF method=POST>\n";
	echo "<input type=hidden name=ADD value=2111111111>\n";
	echo "<center><TABLE width=$section_width cellspacing=3>\n";
	echo "<tr bgcolor=#B6D3FC><td align=right>ID Χρόνου Κλήσης Κατάστασης: </td><td align=left><input type=text name=call_time_id size=12 maxlength=10> (όχι κενά ή στίξη)$NWB#vicidial_call_times-call_time_id$NWE</td></tr>\n";
	echo "<tr bgcolor=#B6D3FC><td align=right>State Call Time State: </td><td align=left><input type=text name=state_call_time_state size=4 maxlength=2> (όχι κενά ή στίξη)$NWB#vicidial_call_times-state_call_time_state$NWE</td></tr>\n";
	echo "<tr bgcolor=#B6D3FC><td align=right>Ονομα Χρόνου Κλήσης Κατάτασης: </td><td align=left><input type=text name=call_time_name size=30 maxlength=30> (σύντομη περιγραφή του χρόνου κλήσης)$NWB#vicidial_call_times-call_time_name$NWE</td></tr>\n";
	echo "<tr bgcolor=#B6D3FC><td align=right>Σχόλια Χρόνου Κλήσης Κατάστασης: </td><td align=left><input type=text name=call_time_comments size=50 maxlength=255> $NWB#vicidial_call_times-call_time_comments$NWE</td></tr>\n";

	echo "<tr bgcolor=#B6D3FC><td align=center colspan=2>Οι επιλογές Ημέρας και ώρας θα εμφανιστούν όταν θα δημιουργήσετε τον Ορισμό Χρόνου Κλήσης</td></tr>\n";
	echo "<tr bgcolor=#B6D3FC><td align=center colspan=2><input type=submit name=ΕΠΙΒΕΒΑΙΩΣΗ value=ΕΠΙΒΕΒΑΙΩΣΗ></td></tr>\n";
	echo "</TABLE></center>\n";
	}
	else
	{
	echo "Δεν έχετε την άδεια να δείτε αυτήν την σελίδα\n";
	exit;
	}
}


######################
# ADD=11111111111 display the ADD NEW PHONE SCREEN
######################

if ($ADD==11111111111)
{
	if ($LOGast_admin_access==1)
	{
	echo "<TABLE><TR><TD>\n";
	echo "<FONT FACE=\"ARIAL,HELVETICA\" COLOR=BLACK SIZE=2>";

	echo "<br>ΠΡΟΣΘΗΚΗ ΤΗΛΕΦΩΝΟΥ<form action=$PHP_SELF method=POST>\n";
	echo "<input type=hidden name=ADD value=21111111111>\n";
	echo "<center><TABLE width=$section_width cellspacing=3>\n";

	echo "<center><TABLE width=$section_width cellspacing=3>\n";
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
	echo "<tr bgcolor=#B6D3FC><td align=right>Κατάσταση:</td><td align=left><select size=1 name=status><option>ΕΝΕΡΓΟ</option><option>SUSPENDED</option><option>CLOSED</option><option>PENDING</option><option>ADMIN</option><option selected>$row[8]</option></select>$NWB#phones-status$NWE</td></tr>\n";
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
	else
	{
	echo "Δεν έχετε την άδεια να δείτε αυτήν την σελίδα\n";
	exit;
	}
}


######################
# ADD=111111111111 display the ADD NEW SERVER SCREEN
######################

if ($ADD==111111111111)
{
	if ($LOGmodify_servers==1)
	{
	echo "<TABLE><TR><TD>\n";
	echo "<FONT FACE=\"ARIAL,HELVETICA\" COLOR=BLACK SIZE=2>";

	echo "<br>ΠΡΟΣΘΗΚΗ ΔΙΑΚΟΜΙΣΤΗ<form action=$PHP_SELF method=POST>\n";
	echo "<input type=hidden name=ADD value=211111111111>\n";
	echo "<center><TABLE width=$section_width cellspacing=3>\n";
	echo "<tr bgcolor=#B6D3FC><td align=right>ID Διακομιστή: </td><td align=left><input type=text name=server_id size=10 maxlength=10>$NWB#servers-server_id$NWE</td></tr>\n";
	echo "<tr bgcolor=#B6D3FC><td align=right>Περιγραφή Διακομιστή: </td><td align=left><input type=text name=server_description size=30 maxlength=255>$NWB#servers-server_description$NWE</td></tr>\n";
	echo "<tr bgcolor=#B6D3FC><td align=right>Δνση IP Διακομιστή: </td><td align=left><input type=text name=server_ip size=20 maxlength=15>$NWB#servers-server_ip$NWE</td></tr>\n";
	echo "<tr bgcolor=#B6D3FC><td align=right>Ενεργή:</td><td align=left><select size=1 name=active><option>Y</option><option>N</option></select>$NWB#servers-active$NWE</td></tr>\n";
	echo "<tr bgcolor=#B6D3FC><td align=right>Εκδοση Asterisk: </td><td align=left><input type=text name=asterisk_version size=20 maxlength=20>$NWB#servers-asterisk_version$NWE</td></tr>\n";
	echo "<tr bgcolor=#B6D3FC><td align=center colspan=2><input type=submit name=submit VALUE=ΥΠΟΒΑΛΛΩ></td></tr>\n";
	echo "</TABLE></center>\n";
	}
	else
	{
	echo "Δεν έχετε την άδεια να δείτε αυτήν την σελίδα\n";
	exit;
	}
}


######################
# ADD=1111111111111 display the ADD NEW CONFERENCE SCREEN
######################

if ($ADD==1111111111111)
{
	if ($LOGast_admin_access==1)
	{
	echo "<TABLE><TR><TD>\n";
	echo "<FONT FACE=\"ARIAL,HELVETICA\" COLOR=BLACK SIZE=2>";

	echo "<br>ΠΡΟΣΘΗΚΗ ΣΥΝΔΙΑΛΕΞΗΣ<form action=$PHP_SELF method=POST>\n";
	echo "<input type=hidden name=ADD value=2111111111111>\n";
	echo "<center><TABLE width=$section_width cellspacing=3>\n";
	echo "<tr bgcolor=#B6D3FC><td align=right>Αριθμός Συνδιάλεξης: </td><td align=left><input type=text name=conf_exten size=8 maxlength=7> (μόνο αριθμοί)$NWB#conferences-conf_exten$NWE</td></tr>\n";
	echo "<tr bgcolor=#B6D3FC><td align=right>IP Διακομιστή: </td><td align=left><select size=1 name=server_ip>\n";

	echo "$servers_list";
	echo "<option SELECTED>$server_ip</option>\n";
	echo "</select>$NWB#conferences-server_ip$NWE</td></tr>\n";
	echo "<tr bgcolor=#B6D3FC><td align=center colspan=2><input type=submit name=submit VALUE=ΥΠΟΒΑΛΛΩ></td></tr>\n";
	echo "</TABLE></center>\n";
	}
	else
	{
	echo "Δεν έχετε την άδεια να δείτε αυτήν την σελίδα\n";
	exit;
	}
}


######################
# ADD=11111111111111 display the ADD NEW VICIDIAL CONFERENCE SCREEN
######################

if ($ADD==11111111111111)
{
	if ($LOGast_admin_access==1)
	{
	echo "<TABLE><TR><TD>\n";
	echo "<FONT FACE=\"ARIAL,HELVETICA\" COLOR=BLACK SIZE=2>";

	echo "<br>ADD A NEW VICIDIAL CONFERENCE<form action=$PHP_SELF method=POST>\n";
	echo "<input type=hidden name=ADD value=21111111111111>\n";
	echo "<center><TABLE width=$section_width cellspacing=3>\n";
	echo "<tr bgcolor=#B6D3FC><td align=right>Αριθμός Συνδιάλεξης: </td><td align=left><input type=text name=conf_exten size=8 maxlength=7> (μόνο αριθμοί)$NWB#conferences-conf_exten$NWE</td></tr>\n";
	echo "<tr bgcolor=#B6D3FC><td align=right>IP Διακομιστή: </td><td align=left><select size=1 name=server_ip>\n";

	echo "$servers_list";
	echo "<option SELECTED>$server_ip</option>\n";
	echo "</select>$NWB#conferences-server_ip$NWE</td></tr>\n";
	echo "<tr bgcolor=#B6D3FC><td align=center colspan=2><input type=submit name=submit VALUE=ΥΠΟΒΑΛΛΩ></td></tr>\n";
	echo "</TABLE></center>\n";
	}
	else
	{
	echo "Δεν έχετε την άδεια να δείτε αυτήν την σελίδα\n";
	exit;
	}
}



######################################################################################################
######################################################################################################
#######   2 series, validates form data and inserts the new record into the database
######################################################################################################
######################################################################################################


######################
# ADD=2 adds the new user to the system
######################

if ($ADD==2)
{
	echo "<FONT FACE=\"ARIAL,HELVETICA\" COLOR=BLACK SIZE=2>";
	$stmt="SELECT count(*) from vicidial_users where user='$user';";
	$rslt=mysql_query($stmt, $link);
	$row=mysql_fetch_row($rslt);
	if ($row[0] > 0)
		{echo "<br>Ο ΧΡΗΣΤΗΣ ΔΕΝ ΠΡΟΣΤΕΘΗΚΕ  - υπάρχει ήδη ένας χρήστης με αυτό τον αριθμό\n";}
	else
		{
		 if ( (strlen($user) < 2) or (strlen($pass) < 2) or (strlen($full_name) < 2) or (strlen($user) > 8) )
			{
			 echo "<br>Ο ΧΡΗΣΤΗΣ ΔΕΝ ΠΡΟΣΤΕΘΗΚΕ  - Παρακαλώ ελέγξτε τα δεδομένα που καταχωρήσατε\n";
			 echo "<br>το id χρήστη πρέπει να είναι μεταξύ 2 και 8 χαρακτήρες\n";
			 echo "<br>το πλήρες όνομα και κωδικός πρέπει να είναι τουλάχιστον 2 χαρακτήρες\n";
			}
		 else
			{
			echo "<br><B>ΧΡΗΣΤΗΣ ΠΡΟΣΤΕΘΗΚΕ: $user</B>\n";

			$stmt="INSERT INTO vicidial_users (user,pass,full_name,user_level,user_group,phone_login,phone_pass) values('$user','$pass','$full_name','$user_level','$user_group','$phone_login','$phone_pass');";
			$rslt=mysql_query($stmt, $link);

			### LOG CHANGES TO LOG FILE ###
			if ($WeBRooTWritablE > 0)
				{
				$fp = fopen ("./admin_changes_log.txt", "a");
				fwrite ($fp, "$date|ADD A USER          |$PHP_AUTH_USER|$ip|'$user','$pass','$full_name','$user_level','$user_group','$phone_login','$phone_pass'|\n");
				fclose($fp);
				}
			}
		}
$ADD=3;
}

######################
# ADD=21 adds the new campaign to the system
######################

if ($ADD==21)
{

	echo "<FONT FACE=\"ARIAL,HELVETICA\" COLOR=BLACK SIZE=2>";
	$stmt="SELECT count(*) from vicidial_campaigns where campaign_id='$campaign_id';";
	$rslt=mysql_query($stmt, $link);
	$row=mysql_fetch_row($rslt);
	if ($row[0] > 0)
		{echo "<br>Η ΕΚΣΤΡΑΤΕΙΑ ΔΕΝ ΠΡΟΣΤΕΘΗΚΕ - υπάρχει ήδη μία εκστρατεία με αυτό το ID\n";}
	else
		{
		 if ( (strlen($campaign_id) < 2) or (strlen($campaign_id) > 8) or (strlen($campaign_name) < 6)  or (strlen($campaign_name) > 40) )
			{
			 echo "<br>Η ΕΚΣΤΡΑΤΕΙΑ ΔΕΝ ΠΡΟΣΤΕΘΗΚΕ - Παρακαλώ ελέγξτε τα δεδομένα που καταχωρήσατε\n";
			 echo "<br>το ID της εκστρατείας πρέπει να είναι μεταξύ 2 και 8 χαρακτήρες\n";
			 echo "<br>το όνομα της εκστρατείας πρέπει να είναι μεταξύ 6 και 40 χαρακτήρες\n";
			}
		 else
			{
			echo "<br><B>ΕΚΣΤΡΑΤΕΙΑ ΠΡΟΣΤΕΘΗΚΕ: $campaign_id</B>\n";

			$stmt="INSERT INTO vicidial_campaigns (campaign_id,campaign_name,campaign_description,active,dial_status_a,lead_order,park_ext,park_file_name,web_form_address,allow_closers,hopper_level,auto_dial_level,next_agent_call,local_call_time,voicemail_ext,campaign_script,get_call_launch,campaign_changedate,campaign_stats_refresh) values('$campaign_id','$campaign_name','$campaign_description','$active','NEW','DOWN','$park_ext','$park_file_name','" . mysql_real_escape_string($web_form_address) . "','$allow_closers','$hopper_level','$auto_dial_level','$next_agent_call','$local_call_time','$voicemail_ext','$script_id','$get_call_launch','$SQLdate','Y');";
			$rslt=mysql_query($stmt, $link);

			$stmt="INSERT INTO vicidial_campaign_stats (campaign_id) values('$campaign_id');";
			$rslt=mysql_query($stmt, $link);

			echo "<!-- $stmt -->";
			### LOG CHANGES TO LOG FILE ###
			if ($WeBRooTWritablE > 0)
				{
				$fp = fopen ("./admin_changes_log.txt", "a");
				fwrite ($fp, "$date|ΠΡΟΣΘΗΚΗ ΝΕΑΣ ΕΚΣΤΡΑΤΕΙΑΣ  |$PHP_AUTH_USER|$ip|$stmt|\n");
				fclose($fp);
				}

			}
		}
$ADD=31;
}

######################
# ADD=22 adds the new campaign status to the system
######################

if ($ADD==22)
{

	echo "<FONT FACE=\"ARIAL,HELVETICA\" COLOR=BLACK SIZE=2>";
	$stmt="SELECT count(*) from vicidial_campaign_statuses where campaign_id='$campaign_id' and status='$status';";
	$rslt=mysql_query($stmt, $link);
	$row=mysql_fetch_row($rslt);
	if ($row[0] > 0)
		{echo "<br>Η ΚΑΤΑΣΤΑΣΗ ΤΗΣ ΕΚΣΤΡΑΤΕΙΑΣ ΔΕΝ ΠΡΟΣΤΕΘΗΚΕ - υπάρχει ήδη κατάσταση-εκστρατείας με αυτό το όνομα\n";}
	else
		{
		$stmt="SELECT count(*) from vicidial_statuses where status='$status';";
		$rslt=mysql_query($stmt, $link);
		$row=mysql_fetch_row($rslt);
		if ($row[0] > 0)
			{echo "<br>Η ΚΑΤΑΣΤΑΣΗ ΤΗΣ ΕΚΣΤΡΑΤΕΙΑΣ ΔΕΝ ΠΡΟΣΤΕΘΗΚΕ - υπάρχει ήδη μία καθολική-κατάσταση με αυτό το όνομα\n";}
		else
			{
			 if ( (strlen($campaign_id) < 2) or (strlen($status) < 1) or (strlen($status_name) < 2) )
				{
				 echo "<br>Η ΚΑΤΑΣΤΑΣΗ ΤΗΣ ΕΚΣΤΡΑΤΕΙΑΣ ΔΕΝ ΠΡΟΣΤΕΘΗΚΕ - Παρακαλώ ελέγξτε τα δεδομένα που καταχωρήσατε\n";
				 echo "<br>η κατάσταση πρέπει να είναι μεταξύ 1 και 8 χαρακτήρρες\n";
				 echo "<br>το όνομα της κατάστασης πρέπει να είναι μεταξύ 2 και 30 χαρακτήρρες\n";
				}
			 else
				{
				echo "<br><B>ΚΑΤΑΣΤΑΣΗ ΕΚΣΤΡΑΤΕΙΑΣ ΠΡΟΣΤΕΘΗΚΕ: $campaign_id - $status</B>\n";

				$stmt="INSERT INTO vicidial_campaign_statuses values('$status','$status_name','$selectable','$campaign_id');";
				$rslt=mysql_query($stmt, $link);

				### LOG CHANGES TO LOG FILE ###
				if ($WeBRooTWritablE > 0)
					{
					$fp = fopen ("./admin_changes_log.txt", "a");
					fwrite ($fp, "$date|ΠΡΟΣΘΗΚΗ ΝΕΑΣ ΕΚΣΤΡΑΤΕΙΑΣ STATUS |$PHP_AUTH_USER|$ip|'$status','$status_name','$selectable','$campaign_id'|\n");
					fclose($fp);
					}
				}
			}
		}
$ADD=31;
}


######################
# ADD=23 adds the new campaign hotkey to the system
######################

if ($ADD==23)
{
	$HKstatus_data = explode('-----',$HKstatus);
	$status = $HKstatus_data[0];
	$status_name = $HKstatus_data[1];

	echo "<FONT FACE=\"ARIAL,HELVETICA\" COLOR=BLACK SIZE=2>";
	$stmt="SELECT count(*) from vicidial_campaign_hotkeys where campaign_id='$campaign_id' and hotkey='$hotkey' and hotkey='$hotkey';";
	$rslt=mysql_query($stmt, $link);
	$row=mysql_fetch_row($rslt);
	if ($row[0] > 0)
		{echo "<br>CAMPAIGN HOT KEY NOT ADDED - there is already a campaign-hotkey in the system with this hotkey\n";}
	else
		{
		 if ( (strlen($campaign_id) < 2) or (strlen($status) < 1) or (strlen($hotkey) < 1) )
			{
			 echo "<br>ΤΟ ΚΛΕΙΔΙ ΤΗΣ ΕΚΣΤΡΑΤΕΙΑΣ ΔΕΝ ΠΡΟΣΤΕΘΗΚΕ - Παρακαλώ ελέγξτε τα δεδομένα που καταχωρήσατε\n";
			 echo "<br>hotkey must be a single character between 1 and 9 \n";
			 echo "<br>η κατάσταση πρέπει να είναι μεταξύ 1 και 8 χαρακτήρρες\n";
			}
		 else
			{
			echo "<br><B>ΚΛΕΙΔΙ ΕΚΣΤΡΑΤΕΙΑΣ ΠΡΟΣΤΕΘΗΚΕ: $campaign_id - $status - $hotkey</B>\n";

			$stmt="INSERT INTO vicidial_campaign_hotkeys values('$status','$hotkey','$status_name','$selectable','$campaign_id');";
			$rslt=mysql_query($stmt, $link);

			### LOG CHANGES TO LOG FILE ###
			if ($WeBRooTWritablE > 0)
				{
				$fp = fopen ("./admin_changes_log.txt", "a");
				fwrite ($fp, "$date|ΠΡΟΣΘΗΚΗ ΝΕΑΣ ΕΚΣΤΡΑΤΕΙΑΣ HOT KEY |$PHP_AUTH_USER|$ip|'$status','$hotkey','$status_name','$selectable','$campaign_id'|\n");
				fclose($fp);
				}
			}
		}
$ADD=31;
}


######################
# ADD=25 adds the new campaign lead recycle entry to the system
######################

if ($ADD==25)
{
	$status = eregi_replace("-----.*",'',$status);
	echo "<FONT FACE=\"ARIAL,HELVETICA\" COLOR=BLACK SIZE=2>";
	$stmt="SELECT count(*) from vicidial_lead_recycle where campaign_id='$campaign_id' and status='$status';";
	$rslt=mysql_query($stmt, $link);
	$row=mysql_fetch_row($rslt);
	if ($row[0] > 0)
		{echo "<br>ΑΝΑΚΥΚΛΩΣΗΣ ΜΟΛΥΒΔΟΥ ΕΚΣΤΡΑΤΕΙΑΣ ΠΡΟΣΤΙΘΕΜΕΝΟΣ - υπάρχει ήδη έναςμόλυβδος-ανακύκλωσης για αυτήν την εκστρατεία με αυτήν την θέση\n";}
	else
		{
		 if ( (strlen($campaign_id) < 2) or (strlen($status) < 1) or ($attempt_delay < 120) or ($attempt_maximum < 1) or ($attempt_maximum > 10) )
			{
			 echo "<br>ΑΝΑΚΥΚΛΩΣΗΣ ΜΟΛΥΒΔΟΥ ΕΚΣΤΡΑΤΕΙΑΣ ΠΡΟΣΤΙΘΕΜΕΝΟΣ - παρακαλώ επιστρέψτεκαι εξετάστε τα στοιχεία που εισαγάγατε\n";
			 echo "<br>η κατάσταση πρέπει να είναι μεταξύ 1 και 6 χαρακτήρων στο μήκος\n";
			 echo "<br>η καθυστέρηση προσπάθειας πρέπει να είναι τουλάχιστον 120δευτερόλεπτα\n";
			 echo "<br>οι μέγιστες προσπάθειες πρέπει να είναι από 1 έως 10\n";
			}
		 else
			{
			echo "<br><B>ΠΡΟΣΤΙΘΕΜΕΝΟΣ ΟΔΗΓΟΣ ΑΝΑΚΥΚΛΩΣΗΣ ΕΚΣΤΡΑΤΕΙΑΣ: $campaign_id - $status - $attempt_delay</B>\n";

			$stmt="INSERT INTO vicidial_lead_recycle(campaign_id,status,attempt_delay,attempt_maximum,active) values('$campaign_id','$status','$attempt_delay','$attempt_maximum','$active');";
			$rslt=mysql_query($stmt, $link);

			### LOG CHANGES TO LOG FILE ###
			if ($WeBRooTWritablE > 0)
				{
				$fp = fopen ("./admin_changes_log.txt", "a");
				fwrite ($fp, "$date|ADD A NEW LEAD RECYCLE    |$PHP_AUTH_USER|$ip|$stmt|\n");
				fclose($fp);
				}
			}
		}
$ADD=31;
}


######################
# ADD=26 adds the new auto alt dial status to the campaign
######################

if ($ADD==26)
{
	$status = eregi_replace("-----.*",'',$status);
	echo "<FONT FACE=\"ARIAL,HELVETICA\" COLOR=BLACK SIZE=2>";
	$stmt="SELECT count(*) from vicidial_campaigns where campaign_id='$campaign_id' and auto_alt_dial_statuses LIKE \"% $status %\";";
	$rslt=mysql_query($stmt, $link);
	$row=mysql_fetch_row($rslt);
	if ($row[0] > 0)
		{echo "<br>ΑΥΤΟΜΑΤΗ ΘΈΣΗ ΠΙΝΑΚΩΝ ALT ΠΡΟΣΤΙΘΈΜΕΝΗ - υπάρχει ήδη μια είσοδος για αυτήν την εκστρατεία με αυτήν τηνθέση\n";}
	else
		{
		 if ( (strlen($campaign_id) < 2) or (strlen($status) < 1) )
			{
			 echo "<br>ΑΥΤΟΜΑΤΗ ΘΈΣΗ ΠΙΝΑΚΩΝ ALT ΠΡΟΣΤΙΘΈΜΕΝΗ - Παρακαλώ επιστρέψτε πίσω και κάνετε έλεγχο των δεδομένων που καταχωρήσατε\n";
			 echo "<br>η κατάσταση πρέπει να είναι μεταξύ 1 και 6 χαρακτήρων στο μήκος\n";
			}
		 else
			{
			echo "<br><B>ΑΥΤΟΜΑΤΗ ΘΈΣΗ ΠΙΝΑΚΩΝ ALT ΠΡΟΣΤΙΘΈΜΕΝΗ: $campaign_id - $status</B>\n";

			$stmt="SELECT auto_alt_dial_statuses from vicidial_campaigns where campaign_id='$campaign_id';";
			$rslt=mysql_query($stmt, $link);
			$row=mysql_fetch_row($rslt);

			if (strlen($row[0])<2) {$row[0] = ' -';}
			$auto_alt_dial_statuses = " $status$row[0]";
			$stmt="UPDATE vicidial_campaigns set auto_alt_dial_statuses='$auto_alt_dial_statuses' where campaign_id='$campaign_id';";
			$rslt=mysql_query($stmt, $link);

			### LOG CHANGES TO LOG FILE ###
			if ($WeBRooTWritablE > 0)
				{
				$fp = fopen ("./admin_changes_log.txt", "a");
				fwrite ($fp, "$date|ADD A AUTO-ALT-DIAL STATUS|$PHP_AUTH_USER|$ip|$stmt|\n");
				fclose($fp);
				}
			}
		}
$ADD=31;
}


######################
# ADD=27 adds the new campaign agent pause code entry to the system
######################

if ($ADD==27)
{
	echo "<FONT FACE=\"ARIAL,HELVETICA\" COLOR=BLACK SIZE=2>";
	$stmt="SELECT count(*) from vicidial_pause_codes where campaign_id='$campaign_id' and pause_code='$pause_code';";
	$rslt=mysql_query($stmt, $link);
	$row=mysql_fetch_row($rslt);
	if ($row[0] > 0)
		{echo "<br>ΚΩΔΙΚΑΣ ΜΙΚΡΗΣ ΔΙΑΚΟΠΉΣ ΠΡΑΚΤΟΡΩΝ ΠΡΟΣΤΙΘΕΜΕΝΟΣ - υπάρχει ήδη μια είσοδος για αυτήν την εκστρατεία με αυτόν τονκώδικα μικρής διακοπής\n";}
	else
		{
		 if ( (strlen($campaign_id) < 2) or (strlen($pause_code) < 1) or (strlen($pause_code) > 6) or (strlen($pause_code_name) < 2) )
			{
			 echo "<br>ΚΩΔΙΚΑΣ ΜΙΚΡΗΣ ΔΙΑΚΟΠΉΣ ΠΡΑΚΤΟΡΩΝ ΠΡΟΣΤΙΘΕΜΕΝΟΣ - Παρακαλώ επιστρέψτε πίσω και κάνετε έλεγχο των δεδομένων που καταχωρήσατε\n";
			 echo "<br>pause code must be between 1 and 6 characters in length\n";
			 echo "<br>pause code name must be between 2 and 30 characters in length\n";
			}
		 else
			{
			echo "<br><B>ΚΩΔΙΚΑΣ ΜΙΚΡΗΣ ΔΙΑΚΟΠΉΣ ΠΡΑΚΤΟΡΩΝ ΠΡΟΣΤΙΘΕΜΕΝΟΣ: $campaign_id - $pause_code - $pause_code_name</B>\n";

			$stmt="INSERT INTO vicidial_pause_codes(campaign_id,pause_code,pause_code_name,billable) values('$campaign_id','$pause_code','$pause_code_name','$billable');";
			$rslt=mysql_query($stmt, $link);

			### LOG CHANGES TO LOG FILE ###
			if ($WeBRooTWritablE > 0)
				{
				$fp = fopen ("./admin_changes_log.txt", "a");
				fwrite ($fp, "$date|ADD A NEW ΧΕΙΡΙΣΤΗΣPAUSE CODE|$PHP_AUTH_USER|$ip|$stmt|\n");
				fclose($fp);
				}
			}
		}
$ADD=31;
}


######################
# ADD=28 adds new status to the campaign dial statuses
######################

if ($ADD==28)
{
	$status = eregi_replace("-----.*",'',$status);
	echo "<FONT FACE=\"ARIAL,HELVETICA\" COLOR=BLACK SIZE=2>";
	$stmt="SELECT count(*) from vicidial_campaigns where campaign_id='$campaign_id' and dial_statuses LIKE \"% $status %\";";
	$rslt=mysql_query($stmt, $link);
	$row=mysql_fetch_row($rslt);
	if ($row[0] > 0)
		{echo "<br>ΘΕΣΗ ΠΙΝΑΚΩΝ ΕΚΣΤΡΑΤΕΙΑΣ ΠΡΟΣΤΙΘΕΜΕΝΗ - υπάρχει ήδη μια είσοδος για αυτήν την εκστρατεία με αυτήν τηνθέση\n";}
	else
		{
		 if ( (strlen($campaign_id) < 2) or (strlen($status) < 1) )
			{
			 echo "<br>ΘΕΣΗ ΠΙΝΑΚΩΝ ΕΚΣΤΡΑΤΕΙΑΣ ΠΡΟΣΤΙΘΕΜΕΝΗ - Παρακαλώ επιστρέψτε πίσω και κάνετε έλεγχο των δεδομένων που καταχωρήσατε\n";
			 echo "<br>η κατάσταση πρέπει να είναι μεταξύ 1 και 6 χαρακτήρων στο μήκος\n";
			}
		 else
			{
			echo "<br><B>ΘΕΣΗ ΠΙΝΑΚΩΝ ΕΚΣΤΡΑΤΕΙΑΣ ΠΡΟΣΤΙΘΕΜΕΝΗ: $campaign_id - $status</B>\n";

			$stmt="SELECT dial_statuses from vicidial_campaigns where campaign_id='$campaign_id';";
			$rslt=mysql_query($stmt, $link);
			$row=mysql_fetch_row($rslt);

			if (strlen($row[0])<2) {$row[0] = ' -';}
			$dial_statuses = " $status$row[0]";
			$stmt="UPDATE vicidial_campaigns set dial_statuses='$dial_statuses' where campaign_id='$campaign_id';";
			$rslt=mysql_query($stmt, $link);

			### LOG CHANGES TO LOG FILE ###
			if ($WeBRooTWritablE > 0)
				{
				$fp = fopen ("./admin_changes_log.txt", "a");
				fwrite ($fp, "$date|ΠΡΟΣΘΗΚΗ ΕΚΣΤΡΑΤΕΙΑΣ DIAL STATUS  |$PHP_AUTH_USER|$ip|$stmt|\n");
				fclose($fp);
				}
			}
		}
$ADD=31;
}


######################
# ADD=211 adds the new list to the system
######################

if ($ADD==211)
{
	echo "<FONT FACE=\"ARIAL,HELVETICA\" COLOR=BLACK SIZE=2>";
	$stmt="SELECT count(*) from vicidial_lists where list_id='$list_id';";
	$rslt=mysql_query($stmt, $link);
	$row=mysql_fetch_row($rslt);
	if ($row[0] > 0)
		{echo "<br>Η ΛΙΣΤΑ ΔΕΝ ΠΡΟΣΤΕΘΗΚΕ - υπάρχει ήδη μία λίστα με αυτό το ID\n";}
	else
		{
		 if ( (strlen($campaign_id) < 2) or (strlen($list_name) < 2)  or ($list_id < 100) or (strlen($list_id) > 8) )
			{
			 echo "<br>Η ΛΙΣΤΑ ΔΕΝ ΠΡΟΣΤΕΘΗΚΕ - Παρακαλώ ελέγξτε τα δεδομένα που καταχωρήσατε\n";
			 echo "<br>Το ID λίστας πρέπει να είναι μεταξύ 2 και 8 χαρακτήρες\n";
			 echo "<br>Το όνομα λίστας πρέπει να είναι 2 χαρακτήρες\n";
			 echo "<br>ID Λίστας must be greater than 100\n";
			 }
		 else
			{
			echo "<br><B>ΛΙΣΤΑ ΠΡΟΣΤΕΘΗΚΕ: $list_id</B>\n";

			$stmt="INSERT INTO vicidial_lists (list_id,list_name,campaign_id,active,list_description,list_changedate) values('$list_id','$list_name','$campaign_id','$active','$list_description','$SQLdate');";
			$rslt=mysql_query($stmt, $link);

			### LOG CHANGES TO LOG FILE ###
			if ($WeBRooTWritablE > 0)
				{
				$fp = fopen ("./admin_changes_log.txt", "a");
				fwrite ($fp, "$date|ADD A NEW LIST      |$PHP_AUTH_USER|$ip|$stmt|\n");
				fclose($fp);
				}
			}
		}
$ADD=311;
}



######################
# ADD=2111 adds the new inbound group to the system
######################

if ($ADD==2111)
{
	echo "<FONT FACE=\"ARIAL,HELVETICA\" COLOR=BLACK SIZE=2>";
	$stmt="SELECT count(*) from vicidial_inbound_groups where group_id='$group_id';";
	$rslt=mysql_query($stmt, $link);
	$row=mysql_fetch_row($rslt);
	if ($row[0] > 0)
		{echo "<br>Η ΟΜΑΔΑ ΔΕΝ ΠΡΟΣΤΕΘΗΚΕ - υπάρχει ήδη μία ομάδα με αυτό το ID\n";}
	else
		{
		 if ( (strlen($group_id) < 2) or (strlen($group_name) < 2)  or (strlen($group_color) < 2) or (strlen($group_id) > 20) or (eregi(' ',$group_id)) or (eregi("\-",$group_id)) or (eregi("\+",$group_id)) )
			{
			 echo "<br>Η ΟΜΑΔΑ ΔΕΝ ΠΡΟΣΤΕΘΗΚΕ - Παρακαλώ ελέγξτε τα δεδομένα που καταχωρήσατε\n";
			 echo "<br>Το ID ομάδας πρέπει να είναι μεταξύ 2 και 20 χαρακτήρες ' -+'.\n";
			 echo "<br>Το όνομα και χρώμα ομάδας πρέπει να είναι τουλάχιστον 2 χαρακτήρες\n";
			}
		 else
			{
			$stmt="INSERT INTO vicidial_inbound_groups (group_id,group_name,group_color,active,web_form_address,voicemail_ext,next_agent_call,fronter_display,ingroup_script,get_call_launch) values('$group_id','$group_name','$group_color','$active','" . mysql_real_escape_string($web_form_address) . "','$voicemail_ext','$next_agent_call','$fronter_display','$script_id','$get_call_launch');";
			$rslt=mysql_query($stmt, $link);

			echo "<br><B>ΟΜΑΔΑ ΠΡΟΣΤΕΘΗΚΕ: $group_id</B>\n";

			### LOG CHANGES TO LOG FILE ###
			if ($WeBRooTWritablE > 0)
				{
				$fp = fopen ("./admin_changes_log.txt", "a");
				fwrite ($fp, "$date|ADD A NEW GROUP     |$PHP_AUTH_USER|$ip|$stmt|\n");
				fclose($fp);
				}
			}
		}
$ADD=1000;
}


######################
# ADD=21111 adds new remote agents to the system
######################

if ($ADD==21111)
{
	echo "<FONT FACE=\"ARIAL,HELVETICA\" COLOR=BLACK SIZE=2>";
	$stmt="SELECT count(*) from vicidial_remote_agents where server_ip='$server_ip' and user_start='$user_start';";
	$rslt=mysql_query($stmt, $link);
	$row=mysql_fetch_row($rslt);
	if ($row[0] > 0)
		{echo "<br>ΟΙ ΑΠΟΜΑΚΡΥΣΜΕΝΟΙ ΧΕΙΡΙΣΤΕΣ ΔΕΝ ΠΡΟΣΤΕΘΗΚΑΝ - υπάρχει ήδη καταχώρηση απομακρυσμένων χειριστών που ξεκινάει με αυτό το ID χρήστη\n";}
	else
		{
		 if ( (strlen($server_ip) < 2) or (strlen($user_start) < 2)  or (strlen($campaign_id) < 2) or (strlen($conf_exten) < 2) )
			{
			 echo "<br>ΟΙ ΑΠΟΜΑΚΡΥΣΜΕΝΟΙ ΧΕΙΡΙΣΤΕΣ ΔΕΝ ΠΡΟΣΤΕΘΗΚΑΝ - Παρακαλώ ελέγξτε τα δεδομένα που καταχωρήσατε\n";
			 echo "<br>Το ID χρήστη και η εξωτερική εσωτ.σύνδεση πρέπει να είναι τουλάχιστον 2 χαρακτήρες\n";
			 }
		 else
			{
			$stmt="INSERT INTO vicidial_remote_agents values('','$user_start','$number_of_lines','$server_ip','$conf_exten','$status','$campaign_id','$groups_value');";
			$rslt=mysql_query($stmt, $link);

			echo "<br><B>ΑΠΟΜΑΚΡΥΣΜΕΝΟΙ ΧΕΙΡΙΣΤΕΣ ΠΡΟΣΤΕΘΗΚΑΝ: $user_start</B>\n";

			### LOG CHANGES TO LOG FILE ###
			if ($WeBRooTWritablE > 0)
				{
				$fp = fopen ("./admin_changes_log.txt", "a");
				fwrite ($fp, "$date|ADD A NEW ΑΠΟΜΑΚΡΥΣΜΕΝΟΙ ΧΕΙΡΙΣΤΕΣ ENTRY     |$PHP_AUTH_USER|$ip|'$user_start','$number_of_lines','$server_ip','$conf_exten','$status','$campaign_id','$groups_value'|\n");
				fclose($fp);
				}
			}
		}
$ADD=10000;
}

######################
# ADD=211111 adds new user group to the system
######################

if ($ADD==211111)
{
	echo "<FONT FACE=\"ARIAL,HELVETICA\" COLOR=BLACK SIZE=2>";
	$stmt="SELECT count(*) from vicidial_user_groups where user_group='$user_group';";
	$rslt=mysql_query($stmt, $link);
	$row=mysql_fetch_row($rslt);
	if ($row[0] > 0)
		{echo "<br>ΔΕΝ ΠΡΟΣΤΕΘΗΚΕ Η ΟΜΑΔΑ ΧΡΗΣΤΗ - υπάρχει ήδη μία καταχώρηση ομάδας χρήστη με αυτό το όνομα\n";}
	else
		{
		 if ( (strlen($user_group) < 2) or (strlen($group_name) < 2) )
			{
			 echo "<br>ΔΕΝ ΠΡΟΣΤΕΘΗΚΕ Η ΟΜΑΔΑ ΧΡΗΣΤΗ - Παρακαλώ ελέγξτε τα δεδομένα που καταχωρήσατε\n";
			 echo "<br>Η ομάδα και η περιγραφή πρέπει να είναι τουλάχιστον 2 χαρακτήρες\n";
			 }
		 else
			{
			$stmt="INSERT INTO vicidial_user_groups(user_group,group_name,allowed_campaigns) values('$user_group','$group_name','-ALL-CAMPAIGNS-');";
			$rslt=mysql_query($stmt, $link);

			echo "<br><B>ΟΜΑΔΑ ΧΡΗΣΤΗ ΠΡΟΣΤΕΘΗΚΕ: $user_group</B>\n";

			### LOG CHANGES TO LOG FILE ###
			if ($WeBRooTWritablE > 0)
				{
				$fp = fopen ("./admin_changes_log.txt", "a");
				fwrite ($fp, "$date|ΠΡΟΣΘΗΚΗ ΝΕΟΥ ΧΡΗΣΤΗ GROUP ENTRY     |$PHP_AUTH_USER|$ip|$stmt|\n");
				fclose($fp);
				}
			}
		}
$ADD=100000;
}

######################
# ADD=2111111 adds new script to the system
######################

if ($ADD==2111111)
{
	echo "<FONT FACE=\"ARIAL,HELVETICA\" COLOR=BLACK SIZE=2>";
	$stmt="SELECT count(*) from vicidial_scripts where script_id='$script_id';";
	$rslt=mysql_query($stmt, $link);
	$row=mysql_fetch_row($rslt);
	if ($row[0] > 0)
		{echo "<br>Ο ΒΟΗΘΟΣ ΔΕΝ ΠΡΟΣΤΕΘΗΚΕ - υπάρχει ήδη μια είσοδος χειρογράφων με αυτό το όνομα\n";}
	else
		{
		 if ( (strlen($script_id) < 2) or (strlen($script_name) < 2) or (strlen($script_text) < 2) )
			{
			 echo "<br>Ο ΒΟΗΘΟΣ ΔΕΝ ΠΡΟΣΤΕΘΗΚΕ - Παρακαλώ επιστρέψτε πίσω και κάνετε έλεγχο των δεδομένων που καταχωρήσατε\n";
			 echo "<br>Το όνομα, η περιγραφή και το κείμενο χειρογράφων πρέπει να είναι τουλάχιστον 2 χαρακτήρες στο μήκος\n";
			 }
		 else
			{
			$stmt="INSERT INTO vicidial_scripts values('$script_id','$script_name','$script_comments','$script_text','$active');";
			$rslt=mysql_query($stmt, $link);

			echo "<br><B>Ο ΒΟΗΘΟΣ ΠΡΟΣΤΕΘΗΚΕ: $script_id</B>\n";

			### LOG CHANGES TO LOG FILE ###
			if ($WeBRooTWritablE > 0)
				{
				$fp = fopen ("./admin_changes_log.txt", "a");
				fwrite ($fp, "$date|ADD A NEW SCRIPT ENTRY         |$PHP_AUTH_USER|$ip|$stmt|\n");
				fclose($fp);
				}
			}
		}
$ADD=1000000;
}


######################
# ADD=21111111 adds new filter to the system
######################

if ($ADD==21111111)
{
	echo "<FONT FACE=\"ARIAL,HELVETICA\" COLOR=BLACK SIZE=2>";
	$stmt="SELECT count(*) from vicidial_lead_filters where lead_filter_id='$lead_filter_id';";
	$rslt=mysql_query($stmt, $link);
	$row=mysql_fetch_row($rslt);
	if ($row[0] > 0)
		{echo "<br>ΤΟ ΦΙΛΤΡΟ ΔΕΝ ΠΡΟΣΤΕΘΗΚΕ - υπάρχει ήδη ένα φίλτρο με αυτό το ID\n";}
	else
		{
		 if ( (strlen($lead_filter_id) < 2) or (strlen($lead_filter_name) < 2) or (strlen($lead_filter_sql) < 2) )
			{
			 echo "<br>ΤΟ ΦΙΛΤΡΟ ΔΕΝ ΠΡΟΣΤΕΘΗΚΕ - Παρακαλώ επιστρέψτε πίσω και κάνετε έλεγχο των δεδομένων που καταχωρήσατε\n";
			 echo "<br>ID φίλτρου, όνομα και SQL πρέπει να είναι τουλάχιστον 2 χαρακτήρες\n";
			 }
		 else
			{
			$stmt="INSERT INTO vicidial_lead_filters SET lead_filter_id='$lead_filter_id',lead_filter_name='$lead_filter_name',lead_filter_comments='$lead_filter_comments',lead_filter_sql='$lead_filter_sql';";
			$rslt=mysql_query($stmt, $link);

			echo "<br><B>ΤΟ ΦΙΛΤΡΟ ΠΡΟΣΤΕΘΗΚΕ: $lead_filter_id</B>\n";

			### LOG CHANGES TO LOG FILE ###
			if ($WeBRooTWritablE > 0)
				{
				$fp = fopen ("./admin_changes_log.txt", "a");
				fwrite ($fp, "$date|ADD A NEW FILTER ENTRY         |$PHP_AUTH_USER|$ip|$stmt|\n");
				fclose($fp);
				}
			}
		}
$ADD=10000000;
}


######################
# ADD=211111111 adds new call time definition to the system
######################

if ($ADD==211111111)
{
	echo "<FONT FACE=\"ARIAL,HELVETICA\" COLOR=BLACK SIZE=2>";
	$stmt="SELECT count(*) from vicidial_call_times where call_time_id='$call_time_id';";
	$rslt=mysql_query($stmt, $link);
	$row=mysql_fetch_row($rslt);
	if ($row[0] > 0)
		{echo "<br>Ο ΟΡΙΣΜΟΣ ΧΡΟΝΟΥ ΚΛΗΣΗ ΔΕΝ ΔΙΑΓΡΑΦΗΚΕ - υπάρχει ήδη μία εγγραφή χρόνου κλήσης με αυτό το ID\n";}
	else
		{
		 if ( (strlen($call_time_id) < 2) or (strlen($call_time_name) < 2) )
			{
			 echo "<br>Ο ΟΡΙΣΜΟΣ ΧΡΟΝΟΥ ΚΛΗΣΗ ΔΕΝ ΔΙΑΓΡΑΦΗΚΕ - Παρακαλώ επιστρέψτε πίσω και κάνετε έλεγχο των δεδομένων που καταχωρήσατε\n";
			 echo "<br>Το ID Χρόνου Κλήσης και το όνομα πρέπει να είναι τουλάχιστον 2 χαρακτήρες\n";
			 }
		 else
			{
			$stmt="INSERT INTO vicidial_call_times SET call_time_id='$call_time_id',call_time_name='$call_time_name',call_time_comments='$call_time_comments';";
			$rslt=mysql_query($stmt, $link);

			echo "<br><B>ΠΡΟΣΘΗΚΗ ΧΡΟΝΟΥ ΚΛΗΣΗΣ: $call_time_id</B>\n";

			### LOG CHANGES TO LOG FILE ###
			if ($WeBRooTWritablE > 0)
				{
				$fp = fopen ("./admin_changes_log.txt", "a");
				fwrite ($fp, "$date|ADD A NEW CALL TIME ENTRY      |$stmt|\n");
				fclose($fp);
				}
			}
		}
$ADD=311111111;
}


######################
# ADD=2111111111 adds new state call time definition to the system
######################

if ($ADD==2111111111)
{
	echo "<FONT FACE=\"ARIAL,HELVETICA\" COLOR=BLACK SIZE=2>";
	$stmt="SELECT count(*) from vicidial_state_call_times where state_call_time_id='$call_time_id';";
	$rslt=mysql_query($stmt, $link);
	$row=mysql_fetch_row($rslt);
	if ($row[0] > 0)
		{echo "<br>Ο ΟΡΙΣΜΟΣ ΧΡΟΝΟΥ ΚΛΗΣΗΣ ΚΑΤΑΣΤΑΣΗΣ ΔΕΝ ΠΡΟΣΤΕΘΗΚΕ - υπάρχει ήδη μία εγγραφή χρόνου κλήσης με αυτό το ID\n";}
	else
		{
		 if ( (strlen($call_time_id) < 2) or (strlen($call_time_name) < 2) or (strlen($state_call_time_state) < 2) )
			{
			 echo "<br>Ο ΟΡΙΣΜΟΣ ΧΡΟΝΟΥ ΚΛΗΣΗΣ ΚΑΤΑΣΤΑΣΗΣ ΔΕΝ ΠΡΟΣΤΕΘΗΚΕ - Παρακαλώ επιστρέψτε πίσω και κάνετε έλεγχο των δεδομένων που καταχωρήσατε\n";
			 echo "<br>Το ID Χρόνου Κλήσης Κατάστασης, το όνομα και η κατάσταση πρέπει να είναι τουλάχιστον 2 χαρακτήρες \n";
			 }
		 else
			{
			$stmt="INSERT INTO vicidial_state_call_times SET state_call_time_id='$call_time_id',state_call_time_name='$call_time_name',state_call_time_comments='$call_time_comments',state_call_time_state='$state_call_time_state';";
			$rslt=mysql_query($stmt, $link);

			echo "<br><B>ΠΡΟΣΘΗΚΗ ΧΡΟΝΟΥ ΚΛΗΣΗΣ ΚΑΤΑΣΤΑΣΗΣ: $call_time_id</B>\n";

			### LOG CHANGES TO LOG FILE ###
			if ($WeBRooTWritablE > 0)
				{
				$fp = fopen ("./admin_changes_log.txt", "a");
				fwrite ($fp, "$date|ADD A NEW STATE CALL TIME ENTRY|$stmt|\n");
				fclose($fp);
				}
			}
		}
$ADD=3111111111;
}


######################
# ADD=21111111111 adds new phone to the system
######################

if ($ADD==21111111111)
{
echo "<TABLE><TR><TD>\n";
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
$ADD=31111111111;
}


######################
# ADD=211111111111 adds new server to the system
######################

if ($ADD==211111111111)
{
echo "<TABLE><TR><TD>\n";
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
$ADD=311111111111;
}


######################
# ADD=221111111111 adds the new vicidial server trunk record to the system
######################

if ($ADD==221111111111)
{
	echo "<FONT FACE=\"ARIAL,HELVETICA\" COLOR=BLACK SIZE=2>";
	$stmt="SELECT max_vicidial_trunks from servers where server_ip='$server_ip';";
	$rslt=mysql_query($stmt, $link);
	$rowx=mysql_fetch_row($rslt);
	$MAXvicidial_trunks = $rowx[0];
	
	$stmt="SELECT sum(dedicated_trunks) from vicidial_server_trunks where server_ip='$server_ip' and campaign_id !='$campaign_id';";
	$rslt=mysql_query($stmt, $link);
	$rowx=mysql_fetch_row($rslt);
	$SUMvicidial_trunks = ($rowx[0] + $dedicated_trunks);
	
	if ($SUMvicidial_trunks > $MAXvicidial_trunks)
		{
		echo "<br>Η ΕΓΓΡΑΦΗ ΤΟΥ ΚΟΡΜΟΥ ΣΤΟΝ ΕΞΥΠΗΡΕΤΗΤΗ ΔΕΝ ΠΡΟΣΤΕΘΗΚΕ - ο αριθμός των κορμών είναι πολύ υψηλός: $SUMvicidial_trunks / $MAXvicidial_trunks\n";
		}
	else
		{
		$stmt="SELECT count(*) from vicidial_server_trunks where campaign_id='$campaign_id' and server_ip='$server_ip';";
		$rslt=mysql_query($stmt, $link);
		$row=mysql_fetch_row($rslt);
		if ($row[0] > 0)
			{echo "<br>Η ΕΓΓΡΑΦΗ ΤΟΥ ΚΟΡΜΟΥ ΣΤΟΝ ΕΞΥΠΗΡΕΤΗΤΗ ΔΕΝ ΠΡΟΣΤΕΘΗΚΕ - υπάρχει ήδη μία εγγραφή-κορμού στον εξυπηρετητή για την εκστρατεία\n";}
		else
			{
			 if ( (strlen($campaign_id) < 2) or (strlen($server_ip) < 7) or (strlen($dedicated_trunks) < 1) or (strlen($trunk_restriction) < 1) )
				{
				 echo "<br>Η ΕΓΓΡΑΦΗ ΤΟΥ ΚΟΡΜΟΥ ΣΤΟΝ ΕΞΥΠΗΡΕΤΗΤΗ ΔΕΝ ΠΡΟΣΤΕΘΗΚΕ - Παρακαλώ επιστρέψτε πίσω και κάνετε έλεγχο των δεδομένων που καταχωρήσατε\n";
				 echo "<br>η εκστρατεία πρέπει να είναι μεταξύ 3 και 8 χαρακτήρων στο μήκος\n";
				 echo "<br>η server_ip καθυστέρηση πρέπει να είναι τουλάχιστον 7 χαρακτήρες\n";
				 echo "<br>οι κορμοί πρέπει να είναι ένα ψηφίο από 0 έως 9999\n";
				}
			 else
				{
				echo "<br><B>Η ΕΓΓΡΑΦΗ ΤΟΥ ΚΟΡΜΟΥ ΣΤΟΝ ΕΞΥΠΗΡΕΤΗΤΗ ΠΡΟΣΤΕΘΗΚΕ: $campaign_id - $server_ip - $dedicated_trunks - $trunk_restriction</B>\n";

				$stmt="INSERT INTO vicidial_server_trunks(server_ip,campaign_id,dedicated_trunks,trunk_restriction) values('$server_ip','$campaign_id','$dedicated_trunks','$trunk_restriction');";
				$rslt=mysql_query($stmt, $link);

				### LOG CHANGES TO LOG FILE ###
				if ($WeBRooTWritablE > 0)
					{
					$fp = fopen ("./admin_changes_log.txt", "a");
					fwrite ($fp, "$date|ADD A NEW VICIDIAL TRUNK  |$PHP_AUTH_USER|$ip|$stmt|\n");
					fclose($fp);
					}
				}
			}
		}
$ADD=311111111111;
}


######################
# ADD=2111111111111 adds new conference to the system
######################

if ($ADD==2111111111111)
{
echo "<TABLE><TR><TD>\n";
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
$ADD=3111111111111;
}


######################
# ADD=21111111111111 adds new vicidial conference to the system
######################

if ($ADD==21111111111111)
{
echo "<TABLE><TR><TD>\n";
	echo "<FONT FACE=\"ARIAL,HELVETICA\" COLOR=BLACK SIZE=2>";
	$stmt="SELECT count(*) from vicidial_conferences where conf_exten='$conf_exten' and server_ip='$server_ip';";
	$rslt=mysql_query($stmt, $link);
	$row=mysql_fetch_row($rslt);
	if ($row[0] > 0)
		{echo "<br>VICIDIAL CONFERENCE NOT ADDED - there is already a vicidial conference in the system with this ID and server\n";}
	else
		{
		 if ( (strlen($conf_exten) < 1) or (strlen($server_ip) < 7) )
			{echo "<br>VICIDIAL Η ΣΥΝΔΙΑΛΕΞΗ ΔΕΝ ΠΡΟΣΤΕΘΗΚΕ - Παρακαλώ ελέγξτε τα δεδομένα που καταχωρήσατε\n";}
		 else
			{
			echo "<br>VICIDIAL Η ΣΥΝΔΙΑΛΕΞΗ ΠΡΟΣΤΕΘΗΚΕ\n";

			$stmt="INSERT INTO vicidial_conferences (conf_exten,server_ip) values('$conf_exten','$server_ip');";
			$rslt=mysql_query($stmt, $link);
			}
		}
$ADD=31111111111111;
}



######################################################################################################
######################################################################################################
#######   4 series, record modifications submitted and DB is modified, then on to 3 series forms below
######################################################################################################
######################################################################################################



######################
# ADD=4A submit user modifications to the system - ADMIN
######################

if ($ADD=="4A")
{
	if ($LOGmodify_users==1)
	{
	echo "<FONT FACE=\"ARIAL,HELVETICA\" COLOR=BLACK SIZE=2>";

	 if ( (strlen($pass) < 2) or (strlen($full_name) < 2) or (strlen($user_level) < 1) )
		{
		 echo "<br>Ο ΧΡΗΣΤΗΣ ΔΕΝ ΤΡΟΠΟΠΟΙΗΘΗΚΕ - Παρακαλώ ελέγξτε τα δεδομένα που καταχωρήσατε\n";
		 echo "<br>Ο κωδικός και το πλήρες όνομα πρέπει να είναι τουλάχιστον 2 χαρακτήρες το κάθε ένα\n";
		}
	 else
		{
		echo "<br><B>ΧΡΗΣΤΗΣ ΤΡΟΠΟΠΟΙΗΘΗΚΕ - ADMIN: $user</B>\n";

		$stmt="UPDATE vicidial_users set pass='$pass',full_name='$full_name',user_level='$user_level',user_group='$user_group',phone_login='$phone_login',phone_pass='$phone_pass',delete_users='$delete_users',delete_user_groups='$delete_user_groups',delete_lists='$delete_lists',delete_campaigns='$delete_campaigns',delete_ingroups='$delete_ingroups',delete_remote_agents='$delete_remote_agents',load_leads='$load_leads',campaign_detail='$campaign_detail',ast_admin_access='$ast_admin_access',ast_delete_phones='$ast_delete_phones',delete_scripts='$delete_scripts',modify_leads='$modify_leads',hotkeys_active='$hotkeys_active',change_agent_campaign='$change_agent_campaign',agent_choose_ingroups='$agent_choose_ingroups',closer_campaigns='$groups_value',scheduled_callbacks='$scheduled_callbacks',agentonly_callbacks='$agentonly_callbacks',agentcall_manual='$agentcall_manual',vicidial_recording='$vicidial_recording',vicidial_transfers='$vicidial_transfers',delete_filters='$delete_filters',alter_agent_interface_options='$alter_agent_interface_options',closer_default_blended='$closer_default_blended',delete_call_times='$delete_call_times',modify_call_times='$modify_call_times',modify_users='$modify_users',modify_campaigns='$modify_campaigns',modify_lists='$modify_lists',modify_scripts='$modify_scripts',modify_filters='$modify_filters',modify_ingroups='$modify_ingroups',modify_usergroups='$modify_usergroups',modify_remoteagents='$modify_remoteagents',modify_servers='$modify_servers',view_reports='$view_reports',vicidial_recording_override='$vicidial_recording_override',alter_custdata_override='$alter_custdata_override' where user='$user';";
		$rslt=mysql_query($stmt, $link);



		### LOG CHANGES TO LOG FILE ###
		if ($WeBRooTWritablE > 0)
			{
			$fp = fopen ("./admin_changes_log.txt", "a");
			fwrite ($fp, "$date|MODIFY USER INFO    |$PHP_AUTH_USER|$ip|$stmt|\n");
			fclose($fp);
			}
		}
	}
	else
	{
	echo "Δεν έχετε την άδεια να δείτε αυτήν την σελίδα\n";
	exit;
	}
$ADD=3;		# go to user modification below
}


######################
# ADD=4B submit user modifications to the system - ADMIN
######################

if ($ADD=="4B")
{
	if ($LOGmodify_users==1)
	{
	echo "<FONT FACE=\"ARIAL,HELVETICA\" COLOR=BLACK SIZE=2>";

	 if ( (strlen($pass) < 2) or (strlen($full_name) < 2) or (strlen($user_level) < 1) )
		{
		 echo "<br>Ο ΧΡΗΣΤΗΣ ΔΕΝ ΤΡΟΠΟΠΟΙΗΘΗΚΕ - Παρακαλώ ελέγξτε τα δεδομένα που καταχωρήσατε\n";
		 echo "<br>Ο κωδικός και το πλήρες όνομα πρέπει να είναι τουλάχιστον 2 χαρακτήρες το κάθε ένα\n";
		}
	 else
		{
		echo "<br><B>ΧΡΗΣΤΗΣ ΤΡΟΠΟΠΟΙΗΘΗΚΕ - ADMIN: $user</B>\n";

		$stmt="UPDATE vicidial_users set pass='$pass',full_name='$full_name',user_level='$user_level',user_group='$user_group',phone_login='$phone_login',phone_pass='$phone_pass',hotkeys_active='$hotkeys_active',agent_choose_ingroups='$agent_choose_ingroups',closer_campaigns='$groups_value',scheduled_callbacks='$scheduled_callbacks',agentonly_callbacks='$agentonly_callbacks',agentcall_manual='$agentcall_manual',vicidial_recording='$vicidial_recording',vicidial_transfers='$vicidial_transfers',closer_default_blended='$closer_default_blended',vicidial_recording_override='$vicidial_recording_override',alter_custdata_override='$alter_custdata_override' where user='$user';";
		$rslt=mysql_query($stmt, $link);

		### LOG CHANGES TO LOG FILE ###
		if ($WeBRooTWritablE > 0)
			{
			$fp = fopen ("./admin_changes_log.txt", "a");
			fwrite ($fp, "$date|MODIFY USER INFO    |$PHP_AUTH_USER|$ip|$stmt|\n");
			fclose($fp);
			}
		}
	}
	else
	{
	echo "Δεν έχετε την άδεια να δείτε αυτήν την σελίδα\n";
	exit;
	}
$ADD=3;		# go to user modification below
}



######################
# ADD=4 submit user modifications to the system
######################

if ($ADD==4)
{
	if ($LOGmodify_users==1)
	{
	echo "<FONT FACE=\"ARIAL,HELVETICA\" COLOR=BLACK SIZE=2>";

	 if ( (strlen($pass) < 2) or (strlen($full_name) < 2) or (strlen($user_level) < 1) )
		{
		 echo "<br>Ο ΧΡΗΣΤΗΣ ΔΕΝ ΤΡΟΠΟΠΟΙΗΘΗΚΕ - Παρακαλώ ελέγξτε τα δεδομένα που καταχωρήσατε\n";
		 echo "<br>Ο κωδικός και το πλήρες όνομα πρέπει να είναι τουλάχιστον 2 χαρακτήρες το κάθε ένα\n";
		}
	 else
		{
		echo "<br><B>ΧΡΗΣΤΗΣ ΤΡΟΠΟΠΟΙΗΘΗΚΕ: $user</B>\n";

		$stmt="UPDATE vicidial_users set pass='$pass',full_name='$full_name',user_level='$user_level',user_group='$user_group',phone_login='$phone_login',phone_pass='$phone_pass' where user='$user';";
		$rslt=mysql_query($stmt, $link);

		### LOG CHANGES TO LOG FILE ###
		if ($WeBRooTWritablE > 0)
			{
			$fp = fopen ("./admin_changes_log.txt", "a");
			fwrite ($fp, "$date|MODIFY USER INFO    |$PHP_AUTH_USER|$ip|pass='$pass',full_name='$full_name',user_level='$user_level',user_group='$user_group',phone_login='$phone_login',phone_pass='$phone_pass' where user='$user'|\n");
			fclose($fp);
			}
		}
	}
	else
	{
	echo "Δεν έχετε την άδεια να δείτε αυτήν την σελίδα\n";
	exit;
	}
$ADD=3;		# go to user modification below
}

######################
# ADD=41 submit campaign modifications to the system
######################

if ($ADD==41)
{
	if ($LOGmodify_campaigns==1)
	{
	echo "<FONT FACE=\"ARIAL,HELVETICA\" COLOR=BLACK SIZE=2>";

	 if ( (strlen($campaign_name) < 6) or (strlen($active) < 1) )
		{
		 echo "<br>Η ΕΚΣΤΡΑΤΕΙΑ ΔΕΝ ΤΡΟΠΟΠΟΙΗΘΗΚΕ - Παρακαλώ ελέγξτε τα δεδομένα που καταχωρήσατε\n";
		 echo "<br>το όνομα της εκστρατείας πρέπει να είναι τουλάχιστον 6 χαρακτήρες\n";
		 echo "<br>|$campaign_name|$active|\n";
		}
	 else
		{
		echo "<br><B>ΕΣΤΡΑΤΕΙΑ ΤΡΟΠΟΠΟΙΗΘΗΚΕ: $campaign_id</B>\n";

		if ($dial_method == 'MANUAL') 
			{
			$auto_dial_level='0';
			$adlSQL = "auto_dial_level='0',";
			}
		else
			{
			if ($dial_level_override > 0)
				{
				$adlSQL = "auto_dial_level='$auto_dial_level',";
				}
			else
				{
				if ($dial_method == 'RATIO')
					{
					if ($auto_dial_level < 1) {$auto_dial_level = "1.0";}
					$adlSQL = "auto_dial_level='$auto_dial_level',";
					}
				else
					{
					$adlSQL = "";
					if ($auto_dial_level < 1) 
						{
						$auto_dial_level = "1.0";
						$adlSQL = "auto_dial_level='$auto_dial_level',";
						}
					}
				}
			}
		$stmtA="UPDATE vicidial_campaigns set campaign_name='$campaign_name',active='$active',dial_status_a='$dial_status_a',dial_status_b='$dial_status_b',dial_status_c='$dial_status_c',dial_status_d='$dial_status_d',dial_status_e='$dial_status_e',lead_order='$lead_order',allow_closers='$allow_closers',hopper_level='$hopper_level', $adlSQL next_agent_call='$next_agent_call', local_call_time='$local_call_time', voicemail_ext='$voicemail_ext', dial_timeout='$dial_timeout', dial_prefix='$dial_prefix', campaign_cid='$campaign_cid', campaign_vdad_exten='$campaign_vdad_exten', web_form_address='" . mysql_real_escape_string($web_form_address) . "', park_ext='$park_ext', park_file_name='$park_file_name', campaign_rec_exten='$campaign_rec_exten', campaign_recording='$campaign_recording', campaign_rec_filename='$campaign_rec_filename', campaign_script='$script_id', get_call_launch='$get_call_launch', am_message_exten='$am_message_exten', amd_send_to_vmx='$amd_send_to_vmx', xferconf_a_dtmf='$xferconf_a_dtmf',xferconf_a_number='$xferconf_a_number', xferconf_b_dtmf='$xferconf_b_dtmf',xferconf_b_number='$xferconf_b_number',lead_filter_id='$lead_filter_id',alt_number_dialing='$alt_number_dialing',scheduled_callbacks='$scheduled_callbacks',safe_harbor_message='$safe_harbor_message',drop_call_seconds='$drop_call_seconds',safe_harbor_exten='$safe_harbor_exten',wrapup_seconds='$wrapup_seconds',wrapup_message='$wrapup_message',closer_campaigns='$groups_value',use_internal_dnc='$use_internal_dnc',allcalls_delay='$allcalls_delay',omit_phone_code='$omit_phone_code',dial_method='$dial_method',available_only_ratio_tally='$available_only_ratio_tally',adaptive_dropped_percentage='$adaptive_dropped_percentage',adaptive_maximum_level='$adaptive_maximum_level',adaptive_latest_server_time='$adaptive_latest_server_time',adaptive_intensity='$adaptive_intensity',adaptive_dl_diff_target='$adaptive_dl_diff_target',concurrent_transfers='$concurrent_transfers',auto_alt_dial='$auto_alt_dial',agent_pause_codes_active='$agent_pause_codes_active',campaign_description='$campaign_description',campaign_changedate='$SQLdate',campaign_stats_refresh='$campaign_stats_refresh',disable_alter_custdata='$disable_alter_custdata',no_hopper_leads_logins='$no_hopper_leads_logins' where campaign_id='$campaign_id';";
		$rslt=mysql_query($stmtA, $link);

		if ($reset_hopper == 'Y')
			{
			echo "<br>ΕΠΑΝΑΦΟΡΑ ΚΑΘΟΘΗΓΗΤΗ ΕΚΣΤΡΑΤΕΙΑΣ HOPPER\n";
			echo "<br> - Αναμονή 1 λεπτού πριν την κλήση του επόμενου αριθμού\n";
			$stmt="DELETE from vicidial_hopper where campaign_id='$campaign_id' and status IN('READY','QUEUE','DONE');";
			$rslt=mysql_query($stmt, $link);

			### LOG RESET TO LOG FILE ###
			if ($WeBRooTWritablE > 0)
				{
				$fp = fopen ("./admin_changes_log.txt", "a");
				fwrite ($fp, "$date|CAMPAIGN HOPPERRESET|$PHP_AUTH_USER|$ip|$stmt|\n");
				fclose($fp);
				}
			}

		### LOG CHANGES TO LOG FILE ###
		if ($WeBRooTWritablE > 0)
			{
			$fp = fopen ("./admin_changes_log.txt", "a");
			fwrite ($fp, "$date|MODIFY CAMPAIGN INFO|$PHP_AUTH_USER|$ip|$stmtA|$reset_hopper|\n");
			fclose($fp);
			}
		}
	}
	else
	{
	echo "Δεν έχετε την άδεια να δείτε αυτήν την σελίδα\n";
	exit;
	}
$ADD=31;	# go to campaign modification form below
}

######################
# ADD=42 delete campaign status in the system
######################

if ($ADD==42)
{
	if ($LOGmodify_campaigns==1)
	{
	echo "<FONT FACE=\"ARIAL,HELVETICA\" COLOR=BLACK SIZE=2>";

	 if ( (strlen($campaign_id) < 2) or (strlen($status) < 1) )
		{
		 echo "<br>Η ΚΑΤΑΣΤΑΣΗ ΤΗΣ ΕΚΣΤΡΑΤΕΙΑΣ ΔΕΝ ΤΡΟΠΟΠΟΙΗΘΗΚΕ - - Παρακαλώ ελέγξτε τα δεδομένα που καταχωρήσατε\n";
		 echo "<br>το ID της εκστρατείας πρέπει να είναι τουλάχιστον 2 χαρακτήρες\n";
		 echo "<br>η κατάσταση της εκστρατείας πρέπει να είναι τουλάχιστον 1 χαρακτήρας\n";
		}
	 else
		{
		echo "<br><B>ΔΙΑΓΡΑΦΗΚΕ Η ΠΡΟΣΑΡΜΟΣΜΕΝΗ ΚΑΤΑΣΤΑΣΗ ΤΗΣ ΕΚΣΤΡΑΤΕΙΑΣ: $campaign_id - $status</B>\n";

		$stmt="DELETE FROM vicidial_campaign_statuses where campaign_id='$campaign_id' and status='$status';";
		$rslt=mysql_query($stmt, $link);

		### LOG CHANGES TO LOG FILE ###
		if ($WeBRooTWritablE > 0)
			{
			$fp = fopen ("./admin_changes_log.txt", "a");
			fwrite ($fp, "$date|DELETE CAMPAIGN STATUS|$PHP_AUTH_USER|$ip|DELETE FROM vicidial_campaign_statuses where campaign_id='$campaign_id' and status='$status'|\n");
			fclose($fp);
			}
		}
	}
	else
	{
	echo "Δεν έχετε την άδεια να δείτε αυτήν την σελίδα\n";
	exit;
	}
$ADD=31;	# go to campaign modification form below
}

######################
# ADD=43 delete campaign hotkey in the system
######################

if ($ADD==43)
{
	if ($LOGmodify_campaigns==1)
	{
	echo "<FONT FACE=\"ARIAL,HELVETICA\" COLOR=BLACK SIZE=2>";

	 if ( (strlen($campaign_id) < 2) or (strlen($status) < 1) or (strlen($hotkey) < 1) )
		{
		 echo "<br>ΤΟ ΚΛΕΙΔΙ ΤΗΣ ΕΚΣΤΡΑΤΕΙΑΣ ΔΕΝ ΤΡΟΠΟΠΟΙΗΘΗΚΕ - Παρακαλώ ελέγξτε τα δεδομένα που καταχωρήσατε\n";
		 echo "<br>το ID της εκστρατείας πρέπει να είναι τουλάχιστον 2 χαρακτήρες\n";
		 echo "<br>η κατάσταση της εκστρατείας πρέπει να είναι τουλάχιστον 1 χαρακτήρας\n";
		 echo "<br>the campaign hotkey needs to be at least 1 characters in length\n";
		}
	 else
		{
		echo "<br><B>ΔΙΑΦΡΑΦΗΚΕ ΤΟ ΠΡΟΣΑΡΜΟΣΜΕΝΟ ΚΛΕΙΔΙ ΤΗΣ ΕΚΣΤΡΑΤΕΙΑΣ: $campaign_id - $status - $hotkey</B>\n";

		$stmt="DELETE FROM vicidial_campaign_hotkeys where campaign_id='$campaign_id' and status='$status' and hotkey='$hotkey';";
		$rslt=mysql_query($stmt, $link);

		### LOG CHANGES TO LOG FILE ###
		if ($WeBRooTWritablE > 0)
			{
			$fp = fopen ("./admin_changes_log.txt", "a");
			fwrite ($fp, "$date|DELETE CAMPAIGN STATUS|$PHP_AUTH_USER|$ip|DELETE FROM vicidial_campaign_statuses where campaign_id='$campaign_id' and status='$status' and hotkey='$hotkey'|\n");
			fclose($fp);
			}
		}
	}
	else
	{
	echo "Δεν έχετε την άδεια να δείτε αυτήν την σελίδα\n";
	exit;
	}
$ADD=31;	# go to campaign modification form below
}

######################
# ADD=44 submit campaign modifications to the system - Basic View
######################

if ($ADD==44)
{
	if ($LOGmodify_campaigns==1)
	{
	echo "<FONT FACE=\"ARIAL,HELVETICA\" COLOR=BLACK SIZE=2>";

	 if ( (strlen($campaign_name) < 6) or (strlen($active) < 1) )
		{
		 echo "<br>Η ΕΚΣΤΡΑΤΕΙΑ ΔΕΝ ΤΡΟΠΟΠΟΙΗΘΗΚΕ - Παρακαλώ ελέγξτε τα δεδομένα που καταχωρήσατε\n";
		 echo "<br>το όνομα της εκστρατείας πρέπει να είναι τουλάχιστον 6 χαρακτήρες\n";
		}
	 else
		{
		echo "<br><B>ΕΣΤΡΑΤΕΙΑ ΤΡΟΠΟΠΟΙΗΘΗΚΕ: $campaign_id</B>\n";

		if ($dial_method == 'RATIO')
			{
			if ($auto_dial_level < 1) {$auto_dial_level = "1.0";}
			$adlSQL = "auto_dial_level='$auto_dial_level',";
			}
		else
			{
			if ($dial_method == 'MANUAL') 
				{
				$auto_dial_level='0';
				$adlSQL = "auto_dial_level='0',";
				}
			else
				{
				$adlSQL = "";
				if ($auto_dial_level < 1) 
					{
					$auto_dial_level = "1.0";
					$adlSQL = "auto_dial_level='$auto_dial_level',";
					}
				}
			}
		$stmtA="UPDATE vicidial_campaigns set campaign_name='$campaign_name',active='$active',dial_status_a='$dial_status_a',dial_status_b='$dial_status_b',dial_status_c='$dial_status_c',dial_status_d='$dial_status_d',dial_status_e='$dial_status_e',lead_order='$lead_order',hopper_level='$hopper_level', $adlSQL lead_filter_id='$lead_filter_id',dial_method='$dial_method',adaptive_intensity='$adaptive_intensity',campaign_description='$campaign_description',campaign_changedate='$SQLdate' where campaign_id='$campaign_id';";
		$rslt=mysql_query($stmtA, $link);

		if ($reset_hopper == 'Y')
			{
			echo "<br>ΕΠΑΝΑΦΟΡΑ ΚΑΘΟΘΗΓΗΤΗ ΕΚΣΤΡΑΤΕΙΑΣ HOPPER\n";
			echo "<br> - Αναμονή 1 λεπτού πριν την κλήση του επόμενου αριθμού\n";
			$stmt="DELETE from vicidial_hopper where campaign_id='$campaign_id' and status IN('READY','QUEUE','DONE');;";
			$rslt=mysql_query($stmt, $link);

			### LOG HOPPER RESET TO LOG FILE ###
			if ($WeBRooTWritablE > 0)
				{
				$fp = fopen ("./admin_changes_log.txt", "a");
				fwrite ($fp, "$date|CAMPAIGN HOPPERRESET|$PHP_AUTH_USER|$ip|$stmt|\n");
				fclose($fp);
				}
			}

		### LOG CHANGES TO LOG FILE ###
		if ($WeBRooTWritablE > 0)
			{
			$fp = fopen ("./admin_changes_log.txt", "a");
			fwrite ($fp, "$date|MODIFY CAMPAIGN INFO|$PHP_AUTH_USER|$ip|$stmtA|$reset_hopper|\n");
			fclose($fp);
			}
		}
	}
	else
	{
	echo "Δεν έχετε την άδεια να δείτε αυτήν την σελίδα\n";
	exit;
	}
$ADD=34;	# go to campaign modification form below
}

######################
# ADD=45 modify campaign lead recycle in the system
######################

if ($ADD==45)
{
	if ($LOGmodify_campaigns==1)
	{
	echo "<FONT FACE=\"ARIAL,HELVETICA\" COLOR=BLACK SIZE=2>";

	 if ( (strlen($campaign_id) < 2) or (strlen($status) < 1) or ($attempt_delay < 120)  or ($attempt_maximum < 1) or ($attempt_maximum > 10) )
		{
		 echo "<br>CAMPAIGN LEAD RECYCLE NOT MODIFIED - Παρακαλώ επιστρέψτε πίσω και κάνετε έλεγχο των δεδομένων που καταχωρήσατε\n";
		 echo "<br>η κατάσταση πρέπει να είναι μεταξύ 1 και 6 χαρακτήρων στο μήκος\n";
		 echo "<br>η καθυστέρηση προσπάθειας πρέπει να είναι τουλάχιστον 120δευτερόλεπτα\n";
		 echo "<br>οι μέγιστες προσπάθειες πρέπει να είναι από 1 έως 10\n";
		}
	 else
		{
		echo "<br><B>CAMPAIGN LEAD MODIFIED: $campaign_id - $status - $attempt_delay</B>\n";

		$stmt="UPDATE vicidial_lead_recycle SET attempt_delay='$attempt_delay',attempt_maximum='$attempt_maximum',active='$active' where campaign_id='$campaign_id' and status='$status';";
		$rslt=mysql_query($stmt, $link);

		### LOG CHANGES TO LOG FILE ###
		if ($WeBRooTWritablE > 0)
			{
			$fp = fopen ("./admin_changes_log.txt", "a");
			fwrite ($fp, "$date|MODIFY LEAD RECYCLE   |$PHP_AUTH_USER|$ip|$stmt|\n");
			fclose($fp);
			}
		}
	}
	else
	{
	echo "Δεν έχετε την άδεια να δείτε αυτήν την σελίδα\n";
	exit;
	}
$ADD=31;	# go to campaign modification form below
}

######################
# ADD=47 modify agent pause code in the system
######################

if ($ADD==47)
{
	if ($LOGmodify_campaigns==1)
	{
	echo "<FONT FACE=\"ARIAL,HELVETICA\" COLOR=BLACK SIZE=2>";

	 if ( (strlen($campaign_id) < 2) or (strlen($pause_code) < 1) or (strlen($pause_code) > 6) or (strlen($pause_code_name) < 2) )
		{
		 echo "<br>ΚΩΔΙΚΑΣ ΜΙΚΡΗΣ ΔΙΑΚΟΠΉΣ ΠΡΑΚΤΟΡΩΝ ΤΡΟΠΟΠΟΙΗΜΕΝΟΣ - Παρακαλώ επιστρέψτε πίσω και κάνετε έλεγχο των δεδομένων που καταχωρήσατε\n";
		 echo "<br>pause_code must be between 1 and 6 characters in length\n";
		 echo "<br>pause_code name must be between 2 and 30 characters in length\n";
		}
	 else
		{
		echo "<br><B>ΧΕΙΡΙΣΤΗΣPAUSE CODE MODIFIED: $campaign_id - $pause_code - $pause_code_name</B>\n";

		$stmt="UPDATE vicidial_pause_codes SET pause_code_name='$pause_code_name',billable='$billable' where campaign_id='$campaign_id' and pause_code='$pause_code';";
		$rslt=mysql_query($stmt, $link);

		### LOG CHANGES TO LOG FILE ###
		if ($WeBRooTWritablE > 0)
			{
			$fp = fopen ("./admin_changes_log.txt", "a");
			fwrite ($fp, "$date|MODIFY ΧΕΙΡΙΣΤΗΣPAUSECODE|$PHP_AUTH_USER|$ip|$stmt|\n");
			fclose($fp);
			}
		}
	}
	else
	{
	echo "Δεν έχετε την άδεια να δείτε αυτήν την σελίδα\n";
	exit;
	}
$ADD=31;	# go to campaign modification form below
}

######################
# ADD=411 submit list modifications to the system
######################

if ($ADD==411)
{
	if ($LOGmodify_lists==1)
	{
	echo "<FONT FACE=\"ARIAL,HELVETICA\" COLOR=BLACK SIZE=2>";

	 if ( (strlen($list_name) < 2) or (strlen($campaign_id) < 2) )
		{
		 echo "<br>Η ΛΙΣΤΑ ΔΕΝ ΤΡΟΠΟΠΟΙΗΘΗΚΕ - Παρακαλώ ελέγξτε τα δεδομένα που καταχωρήσατε\n";
		 echo "<br>η λίστα πρέπει να είναι τουλαχιστον 2 χαρακτήρες\n";
		}
	 else
		{
		echo "<br><B>ΛΙΣΤΑ ΤΡΟΠΟΠΟΙΗΘΗΚΕ: $list_id</B>\n";

		$stmt="UPDATE vicidial_lists set list_name='$list_name',campaign_id='$campaign_id',active='$active',list_description='$list_description',list_changedate='$SQLdate' where list_id='$list_id';";
		$rslt=mysql_query($stmt, $link);

		if ($reset_list == 'Y')
			{
			echo "<br>ΕΠΑΝΑΦΟΡΑ ΚΑΤΑΣΤΑΣΗΣ ΚΛΗΣΗΣ ΛΙΣΤΑΣ\n";
			$stmt="UPDATE vicidial_list set called_since_last_reset='N' where list_id='$list_id';";
			$rslt=mysql_query($stmt, $link);

			### LOG RESET TO LOG FILE ###
			if ($WeBRooTWritablE > 0)
				{
				$fp = fopen ("./admin_changes_log.txt", "a");
				fwrite ($fp, "$date|RESET LIST CALLED   |$PHP_AUTH_USER|$ip|list_name='$list_name'|\n");
				fclose($fp);
				}
			}
		if ($campaign_id != "$old_campaign_id")
			{
			echo "<br>ΑΠΟΜΑΚΡΥΝΣΗ ΚΑΘΟΔΗΓΗΤΩΝ ΛΙΣΤΑΣ HOPPER ΑΠΟ ΠΑΛΑΙΑ HOPPER ΕΚΣΤΡΑΤΕΙΑ ($old_campaign_id)\n";
			$stmt="DELETE from vicidial_hopper where list_id='$list_id' and campaign_id='$old_campaign_id';";
			$rslt=mysql_query($stmt, $link);
			}

		### LOG CHANGES TO LOG FILE ###
		if ($WeBRooTWritablE > 0)
			{
			$fp = fopen ("./admin_changes_log.txt", "a");
			fwrite ($fp, "$date|MODIFY LIST INFO    |$PHP_AUTH_USER|$ip|list_name='$list_name',campaign_id='$campaign_id',active='$active',list_description='$list_description' where list_id='$list_id'|\n");
			fclose($fp);
			}
		}
	}
	else
	{
	echo "Δεν έχετε την άδεια να δείτε αυτήν την σελίδα\n";
	exit;
	}
$ADD=311;	# go to list modification form below
}


######################
# ADD=4111 modify in-group info in the system
######################

if ($ADD==4111)
{
	if ($LOGmodify_ingroups==1)
	{
	echo "<FONT FACE=\"ARIAL,HELVETICA\" COLOR=BLACK SIZE=2>";

	 if ( (strlen($group_name) < 2) or (strlen($group_color) < 2) )
		{
		 echo "<br>Η ΟΜΑΔΑ ΔΕΝ ΤΡΟΠΟΠΟΙΗΘΗΚΕ - Παρακαλώ ελέγξτε τα δεδομένα που καταχωρήσατε\n";
		 echo "<br>το όνομα και χρώμα ομάδας πρέπει να είναι τουλάχιστον 2 χαρακτήρες\n";
		}
	 else
		{
		echo "<br><B>ΟΜΑΔΑ ΤΡΟΠΟΠΟΙΗΘΗΚΕ: $group_id</B>\n";

		$stmt="UPDATE vicidial_inbound_groups set group_name='$group_name', group_color='$group_color', active='$active', web_form_address='" . mysql_real_escape_string($web_form_address) . "', voicemail_ext='$voicemail_ext', next_agent_call='$next_agent_call', fronter_display='$fronter_display', ingroup_script='$script_id', get_call_launch='$get_call_launch', xferconf_a_dtmf='$xferconf_a_dtmf',xferconf_a_number='$xferconf_a_number', xferconf_b_dtmf='$xferconf_b_dtmf',xferconf_b_number='$xferconf_b_number',drop_message='$drop_message',drop_call_seconds='$drop_call_seconds',drop_exten='$drop_exten' where group_id='$group_id';";
		$rslt=mysql_query($stmt, $link);

		### LOG CHANGES TO LOG FILE ###
		if ($WeBRooTWritablE > 0)
			{
			$fp = fopen ("./admin_changes_log.txt", "a");
			fwrite ($fp, "$date|MODIFY GROUP INFO   |$PHP_AUTH_USER|$ip|$stmt|\n");
			fclose($fp);
			}
		}
	}
	else
	{
	echo "Δεν έχετε την άδεια να δείτε αυτήν την σελίδα\n";
	exit;
	}
$ADD=3111;	# go to in-group modification form below
}



######################
# ADD=41111 modify remote agents info in the system
######################

if ($ADD==41111)
{
	if ($LOGmodify_remoteagents==1)
	{
	echo "<FONT FACE=\"ARIAL,HELVETICA\" COLOR=BLACK SIZE=2>";

	 if ( (strlen($server_ip) < 2) or (strlen($user_start) < 2)  or (strlen($campaign_id) < 2) or (strlen($conf_exten) < 2) )
		{
		 echo "<br>ΑΠΟΜΑΚΡΥΣΜΕΝΟΙ ΧΕΙΡΙΣΤΕΣ ΔΕΝ ΤΡΟΠΟΠΟΙΗΘΗΚΑΝ - Παρακαλώ ελέγξτε τα δεδομένα που καταχωρήσατε\n";
		 echo "<br>Το ID του χρήστη και η εξωτερική εσωτ.σύνδεση πρέπει να είναι τουλάχιστον 2 χαρακτήρες\n";
		}
	 else
		{
		$stmt="UPDATE vicidial_remote_agents set user_start='$user_start', number_of_lines='$number_of_lines', server_ip='$server_ip', conf_exten='$conf_exten', status='$status', campaign_id='$campaign_id', closer_campaigns='$groups_value' where remote_agent_id='$remote_agent_id';";
		$rslt=mysql_query($stmt, $link);

		echo "<br><B>ΑΠΟΜΑΚΡΥΣΜΕΝΟΙ ΧΕΙΡΙΣΤΕΣ ΤΡΟΠΟΠΟΙΗΘΗΚΑΝ</B>\n";

		### LOG CHANGES TO LOG FILE ###
		if ($WeBRooTWritablE > 0)
			{
			$fp = fopen ("./admin_changes_log.txt", "a");
			fwrite ($fp, "$date|MODIFY ΑΠΟΜΑΚΡΥΣΜΕΝΟΙ ΧΕΙΡΙΣΤΕΣ ENTRY     |$PHP_AUTH_USER|$ip|set user_start='$user_start', number_of_lines='$number_of_lines', server_ip='$server_ip', conf_exten='$conf_exten', status='$status', campaign_id='$campaign_id', closer_campaigns='$groups_value' where remote_agent_id='$remote_agent_id'|\n");
			fclose($fp);
			}
		}
	}
	else
	{
	echo "Δεν έχετε την άδεια να δείτε αυτήν την σελίδα\n";
	exit;
	}
$ADD=31111;	# go to remote agents modification form below
}



######################
# ADD=411111 modify user group info in the system
######################

if ($ADD==411111)
{
	if ($LOGmodify_usergroups==1)
	{
	echo "<FONT FACE=\"ARIAL,HELVETICA\" COLOR=BLACK SIZE=2>";

	 if ( (strlen($user_group) < 2) or (strlen($group_name) < 2) )
		{
		 echo "<br>Η ΟΜΑΔΑ ΧΡΗΣΤΗ ΔΕΝ ΤΡΟΠΟΠΟΙΗΘΗΚΕ - Παρακαλώ ελέγξτε τα δεδομένα που καταχωρήσατε\n";
		 echo "<br>Η ομάδα και η περιγραφή πρέπει να είναι τουλάχιστον 2 χαρακτήρες\n";
		}
	 else
		{
		$stmt="UPDATE vicidial_user_groups set user_group='$user_group', group_name='$group_name',allowed_campaigns='$campaigns_value' where user_group='$OLDuser_group';";
		$rslt=mysql_query($stmt, $link);

		echo "<br><B>ΟΜΑΔΑ ΧΡΗΣΤΗ ΤΡΟΠΟΠΟΙΗΘΗΚΕ</B>\n";

		### LOG CHANGES TO LOG FILE ###
		if ($WeBRooTWritablE > 0)
			{
			$fp = fopen ("./admin_changes_log.txt", "a");
			fwrite ($fp, "$date|MODIFY USER GROUP ENTRY     |$PHP_AUTH_USER|$ip|$stmt|\n");
			fclose($fp);
			}
		}
	}
	else
	{
	echo "Δεν έχετε την άδεια να δείτε αυτήν την σελίδα\n";
	exit;
	}
$ADD=311111;	# go to user group modification form below
}

######################
# ADD=4111111 modify script in the system
######################

if ($ADD==4111111)
{
	if ($LOGmodify_scripts==1)
	{
	echo "<!-- $script_text -->\n";
	echo "<!--" . mysql_real_escape_string($script_text) . " -->\n";
	echo "<FONT FACE=\"ARIAL,HELVETICA\" COLOR=BLACK SIZE=2>";

	 if ( (strlen($script_id) < 2) or (strlen($script_name) < 2) or (strlen($script_text) < 2) )
		{
		 echo "<br>Ο ΒΟΗΘΟΣ ΔΕΝ ΤΡΟΠΟΠΟΙΗΘΗΚΕ - Παρακαλώ επιστρέψτε πίσω και κάνετε έλεγχο των δεδομένων που καταχωρήσατε\n";
		 echo "<br>Το όνομα, η περιγραφή και το κείμενο χειρογράφων πρέπει να είναι τουλάχιστον 2 χαρακτήρες στο μήκος\n";
		}
	 else
		{
		$stmt="UPDATE vicidial_scripts set script_name='$script_name', script_comments='$script_comments', script_text='$script_text', active='$active' where script_id='$script_id';";
		$rslt=mysql_query($stmt, $link);

		echo "<br><B>Ο ΒΟΗΘΟΣ ΤΡΟΠΟΠΟΙΗΘΗΚΕ</B>\n";

		### LOG CHANGES TO LOG FILE ###
		if ($WeBRooTWritablE > 0)
			{
			$fp = fopen ("./admin_changes_log.txt", "a");
			fwrite ($fp, "$date|MODIFY SCRIPT ENTRY         |$PHP_AUTH_USER|$ip|$stmt|\n");
			fclose($fp);
			}
		}
	}
	else
	{
	echo "Δεν έχετε την άδεια να δείτε αυτήν την σελίδα\n";
	exit;
	}
$ADD=3111111;	# go to script modification form below
}


######################
# ADD=41111111 modify filter in the system
######################

if ($ADD==41111111)
{
	if ($LOGmodify_filters==1)
	{
	echo "<FONT FACE=\"ARIAL,HELVETICA\" COLOR=BLACK SIZE=2>";

	 if ( (strlen($lead_filter_id) < 2) or (strlen($lead_filter_name) < 2) or (strlen($lead_filter_sql) < 2) )
		{
		 echo "<br>ΤΟ ΦΙΛΤΡΟ ΔΕΝ ΤΡΟΠΟΠΟΙΗΘΗΚΕ - Παρακαλώ επιστρέψτε πίσω και κάνετε έλεγχο των δεδομένων που καταχωρήσατε\n";
		 echo "<br>ID φίλτρου, όνομα και SQL πρέπει να είναι τουλάχιστον 2 χαρακτήρες\n";
		}
	 else
		{
		$stmt="UPDATE vicidial_lead_filters set lead_filter_name='$lead_filter_name', lead_filter_comments='$lead_filter_comments', lead_filter_sql='$lead_filter_sql' where lead_filter_id='$lead_filter_id';";
		$rslt=mysql_query($stmt, $link);

		echo "<br><B>ΤΟ ΦΙΛΤΡΟ ΤΡΟΠΟΠΟΙΗΘΗΚΕ</B>\n";

		### LOG CHANGES TO LOG FILE ###
		if ($WeBRooTWritablE > 0)
			{
			$fp = fopen ("./admin_changes_log.txt", "a");
			fwrite ($fp, "$date|MODIFY FILTER ENTRY         |$PHP_AUTH_USER|$ip|$stmt|\n");
			fclose($fp);
			}
		}
	}
	else
	{
	echo "Δεν έχετε την άδεια να δείτε αυτήν την σελίδα\n";
	exit;
	}
$ADD=31111111;	# go to filter modification form below
}


######################
# ADD=411111111 modify call time in the system
######################

if ($ADD==411111111)
{
	if ($LOGmodify_call_times==1)
	{
	echo "<FONT FACE=\"ARIAL,HELVETICA\" COLOR=BLACK SIZE=2>";

	 if ( (strlen($call_time_id) < 2) or (strlen($call_time_name) < 2) )
		{
		 echo "<br>ΧΟΝΟΣ ΚΛΗΣΗΣ ΔΕΝ ΤΡΟΠΟΠΟΙΗΘΗΚΕ - Παρακαλώ επιστρέψτε πίσω και κάνετε έλεγχο των δεδομένων που καταχωρήσατε\n";
		 echo "<br>Το ID Χρόνου Κλήσης και το όνομα πρέπει να είναι τουλάχιστον 2 χαρακτήρες\n";
		}
	 else
		{
		$ct_default_start = preg_replace('/\D/', '', $ct_default_start);
		$ct_default_stop = preg_replace('/\D/', '', $ct_default_stop);
		$ct_sunday_start = preg_replace('/\D/', '', $ct_sunday_start);
		$ct_sunday_stop = preg_replace('/\D/', '', $ct_sunday_stop);
		$ct_monday_start = preg_replace('/\D/', '', $ct_monday_start);
		$ct_monday_stop = preg_replace('/\D/', '', $ct_monday_stop);
		$ct_tuesday_start = preg_replace('/\D/', '', $ct_tuesday_start);
		$ct_tuesday_stop = preg_replace('/\D/', '', $ct_tuesday_stop);
		$ct_wednesday_start = preg_replace('/\D/', '', $ct_wednesday_start);
		$ct_wednesday_stop = preg_replace('/\D/', '', $ct_wednesday_stop);
		$ct_thursday_start = preg_replace('/\D/', '', $ct_thursday_start);
		$ct_thursday_stop = preg_replace('/\D/', '', $ct_thursday_stop);
		$ct_friday_start = preg_replace('/\D/', '', $ct_friday_start);
		$ct_friday_stop = preg_replace('/\D/', '', $ct_friday_stop);
		$ct_saturday_start = preg_replace('/\D/', '', $ct_saturday_start);
		$ct_saturday_stop = preg_replace('/\D/', '', $ct_saturday_stop);
		$stmt="UPDATE vicidial_call_times set call_time_name='$call_time_name', call_time_comments='$call_time_comments', ct_default_start='$ct_default_start', ct_default_stop='$ct_default_stop', ct_sunday_start='$ct_sunday_start', ct_sunday_stop='$ct_sunday_stop', ct_monday_start='$ct_monday_start', ct_monday_stop='$ct_monday_stop', ct_tuesday_start='$ct_tuesday_start', ct_tuesday_stop='$ct_tuesday_stop', ct_wednesday_start='$ct_wednesday_start', ct_wednesday_stop='$ct_wednesday_stop', ct_thursday_start='$ct_thursday_start', ct_thursday_stop='$ct_thursday_stop', ct_friday_start='$ct_friday_start', ct_friday_stop='$ct_friday_stop', ct_saturday_start='$ct_saturday_start', ct_saturday_stop='$ct_saturday_stop' where call_time_id='$call_time_id';";
		$rslt=mysql_query($stmt, $link);

		echo "<br><B>ΤΡΟΠΟΠΟΙΗΘΗΚΕ ΧΡΟΝΟΣ ΚΛΗΣΗΣ</B>\n";

		### LOG CHANGES TO LOG FILE ###
		if ($WeBRooTWritablE > 0)
			{
			$fp = fopen ("./admin_changes_log.txt", "a");
			fwrite ($fp, "$date|MODIFY CALL TIME ENTRY      |$stmt|\n");
			fclose($fp);
			}
		}
	}
	else
	{
	echo "Δεν έχετε την άδεια να δείτε αυτήν την σελίδα\n";
	exit;
	}
$ADD=311111111;	# go to call time modification form below
}


######################
# ADD=4111111111 modify state call time in the system
######################

if ($ADD==4111111111)
{
	if ($LOGmodify_call_times==1)
	{
	echo "<FONT FACE=\"ARIAL,HELVETICA\" COLOR=BLACK SIZE=2>";

	 if ( (strlen($call_time_id) < 2) or (strlen($call_time_name) < 2) or (strlen($state_call_time_state) < 2) )
		{
		 echo "<br>ΧΡΟΝΟΣ ΚΛΗΣΗΣ ΚΑΤΑΣΤΑΣΗΣ ΔΕΝ ΤΡΟΠΟΠΟΙΗΘΗΚΕ - Παρακαλώ επιστρέψτε πίσω και κάνετε έλεγχο των δεδομένων που καταχωρήσατε\n";
		 echo "<br>Το ID Χρόνου Κλήσης Κατάστασης, το όνομα και η κατάσταση πρέπει να είναι τουλάχιστον 2 χαρακτήρες \n";
		}
	 else
		{
		$ct_default_start = preg_replace('/\D/', '', $ct_default_start);
		$ct_default_stop = preg_replace('/\D/', '', $ct_default_stop);
		$ct_sunday_start = preg_replace('/\D/', '', $ct_sunday_start);
		$ct_sunday_stop = preg_replace('/\D/', '', $ct_sunday_stop);
		$ct_monday_start = preg_replace('/\D/', '', $ct_monday_start);
		$ct_monday_stop = preg_replace('/\D/', '', $ct_monday_stop);
		$ct_tuesday_start = preg_replace('/\D/', '', $ct_tuesday_start);
		$ct_tuesday_stop = preg_replace('/\D/', '', $ct_tuesday_stop);
		$ct_wednesday_start = preg_replace('/\D/', '', $ct_wednesday_start);
		$ct_wednesday_stop = preg_replace('/\D/', '', $ct_wednesday_stop);
		$ct_thursday_start = preg_replace('/\D/', '', $ct_thursday_start);
		$ct_thursday_stop = preg_replace('/\D/', '', $ct_thursday_stop);
		$ct_friday_start = preg_replace('/\D/', '', $ct_friday_start);
		$ct_friday_stop = preg_replace('/\D/', '', $ct_friday_stop);
		$ct_saturday_start = preg_replace('/\D/', '', $ct_saturday_start);
		$ct_saturday_stop = preg_replace('/\D/', '', $ct_saturday_stop);
		$stmt="UPDATE vicidial_state_call_times set state_call_time_name='$call_time_name', state_call_time_comments='$call_time_comments', sct_default_start='$ct_default_start', sct_default_stop='$ct_default_stop', sct_sunday_start='$ct_sunday_start', sct_sunday_stop='$ct_sunday_stop', sct_monday_start='$ct_monday_start', sct_monday_stop='$ct_monday_stop', sct_tuesday_start='$ct_tuesday_start', sct_tuesday_stop='$ct_tuesday_stop', sct_wednesday_start='$ct_wednesday_start', sct_wednesday_stop='$ct_wednesday_stop', sct_thursday_start='$ct_thursday_start', sct_thursday_stop='$ct_thursday_stop', sct_friday_start='$ct_friday_start', sct_friday_stop='$ct_friday_stop', sct_saturday_start='$ct_saturday_start', sct_saturday_stop='$ct_saturday_stop', state_call_time_state='$state_call_time_state'  where state_call_time_id='$call_time_id';";
		$rslt=mysql_query($stmt, $link);

		echo "<br><B>ΤΡΟΠΟΠΟΙΗΘΗΚΕ ΧΡΟΝΟΣ ΚΛΗΣΗΣ ΚΑΤΑΣΤΑΣΗΣ</B>\n";

		### LOG CHANGES TO LOG FILE ###
		if ($WeBRooTWritablE > 0)
			{
			$fp = fopen ("./admin_changes_log.txt", "a");
			fwrite ($fp, "$date|MODIFY STATE CALL TIME ENTRY|$stmt|\n");
			fclose($fp);
			}
		}
	}
	else
	{
	echo "Δεν έχετε την άδεια να δείτε αυτήν την σελίδα\n";
	exit;
	}
$ADD=3111111111;	# go to state call time modification form below
}


######################
# ADD=41111111111 modify phone record in the system
######################

if ($ADD==41111111111)
{
	if ($LOGast_admin_access==1)
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

			$stmt="UPDATE phones set extension='$extension', dialplan_number='$dialplan_number', voicemail_id='$voicemail_id', phone_ip='$phone_ip', computer_ip='$computer_ip', server_ip='$server_ip', login='$login', pass='$pass', status='$status', active='$active', phone_type='$phone_type', fullname='$fullname', company='$company', picture='$picture', protocol='$protocol', local_gmt='$local_gmt', ASTmgrUSERNAME='$ASTmgrUSERNAME', ASTmgrSECRET='$ASTmgrSECRET', login_user='$login_user', login_pass='$login_pass', login_campaign='$login_campaign', park_on_extension='$park_on_extension', conf_on_extension='$conf_on_extension', VICIDIAL_park_on_extension='$VICIDIAL_park_on_extension', VICIDIAL_park_on_filename='$VICIDIAL_park_on_filename', monitor_prefix='$monitor_prefix', recording_exten='$recording_exten', voicemail_exten='$voicemail_exten', voicemail_dump_exten='$voicemail_dump_exten', ext_context='$ext_context', dtmf_send_extension='$dtmf_send_extension', call_out_number_group='$call_out_number_group', client_browser='$client_browser', install_directory='$install_directory', local_web_callerID_URL='" . mysql_real_escape_string($local_web_callerID_URL) . "', VICIDIAL_web_URL='" . mysql_real_escape_string($VICIDIAL_web_URL) . "', AGI_call_logging_enabled='$AGI_call_logging_enabled', user_switching_enabled='$user_switching_enabled', conferencing_enabled='$conferencing_enabled', admin_hangup_enabled='$admin_hangup_enabled', admin_hijack_enabled='$admin_hijack_enabled', admin_monitor_enabled='$admin_monitor_enabled', call_parking_enabled='$call_parking_enabled', updater_check_enabled='$updater_check_enabled', AFLogging_enabled='$AFLogging_enabled', QUEUE_ACTION_enabled='$QUEUE_ACTION_enabled', CallerID_popup_enabled='$CallerID_popup_enabled', voicemail_button_enabled='$voicemail_button_enabled', enable_fast_refresh='$enable_fast_refresh', fast_refresh_rate='$fast_refresh_rate', enable_persistant_mysql='$enable_persistant_mysql', auto_dial_next_number='$auto_dial_next_number', VDstop_rec_after_each_call='$VDstop_rec_after_each_call', DBX_server='$DBX_server', DBX_database='$DBX_database', DBX_user='$DBX_user', DBX_pass='$DBX_pass', DBX_port='$DBX_port', DBY_server='$DBY_server', DBY_database='$DBY_database', DBY_user='$DBY_user', DBY_pass='$DBY_pass', DBY_port='$DBY_port', outbound_cid='$outbound_cid', enable_sipsak_messages='$enable_sipsak_messages' where extension='$old_extension' and server_ip='$old_server_ip';";
			$rslt=mysql_query($stmt, $link);
			}
		}
	}
	else
	{
	echo "Δεν έχετε την άδεια να δείτε αυτήν την σελίδα\n";
	exit;
	}
$ADD=31111111111;	# go to phone modification form below
}


######################
# ADD=411111111111 modify server record in the system
######################

if ($ADD==411111111111)
{
	if ($LOGmodify_servers==1)
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

				$stmt="UPDATE servers set server_id='$server_id',server_description='$server_description',server_ip='$server_ip',active='$active',asterisk_version='$asterisk_version', max_vicidial_trunks='$max_vicidial_trunks', telnet_host='$telnet_host', telnet_port='$telnet_port', ASTmgrUSERNAME='$ASTmgrUSERNAME', ASTmgrSECRET='$ASTmgrSECRET', ASTmgrUSERNAMEupdate='$ASTmgrUSERNAMEupdate', ASTmgrUSERNAMElisten='$ASTmgrUSERNAMElisten', ASTmgrUSERNAMEsend='$ASTmgrUSERNAMEsend', local_gmt='$local_gmt', voicemail_dump_exten='$voicemail_dump_exten', answer_transfer_agent='$answer_transfer_agent', ext_context='$ext_context', sys_perf_log='$sys_perf_log', vd_server_logs='$vd_server_logs', agi_output='$agi_output', vicidial_balance_active='$vicidial_balance_active', balance_trunks_offlimits='$balance_trunks_offlimits' where server_id='$old_server_id';";
				$rslt=mysql_query($stmt, $link);
				}
			}
		}
	}
	else
	{
	echo "Δεν έχετε την άδεια να δείτε αυτήν την σελίδα\n";
	exit;
	}
$ADD=311111111111;	# go to server modification form below
}


######################
# ADD=421111111111 modify vicidial server trunks record in the system
######################

if ($ADD==421111111111)
{
	if ($LOGmodify_servers==1)
	{
	echo "<FONT FACE=\"ARIAL,HELVETICA\" COLOR=BLACK SIZE=2>";
	$stmt="SELECT max_vicidial_trunks from servers where server_ip='$server_ip';";
	$rslt=mysql_query($stmt, $link);
	$rowx=mysql_fetch_row($rslt);
	$MAXvicidial_trunks = $rowx[0];
	
	$stmt="SELECT sum(dedicated_trunks) from vicidial_server_trunks where server_ip='$server_ip' and campaign_id !='$campaign_id';";
	$rslt=mysql_query($stmt, $link);
	$rowx=mysql_fetch_row($rslt);
	$SUMvicidial_trunks = ($rowx[0] + $dedicated_trunks);
	
	if ($SUMvicidial_trunks > $MAXvicidial_trunks)
		{
		echo "<br>Η ΕΓΓΡΑΦΗ ΤΟΥ ΚΟΡΜΟΥ ΣΤΟΝ ΕΞΥΠΗΡΕΤΗΤΗ ΔΕΝ ΠΡΟΣΤΕΘΗΚΕ - ο αριθμός των κορμών είναι πολύ υψηλός: $SUMvicidial_trunks / $MAXvicidial_trunks\n";
		}
	else
		{
		 if ( (strlen($campaign_id) < 2) or (strlen($server_ip) < 7) or (strlen($dedicated_trunks) < 1) or (strlen($trunk_restriction) < 1) )
			{
			 echo "<br>Η ΕΓΓΡΑΦΗ ΤΟΥ ΚΟΡΜΟΥ ΣΤΟΝ ΕΞΥΠΗΡΕΤΗΤΗ ΔΕΝ ΤΡΟΠΟΠΟΙΗΘΗΚΕ - Παρακαλώ επιστρέψτε πίσω και κάνετε έλεγχο των δεδομένων που καταχωρήσατε\n";
			 echo "<br>η εκστρατεία πρέπει να είναι μεταξύ 3 και 8 χαρακτήρων στο μήκος\n";
			 echo "<br>η server_ip καθυστέρηση πρέπει να είναι τουλάχιστον 7 χαρακτήρες\n";
			 echo "<br>οι κορμοί πρέπει να είναι ένα ψηφίο από 0 έως 9999\n";
			}
		 else
			{
			echo "<br><B>Η ΕΓΓΡΑΦΗ ΤΟΥ ΚΟΡΜΟΥ ΣΤΟΝ ΕΞΥΠΗΡΕΤΗΤΗ ΤΡΟΠΟΠΟΙΗΘΗΚΕ: $campaign_id - $server_ip - $dedicated_trunks - $trunk_restriction</B>\n";

			$stmt="UPDATE vicidial_server_trunks SET dedicated_trunks='$dedicated_trunks',trunk_restriction='$trunk_restriction' where campaign_id='$campaign_id' and server_ip='$server_ip';";
			$rslt=mysql_query($stmt, $link);

			### LOG CHANGES TO LOG FILE ###
			if ($WeBRooTWritablE > 0)
				{
				$fp = fopen ("./admin_changes_log.txt", "a");
				fwrite ($fp, "$date|ΤΡΟΠΟΠΟΙΗΣΕ ΔΙΑΚΟΜΙΣΤΗ TRUNK   |$PHP_AUTH_USER|$ip|$stmt|\n");
				fclose($fp);
				}
			}
		}
	}
	else
	{
	echo "Δεν έχετε την άδεια να δείτε αυτήν την σελίδα\n";
	exit;
	}
$ADD=311111111111;	# go to server modification form below
}


######################
# ADD=4111111111111 modify conference record in the system
######################

if ($ADD==4111111111111)
{
	if ($LOGast_admin_access==1)
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
	}
	else
	{
	echo "Δεν έχετε την άδεια να δείτε αυτήν την σελίδα\n";
	exit;
	}
$ADD=3111111111111;	# go to conference modification form below
}


######################
# ADD=41111111111111 modify vicidial conference record in the system
######################

if ($ADD==41111111111111)
{
	if ($LOGast_admin_access==1)
	{
	echo "<FONT FACE=\"ARIAL,HELVETICA\" COLOR=BLACK SIZE=2>";

	$stmt="SELECT count(*) from vicidial_conferences where conf_exten='$conf_exten' and server_ip='$server_ip';";
	$rslt=mysql_query($stmt, $link);
	$row=mysql_fetch_row($rslt);
	if ( ($row[0] > 0) && ( ($conf_exten != $old_conf_exten) or ($server_ip != $old_server_ip) ) )
		{echo "<br>VICIDIAL Η ΣΥΝΔΙΑΛΕΞΗ ΔΕΝ ΤΡΟΠΟΠΟΙΗΘΗΚΕ - υπάρχει ήδη μία συνδιάλεξη με αυτή την εσωτ.σύνδεση-διακομιστή\n";}
	else
		{
		 if ( (strlen($conf_exten) < 1) or (strlen($server_ip) < 7) )
			{echo "<br>VICIDIAL Η ΣΥΝΔΙΑΛΕΞΗ ΔΕΝ ΤΡΟΠΟΠΟΙΗΘΗΚΕ - Παρακαλώ ελέγξτε τα δεδομένα που καταχωρήσατε\n";}
		 else
			{
			echo "<br>VICIDIAL Η ΣΥΝΔΙΑΛΕΞΗ ΤΡΟΠΟΠΟΙΗΘΗΚΕ: $conf_exten\n";

			$stmt="UPDATE vicidial_conferences set conf_exten='$conf_exten',server_ip='$server_ip',extension='$extension' where conf_exten='$old_conf_exten';";
			$rslt=mysql_query($stmt, $link);

			}
		}
	}
	else
	{
	echo "Δεν έχετε την άδεια να δείτε αυτήν την σελίδα\n";
	exit;
	}
$ADD=31111111111111;	# go to vicidial conference modification form below
}



######################
# ADD=411111111111111 modify vicidial system settings
######################

if ($ADD==411111111111111)
{
	if ($LOGmodify_servers==1)
	{
	echo "<FONT FACE=\"ARIAL,HELVETICA\" COLOR=BLACK SIZE=2>";

	echo "<br>VICIDIAL ΤΟΠΟΘΕΤΗΣΕΙΣ ΣΥΣΤΗΜΑΤΩΝ ΤΡΟΠΟΠΟΙΗΜΕΝΕΣ\n";

	$stmt="UPDATE system_settings set use_non_latin='$use_non_latin',webroot_writable='$webroot_writable',enable_queuemetrics_logging='$enable_queuemetrics_logging',queuemetrics_server_ip='$queuemetrics_server_ip',queuemetrics_dbname='$queuemetrics_dbname',queuemetrics_login='$queuemetrics_login',queuemetrics_pass='$queuemetrics_pass',queuemetrics_url='$queuemetrics_url',queuemetrics_log_id='$queuemetrics_log_id',queuemetrics_eq_prepend='$queuemetrics_eq_prepend',vicidial_agent_disable='$vicidial_agent_disable',allow_sipsak_messages='$allow_sipsak_messages',admin_home_url='$admin_home_url';";
	$rslt=mysql_query($stmt, $link);

	### LOG CHANGES TO LOG FILE ###
	if ($WeBRooTWritablE > 0)
		{
		$fp = fopen ("./admin_changes_log.txt", "a");
		fwrite ($fp, "$date|MODIFY SYSTEM SETTINGS|$PHP_AUTH_USER|$ip|$stmt|\n");
		fclose($fp);
		}
	}
	else
	{
	echo "Δεν έχετε την άδεια να δείτε αυτήν την σελίδα\n";
	exit;
	}
$ADD=311111111111111;	# go to vicidial system settings form below
}



######################################################################################################
######################################################################################################
#######   5 series, delete records confirmation
######################################################################################################
######################################################################################################


######################
# ADD=5 confirmation before deletion of user
######################

if ($ADD==5)
{
	echo "<FONT FACE=\"ARIAL,HELVETICA\" COLOR=BLACK SIZE=2>";

	 if ( (strlen($user) < 2) or ($LOGdelete_users < 1) )
		{
		 echo "<br>ΧΡΗΣΤΗΣ ΔΕΝ ΔΙΑΓΡΑΦΗΚΕ - Παρακαλώ επιστρέψτε πίσω και κάνετε έλεγχο των δεδομένων που καταχωρήσατε\n";
		 echo "<br>User be at least 2 characters in length\n";
		}
	 else
		{
		echo "<br><B>ΕΠΙΒΕΒΑΙΩΣΗ ΔΙΑΓΡΑΦΗΣ ΧΡΗΣΤΗ: $user</B>\n";
		echo "<br><br><a href=\"$PHP_SELF?ADD=6&user=$user&CoNfIrM=YES\">Χτυπήστε εδώ για να διαγράψετε το χρήστη $user</a><br><br><br>\n";
		}

$ADD='3';		# go to user modification below
}

######################
# ADD=51 confirmation before deletion of campaign
######################

if ($ADD==51)
{
	echo "<FONT FACE=\"ARIAL,HELVETICA\" COLOR=BLACK SIZE=2>";

	 if ( (strlen($campaign_id) < 2) or ($LOGdelete_campaigns < 1) )
		{
		 echo "<br>ΕΚΣΤΡΑΤΕΙΑ ΔΕΝ ΔΙΑΓΡΑΦΗΚΕ - Παρακαλώ επιστρέψτε πίσω και κάνετε έλεγχο των δεδομένων που καταχωρήσατε\n";
		 echo "<br>Εκστρατεία_id be at least 2 characters in length\n";
		}
	 else
		{
		echo "<br><B>ΕΠΙΒΕΒΑΙΩΣΗ ΔΙΑΓΡΑΦΗΣ ΕΚΣΤΡΑΤΕΙΑΣ: $campaign_id</B>\n";
		echo "<br><br><a href=\"$PHP_SELF?ADD=61&campaign_id=$campaign_id&CoNfIrM=YES\">Χτυπήστε εδώ για να διαγράψετε την εκστρατεία $campaign_id</a><br><br><br>\n";
		}

$ADD='31';		# go to campaign modification below
}

######################
# ADD=52 confirmation before logging all agents out of campaign of campaign
######################

if ($ADD==52)
{
	echo "<FONT FACE=\"ARIAL,HELVETICA\" COLOR=BLACK SIZE=2>";

	 if (strlen($campaign_id) < 2)
		{
		 echo "<br>ΧΕΙΡΙΣΤΕΣ ΠΟΥ ΔΕΝ ΕΙΝΑΙ ΑΠΟΣΥΝΔΕΜΕΝΟΙ ΑΠΟ ΤΗΝ ΕΚΣΤΡΑΤΕΙΑ - Παρακαλώ επιστρέψτε πίσω και κάνετε έλεγχο των δεδομένων που καταχωρήσατε\n";
		 echo "<br>Εκστρατεία_id be at least 2 characters in length\n";
		}
	 else
		{
		echo "<br><B>ΕΠΙΒΕΒΑΙΩΣΗ ΑΠΟΣΥΝΔΕΣΗΣ ΧΕΙΡΙΣΤΩΝ: $campaign_id</B>\n";
		echo "<br><br><a href=\"$PHP_SELF?ADD=62&campaign_id=$campaign_id&CoNfIrM=YES\">Επιλέξτε εδώ για να αποσυνδέσετε όλους τους χειριστές από $campaign_id</a><br><br><br>\n";
		}

$ADD='31';		# go to campaign modification below
}

######################
# ADD=53 confirmation before Emergency VDAC Jam Clear - deletes oldest LIVE vicidial_auto_call record
######################

if ($ADD==53)
{
	if (eregi('IN',$stage))
		{$group_id=$campaign_id;}
	echo "<FONT FACE=\"ARIAL,HELVETICA\" COLOR=BLACK SIZE=2>";

	 if (strlen($campaign_id) < 2)
		{
		 echo "<br>VDAC ΔΕΝ ΚΑΘΑΡΙΣΤΗΚΕ ΓΙΑ ΤΗΝ ΕΚΣΤΡΑΤΕΊΑ - Παρακαλώ επιστρέψτε πίσω και κάνετε έλεγχο των δεδομένων που καταχωρήσατε\n";
		 echo "<br>Εκστρατεία_id be at least 2 characters in length\n";
		}
	 else
		{
		echo "<br><B>ΕΠΙΒΕΒΑΙΩΣΗ ΚΑΘΑΡΙΣΜΟΥ VDAC: $campaign_id</B>\n";
		echo "<br><br><a href=\"$PHP_SELF?ADD=63&campaign_id=$campaign_id&CoNfIrM=YES&&stage=$stage\">Επιλέξτε εδώ για να διαγράψετε την παλαιότερη ΖΩΝΤΑΝΗ εγγραφή στο VDAC για $campaign_id</a><br><br><br>\n";
		}

# go to campaign modification below
if (eregi('IN',$stage))
	{$ADD='3111';}
else
	{$ADD='31';}	
}

######################
# ADD=511 confirmation before deletion of list
######################

if ($ADD==511)
{
	echo "<FONT FACE=\"ARIAL,HELVETICA\" COLOR=BLACK SIZE=2>";

	 if ( (strlen($list_id) < 2) or ($LOGdelete_lists < 1) )
		{
		 echo "<br>ΛΙΣΤΑ ΔΕΝ ΔΙΑΓΡΑΦΗΚΕ - Παρακαλώ επιστρέψτε πίσω και κάνετε έλεγχο των δεδομένων που καταχωρήσατε\n";
		 echo "<br>List_id be at least 2 characters in length\n";
		}
	 else
		{
		echo "<br><B>ΕΠΙΒΕΒΑΙΩΣΗ ΔΙΑΓΡΑΦΗΣ ΛΙΣΤΑΣ: $list_id</B>\n";
		echo "<br><br><a href=\"$PHP_SELF?ADD=611&list_id=$list_id&CoNfIrM=YES\">Χτυπήστε εδώ για να διαγράψετε τον κατάλογο και όλους τους οδηγούς του $list_id</a><br><br><br>\n";
		}

$ADD='311';		# go to campaign modification below
}

######################
# ADD=5111 confirmation before deletion of in-group
######################

if ($ADD==5111)
{
	echo "<FONT FACE=\"ARIAL,HELVETICA\" COLOR=BLACK SIZE=2>";

	 if ( (strlen($group_id) < 2) or ($LOGdelete_ingroups < 1) )
		{
		 echo "<br>ΕΙΣ-ΟΜΑΔΑ ΔΕΝ ΔΙΑΓΡΑΦΗΚΕ - Παρακαλώ επιστρέψτε πίσω και κάνετε έλεγχο των δεδομένων που καταχωρήσατε\n";
		 echo "<br>Group_id be at least 2 characters in length\n";
		}
	 else
		{
		echo "<br><B>ΕΠΙΒΕΒΑΙΩΣΗ ΔΙΑΓΡΑΦΗΣ ΕΙΣ-ΟΜΑΔΑΣ: $group_id</B>\n";
		echo "<br><br><a href=\"$PHP_SELF?ADD=6111&group_id=$group_id&CoNfIrM=YES\">Επιλέξτε εδώ για να διαγράψετε την-ΟΜΑΔΑ $group_id</a><br><br><br>\n";
		}

$ADD='3111';		# go to in-group modification below
}

######################
# ADD=51111 confirmation before deletion of remote agent record
######################

if ($ADD==51111)
{
	echo "<FONT FACE=\"ARIAL,HELVETICA\" COLOR=BLACK SIZE=2>";

	 if ( (strlen($remote_agent_id) < 1) or ($LOGdelete_remote_agents < 1) )
		{
		 echo "<br>ΑΠΟΜΑΚΡΥΣΜΕΝΟΣ ΧΕΙΡΙΣΤΗΣ ΔΕΝ ΔΙΑΓΡΑΦΗΚΕ - Παρακαλώ επιστρέψτε πίσω και κάνετε έλεγχο των δεδομένων που καταχωρήσατε\n";
		 echo "<br>Remote_agent_id be at least 2 characters in length\n";
		}
	 else
		{
		echo "<br><B>ΕΠΙΒΕΒΑΙΩΣΗ ΔΙΑΓΡΑΦΗΣ ΑΠΟΜΑΚΡΥΣΜΕΝΩΝ ΧΕΙΡΙΣΤΩΝ : $remote_agent_id</B>\n";
		echo "<br><br><a href=\"$PHP_SELF?ADD=61111&remote_agent_id=$remote_agent_id&CoNfIrM=YES\">Επιλέξτε εδώ για να διαγράψετε τον απομακρυσμένο χειριστή $remote_agent_id</a><br><br><br>\n";
		}

$ADD='31111';		# go to remote agent modification below
}

######################
# ADD=511111 confirmation before deletion of user group record
######################

if ($ADD==511111)
{
	echo "<FONT FACE=\"ARIAL,HELVETICA\" COLOR=BLACK SIZE=2>";

	 if ( (strlen($user_group) < 2) or ($LOGdelete_user_groups < 1) )
		{
		 echo "<br>ΟΜΑΔΑ ΧΡΗΣΤΗ ΔΕΝ ΔΙΑΓΡΑΦΗΚΕ - Παρακαλώ επιστρέψτε πίσω και κάνετε έλεγχο των δεδομένων που καταχωρήσατε\n";
		 echo "<br>User_group be at least 2 characters in length\n";
		}
	 else
		{
		echo "<br><B>ΕΠΙΒΕΒΑΙΩΣΗ ΔΙΑΓΡΑΦΗΣ ΟΜΑΔΑΣ ΧΡΗΣΤΩΝ: $user_group</B>\n";
		echo "<br><br><a href=\"$PHP_SELF?ADD=611111&user_group=$user_group&CoNfIrM=YES\">Επιλέξτε εδώ για να διαγράψετε την ομάδα χρηστών $user_group</a><br><br><br>\n";
		}

$ADD='311111';		# go to user group modification below
}

######################
# ADD=5111111 confirmation before deletion of script record
######################

if ($ADD==5111111)
{
	echo "<FONT FACE=\"ARIAL,HELVETICA\" COLOR=BLACK SIZE=2>";

	 if ( (strlen($script_id) < 2) or ($LOGdelete_scripts < 1) )
		{
		 echo "<br>ΔΕΝ ΔΙΑΓΡΑΦΗΚΕ Ο ΒΟΗΘΟΣ - Παρακαλώ επιστρέψτε πίσω και κάνετε έλεγχο των δεδομένων που καταχωρήσατε\n";
		 echo "<br>Script_id must be at least 2 characters in length\n";
		}
	 else
		{
		echo "<br><B>ΕΠΙΒΕΒΑΙΩΣΗ ΔΙΑΓΡΑΦΗΣ ΒΟΗΘΟΥ: $script_id</B>\n";
		echo "<br><br><a href=\"$PHP_SELF?ADD=6111111&script_id=$script_id&CoNfIrM=YES\">επιλέξτε εδώ για να διαγράψετε τον βοηθό $script_id</a><br><br><br>\n";
		}

$ADD='3111111';		# go to script modification below
}

######################
# ADD=51111111 confirmation before deletion of filter record
######################

if ($ADD==51111111)
{
	echo "<FONT FACE=\"ARIAL,HELVETICA\" COLOR=BLACK SIZE=2>";

	 if ( (strlen($lead_filter_id) < 2) or ($LOGdelete_filters < 1) )
		{
		 echo "<br>ΤΟ ΦΙΛΤΡΟ ΔΕΝ ΔΙΑΓΡΑΦΗΚΕ - Παρακαλώ επιστρέψτε πίσω και κάνετε έλεγχο των δεδομένων που καταχωρήσατε\n";
		 echo "<br>To ID φίλτρου πρέπει να είναι τουλάχιστον 2 χαρακτήρες\n";
		}
	 else
		{
		echo "<br><B>FILTER DELETION CONFIRMATION: $lead_filter_id</B>\n";
		echo "<br><br><a href=\"$PHP_SELF?ADD=61111111&lead_filter_id=$lead_filter_id&CoNfIrM=YES\">Πατήστε εδώ για διαγραφή του φίλτρου$lead_filter_id</a><br><br><br>\n";
		}

$ADD='31111111';		# go to filter modification below
}

######################
# ADD=511111111 confirmation before deletion of call time record
######################

if ($ADD==511111111)
{
	echo "<FONT FACE=\"ARIAL,HELVETICA\" COLOR=BLACK SIZE=2>";

	 if ( (strlen($call_time_id) < 2) or ($LOGdelete_call_times < 1) )
		{
		 echo "<br>Ο ΧΡΟΝΟΣ ΚΛΗΣΗΣ ΔΕΝ ΔΙΑΓΡΑΦΗΚΕ - Παρακαλώ επιστρέψτε πίσω και κάνετε έλεγχο των δεδομένων που καταχωρήσατε\n";
		 echo "<br>Το ID χρόνου κλήσης πρέπει να είναι τουλάχιστον 2 χαρακτήρες\n";
		}
	 else
		{
		echo "<br><B>ΕΠΙΒΕΒΑΙΩΣΗ ΔΙΑΓΡΑΦΗΣ ΧΡΟΝΟΥ ΚΛΗΣΗΣ: $call_time_id</B>\n";
		echo "<br><br><a href=\"$PHP_SELF?ADD=611111111&call_time_id=$call_time_id&CoNfIrM=YES\">Click here to delete call time $call_time_id</a><br><br><br>\n";
		}

$ADD='311111111';		# go to call time modification below
}

######################
# ADD=5111111111 confirmation before deletion of state call time record
######################

if ($ADD==5111111111)
{
	echo "<FONT FACE=\"ARIAL,HELVETICA\" COLOR=BLACK SIZE=2>";

	 if ( (strlen($call_time_id) < 2) or ($LOGdelete_call_times < 1) )
		{
		 echo "<br>Ο ΧΡΟΝΟΣ ΚΛΗΣΗΣ ΚΑΤΑΣΤΑΣΗΣΔΕΝ ΔΙΑΓΡΑΦΗΚΕ - Παρακαλώ επιστρέψτε πίσω και κάνετε έλεγχο των δεδομένων που καταχωρήσατε\n";
		 echo "<br>Το ID χρόνου κλήσης πρέπει να είναι τουλάχιστον 2 χαρακτήρες\n";
		}
	 else
		{
		echo "<br><B>ΕΠΙΒΕΒΑΙΩΣΗ ΔΙΑΓΡΑΦΗΣ ΧΡΟΝΟΥ ΚΛΗΣΗΣ ΚΑΤΑΣΤΑΣΗΣ: $call_time_id</B>\n";
		echo "<br><br><a href=\"$PHP_SELF?ADD=6111111111&call_time_id=$call_time_id&CoNfIrM=YES\">Click here to delete state call time $call_time_id</a><br><br><br>\n";
		}

$ADD='3111111111';		# go to state call time modification below
}


######################
# ADD=51111111111 confirmation before deletion of phone record
######################

if ($ADD==51111111111)
{
	echo "<FONT FACE=\"ARIAL,HELVETICA\" COLOR=BLACK SIZE=2>";

	 if ( (strlen($extension) < 2) or (strlen($server_ip) < 7) or ($LOGast_delete_phones < 1) )
		{
		 echo "<br>ΤΟ ΤΗΛΕΦΩΝΟ ΔΕΝ ΔΙΑΓΡΑΦΗΚΕ - Παρακαλώ επιστρέψτε πίσω και κάνετε έλεγχο των δεδομένων που καταχωρήσατε\n";
		 echo "<br>Extension be at least 2 characters in length\n";
		 echo "<br>IP Διακομιστή be at least 7 characters in length\n";
		}
	 else
		{
		echo "<br><B>ΕΠΙΒΕΒΑΙΩΣΗ ΔΙΑΓΡΑΦΗΣ ΤΗΛΕΦΩΝΟΥ: $extension - $server_ip</B>\n";
		echo "<br><br><a href=\"$PHP_SELF?ADD=61111111111&extension=$extension&server_ip=$server_ip&CoNfIrM=YES\">Επιλέξτε εδώ για να διαγράψετε το τηλέφωνο $extension - $server_ip</a><br><br><br>\n";
		}
$ADD='31111111111';		# go to phone modification below
}


######################
# ADD=511111111111 confirmation before deletion of server record
######################

if ($ADD==511111111111)
{
	echo "<FONT FACE=\"ARIAL,HELVETICA\" COLOR=BLACK SIZE=2>";

	 if ( (strlen($server_id) < 2) or (strlen($server_ip) < 7) or ($LOGast_delete_phones < 1) )
		{
		 echo "<br>ΔΙΑΚΟΜΙΣΤΗΣ NOT DELETED - Παρακαλώ επιστρέψτε πίσω και κάνετε έλεγχο των δεδομένων που καταχωρήσατε\n";
		 echo "<br>ID Διακομιστή be at least 2 characters in length\n";
		 echo "<br>IP Διακομιστή be at least 7 characters in length\n";
		}
	 else
		{
		echo "<br><B>ΔΙΑΚΟΜΙΣΤΗΣ DELETION CONFIRMATION: $server_id - $server_ip</B>\n";
		echo "<br><br><a href=\"$PHP_SELF?ADD=611111111111&server_id=$server_id&server_ip=$server_ip&CoNfIrM=YES\">Επιλέξτε εδώ για να διαγράψετε το τηλέφωνο $server_id - $server_ip</a><br><br><br>\n";
		}
$ADD='311111111111';		# go to server modification below
}


######################
# ADD=5111111111111 confirmation before deletion of conference record
######################

if ($ADD==5111111111111)
{
	echo "<FONT FACE=\"ARIAL,HELVETICA\" COLOR=BLACK SIZE=2>";

	 if ( (strlen($conf_exten) < 2) or (strlen($server_ip) < 7) or ($LOGast_delete_phones < 1) )
		{
		 echo "<br>CONFERENCE NOT DELETED - Παρακαλώ επιστρέψτε πίσω και κάνετε έλεγχο των δεδομένων που καταχωρήσατε\n";
		 echo "<br>Conference must be at least 2 characters in length\n";
		 echo "<br>IP Διακομιστή be at least 7 characters in length\n";
		}
	 else
		{
		echo "<br><B>CONFERENCE DELETION CONFIRMATION: $conf_exten - $server_ip</B>\n";
		echo "<br><br><a href=\"$PHP_SELF?ADD=6111111111111&conf_exten=$conf_exten&server_ip=$server_ip&CoNfIrM=YES\">Επιλέξτε εδώ για να διαγράψετε το τηλέφωνο $conf_exten - $server_ip</a><br><br><br>\n";
		}
$ADD='3111111111111';		# go to conference modification below
}


######################
# ADD=51111111111111 confirmation before deletion of vicidial conference record
######################

if ($ADD==51111111111111)
{
	echo "<FONT FACE=\"ARIAL,HELVETICA\" COLOR=BLACK SIZE=2>";

	 if ( (strlen($conf_exten) < 2) or (strlen($server_ip) < 7) or ($LOGast_delete_phones < 1) )
		{
		 echo "<br>VICIDIAL CONFERENCE NOT DELETED - Παρακαλώ επιστρέψτε πίσω και κάνετε έλεγχο των δεδομένων που καταχωρήσατε\n";
		 echo "<br>Conference must be at least 2 characters in length\n";
		 echo "<br>IP Διακομιστή be at least 7 characters in length\n";
		}
	 else
		{
		echo "<br><B>VICIDIAL CONFERENCE DELETION CONFIRMATION: $conf_exten - $server_ip</B>\n";
		echo "<br><br><a href=\"$PHP_SELF?ADD=61111111111111&conf_exten=$conf_exten&server_ip=$server_ip&CoNfIrM=YES\">Επιλέξτε εδώ για να διαγράψετε το τηλέφωνο $conf_exten - $server_ip</a><br><br><br>\n";
		}
$ADD='31111111111111';		# go to vicidial conference modification below
}



######################################################################################################
######################################################################################################
#######   6 series, delete records
######################################################################################################
######################################################################################################


######################
# ADD=6 delete user record
######################

if ($ADD==6)
{
	echo "<FONT FACE=\"ARIAL,HELVETICA\" COLOR=BLACK SIZE=2>";

	 if ( ( strlen($user) < 2) or ($CoNfIrM != 'YES') or ($LOGdelete_users < 1) )
		{
		 echo "<br>ΧΡΗΣΤΗΣ ΔΕΝ ΔΙΑΓΡΑΦΗΚΕ - Παρακαλώ επιστρέψτε πίσω και κάνετε έλεγχο των δεδομένων που καταχωρήσατε\n";
		 echo "<br>User be at least 2 characters in length\n";
		}
	 else
		{
		$stmt="DELETE from vicidial_users where user='$user' limit 1;";
		$rslt=mysql_query($stmt, $link);

		### LOG CHANGES TO LOG FILE ###
		if ($WeBRooTWritablE > 0)
			{
			$fp = fopen ("./admin_changes_log.txt", "a");
			fwrite ($fp, "$date|!!!DELETING USER!!!!|$PHP_AUTH_USER|$ip|user='$user'|\n");
			fclose($fp);
			}
		echo "<br><B>ΔΙΑΓΡΑΦΗ ΧΡΗΣΤΗ ΟΛΟΚΛΗΡΩΘΗΚΕ: $user</B>\n";
		echo "<br><br>\n";
		}

$ADD='0';		# go to user list
}

######################
# ADD=61 delete campaign record
######################

if ($ADD==61)
{
	echo "<FONT FACE=\"ARIAL,HELVETICA\" COLOR=BLACK SIZE=2>";

	 if ( ( strlen($campaign_id) < 2) or ($CoNfIrM != 'YES') or ($LOGdelete_campaigns < 1) )
		{
		 echo "<br>ΕΚΣΤΡΑΤΕΙΑ ΔΕΝ ΔΙΑΓΡΑΦΗΚΕ - Παρακαλώ επιστρέψτε πίσω και κάνετε έλεγχο των δεδομένων που καταχωρήσατε\n";
		 echo "<br>Εκστρατεία_id be at least 2 characters in length\n";
		}
	 else
		{
		$stmt="DELETE from vicidial_campaigns where campaign_id='$campaign_id' limit 1;";
		$rslt=mysql_query($stmt, $link);

		echo "<br>ΑΠΟΜΑΚΡΥΝΣΗ ΚΑΘΟΔΗΓΗΤΩΝ ΛΙΣΤΑΣ HOPPER ΑΠΟ ΠΑΛΑΙΑ HOPPER ΕΚΣΤΡΑΤΕΙΑ ($campaign_id)\n";
		$stmt="DELETE from vicidial_hopper where campaign_id='$campaign_id';";
		$rslt=mysql_query($stmt, $link);

		### LOG CHANGES TO LOG FILE ###
		if ($WeBRooTWritablE > 0)
			{
			$fp = fopen ("./admin_changes_log.txt", "a");
			fwrite ($fp, "$date|!!DELETING CAMPAIGN!|$PHP_AUTH_USER|$ip|campaign_id='$campaign_id'|\n");
			fclose($fp);
			}
		echo "<br><B>ΔΙΑΓΡΑΦΗ ΕΚΣΤΡΑΤΕΙΑΣ ΟΛΟΚΛΗΡΩΘΗΚΕ: $campaign_id</B>\n";
		echo "<br><br>\n";
		}

$ADD='10';		# go to campaigns list
}

######################
# ADD=62 Logout all agents from a campaign
######################

if ($ADD==62)
{
	if ($LOGmodify_campaigns==1)
	{
	echo "<FONT FACE=\"ARIAL,HELVETICA\" COLOR=BLACK SIZE=2>";

	 if (strlen($campaign_id) < 2)
		{
		 echo "<br>ΧΕΙΡΙΣΤΕΣ ΠΟΥ ΔΕΝ ΕΙΝΑΙ ΑΠΟΣΥΝΔΕΜΕΝΟΙ ΑΠΟ ΤΗΝ ΕΚΣΤΡΑΤΕΙΑ - Παρακαλώ επιστρέψτε πίσω και κάνετε έλεγχο των δεδομένων που καταχωρήσατε\n";
		 echo "<br>Εκστρατεία_id be at least 2 characters in length\n";
		}
	 else
		{
		$stmt="DELETE from vicidial_live_agents where campaign_id='$campaign_id';";
		$rslt=mysql_query($stmt, $link);

		### LOG CHANGES TO LOG FILE ###
		if ($WeBRooTWritablE > 0)
			{
			$fp = fopen ("./admin_changes_log.txt", "a");
			fwrite ($fp, "$date|!!ΧΕΙΡΙΣΤΗΣLOGOUT!!!!!!|$PHP_AUTH_USER|$ip|campaign_id='$campaign_id'|\n");
			fclose($fp);
			}
		echo "<br><B>ΑΠΟΣΥΝΔΕΣΗ ΧΕΙΡΙΣΤΩΝ ΟΛΟΚΛΗΡΩΘΗΚΕ: $campaign_id</B>\n";
		echo "<br><br>\n";
		}
	}
	else
	{
	echo "Δεν έχετε την άδεια να δείτε αυτήν την σελίδα\n";
	exit;
	}
$ADD='31';		# go to campaign modification below
}


######################
# ADD=63 Emergency VDAC Jam Clear
######################

if ($ADD==63)
{
	if ($LOGmodify_campaigns==1)
	{
	if (eregi('IN',$stage))
		{$group_id=$campaign_id;}
	echo "<FONT FACE=\"ARIAL,HELVETICA\" COLOR=BLACK SIZE=2>";

	 if (strlen($campaign_id) < 2)
		{
		 echo "<br>VDAC ΔΕΝ ΚΑΘΑΡΙΣΤΗΚΕ ΓΙΑ ΤΗΝ ΕΚΣΤΡΑΤΕΊΑ - Παρακαλώ επιστρέψτε πίσω και κάνετε έλεγχο των δεδομένων που καταχωρήσατε\n";
		 echo "<br>Εκστρατεία_id be at least 2 characters in length\n";
		}
	 else
		{
		$stmt="DELETE from vicidial_auto_calls where status='LIVE' and campaign_id='$campaign_id' order by call_time limit 1;";
		$rslt=mysql_query($stmt, $link);

		### LOG CHANGES TO LOG FILE ###
		if ($WeBRooTWritablE > 0)
			{
			$fp = fopen ("./admin_changes_log.txt", "a");
			fwrite ($fp, "$date|EMERGENCY VDAC CLEAR|$PHP_AUTH_USER|$ip|campaign_id='$campaign_id'|\n");
			fclose($fp);
			}
		echo "<br><B>ΤΕΛΕΥΤΑΙΑ ΕΓΓΡΑΦΗ VDAC ΠΟΥ ΚΑΘΑΡΙΖΕΤΑΙ ΓΙΑ ΤΗΝ ΕΚΣΤΡΑΤΕΙΑ: $campaign_id</B>\n";
		echo "<br><br>\n";
		}
	}
	else
	{
	echo "Δεν έχετε την άδεια να δείτε αυτήν την σελίδα\n";
	exit;
	}
# go to campaign modification below
if (eregi('IN',$stage))
	{$ADD='3111';}
else
	{$ADD='31';}	
}


######################
# ADD=65 delete campaign lead recycle in the system
######################

if ($ADD==65)
{
	if ($LOGmodify_campaigns==1)
	{
	echo "<FONT FACE=\"ARIAL,HELVETICA\" COLOR=BLACK SIZE=2>";

	 if ( (strlen($campaign_id) < 2) or (strlen($status) < 1) )
		{
		 echo "<br>ΔΕΝ ΔΙΑΓΡΑΦΗΚΕ Ο ΟΔΗΓΟΣ ΑΝΑΚΥΚΛΩΣΗΣ ΕΚΣΤΡΑΤΕΙΑΣ - Παρακαλώ επιστρέψτε πίσω και κάνετε έλεγχο των δεδομένων που καταχωρήσατε\n";
		 echo "<br>η κατάσταση πρέπει να είναι μεταξύ 1 και 6 χαρακτήρων στο μήκος\n";
		 echo "<br>η καθυστέρηση προσπάθειας πρέπει να είναι τουλάχιστον 120δευτερόλεπτα\n";
		 echo "<br>οι μέγιστες προσπάθειες πρέπει να είναι από 1 έως 10\n";
		}
	 else
		{
		echo "<br><B>ΔΙΑΓΡΑΦΗΚΕ Ο ΟΔΗΓΟΣ ΑΝΑΚΥΚΛΩΣΗΣ ΕΚΣΤΡΑΤΕΙΑΣ: $campaign_id - $status - $attempt_delay</B>\n";

		$stmt="DELETE FROM vicidial_lead_recycle where campaign_id='$campaign_id' and status='$status';";
		$rslt=mysql_query($stmt, $link);

		### LOG CHANGES TO LOG FILE ###
		if ($WeBRooTWritablE > 0)
			{
			$fp = fopen ("./admin_changes_log.txt", "a");
			fwrite ($fp, "$date|DELETE LEAD RECYCLE   |$PHP_AUTH_USER|$ip|$stmt|\n");
			fclose($fp);
			}
		}
	}
	else
	{
	echo "Δεν έχετε την άδεια να δείτε αυτήν την σελίδα\n";
	exit;
	}
$ADD=31;	# go to campaign modification form below
}


######################
# ADD=66 delete auto alt dial status from the campaign
######################

if ($ADD==66)
{
	if ($LOGmodify_campaigns==1)
	{
	echo "<FONT FACE=\"ARIAL,HELVETICA\" COLOR=BLACK SIZE=2>";
	$stmt="SELECT count(*) from vicidial_campaigns where campaign_id='$campaign_id' and auto_alt_dial_statuses LIKE \"% $status %\";";
	$rslt=mysql_query($stmt, $link);
	$row=mysql_fetch_row($rslt);
	if ($row[0] < 1)
		{echo "<br>ΑΥΤΟΜΑΤΗ ΘΈΣΗ ΠΙΝΑΚΩΝ ALT ΠΟΥ ΔΕΝ ΔΙΑΓΡΑΦΕΤΑΙ - αυτή η αυτόματη θέση πινάκων ALT δεν είναι σε αυτήν τηνεκστρατεία\n";}
	else
		{
		 if ( (strlen($campaign_id) < 2) or (strlen($status) < 1) )
			{
			 echo "<br>ΑΥΤΟΜΑΤΗ ΘΈΣΗ ΠΙΝΑΚΩΝ ALT ΠΟΥ ΔΕΝ ΔΙΑΓΡΑΦΕΤΑΙ - Παρακαλώ επιστρέψτε πίσω και κάνετε έλεγχο των δεδομένων που καταχωρήσατε\n";
			 echo "<br>η κατάσταση πρέπει να είναι μεταξύ 1 και 6 χαρακτήρων στο μήκος\n";
			}
		 else
			{
			echo "<br><B>ΑΥΤΟΜΑΤΗ ΘΈΣΗ ΠΙΝΑΚΩΝ ALT ΠΟΥ ΔΙΑΓΡΑΦΕΤΑΙ: $campaign_id - $status</B>\n";

			$stmt="SELECT auto_alt_dial_statuses from vicidial_campaigns where campaign_id='$campaign_id';";
			$rslt=mysql_query($stmt, $link);
			$row=mysql_fetch_row($rslt);

			$auto_alt_dial_statuses = eregi_replace(" $status "," ",$row[0]);
			$stmt="UPDATE vicidial_campaigns set auto_alt_dial_statuses='$auto_alt_dial_statuses' where campaign_id='$campaign_id';";
			$rslt=mysql_query($stmt, $link);

			### LOG CHANGES TO LOG FILE ###
			if ($WeBRooTWritablE > 0)
				{
				$fp = fopen ("./admin_changes_log.txt", "a");
				fwrite ($fp, "$date|DELETE AUTALTDIALSTTUS|$PHP_AUTH_USER|$ip|$stmt|\n");
				fclose($fp);
				}
			}
		}
	}
	else
	{
	echo "Δεν έχετε την άδεια να δείτε αυτήν την σελίδα\n";
	exit;
	}
$ADD=31;	# go to campaign modification form below
}

######################
# ADD=67 delete agent pause code in the system
######################

if ($ADD==67)
{
	if ($LOGmodify_campaigns==1)
	{
	echo "<FONT FACE=\"ARIAL,HELVETICA\" COLOR=BLACK SIZE=2>";

	 if ( (strlen($campaign_id) < 2) or (strlen($pause_code) < 1) )
		{
		 echo "<br>ΚΩΔΙΚΑΣ ΜΙΚΡΗΣ ΔΙΑΚΟΠΉΣ ΕΚΣΤΡΑΤΕΙΑΣ ΠΟΥ ΔΕΝ ΔΙΑΓΡΑΦΕΤΑΙ - Παρακαλώ επιστρέψτε πίσω και κάνετε έλεγχο των δεδομένων που καταχωρήσατε\n";
		 echo "<br>pause code must be between 1 and 6 characters in length\n";
		}
	 else
		{
		echo "<br><B>CAMPAIGN PAUSE CODE DELETED: $campaign_id - $pause_code</B>\n";

		$stmt="DELETE FROM vicidial_pause_codes where campaign_id='$campaign_id' and pause_code='$pause_code';";
		$rslt=mysql_query($stmt, $link);

		### LOG CHANGES TO LOG FILE ###
		if ($WeBRooTWritablE > 0)
			{
			$fp = fopen ("./admin_changes_log.txt", "a");
			fwrite ($fp, "$date|DELETE ΧΕΙΡΙΣΤΗΣPAUSECODE|$PHP_AUTH_USER|$ip|$stmt|\n");
			fclose($fp);
			}
		}
	}
	else
	{
	echo "Δεν έχετε την άδεια να δείτε αυτήν την σελίδα\n";
	exit;
	}
$ADD=31;	# go to campaign modification form below
}


######################
# ADD=68 remove campaign dial status
######################

if ($ADD==68)
{
	if ($LOGmodify_campaigns==1)
	{
	echo "<FONT FACE=\"ARIAL,HELVETICA\" COLOR=BLACK SIZE=2>";
	$stmt="SELECT count(*) from vicidial_campaigns where campaign_id='$campaign_id' and dial_statuses LIKE \"% $status %\";";
	$rslt=mysql_query($stmt, $link);
	$row=mysql_fetch_row($rslt);
	if ($row[0] < 1)
		{echo "<br>ΘΕΣΗ ΠΙΝΑΚΩΝ ΕΚΣΤΡΑΤΕΙΑΣ ΑΦΑΙΡΟΥΜΕΝΗ - αυτή η θέση πινάκων δεν επιλέγεται για αυτήν την εκστρατεία\n";}
	else
		{
		 if ( (strlen($campaign_id) < 2) or (strlen($status) < 1) )
			{
			 echo "<br>ΘΕΣΗ ΠΙΝΑΚΩΝ ΕΚΣΤΡΑΤΕΙΑΣ ΑΦΑΙΡΟΥΜΕΝΗ - Παρακαλώ επιστρέψτε πίσω και κάνετε έλεγχο των δεδομένων που καταχωρήσατε\n";
			 echo "<br>η κατάσταση πρέπει να είναι μεταξύ 1 και 6 χαρακτήρων στο μήκος\n";
			}
		 else
			{
			echo "<br><B>ΘΕΣΗ ΠΙΝΑΚΩΝ ΕΚΣΤΡΑΤΕΙΑΣ ΑΦΑΙΡΟΥΜΕΝΗ: $campaign_id - $status</B>\n";

			$stmt="SELECT dial_statuses from vicidial_campaigns where campaign_id='$campaign_id';";
			$rslt=mysql_query($stmt, $link);
			$row=mysql_fetch_row($rslt);

			$dial_statuses = eregi_replace(" $status "," ",$row[0]);
			$stmt="UPDATE vicidial_campaigns set dial_statuses='$dial_statuses' where campaign_id='$campaign_id';";
			$rslt=mysql_query($stmt, $link);

			### LOG CHANGES TO LOG FILE ###
			if ($WeBRooTWritablE > 0)
				{
				$fp = fopen ("./admin_changes_log.txt", "a");
				fwrite ($fp, "$date|DIAL STATUS REMOVED   |$PHP_AUTH_USER|$ip|$stmt|\n");
				fclose($fp);
				}
			}
		}
	}
	else
	{
	echo "Δεν έχετε την άδεια να δείτε αυτήν την σελίδα\n";
	exit;
	}
$ADD=31;	# go to campaign modification form below
}

######################
# ADD=611 delete list record and all leads within it
######################

if ($ADD==611)
{
	echo "<FONT FACE=\"ARIAL,HELVETICA\" COLOR=BLACK SIZE=2>";

	 if ( ( strlen($list_id) < 2) or ($CoNfIrM != 'YES') or ($LOGdelete_lists < 1) )
		{
		 echo "<br>ΛΙΣΤΑ ΔΕΝ ΔΙΑΓΡΑΦΗΚΕ - Παρακαλώ επιστρέψτε πίσω και κάνετε έλεγχο των δεδομένων που καταχωρήσατε\n";
		 echo "<br>List_id be at least 2 characters in length\n";
		}
	 else
		{
		$stmt="DELETE from vicidial_lists where list_id='$list_id' limit 1;";
		$rslt=mysql_query($stmt, $link);

		echo "<br>ΑΠΟΜΑΚΡΥΝΣΗ ΚΑΘΟΔΗΓΗΤΩΝ ΛΙΣΤΑΣ HOPPER ΑΠΟ ΠΑΛΑΙΑ HOPPER ΕΚΣΤΡΑΤΕΙΑ ($list_id)\n";
		$stmt="DELETE from vicidial_hopper where list_id='$list_id';";
		$rslt=mysql_query($stmt, $link);

		echo "<br>ΑΦΑΙΡΕΣΗ ΤΩΝ ΜΟΛΥΒΔΩΝ ΚΑΤΑΛΟΓΩΝ ΑΠΟ ΤΟΝ ΠΊΝΑΚΑ VICIDIAL_LIST\n";
		$stmt="DELETE from vicidial_list where list_id='$list_id';";
		$rslt=mysql_query($stmt, $link);

		### LOG CHANGES TO LOG FILE ###
		if ($WeBRooTWritablE > 0)
			{
			$fp = fopen ("./admin_changes_log.txt", "a");
			fwrite ($fp, "$date|!!!DELETING LIST!!!!|$PHP_AUTH_USER|$ip|list_id='$list_id'|\n");
			fclose($fp);
			}
		echo "<br><B>ΔΙΑΓΡΑΦΗ ΛΙΣΤΑΣ ΟΛΟΚΛΗΡΩΘΗΚΕ: $list_id</B>\n";
		echo "<br><br>\n";
		}

$ADD='100';		# go to lists list
}

######################
# ADD=6111 delete in-group record
######################

if ($ADD==6111)
{
	echo "<FONT FACE=\"ARIAL,HELVETICA\" COLOR=BLACK SIZE=2>";

	 if ( (strlen($group_id) < 2) or ($CoNfIrM != 'YES') or ($LOGdelete_ingroups < 1) )
		{
		 echo "<br>ΕΙΣ-ΟΜΑΔΑ ΔΕΝ ΔΙΑΓΡΑΦΗΚΕ - Παρακαλώ επιστρέψτε πίσω και κάνετε έλεγχο των δεδομένων που καταχωρήσατε\n";
		 echo "<br>Group_id be at least 2 characters in length\n";
		}
	 else
		{
		$stmt="DELETE from vicidial_inbound_groups where group_id='$group_id' limit 1;";
		$rslt=mysql_query($stmt, $link);

		### LOG CHANGES TO LOG FILE ###
		if ($WeBRooTWritablE > 0)
			{
			$fp = fopen ("./admin_changes_log.txt", "a");
			fwrite ($fp, "$date|!DELETING IN-GROUP!!|$PHP_AUTH_USER|$ip|group_id='$group_id'|\n");
			fclose($fp);
			}
		echo "<br><B>ΔΙΑΓΡΑΦΗ ΕΙΣ-ΟΜΑΔΑΣ ΟΛΟΚΛΗΡΩΘΗΚΕ: $group_id</B>\n";
		echo "<br><br>\n";
		}

$ADD='1000';		# go to in-group list
}

######################
# ADD=61111 delete remote agent record
######################

if ($ADD==61111)
{
	echo "<FONT FACE=\"ARIAL,HELVETICA\" COLOR=BLACK SIZE=2>";

	 if ( (strlen($remote_agent_id) < 1) or ($CoNfIrM != 'YES') or ($LOGdelete_remote_agents < 1) )
		{
		 echo "<br>ΑΠΟΜΑΚΡΥΣΜΕΝΟΣ ΧΕΙΡΙΣΤΗΣ ΔΕΝ ΔΙΑΓΡΑΦΗΚΕ - Παρακαλώ επιστρέψτε πίσω και κάνετε έλεγχο των δεδομένων που καταχωρήσατε\n";
		 echo "<br>Remote_agent_id be at least 2 characters in length\n";
		}
	 else
		{
		$stmt="DELETE from vicidial_remote_agents where remote_agent_id='$remote_agent_id' limit 1;";
		$rslt=mysql_query($stmt, $link);

		### LOG CHANGES TO LOG FILE ###
		if ($WeBRooTWritablE > 0)
			{
			$fp = fopen ("./admin_changes_log.txt", "a");
			fwrite ($fp, "$date|!DELETING RMTAGENT!!|$PHP_AUTH_USER|$ip|remote_agent_id='$remote_agent_id'|\n");
			fclose($fp);
			}
		echo "<br><B>ΔΙΑΓΡΑΦΗ ΑΠΟΜΑΚΡΥΣΜΕΝΩΝ ΧΕΙΡΙΣΤΩΝ ΟΛΟΚΛΗΡΩΘΗΚΕ: $remote_agent_id</B>\n";
		echo "<br><br>\n";
		}

$ADD='10000';		# go to remote agents list
}

######################
# ADD=611111 delete user group record
######################

if ($ADD==611111)
{
	echo "<FONT FACE=\"ARIAL,HELVETICA\" COLOR=BLACK SIZE=2>";

	 if ( (strlen($user_group) < 2) or ($CoNfIrM != 'YES') or ($LOGdelete_user_groups < 1) )
		{
		 echo "<br>ΟΜΑΔΑ ΧΡΗΣΤΗ ΔΕΝ ΔΙΑΓΡΑΦΗΚΕ - Παρακαλώ επιστρέψτε πίσω και κάνετε έλεγχο των δεδομένων που καταχωρήσατε\n";
		 echo "<br>User_group be at least 2 characters in length\n";
		}
	 else
		{
		$stmt="DELETE from vicidial_user_groups where user_group='$user_group' limit 1;";
		$rslt=mysql_query($stmt, $link);

		### LOG CHANGES TO LOG FILE ###
		if ($WeBRooTWritablE > 0)
			{
			$fp = fopen ("./admin_changes_log.txt", "a");
			fwrite ($fp, "$date|!DELETING USRGROUP!!|$PHP_AUTH_USER|$ip|user_group='$user_group'|\n");
			fclose($fp);
			}
		echo "<br><B>ΔΙΑΓΡΑΦΗ ΟΜΑΔΑΣ ΧΡΗΣΤΩΝ ΟΛΟΚΛΗΡΩΘΗΚΕ: $user_group</B>\n";
		echo "<br><br>\n";
		}

$ADD='100000';		# go to user group list
}

######################
# ADD=6111111 delete script record
######################

if ($ADD==6111111)
{
	echo "<FONT FACE=\"ARIAL,HELVETICA\" COLOR=BLACK SIZE=2>";

	 if ( (strlen($script_id) < 2) or ($CoNfIrM != 'YES') or ($LOGdelete_scripts < 1) )
		{
		 echo "<br>ΔΕΝ ΔΙΑΓΡΑΦΗΚΕ Ο ΒΟΗΘΟΣ - Παρακαλώ επιστρέψτε πίσω και κάνετε έλεγχο των δεδομένων που καταχωρήσατε\n";
		 echo "<br>Script_id be at least 2 characters in length\n";
		}
	 else
		{
		$stmt="DELETE from vicidial_scripts where script_id='$script_id' limit 1;";
		$rslt=mysql_query($stmt, $link);

		### LOG CHANGES TO LOG FILE ###
		if ($WeBRooTWritablE > 0)
			{
			$fp = fopen ("./admin_changes_log.txt", "a");
			fwrite ($fp, "$date|!DELETING SCRIPT!!!!|$PHP_AUTH_USER|$ip|script_id='$script_id'|\n");
			fclose($fp);
			}
		echo "<br><B>ΔΙΑΓΡΑΦΗ ΒΟΗΘΟΥ ΟΛΟΚΛΗΡΩΘΗΚΕ: $script_id</B>\n";
		echo "<br><br>\n";
		}

$ADD='1000000';		# go to script list
}


######################
# ADD=61111111 delete filter record
######################

if ($ADD==61111111)
{
	echo "<FONT FACE=\"ARIAL,HELVETICA\" COLOR=BLACK SIZE=2>";

	 if ( (strlen($lead_filter_id) < 2) or ($CoNfIrM != 'YES') or ($LOGdelete_filters < 1) )
		{
		 echo "<br>ΤΟ ΦΙΛΤΡΟ ΔΕΝ ΔΙΑΓΡΑΦΗΚΕ - Παρακαλώ επιστρέψτε πίσω και κάνετε έλεγχο των δεδομένων που καταχωρήσατε\n";
		 echo "<br>To ID φίλτρου πρέπει να είναι τουλάχιστον 2 χαρακτήρες\n";
		}
	 else
		{
		$stmt="DELETE from vicidial_lead_filters where lead_filter_id='$lead_filter_id' limit 1;";
		$rslt=mysql_query($stmt, $link);

		### LOG CHANGES TO LOG FILE ###
		if ($WeBRooTWritablE > 0)
			{
			$fp = fopen ("./admin_changes_log.txt", "a");
			fwrite ($fp, "$date|!DELETING FILTER!!!!|$PHP_AUTH_USER|$ip|lead_filter_id='$lead_filter_id'|\n");
			fclose($fp);
			}
		echo "<br><B>Η ΔΙΑΓΡΑΦΗ ΤΟΥ ΦΙΛΤΡΟΥ ΟΛΟΚΛΗΡΩΘΗΚΕ:  $lead_filter_id</B>\n";
		echo "<br><br>\n";
		}

$ADD='10000000';		# go to filter list
}


######################
# ADD=611111111 delete call times record
######################

if ($ADD==611111111)
{
	echo "<FONT FACE=\"ARIAL,HELVETICA\" COLOR=BLACK SIZE=2>";

	 if ( (strlen($call_time_id) < 2) or ($LOGdelete_call_times < 1) )
		{
		 echo "<br>Ο ΧΡΟΝΟΣ ΚΛΗΣΗΣ ΔΕΝ ΔΙΑΓΡΑΦΗΚΕ - Παρακαλώ επιστρέψτε πίσω και κάνετε έλεγχο των δεδομένων που καταχωρήσατε\n";
		 echo "<br>Το ID χρόνου κλήσης πρέπει να είναι τουλάχιστον 2 χαρακτήρες\n";
		}
	 else
		{
		$stmt="DELETE from vicidial_call_times where call_time_id='$call_time_id' limit 1;";
		$rslt=mysql_query($stmt, $link);

		### LOG CHANGES TO LOG FILE ###
		if ($WeBRooTWritablE > 0)
			{
			$fp = fopen ("./admin_changes_log.txt", "a");
			fwrite ($fp, "$date|!DELETING CALL TIME!|$PHP_AUTH_USER|$ip|call_time_id='$call_time_id'|\n");
			fclose($fp);
			}
		echo "<br><B>ΟΛΟΚΛΗΡΩΣΗ ΔΙΑΓΡΑΦΗΣ ΧΡΟΝΟΥ ΚΛΗΣΗΣ: $call_time_id</B>\n";
		echo "<br><br>\n";
		}

$ADD='100000000';		# go to call times list
}


######################
# ADD=6111111111 delete state call times record
######################

if ($ADD==6111111111)
{
	echo "<FONT FACE=\"ARIAL,HELVETICA\" COLOR=BLACK SIZE=2>";

	 if ( (strlen($call_time_id) < 2) or ($LOGdelete_call_times < 1) )
		{
		 echo "<br>Ο ΧΡΟΝΟΣ ΚΛΗΣΗΣ ΚΑΤΑΣΤΑΣΗΣΔΕΝ ΔΙΑΓΡΑΦΗΚΕ - Παρακαλώ επιστρέψτε πίσω και κάνετε έλεγχο των δεδομένων που καταχωρήσατε\n";
		 echo "<br>Το ID χρόνου κλήσης πρέπει να είναι τουλάχιστον 2 χαρακτήρες\n";
		}
	 else
		{
		$stmt="DELETE from vicidial_state_call_times where state_call_time_id='$call_time_id' limit 1;";
		$rslt=mysql_query($stmt, $link);

		$stmt="SELECT call_time_id,ct_state_call_times from vicidial_call_times where ct_state_call_times LIKE \"%|$call_time_id|%\" order by call_time_id;";
		$rslt=mysql_query($stmt, $link);
		$sct_to_print = mysql_num_rows($rslt);
		$sct_list='';

		$o=0;
		while ($sct_to_print > $o) {
			$rowx=mysql_fetch_row($rslt);
			$sct_ids[$o] = "$rowx[0]";
			$sct_states[$o] = "$rowx[1]";
			$o++;
		}
		$o=0;

		while ($sct_to_print > $o) {
			$sct_states[$o] = eregi_replace("\|$call_time_id\|",'|',$sct_states[$o]);
			$stmt="UPDATE vicidial_call_times set ct_state_call_times='$sct_states[$o]' where call_time_id='$sct_ids[$o]';";
			$rslt=mysql_query($stmt, $link);
			echo "$stmt\n";
			echo "Απομάκρυνση Κανόνα Κατάστασης: $sct_ids[$o]<BR>\n";
			$o++;
		}

		### LOG CHANGES TO LOG FILE ###
		if ($WeBRooTWritablE > 0)
			{
			$fp = fopen ("./admin_changes_log.txt", "a");
			fwrite ($fp, "$date|!DELETING CALL TIME!|$PHP_AUTH_USER|$ip|state_call_time_id='$call_time_id'|\n");
			fclose($fp);
			}
		echo "<br><B>ΟΛΟΚΛΗΡΩΣΗ ΔΙΑΓΡΑΦΗΣ ΧΡΟΝΟΥ ΚΛΗΣΗΣ ΚΑΤΑΣΤΑΣΗΣ: $call_time_id</B>\n";
		echo "<br><br>\n";
		}

$ADD='1000000000';		# go to call times list
}


######################
# ADD=61111111111 delete phone record
######################

if ($ADD==61111111111)
{
	echo "<FONT FACE=\"ARIAL,HELVETICA\" COLOR=BLACK SIZE=2>";

	 if ( (strlen($extension) < 2) or (strlen($server_ip) < 7) or ($CoNfIrM != 'YES') or ($LOGast_delete_phones < 1) )
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
$ADD='10000000000';		# go to phone list
}


######################
# ADD=611111111111 delete server record
######################

if ($ADD==611111111111)
{
	echo "<FONT FACE=\"ARIAL,HELVETICA\" COLOR=BLACK SIZE=2>";

	 if ( (strlen($server_id) < 2) or (strlen($server_ip) < 7) or ($CoNfIrM != 'YES') or ($LOGast_delete_phones < 1) )
		{
		 echo "<br>ΔΙΑΚΟΜΙΣΤΗΣ NOT DELETED - Παρακαλώ επιστρέψτε πίσω και κάνετε έλεγχο των δεδομένων που καταχωρήσατε\n";
		 echo "<br>ID Διακομιστή be at least 2 characters in length\n";
		 echo "<br>IP Διακομιστή be at least 7 characters in length\n";
		}
	 else
		{
		$stmt="DELETE from servers where server_id='$server_id' and server_ip='$server_ip' limit 1;";
		$rslt=mysql_query($stmt, $link);

		### LOG CHANGES TO LOG FILE ###
		if ($WeBRooTWritablE > 0)
			{
			$fp = fopen ("./admin_changes_log.txt", "a");
			fwrite ($fp, "$date|!!!DELETING SERVER!!|$PHP_AUTH_USER|$ip|server_id='$server_id'|server_ip='$server_ip'|\n");
			fclose($fp);
			}
		echo "<br><B>ΔΙΑΚΟΜΙΣΤΗΣ DELETION COMPLETED: $server_id - $server_ip</B>\n";
		echo "<br><br>\n";
		}
$ADD='100000000000';		# go to server list
}


######################
# ADD=621111111111 delete vicidial server trunk record in the system
######################

if ($ADD==621111111111)
{
	if ($LOGmodify_servers==1)
	{
	echo "<FONT FACE=\"ARIAL,HELVETICA\" COLOR=BLACK SIZE=2>";

	 if ( (strlen($campaign_id) < 2) or (strlen($server_ip) < 7) )
		{
		 echo "<br>Η ΕΓΓΡΑΦΗ ΤΟΥ ΚΟΡΜΟΥ ΣΤΟΝ ΕΞΥΠΗΡΕΤΗΤΗ ΔΕΝ ΔΙΑΓΡΑΦΗΚΕ - Παρακαλώ επιστρέψτε πίσω και κάνετε έλεγχο των δεδομένων που καταχωρήσατε\n";
		 echo "<br>η εκστρατεία πρέπει να είναι μεταξύ 3 και 8 χαρακτήρων στο μήκος\n";
		 echo "<br>η server_ip καθυστέρηση πρέπει να είναι τουλάχιστον 7 χαρακτήρες\n";
		}
	 else
		{
		echo "<br><B>Η ΕΓΓΡΑΦΗ ΤΟΥ ΚΟΡΜΟΥ ΣΤΟΝ ΕΞΥΠΗΡΕΤΗΤΗ ΔΙΑΓΡΑΦΗΚΕ: $campaign_id - $server_ip</B>\n";

		$stmt="DELETE FROM vicidial_server_trunks where campaign_id='$campaign_id' and server_ip='$server_ip';";
		$rslt=mysql_query($stmt, $link);

		### LOG CHANGES TO LOG FILE ###
		if ($WeBRooTWritablE > 0)
			{
			$fp = fopen ("./admin_changes_log.txt", "a");
			fwrite ($fp, "$date|DELETE ΔΙΑΚΟΜΙΣΤΗΣ TRUNK   |$PHP_AUTH_USER|$ip|$stmt|\n");
			fclose($fp);
			}
		}
	}
	else
	{
	echo "Δεν έχετε την άδεια να δείτε αυτήν την σελίδα\n";
	exit;
	}
$ADD=311111111111;	# go to server modification form below
}


######################
# ADD=6111111111111 delete conference record
######################

if ($ADD==6111111111111)
{
	echo "<FONT FACE=\"ARIAL,HELVETICA\" COLOR=BLACK SIZE=2>";

	 if ( (strlen($conf_exten) < 2) or (strlen($server_ip) < 7) or ($CoNfIrM != 'YES') or ($LOGast_delete_phones < 1) )
		{
		 echo "<br>CONFERENCE NOT DELETED - Παρακαλώ επιστρέψτε πίσω και κάνετε έλεγχο των δεδομένων που καταχωρήσατε\n";
		 echo "<br>Conference be at least 2 characters in length\n";
		 echo "<br>IP Διακομιστή be at least 7 characters in length\n";
		}
	 else
		{
		$stmt="DELETE from conferences where conf_exten='$conf_exten' and server_ip='$server_ip' limit 1;";
		$rslt=mysql_query($stmt, $link);

		### LOG CHANGES TO LOG FILE ###
		if ($WeBRooTWritablE > 0)
			{
			$fp = fopen ("./admin_changes_log.txt", "a");
			fwrite ($fp, "$date|!!!DELETING CONF!!!!|$PHP_AUTH_USER|$ip|conf_exten='$conf_exten'|server_ip='$server_ip'|\n");
			fclose($fp);
			}
		echo "<br><B>CONFERENCE DELETION COMPLETED: $conf_exten - $server_ip</B>\n";
		echo "<br><br>\n";
		}
$ADD='1000000000000';		# go to conference list
}


######################
# ADD=61111111111111 delete vicidial conference record
######################

if ($ADD==61111111111111)
{
	echo "<FONT FACE=\"ARIAL,HELVETICA\" COLOR=BLACK SIZE=2>";

	 if ( (strlen($conf_exten) < 2) or (strlen($server_ip) < 7) or ($CoNfIrM != 'YES') or ($LOGast_delete_phones < 1) )
		{
		 echo "<br>VICIDIAL CONFERENCE NOT DELETED - Παρακαλώ επιστρέψτε πίσω και κάνετε έλεγχο των δεδομένων που καταχωρήσατε\n";
		 echo "<br>Conference be at least 2 characters in length\n";
		 echo "<br>IP Διακομιστή be at least 7 characters in length\n";
		}
	 else
		{
		$stmt="DELETE from vicidial_conferences where conf_exten='$conf_exten' and server_ip='$server_ip' limit 1;";
		$rslt=mysql_query($stmt, $link);

		### LOG CHANGES TO LOG FILE ###
		if ($WeBRooTWritablE > 0)
			{
			$fp = fopen ("./admin_changes_log.txt", "a");
			fwrite ($fp, "$date|!!!DELETING CONF!!!!|$PHP_AUTH_USER|$ip|conf_exten='$conf_exten'|server_ip='$server_ip'|\n");
			fclose($fp);
			}
		echo "<br><B>VICIDIAL CONFERENCE DELETION COMPLETED: $conf_exten - $server_ip</B>\n";
		echo "<br><br>\n";
		}
$ADD='10000000000000';		# go to vicidial conference list
}





######################################################################################################
######################################################################################################
#######   3 series, record modification forms
######################################################################################################
######################################################################################################




######################
# ADD=3 modify user info in the system
######################

if ($ADD==3)
{
	if ($LOGmodify_users==1)
	{
	echo "<TABLE><TR><TD>\n";
	echo "<FONT FACE=\"ARIAL,HELVETICA\" COLOR=BLACK SIZE=2>";

	$stmt="SELECT * from vicidial_users where user='$user';";
	$rslt=mysql_query($stmt, $link);
	$row=mysql_fetch_row($rslt);
	$user_level =			$row[4];
	$user_group =			$row[5];
	$phone_login =			$row[6];
	$phone_pass =			$row[7];
	$delete_users =			$row[8];
	$delete_user_groups =	$row[9];
	$delete_lists =			$row[10];
	$delete_campaigns =		$row[11];
	$delete_ingroups =		$row[12];
	$delete_remote_agents =	$row[13];
	$load_leads =			$row[14];
	$campaign_detail =		$row[15];
	$ast_admin_access =		$row[16];
	$ast_delete_phones =	$row[17];
	$delete_scripts =		$row[18];
	$modify_leads =			$row[19];
	$hotkeys_active =		$row[20];
	$change_agent_campaign =$row[21];
	$agent_choose_ingroups =$row[22];
	$scheduled_callbacks =	$row[24];
	$agentonly_callbacks =	$row[25];
	$agentcall_manual =		$row[26];
	$vicidial_recording =	$row[27];
	$vicidial_transfers =	$row[28];
	$delete_filters =		$row[29];
	$alter_agent_interface_options =$row[30];
	$closer_default_blended =		$row[31];
	$delete_call_times =	$row[32];
	$modify_call_times =	$row[33];
	$modify_users =			$row[34];
	$modify_campaigns =		$row[35];
	$modify_lists =			$row[36];
	$modify_scripts =		$row[37];
	$modify_filters =		$row[38];
	$modify_ingroups =		$row[39];
	$modify_usergroups =	$row[40];
	$modify_remoteagents =	$row[41];
	$modify_servers =		$row[42];
	$view_reports =			$row[43];
	$vicidial_recording_override =	$row[44];
	$alter_custdata_override = $row[45];

	if ( ($user_level >= $LOGuser_level) and ($LOGuser_level < 9) )
		{
		echo "<br>Δεν έχετε τις άδειες να τροποποιήσετε αυτόν τον χρήστη: $row[1]\n";
		}
	else
		{
		echo "<br>ΤΡΟΠΟΠΟΙΗΣΗ ΕΓΓΡΑΦΗΣ ΧΡΗΣΤΩΝ: $row[1]<form action=$PHP_SELF method=POST>\n";
		if ($LOGuser_level > 8)
			{echo "<input type=hidden name=ADD value=4A>\n";}
		else
			{
			if ($LOGalter_agent_interface == "1")
				{echo "<input type=hidden name=ADD value=4B>\n";}
			else
				{echo "<input type=hidden name=ADD value=4>\n";}
			}
		echo "<input type=hidden name=user value=\"$row[1]\">\n";
		echo "<center><TABLE width=$section_width cellspacing=3>\n";
		echo "<tr bgcolor=#B6D3FC><td align=right>Αριθμός Χρήστη: </td><td align=left><b>$row[1]</b>$NWB#vicidial_users-user$NWE</td></tr>\n";
		echo "<tr bgcolor=#B6D3FC><td align=right>Κωδικός:</td><td align=left><input type=text name=pass size=20 maxlength=10 value=\"$row[2]\">$NWB#vicidial_users-pass$NWE</td></tr>\n";
		echo "<tr bgcolor=#B6D3FC><td align=right>Πλήρες Ονομα: </td><td align=left><input type=text name=full_name size=30 maxlength=30 value=\"$row[3]\">$NWB#vicidial_users-full_name$NWE</td></tr>\n";
		echo "<tr bgcolor=#B6D3FC><td align=right>Επίπεδο Χρήστη: </td><td align=left><select size=1 name=user_level>";
		$h=1;
		while ($h<=$LOGuser_level)
			{
			echo "<option>$h</option>";
			$h++;
			}
		echo "<option SELECTED>$row[4]</option></select>$NWB#vicidial_users-user_level$NWE</td></tr>\n";
		echo "<tr bgcolor=#B6D3FC><td align=right><A HREF=\"$PHP_SELF?ADD=311111&user_group=$user_group\">Ομάδα Χρήστη</A>: </td><td align=left><select size=1 name=user_group>\n";

			$stmt="SELECT user_group,group_name from vicidial_user_groups order by user_group";
			$rslt=mysql_query($stmt, $link);
			$Ugroups_to_print = mysql_num_rows($rslt);
			$Ugroups_list='';

			$o=0;
			while ($Ugroups_to_print > $o) {
				$rowx=mysql_fetch_row($rslt);
				$Ugroups_list .= "<option value=\"$rowx[0]\">$rowx[0] - $rowx[1]</option>\n";
				$o++;
			}
		echo "$Ugroups_list";
		echo "<option SELECTED>$user_group</option>\n";
		echo "</select>$NWB#vicidial_users-user_group$NWE</td></tr>\n";
		echo "<tr bgcolor=#B6D3FC><td align=right>Τηλέφωνο Σύνδεσης: </td><td align=left><input type=text name=phone_login size=20 maxlength=20 value=\"$phone_login\">$NWB#vicidial_users-phone_login$NWE</td></tr>\n";
		echo "<tr bgcolor=#B6D3FC><td align=right>Κωδικός Πρόσβασης Τηλεφώνου: </td><td align=left><input type=text name=phone_pass size=20 maxlength=20 value=\"$phone_pass\">$NWB#vicidial_users-phone_pass$NWE</td></tr>\n";

		if ( ($LOGuser_level > 8) or ($LOGalter_agent_interface == "1") )
			{
			echo "<tr bgcolor=#015B91><td colspan=2 align=center><font color=white><B>ΕΠΙΛΟΓΕΣ ΕΠΙΦΑΝΕΙΑΣ ΕΡΓΑΣΙΑΣ ΧΕΙΡΙΣΤΩΝ:</td></tr>\n";
			echo "<tr bgcolor=#B6D3FC><td align=right>Ο χειριστής επιλέγει Εισ.Ομάδες: </td><td align=left><select size=1 name=agent_choose_ingroups><option>0</option><option>1</option><option SELECTED>$agent_choose_ingroups</option></select>$NWB#vicidial_users-agent_choose_ingroups$NWE</td></tr>\n";
			echo "<tr bgcolor=#B6D3FC><td align=right>Ενεργά Κλειδιά: </td><td align=left><select size=1 name=hotkeys_active><option>0</option><option>1</option><option SELECTED>$hotkeys_active</option></select>$NWB#vicidial_users-hotkeys_active$NWE</td></tr>\n";
			echo "<tr bgcolor=#B6D3FC><td align=right>Προγραμματισμένες Επανακλήσεις: </td><td align=left><select size=1 name=scheduled_callbacks><option>0</option><option>1</option><option SELECTED>$scheduled_callbacks</option></select>$NWB#vicidial_users-scheduled_callbacks$NWE</td></tr>\n";
			echo "<tr bgcolor=#B6D3FC><td align=right>Μόνο του Χειριστή Επανακλήσεις: </td><td align=left><select size=1 name=agentonly_callbacks><option>0</option><option>1</option><option SELECTED>$agentonly_callbacks</option></select>$NWB#vicidial_users-agentonly_callbacks$NWE</td></tr>\n";
			echo "<tr bgcolor=#B6D3FC><td align=right>Εγχειρίδιο κλήσεων Χειριστή: </td><td align=left><select size=1 name=agentcall_manual><option>0</option><option>1</option><option SELECTED>$agentcall_manual</option></select>$NWB#vicidial_users-agentcall_manual$NWE</td></tr>\n";
			echo "<tr bgcolor=#B6D3FC><td align=right>Καταγραφή: </td><td align=left><select size=1 name=vicidial_recording><option>0</option><option>1</option><option SELECTED>$vicidial_recording</option></select>$NWB#vicidial_users-vicidial_recording$NWE</td></tr>\n";
			echo "<tr bgcolor=#B6D3FC><td align=right>Μεταφορές: </td><td align=left><select size=1 name=vicidial_transfers><option>0</option><option>1</option><option SELECTED>$vicidial_transfers</option></select>$NWB#vicidial_users-vicidial_transfers$NWE</td></tr>\n";
			echo "<tr bgcolor=#B6D3FC><td align=right>Η πιό στενή προεπιλογή συνδύασε: </td><td align=left><select size=1 name=closer_default_blended><option>0</option><option>1</option><option SELECTED>$closer_default_blended</option></select>$NWB#vicidial_users-closer_default_blended$NWE</td></tr>\n";
			echo "<tr bgcolor=#B6D3FC><td align=right>VICIDIAL συμπληρωματική προμήθεια καταγραφής: </td><td align=left><select size=1 name=vicidial_recording_override><option>DISABLED</option><option>NEVER</option><option>ONDEMAND</option><option>ALLCALLS</option><option>ALLFORCE</option><option SELECTED>$vicidial_recording_override</option></select>$NWB#vicidial_users-vicidial_recording_override$NWE</td></tr>\n";
			echo "<tr bgcolor=#B6D3FC><td align=right>Ο πράκτορας αλλάζει τη συμπληρωματική προμήθεια στοιχείωνπελατών: </td><td align=left><select size=1 name=alter_custdata_override><option>NOT_ACTIVE</option><option>ALLOW_ALTER</option><option SELECTED>$alter_custdata_override</option></select>$NWB#vicidial_users-alter_custdata_override$NWE</td></tr>\n";
			echo "<tr bgcolor=#B6D3FC><td align=right>Εισερχόμενες Ομάδες: </td><td align=left>\n";
			echo "$groups_list";
			echo "$NWB#vicidial_users-closer_campaigns$NWE</td></tr>\n";
			}
		if ($LOGuser_level > 8)
			{
			echo "<tr bgcolor=#015B91><td colspan=2 align=center><font color=white><B>ΕΠΙΛΟΓΈΣ ΕΠΙΦΑΝΕΙΑΣ ΕΡΓΑΣΙΑΣ ΔΙΑΧ:</td></tr>\n";
			echo "<tr bgcolor=#B6D3FC><td align=right>Αλλάξτε τις επιλογές επιφάνειας εργασίας των χειριστών: </td><td align=left><select size=1 name=alter_agent_interface_options><option>0</option><option>1</option><option SELECTED>$alter_agent_interface_options</option></select>$NWB#vicidial_users-alter_agent_interface_options$NWE</td></tr>\n";
			echo "<tr bgcolor=#B6D3FC><td align=right>Διάγραψε  τους χρήστες: </td><td align=left><select size=1 name=delete_users><option>0</option><option>1</option><option SELECTED>$delete_users</option></select>$NWB#vicidial_users-delete_users$NWE</td></tr>\n";
			echo "<tr bgcolor=#B6D3FC><td align=right>Διάγραψε τις ομάδες χρηστών: </td><td align=left><select size=1 name=delete_user_groups><option>0</option><option>1</option><option SELECTED>$delete_user_groups</option></select>$NWB#vicidial_users-delete_user_groups$NWE</td></tr>\n";
			echo "<tr bgcolor=#B6D3FC><td align=right>Διάγραψε τις Λίστες: </td><td align=left><select size=1 name=delete_lists><option>0</option><option>1</option><option SELECTED>$delete_lists</option></select>$NWB#vicidial_users-delete_lists$NWE</td></tr>\n";
			echo "<tr bgcolor=#B6D3FC><td align=right>Διάγραψε τις εκστρατείες: </td><td align=left><select size=1 name=delete_campaigns><option>0</option><option>1</option><option SELECTED>$delete_campaigns</option></select>$NWB#vicidial_users-delete_campaigns$NWE</td></tr>\n";
			echo "<tr bgcolor=#B6D3FC><td align=right>Διάγραψε τις Εισ-ΟΜΑΔΕΣ: </td><td align=left><select size=1 name=delete_ingroups><option>0</option><option>1</option><option SELECTED>$delete_ingroups</option></select>$NWB#vicidial_users-delete_ingroups$NWE</td></tr>\n";
			echo "<tr bgcolor=#B6D3FC><td align=right>Διάγραψε τους Απομακρυσμένους Χειριστές: </td><td align=left><select size=1 name=delete_remote_agents><option>0</option><option>1</option><option SELECTED>$delete_remote_agents</option></select>$NWB#vicidial_users-delete_remote_agents$NWE</td></tr>\n";
			echo "<tr bgcolor=#B6D3FC><td align=right>Διάγραψε τον Βοηθόs: </td><td align=left><select size=1 name=delete_scripts><option>0</option><option>1</option><option SELECTED>$delete_scripts</option></select>$NWB#vicidial_users-delete_scripts$NWE</td></tr>\n";
			echo "<tr bgcolor=#B6D3FC><td align=right>Εισαγωγή Οδηγών: </td><td align=left><select size=1 name=load_leads><option>0</option><option>1</option><option SELECTED>$load_leads</option></select>$NWB#vicidial_users-load_leads$NWE</td></tr>\n";
			echo "<tr bgcolor=#B6D3FC><td align=right>Λεπτομέρειες εκστρατείας: </td><td align=left><select size=1 name=campaign_detail><option>0</option><option>1</option><option SELECTED>$campaign_detail</option></select>$NWB#vicidial_users-campaign_detail$NWE</td></tr>\n";
			echo "<tr bgcolor=#B6D3FC><td align=right>Πρόσβαση AGC Admin: </td><td align=left><select size=1 name=ast_admin_access><option>0</option><option>1</option><option SELECTED>$ast_admin_access</option></select>$NWB#vicidial_users-ast_admin_access$NWE</td></tr>\n";
			echo "<tr bgcolor=#B6D3FC><td align=right>Το AGC διαγράφει τα τηλέφωνα: </td><td align=left><select size=1 name=ast_delete_phones><option>0</option><option>1</option><option SELECTED>$ast_delete_phones</option></select>$NWB#vicidial_users-ast_delete_phones$NWE</td></tr>\n";
			echo "<tr bgcolor=#B6D3FC><td align=right>Τροποποίηση Οδηγών: </td><td align=left><select size=1 name=modify_leads><option>0</option><option>1</option><option SELECTED>$modify_leads</option></select>$NWB#vicidial_users-modify_leads$NWE</td></tr>\n";
			echo "<tr bgcolor=#B6D3FC><td align=right>Αλλαγή Εκστρατείας Χειριστή: </td><td align=left><select size=1 name=change_agent_campaign><option>0</option><option>1</option><option SELECTED>$change_agent_campaign</option></select>$NWB#vicidial_users-change_agent_campaign$NWE</td></tr>\n";
			echo "<tr bgcolor=#B6D3FC><td align=right>Διαγραφή Φίλτρουs: </td><td align=left><select size=1 name=delete_filters><option>0</option><option>1</option><option SELECTED>$delete_filters</option></select>$NWB#vicidial_users-delete_filters$NWE</td></tr>\n";
			echo "<tr bgcolor=#B6D3FC><td align=right>Διαγραφή Χρόνου Κλήσηςs: </td><td align=left><select size=1 name=delete_call_times><option>0</option><option>1</option><option SELECTED>$delete_call_times</option></select>$NWB#vicidial_users-delete_call_times$NWE</td></tr>\n";
			echo "<tr bgcolor=#B6D3FC><td align=right>Τροποποίηση Χρόνου Κλήσηςs: </td><td align=left><select size=1 name=modify_call_times><option>0</option><option>1</option><option SELECTED>$modify_call_times</option></select>$NWB#vicidial_users-modify_call_times$NWE</td></tr>\n";
			echo "<tr bgcolor=#B6D3FC><td align=right>Τροποποιήστε τους χρήστες: </td><td align=left><select size=1 name=modify_users><option>0</option><option>1</option><option SELECTED>$modify_users</option></select>$NWB#vicidial_users-modify_sections$NWE</td></tr>\n";
			echo "<tr bgcolor=#B6D3FC><td align=right>Τροποποιήστε τις εκστρατείες: </td><td align=left><select size=1 name=modify_campaigns><option>0</option><option>1</option><option SELECTED>$modify_campaigns</option></select>$NWB#vicidial_users-modify_sections$NWE</td></tr>\n";
			echo "<tr bgcolor=#B6D3FC><td align=right>Τροποποιήστε τους καταλόγους: </td><td align=left><select size=1 name=modify_lists><option>0</option><option>1</option><option SELECTED>$modify_lists</option></select>$NWB#vicidial_users-modify_sections$NWE</td></tr>\n";
			echo "<tr bgcolor=#B6D3FC><td align=right>Τροποποιήστε τα χειρόγραφα: </td><td align=left><select size=1 name=modify_scripts><option>0</option><option>1</option><option SELECTED>$modify_scripts</option></select>$NWB#vicidial_users-modify_sections$NWE</td></tr>\n";
			echo "<tr bgcolor=#B6D3FC><td align=right>Τροποποιήστε τα φίλτρα: </td><td align=left><select size=1 name=modify_filters><option>0</option><option>1</option><option SELECTED>$modify_filters</option></select>$NWB#vicidial_users-modify_sections$NWE</td></tr>\n";
			echo "<tr bgcolor=#B6D3FC><td align=right>Τροποποιήστε τις-ΟΜΑΔΕΣ: </td><td align=left><select size=1 name=modify_ingroups><option>0</option><option>1</option><option SELECTED>$modify_ingroups</option></select>$NWB#vicidial_users-modify_sections$NWE</td></tr>\n";
			echo "<tr bgcolor=#B6D3FC><td align=right>Τροποποιήστε τις ομάδες χρηστών: </td><td align=left><select size=1 name=modify_usergroups><option>0</option><option>1</option><option SELECTED>$modify_usergroups</option></select>$NWB#vicidial_users-modify_sections$NWE</td></tr>\n";
			echo "<tr bgcolor=#B6D3FC><td align=right>Τροποποιήστε τους μακρινούς πράκτορες: </td><td align=left><select size=1 name=modify_remoteagents><option>0</option><option>1</option><option SELECTED>$modify_remoteagents</option></select>$NWB#vicidial_users-modify_sections$NWE</td></tr>\n";
			echo "<tr bgcolor=#B6D3FC><td align=right>Τροποποιήστε τους κεντρικούς υπολογιστές: </td><td align=left><select size=1 name=modify_servers><option>0</option><option>1</option><option SELECTED>$modify_servers</option></select>$NWB#vicidial_users-modify_sections$NWE</td></tr>\n";
			echo "<tr bgcolor=#B6D3FC><td align=right>Εκθέσεις άποψης: </td><td align=left><select size=1 name=view_reports><option>0</option><option>1</option><option SELECTED>$view_reports</option></select>$NWB#vicidial_users-view_reports$NWE</td></tr>\n";
			}
		echo "<tr bgcolor=#B6D3FC><td align=center colspan=2><input type=submit name=ΕΠΙΒΕΒΑΙΩΣΗ value=ΕΠΙΒΕΒΑΙΩΣΗ></td></tr>\n";
		echo "</TABLE></center>\n";

		if ($LOGdelete_users > 0)
			{
			echo "<br><br><a href=\"$PHP_SELF?ADD=5&user=$row[1]\">ΔΙΑΓΡΑΨΕ ΑΥΤΟΝ ΤΟΝ ΧΡΗΣΤΗ</a>\n";
			}
		echo "<br><br><a href=\"./AST_agent_time_sheet.php?agent=$row[1]\">Επιλέξτε εδώ για την σελίδα με τους χρόνους χρήσης</a>\n";
		echo "<br><br><a href=\"./user_status.php?user=$row[1]\">Επιλέξτε εδώ για τη κατάσταση του χρήστη</a>\n";
		echo "<br><br><a href=\"./user_stats.php?user=$row[1]\">Πατήστε εδώ για στατιστικά χρήστη</a>\n";
		echo "<br><br><a href=\"$PHP_SELF?ADD=8&user=$row[1]\">Επιλέξτε εδώ για τις Επανακλήσεις του χρήστη που κρατήθηκαν</a>\n";
		}
	}
	else
	{
	echo "Δεν έχετε την άδεια να δείτε αυτήν την σελίδα\n";
	exit;
	}
}


######################
# ADD=31 modify campaign info in the system - Detail view
######################

if ( ($LOGcampaign_detail < 1) and ($ADD==31) ) {$ADD=34;}	# send to Basic if not allowed

if ( ($ADD==31) and ( (!eregi("$campaign_id",$LOGallowed_campaigns)) and (!eregi("ALL-CAMPAIGNS",$LOGallowed_campaigns)) ) ) 
	{$ADD=30;}	# send to not allowed screen if not in vicidial_user_groups allowed_campaigns list

if ($ADD==31)
{
	if ($LOGmodify_users==1)
	{
		if ($stage=='show_dialable')
		{
			$stmt="UPDATE vicidial_campaigns set display_dialable_count='Y' where campaign_id='$campaign_id';";
			$rslt=mysql_query($stmt, $link);
		}
		if ($stage=='hide_dialable')
		{
			$stmt="UPDATE vicidial_campaigns set display_dialable_count='N' where campaign_id='$campaign_id';";
			$rslt=mysql_query($stmt, $link);
		}
		echo "<TABLE><TR><TD>\n";
		echo "<FONT FACE=\"ARIAL,HELVETICA\" COLOR=BLACK SIZE=2>";

		$stmt="SELECT * from vicidial_campaigns where campaign_id='$campaign_id';";
		$rslt=mysql_query($stmt, $link);
		$row=mysql_fetch_row($rslt);
		$campaign_name = $row[1];
		$dial_status_a = $row[3];
		$dial_status_b = $row[4];
		$dial_status_c = $row[5];
		$dial_status_d = $row[6];
		$dial_status_e = $row[7];
		$lead_order = $row[8];
		$hopper_level = $row[13];
		$auto_dial_level = $row[14];
		$next_agent_call = $row[15];
		$local_call_time = $row[16];
		$voicemail_ext = $row[17];
		$dial_timeout = $row[18];
		$dial_prefix = $row[19];
		$campaign_cid = $row[20];
		$campaign_vdad_exten = $row[21];
		$campaign_rec_exten = $row[22];
		$campaign_recording = $row[23];
		$campaign_rec_filename = $row[24];
		$script_id = $row[25];
		$get_call_launch = $row[26];
		$am_message_exten = $row[27];
		$amd_send_to_vmx = $row[28];
		$xferconf_a_dtmf = $row[29];
		$xferconf_a_number = $row[30];
		$xferconf_b_dtmf = $row[31];
		$xferconf_b_number = $row[32];
		$alt_number_dialing = $row[33];
		$scheduled_callbacks = $row[34];
		$lead_filter_id = $row[35];
			if ($lead_filter_id=='') {$lead_filter_id='NONE';}
		$drop_call_seconds = $row[36];
		$safe_harbor_message = $row[37];
		$safe_harbor_exten = $row[38];
		$display_dialable_count = $row[39];
		$wrapup_seconds = $row[40];
		$wrapup_message = $row[41];
	#	$closer_campaigns = $row[42];
		$use_internal_dnc = $row[43];
		$allcalls_delay = $row[44];
		$omit_phone_code = $row[45];
		$dial_method = $row[46];
		$available_only_ratio_tally = $row[47];
		$adaptive_dropped_percentage = $row[48];
		$adaptive_maximum_level = $row[49];
		$adaptive_latest_server_time = $row[50];
		$adaptive_intensity = $row[51];
		$adaptive_dl_diff_target = $row[52];
		$concurrent_transfers = $row[53];
		$auto_alt_dial = $row[54];
		$auto_alt_dial_statuses = $row[55];
		$agent_pause_codes_active = $row[56];
		$campaign_description = $row[57];
		$campaign_changedate = $row[58];
		$campaign_stats_refresh = $row[59];
		$campaign_logindate = $row[60];
		$dial_statuses = $row[61];
		$disable_alter_custdata = $row[62];
		$no_hopper_leads_logins = $row[63];

	echo "<br>ΤΡΟΠΟΠΟΙΗΣΗ ΕΓΓΡΑΦΗΣ ΕΚΣΤΡΑΤΕΙΩΝ: $row[0] - <a href=\"$PHP_SELF?ADD=34&campaign_id=$campaign_id\">Βασική Επισκόπηση</a>";
	echo " | Αναλυτική Επισκόπηση</a> | ";
	echo "<a href=\"./AST_timeonVDADall.php?RR=4&DB=0&group=$row[0]\">Πραγματικού Χρόνου Οθόνη</a>\n";
	echo "<form action=$PHP_SELF method=POST>\n";
	echo "<input type=hidden name=ADD value=41>\n";
	echo "<input type=hidden name=campaign_id value=\"$campaign_id\">\n";
	echo "<center><TABLE width=$section_width cellspacing=3>\n";
	echo "<tr bgcolor=#B6D3FC><td align=right>ID Εκστρατείας: </td><td align=left><b>$row[0]</b>$NWB#vicidial_campaigns-campaign_id$NWE</td></tr>\n";
	echo "<tr bgcolor=#B6D3FC><td align=right>Ονομα Εκστρατείας: </td><td align=left><input type=text name=campaign_name size=40 maxlength=40 value=\"$campaign_name\">$NWB#vicidial_campaigns-campaign_name$NWE</td></tr>\n";
	echo "<tr bgcolor=#B6D3FC><td align=right>Περιγραφή εκστρατείας: </td><td align=left><input type=text name=campaign_description size=40 maxlength=255 value=\"$campaign_description\">$NWB#vicidial_campaigns-campaign_description$NWE</td></tr>\n";
	echo "<tr bgcolor=#B6D3FC><td align=right>Εκστρατεία Change Date: </td><td align=left>$campaign_changedate &nbsp; $NWB#vicidial_campaigns-campaign_changedate$NWE</td></tr>\n";
	echo "<tr bgcolor=#B6D3FC><td align=right>Εκστρατεία Login Date: </td><td align=left>$campaign_logindate &nbsp; $NWB#vicidial_campaigns-campaign_logindate$NWE</td></tr>\n";
	echo "<tr bgcolor=#B6D3FC><td align=right>Ενεργή:</td><td align=left><select size=1 name=active><option>Y</option><option>N</option><option SELECTED>$row[2]</option></select>$NWB#vicidial_campaigns-active$NWE</td></tr>\n";
	echo "<tr bgcolor=#B6D3FC><td align=right>Τηλ.σύνδ. Στάθμευσης: </td><td align=left><input type=text name=park_ext size=10 maxlength=10 value=\"$row[9]\"> - Filename: <input type=text name=park_file_name size=10 maxlength=10 value=\"$row[10]\">$NWB#vicidial_campaigns-park_ext$NWE</td></tr>\n";
	echo "<tr bgcolor=#B6D3FC><td align=right>Ιστο-σελίδα: </td><td align=left><input type=text name=web_form_address size=50 maxlength=255 value=\"$row[11]\">$NWB#vicidial_campaigns-web_form_address$NWE</td></tr>\n";
	echo "<tr bgcolor=#B6D3FC><td align=right>Επιτρέπω τους Closers: </td><td align=left><select size=1 name=allow_closers><option>Y</option><option>N</option><option SELECTED>$row[12]</option></select>$NWB#vicidial_campaigns-allow_closers$NWE</td></tr>\n";

	$stmt="SELECT * from vicidial_statuses order by status";
	$rslt=mysql_query($stmt, $link);
	$statuses_to_print = mysql_num_rows($rslt);
	$statuses_list='';

	$o=0;
	while ($statuses_to_print > $o) 
		{
		$rowx=mysql_fetch_row($rslt);
		$statuses_list .= "<option value=\"$rowx[0]\">$rowx[0] - $rowx[1]</option>\n";
		$statname_list["$rowx[0]"] = "$rowx[1]";
		$LRstatuses_list .= "<option value=\"$rowx[0]-----$rowx[1]\">$rowx[0] - $rowx[1]</option>\n";
		if (eregi("Y",$rowx[2]))
			{$HKstatuses_list .= "<option value=\"$rowx[0]-----$rowx[1]\">$rowx[0] - $rowx[1]</option>\n";}
		$o++;
		}

	$stmt="SELECT * from vicidial_campaign_statuses where campaign_id='$campaign_id' order by status";
	$rslt=mysql_query($stmt, $link);
	$Cstatuses_to_print = mysql_num_rows($rslt);

	$o=0;
	while ($Cstatuses_to_print > $o) 
		{
		$rowx=mysql_fetch_row($rslt);
		$statuses_list .= "<option value=\"$rowx[0]\">$rowx[0] - $rowx[1]</option>\n";
		$statname_list["$rowx[0]"] = "$rowx[1]";
		$LRstatuses_list .= "<option value=\"$rowx[0]-----$rowx[1]\">$rowx[0] - $rowx[1]</option>\n";
		if (eregi("Y",$rowx[2]))
			{$HKstatuses_list .= "<option value=\"$rowx[0]-----$rowx[1]\">$rowx[0] - $rowx[1]</option>\n";}
		$o++;
		}

	$dial_statuses = preg_replace("/ -$/","",$dial_statuses);
	$Dstatuses = explode(" ", $dial_statuses);
	$Ds_to_print = (count($Dstatuses) -1);

	$o=0;
	while ($Ds_to_print > $o) 
		{
		$o++;
		$Dstatus = $Dstatuses[$o];

		echo "<tr bgcolor=#B6D3FC><td align=right>Θέση πινάκων$o: </td><td align=left> \n";
		echo "<b>$Dstatus</b> - $statname_list[$Dstatus] &nbsp; &nbsp; &nbsp; &nbsp; <font size=2>\n";
		echo "<a href=\"$PHP_SELF?ADD=68&campaign_id=$campaign_id&status=$Dstatuses[$o]\">ΑΦΑΙΡΕΣΤΕ</a></td></tr>\n";
		}

	echo "<tr bgcolor=#B6D3FC><td align=right>Add A Dial Κατάσταση:</td><td align=left><select size=1 name=dial_status>\n";
	echo "<option value=\"\"> - NONE - </option>\n";

	echo "$statuses_list";
	echo "</select> &nbsp; \n";
	echo "<input type=submit name=submit value=ΠΡΟΣΘΗΚΗ> &nbsp; &nbsp; $NWB#vicidial_campaigns-dial_status$NWE</td></tr>\n";

	echo "<tr bgcolor=#B6D3FC><td align=right>Σειρά Λίστας: </td><td align=left><select size=1 name=lead_order><option>DOWN</option><option>UP</option><option>UP PHONE</option><option>DOWN PHONE</option><option>UP LAST NAME</option><option>DOWN LAST NAME</option><option>UP COUNT</option><option>DOWN COUNT</option><option>DOWN COUNT 2nd NEW</option><option>DOWN COUNT 3rd NEW</option><option>DOWN COUNT 4th NEW</option><option SELECTED>$lead_order</option></select>$NWB#vicidial_campaigns-lead_order$NWE</td></tr>\n";

	echo "<tr bgcolor=#B6D3FC><td align=right><a href=\"$PHP_SELF?ADD=31111111&lead_filter_id=$lead_filter_id\">Φίλτρο Οδηγού</a>: </td><td align=left><select size=1 name=lead_filter_id>\n";
	echo "$filters_list";
	echo "<option selected value=\"$lead_filter_id\">$lead_filter_id - $filtername_list[$lead_filter_id]</option>\n";
	echo "</select>$NWB#vicidial_campaigns-lead_filter_id$NWE</td></tr>\n";

	echo "<tr bgcolor=#B6D3FC><td align=right>Επίπεδο Hopper: </td><td align=left><select size=1 name=hopper_level><option>1</option><option>5</option><option>10</option><option>50</option><option>100</option><option>200</option><option>500</option><option>750</option><option>1000</option><option>2000</option><option SELECTED>$hopper_level</option></select>$NWB#vicidial_campaigns-hopper_level$NWE</td></tr>\n";

	echo "<tr bgcolor=#B6D3FC><td align=right>Αναγκαστική Επαναφορά του Hopper: </td><td align=left><select size=1 name=reset_hopper><option>Y</option><option SELECTED>N</option></select>$NWB#vicidial_campaigns-force_reset_hopper$NWE</td></tr>\n";

	echo "<tr bgcolor=#BDFFBD><td align=right>Μέθοδος Κλήσης
: </td><td align=left><select size=1 name=dial_method><option >MANUAL</option><option>RATIO</option><option>ADAPT_HARD_LIMIT</option><option>ADAPT_TAPERED</option><option>ADAPT_AVERAGE</option><option SELECTED>$dial_method</option></select>$NWB#vicidial_campaigns-dial_method$NWE</td></tr>\n";

	echo "<tr bgcolor=#BDFFBD><td align=right>ΕΠΙΠΕΔΟ ΑΥΤΟΜΑΤΗΣ ΚΛΗΣΗΣ: </td><td align=left><select size=1 name=auto_dial_level><option >0</option><option>1</option><option>1.1</option><option>1.2</option><option>1.3</option><option>1.4</option><option>1.5</option><option>1.6</option><option>1.7</option><option>1.8</option><option>1.9</option><option>2.0</option><option>2.2</option><option>2.5</option><option>2.7</option><option>3.0</option><option>3.5</option><option>4.0</option><option SELECTED>$auto_dial_level</option></select>(0 = off)$NWB#vicidial_campaigns-auto_dial_level$NWE &nbsp; &nbsp; &nbsp; <input type=checkbox name=dial_level_override value=\"1\">ΠΡΟΣΑΡΜΟΣΤΕ ΤΗ ΣΥΜΠΛΗΡΩΜΑΤΙΚΗ ΠΡΟΜΉΘΕΙΑ</td></tr>\n";

	echo "<tr bgcolor=#BDFFBD><td align=right>Διαθέσιμα μόνο ετικέτες
: </td><td align=left><select size=1 name=available_only_ratio_tally><option >Y</option><option>N</option><option SELECTED>$available_only_ratio_tally</option></select>$NWB#vicidial_campaigns-available_only_ratio_tally$NWE</td></tr>\n";

	echo "<tr bgcolor=#BDFFBD><td align=right>Ποσοστό Ορίου Εγκατ.Κλήσεων
: </td><td align=left><select size=1 name=adaptive_dropped_percentage>\n";
	$n=100;
	while ($n>=1)
		{
		echo "<option>$n</option>\n";
		$n--;
		}
	echo "<option SELECTED>$adaptive_dropped_percentage</option></select>% $NWB#vicidial_campaigns-adaptive_dropped_percentage$NWE</td></tr>\n";

	echo "<tr bgcolor=#BDFFBD><td align=right>Μέγιστο Επίπεδο Προσαρμογής Κλήσεων
: </td><td align=left><input type=text name=adaptive_maximum_level size=6 maxlength=6 value=\"$adaptive_maximum_level\"><i>number only</i> $NWB#vicidial_campaigns-adaptive_maximum_level$NWE</td></tr>\n";

	echo "<tr bgcolor=#BDFFBD><td align=right>Τελευταίος Χρόνος Διακομιστή
: </td><td align=left><input type=text name=adaptive_latest_server_time size=6 maxlength=4 value=\"$adaptive_latest_server_time\"><i>4 μόνο αριθμοί</i> $NWB#vicidial_campaigns-adaptive_latest_server_time$NWE</td></tr>\n";

	echo "<tr bgcolor=#BDFFBD><td align=right>Ενταση Τροποποίησης Προσαρμογής
: </td><td align=left><select size=1 name=adaptive_intensity>\n";
	$n=40;
	while ($n>=-40)
		{
		$dtl = 'Balanced';
		if ($n<0) {$dtl = 'Less Intense';}
		if ($n>0) {$dtl = 'More Intense';}
		if ($n == $adaptive_intensity) 
			{echo "<option SELECTED value=\"$n\">$n - $dtl</option>\n";}
		else
			{echo "<option value=\"$n\">$n - $dtl</option>\n";}
		$n--;
		}
	echo "</select> $NWB#vicidial_campaigns-adaptive_intensity$NWE</td></tr>\n";



	echo "<tr bgcolor=#BDFFBD><td align=right>Επίπεδο Κλήσεων Μεταβολής Στόχου
: </td><td align=left><select size=1 name=adaptive_dl_diff_target>\n";
	$n=40;
	while ($n>=-40)
		{
		$nabs = abs($n);
		$dtl = 'Balanced';
		if ($n<0) {$dtl = 'Agents Waiting for Calls';}
		if ($n>0) {$dtl = 'Calls Waiting for Agents';}
		if ($n == $adaptive_dl_diff_target) 
			{echo "<option SELECTED value=\"$n\">$n --- $nabs $dtl</option>\n";}
		else
			{echo "<option value=\"$n\">$n --- $nabs $dtl</option>\n";}
		$n--;
		}
	echo "</select> $NWB#vicidial_campaigns-adaptive_dl_diff_target$NWE</td></tr>\n";

	echo "<tr bgcolor=#BDFFBD><td align=right>Ταυτόχρονες μεταφορές: </td><td align=left><select size=1 name=concurrent_transfers><option >AUTO</option><option>1</option><option>2</option><option>3</option><option>4</option><option>5</option><option>6</option><option>7</option><option>8</option><option>9</option><option>10<option SELECTED>$concurrent_transfers</option></select>$NWB#vicidial_campaigns-concurrent_transfers$NWE</td></tr>\n";


	echo "<tr bgcolor=#B6D3FC><td align=right>Αυτόματος σχηματισμός ALT-ARJCMOY: </td><td align=left><select size=1 name=auto_alt_dial><option >NONE</option><option>ALT_ONLY</option><option>ADDR3_ONLY</option><option>ALT_AND_ADDR3<option SELECTED>$auto_alt_dial</option></select>$NWB#vicidial_campaigns-auto_alt_dial$NWE</td></tr>\n";

	echo "<tr bgcolor=#B6D3FC><td align=right>Επόμενη Κλήση Χειριστή: </td><td align=left><select size=1 name=next_agent_call><option >random</option><option>oldest_call_start</option><option>oldest_call_finish</option><option>overall_user_level</option><option SELECTED>$next_agent_call</option></select>$NWB#vicidial_campaigns-next_agent_call$NWE</td></tr>\n";

	echo "<tr bgcolor=#B6D3FC><td align=right><a href=\"$PHP_SELF?ADD=311111111&call_time_id=$local_call_time\">Χρόνος Τοπικής Κλήσης: </a></td><td align=left><select size=1 name=local_call_time>\n";
	echo "$call_times_list";
	echo "<option selected value=\"$local_call_time\">$local_call_time - $call_timename_list[$local_call_time]</option>\n";
	echo "</select>$NWB#vicidial_campaigns-local_call_time$NWE</td></tr>\n";

	echo "<tr bgcolor=#B6D3FC><td align=right>Κλήση εκτός χρόνου: </td><td align=left><input type=text name=dial_timeout size=3 maxlength=3 value=\"$dial_timeout\"> <i>in seconds</i>$NWB#vicidial_campaigns-dial_timeout$NWE</td></tr>\n";

	echo "<tr bgcolor=#B6D3FC><td align=right>Πρόθεμα Κλήσης: </td><td align=left><input type=text name=dial_prefix size=20 maxlength=20 value=\"$dial_prefix\"> <font size=1>for 91NXXNXXXXXX value would be 9, for no dial prefix use X</font>$NWB#vicidial_campaigns-dial_prefix$NWE</td></tr>\n";

	echo "<tr bgcolor=#B6D3FC><td align=right>Παράλειψη Κωδικού Τηλεφώνου
: </td><td align=left><select size=1 name=omit_phone_code><option>Y</option><option>N</option><option SELECTED>$omit_phone_code</option></select>$NWB#vicidial_campaigns-omit_phone_code$NWE</td></tr>\n";

	echo "<tr bgcolor=#B6D3FC><td align=right>CallerID Εκστρατείας: </td><td align=left><input type=text name=campaign_cid size=20 maxlength=20 value=\"$campaign_cid\">$NWB#vicidial_campaigns-campaign_cid$NWE</td></tr>\n";

	echo "<tr bgcolor=#B6D3FC><td align=right>Εκστρατείας VDAD εσωτ.σύνδεση: </td><td align=left><input type=text name=campaign_vdad_exten size=10 maxlength=20 value=\"$campaign_vdad_exten\">$NWB#vicidial_campaigns-campaign_vdad_exten$NWE</td></tr>\n";

	echo "<tr bgcolor=#B6D3FC><td align=right>Επέκταση εκστρατείας Ηχογρ: </td><td align=left><input type=text name=campaign_rec_exten size=10 maxlength=10 value=\"$campaign_rec_exten\">$NWB#vicidial_campaigns-campaign_rec_exten$NWE</td></tr>\n";

	echo "<tr bgcolor=#B6D3FC><td align=right>Ηχογράφηση εκστρατείας: </td><td align=left><select size=1 name=campaign_recording><option>NEVER</option><option>ONDEMAND</option><option>ALLCALLS</option><option>ALLFORCE</option><option SELECTED>$campaign_recording</option></select>$NWB#vicidial_campaigns-campaign_recording$NWE</td></tr>\n";

	echo "<tr bgcolor=#B6D3FC><td align=right>Όνομα αρχείου εκστρατείας Ηχογρ: </td><td align=left><input type=text name=campaign_rec_filename size=50 maxlength=50 value=\"$campaign_rec_filename\">$NWB#vicidial_campaigns-campaign_rec_filename$NWE</td></tr>\n";

	echo "<tr bgcolor=#B6D3FC><td align=right>Καθυστέρηση Ηχογράφησης
: </td><td align=left><input type=text name=allcalls_delay size=3 maxlength=3 value=\"$allcalls_delay\"> <i>in seconds</i>$NWB#vicidial_campaigns-allcalls_delay$NWE</td></tr>\n";

	echo "<tr bgcolor=#B6D3FC><td align=right><a href=\"$PHP_SELF?ADD=3111111&script_id=$script_id\">Script</a>: </td><td align=left><select size=1 name=script_id>\n";
	echo "$scripts_list";
	echo "<option selected value=\"$script_id\">$script_id - $scriptname_list[$script_id]</option>\n";
	echo "</select>$NWB#vicidial_campaigns-campaign_script$NWE</td></tr>\n";

	echo "<tr bgcolor=#B6D3FC><td align=right>Κατά την έναρξη κλήσης: </td><td align=left><select size=1 name=get_call_launch><option selected>NONE</option><option>SCRIPT</option><option>WEBFORM</option><option selected>$get_call_launch</option></select>$NWB#vicidial_campaigns-get_call_launch$NWE</td></tr>\n";

	echo "<tr bgcolor=#B6D3FC><td align=right>Μήνυμα Αυτόματου Τηλεφωνητή: </td><td align=left><input type=text name=am_message_exten size=10 maxlength=20 value=\"$am_message_exten\">$NWB#vicidial_campaigns-am_message_exten$NWE</td></tr>\n";

	echo "<tr bgcolor=#B6D3FC><td align=right>AMD στέλνει στο VM: </td><td align=left><select size=1 name=amd_send_to_vmx><option>Y</option><option>N</option><option SELECTED>$amd_send_to_vmx</option></select>$NWB#vicidial_campaigns-amd_send_to_vmx$NWE</td></tr>\n";

	echo "<tr bgcolor=#B6D3FC><td align=right>DTMF Μεταφοράς-Συνδ 1: </td><td align=left><input type=text name=xferconf_a_dtmf size=20 maxlength=50 value=\"$xferconf_a_dtmf\">$NWB#vicidial_campaigns-xferconf_a_dtmf$NWE</td></tr>\n";

	echo "<tr bgcolor=#B6D3FC><td align=right>Αριθμός Μεταφοράς-Συνδ 1: </td><td align=left><input type=text name=xferconf_a_number size=20 maxlength=50 value=\"$xferconf_a_number\">$NWB#vicidial_campaigns-xferconf_a_dtmf$NWE</td></tr>\n";

	echo "<tr bgcolor=#B6D3FC><td align=right>DTMF Μεταφοράς-Συνδ 2: </td><td align=left><input type=text name=xferconf_b_dtmf size=20 maxlength=50 value=\"$xferconf_b_dtmf\">$NWB#vicidial_campaigns-xferconf_a_dtmf$NWE</td></tr>\n";

	echo "<tr bgcolor=#B6D3FC><td align=right>Αριθμός Μεταφοράς-Συνδ 2: </td><td align=left><input type=text name=xferconf_b_number size=20 maxlength=50 value=\"$xferconf_b_number\">$NWB#vicidial_campaigns-xferconf_a_dtmf$NWE</td></tr>\n";

	echo "<tr bgcolor=#B6D3FC><td align=right>Κλήση Εναλ Αριθμού: </td><td align=left><select size=1 name=alt_number_dialing><option>Y</option><option>N</option><option SELECTED>$alt_number_dialing</option></select>$NWB#vicidial_campaigns-alt_number_dialing$NWE</td></tr>\n";

	echo "<tr bgcolor=#B6D3FC><td align=right>Προγραμματισμένες Επανακλήσεις: </td><td align=left><select size=1 name=scheduled_callbacks><option>Y</option><option>N</option><option SELECTED>$scheduled_callbacks</option></select>$NWB#vicidial_campaigns-scheduled_callbacks$NWE</td></tr>\n";

	echo "<tr bgcolor=#B6D3FC><td align=right>Δευτερ. Εγκαταλ. Κλήσης: </td><td align=left><input type=text name=drop_call_seconds size=5 maxlength=2 value=\"$drop_call_seconds\">$NWB#vicidial_campaigns-drop_call_seconds$NWE</td></tr>\n";

	echo "<tr bgcolor=#B6D3FC><td align=right>ΦΩΝΗΤΙΚΟ ΤΑΧΥΔΡΟΜΕΙΟ: </td><td align=left><input type=text name=voicemail_ext size=10 maxlength=10 value=\"$voicemail_ext\">$NWB#vicidial_campaigns-voicemail_ext$NWE</td></tr>\n";

	echo "<tr bgcolor=#B6D3FC><td align=right>Χρήση μηνύματος Ασφαλούς Φιλοξενίας: </td><td align=left><select size=1 name=safe_harbor_message><option>Y</option><option>N</option><option SELECTED>$safe_harbor_message</option></select>$NWB#vicidial_campaigns-safe_harbor_message$NWE</td></tr>\n";

	echo "<tr bgcolor=#B6D3FC><td align=right>Εσωτ.Σύνδεση Ασφαλούς Φιλοξενίας: </td><td align=left><input type=text name=safe_harbor_exten size=10 maxlength=20 value=\"$safe_harbor_exten\">$NWB#vicidial_campaigns-safe_harbor_exten$NWE</td></tr>\n";

	echo "<tr bgcolor=#B6D3FC><td align=right>Δευτερ Τυλίγματος: </td><td align=left><input type=text name=wrapup_seconds size=5 maxlength=3 value=\"$wrapup_seconds\">$NWB#vicidial_campaigns-wrapup_seconds$NWE</td></tr>\n";

	echo "<tr bgcolor=#B6D3FC><td align=right>Μήνυμα Τυλίγματος: </td><td align=left><input type=text name=wrapup_message size=40 maxlength=255 value=\"$wrapup_message\">$NWB#vicidial_campaigns-wrapup_message$NWE</td></tr>\n";

	echo "<tr bgcolor=#B6D3FC><td align=right>Εσωτερικός κατάλογος DNC χρήσης: </td><td align=left><select size=1 name=use_internal_dnc><option>Y</option><option>N</option><option SELECTED>$use_internal_dnc</option></select>$NWB#vicidial_campaigns-use_internal_dnc$NWE</td></tr>\n";

	echo "<tr bgcolor=#B6D3FC><td align=right>Agent Pause Codes Ενεργή:</td><td align=left><select size=1 name=agent_pause_codes_active><option>Y</option><option>N</option><option SELECTED>$agent_pause_codes_active</option></select>$NWB#vicidial_campaigns-agent_pause_codes_active$NWE</td></tr>\n";

	echo "<tr bgcolor=#B6D3FC><td align=right>Εκστρατεία Stats Refresh: </td><td align=left><select size=1 name=campaign_stats_refresh><option>Y</option><option>N</option><option SELECTED>$campaign_stats_refresh</option></select>$NWB#vicidial_campaigns-campaign_stats_refresh$NWE</td></tr>\n";

	echo "<tr bgcolor=#B6D3FC><td align=right>Θέστε εκτός λειτουργίας αλλάζει τα στοιχεία πελατών: </td><td align=left><select size=1 name=disable_alter_custdata><option>Y</option><option>N</option><option SELECTED>$disable_alter_custdata</option></select>$NWB#vicidial_campaigns-disable_alter_custdata$NWE</td></tr>\n";

	echo "<tr bgcolor=#B6D3FC><td align=right>Επιτρέψτε τους κανένας-χοάνη-μολύβδους Logins: </td><td align=left><select size=1 name=no_hopper_leads_logins><option>Y</option><option>N</option><option SELECTED>$no_hopper_leads_logins</option></select>$NWB#vicidial_campaigns-no_hopper_leads_logins$NWE</td></tr>\n";


	if (eregi("(CLOSER|BLEND|INBND|_C$|_B$|_I$)", $campaign_id))
		{
		echo "<tr bgcolor=#B6D3FC><td align=right>Εισερχόμενες ομάδες: <BR>";
		echo " $NWB#vicidial_campaigns-closer_campaigns$NWE</td><td align=left>\n";
		echo "$groups_list";
		echo "</td></tr>\n";
		}



	echo "<tr bgcolor=#B6D3FC><td align=center colspan=2><input type=submit name=ΕΠΙΒΕΒΑΙΩΣΗ value=ΕΠΙΒΕΒΑΙΩΣΗ></td></tr>\n";
	echo "</TABLE></center></FORM>\n";

	echo "<center>\n";
	echo "<br><b>ΛΙΣΤΕΣ ΣΤΗΝ ΕΚΣΤΡΑΤΕΙΑ: &nbsp; $NWB#vicidial_campaign_lists$NWE</b><br>\n";
	echo "<TABLE width=400 cellspacing=3>\n";
	echo "<tr><td>ID ΛΙΣΤΑΣ</td><td>ΟΝΟΜΑ ΛΙΣΤΑΣ</td><td>ΕΝΕΡΓΟ</td></tr>\n";

		$active_lists = 0;
		$inactive_lists = 0;
		$stmt="SELECT list_id,active,list_name from vicidial_lists where campaign_id='$campaign_id'";
		$rslt=mysql_query($stmt, $link);
		$lists_to_print = mysql_num_rows($rslt);
		$camp_lists='';

		$o=0;
		while ($lists_to_print > $o) {
			$rowx=mysql_fetch_row($rslt);
			$o++;
		if (ereg("Y", $rowx[1])) {$active_lists++;   $camp_lists .= "'$rowx[0]',";}
		if (ereg("N", $rowx[1])) {$inactive_lists++;}

		if (eregi("1$|3$|5$|7$|9$", $o))
			{$bgcolor='bgcolor="#B9CBFD"';} 
		else
			{$bgcolor='bgcolor="#9BB9FB"';}

		echo "<tr $bgcolor><td><font size=1><a href=\"$PHP_SELF?ADD=311&list_id=$rowx[0]\">$rowx[0]</a></td><td><font size=1>$rowx[2]</td><td><font size=1>$rowx[1]</td></tr>\n";

		}

	echo "</table></center><br>\n";
	echo "<center><b>\n";

	$filterSQL = $filtersql_list[$lead_filter_id];
	$filterSQL = eregi_replace("^and|and$|^or|or$","",$filterSQL);
	if (strlen($filterSQL)>4)
		{$fSQL = "and $filterSQL";}
	else
		{$fSQL = '';}

		$camp_lists = eregi_replace(".$","",$camp_lists);
	echo "Αυτή η εκστρατεία έχει$active_lists ενεργές λίστες και$inactive_lists Μη ενεργές λίστες<br><br>\n";

	if ($display_dialable_count == 'Y')
		{
		### call function to calculate and print dialable leads
		dialable_leads($DB,$link,$local_call_time,$dial_statuses,$camp_lists,$fSQL);
		echo " - <font size=1><a href=\"$PHP_SELF?ADD=31&campaign_id=$campaign_id&stage=hide_dialable\">ΑΠΟΚΡΥΨΗ</a></font><BR><BR>";
		}
	else
		{
		echo "<a href=\"$PHP_SELF?ADD=73&campaign_id=$campaign_id\" target=\"_blank\">Popup Dialable Leads Count</a>";
		echo " - <font size=1><a href=\"$PHP_SELF?ADD=31&campaign_id=$campaign_id&stage=show_dialable\">ΕΜΦΑΝΙΣΗ</a></font><BR><BR>";
		}





		$stmt="SELECT count(*) FROM vicidial_hopper where campaign_id='$campaign_id' and status IN('READY')";
		if ($DB) {echo "$stmt\n";}
		$rslt=mysql_query($stmt, $link);
		$rowx=mysql_fetch_row($rslt);
		$hopper_leads = "$rowx[0]";

	echo "Αυτή η εκστρατεία έχει$hopper_leads >οδηγοί στον hopper κλήσεων<<br><br>\n";
	echo "<a href=\"./AST_VICIDIAL_hopperlist.php?group=$campaign_id\">Πατήστε εδώ για να δείτε ποιοι οδηγοί είναι στον hopper τώρα</a><br><br>\n";
	echo "<a href=\"$PHP_SELF?ADD=81&campaign_id=$campaign_id\">Επιλέξτε εδώ για να δείτε τις κρατειμένες Επανακλήσεις σε αυτήν την εκστρατεία</a><BR><BR>\n";
	echo "<a href=\"./AST_VDADstats.php?group=$campaign_id\">Click here to see a VDAD report for this campaign</a><BR><BR>\n";
	echo "</b></center>\n";




	echo "<center>\n";
	echo "<br><b>ΠΡΟΣΑΡΜΟΣΜΕΝΕΣ ΚΑΤΑΣΤΑΣΕΙΣ ΣΤΗΝ ΕΚΣΤΡΑΤΕΙΑ: &nbsp; $NWB#vicidial_campaign_statuses$NWE</b><br>\n";
	echo "<TABLE width=400 cellspacing=3>\n";
	echo "<tr><td>ΚΑΤΑΣΤΑΣΗ</td><td>ΠΕΡΙΓΡΑΦΗ</td><td>ΕΠΙΛΕΞΙΜΟ</td><td>ΔΙΑΓΡΑΦΗ</td></tr>\n";

		$stmt="SELECT * from vicidial_campaign_statuses where campaign_id='$campaign_id'";
		$rslt=mysql_query($stmt, $link);
		$statuses_to_print = mysql_num_rows($rslt);
		$o=0;
		while ($statuses_to_print > $o) {
			$rowx=mysql_fetch_row($rslt);
			$o++;

		if (eregi("1$|3$|5$|7$|9$", $o))
			{$bgcolor='bgcolor="#B9CBFD"';} 
		else
			{$bgcolor='bgcolor="#9BB9FB"';}

		echo "<tr $bgcolor><td><font size=1>$rowx[0]</td><td><font size=1>$rowx[1]</td><td><font size=1>$rowx[2]</td><td><font size=1><a href=\"$PHP_SELF?ADD=42&campaign_id=$campaign_id&status=$rowx[0]&action=DELETE\">ΔΙΑΓΡΑΦΗ</a></td></tr>\n";

		}

	echo "</table>\n";

	echo "<br>ΠΡΟΣΘΗΚΗ ΝΕΑΣ ΠΡΟΣΑΡΜΟΣΜΕΝΗΣ ΚΑΤΑΣΤΑΣΗΣ ΣΤΗΝ ΕΚΣΤΡΑΤΕΙΑ<BR><form action=$PHP_SELF method=POST>\n";
	echo "<input type=hidden name=ADD value=22>\n";
	echo "<input type=hidden name=campaign_id value=\"$campaign_id\">\n";
	echo "Κατάσταση:<input type=text name=status size=10 maxlength=8> &nbsp; \n";
	echo "Περιγραφή:<input type=text name=status_name size=20 maxlength=30> &nbsp; \n";
	echo "Επιλέξιμο:<select size=1 name=selectable><option>Y</option><option>N</option></select> &nbsp; \n";
	echo "<input type=submit name=submit value=ΠΡΟΣΘΗΚΗ><BR>\n";

	echo "</FORM><br>\n";



	echo "<br><b>ΠΡΟΣΑΡΜΟΣΜΕΝΑ ΚΛΕΙΔΙΑ ΣΤΗΝ ΕΚΣΤΡΑΤΕΙΑ: &nbsp; $NWB#vicidial_campaign_hotkeys$NWE</b><br>\n";
	echo "<TABLE width=400 cellspacing=3>\n";
	echo "<tr><td>ΚΛΕΙΔΙ</td><td>ΚΑΤΑΣΤΑΣΗ</td><td>ΠΕΡΙΓΡΑΦΗ</td><td>ΔΙΑΓΡΑΦΗ</td></tr>\n";

		$stmt="SELECT * from vicidial_campaign_hotkeys where campaign_id='$campaign_id' order by hotkey";
		$rslt=mysql_query($stmt, $link);
		$statuses_to_print = mysql_num_rows($rslt);
		$o=0;
		while ($statuses_to_print > $o) {
			$rowx=mysql_fetch_row($rslt);
			$o++;

		if (eregi("1$|3$|5$|7$|9$", $o))
			{$bgcolor='bgcolor="#B9CBFD"';} 
		else
			{$bgcolor='bgcolor="#9BB9FB"';}

		echo "<tr $bgcolor><td><font size=1>$rowx[1]</td><td><font size=1>$rowx[0]</td><td><font size=1>$rowx[2]</td><td><font size=1><a href=\"$PHP_SELF?ADD=43&campaign_id=$campaign_id&status=$rowx[0]&hotkey=$rowx[1]&action=DELETE\">ΔΙΑΓΡΑΦΗ</a></td></tr>\n";

		}

	echo "</table>\n";

	echo "<br>ΠΡΟΣΘΗΚΗ ΝΕΟΥ ΠΡΟΣΑΡΜΟΣΜΕΝΟΥ ΚΛΕΙΔΙΟΥ ΕΚΣΤΡΑΤΕΙΑΣ<BR><form action=$PHP_SELF method=POST>\n";
	echo "<input type=hidden name=ADD value=23>\n";
	echo "<input type=hidden name=selectable value=Y>\n";
	echo "<input type=hidden name=campaign_id value=\"$campaign_id\">\n";
	echo "Hotkey: <select size=1 name=hotkey>\n";
	echo "<option>1</option>\n";
	echo "<option>2</option>\n";
	echo "<option>3</option>\n";
	echo "<option>4</option>\n";
	echo "<option>5</option>\n";
	echo "<option>6</option>\n";
	echo "<option>7</option>\n";
	echo "<option>8</option>\n";
	echo "<option>9</option>\n";
	echo "</select> &nbsp; \n";
	echo "Κατάσταση:<select size=1 name=HKstatus>\n";
	echo "$HKstatuses_list\n";
	echo "<option value=\"ALTPH2-----Alternate Phone Hot Dial\">ALTPH2 - Alternate Phone Hot Dial</option>\n";
	echo "<option value=\"ADDR3-----Address3 Hot Dial\">ADDR3 - Address3 Hot Dial</option>\n";
	echo "</select> &nbsp; \n";
	echo "<input type=submit name=submit value=ΠΡΟΣΘΗΚΗ><BR>\n";
	echo "</form><BR>\n";



	echo "<br><br><b>ΑΝΑΚΥΚΛΩΣΗ ΟΔΗΓΟΥ ΜΕΣΑ ΣΕ ΑΥΤΗΝ ΤΗΝ ΕΚΣΤΡΑΤΕΙΑ: &nbsp; $NWB#vicidial_lead_recycle$NWE</b><br>\n";
	echo "<TABLE width=500 cellspacing=3>\n";
	echo "<tr><td>ΚΑΤΑΣΤΑΣΗ</td><td>ΚΑΘΥΣΤΕΡΗΣΗ ΠΡΟΣΠΑΘΕΙΑΣ</td><td>ΜΕΓΙΣΤΟ ΠΡΟΣΠΑΘΕΙΑΣ</td><td>ΕΝΕΡΓΟ</td><td> </td><td>ΔΙΑΓΡΑΦΗ</td></tr>\n";

		$stmt="SELECT * from vicidial_lead_recycle where campaign_id='$campaign_id' order by status";
		$rslt=mysql_query($stmt, $link);
		$recycle_to_print = mysql_num_rows($rslt);
		$o=0;
		while ($recycle_to_print > $o) {
			$rowx=mysql_fetch_row($rslt);
			$o++;

		if (eregi("1$|3$|5$|7$|9$", $o))
			{$bgcolor='bgcolor="#B9CBFD"';} 
		else
			{$bgcolor='bgcolor="#9BB9FB"';}

		echo "<tr $bgcolor><td><font size=1>$rowx[2]<form action=$PHP_SELF method=POST>\n";
		echo "<input type=hidden name=status value=\"$rowx[2]\">\n";
		echo "<input type=hidden name=campaign_id value=\"$campaign_id\">\n";
		echo "<input type=hidden name=ADD value=45></td>\n";
		echo "<td><font size=1><input type=text size=7 maxlength=5 name=attempt_delay value=\"$rowx[3]\"></td>\n";
		echo "<td><font size=1><input type=text size=5 maxlength=3 name=attempt_maximum value=\"$rowx[4]\"></td>\n";
		echo "<td><select size=1 name=active><option>Y</option><option>N</option><option SELECTED>$rowx[5]</option></select></td>\n";
		echo "<td><font size=1><input type=submit name=submit value=MODIFY></form></td>\n";
		echo "<td><font size=1><a href=\"$PHP_SELF?ADD=65&campaign_id=$campaign_id&status=$rowx[2]\">ΔΙΑΓΡΑΦΗ</a></td></tr>\n";
		}

	echo "</table>\n";

	echo "<br>ΠΡΟΣΘΕΣΕ ΝΕΟ ΟΔΗΓΟ ΕΚΣΤΡΑΤΕΙΑΣ ΑΝΑΚΥΚΛΩΣΗΣ<BR><form action=$PHP_SELF method=POST>\n";
	echo "<input type=hidden name=ADD value=25>\n";
	echo "<input type=hidden name=active value=\"N\">\n";
	echo "<input type=hidden name=campaign_id value=\"$campaign_id\">\n";
	echo "Κατάσταση:<select size=1 name=status>\n";
	echo "$LRstatuses_list\n";
	echo "</select> &nbsp; \n";
	echo "Καθυστέρηση προσπάθειας: <input type=text size=7 maxlength=5 name=attempt_delay>\n";
	echo "Μέγιστο προσπάθειας: <input type=text size=5 maxlength=3 name=attempt_maximum>\n";
	echo "<input type=submit name=submit value=ΠΡΟΣΘΗΚΗ><BR>\n";

	echo "</FORM><br>\n";



	echo "<br><br><b>ΑΥΤΟΜΑΤΟΣ ΣΧΗΜΑΤΙΣΜΌΣ ΑΡΙΘΜΟΎ ALT ΓΙΑ ΑΥΤΉΝ ΤΗΝ ΕΚΣΤΡΑΤΕΊΑ: &nbsp; $NWB#vicidial_auto_alt_dial_statuses$NWE</b><br>\n";
	echo "<TABLE width=500 cellspacing=3>\n";
	echo "<tr><td>STATUSES</td><td>ΔΙΑΓΡΑΦΗ</td></tr>\n";

	$auto_alt_dial_statuses = preg_replace("/ -$/","",$auto_alt_dial_statuses);
	$AADstatuses = explode(" ", $auto_alt_dial_statuses);
	$AADs_to_print = (count($AADstatuses) -1);

	$o=0;
	while ($AADs_to_print > $o) 
		{
		if (eregi("1$|3$|5$|7$|9$", $o))
			{$bgcolor='bgcolor="#B9CBFD"';} 
		else
			{$bgcolor='bgcolor="#9BB9FB"';}
		$o++;

		echo "<tr $bgcolor><td><font size=1>$AADstatuses[$o]</td>\n";
		echo "<td><font size=1><a href=\"$PHP_SELF?ADD=66&campaign_id=$campaign_id&status=$AADstatuses[$o]\">ΔΙΑΓΡΑΦΗ</a></td></tr>\n";
		}

	echo "</table>\n";

	echo "<br>ΠΡΟΣΘΕΣΤΕ ΤΗ ΝΕΑ ΑΥΤΟΜΑΤΗ ΘΈΣΗ ΣΧΗΜΑΤΙΣΜΟΎ ΑΡΙΘΜΟΎ ALT<BR><form action=$PHP_SELF method=POST>\n";
	echo "<input type=hidden name=ADD value=26>\n";
	echo "<input type=hidden name=campaign_id value=\"$campaign_id\">\n";
	echo "Κατάσταση:<select size=1 name=status>\n";
	echo "$LRstatuses_list\n";
	echo "</select> &nbsp; \n";
	echo "<input type=submit name=submit value=ΠΡΟΣΘΗΚΗ><BR>\n";

	echo "</FORM><br>\n";



	echo "<br><br><b>ΚΩΔΙΚΕΣ ΜΙΚΡΗΣ ΔΙΑΚΟΠΉΣ ΠΡΑΚΤΟΡΩΝ ΓΙΑ ΑΥΤΗΝ ΤΗΝ ΕΚΣΤΡΑΤΕΙΑ: &nbsp; $NWB#vicidial_pause_codes$NWE</b><br>\n";
	echo "<TABLE width=500 cellspacing=3>\n";
	echo "<tr><td>ΚΩΔΙΚΕΣ ΜΙΚΡΗΣ ΔΙΑΚΟΠΉΣ</td><td>ΧΡΕΩΤΕΟΣ</td><td>ΤΡΟΠΟΠΟΙΗΣΗ</td><td>ΔΙΑΓΡΑΦΗ</td></tr>\n";

		$stmt="SELECT * from vicidial_pause_codes where campaign_id='$campaign_id' order by pause_code";
		$rslt=mysql_query($stmt, $link);
		$pause_codes_to_print = mysql_num_rows($rslt);
		$o=0;
		while ($pause_codes_to_print > $o) {
			$rowx=mysql_fetch_row($rslt);
			$o++;

		if (eregi("1$|3$|5$|7$|9$", $o))
			{$bgcolor='bgcolor="#B9CBFD"';} 
		else
			{$bgcolor='bgcolor="#9BB9FB"';}

		echo "<tr $bgcolor><td><form action=$PHP_SELF method=POST><font size=1>$rowx[0]\n";
		echo "<input type=hidden name=ADD value=47>\n";
		echo "<input type=hidden name=campaign_id value=\"$campaign_id\">\n";
		echo "<input type=hidden name=pause_code value=\"$rowx[0]\"> &nbsp;\n";
		echo "<input type=text size=20 maxlength=30 name=pause_code_name value=\"$rowx[1]\"></td>\n";
		echo "<td><select size=1 name=billable><option>YES</option><option>NO</option><option>HALF</option><option SELECTED>$rowx[2]</option></select></td>\n";
		echo "<td><font size=1><input type=submit name=submit value=MODIFY></form></td>\n";
		echo "<td><font size=1><a href=\"$PHP_SELF?ADD=67&campaign_id=$campaign_id&pause_code=$rowx[0]\">ΔΙΑΓΡΑΦΗ</a></td></tr>\n";
		}

	echo "</table>\n";

	echo "<br>ΠΡΟΣΘΕΣΤΕ ΤΟ ΝΕΟ ΚΩΔΙΚΑ ΜΙΚΡΗΣ ΔΙΑΚΟΠΉΣ ΠΡΑΚΤΟΡΩΝ<BR><form action=$PHP_SELF method=POST>\n";
	echo "<input type=hidden name=ADD value=27>\n";
	echo "<input type=hidden name=campaign_id value=\"$campaign_id\">\n";
	echo "Κώδικας μικρής διακοπής: <input type=text size=8 maxlength=6 name=pause_code>\n";
	echo "Όνομα κώδικα μικρής διακοπής: <input type=text size=20 maxlength=30 name=pause_code_name>\n";
	echo " &nbsp; Χρεωτέος: <select size=1 name=billable><option>YES</option><option>NO</option><option>HALF</option></select>\n";
	echo "<input type=submit name=submit value=ΠΡΟΣΘΗΚΗ><BR>\n";

	echo "</center></FORM><br>\n";






	echo "<BR><BR>\n";
	echo "<a href=\"$PHP_SELF?ADD=52&campaign_id=$campaign_id\">ΑΠΟΣΥΝΔΕΣΗ ΟΛΩΝ ΤΩΝ ΧΕΙΡΙΣΤΩΝ ΑΠΟ ΑΥΤΗΝ ΤΗΝ ΕΚΣΤΡΑΤΕΙΑ</a><BR><BR>\n";
	echo "<a href=\"$PHP_SELF?ADD=53&campaign_id=$campaign_id\">EMERGENCY VDAC CLEAR FOR THIS CAMPAIGN</a><BR><BR>\n";

	if ($LOGdelete_campaigns > 0)
		{
		echo "<br><br><a href=\"$PHP_SELF?ADD=51&campaign_id=$campaign_id\">ΔΙΑΓΡΑΨΕ ΑΥΤΗΝ ΤΗΝ ΕΚΣΤΡΑΤΕΙΑ</a>\n";
		}
	}
	else
	{
	echo "Δεν έχετε την άδεια να δείτε αυτήν την σελίδα\n";
	exit;
	}
}


######################
# ADD=34 modify campaign info in the system - Basic View
######################

if ( ($ADD==34) and ( (!eregi("$campaign_id",$LOGallowed_campaigns)) and (!eregi("ALL-CAMPAIGNS",$LOGallowed_campaigns)) ) ) 
	{$ADD=30;}	# send to not allowed screen if not in vicidial_user_groups allowed_campaigns list

if ($ADD==34)
{
	if ($LOGmodify_campaigns==1)
	{
		if ($stage=='show_dialable')
		{
			$stmt="UPDATE vicidial_campaigns set display_dialable_count='Y' where campaign_id='$campaign_id';";
			$rslt=mysql_query($stmt, $link);
		}
		if ($stage=='hide_dialable')
		{
			$stmt="UPDATE vicidial_campaigns set display_dialable_count='N' where campaign_id='$campaign_id';";
			$rslt=mysql_query($stmt, $link);
		}
		echo "<TABLE><TR><TD>\n";
		echo "<FONT FACE=\"ARIAL,HELVETICA\" COLOR=BLACK SIZE=2>";

		$stmt="SELECT * from vicidial_campaigns where campaign_id='$campaign_id';";
		$rslt=mysql_query($stmt, $link);
		$row=mysql_fetch_row($rslt);
		$dial_status_a = $row[3];
		$dial_status_b = $row[4];
		$dial_status_c = $row[5];
		$dial_status_d = $row[6];
		$dial_status_e = $row[7];
		$lead_order = $row[8];
		$hopper_level = $row[13];
		$auto_dial_level = $row[14];
		$next_agent_call = $row[15];
		$local_call_time = $row[16];
		$voicemail_ext = $row[17];
		$dial_timeout = $row[18];
		$dial_prefix = $row[19];
		$campaign_cid = $row[20];
		$campaign_vdad_exten = $row[21];
		$script_id = $row[25];
		$get_call_launch = $row[26];
		$lead_filter_id = $row[35];
			if ($lead_filter_id=='') {$lead_filter_id='NONE';}
		$display_dialable_count = $row[39];
		$dial_method = $row[46];
		$adaptive_intensity = $row[51];
		$campaign_description = $row[57];
		$campaign_changedate = $row[58];
		$campaign_stats_refresh = $row[59];
		$campaign_logindate = $row[60];
		$dial_statuses = $row[61];

	echo "<br>MODIFY A CAMPAIGN'S RECORD: $row[0] - Βασική Επισκόπηση | ";
	echo "<a href=\"$PHP_SELF?ADD=31&campaign_id=$campaign_id\">Αναλυτική Επισκόπηση</a> | ";
	echo "<a href=\"./AST_timeonVDADall.php?RR=4&DB=0&group=$row[0]\">Πραγματικού Χρόνου Οθόνη</a>\n";
	echo "<form action=$PHP_SELF method=POST>\n";
	echo "<input type=hidden name=ADD value=44>\n";
	echo "<input type=hidden name=campaign_id value=\"$campaign_id\">\n";
	echo "<center><TABLE width=$section_width cellspacing=3>\n";
	echo "<tr bgcolor=#B6D3FC><td align=right>ID Εκστρατείας: </td><td align=left><b>$row[0]</b>$NWB#vicidial_campaigns-campaign_id$NWE</td></tr>\n";
	echo "<tr bgcolor=#B6D3FC><td align=right>Ονομα Εκστρατείας: </td><td align=left><input type=text name=campaign_name size=40 maxlength=40 value=\"$row[1]\">$NWB#vicidial_campaigns-campaign_name$NWE</td></tr>\n";
	echo "<tr bgcolor=#B6D3FC><td align=right>Περιγραφή εκστρατείας: </td><td align=left><input type=text name=campaign_changedate size=40 maxlength=255 value=\"$campaign_description\">$NWB#vicidial_campaigns-campaign_description$NWE</td></tr>\n";
	echo "<tr bgcolor=#B6D3FC><td align=right>Εκστρατεία Change Date: </td><td align=left>$campaign_changedate &nbsp; $NWB#vicidial_campaigns-campaign_changedate$NWE</td></tr>\n";
	echo "<tr bgcolor=#B6D3FC><td align=right>Εκστρατεία Login Date: </td><td align=left>$campaign_logindate &nbsp; $NWB#vicidial_campaigns-campaign_logindate$NWE</td></tr>\n";

	echo "<tr bgcolor=#B6D3FC><td align=right>Ενεργή:</td><td align=left><select size=1 name=active><option>Y</option><option>N</option><option SELECTED>$row[2]</option></select>$NWB#vicidial_campaigns-active$NWE</td></tr>\n";
	echo "<tr bgcolor=#B6D3FC><td align=right>Τηλ.σύνδ. Στάθμευσης: </td><td align=left>$row[9] - $row[10]$NWB#vicidial_campaigns-park_ext$NWE</td></tr>\n";
	echo "<tr bgcolor=#B6D3FC><td align=right>Ιστο-σελίδα: </td><td align=left>$row[11]$NWB#vicidial_campaigns-web_form_address$NWE</td></tr>\n";
	echo "<tr bgcolor=#B6D3FC><td align=right>Επιτρέπω τους Closers: </td><td align=left>$row[12] $NWB#vicidial_campaigns-allow_closers$NWE</td></tr>\n";

	$stmt="SELECT * from vicidial_statuses order by status";
	$rslt=mysql_query($stmt, $link);
	$statuses_to_print = mysql_num_rows($rslt);
	$statuses_list='';

	$o=0;
	while ($statuses_to_print > $o) 
		{
		$rowx=mysql_fetch_row($rslt);
		$statuses_list .= "<option value=\"$rowx[0]\">$rowx[0] - $rowx[1]</option>\n";
		$statname_list["$rowx[0]"] = "$rowx[1]";
		$LRstatuses_list .= "<option value=\"$rowx[0]-----$rowx[1]\">$rowx[0] - $rowx[1]</option>\n";
		if (eregi("Y",$rowx[2]))
			{$HKstatuses_list .= "<option value=\"$rowx[0]-----$rowx[1]\">$rowx[0] - $rowx[1]</option>\n";}
		$o++;
		}

	$stmt="SELECT * from vicidial_campaign_statuses where campaign_id='$campaign_id' order by status";
	$rslt=mysql_query($stmt, $link);
	$Cstatuses_to_print = mysql_num_rows($rslt);

	$o=0;
	while ($Cstatuses_to_print > $o) 
		{
		$rowx=mysql_fetch_row($rslt);
		$statuses_list .= "<option value=\"$rowx[0]\">$rowx[0] - $rowx[1]</option>\n";
		$statname_list["$rowx[0]"] = "$rowx[1]";
		$LRstatuses_list .= "<option value=\"$rowx[0]-----$rowx[1]\">$rowx[0] - $rowx[1]</option>\n";
		if (eregi("Y",$rowx[2]))
			{$HKstatuses_list .= "<option value=\"$rowx[0]-----$rowx[1]\">$rowx[0] - $rowx[1]</option>\n";}
		$o++;
		}

	$dial_statuses = preg_replace("/ -$/","",$dial_statuses);
	$Dstatuses = explode(" ", $dial_statuses);
	$Ds_to_print = (count($Dstatuses) -1);

	$o=0;
	while ($Ds_to_print > $o) 
		{
		$o++;
		$Dstatus = $Dstatuses[$o];

		echo "<tr bgcolor=#B6D3FC><td align=right>Θέση πινάκων$o: </td><td align=left> \n";
		echo "<b>$Dstatus</b> - $statname_list[$Dstatus] &nbsp; &nbsp; &nbsp; &nbsp; <font size=2>\n";
		echo "<a href=\"$PHP_SELF?ADD=68&campaign_id=$campaign_id&status=$Dstatuses[$o]\">ΑΦΑΙΡΕΣΤΕ</a></td></tr>\n";
		}

	echo "<tr bgcolor=#B6D3FC><td align=right>Add A Dial Κατάσταση:</td><td align=left><select size=1 name=dial_status>\n";
	echo "<option value=\"\"> - NONE - </option>\n";

	echo "$statuses_list";
	echo "</select> &nbsp; \n";
	echo "<input type=submit name=submit value=ΠΡΟΣΘΗΚΗ> &nbsp; &nbsp; $NWB#vicidial_campaigns-dial_status$NWE</td></tr>\n";

	echo "<tr bgcolor=#B6D3FC><td align=right>Σειρά Λίστας: </td><td align=left><select size=1 name=lead_order><option>DOWN</option><option>UP</option><option>UP PHONE</option><option>DOWN PHONE</option><option>UP LAST NAME</option><option>DOWN LAST NAME</option><option>UP COUNT</option><option>DOWN COUNT</option><option>DOWN COUNT 2nd NEW</option><option>DOWN COUNT 3rd NEW</option><option>DOWN COUNT 4th NEW</option><option SELECTED>$lead_order</option></select>$NWB#vicidial_campaigns-lead_order$NWE</td></tr>\n";

	echo "<tr bgcolor=#B6D3FC><td align=right><a href=\"$PHP_SELF?ADD=31111111&lead_filter_id=$lead_filter_id\">Φίλτρο Οδηγού</a>: </td><td align=left><select size=1 name=lead_filter_id>\n";
	echo "$filters_list";
	echo "<option selected value=\"$lead_filter_id\">$lead_filter_id - $filtername_list[$lead_filter_id]</option>\n";
	echo "</select>$NWB#vicidial_campaigns-lead_filter_id$NWE</td></tr>\n";

	echo "<tr bgcolor=#B6D3FC><td align=right>Επίπεδο Hopper: </td><td align=left><select size=1 name=hopper_level><option>1</option><option>5</option><option>10</option><option>50</option><option>100</option><option>200</option><option>500</option><option>750</option><option>1000</option><option>2000</option><option SELECTED>$hopper_level</option></select>$NWB#vicidial_campaigns-hopper_level$NWE</td></tr>\n";

	echo "<tr bgcolor=#B6D3FC><td align=right>Αναγκαστική Επαναφορά του Hopper: </td><td align=left><select size=1 name=reset_hopper><option>Y</option><option SELECTED>N</option></select>$NWB#vicidial_campaigns-force_reset_hopper$NWE</td></tr>\n";

	echo "<tr bgcolor=#BDFFBD><td align=right>Μέθοδος Κλήσης
: </td><td align=left><select size=1 name=dial_method><option >MANUAL</option><option>RATIO</option><option>ADAPT_HARD_LIMIT</option><option>ADAPT_TAPERED</option><option>ADAPT_AVERAGE</option><option SELECTED>$dial_method</option></select>$NWB#vicidial_campaigns-dial_method$NWE</td></tr>\n";

	echo "<tr bgcolor=#BDFFBD><td align=right>ΕΠΙΠΕΔΟ ΑΥΤΟΜΑΤΗΣ ΚΛΗΣΗΣ: </td><td align=left><select size=1 name=auto_dial_level><option >0</option><option>1</option><option>1.1</option><option>1.2</option><option>1.3</option><option>1.4</option><option>1.5</option><option>1.6</option><option>1.7</option><option>1.8</option><option>1.9</option><option>2.0</option><option>2.2</option><option>2.5</option><option>2.7</option><option>3.0</option><option>3.5</option><option>4.0</option><option SELECTED>$auto_dial_level</option></select>(0 = off)$NWB#vicidial_campaigns-auto_dial_level$NWE</td></tr>\n";

	echo "<tr bgcolor=#BDFFBD><td align=right>Ενταση Τροποποίησης Προσαρμογής
: </td><td align=left><select size=1 name=adaptive_intensity>\n";
	$n=40;
	while ($n>=-40)
		{
		$dtl = 'Balanced';
		if ($n<0) {$dtl = 'Less Intense';}
		if ($n>0) {$dtl = 'More Intense';}
		if ($n == $adaptive_intensity) 
			{echo "<option SELECTED value=\"$n\">$n - $dtl</option>\n";}
		else
			{echo "<option value=\"$n\">$n - $dtl</option>\n";}
		$n--;
		}
	echo "</select> $NWB#vicidial_campaigns-adaptive_intensity$NWE</td></tr>\n";

	echo "<tr bgcolor=#B6D3FC><td align=right><a href=\"$PHP_SELF?ADD=3111111&script_id=$script_id\">Script</a>: </td><td align=left>$script_id</td></tr>\n";

	echo "<tr bgcolor=#B6D3FC><td align=right>Κατά την έναρξη κλήσης: </td><td align=left>$get_call_launch</td></tr>\n";

	echo "<tr bgcolor=#B6D3FC><td align=center colspan=2><input type=submit name=ΕΠΙΒΕΒΑΙΩΣΗ value=ΕΠΙΒΕΒΑΙΩΣΗ></td></tr>\n";
	echo "</TABLE></center></FORM>\n";

	echo "<center>\n";
	echo "<br><b>ΛΙΣΤΕΣ ΣΤΗΝ ΕΚΣΤΡΑΤΕΙΑ: &nbsp; $NWB#vicidial_campaign_lists$NWE</b><br>\n";
	echo "<TABLE width=400 cellspacing=3>\n";
	echo "<tr><td>ID ΛΙΣΤΑΣ</td><td>ΟΝΟΜΑ ΛΙΣΤΑΣ</td><td>ΕΝΕΡΓΟ</td></tr>\n";

		$active_lists = 0;
		$inactive_lists = 0;
		$stmt="SELECT list_id,active,list_name from vicidial_lists where campaign_id='$campaign_id'";
		$rslt=mysql_query($stmt, $link);
		$lists_to_print = mysql_num_rows($rslt);
		$camp_lists='';

		$o=0;
		while ($lists_to_print > $o) {
			$rowx=mysql_fetch_row($rslt);
			$o++;
		if (ereg("Y", $rowx[1])) {$active_lists++;   $camp_lists .= "'$rowx[0]',";}
		if (ereg("N", $rowx[1])) {$inactive_lists++;}

		if (eregi("1$|3$|5$|7$|9$", $o))
			{$bgcolor='bgcolor="#B9CBFD"';} 
		else
			{$bgcolor='bgcolor="#9BB9FB"';}

		echo "<tr $bgcolor><td><font size=1><a href=\"$PHP_SELF?ADD=311&list_id=$rowx[0]\">$rowx[0]</a></td><td><font size=1>$rowx[2]</td><td><font size=1>$rowx[1]</td></tr>\n";

		}

	echo "</table></center><br>\n";
	echo "<center><b>\n";

	$filterSQL = $filtersql_list[$lead_filter_id];
	$filterSQL = eregi_replace("^and|and$|^or|or$","",$filterSQL);
	if (strlen($filterSQL)>4)
		{$fSQL = "and $filterSQL";}
	else
		{$fSQL = '';}

		$camp_lists = eregi_replace(".$","",$camp_lists);
	echo "Αυτή η εκστρατεία έχει$active_lists ενεργές λίστες και$inactive_lists Μη ενεργές λίστες<br><br>\n";


	if ($display_dialable_count == 'Y')
		{
		### call function to calculate and print dialable leads
		dialable_leads($DB,$link,$local_call_time,$dial_statuses,$camp_lists,$fSQL);
		echo " - <font size=1><a href=\"$PHP_SELF?ADD=34&campaign_id=$campaign_id&stage=hide_dialable\">ΑΠΟΚΡΥΨΗ</a></font><BR><BR>";
		}
	else
		{
		echo "<a href=\"$PHP_SELF?ADD=73&campaign_id=$campaign_id\" target=\"_blank\">Popup Dialable Leads Count</a>";
		echo " - <font size=1><a href=\"$PHP_SELF?ADD=31&campaign_id=$campaign_id&stage=show_dialable\">ΕΜΦΑΝΙΣΗ</a></font><BR><BR>";
		}



		$stmt="SELECT count(*) FROM vicidial_hopper where campaign_id='$campaign_id' and status IN('READY')";
		if ($DB) {echo "$stmt\n";}
		$rslt=mysql_query($stmt, $link);
		$rowx=mysql_fetch_row($rslt);
		$hopper_leads = "$rowx[0]";

	echo "Αυτή η εκστρατεία έχει$hopper_leads >οδηγοί στον hopper κλήσεων<<br><br>\n";
	echo "<a href=\"./AST_VICIDIAL_hopperlist.php?group=$campaign_id\">Πατήστε εδώ για να δείτε ποιοι οδηγοί είναι στον hopper τώρα</a><br><br>\n";
	echo "<a href=\"$PHP_SELF?ADD=81&campaign_id=$campaign_id\">Επιλέξτε εδώ για να δείτε τις κρατειμένες Επανακλήσεις σε αυτήν την εκστρατεία</a><BR><BR>\n";
	echo "<a href=\"./AST_VDADstats.php?group=$campaign_id\">Click here to see a VDAD report for this campaign</a><BR><BR>\n";
	echo "</b></center>\n";

	echo "<br>\n";

	echo "<a href=\"$PHP_SELF?ADD=52&campaign_id=$campaign_id\">ΑΠΟΣΥΝΔΕΣΗ ΟΛΩΝ ΤΩΝ ΧΕΙΡΙΣΤΩΝ ΑΠΟ ΑΥΤΗΝ ΤΗΝ ΕΚΣΤΡΑΤΕΙΑ</a><BR><BR>\n";


	if ($LOGdelete_campaigns > 0)
		{
		echo "<br><br><a href=\"$PHP_SELF?ADD=51&campaign_id=$campaign_id\">ΔΙΑΓΡΑΨΕ ΑΥΤΗΝ ΤΗΝ ΕΚΣΤΡΑΤΕΙΑ</a>\n";
		}
	}
	else
	{
	echo "Δεν έχετε την άδεια να δείτε αυτήν την σελίδα\n";
	exit;
	}
}


######################
# ADD=31 campaign not allowed
######################

if ($ADD==30)
{
echo "<TABLE><TR><TD>\n";
	echo "<FONT FACE=\"ARIAL,HELVETICA\" COLOR=BLACK SIZE=2>";
echo "You do not have permission to view campaign $campaign_id\n";
}



######################
# ADD=311 modify list info in the system
######################

if ($ADD==311)
{
	if ($LOGmodify_lists==1)
	{
	echo "<TABLE><TR><TD>\n";
	echo "<FONT FACE=\"ARIAL,HELVETICA\" COLOR=BLACK SIZE=2>";

	$stmt="SELECT * from vicidial_lists where list_id='$list_id';";
	$rslt=mysql_query($stmt, $link);
	$row=mysql_fetch_row($rslt);
	$campaign_id = $row[2];
	$active = $row[3];
	$list_description = $row[4];
	$list_changedate = $row[5];
	$list_lastcalldate = $row[6];

	# grab names of global statuses and statuses in the selected campaign
	$stmt="SELECT * from vicidial_statuses order by status";
	$rslt=mysql_query($stmt, $link);
	$statuses_to_print = mysql_num_rows($rslt);

	$o=0;
	while ($statuses_to_print > $o) {
		$rowx=mysql_fetch_row($rslt);
		$statuses_list["$rowx[0]"] = "$rowx[1]";
		$o++;
	}

	$stmt="SELECT * from vicidial_campaign_statuses where campaign_id='$campaign_id' order by status";
	$rslt=mysql_query($stmt, $link);
	$Cstatuses_to_print = mysql_num_rows($rslt);

	$o=0;
	while ($Cstatuses_to_print > $o) {
		$rowx=mysql_fetch_row($rslt);
		$statuses_list["$rowx[0]"] = "$rowx[1]";
		$o++;
	}
	# end grab status names


	echo "<br>ΤΡΟΠΟΠΟΙΗΣΗ ΕΓΓΡΑΦΗΣ ΛΙΣΤΑΣ: $row[0]<form action=$PHP_SELF method=POST>\n";
	echo "<input type=hidden name=ADD value=411>\n";
	echo "<input type=hidden name=list_id value=\"$row[0]\">\n";
	echo "<input type=hidden name=old_campaign_id value=\"$row[2]\">\n";
	echo "<center><TABLE width=$section_width cellspacing=3>\n";
	echo "<tr bgcolor=#B6D3FC><td align=right>ID Λίστας: </td><td align=left><b>$row[0]</b>$NWB#vicidial_lists-list_id$NWE</td></tr>\n";
	echo "<tr bgcolor=#B6D3FC><td align=right>Ονομα Λίστας: </td><td align=left><input type=text name=list_name size=20 maxlength=20 value=\"$row[1]\">$NWB#vicidial_lists-list_name$NWE</td></tr>\n";
	echo "<tr bgcolor=#B6D3FC><td align=right>Περιγραφή καταλόγων: </td><td align=left><input type=text name=list_description size=30 maxlength=255 value=\"$list_description\">$NWB#vicidial_lists-list_description$NWE</td></tr>\n";
	echo "<tr bgcolor=#B6D3FC><td align=right><a href=\"$PHP_SELF?ADD=34&campaign_id=$campaign_id\">Εκστρατεία</a>: </td><td align=left><select size=1 name=campaign_id>\n";

	$stmt="SELECT campaign_id,campaign_name from vicidial_campaigns order by campaign_id";
	$rslt=mysql_query($stmt, $link);
	$campaigns_to_print = mysql_num_rows($rslt);
	$campaigns_list='';

	$o=0;
	while ($campaigns_to_print > $o) {
		$rowx=mysql_fetch_row($rslt);
		$campaigns_list .= "<option value=\"$rowx[0]\">$rowx[0] - $rowx[1]</option>\n";
		$o++;
	}
	echo "$campaigns_list";
	echo "<option SELECTED>$campaign_id</option>\n";
	echo "</select>$NWB#vicidial_lists-campaign_id$NWE</td></tr>\n";
	echo "<tr bgcolor=#B6D3FC><td align=right>Ενεργή:</td><td align=left><select size=1 name=active><option>Y</option><option>N</option><option SELECTED>$active</option></select>$NWB#vicidial_lists-active$NWE</td></tr>\n";
	echo "<tr bgcolor=#B6D3FC><td align=right>ΕΠΑΝΑΦΟΡΑ ΚΑΤΑΣΤΑΣΗΣ ΚΛΗΣΗΣ ΟΔΗΓΟΥ ΓΙΑ ΤΗΝ ΛΙΣΤΑ: </td><td align=left><select size=1 name=reset_list><option>Y</option><option SELECTED>N</option></select>$NWB#vicidial_lists-reset_list$NWE</td></tr>\n";
	echo "<tr bgcolor=#B6D3FC><td align=right>Ημερομηνία αλλαγής καταλόγων: </td><td align=left>$list_changedate &nbsp; $NWB#vicidial_lists-list_changedate$NWE</td></tr>\n";
	echo "<tr bgcolor=#B6D3FC><td align=right>List Last Call Date: </td><td align=left>$list_lastcalldate &nbsp; $NWB#vicidial_lists-list_lastcalldate$NWE</td></tr>\n";
	echo "<tr bgcolor=#B6D3FC><td align=center colspan=2><input type=submit name=ΕΠΙΒΕΒΑΙΩΣΗ value=ΕΠΙΒΕΒΑΙΩΣΗ></td></tr>\n";
	echo "</TABLE></center>\n";

	echo "<center>\n";
	echo "<br><b>ΚΑΤΑΣΤΑΣΕΙΣ ΣΤΗΝ ΛΙΣΤΑ:</b><br>\n";
	echo "<TABLE width=500 cellspacing=3>\n";
	echo "<tr><td>ΚΑΤΑΣΤΑΣΗ</td><td>ΟΝΟΜΑ ΚΑΤΑΣΤΑΣΗΣ</td><td>ΚΛΗΘΕΝΤΑ</td><td>ΜΗ ΚΛΗΘΕΝΤΑ</td></tr>\n";

	$leads_in_list = 0;
	$leads_in_list_N = 0;
	$leads_in_list_Y = 0;
	$stmt="SELECT status,called_since_last_reset,count(*) from vicidial_list where list_id='$list_id' group by status,called_since_last_reset order by status,called_since_last_reset";
	if ($DB) {echo "$stmt\n";}
	$rslt=mysql_query($stmt, $link);
	$statuses_to_print = mysql_num_rows($rslt);

	$o=0;
	$lead_list['count'] = 0;
	$lead_list['Y_count'] = 0;
	$lead_list['N_count'] = 0;
	while ($statuses_to_print > $o) 
	{
	    $rowx=mysql_fetch_row($rslt);
	    
	    $lead_list['count'] = ($lead_list['count'] + $rowx[2]);
	    if ($rowx[1] == 'N') 
	    {
		$since_reset = 'N';
		$since_resetX = 'Y';
	    }
	    else 
	    {
		$since_reset = 'Y';
		$since_resetX = 'N';
	    } 
	    $lead_list[$since_reset][$rowx[0]] = ($lead_list[$since_reset][$rowx[0]] + $rowx[2]);
	    $lead_list[$since_reset.'_count'] = ($lead_list[$since_reset.'_count'] + $rowx[2]);
	    #If opposite side is not set, it may not in the future so give it a value of zero
	    if (!isset($lead_list[$since_resetX][$rowx[0]])) 
	    {
		$lead_list[$since_resetX][$rowx[0]]=0;
	    }
	    $o++;
	}
 
	$o=0;
	if ($lead_list['count'] > 0)
	{
		while (list($dispo,) = each($lead_list[$since_reset]))
		{

		if (eregi("1$|3$|5$|7$|9$", $o))
			{$bgcolor='bgcolor="#B9CBFD"';} 
		else
			{$bgcolor='bgcolor="#9BB9FB"';}

		if ($dispo == 'CBHOLD')
			{
			$CLB="<a href=\"$PHP_SELF?ADD=811&list_id=$list_id\">";
			$CLE="</a>";
			}
		else
			{
			$CLB='';
			$CLE='';
			}

		echo "<tr $bgcolor><td><font size=1>$CLB$dispo$CLE</td><td><font size=1>$statuses_list[$dispo]</td><td><font size=1>".$lead_list['Y'][$dispo]."</td><td><font size=1>".$lead_list['N'][$dispo]." </td></tr>\n";
		$o++;
		}
	}

	echo "<tr><td colspan=2><font size=1>ΥΠΟΣΥΝΟΛΑ</td><td><font size=1>$lead_list[Y_count]</td><td><font size=1>$lead_list[N_count]</td></tr>\n";
	echo "<tr bgcolor=\"#9BB9FB\"><td><font size=1>ΣΥΝΟΛΙΚΑ</td><td colspan=3 align=center><font size=1>$lead_list[count]</td></tr>\n";

	echo "</table></center><br>\n";
	unset($lead_list);


	echo "<center>\n";
	echo "<br><b>ΖΩΝΕΣ ΩΡΑΣ ΣΤΗΝ ΛΙΣΤΑ:</b><br>\n";
	echo "<TABLE width=500 cellspacing=3>\n";
	echo "<tr><td>GMT OFFSET (τοπικός χρόνος)</td><td>ΚΛΗΘΕΝΤΑ</td><td>ΜΗ ΚΛΗΘΕΝΤΑ</td></tr>\n";

	$stmt="SELECT gmt_offset_now,called_since_last_reset,count(*) from vicidial_list where list_id='$list_id' group by gmt_offset_now,called_since_last_reset order by gmt_offset_now,called_since_last_reset";
	$rslt=mysql_query($stmt, $link);
	$statuses_to_print = mysql_num_rows($rslt);

	$o=0;
	$plus='+';
	$lead_list['count'] = 0;
	$lead_list['Y_count'] = 0;
	$lead_list['N_count'] = 0;
	while ($statuses_to_print > $o) 
	{
	    $rowx=mysql_fetch_row($rslt);
	    
	    $lead_list['count'] = ($lead_list['count'] + $rowx[2]);
	    if ($rowx[1] == 'N') 
	    {
		$since_reset = 'N';
		$since_resetX = 'Y';
	    }
	    else 
	    {
		$since_reset = 'Y';
		$since_resetX = 'N';
	    } 
	    $lead_list[$since_reset][$rowx[0]] = ($lead_list[$since_reset][$rowx[0]] + $rowx[2]);
	    $lead_list[$since_reset.'_count'] = ($lead_list[$since_reset.'_count'] + $rowx[2]);
	    #If opposite side is not set, it may not in the future so give it a value of zero
	    if (!isset($lead_list[$since_resetX][$rowx[0]])) 
	    {
		$lead_list[$since_resetX][$rowx[0]]=0;
	    }
	    $o++;
	}

	if ($lead_list['count'] > 0)
	{
		while (list($tzone,) = each($lead_list[$since_reset]))
		{
		$LOCALzone=3600 * $tzone;
		$LOCALdate=gmdate("D M Y H:i", time() + $LOCALzone);

		if ($tzone >= 0) {$DISPtzone = "$plus$tzone";}
		else {$DISPtzone = "$tzone";}
		if (eregi("1$|3$|5$|7$|9$", $o))
			{$bgcolor='bgcolor="#B9CBFD"';} 
		else
			{$bgcolor='bgcolor="#9BB9FB"';}

			echo "<tr $bgcolor><td><font size=1>".$DISPtzone." &nbsp; &nbsp; ($LOCALdate)</td><td><font size=1>".$lead_list['Y'][$tzone]."</td><td><font size=1>".$lead_list['N'][$tzone]."</td></tr>\n";
		}
	}

	echo "<tr><td><font size=1>ΥΠΟΣΥΝΟΛΑ</td><td><font size=1>$lead_list[Y_count]</td><td><font size=1>$lead_list[N_count]</td></tr>\n";
	echo "<tr bgcolor=\"#9BB9FB\"><td><font size=1>ΣΥΝΟΛΙΚΑ</td><td colspan=2 align=center><font size=1>$lead_list[count]</td></tr>\n";

	echo "</table></center><br>\n";
	unset($lead_list);



	$leads_in_list = 0;
	$leads_in_list_N = 0;
	$leads_in_list_Y = 0;
	$stmt="SELECT status,called_count,count(*) from vicidial_list where list_id='$list_id' group by status,called_count order by status,called_count";
	$rslt=mysql_query($stmt, $link);
	$status_called_to_print = mysql_num_rows($rslt);

	$o=0;
	$sts=0;
	$first_row=1;
	$all_called_first=1000;
	$all_called_last=0;
	while ($status_called_to_print > $o) 
	{
	$rowx=mysql_fetch_row($rslt);
	$leads_in_list = ($leads_in_list + $rowx[2]);
	$count_statuses[$o]			= "$rowx[0]";
	$count_called[$o]			= "$rowx[1]";
	$count_count[$o]			= "$rowx[2]";
	$all_called_count[$rowx[1]] = ($all_called_count[$rowx[1]] + $rowx[2]);

	if ( (strlen($status[$sts]) < 1) or ($status[$sts] != "$rowx[0]") )
		{
		if ($first_row) {$first_row=0;}
		else {$sts++;}
		$status[$sts] = "$rowx[0]";
		$status_called_first[$sts] = "$rowx[1]";
		if ($status_called_first[$sts] < $all_called_first) {$all_called_first = $status_called_first[$sts];}
		}
	$leads_in_sts[$sts] = ($leads_in_sts[$sts] + $rowx[2]);
	$status_called_last[$sts] = "$rowx[1]";
	if ($status_called_last[$sts] > $all_called_last) {$all_called_last = $status_called_last[$sts];}

	$o++;
	}




	echo "<center>\n";
	echo "<br><b>ΜΕΤΡΗΣΗ ΚΛΗΣΕΩΝ ΣΤΗΝ ΛΙΣΤΑ:</b><br>\n";
	echo "<TABLE width=500 cellspacing=1>\n";
	echo "<tr><td align=left><font size=1>ΚΑΤΑΣΤΑΣΗ</td><td align=center><font size=1>ΟΝΟΜΑ ΚΑΤΑΣΤΑΣΗΣ</td>";
	$first = $all_called_first;
	while ($first <= $all_called_last)
		{
		if (eregi("1$|3$|5$|7$|9$", $first)) {$AB='bgcolor="#AFEEEE"';} 
		else{$AB='bgcolor="#E0FFFF"';}
		echo "<td align=center $AB><font size=1>$first</td>";
		$first++;
		}
	echo "<td align=center><font size=1>ΥΠΟΣΥΝΟΛΟ</td></tr>\n";

		$sts=0;
		$statuses_called_to_print = count($status);
		while ($statuses_called_to_print > $sts) 
		{
		$Pstatus = $status[$sts];
		if (eregi("1$|3$|5$|7$|9$", $sts))
			{$bgcolor='bgcolor="#B9CBFD"';   $AB='bgcolor="#9BB9FB"';} 
		else
			{$bgcolor='bgcolor="#9BB9FB"';   $AB='bgcolor="#B9CBFD"';}
	#	echo "$status[$sts]|$status_called_first[$sts]|$status_called_last[$sts]|$leads_in_sts[$sts]|\n";
	#	echo "$status[$sts]|";
		echo "<tr $bgcolor><td><font size=1>$Pstatus</td><td><font size=1>$statuses_list[$Pstatus]</td>";

		$first = $all_called_first;
		while ($first <= $all_called_last)
			{
			if (eregi("1$|3$|5$|7$|9$", $sts))
				{
				if (eregi("1$|3$|5$|7$|9$", $first)) {$AB='bgcolor="#9BB9FB"';} 
				else{$AB='bgcolor="#B9CBFD"';}
				}
			else
				{
				if (eregi("0$|2$|4$|6$|8$", $first)) {$AB='bgcolor="#9BB9FB"';} 
				else{$AB='bgcolor="#B9CBFD"';}
				}

			$called_printed=0;
			$o=0;
			while ($status_called_to_print > $o) 
				{
				if ( ($count_statuses[$o] == "$Pstatus") and ($count_called[$o] == "$first") )
					{
					$called_printed++;
					echo "<td $AB><font size=1> $count_count[$o]</td>";
					}


				$o++;
				}
			if (!$called_printed) 
				{echo "<td $AB><font size=1> &nbsp;</td>";}
			$first++;
			}
		echo "<td><font size=1>$leads_in_sts[$sts]</td></tr>\n\n";

		$sts++;
		}

	echo "<tr><td align=center colspan=2><b><font size=1>ΣΥΝΟΛΙΚΑ</td>";
	$first = $all_called_first;
	while ($first <= $all_called_last)
		{
		if (eregi("1$|3$|5$|7$|9$", $first)) {$AB='bgcolor="#AFEEEE"';} 
		else{$AB='bgcolor="#E0FFFF"';}
		echo "<td align=center $AB><b><font size=1>$all_called_count[$first]</td>";
		$first++;
		}
	echo "<td align=center><b><font size=1>$leads_in_list</td></tr>\n";

	echo "</table></center><br>\n";





	echo "<center><b>\n";

	echo "<br><br><a href=\"$PHP_SELF?ADD=811&list_id=$list_id\">Click here to see all CallBack Holds in this list</a><BR><BR>\n";

	if ($LOGdelete_lists > 0)
		{
		echo "<br><br><a href=\"$PHP_SELF?ADD=511&list_id=$list_id\">ΔΙΑΓΡΑΨΕ ΑΥΤΗ ΤΗΝ ΛΙΣΤΑ</a>\n";
		}
	}
	else
	{
	echo "Δεν έχετε την άδεια να δείτε αυτήν την σελίδα\n";
	exit;
	}
}



######################
# ADD=3111 modify in-group info in the system
######################

if ($ADD==3111)
{
	if ($LOGmodify_ingroups==1)
	{
	echo "<TABLE><TR><TD>\n";
	echo "<FONT FACE=\"ARIAL,HELVETICA\" COLOR=BLACK SIZE=2>";

	$stmt="SELECT * from vicidial_inbound_groups where group_id='$group_id';";
	$rslt=mysql_query($stmt, $link);
	$row=mysql_fetch_row($rslt);
	$group_name = $row[1];
	$group_color = $row[2];
	$active = $row[3];
	$web_form_address = $row[4];
	$voicemail_ext = $row[5];
	$next_agent_call = $row[6];
	$fronter_display = $row[7];
	$script_id = $row[8];
	$get_call_launch = $row[9];
	$xferconf_a_dtmf = $row[10];
	$xferconf_a_number = $row[11];
	$xferconf_b_dtmf = $row[12];
	$xferconf_b_number = $row[13];
	$drop_call_seconds = $row[14];
	$drop_message = $row[15];
	$drop_exten = $row[16];

	echo "<br>ΤΡΟΠΟΠΟΙΗΣΗ ΕΓΓΡΑΦΗΣ ΟΜΑΔΩΝ: $row[0]<form action=$PHP_SELF method=POST>\n";
	echo "<input type=hidden name=ADD value=4111>\n";
	echo "<input type=hidden name=group_id value=\"$row[0]\">\n";
	echo "<center><TABLE width=$section_width cellspacing=3>\n";
	echo "<tr bgcolor=#B6D3FC><td align=right>ID Ομάδας: </td><td align=left><b>$row[0]</b>$NWB#vicidial_inbound_groups-group_id$NWE</td></tr>\n";
	echo "<tr bgcolor=#B6D3FC><td align=right>Ονομα Ομάδας: </td><td align=left><input type=text name=group_name size=30 maxlength=30 value=\"$row[1]\">$NWB#vicidial_inbound_groups-group_name$NWE</td></tr>\n";
	echo "<tr bgcolor=#B6D3FC><td align=right>Χρώμα Ομάδας: </td><td align=left bgcolor=\"$row[2]\"><input type=text name=group_color size=7 maxlength=7 value=\"$row[2]\">$NWB#vicidial_inbound_groups-group_color$NWE</td></tr>\n";
	echo "<tr bgcolor=#B6D3FC><td align=right>Ενεργή:</td><td align=left><select size=1 name=active><option>Y</option><option>N</option><option SELECTED>$active</option></select>$NWB#vicidial_inbound_groups-active$NWE</td></tr>\n";
	echo "<tr bgcolor=#B6D3FC><td align=right>Ιστο-σελίδα: </td><td align=left><input type=text name=web_form_address size=50 maxlength=255 value=\"$web_form_address\">$NWB#vicidial_inbound_groups-web_form_address$NWE</td></tr>\n";
	echo "<tr bgcolor=#B6D3FC><td align=right>Επόμενη Κλήση Χειριστή: </td><td align=left><select size=1 name=next_agent_call><option >random</option><option>oldest_call_start</option><option>oldest_call_finish</option><option>overall_user_level</option><option SELECTED>$next_agent_call</option></select>$NWB#vicidial_inbound_groups-next_agent_call$NWE</td></tr>\n";
	echo "<tr bgcolor=#B6D3FC><td align=right>Μπροστινή Οθόνη: </td><td align=left><select size=1 name=fronter_display><option>Y</option><option>N</option><option SELECTED>$fronter_display</option></select>$NWB#vicidial_inbound_groups-fronter_display$NWE</td></tr>\n";

	echo "<tr bgcolor=#B6D3FC><td align=right><a href=\"$PHP_SELF?ADD=3111111&script_id=$script_id\">Script</a>: </td><td align=left><select size=1 name=script_id>\n";
	echo "$scripts_list";
	echo "<option selected value=\"$script_id\">$script_id - $scriptname_list[$script_id]</option>\n";
	echo "</select>$NWB#vicidial_inbound_groups-ingroup_script$NWE</td></tr>\n";
	echo "<tr bgcolor=#B6D3FC><td align=right>Κατά την έναρξη κλήσης: </td><td align=left><select size=1 name=get_call_launch><option selected>NONE</option><option>SCRIPT</option><option>WEBFORM</option><option selected>$get_call_launch</option></select>$NWB#vicidial_inbound_groups-get_call_launch$NWE</td></tr>\n";

	echo "<tr bgcolor=#B6D3FC><td align=right>DTMF Μεταφοράς-Συνδ 1: </td><td align=left><input type=text name=xferconf_a_dtmf size=20 maxlength=50 value=\"$xferconf_a_dtmf\">$NWB#vicidial_inbound_groups-xferconf_a_dtmf$NWE</td></tr>\n";

	echo "<tr bgcolor=#B6D3FC><td align=right>Αριθμός Μεταφοράς-Συνδ 1: </td><td align=left><input type=text name=xferconf_a_number size=20 maxlength=50 value=\"$xferconf_a_number\">$NWB#vicidial_inbound_groups-xferconf_a_dtmf$NWE</td></tr>\n";

	echo "<tr bgcolor=#B6D3FC><td align=right>DTMF Μεταφοράς-Συνδ 2: </td><td align=left><input type=text name=xferconf_b_dtmf size=20 maxlength=50 value=\"$xferconf_b_dtmf\">$NWB#vicidial_inbound_groups-xferconf_a_dtmf$NWE</td></tr>\n";

	echo "<tr bgcolor=#B6D3FC><td align=right>Αριθμός Μεταφοράς-Συνδ 2: </td><td align=left><input type=text name=xferconf_b_number size=20 maxlength=50 value=\"$xferconf_b_number\">$NWB#vicidial_inbound_groups-xferconf_a_dtmf$NWE</td></tr>\n";

	echo "<tr bgcolor=#B6D3FC><td align=right>Δευτερ. Εγκαταλ. Κλήσης: </td><td align=left><input type=text name=drop_call_seconds size=5 maxlength=4 value=\"$drop_call_seconds\">$NWB#vicidial_inbound_groups-drop_call_seconds$NWE</td></tr>\n";

	echo "<tr bgcolor=#B6D3FC><td align=right>ΦΩΝΗΤΙΚΟ ΤΑΧΥΔΡΟΜΕΙΟ: </td><td align=left><input type=text name=voicemail_ext size=10 maxlength=10 value=\"$voicemail_ext\">$NWB#vicidial_inbound_groups-voicemail_ext$NWE</td></tr>\n";

	echo "<tr bgcolor=#B6D3FC><td align=right>Χρήση μηνύματος Εγκατάλειψης: </td><td align=left><select size=1 name=drop_message><option>Y</option><option>N</option><option SELECTED>$drop_message</option></select>$NWB#vicidial_inbound_groups-drop_message$NWE</td></tr>\n";

	echo "<tr bgcolor=#B6D3FC><td align=right>Εσωτ. Σύνδεση Εγκατάλειψης: </td><td align=left><input type=text name=drop_exten size=10 maxlength=20 value=\"$drop_exten\">$NWB#vicidial_inbound_groups-drop_exten$NWE</td></tr>\n";


	echo "<tr bgcolor=#B6D3FC><td align=center colspan=2><input type=submit name=ΕΠΙΒΕΒΑΙΩΣΗ value=ΕΠΙΒΕΒΑΙΩΣΗ></td></tr>\n";
	echo "</TABLE></center>\n";

	echo "</table></center><br>\n";

	echo "<a href=\"./AST_CLOSERstats.php?group=$group_id\">Click here to see a report for this campaign</a><BR><BR>\n";

	echo "<center><b>\n";

	if ($LOGdelete_ingroups > 0)
		{
		echo "<br><br><a href=\"$PHP_SELF?ADD=53&campaign_id=$group_id&stage=IN\">EMERGENCY VDAC CLEAR FOR THIS IN-GROUP</a><BR><BR>\n";
		echo "<br><br><a href=\"$PHP_SELF?ADD=5111&group_id=$group_id\">ΔΙΑΓΡΑΨΕ ΑΥΤΗΝ ΤΗΝ ΕΙΣ-ΟΜΑΔΑ</a>\n";
		}
	}
	else
	{
	echo "Δεν έχετε την άδεια να δείτε αυτήν την σελίδα\n";
	exit;
	}
}



######################
# ADD=31111 modify remote agents info in the system
######################

if ($ADD==31111)
{
	if ($LOGmodify_remoteagents==1)
	{
	echo "<TABLE><TR><TD>\n";
	echo "<FONT FACE=\"ARIAL,HELVETICA\" COLOR=BLACK SIZE=2>";

	$stmt="SELECT * from vicidial_remote_agents where remote_agent_id='$remote_agent_id';";
	$rslt=mysql_query($stmt, $link);
	$row=mysql_fetch_row($rslt);
	$remote_agent_id =	$row[0];
	$user_start =		$row[1];
	$number_of_lines =	$row[2];
	$server_ip =		$row[3];
	$conf_exten =		$row[4];
	$status =			$row[5];
	$campaign_id =		$row[6];

	echo "<br>ΤΡΟΠΟΠΟΙΗΣΗ ΚΑΤΑΧΩΡΗΣΗΣ ΑΠΟΜΑΚΡΥΣΜΕΝΩΝ ΧΕΙΡΙΣΤΩΝ: $row[0]<form action=$PHP_SELF method=POST>\n";
	echo "<input type=hidden name=ADD value=41111>\n";
	echo "<input type=hidden name=remote_agent_id value=\"$row[0]\">\n";
	echo "<center><TABLE width=$section_width cellspacing=3>\n";
	echo "<tr bgcolor=#B6D3FC><td align=right>ID Χρήστη Ξεκινά: </td><td align=left><input type=text name=user_start size=6 maxlength=6 value=\"$user_start\"> (μόνο αριθμοί, incremented)$NWB#vicidial_remote_agents-user_start$NWE</td></tr>\n";
	echo "<tr bgcolor=#B6D3FC><td align=right>Αριθμός Γραμμών: </td><td align=left><input type=text name=number_of_lines size=3 maxlength=3 value=\"$number_of_lines\"> (μόνο αριθμοί)$NWB#vicidial_remote_agents-number_of_lines$NWE</td></tr>\n";
	echo "<tr bgcolor=#B6D3FC><td align=right>IP Διακομιστή: </td><td align=left><select size=1 name=server_ip>\n";
	echo "$servers_list";
	echo "<option SELECTED>$row[3]</option>\n";
	echo "</select>$NWB#vicidial_remote_agents-server_ip$NWE</td></tr>\n";
	echo "<tr bgcolor=#B6D3FC><td align=right>Εξωτερική Τηλ. Σύνδεση: </td><td align=left><input type=text name=conf_exten size=20 maxlength=20 value=\"$conf_exten\"> (ο αριθμός που κλήθηκε από το πλάνο κλήσεων για να καλέσει τους χειριστές)$NWB#vicidial_remote_agents-conf_exten$NWE</td></tr>\n";
	echo "<tr bgcolor=#B6D3FC><td align=right>Κατάσταση:</td><td align=left><select size=1 name=status><option SELECTED>ΕΝΕΡΓΟ</option><option>INACTIVE</option><option SELECTED>$status</option></select>$NWB#vicidial_remote_agents-status$NWE</td></tr>\n";
	echo "<tr bgcolor=#B6D3FC><td align=right>Εκστρατεία: </td><td align=left><select size=1 name=campaign_id>\n";
	echo "$campaigns_list";
	echo "<option SELECTED>$campaign_id</option>\n";
	echo "</select>$NWB#vicidial_remote_agents-campaign_id$NWE</td></tr>\n";
	echo "<tr bgcolor=#B6D3FC><td align=right>Εισερχόμενες Ομάδες: </td><td align=left>\n";
	echo "$groups_list";
	echo "$NWB#vicidial_remote_agents-closer_campaigns$NWE</td></tr>\n";
	echo "<tr bgcolor=#B6D3FC><td align=center colspan=2><input type=submit name=ΕΠΙΒΕΒΑΙΩΣΗ value=ΕΠΙΒΕΒΑΙΩΣΗ></td></tr>\n";
	echo "</TABLE></center>\n";
	echo "ΣΗΜΕΙΩΣΗ: Μπορεί να διαρκέσει και 30 δευτερόλεπτα για να καταχωρηθούν οι αλλαγές της οθόνης\n";


	if ($LOGdelete_remote_agents > 0)
		{
		echo "<br><br><a href=\"$PHP_SELF?ADD=51111&remote_agent_id=$remote_agent_id\">ΔΙΑΓΡΑΨΕ ΑΥΤΟΝ ΤΟΝ ΑΠΟΜΑΚΡΥΣΜΕΝΟ ΧΕΙΡΙΣΤΗ</a>\n";
		}
	}
	else
	{
	echo "Δεν έχετε την άδεια να δείτε αυτήν την σελίδα\n";
	exit;
	}
}


######################
# ADD=311111 modify user group info in the system
######################

if ($ADD==311111)
{
	if ($LOGmodify_usergroups==1)
	{
	echo "<TABLE><TR><TD>\n";
	echo "<FONT FACE=\"ARIAL,HELVETICA\" COLOR=BLACK SIZE=2>";

	$stmt="SELECT * from vicidial_user_groups where user_group='$user_group';";
	$rslt=mysql_query($stmt, $link);
	$row=mysql_fetch_row($rslt);
	$user_group =		$row[0];
	$group_name =		$row[1];
	echo "<FONT FACE=\"ARIAL,HELVETICA\" COLOR=BLACK SIZE=2>";

	echo "<br>ΤΡΟΠΟΠΟΙΗΣΗ ΚΑΤΑΧΩΡΗΣΗΣ ΟΜΑΔΑΣ ΧΡΗΣΤΩΝ<form action=$PHP_SELF method=POST>\n";
	echo "<input type=hidden name=ADD value=411111>\n";
	echo "<input type=hidden name=OLDuser_group value=\"$user_group\">\n";
	echo "<center><TABLE width=$section_width cellspacing=3>\n";
	echo "<tr bgcolor=#B6D3FC><td align=right>Ομάδα:</td><td align=left><input type=text name=user_group size=15 maxlength=20 value=\"$user_group\"> (όχι κενά ή στίξη)$NWB#vicidial_user_groups-user_group$NWE</td></tr>\n";
	echo "<tr bgcolor=#B6D3FC><td align=right>Περιγραφή:</td><td align=left><input type=text name=group_name size=40 maxlength=40 value=\"$group_name\"> (περιγραφή ομάδας)$NWB#vicidial_user_groups-group_name$NWE</td></tr>\n";
	echo "<tr bgcolor=#B6D3FC><td align=right>Επιτρεπόμενες Εκστρατείες: </td><td align=left>\n";
	echo "$campaigns_list";
	echo "$NWB#vicidial_user_groups-allowed_campaigns$NWE</td></tr>\n";
	echo "<tr bgcolor=#B6D3FC><td align=center colspan=2><input type=submit name=ΕΠΙΒΕΒΑΙΩΣΗ value=ΕΠΙΒΕΒΑΙΩΣΗ></td></tr>\n";
	echo "</TABLE></center>\n";


	### list of users in this user group

		$active_confs = 0;
		$stmt="SELECT user,full_name,user_level from vicidial_users where user_group='$user_group'";
		$rsltx=mysql_query($stmt, $link);
		$users_to_print = mysql_num_rows($rsltx);

		echo "<center>\n";
		echo "<br><b>ΧΡΗΣΤΕΣ ΜΕΣΑ ΣΕ ΑΥΤΗΝ ΤΗΝ ΟΜΑΔΑ ΧΡΗΣΤΩΝ : $users_to_print</b><br>\n";
		echo "<TABLE width=400 cellspacing=3>\n";
		echo "<tr><td>USER</td><td>FULL NAME</td><td>LEVEL</td></tr>\n";

		$o=0;
		while ($users_to_print > $o) 
		{
			$rowx=mysql_fetch_row($rsltx);
			$o++;

		if (eregi("1$|3$|5$|7$|9$", $o))
			{$bgcolor='bgcolor="#B9CBFD"';} 
		else
			{$bgcolor='bgcolor="#9BB9FB"';}

		echo "<tr $bgcolor>\n";
		echo "<td><font size=1><a href=\"$PHP_SELF?ADD=3&user=$rowx[0]\">$rowx[0]</a></td>\n";
		echo "<td><font size=1>$rowx[1]</td>\n";
		echo "<td><font size=1>$rowx[2]</td>\n";
		echo "</tr>\n";
		}

	echo "</table></center><br>\n";



	echo "<br><br><a href=\"$PHP_SELF?ADD=8111&user_group=$user_group\">Click here to see all CallBack Holds in this user group</a><BR><BR>\n";

	if ($LOGdelete_user_groups > 0)
		{
		echo "<br><br><a href=\"$PHP_SELF?ADD=511111&user_group=$user_group\">ΔΙΑΓΡΑΨΕ ΑΥΤΗΝ ΤΗΝ ΟΜΑΔΑ ΧΡΗΣΤΩΝ</a>\n";
		}
	}
	else
	{
	echo "Δεν έχετε την άδεια να δείτε αυτήν την σελίδα\n";
	exit;
	}
}


######################
# ADD=3111111 modify script info in the system
######################

if ($ADD==3111111)
{
	if ($LOGmodify_scripts==1)
	{
	echo "<TABLE><TR><TD>\n";
	echo "<FONT FACE=\"ARIAL,HELVETICA\" COLOR=BLACK SIZE=2>";

	$stmt="SELECT * from vicidial_scripts where script_id='$script_id';";
	$rslt=mysql_query($stmt, $link);
	$row=mysql_fetch_row($rslt);
	$script_name =		$row[1];
	$script_comments =	$row[2];
	$script_text =		$row[3];
	$active =			$row[4];
	echo "<FONT FACE=\"ARIAL,HELVETICA\" COLOR=BLACK SIZE=2>";

	echo "<br>ΤΡΟΠΟΠΟΙΗΣΤΕ ΕΝΑΝ ΒΟΗΘΟ<form name=scriptForm action=$PHP_SELF method=POST>\n";
	echo "<input type=hidden name=ADD value=4111111>\n";
	echo "<input type=hidden name=script_id value=\"$script_id\">\n";
	echo "<tr bgcolor=#B6D3FC><td align=right>Ταυτότητα χειρογράφων:: </td><td align=left><B>$script_id</B>$NWB#vicidial_scripts-script_name$NWE</td></tr>\n";
	echo "<tr bgcolor=#B6D3FC><td align=right>Όνομα χειρογράφων: </td><td align=left><input type=text name=script_name size=40 maxlength=50 value=\"$script_name\"> (τίτλος του βοηθού)$NWB#vicidial_scripts-script_name$NWE</td></tr>\n";
	echo "<tr bgcolor=#B6D3FC><td align=right>Σχόλια χειρόγραφου: </td><td align=left><input type=text name=script_comments size=50 maxlength=255 value=\"$script_comments\"> $NWB#vicidial_scripts-script_comments$NWE</td></tr>\n";
	echo "<tr bgcolor=#B6D3FC><td align=right>Ενεργή:</td><td align=left><select size=1 name=active><option SELECTED>Y</option><option>N</option><option selected>$active</option></select>$NWB#vicidial_scripts-active$NWE</td></tr>\n";
	echo "<tr bgcolor=#B6D3FC><td align=right>Κείμενο χειρόγραφου: <BR><BR><B><a href=\"javascript:openNewWindow('$PHP_SELF?ADD=7111111&script_id=$script_id')\">Προεπισκόπιση Βοηθού</a></B> </td><td align=left>";
	# BEGIN Insert Field
	echo "<select id=\"selectedField\" name=\"selectedField\">";
	echo "<option>vendor_lead_code</option>";
	echo "<option>source_id</option>";
	echo "<option>list_id</option>";
	echo "<option>gmt_offset_now</option>";
	echo "<option>called_since_last_reset</option>";
	echo "<option>phone_code</option>";
	echo "<option>phone_number</option>";
	echo "<option>title</option>";
	echo "<option>first_name</option>";
	echo "<option>middle_initial</option>";
	echo "<option>last_name</option>";
	echo "<option>address1</option>";
	echo "<option>address2</option>";
	echo "<option>address3</option>";
	echo "<option>city</option>";
	echo "<option>state</option>";
	echo "<option>province</option>";
	echo "<option>postal_code</option>";
	echo "<option>country_code</option>";
	echo "<option>gender</option>";
	echo "<option>date_of_birth</option>";
	echo "<option>alt_phone</option>";
	echo "<option>email</option>";
	echo "<option>security_phrase</option>";
	echo "<option>comments</option>";
	echo "<option>lead_id</option>";
	echo "<option>campaign</option>";
	echo "<option>phone_login</option>";
	echo "<option>group</option>";
	echo "<option>channel_group</option>";
	echo "<option>SQLdate</option>";
	echo "<option>epoch</option>";
	echo "<option>uniqueid</option>";
	echo "<option>customer_zap_channel</option>";
	echo "<option>server_ip</option>";
	echo "<option>SIPexten</option>";
	echo "<option>session_id</option>";
	echo "</select>";
	echo "<input type=\"button\" name=\"insertField\" value=\"Insert\" onClick=\"scriptInsertField();\"><BR>";
	# END Insert Field
	echo "<TEXTAREA NAME=script_text ROWS=20 COLS=50>$script_text</TEXTAREA> $NWB#vicidial_scripts-script_text$NWE</td></tr>\n";
	echo "<tr bgcolor=#B6D3FC><td align=center colspan=2><input type=submit name=ΕΠΙΒΕΒΑΙΩΣΗ value=ΕΠΙΒΕΒΑΙΩΣΗ></td></tr>\n";
	echo "</TABLE></center>\n";

	if ($LOGdelete_scripts > 0)
		{
		echo "<br><br><a href=\"$PHP_SELF?ADD=5111111&script_id=$script_id\">ΔΙΑΓΡΑΨΕ ΑΥΤΟΝ ΤΟΝ ΒΟΗΘΟ</a>\n";
		}
	}
	else
	{
	echo "Δεν έχετε την άδεια να δείτε αυτήν την σελίδα\n";
	exit;
	}
}


######################
# ADD=31111111 modify filter info in the system
######################

if ($ADD==31111111)
{
	if ($LOGmodify_filters==1)
	{
	echo "<TABLE><TR><TD>\n";
	echo "<FONT FACE=\"ARIAL,HELVETICA\" COLOR=BLACK SIZE=2>";

	$stmt="SELECT * from vicidial_lead_filters where lead_filter_id='$lead_filter_id';";
	$rslt=mysql_query($stmt, $link);
	$row=mysql_fetch_row($rslt);
	$lead_filter_name =		$row[1];
	$lead_filter_comments =	$row[2];
	$lead_filter_sql =		$row[3];
	echo "<FONT FACE=\"ARIAL,HELVETICA\" COLOR=BLACK SIZE=2>";

	echo "<br>ΤΡΟΠΟΠΟΙΗΣΗ ΕΝΟΣ ΦΙΛΤΡΟΥ<form action=$PHP_SELF method=POST>\n";
	echo "<input type=hidden name=ADD value=41111111>\n";
	echo "<input type=hidden name=lead_filter_id value=\"$lead_filter_id\">\n";
	echo "<tr bgcolor=#B6D3FC><td align=right>ID Φίλτρου: </td><td align=left><B>$lead_filter_id</B>$NWB#vicidial_lead_filters-lead_filter_id$NWE</td></tr>\n";
	echo "<tr bgcolor=#B6D3FC><td align=right>Όνομα Φίλτρου:</td><td align=left><input type=text name=lead_filter_name size=40 maxlength=50 value=\"$lead_filter_name\"> (σύντομη περιγραφή του φίλτρου)$NWB#vicidial_lead_filters-lead_filter_name$NWE</td></tr>\n";
	echo "<tr bgcolor=#B6D3FC><td align=right>Σχόλια Φίλτρου: </td><td align=left><input type=text name=lead_filter_comments size=50 maxlength=255 value=\"$lead_filter_comments\"> $NWB#vicidial_lead_filters-lead_filter_comments$NWE</td></tr>\n";
	echo "<tr bgcolor=#B6D3FC><td align=right>SQL Φίλτρου: </td><td align=left><TEXTAREA NAME=lead_filter_sql ROWS=20 COLS=50>$lead_filter_sql</TEXTAREA> $NWB#vicidial_lead_filters-lead_filter_sql$NWE</td></tr>\n";
	echo "<tr bgcolor=#B6D3FC><td align=center colspan=2><input type=submit name=ΕΠΙΒΕΒΑΙΩΣΗ value=ΕΠΙΒΕΒΑΙΩΣΗ></td></tr>\n";
	echo "</TABLE></center></form>\n";

		##### get campaigns listing for dynamic pulldown
		$stmt="SELECT campaign_id,campaign_name from vicidial_campaigns order by campaign_id";
		$rslt=mysql_query($stmt, $link);
		$campaigns_to_print = mysql_num_rows($rslt);
		$campaigns_list='';

		$o=0;
		while ($campaigns_to_print > $o)
			{
			$rowx=mysql_fetch_row($rslt);
			$campaigns_list .= "<option value=\"$rowx[0]\">$rowx[0] - $rowx[1]</option>\n";
			$o++;
			}

	echo "<BR><BR>";
	echo "<br>ΕΛΕΓΧΟΣ ΣΤΗΝ ΕΚΣΤΡΑΤΕΙΑ: <form action=$PHP_SELF method=POST target=\"_blank\">\n";
	echo "<input type=hidden name=lead_filter_id value=\"$lead_filter_id\">\n";
	echo "<input type=hidden name=ADD value=\"73\">\n";
	echo "<select size=1 name=campaign_id>\n";
	echo "$campaigns_list";
	echo "</select>\n";
	echo "<input type=submit name=ΕΠΙΒΕΒΑΙΩΣΗ value=ΕΠΙΒΕΒΑΙΩΣΗ>\n";


	if ($LOGdelete_filters > 0)
		{
		echo "<br><br><a href=\"$PHP_SELF?ADD=51111111&lead_filter_id=$lead_filter_id\">ΔΙΑΓΡΑΦΗ ΤΟΥ ΦΙΛΤΡΟΥ</a>\n";
		}
	}
	else
	{
	echo "Δεν έχετε την άδεια να δείτε αυτήν την σελίδα\n";
	exit;
	}
}


######################
# ADD=321111111 modify call time definition info in the system
######################

if ($ADD==321111111)
{
if ($LOGmodify_call_times==1)
{

if ( ($stage=="ADD") and (strlen($state_rule)>0) )
	{
	$stmt="SELECT ct_state_call_times from vicidial_call_times where call_time_id='$call_time_id';";
	$rslt=mysql_query($stmt, $link);
	$row=mysql_fetch_row($rslt);
	$ct_state_call_times = $row[0];

	if (eregi("\|$",$ct_state_call_times))
		{$ct_state_call_times = "$ct_state_call_times$state_rule\|";}
	else
		{$ct_state_call_times = "$ct_state_call_times\|$state_rule\|";}
	$stmt="UPDATE vicidial_call_times set ct_state_call_times='$ct_state_call_times' where call_time_id='$call_time_id';";
	$rslt=mysql_query($stmt, $link);
	echo "Προσθήκη Κανόνα Κατάστασης: $state_rule<BR>\n";
	}
if ( ($stage=="REMOVE") and (strlen($state_rule)>0) )
	{
	$stmt="SELECT ct_state_call_times from vicidial_call_times where call_time_id='$call_time_id';";
	$rslt=mysql_query($stmt, $link);
	$row=mysql_fetch_row($rslt);
	$ct_state_call_times = $row[0];

	$ct_state_call_times = eregi_replace("\|$state_rule\|",'|',$ct_state_call_times);
	$stmt="UPDATE vicidial_call_times set ct_state_call_times='$ct_state_call_times' where call_time_id='$call_time_id';";
	$rslt=mysql_query($stmt, $link);
	echo "Απομάκρυνση Κανόνα Κατάστασης: $state_rule<BR>\n";
	}

$ADD=311111111;
}
else
{
echo "Δεν έχετε το δικαίωμα για να δείτε την σελίδα. Παρακαλώ επιστρέψτε.";
}

}


######################
# ADD=311111111 modify call time definition info in the system
######################

if ($ADD==311111111)
{

if ($LOGmodify_call_times==1)
{
echo "<TABLE><TR><TD>\n";
	echo "<FONT FACE=\"ARIAL,HELVETICA\" COLOR=BLACK SIZE=2>";

	$stmt="SELECT * from vicidial_call_times where call_time_id='$call_time_id';";
	$rslt=mysql_query($stmt, $link);
	$row=mysql_fetch_row($rslt);
	$call_time_name =		$row[1];
	$call_time_comments =	$row[2];
	$ct_default_start =		$row[3];
	$ct_default_stop =		$row[4];
	$ct_sunday_start =		$row[5];
	$ct_sunday_stop =		$row[6];
	$ct_monday_start =		$row[7];
	$ct_monday_stop =		$row[8];
	$ct_tuesday_start =		$row[9];
	$ct_tuesday_stop =		$row[10];
	$ct_wednesday_start =	$row[11];
	$ct_wednesday_stop =	$row[12];
	$ct_thursday_start =	$row[13];
	$ct_thursday_stop =		$row[14];
	$ct_friday_start =		$row[15];
	$ct_friday_stop =		$row[16];
	$ct_saturday_start =	$row[17];
	$ct_saturday_stop =		$row[18];
	$ct_state_call_times =	$row[19];

echo "<FONT FACE=\"ARIAL,HELVETICA\" COLOR=BLACK SIZE=2>";

echo "<br>ΤΡΟΠΟΠΟΙΗΣΗ ΧΡΟΝΟΥ ΚΛΗΣΗΣ<form action=$PHP_SELF method=POST>\n";
echo "<input type=hidden name=ADD value=411111111>\n";
echo "<input type=hidden name=call_time_id value=\"$call_time_id\">\n";
echo "<tr bgcolor=#B6D3FC><td align=right>ID Χρόνου Κλήσης: </td><td align=left colspan=3><B>$call_time_id</B>$NWB#vicidial_call_times-call_time_id$NWE</td></tr>\n";
echo "<tr bgcolor=#B6D3FC><td align=right>Ονομα Χρόνου Κλήσης: </td><td align=left colspan=3><input type=text name=call_time_name size=40 maxlength=50 value=\"$call_time_name\"> (σύντομη περιγραφή του χρόνου κλήσης)$NWB#vicidial_call_times-call_time_name$NWE</td></tr>\n";
echo "<tr bgcolor=#B6D3FC><td align=right>Σχόλια Χρόνου Κλήσης: </td><td align=left colspan=3><input type=text name=call_time_comments size=50 maxlength=255 value=\"$call_time_comments\"> $NWB#vicidial_call_times-call_time_comments$NWE</td></tr>\n";
echo "<tr bgcolor=#B6D3FC><td align=right>Προκαθορσμένη Εκκίνηση</td><td align=left><input type=text name=ct_default_start size=5 maxlength=4 value=\"$ct_default_start\"> </td><td align=right>Προκαθορσμένη Παύση:</td><td align=left><input type=text name=ct_default_stop size=5 maxlength=4 value=\"$ct_default_stop\"> $NWB#vicidial_call_times-ct_default_start$NWE</td></tr>\n";
echo "<tr bgcolor=#B6D3FC><td align=right>Κυριακή Εκκίνηση:</td><td align=left><input type=text name=ct_sunday_start size=5 maxlength=4 value=\"$ct_sunday_start\"> </td><td align=right>Κυριακή Παύση:</td><td align=left><input type=text name=ct_sunday_stop size=5 maxlength=4 value=\"$ct_sunday_stop\"> $NWB#vicidial_call_times-ct_sunday_start$NWE</td></tr>\n";
echo "<tr bgcolor=#B6D3FC><td align=right>Δευτέρα Εκκίνηση:</td><td align=left><input type=text name=ct_monday_start size=5 maxlength=4 value=\"$ct_monday_start\"> </td><td align=right>Δευτέρα Παύση:</td><td align=left><input type=text name=ct_monday_stop size=5 maxlength=4 value=\"$ct_monday_stop\"> $NWB#vicidial_call_times-ct_sunday_start$NWE</td></tr>\n";
echo "<tr bgcolor=#B6D3FC><td align=right>Τρίτη Εκκίνηση:</td><td align=left><input type=text name=ct_tuesday_start size=5 maxlength=4 value=\"$ct_tuesday_start\"> </td><td align=right>Τρίτη Παύση:</td><td align=left><input type=text name=ct_tuesday_stop size=5 maxlength=4 value=\"$ct_tuesday_stop\"> $NWB#vicidial_call_times-ct_sunday_start$NWE</td></tr>\n";
echo "<tr bgcolor=#B6D3FC><td align=right>Wednesday Start:</td><td align=left><input type=text name=ct_wednesday_start size=5 maxlength=4 value=\"$ct_wednesday_start\"> </td><td align=right>Τετάρτη Παύση:</td><td align=left><input type=text name=ct_wednesday_stop size=5 maxlength=4 value=\"$ct_wednesday_stop\"> $NWB#vicidial_call_times-ct_sunday_start$NWE</td></tr>\n";
echo "<tr bgcolor=#B6D3FC><td align=right>Πέμπτη Εκκίνηση:</td><td align=left><input type=text name=ct_thursday_start size=5 maxlength=4 value=\"$ct_thursday_start\"> </td><td align=right>Πέμπτη Παύση:</td><td align=left><input type=text name=ct_thursday_stop size=5 maxlength=4 value=\"$ct_thursday_stop\"> $NWB#vicidial_call_times-ct_sunday_start$NWE</td></tr>\n";
echo "<tr bgcolor=#B6D3FC><td align=right>Παρασκευή Εκκίνηση:</td><td align=left><input type=text name=ct_friday_start size=5 maxlength=4 value=\"$ct_friday_start\"> </td><td align=right>Παρασκευή Παύση:</td><td align=left><input type=text name=ct_friday_stop size=5 maxlength=4 value=\"$ct_friday_stop\"> $NWB#vicidial_call_times-ct_sunday_start$NWE</td></tr>\n";
echo "<tr bgcolor=#B6D3FC><td align=right>Σάββατο Εκκίνηση:</td><td align=left><input type=text name=ct_saturday_start size=5 maxlength=4 value=\"$ct_saturday_start\"> </td><td align=right>Σάββατο Παύση:</td><td align=left><input type=text name=ct_saturday_stop size=5 maxlength=4 value=\"$ct_saturday_stop\"> $NWB#vicidial_call_times-ct_sunday_start$NWE</td></tr>\n";
echo "<tr bgcolor=#B6D3FC><td align=center colspan=4><input type=submit name=ΕΠΙΒΕΒΑΙΩΣΗ value=ΕΠΙΒΕΒΑΙΩΣΗ></FORM></td></tr>\n";

$ct_srs=1;
$b=0;
$srs_SQL ='';
if (strlen($ct_state_call_times)>2)
	{
	$state_rules = explode('|',$ct_state_call_times);
	$ct_srs = ((count($state_rules)) - 1);
	}
echo "<tr bgcolor=#B6D3FC><td align=center rowspan=$ct_srs>Ενεργοί Ορισμοί Χρόνου Κλήσης Κατάστασης για αυτή την Εγγραφή: </td>\n";
echo "<td align=center colspan=3>&nbsp;</td></tr>\n";
while($ct_srs >= $b)
	{
	if (strlen($state_rules[$b])>0)
		{
		$stmt="SELECT state_call_time_state,state_call_time_name from vicidial_state_call_times where state_call_time_id='$state_rules[$b]';";
		$rslt=mysql_query($stmt, $link);
		$row=mysql_fetch_row($rslt);
		echo "<tr bgcolor=#B6D3FC><td align=right><a href=\"$PHP_SELF?ADD=3111111111&call_time_id=$state_rules[$b]\">$state_rules[$b] </a> - <a href=\"$PHP_SELF?ADD=321111111&call_time_id=$call_time_id&state_rule=$state_rules[$b]&stage=REMOVE\">REMOVE </a></td><td align=left colspan=2>$row[0] - $row[1]</td></tr>\n";
		$srs_SQL .= "'$state_rules[$b]',";
		$srs_state_SQL .= "'$row[0]',";
		}
	$b++;
	}
if (strlen($srs_SQL)>2)
	{
	$srs_SQL = "$srs_SQL''";
	$srs_state_SQL = "$srs_state_SQL''";
	$srs_SQL = "where state_call_time_id NOT IN($srs_SQL) and state_call_time_state NOT IN($srs_state_SQL)";
	}
else
	{$srs_SQL='';}
$stmt="SELECT state_call_time_id,state_call_time_name from vicidial_state_call_times $srs_SQL order by state_call_time_id;";
$rslt=mysql_query($stmt, $link);
$sct_to_print = mysql_num_rows($rslt);
$sct_list='';

$o=0;
while ($sct_to_print > $o) {
	$rowx=mysql_fetch_row($rslt);
	$sct_list .= "<option value=\"$rowx[0]\">$rowx[0] - $rowx[1]</option>\n";
	$o++;
}
echo "<tr bgcolor=#B6D3FC><td align=right><form action=$PHP_SELF method=POST>\n";
echo "<input type=hidden name=ADD value=321111111>\n";
echo "<input type=hidden name=stage value=\"ADD\">\n";
echo "<input type=hidden name=call_time_id value=\"$call_time_id\">\n";
echo "Add state call time rule: </td><td align=left colspan=2><select size=1 name=state_rule>\n";
echo "$sct_list";
echo "</select></td>\n";
echo "<td align=center colspan=4><input type=submit name=ΕΠΙΒΕΒΑΙΩΣΗ value=ΕΠΙΒΕΒΑΙΩΣΗ></FORM></td></tr>\n";

echo "</TABLE><BR><BR>\n";
echo "<B>ΕΚΣΤΑΤΕΙΕΣ ΠΟΥ ΧΡΗΣΙΜΟΠΟΙΟΥΝ ΑΥΤΟ ΤΟΝ ΧΡΟΝΟ ΚΛΗΣΗΣ:</B><BR>\n";
echo "<TABLE>\n";

	$stmt="SELECT campaign_id,campaign_name from vicidial_campaigns where local_call_time='$call_time_id';";
	$rslt=mysql_query($stmt, $link);
	$camps_to_print = mysql_num_rows($rslt);
	$o=0;
	while ($camps_to_print > $o) {
		$row=mysql_fetch_row($rslt);
		$CT_camp_id =		$row[1];
		$CT_camp_name =		$row[2];
		echo "<TR><TD><a href=\"$PHP_SELF?ADD=31&campaign_id=$row[0]\">$row[0] </a></TD><TD> $row[1]<BR></TD></TR>\n";
		$o++;
	}

echo "</TABLE>\n";
echo "</center><BR><BR>\n";

if ($LOGdelete_call_times > 0)
	{
	echo "<br><br><a href=\"$PHP_SELF?ADD=511111111&call_time_id=$call_time_id\">ΔΙΑΓΡΑΦΗ ΟΡΙΣΜΟΥ ΧΡΟΝΟΥ ΚΛΗΣΗΣ</a>\n";
	}
}
else
{
echo "Δεν έχετε το δικαίωμα για να δείτε την σελίδα. Παρακαλώ επιστρέψτε.";
}

}


######################
# ADD=3111111111 modify state call time definition info in the system
######################

if ($ADD==3111111111)
{

if ($LOGmodify_call_times==1)
{
echo "<TABLE><TR><TD>\n";
	echo "<FONT FACE=\"ARIAL,HELVETICA\" COLOR=BLACK SIZE=2>";

	$stmt="SELECT * from vicidial_state_call_times where state_call_time_id='$call_time_id';";
	$rslt=mysql_query($stmt, $link);
	$row=mysql_fetch_row($rslt);
	$state_call_time_state =$row[1];
	$call_time_name =		$row[2];
	$call_time_comments =	$row[3];
	$ct_default_start =		$row[4];
	$ct_default_stop =		$row[5];
	$ct_sunday_start =		$row[6];
	$ct_sunday_stop =		$row[7];
	$ct_monday_start =		$row[8];
	$ct_monday_stop =		$row[9];
	$ct_tuesday_start =		$row[10];
	$ct_tuesday_stop =		$row[11];
	$ct_wednesday_start =	$row[12];
	$ct_wednesday_stop =	$row[13];
	$ct_thursday_start =	$row[14];
	$ct_thursday_stop =		$row[15];
	$ct_friday_start =		$row[16];
	$ct_friday_stop =		$row[17];
	$ct_saturday_start =	$row[18];
	$ct_saturday_stop =		$row[19];

echo "<FONT FACE=\"ARIAL,HELVETICA\" COLOR=BLACK SIZE=2>";

echo "<br>ΤΡΟΠΟΠΟΙΗΣΗ ΧΡΟΝΟΥ ΚΛΗΣΗΣ ΚΑΤΑΣΤΑΣΗΣ<form action=$PHP_SELF method=POST>\n";
echo "<input type=hidden name=ADD value=4111111111>\n";
echo "<input type=hidden name=call_time_id value=\"$call_time_id\">\n";
echo "<tr bgcolor=#B6D3FC><td align=right>ID Χρόνου Κλήσης: </td><td align=left colspan=3><B>$call_time_id</B>$NWB#vicidial_call_times-call_time_id$NWE</td></tr>\n";
echo "<tr bgcolor=#B6D3FC><td align=right>State Call Time State: </td><td align=left colspan=3><input type=text name=state_call_time_state size=4 maxlength=2 value=\"$state_call_time_state\"> $NWB#vicidial_call_times-state_call_time_state$NWE</td></tr>\n";
echo "<tr bgcolor=#B6D3FC><td align=right>Ονομα Χρόνου Κλήσης Κατάτασης: </td><td align=left colspan=3><input type=text name=call_time_name size=40 maxlength=50 value=\"$call_time_name\"> (σύντομη περιγραφή του χρόνου κλήσης)$NWB#vicidial_call_times-call_time_name$NWE</td></tr>\n";
echo "<tr bgcolor=#B6D3FC><td align=right>Σχόλια Χρόνου Κλήσης Κατάστασης: </td><td align=left colspan=3><input type=text name=call_time_comments size=50 maxlength=255 value=\"$call_time_comments\"> $NWB#vicidial_call_times-call_time_comments$NWE</td></tr>\n";
echo "<tr bgcolor=#B6D3FC><td align=right>Προκαθορσμένη Εκκίνηση</td><td align=left><input type=text name=ct_default_start size=5 maxlength=4 value=\"$ct_default_start\"> </td><td align=right>Προκαθορσμένη Παύση:</td><td align=left><input type=text name=ct_default_stop size=5 maxlength=4 value=\"$ct_default_stop\"> $NWB#vicidial_call_times-ct_default_start$NWE</td></tr>\n";
echo "<tr bgcolor=#B6D3FC><td align=right>Κυριακή Εκκίνηση:</td><td align=left><input type=text name=ct_sunday_start size=5 maxlength=4 value=\"$ct_sunday_start\"> </td><td align=right>Κυριακή Παύση:</td><td align=left><input type=text name=ct_sunday_stop size=5 maxlength=4 value=\"$ct_sunday_stop\"> $NWB#vicidial_call_times-ct_sunday_start$NWE</td></tr>\n";
echo "<tr bgcolor=#B6D3FC><td align=right>Δευτέρα Εκκίνηση:</td><td align=left><input type=text name=ct_monday_start size=5 maxlength=4 value=\"$ct_monday_start\"> </td><td align=right>Δευτέρα Παύση:</td><td align=left><input type=text name=ct_monday_stop size=5 maxlength=4 value=\"$ct_monday_stop\"> $NWB#vicidial_call_times-ct_sunday_start$NWE</td></tr>\n";
echo "<tr bgcolor=#B6D3FC><td align=right>Τρίτη Εκκίνηση:</td><td align=left><input type=text name=ct_tuesday_start size=5 maxlength=4 value=\"$ct_tuesday_start\"> </td><td align=right>Τρίτη Παύση:</td><td align=left><input type=text name=ct_tuesday_stop size=5 maxlength=4 value=\"$ct_tuesday_stop\"> $NWB#vicidial_call_times-ct_sunday_start$NWE</td></tr>\n";
echo "<tr bgcolor=#B6D3FC><td align=right>Wednesday Start:</td><td align=left><input type=text name=ct_wednesday_start size=5 maxlength=4 value=\"$ct_wednesday_start\"> </td><td align=right>Τετάρτη Παύση:</td><td align=left><input type=text name=ct_wednesday_stop size=5 maxlength=4 value=\"$ct_wednesday_stop\"> $NWB#vicidial_call_times-ct_sunday_start$NWE</td></tr>\n";
echo "<tr bgcolor=#B6D3FC><td align=right>Πέμπτη Εκκίνηση:</td><td align=left><input type=text name=ct_thursday_start size=5 maxlength=4 value=\"$ct_thursday_start\"> </td><td align=right>Πέμπτη Παύση:</td><td align=left><input type=text name=ct_thursday_stop size=5 maxlength=4 value=\"$ct_thursday_stop\"> $NWB#vicidial_call_times-ct_sunday_start$NWE</td></tr>\n";
echo "<tr bgcolor=#B6D3FC><td align=right>Παρασκευή Εκκίνηση:</td><td align=left><input type=text name=ct_friday_start size=5 maxlength=4 value=\"$ct_friday_start\"> </td><td align=right>Παρασκευή Παύση:</td><td align=left><input type=text name=ct_friday_stop size=5 maxlength=4 value=\"$ct_friday_stop\"> $NWB#vicidial_call_times-ct_sunday_start$NWE</td></tr>\n";
echo "<tr bgcolor=#B6D3FC><td align=right>Σάββατο Εκκίνηση:</td><td align=left><input type=text name=ct_saturday_start size=5 maxlength=4 value=\"$ct_saturday_start\"> </td><td align=right>Σάββατο Παύση:</td><td align=left><input type=text name=ct_saturday_stop size=5 maxlength=4 value=\"$ct_saturday_stop\"> $NWB#vicidial_call_times-ct_sunday_start$NWE</td></tr>\n";

echo "<tr bgcolor=#B6D3FC><td align=center colspan=4><input type=submit name=ΕΠΙΒΕΒΑΙΩΣΗ value=ΕΠΙΒΕΒΑΙΩΣΗ></td></tr>\n";
echo "</TABLE><BR><BR>\n";
echo "<B>ΧΡΟΝΟΙ ΚΛΗΣΕΩΝ ΠΟΥ ΧΡΗΣΙΜΟΠΟΙΟΥΝ ΑΥΤΟ ΤΟΝ ΧΡΟΝΟ ΚΛΗΣΗΣ ΚΑΤΑΣΤΑΣΗΣ:</B><BR>\n";
echo "<TABLE>\n";

	$stmt="SELECT call_time_id,call_time_name from vicidial_call_times where ct_state_call_times LIKE \"%|$call_time_id|%\";";
	$rslt=mysql_query($stmt, $link);
	$camps_to_print = mysql_num_rows($rslt);
	$o=0;
	while ($camps_to_print > $o) {
		$row=mysql_fetch_row($rslt);
		echo "<TR><TD><a href=\"$PHP_SELF?ADD=311111111&call_time_id=$row[0]\">$row[0] </a></TD><TD> $row[1]<BR></TD></TR>\n";
		$o++;
	}

echo "</TABLE>\n";
echo "</center><BR><BR>\n";

if ($LOGdelete_call_times > 0)
	{
	echo "<br><br><a href=\"$PHP_SELF?ADD=5111111111&call_time_id=$call_time_id\">ΔΙΑΓΡΑΦΗ ΟΡΙΣΜΟΥ ΧΡΟΝΟΥ ΚΛΗΣΗΣ ΚΑΤΑΣΤΑΣΗΣ</a>\n";
	}

}
else
{
echo "Δεν έχετε το δικαίωμα για να δείτε την σελίδα. Παρακαλώ επιστρέψτε.";
}

}


######################
# ADD=31111111111 modify phone record in the system
######################

if ($ADD==31111111111)
{
	if ($LOGast_admin_access==1)
	{
	echo "<TABLE><TR><TD>\n";
	echo "<FONT FACE=\"ARIAL,HELVETICA\" COLOR=BLACK SIZE=2>";

	$stmt="SELECT * from phones where extension='$extension' and server_ip='$server_ip';";
	$rslt=mysql_query($stmt, $link);
	$row=mysql_fetch_row($rslt);

	echo "<br>ΤΡΟΠΟΠΟΙΗΣΗ ΕΓΓΡΑΦΗΣ ΤΗΛΕΦΩΝΟΥ: $row[1]<form action=$PHP_SELF method=POST>\n";
	echo "<input type=hidden name=ADD value=41111111111>\n";
	echo "<input type=hidden name=old_extension value=\"$row[0]\">\n";
	echo "<input type=hidden name=old_server_ip value=\"$row[5]\">\n";
	echo "<center><TABLE width=$section_width cellspacing=3>\n";
	echo "<tr bgcolor=#B6D3FC><td align=right>Τηλ.σύνδεσης τηλεφώνου: </td><td align=left><input type=text name=extension size=20 maxlength=100 value=\"$row[0]\">$NWB#phones-extension$NWE</td></tr>\n";
	echo "<tr bgcolor=#B6D3FC><td align=right>Αριθμός Σχεδίου Κλήσεων: </td><td align=left><input type=text name=dialplan_number size=15 maxlength=20 value=\"$row[1]\"> (μόνο αριθμοί)$NWB#phones-dialplan_number$NWE</td></tr>\n";
	echo "<tr bgcolor=#B6D3FC><td align=right>Περιεχόμενο Φωνητικού Ταχυδρομείου: </td><td align=left><input type=text name=voicemail_id size=10 maxlength=10 value=\"$row[2]\"> (μόνο αριθμοί)$NWB#phones-voicemail_id$NWE</td></tr>\n";
	echo "<tr bgcolor=#B6D3FC><td align=right>Εξερχόμενο CallerID: </td><td align=left><input type=text name=outbound_cid size=10 maxlength=20 value=\"$row[65]\"> (μόνο αριθμοί)$NWB#phones-outbound_cid$NWE</td></tr>\n";
	echo "<tr bgcolor=#B6D3FC><td align=right>Δνση IP Τηλεφώνου: </td><td align=left><input type=text name=phone_ip size=20 maxlength=15 value=\"$row[3]\"> (optional)$NWB#phones-phone_ip$NWE</td></tr>\n";
	echo "<tr bgcolor=#B6D3FC><td align=right>Δνση IP Υπολογιστή: </td><td align=left><input type=text name=computer_ip size=20 maxlength=15 value=\"$row[4]\"> (optional)$NWB#phones-computer_ip$NWE</td></tr>\n";
	echo "<tr bgcolor=#B6D3FC><td align=right><a href=\"$PHP_SELF?ADD=311111111111&server_ip=$row[5]\">IP Διακομιστή</a>: </td><td align=left><select size=1 name=server_ip>\n";

	echo "$servers_list";
	echo "<option SELECTED>$row[5]</option>\n";
	echo "</select>$NWB#phones-server_ip$NWE</td></tr>\n";
	echo "<tr bgcolor=#B6D3FC><td align=right>Σύνδεση:</td><td align=left><input type=text name=login size=10 maxlength=10 value=\"$row[6]\">$NWB#phones-login$NWE</td></tr>\n";
	echo "<tr bgcolor=#B6D3FC><td align=right>Κωδικός:</td><td align=left><input type=text name=pass size=10 maxlength=10 value=\"$row[7]\">$NWB#phones-pass$NWE</td></tr>\n";
	echo "<tr bgcolor=#B6D3FC><td align=right>Κατάσταση:</td><td align=left><select size=1 name=status><option>ΕΝΕΡΓΟ</option><option>SUSPENDED</option><option>CLOSED</option><option>PENDING</option><option>ADMIN</option><option selected>$row[8]</option></select>$NWB#phones-status$NWE</td></tr>\n";
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
	echo "<tr bgcolor=#B6D3FC><td align=right>Επιτρέψτε τα μηνύματα SIPSAK: </td><td align=left><select size=1 name=enable_sipsak_messages><option>1</option><option>0</option><option selected>$row[66]</option></select>$NWB#phones-enable_sipsak_messages$NWE</td></tr>\n";
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

	if ($LOGast_delete_phones > 0)
		{
		echo "<br><br><a href=\"$PHP_SELF?ADD=51111111111&extension=$extension&server_ip=$server_ip\">ΔΙΑΓΡΑΨΕ ΑΥΤΟ ΤΟ ΤΗΛΕΦΩΝΟ</a>\n";
		}
	}
	else
	{
	echo "Δεν έχετε την άδεια να δείτε αυτήν την σελίδα\n";
	exit;
	}
}


######################
# ADD=311111111111 modify server record in the system
######################

if ($ADD==311111111111)
{
	if ($LOGmodify_servers==1)
	{
	echo "<TABLE><TR><TD>\n";
	echo "<FONT FACE=\"ARIAL,HELVETICA\" COLOR=BLACK SIZE=2>";

	$stmt="SELECT * from servers where server_id='$server_id' or server_ip='$server_ip';";
	$rslt=mysql_query($stmt, $link);
	$row=mysql_fetch_row($rslt);
	$server_id = $row[0];
	$server_ip = $row[2];

	echo "<br>ΤΡΟΠΟΠΟΙΗΣΗ ΕΓΓΡΑΦΗΣ ΔΙΑΚΟΜΙΣΤΗ: $row[0]<form action=$PHP_SELF method=POST>\n";
	echo "<input type=hidden name=ADD value=411111111111>\n";
	echo "<input type=hidden name=old_server_id value=\"$server_id\">\n";
	echo "<input type=hidden name=old_server_ip value=\"$row[2]\">\n";
	echo "<center><TABLE width=$section_width cellspacing=3>\n";
	echo "<tr bgcolor=#B6D3FC><td align=right>ID Διακομιστή: </td><td align=left><input type=text name=server_id size=10 maxlength=10 value=\"$row[0]\">$NWB#servers-server_id$NWE</td></tr>\n";
	echo "<tr bgcolor=#B6D3FC><td align=right>Περιγραφή Διακομιστή: </td><td align=left><input type=text name=server_description size=30 maxlength=255 value=\"$row[1]\">$NWB#servers-server_description$NWE</td></tr>\n";
	echo "<tr bgcolor=#B6D3FC><td align=right>Δνση IP Διακομιστή: </td><td align=left><input type=text name=server_ip size=20 maxlength=15 value=\"$row[2]\">$NWB#servers-server_ip$NWE</td></tr>\n";
	echo "<tr bgcolor=#B6D3FC><td align=right>Ενεργή:</td><td align=left><select size=1 name=active><option>Y</option><option>N</option><option selected>$row[3]</option></select>$NWB#servers-active$NWE</td></tr>\n";
	echo "<tr bgcolor=#B6D3FC><td align=right>Εκδοση Asterisk: </td><td align=left><input type=text name=asterisk_version size=20 maxlength=20 value=\"$row[4]\">$NWB#servers-asterisk_version$NWE</td></tr>\n";
	echo "<tr bgcolor=#B6D3FC><td align=right>Μέγιστος Αριθμός Trunk: </td><td align=left><input type=text name=max_vicidial_trunks size=5 maxlength=4 value=\"$row[5]\">$NWB#servers-max_vicidial_trunks$NWE</td></tr>\n";
	echo "<tr bgcolor=#B6D3FC><td align=right>Διακύμανση Τηλεφωνικής Κλήσης: </td><td align=left><select size=1 name=vicidial_balance_active><option>Y</option><option>N</option><option selected>$row[20]</option></select>$NWB#servers-vicidial_balance_active$NWE</td></tr>\n";
	echo "<tr bgcolor=#B6D3FC><td align=right>Διακύμανση εκτός ορίων: </td><td align=left><input type=text name=balance_trunks_offlimits size=5 maxlength=4 value=\"$row[21]\">$NWB#servers-balance_trunks_offlimits$NWE</td></tr>\n";
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
	echo "<tr bgcolor=#B6D3FC><td align=right>Επίδοση Συστήματος
: </td><td align=left><select size=1 name=sys_perf_log><option>Y</option><option>N</option><option selected>$row[17]</option></select>$NWB#servers-sys_perf_log$NWE</td></tr>\n";
	echo "<tr bgcolor=#B6D3FC><td align=right>Γεγονότα Διακομιστή
: </td><td align=left><select size=1 name=vd_server_logs><option>Y</option><option>N</option><option selected>$row[18]</option></select>$NWB#servers-vd_server_logs$NWE</td></tr>\n";
	echo "<tr bgcolor=#B6D3FC><td align=right>Εξοδος AGI
: </td><td align=left><select size=1 name=agi_output><option>NONE</option><option>STDERR</option><option>FILE</option><option>BOTH</option><option selected>$row[19]</option></select>$NWB#servers-agi_output$NWE</td></tr>\n";
	echo "<tr bgcolor=#B6D3FC><td align=center colspan=2><input type=submit name=submit VALUE=ΥΠΟΒΑΛΛΩ></td></tr>\n";
	echo "</TABLE></center></form>\n";


	### vicidial server trunk records for this server
	echo "<br><br><b>ΚΟΡΜΟΙ ΓΙΑ ΤΟΝ ΕΞΥΠΗΡΕΤΗΤΗ: &nbsp; $NWB#vicidial_server_trunks$NWE</b><br>\n";
	echo "<TABLE width=500 cellspacing=3>\n";
	echo "<tr><td>ΕΚΣΤΡΑΤΕΙΑ</td><td> ΚΟΡΜΟΙ </td><td> ΠΕΡΙΟΡΙΣΜΟΣ </td><td> </td><td> DELETE </td></tr>\n";

		$stmt="SELECT * from vicidial_server_trunks where server_ip='$server_ip' order by campaign_id";
		$rslt=mysql_query($stmt, $link);
		$recycle_to_print = mysql_num_rows($rslt);
		$o=0;
		while ($recycle_to_print > $o) {
			$rowx=mysql_fetch_row($rslt);
			$o++;

		if (eregi("1$|3$|5$|7$|9$", $o))
			{$bgcolor='bgcolor="#B9CBFD"';} 
		else
			{$bgcolor='bgcolor="#9BB9FB"';}

		echo "<tr $bgcolor><td><font size=1>$rowx[1]<form action=$PHP_SELF method=POST>\n";
		echo "<input type=hidden name=server_ip value=\"$server_ip\">\n";
		echo "<input type=hidden name=campaign_id value=\"$rowx[1]\">\n";
		echo "<input type=hidden name=ADD value=421111111111></td>\n";
		echo "<td><font size=1><input size=6 maxlength=4 name=dedicated_trunks value=\"$rowx[2]\"></td>\n";
		echo "<td><select size=1 name=trunk_restriction><option>MAXIMUM_LIMIT</option><option>OVERFLOW_ALLOWED</option><option SELECTED>$rowx[3]</option></select></td>\n";
		echo "<td><font size=1><input type=submit name=submit value=MODIFY></form></td>\n";
		echo "<td><font size=1><a href=\"$PHP_SELF?ADD=621111111111&campaign_id=$rowx[1]&server_ip=$server_ip\">ΔΙΑΓΡΑΦΗ</a></td></tr>\n";
		}

	echo "</table>\n";

	echo "<br><b>ΠΡΟΣΘΗΚΗ ΕΓΓΡΑΦΗΣ ΕΞΥΠΗΡΕΤΗΤΗ ΚΟΣΡΜΟΥ</b><BR><form action=$PHP_SELF method=POST>\n";
	echo "<input type=hidden name=ADD value=221111111111>\n";
	echo "<input type=hidden name=server_ip value=\"$server_ip\">\n";
	echo "TRUNKS: <input size=6 maxlength=4 name=dedicated_trunks><BR>\n";
	echo "ΕΚΣΤΡΑΤΕΙΑ: <select size=1 name=campaign_id>\n";
	echo "$campaigns_list\n";
	echo "</select><BR>\n";
	echo "RESTRICTION: <select size=1 name=trunk_restriction><option>MAXIMUM_LIMIT</option><option>OVERFLOW_ALLOWED</option></select><BR>\n";
	echo "<input type=submit name=submit value=ΠΡΟΣΘΗΚΗ><BR>\n";

	echo "</center></FORM><br>\n";


	### list of phones on this server
	echo "<center>\n";
	echo "<br><b>ΤΗΛΕΦΩΝΑ ΣΤΟΝ ΔΙΑΚΟΜΙΣΤΗ:</b><br>\n";
	echo "<TABLE width=400 cellspacing=3>\n";
	echo "<tr><td>ΤΗΛ.ΣΥΝΔΕΣΗ</td><td>ΟΝΟΜΑ</td><td>ΕΝΕΡΓΟ</td></tr>\n";

		$active_phones = 0;
		$inactive_phones = 0;
		$stmt="SELECT extension,active,fullname from phones where server_ip='$row[2]'";
		$rsltx=mysql_query($stmt, $link);
		$lists_to_print = mysql_num_rows($rsltx);
		$camp_lists='';

		$o=0;
		while ($lists_to_print > $o) {
			$rowx=mysql_fetch_row($rsltx);
			$o++;
		if (ereg("Y", $rowx[1])) {$active_phones++;   $camp_lists .= "'$rowx[0]',";}
		if (ereg("N", $rowx[1])) {$inactive_phones++;}

		if (eregi("1$|3$|5$|7$|9$", $o))
			{$bgcolor='bgcolor="#B9CBFD"';} 
		else
			{$bgcolor='bgcolor="#9BB9FB"';}

		echo "<tr $bgcolor><td><font size=1><a href=\"$PHP_SELF?ADD=31111111111&extension=$rowx[0]&server_ip=$row[2]\">$rowx[0]</a></td><td><font size=1>$rowx[2]</td><td><font size=1>$rowx[1]</td></tr>\n";
		}

	echo "</table></center><br>\n";


	### list of conferences on this server
	echo "<center>\n";
	echo "<br><b>CONFERENCES WITHIN THIS SERVER:</b><br>\n";
	echo "<TABLE width=400 cellspacing=3>\n";
	echo "<tr><td>CONFERENCE</td><td>ΤΗΛ.ΣΥΝΔΕΣΗ</td></tr>\n";

		$active_confs = 0;
		$stmt="SELECT conf_exten,extension from conferences where server_ip='$row[2]'";
		$rsltx=mysql_query($stmt, $link);
		$lists_to_print = mysql_num_rows($rsltx);
		$camp_lists='';

		$o=0;
		while ($lists_to_print > $o) {
			$rowx=mysql_fetch_row($rsltx);
			$o++;
			$active_confs++;

		if (eregi("1$|3$|5$|7$|9$", $o))
			{$bgcolor='bgcolor="#B9CBFD"';} 
		else
			{$bgcolor='bgcolor="#9BB9FB"';}

		echo "<tr $bgcolor><td><font size=1><a href=\"$PHP_SELF?ADD=3111111111111&conf_exten=$rowx[0]&server_ip=$row[2]\">$rowx[0]</a></td><td><font size=1>$rowx[2]</td></tr>\n";
		}

	echo "</table></center><br>\n";


	### list of vicidial conferences on this server
	echo "<center>\n";
	echo "<br><b>VICIDIAL CONFERENCES WITHIN THIS SERVER:</b><br>\n";
	echo "<TABLE width=400 cellspacing=3>\n";
	echo "<tr><td>VD CONFERENCE</td><td>ΤΗΛ.ΣΥΝΔΕΣΗ</td></tr>\n";

		$active_vdconfs = 0;
		$stmt="SELECT conf_exten,extension from vicidial_conferences where server_ip='$row[2]'";
		$rsltx=mysql_query($stmt, $link);
		$lists_to_print = mysql_num_rows($rsltx);
		$camp_lists='';

		$o=0;
		while ($lists_to_print > $o) {
			$rowx=mysql_fetch_row($rsltx);
			$o++;
			$active_vdconfs++;

		if (eregi("1$|3$|5$|7$|9$", $o))
			{$bgcolor='bgcolor="#B9CBFD"';} 
		else
			{$bgcolor='bgcolor="#9BB9FB"';}

		echo "<tr $bgcolor><td><font size=1><a href=\"$PHP_SELF?ADD=31111111111111&conf_exten=$rowx[0]&server_ip=$row[2]\">$rowx[0]</a></td><td><font size=1>$rowx[2]</td></tr>\n";
		}

	echo "</table></center><br>\n";


	echo "<center><b>\n";

		$camp_lists = eregi_replace(".$","",$camp_lists);
	echo "Αυτός ο διακομιστής έχει $active_phones ενεργά τηλέφωνα και $inactive_phones μη ενεργά τηλέφωνα<br><br>\n";
	echo "Αυτός ο διακομιστής έχει $active_confs active conferences<br><br>\n";
	echo "Αυτός ο διακομιστής έχει $active_vdconfs active vicidial conferences<br><br>\n";
	echo "</b></center>\n";
	if ($LOGast_delete_phones > 0)
		{
		echo "<br><br><a href=\"$PHP_SELF?ADD=511111111111&server_id=$server_id&server_ip=$server_ip\">DELETE THIS SERVER</a>\n";
		}
	}
	else
	{
	echo "Δεν έχετε την άδεια να δείτε αυτήν την σελίδα\n";
	exit;
	}
}


######################
# ADD=3111111111111 modify conference record in the system
######################

if ($ADD==3111111111111)
{
	if ($LOGast_admin_access==1)
	{
	echo "<TABLE><TR><TD>\n";
	echo "<FONT FACE=\"ARIAL,HELVETICA\" COLOR=BLACK SIZE=2>";

	$stmt="SELECT * from conferences where conf_exten='$conf_exten' and server_ip='$server_ip';";
	$rslt=mysql_query($stmt, $link);
	$row=mysql_fetch_row($rslt);
	$conf_exten = $row[0];
	$server_ip = $row[1];

	echo "<br>ΤΡΟΠΟΠΟΙΗΣΗ ΕΓΓΡΑΦΗΣ ΣΥΝΔΙΑΛΕΞΗΣ: $row[0]<form action=$PHP_SELF method=POST>\n";
	echo "<input type=hidden name=ADD value=4111111111111>\n";
	echo "<input type=hidden name=old_conf_exten value=\"$row[0]\">\n";
	echo "<input type=hidden name=old_server_ip value=\"$row[1]\">\n";
	echo "<center><TABLE width=$section_width cellspacing=3>\n";
	echo "<tr bgcolor=#B6D3FC><td align=right>Συνδιάλεξη:</td><td align=left><input type=text name=conf_exten size=10 maxlength=7 value=\"$row[0]\">$NWB#conferences-conf_exten$NWE</td></tr>\n";
	echo "<tr bgcolor=#B6D3FC><td align=right><a href=\"$PHP_SELF?ADD=311111111111&server_ip=$row[1]\">IP Διακομιστή</a>: </td><td align=left><select size=1 name=server_ip>\n";

	echo "$servers_list";
	echo "<option SELECTED>$row[1]</option>\n";
	echo "</select>$NWB#conferences-server_ip$NWE</td></tr>\n";
	echo "<tr bgcolor=#B6D3FC><td align=right>Ισχύουσα εσωτ.σύνδεση: </td><td align=left><input type=text name=extension size=20 maxlength=20 value=\"$row[2]\"></td></tr>\n";
	echo "<tr bgcolor=#B6D3FC><td align=center colspan=2><input type=submit name=submit VALUE=ΥΠΟΒΑΛΛΩ></td></tr>\n";
	echo "</TABLE></center>\n";

	echo "<center><b>\n";
	if ($LOGast_delete_phones > 0)
		{
		echo "<br><br><a href=\"$PHP_SELF?ADD=5111111111111&conf_exten=$conf_exten&server_ip=$server_ip\">DELETE THIS CONFERENCE</a>\n";
		}
	}
	else
	{
	echo "Δεν έχετε την άδεια να δείτε αυτήν την σελίδα\n";
	exit;
	}
}


######################
# ADD=31111111111111 modify vicidial conference record in the system
######################

if ($ADD==31111111111111)
{
	if ($LOGast_admin_access==1)
	{
	echo "<TABLE><TR><TD>\n";
	echo "<FONT FACE=\"ARIAL,HELVETICA\" COLOR=BLACK SIZE=2>";

	$stmt="SELECT * from vicidial_conferences where conf_exten='$conf_exten' and server_ip='$server_ip';";
	$rslt=mysql_query($stmt, $link);
	$row=mysql_fetch_row($rslt);
	$conf_exten = $row[0];
	$server_ip = $row[1];

	echo "<br>MODIFY A VICIDIAL CONFERENCE RECORD: $row[0]<form action=$PHP_SELF method=POST>\n";
	echo "<input type=hidden name=ADD value=41111111111111>\n";
	echo "<input type=hidden name=old_conf_exten value=\"$row[0]\">\n";
	echo "<input type=hidden name=old_server_ip value=\"$row[1]\">\n";
	echo "<center><TABLE width=$section_width cellspacing=3>\n";
	echo "<tr bgcolor=#B6D3FC><td align=right>Συνδιάλεξη:</td><td align=left><input type=text name=conf_exten size=10 maxlength=7 value=\"$row[0]\">$NWB#conferences-conf_exten$NWE</td></tr>\n";
	echo "<tr bgcolor=#B6D3FC><td align=right><a href=\"$PHP_SELF?ADD=311111111111&server_ip=$row[1]\">IP Διακομιστή</a>: </td><td align=left><select size=1 name=server_ip>\n";

	echo "$servers_list";
	echo "<option SELECTED>$row[1]</option>\n";
	echo "</select>$NWB#conferences-server_ip$NWE</td></tr>\n";
	echo "<tr bgcolor=#B6D3FC><td align=right>Ισχύουσα εσωτ.σύνδεση: </td><td align=left><input type=text name=extension size=20 maxlength=20 value=\"$row[2]\"></td></tr>\n";
	echo "<tr bgcolor=#B6D3FC><td align=center colspan=2><input type=submit name=submit VALUE=ΥΠΟΒΑΛΛΩ></td></tr>\n";
	echo "</TABLE></center>\n";

	echo "<center><b>\n";
	if ($LOGast_delete_phones > 0)
		{
		echo "<br><br><a href=\"$PHP_SELF?ADD=51111111111111&conf_exten=$conf_exten&server_ip=$server_ip\">DELETE THIS VICIDIAL CONFERENCE</a>\n";
		}
	}
	else
	{
	echo "Δεν έχετε την άδεια να δείτε αυτήν την σελίδα\n";
	exit;
	}
}



######################
# ADD=311111111111111 modify vicidial system settings
######################

if ($ADD==311111111111111)
{
	if ($LOGmodify_servers==1)
	{
	echo "<TABLE><TR><TD>\n";
	echo "<FONT FACE=\"ARIAL,HELVETICA\" COLOR=BLACK SIZE=2>";

	$stmt="SELECT version,install_date,use_non_latin,webroot_writable,enable_queuemetrics_logging,queuemetrics_server_ip,queuemetrics_dbname,queuemetrics_login,queuemetrics_pass,queuemetrics_url,queuemetrics_log_id,queuemetrics_eq_prepend,vicidial_agent_disable,allow_sipsak_messages,admin_home_url from system_settings;";
	$rslt=mysql_query($stmt, $link);
	$row=mysql_fetch_row($rslt);
	$version =						$row[0];
	$install_date =					$row[1];
	$use_non_latin =				$row[2];
	$webroot_writable =				$row[3];
	$enable_queuemetrics_logging =	$row[4];
	$queuemetrics_server_ip =		$row[5];
	$queuemetrics_dbname =			$row[6];
	$queuemetrics_login =			$row[7];
	$queuemetrics_pass =			$row[8];
	$queuemetrics_url =				$row[9];
	$queuemetrics_log_id =			$row[10];
	$queuemetrics_eq_prepend =		$row[11];
	$vicidial_agent_disable =		$row[12];
	$allow_sipsak_messages =		$row[13];
	$admin_home_url =				$row[14];

	echo "<br>ΤΡΟΠΟΠΟΙΗΣΤΕ ΤΙΣ ΤΟΠΟΘΕΤΉΣΕΙΣ ΣΥΣΤΗΜΑΤΩΝ VICIDIAL<form action=$PHP_SELF method=POST>\n";
	echo "<input type=hidden name=ADD value=411111111111111>\n";
	echo "<center><TABLE width=$section_width cellspacing=3>\n";
	echo "<tr bgcolor=#B6D3FC><td align=right>Έκδοση: </td><td align=left> $version</td></tr>\n";
	echo "<tr bgcolor=#B6D3FC><td align=right>Install Date: </td><td align=left> $install_date</td></tr>\n";
	echo "<tr bgcolor=#B6D3FC><td align=right>Μη-λατινικά χρήσης: </td><td align=left><select size=1 name=use_non_latin><option>1</option><option>0</option><option selected>$use_non_latin</option></select>$NWB#settings-use_non_latin$NWE</td></tr>\n";
	echo "<tr bgcolor=#B6D3FC><td align=right>Webroot writable: </td><td align=left><select size=1 name=webroot_writable><option>1</option><option>0</option><option selected>$webroot_writable</option></select>$NWB#settings-webroot_writable$NWE</td></tr>\n";
	echo "<tr bgcolor=#B6D3FC><td align=right>Επιτρέψτε την αναγραφή QueueMetrics: </td><td align=left><select size=1 name=enable_queuemetrics_logging><option>1</option><option>0</option><option selected>$enable_queuemetrics_logging</option></select>$NWB#settings-enable_queuemetrics_logging$NWE</td></tr>\n";

	echo "<tr bgcolor=#B6D3FC><td align=right>QueueMetrics κεντρικός υπολογιστής IP: </td><td align=left><input type=text name=queuemetrics_server_ip size=18 maxlength=15 value=\"$queuemetrics_server_ip\">$NWB#settings-queuemetrics_server_ip$NWE</td></tr>\n";
	echo "<tr bgcolor=#B6D3FC><td align=right>QueueMetrics όνομα DB: </td><td align=left><input type=text name=queuemetrics_dbname size=18 maxlength=50 value=\"$queuemetrics_dbname\">$NWB#settings-queuemetrics_dbname$NWE</td></tr>\n";
	echo "<tr bgcolor=#B6D3FC><td align=right>QueueMetrics σύνδεση DB: </td><td align=left><input type=text name=queuemetrics_login size=18 maxlength=50 value=\"$queuemetrics_login\">$NWB#settings-queuemetrics_login$NWE</td></tr>\n";
	echo "<tr bgcolor=#B6D3FC><td align=right>QueueMetrics κωδικός πρόσβασης DB: </td><td align=left><input type=text name=queuemetrics_pass size=18 maxlength=50 value=\"$queuemetrics_pass\">$NWB#settings-queuemetrics_pass$NWE</td></tr>\n";
	echo "<tr bgcolor=#B6D3FC><td align=right>QueueMetrics URL: </td><td align=left><input type=text name=queuemetrics_url size=50 maxlength=255 value=\"$queuemetrics_url\">$NWB#settings-queuemetrics_url$NWE</td></tr>\n";
	echo "<tr bgcolor=#B6D3FC><td align=right>QueueMetrics καταγράψτε την ταυτότητα: </td><td align=left><input type=text name=queuemetrics_log_id size=12 maxlength=10 value=\"$queuemetrics_log_id\">$NWB#settings-queuemetrics_log_id$NWE</td></tr>\n";
	echo "<tr bgcolor=#B6D3FC><td align=right>QueueMetrics EnterQueue Prepend:</td><td align=left><select size=1 name=queuemetrics_eq_prepend>\n";
	echo "<option value=\"NONE\">NONE</option>\n";
	echo "<option value=\"lead_id\">lead_id</option>\n";
	echo "<option value=\"list_id\">list_id</option>\n";
	echo "<option value=\"source_id\">source_id</option>\n";
	echo "<option value=\"vendor_lead_code\">vendor_lead_code</option>\n";
	echo "<option value=\"address3\">address3</option>\n";
	echo "<option value=\"security_phrase\">security_phrase</option>\n";
	echo "<option selected value=\"$queuemetrics_eq_prepend\">$queuemetrics_eq_prepend</option>\n";
	echo "</select>$NWB#settings-queuemetrics_eq_prepend$NWE</td></tr>\n";
	echo "<tr bgcolor=#B6D3FC><td align=right>VICIDIAL ο πράκτορας θέτει εκτός λειτουργίας την επίδειξη: </td><td align=left><select size=1 name=vicidial_agent_disable>\n";
	echo "<option value=\"NOT_ACTIVE\">NOT_ACTIVE</option>\n";
	echo "<option value=\"LIVE_AGENT\">LIVE_AGENT</option>\n";
	echo "<option value=\"EXTERNAL\">EXTERNAL</option>\n";
	echo "<option value=\"ALL\">ALL</option>\n";
	echo "<option selected value=\"$vicidial_agent_disable\">$vicidial_agent_disable</option>\n";
	echo "</select>$NWB#settings-vicidial_agent_disable$NWE</td></tr>\n";
	echo "<tr bgcolor=#B6D3FC><td align=right>Επιτρέψτε τα μηνύματα SIPSAK: </td><td align=left><select size=1 name=allow_sipsak_messages><option>1</option><option>0</option><option selected>$allow_sipsak_messages</option></select>$NWB#settings-allow_sipsak_messages$NWE</td></tr>\n";
	echo "<tr bgcolor=#B6D3FC><td align=right>Σπίτι URL Admin:</td><td align=left><input type=text name=admin_home_url size=50 maxlength=255 value=\"$admin_home_url\">$NWB#settings-admin_home_url$NWE</td></tr>\n";

	echo "<tr bgcolor=#B6D3FC><td align=center colspan=2><input type=submit name=submit VALUE=ΥΠΟΒΑΛΛΩ></td></tr>\n";
	echo "</TABLE></center>\n";

	echo "<center><b>\n";
	}
	else
	{
	echo "Δεν έχετε την άδεια να δείτε αυτήν την σελίδα\n";
	exit;
	}
}







######################
# ADD=550 search form
######################

if ($ADD==550)
{
echo "<TABLE><TR><TD>\n";
echo "<FONT FACE=\"ARIAL,HELVETICA\" COLOR=BLACK SIZE=2>";

echo "<br>ΑΝΑΖΗΤΗΣΗ ΧΡΗΣΤΗ<form action=$PHP_SELF method=POST>\n";
echo "<input type=hidden name=ADD value=660>\n";
echo "<center><TABLE width=$section_width cellspacing=3>\n";
echo "<tr bgcolor=#B6D3FC><td align=right>Αριθμός Χρήστη: </td><td align=left><input type=text name=user size=20 maxlength=20></td></tr>\n";
echo "<tr bgcolor=#B6D3FC><td align=right>Πλήρες Ονομα: </td><td align=left><input type=text name=full_name size=30 maxlength=30></td></tr>\n";
echo "<tr bgcolor=#B6D3FC><td align=right>Επίπεδο Χρήστη: </td><td align=left><select size=1 name=user_level><option selected>0</option><option>1</option><option>2</option><option>3</option><option>4</option><option>5</option><option>6</option><option>7</option><option>8</option><option>9</option></select></td></tr>\n";
echo "<tr bgcolor=#B6D3FC><td align=right>Ομάδα Χρήστη: </td><td align=left><select size=1 name=user_group>\n";

	$stmt="SELECT * from vicidial_user_groups order by user_group";
	$rslt=mysql_query($stmt, $link);
	$groups_to_print = mysql_num_rows($rslt);
	$o=0;
	$groups_list='';
	while ($groups_to_print > $o) {
		$rowx=mysql_fetch_row($rslt);
		$groups_list .= "<option value=\"$rowx[0]\">$rowx[0] - $rowx[1]</option>\n";
		$o++;
	}
echo "$groups_list</select></td></tr>\n";

echo "<tr bgcolor=#B6D3FC><td align=center colspan=2><input type=submit name=search value=search></td></tr>\n";
echo "</TABLE></center>\n";

}

######################
# ADD=660 user search results
######################

if ($ADD==660)
{
echo "<TABLE><TR><TD>\n";
	echo "<FONT FACE=\"ARIAL,HELVETICA\" COLOR=BLACK SIZE=2>";

	$SQL = '';
	if ($user) {$SQL .= " user LIKE \"%$user%\" and";}
	if ($full_name) {$SQL .= " full_name LIKE \"%$full_name%\" and";}
	if ($user_level > 0) {$SQL .= " user_level LIKE \"%$user_level%\" and";}
	if ($user_group) {$SQL .= " user_group = '$user_group' and";}
	$SQL = eregi_replace(" and$", "", $SQL);
	if (strlen($SQL)>5) {$SQL = "where $SQL";}

	$stmt="SELECT * from vicidial_users $SQL order by full_name desc;";
#	echo "\n|$stmt|\n";
	$rslt=mysql_query($stmt, $link);
	$people_to_print = mysql_num_rows($rslt);

echo "<br>ΑΝΑΖΗΤΗΣΗ ΑΠΟΤΕΛΕΣΜΑΤΩΝ:\n";
echo "<center><TABLE width=$section_width cellspacing=0 cellpadding=1>\n";

	$o=0;
	while ($people_to_print > $o) {
		$row=mysql_fetch_row($rslt);
		if (eregi("1$|3$|5$|7$|9$", $o))
			{$bgcolor='bgcolor="#B9CBFD"';} 
		else
			{$bgcolor='bgcolor="#9BB9FB"';}
		echo "<tr $bgcolor><td><font size=1>$row[1]</td><td><font size=1>$row[3]</td><td><font size=1>$row[4]</td><td><font size=1>$row[5]</td>";
		echo "<td><font size=1><a href=\"$PHP_SELF?ADD=3&user=$row[1]\">ΤΡΟΠΟΠΟΙΗΣΗ</a> | <a href=\"./user_stats.php?user=$row[1]\">ΣΤΑΤΙΣΤΙΚΑ</a> | <a href=\"./user_status.php?user=$row[1]\">ΚΑΤΑΣΤΑΣΗ</a> | <a href=\"./AST_agent_time_sheet.php?agent=$row[1]\">TIME</a></td></tr>\n";
		$o++;
	}

echo "</TABLE></center>\n";

}


######################################################################################################
######################################################################################################
#######   8 series, Callback lists
######################################################################################################
######################################################################################################

######################
# ADD=8 find all callbacks on hold by a User
######################
if ($ADD==8)
{
	echo "<FONT FACE=\"ARIAL,HELVETICA\" COLOR=BLACK SIZE=2>";

	$stmt="SELECT * from vicidial_callbacks where status IN('ACTIVE','LIVE') and user='$user' order by recipient,status desc,callback_time";
	$rslt=mysql_query($stmt, $link);
	$cb_to_print = mysql_num_rows($rslt);

echo "<br>USER CALLBACK HOLD LISTINGS: $user\n";
$ADD='82';
}

######################
# ADD=81 find all callbacks on hold within a Campaign
######################
if ($ADD==81)
{
	echo "<FONT FACE=\"ARIAL,HELVETICA\" COLOR=BLACK SIZE=2>";

	$stmt="SELECT * from vicidial_callbacks where status IN('ACTIVE','LIVE') and campaign_id='$campaign_id' order by recipient,status desc,callback_time";
	$rslt=mysql_query($stmt, $link);
	$cb_to_print = mysql_num_rows($rslt);

echo "<br>CAMPAIGN CALLBACK HOLD LISTINGS: $campaign_id\n";
$ADD='82';
}

######################
# ADD=811 find all callbacks on hold within a List
######################
if ($ADD==811)
{
	echo "<FONT FACE=\"ARIAL,HELVETICA\" COLOR=BLACK SIZE=2>";

	$stmt="SELECT * from vicidial_callbacks where status IN('ACTIVE','LIVE') and list_id='$list_id' order by recipient,status desc,callback_time";
	$rslt=mysql_query($stmt, $link);
	$cb_to_print = mysql_num_rows($rslt);

echo "<br>LIST CALLBACK HOLD LISTINGS: $list_id\n";
$ADD='82';
}

######################
# ADD=8111 find all callbacks on hold within a user group
######################
if ($ADD==8111)
{
	echo "<FONT FACE=\"ARIAL,HELVETICA\" COLOR=BLACK SIZE=2>";

	$stmt="SELECT * from vicidial_callbacks where status IN('ACTIVE','LIVE') and user_group='$user_group' order by recipient,status desc,callback_time";
	$rslt=mysql_query($stmt, $link);
	$cb_to_print = mysql_num_rows($rslt);

echo "<br>USER GROUP CALLBACK HOLD LISTINGS: $list_id\n";
$ADD='82';
}

######################
# ADD=82 display all callbacks on hold
######################
if ($ADD==82)
{
echo "<TABLE><TR><TD>\n";
echo "<center><TABLE width=$section_width cellspacing=0 cellpadding=1>\n";
echo "<tr bgcolor=black><td><font size=1 color=white>LEAD</td><td><font size=1 color=white>LIST</td><td><font size=1 color=white>ΕΚΣΤΡΑΤΕΙΑ</td><td><font size=1 color=white>ENTRY ΗΜΕΡΑ</td><td><font size=1 color=white>CALLBACK ΗΜΕΡΑ</td><td><font size=1 color=white>USER</td><td><font size=1 color=white>RECIPIENT</td><td><font size=1 color=white>ΚΑΤΑΣΤΑΣΗ</td><td><font size=1 color=white>GROUP</td></tr>\n";

	$o=0;
	while ($cb_to_print > $o) {
		$row=mysql_fetch_row($rslt);
		if (eregi("1$|3$|5$|7$|9$", $o))
			{$bgcolor='bgcolor="#B9CBFD"';} 
		else
			{$bgcolor='bgcolor="#9BB9FB"';}
		echo "<tr $bgcolor>";
		echo "<td><font size=1><A HREF=\"admin_modify_lead.php?lead_id=$row[1]\" target=\"_blank\">$row[1]</A></td>";
		echo "<td><font size=1><A HREF=\"$PHP_SELF?ADD=311&list_id=$row[2]\">$row[2]</A></td>";
		echo "<td><font size=1><A HREF=\"$PHP_SELF?ADD=31&campaign_id=$row[3]\">$row[3]</A></td>";
		echo "<td><font size=1>$row[5]</td>";
		echo "<td><font size=1>$row[6]</td>";
		echo "<td><font size=1><A HREF=\"$PHP_SELF?ADD=3&user=$row[8]\">$row[8]</A></td>";
		echo "<td><font size=1>$row[9]</td>";
		echo "<td><font size=1>$row[4]</td>";
		echo "<td><font size=1><A HREF=\"$PHP_SELF?ADD=311111&user_group=$row[11]\">$row[11]</A></td>";
		echo "</tr>\n";
		$o++;
	}

echo "</TABLE></center>\n";
}



######################################################################################################
######################################################################################################
#######   0 series, displays and searches
######################################################################################################
######################################################################################################

######################
# ADD=0 display all active users
######################
if ($ADD==0)
{
echo "<TABLE><TR><TD>\n";
echo "<FONT FACE=\"ARIAL,HELVETICA\" COLOR=BLACK SIZE=2>";

$USERlink='stage=USERIDDOWN';
$NAMElink='stage=NAMEDOWN';
$LEVELlink='stage=LEVELDOWN';
$GROUPlink='stage=GROUPDOWN';
$SQLorder='order by full_name';
if (eregi("USERIDUP",$stage)) {$SQLorder='order by user asc';   $USERlink='stage=USERIDDOWN';}
if (eregi("USERIDDOWN",$stage)) {$SQLorder='order by user desc';   $USERlink='stage=USERIDUP';}
if (eregi("NAMEUP",$stage)) {$SQLorder='order by full_name asc';   $NAMElink='stage=NAMEDOWN';}
if (eregi("NAMEDOWN",$stage)) {$SQLorder='order by full_name desc';   $NAMElink='stage=NAMEUP';}
if (eregi("LEVELUP",$stage)) {$SQLorder='order by user_level asc';   $LEVELlink='stage=LEVELDOWN';}
if (eregi("LEVELDOWN",$stage)) {$SQLorder='order by user_level desc';   $LEVELlink='stage=LEVELUP';}
if (eregi("GROUPUP",$stage)) {$SQLorder='order by user_group asc';   $GROUPlink='stage=GROUPDOWN';}
if (eregi("GROUPDOWN",$stage)) {$SQLorder='order by user_group desc';   $GROUPlink='stage=GROUPUP';}
	$stmt="SELECT * from vicidial_users $SQLorder";
	$rslt=mysql_query($stmt, $link);
	$people_to_print = mysql_num_rows($rslt);

echo "<br>ΛΙΣΤΕΣ ΧΡΗΣΤΗ:\n";
echo "<center><TABLE width=$section_width cellspacing=0 cellpadding=1>\n";
echo "<tr bgcolor=black>";
echo "<td><a href=\"$PHP_SELF?ADD=0&$USERlink\"><font size=1 color=white><B>USER ID</B></a></td>";
echo "<td><a href=\"$PHP_SELF?ADD=0&$NAMElink\"><font size=1 color=white><B>FULL NAME</B></a></td>";
echo "<td><a href=\"$PHP_SELF?ADD=0&$LEVELlink\"><font size=1 color=white><B>LEVEL</B></a></td>";
echo "<td><a href=\"$PHP_SELF?ADD=0&$GROUPlink\"><font size=1 color=white><B>GROUP</B></a></td>";
echo "<td align=center><font size=1 color=white><B>LINKS</B></td></tr>\n";

	$o=0;
	while ($people_to_print > $o) {
		$row=mysql_fetch_row($rslt);
		if (eregi("1$|3$|5$|7$|9$", $o))
			{$bgcolor='bgcolor="#B9CBFD"';} 
		else
			{$bgcolor='bgcolor="#9BB9FB"';}
		echo "<tr $bgcolor><td><a href=\"$PHP_SELF?ADD=3&user=$row[1]\"><font size=1 color=black>$row[1]</a></td><td><font size=1>$row[3]</td><td><font size=1>$row[4]</td><td><font size=1>$row[5]</td>";
		echo "<td><font size=1><a href=\"$PHP_SELF?ADD=3&user=$row[1]\">ΤΡΟΠΟΠΟΙΗΣΗ</a> | <a href=\"./user_stats.php?user=$row[1]\">ΣΤΑΤΙΣΤΙΚΑ</a> | <a href=\"./user_status.php?user=$row[1]\">ΚΑΤΑΣΤΑΣΗ</a> | <a href=\"./AST_agent_time_sheet.php?agent=$row[1]\">TIME</a></td></tr>\n";
		$o++;
	}

echo "</TABLE></center>\n";
}

######################
# ADD=10 display all campaigns
######################
if ($ADD==10)
{
echo "<TABLE><TR><TD>\n";
	echo "<FONT FACE=\"ARIAL,HELVETICA\" COLOR=BLACK SIZE=2>";

	$stmt="SELECT * from vicidial_campaigns order by campaign_id";
	$rslt=mysql_query($stmt, $link);
	$people_to_print = mysql_num_rows($rslt);

echo "<br>ΕΝΤΑΓΜΕΝΕΣ ΕΚΣΤΡΑΤΕΙΕΣ:\n";
echo "<center><TABLE width=$section_width cellspacing=0 cellpadding=1>\n";

	$o=0;
	while ($people_to_print > $o) {
		$row=mysql_fetch_row($rslt);
		if (eregi("1$|3$|5$|7$|9$", $o))
			{$bgcolor='bgcolor="#B9CBFD"';} 
		else
			{$bgcolor='bgcolor="#9BB9FB"';}
		echo "<tr $bgcolor><td><font size=1><a href=\"$PHP_SELF?ADD=34&campaign_id=$row[0]\">$row[0]</a></td>";
		echo "<td><font size=1> $row[1] </td>";
		echo "<td><font size=1> $row[2]</td>";
		echo "<td><font size=1> $row[3]</td><td><font size=1>$row[4]</td><td><font size=1>$row[5]</td>";
		echo "<td><font size=1> $row[6]</td><td><font size=1>$row[7]</td><td><font size=1> &nbsp;</td>";
		echo "<td><font size=1><a href=\"$PHP_SELF?ADD=31&campaign_id=$row[0]\">ΤΡΟΠΟΠΟΙΗΣΗ</a></td></tr>\n";
		$o++;
	}

echo "</TABLE></center>\n";
}


######################
# ADD=100 display all lists
######################
if ($ADD==100)
{
echo "<TABLE><TR><TD>\n";
	echo "<FONT FACE=\"ARIAL,HELVETICA\" COLOR=BLACK SIZE=2>";

	$stmt="SELECT * from vicidial_lists order by list_id";
	$rslt=mysql_query($stmt, $link);
	$people_to_print = mysql_num_rows($rslt);

echo "<br>ΕΝΤΑΓΜΕΝΕΣ ΛΙΣΤΕΣ:\n";
echo "<center><TABLE width=$section_width cellspacing=0 cellpadding=1>\n";

	$o=0;
	while ($people_to_print > $o) {
		$row=mysql_fetch_row($rslt);
		if (eregi("1$|3$|5$|7$|9$", $o))
			{$bgcolor='bgcolor="#B9CBFD"';} 
		else
			{$bgcolor='bgcolor="#9BB9FB"';}
		echo "<tr $bgcolor><td><font size=1>$row[0]</td>";
		echo "<td><font size=1> $row[1]</td>";
		echo "<td><font size=1> $row[2]</td><td><font size=1>$row[4]</td><td><font size=1>$row[5]</td>";
		echo "<td><font size=1> $row[3]</td><td><font size=1>$row[7]</td><td><font size=1> &nbsp;</td>";
		echo "<td><font size=1><a href=\"$PHP_SELF?ADD=311&list_id=$row[0]\">ΤΡΟΠΟΠΟΙΗΣΗ</a></td></tr>\n";
		$o++;
	}

echo "</TABLE></center>\n";
}



######################
# ADD=1000 display all inbound groups
######################
if ($ADD==1000)
{
echo "<TABLE><TR><TD>\n";
	echo "<FONT FACE=\"ARIAL,HELVETICA\" COLOR=BLACK SIZE=2>";

	$stmt="SELECT * from vicidial_inbound_groups order by group_id";
	$rslt=mysql_query($stmt, $link);
	$people_to_print = mysql_num_rows($rslt);

echo "<br>ΕΝΤΑΓΜΕΝΕΣ ΕΙΣΕΡΧΟΜΕΝΕΣ ΟΜΑΔΕΣ:\n";
echo "<center><TABLE width=$section_width cellspacing=0 cellpadding=1>\n";

	$o=0;
	while ($people_to_print > $o) {
		$row=mysql_fetch_row($rslt);
		if (eregi("1$|3$|5$|7$|9$", $o))
			{$bgcolor='bgcolor="#B9CBFD"';} 
		else
			{$bgcolor='bgcolor="#9BB9FB"';}
		echo "<tr $bgcolor><td><font size=1>$row[0]</td>";
		echo "<td><font size=1> $row[1]</td>";
		echo "<td><font size=1> $row[3]</td>";
		echo "<td><font size=1> $row[5]</td>";
		echo "<td bgcolor=\"$row[2]\"><font size=1> &nbsp;</td>";
		echo "<td><font size=1><a href=\"$PHP_SELF?ADD=3111&group_id=$row[0]\">ΤΡΟΠΟΠΟΙΗΣΗ</a></td></tr>\n";
		$o++;
	}

echo "</TABLE></center>\n";
}


######################
# ADD=10000 display all remote agents
######################
if ($ADD==10000)
{
echo "<TABLE><TR><TD>\n";
	echo "<FONT FACE=\"ARIAL,HELVETICA\" COLOR=BLACK SIZE=2>";

	$stmt="SELECT * from vicidial_remote_agents order by server_ip,campaign_id,user_start";
	$rslt=mysql_query($stmt, $link);
	$people_to_print = mysql_num_rows($rslt);

echo "<br>ΕΝΤΑΓΜΕΝΟΙ ΑΠΟΜΑΚΡΥΣΜΕΝΟΙ ΧΕΙΡΙΣΤΕΣ:\n";
echo "<center><TABLE width=$section_width cellspacing=0 cellpadding=1>\n";

	$o=0;
	while ($people_to_print > $o) {
		$row=mysql_fetch_row($rslt);
		if (eregi("1$|3$|5$|7$|9$", $o))
			{$bgcolor='bgcolor="#B9CBFD"';} 
		else
			{$bgcolor='bgcolor="#9BB9FB"';}
		echo "<tr $bgcolor><td><font size=1>$row[1]</td>";
		echo "<td><font size=1> $row[2]</td>";
		echo "<td><font size=1> $row[3]</td>";
		echo "<td><font size=1> $row[4]</td>";
		echo "<td><font size=1> $row[5]</td>";
		echo "<td><font size=1> $row[6]</td>";
		echo "<td><font size=1><a href=\"$PHP_SELF?ADD=31111&remote_agent_id=$row[0]\">ΤΡΟΠΟΠΟΙΗΣΗ</a></td></tr>\n";
		$o++;
	}

echo "</TABLE></center>\n";
}


######################
# ADD=100000 display all user groups
######################
if ($ADD==100000)
{
echo "<TABLE><TR><TD>\n";
	echo "<FONT FACE=\"ARIAL,HELVETICA\" COLOR=BLACK SIZE=2>";

	$stmt="SELECT * from vicidial_user_groups order by user_group";
	$rslt=mysql_query($stmt, $link);
	$people_to_print = mysql_num_rows($rslt);

echo "<br>ΕΝΤΑΓΜΕΝΕΣ ΟΜΑΔΕΣ ΧΡΗΣΤΗ:\n";
echo "<center><TABLE width=$section_width cellspacing=0 cellpadding=1>\n";

	$o=0;
	while ($people_to_print > $o) {
		$row=mysql_fetch_row($rslt);
		if (eregi("1$|3$|5$|7$|9$", $o))
			{$bgcolor='bgcolor="#B9CBFD"';} 
		else
			{$bgcolor='bgcolor="#9BB9FB"';}
		echo "<tr $bgcolor><td><font size=1>$row[0]</td>";
		echo "<td><font size=1> $row[1]</td>";
		echo "<td><font size=1><a href=\"$PHP_SELF?ADD=311111&user_group=$row[0]\">ΤΡΟΠΟΠΟΙΗΣΗ</a></td></tr>\n";
		$o++;
	}

echo "</TABLE></center>\n";
}


######################
# ADD=1000000 display all scripts
######################
if ($ADD==1000000)
{
echo "<TABLE><TR><TD>\n";
	echo "<FONT FACE=\"ARIAL,HELVETICA\" COLOR=BLACK SIZE=2>";

	$stmt="SELECT * from vicidial_scripts order by script_id";
	$rslt=mysql_query($stmt, $link);
	$people_to_print = mysql_num_rows($rslt);

echo "<br>ΛΙΣΤΕΣ ΒΟΗΘΩΝ:\n";
echo "<center><TABLE width=$section_width cellspacing=0 cellpadding=1>\n";

	$o=0;
	while ($people_to_print > $o) {
		$row=mysql_fetch_row($rslt);
		if (eregi("1$|3$|5$|7$|9$", $o))
			{$bgcolor='bgcolor="#B9CBFD"';} 
		else
			{$bgcolor='bgcolor="#9BB9FB"';}
		echo "<tr $bgcolor><td><font size=1>$row[0]</td>";
		echo "<td><font size=1> $row[1]</td>";
		echo "<td><font size=1><a href=\"$PHP_SELF?ADD=3111111&script_id=$row[0]\">ΤΡΟΠΟΠΟΙΗΣΗ</a></td></tr>\n";
		$o++;
	}

echo "</TABLE></center>\n";
}


######################
# ADD=10000000 display all filters
######################
if ($ADD==10000000)
{
echo "<TABLE><TR><TD>\n";

	echo "<FONT FACE=\"ARIAL,HELVETICA\" COLOR=BLACK SIZE=2>";

	$stmt="SELECT * from vicidial_lead_filters order by lead_filter_id";
	$rslt=mysql_query($stmt, $link);
	$filters_to_print = mysql_num_rows($rslt);

echo "<br>ΛΙΣΤΕΣ ΟΔΗΓΟΥ ΦΙΛΤΡΟΥ:\n";
echo "<center><TABLE width=$section_width cellspacing=0 cellpadding=1>\n";

	$o=0;
	while ($filters_to_print > $o) {
		$row=mysql_fetch_row($rslt);
		if (eregi("1$|3$|5$|7$|9$", $o))
			{$bgcolor='bgcolor="#B9CBFD"';} 
		else
			{$bgcolor='bgcolor="#9BB9FB"';}
		echo "<tr $bgcolor><td><font size=1>$row[0]</td>";
		echo "<td><font size=1> $row[1]</td>";
		echo "<td><font size=1><a href=\"$PHP_SELF?ADD=31111111&lead_filter_id=$row[0]\">ΤΡΟΠΟΠΟΙΗΣΗ</a></td></tr>\n";
		$o++;
	}

echo "</TABLE></center>\n";
}


######################
# ADD=100000000 display all call times
######################
if ($ADD==100000000)
{
echo "<TABLE><TR><TD>\n";

	echo "<FONT FACE=\"ARIAL,HELVETICA\" COLOR=BLACK SIZE=2>";

	$stmt="SELECT * from vicidial_call_times order by call_time_id";
	$rslt=mysql_query($stmt, $link);
	$filters_to_print = mysql_num_rows($rslt);

echo "<br>ΛΙΣΤΕΣ ΧΡΟΝΟΥ ΚΛΗΣΗΣ:\n";
echo "<center><TABLE width=$section_width cellspacing=0 cellpadding=1>\n";

	$o=0;
	while ($filters_to_print > $o) {
		$row=mysql_fetch_row($rslt);
		if (eregi("1$|3$|5$|7$|9$", $o))
			{$bgcolor='bgcolor="#B9CBFD"';} 
		else
			{$bgcolor='bgcolor="#9BB9FB"';}
		echo "<tr $bgcolor><td><font size=1>$row[0]</td>";
		echo "<td><font size=1> $row[1]</td>";
		echo "<td><font size=1> $row[3] </td>";
		echo "<td><font size=1> $row[4] </td>";
		echo "<td><font size=1><a href=\"$PHP_SELF?ADD=311111111&call_time_id=$row[0]\">ΤΡΟΠΟΠΟΙΗΣΗ</a></td></tr>\n";
		$o++;
	}

echo "</TABLE></center>\n";
}

######################
# ADD=1000000000 display all state call times
######################
if ($ADD==1000000000)
{
echo "<TABLE><TR><TD>\n";

	echo "<FONT FACE=\"ARIAL,HELVETICA\" COLOR=BLACK SIZE=2>";

	$stmt="SELECT * from vicidial_state_call_times order by state_call_time_id";
	$rslt=mysql_query($stmt, $link);
	$filters_to_print = mysql_num_rows($rslt);

echo "<br>ΛΙΣΤΕΣ ΧΡΟΝΟΥ ΚΛΗΣΗΣ ΚΑΤΑΣΤΑΣΗΣ:\n";
echo "<center><TABLE width=$section_width cellspacing=0 cellpadding=1>\n";

	$o=0;
	while ($filters_to_print > $o) {
		$row=mysql_fetch_row($rslt);
		if (eregi("1$|3$|5$|7$|9$", $o))
			{$bgcolor='bgcolor="#B9CBFD"';} 
		else
			{$bgcolor='bgcolor="#9BB9FB"';}
		echo "<tr $bgcolor><td><font size=1>$row[0]</td>";
		echo "<td><font size=1> $row[1]</td>";
		echo "<td><font size=1> $row[2]</td>";
		echo "<td><font size=1> $row[3] </td>";
		echo "<td><font size=1> $row[4] </td>";
		echo "<td><font size=1><a href=\"$PHP_SELF?ADD=3111111111&call_time_id=$row[0]\">ΤΡΟΠΟΠΟΙΗΣΗ</a></td></tr>\n";
		$o++;
	}

echo "</TABLE></center>\n";
}

######################
# ADD=10000000000 display all phones
######################
if ($ADD==10000000000)
{
echo "<TABLE><TR><TD>\n";
echo "<FONT FACE=\"ARIAL,HELVETICA\" COLOR=BLACK SIZE=2>";

$EXTENlink='stage=EXTENDOWN';
$PROTOlink='stage=PROTODOWN';
$SERVERlink='stage=SERVERDOWN';
$STATUSlink='stage=STATUSDOWN';
$SQLorder='order by extension,server_ip';
if (eregi("EXTENUP",$stage)) {$SQLorder='order by extension asc';   $EXTENlink='stage=EXTENDOWN';}
if (eregi("EXTENDOWN",$stage)) {$SQLorder='order by extension desc';   $EXTENlink='stage=EXTENUP';}
if (eregi("PROTOUP",$stage)) {$SQLorder='order by protocol asc';   $PROTOlink='stage=PROTODOWN';}
if (eregi("PROTODOWN",$stage)) {$SQLorder='order by protocol desc';   $PROTOlink='stage=PROTOUP';}
if (eregi("SERVERUP",$stage)) {$SQLorder='order by server_ip asc';   $SERVERlink='stage=SERVERDOWN';}
if (eregi("SERVERDOWN",$stage)) {$SQLorder='order by server_ip desc';   $SERVERlink='stage=SERVERUP';}
if (eregi("STATUSUP",$stage)) {$SQLorder='order by status asc';   $STATUSlink='stage=STATUSDOWN';}
if (eregi("STATUSDOWN",$stage)) {$SQLorder='order by status desc';   $STATUSlink='stage=STATUSUP';}
	$stmt="SELECT * from phones $SQLorder";
	$rslt=mysql_query($stmt, $link);
	$phones_to_print = mysql_num_rows($rslt);

echo "<br>ΕΝΤΑΓΜΕΝΑ ΤΗΛΕΦΩΝΑ:\n";
echo "<center><TABLE width=$section_width cellspacing=0 cellpadding=1>\n";
echo "<tr bgcolor=black>";
echo "<td><a href=\"$PHP_SELF?ADD=10000000000&$EXTENlink\"><font size=1 color=white><B>EXTEN</B></a></td>";
echo "<td><a href=\"$PHP_SELF?ADD=10000000000&$PROTOlink\"><font size=1 color=white><B>PROTO</B></a></td>";
echo "<td><a href=\"$PHP_SELF?ADD=10000000000&$SERVERlink\"><font size=1 color=white><B>SERVER</B></a></td>";
echo "<td colspan=2><font size=1 color=white><B>DIAL PLAN</B></td>";
echo "<td><a href=\"$PHP_SELF?ADD=10000000000&$STATUSlink\"><font size=1 color=white><B>ΚΑΤΑΣΤΑΣΗ</B></a></td>";
echo "<td><font size=1 color=white><B>ΟΝΟΜΑ</B></td>";
echo "<td colspan=2><font size=1 color=white><B>VMAIL</B></td>";
echo "<td align=center><font size=1 color=white><B>LINKS</B></td></tr>\n";

	$o=0;
	while ($phones_to_print > $o) {
		$row=mysql_fetch_row($rslt);
		if (eregi("1$|3$|5$|7$|9$", $o))
			{$bgcolor='bgcolor="#B9CBFD"';} 
		else
			{$bgcolor='bgcolor="#9BB9FB"';}
		echo "<tr $bgcolor><td><a href=\"$PHP_SELF?ADD=31111111111&extension=$row[0]&server_ip=$row[5]\"><font size=1 color=black>$row[0]</font></a></td><td><font size=1>$row[16]</td><td><font size=1>$row[5]</td><td><font size=1>$row[1]</td><td><font size=1>$row[2]</td><td><font size=1>$row[8]</td><td><font size=1>$row[11]</td><td><font size=1>$row[14]</td><td><font size=1>$row[15]</td>";
		echo "<td><font size=1><a href=\"$PHP_SELF?ADD=31111111111&extension=$row[0]&server_ip=$row[5]\">ΤΡΟΠΟΠΟΙΗΣΗ</a> | <a href=\"./phone_stats.php?extension=$row[0]&server_ip=$row[5]\">ΣΤΑΤΙΣΤΙΚΑ</a></td></tr>\n";
		$o++;
	}

echo "</TABLE></center>\n";
}

######################
# ADD=100000000000 display all servers
######################
if ($ADD==100000000000)
{
echo "<TABLE><TR><TD>\n";
	echo "<FONT FACE=\"ARIAL,HELVETICA\" COLOR=BLACK SIZE=2>";

	$stmt="SELECT * from servers order by server_id";
	$rslt=mysql_query($stmt, $link);
	$phones_to_print = mysql_num_rows($rslt);

echo "<br>ΕΝΤΑΓΜΕΝΟΙ ΔΙΑΚΟΜΙΣΤΕΣ:\n";
echo "<center><TABLE width=$section_width cellspacing=0 cellpadding=1>\n";

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
		echo "<td><font size=1><a href=\"$PHP_SELF?ADD=311111111111&server_id=$row[0]\">ΤΡΟΠΟΠΟΙΗΣΗ</a></td></tr>\n";
		$o++;
	}

echo "</TABLE></center>\n";
}

######################
# ADD=1000000000000 display all conferences
######################
if ($ADD==1000000000000)
{
echo "<TABLE><TR><TD>\n";
	echo "<FONT FACE=\"ARIAL,HELVETICA\" COLOR=BLACK SIZE=2>";

	$stmt="SELECT * from conferences order by conf_exten";
	$rslt=mysql_query($stmt, $link);
	$phones_to_print = mysql_num_rows($rslt);

echo "<br>ΕΝΤΑΓΜΕΝΕΣ ΣΥΝΔΙΑΛΕΞΕΙΣ:\n";
echo "<center><TABLE width=$section_width cellspacing=0 cellpadding=1>\n";

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
		echo "<td><font size=1><a href=\"$PHP_SELF?ADD=3111111111111&conf_exten=$row[0]&server_ip=$row[1]\">ΤΡΟΠΟΠΟΙΗΣΗ</a></td></tr>\n";
		$o++;
	}

echo "</TABLE></center>\n";
}

######################
# ADD=10000000000000 display all vicidial conferences
######################
if ($ADD==10000000000000)
{
echo "<TABLE><TR><TD>\n";
	echo "<FONT FACE=\"ARIAL,HELVETICA\" COLOR=BLACK SIZE=2>";

	$stmt="SELECT * from vicidial_conferences order by conf_exten";
	$rslt=mysql_query($stmt, $link);
	$phones_to_print = mysql_num_rows($rslt);

echo "<br>ΕΝΤΑΓΜΕΝΕΣ ΣΥΝΔΙΑΛΕΞΕΙΣ:\n";
echo "<center><TABLE width=$section_width cellspacing=0 cellpadding=1>\n";

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
		echo "<td><font size=1><a href=\"$PHP_SELF?ADD=31111111111111&conf_exten=$row[0]&server_ip=$row[1]\">ΤΡΟΠΟΠΟΙΗΣΗ</a></td></tr>\n";
		$o++;
	}

echo "</TABLE></center>\n";
}

######################
# ADD=999999 display reports section
######################
if ($ADD==999999)
{
	if ($LOGview_reports==1)
	{
	echo "<TABLE><TR><TD>\n";
	echo "<FONT FACE=\"ARIAL,HELVETICA\" COLOR=BLACK SIZE=2>";

	$stmt="SELECT * from vicidial_conferences order by conf_exten";
	$rslt=mysql_query($stmt, $link);
	$phones_to_print = mysql_num_rows($rslt);

	$stmt="select * from servers;";
	$rslt=mysql_query($stmt, $link);
	if ($DB) {echo "$stmt\n";}
	$servers_to_print = mysql_num_rows($rslt);
	$i=0;
	while ($i < $servers_to_print)
		{
		$row=mysql_fetch_row($rslt);
		$server_id[$i] =			$row[0];
		$server_description[$i] =	$row[1];
		$server_ip[$i] =			$row[2];
		$active[$i] =				$row[3];
		$i++;
		}

	$stmt="SELECT enable_queuemetrics_logging,queuemetrics_url from system_settings;";
	$rslt=mysql_query($stmt, $link);
	$row=mysql_fetch_row($rslt);
	$enable_queuemetrics_logging_LU =	$row[0];
	$queuemetrics_url_LU =				$row[1];

	?>

	<HTML>
	<HEAD>

	<META HTTP-EQUIV="Content-Type" CONTENT="text/html; charset=utf-8">
	<TITLE>VICIDIAL: Στατιστικά Διακομιστή and Reports</TITLE></HEAD><BODY BGCOLOR=WHITE>
	<FONT SIZE=4><B>VICIDIAL: Στατιστικά Διακομιστή and Reports</B></font><BR><BR>
	<UL>
	<LI><a href="AST_timeonVDADall.php"><FONT FACE="ARIAL,HELVETICA" COLOR=BLACK SIZE=2>TIME ON VDAD (per campaign)</a> &nbsp;  <a href="AST_timeonVDADallSUMMARY.php"><FONT FACE="ARIAL,HELVETICA" COLOR=BLACK SIZE=2>(all campaigns SUMMARY)</a> &nbsp; &nbsp; SIP <a href="AST_timeonVDADall.php?SIPmonitorLINK=1"><FONT FACE="ARIAL,HELVETICA" COLOR=BLACK SIZE=2>Listen</a> - <a href="AST_timeonVDADall.php?SIPmonitorLINK=2"><FONT FACE="ARIAL,HELVETICA" COLOR=BLACK SIZE=2>Barge</a> &nbsp; &nbsp; IAX <a href="AST_timeonVDADall.php?IAXmonitorLINK=1"><FONT FACE="ARIAL,HELVETICA" COLOR=BLACK SIZE=2>Listen</a> - <a href="AST_timeonVDADall.php?IAXmonitorLINK=2"><FONT FACE="ARIAL,HELVETICA" COLOR=BLACK SIZE=2>Barge</a></FONT>
	<LI><a href="AST_parkstats.php"><FONT FACE="ARIAL,HELVETICA" COLOR=BLACK SIZE=2>ΑΝΑΦΟΡΑ ΣΤΑΘΜΕΥΣΗΣ</a></FONT>
	<LI><a href="AST_VDADstats.php"><FONT FACE="ARIAL,HELVETICA" COLOR=BLACK SIZE=2>ΑΝΑΦΟΡΑ VDAD</a></FONT>
	<LI><a href="AST_CLOSERstats.php"><FONT FACE="ARIAL,HELVETICA" COLOR=BLACK SIZE=2>ΑΝΑΦΟΡΑ CLOSER</a></FONT>
	<LI><a href="AST_agent_performance.php"><FONT FACE="ARIAL,HELVETICA" COLOR=BLACK SIZE=2>ΧΕΙΡΙΣΤΗΣΑΠΟΔΟΣΗ</a></FONT>
	<LI><a href="AST_agent_performance_detail.php"><FONT FACE="ARIAL,HELVETICA" COLOR=BLACK SIZE=2>ΧΕΙΡΙΣΤΗΣΑΠΟΔΟΣΗ DETAIL</a></FONT>
	<LI><a href="AST_server_performance.php"><FONT FACE="ARIAL,HELVETICA" COLOR=BLACK SIZE=2>ΔΙΑΚΟΜΙΣΤΗΣ ΑΠΟΔΟΣΗ</a></FONT>
<?
	if ($enable_queuemetrics_logging_LU > 0)
		{
		echo "<LI><a href=\"$queuemetrics_url_LU\"><FONT FACE=\"ARIAL,HELVETICA\" COLOR=BLACK SIZE=2>QUEUEMETRICS ΑΝΑΦΟΡΕΣ</a></FONT>\n";
		}
?>
	</UL>
	<PRE><TABLE Border=1 CELLPADDING=0 cellspacing=0>
	<TR><TD>SERVER</TD><TD>ΠΕΡΙΓΡΑΦΗ</TD><TD>IP ADDRESS</TD><TD>ΕΝΕΡΓΟ</TD><TD>VDAD time</TD><TD>PARK time</TD><TD>CLOSER/INBOUND time</TD></TR>
	<? 

		$o=0;
		while ($servers_to_print > $o)
		{
		echo "<TR>\n";
		echo "<TD>$server_id[$o]</TD>\n";
		echo "<TD>$server_description[$o]</TD>\n";
		echo "<TD>$server_ip[$o]</TD>\n";
		echo "<TD>$active[$o]</TD>\n";
		echo "<TD><a href=\"AST_timeonVDAD.php?server_ip=$server_ip[$o]\">LINK</a></TD>\n";
		echo "<TD><a href=\"AST_timeonpark.php?server_ip=$server_ip[$o]\">LINK</a></TD>\n";
		echo "<TD><a href=\"AST_timeonVDAD.php?server_ip=$server_ip[$o]&closer_display=1\">LINK</a></TD>\n";
		echo "</TR>\n";
		$o++;
		}

	echo "</TABLE>\n";
	}
	else
	{
	echo "Δεν έχετε την άδεια να δείτε αυτήν την σελίδα\n";
	exit;
	}
}





echo "</TD></TR></TABLE></center>\n";

$ENDtime = date("U");

$RUNtime = ($ENDtime - $STARTtime);

echo "\n\n\n<br><br><br>\n\n";


echo "<font size=0>\n\n\n<br><br><br>\nχρόνος εκτέλεσης διαδικασίας: $RUNtime seconds";
echo " &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; ΕΚΔΟΣΗ: $admin_version";
echo " &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; ΔΗΜΙΟΥΡΓΙΑ: $build</font>\n";


?>


</TD></TR><TABLE>
</body>
</html>

<?
	
exit;




##### CALCULATE DIALABLE LEADS #####
function dialable_leads($DB,$link,$local_call_time,$dial_statuses,$camp_lists,$fSQL)
{
##### BEGIN calculate what gmt_offset_now values are within the allowed local_call_time setting ###
if (isset($camp_lists))
	{
	if (strlen($camp_lists)>1)
		{
		if (strlen($dial_statuses)>2)
			{
			$g=0;
			$p='13';
			$GMT_gmt[0] = '';
			$GMT_hour[0] = '';
			$GMT_day[0] = '';
			while ($p > -13)
				{
				$pzone=3600 * $p;
				$pmin=(gmdate("i", time() + $pzone));
				$phour=( (gmdate("G", time() + $pzone)) * 100);
				$pday=gmdate("w", time() + $pzone);
				$tz = sprintf("%.2f", $p);	
				$GMT_gmt[$g] = "$tz";
				$GMT_day[$g] = "$pday";
				$GMT_hour[$g] = ($phour + $pmin);
				$p = ($p - 0.25);
				$g++;
				}

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
				if (strlen($state_rules[$b])>1)
					{
					$stmt="SELECT * from vicidial_state_call_times where state_call_time_id='$state_rules[$b]';";
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
						if ($GMT_day[$r]==0)	#### Sunday τοπικός χρόνος
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
						if ($GMT_day[$r]==1)	#### Monday τοπικός χρόνος
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
						if ($GMT_day[$r]==2)	#### Tuesday τοπικός χρόνος
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
						if ($GMT_day[$r]==3)	#### Wednesday τοπικός χρόνος
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
						if ($GMT_day[$r]==4)	#### Thursday τοπικός χρόνος
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
						if ($GMT_day[$r]==5)	#### Friday τοπικός χρόνος
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
						if ($GMT_day[$r]==6)	#### Saturday τοπικός χρόνος
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

			$r=0;
			$default_gmt='';
			while($r < $g)
				{
				if ($GMT_day[$r]==0)	#### Sunday τοπικός χρόνος
					{
					if (($Gct_sunday_start==0) and ($Gct_sunday_stop==0))
						{
						if ( ($GMT_hour[$r]>=$Gct_default_start) and ($GMT_hour[$r]<$Gct_default_stop) )
							{$default_gmt.="'$GMT_gmt[$r]',";}
						}
					else
						{
						if ( ($GMT_hour[$r]>=$Gct_sunday_start) and ($GMT_hour[$r]<$Gct_sunday_stop) )
							{$default_gmt.="'$GMT_gmt[$r]',";}
						}
					}
				if ($GMT_day[$r]==1)	#### Monday τοπικός χρόνος
					{
					if (($Gct_monday_start==0) and ($Gct_monday_stop==0))
						{
						if ( ($GMT_hour[$r]>=$Gct_default_start) and ($GMT_hour[$r]<$Gct_default_stop) )
							{$default_gmt.="'$GMT_gmt[$r]',";}
						}
					else
						{
						if ( ($GMT_hour[$r]>=$Gct_monday_start) and ($GMT_hour[$r]<$Gct_monday_stop) )
							{$default_gmt.="'$GMT_gmt[$r]',";}
						}
					}
				if ($GMT_day[$r]==2)	#### Tuesday τοπικός χρόνος
					{
					if (($Gct_tuesday_start==0) and ($Gct_tuesday_stop==0))
						{
						if ( ($GMT_hour[$r]>=$Gct_default_start) and ($GMT_hour[$r]<$Gct_default_stop) )
							{$default_gmt.="'$GMT_gmt[$r]',";}
						}
					else
						{
						if ( ($GMT_hour[$r]>=$Gct_tuesday_start) and ($GMT_hour[$r]<$Gct_tuesday_stop) )
							{$default_gmt.="'$GMT_gmt[$r]',";}
						}
					}
				if ($GMT_day[$r]==3)	#### Wednesday τοπικός χρόνος
					{
					if (($Gct_wednesday_start==0) and ($Gct_wednesday_stop==0))
						{
						if ( ($GMT_hour[$r]>=$Gct_default_start) and ($GMT_hour[$r]<$Gct_default_stop) )
							{$default_gmt.="'$GMT_gmt[$r]',";}
						}
					else
						{
						if ( ($GMT_hour[$r]>=$Gct_wednesday_start) and ($GMT_hour[$r]<$Gct_wednesday_stop) )
							{$default_gmt.="'$GMT_gmt[$r]',";}
						}
					}
				if ($GMT_day[$r]==4)	#### Thursday τοπικός χρόνος
					{
					if (($Gct_thursday_start==0) and ($Gct_thursday_stop==0))
						{
						if ( ($GMT_hour[$r]>=$Gct_default_start) and ($GMT_hour[$r]<$Gct_default_stop) )
							{$default_gmt.="'$GMT_gmt[$r]',";}
						}
					else
						{
						if ( ($GMT_hour[$r]>=$Gct_thursday_start) and ($GMT_hour[$r]<$Gct_thursday_stop) )
							{$default_gmt.="'$GMT_gmt[$r]',";}
						}
					}
				if ($GMT_day[$r]==5)	#### Friday τοπικός χρόνος
					{
					if (($Gct_friday_start==0) and ($Gct_friday_stop==0))
						{
						if ( ($GMT_hour[$r]>=$Gct_default_start) and ($GMT_hour[$r]<$Gct_default_stop) )
							{$default_gmt.="'$GMT_gmt[$r]',";}
						}
					else
						{
						if ( ($GMT_hour[$r]>=$Gct_friday_start) and ($GMT_hour[$r]<$Gct_friday_stop) )
							{$default_gmt.="'$GMT_gmt[$r]',";}
						}
					}
				if ($GMT_day[$r]==6)	#### Saturday τοπικός χρόνος
					{
					if (($Gct_saturday_start==0) and ($Gct_saturday_stop==0))
						{
						if ( ($GMT_hour[$r]>=$Gct_default_start) and ($GMT_hour[$r]<$Gct_default_stop) )
							{$default_gmt.="'$GMT_gmt[$r]',";}
						}
					else
						{
						if ( ($GMT_hour[$r]>=$Gct_saturday_start) and ($GMT_hour[$r]<$Gct_saturday_stop) )
							{$default_gmt.="'$GMT_gmt[$r]',";}
						}
					}
				$r++;
				}

			$default_gmt = "$default_gmt'99'";
			$all_gmtSQL = "(gmt_offset_now IN($default_gmt) $ct_statesSQL) $ct_state_gmt_SQL";


			$dial_statuses = preg_replace("/ -$/","",$dial_statuses);
			$Dstatuses = explode(" ", $dial_statuses);
			$Ds_to_print = (count($Dstatuses) - 0);
			$Dsql = '';
			$o=0;
			while ($Ds_to_print > $o) 
				{
				$o++;
				$Dsql .= "'$Dstatuses[$o]',";
				}
			$Dsql = preg_replace("/,$/","",$Dsql);

			$stmt="SELECT count(*) FROM vicidial_list where called_since_last_reset='N' and status IN($Dsql) and list_id IN($camp_lists) and ($all_gmtSQL) $fSQL";
			#$DB=1;
			if ($DB) {echo "$stmt\n";}
			$rslt=mysql_query($stmt, $link);
			$rslt_rows = mysql_num_rows($rslt);
			if ($rslt_rows)
				{
				$rowx=mysql_fetch_row($rslt);
				$active_leads = "$rowx[0]";
				}
			else {$active_leads = '0';}

			echo "|$DB|\n";
			echo "Αυτή η εκστρατεία έχει$active_leads οδηγοί που καλούντε στις λίστες\n";
			}
		else
			{
			echo "καμία θέση πινάκων που επιλέγεται για αυτήν την εκστρατεία\n";
			}
		}
	else
		{
		echo "δεν έχουν επιλεχθεί ενεργές λίστες για την εκστρατεία\n";
		}
	}
else
	{
	echo "δεν έχουν επιλεχθεί ενεργές λίστες για την εκστρατεία\n";
	}
##### END calculate what gmt_offset_now values are within the allowed local_call_time setting ###
}
?>
