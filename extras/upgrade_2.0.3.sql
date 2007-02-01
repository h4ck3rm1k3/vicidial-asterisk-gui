ALTER TABLE vicidial_campaigns ADD concurrent_transfers ENUM('AUTO','1','2','3','4','5','6','7','8','9','10') default 'AUTO';
ALTER TABLE vicidial_campaigns ADD auto_alt_dial ENUM('NONE','ALT_ONLY','ADDR3_ONLY','ALT_AND_ADDR3') default 'NONE';
ALTER TABLE vicidial_campaigns ADD auto_alt_dial_statuses VARCHAR(255) default ' B N NA DC -';

ALTER TABLE vicidial_auto_calls ADD alt_dial ENUM('NONE','MAIN','ALT','ADDR3') default 'NONE';

ALTER TABLE vicidial_hopper ADD alt_dial ENUM('NONE','ALT','ADDR3') default 'NONE';
ALTER TABLE vicidial_hopper MODIFY status ENUM('READY','QUEUE','INCALL','DONE','HOLD') default 'READY';

ALTER TABLE vicidial_log ADD user_group VARCHAR(20);
ALTER TABLE vicidial_closer_log ADD user_group VARCHAR(20);
ALTER TABLE vicidial_user_log ADD user_group VARCHAR(20);
ALTER TABLE vicidial_agent_log ADD user_group VARCHAR(20);
ALTER TABLE vicidial_callbacks ADD user_group VARCHAR(20);

ALTER TABLE vicidial_users ADD modify_users ENUM('0','1') default '0';
ALTER TABLE vicidial_users ADD modify_campaigns ENUM('0','1') default '0';
ALTER TABLE vicidial_users ADD modify_lists ENUM('0','1') default '0';
ALTER TABLE vicidial_users ADD modify_scripts ENUM('0','1') default '0';
ALTER TABLE vicidial_users ADD modify_filters ENUM('0','1') default '0';
ALTER TABLE vicidial_users ADD modify_ingroups ENUM('0','1') default '0';
ALTER TABLE vicidial_users ADD modify_usergroups ENUM('0','1') default '0';
ALTER TABLE vicidial_users ADD modify_remoteagents ENUM('0','1') default '0';
ALTER TABLE vicidial_users ADD modify_servers ENUM('0','1') default '0';
ALTER TABLE vicidial_users ADD view_reports ENUM('0','1') default '0';

UPDATE vicidial_users SET modify_users='1',view_reports='1' where user_level>7;
UPDATE vicidial_users SET modify_campaigns='1' where campaign_detail='1';
UPDATE vicidial_users SET modify_campaigns='1' where delete_campaigns='1';
UPDATE vicidial_users SET modify_lists='1' where delete_lists='1';
UPDATE vicidial_users SET modify_scripts='1' where delete_scripts='1';
UPDATE vicidial_users SET modify_filters='1' where delete_filters='1';
UPDATE vicidial_users SET modify_ingroups='1' where delete_ingroups='1';
UPDATE vicidial_users SET modify_usergroups='1' where delete_user_groups='1';
UPDATE vicidial_users SET modify_remoteagents='1' where delete_remote_agents='1';
UPDATE vicidial_users SET modify_servers='1' where ast_admin_access='1';

ALTER TABLE inbound_numbers ADD department VARCHAR(30);
