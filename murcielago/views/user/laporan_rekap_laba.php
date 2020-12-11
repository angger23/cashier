<div class="content-wrapper">
  <div class="container-fluid">
    <section class="content">
        <div class="row">
<!--
            <div class="col-md-2">
                <button type="button" class="btn btn-primary btn-flat btn-block" onclick="perhari()"><i id="fa-hari" class="fa fa-check"></i>&nbsp;&nbsp;Lihat per Hari</button>
            </div>
-->
            <div class="col-md-2">
                <button type="button" class="btn btn-warning btn-flat btn-block" onclick="perbulan()"><i id="fa-bulan" class="fa fa-check"></i>&nbsp;&nbsp;Lihat per Bulan</button>
            </div>
            <div class="col-md-2">
                <button type="button" class="btn btn-success btn-flat btn-block" onclick="pertahun()"><i id="fa-tahun" class="fa fa-check"></i>&nbsp;&nbsp;Lihat per Tahun</button>
            </div>
            <?
            if(!empty($this->input->post('bulan1'))){
            ?>
            <div class="col-md-2">
                <a href="" class="btn btn-info btn-flat btn-block"><i class="fa fa-refresh"></i>&nbsp;&nbsp;Refresh</a>
            </div>
            <?
            }elseif(!empty($this->input->post('tahun1'))){
            ?>
            <div class="col-md-2">
                <a href="" class="btn btn-info btn-flat btn-block"><i class="fa fa-refresh"></i>&nbsp;&nbsp;Refresh</a>
            </div>
            <?
            }else{ } ?>
        </div>
        <div class="row" id="perbulan">
            <hr>
            <div class="col-md-12" style="padding:0px;">
                <form action=""  method="post">
                    <div class="col-md-3">
                        <label>Mulai Bulan</label>
                        <select class="form-control" name="bulan1">
                            <option>Pilih Bulan</option>
                            <?php
                        $bln=array(1=>"Januari","Februari","Maret","April","Mei","Juni","July","Agustus","September","Oktober","November","Desember");
                        for($bulan=1; $bulan<=12; $bulan++){
                        if($bulan<=9) { echo "<option value='0$bulan'>$bln[$bulan]</option>"; }
                        else { echo "<option value='$bulan'>$bln[$bulan]</option>"; }
                        }
                        ?>
                        </select>
                    </div>
                    <div class="col-md-3">
                        <label>Sampai Bulan</label>
                        <select class="form-control" name="bulan2">
                            <option>Pilih Bulan</option>
                            <?php
                        $bln=array(1=>"Januari","Februari","Maret","April","Mei","Juni","July","Agustus","September","Oktober","November","Desember");
                        for($bulan=1; $bulan<=12; $bulan++){
                        if($bulan<=9) { echo "<option value='0$bulan'>$bln[$bulan]</option>"; }
                        else { echo "<option value='$bulan'>$bln[$bulan]</option>"; }
                        }
                        ?>
                        </select>
                    </div>
                    <div class="col-md-3">
                        <label>Sampai Tahun</label>
                        <select class="form-control" name="tahun_bulan">
                            <option>Pilih Tahun</option>
                             <?php for($i=2015;$i<=2035;$i++){ ?>
                            <option value="<?php echo $i ?>"><?php echo $i ?></option>
                              <?php } ?>
                        </select>
                    </div>
                    <div class="col-md-2">
                        <button type="submit" class="btn btn-info btn-flat" style="margin-top:24px;"><i class="fa fa-search"></i> Cari</button>
                    </div>
                </form>
            </div>
        </div>
        <div class="row" id="pertahun">
            <hr>
            <div class="col-md-8" style="padding:0px;">
                <form action=""  method="post">
                    <div class="col-md-5">
                        <label>Mulai Tahun</label>
                        <select class="form-control" name="tahun1">
                            <option>Pilih Tahun</option>
                             <?php for($i=2015;$i<=2035;$i++){ ?>
                            <option value="<?php echo $i ?>"><?php echo $i ?></option>
                              <?php } ?>
                        </select>
                    </div>
                    <div class="col-md-5">
                        <label>Sampai Tahun</label>
                        <select class="form-control" name="tahun2">
                            <option>Pilih Tahun</option>
                             <?php for($i=2015;$i<=2035;$i++){ ?>
                            <option value="<?php echo $i ?>"><?php echo $i ?></option>
                              <?php } ?>
                        </select>
                    </div>
                    <div class="col-md-2">
                        <button type="submit" class="btn btn-info btn-flat" style="margin-top:24px;"><i class="fa fa-search"></i> Cari</button>
                    </div>
                </form>
            </div>
        </div>
<div class="row"><hr></div>
        <div class="row">
            <div id="chartContainer" style="height: 300px; width: 100%;"></div>
        </div>
        <?
            if(!empty($this->input->post('hari1'))){
                $penjualan = $this->m_data->cari_list_data_penjualan($this->input->post('hari1'),$this->input->post('hari2'))->result();
                $tanggal1 = $this->input->post('hari1');
                $tanggal2 = $this->input->post('hari2');
            }elseif(!empty($this->input->post('bulan1'))){
                $penjualan = $this->m_data->cari_bulan_list_data_penjualan($this->input->post('bulan1'),$this->input->post('bulan2'),$this->input->post('tahun_bulan'))->result();
                $bulan1 = $this->input->post('bulan1');
                $bulan2 = $this->input->post('bulan2');
                $tahun_bulan = $this->input->post('tahun_bulan');
            }elseif(!empty($this->input->post('tahun1'))){
                $penjualan = $this->m_data->cari_tahun_list_data_penjualan($this->input->post('tahun1'),$this->input->post('tahun2'))->result();
                $tahun1 = $this->input->post('tahun1');
                $tahun2 = $this->input->post('tahun2');
            }else{
                $penjualan = $this->m_data->list_data_penjualan()->result();
            }
        ?>
        <div class="row">
            <?
            $nos=0;
            $ttx=0;
            $total1 = 0;
            $total2 = 0;

            foreach($penjualan as $p):
            $nos++;
            $cek_akhir_pem = $this->m_data->cek_akhir2('kd_pembelian','DESC','pembelian_barang',['kode_barang' => $p->kode_barang])->row();
            $jml_harga[$nos] = $p->satuan  * $p->harga_netto_jual_satuan;
            $hpp[$nos] = (empty($p->satuan)) ? '0' : $p->satuan * (empty($cek_akhir_pem->harga_beli_satuan)) ? '0' : $cek_akhir_pem->harga_beli_satuan;
            $laba[$nos] = (empty($p->satuan)) ? '0' : $p->satuan * (empty($p->harga_netto_jual_satuan)) ? '0' : $p->harga_netto_jual_satuan - ( (empty($p->satuan)) ? '0' : $p->satuan * (empty($cek_akhir_pem->harga_beli_satuan)) ? '0' : $cek_akhir_pem->harga_beli_satuan );
            $totalku = $hpp[$nos];
            $total = $jml_harga[$nos];
            $totalya = $laba[$nos];
            $ttx += $total;
            $total1 += $totalku;
            $total2 += $totalya;
            ?>
            <? endforeach; ?>
            <div class="col-md-12">
<!--            <p><b>Total Penjualan</b> : <b>Rp. <?= number_format($ttx); ?></b></p>-->
            </div>
        </div>
      </section>
    </div>
</div>

<?  $thn_start = $this->input->post('tahun1');
    $thn_end = $this->input->post('tahun2');
?>

<script>

    $('#fa-hari').hide();
    $('#fa-bulan').hide();
    $('#fa-tahun').hide();
    $('#perhari').hide();
    $('#perbulan').hide();
    $('#pertahun').hide();

    function perhari(){
        $('#fa-hari').show();
        $('#fa-bulan').hide();
        $('#fa-tahun').hide();
        $('#pertahun').hide();
        $('#perbulan').hide();
        $('#perhari').show();
    }

    function perbulan(){
        $('#fa-hari').hide();
        $('#fa-bulan').show();
        $('#fa-tahun').hide();
        $('#pertahun').hide();
        $('#perbulan').show();
        $('#perhari').hide();
    }

    function pertahun(){
        $('#fa-hari').hide();
        $('#fa-bulan').hide();
        $('#fa-tahun').show();
        $('#pertahun').show();
        $('#perbulan').hide();
        $('#perhari').hide();
    }

    //iki chart pertama//
window.onload = function () {

var chart = new CanvasJS.Chart("chartContainer", {
	animationEnabled: true,
	theme: "light2", // "light1", "light2", "dark1", "dark2"
	title: {
		text: "Laba Penjualan"
	},
	axisY: {
		title: "Omzet Penjualan",
		suffix: " rb",
		includeZero: false
	},
	axisX: {
		title: "Keterangan"
	},
	data: [{
		type: "column",
		yValueFormatString: "#,###\" rb\"",
        <? if(!empty($this->input->post('bulan1'))){

                $bulan_beli = $this->m_data->cari_rekap_penjualan_bulan($this->input->post('bulan1'),$this->input->post('bulan2'),$this->input->post('tahun_bulan'))->result();

            }elseif(!empty($this->input->post('tahun1'))){

                $bulan_beli = $this->m_data->cari_tahun_rekap_penjualan($thn_start,$thn_end)->result();

            }else{

                $bulan_beli = $this->m_data->rekap_penjualan_bulan()->result();
            }
        ?>
		dataPoints: [
            <? $no=0; foreach($bulan_beli as $record){ $no++;
            //$record->tahun_n;
//            $bulan = str_replace("0","",$record->bulan_beli);
            if(!empty($this->input->post('bulan1'))){
                $bulanku = $this->m_data->sum_rekap_penjualan_bulan($record->bulan_beli)->row();
            }elseif(!empty($this->input->post('tahun1'))){
                $bulanku = $this->m_data->sum_rekap_penjualan_tahun($record->tahun_n)->row();
            }else{
                $bulanku = $this->m_data->  sum_rekap_penjualan_bulan($record->bulan_beli)->row();
            }
             ?>
			{ label : " <? if(!empty($record->tahun_n)){echo $record->tahun_n;}else{echo bulan($record->bulan_beli);} ?> ", y: <? echo $bulanku->total; ?> },
            <? } ?>
		]
	}]
});
chart.render();

}
</script>
