<?php require_once('../setty/func.php'); $link = "../img/logo.png"; $src = encode_base64($link); $id_customer = $_POST['id_customer'];
	$telp = $_POST['telp']; $id_service = $_POST['id_service'];
	if($_SERVER["SERVER_NAME"] !=="localhost"){ $link = "https://".$_SERVER["SERVER_NAME"]; }
		else { $link = "https://".$_SERVER["SERVER_NAME"] . "/global/"; } ?>
<style type="text/css">
	.li-pointer { cursor: pointer; }
	.li-pointer:hover { background-color: #eee; }
	a:link { text-decoration: none; color: #333; }
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
				<li class="list-group-item list-group-item-secondary"><i class="bi bi-person-fill"></i> Customer</li>
				<li class="list-group-item">Nama <span class="float-right" id="html-nama">Customer</span></li>
				<li class="list-group-item">Alamat</li>
				<li class="list-group-item" id="html-alamat">Alamat</li>
				<li class="list-group-item list-group-item-secondary"><i class="bi bi-tools"></i> Service</li>
				<li class="list-group-item">ID. Service <span class="float-right" id="html-svc"></span></li>
				<li class="list-group-item">Tgl. Daftar <span class="float-right" id="html-daftar"></span></li>
				<li class="list-group-item">Tgl. Proses <span class="float-right" id="html-proses"></span></li>
				<li class="list-group-item">Tgl. Selesai <span class="float-right" id="html-selesai"></span></li>
				<li class="list-group-item">Keluhan</li>
				<li class="list-group-item" id="html-keluhan">-</li>
				<li class="list-group-item list-group-item-secondary" id="dynamic-teknisi"><i class="bi bi-people-fill"></i> Teknisi</li>
			</ul>
			<div class="alert mt-5 text-center" role="alert" id="html-sts-svc" style="height: 100px;padding-top: 35px;"></div>
			<ul class="list-group list-group-flush mt-5">
			  <li class="list-group-item unduh-so" style="color:#eee;"><i class="bi bi-cloud-arrow-down"></i> Unduh File SO</li>
			  <li class="list-group-item unduh-dok" style="color:#eee;"></li>
			</ul>
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
		let src_so, record_img;
		$.ajax({ url:'https://global.cmbstore.id/rest-api/view/View_service', data:{ mode:'detail_service', id_service }, type:'POST', dataType:'json', cache:false, complete: () => { $('.loading').fadeOut('slow'); }, async:false, success: (data) => {
				$('#html-nama').html(data.detail.nama); $('#html-alamat').html(data.detail.alamat);
				// jika ditemukan record foto kegiatan service
				if( parseInt( data.detail.record_img ) > 0 ) {
					$('.unduh-dok').addClass('li-pointer');
					$.ajax({ url:'https://global.cmbstore.id/rest-api/view/View_service', data:{ mode:'membuat_pdf_foto', id_service }, type:'POST', dataType:'json', cache:false, success: (data) => {
        					$('.unduh-dok').html(`<a class="unduh" href="${data.src_file}" download="${id_service}.pdf"><i class="bi bi-cloud-arrow-down"></i> Unduh Foto Dokumentasi</a>`);
					} });
				}
				// source untuk file so
				src_so = data.detail.file_so;
				// jika file so ditemukan
				if(data.detail.file_so !== '') { $('.unduh-so').attr('id', 'unduh-so').addClass('li-pointer').css('color', '#333'); }
				// end
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
		// proses preview file so
        $('#unduh-so').on('click', function() {
	        let pdfWindow = window.open("");
	        pdfWindow.document.write(`<html<head><title>${id_service}</title><style>body{margin: 0px;}iframe{border-width: 0px;}</style></head>`);
	        pdfWindow.document.write(`<body><embed width='100%' height='100%' src='${src_so}#toolbar=0&navpanes=0&scrollbar=0'></embed></body></html>`);
        });        
	});
</script>
