<?php
	header('Access-Control-Allow-Origin: *');
	header('Access-Control-Allow-Method: POST');
	header('Access-Control-Allow-Headers: Content-Type');
	header('Content-Type: application/json');
	date_default_timezone_set('Asia/Kuala_Lumpur'); require_once("config.php");

	$data = array(); $tabel = "SELECT * FROM tb_produk";
	
	$sql = mysqli_query($conn, $tabel);
	while($row = mysqli_fetch_array($sql)){
		$sub_array = array();
		$sub_array[] = $row['id_produk']; //1
		$sub_array[] = $row['id_kategori']; //2
		$sub_array[] = $row['produk']; //3
		$sub_array[] = $row['sku']; //4
		$sub_array[] = $row['unit']; //5
		$sub_array[] = $row['jual']; //6
		$sub_array[] = $row['beli']; //7
		$sub_array[] = $row['desk']; //8
		$sub_array[] = $row['snkode']; //9
		$sub_array[] = $row['prioritas_tp']; //10
		$data[] = $sub_array;
	} echo json_encode($data);
?>