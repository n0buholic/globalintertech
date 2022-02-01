<?php
	date_default_timezone_set('Asia/Kuala_Lumpur'); require_once("../setty/config.php"); require_once("../setty/func.php");
	$Op = $_POST['Op'];
	if($Op == "CekIdInput"){ $InvoiceSn = $_POST['InvoiceSn'];
		$QInvoice = mysqli_query($conn,"select * from tb_analisis_service_rma where id_service='".$InvoiceSn."' LIMIT 1");
		$RowInvoice = mysqli_num_rows($QInvoice);

		$QSn = mysqli_query($conn,"select * from tb_analisis_service_rma where sn_analisis='".$InvoiceSn."' LIMIT 1");
		$RowSn = mysqli_num_rows($QSn);

		$Ada = $RowInvoice + $RowSn;

		//cek apakah data ID berupa Invoice
		$QInvoice = mysqli_query($conn,"select *, count(id_service)as 'RowInvoice' from tb_analisis_service_rma where id_service='".$InvoiceSn."'"); $DInvoice = mysqli_fetch_array($QInvoice);
		if($DInvoice['RowInvoice'] > 0){
			if($DInvoice['RowInvoice'] > 1){
				$Status = "Invoice"; $TotalSn = 0; $Invoice = "";
			} else {
				$QSn = mysqli_query($conn,"select * from tb_analisis_service_rma where id_service='".$InvoiceSn."'");
				$DSn = mysqli_fetch_array($QSn);
				$Status = "Serial Number"; $TotalSn = 0; $Invoice = $DSn['sn_analisis'];
			}
		} else {
			$QSn = mysqli_query($conn,"select *, count(sn_analisis)as 'TotalSn' from tb_analisis_service_rma where sn_analisis='".$InvoiceSn."'"); $DSn = mysqli_fetch_array($QSn);
			if($DSn['TotalSn'] > 1){
				$Invoice = "";
			} else {
				$Invoice = $DSn['id_service'];
			}
			$Status = "Serial Number"; $TotalSn = $DSn['TotalSn'];
		}

		$Json = array("Status"=> $Status, "Ada"=> $Ada, "TotalSn"=> $TotalSn, "Invoice"=> $Invoice);

		echo json_encode($Json);
	} else
	if($Op == "Trigger_Data"){ $Sub = $_POST['Sub'];
		if($Sub == "DetailPerSn"){ $Invoice = $_POST['Invoice']; $Sn = $_POST['Sn']; $DataLog = array();
			$QSales = mysqli_query($conn,"select * from tb_log_sales where id_kegiatan='".$Invoice."' order by tgl_waktu desc");
			while($RSales = mysqli_fetch_array($QSales)){
				$Arr = json_decode($RSales['kegiatan']);
				if($Arr[0] == $Sn){

					$QRma = mysqli_query($conn,"select * from tb_log_service_rma where id_svc='".$Invoice."' and sn='".$Sn."' LIMIT 1"); $DRma = mysqli_fetch_array($QRma);

					if($DRma['tgl_masuk'] == $RSales['tgl_waktu']){
						$Status = "Masuk"; $Icon = "icon-signin";
					} else if($DRma['tgl_selesai'] == $RSales['tgl_waktu']){
						$Status = "Selesai"; $Icon = "icon-ok";
					} else {
						$Status = "Proses"; $Icon = "icon-wrench";
					}

					$Tgl = explode(" ", $RSales['tgl_waktu']);
					$DataLogSub = array();
					$DataLogSub[] = formattgl($Tgl[0]);//0
					$DataLogSub[] = $Arr[1];//1
					$DataLogSub[] = str_replace("_", "/", $RSales['link']);//2
					$DataLogSub[] = $Status;//3
					$DataLogSub[] = $Icon;//4
					$DataLog[] = $DataLogSub;
				}
			}
			echo json_encode($DataLog);
		}
	}
?>