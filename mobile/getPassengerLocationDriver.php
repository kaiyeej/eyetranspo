<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: access");
header("Access-Control-Allow-Methods: POST");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

require_once '../core_mobile/config.php';

// //$data = json_decode(file_get_contents("php://input"));
$transaction_id = $_REQUEST['transaction_id']; // session
$response_array['array_data'] = array();
$fetch = $mysqli_connect->query("SELECT * FROM tbl_transactions WHERE transaction_id='$transaction_id' ORDER BY date_added DESC");

while ($row = $fetch->fetch_array()) {
    $response = array();
    $response["transaction_id"] = $row['transaction_id'];
    $response["starting_point"] = $row['starting_point'];
    $response["end_point"] = $row['end_point'];
    $response["user_lat"] = getUserLocation($row['user_id'])['latitude'];
    $response["user_long"] = getUserLocation($row['user_id'])['longitude'];

    // $response["u_latitude"] = getUserLocation($row['user_id'])['latitude'];
    // $response["u_longitude"] = getUserLocation($row['user_id'])['longitude'];


    array_push($response_array['array_data'], $response);
}


echo json_encode($response_array);
