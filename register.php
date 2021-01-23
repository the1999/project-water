<?php
session_start();
include('config/main_function.php');
// $secure = "OMP?JFC/p|og^JP";
$connection = connectDB();

// $user_id = getRandomID(10, 'tbl_user', 'user_id');

$username = $_POST['username'];
$phone = $_POST['phone'];
$address = $_POST['address'];
$password = md5(mysqli_real_escape_string($connection, $_POST['password'])); //เข้าหรัสรอบแรก md5

////////// Password ///////////
// $secure_text = randomCode(10);
// $secure_pointer = rand(0,9);
// $mypassword = stringInsert($password,$secure_text,$secure_pointer);
// $my_password = SHA1($mypassword);
// ----------------------- //

$sql1 = "SELECT count(username) as username FROM tbl_member WHERE username = '$username'";
$rs1 = mysqli_query($connection,$sql1) or die($connection->error);
$row1 = mysqli_fetch_array($rs1);
if($row1['username']>0)
{
    $arr['result'] = 0;
}
else
{
    $sql = "INSERT INTO tbl_member
            SET   username = '$username'
                , password = '$password'
                , phone = '$phone'
                , address = '$address'
                ";

$rs = mysqli_query($connection, $sql) or die($connection->error);

}




if ($rs) {
    $arr['result'] = 1;
} else {
    $arr['result'] = 0;
}


echo json_encode($arr);
