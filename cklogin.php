<?php
session_start();
include 'config/main_function.php';
$secure = "rD9PZrWHTA54lQkt2tO3xcDh0HcBLCrB";
$connection = connectDB($secure);

$username = mysqli_real_escape_string($connection,$_POST['username']);
$password = md5(mysqli_real_escape_string($connection, $_POST['password']));

$sql1 = "SELECT * FROM tbl_user WHERE username = '$username' ";
$rs1 = mysqli_query($connection,$sql1);
$row1 = mysqli_fetch_array($rs1);

$secure_pointer = $row1['secure_pointer'];
$secure_text = $row1['secure_text'];

$password = substr_replace($password, $secure_text, $secure_pointer, 0);
$password = md5($password);

$sql = "SELECT * FROM tbl_user WHERE username = '$username' AND password = '$password' AND active_status = '1'";

$rs = mysqli_query($connection,$sql);
$row = mysqli_fetch_assoc($rs);

if ($row['admin_status'] == 'xJ1he!6oeW') {
  $_SESSION['user_id'] = $row['user_id'];
  $rs = 1;
}
else if ($row['admin_status'] == 1) {
  $_SESSION['user_id'] = $row['user_id'];
  $rs = 2;
}
else {
  $rs = 0;
}

echo json_encode(array('result' => $rs));
