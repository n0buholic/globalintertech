<?php 
	date_default_timezone_set('Asia/Kuala_Lumpur'); require_once("../setty/config.php"); require_once("../setty/func.php");
	$idcus = $_POST['idcus'];
?>
<div class="table-resposive">
	<table class="table table-striped" id="tabel_data" style="width:100%">
		<thead>
			<tr>
				<th></th><th>ID Service</th><th>Keluhan Service</th><th>Status</th>
			</tr>
		</thead>
	</table>
</div>
<script type="text/javascript">
	$(document).ready(function(){
		var idcus = '<?php echo $idcus; ?>';
		function format_data ( d ) {
			var div = $('<div>');
			$.ajax({
				type: 'POST',
				beforeSend: function(){
					$('.loading').fadeIn('slow');
				},
				url : 'form_detail_service',
				data: {idsvc:d[1]},
				cache: false,
				success: function(json){
					$('.loading').fadeOut('slow', function(){
						div.html(json);
					});
				}
			});
			return div;
		}
		var tabel = $('#tabel_data').DataTable({
			"processing": true,
			"serverSide": true,
			"ajax" : {
				url:"data_service",
				type:"POST",
				data:{idcus:idcus}
			},
			"columns": [
				{
					"className": 'details-control',
					"orderable": false,
					"data": null,
					"defaultContent": ''
				},
				{"data": 1}, {"data": 2}, {"data": 3}
			],
			"columnDefs": [
				{ "className": "text-center", "width": "5%", "targets": 0, "orderable": false },
				{ "className": "text-center", "width": "20%", "targets": 1 },
				{ "targets": 2, "orderable": false },
				{ "className": "text-center", "width": "12%", "targets": 3, "orderable": false }
			],
			language: {
				"search": "<i class='icon-search'></i> Temukan: ",
				"processing": "Sedang memuat data..."
			},
			"order": [[1, "desc"]]
		});
		$('.dataTables_filter input').attr('placeholder', 'ID Service');
		$('#tabel_data tbody').on('click', 'td.details-control', function () {
			var tr = $(this).closest('tr'), row = tabel.row( tr );	 
			if ( row.child.isShown() ) {
				row.child.hide();
				tr.removeClass('shown');
			} else {
				row.child( format_data(row.data()) ).show();
				tr.addClass('shown');
			}
		});
	});
</script>