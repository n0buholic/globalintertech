<script>
    var base_url = "<?= base_url() ?>";
    var onloadCallback = function() {
        grecaptcha.render('recaptcha', {
            'sitekey': '6Ld2mRMeAAAAAPMuXnwy6h5mpYIK4ZAlytbHNdbY'
        });
    };
</script>

<script src="https://www.google.com/recaptcha/api.js?onload=onloadCallback&render=explicit" async defer>
</script>
<script src="https://maps.google.com/maps/api/js?key=AIzaSyDrJGHJMMYlMde96uLIBxx9lDCDdrPo5TY"></script>

<script src="<?= base_url("assets/frontend/js/jquery-3.6.0.min.js") ?>"></script>

<script src="<?= base_url("assets/frontend/js/popper.js") ?>"></script>
<script src="<?= base_url("assets/frontend/js/bootstrap.min.js") ?>"></script>

<script src="<?= base_url("assets/frontend/js/jquery.blink.js") ?>"></script>

<script src="<?= base_url("assets/frontend/js/scrollreveal.min.js") ?>"></script>
<script src="<?= base_url("assets/frontend/js/parallax.min.js") ?>"></script>
<script src="<?= base_url("assets/frontend/js/waypoints.min.js") ?>"></script>
<script src="<?= base_url("assets/frontend/js/jquery.counterup.min.js") ?>"></script>
<script src="<?= base_url("assets/frontend/js/jquery.magnific-popup.min.js") ?>"></script>
<script src="<?= base_url("assets/frontend/js/imgfix.min.js") ?>"></script>

<script src="<?= base_url("assets/frontend/js/map-script.js?v=" . time()) ?>"></script>
<script src="<?= base_url("assets/frontend/vendor/sweetalert2/dist/sweetalert2.min.js") ?>"></script>

<script src="<?= base_url("assets/frontend/vendor/swiper/swiper-bundle.js") ?>"></script>

<script src="<?= base_url("assets/frontend/js/custom.js?v=" . time()) ?>"></script>