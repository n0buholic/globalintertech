<?php
	date_default_timezone_set('Asia/Kuala_Lumpur'); require_once("../setty/config.php"); require_once("../setty/func.php");
	$op = $_POST['op'];
	if($op == "trigger_data"){ $IdSvc = $_POST['IdSvc'];
		$q = mysqli_query($conn,"select tb_log_service_adm.*, tb_log_service.* from tb_log_service_adm, tb_log_service where tb_log_service_adm.id_service=tb_log_service.id_service and tb_log_service.id_service='".$IdSvc."' LIMIT 1");
		$d = mysqli_fetch_array($q);
		$Json = array("TglDaftar"=> formattgl($d['tgl_service']), "Keluhan"=> $d['keluhan'], "TglPengerjaan"=> formattgl($d['tgl_proses']), "TglSelesai"=> formattgl($d['tgl_end_service']), "Diagnose"=> $d['diagnose'], "Action"=> $d['technician'], "So"=> $d['so'], "Bayar"=> number_format($d['nominal'],0,',','.'), "Lampiran"=> $d['doc_lsa']);
		echo json_encode($Json);
	} else 
	if($op == "tTeknisi"){ $IdSvc = $_POST['IdSvc'];
?>
		<div class="row">
			<div class="col-md-12">
				<div class="panel panel-default">
					<div class="panel-heading"><i class="icon-list-alt"></i> <b>Teknisi yang mengerjakan</b></div>
					<div class="panel-body" id="DataTeknisi"></div>
					<div class="panel-footer"><button class="btn btn-xs btn-grad btn-danger tback"><i class="icon-remove"></i> Tutup</button></div>
				</div>
			</div>
		</div>
		<script type="text/javascript">
			$(document).ready(function(){
				$.ajax({
					url: 'aksi',
					method: 'POST',
					data: 'op=data_teknisi&IdSvc=<?= $IdSvc; ?>',
					dataType: 'json',
					cache: false,
					success: function(result){
						var html = '', index = 1;
						html += '<table class="table table-striped" width="100%">';
						html += '	<tr>';
						html += '		<th width="20px">No</th><th width="150px">Foto</th><th>Nama</th>';
						html += '	</tr>';
						$.each(result, function(i, element){ 
							if(element[1] != ''){
								html += '	<tr>';
								html += '		<td>'+ index++ +'</td><td><img src='+ element[1] +' width="100%" /></td><td>'+ element[0] +'</td>';
								html += '	</tr>';
							} else if(element[1] == ''){
								html += '	<tr>';
								html += '		<td>'+ index++ +'</td><td>Tanpa Foto</td><td>'+ element[0] +'</td>';
								html += '	</tr>';
							}
						});
						html += '</table>';
						$('#DataTeknisi').html(html);
					}
				});
				$('.tback').click(function(){
					var tombol = ''; $('#TombolTekKeg').html('');
					tombol += '<button type="button" class="btn btn-grad btn-success tTeknisi"><i class="icon-cogs"></i> Data Teknisi</button>';
					$('#TombolTekKeg').append(tombol);
				});
			});
		</script>
<?php
	} else
	if($op == "data_teknisi"){ $IdSvc = $_POST['IdSvc']; $DtJson = array();
		$q = mysqli_query($conn,"select tb_user.*, tb_log_service_teknisi.* from tb_user, tb_log_service_teknisi where tb_user.id_teknisi=tb_log_service_teknisi.id_teknisi and tb_log_service_teknisi.id_service='".$IdSvc."'");
		while($r = mysqli_fetch_array($q)){
			$Json = array();
			$Json[] = $r['nama'];
			$Json[] = str_replace("_","/",$r['foto_u']);
			$DtJson[] = $Json;
		}
		echo json_encode($DtJson);
	} else
	if($op == "tLampiran"){ $IdSvc = $_POST['IdSvc'];
		$q = mysqli_query($conn,"select * from tb_log_service_adm where id_service='".$IdSvc."' LIMIT 1");
		$d = mysqli_fetch_array($q); $src = str_replace("_", "/", $d['doc_lsa']);
?>
		<embed src="<?php echo $src; ?>" width="100%" height="500px" /><br />
		<button class="btn btn-grad btn-danger tbackLampiran"><i class="icon-remove"></i> Tutup</button>
		<script type="text/javascript">
			$(document).ready(function(){
				$('.tbackLampiran').click(function(){
					$('#TombolLampiran').html('');
					$('#TombolLampiran').html('<button type="button" class="btn btn-grad btn-success tLampiran"><i class="icon-list-alt"></i> Lampiran</button>');
				});
			});
		</script>
<?php
	}
?>