<div class="content-wrapper">
 <div class="container-fluid">
   <section class="content">
   <div class="row">
       <div class="col-md-10">
         <h4><b>Data Buku Kas Umum <?php echo ($this->uri->segment(3) == 'all') ? 'Anggota' : $this->uri->segment(3) ?></b></h4>
       </div>
       <div class="col-md-2">
         <button type="button" class="btn btn-primary btn-flat pull-right" data-toggle="modal" data-target="#myModal" style="margin:5px;"><i class="fa fa-plus"></i> Input Buku Bank</button>
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
                          <option value="Kas di Bendahara Toko">Kas di Bendahara Toko</option>
                          <option value="Kas di Bank Toko">Kas di Bank Toko</option>
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
                              <label for="">Debet (Pengeluaran)</label>
                              <input type="text" name="debet" class="form-control">
                            </div>
                            <div class="col-sm-6">
                              <label for="">Kredit (Pemasukan)</label>
                              <input type="text" name="kredit" class="form-control">
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
       <div class="col-md-12">
         <form method="post" action="<?= base_url('buku_umum/home/'.$this->uri->segment(3).'/ac'); ?>">
           <div class="col-md-3">
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
             <div class="form-group">
               <label>Operator</label>
               <select class="form-control selectku" name="operator">
                 <option value="">Pilih Operator</option>
                 <?
                 foreach($operator as $o):
                 ?>
                 <option value="<?= $o->id ?>"><?= $o->first_name ?></option>
                 <? endforeach; ?>
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
       <div class="col-md-12">
         <hr>
         <div class="tab-content">
           <div class="tab-pane active" id="tab_1" style="background-color:#fff;">
             <!-- wates -->
               <div id="loadx">
                  <div class="col-md-12" style="padding-right:0px;">
                     <?
                       if($this->uri->segment(4) == 'ac'){
                       ?>
                       <a href="<?= base_url('buku_umum/cetak_buku_umum/'.$this->input->post('start_tgl').'/'.$this->input->post('end_tgl').'/'.$this->input->post('operator').'/'.$this->uri->segment('3').'') ?>" target="_blank" class="btn btn-info btn-flat pull-right" type="button"><i class="fa fa-print"></i> Print</a>
                       <? }else{ ?>
                       <a href="<?= base_url('buku_umum/cetak_buku_umum/'." ".'/'." ".'/'." ".'/'.$this->uri->segment('3').'') ?>" target="_blank" class="btn btn-info btn-flat pull-right" type="button" style="margin:5px;"><i class="fa fa-print"></i> Print</a>
                       <? } ?>
                       <?
                       if($this->uri->segment(4) == 'ac'){
                       ?>
                       <a href="<?= base_url('buku_umum/export_buku_umum/'.$this->input->post('start_tgl').'/'.$this->input->post('end_tgl').'/'.$this->input->post('operator').'/'.$this->uri->segment('3').'') ?>" class="btn btn-success btn-flat pull-right"><i class="fa fa-file-excel-o"></i> Export</a>
                       <? }else{ ?>
                       <a href="<?= base_url('buku_umum/export_buku_umum/'." ".'/'." ".'/'." ".'/'.$this->uri->segment('3').'') ?>" class="btn btn-success btn-flat pull-right" style="margin:5px;"><i class="fa fa-file-excel-o"></i> Export</a>
                       <? } ?>
                   </div>
                   <br>
                  <br>
                    <div class="table table-responsive">
                        <table class="table table-bordered">
                          <thead>
                            <tr>
                              <th rowspan="2">No</th>
                              <th rowspan="2">Nama Karyawan</th>
                              <th rowspan="2">Unit Kerja</th>
                              <th rowspan="2">Tanggal Keanggotaan</th>
                              <th rowspan="2">Tanggal Peminjaman</th>
                              <th rowspan="2">Tanggal Jatuh Tempo</th>
                              <th rowspan="2">Jangka Waktu (Bulan)</th>
                              <th rowspan="2">Pengeluaran (Pokok Pinjaman)</th>
                              <th rowspan="2">Bunga Pinjaman (2%)</th>
                              <th rowspan="2">Total Pinjaman</th>
                              <th rowspan="2">Hitung Angsuran Pokok</th>
                              <th rowspan="2">Hitung Angsuran Bunga</th>
                              <th colspan="2">Pendapatan (Pelunasan)</th>
                              <th rowspan="2">Saldo Pokok</th>
                            </tr>
                            <tr>
                              <!-- <th colspan="12"></th> -->
                              <th >Tanggal</th>
                              <th >Nilai (Rp)</th>
                            </tr>
                          </thead>
                          <tbody>
                            
                            <tr>
                              <td>John</td>
                              <td>Doe</td>
                              <td>john@example.com</td>
                              <th>Email</th>
                              <th>Email</th>
                              <th>Email</th>
                              <th>Email</th>
                              <th>Email</th>
                              <th>Email</th>
                              <th>Email</th>
                              <th>Email</th>
                              <th>Email</th>
                              <th>Email</th>
                              <th>Email</th>
                              <th></th>
                            </tr>
                            
                          </tbody>
                        </table>                
                     </div>
                      </div>
             <!-- wates -->
           </div>
           <!-- /.tab-pane -->
           <div class="tab-pane" id="tab_2" style="background-color:#fff;">
             <!-- loading  -->
             <div id="wait1" style="display:none;width:69px;height:89px;position:absolute;top:50%;left:50%;padding:2px;">
               <img src='<?php echo base_url() ?>images/demo_wait.gif' width="64" height="64" /><br>Loading..</div>
             <!-- loading  -->
           </div>
           <!-- /.tab-pane -->
           <div class="tab-pane" id="tab_3" style="background-color:#fff;">
             <!-- loading  -->
             <div id="wai2" style="display:none;width:69px;height:89px;position:absolute;top:50%;left:50%;padding:2px;">
               <img src='<?php echo base_url() ?>images/demo_wait.gif' width="64" height="64" /><br>Loading..</div>
             <!-- loading  -->
           </div>
           <!-- /.tab-pane -->
           <div class="tab-pane" id="tab_4" style="background-color:#fff;">
             <!-- loading  -->
             <div id="wait3" style="display:none;width:69px;height:89px;position:absolute;top:50%;left:50%;padding:2px;">
               <img src='<?php echo base_url() ?>images/demo_wait.gif' width="64" height="64" /><br>Loading..</div>
             <!-- loading  -->
           </div>
           <div class="tab-pane" id="tab_5" style="background-color:#fff;">
             <!-- loading  -->
             <div id="wait4" style="display:none;width:69px;height:89px;position:absolute;top:50%;left:50%;padding:2px;">
               <img src='<?php echo base_url() ?>images/demo_wait.gif' width="64" height="64" /><br>Loading..</div>
             <!-- loading  -->
           </div>
           <div class="tab-pane" id="tab_6" style="background-color:#fff;">
             <!-- loading  -->
             <div id="wait5" style="display:none;width:69px;height:89px;position:absolute;top:50%;left:50%;padding:2px;">
               <img src='<?php echo base_url() ?>images/demo_wait.gif' width="64" height="64" /><br>Loading..</div>
             <!-- loading  -->
           </div>
           <div class="tab-pane" id="tab_7" style="background-color:#fff;">
             <!-- loading  -->
             <div id="wait6" style="display:none;width:69px;height:89px;position:absolute;top:50%;left:50%;padding:2px;">
               <img src='<?php echo base_url() ?>images/demo_wait.gif' width="64" height="64" /><br>Loading..</div>
             <!-- loading  -->
           </div>
           <div class="tab-pane" id="tab_8" style="background-color:#fff;">
             <div class="wait7" style="display:none;width:69px;height:89px;border:1px solid black;position:absolute;top:50%;left:50%;padding:2px;">
               <img src='<?php echo base_url() ?>images/demo_wait.gif' width="64" height="64" /><br>Loading..</div>
           </div>
           <div class="tab-pane" id="tab_9" style="background-color:#fff;">
             <div id="wait8" style="display:none;width:69px;height:89px;border:1px solid black;position:absolute;top:50%;left:50%;padding:2px;">
               <img src='<?php echo base_url() ?>images/demo_wait.gif' width="64" height="64" /><br>Loading..</div>
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
