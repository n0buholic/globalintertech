<?php
	date_default_timezone_set('Asia/Kuala_Lumpur'); require_once("../../setty/config.php"); require_once("../../setty/func.php");
	$IdProduk = $_POST['IdProduk'];
?>
<div class="row PosisiLoad">
	<div class="product-details">
		<div class="col-md-5" id="myGallery"></div>
		<div class="col-md-7">
			<div class="product-information"><!--/product-information-->
				<h2 id="HtmlProduk"></h2>
				<span><p><span id="HtmlHarga"></span></p></span>
				<p>
					<label>Quantity:</label>
					<div class="wan-spinner SpinQty">
						<button class="btn btn-danger btn-xs pull-left TKurangSpin" data-idproduk="<?= $IdProduk; ?>" onClick="javascript:void(0)"> - </button><input type="text" id="TextQtyCart" data-idproduk="<?= $IdProduk; ?>" value="1"><button class="btn btn-success btn-xs TTambahSpin" data-idproduk="<?= $IdProduk; ?>" onClick="javascript:void(0)"> + </button>						
					</div>
					<button type="button" class="btn btn-fefault cart" id="TTambahCart"><i class="fa fa-shopping-cart"></i> Tambah ke Cart</button>
				</p>
				<p><b>Status: </b> Stok Ada</p>
				<p><b>Kondisi:</b> Baru</p>
				<p><b>Kategori:</b> <b id="HtmlKategori"></b></p>
			</div><!--/product-information-->
		</div>
	</div>	
</div>

<div class="row">
	<div class="col-sm-12">
		<div class="category-tab shop-details-tab"><!--category-tab-->		
			<ul class="nav nav-tabs">
				<li class="active"><a href="#HtmlDeskripsi" data-toggle="tab">Deskripsi</a></li>
			</ul>			
			<div class="tab-content">
				<div class="col-md-12">
					<div class="tab-pane fade in" id="HtmlDeskripsi"></div>
				</div>
			</div>		
		</div>
	</div>
</div>

<script type="text/javascript">
	$(document).ready(function(){

		var IdProduk = '<?= $IdProduk; ?>', Stok = 0;

		$('html, body').animate({
			scrollTop: $('.PosisiLoad').offset().top-55
		}, 1000);

		$(".SpinQty").WanSpinner({
			// minimum value
			minValue: 1,

			// custom step
			step: 1,

			// starting value
			start: 1,

			// width of the text input
			inputWidth: 40,

			// callbakcs
			plusClick: function(element, val, idproduk) {
				$.ajax({
					type: 'POST',
					url: 'set/pack',
					data: 'Op=TambahProdukView&IdProduk='+ idproduk +'&Qty='+ val,
					cache: false,
					dataType: 'json',
					success: function(result){
						if(result.Status == 'limit'){ $('#TextQtyCart').val(result.Stok); }

						if(result.QtyCart > 0){ $('#HtmlTotalQty').html(result.TotalQty); }

						return true;
					}
				});						
			},

			minusClick: function(element, val, idproduk) {
				$.ajax({
					type: 'POST',
					url: 'set/pack',
					data: 'Op=TambahProdukView&IdProduk='+ idproduk +'&Qty='+ val,
					cache: false,
					dataType: 'json',
					success: function(result){
						if(result.Status == 'limit'){ $('#TextQtyCart').val(result.Stok); }

						if(result.QtyCart > 0){ $('#HtmlTotalQty').html(result.TotalQty); }

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
					data: 'Op=TambahProdukView&IdProduk='+ idproduk +'&Qty='+ val,
					cache: false,
					dataType: 'json',
					success: function(result){
						if(result.Status == 'limit'){ $('#TextQtyCart').val(result.Stok); }

						if(result.QtyCart > 0){ $('#HtmlTotalQty').html(result.TotalQty); }

						return true;
					}
				});
			}
		});

		$.ajax({
			type: 'POST',
			url: 'set/pack',
			data: 'Op=TriggerData&Sub=DataPerProduk&IdProduk='+ IdProduk,
			dataType: 'json',
			cache: false,
			success: function(result){
				$('#HtmlProduk').html(result.Produk); $('#HtmlHarga').html('IDR '+ result.HargaJual);
				$('#HtmlKategori').html(result.Kategori); $('#HtmlDeskripsi').html(result.Deskripsi);

				if(result.QtyCart > 0){
					$('#TTambahCart').attr('disabled', true); $('#TextQtyCart').val(result.QtyCart);
				}

				Stok += parseFloat(result.Stok);

				var Gambar = [];
				$.each(result.Foto, function(Index, Element){
					Gambar.push(Element[0]);
				});

				$('#myGallery').zoomy(Gambar);
			}
		});	

		$('#TTambahCart').on('click', function(){
			var Op = 'AddToCart', Qty = $('#TextQtyCart').val();
			if(Qty > 0){
				$.ajax({
					type: 'POST',
					url: 'set/pack',
					data: {Op:Op, IdProduk:IdProduk, Qty:Qty, Stok:Stok},
					dataType: 'json',
					cache: false,
					success: function(result){
						if(result.Status == 'oke'){ $('#HtmlTotalQty').html(result.TotalQty); }
						$.gritter.add({
							title: result.Title,
							text: result.Text,
							sticky: false,
							class_name: result.Gritter,
							time: 5000
						});
					}
				});				
			}
		});

	});
</script>