<?php
session_start();
include_once('../../../../config/main_function.php');
// $secure = "OMP?JFC/p|og^JP";
$connection = connectDB();

$import_id = $_POST['import_id'];
$import_date = $_POST['import_date'];
$new_import_date = date("Y-m-d", strtotime($import_date));
$admin_id = $_SESSION['admin_id'];


$sql = "UPDATE tbl_import_head
            SET   import_date = '$new_import_date'
                , import_user_id = '$admin_id'
                WHERE import_id = '$import_id'
            ";

$rs = mysqli_query($connection, $sql) or die($connection->error);

//delete
$sql = "DELETE FROM tbl_import_detail WHERE import_id = '$import_id'";
$rs = mysqli_query($connection, $sql) or die($connection->error);


$temp_array_u = array();
$i = 1;
foreach ($_POST['product_id'] as $key => $value) {
    $temp_array_u[$i]['product_id'] = $value;
    $i++;
}

$i = 1;
foreach ($_POST['quantity'] as $key => $value) {
    $temp_array_u[$i]['quantity'] = (($value == '') ? 0 : $value);
    $i++;
}

for ($a = 1; $a < $i; $a++) {


    $product_id = $temp_array_u[$a]['product_id'];
    $quantity = $temp_array_u[$a]['quantity'];

    if($quantity != 0) {

        $nums = "SELECT MAX(list_order) AS last_id FROM tbl_import_detail";
        $qry = mysqli_query($connection, $nums);
        $rows = mysqli_fetch_assoc($qry);
        if ($rows['last_id'] < 0) {
            $rows['last_id'] = 0;
        }
        // substr ตัดคำ
        $maxId = substr($rows['last_id'], 0);
        $maxId = ($maxId + 1);
        $nextId = $maxId;
        $list_order = $nextId;

        $sql = "INSERT INTO tbl_import_detail
                SET   import_id = '$import_id'
                    , product_id = '$product_id'
                    , quantity = '$quantity'
                    , list_order = '$list_order'
                    ";

        $rs = mysqli_query($connection, $sql) or die($connection->error);


    }


}


if ($rs) {
    $arr['result'] = 1;
} else {
    $arr['result'] = 0;
}


echo json_encode($arr);