<?
# dbconnect.php
# 
# Copyright (C) 2006  Matt Florell <vicidial@gmail.com>    LICENSE: GPLv2
#

$link=mysql_connect("localhost", "cron", "1234");
mysql_select_db("asterisk");

#$WeBServeRRooT = '/home/www/htdocs';
$WeBServeRRooT = '/usr/local/apache2/htdocs';
$WeBRooTWritablE = '1';

?>