<?php
	date_default_timezone_set('Asia/Kuala_Lumpur'); require_once("../setty/config.php"); require_once("../setty/func.php");
?>
<div class="row">
	<div class="col-lg-12 load_pages"></div>
</div>
<script type="text/javascript">		
	$(document).ready(function(){	
		$.ajax({
			url: "form_info",
			cache: false,
			success: function(data){
				$(".load-hal").html(data);
			}
		});
	});
</script>