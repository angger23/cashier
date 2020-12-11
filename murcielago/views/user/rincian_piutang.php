<table class="table table-bordered">
    <thead>
      <tr>
        <th colspan="6" class="text-center"><?php echo $bln ?>-<?php echo $thn ?></th>
      </tr>
      <tr>
      	<th colspan="2"> Potongan Gaji / Angsuran <?php echo $bln ?></th>
        <th colspan="3" style="text-align:center;">Pelunasan</th>
      	<th rowspan="2" style="vertical-align: middle;" class="text-center">Saldo Pokok</th>
      </tr>
      <tr>
      	<th style="text-align:center;">Pokok</th>
        <th style="text-align:center;">Bunga</th>
        <th style="text-align:center;">Tanggal</th>
        <th style="text-align:center;">Pokok</th>
        <th style="text-align:center;">Bunga</th>
      </tr>
    </thead>
    <tbody>
      <?php
      $cari_rincian_hutang = $this->m_data->piutang_kas_anggota2($tgl,$id_anggota)->result();
      $cari_rincian_hutang2 = $this->m_data->piutang_kas_anggota2($tgl,$id_anggota)->row();
      $no=0;
      foreach($cari_rincian_hutang as $c){
      $no++;
       ?>
     <tr>
     	<td>Rp <?php echo number_format($c->pokok_pinjaman / $c->jangka_waktu) ?></td>
      <?php if(empty($cari_rincian_hutang2)){$gosh='';}else{$gosh=($c->pokok_pinjaman * 2 / 100) * $c->jangka_waktu; }?>
        <td>Rp <?php echo (empty($cari_rincian_hutang2)) ? '-' : number_format($gosh / $c->jangka_waktu) ?></td>
        <td><?php echo date("d-m-Y",strtotime($c->tanggal_pinjam)); ?></td>
        <td></td>
        <td>2000</td>
        <td>200000</td>
     </tr>
   <?php } ?>
    </tbody>
  </table>
