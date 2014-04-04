<?php

/*
 * trigger-switcher.php
 *
 * this file generates the trigger switcher view for index.php
 */
 
define("ALGO_FILE", "files/swap_files/algorithms.txt");

// an array of every LB_ALGO available
$algo_file = explode("\n", trim(file_get_contents(ALGO_FILE)));

?>

<h1 class="page-header">Trigger Switcher</h1>
<div id="container">
	<div id="algo_switcher" style="text-align:left; vertical-align:top; display:inline-block; padding:0 10px 0 10px">
		<form id="timer_switch_form">
			<a>Switch to </a>
			<select name="LB_ALGO" class="selectpicker">
			<?
				foreach ($algo_file as $algo) {
					echo "<option value=\"$algo\">$algo</option>";
				}
			?>
			</select>
			<a> after </a>
			<input name="time" type="number" style="width:80px" placeholder="seconds" />
			<input type="submit" class="submit" value="Submit" />
		</form>

		<form id="double_switch_form">
			<a>Switch from </a>
			<select name="first_algo" class="selectpicker">
			<?
				foreach ($algo_file as $algo) {
					echo "<option value=\"$algo\">$algo</option>";
				}
			?>
			</select>
			<a> to </a>
			<select name="second_algo" class="selectpicker">
			<?
				foreach ($algo_file as $algo) {
					echo "<option value=\"$algo\">$algo</option>";
				}
			?>
			</select>
			<a> after </a>
			<input name="time" type="number" style="width:80px" placeholder="seconds" />
			<input type="submit" class="submit" value="Submit" />
		</form>

		<form id="load_switch_form">
			<a>Switch to </a>
			<select name="LB_ALGO" class="selectpicker">
			<?
				foreach ($algo_file as $algo) {
					echo "<option value=\"$algo\">$algo</option>";
				}
			?>
			</select>
			<a> if load </a>
			<select name="reaction" class="selectpicker">
				<option value="rise">rises above</option>
				<option value="fall">falls below</option>
			</select>
			<input name="boundary" type="number" style="width:80px" placeholder="packets/s" />
			<input type="submit" class="submit" value="Submit" />
		</form>

		<form id="auto_switch_form">
			<a>Iterate over all algorithms for </a>
			<input name="time" type="number" style="width:80px" placeholder="seconds" />
			<a> each</a>
			<input type="submit" class="submit" value="Submit" />
		</form>
	</div>
</div>
