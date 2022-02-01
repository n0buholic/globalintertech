<?php	
	function formattgl($tgl){ //merubah format tgl menjadi "11 Januari 1995"
		$arr = explode("-", $tgl);
		switch($arr[1]){
			case '12':
				$bln = "Desember";
			break;
			case '11':
				$bln = "Nopember";
			break;
			case '10':
				$bln = "Oktober";
			break;
			case '09':
				$bln = "September";
			break;
			case '08':
				$bln = "Agustus";
			break;
			case '07':
				$bln = "Juli";
			break;
			case '06':
				$bln = "Juni";
			break;
			case '05':
				$bln = "Mei";
			break;
			case '04':
				$bln = "April";
			break;
			case '03':
				$bln = "Maret";
			break;
			case '02':
				$bln = "Pebruari";
			break;
			case '01':
				$bln = "Januari";
			break;
			default:
				$bln = " ";
			break;
		}
		return $arr[2]." ".$bln." ".$arr[0];
	}
	
	function karakter($str){
		if(preg_match("/[`\_\&\$\#\@\?\>\<\;\:\'\^\%\*\!\{\}]/", $str)){ return "invalid"; }
		else { return "valid"; }
	}
	
	function karakter_nama($str){
		if(preg_match("/[`\_\&\$\#\@\?\)\(\>\<\;\:\'\^\%\*\!\{\}]/", $str)){ return "invalid"; }
		else { return "valid"; }
	}
	
	function karakter_email($str){
		if(preg_match("/[`\ \&\$\#\?\)\(\>\<\;\:\'\^\%\*\!\{\}]/", $str)){ return "invalid"; }
		else { return "valid"; }
	}
	
	function karakter_wys($str){
		if(preg_match("/[`\_\$\#\@\?\'\^\*\!\{\}]/", $str)){ return "invalid"; }
		else { return "valid"; }
	}
	
	function karakter_user($str){
		if(preg_match("/[A-Z\`\_\ \<\>\)\(\&\;\$\#\@\?\:\'\^\%\*\!\}\{]/", $str)){ return "invalid"; }
		else { return "valid"; }		
	}
	
	function karakter_pass($str){
		if(preg_match("/[`\_\ \<\>\)\(\&\;\$\#\@\?\:\'\^\%\*\!\}\{]/", $str)){ return "invalid"; }
		else { return "valid"; }		
	}
	
	function karakter_angka($str){
		if(preg_match("/[A-Za-z\`\_\ \<\>\)\(\&\;\$\#\@\?\:\'\^\%\*\!\}\{]/", $str)){ return "invalid"; }
		else { return "valid"; }		
	}
	
	function karakter_telp($str){
		$find = array("_"," "); $replace = array("",""); $str1 = str_replace($find, $replace, $str);
		if(preg_match("/[a-zA-Z\.\`\ \~\_\&\$\)\#\(\@\?\>\<\:\;\'\^\%\*\!\{\}]/", $str1)){ return "invalid"; }
		else { return "valid"; }
	}

	function hari($hari){
		switch($hari){
			case 'Sun':
				$hari_ini = "Minggu";
			break;
			case 'Mon':
				$hari_ini = "Senin";
			break;
			case 'Tue':
				$hari_ini = "Selasa";
			break;
			case 'Wed':
				$hari_ini = "Rabu";
			break;
			case 'Thu':
				$hari_ini = "Kamis";
			break;
			case 'Fri':
				$hari_ini = "Jum'at";
			break;
			case 'Sat':
				$hari_ini = "Sabtu";
			break;
			default:
				$hari_ini = "Tidak diketahui.";
			break;
		}
		return $hari_ini;
	}
	
	function buang_spasi($string){
		$hasil = str_replace(' ', '', $string);
		return $hasil;
	}

	function data_log_user($conn, $username){
		$que1 = mysqli_query($conn,"select * from tb_user where ngaran='$username'");
		$d1 = mysqli_fetch_array($que1); $id = $d1['id_teknisi'];
		$que = mysqli_query($conn,"select * from tb_log where id_user='$id'"); $dt = "";
		while($r = mysqli_fetch_array($que)){
			$dt .= "<tr><td>$r[tgl_log] / $r[pukul]</td><td>$r[ket_log] ($r[id_log])</td></tr>";
		}
		return $dt;
	}
	
	function data_customer($conn){
		$que = mysqli_query($conn,"select * from tb_customer where nama<>'' order by nama asc");
		$data = ""; $data .= "<option value=''>Cari Nama Customer...</option>";
		while($r = mysqli_fetch_array($que)){
			$data .= "<option value='$r[id_customer]'>$r[nama] -> $r[kontak]</option>";
		}
		return $data;
	}

	function data_iklan($kon, $divisi){
		$que_iklan = mysqli_query($kon,"select * from tb_iklan_baris where divisi_i='$divisi' or divisi_i='Semua'");
		$dt_iklan = "";
		while($r_iklan = mysqli_fetch_array($que_iklan)){
			$dt_iklan .= " <i class='icon-comments-alt'></i> $r_iklan[isi] &nbsp;&nbsp;&nbsp;";
		}
		return $dt_iklan;
	}

	function kode_ke_lokasi($kode, $conn){
		$que = mysqli_query($conn,"select * from tb_lokasi where kode='$kode'");
		$d = mysqli_fetch_array($que);
		return $d['lokasi'];
	}
	
	function cek_login($user, $pass){
		if((!isset($user)) AND (!isset($pass))){
			header("location: ../");
		}
	}
	
	function cek_login1($user, $pass){
		if((!isset($user)) AND (!isset($pass))){
			header("location: ../../");
		}
	}
	
	function cek_divisi($divisi){
		if($divisi == "Gudang"){
			$lokasi = "gudang";
		} else if($divisi == "Service"){
			$lokasi = "service";
		} else if($divisi == "Admin Level"){
			$lokasi = "admgolax";
		} else if($divisi == "Teknisi"){
			$lokasi = "teknisi";
		} else if($divisi == "Sales"){
			$lokasi = "sales";
		} else if($divisi == "Admin Umum"){
			$lokasi = "admumum";
		} else if($divisi == "Marketing"){
			$lokasi = "marketing";
		} else if($divisi == "Service RMA"){
			$lokasi = "servicerma";
		}
		return $lokasi;
	}
	
	function select_log_sales($kon, $var1){
		$que = mysqli_query($kon,"select * from tb_log_sales where id_sales='$var1'");
		return $que;
	}
	
	function total_in_out($kon, $karakter, $sub){
		if($sub == "kategori"){		
			$que = mysqli_query($kon,"select *, count(*)as baris from tb_stok_in where kategori='$karakter'");
			$d = mysqli_fetch_array($que);
			$que1 = mysqli_query($kon,"select *, count(*)as baris_out from tb_stok_out where kategori='$karakter'");
			$d1 = mysqli_fetch_array($que1);
		} else
		if($sub == "type"){		
			$que = mysqli_query($kon,"select *, count(*)as baris from tb_stok_in where type='$karakter'");
			$d = mysqli_fetch_array($que);
			$que1 = mysqli_query($kon,"select *, count(*)as baris_out from tb_stok_out where type='$karakter'");
			$d1 = mysqli_fetch_array($que1);
		} else
		if($sub == "brand"){		
			$que = mysqli_query($kon,"select *, count(*)as baris from tb_stok_in where brand='$karakter'");
			$d = mysqli_fetch_array($que);
			$que1 = mysqli_query($kon,"select *, count(*)as baris_out from tb_stok_out where brand='$karakter'");
			$d1 = mysqli_fetch_array($que1);
		}
		return $d['baris']."|".$d1['baris_out'];
	}
	
	function data_user($kon, $user){
		$que_user = mysqli_query($kon,"select * from tb_user where ngaran='$user'");
		$d_user = mysqli_fetch_array($que_user);
		return $d_user['id_teknisi'];
	}
	
	function simpan_log($conn, $iduser, $idlog, $ket, $tgl, $pukul, $divisi){
		$que = mysqli_query($conn,"insert into tb_log values('$iduser','$idlog','$ket','$tgl','$pukul','$divisi')");
		return $que;
	}
	
	function acak($panjang){
		$karakter = '0987654321';
		$string = '';
		for ($i = 0; $i < $panjang; $i++){
			$pos = rand(0, strlen($karakter)-1);
			$string .= $karakter{$pos};
		}
		return $string;
	}
	
	function acak1($panjang){
		$karakter = '1234567890AHRJKTNMPTLMNSKSHYRT';
		$string = '';
		for ($i = 0; $i < $panjang; $i++){
			$pos = rand(0, strlen($karakter)-1);
			$string .= $karakter{$pos};
		}
		return $string;
	}
	
	function simpan_svc($idsvc, $idcus, $komplain, $tgl_svc, $point, $kon, $status){
		$que = mysqli_query($kon,"insert into tb_log_service values('$idsvc','$idcus','$komplain','','','$tgl_svc','','','0','0','$status','$point','')");
		return $que;
	}
?>