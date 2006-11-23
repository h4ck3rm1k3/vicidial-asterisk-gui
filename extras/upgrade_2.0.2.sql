ALTER TABLE vicidial_campaign_stats ADD balance_trunk_fill SMALLINT(5) UNSIGNED default '0';

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

ALTER TABLE servers ADD vicidial_balance_active ENUM('Y','N') default 'N';
ALTER TABLE servers ADD balance_trunks_offlimits SMALLINT(5) UNSIGNED default '0';

DELETE from vicidial_phone_codes;


ALTER TABLE vicidial_auto_calls ADD stage VARCHAR(20) default 'START';
ALTER TABLE vicidial_auto_calls ADD last_update_time TIMESTAMP;
ALTER TABLE vicidial_auto_calls ADD index (last_update_time);

ALTER TABLE vicidial_auto_calls MODIFY call_type ENUM('IN','OUT','OUTBALANCE') default 'OUT';

ALTER TABLE vicidial_user_groups ADD allowed_campaigns TEXT;

UPDATE vicidial_user_groups SET allowed_campaigns=' -ALL-CAMPAIGNS- - -';

 CREATE TABLE vicidial_postal_codes (
postal_code VARCHAR(10) NOT NULL,
state VARCHAR(4),
GMT_offset VARCHAR(5),
DST enum('Y','N'),
DST_range VARCHAR(8),
country CHAR(3),
country_code SMALLINT(5) UNSIGNED
);

ALTER TABLE vicidial_list ADD index (postal_code);
