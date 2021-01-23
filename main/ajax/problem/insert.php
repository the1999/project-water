<?php
session_start();
include('../../../config/main_function.php');
// $secure = "OMP?JFC/p|og^JP";
$connection = connectDB();

// $user_id = getRandomID(10, 'tbl_user', 'user_id');

$problem_text = $_POST['problem_text'];
// $datenow = date("Y-m-d h:i:s");
$member_id = $_SESSION['member_id'];


$sql = "INSERT INTO tbl_problem
        SET   problem_date = now()
            , member_id = '$member_id'
            , problem_text = '$problem_text'

            ";

$rs = mysqli_query($connection, $sql) or die($connection->error);






if ($rs) {
    $arr['result'] = 1;
} else {
    $arr['result'] = 0;
}


echo json_encode($arr);
