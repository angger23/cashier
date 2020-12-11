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
        <a href="<?php echo base_url('buku_umum/home/all') ?>" target="_blank">
          <div class="col-lg-3 col-xs-6" style="height:169px;">
            <!-- small box -->
            <div class="small-box bg-orange" style="height:123px;">
              <div class="inner">
                <h3>BKAU</h3>
  <!-- <br> -->
                <p>Buku Kas Anggota Umum</p>
              </div>
              <div class="icon">
                <i class="fa fa-users"></i>
              </div>
              <!-- <a href="#" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a> -->
            </div>
          </div>
        </a>
        <a href="<?php echo base_url('buku_umum/monitoring/PIKA/PPIKA/M1') ?>" target="_blank">
          <div class="col-lg-3 col-xs-6" style="height:169px;">
            <!-- small box -->
            <div class="small-box bg-aqua" style="height:123px;">
              <div class="inner">
                <h3>Monitoring</h3>
  <!-- <br> -->
                <p>Monitoring Piutang Intern Kas Anggota</p>
              </div>
              <div class="icon">
                <i class="fa fa-book"></i>
              </div>
              <!-- <a href="#" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a> -->
            </div>
          </div>
        </a>
        <a href="<?php echo base_url('buku_umum/monitoring/HIKA/KHIKA/M2') ?>" target="_blank">
          <div class="col-lg-3 col-xs-6" style="height:169px;">
            <!-- small box -->
            <div class="small-box bg-aqua" style="height:123px;">
              <div class="inner">
                <h3>Monitoring</h3>
  <!-- <br> -->
                <p>Monitoring Hutang Intern Kas Anggota</p>
              </div>
              <div class="icon">
                <i class="fa fa-book"></i>
              </div>
              <!-- <a href="#" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a> -->
            </div>
          </div>
        </a>
        <a href="javascript:void(0)" data-toggle="modal" data-target="#myModal">
          <div class="col-lg-3 col-xs-6" style="height:169px;">
            <!-- small box -->
            <div class="small-box bg-aqua" style="height:123px;">
              <div class="inner">
                <h3>Monitoring</h3>
  <!-- <br> -->
                <p>MONITORING KELENGKAPAN MAHASISWA PEGAWAI (HPP)</p>
              </div>
              <div class="icon">
                <i class="fa fa-book"></i>
              </div>
              <!-- <a href="#" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a> -->
            </div>
          </div>
        </a>
        <!-- watesssssssssssssssssssssssssssssssssssssss -->
        <!-- Modal -->
<div id="myModal" class="modal fade" role="dialog">
  <div class="modal-dialog">
    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Monitoring Kelengkapan Mahasiswa Pegawai (HPP)</h4>
      </div>
      <div class="modal-body">
        <div class="row">
          <div class="container-fluid">
            <div class="col-sm-4">
              <?php
              $arr = array('BSMKA','JSMKA',' JSptMKA','BSptKA','JTMKA','BTMKA');
              ?>
              <a href="<?php echo base_url('buku_umum/monitoring/M3/M3/M3') ?>" class="btn btn-primary btn-flat btn-sm" target="_blank">Kelengkapan MhsPgw (HPP)</a>
            </div>
            <div class="col-sm-4">
              <a href="<?php echo base_url('buku_umum/tagihan_ketua_toko') ?>" class="btn btn-primary btn-flat btn-sm" target="_blank">Penagihan Ketua Toko</a>
            </div>
            <div class="col-sm-4">
              <a href="<?php echo base_url('buku_umum/monitoring/M4/M4/M4') ?>" class="btn btn-primary btn-flat btn-sm" target="_blank">Monitoring Pelunasan Tagihan</a>
            </div>
          </div>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>
        <!-- watesssssssssssssssssssssssssssssssssssssss -->
<a href="<?php echo base_url('buku_umum/monitoring/M5/M5/M5') ?>" target="_blank">
  <div class="col-lg-3 col-xs-6" style="height:169px;">
    <!-- small box -->
    <div class="small-box bg-aqua" style="height:123px;">
      <div class="inner">
        <h3>Monitoring</h3>
<!-- <br> -->
        <p>MONITORING KELENGKAPAN MAHASISWA PEGAWAI (PIUTANG)</p>
      </div>
      <div class="icon">
        <i class="fa fa-book"></i>
      </div>
      <!-- <a href="#" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a> -->
    </div>
  </div>
</a>
        <div class="col-lg-3 col-xs-6" style="height:169px;">
          <!-- small box -->
          <div class="small-box bg-aqua" style="height:123px;">
            <div class="inner">
              <h3>Monitoring</h3>
<!-- <br> -->
              <p>RINCIAN POTONGAN GAJI</p>
            </div>
            <div class="icon">
              <i class="fa fa-book"></i>
            </div>
            <!-- <a href="#" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a> -->
          </div>
        </div>
        <a href="<?php echo base_url('buku_umum/piutang_uang_tunai') ?>" target="_blank">
        <div class="col-lg-3 col-xs-6" style="height:169px;">
          <!-- small box -->
          <div class="small-box bg-aqua" style="height:123px;">
            <div class="inner">
              <h3>Monitoring</h3>
<!-- <br> -->
              <p>Monitoring Piutang Uang Tunai Kas Anggota</p>
            </div>
            <div class="icon">
              <i class="fa fa-book"></i>
            </div>
            <!-- <a href="#" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a> -->
          </div>
        </div>
      </a>
        <a href="<?php echo base_url('buku_umum/simpanan_pokok') ?>" target="_blank">
          <div class="col-lg-3 col-xs-6" style="height:169px;">
            <!-- small box -->
            <div class="small-box bg-aqua" style="height:123px;">
              <div class="inner">
                <h3>Monitoring</h3>
  <!-- <br> -->
                <p>Monitoring Simpanan Pokok</p>
              </div>
              <div class="icon">
                <i class="fa fa-book"></i>
              </div>
              <!-- <a href="#" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a> -->
            </div>
          </div>
        </a>
        <a href="<?php echo base_url('buku_umum/simpanan_wajib') ?>" target="_blank">
          <div class="col-lg-3 col-xs-6" style="height:169px;">
            <!-- small box -->
            <div class="small-box bg-aqua" style="height:123px;">
              <div class="inner">
                <h3>Monitoring</h3>
  <!-- <br> -->
                <p>Monitoring Simpanan Wajib</p>
              </div>
              <div class="icon">
                <i class="fa fa-book"></i>
              </div>
              <!-- <a href="#" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a> -->
            </div>
          </div>
        </a>
        <?php
        $cari_kode = $this->m_data->semua('kode_transaksi2')->result();
        $no=0;
        foreach($cari_kode as $k){
        $no++;
        ?>
        <a href="<?= base_url('buku_umum/home/'.$k->kode.'') ?>" target="_blank">
          <div class="col-lg-3 col-xs-6" style="height:169px;">
            <!-- small box -->
            <div class="small-box bg-green" style="height:123px;">
              <div class="inner">
                <h3><?php echo $k->kode ?></h3>
                <p><?php echo $k->uraian_kode ?></p>
              </div>
              <div class="icon">
                <i class="fa fa-book"></i>
              </div>
              <!-- <a href="#" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a> -->
            </div>
          </div>
        </a>
       <? } ?>
    </div>
    </section>
  </div>
</div>
