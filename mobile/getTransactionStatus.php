<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: access");
header("Access-Control-Allow-Methods: POST");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

require_once '../core_mobile/config.php';

// //$data = json_decode(file_get_contents("php://input"));
$user_id = $_REQUEST['user_id'];
$response_array['array_data'] = array();

$response = array();
$fetch_trans = $mysqli_connect->query("SELECT * FROM tbl_transactions WHERE user_id='$user_id' AND `status` != 'C' OR `status` != 'F'");
$row_trans = $fetch_trans->fetch_array();
$count = $fetch_trans->num_rows;
if ($count > 0) {
    $response["status"] = 1;
    $response["user_id"] = $row_trans['user_id'];
    $response["bus_id"] = $row_trans['bus_id'];
    $response["trip_id"] = $row_trans['trip_id'];
} else {
    $response["status"] = 0;
}


array_push($response_array['array_data'], $response);
echo json_encode($response_array);
