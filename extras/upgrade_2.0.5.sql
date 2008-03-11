ALTER TABLE vicidial_closer_log ADD xfercallid INT(9) UNSIGNED;

ALTER TABLE vicidial_campaign_server_stats ENGINE=HEAP;

ALTER TABLE live_channels ENGINE=HEAP;

ALTER TABLE live_sip_channels ENGINE=HEAP;

ALTER TABLE parked_channels ENGINE=HEAP;

ALTER TABLE server_updater ENGINE=HEAP;

ALTER TABLE web_client_sessions ENGINE=HEAP;


ALTER TABLE vicidial_campaigns MODIFY lead_order VARCHAR(30);

DROP index user on vicidial_users;
ALTER TABLE vicidial_users MODIFY user VARCHAR(20) NOT NULL;
CREATE UNIQUE INDEX user ON vicidial_users (user);
ALTER TABLE vicidial_users MODIFY pass VARCHAR(20) NOT NULL;
ALTER TABLE vicidial_users MODIFY user_level TINYINT(2) NOT NULL default '1';

 CREATE TABLE vicidial_user_closer_log (
user VARCHAR(20),
campaign_id VARCHAR(20),
event_date DATETIME,
blended ENUM('1','0') default '0',
closer_campaigns TEXT,
index (user),
index (event_date)
);

ALTER TABLE vicidial_users ADD qc_enabled ENUM('1','0') default '0';
ALTER TABLE vicidial_users ADD qc_user_level INT(2) default '1';
ALTER TABLE vicidial_users ADD qc_pass ENUM('1','0') default '0';
ALTER TABLE vicidial_users ADD qc_finish ENUM('1','0') default '0';
ALTER TABLE vicidial_users ADD qc_commit ENUM('1','0') default '0';

ALTER TABLE vicidial_user_groups ADD qc_allowed_campaigns TEXT;
ALTER TABLE vicidial_user_groups ADD qc_allowed_inbound_groups TEXT;

ALTER TABLE system_settings ADD db_schema_version INT(8) UNSIGNED default '0';

UPDATE system_settings SET db_schema_version='1074', version='2.0.5b0.5';

ALTER TABLE live_inbound MODIFY uniqueid VARCHAR(20) NOT NULL;
ALTER TABLE live_inbound_log MODIFY uniqueid VARCHAR(20) NOT NULL;
ALTER TABLE live_inbound_log MODIFY uniqueid VARCHAR(20) NOT NULL;
ALTER TABLE vicidial_manager MODIFY uniqueid VARCHAR(20) NOT NULL;
ALTER TABLE vicidial_live_agents MODIFY uniqueid VARCHAR(20) NOT NULL;
ALTER TABLE vicidial_auto_calls MODIFY uniqueid VARCHAR(20) NOT NULL;
ALTER TABLE call_log DROP PRIMARY KEY;
ALTER TABLE call_log DROP INDEX uniqueid;
ALTER TABLE call_log MODIFY uniqueid VARCHAR(20) PRIMARY KEY UNIQUE NOT NULL;
ALTER TABLE park_log DROP PRIMARY KEY;
ALTER TABLE park_log DROP INDEX uniqueid;
ALTER TABLE park_log MODIFY uniqueid VARCHAR(20) PRIMARY KEY UNIQUE NOT NULL;
ALTER TABLE vicidial_log DROP PRIMARY KEY;
ALTER TABLE vicidial_log DROP INDEX uniqueid;
ALTER TABLE vicidial_log MODIFY uniqueid VARCHAR(20) PRIMARY KEY UNIQUE NOT NULL;

UPDATE system_settings SET db_schema_version='1075';

ALTER TABLE vicidial_auto_calls ADD queue_priority TINYINT(2) default '0';
ALTER TABLE vicidial_campaigns ADD queue_priority TINYINT(2) default '50';
ALTER TABLE vicidial_inbound_groups ADD queue_priority TINYINT(2) default '0';

UPDATE system_settings SET db_schema_version='1076';

ALTER TABLE vicidial_inbound_groups CHANGE drop_message drop_action ENUM('HANGUP','MESSAGE','VOICEMAIL','IN_GROUP') default 'MESSAGE';
ALTER TABLE vicidial_inbound_groups ADD drop_inbound_group VARCHAR(20) default '---NONE---';
UPDATE vicidial_inbound_groups SET drop_action='MESSAGE';

ALTER TABLE vicidial_campaigns CHANGE safe_harbor_message drop_action ENUM('HANGUP','MESSAGE','VOICEMAIL','IN_GROUP') default 'MESSAGE';
ALTER TABLE vicidial_campaigns ADD drop_inbound_group VARCHAR(20) default '---NONE---';
UPDATE vicidial_campaigns SET drop_action='MESSAGE';

UPDATE system_settings SET db_schema_version='1077';

ALTER TABLE vicidial_campaigns ADD qc_enabled ENUM('Y','N') default 'N';
ALTER TABLE vicidial_campaigns ADD qc_statuses TEXT;
ALTER TABLE vicidial_campaigns ADD qc_lists TEXT;
ALTER TABLE vicidial_campaigns ADD campaign_shift_start_time VARCHAR(4) default '0900';
ALTER TABLE vicidial_campaigns ADD campaign_shift_length VARCHAR(5) default '16:00';
ALTER TABLE vicidial_campaigns ADD campaign_day_start_time VARCHAR(4) default '0100';

UPDATE system_settings SET db_schema_version='1078';
