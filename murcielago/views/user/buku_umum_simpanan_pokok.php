<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>

<div class="content-wrapper">
 <div class="container-fluid">
   <section class="content">
   <div class="row">
       <div class="col-md-10">
         <h4><b>Data Buku Kas Umum Monitoring Simpanan Pokok</b></h4>
       </div>
       <div class="col-md-2">
         <button type="button" class="btn btn-primary btn-flat btn-sm" data-toggle="modal" data-target="#myModalx" name="button"><i class="fa fa-plus"></i> Input Simpanan Pokok</button>
         <!-- Modal -->
<div id="myModalx" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Tambah Simpanan Pokok</h4>
      </div>
      <div class="modal-body">
        <div class="form-group">
          <form action="<?php echo base_url('buku_umum/add_simpanan_pokok') ?>" method="post">
          <div class="form-group">
              <label for="">Nama Pegawai</label>
              <input type="text" name="nm_pegawai" class="form-control" value="">
          </div>
          <div class="form-group">
            <label for="">Unit Pegawai</label>
            <input type="text" name="unit" class="form-control">
          </div>
            <div class="form-group">
              <label for="">Status Pegawai</label>
              <select class="form-control" name="status">
                <option value="">Pilih Status</option>
                <option value="1">Aktif</option>
                <option value="2">Tidak Aktif</option>
              </select>
            </div>
            <div class="form-group">
              <label for="">Bulan Awal Keanggotaan</label>
              <input type="text" name="bln_awal" class="form-control datepicker">
            </div>
            <div class="form-group">
              <label for="">Simpanan Pokok</label>
              <input type="text" name="simpanan_pokok" class="form-control">
            </div>
            <div class="form-group">
              <button type="submit" class="btn btn-primary btn-flat btn-lg" name="button">Tambah Data</button>
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
       </div>
       <div class="col-md-12">
         <?php echo $this->session->flashdata('alert'); ?>
       </div>

       <div class="col-md-12">
           <div class="col-md-3">
             <form method="post" action="<?= base_url('buku_umum/simpanan_pokok/ac'); ?>">
             <div class="form-group">
               <label>Mulai Tanggal</label>
               <input type="text" class="form-control datepicker" name="start_tgl">
             </div>
           </div>
           <div class="col-md-3">
             <div class="form-group">
               <label>Sampai Tanggal</label>
               <input type="text" class="form-control datepicker" name="end_tgl">
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
                     <th rowspan="2">Unit</th>
                     <th rowspan="2">Bulan Awal Keanggotaan</th>
                     <th rowspan="2">Simpanan Pokok</th>
                     <th colspan="2">Pengembalian</th>
                     <th rowspan="2">Saldo</th>
                     <th rowspan="2">Aksi</th>
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
                     $simpanan = $this->m_data->simpanan_pokokq($this->input->post('start_tgl'),$this->input->post('end_tgl'));
                   }else{
                     $simpanan = $this->m_data->simpanan_pokokq();
                   }
                   foreach($simpanan as $s){
                    $no++;
                    ?>
                    <tr>
                      <td><?php echo $no ?></td>
                      <td><?php echo $s->nama_pelanggan ?></td>
                      <td><?php echo ($s->status_pegawai  == '1') ? 'Aktif' : 'Tidak Aktif' ?></td>
                      <td><?php echo $s->status_keanggotaan ?></td>
                      <td><?php echo $s->unit ?></td>
                      <td><?php echo date('d-m-Y',strtotime($s->bulan_awal_keanggotaan)) ?></td>
                      <td>Rp.<a href="#" class="simpanan_pokok" name="urut<?php echo $s->id_simpanan_p ?>" data-placement="left" data-type="text" data-pk="<?php echo $s->id_simpanan_p ?>" data-url="<?php echo base_url('buku_umum/simpanan_pokok_update') ?>" data-title="Update Simpanan Pokok" style="font-size:20px;">
                           <?php echo $s->simpanan_pokok ?>
                         </a>
                         </td>
                       <script>
                       $(function(){
                       $('.simpanan_pokok').editable({
                       url: '<?php echo base_url('buku_umum/simpanan_pokok_update') ?>',
                       title: 'Update Simpanan Pokok'
                       });
                       });
                       </script>
                       <?php
                       $cari_buku_umum = $this->m_data->where('buku_umum',array('id_simpanan_pokok' => $s->id_simpanan_p))->row();
                       if($cari_buku_umum){
                       ?>
                        <td><?php echo date('d-m-Y',strtotime($cari_buku_umum->tanggal)) ?></td>
                        <td>Rp <?php echo number_format($cari_buku_umum->debit) ?></td>
                        <td>Rp <?php echo number_format($s->simpanan_pokok - $cari_buku_umum->debit) ?></td>
                      <?php }else{ ?>
                        <td colspan="2">
                          <button type="button" class="btn btn-danger btn-flat" data-toggle="modal" data-target="#myModalya<?php echo $no ?>">Tambah Data Pengembalian</button>
                        </td>

                      <?php } ?>
                      <td></td>
                      <td>
                        <button type="button" class="btn btn-primary btn-flat btn-sm" name="button" data-toggle="modal" data-target="#myModalxa<?php echo $no ?>"><i class="fa fa-edit"></i></button>
                      <a href="<?php echo base_url('buku_umum/delete_sim_pokok/'.$s->id_simpanan_p.'') ?>" name="button" class="btn btn-danger btn-flat btn-sm"><i class="fa fa-trash"></i></a>
                      </td>
                    </tr>
                    <!-- Modal -->
                    <!-- Modal -->
                      <div id="myModalxa<?php echo $no ?>" class="modal fade" role="dialog">
                        <div class="modal-dialog modal-lg">

                          <!-- Modal content-->
                          <div class="modal-content">
                            <div class="modal-header">
                              <button type="button" class="close" data-dismiss="modal">&times;</button>
                              <h4 class="modal-title">Edit Data Simpanan Pokok</h4>
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
                                    <label for="">Simpanan Pokok</label>
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
                              <form action="<?php echo base_url('buku_umum/tambah_data_pengembalian_duit/'.$s->id_simpanan_p.'') ?>" method="post">
                                <div class="form-group">
                                  <label for="">Kode Transaksi</label>
                                  <input type="text" class="form-control" name="" value="KSPKA" disabled>
                                  <input type="hidden" class="form-control" name="kd_transaksi" value="KSPKA">
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
                    <?php
                    $gas[$no] = $s->simpanan_pokok;
                    $go += $gas[$no];
                     ?>
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
