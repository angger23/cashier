<div class="content-wrapper">
 <div class="container-fluid">
   <section class="content">
   <div class="row">
       <div class="col-md-10">
         <h4><b>Data Buku Bank Kas Toko</b></h4>
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
                  <h4 class="modal-title">Input Buku Bank Kas Toko</h4>
                </div>
                <div class="modal-body">
                  <div class="form-group">
                    <form action="<?php echo base_url('p/tambah_data_buku') ?>" method="post">
                      <div class="form-group">
                        <label for="">Nama Bank</label>
                        <input type="text" name="nm_bank" class="form-control">
                      </div>
                      <div class="form-group">
                        <label for="">Tanggal</label>
                        <input type="text" class="form-control datepicker" name="tanggal">
                      </div>
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
                        <label for="">Uraian</label>
                        <textarea name="uraian" class="form-control" rows="4"></textarea>
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
                        <button type="submit" class="btn btn-primary btn-flat">Input Buku Bank</button>
                      </div>
                    </form>
                  </div>
                </div>
                <div class="modal-footer">
                  <button type="button" class="btn btn-danger btn-flat" data-dismiss="modal">Close</button>
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
         <form method="post" action="<?= base_url('p/buku_bank/ac'); ?>">
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
         <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
         <script>
$(document).ready(function(){
    $(document).ajaxStart(function(){
        $("#wait").css("display", "block");
    });
    $(document).ajaxComplete(function(){
        $("#wait").css("display", "none");
    });
    $("#tab1").click(function(){
      <?php if($this->uri->segment(3) == 'ac'){ ?>
        $("#tab_2").load("<?php echo base_url('p/load_buku2/'.$this->input->post('start_tgl').'/'.$this->input->post('end_tgl').'/'.$this->input->post('operator').'') ?>");
      <?php }else{ ?>
        $("#tab_2").load("<?php echo base_url('p/load_buku2') ?>");
      <?php } ?>
    });
});
</script>
<script>
$(document).ready(function(){
  $(document).ajaxStart(function(){
    $("#wait1").css("display", "block");
  });
  $(document).ajaxComplete(function(){
    $("#wait1").css("display", "none");
  });
  $("#tab2").click(function(){
    <?php if($this->uri->segment(3) == 'ac'){ ?>
      $("#tab_3").load("<?php echo base_url('p/load_buku3/'.$this->input->post('start_tgl').'/'.$this->input->post('end_tgl').'/'.$this->input->post('operator').'') ?>");
    <?php }else{ ?>
      $("#tab_3").load("<?php echo base_url('p/load_buku3') ?>");
    <?php } ?>
  });
});
</script>
<script>
$(document).ready(function(){
  $(document).ajaxStart(function(){
    $("#wait2").css("display", "block");
  });
  $(document).ajaxComplete(function(){
    $("#wait2").css("display", "none");
  });
  $("#tab3").click(function(){
    <?php if($this->uri->segment(3) == 'ac'){ ?>
      $("#tab_4").load("<?php echo base_url('p/load_buku4/'.$this->input->post('start_tgl').'/'.$this->input->post('end_tgl').'/'.$this->input->post('operator').'') ?>");
    <?php }else{ ?>
      $("#tab_4").load("<?php echo base_url('p/load_buku4') ?>");
    <?php } ?>
  });
});
</script>
<script>
$(document).ready(function(){
  $(document).ajaxStart(function(){
    $("#wait3").css("display", "block");
  });
  $(document).ajaxComplete(function(){
    $("#wait3").css("display", "none");
  });
  $("#tab4").click(function(){
    <?php if($this->uri->segment(3) == 'ac'){ ?>
      $("#tab_5").load("<?php echo base_url('p/load_buku5/'.$this->input->post('start_tgl').'/'.$this->input->post('end_tgl').'/'.$this->input->post('operator').'') ?>");
    <?php }else{ ?>
      $("#tab_5").load("<?php echo base_url('p/load_buku5') ?>");
    <?php } ?>
  });
});
</script>
<script>
$(document).ready(function(){
  $(document).ajaxStart(function(){
    $("#wait4").css("display", "block");
  });
  $(document).ajaxComplete(function(){
    $("#wait4").css("display", "none");
  });
  $("#tab5").click(function(){
    <?php if($this->uri->segment(3) == 'ac'){ ?>
      $("#tab_6").load("<?php echo base_url('p/load_buku6/'.$this->input->post('start_tgl').'/'.$this->input->post('end_tgl').'/'.$this->input->post('operator').'') ?>");
    <?php }else{ ?>
      $("#tab_6").load("<?php echo base_url('p/load_buku6') ?>");
    <?php } ?>
  });
});
</script>
<script>
$(document).ready(function(){
  $(document).ajaxStart(function(){
    $("#wait5").css("display", "block");
  });
  $(document).ajaxComplete(function(){
    $("#wait5").css("display", "none");
  });
  $("#tab6").click(function(){
    <?php if($this->uri->segment(3) == 'ac'){ ?>
      $("#tab_7").load("<?php echo base_url('p/load_buku7/'.$this->input->post('start_tgl').'/'.$this->input->post('end_tgl').'/'.$this->input->post('operator').'') ?>");
    <?php }else{ ?>
      $("#tab_7").load("<?php echo base_url('p/load_buku7') ?>");
    <?php } ?>
  });
});
</script>
<script>
$(document).ready(function(){
  $(document).ajaxStart(function(){
    $("#wait6").css("display", "block");
  });
  $(document).ajaxComplete(function(){
    $("#wait6").css("display", "none");
  });
  $("#tab7").click(function(){
    <?php if($this->uri->segment(3) == 'ac'){ ?>
      $("#tab_8").load("<?php echo base_url('p/load_buku8/'.$this->input->post('start_tgl').'/'.$this->input->post('end_tgl').'/'.$this->input->post('operator').'') ?>");
    <?php }else{ ?>
      $("#tab_8").load("<?php echo base_url('p/load_buku8') ?>");
    <?php } ?>
  });
});
</script>
<script>
$(document).ready(function(){
  $(document).ajaxStart(function(){
    $("#wait7").css("display", "block");
  });
  $(document).ajaxComplete(function(){
    $("#wait7").css("display", "none");
  });
  $("#tab8").click(function(){
    <?php if($this->uri->segment(3) == 'ac'){ ?>
      $("#tab_9").load("<?php echo base_url('p/load_buku9/'.$this->input->post('start_tgl').'/'.$this->input->post('end_tgl').'/'.$this->input->post('operator').'') ?>");
    <?php }else{ ?>
      $("#tab_9").load("<?php echo base_url('p/load_buku9') ?>");
    <?php } ?>
  });
});
</script>
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
<div class="col-md-2">
  <button type="button" class="btn btn-warning btn-block btn-flat dropdown-toggle fixedElement" data-toggle="dropdown">
     Cari berdasar Kategori <span class="caret"></span>
     <span class="sr-only">Toggle Dropdown</span>
   </button>
   <div class="dropdown-menu fixedElementul" role="menu">
     <ul class="nav nav-fixed box-sha">
       <li class="active"><a href="#tab_1" class="tabx" data-toggle="tab">Buku Bank Kas Toko All</a></li>
       <li><a href="#tab_2" class="tabx" id="tab1" data-toggle="tab">Biaya Administrasi Bank Kas Toko</a></li>
       <li><a href="#tab_3" class="tabx" id="tab2" data-toggle="tab">Pendapatan Bunga Bank Kas Toko</a></li>
       <li><a href="#tab_4" class="tabx" id="tab3" data-toggle="tab">Setor Tunai Kas Toko</a></li>
       <li><a href="#tab_5" class="tabx" id="tab4" data-toggle="tab">Transfer Masuk Kas Toko</a></li>
       <li><a href="#tab_6" class="tabx" id="tab5" data-toggle="tab">Transfer Keluar Kas Toko</a></li>
       <li><a href="#tab_7" class="tabx" id="tab6" data-toggle="tab">Tarik Tunai Kas Toko</a></li>
       <li><a href="#tab_8" class="tabx" id="tab7" data-toggle="tab">Saldo Bank Bulan Berjalan Kas Toko</a></li>
       <li><a href="#tab_9" class="tabx" id="tab8" data-toggle="tab">Saldo Bank Bulan Yang Lalu Kas Toko</a></li>
     </ul>
   </div>
</div>

         <!-- <div class="col-md-3">
           <ul class="nav nav-tabs nav-fixed fixedElement">
             <li class="active"><a href="#tab_1" data-toggle="tab">Buku Bank Kas Toko All</a></li>
             <li><a href="#tab_2" id="tab1" data-toggle="tab">Biaya Administrasi Bank Kas Toko</a></li>
             <li><a href="#tab_3" id="tab2" data-toggle="tab">Pendapatan Bunga Bank Kas Toko</a></li>
             <li><a href="#tab_4" id="tab3" data-toggle="tab">Setor Tunai Kas Toko</a></li>
             <li><a href="#tab_5" id="tab4" data-toggle="tab">Transfer Masuk Kas Toko</a></li>
             <li><a href="#tab_6" id="tab5" data-toggle="tab">Transfer Keluar Kas Toko</a></li>
             <li><a href="#tab_7" id="tab6" data-toggle="tab">Tarik Tunai Kas Toko</a></li>
             <li><a href="#tab_8" id="tab7" data-toggle="tab">Saldo Bank Bulan Berjalan Kas Toko</a></li>
             <li><a href="#tab_9" id="tab8" data-toggle="tab">Saldo Bank Bulan Yang Lalu Kas Toko</a></li>
           </ul>
         </div> -->
         <div class="col-md-12">
           <hr>
         <div class="tab-content">
           <div class="tab-pane active" id="tab_1" style="background-color:#fff;">
             <!-- wates -->
             <div class="col-md-12">
               <?
                 if($this->uri->segment(3) == 'ac'){
                 ?>
                 <a href="<?= base_url('bank_buku/cetak_buku/'.$this->input->post('start_tgl').'/'.$this->input->post('end_tgl').'/'.$this->input->post('operator').'') ?>" target="_blank" class="btn btn-info btn-flat pull-right" type="button"><i class="fa fa-print"></i> Print</a>
                 <? }else{ ?>
                 <a href="<?= base_url('bank_buku/cetak_buku') ?>" target="_blank" class="btn btn-info btn-flat pull-right" type="button" style="margin:5px;"><i class="fa fa-print"></i> Print</a>
                 <? } ?>
                 <?
                 if($this->uri->segment(3) == 'ac'){
                 ?>
                 <a href="<?= base_url('bank_buku/export_buku/'.$this->input->post('start_tgl').'/'.$this->input->post('end_tgl').'/'.$this->input->post('operator').'') ?>" class="btn btn-success btn-flat pull-right"><i class="fa fa-file-excel-o"></i> Export</a>
                 <? }else{ ?>
                 <a href="<?= base_url('bank_buku/export_buku') ?>" class="btn btn-success btn-flat pull-right" style="margin:5px;"><i class="fa fa-file-excel-o"></i> Export</a>
                 <? } ?>

               </div>
               <br>
              <br>

              <div class="table-responsive" style="width:100%;">
                <table class="table table-bordered datatable">
                  <thead>
                    <tr>
                      <th>No</th>
                      <th>Nama Bank</th>
                      <th>Tanggal</th>
                      <th>Kode</th>
                      <th>Uraian Kode</th>
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
                    $kredit=0;
                    $debit=0;
                    $no=0;
                    $nos=0;
                    foreach($list_bank_toko as $l){
                     $no++;
                     $nos++;
                     ?>
                    <tr>
                      <td><?php echo $nos ?></td>
                      <td><?= $l->nama_bank ?></td>
                      <td><?= date('d-m-Y',strtotime($l->tanggal)) ?></td>
                      <td><?= $l->kode ?></td>
                      <td><?= $l->uraian_kode ?></td>
                      <td><?= $l->uraian ?></td>

                      <td>Rp <?= number_format($l->kredit,2) ?></td>
                      <td>Rp <?= number_format($l->debit,2) ?></td>
                      <td>Rp <? $salq =  $l->kredit - $l->debit; echo number_format($salq,2)  ?></td>
                      <td>Rp
                       <?
                       if($no==1){
                          $sal=$salq;
                       }else{
                     $sal = $salq + $sal ;
                       }
                       echo number_format($sal,2);
                       ?>
                      </td>
                      <td>
                        <button type="button" class="btn btn-info btn-flat" data-toggle="modal" data-target="#myModall<?= $l->id_buku ?>"><i class="fa fa-edit"></i></button>
                        <a href="<?php echo base_url('p/delete_buku/'.$l->id_buku.'') ?>" type="button" class="btn btn-danger btn-flat"><i class="fa fa-trash"></i></a>
                      </td>
                    </tr>
                    <div id="myModall<?= $l->id_buku ?>" class="modal fade" role="dialog">
                         <div class="modal-dialog">
                    <!-- Modal content-->
                   <div class="modal-content">
                     <div class="modal-header">
                       <button type="button" class="close" data-dismiss="modal">&times;</button>
                       <h4 class="modal-title">Update Data Bank Toko</h4>
                     </div>
                     <div class="modal-body">
                       <div class="form-group">
                         <form action="<?php echo base_url('p/update_data_buku/'.$l->id_buku.'') ?>" method="post">
                           <div class="form-group">
                             <label for="">Nama Bank</label>
                             <input type="text" name="nm_bank" class="form-control" value="<?= $l->nama_bank ?>">
                           </div>
                           <div class="form-group">
                             <label for="">Tanggal</label>
                             <input type="text" class="form-control datepicker" name="tanggal" value="<?= $l->tanggal ?>">
                           </div>
                           <div class="form-group">
                             <label for="">Kode Transaksi</label>
                             <select class="form-control selectku" name="kd_transaksi" style="width:100%;">
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
                             <label for="">Uraian</label>
                             <textarea name="uraian" class="form-control" rows="4"><?= $l->uraian ?></textarea>
                           </div>
                           <div class="form-group">

                               <div class="row">


                                 <div class="col-sm-6">
                                   <label for="">Pemasukan</label>
                                   <input type="text" name="kredit" class="form-control" value="<?= $l->kredit ?>">
                                 </div>

                                 <div class="col-sm-6">
                                   <label for="">Pengeluaran</label>
                                   <input type="text" name="debet" class="form-control" value="<?= $l->debit ?>">
                                 </div>
                               </div>

                           </div>
                           <div class="form-group">
                             <button type="submit" class="btn btn-primary btn-flat">Update Buku Bank</button>
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
                    $kre[$no] = $l->kredit;
                    $de[$no] = $l->debit;
                    $debit += $de[$no];
                    $kredit += $kre[$no];
                     ?>
                  <?php } ?>
                  </tbody>
                </table>
              </div>
              <br>
            <table class="table table-bordered">
              <tbody>
                <tr style="background-color:#e74c3c;color:#ffff;">
                  <td colspan="6"><b>Total</b></td>

                  <td>Pemasukan Rp <?= number_format($kredit,2) ?></td>
                  <td>Pengeluaran : Rp <?= number_format($debit,2) ?></td>
                  <td>Saldo : Rp <?= number_format($kredit - $debit,2) ?></td>
                </tr>
              </tbody>
            </table>
             <!-- wates -->
           </div>
           <!-- /.tab-pane -->
           <div class="tab-pane" id="tab_2" style="background-color:#fff;">
             <!-- loading  -->
             <div id="wait" style="display:none;width:69px;height:89px;border:1px solid black;position:absolute;top:50%;left:50%;padding:2px;">
               <img src='<?php echo base_url() ?>images/demo_wait.gif' width="64" height="64" /><br>Loading..</div>
             <!-- loading  -->
           </div>
           <!-- /.tab-pane -->
           <div class="tab-pane" id="tab_3" style="background-color:#fff;">
             <div id="wait1" style="display:none;width:69px;height:89px;border:1px solid black;position:absolute;top:50%;left:50%;padding:2px;">
               <img src='<?php echo base_url() ?>images/demo_wait.gif' width="64" height="64" /><br>Loading..</div>
           </div>

           <div class="tab-pane" id="tab_4" style="background-color:#fff;">
             <div id="wait2" style="display:none;width:69px;height:89px;border:1px solid black;position:absolute;top:50%;left:50%;padding:2px;">
               <img src='<?php echo base_url() ?>images/demo_wait.gif' width="64" height="64" /><br>Loading..</div>
           </div>

           <div class="tab-pane" id="tab_5" style="background-color:#fff;">
             <div id="wait3" style="display:none;width:69px;height:89px;border:1px solid black;position:absolute;top:50%;left:50%;padding:2px;">
               <img src='<?php echo base_url() ?>images/demo_wait.gif' width="64" height="64" /><br>Loading..</div>
           </div>

           <div class="tab-pane" id="tab_6" style="background-color:#fff;">
             <div id="wait4" style="display:none;width:69px;height:89px;border:1px solid black;position:absolute;top:50%;left:50%;padding:2px;">
               <img src='<?php echo base_url() ?>images/demo_wait.gif' width="64" height="64" /><br>Loading..</div>
           </div>

           <div class="tab-pane" id="tab_7" style="background-color:#fff;">
             <div id="wait5" style="display:none;width:69px;height:89px;border:1px solid black;position:absolute;top:50%;left:50%;padding:2px;">
               <img src='<?php echo base_url() ?>images/demo_wait.gif' width="64" height="64" /><br>Loading..</div>
           </div>

           <div class="tab-pane" id="tab_8" style="background-color:#fff;">
             <div id="wait6" style="display:none;width:69px;height:89px;border:1px solid black;position:absolute;top:50%;left:50%;padding:2px;">
               <img src='<?php echo base_url() ?>images/demo_wait.gif' width="64" height="64" /><br>Loading..</div>
           </div>

           <div class="tab-pane" id="tab_9" style="background-color:#fff;">
             <div id="wait7" style="display:none;width:69px;height:89px;border:1px solid black;position:absolute;top:50%;left:50%;padding:2px;">
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
