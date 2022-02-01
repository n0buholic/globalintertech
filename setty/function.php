<?php
	date_default_timezone_set('Asia/Kuala_Lumpur');
	
	function karakter($str){
		if(preg_match("/[`\_\&\$\#\@\?\>\<\;\:\'\^\%\*\!\{\}]/", $str)){ return "invalid"; }
		else { return "valid"; }
	}
	
	function karakter_nama($str){
		if(preg_match("/[`\_\.\&\$\#\@\?\)\(\>\<\;\:\'\^\%\*\!\{\}]/", $str)){ return "invalid"; }
		else { return "valid"; }
	}
	
	function karakter_email($str){
		if(preg_match("/[`\ \&\$\#\?\)\(\>\<\;\:\'\^\%\*\!\{\}]/", $str)){ return "invalid"; }
		else { return "valid"; }
	}
	
	function karakter_wys($str){
		if(preg_match("/[`\_\$\#\@\?\:\'\^\%\*\!\{\}]/", $str)){ return "invalid"; }
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
		if(preg_match("/[A-Za-z\`\_\<\>\)\(\&\;\$\#\@\?\:\'\^\%\*\!\}\{]/", $str)){ return "invalid"; }
		else { return "valid"; }		
	}
	
	function karakter_telp($str){
		$find = array("_"," "); $replace = array("",""); $str1 = str_replace($find, $replace, $str);
		if(preg_match("/[a-zA-Z\.\`\ \~\_\&\$\)\#\(\@\?\>\<\:\;\'\^\%\*\!\{\}]/", $str1)){ return "invalid"; }
		else { return "valid"; }
	}
	
	function total_user($kon, $user){
		$q1 = mysqli_query($kon,"select * from tb_user where ngaran='".$user."' LIMIT 1");
		$row1 = mysqli_num_rows($q1); if($row1 == 1){ return "invalid"; } else { return "valid"; }
	}
	
	function cek_device(){
		$useragent=$_SERVER['HTTP_USER_AGENT'];
        if(preg_match('/(android|bb\d+|meego).+mobile|avantgo|bada\/|blackberry|blazer|compal|elaine|fennec|hiptop|iemobile|ip(hone|od)|iris|kindle|lge |maemo|midp|mmp|mobile.+firefox|netfront|opera m(ob|in)i|palm( os)?|phone|p(ixi|re)\/|plucker|pocket|psp|series(4|6)0|symbian|treo|up\.(browser|link)|vodafone|wap|windows ce|xda|xiino/i',$useragent)||preg_match('/1207|6310|6590|3gso|4thp|50[1-6]i|770s|802s|a wa|abac|ac(er|oo|s\-)|ai(ko|rn)|al(av|ca|co)|amoi|an(ex|ny|yw)|aptu|ar(ch|go)|as(te|us)|attw|au(di|\-m|r |s )|avan|be(ck|ll|nq)|bi(lb|rd)|bl(ac|az)|br(e|v)w|bumb|bw\-(n|u)|c55\/|capi|ccwa|cdm\-|cell|chtm|cldc|cmd\-|co(mp|nd)|craw|da(it|ll|ng)|dbte|dc\-s|devi|dica|dmob|do(c|p)o|ds(12|\-d)|el(49|ai)|em(l2|ul)|er(ic|k0)|esl8|ez([4-7]0|os|wa|ze)|fetc|fly(\-|_)|g1 u|g560|gene|gf\-5|g\-mo|go(\.w|od)|gr(ad|un)|haie|hcit|hd\-(m|p|t)|hei\-|hi(pt|ta)|hp( i|ip)|hs\-c|ht(c(\-| |_|a|g|p|s|t)|tp)|hu(aw|tc)|i\-(20|go|ma)|i230|iac( |\-|\/)|ibro|idea|ig01|ikom|im1k|inno|ipaq|iris|ja(t|v)a|jbro|jemu|jigs|kddi|keji|kgt( |\/)|klon|kpt |kwc\-|kyo(c|k)|le(no|xi)|lg( g|\/(k|l|u)|50|54|\-[a-w])|libw|lynx|m1\-w|m3ga|m50\/|ma(te|ui|xo)|mc(01|21|ca)|m\-cr|me(rc|ri)|mi(o8|oa|ts)|mmef|mo(01|02|bi|de|do|t(\-| |o|v)|zz)|mt(50|p1|v )|mwbp|mywa|n10[0-2]|n20[2-3]|n30(0|2)|n50(0|2|5)|n7(0(0|1)|10)|ne((c|m)\-|on|tf|wf|wg|wt)|nok(6|i)|nzph|o2im|op(ti|wv)|oran|owg1|p800|pan(a|d|t)|pdxg|pg(13|\-([1-8]|c))|phil|pire|pl(ay|uc)|pn\-2|po(ck|rt|se)|prox|psio|pt\-g|qa\-a|qc(07|12|21|32|60|\-[2-7]|i\-)|qtek|r380|r600|raks|rim9|ro(ve|zo)|s55\/|sa(ge|ma|mm|ms|ny|va)|sc(01|h\-|oo|p\-)|sdk\/|se(c(\-|0|1)|47|mc|nd|ri)|sgh\-|shar|sie(\-|m)|sk\-0|sl(45|id)|sm(al|ar|b3|it|t5)|so(ft|ny)|sp(01|h\-|v\-|v )|sy(01|mb)|t2(18|50)|t6(00|10|18)|ta(gt|lk)|tcl\-|tdg\-|tel(i|m)|tim\-|t\-mo|to(pl|sh)|ts(70|m\-|m3|m5)|tx\-9|up(\.b|g1|si)|utst|v400|v750|veri|vi(rg|te)|vk(40|5[0-3]|\-v)|vm40|voda|vulc|vx(52|53|60|61|70|80|81|83|85|98)|w3c(\-| )|webc|whit|wi(g |nc|nw)|wmlb|wonu|x700|yas\-|your|zeto|zte\-/i',substr($useragent,0,4)))
		{ return "m"; } else { return "d"; }
	}
	
	function sv_token($kon, $user, $divisi, $iduser){
		$token = md5(date("YmdHis"));
		mysqli_query($kon,"insert into tb_login_token values(null,'$token','$user','".date("Y-m-d H:i:s")."','$divisi','$iduser')"); mysqli_query($kon,"update tb_user set online=1 where id_teknisi='".$iduser."' LIMIT 1");
	}
	function edt_token($kon, $user, $iduser){
		$token = md5(date("YmdHis"));
		mysqli_query($kon,"update tb_login_token set tgl_tkn='".date("Y-m-d H:i:s")."', token='$token' where id_user_tkn='$iduser' LIMIT 1"); mysqli_query($kon,"update tb_user set online=1 where id_teknisi='".$iduser."' LIMIT 1");
	}
	function token($kon, $token){
		$q = mysqli_query($kon,"select *, count(*)as row from tb_login_token where token='$token' LIMIT 1"); 
		$d = mysqli_fetch_array($q);
		if($d['row'] == 0){
			return "tidak|||";
		} else {
			$q1 = mysqli_query($kon,"select * from tb_user where id_teknisi='$d[id_user_tkn]' LIMIT 1");
			$d1 = mysqli_fetch_array($q1);
			return "ada|".$d1['divisi']."|".$d1['id_teknisi']."|".$d1['ngaran']."|".$d1['lokasi_u'];
		}
	}
	function user($kon, $user){
		$q = mysqli_query($kon, "select * from tb_user where ngaran='".$user."' LIMIT 1"); $d = mysqli_fetch_array($q);
		return $d['nama'];
	}
	function data_master_label($conn, $id){
		$q = mysqli_query($conn,"select * from tb_master_label where no_si='$id' LIMIT 1"); $d = mysqli_fetch_array($q);
		return $d['ket_si']."|".$d['border_si']."|".$d['color_si'];
	}
	function encode_base64_pdf($file){
		$data = $file; $imageData = base64_encode(file_get_contents($data));
		$src = 'data:'.mime_content_type($data).';base64,'.$imageData; return $src;
	}
	function encode_base64($img){
		$image = $img; $imageData = base64_encode(file_get_contents($image));
		$src = 'data:'.mime_content_type($image).';base64,'.$imageData; return $src;
	}
	function data_percustomer($kon, $id){
		$q = mysqli_query($kon,"select *, count(id_customer)as baris from tb_customer where id_customer='$id' LIMIT 1");
		$d = mysqli_fetch_array($q); return $d['baris'].">".$d['nama'].">".$d['kontak'];
	}	
	function sv_counter($kon, $tahun, $counter, $ket){
		$qcoun = mysqli_query($kon,"select * from tb_counter where keterangan='$ket' and year(tgl)='$tahun' LIMIT 1"); $dcoun = mysqli_fetch_array($qcoun);
		if($dcoun['counter'] != ""){	
			mysqli_query($kon,"update tb_counter set counter='$counter' where keterangan='$ket' and year(tgl)='$tahun' LIMIT 1");
		} else {
			$tgl = date("Y-m-d"); mysqli_query($kon,"insert into tb_counter values(null,'$tgl','$counter','$ket')");
		}
	}
	function info_produk($kon, $idproduk){
		$q = mysqli_query($kon,"select * from tb_produk where id_produk='$idproduk' LIMIT 1");
		$d = mysqli_fetch_array($q);
		return $d['snkode']."|".$d['produk']."|".$d['unit'];
	}
	function potong_str($string){
		$total = strlen($string); 
		if($total > 150){
			$num_char = 150; $char = $string{$num_char - 1};
			while($char != " "){
				$char = $string{--$num_char};
			}
			return substr($string, 0, $num_char)."...";
		} else {
			return $string;
		}
	}
	function id_to_produk($id, $kon){
		$q = mysqli_query($kon,"select * from tb_produk where id_produk='$id'");
		$d = mysqli_fetch_array($q); return $d['produk'];
	}
	function id_to_customer($id, $kon){
		$q = mysqli_query($kon,"select * from tb_customer where id_customer='$id'");
		$d = mysqli_fetch_array($q); return $d['nama'];
	}
	function id_to_unit($id, $kon){
		$q = mysqli_query($kon,"select * from tb_produk_satuan where id_satuan='$id'");
		$d = mysqli_fetch_array($q); return $d['nama'];
	}
	function id_to_kategori($id, $kon){
		$q = mysqli_query($kon,"select * from tb_produk_kategori where id_kategori='$id'");
		$d = mysqli_fetch_array($q); return $d['nama'];
	}
	function replace_kontak_1($hp){
		$find = array("_"," "); $replace = array("",""); return str_replace($find, $replace, $hp);
	}
	function replace_kontak($hp){
		$kontak = "";
		for($i=0; $i<=3; $i++){
			$mulai = $i * 4;
			$kontak .= substr($hp,$mulai,4)." ";
		}
		return substr($kontak,0,-1);
	}
	function ganti_str($str){
		$find = array("-","_"); $replace = array(" ","+");
		return str_replace($find, $replace, $str);
	}
	function idtouser($iduser, $conn){
		$q = mysqli_query($conn,"select * from tb_user where id_teknisi='$iduser'");
		$d = mysqli_fetch_array($q);
		return "<b>".strtoupper($d['nama'])."</b>";
	}
	function formatbln($bln){
		switch($bln){
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
				$bln = "Agtustus";
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
		return $bln;
	}
	function formattgl1($tgl){ //merubah format tgl menjadi "11 Jan 1995"
		$arr = explode("-", $tgl);
		switch($arr[1]){
			case '12':
				$bln = "Des";
			break;
			case '11':
				$bln = "Nop";
			break;
			case '10':
				$bln = "Okt";
			break;
			case '09':
				$bln = "Sep";
			break;
			case '08':
				$bln = "Agt";
			break;
			case '07':
				$bln = "Jul";
			break;
			case '06':
				$bln = "Jun";
			break;
			case '05':
				$bln = "Mei";
			break;
			case '04':
				$bln = "Apr";
			break;
			case '03':
				$bln = "Mar";
			break;
			case '02':
				$bln = "Peb";
			break;
			case '01':
				$bln = "Jan";
			break;
			default:
				$bln = " ";
			break;
		}
		return $arr[2]." ".$bln." ".$arr[0];
	}
	function formattgl2($tgl){ //merubah format tgl menjadi "11 Januari 1995"
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
	function cek_login2($user, $pass){
		if((!isset($user)) AND (!isset($pass))){
			header("location: ../../../");
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
	function cek_divisi_m($divisi){
		if($divisi == "Admin Level"){
			$lokasi = "madmgolax";
		} else if($divisi == "Teknisi"){
			$lokasi = "mteknisi";
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
		$que = mysqli_query($kon,"insert into tb_log_service values(null,'$idsvc','$idcus','$komplain','','','$tgl_svc','','','0','0','$status','$point','')");
		return $que;
	}
?>