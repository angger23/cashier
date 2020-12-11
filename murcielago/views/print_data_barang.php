<!DOCTYPE html>
<html lang="en">
<head>
  <!-- Theme Made By www.w3schools.com - No Copyright -->
  <title>STIKES-Mart</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="apple-mobile-web-app-capable" content="yes">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" media="all">
<!--
  <link href="https://fonts.googleapis.com/css?family=Montserrat" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
-->
<!--
  <link href="<?php echo base_url() ?>assets/select2/select2.css" rel="stylesheet">
  <link href="<?php echo base_url() ?>assets/select2/select2.min.css" rel="stylesheet">
  <link href="<?php echo base_url() ?>assets/css/font-awesome.css" rel="stylesheet">
-->
  <link rel="stylesheet" type="text/css" href="<?php echo base_url() ?>assets/css/jquery.dataTables.css" media="all">
  <link rel="stylesheet" type="text/css" href="<?php echo base_url() ?>assets/css/dataTables.bootstrap.css" media="all">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    
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
  .container-fluid {
      padding-top: 70px;
      padding-bottom: 70px;
  }
  .navbar {
      padding-top: 15px;
      padding-bottom: 15px;
      border: 0;
      border-radius: 0;
      margin-bottom: 0;
      font-size: 12px;
      letter-spacing: 5px;
  }
  .navbar-nav  li a:hover {
      color: #1abc9c !important;
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
  </style>
</head>
<body onload="window.print();" style="margin:50px;">
<img src="<?php echo base_url() ?>assets/img/logo/logo-stikes3.png" width="250px">
    <br>
    <br>
<div class="row">
    <div class="container">
        <table class="table table-bordered">
                <thead>
                  <tr>
                    <th>No</th>
                    <th>Nama Barang</th>
                    <th>Harga Pokok</th>
                    <th>Stok</th>
                    <th>Total Harga</th>
                    <th>Kode Barang</th>
                    <th>Max Pembelian Diskon</th>
                    <th>Diskon</th>
                    <th>Tanggal Pembelian</th>
                    <th>Nama Supplier</th>
                    <th>Status Barang</th>
                    <th>Tanggal Kadaluarsa</th>
                  </tr>
                </thead>
                <tbody>
                    <?php 
                    $no=0; 
                    foreach($data_barang as $data){
                    $no++;
                    ?>
                  <tr>
                    <td><?php echo $no ?></td>
                    <td><?php echo $data['nama_barang']; ?></td>
                    <td>Rp <?php echo number_format($data['harga_pokok']); ?></td>
                    <td><?php echo $data['jumlah_beli'] ?></td>
                    <td>Rp <?php echo number_format($data['total_harga']); ?></td>
                    <td><?php echo $data['kode_barang'] ?></td>
                    <td><?php echo $data['kelipatan']; ?></td>
                    <td><?php echo $data['diskon'] ?> % </td>
                    <td><?php echo date("d-m-Y", strtotime($data['tanggal_pembelian'])); ?></td>
                    <td><?php echo $data['nama_supplier']; ?></td>
                    <td><?php $tgl_now=date("Y-m-d");
                        if($data['expierd'] == $tgl_now){ echo 'Kadaluarsa'; }else{ echo 'Barang Belum Kadaluarsa';} ?></td>
                    <td><?php if(empty($data['expierd'])){}elseif($data['expierd'] == 'NULL'){}else{ echo date("d-m-Y", strtotime($data['expierd']));} ?></td>
                    </tr>
                    <?php } ?>
                </tbody>
            </table>
    </div>
</div>
</body>
</html>