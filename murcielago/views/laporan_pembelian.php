<div class="" style="margin-top:10px;">
    <div class="container">
<div class="panel panel-default">
    <div class="panel-heading"><h5 style="padding:0;">Lihat Laporan Pembelian</h5></div>
    <div class="panel-body">
        <form method="post" action="<?php echo base_url() ?>laporan/laporan_pembelian">
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
        <?php if(!empty($this->input->post('tgl1'))){ ?>
         <table class="table" id="example">
    <thead>
      <tr>
        <th>No</th>
        <th>Nama Supplier</th>
        <th>Kode Barang</th>
        <th>Nama Barang</th>
        <th>Jenis Barang</th>
        <th>Harga Pokok</th>
        <th>Jumlah Beli</th>
        <th>Total Harga</th>
      </tr>
    </thead>
    <tbody>
        <?php $data['antara_tgl2'] = $this->m_data->antara_tgl2($this->input->post('tgl1'),$this->input->post('tgl2'))->result(); ?>
        <?php
            $no=0;
            foreach($data['antara_tgl2'] as $dat){
            $no++;
        ?>
      <tr>
        <td><?php echo $no ?></td>
        <td><?php echo $dat->nama_supplier ?></td>
        <td><?php echo $dat->kode_barang ?></td>
        <td><?php echo $dat->nama_barang ?></td>
        <td><?php echo $dat->satuan_barang ?></td>
        <td>Rp <?php echo number_format($dat->harga_pokok); ?></td>
        <td><?php echo $dat->jumlah_beli ?></td>
        <td>Rp <?php echo number_format($dat->total_harga); ?></td>
    </tr>
        <?php } ?>
    </tbody>
  </table>
        <?php  
        // jika ingin menggunakan modal .. taruh modal di bawah table lalu bikin perulangan yang sama dengan perulangan diatas.
        ?>
    </div>
    <div class="panel-footer" style="padding:0;">
        <h3><a href="<?php echo base_url() ?>export_sys/export_data_pembelian/<?php echo $this->input->post('tgl1') ?>/<?php echo $this->input->post('tgl2') ?>" class="btn btn-success" style="margin-bottom:10px;">Export</a></h3>
    </div>
           <?php }else{} ?>

</div>
    </div>
</div>
  <!-- /main-inner --> 

<!-- /main -->
