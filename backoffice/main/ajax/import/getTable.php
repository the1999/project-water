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

            <th>วันที่นำเข้า</th>

            <th>เลขที่นำเข้า</th>

            <th>รายการนำเข้า</th>

            <th width="10%"></th>

        </tr>

        </thead>

        <tbody>

        <?php

        $sql = "SELECT a.* FROM tbl_import_head a
                ORDER BY a.create_datetime DESC ";

        $rs = mysqli_query($connection, $sql) or die($connection->error);

        $i = 0;

        while ($row = mysqli_fetch_assoc($rs)) {

        //หารายการ
        $sql2 = "SELECT a.*,b.product_name
                FROM tbl_import_detail a
                LEFT JOIN tbl_product b ON a.product_id = b.product_id
                where a.import_id ='".$row['import_id']."' ORDER BY a.list_order ASC";
        //echo    $sql2;
        $rs2  = mysqli_query($connection, $sql2);
        $arrBook = array();
        while($row2 = mysqli_fetch_assoc($rs2)) {


            if(!empty($row2['product_name'])){
                $product_name1 = $row2['product_name'].' x '.$row2['quantity'];
            }else{
                $product_name1 = "";
            }

            $arrBook[] = "'".$product_name1."'";
        }

        $product_name = @implode("<br>", $arrBook);
        $product_name = str_replace("'","",$product_name);

        $i++;

        ?>

        <tr id="tr_<?php echo $row['import_id']; ?>">

            <td><?php echo $i; ?></td>


            <td>
                <?php echo date("d/m/Y", strtotime($row['import_date'])); ?>
            </td>

            <td>
                <?php echo $row['import_no']; ?>
            </td>


            <td>
                <?php echo $product_name; ?>
            </td>


             <td class="text-center">

                    <div class="btn-group">
                        <a href="edit_import_product.php?id=<?php echo $row['import_id'];?>">
                            <button class="btn-warning btn btn-xs" ><i class="fa fa-close"></i> แก้ไข</button>
                        </a>

                        <button class="btn-danger btn btn-xs" onclick="delete_item('<?php echo $row['import_id']; ?>');"><i class="fa fa-close"></i> ลบ</button>

                    </div>

             </td>


            <?php } ?>

        </tbody>

    </table>

</div>

<script>

    function delete_item(import_id) {

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

                url: 'ajax/import/delete.php',

                type: 'POST',

                dataType: 'json',

                data: {

                    import_id: import_id

                },

                success: function(data) {

                    if (data.result == 1) {

                        swal({

                            title: "ดำเนินการสำเร็จ",

                            text: "ลบข้อมูลสำเร็จ",

                            type: "success",

                            showConfirmButton: true

                        });


                        $("#tr_" + import_id).fadeOut(1000);

                        setTimeout(function() {

                            swal.close();

                        }, 1500);

                    }

                }

            });

        });

    }
</script>