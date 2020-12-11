<div class="" style="margin-top:10px;padding:0px;">
    <div class="container">
    <div class="panel panel-default">
        <div class="panel-heading"><h5>Lihat Laporan Kas Keluar</h5></div>
        <div class="panel-body">
            <center>
            <form method="post" action="<?php echo base_url() ?>laporan/laporan_kas_keluar">
                <div class="form-group">
                    <label>Tanggal</label>
                    <input type="date" class="form-control" name="tgl1">
                </div>
                <div class="form-group">
                    <label>Tanggal</label>
                    <input type="date" class="form-control" name="tgl2">
                </div>
                <div class="form-group">
                    <button type="submit" class="btn btn-primary">Lihat</button>
                </div>
            </form>
            </center>
            <?php if(!empty($this->input->post('tgl1'))){  ?>
            <?php $data['kas_keluar'] = $this->m_data->kas_keluar($this->input->post('tgl1'),$this->input->post('tgl2'))->result_array(); ?>
                    <table class="table data" id="example">
                        <thead>
                            <tr>

                        <th>No</th>
                        <th>Aksiss</th>
                        <th>Tanggal Transaksi</th>
                        <th>Kredit</th>
                            </tr>
                        </thead>

                        <style>
                            .list-group-item{
                                font-size:6px;
                            }
                        </style>
                        <tbody>
                            <?php $no=0; foreach($data['kas_keluar'] as $record ){ $no++; ?>

                            <tr>
                        <td style="width:148px;"><?php echo $no; ?></td>
                        <td style="width:294px;"><button type="button" data-toggle="modal" href="#myModal<?php echo $no ?>" class="btn btn-primary">Lihat</button></td>
                        <td style="width:357px;"><?php echo date("d-m-Y", strtotime($record['tanggal_transaksi'])); ?></td>
                                <td>Rp <?php echo number_format($record['kredit']); ?></td>
                                <!-- Modal -->
                            </tr>
                            <?php  } ?>

                        </tbody>

                    </table>
            <?php $no=0; foreach($data['kas_keluar'] as $record ){ $no++ ?>
            <div class="modal fade" id="myModal<?php echo $no ?>">
<div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
          <h3 class="modal-title">Lihat Detail</h3>
        </div>
        <div class="modal-body">
            <?php if(empty($record['kd_pembelian'])){ ?>
            <table class="table table-bordered">
            <tbody>
                <tr>
                    <td>Pengeluaran Dana Sebesar</td>
                    <td>Rp <?php echo number_format($record['kredit']); ?></td>
                </tr>
                <tr>
                    <td>Pada tanggal</td>
                    <td><?php echo date("d-m-Y", strtotime($record['tanggal_transaksi'])); ?></td>
                </tr>
                <tr>
                    <td>Dengan Keterangan</td>
                <td><?php echo $record['keterangan']; ?></td>
                </tr>
            </tbody>
            </table>
            <?php }else{ ?>
            <table class="table table-responsive table-bordered">
         <thead>
            <th>No</th>
            <th>Tanggal Pembelian</th>
            <th>Nama Supplier</th>
            <th>Kode Barang</th>
            <th>Nama Barang</th>
            <th>Jenis Barang</th>
            <th>Harga Pokok</th>
            <th>Jumlah Beli</th>
            <th>Total Harga</th>
            <th>Nama Pembeli</th>
        </thead>
            <tbody>
                <?php $data['cek_pembelian'] = $this->m_data->cek_pembelian2($record['kd_pembelian'])->result();
                $nop=0;
                foreach($data['cek_pembelian'] as $ata){
                $nop++;
                ?>
                <tr>
                    <td><?php echo $nop; ?></td>
                    <td><?php echo date("d-m-Y", strtotime($ata->tanggal_pembelian)); ?></td>
                    <td><?php echo $ata->nama_supplier; ?></td>
                    <td><?php echo $ata->kode_barang; ?></td>
                    <td><?php echo $ata->nama_barang; ?></td>
                    <td><?php echo $ata->satuan_barang; ?></td>
                    <td><?php echo number_format($ata->harga_pokok); ?></td>
                    <td><?php echo $ata->jumlah_beli; ?></td>
                    <td><?php echo number_format($ata->total_harga); ?></td>
                    <td><?php echo $ata->nama_pembeli_barang; ?></td>
                </tr>
                <?php } ?>
            </tbody>
        </table>
            <?php } ?>

		</div>
        <div class="modal-footer">
            <button type="button" class="btn btn-default " data-dismiss="modal">Close</button>
        </div>

      </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
  </div><!-- /.modal -->
            <?php  } ?>
            <table class="table table-responsive">
             <tr>
                 <?php $data['totalnya'] = $this->m_data->sum_total_kredit($this->input->post('tgl1'),$this->input->post('tgl2'))->row(); ?>
            <td style="width:148px;"></td>
            <td style="width:294px;"></td>
            <td></td>
            <td></td>
            <td style="width:357px;"><b>Total Kredit</b></td>
            <td><b>Rp<?php echo number_format($data['totalnya'] -> kredit); ?></b></td>
            </tr>
            </table>
        </div>
        <div class="panel-footer">
        <a href="<?php echo base_url() ?>export_sys/export_kas_keluar/<?php echo $this->input->post('tgl1') ?>/<?php echo $this->input->post('tgl2') ?>" class="btn btn-success" style="margin-bottom:10px;">Export</a>
        <a href="<?php echo base_url() ?>laporan/print_kas_keluar/<?php echo $this->input->post('tgl1') ?>/<?php echo $this->input->post('tgl2') ?>" target="_blank" class="btn btn-success" style="margin-bottom:10px;"><i class="fa fa-print"></i> Print</a>
        </div>
        <?php }else{ ?>

                    <?php } ?>
    </div>
    </div>
</div>


<!-- /main -->
