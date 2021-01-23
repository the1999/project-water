<?php

session_start();

include('../../../../config/main_function.php');

// $secure = "OMP?JFC/p|og^JP";
$connection = connectDB();

$problem_id = $_POST['problem_id'];

$sql = "DELETE FROM tbl_problem WHERE problem_id = '$problem_id'";
$rs = mysqli_query($connection, $sql);


$arr['result'] = 1;
echo json_encode($arr);

?>
