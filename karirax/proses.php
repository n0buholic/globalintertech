<?php
	require_once("../setty/config.php");
	$op = $_GET['op'];
	if($op == "sv_daftar_palamar"){
		if((isset($_GET['nama'])) AND (isset($_GET['kontak'])) AND (isset($_GET['email']))){
			$tgl = date("Y-m-d");
			function acak($panjang){
				$karakter = '0987654321';
				$string = '';
				for ($i = 0; $i < $panjang; $i++){
					$pos = rand(0, strlen($karakter)-1);
					$string .= $karakter{$pos};
				}
				return $string;
			}
			$id = acak(8);
			$nama = $_GET['nama'];
			$kontak = $_GET['kontak'];
			$email = $_GET['email'];
			$job = $_GET['job'];
			$que1 = mysqli_query($conn,"select * from tb_job where nama='$nama' or kontak='$kontak' or email='$email'");
			$cek = mysqli_num_rows($que1);
			if($cek == 0){
				$que = mysqli_query($conn,"insert into tb_job values('$id','$nama','$kontak','$email','$tgl','$job')");
				if($que){
					echo "oke";
				} else {
					echo "Data gagal diproses!!!";
				}
			} else {
				echo "ada";
			}
		} else {
			header("location: ./");
		}	
	}
?>