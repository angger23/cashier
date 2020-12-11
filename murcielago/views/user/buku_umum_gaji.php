<div class="content-wrapper">
 <div class="container-fluid">
   <section class="content">
   <div class="row">
       <div class="col-md-10">
         <h4><b>Data Buku Kas Umum Monitoring Piutang Uang Tunai</b></h4>
       </div>
       <div class="col-md-2">
         <button type="button" class="btn btn-primary btn-flat btn-sm" data-toggle="modal" data-target="#myModalx" name="button"><i class="fa fa-plus"></i> Input Piutang Uang Tunai</button>
         <!-- Modal -->
<div id="myModalx" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Tambah Piutang Uang Tunai</h4>
      </div>
      <div class="modal-body">
        <div class="form-group">
          <form action="<?php echo base_url('buku_umum/add_piutang_ka') ?>" method="post">
            <div class="form-group">
              <label for="">Nama Karyawan</label>
              <select class="form-control selectku" style="width:100%" name="id_karyawan">
                <option value="">Plih Karyawan</option>
                <?php
                $cari_karyawan = $this->m_data->semua('anggota_terbaru_2018')->result();
                foreach($cari_karyawan as $c){
                ?>
                <option value="<?= $c->id_anggota ?>"><?= $c->nama_anggota ?></option>
              <?php } ?>
              </select>
            </div>
            <div class="form-group">
              <label for="">Tanggal Pinjaman</label>
              <input type="text" name="tgl_pinjam" class="form-control datepicker">
            </div>
            <div class="form-group">
              <label for="">Tanggal Jatuh Tempo</label>
              <input type="text" name="tgl_jatuh_tempo" class="form-control datepicker">
            </div>
            <div class="form-group">
              <label for="">Jangka Waktu</label>
              <input type="text" name="jangka_waktu" class="form-control">
            </div>
            <div class="form-group">
              <label for="">Pokok Pinjaman</label>
              <input type="text" name="pokok_pinjaman" class="form-control">
            </div>
            <div class="form-group">
              <button type="submit" class="btn btn-primary btn-flat btn-sm" name="button">Tambah Data</button>
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
       <hr>
       <div class="col-md-12">
           <div class="col-md-3">
             <form method="post" action="<?= base_url('buku_umum/piutang_uang_tunai/ac'); ?>">
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
                     <th>No</th>
                     <th>Nama Karyawan</th>
                     <th>NIK</th>
                     <th>Unit Kerja</th>
                     <th>Jabatan</th>
                     <th>Keanggotaan</th>
                     <th>Tanggal Peminjaman</th>
                     <th>Tanggal Jatuh Tempo</th>
                     <th>Jangka Waktu (Bulan)</th>
                     <th>Pokok Peminjaman</th>
                     <th>Bunga Pinjaman (2%)</th>
                     <th>Total Pinjaman</th>
                     <th>Hitungan Angsuran Pokok</th>
                     <th>Hitungan Angsuran Bunga</th>
                     <th>Saldo Piutang</th>
                     <th>Opsi</th>
                   </tr>
                 </thead>
                 <tbody>
                   <?php
                   $ttl1=0;

                  $ttl2=0;
                   $no=0;
                   $cari_anggota = $this->m_data->semua('anggota_terbaru_2018')->result();

                   foreach($cari_anggota as $c){
                    $no++;
                    if($this->uri->segment(3) == 'ac'){
                    $p = $this->m_data->piutang_kas_anggota($this->input->post('start_tgl'),$this->input->post('end_tgl'),$c->id_anggota)->row();
                    }else{
                    $p = $this->m_data->where('piutang_kas_anggota',array('id_anggota' => $c->id_anggota))->row();
                    }
                  ?>
                   <tr>
                     <td><?php echo $no ?></td>
                     <td><?php echo $c->nama_anggota ?></td>
                     <td><?php echo $c->nik ?></td>
                     <td><?php echo $c->unit ?></td>
                     <td><?php echo $c->jabatan ?></td>
                     <td><?php echo $c->status_keanggotaan ?></td>
                     <td><?php echo (empty($p->tanggal_pinjam)) ? '-' : date('d-m-Y',strtotime($p->tanggal_pinjam)) ?></td>
                     <td><?php echo (empty($p->tanggal_jatuh_tempo)) ? '-' : date('d-m-Y',strtotime($p->tanggal_jatuh_tempo)); ?></td>
                     <td><?php echo (empty($p->jangka_waktu)) ? '-' : $p->jangka_waktu ?></td>
                     <td><?php echo (empty($p->pokok_pinjaman)) ? '-' : $p->pokok_pinjaman ?></td>
                     <?php if(empty($p)){$gosh='';}else{$gosh=($p->pokok_pinjaman * 2 / 100) * $p->jangka_waktu; }?>
                     <td><?php echo (empty($gosh)) ? '-' : number_format($gosh)?></td>
                     <td><?php echo (empty($gosh)) ? '-' : number_format($p->pokok_pinjaman + $gosh) ?></td>
                     <?php if(empty($p)){$angsuran_pkok='';}else{$angsuran_pkok=$p->pokok_pinjaman / $p->jangka_waktu; }  ?>
                     <td><?php echo (empty($p)) ? '-' : number_format($p->pokok_pinjaman / $p->jangka_waktu) ?></td>
                     <td><?php echo (empty($p)) ? '-' : number_format($gosh / $p->jangka_waktu) ?></td>
                     <td><?php //echo number_format(($p->pokok_pinjaman - $angsuran_pkok )+); ?></td>
                     <td>
                       <button type="button" class="btn btn-info btn-flat btn-sm" data-toggle="modal" data-target="#myModal<?= $no ?>"><i class="fa fa-eye"></i> Detail</button>
                     </td>
                     <!-- Modal -->
                    <div id="myModal<?= $no ?>" class="modal fade" role="dialog">
                      <div class="modal-dialog">

                        <!-- Modal content-->
                        <div class="modal-content">
                          <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                            <h4 class="modal-title">Detail Piutang Uang Tunai</h4>
                          </div>
                          <div class="modal-body">
                            <div class="form-group">
                              <form action="index.html" method="post">
                                <div class="form-group">
                                  <label for="">Pilih Bulan</label>
                                  <select class="form-control selectku" id="bulan<?= $no ?>" style="width:100%;">
                                    <option value="">Pilih Bulan</option>
                                    <?php for($i=1;$i<=12;$i++){ ?>
                                      <option value="<?php echo (strlen($i) == 1) ? '0'.$i : $i ?>"><?php echo (strlen($i) == 1) ? bulan('0'.$i) : bulan($i) ?></option>
                                    <?php } ?>
                                  </select>
                                </div>
                                <div class="form-group">
                                  <label for="">Pilih Bulan</label>
                                  <select class="form-control selectku" id="tahun<?= $no ?>" style="width:100%;" onchange="oke<?= $no ?>()">
                                    <option value="">Pilih Tahun</option>
                                    <?php for($i=2008;$i<=date('Y');$i++){ ?>
                                      <option value="<?php echo $i ?>"><?php echo $i ?></option>
                                    <?php } ?>
                                  </select>
                                </div>
                              </form>
                              <script type="text/javascript">
                                function oke<?= $no ?>(){
                                  var bulan = $("#bulan<?= $no ?>").val();
                                  var tahun = $("#tahun<?= $no ?>").val();
                                  var id_anggota = <?= $c->id_anggota ?>;
                                  $("#loadya<?= $no ?>").load('<?= base_url('buku_umum/load_rincian_piutang/') ?>'+bulan+'/'+tahun+'/'+id_anggota);
                                }
                              </script>
                              <div class="form-group" id="loadya<?= $no ?>">

                              </div>
                            </div>
                          </div>
                          <div class="modal-footer">
                            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                          </div>
                        </div>

                      </div>
                    </div>
                    <?php
                    $oke1[$no] = (empty($p->pokok_pinjaman)) ? '-' : $p->pokok_pinjaman;
                    $ttl1 += $oke1[$no];
                    //////////////////////////////////////////
                    $oke2[$no] = $gosh;
                    $ttl2 += $oke2[$no];
                     ?>
                   </tr>
                 <?php

               } ?>
                 </tbody>
               </table>
               <table class="table table-bordered">
                 <tr style="background-color:#2c3e50;color:#fff;">
                   <td><b>Total</b></td>
                   <td> <b>Pokok Pinjaman</b> : Rp.&nbsp;<?= number_format($ttl1) ?></td>
                   <td> <b>Bunga Pinjaman (2%)</b> : Rp.&nbsp;<?= number_format($ttl2) ?></td>
                 </tr>
               </table>
               </div>
             <!-- wates -->
           </div>
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
