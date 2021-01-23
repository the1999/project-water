<?php
session_start();
include('../../../config/main_function.php');
$connection = connectDB();


$sql = "SELECT COUNT(*) AS count FROM tbl_order_head WHERE status = 5 AND read_datetime IS NULL";
$rs = mysqli_query($connection, $sql) or die($connection->error);
$row = $rs->fetch_assoc();
//$numList = $rs->num_rows();
//
//
//
//$arr['result'] = $numList;



echo json_encode($row);

?>