<?php

session_start();

include('../../../config/main_function.php');

// $secure = "OMP?JFC/p|og^JP";
$connection = connectDB();

$member_id = $_SESSION['member_id'];

$sql = "SELECT a.*,b.quantity,c.product_name,product_image FROM tbl_order_head a
LEFT JOIN tbl_order_detail b ON a.order_id = b.order_id
LEFT JOIN tbl_product c ON c.product_id = b.product_id
WHERE a.member_id = '$member_id' AND a.status = 0";

$rs = mysqli_query($connection, $sql) or die($connection->error);

$sql2 = "SELECT a.*,b.*,c.product_name,product_image FROM tbl_order_head a
LEFT JOIN tbl_order_detail b ON a.order_id = b.order_id
LEFT JOIN tbl_product c ON c.product_id = b.product_id
WHERE a.member_id = '$member_id' AND a.status = 0";

$rs2 = mysqli_query($connection, $sql2) or die($connection->error);

$row2 = mysqli_fetch_assoc($rs2);

while ($row = mysqli_fetch_assoc($rs)) {

?>


    <li>
        <a onclick="" class="dropdown-item">
            <div>
                <?php
                $url = '';
                if ($row['product_image'] == 'NULL') {
                    $url = 'no-image.jpg';
                } else {
                    $url = 'product/' . $row['product_image'];
                } ?>
                <img src="../image/<?php echo $url; ?>" style="object-fit:cover;width:50px;height:50px;">

                <?php echo $row['product_name']; ?>

                จำนวน <?php echo $row['quantity']; ?>
            </div>

        </a>
    </li>

<?php } ?>


    <!-- <p class="text-right">ราคา : <?php //echo $row2['payment_amont']; ?> บาท </p> -->
<a href="order_list.php?id=<?php echo $row2['order_id']; ?>">
    <button type="button" class="btn btn-primary" style="float: right;font-size: 13px;margin-right: 10px;">ยืนยัน</button>
</a>
