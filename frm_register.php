<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title> Water | Register</title>

    <link href="template/css/bootstrap.min.css" rel="stylesheet">
    <link href="template/font-awesome/css/font-awesome.css" rel="stylesheet">

    <link href="template/css/animate.css" rel="stylesheet">
    <link href="template/css/style.css" rel="stylesheet">

    <!--===============================================================================================-->
    <link rel="icon" type="image/png" href="images/icons/favicon.ico" />
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="template/login_v2/vendor/bootstrap/css/bootstrap.min.css">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="template/login_v2/fonts/font-awesome-4.7.0/css/font-awesome.min.css">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="template/login_v2/fonts/iconic/css/material-design-iconic-font.min.css">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="template/login_v2/vendor/animate/animate.css">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="template/login_v2/vendor/css-hamburgers/hamburgers.min.css">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="template/login_v2/vendor/animsition/css/animsition.min.css">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="template/login_v2/vendor/select2/select2.min.css">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="template/login_v2/vendor/daterangepicker/daterangepicker.css">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="template/login_v2/css/util.css">
    <link rel="stylesheet" type="text/css" href="template/login_v2/css/main.css">
    <!--===============================================================================================-->


    <!--===============================================================================================-->
    <!-- <link rel="icon" type="image/png" href="template/login/images/icons/favicon.ico" /> -->
    <!--===============================================================================================-->
    <!-- <link rel="stylesheet" type="text/css" href="template/login/vendor/bootstrap/css/bootstrap.min.css"> -->
    <!--===============================================================================================-->
    <!-- <link rel="stylesheet" type="text/css" href="template/login/fonts/font-awesome-4.7.0/css/font-awesome.min.css"> -->
    <!--===============================================================================================-->
    <!-- <link rel="stylesheet" type="text/css" href="template/login/fonts/iconic/css/material-design-iconic-font.min.css"> -->
    <!--===============================================================================================-->
    <!-- <link rel="stylesheet" type="text/css" href="template/login/vendor/animate/animate.css"> -->
    <!--===============================================================================================-->
    <!-- <link rel="stylesheet" type="text/css" href="template/login/vendor/css-hamburgers/hamburgers.min.css"> -->
    <!--===============================================================================================-->
    <!-- <link rel="stylesheet" type="text/css" href="template/login/vendor/animsition/css/animsition.min.css"> -->
    <!--===============================================================================================-->
    <!-- <link rel="stylesheet" type="text/css" href="template/login/vendor/select2/select2.min.css"> -->
    <!--===============================================================================================-->
    <!-- <link rel="stylesheet" type="text/css" href="template/login/vendor/daterangepicker/daterangepicker.css"> -->
    <!--===============================================================================================-->
    <!-- <link rel="stylesheet" type="text/css" href="template/login/css/util.css"> -->
    <!-- <link rel="stylesheet" type="text/css" href="template/login/css/main.css"> -->
    <!--===============================================================================================-->

    <link href="template/css/plugins/sweetalert/sweetalert.css" rel="stylesheet">


    <!-- <link rel="stylesheet" type="text/css" href="template/login/css/login.css"> -->

    <link href="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
    <style>
        .sweet-alert input {
            display: none;
        }

        .header {
            padding: 5px;
            background: #a79ffe;
            color: white;
            font-size: 5px;
        }

        .header_left {
            float: left;
            font-size: 20px;
            margin-left: 15px;
        }

        .header_right {
            float: right;
            margin-top: -37px;
            font-size: 20px;
            margin-right: 5px;
        }
    </style>


</head>

<body>

    <div class="header">

        <li class="dropdown">
            <a class="header_left" data-toggle="dropdown">
                <i class="fa fa-bars" aria-hidden="true"></i>
            </a>
            <ul class="dropdown-menu dropdown-alerts">
                <!-- <li>
          <a href="mailbox.html" class="dropdown-item">
            <div>
              <i class="fa fa-sign-in"></i> เข้าสู่ระบบ
            </div>
          </a>
        </li>
        <li class="dropdown-divider"></li> -->
                <li>
                    <a href="profile.html" class="dropdown-item">
                        <div>
                            <i class="fa fa-exclamation-triangle"></i> รายงานปัญหา
                        </div>
                    </a>
                </li>
                <!-- <li class="dropdown-divider"></li> -->


            </ul>
        </li>

        <a class="header_left"> <i class="fa fa-user" aria-hidden="true" style="margin-left: 10px;"></i></a>

        <h4 class="text-center">พรสำราญ</h4>
        <a class="header_right"><i class="fa fa-shopping-bag" aria-hidden="true"></i></a>
    </div>

    <div class="container-login100" style="background-image: url('template/login_v2/images/water-bg.jpg');">

        <div class="wrap-login100 p-l-55 p-r-55 p-t-80 p-b-30">

            <form class="login100-form validate-form" id="frm_regis">
                <span class="login100-form-title p-b-37">
                    สมัครสมาชิก
                </span>

                <div class="form-group">
                    <label>ชื่อผู้ใช้</label>
                    <font color="red">**</font>
                    <input type="text" name="username" class="form-control" id="username" placeholder="" autocomplete="off">
                </div>

                <div class="form-group">
                    <label>รหัสผ่าน</label>
                    <font color="red">**</font>
                    <input type="password" name="password" class="form-control" id="password" placeholder="" autocomplete="off">
                </div>

                <div class="form-group">
                    <label>เบอร์โทรศัพท์</label>
                    <font color="red">**</font>
                    <input type="text" name="phone" class="form-control" id="phone" placeholder="" autocomplete="off">
                </div>

                <div class="form-group">
                    <label>ที่อยู่</label>
                    <!-- <font color="red">**</font> -->
                    <textarea class="form-control summernote" rows="3" name="address" id="address"></textarea>
                </div>

                <div class="container-login100-form-btn">
                    <button type="button" class="login100-form-btn" id="btn_submit">
                        สมัครสมาชิก
                    </button>
                </div>

            </form>

            <a href="index.php"><p class="text-center" style="margin-top: 15px;"><i class="fa fa-home" aria-hidden="true"></i>กลับหน้าหลัก</p></a>

        </div>
    </div>


    <div id="dropDownSelect1"></div>

    <!--===============================================================================================-->
    <script src="template/login_v2/vendor/jquery/jquery-3.2.1.min.js"></script>
    <!--===============================================================================================-->
    <script src="template/login_v2/vendor/animsition/js/animsition.min.js"></script>
    <!--===============================================================================================-->
    <script src="template/login_v2/vendor/bootstrap/js/popper.js"></script>
    <script src="template/login_v2/vendor/bootstrap/js/bootstrap.min.js"></script>
    <!--===============================================================================================-->
    <script src="template/login_v2/vendor/select2/select2.min.js"></script>
    <!--===============================================================================================-->
    <script src="template/login_v2/vendor/daterangepicker/moment.min.js"></script>
    <!-- <script src="vendor/daterangepicker/daterangepicker.js"></script> -->
    <!--===============================================================================================-->
    <script src="template/login_v2/vendor/countdowntime/countdowntime.js"></script>
    <!--===============================================================================================-->
    <script src="template/login_v2/js/main.js"></script>

    <!-- <script src="template/login/vendor/jquery/jquery-3.2.1.min.js"></script> -->
    <!--===============================================================================================-->
    <!-- <script src="template/login/vendor/animsition/js/animsition.min.js"></script> -->
    <!--===============================================================================================-->
    <!-- <script src="template/login/vendor/bootstrap/js/popper.js"></script> -->
    <!-- <script src="template/login/vendor/bootstrap/js/bootstrap.min.js"></script> -->
    <!--===============================================================================================-->
    <!-- <script src="template/login/vendor/select2/select2.min.js"></script> -->
    <!--===============================================================================================-->
    <!-- <script src="template/login/vendor/daterangepicker/moment.min.js"></script> -->
    <!-- <script src="template/login/vendor/daterangepicker/daterangepicker.js"></script> -->
    <!--===============================================================================================-->
    <!-- <script src="template/login/vendor/countdowntime/countdowntime.js"></script> -->
    <!--===============================================================================================-->
    <!-- <script src="template/login/js/main.js"></script> -->

    <script src="template/js/plugins/sweetalert/sweetalert.min.js"></script>
    <script src="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>

    <!-- Mainly scripts -->
    <script src="template/js/jquery-3.1.1.min.js"></script>

    <!-- jQuery UI -->
    <script src="template/js/plugins/jquery-ui/jquery-ui.min.js"></script>

    <script src="template/js/popper.min.js"></script>
    <script src="template/js/bootstrap.js"></script>
    <script src="template/js/plugins/metisMenu/jquery.metisMenu.js"></script>
    <script src="template/js/plugins/slimscroll/jquery.slimscroll.js"></script>

    <!-- Data TAble -->
    <script src="template/js/plugins/dataTables/datatables.min.js"></script>
    <script src="template/js/plugins/dataTables/dataTables.bootstrap4.min.js"></script>

    <!-- Flot -->
    <script src="template/js/plugins/flot/jquery.flot.js"></script>
    <script src="template/js/plugins/flot/jquery.flot.tooltip.min.js"></script>
    <script src="template/js/plugins/flot/jquery.flot.spline.js"></script>
    <script src="template/js/plugins/flot/jquery.flot.resize.js"></script>
    <script src="template/js/plugins/flot/jquery.flot.pie.js"></script>

    <!-- Peity -->
    <script src="template/js/plugins/peity/jquery.peity.min.js"></script>
    <script src="template/js/demo/peity-demo.js"></script>

    <!-- Custom and plugin javascript -->
    <script src="template/js/inspinia.js"></script>
    <script src="template/js/plugins/pace/pace.min.js"></script>


    <!-- GITTER -->
    <script src="template/js/plugins/gritter/jquery.gritter.min.js"></script>

    <!-- Sparkline -->
    <script src="template/js/plugins/sparkline/jquery.sparkline.min.js"></script>

    <!-- Sparkline demo data  -->
    <script src="template/js/demo/sparkline-demo.js"></script>

    <!-- ChartJS-->
    <script src="template/js/plugins/chartJs/Chart.min.js"></script>

    <!-- Toastr -->
    <script src="template/js/plugins/toastr/toastr.min.js"></script>


    <!-- Sweet alert -->
    <script src="template/js/plugins/sweetalert/sweetalert.min.js"></script>

    <!-- Thailand -->
    <!-- <script type="text/javascript" src="vendor/jquery.Thailand.js/dist/jquery.Thailand.min.js"></script>
	<script type="text/javascript" src="vendor/jquery.Thailand.js/dependencies/JQL.min.js"></script>
	<script type="text/javascript" src="vendor/jquery.Thailand.js/dependencies/typeahead.bundle.js"></script> -->
    <!-- Data picker -->
    <script src="template/js/plugins/datapicker/bootstrap-datepicker.js"></script>

    <!-- Select2 -->
    <script src="template/js/plugins/select2/select2.full.min.js"></script>

    <!-- SUMMERNOTE -->
    <script src="template/js/plugins/summernote/summernote-bs4.js"></script>

    <!-- Switchery -->
    <script src="template/js/plugins/switchery/switchery.js"></script>
    <!-- iCheck -->
    <script src="template/js/plugins/iCheck/icheck.min.js"></script>

    <!-- Chart c3-->
    <script src="template/js/plugins/d3/d3.min.js"></script>
    <script src="template/js/plugins/c3/c3.min.js"></script>

    <!-- Clock picker -->
    <script src="template/js/plugins/clockpicker/clockpicker.js"></script>

    <script src="template/js/plugins/chosen/chosen.jquery.js"></script>

    <script>
        $('#btn_submit').on('click', function() {
            submit();
        })



        function submit() {
            var file = $('.custom-file-input').val();
            var username = $('#username').val();
            var password = $('#password').val();
            var phone = $('#phone').val();

            var formData = new FormData($("#frm_regis")[0]);

            if (username == "" || password == "" || phone == "") {
                swal({
                    title: 'เกิดข้อผิดพลาด',
                    text: 'กรุณากรอกข้อมูลครบถ้วน',
                    type: 'error'
                });
                return false;
            }
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
                    type: 'POST',
                    url: 'register.php',
                    data: formData,
                    processData: false,
                    contentType: false,
                    dataType: 'json',
                    success: function(data) {
                        if (data.result == 0) {
                            swal({
                                title: 'ผิดพลาด!',
                                text: 'มีชื่อผู้ใช้นี้แล้ว',
                                type: 'warning'
                            });
                            return false;
                        }
                        if (data.result == 1) {
                            $('#modal').modal('hide');
                            swal({
                                title: "ดำเนินการสำเร็จ!",
                                text: "ทำการบันทึกรายการ เรียบร้อย",
                                type: "success",
                                showConfirmButton: true
                            }, function() {
                                location.href = "index.php";
                            });


                        }
                    }
                })
            });
        }
    </script>

</body>

</html>