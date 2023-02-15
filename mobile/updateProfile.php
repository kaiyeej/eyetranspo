<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: access");
header("Access-Control-Allow-Methods: GET");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

require_once '../core_mobile/config.php';

$user_id = $_REQUEST['user_id'];
$user_fname = $_REQUEST['fname'];
$user_mname = $_REQUEST['mname'];
$user_lname = $_REQUEST['lname'];
$username = $_REQUEST['username'];
$password = $_REQUEST['password'];
$response_array['array_data'] = array();


if ($password == "") {
    $password_query = "";
} else {
    $password_query = ",`password`=md5('$password')";
}

$result = $mysqli_connect->query("UPDATE `tbl_users` SET `user_fname`='$user_fname',`user_mname`='$user_mname',`user_lname`='$user_lname',`username`='$username' $password_query  WHERE `user_id`='$user_id'");

if ($result) {
    $response["res"] = 1;
} else {
    $response["res"] = 0;
}
// $response["res"] = $user_id;
array_push($response_array['array_data'], $response);
echo json_encode($response_array);
