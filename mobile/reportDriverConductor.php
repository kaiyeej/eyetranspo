<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: access");
header("Access-Control-Allow-Methods: GET");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");


require_once '../../core/config.php';
$bus_id = $_REQUEST['bus_id'];
$remarks = $_REQUEST['remarks'];
$response_array['array_data'] = array();

$response = array();
$fetch_trans = $mysqli_connect->query("UPDATE `tbl_transactions` SET `remarks`='$remarks' WHERE bus_id='$bus_id'");

if ($fetch_trans) {
    $response["response"] = 1;
} else {
    $response["response"] = 0;
}


array_push($response_array['array_data'], $response);
echo json_encode($response_array);



