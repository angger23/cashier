<?php
class M_data extends CI_Model{
    function semua($table){
        return $this->db->get($table);
    }
    function where($table,$where){
        return $this->db->get_where($table,$where);
    }
    function ordernya($name,$or,$table){
        $this->db->order_by($name, $or);
        $query = $this->db->get($table);
        return $query;
    }
    function ordernya1($name,$or,$table){
        $this->db->order_by($name, $or);
        $this->db->limit(1);
        $query = $this->db->get($table);
        return $query;
    }
    function carix($cari,$like,$table){
      $this->db->like($cari,$like);
      $query = $this->db->get($table);
      return $query;

    }
    function simpanan_pokokk(){
      $this->db->join('anggota_terbaru_2018','simpanan_pokok.id_anggota=anggota_terbaru_2018.id_anggota','left');
      $query = $this->db->get('simpanan_pokok');
      return $query;
    }
    function barang_satu_tgl($tgl){
        $this->db->select('*');
        $this->db->from('penjualan_barang');
        $this->db->like('penjualan_barang.tanggal_penjualan',$tgl);
        $query = $this->db->get();
        return $query;
    }
    function hutang_pen($id){
        $this->db->select('*');
        $this->db->from('hutang_penjualan');
        $this->db->where('kd_penjualan',$id);
        $query = $this->db->get();
        return $query;
    }
    function join_hutang_pen($id){
        $this->db->select('*');
        $this->db->from('join_hutang_penjualan');
        $this->db->where('id_hutang',$id);
        $query = $this->db->get();
        return $query;
    }
    function penjumlahan_sementara($kd_nota){
        $this->db->select('sum(satuan*harga) as total_hasil');
        $this->db->from('penjualan_sementara');
        $this->db->where('kd_nota',$kd_nota);
        $query = $this->db->get();
        return $query;
    }
    function cek_penjualan_kembar($kd_nota){
        $this->db->select('count(kd_nota) as total_hasil');
        $this->db->from('penjualan_barang');
        $this->db->where('kd_nota',$kd_nota);
        $query = $this->db->get();
        return $query;
    }
    function getRows($params = array()){
            $this->db->select('*');
            $this->db->from('barang');
            $this->db->join('jenis_barang','barang.kd_jenis_barang=jenis_barang.id_jenis_barang','left');
            $this->db->join('kategori_barang','barang.kd_kategori_barang=kategori_barang.id_kategori','left');
            $this->db->join('satuan_barang','barang.satuan_barang=satuan_barang.id_satuan','left');
            //filter data by searched keywords
            if(!empty($params['search']['keywords'])){
              $this->db->like('barang.nama_barang',$params['search']['keywords']);
              $this->db->or_like('barang.kode_barang',$params['search']['keywords']);
            }else{
                $this->db->order_by('barang.id_barang','ASC');
            }
            //sort data by ascending or desceding order
            if(!empty($params['search']['sortBy'])){
                $this->db->order_by('barang.id_barang',$params['search']['sortBy']);
            }else{
                $this->db->order_by('barang.id_barang','ASC');
            }
            //set start and limit
            if(array_key_exists("start",$params) && array_key_exists("limit",$params)){
                $this->db->limit($params['limit'],$params['start']);
            }elseif(!array_key_exists("start",$params) && array_key_exists("limit",$params)){
                $this->db->limit($params['limit']);
            }
            //get records
            $query = $this->db->get();
            //return fetched data
            return ($query->num_rows() > 0)?$query->result_array():[];
        }
        function getRows2($params = array()){
            $this->db->select('kd_pembeli,kd_pelanggan,nama_pembeli,sumber_dana,status_keanggotaan,kode_pelanggan_baru');
            $this->db->from('pembeli');
            //filter data by searched keywords
            if(!empty($params['search']['keywords'])){
              $this->db->like('pembeli.nama_pembeli',$params['search']['keywords']);
            }
            //sort data by ascending or desceding order
            if(!empty($params['search']['sortBy'])){
                $this->db->order_by('pembeli.kd_pembeli',$params['search']['sortBy']);
            }else{
                $this->db->order_by('pembeli.kd_pembeli','ASC');
            }
            //set start and limit
            if(array_key_exists("start",$params) && array_key_exists("limit",$params)){
                $this->db->limit($params['limit'],$params['start']);
            }elseif(!array_key_exists("start",$params) && array_key_exists("limit",$params)){
                $this->db->limit($params['limit']);
            }
            //get records
            $query = $this->db->get();
            //return fetched data
            return ($query->num_rows() > 0)?$query->result():[];
        }
 function getRows3($params = array()){
            $this->db->select('*');
            $this->db->from('hutang_penjualan');
            //filter data by searched keywords
            if(!empty($params['search']['keywords'])){
              $this->db->like('atas_nama',$params['search']['keywords']);
            }
            //sort data by ascending or desceding order
            if(!empty($params['search']['sortBy'])){
                $this->db->order_by('id_hutang',$params['search']['sortBy']);
            }else{
                $this->db->order_by('id_hutang','ASC');
            }
            //set start and limit
            if(array_key_exists("start",$params) && array_key_exists("limit",$params)){
                $this->db->limit($params['limit'],$params['start']);
            }elseif(!array_key_exists("start",$params) && array_key_exists("limit",$params)){
                $this->db->limit($params['limit']);
            }
            //get records
            $query = $this->db->get();
            //return fetched data
            return ($query->num_rows() > 0)?$query->result():[];
        }
    function ajax_search($select,$table,$like){
      $this->db->select($select);
      $this->db->from($table);
      $this->db->like('nama_barang',$like);
      $this->db->or_like('kode_barang',$like);
      $query = $this->db->get();
      return $query;
    }
    function tes_c($title){
       $this->db->like('nama_barang', $title , 'both');
        $this->db->order_by('nama_barang', 'ASC');
        $this->db->limit(10);
        return $this->db->get('barang')->result();
    }
    function list_buku_umum_anggota($stat = null,$stat1 = null,$idne = null,$opo){
      (is_null($stat)) ? $tgl='' : $tgl = $stat;
      (is_null($stat1)) ? $tgl1='' : $tgl1 = $stat1;
      (is_null($idne)) ? $id='' : $id = $idne;
      $tgl_saiki = date('Y-m');
      $this->db->join('kode_transaksi2','kode_transaksi2.kd_transaksi=buku_umum.kode_transaksi','left');
      if($opo = 'all'):
      $this->db->like('kode_transaksi2.uraian_kode','KA');
      $this->db->or_like('kode_transaksi2.uraian_kode','Kas Anggota');
      else:
      $this->db->where('kode_transaksi2.kode',$opo);
      endif;
      if(empty($tgl)):
      $this->db->like('buku_umum.tanggal',$tgl_saiki);
      else:
      $this->db->where('buku_umum.tanggal >=', $tgl);
      $this->db->where('buku_umum.tanggal <=', $tgl1);
      $this->db->where('buku_umum.id_user',$id);
      endif;
      $query = $this->db->get('buku_umum');
      return $query;
    }
    function getrays($start,$end){
      $this->db->select('debit,kredit,no_urut,id_buku_umum,kode_transaksi');
      $this->db->join('kode_transaksi','kode_transaksi.kd_transaksi=buku_umum.kode_transaksi','left');
      $this->db->where('kode_transaksi.status','Kas Toko');
      $this->db->where('no_urut >=', $start);
      $this->db->where('no_urut <=', $end);
      $query = $this->db->get('buku_umum');
      return $query;
    }
    function getrays2($start,$end){
      $this->db->select('debit,kredit,no_urut,id_buku_umum,kode_transaksi');
      $this->db->join('kode_transaksi','kode_transaksi.kd_transaksi=buku_umum.kode_transaksi','left');
      $this->db->where('kode_transaksi.status','Kas Anggota');
      $this->db->where('no_urut >=', $start);
      $this->db->where('no_urut <=', $end);
      $this->db->order_by('no_urut','ASC');
      $query = $this->db->get('buku_umum');
      return $query;
    }
    function getRowsF2($params = array()){
        $this->db->select('*');
        $this->db->from('buku_umum');
        $this->db->join('kode_transaksi','kode_transaksi.kd_transaksi=buku_umum.kode_transaksi','left');
        $this->db->where('kode_transaksi.status','Kas Toko');
        //filter data by searched keywords
        if(!empty($params['search']['keywords'])){
          $this->db->like('buku_umum.kode_transaksi',$params['search']['keywords']);
          $this->db->or_like('buku_umum.keterangan',$params['search']['keywords']);
          $this->db->or_like('buku_umum.debit',$params['search']['keywords']);
          $this->db->or_like('buku_umum.kredit',$params['search']['keywords']);
          $this->db->or_like('buku_umum.sumber_dana',$params['search']['keywords']);
          $this->db->or_like('buku_umum.alat_bayar',$params['search']['keywords']);
        }
        // filter kode
        if(!empty($params['search']['filter'])){
          $this->db->where('kode_transaksi.kode',$params['search']['filter']);
        }
        // filter tanggal
        if(!empty($params['search']['start_tgl']) && !empty($params['search']['end_tgl'])){
          $this->db->where('buku_umum.tanggal >=', $params['search']['start_tgl']);
          $this->db->where('buku_umum.tanggal <=', $params['search']['end_tgl']);
        }
        // urutan data desc / asc
        if(!empty($params['search']['sortBy'])){
          $this->db->order_by('buku_umum.no_urut',$params['search']['sortBy']);
          $this->db->order_by('buku_umum.tanggal',$params['search']['sortBy']);
        }else{
          $this->db->order_by('buku_umum.no_urut','ASC');
          $this->db->order_by('buku_umum.tanggal','ASC');
        }
        //set start and limit
        if(array_key_exists("start",$params) && array_key_exists("limit",$params)){
            $this->db->limit($params['limit'],$params['start']);
        }elseif(!array_key_exists("start",$params) && array_key_exists("limit",$params)){
            $this->db->limit($params['limit']);
        }
        //get records
        $query = $this->db->get();
        //return fetched data
        return ($query->num_rows() > 0)?$query->row():[];
    }
    function monitoringpptkt2(){
      $this->db->join("penjualan_barang","hutang_penjualan.kd_penjualan=penjualan_barang.kd_penjualan","left");
      $this->db->join("penjualan_sementara","penjualan_barang.kd_nota=penjualan_sementara.kd_nota","left");
      $this->db->join("barang","penjualan_sementara.kode_barang=barang.kode_barang","left");
      $this->db->join("jenis_barang","barang.kd_jenis_barang=jenis_barang.id_jenis_barang","left");
      $this->db->join("kategori_barang","barang.kd_kategori_barang=kategori_barang.id_kategori","left");
      $this->db->join("pembeli","penjualan_barang.nama_pembeli=pembeli.kd_pelanggan","left");
      $query = $this->db->get('hutang_penjualan')->result();
      return $query;
    }
    function hutang_penjualan_cek($id){
      $this->db->select('SUM(bayar) as bayar');
      $this->db->where('id_hutang',$id);
      $query = $this->db->get('join_hutang_penjualan')->row();
      return $query;
    }
    function monitoringputka(){
      $this->db->select('*');
      $this->db->from('buku_umum');
      $this->db->join('kode_transaksi','kode_transaksi.kd_transaksi=buku_umum.kode_transaksi','left');
      $this->db->where('kode_transaksi.status','Kas Anggota');
      $this->db->where('kode_transaksi.kode','PUTKA');
      $query = $this->db->get()->result();
      return $query;
    }

    function monitoringhka(){
      $this->db->select('*');
      $this->db->from('buku_umum');
      $this->db->join('kode_transaksi','kode_transaksi.kd_transaksi=buku_umum.kode_transaksi','left');
      $this->db->where('kode_transaksi.status','Kas Anggota');
      $this->db->where('kode_transaksi.kode','HKA');
      $query = $this->db->get()->result();
      return $query;
    }

    function cari_pembeli($like){
      $this->db->like('nama_pembeli',$like);
      $query = $this->db->get('pembeli');
      return $query;
    }

    function simpanan_pokokq($tgl1=null,$tgl2=null){
      $this->db->join('pelanggan_simpanan_pokok','simpanan_pokok.id_pelanggan=pelanggan_simpanan_pokok.id_pelanggan','left');
      if($tgl1 == null && $tgl2 == null){}else{
        $this->db->where('simpanan_wajib_wajib.created >=', $tgl1);
        $this->db->where('simpanan_wajib_wajib.created <=', $tgl2);
      }
      $query = $this->db->get('simpanan_pokok');
      return $query->result();
    }

    function simpanan_wajibq($tgl1=null,$tgl2=null){
        $this->db->join('pelanggan_simpanan_pokok','simpanan_wajib_wajib.id_pelanggan=pelanggan_simpanan_pokok.id_pelanggan','left');
      if($tgl1 == null && $tgl2 == null){
        $this->db->where('simpanan_wajib_wajib.bulan', date('m'));
        $this->db->where('simpanan_wajib_wajib.tahun', date('Y'));
      }else{
        $this->db->where('simpanan_wajib_wajib.bulan', $tgl1);
        $this->db->where('simpanan_wajib_wajib.tahun', $tgl2);
      }
      $query = $this->db->get('simpanan_wajib_wajib');
      return $query->result();
    }

    function cicilan_count($id){
      $this->db->select('SUM(nominal) as total');
      $this->db->where('id_pelanggan',$id);
      $query = $this->db->get('bayar_cicilan');
      return $query;
    }

    function utang_count($id){
      $this->db->select('SUM(nominal) as total');
      $this->db->where('id_pelanggan',$id);
      $query = $this->db->get('piutang_pegawai');
      return $query;
    }

    function simpanan_kokqqq1($tgl1=null,$tgl2=null){
        $this->db->join('pelanggan_simpanan_pokok','piutang_pegawai.id_pelanggan=pelanggan_simpanan_pokok.id_pelanggan','left');
      if($tgl1 == null && $tgl2 == null){
        $this->db->where('piutang_pegawai.bulan', date('m'));
        $this->db->where('piutang_pegawai.tahun', date('Y'));
      }else{
        $this->db->where('piutang_pegawai.bulan', $tgl1);
        $this->db->where('piutang_pegawai.tahun', $tgl2);
      }
      $query = $this->db->get('piutang_pegawai');
      return $query;
    }

    function history_simpanan_wajib1($id){
      $this->db->select('DISTINCT(tahun) as thn');
      $this->db->where('id_pelanggan',$id);
      $this->db->order_by('tahun','ASC');
      $query = $this->db->get('simpanan_wajib_wajib');
      return $query;
    }

    function history_simpanan_wajib11($id){
      $this->db->select('DISTINCT(tahun) as thn');
      $this->db->where('id_pelanggan',$id);
      $this->db->order_by('tahun','ASC');
      $query = $this->db->get('piutang_pegawai');
      return $query;
    }

    function barang_terjual($kd,$kd_barang){
      $this->db->select('SUM(satuan) as jml');
      $this->db->where('kd_nota',$kd);
      // $this->db->where('kd_nota',$kd);
      $this->db->where('kode_barang',$kd_barang);
      $query = $this->db->get('penjualan_sementara');
      return $query;
    }

    function history_simpanan_wajib($th,$id){
      // $this->db->select('id_pelanggan,nominal,bulan,tahun,created2');
      $this->db->where('id_pelanggan',$id);
      $this->db->where('tahun',$th);
      $this->db->order_by('bulan','ASC');
      $query = $this->db->get('simpanan_wajib_wajib');
      return $query;
    }

    function history_simpanan_wajib111($th,$id){
      // $this->db->select('id_pelanggan,nominal,bulan,tahun,created2');
      $this->db->where('id_pelanggan',$id);
      $this->db->where('tahun',$th);
      $this->db->order_by('bulan','ASC');
      $query = $this->db->get('piutang_pegawai');
      return $query;
    }

    function sum_wajib($id){
      $this->db->select('sum(nominal) as total');
      $this->db->join('pelanggan_simpanan_pokok','simpanan_wajib_wajib.id_pelanggan=pelanggan_simpanan_pokok.id_pelanggan','left');
      $this->db->where('simpanan_wajib_wajib.id_pelanggan', $id);

      $query = $this->db->get('simpanan_wajib_wajib');
      return $query->row();
    }

    function simpanan_wajibq_cek($bulan,$tahun){
      $date_gab = $tahun.'-'.$bulan;
      $this->db->join('pelanggan_simpanan_pokok','simpanan_wajib_wajib.id_pelanggan=pelanggan_simpanan_pokok.id_pelanggan','left');
      $this->db->where('simpanan_wajib_wajib.bulan', $bulan);
      $this->db->where('simpanan_wajib_wajib.tahun', $tahun);
      $query = $this->db->get('simpanan_wajib_wajib');
      return $query;
    }

    function monitoringpika(){
      $this->db->select('*');
      $this->db->from('buku_umum');
      $this->db->join('kode_transaksi','kode_transaksi.kd_transaksi=buku_umum.kode_transaksi','left');
      $this->db->where('kode_transaksi.status','Kas Anggota');
      $this->db->where('kode_transaksi.kode','PIKA');
      $query = $this->db->get()->result();
      return $query;
    }

    function monitoringhika(){
      $this->db->select('*');
      $this->db->from('buku_umum');
      $this->db->join('kode_transaksi','kode_transaksi.kd_transaksi=buku_umum.kode_transaksi','left');
      $this->db->where('kode_transaksi.status','Kas Anggota');
      $this->db->where('kode_transaksi.kode','HIKA');
      $query = $this->db->get()->result();
      return $query;
    }

    function monitoringhkt(){
      $this->db->select('*');
      $this->db->from('buku_umum');
      $this->db->join('kode_transaksi','kode_transaksi.kd_transaksi=buku_umum.kode_transaksi','left');
      $this->db->where('kode_transaksi.status','Kas Toko');
      $this->db->where('kode_transaksi.kode','HKT');
      $query = $this->db->get()->result();
      return $query;
    }
    function monitoringpikt(){
      $this->db->select('*');
      $this->db->from('buku_umum');
      $this->db->join('kode_transaksi','kode_transaksi.kd_transaksi=buku_umum.kode_transaksi','left');
      $this->db->where('kode_transaksi.status','Kas Toko');
      $this->db->where('kode_transaksi.kode','PIKT');
      $query = $this->db->get()->result();
      return $query;
    }
    function monitoringhikt(){
      $this->db->select('*');
      $this->db->from('buku_umum');
      $this->db->join('kode_transaksi','kode_transaksi.kd_transaksi=buku_umum.kode_transaksi','left');
      $this->db->where('kode_transaksi.status','Kas Toko');
      $this->db->where('kode_transaksi.kode','HIKT');
      $query = $this->db->get()->result();
      return $query;
    }
    function monitoringpptkt(){
      $this->db->select('*');
      $this->db->from('buku_umum');
      $this->db->join('kode_transaksi','kode_transaksi.kd_transaksi=buku_umum.kode_transaksi','left');
      $this->db->where('kode_transaksi.status','Kas Toko');
      $this->db->where('kode_transaksi.kode','HIKT');
      $query = $this->db->get()->result();
      return $query;
    }
    function monitoringpukt(){
      $this->db->select('*');
      $this->db->from('buku_umum');
      $this->db->join('kode_transaksi','kode_transaksi.kd_transaksi=buku_umum.kode_transaksi','left');
      $this->db->where('kode_transaksi.status','Kas Toko');
      $this->db->where('kode_transaksi.kode','PUTKT');
      $query = $this->db->get()->result();
      return $query;
    }
    function getRowsQY($params = array()){
        $this->db->select('*');
        $this->db->from('buku_umum');
        $this->db->join('kode_transaksi','kode_transaksi.kd_transaksi=buku_umum.kode_transaksi','left');
        $this->db->where('kode_transaksi.status','Kas Toko');
        $this->db->where('kode_transaksi.kode','PUTKT');
        //filter data by searched keywords
        if(!empty($params['search']['keywords'])){
          $this->db->like('buku_umum.kode_transaksi',$params['search']['keywords']);
          $this->db->or_like('buku_umum.keterangan',$params['search']['keywords']);
          $this->db->or_like('buku_umum.debit',$params['search']['keywords']);
          $this->db->or_like('buku_umum.kredit',$params['search']['keywords']);
          $this->db->or_like('buku_umum.sumber_dana',$params['search']['keywords']);
          $this->db->or_like('buku_umum.alat_bayar',$params['search']['keywords']);
        }
        // filter kode
        if(!empty($params['search']['filter'])){
          $this->db->where('kode_transaksi.kode',$params['search']['filter']);
        }
        // filter tanggal
        if(!empty($params['search']['start_tgl']) && !empty($params['search']['end_tgl'])){
          $this->db->where('buku_umum.tanggal >=', $params['search']['start_tgl']);
          $this->db->where('buku_umum.tanggal <=', $params['search']['end_tgl']);
        }
        // urutan data desc / asc
        if(!empty($params['search']['sortBy'])){
          $this->db->order_by('buku_umum.no_urut',$params['search']['sortBy']);
          $this->db->order_by('buku_umum.tanggal',$params['search']['sortBy']);
        }else{
          $this->db->order_by('buku_umum.no_urut','ASC');
          $this->db->order_by('buku_umum.tanggal','ASC');
        }
        //set start and limit
        if(array_key_exists("start",$params) && array_key_exists("limit",$params)){
            $this->db->limit($params['limit'],$params['start']);
        }elseif(!array_key_exists("start",$params) && array_key_exists("limit",$params)){
            $this->db->limit($params['limit']);
        }
        //get records
        $query = $this->db->get();
        //return fetched data
        return ($query->num_rows() > 0)?$query->result():[];
    }
    function getRowsF($params = array()){
        $this->db->select('*');
        $this->db->from('buku_umum');
        $this->db->join('kode_transaksi','kode_transaksi.kd_transaksi=buku_umum.kode_transaksi','left');
        $this->db->where('kode_transaksi.status','Kas Toko');
        //filter data by searched keywords
        if(!empty($params['search']['keywords'])){
          $this->db->like('buku_umum.kode_transaksi',$params['search']['keywords']);
          $this->db->or_like('buku_umum.keterangan',$params['search']['keywords']);
          $this->db->or_like('buku_umum.debit',$params['search']['keywords']);
          $this->db->or_like('buku_umum.kredit',$params['search']['keywords']);
          $this->db->or_like('buku_umum.sumber_dana',$params['search']['keywords']);
          $this->db->or_like('buku_umum.alat_bayar',$params['search']['keywords']);
        }
        // filter kode
        if(!empty($params['search']['filter'])){
          $this->db->where('kode_transaksi.kode',$params['search']['filter']);
        }
        // filter tanggal
        if(!empty($params['search']['start_tgl']) && !empty($params['search']['end_tgl'])){
          $this->db->where('buku_umum.tanggal >=', $params['search']['start_tgl']);
          $this->db->where('buku_umum.tanggal <=', $params['search']['end_tgl']);
        }
        // urutan data desc / asc
        if(!empty($params['search']['sortBy'])){
          $this->db->order_by('buku_umum.no_urut',$params['search']['sortBy']);
          $this->db->order_by('buku_umum.tanggal',$params['search']['sortBy']);
        }else{
          $this->db->order_by('buku_umum.no_urut','ASC');
          $this->db->order_by('buku_umum.tanggal','ASC');
        }
        //set start and limit
        if(array_key_exists("start",$params) && array_key_exists("limit",$params)){
            $this->db->limit($params['limit'],$params['start']);
        }elseif(!array_key_exists("start",$params) && array_key_exists("limit",$params)){
            $this->db->limit($params['limit']);
        }
        //get records
        $query = $this->db->get();
        //return fetched data
        return ($query->num_rows() > 0)?$query->result():[];
    }
    function ordernyaq($name,$or,$table,$kas){
        $this->db->join('kode_transaksi','kode_transaksi.kd_transaksi=buku_umum.kode_transaksi','left');
        $this->db->where('kode_transaksi.status',$kas);
        $this->db->order_by($name, $or);
        $this->db->limit('1');
        $query = $this->db->get($table);
        return $query;
    }
    function list_buku_umum_anggota3($stat = null,$stat1 = null,$idne = null,$op=null){
      (is_null($stat)) ? $tgl='' : $tgl = $stat;
      (is_null($stat1)) ? $tgl1='' : $tgl1 = $stat1;
      (is_null($idne)) ? $id='' : $id = $idne;
      (is_null($op)) ? $ope='' : $ope = $op;
      $tgl_saiki = date('Y-m');
      $this->db->join('kode_transaksi','kode_transaksi.kd_transaksi=buku_umum.kode_transaksi','left');
      $this->db->where('kode_transaksi.status','Kas Toko');
      if(empty($id)){
      }else{
        $this->db->where('kode_transaksi.kode',$id);
      }
      if(empty($tgl)):
      //$this->db->like('buku_umum.tanggal',$tgl_saiki);
      else:
      $this->db->where('buku_umum.tanggal >=', $tgl);
      $this->db->where('buku_umum.tanggal <=', $tgl1);
    //  $this->db->where('buku_umum.id_user',$ope);
      endif;
      $this->db->order_by('buku_umum.tanggal','ASC');
      $query = $this->db->get('buku_umum');
      return $query;
    }

    function ttl_buku_anggota2($stat = null,$stat1 = null,$idne = null,$op=null,$deb){
      (is_null($stat)) ? $tgl='' : $tgl = $stat;
      (is_null($stat1)) ? $tgl1='' : $tgl1 = $stat1;
      (is_null($idne)) ? $id='' : $id = $idne;
      (is_null($op)) ? $ope='' : $ope = $op;

      $tgl_saiki = date('Y-m');
      $this->db->select('SUM('.$deb.') as total');
      $this->db->join('kode_transaksi','kode_transaksi.kd_transaksi=buku_umum.kode_transaksi','left');
      $this->db->where('kode_transaksi.status','Kas Anggota');
      if(empty($id)){
      }else{
        $this->db->where('kode_transaksi.kode',$id);
      }
      if(empty($tgl)):
      //$this->db->like('buku_umum.tanggal',$tgl_saiki);
      else:
      $this->db->where('buku_umum.tanggal >=', $tgl);
      $this->db->where('buku_umum.tanggal <=', $tgl1);
    //  $this->db->where('buku_umum.id_user',$ope);
      endif;
      $this->db->order_by('buku_umum.tanggal','ASC');
      $query = $this->db->get('buku_umum');
      return $query;
    }

    function ttl_buku_toko2($stat = null,$stat1 = null,$idne = null,$op=null,$deb){
      (is_null($stat)) ? $tgl='' : $tgl = $stat;
      (is_null($stat1)) ? $tgl1='' : $tgl1 = $stat1;
      (is_null($idne)) ? $id='' : $id = $idne;
      (is_null($op)) ? $ope='' : $ope = $op;

      $tgl_saiki = date('Y-m');
      $this->db->select('SUM('.$deb.') as total');
      $this->db->join('kode_transaksi','kode_transaksi.kd_transaksi=buku_umum.kode_transaksi','left');
      $this->db->where('kode_transaksi.status','Kas Toko');
      if(empty($id)){
      }else{
        $this->db->where('kode_transaksi.kode',$id);
      }
      if(empty($tgl)):
      //$this->db->like('buku_umum.tanggal',$tgl_saiki);
      else:
      $this->db->where('buku_umum.tanggal >=', $tgl);
      $this->db->where('buku_umum.tanggal <=', $tgl1);
    //  $this->db->where('buku_umum.id_user',$ope);
      endif;
      $this->db->order_by('buku_umum.tanggal','ASC');
      $query = $this->db->get('buku_umum');
      return $query;
    }
    function ttl_buku_toko234($stat = null,$stat1 = null,$idne = null,$op=null,$deb){
      (is_null($stat)) ? $tgl='' : $tgl = $stat;
      (is_null($stat1)) ? $tgl1='' : $tgl1 = $stat1;
      (is_null($idne)) ? $id='' : $id = $idne;
      (is_null($op)) ? $ope='' : $ope = $op;

      $tgl_saiki = date('Y-m');
      $this->db->select('SUM('.$deb.') as total');
      $this->db->where('alat_bayar',$idne);
      if(empty($id)){
      }else{
        // $this->db->where('kode_transaksi.kode',$id);
      }
      if(empty($tgl)):
      //$this->db->like('buku_umum.tanggal',$tgl_saiki);
      else:
      $this->db->where('buku_umum.tanggal >=', $tgl);
      $this->db->where('buku_umum.tanggal <=', $tgl1);
    //  $this->db->where('buku_umum.id_user',$ope);
      endif;
      $this->db->order_by('buku_umum.tanggal','ASC');
      $query = $this->db->get('buku_umum')->row();
      return $query;
    }
    function ttl_buku_toko23($stat = null,$stat1 = null,$idne = null,$op=null,$deb){
      (is_null($stat)) ? $tgl='' : $tgl = $stat;
      (is_null($stat1)) ? $tgl1='' : $tgl1 = $stat1;
      (is_null($idne)) ? $id='' : $id = $idne;
      (is_null($op)) ? $ope='' : $ope = $op;

      $tgl_saiki = date('Y-m');
      $this->db->select('SUM('.$deb.') as total');
      $this->db->where('alat_bayar','PPUTKT');
      if(empty($id)){
      }else{
        // $this->db->where('kode_transaksi.kode',$id);
      }
      if(empty($tgl)):
      //$this->db->like('buku_umum.tanggal',$tgl_saiki);
      else:
      $this->db->where('buku_umum.tanggal >=', $tgl);
      $this->db->where('buku_umum.tanggal <=', $tgl1);
    //  $this->db->where('buku_umum.id_user',$ope);
      endif;
      $this->db->order_by('buku_umum.tanggal','ASC');
      $query = $this->db->get('buku_umum')->row();
      return $query;
    }
    function getRowsQ($params = array()){
        $this->db->select('*');
        $this->db->from('buku_umum');
        $this->db->join('kode_transaksi','kode_transaksi.kd_transaksi=buku_umum.kode_transaksi','left');
        $this->db->where('kode_transaksi.status','Kas Anggota');
        //filter data by searched keywords
        if(!empty($params['search']['keywords'])){
          $this->db->like('buku_umum.kode_transaksi',$params['search']['keywords']);
          $this->db->or_like('buku_umum.keterangan',$params['search']['keywords']);
          $this->db->or_like('buku_umum.debit',$params['search']['keywords']);
          $this->db->or_like('buku_umum.kredit',$params['search']['keywords']);
          $this->db->or_like('buku_umum.sumber_dana',$params['search']['keywords']);
          $this->db->or_like('buku_umum.alat_bayar',$params['search']['keywords']);
        }
        // filter kode
        if(!empty($params['search']['filter'])){
          $this->db->where('kode_transaksi.kode',$params['search']['filter']);
        }
        // filter tanggal
        if(!empty($params['search']['start_tgl']) && !empty($params['search']['end_tgl'])){
          $this->db->where('buku_umum.tanggal >=', $params['search']['start_tgl']);
          $this->db->where('buku_umum.tanggal <=', $params['search']['end_tgl']);
        }
        // urutan data desc / asc
        if(!empty($params['search']['sortBy'])){
            $this->db->order_by('buku_umum.no_urut',$params['search']['sortBy']);
            $this->db->order_by('buku_umum.tanggal',$params['search']['sortBy']);
        }else{
          $this->db->order_by('buku_umum.no_urut','ASC');
          $this->db->order_by('buku_umum.tanggal','ASC');
        }
        //set start and limit
        if(array_key_exists("start",$params) && array_key_exists("limit",$params)){
            $this->db->limit($params['limit'],$params['start']);
        }elseif(!array_key_exists("start",$params) && array_key_exists("limit",$params)){
            $this->db->limit($params['limit']);
        }
        //get records
        $query = $this->db->get();
        //return fetched data
        return ($query->num_rows() > 0)?$query->result():[];
    }
    function getRowsQ2($params = array()){
        $this->db->select('*');
        $this->db->from('buku_umum');
        $this->db->join('kode_transaksi','kode_transaksi.kd_transaksi=buku_umum.kode_transaksi','left');
        $this->db->where('kode_transaksi.status','Kas Anggota');
        //filter data by searched keywords
        if(!empty($params['search']['keywords'])){
          $this->db->like('buku_umum.kode_transaksi',$params['search']['keywords']);
          $this->db->or_like('buku_umum.keterangan',$params['search']['keywords']);
          $this->db->or_like('buku_umum.debit',$params['search']['keywords']);
          $this->db->or_like('buku_umum.kredit',$params['search']['keywords']);
          $this->db->or_like('buku_umum.sumber_dana',$params['search']['keywords']);
          $this->db->or_like('buku_umum.alat_bayar',$params['search']['keywords']);
        }else{
          $this->db->order_by('buku_umum.tanggal','ASC');
        }
        // filter kode
        if(!empty($params['search']['filter'])){
          $this->db->where('kode_transaksi.kode',$params['search']['filter']);
        }
        // filter tanggal
        if(!empty($params['search']['start_tgl']) && !empty($params['search']['end_tgl'])){
          $this->db->where('buku_umum.tanggal >=', $params['search']['start_tgl']);
          $this->db->where('buku_umum.tanggal <=', $params['search']['end_tgl']);
        }
        // urutan data desc / asc
        if(!empty($params['search']['sortBy'])){
          $this->db->order_by('buku_umum.no_urut',$params['search']['sortBy']);
          $this->db->order_by('buku_umum.tanggal',$params['search']['sortBy']);
        }else{
          $this->db->order_by('buku_umum.no_urut','ASC');
          $this->db->order_by('buku_umum.tanggal','ASC');
        }
        //set start and limit
        if(array_key_exists("start",$params) && array_key_exists("limit",$params)){
            $this->db->limit($params['limit'],$params['start']);
        }elseif(!array_key_exists("start",$params) && array_key_exists("limit",$params)){
            $this->db->limit($params['limit']);
        }
        //get records
        $query = $this->db->get();
        //return fetched data
        return ($query->num_rows() > 0)?$query->row():[];
    }
    function list_buku_umum_anggota2($stat = null,$stat1 = null,$idne = null,$op=null){
      (is_null($stat)) ? $tgl='' : $tgl = $stat;
      (is_null($stat1)) ? $tgl1='' : $tgl1 = $stat1;
      (is_null($idne)) ? $id='' : $id = $idne;
      (is_null($op)) ? $ope='' : $ope = $op;

      $tgl_saiki = date('Y-m');
      $this->db->join('kode_transaksi','kode_transaksi.kd_transaksi=buku_umum.kode_transaksi','left');
      $this->db->where('kode_transaksi.status','Kas Anggota');
      if(empty($id)){
      }else{
        $this->db->where('kode_transaksi.kode',$id);
      }
      if(empty($tgl)):
      //$this->db->like('buku_umum.tanggal',$tgl_saiki);
      else:
      $this->db->where('buku_umum.tanggal >=', $tgl);
      $this->db->where('buku_umum.tanggal <=', $tgl1);
    //  $this->db->where('buku_umum.id_user',$ope);
      endif;
      $this->db->order_by('buku_umum.tanggal','ASC');
      $query = $this->db->get('buku_umum');
      return $query;
    }
    function list_general_book($stat=null,$stat1=null){
      (is_null($stat)) ? $tgl='' : $tgl = $stat;
      (is_null($stat1)) ? $tgl1='' : $tgl1 = $stat1;
      $tgl_saiki = date('Y-m');
      $this->db->join('pembeli','penjualan_barang.nama_pembeli=pembeli.kd_pelanggan','left');
      if(empty($tgl)){}else{
      $this->db->where('penjualan_barang.tanggal_penjualan >=',$stat);
      $this->db->where('penjualan_barang.tanggal_penjualan <=',$stat1);
      }
      $this->db->where('penjualan_barang.status !=','0');
      $query = $this->db->get('penjualan_barang');
      return $query;
    }
    function sum_list_general_book($stat){
      $this->db->select('SUM(bayar) as bayarx');
      $this->db->from('penjualan_barang');
      $this->db->where('status',$stat);
      $query = $this->db->get();
      return $query;
    }
    function sum_list_general_book2($stat,$statq = null,$stat1=null){
      (is_null($statq)) ? $tgl='' : $tgl = $statq;
      (is_null($stat1)) ? $tgl1='' : $tgl1 = $stat1;
      $this->db->select('SUM(penjualan_barang.bayar) as bayarx');
      $this->db->join('penjualan_barang','penjualan_barang.kd_penjualan=buku_umum2.kd_penjualan','left');
      $this->db->where('penjualan_barang.status',$stat);
      if(empty($tgl)){}else{
      $this->db->where('penjualan_barang.tanggal_penjualan >=',$tgl);
      $this->db->where('penjualan_barang.tanggal_penjualan <=',$tgl1);
      }
      $this->db->where('penjualan_barang.status !=','0');
      $query = $this->db->get('buku_umum2');
      return $query;
    }
    function list_general_book_new($stat=null,$stat1=null){
      (is_null($stat)) ? $tgl='' : $tgl = $stat;
      (is_null($stat1)) ? $tgl1='' : $tgl1 = $stat1;
      $this->db->join('penjualan_barang','penjualan_barang.kd_penjualan=buku_umum2.kd_penjualan','left');
      $this->db->where('penjualan_barang.status !=','0');
      if(empty($tgl)){}else{
      $this->db->where('penjualan_barang.tanggal_penjualan >=',$tgl);
      $this->db->where('penjualan_barang.tanggal_penjualan <=',$tgl1);
      }
      $query = $this->db->get('buku_umum2');
      return $query;
    }
    // function list_general_book($stat=null,$stat1=null){
    //   (is_null($stat)) ? $tgl='' : $tgl = $stat;
    //   (is_null($stat1)) ? $tgl1='' : $tgl1 = $stat1;
    //     $this->db->select('*');
    //     $this->db->from('penjualan_barang');
    //     $this->db->join('penjualan_sementara','penjualan_barang.kd_nota = penjualan_sementara.kd_nota','left');
    //     $this->db->join('barang','penjualan_sementara.kode_barang=barang.kode_barang','left');
    //     $this->db->join('kategori_barang','barang.kd_kategori_barang=kategori_barang.id_kategori','left');
    //     $this->db->join('jenis_barang','barang.kd_jenis_barang=jenis_barang.id_jenis_barang','left');
    //     $this->db->join('satuan_barang','barang.satuan_barang=satuan_barang.id_satuan','left');
    //     $this->db->where('penjualan_barang.status !=','0');
    //     $this->db->where('penjualan_barang.tanggal_penjualan >=',$stat);
    //     $this->db->where('penjualan_barang.tanggal_penjualan <=',$end);
    //     $this->db->where('penjualan_barang.nama_kasir',$user);
    //     $this->db->group_by('penjualan_sementara.id_cek');
    //     $query = $this->db->get();
    //     return $query;
    // }
    function list_buku_umum_monitoring($stat = null,$stat1 = null,$idne = null,$opo,$opo1){
      (is_null($stat)) ? $tgl='' : $tgl = $stat;
      (is_null($stat1)) ? $tgl1='' : $tgl1 = $stat1;
      (is_null($idne)) ? $id='' : $id = $idne;
      $tgl_saiki = date('Y-m');
      $this->db->join('kode_transaksi2','kode_transaksi2.kd_transaksi=buku_umum.kode_transaksi','left');
      if($opo == 'M3'){
        $this->db->where('kode_transaksi2.kode','BSMKA');
        $this->db->or_where('kode_transaksi2.kode','JSMKA');
        $this->db->or_where('kode_transaksi2.kode','JSptMKA');
        $this->db->or_where('kode_transaksi2.kode','BSptKA');
        $this->db->or_where('kode_transaksi2.kode','JTMKA');
        $this->db->or_where('kode_transaksi2.kode','BTMKA');
      }elseif($opo == 'M4'){
        $this->db->where('kode_transaksi2.kode','JSMKA');
        $this->db->or_where('kode_transaksi2.kode','JTMKA');
        $this->db->or_where('kode_transaksi2.kode','JSPKA');
        $this->db->or_where('kode_transaksi2.kode','JSptMKA');
        $this->db->or_where('kode_transaksi2.kode','JNKKA');
      }elseif($opo == 'M5'){
        $this->db->where('kode_transaksi2.kode','BSMKA');
        $this->db->or_where('kode_transaksi2.kode','JSMKA');
        $this->db->or_where('kode_transaksi2.kode','JSPKA');
        $this->db->or_where('kode_transaksi2.kode','JSptMKA');
        $this->db->or_where('kode_transaksi2.kode','BSptKA');
        $this->db->or_where('kode_transaksi2.kode','JTMKA');
        $this->db->or_where('kode_transaksi2.kode','BTMKA');
      }else{
      $this->db->where('kode_transaksi2.kode',$opo);
      $this->db->or_where('kode_transaksi2.kode',$opo1);
      }
      if(empty($tgl)):
      $this->db->like('buku_umum.tanggal',$tgl_saiki);
      else:
      $this->db->where('buku_umum.tanggal >=', $tgl);
      $this->db->where('buku_umum.tanggal <=', $tgl1);
      $this->db->where('buku_umum.id_user',$id);
      endif;
      $query = $this->db->get('buku_umum');
      return $query;
    }
    function total_tagihan_ketua($stat=null){
      (is_null($stat)) ? $tgl='' : $tgl = $stat;
      $tgl_saiki = date('Y-m');
      $this->db->select('SUM(jumlah_nominal) as jml');
      if(empty($tgl)):
      $this->db->like('tanggal',$tgl_saiki);
      else:
      $this->db->where('tanggal >=', $tgl);
      $this->db->where('tanggal <=', $tgl1);
      endif;
      $query = $this->db->get('tagihan_ketua');
      return $query;
    }
    function simpanan_pokok_ac($tgl,$tgl1,$id){
      $this->db->where('created >=',$tgl);
      $this->db->where('created <=',$tgl1);
      $this->db->where('id_anggota' , $id);
      $query = $this->db->get('simpanan_pokok');
      return $query;
    }
    function piutang_kas_anggota($tgl,$tgl1,$id){
      $this->db->where('tanggal_pinjam >=',$tgl);
      $this->db->where('tanggal_pinjam <=',$tgl1);
      $this->db->where('id_anggota' , $id);
      $query = $this->db->get('piutang_kas_anggota');
      return $query;
    }
    function piutang_kas_anggota2($tgl,$id){
      $this->db->like('tanggal_pinjam',$tgl);
      $this->db->where('id_anggota' , $id);
      $query = $this->db->get('piutang_kas_anggota');
      return $query;
    }
    function piutang_kas_anggota3($tgl,$tgl1,$id){
      $this->db->where('tanggal_pinjam >=',$tgl);
      $this->db->where('tanggal_pinjam <=',$tgl1);
      $this->db->where('id_anggota' , $id);
      $query = $this->db->get('piutang_kas_anggota');
      return $query;
    }
    // function tagihan_toko($stat=null){
    //   (is_null($stat)) ? $tgl='' : $tgl = $stat;
    //   $tgl_saiki = date('Y-m');
    //   $this->db->like('tagihan_ketua.tanggal',$tgl_saiki);
    //   if(empty($tgl)):
    //   $this->db->like('tagihan_ketua.tanggal',$tgl_saiki);
    //   else:
    //   $this->db->where('tagihan_ketua.tanggal >=', $tgl);
    //   $this->db->where('buku_umum.tanggal <=', $tgl1);
    //   $this->db->where('tagihan_ketua.id_user',$id);
    //   endif;
    // }
    function list_bank_toko($stat = null,$stat1 = null,$idne = null,$kdt = null,$opo){
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
      $this->db->where('buku_bank.status',$opo);
      $this->db->order_by('buku_bank.tanggal','ASC');
      $query = $this->db->get('buku_bank');
      return $query;
    }
    function cari_barangKar($kd){
      $this->db->select('id_barang,kode_barang,tanggal_expired,harga_pokok,kd_jenis_barang,stock,nama_barang');
      $this->db->from('barang');
      $this->db->where('kode_barang',$kd);
      $query = $this->db->get();
      return $query;
    }
    function sortPembeli($kd){
      $this->db->select('kd_pembeli,kd_pelanggan,nama_pembeli');
      $this->db->from('pembeli');
      $this->db->where('kd_pembeli',$kd);
      $query = $this->db->get();
      return $query;
    }
    function cek_akhir($name,$or,$table){
        $this->db->order_by($name, $or);
        $this->db->limit('1');
        $query = $this->db->get($table);
        return $query;
    }
    function cek_akhir2($name,$or,$table,$where){
        $this->db->where($where);
        $this->db->order_by($name, $or);
        $this->db->limit('1');
        $query = $this->db->get($table);
        return $query;
    }
    function cek_header_makanan($date){
      $this->db->select('*');
      $this->db->from('barang');
      $this->db->where('kd_jenis_barang','2');
      $this->db->where('tanggal_expired <=',$date);
      $query = $this->db->get();
      return $query;
    }
    function data_pelanggan(){
      $this->db->select('kd_pembeli,kd_pelanggan,nama_pembeli,sumber_dana,status_keanggotaan');
      $this->db->from('pembeli');
      $query = $this->db->get();
      return $query;
    }
    function cek_header_minuman($date){
      $this->db->select('*');
      $this->db->from('barang');
      $this->db->where('kd_jenis_barang','3');
      $this->db->where('tanggal_expired <=',$date);
      $query = $this->db->get();
      return $query;
    }
    function daftar_hutang_pembelian(){
        $this->db->select('*');
        $this->db->from('join_kredit_pembelian');
        $this->db->order_by('id_join_kredit','DESC');
        $query = $this->db->get();
        return $query;
    }
    function detail_join_hutang_pembelian(){
        $this->db->select('*');
        $this->db->from('join_pembayaran_kredit');
        $query = $this->db->get();
        return $query;
    }
    function barang_ex($tabel,$tgl_ex){
        $this->db->select('*');
        $this->db->from($tabel);
        $this->db->where('tanggal_expired <=',$tgl_ex);
        $query = $this->db->get();
        return $query;
    }
    function detail_hutang_join_pembayaran($id){
        $this->db->select('*');
        $this->db->from('join_pembayaran_kredit');
        $this->db->where('id_join_kredit',$id);
        $query = $this->db->get();
        return $query;
    }
    function barang_kredit_join(){
        $this->db->select('*');
        $this->db->from('pembelian_barang');
        $this->db->where('status','kredit');
        $query = $this->db->get();
        return $query;
    }
    function detail_join_pembelian_barang($id){
        $this->db->select('*');
        $this->db->from('pembelian_barang');
        $this->db->join('barang','pembelian_barang.kode_barang=barang.kode_barang','left');
        $this->db->join('kategori_barang','barang.kd_kategori_barang=kategori_barang.id_kategori','left');
        $this->db->join('jenis_barang','barang.kd_jenis_barang=jenis_barang.id_jenis_barang','left');
        $this->db->join('satuan_barang','barang.satuan_barang=satuan_barang.id_satuan','left');
        $this->db->where('kd_pembelian',$id);
        $query = $this->db->get();
        return $query;
    }
    function cari_hari_pembelian($hari1,$hari2){
        $this->db->select('*');
        $this->db->from('pembelian_barang');
        $this->db->join('barang','pembelian_barang.kode_barang=barang.kode_barang','left');
        $this->db->join('supplier','pembelian_barang.kode_supplier=supplier.kd_supplier','left');
        $this->db->join('kategori_barang','barang.kd_kategori_barang=kategori_barang.id_kategori','left');
        $this->db->join('jenis_barang','barang.kd_jenis_barang=jenis_barang.id_jenis_barang','left');
        $this->db->join('satuan_barang','barang.satuan_barang=satuan_barang.id_satuan','left');
        $this->db->where('tanggal_pembelian >=',$hari1);
        $this->db->where('tanggal_pembelian <=',$hari2);
        $this->db->order_by('tanggal_pembelian','ASC');
        $query = $this->db->get();
        return $query;
    }
    function semua_kas($hari1,$hari2){
        (is_null($hari1)) ? $har1='' : $har1=$hari1;
        (is_null($hari2)) ? $har2='' : $har2=$hari2;
        $this->db->select('*');
        $this->db->from('kas');
        $this->db->where('tanggal_transaksi >=',$har1);
        $this->db->where('tanggal_transaksi <=',$har2);
        $this->db->order_by('tanggal_transaksi','ASC');
        $query = $this->db->get();
        return $query;
    }
    function total_kas_debet($hari1 = null,$hari2 = null){
        (is_null($hari1)) ? $har1='' : $har1=$hari1;
        (is_null($hari2)) ? $har2='' : $har2=$hari2;
        $this->db->select('SUM(debet) as total_debet');
        $this->db->from('kas');
        $this->db->where('tanggal_transaksi >=',$har1);
        $this->db->where('tanggal_transaksi <=',$har2);
        $query = $this->db->get();
        return $query;
    }
    function total_kas_kredit($hari1 = null,$hari2 = null){
        (is_null($hari1)) ? $har1='' : $har1=$hari1;
        (is_null($hari2)) ? $har2='' : $har2=$hari2;
        $this->db->select('SUM(kredit) as total_kredit');
        $this->db->from('kas');
        $this->db->where('tanggal_transaksi >=',$har1);
        $this->db->where('tanggal_transaksi <=',$har2);
        $query = $this->db->get();
        return $query;
    }
    function sum_saldo_pembelian(){
        $this->db->select_sum('total_harga');
        $this->db->from('pembelian_barang');
        $query = $this->db->get();
        return $query;
    }
    function cari_operator_pembelian($operator){
        $this->db->select('*');
        $this->db->from('pembelian_barang');
        $this->db->join('barang','pembelian_barang.kode_barang=barang.kode_barang','left');
        $this->db->join('supplier','pembelian_barang.kode_supplier=supplier.kd_supplier','left');
        $this->db->join('kategori_barang','barang.kd_kategori_barang=kategori_barang.id_kategori','left');
        $this->db->join('jenis_barang','barang.kd_jenis_barang=jenis_barang.id_jenis_barang','left');
        $this->db->join('satuan_barang','barang.satuan_barang=satuan_barang.id_satuan','left');
        $this->db->where('id_users',$operator);
        $this->db->order_by('tanggal_pembelian','DESC');
        $query = $this->db->get();
        return $query;
    }
    function load_kode_barang_data($kode_barang){
        $this->db->select('*');
        $this->db->from('barang');
        $this->db->join('kategori_barang','barang.kd_kategori_barang=kategori_barang.id_kategori','left');
        $this->db->join('jenis_barang','barang.kd_jenis_barang=jenis_barang.id_jenis_barang','left');
        $this->db->join('satuan_barang','barang.satuan_barang=satuan_barang.id_satuan','left');
        $this->db->where('kode_barang',$kode_barang);
        $query = $this->db->get();
        return $query;
    }
    function cariAtasNama($like){
        $this->db->select('*');
        $this->db->from('hutang_penjualan');
        $this->db->like('atas_nama',$like);
        $this->db->where('status_lunas !=','lunas');
        $query = $this->db->get();
        return $query;
    }
    function barang_suplier(){
        $this->db->select('*');
        $this->db->from('barang');
        $this->db->join('jenis_barang','barang.kd_jenis_barang=jenis_barang.id_jenis_barang','left');
        $this->db->join('kategori_barang','barang.kd_kategori_barang=kategori_barang.id_kategori','left');
        $this->db->join('satuan_barang','barang.satuan_barang=satuan_barang.id_satuan','left');
        $this->db->order_by('id_barang','DESC');
        $query = $this->db->get();
        return $query;
    }
    function pembelian_barang(){
        $this->db->select('*');
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
    function cek_kredit(){
        $this->db->select('*');
        $this->db->from('pembelian_barang');
        $this->db->where('status','kredit');
        $this->db->order_by('kd_pembelian','DESC');
        $this->db->limit(1);
        $query = $this->db->get();
        return $query;
    }
    function cek_join_kredit(){
        $this->db->select('*');
        $this->db->from('pembelian_barang');
        $this->db->order_by('kd_pembelian','DESC');
        $this->db->limit(1);
        $query = $this->db->get();
        return $query;
    }
    function cek_stock_input($kode_barang,$kode_supplier,$nama_barang){
        $this->db->select('*');
        $this->db->from('pembelian_barang');
        $this->db->where('kode_barang',$kode_barang);
        $this->db->where('kode_supplier',$kode_supplier);
        $this->db->where('nama_barang',$nama_barang);
        $this->db->order_by('kd_pembelian','DESC');
        $this->db->limit(1);
        $query = $this->db->get();
        return $query;
    }
    function list_checkout($kdj){
        $this->db->select('*');
        $this->db->from('penjualan_barang');
        $this->db->join('penjualan_sementara','penjualan_barang.kd_nota=penjualan_sementara.kd_nota','left');
        $this->db->join('barang','penjualan_sementara.kode_barang=barang.kode_barang','left');
        $this->db->where('penjualan_barang.kd_penjualan',$kdj);
        $query = $this->db->get();
        return $query;
    }
    function cek_kode_barang($kd){
        $this->db->select('*');
        $this->db->from('barang');
        $this->db->where('kode_barang',$kd);
        $this->db->order_by('id_barang','DESC');
        $this->db->limit(1);
        $query = $this->db->get();
        return $query;
    }
    function rekap_penjualan_bulan(){
        $this->db->select('DISTINCT(bulan_beli)');
        $this->db->from('penjualan_barang');
        $this->db->order_by('bulan_beli','ASC');
        $query = $this->db->get();
        return $query;
    }
    function cari_rekap_penjualan_bulan($bulan1,$bulan2,$thn){
        $this->db->select('DISTINCT(bulan_beli)');
        $this->db->from('penjualan_barang');
        $this->db->where('bulan_beli >=',$bulan1);
        $this->db->where('bulan_beli <=',$bulan2);
        $this->db->where('tahun_n',$thn);
        $this->db->order_by('bulan_beli','ASC');
        $query = $this->db->get();
        return $query;
    }
    function laporan_masuk(){
        $this->db->select('*');
        $this->db->from('penjualan_barang');
        $this->db->order_by('penjualan_barang.kd_penjualan','DESC');
        $query = $this->db->get();
        return $query;
    }
    function cari_tahun_rekap_penjualan($tahun1,$tahun2){
        $this->db->select('DISTINCT(tahun_n)');
        $this->db->from('penjualan_barang');
        $this->db->where('tahun_n >=',$tahun1);
        $this->db->where('tahun_n <=',$tahun2);
        $this->db->order_by('tahun_n','ASC');
        $query = $this->db->get();
        return $query;
    }
    function laporan_kas_masuk(){
        $this->db->select('DISTINCT(tanggal_transaksi) as tgl_transaksi,kas.debet,kas.kredit,kas.kd_penjualan,kas.kd_pembelian');
        $this->db->from('kas');
        $this->db->join('penjualan_barang','kas.kd_penjualan = penjualan_barang.kd_penjualan','left');
        $this->db->join('penjualan_sementara','penjualan_barang.kd_nota = penjualan_sementara.kd_nota','left');
        $this->db->join('barang','penjualan_sementara.kode_barang=barang.kode_barang','left');
        $this->db->join('kategori_barang','barang.kd_kategori_barang=kategori_barang.id_kategori','left');
        $this->db->join('jenis_barang','barang.kd_jenis_barang=jenis_barang.id_jenis_barang','left');
        $this->db->join('satuan_barang','barang.satuan_barang=satuan_barang.id_satuan','left');
        $this->db->group_by('penjualan_sementara.id_cek');
        $query = $this->db->get();
        return $query;
    }
    function cari_debet_kas($hari1,$hari2){
        $this->db->select('DISTINCT(tanggal_transaksi) as tgl_transaksi,kas.debet,kas.kredit,kas.kd_penjualan,kas.kd_pembelian');
        $this->db->from('kas');
        $this->db->join('penjualan_barang','kas.kd_penjualan = penjualan_barang.kd_penjualan','left');
        $this->db->join('penjualan_sementara','penjualan_barang.kd_nota = penjualan_sementara.kd_nota','left');
        $this->db->join('barang','penjualan_sementara.kode_barang=barang.kode_barang','left');
        $this->db->join('kategori_barang','barang.kd_kategori_barang=kategori_barang.id_kategori','left');
        $this->db->join('jenis_barang','barang.kd_jenis_barang=jenis_barang.id_jenis_barang','left');
        $this->db->join('satuan_barang','barang.satuan_barang=satuan_barang.id_satuan','left');
        $this->db->where('penjualan_barang.tanggal_penjualan >=',$hari1);
        $this->db->where('penjualan_barang.tanggal_penjualan <=',$hari2);
        $query = $this->db->get();
        return $query;
    }
    function cari_kredit_kas($hari1,$hari2){
        $this->db->select('DISTINCT(tanggal_transaksi) as tgl_transaksi,kas.debet,kas.kredit,kas.kd_penjualan,kas.kd_pembelian');
        $this->db->from('kas');
        $this->db->join('pembelian_barang','kas.kd_penjualan = pembelian_barang.kd_pembelian','left');
        $this->db->join('barang','pembelian_barang.kode_barang=barang.kode_barang','left');
        $this->db->join('kategori_barang','barang.kd_kategori_barang=kategori_barang.id_kategori','left');
        $this->db->join('jenis_barang','barang.kd_jenis_barang=jenis_barang.id_jenis_barang','left');
        $this->db->join('satuan_barang','barang.satuan_barang=satuan_barang.id_satuan','left');
        $this->db->where('kas.tanggal_transaksi >=',$hari1);
        $this->db->where('kas.tanggal_transaksi <=',$hari2);
        $query = $this->db->get();
        return $query;
    }
    function laporan_kas_keluar(){
        $this->db->select('DISTINCT(tanggal_transaksi) as tgl_transaksi,kas.debet,kas.kredit,kas.kd_penjualan,kas.kd_pembelian');
        $this->db->from('kas');
        $this->db->join('pembelian_barang','kas.kd_penjualan = pembelian_barang.kd_pembelian','left');
        $this->db->join('barang','pembelian_barang.kode_barang=barang.kode_barang','left');
        $this->db->join('kategori_barang','barang.kd_kategori_barang=kategori_barang.id_kategori','left');
        $this->db->join('jenis_barang','barang.kd_jenis_barang=jenis_barang.id_jenis_barang','left');
        $this->db->join('satuan_barang','barang.satuan_barang=satuan_barang.id_satuan','left');
        $query = $this->db->get();
        return $query;
    }
    function detail_kas_masuk($kd){
        $this->db->select('*');
        $this->db->from('penjualan_barang');
        $this->db->join('penjualan_sementara','penjualan_barang.kd_nota = penjualan_sementara.kd_nota','left');
        $this->db->join('barang','penjualan_sementara.kode_barang=barang.kode_barang','left');
        $this->db->join('kategori_barang','barang.kd_kategori_barang=kategori_barang.id_kategori','left');
        $this->db->join('jenis_barang','barang.kd_jenis_barang=jenis_barang.id_jenis_barang','left');
        $this->db->join('satuan_barang','barang.satuan_barang=satuan_barang.id_satuan','left');
        $this->db->join('pembeli','penjualan_barang.nama_pembeli=pembeli.kd_pelanggan','left');
        $this->db->where('penjualan_sementara.kd_nota',$kd);
        $query = $this->db->get();
        return $query;
    }
    function detail_kas_keluar2($kd){
        $this->db->select('*');
        $this->db->from('pembelian_barang');
        $this->db->join('barang','pembelian_barang.kode_barang=barang.kode_barang','left');
        $this->db->join('kategori_barang','barang.kd_kategori_barang=kategori_barang.id_kategori','left');
        $this->db->join('jenis_barang','barang.kd_jenis_barang=jenis_barang.id_jenis_barang','left');
        $this->db->join('satuan_barang','barang.satuan_barang=satuan_barang.id_satuan','left');
        $this->db->join('users','pembelian_barang.id_users=users.id','left');
        $this->db->where('pembelian_barang.kd_pembelian',$kd);
        $query = $this->db->get();
        return $query;
    }
    function sum_rekap_penjualan_bulan($like){
        $this->db->select('SUM(total_harga) as total');
        $this->db->from('penjualan_barang');
        $this->db->like('bulan_beli',$like);
        $this->db->order_by('bulan_beli','ASC');
        $query = $this->db->get();
        return $query;
    }
    function sum_rekap_penjualan_tahun($like){
        $this->db->select('SUM(total_harga) as total');
        $this->db->from('penjualan_barang');
        $this->db->like('tahun_n',$like);
        $this->db->order_by('tahun_n','ASC');
        $query = $this->db->get();
        return $query;
    }
    function list_data_penjualan($month,$year){
        $this->db->select('*');
        $this->db->from('penjualan_barang');
        $this->db->join('penjualan_sementara','penjualan_barang.kd_nota = penjualan_sementara.kd_nota','left');
        $this->db->join('barang','penjualan_sementara.kode_barang=barang.kode_barang','left');
        $this->db->join('kategori_barang','barang.kd_kategori_barang=kategori_barang.id_kategori','left');
        $this->db->join('jenis_barang','barang.kd_jenis_barang=jenis_barang.id_jenis_barang','left');
        $this->db->join('satuan_barang','barang.satuan_barang=satuan_barang.id_satuan','left');
        $this->db->where('penjualan_barang.status !=','0');
        $this->db->where('YEAR(penjualan_barang.tanggal_penjualan)',$year);
        $this->db->where('MONTH(penjualan_barang.tanggal_penjualan)',$month);
        // $this->db->where('penjualan_sementara.kd_nota','PJL20191231-9022');
        $this->db->order_by('penjualan_barang.tanggal_penjualan','ASC');

        $this->db->group_by('penjualan_sementara.id_cek');
        $query = $this->db->get();
        return $query;
    }
    function list_data_penjualan_test(){
        $this->db->select('*');
        $this->db->from('penjualan_barang');
        $this->db->join('penjualan_sementara','penjualan_barang.kd_nota = penjualan_sementara.kd_nota','left');
        $this->db->join('barang','penjualan_sementara.kode_barang=barang.kode_barang','left');
        $this->db->join('kategori_barang','barang.kd_kategori_barang=kategori_barang.id_kategori','left');
        $this->db->join('jenis_barang','barang.kd_jenis_barang=jenis_barang.id_jenis_barang','left');
        $this->db->join('satuan_barang','barang.satuan_barang=satuan_barang.id_satuan','left');
        $this->db->where('penjualan_barang.status !=','0');
        $this->db->where('penjualan_sementara.kd_nota','PJL20191231-9022');
        $this->db->order_by('penjualan_barang.tanggal_penjualan','ASC');

        $this->db->group_by('penjualan_sementara.id_cek');
        $query = $this->db->get();
        return $query;
    }
     function list_data_penjualan2($id){
        $this->db->select('*');
        $this->db->from('penjualan_barang');
        $this->db->join('penjualan_sementara','penjualan_barang.kd_nota = penjualan_sementara.kd_nota','left');
        $this->db->join('barang','penjualan_sementara.kode_barang=barang.kode_barang','left');
        $this->db->join('kategori_barang','barang.kd_kategori_barang=kategori_barang.id_kategori','left');
        $this->db->join('jenis_barang','barang.kd_jenis_barang=jenis_barang.id_jenis_barang','left');
        $this->db->join('satuan_barang','barang.satuan_barang=satuan_barang.id_satuan','left');
        $this->db->where('penjualan_barang.status !=','0');
        $this->db->where('penjualan_barang.kd_penjualan',$id);
        $this->db->group_by('penjualan_sementara.id_cek');
        $query = $this->db->get();
        return $query;
    }
    function laba_rugi_inter_seragam(){
        $this->db->select('*');
        $this->db->from('penjualan_barang');
        $this->db->join('penjualan_sementara','penjualan_barang.kd_nota = penjualan_sementara.kd_nota','left');
        $this->db->join('barang','penjualan_sementara.kode_barang=barang.kode_barang','left');
        $this->db->join('kategori_barang','barang.kd_kategori_barang=kategori_barang.id_kategori','left');
        $this->db->join('jenis_barang','barang.kd_jenis_barang=jenis_barang.id_jenis_barang','left');
        $this->db->join('satuan_barang','barang.satuan_barang=satuan_barang.id_satuan','left');
        $this->db->where('penjualan_barang.status !=','0');
        $this->db->where('barang.kd_jenis_barang !=','1');
        $this->db->where('barang.kd_jenis_barang !=','2');
        $this->db->where('barang.kd_jenis_barang !=','3');
        $this->db->where('barang.kd_jenis_barang !=','9');
        $this->db->group_by('penjualan_sementara.id_cek');
        $query = $this->db->get();
        return $query;
    }
    function penjualan_intern_all(){
        $this->db->select('*');
        $this->db->from('penjualan_barang');
        $this->db->join('penjualan_sementara','penjualan_barang.kd_nota = penjualan_sementara.kd_nota','left');
        $this->db->join('barang','penjualan_sementara.kode_barang=barang.kode_barang','left');
        $this->db->join('kategori_barang','barang.kd_kategori_barang=kategori_barang.id_kategori','left');
        $this->db->join('jenis_barang','barang.kd_jenis_barang=jenis_barang.id_jenis_barang','left');
        $this->db->join('satuan_barang','barang.satuan_barang=satuan_barang.id_satuan','left');
        $this->db->join('pembeli','penjualan_barang.nama_pembeli=pembeli.kd_pelanggan','left');
        $this->db->like('penjualan_barang.nama_pembeli','Toko Stikes');
        $this->db->where('penjualan_barang.status !=','0');
        $this->db->group_by('penjualan_sementara.id_cek');
        $query = $this->db->get();
        return $query;
    }
    function cari_penjualan_intern_all($hari1,$hari2){
        $this->db->select('*');
        $this->db->from('penjualan_barang');
        $this->db->join('penjualan_sementara','penjualan_barang.kd_nota = penjualan_sementara.kd_nota','left');
        $this->db->join('barang','penjualan_sementara.kode_barang=barang.kode_barang','left');
        $this->db->join('kategori_barang','barang.kd_kategori_barang=kategori_barang.id_kategori','left');
        $this->db->join('jenis_barang','barang.kd_jenis_barang=jenis_barang.id_jenis_barang','left');
        $this->db->join('satuan_barang','barang.satuan_barang=satuan_barang.id_satuan','left');
        $this->db->join('pembeli','penjualan_barang.nama_pembeli=pembeli.kd_pelanggan','left');
        $this->db->like('penjualan_barang.nama_pembeli','Toko Stikes');
        $this->db->where('penjualan_barang.status !=','0');
        $this->db->where('penjualan_barang.tanggal_penjualan >=',$hari1);
        $this->db->where('penjualan_barang.tanggal_penjualan <=',$hari2);
        $this->db->group_by('penjualan_sementara.id_cek');
        $query = $this->db->get();
        return $query;
    }
    function penjualan_belanja_barang(){
        $this->db->select('*');
        $this->db->from('penjualan_barang');
        $this->db->join('penjualan_sementara','penjualan_barang.kd_nota = penjualan_sementara.kd_nota','left');
        $this->db->join('barang','penjualan_sementara.kode_barang=barang.kode_barang','left');
        $this->db->join('kategori_barang','barang.kd_kategori_barang=kategori_barang.id_kategori','left');
        $this->db->join('jenis_barang','barang.kd_jenis_barang=jenis_barang.id_jenis_barang','left');
        $this->db->join('satuan_barang','barang.satuan_barang=satuan_barang.id_satuan','left');
        $this->db->join('pembeli','penjualan_barang.nama_pembeli=pembeli.kd_pelanggan','left');
        $this->db->like('penjualan_barang.nama_pembeli','Toko Stikes');
        $this->db->where('penjualan_barang.status !=','0');
        $this->db->where('barang.kd_kategori_barang !=','2');
        $this->db->where('barang.kd_kategori_barang !=','4');
        $this->db->where('barang.kd_kategori_barang !=','5');
        $this->db->where('barang.kd_kategori_barang !=','7');
        $this->db->group_by('penjualan_sementara.id_cek');
        $query = $this->db->get();
        return $query;
    }
    function cari_penjualan_belanja_barang($hari1,$hari2){
        $this->db->select('*');
        $this->db->from('penjualan_barang');
        $this->db->join('penjualan_sementara','penjualan_barang.kd_nota = penjualan_sementara.kd_nota','left');
        $this->db->join('barang','penjualan_sementara.kode_barang=barang.kode_barang','left');
        $this->db->join('kategori_barang','barang.kd_kategori_barang=kategori_barang.id_kategori','left');
        $this->db->join('jenis_barang','barang.kd_jenis_barang=jenis_barang.id_jenis_barang','left');
        $this->db->join('satuan_barang','barang.satuan_barang=satuan_barang.id_satuan','left');
        $this->db->join('pembeli','penjualan_barang.nama_pembeli=pembeli.kd_pelanggan','left');
        $this->db->like('penjualan_barang.nama_pembeli','Toko Stikes');
        $this->db->where('penjualan_barang.status !=','0');
        $this->db->where('barang.kd_kategori_barang !=','2');
        $this->db->where('barang.kd_kategori_barang !=','4');
        $this->db->where('barang.kd_kategori_barang !=','5');
        $this->db->where('barang.kd_kategori_barang !=','7');
        $this->db->where('penjualan_barang.tanggal_penjualan >=',$hari1);
        $this->db->where('penjualan_barang.tanggal_penjualan <=',$hari2);
        $this->db->group_by('penjualan_sementara.id_cek');
        $query = $this->db->get();
        return $query;
    }
    function penjualan_barang_toko_tunai(){
        $this->db->select('*');
        $this->db->from('penjualan_barang');
        $this->db->join('penjualan_sementara','penjualan_barang.kd_nota = penjualan_sementara.kd_nota','left');
        $this->db->join('barang','penjualan_sementara.kode_barang=barang.kode_barang','left');
        $this->db->join('kategori_barang','barang.kd_kategori_barang=kategori_barang.id_kategori','left');
        $this->db->join('jenis_barang','barang.kd_jenis_barang=jenis_barang.id_jenis_barang','left');
        $this->db->join('satuan_barang','barang.satuan_barang=satuan_barang.id_satuan','left');
        $this->db->join('pembeli','penjualan_barang.nama_pembeli=pembeli.kd_pelanggan','left');
        $this->db->where('penjualan_barang.status','1');
        $this->db->where('barang.kd_kategori_barang','1');
        $this->db->group_by('penjualan_sementara.id_cek');
        $query = $this->db->get();
        return $query;
    }
    function cari_penjualan_barang_toko_tunai($hari1,$hari2){
        $this->db->select('*');
        $this->db->from('penjualan_barang');
        $this->db->join('penjualan_sementara','penjualan_barang.kd_nota = penjualan_sementara.kd_nota','left');
        $this->db->join('barang','penjualan_sementara.kode_barang=barang.kode_barang','left');
        $this->db->join('kategori_barang','barang.kd_kategori_barang=kategori_barang.id_kategori','left');
        $this->db->join('jenis_barang','barang.kd_jenis_barang=jenis_barang.id_jenis_barang','left');
        $this->db->join('satuan_barang','barang.satuan_barang=satuan_barang.id_satuan','left');
        $this->db->join('pembeli','penjualan_barang.nama_pembeli=pembeli.kd_pelanggan','left');
        $this->db->where('penjualan_barang.status','1');
        $this->db->where('barang.kd_kategori_barang','1');
        $this->db->where('penjualan_barang.tanggal_penjualan >=',$hari1);
        $this->db->where('penjualan_barang.tanggal_penjualan <=',$hari2);
        $this->db->group_by('penjualan_sementara.id_cek');
        $query = $this->db->get();
        return $query;
    }
    function penjualan_barang_toko_kredit(){
        $this->db->select('*');
        $this->db->from('penjualan_barang');
        $this->db->join('penjualan_sementara','penjualan_barang.kd_nota = penjualan_sementara.kd_nota','left');
        $this->db->join('barang','penjualan_sementara.kode_barang=barang.kode_barang','left');
        $this->db->join('kategori_barang','barang.kd_kategori_barang=kategori_barang.id_kategori','left');
        $this->db->join('jenis_barang','barang.kd_jenis_barang=jenis_barang.id_jenis_barang','left');
        $this->db->join('satuan_barang','barang.satuan_barang=satuan_barang.id_satuan','left');
        $this->db->join('pembeli','penjualan_barang.nama_pembeli=pembeli.kd_pelanggan','left');
        $this->db->where('penjualan_barang.status','2');
        $this->db->where('barang.kd_kategori_barang','1');
        $this->db->group_by('penjualan_sementara.id_cek');
        $query = $this->db->get();
        return $query;
    }
    function cari_penjualan_barang_toko_kredit($hari1,$hari2){
        $this->db->select('*');
        $this->db->from('penjualan_barang');
        $this->db->join('penjualan_sementara','penjualan_barang.kd_nota = penjualan_sementara.kd_nota','left');
        $this->db->join('barang','penjualan_sementara.kode_barang=barang.kode_barang','left');
        $this->db->join('kategori_barang','barang.kd_kategori_barang=kategori_barang.id_kategori','left');
        $this->db->join('jenis_barang','barang.kd_jenis_barang=jenis_barang.id_jenis_barang','left');
        $this->db->join('satuan_barang','barang.satuan_barang=satuan_barang.id_satuan','left');
        $this->db->join('pembeli','penjualan_barang.nama_pembeli=pembeli.kd_pelanggan','left');
        $this->db->where('penjualan_barang.status','2');
        $this->db->where('barang.kd_kategori_barang','1');
        $this->db->where('penjualan_barang.tanggal_penjualan >=',$hari1);
        $this->db->where('penjualan_barang.tanggal_penjualan <=',$hari2);
        $this->db->group_by('penjualan_sementara.id_cek');
        $query = $this->db->get();
        return $query;
    }
    function penjualan_barang_konsinyasi_tunai(){
        $this->db->select('*');
        $this->db->from('penjualan_barang');
        $this->db->join('penjualan_sementara','penjualan_barang.kd_nota = penjualan_sementara.kd_nota','left');
        $this->db->join('barang','penjualan_sementara.kode_barang=barang.kode_barang','left');
        $this->db->join('kategori_barang','barang.kd_kategori_barang=kategori_barang.id_kategori','left');
        $this->db->join('jenis_barang','barang.kd_jenis_barang=jenis_barang.id_jenis_barang','left');
        $this->db->join('satuan_barang','barang.satuan_barang=satuan_barang.id_satuan','left');
        $this->db->join('pembeli','penjualan_barang.nama_pembeli=pembeli.kd_pelanggan','left');
        $this->db->where('penjualan_barang.status','1');
        $this->db->where('barang.kd_kategori_barang','2');
        $this->db->group_by('penjualan_sementara.id_cek');
        $query = $this->db->get();
        return $query;
    }
    function cari_penjualan_barang_konsinyasi_tunai($hari1,$hari2){
        $this->db->select('*');
        $this->db->from('penjualan_barang');
        $this->db->join('penjualan_sementara','penjualan_barang.kd_nota = penjualan_sementara.kd_nota','left');
        $this->db->join('barang','penjualan_sementara.kode_barang=barang.kode_barang','left');
        $this->db->join('kategori_barang','barang.kd_kategori_barang=kategori_barang.id_kategori','left');
        $this->db->join('jenis_barang','barang.kd_jenis_barang=jenis_barang.id_jenis_barang','left');
        $this->db->join('satuan_barang','barang.satuan_barang=satuan_barang.id_satuan','left');
        $this->db->join('pembeli','penjualan_barang.nama_pembeli=pembeli.kd_pelanggan','left');
        $this->db->where('penjualan_barang.status','1');
        $this->db->where('barang.kd_kategori_barang','2');
        $this->db->where('penjualan_barang.tanggal_penjualan >=',$hari1);
        $this->db->where('penjualan_barang.tanggal_penjualan <=',$hari2);
        $this->db->group_by('penjualan_sementara.id_cek');
        $query = $this->db->get();
        return $query;
    }
    function penjualan_barang_konsinyasi_kredit(){
        $this->db->select('*');
        $this->db->from('penjualan_barang');
        $this->db->join('penjualan_sementara','penjualan_barang.kd_nota = penjualan_sementara.kd_nota','left');
        $this->db->join('barang','penjualan_sementara.kode_barang=barang.kode_barang','left');
        $this->db->join('kategori_barang','barang.kd_kategori_barang=kategori_barang.id_kategori','left');
        $this->db->join('jenis_barang','barang.kd_jenis_barang=jenis_barang.id_jenis_barang','left');
        $this->db->join('satuan_barang','barang.satuan_barang=satuan_barang.id_satuan','left');
        $this->db->join('pembeli','penjualan_barang.nama_pembeli=pembeli.kd_pelanggan','left');
        $this->db->where('penjualan_barang.status','2');
        $this->db->where('barang.kd_kategori_barang','2');
        $this->db->group_by('penjualan_sementara.id_cek');
        $query = $this->db->get();
        return $query;
    }
    function cari_penjualan_barang_konsinyasi_kredit($hari1,$hari2){
        $this->db->select('*');
        $this->db->from('penjualan_barang');
        $this->db->join('penjualan_sementara','penjualan_barang.kd_nota = penjualan_sementara.kd_nota','left');
        $this->db->join('barang','penjualan_sementara.kode_barang=barang.kode_barang','left');
        $this->db->join('kategori_barang','barang.kd_kategori_barang=kategori_barang.id_kategori','left');
        $this->db->join('jenis_barang','barang.kd_jenis_barang=jenis_barang.id_jenis_barang','left');
        $this->db->join('satuan_barang','barang.satuan_barang=satuan_barang.id_satuan','left');
        $this->db->join('pembeli','penjualan_barang.nama_pembeli=pembeli.kd_pelanggan','left');
        $this->db->where('penjualan_barang.status','2');
        $this->db->where('barang.kd_kategori_barang','2');
        $this->db->where('penjualan_barang.tanggal_penjualan >=',$hari1);
        $this->db->where('penjualan_barang.tanggal_penjualan <=',$hari2);
        $this->db->group_by('penjualan_sementara.id_cek');
        $query = $this->db->get();
        return $query;
    }
    function jasa_fotocopy_print_tunai(){
        $this->db->select('*');
        $this->db->from('penjualan_barang');
        $this->db->join('penjualan_sementara','penjualan_barang.kd_nota = penjualan_sementara.kd_nota','left');
        $this->db->join('barang','penjualan_sementara.kode_barang=barang.kode_barang','left');
        $this->db->join('kategori_barang','barang.kd_kategori_barang=kategori_barang.id_kategori','left');
        $this->db->join('jenis_barang','barang.kd_jenis_barang=jenis_barang.id_jenis_barang','left');
        $this->db->join('satuan_barang','barang.satuan_barang=satuan_barang.id_satuan','left');
        $this->db->join('pembeli','penjualan_barang.nama_pembeli=pembeli.kd_pelanggan','left');
        $this->db->where('penjualan_barang.status','1');
        $this->db->where('barang.kd_kategori_barang','3');
        $this->db->group_by('penjualan_sementara.id_cek');
        $query = $this->db->get();
        return $query;
    }
    function cari_jasa_fotocopy_print_tunai($hari1,$hari2){
        $this->db->select('*');
        $this->db->from('penjualan_barang');
        $this->db->join('penjualan_sementara','penjualan_barang.kd_nota = penjualan_sementara.kd_nota','left');
        $this->db->join('barang','penjualan_sementara.kode_barang=barang.kode_barang','left');
        $this->db->join('kategori_barang','barang.kd_kategori_barang=kategori_barang.id_kategori','left');
        $this->db->join('jenis_barang','barang.kd_jenis_barang=jenis_barang.id_jenis_barang','left');
        $this->db->join('satuan_barang','barang.satuan_barang=satuan_barang.id_satuan','left');
        $this->db->join('pembeli','penjualan_barang.nama_pembeli=pembeli.kd_pelanggan','left');
        $this->db->where('penjualan_barang.status','1');
        $this->db->where('barang.kd_kategori_barang','3');
        $this->db->where('penjualan_barang.tanggal_penjualan >=',$hari1);
        $this->db->where('penjualan_barang.tanggal_penjualan <=',$hari2);
        $this->db->group_by('penjualan_sementara.id_cek');
        $query = $this->db->get();
        return $query;
    }
    function jasa_penjilidan_tunai(){
        $this->db->select('*');
        $this->db->from('penjualan_barang');
        $this->db->join('penjualan_sementara','penjualan_barang.kd_nota = penjualan_sementara.kd_nota','left');
        $this->db->join('barang','penjualan_sementara.kode_barang=barang.kode_barang','left');
        $this->db->join('kategori_barang','barang.kd_kategori_barang=kategori_barang.id_kategori','left');
        $this->db->join('jenis_barang','barang.kd_jenis_barang=jenis_barang.id_jenis_barang','left');
        $this->db->join('satuan_barang','barang.satuan_barang=satuan_barang.id_satuan','left');
        $this->db->join('pembeli','penjualan_barang.nama_pembeli=pembeli.kd_pelanggan','left');
        $this->db->where('penjualan_barang.status','1');
        $this->db->where('barang.kd_kategori_barang','4');
        $this->db->group_by('penjualan_sementara.id_cek');
        $query = $this->db->get();
        return $query;
    }
    function cari_jasa_penjilidan_tunai($hari1,$hari2){
        $this->db->select('*');
        $this->db->from('penjualan_barang');
        $this->db->join('penjualan_sementara','penjualan_barang.kd_nota = penjualan_sementara.kd_nota','left');
        $this->db->join('barang','penjualan_sementara.kode_barang=barang.kode_barang','left');
        $this->db->join('kategori_barang','barang.kd_kategori_barang=kategori_barang.id_kategori','left');
        $this->db->join('jenis_barang','barang.kd_jenis_barang=jenis_barang.id_jenis_barang','left');
        $this->db->join('satuan_barang','barang.satuan_barang=satuan_barang.id_satuan','left');
        $this->db->join('pembeli','penjualan_barang.nama_pembeli=pembeli.kd_pelanggan','left');
        $this->db->where('penjualan_barang.status','1');
        $this->db->where('barang.kd_kategori_barang','4');
        $this->db->where('penjualan_barang.tanggal_penjualan >=',$hari1);
        $this->db->where('penjualan_barang.tanggal_penjualan <=',$hari2);
        $this->db->group_by('penjualan_sementara.id_cek');
        $query = $this->db->get();
        return $query;
    }
    function jasa_penjilidan_kredit(){
        $this->db->select('*');
        $this->db->from('penjualan_barang');
        $this->db->join('penjualan_sementara','penjualan_barang.kd_nota = penjualan_sementara.kd_nota','left');
        $this->db->join('barang','penjualan_sementara.kode_barang=barang.kode_barang','left');
        $this->db->join('kategori_barang','barang.kd_kategori_barang=kategori_barang.id_kategori','left');
        $this->db->join('jenis_barang','barang.kd_jenis_barang=jenis_barang.id_jenis_barang','left');
        $this->db->join('satuan_barang','barang.satuan_barang=satuan_barang.id_satuan','left');
        $this->db->join('pembeli','penjualan_barang.nama_pembeli=pembeli.kd_pelanggan','left');
        $this->db->where('penjualan_barang.status','2');
        $this->db->where('barang.kd_kategori_barang','4');
        $this->db->group_by('penjualan_sementara.id_cek');
        $query = $this->db->get();
        return $query;
    }
    function cari_jasa_penjilidan_kredit($hari1,$hari2){
        $this->db->select('*');
        $this->db->from('penjualan_barang');
        $this->db->join('penjualan_sementara','penjualan_barang.kd_nota = penjualan_sementara.kd_nota','left');
        $this->db->join('barang','penjualan_sementara.kode_barang=barang.kode_barang','left');
        $this->db->join('kategori_barang','barang.kd_kategori_barang=kategori_barang.id_kategori','left');
        $this->db->join('jenis_barang','barang.kd_jenis_barang=jenis_barang.id_jenis_barang','left');
        $this->db->join('satuan_barang','barang.satuan_barang=satuan_barang.id_satuan','left');
        $this->db->join('pembeli','penjualan_barang.nama_pembeli=pembeli.kd_pelanggan','left');
        $this->db->where('penjualan_barang.status','2');
        $this->db->where('barang.kd_kategori_barang','4');
        $this->db->where('penjualan_barang.tanggal_penjualan >=',$hari1);
        $this->db->where('penjualan_barang.tanggal_penjualan <=',$hari2);
        $this->db->group_by('penjualan_sementara.id_cek');
        $query = $this->db->get();
        return $query;
    }
    function jasa_fotocopy_print_kredit(){
        $this->db->select('*');
        $this->db->from('penjualan_barang');
        $this->db->join('penjualan_sementara','penjualan_barang.kd_nota = penjualan_sementara.kd_nota','left');
        $this->db->join('barang','penjualan_sementara.kode_barang=barang.kode_barang','left');
        $this->db->join('kategori_barang','barang.kd_kategori_barang=kategori_barang.id_kategori','left');
        $this->db->join('jenis_barang','barang.kd_jenis_barang=jenis_barang.id_jenis_barang','left');
        $this->db->join('satuan_barang','barang.satuan_barang=satuan_barang.id_satuan','left');
        $this->db->join('pembeli','penjualan_barang.nama_pembeli=pembeli.kd_pelanggan','left');
        $this->db->where('penjualan_barang.status','2');
        $this->db->where('barang.kd_kategori_barang','3');
        $this->db->group_by('penjualan_sementara.id_cek');
        $query = $this->db->get();
        return $query;
    }
    function cari_jasa_fotocopy_print_kredit($hari1,$hari2){
        $this->db->select('*');
        $this->db->from('penjualan_barang');
        $this->db->join('penjualan_sementara','penjualan_barang.kd_nota = penjualan_sementara.kd_nota','left');
        $this->db->join('barang','penjualan_sementara.kode_barang=barang.kode_barang','left');
        $this->db->join('kategori_barang','barang.kd_kategori_barang=kategori_barang.id_kategori','left');
        $this->db->join('jenis_barang','barang.kd_jenis_barang=jenis_barang.id_jenis_barang','left');
        $this->db->join('satuan_barang','barang.satuan_barang=satuan_barang.id_satuan','left');
        $this->db->join('pembeli','penjualan_barang.nama_pembeli=pembeli.kd_pelanggan','left');
        $this->db->where('penjualan_barang.status','2');
        $this->db->where('barang.kd_kategori_barang','3');
        $this->db->where('penjualan_barang.tanggal_penjualan >=',$hari1);
        $this->db->where('penjualan_barang.tanggal_penjualan <=',$hari2);
        $this->db->group_by('penjualan_sementara.id_cek');
        $query = $this->db->get();
        return $query;
    }
    function cari_hari_lr_srgm_intern($hari1,$hari2){
        $this->db->select('*');
        $this->db->from('penjualan_barang');
        $this->db->join('penjualan_sementara','penjualan_barang.kd_nota = penjualan_sementara.kd_nota','left');
        $this->db->join('barang','penjualan_sementara.kode_barang=barang.kode_barang','left');
        $this->db->join('kategori_barang','barang.kd_kategori_barang=kategori_barang.id_kategori','left');
        $this->db->join('jenis_barang','barang.kd_jenis_barang=jenis_barang.id_jenis_barang','left');
        $this->db->join('satuan_barang','barang.satuan_barang=satuan_barang.id_satuan','left');
        $this->db->where('penjualan_barang.status !=','0');
        $this->db->where('barang.kd_jenis_barang !=','1');
        $this->db->where('barang.kd_jenis_barang !=','2');
        $this->db->where('barang.kd_jenis_barang !=','3');
        $this->db->where('barang.kd_jenis_barang !=','9');
        $this->db->where('penjualan_barang.tanggal_penjualan >=',$hari1);
        $this->db->where('penjualan_barang.tanggal_penjualan <=',$hari2);
//        $this->db->order_by('penjualan_barang.tanggal_penjualan','ASC');
        $this->db->group_by('penjualan_sementara.id_cek');
        $query = $this->db->get();
        return $query;
    }
    function list_data_penjualan1($start,$end){
        $this->db->select('*');
        $this->db->from('penjualan_barang');
        $this->db->join('penjualan_sementara','penjualan_barang.kd_nota = penjualan_sementara.kd_nota','left');
        $this->db->join('barang','penjualan_sementara.kode_barang=barang.kode_barang','left');
        $this->db->join('kategori_barang','barang.kd_kategori_barang=kategori_barang.id_kategori','left');
        $this->db->join('jenis_barang','barang.kd_jenis_barang=jenis_barang.id_jenis_barang','left');
        $this->db->join('satuan_barang','barang.satuan_barang=satuan_barang.id_satuan','left');
        $this->db->where('penjualan_barang.status !=','0');
        $this->db->where('penjualan_barang.tanggal_penjualan >=',$start);
        $this->db->where('penjualan_barang.tanggal_penjualan <=',$end);
        // $this->db->where('penjualan_barang.nama_kasir',$user);
        $this->db->order_by('penjualan_barang.tanggal_penjualan','ASC');
        $this->db->group_by('penjualan_sementara.id_cek');
        $query = $this->db->get();
        return $query;
    }
    function cari_list_data_penjualan($start,$end){
        $this->db->select('*');
        $this->db->from('penjualan_barang');
        $this->db->join('penjualan_sementara','penjualan_barang.kd_nota = penjualan_sementara.kd_nota','left');
        $this->db->join('barang','penjualan_sementara.kode_barang=barang.kode_barang','left');
        $this->db->join('kategori_barang','barang.kd_kategori_barang=kategori_barang.id_kategori','left');
        $this->db->join('jenis_barang','barang.kd_jenis_barang=jenis_barang.id_jenis_barang','left');
        $this->db->join('satuan_barang','barang.satuan_barang=satuan_barang.id_satuan','left');
        $this->db->where('penjualan_barang.status !=','0');
        $this->db->where('penjualan_barang.tanggal_penjualan >=',$start);
        $this->db->where('penjualan_barang.tanggal_penjualan <=',$end);
        $this->db->group_by('penjualan_sementara.id_cek');
        $query = $this->db->get();
        return $query;
    }
    function cari_bulan_list_data_penjualan($start,$end,$thn){
        $this->db->select('*');
        $this->db->from('penjualan_barang');
        $this->db->join('penjualan_sementara','penjualan_barang.kd_nota = penjualan_sementara.kd_nota','left');
        $this->db->join('barang','penjualan_sementara.kode_barang=barang.kode_barang','left');
        $this->db->join('kategori_barang','barang.kd_kategori_barang=kategori_barang.id_kategori','left');
        $this->db->join('jenis_barang','barang.kd_jenis_barang=jenis_barang.id_jenis_barang','left');
        $this->db->join('satuan_barang','barang.satuan_barang=satuan_barang.id_satuan','left');
        $this->db->where('penjualan_barang.status !=','0');
        $this->db->where('penjualan_barang.bulan_beli >=',$start);
        $this->db->where('penjualan_barang.bulan_beli <=',$end);
        $this->db->where('penjualan_barang.tahun_n',$thn);
        $this->db->group_by('penjualan_sementara.id_cek');
        $query = $this->db->get();
        return $query;
    }
    function cari_tahun_list_data_penjualan($start,$end){
        $this->db->select('*');
        $this->db->from('penjualan_barang');
        $this->db->join('penjualan_sementara','penjualan_barang.kd_nota = penjualan_sementara.kd_nota','left');
        $this->db->join('barang','penjualan_sementara.kode_barang=barang.kode_barang','left');
        $this->db->join('kategori_barang','barang.kd_kategori_barang=kategori_barang.id_kategori','left');
        $this->db->join('jenis_barang','barang.kd_jenis_barang=jenis_barang.id_jenis_barang','left');
        $this->db->join('satuan_barang','barang.satuan_barang=satuan_barang.id_satuan','left');
        $this->db->where('penjualan_barang.status !=','0');
        $this->db->where('penjualan_barang.tahun_n >=',$start);
        $this->db->where('penjualan_barang.tahun_n <=',$end);
        $this->db->group_by('penjualan_sementara.id_cek');
        $query = $this->db->get();
        return $query;
    }
    function semua_export($table){
        $query = $this->db->get($table);
        if($query->num_rows() > 0){
            foreach($query->result() as $data){
                $hasil[] = $data;
            }
            return $hasil;
        }
    }
    function kasir_cari($cari){
        $query = $this->db->query("SELECT * FROM persediaan_barang where kode_barang='$cari' ");
         return $query;
    }
    function pembelian(){
        $query = $this->db->query("SELECT * FROM pembelian_barang ");
         return $query;
    }
    function list_pembeli(){
        $query = $this->db->get('pembeli');
        return $query;
    }
    function daf_pembelian(){
        $query = $this->db->query("SELECT * FROM pembelian_barang,supplier where pembelian_barang.kode_supplier = supplier.kd_supplier ");
         return $query;
    }
    function daf_pembelian2(){
        $query = $this->db->query("SELECT * FROM pembelian_barang,supplier,persediaan_barang where pembelian_barang.kode_supplier = supplier.kd_supplier AND pembelian_barang.kode_barang=persediaan_barang.kode_barang");
         return $query;
    }
    function daf_persediaan(){
        //$query = $this->db->query("SELECT DISTINCT * FROM persediaan_barang  ");
        $query = $this->db->query("SELECT * FROM persediaan_barang,pembelian_barang WHERE persediaan_barang.kode_barang=pembelian_barang.kode_barang");
         return $query;
    }
    function cek_kadaluarsa($kd_barang){
        $query = $this->db->query("SELECT * FROM persediaan_barang where kode_barang='$kd_barang'  ");
         return $query;
    }
    function cek_waktu($tgl_kadaluarsa,$tgl_skr){
        $query = $this->db->query("SELECT DATEDIFF('$tgl_skr','$tgl_kadaluarsa') AS jangka_waktu   ");
         return $query;
    }
    function supplier(){
        $query = $this->db->query("SELECT * FROM supplier ");
         return $query;
    }
    function pembeli(){
        $query = $this->db->query("SELECT * FROM pembeli ");
         return $query;
    }
    function data_ss(){
        $query = $this->db->query("SELECT * FROM penjualan_sementara,persediaan_barang,penjualan_barang where persediaan_barang.kode_barang = penjualan_sementara.kode_barang and penjualan_barang.kd_nota = penjualan_sementara.kd_nota and penjualan_barang.status = '0' ");
         return $query;
    }
    function rekap_grafik_laba_bulan(){
        $query = $this->db->query("SELECT DISTINCT bulan_beli FROM penjualan_barang ORDER BY bulan_beli");
         return $query;
    }
    function rekap_bulan_penjualan(){
        $query = $this->db->query("SELECT DISTINCT bulan_beli FROM penjualan_barang ORDER BY bulan_beli");
         return $query;
    }
    function rekap_bulan_penjualan1($bln,$bln1,$thn){
        $query = $this->db->query("SELECT DISTINCT bulan_beli FROM penjualan_barang WHERE bulan_beli BETWEEN '$bln' and '$bln1' and tahun_n='$thn' ORDER BY bulan_beli");
         return $query;
    }
    function rekap_bulan_penjualan2($bln){
        $query = $this->db->query("SELECT * FROM penjualan_barang,pembelian_barang WHERE penjualan_barang.bulan_beli='$bln' AND pembelian_barang.bulan_pembelian='$bln' AND penjualan_barang.tahun_n='2017' AND pembelian_barang.tahun='2017' GROUP BY penjualan_barang.kd_penjualan");
         return $query;
    }
    function rekap_sum_penjualan($bulan,$thn){
        $query = $this->db->query("SELECT SUM(total_harga) AS total_harga FROM penjualan_barang WHERE bulan_beli = '$bulan' AND tahun_n='$thn' ORDER BY bulan_beli");
         return $query;
    }
    function rekap_sum_penjualan1($id){
        $query = $this->db->query("SELECT SUM(total_harga) AS total_harga FROM penjualan_barang WHERE kd_penjualan = '$id' ORDER BY bulan_beli");
         return $query;
    }
    function rekap_sum_pembelian($bulan1,$thn){
        $query = $this->db->query("SELECT SUM(total_harga) AS total_harga FROM pembelian_barang WHERE bulan_pembelian = '$bulan1' AND tahun='$thn' ORDER BY bulan_pembelian");
         return $query;
    }
    function rekap_sum_pembelian1($kd){
        $query = $this->db->query("SELECT SUM(total_harga) AS total_harga FROM pembelian_barang WHERE kd_pembelian = '$kd' ORDER BY bulan_pembelian");
         return $query;
    }
    function maxid(){
        $query = $this->db->query("SELECT * FROM penjualan_barang where status='1' order by kd_nota desc limit 1");
         return $query;
    }
    function cek_nota($nota){
        $query = $this->db->query("SELECT count(kd_nota) as cek FROM penjualan_barang where kd_nota='$nota'");
         return $query;
    }
    function cek_barang($kd_z){
        $query = $this->db->query("SELECT * FROM persediaan_barang where kode_barang='$kd_z'");
         return $query;
    }
    function list_data_sementara($id){
        return $this->db->query("SELECT * FROM penjualan_sementara WHERE kd_nota='$id'");
    }
    function list_penjualan2($kd){
        return $this->db->query("SELECT * FROM penjualan_barang WHERE kd_penjualan='$kd'");
    }
    function antara_tgl($tgl1,$tgl2){
        return $this->db->query("
SELECT * FROM penjualan_barang,penjualan_sementara WHERE penjualan_barang.tanggal_penjualan BETWEEN '$tgl1' AND '$tgl2' AND penjualan_barang.kd_nota=penjualan_sementara.kd_nota");
    }
    function antara_tgl2($tgl1,$tgl2){
        return $this->db->query("SELECT * FROM pembelian_barang,supplier WHERE pembelian_barang.kode_supplier=supplier.kd_supplier AND tanggal_pembelian BETWEEN '$tgl1' AND '$tgl2' ORDER BY pembelian_barang.kd_pembelian");
    }
    function cek_akhir_pembelian(){
        return $this->db->query("SELECT * FROM pembelian_barang ORDER BY kd_pembelian DESC LIMIT 1");
    }
    function kas_masuk($tgl1,$tgl2){
        return $this->db->query("SELECT * FROM kas WHERE kredit = '' AND kd_pembelian = '' AND tanggal_transaksi BETWEEN '$tgl1' AND '$tgl2' ORDER BY id_kas DESC");
    }
    function kas_keluar($tgl1,$tgl2){
        return $this->db->query("SELECT * FROM kas WHERE debet = '' AND kd_penjualan = '' AND tanggal_transaksi BETWEEN '$tgl1' AND '$tgl2' ORDER BY id_kas DESC");
    }
    function cek_penjualan2($kd){
        return $this->db->query("SELECT * FROM penjualan_barang WHERE kd_penjualan = '$kd' ");
    }
    function cek_penjualan3($kd){
        return $this->db->query("SELECT SUM(satuan) as ttlx FROM penjualan_barang,penjualan_sementara WHERE penjualan_barang.kd_penjualan = '$kd' AND penjualan_barang.kd_nota=penjualan_sementara.kd_nota");
    }
    function cek_pembelian2($kd){
        return $this->db->query("SELECT * FROM pembelian_barang,supplier WHERE pembelian_barang.kode_supplier=supplier.kd_supplier AND pembelian_barang.kd_pembelian='$kd'");
    }
    function sum_total_debet($tgl1,$tgl2){
        return $this->db->query("SELECT SUM(debet) AS debet FROM kas WHERE tanggal_transaksi BETWEEN '$tgl1' AND '$tgl2' AND kd_pembelian='' AND kredit=''");
    }
    function sum_total_kredit($tgl1,$tgl2){
        return $this->db->query("SELECT SUM(kredit) AS kredit FROM kas WHERE tanggal_transaksi BETWEEN '$tgl1' AND '$tgl2' AND kd_penjualan='' AND debet=''");
    }
     function antara_tgl_rekap($tgl1,$tgl2){
        return $this->db->query("SELECT * FROM kas WHERE tanggal_transaksi BETWEEN '$tgl1' AND '$tgl2'");
    }
    function sum_rekap_debet($tgl1,$tgl2){
        return $this->db->query("SELECT SUM(debet) AS debet FROM kas WHERE tanggal_transaksi BETWEEN '$tgl1' AND '$tgl2' AND kd_pembelian='' AND kredit=''");
    }
    function sum_rekap_kredit($tgl1,$tgl2){
        return $this->db->query("SELECT SUM(kredit) AS kredit FROM kas WHERE tanggal_transaksi BETWEEN '$tgl1' AND '$tgl2' AND kd_penjualan='' AND debet=''");
    }
    function laporan_pembelian($tgl1,$tgl2){
        return $this->db->query("SELECT * FROM pembelian_barang,supplier WHERE pembelian_barang.kode_supplier=supplier.kd_supplier  AND pembelian_barang.tanggal_pembelian BETWEEN '$tgl1' AND '$tgl2' ORDER BY pembelian_barang.kd_pembelian DESC");
    }
    function laporan_pembelian2($kd){
        return $this->db->query("SELECT * FROM pembelian_barang,supplier WHERE pembelian_barang.kode_supplier=supplier.kd_supplier AND pembelian_barang.tanggal_pembelian=pembelian_barang.tanggal_pembelian AND pembelian_barang.kode_barang='$kd' ORDER BY pembelian_barang.kd_pembelian DESC");
    }
    function laporan_penjualan($tgl1,$tgl2){
        return $this->db->query("SELECT * FROM penjualan_barang,penjualan_sementara,persediaan_barang WHERE penjualan_barang.kd_nota=penjualan_sementara.kd_nota AND penjualan_sementara.kode_barang=persediaan_barang.kode_barang AND penjualan_barang.nama_pembeli!='' AND penjualan_barang.nama_pembeli!='' AND penjualan_barang.nama_pembeli!='0' AND penjualan_barang.tanggal_penjualan BETWEEN '$tgl1' AND '$tgl2' ORDER BY penjualan_barang.kd_penjualan DESC");
    }
    function laporan_penjualan2($kd){
        return $this->db->query("SELECT * FROM penjualan_barang,penjualan_sementara,persediaan_barang WHERE penjualan_barang.kd_nota=penjualan_sementara.kd_nota AND penjualan_sementara.kode_barang=persediaan_barang.kode_barang AND penjualan_barang.nama_pembeli!='' AND penjualan_barang.nama_pembeli!='' AND penjualan_barang.nama_pembeli!='0' AND penjualan_sementara.kode_barang='$kd' ORDER BY penjualan_barang.kd_penjualan DESC");
    }
    function grafik_bulan($bln,$bln1,$thn){
        return $this->db->query("SELECT DISTINCT bulan_beli FROM penjualan_barang WHERE bulan_beli BETWEEN '$bln' AND '$bln1' AND tahun_n='$thn' ORDER BY bulan_beli ASC");
    }
    function grafik_tahun($thn,$thn1){
        return $this->db->query("SELECT DISTINCT tahun_n FROM penjualan_barang WHERE bulan_beli BETWEEN '01' AND '12' AND tahun_n BETWEEN '$thn' AND '$thn1' ORDER BY tahun_n ASC");
    }
    function sum_laba($bln,$thn){
        return $this->db->query("SELECT sum(total_harga) as ttl FROM penjualan_barang WHERE bulan_beli ='$bln' AND tahun_n='$thn' ORDER BY bulan_beli ASC");
    }
    function sum_laba2($thn){
        return $this->db->query("SELECT sum(total_harga) as ttl FROM penjualan_barang WHERE tahun_n='$thn' ORDER BY tahun_n ASC");
    }
    function kas_sekarang(){
        return $this->db->query("SELECT * FROM modal");
    }
    function data_barang(){
        return $this->db->query("SELECT * FROM pembelian_barang,supplier,persediaan_barang WHERE pembelian_barang.kd_pembelian=pembelian_barang.kd_pembelian AND supplier.kd_supplier=pembelian_barang.kode_supplier AND persediaan_barang.kode_barang=pembelian_barang.kode_barang");
    }
    function count_penjualan($bln,$thn){
        return $this->db->query("SELECT COUNT(kd_penjualan) as TOTAL FROM penjualan_barang WHERE bulan_beli='$bln' AND tahun_n='$thn' ORDER BY kd_penjualan DESC");
    }
    function count_penjualan1($thn){
        return $this->db->query("SELECT COUNT(kd_penjualan) as TOTAL FROM penjualan_barang WHERE tahun_n='$thn' ORDER BY kd_penjualan DESC");
    }
    function jual_count($bln1,$bln2,$thn){
        return $this->db->query("SELECT DISTINCT bulan_beli FROM penjualan_barang WHERE bulan_beli BETWEEN '$bln1' AND '$bln2' AND tahun_n='$thn'");
    }
    function jual_count1($thn1,$thn2){
        return $this->db->query("SELECT DISTINCT tahun_n FROM penjualan_barang WHERE tahun_n BETWEEN '$thn1' AND '$thn2' ");
    }
    function rate_barang(){
        return $this->db->query("SELECT * FROM persediaan_barang ORDER BY total_dibeli DESC");
    }
    function sum_rate_barang($kd){
        return $this->db->query("SELECT SUM(satuan) as totalx FROM penjualan_sementara WHERE kode_barang='$kd'");
    }
    function data_pembeli(){
        return $this->db->query("SELECT * FROM pembeli");
    }
    function count2_pembeli($nama){
        return $this->db->query('SELECT COUNT(kd_penjualan) AS totaly FROM penjualan_barang WHERE nama_pembeli="$nama"');
    }
    function lapor_in_out(){
        return $this->db->query("SELECT * FROM pembelian_barang");
    }
    function cek_persediaan2(){
        return $this->db->query("SELECT * FROM persediaan_barang WHERE status_s='1'");
    }
    function cek_stock($kd){
        return $this->db->query("SELECT * FROM persediaan_barang WHERE kode_barang = '$kd'");
    }
    function step1_laba($bln1,$bln2){
        return $this->db->query("SELECT * FROM penjualan_barang,penjualan_sementara WHERE penjualan_barang.kd_nota=penjualan_sementara.kd_nota AND penjualan_barang.bulan_beli BETWEEN '$bln1' AND '$bln2' GROUP BY penjualan_barang.kd_penjualan");
    }
    function step1_laba2($thn1,$thn2){
        return $this->db->query("SELECT * FROM penjualan_barang,penjualan_sementara WHERE penjualan_barang.kd_nota=penjualan_sementara.kd_nota AND penjualan_barang.tahun_n BETWEEN '$thn1' AND '$thn2' GROUP BY penjualan_barang.kd_penjualan");
    }
    function step2_laba($kd){
        return $this->db->query("SELECT * FROM pembelian_barang WHERE kode_barang='$kd'");
    }
    function cari_sup($kd){
        return $this->db->query("SELECT * FROM supplier WHERE kd_supplier='$kd'");
    }
    function cek_terakhir_pem(){
        return $this->db->query("SELECT * FROM `pembelian_barang` ORDER BY kd_pembelian DESC LIMIT 1");
    }
    function cek_terakhir_per(){
        return $this->db->query("SELECT * FROM `persediaan_barang` ORDER BY kd_nota DESC LIMIT 1");
    }
    function cek_stocknya($kd){
        return $this->db->query("SELECT * FROM persediaan_barang WHERE kd_nota='$kd'");
    }
     function input_data($data,$table){
        $this->db->insert($table,$data);
    }
    function hapus_data($where,$table){
        $this->db->where($where);
        $this->db->delete($table);
    }
    function update_data($where,$data,$table){
        $this->db->where($where);
        $this->db->update($table,$data);
    }
}
?>
