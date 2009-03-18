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
enable_sipsak_messages ENUM('0','1') default '0',
email VARCHAR(100),
template_id VARCHAR(15) NOT NULL,
conf_override TEXT,
index (server_ip)
);

CREATE TABLE servers (
server_id VARCHAR(10) NOT NULL,
server_description VARCHAR(255),
server_ip VARCHAR(15) NOT NULL,
active ENUM('Y','N'),
asterisk_version VARCHAR(20) default '1.2.9',
max_vicidial_trunks SMALLINT(4) default '23',
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
balance_trunks_offlimits SMALLINT(5) UNSIGNED default '0',
recording_web_link ENUM('SERVER_IP','ALT_IP') default 'SERVER_IP',
alt_server_ip VARCHAR(100) default '',
active_asterisk_server ENUM('Y','N') default 'Y',
generate_vicidial_conf ENUM('Y','N') default 'Y',
rebuild_conf_files ENUM('Y','N') default 'Y',
outbound_calls_per_second SMALLINT(3) UNSIGNED default '20',
sysload INT(6) NOT NULL default '0',
channels_total SMALLINT(4) UNSIGNED NOT NULL default '0',
cpu_idle_percent SMALLINT(3) UNSIGNED NOT NULL default '0',
disk_usage VARCHAR(255) default '1'
);

CREATE UNIQUE INDEX server_id on servers (server_id);

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
start_epoch INT(10) UNSIGNED,
end_time DATETIME,
end_epoch INT(10) UNSIGNED,
length_in_sec MEDIUMINT(8) UNSIGNED,
length_in_min DOUBLE(8,2),
filename VARCHAR(50),
location VARCHAR(255),
lead_id INT(9) UNSIGNED,
user VARCHAR(20),
vicidial_id VARCHAR(20),
index(filename),
index(lead_id),
index(user),
index(vicidial_id)
);

CREATE TABLE live_inbound (
uniqueid VARCHAR(20) NOT NULL,
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
last_update DATETIME,
db_time TIMESTAMP
);

CREATE TABLE call_log (
uniqueid VARCHAR(20) PRIMARY KEY NOT NULL,
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
uniqueid VARCHAR(20) PRIMARY KEY NOT NULL,
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
uniqueid VARCHAR(20),
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
source_id VARCHAR(50),
list_id BIGINT(14) UNSIGNED,
gmt_offset_now DECIMAL(4,2) DEFAULT '0.00',
called_since_last_reset ENUM('Y','N','Y1','Y2','Y3','Y4','Y5','Y6','Y7','Y8','Y9','Y10') default 'N',
phone_code VARCHAR(10),	
phone_number VARCHAR(18) NOT NULL,
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
gender ENUM('M','F','U') default 'U',
date_of_birth DATE,
alt_phone VARCHAR(12),
email VARCHAR(70),
security_phrase VARCHAR(100),
comments VARCHAR(255),
called_count SMALLINT(5) UNSIGNED default '0',
last_local_call_time DATETIME,
index (phone_number),
index (list_id),
index (called_since_last_reset),
index (status),
index (gmt_offset_now),
index (postal_code),
index (last_local_call_time)
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
alt_dial VARCHAR(6) default 'NONE',
priority TINYINT(2) default '0',
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
uniqueid VARCHAR(20),
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
campaign_weight TINYINT(1) default '0',
calls_today SMALLINT(5) UNSIGNED default '0',
external_hangup VARCHAR(1) default '',
external_status VARCHAR(6) default '',
external_pause VARCHAR(20) default '',
external_dial VARCHAR(100) default '',
index (random_id),
index (last_call_time),
index (last_update_time),
index (last_call_finish)
);

CREATE TABLE vicidial_auto_calls (
auto_call_id INT(9) UNSIGNED AUTO_INCREMENT PRIMARY KEY NOT NULL,
server_ip VARCHAR(15) NOT NULL,
campaign_id VARCHAR(20),			
status ENUM('SENT','RINGING','LIVE','XFER','PAUSED','CLOSER','BUSY','DISCONNECT','IVR') default 'PAUSED',
lead_id INT(9) UNSIGNED NOT NULL,
uniqueid VARCHAR(20),
callerid VARCHAR(20),
channel VARCHAR(100),
phone_code VARCHAR(10),
phone_number VARCHAR(18),
call_time DATETIME,
call_type ENUM('IN','OUT','OUTBALANCE') default 'OUT',
stage VARCHAR(20) default 'START',
last_update_time TIMESTAMP,
alt_dial VARCHAR(6) default 'NONE',
queue_priority TINYINT(2) default '0',
agent_only VARCHAR(20) default '',
index (uniqueid),
index (callerid),
index (call_time),
index (last_update_time)
);

CREATE TABLE vicidial_log (
uniqueid VARCHAR(20) PRIMARY KEY NOT NULL,
lead_id INT(9) UNSIGNED NOT NULL,
list_id BIGINT(14) UNSIGNED,
campaign_id VARCHAR(8),
call_date DATETIME,
start_epoch INT(10) UNSIGNED,
end_epoch INT(10) UNSIGNED,
length_in_sec INT(10),
status VARCHAR(6),
phone_code VARCHAR(10),
phone_number VARCHAR(18),
user VARCHAR(20),
comments VARCHAR(255),
processed ENUM('Y','N'),
user_group VARCHAR(20),
term_reason  ENUM('CALLER','AGENT','QUEUETIMEOUT','ABANDON','AFTERHOURS','NONE') default 'NONE',
alt_dial VARCHAR(6) default 'NONE',
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
phone_number VARCHAR(18),
user VARCHAR(20),
comments VARCHAR(255),
processed ENUM('Y','N'),
queue_seconds DECIMAL(7,2) default '0',
user_group VARCHAR(20),
xfercallid INT(9) UNSIGNED,
term_reason  ENUM('CALLER','AGENT','QUEUETIMEOUT','ABANDON','AFTERHOURS','NONE') default 'NONE',
uniqueid VARCHAR(20) NOT NULL default '',
agent_only VARCHAR(20) default '',
index (lead_id),
index (call_date),
index (campaign_id),
index (uniqueid)
);

CREATE TABLE vicidial_xfer_log (
xfercallid INT(9) UNSIGNED AUTO_INCREMENT PRIMARY KEY NOT NULL,
lead_id INT(9) UNSIGNED NOT NULL,
list_id BIGINT(14) UNSIGNED,
campaign_id VARCHAR(20),
call_date DATETIME,
phone_code VARCHAR(10),
phone_number VARCHAR(18),
user VARCHAR(20),
closer VARCHAR(20),
index (lead_id),
index (call_date)
);

CREATE TABLE vicidial_users (
user_id INT(9) UNSIGNED AUTO_INCREMENT PRIMARY KEY NOT NULL,
user VARCHAR(20) NOT NULL,
pass VARCHAR(20) NOT NULL,
full_name VARCHAR(50),
user_level TINYINT(2) default '1',
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
vicidial_recording_override ENUM('DISABLED','NEVER','ONDEMAND','ALLCALLS','ALLFORCE') default 'DISABLED',
alter_custdata_override ENUM('NOT_ACTIVE','ALLOW_ALTER') default 'NOT_ACTIVE',
qc_enabled ENUM('1','0') default '0',
qc_user_level INT(2) default '1',
qc_pass ENUM('1','0') default '0',
qc_finish ENUM('1','0') default '0',
qc_commit ENUM('1','0') default '0',
add_timeclock_log ENUM('1','0') default '0',
modify_timeclock_log ENUM('1','0') default '0',
delete_timeclock_log ENUM('1','0') default '0',
alter_custphone_override ENUM('NOT_ACTIVE','ALLOW_ALTER') default 'NOT_ACTIVE',
vdc_agent_api_access ENUM('0','1') default '0',
modify_inbound_dids ENUM('1','0') default '0',
delete_inbound_dids ENUM('1','0') default '0',
active ENUM('Y','N') default 'Y',
alert_enabled ENUM('1','0') default '0',
download_lists ENUM('1','0') default '0',
agent_shift_enforcement_override ENUM('DISABLED','OFF','START','ALL') default 'DISABLED',
manager_shift_enforcement_override ENUM('0','1') default '0',
shift_override_flag ENUM('0','1') default '0',
export_reports ENUM('1','0') default '0'
);


CREATE UNIQUE INDEX user ON vicidial_users (user);

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
allowed_campaigns TEXT,
qc_allowed_campaigns TEXT,
qc_allowed_inbound_groups TEXT,
group_shifts TEXT,
forced_timeclock_login ENUM('Y','N','ADMIN_EXEMPT') default 'N',
shift_enforcement ENUM('OFF','START','ALL') default 'OFF'
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
lead_order VARCHAR(30),
park_ext VARCHAR(10),
park_file_name VARCHAR(10),
web_form_address VARCHAR(255),
allow_closers ENUM('Y','N'),
hopper_level INT(8) UNSIGNED default '1',
auto_dial_level VARCHAR(6) default '0',
next_agent_call ENUM('random','oldest_call_start','oldest_call_finish','campaign_rank','overall_user_level','fewest_calls') default 'oldest_call_finish',
local_call_time VARCHAR(10) DEFAULT '9am-9pm',
voicemail_ext VARCHAR(10),
dial_timeout TINYINT UNSIGNED default '60',
dial_prefix VARCHAR(20) default '9',
campaign_cid VARCHAR(20) default '0000000000',
campaign_vdad_exten VARCHAR(20) default '8368',
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
drop_action ENUM('HANGUP','MESSAGE','VOICEMAIL','IN_GROUP') default 'MESSAGE',
safe_harbor_exten VARCHAR(20)  default '8307',
display_dialable_count ENUM('Y','N') default 'Y',
wrapup_seconds SMALLINT(3) UNSIGNED default '0',
wrapup_message VARCHAR(255) default 'Wrapup Call',
closer_campaigns TEXT default '',
use_internal_dnc ENUM('Y','N') default 'N',
allcalls_delay SMALLINT(3) UNSIGNED default '0',
omit_phone_code ENUM('Y','N') default 'N',
dial_method ENUM('MANUAL','RATIO','ADAPT_HARD_LIMIT','ADAPT_TAPERED','ADAPT_AVERAGE','INBOUND_MAN') default 'MANUAL',
available_only_ratio_tally ENUM('Y','N') default 'N',
adaptive_dropped_percentage SMALLINT(3) default '3',
adaptive_maximum_level VARCHAR(6) default '3.0',
adaptive_latest_server_time VARCHAR(4) default '2100',
adaptive_intensity VARCHAR(6) default '0',
adaptive_dl_diff_target SMALLINT(3) default '0',
concurrent_transfers ENUM('AUTO','1','2','3','4','5','6','7','8','9','10') default 'AUTO',
auto_alt_dial ENUM('NONE','ALT_ONLY','ADDR3_ONLY','ALT_AND_ADDR3','ALT_AND_EXTENDED','ALT_AND_ADDR3_AND_EXTENDED','EXTENDED_ONLY') default 'NONE',
auto_alt_dial_statuses VARCHAR(255) default ' B N NA DC -',
agent_pause_codes_active ENUM('Y','N','FORCE') default 'N',
campaign_description VARCHAR(255),
campaign_changedate DATETIME,
campaign_stats_refresh ENUM('Y','N') default 'N',
campaign_logindate DATETIME,
dial_statuses VARCHAR(255) default ' NEW -',
disable_alter_custdata ENUM('Y','N') default 'N',
no_hopper_leads_logins ENUM('Y','N') default 'N',
list_order_mix VARCHAR(20) default 'DISABLED',
campaign_allow_inbound ENUM('Y','N') default 'N',
manual_dial_list_id BIGINT(14) UNSIGNED default '998',
default_xfer_group VARCHAR(20) default '---NONE---',
xfer_groups  TEXT default '',
queue_priority TINYINT(2) default '50',
drop_inbound_group VARCHAR(20) default '---NONE---',
qc_enabled ENUM('Y','N') default 'N',
qc_statuses TEXT,
qc_lists TEXT,
qc_shift_id VARCHAR(20) default '24HRMIDNIGHT',
qc_get_record_launch ENUM('NONE','SCRIPT','WEBFORM','QCSCRIPT','QCWEBFORM') default 'NONE',
qc_show_recording ENUM('Y','N') default 'Y',
qc_web_form_address VARCHAR(255),
qc_script VARCHAR(10),
survey_first_audio_file VARCHAR(50) default 'US_pol_survey_hello',
survey_dtmf_digits VARCHAR(16) default '1238',
survey_ni_digit VARCHAR(1) default '8',
survey_opt_in_audio_file VARCHAR(50) default 'US_pol_survey_transfer',
survey_ni_audio_file VARCHAR(50) default 'US_thanks_no_contact',
survey_method ENUM('AGENT_XFER','VOICEMAIL','EXTENSION','HANGUP','CAMPREC_60_WAV') default 'AGENT_XFER',
survey_no_response_action ENUM('OPTIN','OPTOUT') default 'OPTIN',
survey_ni_status VARCHAR(6) default 'NI',
survey_response_digit_map VARCHAR(255) default '1-DEMOCRAT|2-REPUBLICAN|3-INDEPENDANT|8-OPTOUT|X-NO RESPONSE|',
survey_xfer_exten VARCHAR(20) default '8300',
survey_camp_record_dir VARCHAR(255) default '/home/survey',
disable_alter_custphone ENUM('Y','N') default 'Y',
display_queue_count ENUM('Y','N') default 'Y',
manual_dial_filter VARCHAR(50) default 'NONE',
agent_clipboard_copy VARCHAR(50) default 'NONE',
agent_extended_alt_dial ENUM('Y','N') default 'N',
use_campaign_dnc ENUM('Y','N') default 'N',
three_way_call_cid ENUM('CAMPAIGN','CUSTOMER','AGENT_PHONE','AGENT_CHOOSE') default 'CAMPAIGN',
three_way_dial_prefix VARCHAR(20) default '',
web_form_target VARCHAR(100) NOT NULL default 'vdcwebform',
vtiger_search_category VARCHAR(100) default 'LEAD',
vtiger_create_call_record ENUM('Y','N') default 'Y',
vtiger_create_lead_record ENUM('Y','N') default 'Y',
vtiger_screen_login ENUM('Y','N') default 'Y',
cpd_amd_action ENUM('DISABLED','DISPO','MESSAGE') default 'DISABLED',
agent_allow_group_alias ENUM('Y','N') default 'N',
default_group_alias VARCHAR(30) default ''
);

CREATE TABLE vicidial_lists (
list_id BIGINT(14) UNSIGNED PRIMARY KEY NOT NULL,
list_name VARCHAR(30),
campaign_id VARCHAR(8),
active ENUM('Y','N'),
list_description VARCHAR(255),
list_changedate DATETIME,
list_lastcalldate DATETIME
);

CREATE TABLE vicidial_statuses (
status VARCHAR(6) PRIMARY KEY NOT NULL,
status_name VARCHAR(30),
selectable ENUM('Y','N'),
human_answered ENUM('Y','N') default 'N',
category VARCHAR(20) default 'UNDEFINED'
);

CREATE TABLE vicidial_campaign_statuses (
status VARCHAR(6) NOT NULL,
status_name VARCHAR(30),
selectable ENUM('Y','N'),
campaign_id VARCHAR(8),
human_answered ENUM('Y','N') default 'N',
category VARCHAR(20) default 'UNDEFINED',
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
extension VARCHAR(100),
leave_3way ENUM('0','1') default '0',
leave_3way_datetime DATETIME
);

CREATE UNIQUE INDEX serverconf on vicidial_conferences (server_ip, conf_exten);

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
next_agent_call ENUM('random','oldest_call_start','oldest_call_finish','overall_user_level','inbound_group_rank','campaign_rank','fewest_calls','fewest_calls_campaign') default 'oldest_call_finish',
fronter_display ENUM('Y','N') default 'Y',
ingroup_script VARCHAR(10),
get_call_launch ENUM('NONE','SCRIPT','WEBFORM') default 'NONE',
xferconf_a_dtmf VARCHAR(50),
xferconf_a_number VARCHAR(50),
xferconf_b_dtmf VARCHAR(50),
xferconf_b_number VARCHAR(50),
drop_call_seconds SMALLINT(4) unsigned default '360',
drop_action ENUM('HANGUP','MESSAGE','VOICEMAIL','IN_GROUP') default 'MESSAGE',
drop_exten VARCHAR(20)  default '8307',
call_time_id VARCHAR(20) default '24hours',
after_hours_action ENUM('HANGUP','MESSAGE','EXTENSION','VOICEMAIL','IN_GROUP') default 'MESSAGE',
after_hours_message_filename VARCHAR(50) default 'vm-goodbye',
after_hours_exten VARCHAR(20) default '8300',
after_hours_voicemail VARCHAR(20),
welcome_message_filename VARCHAR(50) default '---NONE---',
moh_context VARCHAR(50) default 'default',
onhold_prompt_filename VARCHAR(50) default 'generic_hold',
prompt_interval SMALLINT(5) UNSIGNED default '60',
agent_alert_exten VARCHAR(20) default '8304',
agent_alert_delay INT(6) default '1000',
default_xfer_group VARCHAR(20) default '---NONE---',
queue_priority TINYINT(2) default '0',
drop_inbound_group VARCHAR(20) default '---NONE---',
ingroup_recording_override  ENUM('DISABLED','NEVER','ONDEMAND','ALLCALLS','ALLFORCE') default 'DISABLED',
ingroup_rec_filename VARCHAR(50) default 'NONE',
afterhours_xfer_group VARCHAR(20) default '---NONE---',
qc_enabled ENUM('Y','N') default 'N',
qc_statuses TEXT,
qc_shift_id VARCHAR(20) default '24HRMIDNIGHT',
qc_get_record_launch ENUM('NONE','SCRIPT','WEBFORM','QCSCRIPT','QCWEBFORM') default 'NONE',
qc_show_recording ENUM('Y','N') default 'Y',
qc_web_form_address VARCHAR(255),
qc_script VARCHAR(10),
play_place_in_line ENUM('Y','N') default 'N',
play_estimate_hold_time ENUM('Y','N') default 'N',
hold_time_option ENUM('NONE','EXTENSION','VOICEMAIL','IN_GROUP','CALLERID_CALLBACK','DROP_ACTION','PRESS_VMAIL') default 'NONE',
hold_time_option_seconds SMALLINT(5) default '360',
hold_time_option_exten VARCHAR(20) default '8300',
hold_time_option_voicemail VARCHAR(20) default '',
hold_time_option_xfer_group VARCHAR(20) default '---NONE---',
hold_time_option_callback_filename VARCHAR(50) default 'vm-hangup',
hold_time_option_callback_list_id BIGINT(14) UNSIGNED default '999',
hold_recall_xfer_group VARCHAR(20) default '---NONE---',
no_delay_call_route ENUM('Y','N') default 'N',
play_welcome_message ENUM('ALWAYS','NEVER','IF_WAIT_ONLY','YES_UNLESS_NODELAY') default 'ALWAYS',
answer_sec_pct_rt_stat_one SMALLINT(5) UNSIGNED default '20',
answer_sec_pct_rt_stat_two SMALLINT(5) UNSIGNED default '30',
default_group_alias VARCHAR(30) default ''
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
uniqueid VARCHAR(20) NOT NULL,
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
sub_status VARCHAR(6),
index (lead_id),
index (user),
index (event_time)
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
phone_number VARCHAR(18),
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
balance_trunk_fill SMALLINT(5) UNSIGNED default '0',
status_category_1 VARCHAR(20),
status_category_count_1 INT(9) UNSIGNED default '0',
status_category_2 VARCHAR(20),
status_category_count_2 INT(9) UNSIGNED default '0',
status_category_3 VARCHAR(20),
status_category_count_3 INT(9) UNSIGNED default '0',
status_category_4 VARCHAR(20),
status_category_count_4 INT(9) UNSIGNED default '0',
hold_sec_stat_one MEDIUMINT(8) UNSIGNED default '0',
hold_sec_stat_two MEDIUMINT(8) UNSIGNED default '0',
agent_non_pause_sec MEDIUMINT(8) UNSIGNED default '0',
hold_sec_answer_calls MEDIUMINT(8) UNSIGNED default '0',
hold_sec_drop_calls MEDIUMINT(8) UNSIGNED default '0',
hold_sec_queue_calls MEDIUMINT(8) UNSIGNED default '0'
);

CREATE TABLE vicidial_dnc (
phone_number VARCHAR(18) PRIMARY KEY NOT NULL
);

CREATE TABLE vicidial_lead_recycle (
recycle_id INT(9) UNSIGNED AUTO_INCREMENT PRIMARY KEY NOT NULL,
campaign_id VARCHAR(8),
status VARCHAR(6) NOT NULL,
attempt_delay SMALLINT(5) UNSIGNED default '1800',
attempt_maximum TINYINT(3) UNSIGNED default '2',
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

CREATE TABLE system_settings (
version VARCHAR(50),
install_date VARCHAR(50),
use_non_latin ENUM('0','1') default '0',
webroot_writable ENUM('0','1') default '1',
enable_queuemetrics_logging ENUM('0','1') default '0',
queuemetrics_server_ip VARCHAR(15),
queuemetrics_dbname VARCHAR(50),
queuemetrics_login VARCHAR(50),
queuemetrics_pass VARCHAR(50),
queuemetrics_url VARCHAR(255),
queuemetrics_log_id VARCHAR(10) default 'VIC',
queuemetrics_eq_prepend VARCHAR(255) default 'NONE',
vicidial_agent_disable ENUM('NOT_ACTIVE','LIVE_AGENT','EXTERNAL','ALL') default 'ALL',
allow_sipsak_messages ENUM('0','1') default '0',
admin_home_url VARCHAR(255) default '../vicidial/welcome.php',
enable_agc_xfer_log ENUM('0','1') default '0',
db_schema_version INT(8) UNSIGNED default '0',
auto_user_add_value INT(9) UNSIGNED default '101',
timeclock_end_of_day VARCHAR(4) default '0000',
timeclock_last_reset_date DATE,
vdc_header_date_format VARCHAR(50) default 'MS_DASH_24HR  2008-06-24 23:59:59',
vdc_customer_date_format VARCHAR(50) default 'AL_TEXT_AMPM  OCT 24, 2008 11:59:59 PM',
vdc_header_phone_format VARCHAR(50) default 'US_PARN (000)000-0000',
vdc_agent_api_active ENUM('0','1') default '0',
qc_last_pull_time DATETIME,
enable_vtiger_integration ENUM('0','1') default '0',
vtiger_server_ip VARCHAR(15),
vtiger_dbname VARCHAR(50),
vtiger_login VARCHAR(50),
vtiger_pass VARCHAR(50),
vtiger_url VARCHAR(255),
qc_features_active ENUM('1','0') default '0',
outbound_autodial_active ENUM('1','0') default '1',
outbound_calls_per_second SMALLINT(3) UNSIGNED default '40'
);

CREATE TABLE vicidial_campaigns_list_mix (
vcl_id VARCHAR(20) PRIMARY KEY NOT NULL,
vcl_name VARCHAR(50),
campaign_id VARCHAR(8),
list_mix_container TEXT,
mix_method ENUM('EVEN_MIX','IN_ORDER','RANDOM') default 'IN_ORDER',
status ENUM('ACTIVE','INACTIVE') default 'INACTIVE',
index (campaign_id)
);

CREATE TABLE vicidial_status_categories (
vsc_id VARCHAR(20) PRIMARY KEY NOT NULL,
vsc_name VARCHAR(50),
vsc_description VARCHAR(255),
tovdad_display ENUM('Y','N') default 'N',
sale_category ENUM('Y','N') default 'N',
dead_lead_category ENUM('Y','N') default 'N'
);

CREATE TABLE vicidial_ivr (
ivr_id INT(9) UNSIGNED AUTO_INCREMENT PRIMARY KEY NOT NULL,
entry_time DATETIME,
length_in_sec SMALLINT(5) UNSIGNED default '0',
inbound_number VARCHAR(12),
recording_id INT(9) UNSIGNED,
recording_filename VARCHAR(50),
company_id VARCHAR(12),
phone_number VARCHAR(18),
lead_id INT(9) UNSIGNED,
campaign_id VARCHAR(20),			
product_code VARCHAR(20),
user VARCHAR(20),
prompt_audio_1 VARCHAR(20),
prompt_response_1 TINYINT(1) UNSIGNED default '0',
prompt_audio_2 VARCHAR(20),
prompt_response_2 TINYINT(1) UNSIGNED default '0',
prompt_audio_3 VARCHAR(20),
prompt_response_3 TINYINT(1) UNSIGNED default '0',
prompt_audio_4 VARCHAR(20),
prompt_response_4 TINYINT(1) UNSIGNED default '0',
prompt_audio_5 VARCHAR(20),
prompt_response_5 TINYINT(1) UNSIGNED default '0',
prompt_audio_6 VARCHAR(20),
prompt_response_6 TINYINT(1) UNSIGNED default '0',
prompt_audio_7 VARCHAR(20),
prompt_response_7 TINYINT(1) UNSIGNED default '0',
prompt_audio_8 VARCHAR(20),
prompt_response_8 TINYINT(1) UNSIGNED default '0',
prompt_audio_9 VARCHAR(20),
prompt_response_9 TINYINT(1) UNSIGNED default '0',
prompt_audio_10 VARCHAR(20),
prompt_response_10 TINYINT(1) UNSIGNED default '0',
prompt_audio_11 VARCHAR(20),
prompt_response_11 TINYINT(1) UNSIGNED default '0',
prompt_audio_12 VARCHAR(20),
prompt_response_12 TINYINT(1) UNSIGNED default '0',
prompt_audio_13 VARCHAR(20),
prompt_response_13 TINYINT(1) UNSIGNED default '0',
prompt_audio_14 VARCHAR(20),
prompt_response_14 TINYINT(1) UNSIGNED default '0',
prompt_audio_15 VARCHAR(20),
prompt_response_15 TINYINT(1) UNSIGNED default '0',
prompt_audio_16 VARCHAR(20),
prompt_response_16 TINYINT(1) UNSIGNED default '0',
prompt_audio_17 VARCHAR(20),
prompt_response_17 TINYINT(1) UNSIGNED default '0',
prompt_audio_18 VARCHAR(20),
prompt_response_18 TINYINT(1) UNSIGNED default '0',
prompt_audio_19 VARCHAR(20),
prompt_response_19 TINYINT(1) UNSIGNED default '0',
prompt_audio_20 VARCHAR(20),
prompt_response_20 TINYINT(1) UNSIGNED default '0',
index (phone_number),
index (entry_time)
);

ALTER TABLE vicidial_ivr AUTO_INCREMENT = 1000000;

CREATE TABLE vicidial_inbound_group_agents (
user VARCHAR(20),
group_id VARCHAR(20),			
group_rank TINYINT(1) default '0',
group_weight TINYINT(1) default '0',
calls_today SMALLINT(5) UNSIGNED default '0',
group_web_vars VARCHAR(255) default '',
index (group_id),
index (user)
);

CREATE TABLE vicidial_live_inbound_agents (
user VARCHAR(20),
group_id VARCHAR(20),			
group_weight TINYINT(1) default '0',
calls_today SMALLINT(5) UNSIGNED default '0',
last_call_time DATETIME,
last_call_finish DATETIME,
index (group_id),
index (group_weight)
);

CREATE TABLE vicidial_campaign_agents (
user VARCHAR(20),
campaign_id VARCHAR(20),			
campaign_rank TINYINT(1) default '0',
campaign_weight TINYINT(1) default '0',
calls_today SMALLINT(5) UNSIGNED default '0',
group_web_vars VARCHAR(255) default '',
index (campaign_id),
index (user)
);

CREATE TABLE vicidial_user_closer_log (
user VARCHAR(20),
campaign_id VARCHAR(20),
event_date DATETIME,
blended ENUM('1','0') default '0',
closer_campaigns TEXT,
index (user),
index (event_date)
);

CREATE TABLE vicidial_qc_codes (
code VARCHAR(8) PRIMARY KEY NOT NULL,
code_name VARCHAR(30)
);

CREATE TABLE vicidial_agent_sph (
campaign_group_id VARCHAR(20) NOT NULL,
stat_date DATE NOT NULL,
shift VARCHAR(20) NOT NULL,
role ENUM('FRONTER','CLOSER') default 'FRONTER',
user VARCHAR(20) NOT NULL,
calls MEDIUMINT(8) UNSIGNED default '0',
sales MEDIUMINT(8) UNSIGNED default '0',
login_sec MEDIUMINT(8) UNSIGNED default '0',
login_hours DECIMAL(5,2) DEFAULT '0.00',
sph DECIMAL(6,2) DEFAULT '0.00',
index (campaign_group_id),
index (stat_date)
);

CREATE TABLE phones_alias (
alias_id VARCHAR(20) NOT NULL UNIQUE PRIMARY KEY,
alias_name VARCHAR(50),
logins_list VARCHAR(255)
);

CREATE TABLE vicidial_shifts (
shift_id VARCHAR(20) NOT NULL,
shift_name VARCHAR(50),
shift_start_time VARCHAR(4) default '0900',
shift_length VARCHAR(5) default '16:00',
shift_weekdays VARCHAR(7) default '0123456',
index (shift_id)
);

CREATE TABLE vicidial_timeclock_log (
timeclock_id INT(9) UNSIGNED AUTO_INCREMENT PRIMARY KEY NOT NULL,
event_epoch INT(10) UNSIGNED NOT NULL,
event_date DATETIME NOT NULL,
login_sec INT(10) UNSIGNED,
event VARCHAR(50) NOT NULL,
user VARCHAR(20) NOT NULL,
user_group VARCHAR(20) NOT NULL,
ip_address VARCHAR(15),
shift_id VARCHAR(20),
notes VARCHAR(255),
manager_user VARCHAR(20),
manager_ip VARCHAR(15),
event_datestamp TIMESTAMP NOT NULL,
tcid_link INT(9) UNSIGNED,
index (user)
);

CREATE TABLE vicidial_timeclock_status (
user VARCHAR(20) UNIQUE NOT NULL,
user_group VARCHAR(20) NOT NULL,
event_epoch INT(10) UNSIGNED,
event_date TIMESTAMP,
status VARCHAR(50),
ip_address VARCHAR(15),
shift_id VARCHAR(20),
index (user)
);

CREATE TABLE vicidial_timeclock_audit_log (
timeclock_id INT(9) UNSIGNED NOT NULL,
event_epoch INT(10) UNSIGNED NOT NULL,
event_date DATETIME NOT NULL,
login_sec INT(10) UNSIGNED,
event VARCHAR(50) NOT NULL,
user VARCHAR(20) NOT NULL,
user_group VARCHAR(20) NOT NULL,
ip_address VARCHAR(15),
shift_id VARCHAR(20),
event_datestamp TIMESTAMP NOT NULL,
tcid_link INT(9) UNSIGNED,
index (timeclock_id),
index (user)
);

CREATE TABLE vicidial_admin_log (
admin_log_id INT(9) UNSIGNED AUTO_INCREMENT PRIMARY KEY NOT NULL,
event_date DATETIME NOT NULL,
user VARCHAR(20) NOT NULL,
ip_address VARCHAR(15) NOT NULL,
event_section VARCHAR(30) NOT NULL,
event_type ENUM('ADD','COPY','LOAD','RESET','MODIFY','DELETE','SEARCH','LOGIN','LOGOUT','CLEAR','OVERRIDE','EXPORT','OTHER') default 'OTHER',
record_id VARCHAR(50) NOT NULL,
event_code VARCHAR(255) NOT NULL,
event_sql TEXT,
event_notes TEXT,
index (user),
index (event_section),
index (record_id)
);

CREATE TABLE vicidial_list_alt_phones (
alt_phone_id INT(9) UNSIGNED AUTO_INCREMENT PRIMARY KEY NOT NULL,
lead_id INT(9) UNSIGNED NOT NULL,
phone_code VARCHAR(10),
phone_number VARCHAR(18),
alt_phone_note VARCHAR(30),
alt_phone_count SMALLINT(5) UNSIGNED,
active ENUM('Y','N') default 'Y',
index (lead_id),
index (phone_number)
);

CREATE TABLE vicidial_campaign_dnc (
phone_number VARCHAR(18) NOT NULL,
campaign_id VARCHAR(8) NOT NULL,
index (phone_number),
UNIQUE INDEX phonecamp (phone_number, campaign_id)
);

CREATE TABLE vicidial_inbound_dids (
did_id INT(9) UNSIGNED AUTO_INCREMENT PRIMARY KEY NOT NULL,
did_pattern VARCHAR(50) NOT NULL,
did_description VARCHAR(50),
did_active ENUM('Y','N') default 'Y',
did_route ENUM('EXTEN','VOICEMAIL','AGENT','PHONE','IN_GROUP') default 'EXTEN',
extension VARCHAR(50) default '9998811112',
exten_context VARCHAR(50) default 'default',
voicemail_ext VARCHAR(10),
phone VARCHAR(100),
server_ip VARCHAR(15),
user VARCHAR(20),
user_unavailable_action ENUM('IN_GROUP','EXTEN','VOICEMAIL','PHONE') default 'VOICEMAIL',
user_route_settings_ingroup VARCHAR(20) default 'AGENTDIRECT',
group_id VARCHAR(20),
call_handle_method VARCHAR(20) default 'CID',
agent_search_method ENUM('LO','LB','SO') default 'LB',
list_id BIGINT(14) UNSIGNED default '999',
campaign_id VARCHAR(8),
phone_code VARCHAR(10) default '1',
unique index (did_pattern),
index (group_id)
);

CREATE TABLE vicidial_did_log (
uniqueid VARCHAR(20) NOT NULL,
channel VARCHAR(100) NOT NULL,
server_ip VARCHAR(15) NOT NULL,
caller_id_number VARCHAR(18),
caller_id_name VARCHAR(20),
extension VARCHAR(100),
call_date DATETIME,
did_id VARCHAR(9) default '',
did_route VARCHAR(9) default '',
index (uniqueid),
index (caller_id_number),
index (extension),
index (call_date)
);

CREATE TABLE vicidial_api_log (
api_id INT(9) UNSIGNED AUTO_INCREMENT PRIMARY KEY NOT NULL,
user VARCHAR(20) NOT NULL,
api_date DATETIME,
api_script VARCHAR(10),
function VARCHAR(20) NOT NULL,
agent_user VARCHAR(20),
value VARCHAR(255),
result VARCHAR(10),
result_reason VARCHAR(255),
source VARCHAR(20),
data TEXT,
index(api_date)
);

CREATE TABLE vicidial_nanpa_prefix_codes (
areacode CHAR(3),
prefix CHAR(3),
GMT_offset VARCHAR(6),
DST enum('Y','N'),
latitude VARCHAR(17),
longitude VARCHAR(17),
city VARCHAR(50) default '',
state VARCHAR(2) default '',
postal_code VARCHAR(10) default '',
country VARCHAR(2) default ''
);

CREATE INDEX areaprefix on vicidial_nanpa_prefix_codes (areacode,prefix);

CREATE TABLE vicidial_cpd_log (
cpd_id INT(10) UNSIGNED AUTO_INCREMENT PRIMARY KEY NOT NULL,
channel VARCHAR(100) NOT NULL,
uniqueid VARCHAR(20),
callerid VARCHAR(20),
server_ip VARCHAR(15) NOT NULL,
lead_id INT(9) UNSIGNED,
event_date DATETIME,
result VARCHAR(20),
status ENUM('NEW','PROCESSED') default 'NEW',
cpd_seconds DECIMAL(7,2) default '0',
index(uniqueid),
index(callerid),
index(lead_id)
);

CREATE TABLE vicidial_conf_templates (
template_id VARCHAR(15) NOT NULL,
template_name VARCHAR(50) NOT NULL,
template_contents TEXT,
unique index (template_id)
);

CREATE TABLE vicidial_server_carriers (
carrier_id VARCHAR(15) NOT NULL,
carrier_name VARCHAR(50) NOT NULL,
registration_string VARCHAR(255),
template_id VARCHAR(15) NOT NULL,
account_entry TEXT,
protocol ENUM('SIP','Zap','IAX2','EXTERNAL') default 'SIP',
globals_string VARCHAR(255),
dialplan_entry TEXT,
server_ip VARCHAR(15) NOT NULL,
active ENUM('Y','N') default 'Y',
unique index(carrier_id),
index (server_ip)
);

CREATE TABLE groups_alias (
group_alias_id VARCHAR(30) NOT NULL UNIQUE PRIMARY KEY,
group_alias_name VARCHAR(50),
caller_id_number VARCHAR(20),
caller_id_name VARCHAR(20),
active ENUM('Y','N') default 'N'
);

CREATE TABLE user_call_log (
user_call_log_id INT(9) UNSIGNED AUTO_INCREMENT PRIMARY KEY NOT NULL,
user VARCHAR(20),
call_date DATETIME,
call_type VARCHAR(20),
server_ip VARCHAR(15) NOT NULL,
phone_number VARCHAR(20),
number_dialed VARCHAR(30),
lead_id INT(9) UNSIGNED,
callerid VARCHAR(20),
group_alias_id VARCHAR(30),
index (user),
index (call_date)
);


ALTER TABLE vicidial_campaign_server_stats ENGINE=HEAP;

ALTER TABLE live_channels ENGINE=HEAP;

ALTER TABLE live_sip_channels ENGINE=HEAP;

ALTER TABLE parked_channels ENGINE=HEAP;

ALTER TABLE server_updater ENGINE=HEAP;

ALTER TABLE web_client_sessions ENGINE=HEAP;


UPDATE system_settings SET auto_user_add_value='1101';

INSERT INTO vicidial_inbound_groups(group_id,group_name,group_color,active,queue_priority) values('AGENTDIRECT','Single Agent Direct Queue','white','Y','99');

INSERT INTO vicidial_lists SET list_id='999',list_name='Default inbound list',campaign_id='TESTCAMP',active='N';
INSERT INTO vicidial_lists SET list_id='998',list_name='Default Manual list',campaign_id='TESTCAMP',active='N';

INSERT INTO system_settings (version,install_date) values('2.2.0b0.5', CURDATE());

INSERT INTO vicidial_status_categories (vsc_id,vsc_name) values('UNDEFINED','Default Category');

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

INSERT INTO vicidial_shifts SET shift_id='24HRMIDNIGHT',shift_name='24 hours 7 days a week',shift_start_time='0000',shift_length='24:00',shift_weekdays='0123456';

INSERT INTO vicidial_phone_codes (country_code, country, areacode, state, GMT_offset, DST, DST_range, geographic_description) VALUES ('1','USA','227','MD','-5','Y','SSM-FSN','');
INSERT INTO vicidial_phone_codes (country_code, country, areacode, state, GMT_offset, DST, DST_range, geographic_description) VALUES ('1','CAN','343','ON','-5','Y','SSM-FSN','');
INSERT INTO vicidial_phone_codes (country_code, country, areacode, state, GMT_offset, DST, DST_range, geographic_description) VALUES ('1','USA','364','KY','-6','Y','SSM-FSN','');
INSERT INTO vicidial_phone_codes (country_code, country, areacode, state, GMT_offset, DST, DST_range, geographic_description) VALUES ('1','USA','447','IL','-6','Y','SSM-FSN','');
INSERT INTO vicidial_phone_codes (country_code, country, areacode, state, GMT_offset, DST, DST_range, geographic_description) VALUES ('1','USA','575','NM','-7','Y','SSM-FSN','');
INSERT INTO vicidial_phone_codes (country_code, country, areacode, state, GMT_offset, DST, DST_range, geographic_description) VALUES ('1','CAN','581','QC','-5','Y','SSM-FSN','');
INSERT INTO vicidial_phone_codes (country_code, country, areacode, state, GMT_offset, DST, DST_range, geographic_description) VALUES ('1','CAN','587','AB','-7','Y','SSM-FSN','');
INSERT INTO vicidial_phone_codes (country_code, country, areacode, state, GMT_offset, DST, DST_range, geographic_description) VALUES ('1','USA','659','AL','-6','Y','SSM-FSN','');
INSERT INTO vicidial_phone_codes (country_code, country, areacode, state, GMT_offset, DST, DST_range, geographic_description) VALUES ('1','USA','667','MD','-5','Y','SSM-FSN','');
INSERT INTO vicidial_phone_codes (country_code, country, areacode, state, GMT_offset, DST, DST_range, geographic_description) VALUES ('1','USA','681','WV','-5','Y','SSM-FSN','');
INSERT INTO vicidial_phone_codes (country_code, country, areacode, state, GMT_offset, DST, DST_range, geographic_description) VALUES ('1','USA','730','IL','-6','Y','SSM-FSN','');
INSERT INTO vicidial_phone_codes (country_code, country, areacode, state, GMT_offset, DST, DST_range, geographic_description) VALUES ('1','DOM','829','','-4','N','','Dominican Republic');

INSERT INTO vicidial_conf_templates SET template_id='SIP_generic',template_name='SIP phone generic',template_contents="type=friend\nhost=dynamic\ncanreinvite=no\ncontext=default";
INSERT INTO vicidial_conf_templates SET template_id='IAX_generic',template_name='IAX phone generic',template_contents="type=friend\nhost=dynamic\nmaxauthreq=10\nauth=md5,plaintext,rsa\ncontext=default";

INSERT INTO vicidial_server_carriers SET carrier_id='PARAXIP', carrier_name='TEST ParaXip CPD example',registration_string='', template_id='--NONE--', account_entry="[paraxip]\ndisallow=all\nallow=ulaw\ntype=peer\nusername=paraxip\nfromuser=paraxip\nsecret=test\nfromdomain=10.10.10.16\nhost=10.10.10.15\ninsecure=port,invite\noutboundproxy=10.0.0.7", protocol='SIP', globals_string='TESTSIPTRUNKP = SIP/paraxip', dialplan_entry="exten => _5591999NXXXXXX,1,AGI(agi://127.0.0.1:4577/call_log)\nexten => _5591999NXXXXXX,2,Dial(${TESTSIPTRUNKP}/${EXTEN:4},,tTor)\nexten => _5591999NXXXXXX,3,Hangup", server_ip='10.10.10.15', active='N';
INSERT INTO vicidial_server_carriers SET carrier_id='SIPEXAMPLE', carrier_name='TEST SIP carrier example',registration_string='register => testcarrier:test@10.10.10.15:5060', template_id='--NONE--', account_entry="[testcarrier]\ndisallow=all\nallow=ulaw\ntype=friend\nusername=testcarrier\nsecret=test\nhost=dynamic\ndtmfmode=rfc2833\ncontext=trunkinbound\n", protocol='SIP', globals_string='TESTSIPTRUNK = SIP/testcarrier', dialplan_entry="exten => _91999NXXXXXX,1,AGI(agi://127.0.0.1:4577/call_log)\nexten => _91999NXXXXXX,2,Dial(${TESTSIPTRUNK}/${EXTEN:2},,tTor)\nexten => _91999NXXXXXX,3,Hangup\n", server_ip='10.10.10.15', active='N';
INSERT INTO vicidial_server_carriers SET carrier_id='IAXEXAMPLE', carrier_name='TEST IAX carrier example',registration_string='register => testcarrier:test@10.10.10.15:4569', template_id='--NONE--', account_entry="[testcarrier]\ndisallow=all\nallow=ulaw\ntype=friend\naccountcode=testcarrier\nsecret=test\nhost=dynamic\ncontext=trunkinbound\n", protocol='IAX2', globals_string='TESTIAXTRUNK = IAX2/testcarrier', dialplan_entry="exten => _71999NXXXXXX,1,AGI(agi://127.0.0.1:4577/call_log)\nexten => _71999NXXXXXX,2,Dial(${TESTIAXTRUNK}/${EXTEN:2},,tTor)\nexten => _71999NXXXXXX,3,Hangup\n", server_ip='10.10.10.15', active='N';

INSERT INTO vicidial_inbound_dids SET did_pattern='default', did_description='Default DID', did_active='Y', did_route='EXTEN', extension='9998811112', exten_context='default';

UPDATE system_settings SET qc_last_pull_time=NOW();

CREATE INDEX country_postal_code on vicidial_postal_codes (country_code,postal_code);
CREATE INDEX country_area_code on vicidial_phone_codes (country_code,areacode);
CREATE INDEX country_state on vicidial_phone_codes (country_code,state);
CREATE INDEX country_code on vicidial_phone_codes (country_code);
CREATE INDEX phone_list on vicidial_list (phone_number,list_id);
CREATE INDEX list_phone on vicidial_list (list_id,phone_number);
CREATE INDEX start_time on call_log (start_time);
CREATE INDEX end_time on call_log (end_time);
CREATE INDEX time on call_log (start_time,end_time);
CREATE INDEX list_status on vicidial_list (list_id,status);
CREATE INDEX time_user on vicidial_agent_log (event_time,user);
CREATE INDEX date_user on vicidial_xfer_log (call_date,user);
CREATE INDEX date_closer on vicidial_xfer_log (call_date,closer);
CREATE INDEX phone_number on vicidial_xfer_log (phone_number);
CREATE INDEX phone_number on vicidial_closer_log (phone_number);
CREATE INDEX date_user on vicidial_closer_log (call_date,user);
CREATE INDEX comment_a on live_inbound_log (comment_a);

UPDATE system_settings SET db_schema_version='1136';

GRANT RELOAD ON *.* TO cron@'%';
GRANT RELOAD ON *.* TO cron@localhost;

flush privileges;
