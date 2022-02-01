<?php
	date_default_timezone_set('Asia/Kuala_Lumpur'); require_once("../setty/config.php"); require_once("../setty/func.php");
?>
<div class="row"><div class="col-md-12 load_alert"></div></div>
<form role="form" id="frm-block">	
	<div class="row">
		<div class="col-md-6">
			<div class="form-group">
				<label>No. HP</label>
				<input type="text" name="kontak_cus" id="kontak_cus" class="form-control" autocomplete="off" />
			</div>
		</div>
	</div>
	<div class="form-group">
		<label>Keluhan Service</label>
		<textarea rows="6" name="value_null" id="value_null" class="form-control"></textarea>
	</div>
	<div class="form-group text-right">
		<button type="submit" class="btn btn-grad btn-success pull-right">Lanjut <i class="icon-arrow-right"></i></button>
	</div>
</form>
<script type="text/javascript">		
	$(document).ready(function(){	
		$(function () { formValidation(); });
		$('#frm-block').submit(function(){
			$('.load_alert').html('');
			var op = 'sv_service_baru', hp = $('#kontak_cus').val(), keluhan = $('#value_null').val();
			if(hp != '' && hp.length >= 10 && hp.length <= 13 && keluhan != ''){
				$.ajax({
					type: 'POST',
					beforeSend: function(){
						$('.loading').fadeIn('slow');
					},
					url: 'prog',
					data: {op:op, hp:hp, keluhan:keluhan},
					cache: false,
					success: function(msg){ var arr = msg.split('|');
						if(arr[0] == 'oke'){
							if(arr[1] != 'oke'){
								$.ajax({
									type: 'POST',
									url: arr[1],
									data: {hp:hp, keluhan:keluhan},
									cache: false,
									success: function(data){
										$('.loading').fadeOut('slow', function(){
											$('.load_page_sub').html(data); $('.load_alert').html(arr[2]);
										});
									}
								});
							} else
							if(arr[1] == 'oke'){
								var sub = 'selesai';
								$.ajax({
									type: 'POST',
									url: 'status',
									data: {sub:sub},
									cache: false,
									success: function(data){
										$('.loading').fadeOut('slow', function(){
											$('.load_page_sub').html(data);
										});
									}
								});
							}
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