<!-- Mainly scripts -->
<script src="../template/js/jquery-3.1.1.min.js"></script>

<!-- jQuery UI -->
<script src="../template/js/plugins/jquery-ui/jquery-ui.min.js"></script>

<script src="../template/js/popper.min.js"></script>
<script src="../template/js/bootstrap.js"></script>
<script src="../template/js/plugins/metisMenu/jquery.metisMenu.js"></script>
<script src="../template/js/plugins/slimscroll/jquery.slimscroll.js"></script>

<!-- Data TAble -->
<script src="../template/js/plugins/dataTables/datatables.min.js"></script>
<script src="../template/js/plugins/dataTables/dataTables.bootstrap4.min.js"></script>

<!-- Flot -->
<script src="../template/js/plugins/flot/jquery.flot.js"></script>
<script src="../template/js/plugins/flot/jquery.flot.tooltip.min.js"></script>
<script src="../template/js/plugins/flot/jquery.flot.spline.js"></script>
<script src="../template/js/plugins/flot/jquery.flot.resize.js"></script>
<script src="../template/js/plugins/flot/jquery.flot.pie.js"></script>

<!-- Peity -->
<script src="../template/js/plugins/peity/jquery.peity.min.js"></script>
<script src="../template/js/demo/peity-demo.js"></script>

<!-- Custom and plugin javascript -->
<script src="../template/js/inspinia.js"></script>
<script src="../template/js/plugins/pace/pace.min.js"></script>


<!-- GITTER -->
<script src="../template/js/plugins/gritter/jquery.gritter.min.js"></script>

<!-- Sparkline -->
<script src="../template/js/plugins/sparkline/jquery.sparkline.min.js"></script>

<!-- Sparkline demo data  -->
<script src="../template/js/demo/sparkline-demo.js"></script>

<!-- ChartJS-->
<script src="../template/js/plugins/chartJs/Chart.min.js"></script>

<!-- Toastr -->
<script src="../template/js/plugins/toastr/toastr.min.js"></script>


<!-- Sweet alert -->
<script src="../template/js/plugins/sweetalert/sweetalert.min.js"></script>

<!-- Thailand -->
<!-- <script type="text/javascript" src="../vendor/jquery.Thailand.js/dist/jquery.Thailand.min.js"></script>
	<script type="text/javascript" src="../vendor/jquery.Thailand.js/dependencies/JQL.min.js"></script>
	<script type="text/javascript" src="../vendor/jquery.Thailand.js/dependencies/typeahead.bundle.js"></script> -->
<!-- Data picker -->
<script src="../template/js/plugins/datapicker/bootstrap-datepicker.js"></script>

<!-- Select2 -->
<script src="../template/js/plugins/select2/select2.full.min.js"></script>

<!-- SUMMERNOTE -->
<script src="../template/js/plugins/summernote/summernote-bs4.js"></script>

<!-- Switchery -->
<script src="../template/js/plugins/switchery/switchery.js"></script>
<!-- iCheck -->
<script src="../template/js/plugins/iCheck/icheck.min.js"></script>

<!-- Chart c3-->
<script src="../template/js/plugins/d3/d3.min.js"></script>
<script src="../template/js/plugins/c3/c3.min.js"></script>

<!-- Clock picker -->
<script src="../template/js/plugins/clockpicker/clockpicker.js"></script>

<script src="../template/js/plugins/chosen/chosen.jquery.js"></script>

<script>

    $(document).ready(function() {
        load_bag();
    });

    function load_bag() {
        $.ajax({
            type: 'POST',
            url: 'ajax/index/get_bag.php',
            data: {},
            dataType: 'html',
            success: function(response) {
                $('#show_bag').html(response);
                var qty_bag = $('#show_bag li').length;
                $('#list_bag').append('<span class="label-warning bag" >'+qty_bag+'</span>')
          
            }
        });
    }

</script>