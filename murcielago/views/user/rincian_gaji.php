<div class="content-wrapper">
 <div class="container-fluid">
   <section class="content">
   <div class="row">
       <div class="col-md-10">
         <h4><b>Rincian Potongan Gaji</b></h4>
       </div>
       <div class="col-md-2">

       </div>
       <div class="col-md-12">
         <?php echo $this->session->flashdata('alert'); ?>
       </div>
       <hr>
       <div class="col-md-12">
           <div class="col-md-3">
             <form method="post" action="<?= base_url('buku_umum/rincian_gaji/ac'); ?>">
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
             <div class="col-md-12" style="padding-right:0px;">
               <?
                 if($this->uri->segment(3) == 'ac'){
                 ?>
                 <a href="<?= base_url('buku_umum/cetak_buku_umum/'.$this->input->post('start_tgl').'/'.$this->input->post('end_tgl').'/'.$this->input->post('operator').'/'.$this->uri->segment('3').'') ?>" target="_blank" class="btn btn-info btn-flat pull-right" type="button"><i class="fa fa-print"></i> Print</a>
                 <? }else{ ?>
                 <a href="<?= base_url('buku_umum/cetak_buku_umum/'." ".'/'." ".'/'." ".'/'.$this->uri->segment('3').'/'.$this->uri->segment('4').'') ?>" target="_blank" class="btn btn-info btn-flat pull-right" type="button" style="margin:5px;"><i class="fa fa-print"></i> Print</a>
                 <? } ?>
                 <?
                 if($this->uri->segment(3) == 'ac'){
                 ?>
                 <a href="<?= base_url('buku_umum/export_rincian_gaji/'.$this->input->post('start_tgl').'/'.$this->input->post('end_tgl').'/') ?>" class="btn btn-success btn-flat pull-right"><i class="fa fa-file-excel-o"></i> Export</a>
                 <? }else{ ?>
                 <a href="<?= base_url('buku_umum/export_rincian_gaji/'." ".'/'." ".'/') ?>" class="btn btn-success btn-flat pull-right" style="margin:5px;"><i class="fa fa-file-excel-o"></i> Export</a>
               <? }  ?>
               </div>
               <br>
              <br>
              <div class="table table-responsive">
                <table class="table table-bordered datatable-biasa">
                  <thead>
                    <tr>
                      <th>No</th>
                      <th>Nama</th>
                      <th>Status Pegawai</th>
                      <th>Status Keanggotaan</th>
                      <th>NIK</th>
                      <th>Unit</th>
                      <th>Jabatan</th>
                      <th>Opsi</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php
                    $cari_anggota = $this->m_data->semua('anggota_terbaru_2018')->result();
                    $no=0;
                    foreach($cari_anggota as $c){
                    $no++;
                     ?>
                    <tr>
                      <td><?php echo $no ?></td>
                      <td><?php echo $c->nama_anggota ?></td>
                      <td><?php echo $c->status_pegawai ?></td>
                      <td><?php echo $c->status_keanggotaan ?></td>
                      <td><?php echo $c->nik ?></td>
                      <td><?php echo $c->unit ?></td>
                      <td><?php echo $c->jabatan ?></td>
                      <td>
                        <button type="button" class="btn btn-info btn-flat btn-sm" data-toggle="modal" data-target="#myModal<?= $c->id_anggota ?>" name="button"><i class="fa fa-eye"></i></button>
                      </td>
                    </tr>
                  <?php } ?>
                  </tbody>
                </table>
               </div>
               <?php
               $no=0;
               foreach($cari_anggota as $c){
               $no++;
                ?>
               <!-- Modal -->
              <div id="myModal<?= $c->id_anggota ?>" class="modal fade" role="dialog">
                <div class="modal-dialog">

                  <!-- Modal content-->
                  <div class="modal-content">
                    <div class="modal-header">
                      <button type="button" class="close" data-dismiss="modal">&times;</button>
                      <?php
                      if($this->uri->segment('3') == 'ac'){ ?>
                        <h4 class="modal-title">Rincian Potongan Gaji <?php echo date('d-m-Y',strtotime($this->input->post('start_tgl'))) ?> - <?php echo date('d-m-Y',strtotime($this->input->post('end_tgl'))) ?></h4>

                      <?php }else{
                       ?>
                      <h4 class="modal-title">Rincian Potongan Gaji</h4>
                    <?php } ?>
                    </div>
                    <div class="modal-body">
                      <div class="container-fluid">
                        <div class="row">
                          <table class="table table-bordered">
                            <thead>
                              <tr>
                                <th>Simpanan Pokok</th>
                                <th>Simpanan Wajib</th>
                                <th>Angsuran Pokok Pinjaman Uang Tunai</th>
                                <th>Angsuran Bunga Pinjaman Uang Tunai</th>
                                <th>Angsuran Pinjaman Toko</th>
                                <th>Jumlah Potongan Gaji</th>
                              </tr>
                            </thead>
                            <tbody>
                              <?php
                              if($this->uri->segment('3') == 'ac'){
                                $cari_rincian_hutang = $this->m_data->piutang_kas_anggota3($this->input->post('start_tgl'),$this->input->post('end_tgl'),$c->id_anggota)->result();
                                $cari_rincian_hutang2 = $this->m_data->piutang_kas_anggota3($this->input->post('start_tgl'),$this->input->post('end_tgl'),$c->id_anggota)->row();
                              }else{
                                $cari_rincian_hutang = $this->m_data->piutang_kas_anggota2(date('Y-m'),$c->id_anggota)->result();
                                $cari_rincian_hutang2 = $this->m_data->piutang_kas_anggota2(date('Y-m'),$c->id_anggota)->row();
                              }
                              $no = 0;
                              $bunga = 0;
                              $pokok = 0;
                              foreach($cari_rincian_hutang as $c){
                                $no++;
                                if(empty($cari_rincian_hutang2)){$gosh='';}else{$gosh=($c->pokok_pinjaman * 2 / 100) * $c->jangka_waktu; }
                                $bung[$no] = (empty($cari_rincian_hutang2)) ? '-' : $gosh / $c->jangka_waktu;
                                $pok[$no] = $c->pokok_pinjaman / $c->jangka_waktu;
                                $bunga += $bung[$no];
                                $pokok += $pok[$no];
                              }
                              $cari_simpanan_pokok = $this->m_data->where('simpanan_pokok',array('id_anggota' => $c->id_anggota))->row();
                              $cari_simpanan_wajib = $this->m_data->where('simpanan_wajib',array('id_anggota' => $c->id_anggota))->row();
                               ?>
                              <tr>
                                <td>Rp <?php echo number_format($cari_simpanan_pokok->simpanan_pokok) ?></td>
                                <td>Rp <?php echo number_format($cari_simpanan_wajib->simpanan_wajib) ?></td>
                                <td>Rp <?php echo number_format($pokok); ?></td>
                                <td>Rp <?php echo number_format($bunga); ?></td>
                                <td></td>
                                <td>Rp <?php echo number_format($pokok+$bunga+$cari_simpanan_pokok->simpanan_pokok+$cari_simpanan_wajib->simpanan_wajib) ?></td>
                              </tr>
                            </tbody>
                          </table>

                        </div>
                      </div>
                    </div>
                    <div class="modal-footer">
                      <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    </div>
                  </div>

                </div>
              </div>
            <?php } ?>
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
