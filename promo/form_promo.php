<?php
	date_default_timezone_set('Asia/Kuala_Lumpur'); require_once("../setty/config.php");
	require_once("../setty/function.php");
	$q = mysqli_query($conn,"select * from tb_promo order by no_pro desc"); $d = mysqli_fetch_array($q);
?>
<div class="row">
	<div class="col-md-12" style="cursor:pointer;">
		<img class="tklaim_promo" src="<?php echo str_replace('_','/',$d['link_pro']); ?>"  width="100%" />
	</div>
</div>
<div class="row">
	<div class="col-md-12">
		<div class="alert alert-info">Cara mengikuti promo, klik pada Foto Promo kemudian isi data yang telah disediakan, kemudian Klaim Promo...</div>
	</div>
</div>
<script type="text/javascript">
	$(document).ready(function(){
		$('.tklaim_promo').click(function(){
			$.ajax({
				url: 'promo/form_daftar_promo',
				cache: false,
				success: function(data){
					$('.load_form_modal').html(data);				
				}
			});
		});
	});
</script>