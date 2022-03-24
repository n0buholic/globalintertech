<?php require_once('../setty/func.php'); $link = "../img/logo.png"; $src = encode_base64($link); $mode = $_POST['mode'];
	$str = $_POST['str'];
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
			  <h4>Data Service RMA Customer</h4>
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
	$(document).ready( () => { let mode = '<?= $mode; ?>', str = '<?= $str; ?>';
		$.ajax({ url:'<?php include "init.php"; ?>', data:{ mode:mode, str }, type:'POST', dataType:'json', cache:false, complete: () => { $('.loading').fadeOut('slow'); }, success: (data) => { let header_ls;
				if(mode == 'ls_sn') { header_ls = 'Pilih Serial Number'; } else
				if(mode == 'ls_inv') { header_ls = 'Pilih Invoice #SN : '+ str +'#'; }
				let html = '<li class="list-group-item"><b><i class="bi bi-list-ul"></i> '+ header_ls +'</b></li></li>';
				$.each(data, (inx, elm) => {
					let str;
					if(mode == 'ls_sn') { str = elm.sn; } else if(mode == 'ls_inv') { str = elm.id_svc; }
					html += '<li class="list-group-item li-pointer" data-index="'+ elm.no_lsr +'">'+ str +' <span class="float-right"><i class="bi bi-chevron-double-right"></i></span></li>';
				}); $('#dynamic-list').html(html);
			}
		});
		$('#dynamic-list').on('click', '.li-pointer', function() {
			let index = $(this).attr('data-index');
			$.ajax({ beforeSend: () => { $('.loading').fadeIn('slow'); }, url:'page-detail', data:{ mode, str, index }, type:'POST', cache:false, success: (page) => { $('#div-load-page').html(page); } });
		});
	});
</script>
