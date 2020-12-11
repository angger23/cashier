<div class="content-wrapper">
  <div class="container-fluid">
    <section class="content">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<div class="main" style="padding-bottom: 100px;">
	<div class="main-inner">
		<div class="container">
			<div class="row">
				<div class="col-md-12">
                    <h3 style="margin: 0px;" class="pull-left"><b><i class="fa fa-stock"></i>&nbsp;&nbsp;Penjualan Barang Toko Tunai - Laporan Laba Rugi</b></h3>
                </div>
            </div>  
            <div class="row">
                <div class="col-md-12">
                    <hr>
                </div>
            </div>
            <div class="row">
                <div class="col-md-8" style="padding:0px;">
                    <form action=""  method="post">
                        <div class="col-md-5">
                            <label>Mulai Tanggal</label>
                            <input type="text" name="hari1" class="form-control datepicker">
                        </div>
                        <div class="col-md-5">
                            <label>Sampai Tanggal</label>
                            <input type="text" name="hari2" class="form-control datepicker">
                        </div>
                        <div class="col-md-2">
                            <button type="submit" class="btn btn-info btn-flat" style="margin-top:24px;"><i class="fa fa-search"></i> Cari</button>
                        </div>
                    </form>
                </div>
                <div class="col-md-4" style="padding:0px;">
                    <div class="col-md-6">
                        <div class="form-group" style="margin-top:24px;">
                          
                            
                            <? if(empty($this->input->post('hari1'))){ ?>
                                <a href="<?= base_url('penjualan_tunai/export_penjualan_tunai') ?>" class="btn btn-primary btn-flat btn-block pull-right"><i class="fa fa-file-excel-o"></i> Export</a>
                            <? }else{  ?>
                              <a href="<?= base_url('penjualan_tunai/export_penjualan_tunai/') ?><?= $this->input->post('hari1') ?>/<?= $this->input->post('hari2') ?>/<?= $this->input->post('op') ?>" target="_blank" class="btn btn-primary btn-flat btn-block pull-right"><i class="fa fa-file-excel-o"></i> Export</a> 
                            <? } ?>
                            
                        </div>
                    </div>
                    <div class="col-md-6"> 
                        <div class="form-group" style="margin-top:24px;">
                            <? if(empty($this->input->post('hari1'))){ ?>
                                <a href="<?= base_url('Penjualan_tunai/printx') ?>" target="_blank" class="btn btn-warning btn-flat btn-block pull-right"><i class="fa fa-print"></i> Print</a>
                            <? }else{  ?>
                              <a href="<?= base_url('Penjualan_tunai/printx/') ?><?= $this->input->post('hari1') ?>/<?= $this->input->post('hari2') ?>/<?= $this->input->post('op') ?>" target="_blank" class="btn btn-warning btn-flat btn-block pull-right"><i class="fa fa-print"></i> Print</a> 
                            <? } ?>
                        </div>
                    </div>
                </div> 
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div style="padding:10px 0px;"></div>
                </div>
                <? 
                  $nos=0;
                  $ttx=0;
                  $total1 = 0;
                  $total2 = 0;
                  foreach($penjualan_toko_tunai as $p):
                  $nos++;
                  $cek_akhir_pem = $this->m_data->cek_akhir2('kd_pembelian','DESC','pembelian_barang',['kode_barang' => $p->kode_barang])->row();
                  $disc = $p->diskon / 100 * ($p->harga_pokok * $p->satuan);
                  $ttl = ($p->harga_pokok * $p->satuan)-$disc;
                  $jml_harga[$nos] = $ttl;
                  $hpp[$nos] = $p->satuan * $cek_akhir_pem->harga_beli_satuan;
                  $laba[$nos] = $ttl - ($p->satuan * $cek_akhir_pem->harga_beli_satuan);
                  $totalku = $hpp[$nos];
                  $total = $jml_harga[$nos];
                  $totalya = $laba[$nos];
                  $ttx += $total;
                  $total1 += $totalku;
                  $total2 += $totalya;
                  ?>
                  <? endforeach; ?>
                <div class="col-md-12">
                    <p style="padding:5px 10px;background-color:#ffbe76;"><b>Total Penjualan</b> : <b>Rp. <?= number_format($ttx); ?></b></p>
                    <p style="padding:5px 10px;background-color:#ffbe76;"><b>Total HPP</b> : <b>Rp. <?= number_format($total1); ?></b></p>
                    <p style="padding:5px 10px;background-color:#ffbe76;"><b>Laba</b> : <b>Rp. <?= number_format($total2); ?></b></p>
                 </div>
            </div>
            
            <div class="row">
                <div class="col-md-12">
                    <hr>
                </div>
            </div>
            <style>
                .table > thead > tr > th{
                    vertical-align:middle;
                }
            </style>
            <div class="row">
                <?  $har1 = $this->input->post('hari1');
                    $har2 = $this->input->post('hari2'); 
                ?>
                <? if(empty($this->input->post('hari1'))){ ?>
                    <div class="col-md-12">
                    <div class="table-responsive">
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
                                <? $no = 0; foreach($penjualan_toko_tunai as $p){ $no++; ?>
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
                                    <td><?= tgl_indo($p->tanggal_expired) ?></td>
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
                    </div>
                </div>
                <? }else{ ?>
                    <div class="col-md-12">
                    <div class="table-responsive">
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
                                <?
                                    $penjualan_toko_tunai = $this->m_data->cari_penjualan_barang_toko_tunai($har1,$har2)->result();
                                    $no = 0; foreach($penjualan_toko_tunai as $p){ $no++; 
                                ?>
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
                                    <td><?= $p->tanggal_expired ?></td>
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
                    </div>
                </div>
                <? } ?>
            </div>
            
        </div>
    </div>
</div>
      </section>
    </div>
</div>