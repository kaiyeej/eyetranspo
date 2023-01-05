<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: access");
header("Access-Control-Allow-Methods: POST");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

require_once '../core_mobile/config.php';


$user_id = $_REQUEST['user_id']; // session
$lat = $_REQUEST['latitude'];
$long = $_REQUEST['longitude'];
$response_array['array_data'] = array();



$result = $mysqli_connect->query("UPDATE `tbl_users` SET `latitude`='$lat',`longitude`='$long' WHERE  `user_id`='$user_id'");

if ($result) {
    $response['response'] = 1;
} else {
    $response['response'] = 0;
}


array_push($response_array['array_data'], $response);
echo json_encode($response_array);
