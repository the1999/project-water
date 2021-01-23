<?php
include_once('header.php');
// $secure = "OMP?JFC/p|og^JP";
$connection = connectDB();

?>

<div class="container-login100" style="background-image: url('../template/login_v2/images/water-bg.jpg');">
  <div class="wrap-login100 p-l-55 p-r-55 p-t-80 p-b-30" style="width: 75%;">

    <div class="wrapper wrapper-content animated fadeInRight">
      <div class="row">
        <div class="col-lg-12">
          <div class="ibox">
            <div class="ibox-title" style="margin-top: -53px;">
              <label> รายการสินค้า</label>
              <div class="ibox-tools">
                <button class="btn btn-primary btn-xs" data-toggle="modal" data-target="#modal" onclick="modal_insert();" style="margin-top: -5px;"><i class="fa fa-plus"></i> เพิ่มสินค้า </button>
              </div>
            </div>
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
            </div>
          </div>
        </div>
      </div>
    </div>

    <!--   <div class="container-login100-form-btn">
      <a href="order.php">
        <button type="button" class="login200-form-btn" onclick="">
          สั่งน้ำ คลิก!!
        </button>
      </a>
    </div> -->



  </div>
</div>
<div class="modal fade" id="modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" data-keyboard="false" data-backdrop="static">
  <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
    <div class="modal-content">
      <div id="show_modal"></div>
    </div>
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
      url: 'ajax/product/get_table_product.php',
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