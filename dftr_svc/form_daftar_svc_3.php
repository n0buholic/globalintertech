<?php
	date_default_timezone_set('Asia/Kuala_Lumpur'); require_once("../setty/config.php"); require_once("../setty/func.php");
	$hp = $_POST['hp']; $keluhan = $_POST['keluhan'];
?>
<div class="row"><div class="col-md-12 load_alert"></div></div>
<form id="frm-block" action="" method="post">	
	<input type="hidden" name="op" value="sv_service_baru_form_3" />
	<input type="hidden" name="hp" value="<?php echo $hp; ?>" />
	<input type="hidden" name="keluhan" value="<?php echo $keluhan; ?>" />
	<div class="row">
		<div class="col-md-6">
			<div class="form-group">
				<label>*No. HP</label>
				<input type="text" value="<?php echo $hp; ?>" class="form-control" readonly />
			</div>
		</div>
	</div>
	<div class="form-group">
		<label>*Alamat</label>
		<select data-placeholder="Pilih Alamat" name="plh_type" id="plh_type" class="form-control chzn-select" tabindex="7"></select>
	</div>
	<div class="row data_email" style="display:none;">
		<div class="col-md-12">
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
		</div>
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
		$.ajax({
			type: 'POST',
			url: 'prog',
			data: 'op=dt_trigger&sub=alamat&hp=<?php echo $hp; ?>',
			cache: false,
			success: function(data){
				$('#plh_type').html(data).trigger("chosen:updated");
			}
		});
		$(".chzn-select").chosen({
			width: '100%',
			no_results_text: "Oops, data tidak ditemukan!"
		});
		$('#plh_type').change(function(){
			$('#email_null').val(''); var op = 'cek_email', idcus = $('#plh_type').val();
			$.ajax({
				type: 'POST',
				beforeSend: function(){
					$('.loading').fadeIn('slow');
				},
				url: 'prog',
				data: {op:op, idcus:idcus},
				cache: false,
				success: function(msg){
					$('.loading').fadeOut('slow', function(){
						if(msg == ''){ $('.data_email').fadeIn('slow'); } else { $('.data_email').fadeOut('slow'); }
					});
				}
			});
		});
		$('#frm-block').submit(function(){
			$('.load_alert').html(''); var alamat = $('#plh_type').val();
			if(alamat != ''){
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
			}
			return false;
		});
	});
</script>