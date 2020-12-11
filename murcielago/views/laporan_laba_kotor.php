<div class="" style="margin-top:10px;padding:0px;">

    <div class="container">

        <div class="panel panel-default">

            <div class="panel-heading">Laba Kotor</div>

            <div class="panel-body">

            <center>

            <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>

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

            <form method="post" action="<?php echo base_url() ?>laporan/laporan_laba_kotor">

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

                    <button type="submit" class="btn btn-primary">Lihat</button>    

                </div>

            </form>

            </div>

                    

            <div id="tahun">

            <form method="post" action="<?php echo base_url() ?>laporan/laporan_laba_kotor/thn">

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

            </center>

                    <?php if($this->uri->segment(3) == 'thn'){ ?>

                     <?php $data['step1'] =  $this->m_data->step1_laba2($this->input->post('thn1'),$this->input->post('thn2'))->result(); ?>

                    <?php }else{ ?>

                <?php $data['step1'] =  $this->m_data->step1_laba($this->input->post('bln1'),$this->input->post('bln2'))->result(); ?>

                    <?php } ?>

                    <?php //if(empty($data['step1'] =  $this->m_data->step1_laba('','',$this->input->post('thn1'),$this->input->post('thn2'))->result())){ ?>

                    <?php //}else{ ?>

                    <?php if(empty($data['step1'])){ ?>

                    

                    <?php }else{ ?>

                <table class="table" id="example">

                    <thead>

                      <tr>

                        <th>No</th>

                        <th>Harga Per Barang</th>

                        <th>Laba Kotor Per Barang</th>

                      </tr>

                    </thead>

                    <tbody>

                        <?php 

                        $no=0;

                        foreach($data['step1'] as $dat){

                        $no++;

                        $data['step2'] = $this->m_data->step2_laba($dat->kode_barang)->row();

                        ?>

                      <tr>

                        <td><?php echo $no; ?></td>

                        <td>Rp <?php echo number_format($data['step2']->harga_pokok); ?></td>

                        <td>

                        <?php 

                            $hg_p = $data['step2']->harga_pokok;

                            $hg_b = $data['step2']->harga_beli;

                            $kur = $hg_p - $hg_b;

                            echo "Rp ".number_format($kur);

                        ?>

                        </td>

                      </tr>

                        <?php } ?>

                    </tbody>

                  </table>

                    <table class="table">

                        <tbody>

                        <?php
			$nl = 0;
		 foreach($data['step1'] as $dt){ $nl++; }

                        $no=0;

                        foreach($data['step1'] as $dat){

                        $no++;

                        $data['step2'] = $this->m_data->step2_laba($dat->kode_barang)->row();

                        ?>

                        <?php 

                            $hg_p = $data['step2']->harga_pokok;

                            $hg_b = $data['step2']->harga_beli;

                            $kur = $hg_p - $hg_b;

                            

                            if($no==1){

                                

                            $total = $kur;

                             $total;

                            }else{

                                

                            $total = $total + $kur;

                                 $total;

                            }

                            if($no==$nl){

                            echo "

                      <tr>

                        <td style='background-color:#f08519;'></td>
                        <td style='background-color:#f08519;'></td>
                        <td style='background-color:#f08519;'><b style='font-size:16px;color:#fff'>Total Laba Kotor</b></td>
                        <td style='background-color:#f08519;width:300px;'><b style='font-size:16px;color:#fff;'>Rp ".number_format($total)."
                        </b></td>

                        <td  style='background-color:#f08519;'>
                        </td>

                      </tr>";

                            }

                        ?>

                        <?php } ?>

                    </tbody>

                    </table>

                    <?php } ?>

            </div>

        </div>  

    </div>

</div>