<!DOCTYPE html>
<html lang="en">
<head>
  <!-- Theme Made By www.w3schools.com - No Copyright -->
  <title>STIKES-Mart</title>
  <meta charset="utf-8">
  <meta http-equiv="refresh" content="0;url=<?= base_url('kasir/kasir2') ?>">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="apple-mobile-web-app-capable" content="yes">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <link rel="stylesheet" type="text/css" href="<?php echo base_url() ?>assets/css/jquery.dataTables.css">
  <link rel="stylesheet" type="text/css" href="<?php echo base_url() ?>assets/css/dataTables.bootstrap.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    

    <style type="text/css" media="print">
@media print {
    html, body {
        width: 8.5in; /* was 8.5in */
        height: 5.5in; /* was 5.5in */
        display: block;
        font-family: "Calibri";
        /*font-size: auto; NOT A VALID PROPERTY */
    }

    @page {
        size: 5.5in 8.5in /* . Random dot? */;
    }
    
/*    .row {
  margin-right: -15px;
  margin-left: -15px;
}*/
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
}
</style>
    <script>
        window.onload = function () {
  window.print();
  setTimeout(function(){window.close();}, 1);
}
    </script>
</head>
<body>
  <br>
   <img src="<?php echo base_url() ?>assets_kasir/img/logo kasir stikes.jpg" width="270">
    <hr>
    <p class="text-left" style="margin-top:-10px;font-size: 16px;">Jl. Letkol Istiqlah No.109 Penataban-Banyuwangi, 
      <br>Telp. 085856934720
      <br></p>
    <hr style="margin-top:-5px;">
      <style type="text/css">
          .table>tbody>tr>td{
            border-top: none;
            padding: 0;
          }

      </style>
    <table class="table" style="border:none;margin-top:12px;font-size: 15px;">
        <tbody>
            <tr style="padding:8px;border-bottom: none;">
                <td style="width: 100px;"><b>Nama Pembeli</b></td>
                <?php
                $cari_penjualan_barang = $this->m_data->where('penjualan_barang',array('kd_penjualan' => $this->uri->segment(3)))->row();
                $cari_nama_pem = $this->m_data->where('pembeli',array('kd_pelanggan' => $cari_penjualan_barang->nama_pembeli))->row();
                 ?>
                <td><b>: <?php echo $cari_nama_pem->nama_pembeli ?></b></td>
            </tr>
            <tr style="padding:10px;">
                <td style="width:100px;"><b>Tanggal</b></td>
                <td><b>: <?php echo tgl_indo(date("Y-m-d"));?> <?php echo date('H:i') ?></b></td>
            </tr>
            <tr style="padding:10px;">
                <td style="width:100px;"><b>Nomor Nota</b></td>
                <td><b>: <?= $penjualan1->kd_nota ?></b></td>
            </tr>
        </tbody>
      </table>
    <!-- </center> -->
    <br>
    <style type="text/css">
      table, th, td {
  /*border: 1px solid black;*/
  border-collapse: collapse;
}
th, td {
  padding: 8px;
  text-align: left;
}
    </style>
      <table class="" style="margin-top:-20px;font-size:18px;">
        <thead style="border-bottom:3px solid #000;border-top:3px solid #000;">
          <tr>
            <th width="140">Nama Barang</th>
            <th width="10">Qty</th>
            <th width="10">Harga</th>
            <th>Total</th>
          </tr>
        </thead>
        <tbody>
          <?
          $no=0;
          $totalku=0; 
          foreach($penjualan as $li):
          $no++;
          ?>
          <tr>
            <td><?= $li->nama_barang ?></td>
            <td><?= $li->satuan ?></td>
              <? 
              $cari_diskon = $this->m_data->where('barang',['kode_barang' => $li->kode_barang])->row();
            ?>
            <td>Rp <?php echo number_format($li->harga_pokok) ?></td>
            <td style="text-align: right;padding-right: 12px;">Rp <? if($cari_diskon->kelipatan == '0'){
            echo number_format($li->harga_pokok * $li->satuan);
              $ttl = $li->harga_pokok * $li->satuan;
          }else{
            if($li->satuan >= $cari_diskon->kelipatan){
              $disc = $cari_diskon->diskon / 100 * ($li->harga_pokok * $li->satuan);
              echo number_format(($li->harga_pokok * $li->satuan)-$disc);
              $ttl = ($li->harga_pokok * $li->satuan)-$disc;
            }else{
              echo number_format($li->harga_pokok * $li->satuan);
              $ttl = $li->harga_pokok * $li->satuan;
            }
          } ?> <br> <b><?= ($li->satuan >= $cari_diskon->kelipatan) ? '( '.$cari_diskon->diskon.' % )' : '(0 %)'; ?></b></td>
          </tr>
          <? 
          
          $total[$no] = $ttl;
          $totalku += $total[$no];
          endforeach; ?>
          <tr>
            <td style="border-top:2px dashed;padding-bottom: 0;padding-top:0;" colspan="3"><b>Total Harga</b></td>
            <td colspan="3" style="border-top:2px dashed;padding-bottom: 0;padding-top:0;text-align: right;padding-right: 14px;"><b>Rp <?= number_format($totalku) ?></b></td>
          </tr>
          <tr>
            <td style="padding-bottom: 0;padding-top:0;" colspan="3"><b>Bayar</b></td>
            <td style="padding-bottom: 0;padding-top:0;text-align: right;padding-right: 14px;" colspan="3"><b>Rp <?= number_format($this->uri->segment(4)) ?></b></td>
          </tr>
          <tr>
            <td style="padding-bottom: 0;padding-top:0;" colspan="3"><b>Kembali</b></td>
            <td style="padding-bottom: 0;padding-top:0;text-align: right;padding-right: 14px;" colspan="3"><b>Rp <?= number_format($this->uri->segment(4) - $penjualan1->total_harga) ?></b></td>
          </tr>
        </tbody>
      </table>
    
      <br>
    <div class="row">
        <div class="col-md-8">
            <p style="font-size: 15px;">Terimakasih Atas Kunjungan Anda<br>Barang yang sudah dibeli tidak dapat<br>Ditukar atau dikembalikan!<br>
              <b>Operator : <?php echo $user_ion->username ?></b>
              <br><b style="font-size: 17px;">STIKESMART</b></p>
        </div>
        
    </div>
</body>
</html>