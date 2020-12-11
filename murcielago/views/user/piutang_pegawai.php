<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>

<div class="content-wrapper">
 <div class="container-fluid">
   <section class="content">
   <div class="row">
       <div class="col-md-9">
         <h4><b>Data Buku Kas Umum Monitoring Piutang Uang Tunai Pegawai</b></h4>
       </div>
       <div class="col-md-3">
         <button type="button" class="btn btn-primary btn-flat btn-lg" data-toggle="modal" data-target="#myModalx" name="button" style="font-weight:700;"><i class="fa fa-plus"></i> MONITORING PIUTANG PEGAWAI</button>
         <!-- Modal -->
<div id="myModalx" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Tambah Monitoring</h4>
      </div>
      <div class="modal-body">
        <div class="form-group">
          <?php
          $cari_simpanan_wajib = $this->m_data->semua('simpanan_wajib')->row();
           ?>

          <form action="<?php echo base_url('buku_umum/ADD_MONITORING_PIUTANG_PEGAWAI_TUNAI_LAGI') ?>" method="post">
            <div class="form-group">
              <label for="">Pilih Pegawai</label>
              <select class="form-control selectku" name="pelanggan" style="width:100%;">
                <option value="">Pilih Pegawai</option>
                <?php
                $cari_pelanggan = $this->m_data->semua('pelanggan_simpanan_pokok')->result();
                foreach($cari_pelanggan as $p){
                 ?>
                <option value="<?php echo $p->id_pelanggan ?>"><?php echo $p->nama_pelanggan ?></option>
              <?php } ?>
              </select>
            </div>
            <div class="form-group">
              <label for="">Tanggal Peminjaman</label>
              <input type="text" name="tgl_pinjam" class="form-control datepicker" value="">
            </div>
            <div class="form-group">
              <label for="">Jatuh Tempo</label>
              <input type="text" name="tgl_tempo" class="form-control datepicker" value="">
            </div>
            <div class="form-group">
              <label for="">Jangka Waktu</label>
              <input type="text" name="jangka_waktu" class="form-control" value="">
            </div>
            <div class="form-group">
              <label for="">Pokok Pinjaman</label>
              <input type="text" name="pokok_pinjaman" class="form-control" value="">
            </div>
            <div class="form-group">
              <button type="submit" class="btn btn-primary btn-flat" name="button" style="font-size:20px;font-weight:700">TAMBAH</button>
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
             <form method="post" action="<?= base_url('buku_umum/piutang_pegawai/ac'); ?>">
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
                      <th>No</th>
                      <th>Nama Pegawai</th>
                      <th>Tanggal Peminjaman</th>
                      <th>Tanggal Jatuh Tempo</th>
                      <th>Jangka Waktu (Bulan)</th>
                      <th>Pokok Pinjaman</th>
                      <th>Bunga Pinjaman 2%</th>
                      <th>Total Pinjaman</th>
                      <th>Hitungan Angsuran Pokok</th>
                      <th>Hitungan Angsuran Bunga</th>
                      <th>Hitungan Angsuran Perbulan</th>
                      <th>Jumlah Cicilan</th>
                      <th>Saldo Piutang</th>
                      <th>Opsi</th>
                    </tr>
                 </thead>
                 <tbody>
                   <?php
                   if($this->uri->segment(3) == 'ac'){
                     $list_piutang = $this->m_data->simpanan_kokqqq1((strlen($this->input->post('bulan'))) ? '0'.$this->input->post('bulan') : $this->input->post('bulan'),$this->input->post('tahun'))->result();
                   }else{
                     $list_piutang = $this->m_data->simpanan_kokqqq1()->result();
                   }
                   $no=0;
                   foreach($list_piutang as $p){
                    $no++;
                    ?>
                   <tr>
                     <td><?php echo $no ?></td>
                     <td>
                       <a href="javascript:void(0)" data-toggle="modal" data-target="#myModalyua<?php echo $no ?>"><?php echo $p->nama_pelanggan ?></a>
                     </td>
                     <td> <?php echo date('d-m-Y',strtotime($p->tgl_pinjam)) ?> </td>
                     <td> <?php echo date('d-m-Y',strtotime($p->tgl_tempo)) ?> </td>
                     <td><?php echo $p->jangka_waktu ?></td>
                     <?php
                      $utang_count = $this->m_data->utang_count($p->id_pelanggan)->row();
                      ?>
                     <td>Rp. <?php echo number_format($utang_count->total) ?></td>
                     <?php
                     $bunga_pinjaman = $utang_count->total * 0.02;
                     $angsuran_pokok = $utang_count->total + $bunga_pinjaman;
                     $angsuran_bunga = $bunga_pinjaman / $p->jangka_waktu;
                     $total_pinjam= $utang_count->total + $bunga_pinjaman;
                      ?>
                     <td>Rp. <?php echo number_format($bunga_pinjaman) ?></td>
                     <td>Rp. <?php echo number_format($utang_count->total + $bunga_pinjaman) ?></td>
                     <td>Rp. <?php echo number_format($angsuran_pokok) ?></td>
                     <td>Rp. <?php echo number_format($angsuran_bunga) ?></td>
                     <td>Rp. <?php echo number_format($angsuran_pokok + $angsuran_bunga) ?></td>
                     <?php
                     $cari_cicilan = $this->m_data->cicilan_count($p->id_pelanggan)->row();
                      ?>
                     <td>Rp. <?php echo number_format($cari_cicilan->total) ?></td>
                     <td>Rp. <?php echo number_format($total_pinjam - $cari_cicilan->total) ?></td>
                     <td>
                       <button type="button" name="button" class="btn btn-primary btn-flat btn-lg" data-toggle="modal" data-target="#myModalax<?php echo $no ?>" style="font-weight:700;font-size:20px;"><i class="fa fa-money"></i> BAYAR CICILAN</button>
                       <a href="<?php echo base_url('buku_umum/hapus_piutang_pegawai/'.$p->id_piutang_pegawai.'') ?>" class="btn btn-danger btn-flat btn-lg" name="button" style="font-weight:700;font-size:20px;"><i class="fa fa-trash"></i></a>
                     </td>
                   </tr>
                   <!-- Modal -->
                  <div id="myModalax<?php echo $no ?>" class="modal fade" role="dialog">
                    <div class="modal-dialog">

                      <!-- Modal content-->
                      <div class="modal-content">
                        <div class="modal-header">
                          <button type="button" class="close" data-dismiss="modal">&times;</button>
                          <h4 class="modal-title">Bayar Cicilan</h4>
                        </div>
                        <div class="modal-body">
                          <div class="form-group">
                            <form action="<?php echo base_url('buku_umum/piutang_pegawai_bayar_cicilan_leeeeeeeeee/'.$p->id_pelanggan.'') ?>" method="post">
                              <div class="form-group">
                                <div class="form-group">
                                  <label for="">Tanggal Cicilan</label>
                                  <input type="text" name="tgl_cicil" class="form-control datepicker" value="">
                                </div>
                                <div class="form-group">
                                  <label for="">Nominal Cicilan</label>
                                  <input type="text" class="form-control" name="nominal" value="">
                                </div>
                                <div class="form-group">
                                  <button type="submit" class="btn btn-primary btn-lg" name="button" style="font-size:20px;font-weight:700;">BAYAR CICILAN</button>
                                </div>
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
                            <h4 class="modal-title">History Peminjaman</h4>
                          </div>
                          <div class="modal-body">
                            <ul class="timeline">
                              <?php
                              $history = $this->m_data->history_simpanan_wajib11($p->id_pelanggan)->result();
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
                              $history2 = $this->m_data->history_simpanan_wajib111($th->thn,$p->id_pelanggan)->result();
                              $nos=0;
                              foreach($history2 as $h){
                              $nos++;
                               ?>
                              <li>
                                  <i class="fa fa-arrow-right bg-blue"></i>
                                  <div class="timeline-item">
                                    <!-- <span class="time"><i class="fa fa-calendar"></i> <?php //echo date('d-m-Y') ?></span> -->
                                      <!-- <span class="time">Bulan <?php //echo bulan($h->bulan) ?></span> -->

                                      <h2 class="timeline-header"><a href="javascript:void(0)">Peminjaman ke <?php echo $nos ?></a></h2>

                                      <div class="timeline-body">
                                        <div class="row">
                                          <div class="col-md-6">
                                            <h3 style="padding:0;margin:0;">Bulan <?php echo bulan($h->bulan) ?></h3>
                                            <p>Nominal Pinjaman : Rp <?php echo number_format($h->nominal) ?></p>
                                          </div>
                                          <div class="col-md-6">
                                            <a href="<?php echo base_url('buku_umum/hapus_piutang_pegawai/'.$h->id_piutang_pegawai.'') ?>" class="btn btn-danger btn-flat btn-lg pull-right" name="button"><i class="fa fa-trash"></i> <b>HAPUS</b></a>
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
                 <?php } ?>
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
