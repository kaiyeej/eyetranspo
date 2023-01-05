<?php
require_once '../core/config.php';

if(isset($_POST['userlogin'])){

	/*$host 	  = host;
	$username = username;
	$password = password;
	$database = database;
	$user_connect = new mysqli($host, $username, $password, $database);

	$userlogin = $_POST['userlogin'];
	$userpassword = $_POST['userpassword'];*/

	global $mysqli_connect;

	$userlogin = $mysqli_connect->real_escape_string($_POST['userlogin']);
	$userpassword = $mysqli_connect->real_escape_string($_POST['userpassword']);
	

	$query = "SELECT * FROM ";
	$query .= table;
	$query .=" WHERE username = '$userlogin' AND password = md5('$userpassword')";

	$result = $mysqli_connect->query($query) or die (mysqli_error());

	if($result->num_rows == 1){


		$row = $result->fetch_assoc();
		$_SESSION['cmi_user_id'] = $row['user_id'];
		$_SESSION['username'] = $row['username'];
		$_SESSION['user_fname'] = $row['user_fname'];
		$_SESSION['user_mname'] = $row['user_mname'];
		$_SESSION['user_lname'] = $row['user_lname'];
		$_SESSION['user_category'] = $row['user_category'];
		
		echo 1;
		
		//header("Location:../index.php");
		
		exit;

		$mysqli_connect->close();
	}else {
		$_SESSION['error']  = error_message;
		echo 0;
		//header("Location:../auth/login.php");
		exit;
	}
}
