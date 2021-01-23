<?php
session_start();
include_once('../../../../config/main_function.php');
// $secure = "OMP?JFC/p|og^JP";
$connection = connectDB();

$import_id = $_POST['import_id'];

//delete
$sql = "DELETE FROM tbl_import_head WHERE import_id = '$import_id'";
$rs = mysqli_query($connection, $sql) or die($connection->error);

//delete
$sql = "DELETE FROM tbl_import_detail WHERE import_id = '$import_id'";
$rs = mysqli_query($connection, $sql) or die($connection->error);



if ($rs) {
    $arr['result'] = 1;
} else {
    $arr['result'] = 0;
}


echo json_encode($arr);