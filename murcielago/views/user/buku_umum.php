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
         <button type="button" class="btn btn-primary btn-flat pull-right" data-toggle="modal" data-target="#myModal" style="margin:5px;"><i class="fa fa-plus"></i> Input Buku Umum</button>
         <!-- Modal -->
          <div id="myModal" class="modal fade" role="dialog">
            <div class="modal-dialog">
              <!-- Modal content-->
              <div class="modal-content">
                <div class="modal-header">
                  <button type="button" class="close" data-dismiss="modal">&times;</button>
                  <h4 class="modal-title">Input Buku Kas Umum</h4>
                </div>
                <div class="modal-body">
                  <div class="form-group">
                    <form action="<?php echo base_url('buku_umum/add_buku_umum2/') ?><?php echo $this->uri->segment(3) ?>/" method="post">
                      <div class="form-group">
                        <label for="">Kode Transaksi</label>
                        <select class="form-control selectku" name="kd_transaksi" style="width:100%;">
                          <option value="">Pilih Kode Transaksi</option>
                          <?php
                          $no=0;
                          foreach($kode_transaksi as $k){
                          $no++;
                           ?>
                          <option value="<?php echo $k->kd_transaksi ?>"><?php echo $k->kode ?> - <?php echo $k->uraian_kode ?></option>
                        <?php } ?>
                        </select>
                      </div>
                      <div class="form-group">
                        <label>Alat Bayar</label>
                        <select class="form-control selectku" name="alat" style="width:100%;">
                          <option value="">Pilih Alat Bayar</option>
                          <option value="Kas di Bendahara Anggota">Kas di Bendahara Anggota</option>
                          <option value="Kas di Bank Anggota">Kas di Bank Anggota</option>
                          <option value="Kas di Lain-Lain">Kas di Lain-Lain</option>
                        </select>
                      </div>
                      <div class="form-group">
                        <label for="">Keterangan</label>
                        <textarea name="uraian" class="form-control" rows="4"></textarea>
                      </div>
                      <div class="form-group">
                        <label for="">Tanggal</label>
                        <input type="text" class="form-control datepicker" name="tanggal">
                      </div>
                      <div class="form-group">
                          <div class="row">
                            <div class="col-sm-6">
                              <label for="">Kredit (Pemasukan)</label>
                              <input type="text" name="kredit" class="form-control">
                            </div>
                            <div class="col-sm-6">
                              <label for="">Debet (Pengeluaran)</label>
                              <input type="text" name="debet" class="form-control">
                            </div>
                          </div>
                      </div>
                      <div class="form-group">
                        <button type="submit" class="btn btn-primary btn-flat">Input Buku Umum</button>
                      </div>
                    </form>
                  </div>
                </div>
                <div class="modal-footer">
                  <button type="button" class="btn btn-danger btn-flat" data-dismiss="modal">Tutup</button>
                </div>
              </div>
            </div>
          </div>
       </div>
       <div class="col-md-12">
         <hr>
         <?php echo $this->session->flashdata('alert'); ?>
       </div>
       <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
<script>
    function searchFilter(page_num) {
      page_num = page_num?page_num:0;
      var keywords = $('#keywords').val();
      var sortBy = $('#sortBy').val();
      var start_tgl = $('#start_tgl').val();
      var end_tgl = $('#end_tgl').val();
      var filter = $("#filter").val();
      $.ajax({
      type: 'POST',
      url: '<?php echo base_url(); ?>buku_umum/ajaxPaginationData2/'+page_num,
      data:'page='+page_num+'&keywords='+keywords+'&sortBy='+sortBy+'&start_tgl='+start_tgl+'&end_tgl='+end_tgl+'&filter='+filter,
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
       <div class="col-md-12" style="background-color: #f1f1f1;padding: 10px 0px;">
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

              $kas_anggota_list = $this->m_data->where('kode_transaksi',array('status' => 'Kas Anggota'))->result();
                foreach($kas_anggota_list as $l){
             ?>
                <option value="<?php echo $l->kode ?>"><?php echo $l->kode ?> - <?php echo $l->uraian_kode ?></option>
            <?php } ?>
            </select>
           </div>
           <div class="col-md-4">
           <label for="">Cari : </label>
           <input type="text" id="keywords" placeholder="Masukkan Keyword .." class="form-control" onkeyup="searchFilter()"/>
         </div>
         </form>
       </div>
       <div class="col-md-12">
         <hr>
         <div class="postList">
           <div id="loadx">
              <div class="col-md-12" style="padding-right:0px;">
                <?
                  if($this->uri->segment(4) == 'ac'){
                  ?>
                  <a href="<?= base_url('buku_umum/cetak_buku_umum3/'.$this->input->post('start_tgl').'/'.$this->input->post('end_tgl').'/'.$this->input->post('operator').'/'.$this->uri->segment('3').'') ?>" target="_blank" class="btn btn-info btn-flat pull-right" type="button"><i class="fa fa-print"></i> Print</a>
                  <? }else{ ?>
                  <a href="<?= base_url('buku_umum/cetak_buku_umum3/') ?>" target="_blank" class="btn btn-info btn-flat pull-right" type="button" style="margin:5px;"><i class="fa fa-print"></i> Print</a>
                  <? } ?>
                  <?
                  if($this->uri->segment(4) == 'ac'){
                  ?>
                  <a href="<?= base_url('buku_umum/export_buku_umum3/'.$this->input->post('start_tgl').'/'.$this->input->post('end_tgl').'/'.$this->input->post('operator').'/'.$this->uri->segment('3').'') ?>" class="btn btn-success btn-flat pull-right"><i class="fa fa-file-excel-o"></i> Export</a>
                  <? }else{ ?>
                  <a href="<?= base_url('buku_umum/export_buku_umum3/') ?>" class="btn btn-success btn-flat pull-right" style="margin:5px;"><i class="fa fa-file-excel-o"></i> Export</a>
                  <? } ?>
               </div>
               <br>
              <br>
                <div class="table table-responsive">
                   <table class="table table-bordered table-striped">
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
                         <th>Aksi</th>
                       </tr>
                     </thead>
                     <tbody>
                       <?php
                       $sal=0;
                       $no=0;
                       $nos=$this->input->post('page');
                    if(!empty($posts)): foreach($posts as $l):
                        $no++;
                        $nos++;
                        ?>
                       <tr>
                         <td>   <a href="#" class="urut" name="urut<?php echo $l->id_buku_umum ?>" data-placement="right" data-type="text" data-pk="<?php echo $l->id_buku_umum ?>" data-url="<?php echo base_url('buku_umum/nomor_urut') ?>" data-title="Ganti Nomor Urut" style="font-size:20px;">
                              <?php echo $l->no_urut ?>
                            </a>
                            </td>
                          <script>
              $(function(){
              $('.urut').editable({
              url: '<?php echo base_url('buku_umum/nomor_urut') ?>',
              title: 'Ganti Nomor Urut'
              });
              });
              </script>
                         <td><?= date('d-m-Y',strtotime($l->tanggal)) ?></td>
                         <td><?= $l->kode ?></td>
                         <td><?= $l->uraian_kode ?></td>
                         <td><?= $l->alat_bayar ?></td>
                         <td><?= $l->keterangan ?></td>
                         <td>Rp. <?= number_format($l->kredit,2) ?></td>
                         <td>Rp. <?= number_format($l->debit,2) ?></td>
                         <td>Rp. <? $salq =  $l->kredit - $l->debit; echo number_format($salq,2)  ?></td>
                         <td>Rp. <?
                          if($no==1){
                             $sal= $salq;
                          }else{
                        $sal = $salq + $sal ;
                          }
                          echo number_format($sal,2);
                          ?>
                         </td>
                         <td>
                           <button type="button" class="btn btn-info btn-flat btn-sm btn-block" data-toggle="modal" data-target="#myModall<?= $l->id_buku_umum ?>"><i class="fa fa-edit"></i></button>
                           <a href="<?php echo base_url('buku_umum/delete_umumk/'.$l->id_buku_umum.'') ?>" type="button" class="btn btn-danger btn-flat btn-sm btn-block"><i class="fa fa-trash"></i></a>
                         </td>
                       </tr>
                       <div id="myModall<?= $l->id_buku_umum ?>" class="modal fade" role="dialog">
                                <div class="modal-dialog">
                           <!-- Modal content-->
                           <div class="modal-content">
                            <div class="modal-header">
                              <button type="button" class="close" data-dismiss="modal">&times;</button>
                              <h4 class="modal-title">Update Data Buku Umum Anggota</h4>
                            </div>
                            <div class="modal-body">
                              <div class="form-group">
                                <!-- <form action="<?php //echo base_url('buku_umum/update_buku_umum2/'.$l->id_buku_umum.'') ?>" method="post"> -->
                                <div class="form-group">
                                  <label for="">Tanggal</label>
                                  <input type="text" class="form-control datepicker" id="tanggalku<?php echo $l->id_buku_umum ?>" value="<?= $l->tanggal ?>">
                                </div>
                                <div class="form-group">
                                  <label for="">Kode Transaksi</label>
                                  <select class="form-control selectku" id="kd_transaksi<?php echo $l->id_buku_umum ?>" style="width:100%;">
                                    <option value="">Pilih Kode Transaksi</option>
                                    <?php
                                    $no=0;
                                    foreach($kode_transaksi as $k){
                                    $no++;
                                     ?>
                                    <option value="<?php echo $k->kd_transaksi ?>" <?= ($k->kd_transaksi == $l->kode_transaksi) ? 'selected' : '' ?>><?php echo $k->kode ?> - <?php echo $k->uraian_kode ?></option>
                                  <?php } ?>
                                  </select>
                                </div>
                                <div class="form-group">
                                  <label>Alat Bayar</label>
                                  <select class="form-control selectku" id="alat<?php echo $l->id_buku_umum ?>" style="width:100%;">
                                    <option value="">Pilih Alat Bayar</option>
                                    <option value="Kas di Bendahara Toko" <?php echo ($l->alat_bayar == 'Kas di Bendahara Toko') ? 'selected' : '' ?>>Kas di Bendahara Toko</option>
                                    <option value="Kas di Bank Toko" <?php echo ($l->alat_bayar == 'Kas di Bank Toko') ? 'selected' : '' ?>>Kas di Bank Toko</option>
                                    <option value="Kas di Lain-Lain" <?php echo ($l->alat_bayar == 'Kas di Lain-Lain') ? 'selected' : '' ?>>Kas di Lain-Lain</option>
                                  </select>
                                </div>
                                <div class="form-group">
                                  <label for="">Uraian</label>
                                  <textarea id="uraian<?php echo $l->id_buku_umum ?>" class="form-control" rows="4"><?= $l->keterangan ?></textarea>
                                </div>
                                <div class="form-group">
                                    <div class="row">
                                      <div class="col-sm-6">
                                        <label for="">Pemasukan</label>
                                        <input type="text" id="kreditku<?php echo $l->id_buku_umum ?>" class="form-control" value="<?=  $l->kredit ?>">
                                      </div>
                                      <div class="col-sm-6">
                                        <label for="">Pengeluaran</label>
                                        <input type="text" id="debetku<?php echo $l->id_buku_umum ?>" class="form-control" value="<?= $l->debit  ?>">
                                      </div>
                                    </div>
                                </div>
                                  <div class="form-group">
                                    <button type="button" class="btn btn-primary btn-flat" onclick="unliked<?php echo $l->id_buku_umum ?>()" id="but<?php echo $no ?>">Update Buku Umum Toko</button>
                                    <button type="button" class="btn btn-primary btn-flat disabled" id="butloading<?php echo $no ?>"><i class="fa fa-refresh fa-spin"></i> Loading ....</button>
                                  </div>
                                <!-- </form> -->
                                <script>
                                $('#butloading<?php echo $no ?>').hide();
                                 function unliked<?php echo $l->id_buku_umum ?>(id2){
                                   $('#butloading<?php echo $no ?>').show();
                                   $('#but<?php echo $no ?>').hide();

                                     var id = '<?php echo $l->id_buku_umum ?>';
                                     jQuery.ajax({
                                       type: 'POST',
                                       url: "<?php echo base_url() ?>"+"buku_umum/update_buku_umum22/",
                                       data: {id:id,tanggal:$("#tanggalku<?php echo $l->id_buku_umum ?>").val(),
                                       kd_transaksi:$("#kd_transaksi<?php echo $l->id_buku_umum ?>").val(),
                                       alat:$("#alat<?php echo $l->id_buku_umum ?>").val(),
                                       uraian:$("#uraian<?php echo $l->id_buku_umum ?>").val(),
                                       kredit:$("#kreditku<?php echo $l->id_buku_umum ?>").val(),
                                       debet:$("#debetku<?php echo $l->id_buku_umum ?>").val()
                                        },
                                       success: function(data) {
                                         $('#butloading<?php echo $no ?>').hide();
                                         $('#but<?php echo $no ?>').show();
                                         showsucces('Berhasil Update Data !');
                                       },
                                     error: function (data) {
                                       $('#butloading<?php echo $no ?>').hide();
                                       $('#but<?php echo $no ?>').show();
                                       showSuccessMessage01();
                                     }
                                     });
                                 }
                                 </script>
                                <!-- </form> -->
                              </div>
                            </div>
                            <div class="modal-footer">
                              <button type="button" class="btn btn-danger btn-flat" data-dismiss="modal">Tutup</button>
                            </div>
                           </div>
                           </div>
                       </div>
                       <?php

                        ?>
                      <?php endforeach; else: ?>
                        <tr>
                        <td colspan="11">
                          <p class="text-center">Tidak Ada Data</p>
                        </td>
                        </tr>
                  <?php endif; ?>
                  <!-- </div> -->
                  <tr>
                  <td colspan="11">
                  <?php echo $this->ajax_pagination->create_links(); ?>
                  </td>
                  </tr>
                     </tbody>
                   </table>
                     <table class="table table-bordered">
                       <tr style="background-color:#2c3e50;color:#fff;">
                         <td><b>Total</b></td>
                         <td> <b>Pemasukan (Kredit)</b> : Rp.&nbsp;<?= number_format($kreditq->total,2) ?></td>
                         <td> <b>Pengeluaran (Debet)</b> : Rp.&nbsp;<?= number_format($debitq->total,2) ?></td>
                         <td> <b>Saldo</b> : Rp.&nbsp; <?= number_format($kreditq->total - $debitq->total,2) ?></td>
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
