<?php
include_once('header.php');
$connection = connectDB();

?>

<div class="container-login100" style="background-image: url('../../template/login_v2/images/water-bg.jpg');">
    <div class="wrap-login100 p-l-55 p-r-55 p-t-80 p-b-30" style="width: 75%;">
        <h4 class="text-center" style="margin-top: -53px;">นำเข้าน้ำดื่ม</h4>

        <form id="frm_import" method="POST" enctype="multipart/form-data">

            <!-- <input type="hidden" name="product_id"> -->

            <!-- <input type="hidden" name="price"> -->

            <div class="ibox-content">

                <div class="row">
                    <div class="col-md-4 col-sm-4">

                        <div class="form-group">
                            <label>วันที่นำเข้า</label>
                            <div class="input-group date">
                                        <span class="input-group-addon">
                                            <i class="fa fa-calendar"></i>
                                        </span>
                                <input type="text" id="import_date" name="import_date"
                                       class="form-control datepicker" value="<?php echo date('d-m-Y'); ?>"
                                       autocomplete="off">

                            </div>
                        </div>
                    </div>
                </div>

                <table class="table table-bordered" id="tabel_show_product">
                    <thead>
                    <tr>
                        <th class="text-center">รายการที่จะนำเข้า</th>
                        <th class="text-center">ขนาด</th>
                        <th class="text-center">จำนวน/ถัง/ลัง</th>
                        <!-- <th class="text-center" style="width: 12%;">
                        ราคาต่อวัน/เดือน
                        <input type="text" id="price_day" onkeyup="loopprice();" class="form-control text-right form-calc-loop" autocomplete="off">
                    </th> -->

                    </tr>
                    </thead>
                    <tbody>
                    <?php

                    $sql = "SELECT * FROM tbl_product";

                    $rs = mysqli_query($connection, $sql) or die($connection->error);

                    $i = 0;

                    while ($row = mysqli_fetch_assoc($rs)) {

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
                                <img src="../../image/<?php echo $url; ?>" style="object-fit:cover;width:200px;height:200px;"><br>

                                <?php echo $row['product_name']; ?>
                            </td>

                            <td class="text-center">
                                <?php echo $row['product_size']; ?>
                            </td>


                            <td class="text-center">
                                <input type="text" class="form-control form-qty" name="quantity[]" id="quantity" onkeyup="cal()">
                            </td>


                        </tr>

                    <?php } ?>
                    </tbody>
                </table>

            </div>


            <div style="float: right;">

                <button type="button" class="login200-form-btn" onclick="submit_insert();">
                    ยืนยัน
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

    $(".datepicker").datepicker({
        todayBtn: "linked",
        keyboardNavigation: false,
        format: 'dd-mm-yyyy',
        autoclose: true,
        autocomplete: false
    });

    $('.summernote').summernote({
        toolbar: false
    });

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

        var formData = new FormData($("#frm_import")[0]);

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
                url: 'ajax/import/insert.php',
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
                            location.href = "import_product_list.php";
                        });
                    }
                }
            })
        });
    }
</script>

</body>

</html>