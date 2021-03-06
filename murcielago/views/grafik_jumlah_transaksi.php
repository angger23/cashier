<script type="text/javascript">
$(function () {
    var chart;
    $(document).ready(function() {
        chart = new Highcharts.Chart({
            chart: {
                renderTo: 'container',
                type: 'column',
                marginRight: 130,
                marginBottom: 25
            },
            title: {
                text: 'Grafik Transaksi',
                x: -20 //center
            },
            subtitle: {
                text: '',
                x: -20
            },
            xAxis: {
                <?php if($this->uri->segment(3) == 'thn'){ ?>
                <?php //$data['jual_count'] = $this->m_data->jual_count1($this->input->post('thn1'),$this->input->post('thn2'))->result(); ?>
                
                <?php }else{ ?>
                <?php $data['jual_count'] = $this->m_data->jual_count($this->input->post('bln1'),$this->input->post('bln2'),$this->input->post('thnx'))->result(); ?>
                <?php } ?>
                categories: [
                    <?php if($this->uri->segment(3) == 'thn'){ ?>
                    <?php for($i=$this->input->post('thn2');$i>=$this->input->post('thn1');$i--){ ?>
                        <?php echo $i.","; ?>
                    <?php } ?>
                    <?php }else{ ?>
                    <?php foreach($data['jual_count'] as $xat){ ?>
                    <?php 
                        if($xat->bulan_beli == '01'){
                        echo "'Januari',";
                        }elseif($xat->bulan_beli == '02'){
                        echo "'Februari',";    
                        }elseif($xat->bulan_beli == '03'){
                          echo "'Maret',";     
                        }elseif($xat->bulan_beli == '04'){
                        echo "'April',";   
                        }elseif($xat->bulan_beli == '05'){
                        echo "'Mei',";   
                        }elseif($xat->bulan_beli == '06'){
                        echo "'Juni',";   
                        }elseif($xat->bulan_beli == '07'){
                        echo "'Juli',";   
                        }elseif($xat->bulan_beli == '08'){
                        echo "'Agustus',";   
                        }elseif($xat->bulan_beli == '09'){
                        echo "'September',";   
                        }elseif($xat->bulan_beli == '10'){
                        echo "'Oktober',";   
                        }elseif($xat->bulan_beli == '11'){
                        echo "'November',";   
                        }else{
                        echo "'Desember'";   
                        }
                    
                        ?>
                    <?php } ?>
                    <?php }  ?>
                ]
            },
            yAxis: {
                title: {
                    text: ''
                },
                plotLines: [{
                    value: 0,
                    width: 1,
                    color: '#808080'
                }]
            },
            tooltip: {
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
            series: [{
                name: 'Total Transaksi',
                <?php if($this->uri->segment(3) == 'thn'){ ?>
                
                <?php $data['jual_count'] = $this->m_data->jual_count1($this->input->post('thn1'),$this->input->post('thn2'))->result(); ?>
                <?php }else{ ?>
                
                <?php $data['jual_count'] = $this->m_data->jual_count($this->input->post('bln1'),$this->input->post('bln2'),$this->input->post('thnx'))->result(); ?>
                
                <?php } ?>
                 <?php $no=1; foreach($data['jual_count'] as $axd ){ $no++; ?>
                <?php } ?>
                   data: [
                <?php $noo=1; foreach($data['jual_count'] as $ax){ $noo++; ?>
                <?php if($this->uri->segment(3) == 'thn'){ ?>
                    <?php $data['count_jual'] = $this->m_data->count_penjualan1($ax->tahun_n)->row(); ?>
                <?php }else{ ?>
                <?php $data['count_jual'] = $this->m_data->count_penjualan($ax->bulan_beli,$this->input->post('thnx'))->row(); ?>
                <?php } ?>
             <?php 
                             if($noo==$no){echo $data['count_jual']->TOTAL; }else{ echo $data['count_jual']->TOTAL.","; } ?>
                <?php } ?> ]
            }]
        });
    });
    
});
</script>
<div class="" style="margin-top:10px;padding:0px;">
    <div class="container">
        <div class="panel panel-default">
            <div class="panel-heading"><h4>Grafik Jumlah Transaksi</h4></div>
            <div class="panel-body">
<script>
$(document).ready(function(){
        $("#bulan").hide();
        $("#tahun").hide();
    $("#bln").click(function(){
        $("#bulan").show();
        $("#tahun").hide();
    });
    $("#thn").click(function(){
        $("#tahun").show();
        $("#bulan").hide();
    });
});
</script>
            <label class="radio-inline"><input type="radio" name="optradio" id="bln">Lihat Per Bulan</label>
            <label class="radio-inline"><input type="radio" name="optradio" id="thn">Lihat Per Tahun</label>
                <center>
            <div id="bulan">
            <form method="post" action="<?php echo base_url() ?>laporan/grafik_transaksi">
                <div class="form-group">
                    <label>Mulai Bulan</label>
                      <select class="form-control" id="sel1" name="bln1">
                    <option value="">Pilih Bulan</option>
                          
                          <?php
 $bln=array(1=>"Januari","Februari","Maret","April","Mei","Juni","July","Agustus","September","Oktober","November","Desember");
                        for($bulan=1; $bulan<=12; $bulan++){
                        if($bulan<=9) { echo "<option value='0$bulan'>$bln[$bulan]</option>"; }
                        else { echo "<option value='$bulan'>$bln[$bulan]</option>"; }
                        }
                        ?>
                      </select>
                </div><div class="form-group">
                    <label>Sampai Bulan</label>
                      <select class="form-control" id="sel1" name="bln2">
                    <option value="">Pilih Bulan</option>
                          
                          <?php
 $bln=array(1=>"Januari","Februari","Maret","April","Mei","Juni","July","Agustus","September","Oktober","November","Desember");
                        for($bulan=1; $bulan<=12; $bulan++){
                        if($bulan<=9) { echo "<option value='0$bulan'>$bln[$bulan]</option>"; }
                        else { echo "<option value='$bulan'>$bln[$bulan]</option>"; }
                        }
                        ?>
                      </select>
                </div>
                <div class="form-group">
                <label for="sel1">Pilih tahun</label>
                  <select class="form-control" id="sel1" name="thnx">
                    <option value="">Pilih Tahun</option>
                      <?php for($i=2035;$i>2000;$i--){ ?>
                    <option value="<?php echo $i ?>"><?php echo $i ?></option>
                      <?php } ?>
                  </select>
                </div>
                <div class="form-group">
                    <button type="submit" class="btn btn-primary">Lihat</button>    
                </div>
            </form>
            </div>
                    
            <div id="tahun">
            <form method="post" action="<?php echo base_url() ?>laporan/grafik_transaksi/thn">
                <div class="form-group">
                    <label>Mulai Tahun</label>
                    <select class="form-control" id="sel1" name="thn1">
                    <option value="">Pilih Tahun</option>
                      <?php for($i=2035;$i>2000;$i--){ ?>
                    <option value="<?php echo $i ?>"><?php echo $i ?></option>
                      <?php } ?>
                  </select>
                </div>
                <div class="form-group">
                    <label>Sampai Tahun</label>
                    <select class="form-control" id="sel1" name="thn2">
                    <option value="">Pilih Tahun</option>
                      <?php for($i=2035;$i>2000;$i--){ ?>
                    <option value="<?php echo $i ?>"><?php echo $i ?></option>
                      <?php } ?>
                  </select>
                </div>
                <div class="form-group">
                    <button type="submit" class="btn btn-primary">Lihat</button>    
                </div>
            </form>
            </div>
                </center>
                
            <div class="row">
                <?php if($this->uri->segment(3) == 'thn'){ ?>
                    <?php if(empty($data['jual_count'] = $this->m_data->jual_count1($this->input->post('thn1'),$this->input->post('thn2'))->result())){ }else{echo'<div id="container">
                    
                </div>';}?>
                <?php }else{ ?>
                <?php if(empty($data['jual_count'] = $this->m_data->jual_count($this->input->post('bln1'),$this->input->post('bln2'),$this->input->post('thnx'))->result())){ 
                }else{
                    echo '<div id="container">

                                </div>';
                } ?>
                
                <?php } ?>
            </div>
                
            </div>
        </div>  
    </div>
</div>