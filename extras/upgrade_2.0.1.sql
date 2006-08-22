ALTER TABLE servers ADD sys_perf_log ENUM('Y','N') default 'N';
ALTER TABLE servers ADD vd_server_logs ENUM('Y','N') default 'Y';
ALTER TABLE servers ADD agi_output ENUM('NONE','STDERR','FILE','BOTH') default 'FILE';
ALTER TABLE vicidial_campaigns ADD allcalls_delay SMALLINT(3) UNSIGNED default '0';
ALTER TABLE vicidial_campaigns ADD omit_phone_code ENUM('Y','N') default 'N';
ALTER TABLE vicidial_campaigns MODIFY campaign_recording ENUM('NEVER','ONDEMAND','ALLCALLS','ALLFORCE') default 'ONDEMAND';

ALTER TABLE vicidial_list MODIFY phone_number VARCHAR(12);
ALTER TABLE vicidial_auto_calls MODIFY phone_number VARCHAR(12);
ALTER TABLE vicidial_log MODIFY phone_number VARCHAR(12);
ALTER TABLE vicidial_closer_log MODIFY phone_number VARCHAR(12);
ALTER TABLE vicidial_xfer_log MODIFY phone_number VARCHAR(12);
ALTER TABLE vicidial_list_pins MODIFY phone_number VARCHAR(12);
ALTER TABLE vicidial_dnc MODIFY phone_number VARCHAR(12);
ALTER TABLE vicidial_list MODIFY alt_phone VARCHAR(12);
