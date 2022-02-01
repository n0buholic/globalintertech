<?php
	date_default_timezone_set('Asia/Kuala_Lumpur'); require_once("../setty/config.php"); require_once("../setty/func.php");

	$TotalQty = 0;

	$q = mysqli_query($conn,"select * from tb_produk");
	while($r = mysqli_fetch_array($q)){
		if(isset($_COOKIE[$r['id_produk']])){
			$TotalQty += $_COOKIE[$r['id_produk']];
		}
	}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>CMB Shopper</title>
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/font-awesome.min.css" rel="stylesheet">
    <link href="css/prettyPhoto.css" rel="stylesheet">
    <link href="css/price-range.css" rel="stylesheet">
    <link href="css/animate.css" rel="stylesheet">
	<link href="css/main.css" rel="stylesheet">
	<link href="css/responsive.css" rel="stylesheet">     
	<link href="plugin/zoomy/zoomy.css" rel="stylesheet">
	<link href="../admgolax/assets/plugins/gritter/css/jquery.gritter.css" rel="stylesheet" />
	<link href="plugin/wanspinner/wan-spinner.css" rel="stylesheet">

    <?php $link = "images/logo-cmb.png"; $src = encode_base64($link); ?>
  	<link rel="shortcut icon" href="<?= $src; ?>">
</head>

<body>
	<header id="header"><!--header-->		
		<div class="header_top"><!--header_top-->
			<div class="container">
				<div class="row">
					<div class="col-sm-6">
						<div class="contactinfo">
							<ul class="nav nav-pills">
								<li><a href="#"><i class="fa fa-phone"></i> 0813 5192 6565</a></li>
								<li><a href="#"><i class="fa fa-phone"></i> 0821 8517 8888</a></li>
							</ul>
						</div>
					</div>
					<div class="col-sm-6">
						<div class="contactinfo">
							<ul class="nav nav-pills pull-right">
								<li class="TCheckOut"><a href="#" style="font-size:15px;"><i class="fa fa-shopping-cart"></i> <b id="HtmlTotalQty"><?= $TotalQty; ?></b></a></li>
							</ul>
						</div>
					</div>
				</div>
			</div>
		</div><!--/header_top-->
		
		<div class="header-middle"><!--header-middle-->
			<div class="container">
				<div class="row">
					<div class="col-sm-12">
						<div class="logo pull-left">
							<?php $link = "images/logo-cmb.png"; $src = encode_base64($link); ?>
							<a href="./"><img src="<?= $src; ?>"  height="100px" alt="" /></a>
						</div>
					</div>
				</div>
			</div>
		</div><!--/header-middle-->
	</header><!--/header-->
	
	<section id="slider"><!--slider-->
		<div class="container">
			<div class="row">
				<div class="col-sm-12" id="HtmlLoadSlider"></div>
			</div>
		</div>
	</section><!--/slider-->
	
	<section style="margin-bottom: 15px;">
		<div class="container">
			<div class="row">
				<div class="col-sm-3"><div class="left-sidebar" id="ListMenu"></div></div>				
				<div class="col-sm-9 padding-right">					
					<div class="features_items" id="ListProduk"></div><!--features_items-->					
				</div>
			</div>
		</div>
	</section>
	
	<footer id="footer"><!--Footer-->		
		<div class="footer-widget">
			<div class="container">
				<div class="row">
					<div class="col-md-6">
						<h2 class="title">Lokasi</h2>
						<div id="map"></div>
					</div>
					<div class="col-md-6">
						<h2 class="title">Kunjungi atau Hubungi di</h2>
						<p>
							<table class="table sa">
								<tr class="info">
									<td class="team-2"><i class="fa fa-map-marker"></i>&nbsp;Address</td>
								</tr>
								<tr>
									<td class="team-1"><strong>Banjarmasin:</strong><br />Jalan Kolonel Sugiono No.78 Banjarmasin, Kalimantan Selatan 14462, Indonesia.<br /><br /><strong>Samarinda:</strong><br />Kardie Oenins No.37 Samarinda, Kalimantan Timur 75124, Indonesia.<br /><br /><strong>Jakarta:</strong><br />Jalan Kopi Tiang Bendera, Ruko Plaza Kota Blok B.10, DKI Jakarta 11180, Indonesia.</td>
								</tr>
								<tr class="info">
									<td class="team-2"><i class="fa fa-list-alt"></i>&nbsp;Contact #Whatsapp</td>
								</tr>
								<tr><td class="team-1"><a href="https://api.whatsapp.com/send?phone=6282131091940&text=Hai, Aulia!"><i class="fa fa-mobile"></i> 0821 3109 1940 ( Aulia )</a></td></tr>
								<tr><td class="team-1"><a href="https://api.whatsapp.com/send?phone=6282185178888&text=Hai, Marketing!"><i class="fa fa-mobile"></i> 0821 8517 8888 ( Marketing ) </a></td></tr>
								<tr><td class="team-1"><a href="https://api.whatsapp.com/send?phone=6281351926565&text=Hai, Marketing!"><i class="fa fa-mobile"></i> 0813 5192 6565 ( Marketing )</a></td></tr>
								<tr><td class="team-1"><a href="https://api.whatsapp.com/send?phone=6282153050685&text=Hai, Marketing!"><i class="fa fa-mobile"></i> 0821 5305 0685 ( CS )</a></td></tr>
							</table>
						</p>
					</div>
				</div>
			</div>
		</div>
		
		<div class="footer-bottom">
			<div class="container">
				<div class="row">
					<p class="text-center">Copyright © 2020 CMB</p>
				</div>
			</div>
		</div>
		
	</footer><!--/Footer-->

	<div class="loading"></div>

	<div class="modal fade" id="modal_form">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
					<h4 class="modal-title" id="H2"></h4>
				</div>
				<div class="modal-body load_modal_form"></div>						
			</div>
		</div>
	</div>
  
    <script src="js/jquery.js"></script>
	<script src="js/bootstrap.min.js"></script>
	<script src="js/jquery.scrollUp.min.js"></script>
	<script src="js/price-range.js"></script>
    <script src="js/jquery.prettyPhoto.js"></script>
    <script src="js/main.js"></script>
    <script src="plugin/zoomy/zoomy.js"></script>
    <script src="../admgolax/assets/plugins/gritter/js/jquery.gritter.js"></script>
    <script src="js/simple.money.format.js"></script>
    <script src="plugin/wanspinner/wan-spinner.js"></script>

    <script type="text/javascript">
    	$(document).ready(function(){
    		$.ajax({
		    	url: 'SliderShopper',
		    	cache: false,
		    	success: function(result){
		    		$('#HtmlLoadSlider').html(result);
		    		$.ajax({
		    			url: 'menu',
		    			cache: false,
		    			success: function(result){
		    				$('#ListMenu').html(result);
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
    		
    		var markers = 	[
								['Jalan Kolonel Sugiono No.78 Banjarmasin, Kalimantan Selatan 14462, Indonesia', -3.327125, 114.597786],
								['Jl. Kardie Oening No.37 Samarinda, Kalimantan Timur 75124, Indonesia', -0.472247, 117.135574]
					  		 ];
 
			function initMap() {
				var mapCanvas = document.getElementById('map');
				var mapOptions = { mapTypeId: google.maps.MapTypeId.ROADMAP }     
				var map = new google.maps.Map(mapCanvas, mapOptions)
 
				var infowindow = new google.maps.InfoWindow(), marker, i;
				var bounds = new google.maps.LatLngBounds(); // diluar looping
				for (i = 0; i < markers.length; i++) {  
					pos = new google.maps.LatLng(markers[i][1], markers[i][2]);
					bounds.extend(pos); // di dalam looping
					marker = new google.maps.Marker({
						position: pos,
						map: map
					});
					google.maps.event.addListener(marker, 'click', (function(marker, i) {
						return function() {
							infowindow.setContent(markers[i][0]);
							infowindow.open(map, marker);
						}
					})(marker, i));
					map.fitBounds(bounds); // setelah looping
				} 
      		} 
     		google.maps.event.addDomListener(window, 'load', initialize);
    		</script>
    			<script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDrJGHJMMYlMde96uLIBxx9lDCDdrPo5TY&callback=initMap">
    		</script>
    </script>
</body>
</html>