<link rel="stylesheet" href="<?php echo base_url('assets_kasir/css/jquery-ui.min.css') ?>">
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
      <section class="content">
        <div class="row">
        <div class="col-md-12">
          <center>
                  <h3><b>VERIFIKASI TANGGAL PENJUALAN</b></h3>

                  <?php 
                  $cari_stat = $this->m_data->semua('verifikasi_tgl_penjualan')->row();
                  $db2 =$this->load->database('second', TRUE);
                  $query = $db2->get('verifikasi_tgl_penjualan');
                  $cari_stat1 = $query->row();
                  if($cari_stat->stat_verif == 1){
                    $stat = 'Aktif';
                  }else{
                    $stat = 'Tidak Aktif';
                  }
                  if($cari_stat1->stat_verif == 1){
                    $stat1 = 'Aktif';
                  }else{
                    $stat1 = 'Tidak Aktif';
                  }
                  ?>
                  <h4>Status Data Offline Saat ini : <b><?php echo $stat ?></b></h4>
                  <h4>Status Data Online Saat ini : <b><?php echo $stat1 ?></b></h4>
                  <?php 
                  if($stat != $stat1){
                   ?>
                  <form method="post" action="<?php echo base_url('p/off_verif') ?>">
                    <button class="btn btn-success btn-flat" type="submit">Sinkronkan Status Online <i class="fa fa-refresh"></i></button>
                  </form>
                <?php }else{} ?>
                  <hr>
                </center>
        </div>
      </div>
      <?php 
      if($this->ion_auth->is_admin()){
       ?>
      <div class="row">
        <form action="<?= base_url('p/verif/') ?>" method="post">
          <div class="col-md-12">
            <?= $this->session->flashdata('alert'); ?>
          </div>
          <div class="col-md-12" style="margin-top: 0px;">
            <div class="col-md-4">
              <label>Status Tanggal</label>
              <select class="form-control selectku" name="stat">
               <option value="" selected>Pilih Status Tanggal</option>
               <option value="1">Aktif</option>
               <option value="0">Tidak Aktif</option>
              </select>
            </div>
            <div class="col-md-4" id="pelunasan">
              <label style="visibility: hidden">ysdgfdusf</label>
              <button type="submit" class="btn btn-primary btn-block btn-flat" style="margin-top:0px;" id="simpan_barang">Simpan</button>
            </div>
          </div>
        </div>
      <?php }else{} ?>
      </form>

      </div>

      <div class="row">
       <div class="col-md-12">
                    <hr>
                </div>  
      </div>
        <!-- ><><><><><< -->
   

      </section>
  </div>