<div class="" style="margin-top:10px;">
    <div class="container">
<div class="panel panel-default">
    <div class="panel-heading"><h5 style="padding:0;">Lihat Laporan Penjualan</h5></div>
    <div class="panel-body">
        <form method="post" action="<?php echo base_url() ?>laporan/laporan_rekap_kas">
            <div class="form-group">
                <label>Dari Tanggal</label>
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
        <?php if(!empty($this->input->post('tgl1'))){  ?>
        
        <table class="table data" id="example">
             <?php //if($no!=1){ ?>
                <?php //}else{ ?>
                        <thead>
                            <tr>
                                
                        <th>No</th>   
                        <th>Tanggal Transaksi</th>
                        <th>Debet</th>
                        <th>Kredit</th>
<!--                        <th>Aksi</th>-->
                            </tr>
                        </thead>
                        <?php //} ?>
                        
                        <tbody>
                            <?php $data['antara'] = $this->m_data->antara_tgl_rekap($this->input->post('tgl1'),$this->input->post('tgl2'))->result_array(); ?>
                        <?php $no=1; foreach($data['antara'] as $record ){  ?>
                            <tr>
                        <td style="width:148px;"><?php echo $no; ?></td>
                        <td style="width:294px;"><?php echo date("d-m-Y", strtotime($record['tanggal_transaksi'])); ?></td>
                        <td style="width:357px;"><?php if($record['debet'] == ''){echo'-';}else{ echo 'Rp '; echo number_format($record['debet']); } ?></td>
                        <td style="width:357px;"><?php if($record['kredit'] == ''){echo'-';}else{ echo 'Rp '; echo number_format($record['kredit']); } ?></td>
<!--                                <td><button type="button" data-toggle="modal" data-target="#myModal<?php //echo $no ?>" class="btn btn-primary">Lihat</button></td>-->
                                <!-- Modal -->
                            </tr>
                            <?php $no++; } ?>
                            
                        </tbody>
                            
                    </table>
        <table class="table">
                            <tr>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td><b>Total Debet</b></td>
                                <?php 
                                    $data['sum_debet'] = $this->m_data->sum_rekap_debet($this->input->post('tgl1'),$this->input->post('tgl2'))->row();
                                    $data['sum_kredit'] = $this->m_data->sum_rekap_kredit($this->input->post('tgl1'),$this->input->post('tgl2'))->row();
                                    $debet = $data['sum_debet']->debet;
                                    $kredit = $data['sum_kredit']->kredit;
                                
                                    $totalnya = $debet-$kredit;
                                ?>
                                <td><b>Rp <?php echo number_format($debet); ?></b></td>
                            </tr>
                                      <tr>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td><b>Total Kredit</b></td>
                                <td><b>Rp <?php echo number_format($kredit); ?></b></td>
                            </tr>
            </tr>
                                       <tr>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td><b>Total Rekap Kas</b></td>
                                <td><b>Rp <?php echo number_format($totalnya); ?></b></td>
                            </tr>
        </table>
        
    </div>
    <div class="panel-footer">
<!--        <h3><a href="<?php //echo base_url() ?>export_data_penjualan/export/<?php //echo $this->input->post('tgl1') ?>/<?php //echo $this->input->post('tgl2') ?>" class="btn btn-success" style="margin-bottom:10px;">Export</a></h3>-->
        <h3><a href="<?php echo base_url() ?>laporan/print_rekap/<?php echo $this->input->post('tgl1') ?>/<?php echo $this->input->post('tgl2') ?>" target="_blank" class="btn btn-success" style="margin-bottom:10px;"><i class="fa fa-print"></i> Print</a></h3>
    </div>
    <?php }else{ ?>
                    
                    <?php } ?>
</div>
    </div>
</div>
  <!-- /main-inner --> 

<!-- /main -->
