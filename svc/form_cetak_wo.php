<?php 
	date_default_timezone_set('Asia/Kuala_Lumpur'); require_once("../setty/config.php"); require_once('../setty/func.php');
	
	$idsvc = $_GET['idsvc'];

	$link = "pdf/".$idsvc.".pdf"; $imageData = base64_encode(file_get_contents($link));
	$src = 'data:'.mime_content_type($link).';base64,'.$imageData; @unlink($link);
?>
<div class="row">
	<div class="col-md-12" style="margin-top:1em;">
		Jika file tidak ditemukan/tampil, unduh file disini <a href="<?= $src; ?>" download="<?= $idsvc; ?>.pdf">unduh file</a>		
	</div>
	<div class="col-md-12">
		<embed src="<?= $src; ?>" type="application/pdf" width="100%" height="500px"/>
	</div>
</div>