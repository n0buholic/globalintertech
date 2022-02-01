<?php
	date_default_timezone_set('Asia/Kuala_Lumpur'); require_once("../../setty/config.php"); require_once("../../setty/func.php");
	$Op = $_POST['Op'];
	if($Op == "TambahProdukView"){ $IdProduk = $_POST['IdProduk']; $Qty = $_POST['Qty'];

		$QStok = mysqli_query($conn,"select *, sum(qty) as 'Stok' from tb_stok_in where id_produk='".$IdProduk."'");
		$DStok = mysqli_fetch_array($QStok);

		if($Qty > $DStok['Stok']){
			$Json = array("Status" => "limit", "Stok" => $DStok['Stok']);
		} else {
			$QtyCart = 0; $TotalQty = 0;
			$q = mysqli_query($conn,"select * from tb_produk");
			while($r = mysqli_fetch_array($q)){
				if($r['id_produk'] == $IdProduk){
					if(isset($_COOKIE[$IdProduk])){ 
						$QtyCart += $_COOKIE[$IdProduk]; $TotalQty += $Qty;
					}
				} else {
					if(isset($_COOKIE[$r['id_produk']])){ $TotalQty += $_COOKIE[$r['id_produk']]; }
				}
			}

			if($QtyCart > 0){ setcookie($IdProduk, $Qty, time()+(60*60*24), '/'); }

			$Json = array("Status" => "ready", "Stok" => $DStok['Stok'], "QtyCart" => $QtyCart, "TotalQty" => $TotalQty);
		}

		echo json_encode($Json);
	} else
	if($Op == "TambahQtyCart"){ $IdProduk = $_POST['IdProduk']; $Qty = $_POST['Qty'];

		$QStok = mysqli_query($conn,"select *, sum(qty) as 'Stok' from tb_stok_in where id_produk='".$IdProduk."'");
		$DStok = mysqli_fetch_array($QStok);

		if($Qty > $DStok['Stok']){			
			$Json = array("Status" => "limit", "Stok" => $DStok['Stok']);
		} else {
			setcookie($IdProduk, $Qty, time()+(60*60*24), '/');

			$TotalQty = 0; $TotalQty += $Qty;
			$q = mysqli_query($conn,"select * from tb_produk");
			while($r = mysqli_fetch_array($q)){
				if($IdProduk != $r['id_produk']){
					if(isset($_COOKIE[$r['id_produk']])){
						$TotalQty += $_COOKIE[$r['id_produk']];
					}
				}
			}			

			$QProduk = mysqli_query($conn,"select * from tb_produk where id_produk='".$IdProduk."' LIMIT 1");
			$DProduk = mysqli_fetch_array($QProduk);			
			$Total = $Qty * $DProduk['jual'];

			$Json = array("Status" => "ready", "Stok" => $DStok['Stok'], "Total" => number_format($Total, 0, '', '.'), "Total1" => $Total, "TotalQty" => $TotalQty);
		}

		echo json_encode($Json);
	} else
	if($Op == "HapusProdukCheckOut"){ $IdProduk = $_POST['IdProduk']; $TotalQty = 0;
		setcookie($IdProduk, '', 0, '/');

		$q = mysqli_query($conn,"select * from tb_produk order by id_produk asc");
		while($r = mysqli_fetch_array($q)){
			if($r['id_produk'] != $IdProduk){
				if(isset($_COOKIE[$r['id_produk']])){
					$TotalQty += $_COOKIE[$r['id_produk']];
				}
			}
		}

		$Json = array("Title" => "<i class='fa fa-ok'></i> Sukses", "Text" => "Item produk dihapus...", "Gritter" => "gritter-hijau", "TotalQty" => $TotalQty);
		
		echo json_encode($Json);
	} else
	if($Op == "DataChekOut"){ $JsonData = array();
		$q = mysqli_query($conn,"select * from tb_produk order by id_produk asc");
		while($r = mysqli_fetch_array($q)){
			if(isset($_COOKIE[$r['id_produk']])){
				$JsonDataSub = array();

				$q1 = mysqli_query($conn,"select *, count(*) as 'RowFoto' from tb_produk_img where id_produk='".$r['id_produk']."' order by no asc LIMIT 1"); $d1 = mysqli_fetch_array($q1);
				if($d1['RowFoto'] > 0){ $Src = str_replace("_", "/", $d1['link']); }
				else { $Link = "../images/noimg.png"; $Src = encode_base64($Link); }
				
				$JsonDataSub[] = $Src; //0
				$JsonDataSub[] = $r['produk']; //1
				$JsonDataSub[] = number_format($r['jual'], 0, '', '.'); //2
				$JsonDataSub[] = $_COOKIE[$r['id_produk']]; //3

				$Total = $_COOKIE[$r['id_produk']] * $r['jual'];
				$JsonDataSub[] = number_format($Total, 0, '', '.'); //5

				$JsonDataSub[] = $r['id_produk']; //5
				$JsonDataSub[] = $Total; //6
				$JsonData[] = $JsonDataSub;
			}
		} echo json_encode($JsonData);
	} else
	if($Op == "ListMenu"){ $DataJson = array();
		$q = mysqli_query($conn,"select * from tb_produk_kategori order by nama asc");
		while($r = mysqli_fetch_array($q)){
			$qRow = mysqli_query($conn,"select * from tb_produk where id_kategori='".$r['id_kategori']."'");
			$dRow = mysqli_num_rows($qRow);

			if($dRow > 0){
				$DataSub = array();
				$DataSub[] = $r['id_kategori'];
				$DataSub[] = $r['nama'];
				$DataJson[] = $DataSub;
			}

		}
		echo json_encode($DataJson);
	} else
	if($Op == "DataProdukUtama"){ $DataJson = array(); $Start = $_POST['Start'];

		$q3 = mysqli_query($conn,"select *, count(id_produk) as 'TotalProduk' from tb_produk where prioritas_tp=1");
		$d3 = mysqli_fetch_array($q3); $TotalStart = ($Start + 1) * 6; $TotalLimit = $Start * 6;
		if($d3['TotalProduk'] > $TotalStart){ $Status = 'lanjut'; } else { $Status = 'limit'; }

		$q = mysqli_query($conn,"select * from tb_produk where prioritas_tp=1 order by produk asc limit ".$TotalLimit.", 6");
		while ($r = mysqli_fetch_array($q)){
			$DataSub = array();

			if(strlen($r['produk']) > 15){ $Produk = substr($r['produk'], 0, 15)."..."; } else { $Produk = $r['produk']; }
			$DataSub[] = $Produk;

			$DataSub[] = number_format($r['jual'], 0, '', '.');

			$q1 = mysqli_query($conn,"select *, count(*)as 'BarisFoto' from tb_produk_img where id_produk='".$r['id_produk']."' order by no asc LIMIT 1"); $d1 = mysqli_fetch_array($q1);

			if($d1['BarisFoto'] > 0){
				$src = str_replace("_", "/", $d1['link']);
			} else {
				$link = "../images/noimg.png"; $src = encode_base64($link);
			}
			$DataSub[] = $src;

			$q2 = mysqli_query($conn,"select *, sum(qty) as 'Stok' from tb_stok_in where id_produk='".$r['id_produk']."'");
			$d2 = mysqli_fetch_array($q2);			
			$DataSub[] = $d2['Stok'];

			$DataSub[] = $r['id_produk'];
			$DataJson[] = $DataSub;
		}

		$Json = array("Status" => $Status, "DataProduk" => $DataJson, "Start" => $Start);

		echo json_encode($Json);
	} else
	if($Op == "DataProdukFilter"){ $DataJson = array(); $IdKategori = $_POST['IdKategori']; $Start = $_POST['Start'];

		$q3 = mysqli_query($conn,"select *, count(id_produk) as 'TotalProduk' from tb_produk where id_kategori='".$IdKategori."'");
		$d3 = mysqli_fetch_array($q3); $TotalStart = ($Start + 1) * 6; $TotalLimit = $Start * 6;
		if($d3['TotalProduk'] > $TotalStart){ $Status = 'lanjut'; } else { $Status = 'limit'; }

		$q = mysqli_query($conn,"select * from tb_produk where id_kategori='".$IdKategori."' order by produk asc limit ".$TotalLimit.", 6");
		while ($r = mysqli_fetch_array($q)){
			$DataSub = array();

			if(strlen($r['produk']) > 15){ $Produk = substr($r['produk'], 0, 15)."..."; } else { $Produk = $r['produk']; }
			$DataSub[] = $Produk;

			$DataSub[] = number_format($r['jual'], 0, '', '.');

			$q1 = mysqli_query($conn,"select *, count(*)as 'BarisFoto' from tb_produk_img where id_produk='".$r['id_produk']."' order by no asc LIMIT 1"); $d1 = mysqli_fetch_array($q1);

			if($d1['BarisFoto'] > 0){
				$src = str_replace("_", "/", $d1['link']);
			} else {
				$link = "../images/noimg.png"; $src = encode_base64($link);
			}
			$DataSub[] = $src;

			$q2 = mysqli_query($conn,"select *, sum(qty) as 'Stok' from tb_stok_in where id_produk='".$r['id_produk']."'");
			$d2 = mysqli_fetch_array($q2);			
			$DataSub[] = $d2['Stok'];

			$DataSub[] = $r['id_produk'];
			$DataJson[] = $DataSub;
		}

		$Json = array("Status" => $Status, "DataProduk" => $DataJson, "Start" => $Start);

		echo json_encode($Json);
	} else
	if($Op == "TriggerData"){ $Sub = $_POST['Sub'];
		if($Sub == "DataSlider"){ $JsonData = array();
			$q = mysqli_query($conn,"select * from tb_produk_slider order by no_ps asc");
			while($r = mysqli_fetch_array($q)){
				$JsonDataSub = array();
				$JsonDataSub[] = $r['caption_ps'];
				$JsonDataSub[] = $r['keterangan_ps'];
				$JsonDataSub[] = str_replace("_", "/", $r['link_ps']);
				$JsonData[] = $JsonDataSub;
			} echo json_encode($JsonData);
		} else
		if($Sub == "DataPerProduk"){ $IdProduk = $_POST['IdProduk'];
			$q = mysqli_query($conn,"select tb_produk.*, tb_produk_kategori.* from tb_produk, tb_produk_kategori where tb_produk_kategori.id_kategori=tb_produk.id_kategori and id_produk='".$IdProduk."' LIMIT 1"); $d = mysqli_fetch_array($q);

			$qImg = mysqli_query($conn,"select * from tb_produk_img where id_produk='".$IdProduk."' LIMIT 1");
			$RowImg = mysqli_num_rows($qImg); $JsonFoto = array();			
			if($RowImg == 0){				
				for($i = 0; $i <= 3; $i++){
					$JsonFotoSub = array();
					$Foto = "../images/noimg.png"; $Src = encode_base64($Foto);
					$JsonFotoSub[] = $Src;
					$JsonFoto[] = $JsonFotoSub;
				}
			} else {
				if($RowImg > 1){
					$q = mysqli_query($conn,"select * from tb_produk_img where id_produk='".$IdProduk."' order by no asc LIMIT 4");
					while($r = mysqli_fetch_array($q)){
						$JsonFotoSub = array();
						$JsonFotoSub[] = str_replace("_", "/", $r['link']);
						$JsonFoto[] = $JsonFotoSub;
					}
				} else {
					$q1 = mysqli_query($conn,"select * from tb_produk_img where id_produk='".$IdProduk."' order by no asc");
					$d1 = mysqli_fetch_array($q1);					
					for($i = 0; $i <= 3; $i++){
						$JsonFotoSub = array();
						if($i == 0){ $JsonFotoSub[] = str_replace("_", "/", $d1['link']); }
						$Foto = "../images/noimg.png"; $Src = encode_base64($Foto);
						$JsonFotoSub[] = $Src;	
						$JsonFoto[] = $JsonFotoSub;	
					}
				}
			}

			$QStok = mysqli_query($conn,"select *, sum(qty) as 'Stok' from tb_stok_in where id_produk='".$IdProduk."'");
			$DStok = mysqli_fetch_array($QStok);

			$QtyCart = 0;
			$QProduk = mysqli_query($conn,"select * from tb_produk");
			while($r = mysqli_fetch_array($QProduk)){
				if($r['id_produk'] == $IdProduk){
					if(isset($_COOKIE[$r['id_produk']])){ $QtyCart += $_COOKIE[$IdProduk]; }
				}
			}

			$Json = array("Produk" => $d['produk'], "HargaJual" => number_format($d['jual'], 0, '', '.'), "Kategori" => $d['nama'], "Deskripsi" => $d['desk'], "Foto" => $JsonFoto, "Stok" => $DStok['Stok'], "QtyCart" => $QtyCart);

			echo json_encode($Json);
		}
	} else
	if($Op == "AddToCart"){ $IdProduk = $_POST['IdProduk']; $Stok = $_POST['Stok']; $Qty = $_POST['Qty'];
		if($Qty > 0){
			if($Qty <= $Stok){			

				$TotalQty = 0; $TotalQty += $Qty;

				$q = mysqli_query($conn,"select * from tb_produk");
				while($r = mysqli_fetch_array($q)){
					if($r['id_produk'] != $IdProduk){
						if(isset($_COOKIE[$r['id_produk']])){
							$TotalQty += $_COOKIE[$r['id_produk']];
						}
					}
				}

				setcookie($IdProduk, $Qty, time()+(60*60*24), '/');

				$Json = array("Status" => "oke", "Title" => "<i class='fa fa-ok'></i> Sukses", "Text" => "Produk berhasil ditambahkan...", "Gritter" => "gritter-hijau", "TotalQty" => $TotalQty);
			} else {
				$Json = array("Status" => "error", "Title" => "<i class='fa fa-info'></i> Pemberitahaun", "Text" => "Qty tidak mencukupi.", "Gritter" => "gritter");
			}
		} else {
			$Json = array("Status" => "error", "Title" => "<i class='fa fa-info'></i> Pemberitahaun", "Text" => "Qty harus lebih dari 0.", "Gritter" => "gritter");
		} echo json_encode($Json);
	}
?>