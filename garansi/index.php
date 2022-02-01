<?php
	date_default_timezone_set('Asia/Kuala_Lumpur'); require_once("../setty/config.php"); require_once('../setty/func.php');
?>
<!DOCTYPE html>
<html lang="en">
<head>   
    <meta charset="UTF-8" />
    <title>Globalintertech</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport" />
    <link rel="stylesheet" href="../admgolax/assets/plugins/bootstrap/css/bootstrap.css" />
    <link rel="stylesheet" href="../admgolax/assets/css/main.css" />
    <link rel="stylesheet" href="../admgolax/assets/plugins/Font-Awesome/css/font-awesome.css" />
	<?php $link = "../img/logo.png"; $src = encode_base64($link); ?>
	<link rel="shortcut icon" href="<?php echo $src; ?>">
</head>
<body class="content" >
    <div id="row">
        <div class="loading"></div><div class="inner load-hal"></div>
    </div>

     <!--END MAIN WRAPPER -->

   <!-- FOOTER -->
    <div id="footer" style="margin-top:1em">
        <p>2017 - <?php echo date("Y"); ?> &copy;  Global Integra Technology</p>
    </div>
    <!--END FOOTER -->	
	
    <!-- GLOBAL SCRIPTS -->
    <script src="../admgolax/assets/plugins/jquery-2.0.3.min.js"></script>
    <script src="../admgolax/assets/plugins/bootstrap/js/bootstrap.min.js"></script>
	<script src="../admgolax/assets/plugins/validationengine/js/jquery.validationEngine.js"></script>
    <script src="../admgolax/assets/plugins/validationengine/js/languages/jquery.validationEngine-en.js"></script>
    <script src="../admgolax/assets/plugins/jquery-validation-1.11.1/dist/jquery.validate.min.js"></script>

    <script type="text/javascript">
		$(document).ready(function(){
			$.ajax({ url: "home", cache: false, success: function(data){ $(".load-hal").html(data); } });//end
		});//end document
	</script>
</body> </html>
