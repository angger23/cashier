<div class="" style="margin-top:10px;padding:0px;">
    <div class="container">
        <div class="panel panel-default">
            <div class="panel-heading"><h4>Data Pembeli</h4></div>
            <div class="panel-body">
                <button class="btn btn-primary" type="button" data-toggle="modal" data-target="#myModal">Tambah Pembeli</button>
                <br>
                <br>
                <!-- Modal -->
<div id="myModal" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Tambah Pembeli</h4>
      </div>
      <div class="modal-body">
        <div class="form-group">
            <form method="post" action="<?php echo base_url(); ?>data_kasir/tambah_pembeli">
                <div class="form-group">
                    <label>Nama Pembeli</label>
                    <input type="text" name="nama_pembeli" class="form-control">
                </div>
                <div class="form-group">
                    <button type="submit" class="btn btn-primary">Tambah</button>
                </div>
            </form>  
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>

  </div>
</div>
                <table class="table table-bordered" id="example">
                <thead>
                  <tr>
                    <th>No</th>
                    <th>Nama Pembeli</th>
<!--                    <th>Total Pembelian</th>-->
                    <th>Aksi</th>
                  </tr>
                </thead>
                <tbody>
                    <?php
                    $no = 0;
                    foreach($data_pembeli as $waw){ 
                    $no++;
                //$data['count_pembeli'] = $this->m_data->count2_pembeli($waw->nama_pembeli)->row(); 
                    ?>
                  <tr>
                      <td><?php echo $no; ?></td>
                      <td><?php echo $waw->nama_pembeli ?></td>
                      <?php
            //$data['count_pembeli'] = $this->m_data->count_pembeli($data->nama_pembeli)->row();
                      ?>
<!--                      <td><?php //echo $data['count_pembeli']->totaly ?></td>-->
                      <td><button class="btn btn-default btn-sm" type="button" data-toggle="modal" data-target="#myModalya<?php echo $waw->kd_pembeli ?>"><i class="fa fa-pencil"></i></button> <a href="<?php echo base_url() ?>data_kasir/hapus_pembeli/<?php echo $waw->kd_pembeli ?>" class="btn btn-default btn-sm"><i class="fa fa-trash"></i></a></td>
                  </tr>
                    <?php } ?>
                </tbody>
              </table>
                  <?php
                    $no = 0;
                    foreach($data_pembeli as $waw){ 
                    $no++;
                //$data['count_pembeli'] = $this->m_data->count2_pembeli($waw->nama_pembeli)->row(); 
                    ?>
                    <!-- Modal -->
<div id="myModalya<?php echo $waw->kd_pembeli ?>" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Edit Pembeli</h4>
      </div>
      <div class="modal-body">
        <div class="form-group">
            <form method="post" action="<?php echo base_url(); ?>data_kasir/update_pembeli">
                <div class="form-group">
                    <label>Nama Pembeli</label>
                    <input type="text" name="nama_pembeli" class="form-control" value="<?php echo $waw->nama_pembeli ?>">
                    <input type="hidden" name="kd_pembeli" value="<?php echo $waw->kd_pembeli ?>">
                </div>
                <div class="form-group">
                    <button type="submit" class="btn btn-success">Update</button>
                </div>
            </form>  
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>

  </div>
</div>
                    <?php } ?>
            </div>
             <div class="panel-footer">
                <a href="<?php echo base_url(); ?>export_sys/export_data_pembeli" class="btn btn-success">Export</a>
<!--                 <a href="<?php //echo base_url(); ?>import/" class="btn btn-success">Import</a>-->
            </div>
        </div>
    </div>
</div>