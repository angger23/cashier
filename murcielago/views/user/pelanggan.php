<div class="content-wrapper">
  <div class="container-fluid">
    <section class="content">
      <div class="row">
        <div class="widget-header">
            <button class="btn btn-info btn-flat" data-toggle="modal" data-target="#myModal" type="button">Tambah Pelanggan</button>
        </div>
        <hr>
        <div class="widget-content">
          <table class="table table-bordered table-striped data datatable">
              <thead>
                  <tr>

              <th>No</th>
              <th>Kode Pelanggan</th>
              <th>Nama Pelanggan</th>
              <th style="width: 70px;">Opsi</th>
                  </tr>
              </thead>


              <tbody>
              <?php $no=1; foreach($pel as $record ){   ?>
                  <tr>
              <th><?php echo $no; ?></th>
              <th><?php echo $record->kode_pelanggan_baru ?></th>
              <th><?php echo $record->nama_pembeli; ?></th>
              <th>
                  <button type="button" class="btn btn-info btn-flat" data-toggle="modal" data-target="#edit<?php echo $no; ?>" ><i class="fa fa-edit"  ></i></button>
                  <form action="<?= base_url('p/hapus_pembeli/') ?><?= $record->kd_pembeli ?>" method="post"><button type="submit" class="btn btn-danger btn-flat"><i class="fa fa-trash"  ></i></button></form>

                      </th>

                  </tr>
                  <div class="modal fade" id="edit<?php echo $no; ?>" role="dialog">
                      <div class="modal-dialog">

                        <!-- Modal content-->
                        <div class="modal-content">
                          <div class="modal-header" style="background: #2ecc71;">
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                            <h4 class="modal-title" style="color:#fff;" >Update Pelanggan</h4>
                          </div>
                          <div class="modal-body">
                          <form method="post" action="<?php echo base_url() ?>p/update_pelanggan/<?= $record->kd_pembeli ?>">
                              <div class="form-group">
                                  <label>Nama Pembeli</label>
                                  <input type="text" name="nama_pembeli" class="form-control" value="<?php echo $record->nama_pembeli; ?>">
                              </div>
                              <div class="form-group">
                                <label for="">Kode Pelanggan</label>
                                <input type="text" name="kd_pelanggan" class="form-control" value="<?php echo $record->kode_pelanggan_baru; ?>">
                              </div>
                              <div class="form-group">
                                  <button type="submit" class="btn btn-success btn-flat">Update</button>
                              </div>
                          </form>


                          </div>
                          <div class="modal-footer">
                            <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                          </div>
                        </div>

                      </div>
                    </div>

                  <?php $no++; } ?>
              </tbody>

          </table>

        </div>
              <div class="modal fade" id="myModal" role="dialog">
                <div class="modal-dialog">

                  <!-- Modal content-->
                  <div class="modal-content">
                    <div class="modal-header" style="background: #2ecc71;">
                      <button type="button" class="close" data-dismiss="modal">&times;</button>
                      <h4 class="modal-title" style="color:#fff;" >Tambah Pelanggan</h4>
                    </div>
                    <div class="modal-body">
                    <form method="post" action="<?php echo base_url() ?>p/simpan_pelanggan">
                        <div class="form-group">
                            <label>Nama Pelanggan</label>
                            <input type="text" name="nama_pelanggan" class="form-control">
                        </div>
                        <div class="form-group">
                          <label for="">Kode Pelanggan</label>
                          <input type="text" name="kd_pelanggan" class="form-control">
                        </div>
                        <div class="form-group">
                            <button type="submit" class="btn btn-primary btn-flat">Tambah</button>
                        </div>
                    </form>
                    </div>
                    <div class="modal-footer">
                      <button type="button" class="btn btn-danger btn-flat" data-dismiss="modal">Tutup</button>
                    </div>
                  </div>

                </div>
              </div>

            </div>
    </section>
  </div>
</div>
