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
    <table border="1" width="100%" class="table table-bordered">
        <thead>
            <tr>
                <td><b>No.</b></td>
                <td><b>Tanggal Pembelian</b></td>
                <td><b>Nomor Faktur</b></td>
                <td><b>Kode Supplier</b></td>
                <td><b>Nama Supplier</b></td>
                <td><b>Kategori Barang</b></td>
                <td><b>Jenis Barang</b></td>
                <td><b>Kode Barang</b></td>
                <td><b>Nama Barang</b></td>
                <td><b>Tanggal Kadaluarsa</b></td>
                <td><b>Satuan Barang</b></td>
                <td><b>Harga Beli Satuan</b></td>
                <td><b>Diskon Beli Satuan</b></td>
                <td><b>Harga Netto Beli Satuan</b></td>
                <td><b>Jumlah Beli</b></td>
                <td><b>Jumlah Harga Beli</b></td>
                <td><b>Harga Jual Satuan</b></td>
                <td><b>Laba Satuan</b></td>
                <td><b>Status Beli</b></td>
                <td><b>Jatuh Tempo Kredit</b></td>
                <td><b>Operator</b></td>
            </tr>
        </thead>
        <tbody>
            <? $no=0; foreach($pembelian_barang as $b){ $no++; ?>
                <tr>
                    
                    <td><?= $no ?></td>
                    <td><?= tgl_indo(date('Y-m-d', strtotime($b->tanggal_pembelian))) ?></td>
                    <td></td>
                    <td><?= $b->kode_supplier ?></td>
                    <td><?= $b->nama_supplier ?></td>
                    <td><?= $b->kategori_barang ?></td>
                    <td><?= $b->jenis_barang ?></td>
                    <td><?= $b->kode_barang ?></td>
                    <td><?= $b->nama_barang ?></td>
                    <td><?= tgl_indo(date('Y-m-d', strtotime($b->tanggal_expired))) ?></td>
                    <td><?= $b->nama_satuan ?></td>
                    <td>Rp. <?= number_format($b->harga_beli_satuan) ?></td>
                    <td>Rp. <?= number_format($b->diskon_beli_satuan) ?></td>
                    <td>Rp. <?= number_format($b->netto_beli_satuan) ?></td>
                    <td><?= $b->jumlah_beli ?></td>
                    <td>Rp. <?= number_format($b->total_harga) ?></td>
                    <td>Rp. <?= number_format($b->harga_pokok) ?></td>
                    <td>Rp. <?= number_format($b->laba_satuan) ?></td>
                    <td><?= $b->status ?></td>
                    <td><? if($b->jatuh_tempo_kredit == '0000-00-00'){echo'Tidak kredit';}else{ echo tgl_indo(date('Y-m-d', strtotime($b->jatuh_tempo_kredit))); } ?></td>
                    <td>
                        <?
                            $operator = $this->m_data->where('users',['id' => $b->id_users])->row();
                            echo $operator->first_name;
                        ?>
                    </td>

                </tr>
            <? } ?>
        </tbody>
     </table>
</body>
</html>