#!/usr/bin/perl

# AST_SERVER_conf.pl
#
# Copyright (C) 2006  Matt Florell <vicidial@gmail.com>    LICENSE: GPLv2
#

# Customized Variables
$server_ip = '10.10.10.15';		# Asterisk server IP
$DB_server = 'localhost';		# MySQL server IP
$DB_database = 'asterisk';		# MySQL database name
$DB_user = 'cron';			# MySQL user
$DB_pass = '1234';			# MySQL pass
$DB_port = '3306';			# MySQL connection port

$LOGfile = '/home/cron/LOG_AST_update.log';
$telnetlog = '/home/cron/telnetlog.log';
$MSLOGfile = '/home/cron/MSLOG_AST_update.log';
$MStelnetlog = '/home/cron/MStelnetlog.log';
$LILOGfile = '/home/cron/LILOG_AST_update.log';
$LItelnetlog = '/home/cron/LItelnetlog.log';
$KHLOGfile = '/home/cron/KHLOG_AST_update.log';
$VDADLOGfile = '/home/cron/VDLOG_AST_update.log';

return 1;
