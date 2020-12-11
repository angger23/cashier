<?php 
class Mread extends CI_Model{
    function export_kontak($tgl1,$tgl2){
        $query = $this->db->query("SELECT * FROM penjualan_barang,penjualan_sementara WHERE tanggal_penjualan BETWEEN '$tgl1' AND '$tgl2' AND penjualan_barang.kd_penjualan=penjualan_barang.kd_penjualan AND penjualan_barang.kd_nota=penjualan_sementara.kd_nota AND penjualan_barang.nama_pembeli!='' AND penjualan_barang.nama_pembeli!='0' GROUP BY penjualan_barang.kd_nota");
         
        if($query->num_rows() > 0){
            foreach($query->result() as $data){
                $hasil[] = $data;
            }
            return $hasil;
        }
    }
    
    function export_masuk($tgl1,$tgl2){
        $query = $this->db->query("SELECT * FROM kas WHERE kredit = '' AND kd_pembelian = '' AND tanggal_transaksi BETWEEN '$tgl1' AND '$tgl2' ORDER BY id_kas DESC");
         
        if($query->num_rows() > 0){
            foreach($query->result() as $data){
                $hasil[] = $data;
            }
            return $hasil;
        }
    }
    
    function export_barang_masuk($tgl1,$tgl2){
        $query = $this->db->query("SELECT * FROM pembelian_barang,supplier WHERE pembelian_barang.kode_supplier=supplier.kd_supplier  AND pembelian_barang.tanggal_pembelian BETWEEN '$tgl1' AND '$tgl2' ORDER BY pembelian_barang.kd_pembelian DESC");
         
        if($query->num_rows() > 0){
            foreach($query->result() as $data){
                $hasil[] = $data;
            }
            return $hasil;
        }
    }
    
    function export_keluar($tgl1,$tgl2){
        $query = $this->db->query("SELECT * FROM kas WHERE debet = '' AND kd_penjualan = '' AND tanggal_transaksi BETWEEN '$tgl1' AND '$tgl2' ORDER BY id_kas DESC");
         
        if($query->num_rows() > 0){
            foreach($query->result() as $data){
                $hasil[] = $data;
            }
            return $hasil;
        }
    }
    
    function export_data_barang(){
        $query = $this->db->query("SELECT * FROM pembelian_barang,supplier,persediaan_barang WHERE pembelian_barang.kd_pembelian=pembelian_barang.kd_pembelian AND supplier.kd_supplier=pembelian_barang.kode_supplier AND persediaan_barang.kode_barang=pembelian_barang.kode_barang");
         
        if($query->num_rows() > 0){
            foreach($query->result() as $data){
                $hasil[] = $data;
            }
            return $hasil;
        }
    }
    
    function export_pembelian($tgl1,$tgl2){
        $query = $this->db->query("SELECT * FROM pembelian_barang,supplier WHERE pembelian_barang.kode_supplier=supplier.kd_supplier AND tanggal_pembelian BETWEEN '$tgl1' AND '$tgl2' ORDER BY pembelian_barang.kd_pembelian");
         
        if($query->num_rows() > 0){
            foreach($query->result() as $data){
                $hasil[] = $data;
            }
            return $hasil;
        }
    }
    
    function export_penjualan($tgl1,$tgl2){
        $query = $this->db->query("SELECT * FROM penjualan_barang,penjualan_sementara WHERE penjualan_barang.tanggal_penjualan BETWEEN '$tgl1' AND '$tgl2' AND penjualan_barang.kd_nota=penjualan_sementara.kd_nota");
         
        if($query->num_rows() > 0){
            foreach($query->result() as $data){
                $hasil[] = $data;
            }
            return $hasil;
        }
    }
    function export_pembeli(){
        $query = $this->db->query("SELECT * FROM pembeli");
         
        if($query->num_rows() > 0){
            foreach($query->result() as $data){
                $hasil[] = $data;
            }
            return $hasil;
        }
    } 
    function export_pembelian_xxx(){
        $query = $this->db->query("SELECT * FROM pembelian_barang,supplier,persediaan_barang where pembelian_barang.kode_supplier = supplier.kd_supplier AND pembelian_barang.kode_barang=persediaan_barang.kode_barang");
         
        if($query->num_rows() > 0){
            foreach($query->result() as $data){
                $hasil[] = $data;
            }
            return $hasil;
        }
    }
    
    function export_barang_keluar($tgl1,$tgl2){
        $query = $this->db->query("SELECT * FROM penjualan_barang,penjualan_sementara,persediaan_barang WHERE penjualan_barang.kd_nota=penjualan_sementara.kd_nota AND penjualan_sementara.kode_barang=persediaan_barang.kode_barang AND penjualan_barang.nama_pembeli!='' AND penjualan_barang.nama_pembeli!='' AND penjualan_barang.nama_pembeli!='0' AND penjualan_barang.tanggal_penjualan BETWEEN '$tgl1' AND '$tgl2' ORDER BY penjualan_barang.kd_penjualan DESC");
         
        if($query->num_rows() > 0){
            foreach($query->result() as $data){
                $hasil[] = $data;
            }
            return $hasil;
        }
    }
}
