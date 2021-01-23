<?php
include_once('header.php');
// $secure = "OMP?JFC/p|og^JP";
$connection = connectDB();

?>

<div class="container-login100" style="background-image: url('../template/login_v2/images/water-bg.jpg');">
    <div class="wrap-login100 p-l-55 p-r-55 p-t-80 p-b-30" style="width: 50%;">
        <h4 class="text-center" style="margin-top: -53px;">รายงานปัญหา</h4>
        <form id="frm_problem">

            <div class="row">
                <div class="col-lg-12">
                   

                        <div class="ibox-content">

                            <textarea class="form-control summernote" rows="3" name="problem_text" id="problem_text"></textarea>

                        </div>
                    </div>
              
            </div>

        </form>

        <div class="container-login100-form-btn">
            <button type="button" class="login100-form-btn" id="btn_submit">
                ส่ง
            </button>
        </div>

        <a href="index.php"><p class="text-center" style="margin-top: 20px;"><i class="fa fa-home" aria-hidden="true"></i> กลับหน้าหลัก</p></a>

        <div class="modal fade" id="modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" data-keyboard="false" data-backdrop="static">
            <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div id="show_modal"></div>
                </div>
            </div>
        </div>

    </div>
</div>




<?php include('import_script.php'); ?>

<script>
    $('#btn_submit').on('click', function() {
        submit();
    })



    function submit() {

        var problem_text = $('#problem_text').val();

        var formData = new FormData($("#frm_problem")[0]);

        if (problem_text == "") {
            swal({
                title: 'เกิดข้อผิดพลาด',
                text: 'กรุณากรอกข้อมูลครบถ้วน',
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
                url: 'ajax/problem/insert.php',
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
                        }, function() {
                            location.href = "problem.php";
                        });


                    }
                }
            })
        });
    }
</script>

</body>

</html>