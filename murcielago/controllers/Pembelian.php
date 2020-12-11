<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pembelian extends CI_Controller {
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
    
	public function index()
	{

        //$data['rec'] = $this->m_data->pembelian()->result_array();
        $data['user_ion'] = $this->ion_auth->user()->row();   
        $data['rec'] = $this->m_data->daf_persediaan()->result_array();
        $data['pembelian'] = $this->m_data->daf_pembelian()->result_array();
        $data['supplier'] = $this->m_data->supplier()->result_array();
		$this->load->view('header',$data);
		$this->load->view('pembelian',$data);
		$this->load->view('footer');
	}    
    
    public function update_pembelian(){
		$data['user_ion'] = $this->ion_auth->user()->row();   
        $data_s = array(
            'kode_barang' => $this->input->post('kode_barang'),
            'nama_barang' => $this->input->post('nama_barang'),
            'satuan_barang' => $this->input->post('satuan_barang'),
            'harga_pokok' => $this->input->post('harga_pokok'),
            'diskon' => $this->input->post('diskon'),
            'nama_pembeli_barang' => $this->input->post('nama_pembeli'),
        );
        $where_s = array(
            'kd_pembelian' => $this->input->post('kd_pembelian'),
        );
        $data_x = array(
            'nama_barang' => $this->input->post('nama_barang'),
            'harga_pokok' => $this->input->post('harga_pokok'),
            'stock' => $this->input->post('stock'),
            'kode_barang' => $this->input->post('kode_barang'),
            'kelipatan' => $this->input->post('kelipatan'),
            'diskon' => $this->input->post('diskon'),
            'min_stock' => $this->input->post('min_stock'),
            'nama_pembeli_ss' => $this->input->post('nama_pembeli'),
        );
        $where_x = array(
            'kd_nota' => $this->input->post('kd_nota'),
        );
        $this->m_data->update_data($where_s,$data_s,'pembelian_barang');
        $this->m_data->update_data($where_x,$data_x,'persediaan_barang');
        redirect('pembelian/');
    }
    
	public function simpan_pembelian()
	{
		$data['user_ion'] = $this->ion_auth->user()->row();   
        $hutang = $this->input->post('tunai') - $this->input->post('ttl_harga');
        $kd_barang = $this->input->post('kd_barang');
        $nama_pembeli = $this->input->post('nama_pembeli');
        $data['cek_barang'] = $this->m_data->cek_barang($kd_barang)->row();
        //echo $data['cek_barang']->kode_barang;
        if(empty($data['cek_barang']->kode_barang)){
            $bln = date('m');
            $thn = date('Y');
            $databr = array(
            'kode_barang' => $this->input->post('kd_barang'),
            'nama_barang' => $this->input->post('nama_barang'),
            'stock' => $this->input->post('stock'),
            'harga_pokok' => $this->input->post('harga_jual'), 
            'kelipatan' => $this->input->post('kelipatan'),
            'diskon' => $this->input->post('diskon'),
            'expierd' => $this->input->post('tanggal_expired'),
            'nama_pembeli_ss' => $nama_pembeli,
            );
            
            $this->m_data->input_data($databr,'persediaan_barang');
                $ttl_harga =  $this->input->post('harga_pembelian') * $this->input->post('stock');
             $bln = date('m');
                $thn = date('Y');
            $skrg = date("Y-m-d");
            
            if($this->input->post('optradio') == 'lunas'){
$data = array(
            'tanggal_pembelian' => $skrg,        
            'kode_supplier' => $this->input->post('supplier'),        
            'kode_barang' => $this->input->post('kd_barang'),        
            'nama_barang' => $this->input->post('nama_barang'),        
            'satuan_barang' => $this->input->post('kategori'),        
            'harga_pokok' => $this->input->post('harga_jual'),        
            'harga_beli' => $this->input->post('harga_pembelian'),        
            'jumlah_beli' => $this->input->post('stock'),        
            'total_harga' => $ttl_harga,        
            'diskon' => $this->input->post('diskon'),
                    'bulan_pembelian' => $bln,
                'tahun' => $thn,
            'status' => "lunas",
            'nama_pembeli_barang' => $nama_pembeli,
            );
            }else{
                $data = array(
            'tanggal_pembelian' => $skrg,        
            'kode_supplier' => $this->input->post('supplier'),        
            'kode_barang' => $this->input->post('kd_barang'),        
            'nama_barang' => $this->input->post('nama_barang'),        
            'satuan_barang' => $this->input->post('kategori'),        
            'harga_pokok' => $this->input->post('harga_jual'),        
            'harga_beli' => $this->input->post('harga_pembelian'),        
            'jumlah_beli' => $this->input->post('stock'),        
            'total_harga' => $ttl_harga,        
            'diskon' => $this->input->post('diskon'),
                    'bulan_pembelian' => $bln,
                'tahun' => $thn,
            'status' => 'kredit',
            'tgl_tempo_kredit' => $this->input->post('tgl_tempo'),
            'nama_pembeli_barang' => $nama_pembeli,
            );
            }

            $this->m_data->input_data($data,'pembelian_barang');
            $data['akhir'] = $this->m_data->cek_akhir_pembelian()->row();
            $kd_pem = $data['akhir']->kd_pembelian;

            $datex = date("Y-m-d");
            $ketx= 'Pembelian Barang '.$this->input->post('nama_barang');
            $dataz = array(
            'kredit' => $ttl_harga,
            'kd_pembelian' => $kd_pem,
            'tanggal_transaksi' => $datex,
            'keterangan' => $ketx,
            );

            $this->m_data->input_data($dataz,'kas');
            redirect('pembelian/');
        }else{
            if($data['cek_barang']->kode_barang == $kd_barang){
            $where = array(
            'kode_barang' => $kd_barang,
            );
            
            $stock = $data['cek_barang']->stock + $this->input->post('stock');
            
            $databr = array(
            'nama_barang' => $this->input->post('nama_barang'),
            'stock' => $stock,
            'harga_pokok' => $this->input->post('harga_jual'),
            'kelipatan' => $this->input->post('kelipatan'),
            'diskon' => $this->input->post('diskon'),
            'expierd' => $this->input->post('tanggal_expired'),
            'nama_pembeli_barang' => $nama_pembeli,
            );
            $this->m_data->update_data($where,$databr,'persediaan_barang');
//        redirect('pembelian/');
            
        }else{
            $bln = date('m');
            $thn = date('Y');
            $databr = array(
            'kode_barang' => $this->input->post('kd_barang'),
            'nama_barang' => $this->input->post('nama_barang'),
            'stock' => $this->input->post('stock'),
            'harga_pokok' => $this->input->post('harga_jual'), 
            'kelipatan' => $this->input->post('kelipatan'),
            'diskon' => $this->input->post('diskon'),
            'expierd' => $this->input->post('tanggal_expired'),
            'nama_pembeli_ss' => $nama_pembeli,
            );
            
            $this->m_data->input_data($databr,'persediaan_barang');
                $ttl_harga =  $this->input->post('harga_pembelian') * $this->input->post('stock');
             $bln = date('m');
                $thn = date('Y');
            $skrg = date("Y-m-d");
            
            if($this->input->post('optradio') == 'lunas'){
$data = array(
            'tanggal_pembelian' => $skrg,        
            'kode_supplier' => $this->input->post('supplier'),        
            'kode_barang' => $this->input->post('kd_barang'),        
            'nama_barang' => $this->input->post('nama_barang'),        
            'satuan_barang' => $this->input->post('kategori'),        
            'harga_pokok' => $this->input->post('harga_jual'),        
            'harga_beli' => $this->input->post('harga_pembelian'),        
            'jumlah_beli' => $this->input->post('stock'),        
            'total_harga' => $ttl_harga,        
            'diskon' => $this->input->post('diskon'),
                    'bulan_pembelian' => $bln,
                'tahun' => $thn,
            'status' => "lunas",
            'nama_pembeli_barang' => $nama_pembeli,
            );
            }else{
                $data = array(
            'tanggal_pembelian' => $skrg,        
            'kode_supplier' => $this->input->post('supplier'),        
            'kode_barang' => $this->input->post('kd_barang'),        
            'nama_barang' => $this->input->post('nama_barang'),        
            'satuan_barang' => $this->input->post('kategori'),        
            'harga_pokok' => $this->input->post('harga_jual'),        
            'harga_beli' => $this->input->post('harga_pembelian'),        
            'jumlah_beli' => $this->input->post('stock'),        
            'total_harga' => $ttl_harga,        
            'diskon' => $this->input->post('diskon'),
                    'bulan_pembelian' => $bln,
                'tahun' => $thn,
            'status' => 'kredit',
            'tgl_tempo_kredit' => $this->input->post('tgl_tempo'),
            'nama_pembeli_barang' => $nama_pembeli,
            );
            }


            $this->m_data->input_data($data,'pembelian_barang');
            $data['akhir'] = $this->m_data->cek_akhir_pembelian()->row();
            $kd_pem = $data['akhir']->kd_pembelian;

            $datex = date("Y-m-d");
            $ketx= 'Pembelian Barang '.$this->input->post('nama_barang');
            $dataz = array(
            'kredit' => $ttl_harga,
            'kd_pembelian' => $kd_pem,
            'tanggal_transaksi' => $datex,
            'keterangan' => $ketx,
            );

            $this->m_data->input_data($dataz,'kas');
            redirect('pembelian/');

            }
        }
    /*    $data = array(
        'tanggal_pembelian' => $this->input->post('tanggal_pembelian'),        
        'kode_supplier' => $this->input->post('supplier'),        
        'kode_barang' => $this->input->post('kd_barang'),        
        'nama_barang' => $this->input->post('nama_barang'),        
        'satuan_barang' => $this->input->post('kategori'),        
        'harga_pokok' => $this->input->post('harga_pokok'),        
        'jumlah_beli' => $this->input->post('qty'),        
        'total_harga' => $this->input->post('ttl_harga'),        
        'status' => $this->input->post('kredit'),        
        'bayar' => $this->input->post('tunai'),        
        'tanggal_pelunasan' => $this->input->post('tanggal_pelunasan'),            
        'hutang' => $hutang,        
        );
        */        
        
	}
    public function hapus_pembelian($id)
	{ 
    $data['user_ion'] = $this->ion_auth->user()->row();   
       $where = array(
            'kode_barang' => $kd_barang
        );
        
        
        
    }

    function tambah_barang_suplier(){
        $data['user_ion'] = $this->ion_auth->user()->row();
        $data['kategori'] = $this->m_data->semua('kategori_barang')->result();
        $data['jenis'] = $this->m_data->semua('jenis_barang')->result();
        $data['satuan'] = $this->m_data->semua('satuan_barang')->result();
        $data['barang'] = $this->m_data->barang_suplier()->result();
        $data['title'] = 'Form Pembelian | Stikesmart';
        $this->load->view('header',$data);
        $this->load->view('tambah_data_suplier');
        $this->load->view('footer');
    }

    function proses_tambah_barang_suplier($id){
        $harga_beli = str_replace('.','',$this->input->post('harga_beli'));
        $diskon_beli = str_replace('.','',$this->input->post('diskon_beli'));
        $harga_netto_beli = str_replace('.','',$this->input->post('netto'));
        $date = date('Y-m-d H:i:s');
        $data = [
            'kd_jenis_barang' => $this->input->post('jenis'),
            'kd_kategori_barang' => $this->input->post('kategori'),
            'nama_barang' => $this->input->post('nama_barang'),
            'tanggal_expired' => $this->input->post('tgl_ex'),
            'satuan_barang' => $this->input->post('satuan'),
            'harga_beli_satuan' => $harga_beli,
            'diskon_beli_satuan' => $diskon_beli,
            'harga_netto_satuan' => $harga_netto_beli,
            'id_user' => $id,
            'kode_barang' => $this->input->post('kode_barang'),
            'harga_pokok' => $this->input->post('harga_pokok'),
            'stock' => $this->input->post('stock'),
            'kelipatan' => $this->input->post('kelipatan'),
            'diskon' => $this->input->post('diskon'),
            // 'total_beli' => $this->input->post('total_beli'),
            'created' => $date,
        ];

        $this->m_data->input_data($data,'barang');
            $this->session->set_flashdata('alert','<div class="alert alert-success alert-dismissible fade in">
                     <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                    <strong>Berhasil </strong> Menambah Data.
                   </div>');
            redirect('pembelian/tambah_barang_suplier');

        
    }

    function load_kode($val = null){

        (is_null($val)) ? $var='' : $var=$val;

        $data['cek_kode'] = $this->m_data->cek_kode_barang($var)->row();

        if(empty($data['cek_kode'])){
            
        }else{
            echo '<div class="alert alert-warning alert-dismissible fade in">
                      <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                     <strong>Kode barang </strong> yang anda masukkan sudah ada.
                    </div>';
            echo'<script>
                $("#simpan_barang").attr("disabled", "disabled");
            </script>';
        }
    }

    function proses_edit_barang_suplier($user,$id){
        $data = [
            'kd_jenis_barang' => $this->input->post('jenis'),
            'kd_kategori_barang' => $this->input->post('kategori'),
            'nama_barang' => $this->input->post('nama_barang'),
            'tanggal_expired' => $this->input->post('tgl_ex'),
            'satuan_barang' => $this->input->post('satuan'),
            'harga_beli_satuan' => $this->input->post('harga_beli'),
            'diskon_beli_satuan' => $this->input->post('diskon_beli'),
            'harga_netto_satuan' => $this->input->post('netto'),
            'id_user' => $user,
            'kode_barang' => $this->input->post('kode_barang'),
        ];

        $this->m_data->update_data(['id_barang' => $id],$data,'barang');
        $this->session->set_flashdata('alert','<div class="alert alert-success alert-dismissible fade in">
                     <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                    <strong>Berhasil </strong> Mengedit Data.
                   </div>');
        redirect('pembelian/tambah_barang_suplier');
    }

    function proses_hapus_barang_suplier($id){
        $base_64 = $id . str_repeat('=', strlen($id) % 4);
        $datax = base64_decode($base_64);
        $this->m_data->hapus_data(['id_barang' => $datax],'barang');
        $this->session->set_flashdata('alert','<div class="alert alert-success alert-dismissible fade in">
                     <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                    <strong>Berhasil </strong> Hapus Data.
                   </div>');
        redirect('pembelian/tambah_barang_suplier');
    }
    
}
