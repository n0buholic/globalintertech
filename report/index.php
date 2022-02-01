<?php
	date_default_timezone_set('Asia/Kuala_Lumpur'); require_once("../setty/config.php"); require_once('../setty/func.php'); 
	if(isset($_GET['IdSvc'])){
		$IdSvc = $_GET['IdSvc'];
	} else {
		$IdSvc = "";
	}
?>
<!DOCTYPE html>
<html lang="en">
<head>   
    <meta charset="UTF-8" />
    <title><?= $IdSvc; ?></title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport" />
    <link rel="stylesheet" href="../admgolax/assets/plugins/bootstrap/css/bootstrap.css" />
    <link rel="stylesheet" href="../admgolax/assets/css/main.css" />
    <link rel="stylesheet" href="../admgolax/assets/css/theme.css" />
    <link rel="stylesheet" href="../admgolax/assets/css/MoneAdmin.css" />
    <link rel="stylesheet" href="../admgolax/assets/plugins/Font-Awesome/css/font-awesome.css" />
	<link href="../admgolax/assets/plugins/dataTables/dataTables.bootstrap.css" rel="stylesheet" />
	<link rel="stylesheet" href="../admgolax/assets/plugins/validationengine/css/validationEngine.jquery.css" />
	<link rel="stylesheet" href="../admgolax/assets/css/bootstrap-fileupload.min.css" />
	<link href="../admgolax/assets/plugins/morris/morris-0.4.3.min.css" rel="stylesheet" />	
	<link href="../admgolax/assets/plugins/appenGrid/jquery.appendGrid-1.7.1.css" rel="stylesheet" />
	<link rel="stylesheet" href="../admgolax/assets/plugins/wysihtml5/dist/bootstrap-wysihtml5-0.0.2.css" />
	<link rel="stylesheet" href="../admgolax/assets/css/bootstrap-wysihtml5-hack.css" />
	<link rel="stylesheet" href="../admgolax/assets/plugins/uniform/themes/default/css/uniform.default.css" />
	<link rel="stylesheet" href="../admgolax/assets/plugins/inputlimiter/jquery.inputlimiter.1.0.css" />
	<link rel="stylesheet" href="../admgolax/assets/plugins/chosen/chosen.min.css" />
	<link rel="stylesheet" href="../admgolax/assets/plugins/tagsinput/jquery.tagsinput.css" />
	<link rel="stylesheet" href="../admgolax/assets/plugins/switch/static/stylesheets/bootstrap-switch.css" />	
	<link href="../admgolax/assets/plugins/gritter/css/jquery.gritter.css" rel="stylesheet" />
	<?php $link = "../img/logo.png"; $src = encode_base64($link); ?>
	<link rel="shortcut icon" href="<?php echo $src; ?>">
</head>
<body>
	<div class="container">
		<div class="row" style="margin-top:10px;">
			<div class="col-md-3"></div>
			<div class="col-md-6" id="load_pages"></div>
			<div class="col-md-3"></div>
		</div>	
	</div>
	<div class="loading"></div>
     <!-- GLOBAL SCRIPTS -->		
    <script src="../admgolax/assets/plugins/jquery-2.0.3.min.js"></script>
    <script src="../admgolax/assets/plugins/bootstrap/js/bootstrap.min.js"></script>
    <script src="../admgolax/assets/plugins/modernizr-2.6.2-respond-1.1.0.min.js"></script>
	<script src="../admgolax/assets/plugins/jquery-tabledit-1.2.3/jquery.tabledit.js"></script>
	<script src="../admgolax/assets/plugins/jquery-tabledit-1.2.3/jquery.tabledit.min.js"></script>	
    <script src="../admgolax/assets/plugins/dataTables/jquery.dataTables.js"></script>
    <script src="../admgolax/assets/plugins/dataTables/dataTables.bootstrap.js"></script>		
	<script src="../admgolax/assets/plugins/validationengine/js/jquery.validationEngine.js"></script>
    <script src="../admgolax/assets/plugins/validationengine/js/languages/jquery.validationEngine-en.js"></script>
    <script src="../admgolax/assets/plugins/jquery-validation-1.11.1/dist/jquery.validate.min.js"></script>
    <script src="../admgolax/assets/js/validationInit.js"></script>
	<script src="../admgolax/assets/plugins/jasny/js/bootstrap-fileupload.js"></script>	
	<script src="../admgolax/assets/plugins/appenGrid/jquery-ui-1.12.1.min.js"></script>	
	<script src="../admgolax/assets/plugins/appenGrid/jquery.appendGrid-1.7.1.js"></script>	
	<script src="../admgolax/assets/plugins/wysihtml5/lib/js/wysihtml5-0.3.0.min.js"></script>
    <script src="../admgolax/assets/plugins/bootstrap-wysihtml5-hack.js"></script>
	<script src="../admgolax/assets/js/bootbox.min.js"></script>	
	<script src="../admgolax/assets/plugins/jquery.form.min.js" type="text/javascript"></script>
	<script src="../admgolax/assets/js/jquery-ui.min.js"></script>
	<script src="../admgolax/assets/plugins/uniform/jquery.uniform.min.js"></script>
	<script src="../admgolax/assets/plugins/inputlimiter/jquery.inputlimiter.1.3.1.min.js"></script>
	<script src="../admgolax/assets/plugins/chosen/chosen.jquery.min.js"></script>
	<script src="../admgolax/assets/plugins/tagsinput/jquery.tagsinput.min.js"></script>
	<script src="../admgolax/assets/plugins/validVal/js/jquery.validVal.min.js"></script>
	<script src="../admgolax/assets/plugins/daterangepicker/moment.min.js"></script>
	<script src="../admgolax/assets/plugins/switch/static/js/bootstrap-switch.min.js"></script>
	<script src="../admgolax/assets/plugins/jquery.dualListbox-1.3/jquery.dualListBox-1.3.min.js"></script>
	<script src="../admgolax/assets/plugins/autosize/jquery.autosize.min.js"></script>
	<script src="../admgolax/assets/plugins/jasny/js/bootstrap-inputmask.js"></script>	
	<script src="../admgolax/assets/plugins/morris/morris.js"></script>
	<script src="../admgolax/assets/plugins/morris/raphael-2.1.0.min.js"></script>	
	<script src="../admgolax/assets/plugins/gritter/js/jquery.gritter.js"></script>
	<script src="../admgolax/assets/js/marquee.js"></script>
	<script src="../admgolax/assets/plugins/maskMoney/jquery.maskMoney.js"></script>
	<script src="../admgolax/assets/plugins/jquery.idle-master/jquery.idle.js"></script>
	<script src="../admgolax/assets/plugins/spinner/jquery.input-counter.min.js"></script>
	<link rel="stylesheet" href="../admgolax/assets/plugins/timeline/timeline.css" />
	 
	<script type="text/javascript">
		$(document).ready(function(){
			$.ajax({
				url: 'home',
				method: 'POST',
				data: 'IdSvc=<?= $IdSvc; ?>',
				cache: false,
				success: function(result){
					$('#load_pages').html(result);
				}
			});
		});		
	</script>

</body>
    <!-- END BODY-->
    
</html>
