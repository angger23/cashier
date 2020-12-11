<div class="content-wrapper">
  <div class="container-fluid">
    <section class="content">
      <div class="row">
        <p class="text-right"> <?php echo nama_hari(date('Y-m-d')) ?> <?php echo tgl_indo(date('Y-m-d')) ?> , <b id="txt"></b> </p>
        <div class="col-lg-4 col-xs-6">
          <div class="small-box bg-aqua">
            <?php if(!$this->ion_auth->in_group(1) && !$this->ion_auth->in_group(6) && !$this->ion_auth->in_group(7)){ ?>
              <a href="javascript:void(0)">
            <?php }else{ ?>
            <a href="<?= base_url('kasir/data_supplier') ?>">
            <?php } ?>
            <div class="inner" style="padding: 10px 10px;color: #fff;">
              <?
              $suplier = $this->m_data->semua('supplier')->num_rows();
              $pelanggan = $this->m_data->semua('pembeli')->num_rows();
              $pembelian = $this->m_data->semua('pembelian_barang')->num_rows();
              $penjualan = $this->m_data->semua('penjualan_barang')->num_rows();
              ?>
              <h3><?= $suplier ?></h3>

              <p>Suplier</p>
            </div>
            <div class="icon">
              <i class="fa fa-shopping-cart"></i>
            </div>
            </a>
            <a href="#" class="small-box-footer">
              More info <i class="fa fa-arrow-circle-right"></i>
            </a>
          </div>
        </div>
        <div class="col-lg-4 col-xs-6">
          <div class="small-box bg-green">
            <?php if(!$this->ion_auth->in_group(1) && !$this->ion_auth->in_group(6) && !$this->ion_auth->in_group(7)){ ?>
              <a href="javascript:void(0)">
            <?php }else{ ?>
            <a href="<?= base_url('kasir/data_pelanggan') ?>">
            <?php } ?>
            <div class="inner" style="padding: 10px 10px;color: #fff;">
              <h3><?= $pelanggan ?></h3>

              <p>Pelanggan</p>
            </div>
            <div class="icon">
              <i class="fa fa-users"></i>
            </div>
            </a>
            <a href="#" class="small-box-footer">
              More info <i class="fa fa-arrow-circle-right"></i>
            </a>
          </div>
        </div>
        <?php if(!$this->ion_auth->in_group(1) && !$this->ion_auth->in_group(6) && !$this->ion_auth->in_group(7)){ ?>

        <?php }else{ ?>
        <div class="col-lg-4 col-xs-6">
          <div class="small-box bg-yellow">
            <a href="#" data-toggle="modal" data-target="#myModal">
            <div class="inner" style="padding: 10px 10px;color: #fff;">
              <h3>6</h3>

              <p>Laporan</p>
            </div>
            <div class="icon">
              <i class="fa fa-file-text-o"></i>
            </div>
            </a>
            <a href="#" class="small-box-footer">
              More info <i class="fa fa-arrow-circle-right"></i>
            </a>
          </div>
        </div>
      <?php } ?>
        <div id="myModal" class="modal fade" role="dialog">
          <div class="modal-dialog">

            <div class="modal-content">
              <div class="modal-header" style="background-color:#e67e22;">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title" style="color:#fff;"><b>Laporan</b></h4>
              </div>
              <div class="modal-body">
                <a href="<?= base_url('grafik/grafik_omzet_penjualan') ?>" class="btn btn-default btn-flat btn-block"><b>Laporan Grafik Omzet Penjualan</b></a>
                <a href="<?= base_url('grafik/laporan_rekap_laba') ?>" class="btn btn-default btn-flat btn-block"><b>Laporan Grafik Laba Penjualan</b></a>
                <a href="<?= base_url('grafik/grafik_jumlah_transaksi_penjualan') ?>" class="btn btn-default btn-flat btn-block"><b>Laporan Grafik Jumlah Transaksi</b></a>
                <a href="<?= base_url('laporan_kas/masuk') ?>" class="btn btn-default btn-flat btn-block"><b>Laporan Kas Masuk</b></a>
                <a href="<?= base_url('laporan_kas/keluar') ?>" class="btn btn-default btn-flat btn-block"><b>Laporan Kas Keluar</b></a>
                <a href="<?= base_url('laporan_kas/cash_flow') ?>" class="btn btn-default btn-flat btn-block"><b>Laporan Cash Flow</b></a>
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-danger btn-flat" data-dismiss="modal">Tutup</button>
              </div>
            </div>

          </div>
        </div>

        <?php if(!$this->ion_auth->in_group(1) && !$this->ion_auth->in_group(6) && !$this->ion_auth->in_group(7)){ ?>

        <?php }else{ ?>
        <div class="col-lg-offset-2 col-lg-4 col-xs-6">
          <div class="small-box" style="color:#fff;background-color: #9b59b6;">
            <a href="<?= base_url('p/tambah_barang_suplier') ?>">
            <div class="inner" style="padding: 10px 10px;color: #fff;">
              <h3><?= $pembelian ?></h3>

              <p>Daftar Pembelian</p>
            </div>
            <div class="icon">
              <i class="fa fa-list-alt"></i>
            </div>
            </a>
            <a href="<?= base_url('p/tambah_barang_suplier') ?>" class="small-box-footer">
              More info <i class="fa fa-arrow-circle-right"></i>
            </a>
          </div>
      </div>
    <?php } ?>
      <div class="col-lg-4 col-xs-6">
          <div class="small-box bg-blue">
            <a href="<?= base_url('kasir/data_penjualan') ?>">
            <div class="inner" style="padding: 10px 10px;color: #fff;">
              <h3><?= $penjualan ?></h3>

              <p>Daftar Penjualan</p>
            </div>
            <div class="icon">
              <i class="fa fa-shopping-cart"></i>
            </div>
            </a>
            <a href="<?= base_url('kasir/data_penjualan') ?>" class="small-box-footer">
              More info <i class="fa fa-arrow-circle-right"></i>
            </a>
          </div>
        </div>
        <div class="col-lg-4 col-xs-6">
          <!-- small box -->
<!--
          <div class="small-box" style="background-color: #10ac84;color: #fff;">
            <a href="<?= base_url('kasir/kasir2') ?>">
            <div class="inner" style="padding: 10px 10px;color: #fff;">
              <h3><?= $penjualan ?><small style="color:#fff;font-size:13px;">transaksi penjualan</small></h3>

              <p>Input Penjualan</p>
            </div>
            <div class="icon">
              <i class="fa fa-bar-chart"></i>
            </div>
            </a>
            <a href="<?= base_url('kasir/kasir2') ?>" class="small-box-footer">
              More info <i class="fa fa-arrow-circle-right"></i>
            </a>
          </div>
-->

        </div>
    </div>
    <div class="row">
        <div class="col-lg-offset-3 col-lg-3 col-xs-6">
          <div class="small-box" style="background-color: #10ac84;color: #fff;">
            <a href="<?= base_url('kasir/kasir2') ?>">
            <div class="inner" style="padding: 10px 10px;color: #fff;">
<!--               <h3>44</h3> -->

              <p>Kasir Stikesmart</p>
            </div>
            <div class="icon" style="font-size: 50px;">
              <i class="fa fa-cart-plus" style="font-size: 50px;"></i>
            </div>
            </a>
            <a href="<?= base_url('kasir/kasir2') ?>" class="small-box-footer">
              Selanjutnya <i class="fa fa-arrow-circle-right"></i>
            </a>
          </div>
        </div>
        <div class="col-lg-3 col-xs-6">
          <div class="small-box bg-red">
            <a href="<?= base_url('auth/logout') ?>">
            <div class="inner" style="padding: 10px 10px;color: #fff;">
              <!-- <h3>65</h3> -->

              <p>Logout</p>
            </div>
            <div class="icon" style="font-size: 50px;">
              <i class="fa fa-sign-out" style="font-size: 50px;"></i>
            </div>
            </a>
            <a href="<?= base_url('auth/logout') ?>" class="small-box-footer">
              Logout <i class="fa fa-arrow-circle-right"></i>
            </a>
          </div>
      </div>
    </div>
    </section>
  </div>
</div>
