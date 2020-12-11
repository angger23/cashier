<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Penjualan_intern_all extends CI_Controller {
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
        $data['penjualan_intern_all'] = $this->m_data->penjualan_intern_all()->result();
		$this->load->view('user/header',$data);
		$this->load->view('user/penjualan_intern_all');
		$this->load->view('user/footer');
	}
}