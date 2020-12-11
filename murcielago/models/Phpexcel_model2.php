<?php
defined('BASEPATH') OR exit('No direct script access allowed');
 
class Phpexcel_model extends CI_Model {
 
    public function upload_data($filename){
        ini_set('memory_limit', '-1');
        $inputFileName = './assets/file_doc/'.$filename;
        try {
        $objPHPExcel = PHPExcel_IOFactory::load($inputFileName);
        } catch(Exception $e) {
        die('Error loading file :' . $e->getMessage());
        }
 
        $rowData = $objPHPExcel->getActiveSheet()->toArray(null,true,true,true);
        $numRows = count($worksheet);
 
        for ($i=1; $i < ($numRows+1) ; $i++) { 
            $tgl_asli = str_replace('/', '-', $rowData[$i]['B']);
            $exp_tgl_asli = explode('-', $tgl_asli);
            $exp_tahun = explode(' ', $exp_tgl_asli[2]);
            $tgl_sql = $exp_tahun[0].'-'.$exp_tgl_asli[0].'-'.$exp_tgl_asli[1].' '.$exp_tahun[1];
 
            $ins = array(
                     "kd_pembelian"=> $rowData[$i]["A"],
                    "tanggal_pembelian"=> $rowData[$i]["B"],
                    "kode_supplier"=> $rowData[$i]["C"],
                    "kode_barang"=> $rowData[$i]["D"],
                    "nama_barang"=> $rowData[$i]["E"],
                    "satuan_barang"=> $rowData[$i]["F"],
                    "harga_pokok"=> $rowData[$i]["G"],
                    "jumlah_beli"=> $rowData[$i]["H"],
                    "total_harga"=> $rowData[$i]["I"],
                    "status"=> $rowData[$i]["J"],
                    "bayar"=> $rowData[$i]["K"],
                    "tanggal_pelunasan"=> $rowData[$i]["L"],
                    "hutang"=> $rowData[$i]["M"],
                    "kategori"=> $rowData[$i]["N"],
                    "diskon"=> $rowData[$i]["O"],
                    "harga_beli"=> $rowData[$i]["P"],
                    "bulan_pembelian"=> $rowData[$i]["Q"],
                    "tahun"=> $rowData[$i]["R"],
                    "nama_pembeli_barang"=> $rowData[$i]["S"],
                   );
 
            $this->db->insert('pembelian_barang', $ins);
        }
    }
 
}