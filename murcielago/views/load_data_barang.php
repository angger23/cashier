<table class="table table-bordered">
							    <thead>
							      <tr>
							        <th>Kode Barang</th>
							        <th>Nama Barang</th>
							        <th>Harga Pokok</th>
							        <th>Satuan Beli</th>
							        <th>Diskon</th>
							        <th>Total Harga</th>
							      </tr>
							    </thead>
							    <tbody>
							      <tr>
							        <td><input type="text" class="form-control" id="kd_barang" disabled name="" value="<?= $kd_barang ?>"></td>
							        <div id="load2">
								        <td><?= $cari_barang->nama_barang; ?></td>
								        <td>Rp <?= number_format($cari_barang->harga_pokok); ?></td>
										<td><input type="text" class="form-control" id="satuan" name="" autofocus="autofocus"></td>
										<td></td>
										<td></td>
							        </div>
							      </tr>
							    </tbody>
							  </table>
							  <?
							  (empty($cari_barang->kd_nota)) ? $kd_nota = 0 : $kd_nota = $cari_barang->kd_nota;
							  (empty($cari_barang->kd_penjualan)) ? $kd_jual = 0 : $kd_jual = $cari_barang->kd_penjualan;
							  ?>
							  <script type="text/javascript">
								$.fn.enterKey = function (fnc) {
		return this.each(function () {
				$(this).keypress(function (ev) {
						var keycode = (ev.keyCode ? ev.keyCode : ev.which);
						if (keycode == '13') {
								fnc.call(this, ev);
						}
				})
		})
}
							  	$("#satuan").enterKey(function () {
									var satuan = $('#satuan').val();
									var pem = <?= $pembeli ?>;
									var kd_barang = $("#kd_barang").val();
									var tgl = '<?php echo $tgl ?>';
									var harga_pokok = '<?php echo $cari_barang->harga_pokok ?>';
									<? if($kd_jual == 0): ?>
									var kd_penjualan = <?= ($kd_jual1 == 0) ? 0 : $kd_jual1 ?>;
									//alert(kd_penjualan);
									<? else: ?>
									var kd_penjualan = <?= $kd_jual ?>;
									<? endif; ?>
								 $("#load2").load("<?= base_url() ?>"+"kasir/cek_satuan_kasir/"+satuan+"/"+pem+"/"+kd_barang+"/"+kd_penjualan+"/"+tgl+"/"+harga_pokok);
								 //$("#load3").load("<//?= base_url() ?>"+"kasir/insert_data_kasir/"+satuan+"/"+pem+"/"+kd_barang+"/"+kd_penjualan);
								})

							  </script>
