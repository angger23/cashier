
<script language="javascript">

</script>

<?php
$kode = $this->input->post('cari');
if(empty($kode)){ $kd_barang = 0 ; }else{ $kd_barang = $kode; 
$data['cek_kadaluarsa'] = $this->m_data->cek_kadaluarsa($kd_barang)->row();
$tgl_kadaluarsa = $data['cek_kadaluarsa']->expierd; 
$tgl_skr = date("Y-m-d");
$data['cek_waktu'] = $this->m_data->cek_waktu($tgl_kadaluarsa,$tgl_skr)->row();
    if($tgl_kadaluarsa = $data['cek_kadaluarsa']->expierd == "0000-00-00"){
    
        ?>

<?php 
    }elseif($data['cek_waktu']->jangka_waktu>=0){  
?> 

<script>
    
    alert("Barang Sudah Kadaluarsa");
</script>


<?php
    }else{
        
    }
}
?>
<!-- /subnavbar -->
<div class="container" style="margin-top:10px;">
    <div class="row">
        <div class="panel panel-default">
    <div class="panel-heading"><h5 style="margin:0;">Kasir</h5></div>
    <div class="panel-body">
        <table class="table table-striped">
                        <thead>
                            <tr>
                        <th><center>Cari Barang</center></th>
                        <th>Kode Barang</th>
                        <th>Nama Barang</th>
                        <th>Harga Pokok</th>
                        <th>Satuan Beli</th>
                        <th>Neto</th>
                        <th>Diskon</th>
                        <th>Total Harga</th>
                            </tr>
                        </thead>
                        
                        
                        <tbody>
                           <?php
                            $no=1;
                            foreach($data_ss as $record ){ ?>
                            <tr id="cetak_not">
                        <td width="130px"> 
                            <form method="post" action="<?php echo base_url() ?>kasir/hapus_pembelian">
                            <center>
                        <button type="submit" class="btn btn-default btn-sm"><i class="fa fa-trash"  ></i></button>
                        <input type="hidden" name="kode" value="<?php echo $record['kode_barang']; ?>" >
                        <input type="hidden" name="satuan" value="<?php echo $record['satuan']; ?>" >
                        <input type="hidden" name="nota" value="<?php echo $record['kd_nota']; ?>" >
                            </center>
                            </form>
                                </td>
                        <td> <?php echo $record['kode_barang'] ?> </td>
                        <td> <?php echo $record['nama_barang'] ?> </td>
                        <td> Rp. <?php echo number_format($record['harga_pokok']); ?> </td>
                        <td width="120px">
                            <?php echo $record['satuan']; ?> </td>
                        <td width="120px">
                            Rp. <?php $harga =  $record['harga_pokok'] * $record['satuan'] ;
                                echo number_format($harga);
                            if($no==1){
                                $total = $harga;
                            }else{ 
                            $total = $total + $harga;
                            }
                            ?>
                             </td>
                        <td width="120px">
                            <?php if($record['satuan']>$record['kelipatan']){ echo $record['diskon'];}else{
                                
                                echo "0";
                            } ?>% </td>
                        <td> Rp. <?php 
                            $sub =  $record['harga_pokok'] * $record['satuan'] ;
                        if($record['satuan']>$record['kelipatan']){ 
                            $dis =  ( $sub * $record['diskon']) / 100;
                            $harga = $sub - $dis;
                        }else{
                             $harga = $sub;
                            }
                            
                                echo number_format($harga);
                            if($no==1){
                                $ttd = $harga;
                            }else{ 
                            $ttd = $ttd + $harga;
                            }
                            ?> </td>
                            </tr> 
                        <?php $no++; } ?>
                            <tr>
                        <td width="">     
                            <form method="post" action="<?php echo base_url() ?>">
    <?php 
    $data['data_ss1'] = $this->m_data->data_ss()->row();
    if(!empty($data_ss)){
      ?>
        <label>Nama Pembeli :</label> <p><?php echo $data['data_ss1']->nama_pembeli ?></p>
        <?php }else{ ?>
        <select class="form-control selectku" name="nama_pembeli" <?php  if(!empty($record['bayar'])){  }elseif(!empty($this->input->post('bayar'))){  }elseif(empty($this->input->post('cari'))){ echo "autofocus='autofocus'"; }else{} ?>>
            <?php foreach($pembeli as $rect ){ ?>
    <option value="<?php echo $rect['nama_pembeli'] ?>"><?php echo $rect['nama_pembeli'] ?></option>
<?php } ?>
        </select>                       
        <?php } ?>
                        <input class="form-control" id="appendedInputButton" name="cari"  style="margin-top:10px" placeholder="Kode Barang" type="text" value="<?php echo $this->input->post('cari'); ?>" <?php  if(!empty($record['bayar'])){  }elseif(!empty($this->input->post('bayar'))){  }elseif(empty($this->input->post('cari'))){ echo "autofocus"; }else{} ?> >
                                
                               
                        <button type="submit" style="display:none;"><i class="icon-random"  ></i></button>
                            </form>
                            </td>
                        <td> <?php if(empty($this->input->post('cari'))){}else{ echo $car->kode_barang; } ?> </td>
                        <td> <?php if(empty($this->input->post('cari'))){}else{ echo $car->nama_barang; } ?> </td>
                        <td> Rp. <?php if(empty($this->input->post('cari'))){}else{ echo number_format($car->harga_pokok); } ?> </td>
                        <td width="">
                    <form method="post" action="<?php echo base_url() ?>kasir/insert_record">
                        <div class="col-md-10" style="padding:0;"><input class="form-control" id="appendedInputButton"  type="text" name="satuan_beli" placeholder="Jumlah Beli .." value="<?php echo $this->input->post('satuan_beli'); ?>" <?php  if(empty($this->input->post('cari'))){}else{ echo "autofocus"; } ?>  >
</div>
            <input type="hidden" name="kode" value="<?php echo $this->input->post('cari'); ?>" >
            <input type="hidden" name="nama_pem" value="<?php echo $this->input->post('nama_pembeli'); ?>" >
<!--                        <div class="col-md-2"><button class="btn btn-default btn-sm" type="button"><i class="icon-random"  ></i></button> </div>-->
                        
                            
                    </form>
                                </td>
                        <td> Rp. <?php if(empty($this->input->post('cari'))){}else{ 
    echo number_format($car->harga_pokok * $this->input->post('satuan_beli')) ; } ?> </td>
                                <td>  </td>
                                <td> Rp. <?php if(empty($this->input->post('cari'))){}else{ 
    echo number_format($car->harga_pokok * $this->input->post('satuan_beli')) ; } ?> </td>
                            </tr> 
                            <tr>
                        <td width="230px">      
                        
                            </td>
                        <td> </td>
                        <td>  </td>
                        <td> </td>
                        <td> </td>
                        <td> </td>
                        <td width="120px">
                            <b>Total Pembelian</b> </td>
                                <td style="font-size:16px"> <b> Rp.  
                <?php if(empty($ttd)){}else{ echo number_format($ttd); } ?> </b> </td>
                            </tr> 
                            
                            
                            <tr>
                        <td width="230px">      
                        
                            </td>
                        <td> </td>
                        <td>  </td>
                        <td> </td>
                        <td> </td>
                        <td> </td>
                        <td width="120px">
                            <b>Bayar</b> </td>
                               <td width="">
                    <form method="post" action="<?php echo base_url() ?>">
                           <div class="col-md-10"><input class="form-control" type="text" name="bayar" value="<?php echo $this->input->post('bayar'); ?>" <?php  if(empty($record['diskon'])){}elseif($this->input->post('bayar')){ }else{ echo "autofocus"; } ?> required></div> 
                        
                        
          <!--  <input type="hidden" name="kode" value="<?php echo $record['kd_nota']; ?>" >
            <input type="hidden" name="diskon" value="<?php echo $this->input->post('diskon'); ?>" >
            <input type="hidden" name="total_harga" value="<?php if(empty($total)){}else{ 
    if(empty($this->input->post('diskon'))){  echo $total; }else{    
    if($this->input->post('diskon')<=100){ $sub = ($total*$this->input->post('diskon'))/100;
                                             
                                             }else{
                                                $sub = $total - $this->input->post('diskon');
        }
         echo $sub;
    }
   
    
} ?>" >-->
<!--          <div class="col-md-2"><button class="btn btn-default btn-sm" type="button"><i class="icon-random"  ></i></button> </div>              -->
                        
                            
                    </form>
                                </td>
                            </tr>
                            <tr>
                        <td width="230px">      
                        
                            </td>
                        <td> </td>
                        <td> </td>
                        <td> </td>
                        <td>  </td>
                        <td> </td>
                        <td width="120px">
                            <b>Kembali</b> </td>
                               <td style="font-size:20px"> <b> Rp.  
                                   <?php if(empty($this->input->post('bayar'))){ 
                                        echo "0"; 
                                            }else{ 
                 echo number_format( $this->input->post('bayar') -  $ttd);
                                    } ?> </b> </td>
                            </tr>
                            <tr>
                        <td width="230px">      
                        
                            </td>
                        <td> </td>
                        <td>  </td>
                        <td> </td>
                        <td> </td>
                        <td> </td>
                        <td style="font-size:20px">
                                                        
<script>
function myFunction() {
    window.print();
}
</script>
                            
                            <?php 
                          
                            if(empty($ttd)){
                            }else{
                                 $nama = $data['data_ss1']->nama_pembeli;
                            $de= base64_encode($this->input->post('bayar'));
                            $has =  $this->input->post('bayar') -  $ttd;
                            $de1 = base64_encode($has);
                            $de2 = base64_encode($ttd);
                            $nm = base64_encode($nama);
                            }
                            ?>
                            <?php if(!empty($ttd)){ ?>
                            <a href="<?php echo base_url() ?>print_ex/cetak_struk/?de=<?php echo $de ?>&dey=<?php echo $de1 ?>&dex=<?php echo $de2; ?>&op=<?php echo $nm ?>" target="_blank" class="btn btn-default btn-sm" style="
    float: right;">Cetak</a>
                            <?php }else{} ?>
                             </td>
                               
                                <td style="font-size:20px">
                        <form method="post" action="<?php echo base_url() ?>kasir/simpan_penjualan">
            <input type="hidden" name="kode" value="<?php if(empty($record['kd_nota'])){}else{ echo $record['kd_nota']; } ?>" >
            <input type="hidden" name="nama_kasir" value="<?php echo $user_ion->first_name ?>">
            <input type="hidden" name="nama_pem" value="<?php echo $this->input->get('pembeli'); ?>">
            <input type="hidden" name="kd_penjualan" value="<?php if(empty($record['kd_penjualan'])){}else{ echo $record['kd_penjualan']; } ?>">
            <?php if(!empty($this->input->post('bayar'))){ ?>
            <input type="hidden" name="tidakbayar" value="iya">                
            <?php }else{ ?>
                <input type="hidden" name="tidakbayar" value="tidak">                
            <?php } ?>
            <input type="hidden" name="total_harga" value="<?php if(empty($ttd)){}else{ 
    
   echo $ttd;
    
} ?><?php //if(empty($total)){}else{ 
    
   //echo $total;
    
//} ?>" >

                           
                                   <button class="btn btn-default btn-sm" type="submit" >Selesai</button>
                            
                                    
                            
                            
                                   </form>
                                </td>
                            </tr>
                        </tbody>
                            
                    </table>
    </div>
</div>
    </div>
</div>
<!-- /main -->
