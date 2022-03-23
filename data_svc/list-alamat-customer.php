<?php require_once('../setty/func.php'); $link = "../img/logo.png"; $src = encode_base64($link); $telp = $_POST['telp'];
	if($_SERVER["SERVER_NAME"] !=="localhost"){ $link = "https://".$_SERVER["SERVER_NAME"]; }
		else { $link = "https://".$_SERVER["SERVER_NAME"] . "/global/"; } ?>
<style type="text/css">
	.li-pointer { cursor: pointer; }
	.li-pointer:hover { background-color: #eee; }
</style>
<div class="container border rounded p-3 shadow">
	<div class="row">
		<div class="col-md-12">
			<div class="alert alert-dark text-center" role="alert">
			  <h4>Data Service Customer</h4>
			</div>			
		</div>
		<div class="col-md-12">
			<ul class="list-group list-group-flush" id="dynamic-alamat"></ul>
		</div>
		<div class="col-md-12 text-center mt-3">
			<img src="<?= $src; ?>" width="30%" /><br>			
			<a href="<?= $link ?>" style="text-decoration: none;color: #dedede;">www.globalintertech.co.id</a>			
		</div>
	</div>
</div>

<script type="text/javascript">
	$(document).ready( () => { let telp = '<?= $telp; ?>';
		$.ajax({ url:'rest-api/view/View_service', data:{ mode:'list_alamat', telp }, type:'POST', dataType:'json', cache:false, success: (data) => { let html = '<li class="list-group-item"><b><i class="bi bi-list-ul"></i> Pilih Alamat</b></li></li>';
				$.each(data, (inx, elm) => {
					html += '<li class="list-group-item li-pointer" data-id="'+ elm.id_customer +'">'+ elm.alamat +' <span class="float-right"><span class="badge badge-secondary">'+ elm.total +'</span> <i class="bi bi-chevron-double-right"></i></span></li>';
				}); $('#dynamic-alamat').html(html);
			}
		});
		$('#dynamic-alamat').on('click', '.li-pointer', function() {
			let id_customer = $(this).attr('data-id');
			$.ajax({ beforeSend: () => { $('.loading').fadeIn('slow'); }, url:'list-service-customer', data:{ telp, id_customer }, type:'POST', cache:false, success: (page) => { $('#div-load-page').html(page); } });
		});
	});
</script>
