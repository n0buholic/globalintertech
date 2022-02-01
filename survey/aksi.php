<?php
	date_default_timezone_set('Asia/Kuala_Lumpur'); require_once("../setty/config.php"); require_once("../setty/function.php"); $op = $_POST['op'];
	if($op == "sv_data"){ $error = 0; $msg = ""; $IdSvc = $_POST['IdSvc']; $Status = $_POST['Status'];
		$Kritik = $_POST['Kritik'];
		if(karakter($Kritik) == "invalid"){
			$error += 1; $msg .= "Penulisan karakter salah.";
		}
		if($error == 0){
			$sv = mysqli_query($conn,"insert into tb_keritik_saran_service values(null,'".$Kritik."','".$Status."','".date("Y-m-d H:i:s")."','".$IdSvc."')");
			if($sv){
				$json = array("Status" => "oke", "Info" => "<div class='alert alert-success text-center'><h4>Terimakasih...</4></div>");
			} else {
				$json = array("Status" => "error", "Info" => "<div class='alert alert-danger alert-dismissable'><button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button><p>Terjadi kesalahan system.</p></div>");
			}
		} else {
			$json = array("Status" => "error", "Info" => "<div class='alert alert-danger alert-dismissable'><button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button><p>".substr($msg,0,-6)."</p></div>");
		} echo json_encode($json);
	}
?>