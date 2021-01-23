<?php
session_start();
include_once('../../../../config/main_function.php');
// $secure = "OMP?JFC/p|og^JP";
$connection = connectDB();

$import_date = $_POST['import_date'];
$new_import_date = date("Y-m-d", strtotime($import_date));
$admin_id = $_SESSION['admin_id'];
$y = date('y');
$m = date('m');

// Run เลข
$code = "IM".$y.$m;
$nums = "SELECT import_no FROM tbl_import_head WHERE import_no LIKE '$code%' ORDER BY import_no DESC LIMIT 1";
$qry = mysqli_query($connection, $nums) or die($connection->error);
$rows = mysqli_fetch_assoc($qry);

if ($qry->num_rows < 1) {
    $rows['import_no'] = 0;
}

$maxId = array();
$maxId = explode($code, $rows['import_no']);
$list_order = ($maxId[1] + 1);
$list_order = str_pad($list_order, 4, "0", STR_PAD_LEFT);
$import_no = $code.$list_order;

$sql = "INSERT INTO tbl_import_head
            SET   import_no = '$import_no'
                , import_date = '$new_import_date'
                , import_user_id = '$admin_id'
                ";

$rs = mysqli_query($connection, $sql) or die($connection->error);

$id = mysqli_insert_id($connection);


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
    SET   import_id = '$id'
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