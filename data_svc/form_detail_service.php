<?php
	date_default_timezone_set('Asia/Kuala_Lumpur'); require_once("../setty/config.php");
	require_once("../setty/function.php"); $idsvc = $_POST['idsvc'];
	$q = mysqli_query($conn,"select * from tb_log_service where id_service='".$idsvc."' LIMIT 1");
	$d = mysqli_fetch_array($q); $tgl_masuk = $d['tgl_service']; $hr_masuk = date("D", strtotime($tgl_masuk));
	if($d['tgl_proses'] != "0000-00-00"){
		$tgl_proses = formattgl2($d['tgl_proses']); $hr_proses = hari(date("D", strtotime($d['tgl_proses'])));
		$str_tgl_proses = $hr_proses.", ".$tgl_proses;
	} else { $str_tgl_proses = "<span class='label label-danger'>belum</span>"; }
	if($d['tgl_end_service'] != "0000-00-00"){
		$tgl_selesai = formattgl2($d['tgl_end_service']); $hr_selesai = hari(date("D", strtotime($d['tgl_end_service'])));
		$str_tgl_selesai = $hr_selesai.", ".$tgl_selesai;
	} else { $str_tgl_selesai = "<span class='label label-danger'>belum</span>"; }
	if($d['status'] == 0){ $clr_tr = "danger"; } else { $clr_tr = "success"; }
?>
<div class="panel panel-info">
	<div class="panel-heading"><i class="icon-list-alt"></i> Data Detail</div>
	<div class="panel-body">
		<div class="table-responsive">
			<table class="table table-striped" width="100%">
				<tr><td width="120px">Tgl. Terdaftar</td><td><i class="icon-caret-right"></i> <?php echo hari($hr_masuk).", ".formattgl2($tgl_masuk); ?></td></tr>
				<tr><td>Tgl. Dikerjakan</td><td><i class="icon-caret-right"></i> <?php echo $str_tgl_proses; ?></td></tr>
				<tr><td>Tgl. Diselesaikan</td><td><i class="icon-caret-right"></i> <?php echo $str_tgl_selesai; ?></td></tr>
			</table>
			<table class="table table-striped" width="100%">
				<tr class="<?php echo $clr_tr; ?>"><td><i class="icon-list-alt"></i> Data Teknisi</td></tr>
				<?php if($d['status'] == 0){ ?>
				<tr><td><span class="label label-danger">data belum ada.</span></td></tr>
				<?php } else { 
				$q = mysqli_query($conn,"select tb_log_service_teknisi.*, tb_user.* from tb_log_service_teknisi, tb_user where tb_log_service_teknisi.id_teknisi=tb_user.id_teknisi and tb_log_service_teknisi.id_service='".$idsvc."'");
				while($r = mysqli_fetch_array($q)){
				?>
				<tr><td><i class="icon-user"></i> <?php echo $r['nama']; ?></td></tr>
				<?php } } ?>
			</table>
		</div>
	</div>
</div>