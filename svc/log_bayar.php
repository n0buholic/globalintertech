<?php
	date_default_timezone_set('Asia/Kuala_Lumpur'); require_once("../setty/config.php"); require_once("../setty/func.php");
	$id = $_GET['id'];
?>
<div class="row"><div class="col-md-12"><i class="icon-list-alt"></i> Log Pembayaran Anda<hr /></div></div>
<ul class="chat">	
<?php
	$q1 = mysqli_query($conn,"select * from tb_log_pembayaran where invoice='$id' and sts=0 order by tgl desc"); $bayar = 0; $no = 1;
	while($r1 = mysqli_fetch_array($q1)){
		$tgl = $r1['tgl']; $day = date('D', strtotime($tgl)); $hari = hari($day);
				$tgl1 = explode(" ", $r1['tgl']);
				if($no++ % 2 == 0){
					echo "<li class='left clearfix'>
								<div class='chat-body clearfix' style='margin-left:0em;'>
									<div class='header'>
										<strong class='primary-font '>Rp.".number_format($r1['nominal'],0,',','.')."</strong>
										<small class='pull-right text-muted label label-info'>
											<i class='icon-time'></i> $hari, ".formattgl($tgl1[0])." / ".$tgl1[1]."
										</small>
									</div>
									<br />
									<p><i>$r1[ket]</i></p>
								</div>
							</li>";
					$bayar += $r1['nominal'];
				} else {
					echo "<li class='right clearfix'>
								<div class='chat-body clearfix' style='margin-right:0em;'>
									<div class='header'>
										<small class=' text-muted label label-info'>
											<i class='icon-time'></i> $hari, ".formattgl($tgl1[0])." / ".$tgl1[1]."
										</small>
										<strong class='pull-right primary-font'>Rp.".number_format($r1['nominal'],0,',','.')."</strong>
									</div>
									<br />
									<p><i>$r1[ket]</i></p>
								</div>
							</li>";
					$bayar += $r1['nominal'];
				}
	}
?>
		</ul>