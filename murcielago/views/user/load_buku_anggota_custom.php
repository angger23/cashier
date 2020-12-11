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
                     <table class="table table-bordered datatable-biasa3">
                       <thead>
                         <tr>
                           <th>No</th>
                           <th>Tanggal</th>
                           <th>Kode</th>
                           <th>Uraian Kode</th>
                           <th>Alat Bayar</th>
                           <th>Keterangan</th>
                           <th>Pengeluaran</th>
                           <th>Pemasukan</th>
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
                         foreach($list_buku_umum as $l){
                          $no++;
                          $nos++;
                          ?>
                         <tr>
                           <td><?php echo $nos ?></td>
                           <td><?= date('d-m-Y',strtotime($l->tanggal)) ?></td>
                           <td><?= $l->kode ?></td>
                           <td><?= $l->uraian_kode ?></td>
                           <td><?php echo $l->alat_bayar ?></td>
                           <td><?= $l->keterangan ?></td>
                           <td>Rp. <?= number_format($l->debit) ?></td>
                           <td>Rp. <?= number_format($l->kredit) ?></td>
                           <td>Rp. <? $salq =  $l->kredit - $l->debit; echo number_format($salq)  ?></td>
                           <td>Rp. <?
                            if($no==1){
                               $sal=$salq;
                            }else{
                          $sal = $salq + $sal ;
                            }
                            echo number_format($sal);
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
                            <h4 class="modal-title">Update Data Umum Anggota</h4>
                          </div>
                          <div class="modal-body">
                            <div class="form-group">
                              <form action="<?php echo base_url('buku_umum/update_buku_umum/'.$l->id_buku_umum.'') ?>" method="post">
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
                                  <label>Alat Bayar</label>
                                  <select class="form-control selectku" name="alat" style="width:100%;">
                                    <option value="">Pilih Alat Bayar</option>
                                    <option value="Kas di Bendahara Toko" <?php echo ($l->alat_bayar == 'Kas di Bendahara Toko') ? 'selected' : '' ?>>Kas di Bendahara Toko</option>
                                    <option value="Kas di Bank Toko" <?php echo ($l->alat_bayar == 'Kas di Bank Toko') ? 'selected' : '' ?>>Kas di Bank Toko</option>
                                    <option value="Kas di Lain-Lain" <?php echo ($l->alat_bayar == 'Kas di Lain-Lain') ? 'selected' : '' ?>>Kas di Lain-Lain</option>
                                  </select>
                                </div>
                                <div class="form-group">
                                  <label for="">Uraian</label>
                                  <textarea name="uraian" class="form-control" rows="4"><?= $l->keterangan ?></textarea>
                                </div>
                                <div class="form-group">
                                    <div class="row">
                                      <div class="col-sm-6">
                                        <label for="">Debet</label>
                                        <input type="text" name="debet" class="form-control" value="<?= $l->debit ?>">
                                      </div>
                                      <div class="col-sm-6">
                                        <label for="">Kredit</label>
                                        <input type="text" name="kredit" class="form-control" value="<?= $l->kredit ?>">
                                      </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                  <button type="submit" class="btn btn-primary btn-flat">Update Buku Umum Anggota</button>
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
                         <td><b>Total</b></td>
                         <td> <b>Pemasukan (Kredit)</b> : Rp.&nbsp;<?= number_format($kredit) ?></td>
                         <td> <b>Pengeluaran (Debet)</b> : Rp.&nbsp;<?= number_format($debit) ?></td>
                         <td> <b>Saldo</b> : Rp.&nbsp;<?= number_format($sal) ?></td>
                       </tr>
                     </table>
                     </div>
<script type="text/javascript">
  $(document).ready(function(){

        $('.datatable-biasa3').DataTable({
            buttons: false,
        });
  });
</script>
