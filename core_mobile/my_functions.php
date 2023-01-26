<?php

function getCurrentDate()
{
	ini_set('date.timezone', 'UTC');
	//error_reporting(E_ALL);
	date_default_timezone_set('UTC');
	$today = date('H:i:s');
	$system_date = date('Y-m-d H:i:s', strtotime($today) + 28800);
	return $system_date;
}
function getBusNumber($bus_id)
{
	global $mysqli_connect;

	$fetch = $mysqli_connect->query("SELECT bus_number FROM tbl_buses WHERE bus_id='$bus_id'");
	$row = $fetch->fetch_array();
	if (empty($row[0])) {
		$bus_num = 0;
	} else {
		$bus_num = $row[0];
	}
	return $bus_num;
}
function getBusRoute($bus_id)
{
	global $mysqli_connect;

	$fetch = $mysqli_connect->query("SELECT route_name FROM tbl_buses AS b, tbl_route AS r WHERE b.bus_id='$bus_id' AND b.route_id=r.route_id");
	$row = $fetch->fetch_array();
	if (empty($row[0])) {
		$bus_r = 'N/A';
	} else {
		$bus_r = $row[0];
	}
	return $bus_r;
}
