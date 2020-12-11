<?php
 
  header("Content-type: application/vnd-ms-excel");
 
  header("Content-Disposition: attachment; filename=$title.xls");
 
  header("Pragma: no-cache");
 
  header("Expires: 0");
 
 ?>
<!DOCTYPE html>
<html>
<head>
  <title></title>
</head>
<body style="border:1px solid #ccc;border-collapse: collapse;">
    <?
        if(empty($har1)){
    ?>
    <table  border="1" width="100%" class="table table-striped table-bordered datatable-biasa">
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
                                  <th>Jumlah Jual</th>
                                  <th>Jumlah Harga Jual</th>
                                  <th>Nomor Retur Jual</th>
                                  <th>Tanggal Retur Jual</th>
                                  <th>Jumlah Retur Jual</th>
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
                                <? $no = 0; foreach($konsinyasi_tunai as $p){ $no++; ?>
                                  <tr>
                                    <td><?= $no ?></td>
                                    <td><?= tgl_indo(date('Y-m-d',strtotime($p->tanggal_penjualan))); ?></td>
                                    <td><?= $p->kd_nota ?></td>
                                    <td><?= $p->kd_pelanggan ?></td>
                                    <? $cari_pembeli = $this->m_data->where('pembeli',['kd_pelanggan' => $p->kd_pelanggan])->row(); ?>
                                    <td><?= $cari_pembeli->nama_pembeli ?></td> 
                                    <td><?= $p->kategori_barang ?></td>
                                    <td><?= $p->jenis_barang ?></td>
                                    <td><?= $p->kode_barang ?></td>
                                    <td><?= $p->nama_barang ?></td>
                                    <td><?= tgl_indo(date('Y-m-d',strtotime($p->tanggal_expired))); ?></td>
                                    <td><?= $p->nama_satuan ?></td>
                                    <td>Rp <?= number_format($p->harga_pokok) ?></td>
                                    <td><?= $p->diskon ?> %</td>
                                    <td>Rp. <?= number_format($p->harga_netto_jual_satuan) ?></td>
                                    <td><?= $p->satuan ?></td>
                                    <td>Rp <?= number_format($p->harga_pokok*$p->satuan) ?></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <?
                                    $disc = $p->diskon / 100 * ($p->harga_pokok * $p->satuan);
                                    $ttl = ($p->harga_pokok * $p->satuan)-$disc;
                                    ?>
                                    <td>Rp <?= number_format($ttl) ?></td>
<!--                                    <td>Rp <?= number_format($p->satuan  * $p->harga_netto_jual_satuan) ?></td>-->
                                    <td><?= ($p->status == '1') ? 'Tunai' : 'Kredit'; ?></td>
                                    <td><?= ($p->status == '1') ? '' : tgl_indo($p->tgl_tempo_kredit); ?></td>
                                    <? 
                                      $cek_akhir_pem = $this->m_data->cek_akhir2('kd_pembelian','DESC','pembelian_barang',['kode_barang' => $p->kode_barang])->row();
                                    ?>
                                    <td>Rp <?= number_format($cek_akhir_pem->harga_beli_satuan) ?></td>
                                    <td>Rp <?= number_format($p->satuan * $cek_akhir_pem->harga_beli_satuan) ?></td>
<!--                                    <td>Rp <?= number_format($p->satuan  * $p->harga_netto_jual_satuan - ($p->satuan * $cek_akhir_pem->harga_beli_satuan))?></td>-->
                                      <td>Rp <?= number_format($ttl - ($p->satuan * $cek_akhir_pem->harga_beli_satuan))?></td>
                                    <td><?= $p->nama_kasir ?></td>
                                  </tr>
                                  <? } ?>
                            </tbody>
                        </table>
    <?
        }else{ 

        $konsinyasi_tunai = $this->m_data->cari_penjualan_barang_toko_tunai($har1,$har2)->result();
    ?>
    <?
        if(empty($har1)){ }else{
    ?>
    <table border="1" width="100%" class="table table-bordered">
        <tr>
            <td>Mulai Tanggal</td>
            <td><?= $har1 ?></td>
        </tr>
        <tr>
            <td>Sampai Tanggal</td>
            <td><?= $har2 ?></td>
        </tr>
        
    </table>
    <? } ?>
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
                                  <th>Jumlah Jual</th>
                                  <th>Jumlah Harga Jual</th>
                                  <th>Nomor Retur Jual</th>
                                  <th>Tanggal Retur Jual</th>
                                  <th>Jumlah Retur Jual</th>
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
                                <? $no = 0; foreach($konsinyasi_tunai as $p){ $no++; ?>
                                  <tr>
                                    <td><?= $no ?></td>
                                    <td><?= tgl_indo(date('Y-m-d',strtotime($p->tanggal_penjualan))); ?></td>
                                    <td><?= $p->kd_nota ?></td>
                                    <td><?= $p->kd_pelanggan ?></td>
                                    <? $cari_pembeli = $this->m_data->where('pembeli',['kd_pelanggan' => $p->kd_pelanggan])->row(); ?>
                                    <td><?= $cari_pembeli->nama_pembeli ?></td> 
                                    <td><?= $p->kategori_barang ?></td>
                                    <td><?= $p->jenis_barang ?></td>
                                    <td><?= $p->kode_barang ?></td>
                                    <td><?= $p->nama_barang ?></td>
                                    <td><?= tgl_indo(date('Y-m-d',strtotime($p->tanggal_expired))); ?></td>
                                    <td><?= $p->nama_satuan ?></td>
                                    <td>Rp <?= number_format($p->harga_pokok) ?></td>
                                    <td><?= $p->diskon ?> %</td>
                                    <td>Rp. <?= number_format($p->harga_netto_jual_satuan) ?></td>
                                    <td><?= $p->satuan ?></td>
                                    <td>Rp <?= number_format($p->harga_pokok*$p->satuan) ?></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <?
                                    $disc = $p->diskon / 100 * ($p->harga_pokok * $p->satuan);
                                    $ttl = ($p->harga_pokok * $p->satuan)-$disc;
                                    ?>
                                    <td>Rp <?= number_format($ttl) ?></td>
<!--                                    <td>Rp <?= number_format($p->satuan  * $p->harga_netto_jual_satuan) ?></td>-->
                                    <td><?= ($p->status == '1') ? 'Tunai' : 'Kredit'; ?></td>
                                    <td><?= ($p->status == '1') ? '' : tgl_indo($p->tgl_tempo_kredit); ?></td>
                                    <? 
                                      $cek_akhir_pem = $this->m_data->cek_akhir2('kd_pembelian','DESC','pembelian_barang',['kode_barang' => $p->kode_barang])->row();
                                    ?>
                                    <td>Rp <?= number_format($cek_akhir_pem->harga_beli_satuan) ?></td>
                                    <td>Rp <?= number_format($p->satuan * $cek_akhir_pem->harga_beli_satuan) ?></td>
<!--                                    <td>Rp <?= number_format($p->satuan  * $p->harga_netto_jual_satuan - ($p->satuan * $cek_akhir_pem->harga_beli_satuan))?></td>-->
                                      <td>Rp <?= number_format($ttl - ($p->satuan * $cek_akhir_pem->harga_beli_satuan))?></td>
                                    <td><?= $p->nama_kasir ?></td>
                                  </tr>
                                  <? } ?>
                            </tbody>
                        </table>
    <? } ?>
</body>
</html>