<div id="loadx">
   <div class="col-md-12" style="padding-right:0px;">
     <?
       if(!empty($tgl) && !empty($tgl1)){
       ?>
       <a href="<?= base_url('buku_umum/cetak_buku_umum/'.$tgl.'/'.$tgl1.'/'.$kd.'/') ?>" target="_blank" class="btn btn-info btn-flat pull-right" type="button"><i class="fa fa-print"></i> Print</a>
       <? }else{ ?>
       <a href="<?= base_url('buku_umum/cetak_buku_umum/') ?>" target="_blank" class="btn btn-info btn-flat pull-right" type="button" style="margin:5px;"><i class="fa fa-print"></i> Print</a>
       <? } ?>
       <?
       if(!empty($tgl) && !empty($tgl1)){
       ?>
       <a href="<?= base_url('buku_umum/export_buku_umum/'.$tgl.'/'.$tgl1.'/'.$kd.'/') ?>" class="btn btn-success btn-flat pull-right"><i class="fa fa-file-excel-o"></i> Export</a>
       <? }else{ ?>
       <a href="<?= base_url('buku_umum/export_buku_umum/') ?>" class="btn btn-success btn-flat pull-right" style="margin:5px;"><i class="fa fa-file-excel-o"></i> Export</a>
       <? } ?>
    </div>
    <br>
   <br>
     <div class="table table-responsive">
      <table class="table table-bordered">
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


     if(!empty($postsq)):
       // echo $postsC->no_urut;
       $get_all_saldo = $this->m_data->getrays('1',$postsC->no_urut)->result();
       $sal=0;
       // $no=$postsC->no_urut;
       $no=0;
       $nos=$this->input->post('page');
       $saldo_sbelum=0;
       foreach($get_all_saldo as $g){$itung =  $g->kredit - $g->debit;$saldo_sbelum += $itung;}
       // echo $saldo_sbelum;
        foreach($postsq as $l):
           $no++;
           $nos++;
           ?>
          <tr>
            <td>
              <a href="#" class="urut" name="urut<?php echo $l->id_buku_umum ?>" data-placement="right" data-type="text" data-pk="<?php echo $l->id_buku_umum ?>" data-url="<?php echo base_url('buku_umum/nomor_urut') ?>" data-title="Ganti Nomor Urut" style="font-size:20px;">
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
            if($no == 1 && $nos == 1 || $nos == 0){
              $sal=$salq;
            // }elseif($nos != 0 && $nos != 1){
            }elseif($no == 1 ){
                $sal += $saldo_sbelum;
                // $sal=$salq;
                // echo $salq;
                // echo 'yaaa';
             }else{
           $sal = $salq + $sal ;

             }
             echo number_format($sal,2);
             ?>
            </td>
            <td>
              <button type="button" class="btn btn-info btn-flat btn-sm btn-block" data-toggle="modal" data-target="#myModall<?= $l->id_buku_umum ?>"><i class="fa fa-edit"></i></button>
              <a href="<?php echo base_url('buku_umum/delete_umumq/'.$l->id_buku_umum.'') ?>" type="button" class="btn btn-danger btn-flat btn-sm btn-block"><i class="fa fa-trash"></i></a>
            </td>
            <?php
            // $this->m_data->update_data(array('id_buku_umum' => $l->id_buku_umum),array('no_urut' => $nos),'buku_umum');
             ?>
            <!-- <td><?php //echo $l->id_buku_umum ?></td> -->
          </tr>
          <div id="myModall<?= $l->id_buku_umum ?>" class="modal fade" role="dialog">
               <div class="modal-dialog">
          <!-- Modal content-->
          <div class="modal-content">
           <div class="modal-header">
             <button type="button" class="close" data-dismiss="modal">&times;</button>
             <h4 class="modal-title">Update Data Buku Umum Toko</h4>
           </div>
           <div class="modal-body">
             <div class="form-group">
               <div class="form-group">
                 <label for="">Tanggal</label>
                 <input type="text" class="form-control datepickers" id="tanggalku<?php echo $l->id_buku_umum ?>" value="<?= $l->tanggal ?>">
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
                   <button type="button" class="btn btn-primary btn-flat disabled" id="butloading<?php echo $l->id_buku_umum ?>"><i class="fa fa-refresh fa-spin"></i> Loading ....</button>
                 </div>
               <!-- </form> -->
               <script>
               $('#butloading<?php echo $l->id_buku_umum ?>').hide();
                function unliked<?php echo $l->id_buku_umum ?>(id2){
                  $('#butloading<?php echo $l->id_buku_umum ?>').show();
                  $('#but<?php echo $l->id_buku_umum ?>').hide();

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
                        $('#butloading<?php echo $l->id_buku_umum ?>').hide();
                        $('#but<?php echo $l->id_buku_umum ?>').show();
                        showsucces('Berhasil Update Data !');
                      },
                    error: function (data) {
                      $('#butloading<?php echo $l->id_buku_umum ?>').hide();
                      $('#but<?php echo $l->id_buku_umum ?>').show();
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
       <script type="text/javascript">
         $(document).ready(function(){
           $('.datepickers').datetimepicker({
             format: 'YYYY-MM-DD'
           });

         });
       </script>
