<?php
	date_default_timezone_set('Asia/Kuala_Lumpur'); require_once("../setty/config.php"); require_once("../setty/func.php");
	$Invoice = $_POST['InvoiceSn']; $DataSn = "";
	$DataSn .= "<option value=''>--Pilih Serial Number--</option>";
	$QInvoice = mysqli_query($conn,"select * from tb_analisis_service_rma where id_service='".$Invoice."'");
	while($RInvoice = mysqli_fetch_array($QInvoice)){
		$DataSn .= "<option value='".$RInvoice['sn_analisis']."'>".$RInvoice['sn_analisis']."</option>";
	}
?>
<div class="row">
	<div class="col-md-12">
		<div class="panel panel-default">
			<div class="panel-body">
				<div class="form-group">
					<label>Pilih Serial Number</label>
					<select class="form-control" id="SerialNumber">
						<?= $DataSn; ?>
					</select>
				</div>				
				<div class="row">
					<div class="col-md-12" id="LoadPagePreview"></div>
				</div>
			</div>
		</div>
	</div>
</div>

<script type="text/javascript">
	$(document).ready(function(){
		$('#SerialNumber').change(function(){
			var Op = 'Trigger_Data', Sub = 'DetailPerSn', Sn = $(this).val(), Invoice = '<?= $Invoice; ?>';
			if(Sn != ''){
				$.ajax({
					type: 'POST',
					url: 'progress',
					data: {Op:Op, Sub:Sub, Sn:Sn, Invoice:Invoice},
					dataType: 'json',
					cache: false,
					success: function(result){
						var html = '', Index = 0;
						html += '<div class="panel panel-default">';
						html += '	<div class="panel-body">';
						html += '		<div class="alert alert-info">';
						html += '			Invoice <b>'+ Invoice +'</b> -> Serial Number <b>'+ Sn +'</b>';
						html += '		</div>';
						html += '		<ul class="timeline">';
						$.each(result, function(Index, Element){
							Index++;
							if(Index % 2 == 0){
								var Mode = ' class="timeline-inverted"';
							} else {
								var Mode = '';
							}
							html += '			<li'+ Mode +'>';
							html += '				<div class="timeline-badge success">';
							html += '					<i class="'+ Element[4] +'"></i>';
							html += '				</div>';
							html += '				<div class="timeline-panel">';
							html += '					<div class="timeline-heading">';
							html += '						<h4 class="timeline-title">'+ Element[3] +'</h4>';
							html += '						<p class="text-right">';
							html += '							<small>Tanggal: '+ Element[0] +'</small>';
							html += '						</p>';
							html += '					</div>';
							html += '					<div class="timeline-body">';
							html += '						<p>'+ Element[1] +'</p>';
							html += '						<p><img src="'+ Element[2] +'" height="150px" alt="" /></p>';
							html += '					</div>';
							html += '				</div>';
							html += '			</li>';
						});
						html += '		</ul>';
						html += '	</div>';
						html += '</div>';
						$('#LoadPagePreview').html(html);
					}
				});
			} else {
				$('#LoadPagePreview').html('');
			}
		});
	});
</script>