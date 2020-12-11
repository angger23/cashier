<div class="" style="margin-top:10px;padding:0px;">
    <div class="container">
        <div class="panel panel-default">
            <div class="panel-heading"><h4>Rating Barang</h4></div>
            <div class="panel-body">
                <table class="table table-bordered" id="example">
                <thead>
                  <tr>
                    <th>No</th>
                    <th>Nama Barang</th>
                    <th>Kode Barang</th>
                    <th>Harga Pokok</th>
                    <th>Total Nota Yang Keluar</th>
                    <th>Total Barang Di Beli</th>
                  </tr>
                </thead>
                <tbody>
                    <?php
                    $no = 0;
                    foreach($rate_barang as $rate){ 
                    $no++;
                    ?>
                  <tr>
                      <td><?php echo $no; ?></td>
                      <td><?php echo $rate->nama_barang ?></td>
                      <td><?php echo $rate->kode_barang ?></td>
                      <td>Rp <?php echo number_format($rate->harga_pokok); ?></td>
                      <td><?php if($rate->total_dibeli == 0){}else{echo $rate->total_dibeli;} ?></td>
                      <td><?php $data['sum_rate_barang'] =  $this->m_data->sum_rate_barang($rate->kode_barang)->row();?>
                        <?php echo $data['sum_rate_barang']->totalx ?>
                      </td>
                  </tr>
                    <?php } ?>
                </tbody>
              </table>
            </div>
        </div>
    </div>
</div>