<?php
	date_default_timezone_set('Asia/Kuala_Lumpur'); require_once("../setty/config.php"); require_once("../setty/func.php");
?>
<h2>Kategori</h2>
<div class="panel-group category-products" id="accordian"><!--category-productsr-->
	<div class="panel panel-default" id="DataListMenu"></div>
</div><!--/category-products-->
						
<div class="shipping text-center"><!--shipping-->
	<?php $link = "images/logo-cmb.png"; $src = encode_base64($link); ?>
	<img src="<?= $src; ?>" width="100%" alt="" />
</div><!--/shipping-->

<script type="text/javascript">
	$(document).ready(function(){

		$.ajax({
			type: 'POST',
			url: 'set/pack',
			data: 'Op=ListMenu',
			dataType: 'json',
			cache: false,
			success: function(result){
				$.each(result, function(Index, Element){
					var Html = '';
					Html += '<div class="panel panel-default">';
					Html += '	<div class="panel-heading">';
					Html += '		<h4 class="panel-title" id="TMenuProduk" data-idkategori="'+ Element[0] +'" data-kategori="'+ Element[1] +'">'+ Element[1] +'</h4>';
					Html += '	</div>';
					Html += '</div>';
					$('#DataListMenu').append(Html);
				});
			}
		});

		$('#DataListMenu').on('click', '#TMenuProduk', function(){			
			var IdKategori = $(this).data('idkategori'), Kategori = $(this).data('kategori'), Op = 'DataProdukFilter', Start = 0;			
			$.ajax({
				beforeSend: function(){ $('.loading').fadeIn('slow'); },
				type: 'POST',				
				url: 'set/pack',
				data: {Op:Op, IdKategori:IdKategori, Start:Start},
				dataType: 'json',
				cache: false,
				success: function(result){ 
					$('.loading').fadeOut('slow', function(){
						$('#DataListProduk').html(''); $('#HeadingListProduk').html(Kategori);$('#HtmlBtn').fadeIn('slow');			
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
							$('#HtmlBtn').html('<button type="button" class="btn btn-success btn-block TMuatProduk" data-op="DataProdukFilter" data-start="'+ result.Start +'" data-idkategori="'+ IdKategori +'">Muat Produk</button>');
						} else {
							$('#HtmlBtn').html('<div class="alert alert-danger text-center">Data tidak ditemukan.</div>');
						}
					});
				}
			});
		});		

		$('.TCheckOut').on('click', function(){			
			var TotalQty = parseFloat($('#HtmlTotalQty').html());
			if(TotalQty > 0){
				$('#DataListProduk').html(''); $('#HeadingListProduk').html('Check Out'); $('#HtmlBtn').fadeOut('slow');
				$.ajax({
					beforeSend: function(){ $('.loading').fadeIn('slow'); },
					type: 'POST',
					url: 'form/FormCheckOut',
					cache: false,
					success: function(result){
						$('.loading').fadeOut('slow', function(){							
							$('#DataListProduk').html(result);
						});
					}
				});
			} else {
				$.gritter.add({
					title: '<i class="fa fa-info"></i> Pemberitahuan',
					text: 'Keranjang masih kosong.',
					sticky: false,
					class_name: 'gritter',
					time: 5000
				});				
			}
		});

	});
</script>						