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

$fetch_users = $mysqli_connect->query("SELECT * FROM tbl_transactions WHERE `driver_id`='$user_id' AND (STATUS != 'F' OR STATUS!='C')");

while ($data = $fetch_users->fetch_array()) {
    $response = array();
    $response['transaction_id'] = $data['transaction_id'];
    $response['driver_name'] = getUserName($data['user_id']);
    $response['amount'] = number_format($data['amount'], 2);
    $response['status'] = $data['status'];
    $response['remarks'] = $data['remarks'];
    $response['date_added'] =  date('F j, Y', strtotime($data['date_added']));
    array_push($response_array['array_data'], $response);
}


echo json_encode($response_array);
