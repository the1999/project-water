<?php
session_start();
include('../../../../config/main_function.php');
// $secure = "OMP?JFC/p|og^JP";
$connection = connectDB();


$product_name = $_POST['product_name'];
$product_size = $_POST['product_size'];
$price = $_POST['price'];

$sql = "INSERT INTO tbl_product
        SET   product_name = '$product_name'
            , product_size = '$product_size'
            , price = '$price'
            ";

$rs = mysqli_query($connection, $sql) or die($connection->error);

$id = mysqli_insert_id($connection);

if ($_FILES['image'] != "") {
        $tmpFilePath_1 = $_FILES['image']['tmp_name'];
        $file_1  = explode(".", $_FILES['image']['name']);
        $count1 = count($file_1) - 1;
        $file_surname_1 = $file_1[$count1];
        $filename_images_1 = md5(date('mds') . rand(111, 999) . date("hsid") . rand(111, 999)) . "." . $file_surname_1;
        if ($file_surname_1 == 'jpg' || $file_surname_1 == 'jpeg' || $file_surname_1 == 'gif' || $file_surname_1 == 'png' || $file_surname_1 == 'JPG' || $file_surname_1 == 'JPEG' || $file_surname_1 == 'GIF' || $file_surname_1 == 'PNG') {
            if (move_uploaded_file($_FILES['image']['tmp_name'], "../../../../image/product/" . $filename_images_1)) {
                $sql = "UPDATE tbl_product 
                SET product_image = '$filename_images_1' WHERE product_id = '$id'
                    ";

                $rs = mysqli_query($connection, $sql) or die($connection->error);
                $arr['result'] = 1;
            }
        }
    }




if ($rs) {
    $arr['result'] = 1;
} else {
    $arr['result'] = 0;
}


echo json_encode($arr);
