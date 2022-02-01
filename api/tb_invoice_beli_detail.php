<?php
	header('Access-Control-Allow-Origin: *');
	header('Access-Control-Allow-Method: POST');
	header('Access-Control-Allow-Headers: Content-Type');
	header('Content-Type: application/json');
	date_default_timezone_set('Asia/Kuala_Lumpur'); require_once("config.php");

	$data = array(); $tabel = "SELECT * FROM tb_invoice_beli_detail LIMIT 100, 100";
	
	$sql = mysqli_query($conn, $tabel);
	while($row = mysqli_fetch_array($sql)){
		$sub_array = array();
		$sub_array[] = $row['no_ibd']; //1
		$sub_array[] = $row['no_invoice']; //2
		
		if($row['file_po_ibd'] !== "") { $po = "1"; } else { $po = "0"; }
		$sub_array[] = $po; //3
		
		if($row['file_nota_supplier_ibd'] !== "") { $supp = "1"; } else { $supp = "0"; }
		$sub_array[] = $supp; //4
		
		if($row['file_nota_ekpedisi_ibd'] !== "") { $ekpe = "1"; } else { $ekpe = "0"; }
		$sub_array[] = $ekpe; //5
		
		$data[] = $sub_array;
	} echo json_encode($data);
?>