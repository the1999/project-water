<?php

include_once('header.php');
include_once('../config/main_function.php');
$connection = connectDB();

$member_id = $_SESSION['member_id'];

?>

<div class="container-login100" style="background-image: url('../template/login_v2/images/water-bg.jpg');">
    <div class="wrap-login100 p-l-55 p-r-55 p-t-80 p-b-30" style="width: 75%;">
        <h4 class="text-center" style="margin-top: -53px;">สั่งซื้อน้ำดื่ม</h4>

        <form id="frm_order" method="POST" enctype="multipart/form-data">

             <input type="hidden" name="member_id" value="<?=$member_id;?>">

            <!-- <input type="hidden" name="price"> -->

            <div class="ibox-content">

                <table class="table table-bordered" id="tabel_show_product">
                    <thead>
                        <tr>
                            <th class="text-center">รายการที่จะสั่งซื้อ</th>
                            <th class="text-center">ขนาด</th>
                            <th class="text-center">จำนวนคงเหลือ</th>
                            <th class="text-center">ราคา</th>
                            <th class="text-center">จำนวน/ถัง/ลัง</th>
                            <!-- <th class="text-center" style="width: 12%;">
                            ราคาต่อวัน/เดือน
                            <input type="text" id="price_day" onkeyup="loopprice();" class="form-control text-right form-calc-loop" autocomplete="off">
                        </th> -->

                        </tr>
                    </thead>
                    <tbody>
                        <?php

                        $sql = "SELECT a.*
                                ,(SELECT SUM(quantity) FROM tbl_import_detail 
                                    WHERE product_id = a.product_id) AS imp
                                ,(SELECT SUM(c.quantity) FROM tbl_order_detail c
                                LEFT JOIN tbl_order_head b ON c.order_id = b.order_id
                                WHERE product_id = a.product_id AND b.status NOT IN(0,5)) AS ord
                                FROM tbl_product a";

                        $rs = mysqli_query($connection, $sql) or die($connection->error);

                        $i = 0;

                        while ($row = mysqli_fetch_assoc($rs)) {

                            $stock = $row['imp'] - $row['ord'];
                            $i++;

                        ?>

                            <tr id="tr_<?php echo $row['product_id']; ?>">

                                <input type="hidden" name="product_id[]" value="<?php echo $row['product_id']; ?>">



                                <td class="text-center">
                                    <?php
                                    $url = "";
                                    if ($row['product_image'] == 'NULL') {
                                        $url = 'no-image.jpg';
                                    } else {
                                        $url = 'product/' . $row['product_image'];
                                    } ?>
                                    <img src="../image/<?php echo $url; ?>" style="object-fit:cover;width:200px;height:200px;"><br>

                                    <?php echo $row['product_name']; ?>
                                </td>

                                <td class="text-center">
                                    <?php echo $row['product_size']; ?>
                                </td>

                                <td class="text-center">
                                    <?php
                                     if($stock < 0) {
                                        echo "0";
                                     } else {
                                        echo $stock;
                                     }
                                    ?>
                                    <input type="hidden" class="form-stock" value="<?php echo $stock; ?>">
                                </td>

                                <td class="text-center">
                                    <?php echo $row['price']; ?>
                                    <input type="hidden" class="form-price" name="price[]" value="<?php echo $row['price']; ?>">
                                </td>

                                <td class="text-center">
                                    <input type="text" class="form-control form-qty" name="quantity[]" id="quantity" onkeyup="cal()" onchange="overstock(this);">
                                </td>


                            </tr>

                        <?php } ?>
                    </tbody>
                </table>

                <div class="row mb-1">
                    <div class="col-md-6">
                    </div>
                    <div class="col-md-3 text-right">
                        <label><strong>รวม</strong></label>
                    </div>
                    <div class="col-md-3">
                        <input type="text" class="form-control text-right" id="total" name="payment_amont" value="0" autocomplete="close" readonly>
                    </div>
                </div>

                <!-- <div id="show_table"></div> -->
            </div>

            <div style="float: left;">
                <a href="index.php">
                    <p><i class="fa fa-home" aria-hidden="true"></i> กลับหน้าหลัก</p>
                </a>

            </div>

            <div style="float: right;">

                <button type="button" class="login200-form-btn" onclick="submit_insert();">
                    สั่งซื้อ
                </button>

            </div>

        </form>

    </div>
</div>




<?php include('import_script.php'); ?>

<script>
    // $(document).ready(function() {
    //     load_table();
    // });

    //เช็คจำนวนสินค้าว่าเกินจำนวนที่สั่ง
    function overstock(el) {
        let tr = $(el).closest('tr');
        let stock = parseFloat(tr.find('.form-stock').val());
        let qty = parseFloat(tr.find('.form-qty').val());

        if(qty>stock){
            swal({
                title: 'ผิดพลาด',
                text: 'สินค้าเกินจำนวนสินค้าคงเหลือ ',
                type: 'warning'
            });

            tr.find('.form-qty').val('');
        }
    }


    //คำนวณรวม
    function cal() {
        var total = 0;
        $("#tabel_show_product tbody tr").each(function() {
            var parent = $(this).closest("tr"),
                price = parseInt(parent.find(".form-price").val()),
                qty = (parent.find(".form-qty").val() == '') ? 0 : parseInt(parent.find(".form-qty").val());
            total += (qty * price);
        })
        $("#total").val(total.toFixed(2));
    }


    function submit_insert() {

        var formData = new FormData($("#frm_order")[0]);

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
                type: 'POST',
                url: 'ajax/order/insert.php',
                data: formData,
                processData: false,
                contentType: false,
                dataType: 'json',
                success: function(data) {
                    if (data.result == 0) {
                        return false;
                        swal({
                            title: 'ผิดพลาด!',
                            text: 'กรุณากรอกข้อมูลให้ถูกต้อง !',
                            type: 'warning'
                        });
                        return false;
                    }
                    if (data.result == 1) {

                        swal({
                            title: "ดำเนินการสำเร็จ!",
                            text: "ทำการบันทึกรายการ เรียบร้อย",
                            type: "success",
                            showConfirmButton: true
                        }, function() {
                            location.href = "order.php";
                        });
                    }
                }
            })
        });
    }
</script>

</body>

</html>