<?php
	date_default_timezone_set('Asia/Kuala_Lumpur'); require_once("../setty/config.php"); require_once("../setty/func.php");
	$inv = $_POST['inv'];
?>
<?php if($inv == ""){ ?>
<div class="row">
	<div class="col" style="margin-top:2em;">
		<form id="frm_cek">
			<div class="mb-3">
			  <label>Masukkan No. Invoice / ID. Service</label>
			  <input class="form-control" type="text" id="textinv" name="textinv">
			</div>
			<div class="mb-3" style="text-align:right;">
			  <button type="submit" class="btn btn-outline-primary">Temukan</button>
			</div>
		</form>
	</div>
</div>
<div class="row">
	<div class="col" id="html_hasil" style="padding:1.5em;">
		<ul class="list-group list-group-flush" style="box-shadow:3px 5px 5px #888;">
		  <li class="list-group-item list-group-item-info">Keluhan</li>
		  <li class="list-group-item" id="html_keluhan">tidak ditemukan.</li>
		  <li class="list-group-item list-group-item-info" id="html_log_svc">Info Service</li>
		  <li class="list-group-item ls_log_svc">tidak ditemukan.</li>		  
		  <li class="list-group-item"><button type="button" class="btn tcetak_wo">cetak wo</button></li>
		</ul>
	</div>
</div>
<script type="text/javascript">
	$(document).ready(function(){ $('input').prop('autocomplete', 'off'); $('.tcetak_wo').prop('disabled', true).addClass('btn-secondary');
		$('#frm_cek').validate({
			rules: { textinv: { required:true, maxlength:15, karakter01:true } },
			errorClass: 'help-block',
			errorElement: 'span',
			highlight: function (element, errorClass, validClass) { $(element).parents('.form-group').removeClass('has-success').addClass('has-error'); },
			unhighlight: function (element, errorClass, validClass) { $(element).parents('.form-group').removeClass('has-error').addClass('has-success'); },
			submitHandler: function(form, e) { e.preventDefault(); var inv = $('#textinv').val();
		       	$.ajax({ beforeSend:function(){ $('.loading').fadeIn('slow'); $('.ls_log_svc').remove(); }, type:'POST', url:'data_prc', data:{ op:'detail_inv', inv:inv }, dataType:'json', chace:false, complete:function(){ $('.loading').fadeOut('slow'); }, success:function(msg){
		       		if(msg.status == 'reload'){
		       			$.gritter.add({ title: msg.title, text: msg.text, sticky: false, class_name: msg.warna, time: 5000 });
		       			$('#html_keluhan').html('data tidak ditemukan.');
		       			$('#html_log_svc').after('<li class="list-group-item ls_log_svc">tidak ditemukan.</li>');
		       			$('.tcetak_wo').prop('disabled', true).removeClass('btn-warning').addClass('btn-secondary');
		       		} else { $('#html_keluhan').html(msg[0][0]); var html_ls = '';
		       			$.each(msg[0][2], function(inx, elm){
		       				html_ls += '<li class="list-group-item ls_log_svc">'+elm[0]+'<br>'+elm[1]+'</li>';
		       			}); $('#html_log_svc').after(html_ls);
		       			if(parseInt(msg[0][1]) > 1){ $('.tcetak_wo').prop('disabled', false).addClass('btn-warning'); }
		       		}
		       	} });
      	return false; } });/*end*/      	
	});/*endocumnet*/
</script>
<?php } else { ?>
<div class="row">
	<div class="col" id="html_hasil" style="padding:1.5em;">
		<ul class="list-group list-group-flush" style="box-shadow:3px 5px 5px #888;">
			<li class="list-group-item list-group-item-info">No. Invoice</li>
			<li class="list-group-item" id="html_inv"></li>
			<li class="list-group-item list-group-item-info">Keluhan</li>
			<li class="list-group-item" id="html_keluhan">tidak ditemukan.</li>
			<li class="list-group-item list-group-item-info" id="html_log_svc">Info Service</li>
			<li class="list-group-item ls_log_svc">tidak ditemukan.</li>
			<li class="list-group-item"><button type="button" class="btn tcetak_wo">cetak wo</button></li>
		</ul>
	</div>
</div>
<script type="text/javascript">
	$(document).ready(function(){ var inv = '<?= $inv; ?>'; $('#html_inv').html('<b>'+inv+'</b>');
		$.ajax({ beforeSend:function(){ $('.loading').fadeIn('slow'); $('.ls_log_svc').remove(); }, type:'POST', url:'data_prc', data:{ op:'detail_inv', inv:inv }, dataType:'json', chace:false, complete:function(){ $('.loading').fadeOut('slow'); }, success:function(msg){
			if(msg.status == 'reload'){
				$.gritter.add({ title: msg.title, text: msg.text, sticky: false, class_name: msg.warna, time: 5000 });
				$('#html_keluhan').html('data tidak ditemukan.');
				$('#html_log_svc').after('<li class="list-group-item ls_log_svc">tidak ditemukan.</li>');
				$('.tcetak_wo').prop('disabled', true).removeClass('btn-warning').addClass('btn-secondary');
			} else { $('#html_keluhan').html(msg[0][0]); var html_ls = '';
				$.each(msg[0][2], function(inx, elm){
					html_ls += '<li class="list-group-item ls_log_svc">'+elm[0]+'<br>'+elm[1]+'</li>';
				}); $('#html_log_svc').after(html_ls);
				if(parseInt(msg[0][1]) > 1){ $('.tcetak_wo').prop('disabled', false).addClass('btn-warning'); }
		} } });/*end*/
	});/*endocument*/
</script>
<?php } ?>
<script type="text/javascript">
	$(document).ready(function(){
		$('.tcetak_wo').click(function(){
			var inv = $('#textinv').val();
			if(inv == undefined){ inv = '<?= $inv; ?>'; }
			$.ajax({ beforeSend: function(){ $('.loading').fadeIn('slow'); }, type:'POST', url: 'cetak_bukti_finish', data:{ idsvc:inv }, cache: false, success: function(){
					$.ajax({ url:'form_cetak_wo', data:{ idsvc:inv }, cache: false, complete:function(){ $('.loading').fadeOut('slow'); }, success: function(pdf){ $("#html_load_sumber").html(pdf); } }); } }); });/*end*/
	});/*end*/
</script>