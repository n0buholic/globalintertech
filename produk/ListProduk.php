<?php
	date_default_timezone_set('Asia/Kuala_Lumpur'); require_once("../setty/config.php"); require_once("../setty/func.php");
?>
<h2 class="title text-center" id="HeadingListProduk"></h2>
<div class="row"><div class="col-md-12" id="DataListProduk"></div></div>
<div class="row"><div class="col-md-12" id="HtmlBtn"></div></div>

<script type="text/javascript">
	$(document).ready(function(){

		var Start = 0;

		$.ajax({
			type: 'POST',
			url: 'set/pack',
			data: 'Op=DataProdukUtama&Start='+ Start,
			dataType: 'json',
			cache: false,
			success: function(result){
				$('#HeadingListProduk').html('List Produk');		
				$.each(result.DataProduk, function(Index, Element){
					var Html = '';				
					Html += '<div class="col-sm-4">';
					Html += '	<div class="product-image-wrapper">';
					Html += '		<div class="single-products">';
					Html += '			<div class="productinfo text-center">';
					Html += '				<img src="'+ Element[2] +'" alt="" />';
					Html += '				<h2>IDR '+ Element[1] +'</h2>';
					Html += '				<p>'+ Element[0] +'</p>';
					if(Element[3] > 0){
					Html += '				<button type="button" class="btn btn-default add-to-cart" id="TAddCart" data-idproduk="'+ Element[4] +'"><i class="fa fa-shopping-cart"></i>Tambah ke Cart</button>';
					} else {
					Html += '				<button type="button" class="btn btn-default add-to-cart-default"><i class="fa fa-remove"></i>Stok Habis</button>';
					}
					Html += '			</div>';
					Html += '		</div>';
					Html += '	</div>';
					Html += '</div>';
					$('#DataListProduk').append(Html);
				});	
				if(result.Status == 'lanjut'){
					$('#HtmlBtn').html('<button type="button" class="btn btn-success btn-block TMuatProduk" data-op="DataProdukUtama" data-start="'+ Start +'" data-idkategori="">Muat Produk</button>');
				} else {
					$('#HtmlBtn').html('<div class="alert alert-danger text-center">Data tidak ditemukan.</div>');
				}			
			}
		});

		$('#HtmlBtn').on('click', '.TMuatProduk', function(){
			var IdKategori = $(this).data('idkategori'), Op = $(this).data('op'), Start = $(this).data('start');
			var Start = parseFloat(Start) + 1;
			$.ajax({
				beforeSend: function(){ $('.loading').fadeIn('slow'); },
				type: 'POST',				
				url: 'set/pack',
				data: {Op:Op, IdKategori:IdKategori, Start:Start},
				dataType: 'json',
				cache: false,
				success: function(result){
					$('.loading').fadeOut('slow', function(){
						$.each(result.DataProduk, function(Index, Element){
							var Html = '';				
							Html += '<div class="col-sm-4">';
							Html += '	<div class="product-image-wrapper">';
							Html += '		<div class="single-products">';
							Html += '			<div class="productinfo text-center">';
							Html += '				<img src="'+ Element[2] +'" alt="" />';
							Html += '				<h2>IDR '+ Element[1] +'</h2>';
							Html += '				<p>'+ Element[0] +'</p>';
							if(Element[3] > 0){
							Html += '				<button type="button" class="btn btn-default add-to-cart" id="TAddCart" data-idproduk="'+ Element[4] +'"><i class="fa fa-shopping-cart"></i>Tambah ke Cart</button>';
							} else {
							Html += '				<button type="button" class="btn btn-default add-to-cart-default"><i class="fa fa-remove"></i>Stok Habis</button>';
							}
							Html += '			</div>';
							Html += '		</div>';
							Html += '	</div>';
							Html += '</div>';
							$('#DataListProduk').append(Html);
						});
						if(result.Status == 'lanjut'){
							$('#HtmlBtn').html('<button type="button" class="btn btn-success btn-block TMuatProduk" data-op="'+ Op +'" data-start="'+ Start +'" data-idkategori="'+ IdKategori +'">Muat Produk</button>');
						} else {
							$('#HtmlBtn').html('<div class="alert alert-danger text-center">Data tidak ditemukan.</div>');
						}
					});
				}
			});
		});	

		$('#DataListProduk').on('click', '#TAddCart', function(){
			$('#DataListProduk').html(''); $('#HeadingListProduk').html('Detail Produk'); $('#HtmlBtn').fadeOut('slow');
			var IdProduk = $(this).data('idproduk');
			$.ajax({
				beforeSend: function(){ $('.loading').fadeIn('slow'); },
				type: 'POST',
				url: 'form/FormViewProduk',
				data: {IdProduk:IdProduk},
				cache: false,
				success: function(result){
					$('.loading').fadeOut('slow', function(){
						$('#DataListProduk').html(result);
					})	
				}
			});
		});	

	});
</script>