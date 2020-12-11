<div class="content-wrapper">
	<div class="container-fluid">
		<section class="content">
			<div class="row">
				<div class="col-md-12">
					<center>
			            <h3><b>INPUT PEMBAYARAN SUPLIER</b></h3>
			            <hr>
		            </center>
				</div>
			</div>
			<div class="row">
				<div class="col-md-12">
					<div class="col-md-4">
						<label>Status Pembelian Tunai/Kredit</label>
						<select class="form-control selectku">
							<option>Pilih Status</option>
							<option value="lunas">Lunas</option>
							<option value="kredit">Kredit</option>
						</select>
					</div>
					<div class="col-md-4">
						<label>Jatuh Tempo Pembelian Kredit</label>
						<input type="text" name="jatuh_tempo" class="form-control datepicker">
					</div>
					<div class="col-md-4">
						<label>Tanggal Pembelian</label>
						<input type="text" name="jatuh_tempo" class="form-control datepicker">
					</div>
				</div>
				<div class="col-md-12">
					<div class="col-md-4">
						<label>Nama Supplier</label>
						<select class="form-control selectku">
							<option>Pilih suplier</option>
							<? foreach($suplier as $s){	?>
							<option value="<?= $s->kd_supplier ?>"><?= $s->nama_supplier ?></option>
							<? } ?>
						</select>
					</div>
					<div class="col-md-4">
						<label>Kzsategori Barang</label>
						<select class="form-control selectku">
							<option>Pilih suplier</option>
							<? foreach($suplier as $s){	?>
							<option value="<?= $s->kd_supplier ?>"><?= $s->nama_supplier ?></option>
							<? } ?>
						</select>
					</div>
					<div class="col-md-4">
						<label>Tanggal Pembelian</label>
						<input type="text" name="jatuh_tempo" class="form-control datepicker">
					</div>
				</div>
			</div>
		</section>
	</div>
</div>