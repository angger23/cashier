<footer class="main-footer"  style="background-color: #34495e;color: #fff;">
    <div class="container">
      <div class="pull-right hidden-xs">
        <!-- <b>Version</b> 2.4.0 -->
      </div>
      <strong>Copyright &copy; <? echo '2014-'.date('Y'); ?> Kasir <a href="https://stikesbanyuwangi.ac.id">Stikes Banyuwangi</a>.</strong> All rights
      reserved.  <b>Memory Used (<?php echo $this->benchmark->memory_usage();?>)
    </div>
    <!-- /.container -->
  </footer>
</div>
<!-- ./wrapper -->

<!-- jQuery 3 -->
<?
    // echo ($this->uri->segment(3)=='shoping') ? '' : '<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>';
?>
  <script type="text/javascript" src="<?php echo url_css() ?>assets_kasir/plugins/moment/moment.js"></script>
  <script type="text/javascript" src="<?php echo url_css() ?>assets_kasir/plugins/moment/moment.js"></script>
  <script type="text/javascript" src="<?php echo url_css() ?>assets_kasir/js/canvasjs.min.js"></script>


<script type="text/javascript" src="<?php echo url_css() ?>assets/datepickertime/build/js/bootstrap-datetimepicker.min.js"></script>

<script type="text/javascript">
  $(document).ready(function(){
    $('.datepicker').datetimepicker({
      format: 'YYYY-MM-DD'
    });

  });
</script>

<script type="text/javascript">
  $(document).ready(function(){

    $('.timepicker').datetimepicker({
      format: 'HH:mm'
    });

  });
</script>



<script src="<?php echo url_css() ?>assets/select2/select2.min.js"></script>
<script src="<?php echo url_css() ?>assets/select2/select2.full.min.js"></script>


<script type="text/javascript" src="<?php echo url_css() ?>assets_kasir/plugins/datatable/datatables.js"></script>
<script type="text/javascript" src="<?php echo url_css() ?>assets_kasir/plugins/datatable/buttons.html5.min.js"></script>
<script type="text/javascript" src="<?php echo url_css() ?>assets_kasir/plugins/datatable/buttons.print.min.js"></script>
<script type="text/javascript" src="<?php echo url_css() ?>assets_kasir/plugins/datatable/dataTables.buttons.min.js"></script>
<script type="text/javascript" src="<?php echo url_css() ?>assets_kasir/plugins/datatable/jszip.min.js"></script>
<script type="text/javascript" src="<?php echo url_css() ?>assets_kasir/plugins/datatable/pdfmake.min.js"></script>
<script type="text/javascript" src="<?php echo url_css() ?>assets_kasir/plugins/datatable/vfs_fonts.js"></script>

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
        $('.datatable-biasa').DataTable({
            buttons: false,
        });
	});
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
<script type="text/javascript">
                    $(document).ready(function(){
                        $('#tambah-barang').hide();
                        $('#btn-tutup').hide();
                        $('#btn-tambah').click(function(){
                            $('#tambah-barang').slideToggle();
                            $('#btn-tutup').toggle();
                            $('#btn-tambah').toggle();
                        });
                        $('#btn-tutup').click(function(){
                            $('#tambah-barang').slideToggle();
                            $('#btn-tutup').toggle();
                            $('#btn-tambah').toggle();
                        });

                        $('#kode_barang').keyup(function(){
                            var val = $('#kode_barang').val();
                            $('#loadcoy').load("<?= base_url() ?>"+"p/load_kode/"+val);
                        });

                        $('#kode_barang2').keyup(function(){
                            var val = $('#kode_barang2').val();
                            $('#loadcoy2').load("<?= base_url() ?>"+"p/load_kode/"+val);
                        });
                    });
                </script>
<!-- Bootstrap 3.3.7 -->
<script src="<?= url_css() ?>assets_kasir/js/bootstrap.min.js"></script>
<script src="<?php echo url_css() ?>assets_kasir/bs3_new/js/bootstrap-editable.js"></script>

<script src="<?= url_css() ?>assets_kasir/sweetalert/sweetalert.min.js"></script>
<!-- SlimScroll -->
<script src="<?= url_css() ?>assets_kasir/js/jquery.slimscroll.min.js"></script>
<!-- FastClick -->
<script src="<?= url_css() ?>assets_kasir/js/fastclick.js"></script>
<!-- AdminLTE App -->
<script src="<?= url_css() ?>assets_kasir/js/adminlte.min.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="<?= url_css() ?>assets_kasir/js/demo.js"></script>
        <script type="text/javascript">
            $(function () {
    $('.js-sweetalert button').on('click', function () {
        var type = $(this).data('type');
        if (type === 'basic') {
            showBasicMessage();
        }
        else if (type === 'with-title') {
            showWithTitleMessage();
        }
        else if (type === 'success') {
            showSuccessMessage();
        }
        else if (type === 'confirm') {
            showConfirmMessage();
        }
        else if (type === 'cancel') {
            showCancelMessage();
        }
        else if (type === 'with-custom-icon') {
            showWithCustomIconMessage();
        }
        else if (type === 'html-message') {
            showHtmlMessage();
        }
        else if (type === 'autoclose-timer') {
            showAutoCloseTimerMessage();
        }
        else if (type === 'prompt') {
            showPromptMessage();
        }
        else if (type === 'ajax-loader') {
            showAjaxLoaderMessage();
        }
    });
});

//These codes takes from http://t4t5.github.io/sweetalert/
function showBasicMessage() {
    swal("Here's a message!");
}

function showWithTitleMessage() {
    swal("Here's a message!", "It's pretty, isn't it?");
}

function showSuccessMessage() {
    swal("Sukses", "Berhasil Menghapus Data !", "success");
}

function showSuccessMessage0() {
    swal("Sukses", "Berhasil Update Data !", "success");
}

function showsucces(pesan){
 swal({
     title: "Sukses !",
     text: pesan,
     type: "success",
     showCancelButton: false,
     confirmButtonColor: "#27ae60",
     confirmButtonText: "Ok",
 }, function () {
   location.reload();
 });
}

function showSuccessMessage01() {
  swal("Gagal", "Gagal Update Data !", "warning");
}

function showSuccessMessage1() {
    swal("Gagal", "Gagal Menghapus Data !", "warning");
}

function showSuccessMessage2() {
    swal("Gagal", "Data Tidak Ditemukan !", "error");
}

function showSuccessMessage3() {
    swal("Gagal", "Barang Kadaluarsa !", "error");
}

function showSuccessMessage4() {
    swal("Gagal", "Stok Habis !", "error");
}

function showSuccessMessage5() {
    swal("Gagal", "Jumlah beli melebihi stock , Tolong kurangi jumlah beli", "error");
}

function ShowAlertKosongPembelian() {
    swal("Gagal", "Belum ada record Pembayaran !", "error");
}

function showConfirmMessage() {
    swal({
        title: "Are you sure?",
        text: "You will not be able to recover this imaginary file!",
        type: "warning",
        showCancelButton: true,
        confirmButtonColor: "#DD6B55",
        confirmButtonText: "Yes, delete it!",
        closeOnConfirm: false
    }, function () {
        swal("Deleted!", "Your imaginary file has been deleted.", "success");
    });
}

function showCancelMessage() {
    swal({
        title: "Are you sure?",
        text: "You will not be able to recover this imaginary file!",
        type: "warning",
        showCancelButton: true,
        confirmButtonColor: "#DD6B55",
        confirmButtonText: "Yes, delete it!",
        cancelButtonText: "No, cancel plx!",
        closeOnConfirm: false,
        closeOnCancel: false
    }, function (isConfirm) {
        if (isConfirm) {
            swal("Deleted!", "Your imaginary file has been deleted.", "success");
        } else {
            swal("Cancelled", "Your imaginary file is safe :)", "error");
        }
    });
}

function showWithCustomIconMessage() {
    swal({
        title: "Sweet!",
        text: "Here's a custom image.",
        imageUrl: "../../images/thumbs-up.png"
    });
}

function showHtmlMessage() {
    swal({
        title: "HTML <small>Title</small>!",
        text: "A custom <span style=\"color: #CC0000\">html<span> message.",
        html: true
    });
}

function showAutoCloseTimerMessage() {
    swal({
        title: "Auto close alert!",
        text: "I will close in 2 seconds.",
        timer: 2000,
        showConfirmButton: false
    });
}

function showPromptMessage() {
    swal({
        title: "An input!",
        text: "Write something interesting:",
        type: "input",
        showCancelButton: true,
        closeOnConfirm: false,
        animation: "slide-from-top",
        inputPlaceholder: "Write something"
    }, function (inputValue) {
        if (inputValue === false) return false;
        if (inputValue === "") {
            swal.showInputError("You need to write something!"); return false
        }
        swal("Nice!", "You wrote: " + inputValue, "success");
    });
}

function showAjaxLoaderMessage() {
    swal({
        title: "Ajax request example",
        text: "Submit to run ajax request",
        type: "info",
        showCancelButton: true,
        closeOnConfirm: false,
        showLoaderOnConfirm: true,
    }, function () {
        setTimeout(function () {
            swal("Ajax request finished!");
        }, 2000);
    });
}
        </script>
</body>
</html>
