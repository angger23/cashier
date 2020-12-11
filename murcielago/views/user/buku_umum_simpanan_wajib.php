<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>

<div class="content-wrapper">
 <div class="container-fluid">
   <section class="content">
   <div class="row">
       <div class="col-md-9">
         <h4><b>Data Buku Kas Umum Monitoring Simpanan Wajib</b></h4>
       </div>
       <div class="col-md-3">
         <button type="button" class="btn btn-primary btn-flat btn-lg" data-toggle="modal" data-target="#myModalx" name="button"><i class="fa fa-plus"></i> Tambah Simpanan Wajib</button>
         <!-- Modal -->
<div id="myModalx" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Tambah Simpanan Wajib</h4>
      </div>
      <div class="modal-body">
        <div class="form-group">
          <?php
          $cari_simpanan_wajib = $this->m_data->semua('simpanan_wajib')->row();
           ?>
          <!-- <form action="<?php //echo base_url('buku_umum/update_simpanan_wajib/'.$cari_simpanan_wajib->id_simpanan_w.'') ?>" method="post">

            <div class="form-group">
              <label for="">Nominal Simpanan Wajib</label>
              <input type="text" name="nominal" class="form-control" value="<?php //echo $cari_simpanan_wajib->nominal ?>">
            </div>
            <div class="form-group">
              <button type="submit" class="btn btn-primary btn-flat" name="button">Update Simpanan Wajib</button>
            </div>
          </form> -->
          <form action="<?php echo base_url('buku_umum/add_SIMPANAN_WAJIB_LAGI') ?>" method="post">
            <div class="form-group">
              <label for="">Pilih Pelanggan</label>
              <select class="form-control selectku" name="pelanggan" style="width:100%;">
                <option value="">Pilih Pelanggan</option>
                <?php
                $cari_pelanggan = $this->m_data->semua('pelanggan_simpanan_pokok')->result();
                foreach($cari_pelanggan as $p){
                 ?>
                <option value="<?php echo $p->id_pelanggan ?>"><?php echo $p->nama_pelanggan ?></option>
              <?php } ?>
              </select>
            </div>
            <div class="panel panel-success">
                <div class="panel-body">
                  <div class="form-group">
                    <label for="">Tahun</label>
                    <select class="form-control selectku" name="tahun" style="width:100%;">
                      <option value="">Pilih Tahun</option>
                      <?php
                        for($i=2000;$i<=date('Y');$i++){
                       ?>
                      <option value="<?php echo $i ?>"><?php echo $i ?></option>
                    <?php } ?>
                    </select>
                  </div>
                  <div class="row">
                    <div class="col-md-6">
                      <div class="form-group">
                        <label>Mulai Bulan</label>
                        <select class="form-control selectku" name="awal_bulan" id="awal_bulan" style="width:100%;">
                          <option value="">Pilih Bulan</option>
                          <?php
                            for($i=1;$i<=12;$i++){
                           ?>
                          <option value="<?php echo $i ?>"><?php echo bulan($i) ?></option>
                        <?php } ?>
                        </select>
                      </div>
                    </div>
                    <div class="col-md-6">
                      <div class="form-group">
                        <label>Sampai Bulan</label>
                        <select class="form-control selectku" name="akhir_bulan" id="akhir_bulan" style="width:100%;">
                          <option value="">Pilih Bulan</option>
                          <?php
                            for($i=1;$i<=12;$i++){
                           ?>
                          <option value="<?php echo $i ?>"><?php echo bulan($i) ?></option>
                        <?php } ?>
                        </select>
                      </div>
                    </div>
                  </div>
                  <div class="form-group">
                    <label for="">Nominal</label>
                    <input type="text" name="nominal" class="form-control" id="nominal">
                  </div>
                  <div id="loy">
                    <div class="form-group">
                      <button type="button" class="btn btn-primary btn-flat btn-lg" name="button" id="hitung"><b>HITUNG</b></button>
                    </div>
                  </div>
                </div>
            </div>
          </form>
          <script type="text/javascript">
            $("#hitung").click(function(){
              // alert($("#akhir_bulan").val());
              $("#loy").load("<?php echo base_url('buku_umum/load_y/') ?>" + $("#awal_bulan").val() +'/'+ $("#akhir_bulan").val() +'/'+$("#nominal").val());
            });

          </script>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>

  </div>
</div>
       </div>
       <div class="col-md-12">
       </div>

       <div class="col-md-12">
           <div class="col-md-3">
             <form method="post" action="<?= base_url('buku_umum/simpanan_wajib/ac'); ?>">
             <div class="form-group">
               <label>Bulan</label>
               <select class="form-control selectku" name="bulan" style="width:100%;">
                 <option value="">Pilih Bulan</option>
                 <?php
                   for($i=1;$i<=12;$i++){
                  ?>
                 <option value="<?php echo $i ?>"><?php echo bulan($i) ?></option>
               <?php } ?>
               </select>
             </div>
           </div>
           <div class="col-md-3">
             <div class="form-group">
               <label>Tahun</label>
               <select class="form-control selectku" name="tahun" style="width:100%;">
                 <option value="">Pilih Tahun</option>
                 <?php
                   for($i=2000;$i<=date('Y');$i++){
                  ?>
                 <option value="<?php echo $i ?>"><?php echo $i ?></option>
               <?php } ?>
               </select>
             </div>
           </div>
           <div class="col-md-3">
           <label style="visibility: hidden;">1</label>
             <div class="form-group">
               <button class="btn btn-primary btn-flat" type="submit">Cari</button>
             </div>
           </div>
         </form>
       </div>

       <div class="nav-tabs-custom">

       <!-- <div class="col-md-3">
         <ul class="nav nav-fixed fixedElement">
           <li class="active"><a href="#tab_1" data-toggle="tab">Buku Bank Kas Anggota All</a></li>
           <li><a href="#tab_2" id="tab2" data-toggle="tab">Biaya Administrasi Bank Kas Anggota</a></li>
           <li><a href="#tab_3" id="tab3" data-toggle="tab">Pendapatan Bunga Bank Kas Anggota</a></li>
           <li><a href="#tab_4" id="tab4" data-toggle="tab">Setor Tunai Kas Anggota</a></li>
           <li><a href="#tab_5" id="tab5" data-toggle="tab">Transfer Masuk Kas Anggota</a></li>
           <li><a href="#tab_6" id="tab6" data-toggle="tab">Tarik Tunai Kas Anggota</a></li>
           <li><a href="#tab_7" id="tab7" data-toggle="tab">Transfer Keluar Kas Anggota</a></li>
           <li><a href="#tab_8" id="tab8" data-toggle="tab">Saldo Bank Bulan Berjalan Kas Anggota</a></li>
           <li><a href="#tab_9" id="tab9" data-toggle="tab">Saldo Bank Bulan Yang Lalu Kas Anggota</a></li>
         </ul>
       </div> -->
<style>
.nav>li {
  position: relative;
  display: block;
}
.nav>li>a {
    position: relative;
    display: block;
    padding: 16px 15px;
    color: #3c3c3c;
}
/* .active {
    background-color: #dcdcdc;
} */
.box-sha{
    box-shadow: 2px 1px 20px -5px #5f5f5f;
}
.fixedElementul{
  margin-left: 15px;
  min-width:150%;
  padding:0px;
}
</style>


       <div class="col-md-12">
         <hr>
         <div class="tab-content">
           <div class="tab-pane active" id="tab_1" style="background-color:#fff;">
             <!-- wates -->
             <?php
             echo $this->session->flashdata('warn');
             ?><?php
             if($this->session->flashdata('alert') == 'belum'){
              ?>
              <!-- <div class="alert alert-danger fade in">
                <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
              <h2>  Data bulan : <?php //echo bulan($this->session->flashdata('bulan')) ?> Tahun : <?php //echo $this->session->flashdata('tahun') ?> belum terisi simpanan wajib. </h2>
              </div> -->
              <?php
              $bulan = $this->session->flashdata('bulan');
              $tahun = $this->session->flashdata('tahun');
               ?>
              <!-- <a href="<?php //echo base_url('buku_umum/simpanan_wajib_insert/'.$bulan.'/'.$tahun.'') ?>" type="button" class="btn btn-info btn-flat">Tambah Data Simpanan Wajib</a> -->
          <?php }elseif($this->session->flashdata('alert') == 'sudah'){ ?>
            <!-- <div class="alert alert-success fade in">
              <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
              Data bulan : <?php //echo bulan($this->session->flashdata('bulan')) ?> Tahun : <?php //echo $this->session->flashdata('tahun') ?> sudah terisi simpanan wajib.
            </div> -->
          <?php }else{ ?>
             <!-- <button class="btn btn-success btn-flat btn-lg"  data-toggle="modal" data-target="#myModalyax" type="button"><b style="font-size:30px;">CEK DATA</b></button> -->
           <?php } ?>
             <!-- Modal -->
            <div id="myModalyax" class="modal fade" role="dialog">
              <div class="modal-dialog">

                <!-- Modal content-->
                <div class="modal-content">
                  <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Cek Data</h4>
                  </div>
                  <div class="modal-body">
                      <!-- <div class="form-group">
                        <label for="">Apakah anda ingin cek data yang lalu ?</label>
                        <br>
                        <label class="radio-inline"><input type="radio" name="optradio" value="Ya" id="y">Ya</label>
                        <label class="radio-inline"><input type="radio" name="optradio" value="Tidak" id="n">Tidak</label>
                      </div> -->
                      <!-- <div class="form-group" id="ya"> -->
                          <form action="<?php echo base_url('buku_umum/cek_data_wajib') ?>" method="post">
                            <div class="form-group">
                              <label>Bulan</label>
                              <select class="form-control selectku" name="bulan" style="width:100%;">
                                <option value="">Pilih Bulan</option>
                                <?php
                                for ($i=1; $i <= 12 ; $i++) {
                                 ?>
                                <option value="<?php echo (strlen($i) == 1) ? '0'.$i : $i ?>"><?php echo bulan($i) ?></option>
                              <?php } ?>
                              </select>
                            </div>
                            <div class="form-group">
                              <label>Tahun</label>
                              <select class="form-control selectku" name="tahun" style="width:100%;">
                                <option value="">Pilih Tahun</option>
                                <?php
                                for ($i=2004; $i <= date('Y') ; $i++) {
                                 ?>
                                <option value="<?php echo $i ?>"><?php echo $i ?></option>
                              <?php } ?>
                              </select>
                            </div>
                            <div class="form-group">
                              <button type="submit" class="btn btn-primary btn-lg btn-flat" name="button"><b>CARI</b></button>
                            </div>
                          </form>
                      <!-- </div> -->
                  </div>
                  <script>
                    $(document).ready(function(){
                      $('#ya').hide();
                      $('#tidak').hide();
                      $("#y").click(function(){
                        $('#ya').show();
                        $('#tidak').hide();
                      });
                      $("#show").click(function(){
                        $("p").show();
                      });
                    });
                    </script>
                  <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                  </div>
                </div>

              </div>
            </div>
               <br>
              <br>
              <div class="table table-responsive">
               <table class="table table-bordered datatable-biasa">
                 <thead>
                   <tr>
                     <th rowspan="2">No</th>
                     <th rowspan="2">Nama Karyawan</th>
                     <th rowspan="2">Status Pegawai</th>
                     <th rowspan="2">Status Keanggotaan</th>
                     <th rowspan="2">Total Simpanan Wajib</th>
                     <th rowspan="2">Unit</th>
                     <th rowspan="2">Bulan / Tahun Pembayaran</th>
                     <th rowspan="2">Simpanan Wajib</th>
                     <th colspan="2">Pengembalian</th>
                     <th rowspan="2" colspan="2">Aksi</th>
                   </tr>
                   <tr>
                     <th>Tanggal</th>
                     <th>Saldo Pengembalian</th>
                   </tr>
                 </thead>
                 <tbody>
                   <?php
                   $no=0;
                   $go=0;
                   if($this->uri->segment(3) == 'ac'){
                     $simpanan = $this->m_data->simpanan_wajibq((strlen($this->input->post('bulan'))) ? '0'.$this->input->post('bulan') : $this->input->post('bulan'),$this->input->post('tahun'));
                   }else{
                     $simpanan = $this->m_data->simpanan_wajibq();
                   }
                   foreach($simpanan as $s){
                    $no++;
                    ?>
                    <tr>
                      <td><?php echo $no ?></td>
                      <td><a href="javascript:void(0)" data-toggle="modal" data-target="#myModalyua<?php echo $no ?>"><?php echo $s->nama_pelanggan ?></a></td>
                      <td><?php echo ($s->status_pegawai  == '1') ? 'Aktif' : 'Tidak Aktif' ?></td>
                      <td><?php echo $s->status_keanggotaan ?></td>
                      <?php
                      $simpanan_cek = $this->m_data->sum_wajib($s->id_pelanggan);
                       ?>
                      <td>Rp <?php
                      echo number_format($simpanan_cek->total)
                       ?></td>
                      <td><?php echo $s->unit ?></td>
                      <td><?php echo $s->bulan.'-'.$s->tahun ?></td>
                      <td>Rp.
                        <a href="#" class="nominalx" name="nominal<?php echo $s->id_wajib ?>" data-type="text" data-pk="<?php echo $s->id_wajib ?>" data-url="<?php echo base_url('buku_umum/simpanan_wajib_update') ?>" data-title="Ganti Nominal" style="font-size:20px;">
                        <?php echo $s->nominal ?>
                        </a>
                         </td>
                       <script>
           $(function(){
           $('.nominalx').editable({
           url: '<?php echo base_url('buku_umum/simpanan_wajib_update') ?>',
           title: 'Update Nominal'
           });
           });
           </script>
           <?php
           $cari_buku_umum = $this->m_data->where('buku_umum',array('id_simpanan_wajib' => $s->id_wajib))->row();
           if($cari_buku_umum){
           ?>
            <td><?php echo date('d-m-Y',strtotime($cari_buku_umum->tanggal)) ?></td>
            <td>Rp <?php echo number_format($cari_buku_umum->debit) ?></td>
            <!-- <td>Rp <?php //echo number_format($s->nominal - $cari_buku_umum->debit) ?></td> -->
          <?php }else{ ?>
            <td colspan="2">
              <button type="button" class="btn btn-danger btn-flat" data-toggle="modal" data-target="#myModalya<?php echo $no ?>">Tambah Data Pengembalian</button>
            </td>
<!-- <td></td> -->
          <?php } ?>
           <td colspan="2">
             <button type="button" name="button" class="btn btn-primary btn-flat btn-sm" data-toggle="modal" data-target="#myModalyax<?php echo $no ?>"><i class="fa fa-edit"></i></button>
             <a href="<?php echo base_url('buku_umum/hapus_data_wajib/'.$s->id_wajib.'') ?>" class="btn btn-danger btn-flat btn-sm" name="button"><i class="fa fa-trash"></i></a>
           </td>
                    </tr>
                    <?php
                    $gas[$no] = $s->nominal;
                    $go += $gas[$no];
                     ?>
                     <!-- Modal -->
                        <div id="myModalyax<?php echo $no ?>" class="modal fade" role="dialog">
                          <div class="modal-dialog">

                            <!-- Modal content-->
                            <div class="modal-content">
                              <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                                <h4 class="modal-title">Edit Simpanan Wajib</h4>
                              </div>
                              <div class="modal-body">
                                <div class="form-group">
                                  <form action="<?php echo base_url('buku_umum/edit_simpanan_wajib/'.$s->id_wajib.'') ?>" method="post">
                                    <div class="form-group">
                                      <label for="">Nama Pelanggan</label>
                                      <input type="text" name="nm_pelanggan" class="form-control" readonly value="<?php echo $s->nama_pelanggan ?>">
                                    </div>
                                    <div class="form-group">
                                      <label for="">Nominal</label>
                                      <input type="text" name="nominal" class="form-control" value="<?php echo $s->nominal ?>">
                                    </div>
                                    <div class="form-group">
                                      <button type="submit" class="btn btn-primary btn-flat btn-lg" name="button"><b>UPDATE DATA</b></button>
                                    </div>
                                  </form>
                                </div>
                              </div>
                              <div class="modal-footer">
                                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                              </div>
                            </div>

                          </div>
                        </div>
                     <!-- Modal -->
                      <div class="modal fade" id="myModalyua<?php echo $no ?>" role="dialog">
                        <div class="modal-dialog modal-lg">

                          <!-- Modal content-->
                          <div class="modal-content">
                            <div class="modal-header">
                              <button type="button" class="close" data-dismiss="modal">&times;</button>
                              <h4 class="modal-title">History Pembayaran</h4>
                            </div>
                            <div class="modal-body">
                              <ul class="timeline">
                                <?php
                                $history = $this->m_data->history_simpanan_wajib1($s->id_pelanggan)->result();
                                $nox=0;
                                foreach($history as $th){
                                $nox++;
                                 ?>
                                <li class="time-label">
                                    <span class="bg-red" style="font-size:20px;">
                                        Tahun <?php echo $th->thn ?>
                                    </span>
                                </li>
                                <?php
                                $history2 = $this->m_data->history_simpanan_wajib($th->thn,$s->id_pelanggan)->result();
                                $nos=0;
                                foreach($history2 as $h){
                                $nos++;
                                 ?>
                                <li>
                                    <i class="fa fa-arrow-right bg-blue"></i>
                                    <div class="timeline-item">
                                      <!-- <span class="time"><i class="fa fa-calendar"></i> <?php //echo date('d-m-Y') ?></span> -->
                                        <!-- <span class="time">Bulan <?php //echo bulan($h->bulan) ?></span> -->

                                        <h2 class="timeline-header"><a href="javascript:void(0)">Pembayaran ke <?php echo $nos ?></a></h2>

                                        <div class="timeline-body">
                                          <div class="row">
                                            <div class="col-md-6">
                                              <h3 style="padding:0;margin:0;">Bulan <?php echo bulan($h->bulan) ?></h3>
                                            </div>
                                            <div class="col-md-6">
                                              <a href="<?php echo base_url('buku_umum/delete_simpanan_wajibx/'.$h->id_wajib.'') ?>" class="btn btn-danger btn-flat btn-lg pull-right" name="button"><i class="fa fa-trash"></i> <b>HAPUS</b></a>
                                            </div>
                                          </div>
                                        </div>
                                    </div>
                                </li>
                              <?php } ?>
                              <?php } ?>
                                <!-- ... -->

                            </ul>
                            </div>
                            <div class="modal-footer">
                              <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                            </div>
                          </div>

                        </div>
                      </div>
                     <div id="myModalxa<?php echo $no ?>" class="modal fade" role="dialog">
                       <div class="modal-dialog modal-lg">

                         <!-- Modal content-->
                         <div class="modal-content">
                           <div class="modal-header">
                             <button type="button" class="close" data-dismiss="modal">&times;</button>
                             <h4 class="modal-title">Edit Data Simpanan Wajib</h4>
                           </div>
                           <div class="modal-body">
                             <div class="form-group">
                               <form action="<?php echo base_url('buku_umum/update_simpanan_pokok_e') ?>" method="post">
                                 <input type="hidden" name="id_pelanggan" value="<?php echo $s->id_pelanggan ?>">
                                 <input type="hidden" name="id_simpanan_p" value="<?php echo $s->id_simpanan_p ?>">
                               <div class="form-group">
                                   <label for="">Nama Pegawai</label>
                                   <input type="text" name="nm_pegawai" class="form-control" value="<?php echo $s->nama_pelanggan ?>">
                               </div>
                               <div class="form-group">
                                 <label for="">Unit Pegawai</label>
                                 <input type="text" name="unit" class="form-control" value="<?php echo $s->unit ?>">
                               </div>
                                 <div class="form-group">
                                   <label for="">Status Pegawai</label>
                                   <select class="form-control" name="status">
                                     <option value="">Pilih Status</option>
                                     <option value="1" <?php echo ($s->status_pegawai == 1) ? 'selected' : '' ?>>Aktif</option>
                                     <option value="2" <?php echo ($s->status_pegawai == 2) ? 'selected' : '' ?>>Tidak Aktif</option>
                                   </select>
                                 </div>
                                 <div class="form-group">
                                   <label for="">Bulan Awal Keanggotaan</label>
                                   <input type="text" name="bln_awal" class="form-control datepicker" value="<?php echo $s->bulan_keanggotaan ?>">
                                 </div>
                                 <div class="form-group">
                                   <label for="">Simpanan Wajib</label>
                                   <input type="text" name="simpanan_pokok" class="form-control" value="<?php echo $s->simpanan_pokok ?>">
                                 </div>
                                 <div class="form-group">
                                   <button type="submit" class="btn btn-primary btn-flat btn-lg" name="button">Update Data</button>
                                 </div>
                               </form>
                             </div>
                           </div>
                           <div class="modal-footer">
                             <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                           </div>
                         </div>

                       </div>
                     </div>
                     <div id="myModalya<?php echo $no ?>" class="modal fade" role="dialog">
                       <div class="modal-dialog">

                         <!-- Modal content-->
                         <div class="modal-content">
                           <div class="modal-header">
                             <button type="button" class="close" data-dismiss="modal">&times;</button>
                             <h4 class="modal-title">Tambah Data Pengembalian</h4>
                           </div>
                           <div class="modal-body">
                             <div class="form-group">
                               <form action="<?php echo base_url('buku_umum/tambah_data_pengembalian_duit_neh/'.$s->id_wajib.'') ?>" method="post">
                                 <div class="form-group">
                                   <label for="">Kode Transaksi</label>
                                   <input type="text" class="form-control" name="" value="KSWKA" disabled>
                                   <input type="hidden" class="form-control" name="kd_transaksi" value="KSWKA">
                                 </div>
                                 <div class="form-group">
                                   <label for="">Alat Bayar</label>
                                   <input type="text" name="alat" class="form-control">
                                 </div>
                                 <div class="form-group">
                                   <label for="">Tanggal</label>
                                   <input type="text" name="tanggal" class="form-control datepicker">
                                 </div>
                                 <div class="form-group">
                                   <label for="">Keterangan</label>
                                   <textarea name="keterangan" rows="4" class="form-control"></textarea>
                                 </div>
                                 <div class="form-group">
                                   <label for="">Nominal Pengeluaran</label>
                                   <input type="text" name="nominal_pengeluaran" class="form-control">
                                 </div>
                                 <div class="form-group">
                                   <button type="submit" class="btn btn-primary btn-flat" name="button">Tambah Data</button>
                                 </div>
                               </form>
                             </div>
                           </div>
                           <div class="modal-footer">
                             <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                           </div>
                         </div>

                       </div>
                     </div>

                  <?php } ?>

                 </tbody>
               </table>
<table class="table">
  <tbody>
    <tr style="background-color:#2c3e50;color:#fff;">
      <td colspan="6"><b>Total</b></td>
      <td></td>
      <td></td>
      <td></td>
      <td></td>
      <td></td>
      <td></td>
      <td></td>
      <td></td>
      <td></td>
      <td></td>
      <td></td>
      <td></td>
      <td></td>
      <td></td>
      <td></td>
      <td></td>
      <td></td>
      <td></td>
      <td></td>
      <td></td>
      <td></td>
      <td></td>
      <td></td>
      <td></td>
      <td>: Rp.&nbsp;<?= number_format($go) ?></td>
    </tr>
  </tbody>
</table>
               </div>
             <!-- wates -->
           </div>
           <!-- /.tab-pane -->

           <!-- /.tab-pane -->
         </div>
         <!-- /.tab-content -->
       </div>

<script type="text/javascript">
$(window).scroll(function(e){
var $el = $('.fixedElement');
var isPositionFixed = ($el.css('position') == 'fixed');
if ($(this).scrollTop() > 200 && !isPositionFixed){
  $('.fixedElement').css({'position': 'fixed', 'top': '0px','z-index' : '999999999','width':'15%'});
  $('.fixedElementul').css({'position': 'fixed', 'top': '0px','z-index' : '999999999','min-width':'98%','margin-top':'45px'});
}
if ($(this).scrollTop() < 200 && isPositionFixed)
{
  $('.fixedElement').css({'position': 'static', 'top': '0px','width' : '100%'});
  $('.fixedElementul').css({'position': 'absolute', 'top': '0px','z-index':'9999999','min-width' : '164%','margin-top':'40px','margin-left':'14px'});
}
});
</script>
       </div>

       </div>
   </div>
 </section>
 </div>
</div>
