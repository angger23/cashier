<div class="content-wrapper">
  <div class="container-fluid">
    <section class="content">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<div class="main" style="padding-bottom: 100px;">
	<div class="main-inner">
		<div class="container">
			<div class="row">
				<div class="col-md-12">
					<h3 style="margin: 0px;" class="pull-left"><b><i class="fa fa-stock"></i>&nbsp;&nbsp;Tambah Barang Suplier</b></h3>
					<button class="btn btn-success btn-flat btn-sm pull-right" data-toggle="modal" data-target="#myModal" > <i class="fa fa-plus-square"></i> Tambah</button>
					<button class="btn btn-warning btn-flat btn-sm pull-right" id="btn-tutup"> <i class="fa fa-times"></i> Tutup</button>
				</div>
				<!-- Modal -->
				<div id="myModal" class="modal fade" role="dialog">
				  <div class="modal-dialog modal-lg">

				    <!-- Modal content-->
				    <div class="modal-content">
				      <div class="modal-header">
				        <button type="button" class="close" data-dismiss="modal">&times;</button>
				        <h4 class="modal-title">Tambah Barang Supplier</h4>
				      </div>
				      <div class="modal-body">
				      	<div class="row" id="">
				<form action="<?= base_url('p/proses_tambah_barang_suplier/') ?><?= $user_ion->id ?>" method="post">
				<div class="col-md-12">
					<div class="col-md-4">
						<label>Status Pembelian Tunai/Kredit</label>
						<select class="form-control selectku" name="status" id="status" style="width: 100%;">
							<option>Pilih Status</option>
							<option value="lunas">Lunas</option>
							<option value="kredit">Kredit</option>
						</select>
					</div>
					<div class="col-md-4">
						<label>Tanggal Pembelian</label>
						<input type="text" name="tgl_pem" class="form-control datepicker" placeholder="Tanggal Pembelian">
					</div>
					<div class="col-md-4">
						<label>Pilih Supplier</label>
						<select class="form-control selectku" name="supplier" id="supplier" style="width:100%;">
							<option>Pilih suplier</option>
							<? foreach($suplier as $s){	?>
							<option value="<?= $s->kd_supplier ?>"><?= $s->nama_supplier ?></option>
							<? } ?>
						</select>
					</div>
				</div>
				<div class="col-md-12">
					<div class="col-md-4">
						<label>Kode Barang</label>
						<input type="text" name="kode_barang" class="form-control" id="kode_barang" placeholder="Kode Barang">
					</div>
                </div>
                <div class="col-md-12">
                  <div class="col-md-12"><hr></div>
                </div>
				<div class="col-md-12">
                    <div id="load_kd_barang">
            						
					</div>
                </div>
                <div class="col-md-12">
          <div class="col-md-4" style="margin-top: 10px;">
						<label>Jumlah Beli</label>
						<input type="text" name="jumlah_beli" id="jumlah_beli" class="form-control" >
					</div>
          <div class="col-md-4" style="margin-top: 10px;">
						<label>Jumlah Harga Beli</label>
						<input type="text" name="jumlah_harga_beli" id="jumlah_harga" class="form-control" readonly>
					</div>
					<div class="col-md-4" style="margin-top: 10px;">
						<label>Harga Jual Satuan</label>
						<input type="text" name="harga_jual_satuan" id="harga_jual_satuan" class="form-control">
					</div>
					<div class="col-md-4" style="margin-top: 10px;">
						<label>Laba Satuan</label>
						<input type="text" name="laba_satuan" id="laba_satuan" class="form-control" readonly>
					</div>
					<div class="col-md-4" style="margin-top: 10px;">
						<label>Bayar ke supplier</label>
						<input type="text" name="bayar" class="form-control ">
					</div>
					<div class="col-md-4" id="tanggal_pelunasan" style="margin-top: 10px;">
						<label>Tanggal Pelunasan</label>
						<input type="text" name="tgl_pelunasan" class="form-control datepicker" placeholder="Tanggal Pelunasan">
					</div>
					<div class="col-md-4" id="pelunasan" style="margin-top: 34px;">
						<button type="submit" class="btn btn-primary btn-block btn-flat" id="simpan_barang">Simpan</button>
					</div>
				</div>
				<script type="text/javascript">
					$(document).ready(function() {

						$('#jumlah_beli').keyup(function(){
							var val1 = $('#jumlah_beli').val();
							var val2 = $('#harga_netto_beli_satuan').val();
              var jumlah = val2 * val1;
							$('#jumlah_harga').val(jumlah);
						});

            $('#harga_jual_satuan').keyup(function(){
              var harga_jual_satuan = $('#harga_jual_satuan').val();
              var harga_netto_beli_satuan = $('#harga_netto_beli_satuan').val();
              var jumlah_laba = harga_jual_satuan - harga_netto_beli_satuan;
              $('#laba_satuan').val(jumlah_laba);
            });

				        $("form").bind("keypress", function(e) {
				            if (e.keyCode == 13) {
				                return false;
				            }
				        });
				    });
				</script>
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
				$("#kode_barang").enterKey(function () {
					var val = $('#kode_barang').val();
					$("#load_kd_barang").load("<?= base_url() ?>"+"p/load_kode_barang/"+val);
				})
				</script>
				<script type="text/javascript">
					$(document).ready(function(){
			                    $("#tanggal_pelunasan").hide();
			            $("#status").on("change", function() {
			                if($(this).val() == 'lunas'){
			                    $("#tanggal_pelunasan").hide();
			                }else{
			                    $("#tanggal_pelunasan").show();
			                }

			              });
			        });
				</script>

				<div class="col-md-12">
					<hr>
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
				<div class="col-md-12">
					<hr>
				</div>
				<div class="col-md-12">
					<div class="col-md-12">
						<?= $this->session->flashdata('alert'); ?>
					</div>
				</div>
			</div>
			

			<div class="row">

                <div class="col-md-10" style="padding:0px;">
                    <form action=""  method="post">
                        <div class="col-md-5">
                            <label>Mulai Tanggal</label>
                            <input type="text" name="hari1" class="form-control datepicker">
                        </div>
                        <div class="col-md-5">
                            <label>Sampai Tanggal</label>
                            <input type="text" name="hari2" class="form-control datepicker">
                        </div>
                        <div class="col-md-2">
                            <button type="submit" class="btn btn-info btn-flat" style="margin-top:24px;"><i class="fa fa-search"></i> Cari</button>
                        </div>
                    </form>
                    <form action=""  method="post">
                        <div class="col-md-5" style="margin-top:10px;">
                            <label>Cari berdasar operator</label>
                            <select class="form-control selectku" name="op">
                                <option>Pilih Operator</option>
                                <?
                                    $op = $this->m_other->users_spp()->result();
                                    foreach($op as $o){
                                ?>
                                <option value="<?= $o->id ?>"><?= $o->first_name ?></option>
                                <? } ?>
                            </select>
                        </div>
                        <div class="col-md-2" style="margin-top:10px;">
                            <button type="submit" class="btn btn-info btn-flat" style="margin-top:24px;"><i class="fa fa-search"></i> Cari</button>
                        </div>
                    </form>
                </div>
                <div class="col-md-2" style="padding:0px;">
                    <div class="col-md-12">
                        <div class="form-group" style="margin-top:24px;">
                          <a href="<?= base_url('p/export_pembelian_supplier') ?>" class="btn btn-primary btn-flat btn-block pull-right"><i class="fa fa-file-excel-o"></i> Export</a>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-group" style="margin-top:24px;">
                            <? if(empty($this->input->post('hari1'))){ ?>
                                <a href="<?= base_url('p/print_pembelian_supplier/') ?><?= $this->input->post('op') ?>" target="_blank" class="btn btn-warning btn-flat btn-block pull-right"><i class="fa fa-print"></i> Print</a>
                            <? }else{  ?>
                              <a href="<?= base_url('p/print_pembelian_supplier/0/') ?><?= $this->input->post('hari1') ?>/<?= $this->input->post('hari2') ?>/<?= $this->input->post('op') ?>" target="_blank" class="btn btn-warning btn-flat btn-block pull-right"><i class="fa fa-print"></i> Print</a>
                            <? } ?>
                        </div>
                    </div>
                </div>
              <!--   <div class="col-md-12" style="padding:0px;">
                    <div class="col-md-12">
                        <? //$sum_pembelian = $this->m_data->sum_saldo_pembelian()->row(); ?>
                        <p style="padding:5px 10px;background-color:#ffbe76;"><b>Saldo</b> : <b>Rp. <?//= number_format($sum_pembelian->total_harga) ?></b></p>
                    </div>
                </div> -->
                <div class="col-md-12"><hr></div>
                    <p><b></b></p>
                <div class="col-md-12"><hr></div>

                <?
                    if(empty($this->input->post('hari1')) && empty($this->input->post('op'))){
                ?>
                <div class="col-md-12">
					<div class="table-responsive">
						<table class="table table-bordered table-striped datatable-biasa">
							<thead>
								<tr>
                                    <td style="width: 100px;"><b>Opsi</b></td>
									<td><b>No.</b></td>
									<td><b>Tanggal Pembelian</b></td>
									<td><b>Nomor Faktur</b></td>
									<td><b>Kode Supplier</b></td>
									<td><b>Nama Supplier</b></td>
									<td><b>Kategori Barang</b></td>
									<td><b>Jenis Barang</b></td>
									<td><b>Kode Barang</b></td>
									<td><b>Nama Barang</b></td>
									<td><b>Tanggal Kadaluarsa</b></td>
									<td><b>Satuan Barang</b></td>
									<td><b>Harga Jual Satuan</b></td>
									<td><b>Diskon Beli Satuan</b></td>
									<td><b>Harga Netto Beli Satuan</b></td>
									<td><b>Jumlah Beli</b></td>
									<td><b>Jumlah Harga Beli</b></td>
									<td><b>Harga Beli Satuan</b></td>
									<td><b>Laba Satuan</b></td>
									<td><b>Status Beli</b></td>
									<td><b>Jatuh Tempo Kredit</b></td>
									<td><b>Operator</b></td>
								</tr>
							</thead>
							<tbody>f
                                <? $date = date('Y-m-d'); ?>
								<? $no=0; foreach($pembelian_barang as $b){ $no++; $barangku = $this->m_data->where('barang',['kode_barang' => $b->kode_barang])->row(); ?>

									<tr>
                                        <td>
                                            <button type="button" class="btn btn-info btn-sm btn-flat btn-block"  data-toggle="modal" data-target="#myModal<?= $no ?>"><i class="fa fa-edit"></i></button>
                                            <a href="<?php echo base_url('p/delete_pem/'.$b->kd_pembelian.'') ?>" class="btn btn-danger btn-sm btn-flat btn-block" style="margin-top:10px;"><i class="fa fa-trash"></i></a>
                                        </td>
										<td><?= $no ?></td>
										<td><?= tgl_indo(date('Y-m-d', strtotime($b->tanggal_pembelian))) ?></td>
										<td></td>
										<td><?= $b->kode_supplier ?></td>
										<td><?= $b->nama_supplier ?></td>
										<td><?= $b->kategori_barang ?></td>
										<td><?= $b->jenis_barang ?></td>
										<td><?= $b->kode_barang ?></td>
										<td><?= $b->nama_barang ?></td>
										<td><?= tgl_indo(date('Y-m-d', strtotime($b->tanggal_expired))) ?></td>
										<td><?= $b->nama_satuan ?></td>
										<td>Rp. <?= number_format($b->harga_beli_satuan) ?></td>
										<td><?= $b->diskon_beli_satuan ?> %</td>
										<td>Rp. <? if(empty($barangku->harga_netto_beli_satuan)){echo'';}else{ echo number_format($barangku->harga_netto_beli_satuan);} ?></td>
										<td><?= $b->jumlah_beli ?></td>
										<td>Rp. <?= number_format($b->total_harga) ?></td>
										<td>Rp. <?= number_format($b->harga_pokok) ?></td>
										<td>Rp. <?= number_format($b->laba_satuan) ?></td>
										<td><?= $b->status ?></td>
										<td><? if($b->jatuh_tempo_kredit == '0000-00-00'){echo'Tidak kredit';}else{ echo tgl_indo(date('Y-m-d', strtotime($b->jatuh_tempo_kredit))); } ?></td>
										<td>
                                            <?
                                                $operator = $this->m_data->where('users',['id' => $b->id_users])->row();
                                                echo $operator->first_name;
                                            ?>
                                        </td>

									</tr>
                                <div id="myModal<?= $no ?>" class="modal fade" role="dialog">
                                  <div class="modal-dialog modal-lg">
                                    <div class="modal-content">
                                      <div class="modal-header">
                                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                                        <h4 class="modal-title">Edit Pembelian</h4>
                                      </div>
                                      <div class="modal-body">
                                          <form id="formmodal" action="<?= base_url('p/proses_edit_barang_suplier/') ?><?= $b->kd_pembelian ?>" method="post">
                                            <div class="row">
                                                <div class="col-md-6" style="margin-top:10px;">
                                                    <label>Status Pembelian Tunai/Kredit</label>
                                                    <select class="form-control" name="status" id="status" <? if($b->status == 'lunas'){echo'readonly';}else{} ?>>
                                                        <option>Pilih Status</option>
                                                        <option <? if($b->status == 'lunas'){echo'selected';}else{} ?> value="lunas">Lunas</option>
                                                        <option <? if($b->status == 'kredit'){echo'selected';}else{} ?> value="kredit">Kredit</option>
                                                    </select>
                                                </div>
                                                <div class="col-md-6" style="margin-top:10px;">
                                                    <label>Tanggal Pembelian</label>
                                                    <input type="text" name="tgl_pem" value="<?= $b->tanggal_pembelian ?>" class="form-control datepicker" placeholder="Tanggal Pembelian">
                                                </div>
                                                <div class="col-md-6" style="margin-top:10px;">
                                                    <label>Pilih Supplier</label>
                                                    <select class="form-control" name="supplier" id="supplier">
                                                        <option>Pilih suplier</option>
                                                        <? foreach($suplier as $s){	?>
                                                        <option <? if($s->kd_supplier == $b->kd_supplier){echo'selected';}else{} ?> value="<?= $s->kd_supplier ?>"><?= $s->nama_supplier ?></option>
                                                        <? } ?>
                                                    </select>
                                                </div>
                                                <div class="col-md-6" style="margin-top:10px;">
                                                    <label>Kode Barang</label>
<!--                                                    <input type="text"class="form-control" id="kode_barang<?= $no ?>" placeholder="Kode Barang">-->
                                                    <div class="input-group">
                                                        <input type="text"  name="kode_barang" id="kode_barang<?= $no ?>" class="form-control" value="<?= $b->kode_barang ?>">
                                                            <span class="input-group-btn">
                                                              <button type="button" id="btkode_barang<?= $no ?>" class="btn btn-info btn-flat"><i class="fa fa-search"></i></button>
                                                            </span>
                                                      </div>
                                                </div>
                                                <div id="load_kd_barang<?= $no ?>" style="margin-top:10px;">

                                                </div>
                                                <div class="col-md-6" style="margin-top: 10px;">
                                                    <label>Harga Beli Satuan</label>
                                                    <input type="text" name="harga_beli_satuan" value="<?= $b->harga_beli_satuan ?>" class="form-control">
                                                </div>
                                                <div class="col-md-6" style="margin-top: 10px;">
                                                    <label>Diskon Beli Satuan</label>
                                                    <input type="text" name="diskon_beli_satuan"  value="<?= $b->diskon_beli_satuan ?>" class="form-control">
                                                </div>
                                                <div class="col-md-6" style="margin-top: 10px;">
                                                    <label>Harga Netto Satuan</label>
                                                    <input type="text" name="harga_netto_satuan"  value="<?= $b->netto_beli_satuan ?>" id="netto<?= $no ?>" class="form-control">
                                                </div>
                                                <div class="col-md-6" style="margin-top: 10px;">
                                                    <label>Jumlah Beli</label>
                                                    <input type="text" name="jumlah_beli"  value="<?= $b->jumlah_beli ?>" id="jumlah_beli<?= $no ?>" class="form-control" >
                                                </div>
                                                <div class="col-md-6" style="margin-top: 10px;">
                                                    <label>Jumlah Harga Beli</label>
                                                    <input type="text" name="jumlah_harga_beli"  value="<?= $b->total_harga ?>" id="jumlah_harga<?= $no ?>" class="form-control" readonly>
                                                </div>

                                                <div class="col-md-6" style="margin-top: 10px;">
                                                    <label>Laba Satuan</label>
                                                    <input type="text" name="laba_satuan" value="<?= $b->laba_satuan ?>" id="laba_satuan<?= $no ?>" class="form-control" readonly>
                                                </div>


                                                <div class="col-md-6" style="margin-top: 10px;">
                                                    <label>Bayar ke supplier</label>
                                                    <input type="text" name="bayar"  value="<?= $b->bayar ?>" class="form-control ">
                                                </div>
                                                <div class="col-md-6" id="tanggal_pelunasan" style="margin-top: 10px;">
                                                    <label>Tanggal Pelunasan</label>
                                                    <input type="text" name="tgl_pelunasan" value="<? if($b->jatuh_tempo_kredit == '0000-00-00'){echo'Tidak kredit';}else{ echo $b->jatuh_tempo_kredit; } ?>" class="form-control datepicker" placeholder="Tanggal Pelunasan" <? if($b->status == 'lunas'){echo'readonly';}else{} ?>>
                                                </div>
                                                <div class="col-md-6" style="margin-top: 34px;">
                                                    <button type="submit" class="btn btn-primary btn-block btn-flat" id="simpan_barang">Simpan</button>
                                                </div>
                                            </div>
                                          </form>
                                          <script>
                                                $(document).on("keypress", '#formmodal', function (e) {
                                                    var code = e.keyCode || e.which;
                                                    if (code == 13) {
                                                        e.preventDefault();
                                                        return false;
                                                    }
                                                });
                                            </script>
                                      </div>
                                      <div class="modal-footer">
                                        <button type="button" class="btn btn-danger btn-flat" data-dismiss="modal">Close</button>
                                      </div>
                                    </div>

                                  </div>
                                </div>
                                <script>
                                    $(document).on("keypress", 'form', function (e) {
                                        var code = e.keyCode || e.which;
                                        if (code == 13) {
                                            e.preventDefault();
                                            return false;
                                        }
                                    });
                                </script>
                                <script>
                                    $(function(){

                                        $('#jumlah_beli<?= $no ?>').keyup(function(){
                                            var val1 = $('#jumlah_beli<?= $no ?>').val();
                                            var val2 = $('#netto<?= $no ?>').val();
                                            var kali = val1 * val2;
                                            $('#jumlah_harga<?= $no ?>').val(kali);
                                        });

                                        $('#netto<?= $no ?>').keyup(function(){
                                        var val1 = $('#harga_satuan<?= $b->kd_pembelian ?>').val();
                                        var val2 = $('#netto<?= $no ?>').val();
                                        var kurang = val1 - val2;
                                        $('#laba_satuan<?= $no ?>').val(kurang);
                                            // alert(val1);
                                        });

                                        $.fn.enterKey<?= $no ?> = function (fnc) {
                                        return this.each(function () {
                                            $(this).keypress(function (ev) {
                                                var keycode = (ev.keyCode ? ev.keyCode : ev.which);
                                                if (keycode == '13') {
                                                    fnc.call(this, ev);
                                                }
                                            })
                                        })
                                    }

                                        $('#pelunasan<?= $no ?>').hide();
                                    $("#btkode_barang<?= $no ?>").click(function () {
                                        var val = $('#kode_barang<?= $no ?>').val();

                                        $("#load_kd_barang<?= $no ?>").load("<?= base_url() ?>"+"p/modal_load_kode_barang/"+"<?= $b->kd_pembelian ?>/"+val);

//                                        $('#pelunasan<?= $no ?>').show();
                                    })
                                    });
                                </script>
								<? } ?>

<!--
                                <tr style="background-color:#badc58;">
                                    <td colspan="14" style="text-align:center;"><b>TOTAL</b></td>
                                    <td></td>
                                    <td></td>
                                    <td colspan="6"></td>
                                </tr>
-->

							</tbody>
						</table>
					</div>
				</div>
                <?
                    }else{

                     if(empty($this->input->post('hari1')) && empty($this->input->post('hari2'))){
                         $pembelian_barang = $this->m_data->cari_operator_pembelian($this->input->post('op'))->result();
                     }else{
                         $pembelian_barang = $this->m_data->cari_hari_pembelian($this->input->post('hari1'),$this->input->post('hari2'))->result();
                     }

                ?>

                <div class="col-md-12">
					<div class="table-responsive">
						<table class="table table-bordered table-striped datatable-biasa">
							<thead>
								<tr>
                                    <td style="width: 100px;"><b>Opsi</b></td>
									<td><b>No.</b></td>
									<td><b>Tanggal Pembelian</b></td>
									<td><b>Nomor Faktur</b></td>
									<td><b>Kode Supplier</b></td>
									<td><b>Nama Supplier</b></td>
									<td><b>Kategori Barang</b></td>
									<td><b>Jenis Barang</b></td>
									<td><b>Kode Barang</b></td>
									<td><b>Nama Barang</b></td>
									<td><b>Tanggal Kadaluarsa</b></td>
									<td><b>Satuan Barang</b></td>
									<td><b>Harga Beli Satuan</b></td>
									<td><b>Diskon Beli Satuan</b></td>
									<td><b>Harga Netto Beli Satuan</b></td>
									<td><b>Jumlah Beli</b></td>
									<td><b>Jumlah Harga Beli</b></td>
									<td><b>Harga Jual Satuan</b></td>
									<td><b>Laba Satuan</b></td>
									<td><b>Status Beli</b></td>
									<td><b>Jatuh Tempo Kredit</b></td>
									<td><b>Operator</b></td>
								</tr>
							</thead>
							<tbody>
                                <? $date = date('Y-m-d'); ?>
								<? $no=0; foreach($pembelian_barang as $b){ $no++; ?>

                                <tr <? if($b->tanggal_expired <= $date){
                                            if($b->kd_jenis_barang == '2' || $b->kd_jenis_barang == '3'){
                                                echo'style="background-color:#f1c40f;"';
                                            }else{

                                            }

                                        }else{} ?>>
                                        <td>
                                            <button type="button" class="btn btn-info btn-sm btn-flat btn-block"  data-toggle="modal" data-target="#myModal<?= $no ?>"><i class="fa fa-edit"></i></button>
                                            <a href="" class="btn btn-danger btn-sm btn-flat btn-block" style="margin-top:10px;"><i class="fa fa-trash"></i></a>
                                        </td>
										<td><?= $no ?></td>
										<td><?= tgl_indo(date('Y-m-d', strtotime($b->tanggal_pembelian))) ?></td>
										<td></td>
										<td><?= $b->kode_supplier ?></td>
										<td><?= $b->nama_supplier ?></td>
										<td><?= $b->kategori_barang ?></td>
										<td><?= $b->jenis_barang ?></td>
										<td><?= $b->kode_barang ?></td>
										<td><?= $b->nama_barang ?></td>
										<td><?= tgl_indo(date('Y-m-d', strtotime($b->tanggal_expired))) ?></td>
										<td><?= $b->nama_satuan ?></td>
										<td>Rp. <?= number_format($b->harga_beli_satuan) ?></td>
										<td>Rp. <?= number_format($b->diskon_beli_satuan) ?></td>
										<td>Rp. <?= number_format($b->netto_beli_satuan) ?></td>
										<td><?= $b->jumlah_beli ?></td>
										<td>Rp. <?= number_format($b->total_harga) ?></td>
										<td>Rp. <?= number_format($b->harga_pokok) ?></td>
										<td>Rp. <?= number_format($b->laba_satuan) ?></td>
										<td><?= $b->status ?></td>
										<td><? if($b->jatuh_tempo_kredit == '0000-00-00'){echo'Tidak kredit';}else{ echo tgl_indo(date('Y-m-d', strtotime($b->jatuh_tempo_kredit))); } ?></td>
										<td>
                                            <?
                                                $operator = $this->m_data->where('users',['id' => $b->id_users])->row();
                                                echo $operator->first_name;
                                            ?>
                                        </td>

									</tr>
                                <div id="myModal<?= $no ?>" class="modal fade" role="dialog">
                                  <div class="modal-dialog modal-lg">
                                    <div class="modal-content">
                                      <div class="modal-header">
                                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                                        <h4 class="modal-title">Modal Header</h4>
                                      </div>
                                      <div class="modal-body">
                                          <form id="formmodal" action="<?= base_url('p/proses_edit_barang_suplier/') ?><?= $b->kd_pembelian ?>" method="post">
                                            <div class="row">
                                                <div class="col-md-6" style="margin-top:10px;">
                                                    <label>Status Pembelian Tunai/Kredit</label>
                                                    <select class="form-control" name="status" id="status">
                                                        <option>Pilih Status</option>
                                                        <option <? if($b->status == 'lunas'){echo'selected';}else{} ?> value="lunas">Lunas</option>
                                                        <option <? if($b->status == 'kredit'){echo'selected';}else{} ?> value="kredit">Kredit</option>
                                                    </select>
                                                </div>
                                                <div class="col-md-6" style="margin-top:10px;">
                                                    <label>Tanggal Pembelian</label>
                                                    <input type="text" name="tgl_pem" value="<?= $b->tanggal_pembelian ?>" class="form-control datepicker" placeholder="Tanggal Pembelian">
                                                </div>
                                                <div class="col-md-6" style="margin-top:10px;">
                                                    <label>Pilih Supplier</label>
                                                    <select class="form-control" name="supplier" id="supplier">
                                                        <option>Pilih suplier</option>
                                                        <? foreach($suplier as $s){	?>
                                                        <option <? if($s->kd_supplier == $b->kd_supplier){echo'selected';}else{} ?> value="<?= $s->kd_supplier ?>"><?= $s->nama_supplier ?></option>
                                                        <? } ?>
                                                    </select>
                                                </div>
                                                <div class="col-md-6" style="margin-top:10px;">
                                                    <label>Kode Barang</label>
                                                    <input type="text" name="kode_barang" value="<?= $b->kode_barang ?>" class="form-control" id="kode_barang<?= $no ?>" placeholder="Kode Barang">
                                                </div>
                                                <div id="load_kd_barang<?= $no ?>" style="margin-top:10px;">

                                                </div>
                                                <div class="col-md-6" style="margin-top: 10px;">
                                                    <label>Harga Beli Satuan</label>
                                                    <input type="text" name="harga_beli_satuan" value="<?= $b->harga_beli_satuan ?>" class="form-control">
                                                </div>
                                                <div class="col-md-6" style="margin-top: 10px;">
                                                    <label>Diskon Beli Satuan</label>
                                                    <input type="text" name="diskon_beli_satuan"  value="<?= $b->diskon_beli_satuan ?>" class="form-control">
                                                </div>
                                                <div class="col-md-6" style="margin-top: 10px;">
                                                    <label>Harga Netto Satuan</label>
                                                    <input type="text" name="harga_netto_satuan"  value="<?= $b->netto_beli_satuan ?>" id="netto<?= $no ?>" class="form-control">
                                                </div>
                                                <div class="col-md-6" style="margin-top: 10px;">
                                                    <label>Jumlah Beli</label>
                                                    <input type="text" name="jumlah_beli"  value="<?= $b->jumlah_beli ?>" id="jumlah_beli<?= $no ?>" class="form-control" >
                                                </div>
                                                <div class="col-md-6" style="margin-top: 10px;">
                                                    <label>Jumlah Harga Beli</label>
                                                    <input type="text" name="jumlah_harga_beli"  value="<?= $b->total_harga ?>" id="jumlah_harga<?= $no ?>" class="form-control" readonly>
                                                </div>

                                                <div class="col-md-6" style="margin-top: 10px;">
                                                    <label>Laba Satuan</label>
                                                    <input type="text" name="laba_satuan" value="<?= $b->laba_satuan ?>" id="laba_satuan<?= $no ?>" class="form-control" readonly>
                                                </div>


                                                <div class="col-md-6" style="margin-top: 10px;">
                                                    <label>Bayar ke supplier</label>
                                                    <input type="text" name="bayar"  value="<?= $b->bayar ?>" class="form-control ">
                                                </div>
                                                <div class="col-md-6" id="tanggal_pelunasan" style="margin-top: 10px;">
                                                    <label>Tanggal Pelunasan</label>
                                                    <input type="text" name="tgl_pelunasan" value="<? if($b->jatuh_tempo_kredit == '0000-00-00'){echo'Tidak kredit';}else{ echo $b->jatuh_tempo_kredit; } ?>" class="form-control datepicker" placeholder="Tanggal Pelunasan">
                                                </div>
                                                <div class="col-md-6" style="margin-top: 34px;">
                                                    <button type="submit" class="btn btn-primary btn-block btn-flat" id="simpan_barang">Simpan</button>
                                                </div>
                                            </div>
                                          </form>
                                          <script>
                                                $(document).on("keypress", 'form', function (e) {
                                                    var code = e.keyCode || e.which;
                                                    if (code == 13) {
                                                        e.preventDefault();
                                                        return false;
                                                    }
                                                });
                                            </script>
                                      </div>
                                      <div class="modal-footer">
                                        <button type="button" class="btn btn-danger btn-flat" data-dismiss="modal">Close</button>
                                      </div>
                                    </div>

                                  </div>
                                </div>
                                <script>
                                    $(document).on("keypress", 'form', function (e) {
                                        var code = e.keyCode || e.which;
                                        if (code == 13) {
                                            e.preventDefault();
                                            return false;
                                        }
                                    });
                                </script>
                                <script>
                                    $(function(){

                                        $('#jumlah_beli<?= $no ?>').keyup(function(){
                                            var val1 = $('#jumlah_beli<?= $no ?>').val();
                                            var val2 = $('#netto<?= $no ?>').val();
                                            var kali = val1 * val2;
                                            $('#jumlah_harga<?= $no ?>').val(kali);
                                        });

                                        $('#netto<?= $no ?>').keyup(function(){
                                        var val1 = $('#harga_satuan<?= $b->kd_pembelian ?>').val();
                                        var val2 = $('#netto<?= $no ?>').val();
                                        var kurang = val1 - val2;
                                        $('#laba_satuan<?= $no ?>').val(kurang);
                                            // alert(val1);
                                        });

                                        $.fn.enterKey<?= $no ?> = function (fnc) {
                                        return this.each(function () {
                                            $(this).keypress(function (ev) {
                                                var keycode = (ev.keyCode ? ev.keyCode : ev.which);
                                                if (keycode == '13') {
                                                    fnc.call(this, ev);
                                                }
                                            })
                                        })
                                    }

                                        $('#pelunasan<?= $no ?>').hide();
                                    $("#kode_barang<?= $no ?>").keyup(function () {
                                        var val = $('#kode_barang<?= $no ?>').val();

                                        $("#load_kd_barang<?= $no ?>").load("<?= base_url() ?>"+"p/modal_load_kode_barang/"+"<?= $b->kd_pembelian ?>/"+val);

//                                        $('#pelunasan<?= $no ?>').show();
                                    })
                                    });
                                </script>
								<? } ?>

<!--
                                <tr style="background-color:#badc58;">
                                    <td colspan="14" style="text-align:center;"><b>TOTAL</b></td>
                                    <td></td>
                                    <td></td>
                                    <td colspan="6"></td>
                                </tr>
-->

							</tbody>
						</table>
					</div>
				</div>

				<?
                    }
                ?>
			</div>

		</div>
	</div>
</div>
   </section>
  </div>
</div>
