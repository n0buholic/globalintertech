<?php require_once('../setty/func.php'); $link = "../img/logo.png"; $src = encode_base64($link); $telp = $_POST['telp'];
	$keluhan = $_POST['keluhan']; $mode = $_POST['mode'];

	$pattern = array('/[^a-zA-Z0-9 -]/');
	$keluhan = preg_replace($pattern, " ", $keluhan);

	if($_SERVER["SERVER_NAME"] !=="localhost"){ $link = "https://".$_SERVER["SERVER_NAME"]; }
		else { $link = "https://".$_SERVER["SERVER_NAME"] . "/global/"; } ?>
<style type="text/css">
	.li-pointer { cursor: pointer; }
	.li-pointer:hover { background-color: #eee; }
</style>
<div class="container border rounded p-3 shadow">
	<div class="row">
		<div class="col-md-12">
			<div class="alert alert-success text-center" role="alert">
			  <h4>Pendaftaran Service GIT</h4>
			</div>			
		</div>
		<div class="col-md-12 mt-3">
			<div class="alert alert-danger shadow" role="alert">
			  <i class="bi bi-info-circle"></i> Mohon pilih alamat tujuan service, untuk dapat melanjutkan ke tahap pengajuan service.
			</div>
		</div>
		<div class="col-md-12">
			<ul class="list-group list-group-flush" id="dynamic-list"></ul>
		</div>
		<div class="col-md-12 text-center mt-3">
			<img src="<?= $src; ?>" width="30%" /><br>			
			<a href="<?= $link ?>" style="text-decoration: none;color: #dedede;">www.globalintertech.co.id</a>			
		</div>
	</div>
</div>

<script type="text/javascript">
	$(document).ready( () => { let telp = '<?= $telp; ?>', keluhan = '<?= $keluhan; ?>', mode = '<?= $mode; ?>';
		$.ajax({ url:'<?php include "init.php"; ?>', data:{ mode:'ls_alamat', telp }, type:'POST', dataType:'json', cache:false, complete: () => { $('.loading').fadeOut('slow'); }, success: (data) => {
				let html = '<li class="list-group-item"><b><i class="bi bi-list-ul"></i> Pilih Alamat</b></li></li>';
				$.each(data, (inx, elm) => {
					html += '<li class="list-group-item li-pointer" data-id="'+ elm.id_customer +'"><i class="bi bi-arrow-return-right"></i> '+ elm.nama +'<br /><i>'+ elm.alamat +'</i> <span class="float-right"><i class="bi bi-chevron-double-right"></i></span></li>';
				}); $('#dynamic-list').html(html);
			}
		});
		$('#dynamic-list').on('click', '.li-pointer', function() {
			let id_customer = $(this).attr('data-id');
			$.ajax({ beforeSend: () => { $('.loading').fadeIn('slow'); }, url:'form-proses', data:{ id_customer, telp, keluhan, mode }, type:'POST', cache:false, success: (page) => { $('#div-load-page').html(page); } });
		});
	});
</script>
