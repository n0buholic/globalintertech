<?php
	date_default_timezone_set('Asia/Kuala_Lumpur'); require_once("../setty/config.php");
	require_once("../setty/function.php"); $hp = $_POST['hp'];
	$q = mysqli_query($conn,"select * from tb_customer where kontak='".$hp."'");
	$row = mysqli_num_rows($q);
	if($row > 0){
		if($row > 1){
?>
	<div class="form-group">
		<label>Pilih Alamat</label>
		<select data-placeholder="--Pilih Alamat--" name="plh_alamat" id="plh_alamat" class="form-control chzn-select" tabindex="7"></select>
	</div>
	<div class="row"><div class="col-md-12 load_pages_sub"></div></div>
	<script type="text/javascript">
		$(document).ready(function(){
			$.ajax({
				type: 'POST',
				url: 'prog',
				data: 'op=dt_trigger&sub=alamat&hp=<?php echo $hp; ?>',
				cache: false,
				success: function(data){
					$('#plh_alamat').html(data).trigger("chosen:updated");
				}
			});
			$(".chzn-select").chosen({
				width: '100%',
				no_results_text: "Oops, data tidak ditemukan!"
			});
			$('#plh_alamat').change(function(){
				var idcus = $('#plh_alamat').val();
				$.ajax({
					type: 'POST',
					beforeSend: function(){
						$('.loading').fadeIn('slow');
					},
					url: 'form_lap_service_alamat',
					data: {idcus:idcus},
					cache: false,
					success: function(data){
						$('.loading').fadeOut('slow', function(){
							$('.load_pages_sub').html(data);
						});
					}
				});
			});
		});
	</script>
<?php
		} else {
			$q = mysqli_query($conn,"select * from tb_customer where kontak='".$hp."' LIMIT 1");
			$d = mysqli_fetch_array($q);
?>
			<div class="row">
				<div class="col-md-12">
					<table class="table table-striped" width="100%">
						<tr><td width="100px">Nama</td><td><i class="icon-caret-right"></i> <?php echo $d['nama']; ?></td></tr>
						<tr><td>No. HP/Telp</td><td><i class="icon-caret-right"></i> <?php echo replace_kontak($d['kontak']); ?></td></tr>
					</table>
				</div>
			</div><hr />
			<div class="row"><div class="col-md-12 load_pages_sub"></div></div>
			<script type="text/javascript">
				$(document).ready(function(){
					var idcus = '<?php echo $d["id_customer"]; ?>';
					$.ajax({
						type: 'POST',
						url: 'tabel_service',
						data: {idcus:idcus},
						cache: false,
						success: function(data){
							$('.loading').fadeOut('slow', function(){
								$('.load_pages_sub').html(data);
							});
						}
					});
				});
			</script>
<?php
		}
	} else {
		echo "error|<div class='alert alert-danger alert-dismissable'><button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button><p>Mohon maaf, No. HP tidak ditemukan.</p></div>";
	}
?>