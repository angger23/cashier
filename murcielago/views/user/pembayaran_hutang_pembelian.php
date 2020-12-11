<div class="content-wrapper">
  <div class="container-fluid">
    <section class="content">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <div class="main" style="padding-bottom: 100px;">
        <div class="main-inner">
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <h3 style="margin: 0px;" class="pull-left"><b class="pull-left">Pembayaran Hutang Pembelian Supplier</b></h3>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <hr>
                        <?= $this->session->flashdata('alert'); ?>
                    </div>
                </div>
                <div class="row">
                    <form action="<?= base_url('p/pembayaran_hutang_pembelian')?>" method="post">
                        <div class="col-md-4">
                            <label>Nama Supplier</label>
<!--                            <input type="text" class="form-control" name="supplier">-->
                            <select class="form-control selectku" name="supplier">
                                <option>Pilih Supplier</option>
                                <?
                                    $supplier = $this->m_data->semua('supplier')->result();
                                    foreach($supplier as $s){
                                ?>
                                <option value="<?= $s->kd_supplier ?>"><?= $s->nama_supplier ?></option>
                                <? } ?>
                            </select>
                        </div>
                        <div class="col-md-2">
                            <button type="text" class="btn btn-primary btn-flat" style="margin-top:24px;"><i class="fa fa-search"></i>&nbsp;&nbsp;Cari</button>
                        </div>
                    </form>
                </div>
                <? if(empty($this->input->post('supplier'))){ ?>
                <div class="row">
                    <div class="col-md-12" style="padding-top:100px;">
                        <blockquote>
                            <p>Harap masukkan nama supplier terlebih dahulu untuk menampilkan data</p>
                            <small>Stikesmart</small>
                        </blockquote>   
                    </div>
                </div>
                <? }else{ ?>
                <div class="row">
                    <div class="col-md-12">
                        <hr>
                    </div>
                    <div class="col-md-12">
                        <div class="table-responsive">
                            <table class="table table-bordered table-striped datatable">
                                <thead>
                                    <tr>
                                        <td style="width:50px;"><b>No</b></td>
                                        <td><b>Nama Supplier</b></td>
                                        <td><b>Kekurangan Biaya</b></td>
                                        <td><b>Jatuh Tempo</b></td>
                                        <td><b>Bayar</b></td>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?
                                        $no=0;
                                        foreach($hutang_pembelian as $h):
                                        $no++;
                                    ?>
                                    <tr>
                                        <td><?= $no ?></td>
                                        <td><?= $h->nama_supplier ?></td>
                                        <td>Rp. <?= number_format($h->kekurangan_biaya) ?></td>
                                        <td><?= tgl_indo(date('Y-m-d', strtotime($h->tgl_tempo))) ?></td>
                                        <td>
                                            <button type="button" class="btn btn-info btn-flat" data-toggle="modal" data-target="#myModal<?= $h->id_join_kredit ?>">Bayar</button>
                                        </td>
                                    </tr>
                                    
                                    <? endforeach; ?>
                                </tbody>
                            </table>
                            <?
                                $no=0;
                                foreach($hutang_pembelian as $h):
                                $no++;
                            ?>
                            <div id="myModal<?= $h->id_join_kredit ?>" class="modal fade" role="dialog">
                                      <div class="modal-dialog">
                                        <div class="modal-content">
                                          <div class="modal-header">
                                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                                            <h4 class="modal-title">Pembayaran</h4>
                                          </div>
                                          <div class="modal-body">
                                              <div class="row">
                                                <div class="col-md-12">
                                                    <button type="button" onclick="detail()" class="btn btn-warning btn-flat btn-sm">Detail Pembayaran</button>
                                                  </div>
                                              </div>
                                              <div class="row" id="detail">
                                                  <div class="col-md-12">
                                                    <hr>
                                                  </div>
                                                <div class="col-md-12">
                                                      <div class="table-responsive">
                                                        <table class="table table-bordered table-striped">
                                                            <thead>
                                                                <tr>
                                                                    <td><b>No</b></td>
                                                                    <td><b>Keterangan</b></td>
                                                                    <td><b>Nominal</b></td>
                                                                    <td><b>Tanggal Pembayaran</b></td>
                                                                </tr>
                                                            </thead>
                                                            <tbody>
                                                                <?
                                                                    $join_detail = $this->m_data->where('join_pembayaran_kredit',['id_join_kredit' => $h->id_join_kredit])->result();
                                                                    $no=0;
                                                                    foreach($join_detail as $j):
                                                                    $no++;
                                                                ?>
                                                                <tr>
                                                                    <td><?= $no ?></td>
                                                                    <td><?= $j->keterangan ?></td>
                                                                    <td>Rp. <?= number_format($j->nominal) ?></td>
                                                                    <td><?= tgl_indo(date('Y-m-d', strtotime($j->tgl_pembayaran))) ?></td>
                                                                </tr>
                                                                <? endforeach; ?>
                                                                
                                                                <tr>
                                                                    <td colspan="2"><b>Total Kekurangan</b></td>
                                                                    <td><b>Rp. <?= number_format($h->kekurangan_biaya) ?></b></td>
                                                                    <td></td>
                                                                </tr>
                                                                <tr>
                                                                    <td colspan="2"><b>Total Bayar</b></td>
                                                                    <td><b>Rp. <?= number_format($h->total_harga) ?></b></td>
                                                                    <td></td>
                                                                </tr>
                                                            </tbody>
                                                      </table>
                                                    </div>
                                                      </div>
                                              </div>
                                              <script>
                                                  $('#detail').hide();
                                                function detail(){
                                                  $('#detail').slideToggle();
                                                }
                                              </script>
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <hr>
                                                </div>
                                                <?
                                                    if($h->kekurangan_biaya == '0'){
                                                ?>
                                                <div class="col-md-12">
                                                    <blockquote>
                                                        <p>Anda Sudah Lunas</p>
                                                      </blockquote>
                                                </div>
                                                <? }else{ ?>
                                                <form action="<?= base_url() ?>p/tambah_pembayaran/<?= $h->id_join_kredit ?>" method="post">
                                                    <div class="col-md-12">
                                                        <label>Keterangan</label>
                                                        <textarea class="form-control" name="keterangan" style="resize:none;"></textarea>
                                                    </div>  
                                                    <div class="col-md-12" style="margin-top:10px;">
                                                        <label>Nominal</label>
                                                        <input type="text" class="form-control" onkeydown="return numbersonly(this, event);" onkeyup="javascript:tandaPemisahTitik(this);" name="nominal">
                                                    </div>  
                                                    <div class="col-md-12" style="margin-top:10px;">
                                                        <button type="submit" class="btn btn-primary btn-flat btn-block">Simpan</button>
                                                    </div>
                                                </form>
                                                <? } ?>
                                            </div>
                                          </div>
                                          <div class="modal-footer">
                                            <button type="button" class="btn btn-danger btn-flat" data-dismiss="modal">Tutup</button>
                                          </div>
                                        </div>

                                      </div>
                                    </div>
                            <? endforeach; ?>
                        </div>
                    </div>
                </div>
                <? } ?>
            </div>
        </div>
        </div>
      </section>
    </div>
</div>