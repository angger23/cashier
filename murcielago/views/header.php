<!DOCTYPE html>
<html lang="en">
<head>
  <!-- Theme Made By www.w3schools.com - No Copyright -->
  <title>STIKES-Mart</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="apple-mobile-web-app-capable" content="yes">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
  <script type="text/javascript" src="<?php echo url_css() ?>assets/moment/moment.js"></script>
  <script type="text/javascript" src="<?php echo url_css() ?>assets/datepickertime/build/js/bootstrap-datetimepicker.min.js"></script>

  <link rel="stylesheet" type="text/css" href="<?php echo url_css() ?>assets/datepickertime/build/css/bootstrap-datetimepicker.min.css">

  <link href="https://fonts.googleapis.com/css?family=Montserrat" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<link href="<?php echo url_css() ?>assets/select2/select2.css" rel="stylesheet">
  <link href="<?php echo url_css() ?>assets/select2/select2.min.css" rel="stylesheet">
    <script src="<?php echo url_css() ?>assets/js/rupiah.js"></script>
<!--
  <link href="<?php echo base_url() ?>assets/select2/select2.css" rel="stylesheet">
  <link href="<?php echo base_url() ?>assets/select2/select2.min.css" rel="stylesheet">
  <link href="<?php echo base_url() ?>assets/css/font-awesome.css" rel="stylesheet">
-->
<!--   <link rel="stylesheet" type="text/css" href="<?php echo base_url() ?>assets/css/jquery.dataTables.css">
  <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.16/css/dataTables.bootstrap.min.css"> -->
    <!-- datatable -->

  <link rel="stylesheet" type="text/css" href="<?php echo url_css() ?>assets/datatable/datatables.css">

  <link rel="stylesheet" type="text/css" href="<?php echo url_css() ?>assets/datatable/buttons.dataTables.min.css">


  <style type="text/css">
    .dataTables_wrapper .dataTables_filter input {
        margin-left: 0.5em;
        border: 1px solid #ccc;
        padding: 4px 8px;
        border-radius: 4px;
        outline: none;
    }
  </style>

  <script type="text/javascript">
  $(document).ready(function(){
    $('.datepicker').datetimepicker({
      format: 'YYYY-MM-DD'
    });

  });
</script>
<script type="text/javascript">
  $(document).ready(function(){

    $('.timepicker').datetimepicker({
      format: 'HH:mm'
    });

  });
</script>

  <script src="<?php echo base_url() ?>assets/js/highcharts.js"></script>
    <style type="text/css">
      .select2-container--default .select2-selection--single {
    background-color: #fff;
    border: 1px solid #cecece;
    border-radius: 4px;
    padding: 8px 1px;
    color: #f3f3f3;
}

.select2-container .select2-selection--single {
    box-sizing: border-box;
    cursor: pointer;
    display: block;
    height: 34px;
    user-select: none;
    -webkit-user-select: none;
}
    </style>
  <style>
  *{
    margin:0;
    padding: 0;
  }
  .bg-1 {
      background-color: #1abc9c; /* Green */
      color: #ffffff;
  }
  .bg-2 {
      background-color: #474e5d; /* Dark Blue */
      color: #ffffff;
  }
  .bg-3 {
      background-color: #ffffff; /* White */
      color: #555555;
  }
  .bg-4 {
      background-color: #2f2f2f; /* Black Gray */
      color: #fff;
  }
      .list-group-horizontal .list-group-item {
    display: inline-block;
}
.list-group-horizontal .list-group-item {
    margin-bottom: 0;
    margin-left:-4px;
    margin-right: 0;
    border-right-width: 0;
}
.list-group-horizontal .list-group-item:first-child {
    border-top-right-radius:0;
    border-bottom-left-radius:4px;
}
.list-group-horizontal .list-group-item:last-child {
    border-top-right-radius:4px;
    border-bottom-left-radius:0;
    border-right-width: 1px;
}
  ul.topnav {
    list-style-type: none;
    margin: 0;
    padding: 0;
    overflow: hidden;
    background-color: #fff;
    border-bottom: 1px solid #d6d6d6;
}

ul.topnav li {float: left;}

ul.topnav li a, .dropbtn {
    display: inline-block;
    color: white;
    text-align: center;
    padding: 22px;
    text-decoration: none;
    color: #2ecc71;
}

ul.topnav li a:hover:not(.active), .dropdown1:hover .dropbtn {
  background-color: #e9e9e9;
  color: #000;
}


li.dropdown1 {
    display: inline-block;
}

.dropdown-content1 {
    display: none;
    position: absolute;
    background-color: #f9f9f9;
    min-width: 160px;
    box-shadow: 0px 8px 16px 0px rgba(0,0,0,0.2);
    z-index: 1;
    margin-left: -70px;
}

.dropdown-content1 a.ho {
    color: black;
    padding: 12px 16px;
    text-decoration: none;
    display: block;
    text-align: left;
}

.dropdown-content1 a:hover {background-color: #f1f1f1}

.dropdown1:hover .dropdown-content1 {
    display: block;
}

ul.topnav li a.active {background-color: #e9e9e9;}

ul.topnav li.right {float: right;}

@media screen and (max-width: 600px){
    ul.topnav li.right,
    ul.topnav li {float: none;}
}
      .navbar-custom {
	background-color:#fff;
    color:#000;
  	border-radius:0;
          border-bottom: 1px solid #d6d6d6;
}

.navbar-custom .navbar-nav > li > a {
  	color:#000;
}

.navbar-custom .navbar-nav > .active > a {
    color: #000;
	background-color:#e9e9e9;
}
.navbar-custom .navbar-nav > .no > a {
    color: #000;
	background-color:#e74c3c;
}

.navbar-custom .navbar-nav > li > a:hover,
.navbar-custom .navbar-nav > li > a:focus,
.navbar-custom .navbar-nav > .active > a:hover,
.navbar-custom .navbar-nav > .active > a:focus,
.navbar-custom .navbar-nav > .open >a {
    text-decoration: none;
    background-color: #e9e9e9;
    color: #2ecc71;
}

.navbar-custom .navbar-brand {
  	color:#000;
}
.navbar-custom .navbar-toggle {
  	background-color:#eeeeee;
}
.navbar-custom .icon-bar {
  	background-color:#33aa33;
}
      .dropdown-submenu {
    position: relative;
}

.dropdown-submenu>.dropdown-menu {
    top: 0;
    left: 100%;
    margin-top: -6px;
    margin-left: -1px;
    -webkit-border-radius: 0 6px 6px 6px;
    -moz-border-radius: 0 6px 6px;
    border-radius: 0 6px 6px 6px;
}

.dropdown-submenu:hover>.dropdown-menu {
    display: block;
}

.dropdown-submenu>a:after {
    display: block;
    content: " ";
    float: right;
    width: 0;
    height: 0;
    border-color: transparent;
    border-style: solid;
    border-width: 5px 0 5px 5px;
    border-left-color: #ccc;
    margin-top: 5px;
    margin-right: -10px;
}

.dropdown-submenu:hover>a:after {
    border-left-color: #fff;
}

.dropdown-submenu.pull-left {
    float: none;
}

.dropdown-submenu.pull-left>.dropdown-menu {
    left: -100%;
    margin-left: 10px;
    -webkit-border-radius: 6px 0 6px 6px;
    -moz-border-radius: 6px 0 6px 6px;
    border-radius: 6px 0 6px 6px;
}
  </style>
</head>
<body>
<div class="navbar navbar-static-top" style="background: #2ecc71 !important;margin-bottom:0;height:100px;padding:10px;">
  <div class="navbar-inner">
      <a class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse"><span class="icon-bar"></span><span class="icon-bar"></span><span class="icon-bar"></span> </a><a class="brand" href="<?php echo base_url() ?>"><img src="<?php echo base_url() ?>assets/img/logo/logo-stikes3.png" width="250px"></a>
      <!--/.nav-collapse -->
    <!-- /container -->
  </div>
  <!-- /navbar-inner -->
</div>
<nav class="navbar navbar-default navbar-custom">
  <div class="container-fluid">
  <div class="navbar-header">
    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
      <span class="sr-only">Toggle navigation</span>
      <span class="icon-bar"></span>
      <span class="icon-bar"></span>
      <span class="icon-bar"></span>
    </button>
  </div>
  <div class="collapse navbar-collapse">
    <?php echo $this->ion_auth->in_group() ?>
	  <?php if($this->ion_auth->in_group(3)){ ?>
	 	<ul class="nav navbar-nav">
	  		<li class="active"><a href="<?php echo base_url() ?>"><i class="fa fa-money"></i> Kasir</a></li>
        <li><a href="<?php echo base_url() ?>kasir/data_penjualan"><i class="fa fa-tag"></i> Data Penjualan</a></li>

	  	</ul>
      <?php }elseif($this->ion_auth->in_group(2)){ ?>
       <ul class="nav navbar-nav">
    <li><a href="<?php echo base_url() ?>kasir/data_penjualan"><i class="fa fa-tag"></i> Data Penjualan</a></li>
    <li><a href="<?php echo base_url() ?>pembelian"><i class="fa fa-cart-plus"></i> Pembelian Barang</a></li>
        <?php
            $data['hox'] = $this->m_data->cek_persediaan2()->result();
        ?>
    <li <?php if(!empty($data['hox'])){ echo 'class="no"';}else{} ?>><a href="<?php echo base_url() ?>kasir/persediaan_barang"><i class="fa fa-cubes"></i> Persedian Barang</a></li>
    <li><a href="<?php echo base_url() ?>data_kasir/supplier"><i class="fa fa-users"></i> Data Supplier</a></li>
    <li><a href="<?php echo base_url() ?>kas"><i class="fa fa-users"></i> Data Kas</a></li>
           <li>
        <a href="#" class="dropdown-toggle" data-toggle="dropdown"><b class="fa fa-file-pdf-o"></b> Laporan <span class="caret"></span></a>
        <ul class="dropdown-menu multi-level">
            <li><a href="<?php echo base_url(); ?>laporan/laporan_pembelian">Laporan Pembelian</a></li>
            <li><a href="<?php echo base_url(); ?>laporan/laporan_penjualan">Laporan Penjualan</a></li>
            <li class="dropdown-submenu">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown">Grafik</a>
                <ul class="dropdown-menu">
                    <li><a href="<?php echo base_url() ?>laporan/omzet_penjualan">Grafik Omzet Penjualan</a></li>
                    <li><a href="<?php echo base_url() ?>kasir/rekap_laba_perbulan">Grafik Laba Penjualan</a></li>
                    <li><a href="<?php echo base_url(); ?>laporan/grafik_transaksi">Grafik Jumlah Transaksi Penjualan</a></li>
                </ul>
            </li>
            <li><a href="<?php echo base_url() ?>laporan/laporan_data_barang">Laporan Data Master</a></li>
            <li class="dropdown-submenu">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown">Laporan In Out</a>
                <ul class="dropdown-menu">
                    <li><a href="<?php echo base_url() ?>laporan/laporan_barang_masuk">Laporan Barang Masuk</a></li>
                    <li><a href="<?php echo base_url() ?>laporan/laporan_barang_keluar">Laporan Barang Keluar</a></li>
                    <li><a href="<?php echo base_url(); ?>laporan/laporan_in_out">Laporan Barang Keluar Masuk</a></li>
                </ul>
            </li>
            <li class="dropdown-submenu">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown">Laporan Lainnya</a>
                <ul class="dropdown-menu">
                    <li><a href="<?php echo base_url() ?>laporan/data_pembeli">Laporan Data Pembeli</a></li>
                    <li><a href="<?php echo base_url() ?>laporan/rating_barang">Laporan Rating Barang</a></li>
                </ul>
            </li>
        </ul>
        </li>
    </ul>
	  <?php }else{ ?>
	  <ul class="nav navbar-nav">
      <li class="active"><a href="<?php echo base_url() ?>"><i class="fa fa-money"></i> Kasir</a></li>
    <li><a href="<?php echo base_url() ?>kasir/data_penjualan"><i class="fa fa-tag"></i> Data Penjualan</a></li>

    <style type="text/css">
    .dropdown-menu{
      padding: 0px;
    }
      .dropdown-menu > li > a{
        padding:11px 10px;
      }
      .dropdown-menu > li{
        width: 174px;
      }
    </style>

    <li class="dropdown">
        <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-cart-plus"></i> Pembelian Barang <span class="caret"></span> </a>
        <ul class="dropdown-menu pull-right">
          <li><a href="<?php echo base_url() ?>pembelian"> Pembelian Barang</a></li>
          <li><a href="<?php echo base_url(); ?>pembelian/tambah_barang_suplier">Tambah Barang Suplier</a></li>
        </ul>
      </li>
        <?php
            $data['hox'] = $this->m_data->cek_persediaan2()->result();
        ?>
    <li <?php if(!empty($data['hox'])){ echo 'class="no"';}else{} ?>><a href="<?php echo base_url() ?>kasir/persediaan_barang"><i class="fa fa-cubes"></i> Persedian Barang</a></li>
    <li><a href="<?php echo base_url() ?>data_kasir/supplier"><i class="fa fa-users"></i> Data Supplier</a></li>
    <li><a href="<?php echo base_url() ?>kas"><i class="fa fa-users"></i> Data Kas</a></li>
           <li>
        <a href="#" class="dropdown-toggle" data-toggle="dropdown"><b class="fa fa-file-pdf-o"></b> Laporan <span class="caret"></span></a>
        <ul class="dropdown-menu multi-level">
            <li><a href="<?php echo base_url(); ?>laporan/laporan_pembelian">Laporan Pembelian</a></li>
            <li><a href="<?php echo base_url(); ?>laporan/laporan_penjualan">Laporan Penjualan</a></li>
            <li class="dropdown-submenu">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown">Grafik</a>
                <ul class="dropdown-menu">
                    <li><a href="<?php echo base_url() ?>laporan/omzet_penjualan">Grafik Omzet Penjualan</a></li>
                    <li><a href="<?php echo base_url() ?>kasir/rekap_laba_perbulan">Grafik Laba Penjualan</a></li>
                    <li><a href="<?php echo base_url(); ?>laporan/grafik_transaksi">Grafik Jumlah Transaksi Penjualan</a></li>
                </ul>
            </li>
                        <li><a href="<?php echo base_url() ?>laporan/laporan_data_barang">Laporan Data Master</a></li>
            <li class="dropdown-submenu">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown">Laporan Kas</a>
                <ul class="dropdown-menu">
                    <li><a href="<?php echo base_url() ?>laporan/laporan_kas_masuk">Laporan Kas Masuk</a></li>
                    <li><a href="<?php echo base_url() ?>laporan/laporan_kas_keluar">Laporan Kas Keluar</a></li>
                    <li><a href="<?php echo base_url() ?>laporan/laporan_rekap_kas">Laporan Kas (Cash Flow)</a></li>
                </ul>
            </li>
            <li class="dropdown-submenu">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown">Laporan In Out</a>
                <ul class="dropdown-menu">
                    <li><a href="<?php echo base_url() ?>laporan/laporan_barang_masuk">Laporan Barang Masuk</a></li>
                    <li><a href="<?php echo base_url() ?>laporan/laporan_barang_keluar">Laporan Barang Keluar</a></li>
                    <li><a href="<?php echo base_url(); ?>laporan/laporan_in_out">Laporan Barang Keluar Masuk</a></li>
                </ul>
            </li>
            <li class="dropdown-submenu">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown">Laporan Lainnya</a>
                <ul class="dropdown-menu">
                    <li><a href="<?php echo base_url() ?>laporan/data_pembeli">Laporan Data Pembeli</a></li>
                    <li><a href="<?php echo base_url() ?>laporan/rating_barang">Laporan Rating Barang</a></li>
                    <li><a href="<?php echo base_url(); ?>laporan/laporan_laba_kotor">Laporan Laba Kotor</a></li>
                </ul>
            </li>
        </ul>
        </li>
        <li class="dropdown">
        <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-cogs"></i> Lain - Lain <span class="caret"></span> </a>
        <ul class="dropdown-menu pull-right">
          <li><a href="<?= base_url('p/kategori') ?>">Tambah Kategori Barang</a></li>
          <li><a href="<?= base_url('p/jenis_barang') ?>">Tambah Jenis Barang</a></li>
          <li><a href="#">Tambah Satuan Barang</a></li>
        </ul>
      </li>
    </ul>
	  <?php } ?>

	  <?php if($this->ion_auth->logged_in()){ ?>
    <ul class="nav navbar-nav navbar-right">
      <li class="dropdown">
        <a href="#" class="dropdown-toggle" data-toggle="dropdown">Pengaturan Akun <span class="caret"></span> </a>
        <ul class="dropdown-menu pull-right">
            <?php if($this->ion_auth->in_group(3)){ ?>

            <?php }elseif($this->ion_auth->in_group(2)){ ?>

            <?php }else{ ?>
              <li><a href="<?php echo base_url(); ?>data_kasir/pembeli">Tambah Pembeli</a></li>
              <li><a href="<?php echo base_url(); ?>auth/create_user">Tambah Karyawan</a></li>
               <?php  } ?>
          <li><a href="<?php echo base_url(); ?>auth/logout">Logout</a></li>
        </ul>
      </li>
    </ul>
	  <?php }else{} ?>
  </div>
  </div>
</nav>
