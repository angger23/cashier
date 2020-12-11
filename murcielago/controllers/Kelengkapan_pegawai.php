<?php

defined('BASEPATH') OR exit('No direct script access allowed');



class Kelengkapan_pegawai extends CI_Controller{

     function __construct(){

		parent::__construct();

		$this->load->model('m_data');

        $this->load->helper('url');

		$this->load->model('ion_auth_model');

        $this->load->model('m_data');

         if(!$this->ion_auth->logged_in()){

			redirect("auth/login");

		}

	}



    function view(){

      $data['title'] = 'Kelengkapan Pegawai';

        $data['user_ion'] = $this->ion_auth->user()->row();

        $data['kelengkapan'] = $this->m_other->kelengkapan_pegawai('JSPKA')->result();

    		if($this->uri->segment(3) == 'ac'){

          $data['kelengkapan'] = $this->m_other->kelengkapan_pegawai('JSPKA',$this->input->post('start_tgl'),$this->input->post('end_tgl'))->result();

    		}else{

          $data['kelengkapan'] = $this->m_other->kelengkapan_pegawai('JSPKA')->result();

    		}

    		$this->load->view('user/header',$data);

    		$this->load->view('user/pdptn_pjualn_kelengkapan_pegawai',$data);

    		$this->load->view('user/footer');

    }



    function cetak_buku($stat = null,$stat1 = null){

      (is_null($stat)) ? $tgl='' : $tgl = $stat;

      (is_null($stat1)) ? $tgl1='' : $tgl1 = $stat1;

      $list_bank_toko = $this->m_other->kelengkapan_pegawai('JSPKA',$this->input->post('start_tgl'),$this->input->post('end_tgl'))->result();

      echo '

      <title>Buku Bank Kas Toko All</title>

      <body onload="window.print();window.close();"> ';

      $this->load->view('user/css_print');

    echo '<div class="container-fluid" style="height: 100%;">

          <section class="content-header h-h1">

              <div class="col-md-4">

                  <h1 class="img-logo">

                      <img src="'.base_url().'/assets_kasir/img/logo_kasir_warna.png">&nbsp;&nbsp;<i class="fa fa-desktop"></i>

                  </h1>

              </div>

              <div class="col-md-8">

                <h3 style="margin: 0px;" class="pull-left"><b>Penjualan Belanja Barang Toko - Buku Bank Kas Toko</b><br>

                Jl. Letkol Istiqlah No.109, Mojopanggung, Kec. Banyuwangi, Kabupaten Banyuwangi, Jawa Timur 68422</h3>



              </div>

              <div class="col-md-12"><hr></div>

      ';



      echo '

      </section>



      <section class="content">

          <div class="container-fluid">

              <div class="row">

                  <div class="col-md-12">

                      <table class="table table-striped table-bordered datatable-biasa">

                      <thead>

                        <tr>

                          <th>No</th>

                          <th>Sumber Dana</th>

                          <th>Tanggal</th>

                          <th>Kode</th>

                          <th>Uraian Kode</th>

                          <th>Keterangan</th>

                          <th>Debit</th>

                          <th>Kredit</th>

                          <th>Saldo</th>

                          <th>Aksi</th>

                        </tr>

                      </thead>

                      <tbody>

      ';



      $no=0;

      $sal=0;

      $kredit=0;

      $debit=0;

      foreach($list_bank_toko as $l):

      $no++;

      echo '

      <tr>

        <td>'.$no.'</td>

        <td>'.$l->uraian_kode.'</td>

        <td>'.date('d-m-Y',strtotime($l->tanggal)).'</td>

        <td>'.$l->kode.'</td>

        <td>'.$l->uraian_kode.'</td>

        <td>'.$l->keterangan.'</td>

        <td>Rp '.number_format($l->kredit).'</td>

        <td>Rp '.number_format($l->debit).'</td> ';

        $salq =  $l->kredit - $l->debit;

        echo '

        <td>Rp '.number_format($salq).'</td>

        <td>Rp ';

        if($no==1){

           $sal=$salq;

        }else{

      $sal = $salq + $sal ;

        }

        echo number_format($sal);



         echo '

         </td>

        </tr>

         ';

         $kre[$no] = $l->kredit;

         $de[$no] = $l->debit;

         $debit += $de[$no];

         $kredit += $kre[$no];

      endforeach;

      echo '

      <tr>

        <td colspan="6"><b>Total</b></td>

        <td>Rp '.number_format($kredit).'</td>

        <td>Rp  '.number_format($debit).'</td>

        <td colspan="2" style="vertical-align:middle;">Rp '.number_format($sal).' </td>

      </tr>

      </tbody>

    </table>

      </div>

  </div>

  </div>

  </section>

  </div>

      ';



    }



    function export_buku($stat = null,$stat1 = null){

      (is_null($stat)) ? $tgl='' : $tgl = $stat;

      (is_null($stat1)) ? $tg1l='' : $tgl1 = $stat1;

      header("Content-type: application/vnd-ms-excel");

      header("Content-Disposition: attachment; filename=Buku_Bank_kas_toko_All.xls");

      header("Pragma: no-cache");

      header("Expires: 0");

      $list_bank_toko = $this->m_other->kelengkapan_pegawai('JSPKA',$tgl,$tgl1)->result();

      echo '

      <html>

      <head>

        <title></title>

      </head>

      <body style="border:1px solid #ccc;border-collapse: collapse;">

      <table class="table table-bordered" border="1" width="100%">

        <thead>

        <tr>

          <th>No</th>

          <th>Sumber Dana</th>

          <th>Tanggal</th>

          <th>Kode</th>

          <th>Uraian Kode</th>

          <th>Keterangan</th>

          <th>Debit</th>

          <th>Kredit</th>

          <th>Saldo</th>

          <th>Aksi</th>

        </tr>

        </thead>

        <tbody>

      ';

      $no=0;

      $sal=0;

      $kredit=0;

      $debit=0;

      foreach($list_bank_toko as $l):

      $no++;

      echo '

      <tr>

        <td>'.$no.'</td>

        <td>'.$l->uraian_kode.'</td>

        <td>'.date('d-m-Y',strtotime($l->tanggal)).'</td>

        <td>'.$l->kode.'</td>

        <td>'.$l->uraian_kode.'</td>

        <td>'.$l->keterangan.'</td>

        <td>Rp '.number_format($l->kredit).'</td>

        <td>Rp '.number_format($l->debit).'</td> ';

        $salq =  $l->kredit - $l->debit;

        echo '

        <td>Rp '.number_format($salq).'</td>

        <td>Rp ';

        if($no==1){

           $sal=$salq;

        }else{

      $sal = $salq + $sal ;

        }

        echo number_format($sal);



         echo '

         </td>

        </tr>

         ';

         $kre[$no] = $l->kredit;

         $de[$no] = $l->debit;

         $debit += $de[$no];

         $kredit += $kre[$no];

      endforeach;

      echo '

      <tr>

        <td colspan="6"><b>Total</b></td>

        <td>Rp '.number_format($kredit).'</td>

        <td>Rp  '.number_format($debit).'</td>

        <td colspan="2">Rp '.number_format($sal).' </td>

      </tr>

      </tbody>

    </table>

    </body>

    </html>

      ';

    }



}

