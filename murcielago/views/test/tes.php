<?php
  $nos=0;
  $p=0;
  $hpp=0;
  $laba=0;
  foreach($penjualan as $get){
    $nos++;
    $jml_barang_terjual = $this->m_data->barang_terjual($get->kd_nota,$get->kode_barang)->row();
    $disc = $get->diskon / 100 * ($get->harga_pokok);
    $ttl = $get->harga_pokok-$disc;
    // penjualan
    $jumlah_saldojual_per_barang = $ttl*$jml_barang_terjual->jml;
    $p1[$nos] = $jumlah_saldojual_per_barang;
    $p += $p1[$nos];
    // end penjualan
    $hargapp = (empty($get->harga_netto_jual_satuan)) ? $get->harga_pokok * $jml_barang_terjual->jml : $get->harga_netto_jual_satuan * $jml_barang_terjual->jml;
    $h[$nos] = $hargapp;
    $hpp += $h[$nos];
    // end hpp
    // laba
    $lab = ($ttl*$jml_barang_terjual->jml) - $h[$nos];
    $l[$nos] = $lab;
    $laba += $l[$nos];
    // end laba
  }
  echo $p.'<br>';
  echo $hpp.'<br>';
  echo $laba.'<br>';
?>
