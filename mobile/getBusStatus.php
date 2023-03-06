<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: access");
header("Access-Control-Allow-Methods: POST");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

require_once '../core_mobile/config.php';

$trip_id = $_REQUEST['trip_id'];
$response_array['array_data'] = array();
$response = array();
$fetch = $mysqli_connect->query("SELECT t.`status` FROM tbl_trips AS t, tbl_trip_schedule AS ts WHERE t.trip_schedule_id=ts.trip_schedule_id AND t.trip_id='$trip_id'");
$row = $fetch->fetch_array();

$response["trip_status"] = $row[0];


array_push($response_array['array_data'], $response);

echo json_encode($response_array);
