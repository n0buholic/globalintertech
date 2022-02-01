<?php
	date_default_timezone_set('Asia/Kuala_Lumpur'); require_once("../setty/config.php"); require_once("../setty/func.php");
?>
<div class="row" style="margin-top:2em;">
	<div class="col-md-3"></div>
		<div class="col-md-6">
			<form role="form" id="frm-block">
				<div class="form-group">
					<div class="input-group">
						<input id="brand" name="brand" type="text" placeholder="masukkan ID Service" class="form-control" />
						<span class="input-group-btn"><button class="btn btn-success" type="submit"><i class="icon-search"></i></button></span>
					</div>
				</div>
			</form>
		</div>
	<div class="col-md-3"></div>
</div>
<div class="row">
	<div class="col-md-12"><div class="alert alert-info"><i class="icon-print"></i> Preview Laporan</div></div>
</div>
<div class="row">
	<div class="col-md-12 load_preview"></div>
</div>
<script type="text/javascript">		
	$(document).ready(function(){	
		$(function () { formValidation(); });
		$('#frm-block').submit(function(){
			var id = $('#brand').val();
			if(id != ''){
				$.ajax({
					beforeSend: function(){
						$('.loading').fadeIn('slow');
					},
					url: "lap_preview",
					data: {id:id},
					cache: false,
					success: function(data){
						$('.loading').fadeOut('slow', function(){
							$(".load_preview").html(data);
						});
					}
				});
			}
			return false;
		});
	});
</script>