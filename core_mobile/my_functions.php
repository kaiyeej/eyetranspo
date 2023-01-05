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
function getRefNumTransaction()
{
	global $mysqli_connect;

	$fetch = $mysqli_connect->query("SELECT ref_number FROM tbl_transactions");
	$row = $fetch->fetch_array();
	if (empty($row[0])) {
		$ref = 0;
	} else {
		$ref = $row[0];
	}
	return $ref;
}
function getTransactionStatus($user_id, $driver_id)
{
	global $mysqli_connect;
	$fetch = $mysqli_connect->query("SELECT * FROM tbl_transactions WHERE user_id='$user_id' AND driver_id='$driver_id' ORDER BY date_added DESC");
	$row = $fetch->fetch_array();
	if ($fetch->num_rows > 0) {
		$status = $row['status'];
	} else {
		$status = "B";
	}
	return $status;
}
function getUserName($id)
{
	global $mysqli_connect;
	$fetch = $mysqli_connect->query("SELECT * FROM tbl_users WHERE user_id='$id'");
	$data = $fetch->fetch_array();
	return $data['user_fname'] . " " . $data['user_lname'];
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
	$headers[] = 'Authorization: key=AAAAubbNF2A:APA91bG83EJ3MvwKZVr8MEfUuC-Fase7yq1KLZZx7uMD8Gz2Oe24MCISay1fb6ESYqrfWB0BdGsog78kS7Tls_YcExKjbOb7i_1vVprxDGhRpyqOBNIG6oXMJEgFr3lX5BsC8im7h4ss'; // key here

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
function getUserLocation($id)
{
	global $mysqli_connect;
	$fetch = $mysqli_connect->query("SELECT latitude,longitude FROM tbl_users WHERE user_id='$id'");
	$data = $fetch->fetch_array();
	return $data;
}
function checkDriverRating($transaction_id)
{
	global $mysqli_connect;
	$fetch = $mysqli_connect->query("SELECT * FROM tbl_ratings WHERE transaction_id='$transaction_id'");
	// $data = $fetch->fetch_array();
	$count = $fetch->num_rows;

	return $count;
}

function getRatingRemarks($transaction_id)
{
	global $mysqli_connect;
	$fetch = $mysqli_connect->query("SELECT remarks FROM tbl_ratings WHERE transaction_id='$transaction_id'");
	// $data = $fetch->fetch_array();
	$data = $fetch->fetch_array();
	if ($fetch->num_rows > 0) {
		$result = $data[0];
	} else {
		$result = 0;
	}
	return $result;
}
function getRatingFunc($driver_id)
{
	global $mysqli_connect;
	$fetch = $mysqli_connect->query("SELECT (SUM(r.rating) / COUNT(r.rating)) AS total_rating  FROM tbl_transactions AS tr, tbl_ratings AS r WHERE tr.driver_id='$driver_id' AND r.transaction_id=tr.transaction_id");
	$data = $fetch->fetch_array();

	if ($data['total_rating'] == "" || $data['total_rating'] == NULL) {
		$result = 0;
	} else {
		$result = number_format($data['total_rating'], 1);
	}
	return $result;
}

function getDistance($gpsLat, $gpsLong, $userLat, $userLong, $userRadius)
{
	$isInsideRadius = 0;
	$theta = $userLong - $gpsLong;
	$distance = sin(deg2rad($userLat)) * sin(deg2rad($gpsLat)) +  cos(deg2rad($userLat)) * cos(deg2rad($gpsLat)) * cos(deg2rad($theta));

	$distance = acos($distance);
	$distance = rad2deg($distance);

	// Miles = ($distance * 60 * 1.1515)
	// Kilometers = 1.609344
	$distanceInKm = $distance * 60 * 1.1515 * 1.609344;
	if ($distanceInKm < $userRadius) {
		// inside the defaultRadius
		$isInsideRadius = 1;
	}

	return $isInsideRadius;
}
