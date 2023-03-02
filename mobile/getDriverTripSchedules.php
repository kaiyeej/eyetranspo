<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: access");
header("Access-Control-Allow-Methods: POST");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

require_once '../core_mobile/config.php';

$user_id = $_REQUEST['user_id'];
$response_array['array_data'] = array();
$fetch = $mysqli_connect->query("SELECT * FROM tbl_trips where user_id='$user_id' AND status!='A'");
while ($row = $fetch->fetch_array()) {
    $response = array();

    $response["trip_id"] = $row['trip_id'];
    $response["bus_id"] = $row['bus_id'];
    $response["bus_number"] = getBusNumber($row['bus_id']);
    $response["trip_schedule_id"] = $row['trip_schedule_id'];
    $response["date_departed"] = $row['date_departed'];
    $response["date_arrived"] = $row['date_arrived'];
    $response["bus_route"] = getBusRoute($row['trip_schedule_id']);
    array_push($response_array['array_data'], $response);
}
echo json_encode($response_array);
