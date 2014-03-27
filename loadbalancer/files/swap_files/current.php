<?php

/*
 * current.php
 *
 * returns the current LB_ALGO in use
 */

function getCurrentAlgo() {
	// some constants that vary based on file location
	define("CONFIG_FILE", "/etc/haproxy/haproxy.cfg");
	define("ALGO_FILE", "algorithms.txt");

	$config_file = explode("\n", file_get_contents(CONFIG_FILE));
	$algo_file = explode("\n", trim(file_get_contents(ALGO_FILE)));

	// make the changes
	foreach ($config_file as $key => $line) {
		// search for LB_ALGO
		if (preg_match("#balance#i", $line)) {
			// it has now found a line related to LB_ALGO. it will match an existing algorithm and return it
			foreach ($algo_file as $algorithm) {
				if (($pos = strpos($line, $algorithm)) !== false) {
					return $algorithm;
				}
			}		
		}
	}

	return "error";
}


?>
