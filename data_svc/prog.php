<?php
	date_default_timezone_set('Asia/Kuala_Lumpur'); require_once("../setty/config.php");
	require_once("../admgolax/function.php");
	$op = $_POST['op']; $thn_now = date("Y"); $tgl_now = date("Y-m-d");
	if($op == "dt_trigger"){ $sub = $_POST['sub'];
		if($sub == "alamat"){ $hp = $_POST['hp'];
			echo "<option value=''>--Pilih Alamat--</option>";
			$q = mysqli_query($conn,"select * from tb_customer where kontak='".$hp."'");
			while($r = mysqli_fetch_array($q)){
				echo "<option value='".$r['id_customer']."'>".$r['alamat']."</option>";
			}
		}
	}
?>