<div class="content-wrapper">
  <div class="container-fluid">
    <section class="content">
        <div class="row">
            <div class="col-md-2">
                <button type="button" class="btn btn-primary btn-flat btn-block" onclick="perhari()"><i id="fa-hari" class="fa fa-check"></i>&nbsp;&nbsp;Lihat per Hari</button>
            </div>
            <div class="col-md-2">
                <button type="button" class="btn btn-warning btn-flat btn-block" onclick="perbulan()"><i id="fa-bulan" class="fa fa-check"></i>&nbsp;&nbsp;Lihat per Bulan</button>
            </div>
            <div class="col-md-2">
                <button type="button" class="btn btn-success btn-flat btn-block" onclick="pertahun()"><i id="fa-tahun" class="fa fa-check"></i>&nbsp;&nbsp;Lihat per Tahun</button>
            </div>
        </div>
        <div class="row" id="perhari">
            <hr>
            <div class="col-md-8" style="padding:0px;">
                <form action=""  method="post">
                    <div class="col-md-5">
                        <label>Mulai Tanggal</label>
                        <input type="text" name="hari1" class="form-control datepicker">
                    </div>
                    <div class="col-md-5">
                        <label>Sampai Tanggal</label>
                        <input type="text" name="hari2" class="form-control datepicker">
                    </div>
                    <div class="col-md-2">
                        <button type="submit" class="btn btn-info btn-flat" style="margin-top:24px;"><i class="fa fa-search"></i> Cari</button>
                    </div>
                </form>
            </div>
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
            $laba[$nos] =  (empty($p->satuan)) ? '0' : $p->satuan  * (empty($p->harga_netto_jual_satuan)) ? '0' : $p->harga_netto_jual_satuan - ( (empty($p->satuan)) ? '0' : $p->satuan * $cek_akhir_pem->harga_beli_satuan);
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
		text: "Omzet Penjualan <?
        if(!empty($this->input->post('hari1'))){
            echo tgl_indo(date('Y-m-d', strtotime($tanggal1)));
            echo'-';
            echo tgl_indo(date('Y-m-d', strtotime($tanggal2)));
        }elseif(!empty($this->input->post('bulan1'))){
$bln=array("Januari","Februari","Maret","April","Mei","Juni","July","Agustus","September","Oktober","November","Desember");
            $str = str_replace("0","",$bulan1);
            $str2 = str_replace("0","",$bulan2);
            $strp = $str-1;
            $strp2 = $str2-1;
            echo $bln[$strp].' - '.$bln[$strp2]." ".$tahun_bulan ;
        }elseif(!empty($this->input->post('tahun1'))){
            echo $tahun1.' - '.$tahun2;
        }else{} ?>"
	},
	axisY: {
		title: "Omzet Penjualan",
		suffix: "rb",
		includeZero: false
	},
	axisX: {
		title: "Keterangan"
	},
	data: [{
		type: "column",
		yValueFormatString: "#,###\"rb\"",
		dataPoints: [
			{ label: "Omzet Penjualan", y: <?= $ttx; ?> }

		]
	}]
});
chart.render();

}
</script>
