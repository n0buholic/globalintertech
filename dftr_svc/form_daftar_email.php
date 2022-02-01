<?php
	date_default_timezone_set('Asia/Kuala_Lumpur'); require_once("../setty/config.php"); require_once("../setty/func.php");
	$hp = $_POST['hp']; $keluhan = $_POST['keluhan'];
?>
<div class="row"><div class="col-md-12 load_alert"></div></div>
<form id="frm-block" action="" method="post">	
	<input type="hidden" name="op" value="sv_email_sv_svc_baru" />
	<input type="hidden" name="keluhan" value="<?php echo $keluhan; ?>" />
	<input type="hidden" name="hp" value="<?php echo $hp; ?>" />
	<div class="row">
		<div class="col-md-6">
			<div class="form-group">
				<label>No. HP</label>
				<input type="text" name="kontak_cus" id="kontak_cus" value="<?php echo $hp; ?>" class="form-control" readonly />
			</div>
		</div>
	</div>
	<div class="form-group">
		<label>Keluhan Service</label>
		<textarea rows="6" name="value_null" id="value_null" class="form-control" readonly ><?php echo $keluhan; ?></textarea>
	</div>
	<div class="form-group">
		<label>Email</label>
		<input type="email" name="email_null" id="email_null" placeholder="tidak wajib diisi" class="form-control" autocomplete="off" />
	</div>
	<div class="row">
		<div class="col-md-12">
			<div class="panel panel-default">
				<div class="panel-body">
					Penting:<br />Email digunakan sebagai sarana pemberitahuan proses service yang anda daftarkan di <b>Global Intertech</b>. terimakasih...
				</div>
			</div>
		</div>
	</div>	
	<div class="form-group text-right">
		<button type="submit" class="btn btn-grad btn-primary pull-right"><i class="icon-save"></i> Kirim</button>
	</div>
</form>
<script type="text/javascript">		
	$(document).ready(function(){	
		$(function () { formValidation(); });
		$('#frm-block').submit(function(){
			$('.load_alert').html('');
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
							$('.load_alert').html(arr[1]);
						});
					}
				},
				error: function(){}	
			});
			return false;
		});
	});
</script>