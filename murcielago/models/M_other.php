<?php

	class M_other extends CI_Model{

		function where($table,$where){
	        return $this->db->get_where($table,$where);
	    }
			function kelengkapan_pegawai($kode,$start=null,$end=null){
				(is_null($start))? $stat='' : $stat = $start;
				(is_null($end))? $ed='' : $ed = $end;
				$this->db->select('*');
	      $this->db->from('buku_umum');
	      $this->db->join('kode_transaksi2','buku_umum.kode_transaksi=kode_transaksi2.kd_transaksi','left');
				$this->db->where('kode_transaksi2.kode',$kode);
				if($stat == ''){

				}else{
					$this->db->where('buku_umum.tanggal >=',$stat);
		      $this->db->where('buku_umum.tanggal <=',$ed);
				}
	      $query = $this->db->get();
	      return $query;
			}
			function simpanan_wajib($start=null,$end=null){
				(is_null($start))? $stat='' : $stat = $start;
				(is_null($end))? $ed='' : $ed = $end;
				$this->db->select('*');
	      $this->db->from('simpanan_wajib');
				if($stat == ''){

				}else{
					$this->db->where('simpanan_wajib.bulan_awal_keanggotaan >=',$stat);
		      $this->db->where('simpanan_wajib.bulan_awal_keanggotaan <=',$ed);
				}
	      $query = $this->db->get();
	      return $query;
			}
			function list_bank_toko_anggota($opo){
	      $this->db->select('*');
	      $this->db->from('buku_bank');
	      $this->db->join('kode_transaksi','buku_bank.kode_transaksi=kode_transaksi.kd_transaksi','left');
	      $this->db->where('buku_bank.status',$opo);
	      $query = $this->db->get();
	      return $query;
	    }
			function data_brg_sup(){
	      $this->db->select('kd_supplier,nama_supplier');
	      $this->db->from('supplier');
	      $query = $this->db->get();
	      return $query;
	    }
			function users_spp(){
	      $this->db->select('id,first_name');
	      $this->db->from('users');
	      $query = $this->db->get();
	      return $query;
	    }

    function pembelian_barang(){
        $this->db->select('pembelian_barang.kode_supplier,pembelian_barang.kode_barang,tanggal_pembelian,nama_supplier,kategori_barang,jenis_barang,nama_barang,tanggal_expired,nama_satuan,harga_beli_satuan,diskon_beli_satuan,netto_beli_satuan,jumlah_beli,total_harga,harga_pokok,laba_satuan,status,jatuh_tempo_kredit,id_users,kd_pembelian,bayar');
        $this->db->from('pembelian_barang');
        $this->db->join('barang','pembelian_barang.kode_barang=barang.kode_barang','left');
        $this->db->join('supplier','pembelian_barang.kode_supplier=supplier.kd_supplier','left');
        $this->db->join('kategori_barang','barang.kd_kategori_barang=kategori_barang.id_kategori','left');
        $this->db->join('jenis_barang','barang.kd_jenis_barang=jenis_barang.id_jenis_barang','left');
        $this->db->join('satuan_barang','barang.satuan_barang=satuan_barang.id_satuan','left');
        $this->db->order_by('kd_pembelian','DESC');
        $query = $this->db->get();
        return $query;
    }

			function cari_list_bank_toko_anggota($tgl,$tgl1,$id,$opo){
	      $this->db->select('*');
	      $this->db->from('buku_bank');
	      $this->db->join('kode_transaksi','buku_bank.kode_transaksi=kode_transaksi.kd_transaksi','left');
				$this->db->where('buku_bank.tanggal >=', $tgl);
        $this->db->where('buku_bank.tanggal <=', $tgl1);
        $this->db->where('buku_bank.id_user',$id);
	      $this->db->where('buku_bank.status',$opo);
	      $query = $this->db->get();
	      return $query;
	    }

			function cari_list_bank_toko_anggota_count($tgl=null,$tgl1=null,$id=null,$opo=null,$deb){
				(is_null($tgl)) ? $tgl='' : $tgl = $tgl;
	      (is_null($tgl1)) ? $tgl1='' : $tgl1 = $tgl1;
	      (is_null($id)) ? $id='' : $id = $id;
	      (is_null($opo)) ? $opo='' : $opo = $opo;
	      $this->db->select('sum('.$deb.') as total');
	      $this->db->from('buku_bank');
	      $this->db->join('kode_transaksi','buku_bank.kode_transaksi=kode_transaksi.kd_transaksi','left');
				$this->db->where('buku_bank.status',$opo);
				if(empty($tgl)){}else{
				$this->db->where('buku_bank.tanggal >=', $tgl);
        $this->db->where('buku_bank.tanggal <=', $tgl1);
        $this->db->where('buku_bank.id_user',$id);
				}
	      $query = $this->db->get();
	      return $query;
	    }

			function daftar_bank_anggota($stat = null,$stat1 = null,$idne = null,$kdt = null,$status){
	      (is_null($stat)) ? $tgl='' : $tgl = $stat;
	      (is_null($stat1)) ? $tgl1='' : $tgl1 = $stat1;
	      (is_null($idne)) ? $id='' : $id = $idne;
	      (is_null($kdt)) ? $kode = '' : $kode = $kdt;
	      $this->db->join('kode_transaksi','buku_bank.kode_transaksi=kode_transaksi.kd_transaksi','left');
	      if(!empty($tgl)){
	        $this->db->where('buku_bank.tanggal >=', $tgl);
	        $this->db->where('buku_bank.tanggal <=', $tgl1);
	        $this->db->where('buku_bank.id_user',$id);
	      }
	      if(!empty($kode)){
	        $this->db->where('kode_transaksi.kode',$kode);
	      }
	      $this->db->where('buku_bank.status',$status);
	      $query = $this->db->get('buku_bank');
	      return $query;
	    }

	    function kadaluarsa($tanggal){
	    	$this->db->select('*');
	        $this->db->from('barang');
	        $this->db->where('tanggal_expired <', $tanggal);
	        $query = $this->db->get();
	        return $query;
	    }

		function cari_perbulan($bln1,$bln2,$thn){
	        $this->db->select('DISTINCT(bulan_beli) as bulan');
	        $this->db->from('penjualan_barang');
	        $this->db->where('bulan_beli >=', $bln1);
	        $this->db->where('bulan_beli <=', $bln2);
	        $this->db->where('tahun_n',$thn);
	        $this->db->order_by('bulan_beli','ASC');
	        $query = $this->db->get();
	        return $query;
	    }
	    function total_bul($bln,$thn){
	    	$this->db->select('*');
	    	$this->db->from('penjualan_barang');
	    	$this->db->where('bulan_beli',$bln);
	    	$this->db->where('tahun_n',$thn);
	    	$query = $this->db->get();
	    	return $query;
	    }
	    function cari_pertahun($thn1,$thn2){
	    	$this->db->select('DISTINCT(tahun_n) as tahun');
	        $this->db->from('penjualan_barang');
	        $this->db->where('tahun_n >=', $thn1);
	        $this->db->where('tahun_n <=', $thn2);
	        $this->db->order_by('tahun_n','ASC');
	        $query = $this->db->get();
	        return $query;
	    }
	    function total_hun($thn){
	    	$this->db->select('*');
	    	$this->db->from('penjualan_barang');
	    	$this->db->where('tahun_n',$thn);
	    	$query = $this->db->get();
	    	return $query;
	    }
        function daftar_pembayaran_hutang_pembelian($id){
	    	$this->db->select('*');
	    	$this->db->from('join_kredit_pembelian');
	    	$this->db->join('pembelian_barang','join_kredit_pembelian.kd_pembelian=pembelian_barang.kd_pembelian','left');
	    	$this->db->join('barang','pembelian_barang.kode_barang=barang.kode_barang','left');
            $this->db->join('supplier','pembelian_barang.kode_supplier=supplier.kd_supplier','left');
            $this->db->join('kategori_barang','barang.kd_kategori_barang=kategori_barang.id_kategori','left');
            $this->db->join('jenis_barang','barang.kd_jenis_barang=jenis_barang.id_jenis_barang','left');
            $this->db->join('satuan_barang','barang.satuan_barang=satuan_barang.id_satuan','left');
            $this->db->where('pembelian_barang.kode_supplier',$id);
            $this->db->order_by('id_join_kredit','DESC');
	    	$query = $this->db->get();
	    	return $query;
	    }
	}
