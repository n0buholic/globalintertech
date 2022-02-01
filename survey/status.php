<?php
	date_default_timezone_set('Asia/Kuala_Lumpur'); require_once("../setty/config.php"); require_once("../setty/func.php"); $IdSvc = $_POST['IdSvc'];
	$q1 = mysqli_query($conn,"select * from tb_keritik_saran_service where id_service='".$IdSvc."'");
	$row1 = mysqli_num_rows($q1);
	if($row1 == 0){
		$q = mysqli_query($conn,"select * from tb_log_service where id_service='".$IdSvc."' LIMIT 1");
		$d = mysqli_fetch_array($q);
		if($d['status'] > 1 AND $IdSvc != ""){
?>
<div class="row"><div class="col-md-12" id="load_alert"></div></div>
<form id="frm-block" action="" method="POST">
	<div class="form-group">
		<label>Kritik/Saran Anda</label>
		<textarea rows="6" name="value_null" id="value_null" class="form-control"></textarea>
	</div>
	<div class="form-group">
		<button type="button" class="btn btn-success btn-grad tsurvey" id="2"><i class="icon-thumbs-up-alt"></i> Puas</button>
		<button type="button" class="btn btn-danger btn-grad pull-right tsurvey" id="1"><i class="icon-thumbs-down-alt"></i> Tidak Puas</button>
	</div>
</form><br />
<script type="text/javascript">
	$(document).ready(function(){
		$('.tsurvey').click(function(){
			var Status = $(this).attr('id'), Kritik = $('#value_null').val();
			if(Kritik != ''){
				$.ajax({
					beforeSend: function(){ $('.loading').fadeIn('slow'); },
					url: 'aksi',
					method: 'POST',
					data: 'op=sv_data&IdSvc=<?= $IdSvc; ?>&Status='+ Status +'&Kritik='+ Kritik,
					dataType: 'json',
					cache: false,
					success: function(result){
						$('.loading').fadeOut('slow', function(){
							if(result.Status == 'oke'){
								$('#load_pages_sub').html(result.Info);
							} else {
								$('#load_alert').html(result.Info);
							}
						});
					}
				});
			}
		});
	});
</script>
<?php
		} else {
?>
<div class="alert alert-danger text-center">
	<h4>ID Service tidak ditemukan.</h4>
</div>
<?php
		}
	} else {
?>
<div class="alert alert-danger text-center">
	<h4>ID Service tidak ditemukan.</h4>
</div>
<?php
	}
?>