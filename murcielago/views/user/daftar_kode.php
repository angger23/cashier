<div class="content-wrapper">
 <div class="container-fluid">
   <section class="content">
   <div class="row">
       <div class="col-md-10">
         <h4><b>Data Kode Transaksi </b></h4>
       </div>
       <div class="col-md-2">
         <button type="button" class="btn btn-primary btn-flat pull-right" data-toggle="modal" data-target="#myModal" style="margin:5px;"><i class="fa fa-plus"></i> Input Kode Transaksi</button>
         <!-- Modal -->
          <div id="myModal" class="modal fade" role="dialog">
            <div class="modal-dialog">
              <!-- Modal content-->
              <div class="modal-content">
                <div class="modal-header">
                  <button type="button" class="close" data-dismiss="modal">&times;</button>
                  <h4 class="modal-title">Input Buku Kas Umum</h4>
                </div>
                <div class="modal-body">
                  <div class="form-group">
                    <form action="<?php echo base_url('p/add_new_kode') ?>" method="post">
                      <div class="form-group">
                        <label for="">Kode Transaksi</label>
                        <input type="text" name="kd_transaksi" class="form-control" value="">
                      </div>
                      <div class="form-group">
                        <label for="">Uraian Kode</label>
                        <input type="text" name="uraian_kode" class="form-control" value="">
                      </div>
                      <div class="form-group">
                        <label for="">Status Kode</label>
                        <select class="form-control select2" name="status_kode">
                          <option value="">Pilih Status</option>
                          <option value="Kas Anggota">Kas Anggota</option>
                          <option value="Kas Toko">Kas Toko</option>
                        </select>
                      </div>
                      <div class="form-group">
                        <button type="submit" class="btn btn-primary btn-flat">Update Kode Transaksi</button>
                      </div>
                    </form>
                  </div>
                </div>
                <div class="modal-footer">
                  <button type="button" class="btn btn-danger btn-flat" data-dismiss="modal">Tutup</button>
                </div>
              </div>
            </div>
          </div>
       </div>
       <div class="col-md-12">
         <hr>
         <?php echo $this->session->flashdata('alert'); ?>
       </div>
       <div class="col-md-12">
         <table class="table table-bordered datatable-biasa">
            <thead>
              <tr>
                <th>No</th>
                <th>Kode</th>
                <th>Uraian Kode</th>
                <th>Status Kode</th>
                <th>Aksi</th>
              </tr>
            </thead>
            <tbody>
              <?php
              $kode = $this->m_data->semua('kode_transaksi')->result();
              $no=0;
              foreach($kode as $k){
              $no++;
               ?>
              <tr>
                <td><?php echo $no ?></td>
                <td><?php echo $k->kode ?></td>
                <td><?php echo $k->uraian_kode ?></td>
                <td><?php echo $k->status ?></td>
                <td>
                  <button type="button" class="btn btn-info btn-flat btn-sm" name="button" data-toggle="modal" data-target="#myModalx<?php echo $no ?>"><i class="fa fa-edit"></i></button>
                  <a href="<?php echo base_url('p/delete_kode/'.$k->kd_transaksi.'') ?>" type="button" class="btn btn-danger btn-flat btn-sm" name="button"><i class="fa fa-trash"></i></a>
                </td>
              </tr>
              <!-- Modal -->
              <div id="myModalx<?php echo $no ?>" class="modal fade" role="dialog">
                <div class="modal-dialog">

                  <!-- Modal content-->
                  <div class="modal-content">
                    <div class="modal-header">
                      <button type="button" class="close" data-dismiss="modal">&times;</button>
                      <h4 class="modal-title">Edit Kode</h4>
                    </div>
                    <div class="modal-body">
                      <form action="<?php echo base_url('p/update_kode/'.$k->kd_transaksi.'') ?>" method="post">
                        <div class="form-group">
                          <label for="">Kode Transaksi</label>
                          <input type="text" name="kd_transaksi" class="form-control" value="<?php echo $k->kode ?>">
                        </div>
                        <div class="form-group">
                          <label for="">Uraian Kode</label>
                          <input type="text" name="uraian_kode" class="form-control" value="<?php echo $k->uraian_kode ?>">
                        </div>
                        <div class="form-group">
                          <label for="">Status Kode</label>
                          <select class="form-control select2" name="status_kode">
                            <option value="">Pilih Status</option>
                            <option value="Kas Anggota" <?php echo ($k->status == 'Kas Anggota') ? 'selected' : '' ?>>Kas Anggota</option>
                            <option value="Kas Toko" <?php echo ($k->status == 'Kas Toko') ? 'selected' : '' ?>>Kas Toko</option>
                          </select>
                        </div>
                        <div class="form-group">
                          <button type="submit" class="btn btn-primary btn-flat">Update Kode Transaksi</button>
                        </div>
                      </form>
                    </div>
                    <div class="modal-footer">
                      <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    </div>
                  </div>

                </div>
              </div>
            <?php } ?>
            </tbody>
          </table>
       </div>

   </div>
 </section>
 </div>
</div>
