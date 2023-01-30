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
function getBusDriverId($bus_id)
{
	global $mysqli_connect;

	$fetch = $mysqli_connect->query("SELECT driver_id FROM tbl_buses WHERE bus_id='4'");
	$row = $fetch->fetch_array();
	if (empty($row[0])) {
		$driver_id = 0;
	} else {
		$driver_id = $row[0];
	}
	return $driver_id;
}
function getDriverName($driver_id)
{
	global $mysqli_connect;

	$fetch = $mysqli_connect->query("SELECT driver_fname, driver_mname, driver_lname, FROM tbl_drivers WHERE driver_id='$driver_id'");
	$row = $fetch->fetch_array();

	return $row;
}
function getTripFare($trip_schedule_id){
	global $mysqli_connect;

	$fetch = $mysqli_connect->query("SELECT trip_schedule_fare FROM tbl_trip_schedule WHERE trip_schedule_id='$trip_schedule_id'");
	$row = $fetch->fetch_array();
	if (empty($row[0])) {
		$data = 0;
	} else {
		$data = $row[0];
	}
	return $data;
}
