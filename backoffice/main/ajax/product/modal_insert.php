<?php

session_start();

include('../../../../config/main_function.php');

// $secure = "OMP?JFC/p|og^JP";
$connection = connectDB();

?>
<div class="modal-header">
    <h5 class="modal-title" id="exampleModalLabel">เพิ่มสินค้า</h5>
    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
</div>
<form id="frm_pro" method="POST" enctype="multipart/form-data">
    <div class="modal-body">
        <!-- <input type="hidden" name="slide_id" value="<?php //echo $slide_id; 
                                                            ?>"> -->

        <div class="row" style="margin-bottom:10px;">
            <div class="col-md-12">
                <div class="col-md-12 col-sm-12" style="text-align:center;">
                    <div class="form-group">
                        <div class="BroweForFile">
                            <label>รูป</label>

                            <div id="show_image"><label for="upload_file">
                                    <a><img id="blah" src="../../image/no-image.jpg" width="250px" height="200px" /></a></label></div><br />
                            <input type="file" id="upload_file" name="image" onchange="readURL(this);" style="display: none;">
                        </div>
                    </div>
                </div>
                    <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label>ชื่อสินค้า</label>
                            <!-- <font color="red">**</font> -->
                            <input type="text" name="product_name" class="form-control" id="product_name" placeholder="" autocomplete="off">
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>ขนาด(ลิตร/มิลลิลิตร)</label>
                            <!-- <font color="red">**</font> -->
                            <input type="text" name="product_size" class="form-control" id="product_size" placeholder="" autocomplete="off">
                        </div>
                    </div>
                     <div class="col-md-6">
                        <div class="form-group">
                            <label>ราคา(บาท)</label>
                            <!-- <font color="red">**</font> -->
                            <input type="text" name="price" class="form-control" id="price" placeholder="" autocomplete="off" oninput="this.value = this.value.replace(/[^0-9.]/g, ''); this.value = this.value.replace(/(\..*)\./g, '$1');">
                        </div>
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


    function readURL(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();

            reader.onload = function(e) {
                $('#blah').attr('src', e.target.result);
            }

            reader.readAsDataURL(input.files[0]);
        }
    }

    $('#btn_submit').on('click', function() {
        submit();
    })

    function submit() {
        var formData = new FormData($("#frm_pro")[0]);

        if (formData == "") {
            swal({
                title: 'เกิดข้อผิดพลาด',
                text: 'กรุณาอัพโหลดรูปภาพ',
                type: 'error'
            });
            return false;
        }
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
                url: 'ajax/product/insert.php',
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