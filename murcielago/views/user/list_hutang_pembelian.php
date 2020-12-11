<div class="content-wrapper">
    <div class="container-fluid">
        <section class="content">
            <div class="row">
                <div class="col-md-12">
                    <h3 style="margin: 0px;" class="pull-left"><b class="pull-left">Daftar Hutang Pembelian</b></h3>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <hr>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="table-responsive">
                        <table class="table table-bordered table-striped datatable">
                            <thead>
                                <tr>
                                    <td><b>No.</b></td>
                                    <td><b>Jatuh Tempo</b></td>
                                    <td><b>Kekurangan Biaya</b></td>
                                    <td><b>Detail</b></td>
                                </tr>
                            </thead>
                            <tbody>
                                <?
                                    $no=0;
                                    foreach($hutang as $h){
                                    if($h->tgl_tempo == '0000-00-00'){}elseif($h->status_lunas == 'lunas'){}else{ $no++;
                                ?>
                                <tr>
                                    <td><?= $no ?></td>
                                    <td><?= tgl_indo(date('Y-m-d', strtotime($h->tgl_tempo))) ?></td>
                                    <td>Rp. <?= number_format($h->kekurangan_biaya) ?></td>
                                    <td>
                                        <button type="button" data-toggle="modal" data-target="#barangdetail<?= $h->kd_pembelian ?>" class="btn btn-warning btn-flat">Detail Barang</button>
                                        <?
                                        $cari_list_pembayaran = $this->m_data->where('join_pembayaran_kredit',['id_join_kredit' => $h->id_join_kredit])->row();
                                        (empty($cari_list_pembayaran)) ?  : '';
                                        ?>
                                        <button type="button" data-toggle="modal" <?= (empty($cari_list_pembayaran)) ?  'onclick="ShowAlertKosongPembelian();"' : 'data-target="#modaldetail'.$h->id_join_kredit.'"'; ?> class="btn btn-<?= (empty($cari_list_pembayaran)) ? 'danger' : 'primary'; ?> btn-flat">Detail Pembayaran</button>
                                    </td>
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
    foreach($detail_join as $d){
?>
<div id="modaldetail<?= $d->id_join_kredit ?>" class="modal fade" role="dialog">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">DETAIL </h4>
      </div>
      <div class="modal-body">
            <?
                $detail_hutang = $this->m_data->detail_hutang_join_pembayaran($d->id_join_kredit)->result();
            ?>
            <div class="table-responsive">
                <table class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <td><b>No</b></td>
                            <td><b>Keterangan</b></td>
                            <td><b>Nominal Pembayaran</b></td>
                            <td><b>Tanggal Pembayaran</b></td>
                        </tr>
                    </thead>
                    <tbody>
                        <? $no=0; foreach($detail_hutang as $de){ $no++; ?>
                        <tr>
                            <td><?= $no ?></td>
                            <td><?= $de->keterangan ?></td>
                            <td><?= $de->nominal ?></td>
                            <td><?= tgl_indo(date('Y-m-d', strtotime($de->tgl_pembayaran))) ?></td>
                        </tr>
                        <? } ?>
                    </tbody>
                </table>
            </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-danger btn-flat" data-dismiss="modal">Tutup</button>
      </div>
    </div>
  </div>
</div>
<? } ?>

<? foreach($barang_detail as $bb){ ?>
<div id="barangdetail<?= $bb->kd_pembelian ?>" class="modal fade" role="dialog">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Detail Barang Pembelian</h4>
      </div>
      <div class="modal-body">
        <?
            $detail_hutang_barang = $this->m_data->detail_join_pembelian_barang($bb->kd_pembelian)->result();
        ?>
        <div class="table-responsive">
            <table class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <td><b>No</b></td>
                        <td><b>Nama Barang</b></td>
                        <td><b>Harga Beli</b></td>
                        <td><b>Jumlah Beli</b></td>
                        <td><b>Diskon</b></td>
                        <td><b>Total</b></td>
                    </tr>
                </thead>
                <tbody>
                    <?
                        $no=0;
                        $total =0;
                        foreach($detail_hutang_barang as $f):
                        $no++;
                    ?>
                    <tr>
                        <td><?= $no ?></td>
                        <td><?= $f->nama_barang ?></td>
                        <td>Rp. <?= number_format($f->harga_netto_beli_satuan) ?></td>
                        <td>x <?= $f->jumlah_beli ?></td>
                        <td><?= $f->diskon_beli_satuan_tbl_barang ?>%</td>
                        <td>
                            <?
                                $total = $f->harga_netto_beli_satuan*$f->jumlah_beli;
                                echo number_format($total);
                            ?>
                        </td>
                    </tr>
                    <? endforeach; ?>
                    <tr style="background-color:#55efc4;">
                        <td colspan="5"><b>TOTAL</b></td>
                        <td><b>Rp. <?= number_format($total) ?></b></td>
                    </tr>
                </tbody>
            </table>
        </div>
          <?
            $join_kredit_pembelian = $this->m_data->where('join_kredit_pembelian',['kd_pembelian' => $bb->kd_pembelian])->row();
            //echo $join_kredit_pembelian->id_join_kredit;
            $join_pembayaran_kredit = $this->m_data->where('join_pembayaran_kredit',['id_join_kredit' => $join_kredit_pembelian->id_join_kredit])->row();
          ?>
        <div class="row">
            <div class="col-md-offset-6 col-md-6">
                <div class="panel panel-primary" >
                  <div class="panel-heading" style="background-color:#0984e3;">Pembayaran</div>
                    <div class="panel-body">
                        <dl class="dl-horizontal">
                            <dt style="text-align:left;">Total Pembelian</dt>
                                <dd>: Rp. <span class="pull-right"><?= number_format($total) ?></span></dd>
                            <hr style="margin:5px 0px;">
                            <dt style="text-align:left;">Bayar</dt>
                                <dd>: Rp. <span class="pull-right"><?= number_format($join_pembayaran_kredit->nominal); ?></span></dd>
                            <hr style="margin:5px 0px;">
                            <dt style="text-align:left;">Kekurangan Bayar</dt>
                                <dd>: Rp. <span class="pull-right"><?= number_format($join_kredit_pembelian->kekurangan_biaya); ?></span></dd>
                          </dl>
                    </div>
                </div>
            </div>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-danger btn-flat" data-dismiss="modal">Tutup</button>
      </div>
    </div>

  </div>
</div>
<? } ?>
