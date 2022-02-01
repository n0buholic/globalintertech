<?php
	date_default_timezone_set('Asia/Kuala_Lumpur'); require_once("../setty/config.php"); require_once("../setty/func.php"); $IdSvc = $_POST['IdSvc'];
	$Src = encode_base64("../admgolax/assets/img/logo-cmb.png");
?>
<div class="row">
	<div class="col-md-12">
		<div class="alert alert-info text-center">
			<h4>Mohon berikan masukkan terkait service yang kami kerjakan...terimakasih.</h4>
		</div>
	</div>
	<div class="col-md-12" id="load_pages_sub"></div>
	<div class="col-md-12">
		<div class="alert alert-info text-center">
			<h4>Hormat kami,<br /></h4>
			<img src="<?= $Src; ?>" height="70px" alt="Global Intertech" /><br /><br />
			<a href="https://globalintertech.co.id" class="btn btn-primary">www.globalintertech.co.id</a>
		</div>
	</div>
</div>
<script type="text/javascript">
	$(document).ready(function(){
		$.ajax({
			url: 'status',
			method: 'POST',
			data: 'IdSvc=<?= $IdSvc; ?>',
			cache: false,
			success: function(result){
				$('#load_pages_sub').html(result);
			}
		});
	});
</script>