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
    echo "You have now logged out. Thank you\n";
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
    echo "Invalid Username/Password: |$PHP_AUTH_USER|$PHP_AUTH_PW|\n";
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
echo "<!-- VERSION: $version   BUILD: $build   ADD: $ADD   PHP_SELF: $PHP_SELF-->\n";
echo "<title>VICIDIAL ADMIN: ";

if (!isset($ADD))   {$ADD=0;}

if ($ADD==1)			{$hh='users';		echo "Add New User";}
if ($ADD==11)			{$hh='campaigns';	echo "Add New Campaign";}
if ($ADD==111)			{$hh='lists';		echo "Add New List";}
if ($ADD==121)			{$hh='lists';		echo "Add New DNC";}
if ($ADD==1111)			{$hh='ingroups';	echo "Add New In-Group";}
if ($ADD==11111)		{$hh='remoteagent';	echo "Add New Remote Agents";}
if ($ADD==111111)		{$hh='usergroups';	echo "Add New Users Group";}
if ($ADD==1111111)		{$hh='scripts';		echo "Add New Script";}
if ($ADD==11111111)		{$hh='filters';		echo "Add New Filter";}
if ($ADD==111111111)	{$hh='times';		echo "Add New Call Time";}
if ($ADD==1111111111)	{$hh='times';		echo "Add New State Call Time";}
if ($ADD==11111111111)	{$hh='server';		echo "ADD NEW PHONE";}
if ($ADD==111111111111)	{$hh='server';		echo "ADD NEW SERVER";}
if ($ADD==1111111111111)	{$hh='server';		echo "ADD NEW CONFERENCE";}
if ($ADD==11111111111111)	{$hh='server';		echo "ADD NEW VICIDIAL CONFERENCE";}
if ($ADD==2)			{$hh='users';		echo "New User Addition";}
if ($ADD==21)			{$hh='campaigns';	echo "New Campaign Addition";}
if ($ADD==22)			{$hh='campaigns';	echo "New Campaign Status Addition";}
if ($ADD==23)			{$hh='campaigns';	echo "New Campaign HotKey Addition";}
if ($ADD==25)			{$hh='campaigns';	echo "New Campaign Lead Recycle Addition";}
if ($ADD==211)			{$hh='lists';		echo "New List Addition";}
if ($ADD==2111)			{$hh='ingroups';	echo "New In-Group Addition";}
if ($ADD==21111)		{$hh='remoteagent';	echo "New Remote Agents Addition";}
if ($ADD==211111)		{$hh='usergroups';	echo "New Users Group Addition";}
if ($ADD==2111111)		{$hh='scripts';		echo "New Script Addition";}
if ($ADD==21111111)		{$hh='filters';		echo "New Filter Addition";}
if ($ADD==211111111)	{$hh='times';		echo "New Call Time Addition";}
if ($ADD==2111111111)	{$hh='times';		echo "New State Call Time Addition";}
if ($ADD==21111111111)	{$hh='server';		echo "ADDING NEW PHONE";}
if ($ADD==211111111111)	{$hh='server';		echo "ADDING NEW SERVER";}
if ($ADD==221111111111)	{$hh='server';		echo "ADDING NEW SERVER VICIDIAL TRUNK RECORD";}
if ($ADD==2111111111111)	{$hh='server';		echo "ADDING NEW CONFERENCE";}
if ($ADD==21111111111111)	{$hh='server';		echo "ADDING NEW VICIDIAL CONFERENCE";}
if ($ADD==3)			{$hh='users';		echo "Modify User";}
if ($ADD==30)			{$hh='campaigns';	echo "Campaign Not Allowed";}
if ($ADD==31)			{$hh='campaigns';	echo "Modify Campaign";}
if ($ADD==34)			{$hh='campaigns';	echo "Modify Campaign - Basic View";}
if ($ADD==311)			{$hh='lists';		echo "Modify List";}
if ($ADD==3111)			{$hh='ingroups';	echo "Modify In-Group";}
if ($ADD==31111)		{$hh='remoteagent';	echo "Modify Remote Agents";}
if ($ADD==311111)		{$hh='usergroups';	echo "Modify Users Groups";}
if ($ADD==3111111)		{$hh='scripts';		echo "Modify Script";}
if ($ADD==31111111)		{$hh='filters';		echo "Modify Filter";}
if ($ADD==311111111)	{$hh='times';		echo "Modify Call Time";}
if ($ADD==321111111)	{$hh='times';		echo "Modify Call Time State Definitions List";}
if ($ADD==3111111111)	{$hh='times';		echo "Modify State Call Time";}
if ($ADD==31111111111)	{$hh='server';		echo "MODIFY PHONE";}
if ($ADD==311111111111)	{$hh='server';		echo "MODIFY SERVER";}
if ($ADD==3111111111111)	{$hh='server';		echo "MODIFY CONFERENCE";}
if ($ADD==31111111111111)	{$hh='server';		echo "MODIFY VICIDIAL CONFERENCE";}
if ($ADD=="4A")			{$hh='users';		echo "Modify User - Admin";}
if ($ADD=="4B")			{$hh='users';		echo "Modify User - Admin";}
if ($ADD==4)			{$hh='users';		echo "Modify User";}
if ($ADD==41)			{$hh='campaigns';	echo "Modify Campaign";}
if ($ADD==42)			{$hh='campaigns';	echo "Modify Campaign Status";}
if ($ADD==43)			{$hh='campaigns';	echo "Modify Campaign HotKey";}
if ($ADD==44)			{$hh='campaigns';	echo "Modify Campaign - Basic View";}
if ($ADD==45)			{$hh='campaigns';	echo "Modify Campaign Lead Recycle";}
if ($ADD==411)			{$hh='lists';		echo "Modify List";}
if ($ADD==4111)			{$hh='ingroups';	echo "Modify In-Group";}
if ($ADD==41111)		{$hh='remoteagent';	echo "Modify Remote Agents";}
if ($ADD==411111)		{$hh='usergroups';	echo "Modify Users Groups";}
if ($ADD==4111111)		{$hh='scripts';		echo "Modify Script";}
if ($ADD==41111111)		{$hh='filters';		echo "Modify Filter";}
if ($ADD==411111111)	{$hh='times';		echo "Modify Call Time";}
if ($ADD==4111111111)	{$hh='times';		echo "Modify State Call Time";}
if ($ADD==41111111111)	{$hh='server';		echo "MODIFY PHONE";}
if ($ADD==411111111111)	{$hh='server';		echo "MODIFY SERVER";}
if ($ADD==421111111111)	{$hh='server';		echo "MODIFY SERVER VICIDIAL TRUNK RECORD";}
if ($ADD==4111111111111)	{$hh='server';		echo "MODIFY CONFERENCE";}
if ($ADD==41111111111111)	{$hh='server';		echo "MODIFY VICIDIAL CONFERENCE";}
if ($ADD==5)			{$hh='users';		echo "Delete User";}
if ($ADD==51)			{$hh='campaigns';	echo "Delete Campaign";}
if ($ADD==52)			{$hh='campaigns';	echo "Logout Agents";}
if ($ADD==53)			{$hh='campaigns';	echo "Emergency VDAC Jam Clear";}
if ($ADD==511)			{$hh='lists';		echo "Delete List";}
if ($ADD==5111)			{$hh='ingroups';	echo "Delete In-Group";}
if ($ADD==51111)		{$hh='remoteagent';	echo "Delete Remote Agents";}
if ($ADD==511111)		{$hh='usergroups';	echo "Delete Users Group";}
if ($ADD==5111111)		{$hh='scripts';		echo "Delete Script";}
if ($ADD==51111111)		{$hh='filters';		echo "Delete Filter";}
if ($ADD==511111111)	{$hh='times';		echo "Delete Call Time";}
if ($ADD==5111111111)	{$hh='times';		echo "Delete State Call Time";}
if ($ADD==51111111111)	{$hh='server';		echo "DELETE PHONE";}
if ($ADD==511111111111)	{$hh='server';		echo "DELETE SERVER";}
if ($ADD==5111111111111)	{$hh='server';		echo "DELETE CONFERENCE";}
if ($ADD==51111111111111)	{$hh='server';		echo "DELETE VICIDIAL CONFERENCE";}
if ($ADD==6)			{$hh='users';		echo "Delete User";}
if ($ADD==61)			{$hh='campaigns';	echo "Delete Campaign";}
if ($ADD==62)			{$hh='campaigns';	echo "Logout Agents";}
if ($ADD==63)			{$hh='campaigns';	echo "Emergency VDAC Jam Clear";}
if ($ADD==65)			{$hh='campaigns';	echo "Delete Lead Recycle";}
if ($ADD==611)			{$hh='lists';		echo "Delete List";}
if ($ADD==6111)			{$hh='ingroups';	echo "Delete In-Group";}
if ($ADD==61111)		{$hh='remoteagent';	echo "Delete Remote Agents";}
if ($ADD==611111)		{$hh='usergroups';	echo "Delete Users Group";}
if ($ADD==6111111)		{$hh='scripts';		echo "Delete Script";}
if ($ADD==61111111)		{$hh='filters';		echo "Delete Filter";}
if ($ADD==611111111)	{$hh='times';		echo "Delete Call Time";}
if ($ADD==6111111111)	{$hh='times';		echo "Delete State Call Time";}
if ($ADD==61111111111)	{$hh='server';		echo "DELETE PHONE";}
if ($ADD==611111111111)	{$hh='server';		echo "DELETE SERVER";}
if ($ADD==621111111111)	{$hh='server';		echo "DELETE SERVER VICIDIAL TRUNK RECORD";}
if ($ADD==6111111111111)	{$hh='server';		echo "DELETE CONFERENCE";}
if ($ADD==61111111111111)	{$hh='server';		echo "DELETE VICIDIAL CONFERENCE";}
if ($ADD==73)			{$hh='campaigns';	echo "Dialable Lead Count";}
if ($ADD==7111111)		{$hh='scripts';		echo "Preview Script";}
if ($ADD==0)			{$hh='users';		echo "Users List";}
if ($ADD==8)			{$hh='users';		echo "CallBacks Within Agent";}
if ($ADD==81)			{$hh='campaigns';	echo "CallBacks Within Campaign";}
if ($ADD==811)			{$hh='campaigns';	echo "CallBacks Within List";}
if ($ADD==10)			{$hh='campaigns';	echo "Campaigns";}
if ($ADD==100)			{$hh='lists';		echo "Lists";}
if ($ADD==1000)			{$hh='ingroups';	echo "In-Groups";}
if ($ADD==10000)		{$hh='remoteagent';	echo "Remote Agents";}
if ($ADD==100000)		{$hh='usergroups';	echo "User Groups";}
if ($ADD==1000000)		{$hh='scripts';		echo "Scripts";}
if ($ADD==10000000)		{$hh='filters';		echo "Filters";}
if ($ADD==100000000)	{$hh='times';		echo "Call Times";}
if ($ADD==1000000000)	{$hh='times';		echo "State Call Times";}
if ($ADD==10000000000)	{$hh='server';		echo "PHONE LIST";}
if ($ADD==100000000000)	{$hh='server';		echo "SERVER LIST";}
if ($ADD==1000000000000)	{$hh='server';		echo "CONFERENCE LIST";}
if ($ADD==10000000000000)	{$hh='server';		echo "VICIDIAL CONFERENCE LIST";}
if ($ADD==55)			{$hh='users';		echo "Search Form";}
if ($ADD==551)			{$hh='users';		echo "SEARCH PHONES";}
if ($ADD==66)			{$hh='users';		echo "Search Results";}
if ($ADD==661)			{$hh='users';		echo "SEARCH PHONES RESULTS";}
if ($ADD==99999)		{$hh='users';		echo "HELP";}

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
	$campaigns_list.="> ALL-CAMPAIGNS - USERS CAN VIEW ANY CAMPAIGN</B><BR>\n";

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
$NWE = "')\"><IMG SRC=\"../astguiclient/help.gif\" WIDTH=20 HEIGHT=20 BORDER=0 ALT=\"HELP\" ALIGN=TOP></A>";
######################
# ADD=99999 display the HELP SCREENS
######################

if ($ADD==99999)
{
echo "</title>\n";
echo "</head>\n";
echo "<BODY BGCOLOR=white marginheight=0 marginwidth=0 leftmargin=0 topmargin=0>\n";
echo "<CENTER>\n";
echo "<TABLE WIDTH=98% BGCOLOR=#E6E6E6 cellpadding=2 cellspacing=0><TR><TD ALIGN=LEFT><FONT FACE=\"ARIAL,HELVETICA\" COLOR=BLACK SIZE=4><B>VICIDIAL ADMIN: HELP<BR></B></FONT><FONT FACE=\"ARIAL,HELVETICA\" COLOR=BLACK SIZE=2><BR><BR>\n";

?>
<B><FONT SIZE=3>VICIDIAL_USERS TABLE</FONT></B><BR><BR>
<A NAME="vicidial_users-user">
<BR>
<B>User ID -</B> This field is where you put the VICIDIAL users ID number, can be up to 8 digits in length, Must be at least 2 characters in length.

<BR>
<A NAME="vicidial_users-pass">
<BR>
<B>Password -</B> This field is where you put the VICIDIAL users password. Must be at least 2 characters in length.

<BR>
<A NAME="vicidial_users-full_name">
<BR>
<B>Full Name -</B> This field is where you put the VICIDIAL users full name. Must be at least 2 characters in length.

<BR>
<A NAME="vicidial_users-user_level">
<BR>
<B>User Level -</B> This menu is where you select the VICIDIAL users user level. Must be a level of 1 to log into VICIDIAL, Must be level greater than 2 to log in as a closer, Must be user level 8 or greater to get into admin web section.

<BR>
<A NAME="vicidial_users-user_group">
<BR>
<B>User Group -</B> This menu is where you select the VICIDIAL users group that this user will belong to. This does not have any restrictions at this time, this is just to subdivide users and allow for future features based upon it.

<BR>
<A NAME="vicidial_users-phone_login">
<BR>
<B>Phone Login -</B> Here is where you can set a default phone login value for when the user logs into vicidial.php. This value will populate the phone_login automatically when the user logs in with their user-pass-campaign in the vicidial.php login screen.

<BR>
<A NAME="vicidial_users-phone_pass">
<BR>
<B>Phone Pass -</B> Here is where you can set a default phone pass value for when the user logs into vicidial.php. This value will populate the phone_pass automatically when the user logs in with their user-pass-campaign in the vicidial.php login screen.

<BR>
<A NAME="vicidial_users-hotkeys_active">
<BR>
<B>HotKeys Active -</B> This option if set to 1 allows the user to use the HotKeys quick-dispositioning function in vicidial.php.

<BR>
<A NAME="vicidial_users-agent_choose_ingroups">
<BR>
<B>Agent Choose Ingroups -</B> This option if set to 1 allows the user to choose the ingroups that they will receive calls from when they login to a CLOSER or INBOUND campaign. Otherwise the Manager will need to set this in their user detail screen of the admin page.

<BR>
<A NAME="vicidial_users-closer_campaigns">
<BR>
<B>Inbound Groups -</B> Here is where you select the inbound groups you want to receive calls from if you have selected the CLOSER campaign.

<BR>
<A NAME="vicidial_users-scheduled_callbacks">
<BR>
<B>Scheduled Callbacks -</B> This option allows an agent to disposition a call as CALLBK and choose the data and time at which the lead will be re-activated.

<BR>
<A NAME="vicidial_users-agentonly_callbacks">
<BR>
<B>Agent-Only Callbacks -</B> This option allows an agent to set a callback so that they are the only Agent that can call the customer back. This also allows the agent to see their callback listings and call them back any time they want to.

<BR>
<A NAME="vicidial_users-agentcall_manual">
<BR>
<B>Agent Call Manual -</B> This option allows an agent to manually enter a new lead into the system and call them. This also allows the calling of any phone number from their vicidial screen and puts that call into their session. Use this option with caution.

<BR>
<A NAME="vicidial_users-vicidial_recording">
<BR>
<B>Vicidial Recording -</B> This option can prevent an agent from doing any recordings after they log in to vicidial. This option must be on for vicidial to follow the campaign recording session.

<BR>
<A NAME="vicidial_users-vicidial_transfers">
<BR>
<B>Vicidial Transfers -</B> This option can prevent an agent from opening the transfer - conference session of vicidial. If this is disabled, the agent cannot third party call or blind transfer any calls.

<BR>
<A NAME="vicidial_users-closer_default_blended">
<BR>
<B>Closer Default Blended -</B> This option simply defaults the Blended checkbox on a CLOSER login screen.

<BR>
<A NAME="vicidial_users-alter_agent_interface_options">
<BR>
<B>Alter Agent Interface Options -</B> This option if set to 1 allows the administrative user to modify the Agents interface options in admin.php.

<BR>
<A NAME="vicidial_users-delete_users">
<BR>
<B>Delete Users -</B> This option if set to 1 allows the user to delete other users of equal or lesser user level from the system.

<BR>
<A NAME="vicidial_users-delete_user_groups">
<BR>
<B>Delete User Groups -</B> This option if set to 1 allows the user to delete user groups from the system.

<BR>
<A NAME="vicidial_users-delete_lists">
<BR>
<B>Delete Lists -</B> This option if set to 1 allows the user to delete vicidial lists from the system.

<BR>
<A NAME="vicidial_users-delete_campaigns">
<BR>
<B>Delete Campaigns -</B> This option if set to 1 allows the user to delete vicidial campaigns from the system.

<BR>
<A NAME="vicidial_users-delete_ingroups">
<BR>
<B>Delete In-Groups -</B> This option if set to 1 allows the user to delete vicidial In-Groups from the system.

<BR>
<A NAME="vicidial_users-delete_remote_agents">
<BR>
<B>Delete Remote Agents -</B> This option if set to 1 allows the user to delete vicidial remote agents from the system.

<BR>
<A NAME="vicidial_users-load_leads">
<BR>
<B>Load Leads -</B> This option if set to 1 allows the user to load vicidial leads into the vicidial_list table by way of the web based lead loader.

<BR>
<A NAME="vicidial_users-campaign_detail">
<BR>
<B>Campaign Detail -</B> This option if set to 1 allows the user to view and modify the campaign detail screen elements.

<BR>
<A NAME="vicidial_users-ast_admin_access">
<BR>
<B>AGC Admin Access -</B> This option if set to 1 allows the user to login to the astGUIclient admin pages.

<BR>
<A NAME="vicidial_users-ast_delete_phones">
<BR>
<B>AGC Delete Phones -</B> This option if set to 1 allows the user to delete phone entries in the astGUIclient admin pages.

<BR>
<A NAME="vicidial_users-delete_scripts">
<BR>
<B>Delete Scripts -</B> This option if set to 1 allows the user to delete Campaign scripts in the script modification screen.

<BR>
<A NAME="vicidial_users-modify_leads">
<BR>
<B>Modify Leads -</B> This option if set to 1 allows the user to modify leads in the admin section lead search results page.

<BR>
<A NAME="vicidial_users-change_agent_campaign">
<BR>
<B>Change Agent Campaign -</B> This option if set to 1 allows the user to alter the campaign that an agent is logged into while they are logged into it.

<BR>
<A NAME="vicidial_users-delete_filters">
<BR>
<B>Delete Filters -</B> This option allows the user to be able to delete vicidial lead filters from the system.

<BR>
<A NAME="vicidial_users-delete_call_times">
<BR>
<B>Delete Call Times -</B> This option allows the user to be able to delete vicidial call times records and vicidial state call times records from the system.

<BR>
<A NAME="vicidial_users-modify_call_times">
<BR>
<B>Modify Call Times -</B> This option allows the user to view and modify the call times and state call times records. A user doesn't need this option enabled if they only need to change the call times option on the campaigns screen.




<BR><BR><BR><BR>

<B><FONT SIZE=3>VICIDIAL_CAMPAIGNS TABLE</FONT></B><BR><BR>
<A NAME="vicidial_campaigns-campaign_id">
<BR>
<B>Campaign ID -</B> This is the short name of the campaign, it is not editable after initial submission, cannot contain spaces and must be between 2 and 8 characters in length.

<BR>
<A NAME="vicidial_campaigns-campaign_name">
<BR>
<B>Campaign Name -</B> This is the description of the campaign, it must be between 6 and 40 characters in length.

<BR>
<A NAME="vicidial_campaigns-active">
<BR>
<B>Active -</B> This is where you set the campaign to Active or Inactive. If Inactive, noone can log into it.

<BR>
<A NAME="vicidial_campaigns-park_ext">
<BR>
<B>Park Extension -</B> This is where you can customize the on-hold music for VICIDIAL. Make sure the extension is in place in the extensions.conf and that it points to the filename below.

<BR>
<A NAME="vicidial_campaigns-park_file_name">
<BR>
<B>Park File Name -</B> This is where you can customize the on-hold music for VICIDIAL. Make sure the filename is 10 characters in length or less and that the file is in place in the /var/lib/asterisk/sounds directory.

<BR>
<A NAME="vicidial_campaigns-web_form_address">
<BR>
<B>Web Form -</B> This is where you can set the custom web page that will be opened when the user clicks on the WEB FORM button.

<BR>
<A NAME="vicidial_campaigns-allow_closers">
<BR>
<B>Allow Closers -</B> This is where you can set whether the users of this campaign will have the option to send the call to a closer.

<BR>
<A NAME="vicidial_campaigns-dial_status">
<BR>
<B>Dial Status -</B> This is where you set the statuses that you are wanting to dial on within the lists that are active for the campaign below

<BR>
<A NAME="vicidial_campaigns-lead_order">
<BR>
<B>List Order -</B> This menu is where you select how the leads that match the statuses selected above will be put in the lead hopper:
 <BR> &nbsp; - DOWN: select the first leads loaded into the vicidial_list table
 <BR> &nbsp; - UP: select the last leads loaded into the vicidial_list table
 <BR> &nbsp; - UP PHONE: select the highest phone number and works its way down
 <BR> &nbsp; - DOWN PHONE: select the lowest phone number and works its way up
 <BR> &nbsp; - UP LAST NAME: starts with last names starting with Z and works its way down
 <BR> &nbsp; - DOWN LAST NAME: starts with last names starting with A and works its way up
 <BR> &nbsp; - UP COUNT: starts with most called leads and works its way down
 <BR> &nbsp; - DOWN COUNT: starts with least called leads and works its way up
 <BR> &nbsp; - DOWN COUNT 2nd NEW: starts with least called leads and works its way up inserting a NEW lead in every other lead - Must NOT have NEW selected in the dial statuses
 <BR> &nbsp; - DOWN COUNT 3nd NEW: starts with least called leads and works its way up inserting a NEW lead in every third lead - Must NOT have NEW selected in the dial statuses
 <BR> &nbsp; - DOWN COUNT 4th NEW: starts with least called leads and works its way up inserting a NEW lead in every forth lead - Must NOT have NEW selected in the dial statuses

<BR>
<A NAME="vicidial_campaigns-hopper_level">
<BR>
<B>Hopper Level -</B> This is how many leads the VDhopper script tries to keep in the vicidial_hopper table for this campaign. If running VDhopper script every minute, make this slightly greater than the number of leads you go through in a minute.

<BR>
<A NAME="vicidial_campaigns-lead_filter_id">
<BR>
<B>Lead Filter -</B> This is a method of filtering your leads using a fragment of a SQL query. Use this feature with caution, it is easy to stop dialing accidentally with the slightest alteration to the SQL statement. Default is NONE.

<BR>
<A NAME="vicidial_campaigns-force_reset_hopper">
<BR>
<B>Force Reset of Hopper -</B> This allows you to wipe out the hopper contents upon form submission. It should be filled again when the VDhopper script runs.

<BR>
<A NAME="vicidial_campaigns-dial_method">
<BR>
<B>Dial Method -</B> This field is the way to define how dialing is to take place. If MANUAL then the auto_dial_level will be locked at 0 unless Dial Method is changed. If RATIO then the normal dialing a number of lines for Active agents. ADAPT_HARD_LIMIT will dial predictively up to the dropped percentage and then not allow aggressive dialing once the drop limit is reached until the percentage goes down again. ADAPT_TAPERED allows for running over the dropped percentage in the first half of the shift -as defined by call_time selected for campaign- and gets more strict as the shift goes on. ADAPT_AVERAGE tries to maintain an average or the dropped percentage not imposing hard limits as aggressively as the other two methods. You cannot change the Auto Dial Level if you are in any of the ADAPT dial methods. Only the Dialer can change the dial level when in predictive dialing mode.

<BR>
<A NAME="vicidial_campaigns-auto_dial_level">
<BR>
<B>Auto Dial Level -</B> This is where you set how many lines VICIDIAL should use per active agent. zero 0 means auto dialing is off and the agents will click to dial each number. Otherwise VICIDIAL will keep dialing lines equal to active agents multiplied by the dial level to arrive at how many lines this campaign on each server should allow.

<BR>
<A NAME="vicidial_campaigns-available_only_ratio_tally">
<BR>
<B>Available Only Tally -</B> This field if set to Y will leave out INCALL and QUEUE status agents when calculating the number of calls to dial when not in MANUAL dial mode. Default is N.

<BR>
<A NAME="vicidial_campaigns-adaptive_dropped_percentage">
<BR>
<B>Drop Percentage Limit -</B> This field is where you set the limit of the percentage of dropped calls you would like while using an adaptive-predictive dial method, not MANUAL or RATIO.

<BR>
<A NAME="vicidial_campaigns-adaptive_maximum_level">
<BR>
<B>Maximum Adapt Dial Level -</B> This field is where you set the limit of the limit to the numbr of lines you would like dialed per agent while using an adaptive-predictive dial method, not MANUAL or RATIO. This number can be higher than the Auto Dial Level if your hardware will support it. Value must be a positive number greater than one and can have decimal places Default 3.0.

<BR>
<A NAME="vicidial_campaigns-adaptive_latest_server_time">
<BR>
<B>Latest Server Time -</B> This field is only used by the ADAPT_TAPERED dial method. You should enter in the hour and minute that you will stop calling on this campaign, 2100 would mean that you will stop dialing this campaign at 9PM server time. This allows the Tapered algorithm to decide how aggressively to dial by how long you have until you will be finished calling.

<BR>
<A NAME="vicidial_campaigns-adaptive_intensity">
<BR>
<B>Adapt Intensity Modifier -</B> This field is used to adjust the predictive intensity either higher or lower. The higher a positive number you select, the greater the dialer will increase the call pacing when it goes up and the slower the dialer will decrease the call pacing when it goes down. The lower the negative number you select here, the slower the dialer will increase the call pacing and the faster the dialer will lower the call pacing when it goes down. Default is 0. This field is not used by the MANUAL or RATIO dial methods.

<BR>
<A NAME="vicidial_campaigns-adaptive_dl_diff_target">
<BR>
<B>Dial Level Difference Target -</B> This field is used to define whether you want to target having a specific number of agents waiting for calls or calls waiting for agents. For example if you would always like to have on average one agent free to take calls immediately you would set this to -1, if you would like to target always having one call on hold waiting for an agent you would set this to 1. Default is 0. This field is not used by the MANUAL or RATIO dial methods.

<BR>
<A NAME="vicidial_campaigns-next_agent_call">
<BR>
<B>Next Agent Call -</B> This determines which agent receives the next call that is available:
 <BR> &nbsp; - random: orders by the random update value in the vicidial_live_agents table
 <BR> &nbsp; - oldest_call_start: orders by the last time an agent was sent a call. Results in agents receiving about the same number of calls overall.
 <BR> &nbsp; - oldest_call_finish: orders by the last time an agent finished a call. AKA agent waiting longest receives first call.
 <BR> &nbsp; - overall_user_level: orders by the user_level of the agent as defined in the vicidial_users table a higher user_level will receive more calls.

<BR>
<A NAME="vicidial_campaigns-local_call_time">
<BR>
<B>Local Call Time -</B> This is where you set during which hours you would like to dial, as determined by the local time in the are in which you are calling. This is controlled by area code and is adjusted for Daylight Savings time if applicable. General Guidelines in the USA for Business to Business is 9am to 5pm and Business to Consumer calls is 9am to 9pm.

<BR>
<A NAME="vicidial_campaigns-dial_timeout">
<BR>
<B>Dial Timeout -</B> If defined, calls that would normally hangup after the timeout defined in extensions.conf would instead timeout at this amount of seconds if it is less than the extensions.conf timeout. This allows for quickly changing dial timeouts from server to server and limiting the effects to a single campaign. If you are having a lot of Answering Machine or Voicemail calls you may want to try changing this value to between 21-26 and see if results improve.

<BR>
<A NAME="vicidial_campaigns-dial_prefix">
<BR>
<B>Dial Prefix -</B> This field allows for more easily changing a path of dialing to go out through a different method without doing a reload in Asterisk. Default is 9 based upon a 91NXXNXXXXXX in the dialplan - extensions.conf.

<BR>
<A NAME="vicidial_campaigns-omit_phone_code">
<BR>
<B>Omit Phone Code -</B> This field allows you to leave out the phone_code field while dialing within VICIDIAL. For instance if you are dialing in the UK from the UK you would have 44 in as your phone_code field for all leads, but you just want to dial 10 digits in your dialplan extensions.conf to place calls instead of 44 then 10 digits. Default is N.

<BR>
<A NAME="vicidial_campaigns-campaign_cid">
<BR>
<B>Campaign CallerID -</B> This field allows for the sending of a custom callerid number on the outbound calls. This is the number that would show up on the callerid of the person you are calling. The default is UNKNOWN. If you are using T1 or E1s to dial out this option is only available if you are using PRIs - ISDN T1s or E1s - that have the custom callerid feature turned on, this will not work with Robbed-bit service -RBS- circuits. This will also work through most VOIP -SIP or IAX trunks- providers that allow dynamic outbound callerID. The custom callerID only applies to calls placed for the VICIDIAL campaign directly, any 3rd party calls or transfers will not send the custom callerID. NOTE: Sometimes putting UNKNOWN or PRIVATE in the field will yield the sending of your default callerID number by your carrier with the calls. You may want to test this and put 0000000000 in the callerid field instead if you do not want to send you CallerID.

<BR>
<A NAME="vicidial_campaigns-campaign_vdad_exten">
<BR>
<B>Campaign VDAD extension -</B> This field allows for a custom VDAD transfer extension. This allows you to use different VDADtransfer...agi scripts depending upon your campaign. The default transfer AGI - exten 8365 agi-VDADtransfer.agi - just immediately sends the calls on to agents as soon as they are picked up. An additional sample political survey AGI is also now included - 8366 agi-VDADtransferSURVEY.agi - that plays a message to the called person and allows them to make a choice by pressing buttons - effectively pre-screening the lead - . Please note that except for surveys, political calls and charities this form of calling is illegal in the United States.

<BR>
<A NAME="vicidial_campaigns-campaign_rec_exten">
<BR>
<B>Campaign Rec extension -</B> This field allows for a custom recording extension to be used with VICIDIAL. This allows you to use different extensions depending upon how long you want to allow a maximum recording and what type of codec you want to record in. The default exten is 8309 which if you follow the SCRATCH_INSTALL examples will record in the WAV format for upto one hour. Another option included in the examples is 8310 which will record in GSM format for upto one hour.

<BR>
<A NAME="vicidial_campaigns-campaign_recording">
<BR>
<B>Campaign Recording -</B> This menu allows you to choose what level of recording is allowed on this campaign. NEVER will disable recording on the client. ONDEMAND is the default and allows the agent to start and stop recording as needed. ALLCALLS will start recording on the client whenever a call is sent to an agent. ALLFORCE will start recording on the client whenever a call is sent to an agent giving the agent no option to stop recording. For ALLCALLS and ALLFORCE there is an option to use the Recording Delay to cut down on very short recordings and recude system load.

<BR>
<A NAME="vicidial_campaigns-campaign_rec_filename">
<BR>
<B>Campaign Rec Filename -</B> This field allows you to customize the name of the recording when Campaign recording is ONDEMAND or ALLCALLS. The allowed variables are CAMPAIGN CUSTPHONE FULLDATE TINYDATE EPOCH AGENT. The default is FULLDATE_AGENT and would look like this 20051020-103108_6666. Another example is CAMPAIGN_TINYDATE_CUSTPHONE which would look like this TESTCAMP_51020103108_3125551212. 50 char max.

<BR>
<A NAME="vicidial_campaigns-allcalls_delay">
<BR>
<B>Recording Delay -</B> For ALLCALLS and ALLFORCE recording only. This setting will delay the starting of the recording on all calls for the number of seconds specified in this field. Default is 0.

<BR>
<A NAME="vicidial_campaigns-campaign_script">
<BR>
<B>Campaign Script -</B> This menu allows you to choose the script that will appear on the agents screen for this campaign. Select NONE to show no script for this campaign.

<BR>
<A NAME="vicidial_campaigns-get_call_launch">
<BR>
<B>Get Call Launch -</B> This menu allows you to choose whether you want to auto-launch the web-form page in a separate window, auto-switch to the SCRIPT tab or do nothing when a call is sent to the agent for this campaign. 

<BR>
<A NAME="vicidial_campaigns-am_message_exten">
<BR>
<B>Answering Machine Message -</B> This field is for entering in an extension to blind transfer calls to when the agent gets an answering machine and clicks on the Answering Machine Message button in the transfer conference frame. You must set this exten up in the dialplan - extensions.conf - and make sure it plays an audio file then hangs up. 

<BR>
<A NAME="vicidial_campaigns-amd_send_to_vmx">
<BR>
<B>AMD send to vm exten -</B> This menu allows you to define whether a message is left on an answering machine when it is detected. the call will be immediately forwarded to the Answering-Machine-Message extension if AMD is active and it is determined that the call is an answering machine.

<BR>
<A NAME="vicidial_campaigns-xferconf_a_dtmf">
<BR>
<B>Xfer-Conf DTMF -</B> These four fields allow for you to have two sets of Transfer Conference and DTMF presets. When the call or campaign is loaded, the vicidial.php script will show two buttons on the transfer-conference frame and auto-populate the number-to-dial and the send-dtmf fields when pressed. If you want to allow Consultative Transfers, a fronter to a closer, you can place CXFER as one of the number-to-dial presets and the proper dialstring will be sent to do a Local Consultative Transfer, then the agent can just LEAVE-3WAY-CALL and move on to their next call. If you want to allow Blind transfers of customers to a VICIDIAL AGI script for logging or an IVR, then place AXFER in the number-to-dial field. You can also specify an custom extension after the AXFER or CXFER, for instance if you want to do Internal Consultative transfers instead of Local you would put CXFER90009 in the number-to-dial field.

<BR>
<A NAME="vicidial_campaigns-alt_number_dialing">
<BR>
<B>Agent Alt Num Dialing -</B> This option allows an agent to manually dial the alternate phone number or address3 field after the main number has been called.

<BR>
<A NAME="vicidial_campaigns-scheduled_callbacks">
<BR>
<B>Scheduled Callbacks -</B> This option allows an agent to disposition a call as CALLBK and choose the data and time at which the lead will be re-activated.

<BR>
<A NAME="vicidial_campaigns-drop_call_seconds">
<BR>
<B>Drop Call Seconds -</B> The number of seconds from the time the customer line is picked up until the call is considered a DROP, only applies to outbound calls.

<BR>
<A NAME="vicidial_campaigns-voicemail_ext">
<BR>
<B>Voicemail -</B> If defined, calls that would normally DROP would instead be directed to this voicemail box to hear and leave a message.

<BR>
<A NAME="vicidial_campaigns-safe_harbor_message">
<BR>
<B>Safe Harbor Message -</B> If set to Y will play a message to customer after the Drop Call Seconds timeout is reached without being transferred to an agent. This setting will override sending to a voicemail box if this is set to Y.

<BR>
<A NAME="vicidial_campaigns-safe_harbor_exten">
<BR>
<B>Safe Harbor Exten -</B> This is the dialplan extension that the desired Safe Harbor audio file is located at on your server.

<BR>
<A NAME="vicidial_campaigns-wrapup_seconds">
<BR>
<B>Wrapup Seconds -</B> The number of seconds to force an agent to wait before allowing them to receive or dial another call. The timer begins as soon as an agent hangs up on their customer - or in the case of alternate number dialing when the agent finishes the lead - Default is 0 seconds. If the timer runs out before the agent has dispositioned the call, the agent still will NOT move on to the next call until they select a disposition.

<BR>
<A NAME="vicidial_campaigns-wrapup_message">
<BR>
<B>Wrapup Message -</B> This is a campaign-specific message to be displayed on the wrapup screen if wrapup seconds is set.

<BR>
<A NAME="vicidial_campaigns-wrapup_message">
<BR>
<B>Wrapup Message -</B> This is a campaign-specific message to be displayed on the wrapup screen if wrapup seconds is set.

<BR>
<A NAME="vicidial_campaigns-use_internal_dnc">
<BR>
<B>Use Internal DNC List -</B> This defines whether this campaign is to filter leads against the Internal DNC list. If it is set to Y, the hopper will look for each phone number in the DNC list before placing it in the hopper. If it is in the DNC list then it will change that lead status to DNCL so it cannot be dialed. Default is N.

<BR>
<A NAME="vicidial_campaigns-closer_campaigns">
<BR>
<B>Allowed Inbound Groups -</B> For CLOSER campaigns only. Here is where you select the inbound groups you want agents in this CLOSER campaign to be able to take calls from. It is important for BLENDED inbound-outbound campaigns only to select the inbound groups that are used for agents in this campaign. The calls coming into the inbound groups selected here will be counted as active calls for a blended campaign even if all agents in the campaign are not logged in to receive calls from all of those selected inbound groups.



<BR><BR><BR><BR>

<B><FONT SIZE=3>VICIDIAL_LISTS TABLE</FONT></B><BR><BR>
<A NAME="vicidial_lists-list_id">
<BR>
<B>List ID -</B> This is the numerical name of the list, it is not editable after initial submission, must contain only numbers and must be between 2 and 8 characters in length. Must be a number greater than 100.

<BR>
<A NAME="vicidial_lists-list_name">
<BR>
<B>List Name -</B> This is the description of the list, it must be between 2 and 20 characters in length.

<BR>
<A NAME="vicidial_lists-campaign_id">
<BR>
<B>Campaign -</B> This is the campaign that this list belongs to. A list can only be dialed on a single campaign at one time.

<BR>
<A NAME="vicidial_lists-active">
<BR>
<B>Active -</B> This defines whether the list is to be dialed on or not.

<BR>
<A NAME="vicidial_lists-reset_list">
<BR>
<B>Reset Lead-Called-Status for this list -</B> This resets all leads in this list to N for "not called since last reset" and means that any lead can now be called if it is the right status as defined in the campaign screen.

<BR>
<A NAME="vicidial_list-dnc">
<BR>
<B>VICIDIAL DNC List -</B> This Do Not Call list contains every lead that has been set to a status of DNC in the system. Through the LISTS - ADD NUMBER TO DNC page you are able to manually add a number to this list so that it will not be called by campaigns that use the internal DNC list.



<BR><BR><BR><BR>

<B><FONT SIZE=3>VICIDIAL_INBOUND_GROUPS TABLE</FONT></B><BR><BR>
<A NAME="vicidial_inbound_groups-group_id">
<BR>
<B>Group ID -</B> This is the short name of the inbound group, it is not editable after initial submission, must not contain any spaces and must be between 2 and 20 characters in length.

<BR>
<A NAME="vicidial_inbound_groups-group_name">
<BR>
<B>Group Name -</B> This is the description of the group, it must be between 2 and 30 characters in length. Cannot include dashes, plusses or spaces .

<BR>
<A NAME="vicidial_inbound_groups-group_color">
<BR>
<B>Group Color -</B> This is the color that displays in the VICIDIAL client app when a call comes in on this group. It must be between 2 and 7 characters long. If this is a hex color definition you must remember to put a # at the beginning of the string or VICIDIAL will not work properly.

<BR>
<A NAME="vicidial_inbound_groups-active">
<BR>
<B>Active -</B> This determines whether this group show up in the selection box when a VICIDIAL agent logs in.

<BR>
<A NAME="vicidial_inbound_groups-web_form_address">
<BR>
<B>Web Form -</B> This is the custom address that clicking on the WEB FORM button in VICIDIAL will take you to for calls that come in on this group.

<BR>
<A NAME="vicidial_inbound_groups-next_agent_call">
<BR>
<B>Next Agent Call -</B> This determines which agent receives the next call that is available:
 <BR> &nbsp; - random: orders by the random update value in the vicidial_live_agents table
 <BR> &nbsp; - oldest_call_start: orders by the last time an agent was sent a call. Results in agents receiving about the same number of calls overall.
 <BR> &nbsp; - oldest_call_finish: orders by the last time an agent finished a call. AKA agent waiting longest receives first call.
 <BR> &nbsp; - overall_user_level: orders by the user_level of the agent as defined in the vicidial_users table a higher user_level will receive more calls.

<BR>
<A NAME="vicidial_inbound_groups-fronter_display">
<BR>
<B>Fronter Display -</B> This field determines whether the inbound VICIDIAL agent would have the fronter name - if there is one - displayed in the Status field when the call comes to the agent.

<BR>
<A NAME="vicidial_inbound_groups-ingroup_script">
<BR>
<B>Campaign Script -</B> This menu allows you to choose the script that will appear on the agents screen for this campaign. Select NONE to show no script for this campaign.

<BR>
<A NAME="vicidial_inbound_groups-get_call_launch">
<BR>
<B>Get Call Launch -</B> This menu allows you to choose whether you want to auto-launch the web-form page in a separate window, auto-switch to the SCRIPT tab or do nothing when a call is sent to the agent for this campaign. 

<BR>
<A NAME="vicidial_inbound_groups-xferconf_a_dtmf">
<BR>
<B>Xfer-Conf DTMF -</B> These four fields allow for you to have two sets of Transfer Conference and DTMF presets. When the call or campaign is loaded, the vicidial.php script will show two buttons on the transfer-conference frame and auto-populate the number-to-dial and the send-dtmf fields when pressed. If you want to allow Consultative Transfers, a fronter to a closer, you can place CXFER as one of the number-to-dial presets and the proper dialstring will be sent to do a Local Consultative Transfer, then the agent can just LEAVE-3WAY-CALL and move on to their next call. If you want to allow Blind transfers of customers to a VICIDIAL AGI script for logging or an IVR, then place AXFER in the number-to-dial field. You can also specify an custom extension after the AXFER or CXFER, for instance if you want to do Internal Consultative transfers instead of Local you would put CXFER90009 in the number-to-dial field.

<BR>
<A NAME="vicidial_inbound_groups-drop_call_seconds">
<BR>
<B>Drop Call Seconds -</B> The number of seconds from the time the customer line is picked up until the call is considered a DROP, only applies to outbound calls.

<BR>
<A NAME="vicidial_inbound_groups-voicemail_ext">
<BR>
<B>Voicemail -</B> If defined, calls that would normally DROP would instead be directed to this voicemail box to hear and leave a message.

<BR>
<A NAME="vicidial_inbound_groups-drop_message">
<BR>
<B>Drop Message -</B> If set to Y will play a message to customer after the Drop Call Seconds timeout is reached without being transferred to an agent. This setting will override sending to a voicemail box if this is set to Y.

<BR>
<A NAME="vicidial_inbound_groups-drop_exten">
<BR>
<B>Drop Exten -</B> This is the dialplan extension that the desired Dropped call audio file is located at on your server.



<BR><BR><BR><BR>

<B><FONT SIZE=3>VICIDIAL_REMOTE_AGENTS TABLE</FONT></B><BR><BR>
<A NAME="vicidial_remote_agents-user_start">
<BR>
<B>User ID Start -</B> This is the starting User ID that is used when the remote agent entries are inserted into the system. If the Number of Lines is set higher than 1, this number is incremented by one until each line has an entry. Make sure you create a new VICIDIAL user account with a user level of 4 or great if you want them to be able to use the vdremote.php page for remote web access of this account.

<BR>
<A NAME="vicidial_remote_agents-number_of_lines">
<BR>
<B>Number of Lines -</B> This defines how many remote agent entries the system creates, and determines how many lines it thinks it can safely send to the number below.

<BR>
<A NAME="vicidial_remote_agents-server_ip">
<BR>
<B>Server IP -</B> A remote agent entry is only good for one specific server, here is where you select which server you want.

<BR>
<A NAME="vicidial_remote_agents-conf_exten">
<BR>
<B>External Extension -</B> This is the number that you want the calls forwarded to. Make sure that it is a full dialplan number and that if you need a 9 at the beginning you put it in here. Test by dialing this number from a phone on the system.

<BR>
<A NAME="vicidial_remote_agents-status">
<BR>
<B>Status -</B> Here is where you turn the remote agent on and off. As soon as the agent is Active the system assumes that it can send calls to it. It may take up to 30 seconds once you change the status to Inactive to stop receiving calls.

<BR>
<A NAME="vicidial_remote_agents-campaign_id">
<BR>
<B>Campaign -</B> Here is where you select the campaign that these remote agents will be logged into. Inbound needs to use the CLOSER campaign and select the inbound campaigns below that you want to receive calls from.

<BR>
<A NAME="vicidial_remote_agents-closer_campaigns">
<BR>
<B>Inbound Groups -</B> Here is where you select the inbound groups you want to receive calls from if you have selected the CLOSER campaign.


<BR><BR><BR><BR>

<B><FONT SIZE=3>VICIDIAL_CAMPAIGN_LISTS</FONT></B><BR><BR>
<A NAME="vicidial_campaign_lists">
<BR>
<B>The lists within this campaign are listed here, whether they are active is denoted by the Y or N and you can go to the list screen by clicking on the list ID in the first column.</B>


<BR><BR><BR><BR>

<B><FONT SIZE=3>VICIDIAL_CAMPAIGN_STATUSES TABLE</FONT></B><BR><BR>
<A NAME="vicidial_campaign_statuses">
<BR>
<B>Through the use of custom campaign statuses, you can have statuses that only exist for a specific campaign. The Status must be 1-8 characters in length, the description must be 2-30 characters in length and Selectable defines whether it shows up in VICIDIAL as a disposition.</B>



<BR><BR><BR><BR>

<B><FONT SIZE=3>VICIDIAL_CAMPAIGN_HOTKEYS TABLE</FONT></B><BR><BR>
<A NAME="vicidial_campaign_hotkeys">
<BR>
<B>Through the use of custom campaign hotkeys, agents that use the vicidial web-client can hangup and disposition calls just by pressing a single key on their keyboard.</B>




<BR><BR><BR><BR>

<B><FONT SIZE=3>VICIDIAL_LEAD_RECYCLE TABLE</FONT></B><BR><BR>
<A NAME="vicidial_lead_recycle">
<BR>
<B>Through the use of lead recycling, you can call specific statuses of leads again at a specified interval without resetting the entire list. Lead recycling is campaign-specific and does not have to be a selected dialable status in your campaign. The attempt delay field is the number of seconds until the lead can be placed back in the hopper, this number must be at least 120 seconds. The attempt maximum field is the maximum number of times that a lead of this status can be attempted before the list needs to be reset, this number can be from 1 to 10. You can activate and deactivate a lead recycle entry with the provided links. This feature only works in auto-dial mode, where dial level is greater than 0.</B>





<BR><BR><BR><BR>

<B><FONT SIZE=3>VICIDIAL_USER_GROUPS TABLE</FONT></B><BR><BR>
<A NAME="vicidial_user_groups-user_group">
<BR>
<B>User Group -</B> This is the short name of a Vicidial User group, try not to use any spaces or punctuation for this field. max 20 characters, minimum of 2 characters.

<BR>
<A NAME="vicidial_user_groups-group_name">
<BR>
<B>Group Name -</B> This is the description of the vicidial user group max of 40 characters.

<BR>
<A NAME="vicidial_user_groups-allowed_campaigns">
<BR>
<B>Allowed Campaigns -</B> This is a selectable list of Campaigns to which members of this user group can log in to. The ALL-CAMPAIGNS option allows the users in this group to see and log in to any campaign on the system.





<BR><BR><BR><BR>

<B><FONT SIZE=3>VICIDIAL_SCRIPTS TABLE</FONT></B><BR><BR>
<A NAME="vicidial_scripts-script_id">
<BR>
<B>Script ID -</B> This is the short name of a Vicidial Script. This needs to be a unique identifier. Try not to use any spaces or punctuation for this field. max 10 characters, minimum of 2 characters.

<BR>
<A NAME="vicidial_scripts-script_name">
<B>Script Name -</B> This is the title of a Vicidial Script. This is a short summary of the script. max 50 characters, minimum of 2 characters. There should be no spaces or punctuation of any kind in theis field.

<BR>
<A NAME="vicidial_scripts-script_comments">
<B>Script Comments -</B> This is where you can place comments for a Vicidial Script such as -changed to free upgrade on Sept 23-.  max 255 characters, minimum of 2 characters.

<BR>
<A NAME="vicidial_scripts-script_text">
<B>Script Text -</B> This is where you place the content of a Vicidial Script. Minimum of 2 characters. You can have customer information be auto-populated in this script using "--A--field--B--" where field is one of the following fieldnames: vendor_lead_code, source_id, list_id, gmt_offset_now, called_since_last_reset, phone_code, phone_number, title, first_name, middle_initial, last_name, address1, address2, address3, city, state, province, postal_code, country_code, gender, date_of_birth, alt_phone, email, security_phrase, comments, lead_id, campaign, phone_login, group, channel_group, SQLdate, epoch, uniqueid, customer_zap_channel, server_ip, SIPexten, session_id. For example, this sentence would print the persons name in it----<BR><BR>  Hello, can I speak with --A--first_name--B-- --A--last_name--B-- please? Well hello --A--title--B-- --A--last_name--B-- how are you today?<BR><BR> This would read----<BR><BR>Hello, can I speak with John Doe please? Well hello Mr. Doe how are you today?<BR><BR> You can also use an iframe to load a separate window within the SCRIPT tab, here is an example with prepopulated variables:

<DIV style="height:200px;width:400px;background:white;overflow:scroll;font-size:12px;font-family:sans-serif;" id=iframe_example>
&#60;iframe src="http://astguiclient.sf.net/test_VICIDIAL_output.php?lead_id=--A--lead_id--B--&#38;vendor_id=--A--vendor_lead_code--B--&#38;list_id=--A--list_id--B--&#38;gmt_offset_now=--A--gmt_offset_now--B--&#38;phone_code=--A--phone_code--B--&#38;phone_number=--A--phone_number--B--&#38;title=--A--title--B--&#38;first_name=--A--first_name--B--&#38;middle_initial=--A--middle_initial--B--&#38;last_name=--A--last_name--B--&#38;address1=--A--address1--B--&#38;address2=--A--address2--B--&#38;address3=--A--address3--B--&#38;city=--A--city--B--&#38;state=--A--state--B--&#38;province=--A--province--B--&#38;postal_code=--A--postal_code--B--&#38;country_code=--A--country_code--B--&#38;gender=--A--gender--B--&#38;date_of_birth=--A--date_of_birth--B--&#38;alt_phone=--A--alt_phone--B--&#38;email=--A--email--B--&#38;security_phrase=--A--security_phrase--B--&#38;comments=--A--comments--B--&#38;user=--A--user--B--&#38;campaign=--A--campaign--B--&#38;phone_login=--A--phone_login--B--&#38;fronter=--A--fronter--B--&#38;closer=--A--user--B--&#38;group=--A--group--B--&#38;channel_group=--A--group--B--&#38;SQLdate=--A--SQLdate--B--&#38;epoch=--A--epoch--B--&#38;uniqueid=--A--uniqueid--B--&#38;customer_zap_channel=--A--customer_zap_channel--B--&#38;server_ip=--A--server_ip--B--&#38;SIPexten=--A--SIPexten--B--&#38;session_id=--A--session_id--B--&#38;phone=--A--phone--B--" style="width:580;height:290;background-color:transparent;" scrolling="auto" frameborder="0" allowtransparency="true" id="popupFrame" name="popupFrame" width="460" height="290"&#62;
&#60;/iframe&#62;
</DIV>

<BR>
<A NAME="vicidial_scripts-active">
<BR>
<B>Active -</B> This determines whether this script can be selected to be used by a campaign.





<BR><BR><BR><BR>

<B><FONT SIZE=3>VICIDIAL_LEAD_FILTERS TABLE</FONT></B><BR><BR>
<A NAME="vicidial_lead_filters-lead_filter_id">
<BR>
<B>Filter ID -</B> This is the short name of a Vicidial Lead Filter. This needs to be a unique identifier. Do not use any spaces or punctuation for this field. max 10 characters, minimum of 2 characters.

<BR>
<A NAME="vicidial_lead_filters-lead_filter_name">
<B>Filter Name -</B> This is a more descriptive name of the Filter. This is a short summary of the filter. max 30 characters, minimum of 2 characters.

<BR>
<A NAME="vicidial_lead_filters-lead_filter_comments">
<B>Filter Comments -</B> This is where you can place comments for a Vicidial Filter such as -calls all California leads-.  max 255 characters, minimum of 2 characters.

<BR>
<A NAME="vicidial_lead_filters-lead_filter_sql">
<B>Filter SQL -</B> This is where you place the SQL query fragment that you want to filter by. do not begin or end with an AND, that will be added by the hopper cron script automatically. an example SQL query that would work here is- called_count > 4 and called_count < 8 -.





<BR><BR><BR><BR>

<B><FONT SIZE=3>VICIDIAL_CALL TIMES TABLE</FONT></B><BR><BR>
<A NAME="vicidial_call_times-call_time_id">
<BR>
<B>Call Time ID -</B> This is the short name of a Vicidial Call Time Definition. This needs to be a unique identifier. Do not use any spaces or punctuation for this field. max 10 characters, minimum of 2 characters.

<BR>
<A NAME="vicidial_call_times-call_time_name">
<B>Call Time Name -</B> This is a more descriptive name of the Call Time Definition. This is a short summary of the Call Time definition. max 30 characters, minimum of 2 characters.

<BR>
<A NAME="vicidial_call_times-call_time_comments">
<B>Call Time Comments -</B> This is where you can place comments for a Vicidial Call Time Definition such as -10am to 4pm with extra call state restrictions-.  max 255 characters.

<BR>
<A NAME="vicidial_call_times-ct_default_start">
<B>Default Start and Stop Times -</B> This is the default time that calling will be allowed to be started or stopped within this call time definition if the day-of-the-week start time is not defined. 0 is midnight. To prevent calling completely set this field to 2400 and set the Default Stop time to 2400. To allow calling 24 hours a day set the start time to 0 and the stop time to 2400.

<BR>
<A NAME="vicidial_call_times-ct_sunday_start">
<B>Weekday Start and Stop Times -</B> These are the custom times per day that can be set for the call time definition. same rules apply as with the Default start and stop times.

<BR>
<A NAME="vicidial_call_times-ct_state_call_times">
<B>State Call Time Definitions -</B> This is the list of State specific call time definitions that are followed in this Call Time Definition.

<BR>
<A NAME="vicidial_call_times-state_call_time_state">
<B>State Call Time State -</B> This is the two letter code for the state that this calling time definition is for. For this to be in effect the local call time that is set in the campaign must have this state call time record in it as well as all of the leads having two letter state codes in them.




<BR><BR><BR><BR>

<B><FONT SIZE=3>VICIDIAL LIST LOADER FUNCTIONALITY</FONT></B><BR><BR>
<A NAME="vicidial_list_loader">
<BR>
The VICIDIAL basic web-based lead loader is designed simply to take a lead file - up to 8MB in size - that is either tab or pipe delimited and load it into the vicidial_list table. There is also a new beta version super lead loader that allows for field choosing and TXT- Plain Text, CSV- Comma Separated Values and XLS- Excel file formats. The lead loader does not do data validation or check for duplicates in itself or other lists, so that is something you need to do before you load the leads. Also, make sure that you have created the list that these leads are to be under so that you can use them. There is also the matter of time-zone-coding these leads. You may want to increase the frequency that the ADMIN_adjust_GMTnow_on_leads.pl is being run in the cron on your Asterisk server so that any loaded leads can be coded faster. Here is a list of the fields in their proper order for the lead files:
	<OL>
	<LI>Vendor Lead Code - shows up in the Vendor ID field of the GUI
	<LI>Source Code - internal use only for admins and DBAs
	<LI>List ID - the list number that these leads will show up under
	<LI>Phone Code - the prefix for the phone number - 1 for US, 01144 for UK, 01161 for AUS, etc
	<LI>Phone Number - must be at least 8 digits long
	<LI>Title - title of the customer - Mr. Ms. Mrs, etc...
	<LI>First Name
	<LI>Middle Initial
	<LI>Last Name
	<LI>Address Line 1
	<LI>Address Line 2
	<LI>Address Line 3
	<LI>City
	<LI>State - limited to 2 characters
	<LI>Province
	<LI>Postal Code
	<LI>Country
	<LI>Gender
	<LI>Date of Birth
	<LI>Alternate Phone Number
	<LI>Email Address
	<LI>Security Phrase
	<LI>Comments
	</OL>

<BR>NOTES: The Excel Lead loader functionality is enabled by a series of perl scripts and needs to have a properly configured /etc/astguiclient.conf file in place on the web server. Also, a couple perl modules must be loaded for it to work as well - OLE-Storage_Lite and Spreadsheet-ParseExcel. You can check for runtime errors in these by looking at your apache error_log file.




<BR><BR><BR><BR>






<B><FONT SIZE=3>PHONES TABLE</FONT></B><BR><BR>
<A NAME="phones-extension">
<BR>
<B>Phone extension -</B> This field is where you put the phones name as it appears to Asterisk not including the protocol or slash at the beginning. For Example: for the SIP phone SIP/test101 the Phone extension would be test101. Also, for IAX2 phones make sure you use the full phones name: IAX2/IAXphone1@IAXphone1 would be IAXphone1@IAXphone1. For Zap phones make sure you put the full channel: Zap/25-1 would be 25-1.  Another note, make sure you set the Protocol below correctly for your type of phone.

<BR>
<A NAME="phones-dialplan_number">
<BR>
<B>Dialplan number -</B> This field is for the number you dial to have the phone ring. This number is defined in the extensions.conf file of your Asterisk server

<BR>
<A NAME="phones-voicemail_id">
<BR>
<B>Voicemail Box -</B> This field is for the voicemail box that the messages go to for the user of this phone. We use this to check for voicemail messages and for the user to be able to use the VOICEMAIL button on astGUIclient app.

<BR>
<A NAME="phones-outbound_cid">
<BR>
<B>Outbound CallerID -</B> This field is where you would enter the callerID number that you would like to appear on outbound calls placed form the astguiclient web-client. This does not work on RBS, non-PRI, T1/E1s.

<BR>
<A NAME="phones-phone_ip">
<BR>
<B>Phone IP address -</B> This field is for the phone's IP address if it is a VOIP phone. This is an optional field

<BR>
<A NAME="phones-computer_ip">
<BR>
<B>Computer IP address -</B> This field is for the user's computer IP address. This is an optional field

<BR>
<A NAME="phones-server_ip">
<BR>
<B>Server IP -</B> This menu is where you select which server the phone is active on.

<BR>
<A NAME="phones-login">
<BR>
<B>Login -</B> The login used for the phone user to login to the client applications.

<BR>
<A NAME="phones-pass">
<BR>
<B>Password -</B>  The password used for the phone user to login to the client applications.

<BR>
<A NAME="phones-status">
<BR>
<B>Status -</B> The status of the phone in the system, ACTIVE and ADMIN allow for GUI clients to work. ADMIN allows access to this administrative web site. All other statuses do not allow GUI or Admin web access.

<BR>
<A NAME="phones-active">
<BR>
<B>Active Account -</B> Whether the phone is active to put it in the list in the GUI client.

<BR>
<A NAME="phones-phone_type">
<BR>
<B>Phone Type -</B> Purely for administrative notes.

<BR>
<A NAME="phones-fullname">
<BR>
<B>Full Name -</B> Used by the GUIclient in the list of active phones.

<BR>
<A NAME="phones-company">
<BR>
<B>Company -</B> Purely for administrative notes.

<BR>
<A NAME="phones-picture">
<BR>
<B>Picture -</B> Not yet Implemented.

<BR>
<A NAME="phones-messages">
<BR>
<B>New Messages -</B> Number of new voicemail messages for this phone on the Asterisk server.

<BR>
<A NAME="phones-old_messages">
<BR>
<B>Old Messages -</B> Number of old voicemail messages for this phone on the Asterisk server.

<BR>
<A NAME="phones-protocol">
<BR>
<B>Client Protocol -</B> The protocol that the phone uses to connect to the Asterisk server: SIP, IAX2, Zap . Also, there is EXTERNAL for remote dial numbers or speed dial numbers that you want to list as phones.

<BR>
<A NAME="phones-local_gmt">
<BR>
<B>Local GMT -</B> The difference from Greenwich Mean time, or ZULU time where the phone is located. DO NOT ADJUST FOR DAYLIGHT SAVINGS TIME. This is used by the VICIDIAL campaign to accurately display the time and customer time.

<BR>
<A NAME="phones-ASTmgrUSERNAME">
<BR>
<B>Manager Login -</B> This is the login that the GUI clients for this phone will use to access the Database where the server data resides.

<BR>
<A NAME="phones-ASTmgrSECRET">
<BR>
<B>Manager Secret -</B> This is the password that the GUI clients for this phone will use to access the Database where the server data resides.

<BR>
<A NAME="phones-login_user">
<BR>
<B>VICIDIAL Default User -</B> This is to place a default value in the VICIDIAL user field whenever this phone user opens the astVICIDIAL client app. Leave blank for no user.

<BR>
<A NAME="phones-login_pass">
<BR>
<B>VICIDIAL Default Pass -</B> This is to place a default value in the VICIDIAL password field whenever this phone user opens the astVICIDIAL client app. Leave blank for no pass.

<BR>
<A NAME="phones-login_campaign">
<BR>
<B>VICIDIAL Default Campaign -</B> This is to place a default value in the VICIDIAL campaign field whenever this phone user opens the astVICIDIAL client app. Leave blank for no campaign.

<BR>
<A NAME="phones-park_on_extension">
<BR>
<B>Park Exten -</B> This is the default Parking extension for the client apps. Verify that a different one works before you change this.

<BR>
<A NAME="phones-conf_on_extension">
<BR>
<B>Conf Exten -</B> This is the default Conference park extension for the client apps. Verify that a different one works before you change this.

<BR>
<A NAME="phones-VICIDIAL_park_on_extension">
<BR>
<B>VICIDIAL Park Exten -</B> This is the default Parking extension for VICIDIAL client app. Verify that a different one works before you change this.

<BR>
<A NAME="phones-VICIDIAL_park_on_filename">
<BR>
<B>VICIDIAL Park File -</B> This is the default VICIDIAL park extension file name for the client apps. Verify that a different one works before you change this. limited to 10 characters.

<BR>
<A NAME="phones-monitor_prefix">
<BR>
<B>Monitor Prefix -</B> This is the dialplan prefix for monitoring of Zap channels automatically within the astGUIclient app. Only change according to the extensions.conf ZapBarge extensions records.

<BR>
<A NAME="phones-recording_exten">
<BR>
<B>Recording Exten -</B> This is the dialplan extension for the recording extension that is used to drop into meetme conferences to record them. It usually lasts upto one hour if not stopped. verify with extensions.conf file before changing.

<BR>
<A NAME="phones-voicemail_exten">
<BR>
<B>VMAIL Main Exten -</B> This is the dialplan extension going to check your voicemail. verify with extensions.conf file before changing.

<BR>
<A NAME="phones-voicemail_dump_exten">
<BR>
<B>VMAIL Dump Exten -</B> This is the dialplan prefix used to send calls directly to a user's voicemail from a live call in the astGUIclient app. verify with extensions.conf file before changing.

<BR>
<A NAME="phones-ext_context">
<BR>
<B>Exten Context -</B> This is the dialplan context that this phone primarily uses. It is assumed that all numbers dialed by the client apps are using this context so it is a good idea to make sure this is the most wide context possible. verify with extensions.conf file before changing.

<BR>
<A NAME="phones-dtmf_send_extension">
<BR>
<B>DTMF send Channel -</B> This is the channel string used to send DTMF sounds into meetme conferences from the client apps. Verify the exten and context with the extensions.conf file.

<BR>
<A NAME="phones-call_out_number_group">
<BR>
<B>Outbound Call Group -</B> This is the channel group that outbound calls from this phone are placed out of. There are a couple routines in the client apps that use this. For Zap channels you want to use something like Zap/g2 , for IAX2 trunks you would want to use the full IAX prefix like IAX2/VICItest1:secret@10.10.10.15:4569. Verify the trunks with the extensions.conf file, it is usually what you have defined as the TRUNK global variable at the top of the file.

<BR>
<A NAME="phones-client_browser">
<BR>
<B>Browser Location -</B> This is applicable to only UNIX/LINUX clients, the absolute path to Mozilla or Firefox browser on the machine. verify this by launching it manually.

<BR>
<A NAME="phones-install_directory">
<BR>
<B>Install Directory -</B> This is the place where the astGUIclient and astVICIDIAL scripts are located on your machine. For Win32 it should be something like C:\AST_VICI and for UNIX it should be something like /usr/local/perl_TK. verify this manually.

<BR>
<A NAME="phones-local_web_callerID_URL">
<BR>
<B>CallerID URL -</B> This is the web address of the page used to do custom callerID lookups. default testing address is: http://astguiclient.sf.net/test_callerid_output.php

<BR>
<A NAME="phones-VICIDIAL_web_URL">
<BR>
<B>VICIDIAL Default URL -</B> This is the web address of the page used to do custom VICIDIAL Web Form queries. default testing address is: http://astguiclient.sf.net/test_VICIDIAL_output.php

<BR>
<A NAME="phones-AGI_call_logging_enabled">
<BR>
<B>Call Logging -</B> This is set to true if the call_log.agi file is in place in the extensions.conf file for all outbound and hangup 'h' extensions to log all calls. This should always be 1 because it is manditory for many astGUIclient and VICIDIAL features to work properly.

<BR>
<A NAME="phones-user_switching_enabled">
<BR>
<B>User Switching -</B> Set to true to allow user to switch to another user account. NOTE: If user switches they can initiate recording on the new user's phone conversation

<BR>
<A NAME="phones-conferencing_enabled">
<BR>
<B>Conferencing -</B> Set to true to allow user to start conference calls with upto six external lines.

<BR>
<A NAME="phones-admin_hangup_enabled">
<BR>
<B>Admin Hangup -</B> Set to true to allow user to be able to hangup any line at will through astGUIclient. Good idea only to enable this for Admin users.

<BR>
<A NAME="phones-admin_hijack_enabled">
<BR>
<B>Admin Hijack -</B> Set to true to allow user to be able to grab and redirect to their extension any line at will through astGUIclient. Good idea only to enable this for Admin users. But is very useful for Managers.

<BR>
<A NAME="phones-admin_monitor_enabled">
<BR>
<B>Admin Monitor -</B> Set to true to allow user to be able to grab and redirect to their extension any line at will through astGUIclient. Good idea only to enable this for Admin users. But is very useful for Managers and as a training tool.

<BR>
<A NAME="phones-call_parking_enabled">
<BR>
<B>Call Park -</B> Set to true to allow user to be able to park calls on astGUIclient hold to be picked up by any other astGUIclient user on the system. Calls stay on hold for upto a half hour then hangup. Usually enabled for all.

<BR>
<A NAME="phones-updater_check_enabled">
<BR>
<B>Updater Check -</B> Set to true to display a popup warning that the updater time has not changed in 20 seconds. Useful for Admin users.

<BR>
<A NAME="phones-AFLogging_enabled">
<BR>
<B>AF Logging -</B> Set to true to log many actions of astGUIclient usage to a text file on the user's computer.

<BR>
<A NAME="phones-QUEUE_ACTION_enabled">
<BR>
<B>Queue Enabled -</B> Set to true to have client apps use the Asterisk Central Queue system. Required for VICIDIAL and recommended for all users.

<BR>
<A NAME="phones-CallerID_popup_enabled">
<BR>
<B>CallerID Popup -</B> Set to true to allow for numbers defined in the extensions.conf file to send CallerID popup screens to astGUIclient users.

<BR>
<A NAME="phones-voicemail_button_enabled">
<BR>
<B>VMail Button -</B> Set to true to display the VOICEMAIL button and the messages count display on astGUIclient.

<BR>
<A NAME="phones-enable_fast_refresh">
<BR>
<B>Fast Refresh -</B> Set to true to enable a new rate of refresh of call information for the astGUIclient. Default disabled rate is 1000 ms ,1 second. Can increase system load if you lower this number.

<BR>
<A NAME="phones-fast_refresh_rate">
<BR>
<B>Fast Refresh Rate -</B> in milliseconds. Only used if Fast Refresh is enabled. Default disabled rate is 1000 ms ,1 second. Can increase system load if you lower this number.

<BR>
<A NAME="phones-enable_persistant_mysql">
<BR>
<B>Persistant MySQL -</B> If enabled the astGUIclient connection will remain connected instead of connecting every second. Useful if you have a fast refresh rate set. It will increase the number of connections on your MySQL machine.

<BR>
<A NAME="phones-auto_dial_next_number">
<BR>
<B>Auto Dial Next Number -</B> If enabled the VICIDIAL client will dial the next number on the list automatically upon disposition of a call unless they selected to "Stop Dialing" on the disposition screen.

<BR>
<A NAME="phones-VDstop_rec_after_each_call">
<BR>
<B>Stop Rec after each call -</B> If enabled the VICIDIAL client will stop whatever recording is going on after each call has been dispositioned. Useful if you are doing a lot of recording or you are using a web form to trigger recording.

<BR>
<A NAME="phones-DBX_server">
<BR>
<B>DBX Server -</B> The MySQL database server that this user should be connecting to.

<BR>
<A NAME="phones-DBX_database">
<BR>
<B>DBX Database -</B> The MySQL database that this user should be connecting to. Default is asterisk.

<BR>
<A NAME="phones-DBX_user">
<BR>
<B>DBX User -</B> The MySQL user login that this user should be using when connecting. Default is cron.

<BR>
<A NAME="phones-DBX_pass">
<BR>
<B>DBX Pass -</B> The MySQL user password that this user should be using when connecting. Default is 1234.

<BR>
<A NAME="phones-DBX_port">
<BR>
<B>DBX Port -</B> The MySQL TCP port that this user should be using when connecting. Default is 3306.

<BR>
<A NAME="phones-DBY_server">
<BR>
<B>DBY Server -</B> The MySQL database server that this user should be connecting to. Secondary server, not used currently.

<BR>
<A NAME="phones-DBY_database">
<BR>
<B>DBY Database -</B> The MySQL database that this user should be connecting to. Default is asterisk. Secondary server, not used currently.

<BR>
<A NAME="phones-DBY_user">
<BR>
<B>DBY User -</B> The MySQL user login that this user should be using when connecting. Default is cron. Secondary server, not used currently.

<BR>
<A NAME="phones-DBY_pass">
<BR>
<B>DBY Pass -</B> The MySQL user password that this user should be using when connecting. Default is 1234. Secondary server, not used currently.

<BR>
<A NAME="phones-DBY_port">
<BR>
<B>DBY Port -</B> The MySQL TCP port that this user should be using when connecting. Default is 3306. Secondary server, not used currently.


<BR><BR><BR><BR>

<B><FONT SIZE=3>SERVERS TABLE</FONT></B><BR><BR>
<A NAME="servers-server_id">
<BR>
<B>Server ID -</B> This field is where you put the Asterisk servers name, doesnt have to be an official domain sub, just a nickname to identify the server to Admin users.

<BR>
<A NAME="servers-server_description">
<BR>
<B>Server Description -</B> The field where you use a small phrase to describe the Asterisk server.

<BR>
<A NAME="servers-server_ip">
<BR>
<B>Server IP Address -</B> The field where you put the Network IP address of the Asterisk server.

<BR>
<A NAME="servers-active">
<BR>
<B>Active -</B> Set whether the Asterisk server is active or inactive.

<BR>
<A NAME="servers-asterisk_version">
<BR>
<B>Asterisk Version -</B> Set the version of Asterisk that you have installed on this server. Examples: '1.2', '1.0.8', '1.0.7', 'CVS_HEAD', 'REALLY OLD', etc... This is used because versions 1.0.8 and 1.0.9 have a different method of dealing with Local/ channels, a bug that has been fixed in CVS v1.0, and need to be treated differently when handling their Local/ channels. Also, current CVS_HEAD and the 1.2 release tree uses different manager and command output so it must be treated differently as well.

<BR>
<A NAME="servers-max_vicidial_trunks">
<BR>
<B>Max VICIDIAL Trunks -</B> This field will determine the maximum number of lines that the VICIDIAL auto-dialer will attempt to call on this server. If you want to dedicate two full PRI T1s to VICIDIALing on a server then you would set this to 46. Default is 96.

<BR>
<A NAME="servers-telnet_host">
<BR>
<B>Telnet Host -</B> This is the address or name of the Asterisk server and is how the manager applications connect to it from where they are running. If they are running on the Asterisk server, then the default of 'localhost' is fine.

<BR>
<A NAME="servers-telnet_port">
<BR>
<B>Telnet Port -</B> This is the port of the Asterisk server Manager connection and is how the manager applications connect to it from where they are running. The default of '5038' is fine for a standard install.

<BR>
<A NAME="servers-ASTmgrUSERNAME">
<BR>
<B>Manager User -</B> The username or login used to connect genericly to the Asterisk server manager. Default is 'cron'

<BR>
<A NAME="servers-ASTmgrSECRET">
<BR>
<B>Manager Secret -</B> The secret or password used to connect genericly to the Asterisk server manager. Default is '1234'

<BR>
<A NAME="servers-ASTmgrUSERNAMEupdate">
<BR>
<B>Manager Update User -</B> The username or login used to connect to the Asterisk server manager optimized for the Update scripts. Default is 'updatecron' and assumes the same secret as the generic user.

<BR>
<A NAME="servers-ASTmgrUSERNAMElisten">
<BR>
<B>Manager Listen User -</B> The username or login used to connect to the Asterisk server manager optimized for scripts that only listen for output. Default is 'listencron' and assumes the same secret as the generic user.

<BR>
<A NAME="servers-ASTmgrUSERNAMEsend">
<BR>
<B>Manager Send User -</B> The username or login used to connect to the Asterisk server manager optimized for scripts that only send Actions to the manager. Default is 'sendcron' and assumes the same secret as the generic user.

<BR>
<A NAME="servers-local_gmt">
<BR>
<B>Server GMT offset -</B> The difference in hours from GMT time not adjusted for Daylight-Savings-Time of the server. Default is '-5'

<BR>
<A NAME="servers-voicemail_dump_exten">
<BR>
<B>VMail Dump Exten -</B> The extension prefix used on this server to send calls directly through agc to a specific voicemail box. Default is '85026666666666'

<BR>
<A NAME="servers-answer_transfer_agent">
<BR>
<B>VICIDIAL AD extension -</B> The default extension if none is present in the campaign to send calls to for VICIDIAL auto dialing. Default is '8365'

<BR>
<A NAME="servers-ext_context">
<BR>
<B>Default Context -</B> The default dialplan context used for scripts that operate for this server. Default is 'default'

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

<BR>
<A NAME="servers-vicidial_balance_active">
<BR>
<B>VICIDIAL Balance Dialing -</B> Setting this field to Y will allow the server to place balance calls for campaigns in VICIDIAL so that the defined dial level can be met even if there are no agents logged into that campaign on this server. Default is N.

<BR>
<A NAME="servers-balance_trunks_offlimits">
<BR>
<B>VICIDIAL Balance Offlimits -</B> This setting defines the number of trunks to not allow VICIDIAL balance dialing to use. For example if you have 40 max vicidial trunks and balance offlimits is set to 10 you will only be able to use 30 trunk lines for VICIDIAL balance dialing. Default is 0.


<BR><BR><BR><BR>

<B><FONT SIZE=3>CONFERENCES TABLE</FONT></B><BR><BR>
<A NAME="conferences-conf_exten">
<BR>
<B>Conference Number -</B> This field is where you put the meetme conference dialpna number. It is also recommended that the meetme number in meetme.conf matches this number for each entry. This is for the conferences in astGUIclient and is used for leave-3way-call functionality in VICIDIAL.

<BR>
<A NAME="conferences-server_ip">
<BR>
<B>Server IP -</B> The menu where you select the Asterisk server that this conference will be on.




<BR><BR><BR><BR>

<B><FONT SIZE=3>VICIDIAL_SERVER_TRUNKS TABLE</FONT></B><BR><BR>
<A NAME="vicidial_server_trunks">
<BR>
<B>VICIDIAL Server Trunks allows you to restrict the outgoing lines that are used on this server for campaign dialing on a per-campaign basis. You have the option to reserve a specific number of lines to be used by only one campaign as well as allowing that campaign to run over its reserved lines into whatever lines remain open, as long at the total lines used by vicidial on this server is less than the Max VICIDIAL Trunks setting. Not having any of these records will allow the campaign that dials the line first to have as many lines as it can get under the Max VICIDIAL Trunks setting.</B>


<BR><BR><BR><BR><BR><BR><BR><BR>
<BR><BR><BR><BR><BR><BR><BR><BR>
THE END
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
echo "<B>Show Dialable Leads Count</B> -<BR><BR>\n";
echo "<B>CAMPAIGN:</B> $campaign_id<BR>\n";
echo "<B>LISTS:</B> $camp_lists<BR>\n";
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

echo "Preview Script: $script_id<BR>\n";
echo "<TABLE WIDTH=600><TR><TD>\n";
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
  window.open (url,"",'width=620,height=300,scrollbars=yes,menubar=yes,address=yes');
}
</script>
</head>
<BODY BGCOLOR=white marginheight=0 marginwidth=0 leftmargin=0 topmargin=0>
<?
echo "<!-- ILPV -->\n";
echo "<TD WIDTH=100 ALIGN=RIGHT VALIGN=TOP  BGCOLOR=\"#CCFFCC\" NOWRAP><a href=\"../vicidial_en/admin.php?relogin=YES&VD_login=$VD_login&VD_campaign=$VD_campaign&phone_login=$phone_login&phone_pass=$phone_pass&VD_pass=$VD_pass\">English <img src=\"../agc/images/en.gif\" BORDER=0 HEIGHT=14 WIDTH=20></a></TD>\n";echo "<TD WIDTH=100 ALIGN=RIGHT VALIGN=TOP  NOWRAP><a href=\"../vicidial_es/admin.php?relogin=YES&VD_login=$VD_login&VD_campaign=$VD_campaign&phone_login=$phone_login&phone_pass=$phone_pass&VD_pass=$VD_pass\">Español <img src=\"../agc/images/es.gif\" BORDER=0 HEIGHT=14 WIDTH=20></a></TD>\n";?>
<CENTER>
<TABLE WIDTH=650 BGCOLOR=#D9E6FE cellpadding=2 cellspacing=0><TR BGCOLOR=#015B91><TD ALIGN=LEFT COLSPAN=5><FONT FACE="ARIAL,HELVETICA" COLOR=WHITE SIZE=2><B> &nbsp; VICIDIAL ADMIN - <a href="<? echo $PHP_SELF ?>?force_logout=1"><FONT FACE="ARIAL,HELVETICA" COLOR=WHITE SIZE=1>Logout</a></TD><TD ALIGN=RIGHT COLSPAN=6><FONT FACE="ARIAL,HELVETICA" COLOR=WHITE SIZE=2><B><? echo date("l F j, Y G:i:s A") ?> &nbsp; </TD></TR>

<TR BGCOLOR=#000000>
<TD ALIGN=CENTER <?=$users_hh?>><a href="<? echo $PHP_SELF ?>?ADD=0"><FONT FACE="ARIAL,HELVETICA" COLOR=<?=$users_fc?> SIZE=1><B> USERS </a></TD>
<TD ALIGN=CENTER <?=$campaigns_hh?>><a href="<? echo $PHP_SELF ?>?ADD=10"><FONT FACE="ARIAL,HELVETICA" COLOR=<?=$campaigns_fc?> SIZE=1><B> CAMPAIGNS </a></TD>
<TD ALIGN=CENTER <?=$lists_hh?>><a href="<? echo $PHP_SELF ?>?ADD=100"><FONT FACE="ARIAL,HELVETICA" COLOR=<?=$lists_fc?> SIZE=1><B> LISTS </a></TD>
<TD ALIGN=CENTER <?=$scripts_hh?>><a href="<? echo $PHP_SELF ?>?ADD=1000000"><FONT FACE="ARIAL,HELVETICA" COLOR=<?=$scripts_fc?> SIZE=1><B> SCRIPTS </a></TD>
<TD ALIGN=CENTER <?=$filters_hh?>><a href="<? echo $PHP_SELF ?>?ADD=10000000"><FONT FACE="ARIAL,HELVETICA" COLOR=<?=$filters_fc?> SIZE=1><B> FILTERS </a></TD>
<TD ALIGN=CENTER <?=$ingroups_hh?>><a href="<? echo $PHP_SELF ?>?ADD=1000"><FONT FACE="ARIAL,HELVETICA" COLOR=<?=$ingroups_fc?> SIZE=1><B> IN-GROUPS </a></TD>
<TD ALIGN=CENTER <?=$times_hh?>><a href="<? echo $PHP_SELF ?>?ADD=100000000"><FONT FACE="ARIAL,HELVETICA" COLOR=<?=$times_fc?> SIZE=1><B> CALL TIMES </a></TD>
<TD ALIGN=CENTER <?=$usergroups_hh?>><a href="<? echo $PHP_SELF ?>?ADD=100000"><FONT FACE="ARIAL,HELVETICA" COLOR=<?=$usergroups_fc?> SIZE=1><B> USER GROUPS </a></TD>
<TD ALIGN=CENTER <?=$remoteagent_hh?>><a href="<? echo $PHP_SELF ?>?ADD=10000"><FONT FACE="ARIAL,HELVETICA" COLOR=<?=$remoteagent_fc?> SIZE=1><B> REMOTE AGENTS </a></TD>
<TD ALIGN=CENTER <?=$server_hh?>><a href="<? echo $PHP_SELF ?>?ADD=10000000000"><FONT FACE="ARIAL,HELVETICA" COLOR=<?=$server_fc?> SIZE=1><B> PHONES </a></TD>
<TD ALIGN=CENTER <?=$reports_hh?>><a href="server_stats.php"><FONT FACE="ARIAL,HELVETICA" COLOR=WHITE SIZE=1><B> REPORTS </a></TD>
</TR>


<? if (strlen($users_hh) > 1) { 
	?>
<TR BGCOLOR=#FFFF99><TD ALIGN=CENTER COLSPAN=11><FONT FACE="ARIAL,HELVETICA" COLOR=BLACK SIZE=1><B> &nbsp; <a href="<? echo $PHP_SELF ?>"><FONT FACE="ARIAL,HELVETICA" COLOR=BLACK SIZE=1>LIST USERS</a> &nbsp; &nbsp; | &nbsp; &nbsp; <a href="<? echo $PHP_SELF ?>?ADD=1"><FONT FACE="ARIAL,HELVETICA" COLOR=BLACK SIZE=1>ADD A NEW USER</a> &nbsp; &nbsp; | &nbsp; &nbsp; <a href="<? echo $PHP_SELF ?>?ADD=55"><FONT FACE="ARIAL,HELVETICA" COLOR=BLACK SIZE=1>SEARCH FOR A USER</a></TD></TR>
<? } 
if (strlen($campaigns_hh) > 1) { 
	?>
<TR BGCOLOR=#FFCC99><TD ALIGN=CENTER COLSPAN=11><FONT FACE="ARIAL,HELVETICA" COLOR=BLACK SIZE=1><B> &nbsp; <a href="<? echo $PHP_SELF ?>?ADD=11"><FONT FACE="ARIAL,HELVETICA" COLOR=BLACK SIZE=1>ADD CAMPAIGN</a> &nbsp; &nbsp; | &nbsp; &nbsp; <a href="<? echo $PHP_SELF ?>?ADD=10"><FONT FACE="ARIAL,HELVETICA" COLOR=BLACK SIZE=1>LIST CAMPAIGNS</a> &nbsp; &nbsp; | &nbsp; &nbsp; <a href="./AST_timeonVDADallSUMMARY.php"><FONT FACE="ARIAL,HELVETICA" COLOR=BLACK SIZE=1>REALTIME CAMPAIGNS SUMMARY</a></TD></TR>
<? } 
if (strlen($lists_hh) > 1) { 
	?>
<TR BGCOLOR=#FFCCCC><TD ALIGN=CENTER COLSPAN=11><FONT FACE="ARIAL,HELVETICA" COLOR=BLACK SIZE=1><B> &nbsp; <a href="<? echo $PHP_SELF ?>?ADD=100"><FONT FACE="ARIAL,HELVETICA" COLOR=BLACK SIZE=1>SHOW LISTS</a> &nbsp; &nbsp; | &nbsp; &nbsp; <a href="<? echo $PHP_SELF ?>?ADD=111"><FONT FACE="ARIAL,HELVETICA" COLOR=BLACK SIZE=1>ADD NEW LIST</a> &nbsp; &nbsp; | &nbsp; &nbsp; <a href="admin_search_lead.php"><FONT FACE="ARIAL,HELVETICA" COLOR=BLACK SIZE=1>SEARCH FOR A LEAD</a> | &nbsp; &nbsp; <a href="<? echo $PHP_SELF ?>?ADD=121"><FONT FACE="ARIAL,HELVETICA" COLOR=BLACK SIZE=1>ADD NUMBER TO DNC</a> &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; | &nbsp; &nbsp; <a href="./listloaderMAIN.php"><FONT FACE="ARIAL,HELVETICA" COLOR=BLACK SIZE=1>LOAD NEW LEADS</a></TD></TR>
<? } 
if (strlen($scripts_hh) > 1) { 
	?>
<TR BGCOLOR=#99FFCC><TD ALIGN=CENTER COLSPAN=11><FONT FACE="ARIAL,HELVETICA" COLOR=BLACK SIZE=1><B> &nbsp; <a href="<? echo $PHP_SELF ?>?ADD=1111111"><FONT FACE="ARIAL,HELVETICA" COLOR=BLACK SIZE=1>ADD SCRIPT</a> &nbsp; &nbsp; | &nbsp; &nbsp; <a href="<? echo $PHP_SELF ?>?ADD=1000000"><FONT FACE="ARIAL,HELVETICA" COLOR=BLACK SIZE=1>VIEW SCRIPTS</a></TD></TR>
<? } 
if (strlen($filters_hh) > 1) { 
	?>
<TR BGCOLOR=#CCCCCC><TD ALIGN=CENTER COLSPAN=11><FONT FACE="ARIAL,HELVETICA" COLOR=BLACK SIZE=1><B> &nbsp; <a href="<? echo $PHP_SELF ?>?ADD=11111111"><FONT FACE="ARIAL,HELVETICA" COLOR=BLACK SIZE=1>ADD FILTER</a> &nbsp; &nbsp; | &nbsp; &nbsp; <a href="<? echo $PHP_SELF ?>?ADD=10000000"><FONT FACE="ARIAL,HELVETICA" COLOR=BLACK SIZE=1>VIEW FILTERS</a></TD></TR>
<? } 
if (strlen($ingroups_hh) > 1) { 
	?>
<TR BGCOLOR=#CC99FF><TD ALIGN=CENTER COLSPAN=11><FONT FACE="ARIAL,HELVETICA" COLOR=BLACK SIZE=1><B> &nbsp; <a href="<? echo $PHP_SELF ?>?ADD=1000"><FONT FACE="ARIAL,HELVETICA" COLOR=BLACK SIZE=1>SHOW IN-GROUPS</a> &nbsp; &nbsp; | &nbsp; &nbsp; <a href="<? echo $PHP_SELF ?>?ADD=1111"><FONT FACE="ARIAL,HELVETICA" COLOR=BLACK SIZE=1>ADD NEW IN-GROUP</a></TD></TR>
<? } 
if (strlen($times_hh) > 1) { 
	?>
<TR BGCOLOR=#99FF33><TD ALIGN=CENTER COLSPAN=11><FONT FACE="ARIAL,HELVETICA" COLOR=BLACK SIZE=1><B> &nbsp; <a href="<? echo $PHP_SELF ?>?ADD=100000000"><FONT FACE="ARIAL,HELVETICA" COLOR=BLACK SIZE=1>SHOW CALL TIMES</a> &nbsp; &nbsp; | &nbsp; &nbsp; <a href="<? echo $PHP_SELF ?>?ADD=111111111"><FONT FACE="ARIAL,HELVETICA" COLOR=BLACK SIZE=1>ADD NEW CALL TIME</a> &nbsp; &nbsp; | &nbsp; &nbsp; <a href="<? echo $PHP_SELF ?>?ADD=1000000000"><FONT FACE="ARIAL,HELVETICA" COLOR=BLACK SIZE=1>SHOW STATE CALL TIMES</a> &nbsp; &nbsp; |  &nbsp; &nbsp; <a href="<? echo $PHP_SELF ?>?ADD=1111111111"><FONT FACE="ARIAL,HELVETICA" COLOR=BLACK SIZE=1>ADD NEW STATE CALL TIME</a> &nbsp; </TD></TR>
<? } 
if (strlen($usergroups_hh) > 1) { 
	?>
<TR BGCOLOR=#CCFFFF><TD ALIGN=CENTER COLSPAN=11><FONT FACE="ARIAL,HELVETICA" COLOR=BLACK SIZE=1><B> &nbsp; <a href="<? echo $PHP_SELF ?>?ADD=111111"><FONT FACE="ARIAL,HELVETICA" COLOR=BLACK SIZE=1>ADD USER GROUP</a> &nbsp; &nbsp; | &nbsp; &nbsp; <a href="<? echo $PHP_SELF ?>?ADD=100000"><FONT FACE="ARIAL,HELVETICA" COLOR=BLACK SIZE=1>LIST USER GROUPS</a> &nbsp; &nbsp; | &nbsp; &nbsp; <a href="group_hourly_stats.php"><FONT FACE="ARIAL,HELVETICA" COLOR=BLACK SIZE=1>GROUP HOURLY</a></TD></TR>
<? } 
if (strlen($remoteagent_hh) > 1) { 
	?>
<TR BGCOLOR=#CCFFCC><TD ALIGN=CENTER COLSPAN=11><FONT FACE="ARIAL,HELVETICA" COLOR=BLACK SIZE=1><B> &nbsp; <a href="<? echo $PHP_SELF ?>?ADD=10000"><FONT FACE="ARIAL,HELVETICA" COLOR=BLACK SIZE=1>SHOW REMOTE AGENTS</a> &nbsp; &nbsp; | &nbsp; &nbsp; <a href="<? echo $PHP_SELF ?>?ADD=11111"><FONT FACE="ARIAL,HELVETICA" COLOR=BLACK SIZE=1>ADD NEW REMOTE AGENTS</a></TD></TR>
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
	echo "You are not authorized to view this page. Please go back.\n";
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

echo "<br>ADD A NEW USER<form action=$PHP_SELF method=POST>\n";
echo "<input type=hidden name=ADD value=2>\n";
echo "<center><TABLE width=600 cellspacing=3>\n";
echo "<tr bgcolor=#B6D3FC><td align=right>User Number: </td><td align=left><input type=text name=user size=20 maxlength=10>$NWB#vicidial_users-user$NWE</td></tr>\n";
echo "<tr bgcolor=#B6D3FC><td align=right>Password: </td><td align=left><input type=text name=pass size=20 maxlength=10>$NWB#vicidial_users-pass$NWE</td></tr>\n";
echo "<tr bgcolor=#B6D3FC><td align=right>Full Name: </td><td align=left><input type=text name=full_name size=20 maxlength=100>$NWB#vicidial_users-full_name$NWE</td></tr>\n";
echo "<tr bgcolor=#B6D3FC><td align=right>User Level: </td><td align=left><select size=1 name=user_level>";
$h=1;
while ($h<=$LOGuser_level)
	{
	echo "<option>$h</option>";
	$h++;
	}
echo "</select>$NWB#vicidial_users-user_level$NWE</td></tr>\n";
echo "<tr bgcolor=#B6D3FC><td align=right>User Group: </td><td align=left><select size=1 name=user_group>\n";

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
echo "<tr bgcolor=#B6D3FC><td align=right>Phone Login: </td><td align=left><input type=text name=phone_login size=20 maxlength=20>$NWB#vicidial_users-phone_login$NWE</td></tr>\n";
echo "<tr bgcolor=#B6D3FC><td align=right>Phone Pass: </td><td align=left><input type=text name=phone_pass size=20 maxlength=20>$NWB#vicidial_users-phone_pass$NWE</td></tr>\n";
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

echo "<br>ADD A NEW CAMPAIGN<form action=$PHP_SELF method=POST>\n";
echo "<input type=hidden name=ADD value=21>\n";
echo "<center><TABLE width=600 cellspacing=3>\n";
echo "<tr bgcolor=#B6D3FC><td align=right>Campaign ID: </td><td align=left><input type=text name=campaign_id size=10 maxlength=8>$NWB#vicidial_campaigns-campaign_id$NWE</td></tr>\n";
echo "<tr bgcolor=#B6D3FC><td align=right>Campaign Name: </td><td align=left><input type=text name=campaign_name size=30 maxlength=30>$NWB#vicidial_campaigns-campaign_name$NWE</td></tr>\n";
echo "<tr bgcolor=#B6D3FC><td align=right>Active: </td><td align=left><select size=1 name=active><option>Y</option><option>N</option></select>$NWB#vicidial_campaigns-active$NWE</td></tr>\n";
echo "<tr bgcolor=#B6D3FC><td align=right>Park Extension: </td><td align=left><input type=text name=park_ext size=10 maxlength=10>$NWB#vicidial_campaigns-park_ext$NWE</td></tr>\n";
echo "<tr bgcolor=#B6D3FC><td align=right>Park Filename: </td><td align=left><input type=text name=park_file_name size=10 maxlength=10>$NWB#vicidial_campaigns-park_file_name$NWE</td></tr>\n";
echo "<tr bgcolor=#B6D3FC><td align=right>Web Form: </td><td align=left><input type=text name=web_form_address size=50 maxlength=255>$NWB#vicidial_campaigns-web_form_address$NWE</td></tr>\n";
echo "<tr bgcolor=#B6D3FC><td align=right>Allow Closers: </td><td align=left><select size=1 name=allow_closers><option>Y</option><option>N</option></select>$NWB#vicidial_campaigns-allow_closers$NWE</td></tr>\n";
echo "<tr bgcolor=#B6D3FC><td align=right>Hopper Level: </td><td align=left><select size=1 name=hopper_level><option>1</option><option>5</option><option>10</option><option>50</option><option>100</option><option>200</option><option>500</option><option>1000</option><option>2000</option></select>$NWB#vicidial_campaigns-hopper_level$NWE</td></tr>\n";
echo "<tr bgcolor=#B6D3FC><td align=right>Auto Dial Level: </td><td align=left><select size=1 name=auto_dial_level><option selected>0</option><option>1</option><option>1.1</option><option>1.2</option><option>1.3</option><option>1.4</option><option>1.5</option><option>1.6</option><option>1.7</option><option>1.8</option><option>1.9</option><option>2.0</option><option>2.2</option><option>2.5</option><option>2.7</option><option>3.0</option><option>3.5</option><option>4.0</option></select>(0 = off)$NWB#vicidial_campaigns-auto_dial_level$NWE</td></tr>\n";
echo "<tr bgcolor=#B6D3FC><td align=right>Next Agent Call: </td><td align=left><select size=1 name=next_agent_call><option >random</option><option>oldest_call_start</option><option>oldest_call_finish</option><option>overall_user_level</option></select>$NWB#vicidial_campaigns-next_agent_call$NWE</td></tr>\n";
echo "<tr bgcolor=#B6D3FC><td align=right>Local Call Time: </td><td align=left><select size=1 name=local_call_time><option>24hours</option><option>9am-9pm</option><option>9am-5pm</option><option>12pm-5pm</option><option>12pm-9pm</option><option>5pm-9pm</option></select>$NWB#vicidial_campaigns-local_call_time$NWE</td></tr>\n";
echo "<tr bgcolor=#B6D3FC><td align=right>Voicemail: </td><td align=left><input type=text name=voicemail_ext size=10 maxlength=10 value=\"$voicemail_ext\">$NWB#vicidial_campaigns-voicemail_ext$NWE</td></tr>\n";
echo "<tr bgcolor=#B6D3FC><td align=right>Script: </td><td align=left><select size=1 name=script_id>\n";
echo "$scripts_list";
echo "</select>$NWB#vicidial_campaigns-campaign_script$NWE</td></tr>\n";
echo "<tr bgcolor=#B6D3FC><td align=right>Get Call Launch: </td><td align=left><select size=1 name=get_call_launch><option selected>NONE</option><option>SCRIPT</option><option>WEBFORM</option></select>$NWB#vicidial_campaigns-get_call_launch$NWE</td></tr>\n";
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
echo "<tr bgcolor=#B6D3FC><td align=right>List ID: </td><td align=left><input type=text name=list_id size=8 maxlength=8> (digits only)$NWB#vicidial_lists-list_id$NWE</td></tr>\n";
echo "<tr bgcolor=#B6D3FC><td align=right>List Name: </td><td align=left><input type=text name=list_name size=20 maxlength=20>$NWB#vicidial_lists-list_name$NWE</td></tr>\n";
echo "<tr bgcolor=#B6D3FC><td align=right>Campaign: </td><td align=left><select size=1 name=campaign_id>\n";

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
echo "<tr bgcolor=#B6D3FC><td align=right>Active: </td><td align=left><select size=1 name=active><option>Y</option><option SELECTED>N</option></select>$NWB#vicidial_lists-active$NWE</td></tr>\n";
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
		{echo "<br>DNC NOT ADDED - This phone number is already in the Do Not Call List: $phone_number<BR><BR>\n";}
	else
		{
		$stmt="INSERT INTO vicidial_dnc (phone_number) values('$phone_number');";
		$rslt=mysql_query($stmt, $link);

		echo "<br><B>DNC ADDED: $phone_number</B><BR><BR>\n";

		### LOG INSERTION TO LOG FILE ###
		if ($WeBRooTWritablE > 0)
			{
			$fp = fopen ("./admin_changes_log.txt", "a");
			fwrite ($fp, "$date|ADD A NEW DNC NUMBER|$PHP_AUTH_USER|$ip|'$phone_number'|\n");
			fclose($fp);
			}
		}
	}

echo "<br>ADD A NUMBER TO THE DNC LIST<form action=$PHP_SELF method=POST>\n";
echo "<input type=hidden name=ADD value=121>\n";
echo "<center><TABLE width=600 cellspacing=3>\n";
echo "<tr bgcolor=#B6D3FC><td align=right>Phone Number: </td><td align=left><input type=text name=phone_number size=14 maxlength=12> (digits only)$NWB#vicidial_list-dnc$NWE</td></tr>\n";
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

echo "<br>ADD A NEW INBOUND GROUP<form action=$PHP_SELF method=POST>\n";
echo "<input type=hidden name=ADD value=2111>\n";
echo "<center><TABLE width=600 cellspacing=3>\n";
echo "<tr bgcolor=#B6D3FC><td align=right>Group ID: </td><td align=left><input type=text name=group_id size=20 maxlength=20> (no spaces)$NWB#vicidial_inbound_groups-group_id$NWE</td></tr>\n";
echo "<tr bgcolor=#B6D3FC><td align=right>Group Name: </td><td align=left><input type=text name=group_name size=30 maxlength=30>$NWB#vicidial_inbound_groups-group_name$NWE</td></tr>\n";
echo "<tr bgcolor=#B6D3FC><td align=right>Group Color: </td><td align=left><input type=text name=group_color size=7 maxlength=7>$NWB#vicidial_inbound_groups-group_color$NWE</td></tr>\n";
echo "<tr bgcolor=#B6D3FC><td align=right>Active: </td><td align=left><select size=1 name=active><option SELECTED>Y</option><option>N</option></select>$NWB#vicidial_inbound_groups-active$NWE</td></tr>\n";
echo "<tr bgcolor=#B6D3FC><td align=right>Web Form: </td><td align=left><input type=text name=web_form_address size=50 maxlength=255 value=\"$web_form_address\">$NWB#vicidial_inbound_groups-web_form_address$NWE</td></tr>\n";
echo "<tr bgcolor=#B6D3FC><td align=right>Voicemail: </td><td align=left><input type=text name=voicemail_ext size=10 maxlength=10 value=\"$voicemail_ext\">$NWB#vicidial_inbound_groups-voicemail_ext$NWE</td></tr>\n";
echo "<tr bgcolor=#B6D3FC><td align=right>Next Agent Call: </td><td align=left><select size=1 name=next_agent_call><option >random</option><option>oldest_call_start</option><option>oldest_call_finish</option><option>overall_user_level</option></select>$NWB#vicidial_inbound_groups-next_agent_call$NWE</td></tr>\n";
echo "<tr bgcolor=#B6D3FC><td align=right>Fronter Display: </td><td align=left><select size=1 name=fronter_display><option SELECTED>Y</option><option>N</option></select>$NWB#vicidial_inbound_groups-fronter_display$NWE</td></tr>\n";
echo "<tr bgcolor=#B6D3FC><td align=right>Script: </td><td align=left><select size=1 name=script_id>\n";
echo "$scripts_list";
echo "</select>$NWB#vicidial_inbound_groups-ingroup_script$NWE</td></tr>\n";
echo "<tr bgcolor=#B6D3FC><td align=right>Get Call Launch: </td><td align=left><select size=1 name=get_call_launch><option selected>NONE</option><option>SCRIPT</option><option>WEBFORM</option></select>$NWB#vicidial_inbound_groups-get_call_launch$NWE</td></tr>\n";
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

echo "<br>ADD NEW REMOTE AGENTS<form action=$PHP_SELF method=POST>\n";
echo "<input type=hidden name=ADD value=21111>\n";
echo "<center><TABLE width=600 cellspacing=3>\n";
echo "<tr bgcolor=#B6D3FC><td align=right>User ID Start: </td><td align=left><input type=text name=user_start size=6 maxlength=6> (numbers only, incremented)$NWB#vicidial_remote_agents-user_start$NWE</td></tr>\n";
echo "<tr bgcolor=#B6D3FC><td align=right>Number of Lines: </td><td align=left><input type=text name=number_of_lines size=3 maxlength=3> (numbers only)$NWB#vicidial_remote_agents-number_of_lines$NWE</td></tr>\n";
echo "<tr bgcolor=#B6D3FC><td align=right>Server IP: </td><td align=left><select size=1 name=server_ip>\n";
echo "$servers_list";
echo "</select>$NWB#vicidial_remote_agents-server_ip$NWE</td></tr>\n";
echo "<tr bgcolor=#B6D3FC><td align=right>External Extension: </td><td align=left><input type=text name=conf_exten size=20 maxlength=20> (dialplan number dialed to reach agents)$NWB#vicidial_remote_agents-conf_exten$NWE</td></tr>\n";
echo "<tr bgcolor=#B6D3FC><td align=right>Status: </td><td align=left><select size=1 name=status><option>ACTIVE</option><option SELECTED>INACTIVE</option></select>$NWB#vicidial_remote_agents-status$NWE</td></tr>\n";
echo "<tr bgcolor=#B6D3FC><td align=right>Campaign: </td><td align=left><select size=1 name=campaign_id>\n";
echo "$campaigns_list";
echo "</select>$NWB#vicidial_remote_agents-campaign_id$NWE</td></tr>\n";
echo "<tr bgcolor=#B6D3FC><td align=right>Inbound Groups: </td><td align=left>\n";
echo "$groups_list";
echo "$NWB#vicidial_remote_agents-closer_campaigns$NWE</td></tr>\n";
echo "<tr bgcolor=#B6D3FC><td align=center colspan=2><input type=submit name=SUBMIT value=SUBMIT></td></tr>\n";
echo "</TABLE></center>\n";
echo "NOTE: It can take up to 30 seconds for changes submitted on this screen to go live\n";

}


######################
# ADD=111111 display the ADD NEW USERS GROUP SCREEN
######################

if ($ADD==111111)
{
echo "<TABLE><TR><TD>\n";
echo "<FONT FACE=\"ARIAL,HELVETICA\" COLOR=BLACK SIZE=2>";

echo "<br>ADD NEW USERS GROUP<form action=$PHP_SELF method=POST>\n";
echo "<input type=hidden name=ADD value=211111>\n";
echo "<center><TABLE width=600 cellspacing=3>\n";
echo "<tr bgcolor=#B6D3FC><td align=right>Group: </td><td align=left><input type=text name=user_group size=15 maxlength=20> (no spaces or punctuation)$NWB#vicidial_user_groups-user_group$NWE</td></tr>\n";
echo "<tr bgcolor=#B6D3FC><td align=right>Description: </td><td align=left><input type=text name=group_name size=40 maxlength=40> (description of group)$NWB#vicidial_user_groups-group_name$NWE</td></tr>\n";
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
echo "<tr bgcolor=#B6D3FC><td align=right>Script ID: </td><td align=left><input type=text name=script_id size=12 maxlength=10> (no spaces or punctuation)$NWB#vicidial_scripts-script_id$NWE</td></tr>\n";
echo "<tr bgcolor=#B6D3FC><td align=right>Script Name: </td><td align=left><input type=text name=script_name size=40 maxlength=50> (title of the script)$NWB#vicidial_scripts-script_name$NWE</td></tr>\n";
echo "<tr bgcolor=#B6D3FC><td align=right>Script Comments: </td><td align=left><input type=text name=script_comments size=50 maxlength=255> $NWB#vicidial_scripts-script_comments$NWE</td></tr>\n";
echo "<tr bgcolor=#B6D3FC><td align=right>Active: </td><td align=left><select size=1 name=active><option SELECTED>Y</option><option>N</option></select>$NWB#vicidial_scripts-active$NWE</td></tr>\n";
echo "<tr bgcolor=#B6D3FC><td align=right>Script Text: </td><td align=left><TEXTAREA NAME=script_text ROWS=20 COLS=50 value=\"\"></TEXTAREA> $NWB#vicidial_scripts-script_text$NWE</td></tr>\n";
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

echo "<br>ADD NEW FILTER<form action=$PHP_SELF method=POST>\n";
echo "<input type=hidden name=ADD value=21111111>\n";
echo "<center><TABLE width=600 cellspacing=3>\n";
echo "<tr bgcolor=#B6D3FC><td align=right>Filter ID: </td><td align=left><input type=text name=lead_filter_id size=12 maxlength=10> (no spaces or punctuation)$NWB#vicidial_lead_filters-lead_filter_id$NWE</td></tr>\n";
echo "<tr bgcolor=#B6D3FC><td align=right>Filter Name: </td><td align=left><input type=text name=lead_filter_name size=30 maxlength=30> (short description of the filter)$NWB#vicidial_lead_filters-lead_filter_name$NWE</td></tr>\n";
echo "<tr bgcolor=#B6D3FC><td align=right>Filter Comments: </td><td align=left><input type=text name=lead_filter_comments size=50 maxlength=255> $NWB#vicidial_lead_filters-lead_filter_comments$NWE</td></tr>\n";
echo "<tr bgcolor=#B6D3FC><td align=right>Filter SQL: </td><td align=left><TEXTAREA NAME=lead_filter_sql ROWS=20 COLS=50 value=\"\"></TEXTAREA> $NWB#vicidial_lead_filters-lead_filter_sql$NWE</td></tr>\n";
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

echo "<br>ADD NEW CALL TIME<form action=$PHP_SELF method=POST>\n";
echo "<input type=hidden name=ADD value=211111111>\n";
echo "<center><TABLE width=620 cellspacing=3>\n";
echo "<tr bgcolor=#B6D3FC><td align=right>Call Time ID: </td><td align=left><input type=text name=call_time_id size=12 maxlength=10> (no spaces or punctuation)$NWB#vicidial_call_times-call_time_id$NWE</td></tr>\n";
echo "<tr bgcolor=#B6D3FC><td align=right>Call Time Name: </td><td align=left><input type=text name=call_time_name size=30 maxlength=30> (short description of the call time)$NWB#vicidial_call_times-call_time_name$NWE</td></tr>\n";
echo "<tr bgcolor=#B6D3FC><td align=right>Call Time Comments: </td><td align=left><input type=text name=call_time_comments size=50 maxlength=255> $NWB#vicidial_call_times-call_time_comments$NWE</td></tr>\n";

echo "<tr bgcolor=#B6D3FC><td align=center colspan=2>Day and time options will appear once you have created the Call Time Definition</td></tr>\n";
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

echo "<br>ADD NEW STATE CALL TIME<form action=$PHP_SELF method=POST>\n";
echo "<input type=hidden name=ADD value=2111111111>\n";
echo "<center><TABLE width=620 cellspacing=3>\n";
echo "<tr bgcolor=#B6D3FC><td align=right>State Call Time ID: </td><td align=left><input type=text name=call_time_id size=12 maxlength=10> (no spaces or punctuation)$NWB#vicidial_call_times-call_time_id$NWE</td></tr>\n";
echo "<tr bgcolor=#B6D3FC><td align=right>State Call Time State: </td><td align=left><input type=text name=state_call_time_state size=4 maxlength=2> (no spaces or punctuation)$NWB#vicidial_call_times-state_call_time_state$NWE</td></tr>\n";
echo "<tr bgcolor=#B6D3FC><td align=right>State Call Time Name: </td><td align=left><input type=text name=call_time_name size=30 maxlength=30> (short description of the call time)$NWB#vicidial_call_times-call_time_name$NWE</td></tr>\n";
echo "<tr bgcolor=#B6D3FC><td align=right>State Call Time Comments: </td><td align=left><input type=text name=call_time_comments size=50 maxlength=255> $NWB#vicidial_call_times-call_time_comments$NWE</td></tr>\n";

echo "<tr bgcolor=#B6D3FC><td align=center colspan=2>Day and time options will appear once you have created the Call Time Definition</td></tr>\n";
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

echo "<br>ADD A NEW PHONE<form action=$PHP_SELF method=POST>\n";
echo "<input type=hidden name=ADD value=21111111111>\n";
echo "<center><TABLE width=600 cellspacing=3>\n";

echo "<center><TABLE width=600 cellspacing=3>\n";
echo "<tr bgcolor=#B6D3FC><td align=right>Phone extension: </td><td align=left><input type=text name=extension size=20 maxlength=100 value=\"\">$NWB#phones-extension$NWE</td></tr>\n";
echo "<tr bgcolor=#B6D3FC><td align=right>Dialplan Number: </td><td align=left><input type=text name=dialplan_number size=15 maxlength=20 value=\"$row[1]\"> (digits only)$NWB#phones-dialplan_number$NWE</td></tr>\n";
echo "<tr bgcolor=#B6D3FC><td align=right>Voicemail Box: </td><td align=left><input type=text name=voicemail_id size=10 maxlength=10 value=\"$row[2]\"> (digits only)$NWB#phones-voicemail_id$NWE</td></tr>\n";
echo "<tr bgcolor=#B6D3FC><td align=right>Outbound CallerID: </td><td align=left><input type=text name=outbound_cid size=10 maxlength=20 value=\"$row[65]\"> (digits only)$NWB#phones-outbound_cid$NWE</td></tr>\n";
echo "<tr bgcolor=#B6D3FC><td align=right>Phone IP address: </td><td align=left><input type=text name=phone_ip size=20 maxlength=15 value=\"$row[3]\"> (optional)$NWB#phones-phone_ip$NWE</td></tr>\n";
echo "<tr bgcolor=#B6D3FC><td align=right>Computer IP address: </td><td align=left><input type=text name=computer_ip size=20 maxlength=15 value=\"$row[4]\"> (optional)$NWB#phones-computer_ip$NWE</td></tr>\n";
echo "<tr bgcolor=#B6D3FC><td align=right>Server IP: </td><td align=left><select size=1 name=server_ip>\n";

echo "$servers_list";
echo "<option SELECTED>$row[5]</option>\n";
echo "</select>$NWB#phones-server_ip$NWE</td></tr>\n";
echo "<tr bgcolor=#B6D3FC><td align=right>Login: </td><td align=left><input type=text name=login size=10 maxlength=10 value=\"$row[6]\">$NWB#phones-login$NWE</td></tr>\n";
echo "<tr bgcolor=#B6D3FC><td align=right>Password: </td><td align=left><input type=text name=pass size=10 maxlength=10 value=\"$row[7]\">$NWB#phones-pass$NWE</td></tr>\n";
echo "<tr bgcolor=#B6D3FC><td align=right>Status: </td><td align=left><select size=1 name=status><option>ACTIVE</option><option>SUSPENDED</option><option>CLOSED</option><option>PENDING</option><option>ADMIN</option><option selected>$row[8]</option></select>$NWB#phones-status$NWE</td></tr>\n";
echo "<tr bgcolor=#B6D3FC><td align=right>Active Account: </td><td align=left><select size=1 name=active><option>Y</option><option>N</option><option selected>$row[9]</option></select>$NWB#phones-active$NWE</td></tr>\n";
echo "<tr bgcolor=#B6D3FC><td align=right>Phone Type: </td><td align=left><input type=text name=phone_type size=20 maxlength=50 value=\"$row[10]\">$NWB#phones-phone_type$NWE</td></tr>\n";
echo "<tr bgcolor=#B6D3FC><td align=right>Full Name: </td><td align=left><input type=text name=fullname size=20 maxlength=50 value=\"$row[11]\">$NWB#phones-fullname$NWE</td></tr>\n";
echo "<tr bgcolor=#B6D3FC><td align=right>Company: </td><td align=left><input type=text name=company size=10 maxlength=10 value=\"$row[12]\">$NWB#phones-company$NWE</td></tr>\n";
echo "<tr bgcolor=#B6D3FC><td align=right>Picture: </td><td align=left><input type=text name=picture size=20 maxlength=19 value=\"$row[13]\">$NWB#phones-picture$NWE</td></tr>\n";
echo "<tr bgcolor=#B6D3FC><td align=right>Client Protocol: </td><td align=left><select size=1 name=protocol><option>SIP</option><option>Zap</option><option>IAX2</option><option>EXTERNAL</option><option selected>$row[16]</option></select>$NWB#phones-protocol$NWE</td></tr>\n";
echo "<tr bgcolor=#B6D3FC><td align=right>Local GMT: </td><td align=left><select size=1 name=local_gmt><option>12.75</option><option>12.00</option><option>11.00</option><option>10.00</option><option>9.50</option><option>9.00</option><option>8.00</option><option>7.00</option><option>6.50</option><option>6.00</option><option>5.75</option><option>5.50</option><option>5.00</option><option>4.50</option><option>4.00</option><option>3.50</option><option>3.00</option><option>2.00</option><option>1.00</option><option>0.00</option><option>-1.00</option><option>-2.00</option><option>-3.00</option><option>-3.50</option><option>-4.00</option><option>-5.00</option><option>-6.00</option><option>-7.00</option><option>-8.00</option><option>-9.00</option><option>-10.00</option><option>-11.00</option><option>-12.00</option><option selected>$row[17]</option></select> (Do NOT Adjust for DST)$NWB#phones-local_gmt$NWE</td></tr>\n";
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

echo "<br>ADD A NEW SERVER<form action=$PHP_SELF method=POST>\n";
echo "<input type=hidden name=ADD value=211111111111>\n";
echo "<center><TABLE width=600 cellspacing=3>\n";
echo "<tr bgcolor=#B6D3FC><td align=right>Server ID: </td><td align=left><input type=text name=server_id size=10 maxlength=10>$NWB#servers-server_id$NWE</td></tr>\n";
echo "<tr bgcolor=#B6D3FC><td align=right>Server Description: </td><td align=left><input type=text name=server_description size=30 maxlength=255>$NWB#servers-server_description$NWE</td></tr>\n";
echo "<tr bgcolor=#B6D3FC><td align=right>Server IP Address: </td><td align=left><input type=text name=server_ip size=20 maxlength=15>$NWB#servers-server_ip$NWE</td></tr>\n";
echo "<tr bgcolor=#B6D3FC><td align=right>Active: </td><td align=left><select size=1 name=active><option>Y</option><option>N</option></select>$NWB#servers-active$NWE</td></tr>\n";
echo "<tr bgcolor=#B6D3FC><td align=right>Asterisk Version: </td><td align=left><input type=text name=asterisk_version size=20 maxlength=20>$NWB#servers-asterisk_version$NWE</td></tr>\n";
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

echo "<br>ADD A NEW CONFERENCE<form action=$PHP_SELF method=POST>\n";
echo "<input type=hidden name=ADD value=2111111111111>\n";
echo "<center><TABLE width=600 cellspacing=3>\n";
echo "<tr bgcolor=#B6D3FC><td align=right>Conference Number: </td><td align=left><input type=text name=conf_exten size=8 maxlength=7> (digits only)$NWB#conferences-conf_exten$NWE</td></tr>\n";
echo "<tr bgcolor=#B6D3FC><td align=right>Server IP: </td><td align=left><select size=1 name=server_ip>\n";

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
echo "<tr bgcolor=#B6D3FC><td align=right>Conference Number: </td><td align=left><input type=text name=conf_exten size=8 maxlength=7> (digits only)$NWB#conferences-conf_exten$NWE</td></tr>\n";
echo "<tr bgcolor=#B6D3FC><td align=right>Server IP: </td><td align=left><select size=1 name=server_ip>\n";

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
		{echo "<br>USER NOT ADDED - there is already a user in the system with this user number\n";}
	else
		{
		 if ( (strlen($user) < 2) or (strlen($pass) < 2) or (strlen($full_name) < 2) or (strlen($user) > 8) )
			{
			 echo "<br>USER NOT ADDED - Please go back and look at the data you entered\n";
			 echo "<br>user id must be between 2 and 8 characters long\n";
			 echo "<br>full name and password must be at least 2 characters long\n";
			}
		 else
			{
			echo "<br><B>USER ADDED: $user</B>\n";

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
		{echo "<br>CAMPAIGN NOT ADDED - there is already a campaign in the system with this ID\n";}
	else
		{
		 if ( (strlen($campaign_id) < 2) or (strlen($campaign_id) > 8) or (strlen($campaign_name) < 6)  or (strlen($campaign_name) > 40) )
			{
			 echo "<br>CAMPAIGN NOT ADDED - Please go back and look at the data you entered\n";
			 echo "<br>campaign ID must be between 2 and 8 characters in length\n";
			 echo "<br>campaign name must be between 6 and 40 characters in length\n";
			}
		 else
			{
			echo "<br><B>CAMPAIGN ADDED: $campaign_id</B>\n";

			$stmt="INSERT INTO vicidial_campaigns (campaign_id,campaign_name,active,dial_status_a,lead_order,park_ext,park_file_name,web_form_address,allow_closers,hopper_level,auto_dial_level,next_agent_call,local_call_time,voicemail_ext,campaign_script,get_call_launch) values('$campaign_id','$campaign_name','$active','NEW','DOWN','$park_ext','$park_file_name','" . mysql_real_escape_string($web_form_address) . "','$allow_closers','$hopper_level','$auto_dial_level','$next_agent_call','$local_call_time','$voicemail_ext','$script_id','$get_call_launch');";
			$rslt=mysql_query($stmt, $link);

			$stmt="INSERT INTO vicidial_campaign_stats (campaign_id) values('$campaign_id');";
			$rslt=mysql_query($stmt, $link);

			echo "<!-- $stmt -->";
			### LOG CHANGES TO LOG FILE ###
			if ($WeBRooTWritablE > 0)
				{
				$fp = fopen ("./admin_changes_log.txt", "a");
				fwrite ($fp, "$date|ADD A NEW CAMPAIGN  |$PHP_AUTH_USER|$ip|$stmt|\n");
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
		{echo "<br>CAMPAIGN STATUS NOT ADDED - there is already a campaign-status in the system with this name\n";}
	else
		{
		$stmt="SELECT count(*) from vicidial_statuses where status='$status';";
		$rslt=mysql_query($stmt, $link);
		$row=mysql_fetch_row($rslt);
		if ($row[0] > 0)
			{echo "<br>CAMPAIGN STATUS NOT ADDED - there is already a global-status in the system with this name\n";}
		else
			{
			 if ( (strlen($campaign_id) < 2) or (strlen($status) < 1) or (strlen($status_name) < 2) )
				{
				 echo "<br>CAMPAIGN STATUS NOT ADDED - Please go back and look at the data you entered\n";
				 echo "<br>status must be between 1 and 8 characters in length\n";
				 echo "<br>status name must be between 2 and 30 characters in length\n";
				}
			 else
				{
				echo "<br><B>CAMPAIGN STATUS ADDED: $campaign_id - $status</B>\n";

				$stmt="INSERT INTO vicidial_campaign_statuses values('$status','$status_name','$selectable','$campaign_id');";
				$rslt=mysql_query($stmt, $link);

				### LOG CHANGES TO LOG FILE ###
				if ($WeBRooTWritablE > 0)
					{
					$fp = fopen ("./admin_changes_log.txt", "a");
					fwrite ($fp, "$date|ADD A NEW CAMPAIGN STATUS |$PHP_AUTH_USER|$ip|'$status','$status_name','$selectable','$campaign_id'|\n");
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
		{echo "<br>CAMPAIGN HOTKEY NOT ADDED - there is already a campaign-hotkey in the system with this hotkey\n";}
	else
		{
		 if ( (strlen($campaign_id) < 2) or (strlen($status) < 1) or (strlen($hotkey) < 1) )
			{
			 echo "<br>CAMPAIGN HOTKEY NOT ADDED - Please go back and look at the data you entered\n";
			 echo "<br>hotkey must be a single character between 1 and 9 \n";
			 echo "<br>status must be between 1 and 8 characters in length\n";
			}
		 else
			{
			echo "<br><B>CAMPAIGN HOTKEY ADDED: $campaign_id - $status - $hotkey</B>\n";

			$stmt="INSERT INTO vicidial_campaign_hotkeys values('$status','$hotkey','$status_name','$selectable','$campaign_id');";
			$rslt=mysql_query($stmt, $link);

			### LOG CHANGES TO LOG FILE ###
			if ($WeBRooTWritablE > 0)
				{
				$fp = fopen ("./admin_changes_log.txt", "a");
				fwrite ($fp, "$date|ADD A NEW CAMPAIGN HOTKEY |$PHP_AUTH_USER|$ip|'$status','$hotkey','$status_name','$selectable','$campaign_id'|\n");
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
		{echo "<br>CAMPAIGN LEAD RECYCLE NOT ADDED - there is already a lead-recycle for this campaign with this status\n";}
	else
		{
		 if ( (strlen($campaign_id) < 2) or (strlen($status) < 1) or ($attempt_delay < 120) or ($attempt_maximum < 1) or ($attempt_maximum > 10) )
			{
			 echo "<br>CAMPAIGN LEAD RECYCLE NOT ADDED - Please go back and look at the data you entered\n";
			 echo "<br>status must be between 1 and 6 characters in length\n";
			 echo "<br>attempt delay must be at least 120 seconds\n";
			 echo "<br>maximum attempts must be from 1 to 10\n";
			}
		 else
			{
			echo "<br><B>CAMPAIGN LEAD RECYCLE ADDED: $campaign_id - $status - $attempt_delay</B>\n";

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
		{echo "<br>LIST NOT ADDED - there is already a list in the system with this ID\n";}
	else
		{
		 if ( (strlen($campaign_id) < 2) or (strlen($list_name) < 2)  or ($list_id < 100) or (strlen($list_id) > 8) )
			{
			 echo "<br>LIST NOT ADDED - Please go back and look at the data you entered\n";
			 echo "<br>List ID must be between 2 and 8 characters in length\n";
			 echo "<br>List name must be at least 2 characters in length\n";
			 echo "<br>List ID must be greater than 100\n";
			 }
		 else
			{
			echo "<br><B>LIST ADDED: $list_id</B>\n";

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
		{echo "<br>GROUP NOT ADDED - there is already a group in the system with this ID\n";}
	else
		{
		 if ( (strlen($group_id) < 2) or (strlen($group_name) < 2)  or (strlen($group_color) < 2) or (strlen($group_id) > 20) or (eregi(' ',$group_id)) or (eregi("\-",$group_id)) or (eregi("\+",$group_id)) )
			{
			 echo "<br>GROUP NOT ADDED - Please go back and look at the data you entered\n";
			 echo "<br>Group ID must be between 2 and 20 characters in length and contain no ' -+'.\n";
			 echo "<br>Group name and group color must be at least 2 characters in length\n";
			}
		 else
			{
			$stmt="INSERT INTO vicidial_inbound_groups (group_id,group_name,group_color,active,web_form_address,voicemail_ext,next_agent_call,fronter_display,ingroup_script,get_call_launch) values('$group_id','$group_name','$group_color','$active','" . mysql_real_escape_string($web_form_address) . "','$voicemail_ext','$next_agent_call','$fronter_display','$script_id','$get_call_launch');";
			$rslt=mysql_query($stmt, $link);

			echo "<br><B>GROUP ADDED: $group_id</B>\n";

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
		{echo "<br>REMOTE AGENTS NOT ADDED - there is already a remote agents entry starting with this userID\n";}
	else
		{
		 if ( (strlen($server_ip) < 2) or (strlen($user_start) < 2)  or (strlen($campaign_id) < 2) or (strlen($conf_exten) < 2) )
			{
			 echo "<br>REMOTE AGENTS NOT ADDED - Please go back and look at the data you entered\n";
			 echo "<br>User ID start and external extension must be at least 2 characters in length\n";
			 }
		 else
			{
			$stmt="INSERT INTO vicidial_remote_agents values('','$user_start','$number_of_lines','$server_ip','$conf_exten','$status','$campaign_id','$groups_value');";
			$rslt=mysql_query($stmt, $link);

			echo "<br><B>REMOTE AGENTS ADDED: $user_start</B>\n";

			### LOG CHANGES TO LOG FILE ###
			if ($WeBRooTWritablE > 0)
				{
				$fp = fopen ("./admin_changes_log.txt", "a");
				fwrite ($fp, "$date|ADD A NEW REMOTE AGENTS ENTRY     |$PHP_AUTH_USER|$ip|'$user_start','$number_of_lines','$server_ip','$conf_exten','$status','$campaign_id','$groups_value'|\n");
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
		{echo "<br>USER GROUP NOT ADDED - there is already a user group entry with this name\n";}
	else
		{
		 if ( (strlen($user_group) < 2) or (strlen($group_name) < 2) )
			{
			 echo "<br>USER GROUP NOT ADDED - Please go back and look at the data you entered\n";
			 echo "<br>Group name and description must be at least 2 characters in length\n";
			 }
		 else
			{
			$stmt="INSERT INTO vicidial_user_groups(user_group,group_name,allowed_campaigns) values('$user_group','$group_name','-ALL-CAMPAIGNS-');";
			$rslt=mysql_query($stmt, $link);

			echo "<br><B>USER GROUP ADDED: $user_group</B>\n";

			### LOG CHANGES TO LOG FILE ###
			if ($WeBRooTWritablE > 0)
				{
				$fp = fopen ("./admin_changes_log.txt", "a");
				fwrite ($fp, "$date|ADD A NEW USER GROUP ENTRY     |$PHP_AUTH_USER|$ip|$stmt|\n");
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
		{echo "<br>SCRIPT NOT ADDED - there is already a script entry with this name\n";}
	else
		{
		 if ( (strlen($script_id) < 2) or (strlen($script_name) < 2) or (strlen($script_text) < 2) )
			{
			 echo "<br>SCRIPT NOT ADDED - Please go back and look at the data you entered\n";
			 echo "<br>Script name, description and text must be at least 2 characters in length\n";
			 }
		 else
			{
			$stmt="INSERT INTO vicidial_scripts values('$script_id','$script_name','$script_comments','$script_text','$active');";
			$rslt=mysql_query($stmt, $link);

			echo "<br><B>SCRIPT ADDED: $script_id</B>\n";

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
		{echo "<br>FILTER NOT ADDED - there is already a filter entry with this ID\n";}
	else
		{
		 if ( (strlen($lead_filter_id) < 2) or (strlen($lead_filter_name) < 2) or (strlen($lead_filter_sql) < 2) )
			{
			 echo "<br>FILTER NOT ADDED - Please go back and look at the data you entered\n";
			 echo "<br>Filter ID, name and SQL must be at least 2 characters in length\n";
			 }
		 else
			{
			$stmt="INSERT INTO vicidial_lead_filters SET lead_filter_id='$lead_filter_id',lead_filter_name='$lead_filter_name',lead_filter_comments='$lead_filter_comments',lead_filter_sql='$lead_filter_sql';";
			$rslt=mysql_query($stmt, $link);

			echo "<br><B>FILTER ADDED: $lead_filter_id</B>\n";

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
		{echo "<br>CALL TIME DEFINITION NOT ADDED - there is already a call time entry with this ID\n";}
	else
		{
		 if ( (strlen($call_time_id) < 2) or (strlen($call_time_name) < 2) )
			{
			 echo "<br>CALL TIME DEFINITION NOT ADDED - Please go back and look at the data you entered\n";
			 echo "<br>Call Time ID and name must be at least 2 characters in length\n";
			 }
		 else
			{
			$stmt="INSERT INTO vicidial_call_times SET call_time_id='$call_time_id',call_time_name='$call_time_name',call_time_comments='$call_time_comments';";
			$rslt=mysql_query($stmt, $link);

			echo "<br><B>CALL TIME ADDED: $call_time_id</B>\n";

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
		{echo "<br>STATE CALL TIME DEFINITION NOT ADDED - there is already a call time entry with this ID\n";}
	else
		{
		 if ( (strlen($call_time_id) < 2) or (strlen($call_time_name) < 2) or (strlen($state_call_time_state) < 2) )
			{
			 echo "<br>STATE CALL TIME DEFINITION NOT ADDED - Please go back and look at the data you entered\n";
			 echo "<br>State Call Time ID, name and state must be at least 2 characters in length\n";
			 }
		 else
			{
			$stmt="INSERT INTO vicidial_state_call_times SET state_call_time_id='$call_time_id',state_call_time_name='$call_time_name',state_call_time_comments='$call_time_comments',state_call_time_state='$state_call_time_state';";
			$rslt=mysql_query($stmt, $link);

			echo "<br><B>STATE CALL TIME ADDED: $call_time_id</B>\n";

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
		{echo "<br>PHONE NOT ADDED - there is already a Phone in the system with this extension/server\n";}
	else
		{
		 if ( (strlen($extension) < 1) or (strlen($server_ip) < 7) or (strlen($dialplan_number) < 1) or (strlen($voicemail_id) < 1) or (strlen($login) < 1)  or (strlen($pass) < 1))
			{echo "<br>PHONE NOT ADDED - Please go back and look at the data you entered\n";}
		 else
			{
			echo "<br>PHONE ADDED\n";

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
		{echo "<br>SERVER NOT ADDED - there is already a server in the system with this ID\n";}
	else
		{
		 if ( (strlen($server_id) < 1) or (strlen($server_ip) < 7) )
			{echo "<br>SERVER NOT ADDED - Please go back and look at the data you entered\n";}
		 else
			{
			echo "<br>SERVER ADDED\n";

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
		echo "<br>VICIDIAL SERVER TRUNK RECORD NOT ADDED - the number of vicidial trunks is too high: $SUMvicidial_trunks / $MAXvicidial_trunks\n";
		}
	else
		{
		$stmt="SELECT count(*) from vicidial_server_trunks where campaign_id='$campaign_id' and server_ip='$server_ip';";
		$rslt=mysql_query($stmt, $link);
		$row=mysql_fetch_row($rslt);
		if ($row[0] > 0)
			{echo "<br>VICIDIAL SERVER TRUNK RECORD NOT ADDED - there is already a server-trunk record for this campaign\n";}
		else
			{
			 if ( (strlen($campaign_id) < 2) or (strlen($server_ip) < 7) or (strlen($dedicated_trunks) < 1) or (strlen($trunk_restriction) < 1) )
				{
				 echo "<br>VICIDIAL SERVER TRUNK RECORD NOT ADDED - Please go back and look at the data you entered\n";
				 echo "<br>campaign must be between 3 and 8 characters in length\n";
				 echo "<br>server_ip delay must be at least 7 characters\n";
				 echo "<br>trunks must be a digit from 0 to 9999\n";
				}
			 else
				{
				echo "<br><B>VICIDIAL SERVER TRUNK RECORD ADDED: $campaign_id - $server_ip - $dedicated_trunks - $trunk_restriction</B>\n";

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
		{echo "<br>CONFERENCE NOT ADDED - there is already a conference in the system with this ID and server\n";}
	else
		{
		 if ( (strlen($conf_exten) < 1) or (strlen($server_ip) < 7) )
			{echo "<br>CONFERENCE NOT ADDED - Please go back and look at the data you entered\n";}
		 else
			{
			echo "<br>CONFERENCE ADDED\n";

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
			{echo "<br>VICIDIAL CONFERENCE NOT ADDED - Please go back and look at the data you entered\n";}
		 else
			{
			echo "<br>VICIDIAL CONFERENCE ADDED\n";

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
		 echo "<br>USER NOT MODIFIED - Please go back and look at the data you entered\n";
		 echo "<br>Password and Full Name each need ot be at least 2 characters in length\n";
		}
	 else
		{
		echo "<br><B>USER MODIFIED - ADMIN: $user</B>\n";

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
		 echo "<br>USER NOT MODIFIED - Please go back and look at the data you entered\n";
		 echo "<br>Password and Full Name each need ot be at least 2 characters in length\n";
		}
	 else
		{
		echo "<br><B>USER MODIFIED - ADMIN: $user</B>\n";

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
		 echo "<br>USER NOT MODIFIED - Please go back and look at the data you entered\n";
		 echo "<br>Password and Full Name each need ot be at least 2 characters in length\n";
		}
	 else
		{
		echo "<br><B>USER MODIFIED: $user</B>\n";

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
		 echo "<br>CAMPAIGN NOT MODIFIED - Please go back and look at the data you entered\n";
		 echo "<br>the campaign name needs to be at least 6 characters in length\n";
		}
	 else
		{
		echo "<br><B>CAMPAIGN MODIFIED: $campaign_id</B>\n";

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
			echo "<br>RESETTING CAMPAIGN LEAD HOPPER\n";
			echo "<br> - Wait 1 minute before dialing next number\n";
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
		 echo "<br>CAMPAIGN STATUS NOT MODIFIED - Please go back and look at the data you entered\n";
		 echo "<br>the campaign id needs to be at least 2 characters in length\n";
		 echo "<br>the campaign status needs to be at least 1 characters in length\n";
		}
	 else
		{
		echo "<br><B>CUSTOM CAMPAIGN STATUS DELETED: $campaign_id - $status</B>\n";

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
		 echo "<br>CAMPAIGN HOTKEY NOT MODIFIED - Please go back and look at the data you entered\n";
		 echo "<br>the campaign id needs to be at least 2 characters in length\n";
		 echo "<br>the campaign status needs to be at least 1 characters in length\n";
		 echo "<br>the campaign hotkey needs to be at least 1 characters in length\n";
		}
	 else
		{
		echo "<br><B>CUSTOM CAMPAIGN HOTKEY DELETED: $campaign_id - $status - $hotkey</B>\n";

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
		 echo "<br>CAMPAIGN NOT MODIFIED - Please go back and look at the data you entered\n";
		 echo "<br>the campaign name needs to be at least 6 characters in length\n";
		}
	 else
		{
		echo "<br><B>CAMPAIGN MODIFIED: $campaign_id</B>\n";

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
			echo "<br>RESETTING CAMPAIGN LEAD HOPPER\n";
			echo "<br> - Wait 1 minute before dialing next number\n";
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
		 echo "<br>CAMPAIGN LEAD RECYCLE NOT MODIFIED - Please go back and look at the data you entered\n";
		 echo "<br>status must be between 1 and 6 characters in length\n";
		 echo "<br>attempt delay must be at least 120 seconds\n";
		 echo "<br>maximum attempts must be from 1 to 10\n";
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
		 echo "<br>LIST NOT MODIFIED - Please go back and look at the data you entered\n";
		 echo "<br>list name must be at least 2 characters in length\n";
		}
	 else
		{
		echo "<br><B>LIST MODIFIED: $list_id</B>\n";

		$stmt="UPDATE vicidial_lists set list_name='$list_name',campaign_id='$campaign_id',active='$active' where list_id='$list_id';";
		$rslt=mysql_query($stmt, $link);

		if ($reset_list == 'Y')
			{
			echo "<br>RESETTING LIST-CALLED-STATUS\n";
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
			echo "<br>REMOVING LIST HOPPER LEADS FROM OLD CAMPAIGN HOPPER ($old_campaign_id)\n";
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
		 echo "<br>GROUP NOT MODIFIED - Please go back and look at the data you entered\n";
		 echo "<br>group name and group color must be at least 2 characters in length\n";
		}
	 else
		{
		echo "<br><B>GROUP MODIFIED: $group_id</B>\n";

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
		 echo "<br>REMOTE AGENTS NOT MODIFIED - Please go back and look at the data you entered\n";
		 echo "<br>User ID Start and External Extension must be at least 2 characters in length\n";
		}
	 else
		{
		$stmt="UPDATE vicidial_remote_agents set user_start='$user_start', number_of_lines='$number_of_lines', server_ip='$server_ip', conf_exten='$conf_exten', status='$status', campaign_id='$campaign_id', closer_campaigns='$groups_value' where remote_agent_id='$remote_agent_id';";
		$rslt=mysql_query($stmt, $link);

		echo "<br><B>REMOTE AGENTS MODIFIED</B>\n";

		### LOG CHANGES TO LOG FILE ###
		if ($WeBRooTWritablE > 0)
			{
			$fp = fopen ("./admin_changes_log.txt", "a");
			fwrite ($fp, "$date|MODIFY REMOTE AGENTS ENTRY     |$PHP_AUTH_USER|$ip|set user_start='$user_start', number_of_lines='$number_of_lines', server_ip='$server_ip', conf_exten='$conf_exten', status='$status', campaign_id='$campaign_id', closer_campaigns='$groups_value' where remote_agent_id='$remote_agent_id'|\n");
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
		 echo "<br>USER GROUP NOT MODIFIED - Please go back and look at the data you entered\n";
		 echo "<br>Group name and description must be at least 2 characters in length\n";
		}
	 else
		{
		$stmt="UPDATE vicidial_user_groups set user_group='$user_group', group_name='$group_name',allowed_campaigns='$campaigns_value' where user_group='$OLDuser_group';";
		$rslt=mysql_query($stmt, $link);

		echo "<br><B>USER GROUP MODIFIED</B>\n";

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
		 echo "<br>SCRIPT NOT MODIFIED - Please go back and look at the data you entered\n";
		 echo "<br>Script name, description and text must be at least 2 characters in length\n";
		}
	 else
		{
		$stmt="UPDATE vicidial_scripts set script_name='$script_name', script_comments='$script_comments', script_text='$script_text', active='$active' where script_id='$script_id';";
		$rslt=mysql_query($stmt, $link);

		echo "<br><B>SCRIPT MODIFIED</B>\n";

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
		 echo "<br>FILTER NOT MODIFIED - Please go back and look at the data you entered\n";
		 echo "<br>Filter ID, name and SQL must be at least 2 characters in length\n";
		}
	 else
		{
		$stmt="UPDATE vicidial_lead_filters set lead_filter_name='$lead_filter_name', lead_filter_comments='$lead_filter_comments', lead_filter_sql='$lead_filter_sql' where lead_filter_id='$lead_filter_id';";
		$rslt=mysql_query($stmt, $link);

		echo "<br><B>FILTER MODIFIED</B>\n";

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
		 echo "<br>CALL TIME NOT MODIFIED - Please go back and look at the data you entered\n";
		 echo "<br>Call Time ID and name must be at least 2 characters in length\n";
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

		echo "<br><B>CALL TIME MODIFIED</B>\n";

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
		 echo "<br>STATE CALL TIME NOT MODIFIED - Please go back and look at the data you entered\n";
		 echo "<br>State Call Time ID, name and state must be at least 2 characters in length\n";
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

		echo "<br><B>STATE CALL TIME MODIFIED</B>\n";

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
		{echo "<br>PHONE NOT MODIFIED - there is already a Phone in the system with this extension/server\n";}
	else
		{
			 if ( (strlen($extension) < 1) or (strlen($server_ip) < 7) or (strlen($dialplan_number) < 1) or (strlen($voicemail_id) < 1) or (strlen($login) < 1)  or (strlen($pass) < 1))
			{echo "<br>PHONE NOT MODIFIED - Please go back and look at the data you entered\n";}
		 else
			{
			echo "<br>PHONE MODIFIED: $extension\n";

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
		{echo "<br>SERVER NOT MODIFIED - there is already a server in the system with this server_id\n";}
	else
		{
		$stmt="SELECT count(*) from servers where server_ip='$server_ip';";
		$rslt=mysql_query($stmt, $link);
		$row=mysql_fetch_row($rslt);
		if ( ($row[0] > 0) && ($server_ip != $old_server_ip) )
			{echo "<br>SERVER NOT MODIFIED - there is already a server in the system with this server_ip\n";}
		else
			{
			 if ( (strlen($server_id) < 1) or (strlen($server_ip) < 7) )
				{echo "<br>SERVER NOT MODIFIED - Please go back and look at the data you entered\n";}
			 else
				{
				echo "<br>SERVER MODIFIED: $server_ip\n";

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
		echo "<br>VICIDIAL SERVER TRUNK RECORD NOT ADDED - the number of vicidial trunks is too high: $SUMvicidial_trunks / $MAXvicidial_trunks\n";
		}
	else
		{
		 if ( (strlen($campaign_id) < 2) or (strlen($server_ip) < 7) or (strlen($dedicated_trunks) < 1) or (strlen($trunk_restriction) < 1) )
			{
			 echo "<br>VICIDIAL SERVER TRUNK RECORD NOT MODIFIED - Please go back and look at the data you entered\n";
			 echo "<br>campaign must be between 3 and 8 characters in length\n";
			 echo "<br>server_ip delay must be at least 7 characters\n";
			 echo "<br>trunks must be a digit from 0 to 9999\n";
			}
		 else
			{
			echo "<br><B>VICIDIAL SERVER TRUNK RECORD MODIFIED: $campaign_id - $server_ip - $dedicated_trunks - $trunk_restriction</B>\n";

			$stmt="UPDATE vicidial_server_trunks SET dedicated_trunks='$dedicated_trunks',trunk_restriction='$trunk_restriction' where campaign_id='$campaign_id' and server_ip='$server_ip';";
			$rslt=mysql_query($stmt, $link);

			### LOG CHANGES TO LOG FILE ###
			if ($WeBRooTWritablE > 0)
				{
				$fp = fopen ("./admin_changes_log.txt", "a");
				fwrite ($fp, "$date|MODIFY SERVER TRUNK   |$PHP_AUTH_USER|$ip|$stmt|\n");
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
		{echo "<br>CONFERENCE NOT MODIFIED - there is already a Conference in the system with this extension-server\n";}
	else
		{
		 if ( (strlen($conf_exten) < 1) or (strlen($server_ip) < 7) )
			{echo "<br>CONFERENCE NOT MODIFIED - Please go back and look at the data you entered\n";}
		 else
			{
			echo "<br>CONFERENCE MODIFIED: $conf_exten\n";

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
		{echo "<br>VICIDIAL CONFERENCE NOT MODIFIED - there is already a Conference in the system with this extension-server\n";}
	else
		{
		 if ( (strlen($conf_exten) < 1) or (strlen($server_ip) < 7) )
			{echo "<br>VICIDIAL CONFERENCE NOT MODIFIED - Please go back and look at the data you entered\n";}
		 else
			{
			echo "<br>VICIDIAL CONFERENCE MODIFIED: $conf_exten\n";

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
		 echo "<br>USER NOT DELETED - Please go back and look at the data you entered\n";
		 echo "<br>User be at least 2 characters in length\n";
		}
	 else
		{
		echo "<br><B>USER DELETION CONFIRMATION: $user</B>\n";
		echo "<br><br><a href=\"$PHP_SELF?ADD=6&user=$user&CoNfIrM=YES\">Click here to delete user $user</a><br><br><br>\n";
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
		 echo "<br>CAMPAIGN NOT DELETED - Please go back and look at the data you entered\n";
		 echo "<br>Campaign_id be at least 2 characters in length\n";
		}
	 else
		{
		echo "<br><B>CAMPAIGN DELETION CONFIRMATION: $campaign_id</B>\n";
		echo "<br><br><a href=\"$PHP_SELF?ADD=61&campaign_id=$campaign_id&CoNfIrM=YES\">Click here to delete campaign $campaign_id</a><br><br><br>\n";
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
		 echo "<br>AGENTS NOT LOGGED OUT OF CAMPAIGN - Please go back and look at the data you entered\n";
		 echo "<br>Campaign_id be at least 2 characters in length\n";
		}
	 else
		{
		echo "<br><B>AGENT LOGOUT CONFIRMATION: $campaign_id</B>\n";
		echo "<br><br><a href=\"$PHP_SELF?ADD=62&campaign_id=$campaign_id&CoNfIrM=YES\">Click here to log all agents out of $campaign_id</a><br><br><br>\n";
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
		 echo "<br>VDAC NOT CLEARED FOR CAMPAIGN - Please go back and look at the data you entered\n";
		 echo "<br>Campaign_id be at least 2 characters in length\n";
		}
	 else
		{
		echo "<br><B>VDAC CLEAR CONFIRMATION: $campaign_id</B>\n";
		echo "<br><br><a href=\"$PHP_SELF?ADD=63&campaign_id=$campaign_id&CoNfIrM=YES&&stage=$stage\">Click here to delete the oldest LIVE record in VDAC for $campaign_id</a><br><br><br>\n";
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
		 echo "<br>LIST NOT DELETED - Please go back and look at the data you entered\n";
		 echo "<br>List_id be at least 2 characters in length\n";
		}
	 else
		{
		echo "<br><B>LIST DELETION CONFIRMATION: $list_id</B>\n";
		echo "<br><br><a href=\"$PHP_SELF?ADD=611&list_id=$list_id&CoNfIrM=YES\">Click here to delete list and all of its leads $list_id</a><br><br><br>\n";
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
		 echo "<br>IN-GROUP NOT DELETED - Please go back and look at the data you entered\n";
		 echo "<br>Group_id be at least 2 characters in length\n";
		}
	 else
		{
		echo "<br><B>IN-GROUP DELETION CONFIRMATION: $group_id</B>\n";
		echo "<br><br><a href=\"$PHP_SELF?ADD=6111&group_id=$group_id&CoNfIrM=YES\">Click here to delete in-group $group_id</a><br><br><br>\n";
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
		 echo "<br>REMOTE AGENT NOT DELETED - Please go back and look at the data you entered\n";
		 echo "<br>Remote_agent_id be at least 2 characters in length\n";
		}
	 else
		{
		echo "<br><B>REMOTE AGENT DELETION CONFIRMATION: $remote_agent_id</B>\n";
		echo "<br><br><a href=\"$PHP_SELF?ADD=61111&remote_agent_id=$remote_agent_id&CoNfIrM=YES\">Click here to delete remote agent $remote_agent_id</a><br><br><br>\n";
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
		 echo "<br>USER GROUP NOT DELETED - Please go back and look at the data you entered\n";
		 echo "<br>User_group be at least 2 characters in length\n";
		}
	 else
		{
		echo "<br><B>USER GROUP DELETION CONFIRMATION: $user_group</B>\n";
		echo "<br><br><a href=\"$PHP_SELF?ADD=611111&user_group=$user_group&CoNfIrM=YES\">Click here to delete user group $user_group</a><br><br><br>\n";
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
		 echo "<br>SCRIPT NOT DELETED - Please go back and look at the data you entered\n";
		 echo "<br>Script_id must be at least 2 characters in length\n";
		}
	 else
		{
		echo "<br><B>SCRIPT DELETION CONFIRMATION: $script_id</B>\n";
		echo "<br><br><a href=\"$PHP_SELF?ADD=6111111&script_id=$script_id&CoNfIrM=YES\">Click here to delete script $script_id</a><br><br><br>\n";
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
		 echo "<br>FILTER NOT DELETED - Please go back and look at the data you entered\n";
		 echo "<br>Filter ID must be at least 2 characters in length\n";
		}
	 else
		{
		echo "<br><B>FILTER DELETION CONFIRMATION: $lead_filter_id</B>\n";
		echo "<br><br><a href=\"$PHP_SELF?ADD=61111111&lead_filter_id=$lead_filter_id&CoNfIrM=YES\">Click here to delete filter $lead_filter_id</a><br><br><br>\n";
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
		 echo "<br>CALL TIME NOT DELETED - Please go back and look at the data you entered\n";
		 echo "<br>Call Time ID must be at least 2 characters in length\n";
		}
	 else
		{
		echo "<br><B>CALL TIME DELETION CONFIRMATION: $call_time_id</B>\n";
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
		 echo "<br>STATE CALL TIME NOT DELETED - Please go back and look at the data you entered\n";
		 echo "<br>Call Time ID must be at least 2 characters in length\n";
		}
	 else
		{
		echo "<br><B>STATE CALL TIME DELETION CONFIRMATION: $call_time_id</B>\n";
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
		 echo "<br>PHONE NOT DELETED - Please go back and look at the data you entered\n";
		 echo "<br>Extension be at least 2 characters in length\n";
		 echo "<br>Server IP be at least 7 characters in length\n";
		}
	 else
		{
		echo "<br><B>PHONE DELETION CONFIRMATION: $extension - $server_ip</B>\n";
		echo "<br><br><a href=\"$PHP_SELF?ADD=61111111111&extension=$extension&server_ip=$server_ip&CoNfIrM=YES\">Click here to delete phone $extension - $server_ip</a><br><br><br>\n";
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
		 echo "<br>SERVER NOT DELETED - Please go back and look at the data you entered\n";
		 echo "<br>Server ID be at least 2 characters in length\n";
		 echo "<br>Server IP be at least 7 characters in length\n";
		}
	 else
		{
		echo "<br><B>SERVER DELETION CONFIRMATION: $server_id - $server_ip</B>\n";
		echo "<br><br><a href=\"$PHP_SELF?ADD=611111111111&server_id=$server_id&server_ip=$server_ip&CoNfIrM=YES\">Click here to delete phone $server_id - $server_ip</a><br><br><br>\n";
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
		 echo "<br>CONFERENCE NOT DELETED - Please go back and look at the data you entered\n";
		 echo "<br>Conference must be at least 2 characters in length\n";
		 echo "<br>Server IP be at least 7 characters in length\n";
		}
	 else
		{
		echo "<br><B>CONFERENCE DELETION CONFIRMATION: $conf_exten - $server_ip</B>\n";
		echo "<br><br><a href=\"$PHP_SELF?ADD=6111111111111&conf_exten=$conf_exten&server_ip=$server_ip&CoNfIrM=YES\">Click here to delete phone $conf_exten - $server_ip</a><br><br><br>\n";
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
		 echo "<br>VICIDIAL CONFERENCE NOT DELETED - Please go back and look at the data you entered\n";
		 echo "<br>Conference must be at least 2 characters in length\n";
		 echo "<br>Server IP be at least 7 characters in length\n";
		}
	 else
		{
		echo "<br><B>VICIDIAL CONFERENCE DELETION CONFIRMATION: $conf_exten - $server_ip</B>\n";
		echo "<br><br><a href=\"$PHP_SELF?ADD=61111111111111&conf_exten=$conf_exten&server_ip=$server_ip&CoNfIrM=YES\">Click here to delete phone $conf_exten - $server_ip</a><br><br><br>\n";
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
		 echo "<br>USER NOT DELETED - Please go back and look at the data you entered\n";
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
		echo "<br><B>USER DELETION COMPLETED: $user</B>\n";
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
		 echo "<br>CAMPAIGN NOT DELETED - Please go back and look at the data you entered\n";
		 echo "<br>Campaign_id be at least 2 characters in length\n";
		}
	 else
		{
		$stmt="DELETE from vicidial_campaigns where campaign_id='$campaign_id' limit 1;";
		$rslt=mysql_query($stmt, $link);

		echo "<br>REMOVING LIST HOPPER LEADS FROM OLD CAMPAIGN HOPPER ($campaign_id)\n";
		$stmt="DELETE from vicidial_hopper where campaign_id='$campaign_id';";
		$rslt=mysql_query($stmt, $link);

		### LOG CHANGES TO LOG FILE ###
		if ($WeBRooTWritablE > 0)
			{
			$fp = fopen ("./admin_changes_log.txt", "a");
			fwrite ($fp, "$date|!!DELETING CAMPAIGN!|$PHP_AUTH_USER|$ip|campaign_id='$campaign_id'|\n");
			fclose($fp);
			}
		echo "<br><B>CAMPAIGN DELETION COMPLETED: $campaign_id</B>\n";
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
		 echo "<br>AGENTS NOT LOGGED OUT OF CAMPAIGN - Please go back and look at the data you entered\n";
		 echo "<br>Campaign_id be at least 2 characters in length\n";
		}
	 else
		{
		$stmt="DELETE from vicidial_live_agents where campaign_id='$campaign_id';";
		$rslt=mysql_query($stmt, $link);

		### LOG CHANGES TO LOG FILE ###
		if ($WeBRooTWritablE > 0)
			{
			$fp = fopen ("./admin_changes_log.txt", "a");
			fwrite ($fp, "$date|!!AGENT LOGOUT!!!!!!|$PHP_AUTH_USER|$ip|campaign_id='$campaign_id'|\n");
			fclose($fp);
			}
		echo "<br><B>AGENT LOGOUT COMPLETED: $campaign_id</B>\n";
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
		 echo "<br>VDAC NOT CLEARED FOR CAMPAIGN - Please go back and look at the data you entered\n";
		 echo "<br>Campaign_id be at least 2 characters in length\n";
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
		echo "<br><B>LAST VDAC RECORD CLEARED FOR CAMPAIGN: $campaign_id</B>\n";
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
		 echo "<br>CAMPAIGN LEAD RECYCLE NOT DELETED - Please go back and look at the data you entered\n";
		 echo "<br>status must be between 1 and 6 characters in length\n";
		 echo "<br>attempt delay must be at least 120 seconds\n";
		 echo "<br>maximum attempts must be from 1 to 10\n";
		}
	 else
		{
		echo "<br><B>CAMPAIGN LEAD RECYCLE DELETED: $campaign_id - $status - $attempt_delay</B>\n";

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
		 echo "<br>LIST NOT DELETED - Please go back and look at the data you entered\n";
		 echo "<br>List_id be at least 2 characters in length\n";
		}
	 else
		{
		$stmt="DELETE from vicidial_lists where list_id='$list_id' limit 1;";
		$rslt=mysql_query($stmt, $link);

		echo "<br>REMOVING LIST HOPPER LEADS FROM OLD CAMPAIGN HOPPER ($list_id)\n";
		$stmt="DELETE from vicidial_hopper where list_id='$list_id';";
		$rslt=mysql_query($stmt, $link);

		echo "<br>REMOVING LIST LEADS FROM VICIDIAL_LIST TABLE\n";
		$stmt="DELETE from vicidial_list where list_id='$list_id';";
		$rslt=mysql_query($stmt, $link);

		### LOG CHANGES TO LOG FILE ###
		if ($WeBRooTWritablE > 0)
			{
			$fp = fopen ("./admin_changes_log.txt", "a");
			fwrite ($fp, "$date|!!!DELETING LIST!!!!|$PHP_AUTH_USER|$ip|list_id='$list_id'|\n");
			fclose($fp);
			}
		echo "<br><B>LIST DELETION COMPLETED: $list_id</B>\n";
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
		 echo "<br>IN-GROUP NOT DELETED - Please go back and look at the data you entered\n";
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
		echo "<br><B>IN-GROUP DELETION COMPLETED: $group_id</B>\n";
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
		 echo "<br>REMOTE AGENT NOT DELETED - Please go back and look at the data you entered\n";
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
		echo "<br><B>REMOTE AGENT DELETION COMPLETED: $remote_agent_id</B>\n";
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
		 echo "<br>USER GROUP NOT DELETED - Please go back and look at the data you entered\n";
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
		echo "<br><B>USER GROUP DELETION COMPLETED: $user_group</B>\n";
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
		 echo "<br>SCRIPT NOT DELETED - Please go back and look at the data you entered\n";
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
		echo "<br><B>SCRIPT DELETION COMPLETED: $script_id</B>\n";
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
		 echo "<br>FILTER NOT DELETED - Please go back and look at the data you entered\n";
		 echo "<br>Filter ID must be at least 2 characters in length\n";
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
		echo "<br><B>FILTER DELETION COMPLETED: $lead_filter_id</B>\n";
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
		 echo "<br>CALL TIME NOT DELETED - Please go back and look at the data you entered\n";
		 echo "<br>Call Time ID must be at least 2 characters in length\n";
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
		echo "<br><B>CALL TIME DELETION COMPLETED: $call_time_id</B>\n";
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
		 echo "<br>STATE CALL TIME NOT DELETED - Please go back and look at the data you entered\n";
		 echo "<br>Call Time ID must be at least 2 characters in length\n";
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
			echo "State Rule Removed: $sct_ids[$o]<BR>\n";
			$o++;
		}

		### LOG CHANGES TO LOG FILE ###
		if ($WeBRooTWritablE > 0)
			{
			$fp = fopen ("./admin_changes_log.txt", "a");
			fwrite ($fp, "$date|!DELETING CALL TIME!|$PHP_AUTH_USER|$ip|state_call_time_id='$call_time_id'|\n");
			fclose($fp);
			}
		echo "<br><B>STATE CALL TIME DELETION COMPLETED: $call_time_id</B>\n";
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
		 echo "<br>PHONE NOT DELETED - Please go back and look at the data you entered\n";
		 echo "<br>Extension be at least 2 characters in length\n";
		 echo "<br>Server IP be at least 7 characters in length\n";
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
		echo "<br><B>PHONE DELETION COMPLETED: $extension - $server_ip</B>\n";
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
		 echo "<br>SERVER NOT DELETED - Please go back and look at the data you entered\n";
		 echo "<br>Server ID be at least 2 characters in length\n";
		 echo "<br>Server IP be at least 7 characters in length\n";
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
		echo "<br><B>SERVER DELETION COMPLETED: $server_id - $server_ip</B>\n";
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
		 echo "<br>VICIDIAL SERVER TRUNK RECORD NOT DELETED - Please go back and look at the data you entered\n";
		 echo "<br>campaign must be between 3 and 8 characters in length\n";
		 echo "<br>server_ip delay must be at least 7 characters\n";
		}
	 else
		{
		echo "<br><B>VICIDIAL SERVER TRUNK RECORD DELETED: $campaign_id - $server_ip</B>\n";

		$stmt="DELETE FROM vicidial_server_trunks where campaign_id='$campaign_id' and server_ip='$server_ip';";
		$rslt=mysql_query($stmt, $link);

		### LOG CHANGES TO LOG FILE ###
		if ($WeBRooTWritablE > 0)
			{
			$fp = fopen ("./admin_changes_log.txt", "a");
			fwrite ($fp, "$date|DELETE SERVER TRUNK   |$PHP_AUTH_USER|$ip|$stmt|\n");
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
		 echo "<br>CONFERENCE NOT DELETED - Please go back and look at the data you entered\n";
		 echo "<br>Conference be at least 2 characters in length\n";
		 echo "<br>Server IP be at least 7 characters in length\n";
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
		 echo "<br>VICIDIAL CONFERENCE NOT DELETED - Please go back and look at the data you entered\n";
		 echo "<br>Conference be at least 2 characters in length\n";
		 echo "<br>Server IP be at least 7 characters in length\n";
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
	echo "<br>You do not have permissions to modify this user: $row[1]\n";
	}
else
	{
	echo "<br>MODIFY A USERS RECORD: $row[1]<form action=$PHP_SELF method=POST>\n";
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
	echo "<tr bgcolor=#B6D3FC><td align=right>User Number: </td><td align=left><b>$row[1]</b>$NWB#vicidial_users-user$NWE</td></tr>\n";
	echo "<tr bgcolor=#B6D3FC><td align=right>Password: </td><td align=left><input type=text name=pass size=20 maxlength=10 value=\"$row[2]\">$NWB#vicidial_users-pass$NWE</td></tr>\n";
	echo "<tr bgcolor=#B6D3FC><td align=right>Full Name: </td><td align=left><input type=text name=full_name size=30 maxlength=30 value=\"$row[3]\">$NWB#vicidial_users-full_name$NWE</td></tr>\n";
	echo "<tr bgcolor=#B6D3FC><td align=right>User Level: </td><td align=left><select size=1 name=user_level>";
	$h=1;
	while ($h<=$LOGuser_level)
		{
		echo "<option>$h</option>";
		$h++;
		}
	echo "<option SELECTED>$row[4]</option></select>$NWB#vicidial_users-user_level$NWE</td></tr>\n";
	echo "<tr bgcolor=#B6D3FC><td align=right>User Group: </td><td align=left><select size=1 name=user_group>\n";

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
	echo "<tr bgcolor=#B6D3FC><td align=right>Phone Login: </td><td align=left><input type=text name=phone_login size=20 maxlength=20 value=\"$phone_login\">$NWB#vicidial_users-phone_login$NWE</td></tr>\n";
	echo "<tr bgcolor=#B6D3FC><td align=right>Phone Pass: </td><td align=left><input type=text name=phone_pass size=20 maxlength=20 value=\"$phone_pass\">$NWB#vicidial_users-phone_pass$NWE</td></tr>\n";

	if ( ($LOGuser_level > 8) or ($LOGalter_agent_interface == "1") )
		{
		echo "<tr bgcolor=BLACK><td colspan=2 align=center><font color=white><B>AGENT INTERFACE OPTIONS:</td></tr>\n";
		echo "<tr bgcolor=#B6D3FC><td align=right>Agent Choose Ingroups: </td><td align=left><select size=1 name=agent_choose_ingroups><option>0</option><option>1</option><option SELECTED>$agent_choose_ingroups</option></select>$NWB#vicidial_users-agent_choose_ingroups$NWE</td></tr>\n";
		echo "<tr bgcolor=#B6D3FC><td align=right>HotKeys Active: </td><td align=left><select size=1 name=hotkeys_active><option>0</option><option>1</option><option SELECTED>$hotkeys_active</option></select>$NWB#vicidial_users-hotkeys_active$NWE</td></tr>\n";
		echo "<tr bgcolor=#B6D3FC><td align=right>Scheduled Callbacks: </td><td align=left><select size=1 name=scheduled_callbacks><option>0</option><option>1</option><option SELECTED>$scheduled_callbacks</option></select>$NWB#vicidial_users-scheduled_callbacks$NWE</td></tr>\n";
		echo "<tr bgcolor=#B6D3FC><td align=right>Agent-Only Callbacks: </td><td align=left><select size=1 name=agentonly_callbacks><option>0</option><option>1</option><option SELECTED>$agentonly_callbacks</option></select>$NWB#vicidial_users-agentonly_callbacks$NWE</td></tr>\n";
		echo "<tr bgcolor=#B6D3FC><td align=right>Agent Call Manual: </td><td align=left><select size=1 name=agentcall_manual><option>0</option><option>1</option><option SELECTED>$agentcall_manual</option></select>$NWB#vicidial_users-agentcall_manual$NWE</td></tr>\n";
		echo "<tr bgcolor=#B6D3FC><td align=right>Vicidial Recording: </td><td align=left><select size=1 name=vicidial_recording><option>0</option><option>1</option><option SELECTED>$vicidial_recording</option></select>$NWB#vicidial_users-vicidial_recording$NWE</td></tr>\n";
		echo "<tr bgcolor=#B6D3FC><td align=right>Vicidial Transfers: </td><td align=left><select size=1 name=vicidial_transfers><option>0</option><option>1</option><option SELECTED>$vicidial_transfers</option></select>$NWB#vicidial_users-vicidial_transfers$NWE</td></tr>\n";
		echo "<tr bgcolor=#B6D3FC><td align=right>Closer Default Blended: </td><td align=left><select size=1 name=closer_default_blended><option>0</option><option>1</option><option SELECTED>$closer_default_blended</option></select>$NWB#vicidial_users-closer_default_blended$NWE</td></tr>\n";
		echo "<tr bgcolor=#B6D3FC><td align=right>Inbound Groups: </td><td align=left>\n";
		echo "$groups_list";
		echo "$NWB#vicidial_users-closer_campaigns$NWE</td></tr>\n";
		}
	if ($LOGuser_level > 8)
		{
		echo "<tr bgcolor=BLACK><td colspan=2 align=center><font color=white><B>ADMIN INTERFACE OPTIONS:</td></tr>\n";
		echo "<tr bgcolor=#B6D3FC><td align=right>Alter Agent Interface Options: </td><td align=left><select size=1 name=alter_agent_interface_options><option>0</option><option>1</option><option SELECTED>$alter_agent_interface_options</option></select>$NWB#vicidial_users-alter_agent_interface_options$NWE</td></tr>\n";
		echo "<tr bgcolor=#B6D3FC><td align=right>Delete Users: </td><td align=left><select size=1 name=delete_users><option>0</option><option>1</option><option SELECTED>$delete_users</option></select>$NWB#vicidial_users-delete_users$NWE</td></tr>\n";
		echo "<tr bgcolor=#B6D3FC><td align=right>Delete User Groups: </td><td align=left><select size=1 name=delete_user_groups><option>0</option><option>1</option><option SELECTED>$delete_user_groups</option></select>$NWB#vicidial_users-delete_user_groups$NWE</td></tr>\n";
		echo "<tr bgcolor=#B6D3FC><td align=right>Delete Lists: </td><td align=left><select size=1 name=delete_lists><option>0</option><option>1</option><option SELECTED>$delete_lists</option></select>$NWB#vicidial_users-delete_lists$NWE</td></tr>\n";
		echo "<tr bgcolor=#B6D3FC><td align=right>Delete Campaigns: </td><td align=left><select size=1 name=delete_campaigns><option>0</option><option>1</option><option SELECTED>$delete_campaigns</option></select>$NWB#vicidial_users-delete_campaigns$NWE</td></tr>\n";
		echo "<tr bgcolor=#B6D3FC><td align=right>Delete In-Groups: </td><td align=left><select size=1 name=delete_ingroups><option>0</option><option>1</option><option SELECTED>$delete_ingroups</option></select>$NWB#vicidial_users-delete_ingroups$NWE</td></tr>\n";
		echo "<tr bgcolor=#B6D3FC><td align=right>Delete Remote Agents: </td><td align=left><select size=1 name=delete_remote_agents><option>0</option><option>1</option><option SELECTED>$delete_remote_agents</option></select>$NWB#vicidial_users-delete_remote_agents$NWE</td></tr>\n";
		echo "<tr bgcolor=#B6D3FC><td align=right>Delete Scripts: </td><td align=left><select size=1 name=delete_scripts><option>0</option><option>1</option><option SELECTED>$delete_scripts</option></select>$NWB#vicidial_users-delete_scripts$NWE</td></tr>\n";
		echo "<tr bgcolor=#B6D3FC><td align=right>Load Leads: </td><td align=left><select size=1 name=load_leads><option>0</option><option>1</option><option SELECTED>$load_leads</option></select>$NWB#vicidial_users-load_leads$NWE</td></tr>\n";
		echo "<tr bgcolor=#B6D3FC><td align=right>Campaign Detail: </td><td align=left><select size=1 name=campaign_detail><option>0</option><option>1</option><option SELECTED>$campaign_detail</option></select>$NWB#vicidial_users-campaign_detail$NWE</td></tr>\n";
		echo "<tr bgcolor=#B6D3FC><td align=right>AGC Admin Access: </td><td align=left><select size=1 name=ast_admin_access><option>0</option><option>1</option><option SELECTED>$ast_admin_access</option></select>$NWB#vicidial_users-ast_admin_access$NWE</td></tr>\n";
		echo "<tr bgcolor=#B6D3FC><td align=right>AGC Delete Phones: </td><td align=left><select size=1 name=ast_delete_phones><option>0</option><option>1</option><option SELECTED>$ast_delete_phones</option></select>$NWB#vicidial_users-ast_delete_phones$NWE</td></tr>\n";
		echo "<tr bgcolor=#B6D3FC><td align=right>Modify Leads: </td><td align=left><select size=1 name=modify_leads><option>0</option><option>1</option><option SELECTED>$modify_leads</option></select>$NWB#vicidial_users-modify_leads$NWE</td></tr>\n";
		echo "<tr bgcolor=#B6D3FC><td align=right>Change Agent Campaign: </td><td align=left><select size=1 name=change_agent_campaign><option>0</option><option>1</option><option SELECTED>$change_agent_campaign</option></select>$NWB#vicidial_users-change_agent_campaign$NWE</td></tr>\n";
		echo "<tr bgcolor=#B6D3FC><td align=right>Delete Filters: </td><td align=left><select size=1 name=delete_filters><option>0</option><option>1</option><option SELECTED>$delete_filters</option></select>$NWB#vicidial_users-delete_filters$NWE</td></tr>\n";
		echo "<tr bgcolor=#B6D3FC><td align=right>Delete Call Times: </td><td align=left><select size=1 name=delete_call_times><option>0</option><option>1</option><option SELECTED>$delete_call_times</option></select>$NWB#vicidial_users-delete_call_times$NWE</td></tr>\n";
		echo "<tr bgcolor=#B6D3FC><td align=right>Modify Call Times: </td><td align=left><select size=1 name=modify_call_times><option>0</option><option>1</option><option SELECTED>$modify_call_times</option></select>$NWB#vicidial_users-modify_call_times$NWE</td></tr>\n";
		}
	echo "<tr bgcolor=#B6D3FC><td align=center colspan=2><input type=submit name=SUBMIT value=SUBMIT></td></tr>\n";
	echo "</TABLE></center>\n";

	if ($LOGdelete_users > 0)
		{
		echo "<br><br><a href=\"$PHP_SELF?ADD=5&user=$row[1]\">DELETE THIS USER</a>\n";
		}
	echo "<br><br><a href=\"./AST_agent_time_sheet.php?agent=$row[1]\">Click here for user time sheet</a>\n";
	echo "<br><br><a href=\"./user_status.php?user=$row[1]\">Click here for user status</a>\n";
	echo "<br><br><a href=\"./user_stats.php?user=$row[1]\">Click here for user stats</a>\n";
	echo "<br><br><a href=\"$PHP_SELF?ADD=8&user=$row[1]\">Click here for user CallBack Holds</a>\n";
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

echo "<br>MODIFY A CAMPAIGNS RECORD: $row[0] - <a href=\"$PHP_SELF?ADD=34&campaign_id=$campaign_id\">Basic View</a>";
echo " | Detail View</a> | ";
echo "<a href=\"./AST_timeonVDADall.php?RR=4&DB=0&group=$row[0]\">Realtime Screen</a>\n";
echo "<form action=$PHP_SELF method=POST>\n";
echo "<input type=hidden name=ADD value=41>\n";
echo "<input type=hidden name=campaign_id value=\"$campaign_id\">\n";
echo "<center><TABLE width=600 cellspacing=3>\n";
echo "<tr bgcolor=#B6D3FC><td align=right>Campaign ID: </td><td align=left><b>$row[0]</b>$NWB#vicidial_campaigns-campaign_id$NWE</td></tr>\n";
echo "<tr bgcolor=#B6D3FC><td align=right>Campaign Name: </td><td align=left><input type=text name=campaign_name size=40 maxlength=40 value=\"$row[1]\">$NWB#vicidial_campaigns-campaign_name$NWE</td></tr>\n";
echo "<tr bgcolor=#B6D3FC><td align=right>Active: </td><td align=left><select size=1 name=active><option>Y</option><option>N</option><option SELECTED>$row[2]</option></select>$NWB#vicidial_campaigns-active$NWE</td></tr>\n";
echo "<tr bgcolor=#B6D3FC><td align=right>Park Extension: </td><td align=left><input type=text name=park_ext size=10 maxlength=10 value=\"$row[9]\"> - Filename: <input type=text name=park_file_name size=10 maxlength=10 value=\"$row[10]\">$NWB#vicidial_campaigns-park_ext$NWE</td></tr>\n";
echo "<tr bgcolor=#B6D3FC><td align=right>Web Form: </td><td align=left><input type=text name=web_form_address size=50 maxlength=255 value=\"$row[11]\">$NWB#vicidial_campaigns-web_form_address$NWE</td></tr>\n";
echo "<tr bgcolor=#B6D3FC><td align=right>Allow Closers: </td><td align=left><select size=1 name=allow_closers><option>Y</option><option>N</option><option SELECTED>$row[12]</option></select>$NWB#vicidial_campaigns-allow_closers$NWE</td></tr>\n";
echo "<tr bgcolor=#B6D3FC><td align=right>Dial status 1: </td><td align=left><select size=1 name=dial_status_a>\n";
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
echo "<tr bgcolor=#B6D3FC><td align=right>Dial status 2: </td><td align=left><select size=1 name=dial_status_b>\n";
echo "<option value=\"\"> - NONE - </option>\n";
echo "$statuses_list";
echo "<option value=\"$dial_status_b\" SELECTED>$dial_status_b - $statname_list[$dial_status_b]</option>\n";
echo "</select>$NWB#vicidial_campaigns-dial_status$NWE</td></tr>\n";
echo "<tr bgcolor=#B6D3FC><td align=right>Dial status 3: </td><td align=left><select size=1 name=dial_status_c>\n";
echo "<option value=\"\"> - NONE - </option>\n";
echo "$statuses_list";
echo "<option value=\"$dial_status_c\" SELECTED>$dial_status_c - $statname_list[$dial_status_c]</option>\n";
echo "</select>$NWB#vicidial_campaigns-dial_status$NWE</td></tr>\n";
echo "<tr bgcolor=#B6D3FC><td align=right>Dial status 4: </td><td align=left><select size=1 name=dial_status_d>\n";
echo "<option value=\"\"> - NONE - </option>\n";
echo "$statuses_list";
echo "<option value=\"$dial_status_d\" SELECTED>$dial_status_d - $statname_list[$dial_status_d]</option>\n";
echo "</select>$NWB#vicidial_campaigns-dial_status$NWE</td></tr>\n";
echo "<tr bgcolor=#B6D3FC><td align=right>Dial status 5: </td><td align=left><select size=1 name=dial_status_e>\n";
echo "<option value=\"\"> - NONE - </option>\n";
echo "$statuses_list";
echo "<option value=\"$dial_status_e\" SELECTED>$dial_status_e - $statname_list[$dial_status_e]</option>\n";
echo "</select>$NWB#vicidial_campaigns-dial_status$NWE</td></tr>\n";

echo "<tr bgcolor=#B6D3FC><td align=right>List Order: </td><td align=left><select size=1 name=lead_order><option>DOWN</option><option>UP</option><option>UP PHONE</option><option>DOWN PHONE</option><option>UP LAST NAME</option><option>DOWN LAST NAME</option><option>UP COUNT</option><option>DOWN COUNT</option><option>DOWN COUNT 2nd NEW</option><option>DOWN COUNT 3rd NEW</option><option>DOWN COUNT 4th NEW</option><option SELECTED>$lead_order</option></select>$NWB#vicidial_campaigns-lead_order$NWE</td></tr>\n";

echo "<tr bgcolor=#B6D3FC><td align=right><a href=\"$PHP_SELF?ADD=31111111&lead_filter_id=$lead_filter_id\">Lead Filter</a>: </td><td align=left><select size=1 name=lead_filter_id>\n";
echo "$filters_list";
echo "<option selected value=\"$lead_filter_id\">$lead_filter_id - $filtername_list[$lead_filter_id]</option>\n";
echo "</select>$NWB#vicidial_campaigns-lead_filter_id$NWE</td></tr>\n";

echo "<tr bgcolor=#B6D3FC><td align=right>Hopper Level: </td><td align=left><select size=1 name=hopper_level><option>1</option><option>5</option><option>10</option><option>50</option><option>100</option><option>200</option><option>500</option><option>750</option><option>1000</option><option>2000</option><option SELECTED>$hopper_level</option></select>$NWB#vicidial_campaigns-hopper_level$NWE</td></tr>\n";

echo "<tr bgcolor=#B6D3FC><td align=right>Force Reset of Hopper: </td><td align=left><select size=1 name=reset_hopper><option>Y</option><option SELECTED>N</option></select>$NWB#vicidial_campaigns-force_reset_hopper$NWE</td></tr>\n";

echo "<tr bgcolor=#BDFFBD><td align=right>Dial Method: </td><td align=left><select size=1 name=dial_method><option >MANUAL</option><option>RATIO</option><option>ADAPT_HARD_LIMIT</option><option>ADAPT_TAPERED</option><option>ADAPT_AVERAGE</option><option SELECTED>$dial_method</option></select>$NWB#vicidial_campaigns-dial_method$NWE</td></tr>\n";

echo "<tr bgcolor=#BDFFBD><td align=right>Auto Dial Level: </td><td align=left><select size=1 name=auto_dial_level><option >0</option><option>1</option><option>1.1</option><option>1.2</option><option>1.3</option><option>1.4</option><option>1.5</option><option>1.6</option><option>1.7</option><option>1.8</option><option>1.9</option><option>2.0</option><option>2.2</option><option>2.5</option><option>2.7</option><option>3.0</option><option>3.5</option><option>4.0</option><option SELECTED>$auto_dial_level</option></select>(0 = off)$NWB#vicidial_campaigns-auto_dial_level$NWE</td></tr>\n";

echo "<tr bgcolor=#BDFFBD><td align=right>Available Only Tally: </td><td align=left><select size=1 name=available_only_ratio_tally><option >Y</option><option>N</option><option SELECTED>$available_only_ratio_tally</option></select>$NWB#vicidial_campaigns-available_only_ratio_tally$NWE</td></tr>\n";

echo "<tr bgcolor=#BDFFBD><td align=right>Drop Percentage Limit: </td><td align=left><select size=1 name=adaptive_dropped_percentage>\n";
$n=100;
while ($n>=1)
	{
	echo "<option>$n</option>\n";
	$n--;
	}
echo "<option SELECTED>$adaptive_dropped_percentage</option></select>% $NWB#vicidial_campaigns-adaptive_dropped_percentage$NWE</td></tr>\n";

echo "<tr bgcolor=#BDFFBD><td align=right>Maximum Adapt Dial Level: </td><td align=left><input type=text name=adaptive_maximum_level size=6 maxlength=6 value=\"$adaptive_maximum_level\"><i>number only</i> $NWB#vicidial_campaigns-adaptive_maximum_level$NWE</td></tr>\n";

echo "<tr bgcolor=#BDFFBD><td align=right>Latest Server Time: </td><td align=left><input type=text name=adaptive_latest_server_time size=6 maxlength=4 value=\"$adaptive_latest_server_time\"><i>4 digits only</i> $NWB#vicidial_campaigns-adaptive_latest_server_time$NWE</td></tr>\n";

echo "<tr bgcolor=#BDFFBD><td align=right>Adapt Intensity Modifier: </td><td align=left><select size=1 name=adaptive_intensity>\n";
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



echo "<tr bgcolor=#BDFFBD><td align=right>Dial Level Difference Target: </td><td align=left><select size=1 name=adaptive_dl_diff_target>\n";
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


echo "<tr bgcolor=#B6D3FC><td align=right>Next Agent Call: </td><td align=left><select size=1 name=next_agent_call><option >random</option><option>oldest_call_start</option><option>oldest_call_finish</option><option>overall_user_level</option><option SELECTED>$next_agent_call</option></select>$NWB#vicidial_campaigns-next_agent_call$NWE</td></tr>\n";

echo "<tr bgcolor=#B6D3FC><td align=right><a href=\"$PHP_SELF?ADD=311111111&call_time_id=$local_call_time\">Local Call Time: </a></td><td align=left><select size=1 name=local_call_time>\n";
echo "$call_times_list";
echo "<option selected value=\"$local_call_time\">$local_call_time - $call_timename_list[$local_call_time]</option>\n";
echo "</select>$NWB#vicidial_campaigns-local_call_time$NWE</td></tr>\n";

echo "<tr bgcolor=#B6D3FC><td align=right>Dial Timeout: </td><td align=left><input type=text name=dial_timeout size=3 maxlength=3 value=\"$dial_timeout\"> <i>in seconds</i>$NWB#vicidial_campaigns-dial_timeout$NWE</td></tr>\n";

echo "<tr bgcolor=#B6D3FC><td align=right>Dial Prefix: </td><td align=left><input type=text name=dial_prefix size=20 maxlength=20 value=\"$dial_prefix\"> <font size=1>for 91NXXNXXXXXX value would be 9, for no dial prefix use X</font>$NWB#vicidial_campaigns-dial_prefix$NWE</td></tr>\n";

echo "<tr bgcolor=#B6D3FC><td align=right>Omit Phone Code: </td><td align=left><select size=1 name=omit_phone_code><option>Y</option><option>N</option><option SELECTED>$omit_phone_code</option></select>$NWB#vicidial_campaigns-omit_phone_code$NWE</td></tr>\n";

echo "<tr bgcolor=#B6D3FC><td align=right>Campaign CallerID: </td><td align=left><input type=text name=campaign_cid size=20 maxlength=20 value=\"$campaign_cid\">$NWB#vicidial_campaigns-campaign_cid$NWE</td></tr>\n";

echo "<tr bgcolor=#B6D3FC><td align=right>Campaign VDAD exten: </td><td align=left><input type=text name=campaign_vdad_exten size=10 maxlength=20 value=\"$campaign_vdad_exten\">$NWB#vicidial_campaigns-campaign_vdad_exten$NWE</td></tr>\n";

echo "<tr bgcolor=#B6D3FC><td align=right>Campaign Rec exten: </td><td align=left><input type=text name=campaign_rec_exten size=10 maxlength=10 value=\"$campaign_rec_exten\">$NWB#vicidial_campaigns-campaign_rec_exten$NWE</td></tr>\n";

echo "<tr bgcolor=#B6D3FC><td align=right>Campaign Recording: </td><td align=left><select size=1 name=campaign_recording><option>NEVER</option><option>ONDEMAND</option><option>ALLCALLS</option><option>ALLFORCE</option><option SELECTED>$campaign_recording</option></select>$NWB#vicidial_campaigns-campaign_recording$NWE</td></tr>\n";

echo "<tr bgcolor=#B6D3FC><td align=right>Campaign Rec Filename: </td><td align=left><input type=text name=campaign_rec_filename size=50 maxlength=50 value=\"$campaign_rec_filename\">$NWB#vicidial_campaigns-campaign_rec_filename$NWE</td></tr>\n";

echo "<tr bgcolor=#B6D3FC><td align=right>Recording Delay: </td><td align=left><input type=text name=allcalls_delay size=3 maxlength=3 value=\"$allcalls_delay\"> <i>in seconds</i>$NWB#vicidial_campaigns-allcalls_delay$NWE</td></tr>\n";

echo "<tr bgcolor=#B6D3FC><td align=right><a href=\"$PHP_SELF?ADD=3111111&script_id=$script_id\">Script</a>: </td><td align=left><select size=1 name=script_id>\n";
echo "$scripts_list";
echo "<option selected value=\"$script_id\">$script_id - $scriptname_list[$script_id]</option>\n";
echo "</select>$NWB#vicidial_campaigns-campaign_script$NWE</td></tr>\n";

echo "<tr bgcolor=#B6D3FC><td align=right>Get Call Launch: </td><td align=left><select size=1 name=get_call_launch><option selected>NONE</option><option>SCRIPT</option><option>WEBFORM</option><option selected>$get_call_launch</option></select>$NWB#vicidial_campaigns-get_call_launch$NWE</td></tr>\n";

echo "<tr bgcolor=#B6D3FC><td align=right>Answering Machine Message: </td><td align=left><input type=text name=am_message_exten size=10 maxlength=20 value=\"$am_message_exten\">$NWB#vicidial_campaigns-am_message_exten$NWE</td></tr>\n";

echo "<tr bgcolor=#B6D3FC><td align=right>AMD Send to VM exten: </td><td align=left><select size=1 name=amd_send_to_vmx><option>Y</option><option>N</option><option SELECTED>$amd_send_to_vmx</option></select>$NWB#vicidial_campaigns-amd_send_to_vmx$NWE</td></tr>\n";

echo "<tr bgcolor=#B6D3FC><td align=right>Transfer-Conf DTMF 1: </td><td align=left><input type=text name=xferconf_a_dtmf size=20 maxlength=50 value=\"$xferconf_a_dtmf\">$NWB#vicidial_campaigns-xferconf_a_dtmf$NWE</td></tr>\n";

echo "<tr bgcolor=#B6D3FC><td align=right>Transfer-Conf Number 1: </td><td align=left><input type=text name=xferconf_a_number size=20 maxlength=50 value=\"$xferconf_a_number\">$NWB#vicidial_campaigns-xferconf_a_dtmf$NWE</td></tr>\n";

echo "<tr bgcolor=#B6D3FC><td align=right>Transfer-Conf DTMF 2: </td><td align=left><input type=text name=xferconf_b_dtmf size=20 maxlength=50 value=\"$xferconf_b_dtmf\">$NWB#vicidial_campaigns-xferconf_a_dtmf$NWE</td></tr>\n";

echo "<tr bgcolor=#B6D3FC><td align=right>Transfer-Conf Number 2: </td><td align=left><input type=text name=xferconf_b_number size=20 maxlength=50 value=\"$xferconf_b_number\">$NWB#vicidial_campaigns-xferconf_a_dtmf$NWE</td></tr>\n";

echo "<tr bgcolor=#B6D3FC><td align=right>Alt Number Dialing: </td><td align=left><select size=1 name=alt_number_dialing><option>Y</option><option>N</option><option SELECTED>$alt_number_dialing</option></select>$NWB#vicidial_campaigns-alt_number_dialing$NWE</td></tr>\n";

echo "<tr bgcolor=#B6D3FC><td align=right>Scheduled Callbacks: </td><td align=left><select size=1 name=scheduled_callbacks><option>Y</option><option>N</option><option SELECTED>$scheduled_callbacks</option></select>$NWB#vicidial_campaigns-scheduled_callbacks$NWE</td></tr>\n";

echo "<tr bgcolor=#B6D3FC><td align=right>Drop Call Seconds: </td><td align=left><input type=text name=drop_call_seconds size=5 maxlength=2 value=\"$drop_call_seconds\">$NWB#vicidial_campaigns-drop_call_seconds$NWE</td></tr>\n";

echo "<tr bgcolor=#B6D3FC><td align=right>Voicemail: </td><td align=left><input type=text name=voicemail_ext size=10 maxlength=10 value=\"$voicemail_ext\">$NWB#vicidial_campaigns-voicemail_ext$NWE</td></tr>\n";

echo "<tr bgcolor=#B6D3FC><td align=right>Use Safe Harbor Message: </td><td align=left><select size=1 name=safe_harbor_message><option>Y</option><option>N</option><option SELECTED>$safe_harbor_message</option></select>$NWB#vicidial_campaigns-safe_harbor_message$NWE</td></tr>\n";

echo "<tr bgcolor=#B6D3FC><td align=right>Safe Harbor Exten: </td><td align=left><input type=text name=safe_harbor_exten size=10 maxlength=20 value=\"$safe_harbor_exten\">$NWB#vicidial_campaigns-safe_harbor_exten$NWE</td></tr>\n";

echo "<tr bgcolor=#B6D3FC><td align=right>Wrapup Seconds: </td><td align=left><input type=text name=wrapup_seconds size=5 maxlength=3 value=\"$wrapup_seconds\">$NWB#vicidial_campaigns-wrapup_seconds$NWE</td></tr>\n";

echo "<tr bgcolor=#B6D3FC><td align=right>Wrapup Message: </td><td align=left><input type=text name=wrapup_message size=40 maxlength=255 value=\"$wrapup_message\">$NWB#vicidial_campaigns-wrapup_message$NWE</td></tr>\n";

echo "<tr bgcolor=#B6D3FC><td align=right>Use Internal DNC List: </td><td align=left><select size=1 name=use_internal_dnc><option>Y</option><option>N</option><option SELECTED>$use_internal_dnc</option></select>$NWB#vicidial_campaigns-use_internal_dnc$NWE</td></tr>\n";


if (eregi("CLOSER", $campaign_id))
	{
	echo "<tr bgcolor=#B6D3FC><td align=right>Allowed Inbound Groups: <BR>";
	echo " $NWB#vicidial_campaigns-closer_campaigns$NWE</td><td align=left>\n";
	echo "$groups_list";
	echo "</td></tr>\n";
	}



echo "<tr bgcolor=#B6D3FC><td align=center colspan=2><input type=submit name=SUBMIT value=SUBMIT></td></tr>\n";
echo "</TABLE></center></FORM>\n";

echo "<center>\n";
echo "<br><b>LISTS WITHIN THIS CAMPAIGN: &nbsp; $NWB#vicidial_campaign_lists$NWE</b><br>\n";
echo "<TABLE width=400 cellspacing=3>\n";
echo "<tr><td>LIST ID</td><td>LIST NAME</td><td>ACTIVE</td></tr>\n";

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
echo "This campaign has $active_lists active lists and $inactive_lists inactive lists<br><br>\n";

if ($display_dialable_count == 'Y')
	{
	### call function to calculate and print dialable leads
	dialable_leads($DB,$link,$local_call_time,$dial_status_a,$dial_status_b,$dial_status_c,$dial_status_d,$dial_status_e,$camp_lists,$fSQL);
	echo " - <font size=1><a href=\"$PHP_SELF?ADD=31&campaign_id=$campaign_id&stage=hide_dialable\">HIDE</a></font><BR><BR>";
	}
else
	{
	echo "<a href=\"$PHP_SELF?ADD=73&campaign_id=$campaign_id\" target=\"_blank\">Popup Dialable Leads Count</a>";
	echo " - <font size=1><a href=\"$PHP_SELF?ADD=31&campaign_id=$campaign_id&stage=show_dialable\">SHOW</a></font><BR><BR>";
	}





	$stmt="SELECT count(*) FROM vicidial_hopper where campaign_id='$campaign_id' and status IN('READY')";
	if ($DB) {echo "$stmt\n";}
	$rslt=mysql_query($stmt, $link);
	$rowx=mysql_fetch_row($rslt);
	$hopper_leads = "$rowx[0]";

echo "This campaign has $hopper_leads leads in the dial hopper<br><br>\n";
echo "<a href=\"./AST_VICIDIAL_hopperlist.php?group=$campaign_id\">Click here to see what leads are in the hopper right now</a><br><br>\n";
echo "<a href=\"$PHP_SELF?ADD=81&campaign_id=$campaign_id\">Click here to see all CallBack Holds in this campaign</a><BR><BR>\n";
echo "<a href=\"./AST_VDADstats.php?group=$campaign_id\">Click here to see a VDAD report for this campaign</a><BR><BR>\n";
echo "</b></center>\n";




echo "<center>\n";
echo "<br><b>CUSTOM STATUSES WITHIN THIS CAMPAIGN: &nbsp; $NWB#vicidial_campaign_statuses$NWE</b><br>\n";
echo "<TABLE width=400 cellspacing=3>\n";
echo "<tr><td>STATUS</td><td>DESCRIPTION</td><td>SELECTABLE</td><td>DELETE</td></tr>\n";

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

	echo "<tr $bgcolor><td><font size=1>$rowx[0]</td><td><font size=1>$rowx[1]</td><td><font size=1>$rowx[2]</td><td><font size=1><a href=\"$PHP_SELF?ADD=42&campaign_id=$campaign_id&status=$rowx[0]&action=DELETE\">DELETE</a></td></tr>\n";

	}

echo "</table>\n";

echo "<br>ADD NEW CUSTOM CAMPAIGN STATUS<BR><form action=$PHP_SELF method=POST>\n";
echo "<input type=hidden name=ADD value=22>\n";
echo "<input type=hidden name=campaign_id value=\"$campaign_id\">\n";
echo "Status: <input type=text name=status size=10 maxlength=8> &nbsp; \n";
echo "Description: <input type=text name=status_name size=20 maxlength=30> &nbsp; \n";
echo "Selectable: <select size=1 name=selectable><option>Y</option><option>N</option></select> &nbsp; \n";
echo "<input type=submit name=submit value=ADD><BR>\n";

echo "</FORM><br>\n";



echo "<br><b>CUSTOM HOTKEYS WITHIN THIS CAMPAIGN: &nbsp; $NWB#vicidial_campaign_hotkeys$NWE</b><br>\n";
echo "<TABLE width=400 cellspacing=3>\n";
echo "<tr><td>HOTKEY</td><td>STATUS</td><td>DESCRIPTION</td><td>DELETE</td></tr>\n";

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

	echo "<tr $bgcolor><td><font size=1>$rowx[1]</td><td><font size=1>$rowx[0]</td><td><font size=1>$rowx[2]</td><td><font size=1><a href=\"$PHP_SELF?ADD=43&campaign_id=$campaign_id&status=$rowx[0]&hotkey=$rowx[1]&action=DELETE\">DELETE</a></td></tr>\n";

	}

echo "</table>\n";

echo "<br>ADD NEW CUSTOM CAMPAIGN HOTKEY<BR><form action=$PHP_SELF method=POST>\n";
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
echo "Status: <select size=1 name=HKstatus>\n";
echo "$HKstatuses_list\n";
echo "</select> &nbsp; \n";
echo "<input type=submit name=submit value=ADD><BR>\n";
echo "</form><BR>\n";



echo "<br><br><b>LEAD RECYCLING WITHIN THIS CAMPAIGN: &nbsp; $NWB#vicidial_lead_recycle$NWE</b><br>\n";
echo "<TABLE width=500 cellspacing=3>\n";
echo "<tr><td>STATUS</td><td>ATTEMPT DELAY</td><td>ATTEMPT MAXIMUM</td><td>ACTIVE</td><td> </td><td>DELETE</td></tr>\n";

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
	echo "<td><font size=1><a href=\"$PHP_SELF?ADD=65&campaign_id=$campaign_id&status=$rowx[2]\">DELETE</a></td></tr>\n";
	}

echo "</table>\n";

echo "<br>ADD NEW CAMPAIGN LEAD RECYCLE<BR><form action=$PHP_SELF method=POST>\n";
echo "<input type=hidden name=ADD value=25>\n";
echo "<input type=hidden name=active value=\"N\">\n";
echo "<input type=hidden name=campaign_id value=\"$campaign_id\">\n";
echo "Status: <select size=1 name=status>\n";
echo "$LRstatuses_list\n";
echo "</select> &nbsp; \n";
echo "Attempt Delay: <input size=7 maxlength=5 name=attempt_delay>\n";
echo "Attempt Maximum: <input size=5 maxlength=3 name=attempt_maximum>\n";
echo "<input type=submit name=submit value=ADD><BR>\n";

echo "</center></FORM><br>\n";

echo "<a href=\"$PHP_SELF?ADD=52&campaign_id=$campaign_id\">LOG ALL AGENTS OUT OF THIS CAMPAIGN</a><BR><BR>\n";
echo "<a href=\"$PHP_SELF?ADD=53&campaign_id=$campaign_id\">EMERGENCY VDAC CLEAR FOR THIS CAMPAIGN</a><BR><BR>\n";

if ($LOGdelete_campaigns > 0)
	{
	echo "<br><br><a href=\"$PHP_SELF?ADD=51&campaign_id=$campaign_id\">DELETE THIS CAMPAIGN</a>\n";
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

echo "<br>MODIFY A CAMPAIGN'S RECORD: $row[0] - Basic View | ";
echo "<a href=\"$PHP_SELF?ADD=31&campaign_id=$campaign_id\">Detail View</a> | ";
echo "<a href=\"./AST_timeonVDADall.php?RR=4&DB=0&group=$row[0]\">Realtime Screen</a>\n";
echo "<form action=$PHP_SELF method=POST>\n";
echo "<input type=hidden name=ADD value=44>\n";
echo "<input type=hidden name=campaign_id value=\"$campaign_id\">\n";
echo "<center><TABLE width=600 cellspacing=3>\n";
echo "<tr bgcolor=#B6D3FC><td align=right>Campaign ID: </td><td align=left><b>$row[0]</b>$NWB#vicidial_campaigns-campaign_id$NWE</td></tr>\n";
echo "<tr bgcolor=#B6D3FC><td align=right>Campaign Name: </td><td align=left><input type=text name=campaign_name size=40 maxlength=40 value=\"$row[1]\">$NWB#vicidial_campaigns-campaign_name$NWE</td></tr>\n";
echo "<tr bgcolor=#B6D3FC><td align=right>Active: </td><td align=left><select size=1 name=active><option>Y</option><option>N</option><option SELECTED>$row[2]</option></select>$NWB#vicidial_campaigns-active$NWE</td></tr>\n";
echo "<tr bgcolor=#B6D3FC><td align=right>Park Extension: </td><td align=left>$row[9] - $row[10]$NWB#vicidial_campaigns-park_ext$NWE</td></tr>\n";
echo "<tr bgcolor=#B6D3FC><td align=right>Web Form: </td><td align=left>$row[11]$NWB#vicidial_campaigns-web_form_address$NWE</td></tr>\n";
echo "<tr bgcolor=#B6D3FC><td align=right>Allow Closers: </td><td align=left>$row[12] $NWB#vicidial_campaigns-allow_closers$NWE</td></tr>\n";
echo "<tr bgcolor=#B6D3FC><td align=right>Dial status 1: </td><td align=left><select size=1 name=dial_status_a>\n";
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
echo "<tr bgcolor=#B6D3FC><td align=right>Dial status 2: </td><td align=left><select size=1 name=dial_status_b>\n";
echo "<option value=\"\"> - NONE - </option>\n";
echo "$statuses_list";
echo "<option value=\"$dial_status_b\" SELECTED>$dial_status_b - $statname_list[$dial_status_b]</option>\n";
echo "</select>$NWB#vicidial_campaigns-dial_status$NWE</td></tr>\n";
echo "<tr bgcolor=#B6D3FC><td align=right>Dial status 3: </td><td align=left><select size=1 name=dial_status_c>\n";
echo "<option value=\"\"> - NONE - </option>\n";
echo "$statuses_list";
echo "<option value=\"$dial_status_c\" SELECTED>$dial_status_c - $statname_list[$dial_status_c]</option>\n";
echo "</select>$NWB#vicidial_campaigns-dial_status$NWE</td></tr>\n";
echo "<tr bgcolor=#B6D3FC><td align=right>Dial status 4: </td><td align=left><select size=1 name=dial_status_d>\n";
echo "<option value=\"\"> - NONE - </option>\n";
echo "$statuses_list";
echo "<option value=\"$dial_status_d\" SELECTED>$dial_status_d - $statname_list[$dial_status_d]</option>\n";
echo "</select>$NWB#vicidial_campaigns-dial_status$NWE</td></tr>\n";
echo "<tr bgcolor=#B6D3FC><td align=right>Dial status 5: </td><td align=left><select size=1 name=dial_status_e>\n";
echo "<option value=\"\"> - NONE - </option>\n";
echo "$statuses_list";
echo "<option value=\"$dial_status_e\" SELECTED>$dial_status_e - $statname_list[$dial_status_e]</option>\n";
echo "</select>$NWB#vicidial_campaigns-dial_status$NWE</td></tr>\n";

echo "<tr bgcolor=#B6D3FC><td align=right>List Order: </td><td align=left><select size=1 name=lead_order><option>DOWN</option><option>UP</option><option>UP PHONE</option><option>DOWN PHONE</option><option>UP LAST NAME</option><option>DOWN LAST NAME</option><option>UP COUNT</option><option>DOWN COUNT</option><option>DOWN COUNT 2nd NEW</option><option>DOWN COUNT 3rd NEW</option><option>DOWN COUNT 4th NEW</option><option SELECTED>$lead_order</option></select>$NWB#vicidial_campaigns-lead_order$NWE</td></tr>\n";

echo "<tr bgcolor=#B6D3FC><td align=right><a href=\"$PHP_SELF?ADD=31111111&lead_filter_id=$lead_filter_id\">Lead Filter</a>: </td><td align=left><select size=1 name=lead_filter_id>\n";
echo "$filters_list";
echo "<option selected value=\"$lead_filter_id\">$lead_filter_id - $filtername_list[$lead_filter_id]</option>\n";
echo "</select>$NWB#vicidial_campaigns-lead_filter_id$NWE</td></tr>\n";

echo "<tr bgcolor=#B6D3FC><td align=right>Hopper Level: </td><td align=left><select size=1 name=hopper_level><option>1</option><option>5</option><option>10</option><option>50</option><option>100</option><option>200</option><option>500</option><option>750</option><option>1000</option><option>2000</option><option SELECTED>$hopper_level</option></select>$NWB#vicidial_campaigns-hopper_level$NWE</td></tr>\n";

echo "<tr bgcolor=#B6D3FC><td align=right>Force Reset of Hopper: </td><td align=left><select size=1 name=reset_hopper><option>Y</option><option SELECTED>N</option></select>$NWB#vicidial_campaigns-force_reset_hopper$NWE</td></tr>\n";

echo "<tr bgcolor=#BDFFBD><td align=right>Dial Method: </td><td align=left><select size=1 name=dial_method><option >MANUAL</option><option>RATIO</option><option>ADAPT_HARD_LIMIT</option><option>ADAPT_TAPERED</option><option>ADAPT_AVERAGE</option><option SELECTED>$dial_method</option></select>$NWB#vicidial_campaigns-dial_method$NWE</td></tr>\n";

echo "<tr bgcolor=#BDFFBD><td align=right>Auto Dial Level: </td><td align=left><select size=1 name=auto_dial_level><option >0</option><option>1</option><option>1.1</option><option>1.2</option><option>1.3</option><option>1.4</option><option>1.5</option><option>1.6</option><option>1.7</option><option>1.8</option><option>1.9</option><option>2.0</option><option>2.2</option><option>2.5</option><option>2.7</option><option>3.0</option><option>3.5</option><option>4.0</option><option SELECTED>$auto_dial_level</option></select>(0 = off)$NWB#vicidial_campaigns-auto_dial_level$NWE</td></tr>\n";

echo "<tr bgcolor=#BDFFBD><td align=right>Adapt Intensity Modifier: </td><td align=left><select size=1 name=adaptive_intensity>\n";
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

echo "<tr bgcolor=#B6D3FC><td align=right>Get Call Launch: </td><td align=left>$get_call_launch</td></tr>\n";

echo "<tr bgcolor=#B6D3FC><td align=center colspan=2><input type=submit name=SUBMIT value=SUBMIT></td></tr>\n";
echo "</TABLE></center></FORM>\n";

echo "<center>\n";
echo "<br><b>LISTS WITHIN THIS CAMPAIGN: &nbsp; $NWB#vicidial_campaign_lists$NWE</b><br>\n";
echo "<TABLE width=400 cellspacing=3>\n";
echo "<tr><td>LIST ID</td><td>LIST NAME</td><td>ACTIVE</td></tr>\n";

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
echo "This campaign has $active_lists active lists and $inactive_lists inactive lists<br><br>\n";


if ($display_dialable_count == 'Y')
	{
	### call function to calculate and print dialable leads
	dialable_leads($DB,$link,$local_call_time,$dial_status_a,$dial_status_b,$dial_status_c,$dial_status_d,$dial_status_e,$camp_lists,$fSQL);
	echo " - <font size=1><a href=\"$PHP_SELF?ADD=34&campaign_id=$campaign_id&stage=hide_dialable\">HIDE</a></font><BR><BR>";
	}
else
	{
	echo "<a href=\"$PHP_SELF?ADD=73&campaign_id=$campaign_id\" target=\"_blank\">Popup Dialable Leads Count</a>";
	echo " - <font size=1><a href=\"$PHP_SELF?ADD=31&campaign_id=$campaign_id&stage=show_dialable\">SHOW</a></font><BR><BR>";
	}



	$stmt="SELECT count(*) FROM vicidial_hopper where campaign_id='$campaign_id' and status IN('READY')";
	if ($DB) {echo "$stmt\n";}
	$rslt=mysql_query($stmt, $link);
	$rowx=mysql_fetch_row($rslt);
	$hopper_leads = "$rowx[0]";

echo "This campaign has $hopper_leads leads in the dial hopper<br><br>\n";
echo "<a href=\"./AST_VICIDIAL_hopperlist.php?group=$campaign_id\">Click here to see what leads are in the hopper right now</a><br><br>\n";
echo "<a href=\"$PHP_SELF?ADD=81&campaign_id=$campaign_id\">Click here to see all CallBack Holds in this campaign</a><BR><BR>\n";
echo "<a href=\"./AST_VDADstats.php?group=$campaign_id\">Click here to see a VDAD report for this campaign</a><BR><BR>\n";
echo "</b></center>\n";

echo "<br>\n";

echo "<a href=\"$PHP_SELF?ADD=52&campaign_id=$campaign_id\">LOG ALL AGENTS OUT OF THIS CAMPAIGN</a><BR><BR>\n";


if ($LOGdelete_campaigns > 0)
	{
	echo "<br><br><a href=\"$PHP_SELF?ADD=51&campaign_id=$campaign_id\">DELETE THIS CAMPAIGN</a>\n";
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


echo "<br>MODIFY A LISTS RECORD: $row[0]<form action=$PHP_SELF method=POST>\n";
echo "<input type=hidden name=ADD value=411>\n";
echo "<input type=hidden name=list_id value=\"$row[0]\">\n";
echo "<input type=hidden name=old_campaign_id value=\"$row[2]\">\n";
echo "<center><TABLE width=600 cellspacing=3>\n";
echo "<tr bgcolor=#B6D3FC><td align=right>List ID: </td><td align=left><b>$row[0]</b>$NWB#vicidial_lists-list_id$NWE</td></tr>\n";
echo "<tr bgcolor=#B6D3FC><td align=right>List Name: </td><td align=left><input type=text name=list_name size=20 maxlength=20 value=\"$row[1]\">$NWB#vicidial_lists-list_name$NWE</td></tr>\n";
echo "<tr bgcolor=#B6D3FC><td align=right><a href=\"$PHP_SELF?ADD=34&campaign_id=$campaign_id\">Campaign</a>: </td><td align=left><select size=1 name=campaign_id>\n";

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
echo "<tr bgcolor=#B6D3FC><td align=right>Active: </td><td align=left><select size=1 name=active><option>Y</option><option>N</option><option SELECTED>$active</option></select>$NWB#vicidial_lists-active$NWE</td></tr>\n";
echo "<tr bgcolor=#B6D3FC><td align=right>Reset Lead-Called-Status for this list: </td><td align=left><select size=1 name=reset_list><option>Y</option><option SELECTED>N</option></select>$NWB#vicidial_lists-reset_list$NWE</td></tr>\n";
echo "<tr bgcolor=#B6D3FC><td align=center colspan=2><input type=submit name=SUBMIT value=SUBMIT></td></tr>\n";
echo "</TABLE></center>\n";

echo "<center>\n";
echo "<br><b>STATUSES WITHIN THIS LIST:</b><br>\n";
echo "<TABLE width=500 cellspacing=3>\n";
echo "<tr><td>STATUS</td><td>STATUS NAME</td><td>CALLED</td><td>NOT CALLED</td></tr>\n";

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

echo "<tr><td colspan=2><font size=1>SUBTOTALS</td><td><font size=1>$lead_list[Y_count]</td><td><font size=1>$lead_list[N_count]</td></tr>\n";
echo "<tr bgcolor=\"#9BB9FB\"><td><font size=1>TOTAL</td><td colspan=3 align=center><font size=1>$lead_list[count]</td></tr>\n";

echo "</table></center><br>\n";
unset($lead_list);





echo "<center>\n";
echo "<br><b>TIME ZONES WITHIN THIS LIST:</b><br>\n";
echo "<TABLE width=500 cellspacing=3>\n";
echo "<tr><td>GMT OFFSET NOW (local time)</td><td>CALLED</td><td>NOT CALLED</td></tr>\n";

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

echo "<tr><td><font size=1>SUBTOTALS</td><td><font size=1>$lead_list[Y_count]</td><td><font size=1>$lead_list[N_count]</td></tr>\n";
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
echo "<br><b>CALLED COUNTS WITHIN THIS LIST:</b><br>\n";
echo "<TABLE width=500 cellspacing=1>\n";
echo "<tr><td align=left><font size=1>STATUS</td><td align=center><font size=1>STATUS NAME</td>";
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

if ($LOGdelete_lists > 0)
	{
	echo "<br><br><a href=\"$PHP_SELF?ADD=511&list_id=$list_id\">DELETE THIS LIST</a>\n";
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

echo "<br>MODIFY A GROUPS RECORD: $row[0]<form action=$PHP_SELF method=POST>\n";
echo "<input type=hidden name=ADD value=4111>\n";
echo "<input type=hidden name=group_id value=\"$row[0]\">\n";
echo "<center><TABLE width=600 cellspacing=3>\n";
echo "<tr bgcolor=#B6D3FC><td align=right>Group ID: </td><td align=left><b>$row[0]</b>$NWB#vicidial_inbound_groups-group_id$NWE</td></tr>\n";
echo "<tr bgcolor=#B6D3FC><td align=right>Group Name: </td><td align=left><input type=text name=group_name size=30 maxlength=30 value=\"$row[1]\">$NWB#vicidial_inbound_groups-group_name$NWE</td></tr>\n";
echo "<tr bgcolor=#B6D3FC><td align=right>Group Color: </td><td align=left bgcolor=\"$row[2]\"><input type=text name=group_color size=7 maxlength=7 value=\"$row[2]\">$NWB#vicidial_inbound_groups-group_color$NWE</td></tr>\n";
echo "<tr bgcolor=#B6D3FC><td align=right>Active: </td><td align=left><select size=1 name=active><option>Y</option><option>N</option><option SELECTED>$active</option></select>$NWB#vicidial_inbound_groups-active$NWE</td></tr>\n";
echo "<tr bgcolor=#B6D3FC><td align=right>Web Form: </td><td align=left><input type=text name=web_form_address size=50 maxlength=255 value=\"$web_form_address\">$NWB#vicidial_inbound_groups-web_form_address$NWE</td></tr>\n";
echo "<tr bgcolor=#B6D3FC><td align=right>Next Agent Call: </td><td align=left><select size=1 name=next_agent_call><option >random</option><option>oldest_call_start</option><option>oldest_call_finish</option><option>overall_user_level</option><option SELECTED>$next_agent_call</option></select>$NWB#vicidial_inbound_groups-next_agent_call$NWE</td></tr>\n";
echo "<tr bgcolor=#B6D3FC><td align=right>Fronter Display: </td><td align=left><select size=1 name=fronter_display><option>Y</option><option>N</option><option SELECTED>$fronter_display</option></select>$NWB#vicidial_inbound_groups-fronter_display$NWE</td></tr>\n";

echo "<tr bgcolor=#B6D3FC><td align=right><a href=\"$PHP_SELF?ADD=3111111&script_id=$script_id\">Script</a>: </td><td align=left><select size=1 name=script_id>\n";
echo "$scripts_list";
echo "<option selected value=\"$script_id\">$script_id - $scriptname_list[$script_id]</option>\n";
echo "</select>$NWB#vicidial_inbound_groups-ingroup_script$NWE</td></tr>\n";
echo "<tr bgcolor=#B6D3FC><td align=right>Get Call Launch: </td><td align=left><select size=1 name=get_call_launch><option selected>NONE</option><option>SCRIPT</option><option>WEBFORM</option><option selected>$get_call_launch</option></select>$NWB#vicidial_inbound_groups-get_call_launch$NWE</td></tr>\n";

echo "<tr bgcolor=#B6D3FC><td align=right>Transfer-Conf DTMF 1: </td><td align=left><input type=text name=xferconf_a_dtmf size=20 maxlength=50 value=\"$xferconf_a_dtmf\">$NWB#vicidial_inbound_groups-xferconf_a_dtmf$NWE</td></tr>\n";

echo "<tr bgcolor=#B6D3FC><td align=right>Transfer-Conf Number 1: </td><td align=left><input type=text name=xferconf_a_number size=20 maxlength=50 value=\"$xferconf_a_number\">$NWB#vicidial_inbound_groups-xferconf_a_dtmf$NWE</td></tr>\n";

echo "<tr bgcolor=#B6D3FC><td align=right>Transfer-Conf DTMF 2: </td><td align=left><input type=text name=xferconf_b_dtmf size=20 maxlength=50 value=\"$xferconf_b_dtmf\">$NWB#vicidial_inbound_groups-xferconf_a_dtmf$NWE</td></tr>\n";

echo "<tr bgcolor=#B6D3FC><td align=right>Transfer-Conf Number 2: </td><td align=left><input type=text name=xferconf_b_number size=20 maxlength=50 value=\"$xferconf_b_number\">$NWB#vicidial_inbound_groups-xferconf_a_dtmf$NWE</td></tr>\n";

echo "<tr bgcolor=#B6D3FC><td align=right>Drop Call Seconds: </td><td align=left><input type=text name=drop_call_seconds size=5 maxlength=4 value=\"$drop_call_seconds\">$NWB#vicidial_inbound_groups-drop_call_seconds$NWE</td></tr>\n";

echo "<tr bgcolor=#B6D3FC><td align=right>Voicemail: </td><td align=left><input type=text name=voicemail_ext size=10 maxlength=10 value=\"$voicemail_ext\">$NWB#vicidial_inbound_groups-voicemail_ext$NWE</td></tr>\n";

echo "<tr bgcolor=#B6D3FC><td align=right>Use Drop Message: </td><td align=left><select size=1 name=drop_message><option>Y</option><option>N</option><option SELECTED>$drop_message</option></select>$NWB#vicidial_inbound_groups-drop_message$NWE</td></tr>\n";

echo "<tr bgcolor=#B6D3FC><td align=right>Drop Exten: </td><td align=left><input type=text name=drop_exten size=10 maxlength=20 value=\"$drop_exten\">$NWB#vicidial_inbound_groups-drop_exten$NWE</td></tr>\n";


echo "<tr bgcolor=#B6D3FC><td align=center colspan=2><input type=submit name=SUBMIT value=SUBMIT></td></tr>\n";
echo "</TABLE></center>\n";

echo "</table></center><br>\n";

echo "<a href=\"./AST_CLOSERstats.php?group=$group_id\">Click here to see a report for this campaign</a><BR><BR>\n";

echo "<center><b>\n";

if ($LOGdelete_ingroups > 0)
	{
	echo "<br><br><a href=\"$PHP_SELF?ADD=53&campaign_id=$group_id&stage=IN\">EMERGENCY VDAC CLEAR FOR THIS IN-GROUP</a><BR><BR>\n";
	echo "<br><br><a href=\"$PHP_SELF?ADD=5111&group_id=$group_id\">DELETE THIS IN-GROUP</a>\n";
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

echo "<br>MODIFY A REMOTE AGENTS ENTRY: $row[0]<form action=$PHP_SELF method=POST>\n";
echo "<input type=hidden name=ADD value=41111>\n";
echo "<input type=hidden name=remote_agent_id value=\"$row[0]\">\n";
echo "<center><TABLE width=600 cellspacing=3>\n";
echo "<tr bgcolor=#B6D3FC><td align=right>User ID Start: </td><td align=left><input type=text name=user_start size=6 maxlength=6 value=\"$user_start\"> (numbers only, incremented)$NWB#vicidial_remote_agents-user_start$NWE</td></tr>\n";
echo "<tr bgcolor=#B6D3FC><td align=right>Number of Lines: </td><td align=left><input type=text name=number_of_lines size=3 maxlength=3 value=\"$number_of_lines\"> (numbers only)$NWB#vicidial_remote_agents-number_of_lines$NWE</td></tr>\n";
echo "<tr bgcolor=#B6D3FC><td align=right>Server IP: </td><td align=left><select size=1 name=server_ip>\n";
echo "$servers_list";
echo "<option SELECTED>$row[3]</option>\n";
echo "</select>$NWB#vicidial_remote_agents-server_ip$NWE</td></tr>\n";
echo "<tr bgcolor=#B6D3FC><td align=right>External Extension: </td><td align=left><input type=text name=conf_exten size=20 maxlength=20 value=\"$conf_exten\"> (dialplan number dialed to reach agents)$NWB#vicidial_remote_agents-conf_exten$NWE</td></tr>\n";
echo "<tr bgcolor=#B6D3FC><td align=right>Status: </td><td align=left><select size=1 name=status><option SELECTED>ACTIVE</option><option>INACTIVE</option><option SELECTED>$status</option></select>$NWB#vicidial_remote_agents-status$NWE</td></tr>\n";
echo "<tr bgcolor=#B6D3FC><td align=right>Campaign: </td><td align=left><select size=1 name=campaign_id>\n";
echo "$campaigns_list";
echo "<option SELECTED>$campaign_id</option>\n";
echo "</select>$NWB#vicidial_remote_agents-campaign_id$NWE</td></tr>\n";
echo "<tr bgcolor=#B6D3FC><td align=right>Inbound Groups: </td><td align=left>\n";
echo "$groups_list";
echo "$NWB#vicidial_remote_agents-closer_campaigns$NWE</td></tr>\n";
echo "<tr bgcolor=#B6D3FC><td align=center colspan=2><input type=submit name=SUBMIT value=SUBMIT></td></tr>\n";
echo "</TABLE></center>\n";
echo "NOTE: It can take up to 30 seconds for changes submitted on this screen to go live\n";


if ($LOGdelete_remote_agents > 0)
	{
	echo "<br><br><a href=\"$PHP_SELF?ADD=51111&remote_agent_id=$remote_agent_id\">DELETE THIS REMOTE AGENT</a>\n";
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

echo "<br>MODIFY A USERS GROUP ENTRY<form action=$PHP_SELF method=POST>\n";
echo "<input type=hidden name=ADD value=411111>\n";
echo "<input type=hidden name=OLDuser_group value=\"$user_group\">\n";
echo "<center><TABLE width=600 cellspacing=3>\n";
echo "<tr bgcolor=#B6D3FC><td align=right>Group: </td><td align=left><input type=text name=user_group size=15 maxlength=20 value=\"$user_group\"> (no spaces or punctuation)$NWB#vicidial_user_groups-user_group$NWE</td></tr>\n";
echo "<tr bgcolor=#B6D3FC><td align=right>Description: </td><td align=left><input type=text name=group_name size=40 maxlength=40 value=\"$group_name\"> (description of group)$NWB#vicidial_user_groups-group_name$NWE</td></tr>\n";
echo "<tr bgcolor=#B6D3FC><td align=right>Allowed Campaigns: </td><td align=left>\n";
echo "$campaigns_list";
echo "$NWB#vicidial_user_groups-allowed_campaigns$NWE</td></tr>\n";
echo "<tr bgcolor=#B6D3FC><td align=center colspan=2><input type=submit name=SUBMIT value=SUBMIT></td></tr>\n";
echo "</TABLE></center>\n";

if ($LOGdelete_user_groups > 0)
	{
	echo "<br><br><a href=\"$PHP_SELF?ADD=511111&user_group=$user_group\">DELETE THIS USER GROUP</a>\n";
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

echo "<br>MODIFY A SCRIPT<form action=$PHP_SELF method=POST>\n";
echo "<input type=hidden name=ADD value=4111111>\n";
echo "<input type=hidden name=script_id value=\"$script_id\">\n";
echo "<tr bgcolor=#B6D3FC><td align=right>Script ID: </td><td align=left><B>$script_id</B>$NWB#vicidial_scripts-script_name$NWE</td></tr>\n";
echo "<tr bgcolor=#B6D3FC><td align=right>Script Name: </td><td align=left><input type=text name=script_name size=40 maxlength=50 value=\"$script_name\"> (title of the script)$NWB#vicidial_scripts-script_name$NWE</td></tr>\n";
echo "<tr bgcolor=#B6D3FC><td align=right>Script Comments: </td><td align=left><input type=text name=script_comments size=50 maxlength=255 value=\"$script_comments\"> $NWB#vicidial_scripts-script_comments$NWE</td></tr>\n";
echo "<tr bgcolor=#B6D3FC><td align=right>Active: </td><td align=left><select size=1 name=active><option SELECTED>Y</option><option>N</option><option selected>$active</option></select>$NWB#vicidial_scripts-active$NWE</td></tr>\n";
echo "<tr bgcolor=#B6D3FC><td align=right>Script Text: <BR><BR><B><a href=\"javascript:openNewWindow('$PHP_SELF?ADD=7111111&script_id=$script_id')\">Preview Script</a></B> </td><td align=left><TEXTAREA NAME=script_text ROWS=20 COLS=50>$script_text</TEXTAREA> $NWB#vicidial_scripts-script_text$NWE</td></tr>\n";
echo "<tr bgcolor=#B6D3FC><td align=center colspan=2><input type=submit name=SUBMIT value=SUBMIT></td></tr>\n";
echo "</TABLE></center>\n";

if ($LOGdelete_scripts > 0)
	{
	echo "<br><br><a href=\"$PHP_SELF?ADD=5111111&script_id=$script_id\">DELETE THIS SCRIPT</a>\n";
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

echo "<br>MODIFY A FILTER<form action=$PHP_SELF method=POST>\n";
echo "<input type=hidden name=ADD value=41111111>\n";
echo "<input type=hidden name=lead_filter_id value=\"$lead_filter_id\">\n";
echo "<tr bgcolor=#B6D3FC><td align=right>Filter ID: </td><td align=left><B>$lead_filter_id</B>$NWB#vicidial_lead_filters-lead_filter_id$NWE</td></tr>\n";
echo "<tr bgcolor=#B6D3FC><td align=right>Filter Name: </td><td align=left><input type=text name=lead_filter_name size=40 maxlength=50 value=\"$lead_filter_name\"> (short description of the filter)$NWB#vicidial_lead_filters-lead_filter_name$NWE</td></tr>\n";
echo "<tr bgcolor=#B6D3FC><td align=right>Filter Comments: </td><td align=left><input type=text name=lead_filter_comments size=50 maxlength=255 value=\"$lead_filter_comments\"> $NWB#vicidial_lead_filters-lead_filter_comments$NWE</td></tr>\n";
echo "<tr bgcolor=#B6D3FC><td align=right>Filter SQL:</td><td align=left><TEXTAREA NAME=lead_filter_sql ROWS=20 COLS=50>$lead_filter_sql</TEXTAREA> $NWB#vicidial_lead_filters-lead_filter_sql$NWE</td></tr>\n";
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
echo "<br>TEST ON CAMPAIGN: <form action=$PHP_SELF method=POST target=\"_blank\">\n";
echo "<input type=hidden name=lead_filter_id value=\"$lead_filter_id\">\n";
echo "<input type=hidden name=ADD value=\"73\">\n";
echo "<select size=1 name=campaign_id>\n";
echo "$campaigns_list";
echo "</select>\n";
echo "<input type=submit name=SUBMIT value=SUBMIT>\n";


if ($LOGdelete_filters > 0)
	{
	echo "<br><br><a href=\"$PHP_SELF?ADD=51111111&lead_filter_id=$lead_filter_id\">DELETE THIS FILTER</a>\n";
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
	echo "State Rule Added: $state_rule<BR>\n";
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
	echo "State Rule Removed: $state_rule<BR>\n";
	}

$ADD=311111111;
}
else
{
echo "You are not authorized to view this page. Please go back.";
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

echo "<br>MODIFY A CALL TIME<form action=$PHP_SELF method=POST>\n";
echo "<input type=hidden name=ADD value=411111111>\n";
echo "<input type=hidden name=call_time_id value=\"$call_time_id\">\n";
echo "<tr bgcolor=#B6D3FC><td align=right>Call Time ID: </td><td align=left colspan=3><B>$call_time_id</B>$NWB#vicidial_call_times-call_time_id$NWE</td></tr>\n";
echo "<tr bgcolor=#B6D3FC><td align=right>Call Time Name: </td><td align=left colspan=3><input type=text name=call_time_name size=40 maxlength=50 value=\"$call_time_name\"> (short description of the call time)$NWB#vicidial_call_times-call_time_name$NWE</td></tr>\n";
echo "<tr bgcolor=#B6D3FC><td align=right>Call Time Comments: </td><td align=left colspan=3><input type=text name=call_time_comments size=50 maxlength=255 value=\"$call_time_comments\"> $NWB#vicidial_call_times-call_time_comments$NWE</td></tr>\n";
echo "<tr bgcolor=#B6D3FC><td align=right>Default Start:</td><td align=left><input type=text name=ct_default_start size=5 maxlength=4 value=\"$ct_default_start\"> </td><td align=right>Default Stop:</td><td align=left><input type=text name=ct_default_stop size=5 maxlength=4 value=\"$ct_default_stop\"> $NWB#vicidial_call_times-ct_default_start$NWE</td></tr>\n";
echo "<tr bgcolor=#B6D3FC><td align=right>Sunday Start:</td><td align=left><input type=text name=ct_sunday_start size=5 maxlength=4 value=\"$ct_sunday_start\"> </td><td align=right>Sunday Stop:</td><td align=left><input type=text name=ct_sunday_stop size=5 maxlength=4 value=\"$ct_sunday_stop\"> $NWB#vicidial_call_times-ct_sunday_start$NWE</td></tr>\n";
echo "<tr bgcolor=#B6D3FC><td align=right>Monday Start:</td><td align=left><input type=text name=ct_monday_start size=5 maxlength=4 value=\"$ct_monday_start\"> </td><td align=right>Monday Stop:</td><td align=left><input type=text name=ct_monday_stop size=5 maxlength=4 value=\"$ct_monday_stop\"> $NWB#vicidial_call_times-ct_sunday_start$NWE</td></tr>\n";
echo "<tr bgcolor=#B6D3FC><td align=right>Tuesday Start:</td><td align=left><input type=text name=ct_tuesday_start size=5 maxlength=4 value=\"$ct_tuesday_start\"> </td><td align=right>Tuesday Stop:</td><td align=left><input type=text name=ct_tuesday_stop size=5 maxlength=4 value=\"$ct_tuesday_stop\"> $NWB#vicidial_call_times-ct_sunday_start$NWE</td></tr>\n";
echo "<tr bgcolor=#B6D3FC><td align=right>Wednesday Start:</td><td align=left><input type=text name=ct_wednesday_start size=5 maxlength=4 value=\"$ct_wednesday_start\"> </td><td align=right>Wednesday Stop:</td><td align=left><input type=text name=ct_wednesday_stop size=5 maxlength=4 value=\"$ct_wednesday_stop\"> $NWB#vicidial_call_times-ct_sunday_start$NWE</td></tr>\n";
echo "<tr bgcolor=#B6D3FC><td align=right>Thursday Start:</td><td align=left><input type=text name=ct_thursday_start size=5 maxlength=4 value=\"$ct_thursday_start\"> </td><td align=right>Thursday Stop:</td><td align=left><input type=text name=ct_thursday_stop size=5 maxlength=4 value=\"$ct_thursday_stop\"> $NWB#vicidial_call_times-ct_sunday_start$NWE</td></tr>\n";
echo "<tr bgcolor=#B6D3FC><td align=right>Friday Start:</td><td align=left><input type=text name=ct_friday_start size=5 maxlength=4 value=\"$ct_friday_start\"> </td><td align=right>Friday Stop:</td><td align=left><input type=text name=ct_friday_stop size=5 maxlength=4 value=\"$ct_friday_stop\"> $NWB#vicidial_call_times-ct_sunday_start$NWE</td></tr>\n";
echo "<tr bgcolor=#B6D3FC><td align=right>Saturday Start:</td><td align=left><input type=text name=ct_saturday_start size=5 maxlength=4 value=\"$ct_saturday_start\"> </td><td align=right>Saturday Stop:</td><td align=left><input type=text name=ct_saturday_stop size=5 maxlength=4 value=\"$ct_saturday_stop\"> $NWB#vicidial_call_times-ct_sunday_start$NWE</td></tr>\n";
echo "<tr bgcolor=#B6D3FC><td align=center colspan=4><input type=submit name=SUBMIT value=SUBMIT></FORM></td></tr>\n";

$ct_srs=1;
$b=0;
$srs_SQL ='';
if (strlen($ct_state_call_times)>2)
	{
	$state_rules = explode('|',$ct_state_call_times);
	$ct_srs = ((count($state_rules)) - 1);
	}
echo "<tr bgcolor=#B6D3FC><td align=center rowspan=$ct_srs>Active State Call Time Definitions for this Record: </td>\n";
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
echo "<B>CAMPAIGNS USING THIS CALL TIME:</B><BR>\n";
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
	echo "<br><br><a href=\"$PHP_SELF?ADD=511111111&call_time_id=$call_time_id\">DELETE THIS CALL TIME DEFINITION</a>\n";
	}
}
else
{
echo "You are not authorized to view this page. Please go back.";
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

echo "<br>MODIFY A STATE CALL TIME<form action=$PHP_SELF method=POST>\n";
echo "<input type=hidden name=ADD value=4111111111>\n";
echo "<input type=hidden name=call_time_id value=\"$call_time_id\">\n";
echo "<tr bgcolor=#B6D3FC><td align=right>Call Time ID: </td><td align=left colspan=3><B>$call_time_id</B>$NWB#vicidial_call_times-call_time_id$NWE</td></tr>\n";
echo "<tr bgcolor=#B6D3FC><td align=right>State Call Time State: </td><td align=left colspan=3><input type=text name=state_call_time_state size=4 maxlength=2 value=\"$state_call_time_state\"> $NWB#vicidial_call_times-state_call_time_state$NWE</td></tr>\n";
echo "<tr bgcolor=#B6D3FC><td align=right>State Call Time Name: </td><td align=left colspan=3><input type=text name=call_time_name size=40 maxlength=50 value=\"$call_time_name\"> (short description of the call time)$NWB#vicidial_call_times-call_time_name$NWE</td></tr>\n";
echo "<tr bgcolor=#B6D3FC><td align=right>State Call Time Comments: </td><td align=left colspan=3><input type=text name=call_time_comments size=50 maxlength=255 value=\"$call_time_comments\"> $NWB#vicidial_call_times-call_time_comments$NWE</td></tr>\n";
echo "<tr bgcolor=#B6D3FC><td align=right>Default Start:</td><td align=left><input type=text name=ct_default_start size=5 maxlength=4 value=\"$ct_default_start\"> </td><td align=right>Default Stop:</td><td align=left><input type=text name=ct_default_stop size=5 maxlength=4 value=\"$ct_default_stop\"> $NWB#vicidial_call_times-ct_default_start$NWE</td></tr>\n";
echo "<tr bgcolor=#B6D3FC><td align=right>Sunday Start:</td><td align=left><input type=text name=ct_sunday_start size=5 maxlength=4 value=\"$ct_sunday_start\"> </td><td align=right>Sunday Stop:</td><td align=left><input type=text name=ct_sunday_stop size=5 maxlength=4 value=\"$ct_sunday_stop\"> $NWB#vicidial_call_times-ct_sunday_start$NWE</td></tr>\n";
echo "<tr bgcolor=#B6D3FC><td align=right>Monday Start:</td><td align=left><input type=text name=ct_monday_start size=5 maxlength=4 value=\"$ct_monday_start\"> </td><td align=right>Monday Stop:</td><td align=left><input type=text name=ct_monday_stop size=5 maxlength=4 value=\"$ct_monday_stop\"> $NWB#vicidial_call_times-ct_sunday_start$NWE</td></tr>\n";
echo "<tr bgcolor=#B6D3FC><td align=right>Tuesday Start:</td><td align=left><input type=text name=ct_tuesday_start size=5 maxlength=4 value=\"$ct_tuesday_start\"> </td><td align=right>Tuesday Stop:</td><td align=left><input type=text name=ct_tuesday_stop size=5 maxlength=4 value=\"$ct_tuesday_stop\"> $NWB#vicidial_call_times-ct_sunday_start$NWE</td></tr>\n";
echo "<tr bgcolor=#B6D3FC><td align=right>Wednesday Start:</td><td align=left><input type=text name=ct_wednesday_start size=5 maxlength=4 value=\"$ct_wednesday_start\"> </td><td align=right>Wednesday Stop:</td><td align=left><input type=text name=ct_wednesday_stop size=5 maxlength=4 value=\"$ct_wednesday_stop\"> $NWB#vicidial_call_times-ct_sunday_start$NWE</td></tr>\n";
echo "<tr bgcolor=#B6D3FC><td align=right>Thursday Start:</td><td align=left><input type=text name=ct_thursday_start size=5 maxlength=4 value=\"$ct_thursday_start\"> </td><td align=right>Thursday Stop:</td><td align=left><input type=text name=ct_thursday_stop size=5 maxlength=4 value=\"$ct_thursday_stop\"> $NWB#vicidial_call_times-ct_sunday_start$NWE</td></tr>\n";
echo "<tr bgcolor=#B6D3FC><td align=right>Friday Start:</td><td align=left><input type=text name=ct_friday_start size=5 maxlength=4 value=\"$ct_friday_start\"> </td><td align=right>Friday Stop:</td><td align=left><input type=text name=ct_friday_stop size=5 maxlength=4 value=\"$ct_friday_stop\"> $NWB#vicidial_call_times-ct_sunday_start$NWE</td></tr>\n";
echo "<tr bgcolor=#B6D3FC><td align=right>Saturday Start:</td><td align=left><input type=text name=ct_saturday_start size=5 maxlength=4 value=\"$ct_saturday_start\"> </td><td align=right>Saturday Stop:</td><td align=left><input type=text name=ct_saturday_stop size=5 maxlength=4 value=\"$ct_saturday_stop\"> $NWB#vicidial_call_times-ct_sunday_start$NWE</td></tr>\n";

echo "<tr bgcolor=#B6D3FC><td align=center colspan=4><input type=submit name=SUBMIT value=SUBMIT></td></tr>\n";
echo "</TABLE><BR><BR>\n";
echo "<B>CALL TIMES USING THIS STATE CALL TIME:</B><BR>\n";
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
	echo "<br><br><a href=\"$PHP_SELF?ADD=5111111111&call_time_id=$call_time_id\">DELETE THIS STATE CALL TIME DEFINITION</a>\n";
	}

}
else
{
echo "You are not authorized to view this page. Please go back.";
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

echo "<br>MODIFY A PHONE RECORD: $row[1]<form action=$PHP_SELF method=POST>\n";
echo "<input type=hidden name=ADD value=41111111111>\n";
echo "<input type=hidden name=old_extension value=\"$row[0]\">\n";
echo "<input type=hidden name=old_server_ip value=\"$row[5]\">\n";
echo "<center><TABLE width=600 cellspacing=3>\n";
echo "<tr bgcolor=#B6D3FC><td align=right>Phone extension: </td><td align=left><input type=text name=extension size=20 maxlength=100 value=\"$row[0]\">$NWB#phones-extension$NWE</td></tr>\n";
echo "<tr bgcolor=#B6D3FC><td align=right>Dialplan Number: </td><td align=left><input type=text name=dialplan_number size=15 maxlength=20 value=\"$row[1]\"> (digits only)$NWB#phones-dialplan_number$NWE</td></tr>\n";
echo "<tr bgcolor=#B6D3FC><td align=right>Voicemail Box: </td><td align=left><input type=text name=voicemail_id size=10 maxlength=10 value=\"$row[2]\"> (digits only)$NWB#phones-voicemail_id$NWE</td></tr>\n";
echo "<tr bgcolor=#B6D3FC><td align=right>Outbound CallerID: </td><td align=left><input type=text name=outbound_cid size=10 maxlength=20 value=\"$row[65]\"> (digits only)$NWB#phones-outbound_cid$NWE</td></tr>\n";
echo "<tr bgcolor=#B6D3FC><td align=right>Phone IP address: </td><td align=left><input type=text name=phone_ip size=20 maxlength=15 value=\"$row[3]\"> (optional)$NWB#phones-phone_ip$NWE</td></tr>\n";
echo "<tr bgcolor=#B6D3FC><td align=right>Computer IP address: </td><td align=left><input type=text name=computer_ip size=20 maxlength=15 value=\"$row[4]\"> (optional)$NWB#phones-computer_ip$NWE</td></tr>\n";
echo "<tr bgcolor=#B6D3FC><td align=right><a href=\"$PHP_SELF?ADD=311111111111&server_ip=$row[5]\">Server IP</a>: </td><td align=left><select size=1 name=server_ip>\n";

echo "$servers_list";
echo "<option SELECTED>$row[5]</option>\n";
echo "</select>$NWB#phones-server_ip$NWE</td></tr>\n";
echo "<tr bgcolor=#B6D3FC><td align=right>Login: </td><td align=left><input type=text name=login size=10 maxlength=10 value=\"$row[6]\">$NWB#phones-login$NWE</td></tr>\n";
echo "<tr bgcolor=#B6D3FC><td align=right>Password: </td><td align=left><input type=text name=pass size=10 maxlength=10 value=\"$row[7]\">$NWB#phones-pass$NWE</td></tr>\n";
echo "<tr bgcolor=#B6D3FC><td align=right>Status: </td><td align=left><select size=1 name=status><option>ACTIVE</option><option>SUSPENDED</option><option>CLOSED</option><option>PENDING</option><option>ADMIN</option><option selected>$row[8]</option></select>$NWB#phones-status$NWE</td></tr>\n";
echo "<tr bgcolor=#B6D3FC><td align=right>Active Account: </td><td align=left><select size=1 name=active><option>Y</option><option>N</option><option selected>$row[9]</option></select>$NWB#phones-active$NWE</td></tr>\n";
echo "<tr bgcolor=#B6D3FC><td align=right>Phone Type: </td><td align=left><input type=text name=phone_type size=20 maxlength=50 value=\"$row[10]\">$NWB#phones-phone_type$NWE</td></tr>\n";
echo "<tr bgcolor=#B6D3FC><td align=right>Full Name: </td><td align=left><input type=text name=fullname size=20 maxlength=50 value=\"$row[11]\">$NWB#phones-fullname$NWE</td></tr>\n";
echo "<tr bgcolor=#B6D3FC><td align=right>Company: </td><td align=left><input type=text name=company size=10 maxlength=10 value=\"$row[12]\">$NWB#phones-company$NWE</td></tr>\n";
echo "<tr bgcolor=#B6D3FC><td align=right>Picture: </td><td align=left><input type=text name=picture size=20 maxlength=19 value=\"$row[13]\">$NWB#phones-picture$NWE</td></tr>\n";
echo "<tr bgcolor=#B6D3FC><td align=right>New Messages: </td><td align=left><b>$row[14]</b>$NWB#phones-messages$NWE</td></tr>\n";
echo "<tr bgcolor=#B6D3FC><td align=right>Old Messages: </td><td align=left><b>$row[15]</b>$NWB#phones-old_messages$NWE</td></tr>\n";
echo "<tr bgcolor=#B6D3FC><td align=right>Client Protocol: </td><td align=left><select size=1 name=protocol><option>SIP</option><option>Zap</option><option>IAX2</option><option>EXTERNAL</option><option selected>$row[16]</option></select>$NWB#phones-protocol$NWE</td></tr>\n";
echo "<tr bgcolor=#B6D3FC><td align=right>Local GMT: </td><td align=left><select size=1 name=local_gmt><option>12.75</option><option>12.00</option><option>11.00</option><option>10.00</option><option>9.50</option><option>9.00</option><option>8.00</option><option>7.00</option><option>6.50</option><option>6.00</option><option>5.75</option><option>5.50</option><option>5.00</option><option>4.50</option><option>4.00</option><option>3.50</option><option>3.00</option><option>2.00</option><option>1.00</option><option>0.00</option><option>-1.00</option><option>-2.00</option><option>-3.00</option><option>-3.50</option><option>-4.00</option><option>-5.00</option><option>-6.00</option><option>-7.00</option><option>-8.00</option><option>-9.00</option><option>-10.00</option><option>-11.00</option><option>-12.00</option><option selected>$row[17]</option></select> (Do NOT Adjust for DST)$NWB#phones-local_gmt$NWE</td></tr>\n";
echo "<tr bgcolor=#B6D3FC><td align=right>Manager Login: </td><td align=left><input type=text name=ASTmgrUSERNAME size=20 maxlength=20 value=\"$row[18]\">$NWB#phones-ASTmgrUSERNAME$NWE</td></tr>\n";
echo "<tr bgcolor=#B6D3FC><td align=right>Manager Secret: </td><td align=left><input type=text name=ASTmgrSECRET size=20 maxlength=20 value=\"$row[19]\">$NWB#phones-ASTmgrSECRET$NWE</td></tr>\n";
echo "<tr bgcolor=#B6D3FC><td align=right>VICIDIAL Default User: </td><td align=left><input type=text name=login_user size=20 maxlength=20 value=\"$row[20]\">$NWB#phones-login_user$NWE</td></tr>\n";
echo "<tr bgcolor=#B6D3FC><td align=right>VICIDIAL Default Pass: </td><td align=left><input type=text name=login_pass size=20 maxlength=20 value=\"$row[21]\">$NWB#phones-login_pass$NWE</td></tr>\n";
echo "<tr bgcolor=#B6D3FC><td align=right>VICIDIAL Default Campaign: </td><td align=left><input type=text name=login_campaign size=10 maxlength=10 value=\"$row[22]\">$NWB#phones-login_campaign$NWE</td></tr>\n";
echo "<tr bgcolor=#B6D3FC><td align=right>Park Exten: </td><td align=left><input type=text name=park_on_extension size=10 maxlength=10 value=\"$row[23]\">$NWB#phones-park_on_extension$NWE</td></tr>\n";
echo "<tr bgcolor=#B6D3FC><td align=right>Conf Exten: </td><td align=left><input type=text name=conf_on_extension size=10 maxlength=10 value=\"$row[24]\">$NWB#phones-conf_on_extension$NWE</td></tr>\n";
echo "<tr bgcolor=#B6D3FC><td align=right>VICIDIAL Park Exten: </td><td align=left><input type=text name=VICIDIAL_park_on_extension size=10 maxlength=10 value=\"$row[25]\">$NWB#phones-VICIDIAL_park_on_extension$NWE</td></tr>\n";
echo "<tr bgcolor=#B6D3FC><td align=right>VICIDIAL Park File: </td><td align=left><input type=text name=VICIDIAL_park_on_filename size=10 maxlength=10 value=\"$row[26]\">$NWB#phones-VICIDIAL_park_on_filename$NWE</td></tr>\n";
echo "<tr bgcolor=#B6D3FC><td align=right>Monitor Prefix: </td><td align=left><input type=text name=monitor_prefix size=10 maxlength=10 value=\"$row[27]\">$NWB#phones-monitor_prefix$NWE</td></tr>\n";
echo "<tr bgcolor=#B6D3FC><td align=right>Recording Exten: </td><td align=left><input type=text name=recording_exten size=10 maxlength=10 value=\"$row[28]\">$NWB#phones-recording_exten$NWE</td></tr>\n";
echo "<tr bgcolor=#B6D3FC><td align=right>VMailMain Exten: </td><td align=left><input type=text name=voicemail_exten size=10 maxlength=10 value=\"$row[29]\">$NWB#phones-voicemail_exten$NWE</td></tr>\n";
echo "<tr bgcolor=#B6D3FC><td align=right>VMailDump Exten: </td><td align=left><input type=text name=voicemail_dump_exten size=20 maxlength=20 value=\"$row[30]\">$NWB#phones-voicemail_dump_exten$NWE</td></tr>\n";
echo "<tr bgcolor=#B6D3FC><td align=right>Exten Context: </td><td align=left><input type=text name=ext_context size=20 maxlength=20 value=\"$row[31]\">$NWB#phones-ext_context$NWE</td></tr>\n";
echo "<tr bgcolor=#B6D3FC><td align=right>DTMFSend Channel: </td><td align=left><input type=text name=dtmf_send_extension size=40 maxlength=100 value=\"$row[32]\">$NWB#phones-dtmf_send_extension$NWE</td></tr>\n";
echo "<tr bgcolor=#B6D3FC><td align=right>Outbound Call Group: </td><td align=left><input type=text name=call_out_number_group size=40 maxlength=100 value=\"$row[33]\">$NWB#phones-call_out_number_group$NWE</td></tr>\n";
echo "<tr bgcolor=#B6D3FC><td align=right>Browser Location: </td><td align=left><input type=text name=client_browser size=40 maxlength=100 value=\"$row[34]\">$NWB#phones-client_browser$NWE</td></tr>\n";
echo "<tr bgcolor=#B6D3FC><td align=right>Install Directory: </td><td align=left><input type=text name=install_directory size=40 maxlength=100 value=\"$row[35]\">$NWB#phones-install_directory$NWE</td></tr>\n";
echo "<tr bgcolor=#B6D3FC><td align=right>CallerID URL: </td><td align=left><input type=text name=local_web_callerID_URL size=40 maxlength=255 value=\"$row[36]\">$NWB#phones-local_web_callerID_URL$NWE</td></tr>\n";
echo "<tr bgcolor=#B6D3FC><td align=right>VICIDIAL Default URL: </td><td align=left><input type=text name=VICIDIAL_web_URL size=40 maxlength=255 value=\"$row[37]\">$NWB#phones-VICIDIAL_web_URL$NWE</td></tr>\n";
echo "<tr bgcolor=#B6D3FC><td align=right>Call Logging: </td><td align=left><select size=1 name=AGI_call_logging_enabled><option>1</option><option>0</option><option selected>$row[38]</option></select>$NWB#phones-AGI_call_logging_enabled$NWE</td></tr>\n";
echo "<tr bgcolor=#B6D3FC><td align=right>User Switching: </td><td align=left><select size=1 name=user_switching_enabled><option>1</option><option>0</option><option selected>$row[39]</option></select>$NWB#phones-user_switching_enabled$NWE</td></tr>\n";
echo "<tr bgcolor=#B6D3FC><td align=right>Conferencing: </td><td align=left><select size=1 name=conferencing_enabled><option>1</option><option>0</option><option selected>$row[40]</option></select>$NWB#phones-conferencing_enabled$NWE</td></tr>\n";
echo "<tr bgcolor=#B6D3FC><td align=right>Admin Hangup: </td><td align=left><select size=1 name=admin_hangup_enabled><option>1</option><option>0</option><option selected>$row[41]</option></select>$NWB#phones-admin_hangup_enabled$NWE</td></tr>\n";
echo "<tr bgcolor=#B6D3FC><td align=right>Admin Hijack: </td><td align=left><select size=1 name=admin_hijack_enabled><option>1</option><option>0</option><option selected>$row[42]</option></select>$NWB#phones-admin_hijack_enabled$NWE</td></tr>\n";
echo "<tr bgcolor=#B6D3FC><td align=right>Admin Monitor: </td><td align=left><select size=1 name=admin_monitor_enabled><option>1</option><option>0</option><option selected>$row[43]</option></select>$NWB#phones-admin_monitor_enabled$NWE</td></tr>\n";
echo "<tr bgcolor=#B6D3FC><td align=right>Call Park: </td><td align=left><select size=1 name=call_parking_enabled><option>1</option><option>0</option><option selected>$row[44]</option></select>$NWB#phones-call_parking_enabled$NWE</td></tr>\n";
echo "<tr bgcolor=#B6D3FC><td align=right>Updater Check: </td><td align=left><select size=1 name=updater_check_enabled><option>1</option><option>0</option><option selected>$row[45]</option></select>$NWB#phones-updater_check_enabled$NWE</td></tr>\n";
echo "<tr bgcolor=#B6D3FC><td align=right>AF Logging: </td><td align=left><select size=1 name=AFLogging_enabled><option>1</option><option>0</option><option selected>$row[46]</option></select>$NWB#phones-AFLogging_enabled$NWE</td></tr>\n";
echo "<tr bgcolor=#B6D3FC><td align=right>Queue Enabled: </td><td align=left><select size=1 name=QUEUE_ACTION_enabled><option>1</option><option>0</option><option selected>$row[47]</option></select>$NWB#phones-QUEUE_ACTION_enabled$NWE</td></tr>\n";
echo "<tr bgcolor=#B6D3FC><td align=right>CallerID Popup: </td><td align=left><select size=1 name=CallerID_popup_enabled><option>1</option><option>0</option><option selected>$row[48]</option></select>$NWB#phones-CallerID_popup_enabled$NWE</td></tr>\n";
echo "<tr bgcolor=#B6D3FC><td align=right>VMail Button: </td><td align=left><select size=1 name=voicemail_button_enabled><option>1</option><option>0</option><option selected>$row[49]</option></select>$NWB#phones-voicemail_button_enabled$NWE</td></tr>\n";
echo "<tr bgcolor=#B6D3FC><td align=right>Fast Refresh: </td><td align=left><select size=1 name=enable_fast_refresh><option>1</option><option>0</option><option selected>$row[50]</option></select>$NWB#phones-enable_fast_refresh$NWE</td></tr>\n";
echo "<tr bgcolor=#B6D3FC><td align=right>Fast Refresh Rate: </td><td align=left><input type=text size=5 name=fast_refresh_rate value=\"$row[51]\">(in ms)$NWB#phones-fast_refresh_rate$NWE</td></tr>\n";
echo "<tr bgcolor=#B6D3FC><td align=right>Persistant MySQL: </td><td align=left><select size=1 name=enable_persistant_mysql><option>1</option><option>0</option><option selected>$row[52]</option></select>$NWB#phones-enable_persistant_mysql$NWE</td></tr>\n";
echo "<tr bgcolor=#B6D3FC><td align=right>Auto Dial Next Number: </td><td align=left><select size=1 name=auto_dial_next_number><option>1</option><option>0</option><option selected>$row[53]</option></select>$NWB#phones-auto_dial_next_number$NWE</td></tr>\n";
echo "<tr bgcolor=#B6D3FC><td align=right>Stop Rec after each call: </td><td align=left><select size=1 name=VDstop_rec_after_each_call><option>1</option><option>0</option><option selected>$row[54]</option></select>$NWB#phones-VDstop_rec_after_each_call$NWE</td></tr>\n";
echo "<tr bgcolor=#B6D3FC><td align=right>DBX Server: </td><td align=left><input type=text name=DBX_server size=15 maxlength=15 value=\"$row[55]\"> (Primary DB Server)$NWB#phones-DBX_server$NWE</td></tr>\n";
echo "<tr bgcolor=#B6D3FC><td align=right>DBX Database: </td><td align=left><input type=text name=DBX_database size=15 maxlength=15 value=\"$row[56]\"> (Primary Server Database)$NWB#phones-DBX_database$NWE</td></tr>\n";
echo "<tr bgcolor=#B6D3FC><td align=right>DBX User: </td><td align=left><input type=text name=DBX_user size=15 maxlength=15 value=\"$row[57]\"> (Primary DB Login)$NWB#phones-DBX_user$NWE</td></tr>\n";
echo "<tr bgcolor=#B6D3FC><td align=right>DBX Pass: </td><td align=left><input type=text name=DBX_pass size=15 maxlength=15 value=\"$row[58]\"> (Primary DB Secret)$NWB#phones-DBX_pass$NWE</td></tr>\n";
echo "<tr bgcolor=#B6D3FC><td align=right>DBX Port: </td><td align=left><input type=text name=DBX_port size=6 maxlength=6 value=\"$row[59]\"> (Primary DB Port)$NWB#phones-DBX_port$NWE</td></tr>\n";
echo "<tr bgcolor=#B6D3FC><td align=right>DBY Server: </td><td align=left><input type=text name=DBY_server size=15 maxlength=15 value=\"$row[60]\"> (Secondary DB Server)$NWB#phones-DBY_server$NWE</td></tr>\n";
echo "<tr bgcolor=#B6D3FC><td align=right>DBY Database: </td><td align=left><input type=text name=DBY_database size=15 maxlength=15 value=\"$row[61]\"> (Secondary Server Database)$NWB#phones-DBY_database$NWE</td></tr>\n";
echo "<tr bgcolor=#B6D3FC><td align=right>DBY User: </td><td align=left><input type=text name=DBY_user size=15 maxlength=15 value=\"$row[62]\"> (Secondary DB Login)$NWB#phones-DBY_user$NWE</td></tr>\n";
echo "<tr bgcolor=#B6D3FC><td align=right>DBY Pass: </td><td align=left><input type=text name=DBY_pass size=15 maxlength=15 value=\"$row[63]\"> (Secondary DB Secret)$NWB#phones-DBY_pass$NWE</td></tr>\n";
echo "<tr bgcolor=#B6D3FC><td align=right>DBY Port: </td><td align=left><input type=text name=DBY_port size=6 maxlength=6 value=\"$row[64]\"> (Secondary DB Port)$NWB#phones-DBY_port$NWE</td></tr>\n";
echo "<tr bgcolor=#B6D3FC><td align=center colspan=2><input type=submit name=submit VALUE=SUBMIT></td></tr>\n";
echo "</TABLE></center>\n";

echo "<br><br><a href=\"./phone_stats.php?extension=$row[0]&server_ip=$row[5]\">Click here for phone stats</a>\n";

if ($LOGast_delete_phones > 0)
	{
	echo "<br><br><a href=\"$PHP_SELF?ADD=51111111111&extension=$extension&server_ip=$server_ip\">DELETE THIS PHONE</a>\n";
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

echo "<br>MODIFY A SERVER RECORD: $row[0]<form action=$PHP_SELF method=POST>\n";
echo "<input type=hidden name=ADD value=411111111111>\n";
echo "<input type=hidden name=old_server_id value=\"$server_id\">\n";
echo "<input type=hidden name=old_server_ip value=\"$row[2]\">\n";
echo "<center><TABLE width=600 cellspacing=3>\n";
echo "<tr bgcolor=#B6D3FC><td align=right>Server ID: </td><td align=left><input type=text name=server_id size=10 maxlength=10 value=\"$row[0]\">$NWB#servers-server_id$NWE</td></tr>\n";
echo "<tr bgcolor=#B6D3FC><td align=right>Server Description: </td><td align=left><input type=text name=server_description size=30 maxlength=255 value=\"$row[1]\">$NWB#servers-server_description$NWE</td></tr>\n";
echo "<tr bgcolor=#B6D3FC><td align=right>Server IP Address: </td><td align=left><input type=text name=server_ip size=20 maxlength=15 value=\"$row[2]\">$NWB#servers-server_ip$NWE</td></tr>\n";
echo "<tr bgcolor=#B6D3FC><td align=right>Active: </td><td align=left><select size=1 name=active><option>Y</option><option>N</option><option selected>$row[3]</option></select>$NWB#servers-active$NWE</td></tr>\n";
echo "<tr bgcolor=#B6D3FC><td align=right>Asterisk Version: </td><td align=left><input type=text name=asterisk_version size=20 maxlength=20 value=\"$row[4]\">$NWB#servers-asterisk_version$NWE</td></tr>\n";
echo "<tr bgcolor=#B6D3FC><td align=right>Max VICIDIAL Trunks: </td><td align=left><input type=text name=max_vicidial_trunks size=5 maxlength=4 value=\"$row[5]\">$NWB#servers-max_vicidial_trunks$NWE</td></tr>\n";
echo "<tr bgcolor=#B6D3FC><td align=right>VICIDIAL Balance Dialing: </td><td align=left><select size=1 name=vicidial_balance_active><option>Y</option><option>N</option><option selected>$row[20]</option></select>$NWB#servers-vicidial_balance_active$NWE</td></tr>\n";
echo "<tr bgcolor=#B6D3FC><td align=right>VICIDIAL Balance Offlimits: </td><td align=left><input type=text name=balance_trunks_offlimits size=5 maxlength=4 value=\"$row[21]\">$NWB#servers-balance_trunks_offlimits$NWE</td></tr>\n";
echo "<tr bgcolor=#B6D3FC><td align=right>Telnet Host: </td><td align=left><input type=text name=telnet_host size=20 maxlength=20 value=\"$row[6]\">$NWB#servers-telnet_host$NWE</td></tr>\n";
echo "<tr bgcolor=#B6D3FC><td align=right>Telnet Port: </td><td align=left><input type=text name=telnet_port size=6 maxlength=5 value=\"$row[7]\">$NWB#servers-telnet_port$NWE</td></tr>\n";
echo "<tr bgcolor=#B6D3FC><td align=right>Manager User: </td><td align=left><input type=text name=ASTmgrUSERNAME size=20 maxlength=20 value=\"$row[8]\">$NWB#servers-ASTmgrUSERNAME$NWE</td></tr>\n";
echo "<tr bgcolor=#B6D3FC><td align=right>Manager Secret: </td><td align=left><input type=text name=ASTmgrSECRET size=20 maxlength=20 value=\"$row[9]\">$NWB#servers-ASTmgrSECRET$NWE</td></tr>\n";
echo "<tr bgcolor=#B6D3FC><td align=right>Manager Update User: </td><td align=left><input type=text name=ASTmgrUSERNAMEupdate size=20 maxlength=20 value=\"$row[10]\">$NWB#servers-ASTmgrUSERNAMEupdate$NWE</td></tr>\n";
echo "<tr bgcolor=#B6D3FC><td align=right>Manager Listen User: </td><td align=left><input type=text name=ASTmgrUSERNAMElisten size=20 maxlength=20 value=\"$row[11]\">$NWB#servers-ASTmgrUSERNAMElisten$NWE</td></tr>\n";
echo "<tr bgcolor=#B6D3FC><td align=right>Manager Send User: </td><td align=left><input type=text name=ASTmgrUSERNAMEsend size=20 maxlength=20 value=\"$row[12]\">$NWB#servers-ASTmgrUSERNAMEsend$NWE</td></tr>\n";
echo "<tr bgcolor=#B6D3FC><td align=right>Local GMT: </td><td align=left><select size=1 name=local_gmt><option>12.75</option><option>12.00</option><option>11.00</option><option>10.00</option><option>9.50</option><option>9.00</option><option>8.00</option><option>7.00</option><option>6.50</option><option>6.00</option><option>5.75</option><option>5.50</option><option>5.00</option><option>4.50</option><option>4.00</option><option>3.50</option><option>3.00</option><option>2.00</option><option>1.00</option><option>0.00</option><option>-1.00</option><option>-2.00</option><option>-3.00</option><option>-3.50</option><option>-4.00</option><option>-5.00</option><option>-6.00</option><option>-7.00</option><option>-8.00</option><option>-9.00</option><option>-10.00</option><option>-11.00</option><option>-12.00</option><option selected>$row[13]</option></select> (Do NOT Adjust for DST)$NWB#servers-local_gmt$NWE</td></tr>\n";
echo "<tr bgcolor=#B6D3FC><td align=right>VMail Dump Exten: </td><td align=left><input type=text name=voicemail_dump_exten size=20 maxlength=20 value=\"$row[14]\">$NWB#servers-voicemail_dump_exten$NWE</td></tr>\n";
echo "<tr bgcolor=#B6D3FC><td align=right>VICIDIAL AD extension: </td><td align=left><input type=text name=answer_transfer_agent size=20 maxlength=20 value=\"$row[15]\">$NWB#servers-answer_transfer_agent$NWE</td></tr>\n";
echo "<tr bgcolor=#B6D3FC><td align=right>Default Context: </td><td align=left><input type=text name=ext_context size=20 maxlength=20 value=\"$row[16]\">$NWB#servers-ext_context$NWE</td></tr>\n";
echo "<tr bgcolor=#B6D3FC><td align=right>System Performance: </td><td align=left><select size=1 name=sys_perf_log><option>Y</option><option>N</option><option selected>$row[17]</option></select>$NWB#servers-sys_perf_log$NWE</td></tr>\n";
echo "<tr bgcolor=#B6D3FC><td align=right>Server Logs: </td><td align=left><select size=1 name=vd_server_logs><option>Y</option><option>N</option><option selected>$row[18]</option></select>$NWB#servers-vd_server_logs$NWE</td></tr>\n";
echo "<tr bgcolor=#B6D3FC><td align=right>AGI Output: </td><td align=left><select size=1 name=agi_output><option>NONE</option><option>STDERR</option><option>FILE</option><option>BOTH</option><option selected>$row[19]</option></select>$NWB#servers-agi_output$NWE</td></tr>\n";
echo "<tr bgcolor=#B6D3FC><td align=center colspan=2><input type=submit name=submit VALUE=SUBMIT></td></tr>\n";
echo "</TABLE></center></form>\n";


### vicidial server trunk records for this server
echo "<br><br><b>VICIDIAL TRUNKS FOR THIS SERVER: &nbsp; $NWB#vicidial_server_trunks$NWE</b><br>\n";
echo "<TABLE width=500 cellspacing=3>\n";
echo "<tr><td> CAMPAIGN</td><td> TRUNKS </td><td> RESTRICTION </td><td> </td><td> DELETE </td></tr>\n";

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
	echo "<td><font size=1><a href=\"$PHP_SELF?ADD=621111111111&campaign_id=$rowx[1]&server_ip=$server_ip\">DELETE</a></td></tr>\n";
	}

echo "</table>\n";

echo "<br><b>ADD NEW SERVER VICIDIAL TRUNK RECORD</b><BR><form action=$PHP_SELF method=POST>\n";
echo "<input type=hidden name=ADD value=221111111111>\n";
echo "<input type=hidden name=server_ip value=\"$server_ip\">\n";
echo "TRUNKS: <input size=6 maxlength=4 name=dedicated_trunks><BR>\n";
echo "CAMPAIGN: <select size=1 name=campaign_id>\n";
echo "$campaigns_list\n";
echo "</select><BR>\n";
echo "RESTRICTION: <select size=1 name=trunk_restriction><option>MAXIMUM_LIMIT</option><option>OVERFLOW_ALLOWED</option></select><BR>\n";
echo "<input type=submit name=submit value=ADD><BR>\n";

echo "</center></FORM><br>\n";


### list of phones on this server
echo "<center>\n";
echo "<br><b>PHONES WITHIN THIS SERVER:</b><br>\n";
echo "<TABLE width=400 cellspacing=3>\n";
echo "<tr><td>EXTENSION</td><td>NAME</td><td>ACTIVE</td></tr>\n";

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
echo "<tr><td>CONFERENCE</td><td>EXTENSION</td></tr>\n";

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
echo "<tr><td>VD CONFERENCE</td><td>EXTENSION</td></tr>\n";

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
echo "This server has $active_phones active phones and $inactive_phones inactive phones<br><br>\n";
echo "This server has $active_confs active conferences<br><br>\n";
echo "This server has $active_vdconfs active vicidial conferences<br><br>\n";
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

echo "<br>MODIFY A CONFERENCE RECORD: $row[0]<form action=$PHP_SELF method=POST>\n";
echo "<input type=hidden name=ADD value=4111111111111>\n";
echo "<input type=hidden name=old_conf_exten value=\"$row[0]\">\n";
echo "<input type=hidden name=old_server_ip value=\"$row[1]\">\n";
echo "<center><TABLE width=600 cellspacing=3>\n";
echo "<tr bgcolor=#B6D3FC><td align=right>Conference: </td><td align=left><input type=text name=conf_exten size=10 maxlength=7 value=\"$row[0]\">$NWB#conferences-conf_exten$NWE</td></tr>\n";
echo "<tr bgcolor=#B6D3FC><td align=right><a href=\"$PHP_SELF?ADD=311111111111&server_ip=$row[1]\">Server IP</a>: </td><td align=left><select size=1 name=server_ip>\n";

echo "$servers_list";
echo "<option SELECTED>$row[1]</option>\n";
echo "</select>$NWB#conferences-server_ip$NWE</td></tr>\n";
echo "<tr bgcolor=#B6D3FC><td align=right>Current Extension: </td><td align=left><input type=text name=extension size=20 maxlength=20 value=\"$row[2]\"></td></tr>\n";
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
echo "<tr bgcolor=#B6D3FC><td align=right>Conference: </td><td align=left><input type=text name=conf_exten size=10 maxlength=7 value=\"$row[0]\">$NWB#conferences-conf_exten$NWE</td></tr>\n";
echo "<tr bgcolor=#B6D3FC><td align=right><a href=\"$PHP_SELF?ADD=311111111111&server_ip=$row[1]\">Server IP</a>: </td><td align=left><select size=1 name=server_ip>\n";

echo "$servers_list";
echo "<option SELECTED>$row[1]</option>\n";
echo "</select>$NWB#conferences-server_ip$NWE</td></tr>\n";
echo "<tr bgcolor=#B6D3FC><td align=right>Current Extension: </td><td align=left><input type=text name=extension size=20 maxlength=20 value=\"$row[2]\"></td></tr>\n";
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

echo "<br>SEARCH FOR A USER<form action=$PHP_SELF method=POST>\n";
echo "<input type=hidden name=ADD value=66>\n";
echo "<center><TABLE width=600 cellspacing=3>\n";
echo "<tr bgcolor=#B6D3FC><td align=right>User Number: </td><td align=left><input type=text name=user size=20 maxlength=20></td></tr>\n";
echo "<tr bgcolor=#B6D3FC><td align=right>Full Name: </td><td align=left><input type=text name=full_name size=30 maxlength=30></td></tr>\n";
echo "<tr bgcolor=#B6D3FC><td align=right>User Level: </td><td align=left><select size=1 name=user_level><option selected>0</option><option>1</option><option>2</option><option>3</option><option>4</option><option>5</option><option>6</option><option>7</option><option>8</option><option>9</option></select></td></tr>\n";
echo "<tr bgcolor=#B6D3FC><td align=right>User Group: </td><td align=left><select size=1 name=user_group>\n";

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

echo "<br>SEARCH RESULTS:\n";
echo "<center><TABLE width=600 cellspacing=0 cellpadding=1>\n";

	$o=0;
	while ($people_to_print > $o) {
		$row=mysql_fetch_row($rslt);
		if (eregi("1$|3$|5$|7$|9$", $o))
			{$bgcolor='bgcolor="#B9CBFD"';} 
		else
			{$bgcolor='bgcolor="#9BB9FB"';}
		echo "<tr $bgcolor><td><font size=1>$row[1]</td><td><font size=1>$row[3]</td><td><font size=1>$row[4]</td><td><font size=1>$row[5]</td>";
		echo "<td><font size=1><a href=\"$PHP_SELF?ADD=3&user=$row[1]\">MODIFY</a> | <a href=\"./user_stats.php?user=$row[1]\">STATS</a> | <a href=\"./user_status.php?user=$row[1]\">STATUS</a> | <a href=\"./AST_agent_time_sheet.php?agent=$row[1]\">TIME</a></td></tr>\n";
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
echo "<tr bgcolor=black><td><font size=1 color=white>LEAD</td><td><font size=1 color=white>LIST</td><td><font size=1 color=white> CAMPAIGN</td><td><font size=1 color=white>ENTRY DATE</td><td><font size=1 color=white>CALLBACK DATE</td><td><font size=1 color=white>USER</td><td><font size=1 color=white>RECIPIENT</td><td><font size=1 color=white>STATUS</td></tr>\n";

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

echo "<br>USER LISTINGS:\n";
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
		echo "<td><font size=1><a href=\"$PHP_SELF?ADD=3&user=$row[1]\">MODIFY</a> | <a href=\"./user_stats.php?user=$row[1]\">STATS</a> | <a href=\"./user_status.php?user=$row[1]\">STATUS</a> | <a href=\"./AST_agent_time_sheet.php?agent=$row[1]\">TIME</a></td></tr>\n";
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

echo "<br>CAMPAIGN LISTINGS:\n";
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
		echo "<td><font size=1><a href=\"$PHP_SELF?ADD=31&campaign_id=$row[0]\">MODIFY</a></td></tr>\n";
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

echo "<br>LIST LISTINGS:\n";
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
		echo "<td><font size=1><a href=\"$PHP_SELF?ADD=311&list_id=$row[0]\">MODIFY</a></td></tr>\n";
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

echo "<br>INBOUND GROUP LISTINGS:\n";
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
		echo "<td><font size=1><a href=\"$PHP_SELF?ADD=3111&group_id=$row[0]\">MODIFY</a></td></tr>\n";
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

echo "<br>REMOTE AGENTS LISTINGS:\n";
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
		echo "<td><font size=1><a href=\"$PHP_SELF?ADD=31111&remote_agent_id=$row[0]\">MODIFY</a></td></tr>\n";
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

echo "<br>USER GROUPS LISTINGS:\n";
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
		echo "<td><font size=1><a href=\"$PHP_SELF?ADD=311111&user_group=$row[0]\">MODIFY</a></td></tr>\n";
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

echo "<br>SCRIPTS LISTINGS:\n";
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
		echo "<td><font size=1><a href=\"$PHP_SELF?ADD=3111111&script_id=$row[0]\">MODIFY</a></td></tr>\n";
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

echo "<br>LEAD FILTER LISTINGS:\n";
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
		echo "<td><font size=1><a href=\"$PHP_SELF?ADD=31111111&lead_filter_id=$row[0]\">MODIFY</a></td></tr>\n";
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

echo "<br>CALL TIME LISTINGS:\n";
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
		echo "<td><font size=1><a href=\"$PHP_SELF?ADD=311111111&call_time_id=$row[0]\">MODIFY</a></td></tr>\n";
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

echo "<br>STATE CALL TIME LISTINGS:\n";
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
		echo "<td><font size=1><a href=\"$PHP_SELF?ADD=3111111111&call_time_id=$row[0]\">MODIFY</a></td></tr>\n";
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

echo "<br>PHONE LISTINGS:\n";
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
		echo "<td><font size=1><a href=\"$PHP_SELF?ADD=31111111111&extension=$row[0]&server_ip=$row[5]\">MODIFY</a> | <a href=\"./phone_stats.php?extension=$row[0]&server_ip=$row[5]\">STATS</a></td></tr>\n";
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

echo "<br>SERVER LISTINGS:\n";
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
		echo "<td><font size=1><a href=\"$PHP_SELF?ADD=311111111111&server_id=$row[0]\">MODIFY</a></td></tr>\n";
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

echo "<br>CONFERENCE LISTINGS:\n";
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
		echo "<td><font size=1><a href=\"$PHP_SELF?ADD=3111111111111&conf_exten=$row[0]&server_ip=$row[1]\">MODIFY</a></td></tr>\n";
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

echo "<br>CONFERENCE LISTINGS:\n";
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
		echo "<td><font size=1><a href=\"$PHP_SELF?ADD=31111111111111&conf_exten=$row[0]&server_ip=$row[1]\">MODIFY</a></td></tr>\n";
		$o++;
	}

echo "</TABLE></center>\n";
}




echo "</TD></TR></TABLE></center>\n";

$ENDtime = date("U");

$RUNtime = ($ENDtime - $STARTtime);

echo "\n\n\n<br><br><br>\n\n";


echo "<font size=0>\n\n\n<br><br><br>\nscript runtime: $RUNtime seconds";
echo " &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; VERSION: $version";
echo " &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; BUILD: $build</font>\n";


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
					if ($GMT_day[$r]==0)	#### Sunday local time
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
					if ($GMT_day[$r]==1)	#### Monday local time
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
					if ($GMT_day[$r]==2)	#### Tuesday local time
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
					if ($GMT_day[$r]==3)	#### Wednesday local time
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
					if ($GMT_day[$r]==4)	#### Thursday local time
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
					if ($GMT_day[$r]==5)	#### Friday local time
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
					if ($GMT_day[$r]==6)	#### Saturday local time
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
			if ($GMT_day[$r]==0)	#### Sunday local time
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
			if ($GMT_day[$r]==1)	#### Monday local time
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
			if ($GMT_day[$r]==2)	#### Tuesday local time
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
			if ($GMT_day[$r]==3)	#### Wednesday local time
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
			if ($GMT_day[$r]==4)	#### Thursday local time
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
			if ($GMT_day[$r]==5)	#### Friday local time
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
			if ($GMT_day[$r]==6)	#### Saturday local time
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

		echo "This campaign has $active_leads leads to be dialed in those lists\n";
		}
	else
		{
		echo "no active lists selected for this campaign\n";
		}
	}
else
	{
	echo "no active lists selected for this campaign\n";
	}
##### END calculate what gmt_offset_now values are within the allowed local_call_time setting ###
}
?>
