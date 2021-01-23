<!DOCTYPE html>

<?php

include('../config/check_session.php');

?>
<html>

<head>

  <meta charset="utf-8">

  <meta name="viewport" content="width=device-width, initial-scale=1.0">

  <meta http-equiv="X-UA-Compatible" content="IE=edge">

  <title>Water</title>

  <link href="../template/css/bootstrap.min.css" rel="stylesheet">
  <link href="../template/font-awesome/css/font-awesome.css" rel="stylesheet">

  <link href="../template/css/animate.css" rel="stylesheet">
  <link href="../template/css/style.css" rel="stylesheet">

  <!--===============================================================================================-->
  <link rel="icon" type="image/png" href="../images/icons/favicon.ico" />
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

  <!-- Toastr style -->

  <link href="../template/css/plugins/toastr/toastr.min.css" rel="stylesheet">

  <!-- Gritter -->

  <link href="../template/js/plugins/gritter/jquery.gritter.css" rel="stylesheet">

  <link href="../template/css/plugins/dataTables/datatables.min.css" rel="stylesheet">

  <link href="../template/css/plugins/touchspin/jquery.bootstrap-touchspin.min.css" rel="stylesheet">


  <link href="../template/css/plugins/dualListbox/bootstrap-duallistbox.min.css" rel="stylesheet">


  <link href="../template/css/animate.css" rel="stylesheet">

  <link href="../template/css/plugins/summernote/summernote-bs4.css" rel="stylesheet">


  <link href="../template/css/plugins/iCheck/custom.css" rel="stylesheet">



  <link href="../template/css/plugins/chosen/bootstrap-chosen.css" rel="stylesheet">



  <link href="../template/css/plugins/bootstrap-tagsinput/bootstrap-tagsinput.css" rel="stylesheet">



  <link href="../template/css/plugins/colorpicker/bootstrap-colorpicker.min.css" rel="stylesheet">



  <!-- <link href="../template/css/plugins/cropper/cropper.min.css" rel="stylesheet"> -->



  <link href="../template/css/plugins/switchery/switchery.css" rel="stylesheet">


  <link href="../template/css/plugins/jasny/jasny-bootstrap.min.css" rel="stylesheet">


  <link href="../template/css/plugins/nouslider/jquery.nouislider.css" rel="stylesheet">


  <link href="../template/css/plugins/datapicker/datepicker3.css" rel="stylesheet">


  <link href="../template/css/plugins/ionRangeSlider/ion.rangeSlider.css" rel="stylesheet">


  <link href="../template/css/plugins/ionRangeSlider/ion.rangeSlider.skinFlat.css" rel="stylesheet">


  <link href="../template/css/plugins/awesome-bootstrap-checkbox/awesome-bootstrap-checkbox.css" rel="stylesheet">


  <link href="../template/css/plugins/clockpicker/clockpicker.css" rel="stylesheet">


  <link href="../template/css/plugins/daterangepicker/daterangepicker-bs3.css" rel="stylesheet">


  <link href="../template/css/plugins/select2/select2.min.css" rel="stylesheet">

  <!-- Sweet Alert -->

  <link href="../template/css/plugins/sweetalert/sweetalert.css" rel="stylesheet">



  <!-- Drop Zone -->

  <link href="../template/css/plugins/dropzone/basic.css" rel="stylesheet">

  <link href="../template/css/plugins/dropzone/dropzone.css" rel="stylesheet">

  <link href="../template/css/plugins/codemirror/codemirror.css" rel="stylesheet">



  <link href="../template/css/plugins/blueimp/css/blueimp-gallery.min.css" rel="stylesheet">

  <link href="../template/css/plugins/morris/morris-0.4.3.min.css" rel="stylesheet">

  <!-- C3 -->

  <link href="../template/css/plugins/c3/c3.min.css" rel="stylesheet">


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

    .bag {
      line-height: 10px;
      padding: 2px 5px;
      position: absolute;
      right: 14px;
      top: -19px;
      font-size: 10px;
    }
  </style>

</head>

<script>
  function LogoutConfirm() {
    window.location.href = '../';

  }
</script>



<?php

$member_id = $_SESSION['member_id'];
$sql_user = "SELECT username FROM tbl_member WHERE member_id = '$member_id' ;";
$rs_user  = mysqli_query($connection, $sql_user);
$row_user = mysqli_fetch_array($rs_user);
$pagename = basename($_SERVER['PHP_SELF']);
?>

<!-- <body class="mini-navbar"> -->

<body>

  <div class="header">

    <li class="dropdown">
      <a class="header_left" data-toggle="dropdown">
        <i class="fa fa-bars" aria-hidden="true"></i>
      </a>
      <ul class="dropdown-menu dropdown-alerts">
        <li>
          <a onclick="LogoutConfirm();" class="dropdown-item">
            <div>
              <i class="fa fa-sign-out"></i> ออกจากระบบ
            </div>
          </a>
        </li>
        <li class="dropdown-divider"></li>
        <li>
          <a href="problem.php" class="dropdown-item">
            <div>
              <i class="fa fa-exclamation-triangle"></i> รายงานปัญหา
            </div>
          </a>
        </li>
        <!-- <li class="dropdown-divider"></li> -->


      </ul>
    </li>

    <a class="header_left"> <i class="fa fa-user" aria-hidden="true" style="margin-left: 10px;"></i> <?php echo $row_user['username']; ?></a>

    <h4 class="text-center">พรสำราญ</h4>

    <li class="dropdown">

      <a class="count-info header_right" data-toggle="dropdown" id="list_bag">
        <i class="fa fa-shopping-bag"></i> 
        
      </a>
      <!-- <a class="header_right" data-toggle="dropdown">
        <i class="fa fa-shopping-bag" aria-hidden="true"></i>
      </a> -->
      <ul class="dropdown-menu dropdown-alerts">
        <div id="show_bag"></div>
      
        <!-- <li class="dropdown-divider"></li>
    <li>
      <a href="problem.php" class="dropdown-item">
        <div>
          <i class="fa fa-exclamation-triangle"></i> รายงานปัญหา
        </div>
      </a>
    </li> -->
        <!-- <li class="dropdown-divider"></li> -->


      </ul>
    </li>


  </div>