<div class="content-wrapper">

 <div class="container-fluid">

   <section class="content">

   <div class="row">

       <div class="col-md-10">

         <h4><b>Data Buku Kas Umum Monitoring Penagihan Ketua Toko</b></h4>

       </div>

       <div class="col-md-2">

         <button type="button" class="btn btn-primary btn-flat btn-sm" data-toggle="modal" data-target="#myModalx" name="button"><i class="fa fa-plus"></i> Input Tagihan Ketua Toko</button>

         <!-- Modal -->

<div id="myModalx" class="modal fade" role="dialog">

  <div class="modal-dialog">



    <!-- Modal content-->

    <div class="modal-content">

      <div class="modal-header">

        <button type="button" class="close" data-dismiss="modal">&times;</button>

        <h4 class="modal-title">Tambah Tagihan Ketua Toko</h4>

      </div>

      <div class="modal-body">

        <div class="form-group">

          <form action="<?php echo base_url('buku_umum/add_tagihan_ketua') ?>" method="post">

            <div class="form-group">

              <label for="">Tanggal</label>

              <input type="text" class="form-control datepicker" name="tanggal">

            </div>

            <div class="form-group">

              <label for="">Jenis Barang</label>

              <input type="text" name="jenis_barang" class="form-control">

            </div>

            <div class="form-group">

              <label for="">Jumlah Barang</label>

              <input type="text" name="jml_barang" class="form-control">

            </div>

            <div class="form-group">

              <label for="">Harga Satuan</label>

              <input type="text" name="harga_satuan" class="form-control">

            </div>

            <div class="form-group">

              <button type="submit" class="btn btn-primary btn-flat btn-sm" name="button">Tambah Data</button>

            </div>

          </form>

        </div>

      </div>

      <div class="modal-footer">

        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>

      </div>

    </div>



  </div>

</div>

       </div>

       <div class="col-md-12">

         <?php echo $this->session->flashdata('alert'); ?>

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



               <br>

              <br>

              <div class="table table-responsive">

               <table class="table table-bordered datatable-biasa">

                 <thead>

                   <tr>

                     <th>Tanggal</th>

                     <th>No</th>

                     <th>Jenis Barang</th>

                     <th>Jumlah</th>

                     <th>Harga Satuan</th>

                     <th>Jumlah Nominal</th>

                   </tr>

                 </thead>

                 <tbody>

                   <?php

                   $sal=0;

                   $kredit=0;

                   $debit=0;

                   $no=0;

                   $nos=0;

                   foreach($tagihan_toko as $l){

                    $no++;

                    $nos++;

                    ?>

                   <tr>

                     <td><?= date('d-m-Y',strtotime($l->tanggal)) ?></td>

                     <td><?php echo $nos ?></td>

                     <td><?= $l->jenis_barang ?></td>

                     <td><?= $l->jumlah ?></td>

                     <td><?= $l->harga_satuan ?></td>

                     <td>Rp. <?= number_format($l->jumlah * $l->harga_satuan) ?></td>



                   </tr>

                   <?php

                   // $kre[$no] = $l->kredit;

                   // $de[$no] = $l->debit;

                   // $debit += $de[$no];

                   // $kredit += $kre[$no];

                    ?>

                 <?php } ?>



                 </tbody>

               </table>

               <table class="table table-bordered">

                 <!-- <tr style="background-color:#2c3e50;color:#fff;">

                   <td><b>Total</b></td>

                   <td> <b>Pengeluaran (Debet)</b> : Rp.&nbsp;<?//= number_format($kredit) ?></td>

                   <td> <b>Pemasukan (Kredit)</b> : Rp.&nbsp;<?//= number_format($debit) ?></td>

                   <td> <b>Saldo</b> : Rp.&nbsp;<?//= number_format($sal) ?></td>

                 </tr> -->

               </table>

               </div>

             <!-- wates -->

           </div>

           <!-- /.tab-pane -->

           <div class="tab-pane" id="tab_2" style="background-color:#fff;">

             <!-- loading  -->

             <div id="wait1" style="display:none;width:69px;height:89px;position:absolute;top:50%;left:50%;padding:2px;">

               <img src='<?php echo base_url() ?>images/demo_wait.gif' width="64" height="64" /><br>Loading..</div>

             <!-- loading  -->

           </div>

           <!-- /.tab-pane -->

           <div class="tab-pane" id="tab_3" style="background-color:#fff;">

             <!-- loading  -->

             <div id="wai2" style="display:none;width:69px;height:89px;position:absolute;top:50%;left:50%;padding:2px;">

               <img src='<?php echo base_url() ?>images/demo_wait.gif' width="64" height="64" /><br>Loading..</div>

             <!-- loading  -->

           </div>

           <!-- /.tab-pane -->

           <div class="tab-pane" id="tab_4" style="background-color:#fff;">

             <!-- loading  -->

             <div id="wait3" style="display:none;width:69px;height:89px;position:absolute;top:50%;left:50%;padding:2px;">

               <img src='<?php echo base_url() ?>images/demo_wait.gif' width="64" height="64" /><br>Loading..</div>

             <!-- loading  -->

           </div>

           <div class="tab-pane" id="tab_5" style="background-color:#fff;">

             <!-- loading  -->

             <div id="wait4" style="display:none;width:69px;height:89px;position:absolute;top:50%;left:50%;padding:2px;">

               <img src='<?php echo base_url() ?>images/demo_wait.gif' width="64" height="64" /><br>Loading..</div>

             <!-- loading  -->

           </div>

           <div class="tab-pane" id="tab_6" style="background-color:#fff;">

             <!-- loading  -->

             <div id="wait5" style="display:none;width:69px;height:89px;position:absolute;top:50%;left:50%;padding:2px;">

               <img src='<?php echo base_url() ?>images/demo_wait.gif' width="64" height="64" /><br>Loading..</div>

             <!-- loading  -->

           </div>

           <div class="tab-pane" id="tab_7" style="background-color:#fff;">

             <!-- loading  -->

             <div id="wait6" style="display:none;width:69px;height:89px;position:absolute;top:50%;left:50%;padding:2px;">

               <img src='<?php echo base_url() ?>images/demo_wait.gif' width="64" height="64" /><br>Loading..</div>

             <!-- loading  -->

           </div>

           <div class="tab-pane" id="tab_8" style="background-color:#fff;">

             <div class="wait7" style="display:none;width:69px;height:89px;border:1px solid black;position:absolute;top:50%;left:50%;padding:2px;">

               <img src='<?php echo base_url() ?>images/demo_wait.gif' width="64" height="64" /><br>Loading..</div>

           </div>



           <div class="tab-pane" id="tab_9" style="background-color:#fff;">

             <div id="wait8" style="display:none;width:69px;height:89px;border:1px solid black;position:absolute;top:50%;left:50%;padding:2px;">

               <img src='<?php echo base_url() ?>images/demo_wait.gif' width="64" height="64" /><br>Loading..</div>

           </div>

           <!-- /.tab-pane -->

         </div>

         <!-- /.tab-content -->

       </div>

<script>

$(document).ready(function(){

$(document).ajaxStart(function(){

$("#wait1").css("display", "block");

});

$(document).ajaxComplete(function(){

$("#wait1").css("display", "none");

});



$(document).ajaxStart(function(){

$("#wait2").css("display", "block");

});

$(document).ajaxComplete(function(){

$("#wait2").css("display", "none");

});



$(document).ajaxStart(function(){

$("#wait3").css("display", "block");

});

$(document).ajaxComplete(function(){

$("#wait3").css("display", "none");

});



$(document).ajaxStart(function(){

$("#wait4").css("display", "block");

});

$(document).ajaxComplete(function(){

$("#wait4").css("display", "none");

});



$(document).ajaxStart(function(){

$("#wait5").css("display", "block");

});

$(document).ajaxComplete(function(){

$("#wait5").css("display", "none");

});



$(document).ajaxStart(function(){

$("#wait6").css("display", "block");

});

$(document).ajaxComplete(function(){

$("#wait6").css("display", "none");

});



$(document).ajaxStart(function(){

$("#wait7").css("display", "block");

});

$(document).ajaxComplete(function(){

$("#wait7").css("display", "none");

});



$(document).ajaxStart(function(){

$("#wait8").css("display", "block");

});

$(document).ajaxComplete(function(){

$("#wait8").css("display", "none");

});



$("#tab2").click(function(){

<?php if($this->uri->segment(3) == 'ac'){ ?>

$("#tab_2").load("<?php echo base_url('buku_anggota/rbuku1/'.$this->input->post('start_tgl').'/'.$this->input->post('end_tgl').'/'.$this->input->post('operator').'') ?>");

<?php }else{ ?>

$("#tab_2").load("<?php echo base_url('buku_anggota/rbuku1') ?>");

<?php } ?>

});



$("#tab3").click(function(){

<?php if($this->uri->segment(3) == 'ac'){ ?>

$("#tab_3").load("<?php echo base_url('buku_anggota/rbuku2/'.$this->input->post('start_tgl').'/'.$this->input->post('end_tgl').'/'.$this->input->post('operator').'') ?>");

<?php }else{ ?>

$("#tab_3").load("<?php echo base_url('buku_anggota/rbuku2') ?>");

<?php } ?>

});



$("#tab4").click(function(){

<?php if($this->uri->segment(3) == 'ac'){ ?>

$("#tab_4").load("<?php echo base_url('buku_anggota/rbuku3/'.$this->input->post('start_tgl').'/'.$this->input->post('end_tgl').'/'.$this->input->post('operator').'') ?>");

<?php }else{ ?>

$("#tab_4").load("<?php echo base_url('buku_anggota/rbuku3') ?>");

<?php } ?>

});



$("#tab5").click(function(){

<?php if($this->uri->segment(3) == 'ac'){ ?>

$("#tab_5").load("<?php echo base_url('buku_anggota/rbuku4/'.$this->input->post('start_tgl').'/'.$this->input->post('end_tgl').'/'.$this->input->post('operator').'') ?>");

<?php }else{ ?>

$("#tab_5").load("<?php echo base_url('buku_anggota/rbuku4') ?>");

<?php } ?>

});



$("#tab6").click(function(){

<?php if($this->uri->segment(3) == 'ac'){ ?>

$("#tab_6").load("<?php echo base_url('buku_anggota/rbuku5/'.$this->input->post('start_tgl').'/'.$this->input->post('end_tgl').'/'.$this->input->post('operator').'') ?>");

<?php }else{ ?>

$("#tab_6").load("<?php echo base_url('buku_anggota/rbuku5') ?>");

<?php } ?>

});



$("#tab7").click(function(){

<?php if($this->uri->segment(3) == 'ac'){ ?>

$("#tab_7").load("<?php echo base_url('buku_anggota/rbuku6/'.$this->input->post('start_tgl').'/'.$this->input->post('end_tgl').'/'.$this->input->post('operator').'') ?>");

<?php }else{ ?>

$("#tab_7").load("<?php echo base_url('buku_anggota/rbuku6') ?>");

<?php } ?>

});



$("#tab8").click(function(){

<?php if($this->uri->segment(3) == 'ac'){ ?>

$("#tab_8").load("<?php echo base_url('buku_anggota/rbuku7/'.$this->input->post('start_tgl').'/'.$this->input->post('end_tgl').'/'.$this->input->post('operator').'') ?>");

<?php }else{ ?>

$("#tab_8").load("<?php echo base_url('buku_anggota/rbuku7') ?>");

<?php } ?>

});



$("#tab9").click(function(){

<?php if($this->uri->segment(3) == 'ac'){ ?>

$("#tab_9").load("<?php echo base_url('buku_anggota/rbuku8/'.$this->input->post('start_tgl').'/'.$this->input->post('end_tgl').'/'.$this->input->post('operator').'') ?>");

<?php }else{ ?>

$("#tab_9").load("<?php echo base_url('buku_anggota/rbuku8') ?>");

<?php } ?>

});



});



</script>



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

