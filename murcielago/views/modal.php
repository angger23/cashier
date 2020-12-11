<div class="" style="margin-top:10px;padding:0px;">
    <div class="container">
          <div class="panel panel-default">
            <div class="panel-heading"><h4>Aliran Dana</h4></div>  
            <div class="panel-body">
                <?php $data['kas_sekarang'] = $this->m_data->kas_sekarang()->row(); ?>
                <div class="well">
                Kas Saat ini : Rp <?php echo number_format($data['kas_sekarang']->modal_stikes); ?>
                    <br>
                Terakhir Transaksi : <?php echo date("d-m-Y", strtotime($data['kas_sekarang']->tgl_update)); ?>
                </div>
                <div class="form-group">
                    <script>
$(document).ready(function(){
        $("#keluarr").hide();
        $("#masukk").hide();
        $("#keluar2").hide();
        $("#masuk2").hide();
        $("#kolom").hide();
    $("#masuk").click(function(){
        $("#masukk").show();
        $("#masuk2").show();
        $("#keluar2").hide();
        $("#keluarr").hide();
        $("#kolom").show();
    });
    $("#keluar").click(function(){
        $("#keluarr").show();
        $("#keluar2").show();
        $("#masuk2").hide();
        $("#masukk").hide();
        $("#kolom").hide();
    });
});
</script>
                    <form method="post" action="<?php echo base_url() ?>/kas/insert_kas">
                    <label class="radio-inline"><input type="radio" id="masuk" name="optradio" value="masuk">Pemasukan</label>
                    <label class="radio-inline"><input type="radio" id="keluar" name="optradio" value="keluar">Pengeluaran</label>
                        <div class="form-group">
                            <label>Masukkan Modal / Pemasukan / Pengeluaran</label>
                            <input type="number" name="uang" class="form-control">
                        </div>
                        <div class="form-group" id="masuk2">
                            <label>Tanggal Transaksi Masuk</label>
                            <input type="date" name="tgl2" class="form-control">
                        </div>
<!--
                        <div id="kolom">
                        <div class="radio">
  <label><input type="radio" name="optradio">Option 1</label>
</div>
<div class="radio">
  <label><input type="radio" name="optradio">Option 2</label>
</div>
                        </div>
-->
                        <div class="form-group" id="keluar2">
                            <label>Tanggal Transaksi Keluar</label>
                            <input type="date" name="tgl3" class="form-control">
                        </div>
                        <div class="form-group" id="masukk">
                            <input type="hidden" name="modal_m" value="<?php echo $data['kas_sekarang']->modal_stikes ?>">
                            <label>Keterangan Pemasukan</label>
                            <input type="text" name="keterangan2" placeholder="Contoh : Dana Masuk" class="form-control">
                        </div>
                        <div class="form-group" id="keluarr">
                            <input type="hidden" name="modal" value="<?php echo $data['kas_sekarang']->modal_stikes ?>">
                            <label>Keterangan Pengeluaran</label>
                            <input type="text" name="keterangan3" placeholder="Contoh : Dana santunan" class="form-control">
                        </div>
                        <div class="form-group">
                            <button class="btn btn-success" type="submit">Tambah</button>
                        </div>
                    </form>
                </div>
            </div>
          </div>  
    </div>
</div>