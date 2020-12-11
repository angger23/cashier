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
				<div class="col-md-12">
					<center>
			            <h3><b>INPUT BARANG</b></h3>
			            <hr>
		            </center>
				</div>
			</div>
			<div class="row">
				<form action="<?= base_url('p/aksi_tambah_barang/') ?><?= $user_ion->id ?>" method="post">
					<div class="col-md-12">
						<?= $this->session->flashdata('alert'); ?>
					</div>
				<div class="col-md-12" style="margin-top: 0px;">
					<div class="col-md-4">
						<label>Kategori Barang</label>
						<select class="form-control selectku" name="kategori">
							<option>Pilih Kategori</option>
							<? foreach($kategori as $k){ ?>
							<option value="<?= $k->id_kategori ?>" ><?= $k->kategori_barang ?></option>
							<? }  ?>
						</select>
					</div>
					<div class="col-md-4">
						<label>Jenis Barang</label>
						<select class="form-control selectku" id="selecitni" name="jenis" onchange="ini()">
							<option>Pilih Jenis</option>
							<? foreach($jenis as $j){ ?>
							<option value="<?= $j->id_jenis_barang ?>"><?= $j->jenis_barang ?></option>
							<? }  ?>
						</select>
					</div>
					<div class="col-md-4">
						<label>Kode Barang</label>
						<input type="text" name="kode_barang" id="kode_barang" class="form-control" placeholder="Kode Barang">
						<div id="loadcoy"></div>
					</div>

				</div>
				<script type="text/javascript">
					function ini(){
						var selectval = $('#selecitni').val();
						if(selectval == 2){
							$("#aha").load('<?= base_url('p/inputval') ?>');
						}else if(selectval == 3){
							$("#aha").load('<?= base_url('p/inputval') ?>');
						}else{
							$("#aha").load('<?= base_url('p/inputval1') ?>');
						}
					}
				</script>
				<div class="col-md-12">
					<div id="aha">
						<div class="col-md-4">
							<label>Nama Barang</label>
							<input type="text" name="nama_barang" class="form-control" placeholder="Nama Barang">
						</div>
						<div class="col-md-4">
							<label>Tanggal Kadaluarsa</label>
							<input type="text" name="tgl_ex" class="form-control datepicker" placeholder="Tanggal Kadaluarsa">
						</div>
					</div>
					<div class="col-md-4">
						<label>Satuan barang</label>
						<select class="form-control selectku" name="satuan">
							<option>Satuan Barang</option>
							<? foreach($satuan as $s){ ?>
							<option value="<?= $s->id_satuan ?>"><?= $s->nama_satuan ?></option>
							<? }  ?>
						</select>
					</div>
				</div>

				<div class="col-md-12">
					<div class="col-md-4" style="margin-top: 10px;">
						<label>Stock Barang</label>
						<input type="text" name="stock" class="form-control" placeholder="Stock Barang">
						
						<label>Harga Jual Satuan</label>
						<input type="text" name="harga_beli_satuan" class="form-control beli_satuan" placeholder="Harga Jual Satuan">
					</div>
					<div class="col-md-4" style="margin-top: 10px;">
						<label>Harga Beli Satuan</label>
						<input type="text" name="hrg_jual" class="form-control" placeholder="Harga Beli Satuan">
						<label>Diskon Beli Satuan</label>
						<input type="text" name="diskon_beli_satuan_tbl_barang" class="form-control diskon" placeholder="Diskon Beli Satuan" onkeyup="diskon()">
					</div>
					<script type="text/javascript">
						$(document).ready(function(){
							$('.diskon').keyup(function(){
								var beli_satuan = $('.beli_satuan').val();
								var diskon = $('.diskon').val();
								var prehasil = beli_satuan * diskon / 100;
								var hasil = beli_satuan - prehasil;
								$('.netto').val(hasil);
							});
						});
					</script>
					<div class="col-md-4" style="margin-top: 10px;">
						<label>Harga Netto Beli Satuan</label>
						<input type="text" name="harga_netto_beli_satuan" class="form-control netto" placeholder="Diskon Beli Satuan" readonly>
					</div>
				</div>

				<div class="col-md-12" style="margin-top: 10px;">
					<div class="col-md-2" style="margin-top: 10px;">
						<label>Kelipatan Diskon satuan</label>
						<input type="text" name="kelipatan_diskon_satuan" class="form-control">
					</div>
					<div class="col-md-2" style="margin-top: 10px;">
						<label>Diskon Jual Satuan</label>
						<input type="text" name="diskon_jual_satuan" class="form-control ">
					</div>
					<div class="col-md-4" id="pelunasan">
						<button type="submit" class="btn btn-primary btn-block btn-flat" style="margin-top:34px;" id="simpan_barang">Simpan</button>
					</div>
				</div>
			</form>
			</div>

            <div class="row">
                <div class="col-md-12">
                    <hr>
                </div>
                <div class="col-md-1">
                	<? $date = date('Y-m-d'); ?>
                	<? $stock = $this->m_data->where('barang',['stock' => '0'])->num_rows(); ?>
                	<?
                	$kadaluarsa = $this->m_other->kadaluarsa($date)->result();
                	$no = 0;
                	foreach ($kadaluarsa as $k) {
                		if($k->kd_jenis_barang == '2' || $k->kd_jenis_barang == '3'){
                			$no++;
                		}else{
                		}
                	}
                	?>
                    <div style="background-color:#f1c40f;padding:10px 0px;text-align: center;font-weight: 600;color: #fff;"><?= $no ?></div>
                </div>
                <div class="col-md-2" style="padding-left:0px  ;">
                    <p style="padding-top:7px;"><b>Barang Kadaluarsa</b></p>
                </div>
                <div class="col-md-1">
                    <div style="background-color:#2ed573;padding:10px 0px;text-align: center;font-weight: 600;color: #fff;"><?= $stock ?></div>
                </div>
                <div class="col-md-2" style="padding-left:0px;">
                    <p style="padding-top:7px;"><b>Stock Habis</b></p>
                </div>
                <div class="col-md-12">
                    <hr>
                </div>
            </div>

						<div class="row">
						  <div class="col-md-12">
						  	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
<script>
function searchFilter(page_num) {
page_num = page_num?page_num:0;
var keywords = $('#keywords').val();
var sortBy = $('#sortBy').val();
$.ajax({
type: 'POST',
url: '<?php echo base_url(); ?>p/ajaxPaginationData1/'+page_num,
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
						  		<div class="container-fluid">
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
					                        <label for="">Cari Barang</label>
					                        <input type="text" id="keywords" placeholder="Masukkan Barang" class="form-control" onkeyup="searchFilter()"/>
					                      </div>
					                    </form>
						  		</div>
						  		<br>
						  	<div class="postList">
						  		<div class="table-responsive">
									<table class="table table-bordered table-striped">
								        <thead>
								          <tr>
								            <td><b>No.</b></td>
								            <td><b>Kode Barang</b></td>
								            <td><b>Nama Barang</b></td>
								            <td><b>Tanggal Expired</b></td>
								            <td><b>Kategori Barang</b></td>
								            <td><b>Jenis Barang</b></td>
								            <td><b>Satuan Barang</b></td>
								            <td><b>Harga Beli Satuan</b></td>
								            <td><b>Diskon Beli Satuan</b></td>
								            <td><b>Harga Netto Beli Satuan</b></td>
								            <td style="width: 60px;"><b>Opsi</b></td>
								          </tr>
								        </thead>
												<body>
													<?
								            $date = date('Y-m-d');
								            	$no=$this->input->post('page');
												if(!empty($posts)): foreach($posts as $b):
												$no++;
								            // $cek_pembelian_barang = $this->m_data->cek_akhir($b->id_barang,'DESC','pembelian_barang',['kode_barang' => $b->kode_barang])->row();
								          ?>
													<tr <? if($b['tanggal_expired'] <= date('Y-m-d')){
								                      if($b['kd_jenis_barang'] == '2' || $b['kd_jenis_barang'] == '3'){
								                          echo'style="background-color:#f1c40f;"';
								                      }else{

								                      }

								                      if($b['stock'] == '0'){
								                        echo 'style="background-color:#2ed573;"';
								                      }else{

								                      }

								                  }else{} ?>>
														<td><?= $no ?></td>
														<td><?= $b['kode_barang'] ?></td>
														<td><?= $b['nama_barang'] ?></td>
														<td><?= $b['tanggal_expired'] ?></td>
														<td><?= $b['kategori_barang'] ?></td>
														<td><?= $b['jenis_barang'] ?></td>
														<td><?= $b['nama_satuan'] ?></td>
														<td><?= $b['harga_pokok'] ?></td>
														<td><?= $b['diskon_beli_satuan_tbl_barang'] ?></td>
								            <td><?= $b['harga_netto_beli_satuan'] ?></td>
														<td>
								              <button type="button" class="btn btn-info btn-sm btn-flat" data-toggle="modal" data-target="#myModal<?= $no ?>"><i class="fa fa-edit"></i></button>
								              <?
								              $base_64 = base64_encode($b['id_barang']);
								              $url_param = rtrim($base_64, '=');
								              ?>
								              <a href="<?= base_url('p/aksi_hapus_barang/') ?><?= $b['id_barang'] ?>" class="btn btn-danger btn-sm btn-flat"><i class="fa fa-trash"></i></a>
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
								              <div class="modal-body">
								                <div class="row">
								              <form action="<?= base_url('p/aksi_update_barang/') ?><?= $user_ion->id ?>/<?= $b['id_barang'] ?>" method="post">
								                <div class="col-md-12">
								                  <div class="form-group">
								                    <label>Kategori Barang</label>
								                    <select class="form-control" name="kategori">
								                      <option>Pilih Kategori</option>
								                      <? foreach($kategori as $k){ ?>
								                      <option <? if( $k->id_kategori  == $b['id_kategori']){echo'selected';}else{} ?> value="<?= $k->id_kategori ?>" ><?= $k->kategori_barang ?></option>
								                      <? }  ?>
								                    </select>
								                  </div>
								                </div>
								                <div class="col-md-12">
								                  <label>Jenis Barang</label>
								                  <select class="form-control" name="jenis">
								                    <option>Pilih Jenis</option>
								                    <? foreach($jenis as $j){ ?>
								                    <option  <? if($j->id_jenis_barang  == $b['id_jenis_barang']){echo'selected';}else{} ?> value="<?= $j->id_jenis_barang ?>"><?= $j->jenis_barang ?></option>
								                    <? }  ?>
								                  </select>
								                </div>

								                <div class="col-md-12" style="margin-top: 10px;">
								                  <label>Kode Barang</label>
								                  <input type="text" name="kode_barang" value="<?= $b['kode_barang'] ?>" id="kode_barang2" class="form-control" placeholder="Kode Barang">
								                  <div id="loadcoy2"></div>
								                </div>


								                <div class="col-md-12" style="margin-top: 10px;">
								                  <label>Nama Barang</label>
								                  <input type="text" name="nama_barang" value="<?= $b['nama_barang'] ?>" class="form-control" placeholder="Nama Barang">
								                </div>
								                <div class="col-md-12" style="margin-top: 10px;">
								                  <label>Tanggal Kadaluarsa</label>
								                  <input type="text" name="tgl_ex" value="<?= $b['tanggal_expired'] ?>" class="form-control datepicker" placeholder="Tanggal Kadaluarsa">
								                </div>
								                <div class="col-md-12" style="margin-top: 10px;">
								                  <label>Satuan barang</label>
								                  <select class="form-control" name="satuan">
								                    <option>Satuan Barang</option>
								                    <? foreach($satuan as $s){ ?>
								                    <option <? if($s->id_satuan  == $b['id_satuan']){echo'selected';}else{} ?> value="<?= $s->id_satuan ?>"><?= $s->nama_satuan ?></option>
								                    <? }  ?>
								                  </select>
								                </div>

								                <div class="col-md-12" style="margin-top: 10px;">
								                  <label>Stock Barang</label>
								                  <input type="text" name="stock" value="<?= $b['stock'] ?>" class="form-control" placeholder="Stock Barang">
								                </div>
								                <div class="col-md-12" style="margin-top: 10px;">
								                  <label>Harga Jual</label>
								                  <input type="text" name="harga_jual_satuan" value="<?= $b['harga_pokok'] ?>" class="form-control" placeholder="Harga Jual Satuan" onkeydown="return numbersonly(this, event);" onkeyup="javascript:tandaPemisahTitik(this);">
								                </div>
								                <div class="col-md-12" style="margin-top: 10px;">
								                  <label>Harga Pokok</label>
								                  <input type="text" name="harga_netto_jual_satuan" value="<?= $b['harga_netto_jual_satuan'] ?>" class="form-control" placeholder="Harga Jual Satuan" onkeydown="return numbersonly(this, event);" onkeyup="javascript:tandaPemisahTitik(this);">
								                </div>
								                <div class="col-md-6" style="margin-top: 10px;">
								                  <label>Kelipatan Diskon satuan</label>
								                  <input type="text" name="kelipatan_diskon_satuan" class="form-control" value="<?= $b['kelipatan'] ?>">
								                </div>
								                <div class="col-md-6" style="margin-top: 10px;">
								                  <label>Diskon Jual Satuan</label>
								                  <input type="text" name="diskon_jual_satuan" class="form-control " value="<?= $b['diskon'] ?>">
								                </div>

								                <div class="col-md-12" id="pelunasan2" style="margin-top: 10px;">
								                  <button type="submit" class="btn btn-primary btn-block btn-flat" id="simpan_barang">Simpan</button>
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
													<?php endforeach; else: ?>
							<tr>
									<td colspan="11">
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
								<td colspan="11">
								<?php echo $this->ajax_pagination->create_links(); ?>
								</td>
								</tr>
												</tbody>
									</table>
								</div>	
						  	</div>
						    <div class="col-md-12"></div>
						    <div class="loading" style="display: none;"><div class="content"><img src="<?php echo base_url().'assets/img/lg.discuss-ellipsis-preloader.gif'; ?>"/></div>
						</div>
							</div>
						</div>

		</section>
	</div>
</div>
