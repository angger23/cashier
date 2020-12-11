
<div class="" style="margin-top:10px;padding:0px;">
    <div class="container">
    <div class="panel panel-default">
        <div class="panel-heading"><h5>Lihat Laporan Kas Masuk</h5></div>
        <div class="panel-body">
            <center>
            <form method="post" action="<?php echo base_url() ?>laporan/laporan_kas_masuk">
                <div class="form-group">
                    <label>Mulai Tanggal</label>
                    <input type="date" class="form-control" name="tgl1">
                </div>
                <div class="form-group">
                    <label>Sampai Tanggal</label>
                    <input type="date" class="form-control" name="tgl2">
                </div>
                <div class="form-group">
                    <button type="submit" class="btn btn-primary">Lihat</button>    
                </div>
            </form>
            </center>
            <?php if(!empty($this->input->post('tgl1'))){  ?>
               <?php $data['kas_masuk'] = $this->m_data->kas_masuk($this->input->post('tgl1'),$this->input->post('tgl2'))->result_array(); ?>
                       
                    <table class="table table-responsive" id="example">
                        <?php //if($no!=1){ ?>
                <?php //}else{ ?>
                        <thead>
                        <tr>    
                            <th>No</th>   
                            <th>Aksi</th>
                            <th>Tanggal Transaksi</th>
                            <th>Debet</th>
                        </tr>
                        </thead>
                        <?php //} ?>
                        <tbody>
                             <?php 
                            $no=0; foreach($data['kas_masuk'] as $record ){  
                            $no++;
                            ?>
                            <tr>
                        <td style="width:148px;"><?php echo $no; ?></td>
                        <td style="width:294px;"><button type="button" data-toggle="modal" href="#myModal<?php echo $no ?>" class="btn btn-primary">Lihat</button></td>
                        <td style="width:357px;"><?php echo date("d-m-Y", strtotime($record['tanggal_transaksi'])); ?></td>
                        <td>Rp <?php echo number_format($record['debet']); ?></td>
                            </tr>
                            <?php } ?>
                <?php //if($no!=1){ ?>
                <?php //}else{ ?>
                        </tbody>
                            
                    </table>
            <?php //} ?>
            <?php //if($no!=1){ ?>
                <?php //}else{ ?>
            <?php 
            $no=0; foreach($data['kas_masuk'] as $record ){  
            $no++;
            ?>
<div class="modal fade" id="myModal<?php echo $no ?>">
<div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
          <h3 class="modal-title">Lihat Detail</h3>
        </div>
        <div class="modal-body">
            <?php if(empty($record['kd_penjualan'])){ ?>
            <table class="table table-bordered">
            <tbody>
                <tr>
                    <td>Tambahan Dana Sebesar</td>
                    <td>Rp <?php echo number_format($record['debet']); ?></td>
                </tr>
                <tr>
                    <td>Pada tanggal</td>
                    <td><?php echo date("d-m-Y", strtotime($record['tanggal_transaksi'])); ?></td>
                </tr>
                <tr>
                    <td>Dengan Keterangan</td>
                <td><?php echo $record['keterangan']; ?></td>
                </tr>
            </tbody>
            </table>
            <?php }else{ ?>
            <table class="table table-responsive table-bordered" id="example">
                <thead>
                    <th>No</th>
                    <th>Kode Nota</th>
                    <th>Jumlah Beli</th>
                    <th>Tanggal Penjualan</th>
                    <th>Total</th>
                    <th>Nama Kasir</th>
                </thead>
                <tbody>
                    <?php 
                    $data['cek_penjualan'] =  $this->m_data->cek_penjualan2($record['kd_penjualan'])->result();          
                    $noz = 0; 
                    foreach($data['cek_penjualan'] as $ata){
                    $noz++;
                    ?>
                    <tr>
                        <?php 
                        $data['cek_penjualan3'] =  $this->m_data->cek_penjualan3($record['kd_penjualan'])->row();
                        ?>
                        <td><?php echo $noz; ?></td>
                        <td><?php echo $ata->kd_nota ?></td>
                        <td><?php echo $data['cek_penjualan3']->ttlx ?></td>
                        <td><?php echo date("d-m-Y", strtotime($ata->tanggal_penjualan)); ?></td>
                        <td>Rp <?php echo number_format($ata->total_harga); ?></td>
                        <td><?php echo $ata->nama_kasir ?></td>
                    </tr>
                    <?php } ?> 
                </tbody>
            </table>
            <?php } ?>
            
		</div>
        <div class="modal-footer">
            <button type="button" class="btn btn-default " data-dismiss="modal">Close</button>
        </div>
				
      </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
  </div>
            <script>
                            $(document).ready(function(){
                                $(".modal-backdrop").click(function(){
                                    $("#myModal<?php echo $no; ?>").hide();
                                });
                            });
                            </script>
            <?php } ?>
                <?php //} ?>
                            
            <!-- /.modal -->
                            
            <table class="table table-responsive">
             <tr>
                 <?php $data['totalnya'] = $this->m_data->sum_total_debet($this->input->post('tgl1'),$this->input->post('tgl2'))->row(); ?>
            <td style="width:148px;"></td>
            <td style="width:294px;"></td>
            <td style="width:357px;"><b>Total Debet</b></td>
            <td><b>Rp<?php echo number_format($data['totalnya'] -> debet); ?></b></td>
            </tr>
            </table>
                            
        </div>
        <div class="panel-footer">
        <a href="<?php echo base_url() ?>export_sys/export_kas_masuk/<?php echo $this->input->post('tgl1') ?>/<?php echo $this->input->post('tgl2') ?>" class="btn btn-success" style="margin-bottom:10px;">Export</a>
        <a href="<?php echo base_url() ?>laporan/print_kas_masuk/<?php echo $this->input->post('tgl1') ?>/<?php echo $this->input->post('tgl2') ?>" target="_blank" class="btn btn-success" style="margin-bottom:10px;"><i class="fa fa-print"></i> Print</a>
        </div>
        <?php }else{ ?>
                    
                    <?php } ?>
    </div>
    </div>
</div>


<!-- /main -->
