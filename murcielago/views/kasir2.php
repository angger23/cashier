    <!-- <link href="<?php echo base_url() ?>assets_kasir/ajaxcomplete/content/styles.css" rel="stylesheet" /> -->

<div class="content-wrapper">
  <div class="container-fluid">
    <section class="content">
    <div class="row">
    	<div class="col-md-12">
            <style type="text/css">
  ul.bs-autocomplete-menu {
  position: absolute;
  top: 0;
  left: 0;
  width: 100%;
  max-height: 200px;
  overflow: auto;
  z-index: 9999;
  border: 1px solid #eeeeee;
  border-radius: 4px;
  background-color: #fff;
  box-shadow: 0px 1px 6px 1px rgba(0, 0, 0, 0.4);
}

ul.bs-autocomplete-menu a {
  font-weight: normal;
  color: #333333;
}

.ui-helper-hidden-accessible {
  border: 0;
  clip: rect(0 0 0 0);
  height: 1px;
  margin: -1px;
  overflow: hidden;
  padding: 0;
  position: absolute;
  width: 1px;
}

.ui-state-active,
.ui-state-focus {
  color: #23527c;
  background-color: #eeeeee;
}

.bs-autocomplete-feedback {
  width: 1.5em;
  height: 1.5em;
  overflow: hidden;
  margin-top: .5em;
  margin-right: .5em;
}

.loader {
  font-size: 10px;
  text-indent: -9999em;
  width: 1.5em;
  height: 1.5em;
  border-radius: 50%;
  background: #333;
  background: -moz-linear-gradient(left, #333333 10%, rgba(255, 255, 255, 0) 42%);
  background: -webkit-linear-gradient(left, #333333 10%, rgba(255, 255, 255, 0) 42%);
  background: -o-linear-gradient(left, #333333 10%, rgba(255, 255, 255, 0) 42%);
  background: -ms-linear-gradient(left, #333333 10%, rgba(255, 255, 255, 0) 42%);
  background: linear-gradient(to right, #333333 10%, rgba(255, 255, 255, 0) 42%);
  position: relative;
  -webkit-animation: load3 1.4s infinite linear;
  animation: load3 1.4s infinite linear;
  -webkit-transform: translateZ(0);
  -ms-transform: translateZ(0);
  transform: translateZ(0);
}

.loader:before {
  width: 50%;
  height: 50%;
  background: #333;
  border-radius: 100% 0 0 0;
  position: absolute;
  top: 0;
  left: 0;
  content: '';
}

.loader:after {
  background: #fff;
  width: 75%;
  height: 75%;
  border-radius: 50%;
  content: '';
  margin: auto;
  position: absolute;
  top: 0;
  left: 0;
  bottom: 0;
  right: 0;
}

@-webkit-keyframes load3 {
  0% {
    -webkit-transform: rotate(0deg);
    transform: rotate(0deg);
  }
  100% {
    -webkit-transform: rotate(360deg);
    transform: rotate(360deg);
  }
}

@keyframes load3 {
  0% {
    -webkit-transform: rotate(0deg);
    transform: rotate(0deg);
  }
  100% {
    -webkit-transform: rotate(360deg);
    transform: rotate(360deg);
  }
}

            </style>
<link rel="stylesheet" href="<?php echo base_url('assets_kasir/css/jquery-ui.css') ?>">
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
<!-- <div class="col-md-6">
    <div>
    <label>Country Search</label>
    <input class="form-control" id="searchInput" />
</div> -->

    <!-- <form> -->
<!-- <input type="text" class="form-control" size="30" onkeyup="showResult(this.value)">
            <input type="text" name="country" class="autocomplete-ajax-x" id="livesearch" disabled="disabled" style="color: #CCC; position: absolute; background: transparent; z-index: 1;"/> -->
<!-- <div id="livesearch"></div> -->
<!-- </form> -->
</div>
    		 <center>
            <h1><b>KASIR STIKESMART</b></h1>
            <hr>
            </center>
            <!-- <div style="position: relative; height: 80px;">
            <input type="text" name="country" id="autocomplete-ajax" style="position: absolute; z-index: 2; background: transparent;"/>
            <input type="text" name="country" id="autocomplete-ajax-x" disabled="disabled" style="color: #CCC; position: absolute; background: transparent; z-index: 1;"/>
        </div> -->
        <div id="selction-ajax"></div>
    		<? ($this->uri->segment(3)=='shoping') ? $active='beli' : $active='';
    		//if($active){}else{
    		?>
    		<?= $this->session->flashdata('alert'); ?>
    		<!-- <div class="col-md-4 col-sm-4">
    			<form method="post" action="<?//= base_url('kasir/kasir2/shoping') ?>">
    				<div class="form-group">
	    				<label>Nama Pembeli</label>
		    			  <select class="form-control selectku" name="nama_pembeli" autofocus>
		    			  	<option value="">Pilih Pembeli</option>
						<?php //foreach($pembeli as $rect ){ ?>
						    <option value="<?//= $rect['kd_pembeli'] ?>"><?//= $rect['nama_pembeli'] ?></option>
						<?php //} ?>
		        		</select>
	    			</div>
	    			<div class="form-group">
	    				<button class="btn btn-primary btn-flat" type="submit">Mulai Belanja!</button>
	    			</div>
    			</form>
    		</div> -->
    		<? //} ?>
    		<!-- xxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxx -->
    		<?
    		//if($active){
    		?>

    			<div class="col-md-12">
    				<div class="form-group">
    					<table class="table">
						    <tbody>
						      <tr>
						        <td style="width: 120px;">Nama Pembeli</td>
						        <td>
                      <select class="form-control selectku" name="nama_pembeli" id="kd_pembeli" autofocus style="width:100%;">
                       <option value="981" selected>Pilih Pembeli</option>
                         <?php foreach($pembeli as $rect ){ ?>
                             <option value="<?= $rect['kd_pembeli'] ?>"><?= $rect['nama_pembeli'] ?></option>
                         <?php } ?>
                     </select>
                    </td>
                    <td style="width: 150px;">Tanggal Pembelian</td>
                      <?php
                      $cek_verif = $this->m_data->semua('verifikasi_tgl_penjualan')->row();
                      if($cek_verif->stat_verif == 0){
                      ?>
                    <td><?= tgl_indo(date('Y-m-d')) ?></td>
                      <input type="hidden" name="tgl" id="tgl" value="<?php echo date('Y-m-d') ?>">
                      <?php }else{ ?>
                    <td>
                      <input type="text" name="tgl" id="tgl" class="form-control datepicker">
                    </td>
                    <?php } ?>
						      </tr>
						      <tr>

                  </tr>
						    </tbody>
						  </table>
    				</div>
    			</div>
    			<!-- sesi belanja -->
    			<div class="col-md-12">
    				 <div class="panel panel-success" style="border-radius: 0;">
    				 	<div class="panel-body">
    				 		<div id="load4">
	    				 			<div id="load1">
	    				 			<input type='hidden' id='kd_jual' value='0'>
	        <input type='hidden' id='kd_nota' value='0'>
	    				 		</div>
	    				 		<div id="load2">
	    				 		 <table class="table table-bordered">
								    <thead>
								      <tr>
								        <th>Kode Barang</th>
								        <th>Nama Barang</th>
								        <th>Harga Pokok</th>
								        <th>Satuan Beli</th>
								        <th>Diskon</th>
								        <th>Total Harga</th>
								      </tr>
								    </thead>
								    <tbody>

								      <tr>
								        <td>
                <input autofocus="autofocus" class="form-control bs-autocomplete" id="input" placeholder="Pilih Barang" />

                                        </td>
									        <td></td>
									        <td></td>
									        <td></td>
									        <td></td>
									        <td></td>
								      </tr>
								    </tbody>
								  </table>

                                   <script>
                                    $.widget("ui.autocomplete", $.ui.autocomplete, {

  _renderMenu: function(ul, items) {
    var that = this;
    ul.attr("class", "nav nav-pills nav-stacked  bs-autocomplete-menu");
    $.each(items, function(index, item) {
      that._renderItemData(ul, item);
    });
  },

  _resizeMenu: function() {
    var ul = this.menu.element;
    ul.outerWidth(Math.min(
      // Firefox wraps long text (possibly a rounding bug)
      // so we add 1px to avoid the wrapping (#7513)
      ul.width("").outerWidth() + 1,
      this.element.outerWidth()
    ));
  }

});
    $("#input").autocomplete({
        source: function (request, response) {
            $.ajax({
                url: '<?php echo base_url('kasir/wo') ?>',
                type:"POST",
                dataType: "json",
                data: { search: $("#input").val() },
                success: function (data) {
                    response($.map(data, function (item) {
                        return { label: item.kode_barang +' - '+item.nama_barang, value: item.kode_barang };
                    }));

                },
                error: function (xhr, status, error) {
                    alert("Error");
                }
            });
        }
    });
</script>

								</div>
								<div id="load3">

								</div>
    				 		</div>
    				 		<div id="load5">

    				 		</div>
							<?
							$base_64 = base64_encode($this->input->post('nama_pembeli'));
                  $url_param = rtrim($base_64, '=');
							?>
							  <script type="text/javascript">
$.fn.enterKey = function (fnc) {
    return this.each(function () {
        $(this).keypress(function (ev) {
            var keycode = (ev.keyCode ? ev.keyCode : ev.which);
            if (keycode == '13') {
                fnc.call(this, ev);
            }
        })
    })
}
$("#input").enterKey(function () {
  var val = $('#input').val();
  var val2 = ''+val+'';
  var pem = $("#kd_pembeli").val();
  var str = btoa($("#tgl").val());
  var res = str.replace("==","");
  // alert(val2);
 $("#load2").load("<?= base_url() ?>"+"kasir/load_data/"+val2+"/"+pem+"/0/"+res);
})


							      </script>
    				 	</div>
    				 </div>
    			</div>
    		<? //}else{} ?>
    	</div>
    </div>
</section>
</div>
</div>
