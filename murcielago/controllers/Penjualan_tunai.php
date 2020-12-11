<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Penjualan_tunai extends CI_Controller {
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
        $data['penjualan_toko_tunai'] = $this->m_data->penjualan_barang_toko_tunai()->result();
		$this->load->view('user/header',$data);
		$this->load->view('user/penjualan_toko_tunai');
		$this->load->view('user/footer');
	}
    
    public function printx($hr1 = null,$hr2 = null){
        (is_null($hr1)) ? $har1='' : $har1=$hr1;
        (is_null($hr2)) ? $har2='' : $har2=$hr2;
        $data['har1'] = $har1;
        $data['har2'] = $har2;
		$data['title'] = 'Kasir | Stikes Mart';
        $data['penjualan_toko_tunai'] = $this->m_data->penjualan_barang_toko_tunai()->result();
		$this->load->view('user/print_penjualan_toko_tunai',$data);
    }
    
    function export_penjualan_tunai($hr1 = null,$hr2 = null){
        (is_null($hr1)) ? $har1='' : $har1=$hr1;
        (is_null($hr2)) ? $har2='' : $har2=$hr2;
        $data['har1'] = $har1;
        $data['har2'] = $har2;
        $data['title'] = 'Penjualan Barang Toko Tunai - Stikes Mart';
        $data['penjualan_toko_tunai'] = $this->m_data->penjualan_barang_toko_tunai()->result();
		$this->load->view('user/export_penjualan_tunai',$data);
    }
}