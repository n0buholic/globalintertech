<?php require_once('../setty/func.php'); $link = "../img/logo.png"; $src = encode_base64($link); $id_customer = $_POST['id_customer'];
	$telp = $_POST['telp']; $keluhan = $_POST['keluhan']; $mode = $_POST['mode'];
	if($_SERVER["SERVER_NAME"] !=="localhost"){ $link = "https://".$_SERVER["SERVER_NAME"]; }
		else { $link = "https://".$_SERVER["SERVER_NAME"] . "/global/"; } ?>
<div class="container border rounded p-3 shadow">
	<div id="html-sukses"></div>
	<div class="row row-sukses">
		<div class="col-md-12">
			<div class="alert alert-success text-center" role="alert">
			  <h4>Pendaftaran Service GIT</h4>
			</div>			
		</div>
		<div class="col-md-12">
			<h6><i class="bi bi-card-checklist"></i> Berikut adalah data yang akan diproses:</h6>
			<ul class="list-group list-group-flush">
			  <li class="list-group-item"><i class="bi bi-person"></i> Customer <span class="float-right" id="html-customer"></span></li>
			  <li class="list-group-item"><i class="bi bi-telephone"></i> No. Telp/HP <span class="float-right" id="html-telp"></span></li>
			  <li class="list-group-item"><i class="bi bi-geo-alt"></i> Alamat <span class="float-right" id="html-alamat"></span></li>
			  <li class="list-group-item"><i class="bi bi-tools"></i> <i><b>Permasalahan yang akan ditangi:</b></i></li>
			  <li class="list-group-item" id="html-keluhan"></li>
			</ul>
		</div>
		<div class="col-md-12" id="html-alert"></div>
		<div class="col-md-12">
			<button type="button" class="btn btn-block btn-success btn-sm t_kirim"><i class="bi bi-send"></i> Daftar Sekarang</button>
		</div>
		<?php if($mode == "alamat") { ?>
		<div class="col-md-12 mt-5 text-right">
			<button type="button" class="btn btn-block btn-outline-secondary btn-sm t_back">kembali</button>
		</div>
		<?php } ?>
		<div class="col-md-12 text-center mt-3">
			<img src="<?= $src; ?>" width="30%" /><br>			
			<a href="<?= $link ?>" style="text-decoration: none;color: #dedede;">www.globalintertech.co.id</a>			
		</div>
	</div>
</div>

<script type="text/javascript">
	$(document).ready( () => { let id_customer = '<?= $id_customer; ?>', telp = '<?= $telp; ?>', keluhan = '<?= $keluhan; ?>';
		let mode = '<?= $mode; ?>';
		$.ajax({ url:'<?php include "init.php"; ?>', data:{ mode:'detail_customer', id_customer }, type:'POST', dataType:'json', cache:false, complete: () => { $('.loading').fadeOut('slow'); }, success: (data) => {
				$('#html-customer').html(data.nama); $('#html-alamat').html('<i>'+ data.alamat +'</i>'); $('#html-telp').html(data.kontak);
				$('#html-keluhan').html('<i class="bi bi-caret-right-fill"></i> <i>'+ keluhan +'</i>');
		} });
		$('.t_back').on('click', () => {
			$.ajax({ beforeSend: () => { $('.loading').fadeIn('slow'); }, url:'page-list-alamat', data:{ telp, keluhan, mode }, type:'POST', cache:false, success: (page) => { $('#div-load-page').html(page) } });
		});
		$('.t_kirim').on('click', () => {
			$.ajax({ beforeSend: () => { $('.loading').fadeIn('slow'); }, url:'<?php include "init.php"; ?>', data:{ mode:'kirim_service_baru', id_customer, keluhan }, type:'POST', dataType:'json', cache:false, success: (msg) => {
					if(msg.status == 'invalid')
					{
						$('#html-alert').html('<div class="alert alert-danger text-center" role="alert"><h5>'+ msg.alert +'</h5></div>');
						$('.loading').fadeOut('slow');
					}
					else
					{
						$('.row-sukses').html(''); $('#html-sukses').html('<div class="alert alert-success text-center" role="alert"><h5><i class="bi bi-check2-all"></i> '+ msg.alert +'</h5></div>'); $('.loading').fadeOut('slow');
					}

				}
			});
		});
	});
</script>
