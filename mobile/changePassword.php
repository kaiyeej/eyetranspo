<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: access");
header("Access-Control-Allow-Methods: GET");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");


require_once '../../core/config.php';
$data = json_decode(file_get_contents("php://input"));
if (isset($data->user_session_id)) {
    $r_id = $mysqli_connect->real_escape_string($data->user_session_id);
    $password = $mysqli_connect->real_escape_string($data->password);
    $new_password = $mysqli_connect->real_escape_string($data->new_password);
    $confirm_password = $mysqli_connect->real_escape_string($data->confirm_password);
    $getPassword = $mysqli_connect->query("SELECT password FROM tbl_resident_profile WHERE r_id='$r_id'");
    $rowPassword = $getPassword->fetch_array();

    if ($rowPassword['password'] == md5($password)) {
        if ($new_password == $confirm_password) {
            $newPasswordConfirm = md5($confirm_password);
            $sql = $mysqli_connect->query("UPDATE `tbl_resident_profile` SET password='$newPasswordConfirm' WHERE r_id='$r_id'") or die(mysqli_error());
            if ($sql) {
                echo 1;
            } else {
                echo 0;
            }
        } else {
            echo 2;
        }
    } else {
        echo 2;
    }
}
