<? if(empty($kode_barang->nama_barang)){ ?>
	<script type="text/javascript">
		showSuccessMessage2();
	</script>
	<div class="col-md-4">
		<label>Nama Barang</label>
		<input type="text" name="nama_barang"  class="form-control" readonly>
	</div>
	<div class="col-md-4">
		<label>Kategori Barang</label>
		<input type="text" name="kategori_barang"   class="form-control" readonly>
	</div>
	<div class="col-md-4" style="margin-top: 10px;">
		<label>Jenis Barang</label>
		<input type="text" name="jenis_barang" class="form-control" readonly>
	</div>
	<div class="col-md-4" style="margin-top: 10px;">
		<label>Satuan Barang</label>
		<input type="text" name="jenis_barang" class="form-control" readonly>
	</div>
	<div class="col-md-4" style="margin-top: 10px;">
		<label>Tanggal Kadaluarsa</label>
		<input type="text" name="jenis_barang"  class="form-control" readonly>
	</div>
    <div class="col-md-4" style="margin-top: 10px;">
		<label>Harga Jual Satuan</label>
		<input type="text" name="" id="harga_satuan" class="form-control" readonly>
	</div>
<? }else{ ?>
	<div class="col-md-3">
		<label>Nama Barang</label>
		<input type="text" name="" value="<?= $kode_barang->nama_barang ?>" class="form-control" readonly>
		<input type="hidden" name="nama_barang" value="<?= $kode_barang->nama_barang ?>" class="form-control" readonly>
	</div>
	<div class="col-md-3">
		<label>Kategori Barang</label>
		<input type="text" name="" value="<?= $kode_barang->kategori_barang ?>" class="form-control" readonly>
		<input type="hidden" name="kategori_barang" value="<?= $kode_barang->kategori_barang ?>" class="form-control" readonly>
	</div>
	<div class="col-md-3" style="margin-top: 10px;">
		<label>Jenis Barang</label>
		<input type="text" name="" value="<?= $kode_barang->jenis_barang ?>" class="form-control" readonly>
		<input type="hidden" name="jenis_barang" value="<?= $kode_barang->jenis_barang ?>" class="form-control" readonly>
	</div>
	<div class="col-md-3" style="margin-top: 10px;">
		<label>Satuan Barang</label>
		<input type="text" name="" value="<?= $kode_barang->nama_satuan ?>" class="form-control" readonly>
		<input type="hidden" name="satuan" value="<?= $kode_barang->nama_satuan ?>" class="form-control" readonly>
	</div>
	<div class="col-md-3" style="margin-top: 10px;">
		<label>Tanggal Kadaluarsa</label>
		<input type="text" name="" value="<?= $kode_barang->tanggal_expired ?>" class="form-control" readonly>
		<input type="hidden" name="tgl_expired" value="<?= $kode_barang->tanggal_expired ?>" class="form-control" readonly>
	</div>
	<div class="col-md-3" style="margin-top: 10px;">
		<label>Harga Jual Satuan</label>
		<input type="text" name="" value="<?= $kode_barang->harga_pokok ?>" id="harga_satuan" class="form-control" readonly>
		<input type="hidden" name="harga_jual_satuan" value="<?= $kode_barang->harga_pokok ?>" class="form-control">
	</div>
	<div class="col-md-3" style="margin-top: 10px;">
		<label>Harga Beli Satuan</label>
		<input type="text" name="" value="<?= $kode_barang->harga_netto_jual_satuan ?>" id="harga_netto_beli_satuan" class="form-control" readonly>
		<input type="hidden" name="harga_netto_beli_satuan" value="<?= $kode_barang->harga_netto_jual_satuan ?>" class="form-control" readonly>
	</div>
	<div class="col-md-3" style="margin-top: 10px;">
		<label>Diskon Beli Satuan</label>
		<input type="text" name="" value="<? if(empty($kode_barang->diskon_beli_satuan_tbl_barang)){echo '0';}else{echo $kode_barang->diskon_beli_satuan_tbl_barang;} ?>" id="diskon" class="form-control" readonly>
		<input type="hidden" name="diskon_beli_satuan" value="<? if(empty($kode_barang->diskon_beli_satuan_tbl_barang)){echo '0';}else{echo $kode_barang->diskon_beli_satuan_tbl_barang;} ?>" class="form-control" readonly>
	</div>
	<div class="col-md-12"><hr></div>
<? } ?>
