<?php
	date_default_timezone_set('Asia/Kuala_Lumpur');
?>
<li class="panel"><a href="#" class="link-menu" data-sumber="../produk/"><i class="icon-shopping-cart"></i> Belanja</a></li>
<li class="panel"><a href="#" class="link-menu" data-sumber="../"><i class="icon-home"></i> Home</a></li>
<script type="text/javascript">
	$(document).ready(function(){
		$('.link-menu').click(function(){
			var sumber = $(this).data('sumber');
			$.ajax({
				beforeSend: function(){
					$('.loading').fadeIn('slow');
				},
				success: function(){
					$('.loading').fadeOut('slow', function(){
						window.location = sumber;
					});
				}
			});
		});
	});
</script>