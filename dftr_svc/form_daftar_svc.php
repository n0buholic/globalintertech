<?php
	date_default_timezone_set('Asia/Kuala_Lumpur'); require_once("../setty/config.php"); require_once("../setty/func.php");
?>
<div class="row" style="margin-top:2em;">
	<div class="col-md-3"></div>
	<div class="col-md-6">
		<div class="row">
			<div class="col-md-12">
				<div class="alert alert-info"><i>Tata Cara Service Online</i>:<br />Anda cukup menginputkan <b>No. HP</b> dan <b>Keluhan</b> yang ingin ditindak lanjuti oleh Taknisi kami.</div>
			</div>
		</div>
		<div class="row">
			<div class="col-md-12">
				<div class="panel panel-success">
					<div class="panel-heading">Data Service Anda</div>
					<div class="panel-body load_page_sub"></div>
				</div>
			</div>
		</div>
	</div>
	<div class="col-md-3"></div>
</div>
<script type="text/javascript">		
	$(document).ready(function(){	
		$.ajax({
			url: 'form_daftar_svc_1',
			cache: false,
			success: function(data){
				$('.load_page_sub').html(data);
			}
		});
	});
</script>