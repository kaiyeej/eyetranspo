<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: access");
header("Access-Control-Allow-Methods: POST");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

require_once '../core_mobile/config.php';

$bus_id = $_REQUEST['bus_id'];
$response_array['array_data'] = array();
$fetch = $mysqli_connect->query("SELECT * FROM tbl_transactions WHERE bus_id='$bus_id' AND `status`!='C' AND `status`!='F'");
while ($row = $fetch->fetch_array()) {
    $response = array();
    $response["transaction_id"] = $row['transaction_id'];
    $response["trip_id"] = $row['trip_id'];
    $response["bus_id"] = $row['bus_id'];
    $response["passenger_id"] = $row['user_id'];
    $response["passenger_name"] = getUserName($row['user_id']);
    $response["fare"] = $row['fare'];
    $response["remarks"] = $row['remarks'];
    $response["status"] = $row['status'];
    $response["date_added"] = $row['date_added'];
    $response["destination"] = $row['destination'];
    $response["passenger_loc"] = getUserLocation($row['user_id']);

    array_push($response_array['array_data'], $response);
}
echo json_encode($response_array);
