<?php
	date_default_timezone_set('Asia/Kuala_Lumpur'); require_once("../../setty/config.php"); require_once("../../setty/func.php");
	$id = $_GET['id'];
	$q = mysqli_query($conn,"select * from tb_event where id_event='$id'"); $dt =""; $no = 1;
	while($r = mysqli_fetch_array($q)){
		$q1 = mysqli_query($conn,"select *, count(*)as total from tb_event where id_event='$id'");
		$d1 = mysqli_fetch_array($q1);
		$dt .= "<div class='viewSlide'>
					<img class='fullImg' src='".str_replace("_","/",$r['link'])."' id='foto".$no++."'>
				</div>";
	}
	$q1 = mysqli_query($conn,"select * from tb_event where id_event='$id'");
	$d1 = mysqli_fetch_array($q1);
	$q2 = mysqli_query($conn,"select * from tb_user where id_teknisi='$d1[id_user]'");
	$d2 = mysqli_fetch_array($q2);
?>
<div class="row">
	<div class="col-md-12">
		<div class="alert alert-success" style="font-size:1.6em;text-align:center;"><?php echo ucwords($d1['keterangan']); ?><br /><i style="font-size:0.6em;"><?php echo "Posting: ".$d1['tgl']." oleh ".ucwords($d2['nama']); ?></i></div>
	</div>
</div>
<div class="row">		
	<div class="blink-slider">
		<div class="blink-view" id="blink"><?php echo $dt; ?></div>
		<div class="blink-control" id="blink-control"></div>
	</div>
</div>

<script type="text/javascript">
	$(document).ready(function(){
		$("#blink").blink({
			viewTime: 10000
		});
	});
</script>