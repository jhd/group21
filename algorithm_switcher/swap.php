<?php

// fetch command line argument of the new algorithm name
if (!isset($argv[1]) || isset($argv[2])) {
	echo "Usage: ".$argv[0]." [LB_ALGO]\n";
	exit(-1);
}
$new_algo = $argv[1];

// some constants that vary based on file location
define("CONFIG_FILE", "/etc/haproxy/haproxy.cfg");
define("ALGO_FILE", "algorithms.txt");
define("RELOAD_FILE", "graceful_reload.sh");

$config_file = explode("\n", file_get_contents(CONFIG_FILE));
$algo_file = explode("\n", trim(file_get_contents(ALGO_FILE)));

// make sure that the algorithm we're switching to is actually valid
$valid = false;
foreach ($algo_file as $algorithm) {
	if (strpos($new_algo, $algorithm) !== false) {
		$valid = true;
		break;
	}
}
if ($valid == false) {
	echo "Unrecognised LB_ALGO: ".$new_algo."\n";
	exit(-1);
}

// make the changes
foreach ($config_file as $key => $line) {
	if (preg_match("#balance#i", $line)) {
		// it has now found a line related to LB_ALGO. if it finds an existing algorithm 
		// name there, it's going to replace it with the new algorithm.
		foreach ($algo_file as $algorithm) {
			if (($pos = strpos($line, $algorithm)) !== false) {
				if (strcmp($algorithm, $new_algo) == 0) {
					echo "Algorithm already in use: ".$algorithm.". Aborting\n";
					exit(-1);
				}
				$config_file[$key] = substr_replace($config_file[$key], $new_algo, $pos, strlen($algorithm));
			}
		}		
	}
}

// write the changes to the config file
$f = fopen(CONFIG_FILE, "w");
fwrite($f, implode("\n", $config_file));
fclose($f);

// now run the HAProxy reloader
$shell_reloader = file_get_contents(RELOAD_FILE);
shell_exec($shell_reloader);

?>
