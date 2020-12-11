<table class="table table-striped">
		    <thead>
		      <tr>
		        <th>No</th>
		        <th>Atas Nama</th>
		        <th>Jatuh Tempo</th>
		        <th>Kekurangan Biaya</th>
		        <th colspan="2">Bayar</th>
		      </tr>
		    </thead>
		    <tbody>
		    <? 
		    $no=0;
		    foreach($list_hutang as $li):
		    $no++;
		    ?>
		      <tr>
		        <td><?= $no ?></td>
		        <td><?= $li->atas_nama ?></td>
		        <td><?= tgl_indo($li->tanggal_jatuh_tempo) ?></td>
		        <td>Rp <?= number_format($li->kekurangan_biaya) ?></td>
		        <td>
		        	<button class="btn btn-info btn-flat" data-toggle="modal" data-target="#myModal<?= $li->kd_penjualan ?>"><i class="fa fa-money"></i></button>
		        	<? if($li->status_lunas == 'berlanjut'): ?>
		        	<button class="btn btn-success btn-flat" data-toggle="modal" data-target="#myModalku<?= $li->kd_penjualan ?>"><i class="fa fa-money"></i> Detail Pembayaran</button>
		        	<? endif; ?>
		        </td>
		      </tr>
		      <!-- Modal -->
		     <? endforeach; ?>
		    </tbody>
		  </table>
 			<? 
		    $no=0;
		    foreach($list_hutang as $li):
		    $no++;
		    ?>
		  <div id="myModal<?= $li->kd_penjualan ?>" class="modal fade" role="dialog">
				  <div class="modal-dialog">

				    <!-- Modal content-->
				    <div class="modal-content">
				      <div class="modal-header">
				        <button type="button" class="close" data-dismiss="modal">&times;</button>
				        <h4 class="modal-title">Pembayaran Hutang</h4>
				      </div>
				      <div class="modal-body">
				        <div class="form-group">
				        	<form method="post" action="<?= base_url('kasir/bayar_hutang/'.$li->id_hutang.'/'.$li->kd_penjualan.'') ?>">
					        	<div class="form-group">
					        		<label>Keterangan</label>
					        		<textarea class="form-control" name="keterangan" rows="4"></textarea>
					        	</div>
					        	<div class="form-group">
					        		<label>Nominal Pembayaran</label>
					        		<input type="text" name="nominal" class="form-control">
					        	</div>
					        	<div class="form-group">
					        		<button class="btn btn-primary btn-flat" type="submit">Bayar Sekarang</button>
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
		<div id="myModalku<?= $li->kd_penjualan?>" class="modal fade" role="dialog">
			  <div class="modal-dialog">

			    <!-- Modal content-->
			    <div class="modal-content">
			      <div class="modal-header">
			        <button type="button" class="close" data-dismiss="modal">&times;</button>
			        <h4 class="modal-title">Detail Pembayaran Hutang</h4>
			      </div>
			      <div class="modal-body">
			          <table class="table table-bordered">
					    <thead>
					      <tr>
					        <th>No</th>
					        <th>Keterangan</th>
					        <th>Nominal Pembayaran</th>
					        <th>Tanggal Pembayaran</th>
					      </tr>
					    </thead>
					    <tbody>
					    	<?
					    	$list_detail = $this->m_data->where('join_hutang_penjualan',['id_hutang' => $li->id_hutang])->result();
					    	$nos=0;
					    	foreach($list_detail as $de):
					    	$nos++;
					    	?>
					      <tr>
					        <td><?= $nos ?></td>
					        <td><?= $de->keterangan ?></td>
					        <td>Rp <?= number_format($de->bayar) ?></td>
					        <td><?= tgl_indo(date('Y-m-d')) ?></td>
					      </tr>
					  		<? endforeach; ?>
					    </tbody>
					  </table>
			      </div>
			      <div class="modal-footer">
			        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
			      </div>
			    </div>

			  </div>
			</div>
		     <? endforeach; ?>
