<?php
session_start();
include('../../../config/main_function.php');
// $secure = "OMP?JFC/p|og^JP";
$connection = connectDB();

// $user_id = getRandomID(10, 'tbl_user', 'user_id');

$order_id = $_POST['order_id'];
$status = $_POST['status'];


if($status == 0) {
    $sql = "UPDATE tbl_order_head SET status = 1
            WHERE order_id = '$order_id'";
    $rs = mysqli_query($connection, $sql) or die($connection->error);

    if ($_FILES['image'] != "") {
        $tmpFilePath_1 = $_FILES['image']['tmp_name'];
        $file_1  = explode(".", $_FILES['image']['name']);
        $count1 = count($file_1) - 1;
        $file_surname_1 = $file_1[$count1];
        $filename_images_1 = md5(date('mds') . rand(111, 999) . date("hsid") . rand(111, 999)) . "." . $file_surname_1;

        if ($file_surname_1 == 'jpg' || $file_surname_1 == 'jpeg' || $file_surname_1 == 'gif' || $file_surname_1 == 'png' || $file_surname_1 == 'JPG' || $file_surname_1 == 'JPEG' || $file_surname_1 == 'GIF' || $file_surname_1 == 'PNG') {
            if (move_uploaded_file($_FILES['image']['tmp_name'], "../../../image/payment/" . $filename_images_1)) {

                // $sql1 = "SELECT payment_slip FROM tbl_order_head WHERE order_id = '$order_id'";
                // $rs1 = mysqli_query($connection,$sql1);
                // $row1 = mysqli_fetch_array($rs1);
                // unlink('../../../image/payment/'.$row1['payment_slip'].'');

                $sql = "UPDATE tbl_order_head
                SET   payment_slip = '$filename_images_1'
                    , approve_payment_date = now()
                    WHERE order_id = '$order_id'
                    ";

                $rs = mysqli_query($connection, $sql) or die($connection->error);
            }

        }

    }

} else {
    $sql = "UPDATE tbl_order_head SET status = '$status'
            WHERE order_id = '$order_id'";
    $rs = mysqli_query($connection, $sql) or die($connection->error);
}





if ($rs) {
    $arr['result'] = 1;
} else {
    $arr['result'] = 0;
}


echo json_encode($arr);
