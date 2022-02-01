<?php 
	require_once("../setty/config.php"); require_once("../setty/func.php");
	$result = mysqli_query($conn,"select SQL_CALC_FOUND_ROWS * from tb_event group by id_event order by tgl desc limit 6");
	$row_object = mysqli_query($conn,"Select Found_Rows() as rowcount");
	$row_object = mysqli_fetch_object($row_object);
	$actual_row_count = $row_object->rowcount;
?>
<script type="text/javascript">
	var page = 6;
	$(window).scroll(function() {
		$('#more').hide(); $('#no-more').hide();
		if($(window).scrollTop() + $(window).height() > $(document).height() - 200) {
			$('#more').show();
		}
		if($(window).scrollTop() + $(window).height() == $(document).height()) {
			$('#more').hide(); $('#no-more').hide(); page++;
			var data = { page_num: page };
			var actual_count = "<?php echo $actual_row_count; ?>";
			if((page - 1) * 1 > actual_count){
				$('#no-more').show();
			} else {
				$.ajax({
					type: "POST",
					url: "load_event",
					data: data,
					success: function(res) {
						$("#result").append(res);
					}
				});
			}
		}
	});
</script>
<div class="row">
	<div class="col-md-12">
		<div id="result">
			<?php 
				while($r = mysqli_fetch_array($result)){
					$arr = explode(" ", $r['tgl']);
					if($arr[0] == date("Y-m-d")){
						$tgl = "baru";
					} else {
						$tgl = $arr[0];
					}
					$q1 = mysqli_query($conn,"select *, count(*)as total from tb_event where id_event='$r[id_event]'");
					$d1 = mysqli_fetch_array($q1);
					$q2 = mysqli_query($conn,"select * from tb_user where id_teknisi='$r[id_user]'");
					$d2 = mysqli_fetch_array($q2);
					echo "<div class='col-md-4'>
							<div class='alert alert-success byngan'>
								<div class='icon-galery'><img src='".str_replace("_","/",$r['link'])."' style='cursor:pointer;' onClick = 'view_foto($r[id_event])' /></div>
								<div class='judul-galery'>$r[keterangan]<div class='total-foto'> $d1[total] Foto</div></div>
								<div class='tgl-galery'>Posting: $tgl oleh <b>".ucwords($d2['nama'])."</b></div>
							</div>
						</div>";
				} 
			?>
		</div>
	</div>
</div>
<div class="row">
	<div class="col-md-12" style="color:#333;font-size:1em;text-align:center;font-weight:bold;">
		<div id="no-more">tidak ada.</div><div id="more">memuat data event...</div>
	</div>
</div>

<script type="text/javascript">
	function view_foto(id){
		$.ajax({
			url: "form/form_lihat_foto_1",
			beforeSend: function(){
				$(".loader").fadeIn("slow");
			},
			data: "id="+id,
			cache: false,
			success: function(data){					
				$(".loader").fadeOut("slow", function(){
					$('#modal_form').modal('show');
					$('#H2').html('Lihat Foto');
					$(".load_form_modal").html(data);
				});
			}
		});
	};
	$(document).ready(function(){
		$('#modal_form').on('hidden.bs.modal', function(e){
			$('.load_form_modal').html(''); $('#H2').html('');
		});
	});
</script>