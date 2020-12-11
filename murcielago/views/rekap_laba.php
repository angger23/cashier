<!-- Load chart dengan menggunakan ID -->
    <script type="text/javascript">
    //2)script untuk membuat grafik, perhatikan setiap komentar agar paham
$(function () {
    var chart;
    $(document).ready(function() {
        chart = new Highcharts.Chart({
            chart: {
                renderTo: 'container', //letakan grafik di div id container
        //Type grafik, anda bisa ganti menjadi area,bar,column dan bar
                type: 'line',  
                marginRight: 130,
                marginBottom: 25
            },
            title: {
                text: 'Grafik Laba',
                x: -20 //center
            },
//            subtitle: {
//                text: 'candra.web.id',
//                x: -20
//            },
            xAxis: { //X axis menampilkan data tahun 
            <?php $data['bulan'] = $this->m_data->rekap_bulan_penjualan()->result_array(); ?>
                categories: [<?php foreach($data['bulan'] as $record){ ?>
                    <?php  if($record['bulan_beli'] == '01'){
                        echo "'Januari',";
                        }elseif($record['bulan_beli'] == '02'){
                        echo "'Februari',";    
                        }elseif($record['bulan_beli'] == '03'){
                          echo "'Maret',";     
                        }elseif($record['bulan_beli'] == '04'){
                        echo "'April',";   
                        }elseif($record['bulan_beli'] == '05'){
                        echo "'Mei',";   
                        }elseif($record['bulan_beli'] == '06'){
                        echo "'Juni',";   
                        }elseif($record['bulan_beli'] == '07'){
                        echo "'Juli',";   
                        }elseif($record['bulan_beli'] == '08'){
                        echo "'Agustus',";   
                        }elseif($record['bulan_beli'] == '09'){
                        echo "'September',";   
                        }elseif($record['bulan_beli'] == '10'){
                        echo "'Oktober',";   
                        }elseif($record['bulan_beli'] == '11'){
                        echo "'November',";   
                        }else{
                        echo "'Desember'";   
                        } ?>
                    <?php } ?>
                ]
            },
            yAxis: {
                title: {  //label yAxis
                    text: 'pendapatan dalam IDR'
                },
                plotLines: [{
                    value: 0,
                    width: 1,
                    color: '#808080' //warna dari grafik line
                }]
            },
            tooltip: { 
      //fungsi tooltip, ini opsional, kegunaan dari fungsi ini 
      //akan menampikan data di titik tertentu di grafik saat mouseover
                formatter: function() {
                        return '<b>'+ this.series.name +'</b><br/>'+
                        this.x +': '+ this.y ;
                }
            },
            legend: {
                layout: 'vertical',
                align: 'right',
                verticalAlign: 'top',
                x: -10,
                y: 100,
                borderWidth: 0
            },
      //series adalah data yang akan dibuatkan grafiknya,
      //saat ini mungkin anda heran, buat apa label indonesia dikanan 
      //grafik, namun fungsi label ini sangat bermanfaat jika
      //kita menggambarkan dua atau lebih grafik dalam satu chart,
      //hah, emang bisa? ya jelas bisa dong, lihat tutorial selanjutnya 
            series: [{  
                name: 'Laba',  
        //data yang akan ditampilkan 
                <?php $data['bulan2'] = $this->m_data->rekap_bulan_penjualan1($this->input->post('bulan'),$this->input->post('bulan1'),$this->input->post('thn1'))->result_array(); ?>
                data: [<?php 
                    foreach($data['bulan2'] as $record){
        $data['total_harga'] = $this->m_data->rekap_sum_penjualan($record['bulan_beli'],$this->input->post('thn1'))->row();
        $data['total_harga1'] = $this->m_data->rekap_sum_pembelian($record['bulan_beli'],$this->input->post('thn1'))->row();
        $hg1= $data['total_harga']->total_harga;
        $hg2= $data['total_harga1']->total_harga;
        $laba = $hg1-$hg2;
                    echo $laba.",";
                    }
                    ?>
                    ]
            }]
        });
    });
     
});
    </script>
<div class="" style="margin-top:10px;">
    <div class="container">
<div class="panel panel-default">
    <div class="panel-heading"><h5 style="padding:0;">LABA</h5></div>
    <div class="panel-body">
        <?php 
//            $data['bulan33'] = $this->m_data->rekap_bulan_penjualan1('07','11','2017')->result_array();
//            foreach($data['bulan33'] as $record){
//                $data['total_harga'] = $this->m_data->rekap_sum_penjualan($record['bulan_beli'],'2017')->row();
//        $data['total_harga1'] = $this->m_data->rekap_sum_pembelian($record['bulan_beli'],'2017')->row();
//        $hg1= $data['total_harga']->total_harga;
//        $hg2= $data['total_harga1']->total_harga;
//        echo $laba = $hg1-$hg2;
//            }
//        
        ?>
<!--        <div class="row">-->
        <div class="col-md-4">
            <form method="post" action="<?php echo base_url() ?>kasir/rekap_laba_perbulan/bln">
            <div class="form-group">
              <label for="sel1">Dari Bulan :</label>
              <select class="form-control" id="select1" name="bulan">
                  <?php 
//                    $data['bulan'] = $this->m_data->rekap_bulan_penjualan()->result();
//                  
//                    foreach($data['bulan'] as $dat){
//                        echo $dat->bulan_beli;
//                        
//                    }
                    $data['bulan'] = $this->m_data->rekap_bulan_penjualan()->result_array();
                  
                    foreach($data['bulan'] as $record){
                        
                  ?>
                <option value="<?php if($record['bulan_beli'] == '01'){
                        echo "01";
                        }elseif($record['bulan_beli'] == '02'){
                        echo "02";    
                        }elseif($record['bulan_beli'] == '03'){
                          echo "03";     
                        }elseif($record['bulan_beli'] == '04'){
                        echo "04";   
                        }elseif($record['bulan_beli'] == '05'){
                        echo "05";   
                        }elseif($record['bulan_beli'] == '06'){
                        echo "06";   
                        }elseif($record['bulan_beli'] == '07'){
                        echo "07";   
                        }elseif($record['bulan_beli'] == '08'){
                        echo "08";   
                        }elseif($record['bulan_beli'] == '09'){
                        echo "09";   
                        }elseif($record['bulan_beli'] == '10'){
                        echo "10";   
                        }elseif($record['bulan_beli'] == '11'){
                        echo "11";   
                        }else{
                        echo "12";   
                        } ?>"><?php  if($record['bulan_beli'] == '01'){
                        echo "Januari";
                        }elseif($record['bulan_beli'] == '02'){
                        echo "Februari";    
                        }elseif($record['bulan_beli'] == '03'){
                          echo "Maret";     
                        }elseif($record['bulan_beli'] == '04'){
                        echo "April";   
                        }elseif($record['bulan_beli'] == '05'){
                        echo "Mei";   
                        }elseif($record['bulan_beli'] == '06'){
                        echo "Juni";   
                        }elseif($record['bulan_beli'] == '07'){
                        echo "Juli";   
                        }elseif($record['bulan_beli'] == '08'){
                        echo "Agustus";   
                        }elseif($record['bulan_beli'] == '09'){
                        echo "September";   
                        }elseif($record['bulan_beli'] == '10'){
                        echo "Oktober";   
                        }elseif($record['bulan_beli'] == '11'){
                        echo "November";   
                        }else{
                        echo "Desember";   
                        } ?></option>
                  <?php 
                    
                    } ?>
              </select>
            </div>
                <div class="form-group">
              <label for="sel1">Sampai Bulan :</label>
              <select class="form-control" id="select2" name="bulan1">
                  <?php 
//                    $data['bulan'] = $this->m_data->rekap_bulan_penjualan()->result();
//                  
//                    foreach($data['bulan'] as $dat){
//                        echo $dat->bulan_beli;
//                        
//                    }
                    $data['bulan'] = $this->m_data->rekap_bulan_penjualan()->result_array();
                  
                    foreach($data['bulan'] as $record){
                        
                  ?>
                <option value="<?php if($record['bulan_beli'] == '01'){
                        echo "01";
                        }elseif($record['bulan_beli'] == '02'){
                        echo "02";    
                        }elseif($record['bulan_beli'] == '03'){
                          echo "03";     
                        }elseif($record['bulan_beli'] == '04'){
                        echo "04";   
                        }elseif($record['bulan_beli'] == '05'){
                        echo "05";   
                        }elseif($record['bulan_beli'] == '06'){
                        echo "06";   
                        }elseif($record['bulan_beli'] == '07'){
                        echo "07";   
                        }elseif($record['bulan_beli'] == '08'){
                        echo "08";   
                        }elseif($record['bulan_beli'] == '09'){
                        echo "09";   
                        }elseif($record['bulan_beli'] == '10'){
                        echo "10";   
                        }elseif($record['bulan_beli'] == '11'){
                        echo "11";   
                        }else{
                        echo "12";   
                        } ?>"><?php  if($record['bulan_beli'] == '01'){
                        echo "Januari";
                        }elseif($record['bulan_beli'] == '02'){
                        echo "Februari";    
                        }elseif($record['bulan_beli'] == '03'){
                          echo "Maret";     
                        }elseif($record['bulan_beli'] == '04'){
                        echo "April";   
                        }elseif($record['bulan_beli'] == '05'){
                        echo "Mei";   
                        }elseif($record['bulan_beli'] == '06'){
                        echo "Juni";   
                        }elseif($record['bulan_beli'] == '07'){
                        echo "Juli";   
                        }elseif($record['bulan_beli'] == '08'){
                        echo "Agustus";   
                        }elseif($record['bulan_beli'] == '09'){
                        echo "September";   
                        }elseif($record['bulan_beli'] == '10'){
                        echo "Oktober";   
                        }elseif($record['bulan_beli'] == '11'){
                        echo "November";   
                        }else{
                        echo "Desember";   
                        } ?></option>
                  <?php 
                    
                    } ?>
              </select>
            </div>
                <div class="form-group">
                    <label>Mulai Tahun</label>
                    <select class="form-control" id="select3" name="thn1">
                    <option value="">Pilih Tahun</option>
                      <?php for($i=2035;$i>2000;$i--){ ?>
                    <option value="<?php echo $i ?>"><?php echo $i ?></option>
                      <?php } ?>
                  </select>
                </div>
            <div class="form-group">
                <button type="submit" name="lihat" class="btn btn-primary">Lihat</button>    
            </div>
        </form>
        </div>
        <?php
        $data['bulan1'] = $this->m_data->rekap_bulan_penjualan()->row();
        if($this->uri->segment(3) == 'bln'){  ?>
        
        <div class="col-md-8">
<!--            <div class="row">-->
            <table class="table data">
                        <thead>
                            <tr>                          
                              <th>No</th>   
                              <th>Bulan</th>
                              <th>Total Pembelian</th>
                              <th>Hasil  Penjualan</th>
                              <th>Laba Penjualan</th>
                                <th>Keterangan</th>
                            </tr>
                        </thead>              
                        <tbody>
                        <?php
                          $no = 1;
                          $data['bulan'] = $this->m_data->rekap_bulan_penjualan1($this->input->post('bulan'),$this->input->post('bulan1'),$this->input->post('thn1'))->result_array();
                          foreach ($data['bulan'] as $record ) {
                              $data['total_harga'] = $this->m_data->rekap_sum_penjualan($record['bulan_beli'],$this->input->post('thn1'))->row();
                              $data['total_harga1'] = $this->m_data->rekap_sum_pembelian($record['bulan_beli'],$this->input->post('thn1'))->row();
                        ?>
                            <tr>
                              <td><?php echo $no++ ?></td>
                              <td><?php  if($record['bulan_beli'] == '01'){
                        echo "Januari";
                        }elseif($record['bulan_beli'] == '02'){
                        echo "Februari";    
                        }elseif($record['bulan_beli'] == '03'){
                          echo "Maret";     
                        }elseif($record['bulan_beli'] == '04'){
                        echo "April";   
                        }elseif($record['bulan_beli'] == '05'){
                        echo "Mei";   
                        }elseif($record['bulan_beli'] == '06'){
                        echo "Juni";   
                        }elseif($record['bulan_beli'] == '07'){
                        echo "Juli";   
                        }elseif($record['bulan_beli'] == '08'){
                        echo "Agustus";   
                        }elseif($record['bulan_beli'] == '09'){
                        echo "September";   
                        }elseif($record['bulan_beli'] == '10'){
                        echo "Oktober";   
                        }elseif($record['bulan_beli'] == '11'){
                        echo "November";   
                        }else{
                        echo "Desember";   
                        } ?></td>
                              <?php //if($record['bulan'] == $record2['tanggal_pembelian']){?>
                              <td><?php echo 'Rp ' .number_format($data['total_harga1']->total_harga); ?></td>
                              <td><?php echo 'Rp ' .number_format($data['total_harga']->total_harga); ?></td>
                                <?php $laba = $data['total_harga']->total_harga - $data['total_harga1']->total_harga ?>
                              <?php //}else{}?>
                              <td><?php echo 'Rp ' .number_format($laba) ?></td>
                            <td><?php if($laba<=0){echo 'Rugi';}else{echo 'Untung';} ?></td>
                            </tr>
<!--
                            <tr>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            </tr>
-->
                            <?php }  ?>
                        </tbody>
                            
                    </table>
<!--            </div>-->
        </div>
<!--        </div>-->
        <div class="row">
                <div id="container">
                    
                </div>
            </div>
    </div>
    <div class="panel-footer">
<!--        <h3><a href="<?php //echo base_url() ?>export_data_penjualan/export/<?php //echo $this->input->post('tgl1') ?>/<?php //echo $this->input->post('tgl2') ?>" class="btn btn-success" style="margin-bottom:10px;">Export</a></h3>-->
<!--        <h3><a href="<?php echo base_url() ?>laporan/print_rekap/<?php echo $this->input->post('tgl1') ?>/<?php echo $this->input->post('tgl2') ?>" target="_blank" class="btn btn-success" style="margin-bottom:10px;"><i class="fa fa-print"></i> Print</a></h3>-->
    </div>
    <?php }else{ ?>
                    
                    <?php } ?>
</div>
    </div>
</div>
  <!-- /main-inner --> 

<!-- /main -->
