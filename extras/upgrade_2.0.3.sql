ALTER TABLE vicidial_campaigns ADD concurrent_transfers ENUM('AUTO','1','2','3','4','5','6','7','8','9','10') default 'AUTO';
ALTER TABLE vicidial_campaigns ADD auto_alt_dial ENUM('NONE','ALT_ONLY','ADDR3_ONLY','ALT_AND_ADDR3') default 'NONE';
ALTER TABLE vicidial_campaigns ADD auto_alt_dial_statuses VARCHAR(255) default ' B N NA DC -';

ALTER TABLE vicidial_auto_calls ADD alt_dial ENUM('NONE','MAIN','ALT','ADDR3') default 'NONE';

ALTER TABLE vicidial_hopper ADD alt_dial ENUM('NONE','ALT','ADDR3') default 'NONE';
ALTER TABLE vicidial_hopper MODIFY status ENUM('READY','QUEUE','INCALL','DONE','HOLD') default 'READY';

