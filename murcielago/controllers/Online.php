<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Online extends CI_Controller {
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

private function insert_db2($table,$data){
  $db2 =$this->load->database('second', TRUE);
   $db2->insert($table,$data);
  }

private function cek_penjualan($id){
  $db2 =$this->load->database('second', TRUE);
  
    
    $db2->where('kd_penjualan',$id);
    $query = $db2->get('penjualan_barang');
    return $query;
  }

private function cari_detail($id){
  
    $this->db->where('kd_nota',$id);
    $query = $this->db->get('penjualan_sementara');
    return $query;
  }

private function cek_join_hutang($id){
    $db2 =$this->load->database('second', TRUE);

    $db2->select('id_join_hutang');
    $db2->where('id_join_hutang',$id);
    $query = $db2->get('join_hutang');
    return $query;
  }
   function index(){

     // $data['kelas'] = $this->oke2()->result();

    $data['title'] = 'Kasir | Stikes Mart';
    $this->load->view('user/header',$data);
    $this->load->view('user/lapor_penjualan');
    $this->load->view('user/footer');

  }

   function kirim_penjualan($tgl){

      $barang = $this->m_data->barang_satu_tgl($tgl)->result();

        foreach ($barang as $rec ) {
            $cek_penjualan = $this->cek_penjualan($rec->kd_penjualan)->row();

            if(empty($cek_penjualan)){

          $data = array('kd_penjualan' => $rec->kd_penjualan,
                        'kd_nota' => $rec->kd_nota,
                        'nama_pembeli' => $rec->nama_pembeli,
                        'tanggal_penjualan' => $rec->tanggal_penjualan, 
                        'status' => $rec->status,
                        'tgl_tempo_kredit' => $rec->tgl_tempo_kredit,
                        'sum_diskon' => $rec->sum_diskon,
                        'bayar' => $rec->bayar,
                        'total_harga' => $rec->total_harga,
                        'bulan_beli' => $rec->bulan_beli,
                        'tahun_n' => $rec->tahun_n,
                        'nama_kasir' => $rec->nama_kasir,

           );


$this->insert_db2('penjualan_barang',$data);

$hutang = $this->m_data->hutang_pen($rec->kd_penjualan)->result();

foreach ($hutang as $k) {
  
    $data_hutang =  array(
                            'id_hutang' => $k->id_hutang,
                            'kd_penjualan' => $k->kd_penjualan,
                            'tanggal_jatuh_tempo' => $k->tanggal_jatuh_tempo,
                            'atas_nama' => $k->atas_nama,
                            'kekurangan_biaya' => $k->kekurangan_biaya,
                            'status_lunas' => $k->status_lunas,
                            'created' => $k->created
                             ); 
$this->insert_db2('hutang_penjualan',$data_hutang);

$join_hutang = $this->m_data->join_hutang_pen($k->id_hutang)->result();
foreach($join_hutang as $p ){ 
 $cek_join_hutang = $this->cek_join_hutang($k->id_join_hutang)->row(); 
 if(empty($cek_join_hutang->id_join_hutang)){

                    $data_join_hutang = array(
                            'id_join_hutang' => $p->id_join_hutang,
                            'id_hutang ' => $p->id_hutang,
                            'keterangan' => $p->keterangan,
                            'bayar' => $p->bayar,
                            'tanggal_pembayaran' => $p->tanggal_pembayaran 
                            );

$this->insert_db2('join_hutang_penjualan',$data_join_hutang);
 
 }   
    }
}
$cek_penjualan_sementara = $this->cari_detail($rec->kd_nota)->result();
foreach ($cek_penjualan_sementara as $ck ) {
$data_detail = array(
            'kd_nota' => $ck->kd_nota,
            'kode_barang' => $ck->kode_barang,
            'satuan' => $ck->satuan,
            'id_cek' => $ck->id_cek,
             );

$this->insert_db2('penjualan_sementara',$data_detail);


}
            }else{

            }

}






        
redirect('online');
  }

}

?>