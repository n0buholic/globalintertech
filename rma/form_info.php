<?php
	date_default_timezone_set('Asia/Kuala_Lumpur'); require_once("../setty/config.php"); require_once("../setty/func.php");
?>
<div class="row" style="margin-top:2em;">
	<div class="col-md-3"></div>
		<div class="col-md-6">
			<form role="form" id="frm-block">
				<div class="form-group">
					<div class="input-group">
						<input id="brand" name="brand" type="text" placeholder="masukkan SN atau ID Service" class="form-control" />
						<span class="input-group-btn"><button class="btn btn-success" type="submit"><i class="icon-search"></i></button></span>
					</div>
				</div>
			</form>
		</div>
	<div class="col-md-3"></div>
</div>
<div class="row">
	<div class="col-md-12"><div class="alert alert-info"><i class="icon-print"></i> Preview Laporan</div></div>
</div>
<div class="row">
	<div class="col-md-12" id="LoadPageSub"></div>
</div>
<script type="text/javascript">		
	$(document).ready(function(){	

		$(function () { formValidation(); });

		$('#frm-block').on('submit', (function(e){
			e.preventDefault();
			var InvoiceSn = $('#brand').val();
			if(InvoiceSn != ''){
				var Op = 'CekIdInput';
				$.ajax({
					type: 'POST',
					//beforeSend: function(){ $('.loading').fadeIn('slow'); },
					url: 'progress',
					data: {Op:Op, InvoiceSn:InvoiceSn},
					dataType: 'json',
					cache: false,
					success: function(result){
						if(result.Ada > 0){
							if(result.Status == 'Invoice'){
								$.ajax({
									type: 'POST',
									url: 'laporan_data_sn',
									data: {InvoiceSn:InvoiceSn},
									cache: false,
									success: function(result){
										$('#LoadPageSub').html(result);
									}
								});
							} else {
								if(result.TotalSn == 1){
									var Op = 'Trigger_Data', Sub = 'DetailPerSn', Invoice = result.Invoice;
									$.ajax({
										type: 'POST',
										url: 'progress',
										data: {Op:Op, Sub:Sub, Sn:InvoiceSn, Invoice:Invoice},
										dataType: 'json',
										cache: false,
										success: function(result){
											var html = '', Index = 0;
											html += '<div class="panel panel-default">';
											html += '	<div class="panel-body">';
											html += '		<div class="alert alert-info">';
											html += '			Invoice <b>'+ Invoice +'</b>';
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
											$('#LoadPageSub').html(html);
										}
									});
								} else {
									var Op = 'Trigger_Data', Sub = 'DetailPerSn', Sn = result.Invoice;
									$.ajax({
										type: 'POST',
										url: 'progress',
										data: {Op:Op, Sub:Sub, Sn:Sn, Invoice:InvoiceSn},
										dataType: 'json',
										cache: false,
										success: function(result){
											var html = '', Index = 0;
											html += '<div class="panel panel-default">';
											html += '	<div class="panel-body">';
											html += '		<div class="alert alert-info">';
											html += '			Serial Number <b>'+ Sn +'</b>';
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
											$('#LoadPageSub').html(html);
										}
									});
								}
							}
						} else {
							$('.loading').fadeOut('slow', function(){
								var html = '';
								html += '<div class="alert alert-danger text-center">';
								html += '	<i class="icon-remove"></i> Data tidak ditemukan.';
								html += '</div>';
								$('#LoadPageSub').html(html);
							});
						}
					}
				});
			}
		}));

	});
</script>