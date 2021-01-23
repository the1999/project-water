<?php

session_start();

include('../../../config/main_function.php');

// $secure = "OMP?JFC/p|og^JP";
$connection = connectDB();

$order_id = $_POST['order_id'];

$sql = "DELETE FROM tbl_order_head WHERE order_id = '$order_id'";
$rs = mysqli_query($connection, $sql);

$sql = "DELETE FROM tbl_order_detail WHERE order_id = '$order_id'";
$rs = mysqli_query($connection, $sql);


$arr['result'] = 1;
echo json_encode($arr);

?>
