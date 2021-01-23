<?php
include_once('header.php');
// $secure = "OMP?JFC/p|og^JP";
$connection = connectDB();

?>
<style>
    /*.modal.inmodal.fade:not(.in).right .modal-dialog {*/
    /*    -webkit-transform: translate3d(25%, 0, 0);*/
    /*    transform: translate3d(200%, 0, 0);*/
    /*}*/
</style>

<div class="container-login100" style="background-image: url('../template/login_v2/images/water-bg.jpg');">
  <div class="wrap-login100 p-l-55 p-r-55 p-t-80 p-b-30" style="width: 75%;">

    <div class="wrapper wrapper-content animated fadeInRight">
      <div class="row">
        <div class="col-lg-12">
          <div class="ibox" style="margin-top: -53px;">
<!--            <div class="ibox-title text-center" style="margin-top: -53px;">-->
                <div class="row">
                    <div class="col-md-2">
                        <a>
                            <button class="btn btn-info btn-sm dim btn-block active" onclick="activeBTN(this),load_table_his();">
                                <i class="fa fa-history" aria-hidden="true"></i><br>
                                <label> ประวัติการซื้อ</label>
                            </button>
                        </a>
                    </div>
                    <div class="col-md-2">
                        <a>
                            <button class="btn btn-info btn-sm dim btn-block" onclick="activeBTN(this),load_table_payment();">
                                <i class="fa fa-shopping-cart" aria-hidden="true"></i><br>
                                <label> ที่ต้องชำระ</label>
                            </button>
                        </a>
                    </div>
                    <div class="col-md-2">
                        <a>
                            <button class="btn btn-info btn-sm dim btn-block" onclick="activeBTN(this),load_table_price();">
                                <i class="fa fa-check-square" aria-hidden="true"></i><br>
                                <label style="font-size: 10px;"> ชำระเงินแล้ว/<br>เก็บเงินปลายทาง</label>
                            </button>
                        </a>
                    </div>
                    <div class="col-md-2">
                        <a>
                            <button class="btn btn-info btn-sm dim btn-block" onclick="activeBTN(this),load_table_deli();">
                                <i class="fa fa-truck" aria-hidden="true"></i><br>
                                <label> กำลังจัดส่ง</label>
                            </button>
                        </a>
                    </div>
                    <div class="col-md-2">
                        <a>
                            <button class="btn btn-info btn-sm dim btn-block" onclick="activeBTN(this),load_table_box();">
                                <i class="fa fa-dropbox" aria-hidden="true"></i><br>
                                <label> จัดส่งแล้ว</label>
                            </button>
                        </a>
                    </div>
                    <div class="col-md-2">
                        <a>
                            <button class="btn btn-info btn-sm dim btn-block" onclick="activeBTN(this),load_table_cancel();">
                                <i class="fa fa-window-close" aria-hidden="true"></i><br>
                                <label>ยกเลิก</label>
                            </button>
                        </a>
                    </div>
                </div>

              <!-- <div class="ibox-tools">
                        <button class="btn btn-primary btn-xs" data-toggle="modal" data-target="#modal" onclick="modal_insert();"><i class="fa fa-plus"></i> เพิ่มผู้ใช้งาน </button>
                    </div> -->
<!--            </div>-->
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

    <div class="container-login100-form-btn">
      <a href="order.php">
        <button type="button" class="login200-form-btn" onclick="">
          สั่งน้ำ คลิก!!
        </button>
      </a>
    </div>

<!--    <div class="modal fade" id="modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" data-keyboard="false" data-backdrop="static">-->
<!--      <div class="modal-dialog modal-lg modal-dialog-centered" role="document">-->
<!--        <div class="modal-content">-->
<!--          <div id="show_modal"></div>-->
<!--        </div>-->
<!--      </div>-->
<!--    </div>-->



  </div>
</div>

<div class="modal inmodal fade" id="myModal6" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" data-keyboard="false" data-backdrop="static">
    <div class="modal-dialog modal-sm">
        <div class="modal-content">
            <div id="show_modal6"></div>

        </div>
    </div>
</div>


<?php include('import_script.php'); ?>

<script>
  $(document).ready(function() {
      load_table_his();
      showCancel();

  });

  function showCancel() {

      $.ajax({
          type: 'POST',
          url: 'ajax/index/showCancel.php',
          data: {},
          dataType: 'json',
          success: function(data) {

              if (data.count > 0) {
                  $('#myModal6').modal('show');
                  $('#show_modal6').load("ajax/index/modalShowCancel.php");
              }
          }
      });
  }

  function activeBTN (el) {
      $('.dim').removeClass( "active");
      $(el).addClass( "active");
      // if ($(el).hasClass( "active")) {
      //     $(el).removeClass( "active");
      // } else {
      //     $(el).addClass( "active");
      // }
  }

  function load_table_his() {
    $.ajax({
      type: 'POST',
      url: 'ajax/index/get_table_index.php',
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

  function load_table_payment() {
      $.ajax({
          type: 'POST',
          url: 'ajax/index/get_table_payment.php',
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

  function load_table_price() {
      $.ajax({
          type: 'POST',
          url: 'ajax/index/get_table_price.php',
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

  function load_table_deli() {
      $.ajax({
          type: 'POST',
          url: 'ajax/index/get_table_deli.php',
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

  function load_table_box() {
      $.ajax({
          type: 'POST',
          url: 'ajax/index/get_table_box.php',
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

  function load_table_cancel() {
      $.ajax({
          type: 'POST',
          url: 'ajax/index/get_table_cancel.php',
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