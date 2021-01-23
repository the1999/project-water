<?php

session_start();

include('../../../config/main_function.php');
$connection = connectDB();


$i = 1;
foreach ($_POST['order_id'] as $key => $value) {
    $temp_array_u[$i]['order_id'] = $value;
    $i++;
}

for ($a = 1; $a < $i; $a++) {

    $order_id = $temp_array_u[$a]['order_id'];

    $sql = "UPDATE tbl_order_head 
        SET read_datetime = now() 
        WHERE order_id = '$order_id'";
    $rs = mysqli_query($connection, $sql);


}


$arr['result'] = 1;
echo json_encode($arr);

?>
