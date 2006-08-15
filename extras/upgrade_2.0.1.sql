ALTER TABLE servers ADD sys_perf_log ENUM('Y','N') default 'N';
ALTER TABLE servers ADD vd_server_logs ENUM('Y','N') default 'Y';
ALTER TABLE servers ADD agi_output ENUM('NONE','STDERR','FILE','BOTH') default 'FILE';
