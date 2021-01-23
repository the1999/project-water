<?php
	session_start();
	include('../../../config/main_function.php');
	// $secure = "OMP?JFC/p|og^JP";
	$connection = connectDB();

	$key_value = $_POST['key_value'];
	$table_name = $_POST['table_name'];
	$key_name = $_POST['key_name'];

	$sql = "SELECT status FROM $table_name WHERE $key_name = '$key_value';";
	$rs = mysqli_query($connection, $sql);
	$row = mysqli_fetch_array($rs);

	if($row['status'] == "3"){

		$new_status = "2";
	}
	else{

		$new_status = "3";
	}

	$sql = "UPDATE $table_name SET status = '$new_status' WHERE $key_name = '$key_value';";
	$rs = mysqli_query($connection,$sql);

	$arr['result'] = 1;

	echo json_encode($arr);
?>
