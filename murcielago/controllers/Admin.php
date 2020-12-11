<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin extends CI_Controller {
	function __construct(){
		parent::__construct();
    if (!$this->ion_auth->logged_in()){
       redirect('auth/login');
     }
	}
  function index(){
		$data['title'] = 'Admin S1 Keperawatan Stikes Banyuwangi';
		$data['users'] = $this->ion_auth->user()->row();
		$this->load->view('admin/header',$data);
		$this->load->view('admin/home');
		$this->load->view('admin/footer');
  }
	function tentang(){
		$data['title'] = 'Tentang S1 Keperawatan Stikes Banyuwangi';
		$data['users'] = $this->ion_auth->user()->row();
		$this->load->view('admin/header',$data);
		$this->load->view('admin/admin_tentang');
		$this->load->view('admin/footer');
	}
	function upload_image_summ(){
		if(isset($_FILES["image"]["name"])){
				$config['upload_path'] = './assets_admin/images/';
				$config['allowed_types'] = 'jpg|jpeg|png|gif';
				$nmfile = "tantang_kami-".date('Ymd')."_".md5(date('His'))."";
	      $config[ 'file_name' ] = $nmfile;
				$this->upload->initialize($config);
				if(!$this->upload->do_upload('image')){
						$this->upload->display_errors();
						return FALSE;
				}else{
						$data = $this->upload->data();
						//Compress Image
						$nmfile = "tentang_kami-".date('Ymd')."_".md5(date('His'))."";
			      $config[ 'file_name' ] = $nmfile;
						$config['image_library']='gd2';
						$config['source_image']='./assets_admin/images/'.$data['file_name'];
						$config['create_thumb']= FALSE;
						$config['maintain_ratio']= TRUE;
						$config['quality']= '60%';
						$config['width']= 800;
						$config['height']= 800;
						$config['new_image']= './assets_admin/images/'.$data['file_name'];
						$this->load->library('image_lib', $config);
						$this->image_lib->resize();
						echo base_url().'assets_admin/images/'.$data['file_name'];
				}
		}
	}
	function delete_image_summ(){
		$src = $this->input->post('src');
		$file_name = str_replace(base_url(), '', $src);
		if(unlink($file_name)){
				echo 'File Delete Successfully';
		}
	}
	function sys_tambah_tentang(){
		if(empty($this->input->post('text'))){
			$data = array(
				'text' => $this->input->post('text'),
				'grup' => 'tentang_kami',
			);
			$this->db->insert('content',$data);
		}else{
			$data = array(
				'text' => $this->input->post('text'),
			);
			$this->m_data->update_data(array('grup' => 'tentang_kami'),$data,'content');
		}
		redirect('admin/tentang');
	}
	function struktur_organisasi(){
		$data['title'] = 'Struktur Organisasi S1 Keperawatan Stikes Banyuwangi';
		$data['users'] = $this->ion_auth->user()->row();
		$this->load->view('admin/header',$data);
		$this->load->view('admin/admin_struktur_organisasi');
		$this->load->view('admin/footer');
	}
	function visi_misi(){
		$data['title'] = 'Visi Misi S1 Keperawatan Stikes Banyuwangi';
		$data['users'] = $this->ion_auth->user()->row();
		$this->load->view('admin/header',$data);
		$this->load->view('admin/admin_visi_misi');
		$this->load->view('admin/footer');
	}
	function sys_tambah_visimisi(){
			if(empty($_POST['visimisi'])){
				$data = array(
					'text' => $this->input->post('visimisi'),
					'grup' => 'visi_misi',
				);
				$this->db->insert('content',$data);
			}else{
				$where = array(
					'grup' => 'visi_misi',
				);
				$data = array(
					'text' => $this->input->post('visimisi'),
				);
				$this->m_data->update_data($where,$data,'content');
			}
			redirect('admin/visi_misi');

	}
	function admin_dosen(){
		$data['title'] = 'Dosen S1 Keperawatan Stikes Banyuwangi';
		$data['users'] = $this->ion_auth->user()->row();
		$data['dosen'] = $this->m_data->where('content',array('grup' => 'dosen'))->result();
		$this->load->view('admin/header',$data);
		$this->load->view('admin/admin_dosen');
		$this->load->view('admin/footer');
	}
	function sys_tambah_dosen(){
		$nmfile2 = "foto_dosen-".date('Ymd')."_".md5(date('His'))."";
		$config2[ 'upload_path' ] = './assets/images/dosen';
		$config2[ 'allowed_types' ] = 'png|jpg|jpeg';
		$config2[ 'max_size' ] = 1000000;
		$config2[ 'file_name' ] = $nmfile2;
		$this->upload->initialize( $config2);
			 if($_FILES['foto']['name']){ // jika input type file sudah ada inputan
					 if ($this->upload->do_upload('foto')){ // upload foto
							 $gbr2 = $this->upload->data(); // deklarasi upload foto
							 $rep1 = str_replace($nmfile2,'',$gbr2['file_name']);
							 $file1 = base_url().'assets/images/dosen/'.$gbr2['file_name']; // file that you wanna compress
							 $new_name_image1 = $nmfile2.'-resized'; // name of new file compressed
							 $quality1 = 50; // Value that I chose
							 $destination1 = base_url().'assets/images/dosen/'; // This destination must be exist on your project

							 $compress1 = new Compress();

							 $compress1->file_url = $file1;
							 $compress1->new_name_image = $new_name_image1;
							 $compress1->quality = $quality1;
							 $compress1->destination = $destination1;
							 $result1 = $compress1->compress_image();
							 unlink('./assets/images/dosen/'.$gbr2['file_name'].'');

					 $datay = array(
						 'text' => $this->input->post('text'),
						 'grup' => 'dosen',
						 'gambar' => base_url().'assets/images/dosen/'.$new_name_image1.$rep1,
						 'txt_gbr' => $new_name_image1.$rep1,
					 );
					 $this->db->insert('content',$datay);
					 $this->session->set_flashdata('alert','<div class="alert alert-success alert-dismissible show fade">
					 <div class="alert-body">
						 <button class="close" data-dismiss="alert">
							 <span>×</span>
						 </button>
						 Berhasil menambah dosen.
					 </div>
				 </div>');
				 redirect('admin/admin_dosen');
					 }else{
					 $this->session->set_flashdata('alert','<div class="alert alert-danger alert-dismissible show fade">
					 <div class="alert-body">
						 <button class="close" data-dismiss="alert">
							 <span>×</span>
						 </button>
						 Gagal menambah dosen. '.$this->upload->display_errors().'
					 </div>
				 </div>');
				 redirect('admin/admin_dosen');

					 }
			 }else{}
	}
	function edit_dosen($id){
		$data['title'] = 'Dosen S1 Keperawatan Stikes Banyuwangi';
		$data['users'] = $this->ion_auth->user()->row();
		$data['dosen'] = $this->m_data->where('content',array('id_content' => $id))->row();
		$this->load->view('admin/header',$data);
		$this->load->view('admin/admin_edit_dosen');
		$this->load->view('admin/footer');
	}
	function sys_edit_dosen($id){
		$nmfile2 = "foto_dosen-".date('Ymd')."_".md5(date('His'))."";
		$config2[ 'upload_path' ] = './assets/images/dosen';
		$config2[ 'allowed_types' ] = 'png|jpg|jpeg';
		$config2[ 'max_size' ] = 1000000;
		$config2[ 'file_name' ] = $nmfile2;
		$this->upload->initialize( $config2);
			 if($_FILES['foto']['name']){ // jika input type file sudah ada inputan
					 if ($this->upload->do_upload('foto')){ // upload foto
							 $gbr2 = $this->upload->data(); // deklarasi upload foto
							 $rep1 = str_replace($nmfile2,'',$gbr2['file_name']);
							 $file1 = base_url().'assets/images/dosen/'.$gbr2['file_name']; // file that you wanna compress
							 $new_name_image1 = $nmfile2.'-resized'; // name of new file compressed
							 $quality1 = 50; // Value that I chose
							 $destination1 = base_url().'assets/images/dosen/'; // This destination must be exist on your project

							 $compress1 = new Compress();

							 $compress1->file_url = $file1;
							 $compress1->new_name_image = $new_name_image1;
							 $compress1->quality = $quality1;
							 $compress1->destination = $destination1;
							 $result1 = $compress1->compress_image();
							 unlink('./assets/images/dosen/'.$gbr2['file_name'].'');

					 $datay = array(
						 'text' => $this->input->post('text'),
						 'gambar' => base_url().'assets/images/dosen/'.$new_name_image1.$rep1,
						 'txt_gbr' => $new_name_image1.$rep1,
					 );
					 $this->m_data->update_data(array('id_content'=>$id),$datay,'content');
					 $this->session->set_flashdata('alert','<div class="alert alert-success alert-dismissible show fade">
					 <div class="alert-body">
						 <button class="close" data-dismiss="alert">
							 <span>×</span>
						 </button>
						 Berhasil merubah dosen.
					 </div>
				 </div>');
				 redirect('admin/admin_dosen');
					 }else{
					 $this->session->set_flashdata('alert','<div class="alert alert-danger alert-dismissible show fade">
					 <div class="alert-body">
						 <button class="close" data-dismiss="alert">
							 <span>×</span>
						 </button>
						 Gagal merubah dosen. '.$this->upload->display_errors().'
					 </div>
				 </div>');
				 redirect('admin/admin_dosen');
					 }
			 }else{
				 $datay = array(
					 'text' => $this->input->post('text'),
				 );
				 $this->m_data->update_data(array('id_content'=>$id),$datay,'content');
				 $this->session->set_flashdata('alert','<div class="alert alert-success alert-dismissible show fade">
				 <div class="alert-body">
					 <button class="close" data-dismiss="alert">
						 <span>×</span>
					 </button>
					 Berhasil merubah dosen.
				 </div>
			 </div>');
			 redirect('admin/admin_dosen');
			 }
	}
	function hapus_dosen($id){
		$data['dosen'] = $this->m_data->where('content',array('id_content' => $id))->row();
		unlink('./assets/images/dosen/'.$data['dosen']->txt_gbr.'');
		$this->m_data->hapus_data(array('id_content' => $id),'content');
		$this->session->set_flashdata('alert','<div class="alert alert-success alert-dismissible show fade">
		<div class="alert-body">
			<button class="close" data-dismiss="alert">
				<span>×</span>
			</button>
			Berhasil menghapus data.
		</div>
	</div>');
	redirect('admin/admin_dosen');
	}
	function berita(){
		$data['title'] = 'Berita S1 Keperawatan Stikes Banyuwangi';
		$data['users'] = $this->ion_auth->user()->row();
		$this->load->view('admin/header',$data);
		$this->load->view('admin/berita');
		$this->load->view('admin/footer');
	}
}
