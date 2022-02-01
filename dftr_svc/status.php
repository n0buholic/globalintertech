<?php
	date_default_timezone_set('Asia/Kuala_Lumpur'); require_once("../setty/config.php"); require_once("../setty/func.php");
	$sub = $_POST['sub'];
	if($sub == "selesai"){
		echo "<div class='alert alert-success' style='text-align:center;font-size:20px;'><i class='icon-ok'></i> Keluhan Anda Berhasil Diproses</div><br /><br />";
		echo "<button class='btn btn-block btn-grad btn-warning tback'>Buat Keluhan Baru</button>";
?>
		<script type="text/javascript">
			$(document).ready(function(){
				$('.tback').click(function(){
					$.ajax({
						beforeSend: function(){
							$('.loading').fadeIn('slow');
						},
						url: 'form_daftar_svc_1',
						cache: false,
						success: function(data){
							$('.loading').fadeOut('slow', function(){
								$('.load_page_sub').html(data);
							});
						}
					});
				});
			});
		</script>
<?php
	}
?>