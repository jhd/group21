<?php

/*
 * currconns_wrapper.php
 *
 * interfaces between client-side js and currconns.sh
 */

if (!(isset($_POST["LB_ALGO"]) && isset($_POST["boundary"]) && isset($_POST["reaction"]))) {
	exit(-1);
}

$reaction = 0;
if ($_POST["reaction"] == "fall") {
	$reaction = 1;
}

shell_exec("bash currconns.sh ".$_POST["LB_ALGO"]." ".$_POST["boundary"]." ".$reaction);

?>
