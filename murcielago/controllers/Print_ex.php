<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Print_ex extends CI_Controller {
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
    
    function data_kas_masuk($kd){
		$data['user_ion'] = $this->ion_auth->user()->row();   
        $data['cek_penjualan'] =  $this->m_data->cek_penjualan2($kd)->result(); 
        $this->load->view('print_masuk',$data);
    }
    
    function data_barang(){
		$data['user_ion'] = $this->ion_auth->user()->row();   
        $data['data_barang'] = $this->m_data->data_barang()->result_array();
        $this->load->view('print_data_barang',$data);
    }
    function cetak_struk(){
		$data['user_ion'] = $this->ion_auth->user()->row();   
        $data['data_ss'] = $this->m_data->data_ss()->result_array();
        $this->load->view('cetak_struk',$data);
    }
    
}