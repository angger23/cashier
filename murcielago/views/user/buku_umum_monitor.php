<style>
.loading{position: absolute;left: 0; top: 0; right: 0; bottom: 0;z-index: 2;background: rgba(255,255,255,0.7);}
.loading .content {
  position: absolute;
  transform: translateY(-50%);
   -webkit-transform: translateY(-50%);
   -ms-transform: translateY(-50%);
  top: 50%;
  left: 0;
  right: 0;
  text-align: center;
  color: #555;
}
</style>
<div class="content-wrapper">
 <div class="container-fluid">
   <section class="content">
   <div class="row">
       <div class="col-md-10">
         <h4><b>Data Buku Kas Umum <?php echo ($this->uri->segment(3) == 'all') ? 'Anggota' : $this->uri->segment(3) ?></b></h4>
       </div>
       <div class="col-md-2">

       </div>
       <div class="col-md-12">
         <?php echo $this->session->flashdata('alert'); ?>
       </div>
       <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
<script>
    function searchFilter(page_num) {
      page_num = page_num?page_num:0;
      var keywords = $('#keywords').val();
      var sortBy = $('#sortBy').val();
      $.ajax({
      type: 'POST',
      url: '<?php echo base_url(); ?>buku_umum/ajaxPaginationData2/'+page_num,
      data:'page='+page_num+'&keywords='+keywords+'&sortBy='+sortBy,
      beforeSend: function () {
      $('.loading').show();
      },
      success: function (html) {
      $('.postList').html(html);
      $('.loading').fadeOut("slow");
      }
      });
    }
</script>
       <!-- <div class="col-md-12" style="background-color: #f1f1f1;padding: 10px 0px;">
         <form class="" action="<?//= base_url('user/index/ac') ?>" method="post">
           <div class="col-md-5">
             <div class="form-group">
               <label>Mulai Tanggal</label>
               <input type="text" class="form-control datepicker" id="start_tgl">
             </div>
           </div>
           <div class="col-md-5">
             <div class="form-group">
               <label>Sampai Tanggal</label>
               <input type="text" class="form-control datepicker" id="end_tgl">
             </div>
           </div>
           <div class="col-md-2">
             <div class="form-group">
               <label for="" style="visibility:hidden;">dsfsdfsdfsf</label>
               <button type="button" name="button" class="btn btn-primary btn-flat btn-sm" onclick="searchFilter()">Cari Berdasar Tanggal</button>
             </div>
           </div>
           <div class="col-md-12">
             <hr style="border:1px solid #ccc;">
           </div>
           <div class="col-md-4">
             <label for="">Urutkan Sesuai</label>
             <select id="sortBy" class="form-control select2" onchange="searchFilter()">
               <option value="">Terbaru</option>
               <option value="asc">A-Z (Tanggal Lama - Tanggal Baru)</option>
               <option value="desc">Z-A (Tanggal Baru - Tanggal Lama)</option>
             </select>
           </div>
           <div class="col-md-4">
             <label>Filter Kode : </label>
            <select class="form-control selectku" name="" id="filter" onchange="searchFilter()">
                <option value="">Pilih Kode</option>
                 <?php

              // $kas_anggota_list = $this->m_data->where('kode_transaksi',array('status' => 'Kas Anggota'))->result();
              //   foreach($kas_anggota_list as $l){
             ?>
                <option value="<?php //echo $l->kode ?>"><?php //echo $l->kode ?> - <?php //echo $l->uraian_kode ?></option>
            <?php //} ?>
            </select>
           </div>
           <div class="col-md-4">
           <label for="">Cari : </label>
           <input type="text" id="keywords" placeholder="Masukkan Keyword .." class="form-control" onkeyup="searchFilter()"/>
         </div>
         </form>
       </div> -->
       <input type="hidden" id="sortBy" class="form-control" value="asc" onkeyup="searchFilter()">
       <input type="hidden" id="keywords" placeholder="Masukkan Keyword .." class="form-control" onkeyup="searchFilter()"/>

       <div class="col-md-12">
         <div class="postList">
           <div id="loadx">
              <br>
                <div class="table table-responsive">
                   <table class="table table-bordered table-striped datatable">
                     <thead>
                       <tr>
                         <th>No</th>
                         <th>Tanggal</th>
                         <th>Kode</th>
                         <th>Uraian Kode</th>
                         <th>Alat Bayar</th>
                         <th>Keterangan</th>
                         <th>Pemasukan</th>
                         <th>Pengeluaran</th>
                         <th>Hasil</th>
                         <th>Saldo</th>
                       </tr>
                     </thead>
                     <tbody>
                       <?php
                       $sal=0;
                       $no=0;
                       $nos=0;
                    foreach($posts as $l){
                        $no++;
                        $nos++;
                        ?>
                       <tr>
                         <td>
                              <?php echo $nos ?>
                          </td>
                         <td><?= date('d-m-Y',strtotime($l->tanggal)) ?></td>
                         <td><?= $l->kode ?></td>
                         <td><?= $l->uraian_kode ?></td>
                         <td><?= $l->alat_bayar ?></td>
                         <td><?= $l->keterangan ?></td>
                         <?php
                         $cari_kode = $this->m_data->where('kode_transaksi',array('kode' => 'PPUTKT'))->row();
                         $cari_next_kode = $this->m_data->where('buku_umum',array('id_join' => $l->id_buku_umum))->row();
                         if($cari_next_kode){
                           $kre = $cari_next_kode->kredit;
                          ?>
                          <td>Rp. <a href="javascript:void(0)" data-toggle="modal" data-target="#myModalxa<?php echo $no ?>"><?= number_format($cari_next_kode->kredit,2) ?></a></td>
                        <?php }else{
                          $kre = $l->kredit;
                          ?>
                          <td>Rp. <a href="javascript:void(0)" data-toggle="modal" data-target="#myModalxa<?php echo $no ?>"><?= number_format($l->kredit,2) ?></a></td>
                        <?php } ?>
                         <td>Rp. <?= number_format($l->debit,2) ?></td>
                         <td>Rp. <? $salq =  $kre - $l->debit; echo number_format($salq,2)  ?></td>
                         <td>Rp. <?
                          if($no==1){
                             $sal= $salq;
                          }else{
                        $sal = $salq + $sal ;
                          }
                          echo number_format($sal,2);
                          ?>
                         </td>
                       </tr>
                       <!-- Modal -->
                      <div id="myModalxa<?php echo $no ?>" class="modal fade" role="dialog">
                        <div class="modal-dialog">

                          <!-- Modal content-->
                          <div class="modal-content">
                            <div class="modal-header">
                              <button type="button" class="close" data-dismiss="modal">&times;</button>
                              <h4 class="modal-title">Update Pendapatan</h4>
                            </div>
                            <div class="modal-body">
                              <div class="form-group">
                                <?php
                                $cari_next_kode = $this->m_data->where('buku_umum',array('id_join' => $l->id_buku_umum))->row();
                                if($cari_next_kode){
                                 ?>
                                <form action="<?php echo base_url('buku_umum/update_pukt') ?>" method="post">
                                  <input type="hidden" name="book_um" value="<?php echo $cari_next_kode->id_buku_umum ?>">
                                  <div class="form-group">
                                    <label for="">Tanggal</label>
                                    <input type="text" name="tgl" class="form-control datepicker" id="tanggalku<?php echo $l->id_buku_umum ?>" value="<?php echo $cari_next_kode->tanggal ?>">
                                  </div>
                                  <div class="form-group">
                                    <label for="">Nominal Pendapatan</label>
                                    <input type="text" class="form-control" name="nominal_pendapatan" value="<?php echo $cari_next_kode->kredit ?>">
                                  </div>
                                  <div class="form-group">
                                    <label for="">Keterangan</label>
                                    <textarea name="keterangan" class="form-control" rows="4"><?php echo $cari_next_kode->keterangan ?></textarea>
                                  </div>
                                  <div class="form-group">
                                    <button type="submit" class="btn btn-primary btn-flat" name="button">Update</button>
                                  </div>
                                </form>
                              <?php }else{ ?>
                                <form action="<?php echo base_url('buku_umum/add_pukt') ?>" method="post">
                                  <input type="hidden" name="kd_transaksi" value="<?php echo $l->kd_transaksi ?>">
                                  <input type="hidden" name="id_buku_umum" value="<?php echo $l->id_buku_umum ?>">
                                  <div class="form-group">
                                    <label for="">Tanggal</label>
                                    <input type="text" name="tgl" class="form-control datepicker" id="tanggalku<?php echo $l->id_buku_umum ?>">
                                  </div>
                                  <div class="form-group">
                                    <label for="">Nominal Pendapatan</label>
                                    <input type="text" class="form-control" name="nominal_pendapatan">
                                  </div>
                                  <div class="form-group">
                                    <label for="">Keterangan</label>
                                    <textarea name="keterangan" class="form-control" rows="4"></textarea>
                                  </div>
                                  <div class="form-group">
                                    <button type="submit" class="btn btn-primary btn-flat" name="button">Tambah</button>
                                  </div>
                                </form>
                              <?php } ?>
                              </div>
                            </div>
                            <div class="modal-footer">
                              <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                            </div>
                          </div>

                        </div>
                      </div>


                    <?php } ?>
                        <!-- <tr>
                        <td colspan="11">
                          <p class="text-center">Tidak Ada Data</p>
                        </td>
                        </tr> -->
                  <!-- <?php //endif; ?> -->
                  <!-- </div> -->

                     </tbody>
                   </table>
                     <table class="table table-bordered">
                       <tr style="background-color:#2c3e50;color:#fff;">
                         <td><b>Total</b></td>
                         <td> <b>Pemasukan (Kredit)</b> : Rp.&nbsp;<?= number_format($kreditqq->total,2) ?></td>
                         <td> <b>Pengeluaran (Debet)</b> : Rp.&nbsp;<?= number_format($debitq->total,2) ?></td>
                         <td> <b>Saldo</b> : Rp.&nbsp; <?= number_format($kreditqq->total - $debitq->total,2) ?></td>
                       </tr>
                     </table>
                 </div>
           </div>
         </div>
         <div class="loading" style="display: none;"><div class="content"><img src="<?php echo base_url().'assets_kasir/photos/loading-gif-transparent-10.gif'; ?>"/></div></div>
       </div>
       </div>
   </div>
 </section>
 </div>
</div>
