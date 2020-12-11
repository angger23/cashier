<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Kas extends CI_Controller{
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
    
    function index(){
        $data['user_ion'] = $this->ion_auth->user()->row();    
        $data['penjualan'] = $this->m_data->list_data_penjualan()->result_array();
        $data['pembeli'] = $this->m_data->pembeli()->result_array();
		$this->load->view('header',$data);
		$this->load->view('modal',$data);
		$this->load->view('footer');
    }
    
    function insert_kas(){
		$data['user_ion'] = $this->ion_auth->user()->row();   
        if($this->input->post('optradio') == 'masuk'){
            $data = array(
                'debet' => $this->input->post('uang'),
                'tanggal_transaksi' => $this->input->post('tgl2'),
                'keterangan' => $this->input->post('keterangan2'),
            );
            $hasil = $this->input->post('modal_m') + $this->input->post('uang');
            $datax = array(
                'modal_stikes' => $hasil,
                'tgl_update' => $this->input->post('tgl2'),
            );
            $where = array(
                'id_modal' => '1',
            );
            $this->m_data->update_data($where,$datax,'modal');
        }else{
             $data = array(
                'kredit' => $this->input->post('uang'),
                'tanggal_transaksi' => $this->input->post('tgl3'),
                'keterangan' => $this->input->post('keterangan3'),
            );
            $hasil = $this->input->post('modal') - $this->input->post('uang');
            $datax = array(
                'modal_stikes' => $hasil,
                'tgl_update' => $this->input->post('tgl3'),
            );
            $where = array(
                'id_modal' => '1',
            );
            $this->m_data->update_data($where,$datax,'modal');
        }
        $this->m_data->input_data($data,'kas');
        redirect('kas/');
    }
}