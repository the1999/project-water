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

                <th width="15%">เลขที่คำสั่งซื้อ</th>

                <th width="20%">ผู้ซื้อ</th>

                <th width="10%">รายการสินค้า</th>

                <th width="10%">จำนวนสินค้า</th>

                <th width="12%">จำนวนเงิน</th>

                <th width="10%">วันที่โอน</th>

                <th width="5%">สถานะ</th>

                <th width="5%"></th>

            </tr>

        </thead>

        <tbody>

            <?php

            $sql = "SELECT a.*,b.username,address,phone FROM tbl_order_head a
                    LEFT JOIN tbl_member b ON a.member_id = b.member_id
                    ORDER BY a.order_date DESC
                    ";

            $rs = mysqli_query($connection, $sql) or die($connection->error);

            $i = 0;

            while ($row = mysqli_fetch_assoc($rs)) {


            if($row['approve_payment_date'] == NULL) {
                $approve_payment_date = "";
            } else {
                $approve_payment_date = date("d/m/Y", strtotime($row['approve_payment_date']));
            }

            //หารายการ
            $sql2 = "SELECT a.*,b.product_name
                    FROM tbl_order_detail a
                    LEFT JOIN tbl_product b ON a.product_id = b.product_id
                    where a.order_id ='".$row['order_id']."' ORDER BY a.list_order DESC";
            //echo    $sql2;
            $rs2  = mysqli_query($connection, $sql2);

            while($row2 = mysqli_fetch_assoc($rs2)) {

                $i++;

            ?>

                <tr id="tr_<?php echo $row['order_id']; ?>">

                    <td><?php echo $i; ?></td>


                    <td>
                        <?php echo $row['order_no']; ?> <br>
                        <strong>วันที่ : </strong><?php echo date('d/m/Y', strtotime($row['order_date'])); ?> <br>
                        <strong>เวลา : </strong><?php echo date('H:i:s', strtotime($row['order_date'])); ?>
                    </td>

                    <td>
                        <strong>ชื่อ : </strong><?php echo $row['username']; ?> <br>
                        <strong>ที่อยู่ : </strong><?php echo $row['address']; ?> <br>
                        <strong>โทร. : </strong><?php echo $row['phone']; ?>
                    </td>


                    <td>
                        <?php
                            echo $row2['product_name'];
                        ?>
                    </td>

                    <td>
                        <?php
                        echo $row2['quantity'];
                        ?>
                    </td>

                    <td>
                        <?php echo number_format($row['payment_amont'],2); ?>
                    </td>

                    <td>
                        <?php echo $approve_payment_date; ?>
                    </td>


                    <td>

                        <select class="form-control chosen-select" id="status" name="status" data-width="100%" onchange="Changestatus('<?php echo $row['order_id']; ?>',this.value);">

                            <option value="0" <?php if($row['status'] == 0) { echo 'selected'; } ?> >รอชำระเงิน</option>
                            <option value="1" <?php if($row['status'] == 1) { echo 'selected'; } ?> >ชำระเงินแล้ว</option>
                            <option value="2" <?php if($row['status'] == 2) { echo 'selected'; } ?> >ชำระเงินปลายทาง</option>
                            <option value="3" <?php if($row['status'] == 3) { echo 'selected'; } ?> >กำลังจัดส่ง</option>
                            <option value="4" <?php if($row['status'] == 4) { echo 'selected'; } ?> >จัดส่งแล้ว</option>
                            <option value="5" <?php if($row['status'] == 5) { echo 'selected'; } ?> >ยกเลิก</option>
                        </select>

                    </td>

                    <td class="text-center">
                        <?php
                        $url = "";
                        if ($row['payment_slip'] == NULL) {
                            $url = 'no-image.jpg';
                        } else {
                            $url ='payment/'. $row['payment_slip'];
                        } ?>


                        <a target="_bank" href="../../image/<?php echo $url; ?>">
                            <button class="btn-primary btn btn-xs"> ดูหลักฐานการโอน</button>
                        </a>

<!--                        <button class="btn-warning btn btn-xs btn-block" onclick="modalStatus('<?php //echo $row['order_id']; ?>')" style="margin-top: 10px;"> เปลี่ยนสถานะการจัดส่ง</button>-->


                    </td>


                <?php
                    }
                }
                ?>

        </tbody>

    </table>

</div>


<script>

    $('.chosen-select').chosen({
        no_results_text: "Oops, nothing found!",
        width: "100%"
    });


    // function modalStatus(order_id) {
    //
    //     $('#modal').modal('show');
    //
    //     $('#show_modal').load("ajax/order/modalStatus.php", {
    //         order_id: order_id
    //     });
    //
    // }


    // function Changestatus(order_id)
    //
    // {
    //
    //     $.ajax({
    //
    //         type: 'POST',
    //
    //         url: 'ajax/ChangeStatus.php',
    //
    //         data: {
    //
    //             table_name: "tbl_order_head",
    //
    //             key_name: "order_id",
    //
    //             key_value: order_id
    //
    //         },
    //
    //         dataType: 'json',
    //
    //         success: function(data) {
    //
    //             load_table();
    //
    //         }
    //
    //     });
    //
    // }

    function Changestatus(order_id,status) {

        // var status = $('#status').val();

        $.ajax({

            url: 'ajax/order/updateStatus.php',

            type: 'POST',

            dataType: 'json',

            data: {

                order_id: order_id,
                status: status

            },

            success: function(data) {

                if (data.result == 1) {

                    swal({

                        title: "ดำเนินการสำเร็จ",

                        text: "ทำการเปลี่ยนสถานะสำเร็จ",

                        type: "success",

                        showConfirmButton: true

                    });

                   load_table();

                }

            }

        });
    }

</script>