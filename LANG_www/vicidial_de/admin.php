<?
# admin.php - VICIDIAL administration page
# 
# 
# Copyright (C) 2006  Matt Florell <vicidial@gmail.com>    LICENSE: GPLv2
#

require("dbconnect.php");

$PHP_AUTH_USER=$_SERVER['PHP_AUTH_USER'];
$PHP_AUTH_PW=$_SERVER['PHP_AUTH_PW'];
$PHP_SELF=$_SERVER['PHP_SELF'];

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
if (isset($_GET["SUBMIT"]))	{$SUBMIT=$_GET["SUBMIT"];}
	elseif (isset($_POST["SUBMIT"]))	{$SUBMIT=$_POST["SUBMIT"];}
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
if (isset($_GET["campaigns"]))	{$campaigns=$_GET["campaigns"];}
	elseif (isset($_POST["campaigns"]))	{$campaigns=$_POST["campaigns"];}




	if (isset($script_id)) {$script_id= strtoupper($script_id);}
	if (isset($lead_filter_id)) {$lead_filter_id = strtoupper($lead_filter_id);}

##### BEGIN VARIABLE FILTERING FOR SECURITY #####

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
$load_leads = ereg_replace("[^0-9]","",$delete_call_times);
$max_vicidial_trunks = ereg_replace("[^0-9]","",$max_vicidial_trunks);
$modify_call_times = ereg_replace("[^0-9]","",$modify_call_times);
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

### DIGITS and Dots
$server_ip = ereg_replace("[^\.0-9]","",$server_ip);
$auto_dial_level = ereg_replace("[^\.0-9]","",$auto_dial_level);
$adaptive_maximum_level = ereg_replace("[^\.0-9]","",$adaptive_maximum_level);
$phone_ip = ereg_replace("[^\.0-9]","",$phone_ip);
$old_server_ip = ereg_replace("[^\.0-9]","",$old_server_ip);
$computer_ip = ereg_replace("[^\.0-9]","",$computer_ip);

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

### remove semi-colons ###
$lead_filter_sql = ereg_replace(";","",$lead_filter_sql);

### VARIABLES TO BE mysql_real_escape_string ###
# $web_form_address

### VARIABLES not filtered at all ###
# $script_text

##### END VARIABLE FILTERING FOR SECURITY #####


# AST GUI database administration
# admin.php
# 
# CHANGES
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
# 60808-1147 - changed filtering for and added instructions for consutative transfers
# 60816-1552 - added allcalls_delay start delay for recordings in vicidial.php
# 60817-2226 - fixed bug that would not allow lead recycling of non-selectable statuses
# 60821-1543 - added option to Omit Phone Code while dialing in vicidial
# 60821-1625 - added ALLFORCE recording option for campaign_recording
# 60823-1154 - added fields for adaptive dialing
# 60824-1326 - added adaptive_latest_target_gmt for ADAPT_TAPERED dial method
# 60825-1205 - added adaptive_intensity for ADAPT_ dial methods
# 60828-1019 - changed adaptive_latest_target_gmt to adaptive_latest_server_time
# 60828-1115 - added adaptive_dl_diff_target and changed intensity dropdown
# 60927-1246 - added astguiclient/admin.php functions under SERVERS tab
# 61002-1402 - added fields for vicidial balance trunk controls
# 61003-1123 - added functions for vicidial_server_trunks records
# 61109-1022 - added Emergency VDAC Jam Clear function to Campaign Detail screen
# 61110-1502 - add ability to select NONE in dial statuses, new list_id must not be < 100
# 61122-1228 - added user group campaign restrictions
# 61122-1535 - changed script_text to unfiltered and added more variables to SCRIPTS
# 61129-1028 - Added headers to Users and Phones with clickable order-by titles
#

# make sure you have added a user to the vicidial_users MySQL table with at least user_level 8 to access this page the first time

$version = '2.0.73';
$build = '61129-1028';

$STARTtime = date("U");

if ($force_logout)
{
  if( (strlen($PHP_AUTH_USER)>0) or (strlen($PHP_AUTH_PW)>0) )
	{
    Header("WWW-Authenticate: Basic realm=\"VICI-PROJECTS\"");
    Header("HTTP/1.0 401 Unauthorized");
	}
    echo "Sie haben jetzt heraus geloggt. Danke\n";
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
    echo "Unzulässiges Username/Kennwort:|$PHP_AUTH_USER|$PHP_AUTH_PW|\n";
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
echo "<!-- VERSION: $version   BAU: $build   ADD: $ADD   PHP_SELF: $PHP_SELF-->\n";
echo "<title>VICIDIAL ADMIN: ";

if (!isset($ADD))   {$ADD=0;}

if ($ADD==1)			{$hh='users';		echo "Addieren Sie Neuen Benutzer";}
if ($ADD==11)			{$hh='campaigns';	echo "Addieren Sie Neue Kampagne";}
if ($ADD==111)			{$hh='lists';		echo "Addieren Sie Neue Liste";}
if ($ADD==121)			{$hh='lists';		echo "Addieren Sie Neues DNC";}
if ($ADD==1111)			{$hh='ingroups';	echo "Addieren Sie Neue In-Gruppe";}
if ($ADD==11111)		{$hh='remoteagent';	echo "Addieren Sie Neue Remotemittel";}
if ($ADD==111111)		{$hh='usergroups';	echo "Addieren Sie Neue Benutzer-Gruppe";}
if ($ADD==1111111)		{$hh='scripts';		echo "Addieren Sie Neuen Index";}
if ($ADD==11111111)		{$hh='filters';		echo "Addieren Sie Neuen Filter";}
if ($ADD==111111111)	{$hh='times';		echo "Füge neue Anrufzeit hinzu";}
if ($ADD==1111111111)	{$hh='times';		echo "Füge neue landesspezifische Anrufzeit hinzu";}
if ($ADD==11111111111)	{$hh='server';		echo "ADDIEREN SIE NEUES TELEFON";}
if ($ADD==111111111111)	{$hh='server';		echo "ADDIEREN SIE NEUEN BEDIENER";}
if ($ADD==1111111111111)	{$hh='server';		echo "ADDIEREN SIE NEUE KONFERENZ";}
if ($ADD==11111111111111)	{$hh='server';		echo "ADD NEW VICIDIAL CONFERENCE";}
if ($ADD==2)			{$hh='users';		echo "Neue Benutzer-Hinzufügung";}
if ($ADD==21)			{$hh='campaigns';	echo "Neue Kampagne Hinzufügung";}
if ($ADD==22)			{$hh='campaigns';	echo "Neue Kampagne Status-Hinzufügung";}
if ($ADD==23)			{$hh='campaigns';	echo "Neue Kampagne HotKey Hinzufügung";}
if ($ADD==25)			{$hh='campaigns';	echo "Neue Kampagne Leitung Bereiten Hinzufügung Auf";}
if ($ADD==211)			{$hh='lists';		echo "Neue Liste Hinzufügung";}
if ($ADD==2111)			{$hh='ingroups';	echo "Neue In-Gruppe Hinzufügung";}
if ($ADD==21111)		{$hh='remoteagent';	echo "Neue Remotemittel-Hinzufügung";}
if ($ADD==211111)		{$hh='usergroups';	echo "Neue Benutzer-Gruppe Hinzufügung";}
if ($ADD==2111111)		{$hh='scripts';		echo "Neue Index-Hinzufügung";}
if ($ADD==21111111)		{$hh='filters';		echo "Neue Filter-Hinzufügung";}
if ($ADD==211111111)	{$hh='times';		echo "Neue Anrufzeit hinzufügen";}
if ($ADD==2111111111)	{$hh='times';		echo "Neue landesspezifische Anrufzeit hinzufügen";}
if ($ADD==21111111111)	{$hh='server';		echo "ADDIEREN DES NEUEN TELEFONS";}
if ($ADD==211111111111)	{$hh='server';		echo "ADDIEREN DES NEUEN BEDIENERS";}
if ($ADD==221111111111)	{$hh='server';		echo "ADDIEREN DES NEUEN STAMM-SATZES DES BEDIENER-VICIDIAL";}
if ($ADD==2111111111111)	{$hh='server';		echo "ADDIEREN DER NEUEN KONFERENZ";}
if ($ADD==21111111111111)	{$hh='server';		echo "ADDING NEW VICIDIAL CONFERENCE";}
if ($ADD==3)			{$hh='users';		echo "Ändern Sie Benutzer";}
if ($ADD==30)			{$hh='campaigns';	echo "Kampagne Nicht Erlaubt";}
if ($ADD==31)			{$hh='campaigns';	echo "Ändern Sie Kampagne";}
if ($ADD==34)			{$hh='campaigns';	echo "Ändern Sie Kampagne - Grundlegende Ansicht";}
if ($ADD==311)			{$hh='lists';		echo "Ändern Sie Liste";}
if ($ADD==3111)			{$hh='ingroups';	echo "Ändern Sie In-Gruppe";}
if ($ADD==31111)		{$hh='remoteagent';	echo "Ändern Sie Remotemittel";}
if ($ADD==311111)		{$hh='usergroups';	echo "Ändern Sie Benutzer-Gruppen";}
if ($ADD==3111111)		{$hh='scripts';		echo "Ändern Sie Index";}
if ($ADD==31111111)		{$hh='filters';		echo "Ändern Sie Filter";}
if ($ADD==311111111)	{$hh='times';		echo "Bearbeite Anrufzeit";}
if ($ADD==321111111)	{$hh='times';		echo "Bearbeite Anrufzeit Landdefinitions-Liste";}
if ($ADD==3111111111)	{$hh='times';		echo "Bearbeite landesspezifische Anrufzeit";}
if ($ADD==31111111111)	{$hh='server';		echo "ÄNDERN SIE TELEFON";}
if ($ADD==311111111111)	{$hh='server';		echo "ÄNDERN SIE BEDIENER";}
if ($ADD==3111111111111)	{$hh='server';		echo "ÄNDERN SIE KONFERENZ";}
if ($ADD==31111111111111)	{$hh='server';		echo "MODIFY VICIDIAL CONFERENCE";}
if ($ADD=="4A")			{$hh='users';		echo "Ändern Sie Benutzer - Admin";}
if ($ADD=="4B")			{$hh='users';		echo "Ändern Sie Benutzer - Admin";}
if ($ADD==4)			{$hh='users';		echo "Ändern Sie Benutzer";}
if ($ADD==41)			{$hh='campaigns';	echo "Ändern Sie Kampagne";}
if ($ADD==42)			{$hh='campaigns';	echo "Ändern Sie Kampagne Status";}
if ($ADD==43)			{$hh='campaigns';	echo "Ändern Sie Kampagne HotKey";}
if ($ADD==44)			{$hh='campaigns';	echo "Ändern Sie Kampagne - Grundlegende Ansicht";}
if ($ADD==45)			{$hh='campaigns';	echo "Ändern Sie Kampagne Leitung Aufbereiten";}
if ($ADD==411)			{$hh='lists';		echo "Ändern Sie Liste";}
if ($ADD==4111)			{$hh='ingroups';	echo "Ändern Sie In-Gruppe";}
if ($ADD==41111)		{$hh='remoteagent';	echo "Ändern Sie Remotemittel";}
if ($ADD==411111)		{$hh='usergroups';	echo "Ändern Sie Benutzer-Gruppen";}
if ($ADD==4111111)		{$hh='scripts';		echo "Ändern Sie Index";}
if ($ADD==41111111)		{$hh='filters';		echo "Ändern Sie Filter";}
if ($ADD==411111111)	{$hh='times';		echo "Bearbeite Anrufzeit";}
if ($ADD==4111111111)	{$hh='times';		echo "Bearbeite landesspezifische Anrufzeit";}
if ($ADD==41111111111)	{$hh='server';		echo "ÄNDERN SIE TELEFON";}
if ($ADD==411111111111)	{$hh='server';		echo "ÄNDERN SIE BEDIENER";}
if ($ADD==421111111111)	{$hh='server';		echo "ÄNDERN SIE STAMM-SATZ DES BEDIENER-VICIDIAL";}
if ($ADD==4111111111111)	{$hh='server';		echo "ÄNDERN SIE KONFERENZ";}
if ($ADD==41111111111111)	{$hh='server';		echo "MODIFY VICIDIAL CONFERENCE";}
if ($ADD==5)			{$hh='users';		echo "Delete User";}
if ($ADD==51)			{$hh='campaigns';	echo "Delete Kampagne";}
if ($ADD==52)			{$hh='campaigns';	echo "Logout-Mittel";}
if ($ADD==53)			{$hh='campaigns';	echo "Dringlichkeits-VDAC Stau-Freier Raum";}
if ($ADD==511)			{$hh='lists';		echo "Delete List";}
if ($ADD==5111)			{$hh='ingroups';	echo "Delete In-Group";}
if ($ADD==51111)		{$hh='remoteagent';	echo "Löschung-Direktübertragung Mittel";}
if ($ADD==511111)		{$hh='usergroups';	echo "Löschung-Benutzer Group";}
if ($ADD==5111111)		{$hh='scripts';		echo "Löschung-Index";}
if ($ADD==51111111)		{$hh='filters';		echo "Löschung-Filter";}
if ($ADD==511111111)	{$hh='times';		echo "Lösche Anrufzeit";}
if ($ADD==5111111111)	{$hh='times';		echo "Lösche landesspezifische Anrufzeit";}
if ($ADD==51111111111)	{$hh='server';		echo "DELETE PHONE";}
if ($ADD==511111111111)	{$hh='server';		echo "DELETE SERVER";}
if ($ADD==5111111111111)	{$hh='server';		echo "DELETE CONFERENCE";}
if ($ADD==51111111111111)	{$hh='server';		echo "DELETE VICIDIAL CONFERENCE";}
if ($ADD==6)			{$hh='users';		echo "Delete User";}
if ($ADD==61)			{$hh='campaigns';	echo "Delete Kampagne";}
if ($ADD==62)			{$hh='campaigns';	echo "Logout-Mittel";}
if ($ADD==63)			{$hh='campaigns';	echo "Dringlichkeits-VDAC Stau-Freier Raum";}
if ($ADD==65)			{$hh='campaigns';	echo "Löschung-Leitung Bereiten Auf";}
if ($ADD==611)			{$hh='lists';		echo "Delete List";}
if ($ADD==6111)			{$hh='ingroups';	echo "Delete In-Group";}
if ($ADD==61111)		{$hh='remoteagent';	echo "Löschung-Direktübertragung Mittel";}
if ($ADD==611111)		{$hh='usergroups';	echo "Löschung-Benutzer Group";}
if ($ADD==6111111)		{$hh='scripts';		echo "Löschung-Index";}
if ($ADD==61111111)		{$hh='filters';		echo "Löschung-Filter";}
if ($ADD==611111111)	{$hh='times';		echo "Lösche Anrufzeit";}
if ($ADD==6111111111)	{$hh='times';		echo "Lösche landesspezifische Anrufzeit";}
if ($ADD==61111111111)	{$hh='server';		echo "DELETE PHONE";}
if ($ADD==611111111111)	{$hh='server';		echo "DELETE SERVER";}
if ($ADD==621111111111)	{$hh='server';		echo "STAMM-SATZ DES LÖSCHUNG-BEDIENER-VICIDIAL";}
if ($ADD==6111111111111)	{$hh='server';		echo "DELETE CONFERENCE";}
if ($ADD==61111111111111)	{$hh='server';		echo "DELETE VICIDIAL CONFERENCE";}
if ($ADD==73)			{$hh='campaigns';	echo "Anzahl anrufbarer Anschlüsse";}
if ($ADD==7111111)		{$hh='scripts';		echo "Vorbetrachtung-Index";}
if ($ADD==0)			{$hh='users';		echo "Benutzer-Liste";}
if ($ADD==8)			{$hh='users';		echo "Wiederholungsbesuche Innerhalb Des Mittels";}
if ($ADD==81)			{$hh='campaigns';	echo "Wiederholungsbesuche Innerhalb Der Kampagne";}
if ($ADD==811)			{$hh='campaigns';	echo "Wiederholungsbesuche Innerhalb Der Liste";}
if ($ADD==10)			{$hh='campaigns';	echo "Kampagnen";}
if ($ADD==100)			{$hh='lists';		echo "Listen";}
if ($ADD==1000)			{$hh='ingroups';	echo "In-Gruppen";}
if ($ADD==10000)		{$hh='remoteagent';	echo "Remotemittel";}
if ($ADD==100000)		{$hh='usergroups';	echo "Benutzer-Gruppen";}
if ($ADD==1000000)		{$hh='scripts';		echo "Indexe";}
if ($ADD==10000000)		{$hh='filters';		echo "Filter";}
if ($ADD==100000000)	{$hh='times';		echo "Anrufzeiten";}
if ($ADD==1000000000)	{$hh='times';		echo "Landesspezische Anrufzeiten";}
if ($ADD==10000000000)	{$hh='server';		echo "TELEFON-LISTE";}
if ($ADD==100000000000)	{$hh='server';		echo "BEDIENER-LISTE";}
if ($ADD==1000000000000)	{$hh='server';		echo "KONFERENZ-LISTE";}
if ($ADD==10000000000000)	{$hh='server';		echo "VICIDIAL KONFERENZ-LISTE";}
if ($ADD==55)			{$hh='users';		echo "Suchform";}
if ($ADD==551)			{$hh='users';		echo "SUCHTELEFONE";}
if ($ADD==66)			{$hh='users';		echo "Suchresultate";}
if ($ADD==661)			{$hh='users';		echo "SUCHE RUFT RESULTATE AN";}
if ($ADD==99999)		{$hh='users';		echo "HILFE";}

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

if ( ( (strlen($ADD)>4) && ($ADD < 99998) ) or ($ADD==3) or ($ADD==21) or ($ADD==31) or ($ADD==41) or ($ADD=="4A")  or ($ADD=="4B") or (strlen($ADD)==12) )
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
	if ($ADD==31)
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
	$campaigns_list.="> ALL-CAMPAIGNS - BENUTZER KÖNNEN JEDE MÖGLICHE KAMPAGNE ANSEHEN</B><BR>\n";

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
$NWE = "')\"><IMG SRC=\"help.gif\" WIDTH=20 HEIGHT=20 Border=0 ALT=\"HILFE\" ALIGN=TOP></A>";
######################
# ADD=99999 display the HELP SCREENS
######################

if ($ADD==99999)
{
echo "</title>\n";
echo "</head>\n";
echo "<BODY BGCOLOR=white marginheight=0 marginwidth=0 leftmargin=0 topmargin=0>\n";
echo "<CENTER>\n";
echo "<TABLE WIDTH=98% BGCOLOR=#E6E6E6 cellpadding=2 cellspacing=0><TR><TD ALIGN=LEFT><FONT FACE=\"ARIAL,HELVETICA\" COLOR=BLACK SIZE=4><B>VICIDIAL ADMIN: HILFE<BR></B></FONT><FONT FACE=\"ARIAL,HELVETICA\" COLOR=BLACK SIZE=2><BR><BR>\n";

?>
<B><FONT SIZE=3>VICIDIAL_BENUTZERTABELLE</FONT></B><BR><BR>
<A NAME="vicidial_users-user">
<BR>
<B>Benutzernummer -</B> Dieses fangen ist, wohin Sie dieVICIDIAL Benutzernummer Zahl setzen, kann bis 8 Stellen in der Längesein, muß mindestens 2 Buchstaben lang sein auf.

<BR>
<A NAME="vicidial_users-pass">
<BR>
<B>Kennwort -</B> Dieses fangen ist auf, wohin Sie das VICIDIALBenutzerkennwort setzen. Sein mindestens müssen 2 Buchstaben lang.

<BR>
<A NAME="vicidial_users-full_name">
<BR>
<B>Voller Name -</B> Dieses fangen ist auf, wohin Sie den vollenNamen der VICIDIAL Benutzer setzen. Sein mindestens müssen 2Buchstaben lang.

<BR>
<A NAME="vicidial_users-user_level">
<BR>
<B>Benutzer-Niveau -</B> Dieses Menü ist, wo Sie das VICIDIALBenutzer-Benutzerniveau vorwählen. Sein muß ein Niveau von inVICIDIAL zu loggen 1,, muß waagerecht ausgerichtet grösser sein, alsals genaueres innen zu loggen 2, Benutzerniveau 8 oder grösser seinmüssen, in admin Netzabschnitt zu erhalten.

<BR>
<A NAME="vicidial_users-user_group">
<BR>
<B>Benutzer-Gruppe -</B> Dieses Menü ist, wo Sie die VICIDIALBenutzergruppe vorwählen, daß dieser Benutzer gehört. Dieses hatkeine Beschränkungen diesmal, ist dieses gerecht, Benutzer zuunterteilen und die zukünftigen Eigenschaften zuzulassen, die nachihm gegründet werden.

<BR>
<A NAME="vicidial_users-phone_login">
<BR>
<B>Telefon-LOGON -</B> Für hier ist, wo Sie einen RückstellungTelefon-LOGON-Wert wenn die Benutzermaschinenbordbücher invicidial.php einstellen können. Dieser Wert bevölkert dasphone_login automatisch wenn die Benutzermaschinenbordbücher innenmit ihrer Benutzer-überschreiten-Kampagne auf dem vicidial.phpLOGON-Schirm.

<BR>
<A NAME="vicidial_users-phone_pass">
<BR>
<B>Telefon-Durchlauf -</B> Für hier ist, wo Sie einen RückstellungTelefon-Durchlaufwert wenn die Benutzermaschinenbordbücher invicidial.php einstellen können. Dieser Wert bevölkert die phone_passautomatisch wenn die Benutzermaschinenbordbücher innen mit ihrerBenutzer-überschreiten-Kampagne auf dem vicidial.php LOGON-Schirm.

<BR>
<A NAME="vicidial_users-hotkeys_active">
<BR>
<B>HotKeys aktiv -</B> Diese Wahl, wenn Satz bis 1 dem Benutzer erlaubt,die HotKeys schnelle-dispositioning Funktion innen zu verwenden vicidial.php.

<BR>
<A NAME="vicidial_users-agent_choose_ingroups">
<BR>
<B>Mittel wählen Ingroups -</B> Diese Wahl, wenn Satz bis 1 dem Benutzererlaubt, die ingroups zu wählen, denen sie Anrufe von wenn sie LOGONzu einer GENAUEREN oder INBOUND Kampagne empfangen. Andernfalls mußder Manager dieses auf ihrem Benutzersonderkommandoschirm der adminSeite einstellen.

<BR>
<A NAME="vicidial_users-closer_campaigns">
<BR>
<B>Inbound Gruppen -</B> Ist hier, wo Sie die inbound Gruppen vorwählen,die Sie Anrufe von empfangen möchten, wenn Sie die GENAUERE Kampagnevorgewählt haben.

<BR>
<A NAME="vicidial_users-scheduled_callbacks">
<BR>
<B>Zeitlich geplante Wiederholungsbesuche -</B> Diese Wahl erlaubt einemMittel zur Einteilung einen Anruf als CALLBK und wählt die Daten unddie Zeit, an denen die Leitung reaktiviert wird.

<BR>
<A NAME="vicidial_users-agentonly_callbacks">
<BR>
<B>Mittel-Nur Wiederholungsbesuche -</B> Diese Wahl erlaubt einemVertreter, einen Wiederholungsbesuch einzustellen, damit sie daseinzige Mittel sind, das die Kunde Rückseite benennen kann. Dieseserlaubt auch dem Vertreter, ihre Wiederholungsbesuch Auflistungen zusehen und sie zurück zu benennen, immer wenn sie zu wünschen.

<BR>
<A NAME="vicidial_users-agentcall_manual">
<BR>
<B>Vertreter-Anruf-Handbuch -</B> Diese Wahl erlaubt einem Vertreter,eine neue Leitung in das System manuell einzutragen und sie zubenennen. Dieses auch erlaubt das Benennen jeder möglicherTelefonnummer von ihrem vicidial Schirm und setzt diesen Anruf inihren Lernabschnitt. Verwenden Sie diese Wahl mit Vorsicht.

<BR>
<A NAME="vicidial_users-vicidial_recording">
<BR>
<B>Vicidial Aufnahme -</B> Diese Wahl kann verhindern, daß ein Mittelalle mögliche Aufnahmen tut, nachdem sie innen in vicidialprotokollieren. Diese Wahl muß eingeschaltet sein, damit vicidial demKampagne Aufnahmelernabschnitt folgt.

<BR>
<A NAME="vicidial_users-vicidial_transfers">
<BR>
<B>Vicidial Übertragungen -</B> Diese Wahl kann verhindern, daß einMittel die Übertragung - Konferenzlernabschnitt von vicidial öffnet.Wenn dieses untauglich ist, kann das Mittel nicht dritterParteianruf, oder blinde Übertragung irgendeine benennt.

<BR>
<A NAME="vicidial_users-closer_default_blended">
<BR>
<B>Genauere Rückstellung gemischt -</B> Diese Wahl fällt einfach dasgemischte checkbox auf einem GENAUEREN LOGON-Schirm zurück.

<BR>
<A NAME="vicidial_users-alter_agent_interface_options">
<BR>
<B>Ändern Sie Mittel-Schnittstelle Wahlen -</B> diese Wahl, wenn Satzbis 1 dem administrativen Benutzer erlaubt, die MittelschnittstelleWahlen in admin.php zu ändern.

<BR>
<A NAME="vicidial_users-delete_users">
<BR>
<B>Löschung-Benutzer -</B> Diese Wahl, wenn Satz bis 1 dem Benutzererlaubt, andere Benutzer des Gleichgestellten oder wenigenBenutzerniveaus aus dem System zu löschen.

<BR>
<A NAME="vicidial_users-delete_user_groups">
<BR>
<B>Löschung-Benutzer-Gruppen -</B> Diese Wahl, wenn Satz bis 1 demBenutzer erlaubt, Benutzergruppen aus dem System zu löschen.

<BR>
<A NAME="vicidial_users-delete_lists">
<BR>
<B>Löschung verzeichnet -</B> Diese Wahl, wenn Satz bis 1 dem Benutzererlaubt, vicidial Listen aus dem System zu löschen.

<BR>
<A NAME="vicidial_users-delete_campaigns">
<BR>
<B>Löschung wirbt -</B> Diese Wahl, wenn Satz bis 1 dem Benutzererlaubt, vicidial Kampagnen aus dem System zu löschen.

<BR>
<A NAME="vicidial_users-delete_ingroups">
<BR>
<B>Löschung In-Gruppen -</B> Diese Wahl, wenn Satz bis 1 dem Benutzererlaubt, vicidial In-Gruppen aus dem System zu löschen.

<BR>
<A NAME="vicidial_users-delete_remote_agents">
<BR>
<B>Löschung-Remotemittel -</B> Diese Wahl, wenn Satz bis 1 dem Benutzererlaubt, vicidial Remotemittel aus dem System zu löschen.

<BR>
<A NAME="vicidial_users-load_leads">
<BR>
<B>Last führt -</B> Diese Wahl, wenn Satz bis 1 dem Benutzer erlaubt,vicidial Leitungen in die vicidial_list Tabelle über die Netzgegründete Leitung Ladevorrichtung zu laden.

<BR>
<A NAME="vicidial_users-campaign_detail">
<BR>
<B>Kampagne Detail -</B> Diese Wahl, wenn Satz bis 1 dem Benutzererlaubt, die Kampagne Detail-Schirmelemente anzusehen und zu ändern.

<BR>
<A NAME="vicidial_users-ast_admin_access">
<BR>
<B>AGC Admin Zugang -</B> Diese Wahl, wenn Satz bis 1 den Benutzer zumLOGON zu den astGUIclient admin Seiten erlaubt.

<BR>
<A NAME="vicidial_users-ast_delete_phones">
<BR>
<B>AGC Löschung-Telefone -</B> Diese Wahl, wenn Satz bis 1 dem Benutzererlaubt, Telefoneintragungen in den astGUIclient admin Seiten zulöschen.

<BR>
<A NAME="vicidial_users-delete_scripts">
<BR>
<B>Löschung-Indexe -</B> Diese Wahl, wenn Satz bis 1 dem Benutzererlaubt, Kampagne Indexe auf dem Indexänderung Schirm zu löschen.

<BR>
<A NAME="vicidial_users-modify_leads">
<BR>
<B>Ändern Sie Leitungen -</B> Diese Wahl, wenn Satz bis 1 dem Benutzererlaubt, Leitungen in der admin Abschnittleitung Suchresultate Seitezu ändern.

<BR>
<A NAME="vicidial_users-change_agent_campaign">
<BR>
<B>Ändern Sie Vertreter-Kampagne -</B> Diese Wahl, wenn Satz bis 1 demBenutzer erlaubt, die Kampagne zu ändern, daß ein Mittel in geloggtwird, während sie in es geloggt werden.

<BR>
<A NAME="vicidial_users-delete_filters">
<BR>
<B>Löschung filtert -</B> Diese Wahl erlaubt dem Benutzer, in der LagezuSEIN, vicidial Leitung Filter aus dem System zu löschen.

<BR>
<A NAME="vicidial_users-delete_call_times">
<BR>
<B>Löschen Anrufzeiten -</B> Diese Option erlaubt dem Nutzer die Vicidial Anrufzeiten Aufzeichnungen und Vicidial Status Anrufzeiten Aufzeichnungen vom System zu löschen.

<BR>
<A NAME="vicidial_users-modify_call_times">
<BR>
<B>Ändere Anrufzeiten -</B> Diese Option erlaubt dem Nutzer das Ansehen und Ändern der Anrufzeiten und Status Anrufzeiten Aufzeichnungen. Ein Nutzer braucht diese Option nicht aktiviert, wenn er nur die Anrufzeit Option auf der Kampagnen-Sicht ändern können muss.




<BR><BR><BR><BR>

<B><FONT SIZE=3>VICIDIAL_CAMPAIGNSTABELLE</FONT></B><BR><BR>
<A NAME="vicidial_campaigns-campaign_id">
<BR>
<B>Kampagne Identifikation -</B> Dieses ist der kurze Name der Kampagne,es ist nicht editable nach Ausgangsunterordnung, kann nicht Räumeenthalten und muß zwischen 2 und 8 Buchstaben im lengt seinh.

<BR>
<A NAME="vicidial_campaigns-campaign_name">
<BR>
<B>Kampagne Name -</B> Dieses ist die Beschreibung der Kampagne, muß eszwischen 6 und 40 Buchstaben lang sein.

<BR>
<A NAME="vicidial_campaigns-active">
<BR>
<B>Aktiv -</B> Dieses ist, wohin Sie die Kampagne auf aktives oderunaktiviertes einstellen. Wenn unaktiviert, kann noone in es loggen.

<BR>
<A NAME="vicidial_campaigns-park_ext">
<BR>
<B>Park-Verlängerung -</B> Dieses ist, wo Sie besonders anfertigenkönnen auf-halten Musik für VICIDIAL. Stellen Sie sicher, daß dieVerlängerung im Platz im extensions.conf ist und das, das es auf denDateinamen unten zeigt.

<BR>
<A NAME="vicidial_campaigns-park_file_name">
<BR>
<B>Park-Dateiname -</B> Dieses ist, wo Sie besonders anfertigen könnenauf-halten Musik für VICIDIAL. Stellen Sie sicher, daß der Dateiname10 Buchstaben lang oder kleiner ist und daß die Akte im Platz im/var/lib/asterisk/sounds Verzeichnis ist.

<BR>
<A NAME="vicidial_campaigns-web_form_address">
<BR>
<B>Netz-Form -</B> Dieses ist, wo Sie die kundenspezifische Webseiteeinstellen können, die geöffnet ist, wenn der Benutzer an dieNETZ-FORM-Taste klickt.

<BR>
<A NAME="vicidial_campaigns-allow_closers">
<BR>
<B>Erlauben Sie Closers -</B> Dieses ist, wo Sie einstellen können, obdie Benutzer dieser Kampagne die Wahl haben, zum des Anrufs zu einemgenauerem zu schicken.

<BR>
<A NAME="vicidial_campaigns-dial_status">
<BR>
<B>Vorwahlknopf-Status -</B> Dieses ist, wohin Sie die Status einstellen,die Sie an innerhalb der Listen wählen wünschen, die für dieKampagne unten aktiv sind

<BR>
<A NAME="vicidial_campaigns-lead_order">
<BR>
<B>Liste Auftrag -</B> Dieses Menü ist, wo Sie vorwählen, wie dieLeitungen, die die Status zusammenbringen, die oben vorgewähltwerden, in den Leitung Zufuhrbehälter eingesetzt werden:
 <BR> &nbsp; - DOWN: wählen Sie die ersten Leitungen vor, die in die vicidial_list Tabellegeladen werden
 <BR> &nbsp; - UP: wählen Sie die letzten Leitungen vor, die in die vicidial_listTabelle geladen werden
 <BR> &nbsp; - UP PHONE: wählen Sie die höchste Telefonnummer und die Arbeiten seine Weiseunten vor
 <BR> &nbsp; - DOWN PHONE: wählen Sie die niedrigste Telefonnummer und die Arbeiten seine Weiseoben vor
 <BR> &nbsp; - UP LAST NAME: Anfänge mit letzten Namen beginnend mit Z und Arbeiten seine Weiseunten
 <BR> &nbsp; - DOWN LAST NAME: Anfänge mit letzten Namen beginnend mit A und Arbeiten seine Weiseoben
 <BR> &nbsp; - UP COUNT: Anfänge mit benannten Leitungen und Arbeiten seine Weise unten
 <BR> &nbsp; - DOWN COUNT: Anfänge mit wenigen benannten Leitungen und Arbeiten seine Weiseoben
 <BR> &nbsp; - DOWN COUNT 2nd NEW: Anfänge mit wenigen benannten Leitungen und Arbeiten seine Weise, dieoben eine NEUE Leitung in jeder anderen Leitung einsetzt - dürfenNICHT NEUES haben vorgewählt in den Vorwahlknopfstatus
 <BR> &nbsp; - DOWN COUNT 3nd NEW: Anfänge mit wenigen benannten Leitungen und Arbeiten seine Weise, dieoben eine NEUE Leitung in jeder dritten Leitung einsetzt - dürfenNICHT NEUES haben vorgewählt in den Vorwahlknopfstatus
 <BR> &nbsp; - DOWN COUNT 4th NEW: Anfänge mit wenigen benannten Leitungen und Arbeiten seine Weise, dieoben eine NEUE Leitung in jedem einsetzt weiter, führen Sie - darfNICHT NEUES haben vorgewählt in den Vorwahlknopfstatus

<BR>
<A NAME="vicidial_campaigns-hopper_level">
<BR>
<B>Zufuhrbehälter waagerecht ausgerichtet -</B> Dieses ist, wieviele dieVDhopper Indexversuche führt, um in der vicidial_hopper Tabelle fürdiese Kampagne zu halten. Wenn Sie VDhopper Index jede Minute laufenlassen, bilden Sie dieses etwas grösser als die Zahl Leitungen, dieSie in eine Minute durchmachen.

<BR>
<A NAME="vicidial_campaigns-lead_filter_id">
<BR>
<B>Leitung Filter -</B> Dieses ist eine Methode der Entstörung IhrerLeitungen mit einem Fragment einer SQL Frage. Benutzen Sie dieseFunktion mit Vorsicht, es ist einfach mit, der geringfügigstenÄnderung zur SQL Aussage versehentlich zu wählen zu stoppen.Rückstellung ist KEINE.

<BR>
<A NAME="vicidial_campaigns-force_reset_hopper">
<BR>
<B>Kraft-Zurückstellen des Zufuhrbehälters -</B> erlaubt dieses Ihnen,aus dem Zufuhrbehälterinhalt nach Formunterordnung abzuwischen. Essollte wieder gefüllt werden, wenn der VDhopper Index läuft.

<BR>
<A NAME="vicidial_campaigns-dial_method">
<BR>
<B>Vorwahlknopf-Methode -</B> Dieses fangen ist die Weise, wie auf das Wählen zu definieren, stattfinden soll. Wenn HANDBUCH dann das auto_dial_level bei 0 verschlossen ist, es sei denn Vorwahlknopf-Methode geändert wird. Wenn VERHÄLTNIS dann der Normal, der eine Zeilenzahl für aktive Mittel wählt. ADAPT_HARD_LIMIT wählt predictively bis zum fallengelassenen Prozentsatz und dann erlaubt nicht das konkurrenzfähige Wählen, sobald die Tropfenbegrenzung erreicht wird, bis der Prozentsatz unten wieder geht. ADAPT_TAPERED läßt laufenden Überschuß den fallengelassenen Prozentsatz zur Hälfte erste der Verschiebung zu - wie durch das call_time definiert, das für Kampagne vorgewählt wird und erhält strenger, während die Verschiebung weitergeht. ADAPT_AVERAGE versucht, einen Durchschnitt oder den fallengelassenen Prozentsatz beizubehalten so, die konkurrenzfähig harte Begrenzungen nicht wie die anderen zwei Methoden auferlegen. Sie können nicht das Selbstvorwahlknopf-Niveau ändern, wenn Sie in irgendwelchen der ANPASSENVORWAHLKNOPFMETHODEN sind. Nur der Dialer kann das Vorwahlknopfniveau ändern wenn im vorbestimmten wählenden Modus.

<BR>
<A NAME="vicidial_campaigns-auto_dial_level">
<BR>
<B>Selbstvorwahlknopf-Niveau -</B> Dieses ist, wohin Sie einstellen,wieviele VICIDIAL sollte pro Mittel 0 verwenden des aktiven Mittelsnull zeichnet, Automobil, daswählen aus ist und die Mittel klicken,um jede Nummer zu wählen. Andernfalls hält VICIDIALWählverbindungen gleich den aktiven Mitteln, die mit demVorwahlknopfniveau multipliziert werden, um zu, wievielen Linien zukommen diese Kampagne auf jedem Bediener erlauben sollte.

<BR>
<A NAME="vicidial_campaigns-available_only_ratio_tally">
<BR>
<B>Vorhandenes nur Tally -</B> dieses fangen auf, wenn Satz zu YINCALL und WARTESCHLANGE Statusmittel ausläßt, wenn er die ZahlAnrufen zum Vorwahlknopf wenn nicht in MANUELLEN Vorwahlknopfmoduserrechnet. Rückstellung ist N.

<BR>
<A NAME="vicidial_campaigns-adaptive_dropped_percentage">
<BR>
<B>Tropfen-Prozentsatz-Begrenzung -</B> dieses fangen ist auf, wohinSie die Begrenzung auf den Prozentsatz der fallengelassenen Anrufe,die einstellten Sie beim Verwenden eineranpassungsfähig-vorbestimmten Vorwahlknopfmethode möchten, nichtMANUELL oder des VERHÄLTNISSES.

<BR>
<A NAME="vicidial_campaigns-adaptive_maximum_level">
<BR>
<B>Maximum paßt den waagerecht ausgerichteten Vorwahlknopf an -</B> diesesfangen ist auf, wohin Sie die Begrenzung auf die Begrenzungauf das numbr der Linien, die einstellten Sie gewählt pro Mittel beimVerwenden einer anpassungsfähig-vorbestimmten Vorwahlknopfmethodemöchten, nicht MANUELL oder des VERHÄLTNISSES. Diese Zahl kann alsdas Selbstvorwahlknopf-Niveau höher sein, wenn Ihre Kleinteile esstützen. Wert muß eine positive Nr. grösser als eine sein und kannDezimalstellen Rückstellung 3.0 haben.

<BR>
<A NAME="vicidial_campaigns-adaptive_latest_server_time">
<BR>
<B>Neueste Bediener-Zeit -</B> dieses fangen wird verwendet nurdurch die ADAPT_TAPERED Vorwahlknopfmethode auf. Sie sollten in dieStunde hereinkommen und Minute, um der Sie stoppen, diese Kampagne zuersuchen, 2100 würde bedeuten, daß Sie stoppen, diese Kampagne bei9PM Bedienerzeit zu wählen. Dieses läßt den sich verjüngendenAlgorithmus entscheiden wie konkurrenzfähig zum Vorwahlknopf durch,wie lang Sie haben, bis Sie fertiges Benennen sind.

<BR>
<A NAME="vicidial_campaigns-adaptive_intensity">
<BR>
<B>Passen Sie Intensität Modifizierfaktor an -</B> dieses fangenwird verwendet, die vorbestimmte höhere oder niedrigere Intensitätzu justieren entweder auf. Das höhere eine positive Zahl, die Sievorwählen, grösser der Dialer den schreitenen Anruf erhöht, wenn esgeht oben und langsam der Dialer den schreitenen Anruf verringert,wenn es geht unten. Das niedriger die negative Zahl, Sie vorwählenhier, langsam erhöht der Dialer den schreitenen Anruf und schnellersenkt der Dialer den schreitenen Anruf, wenn es geht unten.Rückstellung ist 0. Dieses fangen wird verwendet nicht durchden HANDBUCH- oder VERHÄLTNIS-Vorwahlknopf Methoden auf.

<BR>
<A NAME="vicidial_campaigns-adaptive_dl_diff_target">
<BR>
<B>Vorwahlknopf-waagerecht ausgerichtetes Unterschied-Ziel -</B> diesesfangen wird verwendet zu definieren auf, ob Sie Haben einerspezifischen Anzahl von den Mitteln zielen möchten, die Anruf- oderAnklopfenmittel warten. Z.B. wenn Sie immer auf Durchschnitt einerMittel haben möchten frei, Anrufe sofort zu nehmen, würden Siedieses bis -1 einstellen, wenn Sie ein immer haben zielen möchtenersuchen um den Einfluß, der ein Mittel wartet, das Sie dieses bis 1einstellen würden. Rückstellung ist 0. Dieses fangen wirdverwendet nicht durch den HANDBUCH- oder VERHÄLTNIS-VorwahlknopfMethoden auf.

<BR>
<A NAME="vicidial_campaigns-next_agent_call">
<BR>
<B>Folgender Vertreter-Anruf -</B> Dieses stellt fest, welches Mittel denfolgenden Anruf empfängt, der vorhanden ist:
 <BR> &nbsp; - random: Aufträge durch den gelegentlichen Updatewert in dervicidial_live_agents Tabelle
 <BR> &nbsp; - oldest_call_start: Aufträge bis zum dem letzten Mal ein Mittel wurden einem Anrufgeschickt. Resultate in den Mitteln, die insgesamt ungefähr gleicheZahl von Anrufen empfangen.
 <BR> &nbsp; - oldest_call_finish: Aufträge bis zum dem letzten Mal ein Mittel beendeten einen Anruf.Das AKA Mittel, das am längsten wartet, empfängt ersten Anruf.
 <BR> &nbsp; - overall_user_level: Aufträge durch das user_level des Mittels, wie inden vicidial_users definiert legen ein höheres user_level empfangenmehr Anrufe ver.

<BR>
<A NAME="vicidial_campaigns-local_call_time">
<BR>
<B>Ortsgespräch-Zeit -</B> Dieses ist, wohin Sie während welcherStunden Sie wählen möchten, wie bis zum der lokalen Zeit infestgestellt sind einstellten in, welchem Sie benennen. Dieses wirddurch Ortsnetzkennzahl gesteuert und wird auf Tageslicht-SparungenZeit eingestellt, wenn anwendbar. Allgemeine Richtlinien in den USAfür Geschäft zum Geschäft ist 9am bis 5pm und Geschäft zu denVerbraucheranrufen ist 9am bis 9pm.

<BR>
<A NAME="vicidial_campaigns-dial_timeout">
<BR>
<B>Vorwahlknopf-Abschaltung -</B> Wenn Sie, Anrufe, die normalerweiseHängezustand wurden, nachdem die Abschaltung, die in extensions.confanstatt Abschaltung an dieser Menge Sekunden definiert wurde wurde,wenn sie kleiner ist, als die extensions.conf Abschaltung definiertwerden. Dieses läßt schnell ändernde Vorwahlknopfabschaltungen vomBediener zum Bediener und zum Begrenzen der Effekte zu einer einzelnenKampagne zu. Wenn Sie eine Menge antwortende Maschine oder VoicemailAnrufe haben, können Sie diesen Wert, bis zwischen 21-26 zu ändernversuchen und sehen wünschen, wenn Resultate verbessern.

<BR>
<A NAME="vicidial_campaigns-dial_prefix">
<BR>
<B>Vorwahlknopf-Präfix -</B> Dieses fangen zuläßt einen Wegdes Wählens leicht ändern auf, zum durch eine andere Methode zuerlöschen, ohne ein Umladen im Sternchen zu tun. Rückstellung ist 9gegründet nach einem 91NXXNXXXXXX im dialplan - extensions.conf.

<BR>
<A NAME="vicidial_campaigns-omit_phone_code">
<BR>
<B>Lassen Sie Telefon-Code aus -</B> dieses fangen erlaubt Ihnen,das phone_code auszulassen auffangen beim Wählen innerhalbVICIDIAL auf. Zum Beispiel wenn Sie in Großbritannien vonGroßbritannien wählen, würden Sie 44 innen haben, wie Ihrphone_code für alle Leitungen auffangen, aber Sie gerade 10Stellen in Ihrem dialplan extensions.conf wählen möchten, um Anrufeanstelle von 44 dann 10 Stellen zu setzen. Rückstellung ist N.

<BR>
<A NAME="vicidial_campaigns-campaign_cid">
<BR>
<B>Kampagne CallerID -</B> Dieses fangen zuläßt das Senden einer kundenspezifischen callerid Zahl bei den outbound Anrufen auf. Dieses ist die Zahl, die oben auf dem callerid der Person darstellen würde, die, Sie anrufen. Die Rückstellung ist UNBEKANNT. Wenn Sie T1 benutzen, oder Eß, zum dieser Wahl heraus zu wählen nur vorhanden ist, wenn Sie PRIs verwenden - ISDN Tß oder Eß - die die kundenspezifische callerid Eigenschaft haben, die eingeschaltet wird, arbeitet dieses nicht mit Berauben-Spitze Service - RBS- Stromkreise. Dieses arbeitet auch durch das meiste VOIP - SIP oder IAX Stammversorger, die dynamisches outbound callerID erlauben. Das kundenspezifische callerID trifft nur auf die Anrufe zu, die direkt für die VICIDIAL Kampagne gesetzt werden, benennt jede mögliche 3. Partei, oder Übertragungen senden nicht das kundenspezifische callerID. ANMERKUNG: UNBEKANNT oder PRIVAT in auffangen manchmal sich setzen erbringt das Senden Ihrer Rückstellung callerID Zahl durch Ihre Fördermaschine mit den Anrufen. Sie können dieses prüfen wünschen und fangen 0000000000 in das callerid sich zu setzen anstatt auf, wenn Sie nicht Ihnen CallerID schicken möchten.

<BR>
<A NAME="vicidial_campaigns-campaign_vdad_exten">
<BR>
<B>Kampagne VDAD Verlängerung -</B> Dieses fangen zuläßt eineGewohnheit VDAD Übergangsverlängerung auf. Dieses erlaubt Ihnen,unterschiedliche VDADtransfer... agi Indexe zu benutzen, abhängendnach Ihrer Kampagne. Die Rückstellung Übertragung AGI - exten 8365agi-VDADtransfer.agi - gerade sendet sofort ersucht zu den Mitteln,sobald sie aufgehoben werden. Eine zusätzliches BeispielpolitischeÜbersicht AGI ist auch jetzt eingeschlossenes - 8366agi-VDADtransferSURVEY.agi - dieses Spiele eine Anzeige zurangerufenen Person und läßt sie eine Wahl treffen, indem sie Tastenbetätigt - effektiv Vorsiebung die Leitung -. Merken Sie bitte dasaußer Übersichten, politische Anrufe und Nächstenliebe diese Formdes Benennens ist in den Vereinigten Staaten ungültig.

<BR>
<A NAME="vicidial_campaigns-campaign_rec_exten">
<BR>
<B>Kampagne Rec Verlängerung -</B> Dieses fangen darf auf,damit eine kundenspezifische Aufnahmeverlängerung mit VICIDIALverwendet werden kann. Dieses erlaubt Ihnen, unterschiedlicheVerlängerungen zu verwenden, abhängend nach, wie lang Sie einemaximale Aufnahme erlauben möchten und welcher Art von Codec Sieinnen notieren möchten. Die Rückstellung exten ist 8309, die, wennSie folgen die SCRATCH_INSTALL Beispiele im WAV Format bis zu einerStunde lang notieren. Eine andere Wahl, die in den Beispieleneingeschlossen ist, ist 8310, die im G/M Format bis zu einer Stundelang notieren.

<BR>
<A NAME="vicidial_campaigns-campaign_recording">
<BR>
<B>Kampagne Aufnahme -</B> dieses Menü erlaubt Ihnen, zu wählen, welchesNiveau der Aufnahme auf dieser Kampagne erlaubt wird. NIE sperrtAufnahme auf dem Klienten. ONDEMAND ist die Rückstellung und erlaubtdem Vertreter zu notieren zu beginnen und, zu stoppen, wie gebraucht.ALLCALLS beginnt Aufnahme auf dem Klienten, wann immer ein Anruf zueinem Mittel geschickt wird. ALLFORCE beginnt Aufnahme auf demKlienten, wann immer ein Anruf zu einem Mittel geschickt wird, das demMittel keine Wahl gibt, um zu notieren zu stoppen. Für ALLCALLS undALLFORCE gibt es eine Wahl, zum der Aufnahme zu benutzen verzögert,um unten auf sehr kurze Aufnahmen und recude Anlagen-Belastung zuschneiden.

<BR>
<A NAME="vicidial_campaigns-campaign_rec_filename">
<BR>
<B>Kampagne Rec Dateiname -</B> Dieses fangen erlaubt Ihnen, denNamen der Aufnahme besonders anzufertigen auf, wenn Kampagne AufnahmeONDEMAND oder ALLCALLS ist. Die erlaubten Variablen sind KAMPAGNECUSTPHONE FULLDATE TINYDATE EPOCHE-MITTEL. Die Rückstellung istFULLDATE_MITTELund würde wie dieses 20051020-103108_6666 aussehen.Ein anderes Beispiel ist CAMPAIGN_TINYDATE_CUSTPHONE, das wie diesesTESTCAMP_51020103108_3125551212 aussehen würde. 50 char max.

<BR>
<A NAME="vicidial_campaigns-allcalls_delay">
<BR>
<B>Das Notieren verzögert -</B> für ALLCALLS und ALLFORCE nur Aufnahme.Dieser Einstellung Wille verzögert das Beginnen der Aufnahme beiallen Anrufen für die Zahl den Sekunden, die diesbezüglichspezifiziert werden, auffangen. Rückstellung ist 0.

<BR>
<A NAME="vicidial_campaigns-campaign_script">
<BR>
<B>Kampagne Index -</B> Dieses Menü erlaubt Ihnen, den Index zu wählen,der auf dem Mittelschirm für diese Kampagne erscheint. Wählen SieKEINE vor, keinen Index für diese Kampagne zu zeigen.

<BR>
<A NAME="vicidial_campaigns-get_call_launch">
<BR>
<B>Erhalten Sie Anruf-Produkteinführung -</B> Dieses Menü erlaubt Ihnenzu wählen, ob Sie Automobil-ausstoßen die Netz-Form Seite in einemunterschiedlichen Fenster, Auto-switch zum INDEX-Vorsprung oder tunnichts wünschen, wenn ein Anruf zum Mittel für diese Kampagnegeschickt wird. 

<BR>
<A NAME="vicidial_campaigns-am_message_exten">
<BR>
<B>Antwortende Maschine Anzeige -</B> Dieses fangen ist für dasHereinkommen auf, in eine Verlängerung, zum von von Übergangsanrufenzu blind zu machen, wenn das Mittel eine antwortende Maschine erhältund an die antwortende Maschine Anzeige Taste imÜbergangskonferenzrahmen klickt. Sie müssen dieses einstellen extenoben im dialplan - extensions.conf - und sicherstellen, daß esspielt, eine Audioakte dann oben hängt. 

<BR>
<A NAME="vicidial_campaigns-amd_send_to_vmx">
<BR>
<B>AMD senden zu VM exten -</B> erlaubt dieses Menü Ihnen zu definieren,ob eine Anzeige auf einer antwortenden Maschine gelassen wird, wennihr der Anruf wird sofort nachgeschickt zur Antworten-Maschine-AnzeigeVerlängerung ermittelt wird, wenn AMD aktiv ist und es festgestelltwird, daß der Anruf eine antwortende Maschine ist.

<BR>
<A NAME="vicidial_campaigns-xferconf_a_dtmf">
<BR>
<B>Xfer-Conf DTMF -</B> Diese vier fängt dürfen auf, damit Siezwei Sätze Übergangskonferenz und DTMF Voreinstellungen haben. Wennder Anruf oder die Kampagne geladen wird, stellt der vicidial.phpIndex dar, daß zwei Tasten auf dem Bringenkonferenz Rahmen und denZahl-zu-Vorwahlknopf und senden-dtmf Automobil-zu bevölkernauffängt, wenn sie betätigt werden. Wenn Sie beratende Übertragungen erlauben möchten, ein fronter zueinem genauerem, können Sie CXFER setzen, da eins derZahl-zu-Vorwahlknopf Voreinstellungen und des korrekten Dialstringsgesendet wird, um eine lokale beratende Übertragung, dann dieMitteldose gerechtes LEAVE-3WAY-CALL und Bewegung an zu tun zu ihremfolgenden Anruf. Wenn Sie blinde Übertragungen der Kunden auf einenVICIDIAL AGI Index für die Protokollierung oder ein IVR erlaubenmöchten, legen Sie dann AXFER in den Zahl-zu-Vorwahlknopfauffangen. Sie können eine kundenspezifische Verlängerungnach dem AXFER oder dem CXFER auch spezifizieren, zum Beispiel wennSie interne beratende Übertragungen anstelle vom Einheimischen tunmöchten, würden Sie CXFER90009 in den Zahl-zu-Vorwahlknopfauffangen einsetzen.

<BR>
<A NAME="vicidial_campaigns-alt_number_dialing">
<BR>
<B>Numerisches Wählen des Mittel-Alt -</B> erlaubt diese Wahl einemVertreter, die wechselnde Telefonnummer manuell zu wählen, oderaddress3 fangen auf, nachdem die Hauptzahl benannt wordenist.

<BR>
<A NAME="vicidial_campaigns-scheduled_callbacks">
<BR>
<B>Zeitlich geplante Wiederholungsbesuche -</B> Diese Wahl erlaubt einemMittel zur Einteilung einen Anruf als CALLBK und wählt die Daten unddie Zeit, an denen die Leitung reaktiviert wird.

<BR>
<A NAME="vicidial_campaigns-drop_call_seconds">
<BR>
<B>Sekunden zur Verbindung -</B> Anzahl der Sekunden vom Abnehmen des Kunden bis zur Erkennung als Verbindung, betrifft nur abgehende Verbindungen.

<BR>
<A NAME="vicidial_campaigns-voicemail_ext">
<BR>
<B>Voicemail -</B> Wenn sie definiert werden, würden Anrufe, dienormalerweise FALLEN würden, anstatt auf diesen voicemail Kastenverwiesen, um eine Anzeige zu hören und zu lassen.

<BR>
<A NAME="vicidial_campaigns-safe_harbor_message">
<BR>
<B>Sicherheitsnachricht -</B> Wenn auf Y gesetzt wird dem Kunden nach Ablauf der Sekunden zur Verbindung, ohne zu einem Agenten verbunden worden zu sein, eine Nachricht abgespielt. Diese Einstellung setzt die Option Senden zu einer Voicemail Kasten ausser Kraft, wenn diese auf Y steht.

<BR>
<A NAME="vicidial_campaigns-safe_harbor_exten">
<BR>
<B>Sicherheitsnebenstelle -</B> Dies ist die Wählplan Nebenstelle, wo sich die gewünschte Sicherheits-Audiodatei auf Ihrem Server befindet.

<BR>
<A NAME="vicidial_campaigns-wrapup_seconds">
<BR>
<B>Sekunden Nachbereitung -</B> Anzahl der Sekunden, die ein Agent bis zum nächsten erhaltenen Anruf oder Wählen eines anderen Anrufs warten muss. Die Zeit beginnt, sobald ein Agent bei seinem Kunden aufgelegt hat - oder im Fall der alternativen Nummernwahl, wenn ein Agent das Telefonat beendet - Standard ist 0 Sekunden. Wenn die Zeit abgelaufen ist bevor der Agent den Anruf eingeordnet hat, wird der Agent dennoch nicht zum nächsten Anruf kommen, bevor er eine Einteilung gewählt hat.

<BR>
<A NAME="vicidial_campaigns-wrapup_message">
<BR>
<B>Nachbereitungsnachricht -</B> Dies ist eine Kampagnen-spezifische Nachricht, die bei gesetzten Sekunden Nachbereitung auf dem Nachbereitungsbildschirm angezeigt wird.

<BR>
<A NAME="vicidial_campaigns-wrapup_message">
<BR>
<B>Nachbereitungsnachricht -</B> Dies ist eine Kampagnen-spezifische Nachricht, die bei gesetzten Sekunden Nachbereitung auf dem Nachbereitungsbildschirm angezeigt wird.

<BR>
<A NAME="vicidial_campaigns-use_internal_dnc">
<BR>
<B>Interne DNC Liste des Gebrauch-</B>- definiert dieses, ob dieseKampagne Leitungen gegen die interne DNC Liste filtern soll. Wenn esauf Y eingestellt wird, sucht der Zufuhrbehälter nach jederTelefonnummer in der DNC Liste, bevor er sie in den Zufuhrbehälterlegt. Wenn er in der DNC Liste ist, dann, das sie dieses führt Statuszu DNCL also ändert, kann sie nicht gewählt werden. Rückstellungist N.

<BR>
<A NAME="vicidial_campaigns-closer_campaigns">
<BR>
<B>Gewährte Inbound Gruppen -</B> For CLOSER campaigns only. Here is where you select the inbound groups you want agents in this CLOSER campaign to be able to take calls from. It is important for BLENDED inbound-outbound campaigns only to select the inbound groups that are used for agents in this campaign. The calls coming into the inbound groups selected here will be counted as active calls for a blended campaign even if all agents in the campaign are not logged in to receive calls from all of those selected inbound groups.



<BR><BR><BR><BR>

<B><FONT SIZE=3>VICIDIAL_LISTENTABELLE</FONT></B><BR><BR>
<A NAME="vicidial_lists-list_id">
<BR>
<B>Liste Identifikation -</B> Dieses ist der numerische Name der Liste,es ist nicht editable nach Ausgangsunterordnung, muß nur Zahlenenthalten und muß zwischen 2 und 8 Buchstaben lang sein. Must be a number greater than 100.

<BR>
<A NAME="vicidial_lists-list_name">
<BR>
<B>Liste Name -</B> This is the description of the list, it must be between 2 and 20 characters in length.

<BR>
<A NAME="vicidial_lists-campaign_id">
<BR>
<B>Kampagne -</B> This is the campaign that this list belongs to. A list can only be dialed on a single campaign at one time.

<BR>
<A NAME="vicidial_lists-active">
<BR>
<B>Aktiv -</B> Dieses definiert, ob die Liste an oder nicht gewähltwerden soll.

<BR>
<A NAME="vicidial_lists-reset_list">
<BR>
<B>Stellen Sie Führen-Benennen-Status für diese Liste -</B> zurückstellt dieses alle Leitungen in dieser Liste zu N für das benannte\"not da letztes Zurückstellen \" zurück und bedeutet, daß jedemögliche Leitung jetzt benannt werden kann, wenn es der rechte Statusist, wie auf dem Kampagne Schirm definiert.

<BR>
<A NAME="vicidial_list-dnc">
<BR>
<B>VICIDIAL DNC Liste -</B> Dieses benennen nicht Liste enthält jedeLeitung, die auf einen Status von DNC im System eingestellt wordenist. Durch die LISTEN - FÜGEN Sie ZAHL DNC Seite hinzu, die Sie inder LageSIND, eine Zahl dieser Liste manuell hinzuzufügen, damit sienicht durch Kampagnen benannt wird, die die interne DNC Listebenutzen.



<BR><BR><BR><BR>

<B><FONT SIZE=3>VICIDIAL_INBOUND_GROUPSTABELLE</FONT></B><BR><BR>
<A NAME="vicidial_inbound_groups-group_id">
<BR>
<B>Gruppe Identifikation -</B> Dieses ist der kurze Name der inboundGruppe, es ist nicht editable nach Ausgangsunterordnung, darf keineRäume enthalten und muß zwischen 2 und 20 Buchstaben lang sein.

<BR>
<A NAME="vicidial_inbound_groups-group_name">
<BR>
<B>Gruppe Name -</B> Dieses ist die Beschreibung der Gruppe, muß eszwischen 2 und 30 Buchstaben lang sein. Kann nicht Schläge, plussesoder Räume einschließen .

<BR>
<A NAME="vicidial_inbound_groups-group_color">
<BR>
<B>Gruppe Farbe -</B> Dieses ist die Farbe, die in der VICIDIAL KlientAPP anzeigt, wenn ein Anruf auf diese Gruppe hereinkommt. Es mußzwischen 2 und 7 Buchstaben lang sein. Wenn dieses eine HexagonfarbeDefinition ist, müssen Sie sich erinnern, sich a # am Anfang derZeichenkette zu setzen, oder VICIDIAL arbeitet nicht richtig.

<BR>
<A NAME="vicidial_inbound_groups-active">
<BR>
<B>Aktiv -</B> Dieses stellt fest, ob diese Gruppe oben imVorwählerkasten wenn Maschinenbordbücher eines VICIDIAL Mittelsinnen zeigen.

<BR>
<A NAME="vicidial_inbound_groups-web_form_address">
<BR>
<B>Netz-Form -</B> Dieses ist die kundenspezifische Adresse, die dasKlicken auf der NETZ-FORM-Taste in VICIDIAL Ihnen für zu den Anrufennimmt, die auf diese Gruppe hereinkommen.

<BR>
<A NAME="vicidial_inbound_groups-next_agent_call">
<BR>
<B>Folgender Vertreter-Anruf -</B> Dieses stellt fest, welches Mittel denfolgenden Anruf empfängt, der vorhanden ist:
 <BR> &nbsp; - random: Aufträge durch den gelegentlichen Updatewert in dervicidial_live_agents Tabelle
 <BR> &nbsp; - oldest_call_start: Aufträge bis zum dem letzten Mal ein Mittel wurden einem Anrufgeschickt. Resultate in den Mitteln, die insgesamt ungefähr gleicheZahl von Anrufen empfangen.
 <BR> &nbsp; - oldest_call_finish: Aufträge bis zum dem letzten Mal ein Mittel beendeten einen Anruf.Das AKA Mittel, das am längsten wartet, empfängt ersten Anruf.
 <BR> &nbsp; - overall_user_level: Aufträge durch das user_level des Mittels, wie inden vicidial_users definiert legen ein höheres user_level empfangenmehr Anrufe ver.

<BR>
<A NAME="vicidial_inbound_groups-fronter_display">
<BR>
<B>Fronter Anzeige -</B> Dieses fangen feststellt auf, ob dasinbound VICIDIAL Mittel den fronter Namen - wenn es einen gibt -angezeigt im Status auffangen haben würde, wann der Anrufzum Mittel kommt.

<BR>
<A NAME="vicidial_inbound_groups-ingroup_script">
<BR>
<B>Kampagne Index -</B> Dieses Menü erlaubt Ihnen, den Index zu wählen,der auf dem Mittelschirm für diese Kampagne erscheint. Wählen SieKEINE vor, keinen Index für diese Kampagne zu zeigen.

<BR>
<A NAME="vicidial_inbound_groups-get_call_launch">
<BR>
<B>Erhalten Sie Anruf-Produkteinführung -</B> Dieses Menü erlaubt Ihnenzu wählen, ob Sie Automobil-ausstoßen die Netz-Form Seite in einemunterschiedlichen Fenster, Auto-switch zum INDEX-Vorsprung oder tunnichts wünschen, wenn ein Anruf zum Mittel für diese Kampagnegeschickt wird. 

<BR>
<A NAME="vicidial_inbound_groups-xferconf_a_dtmf">
<BR>
<B>Xfer-Conf DTMF -</B> Diese vier fängt dürfen auf, damit Siezwei Sätze Übergangskonferenz und DTMF Voreinstellungen haben. Wennder Anruf oder die Kampagne geladen wird, stellt der vicidial.phpIndex dar, daß zwei Tasten auf dem Bringenkonferenz Rahmen und denZahl-zu-Vorwahlknopf und senden-dtmf Automobil-zu bevölkernauffängt, wenn sie betätigt werden. Wenn Sie beratende Übertragungen erlauben möchten, ein fronter zueinem genauerem, können Sie CXFER setzen, da eins derZahl-zu-Vorwahlknopf Voreinstellungen und des korrekten Dialstringsgesendet wird, um eine lokale beratende Übertragung, dann dieMitteldose gerechtes LEAVE-3WAY-CALL und Bewegung an zu tun zu ihremfolgenden Anruf. Wenn Sie blinde Übertragungen der Kunden auf einenVICIDIAL AGI Index für die Protokollierung oder ein IVR erlaubenmöchten, legen Sie dann AXFER in den Zahl-zu-Vorwahlknopfauffangen. Sie können eine kundenspezifische Verlängerungnach dem AXFER oder dem CXFER auch spezifizieren, zum Beispiel wennSie interne beratende Übertragungen anstelle vom Einheimischen tunmöchten, würden Sie CXFER90009 in den Zahl-zu-Vorwahlknopfauffangen einsetzen.

<BR>
<A NAME="vicidial_inbound_groups-drop_call_seconds">
<BR>
<B>Sekunden zur Verbindung -</B> Anzahl der Sekunden vom Abnehmen des Kunden bis zur Erkennung als Verbindung, betrifft nur abgehende Verbindungen.

<BR>
<A NAME="vicidial_inbound_groups-voicemail_ext">
<BR>
<B>Voicemail -</B> Wenn sie definiert werden, würden Anrufe, dienormalerweise FALLEN würden, anstatt auf diesen voicemail Kastenverwiesen, um eine Anzeige zu hören und zu lassen.

<BR>
<A NAME="vicidial_inbound_groups-drop_message">
<BR>
<B>Verbindungs-Nachricht-</B> Wenn auf Y gesetzt wird dem Kunden nach Ablauf der Sekunden zur Verbindung, ohne zu einem Agenten verbunden worden zu sein, eine Nachricht abgespielt. Diese Einstellung setzt die Option Senden zu einer Voicemail Kasten ausser Kraft, wenn diese auf Y steht.

<BR>
<A NAME="vicidial_inbound_groups-drop_exten">
<BR>
<B>Verbindungs-Nebenstelle -</B> Dies ist die Wählplan-Nebenstelle, wo sich die gewünschte Audiodatei für die aufgebaute Verbindung auf Ihrem Server befindet.



<BR><BR><BR><BR>

<B><FONT SIZE=3>VICIDIAL_REMOTE_AGENTSTABELLE</FONT></B><BR><BR>
<A NAME="vicidial_remote_agents-user_start">
<BR>
<B>Benutzernummer Anfang -</B> Dieses ist die beginnende Benutzernummer,die verwendet wird, wenn die Remotemitteleintragungen in das Systemeingesetzt werden. Wenn die Zeilenzahl in hohem Grade als 1eingestellt wird, wird diese Zahl durch eine erhöht, bis jede Linieeine Eintragung hat. Stellen Sie, ein neues VICIDIAL Benutzerkonto miteinem Benutzerniveau von 4 zu verursachen oder groß sicher, wenn Siesie in der LageSEIN wünschen, die vdremote.php Seite fürRemotenetzzugang dieses Kontos zu benutzen.

<BR>
<A NAME="vicidial_remote_agents-number_of_lines">
<BR>
<B>Zeilenzahl -</B> Dieses definiert, wievieles Remotemittel Eintragungendas System verursacht, und stellt fest, wieviele Linien es denkt, daßes zur Zahl unter sicher senden kann.

<BR>
<A NAME="vicidial_remote_agents-server_ip">
<BR>
<B>Bediener IP -</B> Eine Remotemitteleintragung ist für einenspezifischen Bediener, ist hier nur gut, wo Sie vorwählen, dasBediener Sie wünschen.

<BR>
<A NAME="vicidial_remote_agents-conf_exten">
<BR>
<B>Externe Verlängerung -</B> Dieses ist die Zahl, daß Sie die Anrufewünschen, die zu nachgeschickt werden. Überprüfen Sie, ob es einevolle dialplan Zahl ist und daß, wenn Sie 9 am Anfang benötigen, Sieihn innen hier setzen. Prüfen Sie, indem Sie diese Nummer von einemTelefon auf dem System wählen.

<BR>
<A NAME="vicidial_remote_agents-status">
<BR>
<B>Status -</B> Ist hier, wo Sie das Remotemittel an und abstellen.Sobald das Mittel aktiv ist, nimmt das System an, daß es Anrufe zuihm schicken kann. Es kann bis 30 Sekunden dauern, sobald Sie denStatus zu unaktiviertem ändern, um Anrufe, zu empfangen zu stoppen.

<BR>
<A NAME="vicidial_remote_agents-campaign_id">
<BR>
<B>Kampagne -</B> Ist hier, wo Sie die Kampagne vorwählen, daß dieseRemotemittel in geloggt werden. Inbound Notwendigkeiten, die GENAUEREKampagne zu verwenden und die inbound Kampagnen unter dervorzuwählen, die Sie Anrufe von empfangen möchten.

<BR>
<A NAME="vicidial_remote_agents-closer_campaigns">
<BR>
<B>Inbound Gruppen -</B> Ist hier, wo Sie die inbound Gruppen vorwählen,die Sie Anrufe von empfangen möchten, wenn Sie die GENAUERE Kampagnevorgewählt haben.


<BR><BR><BR><BR>

<B><FONT SIZE=3>VICIDIAL_CAMPAIGN_LISTEN</FONT></B><BR><BR>
<A NAME="vicidial_campaign_lists">
<BR>
<B>Die Listen innerhalb dieser Kampagne werden hier verzeichnet, ob siewerden bezeichnet durch das Y aktiv sind, oder N und Sie zum ListeSchirm gehen können, indem sie auf der Liste Identifikation in derersten Spalte klicken.</B>


<BR><BR><BR><BR>

<B><FONT SIZE=3>VICIDIAL_CAMPAIGN_STATUSESTABELLE</FONT></B><BR><BR>
<A NAME="vicidial_campaign_statuses">
<BR>
<B>Durch den Gebrauch von kundenspezifischen Kampagne Status, können SieStatus haben, die nur für eine spezifische Kampagne bestehen. DerStatus muß 1-8 Buchstaben lang sein, muß die Beschreibung 2-30Buchstaben lang sein und auswählbar definiert, ob es oben in VICIDIALals Einteilung zeigt.</B>



<BR><BR><BR><BR>

<B><FONT SIZE=3>VICIDIAL_CAMPAIGN_HOTKEYSTABELLE</FONT></B><BR><BR>
<A NAME="vicidial_campaign_hotkeys">
<BR>
<B>Durch den Gebrauch von kundenspezifischen Kampagne hotkeys, benenntVertreter, die verwenden, der vicidial Netz-Klient Dose Hängezustandund Einteilung, gerade indem sie einen einzelnen Schlüssel auf ihrerTastatur betätigen.</B>




<BR><BR><BR><BR>

<B><FONT SIZE=3>VICIDIAL_LEAD_RECYCLETABELLE</FONT></B><BR><BR>
<A NAME="vicidial_lead_recycle">
<BR>
<B>Durch den Gebrauch von Leitung aufbereitend, können Sie spezifischeStatus der Leitungen in einem spezifizierten Abstand wieder benennen,ohne die gesamte Liste zurückzustellen. Die Leitung Wiederverwertungist Kampagne-spezifisch und muß nicht ein vorgewählter dialableStatus in Ihrer Kampagne sein. Der Versuch verzögertauffangen ist die Zahl Sekunden, bis die Leitung in denZufuhrbehälter zurück gelegt sein kann, diese Zahl muß mindestens120 Sekunden sein. Das Versuch Maximum fangen ist dieHöchstzahl der Zeiten auf, die eine Leitung dieses Status versuchtwerden kann, bevor die Liste zurückgestellt werden muß, diese Zahlkann von 1 bis 10 sein. Sie können aktivieren und eine Leitung zuentaktivieren bereiten Sie Eintragung mit den zur Verfügunggestellten Verbindungen auf. Diese Eigenschaft arbeitet nur imAutomobil-Vorwahlknopf Modus, in dem Vorwahlknopfniveau grösser als 0ist.</B>





<BR><BR><BR><BR>

<B><FONT SIZE=3>VICIDIAL_USER_GROUPSTABELLE</FONT></B><BR><BR>
<A NAME="vicidial_user_groups-user_group">
<BR>
<B>Benutzer-Gruppe -</B> Dieses ist der kurze Name einer VicidialBenutzergruppe, der Versuch, zum keiner Räume zu benutzen, oderInterpunktion für dieses fangen Maximum 20 Buchstaben,Minimum von 2 Buchstaben auf.

<BR>
<A NAME="vicidial_user_groups-group_name">
<BR>
<B>Gruppe Name -</B> Dieses ist die Beschreibung des vicidialBenutzergruppe Maximums von 40 Buchstaben.

<BR>
<A NAME="vicidial_user_groups-allowed_campaigns">
<BR>
<B>Erlaubte Kampagnen -</B> dieses ist eine auswählbare Liste der Kampagnen,zu denen Mitglieder dieser Benutzergruppe innen protokollieren könnenin. Die ALL-CAMPAIGNS Wahl erlaubt den Benutzern in dieser Gruppe, injeder möglicher Kampagne auf dem System innen zu sehen und zuprotokollieren.





<BR><BR><BR><BR>

<B><FONT SIZE=3>VICIDIAL_INDEXETABELLE</FONT></B><BR><BR>
<A NAME="vicidial_scripts-script_id">
<BR>
<B>Index Identifikation -</B> Dieses ist der kurze Name eines VicidialIndexes. Dieser muß ein einzigartiger Bezeichner sein. Der Versuch,zum keiner Räume oder die Interpunktion für dieses zu benutzenfangen Maximum 10 Buchstaben, Minimum von 2 Buchstaben auf.

<BR>
<A NAME="vicidial_scripts-script_name">
<B>Index-Name -</B> Dieses ist der Titel einem Vicidial Index. Dieses isteine kurze Zusammenfassung der Indexmaximum 50 Buchstaben, Minimum von2 Buchstaben. Es sollte keine Räume geben, oder Interpunktionirgendwie der Art in den theis fangen auf.

<BR>
<A NAME="vicidial_scripts-script_comments">
<B>Index kommentiert -</B> Dieses ist, wo Sie Anmerkungen für einenVicidial Index wie - geändert, um Aufsteigen an Sept. 23 freizugeben-. Maximum 255 Buchstaben setzen können, Minimum von 2 Buchstaben.

<BR>
<A NAME="vicidial_scripts-script_text">
<B>Index-Text -</B> This is where you place the content of a Vicidial Script. Minimum of 2 characters. You can have customer information be auto-populated in this script using "--A--field--B--" where field is one of the following fieldnames: vendor_lead_code, source_id, list_id, gmt_offset_now, called_since_last_reset, phone_code, phone_number, title, first_name, middle_initial, last_name, address1, address2, address3, city, state, province, postal_code, country_code, gender, date_of_birth, alt_phone, email, security_phrase, comments, lead_id, campaign, phone_login, group, channel_group, SQLdate, epoch, uniqueid, customer_zap_channel, server_ip, SIPexten, session_id. For example, this sentence would print the persons name in it----<BR><BR>  Hello, can I speak with --A--first_name--B-- --A--last_name--B-- please? Well hello --A--title--B-- --A--last_name--B-- how are you today?<BR><BR> This would read----<BR><BR>Hello, can I speak with John Doe please? Well hello Mr. Doe how are you today?<BR><BR> You can also use an iframe to load a separate window within the SCRIPT tab, here is an example with prepopulated variables:

<DIV style="height:200px;width:400px;background:white;overflow:scroll;font-size:12px;font-family:sans-serif;" id=iframe_example>
&#60;iframe src="http://astguiclient.sf.net/test_VICIDIAL_output.php?lead_id=--A--lead_id--B--&#38;vendor_id=--A--vendor_lead_code--B--&#38;list_id=--A--list_id--B--&#38;gmt_offset_now=--A--gmt_offset_now--B--&#38;phone_code=--A--phone_code--B--&#38;phone_number=--A--phone_number--B--&#38;title=--A--title--B--&#38;first_name=--A--first_name--B--&#38;middle_initial=--A--middle_initial--B--&#38;last_name=--A--last_name--B--&#38;address1=--A--address1--B--&#38;address2=--A--address2--B--&#38;address3=--A--address3--B--&#38;city=--A--city--B--&#38;state=--A--state--B--&#38;province=--A--province--B--&#38;postal_code=--A--postal_code--B--&#38;country_code=--A--country_code--B--&#38;gender=--A--gender--B--&#38;date_of_birth=--A--date_of_birth--B--&#38;alt_phone=--A--alt_phone--B--&#38;email=--A--email--B--&#38;security_phrase=--A--security_phrase--B--&#38;comments=--A--comments--B--&#38;user=--A--user--B--&#38;campaign=--A--campaign--B--&#38;phone_login=--A--phone_login--B--&#38;fronter=--A--fronter--B--&#38;closer=--A--user--B--&#38;group=--A--group--B--&#38;channel_group=--A--group--B--&#38;SQLdate=--A--SQLdate--B--&#38;epoch=--A--epoch--B--&#38;uniqueid=--A--uniqueid--B--&#38;customer_zap_channel=--A--customer_zap_channel--B--&#38;server_ip=--A--server_ip--B--&#38;SIPexten=--A--SIPexten--B--&#38;session_id=--A--session_id--B--&#38;phone=--A--phone--B--" style="width:460;height:290;background-color:transparent;" scrolling="auto" frameborder="0" allowtransparency="true" id="popupFrame" name="popupFrame" width="460" height="290"&#62;
&#60;/iframe&#62;
</DIV>

<BR>
<A NAME="vicidial_scripts-active">
<BR>
<B>Aktiv -</B> Dieses stellt fest, ob dieser Index vorgewählt werdenkann, durch eine Kampagne verwendet zu werden.





<BR><BR><BR><BR>

<B><FONT SIZE=3>VICIDIAL_LEAD_FILTERTABELLE</FONT></B><BR><BR>
<A NAME="vicidial_lead_filters-lead_filter_id">
<BR>
<B>Filter Identifikation -</B> Dieses ist der kurze Name eines VicidialLeitung Filter. Dieser muß ein einzigartiger Bezeichner sein.Benutzen Sie keine Räume, oder Interpunktion für diesesfangen Maximum 10 Buchstaben, Minimum von 2 Buchstaben auf.

<BR>
<A NAME="vicidial_lead_filters-lead_filter_name">
<B>Filter-Name -</B> Dieses ist ein beschreibenderer Name des Filter.Dieses ist eine kurze Zusammenfassung der Filtermaximum 30 Buchstaben,Minimum von 2 Buchstaben.

<BR>
<A NAME="vicidial_lead_filters-lead_filter_comments">
<B>Filter kommentiert -</B> Dieses ist, wo Sie Anmerkungen für einenVicidial Filter wie - Anrufe alle Kalifornien Leitungen -. Maximum 255Buchstaben setzen können, Minimum von 2 Buchstaben.

<BR>
<A NAME="vicidial_lead_filters-lead_filter_sql">
<B>Filter SQL -</B> Dieses ist, wohin Sie das SQL Frage Fragment setzen,das Sie vorbei filtern möchten anfangen nicht, oder Ende mit UND, dasdurch den Zufuhrbehälter cron Index automatisch hinzugefügt wird.eine Beispiel SQL Frage, die hier arbeiten würde, ist called_count \4 und called_count \.





<BR><BR><BR><BR>

<B><FONT SIZE=3>VICIDIAL_AnrufzeitenTABELLE</FONT></B><BR><BR>
<A NAME="vicidial_call_times-call_time_id">
<BR>
<B>Anrufzeit ID -</B> Dies ist der kurze Name von einer Vicidial Anrufzeit Definition. Es muss ein eindeutiger Bezeichner sein. Leerzeichen und Punkte sind in diesem Feld nicht erlaubt. Maximal 10 Zeichen, mindestens 2.

<BR>
<A NAME="vicidial_call_times-call_time_name">
<B>Anrufzeit Name -</B> Dies ist ein besser beschreibender Name für die Anrufzeit Definition. Es ist eine kurze Zusammenfassung der Anrufzeit Definition. Maximal 30 Zeichen, mindestens 2.

<BR>
<A NAME="vicidial_call_times-call_time_comments">
<B>Anrufzeit Kommentare -</B> Hier können Sie Kommentare für eine Vicidial Anrufzeit Definition wie -10 bis 14 Uhr mit eigenen Beschränkungen für das angerufene Land- machen. Maximal 255 Zeichen.

<BR>
<A NAME="vicidial_call_times-ct_default_start">
<B>Standard Start and Stop Zeiten -</B> Dies ist die Standardzeit, zu der Anrufe innerhalb der Anrufzeitdefinition gestartet oder gestoppt werden dürfen, wenn die Wochentag Startzeit nicht definiert ist. 0 ist Mitternacht. Um Anrufe komplett zu verhindern den Wert auf 2400 und die Standard Stopzeit ebenfalls auf 2400 setzen. Um Anrufe für 24 Stunden am Tag zu erlauben die Startzeit auf 0 und die Stopzeit auf 2400 setzen.

<BR>
<A NAME="vicidial_call_times-ct_sunday_start">
<B>Wochentag Start and Stop Zeit -</B> Dies sind die speziellen Zeiten pro Tag, welche für die Anrufzeit Definition gesetzt werden können. Es gelten die selben Regeln wie für Start und Stop Zeiten.

<BR>
<A NAME="vicidial_call_times-ct_state_call_times">
<B>Land Anrufzeit Definition -</B> Dies ist die Liste der landspezifischen Anrufzeit Definitionen, die von dieser Anrufzeit Definition beachtet werden.

<BR>
<A NAME="vicidial_call_times-state_call_time_state">
<B>Landesspezifische Anrufzeit Definition -</B> Dies ist der zwei Buchstaben Code für das Land, für das die Anrufzeit Definition gilt. Damit diese ausgeführt wird muss die in der Kampagne gesetzte lokale Anrufzeit diese landesspezifische Anrufzeit Aufzeichnung enthalten, genauso wie alle anzurufenden Anschlüsse den landesspezifischen zwei Buchstaben Code enthalten müssen .




<BR><BR><BR><BR>

<B><FONT SIZE=3>VICIDIAL LISTE LADEVORRICHTUNG FUNKTIONALITÄT</FONT></B><BR><BR>
<A NAME="vicidial_list_loader">
<BR>
Die VICIDIAL grundlegende Netz-gegründete Leitung Ladevorrichtung isteinfach entworfen, um eine Leitung Akte zu nehmen - bis zu 8MB in derGröße - die entweder Vorsprung oder das abgegrenzte Rohr und es indie vicidial_list Tabelle zu laden ist. Es gibt auch eine neueBetaversionsuperleitung Ladevorrichtung, das auffangen dasWählen zuläßt und TXT- deutlich Text, CSV- Komma getrennte Werteund XLS- übertreffen Akte Formate. Die Leitung Ladevorrichtung tutnicht Datenprüfung, oder Überprüfung auf Duplikate in sich oder inanderen Listen, damit etwas Sie ist, muß vor Ihnen Last tun dieLeitungen. Auch überprüfen Sie, ob Sie die Liste erstellt haben,daß diese Leitungen darunter sein sollen, damit Sie sie benutzenkönnen. Es gibt auch die Angelegenheit der Zeit-Zone-Kodierung dieseLeitungen. Sie können die Frequenz erhöhen wünschen, daß dasADMIN_adjust_GMTnow_on_leads.pl in das cron auf IhremSternchenbediener gelaufen wird, damit alle mögliche geladenenLeitungen schneller kodiert werden können. Ist hier eine Liste vonauffängt in ihrem korrekten Auftrag für die Leitung Akten:
	<OL>
	<LI>Verkäufer-Leitung Code - zeigt oben im Verkäufer, den Identifikationvom GUI auffangen
	<LI>Quellenprogramm - interner Gebrauch nur für admins und DBAs
	<LI>Liste Identifikation - die Liste Zahl, die diese Leitungen obendarunter zeigen
	<LI>Telefon-Code - das Präfix für die Telefonnummer - 1 für US, 01144für Großbritannien, 01161 für AUS, usw.
	<LI>Telefonnummer - muß mindestens 8 Stellen lang sein
	<LI>Titel - Titel dem Kunden - Herr Ms Mrs, usw....
	<LI>Vorname
	<LI>Mittlere Initiale
	<LI>Letzter Name
	<LI>Adresse Linie 1
	<LI>Adresse Linie 2
	<LI>Adresse Linie 3
	<LI>Stadt
	<LI>Zustand - begrenzt auf 2 Buchstaben
	<LI>Provinz
	<LI>Postcode
	<LI>Land
	<LI>Geschlecht
	<LI>Geburtsdatum
	<LI>Wechselnde Telefonnummer
	<LIEmailaddress
	<LI>Sicherheit Phrase
	<LI>Anmerkungen
	</OL>

<BR>ANMERKUNGEN: Die übertreffenleitung Ladevorrichtung Funktionalitätwird durch eine Reihe Perl Indexe ermöglicht und muß eine richtigzusammengebaute /home/cron/AST_SERVER_conf.pl Akte im Platz auf demweb server haben. Auch ein Paarperl Module müssen für sie, umaußerdem zu arbeiten - OLE-Storage_Lite-Storage_Lite undVerteilungsbogen-ParseExcel geladen werden. Sie können aufLaufzeitfehler in diesen überprüfen, indem Sie Ihre Apache error_logAkte betrachten.




<BR><BR><BR><BR>






<B><FONT SIZE=3>TELEFON-TABELLE</FONT></B><BR><BR>
<A NAME="phones-extension">
<BR>
<B>Telefonverlängerung -</B> Dieses fangen ist auf, wohin Sieden Telefonnamen setzen, während er scheint, nicht einschließlichdas Protokoll oder den Schrägstrich am Anfang mit einem Sternchenzuversehen. Z.B.: für das SIP Telefon SIP\/test101 würde dieTelefonverlängerung test101 sein. Auch denn Telefone IAX2 stellen Siesicher, daß Sie den vollen Telefonnamen verwenden:IAX2\/IAXphone1@IAXphone1 würde IAXphone1@IAXphone1 sein. Für ZapTelefone sicherstellen, daß Sie die volle Führung setzen: Zap/25-1würde 25-1 sein. Eine andere Anmerkung, stellen sicher, daß Sie dasProtokoll unten richtig für Ihre Art des Telefons einstellen.

<BR>
<A NAME="phones-dialplan_number">
<BR>
<B>Dialplan number -</B> This field is for the number you dial to have the phone ring. This number is defined in the extensions.conf file of your Asterisk server

<BR>
<A NAME="phones-voicemail_id">
<BR>
<B>Voicemail Kasten -</B> Dieses fangen ist für den voicemailKasten auf, daß die Anzeigen für zum Benutzer dieses Telefons gehen.Wir verwenden dieses, um auf voicemail Anzeigen und auf den Benutzerzu überprüfen, zum in der Lage zuSEIN, die VOICEMAIL Taste aufastGUIclient APP zu benutzen.

<BR>
<A NAME="phones-outbound_cid">
<BR>
<B>Outbound CallerID -</B> Dieses fangen ist auf, wo Sie diecallerID Zahl eintragen würden, die Sie möchten, daß auf outboundAnrufe gesetzter Form der astguiclient Netz-Klient aussieht. Diesesarbeitet nicht auf RBS, non-PRI, T1/Eß.

<BR>
<A NAME="phones-phone_ip">
<BR>
<B>Telefon-IP address -</B> Dieses fangen ist für IP addressdes Telefons auf, wenn es ein VOIP Telefon ist. Dieses istauffangen ein wahlweise freigestelltes

<BR>
<A NAME="phones-computer_ip">
<BR>
<B>Computer-IP address -</B> Dieses fangen ist für IP addressComputer des Benutzers auf. Dieses ist auffangen einwahlweise freigestelltes

<BR>
<A NAME="phones-server_ip">
<BR>
<B>Bediener IP -</B> Dieses Menü ist, wo Sie vorwählen, dem Bedienerdas Telefon auf aktiv ist.

<BR>
<A NAME="phones-login">
<BR>
<B>LOGON -</B> Der LOGON gewöhnt ge$$$WESEN für den Telefonbenutzer anLOGON zu den Klient Anwendungen.

<BR>
<A NAME="phones-pass">
<BR>
<B>Kennwort -</B> Das Kennwort gewöhnt ge$$$WESEN für denTelefonbenutzer an LOGON zu den Klient Anwendungen.

<BR>
<A NAME="phones-status">
<BR>
<B>Status -</B> Der Status des Telefons im System, die AKTIVEN und ADMINdürfen, damit GUI Klienten arbeiten. Admin erlaubt Zugang zu dieseradministrativen Web site. Alle weiteren Status erlauben nicht GUI oderAdmin Netzzugang.

<BR>
<A NAME="phones-active">
<BR>
<B>Aktives Konto -</B> Ob das Telefon aktiv ist, es in die Liste im GUIKlienten einzusetzen.

<BR>
<A NAME="phones-phone_type">
<BR>
<B>Telefon-Art -</B> Lediglich für administrative Anmerkungen.

<BR>
<A NAME="phones-fullname">
<BR>
<B>Voller Name -</B> Verwendet durch das GUIclient in der Liste deraktiven Telefone.

<BR>
<A NAME="phones-company">
<BR>
<B>Firma -</B> Lediglich für administrative Anmerkungen.

<BR>
<A NAME="phones-picture">
<BR>
<B>Abbildung -</B> Nicht schon eingeführt.

<BR>
<A NAME="phones-messages">
<BR>
<B>Neue Anzeigen -</B> Zahl der neuen voicemail Anzeigen für diesesTelefon auf dem Sternchenbediener.

<BR>
<A NAME="phones-old_messages">
<BR>
<B>Alte Anzeigen -</B> Zahl der alten voicemail Anzeigen für diesesTelefon auf dem Sternchenbediener.

<BR>
<A NAME="phones-protocol">
<BR>
<B>Klient Protokoll -</B> Das Protokoll, das das Telefon verwendet, anden Sternchenbediener anzuschließen: Sip, IAX2, Zap. Auch, es gibtexternal für Remotevorwahlknopfzahlen oder GeschwindigkeitVorwahlknopfzahlen, die Sie als Telefone verzeichnen möchten.

<BR>
<A NAME="phones-local_gmt">
<BR>
<B>Lokales GMT -</B> Der Unterschied Greenwich-Zeit von oder VON DERZULU-Zeit, in der das Telefon lokalisiert wird. STELLEN SIE NICHT AUFTAGESLICHT-SPARUNGEN ZEIT EIN. Dieses wird durch die VICIDIAL Kampagneverwendet, um die Zeit und Kunde Zeit genau anzuzeigen.

<BR>
<A NAME="phones-ASTmgrUSERNAME">
<BR>
<B>Manager-LOGON -</B> Dieses ist der LOGON, dem die GUI Klienten fürdieses Telefon pflegen, die Datenbank zugänglich zu machen, in derdie Bedienerdaten liegen.

<BR>
<A NAME="phones-ASTmgrSECRET">
<BR>
<B>Manager-Geheimnis -</B> Dieses ist das Kennwort, dem die GUI Klientenfür dieses Telefon pflegen, die Datenbank zugänglich zu machen, inder die Bedienerdaten liegen.

<BR>
<A NAME="phones-login_user">
<BR>
<B>VICIDIAL Rückstellung Benutzer -</B> Dieses soll einen Default-Wertin den VICIDIAL Benutzer legen auffangen, wann immer dieserTelefonbenutzer die astVICIDIAL Klient APP öffnet. Lassen Sie freienRaum für keinen Benutzer.

<BR>
<A NAME="phones-login_pass">
<BR>
<B>VICIDIAL Rückstellung Durchlauf -</B> Dieses soll einen Default-Wertin das VICIDIAL Kennwort legen auffangen, wann immer dieserTelefonbenutzer die astVICIDIAL Klient APP öffnet. Lassen Sie freienRaum für keinen Durchlauf.

<BR>
<A NAME="phones-login_campaign">
<BR>
<B>VICIDIAL Rückstellung Kampagne -</B> Dieses soll einen Default-Wertin die VICIDIAL Kampagne legen auffangen, wann immer dieserTelefonbenutzer die astVICIDIAL Klient APP öffnet. Lassen Sie freienRaum für keine Kampagne.

<BR>
<A NAME="phones-park_on_extension">
<BR>
<B>Park Exten -</B> Dieses ist die Rückstellung Parkenverlängerung fürdie Klient apps. Überprüfen Sie, daß ein unterschiedliches manarbeitet, bevor Sie dieses ändern.

<BR>
<A NAME="phones-conf_on_extension">
<BR>
<B>Conf Exten -</B> This is the default Conference park extension for the client apps. Verify that a different one works before you change this.

<BR>
<A NAME="phones-VICIDIAL_park_on_extension">
<BR>
<B>VICIDIAL Park Exten -</B> Dieses ist die RückstellungParkenverlängerung für VICIDIAL Klient APP. Überprüfen Sie, daßein unterschiedliches man arbeitet, bevor Sie dieses ändern.

<BR>
<A NAME="phones-VICIDIAL_park_on_filename">
<BR>
<B>VICIDIAL Park-Akte -</B> Dieses ist der Rückstellung VICIDIALPark-Verlängerung Dateiname für die Klient apps. Überprüfen Sie,daß ein unterschiedliches man arbeitet, bevor Sie dieses ändern, daszu 10 Buchstaben begrenzt wird.

<BR>
<A NAME="phones-monitor_prefix">
<BR>
<B>Überwachen Sie Präfix -</B> This is the dialplan prefix for monitoring of Zap channels automatically within the astGUIclient app. Only change according to the extensions.conf ZapBarge extensions records.

<BR>
<A NAME="phones-recording_exten">
<BR>
<B>Aufnahme Exten -</B> Dieses ist die dialplan Verlängerung für dieAufnahmeverlängerung, die verwendet wird, um in meetme Konferenzen zufallen, um sie zu notieren. Es dauert normalerweise bis zu einerStunde, wenn es nicht gestoppt wird, überprüft mit extensions.confAkte, bevor es ändert.

<BR>
<A NAME="phones-voicemail_exten">
<BR>
<B>VMAIL Hauptexten -</B> Dieses ist die dialplan Verlängerung, diegeht, Ihr voicemail. zu überprüfen, überprüfen mit extensions.confAkte, bevor es ändert.

<BR>
<A NAME="phones-voicemail_dump_exten">
<BR>
<B>VMAIL Dump Exten -</B> Dieses ist das dialplan Präfix, das verwendetwird, um Anrufe direkt zum voicemail eines Benutzers von einemPhasenanruf in der astGUIclient APP zu schicken, überprüfen mitextensions.conf Akte, bevor es ändert.

<BR>
<A NAME="phones-ext_context">
<BR>
<B>Exten Kontext -</B> Dieses ist der dialplan Kontext, den diesesTelefon hauptsächlich verwendet. Es wird angenommen, daß alleNummern, die durch die Klient apps gewählt werden, diesen Kontextverwenden, also es eine gute Idee ist sicherzustellen, daß dieses derbreiteste Kontext ist, der möglich ist, überprüfen mitextensions.conf Akte, bevor es ändert.

<BR>
<A NAME="phones-dtmf_send_extension">
<BR>
<B>DTMF senden Führung -</B> Dieses ist die Führung Zeichenkette, diebenutzt wird, um DTMF Töne in meetme Konferenzen von den Klient appszu senden. Überprüfen Sie, daß und Kontext mit der extensions.confAkte exten.

<BR>
<A NAME="phones-call_out_number_group">
<BR>
<B>Outbound Anruf-Gruppe -</B> Dieses ist die Kanalgruppe, daß outboundAnrufe von diesem Telefon aus gesetzt werden. Es gibt Programme einesPaares in den Klient apps, die dieses verwenden. Für Zap Führungen,die Sie etwas wie Zap/g2 verwenden möchten, denn Stämme IAX2 Siedas volle IAX Präfix wie IAX2/VICItest1:secret@10.10.10.15:4569würden verwenden wollen. Überprüfen Sie die Stämme mit derextensions.conf Akte, es ist normalerweise, was Sie als die globaleVariable des STAMMES an der Oberseite der Akte definiert haben.

<BR>
<A NAME="phones-client_browser">
<BR>
<B>Datenbanksuchroutine-Position -</B> Dieses ist auf nur UNIX/LINUXKlienten, der absolute Weg zu Mozilla anwendbar, oder FirefoxDatenbanksuchroutine auf der Maschine überprüfen dieses, indem siemanuell es ausstößt.

<BR>
<A NAME="phones-install_directory">
<BR>
<B>Anbringen Sie Verzeichnis -</B> Dieses ist der Platz, in dem dieastGUIclient und astVICIDIAL Indexe auf Ihrer Maschine sind. FürWin32 sollte es etwas wie C:\\AST_VICI sein und für UNIX sollte esetwas wie /usr/local/perl_TK. sein überprüft dieses manuell.

<BR>
<A NAME="phones-local_web_callerID_URL">
<BR>
<B>CallerID URL -</B> Dieses ist die Netzadresse der Seite, die benutztwird, um kundenspezifische callerID Nachschlagen zu tun, Rückstellungprüfen, dieadresse ist:http://astguiclient.sf.net/test_callerid_output.php

<BR>
<A NAME="phones-VICIDIAL_web_URL">
<BR>
<B>VICIDIAL Rückstellung URL -</B> Dieses ist die Netzadresse der Seite,die benutzt wird, um kundenspezifische VICIDIAL Netz-Formfragen zutun, Rückstellung prüfen, dieadresse ist:http://astguiclient.sf.net/test_VICIDIAL_output.php

<BR>
<A NAME="phones-AGI_call_logging_enabled">
<BR>
<B>Anruf-Protokollierung -</B> Dieses wird eingestellt, um auszurichten,wenn die call_log.agi Akte im Platz in der extensions.conf Akte füralles outbound ist und die Verlängerungen des Hängezustands ' h ',zum alle zu loggen benennt. Diese sollte 1, weil es für vieleastGUIclient und DIE VICIDIAL manditory ist Eigenschaften immer sein,zum richtig zu arbeiten.

<BR>
<A NAME="phones-user_switching_enabled">
<BR>
<B>Benutzer-Schaltung -</B> Set to true to allow user to switch to another user account. NOTE: If user switches they can initiate recording on the new user's phone conversation

<BR>
<A NAME="phones-conferencing_enabled">
<BR>
<B>Conferencing -</B> Stellen Sie ein, um auszurichten, um Benutzer zuerlauben, Konferenzanrufe mit bis zu sechs externen Linien zubeginnen.

<BR>
<A NAME="phones-admin_hangup_enabled">
<BR>
<B>Admin Hängezustand -</B> um Benutzer zu erlauben auszurichten Satz,zum Hängezustand irgendeine Linie am Willen durch astGUIclient in derLage zuSEIN. Gute Idee, diesem für Admin Benutzer nur zuermöglichen.

<BR>
<A NAME="phones-admin_hijack_enabled">
<BR>
<B>Admin Straßenräuber -</B> Stellen Sie ein, um auszurichten, umBenutzer zu erlauben, in der Lage zuSEIN, zu ihrer Verlängerung jedemögliche Linie zu ergreifen und umzuadressieren am Willen durchastGUIclient. Gute Idee, diesem für Admin Benutzer nur zuermöglichen. Aber ist für Manager sehr nützlich.

<BR>
<A NAME="phones-admin_monitor_enabled">
<BR>
<B>Admin Monitor -</B> Stellen Sie ein, um auszurichten, um Benutzer zuerlauben, in der Lage zuSEIN, zu ihrer Verlängerung jede möglicheLinie zu ergreifen und umzuadressieren am Willen durch astGUIclient.Gute Idee, diesem für Admin Benutzer nur zu ermöglichen. Aber istfür Manager und als Training Werkzeug sehr nützlich.

<BR>
<A NAME="phones-call_parking_enabled">
<BR>
<B>Parkschaltung -</B> um Benutzer zu erlauben auszurichten der Satz, inder Lage zuSEIN zu parken ersucht um astGUIclient Einfluß, von jedemanderen astGUIclient Benutzer auf dem System aufgehoben zu werden.Anrufe bleiben auf Einfluß für bis zu einen halbe Stunde dannHängezustand. Normalerweise ermöglicht für alle.

<BR>
<A NAME="phones-updater_check_enabled">
<BR>
<B>Updater Überprüfung -</B> Stellen Sie ein, um auszurichten, um einepopup Warnung anzuzeigen, die die updater Zeit nicht in 20 Sekundengeändert hat. Nützlich für Admin Benutzer.

<BR>
<A NAME="phones-AFLogging_enabled">
<BR>
<B>Af Protokollierung -</B> Stellen Sie ein, um auszurichten, um vieleTätigkeiten des astGUIclient Verbrauches in einer Textakte auf demComputer des Benutzers zu protokollieren.

<BR>
<A NAME="phones-QUEUE_ACTION_enabled">
<BR>
<B>Warteschlange ermöglichte -</B> um Klient apps auszurichten Satz dasSternchen-zentrale Warteschlange System benutzen zu lassen. Erfordertfür VICIDIAL und für alle Benutzer empfohlen.

<BR>
<A NAME="phones-CallerID_popup_enabled">
<BR>
<B>CallerID Popup -</B> Stellen Sie ein, um auszurichten, um die Zahlenzuzulassen, die in der extensions.conf Akte definiert werden, umCallerID popup Schirme zu schicken den astGUIclient Benutzern.

<BR>
<A NAME="phones-voicemail_button_enabled">
<BR>
<B>VMail Taste -</B> Stellen Sie ein, um auszurichten, um die VOICEMAILTaste anzuzeigen und die Anzeigen zählen Anzeige auf astGUIclient.

<BR>
<A NAME="phones-enable_fast_refresh">
<BR>
<B>Schnell erneuern Sie -</B> Stellen Sie ein, um auszurichten, um einerneuen Rate von zu ermöglichen erneuern von den Anrufinformationenfür das astGUIclient. Rückstellung arbeitsunfähige Rate ist 1000zweite des Ms.1. Kann Anlagen-Belastung erhöhen, wenn Sie diese Zahlsenken.

<BR>
<A NAME="phones-fast_refresh_rate">
<BR>
<B>Schnell erneuern Sie Rate -</B> in den Millisekunden. Nur verwendet,wenn schnell, erneuern Sie wird ermöglicht. Rückstellungarbeitsunfähige Rate ist 1000 zweite des Ms.1. Kann Anlagen-Belastungerhöhen, wenn Sie diese Zahl senken.

<BR>
<A NAME="phones-enable_persistant_mysql">
<BR>
<B>Persistant MySQL -</B> Wenn er ermöglicht wird, bleibt derastGUIclient Anschluß angeschlossen, anstatt, jede Sekundeanzuschließen. Nützlich, wenn Sie ein schnelles die eingestellteRate erneuern lassen. Sie erhöht die Zahl Anschlüssen auf IhrerMySQL Maschine.

<BR>
<A NAME="phones-auto_dial_next_number">
<BR>
<B>Selbstvorwahlknopf-folgende Zahl -</B> wenn er ermöglicht wird,wählt der VICIDIAL Klient die folgende Nummer auf der Listeautomatisch nach Einteilung eines Anrufs, es sei denn sie vorwählten"auf, dem Einteilung Schirm zu wählen zu stoppen".

<BR>
<A NAME="phones-VDstop_rec_after_each_call">
<BR>
<B>Stoppen Sie Rec nach jedem Anruf -</B> wenn er ermöglicht wird,stoppt der VICIDIAL Klient, was Aufnahme weitergeht, nachdem jederAnruf dispositioned gewesen ist. Nützlich, wenn Sie eine MengeAufnahme tun oder Sie benutzen eine Netzform, um Aufnahme auszulösen.

<BR>
<A NAME="phones-DBX_server">
<BR>
<B>DBX Bediener -</B> Der MySQL Datenbankbediener, den dieser Benutzeranschließen sollte an.

<BR>
<A NAME="phones-DBX_database">
<BR>
<B>DBX Datenbank -</B> Die MySQL Datenbank, die dieser Benutzeranschließen sollte an. Rückstellung ist Sternchen.

<BR>
<A NAME="phones-DBX_user">
<BR>
<B>DBX Benutzer -</B> Der MySQL Benutzer-LOGON, den dieser Benutzer beimAnschließen verwenden sollte. Rückstellung ist cron.

<BR>
<A NAME="phones-DBX_pass">
<BR>
<B>DBX Durchlauf -</B> Das MySQL Benutzerkennwort, das dieser Benutzerbeim Anschließen verwenden sollte. Rückstellung ist 1234.

<BR>
<A NAME="phones-DBX_port">
<BR>
<B>DBX Tor -</B> Das MySQL TCP Tor, das dieser Benutzer beim Anschließenbenutzen sollte. Rückstellung ist 3306.

<BR>
<A NAME="phones-DBY_server">
<BR>
<B>DBY Bediener -</B> Der MySQL Datenbankbediener, den dieser Benutzeranschließen sollte an. Zweitensserver, nicht z.Z. verwendet.

<BR>
<A NAME="phones-DBY_database">
<BR>
<B>DBY Datenbank -</B> Die MySQL Datenbank, die dieser Benutzeranschließen sollte an. Rückstellung ist Sternchen. Zweitensserver, nicht z.Z. verwendet.

<BR>
<A NAME="phones-DBY_user">
<BR>
<B>DBY Benutzer -</B> Der MySQL Benutzer-LOGON, den dieser Benutzer beimAnschließen verwenden sollte. Rückstellung ist cron. Zweitensserver, nicht z.Z. verwendet.

<BR>
<A NAME="phones-DBY_pass">
<BR>
<B>DBY Durchlauf -</B> Das MySQL Benutzerkennwort, das dieser Benutzerbeim Anschließen verwenden sollte. Rückstellung ist 1234. Zweitensserver, nicht z.Z. verwendet.

<BR>
<A NAME="phones-DBY_port">
<BR>
<B>DBY Tor -</B> Das MySQL TCP Tor, das dieser Benutzer beim Anschließenbenutzen sollte. Rückstellung ist 3306. Zweitensserver, nicht z.Z. verwendet.


<BR><BR><BR><BR>

<B><FONT SIZE=3>BEDIENER-TABELLE</FONT></B><BR><BR>
<A NAME="servers-server_id">
<BR>
<B>Bediener Identifikation -</B> Dieses fangen ist, wohin Sieden Sternchenbedienernamen setzen, doesnt müssen ein amtliches GebietUnterseeboot, gerade ein Spitzname sein auf, um den Bediener zu denAdmin Benutzern zu kennzeichnen.

<BR>
<A NAME="servers-server_description">
<BR>
<B>Bediener-Beschreibung -</B> auffangen, wo Sie eine kleine Phraseverwenden, um den Sternchenbediener zu beschreiben.

<BR>
<A NAME="servers-server_ip">
<BR>
<B>Bediener-IP address -</B> auffangen, wo Sie das Netz-IP addressdes Sternchenbedieners setzten.

<BR>
<A NAME="servers-active">
<BR>
<B>Aktiv -</B> Stellen Sie ein, ob der Sternchenbediener aktiv oderunaktiviert ist.

<BR>
<A NAME="servers-asterisk_version">
<BR>
<B>Sternchen-Version -</B> Stellen Sie die Version des Sternchens ein,die Sie auf diesen Bediener angebracht haben. Beispiele: ' 1.2 ', '1.0.8 ', ' 1.0.7 ', ' CVS_HEAD ', ' WIRKLICH ALTES ', usw.... Dieseswird verwendet, weil Versionen 1.0.8 und 1.0.9 eine andere Methode desBeschäftigens Local/ Führungen, eine Wanze, die in CVS v1.0geregelt worden ist, und Notwendigkeit, anders als behandelt zu werdenhaben, wenn die Behandlung ihres Local/ lenkt. Auch gegenwärtigesCVS_HEAD und der 1.2 Freigabebaumgebrauch unterschiedlicher Managerund Befehl gaben aus, also muß es anders als außerdem behandeltwerden.

<BR>
<A NAME="servers-max_vicidial_trunks">
<BR>
<B>Maximale VICIDIAL Stämme -</B> Dieses fangen feststellt diemaximale Zeilenzahl auf, um denen der VICIDIAL Auto-dialer versucht,diesen Bediener zu ersuchen. Wenn Sie zwei volle PRI Tß VICIDIALingauf einem Bediener einweihen möchten dann, würden Sie dieses bis 46einstellen. Rückstellung ist 96.

<BR>
<A NAME="servers-telnet_host">
<BR>
<B>Telnet Wirt -</B> Dieses ist die Adresse oder der Name desSternchenbedieners und ist, wie die Manageranwendungen an ihnanschließen von, wo sie laufen. Wenn sie auf den Sternchenbedienerlaufen, dann ist die Rückstellung von ' localhost ' fein.

<BR>
<A NAME="servers-telnet_port">
<BR>
<B>Telnet Tor -</B> Dieses ist das Tor des SternchenbedienerManageranschlußes und ist, wie die Manageranwendungen an ihnanschließen von, wo sie laufen. Die Rückstellung von ' 5038 ' istfein für einen Standard anbringen.

<BR>
<A NAME="servers-ASTmgrUSERNAME">
<BR>
<B>Manager-Benutzer -</B> Das username oder der LOGON verwendeten, an denSternchenbedienermanager genericly anzuschließen. Rückstellung ist 'cron '

<BR>
<A NAME="servers-ASTmgrSECRET">
<BR>
<B>Manager-Geheimnis -</B> Das Geheimnis oder das Kennwort verwendeten,an den Sternchenbedienermanager genericly anzuschließen.Rückstellung ist ' 1234 '

<BR>
<A NAME="servers-ASTmgrUSERNAMEupdate">
<BR>
<B>Manager-Update-Benutzer -</B> Das username oder der LOGON verwendeten,an den Sternchenbedienermanager anzuschließen, der für dieUpdateindexe optimiert wurde. Fallen Sie ist ' updatecron ' undannimmt das gleiche Geheimnis wie der generische Benutzer zurück.

<BR>
<A NAME="servers-ASTmgrUSERNAMElisten">
<BR>
<B>Manager hören Benutzer -</B> Das username oder der LOGON verwendeten,an den Sternchenbedienermanager anzuschließen, der für Indexeoptimiert wurde, die nur auf Ausgang hören. Fallen Sie ist 'listencron ' und annimmt das gleiche Geheimnis wie der generischeBenutzer zurück.

<BR>
<A NAME="servers-ASTmgrUSERNAMEsend">
<BR>
<B>Manager senden Benutzer -</B> Das username oder der LOGON verwendeten,an den Sternchenbedienermanager anzuschließen, der für Indexeoptimiert wurde, die dem Manager nur Tätigkeiten schicken. Fallen Sieist ' sendcron ' und annimmt das gleiche Geheimnis wie der generischeBenutzer zurück.

<BR>
<A NAME="servers-local_gmt">
<BR>
<B>Bediener GMT versetzt -</B> Der Unterschied bezüglich der Stunden vonder GMT Zeit eingestellt nicht auf Tageslicht-Sparung-Zeit desBedieners. Rückstellung ist ' - 5 '

<BR>
<A NAME="servers-voicemail_dump_exten">
<BR>
<B>VMail Dump Exten -</B> Das Verlängerung Präfix verwendet auf diesemBediener, um Anrufe direkt durch agc zu einem spezifischen voicemailKasten zu schicken. Rückstellung ist ' 85026666666666 '

<BR>
<A NAME="servers-answer_transfer_agent">
<BR>
<B>VICIDIAL ANZEIGE Verlängerung -</B> Die Rückstellung Verlängerung,wenn keines in der Kampagne anwesend ist, Anrufe für VICIDIAL zumSelbstwählen zu schicken. Rückstellung ist ' 8365 '

<BR>
<A NAME="servers-ext_context">
<BR>
<B>Rückstellung Kontext -</B> Der Rückstellung dialplan Kontextverwendet für Indexe, die für diesen Bediener funktionieren.Rückstellung ist ' Rückstellung '

<BR>
<A NAME="servers-sys_perf_log">
<BR>
<B>System Leistung -</B> die Einstellung dieser Wahl auf Y ermöglicht derProtokollierung von System Leistung Notfall für die Bedienermaschineeinschließlich Anlagen-Belastung, System Prozesse undSternchenführungen im Gebrauch. Rückstellung ist N.

<BR>
<A NAME="servers-vd_server_logs">
<BR>
<B>Bediener-Maschinenbordbücher -</B> die Einstellung dieser Wahl auf Yermöglicht der Protokollierung aller VICIDIAL bezogenen Indexe zuihren Textmaschinenbordbuchakten. Die Einstellung dieses auf N stopptSchreiben Maschinenbordbücher zu den Akten für diese Prozesse, auchdie Schirmprotokollierung des Sternchens ist untauglich, wenn diesesauf N eingestellt wird, wenn Sternchen begonnen wird. Rückstellungist Y.

<BR>
<A NAME="servers-agi_output">
<BR>
<B>AGI ausgegeben -</B> die Einstellung dieser Wahl auf KEINE sperrt Ausgangvon allen VICIDIAL bezogenen AGI Indexen. Die Einstellung dieses aufSTDERR schickt das AGI, das zum Sternchen CLI ausgegeben wird. DieEinstellung dieses auf AKTE schickt den Ausgang zu einer Akte imMaschinenbordbuchverzeichnis. Die Einstellung dieses auf BEIDE schicktAusgang zum Sternchen CLI und zu einer Maschinenbordbuchakte.Rückstellung ist AKTE.

<BR>
<A NAME="servers-vicidial_balance_active">
<BR>
<B>VICIDIAL Balance Wählen -</B> dieses einstellend, fangen Sie zuY läßt den Bediener Balance Anrufe für Kampagnen in VICIDIAL legenauf, damit das definierte Vorwahlknopfniveau getroffen werden kann,selbst wenn es keine Mittel gibt, die in diese Kampagne auf diesemBediener geloggt werden. Rückstellung ist N.

<BR>
<A NAME="servers-balance_trunks_offlimits">
<BR>
<B>VICIDIAL Balance Offlimits -</B> diese Einstellung definiert die ZahlStämmen, um die VICIDIAL Balance nicht zu erlauben, die wählt, um zuverwenden. Z.B. wenn Sie haben, wird 40 maximale vicidial Stämme undBalance offlimits bis 10 eingestellt, die Sie nur in der LageSIND, 30Hauptluftlinien für VICIDIAL Balance das Wählen zu benutzen.Rückstellung ist 0.


<BR><BR><BR><BR>

<B><FONT SIZE=3>KONFERENZTISCH</FONT></B><BR><BR>
<A NAME="conferences-conf_exten">
<BR>
<B>Konferenz-Zahl -</B> Dieses fangen ist auf, wohin Sie diemeetme Konferenz dialpna Zahl setzen. Es wird auch empfohlen, daß diemeetme Zahl in meetme.conf diese Zahl für jede Eintragungzusammenbringt. Dieses ist für die Konferenzen in astGUIclient undwird für leave-3way-call Funktionalität in VICIDIAL verwendet.

<BR>
<A NAME="conferences-server_ip">
<BR>
<B>Bediener IP -</B> Das Menü, wo Sie den Sternchenbediener vorwählen,daß diese Konferenz eingeschaltet ist.




<BR><BR><BR><BR>

<B><FONT SIZE=3>VICIDIAL_SERVER_TRUNKSTABELLE</FONT></B><BR><BR>
<A NAME="vicidial_server_trunks">
<BR>
<B>VICIDIAL Bediener-Stämme erlaubt Ihnen, die gehenden Leitungeneinzuschränken, die auf diesem Bediener für die Kampagne benutztwerden, die auf einer Prokampagne Grundlage wählt. Sie haben dieWahl, zum einer spezifischen Zeilenzahl durch nur eine Kampagneverwendet zu werden aufzuheben,, sowie das Lassen dieser Kampagneüber seine reservierten Linien laufen in was Linien geöffnetbleiben, wie, lang an den Gruppenzeilen, die durch vicidial auf diesemBediener benutzt werden, sind kleiner als die Maximum VICIDIALStammeinstellung. Erlaubt Haben nicht irgendwelche dieserAufzeichnungen die Kampagne, die die Linie zuerst wählt, um da vieleLinien zu haben, während sie unter der Maximum VICIDIAL erhalten kannStammeinstellung.</B>


<BR><BR><BR><BR><BR><BR><BR><BR>
<BR><BR><BR><BR><BR><BR><BR><BR>
DAS ENDE
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
echo "</title>\n";
echo "</head>\n";
echo "<BODY BGCOLOR=white marginheight=0 marginwidth=0 leftmargin=0 topmargin=0>\n";
echo "<FONT FACE=\"ARIAL,HELVETICA\" COLOR=BLACK SIZE=2>";

$stmt="SELECT * from vicidial_campaigns where campaign_id='$campaign_id';";
$rslt=mysql_query($stmt, $link);
$row=mysql_fetch_row($rslt);
$dial_status_a = $row[3];
$dial_status_b = $row[4];
$dial_status_c = $row[5];
$dial_status_d = $row[6];
$dial_status_e = $row[7];
$local_call_time = $row[16];
if ($lead_filter_id=='')
	{
	$lead_filter_id = $row[35];
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
echo "<B>Zeige Anzahl anrufbarer Anschlüsse</B> -<BR><BR>\n";
echo "<B>CAMPAIGN:</B> $campaign_id<BR>\n";
echo "<B>LISTEN:</B> $camp_lists<BR>\n";
echo "<B>STATUSES:</B> $dial_status_a,$dial_status_b,$dial_status_c,$dial_status_d,$dial_status_e<BR>\n";
echo "<B>FILTER:</B> $lead_filter_id<BR>\n";
echo "<B>CALL TIME:</B> $local_call_time<BR><BR>\n";

### call function to calculate and print dialable leads
dialable_leads($DB,$link,$local_call_time,$dial_status_a,$dial_status_b,$dial_status_c,$dial_status_d,$dial_status_e,$camp_lists,$fSQL);

echo "<BR><BR>\n";
echo "</BODY></HTML>\n";

exit;
}


######################
# ADD=7111111 view sample script with test variables
######################

if ($ADD==7111111)
{
	##### TEST VARIABLES #####
	$vendor_lead_code = 'VENDORLEADCODE';
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

echo "Vorbetrachtung-Index: $script_id<BR>\n";
echo "<TABLE WIDTH=400><TR><TD>\n";
echo "<center><B>$script_name</B><BR></center>\n";
echo "$script_text\n";
echo "</TD></TR></TABLE></center>\n";

echo "</BODY></HTML>\n";

exit;
}




######################### HTML HEADER BEGIN #######################################
if ($hh=='users') {$users_hh='bgcolor ="#FFFF99"'; $users_fc='BLACK';}	# yellow
	else {$users_hh=''; $users_fc='WHITE';}
if ($hh=='campaigns') {$campaigns_hh='bgcolor ="#FFCC99"'; $campaigns_fc='BLACK';}	# orange
	else {$campaigns_hh=''; $campaigns_fc='WHITE';}
if ($hh=='lists') {$lists_hh='bgcolor ="#FFCCCC"'; $lists_fc='BLACK';}	# red
	else {$lists_hh=''; $lists_fc='WHITE';}
if ($hh=='ingroups') {$ingroups_hh='bgcolor ="#CC99FF"'; $ingroups_fc='BLACK';} # purple
	else {$ingroups_hh=''; $ingroups_fc='WHITE';}
if ($hh=='remoteagent') {$remoteagent_hh='bgcolor ="#CCFFCC"'; $remoteagent_fc='BLACK';}	# green
	else {$remoteagent_hh=''; $remoteagent_fc='WHITE';}
if ($hh=='usergroups') {$usergroups_hh='bgcolor ="#CCFFFF"'; $usergroups_fc='BLACK';}	# cyan
	else {$usergroups_hh=''; $usergroups_fc='WHITE';}
if ($hh=='scripts') {$scripts_hh='bgcolor ="#99FFCC"'; $scripts_fc='BLACK';}	# light teal
	else {$scripts_hh=''; $scripts_fc='WHITE';}
if ($hh=='filters') {$filters_hh='bgcolor ="#CCCCCC"'; $filters_fc='BLACK';} # grey
	else {$filters_hh=''; $filters_fc='WHITE';}
if ($hh=='times') {$times_hh='bgcolor ="#99FF33"'; $times_fc='BLACK';} # hard teal
	else {$times_hh=''; $times_fc='WHITE';}
if ($hh=='server') {$server_hh='bgcolor ="#FF99FF"'; $server_fc='BLACK';} # pink
	else {$server_hh=''; $server_fc='WHITE';}

?>
</title>
<script language="Javascript">
function openNewWindow(url) {
  window.open (url,"",'width=500,height=300,scrollbars=yes,menubar=yes,address=yes');
}
</script>
</head>
<BODY BGCOLOR=white marginheight=0 marginwidth=0 leftmargin=0 topmargin=0>
<?
echo "<!-- ILPV -->\n";
echo "<TD WIDTH=100 ALIGN=RIGHT VALIGN=TOP  NOWRAP><a href=\"../vicidial_en/admin.php?relogin=YES&VD_login=$VD_login&VD_campaign=$VD_campaign&phone_login=$phone_login&phone_pass=$phone_pass&VD_pass=$VD_pass\">English <img src=\"../agc/images/en.gif\" BORDER=0 HEIGHT=14 WIDTH=20></a></TD>\n";echo "<TD WIDTH=100 ALIGN=RIGHT VALIGN=TOP  BGCOLOR=\"#CCFFCC\" NOWRAP><a href=\"../vicidial_de/admin.php?relogin=YES&VD_login=$VD_login&VD_campaign=$VD_campaign&phone_login=$phone_login&phone_pass=$phone_pass&VD_pass=$VD_pass\">Deutsch <img src=\"../agc/images/de.gif\" BORDER=0 HEIGHT=14 WIDTH=20></a></TD>\n";?>
<CENTER>
<TABLE WIDTH=650 BGCOLOR=#D9E6FE cellpadding=2 cellspacing=0><TR BGCOLOR=#015B91><TD ALIGN=LEFT COLSPAN=5><FONT FACE="ARIAL,HELVETICA" COLOR=WHITE SIZE=2><B> &nbsp; VICIDIAL ADMIN - <a href="<? echo $PHP_SELF ?>?force_logout=1"><FONT FACE="ARIAL,HELVETICA" COLOR=WHITE SIZE=1>Logout</a></TD><TD ALIGN=RIGHT COLSPAN=6><FONT FACE="ARIAL,HELVETICA" COLOR=WHITE SIZE=2><B><? echo date("l F j, Y G:i:s A") ?> &nbsp; </TD></TR>

<TR BGCOLOR=#000000>
<TD ALIGN=CENTER <?=$users_hh?>><a href="<? echo $PHP_SELF ?>?ADD=0"><FONT FACE="ARIAL,HELVETICA" COLOR=<?=$users_fc?> SIZE=1><B> BENUTZER </a></TD>
<TD ALIGN=CENTER <?=$campaigns_hh?>><a href="<? echo $PHP_SELF ?>?ADD=10"><FONT FACE="ARIAL,HELVETICA" COLOR=<?=$campaigns_fc?> SIZE=1><B> KAMPAGNEN </a></TD>
<TD ALIGN=CENTER <?=$lists_hh?>><a href="<? echo $PHP_SELF ?>?ADD=100"><FONT FACE="ARIAL,HELVETICA" COLOR=<?=$lists_fc?> SIZE=1><B> LISTEN </a></TD>
<TD ALIGN=CENTER <?=$scripts_hh?>><a href="<? echo $PHP_SELF ?>?ADD=1000000"><FONT FACE="ARIAL,HELVETICA" COLOR=<?=$scripts_fc?> SIZE=1><B> INDEXE </a></TD>
<TD ALIGN=CENTER <?=$filters_hh?>><a href="<? echo $PHP_SELF ?>?ADD=10000000"><FONT FACE="ARIAL,HELVETICA" COLOR=<?=$filters_fc?> SIZE=1><B> FILTER </a></TD>
<TD ALIGN=CENTER <?=$ingroups_hh?>><a href="<? echo $PHP_SELF ?>?ADD=1000"><FONT FACE="ARIAL,HELVETICA" COLOR=<?=$ingroups_fc?> SIZE=1><B> IN-GROUPS </a></TD>
<TD ALIGN=CENTER <?=$times_hh?>><a href="<? echo $PHP_SELF ?>?ADD=100000000"><FONT FACE="ARIAL,HELVETICA" COLOR=<?=$times_fc?> SIZE=1><B> Anrufzeiten </a></TD>
<TD ALIGN=CENTER <?=$usergroups_hh?>><a href="<? echo $PHP_SELF ?>?ADD=100000"><FONT FACE="ARIAL,HELVETICA" COLOR=<?=$usergroups_fc?> SIZE=1><B> BENUTZER-GRUPPEN </a></TD>
<TD ALIGN=CENTER <?=$remoteagent_hh?>><a href="<? echo $PHP_SELF ?>?ADD=10000"><FONT FACE="ARIAL,HELVETICA" COLOR=<?=$remoteagent_fc?> SIZE=1><B> REMOTEMITTEL </a></TD>
<TD ALIGN=CENTER <?=$server_hh?>><a href="<? echo $PHP_SELF ?>?ADD=10000000000"><FONT FACE="ARIAL,HELVETICA" COLOR=<?=$server_fc?> SIZE=1><B> PHONES </a></TD>
<TD ALIGN=CENTER <?=$reports_hh?>><a href="server_stats.php"><FONT FACE="ARIAL,HELVETICA" COLOR=WHITE SIZE=1><B> REPORTS </a></TD>
</TR>


<? if (strlen($users_hh) > 1) { 
	?>
<TR BGCOLOR=#FFFF99><TD ALIGN=CENTER COLSPAN=11><FONT FACE="ARIAL,HELVETICA" COLOR=BLACK SIZE=1><B> &nbsp; <a href="<? echo $PHP_SELF ?>"><FONT FACE="ARIAL,HELVETICA" COLOR=BLACK SIZE=1>LISTE BENUTZER</a> &nbsp; &nbsp; | &nbsp; &nbsp; <a href="<? echo $PHP_SELF ?>?ADD=1"><FONT FACE="ARIAL,HELVETICA" COLOR=BLACK SIZE=1>ADDIEREN Sie Einen NEUEN BENUTZER</a> &nbsp; &nbsp; | &nbsp; &nbsp; <a href="<? echo $PHP_SELF ?>?ADD=55"><FONT FACE="ARIAL,HELVETICA" COLOR=BLACK SIZE=1>SUCHE NACH Einem BENUTZER</a></TD></TR>
<? } 
if (strlen($campaigns_hh) > 1) { 
	?>
<TR BGCOLOR=#FFCC99><TD ALIGN=CENTER COLSPAN=11><FONT FACE="ARIAL,HELVETICA" COLOR=BLACK SIZE=1><B> &nbsp; <a href="<? echo $PHP_SELF ?>?ADD=11"><FONT FACE="ARIAL,HELVETICA" COLOR=BLACK SIZE=1>ADDIEREN SIE KAMPAGNE</a> &nbsp; &nbsp; | &nbsp; &nbsp; <a href="<? echo $PHP_SELF ?>?ADD=10"><FONT FACE="ARIAL,HELVETICA" COLOR=BLACK SIZE=1>LISTE KAMPAGNEN</a> &nbsp; &nbsp; | &nbsp; &nbsp; <a href="./AST_timeonVDADallSUMMARY.php"><FONT FACE="ARIAL,HELVETICA" COLOR=BLACK SIZE=1>REALTIME KAMPAGNEN SUMMARY</a></TD></TR>
<? } 
if (strlen($lists_hh) > 1) { 
	?>
<TR BGCOLOR=#FFCCCC><TD ALIGN=CENTER COLSPAN=11><FONT FACE="ARIAL,HELVETICA" COLOR=BLACK SIZE=1><B> &nbsp; <a href="<? echo $PHP_SELF ?>?ADD=100"><FONT FACE="ARIAL,HELVETICA" COLOR=BLACK SIZE=1>ZEIGEN SIE LISTEN</a> &nbsp; &nbsp; | &nbsp; &nbsp; <a href="<? echo $PHP_SELF ?>?ADD=111"><FONT FACE="ARIAL,HELVETICA" COLOR=BLACK SIZE=1>ADDIEREN SIE NEUE LISTE</a> &nbsp; &nbsp; | &nbsp; &nbsp; <a href="admin_search_lead.php"><FONT FACE="ARIAL,HELVETICA" COLOR=BLACK SIZE=1>SUCHE NACH Einer LEITUNG</a> | &nbsp; &nbsp; <a href="<? echo $PHP_SELF ?>?ADD=121"><FONT FACE="ARIAL,HELVETICA" COLOR=BLACK SIZE=1>FÜGEN SIE ZAHL DNC HINZU</a> &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; | &nbsp; &nbsp; <a href="./listloaderMAIN.php"><FONT FACE="ARIAL,HELVETICA" COLOR=BLACK SIZE=1>LAST NEUE LEITUNGEN</a></TD></TR>
<? } 
if (strlen($scripts_hh) > 1) { 
	?>
<TR BGCOLOR=#99FFCC><TD ALIGN=CENTER COLSPAN=11><FONT FACE="ARIAL,HELVETICA" COLOR=BLACK SIZE=1><B> &nbsp; <a href="<? echo $PHP_SELF ?>?ADD=1111111"><FONT FACE="ARIAL,HELVETICA" COLOR=BLACK SIZE=1>ADDIEREN SIE INDEX</a> &nbsp; &nbsp; | &nbsp; &nbsp; <a href="<? echo $PHP_SELF ?>?ADD=1000000"><FONT FACE="ARIAL,HELVETICA" COLOR=BLACK SIZE=1>ANSICHT-INDEXE</a></TD></TR>
<? } 
if (strlen($filters_hh) > 1) { 
	?>
<TR BGCOLOR=#CCCCCC><TD ALIGN=CENTER COLSPAN=11><FONT FACE="ARIAL,HELVETICA" COLOR=BLACK SIZE=1><B> &nbsp; <a href="<? echo $PHP_SELF ?>?ADD=11111111"><FONT FACE="ARIAL,HELVETICA" COLOR=BLACK SIZE=1>ADDIEREN SIE FILTER</a> &nbsp; &nbsp; | &nbsp; &nbsp; <a href="<? echo $PHP_SELF ?>?ADD=10000000"><FONT FACE="ARIAL,HELVETICA" COLOR=BLACK SIZE=1>ANSICHT-FILTER</a></TD></TR>
<? } 
if (strlen($ingroups_hh) > 1) { 
	?>
<TR BGCOLOR=#CC99FF><TD ALIGN=CENTER COLSPAN=11><FONT FACE="ARIAL,HELVETICA" COLOR=BLACK SIZE=1><B> &nbsp; <a href="<? echo $PHP_SELF ?>?ADD=1000"><FONT FACE="ARIAL,HELVETICA" COLOR=BLACK SIZE=1>ZEIGEN SIE IN-GROUPS</a> &nbsp; &nbsp; | &nbsp; &nbsp; <a href="<? echo $PHP_SELF ?>?ADD=1111"><FONT FACE="ARIAL,HELVETICA" COLOR=BLACK SIZE=1>ADDIEREN SIE NEUES IN-GROUP</a></TD></TR>
<? } 
if (strlen($times_hh) > 1) { 
	?>
<TR BGCOLOR=#99FF33><TD ALIGN=CENTER COLSPAN=11><FONT FACE="ARIAL,HELVETICA" COLOR=BLACK SIZE=1><B> &nbsp; <a href="<? echo $PHP_SELF ?>?ADD=100000000"><FONT FACE="ARIAL,HELVETICA" COLOR=BLACK SIZE=1>Zeige Anrufzeiten</a> &nbsp; &nbsp; | &nbsp; &nbsp; <a href="<? echo $PHP_SELF ?>?ADD=111111111"><FONT FACE="ARIAL,HELVETICA" COLOR=BLACK SIZE=1>Hinzufügen neuer Anrufzeiten</a> &nbsp; &nbsp; | &nbsp; &nbsp; <a href="<? echo $PHP_SELF ?>?ADD=1000000000"><FONT FACE="ARIAL,HELVETICA" COLOR=BLACK SIZE=1>Zeige landesspezifische Anrufzeiten</a> &nbsp; &nbsp; |  &nbsp; &nbsp; <a href="<? echo $PHP_SELF ?>?ADD=1111111111"><FONT FACE="ARIAL,HELVETICA" COLOR=BLACK SIZE=1>Hinzufügen neuer landesspezifischer Anrufzeiten</a> &nbsp; </TD></TR>
<? } 
if (strlen($usergroups_hh) > 1) { 
	?>
<TR BGCOLOR=#CCFFFF><TD ALIGN=CENTER COLSPAN=11><FONT FACE="ARIAL,HELVETICA" COLOR=BLACK SIZE=1><B> &nbsp; <a href="<? echo $PHP_SELF ?>?ADD=111111"><FONT FACE="ARIAL,HELVETICA" COLOR=BLACK SIZE=1>ADDIEREN SIE BENUTZER-GRUPPE</a> &nbsp; &nbsp; | &nbsp; &nbsp; <a href="<? echo $PHP_SELF ?>?ADD=100000"><FONT FACE="ARIAL,HELVETICA" COLOR=BLACK SIZE=1>LISTE BENUTZER-GRUPPEN</a> &nbsp; &nbsp; | &nbsp; &nbsp; <a href="group_hourly_stats.php"><FONT FACE="ARIAL,HELVETICA" COLOR=BLACK SIZE=1>GRUPPE STÜNDLICH</a></TD></TR>
<? } 
if (strlen($remoteagent_hh) > 1) { 
	?>
<TR BGCOLOR=#CCFFCC><TD ALIGN=CENTER COLSPAN=11><FONT FACE="ARIAL,HELVETICA" COLOR=BLACK SIZE=1><B> &nbsp; <a href="<? echo $PHP_SELF ?>?ADD=10000"><FONT FACE="ARIAL,HELVETICA" COLOR=BLACK SIZE=1>ZEIGEN SIE REMOTEMITTEL</a> &nbsp; &nbsp; | &nbsp; &nbsp; <a href="<? echo $PHP_SELF ?>?ADD=11111"><FONT FACE="ARIAL,HELVETICA" COLOR=BLACK SIZE=1>ADDIEREN SIE NEUE REMOTEMITTEL</a></TD></TR>
<? } 
if (strlen($server_hh) > 1) { 
	?>
<TR BGCOLOR=#FF99FF><TD ALIGN=CENTER COLSPAN=11><FONT FACE="ARIAL,HELVETICA" COLOR=BLACK SIZE=1><B> &nbsp; <a href="<? echo $PHP_SELF ?>?ADD=10000000000"><FONT FACE="ARIAL,HELVETICA" COLOR=BLACK SIZE=1>PHONES</a> &nbsp; | &nbsp; <a href="<? echo $PHP_SELF ?>?ADD=11111111111"><FONT FACE="ARIAL,HELVETICA" COLOR=BLACK SIZE=1>ADD PHONE</a> &nbsp; | &nbsp; <a href="<? echo $PHP_SELF ?>?ADD=100000000000"><FONT FACE="ARIAL,HELVETICA" COLOR=BLACK SIZE=1>SERVERS</a> &nbsp; | &nbsp; <a href="<? echo $PHP_SELF ?>?ADD=111111111111"><FONT FACE="ARIAL,HELVETICA" COLOR=BLACK SIZE=1>ADD SERVER</a> &nbsp; | &nbsp; <a href="<? echo $PHP_SELF ?>?ADD=1000000000000"><FONT FACE="ARIAL,HELVETICA" COLOR=BLACK SIZE=1>CONFERENCES</a> &nbsp; | &nbsp; <a href="<? echo $PHP_SELF ?>?ADD=1111111111111"><FONT FACE="ARIAL,HELVETICA" COLOR=BLACK SIZE=1>ADD CONFERENCE</a> &nbsp; | &nbsp; <a href="<? echo $PHP_SELF ?>?ADD=10000000000000"><FONT FACE="ARIAL,HELVETICA" COLOR=BLACK SIZE=1>VD CONFERENCES</a> &nbsp; | &nbsp; <a href="<? echo $PHP_SELF ?>?ADD=11111111111111"><FONT FACE="ARIAL,HELVETICA" COLOR=BLACK SIZE=1>ADD VD CONFERENCE</a></TD></TR>
<? 
	
### Do nothing if admin has no permissions
if($LOGast_admin_access < 1) 
	{
	$ADD='99999999999999999999';
	echo "</TABLE></center>\n";
	echo "Sie haben nicht die Rechte, um diese Seite anzusehen. Bitte zurück gehen.\n";
	}

} 
if (strlen($reports_hh) > 1) { 
	?>
<TR BGCOLOR=#FFCC99><TD ALIGN=CENTER COLSPAN=11><FONT FACE="ARIAL,HELVETICA" COLOR=BLACK SIZE=1><B> &nbsp; </TD></TR>
<? } ?>


<TR><TD ALIGN=LEFT COLSPAN=11 HEIGHT=2 BGCOLOR=BLACK></TD></TR>
<TR><TD ALIGN=LEFT COLSPAN=11>
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
echo "<TABLE><TR><TD>\n";
echo "<FONT FACE=\"ARIAL,HELVETICA\" COLOR=BLACK SIZE=2>";

echo "<br>ADDIEREN Sie Einen NEUEN BENUTZER<form action=$PHP_SELF method=POST>\n";
echo "<input type=hidden name=ADD value=2>\n";
echo "<center><TABLE width=600 cellspacing=3>\n";
echo "<tr bgcolor=#B6D3FC><td align=right>Benutzer-Zahl: </td><td align=left><input type=text name=user size=20 maxlength=10>$NWB#vicidial_users-user$NWE</td></tr>\n";
echo "<tr bgcolor=#B6D3FC><td align=right>Kennwort:</td><td align=left><input type=text name=pass size=20 maxlength=10>$NWB#vicidial_users-pass$NWE</td></tr>\n";
echo "<tr bgcolor=#B6D3FC><td align=right>Voller Name: </td><td align=left><input type=text name=full_name size=20 maxlength=100>$NWB#vicidial_users-full_name$NWE</td></tr>\n";
echo "<tr bgcolor=#B6D3FC><td align=right>Benutzer-Niveau: </td><td align=left><select size=1 name=user_level>";
$h=1;
while ($h<=$LOGuser_level)
	{
	echo "<option>$h</option>";
	$h++;
	}
echo "</select>$NWB#vicidial_users-user_level$NWE</td></tr>\n";
echo "<tr bgcolor=#B6D3FC><td align=right>Benutzer-Gruppe: </td><td align=left><select size=1 name=user_group>\n";

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
echo "<tr bgcolor=#B6D3FC><td align=right>Telefon-LOGON: </td><td align=left><input type=text name=phone_login size=20 maxlength=20>$NWB#vicidial_users-phone_login$NWE</td></tr>\n";
echo "<tr bgcolor=#B6D3FC><td align=right>Telefon-Durchlauf: </td><td align=left><input type=text name=phone_pass size=20 maxlength=20>$NWB#vicidial_users-phone_pass$NWE</td></tr>\n";
echo "</select>$NWB#vicidial_users-user_group$NWE</td></tr>\n";
echo "<tr bgcolor=#B6D3FC><td align=center colspan=2><input type=submit name=SUBMIT value=SUBMIT></td></tr>\n";
echo "</TABLE></center>\n";

}


######################
# ADD=11 display the ADD NEW CAMPAIGN FORM SCREEN
######################

if ($ADD==11)
{
echo "<TABLE><TR><TD>\n";
echo "<FONT FACE=\"ARIAL,HELVETICA\" COLOR=BLACK SIZE=2>";

echo "<br>ADDIEREN Sie Eine NEUE KAMPAGNE<form action=$PHP_SELF method=POST>\n";
echo "<input type=hidden name=ADD value=21>\n";
echo "<center><TABLE width=600 cellspacing=3>\n";
echo "<tr bgcolor=#B6D3FC><td align=right>Kampagne Identifikation: </td><td align=left><input type=text name=campaign_id size=10 maxlength=8>$NWB#vicidial_campaigns-campaign_id$NWE</td></tr>\n";
echo "<tr bgcolor=#B6D3FC><td align=right>Kampagne Name: </td><td align=left><input type=text name=campaign_name size=30 maxlength=30>$NWB#vicidial_campaigns-campaign_name$NWE</td></tr>\n";
echo "<tr bgcolor=#B6D3FC><td align=right>Aktiv:</td><td align=left><select size=1 name=active><option>Y</option><option>N</option></select>$NWB#vicidial_campaigns-active$NWE</td></tr>\n";
echo "<tr bgcolor=#B6D3FC><td align=right>Park-Verlängerung: </td><td align=left><input type=text name=park_ext size=10 maxlength=10>$NWB#vicidial_campaigns-park_ext$NWE</td></tr>\n";
echo "<tr bgcolor=#B6D3FC><td align=right>Park-Dateiname: </td><td align=left><input type=text name=park_file_name size=10 maxlength=10>$NWB#vicidial_campaigns-park_file_name$NWE</td></tr>\n";
echo "<tr bgcolor=#B6D3FC><td align=right>Netz-Form: </td><td align=left><input type=text name=web_form_address size=50 maxlength=255>$NWB#vicidial_campaigns-web_form_address$NWE</td></tr>\n";
echo "<tr bgcolor=#B6D3FC><td align=right>Erlauben Sie Closers: </td><td align=left><select size=1 name=allow_closers><option>Y</option><option>N</option></select>$NWB#vicidial_campaigns-allow_closers$NWE</td></tr>\n";
echo "<tr bgcolor=#B6D3FC><td align=right>Zufuhrbehälter-Niveau: </td><td align=left><select size=1 name=hopper_level><option>1</option><option>5</option><option>10</option><option>50</option><option>100</option><option>200</option><option>500</option><option>1000</option><option>2000</option></select>$NWB#vicidial_campaigns-hopper_level$NWE</td></tr>\n";
echo "<tr bgcolor=#B6D3FC><td align=right>Selbstvorwahlknopf-Niveau: </td><td align=left><select size=1 name=auto_dial_level><option selected>0</option><option>1</option><option>1.1</option><option>1.2</option><option>1.3</option><option>1.4</option><option>1.5</option><option>1.6</option><option>1.7</option><option>1.8</option><option>1.9</option><option>2.0</option><option>2.2</option><option>2.5</option><option>2.7</option><option>3.0</option><option>3.5</option><option>4.0</option></select>(0 = off)$NWB#vicidial_campaigns-auto_dial_level$NWE</td></tr>\n";
echo "<tr bgcolor=#B6D3FC><td align=right>Folgender Vertreter-Anruf: </td><td align=left><select size=1 name=next_agent_call><option >random</option><option>oldest_call_start</option><option>oldest_call_finish</option><option>overall_user_level</option></select>$NWB#vicidial_campaigns-next_agent_call$NWE</td></tr>\n";
echo "<tr bgcolor=#B6D3FC><td align=right>Ortsgespräch-Zeit: </td><td align=left><select size=1 name=local_call_time><option>24hours</option><option>9am-9pm</option><option>9am-5pm</option><option>12pm-5pm</option><option>12pm-9pm</option><option>5pm-9pm</option></select>$NWB#vicidial_campaigns-local_call_time$NWE</td></tr>\n";
echo "<tr bgcolor=#B6D3FC><td align=right>Voicemail: </td><td align=left><input type=text name=voicemail_ext size=10 maxlength=10 value=\"$voicemail_ext\">$NWB#vicidial_campaigns-voicemail_ext$NWE</td></tr>\n";
echo "<tr bgcolor=#B6D3FC><td align=right>Index: </td><td align=left><select size=1 name=script_id>\n";
echo "$scripts_list";
echo "</select>$NWB#vicidial_campaigns-campaign_script$NWE</td></tr>\n";
echo "<tr bgcolor=#B6D3FC><td align=right>Erhalten Sie Anruf-Produkteinführung: </td><td align=left><select size=1 name=get_call_launch><option selected>NONE</option><option>SCRIPT</option><option>WEBFORM</option></select>$NWB#vicidial_campaigns-get_call_launch$NWE</td></tr>\n";
echo "<tr bgcolor=#B6D3FC><td align=center colspan=2><input type=submit name=SUBMIT value=SUBMIT></td></tr>\n";
echo "</TABLE></center>\n";

}


######################
# ADD=111 display the ADD NEW LIST FORM SCREEN
######################

if ($ADD==111)
{
echo "<TABLE><TR><TD>\n";
echo "<FONT FACE=\"ARIAL,HELVETICA\" COLOR=BLACK SIZE=2>";

echo "<br>ADD A NEW LIST<form action=$PHP_SELF method=POST>\n";
echo "<input type=hidden name=ADD value=211>\n";
echo "<center><TABLE width=600 cellspacing=3>\n";
echo "<tr bgcolor=#B6D3FC><td align=right>Liste Identifikation: </td><td align=left><input type=text name=list_id size=8 maxlength=8> (nur Stellen)$NWB#vicidial_lists-list_id$NWE</td></tr>\n";
echo "<tr bgcolor=#B6D3FC><td align=right>Liste Name: </td><td align=left><input type=text name=list_name size=20 maxlength=20>$NWB#vicidial_lists-list_name$NWE</td></tr>\n";
echo "<tr bgcolor=#B6D3FC><td align=right>Kampagne: </td><td align=left><select size=1 name=campaign_id>\n";

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
echo "<tr bgcolor=#B6D3FC><td align=right>Aktiv:</td><td align=left><select size=1 name=active><option>Y</option><option SELECTED>N</option></select>$NWB#vicidial_lists-active$NWE</td></tr>\n";
echo "<tr bgcolor=#B6D3FC><td align=center colspan=2><input type=submit name=SUBMIT value=SUBMIT></td></tr>\n";
echo "</TABLE></center>\n";

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
		{echo "<br>DNC NICHT ADDIERT - diese Telefonnummer ist bereits in benennen nichtListe: $phone_number<BR><BR>\n";}
	else
		{
		$stmt="INSERT INTO vicidial_dnc (phone_number) values('$phone_number');";
		$rslt=mysql_query($stmt, $link);

		echo "<br><B>DNC FÜGTE HINZU: $phone_number</B><BR><BR>\n";

		### LOG INSERTION TO LOG FILE ###
		if ($WeBRooTWritablE > 0)
			{
			$fp = fopen ("./admin_changes_log.txt", "a");
			fwrite ($fp, "$date|ADD A NEW DNC NUMBER|$PHP_AUTH_USER|$ip|'$phone_number'|\n");
			fclose($fp);
			}
		}
	}

echo "<br>FÜGEN Sie Eine ZAHL Der DNC LISTE Hinzu<form action=$PHP_SELF method=POST>\n";
echo "<input type=hidden name=ADD value=121>\n";
echo "<center><TABLE width=600 cellspacing=3>\n";
echo "<tr bgcolor=#B6D3FC><td align=right>Telefonnummer: </td><td align=left><input type=text name=phone_number size=14 maxlength=12> (nur Stellen)$NWB#vicidial_list-dnc$NWE</td></tr>\n";
echo "<tr bgcolor=#B6D3FC><td align=center colspan=2><input type=submit name=SUBMIT value=SUBMIT></td></tr>\n";
echo "</TABLE></center>\n";

}


######################
# ADD=1111 display the ADD NEW INBOUND GROUP SCREEN
######################

if ($ADD==1111)
{
echo "<TABLE><TR><TD>\n";
echo "<FONT FACE=\"ARIAL,HELVETICA\" COLOR=BLACK SIZE=2>";

echo "<br>ADDIEREN Sie Eine NEUE INBOUND GRUPPE<form action=$PHP_SELF method=POST>\n";
echo "<input type=hidden name=ADD value=2111>\n";
echo "<center><TABLE width=600 cellspacing=3>\n";
echo "<tr bgcolor=#B6D3FC><td align=right>Gruppe Identifikation: </td><td align=left><input type=text name=group_id size=20 maxlength=20> (no spaces)$NWB#vicidial_inbound_groups-group_id$NWE</td></tr>\n";
echo "<tr bgcolor=#B6D3FC><td align=right>Gruppe Name: </td><td align=left><input type=text name=group_name size=30 maxlength=30>$NWB#vicidial_inbound_groups-group_name$NWE</td></tr>\n";
echo "<tr bgcolor=#B6D3FC><td align=right>Gruppe Farbe: </td><td align=left><input type=text name=group_color size=7 maxlength=7>$NWB#vicidial_inbound_groups-group_color$NWE</td></tr>\n";
echo "<tr bgcolor=#B6D3FC><td align=right>Aktiv:</td><td align=left><select size=1 name=active><option SELECTED>Y</option><option>N</option></select>$NWB#vicidial_inbound_groups-active$NWE</td></tr>\n";
echo "<tr bgcolor=#B6D3FC><td align=right>Netz-Form: </td><td align=left><input type=text name=web_form_address size=50 maxlength=255 value=\"$web_form_address\">$NWB#vicidial_inbound_groups-web_form_address$NWE</td></tr>\n";
echo "<tr bgcolor=#B6D3FC><td align=right>Voicemail: </td><td align=left><input type=text name=voicemail_ext size=10 maxlength=10 value=\"$voicemail_ext\">$NWB#vicidial_inbound_groups-voicemail_ext$NWE</td></tr>\n";
echo "<tr bgcolor=#B6D3FC><td align=right>Folgender Vertreter-Anruf: </td><td align=left><select size=1 name=next_agent_call><option >random</option><option>oldest_call_start</option><option>oldest_call_finish</option><option>overall_user_level</option></select>$NWB#vicidial_inbound_groups-next_agent_call$NWE</td></tr>\n";
echo "<tr bgcolor=#B6D3FC><td align=right>Fronter Anzeige: </td><td align=left><select size=1 name=fronter_display><option SELECTED>Y</option><option>N</option></select>$NWB#vicidial_inbound_groups-fronter_display$NWE</td></tr>\n";
echo "<tr bgcolor=#B6D3FC><td align=right>Index: </td><td align=left><select size=1 name=script_id>\n";
echo "$scripts_list";
echo "</select>$NWB#vicidial_inbound_groups-ingroup_script$NWE</td></tr>\n";
echo "<tr bgcolor=#B6D3FC><td align=right>Erhalten Sie Anruf-Produkteinführung: </td><td align=left><select size=1 name=get_call_launch><option selected>NONE</option><option>SCRIPT</option><option>WEBFORM</option></select>$NWB#vicidial_inbound_groups-get_call_launch$NWE</td></tr>\n";
echo "<tr bgcolor=#B6D3FC><td align=center colspan=2><input type=submit name=SUBMIT value=SUBMIT></td></tr>\n";
echo "</TABLE></center>\n";

}


######################
# ADD=11111 display the ADD NEW REMOTE AGENTS SCREEN
######################

if ($ADD==11111)
{
echo "<TABLE><TR><TD>\n";
echo "<FONT FACE=\"ARIAL,HELVETICA\" COLOR=BLACK SIZE=2>";

echo "<br>ADDIEREN SIE NEUE REMOTEMITTEL<form action=$PHP_SELF method=POST>\n";
echo "<input type=hidden name=ADD value=21111>\n";
echo "<center><TABLE width=600 cellspacing=3>\n";
echo "<tr bgcolor=#B6D3FC><td align=right>Benutzernummer Anfang: </td><td align=left><input type=text name=user_start size=6 maxlength=6> (nur Zahlen, incremented)$NWB#vicidial_remote_agents-user_start$NWE</td></tr>\n";
echo "<tr bgcolor=#B6D3FC><td align=right>Zeilenzahl: </td><td align=left><input type=text name=number_of_lines size=3 maxlength=3> (nur Zahlen)$NWB#vicidial_remote_agents-number_of_lines$NWE</td></tr>\n";
echo "<tr bgcolor=#B6D3FC><td align=right>Bediener IP: </td><td align=left><select size=1 name=server_ip>\n";
echo "$servers_list";
echo "</select>$NWB#vicidial_remote_agents-server_ip$NWE</td></tr>\n";
echo "<tr bgcolor=#B6D3FC><td align=right>Externe Verlängerung: </td><td align=left><input type=text name=conf_exten size=20 maxlength=20> (dialplan Zahl wählte, um Mittel zu erreichen)$NWB#vicidial_remote_agents-conf_exten$NWE</td></tr>\n";
echo "<tr bgcolor=#B6D3FC><td align=right>Status:</td><td align=left><select size=1 name=status><option>AKTIV</option><option SELECTED>INACTIVE</option></select>$NWB#vicidial_remote_agents-status$NWE</td></tr>\n";
echo "<tr bgcolor=#B6D3FC><td align=right>Kampagne: </td><td align=left><select size=1 name=campaign_id>\n";
echo "$campaigns_list";
echo "</select>$NWB#vicidial_remote_agents-campaign_id$NWE</td></tr>\n";
echo "<tr bgcolor=#B6D3FC><td align=right>Inbound Gruppen: </td><td align=left>\n";
echo "$groups_list";
echo "$NWB#vicidial_remote_agents-closer_campaigns$NWE</td></tr>\n";
echo "<tr bgcolor=#B6D3FC><td align=center colspan=2><input type=submit name=SUBMIT value=SUBMIT></td></tr>\n";
echo "</TABLE></center>\n";
echo "ANMERKUNG: Sie kann bis 30 Sekunden für die Änderungen dauern, dieauf diesem Schirm eingereicht werden, um Phasen zu gehen\n";

}


######################
# ADD=111111 display the ADD NEW USERS GROUP SCREEN
######################

if ($ADD==111111)
{
echo "<TABLE><TR><TD>\n";
echo "<FONT FACE=\"ARIAL,HELVETICA\" COLOR=BLACK SIZE=2>";

echo "<br>ADDIEREN SIE NEUE BENUTZER-GRUPPE<form action=$PHP_SELF method=POST>\n";
echo "<input type=hidden name=ADD value=211111>\n";
echo "<center><TABLE width=600 cellspacing=3>\n";
echo "<tr bgcolor=#B6D3FC><td align=right>Gruppe:</td><td align=left><input type=text name=user_group size=15 maxlength=20> (keine Räume oder Interpunktion)$NWB#vicidial_user_groups-user_group$NWE</td></tr>\n";
echo "<tr bgcolor=#B6D3FC><td align=right>Beschreibung:</td><td align=left><input type=text name=group_name size=40 maxlength=40> (Beschreibung der Gruppe)$NWB#vicidial_user_groups-group_name$NWE</td></tr>\n";
echo "<tr bgcolor=#B6D3FC><td align=center colspan=2><input type=submit name=SUBMIT value=SUBMIT></td></tr>\n";
echo "</TABLE></center>\n";

}


######################
# ADD=1111111 display the ADD NEW SCRIPT SCREEN
######################

if ($ADD==1111111)
{
echo "<TABLE><TR><TD>\n";
echo "<FONT FACE=\"ARIAL,HELVETICA\" COLOR=BLACK SIZE=2>";

echo "<br>ADD NEW SCRIPT<form action=$PHP_SELF method=POST>\n";
echo "<input type=hidden name=ADD value=2111111>\n";
echo "<center><TABLE width=600 cellspacing=3>\n";
echo "<tr bgcolor=#B6D3FC><td align=right>Index Identifikation: </td><td align=left><input type=text name=script_id size=12 maxlength=10> (keine Räume oder Interpunktion)$NWB#vicidial_scripts-script_id$NWE</td></tr>\n";
echo "<tr bgcolor=#B6D3FC><td align=right>Index-Name: </td><td align=left><input type=text name=script_name size=40 maxlength=50> (Titel dem Index)$NWB#vicidial_scripts-script_name$NWE</td></tr>\n";
echo "<tr bgcolor=#B6D3FC><td align=right>Index-Anmerkungen: </td><td align=left><input type=text name=script_comments size=50 maxlength=255> $NWB#vicidial_scripts-script_comments$NWE</td></tr>\n";
echo "<tr bgcolor=#B6D3FC><td align=right>Aktiv:</td><td align=left><select size=1 name=active><option SELECTED>Y</option><option>N</option></select>$NWB#vicidial_scripts-active$NWE</td></tr>\n";
echo "<tr bgcolor=#B6D3FC><td align=right>Index-Text: </td><td align=left><TEXTAREA NAME=script_text ROWS=20 COLS=50 value=\"\"></TEXTAREA> $NWB#vicidial_scripts-script_text$NWE</td></tr>\n";
echo "<tr bgcolor=#B6D3FC><td align=center colspan=2><input type=submit name=SUBMIT value=SUBMIT></td></tr>\n";
echo "</TABLE></center>\n";

}


######################
# ADD=11111111 display the ADD NEW FILTER SCREEN
######################

if ($ADD==11111111)
{
echo "<TABLE><TR><TD>\n";
echo "<FONT FACE=\"ARIAL,HELVETICA\" COLOR=BLACK SIZE=2>";

echo "<br>ADDIEREN SIE NEUEN FILTER<form action=$PHP_SELF method=POST>\n";
echo "<input type=hidden name=ADD value=21111111>\n";
echo "<center><TABLE width=600 cellspacing=3>\n";
echo "<tr bgcolor=#B6D3FC><td align=right>Filter Identifikation:</td><td align=left><input type=text name=lead_filter_id size=12 maxlength=10> (keine Räume oder Interpunktion)$NWB#vicidial_lead_filters-lead_filter_id$NWE</td></tr>\n";
echo "<tr bgcolor=#B6D3FC><td align=right>Filter-Name:</td><td align=left><input type=text name=lead_filter_name size=30 maxlength=30> (kurze Beschreibung des Filter)$NWB#vicidial_lead_filters-lead_filter_name$NWE</td></tr>\n";
echo "<tr bgcolor=#B6D3FC><td align=right>Filter-Anmerkungen:</td><td align=left><input type=text name=lead_filter_comments size=50 maxlength=255> $NWB#vicidial_lead_filters-lead_filter_comments$NWE</td></tr>\n";
echo "<tr bgcolor=#B6D3FC><td align=right>Filter Sql: </td><td align=left><TEXTAREA NAME=lead_filter_sql ROWS=20 COLS=50 value=\"\"></TEXTAREA> $NWB#vicidial_lead_filters-lead_filter_sql$NWE</td></tr>\n";
echo "<tr bgcolor=#B6D3FC><td align=center colspan=2><input type=submit name=SUBMIT value=SUBMIT></td></tr>\n";
echo "</TABLE></center>\n";
}


######################
# ADD=111111111 display the ADD NEW CALL TIME SCREEN
######################

if ($ADD==111111111)
{
echo "<TABLE><TR><TD>\n";
echo "<FONT FACE=\"ARIAL,HELVETICA\" COLOR=BLACK SIZE=2>";

echo "<br>Hinzufügen neuer Anrufzeiten<form action=$PHP_SELF method=POST>\n";
echo "<input type=hidden name=ADD value=211111111>\n";
echo "<center><TABLE width=620 cellspacing=3>\n";
echo "<tr bgcolor=#B6D3FC><td align=right>Anrufzeit ID: </td><td align=left><input type=text name=call_time_id size=12 maxlength=10> (keine Räume oder Interpunktion)$NWB#vicidial_call_times-call_time_id$NWE</td></tr>\n";
echo "<tr bgcolor=#B6D3FC><td align=right>Anrufzeit Name: </td><td align=left><input type=text name=call_time_name size=30 maxlength=30> (Kurze Beschreibung der Anrufzeit)$NWB#vicidial_call_times-call_time_name$NWE</td></tr>\n";
echo "<tr bgcolor=#B6D3FC><td align=right>Anrufzeit Kommentare: </td><td align=left><input type=text name=call_time_comments size=50 maxlength=255> $NWB#vicidial_call_times-call_time_comments$NWE</td></tr>\n";

echo "<tr bgcolor=#B6D3FC><td align=center colspan=2>Datums und Zeitoptionen erscheinen, wenn die Anrufzeitdefinition angelegt wurde</td></tr>\n";
echo "<tr bgcolor=#B6D3FC><td align=center colspan=2><input type=submit name=SUBMIT value=SUBMIT></td></tr>\n";
echo "</TABLE></center>\n";
}


######################
# ADD=1111111111 display the ADD NEW STATE CALL TIME SCREEN
######################

if ($ADD==1111111111)
{
echo "<TABLE><TR><TD>\n";
echo "<FONT FACE=\"ARIAL,HELVETICA\" COLOR=BLACK SIZE=2>";

echo "<br>Hinzufügen neuer landesspezifischer Anrufzeiten<form action=$PHP_SELF method=POST>\n";
echo "<input type=hidden name=ADD value=2111111111>\n";
echo "<center><TABLE width=620 cellspacing=3>\n";
echo "<tr bgcolor=#B6D3FC><td align=right>Landesspezifische Anrufzeiten ID: </td><td align=left><input type=text name=call_time_id size=12 maxlength=10> (keine Räume oder Interpunktion)$NWB#vicidial_call_times-call_time_id$NWE</td></tr>\n";
echo "<tr bgcolor=#B6D3FC><td align=right>State Call Time State: </td><td align=left><input type=text name=state_call_time_state size=4 maxlength=2> (keine Räume oder Interpunktion)$NWB#vicidial_call_times-state_call_time_state$NWE</td></tr>\n";
echo "<tr bgcolor=#B6D3FC><td align=right>Landesspezifischer Anrufzeiten Name: </td><td align=left><input type=text name=call_time_name size=30 maxlength=30> (Kurze Beschreibung der Anrufzeit)$NWB#vicidial_call_times-call_time_name$NWE</td></tr>\n";
echo "<tr bgcolor=#B6D3FC><td align=right>Landesspezifischer Anrufzeiten Kommentar: </td><td align=left><input type=text name=call_time_comments size=50 maxlength=255> $NWB#vicidial_call_times-call_time_comments$NWE</td></tr>\n";

echo "<tr bgcolor=#B6D3FC><td align=center colspan=2>Datums und Zeitoptionen erscheinen, wenn die Anrufzeitdefinition angelegt wurde</td></tr>\n";
echo "<tr bgcolor=#B6D3FC><td align=center colspan=2><input type=submit name=SUBMIT value=SUBMIT></td></tr>\n";
echo "</TABLE></center>\n";
}


######################
# ADD=11111111111 display the ADD NEW PHONE SCREEN
######################

if ($ADD==11111111111)
{
echo "<TABLE><TR><TD>\n";
echo "<FONT FACE=\"ARIAL,HELVETICA\" COLOR=BLACK SIZE=2>";

echo "<br>ADDIEREN Sie Ein NEUES TELEFON<form action=$PHP_SELF method=POST>\n";
echo "<input type=hidden name=ADD value=21111111111>\n";
echo "<center><TABLE width=600 cellspacing=3>\n";

echo "<center><TABLE width=600 cellspacing=3>\n";
echo "<tr bgcolor=#B6D3FC><td align=right>Telefonverlängerung: </td><td align=left><input type=text name=extension size=20 maxlength=100 value=\"\">$NWB#phones-extension$NWE</td></tr>\n";
echo "<tr bgcolor=#B6D3FC><td align=right>Dialplan Zahl: </td><td align=left><input type=text name=dialplan_number size=15 maxlength=20 value=\"$row[1]\"> (nur Stellen)$NWB#phones-dialplan_number$NWE</td></tr>\n";
echo "<tr bgcolor=#B6D3FC><td align=right>Voicemail Kasten: </td><td align=left><input type=text name=voicemail_id size=10 maxlength=10 value=\"$row[2]\"> (nur Stellen)$NWB#phones-voicemail_id$NWE</td></tr>\n";
echo "<tr bgcolor=#B6D3FC><td align=right>Outbound CallerID: </td><td align=left><input type=text name=outbound_cid size=10 maxlength=20 value=\"$row[65]\"> (nur Stellen)$NWB#phones-outbound_cid$NWE</td></tr>\n";
echo "<tr bgcolor=#B6D3FC><td align=right>Telefon-IP address: </td><td align=left><input type=text name=phone_ip size=20 maxlength=15 value=\"$row[3]\"> (optional)$NWB#phones-phone_ip$NWE</td></tr>\n";
echo "<tr bgcolor=#B6D3FC><td align=right>Computer-IP address: </td><td align=left><input type=text name=computer_ip size=20 maxlength=15 value=\"$row[4]\"> (optional)$NWB#phones-computer_ip$NWE</td></tr>\n";
echo "<tr bgcolor=#B6D3FC><td align=right>Bediener IP: </td><td align=left><select size=1 name=server_ip>\n";

echo "$servers_list";
echo "<option SELECTED>$row[5]</option>\n";
echo "</select>$NWB#phones-server_ip$NWE</td></tr>\n";
echo "<tr bgcolor=#B6D3FC><td align=right>Login: </td><td align=left><input type=text name=login size=10 maxlength=10 value=\"$row[6]\">$NWB#phones-login$NWE</td></tr>\n";
echo "<tr bgcolor=#B6D3FC><td align=right>Kennwort:</td><td align=left><input type=text name=pass size=10 maxlength=10 value=\"$row[7]\">$NWB#phones-pass$NWE</td></tr>\n";
echo "<tr bgcolor=#B6D3FC><td align=right>Status:</td><td align=left><select size=1 name=status><option>AKTIV</option><option>SUSPENDED</option><option>CLOSED</option><option>PENDING</option><option>ADMIN</option><option selected>$row[8]</option></select>$NWB#phones-status$NWE</td></tr>\n";
echo "<tr bgcolor=#B6D3FC><td align=right>Aktives Konto: </td><td align=left><select size=1 name=active><option>Y</option><option>N</option><option selected>$row[9]</option></select>$NWB#phones-active$NWE</td></tr>\n";
echo "<tr bgcolor=#B6D3FC><td align=right>Telefon-Art: </td><td align=left><input type=text name=phone_type size=20 maxlength=50 value=\"$row[10]\">$NWB#phones-phone_type$NWE</td></tr>\n";
echo "<tr bgcolor=#B6D3FC><td align=right>Voller Name: </td><td align=left><input type=text name=fullname size=20 maxlength=50 value=\"$row[11]\">$NWB#phones-fullname$NWE</td></tr>\n";
echo "<tr bgcolor=#B6D3FC><td align=right>Firma:</td><td align=left><input type=text name=company size=10 maxlength=10 value=\"$row[12]\">$NWB#phones-company$NWE</td></tr>\n";
echo "<tr bgcolor=#B6D3FC><td align=right>Abbildung:</td><td align=left><input type=text name=picture size=20 maxlength=19 value=\"$row[13]\">$NWB#phones-picture$NWE</td></tr>\n";
echo "<tr bgcolor=#B6D3FC><td align=right>Klient Protokoll: </td><td align=left><select size=1 name=protocol><option>SIP</option><option>Zap</option><option>IAX2</option><option>EXTERNAL</option><option selected>$row[16]</option></select>$NWB#phones-protocol$NWE</td></tr>\n";
echo "<tr bgcolor=#B6D3FC><td align=right>Lokales GMT: </td><td align=left><select size=1 name=local_gmt><option>12.75</option><option>12.00</option><option>11.00</option><option>10.00</option><option>9.50</option><option>9.00</option><option>8.00</option><option>7.00</option><option>6.50</option><option>6.00</option><option>5.75</option><option>5.50</option><option>5.00</option><option>4.50</option><option>4.00</option><option>3.50</option><option>3.00</option><option>2.00</option><option>1.00</option><option>0.00</option><option>-1.00</option><option>-2.00</option><option>-3.00</option><option>-3.50</option><option>-4.00</option><option>-5.00</option><option>-6.00</option><option>-7.00</option><option>-8.00</option><option>-9.00</option><option>-10.00</option><option>-11.00</option><option>-12.00</option><option selected>$row[17]</option></select> (Stellen Sie NICHT auf DST ein)$NWB#phones-local_gmt$NWE</td></tr>\n";
echo "<tr bgcolor=#B6D3FC><td align=center colspan=2><input type=submit name=submit VALUE=SUBMIT></td></tr>\n";
echo "</TABLE></center>\n";
}


######################
# ADD=111111111111 display the ADD NEW SERVER SCREEN
######################

if ($ADD==111111111111)
{
echo "<TABLE><TR><TD>\n";
echo "<FONT FACE=\"ARIAL,HELVETICA\" COLOR=BLACK SIZE=2>";

echo "<br>ADDIEREN Sie Einen NEUEN BEDIENER<form action=$PHP_SELF method=POST>\n";
echo "<input type=hidden name=ADD value=211111111111>\n";
echo "<center><TABLE width=600 cellspacing=3>\n";
echo "<tr bgcolor=#B6D3FC><td align=right>Bediener Identifikation: </td><td align=left><input type=text name=server_id size=10 maxlength=10>$NWB#servers-server_id$NWE</td></tr>\n";
echo "<tr bgcolor=#B6D3FC><td align=right>Bediener-Beschreibung: </td><td align=left><input type=text name=server_description size=30 maxlength=255>$NWB#servers-server_description$NWE</td></tr>\n";
echo "<tr bgcolor=#B6D3FC><td align=right>Bediener-IP address: </td><td align=left><input type=text name=server_ip size=20 maxlength=15>$NWB#servers-server_ip$NWE</td></tr>\n";
echo "<tr bgcolor=#B6D3FC><td align=right>Aktiv:</td><td align=left><select size=1 name=active><option>Y</option><option>N</option></select>$NWB#servers-active$NWE</td></tr>\n";
echo "<tr bgcolor=#B6D3FC><td align=right>Sternchen-Version: </td><td align=left><input type=text name=asterisk_version size=20 maxlength=20>$NWB#servers-asterisk_version$NWE</td></tr>\n";
echo "<tr bgcolor=#B6D3FC><td align=center colspan=2><input type=submit name=submit VALUE=SUBMIT></td></tr>\n";
echo "</TABLE></center>\n";
}


######################
# ADD=1111111111111 display the ADD NEW CONFERENCE SCREEN
######################

if ($ADD==1111111111111)
{
echo "<TABLE><TR><TD>\n";
echo "<FONT FACE=\"ARIAL,HELVETICA\" COLOR=BLACK SIZE=2>";

echo "<br>ADDIEREN Sie Eine NEUE KONFERENZ<form action=$PHP_SELF method=POST>\n";
echo "<input type=hidden name=ADD value=2111111111111>\n";
echo "<center><TABLE width=600 cellspacing=3>\n";
echo "<tr bgcolor=#B6D3FC><td align=right>Konferenz-Zahl: </td><td align=left><input type=text name=conf_exten size=8 maxlength=7> (nur Stellen)$NWB#conferences-conf_exten$NWE</td></tr>\n";
echo "<tr bgcolor=#B6D3FC><td align=right>Bediener IP: </td><td align=left><select size=1 name=server_ip>\n";

echo "$servers_list";
echo "<option SELECTED>$server_ip</option>\n";
echo "</select>$NWB#conferences-server_ip$NWE</td></tr>\n";
echo "<tr bgcolor=#B6D3FC><td align=center colspan=2><input type=submit name=submit VALUE=SUBMIT></td></tr>\n";
echo "</TABLE></center>\n";
}


######################
# ADD=11111111111111 display the ADD NEW VICIDIAL CONFERENCE SCREEN
######################

if ($ADD==11111111111111)
{
echo "<TABLE><TR><TD>\n";
echo "<FONT FACE=\"ARIAL,HELVETICA\" COLOR=BLACK SIZE=2>";

echo "<br>ADD A NEW VICIDIAL CONFERENCE<form action=$PHP_SELF method=POST>\n";
echo "<input type=hidden name=ADD value=21111111111111>\n";
echo "<center><TABLE width=600 cellspacing=3>\n";
echo "<tr bgcolor=#B6D3FC><td align=right>Konferenz-Zahl: </td><td align=left><input type=text name=conf_exten size=8 maxlength=7> (nur Stellen)$NWB#conferences-conf_exten$NWE</td></tr>\n";
echo "<tr bgcolor=#B6D3FC><td align=right>Bediener IP: </td><td align=left><select size=1 name=server_ip>\n";

echo "$servers_list";
echo "<option SELECTED>$server_ip</option>\n";
echo "</select>$NWB#conferences-server_ip$NWE</td></tr>\n";
echo "<tr bgcolor=#B6D3FC><td align=center colspan=2><input type=submit name=submit VALUE=SUBMIT></td></tr>\n";
echo "</TABLE></center>\n";
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
		{echo "<br>BENUTZER NICHT ADDIERT - es gibt bereits einen Benutzer im System mitdieser Benutzerzahl\n";}
	else
		{
		 if ( (strlen($user) < 2) or (strlen($pass) < 2) or (strlen($full_name) < 2) or (strlen($user) > 8) )
			{
			 echo "<br>BENUTZER NICHT ADDIERT - gehen Sie bitte zurück und betrachten Siedie Daten, die Sie eingaben\n";
			 echo "<br>Teilnehmerbezeichnung muß zwischen 2 und 8 Buchstaben lang sein\n";
			 echo "<br>voller Name und Kennwort müssen mindestens 2 Buchstaben lang sein\n";
			}
		 else
			{
			echo "<br><B>BENUTZER FÜGTE HINZU: $user</B>\n";

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
		{echo "<br>KAMPAGNE NICHT ADDIERT - es gibt bereits eine Kampagne im System mitdieser Identifikation\n";}
	else
		{
		 if ( (strlen($campaign_id) < 2) or (strlen($campaign_id) > 8) or (strlen($campaign_name) < 6)  or (strlen($campaign_name) > 40) )
			{
			 echo "<br>KAMPAGNE NICHT ADDIERT - gehen Sie bitte zurück und betrachten Siedie Daten, die Sie eingaben\n";
			 echo "<br>Kampagne Identifikation muß zwischen 2 und 8 Buchstaben lang sein\n";
			 echo "<br>Kampagne Name muß zwischen 6 und 40 Buchstaben lang sein\n";
			}
		 else
			{
			echo "<br><B>KAMPAGNE ADDIERT: $campaign_id</B>\n";

			$stmt="INSERT INTO vicidial_campaigns (campaign_id,campaign_name,active,dial_status_a,lead_order,park_ext,park_file_name,web_form_address,allow_closers,hopper_level,auto_dial_level,next_agent_call,local_call_time,voicemail_ext,campaign_script,get_call_launch) values('$campaign_id','$campaign_name','$active','NEW','DOWN','$park_ext','$park_file_name','" . mysql_real_escape_string($web_form_address) . "','$allow_closers','$hopper_level','$auto_dial_level','$next_agent_call','$local_call_time','$voicemail_ext','$script_id','$get_call_launch');";
			$rslt=mysql_query($stmt, $link);

			$stmt="INSERT INTO vicidial_campaign_stats (campaign_id) values('$campaign_id');";
			$rslt=mysql_query($stmt, $link);

			echo "<!-- $stmt -->";
			### LOG CHANGES TO LOG FILE ###
			if ($WeBRooTWritablE > 0)
				{
				$fp = fopen ("./admin_changes_log.txt", "a");
				fwrite ($fp, "$date|ADDIEREN Sie Eine NEUE KAMPAGNE  |$PHP_AUTH_USER|$ip|$stmt|\n");
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
		{echo "<br>KAMPAGNE STATUS NICHT ADDIERT - es gibt bereits einen Kampagne-Statusim System mit diesem Namen\n";}
	else
		{
		$stmt="SELECT count(*) from vicidial_statuses where status='$status';";
		$rslt=mysql_query($stmt, $link);
		$row=mysql_fetch_row($rslt);
		if ($row[0] > 0)
			{echo "<br>KAMPAGNE STATUS NICHT ADDIERT - es gibt bereits einen Globalstatus imSystem mit diesem Namen\n";}
		else
			{
			 if ( (strlen($campaign_id) < 2) or (strlen($status) < 1) or (strlen($status_name) < 2) )
				{
				 echo "<br>KAMPAGNE STATUS NICHT ADDIERT - gehen Sie bitte zurück und betrachtenSie die Daten, die Sie eingaben\n";
				 echo "<br>Status muß zwischen 1 und 8 Buchstaben lang sein\n";
				 echo "<br>Statusname muß zwischen 2 und 30 Buchstaben lang sein\n";
				}
			 else
				{
				echo "<br><B>KAMPAGNE STATUS ADDIERT: $campaign_id - $status</B>\n";

				$stmt="INSERT INTO vicidial_campaign_statuses values('$status','$status_name','$selectable','$campaign_id');";
				$rslt=mysql_query($stmt, $link);

				### LOG CHANGES TO LOG FILE ###
				if ($WeBRooTWritablE > 0)
					{
					$fp = fopen ("./admin_changes_log.txt", "a");
					fwrite ($fp, "$date|ADDIEREN Sie Eine NEUE KAMPAGNE STATUS |$PHP_AUTH_USER|$ip|'$status','$status_name','$selectable','$campaign_id'|\n");
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
		{echo "<br>KAMPAGNE HOTKEY NICHT ADDIERT worden - es gibt bereits eineKampagne-hotkey im System mit diesem hotkey\n";}
	else
		{
		 if ( (strlen($campaign_id) < 2) or (strlen($status) < 1) or (strlen($hotkey) < 1) )
			{
			 echo "<br>KAMPAGNE HOTKEY NICHT ADDIERT - gehen Sie bitte zurück und betrachtenSie die Daten, die Sie eingaben\n";
			 echo "<br>hotkey muß ein einzelner Buchstabe zwischen 1 und 9 sein \n";
			 echo "<br>Status muß zwischen 1 und 8 Buchstaben lang sein\n";
			}
		 else
			{
			echo "<br><B>KAMPAGNE HOTKEY FÜGTE HINZU: $campaign_id - $status - $hotkey</B>\n";

			$stmt="INSERT INTO vicidial_campaign_hotkeys values('$status','$hotkey','$status_name','$selectable','$campaign_id');";
			$rslt=mysql_query($stmt, $link);

			### LOG CHANGES TO LOG FILE ###
			if ($WeBRooTWritablE > 0)
				{
				$fp = fopen ("./admin_changes_log.txt", "a");
				fwrite ($fp, "$date|ADDIEREN Sie Eine NEUE KAMPAGNE HOTKEY |$PHP_AUTH_USER|$ip|'$status','$hotkey','$status_name','$selectable','$campaign_id'|\n");
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
		{echo "<br>KAMPAGNE LEITUNG BEREITEN NICHT HINZUGEFÜGT auf - es gibt bereitseine Führenwiederverwertung für diese Kampagne mit diesem Status\n";}
	else
		{
		 if ( (strlen($campaign_id) < 2) or (strlen($status) < 1) or ($attempt_delay < 120) or ($attempt_maximum < 1) or ($attempt_maximum > 10) )
			{
			 echo "<br>KAMPAGNE LEITUNG BEREITEN NICHT HINZUGEFÜGT auf - gehen Sie bittezurück und betrachten Sie die Daten, die Sie eingaben\n";
			 echo "<br>Status muß zwischen 1 und 6 Buchstaben lang sein\n";
			 echo "<br>Versuch verzögert muß mindestens 120 Sekunden sein\n";
			 echo "<br>maximale Versuche müssen von 1 bis 10 sein\n";
			}
		 else
			{
			echo "<br><B>KAMPAGNE LEITUNG BEREITEN HINZUGEFÜGT AUF: $campaign_id - $status - $attempt_delay</B>\n";

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
# ADD=211 adds the new list to the system
######################

if ($ADD==211)
{
	echo "<FONT FACE=\"ARIAL,HELVETICA\" COLOR=BLACK SIZE=2>";
	$stmt="SELECT count(*) from vicidial_lists where list_id='$list_id';";
	$rslt=mysql_query($stmt, $link);
	$row=mysql_fetch_row($rslt);
	if ($row[0] > 0)
		{echo "<br>LISTE NICHT ADDIERT - es gibt bereits eine Liste im System mit dieserIdentifikation\n";}
	else
		{
		 if ( (strlen($campaign_id) < 2) or (strlen($list_name) < 2)  or ($list_id < 100) or (strlen($list_id) > 8) )
			{
			 echo "<br>LISTE NICHT ADDIERT - gehen Sie bitte zurück und betrachten Sie dieDaten, die Sie eingaben\n";
			 echo "<br>Liste Identifikation muß zwischen 2 und 8 Buchstaben lang sein\n";
			 echo "<br>Liste Name muß mindestens 2 Buchstaben lang sein\n";
			 echo "<br>Liste Identifikation must be greater than 100\n";
			 }
		 else
			{
			echo "<br><B>LISTE ADDIERT: $list_id</B>\n";

			$stmt="INSERT INTO vicidial_lists values('$list_id','$list_name','$campaign_id','$active');";
			$rslt=mysql_query($stmt, $link);

			### LOG CHANGES TO LOG FILE ###
			if ($WeBRooTWritablE > 0)
				{
				$fp = fopen ("./admin_changes_log.txt", "a");
				fwrite ($fp, "$date|ADD A NEW LIST      |$PHP_AUTH_USER|$ip|'$list_id','$list_name','$campaign_id','$active'|\n");
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
		{echo "<br>GRUPPE NICHT ADDIERT - es gibt bereits eine Gruppe im System mitdieser Identifikation\n";}
	else
		{
		 if ( (strlen($group_id) < 2) or (strlen($group_name) < 2)  or (strlen($group_color) < 2) or (strlen($group_id) > 20) or (eregi(' ',$group_id)) or (eregi("\-",$group_id)) or (eregi("\+",$group_id)) )
			{
			 echo "<br>GRUPPE NICHT ADDIERT - gehen Sie bitte zurück und betrachten Sie dieDaten, die Sie eingaben\n";
			 echo "<br>Gruppe Identifikation muß zwischen 2 und 20 Buchstaben lang sein undNr. enthalten ' -+'.\n";
			 echo "<br>Gruppe Name und Gruppe Farbe muß mindestens 2 Buchstaben lang sein\n";
			}
		 else
			{
			$stmt="INSERT INTO vicidial_inbound_groups (group_id,group_name,group_color,active,web_form_address,voicemail_ext,next_agent_call,fronter_display,ingroup_script,get_call_launch) values('$group_id','$group_name','$group_color','$active','" . mysql_real_escape_string($web_form_address) . "','$voicemail_ext','$next_agent_call','$fronter_display','$script_id','$get_call_launch');";
			$rslt=mysql_query($stmt, $link);

			echo "<br><B>GRUPPE FÜGTE HINZU: $group_id</B>\n";

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
		{echo "<br>REMOTEMITTEL NICHT ADDIERT - es gibt bereits eineRemotemitteleintragung beginnend mit diesem userID\n";}
	else
		{
		 if ( (strlen($server_ip) < 2) or (strlen($user_start) < 2)  or (strlen($campaign_id) < 2) or (strlen($conf_exten) < 2) )
			{
			 echo "<br>REMOTEMITTEL NICHT ADDIERT - gehen Sie bitte zurück und betrachtenSie die Daten, die Sie eingaben\n";
			 echo "<br>Benutzernummer Anfang und externe Verlängerung müssen mindestens 2Buchstaben lang sein\n";
			 }
		 else
			{
			$stmt="INSERT INTO vicidial_remote_agents values('','$user_start','$number_of_lines','$server_ip','$conf_exten','$status','$campaign_id','$groups_value');";
			$rslt=mysql_query($stmt, $link);

			echo "<br><B>REMOTEMITTEL FÜGTEN HINZU: $user_start</B>\n";

			### LOG CHANGES TO LOG FILE ###
			if ($WeBRooTWritablE > 0)
				{
				$fp = fopen ("./admin_changes_log.txt", "a");
				fwrite ($fp, "$date|ADD A NEW REMOTEMITTEL ENTRY     |$PHP_AUTH_USER|$ip|'$user_start','$number_of_lines','$server_ip','$conf_exten','$status','$campaign_id','$groups_value'|\n");
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
		{echo "<br>BENUTZER-GRUPPE NICHT ADDIERT - es gibt bereits eine BenutzergruppeEintragung mit diesem Namen\n";}
	else
		{
		 if ( (strlen($user_group) < 2) or (strlen($group_name) < 2) )
			{
			 echo "<br>BENUTZER-GRUPPE NICHT ADDIERT - gehen Sie bitte zurück und betrachtenSie die Daten, die Sie eingaben\n";
			 echo "<br>Gruppe Name und Beschreibung müssen mindestens 2 Buchstaben langsein\n";
			 }
		 else
			{
			$stmt="INSERT INTO vicidial_user_groups(user_group,group_name,allowed_campaigns) values('$user_group','$group_name','-ALL-CAMPAIGNS-');";
			$rslt=mysql_query($stmt, $link);

			echo "<br><B>BENUTZER-GRUPPE ADDIERT: $user_group</B>\n";

			### LOG CHANGES TO LOG FILE ###
			if ($WeBRooTWritablE > 0)
				{
				$fp = fopen ("./admin_changes_log.txt", "a");
				fwrite ($fp, "$date|ADDIEREN Sie Einen NEUEN BENUTZER GROUP ENTRY     |$PHP_AUTH_USER|$ip|$stmt|\n");
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
		{echo "<br>INDEX NICHT ADDIERT - es gibt bereits eine Indexeintragung mit diesem Namen\n";}
	else
		{
		 if ( (strlen($script_id) < 2) or (strlen($script_name) < 2) or (strlen($script_text) < 2) )
			{
			 echo "<br>INDEX NICHT ADDIERT - Gehen Sie bitte zurück und betrachten Sie die Daten, die Sieeingaben\n";
			 echo "<br>Indexname, -beschreibung und -text müssen mindestens 2 Buchstabenlang sein\n";
			 }
		 else
			{
			$stmt="INSERT INTO vicidial_scripts values('$script_id','$script_name','$script_comments','$script_text','$active');";
			$rslt=mysql_query($stmt, $link);

			echo "<br><B>INDEX FÜGTE HINZU: $script_id</B>\n";

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
		{echo "<br>FILTER NICHT ADDIERT - es gibt bereits eine Filtereintragung mitdieser Identifikation\n";}
	else
		{
		 if ( (strlen($lead_filter_id) < 2) or (strlen($lead_filter_name) < 2) or (strlen($lead_filter_sql) < 2) )
			{
			 echo "<br>FILTER NICHT ADDIERT - Gehen Sie bitte zurück und betrachten Sie die Daten, die Sieeingaben\n";
			 echo "<br>Filtern Sie Identifikation, Namen und SQL muß mindestens 2 Buchstabenlang sein\n";
			 }
		 else
			{
			$stmt="INSERT INTO vicidial_lead_filters SET lead_filter_id='$lead_filter_id',lead_filter_name='$lead_filter_name',lead_filter_comments='$lead_filter_comments',lead_filter_sql='$lead_filter_sql';";
			$rslt=mysql_query($stmt, $link);

			echo "<br><B>FILTER ADDIERT: $lead_filter_id</B>\n";

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
		{echo "<br>Anrufzeit Definition nicht hinzugefügt - Es existiert bereits ein Anrufzeiteintrag mit dieser ID\n";}
	else
		{
		 if ( (strlen($call_time_id) < 2) or (strlen($call_time_name) < 2) )
			{
			 echo "<br>Anrufzeit Definition nicht hinzugefügt - Gehen Sie bitte zurück und betrachten Sie die Daten, die Sieeingaben\n";
			 echo "<br>Anrufzeit ID und Name müssen mindestens 2 Zeichen Länge haben\n";
			 }
		 else
			{
			$stmt="INSERT INTO vicidial_call_times SET call_time_id='$call_time_id',call_time_name='$call_time_name',call_time_comments='$call_time_comments';";
			$rslt=mysql_query($stmt, $link);

			echo "<br><B>Anrufzeit hinzugefügt: $call_time_id</B>\n";

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
		{echo "<br>Landesspezifische Anrufzeitdefinition nicht hinzugefügt - Es existiert bereits ein Anrufzeiteintrag mit dieser ID\n";}
	else
		{
		 if ( (strlen($call_time_id) < 2) or (strlen($call_time_name) < 2) or (strlen($state_call_time_state) < 2) )
			{
			 echo "<br>Landesspezifische Anrufzeitdefinition nicht hinzugefügt - Gehen Sie bitte zurück und betrachten Sie die Daten, die Sieeingaben\n";
			 echo "<br>Landesspezifische Anrufzeit ID, Name und Land müssen mindestens 2 Zeichen Länge haben\n";
			 }
		 else
			{
			$stmt="INSERT INTO vicidial_state_call_times SET state_call_time_id='$call_time_id',state_call_time_name='$call_time_name',state_call_time_comments='$call_time_comments',state_call_time_state='$state_call_time_state';";
			$rslt=mysql_query($stmt, $link);

			echo "<br><B>landesspezifische Anrufzeiten hinzugefügt: $call_time_id</B>\n";

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
		{echo "<br>TELEFON NICHT ADDIERT - es gibt bereits ein Telefon im System mitdiesem extension/server\n";}
	else
		{
		 if ( (strlen($extension) < 1) or (strlen($server_ip) < 7) or (strlen($dialplan_number) < 1) or (strlen($voicemail_id) < 1) or (strlen($login) < 1)  or (strlen($pass) < 1))
			{echo "<br>TELEFON NICHT ADDIERT - gehen Sie bitte zurück und betrachten Sie dieDaten, die Sie eingaben\n";}
		 else
			{
			echo "<br>TELEFON FÜGTE HINZU\n";

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
		{echo "<br>BEDIENERNOT ADDED - there is already a server in the system with this ID\n";}
	else
		{
		 if ( (strlen($server_id) < 1) or (strlen($server_ip) < 7) )
			{echo "<br>BEDIENERNOT ADDED - Gehen Sie bitte zurück und betrachten Sie die Daten, die Sieeingaben\n";}
		 else
			{
			echo "<br>BEDIENERADDED\n";

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
		echo "<br>VICIDIAL BEDIENER-STAMM-SATZ NICHT ADDIERT - die Zahl vicidial Stämmen ist zu hoch: $SUMvicidial_trunks / $MAXvicidial_trunks\n";
		}
	else
		{
		$stmt="SELECT count(*) from vicidial_server_trunks where campaign_id='$campaign_id' and server_ip='$server_ip';";
		$rslt=mysql_query($stmt, $link);
		$row=mysql_fetch_row($rslt);
		if ($row[0] > 0)
			{echo "<br>VICIDIAL BEDIENER-STAMM-SATZ NICHT ADDIERT - es gibt bereits eine Bediener-Stamm Aufzeichnung für diese Kampagne\n";}
		else
			{
			 if ( (strlen($campaign_id) < 2) or (strlen($server_ip) < 7) or (strlen($dedicated_trunks) < 1) or (strlen($trunk_restriction) < 1) )
				{
				 echo "<br>VICIDIAL BEDIENER-STAMM-SATZ NICHT ADDIERT - Gehen Sie bitte zurück und betrachten Sie die Daten, die Sieeingaben\n";
				 echo "<br>Kampagne muß zwischen 3 und 8 Buchstaben lang sein\n";
				 echo "<br>server_ip verzögert muß mindestens 7 Buchstaben sein\n";
				 echo "<br>Stämme müssen eine Stelle von 0 bis 9999 sein\n";
				}
			 else
				{
				echo "<br><B>VICIDIAL BEDIENER-STAMM-SATZ ADDIERT: $campaign_id - $server_ip - $dedicated_trunks - $trunk_restriction</B>\n";

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
		{echo "<br>KONFERENZ NICHT ADDIERT - es gibt bereits eine Konferenz im System mitdieser Identifikation und Bediener\n";}
	else
		{
		 if ( (strlen($conf_exten) < 1) or (strlen($server_ip) < 7) )
			{echo "<br>KONFERENZ NICHT ADDIERT - gehen Sie bitte zurück und betrachten Siedie Daten, die Sie eingaben\n";}
		 else
			{
			echo "<br>KONFERENZ FÜGTE HINZU\n";

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
			{echo "<br>VICIDIAL KONFERENZ NICHT ADDIERT - gehen Sie bitte zurück und betrachten Siedie Daten, die Sie eingaben\n";}
		 else
			{
			echo "<br>VICIDIAL KONFERENZ FÜGTE HINZU\n";

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
	echo "<FONT FACE=\"ARIAL,HELVETICA\" COLOR=BLACK SIZE=2>";

	 if ( (strlen($pass) < 2) or (strlen($full_name) < 2) or (strlen($user_level) < 1) )
		{
		 echo "<br>BENUTZER NICHT GEÄNDERT - gehen Sie bitte zurück und betrachten Siedie Daten, die Sie eingaben\n";
		 echo "<br>Kennwort und voller Name jedes Notwendigkeit ot sind mindestens 2Buchstaben lang\n";
		}
	 else
		{
		echo "<br><B>BENUTZER ÄNDERTE - ADMIN: $user</B>\n";

		$stmt="UPDATE vicidial_users set pass='$pass',full_name='$full_name',user_level='$user_level',user_group='$user_group',phone_login='$phone_login',phone_pass='$phone_pass',delete_users='$delete_users',delete_user_groups='$delete_user_groups',delete_lists='$delete_lists',delete_campaigns='$delete_campaigns',delete_ingroups='$delete_ingroups',delete_remote_agents='$delete_remote_agents',load_leads='$load_leads',campaign_detail='$campaign_detail',ast_admin_access='$ast_admin_access',ast_delete_phones='$ast_delete_phones',delete_scripts='$delete_scripts',modify_leads='$modify_leads',hotkeys_active='$hotkeys_active',change_agent_campaign='$change_agent_campaign',agent_choose_ingroups='$agent_choose_ingroups',closer_campaigns='$groups_value',scheduled_callbacks='$scheduled_callbacks',agentonly_callbacks='$agentonly_callbacks',agentcall_manual='$agentcall_manual',vicidial_recording='$vicidial_recording',vicidial_transfers='$vicidial_transfers',delete_filters='$delete_filters',alter_agent_interface_options='$alter_agent_interface_options',closer_default_blended='$closer_default_blended',delete_call_times='$delete_call_times',modify_call_times='$modify_call_times' where user='$user';";
		$rslt=mysql_query($stmt, $link);



		### LOG CHANGES TO LOG FILE ###
		if ($WeBRooTWritablE > 0)
			{
			$fp = fopen ("./admin_changes_log.txt", "a");
			fwrite ($fp, "$date|MODIFY USER INFO    |$PHP_AUTH_USER|$ip|$stmt|\n");
			fclose($fp);
			}
		}

$ADD=3;		# go to user modification below
}


######################
# ADD=4B submit user modifications to the system - ADMIN
######################

if ($ADD=="4B")
{
	echo "<FONT FACE=\"ARIAL,HELVETICA\" COLOR=BLACK SIZE=2>";

	 if ( (strlen($pass) < 2) or (strlen($full_name) < 2) or (strlen($user_level) < 1) )
		{
		 echo "<br>BENUTZER NICHT GEÄNDERT - gehen Sie bitte zurück und betrachten Siedie Daten, die Sie eingaben\n";
		 echo "<br>Kennwort und voller Name jedes Notwendigkeit ot sind mindestens 2Buchstaben lang\n";
		}
	 else
		{
		echo "<br><B>BENUTZER ÄNDERTE - ADMIN: $user</B>\n";

		$stmt="UPDATE vicidial_users set pass='$pass',full_name='$full_name',user_level='$user_level',user_group='$user_group',phone_login='$phone_login',phone_pass='$phone_pass',hotkeys_active='$hotkeys_active',agent_choose_ingroups='$agent_choose_ingroups',closer_campaigns='$groups_value',scheduled_callbacks='$scheduled_callbacks',agentonly_callbacks='$agentonly_callbacks',agentcall_manual='$agentcall_manual',vicidial_recording='$vicidial_recording',vicidial_transfers='$vicidial_transfers',closer_default_blended='$closer_default_blended' where user='$user';";
		$rslt=mysql_query($stmt, $link);



		### LOG CHANGES TO LOG FILE ###
		if ($WeBRooTWritablE > 0)
			{
			$fp = fopen ("./admin_changes_log.txt", "a");
			fwrite ($fp, "$date|MODIFY USER INFO    |$PHP_AUTH_USER|$ip|pass='$pass',full_name='$full_name',user_level='$user_level',user_group='$user_group',phone_login='$phone_login',phone_pass='$phone_pass',hotkeys_active='$hotkeys_active',agent_choose_ingroups='$agent_choose_ingroups',closer_campaigns='$groups_value',scheduled_callbacks='$scheduled_callbacks',agentonly_callbacks='$agentonly_callbacks',agentcall_manual='$agentcall_manual',vicidial_recording='$vicidial_recording',vicidial_transfers='$vicidial_transfers',closer_default_blended='$closer_default_blended' where user='$user'|\n");
			fclose($fp);
			}
		}

$ADD=3;		# go to user modification below
}



######################
# ADD=4 submit user modifications to the system
######################

if ($ADD==4)
{
	echo "<FONT FACE=\"ARIAL,HELVETICA\" COLOR=BLACK SIZE=2>";

	 if ( (strlen($pass) < 2) or (strlen($full_name) < 2) or (strlen($user_level) < 1) )
		{
		 echo "<br>BENUTZER NICHT GEÄNDERT - gehen Sie bitte zurück und betrachten Siedie Daten, die Sie eingaben\n";
		 echo "<br>Kennwort und voller Name jedes Notwendigkeit ot sind mindestens 2Buchstaben lang\n";
		}
	 else
		{
		echo "<br><B>BENUTZER ÄNDERTE: $user</B>\n";

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

$ADD=3;		# go to user modification below
}

######################
# ADD=41 submit campaign modifications to the system
######################

if ($ADD==41)
{
	echo "<FONT FACE=\"ARIAL,HELVETICA\" COLOR=BLACK SIZE=2>";

	 if ( (strlen($campaign_name) < 6) or (strlen($active) < 1) )
		{
		 echo "<br>KAMPAGNE NICHT GEÄNDERT - gehen Sie bitte zurück und betrachten Siedie Daten, die Sie eingaben\n";
		 echo "<br>der Kampagne Name muß mindestens 6 Buchstaben lang sein\n";
		}
	 else
		{
		echo "<br><B>KAMPAGNE ÄNDERTE: $campaign_id</B>\n";

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
		$stmtA="UPDATE vicidial_campaigns set campaign_name='$campaign_name',active='$active',dial_status_a='$dial_status_a',dial_status_b='$dial_status_b',dial_status_c='$dial_status_c',dial_status_d='$dial_status_d',dial_status_e='$dial_status_e',lead_order='$lead_order',allow_closers='$allow_closers',hopper_level='$hopper_level', $adlSQL next_agent_call='$next_agent_call', local_call_time='$local_call_time', voicemail_ext='$voicemail_ext', dial_timeout='$dial_timeout', dial_prefix='$dial_prefix', campaign_cid='$campaign_cid', campaign_vdad_exten='$campaign_vdad_exten', web_form_address='" . mysql_real_escape_string($web_form_address) . "', park_ext='$park_ext', park_file_name='$park_file_name', campaign_rec_exten='$campaign_rec_exten', campaign_recording='$campaign_recording', campaign_rec_filename='$campaign_rec_filename', campaign_script='$script_id', get_call_launch='$get_call_launch', am_message_exten='$am_message_exten', amd_send_to_vmx='$amd_send_to_vmx', xferconf_a_dtmf='$xferconf_a_dtmf',xferconf_a_number='$xferconf_a_number', xferconf_b_dtmf='$xferconf_b_dtmf',xferconf_b_number='$xferconf_b_number',lead_filter_id='$lead_filter_id',alt_number_dialing='$alt_number_dialing',scheduled_callbacks='$scheduled_callbacks',safe_harbor_message='$safe_harbor_message',drop_call_seconds='$drop_call_seconds',safe_harbor_exten='$safe_harbor_exten',wrapup_seconds='$wrapup_seconds',wrapup_message='$wrapup_message',closer_campaigns='$groups_value',use_internal_dnc='$use_internal_dnc',allcalls_delay='$allcalls_delay',omit_phone_code='$omit_phone_code',dial_method='$dial_method',available_only_ratio_tally='$available_only_ratio_tally',adaptive_dropped_percentage='$adaptive_dropped_percentage',adaptive_maximum_level='$adaptive_maximum_level',adaptive_latest_server_time='$adaptive_latest_server_time',adaptive_intensity='$adaptive_intensity',adaptive_dl_diff_target='$adaptive_dl_diff_target' where campaign_id='$campaign_id';";
		$rslt=mysql_query($stmtA, $link);

		if ($reset_hopper == 'Y')
			{
			echo "<br>ZURÜCKSTELLEN DES KAMPAGNE LEITUNG ZUFUHRBEHÄLTERS\n";
			echo "<br> - Wartezeit 1 Minute, bevor folgende Nummer gewählt wird\n";
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

$ADD=31;	# go to campaign modification form below
}

######################
# ADD=42 delete campaign status in the system
######################

if ($ADD==42)
{
	echo "<FONT FACE=\"ARIAL,HELVETICA\" COLOR=BLACK SIZE=2>";

	 if ( (strlen($campaign_id) < 2) or (strlen($status) < 1) )
		{
		 echo "<br>KAMPAGNE STATUS NICHT GEÄNDERT - gehen Sie bitte zurück undbetrachten Sie die Daten, die Sie eingaben\n";
		 echo "<br>die Kampagne Kennzeichnung muß mindestens 2 Buchstaben lang sein\n";
		 echo "<br>der Kampagne Status muß mindestens Buchstaben 1 lang sein\n";
		}
	 else
		{
		echo "<br><B>KUNDENSPEZIFISCHER KAMPAGNE STATUS GELÖSCHT: $campaign_id - $status</B>\n";

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

$ADD=31;	# go to campaign modification form below
}

######################
# ADD=43 delete campaign hotkey in the system
######################

if ($ADD==43)
{
	echo "<FONT FACE=\"ARIAL,HELVETICA\" COLOR=BLACK SIZE=2>";

	 if ( (strlen($campaign_id) < 2) or (strlen($status) < 1) or (strlen($hotkey) < 1) )
		{
		 echo "<br>KAMPAGNE HOTKEY NICHT GEÄNDERT - gehen Sie bitte zurück undbetrachten Sie die Daten, die Sie eingaben\n";
		 echo "<br>die Kampagne Kennzeichnung muß mindestens 2 Buchstaben lang sein\n";
		 echo "<br>der Kampagne Status muß mindestens Buchstaben 1 lang sein\n";
		 echo "<br>das Kampagne hotkey muß mindestens Buchstaben 1 lang sein\n";
		}
	 else
		{
		echo "<br><B>KUNDENSPEZIFISCHE KAMPAGNE HOTKEY LÖSCHTE: $campaign_id - $status - $hotkey</B>\n";

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

$ADD=31;	# go to campaign modification form below
}

######################
# ADD=44 submit campaign modifications to the system - Basic View
######################

if ($ADD==44)
{
	echo "<FONT FACE=\"ARIAL,HELVETICA\" COLOR=BLACK SIZE=2>";

	 if ( (strlen($campaign_name) < 6) or (strlen($active) < 1) )
		{
		 echo "<br>KAMPAGNE NICHT GEÄNDERT - gehen Sie bitte zurück und betrachten Siedie Daten, die Sie eingaben\n";
		 echo "<br>der Kampagne Name muß mindestens 6 Buchstaben lang sein\n";
		}
	 else
		{
		echo "<br><B>KAMPAGNE ÄNDERTE: $campaign_id</B>\n";

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
		$stmtA="UPDATE vicidial_campaigns set campaign_name='$campaign_name',active='$active',dial_status_a='$dial_status_a',dial_status_b='$dial_status_b',dial_status_c='$dial_status_c',dial_status_d='$dial_status_d',dial_status_e='$dial_status_e',lead_order='$lead_order',hopper_level='$hopper_level', $adlSQL lead_filter_id='$lead_filter_id',dial_method='$dial_method',adaptive_intensity='$adaptive_intensity' where campaign_id='$campaign_id';";
		$rslt=mysql_query($stmtA, $link);

		if ($reset_hopper == 'Y')
			{
			echo "<br>ZURÜCKSTELLEN DES KAMPAGNE LEITUNG ZUFUHRBEHÄLTERS\n";
			echo "<br> - Wartezeit 1 Minute, bevor folgende Nummer gewählt wird\n";
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

$ADD=34;	# go to campaign modification form below
}

######################
# ADD=45 modify campaign lead recycle in the system
######################

if ($ADD==45)
{
	echo "<FONT FACE=\"ARIAL,HELVETICA\" COLOR=BLACK SIZE=2>";

	 if ( (strlen($campaign_id) < 2) or (strlen($status) < 1) or ($attempt_delay < 120)  or ($attempt_maximum < 1) or ($attempt_maximum > 10) )
		{
		 echo "<br>CAMPAIGN LEAD RECYCLE NOT MODIFIED - Gehen Sie bitte zurück und betrachten Sie die Daten, die Sieeingaben\n";
		 echo "<br>Status muß zwischen 1 und 6 Buchstaben lang sein\n";
		 echo "<br>Versuch verzögert muß mindestens 120 Sekunden sein\n";
		 echo "<br>maximale Versuche müssen von 1 bis 10 sein\n";
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

$ADD=31;	# go to campaign modification form below
}

######################
# ADD=411 submit list modifications to the system
######################

if ($ADD==411)
{
	echo "<FONT FACE=\"ARIAL,HELVETICA\" COLOR=BLACK SIZE=2>";

	 if ( (strlen($list_name) < 2) or (strlen($campaign_id) < 2) )
		{
		 echo "<br>LISTE NICHT GEÄNDERT - gehen Sie bitte zurück und betrachten Sie dieDaten, die Sie eingaben\n";
		 echo "<br>Liste Name muß mindestens 2 Buchstaben lang sein\n";
		}
	 else
		{
		echo "<br><B>LISTE ÄNDERTE: $list_id</B>\n";

		$stmt="UPDATE vicidial_lists set list_name='$list_name',campaign_id='$campaign_id',active='$active' where list_id='$list_id';";
		$rslt=mysql_query($stmt, $link);

		if ($reset_list == 'Y')
			{
			echo "<br>ZURÜCKSTELLEN VON VON LIST-CALLED-STATUS\n";
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
			echo "<br>ENTFERNEN DER LISTE ZUFUHRBEHÄLTER-LEITUNGEN VOM ALTEN KAMPAGNEZUFUHRBEHÄLTER ($old_campaign_id)\n";
			$stmt="DELETE from vicidial_hopper where list_id='$list_id' and campaign_id='$old_campaign_id';";
			$rslt=mysql_query($stmt, $link);
			}

		### LOG CHANGES TO LOG FILE ###
		if ($WeBRooTWritablE > 0)
			{
			$fp = fopen ("./admin_changes_log.txt", "a");
			fwrite ($fp, "$date|MODIFY LIST INFO    |$PHP_AUTH_USER|$ip|list_name='$list_name',campaign_id='$campaign_id',active='$active' where list_id='$list_id'|\n");
			fclose($fp);
			}
		}

$ADD=311;	# go to list modification form below
}


######################
# ADD=4111 modify in-group info in the system
######################

if ($ADD==4111)
{
	echo "<FONT FACE=\"ARIAL,HELVETICA\" COLOR=BLACK SIZE=2>";

	 if ( (strlen($group_name) < 2) or (strlen($group_color) < 2) )
		{
		 echo "<br>GRUPPE NICHT GEÄNDERT - gehen Sie bitte zurück und betrachten Siedie Daten, die Sie eingaben\n";
		 echo "<br>Gruppe Name und Gruppe Farbe muß mindestens 2 Buchstaben lang sein\n";
		}
	 else
		{
		echo "<br><B>GRUPPE GEÄNDERT: $group_id</B>\n";

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

$ADD=3111;	# go to in-group modification form below
}



######################
# ADD=41111 modify remote agents info in the system
######################

if ($ADD==41111)
{
	echo "<FONT FACE=\"ARIAL,HELVETICA\" COLOR=BLACK SIZE=2>";

	 if ( (strlen($server_ip) < 2) or (strlen($user_start) < 2)  or (strlen($campaign_id) < 2) or (strlen($conf_exten) < 2) )
		{
		 echo "<br>REMOTEMITTEL NICHT GEÄNDERT - gehen Sie bitte zurück und betrachtenSie die Daten, die Sie eingaben\n";
		 echo "<br>Benutzernummer Anfang und externe Verlängerung müssen mindestens 2Buchstaben lang sein\n";
		}
	 else
		{
		$stmt="UPDATE vicidial_remote_agents set user_start='$user_start', number_of_lines='$number_of_lines', server_ip='$server_ip', conf_exten='$conf_exten', status='$status', campaign_id='$campaign_id', closer_campaigns='$groups_value' where remote_agent_id='$remote_agent_id';";
		$rslt=mysql_query($stmt, $link);

		echo "<br><B>REMOTEMITTEL GEÄNDERT</B>\n";

		### LOG CHANGES TO LOG FILE ###
		if ($WeBRooTWritablE > 0)
			{
			$fp = fopen ("./admin_changes_log.txt", "a");
			fwrite ($fp, "$date|MODIFY REMOTEMITTEL ENTRY     |$PHP_AUTH_USER|$ip|set user_start='$user_start', number_of_lines='$number_of_lines', server_ip='$server_ip', conf_exten='$conf_exten', status='$status', campaign_id='$campaign_id', closer_campaigns='$groups_value' where remote_agent_id='$remote_agent_id'|\n");
			fclose($fp);
			}
		}

$ADD=31111;	# go to remote agents modification form below
}



######################
# ADD=411111 modify user group info in the system
######################

if ($ADD==411111)
{
	echo "<FONT FACE=\"ARIAL,HELVETICA\" COLOR=BLACK SIZE=2>";

	 if ( (strlen($user_group) < 2) or (strlen($group_name) < 2) )
		{
		 echo "<br>BENUTZER-GRUPPE NICHT GEÄNDERT - gehen Sie bitte zurück undbetrachten Sie die Daten, die Sie eingaben\n";
		 echo "<br>Gruppe Name und Beschreibung müssen mindestens 2 Buchstaben langsein\n";
		}
	 else
		{
		$stmt="UPDATE vicidial_user_groups set user_group='$user_group', group_name='$group_name',allowed_campaigns='$campaigns_value' where user_group='$OLDuser_group';";
		$rslt=mysql_query($stmt, $link);

		echo "<br><B>BENUTZER-GRUPPE GEÄNDERT</B>\n";

		### LOG CHANGES TO LOG FILE ###
		if ($WeBRooTWritablE > 0)
			{
			$fp = fopen ("./admin_changes_log.txt", "a");
			fwrite ($fp, "$date|MODIFY USER GROUP ENTRY     |$PHP_AUTH_USER|$ip|$stmt|\n");
			fclose($fp);
			}
		}

$ADD=311111;	# go to user group modification form below
}

######################
# ADD=4111111 modify script in the system
######################

if ($ADD==4111111)
{
	echo "<!-- $script_text -->\n";
	echo "<!--" . mysql_real_escape_string($script_text) . " -->\n";
	echo "<FONT FACE=\"ARIAL,HELVETICA\" COLOR=BLACK SIZE=2>";

	 if ( (strlen($script_id) < 2) or (strlen($script_name) < 2) or (strlen($script_text) < 2) )
		{
		 echo "<br>INDEX NICHT GEÄNDERT - Gehen Sie bitte zurück und betrachten Sie die Daten, die Sieeingaben\n";
		 echo "<br>Indexname, -beschreibung und -text müssen mindestens 2 Buchstabenlang sein\n";
		}
	 else
		{
		$stmt="UPDATE vicidial_scripts set script_name='$script_name', script_comments='$script_comments', script_text='$script_text', active='$active' where script_id='$script_id';";
		$rslt=mysql_query($stmt, $link);

		echo "<br><B>INDEX ÄNDERTE</B>\n";

		### LOG CHANGES TO LOG FILE ###
		if ($WeBRooTWritablE > 0)
			{
			$fp = fopen ("./admin_changes_log.txt", "a");
			fwrite ($fp, "$date|MODIFY SCRIPT ENTRY         |$PHP_AUTH_USER|$ip|$stmt|\n");
			fclose($fp);
			}
		}

$ADD=3111111;	# go to script modification form below
}


######################
# ADD=41111111 modify filter in the system
######################

if ($ADD==41111111)
{
	echo "<FONT FACE=\"ARIAL,HELVETICA\" COLOR=BLACK SIZE=2>";

	 if ( (strlen($lead_filter_id) < 2) or (strlen($lead_filter_name) < 2) or (strlen($lead_filter_sql) < 2) )
		{
		 echo "<br>FILTER NICHT GEÄNDERT - Gehen Sie bitte zurück und betrachten Sie die Daten, die Sieeingaben\n";
		 echo "<br>Filtern Sie Identifikation, Namen und SQL muß mindestens 2 Buchstabenlang sein\n";
		}
	 else
		{
		$stmt="UPDATE vicidial_lead_filters set lead_filter_name='$lead_filter_name', lead_filter_comments='$lead_filter_comments', lead_filter_sql='$lead_filter_sql' where lead_filter_id='$lead_filter_id';";
		$rslt=mysql_query($stmt, $link);

		echo "<br><B>FILTER GEÄNDERT</B>\n";

		### LOG CHANGES TO LOG FILE ###
		if ($WeBRooTWritablE > 0)
			{
			$fp = fopen ("./admin_changes_log.txt", "a");
			fwrite ($fp, "$date|MODIFY FILTER ENTRY         |$PHP_AUTH_USER|$ip|$stmt|\n");
			fclose($fp);
			}
		}

$ADD=31111111;	# go to filter modification form below
}


######################
# ADD=411111111 modify call time in the system
######################

if ($ADD==411111111)
{
	echo "<FONT FACE=\"ARIAL,HELVETICA\" COLOR=BLACK SIZE=2>";

	 if ( (strlen($call_time_id) < 2) or (strlen($call_time_name) < 2) )
		{
		 echo "<br>Anrufzeit nicht geändert - Gehen Sie bitte zurück und betrachten Sie die Daten, die Sieeingaben\n";
		 echo "<br>Anrufzeit ID und Name müssen mindestens 2 Zeichen Länge haben\n";
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

		echo "<br><B>Anrufzeit geändert</B>\n";

		### LOG CHANGES TO LOG FILE ###
		if ($WeBRooTWritablE > 0)
			{
			$fp = fopen ("./admin_changes_log.txt", "a");
			fwrite ($fp, "$date|MODIFY CALL TIME ENTRY      |$stmt|\n");
			fclose($fp);
			}
		}

$ADD=311111111;	# go to call time modification form below
}


######################
# ADD=4111111111 modify state call time in the system
######################

if ($ADD==4111111111)
{
	echo "<FONT FACE=\"ARIAL,HELVETICA\" COLOR=BLACK SIZE=2>";

	 if ( (strlen($call_time_id) < 2) or (strlen($call_time_name) < 2) or (strlen($state_call_time_state) < 2) )
		{
		 echo "<br>Landesspezifische Anrufzeit nicht geändert - Gehen Sie bitte zurück und betrachten Sie die Daten, die Sieeingaben\n";
		 echo "<br>Landesspezifische Anrufzeit ID, Name und Land müssen mindestens 2 Zeichen Länge haben\n";
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

		echo "<br><B>Landesspezifische Anrufzeit geändert</B>\n";

		### LOG CHANGES TO LOG FILE ###
		if ($WeBRooTWritablE > 0)
			{
			$fp = fopen ("./admin_changes_log.txt", "a");
			fwrite ($fp, "$date|MODIFY STATE CALL TIME ENTRY|$stmt|\n");
			fclose($fp);
			}
		}

$ADD=3111111111;	# go to state call time modification form below
}


######################
# ADD=41111111111 modify phone record in the system
######################

if ($ADD==41111111111)
{
	echo "<FONT FACE=\"ARIAL,HELVETICA\" COLOR=BLACK SIZE=2>";

	$stmt="SELECT count(*) from phones where extension='$extension' and server_ip='$server_ip';";
	$rslt=mysql_query($stmt, $link);
	$row=mysql_fetch_row($rslt);
	if ( ($row[0] > 0) && ( ($extension != $old_extension) or ($server_ip != $old_server_ip) ) )
		{echo "<br>TELEFON NICHT GEÄNDERT - es gibt bereits ein Telefon im System mitdiesem extension/server\n";}
	else
		{
			 if ( (strlen($extension) < 1) or (strlen($server_ip) < 7) or (strlen($dialplan_number) < 1) or (strlen($voicemail_id) < 1) or (strlen($login) < 1)  or (strlen($pass) < 1))
			{echo "<br>TELEFON NICHT GEÄNDERT - gehen Sie bitte zurück und betrachten Siedie Daten, die Sie eingaben\n";}
		 else
			{
			echo "<br>TELEFON GEÄNDERT: $extension\n";

			$stmt="UPDATE phones set extension='$extension', dialplan_number='$dialplan_number', voicemail_id='$voicemail_id', phone_ip='$phone_ip', computer_ip='$computer_ip', server_ip='$server_ip', login='$login', pass='$pass', status='$status', active='$active', phone_type='$phone_type', fullname='$fullname', company='$company', picture='$picture', protocol='$protocol', local_gmt='$local_gmt', ASTmgrUSERNAME='$ASTmgrUSERNAME', ASTmgrSECRET='$ASTmgrSECRET', login_user='$login_user', login_pass='$login_pass', login_campaign='$login_campaign', park_on_extension='$park_on_extension', conf_on_extension='$conf_on_extension', VICIDIAL_park_on_extension='$VICIDIAL_park_on_extension', VICIDIAL_park_on_filename='$VICIDIAL_park_on_filename', monitor_prefix='$monitor_prefix', recording_exten='$recording_exten', voicemail_exten='$voicemail_exten', voicemail_dump_exten='$voicemail_dump_exten', ext_context='$ext_context', dtmf_send_extension='$dtmf_send_extension', call_out_number_group='$call_out_number_group', client_browser='$client_browser', install_directory='$install_directory', local_web_callerID_URL='" . mysql_real_escape_string($local_web_callerID_URL) . "', VICIDIAL_web_URL='" . mysql_real_escape_string($VICIDIAL_web_URL) . "', AGI_call_logging_enabled='$AGI_call_logging_enabled', user_switching_enabled='$user_switching_enabled', conferencing_enabled='$conferencing_enabled', admin_hangup_enabled='$admin_hangup_enabled', admin_hijack_enabled='$admin_hijack_enabled', admin_monitor_enabled='$admin_monitor_enabled', call_parking_enabled='$call_parking_enabled', updater_check_enabled='$updater_check_enabled', AFLogging_enabled='$AFLogging_enabled', QUEUE_ACTION_enabled='$QUEUE_ACTION_enabled', CallerID_popup_enabled='$CallerID_popup_enabled', voicemail_button_enabled='$voicemail_button_enabled', enable_fast_refresh='$enable_fast_refresh', fast_refresh_rate='$fast_refresh_rate', enable_persistant_mysql='$enable_persistant_mysql', auto_dial_next_number='$auto_dial_next_number', VDstop_rec_after_each_call='$VDstop_rec_after_each_call', DBX_server='$DBX_server', DBX_database='$DBX_database', DBX_user='$DBX_user', DBX_pass='$DBX_pass', DBX_port='$DBX_port', DBY_server='$DBY_server', DBY_database='$DBY_database', DBY_user='$DBY_user', DBY_pass='$DBY_pass', DBY_port='$DBY_port', outbound_cid='$outbound_cid' where extension='$old_extension' and server_ip='$old_server_ip';";
			$rslt=mysql_query($stmt, $link);
			}
		}
$ADD=31111111111;	# go to phone modification form below
}


######################
# ADD=411111111111 modify server record in the system
######################

if ($ADD==411111111111)
{
	echo "<FONT FACE=\"ARIAL,HELVETICA\" COLOR=BLACK SIZE=2>";

	$stmt="SELECT count(*) from servers where server_id='$server_id';";
	$rslt=mysql_query($stmt, $link);
	$row=mysql_fetch_row($rslt);
	if ( ($row[0] > 0) && ($server_id != $old_server_id) )
		{echo "<br>BEDIENERNOT MODIFIED - there is already a server in the system with this server_id\n";}
	else
		{
		$stmt="SELECT count(*) from servers where server_ip='$server_ip';";
		$rslt=mysql_query($stmt, $link);
		$row=mysql_fetch_row($rslt);
		if ( ($row[0] > 0) && ($server_ip != $old_server_ip) )
			{echo "<br>BEDIENER NICHT GEÄNDERT - es gibt bereits einen Bediener im Systemmit diesem server_ip\n";}
		else
			{
			 if ( (strlen($server_id) < 1) or (strlen($server_ip) < 7) )
				{echo "<br>BEDIENER NICHT GEÄNDERT - gehen Sie bitte zurück und betrachten Siedie Daten, die Sie eingaben\n";}
			 else
				{
				echo "<br>BEDIENER GEÄNDERT: $server_ip\n";

				$stmt="UPDATE servers set server_id='$server_id',server_description='$server_description',server_ip='$server_ip',active='$active',asterisk_version='$asterisk_version', max_vicidial_trunks='$max_vicidial_trunks', telnet_host='$telnet_host', telnet_port='$telnet_port', ASTmgrUSERNAME='$ASTmgrUSERNAME', ASTmgrSECRET='$ASTmgrSECRET', ASTmgrUSERNAMEupdate='$ASTmgrUSERNAMEupdate', ASTmgrUSERNAMElisten='$ASTmgrUSERNAMElisten', ASTmgrUSERNAMEsend='$ASTmgrUSERNAMEsend', local_gmt='$local_gmt', voicemail_dump_exten='$voicemail_dump_exten', answer_transfer_agent='$answer_transfer_agent', ext_context='$ext_context', sys_perf_log='$sys_perf_log', vd_server_logs='$vd_server_logs', agi_output='$agi_output', vicidial_balance_active='$vicidial_balance_active', balance_trunks_offlimits='$balance_trunks_offlimits' where server_id='$old_server_id';";
				$rslt=mysql_query($stmt, $link);
				}
			}
		}
$ADD=311111111111;	# go to server modification form below
}


######################
# ADD=421111111111 modify vicidial server trunks record in the system
######################

if ($ADD==421111111111)
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
		echo "<br>VICIDIAL BEDIENER-STAMM-SATZ NICHT ADDIERT - die Zahl vicidial Stämmen ist zu hoch: $SUMvicidial_trunks / $MAXvicidial_trunks\n";
		}
	else
		{
		 if ( (strlen($campaign_id) < 2) or (strlen($server_ip) < 7) or (strlen($dedicated_trunks) < 1) or (strlen($trunk_restriction) < 1) )
			{
			 echo "<br>VICIDIAL BEDIENER-STAMM-SATZ NICHT GEÄNDERT - Gehen Sie bitte zurück und betrachten Sie die Daten, die Sieeingaben\n";
			 echo "<br>Kampagne muß zwischen 3 und 8 Buchstaben lang sein\n";
			 echo "<br>server_ip verzögert muß mindestens 7 Buchstaben sein\n";
			 echo "<br>Stämme müssen eine Stelle von 0 bis 9999 sein\n";
			}
		 else
			{
			echo "<br><B>VICIDIAL BEDIENER-STAMM-SATZ ÄNDERTE: $campaign_id - $server_ip - $dedicated_trunks - $trunk_restriction</B>\n";

			$stmt="UPDATE vicidial_server_trunks SET dedicated_trunks='$dedicated_trunks',trunk_restriction='$trunk_restriction' where campaign_id='$campaign_id' and server_ip='$server_ip';";
			$rslt=mysql_query($stmt, $link);

			### LOG CHANGES TO LOG FILE ###
			if ($WeBRooTWritablE > 0)
				{
				$fp = fopen ("./admin_changes_log.txt", "a");
				fwrite ($fp, "$date|ÄNDERN SIE BEDIENER TRUNK   |$PHP_AUTH_USER|$ip|$stmt|\n");
				fclose($fp);
				}
			}
		}
$ADD=311111111111;	# go to server modification form below
}


######################
# ADD=4111111111111 modify conference record in the system
######################

if ($ADD==4111111111111)
{
	echo "<FONT FACE=\"ARIAL,HELVETICA\" COLOR=BLACK SIZE=2>";

	$stmt="SELECT count(*) from conferences where conf_exten='$conf_exten' and server_ip='$server_ip';";
	$rslt=mysql_query($stmt, $link);
	$row=mysql_fetch_row($rslt);
	if ( ($row[0] > 0) && ( ($conf_exten != $old_conf_exten) or ($server_ip != $old_server_ip) ) )
		{echo "<br>KONFERENZ NICHT GEÄNDERT - es gibt bereits eine Konferenz im Systemmit diesem Verlängerung-Bediener\n";}
	else
		{
		 if ( (strlen($conf_exten) < 1) or (strlen($server_ip) < 7) )
			{echo "<br>KONFERENZ NICHT GEÄNDERT - gehen Sie bitte zurück und betrachten Siedie Daten, die Sie eingaben\n";}
		 else
			{
			echo "<br>KONFERENZ ÄNDERTE: $conf_exten\n";

			$stmt="UPDATE conferences set conf_exten='$conf_exten',server_ip='$server_ip',extension='$extension' where conf_exten='$old_conf_exten';";
			$rslt=mysql_query($stmt, $link);
			}
		}
$ADD=3111111111111;	# go to conference modification form below
}


######################
# ADD=41111111111111 modify vicidial conference record in the system
######################

if ($ADD==41111111111111)
{
	echo "<FONT FACE=\"ARIAL,HELVETICA\" COLOR=BLACK SIZE=2>";

	$stmt="SELECT count(*) from vicidial_conferences where conf_exten='$conf_exten' and server_ip='$server_ip';";
	$rslt=mysql_query($stmt, $link);
	$row=mysql_fetch_row($rslt);
	if ( ($row[0] > 0) && ( ($conf_exten != $old_conf_exten) or ($server_ip != $old_server_ip) ) )
		{echo "<br>VICIDIAL KONFERENZ NICHT GEÄNDERT - es gibt bereits eine Konferenz im Systemmit diesem Verlängerung-Bediener\n";}
	else
		{
		 if ( (strlen($conf_exten) < 1) or (strlen($server_ip) < 7) )
			{echo "<br>VICIDIAL KONFERENZ NICHT GEÄNDERT - gehen Sie bitte zurück und betrachten Siedie Daten, die Sie eingaben\n";}
		 else
			{
			echo "<br>VICIDIAL KONFERENZ ÄNDERTE: $conf_exten\n";

			$stmt="UPDATE vicidial_conferences set conf_exten='$conf_exten',server_ip='$server_ip',extension='$extension' where conf_exten='$old_conf_exten';";
			$rslt=mysql_query($stmt, $link);
			}
		}
$ADD=31111111111111;	# go to vicidial conference modification form below
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
		 echo "<br>BENUTZER NICHT GELÖSCHT - Gehen Sie bitte zurück und betrachten Sie die Daten, die Sieeingaben\n";
		 echo "<br>User be at least 2 characters in length\n";
		}
	 else
		{
		echo "<br><B>BENUTZER-AUSLASSUNG BESTÄTIGUNG: $user</B>\n";
		echo "<br><br><a href=\"$PHP_SELF?ADD=6&user=$user&CoNfIrM=YES\">Klicken Sie hier, um Benutzer zu löschen $user</a><br><br><br>\n";
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
		 echo "<br>KAMPAGNE NICHT GELÖSCHT - Gehen Sie bitte zurück und betrachten Sie die Daten, die Sieeingaben\n";
		 echo "<br>Kampagne_id be at least 2 characters in length\n";
		}
	 else
		{
		echo "<br><B>KAMPAGNE AUSLASSUNG BESTÄTIGUNG: $campaign_id</B>\n";
		echo "<br><br><a href=\"$PHP_SELF?ADD=61&campaign_id=$campaign_id&CoNfIrM=YES\">Klicken Sie hier, um Kampagne zu löschen $campaign_id</a><br><br><br>\n";
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
		 echo "<br>MITTEL GELOGGT NICHT AUS KAMPAGNE HERAUS - Gehen Sie bitte zurück und betrachten Sie die Daten, die Sieeingaben\n";
		 echo "<br>Kampagne_id be at least 2 characters in length\n";
		}
	 else
		{
		echo "<br><B>MITTELLOGOUT-BESTÄTIGUNG: $campaign_id</B>\n";
		echo "<br><br><a href=\"$PHP_SELF?ADD=62&campaign_id=$campaign_id&CoNfIrM=YES\">Klicken Sie hier, um alle Mittel aus zu loggen $campaign_id</a><br><br><br>\n";
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
		 echo "<br>VDAC NICHT LÖSCHTE FÜR KAMPAGNE - Gehen Sie bitte zurück und betrachten Sie die Daten, die Sieeingaben\n";
		 echo "<br>Kampagne_id be at least 2 characters in length\n";
		}
	 else
		{
		echo "<br><B>VDAC AUSLÖSEBESTÄTIGUNG: $campaign_id</B>\n";
		echo "<br><br><a href=\"$PHP_SELF?ADD=63&campaign_id=$campaign_id&CoNfIrM=YES&&stage=$stage\">Klicken Sie hier, um das älteste zu löschen LEBEN Aufzeichnung inVDAC für $campaign_id</a><br><br><br>\n";
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
		 echo "<br>LISTE NICHT GELÖSCHT WORDEN - Gehen Sie bitte zurück und betrachten Sie die Daten, die Sieeingaben\n";
		 echo "<br>List_id be at least 2 characters in length\n";
		}
	 else
		{
		echo "<br><B>LISTE AUSLASSUNG BESTÄTIGUNG: $list_id</B>\n";
		echo "<br><br><a href=\"$PHP_SELF?ADD=611&list_id=$list_id&CoNfIrM=YES\">Klicken Sie hier, um Liste und alle seine Leitungen zu löschen $list_id</a><br><br><br>\n";
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
		 echo "<br>IN-GROUP NICHT GELÖSCHT - Gehen Sie bitte zurück und betrachten Sie die Daten, die Sieeingaben\n";
		 echo "<br>Group_id be at least 2 characters in length\n";
		}
	 else
		{
		echo "<br><B>IN-GROUP AUSLASSUNG BESTÄTIGUNG: $group_id</B>\n";
		echo "<br><br><a href=\"$PHP_SELF?ADD=6111&group_id=$group_id&CoNfIrM=YES\">Klicken Sie hier, um Ingruppe zu löschen $group_id</a><br><br><br>\n";
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
		 echo "<br>REMOTEMITTEL NICHT GELÖSCHT - Gehen Sie bitte zurück und betrachten Sie die Daten, die Sieeingaben\n";
		 echo "<br>Remote_agent_id be at least 2 characters in length\n";
		}
	 else
		{
		echo "<br><B>REMOTEMITTEL-AUSLASSUNG BESTÄTIGUNG: $remote_agent_id</B>\n";
		echo "<br><br><a href=\"$PHP_SELF?ADD=61111&remote_agent_id=$remote_agent_id&CoNfIrM=YES\">Klicken Sie hier, um Remotemittel zu löschen $remote_agent_id</a><br><br><br>\n";
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
		 echo "<br>BENUTZER-GRUPPE NICHT GELÖSCHT - Gehen Sie bitte zurück und betrachten Sie die Daten, die Sieeingaben\n";
		 echo "<br>User_group be at least 2 characters in length\n";
		}
	 else
		{
		echo "<br><B>BENUTZER-GRUPPE AUSLASSUNG BESTÄTIGUNG: $user_group</B>\n";
		echo "<br><br><a href=\"$PHP_SELF?ADD=611111&user_group=$user_group&CoNfIrM=YES\">Klicken Sie hier, um Benutzergruppe zu löschen $user_group</a><br><br><br>\n";
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
		 echo "<br>INDEX NICHT GELÖSCHT - Gehen Sie bitte zurück und betrachten Sie die Daten, die Sieeingaben\n";
		 echo "<br>Script_id must be at least 2 characters in length\n";
		}
	 else
		{
		echo "<br><B>INDEX-AUSLASSUNG BESTÄTIGUNG: $script_id</B>\n";
		echo "<br><br><a href=\"$PHP_SELF?ADD=6111111&script_id=$script_id&CoNfIrM=YES\">Klicken Sie hier, um Index zu löschen $script_id</a><br><br><br>\n";
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
		 echo "<br>FILTER NICHT GELÖSCHT - Gehen Sie bitte zurück und betrachten Sie die Daten, die Sieeingaben\n";
		 echo "<br>Filter Identifikation muß mindestens 2 Buchstaben lang sein\n";
		}
	 else
		{
		echo "<br><B>FILTER DELETION CONFIRMATION: $lead_filter_id</B>\n";
		echo "<br><br><a href=\"$PHP_SELF?ADD=61111111&lead_filter_id=$lead_filter_id&CoNfIrM=YES\">Klicken Sie hier, um Filter zu löschen$lead_filter_id</a><br><br><br>\n";
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
		 echo "<br>Anrufzeit nicht gelöscht - Gehen Sie bitte zurück und betrachten Sie die Daten, die Sieeingaben\n";
		 echo "<br>Anrufzeit ID muss mindestens 2 Zeichen lang sein\n";
		}
	 else
		{
		echo "<br><B>Löschen der Anrufzeit bestätigen: $call_time_id</B>\n";
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
		 echo "<br>Landesspezifische Anrufzeit nicht gelöscht - Gehen Sie bitte zurück und betrachten Sie die Daten, die Sieeingaben\n";
		 echo "<br>Anrufzeit ID muss mindestens 2 Zeichen lang sein\n";
		}
	 else
		{
		echo "<br><B>Löschen der landesspezifischen Anrufzeit bestätigen: $call_time_id</B>\n";
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
		 echo "<br>TELEFON NICHT GELÖSCHT - Gehen Sie bitte zurück und betrachten Sie die Daten, die Sieeingaben\n";
		 echo "<br>Extension be at least 2 characters in length\n";
		 echo "<br>Bediener IP be at least 7 characters in length\n";
		}
	 else
		{
		echo "<br><B>TELEFON-AUSLASSUNG BESTÄTIGUNG: $extension - $server_ip</B>\n";
		echo "<br><br><a href=\"$PHP_SELF?ADD=61111111111&extension=$extension&server_ip=$server_ip&CoNfIrM=YES\">Klicken Sie hier, um Telefon zu löschen $extension - $server_ip</a><br><br><br>\n";
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
		 echo "<br>BEDIENERNOT DELETED - Gehen Sie bitte zurück und betrachten Sie die Daten, die Sieeingaben\n";
		 echo "<br>Bediener Identifikation be at least 2 characters in length\n";
		 echo "<br>Bediener IP be at least 7 characters in length\n";
		}
	 else
		{
		echo "<br><B>BEDIENERDELETION CONFIRMATION: $server_id - $server_ip</B>\n";
		echo "<br><br><a href=\"$PHP_SELF?ADD=611111111111&server_id=$server_id&server_ip=$server_ip&CoNfIrM=YES\">Klicken Sie hier, um Telefon zu löschen $server_id - $server_ip</a><br><br><br>\n";
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
		 echo "<br>CONFERENCE NOT DELETED - Gehen Sie bitte zurück und betrachten Sie die Daten, die Sieeingaben\n";
		 echo "<br>Conference must be at least 2 characters in length\n";
		 echo "<br>Bediener IP be at least 7 characters in length\n";
		}
	 else
		{
		echo "<br><B>CONFERENCE DELETION CONFIRMATION: $conf_exten - $server_ip</B>\n";
		echo "<br><br><a href=\"$PHP_SELF?ADD=6111111111111&conf_exten=$conf_exten&server_ip=$server_ip&CoNfIrM=YES\">Klicken Sie hier, um Telefon zu löschen $conf_exten - $server_ip</a><br><br><br>\n";
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
		 echo "<br>VICIDIAL CONFERENCE NOT DELETED - Gehen Sie bitte zurück und betrachten Sie die Daten, die Sieeingaben\n";
		 echo "<br>Conference must be at least 2 characters in length\n";
		 echo "<br>Bediener IP be at least 7 characters in length\n";
		}
	 else
		{
		echo "<br><B>VICIDIAL CONFERENCE DELETION CONFIRMATION: $conf_exten - $server_ip</B>\n";
		echo "<br><br><a href=\"$PHP_SELF?ADD=61111111111111&conf_exten=$conf_exten&server_ip=$server_ip&CoNfIrM=YES\">Klicken Sie hier, um Telefon zu löschen $conf_exten - $server_ip</a><br><br><br>\n";
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
		 echo "<br>BENUTZER NICHT GELÖSCHT - Gehen Sie bitte zurück und betrachten Sie die Daten, die Sieeingaben\n";
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
		echo "<br><B>BENUTZER-AUSLASSUNG FÜHRTE DURCH: $user</B>\n";
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
		 echo "<br>KAMPAGNE NICHT GELÖSCHT - Gehen Sie bitte zurück und betrachten Sie die Daten, die Sieeingaben\n";
		 echo "<br>Kampagne_id be at least 2 characters in length\n";
		}
	 else
		{
		$stmt="DELETE from vicidial_campaigns where campaign_id='$campaign_id' limit 1;";
		$rslt=mysql_query($stmt, $link);

		echo "<br>ENTFERNEN DER LISTE ZUFUHRBEHÄLTER-LEITUNGEN VOM ALTEN KAMPAGNEZUFUHRBEHÄLTER ($campaign_id)\n";
		$stmt="DELETE from vicidial_hopper where campaign_id='$campaign_id';";
		$rslt=mysql_query($stmt, $link);

		### LOG CHANGES TO LOG FILE ###
		if ($WeBRooTWritablE > 0)
			{
			$fp = fopen ("./admin_changes_log.txt", "a");
			fwrite ($fp, "$date|!!DELETING CAMPAIGN!|$PHP_AUTH_USER|$ip|campaign_id='$campaign_id'|\n");
			fclose($fp);
			}
		echo "<br><B>KAMPAGNE AUSLASSUNG FÜHRTE DURCH: $campaign_id</B>\n";
		echo "<br><br>\n";
		}

$ADD='10';		# go to campaigns list
}

######################
# ADD=62 Logout all agents from a campaign
######################

if ($ADD==62)
{
	echo "<FONT FACE=\"ARIAL,HELVETICA\" COLOR=BLACK SIZE=2>";

	 if (strlen($campaign_id) < 2)
		{
		 echo "<br>MITTEL GELOGGT NICHT AUS KAMPAGNE HERAUS - Gehen Sie bitte zurück und betrachten Sie die Daten, die Sieeingaben\n";
		 echo "<br>Kampagne_id be at least 2 characters in length\n";
		}
	 else
		{
		$stmt="DELETE from vicidial_live_agents where campaign_id='$campaign_id';";
		$rslt=mysql_query($stmt, $link);

		### LOG CHANGES TO LOG FILE ###
		if ($WeBRooTWritablE > 0)
			{
			$fp = fopen ("./admin_changes_log.txt", "a");
			fwrite ($fp, "$date|!!MITTELLOGOUT!!!!!!|$PHP_AUTH_USER|$ip|campaign_id='$campaign_id'|\n");
			fclose($fp);
			}
		echo "<br><B>MITTELLOGOUT FÜHRTE DURCH: $campaign_id</B>\n";
		echo "<br><br>\n";
		}

$ADD='31';		# go to campaign modification below
}


######################
# ADD=63 Emergency VDAC Jam Clear
######################

if ($ADD==63)
{
	if (eregi('IN',$stage))
		{$group_id=$campaign_id;}
	echo "<FONT FACE=\"ARIAL,HELVETICA\" COLOR=BLACK SIZE=2>";

	 if (strlen($campaign_id) < 2)
		{
		 echo "<br>VDAC NICHT LÖSCHTE FÜR KAMPAGNE - Gehen Sie bitte zurück und betrachten Sie die Daten, die Sieeingaben\n";
		 echo "<br>Kampagne_id be at least 2 characters in length\n";
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
		echo "<br><B>LETZTES VDAC SATZ GELÖSCHT FÜR KAMPAGNE: $campaign_id</B>\n";
		echo "<br><br>\n";
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
	echo "<FONT FACE=\"ARIAL,HELVETICA\" COLOR=BLACK SIZE=2>";

	 if ( (strlen($campaign_id) < 2) or (strlen($status) < 1) )
		{
		 echo "<br>KAMPAGNE LEITUNG BEREITEN NICHT GELÖSCHT AUF - Gehen Sie bitte zurück und betrachten Sie die Daten, die Sieeingaben\n";
		 echo "<br>Status muß zwischen 1 und 6 Buchstaben lang sein\n";
		 echo "<br>Versuch verzögert muß mindestens 120 Sekunden sein\n";
		 echo "<br>maximale Versuche müssen von 1 bis 10 sein\n";
		}
	 else
		{
		echo "<br><B>KAMPAGNE LEITUNG BEREITEN GELÖSCHT AUF: $campaign_id - $status - $attempt_delay</B>\n";

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
		 echo "<br>LISTE NICHT GELÖSCHT WORDEN - Gehen Sie bitte zurück und betrachten Sie die Daten, die Sieeingaben\n";
		 echo "<br>List_id be at least 2 characters in length\n";
		}
	 else
		{
		$stmt="DELETE from vicidial_lists where list_id='$list_id' limit 1;";
		$rslt=mysql_query($stmt, $link);

		echo "<br>ENTFERNEN DER LISTE ZUFUHRBEHÄLTER-LEITUNGEN VOM ALTEN KAMPAGNEZUFUHRBEHÄLTER ($list_id)\n";
		$stmt="DELETE from vicidial_hopper where list_id='$list_id';";
		$rslt=mysql_query($stmt, $link);

		echo "<br>ENTFERNEN DER LISTE LEITUNGEN VON DER VICIDIAL_LIST TABELLE\n";
		$stmt="DELETE from vicidial_list where list_id='$list_id';";
		$rslt=mysql_query($stmt, $link);

		### LOG CHANGES TO LOG FILE ###
		if ($WeBRooTWritablE > 0)
			{
			$fp = fopen ("./admin_changes_log.txt", "a");
			fwrite ($fp, "$date|!!!DELETING LIST!!!!|$PHP_AUTH_USER|$ip|list_id='$list_id'|\n");
			fclose($fp);
			}
		echo "<br><B>LISTE AUSLASSUNG DURCHGEFÜHRT: $list_id</B>\n";
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
		 echo "<br>IN-GROUP NICHT GELÖSCHT - Gehen Sie bitte zurück und betrachten Sie die Daten, die Sieeingaben\n";
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
		echo "<br><B>IN-GROUP AUSLASSUNG FÜHRTE DURCH: $group_id</B>\n";
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
		 echo "<br>REMOTEMITTEL NICHT GELÖSCHT - Gehen Sie bitte zurück und betrachten Sie die Daten, die Sieeingaben\n";
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
		echo "<br><B>REMOTEMITTEL-AUSLASSUNG FÜHRTE DURCH: $remote_agent_id</B>\n";
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
		 echo "<br>BENUTZER-GRUPPE NICHT GELÖSCHT - Gehen Sie bitte zurück und betrachten Sie die Daten, die Sieeingaben\n";
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
		echo "<br><B>BENUTZER-GRUPPE AUSLASSUNG DURCHGEFÜHRT: $user_group</B>\n";
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
		 echo "<br>INDEX NICHT GELÖSCHT - Gehen Sie bitte zurück und betrachten Sie die Daten, die Sieeingaben\n";
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
		echo "<br><B>INDEX-AUSLASSUNG FÜHRTE DURCH: $script_id</B>\n";
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
		 echo "<br>FILTER NICHT GELÖSCHT - Gehen Sie bitte zurück und betrachten Sie die Daten, die Sieeingaben\n";
		 echo "<br>Filter Identifikation muß mindestens 2 Buchstaben lang sein\n";
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
		echo "<br><B>FILTER-AUSLASSUNG DURCHGEFÜHRT: $lead_filter_id</B>\n";
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
		 echo "<br>Anrufzeit nicht gelöscht - Gehen Sie bitte zurück und betrachten Sie die Daten, die Sieeingaben\n";
		 echo "<br>Anrufzeit ID muss mindestens 2 Zeichen lang sein\n";
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
		echo "<br><B>Löschen der Anrufzeiten beendet: $call_time_id</B>\n";
		echo "<br><br>\n";
		}

$ADD='100000000';		# go to call times list
}


######################
# ADD=6111111111 delete call times record
######################

if ($ADD==6111111111)
{
	echo "<FONT FACE=\"ARIAL,HELVETICA\" COLOR=BLACK SIZE=2>";

	 if ( (strlen($call_time_id) < 2) or ($LOGdelete_call_times < 1) )
		{
		 echo "<br>Landesspezifische Anrufzeit nicht gelöscht - Gehen Sie bitte zurück und betrachten Sie die Daten, die Sieeingaben\n";
		 echo "<br>Anrufzeit ID muss mindestens 2 Zeichen lang sein\n";
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
			echo "Landesrichlinie gelöscht: $sct_ids[$o]<BR>\n";
			$o++;
		}

		### LOG CHANGES TO LOG FILE ###
		if ($WeBRooTWritablE > 0)
			{
			$fp = fopen ("./admin_changes_log.txt", "a");
			fwrite ($fp, "$date|!DELETING CALL TIME!|$PHP_AUTH_USER|$ip|state_call_time_id='$call_time_id'|\n");
			fclose($fp);
			}
		echo "<br><B>Löschen der landesspezifischen Anrufzeit beendet: $call_time_id</B>\n";
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
		 echo "<br>TELEFON NICHT GELÖSCHT - Gehen Sie bitte zurück und betrachten Sie die Daten, die Sieeingaben\n";
		 echo "<br>Extension be at least 2 characters in length\n";
		 echo "<br>Bediener IP be at least 7 characters in length\n";
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
		echo "<br><B>TELEFON-AUSLASSUNG DURCHGEFÜHRT: $extension - $server_ip</B>\n";
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
		 echo "<br>BEDIENERNOT DELETED - Gehen Sie bitte zurück und betrachten Sie die Daten, die Sieeingaben\n";
		 echo "<br>Bediener Identifikation be at least 2 characters in length\n";
		 echo "<br>Bediener IP be at least 7 characters in length\n";
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
		echo "<br><B>BEDIENERDELETION COMPLETED: $server_id - $server_ip</B>\n";
		echo "<br><br>\n";
		}
$ADD='100000000000';		# go to server list
}


######################
# ADD=621111111111 delete vicidial server trunk record in the system
######################

if ($ADD==621111111111)
{
	echo "<FONT FACE=\"ARIAL,HELVETICA\" COLOR=BLACK SIZE=2>";

	 if ( (strlen($campaign_id) < 2) or (strlen($server_ip) < 7) )
		{
		 echo "<br>VICIDIAL BEDIENER-STAMM-SATZ NICHT GELÖSCHT - Gehen Sie bitte zurück und betrachten Sie die Daten, die Sieeingaben\n";
		 echo "<br>Kampagne muß zwischen 3 und 8 Buchstaben lang sein\n";
		 echo "<br>server_ip verzögert muß mindestens 7 Buchstaben sein\n";
		}
	 else
		{
		echo "<br><B>VICIDIAL BEDIENER-STAMM-SATZ GELÖSCHT: $campaign_id - $server_ip</B>\n";

		$stmt="DELETE FROM vicidial_server_trunks where campaign_id='$campaign_id' and server_ip='$server_ip';";
		$rslt=mysql_query($stmt, $link);

		### LOG CHANGES TO LOG FILE ###
		if ($WeBRooTWritablE > 0)
			{
			$fp = fopen ("./admin_changes_log.txt", "a");
			fwrite ($fp, "$date|DELETE BEDIENERTRUNK   |$PHP_AUTH_USER|$ip|$stmt|\n");
			fclose($fp);
			}
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
		 echo "<br>CONFERENCE NOT DELETED - Gehen Sie bitte zurück und betrachten Sie die Daten, die Sieeingaben\n";
		 echo "<br>Conference be at least 2 characters in length\n";
		 echo "<br>Bediener IP be at least 7 characters in length\n";
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
		 echo "<br>VICIDIAL CONFERENCE NOT DELETED - Gehen Sie bitte zurück und betrachten Sie die Daten, die Sieeingaben\n";
		 echo "<br>Conference be at least 2 characters in length\n";
		 echo "<br>Bediener IP be at least 7 characters in length\n";
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

if ( ($user_level >= $LOGuser_level) and ($LOGuser_level < 9) )
	{
	echo "<br>Sie haben nicht Erlaubnis, diesen Benutzer zu ändern: $row[1]\n";
	}
else
	{
	echo "<br>ÄNDERN Sie Einen BENUTZER-SATZ: $row[1]<form action=$PHP_SELF method=POST>\n";
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
	echo "<center><TABLE width=600 cellspacing=3>\n";
	echo "<tr bgcolor=#B6D3FC><td align=right>Benutzer-Zahl: </td><td align=left><b>$row[1]</b>$NWB#vicidial_users-user$NWE</td></tr>\n";
	echo "<tr bgcolor=#B6D3FC><td align=right>Kennwort:</td><td align=left><input type=text name=pass size=20 maxlength=10 value=\"$row[2]\">$NWB#vicidial_users-pass$NWE</td></tr>\n";
	echo "<tr bgcolor=#B6D3FC><td align=right>Voller Name: </td><td align=left><input type=text name=full_name size=30 maxlength=30 value=\"$row[3]\">$NWB#vicidial_users-full_name$NWE</td></tr>\n";
	echo "<tr bgcolor=#B6D3FC><td align=right>Benutzer-Niveau: </td><td align=left><select size=1 name=user_level>";
	$h=1;
	while ($h<=$LOGuser_level)
		{
		echo "<option>$h</option>";
		$h++;
		}
	echo "<option SELECTED>$row[4]</option></select>$NWB#vicidial_users-user_level$NWE</td></tr>\n";
	echo "<tr bgcolor=#B6D3FC><td align=right>Benutzer-Gruppe: </td><td align=left><select size=1 name=user_group>\n";

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
	echo "<tr bgcolor=#B6D3FC><td align=right>Telefon-LOGON: </td><td align=left><input type=text name=phone_login size=20 maxlength=20 value=\"$phone_login\">$NWB#vicidial_users-phone_login$NWE</td></tr>\n";
	echo "<tr bgcolor=#B6D3FC><td align=right>Telefon-Durchlauf: </td><td align=left><input type=text name=phone_pass size=20 maxlength=20 value=\"$phone_pass\">$NWB#vicidial_users-phone_pass$NWE</td></tr>\n";

	if ( ($LOGuser_level > 8) or ($LOGalter_agent_interface == "1") )
		{
		echo "<tr bgcolor=BLACK><td colspan=2 align=center><font color=white><B>MITTEL-SCHNITTSTELLE WAHLEN:</td></tr>\n";
		echo "<tr bgcolor=#B6D3FC><td align=right>Mittel Wählen Ingroups: </td><td align=left><select size=1 name=agent_choose_ingroups><option>0</option><option>1</option><option SELECTED>$agent_choose_ingroups</option></select>$NWB#vicidial_users-agent_choose_ingroups$NWE</td></tr>\n";
		echo "<tr bgcolor=#B6D3FC><td align=right>HotKeys Aktiv: </td><td align=left><select size=1 name=hotkeys_active><option>0</option><option>1</option><option SELECTED>$hotkeys_active</option></select>$NWB#vicidial_users-hotkeys_active$NWE</td></tr>\n";
		echo "<tr bgcolor=#B6D3FC><td align=right>Zeitlich geplante Wiederholungsbesuche: </td><td align=left><select size=1 name=scheduled_callbacks><option>0</option><option>1</option><option SELECTED>$scheduled_callbacks</option></select>$NWB#vicidial_users-scheduled_callbacks$NWE</td></tr>\n";
		echo "<tr bgcolor=#B6D3FC><td align=right>Mittel-Nur Wiederholungsbesuche: </td><td align=left><select size=1 name=agentonly_callbacks><option>0</option><option>1</option><option SELECTED>$agentonly_callbacks</option></select>$NWB#vicidial_users-agentonly_callbacks$NWE</td></tr>\n";
		echo "<tr bgcolor=#B6D3FC><td align=right>Vertreter-Anruf-Handbuch: </td><td align=left><select size=1 name=agentcall_manual><option>0</option><option>1</option><option SELECTED>$agentcall_manual</option></select>$NWB#vicidial_users-agentcall_manual$NWE</td></tr>\n";
		echo "<tr bgcolor=#B6D3FC><td align=right>Vicidial Aufnahme: </td><td align=left><select size=1 name=vicidial_recording><option>0</option><option>1</option><option SELECTED>$vicidial_recording</option></select>$NWB#vicidial_users-vicidial_recording$NWE</td></tr>\n";
		echo "<tr bgcolor=#B6D3FC><td align=right>Vicidial Übertragungen: </td><td align=left><select size=1 name=vicidial_transfers><option>0</option><option>1</option><option SELECTED>$vicidial_transfers</option></select>$NWB#vicidial_users-vicidial_transfers$NWE</td></tr>\n";
		echo "<tr bgcolor=#B6D3FC><td align=right>Genauere Rückstellung Gemischt: </td><td align=left><select size=1 name=closer_default_blended><option>0</option><option>1</option><option SELECTED>$closer_default_blended</option></select>$NWB#vicidial_users-closer_default_blended$NWE</td></tr>\n";
		echo "<tr bgcolor=#B6D3FC><td align=right>Inbound Gruppen: </td><td align=left>\n";
		echo "$groups_list";
		echo "$NWB#vicidial_users-closer_campaigns$NWE</td></tr>\n";
		}
	if ($LOGuser_level > 8)
		{
		echo "<tr bgcolor=BLACK><td colspan=2 align=center><font color=white><B>ADMIN SCHNITTSTELLE WAHLEN:</td></tr>\n";
		echo "<tr bgcolor=#B6D3FC><td align=right>Ändern Sie Mittel-Schnittstelle Wahlen:</td><td align=left><select size=1 name=alter_agent_interface_options><option>0</option><option>1</option><option SELECTED>$alter_agent_interface_options</option></select>$NWB#vicidial_users-alter_agent_interface_options$NWE</td></tr>\n";
		echo "<tr bgcolor=#B6D3FC><td align=right>Löschung-Benutzer: </td><td align=left><select size=1 name=delete_users><option>0</option><option>1</option><option SELECTED>$delete_users</option></select>$NWB#vicidial_users-delete_users$NWE</td></tr>\n";
		echo "<tr bgcolor=#B6D3FC><td align=right>Löschung-Benutzer-Gruppen: </td><td align=left><select size=1 name=delete_user_groups><option>0</option><option>1</option><option SELECTED>$delete_user_groups</option></select>$NWB#vicidial_users-delete_user_groups$NWE</td></tr>\n";
		echo "<tr bgcolor=#B6D3FC><td align=right>Löschung-Listen: </td><td align=left><select size=1 name=delete_lists><option>0</option><option>1</option><option SELECTED>$delete_lists</option></select>$NWB#vicidial_users-delete_lists$NWE</td></tr>\n";
		echo "<tr bgcolor=#B6D3FC><td align=right>Löschung-Kampagnen: </td><td align=left><select size=1 name=delete_campaigns><option>0</option><option>1</option><option SELECTED>$delete_campaigns</option></select>$NWB#vicidial_users-delete_campaigns$NWE</td></tr>\n";
		echo "<tr bgcolor=#B6D3FC><td align=right>Löschung In-Gruppen: </td><td align=left><select size=1 name=delete_ingroups><option>0</option><option>1</option><option SELECTED>$delete_ingroups</option></select>$NWB#vicidial_users-delete_ingroups$NWE</td></tr>\n";
		echo "<tr bgcolor=#B6D3FC><td align=right>Löschung-Direktübertragung Mittel: </td><td align=left><select size=1 name=delete_remote_agents><option>0</option><option>1</option><option SELECTED>$delete_remote_agents</option></select>$NWB#vicidial_users-delete_remote_agents$NWE</td></tr>\n";
		echo "<tr bgcolor=#B6D3FC><td align=right>Löschung-Indexs: </td><td align=left><select size=1 name=delete_scripts><option>0</option><option>1</option><option SELECTED>$delete_scripts</option></select>$NWB#vicidial_users-delete_scripts$NWE</td></tr>\n";
		echo "<tr bgcolor=#B6D3FC><td align=right>Last Leitungen: </td><td align=left><select size=1 name=load_leads><option>0</option><option>1</option><option SELECTED>$load_leads</option></select>$NWB#vicidial_users-load_leads$NWE</td></tr>\n";
		echo "<tr bgcolor=#B6D3FC><td align=right>Kampagne Detail: </td><td align=left><select size=1 name=campaign_detail><option>0</option><option>1</option><option SELECTED>$campaign_detail</option></select>$NWB#vicidial_users-campaign_detail$NWE</td></tr>\n";
		echo "<tr bgcolor=#B6D3FC><td align=right>AGC Admin Zugang: </td><td align=left><select size=1 name=ast_admin_access><option>0</option><option>1</option><option SELECTED>$ast_admin_access</option></select>$NWB#vicidial_users-ast_admin_access$NWE</td></tr>\n";
		echo "<tr bgcolor=#B6D3FC><td align=right>AGC Löschung-Telefone: </td><td align=left><select size=1 name=ast_delete_phones><option>0</option><option>1</option><option SELECTED>$ast_delete_phones</option></select>$NWB#vicidial_users-ast_delete_phones$NWE</td></tr>\n";
		echo "<tr bgcolor=#B6D3FC><td align=right>Ändern Sie Leitungen: </td><td align=left><select size=1 name=modify_leads><option>0</option><option>1</option><option SELECTED>$modify_leads</option></select>$NWB#vicidial_users-modify_leads$NWE</td></tr>\n";
		echo "<tr bgcolor=#B6D3FC><td align=right>Ändern Sie Vertreter-Kampagne: </td><td align=left><select size=1 name=change_agent_campaign><option>0</option><option>1</option><option SELECTED>$change_agent_campaign</option></select>$NWB#vicidial_users-change_agent_campaign$NWE</td></tr>\n";
		echo "<tr bgcolor=#B6D3FC><td align=right>Löschung-Filter: </td><td align=left><select size=1 name=delete_filters><option>0</option><option>1</option><option SELECTED>$delete_filters</option></select>$NWB#vicidial_users-delete_filters$NWE</td></tr>\n";
		echo "<tr bgcolor=#B6D3FC><td align=right>Lösche Anrufzeits: </td><td align=left><select size=1 name=delete_call_times><option>0</option><option>1</option><option SELECTED>$delete_call_times</option></select>$NWB#vicidial_users-delete_call_times$NWE</td></tr>\n";
		echo "<tr bgcolor=#B6D3FC><td align=right>Bearbeite Anrufzeits: </td><td align=left><select size=1 name=modify_call_times><option>0</option><option>1</option><option SELECTED>$modify_call_times</option></select>$NWB#vicidial_users-modify_call_times$NWE</td></tr>\n";
		}
	echo "<tr bgcolor=#B6D3FC><td align=center colspan=2><input type=submit name=SUBMIT value=SUBMIT></td></tr>\n";
	echo "</TABLE></center>\n";

	if ($LOGdelete_users > 0)
		{
		echo "<br><br><a href=\"$PHP_SELF?ADD=5&user=$row[1]\">LÖSCHEN SIE DIESEN BENUTZER</a>\n";
		}
	echo "<br><br><a href=\"./AST_agent_time_sheet.php?agent=$row[1]\">Klicken Sie hier für Benutzerzeitblatt</a>\n";
	echo "<br><br><a href=\"./user_status.php?user=$row[1]\">Klicken Sie hier für Benutzerstatus</a>\n";
	echo "<br><br><a href=\"./user_stats.php?user=$row[1]\">Klicken Sie hier für Benutzernotfall</a>\n";
	echo "<br><br><a href=\"$PHP_SELF?ADD=8&user=$row[1]\">Klicken Sie hier für Benutzer Wiederholungsbesuch Einflüsse</a>\n";
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

echo "<br>ÄNDERN Sie Einen KAMPAGNEN SATZ: $row[0] - <a href=\"$PHP_SELF?ADD=34&campaign_id=$campaign_id\">Grundlegende Ansicht</a>";
echo " | Detail-Ansicht</a> | ";
echo "<a href=\"./AST_timeonVDADall.php?RR=4&DB=0&group=$row[0]\">Echtzeit Bildschirm</a>\n";
echo "<form action=$PHP_SELF method=POST>\n";
echo "<input type=hidden name=ADD value=41>\n";
echo "<input type=hidden name=campaign_id value=\"$campaign_id\">\n";
echo "<center><TABLE width=600 cellspacing=3>\n";
echo "<tr bgcolor=#B6D3FC><td align=right>Kampagne Identifikation: </td><td align=left><b>$row[0]</b>$NWB#vicidial_campaigns-campaign_id$NWE</td></tr>\n";
echo "<tr bgcolor=#B6D3FC><td align=right>Kampagne Name: </td><td align=left><input type=text name=campaign_name size=40 maxlength=40 value=\"$row[1]\">$NWB#vicidial_campaigns-campaign_name$NWE</td></tr>\n";
echo "<tr bgcolor=#B6D3FC><td align=right>Aktiv:</td><td align=left><select size=1 name=active><option>Y</option><option>N</option><option SELECTED>$row[2]</option></select>$NWB#vicidial_campaigns-active$NWE</td></tr>\n";
echo "<tr bgcolor=#B6D3FC><td align=right>Park-Verlängerung: </td><td align=left><input type=text name=park_ext size=10 maxlength=10 value=\"$row[9]\"> - Filename: <input type=text name=park_file_name size=10 maxlength=10 value=\"$row[10]\">$NWB#vicidial_campaigns-park_ext$NWE</td></tr>\n";
echo "<tr bgcolor=#B6D3FC><td align=right>Netz-Form: </td><td align=left><input type=text name=web_form_address size=50 maxlength=255 value=\"$row[11]\">$NWB#vicidial_campaigns-web_form_address$NWE</td></tr>\n";
echo "<tr bgcolor=#B6D3FC><td align=right>Erlauben Sie Closers: </td><td align=left><select size=1 name=allow_closers><option>Y</option><option>N</option><option SELECTED>$row[12]</option></select>$NWB#vicidial_campaigns-allow_closers$NWE</td></tr>\n";
echo "<tr bgcolor=#B6D3FC><td align=right>Vorwahlknopfstatus1: </td><td align=left><select size=1 name=dial_status_a>\n";
echo "<option value=\"\"> - NONE - </option>\n";

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
echo "$statuses_list";
echo "<option value=\"$dial_status_a\" SELECTED>$dial_status_a - $statname_list[$dial_status_a]</option>\n";
echo "</select>$NWB#vicidial_campaigns-dial_status$NWE</td></tr>\n";
echo "<tr bgcolor=#B6D3FC><td align=right>Vorwahlknopfstatus2: </td><td align=left><select size=1 name=dial_status_b>\n";
echo "<option value=\"\"> - NONE - </option>\n";
echo "$statuses_list";
echo "<option value=\"$dial_status_b\" SELECTED>$dial_status_b - $statname_list[$dial_status_b]</option>\n";
echo "</select>$NWB#vicidial_campaigns-dial_status$NWE</td></tr>\n";
echo "<tr bgcolor=#B6D3FC><td align=right>Vorwahlknopfstatus3: </td><td align=left><select size=1 name=dial_status_c>\n";
echo "<option value=\"\"> - NONE - </option>\n";
echo "$statuses_list";
echo "<option value=\"$dial_status_c\" SELECTED>$dial_status_c - $statname_list[$dial_status_c]</option>\n";
echo "</select>$NWB#vicidial_campaigns-dial_status$NWE</td></tr>\n";
echo "<tr bgcolor=#B6D3FC><td align=right>Vorwahlknopfstatus4: </td><td align=left><select size=1 name=dial_status_d>\n";
echo "<option value=\"\"> - NONE - </option>\n";
echo "$statuses_list";
echo "<option value=\"$dial_status_d\" SELECTED>$dial_status_d - $statname_list[$dial_status_d]</option>\n";
echo "</select>$NWB#vicidial_campaigns-dial_status$NWE</td></tr>\n";
echo "<tr bgcolor=#B6D3FC><td align=right>Vorwahlknopfstatus5: </td><td align=left><select size=1 name=dial_status_e>\n";
echo "<option value=\"\"> - NONE - </option>\n";
echo "$statuses_list";
echo "<option value=\"$dial_status_e\" SELECTED>$dial_status_e - $statname_list[$dial_status_e]</option>\n";
echo "</select>$NWB#vicidial_campaigns-dial_status$NWE</td></tr>\n";

echo "<tr bgcolor=#B6D3FC><td align=right>Liste Auftrag: </td><td align=left><select size=1 name=lead_order><option>DOWN</option><option>UP</option><option>UP PHONE</option><option>DOWN PHONE</option><option>UP LAST NAME</option><option>DOWN LAST NAME</option><option>UP COUNT</option><option>DOWN COUNT</option><option>DOWN COUNT 2nd NEW</option><option>DOWN COUNT 3rd NEW</option><option>DOWN COUNT 4th NEW</option><option SELECTED>$lead_order</option></select>$NWB#vicidial_campaigns-lead_order$NWE</td></tr>\n";

echo "<tr bgcolor=#B6D3FC><td align=right><a href=\"$PHP_SELF?ADD=31111111&lead_filter_id=$lead_filter_id\">Leitung Filter</a>: </td><td align=left><select size=1 name=lead_filter_id>\n";
echo "$filters_list";
echo "<option selected value=\"$lead_filter_id\">$lead_filter_id - $filtername_list[$lead_filter_id]</option>\n";
echo "</select>$NWB#vicidial_campaigns-lead_filter_id$NWE</td></tr>\n";

echo "<tr bgcolor=#B6D3FC><td align=right>Zufuhrbehälter-Niveau: </td><td align=left><select size=1 name=hopper_level><option>1</option><option>5</option><option>10</option><option>50</option><option>100</option><option>200</option><option>500</option><option>750</option><option>1000</option><option>2000</option><option SELECTED>$hopper_level</option></select>$NWB#vicidial_campaigns-hopper_level$NWE</td></tr>\n";

echo "<tr bgcolor=#B6D3FC><td align=right>Kraft-Zurückstellen des Zufuhrbehälters: </td><td align=left><select size=1 name=reset_hopper><option>Y</option><option SELECTED>N</option></select>$NWB#vicidial_campaigns-force_reset_hopper$NWE</td></tr>\n";

echo "<tr bgcolor=#BDFFBD><td align=right>Vorwahlknopf-Methode: </td><td align=left><select size=1 name=dial_method><option >MANUAL</option><option>RATIO</option><option>ADAPT_HARD_LIMIT</option><option>ADAPT_TAPERED</option><option>ADAPT_AVERAGE</option><option SELECTED>$dial_method</option></select>$NWB#vicidial_campaigns-dial_method$NWE</td></tr>\n";

echo "<tr bgcolor=#BDFFBD><td align=right>Selbstvorwahlknopf-Niveau: </td><td align=left><select size=1 name=auto_dial_level><option >0</option><option>1</option><option>1.1</option><option>1.2</option><option>1.3</option><option>1.4</option><option>1.5</option><option>1.6</option><option>1.7</option><option>1.8</option><option>1.9</option><option>2.0</option><option>2.2</option><option>2.5</option><option>2.7</option><option>3.0</option><option>3.5</option><option>4.0</option><option SELECTED>$auto_dial_level</option></select>(0 = off)$NWB#vicidial_campaigns-auto_dial_level$NWE</td></tr>\n";

echo "<tr bgcolor=#BDFFBD><td align=right>Vorhandenes Nur Tally: </td><td align=left><select size=1 name=available_only_ratio_tally><option >Y</option><option>N</option><option SELECTED>$available_only_ratio_tally</option></select>$NWB#vicidial_campaigns-available_only_ratio_tally$NWE</td></tr>\n";

echo "<tr bgcolor=#BDFFBD><td align=right>Tropfen-Prozentsatz-Begrenzung: </td><td align=left><select size=1 name=adaptive_dropped_percentage>\n";
$n=100;
while ($n>=1)
	{
	echo "<option>$n</option>\n";
	$n--;
	}
echo "<option SELECTED>$adaptive_dropped_percentage</option></select>% $NWB#vicidial_campaigns-adaptive_dropped_percentage$NWE</td></tr>\n";

echo "<tr bgcolor=#BDFFBD><td align=right>Maximum Paßt Vorwahlknopf-Niveau An: </td><td align=left><input type=text name=adaptive_maximum_level size=6 maxlength=6 value=\"$adaptive_maximum_level\"><i>number only</i> $NWB#vicidial_campaigns-adaptive_maximum_level$NWE</td></tr>\n";

echo "<tr bgcolor=#BDFFBD><td align=right>Neueste Bediener-Zeit: </td><td align=left><input type=text name=adaptive_latest_server_time size=6 maxlength=4 value=\"$adaptive_latest_server_time\"><i>4 nur Stellen</i> $NWB#vicidial_campaigns-adaptive_latest_server_time$NWE</td></tr>\n";

echo "<tr bgcolor=#BDFFBD><td align=right>Passen Sie Intensität Modifizierfaktor An: </td><td align=left><select size=1 name=adaptive_intensity>\n";
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



echo "<tr bgcolor=#BDFFBD><td align=right>Vorwahlknopf-Waagerecht ausgerichtetes Unterschied-Ziel: </td><td align=left><select size=1 name=adaptive_dl_diff_target>\n";
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


echo "<tr bgcolor=#B6D3FC><td align=right>Folgender Vertreter-Anruf: </td><td align=left><select size=1 name=next_agent_call><option >random</option><option>oldest_call_start</option><option>oldest_call_finish</option><option>overall_user_level</option><option SELECTED>$next_agent_call</option></select>$NWB#vicidial_campaigns-next_agent_call$NWE</td></tr>\n";

echo "<tr bgcolor=#B6D3FC><td align=right><a href=\"$PHP_SELF?ADD=311111111&call_time_id=$local_call_time\">Ortsgespräch-Zeit: </a></td><td align=left><select size=1 name=local_call_time>\n";
echo "$call_times_list";
echo "<option selected value=\"$local_call_time\">$local_call_time - $call_timename_list[$local_call_time]</option>\n";
echo "</select>$NWB#vicidial_campaigns-local_call_time$NWE</td></tr>\n";

echo "<tr bgcolor=#B6D3FC><td align=right>Vorwahlknopf-Abschaltung: </td><td align=left><input type=text name=dial_timeout size=3 maxlength=3 value=\"$dial_timeout\"> <i>in seconds</i>$NWB#vicidial_campaigns-dial_timeout$NWE</td></tr>\n";

echo "<tr bgcolor=#B6D3FC><td align=right>Vorwahlknopf-Präfix: </td><td align=left><input type=text name=dial_prefix size=20 maxlength=20 value=\"$dial_prefix\"> <font size=1>for 91NXXNXXXXXX value would be 9, for no dial prefix use X</font>$NWB#vicidial_campaigns-dial_prefix$NWE</td></tr>\n";

echo "<tr bgcolor=#B6D3FC><td align=right>Lassen Sie Telefon-Code Aus: </td><td align=left><select size=1 name=omit_phone_code><option>Y</option><option>N</option><option SELECTED>$omit_phone_code</option></select>$NWB#vicidial_campaigns-omit_phone_code$NWE</td></tr>\n";

echo "<tr bgcolor=#B6D3FC><td align=right>Kampagne CallerID: </td><td align=left><input type=text name=campaign_cid size=20 maxlength=20 value=\"$campaign_cid\">$NWB#vicidial_campaigns-campaign_cid$NWE</td></tr>\n";

echo "<tr bgcolor=#B6D3FC><td align=right>Kampagne VDAD exten: </td><td align=left><input type=text name=campaign_vdad_exten size=10 maxlength=20 value=\"$campaign_vdad_exten\">$NWB#vicidial_campaigns-campaign_vdad_exten$NWE</td></tr>\n";

echo "<tr bgcolor=#B6D3FC><td align=right>Kampagne Rec exten: </td><td align=left><input type=text name=campaign_rec_exten size=10 maxlength=10 value=\"$campaign_rec_exten\">$NWB#vicidial_campaigns-campaign_rec_exten$NWE</td></tr>\n";

echo "<tr bgcolor=#B6D3FC><td align=right>Kampagne Aufnahme: </td><td align=left><select size=1 name=campaign_recording><option>NEVER</option><option>ONDEMAND</option><option>ALLCALLS</option><option>ALLFORCE</option><option SELECTED>$campaign_recording</option></select>$NWB#vicidial_campaigns-campaign_recording$NWE</td></tr>\n";

echo "<tr bgcolor=#B6D3FC><td align=right>Kampagne Rec Dateiname: </td><td align=left><input type=text name=campaign_rec_filename size=50 maxlength=50 value=\"$campaign_rec_filename\">$NWB#vicidial_campaigns-campaign_rec_filename$NWE</td></tr>\n";

echo "<tr bgcolor=#B6D3FC><td align=right>Das Notieren Verzögert: </td><td align=left><input type=text name=allcalls_delay size=3 maxlength=3 value=\"$allcalls_delay\"> <i>in seconds</i>$NWB#vicidial_campaigns-allcalls_delay$NWE</td></tr>\n";

echo "<tr bgcolor=#B6D3FC><td align=right><a href=\"$PHP_SELF?ADD=3111111&script_id=$script_id\">Script</a>: </td><td align=left><select size=1 name=script_id>\n";
echo "$scripts_list";
echo "<option selected value=\"$script_id\">$script_id - $scriptname_list[$script_id]</option>\n";
echo "</select>$NWB#vicidial_campaigns-campaign_script$NWE</td></tr>\n";

echo "<tr bgcolor=#B6D3FC><td align=right>Erhalten Sie Anruf-Produkteinführung: </td><td align=left><select size=1 name=get_call_launch><option selected>NONE</option><option>SCRIPT</option><option>WEBFORM</option><option selected>$get_call_launch</option></select>$NWB#vicidial_campaigns-get_call_launch$NWE</td></tr>\n";

echo "<tr bgcolor=#B6D3FC><td align=right>Antwortende Maschine Anzeige: </td><td align=left><input type=text name=am_message_exten size=10 maxlength=20 value=\"$am_message_exten\">$NWB#vicidial_campaigns-am_message_exten$NWE</td></tr>\n";

echo "<tr bgcolor=#B6D3FC><td align=right>AMD senden zu VM exten: </td><td align=left><select size=1 name=amd_send_to_vmx><option>Y</option><option>N</option><option SELECTED>$amd_send_to_vmx</option></select>$NWB#vicidial_campaigns-amd_send_to_vmx$NWE</td></tr>\n";

echo "<tr bgcolor=#B6D3FC><td align=right>BringenSie DTMF 1: </td><td align=left><input type=text name=xferconf_a_dtmf size=20 maxlength=50 value=\"$xferconf_a_dtmf\">$NWB#vicidial_campaigns-xferconf_a_dtmf$NWE</td></tr>\n";

echo "<tr bgcolor=#B6D3FC><td align=right>BringenSie Zahl 1: </td><td align=left><input type=text name=xferconf_a_number size=20 maxlength=50 value=\"$xferconf_a_number\">$NWB#vicidial_campaigns-xferconf_a_dtmf$NWE</td></tr>\n";

echo "<tr bgcolor=#B6D3FC><td align=right>BringenSie DTMF 2: </td><td align=left><input type=text name=xferconf_b_dtmf size=20 maxlength=50 value=\"$xferconf_b_dtmf\">$NWB#vicidial_campaigns-xferconf_a_dtmf$NWE</td></tr>\n";

echo "<tr bgcolor=#B6D3FC><td align=right>BringenSie Zahl 2: </td><td align=left><input type=text name=xferconf_b_number size=20 maxlength=50 value=\"$xferconf_b_number\">$NWB#vicidial_campaigns-xferconf_a_dtmf$NWE</td></tr>\n";

echo "<tr bgcolor=#B6D3FC><td align=right>Alternative Nummer wählen: </td><td align=left><select size=1 name=alt_number_dialing><option>Y</option><option>N</option><option SELECTED>$alt_number_dialing</option></select>$NWB#vicidial_campaigns-alt_number_dialing$NWE</td></tr>\n";

echo "<tr bgcolor=#B6D3FC><td align=right>Zeitlich geplante Wiederholungsbesuche: </td><td align=left><select size=1 name=scheduled_callbacks><option>Y</option><option>N</option><option SELECTED>$scheduled_callbacks</option></select>$NWB#vicidial_campaigns-scheduled_callbacks$NWE</td></tr>\n";

echo "<tr bgcolor=#B6D3FC><td align=right>Verbindungsaufbau Sekunden: </td><td align=left><input type=text name=drop_call_seconds size=5 maxlength=2 value=\"$drop_call_seconds\">$NWB#vicidial_campaigns-drop_call_seconds$NWE</td></tr>\n";

echo "<tr bgcolor=#B6D3FC><td align=right>Voicemail: </td><td align=left><input type=text name=voicemail_ext size=10 maxlength=10 value=\"$voicemail_ext\">$NWB#vicidial_campaigns-voicemail_ext$NWE</td></tr>\n";

echo "<tr bgcolor=#B6D3FC><td align=right>Benutze Sicherheitsnachricht: </td><td align=left><select size=1 name=safe_harbor_message><option>Y</option><option>N</option><option SELECTED>$safe_harbor_message</option></select>$NWB#vicidial_campaigns-safe_harbor_message$NWE</td></tr>\n";

echo "<tr bgcolor=#B6D3FC><td align=right>Sicherheitsnebenstelle: </td><td align=left><input type=text name=safe_harbor_exten size=10 maxlength=20 value=\"$safe_harbor_exten\">$NWB#vicidial_campaigns-safe_harbor_exten$NWE</td></tr>\n";

echo "<tr bgcolor=#B6D3FC><td align=right>Nachbereitung Sekunden </td><td align=left><input type=text name=wrapup_seconds size=5 maxlength=3 value=\"$wrapup_seconds\">$NWB#vicidial_campaigns-wrapup_seconds$NWE</td></tr>\n";

echo "<tr bgcolor=#B6D3FC><td align=right>Nachbereitung Nachricht </td><td align=left><input type=text name=wrapup_message size=40 maxlength=255 value=\"$wrapup_message\">$NWB#vicidial_campaigns-wrapup_message$NWE</td></tr>\n";

echo "<tr bgcolor=#B6D3FC><td align=right>Benutzen Sie Interne DNC Liste: </td><td align=left><select size=1 name=use_internal_dnc><option>Y</option><option>N</option><option SELECTED>$use_internal_dnc</option></select>$NWB#vicidial_campaigns-use_internal_dnc$NWE</td></tr>\n";


if (eregi("CLOSER", $campaign_id))
	{
	echo "<tr bgcolor=#B6D3FC><td align=right>Gewährte Inbound Gruppen: <BR>";
	echo " $NWB#vicidial_campaigns-closer_campaigns$NWE</td><td align=left>\n";
	echo "$groups_list";
	echo "</td></tr>\n";
	}



echo "<tr bgcolor=#B6D3FC><td align=center colspan=2><input type=submit name=SUBMIT value=SUBMIT></td></tr>\n";
echo "</TABLE></center></FORM>\n";

echo "<center>\n";
echo "<br><b>LISTEN INNERHALB DIESER KAMPAGNE: &nbsp; $NWB#vicidial_campaign_lists$NWE</b><br>\n";
echo "<TABLE width=400 cellspacing=3>\n";
echo "<tr><td>LISTE IDENTIFIKATION</td><td>LISTE NAME</td><td>AKTIV</td></tr>\n";

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
echo "Diese Kampagne hat$active_lists aktive Listen und$inactive_lists unaktivierte Listen<br><br>\n";

if ($display_dialable_count == 'Y')
	{
	### call function to calculate and print dialable leads
	dialable_leads($DB,$link,$local_call_time,$dial_status_a,$dial_status_b,$dial_status_c,$dial_status_d,$dial_status_e,$camp_lists,$fSQL);
	echo " - <font size=1><a href=\"$PHP_SELF?ADD=31&campaign_id=$campaign_id&stage=hide_dialable\">Verberge</a></font><BR><BR>";
	}
else
	{
	echo "<a href=\"$PHP_SELF?ADD=73&campaign_id=$campaign_id\" target=\"_blank\">Popup Dialable Leads Count</a>";
	echo " - <font size=1><a href=\"$PHP_SELF?ADD=31&campaign_id=$campaign_id&stage=show_dialable\">Zeige</a></font><BR><BR>";
	}





	$stmt="SELECT count(*) FROM vicidial_hopper where campaign_id='$campaign_id' and status IN('READY')";
	if ($DB) {echo "$stmt\n";}
	$rslt=mysql_query($stmt, $link);
	$rowx=mysql_fetch_row($rslt);
	$hopper_leads = "$rowx[0]";

echo "Diese Kampagne hat$hopper_leads Leitungen im Vorwahlknopfzufuhrbehälter<br><br>\n";
echo "<a href=\"./AST_VICIDIAL_hopperlist.php?group=$campaign_id\">Klicken Sie hier, um zu sehen, welche Leitungen im Zufuhrbehälter imAugenblick sind</a><br><br>\n";
echo "<a href=\"$PHP_SELF?ADD=81&campaign_id=$campaign_id\">Klicken Sie hier, um alle Wiederholungsbesuch Einflüsse in dieserKampagne zu sehen</a><BR><BR>\n";
echo "<a href=\"./AST_VDADstats.php?group=$campaign_id\">Click here to see a VDAD report for this campaign</a><BR><BR>\n";
echo "</b></center>\n";




echo "<center>\n";
echo "<br><b>KUNDENSPEZIFISCHE STATUS INNERHALB DIESER KAMPAGNE: &nbsp; $NWB#vicidial_campaign_statuses$NWE</b><br>\n";
echo "<TABLE width=400 cellspacing=3>\n";
echo "<tr><td>STATUS</td><td>BESCHREIBUNG</td><td>AUSWÄHLBAR</td><td>LÖSCHUNG</td></tr>\n";

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

	echo "<tr $bgcolor><td><font size=1>$rowx[0]</td><td><font size=1>$rowx[1]</td><td><font size=1>$rowx[2]</td><td><font size=1><a href=\"$PHP_SELF?ADD=42&campaign_id=$campaign_id&status=$rowx[0]&action=DELETE\">LÖSCHUNG</a></td></tr>\n";

	}

echo "</table>\n";

echo "<br>ADDIEREN SIE NEUEN KUNDENSPEZIFISCHEN KAMPAGNE STATUS<BR><form action=$PHP_SELF method=POST>\n";
echo "<input type=hidden name=ADD value=22>\n";
echo "<input type=hidden name=campaign_id value=\"$campaign_id\">\n";
echo "Status:<input type=text name=status size=10 maxlength=8> &nbsp; \n";
echo "Beschreibung:<input type=text name=status_name size=20 maxlength=30> &nbsp; \n";
echo "Auswählbar:<select size=1 name=selectable><option>Y</option><option>N</option></select> &nbsp; \n";
echo "<input type=submit name=submit value=ADD><BR>\n";

echo "</FORM><br>\n";



echo "<br><b>GEWOHNHEIT HOTKEYS INNERHALB DIESER KAMPAGNE: &nbsp; $NWB#vicidial_campaign_hotkeys$NWE</b><br>\n";
echo "<TABLE width=400 cellspacing=3>\n";
echo "<tr><td>HOTKEY</td><td>STATUS</td><td>BESCHREIBUNG</td><td>LÖSCHUNG</td></tr>\n";

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

	echo "<tr $bgcolor><td><font size=1>$rowx[1]</td><td><font size=1>$rowx[0]</td><td><font size=1>$rowx[2]</td><td><font size=1><a href=\"$PHP_SELF?ADD=43&campaign_id=$campaign_id&status=$rowx[0]&hotkey=$rowx[1]&action=DELETE\">LÖSCHUNG</a></td></tr>\n";

	}

echo "</table>\n";

echo "<br>ADDIEREN SIE NEUE KUNDENSPEZIFISCHE KAMPAGNE HOTKEY<BR><form action=$PHP_SELF method=POST>\n";
echo "<input type=hidden name=ADD value=23>\n";
echo "<input type=hidden name=selectable value=Y>\n";
echo "<input type=hidden name=campaign_id value=\"$campaign_id\">\n";
echo "Hotkey:<select size=1 name=hotkey>\n";
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
echo "Status:<select size=1 name=HKstatus>\n";
echo "$HKstatuses_list\n";
echo "</select> &nbsp; \n";
echo "<input type=submit name=submit value=ADD><BR>\n";
echo "</form><BR>\n";



echo "<br><br><b>LEITUNG, DIE INNERHALB DIESER KAMPAGNE AUFBEREITET: &nbsp; $NWB#vicidial_lead_recycle$NWE</b><br>\n";
echo "<TABLE width=500 cellspacing=3>\n";
echo "<tr><td>STATUS</td><td>VERSUCH VERZÖGERT</td><td>VERSUCH MAXIMUM</td><td>AKTIV</td><td> </td><td>LÖSCHUNG</td></tr>\n";

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
	echo "<td><font size=1><input size=7 maxlength=5 name=attempt_delay value=\"$rowx[3]\"></td>\n";
	echo "<td><font size=1><input size=5 maxlength=3 name=attempt_maximum value=\"$rowx[4]\"></td>\n";
	echo "<td><select size=1 name=active><option>Y</option><option>N</option><option SELECTED>$rowx[5]</option></select></td>\n";
	echo "<td><font size=1><input type=submit name=submit value=MODIFY></form></td>\n";
	echo "<td><font size=1><a href=\"$PHP_SELF?ADD=65&campaign_id=$campaign_id&status=$rowx[2]\">LÖSCHUNG</a></td></tr>\n";
	}

echo "</table>\n";

echo "<br>ADDIEREN SIE NEUE KAMPAGNE LEITUNG AUFBEREITEN<BR><form action=$PHP_SELF method=POST>\n";
echo "<input type=hidden name=ADD value=25>\n";
echo "<input type=hidden name=active value=\"N\">\n";
echo "<input type=hidden name=campaign_id value=\"$campaign_id\">\n";
echo "Status:<select size=1 name=status>\n";
echo "$LRstatuses_list\n";
echo "</select> &nbsp; \n";
echo "Versuch Verzögert: <input size=7 maxlength=5 name=attempt_delay>\n";
echo "Versuch Maximum: <input size=5 maxlength=3 name=attempt_maximum>\n";
echo "<input type=submit name=submit value=ADD><BR>\n";

echo "</center></FORM><br>\n";

echo "<a href=\"$PHP_SELF?ADD=52&campaign_id=$campaign_id\">LOGGEN SIE ALLE MITTEL AUS DIESER KAMPAGNE HERAUS</a><BR><BR>\n";
echo "<a href=\"$PHP_SELF?ADD=53&campaign_id=$campaign_id\">EMERGENCY VDAC CLEAR FOR THIS CAMPAIGN</a><BR><BR>\n";

if ($LOGdelete_campaigns > 0)
	{
	echo "<br><br><a href=\"$PHP_SELF?ADD=51&campaign_id=$campaign_id\">LÖSCHEN SIE DIESE KAMPAGNE</a>\n";
	}

}


######################
# ADD=34 modify campaign info in the system - Basic View
######################

if ( ($ADD==34) and ( (!eregi("$campaign_id",$LOGallowed_campaigns)) and (!eregi("ALL-CAMPAIGNS",$LOGallowed_campaigns)) ) ) 
	{$ADD=30;}	# send to not allowed screen if not in vicidial_user_groups allowed_campaigns list

if ($ADD==34)
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

echo "<br>MODIFY A CAMPAIGN'S RECORD: $row[0] - Grundlegende Ansicht | ";
echo "<a href=\"$PHP_SELF?ADD=31&campaign_id=$campaign_id\">Detail-Ansicht</a> | ";
echo "<a href=\"./AST_timeonVDADall.php?RR=4&DB=0&group=$row[0]\">Echtzeit Bildschirm</a>\n";
echo "<form action=$PHP_SELF method=POST>\n";
echo "<input type=hidden name=ADD value=44>\n";
echo "<input type=hidden name=campaign_id value=\"$campaign_id\">\n";
echo "<center><TABLE width=600 cellspacing=3>\n";
echo "<tr bgcolor=#B6D3FC><td align=right>Kampagne Identifikation: </td><td align=left><b>$row[0]</b>$NWB#vicidial_campaigns-campaign_id$NWE</td></tr>\n";
echo "<tr bgcolor=#B6D3FC><td align=right>Kampagne Name: </td><td align=left><input type=text name=campaign_name size=40 maxlength=40 value=\"$row[1]\">$NWB#vicidial_campaigns-campaign_name$NWE</td></tr>\n";
echo "<tr bgcolor=#B6D3FC><td align=right>Aktiv:</td><td align=left><select size=1 name=active><option>Y</option><option>N</option><option SELECTED>$row[2]</option></select>$NWB#vicidial_campaigns-active$NWE</td></tr>\n";
echo "<tr bgcolor=#B6D3FC><td align=right>Park-Verlängerung: </td><td align=left>$row[9] - $row[10]$NWB#vicidial_campaigns-park_ext$NWE</td></tr>\n";
echo "<tr bgcolor=#B6D3FC><td align=right>Netz-Form: </td><td align=left>$row[11]$NWB#vicidial_campaigns-web_form_address$NWE</td></tr>\n";
echo "<tr bgcolor=#B6D3FC><td align=right>Erlauben Sie Closers: </td><td align=left>$row[12] $NWB#vicidial_campaigns-allow_closers$NWE</td></tr>\n";
echo "<tr bgcolor=#B6D3FC><td align=right>Vorwahlknopfstatus1: </td><td align=left><select size=1 name=dial_status_a>\n";
echo "<option value=\"\"> - NONE - </option>\n";

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
		$o++;
		}
echo "$statuses_list";
echo "<option value=\"$dial_status_a\" SELECTED>$dial_status_a - $statname_list[$dial_status_a]</option>\n";
echo "</select>$NWB#vicidial_campaigns-dial_status$NWE</td></tr>\n";
echo "<tr bgcolor=#B6D3FC><td align=right>Vorwahlknopfstatus2: </td><td align=left><select size=1 name=dial_status_b>\n";
echo "<option value=\"\"> - NONE - </option>\n";
echo "$statuses_list";
echo "<option value=\"$dial_status_b\" SELECTED>$dial_status_b - $statname_list[$dial_status_b]</option>\n";
echo "</select>$NWB#vicidial_campaigns-dial_status$NWE</td></tr>\n";
echo "<tr bgcolor=#B6D3FC><td align=right>Vorwahlknopfstatus3: </td><td align=left><select size=1 name=dial_status_c>\n";
echo "<option value=\"\"> - NONE - </option>\n";
echo "$statuses_list";
echo "<option value=\"$dial_status_c\" SELECTED>$dial_status_c - $statname_list[$dial_status_c]</option>\n";
echo "</select>$NWB#vicidial_campaigns-dial_status$NWE</td></tr>\n";
echo "<tr bgcolor=#B6D3FC><td align=right>Vorwahlknopfstatus4: </td><td align=left><select size=1 name=dial_status_d>\n";
echo "<option value=\"\"> - NONE - </option>\n";
echo "$statuses_list";
echo "<option value=\"$dial_status_d\" SELECTED>$dial_status_d - $statname_list[$dial_status_d]</option>\n";
echo "</select>$NWB#vicidial_campaigns-dial_status$NWE</td></tr>\n";
echo "<tr bgcolor=#B6D3FC><td align=right>Vorwahlknopfstatus5: </td><td align=left><select size=1 name=dial_status_e>\n";
echo "<option value=\"\"> - NONE - </option>\n";
echo "$statuses_list";
echo "<option value=\"$dial_status_e\" SELECTED>$dial_status_e - $statname_list[$dial_status_e]</option>\n";
echo "</select>$NWB#vicidial_campaigns-dial_status$NWE</td></tr>\n";

echo "<tr bgcolor=#B6D3FC><td align=right>Liste Auftrag: </td><td align=left><select size=1 name=lead_order><option>DOWN</option><option>UP</option><option>UP PHONE</option><option>DOWN PHONE</option><option>UP LAST NAME</option><option>DOWN LAST NAME</option><option>UP COUNT</option><option>DOWN COUNT</option><option>DOWN COUNT 2nd NEW</option><option>DOWN COUNT 3rd NEW</option><option>DOWN COUNT 4th NEW</option><option SELECTED>$lead_order</option></select>$NWB#vicidial_campaigns-lead_order$NWE</td></tr>\n";

echo "<tr bgcolor=#B6D3FC><td align=right><a href=\"$PHP_SELF?ADD=31111111&lead_filter_id=$lead_filter_id\">Leitung Filter</a>: </td><td align=left><select size=1 name=lead_filter_id>\n";
echo "$filters_list";
echo "<option selected value=\"$lead_filter_id\">$lead_filter_id - $filtername_list[$lead_filter_id]</option>\n";
echo "</select>$NWB#vicidial_campaigns-lead_filter_id$NWE</td></tr>\n";

echo "<tr bgcolor=#B6D3FC><td align=right>Zufuhrbehälter-Niveau: </td><td align=left><select size=1 name=hopper_level><option>1</option><option>5</option><option>10</option><option>50</option><option>100</option><option>200</option><option>500</option><option>750</option><option>1000</option><option>2000</option><option SELECTED>$hopper_level</option></select>$NWB#vicidial_campaigns-hopper_level$NWE</td></tr>\n";

echo "<tr bgcolor=#B6D3FC><td align=right>Kraft-Zurückstellen des Zufuhrbehälters: </td><td align=left><select size=1 name=reset_hopper><option>Y</option><option SELECTED>N</option></select>$NWB#vicidial_campaigns-force_reset_hopper$NWE</td></tr>\n";

echo "<tr bgcolor=#BDFFBD><td align=right>Vorwahlknopf-Methode: </td><td align=left><select size=1 name=dial_method><option >MANUAL</option><option>RATIO</option><option>ADAPT_HARD_LIMIT</option><option>ADAPT_TAPERED</option><option>ADAPT_AVERAGE</option><option SELECTED>$dial_method</option></select>$NWB#vicidial_campaigns-dial_method$NWE</td></tr>\n";

echo "<tr bgcolor=#BDFFBD><td align=right>Selbstvorwahlknopf-Niveau: </td><td align=left><select size=1 name=auto_dial_level><option >0</option><option>1</option><option>1.1</option><option>1.2</option><option>1.3</option><option>1.4</option><option>1.5</option><option>1.6</option><option>1.7</option><option>1.8</option><option>1.9</option><option>2.0</option><option>2.2</option><option>2.5</option><option>2.7</option><option>3.0</option><option>3.5</option><option>4.0</option><option SELECTED>$auto_dial_level</option></select>(0 = off)$NWB#vicidial_campaigns-auto_dial_level$NWE</td></tr>\n";

echo "<tr bgcolor=#BDFFBD><td align=right>Passen Sie Intensität Modifizierfaktor An: </td><td align=left><select size=1 name=adaptive_intensity>\n";
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

echo "<tr bgcolor=#B6D3FC><td align=right>Erhalten Sie Anruf-Produkteinführung: </td><td align=left>$get_call_launch</td></tr>\n";

echo "<tr bgcolor=#B6D3FC><td align=center colspan=2><input type=submit name=SUBMIT value=SUBMIT></td></tr>\n";
echo "</TABLE></center></FORM>\n";

echo "<center>\n";
echo "<br><b>LISTEN INNERHALB DIESER KAMPAGNE: &nbsp; $NWB#vicidial_campaign_lists$NWE</b><br>\n";
echo "<TABLE width=400 cellspacing=3>\n";
echo "<tr><td>LISTE IDENTIFIKATION</td><td>LISTE NAME</td><td>AKTIV</td></tr>\n";

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
echo "Diese Kampagne hat$active_lists aktive Listen und$inactive_lists unaktivierte Listen<br><br>\n";


if ($display_dialable_count == 'Y')
	{
	### call function to calculate and print dialable leads
	dialable_leads($DB,$link,$local_call_time,$dial_status_a,$dial_status_b,$dial_status_c,$dial_status_d,$dial_status_e,$camp_lists,$fSQL);
	echo " - <font size=1><a href=\"$PHP_SELF?ADD=34&campaign_id=$campaign_id&stage=hide_dialable\">Verberge</a></font><BR><BR>";
	}
else
	{
	echo "<a href=\"$PHP_SELF?ADD=73&campaign_id=$campaign_id\" target=\"_blank\">Popup Dialable Leads Count</a>";
	echo " - <font size=1><a href=\"$PHP_SELF?ADD=31&campaign_id=$campaign_id&stage=show_dialable\">Zeige</a></font><BR><BR>";
	}



	$stmt="SELECT count(*) FROM vicidial_hopper where campaign_id='$campaign_id' and status IN('READY')";
	if ($DB) {echo "$stmt\n";}
	$rslt=mysql_query($stmt, $link);
	$rowx=mysql_fetch_row($rslt);
	$hopper_leads = "$rowx[0]";

echo "Diese Kampagne hat$hopper_leads Leitungen im Vorwahlknopfzufuhrbehälter<br><br>\n";
echo "<a href=\"./AST_VICIDIAL_hopperlist.php?group=$campaign_id\">Klicken Sie hier, um zu sehen, welche Leitungen im Zufuhrbehälter imAugenblick sind</a><br><br>\n";
echo "<a href=\"$PHP_SELF?ADD=81&campaign_id=$campaign_id\">Klicken Sie hier, um alle Wiederholungsbesuch Einflüsse in dieserKampagne zu sehen</a><BR><BR>\n";
echo "<a href=\"./AST_VDADstats.php?group=$campaign_id\">Click here to see a VDAD report for this campaign</a><BR><BR>\n";
echo "</b></center>\n";

echo "<br>\n";

echo "<a href=\"$PHP_SELF?ADD=52&campaign_id=$campaign_id\">LOGGEN SIE ALLE MITTEL AUS DIESER KAMPAGNE HERAUS</a><BR><BR>\n";


if ($LOGdelete_campaigns > 0)
	{
	echo "<br><br><a href=\"$PHP_SELF?ADD=51&campaign_id=$campaign_id\">LÖSCHEN SIE DIESE KAMPAGNE</a>\n";
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
echo "<TABLE><TR><TD>\n";
	echo "<FONT FACE=\"ARIAL,HELVETICA\" COLOR=BLACK SIZE=2>";

	$stmt="SELECT * from vicidial_lists where list_id='$list_id';";
	$rslt=mysql_query($stmt, $link);
	$row=mysql_fetch_row($rslt);
	$campaign_id = $row[2];
	$active = $row[3];

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


echo "<br>ÄNDERN Sie Einen LISTEN SATZ: $row[0]<form action=$PHP_SELF method=POST>\n";
echo "<input type=hidden name=ADD value=411>\n";
echo "<input type=hidden name=list_id value=\"$row[0]\">\n";
echo "<input type=hidden name=old_campaign_id value=\"$row[2]\">\n";
echo "<center><TABLE width=600 cellspacing=3>\n";
echo "<tr bgcolor=#B6D3FC><td align=right>Liste Identifikation: </td><td align=left><b>$row[0]</b>$NWB#vicidial_lists-list_id$NWE</td></tr>\n";
echo "<tr bgcolor=#B6D3FC><td align=right>Liste Name: </td><td align=left><input type=text name=list_name size=20 maxlength=20 value=\"$row[1]\">$NWB#vicidial_lists-list_name$NWE</td></tr>\n";
echo "<tr bgcolor=#B6D3FC><td align=right><a href=\"$PHP_SELF?ADD=34&campaign_id=$campaign_id\">Kampagne</a>: </td><td align=left><select size=1 name=campaign_id>\n";

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
echo "<tr bgcolor=#B6D3FC><td align=right>Aktiv:</td><td align=left><select size=1 name=active><option>Y</option><option>N</option><option SELECTED>$active</option></select>$NWB#vicidial_lists-active$NWE</td></tr>\n";
echo "<tr bgcolor=#B6D3FC><td align=right>Stellen Sie Führen-Benennen-Status für diese Liste zurück: </td><td align=left><select size=1 name=reset_list><option>Y</option><option SELECTED>N</option></select>$NWB#vicidial_lists-reset_list$NWE</td></tr>\n";
echo "<tr bgcolor=#B6D3FC><td align=center colspan=2><input type=submit name=SUBMIT value=SUBMIT></td></tr>\n";
echo "</TABLE></center>\n";

echo "<center>\n";
echo "<br><b>STATUS INNERHALB DIESER LISTE:</b><br>\n";
echo "<TABLE width=500 cellspacing=3>\n";
echo "<tr><td>STATUS</td><td>STATUS-NAME</td><td>BENANNT</td><td>NICHT BENANNT</td></tr>\n";

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

echo "<tr><td colspan=2><font size=1>TEILSUMMEN</td><td><font size=1>$lead_list[Y_count]</td><td><font size=1>$lead_list[N_count]</td></tr>\n";
echo "<tr bgcolor=\"#9BB9FB\"><td><font size=1>GESAMTMENGE</td><td colspan=3 align=center><font size=1>$lead_list[count]</td></tr>\n";

echo "</table></center><br>\n";
unset($lead_list);





echo "<center>\n";
echo "<br><b>ZEIT-ZONEN INNERHALB DIESER LISTE:</b><br>\n";
echo "<TABLE width=500 cellspacing=3>\n";
echo "<tr><td>GMT VERSETZTE JETZT (lokale Zeit)</td><td>BENANNT</td><td>NICHT BENANNT</td></tr>\n";

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

echo "<tr><td><font size=1>TEILSUMMEN</td><td><font size=1>$lead_list[Y_count]</td><td><font size=1>$lead_list[N_count]</td></tr>\n";
echo "<tr bgcolor=\"#9BB9FB\"><td><font size=1>GESAMTMENGE</td><td colspan=2 align=center><font size=1>$lead_list[count]</td></tr>\n";

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
echo "<br><b>BENANNTE ZÄHLIMPULSE INNERHALB DIESER LISTE:</b><br>\n";
echo "<TABLE width=500 cellspacing=1>\n";
echo "<tr><td align=left><font size=1>STATUS</td><td align=center><font size=1>STATUS-NAME</td>";
$first = $all_called_first;
while ($first <= $all_called_last)
	{
	if (eregi("1$|3$|5$|7$|9$", $first)) {$AB='bgcolor="#AFEEEE"';} 
	else{$AB='bgcolor="#E0FFFF"';}
	echo "<td align=center $AB><font size=1>$first</td>";
	$first++;
	}
echo "<td align=center><font size=1>TEILSUMME</td></tr>\n";

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

echo "<tr><td align=center colspan=2><b><font size=1>GESAMTMENGE</td>";
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

if ($LOGdelete_lists > 0)
	{
	echo "<br><br><a href=\"$PHP_SELF?ADD=511&list_id=$list_id\">LÖSCHEN SIE DIESE LISTE</a>\n";
	}

}



######################
# ADD=3111 modify in-group info in the system
######################

if ($ADD==3111)
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

echo "<br>ÄNDERN Sie Einen GRUPPEN SATZ: $row[0]<form action=$PHP_SELF method=POST>\n";
echo "<input type=hidden name=ADD value=4111>\n";
echo "<input type=hidden name=group_id value=\"$row[0]\">\n";
echo "<center><TABLE width=600 cellspacing=3>\n";
echo "<tr bgcolor=#B6D3FC><td align=right>Gruppe Identifikation: </td><td align=left><b>$row[0]</b>$NWB#vicidial_inbound_groups-group_id$NWE</td></tr>\n";
echo "<tr bgcolor=#B6D3FC><td align=right>Gruppe Name: </td><td align=left><input type=text name=group_name size=30 maxlength=30 value=\"$row[1]\">$NWB#vicidial_inbound_groups-group_name$NWE</td></tr>\n";
echo "<tr bgcolor=#B6D3FC><td align=right>Gruppe Farbe: </td><td align=left bgcolor=\"$row[2]\"><input type=text name=group_color size=7 maxlength=7 value=\"$row[2]\">$NWB#vicidial_inbound_groups-group_color$NWE</td></tr>\n";
echo "<tr bgcolor=#B6D3FC><td align=right>Aktiv:</td><td align=left><select size=1 name=active><option>Y</option><option>N</option><option SELECTED>$active</option></select>$NWB#vicidial_inbound_groups-active$NWE</td></tr>\n";
echo "<tr bgcolor=#B6D3FC><td align=right>Netz-Form: </td><td align=left><input type=text name=web_form_address size=50 maxlength=255 value=\"$web_form_address\">$NWB#vicidial_inbound_groups-web_form_address$NWE</td></tr>\n";
echo "<tr bgcolor=#B6D3FC><td align=right>Folgender Vertreter-Anruf: </td><td align=left><select size=1 name=next_agent_call><option >random</option><option>oldest_call_start</option><option>oldest_call_finish</option><option>overall_user_level</option><option SELECTED>$next_agent_call</option></select>$NWB#vicidial_inbound_groups-next_agent_call$NWE</td></tr>\n";
echo "<tr bgcolor=#B6D3FC><td align=right>Fronter Anzeige: </td><td align=left><select size=1 name=fronter_display><option>Y</option><option>N</option><option SELECTED>$fronter_display</option></select>$NWB#vicidial_inbound_groups-fronter_display$NWE</td></tr>\n";

echo "<tr bgcolor=#B6D3FC><td align=right><a href=\"$PHP_SELF?ADD=3111111&script_id=$script_id\">Script</a>: </td><td align=left><select size=1 name=script_id>\n";
echo "$scripts_list";
echo "<option selected value=\"$script_id\">$script_id - $scriptname_list[$script_id]</option>\n";
echo "</select>$NWB#vicidial_inbound_groups-ingroup_script$NWE</td></tr>\n";
echo "<tr bgcolor=#B6D3FC><td align=right>Erhalten Sie Anruf-Produkteinführung: </td><td align=left><select size=1 name=get_call_launch><option selected>NONE</option><option>SCRIPT</option><option>WEBFORM</option><option selected>$get_call_launch</option></select>$NWB#vicidial_inbound_groups-get_call_launch$NWE</td></tr>\n";

echo "<tr bgcolor=#B6D3FC><td align=right>BringenSie DTMF 1: </td><td align=left><input type=text name=xferconf_a_dtmf size=20 maxlength=50 value=\"$xferconf_a_dtmf\">$NWB#vicidial_inbound_groups-xferconf_a_dtmf$NWE</td></tr>\n";

echo "<tr bgcolor=#B6D3FC><td align=right>BringenSie Zahl 1: </td><td align=left><input type=text name=xferconf_a_number size=20 maxlength=50 value=\"$xferconf_a_number\">$NWB#vicidial_inbound_groups-xferconf_a_dtmf$NWE</td></tr>\n";

echo "<tr bgcolor=#B6D3FC><td align=right>BringenSie DTMF 2: </td><td align=left><input type=text name=xferconf_b_dtmf size=20 maxlength=50 value=\"$xferconf_b_dtmf\">$NWB#vicidial_inbound_groups-xferconf_a_dtmf$NWE</td></tr>\n";

echo "<tr bgcolor=#B6D3FC><td align=right>BringenSie Zahl 2: </td><td align=left><input type=text name=xferconf_b_number size=20 maxlength=50 value=\"$xferconf_b_number\">$NWB#vicidial_inbound_groups-xferconf_a_dtmf$NWE</td></tr>\n";

echo "<tr bgcolor=#B6D3FC><td align=right>Verbindungsaufbau Sekunden: </td><td align=left><input type=text name=drop_call_seconds size=5 maxlength=4 value=\"$drop_call_seconds\">$NWB#vicidial_inbound_groups-drop_call_seconds$NWE</td></tr>\n";

echo "<tr bgcolor=#B6D3FC><td align=right>Voicemail: </td><td align=left><input type=text name=voicemail_ext size=10 maxlength=10 value=\"$voicemail_ext\">$NWB#vicidial_inbound_groups-voicemail_ext$NWE</td></tr>\n";

echo "<tr bgcolor=#B6D3FC><td align=right>Benutze Verbindungsaufbaunachricht: </td><td align=left><select size=1 name=drop_message><option>Y</option><option>N</option><option SELECTED>$drop_message</option></select>$NWB#vicidial_inbound_groups-drop_message$NWE</td></tr>\n";

echo "<tr bgcolor=#B6D3FC><td align=right>Verbindungsaufbaunebenstelle: </td><td align=left><input type=text name=drop_exten size=10 maxlength=20 value=\"$drop_exten\">$NWB#vicidial_inbound_groups-drop_exten$NWE</td></tr>\n";


echo "<tr bgcolor=#B6D3FC><td align=center colspan=2><input type=submit name=SUBMIT value=SUBMIT></td></tr>\n";
echo "</TABLE></center>\n";

echo "</table></center><br>\n";

echo "<a href=\"./AST_CLOSERstats.php?group=$group_id\">Click here to see a report for this campaign</a><BR><BR>\n";

echo "<center><b>\n";

if ($LOGdelete_ingroups > 0)
	{
	echo "<br><br><a href=\"$PHP_SELF?ADD=53&campaign_id=$group_id&stage=IN\">EMERGENCY VDAC CLEAR FOR THIS IN-GROUP</a><BR><BR>\n";
	echo "<br><br><a href=\"$PHP_SELF?ADD=5111&group_id=$group_id\">LÖSCHEN SIE DIESES IN-GROUP</a>\n";
	}

}



######################
# ADD=31111 modify remote agents info in the system
######################

if ($ADD==31111)
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

echo "<br>ÄNDERN Sie Eine REMOTEMITTEL-EINTRAGUNG: $row[0]<form action=$PHP_SELF method=POST>\n";
echo "<input type=hidden name=ADD value=41111>\n";
echo "<input type=hidden name=remote_agent_id value=\"$row[0]\">\n";
echo "<center><TABLE width=600 cellspacing=3>\n";
echo "<tr bgcolor=#B6D3FC><td align=right>Benutzernummer Anfang: </td><td align=left><input type=text name=user_start size=6 maxlength=6 value=\"$user_start\"> (nur Zahlen, incremented)$NWB#vicidial_remote_agents-user_start$NWE</td></tr>\n";
echo "<tr bgcolor=#B6D3FC><td align=right>Zeilenzahl: </td><td align=left><input type=text name=number_of_lines size=3 maxlength=3 value=\"$number_of_lines\"> (nur Zahlen)$NWB#vicidial_remote_agents-number_of_lines$NWE</td></tr>\n";
echo "<tr bgcolor=#B6D3FC><td align=right>Bediener IP: </td><td align=left><select size=1 name=server_ip>\n";
echo "$servers_list";
echo "<option SELECTED>$row[3]</option>\n";
echo "</select>$NWB#vicidial_remote_agents-server_ip$NWE</td></tr>\n";
echo "<tr bgcolor=#B6D3FC><td align=right>Externe Verlängerung: </td><td align=left><input type=text name=conf_exten size=20 maxlength=20 value=\"$conf_exten\"> (dialplan Zahl wählte, um Mittel zu erreichen)$NWB#vicidial_remote_agents-conf_exten$NWE</td></tr>\n";
echo "<tr bgcolor=#B6D3FC><td align=right>Status:</td><td align=left><select size=1 name=status><option SELECTED>AKTIV</option><option>INACTIVE</option><option SELECTED>$status</option></select>$NWB#vicidial_remote_agents-status$NWE</td></tr>\n";
echo "<tr bgcolor=#B6D3FC><td align=right>Kampagne: </td><td align=left><select size=1 name=campaign_id>\n";
echo "$campaigns_list";
echo "<option SELECTED>$campaign_id</option>\n";
echo "</select>$NWB#vicidial_remote_agents-campaign_id$NWE</td></tr>\n";
echo "<tr bgcolor=#B6D3FC><td align=right>Inbound Gruppen: </td><td align=left>\n";
echo "$groups_list";
echo "$NWB#vicidial_remote_agents-closer_campaigns$NWE</td></tr>\n";
echo "<tr bgcolor=#B6D3FC><td align=center colspan=2><input type=submit name=SUBMIT value=SUBMIT></td></tr>\n";
echo "</TABLE></center>\n";
echo "ANMERKUNG: Sie kann bis 30 Sekunden für die Änderungen dauern, dieauf diesem Schirm eingereicht werden, um Phasen zu gehen\n";


if ($LOGdelete_remote_agents > 0)
	{
	echo "<br><br><a href=\"$PHP_SELF?ADD=51111&remote_agent_id=$remote_agent_id\">LÖSCHEN SIE DIESES REMOTEMITTEL</a>\n";
	}

}


######################
# ADD=311111 modify user group info in the system
######################

if ($ADD==311111)
{
echo "<TABLE><TR><TD>\n";
	echo "<FONT FACE=\"ARIAL,HELVETICA\" COLOR=BLACK SIZE=2>";

	$stmt="SELECT * from vicidial_user_groups where user_group='$user_group';";
	$rslt=mysql_query($stmt, $link);
	$row=mysql_fetch_row($rslt);
	$user_group =		$row[0];
	$group_name =		$row[1];
echo "<FONT FACE=\"ARIAL,HELVETICA\" COLOR=BLACK SIZE=2>";

echo "<br>ÄNDERN Sie Eine BENUTZER-GRUPPE EINTRAGUNG<form action=$PHP_SELF method=POST>\n";
echo "<input type=hidden name=ADD value=411111>\n";
echo "<input type=hidden name=OLDuser_group value=\"$user_group\">\n";
echo "<center><TABLE width=600 cellspacing=3>\n";
echo "<tr bgcolor=#B6D3FC><td align=right>Gruppe:</td><td align=left><input type=text name=user_group size=15 maxlength=20 value=\"$user_group\"> (keine Räume oder Interpunktion)$NWB#vicidial_user_groups-user_group$NWE</td></tr>\n";
echo "<tr bgcolor=#B6D3FC><td align=right>Beschreibung:</td><td align=left><input type=text name=group_name size=40 maxlength=40 value=\"$group_name\"> (Beschreibung der Gruppe)$NWB#vicidial_user_groups-group_name$NWE</td></tr>\n";
echo "<tr bgcolor=#B6D3FC><td align=right>Erlaubte Kampagnen: </td><td align=left>\n";
echo "$campaigns_list";
echo "$NWB#vicidial_user_groups-allowed_campaigns$NWE</td></tr>\n";
echo "<tr bgcolor=#B6D3FC><td align=center colspan=2><input type=submit name=SUBMIT value=SUBMIT></td></tr>\n";
echo "</TABLE></center>\n";

if ($LOGdelete_user_groups > 0)
	{
	echo "<br><br><a href=\"$PHP_SELF?ADD=511111&user_group=$user_group\">LÖSCHEN SIE DIESE BENUTZER-GRUPPE</a>\n";
	}

}


######################
# ADD=3111111 modify script info in the system
######################

if ($ADD==3111111)
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

echo "<br>ÄNDERN Sie Einen INDEX<form action=$PHP_SELF method=POST>\n";
echo "<input type=hidden name=ADD value=4111111>\n";
echo "<input type=hidden name=script_id value=\"$script_id\">\n";
echo "<tr bgcolor=#B6D3FC><td align=right>Index Identifikation: </td><td align=left><B>$script_id</B>$NWB#vicidial_scripts-script_name$NWE</td></tr>\n";
echo "<tr bgcolor=#B6D3FC><td align=right>Index-Name: </td><td align=left><input type=text name=script_name size=40 maxlength=50 value=\"$script_name\"> (Titel dem Index)$NWB#vicidial_scripts-script_name$NWE</td></tr>\n";
echo "<tr bgcolor=#B6D3FC><td align=right>Index-Anmerkungen: </td><td align=left><input type=text name=script_comments size=50 maxlength=255 value=\"$script_comments\"> $NWB#vicidial_scripts-script_comments$NWE</td></tr>\n";
echo "<tr bgcolor=#B6D3FC><td align=right>Aktiv:</td><td align=left><select size=1 name=active><option SELECTED>Y</option><option>N</option><option selected>$active</option></select>$NWB#vicidial_scripts-active$NWE</td></tr>\n";
echo "<tr bgcolor=#B6D3FC><td align=right>Index-Text: <BR><BR><B><a href=\"javascript:openNewWindow('$PHP_SELF?ADD=7111111&script_id=$script_id')\">Vorbetrachtung-Index</a></B> </td><td align=left><TEXTAREA NAME=script_text ROWS=20 COLS=50>$script_text</TEXTAREA> $NWB#vicidial_scripts-script_text$NWE</td></tr>\n";
echo "<tr bgcolor=#B6D3FC><td align=center colspan=2><input type=submit name=SUBMIT value=SUBMIT></td></tr>\n";
echo "</TABLE></center>\n";

if ($LOGdelete_scripts > 0)
	{
	echo "<br><br><a href=\"$PHP_SELF?ADD=5111111&script_id=$script_id\">LÖSCHEN SIE DIESEN INDEX</a>\n";
	}

}


######################
# ADD=31111111 modify filter info in the system
######################

if ($ADD==31111111)
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

echo "<br>ÄNDERN Sie Einen FILTER<form action=$PHP_SELF method=POST>\n";
echo "<input type=hidden name=ADD value=41111111>\n";
echo "<input type=hidden name=lead_filter_id value=\"$lead_filter_id\">\n";
echo "<tr bgcolor=#B6D3FC><td align=right>Filter Identifikation:</td><td align=left><B>$lead_filter_id</B>$NWB#vicidial_lead_filters-lead_filter_id$NWE</td></tr>\n";
echo "<tr bgcolor=#B6D3FC><td align=right>Filter-Name:</td><td align=left><input type=text name=lead_filter_name size=40 maxlength=50 value=\"$lead_filter_name\"> (kurze Beschreibung des Filter)$NWB#vicidial_lead_filters-lead_filter_name$NWE</td></tr>\n";
echo "<tr bgcolor=#B6D3FC><td align=right>Filter-Anmerkungen:</td><td align=left><input type=text name=lead_filter_comments size=50 maxlength=255 value=\"$lead_filter_comments\"> $NWB#vicidial_lead_filters-lead_filter_comments$NWE</td></tr>\n";
echo "<tr bgcolor=#B6D3FC><td align=right>Filter Sql:</td><td align=left><TEXTAREA NAME=lead_filter_sql ROWS=20 COLS=50>$lead_filter_sql</TEXTAREA> $NWB#vicidial_lead_filters-lead_filter_sql$NWE</td></tr>\n";
echo "<tr bgcolor=#B6D3FC><td align=center colspan=2><input type=submit name=SUBMIT value=SUBMIT></td></tr>\n";
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
echo "<br>Testen der Kampagne: <form action=$PHP_SELF method=POST target=\"_blank\">\n";
echo "<input type=hidden name=lead_filter_id value=\"$lead_filter_id\">\n";
echo "<input type=hidden name=ADD value=\"73\">\n";
echo "<select size=1 name=campaign_id>\n";
echo "$campaigns_list";
echo "</select>\n";
echo "<input type=submit name=SUBMIT value=SUBMIT>\n";


if ($LOGdelete_filters > 0)
	{
	echo "<br><br><a href=\"$PHP_SELF?ADD=51111111&lead_filter_id=$lead_filter_id\">LÖSCHEN SIE DIESEN FILTER</a>\n";
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
	echo "Landesrichtlinie hinzugefügt: $state_rule<BR>\n";
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
	echo "Landesrichlinie gelöscht: $state_rule<BR>\n";
	}

$ADD=311111111;
}
else
{
echo "Sie haben nicht die Rechte, um diese Seite anzusehen. Bitte zurück gehen.";
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

echo "<br>Bearbeite eine Anrufzeit<form action=$PHP_SELF method=POST>\n";
echo "<input type=hidden name=ADD value=411111111>\n";
echo "<input type=hidden name=call_time_id value=\"$call_time_id\">\n";
echo "<tr bgcolor=#B6D3FC><td align=right>Anrufzeit ID: </td><td align=left colspan=3><B>$call_time_id</B>$NWB#vicidial_call_times-call_time_id$NWE</td></tr>\n";
echo "<tr bgcolor=#B6D3FC><td align=right>Anrufzeit Name: </td><td align=left colspan=3><input type=text name=call_time_name size=40 maxlength=50 value=\"$call_time_name\"> (Kurze Beschreibung der Anrufzeit)$NWB#vicidial_call_times-call_time_name$NWE</td></tr>\n";
echo "<tr bgcolor=#B6D3FC><td align=right>Anrufzeit Kommentare: </td><td align=left colspan=3><input type=text name=call_time_comments size=50 maxlength=255 value=\"$call_time_comments\"> $NWB#vicidial_call_times-call_time_comments$NWE</td></tr>\n";
echo "<tr bgcolor=#B6D3FC><td align=right>Standard Start</td><td align=left><input type=text name=ct_default_start size=5 maxlength=4 value=\"$ct_default_start\"> </td><td align=right>Standard Stop</td><td align=left><input type=text name=ct_default_stop size=5 maxlength=4 value=\"$ct_default_stop\"> $NWB#vicidial_call_times-ct_default_start$NWE</td></tr>\n";
echo "<tr bgcolor=#B6D3FC><td align=right>Sonntag Start</td><td align=left><input type=text name=ct_sunday_start size=5 maxlength=4 value=\"$ct_sunday_start\"> </td><td align=right>Sonntag Stop</td><td align=left><input type=text name=ct_sunday_stop size=5 maxlength=4 value=\"$ct_sunday_stop\"> $NWB#vicidial_call_times-ct_sunday_start$NWE</td></tr>\n";
echo "<tr bgcolor=#B6D3FC><td align=right>Montag Start</td><td align=left><input type=text name=ct_monday_start size=5 maxlength=4 value=\"$ct_monday_start\"> </td><td align=right>Montag Stop</td><td align=left><input type=text name=ct_monday_stop size=5 maxlength=4 value=\"$ct_monday_stop\"> $NWB#vicidial_call_times-ct_sunday_start$NWE</td></tr>\n";
echo "<tr bgcolor=#B6D3FC><td align=right>Dienstag Start</td><td align=left><input type=text name=ct_tuesday_start size=5 maxlength=4 value=\"$ct_tuesday_start\"> </td><td align=right>Dienstag Stop</td><td align=left><input type=text name=ct_tuesday_stop size=5 maxlength=4 value=\"$ct_tuesday_stop\"> $NWB#vicidial_call_times-ct_sunday_start$NWE</td></tr>\n";
echo "<tr bgcolor=#B6D3FC><td align=right>Mittwoch Start</td><td align=left><input type=text name=ct_wednesday_start size=5 maxlength=4 value=\"$ct_wednesday_start\"> </td><td align=right>Mittwoch Stop</td><td align=left><input type=text name=ct_wednesday_stop size=5 maxlength=4 value=\"$ct_wednesday_stop\"> $NWB#vicidial_call_times-ct_sunday_start$NWE</td></tr>\n";
echo "<tr bgcolor=#B6D3FC><td align=right>Donnerstag Start</td><td align=left><input type=text name=ct_thursday_start size=5 maxlength=4 value=\"$ct_thursday_start\"> </td><td align=right>Donnerstag Stop</td><td align=left><input type=text name=ct_thursday_stop size=5 maxlength=4 value=\"$ct_thursday_stop\"> $NWB#vicidial_call_times-ct_sunday_start$NWE</td></tr>\n";
echo "<tr bgcolor=#B6D3FC><td align=right>Freitag Start</td><td align=left><input type=text name=ct_friday_start size=5 maxlength=4 value=\"$ct_friday_start\"> </td><td align=right>Freitag Stop</td><td align=left><input type=text name=ct_friday_stop size=5 maxlength=4 value=\"$ct_friday_stop\"> $NWB#vicidial_call_times-ct_sunday_start$NWE</td></tr>\n";
echo "<tr bgcolor=#B6D3FC><td align=right>Sonnabend Start</td><td align=left><input type=text name=ct_saturday_start size=5 maxlength=4 value=\"$ct_saturday_start\"> </td><td align=right>Sonnabend Stop</td><td align=left><input type=text name=ct_saturday_stop size=5 maxlength=4 value=\"$ct_saturday_stop\"> $NWB#vicidial_call_times-ct_sunday_start$NWE</td></tr>\n";
echo "<tr bgcolor=#B6D3FC><td align=center colspan=4><input type=submit name=SUBMIT value=SUBMIT></FORM></td></tr>\n";

$ct_srs=1;
$b=0;
$srs_SQL ='';
if (strlen($ct_state_call_times)>2)
	{
	$state_rules = explode('|',$ct_state_call_times);
	$ct_srs = ((count($state_rules)) - 1);
	}
echo "<tr bgcolor=#B6D3FC><td align=center rowspan=$ct_srs>Aktive landesspezifische Anrufzeit Definitionen für diese Aufnahme: </td>\n";
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
echo "<td align=center colspan=4><input type=submit name=SUBMIT value=SUBMIT></FORM></td></tr>\n";

echo "</TABLE><BR><BR>\n";
echo "<B>Kampagnen, die diese Anrufzeit nutzen:</B><BR>\n";
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
	echo "<br><br><a href=\"$PHP_SELF?ADD=511111111&call_time_id=$call_time_id\">Lösche diese Anrufzeit Definition</a>\n";
	}
}
else
{
echo "Sie haben nicht die Rechte, um diese Seite anzusehen. Bitte zurück gehen.";
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

echo "<br>Bearbeite eine landesspezifische Anrufzeit<form action=$PHP_SELF method=POST>\n";
echo "<input type=hidden name=ADD value=4111111111>\n";
echo "<input type=hidden name=call_time_id value=\"$call_time_id\">\n";
echo "<tr bgcolor=#B6D3FC><td align=right>Anrufzeit ID: </td><td align=left colspan=3><B>$call_time_id</B>$NWB#vicidial_call_times-call_time_id$NWE</td></tr>\n";
echo "<tr bgcolor=#B6D3FC><td align=right>State Call Time State: </td><td align=left colspan=3><input type=text name=state_call_time_state size=4 maxlength=2 value=\"$state_call_time_state\"> $NWB#vicidial_call_times-state_call_time_state$NWE</td></tr>\n";
echo "<tr bgcolor=#B6D3FC><td align=right>Landesspezifischer Anrufzeiten Name: </td><td align=left colspan=3><input type=text name=call_time_name size=40 maxlength=50 value=\"$call_time_name\"> (Kurze Beschreibung der Anrufzeit)$NWB#vicidial_call_times-call_time_name$NWE</td></tr>\n";
echo "<tr bgcolor=#B6D3FC><td align=right>Landesspezifischer Anrufzeiten Kommentar: </td><td align=left colspan=3><input type=text name=call_time_comments size=50 maxlength=255 value=\"$call_time_comments\"> $NWB#vicidial_call_times-call_time_comments$NWE</td></tr>\n";
echo "<tr bgcolor=#B6D3FC><td align=right>Standard Start</td><td align=left><input type=text name=ct_default_start size=5 maxlength=4 value=\"$ct_default_start\"> </td><td align=right>Standard Stop</td><td align=left><input type=text name=ct_default_stop size=5 maxlength=4 value=\"$ct_default_stop\"> $NWB#vicidial_call_times-ct_default_start$NWE</td></tr>\n";
echo "<tr bgcolor=#B6D3FC><td align=right>Sonntag Start</td><td align=left><input type=text name=ct_sunday_start size=5 maxlength=4 value=\"$ct_sunday_start\"> </td><td align=right>Sonntag Stop</td><td align=left><input type=text name=ct_sunday_stop size=5 maxlength=4 value=\"$ct_sunday_stop\"> $NWB#vicidial_call_times-ct_sunday_start$NWE</td></tr>\n";
echo "<tr bgcolor=#B6D3FC><td align=right>Montag Start</td><td align=left><input type=text name=ct_monday_start size=5 maxlength=4 value=\"$ct_monday_start\"> </td><td align=right>Montag Stop</td><td align=left><input type=text name=ct_monday_stop size=5 maxlength=4 value=\"$ct_monday_stop\"> $NWB#vicidial_call_times-ct_sunday_start$NWE</td></tr>\n";
echo "<tr bgcolor=#B6D3FC><td align=right>Dienstag Start</td><td align=left><input type=text name=ct_tuesday_start size=5 maxlength=4 value=\"$ct_tuesday_start\"> </td><td align=right>Dienstag Stop</td><td align=left><input type=text name=ct_tuesday_stop size=5 maxlength=4 value=\"$ct_tuesday_stop\"> $NWB#vicidial_call_times-ct_sunday_start$NWE</td></tr>\n";
echo "<tr bgcolor=#B6D3FC><td align=right>Mittwoch Start</td><td align=left><input type=text name=ct_wednesday_start size=5 maxlength=4 value=\"$ct_wednesday_start\"> </td><td align=right>Mittwoch Stop</td><td align=left><input type=text name=ct_wednesday_stop size=5 maxlength=4 value=\"$ct_wednesday_stop\"> $NWB#vicidial_call_times-ct_sunday_start$NWE</td></tr>\n";
echo "<tr bgcolor=#B6D3FC><td align=right>Donnerstag Start</td><td align=left><input type=text name=ct_thursday_start size=5 maxlength=4 value=\"$ct_thursday_start\"> </td><td align=right>Donnerstag Stop</td><td align=left><input type=text name=ct_thursday_stop size=5 maxlength=4 value=\"$ct_thursday_stop\"> $NWB#vicidial_call_times-ct_sunday_start$NWE</td></tr>\n";
echo "<tr bgcolor=#B6D3FC><td align=right>Freitag Start</td><td align=left><input type=text name=ct_friday_start size=5 maxlength=4 value=\"$ct_friday_start\"> </td><td align=right>Freitag Stop</td><td align=left><input type=text name=ct_friday_stop size=5 maxlength=4 value=\"$ct_friday_stop\"> $NWB#vicidial_call_times-ct_sunday_start$NWE</td></tr>\n";
echo "<tr bgcolor=#B6D3FC><td align=right>Sonnabend Start</td><td align=left><input type=text name=ct_saturday_start size=5 maxlength=4 value=\"$ct_saturday_start\"> </td><td align=right>Sonnabend Stop</td><td align=left><input type=text name=ct_saturday_stop size=5 maxlength=4 value=\"$ct_saturday_stop\"> $NWB#vicidial_call_times-ct_sunday_start$NWE</td></tr>\n";

echo "<tr bgcolor=#B6D3FC><td align=center colspan=4><input type=submit name=SUBMIT value=SUBMIT></td></tr>\n";
echo "</TABLE><BR><BR>\n";
echo "<B>Anrufzeiten, die diese landesspezifische Anrufzeit benutzen:</B><BR>\n";
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
	echo "<br><br><a href=\"$PHP_SELF?ADD=5111111111&call_time_id=$call_time_id\">Diese landesspezifische Anrufzeitdefinition löschen</a>\n";
	}

}
else
{
echo "Sie haben nicht die Rechte, um diese Seite anzusehen. Bitte zurück gehen.";
}

}


######################
# ADD=31111111111 modify phone record in the system
######################

if ($ADD==31111111111)
{
echo "<TABLE><TR><TD>\n";
	echo "<FONT FACE=\"ARIAL,HELVETICA\" COLOR=BLACK SIZE=2>";

	$stmt="SELECT * from phones where extension='$extension' and server_ip='$server_ip';";
	$rslt=mysql_query($stmt, $link);
	$row=mysql_fetch_row($rslt);

echo "<br>ÄNDERN Sie Einen TELEFON-SATZ: $row[1]<form action=$PHP_SELF method=POST>\n";
echo "<input type=hidden name=ADD value=41111111111>\n";
echo "<input type=hidden name=old_extension value=\"$row[0]\">\n";
echo "<input type=hidden name=old_server_ip value=\"$row[5]\">\n";
echo "<center><TABLE width=600 cellspacing=3>\n";
echo "<tr bgcolor=#B6D3FC><td align=right>Telefonverlängerung: </td><td align=left><input type=text name=extension size=20 maxlength=100 value=\"$row[0]\">$NWB#phones-extension$NWE</td></tr>\n";
echo "<tr bgcolor=#B6D3FC><td align=right>Dialplan Zahl: </td><td align=left><input type=text name=dialplan_number size=15 maxlength=20 value=\"$row[1]\"> (nur Stellen)$NWB#phones-dialplan_number$NWE</td></tr>\n";
echo "<tr bgcolor=#B6D3FC><td align=right>Voicemail Kasten: </td><td align=left><input type=text name=voicemail_id size=10 maxlength=10 value=\"$row[2]\"> (nur Stellen)$NWB#phones-voicemail_id$NWE</td></tr>\n";
echo "<tr bgcolor=#B6D3FC><td align=right>Outbound CallerID: </td><td align=left><input type=text name=outbound_cid size=10 maxlength=20 value=\"$row[65]\"> (nur Stellen)$NWB#phones-outbound_cid$NWE</td></tr>\n";
echo "<tr bgcolor=#B6D3FC><td align=right>Telefon-IP address: </td><td align=left><input type=text name=phone_ip size=20 maxlength=15 value=\"$row[3]\"> (optional)$NWB#phones-phone_ip$NWE</td></tr>\n";
echo "<tr bgcolor=#B6D3FC><td align=right>Computer-IP address: </td><td align=left><input type=text name=computer_ip size=20 maxlength=15 value=\"$row[4]\"> (optional)$NWB#phones-computer_ip$NWE</td></tr>\n";
echo "<tr bgcolor=#B6D3FC><td align=right><a href=\"$PHP_SELF?ADD=311111111111&server_ip=$row[5]\">Bediener IP</a>: </td><td align=left><select size=1 name=server_ip>\n";

echo "$servers_list";
echo "<option SELECTED>$row[5]</option>\n";
echo "</select>$NWB#phones-server_ip$NWE</td></tr>\n";
echo "<tr bgcolor=#B6D3FC><td align=right>Login: </td><td align=left><input type=text name=login size=10 maxlength=10 value=\"$row[6]\">$NWB#phones-login$NWE</td></tr>\n";
echo "<tr bgcolor=#B6D3FC><td align=right>Kennwort:</td><td align=left><input type=text name=pass size=10 maxlength=10 value=\"$row[7]\">$NWB#phones-pass$NWE</td></tr>\n";
echo "<tr bgcolor=#B6D3FC><td align=right>Status:</td><td align=left><select size=1 name=status><option>AKTIV</option><option>SUSPENDED</option><option>CLOSED</option><option>PENDING</option><option>ADMIN</option><option selected>$row[8]</option></select>$NWB#phones-status$NWE</td></tr>\n";
echo "<tr bgcolor=#B6D3FC><td align=right>Aktives Konto: </td><td align=left><select size=1 name=active><option>Y</option><option>N</option><option selected>$row[9]</option></select>$NWB#phones-active$NWE</td></tr>\n";
echo "<tr bgcolor=#B6D3FC><td align=right>Telefon-Art: </td><td align=left><input type=text name=phone_type size=20 maxlength=50 value=\"$row[10]\">$NWB#phones-phone_type$NWE</td></tr>\n";
echo "<tr bgcolor=#B6D3FC><td align=right>Voller Name: </td><td align=left><input type=text name=fullname size=20 maxlength=50 value=\"$row[11]\">$NWB#phones-fullname$NWE</td></tr>\n";
echo "<tr bgcolor=#B6D3FC><td align=right>Firma:</td><td align=left><input type=text name=company size=10 maxlength=10 value=\"$row[12]\">$NWB#phones-company$NWE</td></tr>\n";
echo "<tr bgcolor=#B6D3FC><td align=right>Abbildung:</td><td align=left><input type=text name=picture size=20 maxlength=19 value=\"$row[13]\">$NWB#phones-picture$NWE</td></tr>\n";
echo "<tr bgcolor=#B6D3FC><td align=right>Neue Anzeigen: </td><td align=left><b>$row[14]</b>$NWB#phones-messages$NWE</td></tr>\n";
echo "<tr bgcolor=#B6D3FC><td align=right>Alte Anzeigen: </td><td align=left><b>$row[15]</b>$NWB#phones-old_messages$NWE</td></tr>\n";
echo "<tr bgcolor=#B6D3FC><td align=right>Klient Protokoll: </td><td align=left><select size=1 name=protocol><option>SIP</option><option>Zap</option><option>IAX2</option><option>EXTERNAL</option><option selected>$row[16]</option></select>$NWB#phones-protocol$NWE</td></tr>\n";
echo "<tr bgcolor=#B6D3FC><td align=right>Lokales GMT: </td><td align=left><select size=1 name=local_gmt><option>12.75</option><option>12.00</option><option>11.00</option><option>10.00</option><option>9.50</option><option>9.00</option><option>8.00</option><option>7.00</option><option>6.50</option><option>6.00</option><option>5.75</option><option>5.50</option><option>5.00</option><option>4.50</option><option>4.00</option><option>3.50</option><option>3.00</option><option>2.00</option><option>1.00</option><option>0.00</option><option>-1.00</option><option>-2.00</option><option>-3.00</option><option>-3.50</option><option>-4.00</option><option>-5.00</option><option>-6.00</option><option>-7.00</option><option>-8.00</option><option>-9.00</option><option>-10.00</option><option>-11.00</option><option>-12.00</option><option selected>$row[17]</option></select> (Stellen Sie NICHT auf DST ein)$NWB#phones-local_gmt$NWE</td></tr>\n";
echo "<tr bgcolor=#B6D3FC><td align=right>Manager-LOGON: </td><td align=left><input type=text name=ASTmgrUSERNAME size=20 maxlength=20 value=\"$row[18]\">$NWB#phones-ASTmgrUSERNAME$NWE</td></tr>\n";
echo "<tr bgcolor=#B6D3FC><td align=right>Manager-Geheimnis: </td><td align=left><input type=text name=ASTmgrSECRET size=20 maxlength=20 value=\"$row[19]\">$NWB#phones-ASTmgrSECRET$NWE</td></tr>\n";
echo "<tr bgcolor=#B6D3FC><td align=right>VICIDIAL Rückstellung Benutzer: </td><td align=left><input type=text name=login_user size=20 maxlength=20 value=\"$row[20]\">$NWB#phones-login_user$NWE</td></tr>\n";
echo "<tr bgcolor=#B6D3FC><td align=right>VICIDIAL Rückstellung Durchlauf: </td><td align=left><input type=text name=login_pass size=20 maxlength=20 value=\"$row[21]\">$NWB#phones-login_pass$NWE</td></tr>\n";
echo "<tr bgcolor=#B6D3FC><td align=right>VICIDIAL Rückstellung Kampagne: </td><td align=left><input type=text name=login_campaign size=10 maxlength=10 value=\"$row[22]\">$NWB#phones-login_campaign$NWE</td></tr>\n";
echo "<tr bgcolor=#B6D3FC><td align=right>Park Exten: </td><td align=left><input type=text name=park_on_extension size=10 maxlength=10 value=\"$row[23]\">$NWB#phones-park_on_extension$NWE</td></tr>\n";
echo "<tr bgcolor=#B6D3FC><td align=right>Conf Exten: </td><td align=left><input type=text name=conf_on_extension size=10 maxlength=10 value=\"$row[24]\">$NWB#phones-conf_on_extension$NWE</td></tr>\n";
echo "<tr bgcolor=#B6D3FC><td align=right>VICIDIAL Park Exten: </td><td align=left><input type=text name=VICIDIAL_park_on_extension size=10 maxlength=10 value=\"$row[25]\">$NWB#phones-VICIDIAL_park_on_extension$NWE</td></tr>\n";
echo "<tr bgcolor=#B6D3FC><td align=right>VICIDIAL Park-Akte: </td><td align=left><input type=text name=VICIDIAL_park_on_filename size=10 maxlength=10 value=\"$row[26]\">$NWB#phones-VICIDIAL_park_on_filename$NWE</td></tr>\n";
echo "<tr bgcolor=#B6D3FC><td align=right>Überwachen Sie Präfix: </td><td align=left><input type=text name=monitor_prefix size=10 maxlength=10 value=\"$row[27]\">$NWB#phones-monitor_prefix$NWE</td></tr>\n";
echo "<tr bgcolor=#B6D3FC><td align=right>Aufnahme Exten: </td><td align=left><input type=text name=recording_exten size=10 maxlength=10 value=\"$row[28]\">$NWB#phones-recording_exten$NWE</td></tr>\n";
echo "<tr bgcolor=#B6D3FC><td align=right>VMailMain Exten: </td><td align=left><input type=text name=voicemail_exten size=10 maxlength=10 value=\"$row[29]\">$NWB#phones-voicemail_exten$NWE</td></tr>\n";
echo "<tr bgcolor=#B6D3FC><td align=right>VMailDump Exten: </td><td align=left><input type=text name=voicemail_dump_exten size=20 maxlength=20 value=\"$row[30]\">$NWB#phones-voicemail_dump_exten$NWE</td></tr>\n";
echo "<tr bgcolor=#B6D3FC><td align=right>Exten Kontext: </td><td align=left><input type=text name=ext_context size=20 maxlength=20 value=\"$row[31]\">$NWB#phones-ext_context$NWE</td></tr>\n";
echo "<tr bgcolor=#B6D3FC><td align=right>DTMFSend Führung: </td><td align=left><input type=text name=dtmf_send_extension size=40 maxlength=100 value=\"$row[32]\">$NWB#phones-dtmf_send_extension$NWE</td></tr>\n";
echo "<tr bgcolor=#B6D3FC><td align=right>Outbound Anruf-Gruppe: </td><td align=left><input type=text name=call_out_number_group size=40 maxlength=100 value=\"$row[33]\">$NWB#phones-call_out_number_group$NWE</td></tr>\n";
echo "<tr bgcolor=#B6D3FC><td align=right>Datenbanksuchroutine-Position: </td><td align=left><input type=text name=client_browser size=40 maxlength=100 value=\"$row[34]\">$NWB#phones-client_browser$NWE</td></tr>\n";
echo "<tr bgcolor=#B6D3FC><td align=right>Bringen Sie Verzeichnis An: </td><td align=left><input type=text name=install_directory size=40 maxlength=100 value=\"$row[35]\">$NWB#phones-install_directory$NWE</td></tr>\n";
echo "<tr bgcolor=#B6D3FC><td align=right>CallerID URL: </td><td align=left><input type=text name=local_web_callerID_URL size=40 maxlength=255 value=\"$row[36]\">$NWB#phones-local_web_callerID_URL$NWE</td></tr>\n";
echo "<tr bgcolor=#B6D3FC><td align=right>VICIDIAL Rückstellung URL: </td><td align=left><input type=text name=VICIDIAL_web_URL size=40 maxlength=255 value=\"$row[37]\">$NWB#phones-VICIDIAL_web_URL$NWE</td></tr>\n";
echo "<tr bgcolor=#B6D3FC><td align=right>Anruf-Protokollierung: </td><td align=left><select size=1 name=AGI_call_logging_enabled><option>1</option><option>0</option><option selected>$row[38]</option></select>$NWB#phones-AGI_call_logging_enabled$NWE</td></tr>\n";
echo "<tr bgcolor=#B6D3FC><td align=right>Benutzer-Schaltung: </td><td align=left><select size=1 name=user_switching_enabled><option>1</option><option>0</option><option selected>$row[39]</option></select>$NWB#phones-user_switching_enabled$NWE</td></tr>\n";
echo "<tr bgcolor=#B6D3FC><td align=right>Conferencing: </td><td align=left><select size=1 name=conferencing_enabled><option>1</option><option>0</option><option selected>$row[40]</option></select>$NWB#phones-conferencing_enabled$NWE</td></tr>\n";
echo "<tr bgcolor=#B6D3FC><td align=right>Admin Hängezustand: </td><td align=left><select size=1 name=admin_hangup_enabled><option>1</option><option>0</option><option selected>$row[41]</option></select>$NWB#phones-admin_hangup_enabled$NWE</td></tr>\n";
echo "<tr bgcolor=#B6D3FC><td align=right>Admin Straßenräuber: </td><td align=left><select size=1 name=admin_hijack_enabled><option>1</option><option>0</option><option selected>$row[42]</option></select>$NWB#phones-admin_hijack_enabled$NWE</td></tr>\n";
echo "<tr bgcolor=#B6D3FC><td align=right>Admin Monitor: </td><td align=left><select size=1 name=admin_monitor_enabled><option>1</option><option>0</option><option selected>$row[43]</option></select>$NWB#phones-admin_monitor_enabled$NWE</td></tr>\n";
echo "<tr bgcolor=#B6D3FC><td align=right>Parkschaltung: </td><td align=left><select size=1 name=call_parking_enabled><option>1</option><option>0</option><option selected>$row[44]</option></select>$NWB#phones-call_parking_enabled$NWE</td></tr>\n";
echo "<tr bgcolor=#B6D3FC><td align=right>Updater Überprüfung: </td><td align=left><select size=1 name=updater_check_enabled><option>1</option><option>0</option><option selected>$row[45]</option></select>$NWB#phones-updater_check_enabled$NWE</td></tr>\n";
echo "<tr bgcolor=#B6D3FC><td align=right>Af Protokollierung: </td><td align=left><select size=1 name=AFLogging_enabled><option>1</option><option>0</option><option selected>$row[46]</option></select>$NWB#phones-AFLogging_enabled$NWE</td></tr>\n";
echo "<tr bgcolor=#B6D3FC><td align=right>Warteschlange Ermöglicht: </td><td align=left><select size=1 name=QUEUE_ACTION_enabled><option>1</option><option>0</option><option selected>$row[47]</option></select>$NWB#phones-QUEUE_ACTION_enabled$NWE</td></tr>\n";
echo "<tr bgcolor=#B6D3FC><td align=right>CallerID Popup: </td><td align=left><select size=1 name=CallerID_popup_enabled><option>1</option><option>0</option><option selected>$row[48]</option></select>$NWB#phones-CallerID_popup_enabled$NWE</td></tr>\n";
echo "<tr bgcolor=#B6D3FC><td align=right>VMail Taste: </td><td align=left><select size=1 name=voicemail_button_enabled><option>1</option><option>0</option><option selected>$row[49]</option></select>$NWB#phones-voicemail_button_enabled$NWE</td></tr>\n";
echo "<tr bgcolor=#B6D3FC><td align=right>Schnell Erneuern Sie: </td><td align=left><select size=1 name=enable_fast_refresh><option>1</option><option>0</option><option selected>$row[50]</option></select>$NWB#phones-enable_fast_refresh$NWE</td></tr>\n";
echo "<tr bgcolor=#B6D3FC><td align=right>Schnell Erneuern Sie Rate: </td><td align=left><input type=text size=5 name=fast_refresh_rate value=\"$row[51]\">(in ms)$NWB#phones-fast_refresh_rate$NWE</td></tr>\n";
echo "<tr bgcolor=#B6D3FC><td align=right>Persistant MySQL: </td><td align=left><select size=1 name=enable_persistant_mysql><option>1</option><option>0</option><option selected>$row[52]</option></select>$NWB#phones-enable_persistant_mysql$NWE</td></tr>\n";
echo "<tr bgcolor=#B6D3FC><td align=right>Selbstvorwahlknopf-Folgende Zahl: </td><td align=left><select size=1 name=auto_dial_next_number><option>1</option><option>0</option><option selected>$row[53]</option></select>$NWB#phones-auto_dial_next_number$NWE</td></tr>\n";
echo "<tr bgcolor=#B6D3FC><td align=right>Stoppen Sie Rec nach jedem Anruf: </td><td align=left><select size=1 name=VDstop_rec_after_each_call><option>1</option><option>0</option><option selected>$row[54]</option></select>$NWB#phones-VDstop_rec_after_each_call$NWE</td></tr>\n";
echo "<tr bgcolor=#B6D3FC><td align=right>DBX Bediener: </td><td align=left><input type=text name=DBX_server size=15 maxlength=15 value=\"$row[55]\"> (HauptsächlichDB Server)$NWB#phones-DBX_server$NWE</td></tr>\n";
echo "<tr bgcolor=#B6D3FC><td align=right>DBX Datenbank: </td><td align=left><input type=text name=DBX_database size=15 maxlength=15 value=\"$row[56]\"> (HauptsächlichServer Database)$NWB#phones-DBX_database$NWE</td></tr>\n";
echo "<tr bgcolor=#B6D3FC><td align=right>DBX Benutzer: </td><td align=left><input type=text name=DBX_user size=15 maxlength=15 value=\"$row[57]\"> (HauptsächlichDB Login)$NWB#phones-DBX_user$NWE</td></tr>\n";
echo "<tr bgcolor=#B6D3FC><td align=right>DBX Durchlauf: </td><td align=left><input type=text name=DBX_pass size=15 maxlength=15 value=\"$row[58]\"> (HauptsächlichDB Secret)$NWB#phones-DBX_pass$NWE</td></tr>\n";
echo "<tr bgcolor=#B6D3FC><td align=right>DBX Tor: </td><td align=left><input type=text name=DBX_port size=6 maxlength=6 value=\"$row[59]\"> (HauptsächlichDB Port)$NWB#phones-DBX_port$NWE</td></tr>\n";
echo "<tr bgcolor=#B6D3FC><td align=right>DBY Bediener: </td><td align=left><input type=text name=DBY_server size=15 maxlength=15 value=\"$row[60]\"> (ZweitensDB Server)$NWB#phones-DBY_server$NWE</td></tr>\n";
echo "<tr bgcolor=#B6D3FC><td align=right>DBY Datenbank: </td><td align=left><input type=text name=DBY_database size=15 maxlength=15 value=\"$row[61]\"> (ZweitensServer Database)$NWB#phones-DBY_database$NWE</td></tr>\n";
echo "<tr bgcolor=#B6D3FC><td align=right>DBY Benutzer: </td><td align=left><input type=text name=DBY_user size=15 maxlength=15 value=\"$row[62]\"> (ZweitensDB Login)$NWB#phones-DBY_user$NWE</td></tr>\n";
echo "<tr bgcolor=#B6D3FC><td align=right>DBY Durchlauf: </td><td align=left><input type=text name=DBY_pass size=15 maxlength=15 value=\"$row[63]\"> (ZweitensDB Secret)$NWB#phones-DBY_pass$NWE</td></tr>\n";
echo "<tr bgcolor=#B6D3FC><td align=right>DBY Tor: </td><td align=left><input type=text name=DBY_port size=6 maxlength=6 value=\"$row[64]\"> (ZweitensDB Port)$NWB#phones-DBY_port$NWE</td></tr>\n";
echo "<tr bgcolor=#B6D3FC><td align=center colspan=2><input type=submit name=submit VALUE=SUBMIT></td></tr>\n";
echo "</TABLE></center>\n";

echo "<br><br><a href=\"./phone_stats.php?extension=$row[0]&server_ip=$row[5]\">Klicken Sie hier für Telefonnotfall</a>\n";

if ($LOGast_delete_phones > 0)
	{
	echo "<br><br><a href=\"$PHP_SELF?ADD=51111111111&extension=$extension&server_ip=$server_ip\">LÖSCHEN SIE DIESES TELEFON</a>\n";
	}
}


######################
# ADD=311111111111 modify server record in the system
######################

if ($ADD==311111111111)
{
echo "<TABLE><TR><TD>\n";
	echo "<FONT FACE=\"ARIAL,HELVETICA\" COLOR=BLACK SIZE=2>";

	$stmt="SELECT * from servers where server_id='$server_id' or server_ip='$server_ip';";
	$rslt=mysql_query($stmt, $link);
	$row=mysql_fetch_row($rslt);
	$server_id = $row[0];
	$server_ip = $row[2];

echo "<br>ÄNDERN Sie Einen BEDIENER-SATZ: $row[0]<form action=$PHP_SELF method=POST>\n";
echo "<input type=hidden name=ADD value=411111111111>\n";
echo "<input type=hidden name=old_server_id value=\"$server_id\">\n";
echo "<input type=hidden name=old_server_ip value=\"$row[2]\">\n";
echo "<center><TABLE width=600 cellspacing=3>\n";
echo "<tr bgcolor=#B6D3FC><td align=right>Bediener Identifikation: </td><td align=left><input type=text name=server_id size=10 maxlength=10 value=\"$row[0]\">$NWB#servers-server_id$NWE</td></tr>\n";
echo "<tr bgcolor=#B6D3FC><td align=right>Bediener-Beschreibung: </td><td align=left><input type=text name=server_description size=30 maxlength=255 value=\"$row[1]\">$NWB#servers-server_description$NWE</td></tr>\n";
echo "<tr bgcolor=#B6D3FC><td align=right>Bediener-IP address: </td><td align=left><input type=text name=server_ip size=20 maxlength=15 value=\"$row[2]\">$NWB#servers-server_ip$NWE</td></tr>\n";
echo "<tr bgcolor=#B6D3FC><td align=right>Aktiv:</td><td align=left><select size=1 name=active><option>Y</option><option>N</option><option selected>$row[3]</option></select>$NWB#servers-active$NWE</td></tr>\n";
echo "<tr bgcolor=#B6D3FC><td align=right>Sternchen-Version: </td><td align=left><input type=text name=asterisk_version size=20 maxlength=20 value=\"$row[4]\">$NWB#servers-asterisk_version$NWE</td></tr>\n";
echo "<tr bgcolor=#B6D3FC><td align=right>Maximale VICIDIAL Stämme: </td><td align=left><input type=text name=max_vicidial_trunks size=5 maxlength=4 value=\"$row[5]\">$NWB#servers-max_vicidial_trunks$NWE</td></tr>\n";
echo "<tr bgcolor=#B6D3FC><td align=right>VICIDIAL Balance Wählen: </td><td align=left><select size=1 name=vicidial_balance_active><option>Y</option><option>N</option><option selected>$row[20]</option></select>$NWB#servers-vicidial_balance_active$NWE</td></tr>\n";
echo "<tr bgcolor=#B6D3FC><td align=right>VICIDIAL Balance Offlimits: </td><td align=left><input type=text name=balance_trunks_offlimits size=5 maxlength=4 value=\"$row[21]\">$NWB#servers-balance_trunks_offlimits$NWE</td></tr>\n";
echo "<tr bgcolor=#B6D3FC><td align=right>Telnet Wirt: </td><td align=left><input type=text name=telnet_host size=20 maxlength=20 value=\"$row[6]\">$NWB#servers-telnet_host$NWE</td></tr>\n";
echo "<tr bgcolor=#B6D3FC><td align=right>Telnet Tor: </td><td align=left><input type=text name=telnet_port size=6 maxlength=5 value=\"$row[7]\">$NWB#servers-telnet_port$NWE</td></tr>\n";
echo "<tr bgcolor=#B6D3FC><td align=right>Manager-Benutzer: </td><td align=left><input type=text name=ASTmgrUSERNAME size=20 maxlength=20 value=\"$row[8]\">$NWB#servers-ASTmgrUSERNAME$NWE</td></tr>\n";
echo "<tr bgcolor=#B6D3FC><td align=right>Manager-Geheimnis: </td><td align=left><input type=text name=ASTmgrSECRET size=20 maxlength=20 value=\"$row[9]\">$NWB#servers-ASTmgrSECRET$NWE</td></tr>\n";
echo "<tr bgcolor=#B6D3FC><td align=right>Manager-Update-Benutzer: </td><td align=left><input type=text name=ASTmgrUSERNAMEupdate size=20 maxlength=20 value=\"$row[10]\">$NWB#servers-ASTmgrUSERNAMEupdate$NWE</td></tr>\n";
echo "<tr bgcolor=#B6D3FC><td align=right>Manager Hören Benutzer: </td><td align=left><input type=text name=ASTmgrUSERNAMElisten size=20 maxlength=20 value=\"$row[11]\">$NWB#servers-ASTmgrUSERNAMElisten$NWE</td></tr>\n";
echo "<tr bgcolor=#B6D3FC><td align=right>Manager Senden Benutzer: </td><td align=left><input type=text name=ASTmgrUSERNAMEsend size=20 maxlength=20 value=\"$row[12]\">$NWB#servers-ASTmgrUSERNAMEsend$NWE</td></tr>\n";
echo "<tr bgcolor=#B6D3FC><td align=right>Lokales GMT: </td><td align=left><select size=1 name=local_gmt><option>12.75</option><option>12.00</option><option>11.00</option><option>10.00</option><option>9.50</option><option>9.00</option><option>8.00</option><option>7.00</option><option>6.50</option><option>6.00</option><option>5.75</option><option>5.50</option><option>5.00</option><option>4.50</option><option>4.00</option><option>3.50</option><option>3.00</option><option>2.00</option><option>1.00</option><option>0.00</option><option>-1.00</option><option>-2.00</option><option>-3.00</option><option>-3.50</option><option>-4.00</option><option>-5.00</option><option>-6.00</option><option>-7.00</option><option>-8.00</option><option>-9.00</option><option>-10.00</option><option>-11.00</option><option>-12.00</option><option selected>$row[13]</option></select> (Stellen Sie NICHT auf DST ein)$NWB#servers-local_gmt$NWE</td></tr>\n";
echo "<tr bgcolor=#B6D3FC><td align=right>VMail Dump Exten: </td><td align=left><input type=text name=voicemail_dump_exten size=20 maxlength=20 value=\"$row[14]\">$NWB#servers-voicemail_dump_exten$NWE</td></tr>\n";
echo "<tr bgcolor=#B6D3FC><td align=right>VICIDIAL ANZEIGE Verlängerung: </td><td align=left><input type=text name=answer_transfer_agent size=20 maxlength=20 value=\"$row[15]\">$NWB#servers-answer_transfer_agent$NWE</td></tr>\n";
echo "<tr bgcolor=#B6D3FC><td align=right>Rückstellung Kontext: </td><td align=left><input type=text name=ext_context size=20 maxlength=20 value=\"$row[16]\">$NWB#servers-ext_context$NWE</td></tr>\n";
echo "<tr bgcolor=#B6D3FC><td align=right>System Leistung: </td><td align=left><select size=1 name=sys_perf_log><option>Y</option><option>N</option><option selected>$row[17]</option></select>$NWB#servers-sys_perf_log$NWE</td></tr>\n";
echo "<tr bgcolor=#B6D3FC><td align=right>Bediener-Maschinenbordbücher: </td><td align=left><select size=1 name=vd_server_logs><option>Y</option><option>N</option><option selected>$row[18]</option></select>$NWB#servers-vd_server_logs$NWE</td></tr>\n";
echo "<tr bgcolor=#B6D3FC><td align=right>AGI Ausgang: </td><td align=left><select size=1 name=agi_output><option>NONE</option><option>STDERR</option><option>FILE</option><option>BOTH</option><option selected>$row[19]</option></select>$NWB#servers-agi_output$NWE</td></tr>\n";
echo "<tr bgcolor=#B6D3FC><td align=center colspan=2><input type=submit name=submit VALUE=SUBMIT></td></tr>\n";
echo "</TABLE></center></form>\n";


### vicidial server trunk records for this server
echo "<br><br><b>VICIDIAL STÄMME FÜR DIESEN BEDIENER: &nbsp; $NWB#vicidial_server_trunks$NWE</b><br>\n";
echo "<TABLE width=500 cellspacing=3>\n";
echo "<tr><td> KAMPAGNE</td><td> STÄMME </td><td> BESCHRÄNKUNG </td><td> </td><td> DELETE </td></tr>\n";

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
	echo "<td><font size=1><a href=\"$PHP_SELF?ADD=621111111111&campaign_id=$rowx[1]&server_ip=$server_ip\">LÖSCHUNG</a></td></tr>\n";
	}

echo "</table>\n";

echo "<br><b>ADDIEREN SIE NEUEN STAMM-SATZ DES BEDIENER-VICIDIAL</b><BR><form action=$PHP_SELF method=POST>\n";
echo "<input type=hidden name=ADD value=221111111111>\n";
echo "<input type=hidden name=server_ip value=\"$server_ip\">\n";
echo "TRUNKS: <input size=6 maxlength=4 name=dedicated_trunks><BR>\n";
echo "KAMPAGNE: <select size=1 name=campaign_id>\n";
echo "$campaigns_list\n";
echo "</select><BR>\n";
echo "RESTRICTION: <select size=1 name=trunk_restriction><option>MAXIMUM_LIMIT</option><option>OVERFLOW_ALLOWED</option></select><BR>\n";
echo "<input type=submit name=submit value=ADD><BR>\n";

echo "</center></FORM><br>\n";


### list of phones on this server
echo "<center>\n";
echo "<br><b>TELEFONE INNERHALB DIESES BEDIENERS:</b><br>\n";
echo "<TABLE width=400 cellspacing=3>\n";
echo "<tr><td>VERLÄNGERUNG</td><td>NAME</td><td>AKTIV</td></tr>\n";

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
echo "<tr><td>CONFERENCE</td><td>VERLÄNGERUNG</td></tr>\n";

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
echo "<tr><td>VD CONFERENCE</td><td>VERLÄNGERUNG</td></tr>\n";

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
echo "Dieser Bediener hat $active_phones aktive Telefone und $inactive_phones unaktivierte Telefone<br><br>\n";
echo "Dieser Bediener hat $active_confs active conferences<br><br>\n";
echo "Dieser Bediener hat $active_vdconfs active vicidial conferences<br><br>\n";
echo "</b></center>\n";
if ($LOGast_delete_phones > 0)
	{
	echo "<br><br><a href=\"$PHP_SELF?ADD=511111111111&server_id=$server_id&server_ip=$server_ip\">DELETE THIS SERVER</a>\n";
	}
}


######################
# ADD=3111111111111 modify conference record in the system
######################

if ($ADD==3111111111111)
{
echo "<TABLE><TR><TD>\n";
	echo "<FONT FACE=\"ARIAL,HELVETICA\" COLOR=BLACK SIZE=2>";

	$stmt="SELECT * from conferences where conf_exten='$conf_exten' and server_ip='$server_ip';";
	$rslt=mysql_query($stmt, $link);
	$row=mysql_fetch_row($rslt);
	$conf_exten = $row[0];
	$server_ip = $row[1];

echo "<br>ÄNDERN Sie Einen KONFERENZ-SATZ: $row[0]<form action=$PHP_SELF method=POST>\n";
echo "<input type=hidden name=ADD value=4111111111111>\n";
echo "<input type=hidden name=old_conf_exten value=\"$row[0]\">\n";
echo "<input type=hidden name=old_server_ip value=\"$row[1]\">\n";
echo "<center><TABLE width=600 cellspacing=3>\n";
echo "<tr bgcolor=#B6D3FC><td align=right>Konferenz:</td><td align=left><input type=text name=conf_exten size=10 maxlength=7 value=\"$row[0]\">$NWB#conferences-conf_exten$NWE</td></tr>\n";
echo "<tr bgcolor=#B6D3FC><td align=right><a href=\"$PHP_SELF?ADD=311111111111&server_ip=$row[1]\">Bediener IP</a>: </td><td align=left><select size=1 name=server_ip>\n";

echo "$servers_list";
echo "<option SELECTED>$row[1]</option>\n";
echo "</select>$NWB#conferences-server_ip$NWE</td></tr>\n";
echo "<tr bgcolor=#B6D3FC><td align=right>Gegenwärtige Verlängerung: </td><td align=left><input type=text name=extension size=20 maxlength=20 value=\"$row[2]\"></td></tr>\n";
echo "<tr bgcolor=#B6D3FC><td align=center colspan=2><input type=submit name=submit VALUE=SUBMIT></td></tr>\n";
echo "</TABLE></center>\n";

echo "<center><b>\n";
if ($LOGast_delete_phones > 0)
	{
	echo "<br><br><a href=\"$PHP_SELF?ADD=5111111111111&conf_exten=$conf_exten&server_ip=$server_ip\">DELETE THIS CONFERENCE</a>\n";
	}
}


######################
# ADD=31111111111111 modify vicidial conference record in the system
######################

if ($ADD==31111111111111)
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
echo "<center><TABLE width=600 cellspacing=3>\n";
echo "<tr bgcolor=#B6D3FC><td align=right>Konferenz:</td><td align=left><input type=text name=conf_exten size=10 maxlength=7 value=\"$row[0]\">$NWB#conferences-conf_exten$NWE</td></tr>\n";
echo "<tr bgcolor=#B6D3FC><td align=right><a href=\"$PHP_SELF?ADD=311111111111&server_ip=$row[1]\">Bediener IP</a>: </td><td align=left><select size=1 name=server_ip>\n";

echo "$servers_list";
echo "<option SELECTED>$row[1]</option>\n";
echo "</select>$NWB#conferences-server_ip$NWE</td></tr>\n";
echo "<tr bgcolor=#B6D3FC><td align=right>Gegenwärtige Verlängerung: </td><td align=left><input type=text name=extension size=20 maxlength=20 value=\"$row[2]\"></td></tr>\n";
echo "<tr bgcolor=#B6D3FC><td align=center colspan=2><input type=submit name=submit VALUE=SUBMIT></td></tr>\n";
echo "</TABLE></center>\n";

echo "<center><b>\n";
if ($LOGast_delete_phones > 0)
	{
	echo "<br><br><a href=\"$PHP_SELF?ADD=51111111111111&conf_exten=$conf_exten&server_ip=$server_ip\">DELETE THIS VICIDIAL CONFERENCE</a>\n";
	}
}







######################
# ADD=55 search form
######################

if ($ADD==55)
{
echo "<TABLE><TR><TD>\n";
echo "<FONT FACE=\"ARIAL,HELVETICA\" COLOR=BLACK SIZE=2>";

echo "<br>SUCHE NACH Einem BENUTZER<form action=$PHP_SELF method=POST>\n";
echo "<input type=hidden name=ADD value=66>\n";
echo "<center><TABLE width=600 cellspacing=3>\n";
echo "<tr bgcolor=#B6D3FC><td align=right>Benutzer-Zahl: </td><td align=left><input type=text name=user size=20 maxlength=20></td></tr>\n";
echo "<tr bgcolor=#B6D3FC><td align=right>Voller Name: </td><td align=left><input type=text name=full_name size=30 maxlength=30></td></tr>\n";
echo "<tr bgcolor=#B6D3FC><td align=right>Benutzer-Niveau: </td><td align=left><select size=1 name=user_level><option selected>0</option><option>1</option><option>2</option><option>3</option><option>4</option><option>5</option><option>6</option><option>7</option><option>8</option><option>9</option></select></td></tr>\n";
echo "<tr bgcolor=#B6D3FC><td align=right>Benutzer-Gruppe: </td><td align=left><select size=1 name=user_group>\n";

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
# ADD=66 user search results
######################

if ($ADD==66)
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

echo "<br>SUCHRESULTATE:\n";
echo "<center><TABLE width=600 cellspacing=0 cellpadding=1>\n";

	$o=0;
	while ($people_to_print > $o) {
		$row=mysql_fetch_row($rslt);
		if (eregi("1$|3$|5$|7$|9$", $o))
			{$bgcolor='bgcolor="#B9CBFD"';} 
		else
			{$bgcolor='bgcolor="#9BB9FB"';}
		echo "<tr $bgcolor><td><font size=1>$row[1]</td><td><font size=1>$row[3]</td><td><font size=1>$row[4]</td><td><font size=1>$row[5]</td>";
		echo "<td><font size=1><a href=\"$PHP_SELF?ADD=3&user=$row[1]\">ÄNDERN Sie</a> | <a href=\"./user_stats.php?user=$row[1]\">Notfall</a> | <a href=\"./user_status.php?user=$row[1]\">STATUS</a> | <a href=\"./AST_agent_time_sheet.php?agent=$row[1]\">TIME</a></td></tr>\n";
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
# ADD=82 display all callbacks on hold
######################
if ($ADD==82)
{
echo "<TABLE><TR><TD>\n";
echo "<center><TABLE width=600 cellspacing=0 cellpadding=1>\n";
echo "<tr bgcolor=black><td><font size=1 color=white>LEAD</td><td><font size=1 color=white>LIST</td><td><font size=1 color=white> KAMPAGNE</td><td><font size=1 color=white>ENTRYDATUM</td><td><font size=1 color=white>CALLBACKDATUM</td><td><font size=1 color=white>USER</td><td><font size=1 color=white>RECIPIENT</td><td><font size=1 color=white>STATUS</td></tr>\n";

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

echo "<br>BENUTZER-AUFLISTUNGEN:\n";
echo "<center><TABLE width=600 cellspacing=0 cellpadding=1>\n";
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
		echo "<td><font size=1><a href=\"$PHP_SELF?ADD=3&user=$row[1]\">ÄNDERN Sie</a> | <a href=\"./user_stats.php?user=$row[1]\">Notfall</a> | <a href=\"./user_status.php?user=$row[1]\">STATUS</a> | <a href=\"./AST_agent_time_sheet.php?agent=$row[1]\">TIME</a></td></tr>\n";
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

echo "<br>KAMPAGNE AUFLISTUNGEN:\n";
echo "<center><TABLE width=600 cellspacing=0 cellpadding=1>\n";

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
		echo "<td><font size=1><a href=\"$PHP_SELF?ADD=31&campaign_id=$row[0]\">ÄNDERN Sie</a></td></tr>\n";
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

echo "<br>LISTE AUFLISTUNGEN:\n";
echo "<center><TABLE width=600 cellspacing=0 cellpadding=1>\n";

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
		echo "<td><font size=1><a href=\"$PHP_SELF?ADD=311&list_id=$row[0]\">ÄNDERN Sie</a></td></tr>\n";
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

echo "<br>INBOUND GRUPPE AUFLISTUNGEN:\n";
echo "<center><TABLE width=600 cellspacing=0 cellpadding=1>\n";

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
		echo "<td><font size=1><a href=\"$PHP_SELF?ADD=3111&group_id=$row[0]\">ÄNDERN Sie</a></td></tr>\n";
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

echo "<br>REMOTEMITTEL-AUFLISTUNGEN:\n";
echo "<center><TABLE width=600 cellspacing=0 cellpadding=1>\n";

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
		echo "<td><font size=1><a href=\"$PHP_SELF?ADD=31111&remote_agent_id=$row[0]\">ÄNDERN Sie</a></td></tr>\n";
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

echo "<br>BENUTZER-GRUPPEN AUFLISTUNGEN:\n";
echo "<center><TABLE width=600 cellspacing=0 cellpadding=1>\n";

	$o=0;
	while ($people_to_print > $o) {
		$row=mysql_fetch_row($rslt);
		if (eregi("1$|3$|5$|7$|9$", $o))
			{$bgcolor='bgcolor="#B9CBFD"';} 
		else
			{$bgcolor='bgcolor="#9BB9FB"';}
		echo "<tr $bgcolor><td><font size=1>$row[0]</td>";
		echo "<td><font size=1> $row[1]</td>";
		echo "<td><font size=1><a href=\"$PHP_SELF?ADD=311111&user_group=$row[0]\">ÄNDERN Sie</a></td></tr>\n";
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

echo "<br>INDEX-AUFLISTUNGEN:\n";
echo "<center><TABLE width=600 cellspacing=0 cellpadding=1>\n";

	$o=0;
	while ($people_to_print > $o) {
		$row=mysql_fetch_row($rslt);
		if (eregi("1$|3$|5$|7$|9$", $o))
			{$bgcolor='bgcolor="#B9CBFD"';} 
		else
			{$bgcolor='bgcolor="#9BB9FB"';}
		echo "<tr $bgcolor><td><font size=1>$row[0]</td>";
		echo "<td><font size=1> $row[1]</td>";
		echo "<td><font size=1><a href=\"$PHP_SELF?ADD=3111111&script_id=$row[0]\">ÄNDERN Sie</a></td></tr>\n";
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

echo "<br>LEITUNG FILTER-AUFLISTUNGEN:\n";
echo "<center><TABLE width=600 cellspacing=0 cellpadding=1>\n";

	$o=0;
	while ($filters_to_print > $o) {
		$row=mysql_fetch_row($rslt);
		if (eregi("1$|3$|5$|7$|9$", $o))
			{$bgcolor='bgcolor="#B9CBFD"';} 
		else
			{$bgcolor='bgcolor="#9BB9FB"';}
		echo "<tr $bgcolor><td><font size=1>$row[0]</td>";
		echo "<td><font size=1> $row[1]</td>";
		echo "<td><font size=1><a href=\"$PHP_SELF?ADD=31111111&lead_filter_id=$row[0]\">ÄNDERN Sie</a></td></tr>\n";
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

echo "<br>Anrufzeiten Liste:\n";
echo "<center><TABLE width=600 cellspacing=0 cellpadding=1>\n";

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
		echo "<td><font size=1><a href=\"$PHP_SELF?ADD=311111111&call_time_id=$row[0]\">ÄNDERN Sie</a></td></tr>\n";
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

echo "<br>Liste der landesspezifische Anrufzeiten:\n";
echo "<center><TABLE width=600 cellspacing=0 cellpadding=1>\n";

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
		echo "<td><font size=1><a href=\"$PHP_SELF?ADD=3111111111&call_time_id=$row[0]\">ÄNDERN Sie</a></td></tr>\n";
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

echo "<br>TELEFON-AUFLISTUNGEN:\n";
echo "<center><TABLE width=600 cellspacing=0 cellpadding=1>\n";
echo "<tr bgcolor=black>";
echo "<td><a href=\"$PHP_SELF?ADD=10000000000&$EXTENlink\"><font size=1 color=white><B>EXTEN</B></a></td>";
echo "<td><a href=\"$PHP_SELF?ADD=10000000000&$PROTOlink\"><font size=1 color=white><B>PROTO</B></a></td>";
echo "<td><a href=\"$PHP_SELF?ADD=10000000000&$SERVERlink\"><font size=1 color=white><B>SERVER</B></a></td>";
echo "<td colspan=2><font size=1 color=white><B>DIALPLAN</B></td>";
echo "<td><a href=\"$PHP_SELF?ADD=10000000000&$STATUSlink\"><font size=1 color=white><B>STATUS</B></a></td>";
echo "<td><font size=1 color=white><B>NAME</B></td>";
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
		echo "<td><font size=1><a href=\"$PHP_SELF?ADD=31111111111&extension=$row[0]&server_ip=$row[5]\">ÄNDERN Sie</a> | <a href=\"./phone_stats.php?extension=$row[0]&server_ip=$row[5]\">Notfall</a></td></tr>\n";
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

echo "<br>BEDIENER-AUFLISTUNGEN:\n";
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
		echo "<td><font size=1><a href=\"$PHP_SELF?ADD=311111111111&server_id=$row[0]\">ÄNDERN Sie</a></td></tr>\n";
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

echo "<br>KONFERENZ-AUFLISTUNGEN:\n";
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
		echo "<td><font size=1><a href=\"$PHP_SELF?ADD=3111111111111&conf_exten=$row[0]&server_ip=$row[1]\">ÄNDERN Sie</a></td></tr>\n";
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

echo "<br>KONFERENZ-AUFLISTUNGEN:\n";
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
		echo "<td><font size=1><a href=\"$PHP_SELF?ADD=31111111111111&conf_exten=$row[0]&server_ip=$row[1]\">ÄNDERN Sie</a></td></tr>\n";
		$o++;
	}

echo "</TABLE></center>\n";
}




echo "</TD></TR></TABLE></center>\n";

$ENDtime = date("U");

$RUNtime = ($ENDtime - $STARTtime);

echo "\n\n\n<br><br><br>\n\n";


echo "<font size=0>\n\n\n<br><br><br>\nIndexlaufzeit: $RUNtime seconds";
echo " &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; VERSION: $version";
echo " &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; BAU: $build</font>\n";


?>


</TD></TR><TABLE>
</body>
</html>

<?
	
exit; 


function dialable_leads($DB,$link,$local_call_time,$dial_status_a,$dial_status_b,$dial_status_c,$dial_status_d,$dial_status_e,$camp_lists,$fSQL)
{
##### BEGIN calculate what gmt_offset_now values are within the allowed local_call_time setting ###
if (isset($camp_lists))
	{
	if (strlen($camp_lists)>1)
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
					if ($GMT_day[$r]==0)	#### Sunday lokale Zeit
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
					if ($GMT_day[$r]==1)	#### Monday lokale Zeit
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
					if ($GMT_day[$r]==2)	#### Tuesday lokale Zeit
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
					if ($GMT_day[$r]==3)	#### Wednesday lokale Zeit
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
					if ($GMT_day[$r]==4)	#### Thursday lokale Zeit
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
					if ($GMT_day[$r]==5)	#### Friday lokale Zeit
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
					if ($GMT_day[$r]==6)	#### Saturday lokale Zeit
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
			if ($GMT_day[$r]==0)	#### Sunday lokale Zeit
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
			if ($GMT_day[$r]==1)	#### Monday lokale Zeit
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
			if ($GMT_day[$r]==2)	#### Tuesday lokale Zeit
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
			if ($GMT_day[$r]==3)	#### Wednesday lokale Zeit
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
			if ($GMT_day[$r]==4)	#### Thursday lokale Zeit
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
			if ($GMT_day[$r]==5)	#### Friday lokale Zeit
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
			if ($GMT_day[$r]==6)	#### Saturday lokale Zeit
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

		$stmt="SELECT count(*) FROM vicidial_list where called_since_last_reset='N' and status IN('$dial_status_a','$dial_status_b','$dial_status_c','$dial_status_d','$dial_status_e') and list_id IN($camp_lists) and ($all_gmtSQL) $fSQL";
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

		echo "Diese Kampagne hat$active_leads führt, in jenen Listen gewählt zu werden\n";
		}
	else
		{
		echo "Keine aktiven Listen für diese Kampagne gewählt\n";
		}
	}
else
	{
	echo "Keine aktiven Listen für diese Kampagne gewählt\n";
	}
##### END calculate what gmt_offset_now values are within the allowed local_call_time setting ###
}
?>
