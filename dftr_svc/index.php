<?php date_default_timezone_set('Asia/Kuala_Lumpur'); require_once('../setty/func.php'); ?>
<!DOCTYPE html>
<html lang="en">
<head>   
    <meta charset="UTF-8" />
    <title>Service GIT</title>
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css" integrity="sha384-zCbKRCUGaJDkqS1kPbPd7TveP5iyJE0EjAuZQTgFLD2ylzuqKfdKlfG/eSrtxUkn" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.1/font/bootstrap-icons.css">
	<?php $link = "../img/logo.png"; $src = encode_base64($link); ?>
	<link rel="shortcut icon" href="<?php echo $src; ?>">
</head>
<body>

	<div class="container-fluid">
		<div class="row mt-5 mb-5">
			<div class="col-md-3"></div>
			<div class="col-md-6" id="div-load-page"></div>
			<div class="col-md-3"></div>
		</div>
	</div>

	<div class="loading" style="display:none;position: fixed;z-index: 999999;top:0px;left: 0px;background-color: rgb(221, 221, 221, 50%);width: 100%;height: 100%;">
            <div style="position: absolute;top: 50%;left: 50%;">
                <div class="spinner-grow" style="width: 3rem; height: 3rem;" role="status">
                  <span class="sr-only">Loading...</span>
                </div>                
            </div>
       </div>
    
	<script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-fQybjgWLrvvRgtW6bFlB7jaZrFsaBXjsOMm/tB9LTS58ONXgqbR9W8oWht/amnpF" crossorigin="anonymous"></script>
	<script src=""></script>
	<script type="text/javascript" src="../assets/frontend/js/jquery-3.6.0.min.js"></script>
	<script type="text/javascript" src="https://cdn.jsdelivr.net/npm/jquery-validation@1.19.3/dist/jquery.validate.min.js"></script>

	<script type="text/javascript">
		$(document).ready( () => {
			$.ajax({ beforeSend: () => { $('.loading').fadeIn('slow'); }, url:'form-awal', success: (page) => { $('#div-load-page').html(page); } });
		});
	</script>

</body>
    <!-- END BODY-->    
</html>
