<?php
defined('BASEPATH') OR exit('No direct script access allowed');


class Export_sys extends CI_Controller{
    function __construct(){
        parent::__construct();
        $this->load->library(array('PHPExcel','PHPExcel/IOFactory'));
        $this->load->model('mread'); // memanggil model mread
    }
    public function export($tgl1,$tgl2){
        $ambildata = $this->mread->export_kontak($this->uri->segment(3),$this->uri->segment(4));

        if(count($ambildata)>0){
            $objPHPExcel = new PHPExcel();
            // Set properties
            $objPHPExcel->getProperties()
                  ->setCreator("Angger Test") //creator
                    ->setTitle("Belum Ada Judul");  //file title

            $objset = $objPHPExcel->setActiveSheetIndex(0); //inisiasi set object
            $objget = $objPHPExcel->getActiveSheet();  //inisiasi get object

            $objget->setTitle('Sample Sheet'); //sheet title
            //Warna header tabel
            $objget->getStyle("A1:K1")->applyFromArray(
                array(
                    'fill' => array(
                        'type' => PHPExcel_Style_Fill::FILL_SOLID,
                        'color' => array('rgb' => '92d050')
                    ),
                    'font' => array(
                        'color' => array('rgb' => '000000')
                    )
                )
            );

            //table header
            $cols = array("A","B","C","D","E","F","G","H","I","J","K");

            $val = array("Nama Pembeli","Kode Penjualan","Kode Nota","Jumlah Beli","Tanggal Penjualan","status","Diskon","Total Harga","Kode Nota","Kode Barang","Satuan");

            for ($a=0;$a<11; $a++)
            {
                $objset->setCellValue($cols[$a].'1', $val[$a]);

                //Setting lebar cell
                $objPHPExcel->getActiveSheet()->getColumnDimension('A')->setWidth(25); // NAMA
                $objPHPExcel->getActiveSheet()->getColumnDimension('B')->setWidth(25); // ALAMAT
                $objPHPExcel->getActiveSheet()->getColumnDimension('C')->setWidth(25); // Kontak
                $objPHPExcel->getActiveSheet()->getColumnDimension('D')->setWidth(25); // Kontak
                $objPHPExcel->getActiveSheet()->getColumnDimension('E')->setWidth(25); // Kontak
                $objPHPExcel->getActiveSheet()->getColumnDimension('F')->setWidth(25); // Kontak
                $objPHPExcel->getActiveSheet()->getColumnDimension('G')->setWidth(25); // Kontak
                $objPHPExcel->getActiveSheet()->getColumnDimension('H')->setWidth(25); // Kontak
                $objPHPExcel->getActiveSheet()->getColumnDimension('I')->setWidth(25); // Kontak
                $objPHPExcel->getActiveSheet()->getColumnDimension('J')->setWidth(25); // Kontak
                $objPHPExcel->getActiveSheet()->getColumnDimension('K')->setWidth(25); // Kontak

                $style = array(
                    'alignment' => array(
                        'horizontal' => PHPExcel_Style_Alignment::VERTICAL_CENTER,
                    )
                );
                $objPHPExcel->getActiveSheet()->getStyle($cols[$a].'1')->applyFromArray($style);
            }

            $baris  = 2;
            foreach ($ambildata as $frow){

               //pemanggilan sesuaikan dengan nama kolom tabel
                $objset->setCellValue("A".$baris, $frow->nama_pembeli); //membaca data nama
                $objset->setCellValue("B".$baris, $frow->kd_penjualan); //membaca data alamat
                $objset->setCellValue("C".$baris, $frow->kd_nota); //membaca data alamat
                $objset->setCellValue("D".$baris, $frow->jumlah_beli); //membaca data alamat
                $objset->setCellValue("E".$baris, $frow->tanggal_penjualan); //membaca data alamat
                $objset->setCellValue("F".$baris, $frow->status); //membaca data alamat
                $objset->setCellValue("G".$baris, $frow->sum_diskon); //membaca data alamat
                $objset->setCellValue("H".$baris, $frow->total_harga); //membaca data alamat
                $objset->setCellValue("I".$baris, $frow->kd_nota); //membaca data alamat
                $objset->setCellValue("J".$baris, $frow->kode_barang); //membaca data alamat
                $objset->setCellValue("K".$baris, $frow->satuan); //membaca data alamat

                //Set number value
                $objPHPExcel->getActiveSheet()->getStyle('K1:K'.$baris)->getNumberFormat()->setFormatCode('0');

                $baris++;
            }

            $objPHPExcel->getActiveSheet()->setTitle('Data Export');

            $objPHPExcel->setActiveSheetIndex(0);
            $filename = urlencode("Data".date("Y-m-d H:i:s").".xls");

              header('Content-Type: application/vnd.ms-excel'); //mime type
              header('Content-Disposition: attachment;filename="'.$filename.'"'); //tell browser what's the file name
              header('Cache-Control: max-age=0'); //no cache

            $objWriter = IOFactory::createWriter($objPHPExcel, 'Excel5');
            $objWriter->save('php://output');
        }else{
            redirect('Excel');
        }
    }

    public function export_kas_masuk($tgl1,$tgl2){
        $ambildata = $this->mread->export_masuk($this->uri->segment(3),$this->uri->segment(4));

        if(count($ambildata)>0){
            $objPHPExcel = new PHPExcel();
            // Set properties
            $objPHPExcel->getProperties()
                  ->setCreator("Angger Test") //creator
                    ->setTitle("Belum Ada Judul");  //file title

            $objset = $objPHPExcel->setActiveSheetIndex(0); //inisiasi set object
            $objget = $objPHPExcel->getActiveSheet();  //inisiasi get object

            $objget->setTitle('Sample Sheet'); //sheet title
            //Warna header tabel
            $objget->getStyle("A1:B1")->applyFromArray(
                array(
                    'fill' => array(
                        'type' => PHPExcel_Style_Fill::FILL_SOLID,
                        'color' => array('rgb' => '92d050')
                    ),
                    'font' => array(
                        'color' => array('rgb' => '000000')
                    )
                )
            );

            //table header
            $cols = array("A","B");

            $val = array("Tanggal Transaksi","Debet");

            for ($a=0;$a<2; $a++)
            {
                $objset->setCellValue($cols[$a].'1', $val[$a]);

                //Setting lebar cell
                $objPHPExcel->getActiveSheet()->getColumnDimension('A')->setWidth(25); // NAMA
                $objPHPExcel->getActiveSheet()->getColumnDimension('B')->setWidth(25); // ALAMAT
                //$objPHPExcel->getActiveSheet()->getColumnDimension('C')->setWidth(25); // Kontak
                $style = array(
                    'alignment' => array(
                        'horizontal' => PHPExcel_Style_Alignment::VERTICAL_CENTER,
                    )
                );
                $objPHPExcel->getActiveSheet()->getStyle($cols[$a].'1')->applyFromArray($style);
            }

            $baris  = 2;
            foreach ($ambildata as $frow){

               //pemanggilan sesuaikan dengan nama kolom tabel
                $objset->setCellValue("A".$baris, $frow->tanggal_transaksi); //membaca data nama
                $objset->setCellValue("B".$baris, $frow->debet); //membaca data alamat
                //$objset->setCellValue("C".$baris, $frow->kd_nota); //membaca data alamat
                //Set number value
                $objPHPExcel->getActiveSheet()->getStyle('C1:C'.$baris)->getNumberFormat()->setFormatCode('0');

                $baris++;
            }

            $objPHPExcel->getActiveSheet()->setTitle('Data Export');

            $objPHPExcel->setActiveSheetIndex(0);
            $filename = urlencode("Data".date("Y-m-d H:i:s").".xls");

              header('Content-Type: application/vnd.ms-excel'); //mime type
              header('Content-Disposition: attachment;filename="'.$filename.'"'); //tell browser what's the file name
              header('Cache-Control: max-age=0'); //no cache

            $objWriter = IOFactory::createWriter($objPHPExcel, 'Excel5');
            $objWriter->save('php://output');
        }else{
            redirect('Excel');
        }
    }

    public function export_barang_masuk(){
        $ambildata = $this->mread->export_data_barang();

        if(count($ambildata)>0){
            $objPHPExcel = new PHPExcel();
            // Set properties
            $objPHPExcel->getProperties()
                  ->setCreator("Angger Test") //creator
                    ->setTitle("Belum Ada Judul");  //file title

            $objset = $objPHPExcel->setActiveSheetIndex(0); //inisiasi set object
            $objget = $objPHPExcel->getActiveSheet();  //inisiasi get object

            $objget->setTitle('Sample Sheet'); //sheet title
            //Warna header tabel
            $objget->getStyle("A1:J1")->applyFromArray(
                array(
                    'fill' => array(
                        'type' => PHPExcel_Style_Fill::FILL_SOLID,
                        'color' => array('rgb' => '92d050')
                    ),
                    'font' => array(
                        'color' => array('rgb' => '000000')
                    )
                )
            );

            //table header
            $cols = array("A","B","C","D","E","F","G","H","I","J");

            $val = array("Nama Barang","Harga Pokok","Stok","Total Harga","Kode Barang","Max Pembelian Diskon","Diskon","Tanggal Pembelian","Nama Supplier","Status Barang","Tanggal Kadaluarsa");

            for ($a=0;$a<10; $a++)
            {
                $objset->setCellValue($cols[$a].'1', $val[$a]);

                //Setting lebar cell
                $objPHPExcel->getActiveSheet()->getColumnDimension('A')->setWidth(25); // NAMA
                $objPHPExcel->getActiveSheet()->getColumnDimension('B')->setWidth(25); // ALAMAT
                $objPHPExcel->getActiveSheet()->getColumnDimension('C')->setWidth(25); // ALAMAT
                $objPHPExcel->getActiveSheet()->getColumnDimension('D')->setWidth(25); // ALAMAT
                $objPHPExcel->getActiveSheet()->getColumnDimension('E')->setWidth(25); // ALAMAT
                $objPHPExcel->getActiveSheet()->getColumnDimension('F')->setWidth(25); // ALAMAT
                $objPHPExcel->getActiveSheet()->getColumnDimension('G')->setWidth(25); // ALAMAT
                $objPHPExcel->getActiveSheet()->getColumnDimension('H')->setWidth(25); // ALAMAT
                $objPHPExcel->getActiveSheet()->getColumnDimension('I')->setWidth(25); // ALAMAT
                $objPHPExcel->getActiveSheet()->getColumnDimension('J')->setWidth(25); // ALAMAT
                $style = array(
                    'alignment' => array(
                        'horizontal' => PHPExcel_Style_Alignment::VERTICAL_CENTER,
                    )
                );
                $objPHPExcel->getActiveSheet()->getStyle($cols[$a].'1')->applyFromArray($style);
            }

            $baris  = 2;
            foreach ($ambildata as $frow){

               //pemanggilan sesuaikan dengan nama kolom tabel
                $objset->setCellValue("A".$baris, $frow->nama_barang); //membaca data nama
                $objset->setCellValue("B".$baris, $frow->harga_pokok); //membaca data alamat
                $objset->setCellValue("C".$baris, $frow->jumlah_beli); //membaca data alamat
                $objset->setCellValue("D".$baris, $frow->total_harga); //membaca data alamat
                $objset->setCellValue("E".$baris, $frow->kode_barang); //membaca data alamat
                $objset->setCellValue("F".$baris, $frow->kelipatan); //membaca data alamat
                $objset->setCellValue("G".$baris, $frow->diskon); //membaca data alamat
                $objset->setCellValue("H".$baris, $frow->tanggal_pembelian); //membaca data alamat
                $objset->setCellValue("I".$baris, $frow->nama_supplier); //membaca data alamat
                $objset->setCellValue("J".$baris, $frow->expierd); //membaca data alamat
                //Set number value
                $objPHPExcel->getActiveSheet()->getStyle('J1:J'.$baris)->getNumberFormat()->setFormatCode('0');

                $baris++;
            }

            $objPHPExcel->getActiveSheet()->setTitle('Data Export');

            $objPHPExcel->setActiveSheetIndex(0);
            $filename = urlencode("Data".date("Y-m-d H:i:s").".xls");

              header('Content-Type: application/vnd.ms-excel'); //mime type
              header('Content-Disposition: attachment;filename="'.$filename.'"'); //tell browser what's the file name
              header('Cache-Control: max-age=0'); //no cache

            $objWriter = IOFactory::createWriter($objPHPExcel, 'Excel5');
            $objWriter->save('php://output');
        }else{
            redirect('Excel');
        }
    }

    public function export_data_barang(){
        $ambildata = $this->mread->export_barang_masuk($this->uri->segment(3),$this->uri->segment(4));

        if(count($ambildata)>0){
            $objPHPExcel = new PHPExcel();
            // Set properties
            $objPHPExcel->getProperties()
                  ->setCreator("Angger Test") //creator
                    ->setTitle("Belum Ada Judul");  //file title

            $objset = $objPHPExcel->setActiveSheetIndex(0); //inisiasi set object
            $objget = $objPHPExcel->getActiveSheet();  //inisiasi get object

            $objget->setTitle('Sample Sheet'); //sheet title
            //Warna header tabel
            $objget->getStyle("A1:H1")->applyFromArray(
                array(
                    'fill' => array(
                        'type' => PHPExcel_Style_Fill::FILL_SOLID,
                        'color' => array('rgb' => '92d050')
                    ),
                    'font' => array(
                        'color' => array('rgb' => '000000')
                    )
                )
            );

            //table header
            $cols = array("A","B","C","D","E","F","G","H");

            $val = array("Tanggal Pembelian","Kode Barang","Nama Barang","Nama Supplier","Jenis Barang","Jumlah Beli","Harga Pokok","Total Harga");

            for ($a=0;$a<8; $a++)
            {
                $objset->setCellValue($cols[$a].'1', $val[$a]);

                //Setting lebar cell
                $objPHPExcel->getActiveSheet()->getColumnDimension('A')->setWidth(25); // NAMA
                $objPHPExcel->getActiveSheet()->getColumnDimension('B')->setWidth(25); // ALAMAT
                $objPHPExcel->getActiveSheet()->getColumnDimension('C')->setWidth(25); // ALAMAT
                $objPHPExcel->getActiveSheet()->getColumnDimension('D')->setWidth(25); // ALAMAT
                $objPHPExcel->getActiveSheet()->getColumnDimension('E')->setWidth(25); // ALAMAT
                $objPHPExcel->getActiveSheet()->getColumnDimension('F')->setWidth(25); // ALAMAT
                $objPHPExcel->getActiveSheet()->getColumnDimension('G')->setWidth(25); // ALAMAT
                $objPHPExcel->getActiveSheet()->getColumnDimension('H')->setWidth(25); // ALAMAT
                $style = array(
                    'alignment' => array(
                        'horizontal' => PHPExcel_Style_Alignment::VERTICAL_CENTER,
                    )
                );
                $objPHPExcel->getActiveSheet()->getStyle($cols[$a].'1')->applyFromArray($style);
            }

            $baris  = 2;
            foreach ($ambildata as $frow){

               //pemanggilan sesuaikan dengan nama kolom tabel
                $objset->setCellValue("A".$baris, $frow->tanggal_pembelian); //membaca data nama
                $objset->setCellValue("B".$baris, $frow->kode_barang); //membaca data alamat
                $objset->setCellValue("C".$baris, $frow->nama_barang); //membaca data alamat
                $objset->setCellValue("D".$baris, $frow->nama_supplier); //membaca data alamat
                $objset->setCellValue("E".$baris, $frow->satuan_barang); //membaca data alamat
                $objset->setCellValue("F".$baris, $frow->jumlah_beli); //membaca data alamat
                $objset->setCellValue("G".$baris, $frow->harga_pokok); //membaca data alamat
                $objset->setCellValue("H".$baris, $frow->total_harga); //membaca data alamat
                //Set number value
                $objPHPExcel->getActiveSheet()->getStyle('H1:H'.$baris)->getNumberFormat()->setFormatCode('0');

                $baris++;
            }

            $objPHPExcel->getActiveSheet()->setTitle('Data Export');

            $objPHPExcel->setActiveSheetIndex(0);
            $filename = urlencode("Data".date("Y-m-d H:i:s").".xls");

              header('Content-Type: application/vnd.ms-excel'); //mime type
              header('Content-Disposition: attachment;filename="'.$filename.'"'); //tell browser what's the file name
              header('Cache-Control: max-age=0'); //no cache

            $objWriter = IOFactory::createWriter($objPHPExcel, 'Excel5');
            $objWriter->save('php://output');
        }else{
            redirect('Excel');
        }
    }

    public function export_kas_keluar($tgl1,$tgl2){
        $ambildata = $this->mread->export_keluar($this->uri->segment(3),$this->uri->segment(4));

        if(count($ambildata)>0){
            $objPHPExcel = new PHPExcel();
            // Set properties
            $objPHPExcel->getProperties()
                  ->setCreator("Angger Test") //creator
                    ->setTitle("Belum Ada Judul");  //file title

            $objset = $objPHPExcel->setActiveSheetIndex(0); //inisiasi set object
            $objget = $objPHPExcel->getActiveSheet();  //inisiasi get object

            $objget->setTitle('Sample Sheet'); //sheet title
            //Warna header tabel
            $objget->getStyle("A1:B1")->applyFromArray(
                array(
                    'fill' => array(
                        'type' => PHPExcel_Style_Fill::FILL_SOLID,
                        'color' => array('rgb' => '92d050')
                    ),
                    'font' => array(
                        'color' => array('rgb' => '000000')
                    )
                )
            );

            //table header
            $cols = array("A","B");

            $val = array("Tanggal Transaksi","Kredit");

            for ($a=0;$a<2; $a++)
            {
                $objset->setCellValue($cols[$a].'1', $val[$a]);

                //Setting lebar cell
                $objPHPExcel->getActiveSheet()->getColumnDimension('A')->setWidth(25); // NAMA
                $objPHPExcel->getActiveSheet()->getColumnDimension('B')->setWidth(25); // ALAMAT
                //$objPHPExcel->getActiveSheet()->getColumnDimension('C')->setWidth(25); // Kontak
                $style = array(
                    'alignment' => array(
                        'horizontal' => PHPExcel_Style_Alignment::VERTICAL_CENTER,
                    )
                );
                $objPHPExcel->getActiveSheet()->getStyle($cols[$a].'1')->applyFromArray($style);
            }

            $baris  = 2;
            foreach ($ambildata as $frow){

               //pemanggilan sesuaikan dengan nama kolom tabel
                $objset->setCellValue("A".$baris, $frow->tanggal_transaksi); //membaca data nama
                $objset->setCellValue("B".$baris, $frow->kredit); //membaca data alamat
                //$objset->setCellValue("C".$baris, $frow->kd_nota); //membaca data alamat
                //Set number value
                $objPHPExcel->getActiveSheet()->getStyle('C1:C'.$baris)->getNumberFormat()->setFormatCode('0');

                $baris++;
            }

            $objPHPExcel->getActiveSheet()->setTitle('Data Export');

            $objPHPExcel->setActiveSheetIndex(0);
            $filename = urlencode("Data".date("Y-m-d H:i:s").".xls");

              header('Content-Type: application/vnd.ms-excel'); //mime type
              header('Content-Disposition: attachment;filename="'.$filename.'"'); //tell browser what's the file name
              header('Cache-Control: max-age=0'); //no cache

            $objWriter = IOFactory::createWriter($objPHPExcel, 'Excel5');
            $objWriter->save('php://output');
        }else{
            redirect('Excel');
        }
    }

    public function export_data_pembelian(){
        $ambildata = $this->mread->export_pembelian($this->uri->segment(3),$this->uri->segment(4));

        if(count($ambildata)>0){
            $objPHPExcel = new PHPExcel();
            // Set properties
            $objPHPExcel->getProperties()
                  ->setCreator("Angger Test") //creator
                    ->setTitle("Belum Ada Judul");  //file title

            $objset = $objPHPExcel->setActiveSheetIndex(0); //inisiasi set object
            $objget = $objPHPExcel->getActiveSheet();  //inisiasi get object

            $objget->setTitle('Sample Sheet'); //sheet title
            //Warna header tabel
            $objget->getStyle("A1:G1")->applyFromArray(
                array(
                    'fill' => array(
                        'type' => PHPExcel_Style_Fill::FILL_SOLID,
                        'color' => array('rgb' => '92d050')
                    ),
                    'font' => array(
                        'color' => array('rgb' => '000000')
                    )
                )
            );

            //table header
            $cols = array("A","B","C","D","E","F","G");

            $val = array("Nama Supplier","Kode Barang","Nama Barang","Jenis Barang","Harga Pokok","Jumlah Beli","Total Harga");

            for ($a=0;$a<7; $a++)
            {
                $objset->setCellValue($cols[$a].'1', $val[$a]);

                //Setting lebar cell
                $objPHPExcel->getActiveSheet()->getColumnDimension('A')->setWidth(25); // NAMA
                $objPHPExcel->getActiveSheet()->getColumnDimension('B')->setWidth(25); // ALAMAT
                $objPHPExcel->getActiveSheet()->getColumnDimension('C')->setWidth(25); // ALAMAT
                $objPHPExcel->getActiveSheet()->getColumnDimension('D')->setWidth(25); // ALAMAT
                $objPHPExcel->getActiveSheet()->getColumnDimension('E')->setWidth(25); // ALAMAT
                $objPHPExcel->getActiveSheet()->getColumnDimension('F')->setWidth(25); // ALAMAT
                $objPHPExcel->getActiveSheet()->getColumnDimension('G')->setWidth(25); // ALAMAT
                //$objPHPExcel->getActiveSheet()->getColumnDimension('C')->setWidth(25); // Kontak
                $style = array(
                    'alignment' => array(
                        'horizontal' => PHPExcel_Style_Alignment::VERTICAL_CENTER,
                    )
                );
                $objPHPExcel->getActiveSheet()->getStyle($cols[$a].'1')->applyFromArray($style);
            }

            $baris  = 2;
            foreach ($ambildata as $frow){

               //pemanggilan sesuaikan dengan nama kolom tabel
                $objset->setCellValue("A".$baris, $frow->nama_supplier); //membaca data nama
                $objset->setCellValue("B".$baris, $frow->kode_barang); //membaca data alamat
                $objset->setCellValue("C".$baris, $frow->nama_barang); //membaca data alamat
                $objset->setCellValue("D".$baris, $frow->satuan_barang); //membaca data alamat
                $objset->setCellValue("E".$baris, "Rp ".number_format($frow->harga_pokok)); //membaca data alamat
                $objset->setCellValue("F".$baris, $frow->jumlah_beli); //membaca data alamat
                $objset->setCellValue("G".$baris, "Rp ".number_format($frow->total_harga)); //membaca data alamat
                //$objset->setCellValue("C".$baris, $frow->kd_nota); //membaca data alamat
                //Set number value
                $objPHPExcel->getActiveSheet()->getStyle('G1:G'.$baris)->getNumberFormat()->setFormatCode('0');

                $baris++;
            }

            $objPHPExcel->getActiveSheet()->setTitle('Data Export');

            $objPHPExcel->setActiveSheetIndex(0);
            $filename = urlencode("Data".date("Y-m-d H:i:s").".xls");

              header('Content-Type: application/vnd.ms-excel'); //mime type
              header('Content-Disposition: attachment;filename="'.$filename.'"'); //tell browser what's the file name
              header('Cache-Control: max-age=0'); //no cache

            $objWriter = IOFactory::createWriter($objPHPExcel, 'Excel5');
            $objWriter->save('php://output');
        }else{
            redirect('Excel');
        }
    }

    public function export_data_penjualan(){
        $ambildata = $this->mread->export_penjualan($this->uri->segment(3),$this->uri->segment(4));

        if(count($ambildata)>0){
            $objPHPExcel = new PHPExcel();
            // Set properties
            $objPHPExcel->getProperties()
                  ->setCreator("Angger Test") //creator
                    ->setTitle("Belum Ada Judul");  //file title

            $objset = $objPHPExcel->setActiveSheetIndex(0); //inisiasi set object
            $objget = $objPHPExcel->getActiveSheet();  //inisiasi get object

            $objget->setTitle('Sample Sheet'); //sheet title
            //Warna header tabel
            $objget->getStyle("A1:E1")->applyFromArray(
                array(
                    'fill' => array(
                        'type' => PHPExcel_Style_Fill::FILL_SOLID,
                        'color' => array('rgb' => '92d050')
                    ),
                    'font' => array(
                        'color' => array('rgb' => '000000')
                    )
                )
            );

            //table header
            $cols = array("A","B","C","D","E");

            $val = array("Nama Pembeli","Kode Nota","Jumlah Beli","Tanggal Penjualan","Total Harga");

            for ($a=0;$a<5; $a++)
            {
                $objset->setCellValue($cols[$a].'1', $val[$a]);

                //Setting lebar cell
                $objPHPExcel->getActiveSheet()->getColumnDimension('A')->setWidth(25); // NAMA
                $objPHPExcel->getActiveSheet()->getColumnDimension('B')->setWidth(25); // ALAMAT
                $objPHPExcel->getActiveSheet()->getColumnDimension('C')->setWidth(25); // ALAMAT
                $objPHPExcel->getActiveSheet()->getColumnDimension('D')->setWidth(25); // ALAMAT
                $objPHPExcel->getActiveSheet()->getColumnDimension('E')->setWidth(25); // ALAMAT
                //$objPHPExcel->getActiveSheet()->getColumnDimension('C')->setWidth(25); // Kontak
                $style = array(
                    'alignment' => array(
                        'horizontal' => PHPExcel_Style_Alignment::VERTICAL_CENTER,
                    )
                );
                $objPHPExcel->getActiveSheet()->getStyle($cols[$a].'1')->applyFromArray($style);
            }

            $baris  = 2;
            foreach ($ambildata as $frow){

               //pemanggilan sesuaikan dengan nama kolom tabel
                $objset->setCellValue("A".$baris, $frow->nama_pembeli); //membaca data nama
                $objset->setCellValue("B".$baris, $frow->kd_nota); //membaca data alamat
                $objset->setCellValue("C".$baris, $frow->satuan); //membaca data alamat
                $objset->setCellValue("D".$baris, date("d-m-Y", strtotime($frow->tanggal_penjualan))); //membaca data alamat
                $objset->setCellValue("E".$baris, "Rp ".number_format($frow->total_harga)); //membaca data alamat
                //$objset->setCellValue("C".$baris, $frow->kd_nota); //membaca data alamat
                //Set number value
                $objPHPExcel->getActiveSheet()->getStyle('E1:E'.$baris)->getNumberFormat()->setFormatCode('0');

                $baris++;
            }

            $objPHPExcel->getActiveSheet()->setTitle('Data Export');

            $objPHPExcel->setActiveSheetIndex(0);
            $filename = urlencode("Data".date("Y-m-d H:i:s").".xls");

              header('Content-Type: application/vnd.ms-excel'); //mime type
              header('Content-Disposition: attachment;filename="'.$filename.'"'); //tell browser what's the file name
              header('Cache-Control: max-age=0'); //no cache

            $objWriter = IOFactory::createWriter($objPHPExcel, 'Excel5');
            $objWriter->save('php://output');
        }else{
            redirect('Excel');
        }
    }

    public function export_data_pembeli(){
        $ambildata = $this->mread->export_pembeli();

        if(count($ambildata)>0){
            $objPHPExcel = new PHPExcel();
            // Set properties
            $objPHPExcel->getProperties()
                  ->setCreator("Angger Test") //creator
                    ->setTitle("Belum Ada Judul");  //file title

            $objset = $objPHPExcel->setActiveSheetIndex(0); //inisiasi set object
            $objget = $objPHPExcel->getActiveSheet();  //inisiasi get object

            $objget->setTitle('Sample Sheet'); //sheet title
            //Warna header tabel
            $objget->getStyle("A1:A1")->applyFromArray(
                array(
                    'fill' => array(
                        'type' => PHPExcel_Style_Fill::FILL_SOLID,
                        'color' => array('rgb' => '92d050')
                    ),
                    'font' => array(
                        'color' => array('rgb' => '000000')
                    )
                )
            );

            //table header
            $cols = array("A");

            $val = array("Nama Pembeli");

            for ($a=0;$a<1; $a++)
            {
                $objset->setCellValue($cols[$a].'1', $val[$a]);

                //Setting lebar cell
                $objPHPExcel->getActiveSheet()->getColumnDimension('A')->setWidth(25); // NAMA
                //$objPHPExcel->getActiveSheet()->getColumnDimension('C')->setWidth(25); // Kontak
                $style = array(
                    'alignment' => array(
                        'horizontal' => PHPExcel_Style_Alignment::VERTICAL_CENTER,
                    )
                );
                $objPHPExcel->getActiveSheet()->getStyle($cols[$a].'1')->applyFromArray($style);
            }

            $baris  = 2;
            foreach ($ambildata as $frow){

               //pemanggilan sesuaikan dengan nama kolom tabel
                $objset->setCellValue("A".$baris, $frow->nama_pembeli); //membaca data nama
//                $objset->setCellValue("B".$baris, $frow->kd_nota); //membaca data alamat
//                $objset->setCellValue("C".$baris, $frow->satuan); //membaca data alamat
//                $objset->setCellValue("D".$baris, date("d-m-Y", strtotime($frow->tanggal_penjualan))); //membaca data alamat
//                $objset->setCellValue("E".$baris, "Rp ".number_format($frow->total_harga)); //membaca data alamat
                //$objset->setCellValue("C".$baris, $frow->kd_nota); //membaca data alamat
                //Set number value
                $objPHPExcel->getActiveSheet()->getStyle('A1:A'.$baris)->getNumberFormat()->setFormatCode('0');

                $baris++;
            }

            $objPHPExcel->getActiveSheet()->setTitle('Data Export');

            $objPHPExcel->setActiveSheetIndex(0);
            $filename = urlencode("Data".date("Y-m-d H:i:s").".xls");

              header('Content-Type: application/vnd.ms-excel'); //mime type
              header('Content-Disposition: attachment;filename="'.$filename.'"'); //tell browser what's the file name
              header('Cache-Control: max-age=0'); //no cache

            $objWriter = IOFactory::createWriter($objPHPExcel, 'Excel5');
            $objWriter->save('php://output');
        }else{
            redirect('Excel');
        }
    }

    public function export_pembelian(){
        $ambildata = $this->mread->export_pembelian_xxx();

        if(count($ambildata)>0){
            $objPHPExcel = new PHPExcel();
            // Set properties
            $objPHPExcel->getProperties()
                  ->setCreator("Angger Test") //creator
                    ->setTitle("Belum Ada Judul");  //file title

            $objset = $objPHPExcel->setActiveSheetIndex(0); //inisiasi set object
            $objget = $objPHPExcel->getActiveSheet();  //inisiasi get object

            $objget->setTitle('Sample Sheet'); //sheet title
            //Warna header tabel
            $objget->getStyle("A1:I1")->applyFromArray(
                array(
                    'fill' => array(
                        'type' => PHPExcel_Style_Fill::FILL_SOLID,
                        'color' => array('rgb' => '92d050')
                    ),
                    'font' => array(
                        'color' => array('rgb' => '000000')
                    )
                )
            );

            //table header
            $cols = array("A","B","C","D","E","F","G","H","I");

            $val = array("Tanggal Expired","Nama Supplier","Kode Barang","Nama Barang","Satuan Barang","Harga Pokok Per Barang","Stock Barang","Total Harga Pembelian","Status");

            for ($a=0;$a<9; $a++)
            {
                $objset->setCellValue($cols[$a].'1', $val[$a]);

                //Setting lebar cell
                $objPHPExcel->getActiveSheet()->getColumnDimension('A')->setWidth(25); // NAMA
                $objPHPExcel->getActiveSheet()->getColumnDimension('B')->setWidth(25); // NAMA
                $objPHPExcel->getActiveSheet()->getColumnDimension('C')->setWidth(25); // NAMA
                $objPHPExcel->getActiveSheet()->getColumnDimension('D')->setWidth(25); // NAMA
                $objPHPExcel->getActiveSheet()->getColumnDimension('E')->setWidth(25); // NAMA
                $objPHPExcel->getActiveSheet()->getColumnDimension('F')->setWidth(25); // NAMA
                $objPHPExcel->getActiveSheet()->getColumnDimension('G')->setWidth(25); // NAMA
                $objPHPExcel->getActiveSheet()->getColumnDimension('H')->setWidth(25); // NAMA
                $objPHPExcel->getActiveSheet()->getColumnDimension('I')->setWidth(25); // NAMA
                //$objPHPExcel->getActiveSheet()->getColumnDimension('C')->setWidth(25); // Kontak
                $style = array(
                    'alignment' => array(
                        'horizontal' => PHPExcel_Style_Alignment::VERTICAL_CENTER,
                    )
                );
                $objPHPExcel->getActiveSheet()->getStyle($cols[$a].'1')->applyFromArray($style);
            }

            $baris  = 2;
            foreach ($ambildata as $frow){

               //pemanggilan sesuaikan dengan nama kolom tabel
                $objset->setCellValue("A".$baris, date("d-m-Y", strtotime($frow->tanggal_pembelian))); //membaca data nama
                $objset->setCellValue("B".$baris, $frow->nama_supplier); //membaca data nama
                $objset->setCellValue("C".$baris, $frow->kode_barang); //membaca data nama
                $objset->setCellValue("D".$baris, $frow->nama_barang); //membaca data nama
                $objset->setCellValue("E".$baris, $frow->satuan_barang); //membaca data nama
                $objset->setCellValue("F".$baris, "Rp ".number_format($frow->harga_pokok)); //membaca data nama
                $objset->setCellValue("G".$baris, $frow->jumlah_beli); //membaca data nama
                $objset->setCellValue("H".$baris, "Rp ".number_format($frow->total_harga)); //membaca data nama
                $objset->setCellValue("I".$baris, $frow->status); //membaca data nama
                //Set number value
                $objPHPExcel->getActiveSheet()->getStyle('I1:I'.$baris)->getNumberFormat()->setFormatCode('0');

                $baris++;
            }

            $objPHPExcel->getActiveSheet()->setTitle('Data Export');

            $objPHPExcel->setActiveSheetIndex(0);
            $filename = urlencode("Data".date("Y-m-d H:i:s").".xls");

              header('Content-Type: application/vnd.ms-excel'); //mime type
              header('Content-Disposition: attachment;filename="'.$filename.'"'); //tell browser what's the file name
              header('Cache-Control: max-age=0'); //no cache

            $objWriter = IOFactory::createWriter($objPHPExcel, 'Excel5');
            $objWriter->save('php://output');
        }else{
            redirect('Excel');
        }
    }

    public function export_barang_keluar(){
        $ambildata = $this->mread->export_barang_keluar($this->uri->segment(3),$this->uri->segment(4));

        if(count($ambildata)>0){
            $objPHPExcel = new PHPExcel();
            // Set properties
            $objPHPExcel->getProperties()
                  ->setCreator("Angger Test") //creator
                    ->setTitle("Belum Ada Judul");  //file title

            $objset = $objPHPExcel->setActiveSheetIndex(0); //inisiasi set object
            $objget = $objPHPExcel->getActiveSheet();  //inisiasi get object

            $objget->setTitle('Sample Sheet'); //sheet title
            //Warna header tabel
            $objget->getStyle("A1:G1")->applyFromArray(
                array(
                    'fill' => array(
                        'type' => PHPExcel_Style_Fill::FILL_SOLID,
                        'color' => array('rgb' => '92d050')
                    ),
                    'font' => array(
                        'color' => array('rgb' => '000000')
                    )
                )
            );

            //table header
            $cols = array("A","B","C","D","E","F","G");

            $val = array("Nama Pembeli","Tanggal Penjualan","Jumlah Beli","Kode Barang","Nama Barang yang dibeli","Diskon","Harga");

            for ($a=0;$a<7; $a++)
            {
                $objset->setCellValue($cols[$a].'1', $val[$a]);

                //Setting lebar cell
                $objPHPExcel->getActiveSheet()->getColumnDimension('A')->setWidth(25); // NAMA
                $objPHPExcel->getActiveSheet()->getColumnDimension('B')->setWidth(25); // ALAMAT
                $objPHPExcel->getActiveSheet()->getColumnDimension('C')->setWidth(25); // ALAMAT
                $objPHPExcel->getActiveSheet()->getColumnDimension('D')->setWidth(25); // ALAMAT
                $objPHPExcel->getActiveSheet()->getColumnDimension('E')->setWidth(25); // ALAMAT
                $objPHPExcel->getActiveSheet()->getColumnDimension('F')->setWidth(25); // ALAMAT
                $objPHPExcel->getActiveSheet()->getColumnDimension('G')->setWidth(25); // ALAMAT
                $style = array(
                    'alignment' => array(
                        'horizontal' => PHPExcel_Style_Alignment::VERTICAL_CENTER,
                    )
                );
                $objPHPExcel->getActiveSheet()->getStyle($cols[$a].'1')->applyFromArray($style);
            }

            $baris  = 2;
            foreach ($ambildata as $frow){

               //pemanggilan sesuaikan dengan nama kolom tabel
                $objset->setCellValue("A".$baris, $frow->nama_pembeli); //membaca data nama
                $objset->setCellValue("B".$baris, date("d-m-Y", strtotime($frow->tanggal_penjualan))); //membaca data alamat
                $objset->setCellValue("C".$baris, $frow->jumlah_beli); //membaca data alamat
                $objset->setCellValue("D".$baris, $frow->kode_barang); //membaca data alamat
                $objset->setCellValue("E".$baris, $frow->nama_barang); //membaca data alamat
                if($frow->satuan>$frow->kelipatan){
                $objset->setCellValue("F".$baris, $frow->diskon."%"); //membaca data alamat
                }else{
                $objset->setCellValue("F".$baris, '0%'); //membaca data alamat
                }
                 $sub =  $frow->harga_pokok * $frow->satuan ;
                        if($frow->satuan>$frow->kelipatan){
                            $dis =  ( $sub * $frow->diskon) / 100;
                            $harga = $sub - $dis;
                        }else{
                             $harga = $sub;
                            }
                $objset->setCellValue("G".$baris, "Rp ".$harga); //membaca data alamat
                //Set number value
                $objPHPExcel->getActiveSheet()->getStyle('G1:G'.$baris)->getNumberFormat()->setFormatCode('0');

                $baris++;
            }

            $objPHPExcel->getActiveSheet()->setTitle('Data Export');

            $objPHPExcel->setActiveSheetIndex(0);
            $filename = urlencode("Data".date("Y-m-d H:i:s").".xls");

              header('Content-Type: application/vnd.ms-excel'); //mime type
              header('Content-Disposition: attachment;filename="'.$filename.'"'); //tell browser what's the file name
              header('Cache-Control: max-age=0'); //no cache

            $objWriter = IOFactory::createWriter($objPHPExcel, 'Excel5');
            $objWriter->save('php://output');
        }else{
            redirect('Excel');
        }
    }
}
