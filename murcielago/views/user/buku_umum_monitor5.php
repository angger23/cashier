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
                         <th>Tanggal Penjualan</th>
                         <th>Nomor Nota</th>
                         <th>Kode Pelanggan</th>
                         <th>Nama Pelanggan</th>
                         <th>Kategori Barang</th>
                         <th>Jenis Barang</th>
                         <th>Kode Barang</th>
                         <th>Nama Barang</th>
                         <th>Satuan Barang</th>
                         <th>Saldo Jumlah Harga Jual</th>
                         <th>Jatuh Tempo Kredit</th>
                         <th>Pelunasan</th>
                         <th>Saldo</th>
                       </tr>
                     </thead>
                     <tbody>
                       <?php
                       $no=0;
                       $sal=0;
                       $sal1=0;
                       $pelunasan= 0;
                       $saldo_final=0;
                       foreach($posts as $p){
                        $no++;
                        ?>
                      <tr>
                        <td><?php echo $no ?></td>
                        <td><?php echo date("d-m-Y",strtotime($p->tanggal_penjualan)) ?></td>
                        <td><?php echo $p->kd_nota ?></td>
                        <td><?php echo $p->kode_pelanggan_baru ?></td>
                        <td><?php echo $p->nama_pembeli ?></td>
                        <td><?php echo $p->kategori_barang ?></td>
                        <td><?php echo $p->jenis_barang ?></td>
                        <td><?php echo $p->kode_barang ?></td>
                        <td><?php echo $p->nama_barang ?></td>
                        <td><?php echo $p->satuan ?></td>
                        <td>Rp <?php $salq = $p->satuan * $p->harga_pokok; echo number_format($salq) ?></td>
                        <td><?php echo date("d-m-Y",strtotime($p->tgl_tempo_kredit)) ?></td>
                        <?php
                        $cari_picis= $this->m_data->where('join_hutang_penjualan',array('id_hutang' => $p->id_hutang))->row();
                        if($cari_picis){
                          $total_picis = $this->m_data->hutang_penjualan_cek($p->id_hutang);
                          $pel = $total_picis->bayar;
                         ?>
                        <td><a href="javascript:void(0)" data-toggle="modal" data-target="#myModalya<?php echo $p->id_hutang ?>"><?php echo $total_picis->bayar ?></a></td>
                      <?php }else{
                        $pel =0;
                        ?>
                        <td>
                          <a href="javascript:void(0)" data-toggle="modal" data-target="#myModalya<?php echo $p->id_hutang ?>">0</a>
                        </td>
                      <?php } ?>
                      <td>
                        <?php
                        if($no == 1){
                          $sal = $salq - $pel;
                        }else{
                          $sal = ($salq + $sal) - $pel;
                        }
                        echo number_format($sal);
                         ?>
                      </td>
                      </tr>
                      <!-- Modal -->
                      <div id="myModalya<?php echo $p->id_hutang ?>" class="modal fade" role="dialog">
                        <div class="modal-dialog <?php echo ($cari_picis) ? 'modal-lg' : '' ?>">

                          <!-- Modal content-->
                          <div class="modal-content">
                            <div class="modal-header">
                              <button type="button" class="close" data-dismiss="modal">&times;</button>
                              <h4 class="modal-title">Pelunasan</h4>
                            </div>
                            <div class="modal-body">
                              <?php
                              if($cari_picis){
                              $cari_picis_loop = $this->m_data->where('join_hutang_penjualan',array('id_hutang' => $p->id_hutang))->result();

                               ?>
                               <div class="box-group" id="accordion">
                                 <!-- we are adding the .panel class so bootstrap.js collapse plugin detects it -->
                                 <?php
                                 $no = 0;
                                 foreach($cari_picis_loop as $l){
                                  $no++
                                  ?>
                                 <div class="panel box box-primary">
                                   <div class="box-header with-border">
                                     <h4 class="box-title">
                                       <a data-toggle="collapse" data-parent="#accordion" href="#collapseOnex<?php echo $no ?>" aria-expanded="false">
                                         <?php echo $l->keterangan ?>
                                       </a>
                                     </h4>
                                   </div>
                                   <div id="collapseOnex<?php echo $no ?>" class="panel-collapse collapse" aria-expanded="false">
                                     <div class="box-body">
                                       <div class="form-group">
                                         <form action="<?php echo base_url('buku_umum/update_bayar_pelunasan/'.$p->id_hutang.'') ?>" method="post">
                                           <div class="form-group">
                                             <label for="">Keterangan</label>
                                             <textarea name="keterangan" class="form-control" rows="4"></textarea>
                                           </div>
                                           <div class="form-group">
                                             <label for="">Tanggal Pembayaran</label>
                                             <input type="text" name="tgl_pembayaran" class="form-control datepicker">
                                           </div>
                                           <div class="form-group">
                                             <label for="">Nominal Pembayaran</label>
                                             <input type="text" name="nominal" class="form-control">
                                           </div>
                                           <div class="form-group">
                                             <button type="submit" class="btn btn-primary btn-flat" name="button">Update Data</button>
                                           </div>
                                         </form>
                                       </div>
                                     </div>
                                   </div>
                                 </div>
                                <?php } ?>
                                <hr>
                                <div class="form-group">
                                  <form action="<?php echo base_url('buku_umum/bayar_pelunasan/'.$p->id_hutang.'') ?>" method="post">
                                    <div class="form-group">
                                      <label for="">Keterangan</label>
                                      <textarea name="keterangan" class="form-control" rows="4"></textarea>
                                    </div>
                                    <div class="form-group">
                                      <label for="">Tanggal Pembayaran</label>
                                      <input type="text" name="tgl_pembayaran" class="form-control datepicker">
                                    </div>
                                    <div class="form-group">
                                      <label for="">Nominal Pembayaran</label>
                                      <input type="text" name="nominal" class="form-control">
                                    </div>
                                    <div class="form-group">
                                      <button type="submit" class="btn btn-primary btn-flat" name="button">Tambah Data</button>
                                    </div>
                                  </form>
                                </div>
                               </div>
                             <?php }else{ ?>
                              <div class="form-group">
                                <form action="<?php echo base_url('buku_umum/bayar_pelunasan/'.$p->id_hutang.'') ?>" method="post">
                                  <!-- <input type="text" name="" value="<?php //echo $p->id_buku_umum ?>"> -->

                                  <div class="form-group">
                                    <label for="">Keterangan</label>
                                    <textarea name="keterangan" class="form-control" rows="4"></textarea>
                                  </div>
                                  <div class="form-group">
                                    <label for="">Tanggal Pembayaran</label>
                                    <input type="text" name="tgl_pembayaran" class="form-control datepicker">
                                  </div>
                                  <div class="form-group">
                                    <label for="">Nominal Pembayaran</label>
                                    <input type="text" name="nominal" class="form-control">
                                  </div>
                                  <div class="form-group">
                                    <button type="submit" class="btn btn-primary btn-flat" name="button">Tambah Data</button>
                                  </div>
                                </form>
                              </div>
                            <?php } ?>
                            </div>
                            <div class="modal-footer">
                              <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                            </div>
                          </div>

                        </div>
                      </div>
                      <?php
                      $salx1[$no] = $salq;
                      $sal_f[$no] = $salq;
                      $pelx[$no] = $pel;
                      $sal1 += $salx1[$no];
                      $pelunasan += $pelx[$no];
                      $saldo_final += $sal_f[$no];
                       ?>
                    <?php } ?>
                     </tbody>
                   </table>
                     <table class="table table-bordered">
                       <tr style="background-color:#2c3e50;color:#fff;">
                         <td><b>Total</b></td>
                         <td> <b>Saldo Jumlah Harga Jual</b> : Rp.&nbsp;<?= number_format($sal1) ?></td>
                         <td> <b>Pelunasan </b> : Rp.&nbsp;<?= number_format($pelunasan) ?></td>
                         <td> <b>Saldo</b> : Rp.&nbsp; <?= number_format($saldo_final)  ?></td>
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
