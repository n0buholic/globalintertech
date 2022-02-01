<?php
	session_start(); date_default_timezone_set('Asia/Kuala_Lumpur'); require_once("config.php"); require_once("func.php");
	
	if(isset($_POST['name'])=="qtyout"){
		$id = $_POST['pk']; $qtyout = $_POST['value'];
		$q = mysqli_query($conn,"select tb_stok_in.*, tb_produk.*, sum(tb_stok_in.qty)as total from tb_stok_in, tb_produk where tb_stok_in.id_produk=tb_produk.id_produk and tb_produk.id_produk='$id'"); $d = mysqli_fetch_array($q);
		$sisa = $d['total'] - $qtyout;
		if($sisa > 0){
			if(isset($_SESSION['items'])){
				$_SESSION['items'][$id] = $qtyout;
			} else {
				echo "Terjadi kesalahan system.";
			}
		} else {
			echo "Qty tidak mencukupi";
		}
	}
?>