<style>
    .header {
        background-image: url(<?php echo base_url("assets/frontend/images/catalogue/header.jpg") ?>);
        background-position: center center;
        background-size: cover;
        width: 100%;
        height: 360px;
    }

    .header-area {
        background: #fff;
        position: relative;
        height: 80px;
    }

    @media (max-width: 991px) {
        .header {
            margin-top: 80px;
        }

        .header-area {
            position: fixed;
        }
    }

    .header-area .nav {
        margin-top: 21px !important;
    }

    .header-area .main-nav .nav li a,
    .header-area .main-nav .nav li a:hover {
        color: #6F8BA4;
    }

    .header-area.header-sticky {
        position: sticky;
        box-shadow: 0 2px 28px 0 rgb(0 0 0 / 20%);
    }

    .overlay {
        filter: opacity(0.5);
    }

    .category-name {
        background-image: linear-gradient(-135deg, #6A30D1 0%, #5C83E3 100%);
    }

    .product {
        border-top: 1px solid #dee8f1;
    }

    .product:first-child {
        border-top: 0px;
    }

    .header-area .main-nav .nav {
        margin-left: 0px;
    }
</style>

<div class="header position-relative" id="header">
    <div class="overlay h-100 w-100 bg-dark position-absolute"></div>
    <div class="container h-100 position-relative" style="z-index: 2">
        <div class="row h-100 d-grid align-content-center">
            <div class="col-12 text-white fw-bold text-center text-md-start">
                <h2 class="mb-2 fw-bold">Katalog</h2>
                <h5 class="fw-light">Katalog Global Integra Technology <?php echo date("Y") ?></h5>
            </div>
        </div>
    </div>
</div>

<header class="header-area">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <nav class="main-nav">
                    <ul class="nav">
                        <?php foreach ($categories as $cat) {
                            if (count($cat->items) > 0) { ?>
                                <li><a href="#<?= str_replace(" ", "-", strtolower($cat->name)) ?>"><?= $cat->name ?></a></li>
                        <?php }
                        } ?>
                    </ul>
                    <a class="menu-trigger">
                        <span>Menu</span>
                    </a>
                </nav>
            </div>
        </div>
    </div>
</header>

<?php foreach ($categories as $cat) {
    if (count($cat->items) > 0) { ?>
        <section class="category-name text-white py-3" id="<?= str_replace(" ", "-", strtolower($cat->name)) ?>">
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <h3 class="fw-bold"><?= $cat->name ?></h3>
                        <p><?= $cat->description ?></p>
                    </div>
                </div>
            </div>
        </section>
        <?php
        $items = $this->db->from("catalogue_item")->where("category_id", $cat->id)->get()->result();
        ?>
        <section class="products">
            <div class="container">
                <?php foreach ($cat->items as $item) {
                    $specification = @explode("<br />", nl2br($item->specification));
                ?>
                    <div class="row product py-5">
                        <div class="col-4">
                            <img src="<?= base_url("assets/frontend/images/uploads/catalogue/" . $item->image) ?>" class="img-fluid">
                        </div>
                        <div class="col-8">
                            <div class="row g-3">
                                <div class="col-12">
                                    <h3 class="fw-bold mb-1"><?= $item->name ?></h3>
                                    <h5><?= $ctr->toRupiah($item->price) ?></h5>
                                </div>
                                <div class="col-12">
                                    <p class="fw-bold mb-2">Spesifikasi:</p>
                                    <small>
                                        <?= implode("&nbsp;&nbsp;|&nbsp;&nbsp;", $specification) ?>
                                    </small>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php } ?>
            </div>
        </section>
<?php }
} ?>

<a href="#" class="back-to-top" style="display: block;"><i class="fa fa-chevron-up"></i></a>

<script>
    $(function() {
        // Header Scrolling Set White Background
        scrollNavBar();

        // Window Resize Mobile Menu Fix
        mobileNav();

        // Scroll animation init
        window.sr = new scrollReveal();

        // Menu Dropdown Toggle
        if ($(".menu-trigger").length) {
            $(".menu-trigger").on("click", function() {
                $(this).toggleClass("active");
                $(".header-area .nav").slideToggle(200);
            });
        }

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
                            scrollTop: target.offset().top - 80,
                        },
                        0
                    );
                    return false;
                }
            }
        });

        // Header Scrolling Set White Background
        $(window).on("scroll", function() {
            scrollNavBar();
        });

        // Window Resize Mobile Menu Fix
        $(window).on("resize", function() {
            mobileNav();
        });

        // Window Resize Mobile Menu Fix
        function mobileNav() {
            var width = $(window).width();
            $(".submenu").on("click", function() {
                if (width < 992) {
                    $(".submenu ul").removeClass("active");
                    $(this).find("ul").toggleClass("active");
                }
            });
        }

        // Navbar Scroll Set White Background Function
        function scrollNavBar() {
            var width = $(window).width();
            if (width > 991) {
                var scroll = $(window).scrollTop();
                if (scroll >= $("#header").height()) {
                    $(".back-to-top").fadeIn("200");
                    $(".header-area").addClass("header-sticky");
                } else {
                    $(".back-to-top").fadeOut("200");
                    $(".header-area").removeClass("header-sticky");
                }
            }
        }
    })
</script>