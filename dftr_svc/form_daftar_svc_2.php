<?php
	date_default_timezone_set('Asia/Kuala_Lumpur'); require_once("../setty/config.php"); require_once("../setty/func.php");
	$hp = $_POST['hp']; $keluhan = $_POST['keluhan'];
?>
<div class="row"><div class="col-md-12 load_alert"></div></div>
<form id="frm-block" action="" method="post">	
	<input type="hidden" name="op" value="sv_service_baru_form_2" />
	<input type="hidden" name="hp" value="<?php echo $hp; ?>" />
	<input type="hidden" name="keluhan" value="<?php echo $keluhan; ?>" />
	<div class="form-group">
		<label>*Nama</label>
		<input type="text" name="nama_cus" id="nama_cus" class="form-control" autocomplete="off" />
	</div>
	<div class="row">
		<div class="col-md-6">
			<div class="form-group">
				<label>*No. HP</label>
				<input type="text" value="<?php echo $hp; ?>" class="form-control" readonly />
			</div>
		</div>
		<div class="col-md-6">
			<div class="form-group">
				<label>Email</label>
				<input type="email" name="email_null" id="email_null" class="form-control" autocomplete="off" />
			</div>
		</div>
	</div>
	<div class="form-group">
		<label>*Alamat</label>
		<textarea rows="6" name="value_null" id="value_null" class="form-control"></textarea>
	</div>
	<div class="form-group">
		<label>Keluhan Service</label>
		<textarea rows="6" class="form-control" readonly ><?php echo $keluhan; ?></textarea>
	</div>
	<div class="form-group text-right">
		<button type="submit" class="btn btn-grad btn-primary pull-right"><i class="icon-save"></i> Kirim</button>
	</div>
</form>
<i>bertanda (*) wajib diisi.</i>
<script type="text/javascript">		
	$(document).ready(function(){	
		$(function () { formValidation(); });
		$('#frm-block').submit(function(){
			$('.load_alert').html('');
			var nama = $('#nama_cus').val(), alamat = $('#value_null').val();
			if(nama != '' && nama.length <= 80 && alamat != ''){
				$.ajax({
					beforeSend: function(){
						$('.loading').fadeIn('slow');
					},
					url: "prog",
					type: "POST",
					data: new FormData(this),
					contentType: false,
					cache: false,
					processData: false,
					success: function(msg){ var arr = msg.split('|');
						if(arr[0] == 'oke'){
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
						} else {
							$('.loading').fadeOut('slow', function(){
								$('.load_alert').html(arr[3]);
							});
						}
					},
					error: function(){}	
				});
			}
			return false;
		});
	});
</script>