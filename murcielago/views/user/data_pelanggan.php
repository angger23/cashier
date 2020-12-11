<style>
/* Pagination */
div.pagination {
	font-family: "Lucida Sans Unicode", "Lucida Grande", LucidaGrande, "Lucida Sans", Geneva, Verdana, sans-serif;
	padding:2px;
	margin: 20px 10px;
    float: right;
}
div.pagination a {
	margin: 2px;
	padding: 0.5em 0.64em 0.43em 0.64em;
	background-color: #FD1C5B;
	text-decoration: none; /* no underline */
	color: #fff;
}
div.pagination a:hover, div.pagination a:active {
	padding: 0.5em 0.64em 0.43em 0.64em;
	margin: 2px;
	background-color: #FD1C5B;
	color: #fff;
}
div.pagination span.current {
		padding: 0.5em 0.64em 0.43em 0.64em;
		margin: 2px;
		background-color: #f6efcc;
		color: #6d643c;
	}
div.pagination span.disabled {
		display:none;
	}
.pagination ul li{display: inline-block;}
.pagination ul li a.active{opacity: .5;}
/* loading */
.loading{position: absolute;left: 0; top: 0; right: 0; bottom: 0;z-index: 2;background: rgba(255,255,255,0.7);}
.loading .content {
    position: absolute;
    transform: translateY(-50%);
     -webkit-transform: translateY(-50%);
     -ms-transform: translateY(-50%);
    top: 50%;
    left: 0;
    right: 0;
    text-align: center;
    color: #555;
}
</style>
<div class="content-wrapper">
  <div class="container-fluid">
    <section class="content">
    <div class="row">
    	<div class="col-md-8">
          <h4><b>Data Pelanggan</b></h4>
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
				      	<form method="post" action="<?= base_url('kasir/import_pelanggan'); ?>" enctype="multipart/form-data">
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
              <a href="<?= base_url('kasir/export_pelanggan') ?>" class="btn btn-success btn-flat pull-right"><i class="fa fa-file-excel-o"></i> Export</a>
              <button class="btn btn-info btn-flat pull-right" type="button" data-toggle="modal" data-target="#myModal">Tambah Pelanggan</button>
          	<!-- Modal -->
				<div id="myModal" class="modal fade" role="dialog">
				  <div class="modal-dialog">

				    <!-- Modal content-->
				    <div class="modal-content">
				      <div class="modal-header">
				        <button type="button" class="close" data-dismiss="modal">&times;</button>
				        <h4 class="modal-title">Tambah Pelanggan</h4>
				      </div>
				      <div class="modal-body">
				        <div class="form-group">
				        	<form method="post" action="<?= base_url('kasir/add_pelanggan'); ?>">
				        		<div class="form-group">
				        			<label>Kode Pelanggan</label>
				        			<input type="text" name="kd_pelanggan" class="form-control">
				        		</div>
				        		<div class="form-group">
				        			<label>Nama Pelanggan</label>
				        			<input type="text" name="nama_pelanggan" class="form-control">
				        		</div>
				        		<div class="form-group">
				        			<label>Sumber Dana</label>
				        			<input type="text" name="sumber_dana" class="form-control">
				        		</div>
				        		<div class="form-group">
				        			<label>Status Keanggotaan</label>
				        			<br>
				        			<label class="radio-inline"><input type="radio" name="optradio" value="Anggota">Anggota</label>
									<label class="radio-inline"><input type="radio" name="optradio" value="Bukan Anggota">Bukan Anggota</label>
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
         							  	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
<script>
function searchFilter(page_num) {
page_num = page_num?page_num:0;
var keywords = $('#keywords').val();
var sortBy = $('#sortBy').val();
$.ajax({
type: 'POST',
url: '<?php echo base_url(); ?>p/ajaxPaginationData12/'+page_num,
data:'page='+page_num+'&keywords='+keywords+'&sortBy='+sortBy,
beforeSend: function () {
$('.loading').show();
},
success: function (html) {
$('.postList').html(html);
$('.loading').fadeOut("slow");
}
});
}
</script>
						  		<div class="row">
						  			<form class="" action="<?//= base_url('user/index/ac') ?>" method="post">
					                      <div class="col-md-4">
					                        <label for="">Urutkan Sesuai</label>
					                        <select id="sortBy" class="form-control select2" onchange="searchFilter()">
					                          <option value="">Terbaru</option>
					                          <option value="asc">A-Z</option>
					                                  <option value="desc">Z-A</option>
					                        </select>
					                      </div>
					                      <div class="col-md-4">
					                        <label for="">Cari Pelanggan</label>
					                        <input type="text" id="keywords" placeholder="Cari Pelanggan" class="form-control" onkeyup="searchFilter()"/>
					                      </div>
					                    </form>
						  		</div>
          <hr>
          <?= $this->session->flashdata('alert'); ?>
        </div>
			<div class="postList">
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
			</div>
        <div class="col-md-12"></div>
						    <div class="loading" style="display: none;"><div class="content"><img src="<?php echo base_url().'assets/img/lg.discuss-ellipsis-preloader.gif'; ?>"/></div>
						</div>
    </div>
   </section>
  </div>
</div>
