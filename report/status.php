<?php
	date_default_timezone_set('Asia/Kuala_Lumpur'); require_once("../setty/config.php"); require_once("../setty/func.php"); $IdSvc = $_POST['IdSvc'];
	$q1 = mysqli_query($conn,"select * from tb_log_service_adm where id_service='".$IdSvc."'");
	$row1 = mysqli_num_rows($q1);
	if($row1 > 0){
		$q = mysqli_query($conn,"select * from tb_log_service where id_service='".$IdSvc."' LIMIT 1");
		$d = mysqli_fetch_array($q);
		if($d['status'] > 1 AND $IdSvc != ""){
?>
<div class="table-resposive">
	<table class="table table-triped">
		<tr><td width="150px">Tgl. Terdaftar</td><td id="HtmlTglDaftar"></td></tr>
		<tr><td>Keluhan</td><td id="HtmlKeluhan"></td></tr>
		<tr><td>Tgl. Pengerjaan</td><td id="HtmlTglPengerjaan"></td></tr>
		<tr><td colspan="2" id="TombolTekKeg"></td></tr>
		<tr><td>Tgl. Selesai</td><td id="HtmlTglSelesai"></td></tr>
		<!--<tr><td>Diagnose</td><td id="HtmlDiagnose"></td></tr>
		<tr><td>Action</td><td id="HtmlAction"></td></tr>!-->
		<tr><td colspan="2"><i class="icon-money"></i> Administrasi</td></tr>
		<tr><td>Nomor SO</td><td id="HtmlSo"></td></tr>
		<tr><td>Total Bayar</td><td id="HtmlBayar"></td></tr>
		<tr><td colspan="2" id="TombolLampiran"></td></tr>
	</table>
</div>
<script type="text/javascript">
	$(document).ready(function(){
		$.ajax({
			url: 'aksi',
			method: 'POST',
			data: 'op=trigger_data&IdSvc=<?= $IdSvc; ?>',
			dataType: 'json',
			cache: false,
			success: function(resutl){
				$('#HtmlTglDaftar').html('<i class="icon-caret-right"></i> '+ resutl.TglDaftar);
				$('#HtmlKeluhan').html('<i class="icon-caret-right"></i> '+ resutl.Keluhan);
				$('#HtmlTglPengerjaan').html('<i class="icon-caret-right"></i> '+ resutl.TglPengerjaan);
				var tombol = '';
				tombol += '<button type="button" class="btn btn-grad btn-success tTeknisi"><i class="icon-cogs"></i> Data Teknisi</button>';
				$('#TombolTekKeg').append(tombol);
				$('#HtmlTglSelesai').html('<i class="icon-caret-right"></i> '+ resutl.TglSelesai);
				//$('#HtmlDiagnose').html('<i class="icon-caret-right"></i> '+ resutl.Diagnose);
				//$('#HtmlAction').html('<i class="icon-caret-right"></i> '+ resutl.Action);
				$('#HtmlSo').html('<i class="icon-caret-right"></i> '+ resutl.So);
				$('#HtmlBayar').html('<i class="icon-caret-right"></i> Rp. <b>'+ resutl.Bayar +'</b>');				
				if(resutl.Lampiran != ''){
					$('#TombolLampiran').html('<button type="button" class="btn btn-grad btn-success tLampiran"><i class="icon-list-alt"></i> Lampiran</button>');
				} else {
					$('#TombolLampiran').html('<button type="button" class="btn btn-grad btn-default"><i class="icon-list-alt"></i> Lampiran</button>');
				}
			}
		});
		$('#TombolLampiran').on('click', '.tLampiran', function(){
			var IdSvc = '<?= $IdSvc; ?>';
			$.ajax({
				beforeSend: function(){ $('.loading').fadeIn('slow'); },
				url: 'aksi',
				method: 'POST',
				data: 'op=tLampiran&IdSvc='+ IdSvc,
				cache: false,
				success: function(result){
					$('.loading').fadeOut('slow', function(){
						$('#TombolLampiran').html(result);
					});
				}
			});
		});
		$('#TombolTekKeg').on('click', '.tTeknisi', function(){
			var IdSvc = '<?= $IdSvc; ?>';
			$.ajax({
				beforeSend: function(){ $('.loading').fadeIn('slow'); },
				url: 'aksi',
				method: 'POST',
				data: 'op=tTeknisi&IdSvc='+ IdSvc,
				cache: false,
				success: function(result){
					$('.loading').fadeOut('slow', function(){
						$('#TombolTekKeg').html(result);
					});
				}
			});
		});
	});
</script>
<?php
		} else {
?>
<center><h4>ID Service tidak ditemukan.</h4></center>
<?php
		}
	} else {
?>
<center><h4>ID Service tidak ditemukan.</h4></center>
<?php
	}
?>