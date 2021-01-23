<?php

session_start();

include('../../../config/main_function.php');

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

                <th class="text-center">จำนวน/ถัง/ลัง</th>

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


                    <td class="text-center">
                    <?php
                        $url;
                        if ($row['product_image'] == 'NULL') {
                            $url = 'no-image.jpg';
                        } else {
                            $url = 'product/' . $row['product_image'];
                        } ?>
                        <img src="../image/<?php echo $row['product_image']; ?>" style="object-fit:cover;width:200px;height:200px;"><br>

                        <?php echo $row['product_name']; ?>
                    </td>

                    <td class="text-center">
                        <?php echo $row['product_size']; ?>
                    </td>

                    <td class="text-center">
                        <?php echo $row['price']; ?>
                    </td>

                    <td class="text-center">
                        <input type="text" class="form-control" name="" id="">
                    </td>


                </tr>

            <?php } ?>

        </tbody>

    </table>

</div>

<script>
    function modal_insert() {

        $('#modal').modal('show');

        $('#show_modal').load("ajax/user/modal_insert.php");

    }



    function modal_edit(user_id) {

        $('#modal').modal('show');

        $('#show_modal').load("ajax/user/modal_edit.php", {
            user_id: user_id
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



    function delete_item(user_id) {

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

                url: 'ajax/user/delete.php',

                type: 'POST',

                dataType: 'json',

                data: {

                    user_id: user_id

                },

                success: function(data) {

                    if (data.result == 1) {

                        swal({

                            title: "ดำเนินการสำเร็จ",

                            text: "ลบข้อมูลสำเร็จ",

                            type: "success",

                            showConfirmButton: true

                        });


                        $("#tr_" + user_id).fadeOut(1000);

                        setTimeout(function() {

                            swal.close();

                        }, 1500);

                    }

                }

            });

        });

    }
</script>