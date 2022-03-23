<?php require_once('../setty/func.php'); $link = "../img/logo.png"; $src = encode_base64($link); $id_customer = $_POST['id_customer'];
	$telp = $_POST['telp'];
	if($_SERVER["SERVER_NAME"] !=="localhost"){ $link = "https://".$_SERVER["SERVER_NAME"]; }
		else { $link = "https://".$_SERVER["SERVER_NAME"] . "/global/"; } ?>
<style type="text/css">
	.li-pointer { cursor: pointer; }
	.li-pointer:hover { background-color: #eee; }
</style>
<div class="container border rounded p-3 shadow">
	<div class="row" style="padding-bottom: 0px;">
		<div class="col-md-12">
			<div class="alert alert-dark text-center" role="alert">
			  <h4>Data Service Customer</h4>
			</div>			
		</div>
		<div class="col-md-12">
			<ul class="list-group list-group-flush">
				<li class="list-group-item" id="html-alamat"></li>
				<li class="list-group-item list-group-item-secondary">
					<b><i class="bi bi-list-ul"></i> Data Service</b></li>
				<li class="list-group-item">
					<input class="form-control" type="text" id="textfind" autocomplete="off" placeholder="temukan invoice...">
				</li>
			</ul>
			<ul id="dynamic-svc" class="list-group list-group-flush"></ul>
		</div>
		<div class="col-md-12 mt-3 text-right">
			<button type="button" class="btn btn-block btn-outline-secondary btn-sm">kembali</button>
		</div>
		<div class="col-md-12 text-center mt-3" style="background-color: rgb(221, 221, 221, 50%);padding: 10px;">
			<img src="<?= $src; ?>" width="30%" /><br>			
			<a href="<?= $link ?>" style="text-decoration: none;color: #dedede;">www.globalintertech.co.id</a>			
		</div>
	</div>
</div>

<script type="text/javascript">
	$(document).ready( () => { let id_customer = '<?= $id_customer; ?>', telp = '<?= $telp; ?>';
		function ls_no_service(data)
		{
			let html = '';
			$.each(data, (inx, elm) => {
				let sts_svc;
				if(parseInt(elm.sts_batal) == 0){
					if(parseInt(elm.sts_svc) == 0) { sts_svc = '<span class="badge badge-pill badge-secondary">Daftar Tunggu</span>'; } else
					if(parseInt(elm.sts_svc) == 1) { sts_svc = '<span class="badge badge-pill badge-warning">Dikerjakan</span>'; } else
					if(parseInt(elm.sts_svc) == 2) { sts_svc = '<span class="badge badge-pill badge-info">Proses Administrasi</span>'; }
					if(parseInt(elm.sts_svc) == 3) { sts_svc = '<span class="badge badge-pill badge-success">Lunas</span>'; }
				} else {
					sts_svc = '<span class="badge badge-pill badge-danger">Dibatalkan</span>';
				}
				html += '<li class="list-group-item li-pointer" data-id="'+ elm.id_service +'">'+ elm.id_service +' '+ sts_svc +' <span class="float-right"><i class="bi bi-chevron-double-right"></i></span></li>';
			}); return html;
		}
		$.ajax({ url:'rest-api/view/View_service', data:{ mode:'log_service_customer', id_customer }, type:'POST', dataType:'json', cache:false, complete: () => { $('.loading').fadeOut('slow'); }, success: (data) => {
				$('#dynamic-svc').html(ls_no_service(data.ls_svc)); $('#html-alamat').html('<i><b>Alamat</b>:<br>'+ data.alamat +'</i>');
		} });
		$('button').on('click', () => {
			$.ajax({ beforeSend: () => { $('.loading').fadeIn('slow'); }, url:'list-alamat-customer', data:{ telp, id_customer }, type:'POST', cache:false, complete: () => { $('.loading').fadeOut('slow'); }, success: (page) => {
					$('#div-load-page').html(page)
			} });
		});
		$('ul').on('click', '.li-pointer', function() {
			let id_service = $(this).attr('data-id');
			$.ajax({ beforeSend: () => { $('.loading').fadeIn('slow'); }, url:'detail-service', data:{ telp, id_customer, id_service }, type:'POST', cache:false, success: (page) => { $('#div-load-page').html(page); } });
		});
		$('#textfind').keyup( function() {
			let filter = $(this).val();
			$.ajax({ url:'rest-api/view/View_service', data:{ mode:'log_service_customer', id_customer, filter }, type:'POST', dataType:'json', cache:false, success: (data) => { $('#dynamic-svc').html(ls_no_service(data.ls_svc)); } });
		});
	});
</script>
