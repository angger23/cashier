
<div id="load1">
    				 			<input type='hidden' id='kd_jual' value='<?= $kd_jual ?>'>
        <input type='hidden' id='kd_nota' value='<?= $kd_nota ?>'>
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

    <input autofocus="autofocus" class="form-control bs-autocomplete" id="input" />

                                    </td>
							        <div id="load2">
								        <td></td>
								        <td></td>
								        <td></td>
								        <td></td>
								        <td></td>

							        </div>
							      </tr>
							    </tbody>
							  </table>
							</div>
							<div id="load3">

							</div>
                                                                                      <script>
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
	var pem = '<?= $pembeli; ?>';
    var tgl = '<?php echo $tgl ?>';
    // alert(val);
 $("#load2").load("<?= base_url() ?>"+"kasir/load_data/"+val2+"/"+pem+"/<?= $kd_jual ?>/"+tgl);
})

 $("#load5").load("<?= base_url() ?>"+"kasir/load_list_data/<?= $kd_jual ?>");

</script>
