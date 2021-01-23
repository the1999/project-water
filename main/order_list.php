<?php
include_once('header.php');
// $secure = "OMP?JFC/p|og^JP";
$connection = connectDB();

$member_id = $_SESSION['member_id'];
$order_id = $_GET['id'];

?>

<div class="container-login100" style="background-image: url('../template/login_v2/images/water-bg.jpg');">
    <div class="wrap-login100 p-l-55 p-r-55 p-t-80 p-b-30" style="width: 75%;">
        <h4 class="text-center" style="margin-top: -53px;">สั่งซื้อน้ำดื่ม</h4>

        <form id="frm_order" method="POST" enctype="multipart/form-data">

            <!-- <input type="hidden" name="product_id"> -->

            <!-- <input type="hidden" name="price"> -->

            <div class="ibox-content">
                <!-- <div id="Loading">
                        <div class="spiner-example">
                            <div class="sk-spinner sk-spinner-wave">
                                <div class="sk-rect1"></div>
                                <div class="sk-rect2"></div>
                                <div class="sk-rect3"></div>
                                <div class="sk-rect4"></div>
                                <div class="sk-rect5"></div>
                            </div>
                        </div>
                    </div> -->
                <div id="show_table"></div>



                <div style="float: left;margin-top: 40px;">
                    <a href="index.php">
                        <p><i class="fa fa-home" aria-hidden="true"></i> กลับหน้าหลัก</p>
                    </a>

                </div>

                <div style="float: right;margin-top: 25px;">

                   

                        <a href="transfer.php?id=<?php echo $order_id; ?>">
                            <button type="button" class="login200-form-btn">
                                ชำระเงิน
                            </button>
                        </a>

                  

                    <!-- <label>
                        <button type="button" class="login200-form-btn" onclick="submit_insert();">
                            สั่งซื้อ
                        </button>
                    </label> -->

                </div>

        </form>

    </div>
</div>




<?php include('import_script.php'); ?>

<script>
    $(document).ready(function() {
        load_table();
    });

    function load_table() {
        $.ajax({
            type: 'POST',
            url: 'ajax/order_list/get_table.php',
            data: {},
            dataType: 'html',
            success: function(response) {
                $('#show_table').html(response);
                $('.dataTables-example').DataTable({
                    pageLength: 25,
                    responsive: true,
                });
                $('#Loading').hide();
            }
        });
    }
</script>

</body>

</html>