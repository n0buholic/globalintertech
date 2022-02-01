<?php
	date_default_timezone_set('Asia/Kuala_Lumpur'); require_once("../setty/config.php"); 
	require_once("../setty/function.php");
	$idcus = $_POST['idcus'];
	$q = mysqli_query($conn,"select * from tb_customer where id_customer='".$idcus."' LIMIT 1");
	$d = mysqli_fetch_array($q);
?>
<hr />
<div class="row">
	<div class="col-md-12">
		<table class="table table-striped" width="100%">
			<tr><td width="100px">Nama</td><td><i class="icon-caret-right"></i> <?php echo $d['nama']; ?></td></tr>
			<tr><td>No. HP/Telp</td><td><i class="icon-caret-right"></i> <?php echo replace_kontak($d['kontak']); ?></td></tr>
		</table>
	</div>
</div><hr />
<div class="row"><div class="col-md-12 load_pages_tabel"></div></div>
<script type="text/javascript">
	$(document).ready(function(){
		var idcus = '<?php echo $idcus; ?>';
		$.ajax({
			type: 'POST',
			url: 'tabel_service',
			data: {idcus:idcus},
			cache: false,
			success: function(data){
				$('.load_pages_tabel').html(data);
			}
		});
	});
</script>