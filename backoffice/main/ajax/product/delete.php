<?php

session_start();

include('../../../../config/main_function.php');

// $secure = "OMP?JFC/p|og^JP";
$connection = connectDB();

$product_id = $_POST['product_id'];

$sql = "DELETE FROM tbl_product WHERE product_id = '$product_id'";
$rs = mysqli_query($connection, $sql);


$arr['result'] = 1;
echo json_encode($arr);

?>
