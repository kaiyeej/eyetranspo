<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: access");
header("Access-Control-Allow-Methods: POST");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

require_once '../core_mobile/config.php';

// //$data = json_decode(file_get_contents("php://input"));
$user_id = $_REQUEST['user_id']; // session
$driver_user_id = $_REQUEST['driver_user_id'];
$response_array['array_data'] = array();
$fetch = $mysqli_connect->query("SELECT * FROM tbl_users WHERE category='D' AND latitude != 0 AND longitude != 0 AND `status`='0' and user_id='$driver_user_id'");
while ($row = $fetch->fetch_array()) {
	$response = array();
	$response["user_id"] = $row['user_id'];
	$response['fullname'] = $row['user_fname'] . " " . $row['user_lname'];
	$response["ratings"] = getRatingFunc($row['user_id']);
	$response['image'] = "https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcRBwgu1A5zgPSvfE83nurkuzNEoXs9DMNr8Ww&usqp=CAU";
	$response["latitude"] = $row['latitude'];
	$response["longitude"] = $row['longitude'];
	$response["session_id"] = $user_id;
	$response["status"] = getTransactionStatus($user_id, $row['user_id']);



	array_push($response_array['array_data'], $response);
}


echo json_encode($response_array);
