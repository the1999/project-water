<?php
session_start();
include('../../../config/main_function.php');
$connection = connectDB();

$sql = "SELECT * FROM tbl_order_head WHERE status = 5 AND read_datetime IS NULL";
$rs = mysqli_query($connection, $sql) or die($connection->error);


?>

<div class="modal-header">
    <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
    <h4 class="modal-title">รายการยกเลิกล่าสุด</h4>
</div>

<div class="modal-body">
    <form id="CancelForm" action="" method="post">
        <?php
            $i=0;
            while ($row = $rs->fetch_assoc()) {
                $i++;
        ?>

            <input type="hidden" name="order_id[]" value="<?=$row['order_id'];?>">
            <p class="text-center"><strong><?=$i;?>. คำสั่งซื้อเลขที่ : <?=$row['order_no'];?></strong></p>

            <hr>

        <?php
            }
        ?>
    </form>
</div>

<div class="modal-footer">
    <button type="button" class="btn btn-white" data-dismiss="modal">ปิด</button>
    <button type="button" class="btn btn-primary" onclick="submitCancel();">ยืนยัน</button>
</div>

<script>

    function submitCancel() {

        var formData = new FormData($("#CancelForm")[0]);

       $.ajax({

                type: 'POST',

                url: 'ajax/index/updateReadCancel.php',

                data: formData,

                processData: false,

                contentType: false,

                dataType: 'json',

                success: function(data) {

                    swal({

                        title: "ดำเนินการสำเร็จ!",

                        text: "ทำการบันทึกเรียบร้อยแล้ว",

                        type: "success",

                        showConfirmButton: true

                    }, function () {
                        $('#myModal6').modal('hide');
                        load_table_cancel();

                    });

                }

            });

    }
</script>
