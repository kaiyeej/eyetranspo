<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: access");
header("Access-Control-Allow-Methods: POST");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

require_once '../core_mobile/config.php';

// //$data = json_decode(file_get_contents("php://input"));
$user_id = $_REQUEST['user_id'];

$response_array['array_data'] = array();

$fetch_users = $mysqli_connect->query("SELECT user_fname, user_mname, user_lname FROM tbl_users WHERE user_id='$user_id'");
$data = $fetch_users->fetch_array();

$response = array();

$response["fullname"] = $data['user_fname'] . " " . $data['user_lname'];
$response["user_rating"] = getRatingFunc($user_id);

array_push($response_array['array_data'], $response);
echo json_encode($response_array);
