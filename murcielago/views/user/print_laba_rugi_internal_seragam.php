<!-- <meta http-equiv="refresh" content="0; <?php echo base_url() ?>transkip"> -->
<title><?= $title; ?></title>
<body onLoad="window.print();window.close();">
<style type="text/css">

@media print{

  .col-xs-1, .col-sm-1, .col-md-1, .col-lg-1, .col-xs-2, .col-sm-2, .col-md-2, .col-lg-2, .col-xs-3, .col-sm-3, .col-md-3, .col-lg-3, .col-xs-4, .col-sm-4, .col-md-4, .col-lg-4, .col-xs-5, .col-sm-5, .col-md-5, .col-lg-5, .col-xs-6, .col-sm-6, .col-md-6, .col-lg-6, .col-xs-7, .col-sm-7, .col-md-7, .col-lg-7, .col-xs-8, .col-sm-8, .col-md-8, .col-lg-8, .col-xs-9, .col-sm-9, .col-md-9, .col-lg-9, .col-xs-10, .col-sm-10, .col-md-10, .col-lg-10, .col-xs-11, .col-sm-11, .col-md-11, .col-lg-11, .col-xs-12, .col-sm-12, .col-md-12, .col-lg-12 {
  position: relative;
  min-height: 1px;
  padding-right: 15px;
  padding-left: 15px;
}
.col-md-1, .col-md-2, .col-md-3, .col-md-4, .col-md-5, .col-md-6, .col-md-7, .col-md-8, .col-md-9, .col-md-10, .col-md-11, .col-md-12 {
    float: left;
  }
  .col-md-12 {
    width: 100%;
  }
  .col-md-11 {
    width: 91.66666667%;
  }
  .col-md-10 {
    width: 83.33333333%;
  }
  .col-md-9 {
    width: 75%;
  }
  .col-md-8 {
    width: 66.66666667%;
  }
  .col-md-7 {
    width: 58.33333333%;
  }
  .col-md-6 {
    width: 50%;
  }
  .col-md-5 {
    width: 41.66666667%;
  }
  .col-md-4 {
    width: 33.33333333%;
  }
  .col-md-3 {
    width: 25%;
  }
  .col-md-2 {
    width: 16.66666667%;
  }
  .col-md-1 {
    width: 8.33333333%;
  }
  .col-md-pull-12 {
    right: 100%;
  }
  .col-md-pull-11 {
    right: 91.66666667%;
  }
  .col-md-pull-10 {
    right: 83.33333333%;
  }
  .col-md-pull-9 {
    right: 75%;
  }
  .col-md-pull-8 {
    right: 66.66666667%;
  }
  .col-md-pull-7 {
    right: 58.33333333%;
  }
  .col-md-pull-6 {
    right: 50%;
  }
  .col-md-pull-5 {
    right: 41.66666667%;
  }
  .col-md-pull-4 {
    right: 33.33333333%;
  }
  .col-md-pull-3 {
    right: 25%;
  }
  .col-md-pull-2 {
    right: 16.66666667%;
  }
  .col-md-pull-1 {
    right: 8.33333333%;
  }
  .col-md-pull-0 {
    right: auto;
  }
  .col-md-push-12 {
    left: 100%;
  }
  .col-md-push-11 {
    left: 91.66666667%;
  }
  .col-md-push-10 {
    left: 83.33333333%;
  }
  .col-md-push-9 {
    left: 75%;
  }
  .col-md-push-8 {
    left: 66.66666667%;
  }
  .col-md-push-7 {
    left: 58.33333333%;
  }
  .col-md-push-6 {
    left: 50%;
  }
  .col-md-push-5 {
    left: 41.66666667%;
  }
  .col-md-push-4 {
    left: 33.33333333%;
  }
  .col-md-push-3 {
    left: 25%;
  }
  .col-md-push-2 {
    left: 16.66666667%;
  }
  .col-md-push-1 {
    left: 8.33333333%;
  }
  .col-md-push-0 {
    left: auto;
  }
  .col-md-offset-12 {
    margin-left: 100%;
  }
  .col-md-offset-11 {
    margin-left: 91.66666667%;
  }
  .col-md-offset-10 {
    margin-left: 83.33333333%;
  }
  .col-md-offset-9 {
    margin-left: 75%;
  }
  .col-md-offset-8 {
    margin-left: 66.66666667%;
  }
  .col-md-offset-7 {
    margin-left: 58.33333333%;
  }
  .col-md-offset-6 {
    margin-left: 50%;
  }
  .col-md-offset-5 {
    margin-left: 41.66666667%;
  }
  .col-md-offset-4 {
    margin-left: 33.33333333%;
  }
  .col-md-offset-3 {
    margin-left: 25%;
  }
  .col-md-offset-2 {
    margin-left: 16.66666667%;
  }
  .col-md-offset-1 {
    margin-left: 8.33333333%;
  }
  .col-md-offset-0 {
    margin-left: 0;
  }

  @page {
    margin: 0px 30px 0px 0px;
    padding: 0px 0px 0px 100px;
      size: 8.5in 5.5in;
    size: landscape;
}
html, body {
height: auto;
font-size: 11pt;
    -webkit-print-color-adjust:exact;
}
.judultab{
  margin-bottom: 20px;
  font-size: 14px;
}
.box-body {
  border-top-left-radius: 0;
  border-top-right-radius: 0;
  border-bottom-right-radius: 3px;
  border-bottom-left-radius: 3px;
  /*padding: 24px 38px;*/
  padding-right: 60px;
}
.head1,
.head2,
.head3{
  margin: 0px;
}
.head4{
  margin-top: 0px;
  margin-bottom: 20px;
}
.head1,
.head2,
.head3,
.head4{
  text-align: center;
  /*margin: 0px;*/
}
.pull-right {
  float: right !important;
}
.pull-left {
  float: left !important;
}
.blockquote-reverse,
blockquote.pull-right {
  padding-right: 15px;
  padding-left: 0;
  text-align: right;
  border-right: 5px solid #eee;
  border-left: 0;
}
table {
  background-color: transparent;
}
caption {
  padding-top: 8px;
  padding-bottom: 8px;
  color: #777;
  text-align: left;
}
th {
  text-align: left;
}
.table {
  width: 100%;
  max-width: 100%;
  margin-bottom: 20px;
  border-collapse: collapse;
}
.table > tr > td{
  padding-right:10px;
}
.table > thead > tr > th,
.table > tbody > tr > th,
.table > tfoot > tr > th,
.table > thead > tr > td,
.table > tbody > tr > td,
.table > tfoot > tr > td {
  padding: 8px;
  line-height: 1.42857143;
  vertical-align: top;
  border-top: 1px solid #ddd;
  font-size: 12pt;
}
.table > thead > tr > th {
  vertical-align: bottom;
  border-bottom: 2px solid #ddd;
  font-size: 12pt;

}
.table > caption + thead > tr:first-child > th,
.table > colgroup + thead > tr:first-child > th,
.table > thead:first-child > tr:first-child > th,
.table > caption + thead > tr:first-child > td,
.table > colgroup + thead > tr:first-child > td,
.table > thead:first-child > tr:first-child > td {
  border-top: 0;
}
.table > tbody + tbody {
  border-top: 2px solid #ddd;
}
.table .table {
  background-color: #fff;
}
.table-condensed > thead > tr > th,
.table-condensed > tbody > tr > th,
.table-condensed > tfoot > tr > th,
.table-condensed > thead > tr > td,
.table-condensed > tbody > tr > td,
.table-condensed > tfoot > tr > td {
  padding: 5px;
}
.table-bordered {
  border: 1px solid #ddd;
}
.table-bordered > thead > tr > th,
.table-bordered > tbody > tr > th,
.table-bordered > tfoot > tr > th,
.table-bordered > thead > tr > td,
.table-bordered > tbody > tr > td,
.table-bordered > tfoot > tr > td {
  border: 1px solid #ddd;
}
.table-bordered > thead > tr > th,
.table-bordered > thead > tr > td {
  border-bottom-width: 2px;
}
.table-striped > tbody > tr:nth-of-type(odd) {
  background-color: #f9f9f9;
}
.table-hover > tbody > tr:hover {
  background-color: #f5f5f5;
}
table col[class*="col-"] {
  position: static;
  display: table-column;
  float: none;
}
table td[class*="col-"],
table th[class*="col-"] {
  position: static;
  display: table-cell;
  float: none;
}
.table > thead > tr > td.active,
.table > tbody > tr > td.active,
.table > tfoot > tr > td.active,
.table > thead > tr > th.active,
.table > tbody > tr > th.active,
.table > tfoot > tr > th.active,
.table > thead > tr.active > td,
.table > tbody > tr.active > td,
.table > tfoot > tr.active > td,
.table > thead > tr.active > th,
.table > tbody > tr.active > th,
.table > tfoot > tr.active > th {
  background-color: #f5f5f5;
}
.table-hover > tbody > tr > td.active:hover,
.table-hover > tbody > tr > th.active:hover,
.table-hover > tbody > tr.active:hover > td,
.table-hover > tbody > tr:hover > .active,
.table-hover > tbody > tr.active:hover > th {
  background-color: #e8e8e8;
}
.table > thead > tr > td.success,
.table > tbody > tr > td.success,
.table > tfoot > tr > td.success,
.table > thead > tr > th.success,
.table > tbody > tr > th.success,
.table > tfoot > tr > th.success,
.table > thead > tr.success > td,
.table > tbody > tr.success > td,
.table > tfoot > tr.success > td,
.table > thead > tr.success > th,
.table > tbody > tr.success > th,
.table > tfoot > tr.success > th {
  background-color: #dff0d8;
}
.table-hover > tbody > tr > td.success:hover,
.table-hover > tbody > tr > th.success:hover,
.table-hover > tbody > tr.success:hover > td,
.table-hover > tbody > tr:hover > .success,
.table-hover > tbody > tr.success:hover > th {
  background-color: #d0e9c6;
}
.table > thead > tr > td.info,
.table > tbody > tr > td.info,
.table > tfoot > tr > td.info,
.table > thead > tr > th.info,
.table > tbody > tr > th.info,
.table > tfoot > tr > th.info,
.table > thead > tr.info > td,
.table > tbody > tr.info > td,
.table > tfoot > tr.info > td,
.table > thead > tr.info > th,
.table > tbody > tr.info > th,
.table > tfoot > tr.info > th {
  background-color: #d9edf7;
}
.table-hover > tbody > tr > td.info:hover,
.table-hover > tbody > tr > th.info:hover,
.table-hover > tbody > tr.info:hover > td,
.table-hover > tbody > tr:hover > .info,
.table-hover > tbody > tr.info:hover > th {
  background-color: #c4e3f3;
}
.table > thead > tr > td.warning,
.table > tbody > tr > td.warning,
.table > tfoot > tr > td.warning,
.table > thead > tr > th.warning,
.table > tbody > tr > th.warning,
.table > tfoot > tr > th.warning,
.table > thead > tr.warning > td,
.table > tbody > tr.warning > td,
.table > tfoot > tr.warning > td,
.table > thead > tr.warning > th,
.table > tbody > tr.warning > th,
.table > tfoot > tr.warning > th {
  background-color: #fcf8e3;
}
.table-hover > tbody > tr > td.warning:hover,
.table-hover > tbody > tr > th.warning:hover,
.table-hover > tbody > tr.warning:hover > td,
.table-hover > tbody > tr:hover > .warning,
.table-hover > tbody > tr.warning:hover > th {
  background-color: #faf2cc;
}
.table > thead > tr > td.danger,
.table > tbody > tr > td.danger,
.table > tfoot > tr > td.danger,
.table > thead > tr > th.danger,
.table > tbody > tr > th.danger,
.table > tfoot > tr > th.danger,
.table > thead > tr.danger > td,
.table > tbody > tr.danger > td,
.table > tfoot > tr.danger > td,
.table > thead > tr.danger > th,
.table > tbody > tr.danger > th,
.table > tfoot > tr.danger > th {
  background-color: #f2dede;
}
.table-hover > tbody > tr > td.danger:hover,
.table-hover > tbody > tr > th.danger:hover,
.table-hover > tbody > tr.danger:hover > td,
.table-hover > tbody > tr:hover > .danger,
.table-hover > tbody > tr.danger:hover > th {
  background-color: #ebcccc;
}
.table-responsive {
  min-height: .01%;
  overflow-x: auto;
}

  .container-fluid {
  padding-right: 15px;
  padding-left: 15px;
  margin-right: auto;
  margin-left: auto;
}
.container {
  padding-right: 15px;
  padding-left: 15px;
  margin-right: auto;
  margin-left: auto;
}
.row {
  margin-right: -15px;
  margin-left: -15px;
}


  .cop{
    margin-top: 20px;
  }
  .cop-img{
    margin-top: 0px;
  }
  .bb{
    margin-right: 20px;
  }
  .boxc{
    margin-right: 29px;
  }
  .ac{
    margin-top: 20px;
    margin-bottom: 20px;
  }
.img-logo > img{
    width: 300px;
}
    .img-logo{
        vertical-align: middle;
    }

    .table > thead > tr > th{
      vertical-align: middle;
    }
}
</style>  
<div class="container-fluid" style="height: 100%;">
    <section class="content-header h-h1">
        <div class="col-md-4">
            <h1 class="img-logo">
                <img src="<?= base_url() ?>/assets_kasir/img/logo_kasir_warna.png">&nbsp;&nbsp;<i class="fa fa-desktop"></i>
            </h1>
        </div>
        <div class="col-md-8">
          <h3 style="margin: 0px;" class="pull-left"><b>Penjualan Belanja Barang Toko - Laporan Laba Rugi</b><br>
          Jl. Letkol Istiqlah No.109, Mojopanggung, Kec. Banyuwangi, Kabupaten Banyuwangi, Jawa Timur 68422</h3>

        </div>
        <div class="col-md-12"><hr></div>
        <? 
                  $nos=0;
                  $ttx=0;
                  $total1 = 0;
                  $total2 = 0;
                  foreach($lb_in_srgm as $p):
                  $nos++;
                  $cek_akhir_pem = $this->m_data->cek_akhir2('kd_pembelian','DESC','pembelian_barang',['kode_barang' => $p->kode_barang])->row();
                  $jml_harga[$nos] = $p->satuan  * $p->harga_netto_jual_satuan;
                  $hpp[$nos] = $p->satuan * $cek_akhir_pem->harga_beli_satuan;
                  $laba[$nos] = $p->satuan  * $p->harga_netto_jual_satuan - ($p->satuan * $cek_akhir_pem->harga_beli_satuan);
                  $totalku = $hpp[$nos];
                  $total = $jml_harga[$nos];
                  $totalya = $laba[$nos];
                  $ttx += $total;
                  $total1 += $totalku;
                  $total2 += $totalya;
                  ?>
                  <? endforeach; ?>
                <div class="col-md-12">
                    <p style="padding:0px 0px;"><b>Total Penjualan</b> : <b>Rp. <?= number_format($ttx); ?></b></p>
                    <p style="padding:0px 0px;"><b>Total HPP</b> : <b>Rp. <?= number_format($total1); ?></b></p>
                    <p style="padding:0px 0px;"><b>Laba</b> : <b>Rp. <?= number_format($total2); ?></b></p>
                 </div>
    </section>

    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    
                    <?
                        if(empty($har1) && empty($opt)){
                    ?>
                    <table class="table table-striped table-bordered datatable-biasa">
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
                                  <th>Tanggal Expired</th>
                                  <th>Satuan Barang</th>
                                  <th>Harga Jual Satuan</th>
                                  <th>Diskon Jual Satuan</th>
                                  <th>Harga Netto Jual Satuan</th>
                                  <th>Saldo Jumlah Harga Jual</th>
                                  <th>Status Jual Tunai / Kredit</th>
                                  <th>Jatuh Tempo Kredit</th>
                                  <th>Harga Netto Beli Satuan</th>
                                  <th>Harga Pokok ( HPP )</th>
                                  <th>Total Laba</th>
                                  <th>Operator</th>
                                </tr>
                              </thead>
                              <tbody>
                                  <?
                                    $no = 0;
                                  foreach($lb_in_srgm as $p){
                                      $no++;
                                  ?>
                                    <tr>
                                          <td><?= $no ?></td>
                                          <td><?= tgl_indo(date('Y-m-d',strtotime($p->tanggal_penjualan))); ?></td>
                                          <td><?= $p->kd_nota ?></td>
                                          <td><?= $p->nama_pembeli ?></td>
                                          <? $cari_pembeli = $this->m_data->where('pembeli',['kd_pelanggan' => $p->nama_pembeli])->row(); ?>
                                          <td><?= $cari_pembeli->nama_pembeli ?></td>
                                          <td><?= $p->kategori_barang ?></td>
                                          <td><?= $p->jenis_barang ?></td>
                                          <td><?= $p->kode_barang ?></td>
                                          <td><?= $p->nama_barang ?></td>
                                          <td><?= tgl_indo($p->tanggal_expired) ?></td>
                                          <td><?= $p->nama_satuan ?></td>
                                          <td>Rp <?= number_format($p->harga_pokok) ?></td>
                                          <td><?= $p->diskon ?> %</td>
                                          <td>Rp <?= number_format($p->harga_netto_jual_satuan) ?></td>
                                          <?
                                          $disc = $p->diskon / 100 * ($p->harga_pokok * $p->satuan);
                                          $ttl = ($p->harga_pokok * $p->satuan)-$disc;
                                          ?>
                                          <td>Rp <?= number_format($ttl) ?></td>
                                          <td><?= ($p->status == '1') ? 'Tunai' : 'Kredit'; ?></td>
                                          <td><?= ($p->status == '1') ? '' : tgl_indo($p->tgl_tempo_kredit); ?></td>
                                          <? 
                                          $cek_akhir_pem = $this->m_data->cek_akhir2('kd_pembelian','DESC','pembelian_barang',['kode_barang' => $p->kode_barang])->row();
                                          ?>
                                          <td>Rp <?= number_format($cek_akhir_pem->harga_beli_satuan) ?></td>
                                          <td>Rp <?= number_format($p->satuan * $cek_akhir_pem->harga_beli_satuan) ?></td>
                                          <td>Rp <?= number_format($ttl - ($p->satuan * $cek_akhir_pem->harga_beli_satuan))?></td>
                                          <td><?= $p->nama_kasir ?></td>
                                        </tr>
                                  <? } ?>
                            </tbody>
                        </table>
                    <?
                        }else{ 
                            
                    $lb_in_srgm = $this->m_data->cari_hari_lr_srgm_intern($har1,$har2)->result();
                    ?>
                    
                    <table class="table table-striped table-bordered datatable-biasa">
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
                                  <th>Tanggal Expired</th>
                                  <th>Satuan Barang</th>
                                  <th>Harga Jual Satuan</th>
                                  <th>Diskon Jual Satuan</th>
                                  <th>Harga Netto Jual Satuan</th>
                                  <th>Saldo Jumlah Harga Jual</th>
                                  <th>Status Jual Tunai / Kredit</th>
                                  <th>Jatuh Tempo Kredit</th>
                                  <th>Harga Netto Beli Satuan</th>
                                  <th>Harga Pokok ( HPP )</th>
                                  <th>Total Laba</th>
                                  <th>Operator</th>
                                </tr>
                              </thead>
                              <tbody>
                                  <?
                                    $no = 0;
                                  foreach($lb_in_srgm as $p){
                                      $no++;
                                  ?>
                                    <tr>
                                          <td><?= $no ?></td>
                                          <td><?= tgl_indo(date('Y-m-d',strtotime($p->tanggal_penjualan))); ?></td>
                                          <td><?= $p->kd_nota ?></td>
                                          <td><?= $p->nama_pembeli ?></td>
                                          <? $cari_pembeli = $this->m_data->where('pembeli',['kd_pelanggan' => $p->nama_pembeli])->row(); ?>
                                          <td><?= $cari_pembeli->nama_pembeli ?></td>
                                          <td><?= $p->kategori_barang ?></td>
                                          <td><?= $p->jenis_barang ?></td>
                                          <td><?= $p->kode_barang ?></td>
                                          <td><?= $p->nama_barang ?></td>
                                          <td><?= tgl_indo($p->tanggal_expired) ?></td>
                                          <td><?= $p->nama_satuan ?></td>
                                          <td>Rp <?= number_format($p->harga_pokok) ?></td>
                                          <td><?= $p->diskon ?> %</td>
                                          <td>Rp <?= number_format($p->harga_netto_jual_satuan) ?></td>
                                          <?
                                          $disc = $p->diskon / 100 * ($p->harga_pokok * $p->satuan);
                                          $ttl = ($p->harga_pokok * $p->satuan)-$disc;
                                          ?>
                                          <td>Rp <?= number_format($ttl) ?></td>
                                          <td><?= ($p->status == '1') ? 'Tunai' : 'Kredit'; ?></td>
                                          <td><?= ($p->status == '1') ? '' : tgl_indo($p->tgl_tempo_kredit); ?></td>
                                          <? 
                                          $cek_akhir_pem = $this->m_data->cek_akhir2('kd_pembelian','DESC','pembelian_barang',['kode_barang' => $p->kode_barang])->row();
                                          ?>
                                          <td>Rp <?= number_format($cek_akhir_pem->harga_beli_satuan) ?></td>
                                          <td>Rp <?= number_format($p->satuan * $cek_akhir_pem->harga_beli_satuan) ?></td>
                                          <td>Rp <?= number_format($ttl - ($p->satuan * $cek_akhir_pem->harga_beli_satuan))?></td>
                                          <td><?= $p->nama_kasir ?></td>
                                        </tr>
                                  <? } ?>
                            </tbody>
                        </table>
                    <? } ?>
                </div>
            </div>
        </div>
    </section>
</div>
