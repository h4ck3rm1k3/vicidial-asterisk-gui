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
if (isset($_GET["ADD"]))				{$ADD=$_GET["ADD"];}
	elseif (isset($_POST["ADD"]))		{$ADD=$_POST["ADD"];}
if (isset($_GET["stage"]))				{$stage=$_GET["stage"];}
	elseif (isset($_POST["stage"]))		{$stage=$_POST["stage"];}
if (isset($_GET["groups"]))				{$groups=$_GET["groups"];}
	elseif (isset($_POST["groups"]))		{$groups=$_POST["groups"];}
if (isset($_GET["remote_agent_id"]))				{$remote_agent_id=$_GET["remote_agent_id"];}
	elseif (isset($_POST["remote_agent_id"]))		{$remote_agent_id=$_POST["remote_agent_id"];}
if (isset($_GET["user"]))				{$user=$_GET["user"];}
	elseif (isset($_POST["user"]))		{$user=$_POST["user"];}
if (isset($_GET["pass"]))				{$pass=$_GET["pass"];}
	elseif (isset($_POST["pass"]))		{$pass=$_POST["pass"];}
if (isset($_GET["full_name"]))				{$full_name=$_GET["full_name"];}
	elseif (isset($_POST["full_name"]))		{$full_name=$_POST["full_name"];}
if (isset($_GET["user_level"]))				{$user_level=$_GET["user_level"];}
	elseif (isset($_POST["user_level"]))		{$user_level=$_POST["user_level"];}
if (isset($_GET["user_group"]))				{$user_group=$_GET["user_group"];}
	elseif (isset($_POST["user_group"]))		{$user_group=$_POST["user_group"];}
if (isset($_GET["campaign_id"]))				{$campaign_id=$_GET["campaign_id"];}
	elseif (isset($_POST["campaign_id"]))		{$campaign_id=$_POST["campaign_id"];}
if (isset($_GET["campaign_name"]))				{$campaign_name=$_GET["campaign_name"];}
	elseif (isset($_POST["campaign_name"]))		{$campaign_name=$_POST["campaign_name"];}
if (isset($_GET["active"]))				{$active=$_GET["active"];}
	elseif (isset($_POST["active"]))		{$active=$_POST["active"];}
if (isset($_GET["park_ext"]))				{$park_ext=$_GET["park_ext"];}
	elseif (isset($_POST["park_ext"]))		{$park_ext=$_POST["park_ext"];}
if (isset($_GET["park_file_name"]))				{$park_file_name=$_GET["park_file_name"];}
	elseif (isset($_POST["park_file_name"]))		{$park_file_name=$_POST["park_file_name"];}
if (isset($_GET["web_form_address"]))				{$web_form_address=$_GET["web_form_address"];}
	elseif (isset($_POST["web_form_address"]))		{$web_form_address=$_POST["web_form_address"];}
if (isset($_GET["allow_closers"]))				{$allow_closers=$_GET["allow_closers"];}
	elseif (isset($_POST["allow_closers"]))		{$allow_closers=$_POST["allow_closers"];}
if (isset($_GET["hopper_level"]))				{$hopper_level=$_GET["hopper_level"];}
	elseif (isset($_POST["hopper_level"]))		{$hopper_level=$_POST["hopper_level"];}
if (isset($_GET["auto_dial_level"]))				{$auto_dial_level=$_GET["auto_dial_level"];}
	elseif (isset($_POST["auto_dial_level"]))		{$auto_dial_level=$_POST["auto_dial_level"];}
if (isset($_GET["next_agent_call"]))				{$next_agent_call=$_GET["next_agent_call"];}
	elseif (isset($_POST["next_agent_call"]))		{$next_agent_call=$_POST["next_agent_call"];}
if (isset($_GET["local_call_time"]))				{$local_call_time=$_GET["local_call_time"];}
	elseif (isset($_POST["local_call_time"]))		{$local_call_time=$_POST["local_call_time"];}
if (isset($_GET["voicemail_ext"]))				{$voicemail_ext=$_GET["voicemail_ext"];}
	elseif (isset($_POST["voicemail_ext"]))		{$voicemail_ext=$_POST["voicemail_ext"];}
if (isset($_GET["submit"]))				{$submit=$_GET["submit"];}
	elseif (isset($_POST["submit"]))		{$submit=$_POST["submit"];}
if (isset($_GET["list_id"]))				{$list_id=$_GET["list_id"];}
	elseif (isset($_POST["list_id"]))		{$list_id=$_POST["list_id"];}
if (isset($_GET["list_name"]))				{$list_name=$_GET["list_name"];}
	elseif (isset($_POST["list_name"]))		{$list_name=$_POST["list_name"];}
if (isset($_GET["group_id"]))				{$group_id=$_GET["group_id"];}
	elseif (isset($_POST["group_id"]))		{$group_id=$_POST["group_id"];}
if (isset($_GET["group_name"]))				{$group_name=$_GET["group_name"];}
	elseif (isset($_POST["group_name"]))		{$group_name=$_POST["group_name"];}
if (isset($_GET["group_color"]))				{$group_color=$_GET["group_color"];}
	elseif (isset($_POST["group_color"]))		{$group_color=$_POST["group_color"];}
if (isset($_GET["fronter_display"]))				{$fronter_display=$_GET["fronter_display"];}
	elseif (isset($_POST["fronter_display"]))		{$fronter_display=$_POST["fronter_display"];}
if (isset($_GET["user_start"]))				{$user_start=$_GET["user_start"];}
	elseif (isset($_POST["user_start"]))		{$user_start=$_POST["user_start"];}
if (isset($_GET["number_of_lines"]))				{$number_of_lines=$_GET["number_of_lines"];}
	elseif (isset($_POST["number_of_lines"]))		{$number_of_lines=$_POST["number_of_lines"];}
if (isset($_GET["server_ip"]))				{$server_ip=$_GET["server_ip"];}
	elseif (isset($_POST["server_ip"]))		{$server_ip=$_POST["server_ip"];}
if (isset($_GET["conf_exten"]))				{$conf_exten=$_GET["conf_exten"];}
	elseif (isset($_POST["conf_exten"]))		{$conf_exten=$_POST["conf_exten"];}
if (isset($_GET["status"]))				{$status=$_GET["status"];}
	elseif (isset($_POST["status"]))		{$status=$_POST["status"];}
if (isset($_GET["group_name"]))				{$group_name=$_GET["group_name"];}
	elseif (isset($_POST["group_name"]))		{$group_name=$_POST["group_name"];}
if (isset($_GET["dial_status_a"]))				{$dial_status_a=$_GET["dial_status_a"];}
	elseif (isset($_POST["dial_status_a"]))		{$dial_status_a=$_POST["dial_status_a"];}
if (isset($_GET["dial_status_b"]))				{$dial_status_b=$_GET["dial_status_b"];}
	elseif (isset($_POST["dial_status_b"]))		{$dial_status_b=$_POST["dial_status_b"];}
if (isset($_GET["dial_status_c"]))				{$dial_status_c=$_GET["dial_status_c"];}
	elseif (isset($_POST["dial_status_c"]))		{$dial_status_c=$_POST["dial_status_c"];}
if (isset($_GET["dial_status_d"]))				{$dial_status_d=$_GET["dial_status_d"];}
	elseif (isset($_POST["dial_status_d"]))		{$dial_status_d=$_POST["dial_status_d"];}
if (isset($_GET["dial_status_e"]))				{$dial_status_e=$_GET["dial_status_e"];}
	elseif (isset($_POST["dial_status_e"]))		{$dial_status_e=$_POST["dial_status_e"];}
if (isset($_GET["lead_order"]))				{$lead_order=$_GET["lead_order"];}
	elseif (isset($_POST["lead_order"]))		{$lead_order=$_POST["lead_order"];}
if (isset($_GET["dial_timeout"]))				{$dial_timeout=$_GET["dial_timeout"];}
	elseif (isset($_POST["dial_timeout"]))		{$dial_timeout=$_POST["dial_timeout"];}
if (isset($_GET["dial_prefix"]))				{$dial_prefix=$_GET["dial_prefix"];}
	elseif (isset($_POST["dial_prefix"]))		{$dial_prefix=$_POST["dial_prefix"];}
if (isset($_GET["campaign_cid"]))				{$campaign_cid=$_GET["campaign_cid"];}
	elseif (isset($_POST["campaign_cid"]))		{$campaign_cid=$_POST["campaign_cid"];}
if (isset($_GET["campaign_vdad_exten"]))				{$campaign_vdad_exten=$_GET["campaign_vdad_exten"];}
	elseif (isset($_POST["campaign_vdad_exten"]))		{$campaign_vdad_exten=$_POST["campaign_vdad_exten"];}
if (isset($_GET["campaign_rec_exten"]))				{$campaign_rec_exten=$_GET["campaign_rec_exten"];}
	elseif (isset($_POST["campaign_rec_exten"]))		{$campaign_rec_exten=$_POST["campaign_rec_exten"];}
if (isset($_GET["campaign_recording"]))				{$campaign_recording=$_GET["campaign_recording"];}
	elseif (isset($_POST["campaign_recording"]))		{$campaign_recording=$_POST["campaign_recording"];}
if (isset($_GET["campaign_rec_filename"]))				{$campaign_rec_filename=$_GET["campaign_rec_filename"];}
	elseif (isset($_POST["campaign_rec_filename"]))		{$campaign_rec_filename=$_POST["campaign_rec_filename"];}
if (isset($_GET["hotkey"]))				{$hotkey=$_GET["hotkey"];}
	elseif (isset($_POST["hotkey"]))		{$hotkey=$_POST["hotkey"];}
if (isset($_GET["reset_list"]))				{$reset_list=$_GET["reset_list"];}
	elseif (isset($_POST["reset_list"]))		{$reset_list=$_POST["reset_list"];}
if (isset($_GET["old_campaign_id"]))				{$old_campaign_id=$_GET["old_campaign_id"];}
	elseif (isset($_POST["old_campaign_id"]))		{$old_campaign_id=$_POST["old_campaign_id"];}
if (isset($_GET["OLDuser_group"]))				{$OLDuser_group=$_GET["OLDuser_group"];}
	elseif (isset($_POST["OLDuser_group"]))		{$OLDuser_group=$_POST["OLDuser_group"];}
if (isset($_GET["status_name"]))				{$status_name=$_GET["status_name"];}
	elseif (isset($_POST["status_name"]))		{$status_name=$_POST["status_name"];}
if (isset($_GET["selectable"]))				{$selectable=$_GET["selectable"];}
	elseif (isset($_POST["selectable"]))		{$selectable=$_POST["selectable"];}
if (isset($_GET["HKstatus"]))				{$HKstatus=$_GET["HKstatus"];}
	elseif (isset($_POST["HKstatus"]))		{$HKstatus=$_POST["HKstatus"];}
if (isset($_GET["force_logout"]))				{$force_logout=$_GET["force_logout"];}
	elseif (isset($_POST["force_logout"]))		{$force_logout=$_POST["force_logout"];}
if (isset($_GET["phone_login"]))				{$phone_login=$_GET["phone_login"];}
	elseif (isset($_POST["phone_login"]))		{$phone_login=$_POST["phone_login"];}
if (isset($_GET["phone_pass"]))				{$phone_pass=$_GET["phone_pass"];}
	elseif (isset($_POST["phone_pass"]))		{$phone_pass=$_POST["phone_pass"];}
if (isset($_GET["delete_users"]))				{$delete_users=$_GET["delete_users"];}
	elseif (isset($_POST["delete_users"]))		{$delete_users=$_POST["delete_users"];}
if (isset($_GET["delete_user_groups"]))				{$delete_user_groups=$_GET["delete_user_groups"];}
	elseif (isset($_POST["delete_user_groups"]))		{$delete_user_groups=$_POST["delete_user_groups"];}
if (isset($_GET["delete_lists"]))				{$delete_lists=$_GET["delete_lists"];}
	elseif (isset($_POST["delete_lists"]))		{$delete_lists=$_POST["delete_lists"];}
if (isset($_GET["delete_campaigns"]))				{$delete_campaigns=$_GET["delete_campaigns"];}
	elseif (isset($_POST["delete_campaigns"]))		{$delete_campaigns=$_POST["delete_campaigns"];}
if (isset($_GET["delete_ingroups"]))				{$delete_ingroups=$_GET["delete_ingroups"];}
	elseif (isset($_POST["delete_ingroups"]))		{$delete_ingroups=$_POST["delete_ingroups"];}
if (isset($_GET["delete_remote_agents"]))				{$delete_remote_agents=$_GET["delete_remote_agents"];}
	elseif (isset($_POST["delete_remote_agents"]))		{$delete_remote_agents=$_POST["delete_remote_agents"];}
if (isset($_GET["load_leads"]))				{$load_leads=$_GET["load_leads"];}
	elseif (isset($_POST["load_leads"]))		{$load_leads=$_POST["load_leads"];}
if (isset($_GET["campaign_detail"]))				{$campaign_detail=$_GET["campaign_detail"];}
	elseif (isset($_POST["campaign_detail"]))		{$campaign_detail=$_POST["campaign_detail"];}
if (isset($_GET["ast_admin_access"]))				{$ast_admin_access=$_GET["ast_admin_access"];}
	elseif (isset($_POST["ast_admin_access"]))		{$ast_admin_access=$_POST["ast_admin_access"];}
if (isset($_GET["ast_delete_phones"]))				{$ast_delete_phones=$_GET["ast_delete_phones"];}
	elseif (isset($_POST["ast_delete_phones"]))		{$ast_delete_phones=$_POST["ast_delete_phones"];}
if (isset($_GET["CoNfIrM"]))				{$CoNfIrM=$_GET["CoNfIrM"];}
	elseif (isset($_POST["CoNfIrM"]))		{$CoNfIrM=$_POST["CoNfIrM"];}
if (isset($_GET["delete_scripts"]))				{$delete_scripts=$_GET["delete_scripts"];}
	elseif (isset($_POST["delete_scripts"]))		{$delete_scripts=$_POST["delete_scripts"];}
if (isset($_GET["script_id"]))				{$script_id=$_GET["script_id"];}
	elseif (isset($_POST["script_id"]))		{$script_id=$_POST["script_id"];}
if (isset($_GET["script_name"]))				{$script_name=$_GET["script_name"];}
	elseif (isset($_POST["script_name"]))		{$script_name=$_POST["script_name"];}
if (isset($_GET["script_comments"]))				{$script_comments=$_GET["script_comments"];}
	elseif (isset($_POST["script_comments"]))		{$script_comments=$_POST["script_comments"];}
if (isset($_GET["script_text"]))				{$script_text=$_GET["script_text"];}
	elseif (isset($_POST["script_text"]))		{$script_text=$_POST["script_text"];}
if (isset($_GET["reset_hopper"]))				{$reset_hopper=$_GET["reset_hopper"];}
	elseif (isset($_POST["reset_hopper"]))		{$reset_hopper=$_POST["reset_hopper"];}
if (isset($_GET["get_call_launch"]))				{$get_call_launch=$_GET["get_call_launch"];}
	elseif (isset($_POST["get_call_launch"]))		{$get_call_launch=$_POST["get_call_launch"];}
if (isset($_GET["am_message_exten"]))				{$am_message_exten=$_GET["am_message_exten"];}
	elseif (isset($_POST["am_message_exten"]))		{$am_message_exten=$_POST["am_message_exten"];}
if (isset($_GET["amd_send_to_vmx"]))				{$amd_send_to_vmx=$_GET["amd_send_to_vmx"];}
	elseif (isset($_POST["amd_send_to_vmx"]))		{$amd_send_to_vmx=$_POST["amd_send_to_vmx"];}
if (isset($_GET["xferconf_a_dtmf"]))				{$xferconf_a_dtmf=$_GET["xferconf_a_dtmf"];}
	elseif (isset($_POST["xferconf_a_dtmf"]))		{$xferconf_a_dtmf=$_POST["xferconf_a_dtmf"];}
if (isset($_GET["xferconf_a_number"]))				{$xferconf_a_number=$_GET["xferconf_a_number"];}
	elseif (isset($_POST["xferconf_a_number"]))		{$xferconf_a_number=$_POST["xferconf_a_number"];}
if (isset($_GET["xferconf_b_dtmf"]))				{$xferconf_b_dtmf=$_GET["xferconf_b_dtmf"];}
	elseif (isset($_POST["xferconf_b_dtmf"]))		{$xferconf_b_dtmf=$_POST["xferconf_b_dtmf"];}
if (isset($_GET["xferconf_b_number"]))				{$xferconf_b_number=$_GET["xferconf_b_number"];}
	elseif (isset($_POST["xferconf_b_number"]))		{$xferconf_b_number=$_POST["xferconf_b_number"];}
if (isset($_GET["modify_leads"]))				{$modify_leads=$_GET["modify_leads"];}
	elseif (isset($_POST["modify_leads"]))		{$modify_leads=$_POST["modify_leads"];}
if (isset($_GET["hotkeys_active"]))				{$hotkeys_active=$_GET["hotkeys_active"];}
	elseif (isset($_POST["hotkeys_active"]))		{$hotkeys_active=$_POST["hotkeys_active"];}
if (isset($_GET["change_agent_campaign"]))				{$change_agent_campaign=$_GET["change_agent_campaign"];}
	elseif (isset($_POST["change_agent_campaign"]))		{$change_agent_campaign=$_POST["change_agent_campaign"];}
if (isset($_GET["agent_choose_ingroups"]))				{$agent_choose_ingroups=$_GET["agent_choose_ingroups"];}
	elseif (isset($_POST["agent_choose_ingroups"]))		{$agent_choose_ingroups=$_POST["agent_choose_ingroups"];}
if (isset($_GET["alt_number_dialing"]))				{$alt_number_dialing=$_GET["alt_number_dialing"];}
	elseif (isset($_POST["alt_number_dialing"]))		{$alt_number_dialing=$_POST["alt_number_dialing"];}
if (isset($_GET["scheduled_callbacks"]))				{$scheduled_callbacks=$_GET["scheduled_callbacks"];}
	elseif (isset($_POST["scheduled_callbacks"]))		{$scheduled_callbacks=$_POST["scheduled_callbacks"];}
if (isset($_GET["lead_filter_id"]))				{$lead_filter_id=$_GET["lead_filter_id"];}
	elseif (isset($_POST["lead_filter_id"]))		{$lead_filter_id=$_POST["lead_filter_id"];}
if (isset($_GET["lead_filter_name"]))				{$lead_filter_name=$_GET["lead_filter_name"];}
	elseif (isset($_POST["lead_filter_name"]))		{$lead_filter_name=$_POST["lead_filter_name"];}
if (isset($_GET["lead_filter_comments"]))				{$lead_filter_comments=$_GET["lead_filter_comments"];}
	elseif (isset($_POST["lead_filter_comments"]))		{$lead_filter_comments=$_POST["lead_filter_comments"];}
if (isset($_GET["lead_filter_sql"]))				{$lead_filter_sql=$_GET["lead_filter_sql"];}
	elseif (isset($_POST["lead_filter_sql"]))		{$lead_filter_sql=$_POST["lead_filter_sql"];}
if (isset($_GET["agentonly_callbacks"]))				{$agentonly_callbacks=$_GET["agentonly_callbacks"];}
	elseif (isset($_POST["agentonly_callbacks"]))		{$agentonly_callbacks=$_POST["agentonly_callbacks"];}
if (isset($_GET["agentcall_manual"]))				{$agentcall_manual=$_GET["agentcall_manual"];}
	elseif (isset($_POST["agentcall_manual"]))		{$agentcall_manual=$_POST["agentcall_manual"];}
if (isset($_GET["vicidial_recording"]))				{$vicidial_recording=$_GET["vicidial_recording"];}
	elseif (isset($_POST["vicidial_recording"]))		{$vicidial_recording=$_POST["vicidial_recording"];}
if (isset($_GET["vicidial_transfers"]))				{$vicidial_transfers=$_GET["vicidial_transfers"];}
	elseif (isset($_POST["vicidial_transfers"]))		{$vicidial_transfers=$_POST["vicidial_transfers"];}
if (isset($_GET["delete_filters"]))				{$delete_filters=$_GET["delete_filters"];}
	elseif (isset($_POST["delete_filters"]))		{$delete_filters=$_POST["delete_filters"];}
if (isset($_GET["alter_agent_interface_options"]))	{$alter_agent_interface_options=$_GET["alter_agent_interface_options"];}
	elseif (isset($_POST["alter_agent_interface_options"]))		{$alter_agent_interface_options=$_POST["alter_agent_interface_options"];}
if (isset($_GET["closer_default_blended"]))				{$closer_default_blended=$_GET["closer_default_blended"];}
	elseif (isset($_POST["closer_default_blended"]))	{$closer_default_blended=$_POST["closer_default_blended"];}
if (isset($_GET["drop_call_seconds"]))			{$drop_call_seconds=$_GET["drop_call_seconds"];}
	elseif (isset($_POST["drop_call_seconds"]))	{$drop_call_seconds=$_POST["drop_call_seconds"];}
if (isset($_GET["safe_harbor_message"]))			{$safe_harbor_message=$_GET["safe_harbor_message"];}
	elseif (isset($_POST["safe_harbor_message"]))	{$safe_harbor_message=$_POST["safe_harbor_message"];}
if (isset($_GET["safe_harbor_exten"]))				{$safe_harbor_exten=$_GET["safe_harbor_exten"];}
	elseif (isset($_POST["safe_harbor_exten"]))		{$safe_harbor_exten=$_POST["safe_harbor_exten"];}
if (isset($_GET["drop_message"]))					{$drop_message=$_GET["drop_message"];}
	elseif (isset($_POST["drop_message"]))			{$drop_message=$_POST["drop_message"];}
if (isset($_GET["drop_exten"]))						{$drop_exten=$_GET["drop_exten"];}
	elseif (isset($_POST["drop_exten"]))			{$drop_exten=$_POST["drop_exten"];}
if (isset($_GET["call_time_id"]))					{$call_time_id=$_GET["call_time_id"];}
	elseif (isset($_POST["call_time_id"]))			{$call_time_id=$_POST["call_time_id"];}
if (isset($_GET["call_time_name"]))					{$call_time_name=$_GET["call_time_name"];}
	elseif (isset($_POST["call_time_name"]))		{$call_time_name=$_POST["call_time_name"];}
if (isset($_GET["call_time_comments"]))				{$call_time_comments=$_GET["call_time_comments"];}
	elseif (isset($_POST["call_time_comments"]))	{$call_time_comments=$_POST["call_time_comments"];}
if (isset($_GET["ct_default_start"]))				{$ct_default_start=$_GET["ct_default_start"];}
	elseif (isset($_POST["ct_default_start"]))		{$ct_default_start=$_POST["ct_default_start"];}
if (isset($_GET["ct_default_stop"]))				{$ct_default_stop=$_GET["ct_default_stop"];}
	elseif (isset($_POST["ct_default_stop"]))		{$ct_default_stop=$_POST["ct_default_stop"];}
if (isset($_GET["ct_sunday_start"]))				{$ct_sunday_start=$_GET["ct_sunday_start"];}
	elseif (isset($_POST["ct_sunday_start"]))		{$ct_sunday_start=$_POST["ct_sunday_start"];}
if (isset($_GET["ct_sunday_stop"]))					{$ct_sunday_stop=$_GET["ct_sunday_stop"];}
	elseif (isset($_POST["ct_sunday_stop"]))		{$ct_sunday_stop=$_POST["ct_sunday_stop"];}
if (isset($_GET["ct_monday_start"]))				{$ct_monday_start=$_GET["ct_monday_start"];}
	elseif (isset($_POST["ct_monday_start"]))		{$ct_monday_start=$_POST["ct_monday_start"];}
if (isset($_GET["ct_monday_stop"]))					{$ct_monday_stop=$_GET["ct_monday_stop"];}
	elseif (isset($_POST["ct_monday_stop"]))		{$ct_monday_stop=$_POST["ct_monday_stop"];}
if (isset($_GET["ct_tuesday_start"]))				{$ct_tuesday_start=$_GET["ct_tuesday_start"];}
	elseif (isset($_POST["ct_tuesday_start"]))		{$ct_tuesday_start=$_POST["ct_tuesday_start"];}
if (isset($_GET["ct_tuesday_stop"]))				{$ct_tuesday_stop=$_GET["ct_tuesday_stop"];}
	elseif (isset($_POST["ct_tuesday_stop"]))		{$ct_tuesday_stop=$_POST["ct_tuesday_stop"];}
if (isset($_GET["ct_wednesday_start"]))				{$ct_wednesday_start=$_GET["ct_wednesday_start"];}
	elseif (isset($_POST["ct_wednesday_start"]))	{$ct_wednesday_start=$_POST["ct_wednesday_start"];}
if (isset($_GET["ct_wednesday_stop"]))				{$ct_wednesday_stop=$_GET["ct_wednesday_stop"];}
	elseif (isset($_POST["ct_wednesday_stop"]))		{$ct_wednesday_stop=$_POST["ct_wednesday_stop"];}
if (isset($_GET["ct_thursday_start"]))				{$ct_thursday_start=$_GET["ct_thursday_start"];}
	elseif (isset($_POST["ct_thursday_start"]))		{$ct_thursday_start=$_POST["ct_thursday_start"];}
if (isset($_GET["ct_thursday_stop"]))				{$ct_thursday_stop=$_GET["ct_thursday_stop"];}
	elseif (isset($_POST["ct_thursday_stop"]))		{$ct_thursday_stop=$_POST["ct_thursday_stop"];}
if (isset($_GET["ct_friday_start"]))				{$ct_friday_start=$_GET["ct_friday_start"];}
	elseif (isset($_POST["ct_friday_start"]))		{$ct_friday_start=$_POST["ct_friday_start"];}
if (isset($_GET["ct_friday_stop"]))					{$ct_friday_stop=$_GET["ct_friday_stop"];}
	elseif (isset($_POST["ct_friday_stop"]))		{$ct_friday_stop=$_POST["ct_friday_stop"];}
if (isset($_GET["ct_saturday_start"]))				{$ct_saturday_start=$_GET["ct_saturday_start"];}
	elseif (isset($_POST["ct_saturday_start"]))		{$ct_saturday_start=$_POST["ct_saturday_start"];}
if (isset($_GET["ct_saturday_stop"]))				{$ct_saturday_stop=$_GET["ct_saturday_stop"];}
	elseif (isset($_POST["ct_saturday_stop"]))		{$ct_saturday_stop=$_POST["ct_saturday_stop"];}
if (isset($_GET["state_call_time_state"]))			{$state_call_time_state=$_GET["state_call_time_state"];}
	elseif (isset($_POST["state_call_time_state"]))	{$state_call_time_state=$_POST["state_call_time_state"];}
if (isset($_GET["state_rule"]))						{$state_rule=$_GET["state_rule"];}
	elseif (isset($_POST["state_rule"]))			{$state_rule=$_POST["state_rule"];}
if (isset($_GET["delete_call_times"]))				{$delete_call_times=$_GET["delete_call_times"];}
	elseif (isset($_POST["delete_call_times"]))		{$delete_call_times=$_POST["delete_call_times"];}
if (isset($_GET["modify_call_times"]))				{$modify_call_times=$_GET["modify_call_times"];}
	elseif (isset($_POST["modify_call_times"]))		{$modify_call_times=$_POST["modify_call_times"];}
if (isset($_GET["wrapup_seconds"]))					{$wrapup_seconds=$_GET["wrapup_seconds"];}
	elseif (isset($_POST["wrapup_seconds"]))		{$wrapup_seconds=$_POST["wrapup_seconds"];}
if (isset($_GET["wrapup_message"]))					{$wrapup_message=$_GET["wrapup_message"];}
	elseif (isset($_POST["wrapup_message"]))		{$wrapup_message=$_POST["wrapup_message"];}
if (isset($_GET["phone_number"]))					{$phone_number=$_GET["phone_number"];}
	elseif (isset($_POST["phone_number"]))			{$phone_number=$_POST["phone_number"];}
if (isset($_GET["use_internal_dnc"]))				{$use_internal_dnc=$_GET["use_internal_dnc"];}
	elseif (isset($_POST["use_internal_dnc"]))		{$use_internal_dnc=$_POST["use_internal_dnc"];}
if (isset($_GET["attempt_delay"]))					{$attempt_delay=$_GET["attempt_delay"];}
	elseif (isset($_POST["attempt_delay"]))			{$attempt_delay=$_POST["attempt_delay"];}
if (isset($_GET["attempt_maximum"]))				{$attempt_maximum=$_GET["attempt_maximum"];}
	elseif (isset($_POST["attempt_maximum"]))		{$attempt_maximum=$_POST["attempt_maximum"];}

	if (isset($script_id)) {$script_id= strtoupper($script_id);}
	if (isset($lead_filter_id)) {$lead_filter_id = strtoupper($lead_filter_id);}

##### BEGIN VARIABLE FILTERING FOR SECURITY #####

### DIGITS ONLY ###
$user_level = ereg_replace("[^0-9]","",$user_level);
$wrapup_seconds = ereg_replace("[^0-9]","",$wrapup_seconds);
$xferconf_a_number = ereg_replace("[^0-9]","",$xferconf_a_number);
$xferconf_b_number = ereg_replace("[^0-9]","",$xferconf_b_number);
$drop_call_seconds = ereg_replace("[^0-9]","",$drop_call_seconds);
$voicemail_ext = ereg_replace("[^0-9]","",$voicemail_ext);
$safe_harbor_exten = ereg_replace("[^0-9]","",$safe_harbor_exten);
$am_message_exten = ereg_replace("[^0-9]","",$am_message_exten);
$campaign_rec_exten = ereg_replace("[^0-9]","",$campaign_rec_exten);
$campaign_vdad_exten = ereg_replace("[^0-9]","",$campaign_vdad_exten);
$drop_exten = ereg_replace("[^0-9]","",$drop_exten);
$dial_timeout = ereg_replace("[^0-9]","",$dial_timeout);
$park_ext = ereg_replace("[^0-9]","",$park_ext);
$hopper_level = ereg_replace("[^0-9]","",$hopper_level);
$agent_choose_ingroups = ereg_replace("[^0-9]","",$agent_choose_ingroups);
$hotkeys_active = ereg_replace("[^0-9]","",$hotkeys_active);
$agentonly_callbacks = ereg_replace("[^0-9]","",$agentonly_callbacks);
$agentcall_manual = ereg_replace("[^0-9]","",$agentcall_manual);
$vicidial_recording = ereg_replace("[^0-9]","",$vicidial_recording);
$vicidial_transfers = ereg_replace("[^0-9]","",$vicidial_transfers);
$closer_default_blended = ereg_replace("[^0-9]","",$closer_default_blended);
$alter_agent_interface_options = ereg_replace("[^0-9]","",$alter_agent_interface_options);
$delete_users = ereg_replace("[^0-9]","",$delete_users);
$delete_user_groups = ereg_replace("[^0-9]","",$delete_user_groups);
$delete_scripts = ereg_replace("[^0-9]","",$delete_scripts);
$delete_remote_agents = ereg_replace("[^0-9]","",$delete_remote_agents);
$delete_lists = ereg_replace("[^0-9]","",$delete_lists);
$delete_ingroups = ereg_replace("[^0-9]","",$delete_ingroups);
$delete_filters = ereg_replace("[^0-9]","",$delete_filters);
$delete_campaigns = ereg_replace("[^0-9]","",$delete_campaigns);
$delete_call_times = ereg_replace("[^0-9]","",$delete_call_times);
$load_leads = ereg_replace("[^0-9]","",$delete_call_times);
$campaign_detail = ereg_replace("[^0-9]","",$campaign_detail);
$ast_delete_phones = ereg_replace("[^0-9]","",$ast_delete_phones);
$ast_admin_access = ereg_replace("[^0-9]","",$ast_admin_access);
$modify_leads = ereg_replace("[^0-9]","",$modify_leads);
$change_agent_campaign = ereg_replace("[^0-9]","",$change_agent_campaign);
$modify_call_times = ereg_replace("[^0-9]","",$modify_call_times);
$ct_wednesday_stop = ereg_replace("[^0-9]","",$ct_wednesday_stop);
$ct_wednesday_start = ereg_replace("[^0-9]","",$ct_wednesday_start);
$ct_tuesday_stop = ereg_replace("[^0-9]","",$ct_tuesday_stop);
$ct_tuesday_start = ereg_replace("[^0-9]","",$ct_tuesday_start);
$ct_thursday_stop = ereg_replace("[^0-9]","",$ct_thursday_stop);
$ct_thursday_start = ereg_replace("[^0-9]","",$ct_thursday_start);
$ct_sunday_stop = ereg_replace("[^0-9]","",$ct_sunday_stop);
$ct_sunday_start = ereg_replace("[^0-9]","",$ct_sunday_start);
$ct_saturday_stop = ereg_replace("[^0-9]","",$ct_saturday_stop);
$ct_saturday_start = ereg_replace("[^0-9]","",$ct_saturday_start);
$ct_monday_stop = ereg_replace("[^0-9]","",$ct_monday_stop);
$ct_monday_start = ereg_replace("[^0-9]","",$ct_monday_start);
$ct_friday_stop = ereg_replace("[^0-9]","",$ct_friday_stop);
$ct_friday_start = ereg_replace("[^0-9]","",$ct_friday_start);
$ct_default_stop = ereg_replace("[^0-9]","",$ct_default_stop);
$ct_default_start = ereg_replace("[^0-9]","",$ct_default_start);
$number_of_lines = ereg_replace("[^0-9]","",$number_of_lines);
$user_start = ereg_replace("[^0-9]","",$user_start);
$phone_number = ereg_replace("[^0-9]","",$phone_number);
$remote_agent_id = ereg_replace("[^0-9]","",$remote_agent_id);
$conf_exten = ereg_replace("[^0-9]","",$conf_exten);
$attempt_maximum = ereg_replace("[^0-9]","",$attempt_maximum);
$attempt_delay = ereg_replace("[^0-9]","",$attempt_delay);
$hotkey = ereg_replace("[^0-9]","",$hotkey);
$list_id = ereg_replace("[^0-9]","",$list_id);

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

### ALPHA-NUMERIC ONLY ###
$user = ereg_replace("[^0-9a-zA-Z]","",$user);
$pass = ereg_replace("[^0-9a-zA-Z]","",$pass);
$PHP_AUTH_USER = ereg_replace("[^0-9a-zA-Z]","",$PHP_AUTH_USER);
$PHP_AUTH_PW = ereg_replace("[^0-9a-zA-Z]","",$PHP_AUTH_PW);
$script_id = ereg_replace("[^0-9a-zA-Z]","",$script_id);
$submit = ereg_replace("[^0-9a-zA-Z]","",$submit);
$CoNfIrM = ereg_replace("[^0-9a-zA-Z]","",$CoNfIrM);
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

### DIGITS and spaces and hash and star and comma
$xferconf_a_dtmf = ereg_replace("[^ \,\*\#0-9]","",$xferconf_a_dtmf);
$xferconf_b_dtmf = ereg_replace("[^ \,\*\#0-9]","",$xferconf_b_dtmf);

### ALPHA-NUMERIC and underscore and dash
$dial_status_e = ereg_replace("[^-\_0-9a-zA-Z]","",$dial_status_e);
$dial_status_d = ereg_replace("[^-\_0-9a-zA-Z]","",$dial_status_d);
$dial_status_c = ereg_replace("[^-\_0-9a-zA-Z]","",$dial_status_c);
$dial_status_b = ereg_replace("[^-\_0-9a-zA-Z]","",$dial_status_b);
$dial_status_a = ereg_replace("[^-\_0-9a-zA-Z]","",$dial_status_a);
$stage = ereg_replace("[^-\_0-9a-zA-Z]","",$stage);
$lead_filter_id = ereg_replace("[^-\_0-9a-zA-Z]","",$lead_filter_id);
$campaign_id = ereg_replace("[^-\_0-9a-zA-Z]","",$campaign_id);
$old_campaign_id = ereg_replace("[^-\_0-9a-zA-Z]","",$old_campaign_id);
$park_file_name = ereg_replace("[^-\_0-9a-zA-Z]","",$park_file_name);
$next_agent_call = ereg_replace("[^-\_0-9a-zA-Z]","",$next_agent_call);
$local_call_time = ereg_replace("[^-\_0-9a-zA-Z]","",$local_call_time);
$call_time_id = ereg_replace("[^-\_0-9a-zA-Z]","",$call_time_id);
$phone_pass = ereg_replace("[^-\_0-9a-zA-Z]","",$phone_pass);
$phone_login = ereg_replace("[^-\_0-9a-zA-Z]","",$phone_login);
$group_id = ereg_replace("[^-\_0-9a-zA-Z]","",$group_id);
$user_group = ereg_replace("[^-\_0-9a-zA-Z]","",$user_group);
$OLDuser_group = ereg_replace("[^-\_0-9a-zA-Z]","",$OLDuser_group);
$state_rule = ereg_replace("[^-\_0-9a-zA-Z]","",$state_rule);

### ALPHA-NUMERIC and spaces
$lead_order = ereg_replace("[^ 0-9a-zA-Z]","",$lead_order);
### ALPHA-NUMERIC and hash
$group_color = ereg_replace("[^\#0-9a-zA-Z]","",$group_color);

### ALPHA-NUMERIC and spaces dots, commas, dashes, underscores
$group_name = ereg_replace("[^ \.\,-\_0-9a-zA-Z]","",$group_name);
$campaign_name = ereg_replace("[^ \.\,-\_0-9a-zA-Z]","",$campaign_name);
$full_name = ereg_replace("[^ \.\,-\_0-9a-zA-Z]","",$full_name);
$wrapup_message = ereg_replace("[^ \.\,-\_0-9a-zA-Z]","",$wrapup_message);
$status = ereg_replace("[^ \.\,-\_0-9a-zA-Z]","",$status);
$HKstatus = ereg_replace("[^ \.\,-\_0-9a-zA-Z]","",$HKstatus);
$status_name = ereg_replace("[^ \.\,-\_0-9a-zA-Z]","",$status_name);
$script_name = ereg_replace("[^ \.\,-\_0-9a-zA-Z]","",$script_name);
$script_comments = ereg_replace("[^ \.\,-\_0-9a-zA-Z]","",$script_comments);
$list_name = ereg_replace("[^ \.\,-\_0-9a-zA-Z]","",$list_name);
$lead_filter_name = ereg_replace("[^ \.\,-\_0-9a-zA-Z]","",$lead_filter_name);
$lead_filter_comments = ereg_replace("[^ \.\,-\_0-9a-zA-Z]","",$lead_filter_comments);
$campaign_rec_filename = ereg_replace("[^ \.\,-\_0-9a-zA-Z]","",$campaign_rec_filename);
$call_time_name = ereg_replace("[^ \.\,-\_0-9a-zA-Z]","",$call_time_name);
$call_time_comments = ereg_replace("[^ \.\,-\_0-9a-zA-Z]","",$call_time_comments);

### remove semi-colons ###
$lead_filter_sql = ereg_replace(";","",$lead_filter_sql);

### VARIABLES TO BE mysql_real_escape_string ###
# $web_form_address
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
# 60623-1159 - Fixed Scheduled Callbacks over-filtering bug
#

# make sure you have added a user to the vicidial_users MySQL table with at least user_level 8 to access this page the first time

$version = '1.1.12-3';
$build = '60623-1159';

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
			$stmt="SELECT * from vicidial_users where user='$PHP_AUTH_USER' and pass='$PHP_AUTH_PW'";
			$rslt=mysql_query($stmt, $link);
			$row=mysql_fetch_row($rslt);
			$LOGfullname				=$row[3];
			$LOGuser_level				=$row[4];
			$LOGdelete_users			=$row[8];
			$LOGdelete_user_groups		=$row[9];
			$LOGdelete_lists			=$row[10];
			$LOGdelete_campaigns		=$row[11];
			$LOGdelete_ingroups			=$row[12];
			$LOGdelete_remote_agents	=$row[13];
			$LOGload_leads				=$row[14];
			$LOGcampaign_detail			=$row[15];
			$LOGdelete_scripts			=$row[18];
			$LOGdelete_filters			=$row[29];
			$LOGalter_agent_interface	=$row[30];
			$LOGdelete_call_times		=$row[32];
			$LOGmodify_call_times		=$row[33];

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
if ($ADD==3)			{$hh='users';		echo "Ändern Sie Benutzer";}
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
if ($ADD==5)			{$hh='users';		echo "Delete User";}
if ($ADD==51)			{$hh='campaigns';	echo "Delete Kampagne";}
if ($ADD==52)			{$hh='campaigns';	echo "Logout-Mittel";}
if ($ADD==511)			{$hh='lists';		echo "Delete List";}
if ($ADD==5111)			{$hh='ingroups';	echo "Delete In-Group";}
if ($ADD==51111)		{$hh='remoteagent';	echo "Löschung-Direktübertragung Mittel";}
if ($ADD==511111)		{$hh='usergroups';	echo "Löschung-Benutzer Group";}
if ($ADD==5111111)		{$hh='scripts';		echo "Löschung-Index";}
if ($ADD==51111111)		{$hh='filters';		echo "Löschung-Filter";}
if ($ADD==511111111)	{$hh='times';		echo "Lösche Anrufzeit";}
if ($ADD==5111111111)	{$hh='times';		echo "Lösche landesspezifische Anrufzeit";}
if ($ADD==6)			{$hh='users';		echo "Delete User";}
if ($ADD==61)			{$hh='campaigns';	echo "Delete Kampagne";}
if ($ADD==62)			{$hh='campaigns';	echo "Logout-Mittel";}
if ($ADD==65)			{$hh='campaigns';	echo "Löschung-Leitung Bereiten Auf";}
if ($ADD==611)			{$hh='lists';		echo "Delete List";}
if ($ADD==6111)			{$hh='ingroups';	echo "Delete In-Group";}
if ($ADD==61111)		{$hh='remoteagent';	echo "Löschung-Direktübertragung Mittel";}
if ($ADD==611111)		{$hh='usergroups';	echo "Löschung-Benutzer Group";}
if ($ADD==6111111)		{$hh='scripts';		echo "Löschung-Index";}
if ($ADD==61111111)		{$hh='filters';		echo "Löschung-Filter";}
if ($ADD==611111111)	{$hh='times';		echo "Lösche Anrufzeit";}
if ($ADD==6111111111)	{$hh='times';		echo "Lösche landesspezifische Anrufzeit";}
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
if ($ADD==55)			{$hh='users';		echo "Suchform";}
if ($ADD==66)			{$hh='users';		echo "Suchresultate";}
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

if ( ( (strlen($ADD)>4) && ($ADD < 99998) ) or ($ADD==3) or ($ADD==21) or ($ADD==31) or ($ADD==41) or ($ADD=="4A")  or ($ADD=="4B") )
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

	##### get inbound groups listing for checkboxes
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

<B><FONT SIZE=3>VICIDIAL_KAMPAGNENTABELLE</FONT></B><BR><BR>
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
<A NAME="vicidial_campaigns-auto_dial_level">
<BR>
<B>Selbstvorwahlknopf-Niveau -</B> Dieses ist, wohin Sie einstellen,wieviele VICIDIAL sollte pro Mittel 0 verwenden des aktiven Mittelsnull zeichnet, Automobil, daswählen aus ist und die Mittel klicken,um jede Nummer zu wählen. Andernfalls hält VICIDIALWählverbindungen gleich den aktiven Mitteln, die mit demVorwahlknopfniveau multipliziert werden, um zu, wievielen Linien zukommen diese Kampagne auf jedem Bediener erlauben sollte.

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
<A NAME="vicidial_campaigns-campaign_cid">
<BR>
<B>Kampagne CallerID -</B> This field allows for the sending of a custom callerid number on the outbound calls. This is the number that would show up on the callerid of the person you are calling. The default is UNKNOWN. If you are using T1 or E1s to dial out this option is only available if you are using PRIs - ISDN T1s or E1s - that have the custom callerid feature turned on, this will not work with Robbed-bit service(RBS) circuits. This will also work through most VOIP(SIP or IAX trunks) providers that allow dynamic outbound callerID. The custom callerID only applies to calls placed for the VICIDIAL campaign directly, any 3rd party calls or transfers will not send the custom callerID. NOTE: Sometimes putting UNKNOWN or PRIVATE in the field will yield the sending of your default callerID number by your carrier with the calls. You may want to test this and put 0000000000 in the callerid field instead if you do not want to send you CallerID.

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
<B>Kampagne Aufnahme -</B> Dieses Menü erlaubt Ihnen, zu wählen,welches Niveau der Aufnahme auf dieser Kampagne erlaubt wird. NIEsperrt Aufnahme auf dem Klienten. ONDEMAND ist die Rückstellung underlaubt dem Vertreter zu notieren zu beginnen und, zu stoppen, wiegebraucht. ALLCALLS beginnt Aufnahme auf dem Klienten, wann immer einAnruf zu einem Mittel geschickt wird.

<BR>
<A NAME="vicidial_campaigns-campaign_rec_filename">
<BR>
<B>Kampagne Rec Dateiname -</B> Dieses fangen erlaubt Ihnen, denNamen der Aufnahme besonders anzufertigen auf, wenn Kampagne AufnahmeONDEMAND oder ALLCALLS ist. Die erlaubten Variablen sind KAMPAGNECUSTPHONE FULLDATE TINYDATE EPOCHE-MITTEL. Die Rückstellung istFULLDATE_MITTELund würde wie dieses 20051020-103108_6666 aussehen.Ein anderes Beispiel ist CAMPAIGN_TINYDATE_CUSTPHONE, das wie diesesTESTCAMP_51020103108_3125551212 aussehen würde. 50 char max.

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
<B>Xfer-Conf DTMF -</B> Diese vier fängt dürfen auf, damit Siezwei Sätze Übergangskonferenz und DTMF Voreinstellungen haben. Wennder Anruf oder die Kampagne geladen wird, stellt der vicidial.phpIndex dar, daß zwei Tasten auf dem Bringenkonferenz Rahmen und denZahl-zu-Vorwahlknopf und senden-dtmf Automobil-zu bevölkernauffängt, wenn sie betätigt werden.

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
<B>Gewährte Inbound Gruppen -</B> For CLOSER campaigns only. Here is where you select the inbound groups you want agents in this CLOSER campaign to be able to take calls from. It is important for BLENDED inbound/outbound campaigns only to select the inbound groups that are used for agents in this campaign. The calls coming into the inbound groups selected here will be counted as active calls for a blended campaign even if all agents in the campaign are not logged in to receive calls from all of those selected inbound groups.



<BR><BR><BR><BR>

<B><FONT SIZE=3>VICIDIAL_LISTENTABELLE</FONT></B><BR><BR>
<A NAME="vicidial_lists-list_id">
<BR>
<B>Liste Identifikation -</B> Dieses ist der numerische Name der Liste,es ist nicht editable nach Ausgangsunterordnung, muß nur Zahlenenthalten und muß zwischen 2 und 8 Buchstaben lang sein.

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
<B>Xfer-Conf DTMF -</B> Diese vier fängt dürfen auf, damit Siezwei Sätze Übergangskonferenz und DTMF Voreinstellungen haben. Wennder Anruf oder die Kampagne geladen wird, stellt der vicidial.phpIndex dar, daß zwei Tasten auf dem Bringenkonferenz Rahmen und denZahl-zu-Vorwahlknopf und senden-dtmf Automobil-zu bevölkernauffängt, wenn sie betätigt werden.

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
<B>Index-Text -</B> This is where you place the content of a Vicidial Script. Minimum of 2 characters. You can have customer information be auto-populated in this script using "--A--field--B--" where field is one of the following fieldnames: vendor_lead_code, source_id, list_id, gmt_offset_now, called_since_last_reset, phone_code, phone_number, title, first_name, middle_initial, last_name, address1, address2, address3, city, state, province, postal_code, country_code, gender, date_of_birth, alt_phone, email, security_phrase, comments. For example, this sentence would print the persons name in it----<BR><BR>  Hello, can I speak with --A--first_name--B-- --A--last_name--B-- please? Well hello --A--title--B-- --A--last_name--B-- how are you today?<BR><BR> This would read----<BR><BR>Hello, can I speak with John Doe please? Well hello Mr. Doe how are you today?

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
$script_text = eregi_replace('--A--user--B--',"$RGuser",$script_text);
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
<TABLE WIDTH=650 BGCOLOR=#D9E6FE cellpadding=2 cellspacing=0><TR BGCOLOR=#015B91><TD ALIGN=LEFT COLSPAN=7><FONT FACE="ARIAL,HELVETICA" COLOR=WHITE SIZE=2><B> &nbsp; VICIDIAL ADMIN - <a href="<? echo $PHP_SELF ?>?force_logout=1"><FONT FACE="ARIAL,HELVETICA" COLOR=WHITE SIZE=1>Logout</a></TD><TD ALIGN=RIGHT COLSPAN=3><FONT FACE="ARIAL,HELVETICA" COLOR=WHITE SIZE=2><B><? echo date("l F j, Y G:i:s A") ?> &nbsp; </TD></TR>

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
<TD ALIGN=CENTER <?=$reports_hh?>><a href="server_stats.php"><FONT FACE="ARIAL,HELVETICA" COLOR=WHITE SIZE=1><B> REPORTS </a></TD>
</TR>


<? if (strlen($users_hh) > 1) { 
	?>
<TR BGCOLOR=#FFFF99><TD ALIGN=CENTER COLSPAN=10><FONT FACE="ARIAL,HELVETICA" COLOR=BLACK SIZE=1><B> &nbsp; <a href="<? echo $PHP_SELF ?>"><FONT FACE="ARIAL,HELVETICA" COLOR=BLACK SIZE=1>LISTE BENUTZER</a> &nbsp; &nbsp; | &nbsp; &nbsp; <a href="<? echo $PHP_SELF ?>?ADD=1"><FONT FACE="ARIAL,HELVETICA" COLOR=BLACK SIZE=1>ADDIEREN Sie Einen NEUEN BENUTZER</a> &nbsp; &nbsp; | &nbsp; &nbsp; <a href="<? echo $PHP_SELF ?>?ADD=55"><FONT FACE="ARIAL,HELVETICA" COLOR=BLACK SIZE=1>SUCHE NACH Einem BENUTZER</a></TD></TR>
<? } 
if (strlen($campaigns_hh) > 1) { 
	?>
<TR BGCOLOR=#FFCC99><TD ALIGN=CENTER COLSPAN=10><FONT FACE="ARIAL,HELVETICA" COLOR=BLACK SIZE=1><B> &nbsp; <a href="<? echo $PHP_SELF ?>?ADD=11"><FONT FACE="ARIAL,HELVETICA" COLOR=BLACK SIZE=1>ADDIEREN SIE KAMPAGNE</a> &nbsp; &nbsp; | &nbsp; &nbsp; <a href="<? echo $PHP_SELF ?>?ADD=10"><FONT FACE="ARIAL,HELVETICA" COLOR=BLACK SIZE=1>LISTE KAMPAGNEN</a></TD></TR>
<? } 
if (strlen($lists_hh) > 1) { 
	?>
<TR BGCOLOR=#FFCCCC><TD ALIGN=CENTER COLSPAN=10><FONT FACE="ARIAL,HELVETICA" COLOR=BLACK SIZE=1><B> &nbsp; <a href="<? echo $PHP_SELF ?>?ADD=100"><FONT FACE="ARIAL,HELVETICA" COLOR=BLACK SIZE=1>ZEIGEN SIE LISTEN</a> &nbsp; &nbsp; | &nbsp; &nbsp; <a href="<? echo $PHP_SELF ?>?ADD=111"><FONT FACE="ARIAL,HELVETICA" COLOR=BLACK SIZE=1>ADDIEREN SIE NEUE LISTE</a> &nbsp; &nbsp; | &nbsp; &nbsp; <a href="admin_search_lead.php"><FONT FACE="ARIAL,HELVETICA" COLOR=BLACK SIZE=1>SUCHE NACH Einer LEITUNG</a> | &nbsp; &nbsp; <a href="<? echo $PHP_SELF ?>?ADD=121"><FONT FACE="ARIAL,HELVETICA" COLOR=BLACK SIZE=1>FÜGEN SIE ZAHL DNC HINZU</a> &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; | &nbsp; &nbsp; <a href="./listloaderMAIN.php"><FONT FACE="ARIAL,HELVETICA" COLOR=BLACK SIZE=1>LAST NEUE LEITUNGEN</a></TD></TR>
<? } 
if (strlen($scripts_hh) > 1) { 
	?>
<TR BGCOLOR=#99FFCC><TD ALIGN=CENTER COLSPAN=10><FONT FACE="ARIAL,HELVETICA" COLOR=BLACK SIZE=1><B> &nbsp; <a href="<? echo $PHP_SELF ?>?ADD=1111111"><FONT FACE="ARIAL,HELVETICA" COLOR=BLACK SIZE=1>ADDIEREN SIE INDEX</a> &nbsp; &nbsp; | &nbsp; &nbsp; <a href="<? echo $PHP_SELF ?>?ADD=1000000"><FONT FACE="ARIAL,HELVETICA" COLOR=BLACK SIZE=1>ANSICHT-INDEXE</a></TD></TR>
<? } 
if (strlen($filters_hh) > 1) { 
	?>
<TR BGCOLOR=#CCCCCC><TD ALIGN=CENTER COLSPAN=10><FONT FACE="ARIAL,HELVETICA" COLOR=BLACK SIZE=1><B> &nbsp; <a href="<? echo $PHP_SELF ?>?ADD=11111111"><FONT FACE="ARIAL,HELVETICA" COLOR=BLACK SIZE=1>ADDIEREN SIE FILTER</a> &nbsp; &nbsp; | &nbsp; &nbsp; <a href="<? echo $PHP_SELF ?>?ADD=10000000"><FONT FACE="ARIAL,HELVETICA" COLOR=BLACK SIZE=1>ANSICHT-FILTER</a></TD></TR>
<? } 
if (strlen($ingroups_hh) > 1) { 
	?>
<TR BGCOLOR=#CC99FF><TD ALIGN=CENTER COLSPAN=10><FONT FACE="ARIAL,HELVETICA" COLOR=BLACK SIZE=1><B> &nbsp; <a href="<? echo $PHP_SELF ?>?ADD=1000"><FONT FACE="ARIAL,HELVETICA" COLOR=BLACK SIZE=1>ZEIGEN SIE IN-GROUPS</a> &nbsp; &nbsp; | &nbsp; &nbsp; <a href="<? echo $PHP_SELF ?>?ADD=1111"><FONT FACE="ARIAL,HELVETICA" COLOR=BLACK SIZE=1>ADDIEREN SIE NEUES IN-GROUP</a></TD></TR>
<? } 
if (strlen($times_hh) > 1) { 
	?>
<TR BGCOLOR=#99FF33><TD ALIGN=CENTER COLSPAN=10><FONT FACE="ARIAL,HELVETICA" COLOR=BLACK SIZE=1><B> &nbsp; <a href="<? echo $PHP_SELF ?>?ADD=100000000"><FONT FACE="ARIAL,HELVETICA" COLOR=BLACK SIZE=1>Zeige Anrufzeiten</a> &nbsp; &nbsp; | &nbsp; &nbsp; <a href="<? echo $PHP_SELF ?>?ADD=111111111"><FONT FACE="ARIAL,HELVETICA" COLOR=BLACK SIZE=1>Hinzufügen neuer Anrufzeiten</a> &nbsp; &nbsp; | &nbsp; &nbsp; <a href="<? echo $PHP_SELF ?>?ADD=1000000000"><FONT FACE="ARIAL,HELVETICA" COLOR=BLACK SIZE=1>Zeige landesspezifische Anrufzeiten</a> &nbsp; &nbsp; |  &nbsp; &nbsp; <a href="<? echo $PHP_SELF ?>?ADD=1111111111"><FONT FACE="ARIAL,HELVETICA" COLOR=BLACK SIZE=1>Hinzufügen neuer landesspezifischer Anrufzeiten</a> &nbsp; </TD></TR>
<? } 
if (strlen($usergroups_hh) > 1) { 
	?>
<TR BGCOLOR=#CCFFFF><TD ALIGN=CENTER COLSPAN=10><FONT FACE="ARIAL,HELVETICA" COLOR=BLACK SIZE=1><B> &nbsp; <a href="<? echo $PHP_SELF ?>?ADD=111111"><FONT FACE="ARIAL,HELVETICA" COLOR=BLACK SIZE=1>ADDIEREN SIE BENUTZER-GRUPPE</a> &nbsp; &nbsp; | &nbsp; &nbsp; <a href="<? echo $PHP_SELF ?>?ADD=100000"><FONT FACE="ARIAL,HELVETICA" COLOR=BLACK SIZE=1>LISTE BENUTZER-GRUPPEN</a> &nbsp; &nbsp; | &nbsp; &nbsp; <a href="group_hourly_stats.php"><FONT FACE="ARIAL,HELVETICA" COLOR=BLACK SIZE=1>GRUPPE STÜNDLICH</a></TD></TR>
<? } 
if (strlen($remoteagent_hh) > 1) { 
	?>
<TR BGCOLOR=#CCFFCC><TD ALIGN=CENTER COLSPAN=10><FONT FACE="ARIAL,HELVETICA" COLOR=BLACK SIZE=1><B> &nbsp; <a href="<? echo $PHP_SELF ?>?ADD=10000"><FONT FACE="ARIAL,HELVETICA" COLOR=BLACK SIZE=1>ZEIGEN SIE REMOTEMITTEL</a> &nbsp; &nbsp; | &nbsp; &nbsp; <a href="<? echo $PHP_SELF ?>?ADD=11111"><FONT FACE="ARIAL,HELVETICA" COLOR=BLACK SIZE=1>ADDIEREN SIE NEUE REMOTEMITTEL</a></TD></TR>
<? } 
if (strlen($reports_hh) > 1) { 
	?>
<TR BGCOLOR=#FFCC99><TD ALIGN=CENTER COLSPAN=10><FONT FACE="ARIAL,HELVETICA" COLOR=BLACK SIZE=1><B> &nbsp; </TD></TR>
<? } ?>


<TR><TD ALIGN=LEFT COLSPAN=10 HEIGHT=2 BGCOLOR=BLACK></TD></TR>
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
echo "<tr bgcolor=#B6D3FC><td align=right>Kampagne Identifikation: </td><td align=left><input type=text name=campaign_id size=8 maxlength=8>$NWB#vicidial_campaigns-campaign_id$NWE</td></tr>\n";
echo "<tr bgcolor=#B6D3FC><td align=right>Kampagne Name: </td><td align=left><input type=text name=campaign_name size=30 maxlength=30>$NWB#vicidial_campaigns-campaign_name$NWE</td></tr>\n";
echo "<tr bgcolor=#B6D3FC><td align=right>Aktiv:</td><td align=left><select size=1 name=active><option>Y</option><option>N</option></select>$NWB#vicidial_campaigns-active$NWE</td></tr>\n";
echo "<tr bgcolor=#B6D3FC><td align=right>Park-Verlängerung: </td><td align=left><input type=text name=park_ext size=10 maxlength=10>$NWB#vicidial_campaigns-park_ext$NWE</td></tr>\n";
echo "<tr bgcolor=#B6D3FC><td align=right>Park-Dateiname: </td><td align=left><input type=text name=park_file_name size=10 maxlength=10>$NWB#vicidial_campaigns-park_file_name$NWE</td></tr>\n";
echo "<tr bgcolor=#B6D3FC><td align=right>Netz-Form: </td><td align=left><input type=text name=web_form_address size=50 maxlength=255>$NWB#vicidial_campaigns-web_form_address$NWE</td></tr>\n";
echo "<tr bgcolor=#B6D3FC><td align=right>Erlauben Sie Closers: </td><td align=left><select size=1 name=allow_closers><option>Y</option><option>N</option></select>$NWB#vicidial_campaigns-allow_closers$NWE</td></tr>\n";
echo "<tr bgcolor=#B6D3FC><td align=right>Zufuhrbehälter-Niveau: </td><td align=left><select size=1 name=hopper_level><option>1</option><option>5</option><option>10</option><option>50</option><option>100</option><option>200</option><option>500</option><option>1000</option></select>$NWB#vicidial_campaigns-hopper_level$NWE</td></tr>\n";
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
echo "<tr bgcolor=#B6D3FC><td align=right>Telefonnummer: </td><td align=left><input type=text name=phone_number size=12 maxlength=10> (nur Stellen)$NWB#vicidial_list-dnc$NWE</td></tr>\n";
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
		 if ( (strlen($campaign_id) < 2) or (strlen($list_name) < 2)  or (strlen($list_id) < 2) or (strlen($list_id) > 8) )
			{
			 echo "<br>LISTE NICHT ADDIERT - gehen Sie bitte zurück und betrachten Sie dieDaten, die Sie eingaben\n";
			 echo "<br>Liste Identifikation muß zwischen 2 und 8 Buchstaben lang sein\n";
			 echo "<br>Liste Name muß mindestens 2 Buchstaben lang sein\n";
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
			$stmt="INSERT INTO vicidial_user_groups values('$user_group','$group_name');";
			$rslt=mysql_query($stmt, $link);

			echo "<br><B>BENUTZER-GRUPPE ADDIERT: $user_start</B>\n";

			### LOG CHANGES TO LOG FILE ###
			if ($WeBRooTWritablE > 0)
				{
				$fp = fopen ("./admin_changes_log.txt", "a");
				fwrite ($fp, "$date|ADDIEREN Sie Einen NEUEN BENUTZER GROUP ENTRY     |$PHP_AUTH_USER|$ip|'$user_group','$group_name'|\n");
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
			$stmt="INSERT INTO vicidial_scripts values('$script_id','$script_name','$script_comments','" . mysql_real_escape_string($script_text) . "','$active');";
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

		$stmtA="UPDATE vicidial_campaigns set campaign_name='$campaign_name',active='$active',dial_status_a='$dial_status_a',dial_status_b='$dial_status_b',dial_status_c='$dial_status_c',dial_status_d='$dial_status_d',dial_status_e='$dial_status_e',lead_order='$lead_order',allow_closers='$allow_closers',hopper_level='$hopper_level', auto_dial_level='$auto_dial_level', next_agent_call='$next_agent_call', local_call_time='$local_call_time', voicemail_ext='$voicemail_ext', dial_timeout='$dial_timeout', dial_prefix='$dial_prefix', campaign_cid='$campaign_cid', campaign_vdad_exten='$campaign_vdad_exten', web_form_address='" . mysql_real_escape_string($web_form_address) . "', park_ext='$park_ext', park_file_name='$park_file_name', campaign_rec_exten='$campaign_rec_exten', campaign_recording='$campaign_recording', campaign_rec_filename='$campaign_rec_filename', campaign_script='$script_id', get_call_launch='$get_call_launch', am_message_exten='$am_message_exten', amd_send_to_vmx='$amd_send_to_vmx', xferconf_a_dtmf='$xferconf_a_dtmf',xferconf_a_number='$xferconf_a_number', xferconf_b_dtmf='$xferconf_b_dtmf',xferconf_b_number='$xferconf_b_number',lead_filter_id='$lead_filter_id',alt_number_dialing='$alt_number_dialing',scheduled_callbacks='$scheduled_callbacks',safe_harbor_message='$safe_harbor_message',drop_call_seconds='$drop_call_seconds',safe_harbor_exten='$safe_harbor_exten',wrapup_seconds='$wrapup_seconds',wrapup_message='$wrapup_message',closer_campaigns='$groups_value',use_internal_dnc='$use_internal_dnc' where campaign_id='$campaign_id';";
		$rslt=mysql_query($stmtA, $link);

		if ($reset_hopper == 'Y')
			{
			echo "<br>ZURÜCKSTELLEN DES KAMPAGNE LEITUNG ZUFUHRBEHÄLTERS\n";
			echo "<br> - Wartezeit 1 Minute, bevor folgende Nummer gewählt wird\n";
			$stmt="DELETE from vicidial_hopper where campaign_id='$campaign_id' and status='READY';";
			$rslt=mysql_query($stmt, $link);

			### LOG RESET TO LOG FILE ###
			if ($WeBRooTWritablE > 0)
				{
				$fp = fopen ("./admin_changes_log.txt", "a");
				fwrite ($fp, "$date|CAMPAIGN HOPPERRESET|$PHP_AUTH_USER|$ip|campaign_name='$campaign_name'|\n");
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

		$stmtA="UPDATE vicidial_campaigns set campaign_name='$campaign_name',active='$active',dial_status_a='$dial_status_a',dial_status_b='$dial_status_b',dial_status_c='$dial_status_c',dial_status_d='$dial_status_d',dial_status_e='$dial_status_e',lead_order='$lead_order',hopper_level='$hopper_level', auto_dial_level='$auto_dial_level',lead_filter_id='$lead_filter_id' where campaign_id='$campaign_id';";
		$rslt=mysql_query($stmtA, $link);

		if ($reset_hopper == 'Y')
			{
			echo "<br>ZURÜCKSTELLEN DES KAMPAGNE LEITUNG ZUFUHRBEHÄLTERS\n";
			echo "<br> - Wartezeit 1 Minute, bevor folgende Nummer gewählt wird\n";
			$stmt="DELETE from vicidial_hopper where campaign_id='$campaign_id' and status='READY';";
			$rslt=mysql_query($stmt, $link);

			### LOG HOPPER RESET TO LOG FILE ###
			if ($WeBRooTWritablE > 0)
				{
				$fp = fopen ("./admin_changes_log.txt", "a");
				fwrite ($fp, "$date|CAMPAIGN HOPPERRESET|$PHP_AUTH_USER|$ip|campaign_name='$campaign_name'|\n");
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
		$stmt="UPDATE vicidial_user_groups set user_group='$user_group', group_name='$group_name' where user_group='$OLDuser_group';";
		$rslt=mysql_query($stmt, $link);

		echo "<br><B>BENUTZER-GRUPPE GEÄNDERT</B>\n";

		### LOG CHANGES TO LOG FILE ###
		if ($WeBRooTWritablE > 0)
			{
			$fp = fopen ("./admin_changes_log.txt", "a");
			fwrite ($fp, "$date|MODIFY USER GROUP ENTRY     |$PHP_AUTH_USER|$ip|UPDATE vicidial_user_groups set user_group='$user_group', group_name='$group_name' where user_group='$OLDuser_group'|\n");
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
	echo "<FONT FACE=\"ARIAL,HELVETICA\" COLOR=BLACK SIZE=2>";

	 if ( (strlen($script_id) < 2) or (strlen($script_name) < 2) or (strlen($script_text) < 2) )
		{
		 echo "<br>INDEX NICHT GEÄNDERT - Gehen Sie bitte zurück und betrachten Sie die Daten, die Sieeingaben\n";
		 echo "<br>Indexname, -beschreibung und -text müssen mindestens 2 Buchstabenlang sein\n";
		}
	 else
		{
		$stmt="UPDATE vicidial_scripts set script_name='$script_name', script_comments='$script_comments', script_text='" . mysql_real_escape_string($script_text) . "', active='$active' where script_id='$script_id';";
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
# ADD=5111111111 confirmation before deletion of call time record
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
# ADD=62 Logout all agents fro a campaign
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

	$stmt="SELECT * from vicidial_statuses order by status";
	$rslt=mysql_query($stmt, $link);
	$statuses_to_print = mysql_num_rows($rslt);
	$statuses_list='';

	$o=0;
	while ($statuses_to_print > $o) {
		$rowx=mysql_fetch_row($rslt);
		$statuses_list .= "<option value=\"$rowx[0]\">$rowx[0] - $rowx[1]</option>\n";
		$statname_list["$rowx[0]"] = "$rowx[1]";
		if (eregi("Y",$rowx[2]))
			{$HKstatuses_list .= "<option value=\"$rowx[0]-----$rowx[1]\">$rowx[0] - $rowx[1]</option>\n";}
		$o++;
	}

	$stmt="SELECT * from vicidial_campaign_statuses where campaign_id='$campaign_id' and selectable='Y' order by status";
	$rslt=mysql_query($stmt, $link);
	$Cstatuses_to_print = mysql_num_rows($rslt);

	$o=0;
	while ($Cstatuses_to_print > $o) {
		$rowx=mysql_fetch_row($rslt);
		$statuses_list .= "<option value=\"$rowx[0]\">$rowx[0] - $rowx[1]</option>\n";
		$statname_list["$rowx[0]"] = "$rowx[1]";
		if (eregi("Y",$rowx[2]))
			{$HKstatuses_list .= "<option value=\"$rowx[0]-----$rowx[1]\">$rowx[0] - $rowx[1]</option>\n";}
		$o++;
	}
echo "$statuses_list";
echo "<option value=\"$dial_status_a\" SELECTED>$dial_status_a - $statname_list[$dial_status_a]</option>\n";
echo "</select>$NWB#vicidial_campaigns-dial_status$NWE</td></tr>\n";
echo "<tr bgcolor=#B6D3FC><td align=right>Vorwahlknopfstatus2: </td><td align=left><select size=1 name=dial_status_b>\n";
echo "$statuses_list";
echo "<option value=\"$dial_status_b\" SELECTED>$dial_status_b - $statname_list[$dial_status_b]</option>\n";
echo "</select>$NWB#vicidial_campaigns-dial_status$NWE</td></tr>\n";
echo "<tr bgcolor=#B6D3FC><td align=right>Vorwahlknopfstatus3: </td><td align=left><select size=1 name=dial_status_c>\n";
echo "$statuses_list";
echo "<option value=\"$dial_status_c\" SELECTED>$dial_status_c - $statname_list[$dial_status_c]</option>\n";
echo "</select>$NWB#vicidial_campaigns-dial_status$NWE</td></tr>\n";
echo "<tr bgcolor=#B6D3FC><td align=right>Vorwahlknopfstatus4: </td><td align=left><select size=1 name=dial_status_d>\n";
echo "$statuses_list";
echo "<option value=\"$dial_status_d\" SELECTED>$dial_status_d - $statname_list[$dial_status_d]</option>\n";
echo "</select>$NWB#vicidial_campaigns-dial_status$NWE</td></tr>\n";
echo "<tr bgcolor=#B6D3FC><td align=right>Vorwahlknopfstatus5: </td><td align=left><select size=1 name=dial_status_e>\n";
echo "$statuses_list";
echo "<option value=\"$dial_status_e\" SELECTED>$dial_status_e - $statname_list[$dial_status_e]</option>\n";
echo "</select>$NWB#vicidial_campaigns-dial_status$NWE</td></tr>\n";

echo "<tr bgcolor=#B6D3FC><td align=right>Liste Auftrag: </td><td align=left><select size=1 name=lead_order><option>DOWN</option><option>UP</option><option>UP PHONE</option><option>DOWN PHONE</option><option>UP LAST NAME</option><option>DOWN LAST NAME</option><option>UP COUNT</option><option>DOWN COUNT</option><option>DOWN COUNT 2nd NEW</option><option>DOWN COUNT 3rd NEW</option><option>DOWN COUNT 4th NEW</option><option SELECTED>$lead_order</option></select>$NWB#vicidial_campaigns-lead_order$NWE</td></tr>\n";

echo "<tr bgcolor=#B6D3FC><td align=right><a href=\"$PHP_SELF?ADD=31111111&lead_filter_id=$lead_filter_id\">Leitung Filter</a>: </td><td align=left><select size=1 name=lead_filter_id>\n";
echo "$filters_list";
echo "<option selected value=\"$lead_filter_id\">$lead_filter_id - $filtername_list[$lead_filter_id]</option>\n";
echo "</select>$NWB#vicidial_campaigns-lead_filter_id$NWE</td></tr>\n";

echo "<tr bgcolor=#B6D3FC><td align=right>Zufuhrbehälter-Niveau: </td><td align=left><select size=1 name=hopper_level><option>1</option><option>5</option><option>10</option><option>50</option><option>100</option><option>200</option><option>500</option><option>750</option><option>1000</option><option SELECTED>$hopper_level</option></select>$NWB#vicidial_campaigns-hopper_level$NWE</td></tr>\n";

echo "<tr bgcolor=#B6D3FC><td align=right>Kraft-Zurückstellen des Zufuhrbehälters: </td><td align=left><select size=1 name=reset_hopper><option>Y</option><option SELECTED>N</option></select>$NWB#vicidial_campaigns-force_reset_hopper$NWE</td></tr>\n";

echo "<tr bgcolor=#B6D3FC><td align=right>Selbstvorwahlknopf-Niveau: </td><td align=left><select size=1 name=auto_dial_level><option >0</option><option>1</option><option>1.1</option><option>1.2</option><option>1.3</option><option>1.4</option><option>1.5</option><option>1.6</option><option>1.7</option><option>1.8</option><option>1.9</option><option>2.0</option><option>2.2</option><option>2.5</option><option>2.7</option><option>3.0</option><option>3.5</option><option>4.0</option><option SELECTED>$auto_dial_level</option></select>(0 = off)$NWB#vicidial_campaigns-auto_dial_level$NWE</td></tr>\n";

echo "<tr bgcolor=#B6D3FC><td align=right>Folgender Vertreter-Anruf: </td><td align=left><select size=1 name=next_agent_call><option >random</option><option>oldest_call_start</option><option>oldest_call_finish</option><option>overall_user_level</option><option SELECTED>$next_agent_call</option></select>$NWB#vicidial_campaigns-next_agent_call$NWE</td></tr>\n";

echo "<tr bgcolor=#B6D3FC><td align=right><a href=\"$PHP_SELF?ADD=311111111&call_time_id=$local_call_time\">Ortsgespräch-Zeit: </a></td><td align=left><select size=1 name=local_call_time>\n";
echo "$call_times_list";
echo "<option selected value=\"$local_call_time\">$local_call_time - $call_timename_list[$local_call_time]</option>\n";
echo "</select>$NWB#vicidial_campaigns-local_call_time$NWE</td></tr>\n";

echo "<tr bgcolor=#B6D3FC><td align=right>Vorwahlknopf-Abschaltung: </td><td align=left><input type=text name=dial_timeout size=3 maxlength=3 value=\"$dial_timeout\"> <i>in seconds</i>$NWB#vicidial_campaigns-dial_timeout$NWE</td></tr>\n";

echo "<tr bgcolor=#B6D3FC><td align=right>Vorwahlknopf-Präfix: </td><td align=left><input type=text name=dial_prefix size=20 maxlength=20 value=\"$dial_prefix\"> <font size=1>for 91NXXNXXXXXX value would be 9, for no dial prefix use X</font>$NWB#vicidial_campaigns-dial_prefix$NWE</td></tr>\n";

echo "<tr bgcolor=#B6D3FC><td align=right>Kampagne CallerID: </td><td align=left><input type=text name=campaign_cid size=20 maxlength=20 value=\"$campaign_cid\">$NWB#vicidial_campaigns-campaign_cid$NWE</td></tr>\n";

echo "<tr bgcolor=#B6D3FC><td align=right>Kampagne VDAD exten: </td><td align=left><input type=text name=campaign_vdad_exten size=10 maxlength=20 value=\"$campaign_vdad_exten\">$NWB#vicidial_campaigns-campaign_vdad_exten$NWE</td></tr>\n";

echo "<tr bgcolor=#B6D3FC><td align=right>Kampagne Rec exten: </td><td align=left><input type=text name=campaign_rec_exten size=10 maxlength=10 value=\"$campaign_rec_exten\">$NWB#vicidial_campaigns-campaign_rec_exten$NWE</td></tr>\n";

echo "<tr bgcolor=#B6D3FC><td align=right>Kampagne Aufnahme: </td><td align=left><select size=1 name=campaign_recording><option>NEVER</option><option>ONDEMAND</option><option>ALLCALLS</option><option SELECTED>$campaign_recording</option></select>$NWB#vicidial_campaigns-campaign_recording$NWE</td></tr>\n";

echo "<tr bgcolor=#B6D3FC><td align=right>Kampagne Rec Dateiname: </td><td align=left><input type=text name=campaign_rec_filename size=50 maxlength=50 value=\"$campaign_rec_filename\">$NWB#vicidial_campaigns-campaign_rec_filename$NWE</td></tr>\n";

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
echo "$HKstatuses_list\n";
echo "</select> &nbsp; \n";
echo "Versuch Verzögert: <input size=7 maxlength=5 name=attempt_delay>\n";
echo "Versuch Maximum: <input size=5 maxlength=3 name=attempt_maximum>\n";
echo "<input type=submit name=submit value=ADD><BR>\n";

echo "</center></FORM><br>\n";

echo "<a href=\"$PHP_SELF?ADD=52&campaign_id=$campaign_id\">LOGGEN SIE ALLE MITTEL AUS DIESER KAMPAGNE HERAUS</a><BR><BR>\n";

if ($LOGdelete_campaigns > 0)
	{
	echo "<br><br><a href=\"$PHP_SELF?ADD=51&campaign_id=$campaign_id\">LÖSCHEN SIE DIESE KAMPAGNE</a>\n";
	}

}


######################
# ADD=34 modify campaign info in the system - Basic View
######################

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

	$stmt="SELECT * from vicidial_statuses order by status";
	$rslt=mysql_query($stmt, $link);
	$statuses_to_print = mysql_num_rows($rslt);
	$statuses_list='';

	$o=0;
	while ($statuses_to_print > $o) {
		$rowx=mysql_fetch_row($rslt);
		$statuses_list .= "<option value=\"$rowx[0]\">$rowx[0] - $rowx[1]</option>\n";
		$statname_list["$rowx[0]"] = "$rowx[1]";
		$o++;
	}

	$stmt="SELECT * from vicidial_campaign_statuses where campaign_id='$campaign_id' order by status";
	$rslt=mysql_query($stmt, $link);
	$Cstatuses_to_print = mysql_num_rows($rslt);

	$o=0;
	while ($Cstatuses_to_print > $o) {
		$rowx=mysql_fetch_row($rslt);
		$statuses_list .= "<option value=\"$rowx[0]\">$rowx[0] - $rowx[1]</option>\n";
		$statname_list["$rowx[0]"] = "$rowx[1]";
		$o++;
	}
echo "$statuses_list";
echo "<option value=\"$dial_status_a\" SELECTED>$dial_status_a - $statname_list[$dial_status_a]</option>\n";
echo "</select>$NWB#vicidial_campaigns-dial_status$NWE</td></tr>\n";
echo "<tr bgcolor=#B6D3FC><td align=right>Vorwahlknopfstatus2: </td><td align=left><select size=1 name=dial_status_b>\n";
echo "$statuses_list";
echo "<option value=\"$dial_status_b\" SELECTED>$dial_status_b - $statname_list[$dial_status_b]</option>\n";
echo "</select>$NWB#vicidial_campaigns-dial_status$NWE</td></tr>\n";
echo "<tr bgcolor=#B6D3FC><td align=right>Vorwahlknopfstatus3: </td><td align=left><select size=1 name=dial_status_c>\n";
echo "$statuses_list";
echo "<option value=\"$dial_status_c\" SELECTED>$dial_status_c - $statname_list[$dial_status_c]</option>\n";
echo "</select>$NWB#vicidial_campaigns-dial_status$NWE</td></tr>\n";
echo "<tr bgcolor=#B6D3FC><td align=right>Vorwahlknopfstatus4: </td><td align=left><select size=1 name=dial_status_d>\n";
echo "$statuses_list";
echo "<option value=\"$dial_status_d\" SELECTED>$dial_status_d - $statname_list[$dial_status_d]</option>\n";
echo "</select>$NWB#vicidial_campaigns-dial_status$NWE</td></tr>\n";
echo "<tr bgcolor=#B6D3FC><td align=right>Vorwahlknopfstatus5: </td><td align=left><select size=1 name=dial_status_e>\n";
echo "$statuses_list";
echo "<option value=\"$dial_status_e\" SELECTED>$dial_status_e - $statname_list[$dial_status_e]</option>\n";
echo "</select>$NWB#vicidial_campaigns-dial_status$NWE</td></tr>\n";

echo "<tr bgcolor=#B6D3FC><td align=right>Liste Auftrag: </td><td align=left><select size=1 name=lead_order><option>DOWN</option><option>UP</option><option>UP PHONE</option><option>DOWN PHONE</option><option>UP LAST NAME</option><option>DOWN LAST NAME</option><option>UP COUNT</option><option>DOWN COUNT</option><option>DOWN COUNT 2nd NEW</option><option>DOWN COUNT 3rd NEW</option><option>DOWN COUNT 4th NEW</option><option SELECTED>$lead_order</option></select>$NWB#vicidial_campaigns-lead_order$NWE</td></tr>\n";

echo "<tr bgcolor=#B6D3FC><td align=right><a href=\"$PHP_SELF?ADD=31111111&lead_filter_id=$lead_filter_id\">Leitung Filter</a>: </td><td align=left><select size=1 name=lead_filter_id>\n";
echo "$filters_list";
echo "<option selected value=\"$lead_filter_id\">$lead_filter_id - $filtername_list[$lead_filter_id]</option>\n";
echo "</select>$NWB#vicidial_campaigns-lead_filter_id$NWE</td></tr>\n";

echo "<tr bgcolor=#B6D3FC><td align=right>Zufuhrbehälter-Niveau: </td><td align=left><select size=1 name=hopper_level><option>1</option><option>5</option><option>10</option><option>50</option><option>100</option><option>200</option><option>500</option><option>750</option><option>1000</option><option SELECTED>$hopper_level</option></select>$NWB#vicidial_campaigns-hopper_level$NWE</td></tr>\n";

echo "<tr bgcolor=#B6D3FC><td align=right>Kraft-Zurückstellen des Zufuhrbehälters: </td><td align=left><select size=1 name=reset_hopper><option>Y</option><option SELECTED>N</option></select>$NWB#vicidial_campaigns-force_reset_hopper$NWE</td></tr>\n";

echo "<tr bgcolor=#B6D3FC><td align=right>Selbstvorwahlknopf-Niveau: </td><td align=left><select size=1 name=auto_dial_level><option >0</option><option>1</option><option>1.1</option><option>1.2</option><option>1.3</option><option>1.4</option><option>1.5</option><option>1.6</option><option>1.7</option><option>1.8</option><option>1.9</option><option>2.0</option><option>2.2</option><option>2.5</option><option>2.7</option><option>3.0</option><option>3.5</option><option>4.0</option><option SELECTED>$auto_dial_level</option></select>(0 = off)$NWB#vicidial_campaigns-auto_dial_level$NWE</td></tr>\n";

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
echo "</b></center>\n";

echo "<br>\n";

echo "<a href=\"$PHP_SELF?ADD=52&campaign_id=$campaign_id\">LOGGEN SIE ALLE MITTEL AUS DIESER KAMPAGNE HERAUS</a><BR><BR>\n";


if ($LOGdelete_campaigns > 0)
	{
	echo "<br><br><a href=\"$PHP_SELF?ADD=51&campaign_id=$campaign_id\">LÖSCHEN SIE DIESE KAMPAGNE</a>\n";
	}


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

echo "<center><b>\n";

if ($LOGdelete_ingroups > 0)
	{
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
echo "<tr bgcolor=black><td><font size=1 color=white>LEAD</td><td><font size=1 color=white>LIST</td><td><font size=1 color=white>CAMPAIGN</td><td><font size=1 color=white>ENTRYDATUM</td><td><font size=1 color=white>CALLBACKDATUM</td><td><font size=1 color=white>USER</td><td><font size=1 color=white>RECIPIENT</td><td><font size=1 color=white>STATUS</td></tr>\n";

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

	$stmt="SELECT * from vicidial_users order by full_name";
	$rslt=mysql_query($stmt, $link);
	$people_to_print = mysql_num_rows($rslt);

echo "<br>BENUTZER-AUFLISTUNGEN:\n";
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
