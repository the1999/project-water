<?php
session_start();
include_once('../../../../config/main_function.php');
// $secure = "OMP?JFC/p|og^JP";
$connection = connectDB();

$order_id = $_POST['order_id'];
$status = $_POST['status'];


$sql = "UPDATE tbl_order_head 
        SET status = '$status'
        WHERE order_id = '$order_id'";
$rs = mysqli_query($connection, $sql) or die($connection->error);


if ($rs) {
    $arr['result'] = 1;
} else {
    $arr['result'] = 0;
}


echo json_encode($arr);