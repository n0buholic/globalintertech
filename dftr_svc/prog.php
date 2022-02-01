<?php
	date_default_timezone_set('Asia/Kuala_Lumpur'); require_once("../setty/config.php");
	require_once("../admgolax/function.php"); require('../admgolax/phpmailer/classes/class.phpmailer.php');
	$op = $_POST['op']; $thn_now = date("Y"); $tgl_now = date("Y-m-d");
	if($op == "sv_email_sv_svc_baru"){ $error = 0; $msg = ""; $hp = $_POST['hp']; $keluhan = $_POST['keluhan'];
		$email = $_POST['email_null'];
		if($email != ""){
			if(filter_var($email, FILTER_VALIDATE_EMAIL)){
				if(karakter_email($email) == "invalid"){
					$error += 1; $msg .= "<i class='icon-remove'></i> Email: tidak boleh menggunakan symbol.<hr />";
				} else {
					mysqli_query($conn,"update tb_customer set email='".$email."' where kontak='".$hp."' LIMIT 1");
				}
			} else {
				$error += 1; $msg .= "<i class='icon-remove'></i> Email: penulisan salah.<hr />";
			}
		}
		if($error == 0){
			$qc = mysqli_query($conn,"select *, count(*)as baris from tb_counter where year(tgl)='".$thn_now."' and keterangan='service' LIMIT 1"); $dc = mysqli_fetch_array($qc);
			if($dc['baris'] == 0){ 
				$tambah = 1; mysqli_query($conn,"insert into tb_counter values(null,'".$tgl_now."','".$tambah."','service')");
			} else {
				$tambah = $dc['counter'] + 1; mysqli_query($conn,"update tb_counter set counter='".$tambah."' where year(tgl)='".$thn_now."' and keterangan='service' LIMIT 1");
			}
			if($tambah < 10){ $idsvc = "SVC".date("my")."000".$tambah; } else
			if($tambah < 100){ $idsvc = "SVC".date("my")."00".$tambah; } else
			if($tambah < 1000){	$idsvc = "SVC".date("my")."0".$tambah; } else
			if($tambah < 10000){ $idsvc = "SVC".date("my").$tambah; }
			$qcus = mysqli_query($conn,"select * from tb_customer where kontak='".$hp."' LIMIT 1");
			$dcus = mysqli_fetch_array($qcus);
			$svsvc = mysqli_query($conn,"insert into tb_log_service values(null,'$idsvc','$dcus[id_customer]','$keluhan','','','$tgl_now','0000-00-00','0000-00-00','0','0','0','1','')");
			if($svsvc){
				$svsvca = mysqli_query($conn,"insert into tb_analisis_service values(null,'$idsvc','0','$tgl_now','0','0')");
				if($svsvca){ 
					if($dcus['email'] != ""){
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
							$mail->SetFrom("admin@globalintertech.co.id","CS Service");
							$mail->Subject = $idsvc;
							$mail->AddAddress($dcus['email'], $dcus['nama']);
							$mail->MsgHTML("Tanggal: ".formattgl($tgl_now)."<br />Status : Terdaftar<br />No. HP : ".$hp."<hr />Untuk info service selengkapnya, anda bisa klik link dibawah ini<br /><br /><a href='https://globalintertech.co.id/data_svc'>wwww.globalintertech.co.id/data_svc</a><br /><br /><i>sumber dari <b>Global Intertech</b></i>");
							$mail->IsHTML(true);
							if($mail->Send()){ echo "oke"; }
							else { echo "error|Terjadi kesalahan system."; }
						} else { echo "oke"; }
					} else { echo "oke"; }						
				} else { echo "error|Terjadi kesalahan system."; }
			} else { echo "error|Terjadi kesalahan system."; }
		} else {
			echo "error|<div class='alert alert-danger alert-dismissable'><button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button><p>".substr($msg,0,-6)."</p></div>";
		}
	} else	
	if($op == "dt_trigger"){ $sub = $_POST['sub'];
		if($sub == "alamat"){ $hp = $_POST['hp'];
			echo "<option value=''>--Pilih Alamat--</option>";
			$q = mysqli_query($conn,"select * from tb_customer where kontak='".$hp."'");
			while($r = mysqli_fetch_array($q)){
				echo "<option value='".$r['id_customer']."'>".$r['alamat']."</option>";
			}
		} else 
		if($sub == "cek_email"){ $idcus = $_POST['idcus'];
			$q = mysqli_query($conn,"select * from tb_customer where id_customer='".$idcus."' LIMIT 1");
			$d = mysqli_fetch_array($q); echo $d['email'];
		}
	} else	
	if($op == "sv_service_baru_form_3"){ $error = 0; $msg =""; $hp = $_POST['hp']; $idcus = $_POST['plh_type'];
		$keluhan = $_POST['keluhan']; $email = $_POST['email_null'];
		if($email != ""){
			if(filter_var($email, FILTER_VALIDATE_EMAIL)){
				if(karakter_email($email) == "invalid"){
					$error += 1; $msg .= "<i class='icon-remove'></i> Email: tidak boleh menggunakan symbol.<hr />";
				} else {
					mysqli_query($conn,"update tb_customer set email='".$email."' where id_customer='".$idcus."' LIMIT 1");
				}
			} else {
				$error += 1; $msg .= "<i class='icon-remove'></i> Email: penulisan salah.<hr />";
			}
		}
		if($error == 0){
			$qc = mysqli_query($conn,"select *, count(*)as baris from tb_counter where year(tgl)='".$thn_now."' and keterangan='service' LIMIT 1"); $dc = mysqli_fetch_array($qc);
			if($dc['baris'] == 0){ 
				$tambah = 1; mysqli_query($conn,"insert into tb_counter values(null,'".$tgl_now."','".$tambah."','service')");
			} else {
				$tambah = $dc['counter'] + 1; mysqli_query($conn,"update tb_counter set counter='".$tambah."' where year(tgl)='".$thn_now."' and keterangan='service' LIMIT 1");
			}
			if($tambah < 10){ $idsvc = "SVC".date("my")."000".$tambah; } else
			if($tambah < 100){ $idsvc = "SVC".date("my")."00".$tambah; } else
			if($tambah < 1000){	$idsvc = "SVC".date("my")."0".$tambah; } else
			if($tambah < 10000){ $idsvc = "SVC".date("my").$tambah;	}
			$q = mysqli_query($conn,"select * from tb_customer where id_customer='".$idcus."' LIMIT 1");
			$d = mysqli_fetch_array($q);
			$svsvc = mysqli_query($conn,"insert into tb_log_service values(null,'$idsvc','$idcus','$keluhan','','','$tgl_now','0000-00-00','0000-00-00','0','0','0','1','')");
			if($svsvc){
				$svsvca = mysqli_query($conn,"insert into tb_analisis_service values(null,'$idsvc','0','$tgl_now','0','0')");
				if($svsvca){ 
					if($d['email'] != ""){
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
							$mail->SetFrom("admin@globalintertech.co.id","CS Service");
							$mail->Subject = $idsvc;
							$mail->AddAddress($d['email'], $d['nama']);
							$mail->MsgHTML("Tanggal: ".formattgl($tgl_now)."<br />Status : Terdaftar<br />No. HP : ".$hp."<hr />Untuk info service selengkapnya, anda bisa klik link dibawah ini<br /><br /><a href='https://globalintertech.co.id/data_svc'>wwww.globalintertech.co.id/data_svc</a><br /><br /><i>sumber dari <b>Global Intertech</b></i>");
							$mail->IsHTML(true);
							if($mail->Send()){ echo "oke"; }
							else { echo "error|Terjadi kesalahan system."; }
						} else { echo "oke"; }
					} else { echo "oke"; }
				} else { echo "error|Terjadi kesalahan system."; }
			} else { echo "error|Terjadi kesalahan system."; }
		} else {
			echo "error|<div class='alert alert-danger alert-dismissable'><button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button><p>".substr($msg,0,-6)."</p></div>";
		}
	} else
	if($op == "sv_service_baru_form_2"){ $nama = $_POST['nama_cus']; $hp = $_POST['hp']; $email = $_POST['email_null'];
		$alamat = $_POST['value_null']; $keluhan = $_POST['keluhan']; $error = 0; $msg = "";
		if(karakter_nama($nama) == "invalid"){
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
		if(karakter_wys($alamat) == "invalid"){
			$error += 1; $msg .= "<i class='icon-remove'></i> Alamat: tidak boleh menggunakan symbol.<hr />";
		}
		if($error == 0){
			$qc = mysqli_query($conn,"select *, count(*)as baris from tb_counter where year(tgl)='".$thn_now."' and keterangan='cus_global_web' LIMIT 1"); $dc = mysqli_fetch_array($qc);
			if($dc['baris'] == 0){ 
				$tambah = 1; mysqli_query($conn,"insert into tb_counter values(null,'".$tgl_now."','".$tambah."','cus_global_web')");
			} else {
				$tambah = $dc['counter'] + 1; mysqli_query($conn,"update tb_counter set counter='".$tambah."' where year(tgl)='".$thn_now."' and keterangan='cus_global_web' LIMIT 1");
			}
			if($tambah < 10){ $idcus = "GC".date("y")."000".$tambah; } else
			if($tambah < 100){ $idcus = "GC".date("y")."00".$tambah; } else
			if($tambah < 1000){ $idcus = "GC".date("y")."0".$tambah; } else
			if($tambah < 10000){ $idcus = "GC".date("y").$tambah; }
			$svc = mysqli_query($conn,"insert into tb_customer values(null,'$idcus','$nama','$email','$alamat','','$hp','','','','$tgl_now')");
			if($svc){
				$qc = mysqli_query($conn,"select *, count(*)as baris from tb_counter where year(tgl)='".$thn_now."' and keterangan='service' LIMIT 1"); $dc = mysqli_fetch_array($qc);
				if($dc['baris'] == 0){ 
					$tambah = 1; mysqli_query($conn,"insert into tb_counter values(null,'".$tgl_now."','".$tambah."','service')");
				} else {
					$tambah = $dc['counter'] + 1; mysqli_query($conn,"update tb_counter set counter='".$tambah."' where year(tgl)='".$thn_now."' and keterangan='service' LIMIT 1");
				}
				if($tambah < 10){ $idsvc = "SVC".date("my")."000".$tambah; } else
				if($tambah < 100){ $idsvc = "SVC".date("my")."00".$tambah; } else
				if($tambah < 1000){	$idsvc = "SVC".date("my")."0".$tambah; } else
				if($tambah < 10000){ $idsvc = "SVC".date("my").$tambah; }
				$svsvc = mysqli_query($conn,"insert into tb_log_service values(null,'$idsvc','$idcus','$keluhan','','','$tgl_now','0000-00-00','0000-00-00','0','0','0','1','')");
				if($svsvc){
					$svsvca = mysqli_query($conn,"insert into tb_analisis_service values(null,'$idsvc','0','$tgl_now','0','0')");
					if($svsvca){ 
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
								$mail->SetFrom("admin@globalintertech.co.id","CS Service");
								$mail->Subject = $idsvc;
								$mail->AddAddress($email, $nama);
								$mail->MsgHTML("Tanggal: ".formattgl($tgl_now)."<br />Status : Terdaftar<br />No. HP : ".$hp."<hr />Untuk info service selengkapnya, anda bisa klik link dibawah ini<br /><br /><a href='https://globalintertech.co.id/data_svc'>wwww.globalintertech.co.id/data_svc</a><br /><br /><i>sumber dari <b>Global Intertech</b></i>");
								$mail->IsHTML(true);
								if($mail->Send()){ echo "oke"; }
								else { echo "error|Terjadi kesalahan system."; }
							} else { echo "oke"; }
						} else { echo "oke"; }						
					} else { echo "error|Terjadi kesalahan system."; }
				} else { echo "error|Terjadi kesalahan system."; }
			} else { echo "error|Terjadi kesalahan system."; }
		} else {
			echo "error|<div class='alert alert-danger alert-dismissable'><button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button><p>".substr($msg,0,-6)."</p></div>";
		}
	} else
	if($op == "sv_service_baru"){ $hp = $_POST['hp']; $keluhan = $_POST['keluhan']; $error = 0; $msg = "";
		if(karakter_angka($hp) == "invalid"){
			$error += 1; $msg .= "<i class='icon-remove'></i> No. HP: tidak boleh menggunakan symbol/huruf/spasi.<hr />";
		}
		if(karakter_wys($keluhan) == "invalid"){
			$error += 1; $msg .= "<i class='icon-remove'></i> Keluhan: tidak boleh menggunakan symbol.<hr />";
		}
		if($error == 0){
			$q = mysqli_query($conn,"select * from tb_customer where kontak='".$hp."'"); $row = mysqli_num_rows($q);
			if($row == 0){
				echo "oke|form_daftar_svc_2|<div class='alert alert-danger alert-dismissable'><button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button><p>Mohon maaf, No. HP belum terdaftar. Silahkan anda melakukan pendaftar dengan mengisi data berikut.</p></div>";
			} else { 
				if($row > 1){
					echo "oke|form_daftar_svc_3|<div class='alert alert-danger alert-dismissable'><button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button><p>Mohon maaf, No. HP terdaftar lebih dari satu alamat. Pilih salah satu alamat tujuan service.</p></div>";
				} else {
					if($error == 0){
						$qc = mysqli_query($conn,"select *, count(*)as baris from tb_counter where year(tgl)='".$thn_now."' and keterangan='service' LIMIT 1"); $dc = mysqli_fetch_array($qc);
						if($dc['baris'] == 0){ 
							$tambah = 1; mysqli_query($conn,"insert into tb_counter values(null,'".$tgl_now."','".$tambah."','service')");
						} else {
							$tambah = $dc['counter'] + 1; mysqli_query($conn,"update tb_counter set counter='".$tambah."' where year(tgl)='".$thn_now."' and keterangan='service' LIMIT 1");
						}
						if($tambah < 10){ $idsvc = "SVC".date("my")."000".$tambah; } else
						if($tambah < 100){ $idsvc = "SVC".date("my")."00".$tambah; } else
						if($tambah < 1000){	$idsvc = "SVC".date("my")."0".$tambah; } else
						if($tambah < 10000){ $idsvc = "SVC".date("my").$tambah; }
						$qcus = mysqli_query($conn,"select * from tb_customer where kontak='".$hp."' LIMIT 1");
						$dcus = mysqli_fetch_array($qcus);
						$svsvc = mysqli_query($conn,"insert into tb_log_service values(null,'$idsvc','$dcus[id_customer]','$keluhan','','','$tgl_now','0000-00-00','0000-00-00','0','0','0','1','')");
						if($svsvc){
							$svsvca = mysqli_query($conn,"insert into tb_analisis_service values(null,'$idsvc','0','$tgl_now','0','0')");
							if($svsvca){ 
								if($dcus['email'] != ""){
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
										$mail->SetFrom("admin@globalintertech.co.id","CS Service");
										$mail->Subject = $idsvc;
										$mail->AddAddress($dcus['email'], $dcus['nama']);
										$mail->MsgHTML("Tanggal: ".formattgl($tgl_now)."<br />Status : Terdaftar<br />No. HP : ".$hp."<hr />Untuk info service selengkapnya, anda bisa klik link dibawah ini<br /><br /><a href='https://globalintertech.co.id/data_svc'>wwww.globalintertech.co.id/data_svc</a><br /><br /><i>sumber dari <b>Global Intertech</b></i>");
										$mail->IsHTML(true);
										if($mail->Send()){ echo "oke|oke"; }
										else { echo "error|Terjadi kesalahan system."; }
									} else { echo "oke|oke"; }
								} else { echo "oke|form_daftar_email"; }						
							} else { echo "error|Terjadi kesalahan system."; }
						} else { echo "error|Terjadi kesalahan system."; }
					} else {
						echo "error|<div class='alert alert-danger alert-dismissable'><button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button><p>".substr($msg,0,-6)."</p></div>";
					}
				}
			}
		} else {
			echo "error|<div class='alert alert-danger alert-dismissable'><button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button><p>".substr($msg,0,-6)."</p></div>";
		}
	}
?>