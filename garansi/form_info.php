<?php
	date_default_timezone_set('Asia/Kuala_Lumpur'); require_once("../setty/func.php");
	if($_SERVER["SERVER_NAME"] !=="localhost"){ $link = "https://".$_SERVER["SERVER_NAME"]; }
		else { $link = "https://".$_SERVER["SERVER_NAME"] . "/global/"; } $sumber = "../img/logo.png"; $src = encode_base64($sumber);
?>
<div class="row" style="margin:2em 1em;">
	<div class="col-md-4"></div>
	<div class="col-md-4" style="border:1px solid #eee;box-shadow:3px 3px 5px #888;border-radius:0.5em;padding:1em;">
		<div style="padding: 1em;padding-left: 0em;font-weight: bold;">
			<i class="icon-list"></i> Cek Masa Garansi Produk
		</div>		
		<form role="form" id="frm_cek_garansi">
			<div class="form-group">
				<div class="">
					<input id="textsn" name="textsn" type="text" placeholder="masukkan serial number" class="form-control" data-elemen="html_text_sn" />
				</div>
				<div class="form-group" style="margin-top: 1em;">
					<label class="row col-md-12">Kode Validasi</label>
					<img src="captcha" id="img_captcha" alt="gambar" />
				</div>
				<div class="form-group">
					<input type="number" id="captcha" name="captcha" value="" placeholder="masukkan kode validasi" class="form-control" autocomplete="off" />
				</div>
				<div class="form-group">
					<button class="btn btn-success btn-block" type="submit"><i class="icon-search"></i> Temukan Data</button>
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
	$(document).ready(function(){
		function html_info(data)
		{
			let html = '';
			html += "<table class='table tabel-striped'>";
			html += "<tr class='success'><td>Customer</td><td><i class='icon-caret-right'></i> <span>"+ data.customer +"</span></td></tr>";
			html += "<tr><td>Status</td><td><i class='icon-caret-right'></i> <span>"+ data.sts_garansi +"</span></td></tr>";
			/*<tr><td>Supplier</td><td><i class='icon-caret-right'></i> <i>".$det_supp->nama."</i></td></tr>*/
			html += "<tr><td>Invoice</td><td><i class='icon-caret-right'></i> <span>"+ data.invoice +"</span></td></tr>";
			html += "<tr><td>Type Produk</td><td><i class='icon-caret-right'></i> <span>"+ data.produk +"</span></td></tr>";
			html += "<tr class='success'><td>Serial Number</td><td><i class='icon-caret-right'></i> <span>"+ data.sn +"</span></td></tr>";
			html += "<tr><td>Tgl. Pembelian</td><td><i class='icon-caret-right'></i> <span>"+ data.tgl_beli +"</span></td></tr>";
			html += "<tr><td>Tgl. Batas Garansi</td><td><i class='icon-caret-right'></i> <span>"+ data.tgl_bts_garansi +"</span></td></tr>";
			let str, sisa_garansi;
			if(parseInt(data.sisa_garansi) >= 0) { str = 'Sisa Garansi'; sisa_garansi = data.sisa_garansi; }
			else { str = 'Tanggal Sekarang'; sisa_garansi = data.tgl_now; }
			html += "<tr><td>"+ str +"</td><td><i class='icon-caret-right'></i> <span>"+ sisa_garansi +"</span></td></tr>";
			html += "</table>"; return html;
		}

		function alert_not_found(text)
		{
			return '<div class="alert alert-danger text-center">'+ text +'</div>';
		}
		$('input').prop('autocomplete', 'off'); $('#html_data_detail').html(alert_not_found('data tidak ditemukan.'));
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
	        	let str = $('#textsn').val(), captcha = $('#captcha').val();
	        	
	        	let captchaK = '';
	        	$.ajax({ type: 'POST', url: 'ambil_cookie', cache: false, async:false, success: (msg) => { captchaK = msg; } });

	        	$.ajax({ type: 'POST', beforeSend: () => { $('.loading').fadeIn('slow'); }, url: 'https://global.cmbstore.id/rest-api/view/View_info_sn.php', data: { str, captchaK, captcha }, dataType:'json', cache: false, complete: () => { $('.loading').fadeOut('slow'); }, success: (msg) => {
	        			if(msg.status == 'valid') { $('#html_data_detail').html(html_info(msg)); }
	        			else { $('#html_data_detail').html(alert_not_found(msg.text)); }
	        		}
	        	});
	        	return false;
	        }
	    });
	});//end document
</script>