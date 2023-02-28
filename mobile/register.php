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
$name = $_FILES['file']['name'];
$type = $_FILES['file']['type'];
$size = $_FILES['file']['size'];
$response_array['array_data'] = array();

if (isset($username) && isset($password)) {

	$response = array();
	$fetch_rows = $mysqli_connect->query("SELECT COUNT(user_id) as counter from tbl_users WHERE user_fname='$fname' AND user_mname='$mname' AND user_lname='$lname' AND username='$username'");
	$row = $fetch_rows->fetch_array();

	if ($row['counter'] == 0) {
		$img_name = $name . '.jpg';
		$directory = "../assets/pwd_id_images/" . $name . '.jpg';

		// compressImage($_FILES['file']['tmp_name'], $directory, 50);

		$sql = $mysqli_connect->query("INSERT INTO tbl_users (`user_fname`, `user_mname`, `user_lname`, `user_contact_number`,`user_img`, `user_category`, `username`, `password`, `date_added`) VALUES ('$fname','$mname','$lname','$contactNumber','$img_name','U','$username',md5('$password'),'$date')");

		if ($sql) {
			if (move_uploaded_file($_FILES["file"]["tmp_name"], $directory)) {
				$response["res"] =  $mysqli_connect->insert_id;
			} else {
				$response["res"] = 0;
			}
			// $response["res"] =  $mysqli_connect->insert_id;
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
