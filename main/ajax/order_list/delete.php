<?php

session_start();

include('../../../config/main_function.php');

// $secure = "OMP?JFC/p|og^JP";
$connection = connectDB();

$member_id = $_SESSION['member_id'];
$order_id = $_POST['order_id'];
$product_id = $_POST['product_id'];
$price = $_POST['price'];

$sql_up = "UPDATE tbl_order_head SET payment_amont = payment_amont - '$price' WHERE order_id = '$order_id' ";
$rs_up = mysqli_query($connection, $sql_up) or die($connection->error);


$sql = "DELETE FROM tbl_order_detail WHERE order_id = '$order_id' AND product_id = '$product_id'";
$rs = mysqli_query($connection, $sql) or die($connection->error);

$sql_check = "SELECT * FROM tbl_order_detail WHERE order_id = '$order_id'";
$rs_check = mysqli_query($connection, $sql_check)or die($connection->error);
 
if($rs_check->num_rows == 0) {

    $sql_head = "DELETE FROM tbl_order_head WHERE order_id = '$order_id'";
    $rs_head = mysqli_query($connection, $sql_head)or die($connection->error);
}


$arr['result'] = 1;
echo json_encode($arr);

?>
