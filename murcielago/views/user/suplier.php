<div class="content-wrapper">
  <div class="container-fluid">
    <section class="content">
      <div class="row">
        <div class="widget-header">
            <button class="btn btn-info btn-flat" data-toggle="modal" data-target="#myModal" type="button">Tambah Supplier</button> 
        </div>
        <hr>
        <div class="widget-content">
          <table class="table table-bordered table-striped data datatable">
              <thead>
                  <tr>
                      
              <th>No</th>
              <th>Nama Supplier</th>
              <th>Alamat Supplier</th>
              <th style="width: 70px;">Opsi</th>
                  </tr>
              </thead>
              
              
              <tbody>
              <?php $no=1; foreach($sup as $record ){  ?>
                  <tr>
              <th><?php echo $no; ?></th>
              <th><?php echo $record['nama_supplier']; ?></th>
              <th><?php echo $record['alamat_supplier'] ?></th>
              <th> 
                  <button type="button" class="btn btn-info btn-flat" data-toggle="modal" data-target="#edit<?php echo $no; ?>" ><i class="fa fa-edit"  ></i></button>
                  <button type="submit" class="btn btn-danger btn-flat"><i class="fa fa-trash"  ></i></button>
                      
                      </th>
              
                  </tr>
                  <div class="modal fade" id="edit<?php echo $no; ?>" role="dialog">
                      <div class="modal-dialog">
                      
                        <!-- Modal content-->
                        <div class="modal-content">
                          <div class="modal-header" style="background: #2ecc71;">
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                            <h4 class="modal-title" style="color:#fff;" >Update Supplier</h4>
                          </div>
                          <div class="modal-body">
                          <form method="post" action="<?php echo base_url() ?>p/update_supplier">
                              <div class="form-group">
                                  <label>Nama Supplier</label>
                                  <input type="text" name="nama_supplier" class="form-control" value="<?php echo $record['nama_supplier']; ?>">
                                  <input type="hidden" name="kd_supplier" value="<?php echo $record['kd_supplier']; ?>">
                              </div>
                              <div class="form-group">
                                  <label>Alamat</label>
                                  <input type="text" name="alamat_supplier" class="form-control" value="<?php echo $record['alamat_supplier']; ?>">
                              </div>
                              <div class="form-group">
                                  <button type="submit" class="btn btn-success">Update</button>
                              </div>
                          </form>
                                      
                          
                          </div>
                          <div class="modal-footer">
                            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
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
                      <h4 class="modal-title" style="color:#fff;" >Tambah Supplier</h4>
                    </div>
                    <div class="modal-body">
                    <form method="post" action="<?php echo base_url() ?>p/simpan_supplier">
                        <div class="form-group">
                            <label>Nama Supplier</label>
                            <input type="text" name="nama_supplier" class="form-control">
                        </div>
                        <div class="form-group">
                            <label>Alamat</label>
                            <input type="text" name="alamat_supplier" class="form-control">
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