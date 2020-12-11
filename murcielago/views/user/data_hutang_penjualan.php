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
         							  	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
<script>
function searchFilter(page_num) {
page_num = page_num?page_num:0;
var keywords = $('#keywords').val();
var sortBy = $('#sortBy').val();
$.ajax({
type: 'POST',
url: '<?php echo base_url(); ?>p/ajaxPaginationData123/'+page_num,
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
						  		<div class="row">
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
					                        <label for="">Cari Nama</label>
					                        <input type="text" id="keywords" placeholder="Cari Nama" class="form-control" onkeyup="searchFilter()"/>
					                      </div>
					                    </form>
						  		</div>
          <hr>
        </div>
    	<div class="postList">
    	  <table class="table table-striped">
		    <thead>
		      <tr>
		        <th>No</th>
		        <th>Atas Nama</th>
		        <th>Jatuh Tempo</th>
		        <th>Kekurangan Biaya</th>
		        <th colspan="2">Detail Pembelian</th>
		      </tr>
		    </thead>
		    <tbody>
		    <? 
			$no=$this->input->post('page');
		    if(!empty($posts)): foreach($posts as $li):
		    $no++;
		    $cari_penjualan = $this->m_data->where('penjualan_barang',array('kd_penjualan' => $li->kd_penjualan))->row();
		    ?>
		      <tr>
		        <td><?= $no ?></td>
		        <td><?= $li->atas_nama ?></td>
		        <td><?= tgl_indo($li->tanggal_jatuh_tempo) ?></td>
		        <td>Rp <?= number_format($li->kekurangan_biaya) ?></td>
		        <td>
		        	<button class="btn btn-info btn-flat" data-toggle="modal" data-target="#myModal<?= $li->kd_penjualan ?>"><i class="fa fa-eye"></i></button>
		        	<? if($li->status_lunas == 'berlanjut'): ?>
		        	<button class="btn btn-success btn-flat" data-toggle="modal" data-target="#myModalku<?= $li->kd_penjualan ?>"><i class="fa fa-money"></i> Detail Pembayaran</button>
		        	<? endif; ?>
		        	<a href="<?php echo base_url('kasir/cetak_struk/'.$cari_penjualan->kd_penjualan.'/'.$cari_penjualan->bayar.'') ?>" target="_blank" class="btn btn-warning btn-flat"><i class="fa fa-print"></i></a>
		        </td>
		        <td></td>
		      </tr>
		      <!-- Modal -->
		     <?php endforeach; else: ?>
							<tr>
									<td colspan="5">
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
								<tr>
								  	<td colspan="5">
								<?php echo $this->ajax_pagination->create_links(); ?>
								  	</td>
								  </tr>
		    </tbody>
		  </table>
		   <? 
			$nos=$this->input->post('page');
		    if(!empty($posts)): foreach($posts as $liq):
		    $nos++;
		    ?>
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
		  	<div id="myModal<?= $liq->kd_penjualan ?>" class="modal fade" role="dialog">
				  <div class="modal-dialog modal-lg">

				    <!-- Modal content-->
				    <div class="modal-content">
				      <div class="modal-header">
				        <button type="button" class="close" data-dismiss="modal">&times;</button>
				        <h4 class="modal-title">Detail Pembelian</h4>
				      </div>
				      <div class="modal-body">
							  <table class="table table-bordered">
								    <thead>
								      <tr>
								        <th>No</th>
								        <th>Nama Barang</th>
								        <th>Harga Jual</th>
								        <th>Jumlah Beli</th>
								        <th>Diskon</th>
								        <th>Total</th>
								      </tr>
								    </thead>
								    <tbody>
								      <? 
								      $list_checkout = $this->m_data->list_checkout($liq->kd_penjualan)->result();
								      $no=0;
								      $ttk=0;
								      $dis=0;
								      foreach($list_checkout as $lis){
								      $no++;
								      ?>
								      <tr>
								        <td><?= $no ?></td>
								        <td><?= $lis->nama_barang ?></td>
								        <td>Rp <?= number_format($lis->harga_pokok) ?></td>
								        <td>x <?= $lis->satuan?></td>
								        <? 
								        $cari_diskon = $this->m_data->where('barang',['kode_barang' => $lis->kode_barang])->row();
								        ?>
								        <td><?= ($lis->satuan >= $cari_diskon->kelipatan) ? $cari_diskon->diskon : '0'; ?>%</td>
								        <td>Rp <? 
								        if($cari_diskon->kelipatan == '0'){
									          echo number_format($lis->harga_pokok * $lis->satuan);
									            $ttl = $lis->harga_pokok * $lis->satuan;
									        }else{
									          if($lis->satuan >= $cari_diskon->kelipatan){
									            $disc = $cari_diskon->diskon / 100 * ($lis->harga_pokok * $lis->satuan);
									            echo number_format(($lis->harga_pokok * $lis->satuan)-$disc);
									            $ttl = ($lis->harga_pokok * $lis->satuan)-$disc;
									          }else{
									            echo number_format($lis->harga_pokok * $lis->satuan);
									            $ttl = $lis->harga_pokok * $lis->satuan;
									          }
									        }
								        ?></td>
								      </tr>
								    <?
								    $diskon[$no] = ($lis->satuan >= $cari_diskon->kelipatan) ? $cari_diskon->diskon : '0';
								    $dis += $diskon[$no];
								    $total_harga[$no] = $ttl;
								    $ttk += $total_harga[$no];
								  } ?>
								  <tr>
								  	<td colspan="5">Total Harga</td>
								  	<td>Rp <?= number_format($ttk) ?></td>
								  </tr>
								    </tbody>
								  </table>
								<div class="row">
									<div class="col-md-6">
								    
								  </div>
								  <div class="col-md-6">
								      <div class="panel panel-info">
								        <div class="panel-heading">
								          <h4>Payment</h4>
								        </div>
								        <div class="panel-body">
								           <table class="table table-condensed">
								            <tbody>
								              <tr>
								                <td>Total Pembelian</td>
								                <td>Rp <?= number_format($ttk) ?></td>
								              </tr>
								              <tr>
								                <td>Bayar</td>
								                <? 
								                $cari_bayar = $this->m_data->where('penjualan_barang',['kd_penjualan' => $liq->kd_penjualan])->row();
								                ?>
								                <td>Rp <?= number_format($cari_bayar->bayar) ?></td>
								              </tr>
								              <tr>
								                <td>Kekurangan Pembayaran</td>
								                <td>Rp <?= number_format($ttk - $cari_bayar->bayar) ?></td>
								              </tr>
								            </tbody>
								          </table>
								        </div>
								      </div>
								  </div>
								</div>

				      </div>
				      <div class="modal-footer">
				        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
				      </div>
				    </div>

				  </div>
				</div>
		<?php endforeach; else: ?>
							
								<?php endif; ?>
    	</div>
    	<div class="col-md-12"></div>
						    <div class="loading" style="display: none;"><div class="content"><img src="<?php echo base_url().'assets/img/lg.discuss-ellipsis-preloader.gif'; ?>"/></div>
						</div>
    </div>
   </section>
  </div>
</div>