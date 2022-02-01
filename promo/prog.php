<?php
	date_default_timezone_set('Asia/Kuala_Lumpur'); require_once("../setty/config.php");
	require_once("../admgolax/function.php"); require('../admgolax/phpmailer/classes/class.phpmailer.php');
	$op = $_POST['op']; $thn_now = date("Y"); $tgl_now = date("Y-m-d");
	if($op == "sv_daftar_promo"){
		$nama = $_POST['nama']; $hp = $_POST['hp']; $email = $_POST['email']; $error = 0; $msg = "";
		$q = mysqli_query($conn,"select * from tb_promo order by no_pro desc"); $d = mysqli_fetch_array($q);		
		$q4 = mysqli_query($conn,"select * from tb_customer_promo where id_pro='".$d['id_pro']."' and hp_cp='".$hp."' LIMIT 1"); $row4 = mysqli_num_rows($q4);		
		if($row4 == 0){ $limit = $d['limit_pro'];
			$q3 = mysqli_query($conn,"select * from tb_customer_promo where id_pro='".$d['id_pro']."'");
			$row3 = mysqli_num_rows($q3) + 1;
			if($row3 <= $limit){
				if(karakter_nama($nama) == "invalid"){
					$error += 1; $msg .= "<i class='icon-remove'></i> Nama: tidak boleh menggunakan symbol.<hr />";
				}
				if(karakter_angka($hp) == "invalid"){
					$error += 1; $msg .= "<i class='icon-remove'></i> Nama: tidak boleh menggunakan symbol.<hr />";
				}
				if($email != ""){
					if(filter_var($email, FILTER_VALIDATE_EMAIL)){
						if(karakter_email($email) == "invalid"){
							$error += 1; $msg .= "<i class='icon-remove'></i> Email: tidak boleh menggunakan symbol.<hr />";
						}
					} else {
						$error += 1; $msg .= "<i class='icon-remove'></i> Email: penulisan salah.<hr />";
					}
				}
				if($error == 0){
					$q2 = mysqli_query($conn,"select *, count(*)as baris from tb_counter where year(tgl)='$thn_now' and keterangan='cus_promo' LIMIT 1"); $d2 = mysqli_fetch_array($q2);
					if($d2['baris'] == 0){
						$count = 1; mysqli_query($conn,"insert into tb_counter values(null,'$tgl_now','$count','cus_promo')");
					} else {
						$count = $d2['counter'] + 1;
						mysqli_query($conn,"update tb_counter set counter='$count' where year(tgl)='$thn_now' and keterangan='cus_promo' LIMIT 1");
					}				
					if($count < 10){ $idcp = "CP".date("ym")."000".$count; } else
					if($count < 100){ $idcp = "CP".date("ym")."00".$count; } else
					if($count < 1000){ $idcp = "CP".date("ym")."0".$count; } else
					if($count < 10000){ $idcp = "CP".date("ym").$count; }
					$sv = mysqli_query($conn,"insert into tb_customer_promo values(null,'$idcp','$nama','$hp','$email','$d[id_pro]','$tgl_now','0')");
					if($sv){
						if($email != ""){
							if($_SERVER["SERVER_NAME"] != "localhost"){
								$mail = new PHPMailer; 
								$mail->IsSMTP();
								$mail->SMTPSecure = 'ssl'; 
								$mail->Host = "globalintertech.co.id";
								$mail->SMTPDebug = 0;
								$mail->Port = 465;
								$mail->SMTPAuth = true;
								$mail->Username = "admin@globalintertech.co.id";
								$mail->Password = "nakata123";
								$mail->Mailer = "smtp";
								$mail->SetFrom("admin@globalintertech.co.id","Global Intertech");
								$mail->Subject = $idcp;
								$mail->AddAddress($email, $nama);
								$mail->MsgHTML("<center>Selamat! Anda Berhasil Klaim Promo</center><br /><br />Tgl . Klaim: ".formattgl($tgl_now)."<br />ID Promo: <b>".$d['id_pro']."</b><br />Nama: ".$nama."<br /><br />Tunggu, pihak kami akan segara mengkonfirmasi anda lewat No. HP/Telp <b>".$hp.".</b><br /><br />Jangan lupa kunjungi terus <a href='www.globalintertech.co.id'>www.globalintertech.co.id</a> dan temukan promo menarik lainnya.<br /><br /><i>sumber <b>Global Intertech</b></i>");
								$mail->IsHTML(true);
								if($mail->Send()){ 
									echo "oke|<div class='alert alert-info text-center'><h3>Selamat, anda berhasil mengklaim promo...</h3></div>";
								} else { echo "error|Terjadi kesalahan system."; }
							} else {
								echo "oke|<div class='alert alert-info text-center'><h3>Selamat, anda berhasil mengklaim promo...</h3></div>";
							}
						} else {
							echo "oke|<div class='alert alert-info text-center'><h3>Selamat, anda berhasil mengklaim promo...</h3></div>";
						}
					} else { echo "error|<div class='alert alert-danger alert-dismissable'><button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button><p>Terjadi kesalahan system.</p></div>"; }
				} else {
					echo "error|<div class='alert alert-danger alert-dismissable'><button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button><p>".substr($msg,0,-6)."</p></div>";
				}
			} else { echo "error|<div class='alert alert-danger alert-dismissable'><button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button><p>Maaf, promo tidak bisa diklaim lagi.</p></div>"; }
		} else {
			echo "error|<div class='alert alert-danger alert-dismissable'><button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button><p>Maaf, No. HP sudah terdaftar.</p></div>";
		}
	}
?>