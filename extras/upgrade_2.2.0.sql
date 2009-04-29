ALTER TABLE vicidial_nanpa_prefix_codes ADD city VARCHAR(50) default '';
ALTER TABLE vicidial_nanpa_prefix_codes ADD state VARCHAR(2) default '';
ALTER TABLE vicidial_nanpa_prefix_codes ADD postal_code VARCHAR(10) default '';
ALTER TABLE vicidial_nanpa_prefix_codes ADD country VARCHAR(2) default '';

UPDATE system_settings SET db_schema_version='1136', version='2.2.0b0.5';

ALTER TABLE vicidial_users ADD delete_from_dnc ENUM('0','1') default '0';

ALTER TABLE vicidial_campaigns ADD vtiger_search_dead ENUM('DISABLED','ASK','RESURRECT') default 'ASK';
ALTER TABLE vicidial_campaigns ADD vtiger_status_call ENUM('Y','N') default 'N';
ALTER TABLE vicidial_campaigns MODIFY vtiger_screen_login ENUM('Y','N','NEW_WINDOW') default 'Y';
ALTER TABLE vicidial_campaigns MODIFY vtiger_create_call_record ENUM('Y','N','DISPO') default 'Y';

ALTER TABLE vicidial_statuses ADD sale ENUM('Y','N') default 'N';
ALTER TABLE vicidial_statuses ADD dnc ENUM('Y','N') default 'N';
ALTER TABLE vicidial_statuses ADD customer_contact ENUM('Y','N') default 'N';
ALTER TABLE vicidial_statuses ADD not_interested ENUM('Y','N') default 'N';
ALTER TABLE vicidial_statuses ADD unworkable ENUM('Y','N') default 'N';
ALTER TABLE vicidial_campaign_statuses ADD sale ENUM('Y','N') default 'N';
ALTER TABLE vicidial_campaign_statuses ADD dnc ENUM('Y','N') default 'N';
ALTER TABLE vicidial_campaign_statuses ADD customer_contact ENUM('Y','N') default 'N';
ALTER TABLE vicidial_campaign_statuses ADD not_interested ENUM('Y','N') default 'N';
ALTER TABLE vicidial_campaign_statuses ADD unworkable ENUM('Y','N') default 'N';

UPDATE system_settings SET db_schema_version='1137';

ALTER TABLE vicidial_users ADD email VARCHAR(100) default '';
ALTER TABLE vicidial_users ADD user_code VARCHAR(100) default '';
ALTER TABLE vicidial_users ADD territory VARCHAR(100) default '';

UPDATE system_settings SET db_schema_version='1138';

ALTER TABLE vicidial_campaigns ADD survey_third_digit VARCHAR(1) default '';
ALTER TABLE vicidial_campaigns ADD survey_third_audio_file VARCHAR(50) default 'US_thanks_no_contact';
ALTER TABLE vicidial_campaigns ADD survey_third_status VARCHAR(6) default 'NI';
ALTER TABLE vicidial_campaigns ADD survey_third_exten VARCHAR(20) default '8300';
ALTER TABLE vicidial_campaigns ADD survey_fourth_digit VARCHAR(1) default '';
ALTER TABLE vicidial_campaigns ADD survey_fourth_audio_file VARCHAR(50) default 'US_thanks_no_contact';
ALTER TABLE vicidial_campaigns ADD survey_fourth_status VARCHAR(6) default 'NI';
ALTER TABLE vicidial_campaigns ADD survey_fourth_exten VARCHAR(20) default '8300';

ALTER TABLE system_settings ADD enable_tts_integration ENUM('0','1') default '0';

CREATE TABLE vicidial_tts_prompts (
tts_id VARCHAR(50) PRIMARY KEY NOT NULL,
tts_name VARCHAR(100),
active ENUM('Y','N'),
tts_text TEXT
);

UPDATE system_settings SET db_schema_version='1139';

