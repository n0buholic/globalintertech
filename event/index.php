<!DOCTYPE html>
<html lang="en">

<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Global Integra Technology</title>  
  <meta property="og:title" content="">
  <meta property="og:image" content="">
  <meta property="og:url" content="">
  <meta property="og:site_name" content="">
  <meta property="og:description" content="">  
  <meta name="twitter:card" content="summary">
  <meta name="twitter:site" content="">
  <meta name="twitter:title" content="">
  <meta name="twitter:description" content="">
  <meta name="twitter:image" content="">  
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,700,700i|Raleway:300,400,500,700,800" rel="stylesheet">  
  <link href="../lib/bootstrap/css/bootstrap.min.css" rel="stylesheet">  
  <link href="../lib/font-awesome/css/font-awesome.min.css" rel="stylesheet">
  <link href="../lib/animate-css/animate.min.css" rel="stylesheet">
  <link href="../css/style.css" rel="stylesheet">
  <link href="../css/loader.css" rel="stylesheet">
  <link href="../admgolax/assets/plugins/blinkSlide/css/blink.css" rel="stylesheet">
  <link rel="shortcut icon" href="../img/logo.png">
</head>

<body>
	<div id="preloader"></div><div class="loader"></div>

  <!--==========================
  Header Section
  ============================-->
  <header id="header">
    <div class="container">
      <div id="logo" class="pull-left">
        <a href="../"><img src="../img/logo.png" alt="" title="" /></img></a>
      </div>
      <nav id="nav-menu-container">
        <ul class="nav-menu">
          <li class="menu-active"><a href="../">Home</a></li>
        </ul>
      </nav>
      <!-- #nav-menu-container -->
    </div>
  </header>
  <!-- #header -->

  <!--==========================
  Galery event Section
  ============================-->
  <section id="galery_event">
    <div class="container wow fadeInUp">
      <div class="row">
        <div class="col-md-12">
          <h3 class="section-title">Galery Event</h3>
		  <div class="section-title-divider"></div>
        </div> 
      </div>
	  <div class="row load_utama"></div>
    </div>
  </section>

  <!--==========================
  Footer
============================-->
  <footer id="footer">
    <div class="container">
      <div class="row">
        <div class="col-md-12">
          <div class="copyright">
            GIT &copy; Copyright <?php echo "2017 - ".date("Y"); ?>
          </div>
        </div>
      </div>
    </div>
  </footer>
  <!-- #footer -->
  
  <div class="col-lg-12">
		<div class="modal fade" id="modal_form" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
			<div class="modal-dialog">
				<div class="modal-content">
					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
						<h4 class="modal-title" id="H2"></h4>
					</div>
					<div class="modal-body load_form_modal"></div>
				</div>
			</div>
		</div>
	</div>

<a href="#" class="back-to-top"><i class="fa fa-chevron-up"></i></a>
  
<script src="../lib/jquery/jquery.min.js"></script>
<script src="../lib/bootstrap/js/bootstrap.min.js"></script>
<script src="../lib/superfish/hoverIntent.js"></script>
<script src="../lib/superfish/superfish.min.js"></script>
<script src="../lib/morphext/morphext.min.js"></script>
<script src="../lib/wow/wow.min.js"></script>
<script src="../lib/stickyjs/sticky.js"></script>
<script src="../lib/easing/easing.js"></script>
<script src="../js/custom.js"></script>
<script src="../admgolax/assets/plugins/blinkSlide/js/jquery.blink.js"></script>

<script type="text/javascript">
	$(document).ready(function(){
		$.ajax({
			url: 'home',
			chace: false,
			success: function(data){
				$('.load_utama').html(data);
			}
		});
	});
</script>
</body>

</html>
