<?php
	session_start(); date_default_timezone_set('Asia/Kuala_Lumpur'); require_once("config.php"); require_once("func.php");
	$op = $_GET['op'];	
	if(isset($op)){
		if($op == "reset_data_beli"){
			unset($_SESSION['items']);
			echo "Semua data beli berhasil dibersihkan.";
		} else
		if($op == "delwo"){
			$idsvc = $_GET['idsvc'];
			unlink("../user/".$idsvc.".pdf");
		} else
		if($op == "del_item"){
			$produk = $_GET['id'];
			unset($_SESSION['items'][$produk]);
			echo "Item berhasil dihapus...";
		} else
		if($op == "add_cart"){
			$produk = $_GET['id'];
			if(!isset($_SESSION['items'][$produk])){
				$_SESSION['items'][$produk] = 1;
				echo "Produk berhasil ditambahkan 1 qty.";
			} else {
				$hasil = $_SESSION['items'][$produk] + 1;
				$_SESSION['items'][$produk] = $hasil;
				echo "Qty ditambah 1 untuk produk ID ".$produk;
			}
		} else
		if($op == "sts_cart"){
			if(isset($_SESSION['items'])){
				$hasil = 0;
				foreach ($_SESSION['items'] as $id => $val) {
					$q = mysqli_query($conn,"select * from tb_produk where id_produk='$id'");
					$d = mysqli_fetch_array($q);
					$hasil += $d['jual'] * $val;
				}
				echo "<i class='fa fa-shopping-cart'></i> Rp. ".number_format($hasil,0,',','.');
			} else {
				echo "<i class='fa fa-shopping-cart'></i> Rp. -";
			}
		}
	} else {
		header("Location: ./");
	}
?>