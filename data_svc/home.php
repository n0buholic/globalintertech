<?php
	date_default_timezone_set('Asia/Kuala_Lumpur'); require_once("../setty/config.php"); require_once("../setty/func.php");
?>
<div class="row" style="margin-top:2em;">
	<div class="col-md-3"></div>
	<div class="col-md-6">
		<div class="panel panel-primary">
			<div class="panel-heading"><h4><i class="icon-list-alt"></i> Data Service Anda</h4></div>
			<div class="panel-body load_pages"></div>
		</div>
	</div>
	<div class="col-md-3"></div>
</div>
<script type="text/javascript">		
	$(document).ready(function(){	
		$.ajax({
			url: "form_cek_service",
			cache: false,
			success: function(data){
				$(".load_pages").html(data);
			}
		});
	});
</script>