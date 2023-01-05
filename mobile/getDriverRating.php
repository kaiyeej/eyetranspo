<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: access");
header("Access-Control-Allow-Methods: POST");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

require_once '../core_mobile/config.php';

// //$data = json_decode(file_get_contents("php://input"));
$driver_id = $_REQUEST['driver_id'];
$response_array['array_data'] = array();
$fetch = $mysqli_connect->query("SELECT (SUM(r.rating) / COUNT(r.rating)) AS total_rating  FROM tbl_transactions AS tr, tbl_ratings AS r WHERE tr.driver_id='$driver_id' AND r.transaction_id=tr.transaction_id");
$data = $fetch->fetch_array();
$response = array();
if ($data['total_rating'] == "" || $data['total_rating'] == NULL) {
    $response["res"] = 0;
} else {
    $response["res"] = number_format($data['total_rating'], 1);
}

array_push($response_array['array_data'], $response);



echo json_encode($response_array);
