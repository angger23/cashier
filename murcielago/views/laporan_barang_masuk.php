
<div class="" style="margin-top:10px;padding:0px;">
    <div class="container">
    <div class="panel panel-default">
        <div class="panel-heading"><h5>Lihat Laporan Barang Masuk</h5></div>
        <div class="panel-body">
            <center>
            <form method="post" action="<?php echo base_url() ?>laporan/laporan_barang_masuk">
                <div class="form-group">
                    <label>Mulai Tanggal</label>
                    <input type="date" class="form-control" name="tgl1">
                </div>
                <div class="form-group">
                    <label>Sampai Tanggal</label>
                    <input type="date" class="form-control" name="tgl2">
                </div>
                <div class="form-group">
                    <button type="submit" class="btn btn-primary">Lihat</button>    
                </div>
            </form>
            </center>
            <?php if(!empty($this->input->post('tgl1'))){ ?>
               <?php $data['lap_pembelian'] = $this->m_data->laporan_pembelian($this->input->post('tgl1'),$this->input->post('tgl2'))->result_array(); ?>
                    <table class="table table-responsive" id="example">
                        <?php //if($no!=1){ ?>
                <?php //}else{ ?>
                        <thead>
                        <tr>    
                            <th>No</th>   
                            <th>Tanggal Pembelian</th>
                            <th>Kode Barang</th>
                            <th>Nama Barang</th>
                            <th>Nama Supplier</th>
                            <th>Jenis Barang</th>
                            <th>Harga Pokok</th>
                            <th>Jumlah Beli</th>
                            <th>Total Harga</th>
                        </tr>
                        </thead>
                        <?php //} ?>
                        <tbody>
                            <?php 
                            $no=0; foreach($data['lap_pembelian'] as $record ){  
                            $no++;
                            ?>
                            <tr>
                        <td><?php echo $no; ?></td>
                        <td><?php echo date("d-m-Y", strtotime($record['tanggal_pembelian'])); ?></td>
                        <td><?php echo $record['kode_barang']; ?></td>
                        <td><?php echo $record['nama_barang'] ?></td>
                        <td><?php echo $record['nama_supplier'] ?></td>
                        <td><?php echo $record['satuan_barang'] ?></td>
                        <td>Rp <?php echo number_format($record['harga_pokok']); ?></td>
                        <td><?php echo $record['jumlah_beli'] ?></td>
                        <td>Rp <?php echo number_format($record['total_harga']); ?></td>
                            </tr>
                <?php //if($no!=1){ ?>
                <?php //}else{ ?>
                            <?php } ?>
                            
                        </tbody>
                            
                    </table>
            <?php //} ?>
            <?php //if($no!=1){ ?>
                <?php //}else{ ?>
                            
        </div>
        <div class="panel-footer">
        <a href="<?php echo base_url() ?>export_sys/export_data_barang/<?php echo $this->input->post('tgl1') ?>/<?php echo $this->input->post('tgl2') ?>" class="btn btn-success" style="margin-bottom:10px;">Export</a>
        <a href="<?php echo base_url() ?>laporan/print_barang_masuk/<?php echo $this->input->post('tgl1') ?>/<?php echo $this->input->post('tgl2') ?>" target="_blank" class="btn btn-success" style="margin-bottom:10px;"><i class="fa fa-print"></i> Print</a>
        </div>
        <?php }else{ }?>
        
    </div>
    </div>
</div>


<!-- /main -->
