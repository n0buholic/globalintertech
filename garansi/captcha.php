<?php	

	$gbr = imagecreate(125, 50);
	imagecolorallocate($gbr, 190, 190, 190);
	$color = imagecolorallocate($gbr, 255, 255, 255);
	
	$font = "EARWIG_FACTORY_REGULAR.TTF"; 

	$ukuran_font = 30; $posisi = 35; $angka_cookie = "";
	
	for($i=0;$i<=5;$i++) {
		$angka = rand(0, 9); $angka_cookie .= $angka; $kemiringan= rand(10, 10);
		imagettftext($gbr, $ukuran_font, $kemiringan, 8+17*$i, $posisi, $color, $font, $angka);
	}
	
	setcookie('captcha_garansi', $angka_cookie, time()+(60*60), '/');

	header("Content-type: image/png"); imagejpeg($gbr); imagedestroy($gbr);
	
?>