<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: access");
header("Access-Control-Allow-Methods: GET");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");


require_once '../core_mobile/config.php';
$userd_id = $_REQUEST['user_id'];
$fname = $_REQUEST['fname'];
$mname = $_REQUEST['mname'];
$lname = $_REQUEST['lname'];
$username = $_REQUEST['username'];
$password = $_REQUEST['password'];
$response_array['array_data'] = array();

$response = array();
$fetch_trans = $mysqli_connect->query("UPDATE `tbl_users` SET `user_fname`='$fname', `user_mname`='$mname', `user_lname`='$l
name',`username`='$username',`password`=md5('$password') WHERE user_id='$user_id'");

if ($fetch_trans) {
    $response["response"] = 1;
} else {
    $response["response"] = 0;
}


array_push($response_array['array_data'], $response);
echo json_encode($response_array);
