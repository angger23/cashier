<table class="table table-bordered">
  <thead>
    <tr>
      <th>Simpanan Pokok</th>
      <th>Simpanan Wajib</th>
      <th>Angsuran Pokok Pinjaman Uang Tunai</th>
      <th>Angsuran Bunga Pinjaman Uang Tunai</th>
      <th>Angsuran Pinjaman Toko</th>
      <th>Jumlah Potongan Gaji</th>
    </tr>
  </thead>
  <tbody>
    <?php
    $cari_rincian_hutang = $this->m_data->piutang_kas_anggota2($tgl,$id_anggota)->result();
    $cari_rincian_hutang2 = $this->m_data->piutang_kas_anggota2($tgl,$id_anggota)->row();
    $no = 0;
    $bunga = 0;
    $pokok = 0;
    foreach($cari_rincian_hutang as $c){
      $no++;
      if(empty($cari_rincian_hutang2)){$gosh='';}else{$gosh=($c->pokok_pinjaman * 2 / 100) * $c->jangka_waktu; }
      $bung[$no] = (empty($cari_rincian_hutang2)) ? '-' : $gosh / $c->jangka_waktu;
      $pok[$no] = $c->pokok_pinjaman / $c->jangka_waktu;
      $bunga += $bung[$no];
      $pokok += $pok[$no];
    }
    $cari_simpanan_pokok = $this->m_data->where('simpanan_pokok',array('id_anggota' => $c->id_anggota))->row();
    $cari_simpanan_wajib = $this->m_data->where('simpanan_wajib',array('id_anggota' => $c->id_anggota))->row();
     ?>
    <tr>
      <td>Rp <?php echo number_format($cari_simpanan_pokok->simpanan_pokok) ?></td>
      <td>Rp <?php echo number_format($cari_simpanan_wajib->simpanan_wajib) ?></td>
      <td>Rp <?php echo number_format($pokok); ?></td>
      <td>Rp <?php echo number_format($bunga); ?></td>
      <td></td>
      <td>Rp <?php echo number_format($pokok+$bunga+$cari_simpanan_pokok->simpanan_pokok+$cari_simpanan_wajib->simpanan_wajib) ?></td>
    </tr>
  </tbody>
</table>
