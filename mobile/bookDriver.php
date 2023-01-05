<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: access");
header("Access-Control-Allow-Methods: POST");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

require_once '../core_mobile/config.php';

// //$data = json_decode(file_get_contents("php://input"));
$driver_user_id = $_REQUEST['driver_user_id'];
$user_id = $_REQUEST['user_id'];
$d_latitude = $_REQUEST['d_latitude'];
$d_longitude = $_REQUEST['d_longitude'];
$response_array['array_data'] = array();
$date = getCurrentDate();
$num = date("mdyhis", strtotime($date));
$transaction_num = 'TR-' . $num;
$response = array();
$fetch_trans = $mysqli_connect->query("SELECT COUNT(transaction_id) AS ctr FROM tbl_transactions WHERE user_id='$user_id' AND status = 'S'");
$row_trans = $fetch_trans->fetch_array();
if ($row_trans[0] == 0) {
    $result = $mysqli_connect->query("INSERT INTO `tbl_transactions` (`ref_number`, `user_id`, `driver_id`, `starting_point`, `end_point`,`status`,`date_added`) VALUES ('$transaction_num', '$user_id', '$driver_user_id', '$d_latitude', '$d_longitude','S','$date')");

    if ($result) {
        $response["response"] = 1;
        sendNotif($driver_user_id, 'Attention!', 'New book received.');
    } else {
        $response["response"] = 0;
    }
} else {
    $response["response"] = 2;
}

array_push($response_array['array_data'], $response);
echo json_encode($response_array);
