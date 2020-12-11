<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<div class="main" style="padding-bottom: 100px;">
	<div class="main-inner">
		<div class="container">
			<div class="row">
				<div class="col-md-12">
					<h3 style="margin: 0px;cursor: pointer;" id="btn-tambah"><b><i class="fa fa-stock"></i>&nbsp;&nbsp;Tambah Barang Suplier</b></h3>

					<hr>
				</div>
				<div class="col-md-12">
					<div class="col-md-12">
						<?= $this->session->flashdata('alert'); ?>
					</div>
				</div>
			</div>

			<?= $this->input->post('kategori') ?>
			<div class="row" id="tambah-barang">
				<form action="<?= base_url('pembelian/proses_tambah_barang_suplier/') ?><?= $user_ion->id ?>" method="post">
				<div class="col-md-12">
					<div class="col-md-4">
						<select class="form-control selectku" name="kategori">
							<option>Pilih Kategori</option>
							<? foreach($kategori as $k){ ?>
							<option value="<?= $k->id_kategori ?>" ><?= $k->kategori_barang ?></option>
							<? }  ?>
						</select>
					</div>
					<div class="col-md-4">	
						<select class="form-control selectku" name="jenis">
							<option>Pilih Jenis</option>
							<? foreach($jenis as $j){ ?>
							<option value="<?= $j->id_jenis_barang ?>"><?= $j->jenis_barang ?></option>
							<? }  ?>
						</select>
					</div>
					<div class="col-md-4">
						<input type="text" name="kode_barang" id="kode_barang" class="form-control" placeholder="Kode Barang">
						<div id="loadcoy"></div>
					</div>
					
				</div>

				<script type="text/javascript">
					$(document).ready(function(){


						$('#btn-tambah').click(function(){
						$('#tambah-barang').slideToggle();
						});

						$('#kode_barang').keyup(function(){
							var val = $('#kode_barang').val();
							$('#loadcoy').load("<?= base_url() ?>"+"pembelian/load_kode/"+val);
						});
					});
				</script>
				
				<div class="col-md-12">
					<div class="col-md-4">
						<input type="text" name="nama_barang" class="form-control" placeholder="Nama Barang">
					</div>
					<div class="col-md-4">
						<input type="text" name="tgl_ex" class="form-control datepicker" placeholder="Tanggal Expired">
					</div>
					<div class="col-md-4">	
						<select class="form-control selectku" name="satuan">
							<option>Satuan Barang</option>
							<? foreach($satuan as $s){ ?>
							<option value="<?= $s->id_satuan ?>"><?= $s->nama_satuan ?></option>
							<? }  ?>
						</select>
					</div>
				</div>

				<div class="col-md-12">
					<div class="col-md-4">
						<input type="text" name="harga_beli" onkeydown="return numbersonly(this, event);" onkeyup="javascript:tandaPemisahTitik(this);"  style="text-align: right;" class="form-control" placeholder="Harga Beli Satuan">
					</div>
					<div class="col-md-4">
						<input type="text" name="diskon_beli" onkeydown="return numbersonly(this, event);" onkeyup="javascript:tandaPemisahTitik(this);"  style="text-align: right;" class="form-control" placeholder="Diskon Beli Satuan">
					</div>
					<div class="col-md-4">
						<input type="text" name="netto" onkeydown="return numbersonly(this, event);" onkeyup="javascript:tandaPemisahTitik(this);"  style="text-align: right;" class="form-control" placeholder="Harga Netto Beli Satuan">
					</div>
				</div>

				<div class="col-md-12" style="margin-top: 10px;">
					<div class="col-md-4">
						<input type="text" style="text-align: right;" name="harga_pokok" placeholder="harga_pokok" class="form-control" onkeydown="return numbersonly(this, event);" onkeyup="javascript:tandaPemisahTitik(this);">
					</div>
					<div class="col-md-4">
						<input type="text" name="stock" placeholder="stock" class="form-control">
					</div>
					<div class="col-md-2">
						<input type="text" name="kelipatan" placeholder="kelipatan" class="form-control">
					</div>
					<div class="col-md-2">
						<input type="text" name="diskon" placeholder="diskon" class="form-control">
					</div>
				</div>

				<div class="col-md-12" style="margin-top: 10px;">
					
					<div class="col-md-offset-8 col-md-4">
						<button type="submit" class="btn btn-primary btn-block" id="simpan_barang">Simpan</button>
					</div>
					
				</div>

				<div class="col-md-12">
					<hr>
				</div>

			</form>

			</div>
			
			<div class="row">
				<div class="col-md-12">
					<div class="table-responsive">
						<table class="table table-bordered table-striped datatable">
							<thead>
								<tr>
									<td><b>No.</b></td>
									<td><b>Kategori Barang</b></td>
									<td><b>Jenis Barang</b></td>
									<td><b>Kode Barang</b></td>
									<td><b>Nama Barang</b></td>
									<td><b>Tanggal Expired</b></td>
									<td><b>Satuan Barang</b></td>
									<td><b>Harga Beli Satuan</b></td>
									<td><b>Diskon Beli Satuan</b></td>
									<td><b>Harga Netto Beli Satuan</b></td>
									<td style="width: 60px;"><b>Opsi</b></td>
								</tr>
							</thead>
							<tbody>
								<? $no=0; foreach($barang as $b){ $no++; ?>
								<tr>
									<td><?= $no ?></td>
									<td><?= $b->kategori_barang ?></td>
									<td><?= $b->jenis_barang ?></td>
									<td><?= $b->kode_barang ?></td>
									<td><?= $b->nama_barang ?></td>
									<td><?= tgl_indo(date('Y-m-d', strtotime($b->tanggal_expired))) ?></td>
									<td><?= $b->nama_satuan ?></td>
									<td>Rp. <?= $b->harga_beli_satuan ?></td>
									<td>Rp. <?= $b->diskon_beli_satuan ?></td>
									<td>Rp. <?= $b->harga_netto_satuan ?></td>
									<td>
										<button type="button" class="btn btn-info btn-sm" data-toggle="modal" data-target="#myModal<?= $no ?>"><i class="fa fa-edit"></i></button>
										<?
										$base_64 = base64_encode($b->id_barang);
										$url_param = rtrim($base_64, '=');
										?>
										<a href="<?= base_url('pembelian/proses_hapus_barang_suplier/') ?><?= $url_param ?>" class="btn btn-danger btn-sm"><i class="fa fa-trash"></i></a>
									</td>
								</tr>
								<div id="myModal<?= $no ?>" class="modal fade" role="dialog">
								  <div class="modal-dialog">

								    <!-- Modal content-->
								    <div class="modal-content">
								      <div class="modal-header">
								        <button type="button" class="close" data-dismiss="modal">&times;</button>
								        <h4 class="modal-title">Edit Barang</h4>
								      </div>
								      <form action="<?= base_url('pembelian/proses_edit_barang_suplier/') ?><?= $user_ion->id ?>/<?= $b->id_barang ?>" method="post">
								      <div class="modal-body">
								        <div class="row">
								        	<div class="col-md-12" style="margin: 5px 0px;">
												<select class="form-control" name="kategori">
													<!-- <option>Pilih Kategori</option> -->
													<? foreach($kategori as $k2){ ?>
													<option value="<?= $k->id_kategori ?>" <? if($b->id_kategori == $k2->id_kategori ){echo'selected';}else{} ?>><?= $k2->kategori_barang ?></option>
													<? }  ?>
												</select>
											</div>
											<div class="col-md-12" style="margin: 5px 0px;">	
												<select class="form-control" name="jenis">
													<option>Pilih Jenis</option>
													<? foreach($jenis as $j){ ?>
													<option value="<?= $j->id_jenis_barang ?>" <? if($b->id_jenis_barang == $j->id_jenis_barang ){echo'selected';}else{} ?>><?= $j->jenis_barang ?></option>
													<? }  ?>
												</select>
											</div>
											<div class="col-md-12" style="margin: 5px 0px;">
												<input type="text" name="kode_barang" class="form-control" placeholder="Kode Barang" value="<?= $b->kode_barang ?>">
											</div>
											<div class="col-md-12" style="margin: 5px 0px;">
												<input type="text" name="nama_barang" class="form-control" placeholder="Nama Barang" value="<?= $b->nama_barang ?>">
											</div>
											<div class="col-md-12" style="margin: 5px 0px;">
												<input type="text" name="tgl_ex" class="form-control datepicker" placeholder="Tanggal Expired" value="<?= tgl_indo(date('Y-m-d', strtotime($b->tanggal_expired))) ?>">
											</div>
											<div class="col-md-12" style="margin: 5px 0px;">	
												<select class="form-control" name="satuan">
													<option>Satuan Barang</option>
													<? foreach($satuan as $s){ ?>
													<option value="<?= $s->id_satuan ?>" <? if($b->id_satuan == $s->id_satuan ){echo'selected';}else{} ?>><?= $s->nama_satuan ?></option>
													<? }  ?>
												</select>
											</div>
											<div class="col-md-1">
												<p style="margin-top:13px;"><b>Rp.</b></p>
											</div>
											<div class="col-md-11" style="margin: 5px 0px;">
												<input type="text" value="<?= $b->harga_beli_satuan ?>" name="harga_beli" onkeydown="return numbersonly(this, event);" onkeyup="javascript:tandaPemisahTitik(this);"  style="text-align: right;" class="form-control" placeholder="Harga Beli Satuan">
											</div>
											<div class="col-md-1">
												<p style="margin-top:13px;"><b>Rp.</b></p>
											</div>
											<div class="col-md-11" style="margin: 5px 0px;">
												<input type="text" value="<?= $b->diskon_beli_satuan ?>" name="diskon_beli" onkeydown="return numbersonly(this, event);" onkeyup="javascript:tandaPemisahTitik(this);"  style="text-align: right;" class="form-control" placeholder="Diskon Beli Satuan">
											</div>
											<div class="col-md-1">
												<p style="margin-top:13px;"><b>Rp.</b></p>
											</div>
											<div class="col-md-11" style="margin: 5px 0px;">
												<input type="text" value="<?= $b->harga_netto_satuan ?>" name="netto" onkeydown="return numbersonly(this, event);" onkeyup="javascript:tandaPemisahTitik(this);"  style="text-align: right;" class="form-control" placeholder="Harga Netto Beli Satuan">
											</div>
								        </div>
								      </div>
								      <div class="modal-footer">
								        <button type="submit" class="btn btn-primary">Simpan</button>
								        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
								      </div>
								      </form>
								    </div>

								  </div>
								</div>
								<? } ?>
							</tbody>
						</table>
					</div>
				</div>
			</div>
			
		</div>
	</div>
</div>