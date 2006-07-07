<?
### test.php
### 
### Copyright (C) 2006  Matt Florell <vicidial@gmail.com>    LICENSE: GPLv2
###

$STARTtime = date("U");
$STARTdate = date("Y-m-d H:i:s");


$link=mysql_connect("localhost", "cron", "1234");
mysql_select_db("asterisk");

	$stmt="SELECT * from phones;";
	$rslt=mysql_query($stmt, $link);
	$row=mysql_fetch_row($rslt);
	$auth=$row[0];

	print "|$auth|\n";

exit; 



?>





