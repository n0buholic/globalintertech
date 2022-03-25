<?php require_once('../setty/func.php'); $link = "../img/logo.png"; $src = encode_base64($link);
	if($_SERVER["SERVER_NAME"] !=="localhost"){ $link = "https://".$_SERVER["SERVER_NAME"]; }
		else { $link = "https://".$_SERVER["SERVER_NAME"] . "/global/"; } ?>
<div class="container border rounded p-3 shadow">
	<div class="row">
		<div class="col-md-12">
			<div class="alert alert-success text-center" role="alert">
			  <h4>Pendaftaran Service GIT</h4>
			</div>			
		</div>
		<div class="col-md-12">
			<div class="alert alert-danger shadow" role="alert">
			  <i>Tata Cara Service Online</i>:<br />Anda cukup menginputkan <b>No. HP</b> dan <b>Masalah pada produk yang anda miliki</b>. Tim kami akan siap membantu memcahkan permasalah pada produk anda.
			</div>
		</div>
		<div class="col-md-12 mt-5">
			<div class="alert alert-secondary" role="alert">
				<form id="frm-customer">
				  <div class="form-group">
				    <label for="texttelp"><i class="bi bi-caret-right-fill"></i> No. Telp/HP Anda</label>
				    <input type="text" class="form-control" name="texttelp" id="texttelp" autocomplete="off">
				  </div>
				  <div class="form-group">
				    <label for="textkeluhan"><i class="bi bi-caret-right-fill"></i> Masalah Produk</label>
				    <textarea class="form-control" name="textkeluhan" id="textkeluhan" rows="4" style="resize: none;"></textarea>
				  </div>
				  <div class="form-group" id="html-alert"></div>
				  <div class="row">
				  	<div class="col">
				  		<button type="submit" class="btn btn-success float-right">Lanjut <i class="bi bi-chevron-double-right"></i></button>
				  	</div>
				  </div>
				</form>
			</div>
		</div>
		<div class="col-md-12 text-center mt-3">
			<img src="<?= $src; ?>" width="30%" /><br>			
			<a href="<?= $link ?>" style="text-decoration: none;color: #dedede;">www.globalintertech.co.id</a>			
		</div>
	</div>
</div>

<script type="text/javascript">
	$(document).ready( () => {
		$('.loading').fadeOut('slow');
		$('#frm-customer').validate({
			rules: { texttelp:{ required:true, digits:true }, textkeluhan:'required' },
	        errorClass: 'help-block', errorElement: 'span',
	        highlight: (element, errorClass, validClass) => {
	            $(element).parents('.form-group').removeClass('has-success').addClass('has-error'); },
	        unhighlight: (element, errorClass, validClass) => {
	            $(element).parents('.form-group').removeClass('has-error').addClass('has-success'); },
	        submitHandler: (form, e) => { e.preventDefault();
	        	let telp = $('#texttelp').val(), keluhan = $('#textkeluhan').val();

	        	$.ajax({ beforeSend: () => { $('.loading').fadeIn('slow'); }, url:'<?php include "init.php"; ?>', data:{ mode:'cek_no_telp', telp, keluhan }, type:'POST', dataType:'json', cache:false, success: (msg) => {
	        			if(msg.status == 'invalid')
	        			{
	        				$('#html-alert').html('<div class="alert alert-danger text-center" role="alert"><h5>'+ msg.pesan +'</h5></div>'); $('.loading').fadeOut('slow');
	        			}
	        			else
	        			{
	        				$.ajax({ url:msg.link, data:{ mode:msg.mode, telp, keluhan, id_customer:msg.id_customer }, type:'POST', cache:false, success: (page) => { $('#div-load-page').html(page) } });
	        			}
	        		}
	        	});

	        	return false;
	        }
	    });
	});
</script>
