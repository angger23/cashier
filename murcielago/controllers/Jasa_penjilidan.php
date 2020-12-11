<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Jasa_penjilidan extends CI_Controller {
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
        $data['jasa_tunai'] = $this->m_data->jasa_penjilidan_tunai()->result();
		$this->load->view('user/header',$data);
		$this->load->view('user/jasa_penjilidan_tunai');
		$this->load->view('user/footer');
	}
    
    public function print_tunai($hr1 = null,$hr2 = null){
        (is_null($hr1)) ? $har1='' : $har1=$hr1;
        (is_null($hr2)) ? $har2='' : $har2=$hr2;
        $data['har1'] = $har1;
        $data['har2'] = $har2;
		$data['title'] = 'Kasir | Stikes Mart';
        $data['jasa_tunai'] = $this->m_data->jasa_penjilidan_tunai()->result();
		$this->load->view('user/print_jasa_penjilidan_tunai',$data);
    }
    
    function export_tunai($hr1 = null,$hr2 = null){
        (is_null($hr1)) ? $har1='' : $har1=$hr1;
        (is_null($hr2)) ? $har2='' : $har2=$hr2;
        $data['har1'] = $har1;
        $data['har2'] = $har2;
        $data['title'] = 'Jasa Penjilidan Tunai - Stikes Mart';
        $data['jasa_tunai'] = $this->m_data->jasa_penjilidan_tunai()->result();
		$this->load->view('user/export_jasa_penjilidan_tunai',$data);
    }
    /////////////////////////////////////////////////////////////////////////////////
    public function kredit(){
		$data['title'] = 'Kasir | Stikes Mart';
        $data['jasa_kredit'] = $this->m_data->jasa_penjilidan_kredit()->result();
		$this->load->view('user/header',$data);
		$this->load->view('user/jasa_penjilidan_kredit');
		$this->load->view('user/footer');
	}
    
    public function print_kredit($hr1 = null,$hr2 = null){
        (is_null($hr1)) ? $har1='' : $har1=$hr1;
        (is_null($hr2)) ? $har2='' : $har2=$hr2;
        $data['har1'] = $har1;
        $data['har2'] = $har2;
		$data['title'] = 'Kasir | Stikes Mart';
        $data['jasa_kredit'] = $this->m_data->jasa_penjilidan_kredit()->result();
		$this->load->view('user/print_jasa_penjilidan_kredit',$data);
    }
    
    function export_kredit($hr1 = null,$hr2 = null){
        (is_null($hr1)) ? $har1='' : $har1=$hr1;
        (is_null($hr2)) ? $har2='' : $har2=$hr2;
        $data['har1'] = $har1;
        $data['har2'] = $har2;
        $data['title'] = 'Jasa Penjilidan Kredit - Stikes Mart';
        $data['jasa_kredit'] = $this->m_data->jasa_penjilidan_kredit()->result();
		$this->load->view('user/export_jasa_penjilidan_kredit',$data);
    }
}