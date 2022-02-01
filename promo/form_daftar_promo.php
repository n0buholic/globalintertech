<?php
	date_default_timezone_set('Asia/Kuala_Lumpur');
?>
<div class="row">
	<div class="col-md-12">
		<div class="alert alert-info">Tinggal selangkah lagi anda berhak untuk mengklaim promo, dengan mengisi data di bawah ini:</div>
	</div>
</div>
<div class="row"><div class="col-md-12 load_alert"></div></div>
<div class="row">
	<div class="col-md-12">
		<form role="form" id="frm-block">	
			<div class="form-group">
				<label>Nama</label>
				<input type="text" name="value150" id="value150" placeholder="wajib diisi" autocomplete="off" class="form-control" />
			</div>	
			<div class="form-group">
				<label>No. HP</label>
				<input type="number" name="value6_13" id="value6_13" autocomplete="off" placeholder="wajib diisi" class="form-control" />
			</div>
			<div class="form-group">
				<label>Email</label>
				<input type="email" name="email_null" id="email_null" class="form-control" autocomplete="off" />
			</div>
			<div class="form-group text-right">
				<button type="submit" class="btn btn-grad btn-primary pull-right"><i class="fa fa-ok"></i> Klaim Promo</button>
			</div>
		</form>
	</div>
</div>
<script type="text/javascript">		
	$(document).ready(function(){	
		$(function () { formValidation(); });
		$('#frm-block').submit(function(){
			$('.load_alert').html('');
			var op = 'sv_daftar_promo', nama = $('#value150').val(), hp = $('#value6_13').val(), email = $('#email_null').val();
			if(nama != '' && nama.length <= 150 && hp != '' && hp.length >= 6 && hp.length <= 13){
				$.ajax({
					type: 'POST',
					beforeSend: function(){
						$('.loader').fadeIn('slow');
					},
					url: 'promo/prog',
					data: {op:op, nama:nama, hp:hp, email:email},
					cache: false,
					success: function(msg){ var arr = msg.split('|');
						if(arr[0] == 'oke'){
							$('.loader').fadeOut('slow', function(){
								$('.load_form_modal').html(arr[1]);
							});
						} else {
							$('.loader').fadeOut('slow', function(){
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