<div class="content-wrapper">
  <div class="container-fluid">
    <section class="content">
      <div class="row">
        <div class="col-sm-3">
          <h3>Buku Kas Umum</h3>
        </div>
<div class="col-md-12">
  <hr>
</div>
<p class="text-right"> <?php echo nama_hari(date('Y-m-d')) ?> <?php echo tgl_indo(date('Y-m-d')) ?> , <b id="txt"></b> </p>

<?php
if($this->ion_auth->in_group(8)){

 ?>
        <a href="<?php echo base_url('buku_umum/home/all') ?>" target="_blank">
          <div class="col-lg-3 col-xs-6" style="height:169px;">
            <!-- small box -->
            <div class="small-box bg-orange" style="height:123px;">
              <div class="inner">
                <h3>BKAUA</h3>
                <p>Buku Kas Umum Anggota (Yuli)</p>
              </div>
              <div class="icon">
                <i class="fa fa-users"></i>
              </div>
            </div>
          </div>
        </a>
        <a href="<?php echo base_url('buku_umum/simpanan_pokok') ?>" target="_blank">
          <div class="col-lg-3 col-xs-6" style="height:169px;">
            <!-- small box -->
            <div class="small-box bg-green" style="height:123px;">
              <div class="inner">
                <h3>Simpanan Pokok</h3>
              </div>
              <div class="icon">
                <i class="fa fa-users"></i>
              </div>
            </div>
          </div>
        </a>
        <a href="<?php echo base_url('buku_umum/simpanan_wajib') ?>" target="_blank">
          <div class="col-lg-3 col-xs-6" style="height:169px;">
            <!-- small box -->
            <div class="small-box bg-green" style="height:123px;">
              <div class="inner">
                <h3>Simpanan Wajib</h3>
              </div>
              <div class="icon">
                <i class="fa fa-users"></i>
              </div>
            </div>
          </div>
        </a>
<?php }elseif($this->ion_auth->in_group(9)){ ?>
        <a href="<?php echo base_url('buku_umum/general_book') ?>" target="_blank">
          <div class="col-lg-3 col-xs-6" style="height:169px;">
            <!-- small box -->
            <div class="small-box bg-primary" style="height:123px;">
              <div class="inner">
                <h3>BKAUK</h3>
                <p>Buku Kas Umum Toko (Betty)</p>
              </div>
              <div class="icon">
                <i class="fa fa-users"></i>
              </div>
            </div>
          </div>
        </a>
<?php }else{ ?>
  <a href="<?php echo base_url('buku_umum/home/all') ?>" target="_blank">
    <div class="col-lg-3 col-xs-6" style="height:169px;">
      <!-- small box -->
      <div class="small-box bg-orange" style="height:123px;">
        <div class="inner">
          <h3>BKAUA</h3>
          <p>Buku Kas Umum Anggota (Yuli)</p>
        </div>
        <div class="icon">
          <i class="fa fa-users"></i>
        </div>
      </div>
    </div>
  </a>
  <a href="<?php echo base_url('buku_umum/general_book') ?>" target="_blank">
    <div class="col-lg-3 col-xs-6" style="height:169px;">
      <!-- small box -->
      <div class="small-box bg-primary" style="height:123px;">
        <div class="inner">
          <h3>BKAUK</h3>
          <p>Buku Kas Umum Toko (Betty)</p>
        </div>
        <div class="icon">
          <i class="fa fa-users"></i>
        </div>
      </div>
    </div>
  </a>
  <?php } ?>
  <?php
  if($this->ion_auth->is_admin()){
   ?>
   <a href="<?php echo base_url('buku_umum/piutang_pegawai') ?>" target="_blank">
     <div class="col-lg-3 col-xs-6" style="height:169px;">
       <!-- small box -->
       <div class="small-box bg-green" style="height:123px;">
         <div class="inner">
           <h3>PUTP</h3>
           <p>DAFTAR PIUTANG UANG TUNAI PEGAWAI</p>
         </div>
         <div class="icon">
           <i class="fa fa-users"></i>
         </div>
       </div>
     </div>
   </a>
  <a href="<?php echo base_url('buku_umum/monitoring') ?>" target="_blank">
    <div class="col-lg-3 col-xs-6" style="height:169px;">
      <!-- small box -->
      <div class="small-box bg-green" style="height:123px;">
        <div class="inner">
          <h3>PUTKT</h3>
          <p>Pengeluaran Piutang Uang Tunai (Piutang  Ekstern) KT</p>
        </div>
        <div class="icon">
          <i class="fa fa-users"></i>
        </div>
      </div>
    </div>
  </a>
  <a href="<?php echo base_url('buku_umum/monitoring2') ?>" target="_blank">
    <div class="col-lg-3 col-xs-6" style="height:169px;">
      <!-- small box -->
      <div class="small-box bg-green" style="height:123px;">
        <div class="inner">
          <h3>HKT</h3>
          <p>Pendapatan Pinjaman Uang Tunai (Hutang Ekstern) KT</p>
        </div>
        <div class="icon">
          <i class="fa fa-users"></i>
        </div>
      </div>
    </div>
  </a>
  <a href="<?php echo base_url('buku_umum/monitoring3') ?>" target="_blank">
    <div class="col-lg-3 col-xs-6" style="height:169px;">
      <!-- small box -->
      <div class="small-box bg-green" style="height:123px;">
        <div class="inner">
          <h3>PIKT</h3>
          <p>Pengeluaran Pinjaman Uang Tunai ke Kas Anggota (Piutang Intern) KT</p>
        </div>
        <div class="icon">
          <i class="fa fa-users"></i>
        </div>
      </div>
    </div>
  </a>
  <a href="<?php echo base_url('buku_umum/monitoring4') ?>" target="_blank">
    <div class="col-lg-3 col-xs-6" style="height:169px;">
      <!-- small box -->
      <div class="small-box bg-green" style="height:123px;">
        <div class="inner">
          <h3>HIKT</h3>
          <p>Pendapatan Pinjaman Uang Tunai dari Kas Anggota (Hutang Intern) KT</p>
        </div>
        <div class="icon">
          <i class="fa fa-users"></i>
        </div>
      </div>
    </div>
  </a>
  <a href="<?php echo base_url('buku_umum/monitoring5') ?>" target="_blank">
    <div class="col-lg-3 col-xs-6" style="height:169px;">
      <!-- small box -->
      <div class="small-box bg-green" style="height:123px;">
        <div class="inner">
          <h3>PPTKT</h3>
          <p>Pendapatan Pelunasan Piutang Toko KT</p>
        </div>
        <div class="icon">
          <i class="fa fa-users"></i>
        </div>
      </div>
    </div>
  </a>
<?php }elseif($this->ion_auth->in_group('9')){ ?>
  <a href="<?php echo base_url('buku_umum/monitoring') ?>" target="_blank">
    <div class="col-lg-3 col-xs-6" style="height:169px;">
      <!-- small box -->
      <div class="small-box bg-green" style="height:123px;">
        <div class="inner">
          <h3>PUTKT</h3>
          <p>Pengeluaran Piutang Uang Tunai (Piutang  Ekstern) KT</p>
        </div>
        <div class="icon">
          <i class="fa fa-users"></i>
        </div>
      </div>
    </div>
  </a>
  <a href="<?php echo base_url('buku_umum/monitoring2') ?>" target="_blank">
    <div class="col-lg-3 col-xs-6" style="height:169px;">
      <!-- small box -->
      <div class="small-box bg-green" style="height:123px;">
        <div class="inner">
          <h3>HKT</h3>
          <p>Pendapatan Pinjaman Uang Tunai (Hutang Ekstern) KT</p>
        </div>
        <div class="icon">
          <i class="fa fa-users"></i>
        </div>
      </div>
    </div>
  </a>
  <a href="<?php echo base_url('buku_umum/monitoring3') ?>" target="_blank">
    <div class="col-lg-3 col-xs-6" style="height:169px;">
      <!-- small box -->
      <div class="small-box bg-green" style="height:123px;">
        <div class="inner">
          <h3>PIKT</h3>
          <p>Pengeluaran Pinjaman Uang Tunai ke Kas Anggota (Piutang Intern) KT</p>
        </div>
        <div class="icon">
          <i class="fa fa-users"></i>
        </div>
      </div>
    </div>
  </a>
  <a href="<?php echo base_url('buku_umum/monitoring4') ?>" target="_blank">
    <div class="col-lg-3 col-xs-6" style="height:169px;">
      <!-- small box -->
      <div class="small-box bg-green" style="height:123px;">
        <div class="inner">
          <h3>HIKT</h3>
          <p>Pendapatan Pinjaman Uang Tunai dari Kas Anggota (Hutang Intern) KT</p>
        </div>
        <div class="icon">
          <i class="fa fa-users"></i>
        </div>
      </div>
    </div>
  </a>
  <a href="<?php echo base_url('buku_umum/monitoring5') ?>" target="_blank">
    <div class="col-lg-3 col-xs-6" style="height:169px;">
      <!-- small box -->
      <div class="small-box bg-green" style="height:123px;">
        <div class="inner">
          <h3>PPTKT</h3>
          <p>Pendapatan Pelunasan Piutang Toko KT</p>
        </div>
        <div class="icon">
          <i class="fa fa-users"></i>
        </div>
      </div>
    </div>
  </a>
<?php }else{} ?>
  <?php
  if($this->ion_auth->is_admin()){
   ?>
  <a href="<?php echo base_url('buku_umum/monitoring6') ?>" target="_blank">
    <div class="col-lg-3 col-xs-6" style="height:169px;">
      <!-- small box -->
      <div class="small-box bg-green" style="height:123px;">
        <div class="inner">
          <h3>PUTKA</h3>
          <p>Pengeluaran Piutang Uang Tunai Ekstern KA</p>
        </div>
        <div class="icon">
          <i class="fa fa-users"></i>
        </div>
      </div>
    </div>
  </a>
  <a href="<?php echo base_url('buku_umum/monitoring7') ?>" target="_blank">
    <div class="col-lg-3 col-xs-6" style="height:169px;">
      <!-- small box -->
      <div class="small-box bg-green" style="height:123px;">
        <div class="inner">
          <h3>HKA</h3>
          <p>Pendapatan Pinjaman Uang Tunai (Hutang Ekstern) KA</p>
        </div>
        <div class="icon">
          <i class="fa fa-users"></i>
        </div>
      </div>
    </div>
  </a>
  <a href="<?php echo base_url('buku_umum/monitoring8') ?>" target="_blank">
    <div class="col-lg-3 col-xs-6" style="height:169px;">
      <!-- small box -->
      <div class="small-box bg-green" style="height:123px;">
        <div class="inner">
          <h3>PIKA</h3>
          <p>Pengeluaran Pinjaman Uang Tunai ke Kas Kecil (Piutang Intern) KA</p>
        </div>
        <div class="icon">
          <i class="fa fa-users"></i>
        </div>
      </div>
    </div>
  </a>
  <a href="<?php echo base_url('buku_umum/monitoring9') ?>" target="_blank">
    <div class="col-lg-3 col-xs-6" style="height:169px;">
      <!-- small box -->
      <div class="small-box bg-green" style="height:123px;">
        <div class="inner">
          <h3>HIKA</h3>
          <p>Pendapatan Pinjaman Uang Tunai dari Kas Kecil (Hutang Intern) KA</p>
        </div>
        <div class="icon">
          <i class="fa fa-users"></i>
        </div>
      </div>
    </div>
  </a>
  <a href="<?php echo base_url('buku_umum/simpanan_pokok') ?>" target="_blank">
    <div class="col-lg-3 col-xs-6" style="height:169px;">
      <!-- small box -->
      <div class="small-box bg-green" style="height:123px;">
        <div class="inner">
          <h3>Simpanan Pokok</h3>
        </div>
        <div class="icon">
          <i class="fa fa-users"></i>
        </div>
      </div>
    </div>
  </a>
  <a href="<?php echo base_url('buku_umum/simpanan_wajib') ?>" target="_blank">
    <div class="col-lg-3 col-xs-6" style="height:169px;">
      <!-- small box -->
      <div class="small-box bg-green" style="height:123px;">
        <div class="inner">
          <h3>Simpanan Wajib</h3>
        </div>
        <div class="icon">
          <i class="fa fa-users"></i>
        </div>
      </div>
    </div>
  </a>
<?php }elseif($this->ion_auth->in_group('8')){ ?>
  <a href="<?php echo base_url('buku_umum/monitoring6') ?>" target="_blank">
    <div class="col-lg-3 col-xs-6" style="height:169px;">
      <!-- small box -->
      <div class="small-box bg-green" style="height:123px;">
        <div class="inner">
          <h3>PUTKA</h3>
          <p>Pengeluaran Piutang Uang Tunai Ekstern KA</p>
        </div>
        <div class="icon">
          <i class="fa fa-users"></i>
        </div>
      </div>
    </div>
  </a>
  <a href="<?php echo base_url('buku_umum/monitoring7') ?>" target="_blank">
    <div class="col-lg-3 col-xs-6" style="height:169px;">
      <!-- small box -->
      <div class="small-box bg-green" style="height:123px;">
        <div class="inner">
          <h3>HKA</h3>
          <p>Pendapatan Pinjaman Uang Tunai (Hutang Ekstern) KA</p>
        </div>
        <div class="icon">
          <i class="fa fa-users"></i>
        </div>
      </div>
    </div>
  </a>
  <a href="<?php echo base_url('buku_umum/monitoring8') ?>" target="_blank">
    <div class="col-lg-3 col-xs-6" style="height:169px;">
      <!-- small box -->
      <div class="small-box bg-green" style="height:123px;">
        <div class="inner">
          <h3>PIKA</h3>
          <p>Pengeluaran Pinjaman Uang Tunai ke Kas Kecil (Piutang Intern) KA</p>
        </div>
        <div class="icon">
          <i class="fa fa-users"></i>
        </div>
      </div>
    </div>
  </a>
  <a href="<?php echo base_url('buku_umum/monitoring9') ?>" target="_blank">
    <div class="col-lg-3 col-xs-6" style="height:169px;">
      <!-- small box -->
      <div class="small-box bg-green" style="height:123px;">
        <div class="inner">
          <h3>HIKA</h3>
          <p>Pendapatan Pinjaman Uang Tunai dari Kas Kecil (Hutang Intern) KA</p>
        </div>
        <div class="icon">
          <i class="fa fa-users"></i>
        </div>
      </div>
    </div>
  </a>

<?php }else{} ?>

    </div>
    </section>
  </div>
</div>
