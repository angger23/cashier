<div class="" style="margin-top:10px;padding:0px;">
    <div class="container">
      <div class="panel panel-default">
          <div class="panel-heading"><h5>Laporan Data Barang</h5></div>
        <div class="panel-body">
            <h3 style="margin-top:-7px;">Catatan : </h3>
            <p>Untuk Kolom berwarna <b style="background-color:#3498db;">Biru</b> menandakan stock barang kurang dari 5</p>
            <p>Untuk Kolom berwarna <b style="background-color:#e74c3c;">Merah</b> menandakan barang tersebut kadaluarsa</p>
             <table class="table table-bordered" id="example">
                <thead>
                  <tr>
                    <th>No</th>
                    <th>Nama Barang</th>
                    <th>Harga Pokok</th>
                    <th>Stok</th>
                    <th>Total Harga</th>
                    <th>Kode Barang</th>
                    <th>Max Pembelian Diskon</th>
                    <th>Diskon</th>
                    <th>Tanggal Pembelian</th>
                    <th>Nama Supplier</th>
                  </tr>
                </thead>
                <tbody>
                    <?php 
                    $no=0; 
                    foreach($data_barang as $data){
                    $no++;
                    ?>
                  <tr <?php 
                        $tgl_now=date("Y-m-d");
                        if($data['expierd'] == $tgl_now){ echo 'style="background-color:#e74c3c;"'; }elseif($data['jumlah_beli'] <= 5){ echo 'style="background-color:#3498db;"';}else{}?>>
                    <td><?php echo $no ?></td>
                    <td><?php echo $data['nama_barang']; ?></td>
                    <td>Rp <?php echo number_format($data['harga_pokok']); ?></td>
                    <td><?php echo $data['jumlah_beli'] ?></td>
                    <td>Rp <?php echo number_format($data['total_harga']); ?></td>
                    <td><?php echo $data['kode_barang'] ?></td>
                    <td><?php echo $data['kelipatan']; ?></td>
                    <td><?php echo $data['diskon'] ?> % </td>
                    <td><?php echo date("d-m-Y", strtotime($data['tanggal_pembelian'])); ?></td>
                    <td><?php echo $data['nama_supplier']; ?></td>
                    </tr>
                    <?php } ?>
                </tbody>
            </table>
            <a href="<?php echo base_url() ?>print_ex/data_barang" target="_blank" class="btn btn-success"><i class="fa fa-print"></i> Cetak</a>
            <a href="<?php echo base_url() ?>export_sys/export_barang_masuk" class="btn btn-success"><i class="fa fa-file-excel-o"></i> Export Excel</a>
        </div>  
      </div>  
    </div>
</div>
