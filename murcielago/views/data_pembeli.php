<div class="" style="margin-top:10px;padding:0px;">
    <div class="container">
        <div class="panel panel-default">
            <div class="panel-heading"><h4>Data Pembeli</h4></div>
            <div class="panel-body">
                <table class="table table-bordered" id="example">
                <thead>
                  <tr>
                    <th>No</th>
                    <th>Nama Pembeli</th>
                    <th>Total Pembelian</th>
                  </tr>
                </thead>
                <tbody>
                    <?php
                    $no = 0;
                    foreach($data_pembeli as $waw){ 
                    $no++;
                $data['count_pembeli'] = $this->m_data->count2_pembeli($waw->nama_pembeli)->row(); 
                    ?>
                  <tr>
                      <td><?php echo $no; ?></td>
                      <td><?php echo $waw->nama_pembeli ?></td>
                      <?php
            //$data['count_pembeli'] = $this->m_data->count_pembeli($data->nama_pembeli)->row();
                      ?>
                      <td><?php echo $data['count_pembeli']->totaly ?></td>
                      
                  </tr>
                    <?php } ?>
                </tbody>
              </table>
            </div>
        </div>
    </div>
</div>