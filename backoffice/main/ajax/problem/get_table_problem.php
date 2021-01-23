<?php

session_start();

include('../../../../config/main_function.php');

// $secure = "OMP?JFC/p|og^JP";
$connection = connectDB();

?>

<div class="table-responsive">

    <table class="table table-striped dataTables-example">

        <thead>

            <tr>

                <th>#</th>

                <th>วันที่</th>

                <th>ชื่อ</th>

                <th>ปัญหา</th>

                <th width="10%"></th>

            </tr>

        </thead>

        <tbody>

            <?php

            $sql = "SELECT a.*,b.username FROM tbl_problem a
            LEFT JOIN tbl_member b ON a.member_id = b.member_id";

            $rs = mysqli_query($connection, $sql) or die($connection->error);

            $i = 0;

            while ($row = mysqli_fetch_assoc($rs)) {

                $i++;

            ?>

                <tr id="tr_<?php echo $row['problem_id']; ?>">

                    <td><?php echo $i; ?></td>


                    <td>
                        <?php echo date("d-m-Y", strtotime($row['problem_date'])); ?>
                    </td>

                    <td>
                        <?php echo $row['username']; ?>
                    </td>


                    <td>
                        <?php echo $row['problem_text']; ?>
                    </td>

                    

                     <td class="text-center">

                        <div class="btn-group">

                            <button class="btn-danger btn btn-xs" onclick="delete_item('<?php echo $row['problem_id']; ?>');"><i class="fa fa-close"></i> ลบ</button>

                        </div>

                    </td>


                <?php } ?>

        </tbody>

    </table>

</div>

<script>


    function delete_item(problem_id) {

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

                url: 'ajax/problem/delete.php',

                type: 'POST',

                dataType: 'json',

                data: {

                    problem_id: problem_id

                },

                success: function(data) {

                    if (data.result == 1) {

                        swal({

                            title: "ดำเนินการสำเร็จ",

                            text: "ลบข้อมูลสำเร็จ",

                            type: "success",

                            showConfirmButton: true

                        });


                        $("#tr_" + problem_id).fadeOut(1000);

                        setTimeout(function() {

                            swal.close();

                        }, 1500);

                    }

                }

            });

        });

    }
</script>