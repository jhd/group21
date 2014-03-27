<?php

if (isset($_POST["killall"])) {
	$shell = "killall vegeta";
	shell_exec($shell);
	echo "yohoho";
	exit(1);
}

if (!isset($_POST["rate"]) || !isset($_POST["duration"])) {
	echo "error1";
	exit(-1);
}

$rate = $_POST["rate"];
$duration = $_POST["duration"];

if (!is_numeric($rate) || !is_numeric($duration)) {
	echo "error2";
	exit(-1);
}

$shell = "echo \"GET http://10.62.0.15\" | ./vegeta attack -rate=".$rate." -duration=".$duration."s | ./vegeta report";
$output = shell_exec($shell);

$fp = fopen("/var/www/index.html", "w");
fwrite($fp, "<pre>".$output."</pre>");
fclose($fp);

?>
