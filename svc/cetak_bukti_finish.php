<?php 
	date_default_timezone_set('Asia/Kuala_Lumpur'); require_once("../setty/config.php"); require_once('../setty/func.php');
	require_once("phpqrcode/qrlib.php"); require_once('../admgolax/pdf/fpdf.php');

	$idsvc = $_POST['idsvc'];

	$que_svc_1 = mysqli_query($conn,"SELECT * FROM tb_log_service WHERE id_service = '$idsvc' LIMIT 1");
	$d_svc_1 = mysqli_fetch_array($que_svc_1);

	$que_cus = mysqli_query($conn,"SELECT * FROM tb_customer WHERE id_customer = '$d_svc_1[id_customer]' LIMIT 1");
	$d_cus = mysqli_fetch_array($que_cus);

	$dt_t = "";
	$que_svc = mysqli_query($conn,"SELECT * FROM tb_log_service_teknisi WHERE id_service = '$idsvc'");
	while($r = mysqli_fetch_array($que_svc)){
		$que_tek = mysqli_query($conn,"SELECT * FROM tb_user WHERE id_teknisi = '$r[id_teknisi]' AND divisi ='Teknisi'");
		$d_tek = mysqli_fetch_array($que_tek);
		$dt_t .= $d_tek['nama']." / "; }	
	
	$tgl = $d_svc_1['tgl_proses'];
	
	$hari = array(1 => "Senin", "Selasa", "Rabu", "Kamis", "Jum'at", "Sabtu", "Minggu");
	$bulan = array(1 => "Januari", "Pebruari", "Maret", "April", "Mei", "Juni", "Juli", "Agustus", "September", "Oktober", "Nopember", "Desember");
	$num_hari = date('N', strtotime($tgl));
	
	$split = explode('-', $tgl);
	$tgl_indo = $split[2]." ".$bulan[(int)$split[1]]." ".$split[0];
	
	#qr code
	$isi_teks = "http://globalintertech.co.id/svc/".$idsvc; $namafile = "qrcode.png"; $quality = 'H'; $ukuran = 3; $padding = 0; 
	QRCode::png($isi_teks,$namafile,$quality,$ukuran,$padding);

	class PDF extends FPDF{

		function Footer () {
			$this->SetY(-20);
			$this->SetFont('Arial','B',8);
			$this->Cell(190,4,'Jl. KOLONEL SUGIONO NO.78 BANJARMASIN 70142 KALIMANTAN SELATAN - INDONESIA',0,1,'C');
			$this->Cell(190,4,'TEL +62 511 3272707 FAX +62 511 3256363',0,1,'C');
			$this->Cell(190,6,'Info Service cek disini : http://www.globalintertech.co.id/svc/'.$_POST['idsvc'].' atau scan langsung QRCode di atas.',0,1,'C',true);
			/*$this->Cell(0,5,'Page '.$this->pageNo().'/{nb}',0,0,'C');*/
		}

		var $widths;
			var $aligns;

			function SetWidths($w){
				//Set the array of column widths
				$this->widths = $w;
			}

			function SetAligns($a){
				//Set the array of column alignments
				$this->aligns=$a;
			}

			function Row($data){
				//Calculate the height of the row
				$nb = 0;
				for($i = 0; $i < count($data); $i++){
					$nb = max($nb, $this->NbLines($this->widths[$i] ,$data[$i]));
				}
				$h=6*$nb;
				//Issue a page break first if needed
				$this->CheckPageBreak($h);
				//Draw the cells of the row
				for($i=0;$i<count($data);$i++){
					$w=$this->widths[$i];
					$a=isset($this->aligns[$i]) ? $this->aligns[$i] : 'L';
					//Save the current position
					$x=$this->GetX();
					$y=$this->GetY();
					//Draw the border
					$this->Rect($x,$y,$w,$h);
					//Print the text
					$this->MultiCell($w,6,$data[$i],0,$a);
					//Put the position to the right of the cell
					$this->SetXY($x+$w,$y);
				}
				//Go to the next line
				$this->Ln($h);

			}

			function CheckPageBreak($h){
				//If the height h would cause an overflow, add a new page immediately
				if($this->GetY()+$h>$this->PageBreakTrigger){
					$this->AddPage($this->CurOrientation);
				}
			}

			function NbLines($w,$txt){
				//Computes the number of lines a MultiCell of width w will take
				$cw=&$this->CurrentFont['cw'];
				if($w==0){
					$w=$this->w-$this->rMargin-$this->x;
				}
				$wmax=($w-5*$this->cMargin)*1000/$this->FontSize;
				$s=str_replace("\r",'',$txt);
				$nb=strlen($s);
				if($nb>0 and $s[$nb-1]=="\n"){
					$nb--;
				}
				$sep=-1;
				$i=0;
				$j=0;
				$l=0;
				$nl=1;
				while($i<$nb){
					$c=$s[$i];
					if($c=="\n"){
						$i++;
						$sep=-1;
						$j=$i;
						$l=0;
						$nl++;
						continue;
					}
					if($c==' '){
						$sep=$i;
					}
					$l+=$cw[$c];
					if($l>$wmax){
						if($sep==-1)
						{
							if($i==$j)
								$i++;
						}
						else {
							$i=$sep+1;
						}
						$sep=-1;
						$j=$i;
						$l=0;
						$nl++;
					}
					else {
						$i++;
					}
				}
				return $nl;
			}

	}

	$pdf = new PDF('P', 'mm', 'A4');
	$pdf->AddPage();
	/*$pdf->AliasNbPages();*/
	$pdf->Image('../admgolax/assets/img/logo-cmb.png',10,7,40);
	$pdf->Image('qrcode.png',175,13,15);
	$pdf->SetFont('Times','B',12);
	$pdf->Cell(190,0,'WORK ORDER : '.$idsvc,0,1,'R');
	$pdf->SetFont('Times','',11);
	$pdf->Cell(215,17,'',0,1,'R');
	//detail service
	$pdf->SetFont('Times','',11);	
	$pdf->Cell(30,6,'Tgl. Service ',0,0); $pdf->Cell(5,6,':',0,0,'C'); $pdf->SetFont('Times','B',11);
	$pdf->MultiCell(135,6,$hari[$num_hari].', '.$tgl_indo,0,'L'); $pdf->SetFont('Times','',11);
	$pdf->Cell(30,6,'Nama Customer ',0,0); $pdf->Cell(5,6,':',0,0,'C'); $pdf->SetFont('Times','B',11);	
	$pdf->MultiCell(135,6,$d_cus['nama'],0,'L'); $pdf->SetFont('Times','',11);	
	$pdf->Cell(30,6,'Alamat ',0,0); $pdf->Cell(5,6,':',0,0,'C'); $pdf->MultiCell(135,6,$d_cus['alamat'],0,'L');
	$pdf->Cell(30,6,'No. Telp/HP ',0,0); $pdf->Cell(5,6,':',0,0,'C'); $pdf->SetFont('Times','I',11);
	$pdf->MultiCell(135,6,$d_cus['kontak'],0,'L'); $pdf->SetFont('Times','',11);	
	$pdf->Cell(30,6,'Teknisi ',0,0); $pdf->Cell(5,6,':',0,0,'C'); $pdf->MultiCell(135,6,substr($dt_t,0,-3),0,'L');	
	$pdf->Cell(0,4,'',0,1); $pdf->SetFillColor(247,255,40); $pdf->SetFont('Times','B',11);
	//end detail service
	//komplain
	$komplain = $d_svc_1['keluhan'];
	$pdf->SetFont('Times','B',11);
	$pdf->Cell(190,7,'Customer Complain',1,1,'C',true);	
	$pdf->SetFont('Times','I',11);
	$pdf->SetWidths(array(190));
	$pdf->SetAligns(array('L'));
	$pdf->Row(array($komplain));
	$pdf->Cell(0,5,'',0,1);
	//end komplain
	//Tabel Rusak
	$qrusak = mysqli_query($conn,"SELECT *, COUNT(*) AS 'trusak' FROM tb_log_service_komponen WHERE id_service = '$idsvc' AND sts = 'rusak'"); $drusak = mysqli_fetch_array($qrusak);
	if($drusak['trusak'] > 0){
		$pdf->SetFont('Times','B',11);
		/*header tabel komponen rusak*/
		$pdf->Cell(10,6,'No',1,0,'C',TRUE);
		$pdf->Cell(55,6,'Type',1,0,'C',TRUE);
		$pdf->Cell(15,6,'Qty',1,0,'C',TRUE);
		$pdf->Cell(110,6,'Description',1,1,'C',TRUE);
		/*end header tabel komponen rusak*/
		$pdf->SetFont('Times','',11);
		/*$pdf->SetFillColor(232,232,232);*/ $nomor = 0;
		$q = mysqli_query($conn,"SELECT * FROM tb_log_service_komponen WHERE id_service = '$idsvc' AND sts = 'rusak'"); $i = 1;
		while($r = mysqli_fetch_array($q)){ $nomor += 1;
			//string untuk type
			$type = "";
			$atype = preg_split('/<[^>]*[^\/]>/i', $r['type_komponen'], -1, PREG_SPLIT_NO_EMPTY | PREG_SPLIT_DELIM_CAPTURE);
			foreach($atype as $i=>$e){ $type .= $e; }
			//end string untuk type
			//string untuk desk
			$desk = "";
			$adesk = preg_split('/<[^>]*[^\/]>/i', $r['description'], -1, PREG_SPLIT_NO_EMPTY | PREG_SPLIT_DELIM_CAPTURE);
			foreach($adesk as $i=>$e){ $desk .= $e; }
			//end string untuk desk
			/*isi data komponen rusak*/
			$pdf->SetWidths(array(10,55,15,110));
			$pdf->SetAligns(array('C','L','C','L'));
			$pdf->Row(array($nomor,$type,$r['qty'],$desk));
			/*end isi data komponen rusak*/
		}
		$pdf->Cell(0,5,'',0,1);		
	}
	//Diagnose / Cause
	if($d_svc_1['diagnose'] != ""){
		$pdf->SetFont('Times','B',11);
		$pdf->Cell(190,7,'Diagnose / Cause',1,1,'C',TRUE);
		//string untuk diagnose
		$diag = "";
		$adiag = preg_split('/<[^>]*[^\/]>/i', $r['diagnose'], -1, PREG_SPLIT_NO_EMPTY | PREG_SPLIT_DELIM_CAPTURE);
		foreach($adiag as $i=>$e){ $diag .= $e; }
		//end string untuk diagnose
		$pdf->SetFont('Times','I',11);
		$pdf->SetWidths(array(190));
		$pdf->SetAligns(array('L'));
		$pdf->Row(array($diag));
		$pdf->Cell(0,5,'',0,1);
	}
	//Technician Action
	if($d_svc_1['technician'] != ""){
		$pdf->SetFont('Times','B',11);
		$pdf->Cell(190,7,'Technician Action',1,1,'C',TRUE);		
		$pdf->SetFont('Times','I',11);
		//string untuk technician
		$tech = "";
		$atech = preg_split('/<[^>]*[^\/]>/i', $r['technician'], -1, PREG_SPLIT_NO_EMPTY | PREG_SPLIT_DELIM_CAPTURE);
		foreach($atech as $i=>$e){ $tech .= $e; }
		$pdf->SetFont('Times','I',11);
		$pdf->SetWidths(array(190));
		$pdf->SetAligns(array('L'));
		$pdf->Row(array($tech));
		$pdf->Cell(0,5,'',0,1);
	}
	//Tabel Ganti
	$qganti = mysqli_query($conn,"SELECT *, COUNT(*) AS 'tganti' FROM tb_log_service_komponen WHERE id_service = '$idsvc' AND sts = 'ganti'"); $dganti = mysqli_fetch_array($qganti);
	if($dganti['tganti'] > 0){
		$pdf->SetFont('Times','B',11);
		/*header tabel komponen ganti*/
		$pdf->Cell(10,6,'No',1,0,'C',TRUE);
		$pdf->Cell(55,6,'Type',1,0,'C',TRUE);
		$pdf->Cell(15,6,'Qty',1,0,'C',TRUE);
		$pdf->Cell(110,6,'Description',1,1,'C',TRUE);
		/*end header tabel komponen ganti*/
		$pdf->SetFont('Times','',11);
		/*$pdf->SetFillColor(232,232,232);*/ $nomor = 0;
		$q1 = mysqli_query($conn,"SELECT * FROM tb_log_service_komponen WHERE id_service = '$idsvc' AND sts = 'ganti'"); $i = 1;
		while($r1 = mysqli_fetch_array($q1)){ $nomor += 1;
			//string untuk type
			$type = "";
			$atype = preg_split('/<[^>]*[^\/]>/i', $r1['type_komponen'], -1, PREG_SPLIT_NO_EMPTY | PREG_SPLIT_DELIM_CAPTURE);
			foreach($atype as $i=>$e){ $type .= $e; }
			//end string untuk type
			//string untuk desk
			$desk = "";
			$adesk = preg_split('/<[^>]*[^\/]>/i', $r1['description'], -1, PREG_SPLIT_NO_EMPTY | PREG_SPLIT_DELIM_CAPTURE);
			foreach($adesk as $i=>$e){ $desk .= $e; }
			//end string untuk desk
			/*isi data komponen ganti*/
			$pdf->SetWidths(array(10,55,15,110));
			$pdf->SetAligns(array('C','L','C','L'));
			$pdf->Row(array($nomor,$type,$r1['qty'],$desk));
			/*end isi data komponen ganti*/
		}
	}
	/*tanda tangan
	$pdf->Ln(10);
	$pdf->SetFont('Times','',11);
	$pdf->Cell(64,4,'TTD Admin',0,0,'C');
	$pdf->Cell(69,4,'TTD Teknisi',0,0,'C');
	$pdf->Cell(64,4,'TTD Customer',0,1,'C');
	$pdf->Cell(10,10,'',0,1);
	$pdf->Cell(64,4,'................',0,0,'C');
	$pdf->Cell(69,4,'................',0,0,'C');
	$pdf->Cell(64,4,'................',0,1,'C');
	$pdf->Cell(0,5,'',0,1);
	$pdf->SetFont('Times','I',10);
	$pdf->SetFillColor(247,255,40);
	$pdf->Cell(0,5,'',0,1);/*end tanda tangan*/

	//hal documentasi
	$cek_gbr = mysqli_query($conn,"SELECT * FROM tb_log_service_gbr WHERE id_service = '$idsvc'");
	$jlh_gbr = mysqli_num_rows($cek_gbr);
	if($jlh_gbr > 0){
		$pdf->AddPage();
		$pdf->Image('../admgolax/assets/img/logo-cmb.png',10,7,40);
		$pdf->Image('qrcode.png',175,13,15);
		$pdf->SetFont('Times','B',12);
		$pdf->Cell(190,0,'WORK ORDER : '.$idsvc,0,1,'R');
		$pdf->Cell(215,25,'',0,1,'R');
		$pdf->SetFont('Times','B',15);
		$pdf->Cell(190,7,'Dokumentasi',0,1,'C');
		$pdf->Cell(215,5,'',0,1,'R');		
		$row = ceil($jlh_gbr / 3); $link = "file_temp/";
		for($i = 1; $i <= $row; $i++){
			$limit = 3; $start = ($i * 3) - 3; $tinggi = ($i * 55) - 5;
			if($i == 1){
				$index = 0;
				$qgbr = mysqli_query($conn,"select * from tb_log_service_gbr where id_service='$idsvc' LIMIT $start, $limit");
				while($rgbr = mysqli_fetch_array($qgbr)){
					$index += 1; $img = str_replace("_","/",$rgbr['link_gbr']); $img = str_replace('data:image/jpeg;base64,', '', $img); $img = str_replace(' ', '+', $img); $data = base64_decode($img); $file = $link.$rgbr['id_service'].$rgbr['no'].'.jpeg'; $success = file_put_contents($file, $data);					
					if($index == 1){
						$pdf->Image($file,15,50,55,50); // x, y, w, h
						@unlink($file);
					} else
					if($index == 2){
						$pdf->Image($file,80,50,55,50); // x, y, w, h
						@unlink($file);
					} else
					if($index == 3){
						$pdf->Image($file,145,50,55,50); // x, y, w, h
						@unlink($file);
					}
				}
			} else {
				$index = 0;
				$qgbr = mysqli_query($conn,"select * from tb_log_service_gbr where id_service='$idsvc' LIMIT $start, $limit");
				while($rgbr = mysqli_fetch_array($qgbr)){
					$index += 1; $img = str_replace("_","/",$rgbr['link_gbr']); $img = str_replace('data:image/jpeg;base64,', '', $img); $img = str_replace(' ', '+', $img); $data = base64_decode($img); $file = $link.$rgbr['id_service'].$rgbr['no'].'.jpeg'; $success = file_put_contents($file, $data);
					if($index == 1){
						$pdf->Image($file,15,$tinggi,55,50); // x, y, w, h
						@unlink($file);
					} else
					if($index == 2){
						$pdf->Image($file,80,$tinggi,55,50); // x, y, w, h
						@unlink($file);
					} else
					if($index == 3){
						$pdf->Image($file,145,$tinggi,55,50); // x, y, w, h
						@unlink($file);
					}
				}
			}
		}
	} $pdf->Output('pdf/'.$idsvc.'.pdf', 'F');
?>