<?php
session_start();
include_once('../../../../config/main_function.php');
$connection = connectDB();

$order_id = $_POST['order_id'];

$sql = "SELECT * FROM tbl_order_head WHERE order_id = '$order_id'";
$rs = $connection->query($sql) or die($connection->error);
$row = $rs->fetch_assoc();

?>

<div class="modal-header">
    <h5 class="modal-title" id="exampleModalLabel">เปลี่ยนสถานะ</h5>
    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
</div>

<form id="frm_status" method="POST" enctype="multipart/form-data">
    <div class="modal-body" style="padding-bottom: 0;">

        <input type="hidden" name="order_id" value="<?=$order_id;?>">

        <div class="row">
            <div class="col-md-12">
                <div class="form-group">
                    <label>สถานะ</label>

                    <select class="form-control chosen-select" id="delivery_status" name="delivery_status" data-width="100%">

                        <option value="0" <?php if($row['delivery_status'] == 0) { echo 'selected'; } ?> >รอดำเนินการ</option>
                        <option value="1" <?php if($row['delivery_status'] == 1) { echo 'selected'; } ?> >กำลังจัดส่ง</option>
                        <option value="2" <?php if($row['delivery_status'] == 2) { echo 'selected'; } ?> >จัดส่งแล้ว</option>

                    </select>
                </div>
            </div>
        </div>

    </div>
</form>

<div class="modal-footer">
    <button type="button" class="btn btn-secondary" data-dismiss="modal">ปิด</button>
    <button type="button" class="btn btn-primary" id="btn_submit">ยืนยัน</button>
</div>

<script>
    $(document).ready(function(){

    });

    $('.summernote').summernote({
        toolbar: false

    });
    $('.chosen-select').chosen({
        no_results_text: "Oops, nothing found!",
        width: "100%"
    });


    $('#btn_submit').on('click', function() {
        submit();
    })



    function submit() {

        var formData = new FormData($("#frm_status")[0]);

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
                url: 'ajax/order/updateStatus.php',
                data: formData,
                processData: false,
                contentType: false,
                dataType: 'json',
                success: function(data) {
                    if (data.result == 0) {
                        swal({
                            title: 'ผิดพลาด!',
                            text: '',
                            type: 'warning'
                        });
                        return false;
                    }
                    if (data.result == 1) {
                        $('#modal').modal('hide');
                        swal({
                            title: "ดำเนินการสำเร็จ!",
                            text: "ทำการบันทึกรายการ เรียบร้อย",
                            type: "success",
                            showConfirmButton: true
                        });
                        load_table();
                    }
                }
            })
        });
    }
</script>