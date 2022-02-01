<?php
	date_default_timezone_set('Asia/Kuala_Lumpur'); require_once("../../setty/config.php"); require_once("../../setty/func.php");
?> 

<div class="panel-group category-products PosisiLoad">
	<div class="row" style="padding:10px;">
		<div class="col-md-12"><div class="row" id="LoadDataCheckOut"></div></div>
	</div>
</div>

<script type="text/javascript">
	$(document).ready(function(){

		$('html, body').animate({
			scrollTop: $('.PosisiLoad').offset().top-55
		}, 1000);

		$.ajax({
			type: 'POST',
			url: 'set/pack',
			data: 'Op=DataChekOut',
			dataType: 'json',
			cache: false,
			success: function(result){
				var Html = '';
				$.each(result, function(Index, Element){					
					Html += '<div class="col-md-12" id="Row'+ Element[5] +'" style="margin-bottom:15px;">';
					Html += '	<div class="row">';
					Html += '		<div class="col-md-3">';
					Html += '			<img src="'+ Element[0] +'" alt="" width="100%" />';
					Html += '		</div>';
					Html += '		<div class="col-md-6">';
					Html += '			<table class="table" width="100%">';
					Html += '				<tr>';
					Html += '					<td width="100px">Item</td>';
					Html += '					<td>'+ Element[1] +'</td>';
					Html += '				</tr>';
					Html += '				<tr>';
					Html += '					<td>Harga</td>';
					Html += '					<td>IDR '+ Element[2] +'</td>';
					Html += '				</tr>';
					Html += '				<tr>';
					Html += '					<td>Qty</td>';
					Html += '					<td><div class="wan-spinner SpinQty"><button class="btn btn-danger btn-xs pull-left TKurangSpin" data-idproduk="'+ Element[5] +'" onClick="javascript:void(0)"> - </button><input id="TextQtyArr'+ Element[5] +'" type="text" value="'+ Element[3] +'" data-idproduk="'+ Element[5] +'"><button class="btn btn-success btn-xs TTambahSpin" data-idproduk="'+ Element[5] +'" onClick="javascript:void(0)"> + </button></div></td>';
					Html += '				</tr>';
					Html += '				<tr>';
					Html += '					<td colspan="2"><button type="button" class="btn btn-xs btn-danger pull-right THapus" id="#Row'+ Element[5] +'" data-idproduk="'+ Element[5] +'"><i class="fa fa-remove"></i> Hapus</button></td>';
					Html += '				</tr>';
					Html += '			</table>';
					Html += '		</div>';
					Html += '		<div class="col-md-3">';
					Html += '			Total <hr /> <span class="pull-right">IDR <b id="HtmlTotalArr'+ Element[5] +'">'+ Element[4] +'</b></span><br />';
					Html += '			<input type="hidden" value="'+ Element[6] +'" id="TextTotalArr'+ Element[5] +'" class="ArrTotal" />' ;
					Html += '		</div>';
					Html += '	</div>';
					Html += '</div>';					
				});
				Html += '<div class="col-md-6"></div>';
				Html += '<div class="col-md-6">';
				Html += '	<table class="table" width="100%">';
				Html += '		<tr>';
				Html += '			<td width="100px">Total Bayar</td>';
				Html += '			<td>IDR <b class="pull-right" id="HtmlTotalAll">0</b></td>';
				Html += '		</tr>';
				Html += '	</table>';
				Html += '</div>';
				$('#LoadDataCheckOut').html(Html);

				var TotalAll = 0;
				$('.ArrTotal').each(function(){
					TotalAll += parseFloat($(this).val());
				});
				$('#HtmlTotalAll').html(TotalAll); $('#HtmlTotalAll').simpleMoneyFormat();

				$(".SpinQty").WanSpinner({
					// maximum value 
					//maxValue: 9,

					// minimum value
					minValue: 1,

					// custom step
					step: 1,

					// starting value
					//start: 1,

					// width of the text input
					inputWidth: 40,

					// callbakcs
					plusClick: function(element, val, idproduk) {
						$.ajax({
							type: 'POST',
							url: 'set/pack',
							data: 'Op=TambahQtyCart&IdProduk='+ idproduk +'&Qty='+ val,
							cache: false,
							dataType: 'json',
							success: function(result){
								if(result.Status == 'ready'){
									$('#HtmlTotalArr'+ idproduk).html(result.Total);
									$('#TextTotalArr'+ idproduk).val(result.Total1);	

									$('#HtmlTotalQty').html(result.TotalQty);

									var TotalAll = 0;
									$('.ArrTotal').each(function(){
										TotalAll += parseFloat($(this).val());
									});
									$('#HtmlTotalAll').html(TotalAll); $('#HtmlTotalAll').simpleMoneyFormat();

								} else {
									$('#TextQtyArr'+ idproduk).val(result.Stok);							
								}
								return true;
							}
						});						
					},

					minusClick: function(element, val, idproduk) {
					  $.ajax({
							type: 'POST',
							url: 'set/pack',
							data: 'Op=TambahQtyCart&IdProduk='+ idproduk +'&Qty='+ val,
							cache: false,
							dataType: 'json',
							success: function(result){
								if(result.Status == 'ready'){
									$('#HtmlTotalArr'+ idproduk).html(result.Total);
									$('#TextTotalArr'+ idproduk).val(result.Total1);

									$('#HtmlTotalQty').html(result.TotalQty);	

									var TotalAll = 0;
									$('.ArrTotal').each(function(){
										TotalAll += parseFloat($(this).val());
									});
									$('#HtmlTotalAll').html(TotalAll); $('#HtmlTotalAll').simpleMoneyFormat();

								} else {
									$('#TextQtyArr'+ idproduk).val(result.Stok);							
								}
								return true;
							}
						});
					},

					exceptionFun: function(exp) {
					  return true;
					},

					valueChanged: function(element, val, idproduk) {
					  	$.ajax({
							type: 'POST',
							url: 'set/pack',
							data: 'Op=TambahQtyCart&IdProduk='+ idproduk +'&Qty='+ val,
							cache: false,
							dataType: 'json',
							success: function(result){
								if(result.Status == 'ready'){
									$('#HtmlTotalArr'+ idproduk).html(result.Total);
									$('#TextTotalArr'+ idproduk).val(result.Total1);	

									$('#HtmlTotalQty').html(result.TotalQty);

									var TotalAll = 0;
									$('.ArrTotal').each(function(){
										TotalAll += parseFloat($(this).val());
									});
									$('#HtmlTotalAll').html(TotalAll); $('#HtmlTotalAll').simpleMoneyFormat();

								} else {
									$('#TextQtyArr'+ idproduk).val(result.Stok);							
								}
								return true;
							}
						});
					}
				});

			}
		});

		$('#LoadDataCheckOut').on('click', '.THapus', function(){
			var RowIndex = $(this).attr('id'), IdProduk = $(this).data('idproduk'), Op = 'HapusProdukCheckOut';
			$.ajax({
				beforeSend: function(){ $('.loading').fadeIn('slow'); },
				type: 'POST',
				url: 'set/pack',
				data: {Op:Op, IdProduk:IdProduk},
				dataType: 'json',
				cache: false,
				success: function(result){
					$('.loading').fadeOut('slow', function(){
						$(RowIndex).remove(); $('#HtmlTotalQty').html(result.TotalQty);
						$.gritter.add({
							title: result.Title,
							text: result.Text,
							sticky: false,
							class_name: result.Gritter,
							time: 5000
						});

						var TotalAll = 0;
						$('.ArrTotal').each(function(){
							TotalAll += parseFloat($(this).val());
						});
						$('#HtmlTotalAll').html(TotalAll); $('#HtmlTotalAll').simpleMoneyFormat();

						if(TotalAll == 0){ 
							$('#HeadingListProduk').html('List Produk');
							$.ajax({
				    			url: 'ListProduk',
				    			cache: false,
				    			success: function(result){
				    				$('#ListProduk').html(result);
				    			}
				    		});
						}
					});
				}
			});
		});

	});
</script>