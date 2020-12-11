<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Data_kasir extends CI_Controller {
function __construct(){
		parent::__construct();		
		$this->load->model('m_data');
        $this->load->helper('url');
        $this->load->model('ion_auth_model');
    if(!$this->ion_auth->logged_in()){
			redirect("auth/login");
		}
	}
    
	public function supplier()
	{
        $data['user_ion'] = $this->ion_auth->user()->row();   
        $data['rec'] = $this->m_data->daf_persediaan()->result_array();
        $data['sup'] = $this->m_data->supplier()->result_array();
		$this->load->view('header',$data);
		$this->load->view('supplier',$data);
		$this->load->view('footer');
	}
    public function simpan_supplier(){
       $data['user_ion'] = $this->ion_auth->user()->row();   
        $data= array(
        'nama_supplier' => $this->input->post('nama_supplier'),
        'alamat_supplier' => $this->input->post('alamat_supplier'),
            
        );
        
        $this->m_data->input_data($data,'supplier');
        redirect('data_kasir/supplier');
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
        redirect('data_kasir/supplier');
    }
	public function pembeli(){
		$data['user_ion'] = $this->ion_auth->user()->row();   
        $data['data_pembeli'] = $this->m_data->data_pembeli()->result();
        $this->load->view('header',$data);
		$this->load->view('pembeli',$data);
		$this->load->view('footer');
	}
	function tambah_pembeli(){
		$data['user_ion'] = $this->ion_auth->user()->row();   
        $data = array(
            'nama_pembeli' => $this->input->post('nama_pembeli'),
        );
        $this->m_data->input_data($data,'pembeli');
        redirect('data_kasir/pembeli');
    }
    function update_pembeli(){
		$data['user_ion'] = $this->ion_auth->user()->row();   
        $data = array(
            'nama_pembeli' => $this->input->post('nama_pembeli'),
        );
        $where = array(
            'kd_pembeli' => $this->input->post('kd_pembeli'),
        );
        $this->m_data->update_data($where,$data,'pembeli');
        redirect('data_kasir/pembeli');
    }
    function hapus_pembeli($kd){
		$data['user_ion'] = $this->ion_auth->user()->row();   
        $kdx = $kd;
        $where = array(
            'kd_pembeli' => $kdx,
        );
        $this->m_data->hapus_data($where,'pembeli');
        redirect('data_kasir/pembeli');
    }
}
