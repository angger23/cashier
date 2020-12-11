<div class="content-wrapper">
    <div class="container-fluid">
        <section class="content">
            <div class="row">
                <div class="col-md-12">
                    <h3 style="margin: 0px;" class="pull-left"><b><i class="fa fa-stock"></i>&nbsp;&nbsp;Laporan Kas Masuk</b></h3>
                </div>
                <div class="col-md-12">
                    <hr>
                </div>
            </div>
            <form action="<?= base_url('laporan_kas/masuk') ?>" method="post">
            <div class="row">
                <div class="col-md-3">
                    <label>Mulai Tanggal</label>
                    <input type="text" class="form-control datepicker" name="hari1">
                </div>
                <div class="col-md-3">
                    <label>Sampai Tanggal</label>
                    <input type="text" class="form-control datepicker" name="hari2">
                </div>
                <div class="col-md-3">
                    <button type="submit" class="btn btn-info btn-flat" style="margin-top:24px;"><i class="fa fa-search"></i> Cari</button>
                </div>
            </div>
            </form>
            <div class="row">
                <div class="col-md-12">
                    <hr>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <?
                        $no = 0;
                        $total=0;
                        foreach($debet as $d){
                            $no++;
                            $totalku[$no] = $d->debet;
                            $total += $totalku[$no];
                        }
                    ?>
                    <p style="padding:5px 10px;background-color:#eccc68;"><b>Total Debet</b> : <b>Rp. <?= number_format($total) ?></b></p>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="table-responsive">
                        <table class="table table-bordered table-striped datatable">
                            <thead>
                                <tr>
                                    <td style="width:50px;"><b>No</b></td>
                                    <td style="width:100px;"><b>Opsi</b></td>
                                    <td><b>Tanggal Transaksi</b></td>
                                    <td><b>Debet</b></td>
                                </tr>
                            </thead>
                           
                            <tbody>
                                <?
                                    $no = 0;
                                    $total=0;
                                    foreach($debet as $d){
                                        if($d->kd_penjualan == '0'){

                                    }else{
                                    $no++;
                                    $totalku[$no] = $d->debet;
                                    $total += $totalku[$no];
                                ?>
                                <tr>
                                    <td style="vertical-align:middle;"><?= $no ?></td>
                                    <td style="vertical-align:middle;">
                                        <button class="btn btn-info btn-flat btn-block" data-toggle="modal" data-target="#myModal<?= $d->kd_penjualan ?>"><i class="fa fa-expand"></i>&nbsp;&nbsp;Detail</button>
                                    </td>
                                    <td style="vertical-align:middle;"><?= tgl_indo(date('Y-m-d', strtotime($d->tgl_transaksi))); ?> - <?= date('H:i', strtotime($d->tgl_transaksi)) ?></td>
                                    <td style="vertical-align:middle;">Rp. <span class="pull-right"><?= number_format($d->debet) ?></span></td>
                                </tr>       
                                
                                <? } } ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </section>
    </div>
</div>
<?
   $no = 0;
   $total=0;
   foreach($total_debet as $d){
       $no++;
       $totalku[$no] = $d->total_harga;
       $total += $totalku[$no];
?>

<div id="myModal<?= $d->kd_penjualan ?>" class="modal fade" role="dialog">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">DETAIL</h4>
      </div>
      <div class="modal-body">
        <div class="table-responsive">
            <table class="table table-bordered table-striped">
                <tr>
                    <td>No</td>
                    <td>Kode Nota</td>
                    <td>Nama Barang</td>
                    <td>Harga Satuan Barang</td>
                    <td>Jumlah Beli</td>
                    <td>Diskon Beli</td>
                    <td style="width: 200px;">Nama Pembeli</td>
                    <td>Tanggal Penjualan</td>
                    <td>Total</td>
                    <td>Nama Kasir</td>
                </tr>
                <? $no=0; $debet_detail = $this->m_data->detail_kas_masuk($d->kd_nota)->result(); foreach($debet_detail as $d){ $no++; ?>
                <tr>
                    <td><?= $no ?></td>
                    <td><?= $d->kd_nota ?></td>
                    <td><?= $d->nama_barang ?></td>
                    <td>Rp. <?= number_format($d->harga_pokok) ?></td>
                    <td><?= $d->satuan ?></td>
                    <td><?= $d->diskon ?>&</td>
                    <td><?= $d->nama_pembeli ?></td>
                    <td><?= $d->tanggal_penjualan ?></td>
                    <td>
                        <?  
                            if($d->satuan >= $d->kelipatan){
                                $diskon = $d->diskon/100*($d->harga_pokok*$d->satuan);
                                $total = ($d->harga_pokok*$d->satuan)-$diskon;
                                echo 'Rp.'.' '.number_format($total);
                            }else{
                                echo 'Rp.'.' '.number_format($d->harga_pokok*$d->satuan);
                            }
                        ?>
                    </td>
                    <td><?= $d->nama_kasir ?></td>
                </tr>
                <? } ?>
            </table>  
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default btn-danger btn-flat" data-dismiss="modal" style="color:#fff;">Tutup</button>
      </div>
    </div>
  </div>
</div>

<? } ?>
