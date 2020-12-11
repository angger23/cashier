<div class="col-md-4">
							<label>Nama Barang</label>
							<input type="text" name="nama_barang" class="form-control" placeholder="Nama Barang">
						</div>
						<div class="col-md-4">
							<label>Tanggal Kadaluarsa</label>
							<input type="text" class="form-control datepicker" name="tgl_ex" placeholder="Tanggal Kadaluarsa">
						</div>
						<!-- <input type="hidden" name="tgl_ex" value="0000-00-00"> -->

<script src="<?= base_url ?>assets_kasir/js/jquery.min.js"></script>
<script src="<?= base_url() ?>assets_kasir/js/bootstrap.min.js"></script>
<script type="text/javascript" src="<?php echo base_url() ?>assets_kasir/plugins/moment/moment.js"></script>
<script type="text/javascript" src="<?php echo base_url() ?>assets_kasir/plugins/moment/moment.js"></script>
<script type="text/javascript" src="<?php echo base_url() ?>assets_kasir/js/canvasjs.min.js"></script>
<script type="text/javascript" src="<?php echo base_url() ?>assets/datepickertime/build/js/bootstrap-datetimepicker.min.js"></script>
<script type="text/javascript">
  $(document).ready(function(){
    $('.datepicker').datetimepicker({
      format: 'YYYY-MM-DD'
    });

  });
</script>
