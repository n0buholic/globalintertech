<?php require_once('../setty/func.php'); $link = "../img/logo.png"; $src = encode_base64($link); $id_customer = $_POST['id_customer'];
	$telp = $_POST['telp']; $id_service = $_POST['id_service'];
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
		<div class="col-md-12" id="detail-svc">
			
			<ul class="list-group list-group-flush">
			  <li class="list-group-item">ID. Service <span class="float-right" id="html-svc"></span></li>
			  <li class="list-group-item">Tgl. Daftar <span class="float-right" id="html-daftar"></span></li>
			  <li class="list-group-item">Tgl. Proses <span class="float-right" id="html-proses"></span></li>
			  <li class="list-group-item">Tgl. Selesai <span class="float-right" id="html-selesai"></span></li>
			  <li class="list-group-item">Keluhan</li>
			  <li class="list-group-item" id="html-keluhan">-</li>
			  <li class="list-group-item list-group-item-secondary" id="dynamic-teknisi"><i class="bi bi-people-fill"></i> Teknisi</li>
			</ul>
			<div class="alert mt-5 text-center" role="alert" id="html-sts-svc"></div>
		</div>
		<div class="col-md-12 mt-5 text-right">
			<button type="button" class="btn btn-block btn-outline-secondary btn-sm">kembali</button>
		</div>
		<div class="col-md-12 text-center mt-3" style="background-color: rgb(221, 221, 221, 50%);padding: 10px;">
			<img src="<?= $src; ?>" width="30%" /><br>			
			<a href="<?= $link ?>" style="text-decoration: none;color: #dedede;">www.globalintertech.co.id</a>			
		</div>
	</div>
</div>

<script type="text/javascript">
	$(document).ready( () => { let id_customer = '<?= $id_customer; ?>', telp = '<?= $telp; ?>', id_service = '<?= $id_service; ?>';		
		$.ajax({ url:'rest-api/view/View_service', data:{ mode:'detail_service', id_service }, type:'POST', dataType:'json', cache:false, complete: () => { $('.loading').fadeOut('slow'); }, success: (data) => {
				$('#html-svc').html(id_service); $('#html-daftar').html(data.detail.tgl_masuk);
				$('#html-proses').html(data.detail.tgl_proses); $('#html-selesai').html(data.detail.tgl_selesai);
				$('#html-keluhan').html('<i>'+ data.detail.keluhan +'</i>');
				let ls_tek = '';
				$.each(data.ls_teknisi, (inx, elm) => { ls_tek += '<li class="list-group-item"><i class="bi bi-caret-right-fill"></i> '+ elm +'</li>'; }); $('#dynamic-teknisi').after(ls_tek);
				if(parseInt(data.detail.sts_batal) == 1)
				{
					// jika service berstatus batal
					$('#html-sts-svc').html('<i class="bi bi-x-octagon-fill"></i> Dibatalkan').addClass('alert-danger');
				} else {
					// jika service berstatus tidak batal
					if(parseInt(data.detail.sts_svc) == 0) {
						$('#html-sts-svc').html('<i class="bi bi-hourglass"></i> Daftar Tunggu').addClass('alert-secondary'); } else
					if(parseInt(data.detail.sts_svc) == 1) {
						$('#html-sts-svc').html('<i class="bi bi-tools"></i> Dikerjakan').addClass('alert-warning'); } else
					if(parseInt(data.detail.sts_svc) == 2) {
						$('#html-sts-svc').html('<i class="bi bi-cash-coin"></i> Proses Administasi').addClass('alert-info'); } else
					if(parseInt(data.detail.sts_svc) == 3) {
						$('#html-sts-svc').html('<i class="bi bi-check-circle-fill"></i> Selesai').addClass('alert-success'); }
				}
		} });
		$('button').on('click', () => {
			$.ajax({ beforeSend: () => { $('.loading').fadeIn('slow'); }, url:'list-service-customer', data:{ telp, id_customer }, type:'POST', cache:false, complete: () => { $('.loading').fadeOut('slow'); }, success: (page) => {
					$('#div-load-page').html(page)
			} });
		});
	});
</script>
