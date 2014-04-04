<?php

/*
 * manual-switcher.php
 *
 * this file generates the manual switcher view for index.php
 */

define("ALGO_FILE", "files/swap_files/algorithms.txt");

// an array of every LB_ALGO available
$algo_file = explode("\n", trim(file_get_contents(ALGO_FILE)));

?>

<h1 class="page-header">Manual Switcher</h1>
<div id="container">
	<div id="algo_switcher" style="text-align:left; vertical-align:top; display:inline-block; padding:0 10px 0 10px">
		<form id="algo_switch_form">
			<select name="LB_ALGO" class="selectpicker">
			<?
				foreach ($algo_file as $algo) {
					echo "<option value=\"$algo\">$algo</option>";
				}
			?>
			</select>
			<a id="load_status" style="color:red"></a>
			<input type="submit" class="submit" value="Submit" />
		</form>
	</div>
</div>
