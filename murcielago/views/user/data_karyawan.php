<div class="content-wrapper">
  <div class="container-fluid">
    <section class="content">
    <div class="row">
    	<div class="col-md-10">
          <h4><b>Data Karyawan</b></h4>
        </div>
        <div class="col-md-2">
        	<button class="btn btn-primary pull-right btn-flat" data-toggle="modal" data-target="#myModal">Tambah Karyawan</button>
        	<!-- Modal -->
		<div id="myModal" class="modal fade" role="dialog">
		  <div class="modal-dialog">

		    <!-- Modal content-->
		    <div class="modal-content">
		      <div class="modal-header">
		        <button type="button" class="close" data-dismiss="modal">&times;</button>
		        <h4 class="modal-title">Tambah Karyawan</h4>
		      </div>
		      <div class="modal-body">
		        <div class="form-group">
		        	<form method="post" action="<?= base_url('p/add_karyawan') ?>">
		        		<div class="form-group">
		        			<label>Username</label>
		        			<input type="text" name="username" class="form-control">
		        		</div>
		        		<div class="form-group">
		        			<label>Nama Depan</label>
		        			<input type="text" name="first_name" class="form-control">
		        		</div>
		        		<div class="form-group">
		        			<label>Nama Belakang</label>
		        			<input type="text" name="last_name" class="form-control">
		        		</div>
		        		<div class="form-group">
		        			<label>Email</label>
		        			<input type="text" name="email" class="form-control">
		        		</div>
		        		<div class="form-group">
		        			<label>Password</label>
		        			<input type="password" name="password" class="form-control">
		        		</div>
		        		<div class="form-group">
		        			<label>Posisi Karyawan</label>
		        			<select class="form-control" name="posisi">
		        				<option value="">Pilih Posisi</option>
                    <option value="1">Admin Toko</option>
		        				<option value="3">Kasir Toko</option>
		        			</select>
		        		</div>
		        		<div class="form-group">
		        			<button class="btn btn-primary btn-flat" type="submit">Tambah Karyawan</button>
		        		</div>
		        	</form>
		        </div>
		      </div>
		      <div class="modal-footer">
		        <button type="button" class="btn btn-danger btn-flat" data-dismiss="modal">Close</button>
		      </div>
		    </div>

		  </div>
		</div>
        </div>
        <div class="col-md-12">
        	<hr>
        	<?= $this->session->flashdata('alert'); ?>
        </div>
        <div class="col-md-12">
        	  <table class="table table-striped datatable">
			    <thead>
			      <tr>
			        <th>No</th>
			        <th>Username</th>
			        <th>Posisi Pengurus</th>
			        <th>Opsi</th>
			      </tr>
			    </thead>
			    <tbody>
			    <?
			    $cekUser = $this->m_data->semua('users')->result();
			    $no=0;
			    foreach($cekUser as $u):
			    $no++;
			    ?>
			      <tr>
			        <td><?= $no ?></td>
			        <td><?= $u->username ?></td>
			        <?
			        $cariPosisi = $this->m_data->where('users_groups',['user_id' => $u->id])->row();
			        $cariNamaPosisi = $this->m_data->where('groups',['id' => $cariPosisi->group_id])->row();
			        ?>
			        <td><?= ucwords($cariNamaPosisi->name) ?></td>
			        <td>
			        	<button class="btn btn-info btn-flat" data-toggle="modal" data-target="#myModal<?= $u->id ?>"><i class="fa fa-edit"></i></button>
			        	<a href="<?= base_url('p/delete_user/'.$u->id.'') ?>" class="btn btn-danger btn-flat"><i class="fa fa-trash"></i></a>
			        </td>
			      </tr>
			      <!-- Modal -->
				<div id="myModal<?= $u->id ?>" class="modal fade" role="dialog">
				  <div class="modal-dialog">

				    <!-- Modal content-->
				    <div class="modal-content">
				      <div class="modal-header">
				        <button type="button" class="close" data-dismiss="modal">&times;</button>
				        <h4 class="modal-title">Edit Data Karyawan</h4>
				      </div>
				      <div class="modal-body">
				        <div class="form-group">
				        	<form method="post" action="<?= base_url('p/update_user/'.$u->id.'') ?>">
				        		<div class="form-group">
				        			<label>Username</label>
				        			<input type="text" name="username" class="form-control" value="<?= $u->username ?>">
				        		</div>
				        		<div class="form-group">
				        			<label>Nama Depan</label>
				        			<input type="text" name="first_name" class="form-control" value="<?= $u->first_name ?>">
				        		</div>
				        		<div class="form-group">
				        			<label>Nama Belakang</label>
				        			<input type="text" name="last_name" class="form-control" value="<?= $u->last_name ?>">
				        		</div>
				        		<div class="form-group">
				        			<label>Email</label>
				        			<input type="text" name="email" class="form-control" value="<?= $u->email ?>">
				        		</div>
				        		<div class="form-group">
				        			<label>Password</label>
				        			<input type="password" name="password" class="form-control">
                      <small><b>NB : </b> <i>Jika tidak ingin mengganti password kosongi saja kolom ini.</i></small>
				        		</div>
				        		<div class="form-group">
				        			<label>Posisi Karyawan</label>
				        			<select class="form-control" name="posisi">
				        				<option value="">Pilih Posisi</option>
                        <option value="1" <?= ($cariPosisi->group_id == '1') ? 'selected' : ''; ?>>Admin Toko</option>
				        				<option value="2" <?= ($cariPosisi->group_id == '2') ? 'selected' : ''; ?>>Pengurus Toko</option>
				        			</select>
				        		</div>
				        		<div class="form-group">
				        			<button class="btn btn-success btn-flat" type="submit">Update Data Karyawan</button>
				        		</div>
				        	</form>
				        </div>
				      </div>
				      <div class="modal-footer">
				        <button type="button" class="btn btn-danger btn-flat" data-dismiss="modal">Close</button>
				      </div>
				    </div>

				  </div>
				</div>
			      <? endforeach; ?>
			    </tbody>
			  </table>
        </div>
    </div>
  	</section>
  </div>
</div>
