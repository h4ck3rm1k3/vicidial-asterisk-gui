<?
# vdc_db_query.php
# 
# Copyright (C) 2009  Matt Florell <vicidial@gmail.com>    LICENSE: AGPLv2
#
# This script is designed purely to send whether the meetme conference has live channels connected and which they are
# This script depends on the server_ip being sent and also needs to have a valid user/pass from the vicidial_users table
# 
# required variables:
#  - $server_ip
#  - $session_name
#  - $user
#  - $pass
# optional variables:
#  - $format - ('text','debug')
#  - $ACTION - ('regCLOSER','manDiaLnextCALL','manDiaLskip','manDiaLonly','manDiaLlookCALL','manDiaLlogCALL','userLOGout','updateDISPO','VDADpause','VDADready','VDADcheckINCOMING','UpdatEFavoritEs','CalLBacKLisT','CalLBacKCounT','PauseCodeSubmit','LogiNCamPaigns','alt_phone_change','AlertControl')
#  - $stage - ('start','finish','lookup','new')
#  - $closer_choice - ('CL_TESTCAMP_L CL_OUT123_L -')
#  - $conf_exten - ('8600011',...)
#  - $exten - ('123test',...)
#  - $ext_context - ('default','demo',...)
#  - $ext_priority - ('1','2',...)
#  - $campaign - ('testcamp',...)
#  - $dial_timeout - ('60','26',...)
#  - $dial_prefix - ('9','8',...)
#  - $campaign_cid - ('3125551212','0000000000',...)
#  - $MDnextCID - ('M06301413000000002',...)
#  - $uniqueid - ('1120232758.2406800',...)
#  - $lead_id - ('36524',...)
#  - $list_id - ('101','123456',...)
#  - $length_in_sec - ('12',...)
#  - $phone_code - ('1',...)
#  - $phone_number - ('3125551212',...)
#  - $channel - ('Zap/12-1',...)
#  - $start_epoch - ('1120236911',...)
#  - $vendor_lead_code - ('1234test',...)
#  - $title - ('Mr.',...)
#  - $first_name - ('Bob',...)
#  - $middle_initial - ('L',...)
#  - $last_name - ('Wilson',...)
#  - $address1 - ('1324 Main St.',...)
#  - $address2 - ('Apt. 12',...)
#  - $address3 - ('co Robert Wilson',...)
#  - $city - ('Chicago',...)
#  - $state - ('IL',...)
#  - $province - ('NA',...)
#  - $postal_code - ('60054',...)
#  - $country_code - ('USA',...)
#  - $gender - ('M',...)
#  - $date_of_birth - ('1970-01-01',...)
#  - $alt_phone - ('3125551213',...)
#  - $email - ('bob@bob.com',...)
#  - $security_phrase - ('Hello',...)
#  - $comments - ('Good Customer',...)
#  - $auto_dial_level - ('0','1','1.2',...)
#  - $VDstop_rec_after_each_call - ('0','1')
#  - $conf_silent_prefix - ('7','8','5',...)
#  - $extension - ('123','user123','25-1',...)
#  - $protocol - ('Zap','SIP','IAX2',...)
#  - $user_abb - ('1234','6666',...)
#  - $preview - ('YES','NO',...)
#  - $called_count - ('0','1','2',...)
#  - $agent_log_id - ('123456',...)
#  - $agent_log - ('NO',...)
#  - $favorites_list - (",'cc160','cc100'",...)
#  - $CallBackDatETimE - ('2006-04-21 14:30:00',...)
#  - $recipient - ('ANYONE,'USERONLY')
#  - $callback_id - ('12345','12346',...)
#  - $use_internal_dnc - ('Y','N')
#  - $use_campaign_dnc - ('Y','N')
#  - $omit_phone_code - ('Y','N')
#  - $no_delete_sessions - ('0','1')
#  - $LogouTKicKAlL - ('0','1');
#  - $closer_blended = ('0','1');
#  - $inOUT = ('IN','OUT');
#  - $manual_dial_filter = ('NONE','CAMPLISTS','DNC','CAMPLISTS_DNC')
#  - $agentchannel = ('Zap/1-1','SIP/testing-6ry4i3',...)
#  - $conf_dialed = ('0','1')
#  - $leaving_threeway = ('0','1')
#  - $blind_transfer = ('0','1')
#  - $usegroupalias - ('0','1')
#  - $account - ('DEFAULT',...)
#  - $agent_dialed_number - ('1','')
#  - $agent_dialed_type - ('MANUAL_OVERRIDE','MANUAL_DIALNOW','MANUAL_PREVIEW',...)
#
# CHANGELOG:
# 50629-1044 - First build of script
# 50630-1422 - Added manual dial action and MD channel lookup
# 50701-1451 - Added dial log for start and end of vicidial calls
# 50705-1239 - Added call disposition update
# 50804-1627 - Fixed updateDispo to update vicidial_log entry
# 50816-1605 - Added VDADpause/ready for auto dialing
# 50816-1811 - Added basic autodial call pickup functions
# 50817-1005 - Altered logging functions to accomodate auto_dialing
# 50818-1305 - Added stop-all-recordings-after-each-vicidial-call option
# 50818-1411 - Added hangup of agent phone after Logout
# 50901-1315 - Fixed CLOSER IN-GROUP Web Form bug
# 50902-1507 - Fixed CLOSER log length_in_sec bug
# 50902-1730 - Added functions for manual preview dialing and revert
# 50913-1214 - Added agent random update to leadupdate
# 51020-1421 - Added agent_log_id framework for detailed agent activity logging
# 51021-1717 - Allows for multi-line comments (changes \n to !N in database)
# 51111-1046 - Added vicidial_agent_log lead_id earlier for manual dial
# 51121-1445 - Altered echo statements for several small PHP speed optimizations
# 51122-1328 - Fixed UserLogout issue not removing conference reservation
# 51129-1012 - Added ability to accept calls from other VICIDIAL servers
# 51129-1729 - Changed manual dial to use the '/n' flag for calls
# 51221-1154 - Added SCRIPT id lookup and sending to vicidial.php for display
# 60105-1059 - Added Updating of astguiclient favorites in the DB
# 60208-1617 - Added dtmf buttons output per call
# 60213-1521 - Added closer_campaigns update to vicidial_users
# 60215-1036 - Added Callback date-time entry into vicidial_callbacks table
# 60413-1541 - Added USERONLY Callback listings output - CalLBacKLisT
#            - Added USERONLY Callback count output - CalLBacKCounT
# 60414-1140 - Added Callback lead lookup for manual dialing
# 60419-1517 - After CALLBK is sent to agent, update callback record to INACTIVE
# 60421-1419 - Check GET/POST vars lines with isset to not trigger PHP NOTICES
# 60427-1236 - Fixed closer_choice error for CLOSER campaigns
# 60609-1148 - Added ability to check for manual dial numbers in DNC
# 60619-1117 - Added variable filters to close security holes for login form
# 60623-1414 - Fixed variable filter for phone_code and fixed manual dial logic
# 60821-1600 - Added ability to omit the phone code on vicidial lead dialing
# 60821-1647 - Added ability to not delete sessions at logout
# 60906-1124 - Added lookup and sending of callback data for CALLBK calls
# 61128-2229 - Added vicidial_live_agents and vicidial_auto_calls manual dial entries
# 70111-1600 - Added ability to use BLEND/INBND/*_C/*_B/*_I as closer campaigns
# 70115-1733 - Added alt_dial functionality in auto-dial modes
# 70118-1501 - Added user_group to vicidial_log,_agent_log,_closer_log,_callbacks
# 70123-1357 - Fixed bug that would not update vicidial_closer_log status to dispo
# 70202-1438 - Added pause code submit function
# 70203-0930 - Added dialed_number to lead info output
# 70203-1030 - Added dialed_label to lead info output
# 70206-1126 - Added INBOUND status for inbound/closer calls in vicidial_live_agents
# 70212-1253 - Fixed small issue with CXFER
# 70213-1431 - Added QueueMetrics PAUSE/UNPAUSE/AGENTLOGIN/AGENTLOGOFF actions
# 70214-1231 - Added queuemetrics_log_id field for server_id in queue_log
# 70215-1210 - Added queuemetrics COMPLETEAGENT action
# 70216-1051 - Fixed double call complete queuemetrics logging
# 70222-1616 - Changed queue_log PAUSE/UNPAUSE to PAUSEALL/UNPAUSEALL
# 70309-1034 - Allow amphersands and questions marks in comments to pass through
# 70313-1052 - Allow pound signs(hash) in comments to pass through
# 70319-1544 - Added agent disable update customer data function
# 70322-1545 - Added sipsak display ability
# 70413-1253 - Fixed bug for outbound call time in CLOSER-type blended campaigns
# 70424-1100 - Fixed bug for fronter/closer calls that would delete vdac records
# 70802-1729 - Fixed bugs with pause_sec and wait_sec under certain call handling 
# 70828-1443 - Added source_id to output of SCRIPTtab-IFRAME and WEBFORM
# 71029-1855 - removed campaign_id naming restrictions for CLOSER-type campaigns
# 71030-2047 - added hopper priority for auto alt dial entries
# 71116-1011 - added calls_today count updating of the vicidial_live_agents upon INCALL
# 71120-1520 - added LogiNCamPaigns to show only allowed campaigns for agents upon login
# 71125-1751 - Added inbound-group default inbound group sending to vicidial.php
# 71129-2025 - restricted callbacks count and list to campaign only
# 71223-0318 - changed logging of closer calls
# 71226-1117 - added option to kick all calls from conference upon logout
# 80116-1032 - added user_closer_log logging in regCLOSER
# 80125-1213 - fixed vicidial_log bug when call is from closer
# 80317-2051 - Added in-group recording settings
# 80402-0121 - Fixes for manual dial transfers on some systems, removed /n persist flag
# 80424-0442 - Added non_latin lookup from system_settings
# 80430-1006 - Added term_reason for vicidial_log and vicidial_closer_log
# 80430-1957 - Changed to leave lead_id in vicidial_live_agents record until after dispo
# 80630-2153 - Added queue_log logging for Manual dial calls
# 80703-0139 - Added alter customer phone permissions
# 80707-2325 - Added vicidial_id to recording_log for tracking of vicidial or closer log to recording
# 80713-0624 - Added vicidial_list.last_local_call_time field
# 80717-1604 - Modified logging function to use inOUT to determine call direction and place to log
# 80719-1147 - Changed recording conf prefix
# 80815-1019 - Added manual dial list restriction option
# 80831-0545 - Added extended alt dial number info display support
# 80909-1710 - Added support for campaign-specific DNC lists
# 81010-1048 - Added support for hangup of all channels except for agent channel after attempting a 3way call
# 81011-1404 - Fixed bugs in leave3way when transferring a manual dial call
# 81020-1459 - Fixed bugs in queue_log logging
# 81104-0134 - Added mysql error logging capability
# 81104-1617 - Added multi-retry for some vicidial_live_agents table MySQL queries
# 81106-0410 - Added force_timeclock_login option to LoginCampaigns function
# 81107-0424 - Added carryover of script and presets for in-group calls from campaign settings
# 81110-0058 - Changed Pause time to start new vicidial_agent_log on every pause
# 81110-1512 - Added hangup_all_non_reserved to fix non-Hangup bug
# 81111-1630 - Added another hangup fix for non-hangup
# 81114-0126 - More vicidial_agent_log bug fixes
# 81119-1809 - webform backslash fix
# 81124-2212 - Fixes blind transfer bug
# 81126-1522 - Fixed callback comments bug
# 81211-0420 - Fixed Manual dial agent_log bug
# 90120-1718 - Added external pause and dial option
# 90126-1759 - Fixed QM section that wasn't qualified and added agent alert option
# 90128-0231 - Added vendor_lead_code to manual dial lead lookup
# 90304-1335 - Added support for group aliases and agent-specific variables for campaigns and in-groups
# 90305-1041 - Added agent_dialed_number and type for user_call_log feature
# 90307-1735 - Added Shift enforcement and manager override features
#

$version = '2.0.5-103';
$build = '90307-1735';
$mel=1;					# Mysql Error Log enabled = 1
$mysql_log_count=193;
$one_mysql_log=0;

require("dbconnect.php");

### If you have globals turned off uncomment these lines
if (isset($_GET["user"]))						{$user=$_GET["user"];}
	elseif (isset($_POST["user"]))				{$user=$_POST["user"];}
if (isset($_GET["pass"]))						{$pass=$_GET["pass"];}
	elseif (isset($_POST["pass"]))				{$pass=$_POST["pass"];}
if (isset($_GET["server_ip"]))					{$server_ip=$_GET["server_ip"];}
	elseif (isset($_POST["server_ip"]))			{$server_ip=$_POST["server_ip"];}
if (isset($_GET["session_name"]))				{$session_name=$_GET["session_name"];}
	elseif (isset($_POST["session_name"]))		{$session_name=$_POST["session_name"];}
if (isset($_GET["format"]))						{$format=$_GET["format"];}
	elseif (isset($_POST["format"]))			{$format=$_POST["format"];}
if (isset($_GET["ACTION"]))						{$ACTION=$_GET["ACTION"];}
	elseif (isset($_POST["ACTION"]))			{$ACTION=$_POST["ACTION"];}
if (isset($_GET["stage"]))						{$stage=$_GET["stage"];}
	elseif (isset($_POST["stage"]))				{$stage=$_POST["stage"];}
if (isset($_GET["closer_choice"]))				{$closer_choice=$_GET["closer_choice"];}
	elseif (isset($_POST["closer_choice"]))		{$closer_choice=$_POST["closer_choice"];}
if (isset($_GET["conf_exten"]))					{$conf_exten=$_GET["conf_exten"];}
	elseif (isset($_POST["conf_exten"]))		{$conf_exten=$_POST["conf_exten"];}
if (isset($_GET["exten"]))						{$exten=$_GET["exten"];}
	elseif (isset($_POST["exten"]))				{$exten=$_POST["exten"];}
if (isset($_GET["ext_context"]))				{$ext_context=$_GET["ext_context"];}
	elseif (isset($_POST["ext_context"]))		{$ext_context=$_POST["ext_context"];}
if (isset($_GET["ext_priority"]))				{$ext_priority=$_GET["ext_priority"];}
	elseif (isset($_POST["ext_priority"]))		{$ext_priority=$_POST["ext_priority"];}
if (isset($_GET["campaign"]))					{$campaign=$_GET["campaign"];}
	elseif (isset($_POST["campaign"]))			{$campaign=$_POST["campaign"];}
if (isset($_GET["dial_timeout"]))				{$dial_timeout=$_GET["dial_timeout"];}
	elseif (isset($_POST["dial_timeout"]))		{$dial_timeout=$_POST["dial_timeout"];}
if (isset($_GET["dial_prefix"]))				{$dial_prefix=$_GET["dial_prefix"];}
	elseif (isset($_POST["dial_prefix"]))		{$dial_prefix=$_POST["dial_prefix"];}
if (isset($_GET["campaign_cid"]))				{$campaign_cid=$_GET["campaign_cid"];}
	elseif (isset($_POST["campaign_cid"]))		{$campaign_cid=$_POST["campaign_cid"];}
if (isset($_GET["MDnextCID"]))					{$MDnextCID=$_GET["MDnextCID"];}
	elseif (isset($_POST["MDnextCID"]))			{$MDnextCID=$_POST["MDnextCID"];}
if (isset($_GET["uniqueid"]))					{$uniqueid=$_GET["uniqueid"];}
	elseif (isset($_POST["uniqueid"]))			{$uniqueid=$_POST["uniqueid"];}
if (isset($_GET["lead_id"]))					{$lead_id=$_GET["lead_id"];}
	elseif (isset($_POST["lead_id"]))			{$lead_id=$_POST["lead_id"];}
if (isset($_GET["list_id"]))					{$list_id=$_GET["list_id"];}
	elseif (isset($_POST["list_id"]))			{$list_id=$_POST["list_id"];}
if (isset($_GET["length_in_sec"]))				{$length_in_sec=$_GET["length_in_sec"];}
	elseif (isset($_POST["length_in_sec"]))		{$length_in_sec=$_POST["length_in_sec"];}
if (isset($_GET["phone_code"]))					{$phone_code=$_GET["phone_code"];}
	elseif (isset($_POST["phone_code"]))		{$phone_code=$_POST["phone_code"];}
if (isset($_GET["phone_number"]))				{$phone_number=$_GET["phone_number"];}
	elseif (isset($_POST["phone_number"]))		{$phone_number=$_POST["phone_number"];}
if (isset($_GET["channel"]))					{$channel=$_GET["channel"];}
	elseif (isset($_POST["channel"]))			{$channel=$_POST["channel"];}
if (isset($_GET["start_epoch"]))				{$start_epoch=$_GET["start_epoch"];}
	elseif (isset($_POST["start_epoch"]))		{$start_epoch=$_POST["start_epoch"];}
if (isset($_GET["dispo_choice"]))				{$dispo_choice=$_GET["dispo_choice"];}
	elseif (isset($_POST["dispo_choice"]))		{$dispo_choice=$_POST["dispo_choice"];}
if (isset($_GET["vendor_lead_code"]))			{$vendor_lead_code=$_GET["vendor_lead_code"];}
	elseif (isset($_POST["vendor_lead_code"]))	{$vendor_lead_code=$_POST["vendor_lead_code"];}
if (isset($_GET["title"]))						{$title=$_GET["title"];}
	elseif (isset($_POST["title"]))				{$title=$_POST["title"];}
if (isset($_GET["first_name"]))					{$first_name=$_GET["first_name"];}
	elseif (isset($_POST["first_name"]))		{$first_name=$_POST["first_name"];}
if (isset($_GET["middle_initial"]))				{$middle_initial=$_GET["middle_initial"];}
	elseif (isset($_POST["middle_initial"]))	{$middle_initial=$_POST["middle_initial"];}
if (isset($_GET["last_name"]))					{$last_name=$_GET["last_name"];}
	elseif (isset($_POST["last_name"]))			{$last_name=$_POST["last_name"];}
if (isset($_GET["address1"]))					{$address1=$_GET["address1"];}
	elseif (isset($_POST["address1"]))			{$address1=$_POST["address1"];}
if (isset($_GET["address2"]))					{$address2=$_GET["address2"];}
	elseif (isset($_POST["address2"]))			{$address2=$_POST["address2"];}
if (isset($_GET["address3"]))					{$address3=$_GET["address3"];}
	elseif (isset($_POST["address3"]))			{$address3=$_POST["address3"];}
if (isset($_GET["city"]))						{$city=$_GET["city"];}
	elseif (isset($_POST["city"]))				{$city=$_POST["city"];}
if (isset($_GET["state"]))						{$state=$_GET["state"];}
	elseif (isset($_POST["state"]))				{$state=$_POST["state"];}
if (isset($_GET["province"]))					{$province=$_GET["province"];}
	elseif (isset($_POST["province"]))			{$province=$_POST["province"];}
if (isset($_GET["postal_code"]))				{$postal_code=$_GET["postal_code"];}
	elseif (isset($_POST["postal_code"]))		{$postal_code=$_POST["postal_code"];}
if (isset($_GET["country_code"]))				{$country_code=$_GET["country_code"];}
	elseif (isset($_POST["country_code"]))		{$country_code=$_POST["country_code"];}
if (isset($_GET["gender"]))						{$gender=$_GET["gender"];}
	elseif (isset($_POST["gender"]))			{$gender=$_POST["gender"];}
if (isset($_GET["date_of_birth"]))				{$date_of_birth=$_GET["date_of_birth"];}
	elseif (isset($_POST["date_of_birth"]))		{$date_of_birth=$_POST["date_of_birth"];}
if (isset($_GET["alt_phone"]))					{$alt_phone=$_GET["alt_phone"];}
	elseif (isset($_POST["alt_phone"]))			{$alt_phone=$_POST["alt_phone"];}
if (isset($_GET["email"]))						{$email=$_GET["email"];}
	elseif (isset($_POST["email"]))				{$email=$_POST["email"];}
if (isset($_GET["security_phrase"]))			{$security_phrase=$_GET["security_phrase"];}
	elseif (isset($_POST["security_phrase"]))	{$security_phrase=$_POST["security_phrase"];}
if (isset($_GET["comments"]))					{$comments=$_GET["comments"];}
	elseif (isset($_POST["comments"]))			{$comments=$_POST["comments"];}
if (isset($_GET["auto_dial_level"]))			{$auto_dial_level=$_GET["auto_dial_level"];}
	elseif (isset($_POST["auto_dial_level"]))	{$auto_dial_level=$_POST["auto_dial_level"];}
if (isset($_GET["VDstop_rec_after_each_call"]))				{$VDstop_rec_after_each_call=$_GET["VDstop_rec_after_each_call"];}
	elseif (isset($_POST["VDstop_rec_after_each_call"]))		{$VDstop_rec_after_each_call=$_POST["VDstop_rec_after_each_call"];}
if (isset($_GET["conf_silent_prefix"]))				{$conf_silent_prefix=$_GET["conf_silent_prefix"];}
	elseif (isset($_POST["conf_silent_prefix"]))	{$conf_silent_prefix=$_POST["conf_silent_prefix"];}
if (isset($_GET["extension"]))					{$extension=$_GET["extension"];}
	elseif (isset($_POST["extension"]))			{$extension=$_POST["extension"];}
if (isset($_GET["protocol"]))					{$protocol=$_GET["protocol"];}
	elseif (isset($_POST["protocol"]))			{$protocol=$_POST["protocol"];}
if (isset($_GET["user_abb"]))					{$user_abb=$_GET["user_abb"];}
	elseif (isset($_POST["user_abb"]))			{$user_abb=$_POST["user_abb"];}
if (isset($_GET["preview"]))					{$preview=$_GET["preview"];}
	elseif (isset($_POST["preview"]))			{$preview=$_POST["preview"];}
if (isset($_GET["called_count"]))				{$called_count=$_GET["called_count"];}
	elseif (isset($_POST["called_count"]))		{$called_count=$_POST["called_count"];}
if (isset($_GET["agent_log_id"]))				{$agent_log_id=$_GET["agent_log_id"];}
	elseif (isset($_POST["agent_log_id"]))		{$agent_log_id=$_POST["agent_log_id"];}
if (isset($_GET["agent_log"]))					{$agent_log=$_GET["agent_log"];}
	elseif (isset($_POST["agent_log"]))			{$agent_log=$_POST["agent_log"];}
if (isset($_GET["favorites_list"]))				{$favorites_list=$_GET["favorites_list"];}
	elseif (isset($_POST["favorites_list"]))	{$favorites_list=$_POST["favorites_list"];}
if (isset($_GET["CallBackDatETimE"]))			{$CallBackDatETimE=$_GET["CallBackDatETimE"];}
	elseif (isset($_POST["CallBackDatETimE"]))	{$CallBackDatETimE=$_POST["CallBackDatETimE"];}
if (isset($_GET["recipient"]))					{$recipient=$_GET["recipient"];}
	elseif (isset($_POST["recipient"]))			{$recipient=$_POST["recipient"];}
if (isset($_GET["callback_id"]))				{$callback_id=$_GET["callback_id"];}
	elseif (isset($_POST["callback_id"]))		{$callback_id=$_POST["callback_id"];}
if (isset($_GET["use_internal_dnc"]))			{$use_internal_dnc=$_GET["use_internal_dnc"];}
	elseif (isset($_POST["use_internal_dnc"]))	{$use_internal_dnc=$_POST["use_internal_dnc"];}
if (isset($_GET["use_campaign_dnc"]))			{$use_campaign_dnc=$_GET["use_campaign_dnc"];}
	elseif (isset($_POST["use_campaign_dnc"]))	{$use_campaign_dnc=$_POST["use_campaign_dnc"];}
if (isset($_GET["omit_phone_code"]))			{$omit_phone_code=$_GET["omit_phone_code"];}
	elseif (isset($_POST["omit_phone_code"]))	{$omit_phone_code=$_POST["omit_phone_code"];}
if (isset($_GET["phone_ip"]))				{$phone_ip=$_GET["phone_ip"];}
	elseif (isset($_POST["phone_ip"]))		{$phone_ip=$_POST["phone_ip"];}
if (isset($_GET["enable_sipsak_messages"]))				{$enable_sipsak_messages=$_GET["enable_sipsak_messages"];}
	elseif (isset($_POST["enable_sipsak_messages"]))	{$enable_sipsak_messages=$_POST["enable_sipsak_messages"];}
if (isset($_GET["status"]))						{$status=$_GET["status"];}
	elseif (isset($_POST["status"]))			{$status=$_POST["status"];}
if (isset($_GET["LogouTKicKAlL"]))				{$LogouTKicKAlL=$_GET["LogouTKicKAlL"];}
	elseif (isset($_POST["LogouTKicKAlL"]))		{$LogouTKicKAlL=$_POST["LogouTKicKAlL"];}
if (isset($_GET["closer_blended"]))				{$closer_blended=$_GET["closer_blended"];}
	elseif (isset($_POST["closer_blended"]))	{$closer_blended=$_POST["closer_blended"];}
if (isset($_GET["inOUT"]))						{$inOUT=$_GET["inOUT"];}
	elseif (isset($_POST["inOUT"]))				{$inOUT=$_POST["inOUT"];}
if (isset($_GET["manual_dial_filter"]))				{$manual_dial_filter=$_GET["manual_dial_filter"];}
	elseif (isset($_POST["manual_dial_filter"]))	{$manual_dial_filter=$_POST["manual_dial_filter"];}
if (isset($_GET["alt_dial"]))					{$alt_dial=$_GET["alt_dial"];}
	elseif (isset($_POST["alt_dial"]))			{$alt_dial=$_POST["alt_dial"];}
if (isset($_GET["agentchannel"]))				{$agentchannel=$_GET["agentchannel"];}
	elseif (isset($_POST["agentchannel"]))		{$agentchannel=$_POST["agentchannel"];}
if (isset($_GET["conf_dialed"]))				{$conf_dialed=$_GET["conf_dialed"];}
	elseif (isset($_POST["conf_dialed"]))		{$conf_dialed=$_POST["conf_dialed"];}
if (isset($_GET["leaving_threeway"]))			{$leaving_threeway=$_GET["leaving_threeway"];}
	elseif (isset($_POST["leaving_threeway"]))	{$leaving_threeway=$_POST["leaving_threeway"];}
if (isset($_GET["hangup_all_non_reserved"]))			{$hangup_all_non_reserved=$_GET["hangup_all_non_reserved"];}
	elseif (isset($_POST["hangup_all_non_reserved"]))	{$hangup_all_non_reserved=$_POST["hangup_all_non_reserved"];}
if (isset($_GET["blind_transfer"]))				{$blind_transfer=$_GET["blind_transfer"];}
	elseif (isset($_POST["blind_transfer"]))	{$blind_transfer=$_POST["blind_transfer"];}
if (isset($_GET["usegroupalias"]))			{$usegroupalias=$_GET["usegroupalias"];}
	elseif (isset($_POST["usegroupalias"]))	{$usegroupalias=$_POST["usegroupalias"];}
if (isset($_GET["account"]))				{$account=$_GET["account"];}
	elseif (isset($_POST["account"]))		{$account=$_POST["account"];}
if (isset($_GET["agent_dialed_number"]))			{$agent_dialed_number=$_GET["agent_dialed_number"];}
	elseif (isset($_POST["agent_dialed_number"]))	{$agent_dialed_number=$_POST["agent_dialed_number"];}
if (isset($_GET["agent_dialed_type"]))				{$agent_dialed_type=$_GET["agent_dialed_type"];}
	elseif (isset($_POST["agent_dialed_type"]))		{$agent_dialed_type=$_POST["agent_dialed_type"];}

header ("Content-type: text/html; charset=utf-8");
header ("Cache-Control: no-cache, must-revalidate");  // HTTP/1.1
header ("Pragma: no-cache");                          // HTTP/1.0

$txt = '.txt';
$StarTtime = date("U");
$NOW_DATE = date("Y-m-d");
$NOW_TIME = date("Y-m-d H:i:s");
$CIDdate = date("mdHis");
$ENTRYdate = date("YmdHis");
$MT[0]='';
$agents='@agents';

#############################################
##### START SYSTEM_SETTINGS LOOKUP #####
$stmt = "SELECT use_non_latin,timeclock_end_of_day FROM system_settings;";
$rslt=mysql_query($stmt, $link);
	if ($mel > 0) {mysql_error_logging($NOW_TIME,$link,$mel,$stmt,'00001',$user,$server_ip,$session_name,$one_mysql_log);}
if ($DB) {echo "$stmt\n";}
$qm_conf_ct = mysql_num_rows($rslt);
$i=0;
while ($i < $qm_conf_ct)
	{
	$row=mysql_fetch_row($rslt);
	$non_latin =				$row[0];
	$timeclock_end_of_day =		$row[1];
	$i++;
	}
##### END SETTINGS LOOKUP #####
###########################################

if ($non_latin < 1)
{
$user=ereg_replace("[^0-9a-zA-Z]","",$user);
$pass=ereg_replace("[^0-9a-zA-Z]","",$pass);
$length_in_sec = ereg_replace("[^0-9]","",$length_in_sec);
$phone_code = ereg_replace("[^0-9]","",$phone_code);
$phone_number = ereg_replace("[^0-9]","",$phone_number);
}

# default optional vars if not set
if (!isset($format))   {$format="text";}
	if ($format == 'debug')	{$DB=1;}
if (!isset($ACTION))   {$ACTION="refresh";}
if (!isset($query_date)) {$query_date = $NOW_DATE;}

if ($ACTION == 'LogiNCamPaigns')
	{
	$skip_user_validation=1;
	}
else
	{
	$stmt="SELECT count(*) from vicidial_users where user='$user' and pass='$pass' and user_level > 0;";
	if ($DB) {echo "|$stmt|\n";}
	if ($non_latin > 0) {$rslt=mysql_query("SET NAMES 'UTF8'");}
	$rslt=mysql_query($stmt, $link);
		if ($mel > 0) {mysql_error_logging($NOW_TIME,$link,$mel,$stmt,'00002',$user,$server_ip,$session_name,$one_mysql_log);}
	$row=mysql_fetch_row($rslt);
	$auth=$row[0];

	if( (strlen($user)<2) or (strlen($pass)<2) or ($auth==0))
	{
	echo "Nieprawidłowy NazwaUżytkownika/Hasło: |$user|$pass|\n";
	exit;
	}
	else
	{
	if( (strlen($server_ip)<6) or (!isset($server_ip)) or ( (strlen($session_name)<12) or (!isset($session_name)) ) )
		{
		echo "Nieprawidłowy server_ip: |$server_ip|  or  Nieprawidłowy session_name: |$session_name|\n";
		exit;
		}
	else
		{
		$stmt="SELECT count(*) from web_client_sessions where session_name='$session_name' and server_ip='$server_ip';";
		if ($DB) {echo "|$stmt|\n";}
		$rslt=mysql_query($stmt, $link);
			if ($mel > 0) {mysql_error_logging($NOW_TIME,$link,$mel,$stmt,'00003',$user,$server_ip,$session_name,$one_mysql_log);}
		$row=mysql_fetch_row($rslt);
		$SNauth=$row[0];
		  if($SNauth==0)
			{
			echo "Nieprawidłowy session_name: |$session_name|$server_ip|\n";
			exit;
			}
		  else
			{
			# do nothing for now
			}
		}
	}
}

if ($format=='debug')
{
echo "<html>\n";
echo "<head>\n";
echo "<!-- WERSJA: $version     KOMPILACJA: $build    USER: $user   server_ip: $server_ip-->\n";
echo "<title>VICIDiaL Skrypt zapytań do bazy danych";
echo "</title>\n";
echo "</head>\n";
echo "<BODY BGCOLOR=white marginheight=0 marginwidth=0 leftmargin=0 topmargin=0>\n";
}



################################################################################
### LogiNCamPaigns - generates an HTML SELECT list of allowed campaigns for a 
###                  specific agent on the login screen
################################################################################
if ($ACTION == 'LogiNCamPaigns')
	{
	if ( (strlen($user)<1) )
		{
		echo "<select size=1 name=VD_campaign id=VD_campaign onFocus=\"login_allowable_campaigns()\">\n";
		echo "<option value=\"\">-- ERROR --</option>\n";
		echo "</select>\n";
		exit;
		}
	else
		{
		$stmt="SELECT user_group,user_level,agent_shift_enforcement_override,shift_override_flag from vicidial_users where user='$user' and pass='$pass'";
		if ($non_latin > 0) {$rslt=mysql_query("SET NAMES 'UTF8'");}
		$rslt=mysql_query($stmt, $link);
			if ($mel > 0) {mysql_error_logging($NOW_TIME,$link,$mel,$stmt,'00004',$user,$server_ip,$session_name,$one_mysql_log);}
		$row=mysql_fetch_row($rslt);
		$VU_user_group =						$row[0];
		$VU_user_level =						$row[1];
		$VU_agent_shift_enforcement_override =	$row[2];
		$VU_shift_override_flag =				$row[3];

		$LOGallowed_campaignsSQL='';

		$stmt="SELECT allowed_campaigns,forced_timeclock_login,shift_enforcement,group_shifts from vicidial_user_groups where user_group='$VU_user_group';";
		$rslt=mysql_query($stmt, $link);
			if ($mel > 0) {mysql_error_logging($NOW_TIME,$link,$mel,$stmt,'00005',$user,$server_ip,$session_name,$one_mysql_log);}
		$row=mysql_fetch_row($rslt);
		$forced_timeclock_login =	$row[1];
		$shift_enforcement =		$row[2];
		$LOGgroup_shiftsSQL = eregi_replace('  ','',$row[3]);
		$LOGgroup_shiftsSQL = eregi_replace(' ',"','",$LOGgroup_shiftsSQL);
		$LOGgroup_shiftsSQL = "shift_id IN('$LOGgroup_shiftsSQL')";
		if ( (!eregi("ALL-CAMPAIGNS",$row[0])) )
			{
			$LOGallowed_campaignsSQL = eregi_replace(' -','',$row[0]);
			$LOGallowed_campaignsSQL = eregi_replace(' ',"','",$LOGallowed_campaignsSQL);
			$LOGallowed_campaignsSQL = "and campaign_id IN('$LOGallowed_campaignsSQL')";
			}

		$show_campaign_list=1;
		### CHECK TO SEE IF AGENT IS LOGGED IN TO TIMECLOCK, IF NOT, OUTPUT ERROR
		if ( (ereg('Y',$forced_timeclock_login)) or ( (ereg('ADMIN_EXEMPT',$forced_timeclock_login)) and ($VU_user_level < 8) ) )
			{
			$last_agent_event='';
			$HHMM = date("Hi");
			$HHteod = substr($timeclock_end_of_day,0,2);
			$MMteod = substr($timeclock_end_of_day,2,2);

			if ($HHMM < $timeclock_end_of_day)
				{$EoD = mktime($HHteod, $MMteod, 10, date("m"), date("d")-1, date("Y"));}
			else
				{$EoD = mktime($HHteod, $MMteod, 10, date("m"), date("d"), date("Y"));}

			$EoDdate = date("Y-m-d H:i:s", $EoD);

			##### grab timeclock logged-in time for each user #####
			$stmt="SELECT event from vicidial_timeclock_log where user='$user' and event_epoch >= '$EoD' order by timeclock_id desc limit 1;";
			if ($DB>0) {echo "|$stmt|";}
			$rslt=mysql_query($stmt, $link);
			if ($mel > 0) {mysql_error_logging($NOW_TIME,$link,$mel,$stmt,'00184',$user,$server_ip,$session_name,$one_mysql_log);}
			$events_to_parse = mysql_num_rows($rslt);
			if ($events_to_parse > 0)
				{
				$rowx=mysql_fetch_row($rslt);
				$last_agent_event = $rowx[0];
				}
			if ( (strlen($last_agent_event)<2) or (ereg('WYLOGUJ',$last_agent_event)) )
				{$show_campaign_list=0;}
			}
		}

	### CHECK TO SEE IF AGENT IS WITHIN THEIR SHIFT IF RESTRICTED, IF NOT, OUTPUT ERROR
	if ( ( (ereg("START|ALL",$shift_enforcement)) and (!ereg("OFF",$VU_agent_shift_enforcement_override)) ) or (ereg("START|ALL",$VU_agent_shift_enforcement_override)) )
		{
		$shift_ok=0;
		if ( (strlen($LOGgroup_shiftsSQL) < 3) and ($VU_shift_override_flag < 1) )
			{
			$VDdisplayMESSAGE = "<B>BŁĄD: Brak Przesuwa aktywny dla grupy użytkowników</B>\n";
			$VDloginDISPLAY=1;
			}
		else
			{
			$HHMM = date("Hi");
			$wday = date("w");

			$stmt="SELECT shift_id,shift_start_time,shift_length,shift_weekdays from vicidial_shifts where $LOGgroup_shiftsSQL order by shift_id";
			$rslt=mysql_query($stmt, $link);
				if ($mel > 0) {mysql_error_logging($NOW_TIME,$link,$mel,$stmt,'00193',$user,$server_ip,$session_name,$one_mysql_log);}
			$shifts_to_print = mysql_num_rows($rslt);

			$o=0;
			while ( ($shifts_to_print > $o) and ($shift_ok < 1) )
				{
				$rowx=mysql_fetch_row($rslt);
				$shift_id =			$rowx[0];
				$shift_start_time =	$rowx[1];
				$shift_length =		$rowx[2];
				$shift_weekdays =	$rowx[3];

				if (eregi("$wday",$shift_weekdays))
					{
					$HHshift_length = substr($shift_length,0,2);
					$MMshift_length = substr($shift_length,3,2);
					$HHshift_start_time = substr($shift_start_time,0,2);
					$MMshift_start_time = substr($shift_start_time,2,2);
					$HHshift_end_time = ($HHshift_length + $HHshift_start_time);
					$MMshift_end_time = ($MMshift_length + $MMshift_start_time);
					if ($MMshift_end_time > 59)
						{
						$MMshift_end_time = ($MMshift_end_time - 60);
						$HHshift_end_time++;
						}
					if ($HHshift_end_time > 23)
						{$HHshift_end_time = ($HHshift_end_time - 24);}
					$HHshift_end_time = sprintf("%02s", $HHshift_end_time);	
					$MMshift_end_time = sprintf("%02s", $MMshift_end_time);	
					$shift_end_time = "$HHshift_end_time$MMshift_end_time";

					if ( 
						( ($HHMM >= $shift_start_time) and ($HHMM < $shift_end_time) ) or
						( ($HHMM < $shift_start_time) and ($HHMM < $shift_end_time) and ($shift_end_time <= $shift_start_time) ) or
						( ($HHMM >= $shift_start_time) and ($HHMM >= $shift_end_time) and ($shift_end_time <= $shift_start_time) )
					   )
						{$shift_ok++;}
					}
				$o++;
				}

			if ( ($shift_ok < 1) and ($VU_shift_override_flag < 1) )
				{
				$VDdisplayMESSAGE = "<B>BŁĄD: Nie masz uprawnień, aby zalogować się poza swoim zmiany</B>\n";
				$VDloginDISPLAY=1;
				}
			}
		if ($VDloginDISPLAY > 0)
			{
			$loginDATE = date("Ymd");
			$VDdisplayMESSAGE.= "<BR><BR>KIEROWNIK nadrzędne:<BR>\n";
			$VDdisplayMESSAGE.= "<FORM ACTION=\"$PHP_SELF\" METHOD=POST>\n";
			$VDdisplayMESSAGE.= "<INPUT TYPE=HIDDEN NAME=MGR_override VALUE=\"1\">\n";
			$VDdisplayMESSAGE.= "<INPUT TYPE=HIDDEN NAME=relogin VALUE=\"YES\">\n";
			$VDdisplayMESSAGE.= "<INPUT TYPE=HIDDEN NAME=VD_login VALUE=\"$user\">\n";
			$VDdisplayMESSAGE.= "<INPUT TYPE=HIDDEN NAME=VD_pass VALUE=\"$pass\">\n";
			$VDdisplayMESSAGE.= "Manager Login: <INPUT TYPE=TEXT NAME=\"MGR_login$loginDATE\" SIZE=10 maxlength=20><br>\n";
			$VDdisplayMESSAGE.= "Manager Hasło: <INPUT TYPE=PASSWORD NAME=\"MGR_pass$loginDATE\" SIZE=10 maxlength=20><br>\n";
			$VDdisplayMESSAGE.= "<INPUT TYPE=Submit NAME=ZATWIERDŹ VALUE=ZATWIERDŹ></FORM><BR><BR><BR><BR>\n";
			echo "$VDdisplayMESSAGE";
			exit;
			}
		}

	if ($show_campaign_list > 0)
		{
		$stmt="SELECT campaign_id,campaign_name from vicidial_campaigns where active='Y' $LOGallowed_campaignsSQL order by campaign_id";
		$rslt=mysql_query($stmt, $link);
			if ($mel > 0) {mysql_error_logging($NOW_TIME,$link,$mel,$stmt,'00006',$user,$server_ip,$session_name,$one_mysql_log);}
		$camps_to_print = mysql_num_rows($rslt);

		echo "<select size=1 name=VD_campaign id=VD_campaign>\n";
		echo "<option value=\"\">-- PLEASE SELECT A CAMPAIGN --</option>\n";

		$o=0;
		while ($camps_to_print > $o) 
			{
			$rowx=mysql_fetch_row($rslt);
			echo "<option value=\"$rowx[0]\">$rowx[0] - $rowx[1]</option>\n";
			$o++;
			}
		echo "</select>\n";
		}
	else
		{
		echo "<select size=1 name=VD_campaign id=VD_campaign onFocus=\"login_allowable_campaigns()\">\n";
		echo "<option value=\"\">-- Należy zalogować się do TIMECLOCK PIERWSZEJ --</option>\n";
		echo "</select>\n";
		}
	exit;
	}



################################################################################
### regCLOSER - update the vicidial_live_agents table to reflect the closer
###             inbound choices made upon login
################################################################################
if ($ACTION == 'regCLOSER')
{
	$row='';   $rowx='';
	$channel_live=1;
	if ( (strlen($closer_choice)<1) || (strlen($user)<1) )
	{
	$channel_live=0;
	echo "Wybór grupowy $closer_choice nie jest prawidłowy\n";
	exit;
	}
	else
	{
		if ($closer_choice == "MGRLOCK-")
		{
		$stmt="SELECT closer_campaigns FROM vicidial_users where user='$user' LIMIT 1;";
		$rslt=mysql_query($stmt, $link);
			if ($mel > 0) {mysql_error_logging($NOW_TIME,$link,$mel,$stmt,'00007',$user,$server_ip,$session_name,$one_mysql_log);}
		if ($DB) {echo "$stmt\n";}
			$row=mysql_fetch_row($rslt);
			$closer_choice =$row[0];

		$stmt="UPDATE vicidial_live_agents set closer_campaigns='$closer_choice' where user='$user' and server_ip='$server_ip';";
			if ($format=='debug') {echo "\n<!-- $stmt -->";}
		$rslt=mysql_query($stmt, $link);
			if ($mel > 0) {mysql_error_logging($NOW_TIME,$link,$mel,$stmt,'00008',$user,$server_ip,$session_name,$one_mysql_log);}
		}
		else
		{
		$stmt="UPDATE vicidial_live_agents set closer_campaigns='$closer_choice' where user='$user' and server_ip='$server_ip';";
			if ($format=='debug') {echo "\n<!-- $stmt -->";}
		$rslt=mysql_query($stmt, $link);
			if ($mel > 0) {mysql_error_logging($NOW_TIME,$link,$mel,$stmt,'00009',$user,$server_ip,$session_name,$one_mysql_log);}

		$stmt="UPDATE vicidial_users set closer_campaigns='$closer_choice' where user='$user';";
			if ($format=='debug') {echo "\n<!-- $stmt -->";}
		$rslt=mysql_query($stmt, $link);
			if ($mel > 0) {mysql_error_logging($NOW_TIME,$link,$mel,$stmt,'00010',$user,$server_ip,$session_name,$one_mysql_log);}
		}

	$stmt="INSERT INTO vicidial_user_closer_log set user='$user',campaign_id='$campaign',event_date='$NOW_TIME',blended='$closer_blended',closer_campaigns='$closer_choice';";
		if ($format=='debug') {echo "\n<!-- $stmt -->";}
	$rslt=mysql_query($stmt, $link);
			if ($mel > 0) {mysql_error_logging($NOW_TIME,$link,$mel,$stmt,'00011',$user,$server_ip,$session_name,$one_mysql_log);}

	$stmt="DELETE FROM vicidial_live_inbound_agents where user='$user';";
		if ($format=='debug') {echo "\n<!-- $stmt -->";}
	$rslt=mysql_query($stmt, $link);
			if ($mel > 0) {mysql_error_logging($NOW_TIME,$link,$mel,$stmt,'00012',$user,$server_ip,$session_name,$one_mysql_log);}

	$in_groups_pre = preg_replace('/-$/','',$closer_choice);
	$in_groups = explode(" ",$in_groups_pre);
	$in_groups_ct = count($in_groups);
	$k=1;
	while ($k < $in_groups_ct)
		{
		if (strlen($in_groups[$k])>1)
			{
			$stmt="SELECT group_weight,calls_today FROM vicidial_inbound_group_agents where user='$user' and group_id='$in_groups[$k]';";
			$rslt=mysql_query($stmt, $link);
			if ($mel > 0) {mysql_error_logging($NOW_TIME,$link,$mel,$stmt,'00013',$user,$server_ip,$session_name,$one_mysql_log);}
			if ($DB) {echo "$stmt\n";}
			$viga_ct = mysql_num_rows($rslt);
			if ($viga_ct > 0)
				{
				$row=mysql_fetch_row($rslt);
				$group_weight = $row[0];
				$calls_today =	$row[1];
				}
			else
				{
				$group_weight = 0;
				$calls_today =	0;
				}
			$stmt="INSERT INTO vicidial_live_inbound_agents set user='$user',group_id='$in_groups[$k]',group_weight='$group_weight',calls_today='$calls_today',last_call_time='$NOW_TIME',last_call_finish='$NOW_TIME';";
				if ($format=='debug') {echo "\n<!-- $stmt -->";}
			$rslt=mysql_query($stmt, $link);
			if ($mel > 0) {mysql_error_logging($NOW_TIME,$link,$mel,$stmt,'00014',$user,$server_ip,$session_name,$one_mysql_log);}
			}
		$k++;
		}

	}
	echo "Closer In Wybór grupowy $closer_choice został zarejestrowny dla użytkownika $user\n";
}


################################################################################
### manDiaLnextCALL - for manual VICIDiaL dialing this will grab the next lead
###                   in the campaign, reserve it, send data back to client and
###                   place the call by inserting into vicidial_manager
################################################################################
if ($ACTION == 'manDiaLnextCaLL')
{
	$MT[0]='';
	$row='';   $rowx='';
	$channel_live=1;
	if ( (strlen($conf_exten)<1) || (strlen($campaign)<1)  || (strlen($ext_context)<1) )
	{
	$channel_live=0;
	echo "Zasobnik pusty\n";
	echo "Conf Exten $conf_exten or campaign $campaign or ext_context $ext_context nie jest prawidłowy\n";
	exit;
	}
	else
	{

	##### grab number of calls today in this campaign and increment
	$stmt="SELECT calls_today FROM vicidial_live_agents WHERE user='$user' and campaign_id='$campaign';";
	$rslt=mysql_query($stmt, $link);
		if ($mel > 0) {mysql_error_logging($NOW_TIME,$link,$mel,$stmt,'00015',$user,$server_ip,$session_name,$one_mysql_log);}
	if ($DB) {echo "$stmt\n";}
	$vla_cc_ct = mysql_num_rows($rslt);
	if ($vla_cc_ct > 0)
		{
		$row=mysql_fetch_row($rslt);
		$calls_today =$row[0];
		}
	else
		{$calls_today ='0';}
	$calls_today++;

	### check if this is a callback, if it is, skip the grabbing of a new lead and mark the callback as INACTIVE
	if ( (strlen($callback_id)>0) and (strlen($lead_id)>0) )
		{
		$affected_rows=1;
		$CBleadIDset=1;

		$stmt = "UPDATE vicidial_callbacks set status='INACTIVE' where callback_id='$callback_id';";
		if ($DB) {echo "$stmt\n";}
		$rslt=mysql_query($stmt, $link);
			if ($mel > 0) {mysql_error_logging($NOW_TIME,$link,$mel,$stmt,'00016',$user,$server_ip,$session_name,$one_mysql_log);}
		}
	else
		{
		if (strlen($phone_number)>3)
			{
			if (ereg("DNC",$manual_dial_filter))
				{
				$stmt="SELECT count(*) FROM vicidial_dnc where phone_number='$phone_number';";
				$rslt=mysql_query($stmt, $link);
			if ($mel > 0) {mysql_error_logging($NOW_TIME,$link,$mel,$stmt,'00017',$user,$server_ip,$session_name,$one_mysql_log);}
				if ($DB) {echo "$stmt\n";}
				$row=mysql_fetch_row($rslt);
				
				if ($row[0] > 0)
					{
					echo "DNC NUMER\n";
					exit;
					}
				$stmt="SELECT count(*) FROM vicidial_campaign_dnc where phone_number='$phone_number' and campaign_id='$campaign';";
				$rslt=mysql_query($stmt, $link);
			if ($mel > 0) {mysql_error_logging($NOW_TIME,$link,$mel,$stmt,'00018',$user,$server_ip,$session_name,$one_mysql_log);}
				if ($DB) {echo "$stmt\n";}
				$row=mysql_fetch_row($rslt);
				
				if ($row[0] > 0)
					{
					echo "DNC NUMER\n";
					exit;
					}
				}
			if (ereg("CAMPLISTS",$manual_dial_filter))
				{
				$stmt="SELECT list_id,active from vicidial_lists where campaign_id='$campaign'";
				$rslt=mysql_query($stmt, $link);
			if ($mel > 0) {mysql_error_logging($NOW_TIME,$link,$mel,$stmt,'00019',$user,$server_ip,$session_name,$one_mysql_log);}
				$lists_to_parse = mysql_num_rows($rslt);
				$camp_lists='';
				$o=0;
				while ($lists_to_parse > $o) 
					{
					$rowx=mysql_fetch_row($rslt);
					if (ereg("Y", $rowx[1])) {$active_lists++;   $camp_lists .= "'$rowx[0]',";}
					if (ereg("N", $rowx[1])) {$inactive_lists++;}
					$o++;
					}
				$camp_lists = eregi_replace(".$","",$camp_lists);

				$stmt="SELECT count(*) FROM vicidial_list where phone_number='$phone_number' and list_id IN($camp_lists);";
				$rslt=mysql_query($stmt, $link);
			if ($mel > 0) {mysql_error_logging($NOW_TIME,$link,$mel,$stmt,'00020',$user,$server_ip,$session_name,$one_mysql_log);}
				if ($DB) {echo "$stmt\n";}
				$row=mysql_fetch_row($rslt);
				
				if ($row[0] < 1)
					{
					echo "NUMER NOT IN CAMPLISTS\n";
					exit;
					}
				}
			if ($stage=='lookup')
				{
				if (strlen($vendor_lead_code)>0)
					{
					$stmt="SELECT lead_id FROM vicidial_list where vendor_lead_code='$vendor_lead_code' order by modify_date desc LIMIT 1;";
					$rslt=mysql_query($stmt, $link);
				if ($mel > 0) {mysql_error_logging($NOW_TIME,$link,$mel,$stmt,'00021',$user,$server_ip,$session_name,$one_mysql_log);}
					if ($DB) {echo "$stmt\n";}
					$man_leadID_ct = mysql_num_rows($rslt);
					if ( ($man_leadID_ct > 0) and (strlen($phone_number) > 5) )
						{$override_phone++;}
					}
				else
					{
					$stmt="SELECT lead_id FROM vicidial_list where phone_number='$phone_number' order by modify_date desc LIMIT 1;";
					$rslt=mysql_query($stmt, $link);
				if ($mel > 0) {mysql_error_logging($NOW_TIME,$link,$mel,$stmt,'00021',$user,$server_ip,$session_name,$one_mysql_log);}
					if ($DB) {echo "$stmt\n";}
					$man_leadID_ct = mysql_num_rows($rslt);
					}
				if ($man_leadID_ct > 0)
					{
					$row=mysql_fetch_row($rslt);
					$affected_rows=1;
					$lead_id =$row[0];
					$CBleadIDset=1;
					}
				else
					{
					### insert a new lead in the system with this phone number
					$stmt = "INSERT INTO vicidial_list SET phone_code='$phone_code',phone_number='$phone_number',list_id='$list_id',status='QUEUE',user='$user',called_since_last_reset='Y',entry_date='$ENTRYdate',last_local_call_time='$NOW_TIME',vendor_lead_code='$vendor_lead_code';";
					if ($DB) {echo "$stmt\n";}
					$rslt=mysql_query($stmt, $link);
			if ($mel > 0) {mysql_error_logging($NOW_TIME,$link,$mel,$stmt,'00022',$user,$server_ip,$session_name,$one_mysql_log);}
					$affected_rows = mysql_affected_rows($link);
					$lead_id = mysql_insert_id($link);
					$CBleadIDset=1;
					}
				}
			else
				{
				### insert a new lead in the system with this phone number
				$stmt = "INSERT INTO vicidial_list SET phone_code='$phone_code',phone_number='$phone_number',list_id='$list_id',status='QUEUE',user='$user',called_since_last_reset='Y',entry_date='$ENTRYdate',last_local_call_time='$NOW_TIME';";
				if ($DB) {echo "$stmt\n";}
				$rslt=mysql_query($stmt, $link);
			if ($mel > 0) {mysql_error_logging($NOW_TIME,$link,$mel,$stmt,'00023',$user,$server_ip,$session_name,$one_mysql_log);}
				$affected_rows = mysql_affected_rows($link);
				$lead_id = mysql_insert_id($link);
				$CBleadIDset=1;
				}
			}
		else
			{
			### grab the next lead in the hopper for this campaign and reserve it for the user
			$stmt = "UPDATE vicidial_hopper set status='QUEUE', user='$user' where campaign_id='$campaign' and status='READY' order by priority desc,hopper_id LIMIT 1";
			if ($DB) {echo "$stmt\n";}
			$rslt=mysql_query($stmt, $link);
			if ($mel > 0) {mysql_error_logging($NOW_TIME,$link,$mel,$stmt,'00024',$user,$server_ip,$session_name,$one_mysql_log);}
			$affected_rows = mysql_affected_rows($link);
			}
		}

	if ($affected_rows > 0)
		{
		if (!$CBleadIDset)
			{
			##### grab the lead_id of the reserved user in vicidial_hopper
			$stmt="SELECT lead_id FROM vicidial_hopper where campaign_id='$campaign' and status='QUEUE' and user='$user' LIMIT 1;";
			$rslt=mysql_query($stmt, $link);
			if ($mel > 0) {mysql_error_logging($NOW_TIME,$link,$mel,$stmt,'00025',$user,$server_ip,$session_name,$one_mysql_log);}
			if ($DB) {echo "$stmt\n";}
			$hopper_leadID_ct = mysql_num_rows($rslt);
			if ($hopper_leadID_ct > 0)
				{
				$row=mysql_fetch_row($rslt);
				$lead_id =$row[0];
				}
			}

			##### grab the data from vicidial_list for the lead_id
			$stmt="SELECT * FROM vicidial_list where lead_id='$lead_id' LIMIT 1;";
			$rslt=mysql_query($stmt, $link);
			if ($mel > 0) {mysql_error_logging($NOW_TIME,$link,$mel,$stmt,'00026',$user,$server_ip,$session_name,$one_mysql_log);}
			if ($DB) {echo "$stmt\n";}
			$list_lead_ct = mysql_num_rows($rslt);
			if ($list_lead_ct > 0)
				{
				$row=mysql_fetch_row($rslt);
			#	$lead_id		= trim("$row[0]");
				$dispo			= trim("$row[3]");
				$tsr			= trim("$row[4]");
				$vendor_id		= trim("$row[5]");
				$source_id		= trim("$row[6]");
				$list_id		= trim("$row[7]");
				$gmt_offset_now	= trim("$row[8]");
				$called_since_last_reset = trim("$row[9]");
				$phone_code		= trim("$row[10]");
				if ($override_phone < 1)
					{$phone_number	= trim("$row[11]");}
				$title			= trim("$row[12]");
				$first_name		= trim("$row[13]");
				$middle_initial	= trim("$row[14]");
				$last_name		= trim("$row[15]");
				$address1		= trim("$row[16]");
				$address2		= trim("$row[17]");
				$address3		= trim("$row[18]");
				$city			= trim("$row[19]");
				$state			= trim("$row[20]");
				$province		= trim("$row[21]");
				$postal_code	= trim("$row[22]");
				$country_code	= trim("$row[23]");
				$gender			= trim("$row[24]");
				$date_of_birth	= trim("$row[25]");
				$alt_phone		= trim("$row[26]");
				$email			= trim("$row[27]");
				$security		= trim("$row[28]");
				$comments		= stripslashes(trim("$row[29]"));
				$called_count	= trim("$row[30]");
				}

			$called_count++;

			##### check if system is set to generate logfile for transfers
			$stmt="SELECT enable_agc_xfer_log FROM system_settings;";
			$rslt=mysql_query($stmt, $link);
			if ($mel > 0) {mysql_error_logging($NOW_TIME,$link,$mel,$stmt,'00027',$user,$server_ip,$session_name,$one_mysql_log);}
			if ($DB) {echo "$stmt\n";}
			$enable_agc_xfer_log_ct = mysql_num_rows($rslt);
			if ($enable_agc_xfer_log_ct > 0)
				{
				$row=mysql_fetch_row($rslt);
				$enable_agc_xfer_log =$row[0];
				}

			if ( ($WeBRooTWritablE > 0) and ($enable_agc_xfer_log > 0) )
				{
				# generate callerID for unique identifier in xfer_log file
				$PADlead_id = sprintf("%09s", $lead_id);
					while (strlen($PADlead_id) > 9) {$PADlead_id = substr("$PADlead_id", 0, -1);}
				# Create unique calleridname to track the call: MmmddhhmmssLLLLLLLLL
					$MqueryCID = "M$CIDdate$PADlead_id";

				#	DATETIME|campaign|lead_id|phone_number|user|type
				#	2007-08-22 11:11:11|TESTCAMP|65432|3125551212|1234|M
				$fp = fopen ("./xfer_log.txt", "a");
				fwrite ($fp, "$NOW_TIME|$campaign|$lead_id|$phone_number|$user|M|$MqueryCID|\n");
				fclose($fp);
				}

			##### if lead is a callback, grab the callback comments
			$CBentry_time =		'';
			$CBcallback_time =	'';
			$CBuser =			'';
			$CBcomments =		'';
			if (ereg("CALLBK",$dispo))
				{
				$stmt="SELECT entry_time,callback_time,user,comments FROM vicidial_callbacks where lead_id='$lead_id' order by callback_id desc LIMIT 1;";
				$rslt=mysql_query($stmt, $link);
			if ($mel > 0) {mysql_error_logging($NOW_TIME,$link,$mel,$stmt,'00028',$user,$server_ip,$session_name,$one_mysql_log);}
				if ($DB) {echo "$stmt\n";}
				$cb_record_ct = mysql_num_rows($rslt);
				if ($cb_record_ct > 0)
					{
					$row=mysql_fetch_row($rslt);
					$CBentry_time =		trim("$row[0]");
					$CBcallback_time =	trim("$row[1]");
					$CBuser =			trim("$row[2]");
					$CBcomments =		trim("$row[3]");
					}
				}

			$stmt = "SELECT local_gmt FROM servers where active='Y' limit 1;";
			$rslt=mysql_query($stmt, $link);
			if ($mel > 0) {mysql_error_logging($NOW_TIME,$link,$mel,$stmt,'00029',$user,$server_ip,$session_name,$one_mysql_log);}
			if ($DB) {echo "$stmt\n";}
			$server_ct = mysql_num_rows($rslt);
			if ($server_ct > 0)
				{
				$row=mysql_fetch_row($rslt);
				$local_gmt =	$row[0];
				}
			$LLCT_DATE_offset = ($local_gmt - $gmt_offset_now);
			$LLCT_DATE = date("Y-m-d H:i:s", mktime(date("H")-$LLCT_DATE_offset,date("i"),date("s"),date("m"),date("d"),date("Y")));

			if (ereg('Y',$called_since_last_reset))
				{
				$called_since_last_reset = ereg_replace('Y','',$called_since_last_reset);
				if (strlen($called_since_last_reset) < 1) {$called_since_last_reset = 0;}
				$called_since_last_reset++;
				$called_since_last_reset = "Y$called_since_last_reset";
				}
			else {$called_since_last_reset = 'Y';}
			### flag the lead as called and change it's status to INCALL
			$stmt = "UPDATE vicidial_list set status='INCALL', called_since_last_reset='$called_since_last_reset', called_count='$called_count',user='$user',last_local_call_time='$LLCT_DATE' where lead_id='$lead_id';";
			if ($DB) {echo "$stmt\n";}
			$rslt=mysql_query($stmt, $link);
			if ($mel > 0) {mysql_error_logging($NOW_TIME,$link,$mel,$stmt,'00030',$user,$server_ip,$session_name,$one_mysql_log);}

			if (!$CBleadIDset)
				{
				### delete the lead from the hopper
				$stmt = "DELETE FROM vicidial_hopper where lead_id='$lead_id';";
				if ($DB) {echo "$stmt\n";}
				$rslt=mysql_query($stmt, $link);
			if ($mel > 0) {mysql_error_logging($NOW_TIME,$link,$mel,$stmt,'00031',$user,$server_ip,$session_name,$one_mysql_log);}
				}

			$stmt="UPDATE vicidial_agent_log set lead_id='$lead_id',comments='MANUAL' where agent_log_id='$agent_log_id';";
				if ($format=='debug') {echo "\n<!-- $stmt -->";}
			$rslt=mysql_query($stmt, $link);
			if ($mel > 0) {mysql_error_logging($NOW_TIME,$link,$mel,$stmt,'00032',$user,$server_ip,$session_name,$one_mysql_log);}
		
			### if preview dialing, do not send the call	
			if ( (strlen($preview)<1) || ($preview == 'NO') )
				{
				### prepare variables to place manual call from VICIDiaL
				$CCID_on=0;   $CCID='';
				$local_DEF = 'Local/';
				$local_AMP = '@';
				$Local_out_prefix = '9';
				$Local_dial_timeout = '60';
			#	$Local_persist = '/n';
                                $Local_persist = '';
				if ($dial_timeout > 4) {$Local_dial_timeout = $dial_timeout;}
				$Local_dial_timeout = ($Local_dial_timeout * 1000);
				if (strlen($dial_prefix) > 0) {$Local_out_prefix = "$dial_prefix";}
				if (strlen($campaign_cid) > 6) {$CCID = "$campaign_cid";   $CCID_on++;}
				if (eregi("x",$dial_prefix)) {$Local_out_prefix = '';}

				$PADlead_id = sprintf("%09s", $lead_id);
					while (strlen($PADlead_id) > 9) {$PADlead_id = substr("$PADlead_id", 0, -1);}

				# Create unique calleridname to track the call: MmmddhhmmssLLLLLLLLL
					$MqueryCID = "M$CIDdate$PADlead_id";
				if ($CCID_on) {$CIDstring = "\"$MqueryCID\" <$CCID>";}
				else {$CIDstring = "$MqueryCID";}

				### whether to omit phone_code or not
				if (eregi('Y',$omit_phone_code)) 
					{$Ndialstring = "$Local_out_prefix$phone_number";}
				else
					{$Ndialstring = "$Local_out_prefix$phone_code$phone_number";}

				if ( ($usegroupalias > 0) and (strlen($account)>1) )
					{
					$RAWaccount = $account;
					$account = "Account: $account";
					$variable = "Variable: usegroupalias=1";
					}
				else
					{$account='';   $variable='';}

				### insert the call action into the vicidial_manager table to initiate the call
				#	$stmt = "INSERT INTO vicidial_manager values('','','$NOW_TIME','NEW','N','$server_ip','','Originate','$MqueryCID','Exten: $conf_exten','Context: $ext_context','Channel: $local_DEF$Local_out_prefix$phone_code$phone_number$local_AMP$ext_context','Priority: 1','Callerid: $CIDstring','Timeout: $Local_dial_timeout','','','','');";
				$stmt = "INSERT INTO vicidial_manager values('','','$NOW_TIME','NEW','N','$server_ip','','Originate','$MqueryCID','Exten: $Ndialstring','Context: $ext_context','Channel: $local_DEF$conf_exten$local_AMP$ext_context$Local_persist','Priority: 1','Callerid: $CIDstring','Timeout: $Local_dial_timeout','$account','$variable','','');";
				if ($DB) {echo "$stmt\n";}
				$rslt=mysql_query($stmt, $link);
			if ($mel > 0) {mysql_error_logging($NOW_TIME,$link,$mel,$stmt,'00033',$user,$server_ip,$session_name,$one_mysql_log);}

				$stmt = "INSERT INTO vicidial_auto_calls (server_ip,campaign_id,status,lead_id,callerid,phone_code,phone_number,call_time,call_type) values('$server_ip','$campaign','XFER','$lead_id','$MqueryCID','$phone_code','$phone_number','$NOW_TIME','OUT')";
				if ($DB) {echo "$stmt\n";}
				$rslt=mysql_query($stmt, $link);
			if ($mel > 0) {mysql_error_logging($NOW_TIME,$link,$mel,$stmt,'00034',$user,$server_ip,$session_name,$one_mysql_log);}

				### update the agent status to INCALL in vicidial_live_agents
				$stmt = "UPDATE vicidial_live_agents set status='INCALL',last_call_time='$NOW_TIME',callerid='$MqueryCID',lead_id='$lead_id',comments='MANUAL',calls_today='$calls_today',external_hangup=0,external_status='',external_pause='',external_dial='' where user='$user' and server_ip='$server_ip';";
				if ($DB) {echo "$stmt\n";}
				$rslt=mysql_query($stmt, $link);
			if ($mel > 0) {mysql_error_logging($NOW_TIME,$link,$mel,$stmt,'00035',$user,$server_ip,$session_name,$one_mysql_log);}

				### update calls_today count in vicidial_campaign_agents
				$stmt = "UPDATE vicidial_campaign_agents set calls_today='$calls_today' where user='$user' and campaign_id='$campaign';";
				if ($DB) {echo "$stmt\n";}
				$rslt=mysql_query($stmt, $link);
			if ($mel > 0) {mysql_error_logging($NOW_TIME,$link,$mel,$stmt,'00036',$user,$server_ip,$session_name,$one_mysql_log);}

				if ($agent_dialed_number > 0)
					{
					$stmt = "INSERT INTO user_call_log (user,call_date,call_type,server_ip,phone_number,number_dialed,lead_id,callerid,group_alias_id) values('$user','$NOW_TIME','$agent_dialed_type','$server_ip','$phone_number','$Ndialstring','$lead_id','$CCID','$RAWaccount')";
					if ($DB) {echo "$stmt\n";}
					$rslt=mysql_query($stmt, $link);
				if ($mel > 0) {mysql_error_logging($NOW_TIME,$link,$mel,$stmt,'00191',$user,$server_ip,$session_name,$one_mysql_log);}
					}

				#############################################
				##### START QUEUEMETRICS LOGGING LOOKUP #####
				$stmt = "SELECT enable_queuemetrics_logging,queuemetrics_server_ip,queuemetrics_dbname,queuemetrics_login,queuemetrics_pass,queuemetrics_log_id FROM system_settings;";
				$rslt=mysql_query($stmt, $link);
			if ($mel > 0) {mysql_error_logging($NOW_TIME,$link,$mel,$stmt,'00037',$user,$server_ip,$session_name,$one_mysql_log);}
				if ($DB) {echo "$stmt\n";}
				$qm_conf_ct = mysql_num_rows($rslt);
				$i=0;
				while ($i < $qm_conf_ct)
					{
					$row=mysql_fetch_row($rslt);
					$enable_queuemetrics_logging =	$row[0];
					$queuemetrics_server_ip	=		$row[1];
					$queuemetrics_dbname =			$row[2];
					$queuemetrics_login	=			$row[3];
					$queuemetrics_pass =			$row[4];
					$queuemetrics_log_id =			$row[5];
					$i++;
					}
				##### END QUEUEMETRICS LOGGING LOOKUP #####
				###########################################
				if ($enable_queuemetrics_logging > 0)
					{
					$linkB=mysql_connect("$queuemetrics_server_ip", "$queuemetrics_login", "$queuemetrics_pass");
					mysql_select_db("$queuemetrics_dbname", $linkB);

					# UNPAUSEALL
					$stmt = "INSERT INTO queue_log SET partition='P01',time_id='$StarTtime',call_id='NONE',queue='NONE',agent='Agent/$user',verb='UNPAUSEALL',serverid='$queuemetrics_log_id';";
					if ($DB) {echo "$stmt\n";}
					$rslt=mysql_query($stmt, $linkB);
			if ($mel > 0) {mysql_error_logging($NOW_TIME,$linkB,$mel,$stmt,'00038',$user,$server_ip,$session_name,$one_mysql_log);}
					$affected_rows = mysql_affected_rows($linkB);

					# ENTERQUEUE
					$stmt = "INSERT INTO queue_log SET partition='P01',time_id='$StarTtime',call_id='$MqueryCID',queue='$campaign',agent='NONE',verb='ENTERQUEUE',data2='$phone_number',serverid='$queuemetrics_log_id';";
					if ($DB) {echo "$stmt\n";}
					$rslt=mysql_query($stmt, $linkB);
			if ($mel > 0) {mysql_error_logging($NOW_TIME,$linkB,$mel,$stmt,'00039',$user,$server_ip,$session_name,$one_mysql_log);}
					$affected_rows = mysql_affected_rows($linkB);

					# CONNECT
					$stmt = "INSERT INTO queue_log SET partition='P01',time_id='$StarTtime',call_id='$MqueryCID',queue='$campaign',agent='Agent/$user',verb='CONNECT',data1='0',serverid='$queuemetrics_log_id';";
					if ($DB) {echo "$stmt\n";}
					$rslt=mysql_query($stmt, $linkB);
			if ($mel > 0) {mysql_error_logging($NOW_TIME,$linkB,$mel,$stmt,'00040',$user,$server_ip,$session_name,$one_mysql_log);}
					$affected_rows = mysql_affected_rows($linkB);

					mysql_close($linkB);
					}

				}

			$comments = eregi_replace("\r",'',$comments);
			$comments = eregi_replace("\n",'!N',$comments);

			$LeaD_InfO =	$MqueryCID . "\n";
			$LeaD_InfO .=	$lead_id . "\n";
			$LeaD_InfO .=	$dispo . "\n";
			$LeaD_InfO .=	$tsr . "\n";
			$LeaD_InfO .=	$vendor_id . "\n";
			$LeaD_InfO .=	$list_id . "\n";
			$LeaD_InfO .=	$gmt_offset_now . "\n";
			$LeaD_InfO .=	$phone_code . "\n";
			$LeaD_InfO .=	$phone_number . "\n";
			$LeaD_InfO .=	$title . "\n";
			$LeaD_InfO .=	$first_name . "\n";
			$LeaD_InfO .=	$middle_initial . "\n";
			$LeaD_InfO .=	$last_name . "\n";
			$LeaD_InfO .=	$address1 . "\n";
			$LeaD_InfO .=	$address2 . "\n";
			$LeaD_InfO .=	$address3 . "\n";
			$LeaD_InfO .=	$city . "\n";
			$LeaD_InfO .=	$state . "\n";
			$LeaD_InfO .=	$province . "\n";
			$LeaD_InfO .=	$postal_code . "\n";
			$LeaD_InfO .=	$country_code . "\n";
			$LeaD_InfO .=	$gender . "\n";
			$LeaD_InfO .=	$date_of_birth . "\n";
			$LeaD_InfO .=	$alt_phone . "\n";
			$LeaD_InfO .=	$email . "\n";
			$LeaD_InfO .=	$security . "\n";
			$LeaD_InfO .=	$comments . "\n";
			$LeaD_InfO .=	$called_count . "\n";
			$LeaD_InfO .=	$CBentry_time . "\n";
			$LeaD_InfO .=	$CBcallback_time . "\n";
			$LeaD_InfO .=	$CBuser . "\n";
			$LeaD_InfO .=	$CBcomments . "\n";
			$LeaD_InfO .=	$phone_number . "\n";
			$LeaD_InfO .=	"MAIN\n";
			$LeaD_InfO .=	$source_id . "\n";

			echo $LeaD_InfO;

		}
		else
		{
		echo "Zasobnik pusty\n";
		}
	}
}


################################################################################
### alt_phone_change - change alt phone numbers to active and inactive
### 
################################################################################
if ($ACTION == 'alt_phone_change')
{
	$MT[0]='';
	$row='';   $rowx='';
	$channel_live=1;
	if ( (strlen($stage)<1) || (strlen($called_count)<1) || (strlen($lead_id)<1)  || (strlen($phone_number)<1) )
		{
		$channel_live=0;
		echo "NUMER ALT. NUMER STATUS NOT CHANGED\n";
		echo "$phone_number $stage $lead_id or $called_count nie jest prawidłowy\n";
		exit;
		}
	else
		{
		$stmt = "UPDATE vicidial_list_alt_phones set active='$stage' where lead_id='$lead_id' and phone_number='$phone_number' and alt_phone_count='$called_count';";
		if ($DB) {echo "$stmt\n";}
		$rslt=mysql_query($stmt, $link);
			if ($mel > 0) {mysql_error_logging($NOW_TIME,$link,$mel,$stmt,'00041',$user,$server_ip,$session_name,$one_mysql_log);}

		echo "NUMER ALT. NUMER STATUS CHANGED\n";
		}
}


################################################################################
### AlertControl - change the agent alert setting in vicidial_users
### 
################################################################################
if ($ACTION == 'AlertControl')
{
	if (strlen($stage)<1)
		{
		$channel_live=0;
		echo "AGENT ALERT SETTING NOT CHANGED\n";
		echo "$stage nie jest prawidłowy\n";
		exit;
		}
	else
		{
		if (ereg('ON',$stage)) {$stage = '1';}
		else {$stage = '0';}

		$stmt = "UPDATE vicidial_users set alert_enabled='$stage' where user='$user' and pass='$pass';";
		if ($DB) {echo "$stmt\n";}
		$rslt=mysql_query($stmt, $link);
			if ($mel > 0) {mysql_error_logging($NOW_TIME,$link,$mel,$stmt,'000185',$user,$server_ip,$session_name,$one_mysql_log);}

		echo "AGENT ALERT SETTING CHANGED $stage\n";
		}
}


################################################################################
### manDiaLskip - for manual VICIDiaL dialing this skips the lead that was
###               previewed in the step above and puts it back in orig status
################################################################################
if ($ACTION == 'manDiaLskip')
{
	$MT[0]='';
	$row='';   $rowx='';
	$channel_live=1;
	if ( (strlen($stage)<1) || (strlen($called_count)<1) || (strlen($lead_id)<1) )
	{
		$channel_live=0;
		echo "LEAD NOT REVERTED\n";
		echo "Conf Exten $conf_exten or campaign $campaign or ext_context $ext_context nie jest prawidłowy\n";
		exit;
	}
	else
	{
		$called_count = ($called_count - 1);
		### flag the lead as called and change it's status to INCALL
		$stmt = "UPDATE vicidial_list set status='$stage', called_count='$called_count',user='$user' where lead_id='$lead_id';";
		if ($DB) {echo "$stmt\n";}
		$rslt=mysql_query($stmt, $link);
			if ($mel > 0) {mysql_error_logging($NOW_TIME,$link,$mel,$stmt,'00042',$user,$server_ip,$session_name,$one_mysql_log);}


		echo "LEAD REVERTED\n";
	}
}


################################################################################
### manDiaLonly - for manual VICIDiaL dialing this sends the call that was
###               previewed in the step above
################################################################################
if ($ACTION == 'manDiaLonly')
{
	$MT[0]='';
	$row='';   $rowx='';
	$channel_live=1;
	if ( (strlen($conf_exten)<1) || (strlen($campaign)<1) || (strlen($ext_context)<1) || (strlen($phone_number)<1) || (strlen($lead_id)<1) )
	{
		$channel_live=0;
		echo " Rozmowa NOT PLACED\n";
		echo "Conf Exten $conf_exten or campaign $campaign or ext_context $ext_context nie jest prawidłowy\n";
		exit;
	}
	else
	{
		##### grab number of calls today in this campaign and increment
		$stmt="SELECT calls_today FROM vicidial_live_agents WHERE user='$user' and campaign_id='$campaign';";
		$rslt=mysql_query($stmt, $link);
			if ($mel > 0) {mysql_error_logging($NOW_TIME,$link,$mel,$stmt,'00043',$user,$server_ip,$session_name,$one_mysql_log);}
		if ($DB) {echo "$stmt\n";}
		$vla_cc_ct = mysql_num_rows($rslt);
		if ($vla_cc_ct > 0)
			{
			$row=mysql_fetch_row($rslt);
			$calls_today =$row[0];
			}
		else
			{$calls_today ='0';}
		$calls_today++;

		### prepare variables to place manual call from VICIDiaL
		$CCID_on=0;   $CCID='';
		$local_DEF = 'Local/';
		$local_AMP = '@';
		$Local_out_prefix = '9';
		$Local_dial_timeout = '60';
		$Local_persist = '/n';
		if ($dial_timeout > 4) {$Local_dial_timeout = $dial_timeout;}
		$Local_dial_timeout = ($Local_dial_timeout * 1000);
		if (strlen($dial_prefix) > 0) {$Local_out_prefix = "$dial_prefix";}
		if (strlen($campaign_cid) > 6) {$CCID = "$campaign_cid";   $CCID_on++;}
		if (eregi("x",$dial_prefix)) {$Local_out_prefix = '';}

		$PADlead_id = sprintf("%09s", $lead_id);
			while (strlen($PADlead_id) > 9) {$PADlead_id = substr("$PADlead_id", 0, -1);}

		# Create unique calleridname to track the call: MmmddhhmmssLLLLLLLLL
			$MqueryCID = "M$CIDdate$PADlead_id";
		if ($CCID_on) {$CIDstring = "\"$MqueryCID\" <$CCID>";}
		else {$CIDstring = "$MqueryCID";}

		if ( ($usegroupalias > 0) and (strlen($account)>1) )
			{
			$RAWaccount = $account;
			$account = "Account: $account";
			$variable = "Variable: usegroupalias=1";
			}
		else
			{$account='';   $variable='';}

		### whether to omit phone_code or not
		if (eregi('Y',$omit_phone_code)) 
			{$Ndialstring = "$Local_out_prefix$phone_number";}
		else
			{$Ndialstring = "$Local_out_prefix$phone_code$phone_number";}
		### insert the call action into the vicidial_manager table to initiate the call
		#	$stmt = "INSERT INTO vicidial_manager values('','','$NOW_TIME','NEW','N','$server_ip','','Originate','$MqueryCID','Exten: $conf_exten','Context: $ext_context','Channel: $local_DEF$Local_out_prefix$phone_code$phone_number$local_AMP$ext_context','Priority: 1','Callerid: $CIDstring','Timeout: $Local_dial_timeout','','','','');";
		$stmt = "INSERT INTO vicidial_manager values('','','$NOW_TIME','NEW','N','$server_ip','','Originate','$MqueryCID','Exten: $Ndialstring','Context: $ext_context','Channel: $local_DEF$conf_exten$local_AMP$ext_context$Local_persist','Priority: 1','Callerid: $CIDstring','Timeout: $Local_dial_timeout','$account','$variable','','');";
		if ($DB) {echo "$stmt\n";}
		$rslt=mysql_query($stmt, $link);
			if ($mel > 0) {mysql_error_logging($NOW_TIME,$link,$mel,$stmt,'00044',$user,$server_ip,$session_name,$one_mysql_log);}

		$stmt = "INSERT INTO vicidial_auto_calls (server_ip,campaign_id,status,lead_id,callerid,phone_code,phone_number,call_time,call_type) values('$server_ip','$campaign','XFER','$lead_id','$MqueryCID','$phone_code','$phone_number','$NOW_TIME','OUT')";
		if ($DB) {echo "$stmt\n";}
		$rslt=mysql_query($stmt, $link);
			if ($mel > 0) {mysql_error_logging($NOW_TIME,$link,$mel,$stmt,'00045',$user,$server_ip,$session_name,$one_mysql_log);}

		### update the agent status to INCALL in vicidial_live_agents
		$stmt = "UPDATE vicidial_live_agents set status='INCALL',last_call_time='$NOW_TIME',callerid='$MqueryCID',lead_id='$lead_id',comments='MANUAL',calls_today='$calls_today',external_hangup=0,external_status='',external_pause='',external_dial='' where user='$user' and server_ip='$server_ip';";
		if ($DB) {echo "$stmt\n";}
		$rslt=mysql_query($stmt, $link);
			if ($mel > 0) {$errno = mysql_error_logging($NOW_TIME,$link,$mel,$stmt,'00046',$user,$server_ip,$session_name,$one_mysql_log);}
		$retry_count=0;
		while ( ($errno > 0) and ($retry_count < 9) )
			{
			$rslt=mysql_query($stmt, $link);
			$one_mysql_log=1;
			$errno = mysql_error_logging($NOW_TIME,$link,$mel,$stmt,"9046$retry_count",$user,$server_ip,$session_name,$one_mysql_log);
			$one_mysql_log=0;
			$retry_count++;
			}

		$stmt = "UPDATE vicidial_campaign_agents set calls_today='$calls_today' where user='$user' and campaign_id='$campaign';";
		if ($DB) {echo "$stmt\n";}
		$rslt=mysql_query($stmt, $link);
			if ($mel > 0) {mysql_error_logging($NOW_TIME,$link,$mel,$stmt,'00047',$user,$server_ip,$session_name,$one_mysql_log);}

		echo "$MqueryCID\n";

		if ($agent_dialed_number > 0)
			{
			$stmt = "INSERT INTO user_call_log (user,call_date,call_type,server_ip,phone_number,number_dialed,lead_id,callerid,group_alias_id) values('$user','$NOW_TIME','$agent_dialed_type','$server_ip','$phone_number','$Ndialstring','$lead_id','$CCID','$RAWaccount')";
			if ($DB) {echo "$stmt\n";}
			$rslt=mysql_query($stmt, $link);
		if ($mel > 0) {mysql_error_logging($NOW_TIME,$link,$mel,$stmt,'00192',$user,$server_ip,$session_name,$one_mysql_log);}
			}


		#############################################
		##### START QUEUEMETRICS LOGGING LOOKUP #####
		$stmt = "SELECT enable_queuemetrics_logging,queuemetrics_server_ip,queuemetrics_dbname,queuemetrics_login,queuemetrics_pass,queuemetrics_log_id FROM system_settings;";
		$rslt=mysql_query($stmt, $link);
			if ($mel > 0) {mysql_error_logging($NOW_TIME,$link,$mel,$stmt,'00048',$user,$server_ip,$session_name,$one_mysql_log);}
		if ($DB) {echo "$stmt\n";}
		$qm_conf_ct = mysql_num_rows($rslt);
		$i=0;
		while ($i < $qm_conf_ct)
			{
			$row=mysql_fetch_row($rslt);
			$enable_queuemetrics_logging =	$row[0];
			$queuemetrics_server_ip	=		$row[1];
			$queuemetrics_dbname =			$row[2];
			$queuemetrics_login	=			$row[3];
			$queuemetrics_pass =			$row[4];
			$queuemetrics_log_id =			$row[5];
			$i++;
			}
		##### END QUEUEMETRICS LOGGING LOOKUP #####
		###########################################
		if ($enable_queuemetrics_logging > 0)
			{
			$linkB=mysql_connect("$queuemetrics_server_ip", "$queuemetrics_login", "$queuemetrics_pass");
			mysql_select_db("$queuemetrics_dbname", $linkB);

			# UNPAUSEALL
			$stmt = "INSERT INTO queue_log SET partition='P01',time_id='$StarTtime',call_id='NONE',queue='NONE',agent='Agent/$user',verb='UNPAUSEALL',serverid='$queuemetrics_log_id';";
			if ($DB) {echo "$stmt\n";}
			$rslt=mysql_query($stmt, $linkB);
			if ($mel > 0) {mysql_error_logging($NOW_TIME,$linkB,$mel,$stmt,'00049',$user,$server_ip,$session_name,$one_mysql_log);}
			$affected_rows = mysql_affected_rows($linkB);

			# ENTERQUEUE
			$stmt = "INSERT INTO queue_log SET partition='P01',time_id='$StarTtime',call_id='$MqueryCID',queue='$campaign',agent='NONE',verb='ENTERQUEUE',data2='$phone_number',serverid='$queuemetrics_log_id';";
			if ($DB) {echo "$stmt\n";}
			$rslt=mysql_query($stmt, $linkB);
			if ($mel > 0) {mysql_error_logging($NOW_TIME,$linkB,$mel,$stmt,'00050',$user,$server_ip,$session_name,$one_mysql_log);}
			$affected_rows = mysql_affected_rows($linkB);

			# CONNECT
			$stmt = "INSERT INTO queue_log SET partition='P01',time_id='$StarTtime',call_id='$MqueryCID',queue='$campaign',agent='Agent/$user',verb='CONNECT',data1='0',serverid='$queuemetrics_log_id';";
			if ($DB) {echo "$stmt\n";}
			$rslt=mysql_query($stmt, $linkB);
			if ($mel > 0) {mysql_error_logging($NOW_TIME,$linkB,$mel,$stmt,'00051',$user,$server_ip,$session_name,$one_mysql_log);}
			$affected_rows = mysql_affected_rows($linkB);

			mysql_close($linkB);
			}

	}
}


################################################################################
### manDiaLlookCALL - for manual VICIDiaL dialing this will attempt to look up
###                   the trunk channel that the call was placed on
################################################################################
if ($ACTION == 'manDiaLlookCaLL')
{
	$MT[0]='';
	$row='';   $rowx='';
if (strlen($MDnextCID)<18)
	{
	echo "NO\n";
	echo "MDnextCID $MDnextCID nie jest prawidłowy\n";
	exit;
	}
else
	{
	##### look for the channel in the UPDATED vicidial_manager record of the call initiation
	$stmt="SELECT uniqueid,channel FROM vicidial_manager where callerid='$MDnextCID' and server_ip='$server_ip' and status IN('UPDATED','DEAD') LIMIT 1;";
	$rslt=mysql_query($stmt, $link);
		if ($mel > 0) {mysql_error_logging($NOW_TIME,$link,$mel,$stmt,'00052',$user,$server_ip,$session_name,$one_mysql_log);}
	if ($DB) {echo "$stmt\n";}
	$VM_mancall_ct = mysql_num_rows($rslt);
	if ($VM_mancall_ct > 0)
		{
		$row=mysql_fetch_row($rslt);
		$uniqueid =$row[0];
		$channel =$row[1];
		echo "$uniqueid\n$channel";

		$wait_sec=0;
		$stmt = "select wait_epoch,wait_sec from vicidial_agent_log where agent_log_id='$agent_log_id';";
		if ($DB) {echo "$stmt\n";}
		$rslt=mysql_query($stmt, $link);
			if ($mel > 0) {mysql_error_logging($NOW_TIME,$link,$mel,$stmt,'00053',$user,$server_ip,$session_name,$one_mysql_log);}
		$VDpr_ct = mysql_num_rows($rslt);
		if ($VDpr_ct > 0)
			{
			$row=mysql_fetch_row($rslt);
			$wait_sec = (($StarTtime - $row[0]) + $row[1]);
			}
		$stmt="UPDATE vicidial_agent_log set wait_sec='$wait_sec',wait_epoch='$StarTtime',talk_epoch='$StarTtime',lead_id='$lead_id' where agent_log_id='$agent_log_id';";
			if ($format=='debug') {echo "\n<!-- $stmt -->";}
		$rslt=mysql_query($stmt, $link);
			if ($mel > 0) {mysql_error_logging($NOW_TIME,$link,$mel,$stmt,'00054',$user,$server_ip,$session_name,$one_mysql_log);}

		$stmt="UPDATE vicidial_auto_calls set uniqueid='$uniqueid',channel='$channel' where callerid='$MDnextCID';";
			if ($format=='debug') {echo "\n<!-- $stmt -->";}
		$rslt=mysql_query($stmt, $link);
			if ($mel > 0) {mysql_error_logging($NOW_TIME,$link,$mel,$stmt,'00055',$user,$server_ip,$session_name,$one_mysql_log);}
		}
	else
		{
		echo "NO\n";
		}
	}
}



################################################################################
### manDiaLlogCALL - for manual VICIDiaL logging of calls places record in
###                  vicidial_log and then sends process to call_log entry
################################################################################
if ($ACTION == 'manDiaLlogCaLL')
{
	$MT[0]='';
	$row='';   $rowx='';
	$vidSQL='';
	$VDterm_reason='';

if ($stage == "start")
	{
	if ( (strlen($uniqueid)<1) || (strlen($lead_id)<1) || (strlen($list_id)<1) || (strlen($phone_number)<1) || (strlen($campaign)<1) )
		{
		$fp = fopen ("./vicidial_debug.txt", "a");
		fwrite ($fp, "$NOW_TIME|VL_LOG_0|$uniqueid|$lead_id|$user|$list_id|$campaign|$start_epoch|$phone_number|$agent_log_id|\n");
		fclose($fp);

		echo "Dziennik nie zapisany\n";
		echo "uniqueid $uniqueid or lead_id: $lead_id or list_id: $list_id or phone_number: $phone_number or campaign: $campaign nie jest prawidłowy\n";
		exit;
		}
	else
		{
			$user_group='';
			$stmt="SELECT user_group FROM vicidial_users where user='$user' LIMIT 1;";
			$rslt=mysql_query($stmt, $link);
			if ($mel > 0) {mysql_error_logging($NOW_TIME,$link,$mel,$stmt,'00056',$user,$server_ip,$session_name,$one_mysql_log);}
			if ($DB) {echo "$stmt\n";}
			$ug_record_ct = mysql_num_rows($rslt);
			if ($ug_record_ct > 0)
				{
				$row=mysql_fetch_row($rslt);
				$user_group =		trim("$row[0]");
				}
		##### insert log into vicidial_log for manual VICIDiaL call
		$stmt="INSERT INTO vicidial_log (uniqueid,lead_id,list_id,campaign_id,call_date,start_epoch,status,phone_code,phone_number,user,comments,processed,user_group,alt_dial) values('$uniqueid','$lead_id','$list_id','$campaign','$NOW_TIME','$StarTtime','INCALL','$phone_code','$phone_number','$user','MANUAL','N','$user_group','$alt_dial');";
		if ($DB) {echo "$stmt\n";}
		$rslt=mysql_query($stmt, $link);
			if ($mel > 0) {mysql_error_logging($NOW_TIME,$link,$mel,$stmt,'00057',$user,$server_ip,$session_name,$one_mysql_log);}
		$affected_rows = mysql_affected_rows($link);

		if ($affected_rows > 0)
			{
			echo "VICIDiaL_LOG Wstawiony: $uniqueid|$channel|$NOW_TIME\n";
			echo "$StarTtime\n";
			}
		else
			{
			echo "Dziennik nie zapisany\n";
			}

		$stmt = "UPDATE vicidial_auto_calls SET uniqueid='$uniqueid' where lead_id='$lead_id';";
		if ($DB) {echo "$stmt\n";}
		$rslt=mysql_query($stmt, $link);
			if ($mel > 0) {mysql_error_logging($NOW_TIME,$link,$mel,$stmt,'00058',$user,$server_ip,$session_name,$one_mysql_log);}

	#	##### insert log into call_log for manual VICIDiaL call
	#	$stmt = "INSERT INTO call_log (uniqueid,channel,server_ip,extension,number_dialed,caller_code,start_time,start_epoch) values('$uniqueid','$channel','$server_ip','$exten','$phone_code$phone_number','MD $user $lead_id','$NOW_TIME','$StarTtime')";
	#	if ($DB) {echo "$stmt\n";}
	#	$rslt=mysql_query($stmt, $link);
	#	$affected_rows = mysql_affected_rows($link);

	#	if ($affected_rows > 0)
	#		{
	#		echo "CALL_LOG Wstawiony: $uniqueid|$channel|$NOW_TIME";
	#		}
	#	else
	#		{
	#		echo "Dziennik nie zapisany\n";
	#		}
		}
	}

if ($stage == "end")
	{
	##### get call type from vicidial_live_agents table
	$VLA_inOUT='NONE';
	$stmt="SELECT comments FROM vicidial_live_agents where user='$user' order by last_update_time desc limit 1;";
	$rslt=mysql_query($stmt, $link);
			if ($mel > 0) {mysql_error_logging($NOW_TIME,$link,$mel,$stmt,'00059',$user,$server_ip,$session_name,$one_mysql_log);}
	if ($DB) {echo "$stmt\n";}
	$VLA_inOUT_ct = mysql_num_rows($rslt);
	if ($VLA_inOUT_ct > 0)
		{
		$row=mysql_fetch_row($rslt);
		$VLA_inOUT =		$row[0];
		}

	if ( (strlen($uniqueid)<1) and ($VLA_inOUT == 'INBOUND') )
		{
		$fp = fopen ("./vicidial_debug.txt", "a");
		fwrite ($fp, "$NOW_TIME|INBND_LOG_0|$uniqueid|$lead_id|$user|$inOUT|$VLA_inOUT|$start_epoch|$phone_number|$agent_log_id|\n");
		fclose($fp);
		$uniqueid='6666.1';
		}
	if ( (strlen($uniqueid)<1) or (strlen($lead_id)<1) )
		{
		echo "Dziennik nie zapisany\n";
		echo "uniqueid $uniqueid or lead_id: $lead_id nie jest prawidłowy\n";
		exit;
		}
	else
		{
		$term_reason='NONE';
		if ($start_epoch < 1000)
			{
			if ($VLA_inOUT == 'INBOUND')
				{
				$four_hours_ago = date("Y-m-d H:i:s", mktime(date("H")-4,date("i"),date("s"),date("m"),date("d"),date("Y")));

				##### look for the start epoch in the vicidial_closer_log table
				$stmt="SELECT start_epoch,term_reason,closecallid,campaign_id FROM vicidial_closer_log where phone_number='$phone_number' and lead_id='$lead_id' and user='$user' and call_date > \"$four_hours_ago\" order by closecallid desc limit 1;";
				$VDIDselect =		"VDCL_LID $lead_id $phone_number $user $four_hours_ago";
				}
			else
				{
				##### look for the start epoch in the vicidial_log table
				$stmt="SELECT start_epoch,term_reason,uniqueid,campaign_id FROM vicidial_log where uniqueid='$uniqueid' and lead_id='$lead_id' order by call_date desc limit 1;";
				$VDIDselect =		"VDL_UIDLID $uniqueid $lead_id";
				}
			$rslt=mysql_query($stmt, $link);
			if ($mel > 0) {mysql_error_logging($NOW_TIME,$link,$mel,$stmt,'00060',$user,$server_ip,$session_name,$one_mysql_log);}
			if ($DB) {echo "$stmt\n";}
			$VM_mancall_ct = mysql_num_rows($rslt);
			if ($VM_mancall_ct > 0)
				{
				$row=mysql_fetch_row($rslt);
				$start_epoch =		$row[0];
				$VDterm_reason =	$row[1];
				$VDvicidial_id =	$row[2];
				$VDcampaign_id =	$row[3];
				$length_in_sec = ($StarTtime - $start_epoch);
				}
			else
				{
				$length_in_sec = 0;
				}

			if ( ($length_in_sec < 1) and ($VLA_inOUT == 'INBOUND') )
				{
				$fp = fopen ("./vicidial_debug.txt", "a");
				fwrite ($fp, "$NOW_TIME|INBND_LOG_1|$uniqueid|$lead_id|$user|$inOUT|$length_in_sec|$VDterm_reason|$VDvicidial_id|$start_epoch|\n");
				fclose($fp);

				##### start epoch in the vicidial_log table, couldn't find one in vicidial_closer_log
				$stmt="SELECT start_epoch,term_reason,campaign_id FROM vicidial_log where uniqueid='$uniqueid' and lead_id='$lead_id' order by call_date desc limit 1;";
				$rslt=mysql_query($stmt, $link);
			if ($mel > 0) {mysql_error_logging($NOW_TIME,$link,$mel,$stmt,'00061',$user,$server_ip,$session_name,$one_mysql_log);}
				if ($DB) {echo "$stmt\n";}
				$VM_mancall_ct = mysql_num_rows($rslt);
				if ($VM_mancall_ct > 0)
					{
					$row=mysql_fetch_row($rslt);
					$start_epoch =		$row[0];
					$VDterm_reason =	$row[1];
					$VDcampaign_id =	$row[2];
					$length_in_sec = ($StarTtime - $start_epoch);
					}
				else
					{
					$length_in_sec = 0;
					}
				}
			}
		else {$length_in_sec = ($StarTtime - $start_epoch);}
		
		if (strlen($VDcampaign_id)<1) {$VDcampaign_id = $campaign;}

		$four_hours_ago = date("Y-m-d H:i:s", mktime(date("H")-4,date("i"),date("s"),date("m"),date("d"),date("Y")));

		if ($VLA_inOUT == 'INBOUND')
			{
			$stmt = "UPDATE vicidial_closer_log set end_epoch='$StarTtime', length_in_sec='$length_in_sec' where lead_id='$lead_id' and user='$user' and call_date > \"$four_hours_ago\" order by call_date desc limit 1;";
			if ($DB) {echo "$stmt\n";}
			$rslt=mysql_query($stmt, $link);
			if ($mel > 0) {mysql_error_logging($NOW_TIME,$link,$mel,$stmt,'00062',$user,$server_ip,$session_name,$one_mysql_log);}
			$affected_rows = mysql_affected_rows($link);
			if ($affected_rows > 0)
				{
				echo "$uniqueid\n$channel\n";
				}
			else
				{
				$fp = fopen ("./vicidial_debug.txt", "a");
				fwrite ($fp, "$NOW_TIME|INBND_LOG_2|$uniqueid|$lead_id|$user|$inOUT|$length_in_sec|$VDterm_reason|$VDvicidial_id|$start_epoch|\n");
				fclose($fp);
				}
			}

		#############################################
		##### START QUEUEMETRICS LOGGING LOOKUP #####
		$stmt = "SELECT enable_queuemetrics_logging,queuemetrics_server_ip,queuemetrics_dbname,queuemetrics_login,queuemetrics_pass,queuemetrics_log_id FROM system_settings;";
		$rslt=mysql_query($stmt, $link);
			if ($mel > 0) {mysql_error_logging($NOW_TIME,$link,$mel,$stmt,'00063',$user,$server_ip,$session_name,$one_mysql_log);}
		if ($DB) {echo "$stmt\n";}
		$qm_conf_ct = mysql_num_rows($rslt);
		$i=0;
		if ($qm_conf_ct > 0)
			{
			$row=mysql_fetch_row($rslt);
			$enable_queuemetrics_logging =	$row[0];
			$queuemetrics_server_ip	=		$row[1];
			$queuemetrics_dbname =			$row[2];
			$queuemetrics_login	=			$row[3];
			$queuemetrics_pass =			$row[4];
			$queuemetrics_log_id =			$row[5];

			if ($enable_queuemetrics_logging > 0)
				{
				$linkB=mysql_connect("$queuemetrics_server_ip", "$queuemetrics_login", "$queuemetrics_pass");
				mysql_select_db("$queuemetrics_dbname", $linkB);
				}
			}
		##### END QUEUEMETRICS LOGGING LOOKUP #####
		###########################################

		if ($auto_dial_level > 0)
			{
			### check to see if campaign has alt_dial enabled
			$stmt="SELECT auto_alt_dial FROM vicidial_campaigns where campaign_id='$campaign';";
			$rslt=mysql_query($stmt, $link);
			if ($mel > 0) {mysql_error_logging($NOW_TIME,$link,$mel,$stmt,'00064',$user,$server_ip,$session_name,$one_mysql_log);}
			if ($DB) {echo "$stmt\n";}
			$VAC_mancall_ct = mysql_num_rows($rslt);
			if ($VAC_mancall_ct > 0)
				{
				$row=mysql_fetch_row($rslt);
				$auto_alt_dial =$row[0];
				}
			else {$auto_alt_dial = 'NONE';}
			if (eregi("(ALT_ONLY|ADDR3_ONLY|ALT_AND_ADDR3|ALT_AND_EXTENDED|ALT_AND_ADDR3_AND_EXTENDED|EXTENDED_ONLY)",$auto_alt_dial))
				{
				### check to see if lead should be alt_dialed
				if (strlen($alt_dial)<2) {$alt_dial = 'NONE';}

				if ( (eregi("(NONE|MAIN)",$alt_dial)) and (eregi("(ALT_ONLY|ALT_AND_ADDR3|ALT_AND_EXTENDED)",$auto_alt_dial)) )
					{
					$alt_dial_skip=0;
					$stmt="SELECT alt_phone,gmt_offset_now,state FROM vicidial_list where lead_id='$lead_id';";
					$rslt=mysql_query($stmt, $link);
			if ($mel > 0) {mysql_error_logging($NOW_TIME,$link,$mel,$stmt,'00065',$user,$server_ip,$session_name,$one_mysql_log);}
					if ($DB) {echo "$stmt\n";}
					$VAC_mancall_ct = mysql_num_rows($rslt);
					if ($VAC_mancall_ct > 0)
						{
						$row=mysql_fetch_row($rslt);
						$alt_phone =		$row[0];
						$alt_phone = eregi_replace("[^0-9]","",$alt_phone);
						$gmt_offset_now =	$row[1];
						$state =			$row[2];
						}
					else {$alt_phone = '';}
					if (strlen($alt_phone)>5)
						{
						if (ereg("Y",$use_internal_dnc))
							{
							$stmtA="SELECT count(*) FROM vicidial_dnc where phone_number='$alt_phone';";
							$rslt=mysql_query($stmt, $link);
			if ($mel > 0) {mysql_error_logging($NOW_TIME,$link,$mel,$stmtA,'00066',$user,$server_ip,$session_name,$one_mysql_log);}
							if ($DB) {echo "$stmt\n";}
							$VLAP_dnc_ct = mysql_num_rows($rslt);
							if ($VLAP_dnc_ct > 0)
								{
								$row=mysql_fetch_row($rslt);
								$VD_alt_dnc_count =		$row[0];
								}
							}
						else {$VD_alt_dnc_count=0;}
						if (ereg("Y",$use_campaign_dnc))
							{
							$stmtA="SELECT count(*) FROM vicidial_campaign_dnc where phone_number='$alt_phone' and campaign_id='$campaign';";
							$rslt=mysql_query($stmt, $link);
			if ($mel > 0) {mysql_error_logging($NOW_TIME,$link,$mel,$stmtA,'00067',$user,$server_ip,$session_name,$one_mysql_log);}
							if ($DB) {echo "$stmt\n";}
							$VLAP_cdnc_ct = mysql_num_rows($rslt);
							if ($VLAP_cdnc_ct > 0)
								{
								$row=mysql_fetch_row($rslt);
								$VD_alt_dnc_count =		($VD_alt_dnc_count + $row[0]);
								}
							}
						if ($VD_alt_dnc_count < 1)
							{
							### insert record into vicidial_hopper for alt_phone call attempt
							$stmt = "INSERT INTO vicidial_hopper SET lead_id='$lead_id',campaign_id='$campaign',status='HOLD',list_id='$list_id',gmt_offset_now='$gmt_offset_now',state='$state',alt_dial='ALT',user='',priority='25';";
							if ($DB) {echo "$stmt\n";}
							$rslt=mysql_query($stmt, $link);
			if ($mel > 0) {mysql_error_logging($NOW_TIME,$link,$mel,$stmt,'00068',$user,$server_ip,$session_name,$one_mysql_log);}
							}
						else
							{$alt_dial_skip=1;}
						}
					else
						{$alt_dial_skip=1;}
					if ($alt_dial_skip > 0)
						{$alt_dial='ALT';}
					}

				if ( ( (eregi("(ALT)",$alt_dial)) and (eregi("ALT_AND_ADDR3",$auto_alt_dial)) ) or ( (eregi("(NONE|MAIN)",$alt_dial)) and (eregi("ADDR3_ONLY",$auto_alt_dial)) ) )
					{
					$addr3_dial_skip=0;
					$stmt="SELECT address3,gmt_offset_now,state FROM vicidial_list where lead_id='$lead_id';";
					$rslt=mysql_query($stmt, $link);
			if ($mel > 0) {mysql_error_logging($NOW_TIME,$link,$mel,$stmt,'00069',$user,$server_ip,$session_name,$one_mysql_log);}
					if ($DB) {echo "$stmt\n";}
					$VAC_mancall_ct = mysql_num_rows($rslt);
					if ($VAC_mancall_ct > 0)
						{
						$row=mysql_fetch_row($rslt);
						$address3 =			$row[0];
						$address3 = eregi_replace("[^0-9]","",$address3);
						$gmt_offset_now =	$row[1];
						$state =			$row[2];
						}
					else {$address3 = '';}
					if (strlen($address3)>5)
						{
						if (ereg("Y",$use_internal_dnc))
							{
							$stmtA="SELECT count(*) FROM vicidial_dnc where phone_number='$address3';";
							$rslt=mysql_query($stmt, $link);
			if ($mel > 0) {mysql_error_logging($NOW_TIME,$link,$mel,$stmtA,'00070',$user,$server_ip,$session_name,$one_mysql_log);}
							if ($DB) {echo "$stmt\n";}
							$VLAP_dnc_ct = mysql_num_rows($rslt);
							if ($VLAP_dnc_ct > 0)
								{
								$row=mysql_fetch_row($rslt);
								$VD_alt_dnc_count =		$row[0];
								}
							}
						else {$VD_alt_dnc_count=0;}
						if (ereg("Y",$use_campaign_dnc))
							{
							$stmtA="SELECT count(*) FROM vicidial_campaign_dnc where phone_number='$address3' and campaign_id='$campaign';";
							$rslt=mysql_query($stmt, $link);
			if ($mel > 0) {mysql_error_logging($NOW_TIME,$link,$mel,$stmtA,'00071',$user,$server_ip,$session_name,$one_mysql_log);}
							if ($DB) {echo "$stmt\n";}
							$VLAP_cdnc_ct = mysql_num_rows($rslt);
							if ($VLAP_cdnc_ct > 0)
								{
								$row=mysql_fetch_row($rslt);
								$VD_alt_dnc_count =		($VD_alt_dnc_count + $row[0]);
								}
							}
						if ($VD_alt_dnc_count < 1)
							{
							### insert record into vicidial_hopper for address3 call attempt
							$stmt = "INSERT INTO vicidial_hopper SET lead_id='$lead_id',campaign_id='$campaign',status='HOLD',list_id='$list_id',gmt_offset_now='$gmt_offset_now',state='$state',alt_dial='ADDR3',user='',priority='20';";
							if ($DB) {echo "$stmt\n";}
							$rslt=mysql_query($stmt, $link);
			if ($mel > 0) {mysql_error_logging($NOW_TIME,$link,$mel,$stmt,'00072',$user,$server_ip,$session_name,$one_mysql_log);}
							}
						else
							{$addr3_dial_skip=1;}
						}
					else
						{$addr3_dial_skip=1;}
					if ($addr3_dial_skip > 0)
						{$alt_dial='ADDR3';}
					}

	#		$fp = fopen ("./alt_multi_log.txt", "a");
	#		fwrite ($fp, "$NOW_TIME|PRE-X|$campaign|$lead_id|$phone_number|$user|$Ctype|$callerid|$uniqueid|$stmt|$auto_alt_dial|$alt_dial\n");
	#		fclose($fp);

				if ( ( ( (eregi("(NONE|MAIN)",$alt_dial)) and (eregi("EXTENDED_ONLY",$auto_alt_dial)) ) or ( (eregi("(ALT)",$alt_dial)) and (eregi("(ALT_AND_EXTENDED)",$auto_alt_dial)) ) or ( (eregi("(ADDR3)",$alt_dial)) and (eregi("(ADDR3_AND_EXTENDED|ALT_AND_ADDR3_AND_EXTENDED)",$auto_alt_dial)) ) or ( (eregi("(X)",$alt_dial)) and (eregi("EXTENDED",$auto_alt_dial)) ) )  and (!eregi("LAST",$alt_dial)) )
					{
					if (eregi("(ADDR3)",$alt_dial)) {$Xlast=0;}
					else
						{$Xlast = ereg_replace("[^0-9]","",$alt_dial);}
					if (strlen($Xlast)<1)
						{$Xlast=0;}
					$VD_altdialx='';

					$stmt="SELECT gmt_offset_now,state,list_id FROM vicidial_list where lead_id='$lead_id';";
					$rslt=mysql_query($stmt, $link);
			if ($mel > 0) {mysql_error_logging($NOW_TIME,$link,$mel,$stmt,'00073',$user,$server_ip,$session_name,$one_mysql_log);}
					if ($DB) {echo "$stmt\n";}
					$VL_deailts_ct = mysql_num_rows($rslt);
					if ($VL_deailts_ct > 0)
						{
						$row=mysql_fetch_row($rslt);
						$EA_gmt_offset_now =	$row[0];
						$EA_state =				$row[1];
						$EA_list_id =			$row[2];
						}
					$alt_dial_phones_count=0;
					$stmt="SELECT count(*) FROM vicidial_list_alt_phones where lead_id='$lead_id';";
					$rslt=mysql_query($stmt, $link);
			if ($mel > 0) {mysql_error_logging($NOW_TIME,$link,$mel,$stmt,'00074',$user,$server_ip,$session_name,$one_mysql_log);}
					if ($DB) {echo "$stmt\n";}
					$VLAP_ct = mysql_num_rows($rslt);
					if ($VLAP_ct > 0)
						{
						$row=mysql_fetch_row($rslt);
						$alt_dial_phones_count =	$row[0];
						}
					while ( ($alt_dial_phones_count > 0) and ($alt_dial_phones_count > $Xlast) )
						{
						$Xlast++;
						$stmt="SELECT alt_phone_id,phone_number,active FROM vicidial_list_alt_phones where lead_id='$lead_id' and alt_phone_count='$Xlast';";
						$rslt=mysql_query($stmt, $link);
			if ($mel > 0) {mysql_error_logging($NOW_TIME,$link,$mel,$stmt,'00075',$user,$server_ip,$session_name,$one_mysql_log);}
						if ($DB) {echo "$stmt\n";}
						$VLAP_detail_ct = mysql_num_rows($rslt);
						if ($VLAP_detail_ct > 0)
							{
							$row=mysql_fetch_row($rslt);
							$VD_altdial_id =		$row[0];
							$VD_altdial_phone =		$row[1];
							$VD_altdial_active =	$row[2];
							}
						else
							{$Xlast=9999999999;}

						if (ereg("Y",$VD_altdial_active))
							{
							if (ereg("Y",$use_internal_dnc))
								{
								$stmtA="SELECT count(*) FROM vicidial_dnc where phone_number='$VD_altdial_phone';";
								$rslt=mysql_query($stmt, $link);
			if ($mel > 0) {mysql_error_logging($NOW_TIME,$link,$mel,$stmtA,'00076',$user,$server_ip,$session_name,$one_mysql_log);}
								if ($DB) {echo "$stmt\n";}
								$VLAP_dnc_ct = mysql_num_rows($rslt);
								if ($VLAP_dnc_ct > 0)
									{
									$row=mysql_fetch_row($rslt);
									$VD_alt_dnc_count =		$row[0];
									}
								}
							else {$VD_alt_dnc_count=0;}
							if (ereg("Y",$use_campaign_dnc))
								{
								$stmtA="SELECT count(*) FROM vicidial_campaign_dnc where phone_number='$VD_altdial_phone' and campaign_id='$campaign';";
								$rslt=mysql_query($stmt, $link);
			if ($mel > 0) {mysql_error_logging($NOW_TIME,$link,$mel,$stmtA,'00077',$user,$server_ip,$session_name,$one_mysql_log);}
								if ($DB) {echo "$stmt\n";}
								$VLAP_cdnc_ct = mysql_num_rows($rslt);
								if ($VLAP_cdnc_ct > 0)
									{
									$row=mysql_fetch_row($rslt);
									$VD_alt_dnc_count =		($VD_alt_dnc_count + $row[0]);
									}
								}
							if ($VD_alt_dnc_count < 1)
								{
								if ($alt_dial_phones_count == $Xlast) 
									{$Xlast = 'LAST';}
								$stmt = "INSERT INTO vicidial_hopper SET lead_id='$lead_id',campaign_id='$campaign',status='HOLD',list_id='$EA_list_id',gmt_offset_now='$EA_gmt_offset_now',state='$EA_state',alt_dial='X$Xlast',user='',priority='15';";
								if ($DB) {echo "$stmt\n";}
								$rslt=mysql_query($stmt, $link);
			if ($mel > 0) {mysql_error_logging($NOW_TIME,$link,$mel,$stmt,'00078',$user,$server_ip,$session_name,$one_mysql_log);}
								$Xlast=9999999999;
								}
							}
						}
					}
				}

			if ($enable_queuemetrics_logging > 0)
				{
				### grab call lead information needed for QM logging
				$stmt="SELECT auto_call_id,lead_id,phone_number,status,campaign_id,phone_code,alt_dial,stage,callerid,uniqueid from vicidial_auto_calls where lead_id='$lead_id' order by call_time limit 1;";
				$rslt=mysql_query($stmt, $link);
			if ($mel > 0) {mysql_error_logging($NOW_TIME,$link,$mel,$stmt,'00079',$user,$server_ip,$session_name,$one_mysql_log);}
				if ($DB) {echo "$stmt\n";}
				$VAC_qm_ct = mysql_num_rows($rslt);
				if ($VAC_qm_ct > 0)
					{
					$row=mysql_fetch_row($rslt);
					$auto_call_id	= $row[0];
					$CLlead_id		= $row[1];
					$CLphone_number	= $row[2];
					$CLstatus		= $row[3];
					$CLcampaign_id	= $row[4];
					$CLphone_code	= $row[5];
					$CLalt_dial		= $row[6];
					$CLstage		= $row[7];
					$CLcallerid		= $row[8];
					$CLuniqueid		= $row[9];
					}

				$CLstage = preg_replace("/.*-/",'',$CLstage);
				if (strlen($CLstage) < 1) {$CLstage=0;}

				$stmt="SELECT count(*) from queue_log where call_id='$MDnextCID' and verb='COMPLETECALLER' and queue='$VDcampaign_id';";
				$rslt=mysql_query($stmt, $linkB);
			if ($mel > 0) {mysql_error_logging($NOW_TIME,$linkB,$mel,$stmt,'00080',$user,$server_ip,$session_name,$one_mysql_log);}
				if ($DB) {echo "$stmt\n";}
				$VAC_cc_ct = mysql_num_rows($rslt);
				if ($VAC_cc_ct > 0)
					{
					$row=mysql_fetch_row($rslt);
					$caller_complete	= $row[0];
					}

				if ($caller_complete < 1)
					{
					$term_reason='AGENT';
					}
				else
					{
					$term_reason='CALLER';
					}

				}

			### delete call record from  vicidial_auto_calls
			$stmt = "DELETE from vicidial_auto_calls where lead_id='$lead_id' and campaign_id='$VDcampaign_id' and uniqueid='$uniqueid';";
			if ($DB) {echo "$stmt\n";}
			$rslt=mysql_query($stmt, $link);
			if ($mel > 0) {mysql_error_logging($NOW_TIME,$link,$mel,$stmt,'00081',$user,$server_ip,$session_name,$one_mysql_log);}

			$stmt = "UPDATE vicidial_live_agents set status='PAUSED',uniqueid=0,callerid='',channel='',call_server_ip='',last_call_finish='$NOW_TIME',comments='' where user='$user' and server_ip='$server_ip';";
			if ($DB) {echo "$stmt\n";}
			$rslt=mysql_query($stmt, $link);
			if ($mel > 0) {$errno = mysql_error_logging($NOW_TIME,$link,$mel,$stmt,'00082',$user,$server_ip,$session_name,$one_mysql_log);}
				$retry_count=0;
				while ( ($errno > 0) and ($retry_count < 9) )
					{
					$rslt=mysql_query($stmt, $link);
					$one_mysql_log=1;
					$errno = mysql_error_logging($NOW_TIME,$link,$mel,$stmt,"9082$retry_count",$user,$server_ip,$session_name,$one_mysql_log);
					$one_mysql_log=0;
					$retry_count++;
					}

			$affected_rows = mysql_affected_rows($link);
			if ($affected_rows > 0) 
				{
				if ($enable_queuemetrics_logging > 0)
					{
					$stmt = "INSERT INTO queue_log SET partition='P01',time_id='$StarTtime',call_id='NONE',queue='NONE',agent='Agent/$user',verb='PAUSEALL',serverid='$queuemetrics_log_id';";
					if ($DB) {echo "$stmt\n";}
					$rslt=mysql_query($stmt, $linkB);
			if ($mel > 0) {mysql_error_logging($NOW_TIME,$linkB,$mel,$stmt,'00083',$user,$server_ip,$session_name,$one_mysql_log);}
					$affected_rows = mysql_affected_rows($linkB);
					}
				}
			}
		else
			{
			if ($enable_queuemetrics_logging > 0)
				{
				### check to see if lead should be alt_dialed
				$stmt="SELECT auto_call_id,lead_id,phone_number,status,campaign_id,phone_code,alt_dial,stage,callerid,uniqueid from vicidial_auto_calls where lead_id='$lead_id' order by call_time desc limit 1;";
				$rslt=mysql_query($stmt, $link);
			if ($mel > 0) {mysql_error_logging($NOW_TIME,$link,$mel,$stmt,'00084',$user,$server_ip,$session_name,$one_mysql_log);}
				if ($DB) {echo "$stmt\n";}
				$VAC_qm_ct = mysql_num_rows($rslt);
				if ($VAC_qm_ct > 0)
					{
					$row=mysql_fetch_row($rslt);
					$auto_call_id	= $row[0];
					$CLlead_id		= $row[1];
					$CLphone_number	= $row[2];
					$CLstatus		= $row[3];
					$CLcampaign_id	= $row[4];
					$CLphone_code	= $row[5];
					$CLalt_dial		= $row[6];
					$CLstage		= $row[7];
					$CLcallerid		= $row[8];
					$CLuniqueid		= $row[9];
					}

				$CLstage = preg_replace("/XFER|CLOSER|-/",'',$CLstage);
				if ($CLstage < 0.25) {$CLstage=0;}

				$stmt = "INSERT INTO queue_log SET partition='P01',time_id='$StarTtime',call_id='$MDnextCID',queue='$VDcampaign_id',agent='Agent/$user',verb='COMPLETEAGENT',data1='$CLstage',data2='$length_in_sec',data3='1',serverid='$queuemetrics_log_id';";
				if ($DB) {echo "$stmt\n";}
				$rslt=mysql_query($stmt, $linkB);
			if ($mel > 0) {mysql_error_logging($NOW_TIME,$linkB,$mel,$stmt,'00085',$user,$server_ip,$session_name,$one_mysql_log);}
				$affected_rows = mysql_affected_rows($linkB);
				}

		#	$stmt = "DELETE from vicidial_auto_calls where lead_id='$lead_id' and campaign_id='$campaign' and uniqueid='$uniqueid';";
			$stmt = "DELETE from vicidial_auto_calls where lead_id='$lead_id' and campaign_id='$VDcampaign_id' and callerid LIKE \"M%\";";
			if ($DB) {echo "$stmt\n";}
			$rslt=mysql_query($stmt, $link);
			if ($mel > 0) {mysql_error_logging($NOW_TIME,$link,$mel,$stmt,'00086',$user,$server_ip,$session_name,$one_mysql_log);}

			$stmt = "UPDATE vicidial_live_agents set status='PAUSED',uniqueid=0,callerid='',channel='',call_server_ip='',last_call_finish='$NOW_TIME',comments='' where user='$user' and server_ip='$server_ip';";
			if ($DB) {echo "$stmt\n";}
			$rslt=mysql_query($stmt, $link);
			if ($mel > 0) {$errno = mysql_error_logging($NOW_TIME,$link,$mel,$stmt,'00087',$user,$server_ip,$session_name,$one_mysql_log);}
				$retry_count=0;
				while ( ($errno > 0) and ($retry_count < 9) )
					{
					$rslt=mysql_query($stmt, $link);
					$one_mysql_log=1;
					$errno = mysql_error_logging($NOW_TIME,$link,$mel,$stmt,"9087$retry_count",$user,$server_ip,$session_name,$one_mysql_log);
					$one_mysql_log=0;
					$retry_count++;
					}

			$affected_rows = mysql_affected_rows($link);
			if ($affected_rows > 0) 
				{
				if ($enable_queuemetrics_logging > 0)
					{
					$stmt = "INSERT INTO queue_log SET partition='P01',time_id='$StarTtime',call_id='NONE',queue='NONE',agent='Agent/$user',verb='PAUSEALL',serverid='$queuemetrics_log_id';";
					if ($DB) {echo "$stmt\n";}
					$rslt=mysql_query($stmt, $linkB);
			if ($mel > 0) {mysql_error_logging($NOW_TIME,$linkB,$mel,$stmt,'00088',$user,$server_ip,$session_name,$one_mysql_log);}
					$affected_rows = mysql_affected_rows($linkB);
					}
				}
			}

		if ( ($VLA_inOUT == 'AUTO') or ($VLA_inOUT == 'MANUAL') )
			{
			$SQLterm = "term_reason='$term_reason',";

			if ( (ereg("NONE",$term_reason)) or (ereg("NONE",$VDterm_reason)) or (strlen($VDterm_reason) < 1) )
				{
				### check to see if lead should be alt_dialed
				$stmt="SELECT term_reason,uniqueid from vicidial_log where uniqueid='$uniqueid' and lead_id='$lead_id' order by call_date desc limit 1;";
				$rslt=mysql_query($stmt, $link);
			if ($mel > 0) {mysql_error_logging($NOW_TIME,$link,$mel,$stmt,'00089',$user,$server_ip,$session_name,$one_mysql_log);}
				$VAC_qm_ct = mysql_num_rows($rslt);
				if ($VAC_qm_ct > 0)
					{
					$row=mysql_fetch_row($rslt);
					$VDterm_reason	= $row[0];
					$VDvicidial_id	= $row[1];
					$VDIDselect =		"VDL_UIDLID $uniqueid $lead_id";
					}
				if (ereg("CALLER",$VDterm_reason))
					{
					$SQLterm = "";
					}
				else
					{
					$SQLterm = "term_reason='AGENT',";
					}
				}

			### check to see if the vicidial_log record exists, if not, insert it
			$stmt="SELECT count(*) from vicidial_log where uniqueid='$uniqueid' and lead_id='$lead_id';";
			$rslt=mysql_query($stmt, $link);
		if ($mel > 0) {mysql_error_logging($NOW_TIME,$link,$mel,$stmt,'00186',$user,$server_ip,$session_name,$one_mysql_log);}
			$VAC_vld_ct = mysql_num_rows($rslt);
			if ($VAC_vld_ct > 0)
				{
				$row=mysql_fetch_row($rslt);
				$VLD_count	= $row[0];
				if ($VLD_count < 1)
					{
					##### insert log into vicidial_log for manual VICIDiaL call
					$stmt="INSERT INTO vicidial_log (uniqueid,lead_id,list_id,campaign_id,call_date,start_epoch,status,phone_code,phone_number,user,comments,processed,user_group,alt_dial) values('$uniqueid','$lead_id','$list_id','$campaign','$NOW_TIME','$StarTtime','DONEM','$phone_code','$phone_number','$user','MANUAL','N','$user_group','$alt_dial');";
					if ($DB) {echo "$stmt\n";}
					$rslt=mysql_query($stmt, $link);
						if ($mel > 0) {mysql_error_logging($NOW_TIME,$link,$mel,$stmt,'00057',$user,$server_ip,$session_name,$one_mysql_log);}
					$affected_rows = mysql_affected_rows($link);

					if ($affected_rows > 0)
						{
						echo "VICIDiaL_LOG Wstawiony: $uniqueid|$channel|$NOW_TIME\n";
						echo "$StarTtime\n";
						}
					else
						{
						echo "Dziennik nie zapisany\n";
						}
					}
				}

			##### update the duration and end time in the vicidial_log table
			$stmt="UPDATE vicidial_log set $SQLterm end_epoch='$StarTtime', length_in_sec='$length_in_sec' where uniqueid='$uniqueid' and lead_id='$lead_id' and user='$user' order by call_date desc limit 1;";
			if ($DB) {echo "$stmt\n";}
			$rslt=mysql_query($stmt, $link);
			if ($mel > 0) {mysql_error_logging($NOW_TIME,$link,$mel,$stmt,'00090',$user,$server_ip,$session_name,$one_mysql_log);}
			$affected_rows = mysql_affected_rows($link);

			if ($affected_rows > 0)
				{
				echo "$uniqueid\n$channel\n";
				}
			else
				{
				echo "Dziennik nie zapisany\n\n";
				}
			}
		else
			{
			$SQLterm = "term_reason='$term_reason'";
			$QL_term='';

			if ( (ereg("NONE",$term_reason)) or (ereg("NONE",$VDterm_reason)) or (strlen($VDterm_reason) < 1) )
				{
				### check to see if lead should be alt_dialed
				$stmt="SELECT term_reason,closecallid from vicidial_closer_log where lead_id='$lead_id' and call_date > \"$four_hours_ago\" order by call_date desc limit 1;";
				$rslt=mysql_query($stmt, $link);
			if ($mel > 0) {mysql_error_logging($NOW_TIME,$link,$mel,$stmt,'00091',$user,$server_ip,$session_name,$one_mysql_log);}
				$VAC_qm_ct = mysql_num_rows($rslt);
				if ($VAC_qm_ct > 0)
					{
					$row=mysql_fetch_row($rslt);
					$VDterm_reason	= $row[0];
					$VDvicidial_id	= $row[1];
					$VDIDselect =		"VDCL_LID4HOUR $lead_id $four_hours_ago";
					}
				if (ereg("CALLER",$VDterm_reason))
					{
					$SQLterm = "";
					}
				else
					{
					$SQLterm = "term_reason='AGENT'";
					$QL_term = 'COMPLETEAGENT';
					}
				}

			if (strlen($SQLterm) > 0)
				{
				##### update the duration and end time in the vicidial_log table
				$stmt="UPDATE vicidial_closer_log set $SQLterm where lead_id='$lead_id' and call_date > \"$four_hours_ago\" order by call_date desc limit 1;";
				if ($DB) {echo "$stmt\n";}
				$rslt=mysql_query($stmt, $link);
				if ($mel > 0) {mysql_error_logging($NOW_TIME,$link,$mel,$stmt,'00092',$user,$server_ip,$session_name,$one_mysql_log);}
				$affected_rows = mysql_affected_rows($link);
				}

			if ($enable_queuemetrics_logging > 0)
				{
				if ( (strlen($QL_term) > 0) and ($leaving_threeway > 0) )
					{
					$stmt="SELECT count(*) from queue_log where call_id='$MDnextCID' and verb='COMPLETEAGENT' and queue='$VDcampaign_id';";
					$rslt=mysql_query($stmt, $linkB);
				if ($mel > 0) {mysql_error_logging($NOW_TIME,$linkB,$mel,$stmt,'00093',$user,$server_ip,$session_name,$one_mysql_log);}
					if ($DB) {echo "$stmt\n";}
					$VAC_cc_ct = mysql_num_rows($rslt);
					if ($VAC_cc_ct > 0)
						{
						$row=mysql_fetch_row($rslt);
						$agent_complete	= $row[0];
						}
					if ($agent_complete < 1)
						{
						$stmt = "INSERT INTO queue_log SET partition='P01',time_id='$StarTtime',call_id='$MDnextCID',queue='$VDcampaign_id',agent='Agent/$user',verb='COMPLETEAGENT',data1='$CLstage',data2='$length_in_sec',data3='1',serverid='$queuemetrics_log_id';";
						if ($DB) {echo "$stmt\n";}
						$rslt=mysql_query($stmt, $linkB);
				if ($mel > 0) {mysql_error_logging($NOW_TIME,$linkB,$mel,$stmt,'00094',$user,$server_ip,$session_name,$one_mysql_log);}
						$affected_rows = mysql_affected_rows($linkB);
						}
					}
				}
			}
		}

	echo $VDstop_rec_after_each_call . '|' . $extension . '|' . $conf_silent_prefix . '|' . $conf_exten . '|' . $user_abb . "|\n";

	##### if VICIDiaL call and hangup_after_each_call activated, find all recording 
	##### channels and hang them up while entering info into recording_log and 
	##### returning filename/recordingID
	if ($VDstop_rec_after_each_call == 1)
		{
		$local_DEF = 'Local/';
		$local_AMP = '@';
		$total_rec=0;
		$total_hangup=0;
		$loop_count=0;
		$stmt="SELECT channel FROM live_sip_channels where server_ip = '$server_ip' and extension = '$conf_exten' order by channel desc;";
			if ($format=='debug') {echo "\n<!-- $stmt -->";}
		$rslt=mysql_query($stmt, $link);
			if ($mel > 0) {mysql_error_logging($NOW_TIME,$link,$mel,$stmt,'00095',$user,$server_ip,$session_name,$one_mysql_log);}
		if ($rslt) {$rec_list = mysql_num_rows($rslt);}
			while ($rec_list>$loop_count)
			{
			$row=mysql_fetch_row($rslt);
			if (preg_match("/Local\/$conf_silent_prefix$conf_exten\@/i",$row[0]))
				{
				$rec_channels[$total_rec] = "$row[0]";
				$total_rec++;
				}
			else
				{
		#		if (preg_match("/$agentchannel/i",$row[0]))
				if ( ($agentchannel == "$row[0]") or (ereg('ASTblind',$row[0])) )
					{
					$donothing=1;
					}
				else
					{
					$hangup_channels[$total_hangup] = "$row[0]";
					$total_hangup++;
					}
				}
			if ($format=='debug') {echo "\n<!-- $row[0] -->";}
			$loop_count++; 
			}

		$loop_count=0;
		$stmt="SELECT channel FROM live_channels where server_ip = '$server_ip' and extension = '$conf_exten' order by channel desc;";
			if ($format=='debug') {echo "\n<!-- $stmt -->";}
		$rslt=mysql_query($stmt, $link);
			if ($mel > 0) {mysql_error_logging($NOW_TIME,$link,$mel,$stmt,'00184',$user,$server_ip,$session_name,$one_mysql_log);}
		if ($rslt) {$rec_list = mysql_num_rows($rslt);}
			while ($rec_list>$loop_count)
			{
			$row=mysql_fetch_row($rslt);
			if (preg_match("/Local\/$conf_silent_prefix$conf_exten\@/i",$row[0]))
				{
				$rec_channels[$total_rec] = "$row[0]";
				$total_rec++;
				}
			else
				{
		#		if (preg_match("/$agentchannel/i",$row[0]))
				if ( ($agentchannel == "$row[0]") or (ereg('ASTblind',$row[0])) )
					{
					$donothing=1;
					}
				else
					{
					$hangup_channels[$total_hangup] = "$row[0]";
					$total_hangup++;
					}
				}
			if ($format=='debug') {echo "\n<!-- $row[0] -->";}
			$loop_count++; 
			}


		### if a conference call or 3way call was attempted, then hangup all channels except for the agentchannel
		if ( ( ($conf_dialed > 0) or ($hangup_all_non_reserved > 0) ) and ($leaving_threeway < 1) and ($blind_transfer < 1) )
			{
			$loop_count=0;
			while($loop_count < $total_hangup)
				{
				if (strlen($hangup_channels[$loop_count])>5)
					{
					$stmt="INSERT INTO vicidial_manager values('','','$NOW_TIME','NEW','N','$server_ip','','Hangup','CH12346$StarTtime$loop_count','Channel: $hangup_channels[$loop_count]','','','','','','','','','');";
						if ($format=='debug') {echo "\n<!-- $stmt -->";}
					$rslt=mysql_query($stmt, $link);
			if ($mel > 0) {mysql_error_logging($NOW_TIME,$link,$mel,$stmt,'00096',$user,$server_ip,$session_name,$one_mysql_log);}
					}
				$loop_count++;
				}
			}

		$total_recFN=0;
		$loop_count=0;
		$filename=$MT;		# not necessary : and cmd_line_f LIKE \"%_$user_abb\"
		$stmt="SELECT cmd_line_f FROM vicidial_manager where server_ip='$server_ip' and action='Originate' and cmd_line_b = 'Channel: $local_DEF$conf_silent_prefix$conf_exten$local_AMP$ext_context' order by entry_date desc limit $total_rec;";
			if ($format=='debug') {echo "\n<!-- $stmt -->";}
		$rslt=mysql_query($stmt, $link);
			if ($mel > 0) {mysql_error_logging($NOW_TIME,$link,$mel,$stmt,'00097',$user,$server_ip,$session_name,$one_mysql_log);}
		if ($rslt) {$recFN_list = mysql_num_rows($rslt);}
			while ($recFN_list>$loop_count)
			{
			$row=mysql_fetch_row($rslt);
			$filename[$total_recFN] = preg_replace("/Callerid: /i","",$row[0]);
			if ($format=='debug') {echo "\n<!-- $row[0] -->";}
			$total_recFN++;
			$loop_count++; 
			}

		$loop_count=0;
		while($loop_count < $total_rec)
			{
			if (strlen($rec_channels[$loop_count])>5)
				{
				$stmt="INSERT INTO vicidial_manager values('','','$NOW_TIME','NEW','N','$server_ip','','Hangup','RH12345$StarTtime$loop_count','Channel: $rec_channels[$loop_count]','','','','','','','','','');";
					if ($format=='debug') {echo "\n<!-- $stmt -->";}
				$rslt=mysql_query($stmt, $link);
			if ($mel > 0) {mysql_error_logging($NOW_TIME,$link,$mel,$stmt,'00098',$user,$server_ip,$session_name,$one_mysql_log);}

				echo "REC_BATENTE|$rec_channels[$loop_count]|$filename[$loop_count]|";
				if (strlen($filename)>2)
					{
					$stmt="SELECT recording_id,start_epoch,vicidial_id,lead_id FROM recording_log where filename='$filename[$loop_count]'";
						if ($format=='debug') {echo "\n<!-- $stmt -->";}
					$rslt=mysql_query($stmt, $link);
			if ($mel > 0) {mysql_error_logging($NOW_TIME,$link,$mel,$stmt,'00099',$user,$server_ip,$session_name,$one_mysql_log);}
					if ($rslt) {$fn_count = mysql_num_rows($rslt);}
					if ($fn_count)
						{
						$row=mysql_fetch_row($rslt);
						$recording_id = $row[0];
						$start_time =	$row[1];
						$vicidial_id =	$row[2];
						$RClead_id =	$row[3];

						if ( (strlen($RClead_id)<1) or ($RClead_id < 1) or ($RClead_id=='NULL') )
							{$lidSQL = ",lead_id='$lead_id'";}
						if (strlen($vicidial_id)<1) 
							{$vidSQL = ",vicidial_id='$VDvicidial_id'";}
						else
							{
							if ( (ereg('.',$vicidial_id)) and ($VLA_inOUT == 'INBOUND') )
								{
								if (!ereg('.',$VDvicidial_id))
									{$vidSQL = ",vicidial_id='$VDvicidial_id'";}

								$fp = fopen ("./vicidial_debug.txt", "a");
								fwrite ($fp, "$NOW_TIME|INBND_LOG_3|$uniqueid|$lead_id|$user|$inOUT|$VLA_inOUT|$length_in_sec|$VDterm_reason|$VDvicidial_id|$vicidial_id|$start_epoch|$recording_id|\n");
								fclose($fp);
								}
							}
						$length_in_sec = ($StarTtime - $start_time);
						$length_in_min = ($length_in_sec / 60);
						$length_in_min = sprintf("%8.2f", $length_in_min);

						$stmt="UPDATE recording_log set end_time='$NOW_TIME',end_epoch='$StarTtime',length_in_sec=$length_in_sec,length_in_min='$length_in_min' $vidSQL $lidSQL where filename='$filename[$loop_count]' and end_epoch is NULL;";
							if ($format=='debug') {echo "\n<!-- $stmt -->";}
						$rslt=mysql_query($stmt, $link);
			if ($mel > 0) {mysql_error_logging($NOW_TIME,$link,$mel,$stmt,'00100',$user,$server_ip,$session_name,$one_mysql_log);}

						echo "$recording_id|$length_in_min|";

			#			$fp = fopen ("./recording_debug_$NOW_DATE$txt", "a");
			#			fwrite ($fp, "$NOW_TIME|NAGRYWAJ_LOG|$filename[$loop_count]|$uniqueid|$lead_id|$user|$inOUT|$VLA_inOUT|$length_in_sec|$VDterm_reason|$VDvicidial_id|$VDvicidial_id|$vicidial_id|$start_epoch|$recording_id|$VDIDselect|\n");
			#			fclose($fp);
						}
					else {echo "||";}
					}
				else {echo "||";}
				echo "\n";
				}
			$loop_count++;
			}
		}


	$talk_sec=0;
	$talk_epochSQL='';
	$StarTtime = date("U");
	$stmt = "select talk_epoch,talk_sec,wait_sec from vicidial_agent_log where agent_log_id='$agent_log_id';";
	if ($DB) {echo "$stmt\n";}
	$rslt=mysql_query($stmt, $link);
			if ($mel > 0) {mysql_error_logging($NOW_TIME,$link,$mel,$stmt,'00101',$user,$server_ip,$session_name,$one_mysql_log);}
	$VDpr_ct = mysql_num_rows($rslt);
	if ($VDpr_ct > 0)
		{
		$row=mysql_fetch_row($rslt);
		if ( (eregi("NULL",$row[0])) or ($row[0] < 1000) )
			{
			$talk_epochSQL=",talk_epoch='$StarTtime'";
			$row[0]=$row[2];
			}
		$talk_sec = (($StarTtime - $row[0]) + $row[1]);
		}
	$stmt="UPDATE vicidial_agent_log set talk_sec='$talk_sec',dispo_epoch='$StarTtime' $talk_epochSQL where agent_log_id='$agent_log_id';";
		if ($format=='debug') {echo "\n<!-- $stmt -->";}
	$rslt=mysql_query($stmt, $link);
			if ($mel > 0) {mysql_error_logging($NOW_TIME,$link,$mel,$stmt,'00102',$user,$server_ip,$session_name,$one_mysql_log);}

	}
}


################################################################################
### VDADREcheckINCOMING - for auto-dial VICIDiaL dialing this will recheck for
###                       calls to see if the channel has updated
################################################################################
if ($ACTION == 'VDADREcheckINCOMING')
{
	$MT[0]='';
	$row='';   $rowx='';
	$channel_live=1;
	if ( (strlen($campaign)<1) || (strlen($server_ip)<1) || (strlen($lead_id)<1) )
	{
	$channel_live=0;
	echo "0\n";
	echo "Kampania $campaign nie jest prawidłowy\n";
	echo "lead_id $lead_id nie jest prawidłowy\n";
	exit;
	}
	else
	{
	### grab the call and lead info from the vicidial_live_agents table
	$stmt = "SELECT lead_id,uniqueid,callerid,channel,call_server_ip FROM vicidial_live_agents where server_ip = '$server_ip' and user='$user' and campaign_id='$campaign' and lead_id='$lead_id';";
	if ($DB) {echo "$stmt\n";}
	$rslt=mysql_query($stmt, $link);
			if ($mel > 0) {mysql_error_logging($NOW_TIME,$link,$mel,$stmt,'00103',$user,$server_ip,$session_name,$one_mysql_log);}
	$queue_leadID_ct = mysql_num_rows($rslt);

	if ($queue_leadID_ct > 0)
		{
		$row=mysql_fetch_row($rslt);
		$lead_id	=$row[0];
		$uniqueid	=$row[1];
		$callerid	=$row[2];
		$channel	=$row[3];
		$call_server_ip	=$row[4];
			if (strlen($call_server_ip)<7) {$call_server_ip = $server_ip;}
		echo "1\n" . $lead_id . '|' . $uniqueid . '|' . $callerid . '|' . $channel . '|' . $call_server_ip . "|\n";
		}
	}
}


################################################################################
### VDADcheckINCOMING - for auto-dial VICIDiaL dialing this will check for calls
###                     in the vicidial_live_agents table in QUEUE status, then
###                     lookup the lead info and pass it back to vicidial.php
################################################################################
if ($ACTION == 'VDADcheckINCOMING')
{
	$VDCL_ingroup_recording_override = '';
	$VDCL_ingroup_rec_filename = '';
	$Ctype = 'A';
	$MT[0]='';
	$row='';   $rowx='';
	$channel_live=1;
	$alt_phone_code='';
	$alt_phone_number='';
	$alt_phone_note='';
	$alt_phone_active='';
	$alt_phone_count='';

	if ( (strlen($campaign)<1) || (strlen($server_ip)<1) )
	{
	$channel_live=0;
	echo "0\n";
	echo "Kampania $campaign nie jest prawidłowy\n";
	exit;
	}
	else
	{
	### grab the call and lead info from the vicidial_live_agents table
	$stmt = "SELECT lead_id,uniqueid,callerid,channel,call_server_ip,comments FROM vicidial_live_agents where server_ip = '$server_ip' and user='$user' and campaign_id='$campaign' and status='QUEUE';";
	if ($DB) {echo "$stmt\n";}
	$rslt=mysql_query($stmt, $link);
			if ($mel > 0) {mysql_error_logging($NOW_TIME,$link,$mel,$stmt,'00104',$user,$server_ip,$session_name,$one_mysql_log);}
	$queue_leadID_ct = mysql_num_rows($rslt);

	if ($queue_leadID_ct > 0)
		{
		$row=mysql_fetch_row($rslt);
		$lead_id	=$row[0];
		$uniqueid	=$row[1];
		$callerid	=$row[2];
		$channel	=$row[3];
		$call_server_ip	=$row[4];
		$VLAcomments=$row[5];

			if (strlen($call_server_ip)<7) {$call_server_ip = $server_ip;}
		echo "1\n" . $lead_id . '|' . $uniqueid . '|' . $callerid . '|' . $channel . '|' . $call_server_ip . "|\n";

		##### grab number of calls today in this campaign and increment
		$stmt="SELECT calls_today FROM vicidial_live_agents WHERE user='$user' and campaign_id='$campaign';";
		$rslt=mysql_query($stmt, $link);
			if ($mel > 0) {mysql_error_logging($NOW_TIME,$link,$mel,$stmt,'00105',$user,$server_ip,$session_name,$one_mysql_log);}
		if ($DB) {echo "$stmt\n";}
		$vla_cc_ct = mysql_num_rows($rslt);
		if ($vla_cc_ct > 0)
			{
			$row=mysql_fetch_row($rslt);
			$calls_today =$row[0];
			}
		else
			{$calls_today ='0';}
		$calls_today++;

		### update the agent status to INCALL in vicidial_live_agents
		$stmt = "UPDATE vicidial_live_agents set status='INCALL',last_call_time='$NOW_TIME',calls_today='$calls_today',external_hangup=0,external_status='',external_pause='',external_dial='' where user='$user' and server_ip='$server_ip';";
		if ($DB) {echo "$stmt\n";}
		$rslt=mysql_query($stmt, $link);
			if ($mel > 0) {$errno = mysql_error_logging($NOW_TIME,$link,$mel,$stmt,'00106',$user,$server_ip,$session_name,$one_mysql_log);}
				$retry_count=0;
				while ( ($errno > 0) and ($retry_count < 9) )
					{
					$rslt=mysql_query($stmt, $link);
					$one_mysql_log=1;
					$errno = mysql_error_logging($NOW_TIME,$link,$mel,$stmt,"9106$retry_count",$user,$server_ip,$session_name,$one_mysql_log);
					$one_mysql_log=0;
					$retry_count++;
					}

		$stmt = "UPDATE vicidial_campaign_agents set calls_today='$calls_today' where user='$user' and campaign_id='$campaign';";
		if ($DB) {echo "$stmt\n";}
		$rslt=mysql_query($stmt, $link);
			if ($mel > 0) {mysql_error_logging($NOW_TIME,$link,$mel,$stmt,'00107',$user,$server_ip,$session_name,$one_mysql_log);}

		##### grab the data from vicidial_list for the lead_id
		$stmt="SELECT * FROM vicidial_list where lead_id='$lead_id' LIMIT 1;";
		$rslt=mysql_query($stmt, $link);
			if ($mel > 0) {mysql_error_logging($NOW_TIME,$link,$mel,$stmt,'00108',$user,$server_ip,$session_name,$one_mysql_log);}
		if ($DB) {echo "$stmt\n";}
		$list_lead_ct = mysql_num_rows($rslt);
		if ($list_lead_ct > 0)
			{
			$row=mysql_fetch_row($rslt);
		#	$lead_id		= trim("$row[0]");
			$dispo			= trim("$row[3]");
			$tsr			= trim("$row[4]");
			$vendor_id		= trim("$row[5]");
			$source_id		= trim("$row[6]");
			$list_id		= trim("$row[7]");
			$gmt_offset_now	= trim("$row[8]");
			$phone_code		= trim("$row[10]");
			$phone_number	= trim("$row[11]");
			$title			= trim("$row[12]");
			$first_name		= trim("$row[13]");
			$middle_initial	= trim("$row[14]");
			$last_name		= trim("$row[15]");
			$address1		= trim("$row[16]");
			$address2		= trim("$row[17]");
			$address3		= trim("$row[18]");
			$city			= trim("$row[19]");
			$state			= trim("$row[20]");
			$province		= trim("$row[21]");
			$postal_code	= trim("$row[22]");
			$country_code	= trim("$row[23]");
			$gender			= trim("$row[24]");
			$date_of_birth	= trim("$row[25]");
			$alt_phone		= trim("$row[26]");
			$email			= trim("$row[27]");
			$security		= trim("$row[28]");
			$comments		= stripslashes(trim("$row[29]"));
			$called_count	= trim("$row[30]");
			}

		##### if lead is a callback, grab the callback comments
		$CBentry_time =		'';
		$CBcallback_time =	'';
		$CBuser =			'';
		$CBcomments =		'';
		if (ereg("CALLBK",$dispo))
			{
			$stmt="SELECT entry_time,callback_time,user,comments FROM vicidial_callbacks where lead_id='$lead_id' order by callback_id desc LIMIT 1;";
			$rslt=mysql_query($stmt, $link);
			if ($mel > 0) {mysql_error_logging($NOW_TIME,$link,$mel,$stmt,'00109',$user,$server_ip,$session_name,$one_mysql_log);}
			if ($DB) {echo "$stmt\n";}
			$cb_record_ct = mysql_num_rows($rslt);
			if ($cb_record_ct > 0)
				{
				$row=mysql_fetch_row($rslt);
				$CBentry_time =		trim("$row[0]");
				$CBcallback_time =	trim("$row[1]");
				$CBuser =			trim("$row[2]");
				$CBcomments =		trim("$row[3]");
				}
			}

		### update the lead status to INCALL
		$stmt = "UPDATE vicidial_list set status='INCALL', user='$user' where lead_id='$lead_id';";
		if ($DB) {echo "$stmt\n";}
		$rslt=mysql_query($stmt, $link);
			if ($mel > 0) {mysql_error_logging($NOW_TIME,$link,$mel,$stmt,'00110',$user,$server_ip,$session_name,$one_mysql_log);}

		### update the log status to INCALL
		$user_group='';
		$stmt="SELECT user_group FROM vicidial_users where user='$user' LIMIT 1;";
		$rslt=mysql_query($stmt, $link);
		if ($mel > 0) {mysql_error_logging($NOW_TIME,$link,$mel,$stmt,'00111',$user,$server_ip,$session_name,$one_mysql_log);}
		if ($DB) {echo "$stmt\n";}
		$ug_record_ct = mysql_num_rows($rslt);
		if ($ug_record_ct > 0)
			{
			$row=mysql_fetch_row($rslt);
			$user_group =		trim("$row[0]");
			}


		$stmt = "select campaign_id,phone_number,alt_dial,call_type from vicidial_auto_calls where callerid = '$callerid' order by call_time desc limit 1;";
		if ($DB) {echo "$stmt\n";}
		$rslt=mysql_query($stmt, $link);
			if ($mel > 0) {mysql_error_logging($NOW_TIME,$link,$mel,$stmt,'00112',$user,$server_ip,$session_name,$one_mysql_log);}
		$VDAC_cid_ct = mysql_num_rows($rslt);
		if ($VDAC_cid_ct > 0)
			{
			$row=mysql_fetch_row($rslt);
			$VDADchannel_group	=$row[0];
			$dialed_number		=$row[1];
			$dialed_label		=$row[2];
			$call_type			=$row[3];
			}
		else
			{
			$dialed_number = $phone_number;
			$dialed_label = 'MAIN';
			if (preg_match('/^M|^V/',$callerid))
				{
				$call_type = 'OUT';
				$VDADchannel_group = $campaign;
				}
			else
				{
				$call_type = 'IN';
				$stmt = "select campaign_id from vicidial_closer_log where lead_id = '$lead_id' order by call_date desc limit 1;";
				if ($DB) {echo "$stmt\n";}
				$rslt=mysql_query($stmt, $link);
					if ($mel > 0) {mysql_error_logging($NOW_TIME,$link,$mel,$stmt,'00183',$user,$server_ip,$session_name,$one_mysql_log);}
				$VDCL_mvac_ct = mysql_num_rows($rslt);
				if ($VDCL_mvac_ct > 0)
					{
					$row=mysql_fetch_row($rslt);
					$VDADchannel_group	=$row[0];
					}
				}
			if ($WeBRooTWritablE > 0)
				{
				$fp = fopen ("./vicidial_debug.txt", "a");
				fwrite ($fp, "$NOW_TIME|INBND|$callerid|$user|$user_group|$list_id|$lead_id|$phone_number|$uniqueid|$VDADchannel_group|$call_type|\n");
				fclose($fp);
				}
			}

		if ( ($call_type=='OUT') or ($call_type=='OUTBALANCE') )
			{
			$stmt = "UPDATE vicidial_log set user='$user', comments='AUTO', list_id='$list_id', status='INCALL', user_group='$user_group' where lead_id='$lead_id' and uniqueid='$uniqueid';";
			if ($DB) {echo "$stmt\n";}
			$rslt=mysql_query($stmt, $link);
			if ($mel > 0) {mysql_error_logging($NOW_TIME,$link,$mel,$stmt,'00113',$user,$server_ip,$session_name,$one_mysql_log);}

			$stmt = "select campaign_script,get_call_launch,xferconf_a_dtmf,xferconf_a_number,xferconf_b_dtmf,xferconf_b_number,default_xfer_group from vicidial_campaigns where campaign_id='$campaign';";
			if ($DB) {echo "$stmt\n";}
			$rslt=mysql_query($stmt, $link);
			if ($mel > 0) {mysql_error_logging($NOW_TIME,$link,$mel,$stmt,'00114',$user,$server_ip,$session_name,$one_mysql_log);}
			$VDIG_cid_ct = mysql_num_rows($rslt);
			if ($VDIG_cid_ct > 0)
				{
				$row=mysql_fetch_row($rslt);
				$VDCL_campaign_script	= $row[0];
				$VDCL_get_call_launch	= $row[1];
				$VDCL_xferconf_a_dtmf	= $row[2];
				$VDCL_xferconf_a_number	= $row[3];
				$VDCL_xferconf_b_dtmf	= $row[4];
				$VDCL_xferconf_b_number	= $row[5];
				$VDCL_default_xfer_group =	$row[6];
				if (strlen($VDCL_default_xfer_group)<2) {$VDCL_default_xfer_group='X';}
				}
			echo "|||||$VDCL_campaign_script|$VDCL_get_call_launch|$VDCL_xferconf_a_dtmf|$VDCL_xferconf_a_number|$VDCL_xferconf_b_dtmf|$VDCL_xferconf_b_number|$VDCL_default_xfer_group|X|X||||\n|\n";
			
			$stmt = "select phone_number,alt_dial from vicidial_auto_calls where callerid = '$callerid' order by call_time desc limit 1;";
			if ($DB) {echo "$stmt\n";}
			$rslt=mysql_query($stmt, $link);
			if ($mel > 0) {mysql_error_logging($NOW_TIME,$link,$mel,$stmt,'00115',$user,$server_ip,$session_name,$one_mysql_log);}
			$VDAC_cid_ct = mysql_num_rows($rslt);
			if ($VDAC_cid_ct > 0)
				{
				$row=mysql_fetch_row($rslt);
				$dialed_number		=$row[0];
				$dialed_label		=$row[1];
				}
			else
				{
				$dialed_number = $phone_number;
				$dialed_label = 'MAIN';
				}
			if (ereg('X',$dialed_label))
				{
				if (ereg('LAST',$dialed_label))
					{
					$stmt = "SELECT phone_code,phone_number,alt_phone_note,active,alt_phone_count FROM vicidial_list_alt_phones where lead_id='$lead_id' order by alt_phone_count desc limit 1;";
					}
				else
					{
					$Talt_dial = ereg_replace("[^0-9]","",$dialed_label);
					$stmt = "SELECT phone_code,phone_number,alt_phone_note,active,alt_phone_count FROM vicidial_list_alt_phones where lead_id='$lead_id' and alt_phone_count='$Talt_dial';";										
					}

				if ($DB) {echo "$stmt\n";}
				$rslt=mysql_query($stmt, $link);
			if ($mel > 0) {mysql_error_logging($NOW_TIME,$link,$mel,$stmt,'00116',$user,$server_ip,$session_name,$one_mysql_log);}
				$VLAP_ct = mysql_num_rows($rslt);
				if ($VLAP_ct > 0)
					{
					$row=mysql_fetch_row($rslt);
					$alt_phone_code	=	$row[0];
					$alt_phone_number = $row[1];
					$alt_phone_note =	$row[2];
					$alt_phone_active = $row[3];
					$alt_phone_count =	$row[4];
					}
				}
			}
		else
			{
			### update the vicidial_closer_log user to INCALL
			$stmt = "UPDATE vicidial_closer_log set user='$user', comments='AUTO', list_id='$list_id', status='INCALL', user_group='$user_group' where lead_id='$lead_id' order by closecallid desc limit 1;";
			if ($DB) {echo "$stmt\n";}
			$rslt=mysql_query($stmt, $link);
			if ($mel > 0) {mysql_error_logging($NOW_TIME,$link,$mel,$stmt,'00117',$user,$server_ip,$session_name,$one_mysql_log);}

			$stmt = "select count(*) from vicidial_log where lead_id='$lead_id' and uniqueid='$uniqueid';";
			if ($DB) {echo "$stmt\n";}
			$rslt=mysql_query($stmt, $link);
			if ($mel > 0) {mysql_error_logging($NOW_TIME,$link,$mel,$stmt,'00118',$user,$server_ip,$session_name,$one_mysql_log);}
			$VDL_cid_ct = mysql_num_rows($rslt);
			if ($VDL_cid_ct > 0)
				{
				$row=mysql_fetch_row($rslt);
				$VDCL_front_VDlog	=$row[0];
				}

			$stmt = "select group_name,group_color,web_form_address,fronter_display,ingroup_script,get_call_launch,xferconf_a_dtmf,xferconf_a_number,xferconf_b_dtmf,xferconf_b_number,default_xfer_group,ingroup_recording_override,ingroup_rec_filename,default_group_alias from vicidial_inbound_groups where group_id='$VDADchannel_group';";
			if ($DB) {echo "$stmt\n";}
			$rslt=mysql_query($stmt, $link);
			if ($mel > 0) {mysql_error_logging($NOW_TIME,$link,$mel,$stmt,'00119',$user,$server_ip,$session_name,$one_mysql_log);}
			$VDIG_cid_ct = mysql_num_rows($rslt);
			if ($VDIG_cid_ct > 0)
				{
				$row=mysql_fetch_row($rslt);
				$VDCL_group_name =					$row[0];
				$VDCL_group_color =					$row[1];
				$VDCL_group_web	=					stripslashes($row[2]);
				$VDCL_fronter_display =				$row[3];
				$VDCL_ingroup_script =				$row[4];
				$VDCL_get_call_launch =				$row[5];
				$VDCL_xferconf_a_dtmf =				$row[6];
				$VDCL_xferconf_a_number =			$row[7];
				$VDCL_xferconf_b_dtmf =				$row[8];
				$VDCL_xferconf_b_number =			$row[9];
				$VDCL_default_xfer_group =			$row[10];
				$VDCL_ingroup_recording_override =	$row[11];
				$VDCL_ingroup_rec_filename =		$row[12];
				$VDCL_default_group_alias =			$row[13];


				$stmt = "select campaign_script,xferconf_a_dtmf,xferconf_a_number,xferconf_b_dtmf,xferconf_b_number,default_group_alias from vicidial_campaigns where campaign_id='$campaign';";
				if ($DB) {echo "$stmt\n";}
				$rslt=mysql_query($stmt, $link);
				if ($mel > 0) {mysql_error_logging($NOW_TIME,$link,$mel,$stmt,'00181',$user,$server_ip,$session_name,$one_mysql_log);}
				$VDIG_cidOR_ct = mysql_num_rows($rslt);
				if ($VDIG_cidOR_ct > 0)
					{
					$row=mysql_fetch_row($rslt);
					if ( ( (ereg('NONE',$VDCL_ingroup_script)) and (strlen($VDCL_ingroup_script) < 5) ) or (strlen($VDCL_ingroup_script) < 1) )
						{$VDCL_ingroup_script =		$row[0];}
					if (strlen($VDCL_xferconf_a_dtmf) < 1)
						{$VDCL_xferconf_a_dtmf =	$row[1];}
					if (strlen($VDCL_xferconf_a_number) < 1)
						{$VDCL_xferconf_a_number =	$row[2];}
					if (strlen($VDCL_xferconf_b_dtmf) < 1)
						{$VDCL_xferconf_b_dtmf =	$row[3];}
					if (strlen($VDCL_xferconf_b_number) < 1)
						{$VDCL_xferconf_b_number =	$row[4];}
					if (strlen($VDCL_default_group_alias) < 1)
						{$VDCL_default_group_alias =	$row[5];}
					}

				$stmt = "select group_web_vars from vicidial_inbound_group_agents where group_id='$VDADchannel_group' and user='$user';";
				if ($DB) {echo "$stmt\n";}
				$rslt=mysql_query($stmt, $link);
				if ($mel > 0) {mysql_error_logging($NOW_TIME,$link,$mel,$stmt,'00188',$user,$server_ip,$session_name,$one_mysql_log);}
				$VDIG_cidgwv_ct = mysql_num_rows($rslt);
				if ($VDIG_cidgwv_ct > 0)
					{
					$row=mysql_fetch_row($rslt);
					$VDCL_group_web_vars =	$row[0];
					}

				if (strlen($VDCL_group_web_vars) < 1)
					{
					$stmt = "select group_web_vars from vicidial_campaign_agents where campaign_id='$campaign' and user='$user';";
					if ($DB) {echo "$stmt\n";}
					$rslt=mysql_query($stmt, $link);
					if ($mel > 0) {mysql_error_logging($NOW_TIME,$link,$mel,$stmt,'00189',$user,$server_ip,$session_name,$one_mysql_log);}
					$VDIG_cidogwv = mysql_num_rows($rslt);
					if ($VDIG_cidogwv > 0)
						{
						$row=mysql_fetch_row($rslt);
						$VDCL_group_web_vars =	$row[0];
						}
					}

				### update the comments in vicidial_live_agents record
				$stmt = "UPDATE vicidial_live_agents set comments='INBOUND' where user='$user' and server_ip='$server_ip';";
				if ($DB) {echo "$stmt\n";}
				$rslt=mysql_query($stmt, $link);
			if ($mel > 0) {mysql_error_logging($NOW_TIME,$link,$mel,$stmt,'00120',$user,$server_ip,$session_name,$one_mysql_log);}

				$Ctype = 'I';
				}
			else
				{
				$stmt = "select campaign_script,get_call_launch,xferconf_a_dtmf,xferconf_a_number,xferconf_b_dtmf,xferconf_b_number,default_group_alias from vicidial_campaigns where campaign_id='$VDADchannel_group';";
				if ($DB) {echo "$stmt\n";}
				$rslt=mysql_query($stmt, $link);
			if ($mel > 0) {mysql_error_logging($NOW_TIME,$link,$mel,$stmt,'00121',$user,$server_ip,$session_name,$one_mysql_log);}
				$VDIG_cid_ct = mysql_num_rows($rslt);
				if ($VDIG_cid_ct > 0)
					{
					$row=mysql_fetch_row($rslt);
					$VDCL_ingroup_script	= $row[0];
					$VDCL_get_call_launch	= $row[1];
					$VDCL_xferconf_a_dtmf	= $row[2];
					$VDCL_xferconf_a_number	= $row[3];
					$VDCL_xferconf_b_dtmf	= $row[4];
					$VDCL_xferconf_b_number	= $row[5];
					$VDCL_default_group_alias = $row[6];
					}

				$stmt = "select group_web_vars from vicidial_campaign_agents where campaign_id='$VDADchannel_group' and user='$user';";
				if ($DB) {echo "$stmt\n";}
				$rslt=mysql_query($stmt, $link);
				if ($mel > 0) {mysql_error_logging($NOW_TIME,$link,$mel,$stmt,'00190',$user,$server_ip,$session_name,$one_mysql_log);}
				$VDIG_cidogwv = mysql_num_rows($rslt);
				if ($VDIG_cidogwv > 0)
					{
					$row=mysql_fetch_row($rslt);
					$VDCL_group_web_vars =	$row[0];
					}
				}

			$VDCL_caller_id_number='';
			if (strlen($VDCL_default_group_alias)>1)
				{
				$stmt = "select caller_id_number from groups_alias where group_alias_id='$VDCL_default_group_alias';";
				if ($DB) {echo "$stmt\n";}
				$rslt=mysql_query($stmt, $link);
			if ($mel > 0) {mysql_error_logging($NOW_TIME,$link,$mel,$stmt,'00187',$user,$server_ip,$session_name,$one_mysql_log);}
				$VDIG_cidnum_ct = mysql_num_rows($rslt);
				if ($VDIG_cidnum_ct > 0)
					{
					$row=mysql_fetch_row($rslt);
					$VDCL_caller_id_number	= $row[0];
					}
				}

			### if web form is set then send na to vicidial.php for override of WEB_FORM address
			if ( (strlen($VDCL_group_web)>5) or (strlen($VDCL_group_name)>0) ) {echo "$VDCL_group_web|$VDCL_group_name|$VDCL_group_color|$VDCL_fronter_display|$VDADchannel_group|$VDCL_ingroup_script|$VDCL_get_call_launch|$VDCL_xferconf_a_dtmf|$VDCL_xferconf_a_number|$VDCL_xferconf_b_dtmf|$VDCL_xferconf_b_number|$VDCL_default_xfer_group|$VDCL_ingroup_recording_override|$VDCL_ingroup_rec_filename|$VDCL_default_group_alias|$VDCL_caller_id_number|$VDCL_group_web_vars|\n";}
			else {echo "X|$VDCL_group_name|$VDCL_group_color|$VDCL_fronter_display|$VDADchannel_group|$VDCL_ingroup_script|$VDCL_get_call_launch|$VDCL_xferconf_a_dtmf|$VDCL_xferconf_a_number|$VDCL_xferconf_b_dtmf|$VDCL_xferconf_b_number|$VDCL_default_xfer_group|$VDCL_ingroup_recording_override|$VDCL_ingroup_rec_filename|$VDCL_default_group_alias|$VDCL_caller_id_number|$VDCL_group_web_vars|\n";}

			$stmt = "SELECT full_name from vicidial_users where user='$tsr';";
			if ($DB) {echo "$stmt\n";}
			$rslt=mysql_query($stmt, $link);
			if ($mel > 0) {mysql_error_logging($NOW_TIME,$link,$mel,$stmt,'00122',$user,$server_ip,$session_name,$one_mysql_log);}
			$VDU_cid_ct = mysql_num_rows($rslt);
			if ($VDU_cid_ct > 0)
				{
				$row=mysql_fetch_row($rslt);
				$fronter_full_name		= $row[0];
				echo $fronter_full_name . '|' . $tsr . "\n";
				}
			else {echo '|' . $tsr . "\n";}
			}

		$comments = eregi_replace("\r",'',$comments);
		$comments = eregi_replace("\n",'!N',$comments);

		$LeaD_InfO =	$callerid . "\n";
		$LeaD_InfO .=	$lead_id . "\n";
		$LeaD_InfO .=	$dispo . "\n";
		$LeaD_InfO .=	$tsr . "\n";
		$LeaD_InfO .=	$vendor_id . "\n";
		$LeaD_InfO .=	$list_id . "\n";
		$LeaD_InfO .=	$gmt_offset_now . "\n";
		$LeaD_InfO .=	$phone_code . "\n";
		$LeaD_InfO .=	$phone_number . "\n";
		$LeaD_InfO .=	$title . "\n";
		$LeaD_InfO .=	$first_name . "\n";
		$LeaD_InfO .=	$middle_initial . "\n";
		$LeaD_InfO .=	$last_name . "\n";
		$LeaD_InfO .=	$address1 . "\n";
		$LeaD_InfO .=	$address2 . "\n";
		$LeaD_InfO .=	$address3 . "\n";
		$LeaD_InfO .=	$city . "\n";
		$LeaD_InfO .=	$state . "\n";
		$LeaD_InfO .=	$province . "\n";
		$LeaD_InfO .=	$postal_code . "\n";
		$LeaD_InfO .=	$country_code . "\n";
		$LeaD_InfO .=	$gender . "\n";
		$LeaD_InfO .=	$date_of_birth . "\n";
		$LeaD_InfO .=	$alt_phone . "\n";
		$LeaD_InfO .=	$email . "\n";
		$LeaD_InfO .=	$security . "\n";
		$LeaD_InfO .=	$comments . "\n";
		$LeaD_InfO .=	$called_count . "\n";
		$LeaD_InfO .=	$CBentry_time . "\n";
		$LeaD_InfO .=	$CBcallback_time . "\n";
		$LeaD_InfO .=	$CBuser . "\n";
		$LeaD_InfO .=	$CBcomments . "\n";
		$LeaD_InfO .=	$dialed_number . "\n";
		$LeaD_InfO .=	$dialed_label . "\n";
		$LeaD_InfO .=	$source_id . "\n";
		$LeaD_InfO .=	$alt_phone_code . "\n";
		$LeaD_InfO .=	$alt_phone_number . "\n";
		$LeaD_InfO .=	$alt_phone_note . "\n";
		$LeaD_InfO .=	$alt_phone_active . "\n";
		$LeaD_InfO .=	$alt_phone_count . "\n";

		echo $LeaD_InfO;



		$wait_sec=0;
		$StarTtime = date("U");
		$stmt = "select wait_epoch,wait_sec from vicidial_agent_log where agent_log_id='$agent_log_id';";
		if ($DB) {echo "$stmt\n";}
		$rslt=mysql_query($stmt, $link);
			if ($mel > 0) {mysql_error_logging($NOW_TIME,$link,$mel,$stmt,'00123',$user,$server_ip,$session_name,$one_mysql_log);}
		$VDpr_ct = mysql_num_rows($rslt);
		if ($VDpr_ct > 0)
			{
			$row=mysql_fetch_row($rslt);
			$wait_sec = (($StarTtime - $row[0]) + $row[1]);
			}
		$stmt="UPDATE vicidial_agent_log set wait_sec='$wait_sec',talk_epoch='$StarTtime',lead_id='$lead_id' where agent_log_id='$agent_log_id';";
			if ($format=='debug') {echo "\n<!-- $stmt -->";}
		$rslt=mysql_query($stmt, $link);
			if ($mel > 0) {mysql_error_logging($NOW_TIME,$link,$mel,$stmt,'00124',$user,$server_ip,$session_name,$one_mysql_log);}

		### If RozmowaBK, change vicidial_callback record to INACTIVE
		if (eregi("CALLBK|CBHOLD", $dispo))
			{
			$stmt="UPDATE vicidial_callbacks set status='INACTIVE' where lead_id='$lead_id' and status NOT IN('INACTIVE','DEAD','ARCHIVE');";
				if ($format=='debug') {echo "\n<!-- $stmt -->";}
			$rslt=mysql_query($stmt, $link);
			if ($mel > 0) {mysql_error_logging($NOW_TIME,$link,$mel,$stmt,'00125',$user,$server_ip,$session_name,$one_mysql_log);}
			}

		##### check if system is set to generate logfile for transfers
		$stmt="SELECT enable_agc_xfer_log FROM system_settings;";
		$rslt=mysql_query($stmt, $link);
			if ($mel > 0) {mysql_error_logging($NOW_TIME,$link,$mel,$stmt,'00126',$user,$server_ip,$session_name,$one_mysql_log);}
		if ($DB) {echo "$stmt\n";}
		$enable_agc_xfer_log_ct = mysql_num_rows($rslt);
		if ($enable_agc_xfer_log_ct > 0)
			{
			$row=mysql_fetch_row($rslt);
			$enable_agc_xfer_log =$row[0];
			}

		if ( ($WeBRooTWritablE > 0) and ($enable_agc_xfer_log > 0) )
			{
			#	DATETIME|campaign|lead_id|phone_number|user|type
			#	2007-08-22 11:11:11|TESTCAMP|65432|3125551212|1234|A
			$fp = fopen ("./xfer_log.txt", "a");
			fwrite ($fp, "$NOW_TIME|$campaign|$lead_id|$phone_number|$user|$Ctype|$callerid|$uniqueid\n");
			fclose($fp);
			}

		}
		else
		{
		echo "0\n";
	#	echo "No calls in QUEUE for $user na $server_ip\n";
		exit;
		}
	}
}


################################################################################
### userLOGout - Logs the user out of VICIDiaL client, deleting db records and 
###              inserting into vicidial_user_log
################################################################################
if ($ACTION == 'userLOGout')
{
	$MT[0]='';
	$row='';   $rowx='';
if ( (strlen($campaign)<1) || (strlen($conf_exten)<1) )
	{
	echo "NO\n";
	echo "campaign $campaign or conf_exten $conf_exten nie jest prawidłowy\n";
	exit;
	}
else
	{
		$user_group='';
		$stmt="SELECT user_group FROM vicidial_users where user='$user' LIMIT 1;";
		$rslt=mysql_query($stmt, $link);
			if ($mel > 0) {mysql_error_logging($NOW_TIME,$link,$mel,$stmt,'00127',$user,$server_ip,$session_name,$one_mysql_log);}
		if ($DB) {echo "$stmt\n";}
		$ug_record_ct = mysql_num_rows($rslt);
		if ($ug_record_ct > 0)
			{
			$row=mysql_fetch_row($rslt);
			$user_group =		trim("$row[0]");
			}
	##### Insert a WYLOGUJ record into the user log
	$stmt="INSERT INTO vicidial_user_log (user,event,campaign_id,event_date,event_epoch,user_group) values('$user','WYLOGUJ','$campaign','$NOW_TIME','$StarTtime','$user_group');";
	if ($DB) {echo "$stmt\n";}
	$rslt=mysql_query($stmt, $link);
			if ($mel > 0) {mysql_error_logging($NOW_TIME,$link,$mel,$stmt,'00128',$user,$server_ip,$session_name,$one_mysql_log);}
	$vul_insert = mysql_affected_rows($link);

	if ($no_delete_sessions < 1)
		{
		##### Remove the reservation na the vicidial_conferences meetme room
		$stmt="UPDATE vicidial_conferences set extension='' where server_ip='$server_ip' and conf_exten='$conf_exten';";
		if ($DB) {echo "$stmt\n";}
		$rslt=mysql_query($stmt, $link);
			if ($mel > 0) {mysql_error_logging($NOW_TIME,$link,$mel,$stmt,'00129',$user,$server_ip,$session_name,$one_mysql_log);}
		$vc_remove = mysql_affected_rows($link);
		}

	##### Delete the vicidial_live_agents record for this session
	$stmt="DELETE from vicidial_live_agents where server_ip='$server_ip' and user ='$user';";
	if ($DB) {echo "$stmt\n";}
	$rslt=mysql_query($stmt, $link);
		if ($mel > 0) {$errno = mysql_error_logging($NOW_TIME,$link,$mel,$stmt,'00130',$user,$server_ip,$session_name,$one_mysql_log);}
			$retry_count=0;
			while ( ($errno > 0) and ($retry_count < 9) )
				{
				$rslt=mysql_query($stmt, $link);
				$one_mysql_log=1;
				$errno = mysql_error_logging($NOW_TIME,$link,$mel,$stmt,"9130$retry_count",$user,$server_ip,$session_name,$one_mysql_log);
				$one_mysql_log=0;
				$retry_count++;
				}
	$vla_delete = mysql_affected_rows($link);

	##### Delete the vicidial_live_inbound_agents records for this session
	$stmt="DELETE from vicidial_live_inbound_agents where user ='$user';";
	if ($DB) {echo "$stmt\n";}
	$rslt=mysql_query($stmt, $link);
			if ($mel > 0) {mysql_error_logging($NOW_TIME,$link,$mel,$stmt,'00131',$user,$server_ip,$session_name,$one_mysql_log);}
	$vlia_delete = mysql_affected_rows($link);

	##### Delete the web_client_sessions
	$stmt="DELETE from web_client_sessions where server_ip='$server_ip' and session_name ='$session_name';";
	if ($DB) {echo "$stmt\n";}
	$rslt=mysql_query($stmt, $link);
			if ($mel > 0) {mysql_error_logging($NOW_TIME,$link,$mel,$stmt,'00132',$user,$server_ip,$session_name,$one_mysql_log);}
	$wcs_delete = mysql_affected_rows($link);

	##### Hangup the client phone
	$stmt="SELECT channel FROM live_sip_channels where server_ip = '$server_ip' and channel LIKE \"$protocol/$extension%\" order by channel desc;";
		if ($format=='debug') {echo "\n<!-- $stmt -->";}
	$rslt=mysql_query($stmt, $link);
			if ($mel > 0) {mysql_error_logging($NOW_TIME,$link,$mel,$stmt,'00133',$user,$server_ip,$session_name,$one_mysql_log);}
	if ($rslt) 
		{
		$row=mysql_fetch_row($rslt);
		$agent_channel = "$row[0]";
		if ($format=='debug') {echo "\n<!-- $row[0] -->";}
		$stmt="INSERT INTO vicidial_manager values('','','$NOW_TIME','NEW','N','$server_ip','','Hangup','ULGH3459$StarTtime','Channel: $agent_channel','','','','','','','','','');";
			if ($format=='debug') {echo "\n<!-- $stmt -->";}
		$rslt=mysql_query($stmt, $link);
			if ($mel > 0) {mysql_error_logging($NOW_TIME,$link,$mel,$stmt,'00134',$user,$server_ip,$session_name,$one_mysql_log);}
		}

	if ($LogouTKicKAlL > 0)
		{
		$local_DEF = 'Local/5555';
		$local_AMP = '@';
		$kick_local_channel = "$local_DEF$conf_exten$local_AMP$ext_context";
		$queryCID = "ULGH3458$StarTtime";

		$stmt="INSERT INTO vicidial_manager values('','','$NOW_TIME','NEW','N','$server_ip','','Originate','$queryCID','Channel: $kick_local_channel','Context: $ext_context','Exten: 8300','Priority: 1','Callerid: $queryCID','','','','$channel','$exten');";
			if ($format=='debug') {echo "\n<!-- $stmt -->";}
		$rslt=mysql_query($stmt, $link);
			if ($mel > 0) {mysql_error_logging($NOW_TIME,$link,$mel,$stmt,'00135',$user,$server_ip,$session_name,$one_mysql_log);}
		}

	$pause_sec=0;
	$stmt = "select pause_epoch,pause_sec,wait_epoch,talk_epoch,dispo_epoch from vicidial_agent_log where agent_log_id='$agent_log_id';";
	if ($DB) {echo "$stmt\n";}
	$rslt=mysql_query($stmt, $link);
			if ($mel > 0) {mysql_error_logging($NOW_TIME,$link,$mel,$stmt,'00136',$user,$server_ip,$session_name,$one_mysql_log);}
	$VDpr_ct = mysql_num_rows($rslt);
	if ( ($VDpr_ct > 0) and (strlen($row[3]<5)) and (strlen($row[4]<5)) )
		{
		$row=mysql_fetch_row($rslt);
		$pause_sec = (($StarTtime - $row[0]) + $row[1]);

		$stmt="UPDATE vicidial_agent_log set pause_sec='$pause_sec',wait_epoch='$StarTtime' where agent_log_id='$agent_log_id';";
			if ($format=='debug') {echo "\n<!-- $stmt -->";}
		$rslt=mysql_query($stmt, $link);
			if ($mel > 0) {mysql_error_logging($NOW_TIME,$link,$mel,$stmt,'00137',$user,$server_ip,$session_name,$one_mysql_log);}
		}

		if ($vla_delete > 0) 
			{
			#############################################
			##### START QUEUEMETRICS LOGGING LOOKUP #####
			$stmt = "SELECT enable_queuemetrics_logging,queuemetrics_server_ip,queuemetrics_dbname,queuemetrics_login,queuemetrics_pass,queuemetrics_log_id,allow_sipsak_messages FROM system_settings;";
			$rslt=mysql_query($stmt, $link);
			if ($mel > 0) {mysql_error_logging($NOW_TIME,$link,$mel,$stmt,'00138',$user,$server_ip,$session_name,$one_mysql_log);}
			if ($DB) {echo "$stmt\n";}
			$qm_conf_ct = mysql_num_rows($rslt);
			$i=0;
			while ($i < $qm_conf_ct)
				{
				$row=mysql_fetch_row($rslt);
				$enable_queuemetrics_logging =	$row[0];
				$queuemetrics_server_ip	=		$row[1];
				$queuemetrics_dbname =			$row[2];
				$queuemetrics_login	=			$row[3];
				$queuemetrics_pass =			$row[4];
				$queuemetrics_log_id =			$row[5];
				$allow_sipsak_messages =		$row[6];
				$i++;
				}
			##### END QUEUEMETRICS LOGGING LOOKUP #####
			###########################################
			if ( ($enable_sipsak_messages > 0) and ($allow_sipsak_messages > 0) and (eregi("SIP",$protocol)) )
				{
				$SIPSAK_message = 'LOGGED OUT';
				passthru("/usr/local/bin/sipsak -M -O desktop -B \"$SIPSAK_message\" -r 5060 -s sip:$extension@$phone_ip > /dev/null");
				}

			if ($enable_queuemetrics_logging > 0)
				{
				$linkB=mysql_connect("$queuemetrics_server_ip", "$queuemetrics_login", "$queuemetrics_pass");
				mysql_select_db("$queuemetrics_dbname", $linkB);

			#	$stmt = "INSERT INTO queue_log SET partition='P01',time_id='$StarTtime',call_id='NONE',queue='$campaign',agent='Agent/$user',verb='PAUSE',serverid='1';";
			#	if ($DB) {echo "$stmt\n";}
			#	
			#	$rslt=mysql_query($stmt, $linkB);
			#	$affected_rows = mysql_affected_rows($linkB);

				$stmt = "SELECT time_id FROM queue_log where agent='Agent/$user' and verb='AGENTLOGIN' order by time_id desc limit 1;";
				$rslt=mysql_query($stmt, $linkB);
			if ($mel > 0) {mysql_error_logging($NOW_TIME,$linkB,$mel,$stmt,'00139',$user,$server_ip,$session_name,$one_mysql_log);}
				if ($DB) {echo "$stmt\n";}
				echo "$stmt\n";
				$li_conf_ct = mysql_num_rows($rslt);
				$i=0;
				while ($i < $li_conf_ct)
					{
					$row=mysql_fetch_row($rslt);
					$logintime =	$row[0];
					$i++;
					}

				$time_logged_in = ($StarTtime - $logintime);
				if ($time_logged_in > 1000000) {$time_logged_in=1;}

				$stmt = "INSERT INTO queue_log SET partition='P01',time_id='$StarTtime',call_id='NONE',queue='NONE',agent='Agent/$user',verb='AGENTLOGOFF',data1='$user$agents',data2='$time_logged_in',serverid='$queuemetrics_log_id';";
				if ($DB) {echo "$stmt\n";}
				$rslt=mysql_query($stmt, $linkB);
			if ($mel > 0) {mysql_error_logging($NOW_TIME,$linkB,$mel,$stmt,'00140',$user,$server_ip,$session_name,$one_mysql_log);}
				$affected_rows = mysql_affected_rows($linkB);

				mysql_close($linkB);
				}
			}

	echo "$vul_insert|$vc_remove|$vla_delete|$wcs_delete|$agent_channel|$vlia_delete\n";
	}
}


################################################################################
### updateDISPO - update the vicidial_list table to reflect the agent choice of
###               call disposition for that leand
################################################################################
if ($ACTION == 'updateDISPO')
{
	$MT[0]='';
	$row='';   $rowx='';
	if ( (strlen($dispo_choice)<1) || (strlen($lead_id)<1) )
	{
	echo "Dispo Choice $dispo or lead_id $lead_id nie jest prawidłowy\n";
	exit;
	}
	else
	{
	### update the comments in vicidial_live_agents record
	$stmt = "UPDATE vicidial_live_agents set lead_id=0,external_hangup=0,external_status='' where user='$user' and server_ip='$server_ip';";
	if ($DB) {echo "$stmt\n";}
	$rslt=mysql_query($stmt, $link);
			if ($mel > 0) {$errno = mysql_error_logging($NOW_TIME,$link,$mel,$stmt,'00141',$user,$server_ip,$session_name,$one_mysql_log);}
			$retry_count=0;
			while ( ($errno > 0) and ($retry_count < 9) )
				{
				$rslt=mysql_query($stmt, $link);
				$one_mysql_log=1;
				$errno = mysql_error_logging($NOW_TIME,$link,$mel,$stmt,"9141$retry_count",$user,$server_ip,$session_name,$one_mysql_log);
				$one_mysql_log=0;
				$retry_count++;
				}

	$stmt="UPDATE vicidial_list set status='$dispo_choice', user='$user' where lead_id='$lead_id';";
		if ($format=='debug') {echo "\n<!-- $stmt -->";}
	$rslt=mysql_query($stmt, $link);
			if ($mel > 0) {mysql_error_logging($NOW_TIME,$link,$mel,$stmt,'00142',$user,$server_ip,$session_name,$one_mysql_log);}

	$stmt = "select count(*) from vicidial_inbound_groups where group_id='$stage';";
		if ($format=='debug') {echo "\n<!-- $stmt -->";}
	$rslt=mysql_query($stmt, $link);
			if ($mel > 0) {mysql_error_logging($NOW_TIME,$link,$mel,$stmt,'00143',$user,$server_ip,$session_name,$one_mysql_log);}
		$row=mysql_fetch_row($rslt);
	if ($row[0] > 0)
		{
		$stmt = "UPDATE vicidial_closer_log set status='$dispo_choice' where lead_id='$lead_id' and user='$user' order by closecallid desc limit 1;";
		if ($DB) {echo "$stmt\n";}
		$rslt=mysql_query($stmt, $link);
			if ($mel > 0) {mysql_error_logging($NOW_TIME,$link,$mel,$stmt,'00144',$user,$server_ip,$session_name,$one_mysql_log);}
		}
	else
		{
		$stmt="UPDATE vicidial_log set status='$dispo_choice' where lead_id='$lead_id' and user='$user' order by uniqueid desc limit 1;";
			if ($format=='debug') {echo "\n<!-- $stmt -->";}
		$rslt=mysql_query($stmt, $link);
			if ($mel > 0) {mysql_error_logging($NOW_TIME,$link,$mel,$stmt,'00145',$user,$server_ip,$session_name,$one_mysql_log);}
		}

	if ( ($use_internal_dnc=='Y') and ($dispo_choice=='DNC') )
		{
		$stmt = "select phone_number from vicidial_list where lead_id='$lead_id';";
		if ($DB) {echo "$stmt\n";}
		$rslt=mysql_query($stmt, $link);
			if ($mel > 0) {mysql_error_logging($NOW_TIME,$link,$mel,$stmt,'00146',$user,$server_ip,$session_name,$one_mysql_log);}
			$row=mysql_fetch_row($rslt);
		$stmt="INSERT INTO vicidial_dnc (phone_number) values('$row[0]');";
		$rslt=mysql_query($stmt, $link);
			if ($mel > 0) {mysql_error_logging($NOW_TIME,$link,$mel,$stmt,'00147',$user,$server_ip,$session_name,$one_mysql_log);}
		if ($DB) {echo "$stmt\n";}
		}
	if ( ($use_campaign_dnc=='Y') and ($dispo_choice=='DNC') )
		{
		$stmt = "select phone_number from vicidial_list where lead_id='$lead_id';";
		if ($DB) {echo "$stmt\n";}
		$rslt=mysql_query($stmt, $link);
			if ($mel > 0) {mysql_error_logging($NOW_TIME,$link,$mel,$stmt,'00148',$user,$server_ip,$session_name,$one_mysql_log);}
			$row=mysql_fetch_row($rslt);
		$stmt="INSERT INTO vicidial_campaign_dnc (phone_number,campaign_id) values('$row[0]','$campaign');";
		$rslt=mysql_query($stmt, $link);
			if ($mel > 0) {mysql_error_logging($NOW_TIME,$link,$mel,$stmt,'00149',$user,$server_ip,$session_name,$one_mysql_log);}
		if ($DB) {echo "$stmt\n";}
		}
	}

	$dispo_sec=0;
	$dispo_epochSQL='';
	$StarTtime = date("U");
	$stmt = "select dispo_epoch,dispo_sec,talk_epoch from vicidial_agent_log where agent_log_id='$agent_log_id';";
	if ($DB) {echo "$stmt\n";}
	$rslt=mysql_query($stmt, $link);
			if ($mel > 0) {mysql_error_logging($NOW_TIME,$link,$mel,$stmt,'00150',$user,$server_ip,$session_name,$one_mysql_log);}
	$VDpr_ct = mysql_num_rows($rslt);
	if ($VDpr_ct > 0)
		{
		$row=mysql_fetch_row($rslt);
		if ( (eregi("NULL",$row[0])) or ($row[0] < 1000) )
			{
			$dispo_epochSQL=",dispo_epoch='$StarTtime'";
			$row[0]=$row[2];
			}
		$dispo_sec = (($StarTtime - $row[0]) + $row[1]);
		}
	$stmt="UPDATE vicidial_agent_log set dispo_sec='$dispo_sec',status='$dispo_choice' $dispo_epochSQL where agent_log_id='$agent_log_id';";
		if ($format=='debug') {echo "\n<!-- $stmt -->";}
	$rslt=mysql_query($stmt, $link);
			if ($mel > 0) {mysql_error_logging($NOW_TIME,$link,$mel,$stmt,'00151',$user,$server_ip,$session_name,$one_mysql_log);}

		$user_group='';
		$stmt="SELECT user_group FROM vicidial_users where user='$user' LIMIT 1;";
		$rslt=mysql_query($stmt, $link);
			if ($mel > 0) {mysql_error_logging($NOW_TIME,$link,$mel,$stmt,'00152',$user,$server_ip,$session_name,$one_mysql_log);}
		if ($DB) {echo "$stmt\n";}
		$ug_record_ct = mysql_num_rows($rslt);
		if ($ug_record_ct > 0)
			{
			$row=mysql_fetch_row($rslt);
			$user_group =		trim("$row[0]");
			}

	if ($auto_dial_level < 1)
		{
		$stmt="INSERT INTO vicidial_agent_log (user,server_ip,event_time,campaign_id,pause_epoch,pause_sec,wait_epoch,user_group) values('$user','$server_ip','$NOW_TIME','$campaign','$StarTtime','0','$StarTtime','$user_group');";
		if ($DB) {echo "$stmt\n";}
		$rslt=mysql_query($stmt, $link);
				if ($mel > 0) {mysql_error_logging($NOW_TIME,$link,$mel,$stmt,'00153',$user,$server_ip,$session_name,$one_mysql_log);}
		$affected_rows = mysql_affected_rows($link);
		$agent_log_id = mysql_insert_id($link);
		}

	### RozmowaBACK ENTRY
	if ( ($dispo_choice == 'CBHOLD') and (strlen($CallBackDatETimE)>10) )
		{
		$comments = eregi_replace('"','',$comments);
		$comments = eregi_replace("'",'',$comments);
		$comments = eregi_replace(';','',$comments);
		$comments = eregi_replace("\\\\",' ',$comments);
		$stmt="INSERT INTO vicidial_callbacks (lead_id,list_id,campaign_id,status,entry_time,callback_time,user,recipient,comments,user_group) values('$lead_id','$list_id','$campaign','ACTIVE','$NOW_TIME','$CallBackDatETimE','$user','$recipient','$comments','$user_group');";
		if ($DB) {echo "$stmt\n";}
		$rslt=mysql_query($stmt, $link);
			if ($mel > 0) {mysql_error_logging($NOW_TIME,$link,$mel,$stmt,'00154',$user,$server_ip,$session_name,$one_mysql_log);}
		}

	$stmt="SELECT auto_alt_dial_statuses from vicidial_campaigns where campaign_id='$campaign';";
	$rslt=mysql_query($stmt, $link);
			if ($mel > 0) {mysql_error_logging($NOW_TIME,$link,$mel,$stmt,'00155',$user,$server_ip,$session_name,$one_mysql_log);}
	$row=mysql_fetch_row($rslt);

	if ( ($auto_dial_level > 0) and (ereg(" $dispo_choice ",$row[0])) )
		{
		$stmt = "select count(*) from vicidial_hopper where lead_id='$lead_id' and status='HOLD';";
		if ($DB) {echo "$stmt\n";}
		$rslt=mysql_query($stmt, $link);
			if ($mel > 0) {mysql_error_logging($NOW_TIME,$link,$mel,$stmt,'00156',$user,$server_ip,$session_name,$one_mysql_log);}
		$row=mysql_fetch_row($rslt);

		if ($row[0] > 0)
			{
			$stmt="UPDATE vicidial_hopper set status='READY' where lead_id='$lead_id' and status='HOLD' limit 1;";
				if ($format=='debug') {echo "\n<!-- $stmt -->";}
			$rslt=mysql_query($stmt, $link);
			if ($mel > 0) {mysql_error_logging($NOW_TIME,$link,$mel,$stmt,'00157',$user,$server_ip,$session_name,$one_mysql_log);}
			}
		}
	else
		{
		$stmt="DELETE from vicidial_hopper where lead_id='$lead_id' and status='HOLD';";
			if ($format=='debug') {echo "\n<!-- $stmt -->";}
		$rslt=mysql_query($stmt, $link);
			if ($mel > 0) {mysql_error_logging($NOW_TIME,$link,$mel,$stmt,'00158',$user,$server_ip,$session_name,$one_mysql_log);}
		}

	#############################################
	##### START QUEUEMETRICS LOGGING LOOKUP #####
	$stmt = "SELECT enable_queuemetrics_logging,queuemetrics_server_ip,queuemetrics_dbname,queuemetrics_login,queuemetrics_pass,queuemetrics_log_id FROM system_settings;";
	$rslt=mysql_query($stmt, $link);
			if ($mel > 0) {mysql_error_logging($NOW_TIME,$link,$mel,$stmt,'00159',$user,$server_ip,$session_name,$one_mysql_log);}
	if ($DB) {echo "$stmt\n";}
	$qm_conf_ct = mysql_num_rows($rslt);
	$i=0;
	while ($i < $qm_conf_ct)
		{
		$row=mysql_fetch_row($rslt);
		$enable_queuemetrics_logging =	$row[0];
		$queuemetrics_server_ip	=		$row[1];
		$queuemetrics_dbname =			$row[2];
		$queuemetrics_login	=			$row[3];
		$queuemetrics_pass =			$row[4];
		$queuemetrics_log_id =			$row[5];
		$i++;
		}
	##### END QUEUEMETRICS LOGGING LOOKUP #####
	###########################################
	if ($enable_queuemetrics_logging > 0)
		{
		$linkB=mysql_connect("$queuemetrics_server_ip", "$queuemetrics_login", "$queuemetrics_pass");
		mysql_select_db("$queuemetrics_dbname", $linkB);

		if (strlen($stage) < 2) 
			{$stage = $campaign;}

		$stmt = "INSERT INTO queue_log SET partition='P01',time_id='$StarTtime',call_id='$MDnextCID',queue='$stage',agent='Agent/$user',verb='CALLSTATUS',data1='$dispo_choice',serverid='$queuemetrics_log_id';";
		if ($DB) {echo "$stmt\n";}
		$rslt=mysql_query($stmt, $linkB);
			if ($mel > 0) {mysql_error_logging($NOW_TIME,$linkB,$mel,$stmt,'00160',$user,$server_ip,$session_name,$one_mysql_log);}
		$affected_rows = mysql_affected_rows($linkB);

		mysql_close($linkB);
		}

	echo 'Lead ' . $lead_id . ' zmieniono na ' . $dispo_choice . " Status\nNext agent_log_id:\n" . $agent_log_id . "\n";
}

################################################################################
### updateLEAD - update the vicidial_list table to reflect the values that are
###              in the agents screen at time of call hangup
################################################################################
if ($ACTION == 'updateLEAD')
{
	$MT[0]='';
	$row='';   $rowx='';
	$DO_NOT_UPDATE=0;
	$DO_NOT_UPDATE_text='';
	if ( (strlen($phone_number)<1) || (strlen($lead_id)<1) )
	{
	echo "phone_number $phone_number or lead_id $lead_id nie jest prawidłowy\n";
	exit;
	}
	else
	{

	$stmt = "SELECT disable_alter_custdata,disable_alter_custphone FROM vicidial_campaigns where campaign_id='$campaign'";
	$rslt=mysql_query($stmt, $link);
			if ($mel > 0) {mysql_error_logging($NOW_TIME,$link,$mel,$stmt,'00161',$user,$server_ip,$session_name,$one_mysql_log);}
	if ($DB) {echo "$stmt\n";}
	$dac_conf_ct = mysql_num_rows($rslt);
	$i=0;
	while ($i < $dac_conf_ct)
		{
		$row=mysql_fetch_row($rslt);
		$disable_alter_custdata =	$row[0];
		$disable_alter_custphone =	$row[1];
		$i++;
		}
	if ( (ereg('Y',$disable_alter_custdata)) or (ereg('Y',$disable_alter_custphone)) )
		{
		if (ereg('Y',$disable_alter_custdata))
			{
			$DO_NOT_UPDATE=1;
			$DO_NOT_UPDATE_text=' NOT';
			}
		if (ereg('Y',$disable_alter_custphone))
			{
			$DO_NOT_UPDATEphone=1;
			}
		$stmt = "SELECT alter_custdata_override,alter_custphone_override FROM vicidial_users where user='$user'";
		$rslt=mysql_query($stmt, $link);
			if ($mel > 0) {mysql_error_logging($NOW_TIME,$link,$mel,$stmt,'00162',$user,$server_ip,$session_name,$one_mysql_log);}
		if ($DB) {echo "$stmt\n";}
		$aco_conf_ct = mysql_num_rows($rslt);
		$i=0;
		while ($i < $aco_conf_ct)
			{
			$row=mysql_fetch_row($rslt);
			$alter_custdata_override =	$row[0];
			$alter_custphone_override = $row[1];
			$i++;
			}
		if (ereg('ALLOW_ALTER',$alter_custdata_override))
			{
			$DO_NOT_UPDATE=0;
			$DO_NOT_UPDATE_text='';
			}
		if (ereg('ALLOW_ALTER',$alter_custphone_override))
			{
			$DO_NOT_UPDATEphone=0;
			}
		}

	if ($DO_NOT_UPDATE < 1)
		{
		$comments = eregi_replace("\r",'',$comments);
		$comments = eregi_replace("\n",'!N',$comments);
		$comments = eregi_replace("--AMP--",'&',$comments);
		$comments = eregi_replace("--QUES--",'?',$comments);
		$comments = eregi_replace("--POUND--",'#',$comments);

		$phoneSQL='';
		if ($DO_NOT_UPDATEphone < 1)
			{$phoneSQL = ",phone_number='$phone_number'";}

		$stmt="UPDATE vicidial_list set vendor_lead_code='" . mysql_real_escape_string($vendor_lead_code) . "', title='" . mysql_real_escape_string($title) . "', first_name='" . mysql_real_escape_string($first_name) . "', middle_initial='" . mysql_real_escape_string($middle_initial) . "', last_name='" . mysql_real_escape_string($last_name) . "', address1='" . mysql_real_escape_string($address1) . "', address2='" . mysql_real_escape_string($address2) . "', address3='" . mysql_real_escape_string($address3) . "', city='" . mysql_real_escape_string($city) . "', state='" . mysql_real_escape_string($state) . "', province='" . mysql_real_escape_string($province) . "', postal_code='" . mysql_real_escape_string($postal_code) . "', country_code='" . mysql_real_escape_string($country_code) . "', gender='" . mysql_real_escape_string($gender) . "', date_of_birth='" . mysql_real_escape_string($date_of_birth) . "', alt_phone='" . mysql_real_escape_string($alt_phone) . "', email='" . mysql_real_escape_string($email) . "', security_phrase='" . mysql_real_escape_string($security_phrase) . "', comments='" . mysql_real_escape_string($comments) . "' $phoneSQL where lead_id='$lead_id';";
			if ($format=='debug') {echo "\n<!-- $stmt -->";}
		$rslt=mysql_query($stmt, $link);
			if ($mel > 0) {mysql_error_logging($NOW_TIME,$link,$mel,$stmt,'00163',$user,$server_ip,$session_name,$one_mysql_log);}
		}

	$random = (rand(1000000, 9999999) + 10000000);
	$stmt="UPDATE vicidial_live_agents set random_id='$random' where user='$user' and server_ip='$server_ip';";
		if ($format=='debug') {echo "\n<!-- $stmt -->";}
	$rslt=mysql_query($stmt, $link);
			if ($mel > 0) {$errno = mysql_error_logging($NOW_TIME,$link,$mel,$stmt,'00164',$user,$server_ip,$session_name,$one_mysql_log);}
			$retry_count=0;
			while ( ($errno > 0) and ($retry_count < 9) )
				{
				$rslt=mysql_query($stmt, $link);
				$one_mysql_log=1;
				$errno = mysql_error_logging($NOW_TIME,$link,$mel,$stmt,"9164$retry_count",$user,$server_ip,$session_name,$one_mysql_log);
				$one_mysql_log=0;
				$retry_count++;
				}

	}
	echo "Lead $lead_id information has$DO_NOT_UPDATE_text been updated\n";
}


################################################################################
### VDADpause - update the vicidial_live_agents table to show that the agent is
###  or ready   now active and ready to take calls
################################################################################
if ( ($ACTION == 'VDADpause') || ($ACTION == 'VDADready') )
{
	$MT[0]='';
	$row='';   $rowx='';
	if ( (strlen($stage)<2) || (strlen($server_ip)<1) )
	{
	echo "stage $stage nie jest prawidłowy\n";
	exit;
	}
	else
	{
	$random = (rand(1000000, 9999999) + 10000000);
	$stmt="UPDATE vicidial_live_agents set uniqueid=0,callerid='',channel='', random_id='$random',comments='' where user='$user' and server_ip='$server_ip';";
		if ($format=='debug') {echo "\n<!-- $stmt -->";}
	$rslt=mysql_query($stmt, $link);
			if ($mel > 0) {$errno = mysql_error_logging($NOW_TIME,$link,$mel,$stmt,'00165',$user,$server_ip,$session_name,$one_mysql_log);}
			$retry_count=0;
			while ( ($errno > 0) and ($retry_count < 9) )
				{
				$rslt=mysql_query($stmt, $link);
				$one_mysql_log=1;
				$errno = mysql_error_logging($NOW_TIME,$link,$mel,$stmt,"9165$retry_count",$user,$server_ip,$session_name,$one_mysql_log);
				$one_mysql_log=0;
				$retry_count++;
				}

	$stmt="UPDATE vicidial_live_agents set status='$stage' where user='$user' and server_ip='$server_ip';";
		if ($format=='debug') {echo "\n<!-- $stmt -->";}
	$rslt=mysql_query($stmt, $link);
			if ($mel > 0) {$errno = mysql_error_logging($NOW_TIME,$link,$mel,$stmt,'00166',$user,$server_ip,$session_name,$one_mysql_log);}
			$retry_count=0;
			while ( ($errno > 0) and ($retry_count < 9) )
				{
				$rslt=mysql_query($stmt, $link);
				$one_mysql_log=1;
				$errno = mysql_error_logging($NOW_TIME,$link,$mel,$stmt,"9166$retry_count",$user,$server_ip,$session_name,$one_mysql_log);
				$one_mysql_log=0;
				$retry_count++;
				}
	$affected_rows = mysql_affected_rows($link);
	if ($affected_rows > 0) 
		{
		#############################################
		##### START QUEUEMETRICS LOGGING LOOKUP #####
		$stmt = "SELECT enable_queuemetrics_logging,queuemetrics_server_ip,queuemetrics_dbname,queuemetrics_login,queuemetrics_pass,queuemetrics_log_id FROM system_settings;";
		$rslt=mysql_query($stmt, $link);
			if ($mel > 0) {mysql_error_logging($NOW_TIME,$link,$mel,$stmt,'00167',$user,$server_ip,$session_name,$one_mysql_log);}
		if ($DB) {echo "$stmt\n";}
		$qm_conf_ct = mysql_num_rows($rslt);
		$i=0;
		while ($i < $qm_conf_ct)
			{
			$row=mysql_fetch_row($rslt);
			$enable_queuemetrics_logging =	$row[0];
			$queuemetrics_server_ip	=		$row[1];
			$queuemetrics_dbname =			$row[2];
			$queuemetrics_login	=			$row[3];
			$queuemetrics_pass =			$row[4];
			$queuemetrics_log_id =			$row[5];
			$i++;
			}
		##### END QUEUEMETRICS LOGGING LOOKUP #####
		###########################################
		if ($enable_queuemetrics_logging > 0)
			{
			if ( (ereg('READY',$stage)) or (ereg('CLOSER',$stage)) ) {$QMstatus='UNPAUSEALL';}
			if (ereg('PAUSE',$stage)) {$QMstatus='PAUSEALL';}
			$linkB=mysql_connect("$queuemetrics_server_ip", "$queuemetrics_login", "$queuemetrics_pass");
			mysql_select_db("$queuemetrics_dbname", $linkB);

			$user_group='';
			$stmt="SELECT user_group FROM vicidial_users where user='$user' LIMIT 1;";
			$rslt=mysql_query($stmt, $link);
				if ($mel > 0) {mysql_error_logging($NOW_TIME,$link,$mel,$stmt,'00182',$user,$server_ip,$session_name,$one_mysql_log);}
			if ($DB) {echo "$stmt\n";}
			$ug_record_ct = mysql_num_rows($rslt);
			if ($ug_record_ct > 0)
				{
				$row=mysql_fetch_row($rslt);
				$user_group =		trim("$row[0]");
				}

			$stmt = "INSERT INTO queue_log SET partition='P01',time_id='$StarTtime',call_id='NONE',queue='NONE',agent='Agent/$user',verb='$QMstatus',serverid='$queuemetrics_log_id';";
			if ($DB) {echo "$stmt\n";}
			$rslt=mysql_query($stmt, $linkB);
			if ($mel > 0) {mysql_error_logging($NOW_TIME,$linkB,$mel,$stmt,'00168',$user,$server_ip,$session_name,$one_mysql_log);}
			$affected_rows = mysql_affected_rows($linkB);

			mysql_close($linkB);
			}
		}

	$pause_sec=0;
	$stmt = "select pause_epoch,pause_sec,wait_epoch,wait_sec,dispo_epoch from vicidial_agent_log where agent_log_id='$agent_log_id';";
	if ($DB) {echo "$stmt\n";}
	$rslt=mysql_query($stmt, $link);
		if ($mel > 0) {mysql_error_logging($NOW_TIME,$link,$mel,$stmt,'00169',$user,$server_ip,$session_name,$one_mysql_log);}
	$VDpr_ct = mysql_num_rows($rslt);
	if ($VDpr_ct > 0)
		{
		$row=mysql_fetch_row($rslt);
		$dispo_epoch = $row[4];
		$wait_sec=0;
		if ($row[2] > 0)
			{
			$wait_sec = (($StarTtime - $row[2]) + $row[3]);
			}
		if ( (eregi("NULL",$row[4])) or ($row[4] < 1000) )
			{$pause_sec = (($StarTtime - $row[0]) + $row[1]);}
		else
			{$pause_sec = (($row[4] - $row[0]) + $row[1]);}

		}
	if ($ACTION == 'VDADready')
		{
		if ( (eregi("NULL",$dispo_epoch)) or ($dispo_epoch < 1000) )
			{
			$stmt="UPDATE vicidial_agent_log set pause_sec='$pause_sec',wait_epoch='$StarTtime' where agent_log_id='$agent_log_id';";
				if ($format=='debug') {echo "\n<!-- $stmt -->";}
			$rslt=mysql_query($stmt, $link);
			if ($mel > 0) {mysql_error_logging($NOW_TIME,$link,$mel,$stmt,'00170',$user,$server_ip,$session_name,$one_mysql_log);}
			}
		}
	if ($ACTION == 'VDADpause')
		{
		if ( (eregi("NULL",$dispo_epoch)) or ($dispo_epoch < 1000) )
			{
			$stmt="UPDATE vicidial_agent_log set wait_sec='$wait_sec' where agent_log_id='$agent_log_id';";
				if ($format=='debug') {echo "\n<!-- $stmt -->";}
			$rslt=mysql_query($stmt, $link);
			if ($mel > 0) {mysql_error_logging($NOW_TIME,$link,$mel,$stmt,'00171',$user,$server_ip,$session_name,$one_mysql_log);}
			}
		
		$agent_log = 'NEW_ID';
		}

	if ($agent_log == 'NEW_ID')
		{
		$user_group='';
		$stmt="SELECT user_group FROM vicidial_users where user='$user' LIMIT 1;";
		$rslt=mysql_query($stmt, $link);
			if ($mel > 0) {mysql_error_logging($NOW_TIME,$link,$mel,$stmt,'00182',$user,$server_ip,$session_name,$one_mysql_log);}
		if ($DB) {echo "$stmt\n";}
		$ug_record_ct = mysql_num_rows($rslt);
		if ($ug_record_ct > 0)
			{
			$row=mysql_fetch_row($rslt);
			$user_group =		trim("$row[0]");
			}

		$stmt="INSERT INTO vicidial_agent_log (user,server_ip,event_time,campaign_id,pause_epoch,pause_sec,wait_epoch,user_group) values('$user','$server_ip','$NOW_TIME','$campaign','$StarTtime','0','$StarTtime','$user_group');";
		if ($DB) {echo "$stmt\n";}
		$rslt=mysql_query($stmt, $link);
				if ($mel > 0) {mysql_error_logging($NOW_TIME,$link,$mel,$stmt,'00153',$user,$server_ip,$session_name,$one_mysql_log);}
		$affected_rows = mysql_affected_rows($link);
		$agent_log_id = mysql_insert_id($link);
		}
	}
	echo 'Agent ' . $user . ' ma statusie ' . $stage . "\nNext agent_log_id:\n$agent_log_id\n";
}


################################################################################
### UpdatEFavoritEs - update the astguiclient favorites list for this extension
################################################################################
if ($ACTION == 'UpdatEFavoritEs')
{
	$row='';   $rowx='';
	$channel_live=1;
	if ( (strlen($favorites_list)<1) || (strlen($user)<1) || (strlen($exten)<1) )
	{
	echo "favorites list $favorites_list nie jest prawidłowy\n";
	exit;
	}
	else
	{
	$stmt = "select count(*) from phone_favorites where extension='$exten' and server_ip='$server_ip';";
	if ($DB) {echo "$stmt\n";}
	$rslt=mysql_query($stmt, $link);
			if ($mel > 0) {mysql_error_logging($NOW_TIME,$link,$mel,$stmt,'00172',$user,$server_ip,$session_name,$one_mysql_log);}
	$row=mysql_fetch_row($rslt);

	if ($row[0] > 0)
		{
		$stmt="UPDATE phone_favorites set extensions_list=\"$favorites_list\" where extension='$exten' and server_ip='$server_ip';";
			if ($format=='debug') {echo "\n<!-- $stmt -->";}
		$rslt=mysql_query($stmt, $link);
			if ($mel > 0) {mysql_error_logging($NOW_TIME,$link,$mel,$stmt,'00173',$user,$server_ip,$session_name,$one_mysql_log);}
		}
	else
		{
		$stmt="INSERT INTO phone_favorites values('$exten','$server_ip',\"$favorites_list\");";
			if ($format=='debug') {echo "\n<!-- $stmt -->";}
		$rslt=mysql_query($stmt, $link);
			if ($mel > 0) {mysql_error_logging($NOW_TIME,$link,$mel,$stmt,'00174',$user,$server_ip,$session_name,$one_mysql_log);}
		}
	}
	echo "Favorites list has been updated to $favorites_list for $exten\n";
}


################################################################################
### PauseCodeSubmit - Update vicidial_agent_log with pause code
################################################################################
if ($ACTION == 'PauseCodeSubmit')
{
	$row='';   $rowx='';
	if ( (strlen($status)<1) || (strlen($agent_log_id)<1) )
	{
	echo "agent_log_id $agent_log_id or pause_code $status nie jest prawidłowy\n";
	exit;
	}
	else
	{
	$stmt="UPDATE vicidial_agent_log set sub_status=\"$status\" where agent_log_id='$agent_log_id';";
		if ($format=='debug') {echo "\n<!-- $stmt -->";}
	$rslt=mysql_query($stmt, $link);
			if ($mel > 0) {mysql_error_logging($NOW_TIME,$link,$mel,$stmt,'00175',$user,$server_ip,$session_name,$one_mysql_log);}
	$affected_rows = mysql_affected_rows($link);
	if ($affected_rows > 0) 
		{
		#############################################
		##### START QUEUEMETRICS LOGGING LOOKUP #####
		$stmt = "SELECT enable_queuemetrics_logging,queuemetrics_server_ip,queuemetrics_dbname,queuemetrics_login,queuemetrics_pass,queuemetrics_log_id,allow_sipsak_messages FROM system_settings;";
		$rslt=mysql_query($stmt, $link);
			if ($mel > 0) {mysql_error_logging($NOW_TIME,$link,$mel,$stmt,'00176',$user,$server_ip,$session_name,$one_mysql_log);}
		if ($DB) {echo "$stmt\n";}
		$qm_conf_ct = mysql_num_rows($rslt);
		$i=0;
		while ($i < $qm_conf_ct)
			{
			$row=mysql_fetch_row($rslt);
			$enable_queuemetrics_logging =	$row[0];
			$queuemetrics_server_ip	=		$row[1];
			$queuemetrics_dbname =			$row[2];
			$queuemetrics_login	=			$row[3];
			$queuemetrics_pass =			$row[4];
			$queuemetrics_log_id =			$row[5];
			$allow_sipsak_messages =		$row[6];
			$i++;
			}
		##### END QUEUEMETRICS LOGGING LOOKUP #####
		###########################################
		if ( ($enable_sipsak_messages > 0) and ($allow_sipsak_messages > 0) and (eregi("SIP",$protocol)) )
			{
			$SIPSAK_prefix = 'BK-';
			passthru("/usr/local/bin/sipsak -M -O desktop -B \"$SIPSAK_prefix$status\" -r 5060 -s sip:$extension@$phone_ip > /dev/null");
			}
		if ($enable_queuemetrics_logging > 0)
			{
			$linkB=mysql_connect("$queuemetrics_server_ip", "$queuemetrics_login", "$queuemetrics_pass");
			mysql_select_db("$queuemetrics_dbname", $linkB);

			$stmt = "INSERT INTO queue_log SET partition='P01',time_id='$StarTtime',call_id='NONE',queue='$campaign',agent='Agent/$user',verb='PAUSEREASON',serverid='$queuemetrics_log_id',data1='$status';";
			if ($DB) {echo "$stmt\n";}
			$rslt=mysql_query($stmt, $linkB);
			if ($mel > 0) {mysql_error_logging($NOW_TIME,$linkB,$mel,$stmt,'00177',$user,$server_ip,$session_name,$one_mysql_log);}
			$affected_rows = mysql_affected_rows($linkB);

			mysql_close($linkB);
			}
		}
	}
echo " Przerwa Code has been updated to $status for $agent_log_id\n";
}


################################################################################
### CalLBacKLisT - List the USERONLY callbacks for an agent
################################################################################
if ($ACTION == 'CalLBacKLisT')
{
$stmt = "select callback_id,lead_id,campaign_id,status,entry_time,callback_time,comments from vicidial_callbacks where recipient='USERONLY' and user='$user' and campaign_id='$campaign' and status NOT IN('INACTIVE','DEAD') order by callback_time;";
if ($DB) {echo "$stmt\n";}
$rslt=mysql_query($stmt, $link);
			if ($mel > 0) {mysql_error_logging($NOW_TIME,$link,$mel,$stmt,'00178',$user,$server_ip,$session_name,$one_mysql_log);}
if ($rslt) {$callbacks_count = mysql_num_rows($rslt);}
echo "$callbacks_count\n";
$loop_count=0;
	while ($callbacks_count>$loop_count)
	{
	$row=mysql_fetch_row($rslt);
	$callback_id[$loop_count]	= $row[0];
	$lead_id[$loop_count]		= $row[1];
	$campaign_id[$loop_count]	= $row[2];
	$status[$loop_count]		= $row[3];
	$entry_time[$loop_count]	= $row[4];
	$callback_time[$loop_count]	= $row[5];
	$comments[$loop_count]		= $row[6];
	$loop_count++;
	}
$loop_count=0;
	while ($callbacks_count>$loop_count)
	{
	$stmt = "select first_name,last_name,phone_number from vicidial_list where lead_id='$lead_id[$loop_count]';";
	if ($DB) {echo "$stmt\n";}
	$rslt=mysql_query($stmt, $link);
			if ($mel > 0) {mysql_error_logging($NOW_TIME,$link,$mel,$stmt,'00179',$user,$server_ip,$session_name,$one_mysql_log);}
	$row=mysql_fetch_row($rslt);

	echo "$row[0] ~$row[1] ~$row[2] ~$callback_id[$loop_count] ~$lead_id[$loop_count] ~$campaign_id[$loop_count] ~$status[$loop_count] ~$entry_time[$loop_count] ~$callback_time[$loop_count] ~$comments[$loop_count]\n";
	$loop_count++;
	}

}


################################################################################
### CalLBacKCounT - send the count of the USERONLY callbacks for an agent
################################################################################
if ($ACTION == 'CalLBacKCounT')
{
$stmt = "select count(*) from vicidial_callbacks where recipient='USERONLY' and user='$user' and campaign_id='$campaign' and status NOT IN('INACTIVE','DEAD');";
if ($DB) {echo "$stmt\n";}
$rslt=mysql_query($stmt, $link);
			if ($mel > 0) {mysql_error_logging($NOW_TIME,$link,$mel,$stmt,'00180',$user,$server_ip,$session_name,$one_mysql_log);}
$row=mysql_fetch_row($rslt);
$cbcount=$row[0];

echo "$cbcount";
}




if ($format=='debug') 
{
$ENDtime = date("U");
$RUNtime = ($ENDtime - $StarTtime);
echo "\n<!-- czas działania skyptu: $RUNtime sekundy -->";
echo "\n</body>\n</html>\n";
}
	
exit; 





##### MySQL Error Logging #####
function mysql_error_logging($NOW_TIME,$link,$mel,$stmt,$query_id,$user,$server_ip,$session_name,$one_mysql_log)
{
$NOW_TIME = date("Y-m-d H:i:s");
#	mysql_error_logging($NOW_TIME,$link,$mel,$stmt,'00001',$user,$server_ip,$session_name,$one_mysql_log);
$errno='';   $error='';
if ( ($mel > 0) or ($one_mysql_log > 0) )
	{
	$errno = mysql_errno($link);
	if ( ($errno > 0) or ($mel > 1) or ($one_mysql_log > 0) )
		{
		$error = mysql_error($link);
		$efp = fopen ("./vicidial_mysql_errors.txt", "a");
		fwrite ($efp, "$NOW_TIME|vdc_db_query|$query_id|$errno|$error|$stmt|$user|$server_ip|$session_name|\n");
		fclose($efp);
		}
	}
$one_mysql_log=0;
return $errno;
}

?>
