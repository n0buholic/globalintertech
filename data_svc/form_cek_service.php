<?php
	date_default_timezone_set('Asia/Kuala_Lumpur'); require_once("../setty/config.php"); require_once("../setty/func.php");
?>
<div class="row"><div class="col-md-12 load_alert"></div></div>
<form role="form" id="frm-block">	
	<div class="form-group">
		<label>No. HP</label>
		<input type="text" name="kontak_cus" id="kontak_cus" placeholder="masukkan no hp" class="form-control" />
	</div>
	<div class="form-group text-right">
		<button type="submit" class="btn btn-grad btn-success pull-right"><i class="icon-search"></i> Cari Data Service</button>
	</div>
</form>
<script type="text/javascript">		
	$(document).ready(function(){	
		$(function () { formValidation(); });
		$('#frm-block').submit(function(){
			$('.load_alert').html('');
			var op = 'cek_data_service', hp = $('#kontak_cus').val();
			if(hp != '' && hp.length >= 10 && hp.length <= 13){
				$.ajax({
					type: 'POST',
					beforeSend: function(){
						$('.loading').fadeIn('slow');
					},
					url: 'form_lap_service',
					data: {hp:hp},
					cache: false,
					success: function(msg){ var arr = msg.split('|');
						if(arr[0] != 'error'){
							$('.loading').fadeOut('slow', function(){
								$('.load_pages').html(msg);
							});
						} else {
							$('.loading').fadeOut('slow', function(){
								$('.load_alert').html(arr[1]);
							});
						}
					}
				});
			}
			return false;
		});
	});
</script>