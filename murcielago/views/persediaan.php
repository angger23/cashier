
<!-- /subnavbar -->
<div class="main">
  <div class="main-inner">
    <div class="container">
      <div class="row">
        <div class="span12">
          <div class="widget">
            
            <!-- /widget-header -->
            
              
            
                  <div class="widget-header">
                      <h3>
                
               Persediaan Barang
                      </h3></div>
                <div class="widget-content">
                    
          
                
                    <!-- .stat --> 
                    <table class="table data" id="example">
                        <thead>
                            <tr>
                                
                        <th>No</th>   
                        <th>Kode Barang</th>
                        <th>Nama Barang</th>
                        <th>Harga Pokok Per Barang</th>
                        <th>Stock Barang</th>
                        <th>Minimal Stock</th>
                        <th>Kadaluarsa</th>
                        <th></th>
                       
                            </tr>
                        </thead>
                        
                        
                        <tbody>
                        <?php $no=1; foreach($rec as $record ){  ?>
                            <tr <?php if($record['status_s'] == '1'){ echo'style="background:#ffa3a3;"'; }else{} ?> >
                                <td><?php echo $no; ?></td>
                        <td><?php echo $record['kode_barang']; ?></td>
                        <td><?php echo $record['nama_barang']; ?></td>
                        <td><?php echo $record['harga_pokok']; ?></td>
                        <td><?php echo $record['stock']; ?></td>
                        <td><?php echo $record['min_stock']; ?></td>
                                <td><?php if($record['expierd']=='0000-00-00'){ echo "Tidak kadaluarsa"; }else{ echo $record['expierd']; } ?></td>
                                <td><?php if($record['status_s'] == 1){ ?> 
                                    <form method="post" action="<?php echo base_url() ?>kasir/update_status32">
                                        <input type="hidden" name="kd_nota" value="<?php echo $record['kd_nota']; ?>">
                                        <button class="btn btn-primary" type="submit"><i class="fa fa-check"></i></button>
                                    </form> <?php }else{} ?><?php if($record['stock']<=2){ ?>
                                    <button type="button" class="btn btn-success btn-sm" data-toggle="modal" data-target="#myModalnya<?php echo $no; ?>"><i class="fa fa-plus"></i> Stock</button>
                                    <?php }else{} ?></td>
                            </tr>
                            
                            <?php $no++; } ?>
                        </tbody>
                    </table>
            <?php $no=1; foreach($rec as $record ){  ?>
                    <?php $data['cari_sup']=$this->m_data->cari_sup($record['kode_supplier'])->row(); ?>
                <?php $data['kas']  = $this->m_data->kas_sekarang()->row(); ?>
                <!-- Modal -->
<div id="myModalnya<?php echo $no; ?>" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Tambah Stok</h4>
      </div>
      <div class="modal-body">
        <div class="form-group">
            <form method="post" action="<?php echo base_url() ?>kasir/tambah_stock">
                <div class="form-group">
                    <label>Jumlah Stok yang dibeli</label>
                    <input type="text" name="stock" class="form-control">
                    <input type="hidden" name="stock2" class="form-control" value="<?php echo $record['stock']; ?>">
                    <input type="hidden" name="kd_nota" class="form-control" value="<?php echo $record['kd_nota'] ?>">
                    <input type="hidden" name="nm_barang" class="form-control" value="<?php echo $record['nama_barang'] ?>">
                    <input type="hidden" name="kd_barang" class="form-control" value="<?php echo $record['kode_barang'] ?>">
                    <input type="hidden" name="modal" class="form-control" value="<?php echo $data['kas']->modal_stikes ?>">
                </div>
                <div class="form-group">
                    <label>Beli Di supplier</label>
                    <input type="text" name="sup" class="form-control" value="<?php echo $data['cari_sup']->nama_supplier ?>" disabled>
                </div>
                <div class="form-group">
                    <label>Harga Beli Per 1 stok</label>
                    <input type="text" name="hrg_bel" class="form-control" value="Rp <?php echo number_format($record['harga_beli']); ?>" disabled>
                    <input type="hidden" name="hrg_bel1" class="form-control" value="<?php echo $record['harga_beli'] ?>">
                </div>
                <div class="form-group">
                    <button class="btn btn-primary" type="submit">Tambah Stock</button>
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
                    
            <?php $no++; } ?>
      
                </div>
                  </div>
  
</div>
            
          <!-- /widget -->
          
          <!-- /widget -->
          
          <!-- /widget --> 
        </div>
       
      </div>
      <!-- /row --> 
    </div>
    <!-- /container --> 
  </div>
  <!-- /main-inner --> 

<!-- /main -->
