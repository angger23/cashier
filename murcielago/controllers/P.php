<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class P extends CI_Controller {
function __construct(){
    parent::__construct();
        $this->load->model('m_data');
        $this->load->helper('url');
        $this->load->model('ion_auth_model');
        $this->load->model('m_other');
        $this->load->library('Ajax_pagination');
        $this->perPage = 10;
      if(!$this->ion_auth->logged_in()){
        redirect("auth/login");
      }
  }
  private function code_number2() {
      $gpass = NULL;
      $n = 4; // jumlah karakter yang akan di bentuk.
      $chr = "ABCDEFGHIJKLMNOPQRSTUVWUXYZ0123456789";
      for ($i = 0; $i < $n; $i++) {
      $rIdx = rand(1, strlen($chr));
      $gpass .=substr($chr, $rIdx, 1);
      }
      return $gpass;
  }

  public function tester(){
    $semua = $this->m_data->semua('penjualan_sementara')->result();
    foreach($semua as $s){
      $ha= $s->harga * $s->satuan;
      $data = array(
        'harga_hasil' => $ha,
      );
      $this->m_data->update_data(array('kode_barang' => $s->kode_barang),$data,'penjualan_sementara');
      // echo $s->satuan." ".$s->harga." ".$ha."<br>";
        // $cari_barang = $this->m_data->where('barang',array('kode_barang' => $s->kode_barang))->row();
        // if($cari_barang){
        //
        //   // echo $ha."<br>";
        // }else{}
    }
  }

  function import(){
      echo "
      <form method='post' action='".base_url('p/import_config_kurikulum')."' enctype='multipart/form-data'>
      <input type='file' name='file'>
      <button type='submit'>oke</button>
      </form>
      ";
    }
    function import_config_kurikulum(){
      $fileName = time().$_FILES['file']['name'];
       $config['upload_path'] = './assets/'; //buat folder dengan nama assets di root folder
       $config['file_name'] = $fileName;
       $config['allowed_types'] = 'xls|xlsx|csv';
       $config['max_size'] = 10000;
       $this->load->library('upload');
       $this->upload->initialize($config);
       if(! $this->upload->do_upload('file') )
       $this->upload->display_errors();
       $media = $this->upload->data('file');
       $inputFileName = './assets/'.$config['file_name'];
       try {
               $inputFileType = IOFactory::identify($inputFileName);
               $objReader = IOFactory::createReader($inputFileType);
               $objPHPExcel = $objReader->load($inputFileName);
           } catch(Exception $e) {
               die('Error loading file "'.pathinfo($inputFileName,PATHINFO_BASENAME).'": '.$e->getMessage());
           }
           $sheet = $objPHPExcel->getSheet(0);
           $highestRow = $sheet->getHighestRow();
           $highestColumn = $sheet->getHighestColumn();
           echo '<!DOCTYPE html>
           <html>
           <head>
           <style>
           table {
           font-family: arial, sans-serif;
           border-collapse: collapse;
           width: 100%;
           }
           td, th {
           border: 1px solid #dddddd;
           text-align: left;
           padding: 8px;
           }
           tr:nth-child(even) {
           background-color: #dddddd;
           }
           </style>
           </head>
           <body>
           <h2>HTML Table</h2>
           <table>
           <tr>
           <th>No</th>
           <th>Nama</th>
           <th>Status Pegawai</th>
           <th>Status Keanggotaan</th>
           <th>Unit</th>
           <th>Bulan Keanggotaan</th>
           <th>Simpanan Pokok</th>
           </tr>';
      $nos=0;
           for ($row = 1; $row <= $highestRow; $row++){
             $nos++;                  //  Read a row of data into an array
               $rowData = $sheet->rangeToArray('A' . $row . ':' . $highestColumn . $row,
                                               NULL,
                                               TRUE,
                                               FALSE);
                     $tgl_now = date('Y-m-d');
                     //  $data = array(
                     //     "kd_pelanggan"=> str_replace(" ","",$rowData[0][1]).$nos,
                     //     "nama_pembeli"=> $rowData[0][2],
                     //     "sumber_dana"=> $rowData[0][3],
                     //     "status_keanggotaan"=> $rowData[0][4],
                     //    "kode_pelanggan_baru" => $rowData[0][1],
                     //     "created"=> $tgl_now,
                     // );

                     //sesuaikan nama dengan nama tabel
                     // $insert = $this->db->insert("pembeli",$data);
              $excel_date = $rowData[0][4]; //here is that value 41621 or 41631
               $unix_date = ($excel_date - 25569) * 86400;
               $excel_date = 25569 + ($unix_date / 86400);
               $unix_date = ($excel_date - 25569) * 86400;
               // echo gmdate("Y-m-d", $unix_date);
               // $cari_kd = $this->m_data->where('kode_transaksi',array('kode' => $rowData[0][3]))->row();
               $nama_pembeli = $rowData[0][0].' : '.$rowData[0][3];
               $cari_pembeli  = $this->m_data->cari_pembeli($nama_pembeli)->row();
               if($cari_pembeli){
               echo '
               <tr>
               <td>'.$nos.'</td>
               <td>'.$cari_pembeli->kd_pembeli.'</td>
               <td>'.$rowData[0][1].'</td>
               <td>'.$rowData[0][2].'</td>
               <td>'.$rowData[0][3].'</td>
               <td>'.gmdate("d-m-Y", $unix_date).'</td>
               <td>'.$rowData[0][5].'</td>
               </tr>';
               $datax = array(
                 'id_pembeli' => $cari_pembeli->kd_pembeli,
                 'bulan_awal_keanggotaan' => gmdate("Y-m-d", $unix_date),
                 'simpanan_pokok' => $rowData[0][5],
                 'created' => date('Y-m-d'),
                 'created2' => date('Y-m-d H:i:s'),
               );
               $this->db->insert('simpanan_pokok',$datax);
             }else{
               // echo '
               // <tr>
               // <td>'.$nos.'</td>
               // <td>'.$cari_pembeli->kd_pembeli.'</td>
               // <td>'.$rowData[0][1].'</td>
               // <td>'.$rowData[0][2].'</td>
               // <td>'.$rowData[0][3].'</td>
               // <td>'.gmdate("d-m-Y", $unix_date).'</td>
               // <td>'.$rowData[0][5].'</td>
               // </tr>';
             }

              //  $datax = array(
              //    'kode_transaksi' => $cari_kd->kd_transaksi,
              //    'tanggal' => gmdate("Y-m-d", $unix_date),
              //    'keterangan' => $rowData[0][5],
              //    'debit' => $rowData[0][7],
              //    'kredit' => $rowData[0][6],
              //    'created' => date('Y-m-d H:i:s'),
              //    'id_user' => '1',
              //    'sumber_dana' => $rowData[0][1],
              //    'alat_bayar' => $rowData[0][4],
              //    'status_im' => date('Y-m-d'),
              //    'no_urut' => $rowData[0][0]
              //  );
              //  $this->db->insert('buku_umum',$datax);
               // delete_files($media['file_path']);
         //
          }
         //   echo '
         //
         //   </table>
         //
         //   </body>
         //   </html>';
       //redirect('bak/kurikulum_setting');
  }
  public function index(){
    $data['title'] = 'Kasir | Stikes Mart';
    $this->load->view('user/header',$data);
    $this->load->view('user/index');
    $this->load->view('user/footer');
  }
  public function daftar_kode(){
    $data['title'] = 'Kasir | Stikes Mart';
    $this->load->view('user/header',$data);
    $this->load->view('user/daftar_kode');
    $this->load->view('user/footer');
  }
  function add_new_kode(){
    $data = array(
      'kode' => $this->input->post('kd_transaksi'),
      'uraian_kode' => $this->input->post('uraian_kode'),
      'status' => $this->input->post('status_kode'),
    );
    $this->db->insert('kode_transaksi',$data);
    $this->session->set_flashdata('alert','<div class="alert alert-success alert-dismissible fade in">
    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
    <strong>Berhasil menambah data!</strong>
  </div>');
    redirect('p/daftar_kode');
  }
  function update_kode($kd){
    $data = array(
      'kode' => $this->input->post('kd_transaksi'),
      'uraian_kode' => $this->input->post('uraian_kode'),
      'status' => $this->input->post('status_kode'),
    );
    $this->m_data->update_data(array('kd_transaksi' => $kd),$data,'kode_transaksi');
    $this->session->set_flashdata('alert','<div class="alert alert-success alert-dismissible fade in">
    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
    <strong>Berhasil update data!</strong>
  </div>');
    redirect('p/daftar_kode');
  }
  function delete_kode($kd){
    $this->m_data->hapus_data(array('kd_transaksi' => $kd),'kode_transaksi');
    $this->session->set_flashdata('alert','<div class="alert alert-success alert-dismissible fade in">
    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
    <strong>Berhasil hapus data!</strong>
  </div>');
    redirect('p/daftar_kode');
  }
  public function verifikasi_tgl_penjualan(){
    $data['title'] = 'Manual Penjualan | Stikes Mart';
        $data['pembeli'] = $this->m_data->pembeli()->result_array();

    $data['user_ion'] = $this->ion_auth->user()->row();
    $this->load->view('user/header',$data);
    $this->load->view('user/verifikasi_tgl_penjualan');
    $this->load->view('user/footer');
  }
  private function update_data($where,$data,$table){
  $db2 =$this->load->database('second', TRUE);
    $db2->where($where);
    $db2->update($table,$data);
  }
  private function cek_verif(){
  $db2 =$this->load->database('second', TRUE);
    $query = $db2->get('verifikasi_tgl_penjualan');
    return $query->row();
  }
  function off_verif(){
    $cek_verif = $this->cek_verif();
    if($cek_verif->stat_verif == '1'){
      $stat = '1';
    }else{
      $stat = '0';
    }
    $this->m_data->update_data(array('id_verif' => '1'),array('stat_verif' => $stat),'verifikasi_tgl_penjualan');
    redirect('p/verifikasi_tgl_penjualan');
  }
  function verif(){
    $this->update_data(array('id_verif' => '1'),array('stat_verif' => $this->input->post('stat')),'verifikasi_tgl_penjualan');
    redirect('p/verifikasi_tgl_penjualan');
  }
  public function buku_bank(){

    $data['title'] = 'Buku Bank | Stikes Mart';
    $data['operator'] = $this->m_data->where('users',['id !=','1'])->result();
    $data['kode_transaksi'] = $this->m_data->where('kode_transaksi',array('status' => 'Kas Toko'))->result();
    if($this->uri->segment(3) == 'ac'){
    $data['list_bank_toko'] = $this->m_data->list_bank_toko($this->input->post('start_tgl'),$this->input->post('end_tgl'),$this->input->post('operator'),'','Kas Toko')->result();
    }else{
    $data['list_bank_toko'] = $this->m_data->list_bank_toko($this->input->post('start_tgl'),$this->input->post('end_tgl'),$this->input->post('operator'),'','Kas Toko')->result();
    }
    $this->load->view('user/header',$data);
    $this->load->view('user/buku_bank');
    $this->load->view('user/footer');

  }
  function load_buku2($stat = null,$stat1 = null,$op = null){
    (is_null($stat) || $stat == 0) ? $tgl='' : $tgl = $stat;
    (is_null($stat1) || $stat1 == 0) ? $tgl1='' : $tgl1 = $stat1;
    (is_null($op) || $op == 0) ? $id='' : $id = $op;
    $data['tgl'] = $tgl;
    $data['tgl1'] = $tgl1;
    $data['id'] = $id;
    $data['list_bank_toko1'] = $this->m_data->list_bank_toko($tgl,$tgl1,$id,'BABKT','Kas Toko')->result();
    $this->load->view('user/ajaxBuku2',$data);
  }
  function load_buku3($stat = null,$stat1 = null,$op = null){
    (is_null($stat)) ? $tgl='' : $tgl = $stat;
    (is_null($stat1)) ? $tgl1='' : $tgl1 = $stat1;
    (is_null($op)) ? $id='' : $id = $op;
    $data['tgl'] = $tgl;
    $data['tgl1'] = $tgl1;
    $data['id'] = $id;
    $data['list_bank_toko2'] = $this->m_data->list_bank_toko($tgl,$tgl1,$id,'PBBKT','Kas Toko')->result();
    $this->load->view('user/ajaxBuku3',$data);
  }
  function load_buku4($stat = null,$stat1 = null,$op = null){
    (is_null($stat)) ? $tgl='' : $tgl = $stat;
    (is_null($stat1)) ? $tgl1='' : $tgl1 = $stat1;
    (is_null($op)) ? $id='' : $id = $op;
    $data['tgl'] = $tgl;
    $data['tgl1'] = $tgl1;
    $data['id'] = $id;
    $data['list_bank_toko4'] = $this->m_data->list_bank_toko($tgl,$tgl1,$id,'STKT','Kas Toko')->result();
    $this->load->view('user/ajaxBuku4',$data);
  }
  function load_buku5($stat = null,$stat1 = null,$op = null){
    (is_null($stat)) ? $tgl='' : $tgl = $stat;
    (is_null($stat1)) ? $tgl1='' : $tgl1 = $stat1;
    (is_null($op)) ? $id='' : $id = $op;
    $data['tgl'] = $tgl;
    $data['tgl1'] = $tgl1;
    $data['id'] = $id;
    $data['list_bank_toko4'] = $this->m_data->list_bank_toko($tgl,$tgl1,$id,'TMKT','Kas Toko')->result();
    $this->load->view('user/ajaxBuku5',$data);
  }
  function load_buku6($stat = null,$stat1 = null,$op = null){
    (is_null($stat)) ? $tgl='' : $tgl = $stat;
    (is_null($stat1)) ? $tgl1='' : $tgl1 = $stat1;
    (is_null($op)) ? $id='' : $id = $op;
    $data['tgl'] = $tgl;
    $data['tgl1'] = $tgl1;
    $data['id'] = $id;
    $data['list_bank_toko4'] = $this->m_data->list_bank_toko($tgl,$tgl1,$id,'TKKT','Kas Toko')->result();
    $this->load->view('user/ajaxBuku6',$data);
  }
  function load_buku7($stat = null,$stat1 = null,$op = null){
    (is_null($stat)) ? $tgl='' : $tgl = $stat;
    (is_null($stat1)) ? $tgl1='' : $tgl1 = $stat1;
    (is_null($op)) ? $id='' : $id = $op;
    $data['tgl'] = $tgl;
    $data['tgl1'] = $tgl1;
    $data['id'] = $id;
    $data['list_bank_toko4'] = $this->m_data->list_bank_toko($tgl,$tgl1,$id,'TTKT','Kas Toko')->result();
    $this->load->view('user/ajaxBuku7',$data);
  }
  function load_buku8($stat = null,$stat1 = null,$op = null){
    (is_null($stat)) ? $tgl='' : $tgl = $stat;
    (is_null($stat1)) ? $tgl1='' : $tgl1 = $stat1;
    (is_null($op)) ? $id='' : $id = $op;
    $data['tgl'] = $tgl;
    $data['tgl1'] = $tgl1;
    $data['id'] = $id;
    $data['list_bank_toko4'] = $this->m_data->list_bank_toko($tgl,$tgl1,$id,'SBBBKT','Kas Toko')->result();
    $this->load->view('user/ajaxBuku8',$data);
  }
  function load_buku9($stat = null,$stat1 = null,$op = null){
    (is_null($stat)) ? $tgl='' : $tgl = $stat;
    (is_null($stat1)) ? $tgl1='' : $tgl1 = $stat1;
    (is_null($op)) ? $id='' : $id = $op;
    $data['tgl'] = $tgl;
    $data['tgl1'] = $tgl1;
    $data['id'] = $id;
    $data['list_bank_toko4'] = $this->m_data->list_bank_toko($tgl,$tgl1,$id,'SBBYLKT','Kas Toko')->result();
    $this->load->view('user/ajaxBuku9',$data);
  }
  function delete_buku($id){
    $this->m_data->hapus_data(array('id_buku' => $id),'buku_bank');
    $this->session->set_flashdata('alert','<div class="alert alert-success alert-dismissible">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                <h4><i class="icon fa fa-check"></i> Berhasil!</h4>
                Hapus Buku Bank Kas Toko
              </div>');
    redirect('p/buku_bank');
  }
  function tambah_data_buku(){

    $rx = $this->m_data->ordernyaq('no_urut','desc','buku_umum','Kas Toko')->row();
    $no_urut = $rx->no_urut + 1;

    $user_ion = $this->ion_auth->user()->row();
    $dataArr = [
      'nama_bank' => $this->input->post('nm_bank'),
      'kode_transaksi' => $this->input->post('kd_transaksi'),
      'tanggal' => $this->input->post('tanggal'),
      'uraian' => $this->input->post('uraian'),
      'debit' => (empty($this->input->post('debet'))) ? '0' : $this->input->post('debet'),
      'kredit' => (empty($this->input->post('kredit'))) ? '0' : $this->input->post('kredit'),
      'created' => date('Y-m-d H:i:s'),
      'status' => 'Kas Toko',
      'id_user' => $user_ion->id
    ];
    $this->db->insert('buku_bank',$dataArr);

    $dataUmum = array(
      'kode_transaksi' => $this->input->post('kd_transaksi'),
      'tanggal' => $this->input->post('tanggal'),
      'keterangan' => $this->input->post('uraian'),
      'id_user' => $user_ion->id,
      'sumber_dana' => 'Kas Toko',
      'created' => date('Y-m-d H:i:s'),
      'debit' => (empty($this->input->post('debet'))) ? '0' : $this->input->post('debet'),
      'kredit' => (empty($this->input->post('kredit'))) ? '0' : $this->input->post('kredit'),
			'alat_bayar' => 'Kas Di Bank Toko',
      'no_urut' => $no_urut
    );
    $this->db->insert('buku_umum',$dataUmum);

    if($this->input->post('kd_transaksi')=='4' || $this->input->post('kd_transaksi') == '129'){
$no_br =  $no_urut + 1;
      $dataUmum = array(
        'kode_transaksi' => '125',
        'tanggal' => $this->input->post('tanggal'),
        'keterangan' => $this->input->post('uraian'),
        'id_user' => $user_ion->id,
        'sumber_dana' => 'Kas Toko',
        'created' => date('Y-m-d H:i:s'),
        'debit' => (empty($this->input->post('kredit'))) ? '0' : $this->input->post('kredit'),
        'kredit' => (empty($this->input->post('debet'))) ? '0' : $this->input->post('debet'),
        'alat_bayar' => 'Kas di Bendahara Toko',
        'no_urut' => $no_br
      );
      $this->db->insert('buku_umum',$dataUmum);

    }


    if($this->input->post('kd_transaksi')=='1' || $this->input->post('kd_transaksi') == '128'){
$no_br =  $no_urut + 1;
      $dataUmum = array(
        'kode_transaksi' => '124',
        'tanggal' => $this->input->post('tanggal'),
        'keterangan' => $this->input->post('uraian'),
        'id_user' => $user_ion->id,
        'sumber_dana' => 'Kas Toko',
        'created' => date('Y-m-d H:i:s'),
        'debit' => (empty($this->input->post('kredit'))) ? '0' : $this->input->post('kredit'),
        'kredit' => (empty($this->input->post('debet'))) ? '0' : $this->input->post('debet'),
        'alat_bayar' => 'Kas di Bendahara Toko',
        'no_urut' => $no_br
      );
      $this->db->insert('buku_umum',$dataUmum);

    }



    $this->session->set_flashdata('alert','<div class="alert alert-success alert-dismissible">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                <h4><i class="icon fa fa-check"></i> Berhasil!</h4>
                Input Buku Bank Kas Toko
              </div>');

    redirect('p/buku_bank');
  }
  function update_data_buku($id){
    $dataArr = [
      'nama_bank' => $this->input->post('nm_bank'),
      'kode_transaksi' => $this->input->post('kd_transaksi'),
      'tanggal' => $this->input->post('tanggal'),
      'uraian' => $this->input->post('uraian'),
      'debit' => (empty($this->input->post('debet'))) ? '0' : $this->input->post('debet'),
      'kredit' => (empty($this->input->post('kredit'))) ? '0' : $this->input->post('kredit'),
    ];
    $this->m_data->update_data(array('id_buku' => $id),$dataArr,'buku_bank');
    $this->session->set_flashdata('alert','<div class="alert alert-success alert-dismissible">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                <h4><i class="icon fa fa-check"></i> Berhasil!</h4>
                Update Buku Bank Kas Toko
              </div>');
    redirect('p/buku_bank');
  }
  function update_buku1($nama_bank,$kode_transaksi,$tanggal,$uraian,$debet,$kredit,$id){
      $dataArr = [
        'nama_bank' => $nama_bank,
        'kode_transaksi' => $kode_transaksi,
        'tanggal' => $tanggal,
        'uraian' => $uraian,
        'debit' => (empty($debet)) ? '0' : $debet,
        'kredit' => (empty($kredit)) ? '0' : $kredit,
      ];
      $this->m_data->update_data(array('id_buku' => $id),$dataArr,'buku_bank');
      $this->session->set_flashdata('alert','<div class="alert alert-success alert-dismissible">
                  <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                  <h4><i class="icon fa fa-check"></i> Berhasil!</h4>
                  Update Buku Bank Kas Toko
                </div>');
                redirect('p/buku_bank');
    }
    public function tambah_barang(){
        $data['title'] = 'Kasir | STIKESMART';
        $data['user_ion'] = $this->ion_auth->user()->row();
        $data['kategori'] = $this->m_data->semua('kategori_barang')->result();
        $data['jenis'] = $this->m_data->semua('jenis_barang')->result();
        $data['satuan'] = $this->m_data->semua('satuan_barang')->result();
        $data['barang'] = $this->m_data->barang_suplier()->result();
        $data['suplier'] = $this->m_data->semua('supplier')->result();
        $dataku = array();
        //total rows count

        $totalRec = count($this->m_data->getRows());

        //pagination configuration
        $config['target']      = '.postList';
        $config['base_url']    = base_url().'p/ajaxPaginationData1';
        $config['total_rows']  = $totalRec;
        $config['per_page']    = $this->perPage;
        $config['link_func']   = 'searchFilter';
        $this->ajax_pagination->initialize($config);

        //get the posts data
        $dataku['posts'] = $this->m_data->getRows(array('limit'=>$this->perPage));
        $this->load->view('user/header',$data);
        $this->load->view('user/tambah_barang',$dataku);
        $this->load->view('user/footer');
    }
    function ajaxPaginationData1(){
    $conditions = array();

       //calc offset number
       $page = $this->input->post('page');
       if(!$page){
           $offset = 0;
       }else{
           $offset = $page;
       }

       //set conditions for search
       $keywords = $this->input->post('keywords');
       $sortBy = $this->input->post('sortBy');
       if(!empty($keywords)){
           $conditions['search']['keywords'] = $keywords;
       }
       if(!empty($sortBy)){
           $conditions['search']['sortBy'] = $sortBy;
       }

       //total rows count
       $totalRec = count($this->m_data->getRows($conditions));

       //pagination configuration
       $config['target']      = '.postList';
       $config['base_url']    = base_url().'p/ajaxPaginationData1';
       $config['total_rows']  = $totalRec;
       $config['per_page']    = $this->perPage;
       $config['link_func']   = 'searchFilter';
       $this->ajax_pagination->initialize($config);

       //set start and limit
       $conditions['start'] = $offset;
       $conditions['limit'] = $this->perPage;

       //get posts data
       $data['posts'] = $this->m_data->getRows($conditions);

       //load the view

       $this->load->view('user/ajaxPagination', $data, false);
  }
  function ajaxPaginationData12(){
    $conditions = array();

       //calc offset number
       $page = $this->input->post('page');
       if(!$page){
           $offset = 0;
       }else{
           $offset = $page;
       }

       //set conditions for search
       $keywords = $this->input->post('keywords');
       $sortBy = $this->input->post('sortBy');
       if(!empty($keywords)){
           $conditions['search']['keywords'] = $keywords;
       }
       if(!empty($sortBy)){
           $conditions['search']['sortBy'] = $sortBy;
       }

       //total rows count
       $totalRec = count($this->m_data->getRows2($conditions));

       //pagination configuration
       $config['target']      = '.postList';
       $config['base_url']    = base_url().'p/ajaxPaginationData12';
       $config['total_rows']  = $totalRec;
       $config['per_page']    = $this->perPage;
       $config['link_func']   = 'searchFilter';
       $this->ajax_pagination->initialize($config);

       //set start and limit
       $conditions['start'] = $offset;
       $conditions['limit'] = $this->perPage;

       //get posts data
       $data['posts'] = $this->m_data->getRows2($conditions);

       //load the view

       $this->load->view('user/ajaxPagination2', $data, false);
  }
  function ajaxPaginationData123(){
    $conditions = array();

       //calc offset number
       $page = $this->input->post('page');
       if(!$page){
           $offset = 0;
       }else{
           $offset = $page;
       }

       //set conditions for search
       $keywords = $this->input->post('keywords');
       $sortBy = $this->input->post('sortBy');
       if(!empty($keywords)){
           $conditions['search']['keywords'] = $keywords;
       }
       if(!empty($sortBy)){
           $conditions['search']['sortBy'] = $sortBy;
       }

       //total rows count
       $totalRec = count($this->m_data->getRows3($conditions));

       //pagination configuration
       $config['target']      = '.postList';
       $config['base_url']    = base_url().'p/ajaxPaginationData123';
       $config['total_rows']  = $totalRec;
       $config['per_page']    = $this->perPage;
       $config['link_func']   = 'searchFilter';
       $this->ajax_pagination->initialize($config);

       //set start and limit
       $conditions['start'] = $offset;
       $conditions['limit'] = $this->perPage;

       //get posts data
       $data['posts'] = $this->m_data->getRows3($conditions);

       //load the view

       $this->load->view('user/ajaxPagination3', $data, false);
  }
    function aksi_tambah_barang($id){
        $harga_beli_satuan = str_replace('.','',$this->input->post('harga_beli_satuan'));
        $harga_netto_beli_satuan = str_replace('.','',$this->input->post('harga_netto_beli_satuan'));
        $date = date('Y-m-d H:i:s');
        $tgl_expired = $this->input->post('tgl_ex');
        if(empty($tgl_expired)){
          $tanggal_expired = '';
        }else{
          $tanggal_expired = $this->input->post('tgl_ex');
        }
        $data['user_ion'] = $this->ion_auth->user()->row();
        $data = [
            'kd_jenis_barang' => $this->input->post('jenis'),
            'kd_kategori_barang' => $this->input->post('kategori'),
            'nama_barang' => $this->input->post('nama_barang'),
            'tanggal_expired' => $tanggal_expired,
            'satuan_barang' => $this->input->post('satuan'),
            'id_user' => $id,
            'kode_barang' => $this->input->post('kode_barang'),
            'created' => $date,
            'stock' => $this->input->post('stock'),
            'harga_netto_jual_satuan' => $this->input->post('hrg_jual'),
            'harga_pokok' => $this->input->post('harga_beli_satuan'),
            'kelipatan' => $this->input->post('kelipatan_diskon_satuan'),
            'diskon_beli_satuan_tbl_barang' => $this->input->post('diskon_beli_satuan_tbl_barang'),
            'harga_netto_beli_satuan' => $this->input->post('harga_netto_beli_satuan'),
        ];
        $this->m_data->input_data($data,'barang');
        $this->session->set_flashdata('alert','<div class="alert alert-success alert-dismissible fade in">
                     <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                    <strong>Berhasil </strong> Menambah Data.
                   </div>');
            redirect('p/tambah_barang');
    }
    function aksi_update_barang($id,$id_bar){
        $harga_beli = str_replace('.','',$this->input->post('harga_beli'));
        $harga_netto_beli = str_replace('.','',$this->input->post('netto'));
        $harga_pokok = str_replace('.','',$this->input->post('harga_pokok'));
        $date = date('Y-m-d H:i:s');
        $data['user_ion'] = $this->ion_auth->user()->row();
        $data = [
            'kd_jenis_barang' => $this->input->post('jenis'),
            'kd_kategori_barang' => $this->input->post('kategori'),
            'nama_barang' => $this->input->post('nama_barang'),
            'tanggal_expired' => $this->input->post('tgl_ex'),
            'satuan_barang' => $this->input->post('satuan'),
            'id_user' => $id,
            'kode_barang' => $this->input->post('kode_barang'),
            'created' => $date,
            'stock' => $this->input->post('stock'),
            'harga_pokok' => $this->input->post('harga_jual_satuan'),
            'harga_netto_jual_satuan' => $this->input->post('harga_netto_jual_satuan'),
            'kelipatan' => $this->input->post('kelipatan_diskon_satuan'),
            'diskon' => $this->input->post('diskon_jual_satuan'),
        ];
        $this->m_data->update_data(['id_barang' => $id_bar],$data,'barang');
        $this->session->set_flashdata('alert','<div class="alert alert-success alert-dismissible fade in">
                     <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                    <strong>Berhasil </strong> mengedit data.
                   </div>');
            redirect('p/tambah_barang');
    }
    function aksi_hapus_barang($id_bar){
        $this->m_data->hapus_data(['id_barang' => $id_bar],'barang');
        $this->session->set_flashdata('alert','<div class="alert alert-success alert-dismissible fade in">
                     <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                    <strong>Berhasil </strong> menghapus data.
                   </div>');
            redirect('p/tambah_barang');
    }
    function load_kode_barang($val = null){
        (is_null($val)) ? $var='' : $var=$val;
        $data['kode_barang'] = $this->m_data->load_kode_barang_data($val)->row();
        $data['user_ion'] = $this->ion_auth->user()->row();
        $this->load->view('user/load_kode_barang',$data);
    }
    function inputval(){
        $this->load->view('user/selectval');
    }
    function inputval1(){
        $this->load->view('user/selectval1');
    }
//    function load_kode($val = null){
//
//        (is_null($val)) ? $var='' : $var=$val;
//
//        $data['cek_kode'] = $this->m_data->cek_kode_barang($var)->row();
//
//        if(empty($data['cek_kode'])){
//            echo'<script>
//                $("#simpan_barang").removeAttr("disabled");
//            </script>';
//        }else{
//            echo '<div class="alert alert-warning alert-dismissible fade in" style="margin-top:10px;">
//                      <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
//                     <strong>Kode barang </strong> yang anda masukkan sudah ada.
//                    </div>';
//            echo'<script>
//                $("#simpan_barang").attr("disabled", "disabled");
//            </script>';
//        }
//    }
    function modal_load_kode_barang($kd_pem,$val){
        $data['kode_barang'] = $this->m_data->load_kode_barang_data($val)->row();
        $data['user_ion'] = $this->ion_auth->user()->row();
        $data['kd_pembelian'] = $this->m_data->where('pembelian_barang',['kd_pembelian' => $kd_pem])->row();
        $this->load->view('user/modal_load_kode_barang',$data);
    }
  public function kategori(){
    $data['kategori'] = $this->m_data->semua('kategori_barang')->result();
    $this->load->view('header',$data);
    $this->load->view('kategori');
    $this->load->view('footer');
  }
  public function pembelian(){
    $data['title'] = 'Kasir | Stikes Mart';
    $this->load->view('user/header',$data);
    $this->load->view('user/form_pembelian');
    $this->load->view('user/footer');
  }
  function tambah_kategori(){
    $data = [
      'kategori_barang' => $this->input->post('kategori'),
    ];
    $this->m_data->input_data($data,'kategori_barang');
    $this->session->set_flashdata('alert','<div class="alert alert-success alert-dismissible fade in">
                     <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                    <strong>Berhasil </strong> Menambah Data.
                   </div>');
        redirect('p/kategori');
  }
  function edit_kategori($id){
    $data = [
      'kategori_barang' => $this->input->post('kategori'),
    ];
    $this->m_data->update_data(['id_kategori' => $id],$data,'kategori_barang');
    $this->session->set_flashdata('alert','<div class="alert alert-success alert-dismissible fade in">
                     <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                    <strong>Berhasil </strong> Mengubah Data.
                   </div>');
        redirect('p/kategori');
  }
  function hapus_kategori($id){
    $base_64 = $id . str_repeat('=', strlen($id) % 4);
        $datax = base64_decode($base_64);
    $this->m_data->hapus_data(['id_kategori' => $datax],'kategori_barang');
    $this->session->set_flashdata('alert','<div class="alert alert-success alert-dismissible fade in">
                     <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                    <strong>Berhasil </strong> Menghapus Data.
                   </div>');
        redirect('p/kategori');
  }
  public function jenis_barang(){
    $data['jenis'] = $this->m_data->semua('jenis_barang')->result();
    $this->load->view('header',$data);
    $this->load->view('jenis_barang');
    $this->load->view('footer');
  }
  function tambah_jenis(){
    $data = [
      'jenis_barang' => $this->input->post('jenis'),
    ];
    $this->m_data->input_data($data,'jenis_barang');
    $this->session->set_flashdata('alert','<div class="alert alert-success alert-dismissible fade in">
                     <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                    <strong>Berhasil </strong> Menambah Data.
                   </div>');
        redirect('p/jenis_barang');
  }
  function edit_jenis($id){
    $data = [
      'jenis_barang' => $this->input->post('jenis'),
    ];
    $this->m_data->update_data(['id_jenis_barang' => $id],$data,'jenis_barang');
    $this->session->set_flashdata('alert','<div class="alert alert-success alert-dismissible fade in">
                     <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                    <strong>Berhasil </strong> Mengubah Data.
                   </div>');
        redirect('p/jenis_barang');
  }
  function hapus_jenis($id){
    $base_64 = $id . str_repeat('=', strlen($id) % 4);
        $datax = base64_decode($base_64);
    $this->m_data->hapus_data(['id_jenis_barang' => $datax],'jenis_barang');
    $this->session->set_flashdata('alert','<div class="alert alert-success alert-dismissible fade in">
                     <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                    <strong>Berhasil </strong> Menghapus Data.
                   </div>');
        redirect('p/jenis_barang');
  }
  public function supplier()
  {
        $data['user_ion'] = $this->ion_auth->user()->row();
        $data['rec'] = $this->m_data->daf_persediaan()->result_array();
        $data['sup'] = $this->m_data->supplier()->result_array();
        $data['title'] = 'Kasir | Stikes Mart';
    $this->load->view('user/header',$data);
    $this->load->view('user/suplier',$data);
    $this->load->view('user/footer');
  }
    public function simpan_supplier(){
       $data['user_ion'] = $this->ion_auth->user()->row();
        $data= array(
        'nama_supplier' => $this->input->post('nama_supplier'),
        'alamat_supplier' => $this->input->post('alamat_supplier'),
        );
        $this->m_data->input_data($data,'supplier');
        redirect('p/supplier');
    }
    public function update_supplier(){
    $data['user_ion'] = $this->ion_auth->user()->row();
       $where  = array(
       'kd_supplier' => $this->input->post('kd_supplier'),
       );
        $data= array(
        'nama_supplier' => $this->input->post('nama_supplier'),
        'alamat_supplier' => $this->input->post('alamat_supplier'),
        );
        $this->m_data->update_data($where,$data,'supplier');
        redirect('p/supplier');
    }
    public function pelanggan()
  {
        $data['user_ion'] = $this->ion_auth->user()->row();
        $data['pel'] = $this->m_data->pembeli()->result();
        $data['title'] = 'Kasir | Stikes Mart';
    $this->load->view('user/header',$data);
    $this->load->view('user/pelanggan');
    $this->load->view('user/footer');
  }
  public function simpan_pelanggan(){
       $data['user_ion'] = $this->ion_auth->user()->row();
        $data= array(
        'nama_pembeli' => $this->input->post('nama_pelanggan'),
        'kd_pelanggan' => 'PEM:'.$this->code_number2().''.date('Ymd').'',
        'kode_pelanggan_baru' => $this->input->post('kd_pelanggan'),
        );
        $this->m_data->input_data($data,'pembeli');
        redirect('p/pelanggan');
    }
    function hahax(){
      $data = $this->m_data->semua('pembeli')->result();
      $no=0;
      foreach($data as $d){
      $no++;
      $datax = array(
        // 'kd_pelanggan' => str_replace(" ","",$d->kd_pelanggan).$no
        'created' => date('Y-m-d H:i:s')
      );
      $this->m_data->update_data(array('kd_pembeli' => $d->kd_pembeli),$datax,'pembeli');
      }
    }
  public function update_pelanggan($id){
        $data= [
        'nama_pembeli' => $this->input->post('nama_pembeli'),
        'kode_pelanggan_baru' => $this->input->post('kd_pelanggan'),
        ];
        $this->m_data->update_data(['kd_pembeli' => $id],$data,'pembeli');
        redirect('p/pelanggan');
    }
    public function hapus_pembeli($id){
      $this->m_data->hapus_data(['kd_pembeli' => $id],'pembeli');
        redirect('p/pelanggan');
    }
    function delete_pem($id){
      $this->m_data->hapus_data(array('kd_pembelian' => $id),'pembelian_barang');
      $this->session->set_flashdata('alert','<div class="alert alert-success alert-dismissible fade in">
    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
    <strong>Sukses !</strong> Menghapus barang .
  </div>');
      redirect('p/tambah_barang_suplier');
    }
    function tambah_barang_suplier(){
        $data['user_ion'] = $this->ion_auth->user()->row();
        $data['kategori'] = $this->m_data->semua('kategori_barang')->result();
        $data['jenis'] = $this->m_data->semua('jenis_barang')->result();
        $data['satuan'] = $this->m_data->semua('satuan_barang')->result();
        $data['pembelian_barang'] = $this->m_other->pembelian_barang()->result();
        $data['suplier'] = $this->m_other->data_brg_sup()->result();
        $data['title'] = 'Form Pembelian | STIKESMART';
        $this->load->view('user/header',$data);
        $this->load->view('user/form_pembelian');
        $this->load->view('user/footer');
    }
    function export_pembelian_supplier(){
        $data['kategori'] = $this->m_data->semua('kategori_barang')->result();
        $data['jenis'] = $this->m_data->semua('jenis_barang')->result();
        $data['satuan'] = $this->m_data->semua('satuan_barang')->result();
        $data['pembelian_barang'] = $this->m_data->pembelian_barang()->result();
        $data['suplier'] = $this->m_data->semua('supplier')->result();
        $data['title'] = 'Form Pembelian | STIKESMART';
        $this->load->view('user/export_pembelian_supplier',$data);
    }
    function print_pembelian_supplier($op = null,$hr1 = null,$hr2 = null){
        (is_null($hr1)) ? $har1='' : $har1=$hr1;
        (is_null($hr2)) ? $har2='' : $har2=$hr2;
        (is_null($op)) ? $opt='' : $opt=$op;
        $data['har1'] = $har1;
        $data['har2'] = $har2;
        $data['opt'] = $opt;
//         echo $opt;
//        $data['opt'] = $this->m_data->cari_operator_pembelian($opt)->row();
//
//        echo $o = $data['opt']->id_users;
        $data['kategori'] = $this->m_data->semua('kategori_barang')->result();
        $data['jenis'] = $this->m_data->semua('jenis_barang')->result();
        $data['satuan'] = $this->m_data->semua('satuan_barang')->result();
        $data['pembelian_barang'] = $this->m_data->pembelian_barang()->result();
        $data['suplier'] = $this->m_data->semua('supplier')->result();
        $data['title'] = 'Form Pembelian | STIKESMART';
        $this->load->view('user/print_pembelian',$data);
    }
    function proses_tambah_barang_suplier($id){
        $harga_beli = str_replace('.','',$this->input->post('harga_beli_satuan'));
        $harga_netto_beli = str_replace('.','',$this->input->post('harga_netto_satuan'));
        $harga_pokok = str_replace('.','',$this->input->post('harga_pokok'));
        $diskon_beli_satuan = str_replace('.','',$this->input->post('diskon_beli_satuan'));
        $date = date('Y-m-d H:i:s');
        $bulan = date('m');
        $tahun = date('Y');
        $data['user_ion'] = $this->ion_auth->user()->row();
        $data['nama_pembeli'] = $this->m_data->where('users',['id' => $data['user_ion']->id])->row();
        $id =  $data['nama_pembeli']->id;
        $jumlah = $this->input->post('jumlah_beli') * $harga_beli;
        $diskon = $diskon_beli_satuan/100*($jumlah);
        (!empty($diskon_beli_satuan)) ? $total = $jumlah - $diskon : $total = $jumlah;
        $data2 = [
            'tanggal_pembelian' => $this->input->post('tgl_pem'),
            'kode_supplier' => $this->input->post('supplier'),
            'kode_barang' => $this->input->post('kode_barang'),
            'jumlah_beli' => $this->input->post('jumlah_beli'),
            'total_harga' => $this->input->post('jumlah_harga_beli'),
            'id_users' => $id,
            'laba_satuan' => $this->input->post('laba_satuan'),
            'bayar' => $this->input->post('bayar'),
            'status' => $this->input->post('status'),
            'harga_beli_satuan' => $this->input->post('harga_jual_satuan'),
            'diskon_beli_satuan' => $diskon_beli_satuan,
            'netto_beli_satuan' => $harga_netto_beli,
            'jatuh_tempo_kredit' => $this->input->post('tgl_pelunasan'),
            'total_harga' => $this->input->post('jumlah_harga_beli')
        ];
        $this->m_data->input_data($data2,'pembelian_barang');
        $data['cari_kode_barang'] = $this->m_data->where('barang',['kode_barang' => $this->input->post('kode_barang')])->row();
        $data3 = [
            'stock' => $data['cari_kode_barang']->stock + $this->input->post('jumlah_beli'),
        ];
        $this->m_data->update_data(['kode_barang' => $data['cari_kode_barang']->kode_barang],$data3,'barang');
        $data['kredit'] = $this->m_data->cek_kredit()->row();
        if(empty($data['kredit'])){
            $data['cek_kd_pembelian'] = $this->m_data->cek_akhir('kd_pembelian','DESC','pembelian_barang')->row();
            $dataArrKas = [
                    'kredit' => $data['cek_kd_pembelian']->total_harga,
                    'kd_pembelian' => $data['cek_kd_pembelian']->kd_pembelian,
                    'tanggal_transaksi' => date('Y-m-d H:i:s'),
                    'keterangan' => 'Pembelian'
                ];
                $this->db->insert('kas',$dataArrKas);
               $this->session->set_flashdata('alert','<div class="alert alert-success alert-dismissible fade in">
                     <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                    <strong>Berhasil </strong> Menambah Data.
                   </div>');
            redirect('p/tambah_barang_suplier');
        }else{
            if($data['kredit']->bayar == '0'){
                $status = 'belum bayar';
            }elseif($data['kredit']->bayar != '0'){
                $status = 'berlanjut';
            }else{
                $status = 'lunas';
            }
            $data3 = [
                'tgl_tempo' => $this->input->post('tgl_pelunasan'),
                'kd_pembelian' => $data['kredit']->kd_pembelian,
                'kekurangan_biaya' => $data['kredit']->total_harga - $data['kredit']->bayar,
                'status_lunas' => $status,
            ];
            $this->m_data->input_data($data3,'join_kredit_pembelian');
        }
        $data['join_kredit'] = $this->m_data->cek_join_kredit()->row();
        $data['kd_join_kredit'] = $this->m_data->where('join_kredit_pembelian',['kd_pembelian' => $data['join_kredit']->kd_pembelian])->row();
        if($data['join_kredit']->bayar == '0'){
        }else{
            if(empty($data['kd_join_kredit']->id_join_kredit)){
                $this->session->set_flashdata('alert','<div class="alert alert-success alert-dismissible fade in">
                     <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                    <strong>Berhasil </strong> Menambah Data.
                   </div>');
                $data['cek_kd_pembelian'] = $this->m_data->cek_akhir('kd_pembelian','DESC','pembelian_barang')->row();
                // $data = $data['cek_kd_pembelian']->kd_pembelian;
                // echo $data;
                $dataArrKas = [
                    'debet' => $total,
                    'kd_pembelian' => $data['cek_kd_pembelian']->kd_pembelian,
                    'tanggal_transaksi' => date('Y-m-d H:i:s'),
                    'keterangan' => 'Pembelian'
                ];
                $this->db->insert('kas',$dataArrKas);
                redirect('p/tambah_barang_suplier');
            }else{
            $data4 = [
                'id_join_kredit' => $data['kd_join_kredit']->id_join_kredit,
                'keterangan' => 'Pembayaran Pertama',
                'nominal' => $data['kredit']->bayar,
                'tgl_pembayaran' => $data['kredit']->tanggal_pembelian,
            ];
            $this->m_data->input_data($data4,'join_pembayaran_kredit');
            $data['cek_kd_pembelian'] = $this->m_data->cek_akhir('kd_pembelian','DESC','pembelian_barang')->row();
            $dataArrKas = [
                    'kredit' => $total,
                    'kd_pembelian' => $data['cek_kd_pembelian']->kd_pembelian,
                    'tanggal_transaksi' => date('Y-m-d H:i:s'),
                    'keterangan' => 'Pembelian'
                ];
                $this->db->insert('kas',$dataArrKas);
                redirect('p/tambah_barang_suplier');
        }
        }
        // $dataArrKas = [
        //     'kredit' => $total_harga,
        //     'kd_pembelian' => $data['cek_kd_pembelian']->kd_pembelian,
        //     'tanggal_transaksi' => date('Y-m-d H:i:s'),
        //     'keterangan' => 'Pembelian'
        // ];
        // $this->db->insert('kas',$dataArrKas);
            $this->session->set_flashdata('alert','<div class="alert alert-success alert-dismissible fade in">
                     <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                    <strong>Berhasil </strong> Menambah Data.
                   </div>');
            redirect('p/tambah_barang_suplier');
    }
    function load_kode($val = null){
        (is_null($val)) ? $var='' : $var=$val;
        $data['cek_kode'] = $this->m_data->cek_kode_barang($var)->row();
        if(empty($data['cek_kode'])){
            echo'<script>
                $("#simpan_barang").removeAttr("disabled");
            </script>';
        }else{
            echo '<div class="alert alert-warning alert-dismissible fade in" style="margin-top:10px;">
                      <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                     <strong>Kode barang </strong> yang anda masukkan sudah ada.
                    </div>';
            echo'<script>
                $("#simpan_barang").attr("disabled", "disabled");
            </script>';
        }
    }
    function proses_edit_barang_suplier($id_pem){
        $harga_beli = str_replace('.','',$this->input->post('harga_beli_satuan'));
        $harga_netto_beli = str_replace('.','',$this->input->post('harga_netto_satuan'));
        $harga_pokok = str_replace('.','',$this->input->post('harga_pokok'));
        $diskon_beli_satuan = str_replace('.','',$this->input->post('diskon_beli_satuan'));
        $date = date('Y-m-d H:i:s');
        $bulan = date('m');
        $tahun = date('Y');
        $data['user_ion'] = $this->ion_auth->user()->row();
        $data['nama_pembeli'] = $this->m_data->where('users',['id' => $data['user_ion']->id])->row();
        $id =  $data['nama_pembeli']->id;
        $jumlah = $this->input->post('jumlah_beli') * $harga_beli;
        $diskon = $diskon_beli_satuan/100*($jumlah);
        (!empty($diskon_beli_satuan)) ? $total = $jumlah - $diskon : $total = $jumlah;
        $data2 = [
            'tanggal_pembelian' => $this->input->post('tgl_pem'),
            'kode_supplier' => $this->input->post('supplier'),
            'kode_barang' => $this->input->post('kode_barang'),
            'jumlah_beli' => $this->input->post('jumlah_beli'),
            'total_harga' => $total,
            'laba_satuan' => $this->input->post('laba_satuan'),
            'bayar' => $this->input->post('bayar'),
            'status' => $this->input->post('status'),
            'harga_beli_satuan' => $harga_beli,
            'diskon_beli_satuan' => $diskon_beli_satuan,
            'netto_beli_satuan' => $harga_netto_beli,
        ];
        $this->m_data->update_data(['kd_pembelian' => $id_pem],$data2,'pembelian_barang');
        $data['kredit'] = $this->m_data->cek_kredit()->row();
        if(empty($data['kredit'])){
               $this->session->set_flashdata('alert','<div class="alert alert-success alert-dismissible fade in">
                     <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                    <strong>Berhasil </strong> mengedit data.
                   </div>');
            redirect('p/tambah_barang_suplier');
        }else{
            if($data['kredit']->bayar == '0'){
                $status = 'belum bayar';
            }elseif($data['kredit']->bayar != '0'){
                $status = 'berlanjut';
            }else{
                $status = 'lunas';
            }
            $data3 = [
                'tgl_tempo' => $this->input->post('tgl_pelunasan'),
                'kd_pembelian' => $data['kredit']->kd_pembelian,
                'kekurangan_biaya' => $data['kredit']->total_harga - $data['kredit']->bayar,
                'status_lunas' => $status,
            ];
            $this->m_data->input_data($data3,'join_kredit_pembelian');
        }
        $data['join_kredit'] = $this->m_data->cek_join_kredit()->row();
        $data['kd_join_kredit'] = $this->m_data->where('join_kredit_pembelian',['kd_pembelian' => $data['join_kredit']->kd_pembelian])->row();
        if($data['join_kredit']->bayar == '0'){
        }else{
            if(empty($data['kd_join_kredit']->id_join_kredit)){
                $this->session->set_flashdata('alert','<div class="alert alert-success alert-dismissible fade in">
                     <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                    <strong>Berhasil </strong> mengedit data.
                   </div>');
            redirect('p/tambah_barang_suplier');
            }else{
            $data4 = [
                'id_join_kredit' => $data['kd_join_kredit']->id_join_kredit,
                'keterangan' => 'Pembayaran Pertama',
                'nominal' => $data['kredit']->bayar,
                'tgl_pembayaran' => $data['kredit']->tanggal_pembelian,
            ];
            $this->m_data->input_data($data4,'join_pembayaran_kredit');
        }
        }
            $this->session->set_flashdata('alert','<div class="alert alert-success alert-dismissible fade in">
                     <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                    <strong>Berhasil </strong> mengedit data.
                   </div>');
            redirect('p/tambah_barang_suplier');
    }
    function proses_hapus_barang_suplier($id){
        $base_64 = $id . str_repeat('=', strlen($id) % 4);
        $datax = base64_decode($base_64);
        $this->m_data->hapus_data(['id_barang' => $datax],'barang');
        $this->session->set_flashdata('alert','<div class="alert alert-success alert-dismissible fade in">
                     <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                    <strong>Berhasil </strong> Hapus Data.
                   </div>');
        redirect('p/tambah_barang_suplier');
    }
    function input_pembayaran(){
        $data['user_ion'] = $this->ion_auth->user()->row();
        $data['suplier'] = $this->m_data->semua('supplier')->result();
        $data['title'] = 'Input Pembayaran | STIKESMART';
        $this->load->view('user/header',$data);
        $this->load->view('user/input_pembelian_suplier');
        $this->load->view('user/footer');
    }
    function list_hutang_pembelian(){
        $data['user_ion'] = $this->ion_auth->user()->row();
        $data['hutang'] = $this->m_data->daftar_hutang_pembelian()->result();
        $data['detail_join'] = $this->m_data->detail_join_hutang_pembelian()->result();
        $data['barang_detail'] = $this->m_data->barang_kredit_join()->result();
        $data['title'] = 'Daftar Hutang Pembelian Supplier | STIKESMART';
        $this->load->view('user/header',$data);
        $this->load->view('user/list_hutang_pembelian');
        $this->load->view('user/footer');
    }
    function pembayaran_hutang_pembelian(){
        $data['user_ion'] = $this->ion_auth->user()->row();
        $data['hutang_pembelian'] = $this->m_other->daftar_pembayaran_hutang_pembelian($this->input->post('supplier'))->result();
        $data['title'] = 'Daftar Hutang Pembelian Supplier | STIKESMART';
        $this->load->view('user/header',$data);
        $this->load->view('user/pembayaran_hutang_pembelian');
        $this->load->view('user/footer');
    }
    function data_karyawan(){
        $data['user_ion'] = $this->ion_auth->user()->row();
        $data['title'] = 'Daftar Karyawan | STIKESMART';
        $this->load->view('user/header',$data);
        $this->load->view('user/data_karyawan');
        $this->load->view('user/footer');
    }
    function add_karyawan(){
        $username = $this->input->post('username');
        $password = $this->input->post('password');
        //(empty($this->input->post('email'))) ? $emailDia = $this->input->post('username').'@example.com' : $emailDia = $this->input->post('email');
        $email = $emailDia;
        $additional_data = [
        'first_name' => $this->input->post('first_name'),
        'last_name' => $this->input->post('last_name'),
        ];
        $group = array($this->input->post('posisi')); // Sets user to admin.
        $this->ion_auth->register($username, $password, $email, $additional_data, $group);
        $this->session->set_flashdata('alert','<div class="alert alert-success alert-dismissible">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                <h4><i class="icon fa fa-check"></i> Berhasil!</h4>
                Menambah Data
              </div>');
        redirect('p/data_karyawan');
    }
    function update_user($id){
        if(empty($this->input->post('password'))){
            $data = array(
            'first_name' => $this->input->post('first_name'),
            'last_name' => $this->input->post('last_name'),
            'username' => $this->input->post('username'),
            'email' => $this->input->post('email'),
             );
        }else{
            $data = array(
            'first_name' => $this->input->post('first_name'),
            'last_name' => $this->input->post('last_name'),
            'username' => $this->input->post('username'),
            'email' => $this->input->post('email'),
            'password' => $this->input->post('password')
             );
        }
        $this->ion_auth->update($id, $data);
        $this->m_data->update_data(['user_id' => $id],['group_id' => $this->input->post('posisi')],'users_groups');
        $this->session->set_flashdata('alert','<div class="alert alert-success alert-dismissible">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                <h4><i class="icon fa fa-check"></i> Berhasil!</h4>
                Update Data
              </div>');
        redirect('p/data_karyawan');
    }
    function delete_user($id){
        $this->ion_auth->delete_user($id);
        $this->session->set_flashdata('alert','<div class="alert alert-success alert-dismissible">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                <h4><i class="icon fa fa-check"></i> Berhasil!</h4>
                Hapus Data
              </div>');
        redirect('p/data_karyawan');
    }
    function tambah_pembayaran($id){
        $nominal = str_replace('.','',$this->input->post('nominal'));
        $data=[
          'keterangan' => $this->input->post('keterangan'),
          'nominal' => $nominal,
          'id_join_kredit' => $id,
          'tgl_pembayaran' => date('Y-m-d'),
        ];
        $this->m_data->input_data($data,'join_pembayaran_kredit');
        $data['kredit_pembelian'] = $this->m_data->where('join_kredit_pembelian',['id_join_kredit' => $id])->row();
        $kekurangan = $data['kredit_pembelian']->kekurangan_biaya;
        $data2 = [
            'kekurangan_biaya' => $kekurangan-$nominal,
        ];
        $this->m_data->update_data(['id_join_kredit' => $id],$data2,'join_kredit_pembelian');
        $data['update_status'] = $this->m_data->where('join_kredit_pembelian',['id_join_kredit' => $id])->row();
        $kekurangan = $data['update_status']->kekurangan_biaya;
        if($kekurangan == '0'){
            $data3 = [
                'status_lunas' => 'lunas',
            ];
        }else{
            $data3 = [
                'status_lunas' => 'berlanjut',
            ];
        }
        $this->m_data->update_data(['id_join_kredit' => $id],$data3,'join_kredit_pembelian');
        $this->session->set_flashdata('alert','<div class="alert alert-success alert-dismissible">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                <h4><i class="icon fa fa-check"></i> Berhasil!</h4>
                memmbayar hutang.
              </div>');
        redirect('p/pembayaran_hutang_pembelian');
    }

    function cek_data_penjualan(){

      $wh_penjualan = array('tanggal_penjualan LIKE' => '%2019-10-%', );
      $data = $this->m_data->where('penjualan_barang',$wh_penjualan)->result();

      foreach ($data as $row) {
        $penjualan_sementara = $this->m_data->penjumlahan_sementara($row->kd_nota)->row();
if($row->total_harga!=$penjualan_sementara->total_hasil){
  echo $row->kd_nota.'+'.$penjualan_sementara->total_hasil.'+'.$row->total_harga.'<br>';
}

        // code...
      }
    }

    function cek_penjualan_kosong(){

      $wh_penjualan = array('total_harga' => '0', );
      $data = $this->m_data->where('penjualan_barang',$wh_penjualan)->result();
$no=0;
      foreach ($data as $row) {

$no++;
  // $this->m_data->hapus_data(array('kd_nota' => $row->kd_nota, ),'penjualan_barang');
  // $this->m_data->hapus_data(array('kd_nota' => $row->kd_nota, ),'penjualan_sementara');
  echo $no.'/'.$row->kd_nota.'<br>';


}

        // code...
      }

}
