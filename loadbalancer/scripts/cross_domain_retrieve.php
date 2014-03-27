<?php

/*
 * cross_domain_retrieve.php
 *
 * acts as a proxy between client side js and another domain. used to access cross-domain urls from js
 */

// post corrupted/not implemented properly
if (!isset($_POST["url"])) {
	echo "no url";
	exit(-1);
}

$url = $_POST["url"];
echo file_get_contents($url);

?>
