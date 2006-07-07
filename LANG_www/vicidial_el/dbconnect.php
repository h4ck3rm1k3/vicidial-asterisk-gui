<?

$link=mysql_connect("10.10.11.10", "astcron", "astcron");
mysql_select_db("asterisk");

$local_DEF = 'Local/';
$conf_silent_prefix = '7';
$local_AMP = '@';
$ext_context = 'demo';
$recording_exten = '8309';

$WeBServeRRooT = '/home/www/htdocs';
#$WeBServeRRooT = '/usr/local/apache2/htdocs';
$WeBRooTWritablE = '1';

?>
