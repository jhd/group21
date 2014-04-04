<?php

/*
 * currreqs_wrapper.php
 *
 * interfaces between client-side js and currreqs.sh
 */

if (!(isset($_POST["LB_ALGO"]) && isset($_POST["boundary"]) && isset($_POST["reaction"]))) {
	exit(-1);
}

$reaction = 0;
if ($_POST["reaction"] == "fall") {
	$reaction = 1;
}

shell_exec("bash currreqs.sh ".$_POST["LB_ALGO"]." ".$_POST["boundary"]." ".$reaction);

?>
