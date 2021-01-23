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

                <th class="text-center">รายการที่จะสั่งซื้อ</th>
                <th class="text-center">ขนาด</th>
                <th class="text-center">ราคา</th>
                <th class="text-center">คงเหลือ</th>
                <th idth="10%"></th>

            </tr>

        </thead>

        <tbody>

            <?php

            $sql = "SELECT a.*
                    ,(SELECT SUM(quantity) FROM tbl_import_detail WHERE product_id = a.product_id) AS imp
                    ,(SELECT SUM(c.quantity) FROM tbl_order_detail c
                      LEFT JOIN tbl_order_head b ON c.order_id = b.order_id
                      WHERE product_id = a.product_id AND b.status NOT IN(0,5)) AS ord
                    FROM tbl_product a";

            $rs = mysqli_query($connection, $sql) or die($connection->error);

            $i = 0;

            while ($row = mysqli_fetch_assoc($rs)) {

                $i++;

            ?>

                <tr id="tr_<?php echo $row['product_id']; ?>">


                    <td class="text-center">
                    <?php
                        $url = "";
                        if ($row['product_image'] == 'NULL') {
                            $url = 'no-image.jpg';
                        } else {
                            $url ='product/'. $row['product_image'];
                        } ?>
                        <img src="../../image/<?php echo $url; ?>" style="object-fit:cover;width:200px;height:200px;"><br>

                        <?php echo $row['product_name']; ?>
                    </td>

                    <td class="text-center">
                        <?php echo $row['product_size']; ?>
                    </td>

                    <td class="text-center">
                        <?php echo number_format($row['price'],2); ?>
                    </td>

                    <td class="text-center">
                        <?php
                            $total = $row['imp'] - $row['ord'];
                            if($total < 0) {
                                echo 0;
                            } else {
                                echo $total;
                            }
                        ?>
                    </td>

                    <td class="text-center">

                        <div class="btn-group">

                            <button class="btn-warning btn btn-xs" onclick="modal_edit('<?php echo $row['product_id']; ?>');"><i class="fa fa-edit"></i> แก้ไข</button>

                            <button class="btn-danger btn btn-xs" onclick="delete_item('<?php echo $row['product_id']; ?>');"><i class="fa fa-close"></i> ลบ</button>

                        </div>

                    </td>


                </tr>

            <?php } ?>

        </tbody>

    </table>

</div>

<script>
    function modal_insert() {

        $('#modal').modal('show');

        $('#show_modal').load("ajax/product/modal_insert.php");

    }



    function modal_edit(product_id) {

        $('#modal').modal('show');

        $('#show_modal').load("ajax/product/modal_edit.php", {
            product_id: product_id
        });

    }

    // function modal_setting(product_type_id) {

    //     $('#modal').modal('show');

    //     $('#show_modal').load("ajax/setting/setting.php", {
    //         product_type_id: product_type_id
    //     });

    // }


    function Changestatus(user_id)

    {

        $.ajax({

            type: 'POST',

            url: 'ajax/ChangeStatus.php',

            data: {

                table_name: "tbl_user",

                key_name: "user_id",

                key_value: user_id

            },

            dataType: 'json',

            success: function(data) {

                load_table();

            }

        });

    }



    function delete_item(product_id) {

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

                url: 'ajax/product/delete.php',

                type: 'POST',

                dataType: 'json',

                data: {

                    product_id: product_id

                },

                success: function(data) {

                    if (data.result == 1) {

                        swal({

                            title: "ดำเนินการสำเร็จ",

                            text: "ลบข้อมูลสำเร็จ",

                            type: "success",

                            showConfirmButton: true

                        });


                        $("#tr_" + product_id).fadeOut(1000);

                        setTimeout(function() {

                            swal.close();

                        }, 1500);

                    }

                }

            });

        });

    }
</script>