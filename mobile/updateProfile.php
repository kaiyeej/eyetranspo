<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: access");
header("Access-Control-Allow-Methods: GET");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");


require_once '../../core/config.php';
$data = json_decode(file_get_contents("php://input"));
if (isset($data->r_id)) {
    $r_id = $mysqli_connect->real_escape_string($data->r_id);
    $r_fname = $mysqli_connect->real_escape_string($data->r_fname);
    $r_mname = $mysqli_connect->real_escape_string($data->r_mname);
    $r_lname = $mysqli_connect->real_escape_string($data->r_lname);
    $r_suffix = $mysqli_connect->real_escape_string($data->r_suffix);
    $r_gender = $mysqli_connect->real_escape_string($data->r_gender);
    $r_birthdate = $mysqli_connect->real_escape_string($data->r_birthdate);
    $r_contact_num = $mysqli_connect->real_escape_string($data->r_contact_num);
    $r_civil_status = $mysqli_connect->real_escape_string($data->r_civil_status);
    $r_region = $mysqli_connect->real_escape_string($data->r_region);
    $r_province = $mysqli_connect->real_escape_string($data->r_province);
    $r_city = $mysqli_connect->real_escape_string($data->r_city);
    $r_barangay = $mysqli_connect->real_escape_string($data->r_barangay);
    $r_occupation = $mysqli_connect->real_escape_string($data->r_occupation);
    $r_name_of_employer = $mysqli_connect->real_escape_string($data->r_name_of_employer);
    $r_priority_group = $mysqli_connect->real_escape_string($data->r_priority_group);
    $r_comorbidities = $mysqli_connect->real_escape_string($data->r_comorbidities);
    $r_allergy = $mysqli_connect->real_escape_string($data->r_allergy);
    $username = $mysqli_connect->real_escape_string($data->username);
    $password = $mysqli_connect->real_escape_string($data->password);
    $new_password = $mysqli_connect->real_escape_string($data->new_password);
    $confirm_password = $mysqli_connect->real_escape_string($data->confirm_password);


    if ($password == "") {
        $sql = $mysqli_connect->query("UPDATE `tbl_resident_profile` SET `r_fname`='$r_fname',`r_mname`='$r_mname',`r_lname`='$r_lname',`r_suffix`='$r_suffix',`r_gender`='$r_gender',r_birthdate='$r_birthdate',`r_contact_num`='$r_contact_num',r_civil_status='$r_civil_status',r_region='$r_region',r_province='$r_province',r_city='$r_city',r_barangay='$r_barangay',r_occupation='$r_occupation',r_name_of_employer='$r_name_of_employer',r_priority_group='$r_priority_group',r_allergy='$r_allergy',r_comorbidities='$r_comorbidities',username='$username'  WHERE r_id='$r_id'") or die(mysqli_error());
        if ($sql) {
            echo 1;
        } else {
            echo 0;
        }
    } else {
        $getPassword = $mysqli_connect->query("SELECT password FROM tbl_resident_profile WHERE r_id='8'");
        $rowPassword = $getPassword->fetch_array();
        if ($rowPassword['password'] == md5($password)) {
            if ($new_password == $confirm_password) {
                $newPasswordConfirm = md5($confirm_password);
                $sql = $mysqli_connect->query("UPDATE `tbl_resident_profile` SET `r_fname`='$r_fname',`r_mname`='$r_mname',`r_lname`='$r_lname',`r_suffix`='$r_suffix',`r_gender`='$r_gender',r_birthdate='$r_birthdate',`r_contact_num`='$r_contact_num',r_civil_status='$r_civil_status',r_region='$r_region',r_province='$r_province',r_city='$r_city',r_barangay='$r_barangay',r_occupation='$r_occupation',r_name_of_employer='$r_name_of_employer',r_priority_group='$r_priority_group',r_allergy='$r_allergy',r_comorbidities='$r_comorbidities',username='$username',password='$newPasswordConfirm'  WHERE r_id='$r_id'") or die(mysqli_error());
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
}
