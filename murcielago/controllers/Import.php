<?php

class Import extends CI_Controller{
    function __construct(){
    parent::__construct();		
         $this->load->library(array('PHPExcel','PHPExcel/IOFactory'));
        $this->load->model('m_data');
        $this->load->helper('url');
        $this->load->helper("file");
        $this->load->model('ion_auth_model');
    if(!$this->ion_auth->logged_in()){
			redirect("auth/login");
		}
    }
    function index(){
        $data['user_ion'] = $this->ion_auth->user()->row();   
		$this->load->view('header',$data);
		$this->load->view('import_excel',$data);
		$this->load->view('footer');
    }
    function upload_pem(){
        $data['user_ion'] = $this->ion_auth->user()->row();   
		$this->load->view('header',$data);
		$this->load->view('import_excel2',$data);
		$this->load->view('footer');
    }
    public function upload(){
        $fileName = time().$_FILES['file']['name'];
         
        $config['upload_path'] = './assets/file_doc/'; //buat folder dengan nama assets di root folder
        $config['file_name'] = $fileName;
        $config['allowed_types'] = 'xls|xlsx|csv';
        $config['max_size'] = 10000;
         
        $this->load->library('upload');
        $this->upload->initialize($config);
         
        if(! $this->upload->do_upload('file') )
        $this->upload->display_errors();
             
        $media = $this->upload->data('file');
        $inputFileName = './assets/file_doc/'.$config['file_name'].'';
        try {
                $inputFileType = IOFactory::identify($inputFileName);
                $objReader = IOFactory::createReader($inputFileType);
                $objPHPExcel = $objReader->load($inputFileName);
            } catch(Exception $e) {
                die('Error loading file "'.pathinfo($inputFileName,PATHINFO_BASENAME).'": '.$e->getMessage());
            }
 
            $sheet = $objPHPExcel->getSheet(0);
            $highestRow = $sheet->getHighestRow();
            $highestColumn = $sheet->getHighestColumn();
             
            for ($row = 2; $row <= $highestRow; $row++){                  //  Read a row of data into an array                 
                $rowData = $sheet->rangeToArray('A' . $row . ':' . $highestColumn . $row,
                                                NULL,
                                                TRUE,
                                                FALSE);
                                                 
                //Sesuaikan sama nama kolom tabel di database                                
                 $data = array(
                    "kd_pembeli"=> $rowData[0][0],
                    "nama_pembeli"=> $rowData[0][1],
                    //"alamat"=> $rowData[0][2],
                    //"kontak"=> $rowData[0][3]
                );
                 
                //sesuaikan nama dengan nama tabel
                $insert = $this->db->insert("pembeli",$data);
                delete_files('./assets/file_doc/'.$config['file_name'].'');
                     
            }
        redirect('import/');
    } 
    public function upload_ke2(){
        ini_set('memory_limit', '-1');
        $fileName = time().$_FILES['file']['name'];
         
        $config['upload_path'] = './assets/file_doc/'; //buat folder dengan nama assets di root folder
        $config['file_name'] = $fileName;
        $config['allowed_types'] = 'xls|xlsx|csv';
        $config['max_size'] = 10000;
         
        $this->load->library('upload');
        $this->upload->initialize($config);
         
        if(! $this->upload->do_upload('file') )
        $this->upload->display_errors();
             
        $media = $this->upload->data('file');
        $inputFileName = './assets/file_doc/'.$config['file_name'].'';
        try {
                $inputFileType = IOFactory::identify($inputFileName);
                $objReader = IOFactory::createReader($inputFileType);
                $objPHPExcel = $objReader->load($inputFileName);
            } catch(Exception $e) {
                die('Error loading file "'.pathinfo($inputFileName,PATHINFO_BASENAME).'": '.$e->getMessage());
            }
 
            $sheet = $objPHPExcel->getSheet(0);
            $highestRow = $sheet->getHighestRow();
            $highestColumn = $sheet->getHighestColumn();
             
            for ($row = 2; $row <= $highestRow; $row++){                  //  Read a row of data into an array                 
                $rowData = $sheet->rangeToArray('A' . $row . ':' . $highestColumn . $row,
                                                NULL,
                                                TRUE,
                                                FALSE);
                                                 
                
                $data['pembelian_akhir'] =  $this->m_data->cek_terakhir_pem()->row();
                $angka = $data['pembelian_akhir']->kd_pembelian;
                $total1 = $angka+$row;
                $data['persediaan_akhir'] =  $this->m_data->cek_terakhir_per()->row();
                $angka1 = $data['persediaan_akhir']->kd_nota;
                $total2 = $angka1+$row;
                //Sesuaikan sama nama kolom tabel di database                                
                 $data = array(
                    "kd_pembelian"=> $total1,
                    "tanggal_pembelian"=> $rowData[0][0],
                    "kode_supplier"=> $rowData[0][1],
                    "kode_barang"=> $rowData[0][2],
                    "nama_barang"=> $rowData[0][3],
                    "satuan_barang"=> $rowData[0][4],
                    "harga_pokok"=> $rowData[0][5],
                    "jumlah_beli"=> $rowData[0][6],
                    "total_harga"=> $rowData[0][7],
                    "status"=> $rowData[0][8],
                    "bayar"=> $rowData[0][9],
                    "tanggal_pelunasan"=> $rowData[0][10],
                    "hutang"=> $rowData[0][11],
                    "kategori"=> $rowData[0][12],
                    "diskon"=> $rowData[0][13],
                    "harga_beli"=> $rowData[0][14],
                    "bulan_pembelian"=> $rowData[0][15],
                    "tahun"=> $rowData[0][16],
                    "nama_pembeli_barang"=> $rowData[0][17],
                    //"alamat"=> $rowData[0][2],
                    //"kontak"=> $rowData[0][3]
                );
                $data2 = array(
                    "kd_nota" => $total2,
                    "nama_barang" => $rowData[0][3],
                    "harga_pokok" => $rowData[0][5],
                    "stock" => $rowData[0][6],
                    "kode_barang" => $rowData[0][2],
                    "kelipatan" => '0',
                    "diskon" => $rowData[0][13],
                    "min_stock" => '2',
                    "expierd" => '2017-09-20',
                    "total_dibeli" => '0',
                    "status_s" => '0',
                    "nama_pembeli_ss" => $rowData[0][17],
                );
//                 
                //sesuaikan nama dengan nama tabel
                $insert = $this->db->insert("pembelian_barang",$data);
                $insert2 = $this->db->insert("persediaan_barang",$data2);
                delete_files('./assets/file_doc/'.$config['file_name'].'');
                     
            }
        redirect('pembelian/');
    }
}