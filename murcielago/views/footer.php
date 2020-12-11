
<!-- /extra -->

<!-- /footer -->
<footer class="container-fluid bg-4 text-center" style="padding:15px;">
  <p style="margin-top: 7px;">&copy; Copyright 2017 Stikes Banyuwangi. All Rights Reserved</p>
</footer>
<!-- Le javascript-->
================================================== -->
<!-- Placed at the end of the document so the pages load faster -->

<!--<script src="<?php echo base_url() ?>assets/js/jquery-1.7.2.min.js"></script> -->
<!--
<script src="<?php echo base_url() ?>assets/js/excanvas.min.js"></script>
<script src="<?php echo base_url() ?>assets/js/chart.min.js" type="text/javascript"></script>
-->
<!--<script src="<?php echo base_url() ?>assets/js/bootstrap.js"></script>-->

<script src="<?php echo url_css() ?>assets/select2/select2.min.js"></script>
<script src="<?php echo url_css() ?>assets/select2/select2.full.min.js"></script>


<!--    <script type="text/javascript" src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>
	<script type="text/javascript" src="https://cdn.datatables.net/1.10.16/js/dataTables.bootstrap.min.js"></script> -->

    <!-- datatable -->
<script type="text/javascript" src="<?php echo url_css() ?>assets/datatable/datatables.js"></script>
<script type="text/javascript" src="<?php echo url_css() ?>assets/datatable/buttons.html5.min.js"></script>
<script type="text/javascript" src="<?php echo url_css() ?>assets/datatable/buttons.print.min.js"></script>
<script type="text/javascript" src="<?php echo url_css() ?>assets/datatable/dataTables.buttons.min.js"></script>
<script type="text/javascript" src="<?php echo url_css() ?>assets/datatable/jszip.min.js"></script>
<script type="text/javascript" src="<?php echo url_css() ?>assets/datatable/pdfmake.min.js"></script>
<script type="text/javascript" src="<?php echo url_css() ?>assets/datatable/vfs_fonts.js"></script>

<script type="text/javascript">
    $(document).ready(function(){
        $('.datatable').DataTable( {
        dom: 'Bfrtip',
        buttons: [
            'copyHtml5',
            'excelHtml5',
            'csvHtml5',
            'pdfHtml5',
            'print'
        ]
        });
    });
</script>

	<script>
$(document).ready(function() {
    $('#example').DataTable();
} );
</script>
<script>
        $(function(){
            $("#select2").select2();
        });
        $(function(){
            $("#select1").select2();
        });
        $(function(){
            $("#select3").select2();
        });
          $(function(){
            $(".selectku").select2();
        });
        </script>


<!-- /Calendar -->
</body>
</html>
