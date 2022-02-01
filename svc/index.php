<?php
	date_default_timezone_set('Asia/Kuala_Lumpur'); require_once("../setty/config.php");
	require_once('../setty/func.php'); if(isset($_GET['inv'])){ $inv = $_GET['inv']; } else { $inv = ""; }
?>
<!DOCTYPE html>
<html lang="en">
<head>   
    <meta charset="UTF-8" />
    <title>Global Integra Technology</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport" />
    <link rel="stylesheet" href="plugin/bootstrap/css/bootstrap.css" />
    <link href="plugin/gritter/css/jquery.gritter.css" rel="stylesheet" />
	<?php $link = "../img/logo.png"; $src = encode_base64($link); ?>
	<link rel="shortcut icon" href="<?php echo $src; ?>">
</head>
<body style="background:#eee;">
	<style type="text/css">
		.loading {
		    position: fixed;
		    left: 0px;
		    top: 0px;
		    width: 100%;
		    height: 100%;
		    z-index: 9999;
		    background: url('plugin/img/loader.gif') 50% 50% no-repeat rgb(191,191,191);
		    opacity: .8;
			display: none;
		}
	</style>

	<?php $link = "../img/logo.png"; $src = encode_base64($link); ?>
	<nav class="navbar navbar-dark bg-dark">
		<div class="container-fluid" style="font-size:1.2em;font-weight:bold;color:#fff;">
			Laporan Service GIT
			<img src="<?= $link; ?>" alt="" height="24" class="d-inline-block align-text-top">
		</div>
	</nav>		
	<div class="container" id="html_load_sumber"></div>
	<div class="loading"></div>

	<script src="plugin/bootstrap/js/bootstrap.js"></script>
	<script src="plugin/jquery-3.5.1.js"></script>
    <script src="plugin/jquery-validation-1.11.1/dist/jquery.validate.min.js"></script>
    <script src="plugin/gritter/js/jquery.gritter.js"></script>
    <script src="plugin/script.js"></script>

	<script type="text/javascript">
		$(document).ready(function(){ $.ajax({ type:'POST', url:'home', data:{inv:'<?= $inv; ?>'}, chace:false, success:function(page){ $('#html_load_sumber').html(page); } });/*end*/ });/*endocument*/
	</script>

</body><!-- END BODY--></html>
