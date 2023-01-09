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

			// date_default_timezone_set('Asia/Manila');
			// $date = getCurrentDate();
			// $time = date('H:i:s');
			// $user_name = "Ginery";
			// $messages = "hello world";
			// $text = strval($messages . " | FROM VISITOR: " . $user_name);
			// $shortcode = "8707";
			// $access_token = "D3kL1sR67b0r5Kuqb1aueLvz4yruC_4E4j5HtN9dmmI";
			// $address = '09955965031'; // phone number
			// $clientCorrelator = "264801";
			// $message = $text;


			// $curl = curl_init();
			// curl_setopt_array($curl, array(
			// 	CURLOPT_URL => "https://devapi.globelabs.com.ph/smsmessaging/v1/outbound/" . $shortcode . "/requests?access_token=" . $access_token,
			// 	CURLOPT_RETURNTRANSFER => true,
			// 	CURLOPT_ENCODING => "",
			// 	CURLOPT_MAXREDIRS => 10,
			// 	CURLOPT_TIMEOUT => 30,
			// 	CURLOPT_SSL_VERIFYPEER => false,
			// 	CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
			// 	CURLOPT_CUSTOMREQUEST => "POST",
			// 	CURLOPT_POSTFIELDS => "{\"outboundSMSMessageRequest\": { \"clientCorrelator\": \"" . $clientCorrelator . "\", \"senderAddress\": \"" . $shortcode . "\", \"outboundSMSTextMessage\": {\"message\": \"" . $message . "\"}, \"address\": \"" . $address . "\" } }",
			// 	CURLOPT_HTTPHEADER => array(
			// 		"Content-Type: application/json"
			// 	),
			// ));
			// $response = curl_exec($curl);
			// $err = curl_error($curl);
			// curl_close($curl);
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
