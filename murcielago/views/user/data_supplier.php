<div class="content-wrapper">
  <div class="container-fluid">
    <section class="content">
    <div class="row">
    	<div class="col-md-8">
          <h4><b>Data Supplier</b></h4>
        </div>
        <div class="col-md-4">
          <div class="form-group">
          	  <button class="btn btn-warning btn-flat pull-right" data-toggle="modal" data-target="#myModalku"><i class="fa fa-file-excel-o"></i> Import</button>
          	  <!-- Modal -->
				<div id="myModalku" class="modal fade" role="dialog">
				  <div class="modal-dialog">

				    <!-- Modal content-->
				    <div class="modal-content">
				      <div class="modal-header">
				        <button type="button" class="close" data-dismiss="modal">&times;</button>
				        <h4 class="modal-title">Import Data</h4>
				      </div>
				      <div class="modal-body">
				      	<form method="post" action="<?= base_url('kasir/import_supplier'); ?>" enctype="multipart/form-data">
				      		 <div class="form-group">
					        	<label>File</label>
					        	<input type="file" name="file" class="form-control">
					        </div>
					        <div class="form-group">
					        	<button class="btn btn-primary" type="submit">Import Data</button>
					        </div>
				      	</form>
				      </div>
				      <div class="modal-footer">
				        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
				      </div>
				    </div>

				  </div>
				</div>
              <a href="<?= base_url('kasir/export_supplier') ?>" class="btn btn-success btn-flat pull-right"><i class="fa fa-file-excel-o"></i> Export</a>
              <button class="btn btn-info btn-flat pull-right" type="button" data-toggle="modal" data-target="#myModal">Tambah Supplier</button>
          	<!-- Modal -->
				<div id="myModal" class="modal fade" role="dialog">
				  <div class="modal-dialog">

				    <!-- Modal content-->
				    <div class="modal-content">
				      <div class="modal-header">
				        <button type="button" class="close" data-dismiss="modal">&times;</button>
				        <h4 class="modal-title">Tambah Supplier</h4>
				      </div>
				      <div class="modal-body">
				        <div class="form-group">
				        	<form method="post" action="<?= base_url('kasir/add_supplier'); ?>">
				        		<div class="form-group">
				        			<label>Kode Supplier</label>
				        			<input type="text" name="kd_supplier" class="form-control">
				        		</div>
				        		<div class="form-group">
				        			<label>Nama Supplier</label>
				        			<input type="text" name="nm_supplier" class="form-control">
				        		</div>
				        		<div class="form-group">
				        			<label>Alamat Supplier</label>
				        			<textarea  class="form-control" name="alamat" rows="4"></textarea>
				        		</div>
				        		<div class="form-group">
				        			<label>Telpon Supplier</label>
				        			<input type="number" name="no_tlp" class="form-control">
				        		</div>
				        		<div class="form-group">
				        			<label>Email Supplier</label>
				        			<input type="email" name="email_supplier" class="form-control">
				        		</div>
				        		<div class="form-group">
				        			<label>Rekening Supplier</label>
				        			<input type="number" name="rek_supplier" class="form-control">
				        		</div>
				        		<div class="form-group">
				        			<button class="btn btn-primary btn-flat" type="submit">Simpan Data</button>
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
          </div>
        </div>
         <div class="col-md-12">
          <hr>
          <?= $this->session->flashdata('alert'); ?>
        </div>
        <table class="table table-bordered datatable-biasa">
		    <thead>
		      <tr>
		        <th>No</th>
		        <th>Kode Supplier</th>
		        <th>Nama Supplier</th>
		        <th>Alamat</th>
		        <th>Telpon</th>
		        <th>Email</th>
		        <th>Rekening</th>
		        <th>Aksi</th>
		      </tr>
		    </thead>
		    <tbody>
		    	<? 
		    	$no=0;
		    	foreach($supplier as $s):
		    	$no++;
		    	?>
		      <tr>
		        <td><?= $no ?></td>
		        <td><?= $s->kode_supplier ?></td>
		        <td><?= $s->nama_supplier ?></td>
		        <td><?= $s->alamat_supplier ?></td>
		        <td><?= $s->telpon  ?></td>
		        <td><?= $s->email ?></td>
		        <td><?= $s->rekening ?></td>
		        <td>
		        	<button class="btn btn-primary btn-flat" type="button" data-toggle="modal" data-target="#myModall<?= $no ?>"><i class="fa fa-edit"></i></button>
		        	<a href="<?= base_url('kasir/delete_supplier/'.$s->kd_supplier.''); ?>" class="btn btn-danger btn-flat"><i class="fa fa-trash"></i></a>
		        </td>
		      </tr>
		      <div id="myModall<?= $no ?>" class="modal fade" role="dialog">
				  <div class="modal-dialog">

				    <!-- Modal content-->
				    <div class="modal-content">
				      <div class="modal-header">
				        <button type="button" class="close" data-dismiss="modal">&times;</button>
				        <h4 class="modal-title">Edit Supplier</h4>
				      </div>
				      <div class="modal-body">
				        <div class="form-group">
				        	<form method="post" action="<?= base_url('kasir/update_supplier/'.$s->kd_supplier.''); ?>">
				        		<div class="form-group">
				        			<label>Kode Supplier</label>
				        			<input type="text" name="kd_supplier" class="form-control" value="<?= $s->kode_supplier ?>">
				        		</div>
				        		<div class="form-group">
				        			<label>Nama Supplier</label>
				        			<input type="text" name="nm_supplier" class="form-control" value="<?= $s->nama_supplier ?>">
				        		</div>
				        		<div class="form-group">
				        			<label>Alamat Supplier</label>
				        			<textarea  class="form-control" name="alamat" rows="4"><?= $s->alamat_supplier ?></textarea>
				        		</div>
				        		<div class="form-group">
				        			<label>Telpon Supplier</label>
				        			<input type="number" name="no_tlp" class="form-control" value="<?= $s->telpon ?>">
				        		</div>
				        		<div class="form-group">
				        			<label>Email Supplier</label>
				        			<input type="email" name="email_supplier" class="form-control" value="<?= $s->email ?>">
				        		</div>
				        		<div class="form-group">
				        			<label>Rekening Supplier</label>
				        			<input type="number" name="rek_supplier" class="form-control" value="<?= $s->rekening ?>">
				        		</div>
				        		<div class="form-group">
				        			<button class="btn btn-success btn-flat" type="submit">Update Data</button>
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
			<? endforeach; ?>
		    </tbody>
		 </table>
    </div>
   </section>
  </div>
</div>