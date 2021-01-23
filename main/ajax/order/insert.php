<?php
session_start();
include_once('../../../config/main_function.php');
// $secure = "OMP?JFC/p|og^JP";
$connection = connectDB();

$payment_amont = $_POST['payment_amont'];
$member_id = $_SESSION['member_id'];
$temp_array_u = array();
$y = date('y');
$m = date('m');


// Run เลข
$code = $y.$m;
$nums = "SELECT order_no FROM tbl_order_head WHERE order_no LIKE '$code%' ORDER BY order_no DESC LIMIT 1";
$qry = mysqli_query($connection, $nums) or die($connection->error);
$rows = mysqli_fetch_assoc($qry);

if ($qry->num_rows < 1) {
    $rows['order_no'] = 0;
}

$maxId = explode($code, $rows['order_no']);
$list_order = ($maxId[1] + 1);
$list_order = str_pad($list_order, 4, "0", STR_PAD_LEFT);
$order_no = $code.$list_order;

$sql = "INSERT INTO tbl_order_head
            SET   order_no = '$order_no'
                , member_id = '$member_id'
                , order_date = now()
                , payment_amont = '$payment_amont'
                , status = 0
                ";

$rs = mysqli_query($connection, $sql) or die($connection->error);

$id = mysqli_insert_id($connection);

$i = 1;
foreach ($_POST['product_id'] as $key => $value) {
    $temp_array_u[$i]['product_id'] = $value;
    $i++;
}

$i = 1;
foreach ($_POST['price'] as $key => $value) {
    $temp_array_u[$i]['price'] = $value;
    $i++;
}

$i = 1;
foreach ($_POST['quantity'] as $key => $value) {
    $temp_array_u[$i]['quantity'] = (($value == '') ? 0 : $value);
    $i++;
}

for ($a = 1; $a < $i; $a++) {


    $product_id = $temp_array_u[$a]['product_id'];
    $price = $temp_array_u[$a]['price'];
    $quantity = $temp_array_u[$a]['quantity'];

    if($quantity != 0) {

        $nums = "SELECT MAX(list_order) AS last_id FROM tbl_order_detail";
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

    $sql = "INSERT INTO tbl_order_detail
    SET   order_id = '$id'
        , product_id = '$product_id'
        , unit_price = '$price'
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