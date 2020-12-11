<?php
defined('BASEPATH') OR exit('No direct script access allowed');

  class Bank_buku extends CI_Controller{
    function __construct(){
    		parent::__construct();
    				$this->load->model('m_data');
            $this->load->helper('url');
            $this->load->model('ion_auth_model');
            $this->load->model('m_other');
    	    if(!$this->ion_auth->logged_in()){
    				redirect("auth/login");
    			}
    	}

      function export_buku($stat = null,$stat1 = null,$idne = null){
        (is_null($stat)) ? $tgl='' : $tgl = $stat;
        (is_null($stat1)) ? $tg1l='' : $tgl1 = $stat1;
        (is_null($idne)) ? $id='' : $id = $idne;
        header("Content-type: application/vnd-ms-excel");
        header("Content-Disposition: attachment; filename=Buku_Bank_kas_toko_All.xls");
        header("Pragma: no-cache");
        header("Expires: 0");
        $list_bank_toko = $this->m_data->list_bank_toko($tgl,$tgl1,$id,'','Kas Toko')->result();
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
              <th>Nama Bank</th>
              <th>Tanggal</th>
              <th>Kode</th>
              <th>Uraian Kode</th>
              <th>Keterangan</th>
              <th>Pengeluaran</th>
              <th>Pemasukan</th>
              <th>Hasil</th>
              <th>Saldo</th>
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
          <td>'.$l->nama_bank.'</td>
          <td>'.date('d-m-Y',strtotime($l->tanggal)).'</td>
          <td>'.$l->kode.'</td>
          <td>'.$l->uraian_kode.'</td>
          <td>'.$l->uraian.'</td>
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

      function cetak_buku($stat = null,$stat1 = null,$idne = null){
        (is_null($stat)) ? $tgl='' : $tgl = $stat;
        (is_null($stat1)) ? $tgl1='' : $tgl1 = $stat1;
        (is_null($idne)) ? $id='' : $id = $idne;
        $list_bank_toko = $this->m_data->list_bank_toko($tgl,$tgl1,$id,'','Kas Toko')->result();
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
                            <th>Nama Bank</th>
                            <th>Tanggal</th>
                            <th>Kode</th>
                            <th>Uraian Kode</th>
                            <th>Keterangan</th>
                            <th>Pengeluaran</th>
                            <th>Pemasukan</th>
                            <th>Hasil</th>
                            <th>Saldo</th>
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
          <td>'.$l->nama_bank.'</td>
          <td>'.date('d-m-Y',strtotime($l->tanggal)).'</td>
          <td>'.$l->kode.'</td>
          <td>'.$l->uraian_kode.'</td>
          <td>'.$l->uraian.'</td>
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
        </div>
    </div>
    </div>
    </section>
    </div>
        ';

      }

      function export_buku1($stat,$stat1,$idne,$kode,$aturan){
        ($stat == 0) ? $tgl='' : $tgl = $stat;
        ($stat1 == 0) ? $tg1l='' : $tgl1 = $stat1;
        ($idne == 0) ? $id='' : $id = $idne;
        $cari_kode = $this->m_data->where('kode_transaksi',array('kode' => $kode,'status' => 'Kas Toko'))->row();
        header("Content-type: application/vnd-ms-excel");
        header("Content-Disposition: attachment; filename=".$cari_kode->uraian_kode.".xls");
        header("Pragma: no-cache");
        header("Expires: 0");
        $list_bank_toko = $this->m_data->list_bank_toko($tgl,$tgl1,$id,$kode,'Kas Toko')->result();
        if($kode == 'BABKT'){
          echo '
          <html>
          <head>
            <title></title>
          </head>
          <body style="border:1px solid #ccc;border-collapse: collapse;">';

          $no=0;
          $sal=0;
          $kredit=0;
          $debit=0;
          foreach($list_bank_toko as $l){
           $no++;
           $salq = $l->debit - $l->kredit;
         if($no==1){
               $sal=$salq;
            }else{
          $sal = $salq - $sal ;
            }
           $kre[$no] = $l->kredit;
           $de[$no] = $l->debit;
           $debit += $de[$no];
           $kredit += $kre[$no];
          }
          echo '
          <div class="col-md-12">
             <p style="padding:5px 10px;background-color:#ffbe76;"><b>Saldo</b> : <b>Rp. '.number_format($debit).' </b></p>
          </div>
          <table class="table table-bordered" border="1" width="100%">
            <thead>
              <tr>
                <th>No</th>
                <th>Nama Bank</th>
                <th>Tanggal</th>
                <th>Kode</th>
                <th>Uraian Kode</th>
                <th>Keterangan</th>
                <th>Pengeluaran (Debit)</th>
                <th>Pemasukan (Kredit)</th>
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
            <td>'.$l->nama_bank.'</td>
            <td>'.date('d-m-Y',strtotime($l->tanggal)).'</td>
            <td>'.$l->kode.'</td>
            <td>'.$l->uraian_kode.'</td>
            <td>'.$l->uraian.'</td>
            <td>Rp '.number_format($l->debit).'</td>
            <td>Rp '.number_format($l->kredit).'</td> ';
            if($aturan == 'tambah'){
              $salq =  $l->debit - $l->kredit;
            }else{
              $salq =  $l->kredit - $l->debit;
            }
            echo '
            ';
            if($no==1){
               $sal=$salq;
            }else{
              if($aturan == 'tambah'){

          $sal = $salq - $sal ;
        }else{
          $sal = $salq + $sal ;

        }
            }
            //echo number_format($sal);

             echo '

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
            <td>Rp '.number_format($debit).'</td>
            <td>Rp  '.number_format($kredit).'</td>
          </tr>
          </tbody>
        </table>
        </body>
        </html>
          ';
        }else{
          echo '
          <html>
          <head>
            <title></title>
          </head>
          <body style="border:1px solid #ccc;border-collapse: collapse;">';

          $no=0;
          $sal=0;
          $kredit=0;
          $debit=0;
          foreach($list_bank_toko as $l){
           $no++;
           if($aturan == 'tambah'){
             $salq =  $l->debit - $l->kredit;
           }else{
             $salq =  $l->kredit - $l->debit;
           }
           if($no==1){
              $sal=$salq;
           }else{
             if($aturan == 'tambah'){

         $sal = $salq + $sal ;
       }else{
         $sal = $salq - $sal ;

       }
           }
           $kre[$no] = $l->kredit;
           $de[$no] = $l->debit;
           $debit += $de[$no];
           $kredit += $kre[$no];
          }
          if($kode == 'PBBKT'){
            $saldo = $kredit;
          }elseif($kode == 'STKT'){
            $saldo = $kredit;
          }elseif($kode == 'TMKT'){
            $saldo = $kredit;
          }elseif($kode == 'TKKT'){
            $saldo = $debit;
          }elseif($kode == 'TTKT'){
            $saldo = $debit;
          }elseif($kode == 'SBBBKT'){
            $saldo = $sal;
          }elseif($kode == 'SBBYLKT'){
            $saldo = $kredit;
          }
          echo '
          <div class="col-md-12">
             <p style="padding:5px 10px;background-color:#ffbe76;"><b>Saldo</b> : <b>Rp. '.number_format($saldo).' </b></p>
          </div>
          <table class="table table-bordered" border="1" width="100%">
            <thead>
              <tr>
                <th>No</th>
                <th>Nama Bank</th>
                <th>Tanggal</th>
                <th>Kode</th>
                <th>Uraian Kode</th>
                <th>Keterangan</th>
                <th>Pengeluaran (Debit)</th>
                <th>Pemasukan (Kredit)</th>';
                if($kode == 'SBBBKT'){
                  echo '
                  <th>Hasil</th>
                  <th>Saldo</th>
                  ';
                }
                echo  '
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
            <td>'.$l->nama_bank.'</td>
            <td>'.date('d-m-Y',strtotime($l->tanggal)).'</td>
            <td>'.$l->kode.'</td>
            <td>'.$l->uraian_kode.'</td>
            <td>'.$l->uraian.'</td>
            <td>Rp '.number_format($l->debit).'</td>
            <td>Rp '.number_format($l->kredit).'</td> ';
            if($kode == 'SBBBKT'){
                $salq =  $l->kredit - $l->debit;
              if($no==1){
                 $sal=$salq;
              }else{
            $sal = $salq + $sal ;
        }

              echo '
              <td>Rp '.number_format($salq).'</td>
              <td>Rp '.number_format($sal).' </td>
              ';
          }
            if($aturan == 'tambah'){
              $salq =  $l->debit - $l->kredit;
            }else{
              $salq =  $l->kredit - $l->debit;
            }
            // echo '
            //
            // <td>Rp ';
            if($no==1){
               $sal=$salq;
            }else{
              if($aturan == 'tambah'){

          $sal = $salq + $sal ;
        }else{
          $sal = $salq - $sal ;

        }
            }
            //echo number_format($sal);

             echo '

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
            <td>Rp '.number_format($debit).'</td>
            <td>Rp '.number_format($kredit).'</td>';
            if($kode == 'SBBBKT'){
              echo '<td colspan="3">Rp '.number_format($sal).'</td>';
            }
            echo  '
          </tr>
          </tbody>
        </table>
        </body>
        </html>
          ';
        }

      }

      function cetak_buku1($stat,$stat1,$idne,$kode,$aturan){
        ($stat == 0) ? $tgl='' : $tgl = $stat;
        ($stat1 == 0) ? $tgl1='' : $tgl1 = $stat1;
        ($idne == 0) ? $id='' : $id = $idne;
        $cari_kode = $this->m_data->where('kode_transaksi',array('kode' => $kode,'status' => 'Kas Toko'))->row();
        $list_bank_toko = $this->m_data->list_bank_toko($tgl,$tgl1,$id,$kode,'Kas Toko')->result();
        echo '
        <title>'.$cari_kode->uraian_kode.'</title>
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
                  <h3 style="margin: 0px;" class="pull-left"><b>Penjualan Belanja Barang Toko - '.$cari_kode->uraian_kode.'</b><br>
                  Jl. Letkol Istiqlah No.109, Mojopanggung, Kec. Banyuwangi, Kabupaten Banyuwangi, Jawa Timur 68422</h3>

                </div>
                <div class="col-md-12"><hr></div>
        ';

        echo '
        </section>

        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-12"> ' ;
                    $no=0;
                    $sal=0;
                    $kredit=0;
                    $debit=0;
                    foreach($list_bank_toko as $l){
                     $no++;
                     if($aturan == 'tambah'){
                       $salq =  $l->debit - $l->kredit;
                     }else{
                       $salq =  $l->kredit - $l->debit;
                     }
                     if($no==1){
                        $sal=$salq;
                     }else{
                       if($aturan == 'tambah'){

                   $sal = $salq + $sal ;
                 }else{
                   $sal = $salq - $sal ;

                 }
                     }
                     $kre[$no] = $l->kredit;
                     $de[$no] = $l->debit;
                     $debit += $de[$no];
                     $kredit += $kre[$no];
                    }
                    if($kode == 'PBBKT'){
                      $saldo = $kredit;
                    }elseif($kode == 'STKT'){
                      $saldo = $kredit;
                    }elseif($kode == 'TMKT'){
                      $saldo = $kredit;
                    }elseif($kode == 'TKKT'){
                      $saldo = $debit;
                    }elseif($kode == 'TTKT'){
                      $saldo = $debit;
                    }elseif($kode == 'SBBBKT'){
                      $saldo = $sal;
                    }elseif($kode == 'SBBYLKT'){
                      $saldo = $kredit;
                    }elseif($kode == 'BABKT'){
                      $saldo = $debit;
                    }
                    echo '
                    <div class="col-md-12">
                       <p style="padding:5px 10px;background-color:#ffbe76;"><b>Saldo</b> : <b>Rp. '.number_format($saldo).' </b></p>
                    </div>
                    <table class="table table-bordered">
                      <thead>
                        <tr>
                          <th>No</th>
                          <th>Nama Bank</th>
                          <th>Tanggal</th>
                          <th>Kode</th>
                          <th>Uraian Kode</th>
                          <th>Keterangan</th>
                          <th>Pengeluaran (Debit)</th>
                          <th>Pemasukan (Kredit)</th>';
                          if($kode == 'SBBBKT'){
                            echo '
                            <th>Hasil</th>
                            <th>Saldo</th>
                            ';
                          }
                          echo  '
                        </tr>
                      </thead>
                      <tbody>';
                      $no=0;
                      $sal=0;
                      $kredit=0;
                      $debit=0;
                      foreach($list_bank_toko as $l):
                      $no++;
                      echo '
                      <tr>
                        <td>'.$no.'</td>
                        <td>'.$l->nama_bank.'</td>
                        <td>'.date('d-m-Y',strtotime($l->tanggal)).'</td>
                        <td>'.$l->kode.'</td>
                        <td>'.$l->uraian_kode.'</td>
                        <td>'.$l->uraian.'</td>
                        <td>Rp '.number_format($l->debit).'</td>
                        <td>Rp '.number_format($l->kredit).'</td> ';
                        if($kode == 'SBBBKT'){
                            $salq =  $l->kredit - $l->debit;
                          if($no==1){
                             $sal=$salq;
                          }else{
                        $sal = $salq + $sal ;
                    }

                          echo '
                          <td>Rp '.number_format($salq).'</td>
                          <td>Rp '.number_format($sal).' </td>
                          ';
                      }
                        if($aturan == 'tambah'){
                          $salq =  $l->debit - $l->kredit;
                        }else{
                          $salq =  $l->kredit - $l->debit;
                        }
                        // echo '
                        //
                        // <td>Rp ';
                        if($no==1){
                           $sal=$salq;
                        }else{
                          if($aturan == 'tambah'){

                      $sal = $salq + $sal ;
                    }else{
                      $sal = $salq - $sal ;

                    }
                        }
                        //echo number_format($sal);

                         echo '

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
                        <td>Rp '.number_format($debit).'</td>
                        <td>Rp '.number_format($kredit).'</td>';
                        if($kode == 'SBBBKT'){
                          echo '<td colspan="3">Rp '.number_format($sal).'</td>';
                        }
                        echo  '
                      </tr>
                      </tbody>
                    </table>';
      echo '
        </div>
    </div>
    </div>
    </section>
    </div>
        ';

      }

  }
