<?php

/*
 * generate.php
 *
 * sends a request to the load tester to start generating the specified amount of packets
 */

define("LOAD_TESTER", "http://10.62.0.1/load_files/generate.php");

if (!isset($_POST["rate"]) || !isset($_POST["duration"])) {
	echo "error";
	exit(-1);
}

$rate = $_POST["rate"];
$duration = $_POST["duration"];

if (!is_numeric($rate) || !is_numeric($duration)) {
	echo "error";
	exit(-1);
}

// sends a post request to the load generator
$options = array(
	'http' => array(
		'header'  => "Content-type: application/x-www-form-urlencoded\r\n",
		'method'  => 'POST',
		'content' => http_build_query($_POST),
	),
);
$context  = stream_context_create($options);
echo file_get_contents(LOAD_TESTER, false, $context);

?>
