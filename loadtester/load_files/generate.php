<?php

/*
 * generate.php
 *
 * begins generating packets to send to the load balancer
 */

if (isset($_POST["killall"])) {
	$shell = "killall vegeta";
	shell_exec($shell);
	exit(1);
}

if (!isset($_POST["rate"]) || !isset($_POST["duration"])) {
	echo "error: missing/no input";
	exit(-1);
}

$rate = $_POST["rate"];
$duration = $_POST["duration"];

if (!is_numeric($rate) || !is_numeric($duration)) {
	echo "error: invalid input";
	exit(-1);
}

// begin the test
$shell = "echo \"GET http://_LOADBALANCER_\" | ./vegeta attack -rate=".$rate." -duration=".$duration."s | ./vegeta report";
$output = shell_exec($shell);

// write the load tester output to html
$fp = fopen("/var/www/index.html", "w");
fwrite($fp, "<pre>".$output."</pre>");
fclose($fp);

?>