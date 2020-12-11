<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Lr_internal_seragam extends CI_Controller {
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
        $data['lb_in_srgm'] = $this->m_data->laba_rugi_inter_seragam()->result();
		$this->load->view('user/header',$data);
		$this->load->view('user/laba_rugi_internal_seragam');
		$this->load->view('user/footer');
	}
    
    function printx($hr1 = null,$hr2 = null){
        (is_null($hr1)) ? $har1='' : $har1=$hr1;
        (is_null($hr2)) ? $har2='' : $har2=$hr2;
        $data['har1'] = $har1;
        $data['har2'] = $har2;
        $data['title'] = 'Kasir | Stikes Mart';
        $data['lb_in_srgm'] = $this->m_data->laba_rugi_inter_seragam()->result();
		$this->load->view('user/print_laba_rugi_internal_seragam',$data);
    }
    
    function export_lr_seragam($hr1 = null,$hr2 = null){
        (is_null($hr1)) ? $har1='' : $har1=$hr1;
        (is_null($hr2)) ? $har2='' : $har2=$hr2;
        $data['har1'] = $har1;
        $data['har2'] = $har2;
        $data['title'] = 'Penjualan Internal Seragam - Stikes Mart';
        $data['lb_in_srgm'] = $this->m_data->laba_rugi_inter_seragam()->result();
		$this->load->view('user/export_lr_internal_seragam',$data);
    }
}