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
function getBusRoute($trip_schedule_id)
{
	global $mysqli_connect;

	$fetch = $mysqli_connect->query("SELECT route FROM tbl_trip_schedule WHERE trip_schedule_id='$trip_schedule_id'");
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

	$fetch = $mysqli_connect->query("SELECT driver_id FROM tbl_buses WHERE bus_id='$bus_id'");
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
function getTripFare($trip_schedule_id)
{
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
function getDriverDetailsUsingBusId($bus_id)
{
	global $mysqli_connect;

	$fetch = $mysqli_connect->query("SELECT * FROM tbl_buses AS b, tbl_drivers AS d WHERE b.driver_id=d.driver_id AND b.bus_id='$bus_id'");
	$row = $fetch->fetch_array();

	return $row;
}
function getTripScheduleDetails($trip_schedule_id)
{
	global $mysqli_connect;
	$fetch = $mysqli_connect->query("SELECT * FROM tbl_trip_schedule WHERE trip_schedule_id='$trip_schedule_id'");
	$row = $fetch->fetch_array();
	return $trip_schedule_id;
}
function getTransactionDetails($trip_id)
{
	global $mysqli_connect;
	$fetch = $mysqli_connect->query("SELECT * FROM tbl_transactions WHERE trip_id='$trip_id' AND `status`!='C' OR `status`!='F'");
	$row = $fetch->fetch_array();
	return $row;
}
function getUserLocation($user_id)
{
	global $mysqli_connect;

	$fetch = $mysqli_connect->query("SELECT `location` FROM tbl_users WHERE user_id='$user_id'");
	$row = $fetch->fetch_array();
	if (empty($row[0])) {
		$location = 0;
	} else {
		$location = $row[0];
	}
	return $location;
}
function getUserDestination($user_id, $trip_id)
{
	global $mysqli_connect;

	$fetch = $mysqli_connect->query("SELECT destination FROM tbl_transactions WHERE user_id='$user_id' AND trip_id='$trip_id' AND `status`!='C' OR `status`!='F'");
	$row = $fetch->fetch_array();
	if (empty($row[0])) {
		$location = 0;
	} else {
		$location = $row[0];
	}
	return $row[0];
}
function sendNotif($user_id, $title, $body)
{

	global $mysqli_connect;

	$url = 'https://fcm.googleapis.com/fcm/send';

	$getToken = $mysqli_connect->query("SELECT id_token FROM `tbl_users` WHERE `user_id` = '$user_id'");
	$idtoken = $getToken->fetch_array();

	$tokens = array($idtoken[0], "");

	//Title of the Notification.
	//$title = "Title";

	//Body of the Notification.
	//$body = "Test";

	//Creating the notification array.
	$notification = array('title' => $title, 'text' => $body);

	//This array contains, the token and the notification. The 'to' attribute stores the token.
	$arrayToSend = array('registration_ids' => $tokens, 'notification' => $notification, 'priority' => 'high');

	//Generating JSON encoded string form the above array.
	$json = json_encode($arrayToSend);
	//Setup headers:
	$headers = array();
	$headers[] = 'Content-Type: application/json';
	$headers[] = 'Authorization: key=AAAAKHerr0k:APA91bFat1gnsBdgVQm8kLKrW0EmgYakJyLZssbF8_S41WscrO_1qDWSI2JGJk4N5zu_Rc5_lyZJHOXwh9ioWYLfkOp8akdNgZzKDi9fJdgROeE_ajhnswpxDKCTIzONu9W_2D_cLbtK'; // key here

	$ch = curl_init();
	curl_setopt($ch, CURLOPT_URL, $url);
	curl_setopt($ch, CURLOPT_POST, true);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
	curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
	curl_setopt($ch, CURLOPT_POSTFIELDS, $json);
	curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

	//Send the request
	$response = curl_exec($ch);

	//Close request
	curl_close($ch);
	return $response;
}
function getUserName($id)
{
	global $mysqli_connect;
	$fetch = $mysqli_connect->query("SELECT * FROM tbl_users WHERE user_id='$id'");
	$data = $fetch->fetch_array();
	return $data['user_fname'] . " " . $data['user_lname'];
}
function getTransactionStatus($user_id)
{
	global $mysqli_connect;

	$fetch = $mysqli_connect->query("SELECT `status` FROM tbl_transactions WHERE user_id='$user_id' AND `status`!='C' OR `status`!='F'");
	$data = $fetch->fetch_array();

	return $data[0];
}
function getBusIdByConductor($user_id)
{
	global $mysqli_connect;

	$fetch = $mysqli_connect->query("SELECT bus_id FROM tbl_trips WHERE user_id='$user_id'");
	$data = $fetch->fetch_array();

	return $data[0];
}
