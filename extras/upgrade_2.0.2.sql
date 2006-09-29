ALTER TABLE vicidial_campaign_stats ADD balance_trunk_fill SMALLINT(5) UNSIGNED default '0';

 CREATE TABLE vicidial_campaign_server_stats (
campaign_id VARCHAR(20) PRIMARY KEY NOT NULL,
server_ip VARCHAR(15) NOT NULL,
update_time TIMESTAMP,
local_trunk_shortage SMALLINT(5) UNSIGNED default '0'
);

 CREATE TABLE vicidial_server_trunks (
server_ip VARCHAR(15) NOT NULL,
campaign_id VARCHAR(20) NOT NULL,
dedicated_trunks SMALLINT(5) UNSIGNED default '0',
trunk_restriction ENUM('MAXIMUM_LIMIT','OVERFLOW_ALLOWED') default 'OVERFLOW_ALLOWED'
);

ALTER TABLE servers ADD vicidial_balance_active ENUM('Y','N') default 'N';
ALTER TABLE servers ADD balance_trunks_offlimits SMALLINT(5) UNSIGNED default '0';
