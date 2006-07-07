<?
# 
# Copyright (C) 2006  Matt Florell <vicidial@gmail.com>    LICENSE: GPLv2
#
$link=mysql_connect("localhost", "cron", "1234");
mysql_select_db("asterisk");

$local_DEF = 'Local/';
$conf_silent_prefix = '7';
$local_AMP = '@';
$ext_context = 'demo';
$recording_exten = '8309';

#$WeBServeRRooT = '/home/www/htdocs';
$WeBServeRRooT = '/usr/local/apache2/htdocs';
$WeBRooTWritablE = '1';

?>
