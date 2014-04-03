$(function () {
	$('#algo_switch_form').on('submit', function (e) {
		$.ajax({
			type: 'post',
			url: '/files/swap_files/swap.php',
			data: $('#algo_switch_form').serialize(),
			success: function (retval) {
				if (retval=='error') {
					document.getElementById("algo_status").innerHTML="UNKNOWN ERROR";
				}
			}
		});
		e.preventDefault();
	});

	$('#timer_switch_form').on('submit', function (e) {
		$.ajax({
			type: 'post',
			url: '/files/swap_files/single_timer_wrapper.php',
			data: $('#timer_switch_form').serialize(),
			success: function (retval) {
				if (retval=='error') {
					document.getElementById("algo_status").innerHTML="UNKNOWN ERROR";
				}
			}
		});
		e.preventDefault();
	});

	$('#double_switch_form').on('submit', function (e) {
		$.ajax({
			type: 'post',
			url: '/files/swap_files/time_wrapper.php',
			data: $('#double_switch_form').serialize(),
			success: function (retval) {
				document.getElementById("current_algo").innerHTML=retval;
			}
		});
		e.preventDefault();
	});	

	$('#auto_switch_form').on('submit', function (e) {
		$.ajax({
			type: 'post',
			url: '/files/swap_files/auto_wrapper.php',
			data: $('#auto_switch_form').serialize(),
			success: function (retval) {
				document.getElementById("current_algo").innerHTML=retval;
			}
		});
		e.preventDefault();
	});

	$('#load_switch_form').on('submit', function (e) {
		$.ajax({
			type: 'post',
			url: '/files/swap_files/currreqs_wrapper.php',
			data: $('#load_switch_form').serialize(),
			success: function (retval) {
				console.log(retval);
				document.getElementById("current_algo").innerHTML=retval;
			}
		});
		e.preventDefault();
	});	

	$('#load_generator_form').on('submit', function (e) {
		startProgress($('form').find('input[name="duration"]').val());
		document.getElementById("load_progress").style.display = 'block';
		$.ajax({
			type: 'post',
			url: '/scripts/generate.php',
			data: $('#load_generator_form').serialize(),
			success: function (retval) {
				if (retval=='error') {
					document.getElementById("load_progress").style.display = 'none';
				}
				else if (retval=='ignore') {
					// ignore this return					
				}
				else {
					document.getElementById("load_progress").style.display = 'none';
				}
			}
		});
		e.preventDefault();
	});

	var timer,
		perc,
		timeTotal,
		timeCount,
		cFlag;

	function updateProgress(percentage) {
		var x = (percentage/timeTotal)*100,
		    y = x.toFixed(3);
		$('#pbar_innerdiv').css("width", x + "%");
		$('#pbar_innertext').text(y + "%");
	}

	function animateUpdate() {
		if(perc < timeTotal) {
			perc++;
			updateProgress(perc);
			timer=setTimeout(animateUpdate,timeCount);
		}
	}

	function startProgress(time) {
		timeCount = 1;
		perc = 0;
		timer = 0;
		cFlag = null;
		timeTotal = time*100;
		$('#pbar_innerdiv').css("width", "0%");
		if (cFlag == undefined) {
			clearTimeout(timer);
			perc = 0;
			cFlag = true;
			animateUpdate();
		}
		else if (!cFlag) {
			cFlag = true;
			animateUpdate();
		}
		else {
			clearTimeout(timer);
			cFlag = false;
		}
	}
});
