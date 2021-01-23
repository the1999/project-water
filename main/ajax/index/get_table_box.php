<?php

session_start();

include('../../../config/main_function.php');

// $secure = "OMP?JFC/p|og^JP";
$connection = connectDB();

$member_id = $_SESSION['member_id'];

?>

<div class="table-responsive">

    <table class="table table-striped dataTables-example">

        <thead>

        <tr>

            <th>#</th>

            <th>เลขที่คำสั่งซื้อ</th>

            <th>วันที่สั่งซื้อ</th>

            <th width="17%">รายการสินค้า</th>

            <th>จำนวนสินค้า</th>

            <th>จำนวนเงิน</th>

            <th width="15%">สถานะ</th>

            <th width="10%"> </th>

        </tr>

        </thead>

        <tbody>

        <?php

        $sql = "SELECT * FROM tbl_order_head WHERE member_id = '$member_id' 
                AND status = 4 
                ORDER BY order_date DESC ";

        $rs = mysqli_query($connection, $sql) or die($connection->error);

        $i = 0;

        while ($row = mysqli_fetch_assoc($rs)) {


        //หารายการ
        $sql2 = "SELECT a.*,b.product_name
                    FROM tbl_order_detail a
                    LEFT JOIN tbl_product b ON a.product_id = b.product_id
                    where a.order_id ='".$row['order_id']."' ORDER BY a.list_order DESC";
        //echo    $sql2;
        $rs2  = mysqli_query($connection, $sql2);
        $arrBook = array();
        while($row2 = mysqli_fetch_assoc($rs2)) {

        $i++;

        ?>

        <tr id="tr_<?php echo $row['order_id']; ?>">

            <td><?php echo $i; ?></td>


            <td>
                <?php echo $row['order_no']; ?>
            </td>

            <td>
                <?php echo date('d-m-Y H:i:s', strtotime($row['order_date'])); ?>
            </td>

            <td>
                <?php echo $row2['product_name']; ?>
            </td>

            <td>
                <?php echo $row2['quantity']; ?>
            </td>

            <td>
                <?php echo $row['payment_amont']; ?>
            </td>

            <td>
                <?php if ($row['status'] == 0) {
                    echo "รอชำระเงิน";
                } else if ($row['status'] == 1) {
                    echo "ชำระเงินแล้ว";
                } else if ($row['status'] == 2) {
                    echo "ชำระเงินปลายทาง";
                } else if ($row['status'] == 3) {
                    echo "กำลังจัดส่ง";
                } else if ($row['status'] == 4) {
                    echo "จัดส่งแล้ว";
                } else if ($row['status'] == 5) {
                    echo "ยกเลิก";
                } else if ($row['status'] == 6) {
                    echo "รออนุมัติการชำระเงิน";
                }
                ?>
            </td>

            <td class="text-center">

                <div class="btn-group">

                    <button class="btn-danger btn btn-xs" onclick="delete_item('<?php echo $row['order_id']; ?>');"><i class="fa fa-close"></i> ลบ</button>

                </div>

            </td>


            <?php
            }
            }
            ?>

        </tbody>

    </table>

</div>

<script>
    // function modal_insert() {

    //     $('#modal').modal('show');

    //     $('#show_modal').load("ajax/user/modal_insert.php");

    // }



    // function modal_edit(user_id) {

    //     $('#modal').modal('show');

    //     $('#show_modal').load("ajax/user/modal_edit.php", {
    //         user_id: user_id
    //     });

    // }





    function delete_item(order_id) {

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

                url: 'ajax/index/delete.php',

                type: 'POST',

                dataType: 'json',

                data: {

                    order_id: order_id

                },

                success: function(data) {

                    if (data.result == 1) {

                        swal({

                            title: "ดำเนินการสำเร็จ",

                            text: "ลบข้อมูลสำเร็จ",

                            type: "success",

                            showConfirmButton: true

                        });

                        load_table();

                    }

                }

            });

        });

    }
</script>