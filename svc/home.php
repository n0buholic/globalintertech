<?php
	date_default_timezone_set('Asia/Kuala_Lumpur'); require_once("../setty/config.php"); require_once("../setty/func.php");
	$inv = $_POST['inv'];
?>
<script type="text/javascript">
	$(document).ready(function(){
		$.ajax({ type:'POST', url:'frm_cek_inv', data:{ inv:'<?= $inv; ?>' }, chace:false, success:function(page){ $('#html_load_sumber').html(page); } });/*end*/
	});/*endocumnet*/
</script>