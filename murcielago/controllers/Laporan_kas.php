<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class Laporan_kas extends CI_Controller {
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
    
    function masuk(){
        $data['title'] = 'Laporan Kas Masuk | STIKESMART';
        if(empty($this->input->post('hari1'))){
            $data['debet'] = $this->m_data->laporan_kas_masuk()->result();
        }else{
            $data['debet'] = $this->m_data->cari_debet_kas($this->input->post('hari1'),$this->input->post('hari2'))->result();
        }
        $data['total_debet'] = $this->m_data->semua('penjualan_barang')->result();
		$this->load->view('user/header',$data);
		$this->load->view('user/laporan_kas_masuk');
		$this->load->view('user/footer');
    }
    
    function keluar(){
        $data['title'] = 'Laporan Kas Keluar | STIKESMART';
        if(empty($this->input->post('hari1'))){
            $data['kredit'] = $this->m_data->laporan_kas_keluar()->result();
        }else{
            $data['kredit'] = $this->m_data->cari_kredit_kas($this->input->post('hari1'),$this->input->post('hari2'))->result();
        }
        $data['total_kredit'] = $this->m_data->semua('pembelian_barang')->result();
		$this->load->view('user/header',$data);
		$this->load->view('user/laporan_kas_keluar');
		$this->load->view('user/footer');
    }
    
    function cash_flow(){
        $data['title'] = 'Laporan Kas (Cash Flow) | STIKESMART';
        $data['kas'] = $this->m_data->semua_kas($this->input->post('hari1'),$this->input->post('hari2'))->result();
        $this->load->view('user/header',$data);
        $this->load->view('user/cash_flow');
        $this->load->view('user/footer');
    }
    
    function export_cash_flow($hari1,$hari2){
        $data['kas'] = $this->m_data->semua_kas($hari1,$hari2)->result();
        $data['title'] = 'Laporan Kas (Cash Flow) | STIKESMART';
        $this->load->view('user/export_cash_flow',$data);
    }

    function print_cash_flow($hari1,$hari2){
        $data['kas'] = $this->m_data->semua_kas($hari1,$hari2)->result();
        $data['title'] = 'Laporan Kas (Cash Flow) | STIKESMART';
        $this->load->view('user/print_cash_flow',$data);
    }
}