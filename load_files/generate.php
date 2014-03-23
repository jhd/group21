<?php

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

$shell = "echo \"GET http://10.62.0.15\" | ./vegeta attack -rate=".$rate." -duration=".$duration."s | ./vegeta report";
echo $rate." packet load for ".$duration."s";
shell_exec($shell);

?>
