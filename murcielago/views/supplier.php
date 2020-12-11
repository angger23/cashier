
<!-- /subnavbar -->
<div class="main">
  <div class="main-inner">
    <div class="container">
      <div class="row">
        <div class="span12">
          <div class="widget">
            
            <!-- /widget-header -->
            
              
            
                  <div class="widget-header">
                      <h3>
                <button class="btn btn-info btn-lg" data-toggle="modal" data-target="#myModal" type="button">
                Tambah Supplier</button> 
                      </h3></div>
                <div class="widget-content">
                    
          
                
                    <!-- .stat --> 
                    <table class="table data" id="example">
                        <thead>
                            <tr>
                                
                        <th>No</th>
                        <th>Nama Supplier</th>
                        <th>Alamat Supplier</th>
                        <th>Opsi</th>
                            </tr>
                        </thead>
                        
                        
                        <tbody>
                        <?php $no=1; foreach($sup as $record ){  ?>
                            <tr>
                        <th><?php echo $no; ?></th>
                        <th><?php echo $record['nama_supplier']; ?></th>
                        <th><?php echo $record['alamat_supplier'] ?></th>
                        <th> 
                            <button type="button" class="btn btn-default" data-toggle="modal" data-target="#edit<?php echo $no; ?>" ><i class="fa fa-pencil"  ></i></button>
                            <button type="submit" class="btn btn-default"><i class="fa fa-trash"  ></i></button>
                                
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
        <form method="post" action="<?php echo base_url() ?>data_kasir/update_supplier">
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
                  </div>
                <!-- /widget-content --> 
             <!--   Modal  -->
              <div class="modal fade" id="myModal" role="dialog">
    <div class="modal-dialog">
    
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header" style="background: #2ecc71;">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title" style="color:#fff;" >Tambah Supplier</h4>
        </div>
        <div class="modal-body">
        <form method="post" action="<?php echo base_url() ?>data_kasir/simpan_supplier">
            <div class="form-group">
                <label>Nama Supplier</label>
                <input type="text" name="nama_supplier" class="form-control">
            </div>
            <div class="form-group">
                <label>Alamat</label>
                <input type="text" name="alamat_supplier" class="form-control">
            </div>
            <div class="form-group">
                <button type="submit" class="btn btn-primary">Tambah</button>
            </div>
        </form>			
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        </div>
      </div>
      
    </div>
  </div>
  
</div>
            
          <!-- /widget -->
          
          <!-- /widget -->
          
          <!-- /widget --> 
        </div>
       
      </div>
      <!-- /row --> 
    </div>
    <!-- /container --> 
  </div>
  <!-- /main-inner --> 

<!-- /main -->
