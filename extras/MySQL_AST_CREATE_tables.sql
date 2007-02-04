 CREATE TABLE phones (
extension VARCHAR(100),
dialplan_number VARCHAR(20),
voicemail_id VARCHAR(10),
phone_ip VARCHAR(15),
computer_ip VARCHAR(15),
server_ip VARCHAR(15),
login VARCHAR(15),
pass VARCHAR(10),
status VARCHAR(10),
active ENUM('Y','N'),
phone_type VARCHAR(50),
fullname VARCHAR(50),
company VARCHAR(10),
picture VARCHAR(19),
messages INT(4),
old_messages INT(4),
protocol ENUM('SIP','Zap','IAX2','EXTERNAL') default 'SIP',
local_gmt VARCHAR(6) default '-5',
ASTmgrUSERNAME VARCHAR(20) default 'cron',
ASTmgrSECRET VARCHAR(20) default '1234',
login_user VARCHAR(20),
login_pass VARCHAR(20),
login_campaign VARCHAR(10),
park_on_extension VARCHAR(10) default '8301',
conf_on_extension VARCHAR(10) default '8302',
VICIDIAL_park_on_extension VARCHAR(10) default '8301',
VICIDIAL_park_on_filename VARCHAR(10) default 'park',
monitor_prefix VARCHAR(10) default '8612',
recording_exten VARCHAR(10) default '8309',
voicemail_exten VARCHAR(10) default '8501',
voicemail_dump_exten VARCHAR(20) default '85026666666666',
ext_context VARCHAR(20) default 'default',
dtmf_send_extension VARCHAR(100) default 'local/8500998@default',
call_out_number_group VARCHAR(100) default 'Zap/g2/',
client_browser VARCHAR(100) default '/usr/bin/mozilla',
install_directory VARCHAR(100) default '/usr/local/perl_TK',
local_web_callerID_URL VARCHAR(255) default 'http://astguiclient.sf.net/test_callerid_output.php',
VICIDIAL_web_URL VARCHAR(255) default 'http://astguiclient.sf.net/test_VICIDIAL_output.php',
AGI_call_logging_enabled ENUM('0','1') default '1',
user_switching_enabled ENUM('0','1') default '1',
conferencing_enabled ENUM('0','1') default '1',
admin_hangup_enabled ENUM('0','1') default '0',
admin_hijack_enabled ENUM('0','1') default '0',
admin_monitor_enabled ENUM('0','1') default '1',
call_parking_enabled ENUM('0','1') default '1',
updater_check_enabled ENUM('0','1') default '1',
AFLogging_enabled ENUM('0','1') default '1',
QUEUE_ACTION_enabled ENUM('0','1') default '1',
CallerID_popup_enabled ENUM('0','1') default '1',
voicemail_button_enabled ENUM('0','1') default '1',
enable_fast_refresh ENUM('0','1') default '0',
fast_refresh_rate INT(5) default '1000',
enable_persistant_mysql ENUM('0','1') default '0',
auto_dial_next_number ENUM('0','1') default '1',
VDstop_rec_after_each_call ENUM('0','1') default '1',
DBX_server VARCHAR(15),
DBX_database VARCHAR(15) default 'asterisk',
DBX_user VARCHAR(15) default 'cron',
DBX_pass VARCHAR(15) default '1234',
DBX_port INT(6) default '3306',
DBY_server VARCHAR(15),
DBY_database VARCHAR(15) default 'asterisk',
DBY_user VARCHAR(15) default 'cron',
DBY_pass VARCHAR(15) default '1234',
DBY_port INT(6) default '3306',
outbound_cid VARCHAR(20),
index (server_ip)
);

 CREATE TABLE servers (
server_id VARCHAR(10) NOT NULL,
server_description VARCHAR(255),
server_ip VARCHAR(15) NOT NULL,
active ENUM('Y','N'),
asterisk_version VARCHAR(20) default '1.2.9',
max_vicidial_trunks SMALLINT(4) default '96',
telnet_host VARCHAR(20) NOT NULL default 'localhost',
telnet_port INT(5) NOT NULL default '5038',
ASTmgrUSERNAME VARCHAR(20) NOT NULL default 'cron',
ASTmgrSECRET VARCHAR(20) NOT NULL default '1234',
ASTmgrUSERNAMEupdate VARCHAR(20) NOT NULL default 'updatecron',
ASTmgrUSERNAMElisten VARCHAR(20) NOT NULL default 'listencron',
ASTmgrUSERNAMEsend VARCHAR(20) NOT NULL default 'sendcron',
local_gmt VARCHAR(6) default '-5',
voicemail_dump_exten VARCHAR(20) NOT NULL default '85026666666666',
answer_transfer_agent VARCHAR(20) NOT NULL default '8365',
ext_context VARCHAR(20) NOT NULL default 'default',
sys_perf_log ENUM('Y','N') default 'N',
vd_server_logs ENUM('Y','N') default 'Y',
agi_output ENUM('NONE','STDERR','FILE','BOTH') default 'FILE',
vicidial_balance_active ENUM('Y','N') default 'N',
balance_trunks_offlimits SMALLINT(5) UNSIGNED default '0'
);


 CREATE TABLE live_channels (
channel VARCHAR(100) NOT NULL,
server_ip VARCHAR(15) NOT NULL,
channel_group VARCHAR(30),
extension VARCHAR(100),
channel_data VARCHAR(100)
);

 CREATE TABLE live_sip_channels (
channel VARCHAR(100) NOT NULL,
server_ip VARCHAR(15) NOT NULL,
channel_group VARCHAR(30),
extension VARCHAR(100),
channel_data VARCHAR(100)
);

 CREATE TABLE parked_channels (
channel VARCHAR(100) NOT NULL,
server_ip VARCHAR(15) NOT NULL,
channel_group VARCHAR(30),
extension VARCHAR(100),
parked_by VARCHAR(100),
parked_time DATETIME
);

 CREATE TABLE conferences (
conf_exten INT(7) UNSIGNED NOT NULL,
server_ip VARCHAR(15) NOT NULL,
extension VARCHAR(100)
);

 CREATE TABLE recording_log (
recording_id INT(10) UNSIGNED AUTO_INCREMENT PRIMARY KEY NOT NULL,
channel VARCHAR(100),
server_ip VARCHAR(15),
extension VARCHAR(100),
start_time DATETIME,
start_epoch INT(10),
end_time DATETIME,
end_epoch INT(10),
length_in_sec INT(10),
length_in_min DOUBLE(8,2),
filename VARCHAR(50),
location VARCHAR(255),
lead_id INT(9) UNSIGNED,
user VARCHAR(20),
index (filename),
index(lead_id),
index(user)
);

 CREATE TABLE live_inbound (
uniqueid DOUBLE(18,7) NOT NULL,
channel VARCHAR(100) NOT NULL,
server_ip VARCHAR(15) NOT NULL,
caller_id VARCHAR(30),
extension VARCHAR(100),
phone_ext VARCHAR(40),
start_time DATETIME,
acknowledged ENUM('Y','N') default 'N',
inbound_number VARCHAR(20),
comment_a VARCHAR(50),
comment_b VARCHAR(50),
comment_c VARCHAR(50),
comment_d VARCHAR(50),
comment_e VARCHAR(50)
);

 CREATE TABLE inbound_numbers (
extension VARCHAR(30) NOT NULL,
full_number VARCHAR(30) NOT NULL,
server_ip VARCHAR(15) NOT NULL,
inbound_name VARCHAR(30),
department VARCHAR(30)
);

 CREATE TABLE server_updater (
server_ip VARCHAR(15) NOT NULL,
last_update DATETIME
);

 CREATE TABLE call_log (
uniqueid DOUBLE(18,7) PRIMARY KEY NOT NULL,
channel VARCHAR(100),
channel_group VARCHAR(30),
type VARCHAR(10),
server_ip VARCHAR(15),
extension VARCHAR(100),
number_dialed VARCHAR(15),
caller_code VARCHAR(20),
start_time DATETIME,
start_epoch INT(10),
end_time DATETIME,
end_epoch INT(10),
length_in_sec INT(10),
length_in_min DOUBLE(8,2),
index (caller_code),
index (server_ip),
index (channel)
);

 CREATE TABLE park_log (
uniqueid DOUBLE(18,7) PRIMARY KEY NOT NULL,
status VARCHAR(10),
channel VARCHAR(100),
channel_group VARCHAR(30),
server_ip VARCHAR(15),
parked_time DATETIME,
grab_time DATETIME,
hangup_time DATETIME,
parked_sec INT(10),
talked_sec INT(10),
extension VARCHAR(100),
user VARCHAR(20),
index (parked_time)
);

 CREATE TABLE vicidial_manager (
man_id INT(9) UNSIGNED AUTO_INCREMENT PRIMARY KEY NOT NULL,
uniqueid DOUBLE(18,7),
entry_date DATETIME,
status  ENUM('NEW','QUEUE','SENT','UPDATED','DEAD'),
response  ENUM('Y','N'),
server_ip VARCHAR(15) NOT NULL,
channel VARCHAR(100),
action VARCHAR(20),
callerid VARCHAR(20),
cmd_line_b VARCHAR(100),
cmd_line_c VARCHAR(100),
cmd_line_d VARCHAR(100),
cmd_line_e VARCHAR(100),
cmd_line_f VARCHAR(100),
cmd_line_g VARCHAR(100),
cmd_line_h VARCHAR(100),
cmd_line_i VARCHAR(100),
cmd_line_j VARCHAR(100),
cmd_line_k VARCHAR(100),
index (callerid),
index (uniqueid),
index serverstat(server_ip,status)
);

 CREATE TABLE vicidial_list (
lead_id INT(9) UNSIGNED AUTO_INCREMENT PRIMARY KEY NOT NULL,
entry_date DATETIME,
modify_date TIMESTAMP,
status VARCHAR(6),			
user VARCHAR(20),			
vendor_lead_code VARCHAR(20),		
source_id VARCHAR(6),			
list_id BIGINT(14) UNSIGNED,		
gmt_offset_now DECIMAL(4,2) DEFAULT '0.00',		
called_since_last_reset ENUM('Y','N','Y1','Y2','Y3','Y4','Y5','Y6','Y7','Y8','Y9','Y10') default 'N',	
phone_code VARCHAR(10),			
phone_number VARCHAR(12),		
title VARCHAR(4),
first_name VARCHAR(30),
middle_initial VARCHAR(1),
last_name VARCHAR(30),
address1 VARCHAR(100),
address2 VARCHAR(100),
address3 VARCHAR(100),
city VARCHAR(50),
state VARCHAR(2),
province VARCHAR(50),
postal_code VARCHAR(10),
country_code VARCHAR(3),
gender ENUM('M','F'),
date_of_birth DATE,
alt_phone VARCHAR(12),
email VARCHAR(70),
security_phrase VARCHAR(100),
comments VARCHAR(255),
called_count INT(8) UNSIGNED NOT NULL default '0',
index (phone_number),
index (list_id),
index (called_since_last_reset),
index (status),
index (gmt_offset_now),
index (postal_code)
);

 CREATE TABLE vicidial_hopper (
hopper_id INT(9) UNSIGNED AUTO_INCREMENT PRIMARY KEY NOT NULL,
lead_id INT(9) UNSIGNED NOT NULL,
campaign_id VARCHAR(8),			
status ENUM('READY','QUEUE','INCALL','DONE','HOLD') default 'READY',
user VARCHAR(20),			
list_id BIGINT(14) UNSIGNED NOT NULL,
gmt_offset_now DECIMAL(4,2) DEFAULT '0.00',
state VARCHAR(2) default '',
alt_dial ENUM('NONE','ALT','ADDR3') default 'NONE',
index (lead_id)
);

 CREATE TABLE vicidial_live_agents (
live_agent_id INT(9) UNSIGNED AUTO_INCREMENT PRIMARY KEY NOT NULL,
user VARCHAR(20),
server_ip VARCHAR(15) NOT NULL,
conf_exten VARCHAR(20),
extension VARCHAR(100),
status ENUM('READY','QUEUE','INCALL','PAUSED','CLOSER') default 'PAUSED',
lead_id INT(9) UNSIGNED NOT NULL,
campaign_id VARCHAR(8),			
uniqueid DOUBLE(18,7),
callerid VARCHAR(20),
channel VARCHAR(100),
random_id INT(8) UNSIGNED,
last_call_time DATETIME,
last_update_time TIMESTAMP,
last_call_finish DATETIME,
closer_campaigns TEXT,
call_server_ip VARCHAR(15),
user_level INT(2) default '0',
comments VARCHAR(20),
index (random_id),
index (last_call_time),
index (last_update_time),
index (last_call_finish)
);

 CREATE TABLE vicidial_auto_calls (
auto_call_id INT(9) UNSIGNED AUTO_INCREMENT PRIMARY KEY NOT NULL,
server_ip VARCHAR(15) NOT NULL,
campaign_id VARCHAR(20),			
status ENUM('SENT','RINGING','LIVE','XFER','PAUSED','CLOSER','BUSY','DISCONNECT') default 'PAUSED',
lead_id INT(9) UNSIGNED NOT NULL,
uniqueid DOUBLE(18,7),
callerid VARCHAR(20),
channel VARCHAR(100),
phone_code VARCHAR(10),
phone_number VARCHAR(12),
call_time DATETIME,
call_type ENUM('IN','OUT','OUTBALANCE') default 'OUT',
stage VARCHAR(20) default 'START',
last_update_time TIMESTAMP,
alt_dial ENUM('NONE','MAIN','ALT','ADDR3') default 'NONE',
index (uniqueid),
index (callerid),
index (call_time),
index (last_update_time)
);

 CREATE TABLE vicidial_log (
uniqueid DOUBLE(18,7) PRIMARY KEY NOT NULL,
lead_id INT(9) UNSIGNED NOT NULL,
list_id BIGINT(14) UNSIGNED,
campaign_id VARCHAR(8),
call_date DATETIME,
start_epoch INT(10) UNSIGNED,
end_epoch INT(10) UNSIGNED,
length_in_sec INT(10),
status VARCHAR(6),
phone_code VARCHAR(10),
phone_number VARCHAR(12),
user VARCHAR(20),
comments VARCHAR(255),
processed ENUM('Y','N'),
user_group VARCHAR(20),
index (lead_id),
index (call_date)
);

 CREATE TABLE vicidial_closer_log (
closecallid INT(9) UNSIGNED AUTO_INCREMENT PRIMARY KEY NOT NULL,
lead_id INT(9) UNSIGNED NOT NULL,
list_id BIGINT(14) UNSIGNED,
campaign_id VARCHAR(20),
call_date DATETIME,
start_epoch INT(10) UNSIGNED,
end_epoch INT(10) UNSIGNED,
length_in_sec INT(10),
status VARCHAR(6),
phone_code VARCHAR(10),
phone_number VARCHAR(12),
user VARCHAR(20),
comments VARCHAR(255),
processed ENUM('Y','N'),
queue_seconds DECIMAL(7,2) default '0',
user_group VARCHAR(20),
index (lead_id),
index (call_date)
);

 CREATE TABLE vicidial_xfer_log (
xfercallid INT(9) UNSIGNED AUTO_INCREMENT PRIMARY KEY NOT NULL,
lead_id INT(9) UNSIGNED NOT NULL,
list_id BIGINT(14) UNSIGNED,
campaign_id VARCHAR(20),
call_date DATETIME,
phone_code VARCHAR(10),
phone_number VARCHAR(12),
user VARCHAR(20),
closer VARCHAR(20),
index (lead_id),
index (call_date)
);

 CREATE TABLE vicidial_users (
user_id INT(9) UNSIGNED AUTO_INCREMENT PRIMARY KEY NOT NULL,
user VARCHAR(20),
pass VARCHAR(20),
full_name VARCHAR(50),
user_level INT(2),
user_group VARCHAR(20),
phone_login VARCHAR(20),
phone_pass VARCHAR(20),
delete_users ENUM('0','1') default '0',
delete_user_groups ENUM('0','1') default '0',
delete_lists ENUM('0','1') default '0',
delete_campaigns ENUM('0','1') default '0',
delete_ingroups ENUM('0','1') default '0',
delete_remote_agents ENUM('0','1') default '0',
load_leads ENUM('0','1') default '0',
campaign_detail ENUM('0','1') default '0',
ast_admin_access ENUM('0','1') default '0',
ast_delete_phones ENUM('0','1') default '0',
delete_scripts ENUM('0','1') default '0',
modify_leads ENUM('0','1') default '0',
hotkeys_active ENUM('0','1') default '0',
change_agent_campaign ENUM('0','1') default '0',
agent_choose_ingroups ENUM('0','1') default '1',
closer_campaigns TEXT,
scheduled_callbacks ENUM('0','1') default '1',
agentonly_callbacks ENUM('0','1') default '0',
agentcall_manual ENUM('0','1') default '0',
vicidial_recording ENUM('0','1') default '1',
vicidial_transfers ENUM('0','1') default '1',
delete_filters ENUM('0','1') default '0',
alter_agent_interface_options ENUM('0','1') default '0',
closer_default_blended ENUM('0','1') default '0',
delete_call_times ENUM('0','1') default '0',
modify_call_times ENUM('0','1') default '0',
modify_users ENUM('0','1') default '0',
modify_campaigns ENUM('0','1') default '0',
modify_lists ENUM('0','1') default '0',
modify_scripts ENUM('0','1') default '0',
modify_filters ENUM('0','1') default '0',
modify_ingroups ENUM('0','1') default '0',
modify_usergroups ENUM('0','1') default '0',
modify_remoteagents ENUM('0','1') default '0',
modify_servers ENUM('0','1') default '0',
view_reports ENUM('0','1') default '0',
index (user)
);

 CREATE TABLE vicidial_user_log (
user_log_id INT(9) UNSIGNED AUTO_INCREMENT PRIMARY KEY NOT NULL,
user VARCHAR(20),
event VARCHAR(50),
campaign_id VARCHAR(8),
event_date DATETIME,
event_epoch INT(10) UNSIGNED,
user_group VARCHAR(20),
index (user)
);

 CREATE TABLE vicidial_user_groups (
user_group VARCHAR(20) NOT NULL,
group_name VARCHAR(40) NOT NULL,
allowed_campaigns TEXT
);

 CREATE TABLE vicidial_campaigns (
campaign_id VARCHAR(8) PRIMARY KEY NOT NULL,
campaign_name VARCHAR(40),
active ENUM('Y','N'),
dial_status_a VARCHAR(6),
dial_status_b VARCHAR(6),
dial_status_c VARCHAR(6),
dial_status_d VARCHAR(6),
dial_status_e VARCHAR(6),
lead_order VARCHAR(20),
park_ext VARCHAR(10),
park_file_name VARCHAR(10),
web_form_address VARCHAR(255),
allow_closers ENUM('Y','N'),
hopper_level INT(8) UNSIGNED default '1',
auto_dial_level VARCHAR(6) default '0',
next_agent_call ENUM('random','oldest_call_start','oldest_call_finish','overall_user_level') default 'oldest_call_finish',
local_call_time VARCHAR(10) DEFAULT '9am-9pm',
voicemail_ext VARCHAR(10),
dial_timeout TINYINT UNSIGNED default '60',
dial_prefix VARCHAR(20) default '9',
campaign_cid VARCHAR(10) default '0000000000',
campaign_vdad_exten VARCHAR(20) default '8365',
campaign_rec_exten VARCHAR(20) default '8309',
campaign_recording ENUM('NEVER','ONDEMAND','ALLCALLS','ALLFORCE') default 'ONDEMAND',
campaign_rec_filename VARCHAR(50) default 'FULLDATE_CUSTPHONE',
campaign_script VARCHAR(10),
get_call_launch ENUM('NONE','SCRIPT','WEBFORM') default 'NONE',
am_message_exten VARCHAR(20),
amd_send_to_vmx ENUM('Y','N') default 'N',
xferconf_a_dtmf VARCHAR(50),
xferconf_a_number VARCHAR(50),
xferconf_b_dtmf VARCHAR(50),
xferconf_b_number VARCHAR(50),
alt_number_dialing ENUM('Y','N') default 'N',
scheduled_callbacks ENUM('Y','N') default 'N',
lead_filter_id VARCHAR(10) default 'NONE',
drop_call_seconds TINYINT(3) unsigned default '5',
safe_harbor_message ENUM('Y','N') default 'N',
safe_harbor_exten VARCHAR(20)  default '8307',
display_dialable_count ENUM('Y','N') default 'Y',
wrapup_seconds SMALLINT(3) UNSIGNED default '0',
wrapup_message VARCHAR(255) default 'Wrapup Call',
closer_campaigns TEXT default '',
use_internal_dnc ENUM('Y','N') default 'N',
allcalls_delay SMALLINT(3) UNSIGNED default '0',
omit_phone_code ENUM('Y','N') default 'N',
dial_method ENUM('MANUAL','RATIO','ADAPT_HARD_LIMIT','ADAPT_TAPERED','ADAPT_AVERAGE') default 'MANUAL',
available_only_ratio_tally ENUM('Y','N') default 'N',
adaptive_dropped_percentage SMALLINT(3) default '3',
adaptive_maximum_level VARCHAR(6) default '3.0',
adaptive_latest_server_time VARCHAR(4) default '2100',
adaptive_intensity VARCHAR(6) default '0',
adaptive_dl_diff_target SMALLINT(3) default '0',
concurrent_transfers ENUM('AUTO','1','2','3','4','5','6','7','8','9','10') default 'AUTO',
auto_alt_dial ENUM('NONE','ALT_ONLY','ADDR3_ONLY','ALT_AND_ADDR3') default 'NONE',
auto_alt_dial_statuses VARCHAR(255) default ' B N NA DC -',
agent_pause_codes_active ENUM('Y','N') default 'N'
);

 CREATE TABLE vicidial_lists (
list_id BIGINT(14) UNSIGNED PRIMARY KEY NOT NULL,
list_name VARCHAR(30),
campaign_id VARCHAR(8),
active ENUM('Y','N')
);

 CREATE TABLE vicidial_statuses (
status VARCHAR(6) PRIMARY KEY NOT NULL,
status_name VARCHAR(30),
selectable ENUM('Y','N')
);

 CREATE TABLE vicidial_campaign_statuses (
status VARCHAR(6) NOT NULL,
status_name VARCHAR(30),
selectable ENUM('Y','N'),
campaign_id VARCHAR(8),
index (campaign_id)
);

 CREATE TABLE vicidial_campaign_hotkeys (
status VARCHAR(6) NOT NULL,
hotkey VARCHAR(1) NOT NULL,
status_name VARCHAR(30),
selectable ENUM('Y','N'),
campaign_id VARCHAR(8),
index (campaign_id)
);

 CREATE TABLE vicidial_conferences (
conf_exten INT(7) UNSIGNED NOT NULL,
server_ip VARCHAR(15) NOT NULL,
extension VARCHAR(100)
);

 CREATE TABLE vicidial_phone_codes (
country_code SMALLINT(5) UNSIGNED,
country CHAR(3),
areacode CHAR(3),
state VARCHAR(4),
GMT_offset VARCHAR(5),
DST enum('Y','N'),
DST_range VARCHAR(8),
geographic_description VARCHAR(30)
);

 CREATE TABLE vicidial_inbound_groups (
group_id VARCHAR(20) PRIMARY KEY NOT NULL,
group_name VARCHAR(30),
group_color VARCHAR(7),
active ENUM('Y','N'),
web_form_address VARCHAR(255),
voicemail_ext VARCHAR(10),
next_agent_call ENUM('random','oldest_call_start','oldest_call_finish','overall_user_level') default 'oldest_call_finish',
fronter_display ENUM('Y','N') default 'Y',
ingroup_script VARCHAR(10),
get_call_launch ENUM('NONE','SCRIPT','WEBFORM') default 'NONE',
xferconf_a_dtmf VARCHAR(50),
xferconf_a_number VARCHAR(50),
xferconf_b_dtmf VARCHAR(50),
xferconf_b_number VARCHAR(50),
drop_call_seconds SMALLINT(4) unsigned default '360',
drop_message ENUM('Y','N') default 'N',
drop_exten VARCHAR(20)  default '8307'
);

CREATE TABLE vicidial_stations (
agent_station VARCHAR(10) PRIMARY KEY NOT NULL,
phone_channel VARCHAR(100),
computer_ip VARCHAR(15) NOT NULL,
server_ip VARCHAR(15) NOT NULL,
DB_server_ip VARCHAR(15) NOT NULL,
DB_user VARCHAR(15),
DB_pass VARCHAR(15),
DB_port VARCHAR(6)
);

 CREATE TABLE vicidial_remote_agents (
remote_agent_id INT(9) UNSIGNED AUTO_INCREMENT PRIMARY KEY NOT NULL,
user_start VARCHAR(20),
number_of_lines TINYINT UNSIGNED default '1',
server_ip VARCHAR(15) NOT NULL,
conf_exten VARCHAR(20),
status ENUM('ACTIVE','INACTIVE') default 'INACTIVE',
campaign_id VARCHAR(8),
closer_campaigns TEXT
);

 CREATE TABLE live_inbound_log (
uniqueid DOUBLE(18,7) NOT NULL,
channel VARCHAR(100) NOT NULL,
server_ip VARCHAR(15) NOT NULL,
caller_id VARCHAR(30),
extension VARCHAR(100),
phone_ext VARCHAR(40),
start_time DATETIME,
acknowledged ENUM('Y','N') default 'N',
inbound_number VARCHAR(20),
comment_a VARCHAR(50),
comment_b VARCHAR(50),
comment_c VARCHAR(50),
comment_d VARCHAR(50),
comment_e VARCHAR(50),
index (uniqueid),
index (phone_ext),
index (start_time)
);

 CREATE TABLE web_client_sessions (
extension VARCHAR(100) NOT NULL,
server_ip VARCHAR(15) NOT NULL,
program ENUM('agc','vicidial','monitor','other') default 'agc',
start_time DATETIME NOT NULL,
session_name VARCHAR(40) UNIQUE NOT NULL
);

 CREATE TABLE server_performance (
start_time DATETIME NOT NULL,
server_ip VARCHAR(15) NOT NULL,
sysload INT(6) NOT NULL,
freeram SMALLINT(5) UNSIGNED NOT NULL,
usedram SMALLINT(5) UNSIGNED NOT NULL,
processes SMALLINT(4) UNSIGNED NOT NULL,
channels_total SMALLINT(4) UNSIGNED NOT NULL,
trunks_total SMALLINT(4) UNSIGNED NOT NULL,
clients_total SMALLINT(4) UNSIGNED NOT NULL,
clients_zap SMALLINT(4) UNSIGNED NOT NULL,
clients_iax SMALLINT(4) UNSIGNED NOT NULL,
clients_local SMALLINT(4) UNSIGNED NOT NULL,
clients_sip SMALLINT(4) UNSIGNED NOT NULL,
live_recordings SMALLINT(4) UNSIGNED NOT NULL,
cpu_user_percent SMALLINT(3) UNSIGNED NOT NULL default '0',
cpu_system_percent SMALLINT(3) UNSIGNED NOT NULL default '0',
cpu_idle_percent SMALLINT(3) UNSIGNED NOT NULL default '0'
);

 CREATE TABLE vicidial_agent_log (
agent_log_id INT(9) UNSIGNED AUTO_INCREMENT PRIMARY KEY NOT NULL,
user VARCHAR(20),
server_ip VARCHAR(15) NOT NULL,
event_time DATETIME,
lead_id INT(9) UNSIGNED,
campaign_id VARCHAR(8),	
pause_epoch INT(10) UNSIGNED,
pause_sec SMALLINT(5) UNSIGNED default '0',
wait_epoch INT(10) UNSIGNED,
wait_sec SMALLINT(5) UNSIGNED default '0',
talk_epoch INT(10) UNSIGNED,
talk_sec SMALLINT(5) UNSIGNED default '0',
dispo_epoch INT(10) UNSIGNED,
dispo_sec SMALLINT(5) UNSIGNED default '0',
status VARCHAR(6),
user_group VARCHAR(20),
comments VARCHAR(20),
sub_status VARCHAR(6)
);

 CREATE TABLE vicidial_scripts (
script_id VARCHAR(10) PRIMARY KEY NOT NULL,
script_name VARCHAR(50),
script_comments VARCHAR(255),
script_text TEXT,
active ENUM('Y','N')
);

 CREATE TABLE phone_favorites (
extension VARCHAR(100),
server_ip VARCHAR(15),
extensions_list TEXT
);

 CREATE TABLE vicidial_callbacks (
callback_id INT(9) UNSIGNED AUTO_INCREMENT PRIMARY KEY NOT NULL,
lead_id INT(9) UNSIGNED,
list_id BIGINT(14) UNSIGNED,		
campaign_id VARCHAR(8),			
status VARCHAR(10),
entry_time DATETIME,
callback_time DATETIME,
modify_date TIMESTAMP,
user VARCHAR(20),
recipient ENUM('USERONLY','ANYONE'),	
comments VARCHAR(255),
user_group VARCHAR(20),
index (lead_id),
index (status),
index (callback_time)
);

 CREATE TABLE vicidial_list_pins (
pins_id INT(9) UNSIGNED AUTO_INCREMENT PRIMARY KEY NOT NULL,
entry_time DATETIME,
phone_number VARCHAR(12),
lead_id INT(9) UNSIGNED,
campaign_id VARCHAR(20),			
product_code VARCHAR(20),
user VARCHAR(20),
digits VARCHAR(20),
index (lead_id),
index (phone_number),
index (entry_time)
);

 CREATE TABLE vicidial_lead_filters (
lead_filter_id VARCHAR(10) PRIMARY KEY NOT NULL,
lead_filter_name VARCHAR(30) NOT NULL,
lead_filter_comments VARCHAR(255),
lead_filter_sql TEXT
);

 CREATE TABLE vicidial_call_times (
call_time_id VARCHAR(10) PRIMARY KEY NOT NULL,
call_time_name VARCHAR(30) NOT NULL,
call_time_comments VARCHAR(255) default '',
ct_default_start SMALLINT(4) unsigned NOT NULL default '900',
ct_default_stop SMALLINT(4) unsigned NOT NULL default '2100',
ct_sunday_start SMALLINT(4) unsigned default '0',
ct_sunday_stop SMALLINT(4) unsigned default '0',
ct_monday_start SMALLINT(4) unsigned default '0',
ct_monday_stop SMALLINT(4) unsigned default '0',
ct_tuesday_start SMALLINT(4) unsigned default '0',
ct_tuesday_stop SMALLINT(4) unsigned default '0',
ct_wednesday_start SMALLINT(4) unsigned default '0',
ct_wednesday_stop SMALLINT(4) unsigned default '0',
ct_thursday_start SMALLINT(4) unsigned default '0',
ct_thursday_stop SMALLINT(4) unsigned default '0',
ct_friday_start SMALLINT(4) unsigned default '0',
ct_friday_stop SMALLINT(4) unsigned default '0',
ct_saturday_start SMALLINT(4) unsigned default '0',
ct_saturday_stop SMALLINT(4) unsigned default '0',
ct_state_call_times TEXT default ''
);

 CREATE TABLE vicidial_state_call_times (
state_call_time_id VARCHAR(10) PRIMARY KEY NOT NULL,
state_call_time_state VARCHAR(2) NOT NULL,
state_call_time_name VARCHAR(30) NOT NULL,
state_call_time_comments VARCHAR(255) default '',
sct_default_start SMALLINT(4) unsigned NOT NULL default '900',
sct_default_stop SMALLINT(4) unsigned NOT NULL default '2100',
sct_sunday_start SMALLINT(4) unsigned default '0',
sct_sunday_stop SMALLINT(4) unsigned default '0',
sct_monday_start SMALLINT(4) unsigned default '0',
sct_monday_stop SMALLINT(4) unsigned default '0',
sct_tuesday_start SMALLINT(4) unsigned default '0',
sct_tuesday_stop SMALLINT(4) unsigned default '0',
sct_wednesday_start SMALLINT(4) unsigned default '0',
sct_wednesday_stop SMALLINT(4) unsigned default '0',
sct_thursday_start SMALLINT(4) unsigned default '0',
sct_thursday_stop SMALLINT(4) unsigned default '0',
sct_friday_start SMALLINT(4) unsigned default '0',
sct_friday_stop SMALLINT(4) unsigned default '0',
sct_saturday_start SMALLINT(4) unsigned default '0',
sct_saturday_stop SMALLINT(4) unsigned default '0'
);

 CREATE TABLE vicidial_campaign_stats (
campaign_id VARCHAR(20) PRIMARY KEY NOT NULL,
update_time TIMESTAMP,
dialable_leads INT(9) UNSIGNED default '0',
calls_today INT(9) UNSIGNED default '0',
answers_today INT(9) UNSIGNED default '0',
drops_today INT(9) UNSIGNED default '0',
drops_today_pct VARCHAR(6) default '0',
drops_answers_today_pct VARCHAR(6) default '0',
calls_hour INT(9) UNSIGNED default '0',
answers_hour INT(9) UNSIGNED default '0',
drops_hour INT(9) UNSIGNED default '0',
drops_hour_pct VARCHAR(6) default '0',
calls_halfhour INT(9) UNSIGNED default '0',
answers_halfhour INT(9) UNSIGNED default '0',
drops_halfhour INT(9) UNSIGNED default '0',
drops_halfhour_pct VARCHAR(6) default '0',
calls_fivemin INT(9) UNSIGNED default '0',
answers_fivemin INT(9) UNSIGNED default '0',
drops_fivemin INT(9) UNSIGNED default '0',
drops_fivemin_pct VARCHAR(6) default '0',
calls_onemin INT(9) UNSIGNED default '0',
answers_onemin INT(9) UNSIGNED default '0',
drops_onemin INT(9) UNSIGNED default '0',
drops_onemin_pct VARCHAR(6) default '0',
differential_onemin VARCHAR(20) default '0',
agents_average_onemin VARCHAR(20) default '0',
balance_trunk_fill SMALLINT(5) UNSIGNED default '0'
);

 CREATE TABLE vicidial_dnc (
phone_number VARCHAR(12) PRIMARY KEY NOT NULL
);

 CREATE TABLE vicidial_lead_recycle (
recycle_id INT(9) UNSIGNED AUTO_INCREMENT PRIMARY KEY NOT NULL,
campaign_id VARCHAR(8),
status VARCHAR(6) NOT NULL,
attempt_delay SMALLINT(5) UNSIGNED default '1800',
attempt_maximum TINYINT(3) UNSIGNED default '32',
active ENUM('Y','N') default 'N',
index (campaign_id)
);

 CREATE TABLE vicidial_campaign_server_stats (
campaign_id VARCHAR(20) NOT NULL,
server_ip VARCHAR(15) NOT NULL,
update_time TIMESTAMP,
local_trunk_shortage SMALLINT(5) UNSIGNED default '0',
index (campaign_id),
index (server_ip)
);

 CREATE TABLE vicidial_server_trunks (
server_ip VARCHAR(15) NOT NULL,
campaign_id VARCHAR(20) NOT NULL,
dedicated_trunks SMALLINT(5) UNSIGNED default '0',
trunk_restriction ENUM('MAXIMUM_LIMIT','OVERFLOW_ALLOWED') default 'OVERFLOW_ALLOWED',
index (campaign_id),
index (server_ip)
);

 CREATE TABLE vicidial_postal_codes (
postal_code VARCHAR(10) NOT NULL,
state VARCHAR(4),
GMT_offset VARCHAR(5),
DST enum('Y','N'),
DST_range VARCHAR(8),
country CHAR(3),
country_code SMALLINT(5) UNSIGNED
);

 CREATE TABLE vicidial_pause_codes (
pause_code VARCHAR(6) NOT NULL,
pause_code_name VARCHAR(30),
billable ENUM('NO','YES','HALF') default 'NO',
campaign_id VARCHAR(8),
index (campaign_id)
);


INSERT INTO vicidial_user_groups SET user_group='ADMIN',group_name='VICIDIAL ADMINISTRATORS',allowed_campaigns=' -ALL-CAMPAIGNS- - -';

INSERT INTO vicidial_call_times SET call_time_id='24hours',call_time_name='default 24 hours calling',ct_default_start='0',ct_default_stop='2400';
INSERT INTO vicidial_call_times SET call_time_id='9am-9pm',call_time_name='default 9am to 9pm calling',ct_default_start='900',ct_default_stop='2100';
INSERT INTO vicidial_call_times SET call_time_id='9am-5pm',call_time_name='default 9am to 5pm calling',ct_default_start='900',ct_default_stop='1700';
INSERT INTO vicidial_call_times SET call_time_id='12pm-5pm',call_time_name='default 12pm to 5pm calling',ct_default_start='1200',ct_default_stop='1700';
INSERT INTO vicidial_call_times SET call_time_id='12pm-9pm',call_time_name='default 12pm to 9pm calling',ct_default_start='1200',ct_default_stop='1200';
INSERT INTO vicidial_call_times SET call_time_id='5pm-9pm',call_time_name='default 5pm to 9pm calling',ct_default_start='1700',ct_default_stop='2100';

INSERT INTO vicidial_state_call_times SET state_call_time_id='alabama',state_call_time_state='AL',state_call_time_name='Alabama 8am-8pm and Sunday',sct_default_start='800',sct_default_stop='2000',sct_sunday_start='2400',sct_sunday_stop='2400';
INSERT INTO vicidial_state_call_times SET state_call_time_id='illinois',state_call_time_state='IL',state_call_time_name='Illinois 8am',sct_default_start='800',sct_default_stop='2100';
INSERT INTO vicidial_state_call_times SET state_call_time_id='indiana',state_call_time_state='IN',state_call_time_name='Indiana 8pm restriction',sct_default_start='900',sct_default_stop='2000';
INSERT INTO vicidial_state_call_times SET state_call_time_id='kentucky',state_call_time_state='KY',state_call_time_name='Kentucky 10am restriction',sct_default_start='1000',sct_default_stop='2100';
INSERT INTO vicidial_state_call_times SET state_call_time_id='louisiana',state_call_time_state='LA',state_call_time_name='Louisiana 8am-8pm and Sunday',sct_default_start='800',sct_default_stop='2000',sct_sunday_start='2400',sct_sunday_stop='2400';
INSERT INTO vicidial_state_call_times SET state_call_time_id='massachuse',state_call_time_state='MA',state_call_time_name='Massachusetts 8am-8pm',sct_default_start='800',sct_default_stop='2000';
INSERT INTO vicidial_state_call_times SET state_call_time_id='mississipp',state_call_time_state='MS',state_call_time_name='Mississippi 8am-8pm and Sunday',sct_default_start='800',sct_default_stop='2000',sct_sunday_start='2400',sct_sunday_stop='2400';
INSERT INTO vicidial_state_call_times SET state_call_time_id='nebraska',state_call_time_state='NE',state_call_time_name='Nebraska 8am',sct_default_start='800',sct_default_stop='2100';
INSERT INTO vicidial_state_call_times SET state_call_time_id='nevada',state_call_time_state='NV',state_call_time_name='Nevada 8pm restriction',sct_default_start='900',sct_default_stop='2000';
INSERT INTO vicidial_state_call_times SET state_call_time_id='pennsylvan',state_call_time_state='PA',state_call_time_name='Pennsylvania sunday restriction',sct_sunday_start='1330',sct_sunday_stop='2100';
INSERT INTO vicidial_state_call_times SET state_call_time_id='rhodeislan',state_call_time_state='RI',state_call_time_name='Rhode Island restrictions',sct_default_start='900',sct_default_stop='1800',sct_sunday_start='2400',sct_sunday_stop='2400',sct_saturday_start='1000',sct_saturday_stop='1700';
INSERT INTO vicidial_state_call_times SET state_call_time_id='sdakota',state_call_time_state='SD',state_call_time_name='South Dakota sunday restrict',sct_sunday_start='2400',sct_sunday_stop='2400';
INSERT INTO vicidial_state_call_times SET state_call_time_id='tennessee',state_call_time_state='TN',state_call_time_name='Tennessee 8am',sct_default_start='800',sct_default_stop='2100';
INSERT INTO vicidial_state_call_times SET state_call_time_id='texas',state_call_time_state='TX',state_call_time_name='Texas sunday restriction',sct_sunday_start='1200',sct_sunday_stop='2100';
INSERT INTO vicidial_state_call_times SET state_call_time_id='utah',state_call_time_state='UT',state_call_time_name='Utah 8pm restriction',sct_default_start='900',sct_default_stop='2000';
INSERT INTO vicidial_state_call_times SET state_call_time_id='washington',state_call_time_state='WA',state_call_time_name='Washington 8am',sct_default_start='800',sct_default_stop='2100';
INSERT INTO vicidial_state_call_times SET state_call_time_id='wyoming',state_call_time_state='WY',state_call_time_name='Wyoming 8am-8pm',sct_default_start='800',sct_default_stop='2000';

