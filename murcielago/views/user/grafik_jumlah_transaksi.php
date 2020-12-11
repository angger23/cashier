<div class="content-wrapper">
  <div class="container-fluid">
    <section class="content">
        <div class="row">
            <div class="col-md-2">
                <button type="button" class="btn btn-warning btn-flat btn-block" onclick="perbulan()"><i id="fa-bulan" class="fa fa-check"></i>&nbsp;&nbsp;Lihat per Bulan</button>
            </div>
            <div class="col-md-2">
                <button type="button" class="btn btn-success btn-flat btn-block" onclick="pertahun()"><i id="fa-tahun" class="fa fa-check"></i>&nbsp;&nbsp;Lihat per Tahun</button>
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
            
        ?>
        <div class="row">
            <? 
            // $nos=0;
            // $ttx=0;
            // $total1 = 0;
            // $total2 = 0;
            
            // foreach($penjualan as $p):
            // $nos++;
            // $cek_akhir_pem = $this->m_data->cek_akhir2('kd_pembelian','DESC','pembelian_barang',['kode_barang' => $p->kode_barang])->row();
            // $jml_harga[$nos] = $p->satuan  * $p->harga_netto_jual_satuan;
            // $hpp[$nos] = $p->satuan * $cek_akhir_pem->harga_beli_satuan;
            // $laba[$nos] = $p->satuan  * $p->harga_netto_jual_satuan - ($p->satuan * $cek_akhir_pem->harga_beli_satuan);
            // $totalku = $hpp[$nos];
            // $total = $jml_harga[$nos];
            // $totalya = $laba[$nos];
            // $ttx += $total;
            // $total1 += $totalku;
            // $total2 += $totalya;
            ?>
            <? //endforeach; ?>
            <div class="col-md-12">
<!--            <p><b>Total Penjualan</b> : <b>Rp. <?//= number_format($ttx); ?></b></p>-->
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
		text: "Grafik Jumlah Transaksi <?= (!empty($this->input->post('bulan1'))) ? 'Bulan '.bulan($this->input->post('bulan1')).' - '.bulan($this->input->post('bulan2')).' Tahun '.$this->input->post('tahun_bulan').'' : ((!empty($this->input->post('tahun1'))) ? 'Tahun '.$this->input->post('tahun1').' - '.$this->input->post('tahun2').'' : 'Tahun '.date('Y').'' ); ?>"
	},
	axisY: {
		title: "Grafik Jumlah Transaksi",
		suffix: " Transaksi",
		includeZero: false
	},
	axisX: {
		title: "Keterangan"
	},
	data: [{
		type: "column",
		yValueFormatString: "#,###\" Transaksi\"",
		dataPoints: [
            <?
                if(!empty($this->input->post('bulan1'))){
                     $bulanq = $this->m_other->cari_perbulan($this->input->post('bulan1'),$this->input->post('bulan2'),$this->input->post('tahun_bulan'))->result();
            $bulanq1 = $this->m_other->cari_perbulan($this->input->post('bulan1'),$this->input->post('bulan2'),$this->input->post('tahun_bulan'))->num_rows();
            ?>
            <? 
            $no=0;
            foreach($bulanq as $b){
            $no++;
            $total_bul = $this->m_other->total_bul($b->bulan,$this->input->post('tahun_bulan'))->num_rows();
            ?>
			{ label: "<?= bulan($b->bulan) ?>", y: <?= $total_bul; ?> }<?= ($no==$bulanq1) ? '' : ','; ?>
            <? } ?>
			<? }elseif(!empty($this->input->post('tahun1'))){ 
                $tahuq = $this->m_other->cari_pertahun($this->input->post('tahun1'),$this->input->post('tahun2'))->result();
                $tahuq1 = $this->m_other->cari_pertahun($this->input->post('tahun1'),$this->input->post('tahun2'))->num_rows();
            $noq=0;
            foreach($tahuq as $t){
            $noq++;
            $tahuq11 = $this->m_other->total_hun($t->tahun)->num_rows();
            ?>
            { label: "<?= $t->tahun ?>", y: <?= $tahuq11; ?> }<?= ($noq==$tahuq1) ? '' : ','; ?>
            <? } ?>
            <? }else{ ?>
            <?
            for($i=1;$i<=12;$i++){
            $total_bul = $this->m_other->total_bul($i,date('Y'))->num_rows();
            ?>
            { label: "<?= bulan($i) ?>", y: <?= $total_bul; ?> }<?= ($i=='12') ? '' : ','; ?>
            <? } } ?> 
		]
	}]
});
chart.render();

}
</script>