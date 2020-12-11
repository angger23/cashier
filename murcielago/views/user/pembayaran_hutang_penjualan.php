<div class="content-wrapper">
  <div class="container-fluid">
    <section class="content">
    <div class="row">
    	<?= $this->session->flashdata('alert'); ?>
    	<div class="col-md-3">
    		<div class="form-group">
    			<?//= form_open('kasir/pembayaran_hutang_penjualan/ac'); ?>
    				<div class="form-group">
    					<label>Cari Nama</label>
    					<input type="text" id="input" class="form-control">
    				</div>
    				<div class="form-group">
    					<button class="btn btn-primary btn-flat" onclick="cari()">Cari</button>
    				</div>
    			<?//= form_close(); ?>
    		</div>
    	</div>
    	<div class="col-md-12">
    		<div id="load1">
    			
    		</div>
    	</div>
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
$("#load1").load("<?= base_url() ?>"+"kasir/list_pembayar_hutang/"+val);
})
function cari(){
	var val = $('#input').val();
$("#load1").load("<?= base_url() ?>"+"kasir/list_pembayar_hutang/"+val);
}
    	</script>
    </div>
   </section>
  </div>
</div>