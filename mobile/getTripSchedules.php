<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: access");
header("Access-Control-Allow-Methods: POST");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

require_once '../core_mobile/config.php';

$cardinal_directions = $_REQUEST['cardinal_directions'];
$response_array['array_data'] = array();
$fetch = $mysqli_connect->query("SELECT * FROM tbl_trips AS t, tbl_trip_schedule AS ts WHERE t.trip_schedule_id=ts.trip_schedule_id AND ts.route='$cardinal_directions'");
while ($row = $fetch->fetch_array()) {
    $response = array();

    $response["trip_id"] = $row['trip_id'];
    $response["bus_id"] = $row['bus_id'];
    $response["bus_number"] = getBusNumber($row['bus_id']);
    $response["trip_schedule_id"] = $row['trip_schedule_id'];
    $response["date_departed"] = $row['date_departed'];
    $response["date_arrived"] = $row['date_arrived'];
    $response["headings"] = $row['headings'];
    $response["bus_route"] = getBusRoute($row['trip_schedule_id']);
    $response["conductor_id"] = $row['user_id'];

    array_push($response_array['array_data'], $response);
}
echo json_encode($response_array);
