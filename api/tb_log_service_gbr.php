<?php
	header('Access-Control-Allow-Origin: *');
	header('Access-Control-Allow-Method: POST');
	header('Access-Control-Allow-Headers: Content-Type');
	header('Content-Type: application/json');
	date_default_timezone_set('Asia/Kuala_Lumpur'); require_once("config.php");

	$data = array(); $tabel = "SELECT * FROM tb_log_service_gbr LIMIT 4201, 672";
	
	$sql = mysqli_query($conn, $tabel);
	while($row = mysqli_fetch_array($sql)){
		$sub_array = array();
		$sub_array[] = $row['no']; //1
		$sub_array[] = $row['id_service']; //2
		$data[] = $sub_array;
	} echo json_encode($data);
?>