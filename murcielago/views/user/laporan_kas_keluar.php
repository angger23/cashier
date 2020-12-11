<div class="content-wrapper">
    <div class="container-fluid">
        <section class="content">
            <div class="row">
                <div class="col-md-12">
                    <h3 style="margin: 0px;" class="pull-left"><b><i class="fa fa-stock"></i>&nbsp;&nbsp;Laporan Kas Keluar</b></h3>
                </div>
                <div class="col-md-12">
                    <hr>
                </div>
            </div>
            <form action="<?= base_url('laporan_kas/keluar') ?>" method="post">
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
                        foreach($kredit as $d){
                            $no++;
                            $totalku[$no] = $d->kredit;
                            $total += $totalku[$no];
                        }
                    ?>
                    <p style="padding:5px 10px;background-color:#eccc68;"><b>Total Kredit</b> : <b>Rp. <?= number_format($total) ?></b></p>
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
                                    <td><b>Kredit</b></td>
                                </tr>
                            </thead>
                            <tbody>
                                <?
                                    $no = 0;
                                    $total=0;
                                    foreach($kredit as $d){
                                        if($d->kd_pembelian == '0'){

                                    }else{
                                    $no++;
                                    $totalku[$no] = $d->kredit;
                                    $total += $totalku[$no];
                                ?>
                                <tr>
                                    <td><?= $no ?></td>
                                    <td>
                                        <button class="btn btn-info btn-flat btn-block" data-toggle="modal" data-target="#myModal<?= $d->kd_pembelian ?>"><i class="fa fa-expand"></i>&nbsp;&nbsp;Detail</button>
                                    </td>
                                    <td><?= tgl_indo(date('Y-m-d', strtotime($d->tgl_transaksi))); ?></td>
                                    <td>Rp. <span class="pull-right"><? if(empty($d->kredit)){}else{echo number_format($d->kredit);} ?></span></td>
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
   foreach($total_kredit as $d){
       $no++;
       $totalku[$no] = $d->total_harga;
       $total += $totalku[$no];
?>

<div id="myModal<?= $d->kd_pembelian ?>" class="modal fade" role="dialog">
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
                    <td style="vertical-align: middle;">No <?= $d->kd_pembelian ?></td>
                    <td style="vertical-align: middle;">Nama Barang</td>
                    <td style="vertical-align: middle;">Harga Satuan Barang</td>
                    <td style="vertical-align: middle;">Jumlah Beli</td>
                    <td style="vertical-align: middle;">Diskon Beli</td>
                    <td style="width: 200px;vertical-align: middle;">Nama Pembeli</td>
                    <td style="vertical-align: middle;">Tanggal Pembelian</td>
                    <td style="vertical-align: middle;">Total</td>
                </tr>
                <?
                $no=0;
                $detail_kredit = $this->m_data->detail_kas_keluar2($d->kd_pembelian)->result();
                foreach ($detail_kredit as $k) {
                    $no++;
                ?>
                <tr>
                    <td><?= $no ?></td>
                    <td><?= $k->nama_barang ?></td>
                    <td><?= $k->harga_beli_satuan ?></td>
                    <td><?= $k->jumlah_beli ?></td>
                    <td><?= $k->diskon_beli_satuan ?>%</td>
                    <td><?= $k->first_name ?></td>
                    <td><?= $k->tanggal_pembelian ?></td>
                    <td>
                        <?
                            if($d->jumlah_beli >= $d->diskon_beli_satuan){
                                $diskon = $k->diskon_beli_satuan/100*($k->harga_beli_satuan*$k->jumlah_beli);
                                $total = ($k->harga_beli_satuan*$k->jumlah_beli)-$diskon;
                                echo 'Rp.'.' '.number_format($total);
                            }else{
                                echo 'Rp.'.' '.number_format($k->harga_pokok*$k->satuan);
                            }
                        ?>
                    </td>
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
