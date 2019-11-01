<?php
function abcoffee_dates_to_string($the_date){
	if(pll_current_language() == 'pt') {
		setlocale(LC_TIME, 'pt_PT', 'pt_PT.utf-8', 'pt_PT.utf-8', 'portuguese');
		date_default_timezone_set('Europe/Lisbon');
	}
	$date_arr = explode(" ", $the_date);
	$date = strtotime($date_arr[0]);
	$days = [];
	$months = [];
	$years = [];
	foreach ($date_arr as $this_date) {
		if(validateDate($this_date)){
			$day = date('d', strtotime($this_date));
			$month = strftime('%B', strtotime($this_date));
			$year = date('Y', strtotime($this_date));
			 
			array_push($days, $day);
			array_push($months, $month);
			array_push($years, $year);
		}else{
			$has_valid_date = false;
		}
	}
	$written_date_part1 = implode("-", $days);
	$written_date_part2 = implode("-", array_unique($months));
	$written_date_part3 = implode("-", array_unique($years));

	return $written_date_part1 . " " . $written_date_part2 . " " . $written_date_part3;
}
?>