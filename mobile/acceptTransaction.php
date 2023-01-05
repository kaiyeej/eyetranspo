<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: access");
header("Access-Control-Allow-Methods: POST");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

require_once '../core_mobile/config.php';

// //$data = json_decode(file_get_contents("php://input"));
$transaction_id = $_REQUEST['transaction_id'];

$response_array['array_data'] = array();

$result = $mysqli_connect->query("UPDATE `tbl_transactions` SET `status`='A' WHERE  `transaction_id`='$transaction_id'");

if ($result) {
    $response["res"] = 1;
} else {
    $response["res"] = 0;
}







array_push($response_array['array_data'], $response);
echo json_encode($response_array);
