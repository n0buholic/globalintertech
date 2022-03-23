<?php require_once('../setty/func.php'); $link = "../img/logo.png"; $src = encode_base64($link);
	if($_SERVER["SERVER_NAME"] !=="localhost"){ $link = "https://".$_SERVER["SERVER_NAME"]; }
		else { $link = "https://".$_SERVER["SERVER_NAME"] . "/global/"; } ?>
<div class="container border rounded p-3 shadow">
	<div class="row">
		<div class="col-md-12">
			<div class="alert alert-success text-center" role="alert">
			  <h4>Data Service Customer</h4>
			</div>			
		</div>
		<div class="col-md-12">
			<div class="alert alert-secondary" role="alert">
				<form id="frm-customer">
				  <div class="form-group" id="html-alert">
				    <label for="texttelp"><i class="bi bi-caret-right-fill"></i> Masukkan No. Telp/HP</label>
				    <input type="text" class="form-control" name="texttelp" id="texttelp" autocomplete="off">
				  </div>
				  <div class="row">
				  	<div class="col">
				  		<button type="submit" class="btn btn-success float-right"><i class="bi bi-search"></i> Cari Data</button>
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
			rules: { texttelp:{ required:true, digits:true, minlength:10 } },
	        errorClass: 'help-block', errorElement: 'span',
	        highlight: (element, errorClass, validClass) => {
	            $(element).parents('.form-group').removeClass('has-success').addClass('has-error'); },
	        unhighlight: (element, errorClass, validClass) => {
	            $(element).parents('.form-group').removeClass('has-error').addClass('has-success'); },
	        submitHandler: (form, e) => { e.preventDefault();
	        	let telp = $('#texttelp').val();

	        	$.ajax({ beforeSend: () => { $('.loading').fadeIn('slow'); }, url:'https://global.cmbstore.id/rest-api/view/View_service', data:{ mode:'cek_jumlah_alamat', telp }, type:'POST', dataType:'json', cache:false, complete: () => { $('.loading').fadeOut('slow'); }, success: (data) => {
	        			if(data.link == 'not-found')
	        			{	
	        				$('#html-alert').after('<div class="alert alert-danger" role="alert">Nomor telp belum terdaftar.</div>');
	        			} else
	        			{
		        			$.ajax({ url:data.link, data:{ telp, id_customer:data.id_customer }, type:'POST', cache:false, success: (page) => { $('#div-load-page').html(page); } });
		        		}
	        	} });

	        	return false;
	        }
	    });
	});
</script>
