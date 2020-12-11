<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Kasir extends CI_Controller {
function __construct(){
		parent::__construct();
		if(!$this->ion_auth->logged_in()){
			redirect("auth/login");
		}
        date_default_timezone_set('Asia/Jakarta');
        $this->load->library('Ajax_pagination');
				 $this->load->library(array('PHPExcel','PHPExcel/IOFactory'));
        $this->perPage = 10;
	}
    private function code_number() {
        $gpass = NULL;
        $n = 2; // jumlah karakter yang akan di bentuk.
        $chr = "1234567890";
        for ($i = 0; $i < $n; $i++) {
        $rIdx = rand(1, strlen($chr));
        $gpass .=substr($chr, $rIdx, 1);
        }
        return $gpass;
    }
    function wo(){
        $ls = $this->m_data->ajax_search(array('kode_barang','nama_barang'),'barang',$this->input->post('search'))->result();
        echo json_encode($ls);
    }
	public function index(){
        $cari =  $this->input->post('cari');
        if(empty($cari)){

        }elseif(empty($data['car'] = $this->m_data->kasir_cari($cari)->row())){
             echo "<script>
alert('Barang Tidak Ada ! Cek kembali kode barang !');
window.location.href='".base_url()."';
</script>";
        }else{
        $data['car'] = $this->m_data->kasir_cari($cari)->row();
        $data['user_ion'] = $this->ion_auth->user()->row();
        }
                    $data['user_ion'] = $this->ion_auth->user()->row();

        $data['data_ss'] = $this->m_data->data_ss()->result_array();
        $data['daftar_barang'] = $this->m_data->daf_persediaan()->result_array();
        $data['pembeli'] = $this->m_data->pembeli()->result_array();
        $data['rec'] = $this->m_data->daf_persediaan()->result_array();
		$this->load->view('header',$data);
		$this->load->view('kasir',$data);
		$this->load->view('footer');
	}

    public function kasir2(){
        $data['title'] = 'Stikes Mart | Penjualan';
        $data['pembeli'] = $this->m_data->pembeli()->result_array();
        $this->load->view('user/header',$data);
        $this->load->view('kasir2');
        $this->load->view('user/footer');
    }

    public function data_pelanggan(){
        $data['title'] = 'Stikes Mart | Data Pelanggan';
        $data['pembeli'] = $this->m_data->data_pelanggan()->result();
        $dataku = array();
        //total rows count

        $totalRec = count($this->m_data->getRows2());

        //pagination configuration
        $config['target']      = '.postList';
        $config['base_url']    = base_url().'p/ajaxPaginationData12';
        $config['total_rows']  = $totalRec;
        $config['per_page']    = $this->perPage;
        $config['link_func']   = 'searchFilter';
        $this->ajax_pagination->initialize($config);

        //get the posts data
        $dataku['posts'] = $this->m_data->getRows2(array('limit'=>$this->perPage));
        $this->load->view('user/header',$data);
        $this->load->view('user/data_pelanggan',$dataku);
        $this->load->view('user/footer');
    }

    public function import_pelanggan(){
         $fileName = time().$_FILES['file']['name'];

        $config['upload_path'] = './assets_kasir/'; //buat folder dengan nama assets di root folder
        $config['file_name'] = $fileName;
        $config['allowed_types'] = 'xls|xlsx|csv';
        $config['max_size'] = 10000;

        $this->load->library('upload');
        $this->upload->initialize($config);

        if(! $this->upload->do_upload('file') )
        $this->upload->display_errors();

        $media = $this->upload->data('file');
        $inputFileName = './assets_kasir/'.$config['file_name'];

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
                $tgl_now = date('Y-m-d');
                 $data = array(
                    "kd_pelanggan"=> str_replace(" ","",$rowData[0][1]),
                    "nama_pembeli"=> $rowData[0][2],
                    "sumber_dana"=> $rowData[0][3],
                    "status_keanggotaan"=> $rowData[0][4],
										"kode_pelanggan_baru" => $rowData[0][1],
                    "created"=> $tgl_now,
                );

                //sesuaikan nama dengan nama tabel
                $insert = $this->db->insert("pembeli",$data);
                // unlink('assets_kasir/'.$config['file_name'].'');
            }
        redirect('kasir/data_pelanggan');
    }

    public function export_pelanggan(){
        $data['title'] = 'Data Pelanggan';
        $data['pembeli'] = $this->m_data->semua('pembeli')->result();
        $this->load->view('user/export_data_pelanggan',$data);
    }

    function add_pelanggan(){
        $dataArr = [
            'kd_pelanggan' => $this->input->post('kd_pelanggan'),
            'nama_pembeli' => $this->input->post('nama_pelanggan'),
            'sumber_dana' => $this->input->post('sumber_dana'),
            'status_keanggotaan' => $this->input->post('optradio')
        ];
        $this->db->insert('pembeli',$dataArr);
        $this->session->set_flashdata('alert','<div class="alert alert-success alert-dismissible fade in">
    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
    <strong>Berhasil!</strong> Menambah Data!
  </div>');
        redirect('kasir/data_pelanggan');
    }

    function update_pelanggan($id){
        $dataArr = [
            'kd_pelanggan' => $this->input->post('kd_pelanggan'),
            'nama_pembeli' => $this->input->post('nama_pelanggan'),
            'sumber_dana' => $this->input->post('sumber_dana'),
            'status_keanggotaan' => $this->input->post('optradio')
        ];
        $this->m_data->update_data(['kd_pembeli' => $id],$dataArr,'pembeli');
        $this->session->set_flashdata('alert','<div class="alert alert-success alert-dismissible fade in">
    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
    <strong>Berhasil!</strong> Menambah Data!
  </div>');
        redirect('kasir/data_pelanggan');
    }

    function delete_pelanggan($id){
        $this->m_data->hapus_data(['kd_pembeli' => $id],'pembeli');
        $this->session->set_flashdata('alert','<div class="alert alert-success alert-dismissible fade in">
        <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
        <strong>Berhasil!</strong> Hapus Data!
        </div>');
        redirect('kasir/data_pelanggan');
    }

    public function data_supplier(){
        $data['title'] = 'Stikes Mart | Data Supplier';
        $data['supplier'] = $this->m_data->semua('supplier')->result();
        $this->load->view('user/header',$data);
        $this->load->view('user/data_supplier');
        $this->load->view('user/footer');
    }

    function add_supplier(){
        $tgl_now = date('Y-m-d H:i:s');
        $dataArr = [
            'nama_supplier' => $this->input->post('nm_supplier'),
            'kode_supplier' => $this->input->post('kd_supplier'),
            'alamat_supplier' => $this->input->post('alamat'),
            'telpon' => $this->input->post('no_tlp'),
            'email' => $this->input->post('email_supplier'),
            'rekening' => $this->input->post('rek_supplier'),
            'created' => $tgl_now,
        ];
        $this->db->insert('supplier',$dataArr);
        $this->session->set_flashdata('alert','<div class="alert alert-success alert-dismissible fade in">
    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
    <strong>Berhasil!</strong> Menambah Data!
  </div>');
        redirect('kasir/data_supplier');
    }

    function update_supplier($id){
        $dataArr = [
            'nama_supplier' => $this->input->post('nm_supplier'),
            'kode_supplier' => $this->input->post('kd_supplier'),
            'alamat_supplier' => $this->input->post('alamat'),
            'telpon' => $this->input->post('no_tlp'),
            'email' => $this->input->post('email_supplier'),
            'rekening' => $this->input->post('rek_supplier'),
        ];
        $this->m_data->update_data(['kd_supplier' => $id],$dataArr,'supplier');
        $this->session->set_flashdata('alert','<div class="alert alert-success alert-dismissible fade in">
    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
    <strong>Berhasil!</strong> Update Data!
  </div>');
        redirect('kasir/data_supplier');
    }

    function import_supplier(){
        $fileName = time().$_FILES['file']['name'];

        $config['upload_path'] = './assets_kasir/'; //buat folder dengan nama assets di root folder
        $config['file_name'] = $fileName;
        $config['allowed_types'] = 'xls|xlsx|csv';
        $config['max_size'] = 10000;

        $this->load->library('upload');
        $this->upload->initialize($config);

        if(! $this->upload->do_upload('file') )
        $this->upload->display_errors();

        $media = $this->upload->data('file');
        $inputFileName = './assets_kasir/'.$config['file_name'];

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
                    "kode_supplier"=> $rowData[0][1],
                    "nama_supplier"=> $rowData[0][2],
                    "alamat_supplier"=> $rowData[0][3],
                    "telpon"=> $rowData[0][4],
                    "email"=> $rowData[0][5],
                    "rekening"=> $rowData[0][6],
                );

                //sesuaikan nama dengan nama tabel
                $insert = $this->db->insert("supplier",$data);
                unlink('assets_kasir/'.$config['file_name'].'');
            }
        redirect('kasir/data_supplier');
    }

    function delete_supplier($id){
        $this->m_data->hapus_data(['kd_supplier' => $id],'supplier');
        $this->session->set_flashdata('alert','<div class="alert alert-success alert-dismissible fade in">
    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
    <strong>Berhasil!</strong> Hapus Data!
  </div>');
        redirect('kasir/data_supplier');
    }

    public function export_supplier(){
        $ambildata = $this->m_data->semua_export('supplier');

        if(count($ambildata)>0){
            $objPHPExcel = new PHPExcel();
            // Set properties
            $objPHPExcel->getProperties()
                  ->setCreator("Gloob Media - GM") //creator
                    ->setTitle("Data Supplier");  //file title

            $objset = $objPHPExcel->setActiveSheetIndex(0); //inisiasi set object
            $objget = $objPHPExcel->getActiveSheet();  //inisiasi get object

            $objget->setTitle('Sheet1'); //sheet title
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

            $val = array('No','Kode Supplier','Nama Supplier','Alamat','Telpon','Email','Rekening');

            for ($a=0;$a<7; $a++)
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

                $style = array(
                    'alignment' => array(
                        'horizontal' => PHPExcel_Style_Alignment::VERTICAL_CENTER,
                    )
                );
                $objPHPExcel->getActiveSheet()->getStyle($cols[$a].'1')->applyFromArray($style);
            }

            $baris  = 2;
            $no=0;
            foreach ($ambildata as $p){
            $no++;

               //pemanggilan sesuaikan dengan nama kolom tabel
                $objset->setCellValue("A".$baris, $no); //membaca data nama
                $objset->setCellValue("B".$baris, $p->kode_supplier); //membaca data alamat
                $objset->setCellValue("C".$baris, $p->nama_supplier); //membaca data alamat
                $objset->setCellValue("D".$baris, $p->alamat_supplier); //membaca data alamat
                $objset->setCellValue("E".$baris, $p->telpon); //membaca data alamat
                $objset->setCellValue("F".$baris, $p->email); //membaca data alamat
                $objset->setCellValue("G".$baris, $p->rekening); //membaca data alamat

                //Set number value
                $objPHPExcel->getActiveSheet()->getStyle('G1:GI'.$baris)->getNumberFormat()->setFormatCode('0');

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

    public function cetak_struk($id){
        $data['user_ion'] = $this->ion_auth->user()->row();
        $data['penjualan'] = $this->m_data->list_data_penjualan2($id)->result();
        $data['penjualan1'] = $this->m_data->list_data_penjualan2($id)->row();
        $this->load->view('cetak_struk',$data);
    }

    public function list_hutang_penjualan(){
         $data['title'] = 'Stikes Mart | Data Hutang Penjualan';
        $data['list_hutang'] = $this->m_data->semua('hutang_penjualan')->result();
        $dataku = array();
        //total rows count

        $totalRec = count($this->m_data->getRows3());

        //pagination configuration
        $config['target']      = '.postList';
        $config['base_url']    = base_url().'p/ajaxPaginationData123';
        $config['total_rows']  = $totalRec;
        $config['per_page']    = $this->perPage;
        $config['link_func']   = 'searchFilter';
        $this->ajax_pagination->initialize($config);

        //get the posts data
        $dataku['posts'] = $this->m_data->getRows3(array('limit'=>$this->perPage));
        $this->load->view('user/header',$data);
        $this->load->view('user/data_hutang_penjualan',$dataku);
        $this->load->view('user/footer');
    }

    public function pembayaran_hutang_penjualan(){
        $data['title'] = 'Stikes Mart | Pembayaran Hutang Penjualan';
        $data['list_hutang'] = $this->m_data->semua('hutang_penjualan')->result();
        $this->load->view('user/header',$data);
        $this->load->view('user/pembayaran_hutang_penjualan');
        $this->load->view('user/footer');
    }

    function list_pembayar_hutang($val){
        $data['cari_nama'] = $this->m_data->cariAtasNama($val)->row();
        if(empty($data['cari_nama'])){
            echo '<script>showSuccessMessage2();</script>';
        }else{
        $data['list_hutang'] = $this->m_data->cariAtasNama($val)->result();
        $this->load->view('user/list_pembayar_hutang',$data);
        }
    }

    function bayar_hutang($idh,$kdj){
        $cari_harga = $this->m_data->where('hutang_penjualan',['id_hutang' => $idh])->row();;
        if($this->input->post('nominal') >= $cari_harga->kekurangan_biaya){
            $this->m_data->update_data(['id_hutang' => $idh],['status_lunas' => 'lunas'],'hutang_penjualan');
            $this->m_data->update_data(['kd_penjualan' => $kdj],['status' => '1'],'penjualan_barang');
            $uangDia = $cari_harga->kekurangan_biaya;
        }else{
            $uangDia = $this->input->post('nominal');
            $kurang = $cari_harga->kekurangan_biaya - $uangDia;
            $this->m_data->update_data(['id_hutang' => $idh],['kekurangan_biaya' => $kurang,'status_lunas' => 'berlanjut'],'hutang_penjualan');
        }
        $dataArr = [
            'id_hutang' => $idh,
            'keterangan' => $this->input->post('keterangan'),
            'bayar' => $uangDia,
            'tanggal_pembayaran' => date('Y-m-d H:i:s')
        ];
        $this->db->insert('join_hutang_penjualan',$dataArr);
        $this->session->set_flashdata('alert','<div class="alert alert-success alert-dismissible">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                <h4><i class="icon fa fa-check"></i> Sukses</h4>
                Berhasil Menyimpan Data
              </div>');
        redirect('kasir/pembayaran_hutang_penjualan');
    }

    function sukses_kasir($kd_jual,$url,$dis){
        $base_64 = $url . str_repeat('=', strlen($url) % 4);
        $total_harga = base64_decode($base_64);
        $data = [
            'sum_diskon' => $dis,
            'bayar' => $this->input->post('total'),
            'total_harga' => $total_harga,
            'status' => '1'
        ];
        $this->m_data->update_data(['kd_penjualan' => $kd_jual],$data,'penjualan_barang');
        $dataArrKas = [
            'debet' => $total_harga,
            'kd_penjualan' => $kd_jual,
            'tanggal_transaksi' => date('Y-m-d H:i:s'),
            'keterangan' => 'Penjualan'
        ];
        $this->db->insert('kas',$dataArrKas);
				$dataArrUmum = [
						'kd_penjualan' => $kd_jual,
						'created' => date('Y-m-d H:i:s'),
						'status_uang' => '1'
				];
				$this->db->insert('buku_umum2',$dataArrUmum);
        $this->session->set_flashdata('alert','<div class="alert alert-success alert-dismissible">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                <h4><i class="icon fa fa-check"></i> Sukses</h4>
                Berhasil Menyimpan Data
              </div>');
        redirect('kasir/cetak_struk/'.$kd_jual.'/'.$this->input->post('total').'');
    }

    function hutang_penjualan($kdj,$url,$dis){
        $base_64 = $url . str_repeat('=', strlen($url) % 4);
        $total_harga = base64_decode($base_64);
        if(empty($this->input->post('pembayaran_awal'))){
            $status = 'belum bayar';
        }else{
            $status = 'berlanjut';
        }
        $uangDia = $this->input->post('pembayaran_awal');
        $kekurangan = $total_harga - $this->input->post('pembayaran_awal');
        $dataArr = [
            'kd_penjualan' => $kdj,
            'tanggal_jatuh_tempo' => $this->input->post('tgl_tempo'),
            'atas_nama' => $this->input->post('atas_nama'),
            'kekurangan_biaya' => $kekurangan,
            'status_lunas' => $status,
            'created' => date('Y-m-d H:i:s')
        ];
        $this->db->insert('hutang_penjualan',$dataArr);
        if($status == 'berlanjut'){
            $cek_akhir = $this->m_data->cek_akhir('id_hutang','DESC','hutang_penjualan')->row();
            $datayArr = [
                'id_hutang' => $cek_akhir->id_hutang,
                'keterangan' => 'Pembayaran Pertama',
                'bayar' => $this->input->post('pembayaran_awal'),
                'tanggal_pembayaran' => date('Y-m-d H:i:s'),
            ];
            $this->db->insert('join_hutang_penjualan',$datayArr);
        }
        $dataArrJ = [
            'bayar' => $this->input->post('pembayaran_awal'),
            'sum_diskon' => $dis,
            'total_harga' => $total_harga,
            'status' => '2',
            'tgl_tempo_kredit' => $this->input->post('tgl_tempo'),
        ];
        $this->m_data->update_data(['kd_penjualan' => $kdj],$dataArrJ,'penjualan_barang');
        $dataArrKas = [
            'debet' => $total_harga,
            'kd_penjualan' => $kdj,
            'tanggal_transaksi' => date('Y-m-d H:i:s'),
            'keterangan' => 'Penjualan'
        ];
        $this->db->insert('kas',$dataArrKas);
				$dataArrUmum = [
						'kd_penjualan' => $kdj,
						'created' => date('Y-m-d H:i:s'),
						'status_uang' => '2'
				];
				$this->db->insert('buku_umum2',$dataArrUmum);
        $this->session->set_flashdata('alert','<div class="callout callout-success">Berhasil Menyimpan Data !</div>');
        // redirect('kasir/kasir2');
        redirect('kasir/cetak_struk/'.$kdj.'/'.$uangDia.'');
    }

    function insert_data_kasir($satuan,$pembeli,$kd_barang,$kdj,$tgl,$harga_pokok){
        ($kdj==0) ? $kd_jual='' : $kd_jual=$kdj;
				// (is_null($pembeli)) ? $pembeli = '' : $pembeli=$pembeli;
				// if(empty($pembeli)){}else{
            $pembeli = $this->m_data->sortPembeli($pembeli)->row();
				// }
            $kd_nota_now = "PJL".date("Ymd")."-".$this->code_number().date('i');
            $cari_nota = $this->m_data->where('penjualan_sementara',['kd_nota' => $kd_nota_now])->row();
            // $res = str_replace('_','-',$tgl);
            $base_64 = $tgl . str_repeat('=', strlen($tgl) % 4);
$dataxz = base64_decode($base_64);
            $tgl_jual_now = $dataxz;
            $user_login = $this->ion_auth->user()->row();
            $cek_persedianBrg = $this->m_data->cari_barangKar($kd_barang)->row();
            $stock = $cek_persedianBrg->stock - $satuan;
            $this->m_data->update_data(['id_barang' => $cek_persedianBrg->id_barang],['stock' => $stock],'barang');
        if(empty($kd_jual)){
            $notaArr = [
                'kd_nota' => $kd_nota_now,
                'kode_barang' => $kd_barang,
                'satuan' =>$satuan,
								'harga' => $harga_pokok,
								'harga_hasil' => $harga_pokok*$satuan,
            ];
            $this->db->insert('penjualan_sementara',$notaArr);
            $jualArr = [
                'kd_nota' => $kd_nota_now,
                'nama_pembeli' => $pembeli->kd_pelanggan,
                'tanggal_penjualan' => $tgl_jual_now,
                'status' => '0',
                'bulan_beli' => date('m'),
                'tahun_n' => date('Y'),
                'nama_kasir' => $user_login->username
            ];
            $this->db->insert('penjualan_barang',$jualArr);
            $cek_akhir = $this->m_data->cek_akhir('kd_penjualan','DESC','penjualan_barang')->row();
            $kd_jual = $cek_akhir->kd_penjualan;
            $kd_nota = $cek_akhir->kd_nota;
        }else{
            $cariPenjualan = $this->m_data->where('penjualan_barang',['kd_penjualan' => $kd_jual])->row();
            $kd_nota = $cariPenjualan->kd_nota;
            $notaArr = [
                'kd_nota' => $kd_nota,
                'kode_barang' => $kd_barang,
                'satuan' =>$satuan,
								'harga' => $harga_pokok,
								'harga_hasil' => $harga_pokok*$satuan,
            ];
            $this->db->insert('penjualan_sementara',$notaArr);
            $kd_jual=$kdj;
            $kd_nota=$kd_nota;
        }
        $base_64xz = base64_encode($dataxz);
$url_param = rtrim($base_64xz, '=');
        redirect('kasir/load_pancing/'.$kd_jual.'/'.$kd_nota.'/'.$pembeli->kd_pembeli.'/'.$url_param);
    }

    function load_pancing($kd_jual,$kd_nota,$pembeli,$tgl){
        $data['kd_jual'] = $kd_jual;
        $data['kd_nota'] = $kd_nota;
        $data['pembeli'] = $pembeli;
        $data['tgl'] = $tgl;
        $this->load->view('load_pancing',$data);
    }

    function load_pancing2(){

    }

    function load_barang_baru($kd_jual,$kd_nota,$pembeli,$tgl){
        $data['kd_jual'] = $kd_jual;
        $data['kd_nota'] = $kd_nota;
        $data['pembeli'] = $pembeli;
        $data['tgl'] = $tgl;
        $this->load->view('load_data_barang_baru',$data);
    }

     function load_barang_baru1($pembeli){
        $data['pembeli'] = $pembeli;
        $this->load->view('load_data_barang_baru1',$data);
    }


    function load_list_data($kdj){
        $data['kd_jual'] = $kdj;
        $this->load->view('list_data_checkout',$data);
    }

    function delete_checkout(){
        $id_cek = $_GET['id_cek'];
        $cari_barang = $this->m_data->where('penjualan_sementara',['id_cek' => $id_cek])->row();
        $cari_barang1 = $this->m_data->where('barang',['kode_barang' => $cari_barang->kode_barang])->row();
        $stock = $cari_barang1->stock + $cari_barang->satuan;
        $this->m_data->update_data(['kode_barang' => $cari_barang->kode_barang],['stock' => $stock],'barang');
        $this->m_data->hapus_data(['id_cek' => $id_cek],'penjualan_sementara');
    }

    function cek_satuan_kasir($satuan,$pembeli,$kd_barang,$kdj,$tgl,$harga_pokok){
        // $cari_barang = $this->m_data->cari_barangKar($kd_barang)->row();
        // $hasilKurang = $cari_barang->stock - $satuan;
        // if($hasilKurang <= 0){
        //     echo '<script>showSuccessMessage5();</script>';
        //     $data['satuan'] = $satuan;
        //     $data['pembeli'] = $pembeli;
        //     $data['kd_barang'] = $kd_barang;
        //     $data['kd_jual'] = $kdj;
        //     $data['tgl'] = $tgl;
        //     $data['cari_barang'] = $this->m_data->cari_barangKar($kd_barang)->row();
        //     $this->load->view('load_pancing2',$data);
        // }else{
        //     $datay['satuan'] = $satuan;
        //     $datay['pembeli'] = $pembeli;
        //     $datay['kd_barang'] = $kd_barang;
        //     $datay['kd_jual'] = $kdj;
        // $datay['tgl'] = $tgl;
        //     $this->load->view('load_pancing3',$datay);
        // }
				$datay['satuan'] = $satuan;
				$datay['pembeli'] = $pembeli;
				$datay['kd_barang'] = $kd_barang;
				$datay['kd_jual'] = $kdj;
				$datay['tgl'] = $tgl;
				$datay['harga_pokok'] = $harga_pokok;
				$this->load->view('load_pancing3',$datay);
    }

    function load_data($val,$pem,$kdj,$tgl){
        // $pembeliku = $this->m_data->sortPembeli($pem)->row();
        $data['pembeli']= $pem;
        $data['cari_barang'] = $this->m_data->cari_barangKar($val)->row();
        $data['kd_barang'] = $val;
        $data['kd_jual1']=$kdj;
        $data['tgl']=$tgl;
        if(empty($data['cari_barang'])){
            $data['kd_jual']=$kdj;
            echo '<script>showSuccessMessage2();</script>';
        $this->load->view('load_data_barang_baru1',$data);
        // }elseif(date('Y-m-d') >= $data['cari_barang']->tanggal_expired){
        //     if($data['cari_barang']->kd_jenis_barang == 2 || $data['cari_barang']->kd_jenis_barang == 3){
        //         $data['kd_jual']=$kdj;
        //         echo '<script>showSuccessMessage3();</script>';
        //         $this->load->view('load_data_barang_baru1',$data);
        //     }else{
        //         $this->load->view('load_data_barang',$data);
        //     }
        // }elseif($data['cari_barang']->stock == 0){
        //     $data['kd_jual']=$kdj;
        //     echo '<script>showSuccessMessage4();</script>';
        //     $this->load->view('load_data_barang_baru1',$data);
        // }else{
        // $this->load->view('load_data_barang',$data);
        // }
			}else{
			$this->load->view('load_data_barang',$data);
			}
    }

    public function data_penjualan(){
        $data['title'] = 'Data Penjualan';
        $data['user_ion'] = $this->ion_auth->user()->row();
        if($this->uri->segment(3) == 'ac'){
        $cari_user = $this->m_data->where('users',['id' => $this->input->post('operator')])->row();
        $data['penjualan'] = $this->m_data->list_data_penjualan1($this->input->post('start_tgl'),$this->input->post('end_tgl'))->result();
        }elseif($this->uri->segment(3) == 'tahun'){
            $data['penjualan'] = $this->m_data->list_data_penjualan($this->input->post('bulan'),$this->input->post('tahun'))->result();
        }else{
            $data['penjualan'] = $this->m_data->list_data_penjualan(date('m'),date('Y'))->result();
        }
        $data['operator'] = $this->m_data->where('users',['id !=','1'])->result();
        $data['pembeli'] = $this->m_data->pembeli()->result_array();

		$this->load->view('user/header',$data);
		$this->load->view('data_penjualan');
		$this->load->view('user/footer');
    }

    function export_penjualan1($tgl_awal=null,$tgl_end=null,$user=null){
        (is_null($tgl_awal)) ? $start = '' : $start = $tgl_awal;
        (is_null($tgl_end)) ? $end = '' : $end = $tgl_end;
        (is_null($user)) ? $id_user = '' : $id_user = $user;
        if(empty($id_user)){
        $data['penjualan'] = $this->m_data->list_data_penjualan()->result();
        }else{
        $cari_user = $this->m_data->where('users',['id' => $id_user])->row();
        $data['penjualan'] = $this->m_data->list_data_penjualan1($start,$end,$cari_user->first_name)->result();
        }
        $data['title'] = 'Data Penjualan';
        $this->load->view('export_data_penjualan',$data);
    }

    function print_penjualan($tgl_awal=null,$tgl_end=null,$user=null){
        (is_null($tgl_awal)) ? $start = '' : $start = $tgl_awal;
        (is_null($tgl_end)) ? $end = '' : $end = $tgl_end;
        (is_null($user)) ? $id_user = '' : $id_user = $user;
        if(empty($id_user)){
        $data['penjualan'] = $this->m_data->list_data_penjualan()->result();
        }else{
        $cari_user = $this->m_data->where('users',['id' => $id_user])->row();
        $data['penjualan'] = $this->m_data->list_data_penjualan1($start,$end,$cari_user->first_name)->result();
        }
        $data['title'] = 'Data Penjualan';
        $this->load->view('user/print_data_penjualan',$data);
    }

    public function export_penjualan(){
        $ambildata = $this->m_data->list_data_penjualan2();

        if(count($ambildata)>0){
            $objPHPExcel = new PHPExcel();
            // Set properties
            $objPHPExcel->getProperties()
                  ->setCreator("Gloob Media - GM") //creator
                    ->setTitle("Data Penjualan");  //file title

            $objset = $objPHPExcel->setActiveSheetIndex(0); //inisiasi set object
            $objget = $objPHPExcel->getActiveSheet();  //inisiasi get object

            $objget->setTitle('Sheet1'); //sheet title
            //Warna header tabel
            $objget->getStyle("A1:U1")->applyFromArray(
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
            $cols = array("A","B","C","D","E","F","G","H","I","J","K","L","M","N","O","P","Q","R","S","T","U");

            $val = array('No','Tanggal Penjualan','Nomor Nota','Kode Pelanggan','Nama Pelanggan','Kategori Barang','Jenis Barang','Nama Barang','Tanggal Expired','Satuan Barang','Harga Jual Satuan','Diskon Jual Satuan','Harga Netto Jual Satuan','Status Jual','Jatuh Tempo Kredit','Harga Netto Beli Satuan','Total Laba','Operator');

            for ($a=0;$a<=15; $a++)
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
                $objPHPExcel->getActiveSheet()->getColumnDimension('L')->setWidth(25); // Kontak
                $objPHPExcel->getActiveSheet()->getColumnDimension('M')->setWidth(25); // Kontak
                $objPHPExcel->getActiveSheet()->getColumnDimension('N')->setWidth(25); // Kontak
                $objPHPExcel->getActiveSheet()->getColumnDimension('O')->setWidth(25); // Kontak
                $objPHPExcel->getActiveSheet()->getColumnDimension('P')->setWidth(25); // Kontak
                $objPHPExcel->getActiveSheet()->getColumnDimension('Q')->setWidth(25); // Kontak
                $objPHPExcel->getActiveSheet()->getColumnDimension('R')->setWidth(25); // Kontak
                $objPHPExcel->getActiveSheet()->getColumnDimension('S')->setWidth(25); // Kontak
                $objPHPExcel->getActiveSheet()->getColumnDimension('T')->setWidth(25); // Kontak
                $objPHPExcel->getActiveSheet()->getColumnDimension('U')->setWidth(25); // Kontak

                $style = array(
                    'alignment' => array(
                        'horizontal' => PHPExcel_Style_Alignment::VERTICAL_CENTER,
                    )
                );
                $objPHPExcel->getActiveSheet()->getStyle($cols[$a].'1')->applyFromArray($style);
            }

            $baris  = 2;
            $no=0;
            foreach ($ambildata as $p){
            $no++;

               //pemanggilan sesuaikan dengan nama kolom tabel
                $objset->setCellValue("A".$baris, $no); //membaca data nama
                $objset->setCellValue("B".$baris, date('d/m/Y',strtotime($p->tanggal_penjualan))); //membaca data alamat
                $objset->setCellValue("C".$baris, $p->kd_nota); //membaca data alamat
                $objset->setCellValue("D".$baris, $p->nama_pembeli); //membaca data alamat
                $cari_pembeli = $this->m_data->where('pembeli',['kd_pelanggan' => $p->nama_pembeli])->row();
                $objset->setCellValue("E".$baris, $cari_pembeli->nama_pembeli); //membaca data alamat
                $objset->setCellValue("F".$baris, $p->kategori_barang); //membaca data alamat
                $objset->setCellValue("G".$baris, $p->jenis_barang); //membaca data alamat
                $objset->setCellValue("H".$baris, $p->kode_barang); //membaca data alamat
                $objset->setCellValue("I".$baris, $p->nama_barang); //membaca data alamat
                $objset->setCellValue("J".$baris, $p->tanggal_expired); //membaca data alamat
                $objset->setCellValue("K".$baris, $p->nama_satuan); //membaca data alamat
                $objset->setCellValue("L".$baris, number_format($p->harga_pokok)); //membaca data alamat
                $objset->setCellValue("M".$baris, $p->diskon); //membaca data alamat
                $objset->setCellValue("N".$baris, number_format($p->harga_netto_jual_satuan)); //membaca data alamat
                $objset->setCellValue("O".$baris, number_format($p->satuan  * $p->harga_netto_jual_satuan)); //membaca data alamat
                $objset->setCellValue("P".$baris, ($p->status == '1') ? 'Tunai' : 'Kredit'); //membaca data alamat
                $objset->setCellValue("Q".$baris, ($p->status == '1') ? '' : date('d/m/Y',strtotime($p->tgl_tempo_kredit))); //membaca data alamat
                    $cek_akhir_pem = $this->m_data->cek_akhir2('kd_pembelian','DESC','pembelian_barang',['kode_barang' => $p->kode_barang])->row();
                $objset->setCellValue("R".$baris, number_format($cek_akhir_pem->harga_beli_satuan)); //membaca data alamat
                $objset->setCellValue("S".$baris, number_format($p->satuan * $cek_akhir_pem->harga_beli_satuan)); //membaca data alamat
                $objset->setCellValue("T".$baris, number_format($p->satuan  * $p->harga_netto_jual_satuan - ($p->satuan * $cek_akhir_pem->harga_beli_satuan))); //membaca data alamat
                $objset->setCellValue("U".$baris, $p->nama_kasir); //membaca data alamat

                //Set number value
                $objPHPExcel->getActiveSheet()->getStyle('U1:UI'.$baris)->getNumberFormat()->setFormatCode('0');

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

	public function persediaan_barang(){
		$data['user_ion'] = $this->ion_auth->user()->row();
        $data['rec'] = $this->m_data->daf_persediaan()->result_array();
        $data['supplier'] = $this->m_data->supplier()->result_array();
		$this->load->view('header',$data);
		$this->load->view('persediaan',$data);
		$this->load->view('footer');
	}
    public function tambah_stock(){
        $data['per2'] = $this->m_data->cek_stocknya($this->input->post('kd_nota'))->row();
        if($data['per2']->stock<=0){
        $ttx = $this->input->post('stock');
        }else{
        $ttx = $this->input->post('stock2') + $this->input->post('stock');
        }
        $datax = array(
            'stock' => $ttx,
        );
        $where = array(
            'kd_nota' => $this->input->post('kd_nota'),
        );
        $total = $this->input->post('hrg_bel1') * $this->input->post('stock');
//        echo $total;
//        exit;
        $date = date("Y-m-d");
        $datay = array(
            'kredit' => $total,
            'tanggal_transaksi' => $date,
            'keterangan' => 'Pembelian Stock Barang '.$this->input->post('nm_barang').' dengan kode barang : '.$this->input->post('kd_barang').''
        );
        $modal = $this->input->post('modal') - $total;
        $datam = array(
            'modal_stikes' => $modal,
            'tgl_update' => $date,
        );
        $wherey = array(
            'id_modal' => '1',
        );
        $this->m_data->update_data($wherey,$datam,'modal');
        $this->m_data->update_data($where,$datax,'persediaan_barang');
        $this->m_data->input_data($datay,'kas');
        redirect("kasir/persediaan_barang");
    }
    public function rekap_laba_perbulan(){
        $data['user_ion'] = $this->ion_auth->user()->row();
        $data['rec'] = $this->m_data->daf_persediaan()->result_array();
        $data['supplier'] = $this->m_data->supplier()->result_array();
        $this->load->view('header',$data);
        $this->load->view('rekap_laba',$data);
        $this->load->view('footer');
    }

    public function insert_record(){
        $data['user_ion'] = $this->ion_auth->user()->row();
        $data['maxid'] = $this->m_data->maxid()->row();

        if(empty( $data['maxid']->kd_nota)){ $last = 0; }else{

            $last = $data['maxid']->kd_nota;
        }

        $nota = $last + 1;
        $data['cek_nota'] = $this->m_data->cek_nota($nota)->row();
        $kd_barang = $this->input->post('kode');
        $data['persediaan'] = $this->m_data->cek_barang($kd_barang)->row();
        if($data['persediaan']->stock<=0){
            echo "<script>
alert('Barang Sudah Habis !');
window.location.href='".base_url()."';
</script>";
        }else{
             $stock = $data['persediaan']->stock - $this->input->post('satuan_beli');
        $rate = $data['persediaan']->total_dibeli + $this->input->post('satuan_beli');
        if($data['cek_nota']->cek==1){
            $data = array(
            'kd_nota' => $nota,
            'satuan' => $this->input->post('satuan_beli'),
            'kode_barang' => $this->input->post('kode'),
            );
            $where = array(
            'kode_barang' => $kd_barang
            );
            $data_s = array(
            'stock' => $stock,
            'total_dibeli' => $rate,
            );
            $this->m_data->input_data($data, 'penjualan_sementara' );
            $this->m_data->update_data($where,$data_s, 'persediaan_barang' );
            $data['cek_stok'] =  $this->m_data->cek_stock($this->input->post('kode'))->row();
            if($data['cek_stok']->stock <=2 ){
                $data_waw = array(
                    'status_s' => '1',
                );
                $where_waw = array(
                    'kode_barang' => $this->input->post('kode'),
                );
                $this->m_data->update_data($where_waw,$data_waw,'persediaan_barang');

            }else{
                $data_waw = array(
                    'status_s' => '0',
                );
                $where_waw = array(
                    'kode_barang' => $this->input->post('kode'),
                );
                $this->m_data->update_data($where_waw,$data_waw,'persediaan_barang');

            }
            redirect('/');
        }else{
            $data = array(
            'kd_nota' => $nota,
            'satuan' => $this->input->post('satuan_beli'),
            'kode_barang' => $this->input->post('kode'),
            );
            $data_b = array(
            'kd_nota' => $nota,
            'tanggal_penjualan' => date("Y-m_d"),
            'nama_pembeli' => $this->input->post('nama_pem'),
            );
            $where = array(
            'kode_barang' => $kd_barang
            );
            $data_s = array(
            'stock' => $stock,
            'total_dibeli' => $rate,
            );
            $this->m_data->update_data($where,$data_s, 'persediaan_barang' );
            $this->m_data->input_data($data, 'penjualan_sementara' );
            $this->m_data->input_data($data_b, 'penjualan_barang' );
            $data['cek_stok'] =  $this->m_data->cek_stock($this->input->post('kode'))->row();
            if($data['cek_stok']->stock <=2 ){
                $data_waw = array(
                    'status_s' => '1',
                );
                $where_waw = array(
                    'kode_barang' => $this->input->post('kode'),
                );
                $this->m_data->update_data($where_waw,$data_waw,'persediaan_barang');
            }else{
                $data_waw = array(
                    'status_s' => '0',
                );
                $where_waw = array(
                    'kode_barang' => $this->input->post('kode'),
                );
                $this->m_data->update_data($where_waw,$data_waw,'persediaan_barang');

            }
            redirect('/');
        }
        }
/////// <><><><><><<><> //////////
/////// <><><><><><<><> //////////
/////// <><><><><><<><> //////////
    }

    public function update_status32(){
		            $data['user_ion'] = $this->ion_auth->user()->row();

        $data = array(
            'status_s' => '0',
        );
        $where = array(
            'kd_nota' => $this->input->post('kd_nota'),
        );
        $this->m_data->update_data($where,$data,'persediaan_barang');
        redirect('kasir/persediaan_barang');
    }

    public function simpan_penjualan(){
        $data['user_ion'] = $this->ion_auth->user()->row();
        $bln = date("m");
        $thn = date("Y");
        if($this->input->post('tidakbayar')=='iya'){
         if(empty($this->input->post('diskon'))){
        $where = array(
        'kd_nota' => $this->input->post('kode')
        );
        $data = array(
        'status' => 1,
        'total_harga' => $this->input->post('total_harga'),
        'bulan_beli' => $bln,
        'tahun_n' => $thn,
        'nama_kasir' => $this->input->post('nama_kasir'),


        );
        }else{
           $where = array(
        'kd_nota' => $this->input->post('kode')
        );
        $data = array(
        'bulan_beli' => $bln,
        'tahun_n' => $thn,
        'diskon' => $this->input->post('diskon'),
        'nama_kasir' => $this->input->post('nama_kasir'),
        );
        }
           $date = date("Y-m-d");
        $dataya = array(
            'debet' => $this->input->post('total_harga'),
            'kd_penjualan' => $this->input->post('kd_penjualan'),
            'tanggal_transaksi' => $date,
            'keterangan' => 'Penjualan'
        );

         $this->m_data->update_data($where,$data, 'penjualan_barang' );
        $this->m_data->input_data($dataya,'kas');
           redirect('/');
        }else{
             echo "<script>
alert('Anda Belum Melakukan Pembayaran!');
window.location.href='".base_url()."';
</script>";
        }

    }
    public function hapus_pembelian(){
                $data['user_ion'] = $this->ion_auth->user()->row();

         $kd_barang = $this->input->post('kode');
        $data['persediaan'] = $this->m_data->cek_barang($kd_barang)->row();
        $stock = $data['persediaan']->stock + $this->input->post('satuan');

         $where = array(
            'kode_barang' => $kd_barang
            );

            $data_s = array(
            'stock' => $stock
            );

        $where_del = array(
        'kd_nota' => $this->input->post('nota'),
        'kode_barang' => $this->input->post('kode'),
        );


        $this->m_data->hapus_data($where_del, 'penjualan_sementara' );
        $this->m_data->update_data($where,$data_s, 'persediaan_barang' );
        redirect('/');

    }
		function tes_jumlah(){
			$data['title'] = 'Data Penjualan';
			$data['user_ion'] = $this->ion_auth->user()->row();
			if($this->uri->segment(3) == 'ac'){
			$cari_user = $this->m_data->where('users',['id' => $this->input->post('operator')])->row();
			$data['penjualan'] = $this->m_data->list_data_penjualan_test($this->input->post('start_tgl'),$this->input->post('end_tgl'))->result();
			}else{
			$data['penjualan'] = $this->m_data->list_data_penjualan_test()->result();
			}
			$data['operator'] = $this->m_data->where('users',['id !=','1'])->result();
			$data['pembeli'] = $this->m_data->pembeli()->result_array();
			$this->load->view('test/tes',$data);
		}
}
