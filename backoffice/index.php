<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">

  <title> WaterAdmin | Login</title>

  <link href="template/css/bootstrap.min.css" rel="stylesheet">
  <link href="template/font-awesome/css/font-awesome.css" rel="stylesheet">

  <link href="template/css/animate.css" rel="stylesheet">
  <link href="template/css/style.css" rel="stylesheet">

  <!--===============================================================================================-->
  <link rel="icon" type="image/png" href="images/icons/favicon.ico" />
  <!--===============================================================================================-->
  <link rel="stylesheet" type="text/css" href="../template/login_v2/vendor/bootstrap/css/bootstrap.min.css">
  <!--===============================================================================================-->
  <link rel="stylesheet" type="text/css" href="../template/login_v2/fonts/font-awesome-4.7.0/css/font-awesome.min.css">
  <!--===============================================================================================-->
  <link rel="stylesheet" type="text/css" href="../template/login_v2/fonts/iconic/css/material-design-iconic-font.min.css">
  <!--===============================================================================================-->
  <link rel="stylesheet" type="text/css" href="../template/login_v2/vendor/animate/animate.css">
  <!--===============================================================================================-->
  <link rel="stylesheet" type="text/css" href="../template/login_v2/vendor/css-hamburgers/hamburgers.min.css">
  <!--===============================================================================================-->
  <link rel="stylesheet" type="text/css" href="../template/login_v2/vendor/animsition/css/animsition.min.css">
  <!--===============================================================================================-->
  <link rel="stylesheet" type="text/css" href="../template/login_v2/vendor/select2/select2.min.css">
  <!--===============================================================================================-->
  <!-- <link rel="stylesheet" type="text/css" href="template/login_v2/vendor/daterangepicker/daterangepicker.css"> -->
  <!--===============================================================================================-->
  <link rel="stylesheet" type="text/css" href="../template/login_v2/css/util.css">
  <link rel="stylesheet" type="text/css" href="../template/login_v2/css/main.css">
  <!--===============================================================================================-->


  <link href="../template/css/plugins/sweetalert/sweetalert.css" rel="stylesheet">


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
          <a href="main/problem.php" class="dropdown-item">
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

  <div class="container-login100" style="background-image: url('../template/login_v2/images/water-bg.jpg');">
    <div class="wrap-login100 p-l-55 p-r-55 p-t-80 p-b-30">
      <form class="login100-form validate-form">
        <span class="login100-form-title p-b-37">
          ล็อกอิน
        </span>

        <!-- <input type="hidden" name="xapikey" value="85kd03#d!30dw"> -->

        <div class="wrap-input100 validate-input m-b-20" data-validate="Enter username">
          <input class="input100" type="text" id="username" name="username" placeholder="ชื่อผู้ใช้">
          <span class="focus-input100"></span>
        </div>

        <div class="wrap-input100 validate-input m-b-25" data-validate="Enter password">
          <input class="input100" type="password" id="password" name="password" placeholder="รหัสผ่าน">
          <span class="focus-input100"></span>
        </div>

        <div class="container-login100-form-btn">
          <button type="button" class="login100-form-btn" onclick="CheckLogin();">
            ล็อกอิน
          </button>
        </div>

        <!-- <p class="text-center" style="margin-top: 15px;">ยังไม่มีบัญชีผู้ใช้?? <strong><a href="frm_register.php">สมัครสมาชิก</a></strong></p> -->

      </form>

    </div>

    <!-- <div class="container-login100-form-btn">
      <button type="button" class="login200-form-btn" onclick="">
        สั่งน้ำ คลิก!!
      </button>
    </div> -->

  </div>



  <!-- <div class="wrapper fadeInDown">
    <div id="formContent">
     Icon -->
  <!-- <div class="fadeIn first">
        <label>LOGIN</label> -->
  <!-- <img src="http://danielzawadzki.com/codepen/01/icon.svg" id="icon" alt="User Icon" /> -->
  <!-- </div> -->

  <!-- Login Form -->

  <!-- <input type="hidden" name="xapikey" value="85kd03#d!30dw"> -->
  <!-- <input type="text" id="username" class="fadeIn second input-login" name="username" placeholder="Username">
      <input type="password" id="password" class="fadeIn third input-password" name="password" placeholder="Password">
      <br>
      <button onclick="CheckLogin();" class="fadeIn fourth btnn-login"> Log In</button> -->


  <!-- Remind Passowrd -->
  <!-- <div id="formFooter">
      <a class="underlineHover" href="#">Forgot Password?</a>
    </div> -->

  <!-- </div>
  </div> -->

  <div id="dropDownSelect1"></div>

  <!--===============================================================================================-->
  <script src="../template/login_v2/vendor/jquery/jquery-3.2.1.min.js"></script>
  <!--===============================================================================================-->
  <script src="../template/login_v2/vendor/animsition/js/animsition.min.js"></script>
  <!--===============================================================================================-->
  <script src="../template/login_v2/vendor/bootstrap/js/popper.js"></script>
  <script src="../template/login_v2/vendor/bootstrap/js/bootstrap.min.js"></script>
  <!--===============================================================================================-->
  <script src="../template/login_v2/vendor/select2/select2.min.js"></script>
  <!--===============================================================================================-->
  <script src="../template/login_v2/vendor/daterangepicker/moment.min.js"></script>
  <script src="../vendor/daterangepicker/daterangepicker.js"></script>
  <!--===============================================================================================-->
  <script src="../template/login_v2/vendor/countdowntime/countdowntime.js"></script>
  <!--===============================================================================================-->
  <script src="../template/login_v2/js/main.js"></script>

  <script src="../template/js/plugins/sweetalert/sweetalert.min.js"></script>
  <script src="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
  <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>

  <script>
    $('#username').keypress(function(event) {
      var keycode = (event.keyCode ? event.keyCode : event.which);
      if (keycode == '13') {
        CheckLogin();
      }
    });
    $('#password').keypress(function(event) {
      var keycode = (event.keyCode ? event.keyCode : event.which);
      if (keycode == '13') {
        CheckLogin();
      }
    });

    function CheckLogin() {
      var username = $('#username').val();
      var password = $('#password').val();

      if (username == "" || password == "") {
        swal({
          title: 'เกิดข้อผิดพลาด',
          text: 'กรุณากรอกชื่อและรหัสผ่าน',
          type: 'error'
        });
        return false;
      }

      // var remember = $("#remember");
      // if (remember.is(':checked')) {
      //     var remember_value = 1;
      // } else {
      //     var remember_value = 0;
      // }

      $.ajax({
        type: 'POST',
        url: 'auth.php',
        data: {
          username: username,
          password: password
        },
        dataType: 'json',
        success: function(data) {
          console.log(data);
          if (data.result == 1) {

            location.href = "main";

          }
          if (data.result == 2) {

            location.href = "system";

          }
          if (data.result == 0) {

            swal({
              title: "เกิดข้อผิดพลาด",
              text: "กรุณาตรวจสอบข้อมูล",
              type: "error"
              //Please Check Your Account
            }, function() {
              //location.reload();

            });
          }
        }
      })
    }
  </script>

</body>

</html>