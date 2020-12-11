<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title><?= $title ?></title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <link rel="stylesheet" type="text/css" href="<?php echo url_css() ?>assets/datepickertime/build/css/bootstrap-datetimepicker.min.css">
    <script src="<?php echo url_css() ?>assets/js/rupiah.js"></script>
    <link rel="icon" href="<?= url_css() ?>assets_kasir/img/icon_kasir.png" type="image/x-icon"/>
  <!-- Bootstrap 3.3.7 -->
  <link rel="stylesheet" href="<?= base_url() ?>assets_kasir/css/bootstrap.min.css">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="<?= url_css() ?>assets_kasir/css/ionicons.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="<?= url_css() ?>assets_kasir/css/AdminLTE.css">
  <link rel="stylesheet" href="<?= url_css() ?>assets_kasir/css/skins/_all-skins.min.css">
  <link rel="stylesheet" type="text/css" href="<?= url_css() ?>assets_kasir/css/dropzone.min.css">
    <link href="<?= url_css() ?>assets_kasir/sweetalert/sweetalert.css" rel="stylesheet" />
    <!-- datatable -->
<link href="<?php echo url_css() ?>assets/select2/select2.css" rel="stylesheet">
  <link href="<?php echo url_css() ?>assets/select2/select2.min.css" rel="stylesheet">
  <link rel="stylesheet" type="text/css" href="<?php echo url_css() ?>assets_kasir/plugins/datatable/datatables.css">
  <link rel="stylesheet" type="text/css" href="<?php echo url_css() ?>assets_kasir/plugins/datatable/buttons.dataTables.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
  <link href="<?php echo url_css() ?>assets_kasir/bs3_new/css/bootstrap-editable.css" rel="stylesheet">
  <style type="text/css">
    .dataTables_wrapper .dataTables_filter input {
        margin-left: 0.5em;
        border: 1px solid #ccc;
        padding: 5px 10px;
    }
    .alert h4 {
          font-weight: 600;
          margin-bottom: 0px;
      }
  </style>
  <!-- Google Font -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
  <style type="text/css">
    .main-header .navbar {
        -webkit-transition: margin-left 0.3s ease-in-out;
        -o-transition: margin-left 0.3s ease-in-out;
        transition: margin-left 0.3s ease-in-out;
        margin-bottom: 0;
        margin-left: 230px;
        border: none;
        min-height: 90px;
        border-radius: 0;
    }
    .navbar-nav > .user-menu .user-image {
        float: left;
        width: 50px;
        height: 50px;
        border-radius: 50%;
        margin-right: 0px;
        margin-top: -14px;
    }
    .navbar-nav>li>a {
        padding-top: 15px;
        padding-bottom: 15px;
    }
    .navbar-nav > .user-menu > .dropdown-menu {
        border-top-right-radius: 0;
        border-top-left-radius: 0;
        padding: 1px 0 0 0;
        border-top-width: 0;
        width: 271px;
        border: 0px;
    }
    .navbar-nav>li>.dropdown-menu {
        margin-top: 22px;
        border-top-left-radius: 0;
        border-top-right-radius: 0;
        border: 0px;
    }
    .skin-green-light .main-header .navbar .nav>li>a:hover, .skin-green-light .main-header .navbar .nav>li>a:active, .skin-green-light .main-header .navbar .nav>li>a:focus, .skin-green-light .main-header .navbar .nav .open>a, .skin-green-light .main-header .navbar .nav .open>a:hover, .skin-green-light .main-header .navbar .nav .open>a:focus, .skin-green-light .main-header .navbar .nav>.active>a {
    background: transparent;
    color: #f6f6f6;
}
.navbar-nav {
    margin-top: 20px;
    margin-left: 15px;
}
.content-wrapper{
    background-color: #fff;
}
.active {
    background-color: #32404e;
}
.active .tabx{
    color: #fff;
}
.nav-tabs {
    border-bottom: 0px solid #ddd;
    background-color: #f9f9f9;
    box-shadow: 2px 2px 10px -3px #ccc;
}
.nav-tabs>li.active>a, .nav-tabs>li.active>a:focus, .nav-tabs>li.active>a:hover {
    color: #fff;
    cursor: default;
    background-color: #3c8dbc;
    border: 0px solid #ddd;
    border-bottom-color: transparent;
}
.nav > li > a:hover, .nav > li > a:active, .nav > li > a:focus {
    color: #616161 ;
    background: #e8e8e8 ;
}
.nav-tabs>li>a {
    margin-right: 0px;
    line-height: 1.42857143;
    border: 0px solid #3c8dbc;
    border-radius: 0px 0px 0 0;
    margin-left: 3px;
    color: #4e4e4e;
    margin-top: 1px;
}
/* .nav-tabs>li.active>a, .nav-tabs>li.active>a:focus, .nav-tabs>li.active>a:hover {
    color: #555;
    cursor: default;
    background-color: #fff;
    border: 0px solid #ddd;
    border-bottom-color: transparent;
    width: 162%;
} */
.nav-tabs>li>a {
    margin-right: 0px;
    line-height: 1.42857143;
    border: 0px solid #3c8dbc;
    border-radius: 0px 0px 0 0;
    margin-left: 3px;
}
.navbar-nav>li>.dropdown-menu {
    margin-top: 1px;
    border-top-left-radius: 0;
    border-top-right-radius: 0;
    border: 1px solid #dcdcdc;
    background-color: white;
    box-shadow: 2px 2px 11px -3px #ccc;
    padding: 0px;
}
.select2-container--default .select2-selection--single {
    background-color: #fff;
    border: 1px solid #aaa;
    border-radius: 4px;
}
.select2-container .select2-selection--single {
    box-sizing: border-box;
    cursor: pointer;
    display: block;
    height: 32px;
    user-select: none;
    -webkit-user-select: none;
}
.select2-container--default .select2-selection--single {
    background: #fff;
    border: 0 none;
    margin-bottom: 10px;
    padding: 0px 10px;
    width: 100%;
    font-weight: 400;
    height: 34px;
    border-radius: 0px;
    border: 1px solid #ddd;
    vertical-align: middle;
}
.dropdown-menu>li>a {
    display: block;
    padding: 8px 20px;
    clear: both;
    font-weight: 400;
    line-height: 1.42857143;
    color: #333;
    white-space: nowrap;
}
.navbar-brand {
    float: left;
    height: 50px;
    padding: 24px 15px;
    font-size: 18px;
    line-height: 20px;
}
.select2-container--default .select2-selection--single .select2-selection__rendered {
    color: #444;
    line-height: 34px;
}
.navbar-nav > li{
  padding: 20px 0px;
}
.navbar-nav{
  margin-top: 0px;
}
  </style>
</head>
<script>
function startTime() {
    var today = new Date();
    var h = today.getHours();
    var m = today.getMinutes();
    var s = today.getSeconds();
    m = checkTime(m);
    s = checkTime(s);
    document.getElementById('txt').innerHTML =
    h + ":" + m + ":" + s;
    var t = setTimeout(startTime, 500);
}
function checkTime(i) {
    if (i < 10) {i = "0" + i};  // add zero in front of numbers < 10
    return i;
}
</script>
<body onload="startTime()" class="hold-transition skin-green-light layout-top-nav">
<div class="wrapper">
  <header class="main-header">
    <nav class="navbar navbar-static-top" style="background-color: #34495e;">
      <div class="container-fluid">
        <div class="navbar-header">
          <a href="<?= base_url('p') ?>" class="navbar-brand"><img src="<?= base_url() ?>assets_kasir/photos/logo-kasir.png" style="width: 180px;"></a>
          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar-collapse">
            <i class="fa fa-bars"></i>
          </button>
        </div>
        <? if($this->uri->segment(1) == 'p' && $this->uri->segment(1) == ''){ ?>
        <? }else{ ?>
        <div class="collapse navbar-collapse pull-left" id="navbar-collapse">
          <ul class="nav navbar-nav">
            <li class="<? if($this->uri->segment(1) == 'p' && $this->uri->segment(2) == ''){echo'active';}else{} ?>"><a href="<?= base_url(); ?>p">Home <span class="sr-only">(current)</span></a></li>
            <?
                $date = date('Y-m-d');
                $barang = $this->m_data->where('barang',['tanggal_expired <=' => $date])->num_rows();
                $barang2 = $this->m_data->where('barang',['stock' => '0'])->num_rows();
                $barang_makanan = $this->m_data->cek_header_makanan($date)->num_rows();
                $barang_minuman = $this->m_data->cek_header_minuman($date)->num_rows();
            ?>
            <?php if(!$this->ion_auth->in_group(1) && !$this->ion_auth->in_group(6) && !$this->ion_auth->in_group(7) && !$this->ion_auth->in_group(8) && !$this->ion_auth->in_group(9)){ ?>
              <li class="<? if($this->uri->segment(2) == 'data_penjualan'){echo'active';}elseif($this->uri->segment(2) == 'data_supplier'){echo'active';}elseif($this->uri->segment(2) == 'data_pelanggan'){echo'active';}elseif($this->uri->segment(2) == 'tambah_barang_supplier'){echo'active';}elseif($this->uri->segment(2) == 'data_karyawan'){echo'active';}elseif($this->uri->segment(2) == 'tambah_barang_supplier'){echo 'active';}else{} ?> dropdown">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown">Data <span class="caret"></span></a>
                <ul class="dropdown-menu" role="menu">
                  <li class="<? if($this->uri->segment(2) == 'data_penjualan'){echo'active';}else{} ?>"><a href="<?= base_url(); ?>kasir/data_penjualan">Data Penjualan <span class="sr-only">(current)</span></a></li>
                  <li class="<? if($this->uri->segment(2) == 'verifikasi_tgl_penjualan'){echo'active';}else{} ?>"><a href="<?= base_url('p/verifikasi_tgl_penjualan') ?>">Sinkronisasi Tanggal Jual</a></li>
                  <li class="<? if($this->uri->segment(2) == 'data_pelanggan'){echo'active';}else{} ?>"><a href="<?= base_url(); ?>kasir/data_pelanggan">Data Pelanggan <span class="sr-only">(current)</span></a></li>
                        <li class="<? if($this->uri->segment(2) == 'tambah_barang_supplier'){ echo'active'; }else{} ?>"><a href="<?= base_url('p/tambah_barang_suplier') ?>">Data Pembelian Supplier</a></li>
                </ul>
              </li>
              <li <? if($barang_makanan != '0'){
                  echo 'style="background-color:#ee5253;"';
              }elseif($barang_minuman != '0'){
                echo 'style="background-color:#ee5253;"';
              }elseif($barang2 != '0'){
                echo 'style="background-color:#ee5253;"';
              }else{
              } ?> class="<? if($this->uri->segment(2) == 'tambah_barang'){echo'active';}else{} ?>"><a href="<?= base_url('p/tambah_barang') ?>"><span class="pull-left-container">Barang</span>&nbsp;&nbsp;</a>
              </li>
              <li class="<? if($this->uri->segment(2) == 'list_hutang_penjualan'){echo'active';}elseif($this->uri->segment(2) == 'pembayaran_hutang_penjualan'){echo'active';}else{} ?> dropdown">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown">Hutang Penjualan <span class="caret"></span></a>
                <ul class="dropdown-menu" role="menu">
                  <li class="<? if($this->uri->segment(2) == 'list_hutang_penjualan'){echo'active';}else{} ?>"><a href="<?= base_url('kasir/list_hutang_penjualan') ?>">Daftar Hutang Penjualan</a></li>
                  <li class="<? if($this->uri->segment(2) == 'pembayaran_hutang_penjualan'){echo'active';}else{} ?>"><a href="<?= base_url('kasir/pembayaran_hutang_penjualan') ?>">Pembayaran Hutang Penjualan</a></li>
                </ul>
              </li>
              <li class="<? if($this->uri->segment(2) == 'grafik_omzet_penjualan'){echo'active';}elseif($this->uri->segment(2) == 'laporan_rekap_laba'){echo'active';}elseif($this->uri->segment(2) == 'grafik_jumlah_transaksi_penjualan'){echo'active';}elseif($this->uri->segment(2) == 'masuk'){echo'active';}elseif($this->uri->segment(2) == 'cash_flow'){echo'active';}else{} ?> dropdown">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown">Laporan<span class="caret"></span></a>
                <ul class="dropdown-menu" role="menu">
                  <li class="<? if($this->uri->segment(2) == 'grafik_omzet_penjualan'){echo'active';}else{} ?>"><a href="<?= base_url('grafik/grafik_omzet_penjualan') ?>">Grafik Omzet Penjualan</a></li>
                  <li class="<? if($this->uri->segment(2) == 'laporan_rekap_laba'){echo'active';}else{} ?>"><a href="<?= base_url('grafik/laporan_rekap_laba') ?>">Grafik Laba Penjualan</a></li>
                  <li class="<? if($this->uri->segment(2) == 'grafik_jumlah_transaksi_penjualan'){echo'active';}else{} ?>"><a href="<?= base_url('grafik/grafik_jumlah_transaksi_penjualan') ?>">Grafik Jumlah Transaksi</a></li>
                  <li class="<? if($this->uri->segment(2) == 'masuk'){echo'active';}else{} ?>"><a href="<?= base_url('laporan_kas/masuk') ?>">Laporan Kas Masuk</a></li>
                  <li class="<? if($this->uri->segment(2) == 'keluar'){echo'active';}else{} ?>"><a href="<?= base_url('laporan_kas/keluar') ?>">Laporan Kas Keluar</a></li>
                  <li class="<? if($this->uri->segment(2) == 'cash_flow'){echo'active';}else{} ?>"><a href="<?= base_url('laporan_kas/cash_flow') ?>">Laporan Kas (Cash Flow)</a></li>
                  <li class="<? if($this->uri->segment(2) == 'cash_flow'){echo'active';}else{} ?>"><a href="<?= base_url('online') ?>">Kirim Database Penjualan</a></li>
                </ul>
              </li>
            <?php }else{ ?>
              <?php
              if($this->ion_auth->in_group(8) || $this->ion_auth->in_group(9)){
               ?>
               <li class="<? if($this->uri->segment('1') == 'buku_anggota'){echo'active';}elseif($this->uri->segment('2') == 'buku_bank'){echo'active';} ?> dropdown">
                 <a href="#" class="dropdown-toggle" data-toggle="dropdown">Buku Bank<span class="caret"></span></a>
                 <ul class="dropdown-menu" role="menu">
                   <?php
                   if($this->ion_auth->in_group(8)){
                    ?>
                    <li><a href="<?= base_url('buku_anggota/view') ?>"> Kas Anggota </a></li>
                  <?php }else{ ?>
                    <li><a href="<?= base_url('p/buku_bank') ?>"> Kas Toko </a></li>
                  <?php } ?>
                 </ul>
               </li>
              <li class="<? if($this->uri->segment(2) == 'data_penjualan'){echo'active';}elseif($this->uri->segment(2) == 'data_supplier'){echo'active';}elseif($this->uri->segment(2) == 'data_pelanggan'){echo'active';}elseif($this->uri->segment(2) == 'tambah_barang_supplier'){echo'active';}elseif($this->uri->segment(2) == 'data_karyawan'){echo'active';}elseif($this->uri->segment(2) == 'verifikasi_tgl_penjualan'){echo 'active';}else{} ?> dropdown">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown">Data <span class="caret"></span></a>
                <ul class="dropdown-menu" role="menu">
                  <li class="<? if($this->uri->segment(2) == 'data_penjualan'){echo'active';}else{} ?>"><a href="<?= base_url(); ?>kasir/data_penjualan">Data Penjualan <span class="sr-only">(current)</span></a></li>
                  <?
                  if($this->ion_auth->is_admin()){
                  ?>
                  <li class="<? if($this->uri->segment(2) == 'verifikasi_tgl_penjualan'){echo'active';}else{} ?>"><a href="<?= base_url('p/verifikasi_tgl_penjualan') ?>">Sinkronisasi Tanggal Jual</a></li>
                  <li class="<? if($this->uri->segment(2) == 'data_supplier'){echo'active';}else{} ?>"><a href="<?= base_url(); ?>kasir/data_supplier">Data Supplier <span class="sr-only">(current)</span></a></li>
                  <li class="<? if($this->uri->segment(2) == 'data_pelanggan'){echo'active';}else{} ?>"><a href="<?= base_url(); ?>kasir/data_pelanggan">Data Pelanggan <span class="sr-only">(current)</span></a></li>
                  <li class="<? if($this->uri->segment(2) == 'tambah_barang_supplier'){echo'active';}else{} ?>"><a href="<?= base_url('p/tambah_barang_suplier') ?>">Data Pembelian Supplier</a></li>
                  <li class="<? if($this->uri->segment(2) == 'data_karyawan'){echo'active';}else{} ?>"><a href="<?= base_url('p/data_karyawan') ?>">Data User</a></li>
                <? }else{} ?>
                </ul>
              </li>
            <?php }else{ ?>
              <li <? if($barang_makanan != '0'){
                  echo 'style="background-color:#ee5253;"';
              }elseif($barang_minuman != '0'){
                echo 'style="background-color:#ee5253;"';
              }elseif($barang2 != '0'){
                echo 'style="background-color:#ee5253;"';
              }else{
              } ?> class="<? if($this->uri->segment(2) == 'tambah_barang'){echo'active';}else{} ?>"><a href="<?= base_url('p/tambah_barang') ?>"><span class="pull-left-container">Barang</span>&nbsp;&nbsp;</a>
              </li>
              <li class="<? if($this->uri->segment(2) == 'data_penjualan'){echo'active';}elseif($this->uri->segment(2) == 'data_supplier'){echo'active';}elseif($this->uri->segment(2) == 'data_pelanggan'){echo'active';}elseif($this->uri->segment(2) == 'tambah_barang_supplier'){echo'active';}elseif($this->uri->segment(2) == 'data_karyawan'){echo'active';}elseif($this->uri->segment(2) == 'verifikasi_tgl_penjualan'){echo 'active';}else{} ?> dropdown">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown">Data <span class="caret"></span></a>
                <ul class="dropdown-menu" role="menu">
                  <li class="<? if($this->uri->segment(2) == 'data_penjualan'){echo'active';}else{} ?>"><a href="<?= base_url(); ?>kasir/data_penjualan">Data Penjualan <span class="sr-only">(current)</span></a></li>
                  <?
                  if($this->ion_auth->is_admin()){
                  ?>
                  <li class="<? if($this->uri->segment(2) == 'verifikasi_tgl_penjualan'){echo'active';}else{} ?>"><a href="<?= base_url('p/verifikasi_tgl_penjualan') ?>">Sinkronisasi Tanggal Jual</a></li>
                  <li class="<? if($this->uri->segment(2) == 'data_supplier'){echo'active';}else{} ?>"><a href="<?= base_url(); ?>kasir/data_supplier">Data Supplier <span class="sr-only">(current)</span></a></li>
                  <li class="<? if($this->uri->segment(2) == 'data_pelanggan'){echo'active';}else{} ?>"><a href="<?= base_url(); ?>kasir/data_pelanggan">Data Pelanggan <span class="sr-only">(current)</span></a></li>
                  <li class="<? if($this->uri->segment(2) == 'tambah_barang_supplier'){echo'active';}else{} ?>"><a href="<?= base_url('p/tambah_barang_suplier') ?>">Data Pembelian Supplier</a></li>
                  <li class="<? if($this->uri->segment(2) == 'data_karyawan'){echo'active';}else{} ?>"><a href="<?= base_url('p/data_karyawan') ?>">Data User</a></li>
                <? }else{} ?>
                </ul>
              </li>
            <?php } ?>
              <li class="<? if($this->uri->segment(1) == 'buku_umum'){echo'active';}else{} ?>"><a href="<?= base_url(); ?>buku_umum">Buku Umum <span class="sr-only">(current)</span></a></li>
              <!-- ////////////////////////////////////////////////////////////////// -->
              <?
              if($this->ion_auth->is_admin()){
              ?>
              <li class="<? if($this->uri->segment(2) == 'list_hutang_penjualan'){echo'active';}elseif($this->uri->segment(2) == 'pembayaran_hutang_penjualan'){echo'active';}else{} ?> dropdown">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown">Hutang Penjualan <span class="caret"></span></a>
                <ul class="dropdown-menu" role="menu">
                  <li class="<? if($this->uri->segment(2) == 'list_hutang_penjualan'){echo'active';}else{} ?>"><a href="<?= base_url('kasir/list_hutang_penjualan') ?>">Daftar Hutang Penjualan</a></li>
                  <li class="<? if($this->uri->segment(2) == 'pembayaran_hutang_penjualan'){echo'active';}else{} ?>"><a href="<?= base_url('kasir/pembayaran_hutang_penjualan') ?>">Pembayaran Hutang Penjualan</a></li>
                </ul>
              </li>
              <li class="<? if($this->uri->segment(2) == 'list_hutang_pembelian'){echo'active';}elseif($this->uri->segment(2) == 'pembayaran_hutang_pembelian'){echo'active';}else{} ?> dropdown">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown">Hutang Pembelian <span class="caret"></span></a>
                <ul class="dropdown-menu" role="menu">
                  <li class="<? if($this->uri->segment(2) == 'list_hutang_pembelian'){echo'active';}else{} ?>"><a href="<?= base_url('p/list_hutang_pembelian') ?>">Daftar Hutang Pembelian</a></li>
                  <li class="<? if($this->uri->segment(2) == 'pembayaran_hutang_pembelian'){echo'active';}else{} ?>"><a href="<?= base_url('p/pembayaran_hutang_pembelian') ?>">Pembayaran Hutang Pembelian</a></li>
                </ul>
              </li>
            <li class="<? if($this->uri->segment(1) == 'lr_internal_seragam'){echo'active';}elseif($this->uri->segment(1) == 'penjualan_intern_all'){echo'active';}elseif($this->uri->segment(1) == 'penjualan_belanja_barang'){echo'active';}elseif($this->uri->segment(1) == 'penjualan_tunai'){echo'active';}elseif($this->uri->segment(1) == 'penjualan_kredit'){echo'active';}elseif($this->uri->segment(1) == 'Penjualan_barang_konsinyasi'){echo'active';}elseif($this->uri->segment(1) == 'penjualan_barang_konsinyasi' && $this->uri->segment(2) == 'kredit'){echo'active';}elseif($this->uri->segment(1) == 'jasa_fotocopy_print'){echo'active';}elseif($this->uri->segment(1) == 'jasa_fotocopy_print' && $this->uri->segment(2) == 'kredit'){echo'active';}elseif($this->uri->segment(1) == 'jasa_penjilidan'){echo'active';}elseif($this->uri->segment(1) == 'jasa_penjilidan' && $this->uri->segment(2) == 'kredit'){echo'active';}else{} ?> dropdown">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown">Laba Rugi <span class="caret"></span></a>
                <ul class="dropdown-menu" role="menu">
                  <li class="<? if($this->uri->segment(1) == 'lr_internal_seragam'){echo'active';}else{} ?>"><a href="<?= base_url('lr_internal_seragam') ?>">Laba Rugi Internal Seragam</a></li>
                  <li class="<? if($this->uri->segment(1) == 'penjualan_intern_all'){echo'active';}else{} ?>"><a href="<?= base_url('penjualan_intern_all') ?>">Penjualan Internal Toko</a></li>
                  <li class="<? if($this->uri->segment(1) == 'penjualan_belanja_barang'){echo'active';}else{} ?>"><a href="<?= base_url('penjualan_belanja_barang') ?>">Penjualan Belanja Barang Toko</a></li>
                  <li class="<? if($this->uri->segment(1) == 'penjualan_tunai'){echo'active';}else{} ?>"><a href="<?= base_url('penjualan_tunai') ?>">Penjualan Barang Toko Tunai</a></li>
                  <li class="<? if($this->uri->segment(1) == 'penjualan_kredit'){echo'active';}else{} ?>"><a href="<?= base_url('penjualan_kredit') ?>">Penjualan Barang Toko Kredit</a></li>
                  <li class="<? if($this->uri->segment(1) == 'Penjualan_barang_konsinyasi' && $this->uri->segment(2) == ''){echo'active';}else{} ?>"><a href="<?= base_url('Penjualan_barang_konsinyasi') ?>">Penjualan Barang Konsinyasi Tunai</a></li>
                  <li class="<? if($this->uri->segment(1) == 'Penjualan_barang_konsinyasi' && $this->uri->segment(2) == 'kredit'){echo'active';}else{} ?>"><a href="<?= base_url('Penjualan_barang_konsinyasi/kredit') ?>">Penjualan Barang Konsinyasi Kredit</a></li>
                  <li class="<? if($this->uri->segment(1) == 'jasa_fotocopy_print' && $this->uri->segment(2) == ''){echo'active';}else{} ?>"><a href="<?= base_url('jasa_fotocopy_print') ?>">Jasa Fotocopy Print Tunai</a></li>
                  <li class="<? if($this->uri->segment(1) == 'jasa_fotocopy_print' && $this->uri->segment(2) == 'kredit'){echo'active';}else{} ?>"><a href="<?= base_url('jasa_fotocopy_print/kredit') ?>">Jasa Fotocopy Print Kredit</a></li>
                  <li class="<? if($this->uri->segment(2) == 'jasa_penjilidan' && $this->uri->segment(2) == ''){echo'active';}else{} ?>"><a href="<?= base_url('jasa_penjilidan') ?>">Jasa Penjilidan Tunai</a></li>
                  <li class="<? if($this->uri->segment(1) == 'jasa_penjilidan' && $this->uri->segment(2) == 'kredit'){echo'active';}else{} ?>"><a href="<?= base_url('jasa_penjilidan/kredit') ?>">Jasa Penjilidan Kredit</a></li>
                </ul>
              </li>
              <li class="<? if($this->uri->segment(2) == 'grafik_omzet_penjualan'){echo'active';}elseif($this->uri->segment(2) == 'laporan_rekap_laba'){echo'active';}elseif($this->uri->segment(2) == 'grafik_jumlah_transaksi_penjualan'){echo'active';}elseif($this->uri->segment(2) == 'masuk'){echo'active';}elseif($this->uri->segment(2) == 'cash_flow'){echo'active';}else{} ?> dropdown">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown">Laporan<span class="caret"></span></a>
                <ul class="dropdown-menu" role="menu">
                  <li class="<? if($this->uri->segment(2) == 'grafik_omzet_penjualan'){echo'active';}else{} ?>"><a href="<?= base_url('grafik/grafik_omzet_penjualan') ?>">Grafik Omzet Penjualan</a></li>
                  <li class="<? if($this->uri->segment(2) == 'laporan_rekap_laba'){echo'active';}else{} ?>"><a href="<?= base_url('grafik/laporan_rekap_laba') ?>">Grafik Laba Penjualan</a></li>
                  <li class="<? if($this->uri->segment(2) == 'grafik_jumlah_transaksi_penjualan'){echo'active';}else{} ?>"><a href="<?= base_url('grafik/grafik_jumlah_transaksi_penjualan') ?>">Grafik Jumlah Transaksi</a></li>
                  <li class="<? if($this->uri->segment(2) == 'masuk'){echo'active';}else{} ?>"><a href="<?= base_url('laporan_kas/masuk') ?>">Laporan Kas Masuk</a></li>
                  <li class="<? if($this->uri->segment(2) == 'keluar'){echo'active';}else{} ?>"><a href="<?= base_url('laporan_kas/keluar') ?>">Laporan Kas Keluar</a></li>
                  <li class="<? if($this->uri->segment(2) == 'cash_flow'){echo'active';}else{} ?>"><a href="<?= base_url('laporan_kas/cash_flow') ?>">Laporan Kas (Cash Flow)</a></li>
                  <li class="<? if($this->uri->segment(2) == 'cash_flow'){echo'active';}else{} ?>"><a href="<?= base_url('online') ?>">Kirim Database Penjualan</a></li>
                </ul>
              </li>
            <?php }else{} ?>
              <?
              if($this->ion_auth->is_admin()){
              ?>
              <li class="<? if($this->uri->segment('1') == 'buku_anggota'){echo'active';}elseif($this->uri->segment('2') == 'buku_bank'){echo'active';} ?> dropdown">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown">Buku Bank<span class="caret"></span></a>
                <ul class="dropdown-menu" role="menu">
                  <li><a href="<?= base_url('p/buku_bank') ?>"> Kas Toko </a></li>
                  <li><a href="<?= base_url('buku_anggota/view') ?>"> Kas Anggota </a></li>
                </ul>
              </li>
            <? }else{} ?>
            <?php } ?>
          </ul>
        </div>
        <? } ?>
        <div class="navbar-custom-menu">
          <ul class="nav navbar-nav">
            <li class="dropdown user user-menu">
              <a href="" class="dropdown-toggle" data-toggle="dropdown">
                <img src="<?= base_url() ?>assets_kasir/img/user.png" class="user-image">
                <span class="hidden-xs"></span>
              </a>
              <ul class="dropdown-menu">
                  <a href="<?= base_url() ?>auth/logout" class="btn btn-danger btn-block btn-flat">Keluar</a>
              </ul>
            </li>
          </ul>
        </div>
      </div>
    </nav>
  </header>
