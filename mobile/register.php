<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: access");
header("Access-Control-Allow-Methods: POST");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

require_once '../core_mobile/config.php';

$fname = $_REQUEST['fname'];
$mname = $_REQUEST['mname'];
$lname = $_REQUEST['lname'];
$contactNumber = $_REQUEST['contactNumber'];
$username = $_REQUEST['username'];
$password = $_REQUEST['password'];
$date = getCurrentDate();
$response_array['array_data'] = array();
if (isset($username) && isset($password)) {

	$response = array();
	$fetch_rows = $mysqli_connect->query("SELECT COUNT(user_id) as counter from tbl_users WHERE user_fname='$fname' AND user_mname='$mname' AND user_lname='$lname'");
	$row = $fetch_rows->fetch_array();

	if ($row['counter'] == 0) {

		$sql = $mysqli_connect->query("INSERT INTO tbl_users (`user_fname`, `user_mname`, `user_lname`, `user_contact_number`, `user_category`, `username`, `password`, `date_added`) VALUES ('$fname','$mname','$lname','$contactNumber','U','$username',md5('$password'),'$date')");

		if ($sql) {
			$response["res"] =  $mysqli_connect->insert_id;
		} else {
			$response["res"] = 0;
		}
	} else {
		// user not in database
		$response["res"] = -2;
	}
}
array_push($response_array['array_data'], $response);
echo json_encode($response_array);
