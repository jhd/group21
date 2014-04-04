<?php

/*
 * auto_wrapper.php
 *
 * interfaces between client-side js and auto.sh
 */

if (!isset($_POST["time"])) {
	exit(-1);
}

shell_exec("bash auto.sh ".$_POST["time"]);

?>
