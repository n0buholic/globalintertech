<?php
	session_start(); header("Content-type: image/png");
	$_SESSION['captcha'] = "";
	$gbr = imagecreate(125, 50);
	imagecolorallocate($gbr, 190, 190, 190);
	$color = imagecolorallocate($gbr, 255, 255, 255);
	$font = "EARWIG_FACTORY_REGULAR.TTF"; 
	$ukuran_font = 30;
	$posisi = 35;
	for($i=0;$i<=5;$i++) {
		$angka = rand(0, 9); $_SESSION['captcha'] .= $angka; $kemiringan= rand(10, 10);
		imagettftext($gbr, $ukuran_font, $kemiringan, 8+17*$i, $posisi, $color, $font, $angka);
	}
	setcookie('captcha_garansi', $_SESSION['captcha'], time()+(60*60), '/'); unset($_SESSION['captcha']);
	imagepng($gbr); 
	imagedestroy($gbr);
?>