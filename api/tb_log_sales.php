<?php
	header('Access-Control-Allow-Origin: *');
	header('Access-Control-Allow-Method: POST');
	header('Access-Control-Allow-Headers: Content-Type');
	header('Content-Type: application/json');
	date_default_timezone_set('Asia/Kuala_Lumpur'); require_once("config.php");

	$data = array(); $tabel = "SELECT * FROM tb_log_sales";
	
	$sql = mysqli_query($conn, $tabel);
	while($row = mysqli_fetch_array($sql)){
		$sub_array = array();
		$sub_array[] = $row['id_sales']; //1
		$sub_array[] = $row['id_kegiatan']; //2
		$sub_array[] = $row['id_cus']; //3
		$sub_array[] = $row['kegiatan']; //4
		$sub_array[] = $row['tgl_waktu']; //5
		$sub_array[] = $row['sts']; //6
		$data[] = $sub_array;
	} echo json_encode($data);
?>