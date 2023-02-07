<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: access");
header("Access-Control-Allow-Methods: POST");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

require_once '../core_mobile/config.php';
$response_array['array_data'] = array();
$bus_id = $_REQUEST['bus_id'];
$user_id = $_REQUEST['user_id'];
$trip_id = $_REQUEST['trip_id'];
$fare = getTripFare($_REQUEST['trip_schedule_id']);

$response = array();
$fetch = $mysqli_connect->query("INSERT INTO `tbl_transactions` (`bus_id`, `trip_id`, `user_id`, `fare`, `status`) VALUES ('$bus_id', '$trip_id', '$user_id', '$fare', 'P')");
if ($fetch) {
    $response["response"] = 1;
} else {
    $fetch["response"] = 0;
}


array_push($response_array['array_data'], $response);
echo json_encode($response_array);
