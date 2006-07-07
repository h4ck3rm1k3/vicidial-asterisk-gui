<?php
/*
author: Paul Concepcion
date: April 18, 2004
iterate through the $_GET, $_POST, and $_SERVER hashes,
creating global variables with the same values.

security risk: equal to running with register_globals "on"

*/

function array_conv($array){
	foreach ($array as $key -> $value){
		${$key} = $value;
		global ${$key};// = $value;
	}

}
array_conv($_GET);
array_conv($_POST);
array_conv($_SERVER);

?>