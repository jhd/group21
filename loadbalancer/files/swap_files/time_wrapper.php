<?php

/*
 * time_wrapper.php
 *
 * interfaces between client-side js and time.sh
 */

if (!(isset($_POST["first_algo"]) && isset($_POST["second_algo"]) && isset($_POST["time"]))) {
	exit(-1);
}

shell_exec("bash time.sh ".$_POST["first_algo"]." ".$_POST["second_algo"]." ".$_POST["time"]);

?>
