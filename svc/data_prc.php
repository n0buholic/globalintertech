<?php
	date_default_timezone_set('Asia/Kuala_Lumpur'); require_once("../setty/config.php"); require_once("../setty/func.php");
	if(isset($_POST['op'])){ $op = $_POST['op'];
		if($op == "detail_inv"){ $inv = $_POST['inv'];
			$q = mysqli_query($conn,"SELECT *, COUNT(*) AS 'ditemukan' FROM tb_log_service WHERE id_service = '$inv' AND status_batal = 0 LIMIT 1"); $d = mysqli_fetch_array($q);
			if($d['ditemukan'] == 0){
				$msg = array("status"=>"reload", "title"=>"error", "text"=>"data tidak ditemukan.", "warna"=>"gritter");		
			} else {
				$data = array(); $data[] = $d['keluhan'];/*0 keluhan*/ $data[] = $d['status'];/*1 sts svc*/ $sub = array();
				if($d['status'] == "2" OR $d['status'] == "3"){
					$sub[] = array("sevice sudah selesai.", date("d/m/Y", strtotime(str_replace("-", "/", $d['tgl_end_service']))));
					$sub[] = array("pengerjaan service.", date("d/m/Y", strtotime(str_replace("-", "/", $d['tgl_proses']))));
					$sub[] = array("service masuk.", date("d/m/Y", strtotime(str_replace("-", "/", $d['tgl_service']))));

				} else if($d['status'] == "1"){
					$sub[] = array("pengerjaan service.", date("d/m/Y", strtotime(str_replace("-", "/", $d['tgl_proses']))));
					$sub[] = array("service masuk.", date("d/m/Y", strtotime(str_replace("-", "/", $d['tgl_service']))));					

				} else if($d['status'] == "0"){
					if($d['tgl_proses'] !== "0000-00-00"){
						$sub[] = array("masuk daftar tunggu dan akan dikerjakan.", "tgl ".date("d/m/Y", strtotime(str_replace("-", "/", $d['tgl_proses'])))); }
					$sub[] = array("service masuk.", "tgl ".date("d/m/Y", strtotime(str_replace("-", "/", $d['tgl_service']))));					

				} $data[] = $sub;
				$msg = array("status"=>"valid", $data);
			} echo json_encode($msg);
		}
	} else { if($_SERVER["SERVER_NAME"] != "localhost"){ header("Location: https://".$_SERVER["SERVER_NAME"]."/svc"); }
		else { header("Location: https://".$_SERVER["SERVER_NAME"]."/global/svc"); } }
?>