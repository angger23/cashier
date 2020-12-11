<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Buku_anggota extends CI_Controller {
function __construct(){
		parent::__construct();
		$this->load->model('m_data');
        $this->load->helper('url');
        $this->load->model('ion_auth_model');
    if(!$this->ion_auth->logged_in()){
			redirect("auth/login");
		}
	}

	public function view(){
		$data['title'] = 'Buku Bank Anggota | Stikes Mart';
		$data['operator'] = $this->m_data->where('users',['id !=','1'])->result();
		$data['kode_transaksi'] = $this->m_data->where('kode_transaksi',array('status' => 'Kas Anggota'))->result();
		if($this->uri->segment(3) == 'ac'){
			$data['list_bank_toko'] = $this->m_other->cari_list_bank_toko_anggota($this->input->post('start_tgl'),$this->input->post('end_tgl'),$this->input->post('operator'),'Kas Anggota')->result();
		}else{
			$data['list_bank_toko'] = $this->m_other->list_bank_toko_anggota('Kas Anggota')->result();
			$data['debetq'] = $this->m_other->cari_list_bank_toko_anggota_count('','','','Kas Anggota','debit')->row();
		$data['kreditq'] = $this->m_other->cari_list_bank_toko_anggota_count('','','','Kas Anggota','kredit')->row();
		}
		$this->load->view('user/header',$data);
		$this->load->view('user/buku_anggota');
		$this->load->view('user/footer');
	}

	function tambah_data_buku_anggota(){
		$user_ion = $this->ion_auth->user()->row();
		$dataArr = [
			'nama_bank' => $this->input->post('nm_bank'),
			'kode_transaksi' => $this->input->post('kd_transaksi'),
			'tanggal' => $this->input->post('tanggal'),
			'uraian' => $this->input->post('uraian'),
			'debit' => (empty($this->input->post('debet'))) ? '0' : str_replace(' ','',$this->input->post('debet')),
			'kredit' => (empty($this->input->post('kredit'))) ? '0' : str_replace(' ','',$this->input->post('debet')),
			'created' => date('Y-m-d H:i:s'),
			'status' => 'Kas Anggota',
			'id_user' => $user_ion->id
		];
		$this->db->insert('buku_bank',$dataArr);
		$dataAyy = array(
			'kode_transaksi' => $this->input->post('kd_transaksi'),
			'tanggal' => $this->input->post('tanggal'),
			'keterangan' => $this->input->post('uraian'),
			'debit' => (empty($this->input->post('debet'))) ? '0' : $this->input->post('debet'),
			'kredit' => (empty($this->input->post('kredit'))) ? '0' : $this->input->post('kredit'),
			'created' => date('Y-m-d H:i:s'),
			'id_user' => $user_ion->id,
			'sumber_dana' => 'Kas Anggota',
			'alat_bayar' => 'Kas Di Bank Anggota'
		);
		$this->db->insert('buku_umum',$dataAyy);
		$this->session->set_flashdata('alert','<div class="alert alert-success alert-dismissible">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                <h4><i class="icon fa fa-check"></i> Berhasil Input Buku Bank Kas Toko</h4>
              </div>');
		redirect('buku_anggota/view');
	}

	function data_lawas(){
		$get_all = $this->m_data->where('buku_bank',array('status' => 'Kas Anggota'))->result();
		foreach($get_all as $g){
			$dataAyy = array(
				'kode_transaksi' => $g->kode_transaksi,
				'tanggal' => $g->tanggal,
				'keterangan' => $g->uraian,
				'debit' => ($g->debit == '0') ? '0' : $g->debit,
				'kredit' => ($g->kredit == '0') ? '0' : $g->kredit,
				'created' => $g->created,
				'id_user' => $g->id_user,
				'sumber_dana' => 'Kas Anggota',
				'alat_bayar' => 'Kas Di Bank'
			);
			$this->db->insert('buku_umum',$dataAyy);
		}
	}

	function update_data_buku_anggota($id){
		$dataArr = [
			'nama_bank' => $this->input->post('nm_bank'),
			'kode_transaksi' => $this->input->post('kd_transaksi'),
			'tanggal' => $this->input->post('tanggal'),
			'uraian' => $this->input->post('uraian'),
			'debit' => (empty($this->input->post('debet'))) ? '0' : $this->input->post('debet'),
			'kredit' => (empty($this->input->post('kredit'))) ? '0' : $this->input->post('kredit'),
		];
		$this->m_data->update_data(array('id_buku' => $id),$dataArr,'buku_bank');
		$this->session->set_flashdata('alert','<div class="alert alert-success alert-dismissible">
								<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
								<h4><i class="icon fa fa-check"></i> Berhasil update buku bank kas anggota</h4>

							</div>');
		redirect('buku_anggota/view');
	}

	function update_ajax_buku_anggota($nama_bank,$kode_transaksi,$tanggal,$uraian,$debet,$kredit,$id){
		$dataArr = [
			'nama_bank' => $nama_bank,
			'kode_transaksi' => $kode_transaksi,
			'tanggal' => $tanggal,
			'uraian' => $uraian,
			'debit' => (empty($debet)) ? '0' : $debet,
			'kredit' => (empty($kredit)) ? '0' : $kredit,
		];
		$this->m_data->update_data(array('id_buku' => $id),$dataArr,'buku_bank');
		$this->session->set_flashdata('alert','<div class="alert alert-success alert-dismissible">
								<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
								<h4><i class="icon fa fa-check"></i> Berhasil update buku bank kas anggota</h4>

							</div>');
		redirect('buku_anggota/view');
	}

	function delete_buku_anggota($id){
		$this->m_data->hapus_data(array('id_buku' => $id),'buku_bank');
		$this->session->set_flashdata('alert','<div class="alert alert-success alert-dismissible">
								<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
								<h4><i class="icon fa fa-check"></i> Berhasil!</h4>
								Hapus Buku Bank Kas Toko
							</div>');
		redirect('buku_anggota/view');
	}

	function export_buku_anggota($stat = null,$stat1 = null,$idne = null){
		(is_null($stat)) ? $tgl='' : $tgl = $stat;
		(is_null($stat1)) ? $tg1l='' : $tgl1 = $stat1;
		(is_null($idne)) ? $id='' : $id = $idne;
		header("Content-type: application/vnd-ms-excel");
		header("Content-Disposition: attachment; filename=Buku_Bank_kas_anggota_All.xls");
		// header("Pragma: no-cache");
		header("Expires: 0");
		header("Pragma: ");
		header("Cache-Control: ");
		$list_bank_toko = $this->m_data->list_bank_toko($tgl,$tgl1,$id,'','Kas Anggota')->result();
		echo '
		<html>
		<head>
			<title></title>
		</head>
		<body style="border-collapse: collapse;">
		<table class="table table-bordered" border="1" width="100%">
			<thead>
				<tr>
					<th>No</th>
					<th>Nama Bank</th>
					<th>Tanggal</th>
					<th>Kode</th>
					<th>Uraian Kode</th>
					<th>Keterangan</th>
					<th>Pengeluaran</th>
					<th>Pemasukan</th>
					<th>Hasil</th>
					<th>Saldo</th>
				</tr>
			</thead>
			<tbody>
		';
		$no=0;
		$sal=0;
		$kredit=0;
		$debit=0;
		foreach($list_bank_toko as $l):
		$no++;
		echo '
		<tr>
			<td>'.$no.'</td>
			<td>'.$l->nama_bank.'</td>
			<td>'.date('d-m-Y',strtotime($l->tanggal)).'</td>
			<td>'.$l->kode.'</td>
			<td>'.$l->uraian_kode.'</td>
			<td>'.$l->uraian.'</td>
			<td>Rp '.number_format($l->kredit).'</td>
			<td>Rp '.number_format($l->debit).'</td> ';
			$salq =  $l->kredit - $l->debit;
			echo '
			<td>Rp '.number_format($salq).'</td>
			<td>Rp ';
			if($no==1){
				 $sal=$salq;
			}else{
		$sal = $salq - $sal ;
			}
			echo number_format($sal);

			 echo '
			 </td>
			</tr>
			 ';
			 $kre[$no] = $l->kredit;
			 $de[$no] = $l->debit;
			 $debit += $de[$no];
			 $kredit += $kre[$no];
		endforeach;
		echo '
		<tr>
			<td colspan="6"><b>Total</b></td>
			<td>Rp '.number_format($kredit).'</td>
			<td>Rp  '.number_format($debit).'</td>
			<td colspan="2">Rp '.number_format($sal).' </td>
		</tr>
		</tbody>
	</table>
	</body>
	</html>
		';
	}

	function export_buku_anggota1($stat,$stat1,$idne,$kode,$aturan){
		($stat == 0) ? $tgl='' : $tgl = $stat;
		($stat1 == 0) ? $tg1l='' : $tgl1 = $stat1;
		($idne == 0) ? $id='' : $id = $idne;
		$cari_kode = $this->m_data->where('kode_transaksi',array('kode' => $kode,'status' => 'Kas Toko'))->row();
		header("Content-type: application/vnd-ms-excel");
		header("Content-Disposition: attachment; filename=".$cari_kode->uraian_kode.".xls");
		header("Pragma: no-cache");
		header("Expires: 0");
		$list_bank_toko = $this->m_data->list_bank_toko($tgl,$tgl1,$id,$kode,'Kas Anggota')->result();
		echo '
		<html>
		<head>
			<title></title>
		</head>
		<body style="border:1px solid #ccc;border-collapse: collapse;">
		<table class="table table-bordered" border="1" width="100%">
			<thead>
				<tr>
					<th>No</th>
					<th>Nama Bank</th>
					<th>Tanggal</th>
					<th>Kode</th>
					<th>Uraian Kode</th>
					<th>Keterangan</th>
					<th>Pengeluaran</th>
					<th>Pemasukan</th>
					<th>Hasil</th>
					<th>Saldo</th>
				</tr>
			</thead>
			<tbody>
		';
		$no=0;
		$sal=0;
		$kredit=0;
		$debit=0;
		foreach($list_bank_toko as $l):
		$no++;
		echo '
		<tr>
			<td>'.$no.'</td>
			<td>'.$l->nama_bank.'</td>
			<td>'.date('d-m-Y',strtotime($l->tanggal)).'</td>
			<td>'.$l->kode.'</td>
			<td>'.$l->uraian_kode.'</td>
			<td>'.$l->uraian.'</td>
			<td>Rp '.number_format($l->kredit).'</td>
			<td>Rp '.number_format($l->debit).'</td> ';
			if($aturan == 'tambah'){
				$salq =  $l->debit - $l->kredit;
			}else{
				$salq =  $l->kredit - $l->debit;
			}
			echo '
			<td>Rp '.number_format($salq).'</td>
			<td>Rp ';
			if($no==1){
				 $sal=$salq;
			}else{
				if($aturan == 'tambah'){

		$sal = $salq + $sal ;
	}else{
		$sal = $salq - $sal ;

	}
			}
			echo number_format($sal);

			 echo '
			 </td>
			</tr>
			 ';
			 $kre[$no] = $l->kredit;
			 $de[$no] = $l->debit;
			 $debit += $de[$no];
			 $kredit += $kre[$no];
		endforeach;
		echo '
		<tr>
			<td colspan="6"><b>Total</b></td>
			<td>Rp '.number_format($kredit).'</td>
			<td>Rp  '.number_format($debit).'</td>
			<td colspan="2">Rp '.number_format($sal).' </td>
		</tr>
		</tbody>
	</table>
	</body>
	</html>
		';
	}

	function cetak_buku_anggota($stat = null,$stat1 = null,$idne = null){
		(is_null($stat)) ? $tgl='' : $tgl = $stat;
		(is_null($stat1)) ? $tgl1='' : $tgl1 = $stat1;
		(is_null($idne)) ? $id='' : $id = $idne;
		$list_bank_toko = $this->m_data->list_bank_toko($tgl,$tgl1,$id,'','Kas Anggota')->result();
		echo '
		<title>Buku Bank Kas Toko All</title>
		<body onload="window.print();window.close();"> ';
		$this->load->view('user/css_print');
	echo '<div class="container-fluid" style="height: 100%;">
				<section class="content-header h-h1">
						<div class="col-md-4">
								<h1 class="img-logo">
										<img src="'.base_url().'/assets_kasir/img/logo_kasir_warna.png">&nbsp;&nbsp;<i class="fa fa-desktop"></i>
								</h1>
						</div>
						<div class="col-md-8">
							<h3 style="margin: 0px;" class="pull-left"><b>Penjualan Belanja Barang Toko - Laporan Laba Rugi</b><br>
							Jl. Letkol Istiqlah No.109, Mojopanggung, Kec. Banyuwangi, Kabupaten Banyuwangi, Jawa Timur 68422</h3>

						</div>
						<div class="col-md-12"><hr></div>
		';

		echo '
		</section>

		<section class="content">
				<div class="container-fluid">
						<div class="row">
								<div class="col-md-12">
										<table class="table table-striped table-bordered datatable-biasa">
											<thead>
											<tr>
												<th>No</th>
												<th>Nama Bank</th>
												<th>Tanggal</th>
												<th>Kode</th>
												<th>Uraian Kode</th>
												<th>Keterangan</th>
												<th>Pengeluaran</th>
												<th>Pemasukan</th>
												<th>Hasil</th>
												<th>Saldo</th>
											</tr>
										</thead>
										<tbody>
		';

		$no=0;
		$sal=0;
		$kredit=0;
		$debit=0;
		foreach($list_bank_toko as $l):
		$no++;
		echo '
		<tr>
			<td>'.$no.'</td>
			<td>'.$l->nama_bank.'</td>
			<td>'.date('d-m-Y',strtotime($l->tanggal)).'</td>
			<td>'.$l->kode.'</td>
			<td>'.$l->uraian_kode.'</td>
			<td>'.$l->uraian.'</td>
			<td>Rp '.number_format($l->kredit).'</td>
			<td>Rp '.number_format($l->debit).'</td> ';
			$salq =  $l->kredit - $l->debit;
			echo '
			<td>Rp '.number_format($salq).'</td>
			<td>Rp ';
			if($no==1){
				 $sal=$salq;
			}else{
		$sal = $salq + $sal ;
			}
			echo number_format($sal);

			 echo '
			 </td>
			</tr>
			 ';
			 $kre[$no] = $l->kredit;
			 $de[$no] = $l->debit;
			 $debit += $de[$no];
			 $kredit += $kre[$no];
		endforeach;
		echo '
		<tr style="background-color:#2ed573;">
			<td colspan="6"><b>Total</b></td>
			<td>Rp '.number_format($kredit).'</td>
			<td>Rp  '.number_format($debit).'</td>
			<td colspan="2">Rp '.number_format($sal).' </td>
		</tr>
		</tbody>
	</table>
		</div>
</div>
</div>
</section>
</div>
		';

	}
	function cari_cetak_buku_anggota($stat = null,$stat1 = null,$idne = null){
		(is_null($stat)) ? $tgl='' : $tgl = $stat;
		(is_null($stat1)) ? $tg1l='' : $tgl1 = $stat1;
		(is_null($idne)) ? $id='' : $id = $idne;
		$list_bank_toko = $this->m_data->list_bank_toko($tgl,$tgl1,$id,'','Kas Anggota')->result();
		echo '
		<title>Buku Bank Kas Toko All</title>
		<body onload="window.print();window.close();"> ';
		$this->load->view('user/css_print');
	echo '<div class="container-fluid" style="height: 100%;">
				<section class="content-header h-h1">
						<div class="col-md-4">
								<h1 class="img-logo">
										<img src="'.base_url().'/assets_kasir/img/logo_kasir_warna.png">&nbsp;&nbsp;<i class="fa fa-desktop"></i>
								</h1>
						</div>
						<div class="col-md-8">
							<h3 style="margin: 0px;" class="pull-left"><b>Penjualan Belanja Barang Toko - Laporan Laba Rugi</b><br>
							Jl. Letkol Istiqlah No.109, Mojopanggung, Kec. Banyuwangi, Kabupaten Banyuwangi, Jawa Timur 68422</h3>

						</div>
						<div class="col-md-12"><hr></div>
		';

		echo '
		</section>

		<section class="content">
				<div class="container-fluid">
						<div class="row">
								<div class="col-md-12">
										<table class="table table-striped table-bordered datatable-biasa">
											<thead>
											<tr>
												<th>No</th>
												<th>Nama Bank</th>
												<th>Tanggal</th>
												<th>Kode</th>
												<th>Uraian Kode</th>
												<th>Keterangan</th>
												<th>Pengeluaran</th>
												<th>Pemasukan</th>
												<th>Hasil</th>
												<th>Saldo</th>
											</tr>
										</thead>
										<tbody>
		';

		$no=0;
		$sal=0;
		$kredit=0;
		$debit=0;
		foreach($list_bank_toko as $l):
		$no++;
		echo '
		<tr>
			<td>'.$no.'</td>
			<td>'.$l->nama_bank.'</td>
			<td>'.date('d-m-Y',strtotime($l->tanggal)).'</td>
			<td>'.$l->kode.'</td>
			<td>'.$l->uraian_kode.'</td>
			<td>'.$l->uraian.'</td>
			<td>Rp '.number_format($l->kredit).'</td>
			<td>Rp '.number_format($l->debit).'</td> ';
			$salq =  $l->kredit - $l->debit;
			echo '
			<td>Rp '.number_format($salq).'</td>
			<td>Rp ';
			if($no==1){
				 $sal=$salq;
			}else{
		$sal = $salq + $sal ;
			}
			echo number_format($sal);

			 echo '
			 </td>
			</tr>
			 ';
			 $kre[$no] = $l->kredit;
			 $de[$no] = $l->debit;
			 $debit += $de[$no];
			 $kredit += $kre[$no];
		endforeach;
		echo '
		<tr>
			<td colspan="6"><b>Total</b></td>
			<td>Rp '.number_format($kredit).'</td>
			<td>Rp  '.number_format($debit).'</td>
			<td colspan="2">Rp '.number_format($sal).' </td>
		</tr>
		</tbody>
	</table>
		</div>
	</div>
	</div>
	</section>
	</div>
		';

	}
	function rbuku1($stat = null,$stat1 = null,$op = null){
		(is_null($stat)) ? $tgl='' : $tgl = $stat;
		(is_null($stat1)) ? $tgl1='' : $tgl1 = $stat1;
		(is_null($op)) ? $id='' : $id = $op;
		$data['tgl'] = $tgl;
		$data['tgl1'] = $tgl1;
		$data['id'] = $id;
		$data['daftar_bank_anggota'] = $this->m_other->daftar_bank_anggota($tgl,$tgl1,$id,'BABKA','Kas Anggota')->result();
		$data['operator'] = $this->m_data->where('users',['id !=','1'])->result();
		$data['kode_transaksi'] = $this->m_data->where('kode_transaksi',array('status' => 'Kas Anggota'))->result();
		$this->load->view('user/rbuku1',$data);
	}

	function rbuku2($stat = null,$stat1 = null,$op = null){
		(is_null($stat)) ? $tgl='' : $tgl = $stat;
		(is_null($stat1)) ? $tgl1='' : $tgl1 = $stat1;
		(is_null($op)) ? $id='' : $id = $op;
		$data['tgl'] = $tgl;
		$data['tgl1'] = $tgl1;
		$data['id'] = $id;
		$data['daftar_bank_anggota'] = $this->m_other->daftar_bank_anggota($tgl,$tgl1,$id,'PBBKA','Kas Anggota')->result();
		$data['operator'] = $this->m_data->where('users',['id !=','1'])->result();
		$data['kode_transaksi'] = $this->m_data->where('kode_transaksi',array('status' => 'Kas Anggota'))->result();
		$this->load->view('user/rbuku2',$data);
	}

	function rbuku3($stat = null,$stat1 = null,$op = null){
		(is_null($stat)) ? $tgl='' : $tgl = $stat;
		(is_null($stat1)) ? $tgl1='' : $tgl1 = $stat1;
		(is_null($op)) ? $id='' : $id = $op;
		$data['tgl'] = $tgl;
		$data['tgl1'] = $tgl1;
		$data['id'] = $id;
		$data['daftar_bank_anggota'] = $this->m_other->daftar_bank_anggota($tgl,$tgl1,$id,'STKA','Kas Anggota')->result();
		$data['operator'] = $this->m_data->where('users',['id !=','1'])->result();
		$data['kode_transaksi'] = $this->m_data->where('kode_transaksi',array('status' => 'Kas Anggota'))->result();
		$this->load->view('user/rbuku3',$data);
	}

	function rbuku4($stat = null,$stat1 = null,$op = null){
		(is_null($stat)) ? $tgl='' : $tgl = $stat;
		(is_null($stat1)) ? $tgl1='' : $tgl1 = $stat1;
		(is_null($op)) ? $id='' : $id = $op;
		$data['tgl'] = $tgl;
		$data['tgl1'] = $tgl1;
		$data['id'] = $id;
		$data['daftar_bank_anggota'] = $this->m_other->daftar_bank_anggota($tgl,$tgl1,$id,'TMKA','Kas Anggota')->result();
		$data['operator'] = $this->m_data->where('users',['id !=','1'])->result();
		$data['kode_transaksi'] = $this->m_data->where('kode_transaksi',array('status' => 'Kas Anggota'))->result();
		$this->load->view('user/rbuku4',$data);
	}

	function rbuku5($stat = null,$stat1 = null,$op = null){
		(is_null($stat)) ? $tgl='' : $tgl = $stat;
		(is_null($stat1)) ? $tgl1='' : $tgl1 = $stat1;
		(is_null($op)) ? $id='' : $id = $op;
		$data['tgl'] = $tgl;
		$data['tgl1'] = $tgl1;
		$data['id'] = $id;
		$data['daftar_bank_anggota'] = $this->m_other->daftar_bank_anggota($tgl,$tgl1,$id,'TTKA','Kas Anggota')->result();
		$data['operator'] = $this->m_data->where('users',['id !=','1'])->result();
		$data['kode_transaksi'] = $this->m_data->where('kode_transaksi',array('status' => 'Kas Anggota'))->result();
		$this->load->view('user/rbuku5',$data);
	}

	function rbuku6($stat = null,$stat1 = null,$op = null){
		(is_null($stat)) ? $tgl='' : $tgl = $stat;
		(is_null($stat1)) ? $tgl1='' : $tgl1 = $stat1;
		(is_null($op)) ? $id='' : $id = $op;
		$data['tgl'] = $tgl;
		$data['tgl1'] = $tgl1;
		$data['id'] = $id;
		$data['daftar_bank_anggota'] = $this->m_other->daftar_bank_anggota($tgl,$tgl1,$id,'TKKA','Kas Anggota')->result();
		$data['operator'] = $this->m_data->where('users',['id !=','1'])->result();
		$data['kode_transaksi'] = $this->m_data->where('kode_transaksi',array('status' => 'Kas Anggota'))->result();
		$this->load->view('user/rbuku6',$data);
	}

	function rbuku7($stat = null,$stat1 = null,$op = null){
		(is_null($stat)) ? $tgl='' : $tgl = $stat;
		(is_null($stat1)) ? $tgl1='' : $tgl1 = $stat1;
		(is_null($op)) ? $id='' : $id = $op;
		$data['tgl'] = $tgl;
		$data['tgl1'] = $tgl1;
		$data['id'] = $id;
		$data['daftar_bank_anggota'] = $this->m_other->daftar_bank_anggota($tgl,$tgl1,$id,'SBBBKA','Kas Anggota')->result();
		$data['operator'] = $this->m_data->where('users',['id !=','1'])->result();
		$data['kode_transaksi'] = $this->m_data->where('kode_transaksi',array('status' => 'Kas Anggota'))->result();
		$this->load->view('user/rbuku7',$data);
	}

	function rbuku8($stat = null,$stat1 = null,$op = null){
		(is_null($stat)) ? $tgl='' : $tgl = $stat;
		(is_null($stat1)) ? $tgl1='' : $tgl1 = $stat1;
		(is_null($op)) ? $id='' : $id = $op;
		$data['tgl'] = $tgl;
		$data['tgl1'] = $tgl1;
		$data['id'] = $id;
		$data['daftar_bank_anggota'] = $this->m_other->daftar_bank_anggota($tgl,$tgl1,$id,'SBBYLKA','Kas Anggota')->result();
		$data['operator'] = $this->m_data->where('users',['id !=','1'])->result();
		$data['kode_transaksi'] = $this->m_data->where('kode_transaksi',array('status' => 'Kas Anggota'))->result();
		$this->load->view('user/rbuku8',$data);
	}


	function cetak_buku_anggota_all_in_one($stat = null,$stat1 = null,$idne = null,$kode){
		(is_null($stat)) ? $tgl='' : $tgl = $stat;
		(is_null($stat1)) ? $tg1l='' : $tgl1 = $stat1;
		(is_null($idne)) ? $id='' : $id = $idne;
		$list_bank_toko = $this->m_data->list_bank_toko($tgl,$tgl1,$id,$kode,'Kas Anggota')->result();
		echo '
		<title>Buku Bank Kas Toko All</title>
		<body onload="window.print();window.close();"> ';
		$this->load->view('user/css_print');
	echo '<div class="container-fluid" style="height: 100%;">
				<section class="content-header h-h1">
						<div class="col-md-4">
								<h1 class="img-logo">
										<img src="'.base_url().'/assets_kasir/img/logo_kasir_warna.png">&nbsp;&nbsp;<i class="fa fa-desktop"></i>
								</h1>
						</div>
						<div class="col-md-8">
							<h3 style="margin: 0px;" class="pull-left"><b>Penjualan Belanja Barang Toko - Laporan Laba Rugi</b><br>
							Jl. Letkol Istiqlah No.109, Mojopanggung, Kec. Banyuwangi, Kabupaten Banyuwangi, Jawa Timur 68422</h3>

						</div>
						<div class="col-md-12"><hr></div>
		';

		echo '
		</section>

		<section class="content">
				<div class="container-fluid">
						<div class="row">
								<div class="col-md-12">
										<table class="table table-striped table-bordered datatable-biasa">
											<thead>
											<tr>
												<th>No</th>
												<th>Nama Bank</th>
												<th>Tanggal</th>
												<th>Kode</th>
												<th>Uraian Kode</th>
												<th>Keterangan</th>
												<th>Pengeluaran</th>
												<th>Pemasukan</th>
												<th>Hasil</th>
												<th>Saldo</th>
											</tr>
										</thead>
										<tbody>
		';

		$no=0;
		$sal=0;
		$kredit=0;
		$debit=0;
		foreach($list_bank_toko as $l):
		$no++;
		echo '
		<tr>
			<td>'.$no.'</td>
			<td>'.$l->nama_bank.'</td>
			<td>'.date('d-m-Y',strtotime($l->tanggal)).'</td>
			<td>'.$l->kode.'</td>
			<td>'.$l->uraian_kode.'</td>
			<td>'.$l->uraian.'</td>
			<td>Rp '.number_format($l->kredit).'</td>
			<td>Rp '.number_format($l->debit).'</td> ';
			$salq =  $l->kredit - $l->debit;
			echo '
			<td>Rp '.number_format($salq).'</td>
			<td>Rp ';
			if($no==1){
				 $sal=$salq;
			}else{
		$sal = $salq - $sal ;
			}
			echo number_format($sal);

			 echo '
			 </td>
			</tr>
			 ';
			 $kre[$no] = $l->kredit;
			 $de[$no] = $l->debit;
			 $debit += $de[$no];
			 $kredit += $kre[$no];
		endforeach;
		echo '
		<tr>
			<td colspan="6"><b>Total</b></td>
			<td>Rp '.number_format($kredit).'</td>
			<td>Rp  '.number_format($debit).'</td>
			<td colspan="2">Rp '.number_format($sal).' </td>
		</tr>
		</tbody>
	</table>
		</div>
	</div>
	</div>
	</section>
	</div>
		';

	}

	function export_buku_anggota_all_in_one($stat,$stat1,$idne,$kode,$aturan){
		($stat == 0) ? $tgl='' : $tgl = $stat;
		($stat1 == 0) ? $tg1l='' : $tgl1 = $stat1;
		($idne == 0) ? $id='' : $id = $idne;
		$cari_kode = $this->m_data->where('kode_transaksi',array('kode' => $kode,'status' => 'Kas Anggota'))->row();
		header("Content-type: application/vnd-ms-excel");
		header("Content-Disposition: attachment; filename=".$cari_kode->uraian_kode.".xls");
		header("Pragma: no-cache");
		header("Expires: 0");
		$list_bank_toko = $this->m_data->list_bank_toko($tgl,$tgl1,$id,$kode,'Kas Anggota')->result();
		echo '
		<html>
		<head>
			<title></title>
		</head>
		<body style="border:1px solid #ccc;border-collapse: collapse;">
		<table class="table table-bordered" border="1" width="100%">
			<thead>
				<tr>
					<th>No</th>
					<th>Nama Bank</th>
					<th>Tanggal</th>
					<th>Kode</th>
					<th>Uraian Kode</th>
					<th>Keterangan</th>
					<th>Pengeluaran</th>
					<th>Pemasukan</th>
					<th>Hasil</th>
					<th>Saldo</th>
				</tr>
			</thead>
			<tbody>
		';
		$no=0;
		$sal=0;
		$kredit=0;
		$debit=0;
		foreach($list_bank_toko as $l):
		$no++;
		echo '
		<tr>
			<td>'.$no.'</td>
			<td>'.$l->nama_bank.'</td>
			<td>'.date('d-m-Y',strtotime($l->tanggal)).'</td>
			<td>'.$l->kode.'</td>
			<td>'.$l->uraian_kode.'</td>
			<td>'.$l->uraian.'</td>
			<td>Rp '.number_format($l->kredit).'</td>
			<td>Rp '.number_format($l->debit).'</td> ';
			if($aturan == 'tambah'){
				$salq =  $l->debit - $l->kredit;
			}else{
				$salq =  $l->kredit - $l->debit;
			}
			echo '
			<td>Rp '.number_format($salq).'</td>
			<td>Rp ';
			if($no==1){
				 $sal=$salq;
			}else{
				if($aturan == 'tambah'){

		$sal = $salq + $sal ;
	}else{
		$sal = $salq - $sal ;

	}
			}
			echo number_format($sal);

			 echo '
			 </td>
			</tr>
			 ';
			 $kre[$no] = $l->kredit;
			 $de[$no] = $l->debit;
			 $debit += $de[$no];
			 $kredit += $kre[$no];
		endforeach;
		echo '
		<tr>
			<td colspan="6"><b>Total</b></td>
			<td>Rp '.number_format($kredit).'</td>
			<td>Rp  '.number_format($debit).'</td>
			<td colspan="2">Rp '.number_format($sal).' </td>
		</tr>
		</tbody>
	</table>
	</body>
	</html>
		';
	}

	function cetak_buku1($stat,$stat1,$idne,$kode,$aturan){
		($stat == 0) ? $tgl='' : $tgl = $stat;
		($stat1 == 0) ? $tgl1='' : $tgl1 = $stat1;
		($idne == 0) ? $id='' : $id = $idne;
		$cari_kode = $this->m_data->where('kode_transaksi',array('kode' => $kode,'status' => 'Kas Anggota'))->row();
		$list_bank_toko = $this->m_data->list_bank_toko($tgl,$tgl1,$id,$kode,'Kas Anggota')->result();
		echo '
		<title>'.$cari_kode->uraian_kode.'</title>
		<body onload="window.print();window.close();"> ';
		$this->load->view('user/css_print');
	echo '<div class="container-fluid" style="height: 100%;">
				<section class="content-header h-h1">
						<div class="col-md-4">
								<h1 class="img-logo">
										<img src="'.base_url().'/assets_kasir/img/logo_kasir_warna.png">&nbsp;&nbsp;<i class="fa fa-desktop"></i>
								</h1>
						</div>
						<div class="col-md-8">
							<h3 style="margin: 0px;" class="pull-left"><b>Penjualan Belanja Barang Toko - Laporan Laba Rugi</b><br>
							Jl. Letkol Istiqlah No.109, Mojopanggung, Kec. Banyuwangi, Kabupaten Banyuwangi, Jawa Timur 68422</h3>

						</div>
						<div class="col-md-12"><hr></div>
		';

		echo '
		</section>

		<section class="content">
				<div class="container-fluid">
						<div class="row">
								<div class="col-md-12"> ' ;
								$no=0;
								$sal=0;
								$kredit=0;
								$debit=0;
								foreach($list_bank_toko as $l){
								 $no++;
								 if($aturan == 'tambah'){
									 $salq =  $l->debit - $l->kredit;
								 }else{
									 $salq =  $l->kredit - $l->debit;
								 }

								 if($no==1){
										$sal=$salq;
								 }else{
									 if($aturan == 'tambah'){
										 $sal = $salq + $sal ;
									 }else{
										 $sal = $salq + $sal ;

									 }
								 }

								 $kre[$no] = $l->kredit;
								 $de[$no] = $l->debit;
								 $debit += $de[$no];
								 $kredit += $kre[$no];
								}
								if($kode == 'BABKA'){
									$saldo = $debit;
								}elseif($kode == 'PBBKA'){
									$saldo = $kredit;
								}elseif($kode == 'STKA'){
									$saldo = $kredit;
								}elseif($kode == 'TMKA'){
									$saldo = $kredit;
								}elseif($kode == 'TTKA'){
									$saldo = $debit;
								}elseif($kode == 'TKKA'){
									$saldo = $debit;
								}elseif($kode == 'SBBBKA'){
									$saldo = $sal;
								}elseif($kode == 'SBBYLKA'){
									$saldo = $sal;
								}
								echo '
								<div class="col-md-12">
									 <p style="padding:5px 10px;background-color:#ffbe76;"><b>Saldo</b> : <b>Rp. '.number_format($saldo).' </b></p>
								</div>
								<table class="table table-bordered">
									<thead>
										<tr>
											<th>No</th>
											<th>Nama Bank</th>
											<th>Tanggal</th>
											<th>Kode</th>
											<th>Uraian Kode</th>
											<th>Keterangan</th>
											<th>Pengeluaran (Debit)</th>
											<th>Pemasukan (Kredit)</th>';
											if($kode == 'SBBBKA'){
												echo '
												<th>Hasil</th>
												<th>Saldo</th>
												';
											}elseif($kode == 'SBBYLKA'){
												echo '
												<th>Hasil</th>
												<th>Saldo</th>
												';
											}
											echo  '
										</tr>
									</thead>
									<tbody>';
									$no=0;
									$sal=0;
									$kredit=0;
									$debit=0;
									foreach($list_bank_toko as $l):
									$no++;
									echo '
									<tr>
										<td>'.$no.'</td>
										<td>'.$l->nama_bank.'</td>
										<td>'.date('d-m-Y',strtotime($l->tanggal)).'</td>
										<td>'.$l->kode.'</td>
										<td>'.$l->uraian_kode.'</td>
										<td>'.$l->uraian.'</td>
										<td>Rp '.number_format($l->debit).'</td>
										<td>Rp '.number_format($l->kredit).'</td> ';
										if($kode == 'SBBBKA'){
												$salq =  $l->kredit - $l->debit;
											if($no==1){
												 $sal=$salq;
											}else{
										$sal = $salq + $sal ;
										}

											echo '
											<td>Rp '.number_format($salq).'</td>
											<td>Rp '.number_format($sal).' </td>
											';
									}elseif($kode == 'SBBYLKA'){
											$salq =  $l->kredit - $l->debit;
										if($no==1){
											 $sal=$salq;
										}else{
									$sal = $salq + $sal ;
									}

										echo '
										<td>Rp '.number_format($salq).'</td>
										<td>Rp '.number_format($sal).' </td>
										';
								}

										if($aturan == 'tambah'){
											$salq =  $l->debit - $l->kredit;
										}else{
											$salq =  $l->kredit - $l->debit;
										}
										if($no==1){
											 $sal2=$salq;
										}else{
											if($aturan == 'tambah'){
												$sal2 = $salq + $sal ;
											}else{
												$sal2 = $salq - $sal ;

											}
										}

										 echo '

										</tr>
										 ';
										 $kre[$no] = $l->kredit;
										 $de[$no] = $l->debit;
										 $debit += $de[$no];
										 $kredit += $kre[$no];
									endforeach;
									echo '
									<tr>
										<td colspan="6"><b>Total</b></td>
										<td>Rp '.number_format($debit).'</td>
										<td>Rp '.number_format($kredit).'</td>';
										if($kode == 'SBBBKA'){
											echo '<td colspan="3" style="text-align:center;">Rp '.number_format($sal).'</td>';
										}
										if($kode == 'SBBYLKA'){
											echo '<td colspan="3">Rp '.number_format($sal).'</td>';
										}
										echo  '
									</tr>
									</tbody>
								</table>';
	echo '
		</div>
</div>
</div>
</section>
</div>
		';

	}

	//exportfix

	function export_buku($stat = null,$stat1 = null,$idne = null){
		(is_null($stat)) ? $tgl='' : $tgl = $stat;
		(is_null($stat1)) ? $tg1l='' : $tgl1 = $stat1;
		(is_null($idne)) ? $id='' : $id = $idne;
		header("Content-type: application/vnd-ms-excel");
		header("Content-Disposition: attachment; filename=Buku_Bank_kas_anggota_All.xls");
		header("Pragma: no-cache");
		header("Expires: 0");
		$list_bank_toko = $this->m_data->list_bank_toko($tgl,$tgl1,$id,'','Kas Anggota')->result();
		echo '
		<html>
		<head>
			<title></title>
		</head>
		<body style="border:1px solid #ccc;border-collapse: collapse;">
		<table class="table table-bordered" border="1" width="100%">
			<thead>
				<tr>
					<th>No</th>
					<th>Nama Bank</th>
					<th>Tanggal</th>
					<th>Kode</th>
					<th>Uraian Kode</th>
					<th>Keterangan</th>
					<th>Pengeluaran</th>
					<th>Pemasukan</th>
					<th>Hasil</th>
					<th>Saldo</th>
				</tr>
			</thead>
			<tbody>
		';
		$no=0;
		$sal=0;
		$kredit=0;
		$debit=0;
		foreach($list_bank_toko as $l):
		$no++;
		echo '
		<tr>
			<td>'.$no.'</td>
			<td>'.$l->nama_bank.'</td>
			<td>'.date('d-m-Y',strtotime($l->tanggal)).'</td>
			<td>'.$l->kode.'</td>
			<td>'.$l->uraian_kode.'</td>
			<td>'.$l->uraian.'</td>
			<td>Rp '.number_format($l->kredit).'</td>
			<td>Rp '.number_format($l->debit).'</td> ';
			$salq =  $l->kredit - $l->debit;
			echo '
			<td>Rp '.number_format($salq).'</td>
			<td>Rp ';
			if($no==1){
				 $sal=$salq;
			}else{
		$sal = $salq + $sal ;
			}
			echo number_format($sal);

			 echo '
			 </td>
			</tr>
			 ';
			 $kre[$no] = $l->kredit;
			 $de[$no] = $l->debit;
			 $debit += $de[$no];
			 $kredit += $kre[$no];
		endforeach;
		echo '
		<tr>
			<td colspan="6"><b>Total</b></td>
			<td>Rp '.number_format($kredit).'</td>
			<td>Rp  '.number_format($debit).'</td>
			<td colspan="2">Rp '.number_format($sal).' </td>
		</tr>
		</tbody>
	</table>
	</body>
	</html>
		';
	}

	function export_buku1($stat,$stat1,$idne,$kode,$aturan){
		($stat == 0) ? $tgl='' : $tgl = $stat;
		($stat1 == 0) ? $tg1l='' : $tgl1 = $stat1;
		($idne == 0) ? $id='' : $id = $idne;
		$cari_kode = $this->m_data->where('kode_transaksi',array('kode' => $kode,'status' => 'Kas Anggota'))->row();
		header("Content-type: application/vnd-ms-excel");
		header("Content-Disposition: attachment; filename=".$cari_kode->uraian_kode.".xls");
		header("Pragma: no-cache");
		header("Expires: 0");
		$list_bank_toko = $this->m_data->list_bank_toko($tgl,$tgl1,$id,$kode,'Kas Anggota')->result();
		if($kode == 'BABKA'){
			echo '
			<html>
			<head>
				<title></title>
			</head>
			<body style="border:1px solid #ccc;border-collapse: collapse;">';

			$no=0;
			$sal=0;
			$kredit=0;
			$debit=0;
			foreach($list_bank_toko as $l){
			 $no++;
			 $salq = $l->debit - $l->kredit;
		 if($no==1){
					 $sal=$salq;
				}else{
			$sal = $salq - $sal ;
				}
			 $kre[$no] = $l->kredit;
			 $de[$no] = $l->debit;
			 $debit += $de[$no];
			 $kredit += $kre[$no];
			}
			echo '
			<div class="col-md-12">
				 <p style="padding:5px 10px;background-color:#ffbe76;"><b>Saldo</b> : <b>Rp. '.number_format($debit).' </b></p>
			</div>
			<table class="table table-bordered" border="1" width="100%">
				<thead>
					<tr>
						<th>No</th>
						<th>Nama Bank</th>
						<th>Tanggal</th>
						<th>Kode</th>
						<th>Uraian Kode</th>
						<th>Keterangan</th>
						<th>Pengeluaran (Debit)</th>
						<th>Pemasukan (Kredit)</th>
					</tr>
				</thead>
				<tbody>
			';
			$no=0;
			$sal=0;
			$kredit=0;
			$debit=0;
			foreach($list_bank_toko as $l):
			$no++;
			echo '
			<tr>
				<td>'.$no.'</td>
				<td>'.$l->nama_bank.'</td>
				<td>'.date('d-m-Y',strtotime($l->tanggal)).'</td>
				<td>'.$l->kode.'</td>
				<td>'.$l->uraian_kode.'</td>
				<td>'.$l->uraian.'</td>
				<td>Rp '.number_format($l->debit).'</td>
				<td>Rp '.number_format($l->kredit).'</td> ';
				if($aturan == 'tambah'){
					$salq =  $l->debit - $l->kredit;
				}else{
					$salq =  $l->kredit - $l->debit;
				}
				echo '
				';
				if($no==1){
					 $sal=$salq;
				}else{
					if($aturan == 'tambah'){

			$sal = $salq + $sal ;
		}else{
			$sal = $salq + $sal ;

		}
				}
				//echo number_format($sal);

				 echo '

				</tr>
				 ';
				 $kre[$no] = $l->kredit;
				 $de[$no] = $l->debit;
				 $debit += $de[$no];
				 $kredit += $kre[$no];
			endforeach;
			echo '
			<tr>
				<td colspan="6"><b>Total</b></td>
				<td>Rp '.number_format($debit).'</td>
				<td>Rp  '.number_format($kredit).'</td>
			</tr>
			</tbody>
		</table>
		</body>
		</html>
			';
		}else{
			echo '
			<html>
			<head>
				<title></title>
			</head>
			<body>';

			$no=0;
			$sal=0;
			$kredit=0;
			$debit=0;
			foreach($list_bank_toko as $l){
			 $no++;
			 if($aturan == 'tambah'){
				 $salq =  $l->debit - $l->kredit;
			 }else{
				 $salq =  $l->kredit - $l->debit;
			 }
			 if($no==1){
					$sal=$salq;
			 }else{
				 if($aturan == 'tambah'){
					 $sal = $salq + $sal ;
				 }else{
					 $sal = $salq + $sal ;

				 }
			 }
			 $kre[$no] = $l->kredit;
			 $de[$no] = $l->debit;
			 $debit += $de[$no];
			 $kredit += $kre[$no];
			}
			if($kode == 'PBBKA'){
				$saldo = $kredit;
			}elseif($kode == 'STKA'){
				$saldo = $kredit;
			}elseif($kode == 'TMKA'){
				$saldo = $kredit;
			}elseif($kode == 'TTKA'){
				$saldo = $debit;
			}elseif($kode == 'TKKA'){
				$saldo = $debit;
			}elseif($kode == 'SBBBKA'){
				$saldo = $sal;
			}elseif($kode == 'SBBYLKA'){
				$saldo = $sal;
			}
			echo '
			<div class="col-md-12">
				 <p style="padding:5px 10px;background-color:#ffbe76;"><b>Saldo</b> : <b>Rp. '.number_format($saldo).' </b></p>
			</div>
			<table class="table table-bordered" border="1" width="100%">
				<thead>
					<tr>
						<th>No</th>
						<th>Nama Bank</th>
						<th>Tanggal</th>
						<th>Kode</th>
						<th>Uraian Kode</th>
						<th>Keterangan</th>
						<th>Pengeluaran (Debit)</th>
						<th>Pemasukan (Kredit)</th>';
						if($kode == 'SBBBKA'){
							echo '
							<th>Hasil</th>
							<th>Saldo</th>
							';
						}
						echo  '
					</tr>
				</thead>
				<tbody>
			';
			$no=0;
			$sal=0;
			$kredit=0;
			$debit=0;
			foreach($list_bank_toko as $l):
			$no++;
			echo '
			<tr>
				<td>'.$no.'</td>
				<td>'.$l->nama_bank.'</td>
				<td>'.date('d-m-Y',strtotime($l->tanggal)).'</td>
				<td>'.$l->kode.'</td>
				<td>'.$l->uraian_kode.'</td>
				<td>'.$l->uraian.'</td>
				<td>Rp '.number_format($l->debit).'</td>
				<td>Rp '.number_format($l->kredit).'</td> ';
				if($kode == 'SBBBKA'){
						$salq =  $l->kredit - $l->debit;
					if($no==1){
						 $sal=$salq;
					}else{
							$sal = $salq + $sal ;
					}

					echo '
					<td>Rp '.number_format($salq).'</td>
					<td>Rp '.number_format($sal).' </td>
					';
			}elseif($kode == 'SBBYLKA'){
					$salq =  $l->kredit - $l->debit;
				if($no==1){
					 $sal=$salq;
				}else{
						$sal = $salq + $sal ;
				}

				echo '
				<td>Rp '.number_format($salq).'</td>
				<td>Rp '.number_format($sal).' </td>
				';
			}

				// if($aturan == 'tambah'){
				// 	$salq2 =  $l->debit - $l->kredit;
				// }else{
				// 	$salq2 =  $l->kredit - $l->debit;
				// }
				// if($no==1){
				// 	 $sal2=$salq2;
				// }else{
				// 	if($aturan == 'tambah'){
				// 		$sal2 = $salq2 + $sal ;
				// 	}else{
				// 		$sal2 = $salq2 + $sal ;
				//
				// 	}
				// }

				 echo '

				</tr>
				 ';
				 $kre[$no] = $l->kredit;
				 $de[$no] = $l->debit;
				 $debit += $de[$no];
				 $kredit += $kre[$no];
			endforeach;
			echo '
			<tr>
				<td colspan="6"><b>Total</b></td>
				<td>Rp '.number_format($debit).'</td>
				<td>Rp '.number_format($kredit).'</td>';
				if($kode == 'SBBBKA'){
					echo '<td colspan="2">Rp '.number_format($sal).'</td>';
				}elseif($kode == 'SBBYLKA'){
					echo '<td colspan="2">Rp '.number_format($sal).'</td>';
				}
				echo  '
			</tr>
			</tbody>
		</table>
		</body>
		</html>
			';
		}

	}

}
