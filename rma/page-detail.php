<?php require_once('../setty/func.php'); $link = "../img/logo.png"; $src = encode_base64($link); $mode = $_POST['mode'];
	$str = $_POST['str']; $index = $_POST['index'];
	if($_SERVER["SERVER_NAME"] !=="localhost"){ $link = "https://".$_SERVER["SERVER_NAME"]; }
		else { $link = "https://".$_SERVER["SERVER_NAME"] . "/global/"; } ?>
<div class="container border rounded p-3 shadow">
	<div class="row">
		<div class="col-md-12">
			<div class="alert alert-success text-center" role="alert">
			  <h4>Data Service RMA Customer</h4>
			</div>			
		</div>
		<div class="col-md-12">
			<ul class="list-group list-group-flush" id="dynamic-list">
				<li class="list-group-item list-group-item-secondary"><i class="bi bi-list-ul"></i> Detail</li>
				<li class="list-group-item">Tgl. Terdaftar <span class="float-right" id="html-daftar"></span></li>
				<li class="list-group-item">Invoice <span class="float-right" id="html-inv"></span></li>
				<li class="list-group-item">Serial Number <span class="float-right" id="html-sn"></span></li>
				<li class="list-group-item list-group-item-secondary"><i class="bi bi-list-ul"></i> progress</li>
			</ul>
		</div>

		<!-- timeline -->
		<div class="col-md-12">
			<ul class="timeline">
				<!--  -->
				<!-- <li>
					<div class="timeline-badge success">
						<i class="icon-ok"></i>
					</div>
					<div class="timeline-panel">
						<div class="timeline-heading">
							<h4 class="timeline-title">masuk, proses, selesai</h4>
							<p class="text-right">
								<small>Tanggal: </small>
							</p>
						</div>
						<div class="timeline-body">
							<p>Kegiatan</p>
							<p><img src="#" height="150px" alt="" /></p>
						</div>
					</div>
				</li> -->
				<!--  -->
				<!-- <li class="timeline-inverted">
					<div class="timeline-badge success">
						<i class="icon-ok"></i>
					</div>
					<div class="timeline-panel">
						<div class="timeline-heading">
							<h4 class="timeline-title">masuk, proses, selesai</h4>
							<p class="text-right">
								<small>Tanggal: </small>
							</p>
						</div>
						<div class="timeline-body">
							<p>Kegiatan</p>
							<p><img src="#" height="150px" alt="" /></p>
						</div>
					</div>
				</li> -->
				<!--  -->
			</ul>
		</div>
		<!-- end timeline -->

		<div class="col-md-12 mt-3 text-right">
			<button type="button" class="btn btn-block btn-outline-secondary btn-sm">kembali</button>
		</div>
		<div class="col-md-12 text-center mt-3">
			<img src="<?= $src; ?>" width="30%" /><br>			
			<a href="<?= $link ?>" style="text-decoration: none;color: #dedede;">www.globalintertech.co.id</a>			
		</div>
	</div>
</div>

<script type="text/javascript">
	$(document).ready( () => { let mode = '<?= $mode; ?>', str = '<?= $str; ?>', index = '<?= $index; ?>';
		function dom_time_line(data)
		{
			let html = '';
			html += '<li class="'+ data.posisi +'">';
			html +=	'	<div class="timeline-badge success">'+ data.icon +'</div>';
			html += '	<div class="timeline-panel">';
			html += '		<div class="timeline-heading">';
			html += '			<h4 class="timeline-title">'+ data.sts_keg +'</h4>';
			html += '			<p class="text-right"><small>Tanggal: '+ data.tgl +'</small></p>';
			html += '		</div>';
			html += '		<div class="timeline-body">';
			html += '			<p>'+ data.keg +'</p>';
			if(data.src !== '')
			{
				// jika foto ditemkan
				html += '			<p><img src="'+ data.src +'" class="img-thumbnail" width="100%" alt="" /></p>';
			}
			html += '		</div>';
			html += '	</div>';
			html += '</li>'; return html;
		}
		$.ajax({ url:'<?php include "init.php"; ?>', data:{ mode:'detail_per_sn', index }, type:'POST', dataType:'json', cache:false, complete: () => { $('.loading').fadeOut('slow'); }, success: (data) => {
				$('#html-inv').html(data.invoice); $('#html-sn').html(data.sn); $('#html-daftar').html(data.tgl_terdaftar);
				$.each(data.log, (inx, elm) => {
					$('.timeline').append(dom_time_line(elm));
				});
			}
		});
		$('button').on('click', () => {
			$.ajax({ beforeSend: () => { $('.loading').fadeIn('slow'); }, url:'page-list', data:{ mode, str }, type:'POST', cache:false,
				success: (page) => { $('#div-load-page').html(page) } });
		});
	});
</script>
