<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: access");
header("Access-Control-Allow-Methods: POST");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

require_once '../core_mobile/config.php';

$bus_number = $_REQUEST['bus_number'];
$response_array['array_data'] = array();
$fetch = $mysqli_connect->query("SELECT * FROM tbl_buses WHERE bus_number='$bus_number'");
while ($row = $fetch->fetch_array()) {
    $response = array();

    $response["bus_id"] = $row['bus_id'];
    $response["bus_number"] = $row['bus_number'];
    $response["driver_name"] = getDriverDetailsUsingBusId($row['bus_id'])['driver_fname']." ".getDriverDetailsUsingBusId($row['bus_id'])['driver_lname'];
    $response['bus_route'] = getBusRoute($row['bus_id']);  
    $response["bus_plate_number"] = $row['bus_plate_number'];
    $response["bus_operator"] = $row['bus_operator'];
    $response["bus_max_capacity"] = $row['bus_max_capacity'];
    array_push($response_array['array_data'], $response);
}
echo json_encode($response_array);
