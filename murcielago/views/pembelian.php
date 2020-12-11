
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
                <button class="btn btn-info btn-lg" data-toggle="modal" data-target="#myModal" type="button">
                Tambah Barang</button> 
                      </h3></div>
                <div class="widget-content">
                    
          
                
                    <!-- .stat --> 
                    <table class="table data" id="example">
                        <thead>
                            <tr>
                                
                        <th>No</th>
                        <th>Tanggal Expied</th>
                        <th>Nama Supplier</th>
                        <th>Kode Barang</th>
                        <th>Nama Barang</th>
                        <th>Satuan Barang</th>
                        <th>Harga Pokok Per Barang</th>
                        <th>Stock Barang</th>
                        <th>Total Harga Pembelian</th>
                        <th>Status</th>
                        <th>Opsi</th>
                            </tr>
                        </thead>
                        
                        
                        <tbody>
                        <?php $data['pembelian2'] = $this->m_data->daf_pembelian2()->result_array(); ?>
                        <?php $no=1; foreach($data['pembelian2'] as $record ){  ?>
                            <tr>
                                <td><?php echo $no; ?></td>
                        <td>
                            <?php 
if($record['tanggal_pembelian']=="0000-00-00"){ echo "Tidak Ada Kadaluarsa"; 
                                       }else{
    echo date("d-m-Y",strtotime($record['tanggal_pembelian'])); } ?></td>
                        <td><?php echo $record['nama_supplier'] ?></td>
                        <td><?php echo $record['kode_barang'] ?></td>
                        <td><?php echo $record['nama_barang'] ?></td>
                        <td><?php echo $record['satuan_barang'] ?></td>
                        <td>Rp <?php echo number_format($record['harga_pokok']); ?></td>
                        <td><?php echo $record['stock'] ?></td>
                        <td>Rp <?php echo number_format($record['total_harga']); ?></td>
                                <?php if($this->ion_auth->group(2)){ ?>
                                
                                <?php }else{ ?>
                        <td><?php if($record['status']=='lunas'){
                                    echo $record['status'];
                                    }else{ ?>
                        <button type="button" data-toggle="modal" data-target="#edit<?php echo $no; ?>" > Kredit</button>
                            
                            
                            <div class="modal fade" id="edit<?php echo $no; ?>" role="dialog">
    <div class="modal-dialog" >
    
      <!-- Modal content-->
      <div class="modal-content" >
        <div class="modal-header" style="background: #2ecc71;">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title" style="color:#fff;" >Data Kredit <?php echo $record['nama_barang'] ?> </h4>
        </div>
        <div class="modal-body"> 
        <!-- /control-group -->
										
								<table class="table table-striped">
                        <thead>
                            <tr>
                                 <th>Tanggal Pembelian</th>
                                 <th>Tanggal Pelunasan</th>
                                 <th>Sudah Dibayar</th>
                                 <th>Total Harga</th>
                                 <th>Kekurangan</th>
                                 <th>opsi</th>
                            </tr>
                                    </thead>
                                    <tbody>
                                     <td><?php echo date("d-m-Y",strtotime($record['tanggal_pembelian'])) ?></td>
                       
                                  <td><?php echo date("d-m-Y",strtotime($record['tanggal_pelunasan'])) ?></td>
                       
                                  <td><?php echo $record['bayar'] ?></td>
                                  <td>Rp <?php echo number_format($record['total_harga']); ?></td>
                                 <td><?php echo $record['hutang'] ?></td>
                                 <td><button type="button" data-toggle="modal" data-target="#edit<?php echo $no; ?>" > Bayar</button></td>
                                    </tbody>
            </table>
				
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        </div>
      </div>
      
    </div>
  </div>
             
                            <?php  }  ?></td> <?php } ?>
                                
                                <td> <button type="button" class="btn btn-default" data-toggle="modal" data-target="#editbaru<?php echo $no; ?>" ><i class="fa fa-pencil"  ></i></button>
                            
                               <a href="<?php echo base_url() ?>pembelian/hapus_pembelian/<?php echo $record['kd_pembelian'] ?>"> <button type="button" class="btn btn-default"><i class="fa fa-trash"  ></i></button>
                                    </a>
                                </td>
                            </tr>          
                            <?php $no++; } ?>
                        </tbody>
                    </table>
                    <a href="<?php echo base_url() ?>export_sys/export_pembelian" class="btn btn-success" type="button">Export</a>
                    <a href="<?php echo base_url() ?>import/upload_pem" class="btn btn-success">Import</a>
                    <br>
                    <br>
                    <?php $no=1; foreach($data['pembelian2'] as $record){ ?>
                        <!-- Modal -->
  <div class="modal fade" id="editbaru<?php echo $no ?>" role="dialog">
    <div class="modal-dialog">
    
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Edit Barang <?php echo $record['nama_barang']; ?></h4>
        </div>
        <div class="modal-body">
          <div class="form-group">
            <form method="post" action="<?php echo base_url() ?>/pembelian/update_pembelian">
                <div class="form-group">
                    <label>Kode Barang</label>
                    <input type="text" name="kd_barang" class="form-control" value="<?php echo $record['kode_barang'] ?>" disabled>
                </div>
                <div class="form-group">
                    <label>Nama Barang</label>
                    <input type="text" name="nama_barang" class="form-control" value="<?php echo $record['nama_barang'] ?>">
                </div>
                <div class="form-group">
                    <label>Jenis Barang</label>
                    <input type="text" name="satuan_barang" class="form-control" value="<?php echo $record['satuan_barang'] ?>">
                </div>
                <div class="form-group">
                    <label>Harga Pokok Barang</label>
                    <input type="text" name="harga_pokok" class="form-control" value="<?php echo $record['harga_pokok'] ?>">
                </div>
                <div class="form-group">
                    <label>Stok Barang</label>
                    <input type="text" name="stock1" class="form-control" value="<?php echo $record['stock'] ?>" disabled>
                    <input type="hidden" name="stock" class="form-control" value="<?php echo $record['stock'] ?>">
                </div>
                <div class="form-group">
                    <label>Min Stock</label>
                    <input type="text" name="min_stok" class="form-control" value="<?php echo $record['min_stock'] ?>">
                </div>
                <div class="form-group">
                    <label>Diskon Barang</label>
                    <input type="text" name="diskon" class="form-control" value="<?php echo $record['diskon'] ?>">
                </div>
                <div class="form-group">
                    <label>Max Diskon Pembelian</label>
                    <input type="text" name="kelipatan" class="form-control" value="<?php echo $record['kelipatan'] ?>">
                </div>
                <input type="hidden" name="kd_barang" value="<?php echo $record['kode_barang']; ?>">
                <input type="hidden" name="kd_persediaan" value="<?php echo $record['kd_nota']; ?>">
                <input type="hidden" name="kd_pembelian" value="<?php echo $record['kd_pembelian']; ?>">
                <input type="hidden" name="nama_pembeli" value="<?php echo $record['nama_pembeli_barang']; ?>">
                <div class="form-group">
                    <label>Harga Beli Barang</label>
                    <input type="text" name="hrg_bel" class="form-control" value="Rp <?php echo number_format($record['harga_beli']); ?>" disabled>
                    <input type="hidden" name="harga_beli" class="form-control" value="<?php echo $record['harga_beli'] ?>">
                </div>
                <div class="form-group">
                    <button class="btn btn-primary" type="submit">Update</button>
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
                <!-- /widget-content --> 
             <!--   Modal  -->
              <div class="modal fade" id="myModal" role="dialog" style="">
    <div class="modal-dialog modal-lg" style="">
    
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header" style="background: #2ecc71;">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title" style="color:#fff;" >Tambah Barang</h4>
        </div>
        <div class="modal-body">
            <div class="form-group">
                <form method="post" action="<?= base_url('pembelian/simpan_pembelian'); ?>">
                    <div class="row">
                        <div class="col-md-6 col-sm-6">
                            <div class="form-group">
                                <label>Kode Barang</label>
                                <input type="text" name="kd_barang" class="form-control">
                            </div>
                            <div class="form-group">
                                <label>Nama Barang</label>
                                <input type="text" class="form-control" id="" name="nama_barang">
                                <input type="hidden" class="form-control" name="nama_pembeli" value="<?= $user_ion->first_name ?>">
                            </div>
                            <div class="form-group">
                                <label>Jenis Barang</label>
                                <select name="jenis_barang" class="form-control selectku" style="width: 100%;">
                                    <option value="ATK">ATK</option>
                                    <option value="Makanan">Makanan</option>
                                    <option value="Minuman">Minuman</option>
                                    <option value="Baju/Kain">Baju/Kain</option>
                                    <option value="Sepatu">Sepatu</option>
                                    <option value="Tas">Tas</option>
                                    <option value="Topi">Topi</option>
                                    <option value="Logo">Logo</option>
                                    <option value="Perlengkapan Rumah Tangga">Perlengkapan Rumah Tangga</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label class="control-label" for="firstname">Kategori</label>
                                <select id="select1" name="kategori" class="form-control" style="width: 100%;">
                                    <option value="Barang Toko">Barang Toko</option>
                                    <option value="Barang Konsinyasi">Barang Konsinyasi</option>
                                    <option value="Jasa Fotokopi Print">Jasa Fotokopi Print</option>
                                    <option value="Jasa Penjilidan">Jasa Penjilidan</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label class="control-label" for="firstname">Satuan Barang</label>
                                <select id="select2" class="form-control" name="Satuan" style="width: 100%;">
                                    <option value="Buah">Buah</option>
                                    <option value="Lembar">Lembar</option>
                                    <option value="Rim">Rim</option>
                                    <option value="Box">Box</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label class="control-label" for="firstname">Harga Pembelian</label>
                                <input type="text" class="form-control" id="" name="harga_pembelian">
                            </div>
                            <div class="form-group">
                                <label class="control-label" for="firstname">Harga Jual</label>
                                <input type="text" class="form-control" id="" name="harga_jual">
                            </div>
                        </div>
                        <div class="col-md-6 col-sm-6">
                            <div class="form-group">
                                <label class="control-label" for="firstname">Stock / Jumlah</label>
                                <input type="number" class="form-control" id="" name="stock">
                            </div>
                            <div class="form-group">
                                <label class="control-label" for="firstname">Nama Supplier</label>
                                <select id="select3" name="supplier" style="width: 100%;">
                                    <?php foreach($supplier as $record ){ ?>
                                    <option value="<?= $record['kd_supplier'] ?>" >
                                    <?= $record['nama_supplier']; ?>
                                    </option>
                                    <?php } ?>
                                </select>
                            </div>
                            <div class="form-group">
                                <label class="control-label" for="firstname">Tanggal Expired</label>
                                <input type="date" class="form-control" id="tanggal_beli" name="tanggal_expired">
                                <input type="checkbox" class="control-group" id="tanggal_beli" name="exp" >
                            </div>
                            <div class="form-group">
                                <label class="control-label" for="firstname">Lokasi</label>
                                <input type="text" class="form-control" id="" name="lokasi">
                            </div>
                            <div class="form-group">
                                <label class="control-label" for="firstname">Masukan kelipatan Diskon setiap pembelian barang </label>
                                <input class="span1 m-wrap" id="appendedInputButton"  style="margin-top:10px" type="number" name="kelipatan" value="0"> 
                                 &nbsp; = &nbsp;
                                <input class="span1 m-wrap" id="appendedInputButton"  style="margin-top:10px" type="text" name="diskon" value="0"> <button class="btn" type="button">%</button> 
                            </div>
                            <div class="form-group">
                                <label>Status Pembelian</label>
                                <br>
                                <label class="radio-inline"><input type="radio" id="show" name="optradio" value="Lunas">Lunas</label>
                                <label class="radio-inline"><input type="radio" id="hide" name="optradio" value="Kredit">Kredit</label>
                            </div>
                            <div class="form-group" id="formz">
                                <label>Jatuh Tempo Kredit</label>
                                <input type="date" class="form-control" id="tanggal_beli" name="tgl_tempo">
                            </div>
                            <script type="text/javascript">
                                $("#formz").hide();
                                $("#hide").click(function(){
                                    $("#formz").toggle();
                                });
                                $("#show").click(function(){
                                    $("#formz").hide();
                                });
                            </script>
                        </div>
                           <div class="col-md-12">
                                <div class="form-group">
                                    <button class="btn btn-primary btn-block" type="submit">Simpan</button>
                                </div>
                           </div>
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
