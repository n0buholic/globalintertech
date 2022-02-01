<?php
	date_default_timezone_set('Asia/Kuala_Lumpur'); require_once("../setty/config.php"); require_once("../setty/func.php");
	if($_SERVER["SERVER_NAME"] != "localhost"){ $link = "https://".$_SERVER["SERVER_NAME"]; }
		else { $link = "https://".$_SERVER["SERVER_NAME"]."/global"; }
	$sumber = "../img/logo.png"; $src = encode_base64($sumber); setcookie('captcha_garansi', '', 0, '/');
?>
<div class="row" style="margin-top:2em;">
	<div class="col-md-4"></div>
	<div class="col-md-4" style="border:1px solid #eee;box-shadow:3px 3px 5px #888;border-radius:0.5em;padding:1em;">
		<div style="padding: 1em;padding-left: 0em;font-weight: bold;">
			<i class="icon-list"></i> Cek Masa Garansi Produk
		</div>		
		<form role="form" id="frm_cek_garansi">
			<div class="form-group">
				<div class="input-group">
					<input id="textsn" name="textsn" type="text" placeholder="masukkan serial number" class="form-control" data-elemen="html_text_sn" />
					<span class="input-group-btn"><button class="btn btn-success" type="submit"><i class="icon-search"></i></button></span>
				</div>
				<div class="form-group" style="margin-top: 1em;">
					<label class="row col-md-12">Kode Validasi</label>
					<img src="captcha" id="img_captcha" alt="gambar" />
				</div>
				<div class="form-group">
					<input type="number" id="captcha" name="captcha" value="" placeholder="masukkan kode validasi" class="form-control" autocomplete="off" />
				</div>
			</div>
		</form>
		<div style="border-top:1px dashed #888;padding-top:1em;" id="html_data_detail"></div>
		<div style="text-align: center;font-weight: bold;font-size: 1.3em;">
			<img src="<?= $src; ?>" width="30%" /><br>			
			<a href="<?= $link ?>" style="text-decoration: none;color: #dedede;">www.globalintertech.co.id</a>
		</div>
	</div>
	<div class="col-md-4"></div>
</div>
<script type="text/javascript">		
	$(document).ready(function(){ $('input').prop('autocomplete', 'off'); $('#html_data_detail').html('<div class="alert alert-danger text-center">data tidak ditemukan.</div>');
		$('#frm_cek_garansi').validate({
			rules: { textsn: 'required', captcha:{ required:true, digits:true, maxlength:6, minlength:6 } },
	        errorClass: 'help-block',
	        errorElement: 'span',
	        highlight: function (element, errorClass, validClass) {
	            $(element).parents('.form-group').removeClass('has-success').addClass('has-error');
	        },
	        unhighlight: function (element, errorClass, validClass) {
	            $(element).parents('.form-group').removeClass('has-error').addClass('has-success');
	        },
	        submitHandler: function(form, e) { e.preventDefault();
	        	var str = $('#textsn').val(), captcha = $('#captcha').val();
	        	$.ajax({ type: 'POST', beforeSend: function(){ $('.loading').fadeIn('slow'); }, url: 'lap_garansi', data: {str:str, captcha:captcha}, dataType:'json', cache: false, success: function(msg){
	        			if(msg[0] !== 'reload'){ $('#html_data_detail').html(msg[1]); $('#img_captcha').attr('src', 'captcha');
	        				$('input').val(''); } else { window.location = msg[1]; }
	        			$('.loading').fadeOut('slow'); } }); return false; } });//end
	});//end document
</script>