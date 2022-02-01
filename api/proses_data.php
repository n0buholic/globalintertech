<?php
	header('Access-Control-Allow-Origin: *');
	header('Access-Control-Allow-Method: POST');
	header('Access-Control-Allow-Headers: Content-Type');
	header('Content-Type: application/json');
	require_once("config.php"); $op = $_POST['op'];

	if($op == "ambilFileInvBeliGit"){ $invo = $_POST['invo']; $unduh = $_POST['unduh'];

		$q = mysqli_query($conn,"SELECT * FROM tb_invoice_beli_detail WHERE no_invoice = '$invo' LIMIT 1");
		$d = mysqli_fetch_array($q);

		if($unduh == "po"){ $file = $d['file_po_ibd']; } else
		if($unduh == "supp"){ $file = $d['file_nota_supplier_ibd']; } else
		if($unduh == "ekpe"){ $file = $d['file_nota_ekpedisi_ibd']; } else { $file = ""; }

		$data = array($file); echo json_encode($data);

	}
?>