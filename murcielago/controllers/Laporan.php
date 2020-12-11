<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class Laporan extends CI_Controller {
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
    
    function laporan_penjualan(){
		$data['user_ion'] = $this->ion_auth->user()->row();   
        $data['penjualan'] = $this->m_data->list_data_penjualan()->result_array();
        $data['pembeli'] = $this->m_data->pembeli()->result_array();
		$this->load->view('header',$data);
		$this->load->view('laporan_penjualan',$data);
		$this->load->view('footer');
    }
    
    function laporan_kas_masuk(){
		$data['user_ion'] = $this->ion_auth->user()->row();   
        $data['penjualan'] = $this->m_data->list_data_penjualan()->result_array();
        $data['pembeli'] = $this->m_data->pembeli()->result_array();
		$this->load->view('header',$data);
		$this->load->view('laporan_kas_masuk',$data);
		$this->load->view('footer');
    }
    
    function laporan_kas_keluar(){
		$data['user_ion'] = $this->ion_auth->user()->row();   
        $data['penjualan'] = $this->m_data->list_data_penjualan()->result_array();
        $data['pembeli'] = $this->m_data->pembeli()->result_array();
		$this->load->view('header',$data);
		$this->load->view('laporan_kas_keluar',$data);
		$this->load->view('footer');
    }
    
    function laporan_rekap_kas(){
		$data['user_ion'] = $this->ion_auth->user()->row();   
        $data['penjualan'] = $this->m_data->list_data_penjualan()->result_array();
        $data['pembeli'] = $this->m_data->pembeli()->result_array();
		$this->load->view('header',$data);
		$this->load->view('laporan_rekap-kas',$data);
		$this->load->view('footer');
    }
    
    function print_rekap(){
		$data['user_ion'] = $this->ion_auth->user()->row();   
        $data['penjualan'] = $this->m_data->list_data_penjualan()->result_array();
        $data['pembeli'] = $this->m_data->pembeli()->result_array();
		//$this->load->view('header',$data);
		$this->load->view('print_rekap',$data);
		//$this->load->view('footer');
    }
    function print_kas_masuk(){
		$data['user_ion'] = $this->ion_auth->user()->row();   
        $data['penjualan'] = $this->m_data->list_data_penjualan()->result_array();
        $data['pembeli'] = $this->m_data->pembeli()->result_array();
		//$this->load->view('header',$data);
		$this->load->view('print_kas_masuk',$data);
		//$this->load->view('footer');
    }
    function print_kas_keluar(){
		$data['user_ion'] = $this->ion_auth->user()->row();   
        $data['penjualan'] = $this->m_data->list_data_penjualan()->result_array();
        $data['pembeli'] = $this->m_data->pembeli()->result_array();
		//$this->load->view('hader',$data);
		$this->load->view('print_kas_keluar',$data);
		//$this->load->view('footer');
    }
    function laporan_barang_masuk(){
		$data['user_ion'] = $this->ion_auth->user()->row();   
        $data['penjualan'] = $this->m_data->list_data_penjualan()->result_array();
        $data['pembeli'] = $this->m_data->pembeli()->result_array();
		$this->load->view('header',$data);
		$this->load->view('laporan_barang_masuk',$data);
		$this->load->view('footer');
    }
    function laporan_barang_keluar(){
		$data['user_ion'] = $this->ion_auth->user()->row();   
        $data['penjualan'] = $this->m_data->list_data_penjualan()->result_array();
        $data['pembeli'] = $this->m_data->pembeli()->result_array();
		$this->load->view('header',$data);
		$this->load->view('laporan_barang_keluar',$data);
		$this->load->view('footer');
    }
    
    function omzet_penjualan(){
		$data['user_ion'] = $this->ion_auth->user()->row();   
        $data['penjualan'] = $this->m_data->list_data_penjualan()->result_array();
        $data['pembeli'] = $this->m_data->pembeli()->result_array();
		$this->load->view('header',$data);
		$this->load->view('grafik_laba',$data);
		$this->load->view('footer');
    }
    
    function grafik_laba(){
		$data['user_ion'] = $this->ion_auth->user()->row();   
        $data['penjualan'] = $this->m_data->list_data_penjualan()->result_array();
        $data['pembeli'] = $this->m_data->pembeli()->result_array();
		$this->load->view('header',$data);
		$this->load->view('grafik_laba2',$data);
		$this->load->view('footer');
    }
    function laporan_data_barang(){
		$data['user_ion'] = $this->ion_auth->user()->row();   
        $data['data_barang'] = $this->m_data->data_barang()->result_array();
		$this->load->view('header',$data);
		$this->load->view('laporan_data_barang',$data);
		$this->load->view('footer');
    }
    function grafik_transaksi(){
		$data['user_ion'] = $this->ion_auth->user()->row();   
        $data['penjualan'] = $this->m_data->list_data_penjualan()->result_array();
        $data['pembeli'] = $this->m_data->pembeli()->result_array();
        $this->load->view('header',$data);
		$this->load->view('grafik_jumlah_transaksi',$data);
		$this->load->view('footer');
    }
    function rating_barang(){
		$data['user_ion'] = $this->ion_auth->user()->row();   
        $data['rate_barang'] = $this->m_data->rate_barang()->result();
        $this->load->view('header',$data);
		$this->load->view('rating_barang',$data);
		$this->load->view('footer');
    }
    function data_pembeli(){
		$data['user_ion'] = $this->ion_auth->user()->row();   
        $data['data_pembeli'] = $this->m_data->data_pembeli()->result();
        $this->load->view('header',$data);
		$this->load->view('data_pembeli',$data);
		$this->load->view('footer');
    }
    function laporan_pembelian(){
		$data['user_ion'] = $this->ion_auth->user()->row();   
        $data['penjualan'] = $this->m_data->list_data_penjualan()->result_array();
        $data['pembeli'] = $this->m_data->pembeli()->result_array();
		$this->load->view('header',$data);
		$this->load->view('laporan_pembelian',$data);
		$this->load->view('footer');
    }
    function laporan_in_out(){
		$data['user_ion'] = $this->ion_auth->user()->row();   
        $data['penjualan'] = $this->m_data->list_data_penjualan()->result_array();
        $data['pembeli'] = $this->m_data->pembeli()->result_array();
		$this->load->view('header',$data);
		$this->load->view('laporan_in_out',$data);
		$this->load->view('footer');
    }
    function laporan_laba_kotor(){
        $data['user_ion'] = $this->ion_auth->user()->row();   
        $data['penjualan'] = $this->m_data->list_data_penjualan()->result_array();
        $data['pembeli'] = $this->m_data->pembeli()->result_array();
		$this->load->view('header',$data);
		$this->load->view('laporan_laba_kotor',$data);
		$this->load->view('footer'); 
    }
    function print_barang_masuk(){
        $data['user_ion'] = $this->ion_auth->user()->row();   
		$this->load->view('print_barang_masuk',$data); 
    }
    function print_barang_keluar(){
        $data['user_ion'] = $this->ion_auth->user()->row();   
		$this->load->view('print_barang_keluar',$data); 
    }
}