<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/css/bootstrap-datepicker.min.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>

<div class="content-wrapper">
  <div class="container-fluid">
    <section class="content">
    <div class="row">
        <div class="col-md-10">
          <div class="col-md-4">
              <h4><b>Data Penjualan Bulan <?php if(empty($this->input->post('bulan'))){ echo bulan(date('m')).' '.date('Y'); }else{ echo bulan($this->input->post('bulan')).' '.$this->input->post('tahun'); } ?></b> </h4>
          </div>
          <div class="col-md-8">
              <form action="<?= base_url('kasir/data_penjualan/tahun'); ?>" method="post">
                  <div class="col-md-4">
               <div class="form-group">
                 <select class="form-control selectku" name="bulan" required>
                   <option value="">Pilih Bulan</option>
                   <option value="01">Januari</option>
                   <option value="02">Februari</option>
                   <option value="03">Maret</option>
                   <option value="04">April</option>
                   <option value="05">Mei</option>
                   <option value="06">Juni</option>
                   <option value="07">Juli</option>
                   <option value="08">Agustus</option>
                   <option value="09">September</option>
                   <option value="10">Oktober</option>
                   <option value="11">November</option>
                   <option value="12">Desember</option>
                 </select>
               </div>
             </div>
             <div class="col-md-4">
               <div class="form-group">
                 <select class="form-control selectku" name="tahun" required>
                   <option value="">Pilih Tahun</option>
                   <?php
                $thn_skr = date('Y');
                for ($x = $thn_skr; $x >= 2010; $x--) {
                ?>
                    <option <?php if($x == date('Y')){echo'selected';} ?>  value="<?php echo $x ?>"><?php echo $x ?></option>
                <?php
                }
                ?>
                 </select>
               </div>
             </div>
             <div class="col-md-4">
               <div class="form-group">
                 <button class="btn btn-primary btn-flat" type="submit">Filter Bulan Tahun</button>
               </div>
             </div>
              </form>
          </div>
        </div>
        <div class="col-md-2">
          <div class="form-group">
            <?
              if($this->uri->segment(3) == 'ac'){
              ?>
              <!-- <a href="<?= base_url('kasir/print_penjualan/'.$this->input->post('start_tgl').'/'.$this->input->post('end_tgl').'/'.$this->input->post('operator').'') ?>" target="_blank" class="btn btn-info btn-flat pull-right" type="button"><i class="fa fa-print"></i> Print</a> -->
              <? }else{ ?>
              <!-- <a href="<?= base_url('kasir/print_penjualan') ?>" target="_blank" class="btn btn-info btn-flat pull-right" type="button"><i class="fa fa-print"></i> Print</a> -->
              <? } ?>
              <?
              if($this->uri->segment(3) == 'ac'){
              ?>
              <!-- <a href="<?= base_url('kasir/export_penjualan1/'.$this->input->post('start_tgl').'/'.$this->input->post('end_tgl').'/'.$this->input->post('operator').'') ?>" class="btn btn-success btn-flat pull-right"><i class="fa fa-file-excel-o"></i> Export</a> -->
              <? }else{ ?>
              <!-- <a href="<?= base_url('kasir/export_penjualan1') ?>" class="btn btn-success btn-flat pull-right"><i class="fa fa-file-excel-o"></i> Export</a> -->
              <? } ?>
            </div>
        </div>
        <div class="col-md-12">
          <hr>
        </div>
         <div class="form-group">
           <form method="post" action="<?= base_url('kasir/data_penjualan/ac'); ?>">
             <div class="col-md-3">
               <div class="form-group">
                 <label>Mulai Tanggal</label>
                 <input type="text" class="form-control datepicker" id="" name="start_tgl">
               </div>
             </div>
             <div class="col-md-3">
               <div class="form-group">
                 <label>Sampai Tanggal</label>
                 <input type="text" class="form-control datepicker" id="" name="end_tgl">
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
         <?php
         $nos=0;
         $p=0;
         $hpp=0;
         $laba=0;
         foreach($penjualan as $get){
           $nos++;
           $jml_barang_terjual = $this->m_data->barang_terjual($get->kd_nota,$get->kode_barang)->row();
           $cek_penjualan_sementara2 = $this->m_data->where('penjualan_sementara',array('kd_nota'=>$get->kd_nota,'kode_barang'=>$get->kode_barang))->row();
           if(empty($cek_penjualan_sementara2->harga)){
             $H = $get->harga_pokok;
           }else{
             $H = $get->harga;
           }
           $disc = $get->diskon / 100 * ($H);
           $ttl = $H-$disc;
           // penjualan
           $jumlah_saldojual_per_barang = $ttl*$jml_barang_terjual->jml;
           $p1[$nos] = $jumlah_saldojual_per_barang;
           $p += $p1[$nos];
           // end penjualan
           $hargapp = (empty($get->harga_netto_jual_satuan)) ? $H * $jml_barang_terjual->jml : $get->harga_netto_jual_satuan * $jml_barang_terjual->jml;
           $h[$nos] = $hargapp;
           $hpp += $h[$nos];
           // end hpp
           // laba
           $lab = ($ttl*$jml_barang_terjual->jml) - $h[$nos];
           $l[$nos] = $lab;
           $laba += $l[$nos];
           // end laba
         }
          ?>
         <div class="col-md-12">
            <p style="padding:5px 10px;background-color:#ffbe76;"><b>Total Penjualan</b> : <b>Rp. <?= number_format($p); ?></b></p>
            <p style="padding:5px 10px;background-color:#ffbe76;"><b>Total HPP</b> : <b>Rp. <?= number_format($hpp); ?></b></p>
            <p style="padding:5px 10px;background-color:#ffbe76;"><b>Laba</b> : <b>Rp. <?= number_format($laba); ?></b></p>
         </div>
         <br>
        <div class="col-md-12">
          <div class="table-responsive">
              <table class="table table-striped datatable">
              <thead>
                <tr>
                  <th>No</th> <!--1-->
                  <th>Tanggal Penjualan</th> <!--2-->
                  <th>Nomor Nota</th> <!--3-->
                  <th>Kode Pelanggan</th> <!--4-->
                  <th>Nama Pelanggan</th> <!--5-->
                  <th>Kategori Barang</th> <!--6-->
                  <th>Jenis Barang</th> <!--7-->
                  <th>Kode Barang</th> <!--8-->
                  <th>Nama Barang</th> <!--9-->
                  <th>Tanggal Expired</th> <!--10-->
                  <th>Satuan Barang</th> <!--11-->
                  <th>Jumlah Barang Terjual</th> <!--12-->
                  <th>Harga Jual Satuan</th> <!--13-->
                  <th>Diskon ( % )</th> <!--14-->
                  <th>Harga Netto Jual Satuan</th> <!--15-->
                  <th>Saldo Jumlah Harga Jual</th> <!--16-->
                  <th>Status Jual Tunai / Kredit</th> <!--17-->
                  <th>Jatuh Tempo Kredit</th> <!--18-->
                  <th>Harga Netto Beli Satuan</th> <!--19-->
                  <th>Harga Pokok ( HPP )</th> <!--20-->
                  <th>Total Laba</th> <!--21-->
                  <th>Operator</th> <!--22-->
                </tr>
              </thead>
              <tbody>
              <?
              $no=0;
              foreach($penjualan as $p):
              $no++;
              $jml_barang_terjual = $this->m_data->barang_terjual($p->kd_nota,$p->kode_barang)->row();
              $cek_penjualan_sementara = $this->m_data->where('penjualan_sementara',array('kd_nota'=>$p->kd_nota,'kode_barang'=>$p->kode_barang))->row();
              if(empty($cek_penjualan_sementara->harga)){
                $H = $p->harga_pokok;
              }else{
                $H = $p->harga;
              }
              // if(empty($p->kode_barang)){}
              ?>
                <tr>
                   <!--1--> <td><?= $no ?></td>
                   <!--2--> <td><?= tgl_indo(date('Y-m-d',strtotime($p->tanggal_penjualan))); ?></td>
                   <!--3--> <td><?= $p->kd_nota ?></td>
                   <!--4--> <td><?= $p->nama_pembeli ?></td>
                            <? $cari_pembeli = $this->m_data->where('pembeli',['kd_pelanggan' => $p->nama_pembeli])->row(); ?>
                   <!--5--> <td><?= (empty($cari_pembeli->nama_pembeli)) ? '' : $cari_pembeli->nama_pembeli ?></td>
                   <!--6--> <td><?= $p->kategori_barang ?></td>
                   <!--7--> <td><?= $p->jenis_barang ?></td>
                   <!--8--> <td><?= $p->kode_barang ?></td>
                   <!--9--> <td><?= $p->nama_barang ?></td>
                  <!--10--> <td><?= ($p->tanggal_expired == '0000-00-00') ? : date("d-m-Y",strtotime($p->tanggal_expired)) ; ?></td>
                  <!--11--> <td><?= $p->nama_satuan ?></td>
                  <!--12--> <td><?php echo $jml_barang_terjual->jml ?></td>
                  <!--13--> <td>Rp <?= number_format($H) ?></td>
                  <!--14--> <td><?= $p->diskon ?> %</td>
                  <?php
                  $disc1 = $p->diskon / 100 * ($H);
                  $ttl1 = $H-$disc1;
                  ?>
                  <!--15--> <td>Rp <?= number_format($ttl1) ?></td>
                            <?
                            $disc = $p->diskon / 100 * ($H * $p->satuan);
                            $ttl = ($H * $p->satuan)-$disc;
                            ?>
                  <!--16--> <td>Rp <?= number_format($ttl1 * $jml_barang_terjual->jml) ?></td>
                  <!--17--> <td><?= ($p->status == '1') ? 'Tunai' : 'Kredit'; ?></td>
                  <!--18--> <td><?= ($p->status == '1') ? '' : date("d-m-Y",strtotime($p->tgl_tempo_kredit)); ?></td>
                            <?
                            $cek_akhir_pem = $this->m_data->cek_akhir2('kd_pembelian','DESC','pembelian_barang',['kode_barang' => $p->kode_barang])->row();
                            ?>
                  <!--19--> <td>Rp <?= number_format((empty($p->harga_netto_jual_satuan)) ? '0' : $p->harga_netto_jual_satuan) ?></td>
                  <!--20--> <td>Rp <?= (empty($p->harga_netto_jual_satuan)) ? number_format($H * $jml_barang_terjual->jml) : number_format($p->harga_netto_jual_satuan * $jml_barang_terjual->jml) ?></td>
                  <!-- <td>Rp <?//= (empty($cek_akhir_pem->harga_beli_satuan)) ? '0' : number_format($ttl - ($p->satuan * $cek_akhir_pem->harga_beli_satuan))?></td> -->
                  <?php $hpp = (empty($p->harga_netto_jual_satuan)) ? $H * $jml_barang_terjual->jml : $p->harga_netto_jual_satuan * $jml_barang_terjual->jml; ?>
                  <!--21--> <td>Rp <?= number_format(($ttl1*$jml_barang_terjual->jml) - $hpp) ?></td>
                  <!--22--> <td><?= $p->nama_kasir ?></td>
                </tr>
              <? endforeach; ?>
              </tbody>
            </table>
          </div>
        </div>
    </div>
  </section>
  </div>
</div>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/js/bootstrap-datepicker.min.js">

</script>
<script type="text/javascript">
$('.datepickerz').datepicker({
  format: 'mm/dd/yyyy',
  // startDate: '-3d'
});
</script>
