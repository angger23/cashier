<?php
defined('BASEPATH') OR exit('No direct script access allowed');

  class Buku_umum extends CI_Controller{
    function __construct(){
        parent::__construct();
            $this->load->model('m_data');
            $this->load->helper('url');
            $this->load->model('ion_auth_model');
            $this->load->model('m_other');
          if(!$this->ion_auth->logged_in()){
            redirect("auth/login");
          }
          $this->load->library('Ajax_pagination');
          $this->load->library('user_agent');

          $this->perPage = 10;
      }
      public function index(){
        $data['title'] = 'Buku Bank Umum | Stikes Mart';
    		$this->load->view('user/header',$data);
        $this->load->view('user/Base_Buku_Umum_new');
    		// $this->load->view('user/Base_Buku_Umum_All');
    		$this->load->view('user/footer');
      }

      public function rincian_gaji(){
        $data['title'] = 'Buku Umum Monitoring | Stikes Mart';
        $data['operator'] = $this->m_data->where('users',['id !=','1'])->result();
        $data['kode_transaksi'] = $this->m_data->semua('kode_transaksi2')->result();
        $this->load->view('user/header',$data);
        $this->load->view('user/rincian_gaji');
        $this->load->view('user/footer');
      }

      public function piutang_pegawai(){
        $data['title'] = 'Buku Umum Monitoring | Stikes Mart';
        $data['operator'] = $this->m_data->where('users',['id !=','1'])->result();
        $data['kode_transaksi'] = $this->m_data->semua('kode_transaksi2')->result();
        $this->load->view('user/header',$data);
        $this->load->view('user/piutang_pegawai');
        $this->load->view('user/footer');
      }

      function piutang_pegawai_bayar_cicilan_leeeeeeeeee($id){
        $tahun = substr($this->input->post('tgl_cicil'),0,4);
        $nez = substr($this->input->post('tgl_cicil'),4);
        $bulan = str_replace('-','',substr($nez,0,3));
        $data = array(
          'id_pelanggan' => $id,
          'nominal' => $this->input->post('nominal'),
          'tgl_bayar' => $this->input->post('tgl_cicil'),
          'bulan' => $bulan,
          'tahun' => substr($this->input->post('tgl_cicil'),0,4),
          'created' => date('Y-m-d H:i:s'),
        );
        $this->db->insert('bayar_cicilan',$data);
        redirect('buku_umum/piutang_pegawai');
      }

      function hapus_piutang_pegawai($id){
        $this->m_data->hapus_data(array('id_piutang_pegawai',$id),'piutang_pegawai');
        redirect('buku_umum/piutang_pegawai');
      }

      function ADD_MONITORING_PIUTANG_PEGAWAI_TUNAI_LAGI(){
        $tahun = substr($this->input->post('tgl_pinjam'),0,4);
        $nez = substr($this->input->post('tgl_pinjam'),4);
        $bulan = str_replace('-','',substr($nez,0,3));
        // echo $bulan;
        // echo $bulan;
        // echo $jumuk;
        $data = array(
          'id_pelanggan' => $this->input->post('pelanggan'),
          'nominal' => $this->input->post('pokok_pinjaman'),
          'tgl_pinjam' => $this->input->post('tgl_pinjam'),
          'tgl_tempo' => $this->input->post('tgl_tempo'),
          'jangka_waktu' => $this->input->post('jangka_waktu'),
          'bulan' => $bulan,
          'tahun' => substr($this->input->post('tgl_pinjam'),0,4),
          'created' => date('Y-m-d H:i:s'),
        );
        $this->db->insert('piutang_pegawai', $data);
        redirect('buku_umum/piutang_pegawai');
      }

      function load_rincian_gaji($bln,$thn,$id){
        $data['bln'] = bulan($bln);
        $data['thn'] = $thn;
        $data['tgl'] = $thn.'-'.$bln;
        $data['id_anggota'] = $id;
        $this->load->view('user/load_rincian_gaji',$data);
      }

      function load_rincian_piutang($bln,$thn,$id){
        $data['bln'] = bulan($bln);
        $data['thn'] = $thn;
        $data['tgl'] = $thn.'-'.$bln;
        $data['id_anggota'] = $id;
        $this->load->view('user/rincian_piutang',$data);
      }
      public function piutang_uang_tunai(){
        $data['title'] = 'Buku Umum | Stikes Mart';
    		$data['operator'] = $this->m_data->where('users',['id !=','1'])->result();
    		$data['kode_transaksi'] = $this->m_data->semua('kode_transaksi2')->result();
    		// $data['piutang'] = $this->m_data->piutang_kas_anggota()->result();
    		$this->load->view('user/header',$data);
    		$this->load->view('user/buku_umum_gaji');
    		$this->load->view('user/footer');
      }
      function add_piutang_ka(){
        $data = array(
          'id_anggota' => $this->input->post('id_karyawan'),
          'tanggal_pinjam' => $this->input->post('tgl_pinjam'),
          'tanggal_jatuh_tempo' => $this->input->post('tgl_jatuh_tempo'),
          'jangka_waktu' => $this->input->post('jangka_waktu'),
          'pokok_pinjaman' => $this->input->post('pokok_pinjaman'),
        );
        $this->db->insert('piutang_kas_anggota',$data);
        redirect('buku_umum/piutang_uang_tunai');
      }
      public function tagihan_ketua_toko(){
        $data['title'] = 'Buku Umum | Stikes Mart';
    		$data['operator'] = $this->m_data->where('users',['id !=','1'])->result();
    		$data['kode_transaksi'] = $this->m_data->semua('kode_transaksi2')->result();
        $data['tagihan_toko'] = $this->m_data->semua('tagihan_ketua')->result();

     		$this->load->view('user/header',$data);
    		$this->load->view('user/penagihan_ketua_toko');
    		$this->load->view('user/footer');
      }
      public function simpanan_pokok(){
        $data['title'] = 'Buku Umum | Stikes Mart';
        $data['operator'] = $this->m_data->where('users',['id !=','1'])->result();
        $data['kode_transaksi'] = $this->m_data->semua('kode_transaksi2')->result();
        // $data['simpanan_pokok'] = $this->m_data->simpanan_pokok()->result();
        $this->load->view('user/header',$data);
        $this->load->view('user/buku_umum_simpanan_pokok');
        $this->load->view('user/footer');
      }
      public function simpanan_wajib(){
        $data['title'] = 'Buku Umum | Stikes Mart';
        $data['operator'] = $this->m_data->where('users',['id !=','1'])->result();
        $data['kode_transaksi'] = $this->m_data->semua('kode_transaksi2')->result();
        $data['tagihan_toko'] = $this->m_data->semua('tagihan_ketua')->result();
        $this->load->view('user/header',$data);
        $this->load->view('user/buku_umum_simpanan_wajib');
        $this->load->view('user/footer');
      }

      function edit_simpanan_wajib($id){
        $data = array(
          'nominal' => $this->input->post('nominal'),
        );
        $this->m_data->update_data(array('id_wajib' => $id),$data,'simpanan_wajib_wajib');
        $this->session->set_flashdata('warn','<div class="alert alert-success alert-dismissible fade in">
    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
    <strong>Success!</strong> berhasil edit simpanan wajib.
  </div>');
        redirect('buku_umum/simpanan_wajib');
      }

      function simpanan_wajib_update(){
        $pk = $this->input->post('pk');
        $nm = $this->input->post('nominal'.$pk);
        $vl = $this->input->post('value');
        $this->m_data->update_data(array('id_wajib' => $pk),array('nominal' => $vl),'simpanan_wajib_wajib');
      }

      function delete_simpanan_wajibx($id){
        $this->m_data->hapus_data(array('id_wajib' => $id),'simpanan_wajib_wajib');
        redirect('buku_umum/simpanan_wajib');
      }

      function delete_piutang_pegawai($id){
        $this->m_data->hapus_data(array('id_piutang_pegawai' => $id),'piutang_pegawai');
        redirect('buku_umum/piutang_pegawai');
      }

      function hapus_data_wajib($id){
          $this->m_data->hapus_data(array('id_wajib' => $id),'simpanan_wajib_wajib');
          redirect('buku_umum/simpanan_wajib');
      }

      function simpanan_wajib_insert($bulan,$tahun){
        $cek_pem = $this->m_data->semua('pelanggan_simpanan_pokok')->result();
        $cari_simpanan_wajib = $this->m_data->semua('simpanan_wajib')->row();
        foreach($cek_pem as $c){
          $data = array(
            'id_pelanggan' => $c->id_pelanggan,
            'nominal' => $cari_simpanan_wajib->nominal,
            'bulan' => $bulan,
            'tahun' => $tahun,
            'created2' => date('Y-m-d')
          );
          $this->db->insert('simpanan_wajib_wajib', $data);
        }
        redirect('buku_umum/simpanan_wajib');
      }

      function delete_sim_pokok($id){
        $cari_data = $this->m_data->where('simpanan_pokok',array('id_simpanan_p' => $id))->row();
        $this->m_data->hapus_data(array('id_pelanggan' => $cari_data->id_pelanggan),'pelanggan_simpanan_pokok');
        $this->m_data->hapus_data(array('id_simpanan_p' => $id),'simpanan_pokok');
        redirect('buku_umum/simpanan_pokok');
      }

      function cek_data_wajib(){
        $bulan = $this->input->post('bulan');
        $tahun = $this->input->post('tahun');
        $cek = $this->m_data->simpanan_wajibq_cek($bulan,$tahun)->num_rows();
        $cek_pem = $this->m_data->semua('pelanggan_simpanan_pokok')->num_rows();
        if($cek == $cek_pem){
          $this->session->set_flashdata('bulan',$bulan);
          $this->session->set_flashdata('tahun',$tahun);
          $this->session->set_flashdata('alert','sudah');
        }else{
          $this->session->set_flashdata('bulan',$bulan);
          $this->session->set_flashdata('tahun',$tahun);
          $this->session->set_flashdata('alert','belum');
        }
        redirect('buku_umum/simpanan_wajib');
      }

      function update_simpanan_wajib($id){
        $data = array(
          'nominal' => $this->input->post('nominal')
        );
        $this->m_data->update_data(array('id_simpanan_w' => $id),$data,'simpanan_wajib');
        $this->session->set_flashdata('alert','<div class="alert alert-success alert-dismissible fade in">
    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
    <strong>Sukses !</strong> Berhasil update Data.
  </div>');
        redirect('buku_umum/simpanan_wajib');
      }
      function add_simpanan_pokok(){
        $datax = array(
          'nama_pelanggan' => $this->input->post('nm_pegawai'),
          'status_pegawai' => $this->input->post('status'),
          'status_keanggotaan' => 'Anggota',
          'unit' => $this->input->post('unit'),
          'bulan_keanggotaan' => $this->input->post('bln_awal'),
         );
         $this->db->insert('pelanggan_simpanan_pokok',$datax);
         $cek_akhir = $this->m_data->cek_akhir('id_pelanggan','DESC','pelanggan_simpanan_pokok')->row();
        $data =array(
          'id_pelanggan' => $cek_akhir->id_pelanggan,
          'bulan_awal_keanggotaan' => $this->input->post('bln_awal'),
          'simpanan_pokok' => $this->input->post('simpanan_pokok'),
          'created' => date('Y-m-d'),
          'created2' => date('Y-m-d H:i:s'),
        );
        // $datay = array(
        //   'status_pegawai' => $this->input->post('status')
        // );
        // $this->m_data->update_data(array('kd_pembeli' => $this->input->post('id_karyawan')),$datay,'pembeli');
        $this->db->insert('simpanan_pokok',$data);
        $this->session->set_flashdata('alert','<div class="alert alert-success alert-dismissible fade in">
    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
    <strong>Sukses !</strong> Berhasil menambahkan Data.
  </div>');
        redirect('buku_umum/simpanan_pokok');
      }
      function update_simpanan_pokok_e(){
        $datax = array(
          'nama_pelanggan' => $this->input->post('nm_pegawai'),
          'status_pegawai' => $this->input->post('status'),
          'status_keanggotaan' => 'Anggota',
          'unit' => $this->input->post('unit'),
          'bulan_keanggotaan' => $this->input->post('bln_awal'),
         );
         $this->m_data->update_data(array('id_pelanggan' => $this->input->post('id_pelanggan')),$datax,'pelanggan_simpanan_pokok');
        $data =array(
          'bulan_awal_keanggotaan' => $this->input->post('bln_awal'),
          'simpanan_pokok' => $this->input->post('simpanan_pokok'),
        );
        // $datay = array(
        //   'status_pegawai' => $this->input->post('status')
        // );
        // $this->m_data->update_data(array('kd_pembeli' => $this->input->post('id_karyawan')),$datay,'pembeli');
        $this->m_data->update_data(array('id_simpanan_p' => $this->input->post('id_simpanan_p')),$data,'simpanan_pokok');
        $this->session->set_flashdata('alert','<div class="alert alert-success alert-dismissible fade in">
    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
    <strong>Sukses !</strong> Berhasil Update Data.
  </div>');
        redirect('buku_umum/simpanan_pokok');
      }
      function add_simpanan_wajib(){
        $data =array(
          'id_anggota' => $this->input->post('id_karyawan'),
          'bulan_awal_keanggotaan' => $this->input->post('bln_awal'),
          'simpanan_wajib' => $this->input->post('simpanan_pokok'),
          'created' => date('Y-m-d H:i:s'),
        );
        $this->db->insert('simpanan_pokok',$data);
        $this->session->set_flashdata('alert','<div class="alert alert-danger alert-dismissible fade in">
    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
    <strong>Sukses !</strong> Berhasil menambahkan Data.
  </div>');
        redirect('buku_umum/simpanan_wajib');
      }

      function export_rincian_gaji($tgl=null,$tgl1=null){
        (is_null($tgl)) ? $tgl = '' : $tgl = $tgl;
        (is_null($tgl1)) ? $tgl1 = '' : $tgl1 = $tgl1;
        $data['tgl'] = $tgl;
        $data['tgl1'] = $tgl1;
        $this->load->view('user/export_rincian_gaji',$data);
      }

      function print_rincian_gaji($tgl=null,$tgl1=null){
        (is_null($tgl)) ? $tgl = '' : $tgl = $tgl;
        (is_null($tgl1)) ? $tgl1 = '' : $tgl1 = $tgl1;
        $data['tgl'] = $tgl;
        $data['tgl1'] = $tgl1;
        $this->load->view('user/css_print');


        $this->load->view('user/print_rincian_gaji',$data);
      }

      function add_tagihan_ketua(){
        $user = $this->ion_auth->user()->row();
        $data = array(
          'jenis_barang' => $this->input->post('jenis_barang'),
          'jumlah' => $this->input->post('jml_barang'),
          'harga_satuan' => $this->input->post('harga_satuan'),
          'jumlah_nominal' => $this->input->post('harga_satuan') * $this->input->post('jml_barang'),
          'id_user' => $user->id,
          'created' => date('Y-m-d H:i:s'),
          'tanggal' => $this->input->post('tanggal')
        );
        $this->db->insert('tagihan_ketua',$data);
        $this->session->set_flashdata('alert','<div class="alert alert-danger alert-dismissible fade in">
    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
    <strong>Sukses !</strong> Berhasil menambahkan Data.
  </div>');
        redirect('buku_umum/tagihan_ketua_toko');
      }


      function windows_open(){
        $data['title'] = 'Buku Umum | Stikes Mart';
        $data['operator'] = $this->m_data->where('users',['id !=','1'])->result();
        $data['kode_transaksi'] = $this->m_data->where('kode_transaksi',array('status' => 'Kas Anggota'))->result();
        $this->load->view('user/header',$data);
        $this->load->view('user/windows_open');
        $this->load->view('user/footer');
      }

      function windows_open1(){
        $data['title'] = 'Buku Umum | Stikes Mart';
        $data['operator'] = $this->m_data->where('users',['id !=','1'])->result();
        $data['kode_transaksi'] = $this->m_data->where('kode_transaksi',array('status' => 'Kas Anggota'))->result();
        $this->load->view('user/header',$data);
        $this->load->view('user/windows_open1');
        $this->load->view('user/footer');
      }

      function add_simpanan_pokok1(){
        $data = array(
          'id_anggota' => $this->input->post('pegawai'),
          'tanggal_keanggotaan' => $this->input->post('tgl_anggota'),
          'simpanan_pokok' => $this->input->post('sp'),
          'created' => date('Y-m-d'),
          'created2' => date('Y-m-d H:i:s'),
         );
        $this->db->insert('simpanan_pokok',$data);
        redirect('buku_umum/windows_open1');
      }

      function search_buku_umum1($stat=null,$stat1=null,$kode=null,$op=null){
        ($stat == '0') ? $tgl='' : $tgl = $stat;
        ($stat1 == '0') ? $tgl1='' : $tgl1 = $stat1;
        ($kode == '0') ? $id='' : $id = $kode;
        ($op == '0') ? $ope='' : $ope = $op;
        $data['operator'] = $this->m_data->where('users',['id !=','1'])->result();
        $data['kode_transaksi'] = $this->m_data->where('kode_transaksi',array('status' => 'Kas Anggota'))->result();
       $data['list_buku_umum'] = $this->m_data->list_buku_umum_anggota2($tgl,$tgl1,$id,$ope)->result();
        $data['kode'] = $kode;
        // exit;
        // echo $stat;
        $this->load->view('user/load_buku_anggota_custom',$data);
      }

      function search_buku_umum($stat=null,$stat1=null,$kode=null,$op=null){
        ($stat == '0') ? $tgl='' : $tgl = $stat;
        ($stat1 == '0') ? $tgl1='' : $tgl1 = $stat1;
        ($kode == '0') ? $id='' : $id = $kode;
        ($op == '0') ? $ope='' : $ope = $op;
        $data['operator'] = $this->m_data->where('users',['id !=','1'])->result();
        $data['kode_transaksi'] = $this->m_data->where('kode_transaksi',array('status' => 'Kas Toko'))->result();
        $data['list_buku_umum'] = $this->m_data->list_buku_umum_anggota3($tgl,$tgl1,$id,$ope)->result();
        $data['kode'] = $kode;
        // echo $stat;
        $this->load->view('user/load_buku_toko_custom',$data);
      }

      function simpanan_pokok_update(){
        $pk = $this->input->post('pk');
        $nm = $this->input->post('simpanan_pokok'.$pk);
        $vl = $this->input->post('value');
        $this->m_data->update_data(array('id_simpanan_p' => $pk),array('simpanan_pokok' => $vl),'simpanan_pokok');
      }


      function nomor_urut(){
        $pk = $this->input->post('pk');
        $nm = $this->input->post('urut'.$pk);
        $vl = $this->input->post('value');
        $this->m_data->update_data(array('id_buku_umum' => $pk),array('no_urut' => $vl),'buku_umum');
      }

      function add_pukt(){
        $cari_buku_umum = $this->m_data->where('buku_umum',array('id_buku_umum' => $this->input->post('kd_transaksi')))->row();
        $cari_kode = $this->m_data->where('kode_transaksi',array('kode' => 'PPUTKT'))->row();
        $data = array(
          'kode_transaksi' => $cari_kode->kd_transaksi,
          'tanggal' => $this->input->post('tgl'),
          'keterangan' => $this->input->post('keterangan'),
          'debit' => '0',
          'kredit' => $this->input->post('nominal_pendapatan'),
          'created' => date('Y-m-d H:i:s'),
          'sumber_dana' => 'Kas Toko',
          'alat_bayar' => 'PPUTKT',
          'id_join' => $this->input->post('id_buku_umum')
        );
        $this->db->insert('buku_umum',$data);
        redirect('buku_umum/monitoring');
      }
      function add_hika(){
        $cari_buku_umum = $this->m_data->where('buku_umum',array('id_buku_umum' => $this->input->post('kd_transaksi')))->row();
        $cari_kode = $this->m_data->where('kode_transaksi',array('kode' => 'KHIKA'))->row();
        $data = array(
          'kode_transaksi' => $cari_kode->kd_transaksi,
          'tanggal' => $this->input->post('tgl'),
          'keterangan' => $this->input->post('keterangan'),
          'kredit' => '0',
          'debit' => $this->input->post('nominal_pengeluaran'),
          'created' => date('Y-m-d H:i:s'),
          'sumber_dana' => 'Kas Anggota',
          'alat_bayar' => 'KHIKA',
          'id_join' => $this->input->post('id_buku_umum')
        );
        $this->db->insert('buku_umum',$data);
        redirect('buku_umum/monitoring9');
      }

      function add_hkt(){
        $cari_buku_umum = $this->m_data->where('buku_umum',array('id_buku_umum' => $this->input->post('kd_transaksi')))->row();
        $cari_kode = $this->m_data->where('kode_transaksi',array('kode' => 'KHKT'))->row();
        $data = array(
          'kode_transaksi' => $cari_kode->kd_transaksi,
          'tanggal' => $this->input->post('tgl'),
          'keterangan' => $this->input->post('keterangan'),
          'kredit' => '0',
          'debit' => $this->input->post('nominal_pendapatan'),
          'created' => date('Y-m-d H:i:s'),
          'sumber_dana' => 'Kas Toko',
          'alat_bayar' => 'KHKT',
          'id_join' => $this->input->post('id_buku_umum')
        );
        $this->db->insert('buku_umum',$data);
        redirect('buku_umum/monitoring2');
      }
      function add_pikt(){
        $cari_buku_umum = $this->m_data->where('buku_umum',array('id_buku_umum' => $this->input->post('kd_transaksi')))->row();
        $cari_kode = $this->m_data->where('kode_transaksi',array('kode' => 'KHIKA'))->row();
        $cari_kode1 = $this->m_data->where('kode_transaksi',array('kode' => 'PPIKT'))->row();
        $data = array(
          'kode_transaksi' => $cari_kode->kd_transaksi,
          'tanggal' => $this->input->post('tgl'),
          'keterangan' => $this->input->post('keterangan'),
          'kredit' => '0',
          'debit' => $this->input->post('nominal_pendapatan'),
          'created' => date('Y-m-d H:i:s'),
          'sumber_dana' => 'Kas Anggota',
          'alat_bayar' => 'KHIKA',
          'id_join' => $this->input->post('id_buku_umum')
        );
        $data1 = array(
          'kode_transaksi' => $cari_kode1->kd_transaksi,
          'tanggal' => $this->input->post('tgl'),
          'keterangan' => $this->input->post('keterangan'),
          'kredit' => '0',
          'debit' => $this->input->post('nominal_pendapatan'),
          'created' => date('Y-m-d H:i:s'),
          'sumber_dana' => 'Kas Toko',
          'alat_bayar' => 'PPIKT',
          'id_join' => $this->input->post('id_buku_umum')
        );
        $this->db->insert('buku_umum',$data);
        $this->db->insert('buku_umum',$data1);
        redirect('buku_umum/monitoring3');
      }

      function add_hikt(){
        $cari_buku_umum = $this->m_data->where('buku_umum',array('id_buku_umum' => $this->input->post('kd_transaksi')))->row();
        $cari_kode = $this->m_data->where('kode_transaksi',array('kode' => 'KHIKT'))->row();
        $data = array(
          'kode_transaksi' => $cari_kode->kd_transaksi,
          'tanggal' => $this->input->post('tgl'),
          'keterangan' => $this->input->post('keterangan'),
          'kredit' => '0',
          'debit' => $this->input->post('nominal_pendapatan'),
          'created' => date('Y-m-d H:i:s'),
          'sumber_dana' => 'Kas Anggota',
          'alat_bayar' => 'KHIKT',
          'id_join' => $this->input->post('id_buku_umum')
        );
        $this->db->insert('buku_umum',$data);
        redirect('buku_umum/monitoring4');
      }

      function update_pukt(){
        $data = array(
          'tanggal' => $this->input->post('tgl'),
          'keterangan' => $this->input->post('keterangan'),
          'kredit' => $this->input->post('nominal_pendapatan'),

        );
        $this->m_data->update_data(array('id_buku_umum' => $this->input->post('book_um')),$data,'buku_umum');
        redirect('buku_umum/monitoring');
      }
      function update_hikt(){
        $data = array(
          'tanggal' => $this->input->post('tgl'),
          'keterangan' => $this->input->post('keterangan'),
          'kredit' => $this->input->post('nominal_pendapatan'),

        );
        $this->m_data->update_data(array('id_buku_umum' => $this->input->post('book_um')),$data,'buku_umum');
        redirect('buku_umum/monitoring4');
      }
      function update_pikt(){
        $data = array(
          'tanggal' => $this->input->post('tgl'),
          'keterangan' => $this->input->post('keterangan'),
          'kredit' => $this->input->post('nominal_pendapatan'),

        );
        $this->m_data->update_data(array('id_buku_umum' => $this->input->post('book_um')),$data,'buku_umum');
        $this->m_data->update_data(array('id_buku_umum' => $this->input->post('book_um1')),$data,'buku_umum');
        redirect('buku_umum/monitoring3');
      }
      function update_hkt(){
        $data = array(
          // 'kode_transaksi' => $cari_kode->kd_transaksi,
          'tanggal' => $this->input->post('tgl'),
          'keterangan' => $this->input->post('keterangan'),
          // 'debit' => '0',
          'debit' => $this->input->post('nominal_pendapatan'),
          // 'created' => date('Y-m-d H:i:s'),
          // 'sumber_dana' => 'Kas Toko',
          // 'alat_bayar' => 'PPUTKT',
          // 'id_join' => $this->input->post('id_buku_umum')
        );
        $this->m_data->update_data(array('id_buku_umum' => $this->input->post('book_um')),$data,'buku_umum');
        redirect('buku_umum/monitoring2');
      }

      function update_hika(){
        $data = array(
          // 'kode_transaksi' => $cari_kode->kd_transaksi,
          'tanggal' => $this->input->post('tgl'),
          'keterangan' => $this->input->post('keterangan'),
          // 'debit' => '0',
          'debit' => $this->input->post('nominal_pengeluaran'),
          // 'created' => date('Y-m-d H:i:s'),
          // 'sumber_dana' => 'Kas Toko',
          // 'alat_bayar' => 'PPUTKT',
          // 'id_join' => $this->input->post('id_buku_umum')
        );
        $this->m_data->update_data(array('id_buku_umum' => $this->input->post('book_um')),$data,'buku_umum');
        redirect('buku_umum/monitoring9');
      }

      public function monitoring2(){
        $data['title'] = 'Buku Umum Monitoring | Stikes Mart';
        $data['operator'] = $this->m_data->where('users',['id !=','1'])->result();
        $data['kode_transaksi'] = $this->m_data->semua('kode_transaksi2')->result();

        $data['posts'] = $this->m_data->monitoringhkt(array('limit'=>$this->perPage));
        $data['debitqq'] = $this->m_data->ttl_buku_toko23('','','KHKT','','debit');
        $data['kreditq'] = $this->m_data->ttl_buku_toko2('','','HKT','','kredit')->row();

        $this->load->view('user/header',$data);
        $this->load->view('user/buku_umum_monitor2');
        $this->load->view('user/footer');
      }

      public function monitoring3(){
        $data['title'] = 'Buku Umum Monitoring | Stikes Mart';
        $data['operator'] = $this->m_data->where('users',['id !=','1'])->result();
        $data['kode_transaksi'] = $this->m_data->semua('kode_transaksi2')->result();

        $data['posts'] = $this->m_data->monitoringpikt();
        $data['debitqq'] = $this->m_data->ttl_buku_toko23('','','KHKT','','debit');
        $data['kreditq'] = $this->m_data->ttl_buku_toko2('','','HKT','','kredit')->row();

        $this->load->view('user/header',$data);
        $this->load->view('user/buku_umum_monitoring3');
        $this->load->view('user/footer');
      }

      public function monitoring4(){
        $data['title'] = 'Buku Umum Monitoring | Stikes Mart';
        $data['operator'] = $this->m_data->where('users',['id !=','1'])->result();
        $data['kode_transaksi'] = $this->m_data->semua('kode_transaksi2')->result();

        $data['posts'] = $this->m_data->monitoringhikt();
        $data['debitqq'] = $this->m_data->ttl_buku_toko23('','','KHIKT','','debit');
        $data['kreditq'] = $this->m_data->ttl_buku_toko2('','','hikt','','kredit')->row();

        $this->load->view('user/header',$data);
        $this->load->view('user/buku_umum_monitor4');
        $this->load->view('user/footer');
      }

      function add_putka(){
        $cari_buku_umum = $this->m_data->where('buku_umum',array('id_buku_umum' => $this->input->post('kd_transaksi')))->row();
        $cari_kode = $this->m_data->where('kode_transaksi',array('kode' => 'PPUTKA'))->row();
        $data = array(
          'kode_transaksi' => $cari_kode->kd_transaksi,
          'tanggal' => $this->input->post('tgl'),
          'keterangan' => $this->input->post('keterangan'),
          'debit' => '0',
          'kredit' => $this->input->post('nominal_pendapatan'),
          'created' => date('Y-m-d H:i:s'),
          'sumber_dana' => 'Kas Anggota',
          'alat_bayar' => 'PPUTKA',
          'id_join' => $this->input->post('id_buku_umum')
        );
        $this->db->insert('buku_umum', $data);
        redirect("buku_umum/monitoring6");
      }

      function add_pika(){
        $cari_buku_umum = $this->m_data->where('buku_umum',array('id_buku_umum' => $this->input->post('kd_transaksi')))->row();
        $cari_kode = $this->m_data->where('kode_transaksi',array('kode' => 'PPIKA'))->row();
        $data = array(
          'kode_transaksi' => $cari_kode->kd_transaksi,
          'tanggal' => $this->input->post('tgl'),
          'keterangan' => $this->input->post('keterangan'),
          'debit' => '0',
          'id_user' => '1',
          'kredit' => $this->input->post('nominal_pendapatan'),
          'created' => date('Y-m-d H:i:s'),
          'sumber_dana' => 'Kas Anggota',
          'alat_bayar' => 'PPIKA',
          'id_join' => $this->input->post('id_buku_umum')
        );
        $datay = array(
          'kredit' => $this->input->post('nominal_pendapatan'),
        );
        $this->m_data->update_data(array('id_buku_umum' => $this->input->post('id_buku_umum')),$datay,'buku_umum');
        $this->db->insert('buku_umum', $data);
        redirect("buku_umum/monitoring8");
      }

      function add_hka(){
        $cari_buku_umum = $this->m_data->where('buku_umum',array('id_buku_umum' => $this->input->post('kd_transaksi')))->row();
        $cari_kode = $this->m_data->where('kode_transaksi',array('kode' => 'PHKA'))->row();
        $data = array(
          'kode_transaksi' => $cari_kode->kd_transaksi,
          'tanggal' => $this->input->post('tgl'),
          'keterangan' => $this->input->post('keterangan'),
          'kredit' => '0',
          'debit' => $this->input->post('nominal_pengeluaran'),
          'created' => date('Y-m-d H:i:s'),
          'sumber_dana' => 'Kas Anggota',
          'alat_bayar' => 'PHKA',
          'id_join' => $this->input->post('id_buku_umum')
        );
        $this->db->insert('buku_umum', $data);
        redirect("buku_umum/monitoring7");
      }


      function update_putka(){
        $data = array(
          'kredit' => $this->input->post('nominal_pendapatan'),
          'keterangan' => $this->input->post('keterangan')
        );
        $this->m_data->update_data(array('id_buku_umum' => $this->input->post('book_um')),$data,'buku_umum');
        redirect("buku_umum/monitoring6");
      }

      function update_pika(){
        $data = array(
          'kredit' => $this->input->post('nominal_pendapatan'),
          'keterangan' => $this->input->post('keterangan')
        );
        $datay = array(
          'kredit' => $this->input->post('nominal_pendapatan')
        );
        $this->m_data->update_data(array('id_buku_umum' => $this->input->post('book_um1')),$datay,'buku_umum');
        $this->m_data->update_data(array('id_buku_umum' => $this->input->post('book_um')),$data,'buku_umum');
        redirect("buku_umum/monitoring8");
      }

      function update_hka(){
        $data = array(
          'debit' => $this->input->post('nominal_pengeluaran'),
          'keterangan' => $this->input->post('keterangan')
        );
        $this->m_data->update_data(array('id_buku_umum' => $this->input->post('book_um')),$data,'buku_umum');
        redirect("buku_umum/monitoring7");
      }

      public function monitoring6(){
        $data['title'] = 'Buku Umum Monitoring | Stikes Mart';
        $data['operator'] = $this->m_data->where('users',['id !=','1'])->result();
        $data['kode_transaksi'] = $this->m_data->semua('kode_transaksi2')->result();

        $data['posts'] = $this->m_data->monitoringputka();
        $data['debitqq'] = $this->m_data->ttl_buku_toko23('','','KHIKT','','debit');
        $data['kreditq'] = $this->m_data->ttl_buku_toko2('','','hikt','','kredit')->row();

        $this->load->view('user/header',$data);
        $this->load->view('user/buku_umum_monitor6');
        $this->load->view('user/footer');
      }

      public function monitoring7(){
        $data['title'] = 'Buku Umum Monitoring | Stikes Mart';
        $data['operator'] = $this->m_data->where('users',['id !=','1'])->result();
        $data['kode_transaksi'] = $this->m_data->semua('kode_transaksi2')->result();

        $data['posts'] = $this->m_data->monitoringhka();
        $data['debitqq'] = $this->m_data->ttl_buku_toko23('','','KHIKT','','debit');
        $data['kreditq'] = $this->m_data->ttl_buku_toko2('','','hikt','','kredit')->row();

        $this->load->view('user/header',$data);
        $this->load->view('user/buku_umum_monitoring7');
        $this->load->view('user/footer');
      }

      public function monitoring8(){
        $data['title'] = 'Buku Umum Monitoring | Stikes Mart';
        $data['operator'] = $this->m_data->where('users',['id !=','1'])->result();
        $data['kode_transaksi'] = $this->m_data->semua('kode_transaksi2')->result();

        $data['posts'] = $this->m_data->monitoringpika();

        $this->load->view('user/header',$data);
        $this->load->view('user/buku_umum_monitor8');
        $this->load->view('user/footer');
      }

      public function monitoring9(){
        $data['title'] = 'Buku Umum Monitoring | Stikes Mart';
        $data['operator'] = $this->m_data->where('users',['id !=','1'])->result();
        $data['kode_transaksi'] = $this->m_data->semua('kode_transaksi2')->result();

        $data['posts'] = $this->m_data->monitoringhika();

        $this->load->view('user/header',$data);
        $this->load->view('user/buku_umum_monitor9');
        $this->load->view('user/footer');
      }

      public function monitoring5(){
        $data['title'] = 'Buku Umum Monitoring | Stikes Mart';
        $data['operator'] = $this->m_data->where('users',['id !=','1'])->result();
        $data['kode_transaksi'] = $this->m_data->semua('kode_transaksi2')->result();

        $data['posts'] = $this->m_data->monitoringpptkt2();
        $data['debitqq'] = $this->m_data->ttl_buku_toko23('','','KHIKT','','debit');
        $data['kreditq'] = $this->m_data->ttl_buku_toko2('','','hikt','','kredit')->row();

        $this->load->view('user/header',$data);
        $this->load->view('user/buku_umum_monitor5');
        $this->load->view('user/footer');
      }

      function bayar_pelunasan($id){
        $data = array(
          'id_hutang' => $id,
          'keterangan' => $this->input->post('keterangan'),
          'bayar' => $this->input->post('nominal'),
          'tanggal_pembayaran' => $this->input->post('tgl_pembayaran')." ".date("H:i:s"),
        );
        $cari_kode = $this->m_data->where('kode_transaksi',array('kode' => 'PPTKT'))->row();
        $cek_buku_umum = $this->m_data->ordernya1('id_buku_umum','DESC','buku_umum')->row();
        $datax = array(
          'kode_transaksi' => $cari_kode->kd_transaksi,
          'tanggal' => $this->input->post('tgl_pembayaran'),
          'keterangan' => $this->input->post('keterangan'),
          'kredit' => $this->input->post('nominal'),
          'created' => date('Y-m-d H:i:s'),
          'id_user' => '1',
          'debit' => '0',
          'sumber_dana' => $cari_kode->status,
          'alat_bayar' => 'Kas di Bendahara Toko',
          'no_urut' => $cek_buku_umum->no_urut
        );
        $this->db->insert('join_hutang_penjualan',$data);
        $this->db->insert('buku_umum',$datax);
        redirect("buku_umum/monitoring5");
      }

      public function monitoring(){
        $data['title'] = 'Buku Umum Monitoring | Stikes Mart';
        $data['operator'] = $this->m_data->where('users',['id !=','1'])->result();
        $data['kode_transaksi'] = $this->m_data->semua('kode_transaksi2')->result();
        // $data = array();
        //total rows count

        // $totalRec = count($this->m_data->getRowsQY());

        //pagination configuration
        // $config['target']      = '.postList';
        // $config['base_url']    = base_url().'buku_umum/ajaxPaginationData1';
        // $config['total_rows']  = $totalRec;
        // $config['per_page']    = $this->perPage;
        // $config['link_func']   = 'searchFilter';
        // $this->ajax_pagination->initialize($config);

        //get the posts data
        $data['posts'] = $this->m_data->monitoringpukt(array('limit'=>$this->perPage));
        $data['debitq'] = $this->m_data->ttl_buku_toko2('','','PUTKT','','debit')->row();
        $data['kreditqq'] = $this->m_data->ttl_buku_toko23('','','PUTKT','','kredit');

// exit;
        $this->load->view('user/header',$data);
        $this->load->view('user/buku_umum_monitor');
        $this->load->view('user/footer');
      }
      public function general_book(){
        $dataku['title'] = 'Buku Umum | Stikes Mart';
        $dataku['operator'] = $this->m_data->where('users',['id !=','1'])->result();
        $data = array();
        //total rows count

        $totalRec = count($this->m_data->getRowsF());

        //pagination configuration
        $config['target']      = '.postList';
        $config['base_url']    = base_url().'buku_umum/ajaxPaginationData1';
        $config['total_rows']  = $totalRec;
        $config['per_page']    = $this->perPage;
        $config['link_func']   = 'searchFilter';
        $this->ajax_pagination->initialize($config);

        //get the posts data
        $data['posts'] = $this->m_data->getRowsF(array('limit'=>$this->perPage));
        $data['kode_transaksi'] = $this->m_data->where('kode_transaksi',array('status' => 'Kas Toko'))->result();
        $data['list_buku_umum'] = $this->m_data->list_buku_umum_anggota3('','','')->result();
        $data['debitq'] = $this->m_data->ttl_buku_toko2('','','','','debit')->row();
        $data['kreditq'] = $this->m_data->ttl_buku_toko2('','','','','kredit')->row();
        $this->load->view('user/header',$dataku);
        $this->load->view('user/buku_umum3',$data);
        $this->load->view('user/footer');
      }

      public function home(){
        $dataku['title'] = 'Buku Umum | Stikes Mart';
        $dataku['operator'] = $this->m_data->where('users',['id !=','1'])->result();
        $dataku['kode_transaksi'] = $this->m_data->where('kode_transaksi',array('status' => 'Kas Anggota'))->result();
        $data = array();
        //total rows count

        $totalRec = count($this->m_data->getRowsQ());

        //pagination configuration
        $config['target']      = '.postList';
        $config['base_url']    = base_url().'buku_umum/ajaxPaginationData2';
        $config['total_rows']  = $totalRec;
        $config['per_page']    = $this->perPage;
        $config['link_func']   = 'searchFilter';
        $this->ajax_pagination->initialize($config);

        //get the posts data
        $data['posts'] = $this->m_data->getRowsQ(array('limit'=>$this->perPage));
        $data['kode_transaksi'] = $this->m_data->where('kode_transaksi',array('status' => 'Kas Anggota'))->result();
        $data['list_buku_umum'] = $this->m_data->list_buku_umum_anggota2()->result();
        $data['debitq'] = $this->m_data->ttl_buku_anggota2('','','','','debit')->row();
        $data['kreditq'] = $this->m_data->ttl_buku_anggota2('','','','','kredit')->row();

        $this->load->view('user/header',$dataku);
        $this->load->view('user/buku_umum',$data);
        $this->load->view('user/footer');
      }

      function ajaxPaginationData2(){
        $conditions = array();
           //calc offset number
           $page = $this->input->post('page');
           if(!$page){
               $offset = 0;
           }else{
               $offset = $page;
           }
           //set conditions for search
           $keywords = $this->input->post('keywords');
           $sortBy = $this->input->post('sortBy');
           $start_tgl = $this->input->post('start_tgl');
           $end_tgl = $this->input->post('end_tgl');
           $filter = $this->input->post('filter');
           if(!empty($keywords)){
               $conditions['search']['keywords'] = $keywords;
           }

           if(!empty($sortBy)){
               $conditions['search']['sortBy'] = $sortBy;
           }

           if(!empty($start_tgl)){
               $conditions['search']['start_tgl'] = $start_tgl;
               $data['tgl'] = $start_tgl;
           }else{
              $data['tgl'] = null;
           }

           if(!empty($end_tgl)){
               $conditions['search']['end_tgl'] = $end_tgl;
               $data['tgl1'] = $end_tgl;
           }else{
             $data['tgl1']=null;
           }

           if(!empty($filter)){
               $conditions['search']['filter'] = $filter;
               $data['kd']= $filter;
           }else{
             $data['kd'] = null;
           }
           //total rows count
           $totalRec = count($this->m_data->getRowsQ($conditions));
           //pagination configuration
           $config['target']      = '.postList';
           $config['base_url']    = base_url().'buku_umum/ajaxPaginationData2';
           $config['total_rows']  = $totalRec;
           $config['per_page']    = $this->perPage;
           $config['link_func']   = 'searchFilter';
           $this->ajax_pagination->initialize($config);
           //set start and limit
           $conditions['start'] = $offset;
           $conditions['limit'] = $this->perPage;
           //get posts data
           $data['postsq'] = $this->m_data->getRowsQ($conditions);
           $data['postsC'] = $this->m_data->getRowsQ2($conditions);
           $data['kode_transaksi'] = $this->m_data->where('kode_transaksi',array('status' => 'Kas Anggota'))->result();
           $data['debitq'] = $this->m_data->ttl_buku_anggota2($data['tgl'],$data['tgl1'],$data['kd'],'','debit')->row();
           $data['kreditq'] = $this->m_data->ttl_buku_anggota2($data['tgl'],$data['tgl1'],$data['kd'],'','kredit')->row();
           // $data['debitq'] = $this->m_data->ttl_buku_toko2('','','','','debit')->row();
           // $data['kreditq'] = $this->m_data->ttl_buku_toko2('','','','','kredit')->row();
           //load the view
           $this->load->view('user/pagination_book_anggota', $data, false);
      }

      function ajaxPaginationData1(){
        $conditions = array();
           //calc offset number
           $page = $this->input->post('page');
           if(!$page){
               $offset = 0;
           }else{
               $offset = $page;
           }
           //set conditions for search
           $keywords = $this->input->post('keywords');
           $sortBy = $this->input->post('sortBy');
           $start_tgl = $this->input->post('start_tgl');
           $end_tgl = $this->input->post('end_tgl');
           $filter = $this->input->post('filter');
           if(!empty($keywords)){
               $conditions['search']['keywords'] = $keywords;
           }

           if(!empty($sortBy)){
               $conditions['search']['sortBy'] = $sortBy;
           }

           if(!empty($start_tgl)){
               $conditions['search']['start_tgl'] = $start_tgl;
               $data['tgl'] = $start_tgl;
           }else{
              $data['tgl'] = null;
           }

           if(!empty($end_tgl)){
               $conditions['search']['end_tgl'] = $end_tgl;
               $data['tgl1'] = $end_tgl;
           }else{
             $data['tgl1']=null;
           }

           if(!empty($filter)){
               $conditions['search']['filter'] = $filter;
               $data['kd']= $filter;
           }else{
             $data['kd'] = null;
           }
           //total rows count
           $totalRec = count($this->m_data->getRowsF($conditions));
           //pagination configuration
           $config['target']      = '.postList';
           $config['base_url']    = base_url().'buku_umum/ajaxPaginationData1';
           $config['total_rows']  = $totalRec;
           $config['per_page']    = $this->perPage;
           $config['link_func']   = 'searchFilter';
           $this->ajax_pagination->initialize($config);
           //set start and limit
           $conditions['start'] = $offset;
           $conditions['limit'] = $this->perPage;
           //get posts data
           $data['postsq'] = $this->m_data->getRowsF($conditions);
           $data['postsC'] = $this->m_data->getRowsF2($conditions);
           $data['kode_transaksi'] = $this->m_data->where('kode_transaksi',array('status' => 'Kas Toko'))->result();
           $data['debitq'] = $this->m_data->ttl_buku_toko2($data['tgl'],$data['tgl1'],$data['kd'],'','debit')->row();
           $data['kreditq'] = $this->m_data->ttl_buku_toko2($data['tgl'],$data['tgl1'],$data['kd'],'','kredit')->row();
           // $data['debitq'] = $this->m_data->ttl_buku_toko2('','','','','debit')->row();
           // $data['kreditq'] = $this->m_data->ttl_buku_toko2('','','','','kredit')->row();
           //load the view
           $this->load->view('user/pagination_user_book_toko', $data, false);
      }

      function export_buku_umum3($stat=null,$stat1=null,$idne=null,$opo1=null){
          (is_null($stat)) ? $tgl='' : $tgl = $stat;
          (is_null($stat1)) ? $tgl1='' : $tgl1 = $stat1;
          (is_null($idne)) ? $id='' : $id = $idne;
          (is_null($opo1)) ? $opo1='' : $opo1 = $opo1;

        header("Content-type: application/vnd-ms-excel");
        header("Content-Disposition: attachment; filename=Buku_Bank_kas_umum_toko.xls");

        // header("Pragma: no-cache");
        header("Expires: 0");
        header("Pragma: ");
        header("Cache-Control: ");
        $list_buku_umum = $this->m_data->list_buku_umum_anggota2($tgl,$tgl1,$id,$opo1)->result();
        $debitq = $this->m_data->ttl_buku_anggota2($tgl,$tgl1,$id,'','debit')->row();
        $kreditq = $this->m_data->ttl_buku_anggota2($tgl,$tgl1,$id,'','kredit')->row();
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
              <th>Tanggal</th>
              <th>Kode</th>
              <th>Uraian Kode</th>
              <th>Keterangan</th>
              <th>Pemasukan</th>
              <th>Pengeluaran</th>
              <th>Hasil</th>
              <th>Saldo</th>
            </tr>
          </thead>
          <tbody>
        ';
        $no=0;
        $sal=0;
        foreach($list_buku_umum as $l):
        $no++;
        echo '
        <tr>
          <td>'.$no.'</td>
          <td>'.date('d-m-Y',strtotime($l->tanggal)).'</td>
          <td>'.$l->kode.'</td>
          <td>'.$l->uraian_kode.'</td>
          <td>'.$l->keterangan.'</td>
          <td>Rp '.number_format($l->kredit,2).'</td>
          <td>Rp '.number_format($l->debit,2).'</td> ';
          $salq =  $l->kredit - $l->debit;
          echo '
          <td>Rp '.number_format($salq,2).'</td>
          <td>Rp ';
          if($no==1){
             $sal=$salq;
          }else{
        $sal = $salq + $sal ;
          }
          echo number_format($sal,2);

           echo '
           </td>
          </tr>
           ';

        endforeach;
        echo '
        <tr>
          <td colspan="5"><b>Total</b></td>
          <td>Rp '.number_format($kreditq->total,2).'</td>
          <td>Rp  '.number_format($debitq->total,2).'</td>
          <td colspan="2">Rp '.number_format($kreditq->total - $debitq->total,2).' </td>
        </tr>
        </tbody>
      </table>
      </body>
      </html>
        ';
      }

      function export_buku_umum($stat=null,$stat1=null,$idne=null,$opo1=null){
      		(is_null($stat)) ? $tgl='' : $tgl = $stat;
      		(is_null($stat1)) ? $tgl1='' : $tgl1 = $stat1;
      		(is_null($idne)) ? $id='' : $id = $idne;
          (is_null($opo1)) ? $opo1='' : $opo1 = $opo1;

        header("Content-type: application/vnd-ms-excel");
        header("Content-Disposition: attachment; filename=Buku_Bank_kas_umum_toko.xls");

        // header("Pragma: no-cache");
        header("Expires: 0");
        header("Pragma: ");
        header("Cache-Control: ");
        $list_buku_umum = $this->m_data->list_buku_umum_anggota3($tgl,$tgl1,$id,$opo1)->result();
        $debitq = $this->m_data->ttl_buku_toko2($tgl,$tgl1,$id,'','debit')->row();
        $kreditq = $this->m_data->ttl_buku_toko2($tgl,$tgl1,$id,'','kredit')->row();
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
              <th>Tanggal</th>
              <th>Kode</th>
              <th>Uraian Kode</th>
              <th>Keterangan</th>
              <th>Pemasukan</th>
              <th>Pengeluaran</th>
              <th>Hasil</th>
              <th>Saldo</th>
            </tr>
          </thead>
          <tbody>
        ';
        $no=0;
        $sal=0;
        foreach($list_buku_umum as $l):
        $no++;
        echo '
        <tr>
          <td>'.$no.'</td>
          <td>'.date('d-m-Y',strtotime($l->tanggal)).'</td>
          <td>'.$l->kode.'</td>
          <td>'.$l->uraian_kode.'</td>
          <td>'.$l->keterangan.'</td>
          <td>Rp '.number_format($l->kredit,2).'</td>
          <td>Rp '.number_format($l->debit,2).'</td> ';
          $salq =  $l->kredit - $l->debit;
          echo '
          <td>Rp '.number_format($salq,2).'</td>
          <td>Rp ';
          if($no==1){
             $sal=$salq;
          }else{
        $sal = $salq + $sal ;
          }
          echo number_format($sal,2);

           echo '
           </td>
          </tr>
           ';

        endforeach;
        echo '
        <tr>
          <td colspan="5"><b>Total</b></td>
          <td>Rp '.number_format($kreditq->total,2).'</td>
          <td>Rp  '.number_format($debitq->total,2).'</td>
          <td colspan="2">Rp '.number_format($kreditq->total - $debitq->total,2).' </td>
        </tr>
        </tbody>
      </table>
      </body>
      </html>
        ';
      }



      function add_buku_umum(){
        $user = $this->ion_auth->user()->row();
        $rx = $this->m_data->ordernyaq('no_urut','desc','buku_umum','Kas Toko')->row();
        $no_urut = $rx->no_urut + 1;
        $data = array(
          'kode_transaksi' => $this->input->post('kd_transaksi'),
          'tanggal' => $this->input->post('tanggal'),
          'keterangan' => $this->input->post('uraian'),
          'debit' => (empty($this->input->post('debet'))) ? '0' : str_replace(' ','',$this->input->post('debet')),
          'kredit' => (empty($this->input->post('kredit'))) ? '0' : str_replace(' ','',$this->input->post('kredit')),
          'created' => date("Y-m-d H:i:s"),
          'alat_bayar' => $this->input->post('alat'),
          'sumber_dana' => 'Kas Toko',
          'id_user' => $user->id,
          'no_urut' => $no_urut
         );
         $this->db->insert('buku_umum',$data);
         $this->session->set_flashdata('alert','<div class="alert alert-success alert-dismissible fade in">
    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
    <strong>Success!</strong> Data Berhasil Masuk.
  </div>');
         redirect('buku_umum/general_book');
      }

      function delete_umumk($id){
        $this->m_data->hapus_data(array('id_buku_umum' => $id),'buku_umum');
        $this->session->set_flashdata('alert','<div class="alert alert-success alert-dismissible fade in">
   <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
   <strong>Success!</strong> Berhasil Menghapus Data.
 </div>');
        redirect('buku_umum/home/all');
      }

      function delete_umumq($id){
        $this->m_data->hapus_data(array('id_buku_umum' => $id),'buku_umum');
        $this->session->set_flashdata('alert','<div class="alert alert-success alert-dismissible fade in">
   <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
   <strong>Success!</strong> Berhasil Menghapus Data.
 </div>');
        redirect('buku_umum/general_book');
      }

      function cek_coy(){
      $rx = $this->m_data->ordernyaq('no_urut','desc','buku_umum','Kas Toko')->row();
      echo $rx->no_urut+1;
      }

      function tambah_data_pengembalian_duit($id){
        $user = $this->ion_auth->user()->row();
        $rx = $this->m_data->ordernyaq('no_urut','desc','buku_umum','Kas Anggota')->row();
        $no_urut = $rx->no_urut + 1;
        $kode_transaksi = $this->m_data->where('kode_transaksi',array('kode' => $this->input->post('kd_transaksi')))->row();
        $data = array(
          'kode_transaksi' => $kode_transaksi->kd_transaksi,
          'tanggal' => $this->input->post('tanggal'),
          'keterangan' => $this->input->post('keterangan'),
          'debit' => (empty($this->input->post('nominal_pengeluaran'))) ? '0' : str_replace(' ','',$this->input->post('nominal_pengeluaran')),
          'created' => date("Y-m-d H:i:s"),
          'alat_bayar' => $this->input->post('alat'),
          'sumber_dana' => 'Kas Anggota',
          'id_user' => $user->id,
          'no_urut' => $no_urut,
          'id_simpanan_pokok' => $id
         );
         $this->db->insert('buku_umum',$data);
         $this->session->set_flashdata('alert','<div class="alert alert-success alert-dismissible fade in">
    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
    <strong>Success!</strong> Data Berhasil Masuk.
  </div>');
  redirect('buku_umum/simpanan_pokok');
      }

      function load_y($awal,$akhir,$nominal){
        // $total_bulan = 0;
        $total = 0;
        for ($i=$awal; $i <= $akhir ; $i++) {
          // $total_bulan += $i;
          $total += $nominal;
        }
        // $total = $nominal * $total_bulan;
        $data['total'] = $total;
        $this->load->view('user/load_hitung_wjb',$data);
      }

      function add_SIMPANAN_WAJIB_LAGI(){
        $awal = $this->input->post('awal_bulan');
        $akhir = $this->input->post('akhir_bulan');
        $total = 0;
        for ($i=$awal; $i <= $akhir ; $i++) {
          // $total_bulan += $i;
          // $total += $this->input->post('nominal');
          $data = array(
            'id_pelanggan' => $this->input->post('pelanggan'),
            'nominal' => $this->input->post('nominal'),
            'bulan' => (strlen($i) == 1) ? '0'.$i : $i,
            'tahun' => $this->input->post('tahun'),
            'created2' => date('Y-m-d'),
          );
          $this->db->insert('simpanan_wajib_wajib', $data);
        }
        redirect('buku_umum/simpanan_wajib');
      }

      function tambah_data_pengembalian_duit_neh($id){
        $user = $this->ion_auth->user()->row();
        $rx = $this->m_data->ordernyaq('no_urut','desc','buku_umum','Kas Anggota')->row();
        $no_urut = $rx->no_urut + 1;
        $kode_transaksi = $this->m_data->where('kode_transaksi',array('kode' => $this->input->post('kd_transaksi')))->row();
        $data = array(
          'kode_transaksi' => $kode_transaksi->kd_transaksi,
          'tanggal' => $this->input->post('tanggal'),
          'keterangan' => $this->input->post('keterangan'),
          'debit' => (empty($this->input->post('nominal_pengeluaran'))) ? '0' : str_replace(' ','',$this->input->post('nominal_pengeluaran')),
          'created' => date("Y-m-d H:i:s"),
          'alat_bayar' => $this->input->post('alat'),
          'sumber_dana' => 'Kas Anggota',
          'id_user' => $user->id,
          'no_urut' => $no_urut,
          'id_simpanan_wajib' => $id
         );
         $this->db->insert('buku_umum',$data);
         $this->session->set_flashdata('alert','<div class="alert alert-success alert-dismissible fade in">
    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
    <strong>Success!</strong> Data Berhasil Masuk.
  </div>');
  redirect('buku_umum/simpanan_wajib');
      }

      function add_buku_umum2(){
        $user = $this->ion_auth->user()->row();
        $rx = $this->m_data->ordernyaq('no_urut','desc','buku_umum','Kas Anggota')->row();
        $no_urut = $rx->no_urut + 1;
        $data = array(
          'kode_transaksi' => $this->input->post('kd_transaksi'),
          'tanggal' => $this->input->post('tanggal'),
          'keterangan' => $this->input->post('uraian'),
          'debit' => (empty($this->input->post('debet'))) ? '0' : str_replace(' ','',$this->input->post('debet')),
          'kredit' => (empty($this->input->post('kredit'))) ? '0' : str_replace(' ','',$this->input->post('debet')),
          'created' => date("Y-m-d H:i:s"),
          'alat_bayar' => $this->input->post('alat'),
          'sumber_dana' => 'Kas Anggota',
          'id_user' => $user->id,
          'no_urut' => $no_urut,
         );
         $this->db->insert('buku_umum',$data);
         $this->session->set_flashdata('alert','<div class="alert alert-success alert-dismissible fade in">
    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
    <strong>Success!</strong> Data Berhasil Masuk.
  </div>');
         redirect('buku_umum/home/all');
      }

      function update_buku_umum($id){
        $dataArr = [
          'kode_transaksi' => $this->input->post('kd_transaksi'),
          'tanggal' => $this->input->post('tanggal'),
          'keterangan' => $this->input->post('uraian'),
          'debit' => (empty($this->input->post('debet'))) ? '0' : $this->input->post('debet'),
          'kredit' => (empty($this->input->post('kredit'))) ? '0' : $this->input->post('kredit'),
          'alat_bayar' => $this->input->post('alat'),
        ];
        $this->m_data->update_data(array('id_buku_umum' => $id),$dataArr,'buku_umum');
        $this->session->set_flashdata('alert','<div class="alert alert-success alert-dismissible">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                    <h4><i class="icon fa fa-check"></i> Berhasil Update Buku Umum</h4>

                  </div>');
        redirect('buku_umum/general_book');
      }
      function update_buku_umum22(){
        $dataArr = [
          'kode_transaksi' => $this->input->post('kd_transaksi'),
          'tanggal' => $this->input->post('tanggal'),
          'keterangan' => $this->input->post('uraian'),
          'debit' => (empty($this->input->post('debet'))) ? '0' : $this->input->post('debet'),
          'kredit' => (empty($this->input->post('kredit'))) ? '0' : $this->input->post('kredit'),
          'alat_bayar' => $this->input->post('alat'),
        ];
        $this->m_data->update_data(array('id_buku_umum' => $this->input->post('id')),$dataArr,'buku_umum');
        // $this->session->set_flashdata('alert','<div class="alert alert-success alert-dismissible">
        //             <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
        //             <h4><i class="icon fa fa-check"></i> Berhasil Update Buku Umum</h4>
        //
        //           </div>');
        // redirect('buku_umum/general_book');
      }
      function update_buku_umum2($id){
        $dataArr = [
          'kode_transaksi' => $this->input->post('kd_transaksi'),
          'tanggal' => $this->input->post('tanggal'),
          'keterangan' => $this->input->post('uraian'),
          'debit' => (empty($this->input->post('debet'))) ? '0' : $this->input->post('debet'),
          'kredit' => (empty($this->input->post('kredit'))) ? '0' : $this->input->post('kredit'),
          'alat_bayar' => $this->input->post('alat'),
        ];
        $this->m_data->update_data(array('id_buku_umum' => $id),$dataArr,'buku_umum');
        $this->session->set_flashdata('alert','<div class="alert alert-success alert-dismissible">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                    <h4><i class="icon fa fa-check"></i> Berhasil Update Buku Umum</h4>

                  </div>');
        redirect('buku_umum/home/all');
      }
      function cetak_buku_umum3($stat=null,$stat1=null,$idne=null,$opo1=null){
        		(is_null($stat)) ? $tgl='' : $tgl = $stat;
        		(is_null($stat1)) ? $tgl1='' : $tgl1 = $stat1;
        		(is_null($idne)) ? $id='' : $id = $idne;
            (is_null($opo1)) ? $opo1='' : $opo1 = $opo1;
            $list_buku_umum = $this->m_data->list_buku_umum_anggota2($tgl,$tgl1,$id,$opo1)->result();
            $debitq = $this->m_data->ttl_buku_anggota2($tgl,$tgl1,$id,'','debit')->row();
            $kreditq = $this->m_data->ttl_buku_anggota2($tgl,$tgl1,$id,'','kredit')->row();
            echo '<title>Buku Bank Umum Kas Anggota</title>';

        		echo '

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
        							<h3 style="margin: 0px;" class="pull-left"><b>Penjualan Belanja Barang Toko - Laporan Buku Kas Umum Anggota</b><br>
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
        												<th>Tanggal</th>
        												<th>Kode</th>
        												<th>Uraian Kode</th>
        												<th>Keterangan</th>
        												<th>Pemasukan</th>
        												<th>Pengeluaran</th>
        												<th>Hasil</th>
        												<th>Saldo</th>
        											</tr>
        										</thead>
        										<tbody>
        		';

        		$no=0;
        		$sal=0;
        		foreach($list_buku_umum as $l):
        		$no++;
        		echo '
        		<tr>
        			<td>'.$no.'</td>
        			<td>'.date('d-m-Y',strtotime($l->tanggal)).'</td>
        			<td>'.$l->kode.'</td>
        			<td>'.$l->uraian_kode.'</td>
        			<td>'.$l->keterangan.'</td>
        			<td>Rp '.number_format($l->kredit,2).'</td>
        			<td>Rp '.number_format($l->debit,2).'</td> ';
        			$salq =  $l->kredit - $l->debit;
        			echo '
        			<td>Rp '.number_format($salq,2).'</td>
        			<td>Rp ';
        			if($no==1){
        				 $sal=$salq;
        			}else{
        		$sal = $salq + $sal ;
        			}
        			echo number_format($sal,2);

        			 echo '
        			 </td>
        			</tr>
        			 ';

        		endforeach;
        		echo '
        		<tr style="background-color:#2ed573;">
        			<td colspan="5"><b>Total</b></td>
        			<td>Rp '.number_format($kreditq->total,2).'</td>
        			<td>Rp  '.number_format($debitq->total,2).'</td>
        			<td colspan="2">Rp '.number_format($kreditq->total - $debitq->total,2).' </td>
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
      function cetak_buku_umum($stat=null,$stat1=null,$idne=null,$opo1=null){
    		(is_null($stat)) ? $tgl='' : $tgl = $stat;
    		(is_null($stat1)) ? $tgl1='' : $tgl1 = $stat1;
    		(is_null($idne)) ? $id='' : $id = $idne;
        (is_null($opo1)) ? $opo1='' : $opo1 = $opo1;
        $list_buku_umum = $this->m_data->list_buku_umum_anggota3($tgl,$tgl1,$id,$opo1)->result();
        $debitq = $this->m_data->ttl_buku_toko2($tgl,$tgl1,$id,'','debit')->row();
        $kreditq = $this->m_data->ttl_buku_toko2($tgl,$tgl1,$id,'','kredit')->row();
        echo '<title>Buku Bank Umum Kas Toko</title>';

    		echo '

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
    							<h3 style="margin: 0px;" class="pull-left"><b>Penjualan Belanja Barang Toko - Laporan Buku Kas Umum Toko</b><br>
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
    												<th>Tanggal</th>
    												<th>Kode</th>
    												<th>Uraian Kode</th>
    												<th>Keterangan</th>
    												<th>Pemasukan</th>
    												<th>Pengeluaran</th>
    												<th>Hasil</th>
    												<th>Saldo</th>
    											</tr>
    										</thead>
    										<tbody>
    		';

    		$no=0;
    		$sal=0;
    		foreach($list_buku_umum as $l):
    		$no++;
    		echo '
    		<tr>
    			<td>'.$no.'</td>
    			<td>'.date('d-m-Y',strtotime($l->tanggal)).'</td>
    			<td>'.$l->kode.'</td>
    			<td>'.$l->uraian_kode.'</td>
    			<td>'.$l->keterangan.'</td>
    			<td>Rp '.number_format($l->kredit,2).'</td>
    			<td>Rp '.number_format($l->debit,2).'</td> ';
    			$salq =  $l->kredit - $l->debit;
    			echo '
    			<td>Rp '.number_format($salq,2).'</td>
    			<td>Rp ';
    			if($no==1){
    				 $sal=$salq;
    			}else{
    		$sal = $salq + $sal ;
    			}
    			echo number_format($sal,2);

    			 echo '
    			 </td>
    			</tr>
    			 ';

    		endforeach;
    		echo '
    		<tr style="background-color:#2ed573;">
    			<td colspan="5"><b>Total</b></td>
    			<td>Rp '.number_format($kreditq->total,2).'</td>
    			<td>Rp  '.number_format($debitq->total,2).'</td>
    			<td colspan="2">Rp '.number_format($kreditq->total - $debitq->total,2).' </td>
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

      function export_buku_umum2($stat=null,$stat1=null){
        (is_null($stat)) ? $tgl='' : $tgl = $stat;
        (is_null($stat1)) ? $tgl1='' : $tgl1 = $stat1;
        header("Content-type: application/vnd-ms-excel");
        header("Content-Disposition: attachment; filename=Buku_Bank_kas_umum_All.xls");
        // header("Pragma: no-cache");
        header("Expires: 0");
        header("Pragma: ");
        header("Cache-Control: ");
        // if(empty($opo1)){
      //   $list_buku_umum = $this->m_data->list_buku_umum_anggota($tgl,$tgl1,$id,$opo)->result();
      //   echo '<title>Buku Bank Umum Kas Anggota</title>';
      // }else{
      if(empty($tgl)){
        $list_buku_umum = $this->m_data->list_general_book_new()->result();
      }else{
        $list_buku_umum = $this->m_data->list_general_book_new($tgl,$tgl1)->result();
      }
        echo '<title>Buku Kas Anggota Monitoring</title>';
      // }
        echo '

        <body style="border-collapse: collapse;"> ';
        $this->load->view('user/css_print');


        echo '
        </section>

        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-12">
                        <table class="table table-striped table-bordered datatable-biasa" border="1" width="100%">
                          <thead>
                          <tr>
                          <th>No</th>
                          <th>Tanggal</th>
                          <th>Kredit (Hutang)</th>
                          <th>Debit</th>
                          <th>Total Harga</th>
                          <th>Saldo</th>
                          </tr>
                        </thead>
                        <tbody>
        ';

        $sal=0;
        $kredit1=0;
        $debit1=0;
        $no=0;
        $nos=0;
        foreach($list_buku_umum as $l):
         $no++;
         $nos++;
         ($l->status == '2') ? $kredit = number_format($l->bayar) : $kredit=0;
         ($l->status == '1') ? $debit = number_format($l->bayar) : $debit=0;
        echo '
        <tr>
          <td>'.$nos.'</td>
          <td>'.date('d-m-Y',strtotime($l->tanggal_penjualan)).'</td>
          <td>Rp '.$kredit.'</td>
          <td>Rp '.$debit.'</td> ';
          $salq =  $kredit - $debit;
          echo '
          <td>Rp '.number_format($l->total_harga).'</td>
          <td>Rp ';
          $salq =  $l->total_harga;
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
           $kre[$nos] = $kredit;
           $de[$nos] = $debit;
           $debit1 += $de[$nos];
           $kredit1 += $kre[$nos];
        endforeach;
        if($this->uri->segment(3) == 'ac'){
          $sum_ke = $this->m_data->sum_list_general_book2('2',$this->input->post('start_tgl'),$this->input->post('end_tgl'))->row();
          $sum_ke1 = $this->m_data->sum_list_general_book2('1',$this->input->post('start_tgl'),$this->input->post('end_tgl'))->row();
          // echo 'jh';
        }else{
        $sum_ke = $this->m_data->sum_list_general_book2('2')->row();
        $sum_ke1 = $this->m_data->sum_list_general_book2('1')->row();
        }
        echo '
        <tr style="background-color:#2ed573;">
          <td colspan="2"><b>Total</b></td>
          <td> <b>Kredit (Hutang)</b> : Rp.&nbsp; '.number_format($sum_ke->bayarx).'</td>
          <td> <b>Debit</b> : Rp.&nbsp; '.number_format($sum_ke1->bayarx).'</td>
          <td colspan="2"> <b>Saldo</b> : Rp.&nbsp; '.number_format($sal).'</td>
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

      function cetak_buku_umum2($stat=null,$stat1=null){
        (is_null($stat)) ? $tgl='' : $tgl = $stat;
        (is_null($stat1)) ? $tgl1='' : $tgl1 = $stat1;
        // if(empty($opo1)){
      //   $list_buku_umum = $this->m_data->list_buku_umum_anggota($tgl,$tgl1,$id,$opo)->result();
      //   echo '<title>Buku Bank Umum Kas Anggota</title>';
      // }else{
      if(empty($tgl)){
        $list_buku_umum = $this->m_data->list_general_book_new()->result();
      }else{
        $list_buku_umum = $this->m_data->list_general_book_new($tgl,$tgl1)->result();
      }
        echo '<title>Buku Kas Anggota Monitoring</title>';
      // }
        echo '

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
                  <h3 style="margin: 0px;" class="pull-left"><b>Penjualan Belanja Barang Toko - Laporan Buku Kas Umum</b><br>
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
                          <th>Tanggal</th>
                          <th>Kredit (Hutang)</th>
                          <th>Debit</th>
                          <th>Total Harga</th>
                          <th>Saldo</th>
                          </tr>
                        </thead>
                        <tbody>
        ';

        $sal=0;
        $kredit1=0;
        $debit1=0;
        $no=0;
        $nos=0;
        foreach($list_buku_umum as $l):
         $no++;
         $nos++;
         ($l->status == '2') ? $kredit = number_format($l->bayar) : $kredit=0;
         ($l->status == '1') ? $debit = number_format($l->bayar) : $debit=0;
        echo '
        <tr>
          <td>'.$nos.'</td>
          <td>'.date('d-m-Y',strtotime($l->tanggal_penjualan)).'</td>
          <td>Rp '.$kredit.'</td>
          <td>Rp '.$debit.'</td> ';
          $salq =  $kredit - $debit;
          echo '
          <td>Rp '.number_format($l->total_harga).'</td>
          <td>Rp ';
          $salq =  $l->total_harga;
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
           $kre[$nos] = $kredit;
           $de[$nos] = $debit;
           $debit1 += $de[$nos];
           $kredit1 += $kre[$nos];
        endforeach;
        if($this->uri->segment(3) == 'ac'){
          $sum_ke = $this->m_data->sum_list_general_book2('2',$this->input->post('start_tgl'),$this->input->post('end_tgl'))->row();
          $sum_ke1 = $this->m_data->sum_list_general_book2('1',$this->input->post('start_tgl'),$this->input->post('end_tgl'))->row();
          // echo 'jh';
        }else{
        $sum_ke = $this->m_data->sum_list_general_book2('2')->row();
        $sum_ke1 = $this->m_data->sum_list_general_book2('1')->row();
        }
        echo '
        <tr style="background-color:#2ed573;">
          <td colspan="2"><b>Total</b></td>
          <td> <b>Kredit (Hutang)</b> : Rp.&nbsp; '.number_format($sum_ke->bayarx).'</td>
          <td> <b>Debit</b> : Rp.&nbsp; '.number_format($sum_ke1->bayarx).'</td>
          <td colspan="2"> <b>Saldo</b> : Rp.&nbsp; '.number_format($sal).'</td>
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
  }
