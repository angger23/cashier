<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Penjualan_barang_konsinyasi extends CI_Controller {
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

	public function index(){
		$data['title'] = 'Kasir | Stikes Mart';
        $data['konsinyasi_tunai'] = $this->m_data->penjualan_barang_konsinyasi_tunai()->result();
		$this->load->view('user/header',$data);
		$this->load->view('user/penjualan_barang_konsinyasi_tunai.php');
		$this->load->view('user/footer');
	}
    
    public function print_tunai($hr1 = null,$hr2 = null){
        (is_null($hr1)) ? $har1='' : $har1=$hr1;
        (is_null($hr2)) ? $har2='' : $har2=$hr2;
        $data['har1'] = $har1;
        $data['har2'] = $har2;
		$data['title'] = 'Kasir | Stikes Mart';
        $data['konsinyasi_tunai'] = $this->m_data->penjualan_barang_konsinyasi_tunai()->result();
		$this->load->view('user/print_penjualan_barang_konsinyasi_tunai',$data);
    }
    
    function export_tunai($hr1 = null,$hr2 = null){
        (is_null($hr1)) ? $har1='' : $har1=$hr1;
        (is_null($hr2)) ? $har2='' : $har2=$hr2;
        $data['har1'] = $har1;
        $data['har2'] = $har2;
        $data['title'] = 'Penjualan Barang Konsinyasi Tunai - Stikes Mart';
        $data['konsinyasi_tunai'] = $this->m_data->penjualan_barang_toko_tunai()->result();
		$this->load->view('user/export_penjualan_barang_konsinyasi_tunai',$data);
    }
    
    public function kredit(){
		$data['title'] = 'Kasir | Stikes Mart';
        $data['konsinyasi_kredit'] = $this->m_data->penjualan_barang_konsinyasi_kredit()->result();
		$this->load->view('user/header',$data);
		$this->load->view('user/penjualan_barang_konsinyasi_kredit.php');
		$this->load->view('user/footer');
	}
    
    public function print_kredit($hr1 = null,$hr2 = null){
        (is_null($hr1)) ? $har1='' : $har1=$hr1;
        (is_null($hr2)) ? $har2='' : $har2=$hr2;
        $data['har1'] = $har1;
        $data['har2'] = $har2;
		$data['title'] = 'Kasir | Stikes Mart';
        $data['konsinyasi_kredit'] = $this->m_data->penjualan_barang_konsinyasi_kredit()->result();
		$this->load->view('user/print_penjualan_barang_konsinyasi_kredit',$data);
    }
    
    function export_kredit($hr1 = null,$hr2 = null){
        (is_null($hr1)) ? $har1='' : $har1=$hr1;
        (is_null($hr2)) ? $har2='' : $har2=$hr2;
        $data['har1'] = $har1;
        $data['har2'] = $har2;
        $data['title'] = 'Penjualan Barang Konsinyasi Kredit - Stikes Mart';
        $data['konsinyasi_kredit'] = $this->m_data->penjualan_barang_konsinyasi_kredit()->result();
		$this->load->view('user/export_penjualan_barang_konsinyasi_kredit',$data);
    }
}