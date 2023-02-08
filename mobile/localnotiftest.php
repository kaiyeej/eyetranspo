<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: access");
header("Access-Control-Allow-Methods: GET");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");


require_once '../core_mobile/config.php';
$url = 'https://fcm.googleapis.com/fcm/send';

$getToken = $mysqli_connect->query("SELECT id_token FROM `tbl_users` WHERE `user_id` = '4'");
$idtoken = $getToken->fetch_array();

$tokens = array('c2UvhMVrSu-868HIDuPFHq:APA91bE5seluqieqTHUabs-7pvCDMisiTzI1kcvgF_bhjzbba09GBrY-eYGhh1FTIanBo_ymG2konyeVbDwODmjpkIcmUaEx2rZEUGwrEAykuNbrkfEUPTTc6yNXS2_deXSygSv-96Iz', "");

//Title of the Notification.
$title = "Title";

//Body of the Notification.
$body = "Test";

//Creating the notification array.
$notification = array('title' => $title, 'text' => $body);

//This array contains, the token and the notification. The 'to' attribute stores the token.
$arrayToSend = array('registration_ids' => $tokens, 'notification' => $notification, 'priority' => 'high');

//Generating JSON encoded string form the above array.
$json = json_encode($arrayToSend);
//Setup headers:
$headers = array();
$headers[] = 'Content-Type: application/json';
$headers[] = 'Authorization: key=AAAAKHerr0k:APA91bFat1gnsBdgVQm8kLKrW0EmgYakJyLZssbF8_S41WscrO_1qDWSI2JGJk4N5zu_Rc5_lyZJHOXwh9ioWYLfkOp8akdNgZzKDi9fJdgROeE_ajhnswpxDKCTIzONu9W_2D_cLbtK'; // key here

$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $url);
curl_setopt($ch, CURLOPT_POST, true);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
curl_setopt($ch, CURLOPT_POSTFIELDS, $json);
curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

//Send the request
$response = curl_exec($ch);

//Close request
curl_close($ch);

echo $response;
