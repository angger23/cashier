
<div class="" style="margin-top:10px;padding:0px;">
    <div class="container">
    <div class="panel panel-default">
        <div class="panel-heading"><h5>Lihat Laporan Barang Masuk Keluar</h5></div>
        <div class="panel-body">
<!--
            <center>
            <form method="post" action="<?php //echo base_url() ?>laporan/laporan_in_out">
                <div class="form-group">
                    <label>Mulai Tanggal</label>
                    <input type="date" class="form-control" name="tgl1">
                </div>
                <div class="form-group">
                    <button type="submit" class="btn btn-primary">Lihat</button>    
                </div>
            </form>
            </center>
-->
               <?php $data['lapor_in_out'] = $this->m_data->lapor_in_out()->result_array(); ?>
                    <table class="table table-responsive" id="example">
                        <?php //if($no!=1){ ?>
                <?php //}else{ ?>
                        <thead>
                        <tr>    
                            <th>No</th>   
                            <th>Nama Barang</th>
                            <th>Kode Barang</th>
                            <th>Tanggal Dibeli</th>
                            <th>Aksi</th>
                        </tr>
                        </thead>
                        <?php //} ?>
                        <tbody>
                            <?php 
                            $no=0; foreach($data['lapor_in_out'] as $record ){  
                            $no++;
                            ?>
                            <tr>
                        <td><?php echo $no; ?></td>
                        <td><?php echo $record['nama_barang']; ?></td>
                        <td><?php echo $record['kode_barang']; ?></td>
                        <td><?php echo date("d-m-Y", strtotime($record['tanggal_pembelian'])); ?></td>
                        <td><button class="btn btn-success" type="button" data-toggle="modal" data-target="#myModalbeli<?php echo $record['kode_barang'] ?>">Cek Pembelian Barang Ini</button> <button class="btn btn-info" type="button" data-toggle="modal" data-target="#myModaljual<?php echo $record['kode_barang']; ?>">Cek Penjualan Barang ini</button></td>
                            </tr>
                            <?php } ?>   
                        </tbody>      
                    </table>
    <!--// Untuk Modal Pembelian // -->
                <?php 
//            $jjl = $data['lapor_in_out2'] = $this->m_data->lapor_in_out()->num_rows();
//           for($i=1;$i<=$jjl;$i++){
//               echo $i;
//           }
//            echo '<br>';
                $no=0;
                foreach($data['lapor_in_out'] as $dat){
                $no++;
                    //echo $no;
                ?>
            <!-- Modal -->
<div id="myModalbeli<?php echo $dat['kode_barang']; ?>" class="modal fade" role="dialog">
  <div class="modal-dialog modal-lg">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Pembelian Barang <?php echo $dat['nama_barang']; ?></h4>
      </div>
      <div class="modal-body">
          <table class="table table-responsive">
             <thead>
                        <tr>    
                            <th>No</th>   
                            <th>Tanggal Pembelian</th>
                            <th>Kode Barang</th>
                            <th>Nama Barang</th>
                            <th>Nama Supplier</th>
                            <th>Jenis Barang</th>
                            <th>Harga Pokok</th>
                            <th>Jumlah Beli</th>
                            <th>Total Harga</th>
                        </tr>
                        </thead>
                        <?php //} ?>
                        <tbody>
                            <?php 
                    $data['lap_pembelian'] = $this->m_data->laporan_pembelian2($dat['kode_barang'])->result_array();
                            $no=0; foreach($data['lap_pembelian'] as $record ){  
                            $no++;
                            ?>
                            <tr>
                        <td><?php echo $no; ?></td>
                        <td><?php echo date("d-m-Y", strtotime($record['tanggal_pembelian'])); ?></td>
                        <td><?php echo $record['kode_barang']; ?></td>
                        <td><?php echo $record['nama_barang'] ?></td>
                        <td><?php echo $record['nama_supplier'] ?></td>
                        <td><?php echo $record['satuan_barang'] ?></td>
                        <td>Rp <?php echo number_format($record['harga_pokok']); ?></td>
                        <td><?php echo $record['jumlah_beli'] ?></td>
                        <td>Rp <?php echo number_format($record['total_harga']); ?></td>
                            </tr>
                <?php //if($no!=1){ ?>
                <?php //}else{ ?>
                            <?php } ?>
                            
                        </tbody>
          </table>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>

  </div>
</div>
                <?php } ?>
    <!--// Untuk Modal Pembelian // -->
            
    <!--// Untuk Modal Penjualan // -->
            <?php 
                $no=0;
                foreach($data['lapor_in_out'] as $xat){
                $no++;
                    //echo $no;
                    
                ?>
            <!-- Modal -->
<div id="myModaljual<?php echo $xat['kode_barang']; ?>" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Penjualan Barang <?php echo $xat['nama_barang']; ?></h4>
      </div>
      <div class="modal-body">
        <table class="table table-responsive">
                        <?php //if($no!=1){ ?>
                <?php //}else{ ?>
                        <thead>
                        <tr>    
                            <th>No</th>   
                            <th>Nama Pembeli</th>
                            <th>Tanggal Penjualan</th>
                            <th>Jumlah Beli</th>
                            <th>Kode Barang</th>
                            <th>Nama Barang Yang Di beli</th>
                            <th>Diskon</th>
                            <th>Harga</th>
                        </tr>
                        </thead>
                        <?php //} ?>
                        <tbody>
                            <?php
                    $data['laporan_penjualan'] = $this->m_data->laporan_penjualan2($xat['kode_barang'])->result_array();
                            $no=0; foreach($data['laporan_penjualan'] as $record ){  
                            $no++;
                            ?>
                            <tr>
                        <td><?php echo $no; ?></td>
                        <td><?php echo $record['nama_pembeli']; ?></td>
                        <td><?php echo date("d-m-Y", strtotime($record['tanggal_penjualan'])); ?></td>
                        <td><?php echo $record['satuan'] ?></td>
                        <td><?php echo $record['kode_barang'] ?></td>
                        <td><?php echo $record['nama_barang']; ?></td>
                            <td><?php if($record['satuan']>$record['kelipatan']){ echo $record['diskon'];}else{
                                
                                echo "0";
                            } ?>% </td>
                                <?php 
                                $sub =  $record['harga_pokok'] * $record['satuan'] ;
                        if($record['satuan']>$record['kelipatan']){ 
                            $dis =  ( $sub * $record['diskon']) / 100;
                            $harga = $sub - $dis;
                        }else{
                             $harga = $sub;
                            }
                            
                                //echo number_format($harga);
                                ?>
                        <td>Rp <?php echo number_format($harga); ?></td>
                            </tr>
                <?php //if($no!=1){ ?>
                <?php //}else{ ?>
                            <?php } ?>
                            
                        </tbody>
                            
                    </table>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>

  </div>
</div>
                <?php } ?>
    <!--// Untuk Modal Penjualan // -->
                            
        </div>
<!--
        <div class="panel-footer">
        <a href="<?php //echo base_url() ?>export_sys/export_barang_masuk/<?php //echo $this->input->post('tgl1') ?>" class="btn btn-success" style="margin-bottom:10px;">Export</a>
        <a href="<?php //echo base_url() ?>laporan/print_kas_masuk/<?php //echo $this->input->post('tgl1') ?>" target="_blank" class="btn btn-success" style="margin-bottom:10px;"><i class="fa fa-print"></i> Print</a>
        </div>
-->
        
    </div>
    </div>
</div>


<!-- /main -->
