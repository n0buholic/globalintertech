<!DOCTYPE html>
<html lang="en">
<?= $this->load->view("template/frontend/head") ?>

<body>
    <?= $view ?>
    <?= $this->load->view("template/frontend/script") ?>
</body>
<script>
    $(document).ready(function() {
        // Menu elevator animation
        $("a[href*=\\#]:not([href=\\#])").on("click", function() {
            if (
                location.pathname.replace(/^\//, "") ==
                this.pathname.replace(/^\//, "") &&
                location.hostname == this.hostname
            ) {
                var target = $(this.hash);
                target = target.length ? target : $("[name=" + this.hash.slice(1) + "]");
                if (target.length) {
                    var width = $(window).width();
                    if (width < 991) {
                        $(".menu-trigger").removeClass("active");
                        $(".header-area .nav").slideUp(200);
                    }
                    $("html,body").animate({
                            scrollTop: target.offset().top,
                        },
                        0
                    );
                    return false;
                }
            }
        });
    })
</script>

</html>