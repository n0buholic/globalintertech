<?php
	date_default_timezone_set('Asia/Kuala_Lumpur'); require_once("../setty/config.php"); require_once("../setty/func.php");
	$id = $_GET['id']; $timeline = "";
	$q = mysqli_query($conn,"select *, count(id_service)as 'baris' from tb_log_service where id_service='$id' LIMIT 1"); $d = mysqli_fetch_array($q);
	if($d['baris'] == 1){
	if(0 <= $d['status']){
		$day = date('D', strtotime($d['tgl_service'])); $hari = hari($day);
		$timeline .=  "	<li>
							<div class='timeline-badge success'><i class='icon-warning-sign'></i></div>
							<div class='timeline-panel'>
								<div class='timeline-heading'>
									<h4 class='timeline-title'>Daftar Tunggu</h4>
								</div>
								<div class='timeline-body'>
									<p>".$hari.", ".formattgl($d['tgl_service'])."</p>
								</div>
							</div>
						</li>";
	} 
	if(1 <= $d['status']){
		$day = date('D', strtotime($d['tgl_proses'])); $hari = hari($day);
		$timeline .=  "	<li class='timeline-inverted'>
							<div class='timeline-badge success'><i class='icon-refresh'></i></div>
							<div class='timeline-panel'>
								<div class='timeline-heading'>
									<h4 class='timeline-title'>Service di Proses</h4>
								</div>
								<div class='timeline-body'>
									<p>".$hari.", ".formattgl($d['tgl_proses'])."</p>
								</div>
							</div>
						</li>";
	} 
	if(2 <= $d['status']){
		$q1 = mysqli_query($conn,"select * from tb_log_pembayaran where invoice='$id' and sts=1 LIMIT 1"); $d1 = mysqli_fetch_array($q1);
		$arr = explode(" ", $d1['tgl']); $day = date('D', strtotime($arr[0])); $hari = hari($day);
		if($d1['nominal'] > 0){
			$q2 = mysqli_query($conn,"select *, sum(nominal)as 'total' from tb_log_pembayaran where invoice='$id' and sts=0"); $d2 = mysqli_fetch_array($q2); $sisa = $d2['total'] - $d1['nominal'];
			if($sisa < 0){ $sisa = number_format($sisa,0,',','.'); } else { $sisa = "LUNAS"; }
			if($d2['total'] > 0){ $view = "tview_log_byr"; } else { $view = ""; }
			$timeline .=  "	<li class='".$view."' data-id='".$id."'>
								<div class='timeline-badge success'><i class='icon-money'></i></div>
								<div class='timeline-panel'>
									<div class='timeline-heading'>
										<h4 class='timeline-title'>Proses Pembayaran</h4>
									</div>
									<div class='timeline-body'>
										<p>".$hari.", ".formattgl($arr[0])."</p>
										<p>Total Tagihan: <b>Rp.".number_format($d1['nominal'],0,',','.')."</b> ( ".$sisa." )</p>
									</div>
								</div>
							</li>";
		}
	}
	if(3 <= $d['status']){
		$day = date('D', strtotime($d['tgl_end_service'])); $hari = hari($day);
		$timeline .=  "	<li class='timeline-inverted'>
							<div class='timeline-badge success'><i class='icon-ok'></i></div>
							<div class='timeline-panel'>
								<div class='timeline-heading'>
									<h4 class='timeline-title'>Service Selesai</h4>
								</div>
								<div class='timeline-body'>
									<p>".$hari.", ".formattgl($d['tgl_end_service'])."</p>
								</div>
							</div>
						</li>";
	}
	if($d['keluhan'] != ""){
		echo "<div class='alert alert-info'><b>Keluhan:</b><br /><i>".$d['keluhan']."</i></div>";
	}
	echo "<ul class='timeline'>".$timeline."</ul>";
	if($d['status'] > 2){
		echo "	<div class='row' style='margin-top:2em;'>
					<div class='col-md-12'><button class='btn btn-grad btn-success tcetak'><i class='icon-print'></i> Cetak WO</button></div>
				</div>";
	}
?>
<script type="text/javascript">
	$(document).ready(function(){
		$('.tcetak').click(function(){
			var idsvc = '<?php echo $id; ?>', idcus = '<?php echo $d['id_customer']; ?>', komplain = '<?php echo $d['keluhan']; ?>';
			$.ajax({
				beforeSend: function(){
					$('.loading').fadeIn('slow');
				},
				url: "cetak_bukti_finish",
				data: {idsvc:idsvc, idcus:idcus, komplain:komplain},
				cache: false,
				success: function(){
					$.ajax({
						url: "form_cetak_wo",
						data: {idsvc:idsvc},
						cache: false,
						success: function(data){
							$('.loading').fadeOut('slow', function(){
								$(".load_preview").html(data);
							});
						}
					});
				}
			});
		});
		$('.tview_log_byr').click(function(){
			var id = $(this).data('id');
			$.ajax({
				beforeSend: function(){
					$('.loading').fadeIn('slow');
				},
				url: "log_bayar",
				data: {id:id},
				cache: false,
				success: function(data){
					$('.loading').fadeOut('slow', function(){
						$(".load_preview").html(data);
					});
				}
			});
		});
	});
</script>
	<?php } else { echo "<center><span class='label label-danger'>Mohon maaf, data tidak ditemukan.</span></center>"; } ?>