<?php

/*
 * single_timer_wrapper.php
 *
 * interfaces between client-side js and time.sh
 */

if (!(isset($_POST["LB_ALGO"]) && isset($_POST["time"]))) {
	exit(-1);
}

$current = shell_exec("php current.php");

shell_exec("bash time.sh ".$current." ".$_POST["LB_ALGO"]." ".$_POST["time"]);

?>
