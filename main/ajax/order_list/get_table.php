<?php

session_start();

include('../../../config/main_function.php');

// $secure = "OMP?JFC/p|og^JP";
$connection = connectDB();

$member_id = $_SESSION['member_id'];

?>

<div class="table-responsive">

    <table class="table table-bordered" id="tabel_show_product">
        <thead>
            <tr>
                <th class="text-center">รายการที่จะสั่งซื้อ</th>
                <th class="text-center">ขนาด</th>
                <th class="text-center">ราคา</th>
                <th class="text-center">จำนวน/ถัง/ลัง</th>
                <th class="text-center">รวม</th>
                <th width="10%"> </th>
                <!-- <th class="text-center" style="width: 12%;">
                            ราคาต่อวัน/เดือน
                            <input type="text" id="price_day" onkeyup="loopprice();" class="form-control text-right form-calc-loop" autocomplete="off">
                        </th> -->

            </tr>
        </thead>
        <tbody>
            <?php

            $sql = "SELECT a.*,b.quantity,c.* FROM tbl_order_head a
                        LEFT JOIN tbl_order_detail b ON a.order_id = b.order_id
                        LEFT JOIN tbl_product c ON c.product_id = b.product_id
                        WHERE a.member_id = '$member_id' AND status = 0";

            $rs = mysqli_query($connection, $sql) or die($connection->error);

            $i = 0;
            $total = 0;

            while ($row = mysqli_fetch_assoc($rs)) {

                $i++;

            ?>

                <tr id="tr_<?php echo $row['order_id']; ?>">

                    <!-- <input type="hidden" name="product_id[]" value="<?php// echo $row['product_id']; ?>"> -->



                    <td class="text-center">
                        <?php
                        $url = "";
                        if ($row['product_image'] == 'NULL') {
                            $url = 'no-image.jpg';
                        } else {
                            $url = 'product/' . $row['product_image'];
                        } ?>
                        <img src="../image/<?php echo $url; ?>" style="object-fit:cover;width:100px;height:100px;"><br>

                        <?php echo $row['product_name']; ?>
                    </td>

                    <td class="text-center">
                        <?php echo $row['product_size']; ?>
                    </td>

                    <td class="text-center">
                        <?php echo $row['price']; ?>
                        <input type="hidden" class="form-price" name="price[]" value="<?php echo $row['price']; ?>">
                    </td>

                    <td class="text-center">
                        <?php echo $row['quantity']; ?>
                        <input type="hidden" class="form-control form-qty" name="quantity[]" id="quantity" onkeyup="cal()">
                    </td>

                    <td class="text-center">
                        <?php
                        $price = $row['price'] * $row['quantity'];
                        $total += $price;
                        echo $price;
                        ?>
                        <!-- <input type="text" class="form-control form-qty" name="quantity[]" id="quantity" onkeyup="cal()" readonly> -->
                    </td>

                    <td class="text-center">

                        <div class="btn-group">

                            <button type="button" class="btn-danger btn btn-xs" onclick="delete_item('<?php echo $row['order_id']; ?>','<?php echo $row['product_id']; ?>','<?php echo $price; ?>');"><i class="fa fa-trash-o"></i></button>

                        </div>

                    </td>


                </tr>

            <?php } ?>
        </tbody>
    </table>

</div>

<div class="row mb-1">
    <div class="col-md-6">
    </div>
    <div class="col-md-3 text-right">
        <label><strong>รวม</strong></label>
    </div>
    <div class="col-md-3">
        <input type="text" class="form-control text-right" id="total" name="payment_amont" value="<?php echo $total; ?>" autocomplete="close" readonly>
    </div>
</div>

<!-- <div id="show_table"></div> -->
</div>

<script>

    function delete_item(order_id, product_id, price) {

        swal({

            title: 'กรุณายืนยันเพื่อทำรายการ',

            type: 'warning',

            showCancelButton: true,

            confirmButtonColor: '#3085d6',

            cancelButtonColor: '#d33',

            cancelButtonText: 'ยกเลิก',

            confirmButtonText: 'ยืนยัน',

            closeOnConfirm: false

        }, function() {

            $.ajax({

                url: 'ajax/order_list/delete.php',

                type: 'POST',

                dataType: 'json',

                data: {

                    order_id: order_id,
                    product_id: product_id,
                    price: price

                },

                success: function(data) {

                    if (data.result == 1) {

                        swal({

                            title: "ดำเนินการสำเร็จ",

                            text: "ลบข้อมูลสำเร็จ",

                            type: "success",

                            showConfirmButton: true

                        }, function() {
                            location.reload();
                        });

                        


                    }


                }

            });

        });

    }
</script>