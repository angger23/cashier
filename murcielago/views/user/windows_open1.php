<div class="content-wrapper">
 <div class="container-fluid">
   <section class="content">
   <div class="row">
       <div class="col-md-10">
         <h4><b>Data Monitoring Simpanan Pokok</b></h4>
       </div>
       <div class="col-md-2">
         <button type="button" class="btn btn-primary btn-flat pull-right" data-toggle="modal" data-target="#myModal" style="margin:5px;"><i class="fa fa-plus"></i> Input Simpanan Pokok</button>
         <!-- Modal -->
          <div id="myModal" class="modal fade" role="dialog">
            <div class="modal-dialog">
              <!-- Modal content-->
              <div class="modal-content">
                <div class="modal-header">
                  <button type="button" class="close" data-dismiss="modal">&times;</button>
                  <h4 class="modal-title">Input Simpanan Pokok</h4>
                </div>
                <div class="modal-body">
                  <div class="form-group">
                    <form method="post" action="<?php echo base_url('buku_umum/add_simpanan_pokok1') ?>">
                      <div class="form-group">
                        <label>Nama Pegawai</label>
                        <select class="form-control selectku" name="pegawai" style="width: 100%;">
                          <option value="">Pilih Nama Pegawai</option>
                          <?php 
                          $peg = $this->m_data->semua('anggota_terbaru_2018')->result();
                          foreach($peg as $p){
                           ?>
                          <option value="<?php echo $p->id_anggota ?>"><?php echo $p->nama_anggota ?></option>
                        <?php } ?>
                        </select>
                      </div>
                      <div class="form-group">
                        <label>Tanggal Awal Keanggotaan</label>
                        <input type="text" class="form-control datepicker" name="tgl_anggota">
                      </div>
                      <div class="form-group">
                        <label>Simpanan Pokok</label>
                        <input type="number" class="form-control" name="sp">
                      </div>
                      <div class="form-group">
                        <button class="btn btn-primary btn-flat">Tambah</button>
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
                    <!-- export btn -->
                   </div>
                   <br>
                  <br>
                    <div class="table table-responsive">
                        <table class="table table-bordered">
                          <thead>
                            <tr>
                              <th>No</th>
                              <th>Nama</th>
                              <th>Status Pegawai</th>
                              <th>NIK</th>
                              <th>Unit</th>
                              <th>Jabatan</th>
                              <th>Tanggal Awal Keanggotaan</th>
                              <th>Simpanan Pokok (Rp)</th>
                            </tr>
                          </thead>
                          <tbody>
                            <?php 
                            $sp = $this->m_data->simpanan_pokokk()->result();
                            $no=0;
                            foreach($sp as $s){
                            $no++;
                            ?>
                            <tr>
                              <td><?php echo $no ?></td>
                              <td><?php echo $s->nama_anggota ?></td>
                              <td><?php echo $s->status_pegawai ?></td>
                              <td><?php echo $s->nik ?></td>
                              <td><?php echo $s->unit ?></td>
                              <td><?php echo $s->jabatan ?></td>
                              <td><?php echo date('d-m-Y',strtotime($s->tanggal_keanggotaan)) ?></td>
                              <td>Rp <?php echo number_format($s->simpanan_pokok) ?></td>
                            </tr>
                          <?php } ?>
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
