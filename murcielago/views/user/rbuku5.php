<!-- wates -->
<div class="col-md-9" style="padding:0px;">
  <?
  $saldo = 0;
  $debit = 0;
  $no = 0;
  foreach($daftar_bank_anggota as $l){
  $no++;
  $de[$no] = $l->debit;
  $debit += $de[$no];
  }
  ?>
  <p style="margin: 0px;font-weight: 600;background-color: #9b59b6;color:#fff;padding: 8px;">Saldo : Rp. <?= number_format($debit); ?></p>
</div>
<div class="col-md-3" style="padding-right:0px;">
  <?
    if($this->uri->segment(3) == 'ac'){
    ?>
    <a href="<?= base_url('buku_anggota/cetak_buku1/'.$this->input->post('start_tgl').'/'.$this->input->post('end_tgl').'/'.$this->input->post('operator').'/TTKA/tambah') ?>" target="_blank" class="btn btn-info btn-flat pull-right" type="button"><i class="fa fa-print"></i> Print</a>
    <? }else{ ?>
    <a href="<?= base_url('buku_anggota/cetak_buku1/0/0/0/TTKA/tambah') ?>" target="_blank" class="btn btn-info btn-flat pull-right" type="button"><i class="fa fa-print"></i> Print</a>
    <? } ?>
    <?
    if($this->uri->segment(3) == 'ac'){
    ?>
    <a href="<?= base_url('buku_anggota/export_buku1/'.$this->input->post('start_tgl').'/'.$this->input->post('end_tgl').'/'.$this->input->post('operator').'/TTKA/tambah') ?>" class="btn btn-success btn-flat pull-right"><i class="fa fa-file-excel-o"></i> Export</a>
    <? }else{ ?>
    <a href="<?= base_url('buku_anggota/export_buku1/0/0/0/TTKA/tambah') ?>" class="btn btn-success btn-flat pull-right"><i class="fa fa-file-excel-o"></i> Export</a>
    <? } ?>

  </div>
  <br>
 <br>
  <table class="table table-bordered datatable-biasa5">
    <thead>
      <tr>
        <th>No</th>
        <th>Nama Bank</th>
        <th>Tanggal</th>
        <th>Kode</th>
        <th>Uraian Kode</th>
        <th>Keterangan</th>
        <th>Pengeluaran (Debet)</th>
        <th>Pemasukan (Kredit)</th>
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
      foreach($daftar_bank_anggota as $l){
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
        <td>Rp <?= number_format($l->debit) ?></td>
        <td>Rp <?= number_format($l->kredit) ?></td>
        <td>
          <button type="button" class="btn btn-info btn-flat btn-block" data-toggle="modal" data-target="#myModall<?= $l->id_buku ?>5"><i class="fa fa-edit"></i></button>
          <a href="<?php echo base_url('buku_anggota/delete_buku_anggota/'.$l->id_buku.'') ?>" type="button" class="btn btn-danger btn-flat btn-block"><i class="fa fa-trash"></i></a>
        </td>
      </tr>
      <div id="myModall<?= $l->id_buku ?>5" class="modal fade" role="dialog">
           <div class="modal-dialog">
      <!-- Modal content-->
     <div class="modal-content">
       <div class="modal-header">
         <button type="button" class="close" data-dismiss="modal">&times;</button>
         <h4 class="modal-title">Update Data Bank Toko</h4>
       </div>
       <div class="modal-body">
         <div class="form-group">
             <div class="form-group">
               <label for="">Nama Bank</label>
               <input type="text" name="nm_bank" id="nama_bank" class="form-control" value="<?= $l->nama_bank ?>">
             </div>
             <div class="form-group">
               <label for="">Tanggal</label>
               <input type="text" class="form-control datepicker" id="tanggal" name="tanggal" value="<?= $l->tanggal ?>">
             </div>
             <div class="form-group">
               <label for="">Kode Transaksi</label>
               <select class="form-control selectku" id="kd_transaksi" name="kd_transaksi" style="width:100%;">
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
               <textarea name="uraian" class="form-control" id="uraian" rows="4"><?= $l->uraian ?></textarea>
             </div>
             <div class="form-group">
               <div class="row">
                 <div class="col-sm-6">
                   <label for="">Debet</label>
                   <input type="text" name="debet" id="debet" class="form-control" value="<?= $l->debit ?>">
                 </div>
                 <div class="col-sm-6">
                   <label for="">Kredit</label>
                   <input type="text" name="kredit" id="kredit" class="form-control" value="<?= $l->kredit ?>">
                 </div>
               </div>
             </div>
             <div class="form-group">
               <a id="simpan" class="btn btn-success btn-flat">Simpan</a>
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

 <script type="text/javascript">
  $(document).ready(function(){
    $('#simpan').click(function(){
        var nm_bank = $('#nama_bank').val();
        var kd_transaksi = $('#kd_transaksi').val();
        var tanggal = $('#tanggal').val();
        var uraian = $('#uraian').val();
        var debet = $('#debet').val();
        var kredit = $('#kredit').val();
        var id = <?= $l->id_buku ?>;
        document.location.hash = '';
        document.location = "<?= base_url('buku_anggota/update_ajax_buku_anggota/') ?>"+nm_bank+"/"+kd_transaksi+"/"+tanggal+"/"+uraian+"/"+debet+"/"+kredit+"/"+id;
    });
  });
 </script>

      <?php
      $kre[$no] = $l->kredit;
      $de[$no] = $l->debit;
      $debit += $de[$no];
      $kredit += $kre[$no];
       ?>
    <?php } ?>

    </tbody>
  </table>
  <table class="table table-bordered">
    <tr style="background-color:#2c3e50;color:#fff;">
      <td colspan="6"><b>Total</b></td>
      <td> <b>Pengeluaran (Debet)</b> : Rp <?= number_format($debit) ?></td>
      <td> <b>Pemasukan (Kredit)</b> : Rp <?= number_format($kredit) ?></td>
    </tr>
  </table>
<!-- wates -->
<script type="text/javascript" src="<?php echo base_url() ?>assets_kasir/js/jquery.min.js"></script>
<script type="text/javascript" src="<?php echo base_url() ?>assets_kasir/plugins/datatable/datatables.js"></script>
<script type="text/javascript" src="<?php echo base_url() ?>assets_kasir/plugins/datatable/buttons.html5.min.js"></script>
<script type="text/javascript" src="<?php echo base_url() ?>assets_kasir/plugins/datatable/buttons.print.min.js"></script>
<script type="text/javascript" src="<?php echo base_url() ?>assets_kasir/plugins/datatable/dataTables.buttons.min.js"></script>
<script type="text/javascript" src="<?php echo base_url() ?>assets_kasir/plugins/datatable/jszip.min.js"></script>
<script type="text/javascript" src="<?php echo base_url() ?>assets_kasir/plugins/datatable/pdfmake.min.js"></script>
<script type="text/javascript" src="<?php echo base_url() ?>assets_kasir/plugins/datatable/vfs_fonts.js"></script>
<script type="text/javascript" src="<?php echo base_url() ?>assets_kasir/plugins/moment/moment.js"></script>


<script type="text/javascript">
  $(document).ready(function(){
    $('.datatable5').DataTable( {
        dom: 'Bfrtip',
        buttons: [
            'copyHtml5',
            'excelHtml5',
            'csvHtml5',
            'pdfHtml5',
            'print'
        ]
        });
        $('.datatable-biasa5').DataTable({
            buttons: false,
        });
  });
</script>
