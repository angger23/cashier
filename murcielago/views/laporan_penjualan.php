<div class="" style="margin-top:10px;">
    <div class="container">
<div class="panel panel-default">
    <div class="panel-heading"><h5 style="padding:0;">Lihat Laporan Penjualan</h5></div>
    <div class="panel-body">
        <form method="post" action="<?php echo base_url() ?>laporan/laporan_penjualan">
            <div class="form-group">
                <label>Dari Tanggal</label>
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
        <?php if(!empty($this->input->post('tgl1'))){  ?>
        <table class="table data" id="example">
                        <thead>
                        <tr>   
                            <th>No</th>   
                            <th>Nama Pembeli</th>
                            <th>Kode Nota</th>
                            <th>Jumlah Beli</th>
                            <th>Tanggal Penjualan</th>
                            <th>Total Harga</th>
                            <th>Aksi</th>
                        </tr>
                        </thead>
                        <tbody>
                            <?php $data['antara'] = $this->m_data->antara_tgl($this->input->post('tgl1'),$this->input->post('tgl2'))->result_array(); ?>
                        <?php $no=1; foreach($data['antara'] as $record ){  ?>
                            <tr <?php //if($record['stock']<= $record['min_stock']){ echo'style="background:#ffa3a3;"'; }else{} ?> >
                                <td><?php echo $no; ?></td>
                        <td><?php echo $record['nama_pembeli']; ?></td>
                        <td><?php echo $record['kd_nota']; ?></td>
                        <td><?php echo $record['satuan']; ?></td>
                        <td><?php echo date("d-m-Y", strtotime($record['tanggal_penjualan'])); ?></td>
                                <td>Rp <?php echo number_format($record['total_harga']); ?></td>
                                <td><button type="button" data-toggle="modal" data-target="#myModal<?php echo $no ?>" class="btn btn-primary">Lihat</button></td>
                                <!-- Modal -->
                            </tr>
                            <?php $no++; } ?>
                        </tbody>
                    </table>
                <?php 
        $no=0;
        foreach($data['antara'] as $record){
        $no++;
        ?>
        <!-- Modal -->
<div id="myModal<?php echo $no; ?>" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Lihat Detail</h4>
      </div>
      <div class="modal-body">
          <table class="table">
            <thead>
              <tr>
                <th>Kode Nota</th>
                <th>Kode Barang</th>
                <th>Satuan</th>
              </tr>
            </thead>
            <tbody>
                <?php 
                $data['sementara'] = $this->m_data->list_data_sementara($record['kd_nota'])->result_array(); 
                foreach($data['sementara'] as $data){
              ?>
              <tr>
                <td><?php echo $data['kd_nota']; ?></td>
                <td><?php echo $data['kode_barang']; ?></td>
                <td><?php echo $data['satuan']; ?></td>
              </tr>
                <?php } ?>
            </tbody>
          </table>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>

  </div>
</div>
                <?php } ?>
        
    </div>
    <div class="panel-footer" style="padding:0;">
        <h3><a href="<?php echo base_url() ?>export_sys/export_data_penjualan/<?php echo $this->input->post('tgl1') ?>/<?php echo $this->input->post('tgl2') ?>" class="btn btn-success" style="margin-bottom:10px;">Export</a></h3>
    </div>
    <?php }else{ ?>
                    
                    <?php } ?>
</div>
    </div>
</div>
  <!-- /main-inner --> 

<!-- /main -->
