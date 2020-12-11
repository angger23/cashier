<div class="content-wrapper">
    <div class="container-fluid">
        <section class="content">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
            <div class="main" style="padding-bottom: 100px;">
                <div class="main-inner">
                    <div class="container">
                        <!---->
                        <div class="row">
                            <? if(empty($this->input->post('hari1'))){ ?>
                            <div class="col-md-12">
                                <h3 style="margin: 0px;" class="pull-left"><b class="pull-left">Laporan Kas (Cash Flow)</b></h3>
                            </div>
                            <? }else{ ?>
                            <div class="col-md-8">
                                <h3 style="margin: 0px;" class="pull-left"><b class="pull-left">Laporan Kas (Cash Flow)</b></h3>
                            </div>
                            <div class="col-md-4">
                                <a href="<?= base_url('laporan_kas/export_cash_flow/'.$this->input->post('hari1').'/'.$this->input->post('hari2').''); ?>" class="btn btn-success btn-flat pull-right"><i class="fa fa-file-excel-o"></i> Export</a>
                                 <a href="<?= base_url('laporan_kas/print_cash_flow/'.$this->input->post('hari1').'/'.$this->input->post('hari2').''); ?>" class="btn btn-primary btn-flat pull-right" target="_blank"><i class="fa fa-print"></i> Print</a>
                            </div>
                            <? } ?>
                        </div>
                        <!---->
                        <div class="row">
                            <div class="col-md-12">
                                <hr>
                            </div>
                        </div>
                        <!---->
                        <div class="row">
                            <form action="" method="post">
                                <div class="col-md-2"></div>
                                <div class="col-md-3">
                                    <label>Mulai Hari</label>
                                    <input type="text" class="form-control datepicker" name="hari1">
                                </div>
                                <div class="col-md-3">
                                    <label>Sampai Hari</label>
                                    <input type="text" class="form-control datepicker" name="hari2">
                                </div>
                                <div class="col-md-2">
                                    <button type="submit" style="margin-top:24px;" class="btn btn-primary btn-flat"><i class="fa fa-search"></i>&nbsp;&nbsp;Cari</button>
                                </div>
                                <div class="col-md-2"></div>
                            </form>
                        </div>
                        <!---->
                        <?
                            if(empty($this->input->post('hari1'))){
                        ?>
                        <div class="row">
                            <div class="col-md-12" style="padding:50px 0px;"></div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <blockquote>
                                    <p>Harap memilih tanggal terlebih dahulu untuk menampilkan data</p>
                                    <small>Stikesmart</small>
                                  </blockquote>
                            </div>
                        </div>
                        <? }else{ ?>
                        <div class="row">
                            <div class="col-md-12">
                                <hr>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="table-responsive">
                                    <table class="table table-bordered table-striped datatable">
                                        <thead>
                                            <tr>
                                                <td style="width:50px;"><b>No.</b></td>
                                                <td><b>Tanggal Transaksi</b></td>
                                                <td><b>Debet</b></td>
                                                <td><b>Kredit</b></td>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?
                                                $no=0;
                                                foreach($kas as $k){
                                                $no++;
                                            ?>
                                            <tr>
                                                <td><?= $no ?></td>
                                                <td><?= tgl_indo(date('Y-m-d', strtotime($k->tanggal_transaksi))) ?></td>
                                                <td><? if(empty($k->debet)){echo'-';}else{echo 'Rp. '.'<span class="pull-right">'.number_format($k->debet).'</span>';} ?></td>
                                                <td><? if(empty($k->kredit)){echo'-';}else{echo 'Rp. '.'<span class="pull-right">'.number_format($k->kredit).'</span>';} ?></td>
                                            </tr>
                                            <? } ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                        <!---->
                        <div class="row">
                            <div class="col-md-12">
                                <?
                                    $no = 0;
                                    $total_debet=0;
                                    $total_kredit=0;
                                    foreach($kas as $d){
                                        $no++;
                                        $totaldebet[$no] = $d->debet;
                                        $total_debet += $totaldebet[$no];
                                        
                                        $totalkredit[$no] = $d->kredit;
                                        $total_kredit += $totalkredit[$no];
                                    }
                                ?>
                                <h4 style="background-color:#27ae60;padding: 10px 18px;color: #fff;"><b>Total Debet : <span class="pull-right"><span style="margin-right:30px;">Rp.</span> <?= number_format($total_debet) ?></span></b></h4>
                                <h4 style="background-color:#27ae60;padding: 10px 18px;color: #fff;"><b>Total Kredit : <span class="pull-right"><span style="margin-right:30px;">Rp.</span> <?= number_format($total_kredit) ?></span></b></h4>
                                <? $total_kas = $total_debet-$total_kredit; ?>
                                <h4 style="background-color:#2980b9;padding: 10px 18px;color: #fff;"><b>Total Kas : <span class="pull-right"><span style="margin-right:30px;">Rp.</span> <?= number_format($total_kas) ?></span></b></h4>
                            </div>
                        </div>
                        <? } ?>
                    </div>
                </div>
            </div>
        </section>
    </div>
</div>
        