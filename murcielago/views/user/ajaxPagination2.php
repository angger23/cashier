<table class="table table-bordered">
				    <thead>
				      <tr>
				        <th>No</th>
				        <th>Kode Pelanggan</th>
				        <th>Nama Pembeli</th>
				        <th>Sumber Dana</th>
				        <th>Status Keanggotaan</th>
				        <th>Aksi</th>
				      </tr>
				    </thead>
				    <tbody>
					    <?
					   $no=$this->input->post('page');
						if(!empty($posts)): foreach($posts as $p):
						$no++;
					    ?>
				      <tr>
				        <td><?= $no ?></td>
				        <td><?= $p->kode_pelanggan_baru ?></td>
				        <td><?= $p->nama_pembeli ?></td>
				        <td><?= $p->sumber_dana ?></td>
				        <td><?= $p->status_keanggotaan ?></td>
				        <td>
				        	<button class="btn btn-primary btn-flat" type="button" data-toggle="modal" data-target="#myModal<?= $p->kd_pembeli ?>"><i class="fa fa-pencil"></i></button>
				        	<a href="<?= base_url('kasir/delete_pelanggan/'.$p->kd_pembeli.''); ?>" class="btn btn-danger btn-flat"><i class="fa fa-trash"></i></a>
				        </td>
				      </tr>

				      						<?php endforeach; else: ?>
							<tr>
									<td colspan="6">
								 <div class="alert alert-danger alert-dismissible fade in">
								    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
									    <h1>
									    	<strong>Gagal !</strong>
									    </h1>
									     <h3>
									     	Tidak ada data !
									     </h3>
								  </div>
								</td>
								</tr>
								<?php endif; ?>
													<tr >
								<td colspan="6">
								<?php echo $this->ajax_pagination->create_links(); ?>
								</td>
								</tr>
				    </tbody>
				  </table>
				  <?
					   $no=$this->input->post('page');
						if(!empty($posts)): foreach($posts as $p):
						$no++;
					    ?>
				  <!-- Modal -->
					<div id="myModal<?= $p->kd_pembeli ?>" class="modal fade" role="dialog">
					  <div class="modal-dialog">

					    <!-- Modal content-->
					    <div class="modal-content">
					      <div class="modal-header">
					        <button type="button" class="close" data-dismiss="modal">&times;</button>
					        <h4 class="modal-title">Edit Pelanggan</h4>
					      </div>
					      <div class="modal-body">
					        <div class="form-group">
					        	<form method="post" action="<?= base_url('kasir/update_pelanggan/'.$p->kd_pembeli.'') ?>">
					        		<div class="form-group">
					        			<label>Kode Pelanggan</label>
					        			<input type="text" name="kd_pelanggan" class="form-control" value="<?= $p->kd_pelanggan ?>">
					        		</div>
					        		<div class="form-group">
					        			<label>Nama Pelanggan</label>
					        			<input type="text" name="nama_pelanggan" class="form-control" value="<?= $p->nama_pembeli ?>">
					        		</div>
					        		<div class="form-group">
					        			<label>Sumber Dana</label>
					        			<input type="text" name="sumber_dana" class="form-control" value="<?= $p->sumber_dana ?>">
					        		</div>
					        		<div class="form-group">
					        			<label>Status Keanggotaan</label>
					        			<br>
					        			<label class="radio-inline"><input type="radio" name="optradio" value="Anggota" <?= ($p->status_keanggotaan == 'Anggota') ? 'checked' : ''; ?>>Anggota</label>
										<label class="radio-inline"><input type="radio" name="optradio" value="Bukan Anggota" <?= ($p->status_keanggotaan == 'Bukan Anggota') ? 'checked' : ''; ?>>Bukan Anggota</label>
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
					<?php endforeach; else: ?>

								<?php endif; ?>
