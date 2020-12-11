<!-- wates -->
<div class="col-md-12">
  <?
    if(!empty($tgl)){
    ?>
    <a href="<?= base_url('bank_buku/cetak_buku1/'.$tgl.'/'.$tgl1.'/'.$id.'/TKKT/tambah') ?>" target="_blank" class="btn btn-info btn-flat pull-right" type="button"><i class="fa fa-print"></i> Print</a>
    <? }else{ ?>
    <a href="<?= base_url('bank_buku/cetak_buku1/0/0/0/TKKT/tambah') ?>" target="_blank" class="btn btn-info btn-flat pull-right" type="button" style="margin:5px;"><i class="fa fa-print"></i> Print</a>
    <? } ?>
    <?
    if(!empty($tgl)){
    ?>
    <a href="<?= base_url('bank_buku/export_buku1/'.$tgl.'/'.$tgl1.'/'.$id.'/TKKT/tambah') ?>" class="btn btn-success btn-flat pull-right"><i class="fa fa-file-excel-o"></i> Export</a>
    <? }else{ ?>
    <a href="<?= base_url('bank_buku/export_buku1/0/0/0/TKKT/tambah') ?>" class="btn btn-success btn-flat pull-right" style="margin:5px;"><i class="fa fa-file-excel-o"></i> Export</a>
    <? } ?>

  </div>
  <br>
 <br>
 <?php
 $no=0;
 $sal=0;
 $kredit=0;
 $debit=0;
 foreach($list_bank_toko4 as $l){
  $no++;
  $salq = $l->debit - $l->kredit;
if($no==1){
      $sal=$salq;
   }else{
 $sal = $salq + $sal ;
   }
  $kre[$no] = $l->kredit;
  $de[$no] = $l->debit;
  $debit += $de[$no];
  $kredit += $kre[$no];
   ?>
<?php } ?>
 <div class="col-md-12">
    <p style="padding:5px 10px;background-color:#ffbe76;"><b>Saldo</b> : <b>Rp. <?= number_format($debit); ?></b></p>
 </div>
<div class="table-responsive" style="width:100%">
  <table class="table table-bordered datatable-biasa5">
    <thead>
      <tr>
        <th>No</th>
        <th>Nama Bank</th>
        <th>Tanggal</th>
        <th>Kode</th>
        <th>Uraian Kode</th>
        <th>Keterangan</th>
        <th>Pengeluaran (Debit)</th>
        <th>Pemasukan (Kredit)</th>
        <th>Aksi</th>
      </tr>
    </thead>
    <tbody>
      <?php
      $no=0;
      $sal=0;
      $kredit=0;
      $debit=0;
      foreach($list_bank_toko4 as $l){
       $no++;
       ?>
      <tr>
        <td><?php echo $no ?></td>
        <td><?= $l->nama_bank ?></td>
        <td><?= date('d-m-Y',strtotime($l->tanggal)) ?></td>
        <td><?= $l->kode ?></td>
        <td><?= $l->uraian_kode ?></td>
        <td><?= $l->uraian ?></td>
        <td>Rp <?= number_format($l->debit) ?></td>
        <td>Rp <?= number_format($l->kredit) ?></td>
         <? $salq = $l->debit - $l->kredit; ?>

         <?
         if($no==1){
            $sal=$salq;
         }else{
       $sal = $salq + $sal ;
         }
        // echo number_format($sal);
         ?>

        <td>
          <button type="button" class="btn btn-info btn-flat" data-toggle="modal" data-target="#myModall<?= $l->id_buku ?>1"><i class="fa fa-edit"></i></button>
          <a href="<?php echo base_url('p/delete_buku/'.$l->id_buku.'') ?>" type="button" class="btn btn-danger btn-flat"><i class="fa fa-trash"></i></a>
        </td>
      </tr>
      <div id="myModall<?= $l->id_buku ?>1" class="modal fade" role="dialog">
           <div class="modal-dialog">
      <!-- Modal content-->
     <div class="modal-content">
       <div class="modal-header">
         <button type="button" class="close" data-dismiss="modal">&times;</button>
         <h4 class="modal-title">Update Data Bank Toko</h4>
       </div>
       <div class="modal-body">
         <div class="form-group">
           <form id="aduhai<?= $l->id_buku ?>" method="post">
             <div class="form-group">
               <label for="">Nama Bank</label>
               <input type="text" name="nm_bank" id="nama_bank<?= $l->id_buku ?>" class="form-control" value="<?= $l->nama_bank ?>">
             </div>
             <div class="form-group">
               <label for="">Tanggal</label>
               <input type="text" class="form-control datepicker" id="tanggal<?= $l->id_buku ?>" name="tanggal" value="<?= $l->tanggal ?>">
             </div>
             <div class="form-group">
               <label for="">Kode Transaksi</label>
               <select class="form-control selectku" id="kd_transaksi<?= $l->id_buku ?>" name="kd_transaksi" style="width:100%;">
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
               <textarea name="uraian" id="uraian<?= $l->id_buku ?>" class="form-control" rows="4"><?= $l->uraian ?></textarea>
             </div>
             <div class="form-group">

                 <div class="row">
                   <div class="col-sm-6">
                     <label for="">Debit</label>
                     <input type="text" id="debet<?= $l->id_buku ?>" name="debet" class="form-control" value="<?= $l->debit ?>">
                   </div>
                   <div class="col-sm-6">
                     <label for="">Kredit</label>
                     <input type="text" id="kredit<?= $l->id_buku ?>" name="kredit" class="form-control" value="<?= $l->kredit ?>">
                   </div>
                 </div>

             </div>
             <div class="form-group">
               <button type="button" id="simpan<?= $l->id_buku ?>" class="btn btn-primary btn-flat">Update Buku Bank</button>
             </div>
           </form>
           <script type="text/javascript">
            $(document).ready(function(){
              $('#simpan<?= $l->id_buku ?>').click(function(){
                  var nm_bank = $('#nama_bank<?= $l->id_buku ?>').val();
                  var kd_transaksi = $('#kd_transaksi<?= $l->id_buku ?>').val();
                  var tanggal = $('#tanggal<?= $l->id_buku ?>').val();
                  var uraian = $('#uraian<?= $l->id_buku ?>').val();
                  var debet = $('#debet<?= $l->id_buku ?>').val();
                  var kredit = $('#kredit<?= $l->id_buku ?>').val();
                  var id = <?= $l->id_buku ?>;
                  document.location.hash = '';
                  document.location = "<?= base_url('p/update_buku1/') ?>"+nm_bank+"/"+kd_transaksi+"/"+tanggal+"/"+uraian+"/"+debet+"/"+kredit+"/"+id;
              });
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
<table class="table table-bordered">
  <tbody>
    <tr style="background-color:#e74c3c;color:#ffff;">
      <td colspan="6"><b>Total</b></td>
      <td>Pengeluaran (Debit) : Rp <?= number_format($debit) ?></td>
      <td>Pemasukan (Kredit) : Rp <?= number_format($kredit) ?></td>
    </tr>
  </tbody>
</table>
<!-- wates -->
<script type="text/javascript">
	$(document).ready(function(){

        $('.datatable-biasa5').DataTable({
            buttons: true,
        });
	});
</script>
