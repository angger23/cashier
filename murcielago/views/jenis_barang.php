<div class="main" style="padding-bottom: 100px;">
	<div class="main-inner">
		<div class="container">
			<div class="row">
				<div class="col-md-12">
					<h3 style="margin: 0px;"><b><i class="fa fa-stock"></i>&nbsp;&nbsp;Tambah Jenis Barang</b></h3>

					<hr>
				</div>
				<div class="col-md-12">
					<div class="col-md-12">
						<?= $this->session->flashdata('alert'); ?>
					</div>
				</div>
			</div>
			<div class="row">
				<form action="<?= base_url('p/tambah_jenis') ?>" method="post">
				<div class="col-md-12">
					<div class="col-md-8">
						<input type="text" name="jenis" class="form-control">
					</div>
					<div class="col-md-4">
						<button type="submit" class="btn btn-primary btn-block">Simpan</button>
					</div>
				</div>
				</form>
			</div>
			<div class="row">
				<div class="col-md-12">
					<hr>
				</div>
			</div>
			<div class="row">
				<div class="col-md-12">
					<div class="table-responsive">
						<table class="table table-bordered table-striped datatable">
							<thead>
								<tr>
									<td style="width: 50px;"><b>No.</b></td>
									<td><b>Kategori Barang</b></td>
									<td style="width: 60px;"><b>Opsi</b></td>
								</tr>
							</thead>
							<tbody>
								<? $no=0; foreach($jenis as $k){ $no++; ?>
								<tr>
									<td><?= $no ?></td>
									<td>
										<p id="isi<?= $no ?>"><?= $k->jenis_barang ?></p>
										<div class="col-md-12" id="cnt-edit<?= $no ?>" style="padding: 0px;">
											<form action="<?= base_url('p/edit_jenis/') ?><?= $k->id_jenis_barang ?>" method="post">
												<div class="col-md-8"><input type="text" name="jenis" class="form-control" value="<?= $k->jenis_barang ?>"></div>
												<div class="col-md-2"><button type="submit" class="btn btn-success"><i class="fa fa-save"></i></button></div>
											</form>
										</div>
									</td>
									<td>
										<button type="button" class="btn btn-info btn-sm" id="edit<?= $no ?>"><i class="fa fa-edit"></i></button>
										<button type="button" class="btn btn-warning btn-sm" id="x-edit<?= $no ?>"><i class="fa fa-times"></i></button>
										<?
										$base_64 = base64_encode($k->id_jenis_barang);
										$url_param = rtrim($base_64, '=');
										?>
										<a href="<?= base_url('p/hapus_jenis/') ?><?= $url_param ?>" class="btn btn-danger btn-sm"><i class="fa fa-trash"></i></a>
									</td>
								</tr>
								<script type="text/javascript">
									$(document).ready(function(){
											$('#cnt-edit<?= $no ?>').hide();
											$('#x-edit<?= $no ?>').hide();
										$('#edit<?= $no ?>').click(function(){
											$('#cnt-edit<?= $no ?>').toggle();
											$('#isi<?= $no ?>').toggle();
											$('#edit<?= $no ?>').toggle();
											$('#x-edit<?= $no ?>').toggle();
										});
										$('#x-edit<?= $no ?>').click(function(){
											$('#cnt-edit<?= $no ?>').toggle();
											$('#isi<?= $no ?>').toggle();
											$('#edit<?= $no ?>').toggle();
											$('#x-edit<?= $no ?>').toggle();
										});
									});
								</script>
								<? } ?>
							</tbody>
						</table>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>