<?php
	header('Access-Control-Allow-Origin: *');
	header('Access-Control-Allow-Method: POST');
	header('Access-Control-Allow-Headers: Content-Type');
	header('Content-Type: application/json');
	date_default_timezone_set('Asia/Kuala_Lumpur'); require_once("config.php");

	$data = array(); $tabel = "SELECT * FROM tb_log_service";
	
	$sql = mysqli_query($conn, $tabel);
	while($row = mysqli_fetch_array($sql)){
		$sub_array = array();
		$sub_array[] = $row['no']; //1
		$sub_array[] = $row['id_service']; //2
		$sub_array[] = $row['id_customer']; //3
		$sub_array[] = $row['keluhan']; //4
		$sub_array[] = $row['diagnose']; //5
		$sub_array[] = $row['technician']; //6
		$sub_array[] = $row['tgl_service']; //7
		$sub_array[] = $row['tgl_proses']; //8
		$sub_array[] = $row['tgl_end_service']; //9
		$sub_array[] = $row['status']; //10
		$sub_array[] = $row['status_batal']; //11
		$sub_array[] = $row['status_svc']; //12
		$sub_array[] = $row['point']; //13
		$sub_array[] = $row['id_sales']; //14
		$data[] = $sub_array;
	} echo json_encode($data);
?>