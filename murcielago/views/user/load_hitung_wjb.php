<div class="form-group">
  <label>Jumlah Nominal (<i>Dikali per bulan</i>)</label>
  <input type="text" class="form-control" value="<?php echo $total ?>">
</div>
<div class="form-group">
  <button class="btn btn-primary btn-lg btn-flat" type="button" id="hitung2"><b>HITUNG KEMBALI</b></button>
  <button class="btn btn-success btn-lg btn-flat" type="submit"><b>TAMBAH</b></button>
</div>
<script type="text/javascript">
  $("#hitung2").click(function(){
    // alert($("#akhir_bulan").val());
    $("#loy").load("<?php echo base_url('buku_umum/load_y/') ?>" + $("#awal_bulan").val() +'/'+ $("#akhir_bulan").val() +'/'+$("#nominal").val());
  });

</script>
