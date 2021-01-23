<?php
session_start();
require("config/main_function.php");


// $secure = "rD9PZrWHTA54lQkt2tO3xcDh0HcBLCrB";
$connection = connectDB();

if($connection){

	$username = mysqli_real_escape_string($connection, $_POST['username']);
	$password = mysqli_real_escape_string($connection, $_POST['password']);


	if(strlen($username) > 0 && strlen($password) > 0){
			
		$sql = "SELECT * FROM tbl_member WHERE
		username = '$username'";
		$rs = mysqli_query($connection, $sql) or die($connection->error);
		$check = mysqli_num_rows($rs);
		if($check == 1){
			$row = mysqli_fetch_array($rs);
			$password = md5($password);
			/*  1  secure_text , secure_pointer  */
			// $secure_text = $row['secure_text'];
			// $secure_pointer = $row['secure_pointer'];
			// $mypassword = stringInsert($password);
			// $my_password = md5($mypassword);

			if($password == $row['password']){   // Login สำเร็จ //
				$_SESSION['member_id'] = $row['member_id'];
				$_SESSION['username'] = $row['username'];

				$result = 1;
			}
			else{  // รหัสผ่านไม่ถูกต้อง //

				$result = 0;

			}
		} else { //user หรือ สิทิ์ไม่ถูก
			$result = 0;
		}
	} 
	else { // input null value

		$result = 0;
	}
}
else{

	$result = 0;
}

$arr['result'] = $result;
echo json_encode($arr);

?>