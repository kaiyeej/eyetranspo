<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: access");
header("Access-Control-Allow-Methods: POST");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

require_once '../core_mobile/config.php';

$trip_id = $_REQUEST['trip_id'];
// $user_id = $_REQUEST['user_id'];
$response_array['array_data'] = array();
$fetch = $mysqli_connect->query("SELECT * FROM tbl_trips where trip_id='$trip_id'");
while ($row = $fetch->fetch_array()) {
    $response = array();
    $response['status'] = getTransactionStatus(getTransactionDetails($row['trip_id'])['user_id']);
    array_push($response_array['array_data'], $response);
}
echo json_encode($response_array);
