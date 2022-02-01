<?php
	date_default_timezone_set('Asia/Kuala_Lumpur'); require_once("../setty/config.php"); require_once("../setty/func.php");
?>

<div id="slider-carousel" class="carousel slide HtmlLoadSlider" data-ride="carousel"></div>

<script type="text/javascript">
	$(document).ready(function(){

		$.ajax({
			type: 'POST',
			url: 'set/pack',
			data: 'Op=TriggerData&Sub=DataSlider',
			dataType: 'json',
			cache: false,
			success: function(result){
				var html = '';
				html += '<ol class="carousel-indicators">';
				$.each(result, function(Index, Element){
					if(Index == 0){
						html += '<li data-target="#slider-carousel" data-slide-to="'+ Index +'" class="active"></li>';
					} else {
						html += '<li data-target="#slider-carousel" data-slide-to="'+ Index +'"></li>';
					}
				});
				html += '</ol>';
				html += '<div class="carousel-inner">';
				$.each(result, function(Index, Element){
					if(Index == 0){ var Active = ' active'; } else { var Active = ''; }
					html += '<div class="item'+ Active +'">';
					html += '	<div class="col-sm-6">';
					html += '		<h1><span>CMB</span>-SHOPPER</h1>';
					html += '		<h2>'+ Element[0]+'</h2>';
					html += '		<p>'+ Element[1] +'</p>';
					html += '	</div>';
					html += '	<div class="col-sm-6">';
					html += '		<img src="'+ Element[2] +'" class="girl img-responsive" alt="" />';
					html += '	</div>';
					html += '</div>';
				});				
				html += '</div>';
				html += '<a href="#slider-carousel" class="left control-carousel hidden-xs" data-slide="prev"><i class="fa fa-angle-left"></i></a>';
				html += '<a href="#slider-carousel" class="right control-carousel hidden-xs" data-slide="next"><i class="fa fa-angle-right"></i></a>';			
				$('.HtmlLoadSlider').html(html);
			}
		});

	});
</script>