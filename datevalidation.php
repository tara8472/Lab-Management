<?php

//Function if the date is in the future
function check_date($date_to_validate) {

	//Convert $date_to_validate to a datetime object
	$date_to_validate = date_create(substr($date_to_validate,0,10));

	//Get today's date and convert it to a datetime object
	$todays_date = date("Y-m-d");
	$todays_date = date_create($todays_date);

	//Check if date entered is in the future
	if ($date_to_validate > $todays_date){
		return "Date cannot be in the future.";
	}

	//Check if the date is more than a week in the past
	$one_week_earlier = $todays_date;
	date_sub($one_week_earlier,date_interval_create_from_date_string(" 7 days"));

	if ($date_to_validate < $one_week_earlier){
		return "Date cannot be earlier than one week in the past.";
	}
	else{
		return "";
	}

}

function compare_ret_borr_dates($date_ret, $date_borr){

	//Convert dates to a datetime object
	$date_ret = date_create(substr($date_ret,0,10));
	$date_borr = date_create(substr($date_borr,0,10));

//	return date_format ($date_ret, "Y-m-d");
	
//	return date_format ($date_borr, "Y-m-d");

	if ($date_ret < $date_borr){
		return "Return date cannot be before date borrowed.";
	}
	else{
		return "";
	}


}
