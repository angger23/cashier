<div class="col-md-4 col-sm-4">
    <div class="callout callout-success">
      <?
      $cari_nota = $this->m_data->where('penjualan_barang',['kd_penjualan' => $kd_jual])->row();
      $list_checkout = $this->m_data->list_checkout($kd_jual)->result();
      $list_cek = $this->m_data->where('penjualan_sementara',['kd_nota' => $cari_nota->kd_nota])->num_rows();
      ?>
      <h4>Nomor Nota  : <?= $cari_nota->kd_nota ?></h4>
    </div>
  </div>
  <? if($list_cek == 0){echo '
<div class="col-md-4">
  <div class="callout callout-danger">
                <h4>Ups ! Data Kosong</h4>
              </div></div>';}else{ ?>
  <table class="table table-bordered">
    <thead>
      <tr>
        <th>No</th>
        <th>Nama Barang</th>
        <th>Harga Jual</th>
        <th>Jumlah Beli</th>
        <th>Diskon</th>
        <th colspan="2">Total</th>
      </tr>
    </thead>
    <tbody>
      <? 
      $no=0;
      $ttk=0;
      $dis=0;
      foreach($list_checkout as $li){
      $no++;
      ?>
      <tr>
        <td><?= $no ?></td>
        <td><?= $li->nama_barang ?></td>
        <td>Rp <?= number_format($li->harga_pokok) ?></td>
        <td><?= $li->satuan?></td>
        <? 
        $cari_diskon = $this->m_data->where('barang',['kode_barang' => $li->kode_barang])->row();
        ?>
        <td><?= ($li->satuan >= $cari_diskon->kelipatan) ? $cari_diskon->diskon : '0'; ?>%</td>
        <td>Rp <? 
        if($cari_diskon->kelipatan == '0'){
          echo number_format($li->harga_pokok * $li->satuan);
            $ttl = $li->harga_pokok * $li->satuan;
        }else{
          if($li->satuan >= $cari_diskon->kelipatan){
            $disc = $cari_diskon->diskon / 100 * ($li->harga_pokok * $li->satuan);
            echo number_format(($li->harga_pokok * $li->satuan)-$disc);
            $ttl = ($li->harga_pokok * $li->satuan)-$disc;
          }else{
            echo number_format($li->harga_pokok * $li->satuan);
            $ttl = $li->harga_pokok * $li->satuan;
          }
        }
        ?></td>
        <td>
          <button class="btn btn-danger btn-flat" type="button" onclick="delete_checkout<?= $no ?>(<?= $li->id_cek ?>)"><i class="fa fa-trash"></i></button>
        </td>
      </tr>
      <script type="text/javascript">
           function delete_checkout<?= $no ?>(id_cek){
              jQuery.ajax({
                type: 'GET',
                url: "<?= base_url() ?>"+"kasir/delete_checkout",
                data: {id_cek:id_cek},
                success: function(data) {
                   $("#load5").load("<?= base_url() ?>"+"kasir/load_list_data/<?= $li->kd_penjualan ?>");
                  //alert('Berhasil Hapus Data !');
                  showSuccessMessage();
                },
              error: function (data) {
                  showSuccessMessage1();
              }                           
              });
          }
      </script>
    <?
    $diskon[$no] = ($li->satuan >= $cari_diskon->kelipatan) ? $cari_diskon->diskon : '0';
    $dis += $diskon[$no];
    $total_harga[$no] = $ttl;
    $ttk += $total_harga[$no];
  } ?>
    </tbody>
  </table>
  <div class="col-md-6">
    
  </div>
  <div class="col-md-6">
      <div class="panel panel-info">
        <div class="panel-heading">
          <h4>Checkout</h4>
        </div>
        <div class="panel-body">
        <table class="table table-condensed">
            <tbody>
              <tr>
                <td>Total Pembelian</td>
                <td>Rp <?= number_format($ttk) ?></td>
              </tr>
              <tr>
                <td>Bayar</td>
                <td><input type="text" id="bayar" class="form-control" onkeyup="ketik()"></td>
              </tr>
              <tr id="lod6">
                
              </tr>
            </tbody>
          </table>
          <script type="text/javascript">
            var totalnya;
            function ketik(){
              var total=0;
              var val = parseInt($('#bayar').val());
              var total =  val - <?= $ttk ?>;
              if(isNaN(total)){
                total = 0;
              }else{
                total = total;
              }
             $("#lod6").html('<td>Kembalian</td><td>Rp '+addCommas(total)+'</td>');
             $("#totalku").val(val);
             $("#totalku2").val(val);
             totalnya = val;
            }
            function addCommas(nStr){
                nStr += '';
                x = nStr.split('.');
                x1 = x[0];
                x2 = x.length > 1 ? '.' + x[1] : '';
                var rgx = /(\d+)(\d{3})/;
                while (rgx.test(x1)) {
                    x1 = x1.replace(rgx, '$1' + ',' + '$2');
                }
                return x1 + x2;
            }

            // ajax begin
            // $(document).ready(function(){
            //   $("#sesi").click(function(){
            //     var data = $('#form-serial').serialize();
            //       jQuery.ajax({
            //       type: 'POST',
            //       url: "<?php //echo base_url() ?>"+"page/system_add_komentar/<?php //echo $videonya->id_video ?>/<?php //echo $user_ion->id ?>",
            //       data: data,
            //       success: function(data) {
            //          $("#postList").load("<?php //echo base_url() ?>page/komentar_view/<?php //echo $videonya->id_video ?>/<?php //echo $user_ion->id ?>");
            //         showSuccessMessage('Sukses Menambahkan Komentar !');
            //         $("#komenhehe").val("");
            //       }
            //     });
            //   });
            // });
          </script>
          <button class="btn btn-info btn-flat pull-left" type="button" data-toggle="modal" data-target="#myModal">Kredit</button>
          <!-- Modal -->
          <? 
          $base_64 = base64_encode($ttk);
          $url_param = rtrim($base_64, '=');
          ?>
          <div id="myModal" class="modal fade" role="dialog">
            <div class="modal-dialog">

              <!-- Modal content-->
              <div class="modal-content">
                <div class="modal-header">
                  <button type="button" class="close" data-dismiss="modal">&times;</button>
                  <h4 class="modal-title">Kredit</h4>
                </div>
                <div class="modal-body">
                  <div class="form-group">
                    <?= form_open('kasir/hutang_penjualan/'.$kd_jual.'/'.$url_param.'/'.$dis.'');?>
                      <div class="form-group">
                        <label>Atas Nama</label>
            <input type="hidden" name="total" id="totalku" value="">

                        <?= form_input(['name'=>'atas_nama','class' => 'form-control']); ?>
                      </div>
                      <div class="form-group">
                        <label>Jatuh Tempo</label>
                        <?= form_input(['type'=>'text','name'=>'tgl_tempo','class'=>'form-control datepickery']); ?>
                      </div>
                      <div class="form-group">
                        <label>Pembayaran Awal</label>
                        <?= form_input(['name'=>'pembayaran_awal','class'=>'form-control']); ?>
                      </div>
                      <button class="btn btn-primary" type="submit">Simpan Data</button>
                    <?= form_close();?>
                  </div>
                </div>
                <div class="modal-footer">
                  <button type="button" class="btn btn-danger btn-flat" data-dismiss="modal">Close</button>
                </div>
              </div>

            </div>
          </div>
          
          <form method="post" action="<?= base_url('kasir/sukses_kasir/'.$kd_jual.'/'.$url_param.'/'.$dis.'') ?>">
            <input type="hidden" name="total" id="totalku2" value="">
            <button class="btn btn-success pull-right btn-flat" id="sesi">Bayar</button>
          </form>
          <!-- <button class="btn btn-warning btn-flat pull-right" onclick="window.open('<?//= base_url('kasir/cetak_struk/'.$kd_jual.'/') ?>'+totalnya,'_blank')"><i class="fa fa-print"></i> Cetak Struk</button>
           -->
          <div id="load6">
            
          </div>
        </div>
      </div>
  </div>
  <? } ?>

<script type="text/javascript">
  $(document).ready(function(){
    $('.datepickery').datetimepicker({
      format: 'YYYY-MM-DD'
    });

  });
</script>