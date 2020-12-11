<div class="content-wrapper">

 <div class="container-fluid">

   <section class="content">

   <div class="row">

       <div class="col-md-10">

         <h4><b>Data Buku Bank Kas Toko</b></h4>

       </div>

       <div class="col-md-2">

         <button type="button" class="btn btn-primary btn-flat pull-right" data-toggle="modal" data-target="#myModal" style="margin:5px;"><i class="fa fa-plus"></i> Input Buku Bank</button>

       </div>

       <div class="col-md-12">

         <hr>

         <?php echo $this->session->flashdata('alert'); ?>

       </div>



       <div class="col-md-12">

         <form method="post" action="<?= base_url('kelengkapan_pegawai/view/ac'); ?>">

           <div class="col-md-3">

             <div class="form-group">

               <label>Mulai Tanggal</label>

               <input type="text" class="form-control datepicker" name="start_tgl">

             </div>

           </div>

           <div class="col-md-3">

             <div class="form-group">

               <label>Sampai Tanggal</label>

               <input type="text" class="form-control datepicker" name="end_tgl">

             </div>

           </div>

           <div class="col-md-3">

           <label style="visibility: hidden;">1</label>

             <div class="form-group">

               <button class="btn btn-primary btn-flat" type="submit">Cari</button>

             </div>

           </div>

         </form>

       </div>



        <div class="nav-tabs-custom">

          <div class="col-md-12">

            <?

              if($this->uri->segment(3) == 'ac'){

              ?>

              <a href="<?= base_url('kelengkapan_pegawai/cetak_buku/'.$this->input->post('start_tgl').'/'.$this->input->post('end_tgl').'/'.$this->input->post('operator').'') ?>" target="_blank" class="btn btn-info btn-flat pull-right" type="button"><i class="fa fa-print"></i> Print</a>

              <? }else{ ?>

              <a href="<?= base_url('kelengkapan_pegawai/cetak_buku') ?>" target="_blank" class="btn btn-info btn-flat pull-right" type="button" style="margin:5px;"><i class="fa fa-print"></i> Print</a>

              <? } ?>

              <?

              if($this->uri->segment(3) == 'ac'){

              ?>

              <a href="<?= base_url('kelengkapan_pegawai/export_buku/'.$this->input->post('start_tgl').'/'.$this->input->post('end_tgl').'/'.$this->input->post('operator').'') ?>" class="btn btn-success btn-flat pull-right"><i class="fa fa-file-excel-o"></i> Export</a>

              <? }else{ ?>

              <a href="<?= base_url('kelengkapan_pegawai/export_buku') ?>" class="btn btn-success btn-flat pull-right" style="margin:5px;"><i class="fa fa-file-excel-o"></i> Export</a>

              <? } ?>



            </div>

          <div class="col-md-12">

          <hr>

          <div class="table-responsive" style="width:100%;">

            <table class="table table-bordered datatable">

              <thead>

                <tr>

                  <th>No</th>

                  <th>Sumber Dana</th>

                  <th>Tanggal</th>

                  <th>Kode</th>

                  <th>Uraian Kode</th>

                  <th>Keterangan</th>

                  <th>Debit</th>

                  <th>Kredit</th>

                  <th>Aksi</th>

                </tr>

              </thead>

              <tbody>

                <?php $no=0; $sum_debit=0; $sum_kredit=0; foreach($kelengkapan as $k): $no++ ?>

                <tr>

                  <td><?php echo $no ?></td>

                  <td><?php echo $k->uraian_kode ?></td>

                  <td><?php echo tgl_indo(date('Y-m-d',strtotime($k->tanggal))) ?></td>

                  <td><?php echo $k->kode ?></td>

                  <td><?php echo $k->uraian_kode ?></td>

                  <td><?php echo $k->keterangan ?></td>

                  <td><?php echo $k->debit ?></td>

                  <td><?php echo $k->kredit ?></td>

                  <td>



                  </td>

                </tr>

              <?php

              $sum_deb[$no] = $k->debit;

              $sum_debit += $sum_deb[$no];

              $sum_kre[$no] = $k->kredit;

              $sum_kredit += $sum_kre[$no];

              ?>

              <?php endforeach; ?>

              </tbody>

            </table>

            <table class="table table-striped">

              <tr style="background:#27ae60;">

                <td style="color:#fff;"><b>TOTAL</b></td>

                <td style="color:#fff;"><b>DEBIT : <?php echo 'Rp. '.number_format($sum_debit); ?></b></td>

                <td style="color:#fff;"><b>KREDIT : <?php echo 'Rp. '.number_format($sum_kredit); ?></b></td>

                <td style="color:#fff;"><b>SALDO : <?php echo 'Rp. '.number_format($sum_kredit-$sum_debit); ?></b></td>

              </tr>

            </table>

          </div>



          </div>

        </div>



       </div>

   </div>

 </section>

 </div>

</div>

