<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Grafik extends CI_Controller {
    function __construct(){
		parent::__construct();		
        $this->load->model(array('m_data','m_other','ion_auth_model'));
        if(!$this->ion_auth->logged_in()){
			redirect("auth/login");
		}
	}
    

    public function grafik_omzet_penjualan(){
		$data['user_ion'] = $this->ion_auth->user()->row();
        $data['title'] = 'Laporan Grafik Penjualan';
        if(!empty($this->input->post('bulan1'))){
           
        }else{

        }
        $this->load->view('user/header',$data);
        $this->load->view('user/grafik_omzet_penjualan',$data);
        $this->load->view('user/footer',$data);
    }
    
    public function laporan_rekap_laba(){
		$data['user_ion'] = $this->ion_auth->user()->row();
        $data['title'] = 'Laporan Grafik Rekap Laba';
        $this->load->view('user/header',$data);
        $this->load->view('user/laporan_rekap_laba',$data);
        $this->load->view('user/footer',$data);
    }

    public function grafik_jumlah_transaksi_penjualan(){
        $data['user_ion'] = $this->ion_auth->user()->row();
        $data['title'] = 'Laporan Grafik Jumlah Transaksi Penjualan';
        $this->load->view('user/header',$data);
        $this->load->view('user/grafik_jumlah_transaksi',$data);
        $this->load->view('user/footer',$data);
    }
    
}