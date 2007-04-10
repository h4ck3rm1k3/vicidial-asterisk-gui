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
if (isset($_GET["ENVIAR"]))	{$ENVIAR=$_GET["ENVIAR"];}
	elseif (isset($_POST["ENVIAR"]))	{$ENVIAR=$_POST["ENVIAR"];}
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
    echo "Usted ahora ha salido. Gracias\n";
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
    echo "Nombre y contraseña inválidos del usuario: |$PHP_AUTH_USER|$PHP_AUTH_PW|\n";
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
echo "<!-- VERSIÓN: $admin_version   CONSTRUCCION: $build   ADD: $ADD   PHP_SELF: $PHP_SELF-->\n";
echo "<title>VICIDIAL ADMIN: ";

if (!isset($ADD))   {$ADD=0;}

if ($ADD==1)			{$hh='users';		echo "Añadir un Usuario";}
if ($ADD==11)			{$hh='campaigns';	echo "Añadir una Campaña";}
if ($ADD==111)			{$hh='lists';		echo "Añadir una Lista";}
if ($ADD==121)			{$hh='lists';		echo "Agregue DNC Nuevo";}
if ($ADD==1111)			{$hh='ingroups';	echo "Añadir un Grupo-Entrantes";}
if ($ADD==11111)		{$hh='remoteagent';	echo "Añadir Agentes Remotos";}
if ($ADD==111111)		{$hh='usergroups';	echo "Añadir un Grupo De Usuarios";}
if ($ADD==1111111)		{$hh='scripts';		echo "Agregue La Nueva Escritura";}
if ($ADD==11111111)		{$hh='filters';		echo "Agregue El Filtro Nuevo";}
if ($ADD==111111111)	{$hh='admin';	$sh='times';	echo "Agregue El Nuevo Tiempo De la Llamada";}
if ($ADD==1111111111)	{$hh='admin';	$sh='times';	echo "Agregue El Nuevo Tiempo De la Llamada Del Estado";}
if ($ADD==11111111111)	{$hh='admin';	$sh='phones';	echo "NUEVO TELÉFONO";}
if ($ADD==111111111111)	{$hh='admin';	$sh='server';	echo "NUEVO SERVIDOR";}
if ($ADD==1111111111111)	{$hh='admin';	$sh='conference';	echo "NUEVA CONFERENCIA";}
if ($ADD==11111111111111)	{$hh='admin';	$sh='conference';	echo "ADD NEW VICIDIAL CONFERENCE";}
if ($ADD==2)			{$hh='users';		echo "Nueva Adición De Usuario";}
if ($ADD==21)			{$hh='campaigns';	echo "Nueva Adición De la Campaña";}
if ($ADD==22)			{$hh='campaigns';	echo "Nueva Adición Del Estado De la Campaña";}
if ($ADD==23)			{$hh='campaigns';	echo "New Campaña HotKey Addition";}
if ($ADD==25)			{$hh='campaigns';	echo "El Nuevo Plomo De la Campaña Recicla La Adición";}
if ($ADD==26)			{$hh='campaigns';	echo "Nuevo Estado Del Dial Del Alt Del Automóvil";}
if ($ADD==27)			{$hh='campaigns';	echo "Nuevo Código De la Pausa Del Agente";}
if ($ADD==28)			{$hh='campaigns';	echo "Estado Del Dial De la Campaña Agregado";}
if ($ADD==211)			{$hh='lists';		echo "Nueva Adición De la Lista";}
if ($ADD==2111)			{$hh='ingroups';	echo "Nueva Adición Del Grupo de Entrantes";}
if ($ADD==21111)		{$hh='remoteagent';	echo "Nueva Adición de Agentes Remotos";}
if ($ADD==211111)		{$hh='usergroups';	echo "Nueva Adición Del Grupo De Usuarios";}
if ($ADD==2111111)		{$hh='scripts';		echo "Nueva Adición De la Escritura";}
if ($ADD==21111111)		{$hh='filters';		echo "Nueva Adición Del Filtro";}
if ($ADD==211111111)	{$hh='admin';	$sh='times';	echo "Nueva Adición Del Tiempo De la Llamada";}
if ($ADD==2111111111)	{$hh='admin';	$sh='times';	echo "Nueva Adición Del Tiempo De la Llamada Del Estado";}
if ($ADD==21111111111)	{$hh='admin';	$sh='phones';	echo "CREANDO TELÉFONO";}
if ($ADD==211111111111)	{$hh='admin';	$sh='server';	echo "CREANDO SERVIDOR";}
if ($ADD==221111111111)	{$hh='admin';	$sh='server';	echo "ADICIÓN DEL NUEVO EXPEDIENTE DEL TRONCO DEL SERVIDOR VICIDIAL";}
if ($ADD==2111111111111)	{$hh='admin';	$sh='conference';	echo "CREANDO CONFERENCIA";}
if ($ADD==21111111111111)	{$hh='admin';	$sh='conference';	echo "ADDING NEW VICIDIAL CONFERENCE";}
if ($ADD==3)			{$hh='users';		echo "Modificar Usuario";}
if ($ADD==30)			{$hh='campaigns';	echo "Campaña No permitida";}
if ($ADD==31)			{$hh='campaigns';	echo "Modifcar Campaña";}
if ($ADD==34)			{$hh='campaigns';	echo "Modificar Campaña - Vista Básica";}
if ($ADD==311)			{$hh='lists';		echo "Modificar Lista";}
if ($ADD==3111)			{$hh='ingroups';	echo "Modificar In-Group";}
if ($ADD==31111)		{$hh='remoteagent';	echo "Modificar Agentes Remotos";}
if ($ADD==311111)		{$hh='usergroups';	echo "Modificar Grupos De Usuarios";}
if ($ADD==3111111)		{$hh='scripts';		echo "Modifique La Escritura";}
if ($ADD==31111111)		{$hh='filters';		echo "Modifique El Filtro";}
if ($ADD==311111111)	{$hh='admin';	$sh='times';	echo "Modifique El Tiempo De la Llamada";}
if ($ADD==321111111)	{$hh='admin';	$sh='times';	echo "Modifique La Lista De las Definiciones Del Estado Del Tiempo De laLlamada";}
if ($ADD==3111111111)	{$hh='admin';	$sh='times';	echo "Modifique El Tiempo De la Llamada Del Estado";}
if ($ADD==31111111111)	{$hh='admin';	$sh='phones';	echo "MODIFICAR EL TELÉFONO";}
if ($ADD==311111111111)	{$hh='admin';	$sh='server';	echo "MODIFICAR EL SERVIDOR";}
if ($ADD==3111111111111)	{$hh='admin';	$sh='conference';	echo "MODIFICAR LA CONFERENCIA";}
if ($ADD==31111111111111)	{$hh='admin';	$sh='conference';	echo "MODIFY VICIDIAL CONFERENCE";}
if ($ADD==311111111111111)	{$hh='admin';	$sh='settings';	echo "MODIFIQUE LOS AJUSTES DEL SISTEMA DE VICIDIAL";}
if ($ADD=="4A")			{$hh='users';		echo "Modificar Usuario - Admin";}
if ($ADD=="4B")			{$hh='users';		echo "Modificar Usuario - Admin";}
if ($ADD==4)			{$hh='users';		echo "Modificar Usuario";}
if ($ADD==41)			{$hh='campaigns';	echo "Modifcar Campaña";}
if ($ADD==42)			{$hh='campaigns';	echo "Modifcar Campaña Status";}
if ($ADD==43)			{$hh='campaigns';	echo "Modifcar Campaña HotKey";}
if ($ADD==44)			{$hh='campaigns';	echo "Modificar Campaña - Vista Básica";}
if ($ADD==45)			{$hh='campaigns';	echo "Modifique El Plomo De la Campaña Reciclan";}
if ($ADD==47)			{$hh='campaigns';	echo "Modifique El Código De la Pausa Del Agente";}
if ($ADD==411)			{$hh='lists';		echo "Modificar Lista";}
if ($ADD==4111)			{$hh='ingroups';	echo "Modificar In-Group";}
if ($ADD==41111)		{$hh='remoteagent';	echo "Modificar Agentes Remotos";}
if ($ADD==411111)		{$hh='usergroups';	echo "Modificar Grupos De Usuarios";}
if ($ADD==4111111)		{$hh='scripts';		echo "Modifique La Escritura";}
if ($ADD==41111111)		{$hh='filters';		echo "Modifique El Filtro";}
if ($ADD==411111111)	{$hh='admin';	$sh='times';	echo "Modifique El Tiempo De la Llamada";}
if ($ADD==4111111111)	{$hh='admin';	$sh='times';	echo "Modifique El Tiempo De la Llamada Del Estado";}
if ($ADD==41111111111)	{$hh='admin';	$sh='phones';	echo "MODIFICAR EL TELÉFONO";}
if ($ADD==411111111111)	{$hh='admin';	$sh='server';	echo "MODIFICAR EL SERVIDOR";}
if ($ADD==421111111111)	{$hh='admin';	$sh='server';	echo "MODIFIQUE EL EXPEDIENTE DEL TRONCO DEL SERVIDOR VICIDIAL";}
if ($ADD==4111111111111)	{$hh='admin';	$sh='conference';	echo "MODIFICAR LA CONFERENCIA";}
if ($ADD==41111111111111)	{$hh='admin';	$sh='conference';	echo "MODIFY VICIDIAL CONFERENCE";}
if ($ADD==411111111111111)	{$hh='admin';	$sh='settings';	echo "MODIFIQUE LOS AJUSTES DEL SISTEMA DE VICIDIAL";}
if ($ADD==5)			{$hh='users';		echo "Delete User";}
if ($ADD==51)			{$hh='campaigns';	echo "Delete Campaña";}
if ($ADD==52)			{$hh='campaigns';	echo "Agentes Del Registro de estado de la máquina";}
if ($ADD==53)			{$hh='campaigns';	echo "Claro Del Atasco De la Emergencia VDAC";}
if ($ADD==511)			{$hh='lists';		echo "Delete List";}
if ($ADD==5111)			{$hh='ingroups';	echo "Delete In-Group";}
if ($ADD==51111)		{$hh='remoteagent';	echo "Suprima los agentes alejados";}
if ($ADD==511111)		{$hh='usergroups';	echo "Usuarios de la cancelación Group";}
if ($ADD==5111111)		{$hh='scripts';		echo "Escritura De la Cancelación";}
if ($ADD==51111111)		{$hh='filters';		echo "Filtro De la Cancelación";}
if ($ADD==511111111)	{$hh='admin';	$sh='times';	echo "Delete Call Time";}
if ($ADD==5111111111)	{$hh='admin';	$sh='times';	echo "Tiempo De la Llamada Del Estado De la Cancelación";}
if ($ADD==51111111111)	{$hh='admin';	$sh='phones';	echo "DELETE PHONE";}
if ($ADD==511111111111)	{$hh='admin';	$sh='server';	echo "DELETE SERVER";}
if ($ADD==5111111111111)	{$hh='admin';	$sh='conference';	echo "DELETE CONFERENCE";}
if ($ADD==51111111111111)	{$hh='admin';	$sh='conference';	echo "DELETE VICIDIAL CONFERENCE";}
if ($ADD==6)			{$hh='users';		echo "Delete User";}
if ($ADD==61)			{$hh='campaigns';	echo "Delete Campaña";}
if ($ADD==62)			{$hh='campaigns';	echo "Agentes Del Registro de estado de la máquina";}
if ($ADD==63)			{$hh='campaigns';	echo "Claro Del Atasco De la Emergencia VDAC";}
if ($ADD==65)			{$hh='campaigns';	echo "El Plomo De la Cancelación Recicla";}
if ($ADD==66)			{$hh='campaigns';	echo "Estado Auto Del Dial Del Alt De la Cancelación";}
if ($ADD==67)			{$hh='campaigns';	echo "Código De la Pausa Del Agente De la Cancelación";}
if ($ADD==68)			{$hh='campaigns';	echo "El Estado Del Dial De la Campaña Quitó";}
if ($ADD==611)			{$hh='lists';		echo "Delete List";}
if ($ADD==6111)			{$hh='ingroups';	echo "Delete In-Group";}
if ($ADD==61111)		{$hh='remoteagent';	echo "Suprima los agentes alejados";}
if ($ADD==611111)		{$hh='usergroups';	echo "Usuarios de la cancelación Group";}
if ($ADD==6111111)		{$hh='scripts';		echo "Escritura De la Cancelación";}
if ($ADD==61111111)		{$hh='filters';		echo "Filtro De la Cancelación";}
if ($ADD==611111111)	{$hh='admin';	$sh='times';	echo "Delete Call Time";}
if ($ADD==6111111111)	{$hh='admin';	$sh='times';	echo "Tiempo De la Llamada Del Estado De la Cancelación";}
if ($ADD==61111111111)	{$hh='admin';	$sh='phones';	echo "DELETE PHONE";}
if ($ADD==611111111111)	{$hh='admin';	$sh='server';	echo "DELETE SERVER";}
if ($ADD==621111111111)	{$hh='admin';	$sh='server';	echo "EXPEDIENTE DEL TRONCO DEL SERVIDOR VICIDIAL DE LA CANCELACIÓN";}
if ($ADD==6111111111111)	{$hh='admin';	$sh='conference';	echo "DELETE CONFERENCE";}
if ($ADD==61111111111111)	{$hh='admin';	$sh='conference';	echo "DELETE VICIDIAL CONFERENCE";}
if ($ADD==73)			{$hh='campaigns';	echo "Cuenta Del Plomo De Dialable";}
if ($ADD==7111111)		{$hh='scripts';		echo "Escritura De la Inspección previo";}
if ($ADD==0)			{$hh='users';		echo "Lista De Usuarios";}
if ($ADD==8)			{$hh='users';		echo "Servicios repetidos Dentro Del Agente";}
if ($ADD==81)			{$hh='campaigns';	echo "Servicios repetidos Dentro De la Campaña";}
if ($ADD==811)			{$hh='lists';	echo "Servicios repetidos Dentro De la Lista";}
if ($ADD==8111)			{$hh='usergroups';	echo "Servicios repetidos Dentro Del Grupo De Usuario";}
if ($ADD==10)			{$hh='campaigns';	echo "Campañas";}
if ($ADD==100)			{$hh='lists';		echo "Listas";}
if ($ADD==1000)			{$hh='ingroups';	echo "In-Groups";}
if ($ADD==10000)		{$hh='remoteagent';	echo "Agentes Remotos";}
if ($ADD==100000)		{$hh='usergroups';	echo "Grupos De Usuario";}
if ($ADD==1000000)		{$hh='scripts';		echo "Escrituras";}
if ($ADD==10000000)		{$hh='filters';		echo "Filtros";}
if ($ADD==100000000)	{$hh='admin';	$sh='times';	echo "Tiempos De la Llamada";}
if ($ADD==1000000000)	{$hh='admin';	$sh='times';	echo "Tiempos De la Llamada Del Estado";}
if ($ADD==10000000000)	{$hh='admin';	$sh='phones';	echo "LISTA DE TELÉFONOS";}
if ($ADD==100000000000)	{$hh='admin';	$sh='server';	echo "LISTA DE SERVIDORES";}
if ($ADD==1000000000000)	{$hh='admin';	$sh='conference';	echo "LISTA DE  CONFERENCIAS";}
if ($ADD==10000000000000)	{$hh='admin';	$sh='conference';	echo "VICIDIAL LISTA DE  CONFERENCIAS";}
if ($ADD==550)			{$hh='users';		echo "Formulario De Búsqueda";}
if ($ADD==551)			{$hh='users';		echo "BUSCAR TELÉFONOS";}
if ($ADD==660)			{$hh='users';		echo "RESULTADOS DE LA BÚSQUEDA";}
if ($ADD==661)			{$hh='users';		echo "RESULTADO DE LA BÚSQUEDA DE TELÉFONOS";}
if ($ADD==99999)		{$hh='users';		echo "AYUDA";}
if ($ADD==999999)		{$hh='reports';		echo "INFORMES";}

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
	$campaigns_list.="> ALL-CAMPAIGNS - LOS USUARIOS PUEDEN VISIÓN CUALQUIER CAMPAÑA</B><BR>\n";

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
$NWE = "')\"><IMG SRC=\"help.gif\" WIDTH=20 HEIGHT=20 Border=0 ALT=\"AYUDA\" ALIGN=TOP></A>";
######################
# ADD=99999 display the HELP SCREENS
######################

if ($ADD==99999)
{
echo "</title>\n";
echo "</head>\n";
echo "<BODY BGCOLOR=white marginheight=0 marginwidth=0 leftmargin=0 topmargin=0>\n";
echo "<CENTER>\n";
echo "<TABLE WIDTH=98% BGCOLOR=#E6E6E6 cellpadding=2 cellspacing=0><TR><TD ALIGN=LEFT><FONT FACE=\"ARIAL,HELVETICA\" COLOR=BLACK SIZE=4><B>VICIDIAL ADMIN: AYUDA<BR></B></FONT><FONT FACE=\"ARIAL,HELVETICA\" COLOR=BLACK SIZE=2><BR><BR>\n";

?>
<B><FONT SIZE=3>VICIDIAL_USUARIOS TABLA</FONT></B><BR><BR>
<A NAME="vicidial_users-user">
<BR>
<B>Identificación del usuario -</B> este campo es donde usted pone el número de la identificación del usuario de VICIDIAL, puede ser hasta 8 dígitos en longitud, debe ser por lo menos 2 caracteres en longitud.

<BR>
<A NAME="vicidial_users-pass">
<BR>
<B>Contraseña -</B> este campo es donde usted pone la contraseña de los usuarios de VICIDIAL. Deben ser por lo menos 2 caracteres en longitud.

<BR>
<A NAME="vicidial_users-full_name">
<BR>
<B>Nombre completo -</B> este campo es donde usted pone el nombre completo de los usuarios de VICIDIAL. Deben ser por lo menos 2 caracteres en longitud.

<BR>
<A NAME="vicidial_users-user_level">
<BR>
<B>Nivel de usuario -</B> este menú es donde usted selecciona el nivel de usuario de los usuarios de VICIDIAL. Debe ser un nivel de 1 a registrar en VICIDIAL, debe ser llano mayor de 2 a abrirse una sesión como más cercano, deben ser el nivel de usuario 8 o mayor conseguir en la sección de la tela del admin.

<BR>
<A NAME="vicidial_users-user_group">
<BR>
<B>Grupo de usuario -</B> este menú es donde usted selecciona a grupo de usuarios de VICIDIAL que este usuario pertenecerá a. Esto no tiene ninguna restricciones en este tiempo, éste es justo subdividir a usuarios y permitir las características futuras basadas sobre él.

<BR>
<A NAME="vicidial_users-phone_login">
<BR>
<B>Conexión del teléfono -</B> aquí es para donde usted puede fijar un valor de la conexión del teléfono del defecto cuando los registros del usuario en vicidial.php. Este valor poblará el phone_login automáticamente cuando el usuario entra con su usuario-pasar-campaña en la pantalla de la conexión de vicidial.php.

<BR>
<A NAME="vicidial_users-phone_pass">
<BR>
<B>Paso del teléfono -</B> aquí es para donde usted puede fijar un valor del paso del teléfono del defecto cuando los registros del usuario en vicidial.php. Este valor poblará los phone_pass automáticamente cuando el usuario entra con su usuario-pasar-campaña en la pantalla de la conexión de vicidial.php.

<BR>
<A NAME="vicidial_users-hotkeys_active">
<BR>
<B>Hot Keys activo -</B> esta opción si el sistema a 1 permite que el usuario utilice la función ra'pida-dispositioning de Hot Keys adentro vicidial.php.

<BR>
<A NAME="vicidial_users-agent_choose_ingroups">
<BR>
<B>El agente elige Ingroups -</B> esta opción si el sistema a 1 permite que el usuario elija los ingroups de los cuales recibirán llamadas cuando ellos conexión a una campaña MÁS CERCANA o DE ENTRADA. Si no el encargado necesitará fijar esto en su pantalla del detalle del usuario de la página del admin.

<BR>
<A NAME="vicidial_users-closer_campaigns">
<BR>
<B>Grupos de entrada -</B> aquí es donde usted selecciona a grupos de entrada que usted desea recibir llamadas de si usted ha seleccionado la campaña MÁS CERCANA.

<BR>
<A NAME="vicidial_users-scheduled_callbacks">
<BR>
<B>Servicios repetidos programar -</B> esta opción no prohibe a agente a la disposición una llamada como CALLBK y elige los datos y el tiempo en los cuales el plomo será reactivado.

<BR>
<A NAME="vicidial_users-agentonly_callbacks">
<BR>
<B>Servicios repetidos del Agente-Solamente -</B> esta opción permite que un agente fije un servicio repetido de modo que sean el único agente que puede llamar la parte posteriora del cliente. Esto también permite que el agente vea sus listados del servicio repetido y los llame detrás cualquier momento desean a.

<BR>
<A NAME="vicidial_users-agentcall_manual">
<BR>
<B>Manual de la llamada del agente -</B> esta opción permite que un agente incorpore manualmente un nuevo plomo en el sistema y los llame. Esto también permite llamar de cualquier número de teléfono de su pantalla vicidial y pone esa llamada en su sesión. Utilice esta opción con la precaución.

<BR>
<A NAME="vicidial_users-vicidial_recording">
<BR>
<B>Grabación de Vicidial -</B> esta opción puede evitar que un agente haga cualquier grabación después de que se abran una sesión a vicidial. Esta opción debe estar encendido para que vicidial siga la sesión de la grabación de la campaña.

<BR>
<A NAME="vicidial_users-vicidial_transfers">
<BR>
<B>Vicidial transfiere -</B> esta opción puede evitar que un agente abra la transferencia - la sesión de la conferencia de vicidial. Si esto es lisiado, el agente no puede llamada de los terceros o la transferencia oculta cualquiera llama.

<BR>
<A NAME="vicidial_users-closer_default_blended">
<BR>
<B>Un defecto más cercano mezclado -</B> esta opción omite simplemente el checkbox mezclado en una pantalla MÁS CERCANA de la conexión.

<BR>
<A NAME="vicidial_users-vicidial_recording_override">
<BR>
<B>Invalidación de la grabación de VICIDIAL -</B> esta opción seeliminará lo que es la opción en la campaña para la grabación.LISIADO no eliminará el ajuste de la grabación de la campaña. NUNCAinhabilitará la grabación en el cliente. ONDEMAND es el defecto ypermite que el agente comience y pare a registrar según lonecesitado. ALLCALLS comenzará la grabación en el cliente siempreque una llamada se envíe a un agente. ALLFORCE comenzará lagrabación en el cliente siempre que una llamada se envíe a un agenteque no da al agente ninguna opción para parar el registrar. ParaALLCALLS y ALLFORCE hay una opción para utilizar la grabaciónretrasa para reducir en grabaciones y carga de sistema muy cortas delrecude.

<BR>
<A NAME="vicidial_users-alter_custdata_override">
<BR>
<B>El agente altera la invalidación de los datos del cliente -</B> estaopción se eliminará lo que es la opción en la campaña paraalterarse de los datos del cliente. NOT_ACTIVE utilizará lo que estápresente el ajuste para la campaña. ALLOW_ALTER permitirá siemprepara que el agente altere los datos del cliente, no importa qué es elajuste de la campaña. El defecto es NOT_ACTIVE.

<BR>
<A NAME="vicidial_users-alter_agent_interface_options">
<BR>
<B>Altere las opciones de interfaz del agente -</B> esta opción si el sistema a 1 permite que el usuario administrativo modifique las opciones de interfaz de los agentes en admin.php.

<BR>
<A NAME="vicidial_users-delete_users">
<BR>
<B>Usuarios de la cancelación -</B> esta opción si el sistema a 1 permite que el usuario suprima a otros usuarios del igual o de poco nivel de usuario del sistema.

<BR>
<A NAME="vicidial_users-delete_user_groups">
<BR>
<B>Suprima a grupos de usuario -</B> esta opción si el sistema a 1 permite que el usuario suprima a grupos de usuario del sistema.

<BR>
<A NAME="vicidial_users-delete_lists">
<BR>
<B>La cancelación enumera -</B> esta opción si el sistema a 1 permite que el usuario suprima listas vicidial del sistema.

<BR>
<A NAME="vicidial_users-delete_campaigns">
<BR>
<B>La cancelación hace campaña -</B> esta opción si el sistema a 1 permite que el usuario suprima campañas vicidial del sistema.

<BR>
<A NAME="vicidial_users-delete_ingroups">
<BR>
<B>En-Grupos de la cancelación -</B> esta opción si el sistema a 1 permite que el usuario suprima a En-Grupos vicidial del sistema.

<BR>
<A NAME="vicidial_users-delete_remote_agents">
<BR>
<B>Suprima los agentes alejados -</B> esta opción si el sistema a 1 permite que el usuario suprima agentes alejados vicidial del sistema.

<BR>
<A NAME="vicidial_users-load_leads">
<BR>
<B>La carga conduce -</B> esta opción si el sistema a 1 permite que el usuario cargue los plomos vicidial en la tabla del vicidial_list por el cargador basado tela del plomo.

<BR>
<A NAME="vicidial_users-campaign_detail">
<BR>
<B>Detalle de la campaña -</B> esta opción si el sistema a 1 permite que el usuario visión y modifique los elementos de la pantalla del detalle de la campaña.

<BR>
<A NAME="vicidial_users-ast_admin_access">
<BR>
<B>Acceso de AGC Admin -</B> esta opción si el sistema a 1 permite a usuario a la conexión a las páginas astGUIclient del admin.

<BR>
<A NAME="vicidial_users-ast_delete_phones">
<BR>
<B>La cancelación de AGC telefona -</B> esta opción si el sistema a 1 permite que el usuario suprima entradas del teléfono en las páginas astGUIclient del admin.

<BR>
<A NAME="vicidial_users-delete_scripts">
<BR>
<B>Escrituras de la cancelación -</B> esta opción si el sistema a 1 permite que el usuario suprima las escrituras de la campaña en la pantalla de la modificación de la escritura.

<BR>
<A NAME="vicidial_users-modify_leads">
<BR>
<B>Modifique los plomos -</B> esta opción si el sistema a 1 permite que el usuario modifique los plomos en la página de los resultados de la búsqueda del plomo de la sección del admin.

<BR>
<A NAME="vicidial_users-change_agent_campaign">
<BR>
<B>Cambie la campaña del agente -</B> esta opción si el sistema a 1 permite que el usuario altere la campaña que un agente está registrado en mientras que se registran en él.

<BR>
<A NAME="vicidial_users-delete_filters">
<BR>
<B>La cancelación se filtra -</B> esta opción permite que el usuario pueda suprimir los filtros vicidial del plomo del sistema.

<BR>
<A NAME="vicidial_users-delete_call_times">
<BR>
<B>Tiempos de la llamada de la cancelación -</B> esta opción permite que elusuario pueda suprimir expedientes vicidial de los tiempos de lallamada y expedientes vicidial de los tiempos de la llamada del estadodel sistema.

<BR>
<A NAME="vicidial_users-modify_call_times">
<BR>
<B>Modifique los tiempos de la llamada -</B> esta opción permite que elusuario visión y modifique los expedientes de los tiempos de lallamada y de los tiempos de la llamada del estado. Un usuario nonecesita esta opción permitida si necesitan solamente cambiar laopción de los tiempos de la llamada en la pantalla de las campañas.

<BR>
<A NAME="vicidial_users-modify_sections">
<BR>
<B>Modifique las secciones -</B> estas opciones permiten que el usuariovisión y modifique cada uno los expedientes de las secciones. Si elsistema a 0, el usuario puede considerar la lista de la sección, perono el detalle o la pantalla de la modificación de un expediente enesa sección.

<BR>
<A NAME="vicidial_users-view_reports">
<BR>
<B>La visión divulga -</B> esta opción permite que el usuario visión losinformes de VICIDIAL.




<BR><BR><BR><BR>

<B><FONT SIZE=3>VICIDIAL_CAMPAIGNS TABLA</FONT></B><BR><BR>
<A NAME="vicidial_campaigns-campaign_id">
<BR>
<B>Identificación de la campaña -</B> Úste es el nombre corto de la campaña, él no es editable después de la sumisión inicial, no puede contener espacios y debe estar entre 2 y 8 caracteres en longitudh.

<BR>
<A NAME="vicidial_campaigns-campaign_name">
<BR>
<B>Nombre de la campaña -</B> Ésta es la descripción de la campaña, debe estar entre 6 y 40 caracteres en longitud.

<BR>
<A NAME="vicidial_campaigns-campaign_description">
<BR>
<B>Descripción de la campaña -</B> esto es un campo de la nota para lacampaña, es opcional y puede ser un máximo de 255 caracteres enlongitud.

<BR>
<A NAME="vicidial_campaigns-campaign_changedate">
<BR>
<B>Fecha del cambio de la campaña -</B> ésta es la vez última que losajustes para esta campaña fueron modificados de cualquier manera.

<BR>
<A NAME="vicidial_campaigns-campaign_logindate">
<BR>
<B>La fecha pasada de la conexión de la campaña -</B> ésta es la vezúltima que un agente fue registrado en esta campaña.

<BR>
<A NAME="vicidial_campaigns-campaign_stats_refresh">
<BR>
<B>Los Stats de la campaña restauran -</B> este checkbox permitirá queusted fuerce un stats vicidial restaura, incluso si la campaña no esactiva.

<BR>
<A NAME="vicidial_campaigns-active">
<BR>
<B>Activo -</B> aquí es adonde usted fija la campaña a activo o a inactivo. Si es inactivo, noone puede registrar en él.

<BR>
<A NAME="vicidial_campaigns-park_ext">
<BR>
<B>Extensión del parque -</B> aquí es donde usted puede modificar para requisitos particulares en-sostiene la música para VICIDIAL. Cerciórese de que la extensión esté en lugar en el extensions.conf y eso que señala al nombre de fichero abajo.

<BR>
<A NAME="vicidial_campaigns-park_file_name">
<BR>
<B>Nombre del archivo del parque -</B> aquí es donde usted puede modificar para requisitos particulares en-sostiene la música para VICIDIAL. Cerciórese de que el nombre de fichero sea 10 caracteres en longitud o menos y que el archivo está en lugar en el directorio de /var/lib/asterisk/sounds.

<BR>
<A NAME="vicidial_campaigns-web_form_address">
<BR>
<B>Forma del Web -</B> aquí es donde usted puede fijar el Web page de encargo que será abierto cuando el usuario chasca encendido el botón de la FORMA del WEB.

<BR>
<A NAME="vicidial_campaigns-allow_closers">
<BR>
<B>Permita Closers -</B> aquí es donde usted puede fijar si los usuarios de esta campaña tendrán la opción para enviar la llamada a un más cercano.

<BR>
<A NAME="vicidial_campaigns-dial_status">
<BR>
<B>Estado del dial -</B> aquí es adonde usted fija los estados que usted está deseando marcar encendido dentro de las listas que son activas para la campaña abajo. Para agregar otro estado al dial, selecciónelo de la lista drop-downy el tecleo AGREGA. Para quitar uno de los estados del dial, chasqueencendido el acoplamiento del QUITAR al lado del estado que usteddesea quitar.

<BR>
<A NAME="vicidial_campaigns-lead_order">
<BR>
<B>Orden de la lista -</B> Este menú es donde usted selecciona cómo los plomos que emparejan los estados seleccionados arriba serán puestos en la tolva del plomo:
 <BR> &nbsp; - DOWN: seleccione los primeros plomos cargados en la tabla del vicidial_list
 <BR> &nbsp; - UP: seleccione los plomos pasados cargados en la tabla del vicidial_list
 <BR> &nbsp; - UP PHONE: seleccione el número y los trabajos más altos de teléfono su manera abajo
 <BR> &nbsp; - DOWN PHONE: seleccione el número y los trabajos más bajos de teléfono su manera para arriba
 <BR> &nbsp; - UP LAST NAME: comienzo con los nombres pasados comenzando con Z y trabajos su manera abajo
 <BR> &nbsp; - DOWN LAST NAME: comienzo con los nombres pasados comenzando con A y trabajos su manera para arriba
 <BR> &nbsp; - UP COUNT: comienzo con los plomos y los trabajos llamados su manera abajo
 <BR> &nbsp; - DOWN COUNT: comienzo con menos plomos y trabajos llamados su manera para arriba
 <BR> &nbsp; - DOWN COUNT 2nd NEW: comienzo con menos plomos y trabajos llamados su manera para arriba que inserta un NEW plomo en cada otro lead(Must para no tener NEW seleccionado en los estados del dial)
 <BR> &nbsp; - DOWN COUNT 3nd NEW: comienzo con menos plomos y trabajos llamados su manera para arriba que inserta un NEW plomo en cada tercer lead(Must para no tener NEW seleccionado en los estados del dial)
 <BR> &nbsp; - DOWN COUNT 4th NEW: comienzo con menos plomos y trabajos llamados que su manera para arriba que inserta un NEW plomo en cada adelante conduzca (no debe tener NEW seleccionado en los estados del dial)

<BR>
<A NAME="vicidial_campaigns-hopper_level">
<BR>
<B>Tolva llana -</B> éste es cuántos conducen los intentos de la escritura de VDhopper para mantener la tabla del vicidial_hopper para esta campaña. Si funciona la escritura de VDhopper cada minuto, haga esto levemente mayor que el número de plomos que usted entra a través en un minuto.

<BR>
<A NAME="vicidial_campaigns-lead_filter_id">
<BR>
<B>Filtro del plomo -</B> éste es un método de filtrar sus plomos usando un fragmento de una pregunta del SQL. Utilice esta característica con la precaución, él es fácil de parar el marcar accidentalmente con la alteración más leve a la declaración del SQL. El defecto no es NINGUNO.

<BR>
<A NAME="vicidial_campaigns-force_reset_hopper">
<BR>
<B>Reajuste de la fuerza de la tolva -</B> esto permite que usted limpie fuera del contenido de la tolva sobre la sumisión de la forma. Debe ser llenada otra vez cuando la escritura de VDhopper funciona.

<BR>
<A NAME="vicidial_campaigns-dial_method">
<BR>
<B>Método del dial -</B> Este campo es la manera de definir cómo el marcar debe ocurrir. Si el MANUAL entonces el auto_dial_level es bloqueado en 0 a menos que se cambie el método del dial. Si COCIENTE entonces el normal marcando un número de líneas para los agentes activos. ADAPT_HARD_LIMIT marcará predictively hasta el porcentaje caído y después no permitirá marcar agresivo una vez que se alcance el límite de la gota hasta que va el porcentaje abajo otra vez. ADAPT_TAPERED permite para el excedente de funcionamiento el porcentaje caído por la mitad primer de la cambio - según lo definido por el call_time seleccionado para la campaña y consigue más terminante mientras que se enciende la cambio. ADAPT_AVERAGE intenta mantener un promedio o el porcentaje caído que no impone límites duros tan agresivamente como los otros dos métodos. Usted no puede cambiar el nivel auto del dial si usted está en cualesquiera de los métodos del dial del ADAPTAR. Solamente el sintonizador puede cambiar el nivel del dial cuando en modo que marca profético.

<BR>
<A NAME="vicidial_campaigns-auto_dial_level">
<BR>
<B>Nivel auto del dial -</B> aquí es adonde usted fija cuántos alinea VICIDIAL debe utilizar por medios del agente activo cero 0 que el marcar del automóvil está apagado y los agentes chascarán para marcar cada número. Si no VICIDIAL mantendrá líneas que marcan iguales a los agentes activos multiplicados por el nivel del dial para llegar cuántas líneas debe permitir esta campaña en cada servidor. El checkbox de la INVALIDACIÓN del ADAPTAR permite que usted fuerceun nuevo nivel del dial aunque el método del dial está en un mododel ADAPTAR. Esto es útil si hay una cambio dramática en la calidadde plomos y usted desea cambiar drástico el dial_level manualmente.

<BR>
<A NAME="vicidial_campaigns-available_only_ratio_tally">
<BR>
<B>Solamente cuenta disponible -</B> este campo si el sistema a Y deja haciafuera los agentes del estado de INCALL y de la COLETA al calcular elnúmero de llamadas al dial cuando no en modo de dial MANUAL. Eldefecto es N.

<BR>
<A NAME="vicidial_campaigns-adaptive_dropped_percentage">
<BR>
<B>Límite del porcentaje de la gota -</B> este campo es donde usted fijó ellímite del porcentaje de llamadas caídas que usted quisiera mientrasque usaba un método adaptante-profe'tico del dial, NO MANUAL o delCOCIENTE.

<BR>
<A NAME="vicidial_campaigns-adaptive_maximum_level">
<BR>
<B>El máximo adapta el dial llano -</B> este campo es donde usted fijó ellímite del límite al numbr de líneas que usted quisiera marcado poragente mientras que usaba un método adaptante-profe'tico del dial, NOMANUAL o del COCIENTE. Este número puede ser más alto que el nivelauto del dial si su hardware lo apoya. El valor debe ser un númeropositivo mayor de uno y puede tener defecto 3.0 de los lugaresdecimales.

<BR>
<A NAME="vicidial_campaigns-adaptive_latest_server_time">
<BR>
<B>El tiempo más último del servidor -</B> este campo es utilizadosolamente por el método del dial de ADAPT_TAPERED. Usted debe entraren la hora y el minuto que usted parará el invitar de esta campaña,2100 significaría que usted parará el marcar de esta campaña en eltiempo del servidor de los 9PM. Esto permite que el algoritmo afiladodecida a cómo agresivamente al dial cerca cuánto tiempo usted tienehasta que usted será el llamar acabado.

<BR>
<A NAME="vicidial_campaigns-adaptive_intensity">
<BR>
<B>Adapte el modificante de la intensidad -</B> este campo se utiliza paraajustar la intensidad profética más alta o más baja. El más altoun número positivo que usted selecciona, mayor va el sintonizadoraumentará la llamada que establece el paso cuando para arriba y máslentamente va el sintonizador disminuirá la llamada que establece elpaso cuando abajo. Cuanto más bajo es el número negativo que ustedseleccionan aquí, más lentamente el sintonizador aumentará lallamada que establece el paso y más rápidamente el sintonizadorbajará la llamada que establece el paso cuando va abajo. El defectoes 0. Este campo no es utilizado por los métodos del dial del MANUALo del COCIENTE.

<BR>
<A NAME="vicidial_campaigns-adaptive_dl_diff_target">
<BR>
<B>Blanco llana de la diferencia del dial -</B> este campo se utiliza paradefinir si usted desea apuntar tener un número específico de losagentes que esperan agentes de las llamadas o el esperar de llamadas.Por ejemplo si usted siempre quisiera tener en agente del promedio unolibre tomar llamadas inmediatamente usted fijaría esto a -1, si ustedquisiera apuntar siempre tener uno invita el asimiento que espera unagente que usted fijaría esto a 1. El defecto es 0. Este campo no esutilizado por los métodos del dial del MANUAL o del COCIENTE.

<BR>
<A NAME="vicidial_campaigns-concurrent_transfers">
<BR>
<B>Transferencias concurrentes -</B> este ajuste se utiliza para definir elnúmero de las llamadas que se pueden enviar a los agentes en el mismotiempo. Se recomienda que este ajuste está dejado en el AUTOMÓVIL. Este campo no es utilizado por el método MANUAL del dial.

<BR>
<A NAME="vicidial_campaigns-auto_alt_dial">
<BR>
<B>Alt-Nu'mero auto que marca -</B> este ajuste se utiliza para marcarautomáticamente campos alternos del número mientras que marca en elCOCIENTE y ADAPTA métodos del dial cuando no hay contacto en elnúmero de teléfono principal para un plomo, los estados del NA, deB, de la C.C. y de N. Este ajuste no es utilizado por el métodoMANUAL del dial.

<BR>
<A NAME="vicidial_campaigns-next_agent_call">
<BR>
<B>Llamada siguiente del agente -</B> esto se determina qué agente recibe la llamada siguiente que está disponible:
 <BR> &nbsp; - random: órdenes por el valor al azar de la actualización en la tabla de los vicidial_live_agents
 <BR> &nbsp; - oldest_call_start: las órdenes por la vez última un agente fueron enviadas una llamada. Resultados en los agentes que reciben el número casi igual de llamadas cabalmente.
 <BR> &nbsp; - oldest_call_finish: las órdenes por la vez última un agente acabaron una llamada. El agente de AKA que espera lo más de largo posible recibe la primera llamada.
 <BR> &nbsp; - overall_user_level: las órdenes por el user_level del agente según lo definido en los vicidial_users tabulan un user_level más alto recibirán más llamadas.

<BR>
<A NAME="vicidial_campaigns-local_call_time">
<BR>
<B>Tiempo de la llamada local -</B> aquí es adonde usted fijó durante qué horas usted quisiera marcar, según lo determinado por el tiempo local en está en cuál usted está llamando. Esto es controlada por código de área y ajustada por tiempo de los ahorros de la luz del día si es aplicable. Las pautas generales en los E.E.U.U. para el negocio al negocio son los 9am a los 5pm y el negocio a las llamadas del consumidor es los 9am a los 9pm.

<BR>
<A NAME="vicidial_campaigns-dial_timeout">
<BR>
<B>Descanso del dial -</B> si está definido, llamadas que normalmente retraso después de que el descanso definido en extensions.conf en lugar de otro descanso en esta cantidad de segundos si es menos que el descanso de extensions.conf. Esto permite descansos del dial rápidamente que cambian del servidor al servidor y a limitar los efectos a una sola campaña. Si usted está teniendo muchos de llamadas del contestador automático o de Buzón de Voz usted puede desear intentar cambiar este valor entre a 21-26 y ver si los resultados mejoran.

<BR>
<A NAME="vicidial_campaigns-dial_prefix">
<BR>
<B>Prefijo del dial -</B> este campo permite más fácilmente cambiar una trayectoria de marcar a salir con un diverso método sin hacer una recarga en asterisco. El defecto es 9 basados sobre un 91NXXNXXXXXX en el dial plan - extensions.conf.

<BR>
<A NAME="vicidial_campaigns-omit_phone_code">
<BR>
<B>Omita el código del teléfono -</B> este campo permite que usted dejehacia fuera el campo del phone_code mientras que marca dentro deVICIDIAL. Por ejemplo si usted está marcando en el Reino Unido delReino Unido usted tendría 44 adentro como su campo del phone_codepara todos los plomos, pero usted apenas desea marcar 10 dígitos ensu extensions.conf dial plan para poner llamadas en vez de 44 entonces10 dígitos. El defecto es N.

<BR>
<A NAME="vicidial_campaigns-campaign_cid">
<BR>
<B>Campaña CallerID -</B> este campo permite enviar de un número de encargo del callerid en las llamadas de salida. Úste es el número que demostraría para arriba en el callerid de la persona que usted está llamando. El defecto es DESCONOCIDO. Esta opción está solamente disponible si usted está utilizando PRIs - ISDN T1 o E1 - que tienen la característica de encargo del callerid se giraron. Esta característica puede también trabajar con los troncos IAX2 dependiendo de lo que admite su abastecedor. El callerID de encargo se aplica solamente a las llamadas puestas para la campaña de VICIDIAL directamente, cualquier tercer persona llama o las transferencias no enviarán el callerID de encargo. NOTA: A veces el poner DESCONOCIDO o PRIVADO en el campo rendirá enviar de su número del callerID del defecto por su portador con las llamadas. Usted puede desear probar esto y poner 0000000000 en el campo del callerid en lugar de otro si usted no desea enviarle CallerID.

<BR>
<A NAME="vicidial_campaigns-campaign_vdad_exten">
<BR>
<B>Extensión de la campaña VDAD -</B> este campo permite una extensión de la transferencia del costumbre VDAD. Esto permite que usted utilice diversas escrituras del agi de VDADtransfer... dependiendo de su campaña. La transferencia AGI(exten 8365  agi-VDADtransfer.agi  del defecto) apenas envía inmediatamente invita a los agentes tan pronto como él se tome. Una encuesta sobre política AGI la muestra adicional es también (8366  agi-VDADtransferSURVEY.agi ) ese ahora incluido los juegos un mensaje a la persona llamada y permite que él haga una opción presionando buttons(effectively la pre-investigacio'n el plomo). Observe por favor eso a excepción de los exámenes, llamadas políticas y las caridades esta forma de llamar son ilegales en los Estados Unidos.

<BR>
<A NAME="vicidial_campaigns-campaign_rec_exten">
<BR>
<B>Extensión de Rec de la Campaña -</B> este campo permite para que una extensión de encargo de la grabación sea utilizada con VICIDIAL. Esto permite que usted utilice diversas extensiones dependiendo sobre cuánto tiempo usted desea permitir una grabación máxima y qué tipo de codec usted desea registrar adentro. El defecto exten es 8309 que si usted sigue los ejemplos de SCRATCH_INSTALL registrarán en el formato de WAV para hasta que una hora. Otra opción incluida en los ejemplos es 8310 que registrarán en el formato del GSM para hasta que una hora.

<BR>
<A NAME="vicidial_campaigns-campaign_recording">
<BR>
<B>Grabación de la campaña -</B> este menú permite que usted elija quénivel de la grabación se permite en esta campaña. NUNCAinhabilitará la grabación en el cliente. ONDEMAND es el defecto ypermite que el agente comience y pare a registrar según lonecesitado. ALLCALLS comenzará la grabación en el cliente siempreque una llamada se envíe a un agente. ALLFORCE comenzará lagrabación en el cliente siempre que una llamada se envíe a un agenteque no da al agente ninguna opción para parar el registrar. ParaALLCALLS y ALLFORCE hay una opción para utilizar la grabaciónretrasa para reducir en grabaciones y carga de sistema muy cortas delrecude.

<BR>
<A NAME="vicidial_campaigns-campaign_rec_filename">
<BR>
<B>Nombre de fichero de Rec de la campaña -</B> este campo permite que usted modifique el nombre para requisitos particulares de la grabación cuando la grabación de la campaña es ONDEMAND o ALLCALLS. Las variables permitidas son CAMPAIGN CUSTPHONE FULLDATE TINYDATE EPOCH AGENT. El defecto es FULLDATE_AGENTE y parecería este 20051020-103108_6666. Otro ejemplo es CAMPAIGN_TINYDATE_CUSTPHONE que parecería este TESTCAMP_51020103108_3125551212. 50 char max.

<BR>
<A NAME="vicidial_campaigns-allcalls_delay">
<BR>
<B>La registración retrasa -</B> para la grabación de ALLCALLS y deALLFORCE solamente. Esta voluntad del ajuste retrasa comenzar de lagrabación en todas las llamadas para el número de los segundosespecificados en este campo. El defecto es 0.

<BR>
<A NAME="vicidial_campaigns-campaign_script">
<BR>
<B>Escritura de la campaña -</B> este menú permite que usted elija la escritura que aparecerá en la pantalla de los agentes para esta campaña. No seleccione NONE no demostrar ninguna escritura para esta campaña.

<BR>
<A NAME="vicidial_campaigns-get_call_launch">
<BR>
<B>Consiga el lanzamiento de la llamada -</B> este menú permite que usted elija si usted desee automo'vil-lance la página en una ventana separada, auto-switch de la tela-forma a la lengüeta de la ESCRITURA o no haga nada cuando una llamada se envía al agente para esta campaña. 

<BR>
<A NAME="vicidial_campaigns-am_message_exten">
<BR>
<B>Mensaje del contestador automático -</B> este campo está para entrar en una extensión para cegar llamadas de la transferencia a cuando el agente consigue un contestador automático y chasca encendido el botón del mensaje del contestador automático en el marco de la conferencia de la transferencia. Usted debe fijar esto exten para arriba en el dial plan - extensions.conf - y se cerciora de que juega un archivo audio después que cuelga para arriba. 

<BR>
<A NAME="vicidial_campaigns-amd_send_to_vmx">
<BR>
<B>AMD envían a la VM exten -</B> este menú permite que usted defina si un mensaje esté dejado en un contestador automático cuando se detecta la llamada será remitido inmediatamente a la extensión del Contestar-Ma'quina-Mensaje si AMD es activo y se determina que la llamada es un contestador automático.

<BR>
<A NAME="vicidial_campaigns-xferconf_a_dtmf">
<BR>
<B>Xfer-Conf DTMF -</B> Estos cuatro campos permiten para que usted tenga dos sistemas de conferencia de la transferencia y de precolocaciones de DTMF. Cuando se carga la llamada o la campaña, la escritura de vicidial.php demostrará dos botones en el marco de la transferir-conferencia y automo'vil-poblara' el nu'mero-a-dial y los campos del enviar-dtmf cuando está presionada. Si usted desea permitir transferencias consultivas, un fronter a unmás cercano, usted puede colocar CXFER pues uno de lasprecolocaciones del nu'mero-a-dial y del dial string apropiado seráenviado para hacer una transferencia consultiva local, entonces lalata LEAVE-3WAY-CALL justo del agente y movimiento encendido a sullamada siguiente. Si usted desea permitir transferencias ocultas declientes a una escritura de VICIDIAL AGI para registrar o un IVR,entonces coloque AXFER en el campo del nu'mero-a-dial. Usted puedetambién especificar una extensión de encargo después del AXFER odel CXFER, por ejemplo si usted desea hacer transferencias consultivasinternas en vez de local que usted pondría CXFER90009 en el campo delnu'mero-a-dial.

<BR>
<A NAME="vicidial_campaigns-alt_number_dialing">
<BR>
<B>El marcar numérico del Alt del agente -</B> esta opción permite que un agente marque manualmente el número de teléfono o el campo alterno address3 después de que se haya llamado el número principal.

<BR>
<A NAME="vicidial_campaigns-scheduled_callbacks">
<BR>
<B>Servicios repetidos programar -</B> esta opción no prohibe a agente a la disposición una llamada como CALLBK y elige los datos y el tiempo en los cuales el plomo será reactivado.

<BR>
<A NAME="vicidial_campaigns-drop_call_seconds">
<BR>
<B>Segundos de la llamada de la gota -</B> el número de segundos a partirdel tiempo que la línea de cliente se escoge encima de hasta que lallamada se considera una GOTA, sólo se aplica a las llamadas desalida.

<BR>
<A NAME="vicidial_campaigns-voicemail_ext">
<BR>
<B>Buzón de Voz -</B> si estuvieron definidas, las llamadas que CAERÍAN normalmente en lugar de otro serían ordenadas a esta caja del voicemail para oír y para dejar un mensaje.

<BR>
<A NAME="vicidial_campaigns-safe_harbor_message">
<BR>
<B>seguro puerto mensaje -</B> si fijar y juego uno mensaje clientedespués gota llamar segundo descanso ser alcanzar sin ser transferiruno agente. _ este fijar eliminar sending uno voicemail caja si esteser fijar y.

<BR>
<A NAME="vicidial_campaigns-safe_harbor_exten">
<BR>
<B>seguro puerto Exten -</B> este ser dial plan extensión que desear seguropuerto audio archivo ser localizar en en su servidor.

<BR>
<A NAME="vicidial_campaigns-wrapup_seconds">
<BR>
<B>Segundos de Wrap Up -</B> el número de los segundos para forzar un agenteesperar antes de permitir que reciban o que marquen otra llamada. Elcontador de tiempo comienza tan pronto como un agente cuelgue paraarriba en su cliente - o en el caso del número alterno que marcacuando el agente acaba el plomo - defecto sea los segundos 0. Si elcontador de tiempo funciona hacia fuera antes de que el agente tengadispositioned la llamada, el agente todavía no se mueve encendido ala llamada siguiente hasta que seleccionan una disposición.

<BR>
<A NAME="vicidial_campaigns-wrapup_message">
<BR>
<B>Mensaje de Wrap up -</B> esto es un mensaje campaña-especi'fico que seexhibirá en la pantalla del wrapup si se fijan los segundos delwrapup.

<BR>
<A NAME="vicidial_campaigns-use_internal_dnc">
<BR>
<B>Lista interna del uso DNC -</B> esto define si esta campaña es filtrarlos plomos contra la lista interna de DNC. Si se fija a Y, la tolvabuscará cada número de teléfono en la lista de DNC antes de ponerlaen la tolva. Si está en la lista de DNC entonces que cambiará eseconduce estado a DNCL así que no puede ser marcada. El defecto es N.

<BR>
<A NAME="vicidial_campaigns-closer_campaigns">
<BR>
<B>Grupos De entrada Permitidos -</B> For CLOSER campaigns only. Here is where you select the inbound groups you want agents in this CLOSER campaign to be able to take calls from. It is important for BLENDED inbound-outbound campaigns only to select the inbound groups that are used for agents in this campaign. The calls coming into the inbound groups selected here will be counted as active calls for a blended campaign even if all agents in the campaign are not logged in to receive calls from all of those selected inbound groups.

<BR>
<A NAME="vicidial_campaigns-agent_pause_codes_active">
<BR>
<B>La pausa del agente cifra activo -</B> permite que los agentes seleccionenun código de la pausa cuando chascan encendido el botón de PAUSA envicidial.php. Los códigos de la pausa son definibles por campaña enel fondo de la pantalla del detalle de la opinión de la campaña y sealmacenan en la tabla del vicidial_agent_log. El defecto es N.

<BR>
<A NAME="vicidial_campaigns-disable_alter_custdata">
<BR>
<B>Inhabilite alteran datos del cliente -</B> si el sistema a Y, no cambiacualquiera del expediente de datos del cliente cuando lasdisposiciones de un agente la llamada. El defecto es N.

<BR>
<A NAME="vicidial_campaigns-no_hopper_leads_logins">
<BR>
<B>Permita Ninguno-Tolva-Conduce conexiones -</B> si el sistema a Y, permiteagentes a la conexión a la campaña incluso si no hay plomos cargadosen la tolva para esa campaña. Esta función no se necesita encampañas de CLOSER-type. El defecto es N.



<BR><BR><BR><BR>

<B><FONT SIZE=3>VICIDIAL_LISTAS TABLA</FONT></B><BR><BR>
<A NAME="vicidial_lists-list_id">
<BR>
<B>Identificación de la lista -</B> Úste es el nombre numérico de la lista, él no es editable después de la sumisión inicial, debe contener solamente números y debe estar entre 2 y 8 caracteres en longitud. Must be a number greater than 100.

<BR>
<A NAME="vicidial_lists-list_name">
<BR>
<B>Nombre de la lista -</B> Ésta es la descripción de la lista, debe estar entre 2 y 20 caracteres en longitud.

<BR>
<A NAME="vicidial_lists-list_description">
<BR>
<B>Descripción de la lista -</B> éste es el campo de la nota para la lista,él es opcional.

<BR>
<A NAME="vicidial_lists-list_changedate">
<BR>
<B>Fecha del cambio de la lista -</B> ésta es la vez última que los ajustespara esta lista fueron modificados de cualquier manera.

<BR>
<A NAME="vicidial_lists-list_lastcalldate">
<BR>
<B>Fecha de la llamada del último de la lista -</B> ésta es la vez últimaque conduce fue marcado de esta lista.

<BR>
<A NAME="vicidial_lists-campaign_id">
<BR>
<B>Campaña -</B> Ésta es la campaña que esta lista pertenece a. Una lista se puede marcar solamente en una sola campaña contemporáneamente.

<BR>
<A NAME="vicidial_lists-active">
<BR>
<B>Activo -</B> esto define si la lista debe ser marcada encendido o no.

<BR>
<A NAME="vicidial_lists-reset_list">
<BR>
<B>Reajuste el Conducir-Llamar-Estado para esta lista -</B> esto reajusta todos los plomos en esta lista a N para "no llamado puesto que reajuste pasado" y significa que cualquier plomo puede ahora ser llamado si es el estado derecho según lo definido en la pantalla de la campaña.

<BR>
<A NAME="vicidial_list-dnc">
<BR>
<B>Lista de VICIDIAL DNC -</B> esto no llama la lista contiene cada plomo quese ha fijado a un estado de DNC en el sistema. A través de las LISTAS- AGREGUE EL NÚMERO a la página de DNC que usted puede agregarmanualmente un número a esta lista de modo que no sea llamada por lascampañas que utilizan la lista interna de DNC.



<BR><BR><BR><BR>

<B><FONT SIZE=3>VICIDIAL_INBOUND_GROUPS TABLA</FONT></B><BR><BR>
<A NAME="vicidial_inbound_groups-group_id">
<BR>
<B>Identificación de grupo -</B> Úste es el nombre corto del grupo de entrada, él no es editable después de la sumisión inicial, no debe contener cualquier espacio y debe estar entre 2 y 20 caracteres en longitud.

<BR>
<A NAME="vicidial_inbound_groups-group_name">
<BR>
<B>Nombre de grupo -</B> Ésta es la descripción del grupo, debe estar entre 2 y 30 caracteres en longitud. No puede incluir rociadas -, plusses + o espacios .

<BR>
<A NAME="vicidial_inbound_groups-group_color">
<BR>
<B>Color del grupo -</B> éste es el color que exhibe en el cliente app de VICIDIAL cuando una llamada viene adentro en este grupo. Debe estar entre 2 y 7 caracteres de largo. Si esto es una definición del color de la tuerca hexagonal usted debe recordar poner a # al principio de la secuencia o VICIDIAL no trabajará correctamente.

<BR>
<A NAME="vicidial_inbound_groups-active">
<BR>
<B>Activo -</B> esto se determina si este grupo demuestra para arriba en la caja de la selección cuando un agente de VICIDIAL entra.

<BR>
<A NAME="vicidial_inbound_groups-web_form_address">
<BR>
<B>Forma del Web -</B> Ésta es la dirección de encargo que el chascar en el botón de la FORMA del WEB en VICIDIAL le llevará para las llamadas que vienen adentro en este grupo.

<BR>
<A NAME="vicidial_inbound_groups-next_agent_call">
<BR>
<B>Llamada siguiente del agente -</B> esto se determina qué agente recibe la llamada siguiente que está disponible:
 <BR> &nbsp; - random: órdenes por el valor al azar de la actualización en la tabla de los vicidial_live_agents
 <BR> &nbsp; - oldest_call_start: las órdenes por la vez última un agente fueron enviadas una llamada. Resultados en los agentes que reciben el número casi igual de llamadas cabalmente.
 <BR> &nbsp; - oldest_call_finish: las órdenes por la vez última un agente acabaron una llamada. El agente de AKA que espera lo más de largo posible recibe la primera llamada.
 <BR> &nbsp; - overall_user_level: las órdenes por el user_level del agente según lo definido en los vicidial_users tabulan un user_level más alto recibirán más llamadas.

<BR>
<A NAME="vicidial_inbound_groups-fronter_display">
<BR>
<B>Exhibición de Fronter -</B> este campo se determina si el agente de entrada de VICIDIAL tendría el name(if del fronter allí es uno) exhibido en el campo del estado cuando la llamada viene al agente.

<BR>
<A NAME="vicidial_inbound_groups-ingroup_script">
<BR>
<B>Escritura de la campaña -</B> este menú permite que usted elija la escritura que aparecerá en la pantalla de los agentes para esta campaña. No seleccione NONE no demostrar ninguna escritura para esta campaña.

<BR>
<A NAME="vicidial_inbound_groups-get_call_launch">
<BR>
<B>Consiga el lanzamiento de la llamada -</B> este menú permite que usted elija si usted desee automo'vil-lance la página en una ventana separada, auto-switch de la tela-forma a la lengüeta de la ESCRITURA o no haga nada cuando una llamada se envía al agente para esta campaña. 

<BR>
<A NAME="vicidial_inbound_groups-xferconf_a_dtmf">
<BR>
<B>Xfer-Conf DTMF -</B> Estos cuatro campos permiten para que usted tenga dos sistemas de conferencia de la transferencia y de precolocaciones de DTMF. Cuando se carga la llamada o la campaña, la escritura de vicidial.php demostrará dos botones en el marco de la transferir-conferencia y automo'vil-poblara' el nu'mero-a-dial y los campos del enviar-dtmf cuando está presionada. Si usted desea permitir transferencias consultivas, un fronter a unmás cercano, usted puede colocar CXFER pues uno de lasprecolocaciones del nu'mero-a-dial y del dial string apropiado seráenviado para hacer una transferencia consultiva local, entonces lalata LEAVE-3WAY-CALL justo del agente y movimiento encendido a sullamada siguiente. Si usted desea permitir transferencias ocultas declientes a una escritura de VICIDIAL AGI para registrar o un IVR,entonces coloque AXFER en el campo del nu'mero-a-dial. Usted puedetambién especificar una extensión de encargo después del AXFER odel CXFER, por ejemplo si usted desea hacer transferencias consultivasinternas en vez de local que usted pondría CXFER90009 en el campo delnu'mero-a-dial.

<BR>
<A NAME="vicidial_inbound_groups-drop_call_seconds">
<BR>
<B>Segundos de la llamada de la gota -</B> el número de segundos a partirdel tiempo que la línea de cliente se escoge encima de hasta que lallamada se considera una GOTA, sólo se aplica a las llamadas desalida.

<BR>
<A NAME="vicidial_inbound_groups-voicemail_ext">
<BR>
<B>Buzón de Voz -</B> si estuvieron definidas, las llamadas que CAERÍAN normalmente en lugar de otro serían ordenadas a esta caja del voicemail para oír y para dejar un mensaje.

<BR>
<A NAME="vicidial_inbound_groups-drop_message">
<BR>
<B>Mensaje de la gota -</B> si el sistema a Y juega un mensaje al clientedespués de que el descanso de los segundos de la llamada de la gotase alcance sin la transferencia a un agente. Este ajuste eliminaráenviar a una caja del voicemail si esto se fija a Y.

<BR>
<A NAME="vicidial_inbound_groups-drop_exten">
<BR>
<B>Gota Exten -</B> ésta es la extensión dial plan que el archivo audiocaído deseado de la llamada está situado en en su servidor.



<BR><BR><BR><BR>

<B><FONT SIZE=3>VICIDIAL_REMOTE_AGENTS TABLA</FONT></B><BR><BR>
<A NAME="vicidial_remote_agents-user_start">
<BR>
<B>Comienzo de la identificación del usuario -</B> Ésta es la identificación del usuario que comienza se utiliza que cuando las entradas alejadas del agente se insertan en el sistema. Si el número de líneas se fija más altamente de 1, este número es incrementado por uno hasta que cada línea tiene una entrada. Se cerciora de usted crear una nueva cuenta del usuario de VICIDIAL con un nivel de usuario de 4 o grande si usted quisiera que pudieran utilizar la página de vdremote.php para el acceso alejado de la tela de esta cuenta.

<BR>
<A NAME="vicidial_remote_agents-number_of_lines">
<BR>
<B>Número de líneas -</B> el define cuánto crea el agente alejado las entradas el sistema, y se determina cuántas líneas piensa que puede enviar con seguridad al número debajo.

<BR>
<A NAME="vicidial_remote_agents-server_ip">
<BR>
<B>IP del servidor -</B> Una entrada alejada del agente es solamente buena para un servidor específico, aquí es donde usted selecciona a que el servidor usted desea.

<BR>
<A NAME="vicidial_remote_agents-conf_exten">
<BR>
<B>Extensión externa -</B> éste es el número que usted desea las llamadas remitidas a. Cerciórese de que sea un número dial plan completo y que si usted necesita 9 al principio usted lo pone adentro aquí. Pruebe marcando este número de un teléfono en el sistema.

<BR>
<A NAME="vicidial_remote_agents-status">
<BR>
<B>Estado -</B> aquí es donde usted da vuelta al agente alejado por intervalos. Tan pronto como el agente sea activo el sistema asume que puede enviarle llamadas. Puede tomar hasta 30 segundos una vez que usted cambie el estado a inactivo para parar el recibir de llamadas.

<BR>
<A NAME="vicidial_remote_agents-campaign_id">
<BR>
<B>Campaña -</B> aquí es donde usted selecciona la campaña que estos agentes alejados serán registrados en. Necesidades de entrada de utilizar la campaña MÁS CERCANA y de seleccionar las campañas de entrada debajo de ésa que usted desea recibir llamadas de.

<BR>
<A NAME="vicidial_remote_agents-closer_campaigns">
<BR>
<B>Grupos de entrada -</B> aquí es donde usted selecciona a grupos de entrada que usted desea recibir llamadas de si usted ha seleccionado la campaña MÁS CERCANA.


<BR><BR><BR><BR>

<B><FONT SIZE=3>VICIDIAL_CAMPAIGN_LISTAS</FONT></B><BR><BR>
<A NAME="vicidial_campaign_lists">
<BR>
<B>Las listas dentro de esta campaña se enumeran aquí, si son activas son denotadas por la Y o N y usted pueden ir a la pantalla de la lista chascando en la identificación de la lista en la primera columna.</B>


<BR><BR><BR><BR>

<B><FONT SIZE=3>VICIDIAL_CAMPAIGN_STATUSES TABLA</FONT></B><BR><BR>
<A NAME="vicidial_campaign_statuses">
<BR>
<B>Con el uso de los estados de encargo de la campaña, usted puede tener estados que existan solamente para una campaña específica. El estado debe ser 1-8 caracteres en longitud, la descripción debe ser 2-30 caracteres en longitud y seleccionable define si demuestra para arriba en VICIDIAL como disposición.</B>



<BR><BR><BR><BR>

<B><FONT SIZE=3>VICIDIAL_CAMPAIGN_HOTKEYS TABLA</FONT></B><BR><BR>
<A NAME="vicidial_campaign_hotkeys">
<BR>
<B>Con el uso de los hot keys de encargo de la campaña, los agentes que utilizan el retraso vicidial de la lata del tela-cliente y la disposición llama apenas presionando una sola llave en su teclado.</B> Hay dos opciones especiales que usted puede utilizar conjuntamente conel número de teléfono alterno que marca, ALTPH2 de HotKey - el dialcaliente del teléfono alterno y el dial caliente ADDR3-----Address3permiten que un agente utilice un hotkey al retraso su llamada,permanecen en el mismo plomo, y marcan otro número del contacto deese conducen. 





<BR><BR><BR><BR>

<B><FONT SIZE=3>VICIDIAL_LEAD_RECYCLE TABLA</FONT></B><BR><BR>
<A NAME="vicidial_lead_recycle">
<BR>
<B>Through the use of lead recycling, you can call specific statuses of leads again at a specified interval without resetting the entire list. Lead recycling is campaign-specific and does not have to be a selected dialable status in your campaign. The attempt delay field is the number of seconds until the lead can be placed back in the hopper, this number must be at least 120 seconds. The attempt maximum field is the maximum number of times that a lead of this status can be attempted before the list needs to be reset, this number can be from 1 to 10. You can activate and deactivate a lead recycle entry with the provided links.</B>





<BR><BR><BR><BR>

<B><FONT SIZE=3>ESTADOS AUTO DEL DIAL DE VICIDIAL ALT</FONT></B><BR><BR>
<A NAME="vicidial_auto_alt_dial_statuses">
<BR>
<B>Si se fija el campo que marca del Alt-Nu'mero auto, después losplomos que son dispositioned bajo estos estados del dial del alt delautomóvil tendrán su alt_phone y-o los campos address3 marcadosdespués de que cualesquiera de estos ninguno-contesten a estados sefijan.</B>





<BR><BR><BR><BR>

<B><FONT SIZE=3>VICIDIAL CÓDIGOS DE LA PAUSA DEL AGENTE</FONT></B><BR><BR>
<A NAME="vicidial_pause_codes">
<BR>
<B>Si la pausa del agente cifra el campo activo se fija a activo entonceslos agentes podrá seleccionar de estos códigos de la pausa cuandochascan encendido el botón de PAUSA en sus pantallas. Estos datosentonces se almacenan en el registro vicidial del agente. El códigode la pausa debe contener solamente letras y números y ser menos de 7caracteres de largo. El nombre del código de la pausa puede estar nomás de largo de 30 caracteres.</B>





<BR><BR><BR><BR>

<B><FONT SIZE=3>VICIDIAL_USER_GROUPS TABLA</FONT></B><BR><BR>
<A NAME="vicidial_user_groups-user_group">
<BR>
<B>Grupo de usuario -</B> éste es el nombre corto de un grupo de usuario de Vicidial, intento para no utilizar ningunos espacios o puntuación para los caracteres de este máximo 20 del campo, mínimo de 2 caracteres.

<BR>
<A NAME="vicidial_user_groups-group_name">
<BR>
<B>Nombre de grupo -</B> Ésta es la descripción del máximo vicidial del grupo de usuario de 40 caracteres.

<BR>
<A NAME="vicidial_user_groups-allowed_campaigns">
<BR>
<B>Campañas permitidas -</B> ésta es una lista seleccionable de lascampañas a las cuales los miembros de este grupo de usuario puedenabrirse una sesión. La opción de ALL-CAMPAIGNS permite que losusuarios en este grupo consideren y se abran una sesión a cualquiercampaña en el sistema.





<BR><BR><BR><BR>

<B><FONT SIZE=3>VICIDIAL_ESCRITURAS TABLA</FONT></B><BR><BR>
<A NAME="vicidial_scripts-script_id">
<BR>
<B>Identificación de la escritura -</B> Éste es el nombre corto de una escritura de Vicidial. Éste necesita ser un identificador único. Intente no utilizar ningunos espacios o puntuación para los caracteres de este máximo 10 del campo, mínimo de 2 caracteres.

<BR>
<A NAME="vicidial_scripts-script_name">
<B>Nombre de la escritura -</B> éste es el título de una escritura de Vicidial. Éste es un resumen corto de los caracteres del máximo 50 de la escritura, mínimo de 2 caracteres. No debe haber espacios o puntuación de la clase en campo de los theis.

<BR>
<A NAME="vicidial_scripts-script_comments">
<B>Comentarios de la escritura -</B> éste es tal como donde usted puede poner los comentarios para una escritura de Vicidial - cambiantes para liberar mejora de sept. el 23 -. caracteres del máximo 255, mínimo de 2 caracteres.

<BR>
<A NAME="vicidial_scripts-script_text">
<B>Texto de la escritura -</B> This is where you place the content of a Vicidial Script. Minimum of 2 characters. You can have customer information be auto-populated in this script using "--A--field--B--" where field is one of the following fieldnames: vendor_lead_code, source_id, list_id, gmt_offset_now, called_since_last_reset, phone_code, phone_number, title, first_name, middle_initial, last_name, address1, address2, address3, city, state, province, postal_code, country_code, gender, date_of_birth, alt_phone, email, security_phrase, comments, lead_id, campaign, phone_login, group, channel_group, SQLdate, epoch, uniqueid, customer_zap_channel, server_ip, SIPexten, session_id. For example, this sentence would print the persons name in it----<BR><BR>  Hello, can I speak with --A--first_name--B-- --A--last_name--B-- please? Well hello --A--title--B-- --A--last_name--B-- how are you today?<BR><BR> This would read----<BR><BR>Hello, can I speak with John Doe please? Well hello Mr. Doe how are you today?<BR><BR> You can also use an iframe to load a separate window within the SCRIPT tab, here is an example with prepopulated variables:

<DIV style="height:200px;width:400px;background:white;overflow:scroll;font-size:12px;font-family:sans-serif;" id=iframe_example>
&#60;iframe src="http://astguiclient.sf.net/test_VICIDIAL_output.php?lead_id=--A--lead_id--B--&#38;vendor_id=--A--vendor_lead_code--B--&#38;list_id=--A--list_id--B--&#38;gmt_offset_now=--A--gmt_offset_now--B--&#38;phone_code=--A--phone_code--B--&#38;phone_number=--A--phone_number--B--&#38;title=--A--title--B--&#38;first_name=--A--first_name--B--&#38;middle_initial=--A--middle_initial--B--&#38;last_name=--A--last_name--B--&#38;address1=--A--address1--B--&#38;address2=--A--address2--B--&#38;address3=--A--address3--B--&#38;city=--A--city--B--&#38;state=--A--state--B--&#38;province=--A--province--B--&#38;postal_code=--A--postal_code--B--&#38;country_code=--A--country_code--B--&#38;gender=--A--gender--B--&#38;date_of_birth=--A--date_of_birth--B--&#38;alt_phone=--A--alt_phone--B--&#38;email=--A--email--B--&#38;security_phrase=--A--security_phrase--B--&#38;comments=--A--comments--B--&#38;user=--A--user--B--&#38;campaign=--A--campaign--B--&#38;phone_login=--A--phone_login--B--&#38;fronter=--A--fronter--B--&#38;closer=--A--user--B--&#38;group=--A--group--B--&#38;channel_group=--A--group--B--&#38;SQLdate=--A--SQLdate--B--&#38;epoch=--A--epoch--B--&#38;uniqueid=--A--uniqueid--B--&#38;customer_zap_channel=--A--customer_zap_channel--B--&#38;server_ip=--A--server_ip--B--&#38;SIPexten=--A--SIPexten--B--&#38;session_id=--A--session_id--B--&#38;phone=--A--phone--B--" style="width:580;height:290;background-color:transparent;" scrolling="auto" frameborder="0" allowtransparency="true" id="popupFrame" name="popupFrame" width="460" height="290"&#62;
&#60;/iframe&#62;
</DIV>

<BR>
<A NAME="vicidial_scripts-active">
<BR>
<B>Activo -</B> esto se determina si esta escritura se puede seleccionar para ser utilizado por una campaña.





<BR><BR><BR><BR>

<B><FONT SIZE=3>VICIDIAL_LEAD_FILTROS TABLA</FONT></B><BR><BR>
<A NAME="vicidial_lead_filters-lead_filter_id">
<BR>
<B>Identificación del filtro -</B> Éste es el nombre corto de un filtro del plomo de Vicidial. Éste necesita ser un identificador único. No utilice ningunos espacios o puntuación para los caracteres de este máximo 10 del campo, mínimo de 2 caracteres.

<BR>
<A NAME="vicidial_lead_filters-lead_filter_name">
<B>Nombre del filtro -</B> éste es un nombre más descriptivo del filtro. Éste es un resumen corto de los caracteres del máximo 30 del filtro, mínimo de 2 caracteres.

<BR>
<A NAME="vicidial_lead_filters-lead_filter_comments">
<B>El filtro comenta -</B> aquí es tal como donde usted puede poner los comentarios para un filtro de Vicidial - las llamadas todos los plomos de California -. los caracteres del máximo 255, mínimo de 2 caracteres.

<BR>
<A NAME="vicidial_lead_filters-lead_filter_sql">
<B>Filtro SQL -</B> Aquí es adonde usted pone el fragmento de la pregunta del SQL que usted desea filtrar cerca no comienza o el extremo con Y, eso será agregado por la escritura del cron de la tolva automáticamente. una pregunta del SQL del ejemplo que trabajaría aquí es el called_count 4 y called_count.





<BR><BR><BR><BR>

<B><FONT SIZE=3>VICIDIAL_TIEMPOS DE LA LLAMADA TABLA</FONT></B><BR><BR>
<A NAME="vicidial_call_times-call_time_id">
<BR>
<B>Identificación del tiempo de la llamada -</B> éste es el nombre corto deuna definición del tiempo de la llamada de Vicidial. Éste necesitaser un identificador único. No utilice ningunos espacios opuntuación para los caracteres de este máximo 10 del campo, mínimode 2 caracteres.

<BR>
<A NAME="vicidial_call_times-call_time_name">
<B>Nombre del tiempo de la llamada -</B> éste es un nombre más descriptivode la definición del tiempo de la llamada. Éste es un resumen cortode los caracteres del máximo 30 de la definición del tiempo de lallamada, mínimo de 2 caracteres.

<BR>
<A NAME="vicidial_call_times-call_time_comments">
<B>El tiempo de la llamada comenta -</B> aquí es donde usted puede poner loscomentarios para una definición del tiempo de la llamada de Vicidialtal como -10am hasta los 4pm con restricciones adicionales del estadode la llamada -. los caracteres del máximo 255.

<BR>
<A NAME="vicidial_call_times-ct_default_start">
<B>Tiempos del comienzo y de parada del defecto -</B> éste es el tiempo dedefecto paran que el llamar será permitido que sea comenzado o dentrode esta definición del tiempo de la llamada si la hora de salida dela di'a-de-$$$-SEMANA no se define. 0 es medianoche. Evitar el llamarfijó totalmente este campo a 2400 y fijó el tiempo de parada deldefecto a 2400. Permitir el llamar 24 horas al día fijó la hora desalida a 0 y el tiempo de parada a 2400.

<BR>
<A NAME="vicidial_call_times-ct_sunday_start">
<B>Tiempos del comienzo y de parada del día laborable -</B> éstos son lostiempos de encargo por el día que se puede fijar para la definicióndel tiempo de la llamada que las mismas reglas se aplican como con lostiempos del comienzo y de parada del defecto.

<BR>
<A NAME="vicidial_call_times-ct_state_call_times">
<B>Definiciones del tiempo de la llamada del estado -</B> ésta es la listade las definiciones específicas del tiempo de la llamada del estadoque se siguen en esta definición del tiempo de la llamada.

<BR>
<A NAME="vicidial_call_times-state_call_time_state">
<B>Estado del tiempo de la llamada del estado -</B> éste es el código dedos letras para el estado que esta definición del tiempo que llamaestá para. Para que esto sea en efecto la llamada local mida eltiempo que se fija en la campaña debe tener este expediente deltiempo de la llamada del estado en él así como todos los plomos quetienen dos códigos del estado de la letra en ellos.




<BR><BR><BR><BR>

<B><FONT SIZE=3>FUNCIONALIDAD DEL CARGADOR DE LA LISTA DE VICIDIAL</FONT></B><BR><BR>
<A NAME="vicidial_list_loader">
<BR>
El VICIDIAL tela-baso' cargador del plomo se diseña simplemente llevar un file(up del plomo 8MB de tamaño) que es lengüeta o pipa delimitada y cargarlo en la tabla del vicidial_list. Hay también un cargador estupendo nuevo del plomo de la versión beta que permite para el campo que elige y de TXT- el texto claramente, los valores separados coma de CSV- y XLS- sobresalen formatos del archivo. El cargador del plomo no hace la validación de datos o la comprobación para duplicados en sí mismo u otras listas, de modo que esté algo usted necesita hacer antes de usted la carga los plomos. También, cerciórese de que usted haya creado la lista que estos plomos son estar debajo de modo que usted pueda utilizarlos. Hay también la materia de la tiempo-zona-codificacio'n estos plomos. Usted puede desear aumentar la frecuencia que el ADMIN_adjust_GMTnow_on_leads.pl se está funcionando en el cron en su servidor del asterisco para poder cifrar cualquier plomo cargado más rápidamente. Aquí está una lista de los campos en su orden apropiada para los archivos del plomo:
	<OL>
	<LI>Código del plomo del vendedor - demuestra para arriba en el campo de la identificación del vendedor del GUI
	<LI>Código de fuente - uso interno solamente para los admins y DBAs
	<LI>Identificación de la lista - el número de la lista que estos plomos demostrarán para arriba debajo
	<LI>Código del teléfono - el prefijo para el teléfono number(1 para los E.E.U.U., 01144 para Reino Unido, 01161 para AUS, el etc)
	<LI>Número de teléfono - debe ser por lo menos 8 dígitos de largo
	<LI>Título - título del customer(Mr. Ms señ., etc...)
	<LI>Nombre
	<LI>Inicial Media
	<LI>Apellidos
	<LI>Dirección, línea 1
	<LI>Dirección, línea 2
	<LI>Dirección, línea 3
	<LI>Ciudad
	<LI>Estado - limitado a 2 caracteres
	<LI>Provincia
	<LI>Código Postal
	<LI>País
	<LI>Sexo
	<LI>Fecha de nacimiento
	<LI>Número De Teléfono Alternativo
	<LI>Dirección Email
	<LI>Frase De Seguridad
	<LI>Comentarios
	</OL>

<BR>NOTES: The Excel Lead loader functionality is enabled by a series of perl scripts and needs to have a properly configured /etc/astguiclient.conf file in place on the web server. Also, a couple perl modules must be loaded for it to work as well - OLE-Storage_Lite and Spreadsheet-ParseExcel. You can check for runtime errors in these by looking at your apache error_log file.




<BR><BR><BR><BR>






<B><FONT SIZE=3>TABLA DE LOS TELÉFONOS</FONT></B><BR><BR>
<A NAME="phones-extension">
<BR>
<B>Extensión del teléfono -</B> este campo es donde usted pone los nombres del teléfono que aparecen al marcar con asterisco no incluyendo el protocolo o la barra vertical del principio. Por ejemplo: para el teléfono SIP/test101 del SIP la extensión del teléfono sería test101. También, para los teléfonos IAX2 compruebe que usted utiliza el nombre del teléfono completo: IAX2/IAXphone1@IAXphone1 sería IAXphone1@IAXphone1. Para zap los teléfonos compruebe que usted pone el canal completo: Zap/25-1 sería 25-1. Otra nota, compruebe que usted fija el protocolo abajo correctamente para su tipo de teléfono.

<BR>
<A NAME="phones-dialplan_number">
<BR>
<B>Número del Dial plan -</B> este campo está para el número que usted marca para tener el anillo del teléfono. Este número se define en el archivo de extensions.conf de su servidor asterisco

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
<B>Prefijo del monitor -</B> éste es el prefijo dial plan para supervisar de zap los canales automáticamente dentro del app astGUIclient. Cambie solamente según los expedientes de extensiones de extensions.conf ZapBarge.

<BR>
<A NAME="phones-recording_exten">
<BR>
<B>Grabación Exten -</B> Ésta es la extensión dial plan para la extensión de la grabación que se utiliza para caer en conferencias del meetme para registrarlas. Dura generalmente hasta que una hora si no parada verifica con el archivo de extensions.conf antes de cambiar.

<BR>
<A NAME="phones-voicemail_exten">
<BR>
<B>VMAIL Exten principal -</B> Ésta es la extensión dial plan que va a comprobar su voicemail. verifica con el archivo de extensions.conf antes de cambiar.

<BR>
<A NAME="phones-voicemail_dump_exten">
<BR>
<B>Descarga Exten de VMAIL -</B> éste es el prefijo dial plan usado para enviar llamadas directamente al voicemail de un usuario de una llamada viva en el app. astGUIclient verifica con el archivo de extensions.conf antes de cambiar.

<BR>
<A NAME="phones-ext_context">
<BR>
<B>Contexto de Exten -</B> éste es el contexto dial plan que este teléfono utiliza sobre todo. Se asume que todos los números marcados por los apps del cliente están utilizando este contexto así que es una buena idea cerciorarse de que éste es el contexto más amplio posible verifica con el archivo de extensions.conf antes de cambiar.

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
<A NAME="phones-enable_sipsak_messages">
<BR>
<B>Permita los mensajes de SIPSAK -</B> si está permitido el servidorenviará mensajes al teléfono del SIP a la exhibición en laexhibición del LCD del teléfono cuando está registrado en VICIDIAL.La característica trabaja solamente con los teléfonos del SIP yrequiere el uso del sipsak ser instalada en el web server. El defectoes 0.

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
<B>Contexto del defecto -</B> el contexto dial plan del defecto usado para las escrituras que funcionan para este servidor. El defecto es 'defecto'

<BR>
<A NAME="servers-sys_perf_log">
<BR>
<B>Funcionamiento del sistema -</B> fijar esta opción a Y permitirá laregistración del stats del funcionamiento del sistema para lamáquina del servidor incluyendo carga de sistema, procesos delsistema y canales del asterisco en uso. El defecto es N.

<BR>
<A NAME="servers-vd_server_logs">
<BR>
<B>Registros del servidor -</B> fijar esta opción a Y permitirá laregistración de todas las escrituras relacionadas VICIDIAL a susficheros de diario del texto. Fijar esto a N parará registros de laescritura a los archivos para estos procesos, también laregistración de la pantalla del asterisco será lisiado si esto sefija a N cuando se comienza el asterisco. El defecto es Y.

<BR>
<A NAME="servers-agi_output">
<BR>
<B>AGI hecho salir -</B> fijar esta opción a NINGUNOS inhabilitará salidade todas las escrituras relacionadas VICIDIAL de AGI. Fijar esto aSTDERR enviará el AGI hecho salir al asterisco CLI. Fijar esto alARCHIVO enviará la salida a un archivo en el directorio de losregistros. Fijar esto a AMBOS enviará salida al asterisco CLI y a unfichero de diario. El defecto es ARCHIVO.

<BR>
<A NAME="servers-vicidial_balance_active">
<BR>
<B>El marcar del balance de VICIDIAL -</B> fijar este campo a Y permitiráque el servidor ponga las llamadas del balance para las campañas enVICIDIAL para poder resolver el nivel definido del dial incluso si nohay agentes registrados en esa campaña en este servidor. El defectoes N.

<BR>
<A NAME="servers-balance_trunks_offlimits">
<BR>
<B>Balance Offlimits de VICIDIAL -</B> este ajuste define el número detroncos para no permitir el balance de VICIDIAL que marca parautilizar. Por ejemplo si usted tiene 40 troncos y offlimits vicidialmáximos del balance se fijan a 10 que usted podrá solamenteutilizar 30 líneas interurbanas para marcar del balance de VICIDIAL.El defecto es 0.


<BR><BR><BR><BR>

<B><FONT SIZE=3>TABLA DE CONFERENCIAS</FONT></B><BR><BR>
<A NAME="conferences-conf_exten">
<BR>
<B>Número de la conferencia -</B> este campo es donde usted pone el número del dialpna de la conferencia del meetme. También se recomienda que el número del meetme en meetme.conf empareja este número para cada entrada. Esto está para las conferencias en astGUIclient y se utiliza para la funcionalidad de leave-3way-call en VICIDIAL.

<BR>
<A NAME="conferences-server_ip">
<BR>
<B>IP del servidor -</B> El menú donde usted selecciona el servidor del asterisco que esta conferencia estará encendido.




<BR><BR><BR><BR>

<B><FONT SIZE=3>VICIDIAL_SERVER_TRUNKS TABLA</FONT></B><BR><BR>
<A NAME="vicidial_server_trunks">
<BR>
<B>Los troncos del servidor de VICIDIAL permiten que usted restrinja laslíneas salientes que se utilizan en este servidor para la campañaque marca sobre una base de la por-campaña. Usted tiene la opciónpara reservar un número de las líneas específico que se utilizaránpor solamente una campaña así como permitir que esa campañafuncione sobre sus líneas reservadas en cualesquiera líneas siguensiendo abiertas, según lo en las líneas totales usadas por vicidialen este servidor es de largo menos que fijar de los troncos delmáximo VICIDIAL. No tener cualesquiera de estos expedientespermitirá la campaña que marca la línea primero para tener tantaslíneas mientras que puede conseguir bajo fijar de los troncos delmáximo VICIDIAL.</B>





<BR><BR><BR><BR>

<B><FONT SIZE=3>SYSTEM_SETTINGS TABLA</FONT></B><BR><BR>
<A NAME="settings-use_non_latin">
<BR>
<B>Uso No-Latino -</B> esta opción permite que usted omita la escritura dela exhibición de la tela los caracteres del uso UTF8 y que no haganinguna expresión regular de la latino-cara'cter-familia que sefiltra ni que no exhiba el formato. El defecto es 0.

<BR>
<A NAME="settings-webroot_writable">
<BR>
<B>Webroot escribible -</B> este ajuste permite que usted defina si losarchivos de la temperatura y los archivos de la autentificación seancolocados en el webroot en su web server. El defecto es 1.

<BR>
<A NAME="settings-enable_queuemetrics_logging">
<BR>
<B>Permita la registración de QueueMetrics -</B> este ajuste permite queusted defina si VICIDIAL inserte entradas del registro en la tabla dela base de datos del queue_log como lo hace la actividad de lascoletas del asterisco. QueueMetrics es un independiente, programa delanálisis estadístico de la cerrado-fuente. Usted debe tenerQueueMetrics instalado y configurado ya antes de permitir estacaracterística. El defecto es 0.

<BR>
<A NAME="settings-queuemetrics_server_ip">
<BR>
<B>IP del servidor de QueueMetrics -</B> éste es el IP address de la base dedatos para su instalación de QueueMetrics.

<BR>
<A NAME="settings-queuemetrics_dbname">
<BR>
<B>Nombre de la base de datos de QueueMetrics -</B> éste es el nombre de labase de datos para su base de datos de QueueMetrics.

<BR>
<A NAME="settings-queuemetrics_login">
<BR>
<B>Conexión de la base de datos de QueueMetrics -</B> éste es el nombre delusuario usado para abrirse una sesión a su base de datos deQueueMetrics.

<BR>
<A NAME="settings-queuemetrics_pass">
<BR>
<B>Contraseña de la base de datos de QueueMetrics -</B> ésta es lacontraseña usada para abrirse una sesión a su base de datos deQueueMetrics.

<BR>
<A NAME="settings-queuemetrics_url">
<BR>
<B>URL de QueueMetrics -</B> Ésta es la dirección del URL o del Web siteusada para conseguir a su instalación de QueueMetrics.

<BR>
<A NAME="settings-queuemetrics_log_id">
<BR>
<B>Identificación del registro de QueueMetrics -</B> ésta es laidentificación del servidor que todos los registros de VICIDIAL queentran la base de datos de QueueMetrics utilizarán como identificadorpara cada expediente.

<BR>
<A NAME="settings-queuemetrics_eq_prepend">
<BR>
<B>QueueMetrics EnterQueue prepend -</B> este campo se utiliza para permitirprepending de una de las zonas de informaciones del vicidial_listdelante del número de teléfono del cliente para los informesmodificados para requisitos particulares de QueueMetrics. El defectono es NINGUNO no poblar cualquier cosa.

<BR>
<A NAME="settings-vicidial_agent_disable">
<BR>
<B>El agente de VICIDIAL inhabilita la exhibición -</B> este campo seutiliza para seleccionar cuando demostrar a un agente cuando susesión ha sido inhabilitada por el sistema, una acción del encargadoo por una medida externa. El ajuste de NOT_ACTIVE inhabilitará elmensaje en la pantalla de los agentes. El ajuste de LIVE_AGENTexhibirá solamente el mensaje lisiado cuando se ha quitado elexpediente de los vicidial_auto_calls de los agentes, por ejemplodurante un registro de estado de la máquina de la fuerza o registrode estado de la máquina de la emergencia. 

<BR>
<A NAME="settings-allow_sipsak_messages">
<BR>
<B>Permita los mensajes de SIPSAK -</B> si el sistema a 1, éste permite queel ajuste de la tabla de los teléfonos trabaje correctamente, elservidor enviará mensajes al teléfono del SIP a la exhibición en laexhibición del LCD del teléfono cuando está registrado en VICIDIAL.Esta característica trabaja solamente con los teléfonos del SIP yrequiere el uso del sipsak ser instalada en el web server. El defectoes 0. 

<BR>
<A NAME="settings-admin_home_url">
<BR>
<B>URL casero del Admin -</B> ésta es la dirección del URL o del Web siteque usted irá si usted chasca encendido el acoplamiento CASERO en latapa de la página de admin.php.




<BR><BR><BR><BR><BR><BR><BR><BR>
<BR><BR><BR><BR><BR><BR><BR><BR>
EL EXTREMO
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
	echo "<B>Demuestre La Cuenta De los Plomos De Dialable</B> -<BR><BR>\n";
	echo "<B>CAMPAIGN:</B> $campaign_id<BR>\n";
	echo "<B>LISTAS:</B> $camp_lists<BR>\n";
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
	echo "Usted no tiene permiso de visión esta página\n";
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

echo "Escritura De la Inspección previo: $script_id<BR>\n";
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
echo "<TD WIDTH=100 ALIGN=RIGHT VALIGN=TOP  NOWRAP><a href=\"../vicidial_en/admin.php?relogin=YES&VD_login=$VD_login&VD_campaign=$VD_campaign&phone_login=$phone_login&phone_pass=$phone_pass&VD_pass=$VD_pass\">English <img src=\"../agc/images/en.gif\" BORDER=0 HEIGHT=14 WIDTH=20></a></TD>\n";echo "<TD WIDTH=100 ALIGN=RIGHT VALIGN=TOP  BGCOLOR=\"#CCFFCC\" NOWRAP><a href=\"../vicidial_es/admin.php?relogin=YES&VD_login=$VD_login&VD_campaign=$VD_campaign&phone_login=$phone_login&phone_pass=$phone_pass&VD_pass=$VD_pass\">Español <img src=\"../agc/images/es.gif\" BORDER=0 HEIGHT=14 WIDTH=20></a></TD>\n";
$stmt="SELECT admin_home_url from system_settings;";
$rslt=mysql_query($stmt, $link);
$row=mysql_fetch_row($rslt);
$admin_home_url_LU =	$row[0];

?>
<CENTER>
<TABLE WIDTH=<?=$page_width ?> BGCOLOR=#D9E6FE cellpadding=2 cellspacing=0><TR BGCOLOR=#015B91><TD ALIGN=LEFT COLSPAN=5><FONT FACE="ARIAL,HELVETICA" COLOR=WHITE SIZE=2><B> &nbsp; VICIDIAL ADMIN - <a href="<? echo $admin_home_url_LU ?>"><FONT FACE="ARIAL,HELVETICA" COLOR=WHITE SIZE=1>CASERO</a> | <a href="<? echo $PHP_SELF ?>?force_logout=1"><FONT FACE="ARIAL,HELVETICA" COLOR=WHITE SIZE=1>Salir</a></TD><TD ALIGN=RIGHT COLSPAN=6><FONT FACE="ARIAL,HELVETICA" COLOR=WHITE SIZE=2><B><? echo date("l F j, Y G:i:s A") ?> &nbsp; </TD></TR>

<TR BGCOLOR=#015B91>
<TD ALIGN=CENTER <?=$users_hh ?>><a href="<? echo $PHP_SELF ?>?ADD=0"><FONT FACE="ARIAL,HELVETICA" COLOR=<?=$users_fc ?> SIZE=<?=$header_font_size ?>><?=$users_bold ?> Usuarios </a></TD>
<TD ALIGN=CENTER <?=$campaigns_hh ?>><a href="<? echo $PHP_SELF ?>?ADD=10"><FONT FACE="ARIAL,HELVETICA" COLOR=<?=$campaigns_fc ?> SIZE=<?=$header_font_size ?>><?=$campaigns_bold ?> Campañas </a></TD>
<TD ALIGN=CENTER <?=$lists_hh ?>><a href="<? echo $PHP_SELF ?>?ADD=100"><FONT FACE="ARIAL,HELVETICA" COLOR=<?=$lists_fc ?> SIZE=<?=$header_font_size ?>><?=$lists_bold ?> Listas </a></TD>
<TD ALIGN=CENTER <?=$scripts_hh ?>><a href="<? echo $PHP_SELF ?>?ADD=1000000"><FONT FACE="ARIAL,HELVETICA" COLOR=<?=$scripts_fc ?> SIZE=<?=$header_font_size ?>><?=$scripts_bold ?> Escrituras </a></TD>
<TD ALIGN=CENTER <?=$filters_hh ?>><a href="<? echo $PHP_SELF ?>?ADD=10000000"><FONT FACE="ARIAL,HELVETICA" COLOR=<?=$filters_fc ?> SIZE=<?=$header_font_size ?>><?=$filters_bold ?> Filtros </a></TD>
<TD ALIGN=CENTER <?=$ingroups_hh ?>><a href="<? echo $PHP_SELF ?>?ADD=1000"><FONT FACE="ARIAL,HELVETICA" COLOR=<?=$ingroups_fc ?> SIZE=<?=$header_font_size ?>><?=$ingroups_bold ?> En-Grupos </a></TD>
<TD ALIGN=CENTER <?=$usergroups_hh ?>><a href="<? echo $PHP_SELF ?>?ADD=100000"><FONT FACE="ARIAL,HELVETICA" COLOR=<?=$usergroups_fc ?> SIZE=<?=$header_font_size ?>><?=$usergroups_bold ?> Grupos De Usuario </a></TD>
<TD ALIGN=CENTER <?=$remoteagent_hh ?>><a href="<? echo $PHP_SELF ?>?ADD=10000"><FONT FACE="ARIAL,HELVETICA" COLOR=<?=$remoteagent_fc ?> SIZE=<?=$header_font_size ?>><?=$remoteagent_bold ?> Agentes Alejados </a></TD>
<TD ALIGN=CENTER <?=$admin_hh ?>><a href="<? echo $PHP_SELF ?>?ADD=10000000000"><FONT FACE="ARIAL,HELVETICA" COLOR=<?=$admin_fc ?> SIZE=<?=$header_font_size ?>><?=$admin_bold ?> Admin </a></TD>
<TD ALIGN=CENTER <?=$reports_hh ?>><a href="<? echo $PHP_SELF ?>?ADD=999999"><FONT FACE="ARIAL,HELVETICA" COLOR=<?=$reports_fc ?> SIZE=<?=$header_font_size ?>><?=$reports_bold ?> Informes </a></TD>
</TR>

<? if (strlen($users_hh) > 1) { 
	?>
<TR BGCOLOR=<?=$users_color ?>><TD ALIGN=LEFT COLSPAN=10><FONT FACE="ARIAL,HELVETICA" COLOR=BLACK SIZE=<?=$subheader_font_size ?>> &nbsp; <a href="<? echo $PHP_SELF ?>"><FONT FACE="ARIAL,HELVETICA" COLOR=BLACK SIZE=<?=$subheader_font_size ?>> Demuestre A Usuarios </a> &nbsp; &nbsp; | &nbsp; &nbsp; <a href="<? echo $PHP_SELF ?>?ADD=1"><FONT FACE="ARIAL,HELVETICA" COLOR=BLACK SIZE=<?=$subheader_font_size ?>> Agregue A Nuevo Usuario </a> &nbsp; &nbsp; | &nbsp; &nbsp; <a href="<? echo $PHP_SELF ?>?ADD=550"><FONT FACE="ARIAL,HELVETICA" COLOR=BLACK SIZE=<?=$subheader_font_size ?>> Búsqueda Para Un Usuario </a></TD></TR>
<? } 
if (strlen($campaigns_hh) > 1) { 
	?>
<TR BGCOLOR=<?=$campaigns_color ?>><TD ALIGN=LEFT COLSPAN=10><FONT FACE="ARIAL,HELVETICA" COLOR=BLACK SIZE=<?=$subheader_font_size ?>> &nbsp; <a href="<? echo $PHP_SELF ?>?ADD=10"><FONT FACE="ARIAL,HELVETICA" COLOR=BLACK SIZE=<?=$subheader_font_size ?>> Demuestre Las Campañas </a> &nbsp; &nbsp; | &nbsp; &nbsp; <a href="<? echo $PHP_SELF ?>?ADD=11"><FONT FACE="ARIAL,HELVETICA" COLOR=BLACK SIZE=<?=$subheader_font_size ?>> Agregue Una Nueva Campaña </a> &nbsp; &nbsp; | &nbsp; &nbsp; <a href="./AST_timeonVDADallSUMMARY.php"><FONT FACE="ARIAL,HELVETICA" COLOR=BLACK SIZE=<?=$subheader_font_size ?>> Campañas En tiempo real Sumarias </a></TD></TR>
<? } 
if (strlen($lists_hh) > 1) { 
	?>
<TR BGCOLOR=<?=$lists_color ?>><TD ALIGN=LEFT COLSPAN=10><FONT FACE="ARIAL,HELVETICA" COLOR=BLACK SIZE=<?=$subheader_font_size ?>> &nbsp; <a href="<? echo $PHP_SELF ?>?ADD=100"><FONT FACE="ARIAL,HELVETICA" COLOR=BLACK SIZE=<?=$subheader_font_size ?>> Demuestre Las Listas </a> &nbsp; &nbsp; | &nbsp; &nbsp; <a href="<? echo $PHP_SELF ?>?ADD=111"><FONT FACE="ARIAL,HELVETICA" COLOR=BLACK SIZE=<?=$subheader_font_size ?>> Agregue Una Nueva Lista </a> &nbsp; &nbsp; | &nbsp; &nbsp; <a href="admin_search_lead.php"><FONT FACE="ARIAL,HELVETICA" COLOR=BLACK SIZE=<?=$subheader_font_size ?>> Búsqueda Para Un Plomo </a> &nbsp; &nbsp; | &nbsp; &nbsp; <a href="<? echo $PHP_SELF ?>?ADD=121"><FONT FACE="ARIAL,HELVETICA" COLOR=BLACK SIZE=<?=$subheader_font_size ?>> Agregue El Número a DNC </a> &nbsp; &nbsp; | &nbsp; &nbsp; <a href="./listloaderMAIN.php"><FONT FACE="ARIAL,HELVETICA" COLOR=BLACK SIZE=<?=$subheader_font_size ?>> Nuevos Plomos De la Carga </a></TD></TR>
<? } 
if (strlen($scripts_hh) > 1) { 
	?>
<TR BGCOLOR=<?=$scripts_color ?>><TD ALIGN=LEFT COLSPAN=10><FONT FACE="ARIAL,HELVETICA" COLOR=BLACK SIZE=<?=$subheader_font_size ?>> &nbsp; <a href="<? echo $PHP_SELF ?>?ADD=1000000"><FONT FACE="ARIAL,HELVETICA" COLOR=BLACK SIZE=<?=$subheader_font_size ?>> Demuestre Las Escrituras </a> &nbsp; &nbsp; | &nbsp; &nbsp; <a href="<? echo $PHP_SELF ?>?ADD=1111111"><FONT FACE="ARIAL,HELVETICA" COLOR=BLACK SIZE=<?=$subheader_font_size ?>> Agregue Una Nueva Escritura </a></TD></TR>
<? } 
if (strlen($filters_hh) > 1) { 
	?>
<TR BGCOLOR=<?=$filters_color ?>><TD ALIGN=LEFT COLSPAN=10><FONT FACE="ARIAL,HELVETICA" COLOR=BLACK SIZE=<?=$subheader_font_size ?>> &nbsp; <a href="<? echo $PHP_SELF ?>?ADD=10000000"><FONT FACE="ARIAL,HELVETICA" COLOR=BLACK SIZE=<?=$subheader_font_size ?>> Demuestre Los Filtros </a> &nbsp; &nbsp; | &nbsp; &nbsp; <a href="<? echo $PHP_SELF ?>?ADD=11111111"><FONT FACE="ARIAL,HELVETICA" COLOR=BLACK SIZE=<?=$subheader_font_size ?>> Agregue Un Filtro Nuevo </a></TD></TR>
<? } 
if (strlen($ingroups_hh) > 1) { 
	?>
<TR BGCOLOR=<?=$ingroups_color ?>><TD ALIGN=LEFT COLSPAN=10><FONT FACE="ARIAL,HELVETICA" COLOR=BLACK SIZE=<?=$subheader_font_size ?>> &nbsp; <a href="<? echo $PHP_SELF ?>?ADD=1000"><FONT FACE="ARIAL,HELVETICA" COLOR=BLACK SIZE=<?=$subheader_font_size ?>> Demuestre A En-Grupos </a> &nbsp; &nbsp; | &nbsp; &nbsp; <a href="<? echo $PHP_SELF ?>?ADD=1111"><FONT FACE="ARIAL,HELVETICA" COLOR=BLACK SIZE=<?=$subheader_font_size ?>> Agregue A Nuevo En-Grupo </a></TD></TR>
<? } 
if (strlen($usergroups_hh) > 1) { 
	?>
<TR BGCOLOR=<?=$usergroups_color ?>><TD ALIGN=LEFT COLSPAN=10><FONT FACE="ARIAL,HELVETICA" COLOR=BLACK SIZE=<?=$subheader_font_size ?>> &nbsp; <a href="<? echo $PHP_SELF ?>?ADD=100000"><FONT FACE="ARIAL,HELVETICA" COLOR=BLACK SIZE=<?=$subheader_font_size ?>> Demuestre A Grupos De Usuario </a> &nbsp; &nbsp; | &nbsp; &nbsp; <a href="<? echo $PHP_SELF ?>?ADD=111111"><FONT FACE="ARIAL,HELVETICA" COLOR=BLACK SIZE=<?=$subheader_font_size ?>> Agregue A Nuevo Grupo De Usuario </a> &nbsp; &nbsp; | &nbsp; &nbsp; <a href="group_hourly_stats.php"><FONT FACE="ARIAL,HELVETICA" COLOR=BLACK SIZE=<?=$subheader_font_size ?>> Informe Cada hora Del Grupo </a></TD></TR>
<? } 
if (strlen($remoteagent_hh) > 1) { 
	?>
<TR BGCOLOR=<?=$remoteagent_color ?>><TD ALIGN=LEFT COLSPAN=10><FONT FACE="ARIAL,HELVETICA" COLOR=BLACK SIZE=<?=$subheader_font_size ?>> &nbsp; <a href="<? echo $PHP_SELF ?>?ADD=10000"><FONT FACE="ARIAL,HELVETICA" COLOR=BLACK SIZE=<?=$subheader_font_size ?>> Demuestre Los Agentes Alejados </a> &nbsp; &nbsp; | &nbsp; &nbsp; <a href="<? echo $PHP_SELF ?>?ADD=11111"><FONT FACE="ARIAL,HELVETICA" COLOR=BLACK SIZE=<?=$subheader_font_size ?>> Agregue Los Agentes Alejados Nuevos </a></TD></TR>
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
<TD ALIGN=LEFT <?=$times_sh ?> COLSPAN=2><a href="<? echo $PHP_SELF ?>?ADD=100000000"><FONT FACE="ARIAL,HELVETICA" COLOR=<?=$times_fc ?> SIZE=<?=$header_font_size ?>> Tiempos De la Llamada </a></TD>
<TD ALIGN=LEFT <?=$phones_sh ?> COLSPAN=2><a href="<? echo $PHP_SELF ?>?ADD=10000000000"><FONT FACE="ARIAL,HELVETICA" COLOR=<?=$phones_fc ?> SIZE=<?=$header_font_size ?>> Teléfonos </a></TD>
<TD ALIGN=LEFT <?=$conference_sh ?> COLSPAN=2><a href="<? echo $PHP_SELF ?>?ADD=1000000000000"><FONT FACE="ARIAL,HELVETICA" COLOR=<?=$conference_fc ?> SIZE=<?=$header_font_size ?>> Conferencias </a></TD>
<TD ALIGN=LEFT <?=$server_sh ?> COLSPAN=1><a href="<? echo $PHP_SELF ?>?ADD=100000000000"><FONT FACE="ARIAL,HELVETICA" COLOR=<?=$server_fc ?> SIZE=<?=$header_font_size ?>> Servidores </a></TD>
<TD ALIGN=LEFT <?=$settings_sh ?> COLSPAN=3><a href="<? echo $PHP_SELF ?>?ADD=311111111111111"><FONT FACE="ARIAL,HELVETICA" COLOR=<?=$settings_fc ?> SIZE=<?=$header_font_size ?>> Ajustes Del Sistema </a></TD>
</TR>
	<?
	if (strlen($times_sh) > 1) { 
		?>
	<TR BGCOLOR=<?=$times_color ?>><TD ALIGN=LEFT COLSPAN=10><FONT FACE="ARIAL,HELVETICA" COLOR=BLACK SIZE=<?=$subheader_font_size ?>> &nbsp; <a href="<? echo $PHP_SELF ?>?ADD=100000000"><FONT FACE="ARIAL,HELVETICA" COLOR=BLACK SIZE=<?=$subheader_font_size ?>> Demuestre Los Tiempos De la Llamada </a> &nbsp; &nbsp; | &nbsp; &nbsp; <a href="<? echo $PHP_SELF ?>?ADD=111111111"><FONT FACE="ARIAL,HELVETICA" COLOR=BLACK SIZE=<?=$subheader_font_size ?>> Agregue Un Nuevo Rato De la Llamada </a> &nbsp; &nbsp; | &nbsp; &nbsp; <a href="<? echo $PHP_SELF ?>?ADD=1000000000"><FONT FACE="ARIAL,HELVETICA" COLOR=BLACK SIZE=<?=$subheader_font_size ?>> Demuestre Los Tiempos De la Llamada Del Estado </a> &nbsp; &nbsp; |  &nbsp; &nbsp; <a href="<? echo $PHP_SELF ?>?ADD=1111111111"><FONT FACE="ARIAL,HELVETICA" COLOR=BLACK SIZE=<?=$subheader_font_size ?>> Agregue Un Nuevo Rato De la Llamada Del Estado </a> &nbsp; </TD></TR>
		<? } 
	if (strlen($phones_sh) > 1) { 
		?>
	<TR BGCOLOR=<?=$phones_color ?>><TD ALIGN=LEFT COLSPAN=10><FONT FACE="ARIAL,HELVETICA" COLOR=BLACK SIZE=<?=$subheader_font_size ?>> &nbsp; <a href="<? echo $PHP_SELF ?>?ADD=10000000000"><FONT FACE="ARIAL,HELVETICA" COLOR=BLACK SIZE=<?=$subheader_font_size ?>> Demuestre Los Teléfonos </a> &nbsp; | &nbsp; <a href="<? echo $PHP_SELF ?>?ADD=11111111111"><FONT FACE="ARIAL,HELVETICA" COLOR=BLACK SIZE=<?=$subheader_font_size ?>> Agregue Un Teléfono Nuevo </a></TD></TR>
		<? }
	if (strlen($conference_sh) > 1) { 
		?>
	<TR BGCOLOR=<?=$conference_color ?>><TD ALIGN=LEFT COLSPAN=10><a href="<? echo $PHP_SELF ?>?ADD=1000000000000"><FONT FACE="ARIAL,HELVETICA" COLOR=BLACK SIZE=<?=$subheader_font_size ?>> Demuestre Las Conferencias </a> &nbsp; | &nbsp; <a href="<? echo $PHP_SELF ?>?ADD=1111111111111"><FONT FACE="ARIAL,HELVETICA" COLOR=BLACK SIZE=<?=$subheader_font_size ?>> Agregue Una Nueva Conferencia </a> &nbsp; | &nbsp; <a href="<? echo $PHP_SELF ?>?ADD=10000000000000"><FONT FACE="ARIAL,HELVETICA" COLOR=BLACK SIZE=<?=$subheader_font_size ?>> Demuestre Las Conferencias de VICIDIAL </a> &nbsp; | &nbsp; <a href="<? echo $PHP_SELF ?>?ADD=11111111111111"><FONT FACE="ARIAL,HELVETICA" COLOR=BLACK SIZE=<?=$subheader_font_size ?>> Agregue Una Nueva Conferencia de VICIDIAL </a></TD></TR>
		<? }
	if (strlen($server_sh) > 1) { 
		?>
	<TR BGCOLOR=<?=$server_color ?>><TD ALIGN=LEFT COLSPAN=10><a href="<? echo $PHP_SELF ?>?ADD=100000000000"><FONT FACE="ARIAL,HELVETICA" COLOR=BLACK SIZE=<?=$subheader_font_size ?>> Demuestre Los Servidores </a> &nbsp; | &nbsp; <a href="<? echo $PHP_SELF ?>?ADD=111111111111"><FONT FACE="ARIAL,HELVETICA" COLOR=BLACK SIZE=<?=$subheader_font_size ?>> Agregue Un Servidor Nuevo </a></TD></TR>
	<?}
	if (strlen($settings_sh) > 1) { 
		?>
	<TR BGCOLOR=<?=$settings_color ?>><TD ALIGN=LEFT COLSPAN=10><a href="<? echo $PHP_SELF ?>?ADD=311111111111111"><FONT FACE="ARIAL,HELVETICA" COLOR=BLACK SIZE=<?=$subheader_font_size ?>> Ajustes Del Sistema </a></TD></TR>
	<?}

### Do nothing if admin has no permissions
if($LOGast_admin_access < 1) 
	{
	$ADD='99999999999999999999';
	echo "</TABLE></center>\n";
	echo "Le no autorizan a visión esta página. Vaya por favor detrás.\n";
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

	echo "<br>NUEVO USUARIO <form action=$PHP_SELF method=POST>\n";
	echo "<input type=hidden name=ADD value=2>\n";
	echo "<center><TABLE width=$section_width cellspacing=3>\n";
	echo "<tr bgcolor=#B6D3FC><td align=right>NÚmero De Usuario: </td><td align=left><input type=text name=user size=20 maxlength=10>$NWB#vicidial_users-user$NWE</td></tr>\n";
	echo "<tr bgcolor=#B6D3FC><td align=right>Contraseña: </td><td align=left><input type=text name=pass size=20 maxlength=10>$NWB#vicidial_users-pass$NWE</td></tr>\n";
	echo "<tr bgcolor=#B6D3FC><td align=right>Nombre Completo: </td><td align=left><input type=text name=full_name size=20 maxlength=100>$NWB#vicidial_users-full_name$NWE</td></tr>\n";
	echo "<tr bgcolor=#B6D3FC><td align=right>Nivel Del Usuario: </td><td align=left><select size=1 name=user_level>";
	$h=1;
	while ($h<=$LOGuser_level)
		{
		echo "<option>$h</option>";
		$h++;
		}
	echo "</select>$NWB#vicidial_users-user_level$NWE</td></tr>\n";
	echo "<tr bgcolor=#B6D3FC><td align=right>Grupo Del Usuario: </td><td align=left><select size=1 name=user_group>\n";

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
	echo "<tr bgcolor=#B6D3FC><td align=right>Conexión Del Teléfono: </td><td align=left><input type=text name=phone_login size=20 maxlength=20>$NWB#vicidial_users-phone_login$NWE</td></tr>\n";
	echo "<tr bgcolor=#B6D3FC><td align=right>Contraseña Del Teléfono: </td><td align=left><input type=text name=phone_pass size=20 maxlength=20>$NWB#vicidial_users-phone_pass$NWE</td></tr>\n";
	echo "</select>$NWB#vicidial_users-user_group$NWE</td></tr>\n";
	echo "<tr bgcolor=#B6D3FC><td align=center colspan=2><input type=submit name=ENVIAR value=ENVIAR></td></tr>\n";
	echo "</TABLE></center>\n";
	}
	else
	{
	echo "Usted no tiene permiso de visión esta página\n";
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

	echo "<br>NUEVA CAMPAÑA<form action=$PHP_SELF method=POST>\n";
	echo "<input type=hidden name=ADD value=21>\n";
	echo "<center><TABLE width=$section_width cellspacing=3>\n";
	echo "<tr bgcolor=#B6D3FC><td align=right>ID De la Campaña: </td><td align=left><input type=text name=campaign_id size=10 maxlength=8>$NWB#vicidial_campaigns-campaign_id$NWE</td></tr>\n";
	echo "<tr bgcolor=#B6D3FC><td align=right>Nombre de la Campaña: </td><td align=left><input type=text name=campaign_name size=30 maxlength=30>$NWB#vicidial_campaigns-campaign_name$NWE</td></tr>\n";
	echo "<tr bgcolor=#B6D3FC><td align=right>Descripción De la Campaña: </td><td align=left><input type=text name=campaign_description size=30 maxlength=255>$NWB#vicidial_campaigns-campaign_description$NWE</td></tr>\n";
	echo "<tr bgcolor=#B6D3FC><td align=right>Activo: </td><td align=left><select size=1 name=active><option>Y</option><option>N</option></select>$NWB#vicidial_campaigns-active$NWE</td></tr>\n";
	echo "<tr bgcolor=#B6D3FC><td align=right>Extensión del parking: </td><td align=left><input type=text name=park_ext size=10 maxlength=10>$NWB#vicidial_campaigns-park_ext$NWE</td></tr>\n";
	echo "<tr bgcolor=#B6D3FC><td align=right>Nombre de fichero Del Parking: </td><td align=left><input type=text name=park_file_name size=10 maxlength=10>$NWB#vicidial_campaigns-park_file_name$NWE</td></tr>\n";
	echo "<tr bgcolor=#B6D3FC><td align=right>Formulario Web: </td><td align=left><input type=text name=web_form_address size=50 maxlength=255>$NWB#vicidial_campaigns-web_form_address$NWE</td></tr>\n";
	echo "<tr bgcolor=#B6D3FC><td align=right>Permitir Closers: </td><td align=left><select size=1 name=allow_closers><option>Y</option><option>N</option></select>$NWB#vicidial_campaigns-allow_closers$NWE</td></tr>\n";
	echo "<tr bgcolor=#B6D3FC><td align=right>Nivel Del Hopper: </td><td align=left><select size=1 name=hopper_level><option>1</option><option>5</option><option>10</option><option>50</option><option>100</option><option>200</option><option>500</option><option>1000</option><option>2000</option></select>$NWB#vicidial_campaigns-hopper_level$NWE</td></tr>\n";
	echo "<tr bgcolor=#B6D3FC><td align=right>Nivel del Auto-Dial: </td><td align=left><select size=1 name=auto_dial_level><option selected>0</option><option>1</option><option>1.1</option><option>1.2</option><option>1.3</option><option>1.4</option><option>1.5</option><option>1.6</option><option>1.7</option><option>1.8</option><option>1.9</option><option>2.0</option><option>2.2</option><option>2.5</option><option>2.7</option><option>3.0</option><option>3.5</option><option>4.0</option></select>(0 = off)$NWB#vicidial_campaigns-auto_dial_level$NWE</td></tr>\n";
	echo "<tr bgcolor=#B6D3FC><td align=right>Llamar al Siguiente  Agente: </td><td align=left><select size=1 name=next_agent_call><option >random</option><option>oldest_call_start</option><option>oldest_call_finish</option><option>overall_user_level</option></select>$NWB#vicidial_campaigns-next_agent_call$NWE</td></tr>\n";
	echo "<tr bgcolor=#B6D3FC><td align=right>Franja horaria de llamada: </td><td align=left><select size=1 name=local_call_time><option>24hours</option><option>9am-9pm</option><option>9am-5pm</option><option>12pm-5pm</option><option>12pm-9pm</option><option>5pm-9pm</option></select>$NWB#vicidial_campaigns-local_call_time$NWE</td></tr>\n";
	echo "<tr bgcolor=#B6D3FC><td align=right>Buzón de Voz: </td><td align=left><input type=text name=voicemail_ext size=10 maxlength=10 value=\"$voicemail_ext\">$NWB#vicidial_campaigns-voicemail_ext$NWE</td></tr>\n";
	echo "<tr bgcolor=#B6D3FC><td align=right>Escritura: </td><td align=left><select size=1 name=script_id>\n";
	echo "$scripts_list";
	echo "</select>$NWB#vicidial_campaigns-campaign_script$NWE</td></tr>\n";
	echo "<tr bgcolor=#B6D3FC><td align=right>Consiga El Lanzamiento De la Llamada: </td><td align=left><select size=1 name=get_call_launch><option selected>NONE</option><option>SCRIPT</option><option>WEBFORM</option></select>$NWB#vicidial_campaigns-get_call_launch$NWE</td></tr>\n";
	echo "<tr bgcolor=#B6D3FC><td align=center colspan=2><input type=submit name=ENVIAR value=ENVIAR></td></tr>\n";
	echo "</TABLE></center>\n";
	}
	else
	{
	echo "Usted no tiene permiso de visión esta página\n";
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
	echo "<tr bgcolor=#B6D3FC><td align=right>ID De la Lista: </td><td align=left><input type=text name=list_id size=8 maxlength=8> (Solamente dígitos)$NWB#vicidial_lists-list_id$NWE</td></tr>\n";
	echo "<tr bgcolor=#B6D3FC><td align=right>Nombre De la Lista: </td><td align=left><input type=text name=list_name size=20 maxlength=20>$NWB#vicidial_lists-list_name$NWE</td></tr>\n";
	echo "<tr bgcolor=#B6D3FC><td align=right>Descripción De la Lista: </td><td align=left><input type=text name=list_description size=30 maxlength=255>$NWB#vicidial_lists-list_description$NWE</td></tr>\n";
	echo "<tr bgcolor=#B6D3FC><td align=right>Campaña: </td><td align=left><select size=1 name=campaign_id>\n";

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
	echo "<tr bgcolor=#B6D3FC><td align=right>Activo: </td><td align=left><select size=1 name=active><option>Y</option><option SELECTED>N</option></select>$NWB#vicidial_lists-active$NWE</td></tr>\n";
	echo "<tr bgcolor=#B6D3FC><td align=center colspan=2><input type=submit name=ENVIAR value=ENVIAR></td></tr>\n";
	echo "</TABLE></center>\n";
	}
	else
	{
	echo "Usted no tiene permiso de visión esta página\n";
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
		{echo "<br>DNC NO AGREGADO - este número de teléfono está en no llama ya lalista: $phone_number<BR><BR>\n";}
	else
		{
		$stmt="INSERT INTO vicidial_dnc (phone_number) values('$phone_number');";
		$rslt=mysql_query($stmt, $link);

		echo "<br><B>DNC AGREGADO: $phone_number</B><BR><BR>\n";

		### LOG INSERTION TO LOG FILE ###
		if ($WeBRooTWritablE > 0)
			{
			$fp = fopen ("./admin_changes_log.txt", "a");
			fwrite ($fp, "$date|ADD A NEW DNC NUMBER|$PHP_AUTH_USER|$ip|'$phone_number'|\n");
			fclose($fp);
			}
		}
	}

echo "<br>AGREGUE Un NÚMERO A la LISTA De DNC<form action=$PHP_SELF method=POST>\n";
echo "<input type=hidden name=ADD value=121>\n";
echo "<center><TABLE width=$section_width cellspacing=3>\n";
echo "<tr bgcolor=#B6D3FC><td align=right>Número De Teléfono: </td><td align=left><input type=text name=phone_number size=14 maxlength=12> (Solamente dígitos)$NWB#vicidial_list-dnc$NWE</td></tr>\n";
echo "<tr bgcolor=#B6D3FC><td align=center colspan=2><input type=submit name=ENVIAR value=ENVIAR></td></tr>\n";
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

	echo "<br>NUEVO GRUPO DE ENTRADA<form action=$PHP_SELF method=POST>\n";
	echo "<input type=hidden name=ADD value=2111>\n";
	echo "<center><TABLE width=$section_width cellspacing=3>\n";
	echo "<tr bgcolor=#B6D3FC><td align=right>ID De Grupo: </td><td align=left><input type=text name=group_id size=20 maxlength=20> (no spaces)$NWB#vicidial_inbound_groups-group_id$NWE</td></tr>\n";
	echo "<tr bgcolor=#B6D3FC><td align=right>Nombre De Grupo: </td><td align=left><input type=text name=group_name size=30 maxlength=30>$NWB#vicidial_inbound_groups-group_name$NWE</td></tr>\n";
	echo "<tr bgcolor=#B6D3FC><td align=right>Color Del Grupo: </td><td align=left><input type=text name=group_color size=7 maxlength=7>$NWB#vicidial_inbound_groups-group_color$NWE</td></tr>\n";
	echo "<tr bgcolor=#B6D3FC><td align=right>Activo: </td><td align=left><select size=1 name=active><option SELECTED>Y</option><option>N</option></select>$NWB#vicidial_inbound_groups-active$NWE</td></tr>\n";
	echo "<tr bgcolor=#B6D3FC><td align=right>Formulario Web: </td><td align=left><input type=text name=web_form_address size=50 maxlength=255 value=\"$web_form_address\">$NWB#vicidial_inbound_groups-web_form_address$NWE</td></tr>\n";
	echo "<tr bgcolor=#B6D3FC><td align=right>Buzón de Voz: </td><td align=left><input type=text name=voicemail_ext size=10 maxlength=10 value=\"$voicemail_ext\">$NWB#vicidial_inbound_groups-voicemail_ext$NWE</td></tr>\n";
	echo "<tr bgcolor=#B6D3FC><td align=right>Llamar al Siguiente  Agente: </td><td align=left><select size=1 name=next_agent_call><option >random</option><option>oldest_call_start</option><option>oldest_call_finish</option><option>overall_user_level</option></select>$NWB#vicidial_inbound_groups-next_agent_call$NWE</td></tr>\n";
	echo "<tr bgcolor=#B6D3FC><td align=right>Mostrar Fronter: </td><td align=left><select size=1 name=fronter_display><option SELECTED>Y</option><option>N</option></select>$NWB#vicidial_inbound_groups-fronter_display$NWE</td></tr>\n";
	echo "<tr bgcolor=#B6D3FC><td align=right>Escritura: </td><td align=left><select size=1 name=script_id>\n";
	echo "$scripts_list";
	echo "</select>$NWB#vicidial_inbound_groups-ingroup_script$NWE</td></tr>\n";
	echo "<tr bgcolor=#B6D3FC><td align=right>Consiga El Lanzamiento De la Llamada: </td><td align=left><select size=1 name=get_call_launch><option selected>NONE</option><option>SCRIPT</option><option>WEBFORM</option></select>$NWB#vicidial_inbound_groups-get_call_launch$NWE</td></tr>\n";
	echo "<tr bgcolor=#B6D3FC><td align=center colspan=2><input type=submit name=ENVIAR value=ENVIAR></td></tr>\n";
	echo "</TABLE></center>\n";
	}
	else
	{
	echo "Usted no tiene permiso de visión esta página\n";
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

	echo "<br>NUEVO AGENTE REMOTO<form action=$PHP_SELF method=POST>\n";
	echo "<input type=hidden name=ADD value=21111>\n";
	echo "<center><TABLE width=$section_width cellspacing=3>\n";
	echo "<tr bgcolor=#B6D3FC><td align=right>Comienzo Del ID del usuario: </td><td align=left><input type=text name=user_start size=6 maxlength=6> (Solamente números, incremented)$NWB#vicidial_remote_agents-user_start$NWE</td></tr>\n";
	echo "<tr bgcolor=#B6D3FC><td align=right>Número de líneas: </td><td align=left><input type=text name=number_of_lines size=3 maxlength=3> (Solamente números)$NWB#vicidial_remote_agents-number_of_lines$NWE</td></tr>\n";
	echo "<tr bgcolor=#B6D3FC><td align=right>IP Del Servidor: </td><td align=left><select size=1 name=server_ip>\n";
	echo "$servers_list";
	echo "</select>$NWB#vicidial_remote_agents-server_ip$NWE</td></tr>\n";
	echo "<tr bgcolor=#B6D3FC><td align=right>Extensión Externa: </td><td align=left><input type=text name=conf_exten size=20 maxlength=20> (número del dial plan para alcanzar agentes)$NWB#vicidial_remote_agents-conf_exten$NWE</td></tr>\n";
	echo "<tr bgcolor=#B6D3FC><td align=right>Estado: </td><td align=left><select size=1 name=status><option>ACTIVO</option><option SELECTED>INACTIVE</option></select>$NWB#vicidial_remote_agents-status$NWE</td></tr>\n";
	echo "<tr bgcolor=#B6D3FC><td align=right>Campaña: </td><td align=left><select size=1 name=campaign_id>\n";
	echo "$campaigns_list";
	echo "</select>$NWB#vicidial_remote_agents-campaign_id$NWE</td></tr>\n";
	echo "<tr bgcolor=#B6D3FC><td align=right>Grupos De entrada: </td><td align=left>\n";
	echo "$groups_list";
	echo "$NWB#vicidial_remote_agents-closer_campaigns$NWE</td></tr>\n";
	echo "<tr bgcolor=#B6D3FC><td align=center colspan=2><input type=submit name=ENVIAR value=ENVIAR></td></tr>\n";
	echo "</TABLE></center>\n";
	echo "NOTA: Puede tomar hasta 30 segundos para los cambios sometidos en esta pantalla para ir viva\n";
	}
	else
	{
	echo "Usted no tiene permiso de visión esta página\n";
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

	echo "<br>NUEVO GRUPO DE USUARIOS<form action=$PHP_SELF method=POST>\n";
	echo "<input type=hidden name=ADD value=211111>\n";
	echo "<center><TABLE width=$section_width cellspacing=3>\n";
	echo "<tr bgcolor=#B6D3FC><td align=right>Grupo: </td><td align=left><input type=text name=user_group size=15 maxlength=20> (sin espacios o signos de puntuación)$NWB#vicidial_user_groups-user_group$NWE</td></tr>\n";
	echo "<tr bgcolor=#B6D3FC><td align=right>Descripción: </td><td align=left><input type=text name=group_name size=40 maxlength=40> (Descripción del grupo)$NWB#vicidial_user_groups-group_name$NWE</td></tr>\n";
	echo "<tr bgcolor=#B6D3FC><td align=center colspan=2><input type=submit name=ENVIAR value=ENVIAR></td></tr>\n";
	echo "</TABLE></center>\n";
	}
	else
	{
	echo "Usted no tiene permiso de visión esta página\n";
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
	echo "<tr bgcolor=#B6D3FC><td align=right>Identificación De la Escritura:: </td><td align=left><input type=text name=script_id size=12 maxlength=10> (sin espacios o signos de puntuación)$NWB#vicidial_scripts-script_id$NWE</td></tr>\n";
	echo "<tr bgcolor=#B6D3FC><td align=right>Nombre de la escritura: </td><td align=left><input type=text name=script_name size=40 maxlength=50> (título de la escritura)$NWB#vicidial_scripts-script_name$NWE</td></tr>\n";
	echo "<tr bgcolor=#B6D3FC><td align=right>Comentarios de la escritura: </td><td align=left><input type=text name=script_comments size=50 maxlength=255> $NWB#vicidial_scripts-script_comments$NWE</td></tr>\n";
	echo "<tr bgcolor=#B6D3FC><td align=right>Activo: </td><td align=left><select size=1 name=active><option SELECTED>Y</option><option>N</option></select>$NWB#vicidial_scripts-active$NWE</td></tr>\n";
	echo "<tr bgcolor=#B6D3FC><td align=right>Texto de la escritura: </td><td align=left>";
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
	echo "<tr bgcolor=#B6D3FC><td align=center colspan=2><input type=submit name=ENVIAR value=ENVIAR></td></tr>\n";
	echo "</TABLE></center>\n";
	}
	else
	{
	echo "Usted no tiene permiso de visión esta página\n";
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

	echo "<br>AGREGUE EL FILTRO NUEVO<form action=$PHP_SELF method=POST>\n";
	echo "<input type=hidden name=ADD value=21111111>\n";
	echo "<center><TABLE width=$section_width cellspacing=3>\n";
	echo "<tr bgcolor=#B6D3FC><td align=right>Identificación Del Filtro:</td><td align=left><input type=text name=lead_filter_id size=12 maxlength=10> (sin espacios o signos de puntuación)$NWB#vicidial_lead_filters-lead_filter_id$NWE</td></tr>\n";
	echo "<tr bgcolor=#B6D3FC><td align=right>Nombre Del Filtro:</td><td align=left><input type=text name=lead_filter_name size=30 maxlength=30> (descripción corta del filtro)$NWB#vicidial_lead_filters-lead_filter_name$NWE</td></tr>\n";
	echo "<tr bgcolor=#B6D3FC><td align=right>Comentarios Del Filtro: </td><td align=left><input type=text name=lead_filter_comments size=50 maxlength=255> $NWB#vicidial_lead_filters-lead_filter_comments$NWE</td></tr>\n";
	echo "<tr bgcolor=#B6D3FC><td align=right>Filtro Sql: </td><td align=left><TEXTAREA NAME=lead_filter_sql ROWS=20 COLS=50 value=\"\"></TEXTAREA> $NWB#vicidial_lead_filters-lead_filter_sql$NWE</td></tr>\n";
	echo "<tr bgcolor=#B6D3FC><td align=center colspan=2><input type=submit name=ENVIAR value=ENVIAR></td></tr>\n";
	echo "</TABLE></center>\n";
	}
	else
	{
	echo "Usted no tiene permiso de visión esta página\n";
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

	echo "<br>AGREGUE EL NUEVO TIEMPO DE LA LLAMADA<form action=$PHP_SELF method=POST>\n";
	echo "<input type=hidden name=ADD value=211111111>\n";
	echo "<center><TABLE width=$section_width cellspacing=3>\n";
	echo "<tr bgcolor=#B6D3FC><td align=right>Identificación Del Tiempo De la Llamada: </td><td align=left><input type=text name=call_time_id size=12 maxlength=10> (sin espacios o signos de puntuación)$NWB#vicidial_call_times-call_time_id$NWE</td></tr>\n";
	echo "<tr bgcolor=#B6D3FC><td align=right>Nombre Del Tiempo De la Llamada: </td><td align=left><input type=text name=call_time_name size=30 maxlength=30> (descripción corta del tiempo de la llamada)$NWB#vicidial_call_times-call_time_name$NWE</td></tr>\n";
	echo "<tr bgcolor=#B6D3FC><td align=right>Comentarios Del Tiempo De la Llamada: </td><td align=left><input type=text name=call_time_comments size=50 maxlength=255> $NWB#vicidial_call_times-call_time_comments$NWE</td></tr>\n";

	echo "<tr bgcolor=#B6D3FC><td align=center colspan=2>Las opciones del día y del tiempo aparecerán una vez que usted hayacreado la definición del tiempo de la llamada</td></tr>\n";
	echo "<tr bgcolor=#B6D3FC><td align=center colspan=2><input type=submit name=ENVIAR value=ENVIAR></td></tr>\n";
	echo "</TABLE></center>\n";
	}
	else
	{
	echo "Usted no tiene permiso de visión esta página\n";
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

	echo "<br>AGREGUE EL NUEVO TIEMPO DE LA LLAMADA DEL ESTADO<form action=$PHP_SELF method=POST>\n";
	echo "<input type=hidden name=ADD value=2111111111>\n";
	echo "<center><TABLE width=$section_width cellspacing=3>\n";
	echo "<tr bgcolor=#B6D3FC><td align=right>Identificación Del Tiempo De la Llamada Del Estado: </td><td align=left><input type=text name=call_time_id size=12 maxlength=10> (sin espacios o signos de puntuación)$NWB#vicidial_call_times-call_time_id$NWE</td></tr>\n";
	echo "<tr bgcolor=#B6D3FC><td align=right>State Call Time State: </td><td align=left><input type=text name=state_call_time_state size=4 maxlength=2> (sin espacios o signos de puntuación)$NWB#vicidial_call_times-state_call_time_state$NWE</td></tr>\n";
	echo "<tr bgcolor=#B6D3FC><td align=right>_ Estado Llamar Tiempo Nombre: </td><td align=left><input type=text name=call_time_name size=30 maxlength=30> (descripción corta del tiempo de la llamada)$NWB#vicidial_call_times-call_time_name$NWE</td></tr>\n";
	echo "<tr bgcolor=#B6D3FC><td align=right>Comentarios Del Tiempo De la Llamada Del Estado: </td><td align=left><input type=text name=call_time_comments size=50 maxlength=255> $NWB#vicidial_call_times-call_time_comments$NWE</td></tr>\n";

	echo "<tr bgcolor=#B6D3FC><td align=center colspan=2>Las opciones del día y del tiempo aparecerán una vez que usted hayacreado la definición del tiempo de la llamada</td></tr>\n";
	echo "<tr bgcolor=#B6D3FC><td align=center colspan=2><input type=submit name=ENVIAR value=ENVIAR></td></tr>\n";
	echo "</TABLE></center>\n";
	}
	else
	{
	echo "Usted no tiene permiso de visión esta página\n";
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

	echo "<br>AGREGUE Un TELÉFONO NUEVO<form action=$PHP_SELF method=POST>\n";
	echo "<input type=hidden name=ADD value=21111111111>\n";
	echo "<center><TABLE width=$section_width cellspacing=3>\n";

	echo "<center><TABLE width=$section_width cellspacing=3>\n";
	echo "<tr bgcolor=#B6D3FC><td align=right>Extensión del teléfono: </td><td align=left><input type=text name=extension size=20 maxlength=100 value=\"\">$NWB#phones-extension$NWE</td></tr>\n";
	echo "<tr bgcolor=#B6D3FC><td align=right>Número De Dial plan: </td><td align=left><input type=text name=dialplan_number size=15 maxlength=20 value=\"$row[1]\"> (Solamente dígitos)$NWB#phones-dialplan_number$NWE</td></tr>\n";
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
	echo "<tr bgcolor=#B6D3FC><td align=right>GMT Local: </td><td align=left><select size=1 name=local_gmt><option>12.75</option><option>12.00</option><option>11.00</option><option>10.00</option><option>9.50</option><option>9.00</option><option>8.00</option><option>7.00</option><option>6.50</option><option>6.00</option><option>5.75</option><option>5.50</option><option>5.00</option><option>4.50</option><option>4.00</option><option>3.50</option><option>3.00</option><option>2.00</option><option>1.00</option><option>0.00</option><option>-1.00</option><option>-2.00</option><option>-3.00</option><option>-3.50</option><option>-4.00</option><option>-5.00</option><option>-6.00</option><option>-7.00</option><option>-8.00</option><option>-9.00</option><option>-10.00</option><option>-11.00</option><option>-12.00</option><option selected>$row[17]</option></select> (No ajustar para el DST)$NWB#phones-local_gmt$NWE</td></tr>\n";
	echo "<tr bgcolor=#B6D3FC><td align=center colspan=2><input type=submit name=submit VALUE=ENVIAR></td></tr>\n";
	echo "</TABLE></center>\n";
	}
	else
	{
	echo "Usted no tiene permiso de visión esta página\n";
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

	echo "<br>AGREGAR Un SERVIDOR NUEVO<form action=$PHP_SELF method=POST>\n";
	echo "<input type=hidden name=ADD value=211111111111>\n";
	echo "<center><TABLE width=$section_width cellspacing=3>\n";
	echo "<tr bgcolor=#B6D3FC><td align=right>ID Del Servidor: </td><td align=left><input type=text name=server_id size=10 maxlength=10>$NWB#servers-server_id$NWE</td></tr>\n";
	echo "<tr bgcolor=#B6D3FC><td align=right>Descripción Del Servidor: </td><td align=left><input type=text name=server_description size=30 maxlength=255>$NWB#servers-server_description$NWE</td></tr>\n";
	echo "<tr bgcolor=#B6D3FC><td align=right>Dirección IP del Servidor: </td><td align=left><input type=text name=server_ip size=20 maxlength=15>$NWB#servers-server_ip$NWE</td></tr>\n";
	echo "<tr bgcolor=#B6D3FC><td align=right>Activo: </td><td align=left><select size=1 name=active><option>Y</option><option>N</option></select>$NWB#servers-active$NWE</td></tr>\n";
	echo "<tr bgcolor=#B6D3FC><td align=right>Versión De Asterisk: </td><td align=left><input type=text name=asterisk_version size=20 maxlength=20>$NWB#servers-asterisk_version$NWE</td></tr>\n";
	echo "<tr bgcolor=#B6D3FC><td align=center colspan=2><input type=submit name=submit VALUE=ENVIAR></td></tr>\n";
	echo "</TABLE></center>\n";
	}
	else
	{
	echo "Usted no tiene permiso de visión esta página\n";
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

	echo "<br>AGREGUE Una NUEVA CONFERENCIA<form action=$PHP_SELF method=POST>\n";
	echo "<input type=hidden name=ADD value=2111111111111>\n";
	echo "<center><TABLE width=$section_width cellspacing=3>\n";
	echo "<tr bgcolor=#B6D3FC><td align=right>Número de la Conferencia: </td><td align=left><input type=text name=conf_exten size=8 maxlength=7> (Solamente dígitos)$NWB#conferences-conf_exten$NWE</td></tr>\n";
	echo "<tr bgcolor=#B6D3FC><td align=right>IP Del Servidor: </td><td align=left><select size=1 name=server_ip>\n";

	echo "$servers_list";
	echo "<option SELECTED>$server_ip</option>\n";
	echo "</select>$NWB#conferences-server_ip$NWE</td></tr>\n";
	echo "<tr bgcolor=#B6D3FC><td align=center colspan=2><input type=submit name=submit VALUE=ENVIAR></td></tr>\n";
	echo "</TABLE></center>\n";
	}
	else
	{
	echo "Usted no tiene permiso de visión esta página\n";
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
	echo "<tr bgcolor=#B6D3FC><td align=right>Número de la Conferencia: </td><td align=left><input type=text name=conf_exten size=8 maxlength=7> (Solamente dígitos)$NWB#conferences-conf_exten$NWE</td></tr>\n";
	echo "<tr bgcolor=#B6D3FC><td align=right>IP Del Servidor: </td><td align=left><select size=1 name=server_ip>\n";

	echo "$servers_list";
	echo "<option SELECTED>$server_ip</option>\n";
	echo "</select>$NWB#conferences-server_ip$NWE</td></tr>\n";
	echo "<tr bgcolor=#B6D3FC><td align=center colspan=2><input type=submit name=submit VALUE=ENVIAR></td></tr>\n";
	echo "</TABLE></center>\n";
	}
	else
	{
	echo "Usted no tiene permiso de visión esta página\n";
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
		{echo "<br>USUARIO NO AGREGADO - hay ya un usuario en el sistema con este número del usuario\n";}
	else
		{
		 if ( (strlen($user) < 2) or (strlen($pass) < 2) or (strlen($full_name) < 2) or (strlen($user) > 8) )
			{
			 echo "<br>USUARIO NO AGREGADO - vaya por favor detrás y mire los datos que usted incorporó\n";
			 echo "<br>la ID del usuario debe estar entre 2 y 8 caracteres de largo\n";
			 echo "<br>el nombre completo y la contraseña deben ser por lo menos 2 caracteres de largo\n";
			}
		 else
			{
			echo "<br><B>EL USUARIOAÑADIDO: $user</B>\n";

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
		{echo "<br>CAMPAÚA NO AGREGADA - hay ya una campaña en el sistema con esta identificación\n";}
	else
		{
		 if ( (strlen($campaign_id) < 2) or (strlen($campaign_id) > 8) or (strlen($campaign_name) < 6)  or (strlen($campaign_name) > 40) )
			{
			 echo "<br>CAMPAÚA NO AGREGADA - vaya por favor detrás y mire los datos que usted incorporó\n";
			 echo "<br>la ID de la campaña debe estar entre 2 y 8 caracteres en longitud\n";
			 echo "<br>el nombre de la campaña debe estar entre 6 y 40 caracteres en longitud\n";
			}
		 else
			{
			echo "<br><B>CAMPAÑA AÑADIDA: $campaign_id</B>\n";

			$stmt="INSERT INTO vicidial_campaigns (campaign_id,campaign_name,campaign_description,active,dial_status_a,lead_order,park_ext,park_file_name,web_form_address,allow_closers,hopper_level,auto_dial_level,next_agent_call,local_call_time,voicemail_ext,campaign_script,get_call_launch,campaign_changedate,campaign_stats_refresh) values('$campaign_id','$campaign_name','$campaign_description','$active','NEW','DOWN','$park_ext','$park_file_name','" . mysql_real_escape_string($web_form_address) . "','$allow_closers','$hopper_level','$auto_dial_level','$next_agent_call','$local_call_time','$voicemail_ext','$script_id','$get_call_launch','$SQLdate','Y');";
			$rslt=mysql_query($stmt, $link);

			$stmt="INSERT INTO vicidial_campaign_stats (campaign_id) values('$campaign_id');";
			$rslt=mysql_query($stmt, $link);

			echo "<!-- $stmt -->";
			### LOG CHANGES TO LOG FILE ###
			if ($WeBRooTWritablE > 0)
				{
				$fp = fopen ("./admin_changes_log.txt", "a");
				fwrite ($fp, "$date|NUEVA CAMPAÑA  |$PHP_AUTH_USER|$ip|$stmt|\n");
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
		{echo "<br>ESTADO de la CAMPAÚA - hay ya una campaña - estado NO AGREGADO en el sistema con este nombre\n";}
	else
		{
		$stmt="SELECT count(*) from vicidial_statuses where status='$status';";
		$rslt=mysql_query($stmt, $link);
		$row=mysql_fetch_row($rslt);
		if ($row[0] > 0)
			{echo "<br>ESTADO de la CAMPAÚA NO AGREGADO - hay ya un global-estado en el sistema con este nombre\n";}
		else
			{
			 if ( (strlen($campaign_id) < 2) or (strlen($status) < 1) or (strlen($status_name) < 2) )
				{
				 echo "<br>ESTADO de la CAMPAÚA NO AGREGADO - vaya por favor detrás y mire los datos que usted incorporó\n";
				 echo "<br>el estado debe estar entre 1 y 8 caracteres en longitud\n";
				 echo "<br>el nombre del estado debe estar entre 2 y 30 caracteres en longitud\n";
				}
			 else
				{
				echo "<br><B>ESTADO DE LA CAMPAÑA AÑADIDA: $campaign_id - $status</B>\n";

				$stmt="INSERT INTO vicidial_campaign_statuses values('$status','$status_name','$selectable','$campaign_id');";
				$rslt=mysql_query($stmt, $link);

				### LOG CHANGES TO LOG FILE ###
				if ($WeBRooTWritablE > 0)
					{
					$fp = fopen ("./admin_changes_log.txt", "a");
					fwrite ($fp, "$date|NUEVA CAMPAÑA STATUS |$PHP_AUTH_USER|$ip|'$status','$status_name','$selectable','$campaign_id'|\n");
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
			 echo "<br>CAMPAÚA HOT KEY NO AGREGADA - vaya por favor detrás y mire los datos que usted incorporó\n";
			 echo "<br>hotkey must be a single character between 1 and 9 \n";
			 echo "<br>el estado debe estar entre 1 y 8 caracteres en longitud\n";
			}
		 else
			{
			echo "<br><B>ACCESO DIRECTO A LA CAMPAÑA AÑADIDO: $campaign_id - $status - $hotkey</B>\n";

			$stmt="INSERT INTO vicidial_campaign_hotkeys values('$status','$hotkey','$status_name','$selectable','$campaign_id');";
			$rslt=mysql_query($stmt, $link);

			### LOG CHANGES TO LOG FILE ###
			if ($WeBRooTWritablE > 0)
				{
				$fp = fopen ("./admin_changes_log.txt", "a");
				fwrite ($fp, "$date|NUEVA CAMPAÑA HOT KEY |$PHP_AUTH_USER|$ip|'$status','$hotkey','$status_name','$selectable','$campaign_id'|\n");
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
		{echo "<br>El PLOMO de la CAMPAÑA RECICLA NO AGREGADO - hay ya unconducir-reciclaje para esta campaña con este estado\n";}
	else
		{
		 if ( (strlen($campaign_id) < 2) or (strlen($status) < 1) or ($attempt_delay < 120) or ($attempt_maximum < 1) or ($attempt_maximum > 10) )
			{
			 echo "<br>CAMPAIGN LEAD RECYCLE NOT ADDED - Vaya por favor detrás y mire los datos que usted incorporó\n";
			 echo "<br>el estado debe estar entre 1 y 6 caracteres en longitud\n";
			 echo "<br>la tentativa retrasa debe ser por lo menos 120 segundos\n";
			 echo "<br>las tentativas máximas deben ser a partir la 1 a 10\n";
			}
		 else
			{
			echo "<br><B>EL PLOMO DE LA CAMPAÑA RECICLA AGREGADO: $campaign_id - $status - $attempt_delay</B>\n";

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
		{echo "<br>ESTADO AUTO DEL DIAL DEL ALT NO AGREGADO - hay ya una entrada para esta campaña con este estado\n";}
	else
		{
		 if ( (strlen($campaign_id) < 2) or (strlen($status) < 1) )
			{
			 echo "<br>ESTADO AUTO DEL DIAL DEL ALT NO AGREGADO - Vaya por favor detrás y mire los datos que usted incorporó\n";
			 echo "<br>el estado debe estar entre 1 y 6 caracteres en longitud\n";
			}
		 else
			{
			echo "<br><B>ESTADO AUTO DEL DIAL DEL ALT AGREGADO: $campaign_id - $status</B>\n";

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
		{echo "<br>CÓDIGO DE LA PAUSA DEL AGENTE NO AGREGADO - hay ya una entrada para esta campaña con este code\n";}
	else
		{
		 if ( (strlen($campaign_id) < 2) or (strlen($pause_code) < 1) or (strlen($pause_code) > 6) or (strlen($pause_code_name) < 2) )
			{
			 echo "<br>CÓDIGO DE LA PAUSA DEL AGENTE NO AGREGADO - Vaya por favor detrás y mire los datos que usted incorporó\n";
			 echo "<br>pause code must be between 1 and 6 characters in length\n";
			 echo "<br>pause code name must be between 2 and 30 characters in length\n";
			}
		 else
			{
			echo "<br><B>EL CÓDIGO DE LA PAUSA DEL AGENTE AGREGÓ: $campaign_id - $pause_code - $pause_code_name</B>\n";

			$stmt="INSERT INTO vicidial_pause_codes(campaign_id,pause_code,pause_code_name,billable) values('$campaign_id','$pause_code','$pause_code_name','$billable');";
			$rslt=mysql_query($stmt, $link);

			### LOG CHANGES TO LOG FILE ###
			if ($WeBRooTWritablE > 0)
				{
				$fp = fopen ("./admin_changes_log.txt", "a");
				fwrite ($fp, "$date|ADD A NEW AGENTE PAUSE CODE|$PHP_AUTH_USER|$ip|$stmt|\n");
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
		{echo "<br>ESTADO DEL DIAL DE LA CAMPAÑA NO AGREGADO - hay ya una entrada para esta campaña con este estado\n";}
	else
		{
		 if ( (strlen($campaign_id) < 2) or (strlen($status) < 1) )
			{
			 echo "<br>ESTADO DEL DIAL DE LA CAMPAÑA NO AGREGADO - Vaya por favor detrás y mire los datos que usted incorporó\n";
			 echo "<br>el estado debe estar entre 1 y 6 caracteres en longitud\n";
			}
		 else
			{
			echo "<br><B>EL ESTADO DEL DIAL DE LA CAMPAÑA AGREGÓ: $campaign_id - $status</B>\n";

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
				fwrite ($fp, "$date|NUEVA CAMPAÑA  DIAL STATUS  |$PHP_AUTH_USER|$ip|$stmt|\n");
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
		{echo "<br>LISTA NO AGREGADA - hay ya una lista en el sistema con esta ID\n";}
	else
		{
		 if ( (strlen($campaign_id) < 2) or (strlen($list_name) < 2)  or ($list_id < 100) or (strlen($list_id) > 8) )
			{
			 echo "<br>LISTA NO AGREGADA - vaya por favor detrás y mire los datos que usted incorporó\n";
			 echo "<br>La ID de la lista debe estar entre 2 y 8 caracteres en longitud\n";
			 echo "<br>El nombre de la lista debe ser por lo menos 2 caracteres en longitud\n";
			 echo "<br>ID De la Lista must be greater than 100\n";
			 }
		 else
			{
			echo "<br><B>LISTA AÑADIDA: $list_id</B>\n";

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
		{echo "<br>GRUPO NO AGREGADO - hay ya un grupo en el sistema con esta ID\n";}
	else
		{
		 if ( (strlen($group_id) < 2) or (strlen($group_name) < 2)  or (strlen($group_color) < 2) or (strlen($group_id) > 20) or (eregi(' ',$group_id)) or (eregi("\-",$group_id)) or (eregi("\+",$group_id)) )
			{
			 echo "<br>GRUPO NO AGREGADO - vaya por favor detrás y mire los datos que usted incorporó\n";
			 echo "<br>La ID de grupo debe estar entre 2 y 20 caracteres en longitud y contener no ' -+'.\n";
			 echo "<br>El color del nombre de grupo y del grupo debe ser por lo menos 2 caracteres en longitud\n";
			}
		 else
			{
			$stmt="INSERT INTO vicidial_inbound_groups (group_id,group_name,group_color,active,web_form_address,voicemail_ext,next_agent_call,fronter_display,ingroup_script,get_call_launch) values('$group_id','$group_name','$group_color','$active','" . mysql_real_escape_string($web_form_address) . "','$voicemail_ext','$next_agent_call','$fronter_display','$script_id','$get_call_launch');";
			$rslt=mysql_query($stmt, $link);

			echo "<br><B>GRUPO AÑADIDO: $group_id</B>\n";

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
		{echo "<br>AGENTES ALEJADOS NO AGREGADOS - hay ya una entrada alejada de los agentes comenzando con esta ID del usuario\n";}
	else
		{
		 if ( (strlen($server_ip) < 2) or (strlen($user_start) < 2)  or (strlen($campaign_id) < 2) or (strlen($conf_exten) < 2) )
			{
			 echo "<br>AGENTES ALEJADOS NO AGREGADOS - vaya por favor detrás y mire los datos que usted incorporó\n";
			 echo "<br>El comienzo de la ID del usuario y la extensión externa deben ser por lo menos 2 caracteres en longitud\n";
			 }
		 else
			{
			$stmt="INSERT INTO vicidial_remote_agents values('','$user_start','$number_of_lines','$server_ip','$conf_exten','$status','$campaign_id','$groups_value');";
			$rslt=mysql_query($stmt, $link);

			echo "<br><B>AGENTES REMOTO AÑADIDO: $user_start</B>\n";

			### LOG CHANGES TO LOG FILE ###
			if ($WeBRooTWritablE > 0)
				{
				$fp = fopen ("./admin_changes_log.txt", "a");
				fwrite ($fp, "$date|ADD A NEW AGENTES REMOTOS ENTRY     |$PHP_AUTH_USER|$ip|'$user_start','$number_of_lines','$server_ip','$conf_exten','$status','$campaign_id','$groups_value'|\n");
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
		{echo "<br>GRUPO de USUARIO NO AGREGADO - hay ya una entrada del grupo de usuario con este nombre\n";}
	else
		{
		 if ( (strlen($user_group) < 2) or (strlen($group_name) < 2) )
			{
			 echo "<br>GRUPO de USUARIO NO AGREGADO - vaya por favor detrás y mire los datos que usted incorporó\n";
			 echo "<br>El nombre y la descripción de grupo deben ser por lo menos 2 caracteres en longitud\n";
			 }
		 else
			{
			$stmt="INSERT INTO vicidial_user_groups(user_group,group_name,allowed_campaigns) values('$user_group','$group_name','-ALL-CAMPAIGNS-');";
			$rslt=mysql_query($stmt, $link);

			echo "<br><B>GRUPO DE USUARIO AÑADIDO: $user_group</B>\n";

			### LOG CHANGES TO LOG FILE ###
			if ($WeBRooTWritablE > 0)
				{
				$fp = fopen ("./admin_changes_log.txt", "a");
				fwrite ($fp, "$date|NUEVO USUARIO  GROUP ENTRY     |$PHP_AUTH_USER|$ip|$stmt|\n");
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
		{echo "<br>ESCRITURA NO AGREGADA - hay ya una entrada de la escritura con este nombre\n";}
	else
		{
		 if ( (strlen($script_id) < 2) or (strlen($script_name) < 2) or (strlen($script_text) < 2) )
			{
			 echo "<br>ESCRITURA NO AGREGADA - Vaya por favor detrás y mire los datos que usted incorporó\n";
			 echo "<br>El nombre, la descripción y el texto de la escritura deben ser por lo menos 2 caracteres en longitud\n";
			 }
		 else
			{
			$stmt="INSERT INTO vicidial_scripts values('$script_id','$script_name','$script_comments','$script_text','$active');";
			$rslt=mysql_query($stmt, $link);

			echo "<br><B>ESCRITURA AGREGADA: $script_id</B>\n";

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
		{echo "<br>FILTRO NO AGREGADO - hay ya una entrada del filtro con esta identificación\n";}
	else
		{
		 if ( (strlen($lead_filter_id) < 2) or (strlen($lead_filter_name) < 2) or (strlen($lead_filter_sql) < 2) )
			{
			 echo "<br>FILTRO NO AGREGADO - Vaya por favor detrás y mire los datos que usted incorporó\n";
			 echo "<br>Filtre la identificación, nombre y el SQL debe ser por lo menos 2 caracteres en longitud\n";
			 }
		 else
			{
			$stmt="INSERT INTO vicidial_lead_filters SET lead_filter_id='$lead_filter_id',lead_filter_name='$lead_filter_name',lead_filter_comments='$lead_filter_comments',lead_filter_sql='$lead_filter_sql';";
			$rslt=mysql_query($stmt, $link);

			echo "<br><B>EL FILTRO AGREGÓ: $lead_filter_id</B>\n";

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
		{echo "<br>DEFINICIÓN DEL TIEMPO DE LA LLAMADA NO AGREGADA - hay ya una entrada de tiempo de la llamada con esta identificación\n";}
	else
		{
		 if ( (strlen($call_time_id) < 2) or (strlen($call_time_name) < 2) )
			{
			 echo "<br>DEFINICIÓN DEL TIEMPO DE LA LLAMADA NO AGREGADA - Vaya por favor detrás y mire los datos que usted incorporó\n";
			 echo "<br>La identificación del tiempo de la llamada y el nombre deben ser porlo menos 2 caracteres en longitud\n";
			 }
		 else
			{
			$stmt="INSERT INTO vicidial_call_times SET call_time_id='$call_time_id',call_time_name='$call_time_name',call_time_comments='$call_time_comments';";
			$rslt=mysql_query($stmt, $link);

			echo "<br><B>TIEMPO DE LA LLAMADA AGREGADO: $call_time_id</B>\n";

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
		{echo "<br>DEFINICIÓN DEL TIEMPO DE LA LLAMADA DEL ESTADO NO AGREGADA - hay ya una entrada de tiempo de la llamada con esta identificación\n";}
	else
		{
		 if ( (strlen($call_time_id) < 2) or (strlen($call_time_name) < 2) or (strlen($state_call_time_state) < 2) )
			{
			 echo "<br>DEFINICIÓN DEL TIEMPO DE LA LLAMADA DEL ESTADO NO AGREGADA - Vaya por favor detrás y mire los datos que usted incorporó\n";
			 echo "<br>Indique que identificación del tiempo de la llamada, nombre y estadodebe ser por lo menos 2 caracteres en longitud\n";
			 }
		 else
			{
			$stmt="INSERT INTO vicidial_state_call_times SET state_call_time_id='$call_time_id',state_call_time_name='$call_time_name',state_call_time_comments='$call_time_comments',state_call_time_state='$state_call_time_state';";
			$rslt=mysql_query($stmt, $link);

			echo "<br><B>TIEMPO DE LA LLAMADA DEL ESTADO AGREGADO: $call_time_id</B>\n";

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
		echo "<br>EXPEDIENTE DEL TRONCO DEL SERVIDOR DE VICIDIAL NO AGREGADO - el número de troncos vicidial es demasiado alto: $SUMvicidial_trunks / $MAXvicidial_trunks\n";
		}
	else
		{
		$stmt="SELECT count(*) from vicidial_server_trunks where campaign_id='$campaign_id' and server_ip='$server_ip';";
		$rslt=mysql_query($stmt, $link);
		$row=mysql_fetch_row($rslt);
		if ($row[0] > 0)
			{echo "<br>EXPEDIENTE DEL TRONCO DEL SERVIDOR DE VICIDIAL NO AGREGADO - hay ya un expediente del servidor-tronco para esta campaña\n";}
		else
			{
			 if ( (strlen($campaign_id) < 2) or (strlen($server_ip) < 7) or (strlen($dedicated_trunks) < 1) or (strlen($trunk_restriction) < 1) )
				{
				 echo "<br>EXPEDIENTE DEL TRONCO DEL SERVIDOR DE VICIDIAL NO AGREGADO - Vaya por favor detrás y mire los datos que usted incorporó\n";
				 echo "<br>la campaña debe estar entre 3 y 8 caracteres en longitud\n";
				 echo "<br>el server_ip retrasa debe ser por lo menos 7 caracteres\n";
				 echo "<br>los troncos deben ser un dígito a partir de la 0 a 9999\n";
				}
			 else
				{
				echo "<br><B>EL EXPEDIENTE DEL TRONCO DEL SERVIDOR DE VICIDIAL AGREGÓ: $campaign_id - $server_ip - $dedicated_trunks - $trunk_restriction</B>\n";

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
			{echo "<br>VICIDIAL CONFERENCIA NO AGREGADA - vaya por favor detrás y mire los datos que usted incorporó\n";}
		 else
			{
			echo "<br>VICIDIAL LA CONFERENCIA AGREGÚ\n";

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
		 echo "<br>USUARIO NO MODIFICADO - vaya por favor detrás y mire los datos que usted incorporó\n";
		 echo "<br>La contraseña y el nombre completo cada ot de la necesidad sean por lo menos 2 caracteres en longitud\n";
		}
	 else
		{
		echo "<br><B>USUARIO MODIFICADO - ADMIN: $user</B>\n";

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
	echo "Usted no tiene permiso de visión esta página\n";
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
		 echo "<br>USUARIO NO MODIFICADO - vaya por favor detrás y mire los datos que usted incorporó\n";
		 echo "<br>La contraseña y el nombre completo cada ot de la necesidad sean por lo menos 2 caracteres en longitud\n";
		}
	 else
		{
		echo "<br><B>USUARIO MODIFICADO - ADMIN: $user</B>\n";

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
	echo "Usted no tiene permiso de visión esta página\n";
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
		 echo "<br>USUARIO NO MODIFICADO - vaya por favor detrás y mire los datos que usted incorporó\n";
		 echo "<br>La contraseña y el nombre completo cada ot de la necesidad sean por lo menos 2 caracteres en longitud\n";
		}
	 else
		{
		echo "<br><B>USUARIO MODIFICADO: $user</B>\n";

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
	echo "Usted no tiene permiso de visión esta página\n";
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
		 echo "<br>CAMPAÚA NO MODIFICADA - vaya por favor detrás y mire los datos que usted incorporó\n";
		 echo "<br>el nombre de la campaña necesita ser por lo menos 6 caracteres en longitud\n";
		 echo "<br>|$campaign_name|$active|\n";
		}
	 else
		{
		echo "<br><B>CAMPAÑA MODIFICADA: $campaign_id</B>\n";

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
			echo "<br>REAJUSTE DE LA TOLVA DEL PLOMO DE LA CAMPAÚA\n";
			echo "<br> - Espera 1 minuto antes de marcar el número siguiente\n";
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
	echo "Usted no tiene permiso de visión esta página\n";
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
		 echo "<br>ESTADO de la CAMPAÚA NO MODIFICADO - vaya por favor detrás y mire los datos que usted incorporó\n";
		 echo "<br>la ID de la campaña necesita ser por lo menos 2 caracteres en longitud\n";
		 echo "<br>el estado de la campaña necesita ser por lo menos los caracteres 1 en longitud\n";
		}
	 else
		{
		echo "<br><B>ESTADO DE ENCARGO DE LA CAMPAÚA SUPRIMIDO: $campaign_id - $status</B>\n";

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
	echo "Usted no tiene permiso de visión esta página\n";
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
		 echo "<br>CAMPAÚA HOT KEY NO MODIFICADA - vaya por favor detrás y mire los datos que usted incorporó\n";
		 echo "<br>la ID de la campaña necesita ser por lo menos 2 caracteres en longitud\n";
		 echo "<br>el estado de la campaña necesita ser por lo menos los caracteres 1 en longitud\n";
		 echo "<br>the campaign hotkey needs to be at least 1 characters in length\n";
		}
	 else
		{
		echo "<br><B>LA CAMPAÚA DE ENCARGO HOT KEY SUPRIMIÚ: $campaign_id - $status - $hotkey</B>\n";

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
	echo "Usted no tiene permiso de visión esta página\n";
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
		 echo "<br>CAMPAÚA NO MODIFICADA - vaya por favor detrás y mire los datos que usted incorporó\n";
		 echo "<br>el nombre de la campaña necesita ser por lo menos 6 caracteres en longitud\n";
		}
	 else
		{
		echo "<br><B>CAMPAÑA MODIFICADA: $campaign_id</B>\n";

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
			echo "<br>REAJUSTE DE LA TOLVA DEL PLOMO DE LA CAMPAÚA\n";
			echo "<br> - Espera 1 minuto antes de marcar el número siguiente\n";
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
	echo "Usted no tiene permiso de visión esta página\n";
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
		 echo "<br>CAMPAIGN LEAD RECYCLE NOT MODIFIED - Vaya por favor detrás y mire los datos que usted incorporó\n";
		 echo "<br>el estado debe estar entre 1 y 6 caracteres en longitud\n";
		 echo "<br>la tentativa retrasa debe ser por lo menos 120 segundos\n";
		 echo "<br>las tentativas máximas deben ser a partir la 1 a 10\n";
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
	echo "Usted no tiene permiso de visión esta página\n";
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
		 echo "<br>CÓDIGO DE LA PAUSA DEL AGENTE NO MODIFICADO - Vaya por favor detrás y mire los datos que usted incorporó\n";
		 echo "<br>pause_code must be between 1 and 6 characters in length\n";
		 echo "<br>pause_code name must be between 2 and 30 characters in length\n";
		}
	 else
		{
		echo "<br><B>AGENTE PAUSE CODE MODIFIED: $campaign_id - $pause_code - $pause_code_name</B>\n";

		$stmt="UPDATE vicidial_pause_codes SET pause_code_name='$pause_code_name',billable='$billable' where campaign_id='$campaign_id' and pause_code='$pause_code';";
		$rslt=mysql_query($stmt, $link);

		### LOG CHANGES TO LOG FILE ###
		if ($WeBRooTWritablE > 0)
			{
			$fp = fopen ("./admin_changes_log.txt", "a");
			fwrite ($fp, "$date|MODIFY AGENTE PAUSECODE|$PHP_AUTH_USER|$ip|$stmt|\n");
			fclose($fp);
			}
		}
	}
	else
	{
	echo "Usted no tiene permiso de visión esta página\n";
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
		 echo "<br>LISTA NO MODIFICADA - vaya por favor detrás y mire los datos que usted incorporó\n";
		 echo "<br>el nombre de la lista debe ser por lo menos 2 caracteres en longitud\n";
		}
	 else
		{
		echo "<br><B>LISTA MODIFICADA: $list_id</B>\n";

		$stmt="UPDATE vicidial_lists set list_name='$list_name',campaign_id='$campaign_id',active='$active',list_description='$list_description',list_changedate='$SQLdate' where list_id='$list_id';";
		$rslt=mysql_query($stmt, $link);

		if ($reset_list == 'Y')
			{
			echo "<br>REAJUSTANDO LA LISTA - LLAMADA - ESTADO\n";
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
			echo "<br>QUITAR LOS PLOMOS DE LA TOLVA DE LA LISTA DE VIEJA TOLVA DE LA CAMPAÚA ($old_campaign_id)\n";
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
	echo "Usted no tiene permiso de visión esta página\n";
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
		 echo "<br>GRUPO NO MODIFICADO - vaya por favor detrás y mire los datos que usted incorporó\n";
		 echo "<br>el color del nombre de grupo y del grupo debe ser por lo menos 2 caracteres en longitud\n";
		}
	 else
		{
		echo "<br><B>GRUPO MODIFICADO: $group_id</B>\n";

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
	echo "Usted no tiene permiso de visión esta página\n";
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
		 echo "<br>AGENTES ALEJADOS NO MODIFICADOS - vaya por favor detrás y mire los datos que usted incorporó\n";
		 echo "<br>El comienzo de la ID del usuario y la extensión externa deben ser por lo menos 2 caracteres en longitud\n";
		}
	 else
		{
		$stmt="UPDATE vicidial_remote_agents set user_start='$user_start', number_of_lines='$number_of_lines', server_ip='$server_ip', conf_exten='$conf_exten', status='$status', campaign_id='$campaign_id', closer_campaigns='$groups_value' where remote_agent_id='$remote_agent_id';";
		$rslt=mysql_query($stmt, $link);

		echo "<br><B>LOS AGENTES ALEJADOS SE MODIFICARON</B>\n";

		### LOG CHANGES TO LOG FILE ###
		if ($WeBRooTWritablE > 0)
			{
			$fp = fopen ("./admin_changes_log.txt", "a");
			fwrite ($fp, "$date|MODIFY AGENTES REMOTOS ENTRY     |$PHP_AUTH_USER|$ip|set user_start='$user_start', number_of_lines='$number_of_lines', server_ip='$server_ip', conf_exten='$conf_exten', status='$status', campaign_id='$campaign_id', closer_campaigns='$groups_value' where remote_agent_id='$remote_agent_id'|\n");
			fclose($fp);
			}
		}
	}
	else
	{
	echo "Usted no tiene permiso de visión esta página\n";
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
		 echo "<br>GRUPO de USUARIO NO MODIFICADO - vaya por favor detrás y mire los datos que usted incorporó\n";
		 echo "<br>El nombre y la descripción de grupo deben ser por lo menos 2 caracteres en longitud\n";
		}
	 else
		{
		$stmt="UPDATE vicidial_user_groups set user_group='$user_group', group_name='$group_name',allowed_campaigns='$campaigns_value' where user_group='$OLDuser_group';";
		$rslt=mysql_query($stmt, $link);

		echo "<br><B>GRUPO DE USUARIO MODIFICADO</B>\n";

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
	echo "Usted no tiene permiso de visión esta página\n";
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
		 echo "<br>ESCRITURA NO MODIFICADA - Vaya por favor detrás y mire los datos que usted incorporó\n";
		 echo "<br>El nombre, la descripción y el texto de la escritura deben ser por lo menos 2 caracteres en longitud\n";
		}
	 else
		{
		$stmt="UPDATE vicidial_scripts set script_name='$script_name', script_comments='$script_comments', script_text='$script_text', active='$active' where script_id='$script_id';";
		$rslt=mysql_query($stmt, $link);

		echo "<br><B>LA ESCRITURA SE MODIFICÓ</B>\n";

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
	echo "Usted no tiene permiso de visión esta página\n";
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
		 echo "<br>FILTRO NO MODIFICADO - Vaya por favor detrás y mire los datos que usted incorporó\n";
		 echo "<br>Filtre la identificación, nombre y el SQL debe ser por lo menos 2 caracteres en longitud\n";
		}
	 else
		{
		$stmt="UPDATE vicidial_lead_filters set lead_filter_name='$lead_filter_name', lead_filter_comments='$lead_filter_comments', lead_filter_sql='$lead_filter_sql' where lead_filter_id='$lead_filter_id';";
		$rslt=mysql_query($stmt, $link);

		echo "<br><B>FILTRO MODIFICADO</B>\n";

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
	echo "Usted no tiene permiso de visión esta página\n";
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
		 echo "<br>TIEMPO DE LA LLAMADA NO MODIFICADO - Vaya por favor detrás y mire los datos que usted incorporó\n";
		 echo "<br>La identificación del tiempo de la llamada y el nombre deben ser porlo menos 2 caracteres en longitud\n";
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

		echo "<br><B>TIEMPO DE LA LLAMADA MODIFICADO</B>\n";

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
	echo "Usted no tiene permiso de visión esta página\n";
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
		 echo "<br>TIEMPO DE LA LLAMADA DEL ESTADO NO MODIFICADO - Vaya por favor detrás y mire los datos que usted incorporó\n";
		 echo "<br>Indique que identificación del tiempo de la llamada, nombre y estadodebe ser por lo menos 2 caracteres en longitud\n";
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

		echo "<br><B>TIEMPO DE LA LLAMADA DEL ESTADO MODIFICADO</B>\n";

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
	echo "Usted no tiene permiso de visión esta página\n";
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
		{echo "<br>TELÉFONO NO MODIFICADO - hay ya un teléfono en el sistema con esta extensión/servidor\n";}
	else
		{
			 if ( (strlen($extension) < 1) or (strlen($server_ip) < 7) or (strlen($dialplan_number) < 1) or (strlen($voicemail_id) < 1) or (strlen($login) < 1)  or (strlen($pass) < 1))
			{echo "<br>TELÉFONO NO MODIFICADO - vaya por favor detrás y mire los datos que usted incorporó\n";}
		 else
			{
			echo "<br>TELÉFONO MODIFICADO: $extension\n";

			$stmt="UPDATE phones set extension='$extension', dialplan_number='$dialplan_number', voicemail_id='$voicemail_id', phone_ip='$phone_ip', computer_ip='$computer_ip', server_ip='$server_ip', login='$login', pass='$pass', status='$status', active='$active', phone_type='$phone_type', fullname='$fullname', company='$company', picture='$picture', protocol='$protocol', local_gmt='$local_gmt', ASTmgrUSERNAME='$ASTmgrUSERNAME', ASTmgrSECRET='$ASTmgrSECRET', login_user='$login_user', login_pass='$login_pass', login_campaign='$login_campaign', park_on_extension='$park_on_extension', conf_on_extension='$conf_on_extension', VICIDIAL_park_on_extension='$VICIDIAL_park_on_extension', VICIDIAL_park_on_filename='$VICIDIAL_park_on_filename', monitor_prefix='$monitor_prefix', recording_exten='$recording_exten', voicemail_exten='$voicemail_exten', voicemail_dump_exten='$voicemail_dump_exten', ext_context='$ext_context', dtmf_send_extension='$dtmf_send_extension', call_out_number_group='$call_out_number_group', client_browser='$client_browser', install_directory='$install_directory', local_web_callerID_URL='" . mysql_real_escape_string($local_web_callerID_URL) . "', VICIDIAL_web_URL='" . mysql_real_escape_string($VICIDIAL_web_URL) . "', AGI_call_logging_enabled='$AGI_call_logging_enabled', user_switching_enabled='$user_switching_enabled', conferencing_enabled='$conferencing_enabled', admin_hangup_enabled='$admin_hangup_enabled', admin_hijack_enabled='$admin_hijack_enabled', admin_monitor_enabled='$admin_monitor_enabled', call_parking_enabled='$call_parking_enabled', updater_check_enabled='$updater_check_enabled', AFLogging_enabled='$AFLogging_enabled', QUEUE_ACTION_enabled='$QUEUE_ACTION_enabled', CallerID_popup_enabled='$CallerID_popup_enabled', voicemail_button_enabled='$voicemail_button_enabled', enable_fast_refresh='$enable_fast_refresh', fast_refresh_rate='$fast_refresh_rate', enable_persistant_mysql='$enable_persistant_mysql', auto_dial_next_number='$auto_dial_next_number', VDstop_rec_after_each_call='$VDstop_rec_after_each_call', DBX_server='$DBX_server', DBX_database='$DBX_database', DBX_user='$DBX_user', DBX_pass='$DBX_pass', DBX_port='$DBX_port', DBY_server='$DBY_server', DBY_database='$DBY_database', DBY_user='$DBY_user', DBY_pass='$DBY_pass', DBY_port='$DBY_port', outbound_cid='$outbound_cid', enable_sipsak_messages='$enable_sipsak_messages' where extension='$old_extension' and server_ip='$old_server_ip';";
			$rslt=mysql_query($stmt, $link);
			}
		}
	}
	else
	{
	echo "Usted no tiene permiso de visión esta página\n";
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

				$stmt="UPDATE servers set server_id='$server_id',server_description='$server_description',server_ip='$server_ip',active='$active',asterisk_version='$asterisk_version', max_vicidial_trunks='$max_vicidial_trunks', telnet_host='$telnet_host', telnet_port='$telnet_port', ASTmgrUSERNAME='$ASTmgrUSERNAME', ASTmgrSECRET='$ASTmgrSECRET', ASTmgrUSERNAMEupdate='$ASTmgrUSERNAMEupdate', ASTmgrUSERNAMElisten='$ASTmgrUSERNAMElisten', ASTmgrUSERNAMEsend='$ASTmgrUSERNAMEsend', local_gmt='$local_gmt', voicemail_dump_exten='$voicemail_dump_exten', answer_transfer_agent='$answer_transfer_agent', ext_context='$ext_context', sys_perf_log='$sys_perf_log', vd_server_logs='$vd_server_logs', agi_output='$agi_output', vicidial_balance_active='$vicidial_balance_active', balance_trunks_offlimits='$balance_trunks_offlimits' where server_id='$old_server_id';";
				$rslt=mysql_query($stmt, $link);
				}
			}
		}
	}
	else
	{
	echo "Usted no tiene permiso de visión esta página\n";
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
		echo "<br>EXPEDIENTE DEL TRONCO DEL SERVIDOR DE VICIDIAL NO AGREGADO - el número de troncos vicidial es demasiado alto: $SUMvicidial_trunks / $MAXvicidial_trunks\n";
		}
	else
		{
		 if ( (strlen($campaign_id) < 2) or (strlen($server_ip) < 7) or (strlen($dedicated_trunks) < 1) or (strlen($trunk_restriction) < 1) )
			{
			 echo "<br>EXPEDIENTE DEL TRONCO DEL SERVIDOR DE VICIDIAL NO MODIFICADO - Vaya por favor detrás y mire los datos que usted incorporó\n";
			 echo "<br>la campaña debe estar entre 3 y 8 caracteres en longitud\n";
			 echo "<br>el server_ip retrasa debe ser por lo menos 7 caracteres\n";
			 echo "<br>los troncos deben ser un dígito a partir de la 0 a 9999\n";
			}
		 else
			{
			echo "<br><B>EXPEDIENTE DEL TRONCO DEL SERVIDOR DE VICIDIAL MODIFICADO: $campaign_id - $server_ip - $dedicated_trunks - $trunk_restriction</B>\n";

			$stmt="UPDATE vicidial_server_trunks SET dedicated_trunks='$dedicated_trunks',trunk_restriction='$trunk_restriction' where campaign_id='$campaign_id' and server_ip='$server_ip';";
			$rslt=mysql_query($stmt, $link);

			### LOG CHANGES TO LOG FILE ###
			if ($WeBRooTWritablE > 0)
				{
				$fp = fopen ("./admin_changes_log.txt", "a");
				fwrite ($fp, "$date|MODIFICAR EL SERVIDOR TRUNK   |$PHP_AUTH_USER|$ip|$stmt|\n");
				fclose($fp);
				}
			}
		}
	}
	else
	{
	echo "Usted no tiene permiso de visión esta página\n";
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
	}
	else
	{
	echo "Usted no tiene permiso de visión esta página\n";
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
		{echo "<br>VICIDIAL CONFERENCIA - hay ya una conferencia en el sistema con esta extensión - servidor NO MODIFICADO\n";}
	else
		{
		 if ( (strlen($conf_exten) < 1) or (strlen($server_ip) < 7) )
			{echo "<br>VICIDIAL CONFERENCIA NO MODIFICADA - vaya por favor detrás y mire los datos que usted incorporó\n";}
		 else
			{
			echo "<br>VICIDIAL CONFERENCIA MODIFICADA: $conf_exten\n";

			$stmt="UPDATE vicidial_conferences set conf_exten='$conf_exten',server_ip='$server_ip',extension='$extension' where conf_exten='$old_conf_exten';";
			$rslt=mysql_query($stmt, $link);

			}
		}
	}
	else
	{
	echo "Usted no tiene permiso de visión esta página\n";
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

	echo "<br>AJUSTES DEL SISTEMA DE VICIDIAL MODIFICADOS\n";

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
	echo "Usted no tiene permiso de visión esta página\n";
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
		 echo "<br>USUARIO NO SUPRIMIDO - Vaya por favor detrás y mire los datos que usted incorporó\n";
		 echo "<br>User be at least 2 characters in length\n";
		}
	 else
		{
		echo "<br><B>CONFIRMACIÓN DE LA CANCELADURA DEL USUARIO: $user</B>\n";
		echo "<br><br><a href=\"$PHP_SELF?ADD=6&user=$user&CoNfIrM=YES\">Chasque aquí para suprimir a usuario $user</a><br><br><br>\n";
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
		 echo "<br>CAMPAÑA NO SUPRIMIDA - Vaya por favor detrás y mire los datos que usted incorporó\n";
		 echo "<br>Campaña_id be at least 2 characters in length\n";
		}
	 else
		{
		echo "<br><B>CONFIRMACIÓN DE LA CANCELADURA DE LA CAMPAÑA: $campaign_id</B>\n";
		echo "<br><br><a href=\"$PHP_SELF?ADD=61&campaign_id=$campaign_id&CoNfIrM=YES\">Chasque aquí para suprimir campaña $campaign_id</a><br><br><br>\n";
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
		 echo "<br>AGENTES NO REGISTRADOS FUERA DE CAMPAÑA - Vaya por favor detrás y mire los datos que usted incorporó\n";
		 echo "<br>Campaña_id be at least 2 characters in length\n";
		}
	 else
		{
		echo "<br><B>CONFIRMACIÓN DEL REGISTRO DE ESTADO DE LA MÁQUINA DEL AGENTE: $campaign_id</B>\n";
		echo "<br><br><a href=\"$PHP_SELF?ADD=62&campaign_id=$campaign_id&CoNfIrM=YES\">Chasque aquí para registrar todos los agentes fuera de $campaign_id</a><br><br><br>\n";
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
		 echo "<br>VDAC NO DESPEJÓ PARA LA CAMPAÑA - Vaya por favor detrás y mire los datos que usted incorporó\n";
		 echo "<br>Campaña_id be at least 2 characters in length\n";
		}
	 else
		{
		echo "<br><B>CONFIRMACIÓN CLARA DE VDAC: $campaign_id</B>\n";
		echo "<br><br><a href=\"$PHP_SELF?ADD=63&campaign_id=$campaign_id&CoNfIrM=YES&&stage=$stage\">Chasque aquí para suprimir el más viejo VIVEN expediente en VDACpara $campaign_id</a><br><br><br>\n";
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
		 echo "<br>LISTA NO SUPRIMIDA - Vaya por favor detrás y mire los datos que usted incorporó\n";
		 echo "<br>List_id be at least 2 characters in length\n";
		}
	 else
		{
		echo "<br><B>CONFIRMACIÓN DE LA CANCELADURA DE LA LISTA: $list_id</B>\n";
		echo "<br><br><a href=\"$PHP_SELF?ADD=611&list_id=$list_id&CoNfIrM=YES\">Chasque aquí para suprimir la lista y todos sus plomos $list_id</a><br><br><br>\n";
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
		 echo "<br>EN-GRUPO NO SUPRIMIDO - Vaya por favor detrás y mire los datos que usted incorporó\n";
		 echo "<br>Group_id be at least 2 characters in length\n";
		}
	 else
		{
		echo "<br><B>CONFIRMACIÓN DE LA CANCELADURA DE EN-GRUPO: $group_id</B>\n";
		echo "<br><br><a href=\"$PHP_SELF?ADD=6111&group_id=$group_id&CoNfIrM=YES\">Chasque aquí para suprimir a en-grupo $group_id</a><br><br><br>\n";
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
		 echo "<br>AGENTE ALEJADO NO SUPRIMIDO - Vaya por favor detrás y mire los datos que usted incorporó\n";
		 echo "<br>Remote_agent_id be at least 2 characters in length\n";
		}
	 else
		{
		echo "<br><B>CONFIRMACIÓN ALEJADA DE LA CANCELADURA DEL AGENTE: $remote_agent_id</B>\n";
		echo "<br><br><a href=\"$PHP_SELF?ADD=61111&remote_agent_id=$remote_agent_id&CoNfIrM=YES\">Chasque aquí para suprimir el agente alejado $remote_agent_id</a><br><br><br>\n";
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
		 echo "<br>GRUPO DE USUARIO NO SUPRIMIDO - Vaya por favor detrás y mire los datos que usted incorporó\n";
		 echo "<br>User_group be at least 2 characters in length\n";
		}
	 else
		{
		echo "<br><B>CONFIRMACIÓN DE LA CANCELADURA DEL GRUPO DE USUARIO: $user_group</B>\n";
		echo "<br><br><a href=\"$PHP_SELF?ADD=611111&user_group=$user_group&CoNfIrM=YES\">Chasque aquí para suprimir a grupo de usuario $user_group</a><br><br><br>\n";
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
		 echo "<br>ESCRITURA NO SUPRIMIDA - Vaya por favor detrás y mire los datos que usted incorporó\n";
		 echo "<br>Script_id must be at least 2 characters in length\n";
		}
	 else
		{
		echo "<br><B>CONFIRMACIÓN DE LA CANCELADURA DE LA ESCRITURA: $script_id</B>\n";
		echo "<br><br><a href=\"$PHP_SELF?ADD=6111111&script_id=$script_id&CoNfIrM=YES\">Chasque aquí para suprimir la escritura $script_id</a><br><br><br>\n";
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
		 echo "<br>FILTRO NO SUPRIMIDO - Vaya por favor detrás y mire los datos que usted incorporó\n";
		 echo "<br>La identificación del filtro debe ser por lo menos 2 caracteres en longitud\n";
		}
	 else
		{
		echo "<br><B>FILTER DELETION CONFIRMATION: $lead_filter_id</B>\n";
		echo "<br><br><a href=\"$PHP_SELF?ADD=61111111&lead_filter_id=$lead_filter_id&CoNfIrM=YES\">Chasque aquí para suprimir el filtro$lead_filter_id</a><br><br><br>\n";
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
		 echo "<br>TIEMPO DE LA LLAMADA NO SUPRIMIDO - Vaya por favor detrás y mire los datos que usted incorporó\n";
		 echo "<br>_ llamar tiempo identificación deber ser por lo menos 2 carácter enlongitud\n";
		}
	 else
		{
		echo "<br><B>CONFIRMACIÓN DE LA CANCELADURA DEL TIEMPO DE LA LLAMADA: $call_time_id</B>\n";
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
		 echo "<br>TIEMPO DE LA LLAMADA DEL ESTADO NO SUPRIMIDO - Vaya por favor detrás y mire los datos que usted incorporó\n";
		 echo "<br>_ llamar tiempo identificación deber ser por lo menos 2 carácter enlongitud\n";
		}
	 else
		{
		echo "<br><B>CONFIRMACIÓN DE LA CANCELADURA DEL TIEMPO DE LA LLAMADA DEL ESTADO: $call_time_id</B>\n";
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
		 echo "<br>TELÉFONO NO SUPRIMIDO - Vaya por favor detrás y mire los datos que usted incorporó\n";
		 echo "<br>Extension be at least 2 characters in length\n";
		 echo "<br>IP Del Servidor be at least 7 characters in length\n";
		}
	 else
		{
		echo "<br><B>CONFIRMACIÓN DE LA CANCELADURA DEL TELÉFONO: $extension - $server_ip</B>\n";
		echo "<br><br><a href=\"$PHP_SELF?ADD=61111111111&extension=$extension&server_ip=$server_ip&CoNfIrM=YES\">Chasque aquí para suprimir el teléfono $extension - $server_ip</a><br><br><br>\n";
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
		 echo "<br>SERVIDOR NOT DELETED - Vaya por favor detrás y mire los datos que usted incorporó\n";
		 echo "<br>ID Del Servidor be at least 2 characters in length\n";
		 echo "<br>IP Del Servidor be at least 7 characters in length\n";
		}
	 else
		{
		echo "<br><B>SERVIDOR DELETION CONFIRMATION: $server_id - $server_ip</B>\n";
		echo "<br><br><a href=\"$PHP_SELF?ADD=611111111111&server_id=$server_id&server_ip=$server_ip&CoNfIrM=YES\">Chasque aquí para suprimir el teléfono $server_id - $server_ip</a><br><br><br>\n";
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
		 echo "<br>CONFERENCE NOT DELETED - Vaya por favor detrás y mire los datos que usted incorporó\n";
		 echo "<br>Conference must be at least 2 characters in length\n";
		 echo "<br>IP Del Servidor be at least 7 characters in length\n";
		}
	 else
		{
		echo "<br><B>CONFERENCE DELETION CONFIRMATION: $conf_exten - $server_ip</B>\n";
		echo "<br><br><a href=\"$PHP_SELF?ADD=6111111111111&conf_exten=$conf_exten&server_ip=$server_ip&CoNfIrM=YES\">Chasque aquí para suprimir el teléfono $conf_exten - $server_ip</a><br><br><br>\n";
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
		 echo "<br>VICIDIAL CONFERENCE NOT DELETED - Vaya por favor detrás y mire los datos que usted incorporó\n";
		 echo "<br>Conference must be at least 2 characters in length\n";
		 echo "<br>IP Del Servidor be at least 7 characters in length\n";
		}
	 else
		{
		echo "<br><B>VICIDIAL CONFERENCE DELETION CONFIRMATION: $conf_exten - $server_ip</B>\n";
		echo "<br><br><a href=\"$PHP_SELF?ADD=61111111111111&conf_exten=$conf_exten&server_ip=$server_ip&CoNfIrM=YES\">Chasque aquí para suprimir el teléfono $conf_exten - $server_ip</a><br><br><br>\n";
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
		 echo "<br>USUARIO NO SUPRIMIDO - Vaya por favor detrás y mire los datos que usted incorporó\n";
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
		echo "<br><B>CANCELADURA DEL USUARIO TERMINADA: $user</B>\n";
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
		 echo "<br>CAMPAÑA NO SUPRIMIDA - Vaya por favor detrás y mire los datos que usted incorporó\n";
		 echo "<br>Campaña_id be at least 2 characters in length\n";
		}
	 else
		{
		$stmt="DELETE from vicidial_campaigns where campaign_id='$campaign_id' limit 1;";
		$rslt=mysql_query($stmt, $link);

		echo "<br>QUITAR LOS PLOMOS DE LA TOLVA DE LA LISTA DE VIEJA TOLVA DE LA CAMPAÚA ($campaign_id)\n";
		$stmt="DELETE from vicidial_hopper where campaign_id='$campaign_id';";
		$rslt=mysql_query($stmt, $link);

		### LOG CHANGES TO LOG FILE ###
		if ($WeBRooTWritablE > 0)
			{
			$fp = fopen ("./admin_changes_log.txt", "a");
			fwrite ($fp, "$date|!!DELETING CAMPAIGN!|$PHP_AUTH_USER|$ip|campaign_id='$campaign_id'|\n");
			fclose($fp);
			}
		echo "<br><B>LA CANCELADURA DE LA CAMPAÑA TERMINÓ: $campaign_id</B>\n";
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
		 echo "<br>AGENTES NO REGISTRADOS FUERA DE CAMPAÑA - Vaya por favor detrás y mire los datos que usted incorporó\n";
		 echo "<br>Campaña_id be at least 2 characters in length\n";
		}
	 else
		{
		$stmt="DELETE from vicidial_live_agents where campaign_id='$campaign_id';";
		$rslt=mysql_query($stmt, $link);

		### LOG CHANGES TO LOG FILE ###
		if ($WeBRooTWritablE > 0)
			{
			$fp = fopen ("./admin_changes_log.txt", "a");
			fwrite ($fp, "$date|!!AGENTE LOGOUT!!!!!!|$PHP_AUTH_USER|$ip|campaign_id='$campaign_id'|\n");
			fclose($fp);
			}
		echo "<br><B>EL REGISTRO DE ESTADO DE LA MÁQUINA DEL AGENTE TERMINÓ: $campaign_id</B>\n";
		echo "<br><br>\n";
		}
	}
	else
	{
	echo "Usted no tiene permiso de visión esta página\n";
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
		 echo "<br>VDAC NO DESPEJÓ PARA LA CAMPAÑA - Vaya por favor detrás y mire los datos que usted incorporó\n";
		 echo "<br>Campaña_id be at least 2 characters in length\n";
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
		echo "<br><B>DE REGISTRO PASADO DE VDAC DESPEJADA PARA LA CAMPAÑA: $campaign_id</B>\n";
		echo "<br><br>\n";
		}
	}
	else
	{
	echo "Usted no tiene permiso de visión esta página\n";
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
		 echo "<br>EL PLOMO DE LA CAMPAÑA RECICLA NO SUPRIMIDO - Vaya por favor detrás y mire los datos que usted incorporó\n";
		 echo "<br>el estado debe estar entre 1 y 6 caracteres en longitud\n";
		 echo "<br>la tentativa retrasa debe ser por lo menos 120 segundos\n";
		 echo "<br>las tentativas máximas deben ser a partir la 1 a 10\n";
		}
	 else
		{
		echo "<br><B>EL PLOMO DE LA CAMPAÑA RECICLA SUPRIMIDO: $campaign_id - $status - $attempt_delay</B>\n";

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
	echo "Usted no tiene permiso de visión esta página\n";
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
		{echo "<br>ESTADO AUTO DEL DIAL DEL ALT NO SUPRIMIDO - este estado del dial del alt del automóvil no está en esta campaña\n";}
	else
		{
		 if ( (strlen($campaign_id) < 2) or (strlen($status) < 1) )
			{
			 echo "<br>ESTADO AUTO DEL DIAL DEL ALT NO SUPRIMIDO - Vaya por favor detrás y mire los datos que usted incorporó\n";
			 echo "<br>el estado debe estar entre 1 y 6 caracteres en longitud\n";
			}
		 else
			{
			echo "<br><B>ESTADO AUTO DEL DIAL DEL ALT SUPRIMIDO: $campaign_id - $status</B>\n";

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
	echo "Usted no tiene permiso de visión esta página\n";
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
		 echo "<br>CÓDIGO DE LA PAUSA DE LA CAMPAÑA NO SUPRIMIDO - Vaya por favor detrás y mire los datos que usted incorporó\n";
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
			fwrite ($fp, "$date|DELETE AGENTE PAUSECODE|$PHP_AUTH_USER|$ip|$stmt|\n");
			fclose($fp);
			}
		}
	}
	else
	{
	echo "Usted no tiene permiso de visión esta página\n";
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
		{echo "<br>ESTADO DEL DIAL DE LA CAMPAÑA NO QUITADO - este estado del dial no se selecciona para esta campaña\n";}
	else
		{
		 if ( (strlen($campaign_id) < 2) or (strlen($status) < 1) )
			{
			 echo "<br>ESTADO DEL DIAL DE LA CAMPAÑA NO QUITADO - Vaya por favor detrás y mire los datos que usted incorporó\n";
			 echo "<br>el estado debe estar entre 1 y 6 caracteres en longitud\n";
			}
		 else
			{
			echo "<br><B>EL ESTADO DEL DIAL DE LA CAMPAÑA QUITÓ: $campaign_id - $status</B>\n";

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
	echo "Usted no tiene permiso de visión esta página\n";
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
		 echo "<br>LISTA NO SUPRIMIDA - Vaya por favor detrás y mire los datos que usted incorporó\n";
		 echo "<br>List_id be at least 2 characters in length\n";
		}
	 else
		{
		$stmt="DELETE from vicidial_lists where list_id='$list_id' limit 1;";
		$rslt=mysql_query($stmt, $link);

		echo "<br>QUITAR LOS PLOMOS DE LA TOLVA DE LA LISTA DE VIEJA TOLVA DE LA CAMPAÚA ($list_id)\n";
		$stmt="DELETE from vicidial_hopper where list_id='$list_id';";
		$rslt=mysql_query($stmt, $link);

		echo "<br>QUITAR LOS PLOMOS DE LA LISTA DE LA TABLA DE VICIDIAL_LIST\n";
		$stmt="DELETE from vicidial_list where list_id='$list_id';";
		$rslt=mysql_query($stmt, $link);

		### LOG CHANGES TO LOG FILE ###
		if ($WeBRooTWritablE > 0)
			{
			$fp = fopen ("./admin_changes_log.txt", "a");
			fwrite ($fp, "$date|!!!DELETING LIST!!!!|$PHP_AUTH_USER|$ip|list_id='$list_id'|\n");
			fclose($fp);
			}
		echo "<br><B>LA CANCELADURA DE LA LISTA TERMINÓ: $list_id</B>\n";
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
		 echo "<br>EN-GRUPO NO SUPRIMIDO - Vaya por favor detrás y mire los datos que usted incorporó\n";
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
		echo "<br><B>CANCELADURA DE EN-GRUPO TERMINADA: $group_id</B>\n";
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
		 echo "<br>AGENTE ALEJADO NO SUPRIMIDO - Vaya por favor detrás y mire los datos que usted incorporó\n";
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
		echo "<br><B>CANCELADURA ALEJADA DEL AGENTE TERMINADA: $remote_agent_id</B>\n";
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
		 echo "<br>GRUPO DE USUARIO NO SUPRIMIDO - Vaya por favor detrás y mire los datos que usted incorporó\n";
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
		echo "<br><B>CANCELADURA DEL GRUPO DE USUARIO TERMINADA: $user_group</B>\n";
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
		 echo "<br>ESCRITURA NO SUPRIMIDA - Vaya por favor detrás y mire los datos que usted incorporó\n";
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
		echo "<br><B>CANCELADURA DE LA ESCRITURA TERMINADA: $script_id</B>\n";
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
		 echo "<br>FILTRO NO SUPRIMIDO - Vaya por favor detrás y mire los datos que usted incorporó\n";
		 echo "<br>La identificación del filtro debe ser por lo menos 2 caracteres en longitud\n";
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
		echo "<br><B>CANCELADURA DEL FILTRO TERMINADA: $lead_filter_id</B>\n";
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
		 echo "<br>TIEMPO DE LA LLAMADA NO SUPRIMIDO - Vaya por favor detrás y mire los datos que usted incorporó\n";
		 echo "<br>_ llamar tiempo identificación deber ser por lo menos 2 carácter enlongitud\n";
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
		echo "<br><B>_ LLAMAR TIEMPO CANCELADURA TERMINAR: $call_time_id</B>\n";
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
		 echo "<br>TIEMPO DE LA LLAMADA DEL ESTADO NO SUPRIMIDO - Vaya por favor detrás y mire los datos que usted incorporó\n";
		 echo "<br>_ llamar tiempo identificación deber ser por lo menos 2 carácter enlongitud\n";
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
			echo "Regla Del Estado Quitada: $sct_ids[$o]<BR>\n";
			$o++;
		}

		### LOG CHANGES TO LOG FILE ###
		if ($WeBRooTWritablE > 0)
			{
			$fp = fopen ("./admin_changes_log.txt", "a");
			fwrite ($fp, "$date|!DELETING CALL TIME!|$PHP_AUTH_USER|$ip|state_call_time_id='$call_time_id'|\n");
			fclose($fp);
			}
		echo "<br><B>CANCELADURA DEL TIEMPO DE LA LLAMADA DEL ESTADO TERMINADA: $call_time_id</B>\n";
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
		 echo "<br>SERVIDOR NOT DELETED - Vaya por favor detrás y mire los datos que usted incorporó\n";
		 echo "<br>ID Del Servidor be at least 2 characters in length\n";
		 echo "<br>IP Del Servidor be at least 7 characters in length\n";
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
		echo "<br><B>SERVIDOR DELETION COMPLETED: $server_id - $server_ip</B>\n";
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
		 echo "<br>EXPEDIENTE DEL TRONCO DEL SERVIDOR DE VICIDIAL NO SUPRIMIDO - Vaya por favor detrás y mire los datos que usted incorporó\n";
		 echo "<br>la campaña debe estar entre 3 y 8 caracteres en longitud\n";
		 echo "<br>el server_ip retrasa debe ser por lo menos 7 caracteres\n";
		}
	 else
		{
		echo "<br><B>EXPEDIENTE DEL TRONCO DEL SERVIDOR DE VICIDIAL SUPRIMIDO: $campaign_id - $server_ip</B>\n";

		$stmt="DELETE FROM vicidial_server_trunks where campaign_id='$campaign_id' and server_ip='$server_ip';";
		$rslt=mysql_query($stmt, $link);

		### LOG CHANGES TO LOG FILE ###
		if ($WeBRooTWritablE > 0)
			{
			$fp = fopen ("./admin_changes_log.txt", "a");
			fwrite ($fp, "$date|DELETE SERVIDOR TRUNK   |$PHP_AUTH_USER|$ip|$stmt|\n");
			fclose($fp);
			}
		}
	}
	else
	{
	echo "Usted no tiene permiso de visión esta página\n";
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
		 echo "<br>CONFERENCE NOT DELETED - Vaya por favor detrás y mire los datos que usted incorporó\n";
		 echo "<br>Conference be at least 2 characters in length\n";
		 echo "<br>IP Del Servidor be at least 7 characters in length\n";
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
		 echo "<br>VICIDIAL CONFERENCE NOT DELETED - Vaya por favor detrás y mire los datos que usted incorporó\n";
		 echo "<br>Conference be at least 2 characters in length\n";
		 echo "<br>IP Del Servidor be at least 7 characters in length\n";
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
		echo "<br>Usted no tiene permisos de modificar a este usuario: $row[1]\n";
		}
	else
		{
		echo "<br>MODIFIQUE Un EXPEDIENTE De los USUARIOS: $row[1]<form action=$PHP_SELF method=POST>\n";
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
		echo "<tr bgcolor=#B6D3FC><td align=right>NÚmero De Usuario: </td><td align=left><b>$row[1]</b>$NWB#vicidial_users-user$NWE</td></tr>\n";
		echo "<tr bgcolor=#B6D3FC><td align=right>Contraseña: </td><td align=left><input type=text name=pass size=20 maxlength=10 value=\"$row[2]\">$NWB#vicidial_users-pass$NWE</td></tr>\n";
		echo "<tr bgcolor=#B6D3FC><td align=right>Nombre Completo: </td><td align=left><input type=text name=full_name size=30 maxlength=30 value=\"$row[3]\">$NWB#vicidial_users-full_name$NWE</td></tr>\n";
		echo "<tr bgcolor=#B6D3FC><td align=right>Nivel Del Usuario: </td><td align=left><select size=1 name=user_level>";
		$h=1;
		while ($h<=$LOGuser_level)
			{
			echo "<option>$h</option>";
			$h++;
			}
		echo "<option SELECTED>$row[4]</option></select>$NWB#vicidial_users-user_level$NWE</td></tr>\n";
		echo "<tr bgcolor=#B6D3FC><td align=right><A HREF=\"$PHP_SELF?ADD=311111&user_group=$user_group\">Grupo Del Usuario</A>: </td><td align=left><select size=1 name=user_group>\n";

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
		echo "<tr bgcolor=#B6D3FC><td align=right>Conexión Del Teléfono: </td><td align=left><input type=text name=phone_login size=20 maxlength=20 value=\"$phone_login\">$NWB#vicidial_users-phone_login$NWE</td></tr>\n";
		echo "<tr bgcolor=#B6D3FC><td align=right>Contraseña Del Teléfono: </td><td align=left><input type=text name=phone_pass size=20 maxlength=20 value=\"$phone_pass\">$NWB#vicidial_users-phone_pass$NWE</td></tr>\n";

		if ( ($LOGuser_level > 8) or ($LOGalter_agent_interface == "1") )
			{
			echo "<tr bgcolor=#015B91><td colspan=2 align=center><font color=white><B>OPCIONES DE INTERFAZ DEL AGENTE:</td></tr>\n";
			echo "<tr bgcolor=#B6D3FC><td align=right>El Agente Elige Ingroups: </td><td align=left><select size=1 name=agent_choose_ingroups><option>0</option><option>1</option><option SELECTED>$agent_choose_ingroups</option></select>$NWB#vicidial_users-agent_choose_ingroups$NWE</td></tr>\n";
			echo "<tr bgcolor=#B6D3FC><td align=right>Hot Keys Activo: </td><td align=left><select size=1 name=hotkeys_active><option>0</option><option>1</option><option SELECTED>$hotkeys_active</option></select>$NWB#vicidial_users-hotkeys_active$NWE</td></tr>\n";
			echo "<tr bgcolor=#B6D3FC><td align=right>Servicios repetidos Programar: </td><td align=left><select size=1 name=scheduled_callbacks><option>0</option><option>1</option><option SELECTED>$scheduled_callbacks</option></select>$NWB#vicidial_users-scheduled_callbacks$NWE</td></tr>\n";
			echo "<tr bgcolor=#B6D3FC><td align=right>Servicios repetidos Del Agente-Solamente: </td><td align=left><select size=1 name=agentonly_callbacks><option>0</option><option>1</option><option SELECTED>$agentonly_callbacks</option></select>$NWB#vicidial_users-agentonly_callbacks$NWE</td></tr>\n";
			echo "<tr bgcolor=#B6D3FC><td align=right>Manual de la llamada del agente: </td><td align=left><select size=1 name=agentcall_manual><option>0</option><option>1</option><option SELECTED>$agentcall_manual</option></select>$NWB#vicidial_users-agentcall_manual$NWE</td></tr>\n";
			echo "<tr bgcolor=#B6D3FC><td align=right>Grabación de Vicidial: </td><td align=left><select size=1 name=vicidial_recording><option>0</option><option>1</option><option SELECTED>$vicidial_recording</option></select>$NWB#vicidial_users-vicidial_recording$NWE</td></tr>\n";
			echo "<tr bgcolor=#B6D3FC><td align=right>Vicidial transfiere: </td><td align=left><select size=1 name=vicidial_transfers><option>0</option><option>1</option><option SELECTED>$vicidial_transfers</option></select>$NWB#vicidial_users-vicidial_transfers$NWE</td></tr>\n";
			echo "<tr bgcolor=#B6D3FC><td align=right>Un Defecto Más cercano Mezclado: </td><td align=left><select size=1 name=closer_default_blended><option>0</option><option>1</option><option SELECTED>$closer_default_blended</option></select>$NWB#vicidial_users-closer_default_blended$NWE</td></tr>\n";
			echo "<tr bgcolor=#B6D3FC><td align=right>Invalidación De la Grabación de VICIDIAL:</td><td align=left><select size=1 name=vicidial_recording_override><option>DISABLED</option><option>NEVER</option><option>ONDEMAND</option><option>ALLCALLS</option><option>ALLFORCE</option><option SELECTED>$vicidial_recording_override</option></select>$NWB#vicidial_users-vicidial_recording_override$NWE</td></tr>\n";
			echo "<tr bgcolor=#B6D3FC><td align=right>El Agente Altera La Invalidación De los Datos Del Cliente: </td><td align=left><select size=1 name=alter_custdata_override><option>NOT_ACTIVE</option><option>ALLOW_ALTER</option><option SELECTED>$alter_custdata_override</option></select>$NWB#vicidial_users-alter_custdata_override$NWE</td></tr>\n";
			echo "<tr bgcolor=#B6D3FC><td align=right>Grupos De entrada: </td><td align=left>\n";
			echo "$groups_list";
			echo "$NWB#vicidial_users-closer_campaigns$NWE</td></tr>\n";
			}
		if ($LOGuser_level > 8)
			{
			echo "<tr bgcolor=#015B91><td colspan=2 align=center><font color=white><B>OPCIONES DE INTERFAZ DEL ADMIN:</td></tr>\n";
			echo "<tr bgcolor=#B6D3FC><td align=right>Altere Las Opciones De Interfaz Del Agente: </td><td align=left><select size=1 name=alter_agent_interface_options><option>0</option><option>1</option><option SELECTED>$alter_agent_interface_options</option></select>$NWB#vicidial_users-alter_agent_interface_options$NWE</td></tr>\n";
			echo "<tr bgcolor=#B6D3FC><td align=right>Usuarios de la cancelación: </td><td align=left><select size=1 name=delete_users><option>0</option><option>1</option><option SELECTED>$delete_users</option></select>$NWB#vicidial_users-delete_users$NWE</td></tr>\n";
			echo "<tr bgcolor=#B6D3FC><td align=right>Suprima a grupos de usuario: </td><td align=left><select size=1 name=delete_user_groups><option>0</option><option>1</option><option SELECTED>$delete_user_groups</option></select>$NWB#vicidial_users-delete_user_groups$NWE</td></tr>\n";
			echo "<tr bgcolor=#B6D3FC><td align=right>La cancelación enumera: </td><td align=left><select size=1 name=delete_lists><option>0</option><option>1</option><option SELECTED>$delete_lists</option></select>$NWB#vicidial_users-delete_lists$NWE</td></tr>\n";
			echo "<tr bgcolor=#B6D3FC><td align=right>La cancelación hace campaña: </td><td align=left><select size=1 name=delete_campaigns><option>0</option><option>1</option><option SELECTED>$delete_campaigns</option></select>$NWB#vicidial_users-delete_campaigns$NWE</td></tr>\n";
			echo "<tr bgcolor=#B6D3FC><td align=right>En-Grupos de la cancelación: </td><td align=left><select size=1 name=delete_ingroups><option>0</option><option>1</option><option SELECTED>$delete_ingroups</option></select>$NWB#vicidial_users-delete_ingroups$NWE</td></tr>\n";
			echo "<tr bgcolor=#B6D3FC><td align=right>Suprima los agentes alejados: </td><td align=left><select size=1 name=delete_remote_agents><option>0</option><option>1</option><option SELECTED>$delete_remote_agents</option></select>$NWB#vicidial_users-delete_remote_agents$NWE</td></tr>\n";
			echo "<tr bgcolor=#B6D3FC><td align=right>Escritura De la Cancelacións: </td><td align=left><select size=1 name=delete_scripts><option>0</option><option>1</option><option SELECTED>$delete_scripts</option></select>$NWB#vicidial_users-delete_scripts$NWE</td></tr>\n";
			echo "<tr bgcolor=#B6D3FC><td align=right>La carga conduce: </td><td align=left><select size=1 name=load_leads><option>0</option><option>1</option><option SELECTED>$load_leads</option></select>$NWB#vicidial_users-load_leads$NWE</td></tr>\n";
			echo "<tr bgcolor=#B6D3FC><td align=right>Detalle de la campaña: </td><td align=left><select size=1 name=campaign_detail><option>0</option><option>1</option><option SELECTED>$campaign_detail</option></select>$NWB#vicidial_users-campaign_detail$NWE</td></tr>\n";
			echo "<tr bgcolor=#B6D3FC><td align=right>Acceso de AGC Admin: </td><td align=left><select size=1 name=ast_admin_access><option>0</option><option>1</option><option SELECTED>$ast_admin_access</option></select>$NWB#vicidial_users-ast_admin_access$NWE</td></tr>\n";
			echo "<tr bgcolor=#B6D3FC><td align=right>La cancelación de AGC telefona: </td><td align=left><select size=1 name=ast_delete_phones><option>0</option><option>1</option><option SELECTED>$ast_delete_phones</option></select>$NWB#vicidial_users-ast_delete_phones$NWE</td></tr>\n";
			echo "<tr bgcolor=#B6D3FC><td align=right>Modifique Los Plomos: </td><td align=left><select size=1 name=modify_leads><option>0</option><option>1</option><option SELECTED>$modify_leads</option></select>$NWB#vicidial_users-modify_leads$NWE</td></tr>\n";
			echo "<tr bgcolor=#B6D3FC><td align=right>Cambie La Campaña Del Agente: </td><td align=left><select size=1 name=change_agent_campaign><option>0</option><option>1</option><option SELECTED>$change_agent_campaign</option></select>$NWB#vicidial_users-change_agent_campaign$NWE</td></tr>\n";
			echo "<tr bgcolor=#B6D3FC><td align=right>Filtro De la Cancelacións: </td><td align=left><select size=1 name=delete_filters><option>0</option><option>1</option><option SELECTED>$delete_filters</option></select>$NWB#vicidial_users-delete_filters$NWE</td></tr>\n";
			echo "<tr bgcolor=#B6D3FC><td align=right>Delete Tiempos De la Llamada: </td><td align=left><select size=1 name=delete_call_times><option>0</option><option>1</option><option SELECTED>$delete_call_times</option></select>$NWB#vicidial_users-delete_call_times$NWE</td></tr>\n";
			echo "<tr bgcolor=#B6D3FC><td align=right>Modifique El Tiempo De la Llamadas: </td><td align=left><select size=1 name=modify_call_times><option>0</option><option>1</option><option SELECTED>$modify_call_times</option></select>$NWB#vicidial_users-modify_call_times$NWE</td></tr>\n";
			echo "<tr bgcolor=#B6D3FC><td align=right>Modifique A Usuarios: </td><td align=left><select size=1 name=modify_users><option>0</option><option>1</option><option SELECTED>$modify_users</option></select>$NWB#vicidial_users-modify_sections$NWE</td></tr>\n";
			echo "<tr bgcolor=#B6D3FC><td align=right>Modifique Las Campañas: </td><td align=left><select size=1 name=modify_campaigns><option>0</option><option>1</option><option SELECTED>$modify_campaigns</option></select>$NWB#vicidial_users-modify_sections$NWE</td></tr>\n";
			echo "<tr bgcolor=#B6D3FC><td align=right>Modifique Las Listas: </td><td align=left><select size=1 name=modify_lists><option>0</option><option>1</option><option SELECTED>$modify_lists</option></select>$NWB#vicidial_users-modify_sections$NWE</td></tr>\n";
			echo "<tr bgcolor=#B6D3FC><td align=right>Modifique Las Escrituras: </td><td align=left><select size=1 name=modify_scripts><option>0</option><option>1</option><option SELECTED>$modify_scripts</option></select>$NWB#vicidial_users-modify_sections$NWE</td></tr>\n";
			echo "<tr bgcolor=#B6D3FC><td align=right>Modifique Los Filtros: </td><td align=left><select size=1 name=modify_filters><option>0</option><option>1</option><option SELECTED>$modify_filters</option></select>$NWB#vicidial_users-modify_sections$NWE</td></tr>\n";
			echo "<tr bgcolor=#B6D3FC><td align=right>Modifique A En-Grupos: </td><td align=left><select size=1 name=modify_ingroups><option>0</option><option>1</option><option SELECTED>$modify_ingroups</option></select>$NWB#vicidial_users-modify_sections$NWE</td></tr>\n";
			echo "<tr bgcolor=#B6D3FC><td align=right>Modifique A Grupos De Usuario: </td><td align=left><select size=1 name=modify_usergroups><option>0</option><option>1</option><option SELECTED>$modify_usergroups</option></select>$NWB#vicidial_users-modify_sections$NWE</td></tr>\n";
			echo "<tr bgcolor=#B6D3FC><td align=right>Modifique Los Agentes Alejados: </td><td align=left><select size=1 name=modify_remoteagents><option>0</option><option>1</option><option SELECTED>$modify_remoteagents</option></select>$NWB#vicidial_users-modify_sections$NWE</td></tr>\n";
			echo "<tr bgcolor=#B6D3FC><td align=right>Modifique Los Servidores: </td><td align=left><select size=1 name=modify_servers><option>0</option><option>1</option><option SELECTED>$modify_servers</option></select>$NWB#vicidial_users-modify_sections$NWE</td></tr>\n";
			echo "<tr bgcolor=#B6D3FC><td align=right>Informes De la Visión: </td><td align=left><select size=1 name=view_reports><option>0</option><option>1</option><option SELECTED>$view_reports</option></select>$NWB#vicidial_users-view_reports$NWE</td></tr>\n";
			}
		echo "<tr bgcolor=#B6D3FC><td align=center colspan=2><input type=submit name=ENVIAR value=ENVIAR></td></tr>\n";
		echo "</TABLE></center>\n";

		if ($LOGdelete_users > 0)
			{
			echo "<br><br><a href=\"$PHP_SELF?ADD=5&user=$row[1]\">SUPRIMA A ESTE USUARIO</a>\n";
			}
		echo "<br><br><a href=\"./AST_agent_time_sheet.php?agent=$row[1]\">Chasque aquí para la hoja de tiempo del usuario</a>\n";
		echo "<br><br><a href=\"./user_status.php?user=$row[1]\">Chasque aquí para el estado del usuario</a>\n";
		echo "<br><br><a href=\"./user_stats.php?user=$row[1]\">Clique aquí para ver las estadísticas del usuario</a>\n";
		echo "<br><br><a href=\"$PHP_SELF?ADD=8&user=$row[1]\">Chasque aquí para los asimientos del servicio repetido del usuario</a>\n";
		}
	}
	else
	{
	echo "Usted no tiene permiso de visión esta página\n";
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

	echo "<br>MODIFIQUE Un EXPEDIENTE De las CAMPAÚAS: $row[0] - <a href=\"$PHP_SELF?ADD=34&campaign_id=$campaign_id\">Vista Básica</a>";
	echo " | Vista Detallada</a> | ";
	echo "<a href=\"./AST_timeonVDADall.php?RR=4&DB=0&group=$row[0]\">Pantalla En tiempo real</a>\n";
	echo "<form action=$PHP_SELF method=POST>\n";
	echo "<input type=hidden name=ADD value=41>\n";
	echo "<input type=hidden name=campaign_id value=\"$campaign_id\">\n";
	echo "<center><TABLE width=$section_width cellspacing=3>\n";
	echo "<tr bgcolor=#B6D3FC><td align=right>ID De la Campaña: </td><td align=left><b>$row[0]</b>$NWB#vicidial_campaigns-campaign_id$NWE</td></tr>\n";
	echo "<tr bgcolor=#B6D3FC><td align=right>Nombre de la Campaña: </td><td align=left><input type=text name=campaign_name size=40 maxlength=40 value=\"$campaign_name\">$NWB#vicidial_campaigns-campaign_name$NWE</td></tr>\n";
	echo "<tr bgcolor=#B6D3FC><td align=right>Descripción De la Campaña: </td><td align=left><input type=text name=campaign_description size=40 maxlength=255 value=\"$campaign_description\">$NWB#vicidial_campaigns-campaign_description$NWE</td></tr>\n";
	echo "<tr bgcolor=#B6D3FC><td align=right>Campaña Change Date: </td><td align=left>$campaign_changedate &nbsp; $NWB#vicidial_campaigns-campaign_changedate$NWE</td></tr>\n";
	echo "<tr bgcolor=#B6D3FC><td align=right>Campaña Login Date: </td><td align=left>$campaign_logindate &nbsp; $NWB#vicidial_campaigns-campaign_logindate$NWE</td></tr>\n";
	echo "<tr bgcolor=#B6D3FC><td align=right>Activo: </td><td align=left><select size=1 name=active><option>Y</option><option>N</option><option SELECTED>$row[2]</option></select>$NWB#vicidial_campaigns-active$NWE</td></tr>\n";
	echo "<tr bgcolor=#B6D3FC><td align=right>Extensión del parking: </td><td align=left><input type=text name=park_ext size=10 maxlength=10 value=\"$row[9]\"> - Filename: <input type=text name=park_file_name size=10 maxlength=10 value=\"$row[10]\">$NWB#vicidial_campaigns-park_ext$NWE</td></tr>\n";
	echo "<tr bgcolor=#B6D3FC><td align=right>Formulario Web: </td><td align=left><input type=text name=web_form_address size=50 maxlength=255 value=\"$row[11]\">$NWB#vicidial_campaigns-web_form_address$NWE</td></tr>\n";
	echo "<tr bgcolor=#B6D3FC><td align=right>Permitir Closers: </td><td align=left><select size=1 name=allow_closers><option>Y</option><option>N</option><option SELECTED>$row[12]</option></select>$NWB#vicidial_campaigns-allow_closers$NWE</td></tr>\n";

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

		echo "<tr bgcolor=#B6D3FC><td align=right>Estado Del Dial $o: </td><td align=left> \n";
		echo "<b>$Dstatus</b> - $statname_list[$Dstatus] &nbsp; &nbsp; &nbsp; &nbsp; <font size=2>\n";
		echo "<a href=\"$PHP_SELF?ADD=68&campaign_id=$campaign_id&status=$Dstatuses[$o]\">QUITE</a></td></tr>\n";
		}

	echo "<tr bgcolor=#B6D3FC><td align=right>Add A Dial Estado: </td><td align=left><select size=1 name=dial_status>\n";
	echo "<option value=\"\"> - NONE - </option>\n";

	echo "$statuses_list";
	echo "</select> &nbsp; \n";
	echo "<input type=submit name=submit value=ADD> &nbsp; &nbsp; $NWB#vicidial_campaigns-dial_status$NWE</td></tr>\n";

	echo "<tr bgcolor=#B6D3FC><td align=right>Orden De la Lista: </td><td align=left><select size=1 name=lead_order><option>DOWN</option><option>UP</option><option>UP PHONE</option><option>DOWN PHONE</option><option>UP LAST NAME</option><option>DOWN LAST NAME</option><option>UP COUNT</option><option>DOWN COUNT</option><option>DOWN COUNT 2nd NEW</option><option>DOWN COUNT 3rd NEW</option><option>DOWN COUNT 4th NEW</option><option SELECTED>$lead_order</option></select>$NWB#vicidial_campaigns-lead_order$NWE</td></tr>\n";

	echo "<tr bgcolor=#B6D3FC><td align=right><a href=\"$PHP_SELF?ADD=31111111&lead_filter_id=$lead_filter_id\">Filtro del plomo</a>: </td><td align=left><select size=1 name=lead_filter_id>\n";
	echo "$filters_list";
	echo "<option selected value=\"$lead_filter_id\">$lead_filter_id - $filtername_list[$lead_filter_id]</option>\n";
	echo "</select>$NWB#vicidial_campaigns-lead_filter_id$NWE</td></tr>\n";

	echo "<tr bgcolor=#B6D3FC><td align=right>Nivel Del Hopper: </td><td align=left><select size=1 name=hopper_level><option>1</option><option>5</option><option>10</option><option>50</option><option>100</option><option>200</option><option>500</option><option>750</option><option>1000</option><option>2000</option><option SELECTED>$hopper_level</option></select>$NWB#vicidial_campaigns-hopper_level$NWE</td></tr>\n";

	echo "<tr bgcolor=#B6D3FC><td align=right>Forzar el Reinicio del Hopper: </td><td align=left><select size=1 name=reset_hopper><option>Y</option><option SELECTED>N</option></select>$NWB#vicidial_campaigns-force_reset_hopper$NWE</td></tr>\n";

	echo "<tr bgcolor=#BDFFBD><td align=right>Método Del Dial: </td><td align=left><select size=1 name=dial_method><option >MANUAL</option><option>RATIO</option><option>ADAPT_HARD_LIMIT</option><option>ADAPT_TAPERED</option><option>ADAPT_AVERAGE</option><option SELECTED>$dial_method</option></select>$NWB#vicidial_campaigns-dial_method$NWE</td></tr>\n";

	echo "<tr bgcolor=#BDFFBD><td align=right>Nivel del Auto-Dial: </td><td align=left><select size=1 name=auto_dial_level><option >0</option><option>1</option><option>1.1</option><option>1.2</option><option>1.3</option><option>1.4</option><option>1.5</option><option>1.6</option><option>1.7</option><option>1.8</option><option>1.9</option><option>2.0</option><option>2.2</option><option>2.5</option><option>2.7</option><option>3.0</option><option>3.5</option><option>4.0</option><option SELECTED>$auto_dial_level</option></select>(0 = off)$NWB#vicidial_campaigns-auto_dial_level$NWE &nbsp; &nbsp; &nbsp; <input type=checkbox name=dial_level_override value=\"1\">ADAPTE LA INVALIDACIÓN</td></tr>\n";

	echo "<tr bgcolor=#BDFFBD><td align=right>Solamente Cuenta Disponible: </td><td align=left><select size=1 name=available_only_ratio_tally><option >Y</option><option>N</option><option SELECTED>$available_only_ratio_tally</option></select>$NWB#vicidial_campaigns-available_only_ratio_tally$NWE</td></tr>\n";

	echo "<tr bgcolor=#BDFFBD><td align=right>Límite Del Porcentaje De la Gota: </td><td align=left><select size=1 name=adaptive_dropped_percentage>\n";
	$n=100;
	while ($n>=1)
		{
		echo "<option>$n</option>\n";
		$n--;
		}
	echo "<option SELECTED>$adaptive_dropped_percentage</option></select>% $NWB#vicidial_campaigns-adaptive_dropped_percentage$NWE</td></tr>\n";

	echo "<tr bgcolor=#BDFFBD><td align=right>El Máximo Adapta El Nivel Del Dial: </td><td align=left><input type=text name=adaptive_maximum_level size=6 maxlength=6 value=\"$adaptive_maximum_level\"><i>number only</i> $NWB#vicidial_campaigns-adaptive_maximum_level$NWE</td></tr>\n";

	echo "<tr bgcolor=#BDFFBD><td align=right>El Tiempo Más último Del Servidor: </td><td align=left><input type=text name=adaptive_latest_server_time size=6 maxlength=4 value=\"$adaptive_latest_server_time\"><i>4 Solamente dígitos</i> $NWB#vicidial_campaigns-adaptive_latest_server_time$NWE</td></tr>\n";

	echo "<tr bgcolor=#BDFFBD><td align=right>Adapte El Modificante De la Intensidad: </td><td align=left><select size=1 name=adaptive_intensity>\n";
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



	echo "<tr bgcolor=#BDFFBD><td align=right>Blanco Llana De la Diferencia Del Dial: </td><td align=left><select size=1 name=adaptive_dl_diff_target>\n";
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

	echo "<tr bgcolor=#BDFFBD><td align=right>Transferencias Concurrentes: </td><td align=left><select size=1 name=concurrent_transfers><option >AUTO</option><option>1</option><option>2</option><option>3</option><option>4</option><option>5</option><option>6</option><option>7</option><option>8</option><option>9</option><option>10<option SELECTED>$concurrent_transfers</option></select>$NWB#vicidial_campaigns-concurrent_transfers$NWE</td></tr>\n";


	echo "<tr bgcolor=#B6D3FC><td align=right>El Marcar Auto Del Alt-Nu'mero: </td><td align=left><select size=1 name=auto_alt_dial><option >NONE</option><option>ALT_ONLY</option><option>ADDR3_ONLY</option><option>ALT_AND_ADDR3<option SELECTED>$auto_alt_dial</option></select>$NWB#vicidial_campaigns-auto_alt_dial$NWE</td></tr>\n";

	echo "<tr bgcolor=#B6D3FC><td align=right>Llamar al Siguiente  Agente: </td><td align=left><select size=1 name=next_agent_call><option >random</option><option>oldest_call_start</option><option>oldest_call_finish</option><option>overall_user_level</option><option SELECTED>$next_agent_call</option></select>$NWB#vicidial_campaigns-next_agent_call$NWE</td></tr>\n";

	echo "<tr bgcolor=#B6D3FC><td align=right><a href=\"$PHP_SELF?ADD=311111111&call_time_id=$local_call_time\">Franja horaria de llamada: </a></td><td align=left><select size=1 name=local_call_time>\n";
	echo "$call_times_list";
	echo "<option selected value=\"$local_call_time\">$local_call_time - $call_timename_list[$local_call_time]</option>\n";
	echo "</select>$NWB#vicidial_campaigns-local_call_time$NWE</td></tr>\n";

	echo "<tr bgcolor=#B6D3FC><td align=right>Tiempo de espera Del Dial: </td><td align=left><input type=text name=dial_timeout size=3 maxlength=3 value=\"$dial_timeout\"> <i>in seconds</i>$NWB#vicidial_campaigns-dial_timeout$NWE</td></tr>\n";

	echo "<tr bgcolor=#B6D3FC><td align=right>Prefijo al marcar: </td><td align=left><input type=text name=dial_prefix size=20 maxlength=20 value=\"$dial_prefix\"> <font size=1>for 91NXXNXXXXXX value would be 9, for no dial prefix use X</font>$NWB#vicidial_campaigns-dial_prefix$NWE</td></tr>\n";

	echo "<tr bgcolor=#B6D3FC><td align=right>Omita El Código Del Teléfono: </td><td align=left><select size=1 name=omit_phone_code><option>Y</option><option>N</option><option SELECTED>$omit_phone_code</option></select>$NWB#vicidial_campaigns-omit_phone_code$NWE</td></tr>\n";

	echo "<tr bgcolor=#B6D3FC><td align=right>CallerID de la Campaña: </td><td align=left><input type=text name=campaign_cid size=20 maxlength=20 value=\"$campaign_cid\">$NWB#vicidial_campaigns-campaign_cid$NWE</td></tr>\n";

	echo "<tr bgcolor=#B6D3FC><td align=right>Exten VDAD de La campaña: </td><td align=left><input type=text name=campaign_vdad_exten size=10 maxlength=20 value=\"$campaign_vdad_exten\">$NWB#vicidial_campaigns-campaign_vdad_exten$NWE</td></tr>\n";

	echo "<tr bgcolor=#B6D3FC><td align=right>Extensión de Rec de la campaña: </td><td align=left><input type=text name=campaign_rec_exten size=10 maxlength=10 value=\"$campaign_rec_exten\">$NWB#vicidial_campaigns-campaign_rec_exten$NWE</td></tr>\n";

	echo "<tr bgcolor=#B6D3FC><td align=right>Grabación De la Campaña: </td><td align=left><select size=1 name=campaign_recording><option>NEVER</option><option>ONDEMAND</option><option>ALLCALLS</option><option>ALLFORCE</option><option SELECTED>$campaign_recording</option></select>$NWB#vicidial_campaigns-campaign_recording$NWE</td></tr>\n";

	echo "<tr bgcolor=#B6D3FC><td align=right>Nombre de fichero De Rec De la Campaña: </td><td align=left><input type=text name=campaign_rec_filename size=50 maxlength=50 value=\"$campaign_rec_filename\">$NWB#vicidial_campaigns-campaign_rec_filename$NWE</td></tr>\n";

	echo "<tr bgcolor=#B6D3FC><td align=right>La Registración Retrasa: </td><td align=left><input type=text name=allcalls_delay size=3 maxlength=3 value=\"$allcalls_delay\"> <i>in seconds</i>$NWB#vicidial_campaigns-allcalls_delay$NWE</td></tr>\n";

	echo "<tr bgcolor=#B6D3FC><td align=right><a href=\"$PHP_SELF?ADD=3111111&script_id=$script_id\">Script</a>: </td><td align=left><select size=1 name=script_id>\n";
	echo "$scripts_list";
	echo "<option selected value=\"$script_id\">$script_id - $scriptname_list[$script_id]</option>\n";
	echo "</select>$NWB#vicidial_campaigns-campaign_script$NWE</td></tr>\n";

	echo "<tr bgcolor=#B6D3FC><td align=right>Consiga El Lanzamiento De la Llamada: </td><td align=left><select size=1 name=get_call_launch><option selected>NONE</option><option>SCRIPT</option><option>WEBFORM</option><option selected>$get_call_launch</option></select>$NWB#vicidial_campaigns-get_call_launch$NWE</td></tr>\n";

	echo "<tr bgcolor=#B6D3FC><td align=right>Mensaje del contestador automático: </td><td align=left><input type=text name=am_message_exten size=10 maxlength=20 value=\"$am_message_exten\">$NWB#vicidial_campaigns-am_message_exten$NWE</td></tr>\n";

	echo "<tr bgcolor=#B6D3FC><td align=right>AMD envían a la VM exten: </td><td align=left><select size=1 name=amd_send_to_vmx><option>Y</option><option>N</option><option SELECTED>$amd_send_to_vmx</option></select>$NWB#vicidial_campaigns-amd_send_to_vmx$NWE</td></tr>\n";

	echo "<tr bgcolor=#B6D3FC><td align=right>Transfiera -Conf DTMF 1: </td><td align=left><input type=text name=xferconf_a_dtmf size=20 maxlength=50 value=\"$xferconf_a_dtmf\">$NWB#vicidial_campaigns-xferconf_a_dtmf$NWE</td></tr>\n";

	echo "<tr bgcolor=#B6D3FC><td align=right>Transfiera -Conf El Número 1: </td><td align=left><input type=text name=xferconf_a_number size=20 maxlength=50 value=\"$xferconf_a_number\">$NWB#vicidial_campaigns-xferconf_a_dtmf$NWE</td></tr>\n";

	echo "<tr bgcolor=#B6D3FC><td align=right>Transfiera -Conf DTMF 2: </td><td align=left><input type=text name=xferconf_b_dtmf size=20 maxlength=50 value=\"$xferconf_b_dtmf\">$NWB#vicidial_campaigns-xferconf_a_dtmf$NWE</td></tr>\n";

	echo "<tr bgcolor=#B6D3FC><td align=right>Transfiera -Conf El Número 2: </td><td align=left><input type=text name=xferconf_b_number size=20 maxlength=50 value=\"$xferconf_b_number\">$NWB#vicidial_campaigns-xferconf_a_dtmf$NWE</td></tr>\n";

	echo "<tr bgcolor=#B6D3FC><td align=right>El Marcar Del Número Del Alt: </td><td align=left><select size=1 name=alt_number_dialing><option>Y</option><option>N</option><option SELECTED>$alt_number_dialing</option></select>$NWB#vicidial_campaigns-alt_number_dialing$NWE</td></tr>\n";

	echo "<tr bgcolor=#B6D3FC><td align=right>Servicios repetidos Programar: </td><td align=left><select size=1 name=scheduled_callbacks><option>Y</option><option>N</option><option SELECTED>$scheduled_callbacks</option></select>$NWB#vicidial_campaigns-scheduled_callbacks$NWE</td></tr>\n";

	echo "<tr bgcolor=#B6D3FC><td align=right>Segundos De la Llamada De la Gota: </td><td align=left><input type=text name=drop_call_seconds size=5 maxlength=2 value=\"$drop_call_seconds\">$NWB#vicidial_campaigns-drop_call_seconds$NWE</td></tr>\n";

	echo "<tr bgcolor=#B6D3FC><td align=right>Buzón de Voz: </td><td align=left><input type=text name=voicemail_ext size=10 maxlength=10 value=\"$voicemail_ext\">$NWB#vicidial_campaigns-voicemail_ext$NWE</td></tr>\n";

	echo "<tr bgcolor=#B6D3FC><td align=right>Utilice El Mensaje Seguro Del Puerto: </td><td align=left><select size=1 name=safe_harbor_message><option>Y</option><option>N</option><option SELECTED>$safe_harbor_message</option></select>$NWB#vicidial_campaigns-safe_harbor_message$NWE</td></tr>\n";

	echo "<tr bgcolor=#B6D3FC><td align=right>Puerto Seguro Exten: </td><td align=left><input type=text name=safe_harbor_exten size=10 maxlength=20 value=\"$safe_harbor_exten\">$NWB#vicidial_campaigns-safe_harbor_exten$NWE</td></tr>\n";

	echo "<tr bgcolor=#B6D3FC><td align=right>Segundos De Wrap Up: </td><td align=left><input type=text name=wrapup_seconds size=5 maxlength=3 value=\"$wrapup_seconds\">$NWB#vicidial_campaigns-wrapup_seconds$NWE</td></tr>\n";

	echo "<tr bgcolor=#B6D3FC><td align=right>Mensaje De Wrap Up: </td><td align=left><input type=text name=wrapup_message size=40 maxlength=255 value=\"$wrapup_message\">$NWB#vicidial_campaigns-wrapup_message$NWE</td></tr>\n";

	echo "<tr bgcolor=#B6D3FC><td align=right>Utilice La Lista Interna de DNC: </td><td align=left><select size=1 name=use_internal_dnc><option>Y</option><option>N</option><option SELECTED>$use_internal_dnc</option></select>$NWB#vicidial_campaigns-use_internal_dnc$NWE</td></tr>\n";

	echo "<tr bgcolor=#B6D3FC><td align=right>Agent Pause Codes Activo: </td><td align=left><select size=1 name=agent_pause_codes_active><option>Y</option><option>N</option><option SELECTED>$agent_pause_codes_active</option></select>$NWB#vicidial_campaigns-agent_pause_codes_active$NWE</td></tr>\n";

	echo "<tr bgcolor=#B6D3FC><td align=right>Campaña Stats Refresh: </td><td align=left><select size=1 name=campaign_stats_refresh><option>Y</option><option>N</option><option SELECTED>$campaign_stats_refresh</option></select>$NWB#vicidial_campaigns-campaign_stats_refresh$NWE</td></tr>\n";

	echo "<tr bgcolor=#B6D3FC><td align=right>Inhabilite Alteran Datos Del Cliente:</td><td align=left><select size=1 name=disable_alter_custdata><option>Y</option><option>N</option><option SELECTED>$disable_alter_custdata</option></select>$NWB#vicidial_campaigns-disable_alter_custdata$NWE</td></tr>\n";

	echo "<tr bgcolor=#B6D3FC><td align=right>Permita Ninguno-Tolva-Conduce Conexiones: </td><td align=left><select size=1 name=no_hopper_leads_logins><option>Y</option><option>N</option><option SELECTED>$no_hopper_leads_logins</option></select>$NWB#vicidial_campaigns-no_hopper_leads_logins$NWE</td></tr>\n";


	if (eregi("(CLOSER|BLEND|INBND|_C$|_B$|_I$)", $campaign_id))
		{
		echo "<tr bgcolor=#B6D3FC><td align=right>Grupos De entrada Permitidos: <BR>";
		echo " $NWB#vicidial_campaigns-closer_campaigns$NWE</td><td align=left>\n";
		echo "$groups_list";
		echo "</td></tr>\n";
		}



	echo "<tr bgcolor=#B6D3FC><td align=center colspan=2><input type=submit name=ENVIAR value=ENVIAR></td></tr>\n";
	echo "</TABLE></center></FORM>\n";

	echo "<center>\n";
	echo "<br><b>LISTAS DENTRO DE ESTA CAMPAÑA: &nbsp; $NWB#vicidial_campaign_lists$NWE</b><br>\n";
	echo "<TABLE width=400 cellspacing=3>\n";
	echo "<tr><td>ID DE LA LISTA</td><td>NOMBRE DE LA LISTA</td><td>ACTIVO</td></tr>\n";

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
	echo "Esta campaña tiene $active_lists listas activas y $inactive_lists listas inactivas<br><br>\n";

	if ($display_dialable_count == 'Y')
		{
		### call function to calculate and print dialable leads
		dialable_leads($DB,$link,$local_call_time,$dial_statuses,$camp_lists,$fSQL);
		echo " - <font size=1><a href=\"$PHP_SELF?ADD=31&campaign_id=$campaign_id&stage=hide_dialable\">PIEL</a></font><BR><BR>";
		}
	else
		{
		echo "<a href=\"$PHP_SELF?ADD=73&campaign_id=$campaign_id\" target=\"_blank\">Popup Dialable Leads Count</a>";
		echo " - <font size=1><a href=\"$PHP_SELF?ADD=31&campaign_id=$campaign_id&stage=show_dialable\">DEMOSTRACIÓN</a></font><BR><BR>";
		}





		$stmt="SELECT count(*) FROM vicidial_hopper where campaign_id='$campaign_id' and status IN('READY')";
		if ($DB) {echo "$stmt\n";}
		$rslt=mysql_query($stmt, $link);
		$rowx=mysql_fetch_row($rslt);
		$hopper_leads = "$rowx[0]";

	echo "Esta campaña tiene $hopper_leads Leads en el Hopper<br><br>\n";
	echo "<a href=\"./AST_VICIDIAL_hopperlist.php?group=$campaign_id\">Chasque aquí para ver qué plomos están en la tolva ahora</a><br><br>\n";
	echo "<a href=\"$PHP_SELF?ADD=81&campaign_id=$campaign_id\">Chasque aquí para ver todos los asimientos del servicio repetido en esta campaña</a><BR><BR>\n";
	echo "<a href=\"./AST_VDADstats.php?group=$campaign_id\">Click here to see a VDAD report for this campaign</a><BR><BR>\n";
	echo "</b></center>\n";




	echo "<center>\n";
	echo "<br><b>ESTADOS DE ENCARGO DENTRO DE ESTA CAMPAÚA: &nbsp; $NWB#vicidial_campaign_statuses$NWE</b><br>\n";
	echo "<TABLE width=400 cellspacing=3>\n";
	echo "<tr><td>ESTADO</td><td>DESCRIPCIÓN</td><td>SELECCIONABLE</td><td>ELIMINAR</td></tr>\n";

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

		echo "<tr $bgcolor><td><font size=1>$rowx[0]</td><td><font size=1>$rowx[1]</td><td><font size=1>$rowx[2]</td><td><font size=1><a href=\"$PHP_SELF?ADD=42&campaign_id=$campaign_id&status=$rowx[0]&action=DELETE\">ELIMINAR</a></td></tr>\n";

		}

	echo "</table>\n";

	echo "<br>AGREGAR ESTADO PERSONALIZADO A LA CAMPAÑA<BR><form action=$PHP_SELF method=POST>\n";
	echo "<input type=hidden name=ADD value=22>\n";
	echo "<input type=hidden name=campaign_id value=\"$campaign_id\">\n";
	echo "Estado: <input type=text name=status size=10 maxlength=8> &nbsp; \n";
	echo "Descripción: <input type=text name=status_name size=20 maxlength=30> &nbsp; \n";
	echo "Seleccionable: <select size=1 name=selectable><option>Y</option><option>N</option></select> &nbsp; \n";
	echo "<input type=submit name=submit value=ADD><BR>\n";

	echo "</FORM><br>\n";



	echo "<br><b>PERSONALIZAR ACCEDOS DIRECTOS PARA ESTA CAMPAÑA: &nbsp; $NWB#vicidial_campaign_hotkeys$NWE</b><br>\n";
	echo "<TABLE width=400 cellspacing=3>\n";
	echo "<tr><td>ACCESO DIRECTO</td><td>ESTADO</td><td>DESCRIPCIÓN</td><td>ELIMINAR</td></tr>\n";

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

		echo "<tr $bgcolor><td><font size=1>$rowx[1]</td><td><font size=1>$rowx[0]</td><td><font size=1>$rowx[2]</td><td><font size=1><a href=\"$PHP_SELF?ADD=43&campaign_id=$campaign_id&status=$rowx[0]&hotkey=$rowx[1]&action=DELETE\">ELIMINAR</a></td></tr>\n";

		}

	echo "</table>\n";

	echo "<br>AÑADIR ACCESO DIRECTO A LA CAMPAÑA<BR><form action=$PHP_SELF method=POST>\n";
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
	echo "Estado: <select size=1 name=HKstatus>\n";
	echo "$HKstatuses_list\n";
	echo "<option value=\"ALTPH2-----Alternate Phone Hot Dial\">ALTPH2 - Alternate Phone Hot Dial</option>\n";
	echo "<option value=\"ADDR3-----Address3 Hot Dial\">ADDR3 - Address3 Hot Dial</option>\n";
	echo "</select> &nbsp; \n";
	echo "<input type=submit name=submit value=ADD><BR>\n";
	echo "</form><BR>\n";



	echo "<br><br><b>PLOMO QUE RECICLA DENTRO DE ESTA CAMPAÑA: &nbsp; $NWB#vicidial_lead_recycle$NWE</b><br>\n";
	echo "<TABLE width=500 cellspacing=3>\n";
	echo "<tr><td>ESTADO</td><td>LA TENTATIVA RETRASA</td><td>MÁXIMO DE LA TENTATIVA</td><td>ACTIVO</td><td> </td><td>ELIMINAR</td></tr>\n";

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
		echo "<td><font size=1><a href=\"$PHP_SELF?ADD=65&campaign_id=$campaign_id&status=$rowx[2]\">ELIMINAR</a></td></tr>\n";
		}

	echo "</table>\n";

	echo "<br>AGREGUE EL NUEVO PLOMO DE LA CAMPAÑA RECICLAN<BR><form action=$PHP_SELF method=POST>\n";
	echo "<input type=hidden name=ADD value=25>\n";
	echo "<input type=hidden name=active value=\"N\">\n";
	echo "<input type=hidden name=campaign_id value=\"$campaign_id\">\n";
	echo "Estado: <select size=1 name=status>\n";
	echo "$LRstatuses_list\n";
	echo "</select> &nbsp; \n";
	echo "La Tentativa Retrasa: <input type=text size=7 maxlength=5 name=attempt_delay>\n";
	echo "Máximo De la Tentativa: <input type=text size=5 maxlength=3 name=attempt_maximum>\n";
	echo "<input type=submit name=submit value=ADD><BR>\n";

	echo "</FORM><br>\n";



	echo "<br><br><b>NÚMERO AUTO DEL ALT QUE MARCA PARA ESTA CAMPAÑA: &nbsp; $NWB#vicidial_auto_alt_dial_statuses$NWE</b><br>\n";
	echo "<TABLE width=500 cellspacing=3>\n";
	echo "<tr><td>STATUSES</td><td>ELIMINAR</td></tr>\n";

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
		echo "<td><font size=1><a href=\"$PHP_SELF?ADD=66&campaign_id=$campaign_id&status=$AADstatuses[$o]\">ELIMINAR</a></td></tr>\n";
		}

	echo "</table>\n";

	echo "<br>AGREGUE EL ESTADO QUE MARCA DEL NUEVO DEL AUTOMÓVIL NÚMERO DEL ALT<BR><form action=$PHP_SELF method=POST>\n";
	echo "<input type=hidden name=ADD value=26>\n";
	echo "<input type=hidden name=campaign_id value=\"$campaign_id\">\n";
	echo "Estado: <select size=1 name=status>\n";
	echo "$LRstatuses_list\n";
	echo "</select> &nbsp; \n";
	echo "<input type=submit name=submit value=ADD><BR>\n";

	echo "</FORM><br>\n";



	echo "<br><br><b>CÓDIGOS DE LA PAUSA DEL AGENTE PARA ESTA CAMPAÑA: &nbsp; $NWB#vicidial_pause_codes$NWE</b><br>\n";
	echo "<TABLE width=500 cellspacing=3>\n";
	echo "<tr><td>CÓDIGOS DE LA PAUSA</td><td>FACTURABLE</td><td>MODIFICAR</td><td>ELIMINAR</td></tr>\n";

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
		echo "<td><font size=1><a href=\"$PHP_SELF?ADD=67&campaign_id=$campaign_id&pause_code=$rowx[0]\">ELIMINAR</a></td></tr>\n";
		}

	echo "</table>\n";

	echo "<br>AGREGUE EL NUEVO CÓDIGO DE LA PAUSA DEL AGENTE<BR><form action=$PHP_SELF method=POST>\n";
	echo "<input type=hidden name=ADD value=27>\n";
	echo "<input type=hidden name=campaign_id value=\"$campaign_id\">\n";
	echo "Código De la Pausa: <input type=text size=8 maxlength=6 name=pause_code>\n";
	echo "Nombre Del Código De la Pausa: <input type=text size=20 maxlength=30 name=pause_code_name>\n";
	echo " &nbsp; Facturable: <select size=1 name=billable><option>YES</option><option>NO</option><option>HALF</option></select>\n";
	echo "<input type=submit name=submit value=ADD><BR>\n";

	echo "</center></FORM><br>\n";






	echo "<BR><BR>\n";
	echo "<a href=\"$PHP_SELF?ADD=52&campaign_id=$campaign_id\">REGISTRE TODOS LOS AGENTES FUERA DE ESTA CAMPAÑA</a><BR><BR>\n";
	echo "<a href=\"$PHP_SELF?ADD=53&campaign_id=$campaign_id\">EMERGENCY VDAC CLEAR FOR THIS CAMPAIGN</a><BR><BR>\n";

	if ($LOGdelete_campaigns > 0)
		{
		echo "<br><br><a href=\"$PHP_SELF?ADD=51&campaign_id=$campaign_id\">SUPRIMA ESTA CAMPAÑA</a>\n";
		}
	}
	else
	{
	echo "Usted no tiene permiso de visión esta página\n";
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

	echo "<br>MODIFY A CAMPAIGN'S RECORD: $row[0] - Vista Básica | ";
	echo "<a href=\"$PHP_SELF?ADD=31&campaign_id=$campaign_id\">Vista Detallada</a> | ";
	echo "<a href=\"./AST_timeonVDADall.php?RR=4&DB=0&group=$row[0]\">Pantalla En tiempo real</a>\n";
	echo "<form action=$PHP_SELF method=POST>\n";
	echo "<input type=hidden name=ADD value=44>\n";
	echo "<input type=hidden name=campaign_id value=\"$campaign_id\">\n";
	echo "<center><TABLE width=$section_width cellspacing=3>\n";
	echo "<tr bgcolor=#B6D3FC><td align=right>ID De la Campaña: </td><td align=left><b>$row[0]</b>$NWB#vicidial_campaigns-campaign_id$NWE</td></tr>\n";
	echo "<tr bgcolor=#B6D3FC><td align=right>Nombre de la Campaña: </td><td align=left><input type=text name=campaign_name size=40 maxlength=40 value=\"$row[1]\">$NWB#vicidial_campaigns-campaign_name$NWE</td></tr>\n";
	echo "<tr bgcolor=#B6D3FC><td align=right>Descripción De la Campaña: </td><td align=left><input type=text name=campaign_changedate size=40 maxlength=255 value=\"$campaign_description\">$NWB#vicidial_campaigns-campaign_description$NWE</td></tr>\n";
	echo "<tr bgcolor=#B6D3FC><td align=right>Campaña Change Date: </td><td align=left>$campaign_changedate &nbsp; $NWB#vicidial_campaigns-campaign_changedate$NWE</td></tr>\n";
	echo "<tr bgcolor=#B6D3FC><td align=right>Campaña Login Date: </td><td align=left>$campaign_logindate &nbsp; $NWB#vicidial_campaigns-campaign_logindate$NWE</td></tr>\n";

	echo "<tr bgcolor=#B6D3FC><td align=right>Activo: </td><td align=left><select size=1 name=active><option>Y</option><option>N</option><option SELECTED>$row[2]</option></select>$NWB#vicidial_campaigns-active$NWE</td></tr>\n";
	echo "<tr bgcolor=#B6D3FC><td align=right>Extensión del parking: </td><td align=left>$row[9] - $row[10]$NWB#vicidial_campaigns-park_ext$NWE</td></tr>\n";
	echo "<tr bgcolor=#B6D3FC><td align=right>Formulario Web: </td><td align=left>$row[11]$NWB#vicidial_campaigns-web_form_address$NWE</td></tr>\n";
	echo "<tr bgcolor=#B6D3FC><td align=right>Permitir Closers: </td><td align=left>$row[12] $NWB#vicidial_campaigns-allow_closers$NWE</td></tr>\n";

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

		echo "<tr bgcolor=#B6D3FC><td align=right>Estado Del Dial $o: </td><td align=left> \n";
		echo "<b>$Dstatus</b> - $statname_list[$Dstatus] &nbsp; &nbsp; &nbsp; &nbsp; <font size=2>\n";
		echo "<a href=\"$PHP_SELF?ADD=68&campaign_id=$campaign_id&status=$Dstatuses[$o]\">QUITE</a></td></tr>\n";
		}

	echo "<tr bgcolor=#B6D3FC><td align=right>Add A Dial Estado: </td><td align=left><select size=1 name=dial_status>\n";
	echo "<option value=\"\"> - NONE - </option>\n";

	echo "$statuses_list";
	echo "</select> &nbsp; \n";
	echo "<input type=submit name=submit value=ADD> &nbsp; &nbsp; $NWB#vicidial_campaigns-dial_status$NWE</td></tr>\n";

	echo "<tr bgcolor=#B6D3FC><td align=right>Orden De la Lista: </td><td align=left><select size=1 name=lead_order><option>DOWN</option><option>UP</option><option>UP PHONE</option><option>DOWN PHONE</option><option>UP LAST NAME</option><option>DOWN LAST NAME</option><option>UP COUNT</option><option>DOWN COUNT</option><option>DOWN COUNT 2nd NEW</option><option>DOWN COUNT 3rd NEW</option><option>DOWN COUNT 4th NEW</option><option SELECTED>$lead_order</option></select>$NWB#vicidial_campaigns-lead_order$NWE</td></tr>\n";

	echo "<tr bgcolor=#B6D3FC><td align=right><a href=\"$PHP_SELF?ADD=31111111&lead_filter_id=$lead_filter_id\">Filtro del plomo</a>: </td><td align=left><select size=1 name=lead_filter_id>\n";
	echo "$filters_list";
	echo "<option selected value=\"$lead_filter_id\">$lead_filter_id - $filtername_list[$lead_filter_id]</option>\n";
	echo "</select>$NWB#vicidial_campaigns-lead_filter_id$NWE</td></tr>\n";

	echo "<tr bgcolor=#B6D3FC><td align=right>Nivel Del Hopper: </td><td align=left><select size=1 name=hopper_level><option>1</option><option>5</option><option>10</option><option>50</option><option>100</option><option>200</option><option>500</option><option>750</option><option>1000</option><option>2000</option><option SELECTED>$hopper_level</option></select>$NWB#vicidial_campaigns-hopper_level$NWE</td></tr>\n";

	echo "<tr bgcolor=#B6D3FC><td align=right>Forzar el Reinicio del Hopper: </td><td align=left><select size=1 name=reset_hopper><option>Y</option><option SELECTED>N</option></select>$NWB#vicidial_campaigns-force_reset_hopper$NWE</td></tr>\n";

	echo "<tr bgcolor=#BDFFBD><td align=right>Método Del Dial: </td><td align=left><select size=1 name=dial_method><option >MANUAL</option><option>RATIO</option><option>ADAPT_HARD_LIMIT</option><option>ADAPT_TAPERED</option><option>ADAPT_AVERAGE</option><option SELECTED>$dial_method</option></select>$NWB#vicidial_campaigns-dial_method$NWE</td></tr>\n";

	echo "<tr bgcolor=#BDFFBD><td align=right>Nivel del Auto-Dial: </td><td align=left><select size=1 name=auto_dial_level><option >0</option><option>1</option><option>1.1</option><option>1.2</option><option>1.3</option><option>1.4</option><option>1.5</option><option>1.6</option><option>1.7</option><option>1.8</option><option>1.9</option><option>2.0</option><option>2.2</option><option>2.5</option><option>2.7</option><option>3.0</option><option>3.5</option><option>4.0</option><option SELECTED>$auto_dial_level</option></select>(0 = off)$NWB#vicidial_campaigns-auto_dial_level$NWE</td></tr>\n";

	echo "<tr bgcolor=#BDFFBD><td align=right>Adapte El Modificante De la Intensidad: </td><td align=left><select size=1 name=adaptive_intensity>\n";
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

	echo "<tr bgcolor=#B6D3FC><td align=right>Consiga El Lanzamiento De la Llamada: </td><td align=left>$get_call_launch</td></tr>\n";

	echo "<tr bgcolor=#B6D3FC><td align=center colspan=2><input type=submit name=ENVIAR value=ENVIAR></td></tr>\n";
	echo "</TABLE></center></FORM>\n";

	echo "<center>\n";
	echo "<br><b>LISTAS DENTRO DE ESTA CAMPAÑA: &nbsp; $NWB#vicidial_campaign_lists$NWE</b><br>\n";
	echo "<TABLE width=400 cellspacing=3>\n";
	echo "<tr><td>ID DE LA LISTA</td><td>NOMBRE DE LA LISTA</td><td>ACTIVO</td></tr>\n";

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
	echo "Esta campaña tiene $active_lists listas activas y $inactive_lists listas inactivas<br><br>\n";


	if ($display_dialable_count == 'Y')
		{
		### call function to calculate and print dialable leads
		dialable_leads($DB,$link,$local_call_time,$dial_statuses,$camp_lists,$fSQL);
		echo " - <font size=1><a href=\"$PHP_SELF?ADD=34&campaign_id=$campaign_id&stage=hide_dialable\">PIEL</a></font><BR><BR>";
		}
	else
		{
		echo "<a href=\"$PHP_SELF?ADD=73&campaign_id=$campaign_id\" target=\"_blank\">Popup Dialable Leads Count</a>";
		echo " - <font size=1><a href=\"$PHP_SELF?ADD=31&campaign_id=$campaign_id&stage=show_dialable\">DEMOSTRACIÓN</a></font><BR><BR>";
		}



		$stmt="SELECT count(*) FROM vicidial_hopper where campaign_id='$campaign_id' and status IN('READY')";
		if ($DB) {echo "$stmt\n";}
		$rslt=mysql_query($stmt, $link);
		$rowx=mysql_fetch_row($rslt);
		$hopper_leads = "$rowx[0]";

	echo "Esta campaña tiene $hopper_leads Leads en el Hopper<br><br>\n";
	echo "<a href=\"./AST_VICIDIAL_hopperlist.php?group=$campaign_id\">Chasque aquí para ver qué plomos están en la tolva ahora</a><br><br>\n";
	echo "<a href=\"$PHP_SELF?ADD=81&campaign_id=$campaign_id\">Chasque aquí para ver todos los asimientos del servicio repetido en esta campaña</a><BR><BR>\n";
	echo "<a href=\"./AST_VDADstats.php?group=$campaign_id\">Click here to see a VDAD report for this campaign</a><BR><BR>\n";
	echo "</b></center>\n";

	echo "<br>\n";

	echo "<a href=\"$PHP_SELF?ADD=52&campaign_id=$campaign_id\">REGISTRE TODOS LOS AGENTES FUERA DE ESTA CAMPAÑA</a><BR><BR>\n";


	if ($LOGdelete_campaigns > 0)
		{
		echo "<br><br><a href=\"$PHP_SELF?ADD=51&campaign_id=$campaign_id\">SUPRIMA ESTA CAMPAÑA</a>\n";
		}
	}
	else
	{
	echo "Usted no tiene permiso de visión esta página\n";
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


	echo "<br>MODIFICAR UN REGISTRO DE LAS LISTAS: $row[0]<form action=$PHP_SELF method=POST>\n";
	echo "<input type=hidden name=ADD value=411>\n";
	echo "<input type=hidden name=list_id value=\"$row[0]\">\n";
	echo "<input type=hidden name=old_campaign_id value=\"$row[2]\">\n";
	echo "<center><TABLE width=$section_width cellspacing=3>\n";
	echo "<tr bgcolor=#B6D3FC><td align=right>ID De la Lista: </td><td align=left><b>$row[0]</b>$NWB#vicidial_lists-list_id$NWE</td></tr>\n";
	echo "<tr bgcolor=#B6D3FC><td align=right>Nombre De la Lista: </td><td align=left><input type=text name=list_name size=20 maxlength=20 value=\"$row[1]\">$NWB#vicidial_lists-list_name$NWE</td></tr>\n";
	echo "<tr bgcolor=#B6D3FC><td align=right>Descripción De la Lista: </td><td align=left><input type=text name=list_description size=30 maxlength=255 value=\"$list_description\">$NWB#vicidial_lists-list_description$NWE</td></tr>\n";
	echo "<tr bgcolor=#B6D3FC><td align=right><a href=\"$PHP_SELF?ADD=34&campaign_id=$campaign_id\">Campaña</a>: </td><td align=left><select size=1 name=campaign_id>\n";

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
	echo "<tr bgcolor=#B6D3FC><td align=right>Activo: </td><td align=left><select size=1 name=active><option>Y</option><option>N</option><option SELECTED>$active</option></select>$NWB#vicidial_lists-active$NWE</td></tr>\n";
	echo "<tr bgcolor=#B6D3FC><td align=right>Reiniciar el Lead-Called-Status para esta lista: </td><td align=left><select size=1 name=reset_list><option>Y</option><option SELECTED>N</option></select>$NWB#vicidial_lists-reset_list$NWE</td></tr>\n";
	echo "<tr bgcolor=#B6D3FC><td align=right>Fecha Del Cambio De la Lista: </td><td align=left>$list_changedate &nbsp; $NWB#vicidial_lists-list_changedate$NWE</td></tr>\n";
	echo "<tr bgcolor=#B6D3FC><td align=right>List Last Call Date: </td><td align=left>$list_lastcalldate &nbsp; $NWB#vicidial_lists-list_lastcalldate$NWE</td></tr>\n";
	echo "<tr bgcolor=#B6D3FC><td align=center colspan=2><input type=submit name=ENVIAR value=ENVIAR></td></tr>\n";
	echo "</TABLE></center>\n";

	echo "<center>\n";
	echo "<br><b>ESTADOS DENTRO DE ESTA LISTA:</b><br>\n";
	echo "<TABLE width=500 cellspacing=3>\n";
	echo "<tr><td>ESTADO</td><td>NOMBRE DEL ESTADO</td><td>LLAMADO</td><td>NO LLAMADO</td></tr>\n";

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

	echo "<tr><td colspan=2><font size=1>SUBTOTALES</td><td><font size=1>$lead_list[Y_count]</td><td><font size=1>$lead_list[N_count]</td></tr>\n";
	echo "<tr bgcolor=\"#9BB9FB\"><td><font size=1>TOTAL</td><td colspan=3 align=center><font size=1>$lead_list[count]</td></tr>\n";

	echo "</table></center><br>\n";
	unset($lead_list);


	echo "<center>\n";
	echo "<br><b>ZONAS DE TIEMPO DENTRO DE ESTA LISTA:</b><br>\n";
	echo "<TABLE width=500 cellspacing=3>\n";
	echo "<tr><td>DESPLAZAMIENTO GMT AHORA (tiempo local)</td><td>LLAMADO</td><td>NO LLAMADO</td></tr>\n";

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

	echo "<tr><td><font size=1>SUBTOTALES</td><td><font size=1>$lead_list[Y_count]</td><td><font size=1>$lead_list[N_count]</td></tr>\n";
	echo "<tr bgcolor=\"#9BB9FB\"><td><font size=1>TOTAL</td><td colspan=2 align=center><font size=1>$lead_list[count]</td></tr>\n";

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
	echo "<br><b>LLAMADAS  REALIZADAS DENTRO DE ESTA LISTA:</b><br>\n";
	echo "<TABLE width=500 cellspacing=1>\n";
	echo "<tr><td align=left><font size=1>ESTADO</td><td align=center><font size=1>NOMBRE DEL ESTADO</td>";
	$first = $all_called_first;
	while ($first <= $all_called_last)
		{
		if (eregi("1$|3$|5$|7$|9$", $first)) {$AB='bgcolor="#AFEEEE"';} 
		else{$AB='bgcolor="#E0FFFF"';}
		echo "<td align=center $AB><font size=1>$first</td>";
		$first++;
		}
	echo "<td align=center><font size=1>SUBTOTAL</td></tr>\n";

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

	echo "<tr><td align=center colspan=2><b><font size=1>TOTAL</td>";
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
		echo "<br><br><a href=\"$PHP_SELF?ADD=511&list_id=$list_id\">SUPRIMA ESTA LISTA</a>\n";
		}
	}
	else
	{
	echo "Usted no tiene permiso de visión esta página\n";
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

	echo "<br>MODIFICAR UN REGISTRO DE LOS GRUPOS: $row[0]<form action=$PHP_SELF method=POST>\n";
	echo "<input type=hidden name=ADD value=4111>\n";
	echo "<input type=hidden name=group_id value=\"$row[0]\">\n";
	echo "<center><TABLE width=$section_width cellspacing=3>\n";
	echo "<tr bgcolor=#B6D3FC><td align=right>ID De Grupo: </td><td align=left><b>$row[0]</b>$NWB#vicidial_inbound_groups-group_id$NWE</td></tr>\n";
	echo "<tr bgcolor=#B6D3FC><td align=right>Nombre De Grupo: </td><td align=left><input type=text name=group_name size=30 maxlength=30 value=\"$row[1]\">$NWB#vicidial_inbound_groups-group_name$NWE</td></tr>\n";
	echo "<tr bgcolor=#B6D3FC><td align=right>Color Del Grupo: </td><td align=left bgcolor=\"$row[2]\"><input type=text name=group_color size=7 maxlength=7 value=\"$row[2]\">$NWB#vicidial_inbound_groups-group_color$NWE</td></tr>\n";
	echo "<tr bgcolor=#B6D3FC><td align=right>Activo: </td><td align=left><select size=1 name=active><option>Y</option><option>N</option><option SELECTED>$active</option></select>$NWB#vicidial_inbound_groups-active$NWE</td></tr>\n";
	echo "<tr bgcolor=#B6D3FC><td align=right>Formulario Web: </td><td align=left><input type=text name=web_form_address size=50 maxlength=255 value=\"$web_form_address\">$NWB#vicidial_inbound_groups-web_form_address$NWE</td></tr>\n";
	echo "<tr bgcolor=#B6D3FC><td align=right>Llamar al Siguiente  Agente: </td><td align=left><select size=1 name=next_agent_call><option >random</option><option>oldest_call_start</option><option>oldest_call_finish</option><option>overall_user_level</option><option SELECTED>$next_agent_call</option></select>$NWB#vicidial_inbound_groups-next_agent_call$NWE</td></tr>\n";
	echo "<tr bgcolor=#B6D3FC><td align=right>Mostrar Fronter: </td><td align=left><select size=1 name=fronter_display><option>Y</option><option>N</option><option SELECTED>$fronter_display</option></select>$NWB#vicidial_inbound_groups-fronter_display$NWE</td></tr>\n";

	echo "<tr bgcolor=#B6D3FC><td align=right><a href=\"$PHP_SELF?ADD=3111111&script_id=$script_id\">Script</a>: </td><td align=left><select size=1 name=script_id>\n";
	echo "$scripts_list";
	echo "<option selected value=\"$script_id\">$script_id - $scriptname_list[$script_id]</option>\n";
	echo "</select>$NWB#vicidial_inbound_groups-ingroup_script$NWE</td></tr>\n";
	echo "<tr bgcolor=#B6D3FC><td align=right>Consiga El Lanzamiento De la Llamada: </td><td align=left><select size=1 name=get_call_launch><option selected>NONE</option><option>SCRIPT</option><option>WEBFORM</option><option selected>$get_call_launch</option></select>$NWB#vicidial_inbound_groups-get_call_launch$NWE</td></tr>\n";

	echo "<tr bgcolor=#B6D3FC><td align=right>Transfiera -Conf DTMF 1: </td><td align=left><input type=text name=xferconf_a_dtmf size=20 maxlength=50 value=\"$xferconf_a_dtmf\">$NWB#vicidial_inbound_groups-xferconf_a_dtmf$NWE</td></tr>\n";

	echo "<tr bgcolor=#B6D3FC><td align=right>Transfiera -Conf El Número 1: </td><td align=left><input type=text name=xferconf_a_number size=20 maxlength=50 value=\"$xferconf_a_number\">$NWB#vicidial_inbound_groups-xferconf_a_dtmf$NWE</td></tr>\n";

	echo "<tr bgcolor=#B6D3FC><td align=right>Transfiera -Conf DTMF 2: </td><td align=left><input type=text name=xferconf_b_dtmf size=20 maxlength=50 value=\"$xferconf_b_dtmf\">$NWB#vicidial_inbound_groups-xferconf_a_dtmf$NWE</td></tr>\n";

	echo "<tr bgcolor=#B6D3FC><td align=right>Transfiera -Conf El Número 2: </td><td align=left><input type=text name=xferconf_b_number size=20 maxlength=50 value=\"$xferconf_b_number\">$NWB#vicidial_inbound_groups-xferconf_a_dtmf$NWE</td></tr>\n";

	echo "<tr bgcolor=#B6D3FC><td align=right>Segundos De la Llamada De la Gota: </td><td align=left><input type=text name=drop_call_seconds size=5 maxlength=4 value=\"$drop_call_seconds\">$NWB#vicidial_inbound_groups-drop_call_seconds$NWE</td></tr>\n";

	echo "<tr bgcolor=#B6D3FC><td align=right>Buzón de Voz: </td><td align=left><input type=text name=voicemail_ext size=10 maxlength=10 value=\"$voicemail_ext\">$NWB#vicidial_inbound_groups-voicemail_ext$NWE</td></tr>\n";

	echo "<tr bgcolor=#B6D3FC><td align=right>Utilice El Mensaje De la Gota: </td><td align=left><select size=1 name=drop_message><option>Y</option><option>N</option><option SELECTED>$drop_message</option></select>$NWB#vicidial_inbound_groups-drop_message$NWE</td></tr>\n";

	echo "<tr bgcolor=#B6D3FC><td align=right>Gota Exten: </td><td align=left><input type=text name=drop_exten size=10 maxlength=20 value=\"$drop_exten\">$NWB#vicidial_inbound_groups-drop_exten$NWE</td></tr>\n";


	echo "<tr bgcolor=#B6D3FC><td align=center colspan=2><input type=submit name=ENVIAR value=ENVIAR></td></tr>\n";
	echo "</TABLE></center>\n";

	echo "</table></center><br>\n";

	echo "<a href=\"./AST_CLOSERstats.php?group=$group_id\">Click here to see a report for this campaign</a><BR><BR>\n";

	echo "<center><b>\n";

	if ($LOGdelete_ingroups > 0)
		{
		echo "<br><br><a href=\"$PHP_SELF?ADD=53&campaign_id=$group_id&stage=IN\">EMERGENCY VDAC CLEAR FOR THIS IN-GROUP</a><BR><BR>\n";
		echo "<br><br><a href=\"$PHP_SELF?ADD=5111&group_id=$group_id\">SUPRIMA A ESTE EN-GRUPO</a>\n";
		}
	}
	else
	{
	echo "Usted no tiene permiso de visión esta página\n";
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

	echo "<br>MODIFICAR UNA ENTRADA DE LOS AGENTES REMOTOS: $row[0]<form action=$PHP_SELF method=POST>\n";
	echo "<input type=hidden name=ADD value=41111>\n";
	echo "<input type=hidden name=remote_agent_id value=\"$row[0]\">\n";
	echo "<center><TABLE width=$section_width cellspacing=3>\n";
	echo "<tr bgcolor=#B6D3FC><td align=right>Comienzo Del ID del usuario: </td><td align=left><input type=text name=user_start size=6 maxlength=6 value=\"$user_start\"> (Solamente números, incremented)$NWB#vicidial_remote_agents-user_start$NWE</td></tr>\n";
	echo "<tr bgcolor=#B6D3FC><td align=right>Número de líneas: </td><td align=left><input type=text name=number_of_lines size=3 maxlength=3 value=\"$number_of_lines\"> (Solamente números)$NWB#vicidial_remote_agents-number_of_lines$NWE</td></tr>\n";
	echo "<tr bgcolor=#B6D3FC><td align=right>IP Del Servidor: </td><td align=left><select size=1 name=server_ip>\n";
	echo "$servers_list";
	echo "<option SELECTED>$row[3]</option>\n";
	echo "</select>$NWB#vicidial_remote_agents-server_ip$NWE</td></tr>\n";
	echo "<tr bgcolor=#B6D3FC><td align=right>Extensión Externa: </td><td align=left><input type=text name=conf_exten size=20 maxlength=20 value=\"$conf_exten\"> (número del dial plan para alcanzar agentes)$NWB#vicidial_remote_agents-conf_exten$NWE</td></tr>\n";
	echo "<tr bgcolor=#B6D3FC><td align=right>Estado: </td><td align=left><select size=1 name=status><option SELECTED>ACTIVO</option><option>INACTIVE</option><option SELECTED>$status</option></select>$NWB#vicidial_remote_agents-status$NWE</td></tr>\n";
	echo "<tr bgcolor=#B6D3FC><td align=right>Campaña: </td><td align=left><select size=1 name=campaign_id>\n";
	echo "$campaigns_list";
	echo "<option SELECTED>$campaign_id</option>\n";
	echo "</select>$NWB#vicidial_remote_agents-campaign_id$NWE</td></tr>\n";
	echo "<tr bgcolor=#B6D3FC><td align=right>Grupos De entrada: </td><td align=left>\n";
	echo "$groups_list";
	echo "$NWB#vicidial_remote_agents-closer_campaigns$NWE</td></tr>\n";
	echo "<tr bgcolor=#B6D3FC><td align=center colspan=2><input type=submit name=ENVIAR value=ENVIAR></td></tr>\n";
	echo "</TABLE></center>\n";
	echo "NOTA: Puede tomar hasta 30 segundos para los cambios sometidos en esta pantalla para ir viva\n";


	if ($LOGdelete_remote_agents > 0)
		{
		echo "<br><br><a href=\"$PHP_SELF?ADD=51111&remote_agent_id=$remote_agent_id\">SUPRIMA ESTE AGENTE ALEJADO</a>\n";
		}
	}
	else
	{
	echo "Usted no tiene permiso de visión esta página\n";
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

	echo "<br>MODIFICAR UNA ENTRADA EN LOS GRUPOS DE USUARIOS<form action=$PHP_SELF method=POST>\n";
	echo "<input type=hidden name=ADD value=411111>\n";
	echo "<input type=hidden name=OLDuser_group value=\"$user_group\">\n";
	echo "<center><TABLE width=$section_width cellspacing=3>\n";
	echo "<tr bgcolor=#B6D3FC><td align=right>Grupo: </td><td align=left><input type=text name=user_group size=15 maxlength=20 value=\"$user_group\"> (sin espacios o signos de puntuación)$NWB#vicidial_user_groups-user_group$NWE</td></tr>\n";
	echo "<tr bgcolor=#B6D3FC><td align=right>Descripción: </td><td align=left><input type=text name=group_name size=40 maxlength=40 value=\"$group_name\"> (Descripción del grupo)$NWB#vicidial_user_groups-group_name$NWE</td></tr>\n";
	echo "<tr bgcolor=#B6D3FC><td align=right>Campañas Permitidas: </td><td align=left>\n";
	echo "$campaigns_list";
	echo "$NWB#vicidial_user_groups-allowed_campaigns$NWE</td></tr>\n";
	echo "<tr bgcolor=#B6D3FC><td align=center colspan=2><input type=submit name=ENVIAR value=ENVIAR></td></tr>\n";
	echo "</TABLE></center>\n";


	### list of users in this user group

		$active_confs = 0;
		$stmt="SELECT user,full_name,user_level from vicidial_users where user_group='$user_group'";
		$rsltx=mysql_query($stmt, $link);
		$users_to_print = mysql_num_rows($rsltx);

		echo "<center>\n";
		echo "<br><b>USUARIOS DENTRO DE ESTE GRUPO DE USUARIO: $users_to_print</b><br>\n";
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
		echo "<br><br><a href=\"$PHP_SELF?ADD=511111&user_group=$user_group\">SUPRIMA A ESTE GRUPO DE USUARIO</a>\n";
		}
	}
	else
	{
	echo "Usted no tiene permiso de visión esta página\n";
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

	echo "<br>MODIFIQUE Una ESCRITURA<form name=scriptForm action=$PHP_SELF method=POST>\n";
	echo "<input type=hidden name=ADD value=4111111>\n";
	echo "<input type=hidden name=script_id value=\"$script_id\">\n";
	echo "<tr bgcolor=#B6D3FC><td align=right>Identificación De la Escritura:: </td><td align=left><B>$script_id</B>$NWB#vicidial_scripts-script_name$NWE</td></tr>\n";
	echo "<tr bgcolor=#B6D3FC><td align=right>Nombre de la escritura: </td><td align=left><input type=text name=script_name size=40 maxlength=50 value=\"$script_name\"> (título de la escritura)$NWB#vicidial_scripts-script_name$NWE</td></tr>\n";
	echo "<tr bgcolor=#B6D3FC><td align=right>Comentarios de la escritura: </td><td align=left><input type=text name=script_comments size=50 maxlength=255 value=\"$script_comments\"> $NWB#vicidial_scripts-script_comments$NWE</td></tr>\n";
	echo "<tr bgcolor=#B6D3FC><td align=right>Activo: </td><td align=left><select size=1 name=active><option SELECTED>Y</option><option>N</option><option selected>$active</option></select>$NWB#vicidial_scripts-active$NWE</td></tr>\n";
	echo "<tr bgcolor=#B6D3FC><td align=right>Texto de la escritura: <BR><BR><B><a href=\"javascript:openNewWindow('$PHP_SELF?ADD=7111111&script_id=$script_id')\">Escritura De la Inspección previo</a></B> </td><td align=left>";
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
	echo "<tr bgcolor=#B6D3FC><td align=center colspan=2><input type=submit name=ENVIAR value=ENVIAR></td></tr>\n";
	echo "</TABLE></center>\n";

	if ($LOGdelete_scripts > 0)
		{
		echo "<br><br><a href=\"$PHP_SELF?ADD=5111111&script_id=$script_id\">SUPRIMA ESTA ESCRITURA</a>\n";
		}
	}
	else
	{
	echo "Usted no tiene permiso de visión esta página\n";
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

	echo "<br>MODIFIQUE Un FILTRO<form action=$PHP_SELF method=POST>\n";
	echo "<input type=hidden name=ADD value=41111111>\n";
	echo "<input type=hidden name=lead_filter_id value=\"$lead_filter_id\">\n";
	echo "<tr bgcolor=#B6D3FC><td align=right>Identificación Del Filtro:</td><td align=left><B>$lead_filter_id</B>$NWB#vicidial_lead_filters-lead_filter_id$NWE</td></tr>\n";
	echo "<tr bgcolor=#B6D3FC><td align=right>Nombre Del Filtro:</td><td align=left><input type=text name=lead_filter_name size=40 maxlength=50 value=\"$lead_filter_name\"> (descripción corta del filtro)$NWB#vicidial_lead_filters-lead_filter_name$NWE</td></tr>\n";
	echo "<tr bgcolor=#B6D3FC><td align=right>Comentarios Del Filtro: </td><td align=left><input type=text name=lead_filter_comments size=50 maxlength=255 value=\"$lead_filter_comments\"> $NWB#vicidial_lead_filters-lead_filter_comments$NWE</td></tr>\n";
	echo "<tr bgcolor=#B6D3FC><td align=right>Filtro Sql:</td><td align=left><TEXTAREA NAME=lead_filter_sql ROWS=20 COLS=50>$lead_filter_sql</TEXTAREA> $NWB#vicidial_lead_filters-lead_filter_sql$NWE</td></tr>\n";
	echo "<tr bgcolor=#B6D3FC><td align=center colspan=2><input type=submit name=ENVIAR value=ENVIAR></td></tr>\n";
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
	echo "<br>PRUEBE EN CAMPAÑA: <form action=$PHP_SELF method=POST target=\"_blank\">\n";
	echo "<input type=hidden name=lead_filter_id value=\"$lead_filter_id\">\n";
	echo "<input type=hidden name=ADD value=\"73\">\n";
	echo "<select size=1 name=campaign_id>\n";
	echo "$campaigns_list";
	echo "</select>\n";
	echo "<input type=submit name=ENVIAR value=ENVIAR>\n";


	if ($LOGdelete_filters > 0)
		{
		echo "<br><br><a href=\"$PHP_SELF?ADD=51111111&lead_filter_id=$lead_filter_id\">SUPRIMA ESTE FILTRO</a>\n";
		}
	}
	else
	{
	echo "Usted no tiene permiso de visión esta página\n";
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
	echo "Regla Del Estado Agregada: $state_rule<BR>\n";
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
	echo "Regla Del Estado Quitada: $state_rule<BR>\n";
	}

$ADD=311111111;
}
else
{
echo "Le no autorizan a visión esta página. Vaya por favor detrás.";
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

echo "<br>MODIFIQUE Un RATO De la LLAMADA<form action=$PHP_SELF method=POST>\n";
echo "<input type=hidden name=ADD value=411111111>\n";
echo "<input type=hidden name=call_time_id value=\"$call_time_id\">\n";
echo "<tr bgcolor=#B6D3FC><td align=right>Identificación Del Tiempo De la Llamada: </td><td align=left colspan=3><B>$call_time_id</B>$NWB#vicidial_call_times-call_time_id$NWE</td></tr>\n";
echo "<tr bgcolor=#B6D3FC><td align=right>Nombre Del Tiempo De la Llamada: </td><td align=left colspan=3><input type=text name=call_time_name size=40 maxlength=50 value=\"$call_time_name\"> (descripción corta del tiempo de la llamada)$NWB#vicidial_call_times-call_time_name$NWE</td></tr>\n";
echo "<tr bgcolor=#B6D3FC><td align=right>Comentarios Del Tiempo De la Llamada: </td><td align=left colspan=3><input type=text name=call_time_comments size=50 maxlength=255 value=\"$call_time_comments\"> $NWB#vicidial_call_times-call_time_comments$NWE</td></tr>\n";
echo "<tr bgcolor=#B6D3FC><td align=right>Comienzo Del Defecto:</td><td align=left><input type=text name=ct_default_start size=5 maxlength=4 value=\"$ct_default_start\"> </td><td align=right>Parada Del Defecto:</td><td align=left><input type=text name=ct_default_stop size=5 maxlength=4 value=\"$ct_default_stop\"> $NWB#vicidial_call_times-ct_default_start$NWE</td></tr>\n";
echo "<tr bgcolor=#B6D3FC><td align=right>Comienzo De Domingo:</td><td align=left><input type=text name=ct_sunday_start size=5 maxlength=4 value=\"$ct_sunday_start\"> </td><td align=right>Parada De Domingo:</td><td align=left><input type=text name=ct_sunday_stop size=5 maxlength=4 value=\"$ct_sunday_stop\"> $NWB#vicidial_call_times-ct_sunday_start$NWE</td></tr>\n";
echo "<tr bgcolor=#B6D3FC><td align=right>Comienzo De Lunes:</td><td align=left><input type=text name=ct_monday_start size=5 maxlength=4 value=\"$ct_monday_start\"> </td><td align=right>Parada De Lunes:</td><td align=left><input type=text name=ct_monday_stop size=5 maxlength=4 value=\"$ct_monday_stop\"> $NWB#vicidial_call_times-ct_sunday_start$NWE</td></tr>\n";
echo "<tr bgcolor=#B6D3FC><td align=right>Comienzo De Martes:</td><td align=left><input type=text name=ct_tuesday_start size=5 maxlength=4 value=\"$ct_tuesday_start\"> </td><td align=right>Parada De Martes:</td><td align=left><input type=text name=ct_tuesday_stop size=5 maxlength=4 value=\"$ct_tuesday_stop\"> $NWB#vicidial_call_times-ct_sunday_start$NWE</td></tr>\n";
echo "<tr bgcolor=#B6D3FC><td align=right>Comienzo De Miércoles:</td><td align=left><input type=text name=ct_wednesday_start size=5 maxlength=4 value=\"$ct_wednesday_start\"> </td><td align=right>Parada De Miércoles:</td><td align=left><input type=text name=ct_wednesday_stop size=5 maxlength=4 value=\"$ct_wednesday_stop\"> $NWB#vicidial_call_times-ct_sunday_start$NWE</td></tr>\n";
echo "<tr bgcolor=#B6D3FC><td align=right>Thursday Start:</td><td align=left><input type=text name=ct_thursday_start size=5 maxlength=4 value=\"$ct_thursday_start\"> </td><td align=right>Parada De Jueves:</td><td align=left><input type=text name=ct_thursday_stop size=5 maxlength=4 value=\"$ct_thursday_stop\"> $NWB#vicidial_call_times-ct_sunday_start$NWE</td></tr>\n";
echo "<tr bgcolor=#B6D3FC><td align=right>Comienzo De Viernes:</td><td align=left><input type=text name=ct_friday_start size=5 maxlength=4 value=\"$ct_friday_start\"> </td><td align=right>Parada De Viernes:</td><td align=left><input type=text name=ct_friday_stop size=5 maxlength=4 value=\"$ct_friday_stop\"> $NWB#vicidial_call_times-ct_sunday_start$NWE</td></tr>\n";
echo "<tr bgcolor=#B6D3FC><td align=right>Comienzo De Sábado:</td><td align=left><input type=text name=ct_saturday_start size=5 maxlength=4 value=\"$ct_saturday_start\"> </td><td align=right>Parada De Sábado:</td><td align=left><input type=text name=ct_saturday_stop size=5 maxlength=4 value=\"$ct_saturday_stop\"> $NWB#vicidial_call_times-ct_sunday_start$NWE</td></tr>\n";
echo "<tr bgcolor=#B6D3FC><td align=center colspan=4><input type=submit name=ENVIAR value=ENVIAR></FORM></td></tr>\n";

$ct_srs=1;
$b=0;
$srs_SQL ='';
if (strlen($ct_state_call_times)>2)
	{
	$state_rules = explode('|',$ct_state_call_times);
	$ct_srs = ((count($state_rules)) - 1);
	}
echo "<tr bgcolor=#B6D3FC><td align=center rowspan=$ct_srs>Definiciones activas del tiempo de la llamada del estado para estoexpediente: </td>\n";
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
echo "<td align=center colspan=4><input type=submit name=ENVIAR value=ENVIAR></FORM></td></tr>\n";

echo "</TABLE><BR><BR>\n";
echo "<B>CAMPAÑAS USANDO ESTE TIEMPO DE LA LLAMADA:</B><BR>\n";
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
	echo "<br><br><a href=\"$PHP_SELF?ADD=511111111&call_time_id=$call_time_id\">SUPRIMA ESTA DEFINICIÓN DEL TIEMPO DE LA LLAMADA</a>\n";
	}
}
else
{
echo "Le no autorizan a visión esta página. Vaya por favor detrás.";
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

echo "<br>_ MODIFICAR Uno ESTADO LLAMAR TIEMPO<form action=$PHP_SELF method=POST>\n";
echo "<input type=hidden name=ADD value=4111111111>\n";
echo "<input type=hidden name=call_time_id value=\"$call_time_id\">\n";
echo "<tr bgcolor=#B6D3FC><td align=right>Identificación Del Tiempo De la Llamada: </td><td align=left colspan=3><B>$call_time_id</B>$NWB#vicidial_call_times-call_time_id$NWE</td></tr>\n";
echo "<tr bgcolor=#B6D3FC><td align=right>State Call Time State: </td><td align=left colspan=3><input type=text name=state_call_time_state size=4 maxlength=2 value=\"$state_call_time_state\"> $NWB#vicidial_call_times-state_call_time_state$NWE</td></tr>\n";
echo "<tr bgcolor=#B6D3FC><td align=right>_ Estado Llamar Tiempo Nombre: </td><td align=left colspan=3><input type=text name=call_time_name size=40 maxlength=50 value=\"$call_time_name\"> (descripción corta del tiempo de la llamada)$NWB#vicidial_call_times-call_time_name$NWE</td></tr>\n";
echo "<tr bgcolor=#B6D3FC><td align=right>Comentarios Del Tiempo De la Llamada Del Estado: </td><td align=left colspan=3><input type=text name=call_time_comments size=50 maxlength=255 value=\"$call_time_comments\"> $NWB#vicidial_call_times-call_time_comments$NWE</td></tr>\n";
echo "<tr bgcolor=#B6D3FC><td align=right>Comienzo Del Defecto:</td><td align=left><input type=text name=ct_default_start size=5 maxlength=4 value=\"$ct_default_start\"> </td><td align=right>Parada Del Defecto:</td><td align=left><input type=text name=ct_default_stop size=5 maxlength=4 value=\"$ct_default_stop\"> $NWB#vicidial_call_times-ct_default_start$NWE</td></tr>\n";
echo "<tr bgcolor=#B6D3FC><td align=right>Comienzo De Domingo:</td><td align=left><input type=text name=ct_sunday_start size=5 maxlength=4 value=\"$ct_sunday_start\"> </td><td align=right>Parada De Domingo:</td><td align=left><input type=text name=ct_sunday_stop size=5 maxlength=4 value=\"$ct_sunday_stop\"> $NWB#vicidial_call_times-ct_sunday_start$NWE</td></tr>\n";
echo "<tr bgcolor=#B6D3FC><td align=right>Comienzo De Lunes:</td><td align=left><input type=text name=ct_monday_start size=5 maxlength=4 value=\"$ct_monday_start\"> </td><td align=right>Parada De Lunes:</td><td align=left><input type=text name=ct_monday_stop size=5 maxlength=4 value=\"$ct_monday_stop\"> $NWB#vicidial_call_times-ct_sunday_start$NWE</td></tr>\n";
echo "<tr bgcolor=#B6D3FC><td align=right>Comienzo De Martes:</td><td align=left><input type=text name=ct_tuesday_start size=5 maxlength=4 value=\"$ct_tuesday_start\"> </td><td align=right>Parada De Martes:</td><td align=left><input type=text name=ct_tuesday_stop size=5 maxlength=4 value=\"$ct_tuesday_stop\"> $NWB#vicidial_call_times-ct_sunday_start$NWE</td></tr>\n";
echo "<tr bgcolor=#B6D3FC><td align=right>Comienzo De Miércoles:</td><td align=left><input type=text name=ct_wednesday_start size=5 maxlength=4 value=\"$ct_wednesday_start\"> </td><td align=right>Parada De Miércoles:</td><td align=left><input type=text name=ct_wednesday_stop size=5 maxlength=4 value=\"$ct_wednesday_stop\"> $NWB#vicidial_call_times-ct_sunday_start$NWE</td></tr>\n";
echo "<tr bgcolor=#B6D3FC><td align=right>Thursday Start:</td><td align=left><input type=text name=ct_thursday_start size=5 maxlength=4 value=\"$ct_thursday_start\"> </td><td align=right>Parada De Jueves:</td><td align=left><input type=text name=ct_thursday_stop size=5 maxlength=4 value=\"$ct_thursday_stop\"> $NWB#vicidial_call_times-ct_sunday_start$NWE</td></tr>\n";
echo "<tr bgcolor=#B6D3FC><td align=right>Comienzo De Viernes:</td><td align=left><input type=text name=ct_friday_start size=5 maxlength=4 value=\"$ct_friday_start\"> </td><td align=right>Parada De Viernes:</td><td align=left><input type=text name=ct_friday_stop size=5 maxlength=4 value=\"$ct_friday_stop\"> $NWB#vicidial_call_times-ct_sunday_start$NWE</td></tr>\n";
echo "<tr bgcolor=#B6D3FC><td align=right>Comienzo De Sábado:</td><td align=left><input type=text name=ct_saturday_start size=5 maxlength=4 value=\"$ct_saturday_start\"> </td><td align=right>Parada De Sábado:</td><td align=left><input type=text name=ct_saturday_stop size=5 maxlength=4 value=\"$ct_saturday_stop\"> $NWB#vicidial_call_times-ct_sunday_start$NWE</td></tr>\n";

echo "<tr bgcolor=#B6D3FC><td align=center colspan=4><input type=submit name=ENVIAR value=ENVIAR></td></tr>\n";
echo "</TABLE><BR><BR>\n";
echo "<B>TIEMPOS DE LA LLAMADA USANDO ESTE TIEMPO DE LA LLAMADA DEL ESTADO:</B><BR>\n";
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
	echo "<br><br><a href=\"$PHP_SELF?ADD=5111111111&call_time_id=$call_time_id\">SUPRIMA ESTA DEFINICIÓN DEL TIEMPO DE LA LLAMADA DEL ESTADO</a>\n";
	}

}
else
{
echo "Le no autorizan a visión esta página. Vaya por favor detrás.";
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

	echo "<br>MODIFICANDO EL TELÉFONO: $row[1]<form action=$PHP_SELF method=POST>\n";
	echo "<input type=hidden name=ADD value=41111111111>\n";
	echo "<input type=hidden name=old_extension value=\"$row[0]\">\n";
	echo "<input type=hidden name=old_server_ip value=\"$row[5]\">\n";
	echo "<center><TABLE width=$section_width cellspacing=3>\n";
	echo "<tr bgcolor=#B6D3FC><td align=right>Extensión del teléfono: </td><td align=left><input type=text name=extension size=20 maxlength=100 value=\"$row[0]\">$NWB#phones-extension$NWE</td></tr>\n";
	echo "<tr bgcolor=#B6D3FC><td align=right>Número De Dial plan: </td><td align=left><input type=text name=dialplan_number size=15 maxlength=20 value=\"$row[1]\"> (Solamente dígitos)$NWB#phones-dialplan_number$NWE</td></tr>\n";
	echo "<tr bgcolor=#B6D3FC><td align=right>Buzón de voz: </td><td align=left><input type=text name=voicemail_id size=10 maxlength=10 value=\"$row[2]\"> (Solamente dígitos)$NWB#phones-voicemail_id$NWE</td></tr>\n";
	echo "<tr bgcolor=#B6D3FC><td align=right>CallerID De salida: </td><td align=left><input type=text name=outbound_cid size=10 maxlength=20 value=\"$row[65]\"> (Solamente dígitos)$NWB#phones-outbound_cid$NWE</td></tr>\n";
	echo "<tr bgcolor=#B6D3FC><td align=right>Dirección IP del teléfono: </td><td align=left><input type=text name=phone_ip size=20 maxlength=15 value=\"$row[3]\"> (optional)$NWB#phones-phone_ip$NWE</td></tr>\n";
	echo "<tr bgcolor=#B6D3FC><td align=right>Dirección IP del ordenador: </td><td align=left><input type=text name=computer_ip size=20 maxlength=15 value=\"$row[4]\"> (optional)$NWB#phones-computer_ip$NWE</td></tr>\n";
	echo "<tr bgcolor=#B6D3FC><td align=right><a href=\"$PHP_SELF?ADD=311111111111&server_ip=$row[5]\">IP Del Servidor</a>: </td><td align=left><select size=1 name=server_ip>\n";

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
	echo "<tr bgcolor=#B6D3FC><td align=right>GMT Local: </td><td align=left><select size=1 name=local_gmt><option>12.75</option><option>12.00</option><option>11.00</option><option>10.00</option><option>9.50</option><option>9.00</option><option>8.00</option><option>7.00</option><option>6.50</option><option>6.00</option><option>5.75</option><option>5.50</option><option>5.00</option><option>4.50</option><option>4.00</option><option>3.50</option><option>3.00</option><option>2.00</option><option>1.00</option><option>0.00</option><option>-1.00</option><option>-2.00</option><option>-3.00</option><option>-3.50</option><option>-4.00</option><option>-5.00</option><option>-6.00</option><option>-7.00</option><option>-8.00</option><option>-9.00</option><option>-10.00</option><option>-11.00</option><option>-12.00</option><option selected>$row[17]</option></select> (No ajustar para el DST)$NWB#phones-local_gmt$NWE</td></tr>\n";
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
	echo "<tr bgcolor=#B6D3FC><td align=right>Permita Los Mensajes de SIPSAK: </td><td align=left><select size=1 name=enable_sipsak_messages><option>1</option><option>0</option><option selected>$row[66]</option></select>$NWB#phones-enable_sipsak_messages$NWE</td></tr>\n";
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

	if ($LOGast_delete_phones > 0)
		{
		echo "<br><br><a href=\"$PHP_SELF?ADD=51111111111&extension=$extension&server_ip=$server_ip\">SUPRIMA ESTE TELÉFONO</a>\n";
		}
	}
	else
	{
	echo "Usted no tiene permiso de visión esta página\n";
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

	echo "<br>MODIFICAR UN REGISTRO DEL SERVIDOR: $row[0]<form action=$PHP_SELF method=POST>\n";
	echo "<input type=hidden name=ADD value=411111111111>\n";
	echo "<input type=hidden name=old_server_id value=\"$server_id\">\n";
	echo "<input type=hidden name=old_server_ip value=\"$row[2]\">\n";
	echo "<center><TABLE width=$section_width cellspacing=3>\n";
	echo "<tr bgcolor=#B6D3FC><td align=right>ID Del Servidor: </td><td align=left><input type=text name=server_id size=10 maxlength=10 value=\"$row[0]\">$NWB#servers-server_id$NWE</td></tr>\n";
	echo "<tr bgcolor=#B6D3FC><td align=right>Descripción Del Servidor: </td><td align=left><input type=text name=server_description size=30 maxlength=255 value=\"$row[1]\">$NWB#servers-server_description$NWE</td></tr>\n";
	echo "<tr bgcolor=#B6D3FC><td align=right>Dirección IP del Servidor: </td><td align=left><input type=text name=server_ip size=20 maxlength=15 value=\"$row[2]\">$NWB#servers-server_ip$NWE</td></tr>\n";
	echo "<tr bgcolor=#B6D3FC><td align=right>Activo: </td><td align=left><select size=1 name=active><option>Y</option><option>N</option><option selected>$row[3]</option></select>$NWB#servers-active$NWE</td></tr>\n";
	echo "<tr bgcolor=#B6D3FC><td align=right>Versión De Asterisk: </td><td align=left><input type=text name=asterisk_version size=20 maxlength=20 value=\"$row[4]\">$NWB#servers-asterisk_version$NWE</td></tr>\n";
	echo "<tr bgcolor=#B6D3FC><td align=right>Máx. Trunks en VICIDIAL: </td><td align=left><input type=text name=max_vicidial_trunks size=5 maxlength=4 value=\"$row[5]\">$NWB#servers-max_vicidial_trunks$NWE</td></tr>\n";
	echo "<tr bgcolor=#B6D3FC><td align=right>El Marcar Del Balance de VICIDIAL: </td><td align=left><select size=1 name=vicidial_balance_active><option>Y</option><option>N</option><option selected>$row[20]</option></select>$NWB#servers-vicidial_balance_active$NWE</td></tr>\n";
	echo "<tr bgcolor=#B6D3FC><td align=right>Balance Offlimits de VICIDIAL: </td><td align=left><input type=text name=balance_trunks_offlimits size=5 maxlength=4 value=\"$row[21]\">$NWB#servers-balance_trunks_offlimits$NWE</td></tr>\n";
	echo "<tr bgcolor=#B6D3FC><td align=right>Host Del Telnet: </td><td align=left><input type=text name=telnet_host size=20 maxlength=20 value=\"$row[6]\">$NWB#servers-telnet_host$NWE</td></tr>\n";
	echo "<tr bgcolor=#B6D3FC><td align=right>Puerto Del Telnet: </td><td align=left><input type=text name=telnet_port size=6 maxlength=5 value=\"$row[7]\">$NWB#servers-telnet_port$NWE</td></tr>\n";
	echo "<tr bgcolor=#B6D3FC><td align=right>Usuario Del Manager: </td><td align=left><input type=text name=ASTmgrUSERNAME size=20 maxlength=20 value=\"$row[8]\">$NWB#servers-ASTmgrUSERNAME$NWE</td></tr>\n";
	echo "<tr bgcolor=#B6D3FC><td align=right>Contraseña del Manager: </td><td align=left><input type=text name=ASTmgrSECRET size=20 maxlength=20 value=\"$row[9]\">$NWB#servers-ASTmgrSECRET$NWE</td></tr>\n";
	echo "<tr bgcolor=#B6D3FC><td align=right>Usuario del Updater del Manager: </td><td align=left><input type=text name=ASTmgrUSERNAMEupdate size=20 maxlength=20 value=\"$row[10]\">$NWB#servers-ASTmgrUSERNAMEupdate$NWE</td></tr>\n";
	echo "<tr bgcolor=#B6D3FC><td align=right>Usuario Listen del Manager: </td><td align=left><input type=text name=ASTmgrUSERNAMElisten size=20 maxlength=20 value=\"$row[11]\">$NWB#servers-ASTmgrUSERNAMElisten$NWE</td></tr>\n";
	echo "<tr bgcolor=#B6D3FC><td align=right>Usuario Send del Manager: </td><td align=left><input type=text name=ASTmgrUSERNAMEsend size=20 maxlength=20 value=\"$row[12]\">$NWB#servers-ASTmgrUSERNAMEsend$NWE</td></tr>\n";
	echo "<tr bgcolor=#B6D3FC><td align=right>GMT Local: </td><td align=left><select size=1 name=local_gmt><option>12.75</option><option>12.00</option><option>11.00</option><option>10.00</option><option>9.50</option><option>9.00</option><option>8.00</option><option>7.00</option><option>6.50</option><option>6.00</option><option>5.75</option><option>5.50</option><option>5.00</option><option>4.50</option><option>4.00</option><option>3.50</option><option>3.00</option><option>2.00</option><option>1.00</option><option>0.00</option><option>-1.00</option><option>-2.00</option><option>-3.00</option><option>-3.50</option><option>-4.00</option><option>-5.00</option><option>-6.00</option><option>-7.00</option><option>-8.00</option><option>-9.00</option><option>-10.00</option><option>-11.00</option><option>-12.00</option><option selected>$row[13]</option></select> (No ajustar para el DST)$NWB#servers-local_gmt$NWE</td></tr>\n";
	echo "<tr bgcolor=#B6D3FC><td align=right>Extensión de Vmail Dump : </td><td align=left><input type=text name=voicemail_dump_exten size=20 maxlength=20 value=\"$row[14]\">$NWB#servers-voicemail_dump_exten$NWE</td></tr>\n";
	echo "<tr bgcolor=#B6D3FC><td align=right>Extensión del AD de VICIDIAL: </td><td align=left><input type=text name=answer_transfer_agent size=20 maxlength=20 value=\"$row[15]\">$NWB#servers-answer_transfer_agent$NWE</td></tr>\n";
	echo "<tr bgcolor=#B6D3FC><td align=right>Contexto por Defecto: </td><td align=left><input type=text name=ext_context size=20 maxlength=20 value=\"$row[16]\">$NWB#servers-ext_context$NWE</td></tr>\n";
	echo "<tr bgcolor=#B6D3FC><td align=right>Funcionamiento Del Sistema: </td><td align=left><select size=1 name=sys_perf_log><option>Y</option><option>N</option><option selected>$row[17]</option></select>$NWB#servers-sys_perf_log$NWE</td></tr>\n";
	echo "<tr bgcolor=#B6D3FC><td align=right>Registros Del Servidor: </td><td align=left><select size=1 name=vd_server_logs><option>Y</option><option>N</option><option selected>$row[18]</option></select>$NWB#servers-vd_server_logs$NWE</td></tr>\n";
	echo "<tr bgcolor=#B6D3FC><td align=right>Salida de AGI: </td><td align=left><select size=1 name=agi_output><option>NONE</option><option>STDERR</option><option>FILE</option><option>BOTH</option><option selected>$row[19]</option></select>$NWB#servers-agi_output$NWE</td></tr>\n";
	echo "<tr bgcolor=#B6D3FC><td align=center colspan=2><input type=submit name=submit VALUE=ENVIAR></td></tr>\n";
	echo "</TABLE></center></form>\n";


	### vicidial server trunk records for this server
	echo "<br><br><b>TRONCOS DE VICIDIAL PARA ESTE SERVIDOR: &nbsp; $NWB#vicidial_server_trunks$NWE</b><br>\n";
	echo "<TABLE width=500 cellspacing=3>\n";
	echo "<tr><td> CAMPAÑA</td><td> TRONCOS </td><td> RESTRICCIÓN </td><td> </td><td> DELETE </td></tr>\n";

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
		echo "<td><font size=1><a href=\"$PHP_SELF?ADD=621111111111&campaign_id=$rowx[1]&server_ip=$server_ip\">ELIMINAR</a></td></tr>\n";
		}

	echo "</table>\n";

	echo "<br><b>AGREGUE EL NUEVO EXPEDIENTE DEL TRONCO DEL SERVIDOR VICIDIAL</b><BR><form action=$PHP_SELF method=POST>\n";
	echo "<input type=hidden name=ADD value=221111111111>\n";
	echo "<input type=hidden name=server_ip value=\"$server_ip\">\n";
	echo "TRUNKS: <input size=6 maxlength=4 name=dedicated_trunks><BR>\n";
	echo "CAMPAÑA: <select size=1 name=campaign_id>\n";
	echo "$campaigns_list\n";
	echo "</select><BR>\n";
	echo "RESTRICTION: <select size=1 name=trunk_restriction><option>MAXIMUM_LIMIT</option><option>OVERFLOW_ALLOWED</option></select><BR>\n";
	echo "<input type=submit name=submit value=ADD><BR>\n";

	echo "</center></FORM><br>\n";


	### list of phones on this server
	echo "<center>\n";
	echo "<br><b>TELÉFONOS DENTRO DE ESTE SERVIDOR:</b><br>\n";
	echo "<TABLE width=400 cellspacing=3>\n";
	echo "<tr><td>EXTENSIÓN</td><td>NOMBRE</td><td>ACTIVO</td></tr>\n";

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
	echo "<tr><td>CONFERENCE</td><td>EXTENSIÓN</td></tr>\n";

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
	echo "<tr><td>VD CONFERENCE</td><td>EXTENSIÓN</td></tr>\n";

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
	echo "Este servidor tiene $active_phones Teléfonos activos y $inactive_phones Teléfonos inactivos<br><br>\n";
	echo "Este servidor tiene $active_confs active conferences<br><br>\n";
	echo "Este servidor tiene $active_vdconfs active vicidial conferences<br><br>\n";
	echo "</b></center>\n";
	if ($LOGast_delete_phones > 0)
		{
		echo "<br><br><a href=\"$PHP_SELF?ADD=511111111111&server_id=$server_id&server_ip=$server_ip\">DELETE THIS SERVER</a>\n";
		}
	}
	else
	{
	echo "Usted no tiene permiso de visión esta página\n";
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

	echo "<br>MODIFICAR UN REGISTRO DE LA CONFERENCIA: $row[0]<form action=$PHP_SELF method=POST>\n";
	echo "<input type=hidden name=ADD value=4111111111111>\n";
	echo "<input type=hidden name=old_conf_exten value=\"$row[0]\">\n";
	echo "<input type=hidden name=old_server_ip value=\"$row[1]\">\n";
	echo "<center><TABLE width=$section_width cellspacing=3>\n";
	echo "<tr bgcolor=#B6D3FC><td align=right>Conferencia: </td><td align=left><input type=text name=conf_exten size=10 maxlength=7 value=\"$row[0]\">$NWB#conferences-conf_exten$NWE</td></tr>\n";
	echo "<tr bgcolor=#B6D3FC><td align=right><a href=\"$PHP_SELF?ADD=311111111111&server_ip=$row[1]\">IP Del Servidor</a>: </td><td align=left><select size=1 name=server_ip>\n";

	echo "$servers_list";
	echo "<option SELECTED>$row[1]</option>\n";
	echo "</select>$NWB#conferences-server_ip$NWE</td></tr>\n";
	echo "<tr bgcolor=#B6D3FC><td align=right>Extensión Actual: </td><td align=left><input type=text name=extension size=20 maxlength=20 value=\"$row[2]\"></td></tr>\n";
	echo "<tr bgcolor=#B6D3FC><td align=center colspan=2><input type=submit name=submit VALUE=ENVIAR></td></tr>\n";
	echo "</TABLE></center>\n";

	echo "<center><b>\n";
	if ($LOGast_delete_phones > 0)
		{
		echo "<br><br><a href=\"$PHP_SELF?ADD=5111111111111&conf_exten=$conf_exten&server_ip=$server_ip\">DELETE THIS CONFERENCE</a>\n";
		}
	}
	else
	{
	echo "Usted no tiene permiso de visión esta página\n";
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
	echo "<tr bgcolor=#B6D3FC><td align=right>Conferencia: </td><td align=left><input type=text name=conf_exten size=10 maxlength=7 value=\"$row[0]\">$NWB#conferences-conf_exten$NWE</td></tr>\n";
	echo "<tr bgcolor=#B6D3FC><td align=right><a href=\"$PHP_SELF?ADD=311111111111&server_ip=$row[1]\">IP Del Servidor</a>: </td><td align=left><select size=1 name=server_ip>\n";

	echo "$servers_list";
	echo "<option SELECTED>$row[1]</option>\n";
	echo "</select>$NWB#conferences-server_ip$NWE</td></tr>\n";
	echo "<tr bgcolor=#B6D3FC><td align=right>Extensión Actual: </td><td align=left><input type=text name=extension size=20 maxlength=20 value=\"$row[2]\"></td></tr>\n";
	echo "<tr bgcolor=#B6D3FC><td align=center colspan=2><input type=submit name=submit VALUE=ENVIAR></td></tr>\n";
	echo "</TABLE></center>\n";

	echo "<center><b>\n";
	if ($LOGast_delete_phones > 0)
		{
		echo "<br><br><a href=\"$PHP_SELF?ADD=51111111111111&conf_exten=$conf_exten&server_ip=$server_ip\">DELETE THIS VICIDIAL CONFERENCE</a>\n";
		}
	}
	else
	{
	echo "Usted no tiene permiso de visión esta página\n";
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

	echo "<br>MODIFIQUE LOS AJUSTES DEL SISTEMA DE VICIDIAL<form action=$PHP_SELF method=POST>\n";
	echo "<input type=hidden name=ADD value=411111111111111>\n";
	echo "<center><TABLE width=$section_width cellspacing=3>\n";
	echo "<tr bgcolor=#B6D3FC><td align=right>Versión: </td><td align=left> $version</td></tr>\n";
	echo "<tr bgcolor=#B6D3FC><td align=right>Install Date: </td><td align=left> $install_date</td></tr>\n";
	echo "<tr bgcolor=#B6D3FC><td align=right>Uso No-Latino: </td><td align=left><select size=1 name=use_non_latin><option>1</option><option>0</option><option selected>$use_non_latin</option></select>$NWB#settings-use_non_latin$NWE</td></tr>\n";
	echo "<tr bgcolor=#B6D3FC><td align=right>Webroot Escribible: </td><td align=left><select size=1 name=webroot_writable><option>1</option><option>0</option><option selected>$webroot_writable</option></select>$NWB#settings-webroot_writable$NWE</td></tr>\n";
	echo "<tr bgcolor=#B6D3FC><td align=right>Permita La Registración De QueueMetrics: </td><td align=left><select size=1 name=enable_queuemetrics_logging><option>1</option><option>0</option><option selected>$enable_queuemetrics_logging</option></select>$NWB#settings-enable_queuemetrics_logging$NWE</td></tr>\n";

	echo "<tr bgcolor=#B6D3FC><td align=right>IP Del Servidor De QueueMetrics: </td><td align=left><input type=text name=queuemetrics_server_ip size=18 maxlength=15 value=\"$queuemetrics_server_ip\">$NWB#settings-queuemetrics_server_ip$NWE</td></tr>\n";
	echo "<tr bgcolor=#B6D3FC><td align=right>Nombre del DB De QueueMetrics: </td><td align=left><input type=text name=queuemetrics_dbname size=18 maxlength=50 value=\"$queuemetrics_dbname\">$NWB#settings-queuemetrics_dbname$NWE</td></tr>\n";
	echo "<tr bgcolor=#B6D3FC><td align=right>Conexión del DB De QueueMetrics: </td><td align=left><input type=text name=queuemetrics_login size=18 maxlength=50 value=\"$queuemetrics_login\">$NWB#settings-queuemetrics_login$NWE</td></tr>\n";
	echo "<tr bgcolor=#B6D3FC><td align=right>Contraseña del DB De QueueMetrics: </td><td align=left><input type=text name=queuemetrics_pass size=18 maxlength=50 value=\"$queuemetrics_pass\">$NWB#settings-queuemetrics_pass$NWE</td></tr>\n";
	echo "<tr bgcolor=#B6D3FC><td align=right>QueueMetrics URL: </td><td align=left><input type=text name=queuemetrics_url size=50 maxlength=255 value=\"$queuemetrics_url\">$NWB#settings-queuemetrics_url$NWE</td></tr>\n";
	echo "<tr bgcolor=#B6D3FC><td align=right>Identificación Del Registro De QueueMetrics: </td><td align=left><input type=text name=queuemetrics_log_id size=12 maxlength=10 value=\"$queuemetrics_log_id\">$NWB#settings-queuemetrics_log_id$NWE</td></tr>\n";
	echo "<tr bgcolor=#B6D3FC><td align=right>QueueMetrics EnterQueue Prepend: </td><td align=left><select size=1 name=queuemetrics_eq_prepend>\n";
	echo "<option value=\"NONE\">NONE</option>\n";
	echo "<option value=\"lead_id\">lead_id</option>\n";
	echo "<option value=\"list_id\">list_id</option>\n";
	echo "<option value=\"source_id\">source_id</option>\n";
	echo "<option value=\"vendor_lead_code\">vendor_lead_code</option>\n";
	echo "<option value=\"address3\">address3</option>\n";
	echo "<option value=\"security_phrase\">security_phrase</option>\n";
	echo "<option selected value=\"$queuemetrics_eq_prepend\">$queuemetrics_eq_prepend</option>\n";
	echo "</select>$NWB#settings-queuemetrics_eq_prepend$NWE</td></tr>\n";
	echo "<tr bgcolor=#B6D3FC><td align=right>El Agente de VICIDIAL Inhabilita La Exhibición:</td><td align=left><select size=1 name=vicidial_agent_disable>\n";
	echo "<option value=\"NOT_ACTIVE\">NOT_ACTIVE</option>\n";
	echo "<option value=\"LIVE_AGENT\">LIVE_AGENT</option>\n";
	echo "<option value=\"EXTERNAL\">EXTERNAL</option>\n";
	echo "<option value=\"ALL\">ALL</option>\n";
	echo "<option selected value=\"$vicidial_agent_disable\">$vicidial_agent_disable</option>\n";
	echo "</select>$NWB#settings-vicidial_agent_disable$NWE</td></tr>\n";
	echo "<tr bgcolor=#B6D3FC><td align=right>Permita Los Mensajes de SIPSAK: </td><td align=left><select size=1 name=allow_sipsak_messages><option>1</option><option>0</option><option selected>$allow_sipsak_messages</option></select>$NWB#settings-allow_sipsak_messages$NWE</td></tr>\n";
	echo "<tr bgcolor=#B6D3FC><td align=right>URL Casero Del Admin: </td><td align=left><input type=text name=admin_home_url size=50 maxlength=255 value=\"$admin_home_url\">$NWB#settings-admin_home_url$NWE</td></tr>\n";

	echo "<tr bgcolor=#B6D3FC><td align=center colspan=2><input type=submit name=submit VALUE=ENVIAR></td></tr>\n";
	echo "</TABLE></center>\n";

	echo "<center><b>\n";
	}
	else
	{
	echo "Usted no tiene permiso de visión esta página\n";
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

echo "<br>BUSCAR UN USUARIO<form action=$PHP_SELF method=POST>\n";
echo "<input type=hidden name=ADD value=660>\n";
echo "<center><TABLE width=$section_width cellspacing=3>\n";
echo "<tr bgcolor=#B6D3FC><td align=right>NÚmero De Usuario: </td><td align=left><input type=text name=user size=20 maxlength=20></td></tr>\n";
echo "<tr bgcolor=#B6D3FC><td align=right>Nombre Completo: </td><td align=left><input type=text name=full_name size=30 maxlength=30></td></tr>\n";
echo "<tr bgcolor=#B6D3FC><td align=right>Nivel Del Usuario: </td><td align=left><select size=1 name=user_level><option selected>0</option><option>1</option><option>2</option><option>3</option><option>4</option><option>5</option><option>6</option><option>7</option><option>8</option><option>9</option></select></td></tr>\n";
echo "<tr bgcolor=#B6D3FC><td align=right>Grupo Del Usuario: </td><td align=left><select size=1 name=user_group>\n";

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

echo "<br>RESULTADOS DE LA BÚSQUEDA:\n";
echo "<center><TABLE width=$section_width cellspacing=0 cellpadding=1>\n";

	$o=0;
	while ($people_to_print > $o) {
		$row=mysql_fetch_row($rslt);
		if (eregi("1$|3$|5$|7$|9$", $o))
			{$bgcolor='bgcolor="#B9CBFD"';} 
		else
			{$bgcolor='bgcolor="#9BB9FB"';}
		echo "<tr $bgcolor><td><font size=1>$row[1]</td><td><font size=1>$row[3]</td><td><font size=1>$row[4]</td><td><font size=1>$row[5]</td>";
		echo "<td><font size=1><a href=\"$PHP_SELF?ADD=3&user=$row[1]\">MODIFICAR</a> | <a href=\"./user_stats.php?user=$row[1]\">ESTADÍSTICAS</a> | <a href=\"./user_status.php?user=$row[1]\">ESTADO</a> | <a href=\"./AST_agent_time_sheet.php?agent=$row[1]\">TIME</a></td></tr>\n";
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
echo "<tr bgcolor=black><td><font size=1 color=white>LEAD</td><td><font size=1 color=white>LIST</td><td><font size=1 color=white> CAMPAÑA</td><td><font size=1 color=white>ENTRY FECHA</td><td><font size=1 color=white>CALLBACK FECHA</td><td><font size=1 color=white>USER</td><td><font size=1 color=white>RECIPIENT</td><td><font size=1 color=white>ESTADO</td><td><font size=1 color=white>GROUP</td></tr>\n";

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

echo "<br>USUARIOS:\n";
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
		echo "<td><font size=1><a href=\"$PHP_SELF?ADD=3&user=$row[1]\">MODIFICAR</a> | <a href=\"./user_stats.php?user=$row[1]\">ESTADÍSTICAS</a> | <a href=\"./user_status.php?user=$row[1]\">ESTADO</a> | <a href=\"./AST_agent_time_sheet.php?agent=$row[1]\">TIME</a></td></tr>\n";
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

echo "<br>CAMPAÑAS:\n";
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
		echo "<td><font size=1><a href=\"$PHP_SELF?ADD=31&campaign_id=$row[0]\">MODIFICAR</a></td></tr>\n";
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

echo "<br>LISTAS:\n";
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
		echo "<td><font size=1><a href=\"$PHP_SELF?ADD=311&list_id=$row[0]\">MODIFICAR</a></td></tr>\n";
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

echo "<br>GRUPOS DE ENTRADA :\n";
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
		echo "<td><font size=1><a href=\"$PHP_SELF?ADD=3111&group_id=$row[0]\">MODIFICAR</a></td></tr>\n";
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

echo "<br>AGENTES REMOTOS:\n";
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
		echo "<td><font size=1><a href=\"$PHP_SELF?ADD=31111&remote_agent_id=$row[0]\">MODIFICAR</a></td></tr>\n";
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

echo "<br>GRUPOS DE USUARIO :\n";
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
		echo "<td><font size=1><a href=\"$PHP_SELF?ADD=311111&user_group=$row[0]\">MODIFICAR</a></td></tr>\n";
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

echo "<br>ESCRITURAS DE LA VISIÓN:\n";
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
		echo "<td><font size=1><a href=\"$PHP_SELF?ADD=3111111&script_id=$row[0]\">MODIFICAR</a></td></tr>\n";
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

echo "<br>LISTADOS DEL FILTRO DEL PLOMO:\n";
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
		echo "<td><font size=1><a href=\"$PHP_SELF?ADD=31111111&lead_filter_id=$row[0]\">MODIFICAR</a></td></tr>\n";
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

echo "<br>LISTADOS DEL TIEMPO DE LA LLAMADA:\n";
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
		echo "<td><font size=1><a href=\"$PHP_SELF?ADD=311111111&call_time_id=$row[0]\">MODIFICAR</a></td></tr>\n";
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

echo "<br>LISTADOS DEL TIEMPO DE LA LLAMADA DEL ESTADO:\n";
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
		echo "<td><font size=1><a href=\"$PHP_SELF?ADD=3111111111&call_time_id=$row[0]\">MODIFICAR</a></td></tr>\n";
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

echo "<br>LISTADOS DE TELÉFONOS:\n";
echo "<center><TABLE width=$section_width cellspacing=0 cellpadding=1>\n";
echo "<tr bgcolor=black>";
echo "<td><a href=\"$PHP_SELF?ADD=10000000000&$EXTENlink\"><font size=1 color=white><B>EXTEN</B></a></td>";
echo "<td><a href=\"$PHP_SELF?ADD=10000000000&$PROTOlink\"><font size=1 color=white><B>PROTO</B></a></td>";
echo "<td><a href=\"$PHP_SELF?ADD=10000000000&$SERVERlink\"><font size=1 color=white><B>SERVER</B></a></td>";
echo "<td colspan=2><font size=1 color=white><B>DIAL PLAN</B></td>";
echo "<td><a href=\"$PHP_SELF?ADD=10000000000&$STATUSlink\"><font size=1 color=white><B>ESTADO</B></a></td>";
echo "<td><font size=1 color=white><B>NOMBRE</B></td>";
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
		echo "<td><font size=1><a href=\"$PHP_SELF?ADD=31111111111&extension=$row[0]&server_ip=$row[5]\">MODIFICAR</a> | <a href=\"./phone_stats.php?extension=$row[0]&server_ip=$row[5]\">ESTADÍSTICAS</a></td></tr>\n";
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

echo "<br>LISTADOS DEL SERVIDOR:\n";
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
		echo "<td><font size=1><a href=\"$PHP_SELF?ADD=311111111111&server_id=$row[0]\">MODIFICAR</a></td></tr>\n";
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

echo "<br>LISTADOS DE CONFERENCIAS:\n";
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
		echo "<td><font size=1><a href=\"$PHP_SELF?ADD=3111111111111&conf_exten=$row[0]&server_ip=$row[1]\">MODIFICAR</a></td></tr>\n";
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

echo "<br>LISTADOS DE CONFERENCIAS:\n";
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
		echo "<td><font size=1><a href=\"$PHP_SELF?ADD=31111111111111&conf_exten=$row[0]&server_ip=$row[1]\">MODIFICAR</a></td></tr>\n";
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
	<TITLE>VICIDIAL: ESTADÍSTICAS DEL SERVIDOR and Reports</TITLE></HEAD><BODY BGCOLOR=WHITE>
	<FONT SIZE=4><B>VICIDIAL: ESTADÍSTICAS DEL SERVIDOR and Reports</B></font><BR><BR>
	<UL>
	<LI><a href="AST_timeonVDADall.php"><FONT FACE="ARIAL,HELVETICA" COLOR=BLACK SIZE=2>TIME ON VDAD (per campaign)</a> &nbsp;  <a href="AST_timeonVDADallSUMMARY.php"><FONT FACE="ARIAL,HELVETICA" COLOR=BLACK SIZE=2>(all campaigns SUMMARY)</a> &nbsp; &nbsp; SIP <a href="AST_timeonVDADall.php?SIPmonitorLINK=1"><FONT FACE="ARIAL,HELVETICA" COLOR=BLACK SIZE=2>Listen</a> - <a href="AST_timeonVDADall.php?SIPmonitorLINK=2"><FONT FACE="ARIAL,HELVETICA" COLOR=BLACK SIZE=2>Barge</a> &nbsp; &nbsp; IAX <a href="AST_timeonVDADall.php?IAXmonitorLINK=1"><FONT FACE="ARIAL,HELVETICA" COLOR=BLACK SIZE=2>Listen</a> - <a href="AST_timeonVDADall.php?IAXmonitorLINK=2"><FONT FACE="ARIAL,HELVETICA" COLOR=BLACK SIZE=2>Barge</a></FONT>
	<LI><a href="AST_parkstats.php"><FONT FACE="ARIAL,HELVETICA" COLOR=BLACK SIZE=2>INFORME DE PARKING</a></FONT>
	<LI><a href="AST_VDADstats.php"><FONT FACE="ARIAL,HELVETICA" COLOR=BLACK SIZE=2>INFORME DE VDAD</a></FONT>
	<LI><a href="AST_CLOSERstats.php"><FONT FACE="ARIAL,HELVETICA" COLOR=BLACK SIZE=2>INFORME CLOSER</a></FONT>
	<LI><a href="AST_agent_performance.php"><FONT FACE="ARIAL,HELVETICA" COLOR=BLACK SIZE=2>AGENTE FUNCIONAMIENTO</a></FONT>
	<LI><a href="AST_agent_performance_detail.php"><FONT FACE="ARIAL,HELVETICA" COLOR=BLACK SIZE=2>AGENTE FUNCIONAMIENTO DETAIL</a></FONT>
	<LI><a href="AST_server_performance.php"><FONT FACE="ARIAL,HELVETICA" COLOR=BLACK SIZE=2>SERVIDOR FUNCIONAMIENTO</a></FONT>
<?
	if ($enable_queuemetrics_logging_LU > 0)
		{
		echo "<LI><a href=\"$queuemetrics_url_LU\"><FONT FACE=\"ARIAL,HELVETICA\" COLOR=BLACK SIZE=2>QUEUEMETRICS INFORMES</a></FONT>\n";
		}
?>
	</UL>
	<PRE><TABLE Border=1 CELLPADDING=0 cellspacing=0>
	<TR><TD>SERVER</TD><TD>DESCRIPCIÓN</TD><TD>IP ADDRESS</TD><TD>ACTIVO</TD><TD>VDAD time</TD><TD>PARK time</TD><TD>CLOSER/INBOUND time</TD></TR>
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
	echo "Usted no tiene permiso de visión esta página\n";
	exit;
	}
}





echo "</TD></TR></TABLE></center>\n";

$ENDtime = date("U");

$RUNtime = ($ENDtime - $STARTtime);

echo "\n\n\n<br><br><br>\n\n";


echo "<font size=0>\n\n\n<br><br><br>\nScript runtime: $RUNtime seconds";
echo " &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; VERSIÓN: $admin_version";
echo " &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; CONSTRUCCION: $build</font>\n";


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
						if ($GMT_day[$r]==0)	#### Sunday tiempo local
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
						if ($GMT_day[$r]==1)	#### Monday tiempo local
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
						if ($GMT_day[$r]==2)	#### Tuesday tiempo local
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
						if ($GMT_day[$r]==3)	#### Wednesday tiempo local
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
						if ($GMT_day[$r]==4)	#### Thursday tiempo local
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
						if ($GMT_day[$r]==5)	#### Friday tiempo local
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
						if ($GMT_day[$r]==6)	#### Saturday tiempo local
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
				if ($GMT_day[$r]==0)	#### Sunday tiempo local
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
				if ($GMT_day[$r]==1)	#### Monday tiempo local
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
				if ($GMT_day[$r]==2)	#### Tuesday tiempo local
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
				if ($GMT_day[$r]==3)	#### Wednesday tiempo local
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
				if ($GMT_day[$r]==4)	#### Thursday tiempo local
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
				if ($GMT_day[$r]==5)	#### Friday tiempo local
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
				if ($GMT_day[$r]==6)	#### Saturday tiempo local
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
			echo "Esta campaña tiene $active_leads Leads para ser llamados en estas listas\n";
			}
		else
			{
			echo "ningunos estados del dial seleccionados para esta campaña\n";
			}
		}
	else
		{
		echo "ningunas listas activas seleccionadas para esta campaña\n";
		}
	}
else
	{
	echo "ningunas listas activas seleccionadas para esta campaña\n";
	}
##### END calculate what gmt_offset_now values are within the allowed local_call_time setting ###
}
?>
