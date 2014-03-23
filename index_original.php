<?php

// some supporting files
define("ALGO_FILE", "swap_files/algorithms.txt");

include 'swap_files/current.php';
$current = getCurrentAlgo();

// an array of every LB_ALGO available
$algo_file = explode("\n", trim(file_get_contents(ALGO_FILE)));

?>

<html>
	<head>
		<title>HAProxy_hotswap framework</title>
		<script src="http://code.jquery.com/jquery-1.9.1.js"></script>
		<script>
		$(function () {
			$('#algo_switch_form').on('submit', function (e) {
				$.ajax({
					type: 'post',
					url: 'swap_files/swap.php',
					data: $('form').serialize(),
					success: function (retval) {
						if (retval=='error') {
							document.getElementById("algo_status").outerHTML="<a id=\"algo_status\" style=\"color:red\">UNKNOWN ERROR</a>";
						}
						else if (retval=='ignore') {
							// ignore return
						}
						else
							document.getElementById("algo_status").outerHTML="<a id=\"algo_status\">current: "+retval+"</a>"
					}
				});
				e.preventDefault();
			});
		});
		</script>
		

	</head>
	<body>
		<center>
			<div id="container">
				<div id="algo_switcher" style="text-align:left; vertical-align:top; display:inline-block; padding:0 10px 0 10px">
					<a>Algorithm switcher</a>
					<form id="algo_switch_form">
						<select name="LB_ALGO">
						<?
							foreach ($algo_file as $algo) {
								echo "<option value=\"$algo\">$algo</option>";
							}
						?>
						</select>
						<input type="submit" class="submit" value="Submit" />
						<br>
						<a id="algo_status">current: <? echo $current ?></a>
					</form>
				</div>
				
				<div id="load_generator" style="text-align:left; vertical-align:top; display:inline-block; padding:0 10px 0 10px">
					<a>Load generator</a>
					<form method="POST" action="load_generator.php">
						<input type="text" placeholder="duration (s)">
						<br>
						<input type="text" placeholder="amount (packets/s)">
						<input type="submit" value="Generate">
					</form>
				</div>
			</div>
		</center>
	</body>
</html>
