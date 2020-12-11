						  <?php 
						    $user_ion = $this->ion_auth->user()->row();
        $kategori = $this->m_data->semua('kategori_barang')->result();
        $jenis = $this->m_data->semua('jenis_barang')->result();
        $satuan = $this->m_data->semua('satuan_barang')->result();
        $barang = $this->m_data->barang_suplier()->result();
        $suplier = $this->m_data->semua('supplier')->result();
						   ?>
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
									<?
								            $date = date('Y-m-d');
								            	$no=$this->input->post('page');
												if(!empty($posts)): foreach($posts as $b):
												$no++;
								            // $cek_pembelian_barang = $this->m_data->cek_akhir($b->id_barang,'DESC','pembelian_barang',['kode_barang' => $b->kode_barang])->row();
								          ?>
								<div id="myModal<?php echo $no ?>" class="modal fade" role="dialog">
								          <div class="modal-dialog">

								            <!-- Modal content-->
								            <div class="modal-content">
								              <div class="modal-header">
								                <button type="button" class="close" data-dismiss="modal">&times;</button>
								                <h4 class="modal-title">Edit Barang</h4>
								              </div>
								              <div class="modal-body">
								                <div class="row">
								             		 <form action="<?php echo base_url('p/aksi_update_barang/') ?><?php echo $user_ion->id ?>/<?php echo $b['id_barang'] ?>" method="post">
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

								<?php endif; ?>
													
									<script type="text/javascript">
  $(document).ready(function(){
    $('.datepicker').datetimepicker({
      format: 'YYYY-MM-DD'
    });

  });
</script>
