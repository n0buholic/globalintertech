<?php
	date_default_timezone_set('Asia/Kuala_Lumpur'); require_once("../setty/config.php"); require_once("../setty/func.php");
	if(isset($_COOKIE['captcha_garansi']) AND isset($_POST['str']) AND isset($_POST['captcha'])){
		$captcha_s = $_COOKIE['captcha_garansi']; $captcha = $_POST['captcha'];
		if($captcha_s == $captcha){
			$sn = $_POST['str'];
			$qout = mysqli_query($conn,"select *, count(*)as baris from tb_stok_out where sn_kode='".$sn."' LIMIT 1");
			$dout = mysqli_fetch_array($qout);
			$qrma = mysqli_query($conn,"select *, count(*)as baris from tb_stok_out_rma where sn_sor='".$sn."' LIMIT 1");
			$drma = mysqli_fetch_array($qrma);
			if($dout['baris'] == 1 OR $drma['baris'] == 1){
				$tgl_now = new DateTime(date("Y-m-d"));
				if($dout['baris'] == 1){ $bulan = $dout['garansi_out'];
					$qinv_beli = mysqli_query($conn,"select * from tb_invoice_beli where no_invoice='".$dout['no_invoice']."' LIMIT 1"); $dinv_beli = mysqli_fetch_array($qinv_beli); $idsup = $dinv_beli['id_pemasuk'];
					$tgl_batas = date("Y-m-d", strtotime('+'.$bulan.' month', strtotime($dinv_beli['tgl_invoice'])));
					$tgl_beli = formattgl($dout['tgl_keluar']); $idpem = $dout['id_customer']; $id_prd = $dout['id_produk'];
					$invoice = $dout['no_invoice'];
				} else { $bulan = $drma['garansi_sor']; $idsup = $drma['id_supplier_sor'];
					$tgl_batas = date("Y-m-d", strtotime('+'.$bulan.' month', strtotime($drma['tgl_invoice_sor'])));
					$tgl_beli = formattgl($drma['tgl_invoice_sor']); $idpem = $drma['id_pembeli_sor']; $id_prd = $drma['id_prd_rma'];
					$invoice = $dout['invoice_ib_rma'];
				}
				$sisa = strtotime($tgl_batas) - strtotime(date("Y-m-d"));
				$tgl_batas2 = new DateTime($tgl_batas); $diff = $tgl_now->diff($tgl_batas2);
				if($sisa >= 0){
					$tgl_batas1 = $tgl_batas;
					$str_garansi = "<span class='label label-success' style='font-size:16px;'>Masih Garansi</span>";
					if($diff->y == 0){ $thn = ""; } else { $thn = $diff->y." thn / "; }
					if($diff->m == 0){ $bln = ""; } else { $bln = $diff->m." bln / "; }
					if($diff->d == 0){ $hr = ""; } else { $hr = $diff->d." hr "; }
					$str_durasi = "<tr><td>Sisa Garansi</td><td><i class='icon-caret-right'></i> ".$thn.$bln.$hr."</td></tr>";
				} else {
					$tgl_batas1 = $tgl_batas; $str_garansi = "<span class='label label-danger' style='font-size:16px;'>Garansi Habis</span>"; $str_durasi = "<tr><td>Tgl. Sekarang</td><td><i class='icon-caret-right'></i> ".formattgl(date("Y-m-d"))."</td></tr>";
				}
				$qcus = mysqli_query($conn,"select * from tb_customer where id_customer='".$idsup."' LIMIT 1");
				$dcus = mysqli_fetch_array($qcus);
				$qpem = mysqli_query($conn,"select * from tb_customer where id_customer='".$idpem."' LIMIT 1");
				$dpem = mysqli_fetch_array($qpem);

				$sqlprd = mysqli_query($conn,"SELECT id_produk, produk FROM tb_produk WHERE id_produk = '".$id_prd."' LIMIT 1");
				$dprd = mysqli_fetch_array($sqlprd);

				$detail = "	<table class='table tabel-striped'>
							<tr class='success'><td>Customer</td><td><i class='icon-caret-right'></i> ".$dpem['nama']."</td></tr>
							<tr><td>Status</td><td><i class='icon-caret-right'></i> ".$str_garansi."</td></tr>
							<!--<tr><td>Supplier</td><td><i class='icon-caret-right'></i> <i>".$dcus['nama']."</i></td></tr>!-->
							<tr><td>Invoice</td><td><i class='icon-caret-right'></i> ".$invoice."</td></tr>
							<tr><td>Type Produk</td><td><i class='icon-caret-right'></i> ".$dprd['produk']."</td></tr>
							<tr class='success'><td>Serial Number</td><td><i class='icon-caret-right'></i> ".$sn."</td></tr>
							<tr><td>Tgl. Pembelian</td><td><i class='icon-caret-right'></i> ".$tgl_beli."</td></tr>
							<tr><td>Tgl. Batas Garansi</td><td><i class='icon-caret-right'></i> ".formattgl($tgl_batas1)."</td></tr>
							".$str_durasi."
						</table>"; $data = array("valid", $detail);
			} else { $data = array("invalid", "<div class='alert alert-danger text-center'>Maaf, Serial Number tidak ditemukan.</div>"); }
		} else { $data = array("reload", "./"); }
	} else { $data = array("reload", "./"); } echo json_encode($data); ?>