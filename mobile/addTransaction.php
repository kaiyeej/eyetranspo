<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: access");
header("Access-Control-Allow-Methods: POST");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

require_once '../core_mobile/config.php';

$bus_id = $_REQUEST['bus_id'];
$user_id = $_REQUEST['user_id'];
$transaction_id = $_REQUEST['transaction_id'];

$response_array['array_data'] = array();
$fetch = $mysqli_connect->query("SELECT * FROM tbl_trips where headings='$headings'");



echo json_encode($response_array);
