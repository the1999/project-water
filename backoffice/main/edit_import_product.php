<?php
include_once('header.php');
$connection = connectDB();

$import_id = $_GET['id'];

$sql = "SELECT a.* FROM tbl_import_head a
        WHERE import_id = '$import_id'";
$rs = $connection->query($sql) or die($connection->error);
$row = $rs->fetch_assoc();

?>

<div class="container-login100" style="background-image: url('../../template/login_v2/images/water-bg.jpg');">
    <div class="wrap-login100 p-l-55 p-r-55 p-t-80 p-b-30" style="width: 75%;">
        <h4 class="text-center" style="margin-top: -53px;">แก้ไขนำเข้าน้ำดื่ม</h4>

        <form id="frm_import" method="POST" enctype="multipart/form-data">

             <input type="hidden" name="import_id" value="<?=$import_id;?>">

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
                                       class="form-control datepicker" value="<?php echo date('d-m-Y',strtotime($row['import_date'])); ?>"
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

                    </tr>
                    </thead>
                    <tbody>
                    <?php

                    $sql_pro = "SELECT a.*,b.quantity FROM tbl_product a 
                                LEFT JOIN tbl_import_detail b ON a.product_id = b.product_id
                                WHERE b.import_id = '$import_id'";

                    $rs_pro = mysqli_query($connection, $sql_pro) or die($connection->error);

                    $i = 0;

                    while ($row_pro = mysqli_fetch_assoc($rs_pro)) {


                        $i++;

                        ?>

                        <tr id="tr_<?php echo $row_pro['product_id']; ?>">

                            <input type="hidden" name="product_id[]" value="<?php echo $row_pro['product_id']; ?>">

                            <td class="text-center">
                                <?php
                                $url = "";
                                if ($row_pro['product_image'] == 'NULL') {
                                    $url = 'no-image.jpg';
                                } else {
                                    $url = 'product/' . $row_pro['product_image'];
                                } ?>
                                <img src="../../image/<?php echo $url; ?>" style="object-fit:cover;width:200px;height:200px;"><br>

                                <?php echo $row_pro['product_name']; ?>
                            </td>

                            <td class="text-center">
                                <?php echo $row_pro['product_size']; ?>
                            </td>


                            <td class="text-center">
                                <input type="text" class="form-control form-qty" name="quantity[]" id="quantity" value="<?=$row_pro['quantity'];?>">
                            </td>


                        </tr>

                    <?php } ?>
                    </tbody>
                </table>

            </div>


            <div style="float: right;">

                <button type="button" class="login200-form-btn" onclick="submit_edit();">
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


    function submit_edit() {

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
                url: 'ajax/import/edit.php',
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