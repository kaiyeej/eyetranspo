<?php
require_once '../core_mobile/config.php';
$url = 'https://fcm.googleapis.com/fcm/send';

$getToken = $mysqli_connect->query("SELECT id_token FROM `tbl_users` WHERE `user_id` = '11'");
$idtoken = $getToken->fetch_array();

$tokens = array($idtoken[0], "");

// echo $idtoken[0];
//Title of the Notification.
$title = "Title";

//Body of the Notification.
$body = "Body";

//Creating the notification array.
$notification = array('title' => $title, 'text' => $body);

//This array contains, the token and the notification. The 'to' attribute stores the token.
$arrayToSend = array('registration_ids' => $tokens, 'notification' => $notification, 'priority' => 'high');

//Generating JSON encoded string form the above array.
$json = json_encode($arrayToSend);
//Setup headers:
$headers = array();
$headers[] = 'Content-Type: application/json';
$headers[] = 'Authorization: key=AAAAubbNF2A:APA91bG83EJ3MvwKZVr8MEfUuC-Fase7yq1KLZZx7uMD8Gz2Oe24MCISay1fb6ESYqrfWB0BdGsog78kS7Tls_YcExKjbOb7i_1vVprxDGhRpyqOBNIG6oXMJEgFr3lX5BsC8im7h4ss'; // key here

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
