<?php
	header('Access-Control-Allow-Origin: *');
	header('Access-Control-Allow-Method: POST');
	header('Access-Control-Allow-Headers: Content-Type');
	header('Content-Type: application/json');
	date_default_timezone_set('Asia/Kuala_Lumpur'); require_once("config.php");

	$data = array(); $tabel = "SELECT * FROM tb_invoice_beli_detail";
	
	$sql = mysqli_query($conn, $tabel);
	while($row = mysqli_fetch_array($sql)){
		$sub_array = array();
		$sub_array[] = $row['no_ibd']; //1
		$sub_array[] = $row['no_invoice']; //2
		/*$sub_array[] = $row['file_po_ibd']; //3
		$sub_array[] = $row['file_nota_supplier_ibd']; //4
		$sub_array[] = $row['file_nota_ekpedisi_ibd']; //5*/
		$data[] = $sub_array;
	} echo json_encode($data);
?>