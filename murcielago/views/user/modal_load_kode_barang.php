<? if(empty($kode_barang->nama_barang)){ ?>
<!--
	<script type="text/javascript">
		showSuccessMessage2();
	</script>
-->

<div class="col-md-12"><hr style="margin:5px;"></div>
    <p style="text-align:center;">Data Kosong</p>
<div class="col-md-12"><hr style="margin:5px;"></div>


<? }else{ ?>
<div class="col-md-12"><hr style="margin-bottom:5px;"></div>
	<div class="col-md-4" style="margin-top:10px;">
		<label>Nama Barang</label>
		<input type="text" name="" value="<?= $kode_barang->nama_barang ?>" class="form-control" readonly>
		<input type="hidden" name="nama_barang" value="<?= $kode_barang->nama_barang ?>" class="form-control" readonly>
	</div>
	<div class="col-md-4" style="margin-top:10px;">
		<label>Kategori Barang</label>
		<input type="text" name="" value="<?= $kode_barang->kategori_barang ?>" class="form-control" readonly>
		<input type="hidden" name="kategori_barang" value="<?= $kode_barang->kategori_barang ?>" class="form-control" readonly>
	</div>
	<div class="col-md-4" style="margin-top: 10px;">
		<label>Jenis Barang</label>
		<input type="text" name="" value="<?= $kode_barang->jenis_barang ?>" class="form-control" readonly>
		<input type="hidden" name="jenis_barang" value="<?= $kode_barang->jenis_barang ?>" class="form-control" readonly>
	</div>
	<div class="col-md-4" style="margin-top: 10px;">
		<label>Satuan Barang</label>
		<input type="text" name="" value="<?= $kode_barang->nama_satuan ?>" class="form-control" readonly>
		<input type="hidden" name="satuan" value="<?= $kode_barang->nama_satuan ?>" class="form-control" readonly>
	</div>
	<div class="col-md-4" style="margin-top: 10px;">
		<label>Tanggal Kadaluarsa</label>
		<input type="text" name="" value="<?= $kode_barang->tanggal_expired ?>" class="form-control" readonly>
		<input type="hidden" name="tgl_expired" value="<?= $kode_barang->tanggal_expired ?>" class="form-control" readonly>
	</div>
	<div class="col-md-4" style="margin-top: 10px;">
		<label>Harga Jual Satuan</label>
		<input type="text" name="" value="<?= $kode_barang->harga_pokok ?>" id="harga_satuan<?= $kd_pembelian->kd_pembelian ?>" class="form-control" readonly>
		<input type="hidden" name="harga_jual_satuan" value="<?= $kode_barang->harga_pokok ?>" class="form-control">
	</div>
     <div class="col-md-6" style="margin-top: 10px;">
        <label>Kelipatan Diskon satuan</label>
        <input type="text" value="<?= $kode_barang->kelipatan ?>" name="" class="form-control" readonly>
        <input type="hidden" value="<?= $kode_barang->kelipatan ?>" name="kelipatan_diskon_satuan" class="form-control" readonly>
    </div>
    <div class="col-md-6" style="margin-top: 10px;">
        <label>Diskon Jual Satuan</label>
        <input type="text"value="<?= $kode_barang->diskon ?>" name="" class="form-control " readonly>
        <input type="hidden"value="<?= $kode_barang->diskon ?>" name="diskon_jual_satuan" class="form-control " readonly>
    </div>
<div class="col-md-12"><hr style="margin-bottom:5px;"></div>
<? } ?>