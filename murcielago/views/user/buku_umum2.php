<div class="content-wrapper">
 <div class="container-fluid">
   <section class="content">
   <div class="row">
       <div class="col-md-10">
         <h4><b>Data Buku Kas Umum <?php echo ($this->uri->segment(3) == 'all') ? 'Anggota' : $this->uri->segment(3) ?></b></h4>
       </div>
       <div class="col-md-2">

       </div>
       <div class="col-md-12">
         <hr>
         <?php echo $this->session->flashdata('alert'); ?>
       </div>

       <div class="col-md-12">
         <form method="post" action="<?= base_url('buku_umum/general_book/ac'); ?>">
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

       <!-- <div class="col-md-3">
         <ul class="nav nav-fixed fixedElement">
           <li class="active"><a href="#tab_1" data-toggle="tab">Buku Bank Kas Anggota All</a></li>
           <li><a href="#tab_2" id="tab2" data-toggle="tab">Biaya Administrasi Bank Kas Anggota</a></li>
           <li><a href="#tab_3" id="tab3" data-toggle="tab">Pendapatan Bunga Bank Kas Anggota</a></li>
           <li><a href="#tab_4" id="tab4" data-toggle="tab">Setor Tunai Kas Anggota</a></li>
           <li><a href="#tab_5" id="tab5" data-toggle="tab">Transfer Masuk Kas Anggota</a></li>
           <li><a href="#tab_6" id="tab6" data-toggle="tab">Tarik Tunai Kas Anggota</a></li>
           <li><a href="#tab_7" id="tab7" data-toggle="tab">Transfer Keluar Kas Anggota</a></li>
           <li><a href="#tab_8" id="tab8" data-toggle="tab">Saldo Bank Bulan Berjalan Kas Anggota</a></li>
           <li><a href="#tab_9" id="tab9" data-toggle="tab">Saldo Bank Bulan Yang Lalu Kas Anggota</a></li>
         </ul>
       </div> -->
<style>
.nav>li {
  position: relative;
  display: block;
}
.nav>li>a {
    position: relative;
    display: block;
    padding: 16px 15px;
    color: #3c3c3c;
}
/* .active {
    background-color: #dcdcdc;
} */
.box-sha{
    box-shadow: 2px 1px 20px -5px #5f5f5f;
}
.fixedElementul{
  margin-left: 15px;
  min-width:150%;
  padding:0px;
}
</style>


       <div class="col-md-12">
         <hr>
         <div class="tab-content">
           <div class="tab-pane active" id="tab_1" style="background-color:#fff;">
             <!-- wates -->
             <div class="col-md-12" style="padding-right:0px;">
               <?
                 if($this->uri->segment(3) == 'ac'){
                 ?>
                 <a href="<?= base_url('buku_umum/cetak_buku_umum2/'.$this->input->post('start_tgl').'/'.$this->input->post('end_tgl').'/') ?>" target="_blank" class="btn btn-info btn-flat pull-right" type="button"><i class="fa fa-print"></i> Print</a>
                 <? }else{ ?>
                 <a href="<?= base_url('buku_umum/cetak_buku_umum2/') ?>" target="_blank" class="btn btn-info btn-flat pull-right" type="button" style="margin:5px;"><i class="fa fa-print"></i> Print</a>
                 <? } ?>
                 <?
                 if($this->uri->segment(3) == 'ac'){
                 ?>
                 <a href="<?= base_url('buku_umum/export_buku_umum2/'.$this->input->post('start_tgl').'/'.$this->input->post('end_tgl').'/') ?>" class="btn btn-success btn-flat pull-right"><i class="fa fa-file-excel-o"></i> Export</a>
                 <? }else{ ?>
                 <a href="<?= base_url('buku_umum/export_buku_umum2/') ?>" class="btn btn-success btn-flat pull-right" style="margin:5px;"><i class="fa fa-file-excel-o"></i> Export</a>
                 <? } ?>

               </div>
               <br>
              <br>
              <div class="table table-responsive">
               <table class="table table-bordered datatable-biasa">
                 <thead>
                   <tr>
                     <th>No</th>
                     <th>Tanggal</th>
                     <th>Kredit (Hutang)</th>
                     <th>Debit</th>
                     <th>Total Harga</th>
                     <th>Saldo</th>
                   </tr>
                 </thead>
                 <tbody>
                   <?php
                   $sal=0;
                   $kredit1=0;
                   $debit1=0;
                   $no=0;
                   $nos=0;
                   foreach($list_buku_umum as $l){
                    $no++;
                    $nos++;
                    ?>
                   <tr>
                     <td><?php echo $nos ?></td>
                     <td><?= date('d-m-Y',strtotime($l->tanggal_penjualan)) ?></td>
                     <?php
                     ($l->status == '2') ? $kredit = number_format($l->bayar) : $kredit=0;
                     ($l->status == '1') ? $debit = number_format($l->bayar) : $debit=0;
                      ?>
                     <td>Rp. <?= $kredit ?></td>
                     <td>Rp. <?= $debit ?></td>
                     <td>Rp. <?php echo number_format($l->total_harga) ?></td>
                     <!-- <td>Rp. <? $salq =  $l->total_harga  ?></td> -->
                     <td><b> Rp. <?
                      if($no==1){
                         $sal=$salq;
                      }else{
                    $sal = $salq + $sal ;
                      }
                      echo number_format($sal);
                      ?>
                    </b>
                     </td>
                   </tr>

                   <?php
                   $kre[$nos] = $kredit;
                   $de[$nos] = $debit;
                   $debit1 += $de[$nos];
                   $kredit1 += $kre[$nos];
                    ?>
                 <?php } ?>

                 </tbody>
               </table>
               <table class="table table-bordered">
                 <tr style="background-color:#2c3e50;color:#fff;">
                   <td><b>Total</b></td>
                   <?php
                   if($this->uri->segment(3) == 'ac'){
                     $sum_ke = $this->m_data->sum_list_general_book2('2',$this->input->post('start_tgl'),$this->input->post('end_tgl'))->row();
                     $sum_ke1 = $this->m_data->sum_list_general_book2('1',$this->input->post('start_tgl'),$this->input->post('end_tgl'))->row();
                     // echo 'jh';
                   }else{
                   $sum_ke = $this->m_data->sum_list_general_book2('2')->row();
                   $sum_ke1 = $this->m_data->sum_list_general_book2('1')->row();
                   }
                   ?>
                   <td> <b>Kredit (Hutang)</b> : Rp.&nbsp;<?= number_format($sum_ke->bayarx) ?></td>
                   <td> <b>Debit</b> : Rp.&nbsp;<?= number_format($sum_ke1->bayarx) ?></td>
                   <td> <b>Saldo</b> : Rp.&nbsp;<?= number_format($sal) ?></td>
                 </tr>
               </table>
               </div>
             <!-- wates -->
           </div>


<script type="text/javascript">
$(window).scroll(function(e){
var $el = $('.fixedElement');
var isPositionFixed = ($el.css('position') == 'fixed');
if ($(this).scrollTop() > 200 && !isPositionFixed){
  $('.fixedElement').css({'position': 'fixed', 'top': '0px','z-index' : '999999999','width':'15%'});
  $('.fixedElementul').css({'position': 'fixed', 'top': '0px','z-index' : '999999999','min-width':'98%','margin-top':'45px'});
}
if ($(this).scrollTop() < 200 && isPositionFixed)
{
  $('.fixedElement').css({'position': 'static', 'top': '0px','width' : '100%'});
  $('.fixedElementul').css({'position': 'absolute', 'top': '0px','z-index':'9999999','min-width' : '164%','margin-top':'40px','margin-left':'14px'});
}
});
</script>
       </div>

       </div>
   </div>
 </section>
 </div>
</div>
