<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: access");
header("Access-Control-Allow-Methods: POST");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

require_once '../core_mobile/config.php';

// //$data = json_decode(file_get_contents("php://input"));
$user_id = $_REQUEST['user_id'];
$driver_user_id = $_REQUEST['driver_user_id'];
$response_array['array_data'] = array();

$response = array();
$fetch_trans = $mysqli_connect->query("SELECT * FROM tbl_transactions WHERE driver_id='$driver_user_id' AND user_id='$user_id' AND status != 'F' ORDER BY date_added DESC");
$row_trans = $fetch_trans->fetch_array();


$response["response"] = $row_trans['status'];
array_push($response_array['array_data'], $response);
echo json_encode($response_array);
