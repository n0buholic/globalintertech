<?php
require_once("../setty/config.php"); require_once("../setty/func.php"); $requested_page = $_POST['page_num']; $set_limit = (($requested_page - 1) * 1).",1";
$result = mysqli_query($conn,"select * from tb_event group by id_event order by tgl desc limit $set_limit");
while ($r = mysqli_fetch_array($result)) {
	$arr = explode(" ", $r['tgl']);
		if($arr[0] == date("Y-m-d")){
			$tgl = "baru";
		} else {
			$tgl = $arr[0];
		}
		$q1 = mysqli_query($conn,"select *, count(*)as total from tb_event where id_event='$r[id_event]'");
		$d1 = mysqli_fetch_array($q1);
		$q2 = mysqli_query($conn,"select * from tb_user where id_teknisi='$r[id_user]'");
		$d2 = mysqli_fetch_array($q2);
		echo "<div class='col-md-4'>
				<div class='alert alert-success byngan'>
					<div class='icon-galery'><img src='".str_replace("_","/",$r['link'])."' style='cursor:pointer;' onClick = 'view_foto($r[id_event])' /></div>
					<div class='judul-galery'>$r[keterangan]<div class='total-foto'> $d1[total] Foto</div></div>
					<div class='tgl-galery'>Posting: $tgl oleh <b>".ucwords($d2['nama'])."</b></div>
				</div>
			</div>";
} exit; ?>