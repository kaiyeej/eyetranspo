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

$fetch_users = $mysqli_connect->query("SELECT * FROM tbl_transactions WHERE (`status`='F' OR `status`='C') AND user_id='$user_id'");

while ($data = $fetch_users->fetch_array()) {
    $response = array();
    $response['transaction_id'] = $data['transaction_id'];
    $response['bus_name'] = getBusNumber($data['bus_id']);
    $response['fare'] = number_format($data['fare'], 2);
    $response['status'] = $data['status'];
    $response['remarks'] = $data['remarks'];
    $response['bus_id'] = $data['bus_id'];
    $response['date_added'] =  date('F j, Y', strtotime($data['date_added']));
    $response['driver_name'] = getDriverName($data['bus_id']);
    $response['bus_route'] = getBusRoute($data['bus_id']);
    
    array_push($response_array['array_data'], $response);
}


echo json_encode($response_array);
