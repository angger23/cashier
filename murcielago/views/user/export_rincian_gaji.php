<?php
header("Content-Disposition: attachment; filename=Buku_Umum_Rincian_gaji.xls");
header("Expires: 0");
header("Pragma: ");
header("Cache-Control: ");
 ?>
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
  <script type="text/javascript" src="<?php echo base_url() ?>assets/moment/moment.js"></script>
  <script type="text/javascript" src="<?php echo base_url() ?>assets/datepickertime/build/js/bootstrap-datetimepicker.min.js"></script>

  <link rel="stylesheet" type="text/css" href="<?php echo base_url() ?>assets/datepickertime/build/css/bootstrap-datetimepicker.min.css">

  <link href="https://fonts.googleapis.com/css?family=Montserrat" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<link href="<?php echo base_url() ?>assets/select2/select2.css" rel="stylesheet">
  <link href="<?php echo base_url() ?>assets/select2/select2.min.css" rel="stylesheet">
    <script src="<?php echo base_url() ?>assets/js/rupiah.js"></script>
<!--
  <link href="<?php echo base_url() ?>assets/select2/select2.css" rel="stylesheet">
  <link href="<?php echo base_url() ?>assets/select2/select2.min.css" rel="stylesheet">
  <link href="<?php echo base_url() ?>assets/css/font-awesome.css" rel="stylesheet">
-->
<!--   <link rel="stylesheet" type="text/css" href="<?php echo base_url() ?>assets/css/jquery.dataTables.css">
  <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.16/css/dataTables.bootstrap.min.css"> -->
    <!-- datatable -->

  <link rel="stylesheet" type="text/css" href="<?php echo base_url() ?>assets/datatable/datatables.css">

  <link rel="stylesheet" type="text/css" href="<?php echo base_url() ?>assets/datatable/buttons.dataTables.min.css">


</head>
<body style="border-collapse: collapse;">
  <table class="table table-bordered datatable-biasa" border="1" width="100%">
    <thead>
      <tr>
        <th rowspan="2" style="vertical-align:middle;text-align:center">No</th>
        <th rowspan="2" style="vertical-align:middle;text-align:center">Nama</th>
        <th rowspan="2" style="vertical-align:middle;text-align:center">Status Pegawai</th>
        <th rowspan="2" style="vertical-align:middle;text-align:center">Status Keanggotaan</th>
        <th rowspan="2" style="vertical-align:middle;text-align:center">NIK</th>
        <th rowspan="2" style="vertical-align:middle;text-align:center">Unit</th>
        <th rowspan="2" style="vertical-align:middle;text-align:center">Jabatan</th>
        <th rowspan="2"></th>
        <?php
        if(!empty($tgl)){ ?>
          <th colspan="6" style="vertical-align:middle;text-align:center">Rincian Potongan Gaji <?php echo date('d-m-Y',strtotime($tgl)) ?> - <?php echo date('d-m-Y',strtotime($tgl1)) ?></th>

        <?php }else{ ?>
        <th colspan="6" style="vertical-align:middle;text-align:center">Rincian Potongan Gaji</th>
      <?php } ?>
      </tr>
      <tr>
        <th style="text-align:center">Simpanan Pokok</th>
        <th style="text-align:center">Simpanan Wajib</th>
        <th style="text-align:center">Angsuran Pokok Pinjaman Uang Tunai</th>
        <th style="text-align:center">Angsuran Bunga Pinjaman Uang Tunai</th>
        <th style="text-align:center">Angsuran Pinjaman Toko</th>
        <th style="text-align:center">Jumlah Potongan Gaji</th>
      </tr>
    </thead>
    <tbody>
      <?php
      $cari_anggota = $this->m_data->semua('anggota_terbaru_2018')->result();
      $nos=0;
      foreach($cari_anggota as $c){
      $nos++;
       ?>
      <tr>
        <td><?php echo $nos ?></td>
        <td><?php echo $c->nama_anggota ?></td>
        <td><?php echo $c->status_pegawai ?></td>
        <td><?php echo $c->status_keanggotaan ?></td>
        <td><?php echo $c->nik ?></td>
        <td><?php echo $c->unit ?></td>
        <td><?php echo $c->jabatan ?></td>
        <td></td>
        <?php
        if(!empty($tgl)){
          $cari_rincian_hutang = $this->m_data->piutang_kas_anggota3($tgl,$tgl1,$c->id_anggota)->result();
          $cari_rincian_hutang2 = $this->m_data->piutang_kas_anggota3($tgl,$tgl1,$c->id_anggota)->row();
        }else{
          $cari_rincian_hutang = $this->m_data->piutang_kas_anggota2(date('Y-m'),$c->id_anggota)->result();
          $cari_rincian_hutang2 = $this->m_data->piutang_kas_anggota2(date('Y-m'),$c->id_anggota)->row();
        }
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
         <td>Rp <?php echo (empty($cari_rincian_hutang2)) ? '0' : number_format($cari_simpanan_pokok->simpanan_pokok)  ?></td>
         <td>Rp <?php echo (empty($cari_rincian_hutang2)) ? '0' : number_format($cari_simpanan_wajib->simpanan_wajib) ?></td>
         <td>Rp <?php echo (empty($cari_rincian_hutang2)) ? '0' : number_format($pokok); ?></td>
         <td>Rp <?php echo (empty($cari_rincian_hutang2)) ? '0' : number_format($bunga); ?></td>
         <td></td>
         <td>Rp <?php echo (empty($cari_rincian_hutang2)) ? '0' : number_format($pokok+$bunga+$cari_simpanan_pokok->simpanan_pokok+$cari_simpanan_wajib->simpanan_wajib)?></td>
      </tr>
    <?php } ?>

    </tbody>
  </table>

<!-- ///////////////////////////////////////////////////////////////////////////////////////////////// -->
<script src="<?php echo base_url() ?>assets/select2/select2.min.js"></script>
<script src="<?php echo base_url() ?>assets/select2/select2.full.min.js"></script>
    <!-- datatable -->
<script type="text/javascript" src="<?php echo base_url() ?>assets/datatable/datatables.js"></script>
<script type="text/javascript" src="<?php echo base_url() ?>assets/datatable/buttons.html5.min.js"></script>
<script type="text/javascript" src="<?php echo base_url() ?>assets/datatable/buttons.print.min.js"></script>
<script type="text/javascript" src="<?php echo base_url() ?>assets/datatable/dataTables.buttons.min.js"></script>
<script type="text/javascript" src="<?php echo base_url() ?>assets/datatable/jszip.min.js"></script>
<script type="text/javascript" src="<?php echo base_url() ?>assets/datatable/pdfmake.min.js"></script>
<script type="text/javascript" src="<?php echo base_url() ?>assets/datatable/vfs_fonts.js"></script>

<script type="text/javascript">
    $(document).ready(function(){
        $('.datatable').DataTable( {
        dom: 'Bfrtip',
        buttons: [
            'copyHtml5',
            'excelHtml5',
            'csvHtml5',
            'pdfHtml5',
            'print'
        ]
        });
    });
</script>

<script>
$(document).ready(function() {
    $('#example').DataTable();
} );
</script>
<script>
        $(function(){
            $("#select2").select2();
        });
        $(function(){
            $("#select1").select2();
        });
        $(function(){
            $("#select3").select2();
        });
          $(function(){
            $(".selectku").select2();
        });
        </script>
  <!-- /Calendar -->
  </body>
  </html>
