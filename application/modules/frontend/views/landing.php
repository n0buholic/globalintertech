<style>
    html,
    body {
        background: #142428;
        background-image: url(<?= base_url("assets/frontend/images/landing/background.jpg") ?>);
        background-size: 100%;
        background-blend-mode: overlay;
    }

    .btn-primary-line {
        width: 100% !important;
        padding: 25px 25px;
        font-size: 16px;
    }

    .promo-container .swiper {
        border-radius: 30px;
        overflow: hidden;
    }

    .swiper-button-next,
    .swiper-button-prev {
        color: white;
    }

    .swiper-pagination-bullet {
        background: white;
    }

    .logo-container {
        width: 150px;
        height: 150px;
        border-radius: 200px;
        display: inline-grid;
        align-content: space-around;
    }

    .icon-container {
        width: 50px !important;
        height: 50px !important;
        display: inline-grid;
        align-content: space-around;
        justify-content: space-around;
        font-size: 24px;
    }

    .embed-container {
        position: relative;
        padding-bottom: 56.25%;
        height: 0;
        overflow: hidden;
        max-width: 100%;
        border-radius: 30px;
    }

    .embed-container iframe,
    .embed-container object,
    .embed-container embed {
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
    }
</style>

<section id="main">
    <div class="container" style="height: 100vh;">
        <div class="row h-100 align-items-center text-center text-white">
            <div class="col-12 my-2">
                <div class="bg-white logo-container">
                    <img class="w-100" src="<?= base_url("assets/frontend/images/logo_700.png") ?>" alt="">
                </div>
                <h4 class="mt-4 mb-5">Global Integra Technology</h4>
                <a target="_blank" href="https://www.globalintertech.co.id/" class="btn-primary-line w-100 my-2"><i class="fas fa-globe me-1"></i> WEBSITE</a>
                <a href="#promotion" class="btn-primary-line w-100 my-2"><i class="fas fa-tags me-1"></i> PROMO BERLANGSUNG</a>
                <a href="#contact" class="btn-primary-line w-100 my-2"><i class="fab fa-whatsapp me-1"></i> KONTAK</a>
                <a href="#ecommerce" class="btn-primary-line w-100 my-2"><i class="fas fa-shopping-bag me-1"></i> E-COMMERCE</a>
                <a href="#location" class="btn-primary-line w-100 my-2"><i class="fas fa-map-marked-alt me-1"></i> ALAMAT STORE OFFLINE</a>
                <div class="mt-5">
                    <a target="_blank" href="https://facebook.com/globalintegratechnology" class="btn btn-primary-line icon-container mx-1">
                        <i class="fab fa-facebook"></i>
                    </a>
                    <a target="_blank" href="https://instagram.com/globalintegratechnology" class="btn btn-primary-line icon-container mx-1">
                        <i class="fab fa-instagram"></i>
                    </a>
                    <a target="_blank" href="mailto:mkt01@glosindotech.com" class="btn btn-primary-line icon-container mx-1">
                        <i class="fas fa-envelope"></i>
                    </a>
                    <!--
                        <a target="_blank" href="#" class="btn btn-primary-line icon-container mx-1">
                            <i class="fab fa-tiktok"></i>
                        </a>
                    -->
                </div>
            </div>
        </div>
    </div>
</section>

<section class="section py-3" id="promotion">
    <div class="container" style="height: 100vh;">
        <div class="row align-items-center text-center text-white h-100">
            <div class="col-12">
                <div class="center-heading mb-3">
                    <h2 class="section-title text-white">PROMO BERLANGSUNG</h2>
                </div>
                <div class="row justify-content-center">
                    <div class="col-lg-8 promo-container">
                        <?php if (count($promotion) > 0) { ?>
                            <div class="swiper">
                                <div class="swiper-wrapper">
                                    <?php foreach ($promotion as $promo) { ?>
                                        <div class="swiper-slide">
                                            <a target="_blank" href="<?= $promo->url ?>"><img class="img-fluid" src="<?= base_url("assets/frontend/images/landing/promo/" . $promo->image) ?>"></a>
                                        </div>
                                    <?php } ?>
                                </div>
                                <div class="swiper-pagination"></div>
                                <div class="swiper-button-prev"></div>
                                <div class="swiper-button-next"></div>
                            </div>
                        <?php } else { ?>
                            <h5>Belum ada promo :(</h5>
                        <?php } ?>
                    </div>
                </div>
                <div class="my-5">
                    <a href="#contact" class="btn btn-primary-line icon-container mx-1">
                        <i class="fas fa-chevron-down"></i>
                    </a>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="section py-3" id="contact">
    <div class="container" style="height: 100vh;">
        <div class="row align-items-center text-center text-white h-100">
            <div class="col-12">
                <div class="center-heading mb-3">
                    <h2 class="section-title text-white">KONTAK</h2>
                </div>
                <p class="text-white text-center mt-4 fw-bold">Admin 1</p>
                <a target="_blank" href="https://wa.me/6281351926565" class="btn-whatsapp btn-primary-line w-100 my-2"><i class="fab fa-whatsapp me-1"></i> 081351926565</a>
                <p class="text-white text-center mt-4 fw-bold">Admin 2</p>
                <a target="_blank" href="https://wa.me/6282131091940" class="btn-whatsapp btn-primary-line w-100 my-2"><i class="fab fa-whatsapp me-1"></i> 082131091940</a>
                <p class="text-white text-center mt-4 fw-bold">Admin 3</p>
                <a target="_blank" href="https://wa.me/6282185178888" class="btn-whatsapp btn-primary-line w-100 my-2"><i class="fab fa-whatsapp me-1"></i> 082185178888</a>
                <div class="my-5">
                    <a href="#ecommerce" class="btn btn-primary-line icon-container mx-1">
                        <i class="fas fa-chevron-down"></i>
                    </a>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="section py-3" id="ecommerce">
    <div class="container" style="height: 100vh;">
        <div class="row align-items-center text-center text-white h-100">
            <div class="col-12">
                <div class="center-heading mb-3">
                    <h2 class="section-title text-white">E-COMMERCE</h2>
                </div>
                <a target="_blank" href="https://shopee.co.id/globalintegratechnology" class="btn-primary-line w-100 my-2"><i class="fas fa-shopping-bag me-1"></i> Shopee</a>
                <a target="_blank" href="https://www.tokopedia.com/globalintegratechnology" class="btn-primary-line w-100 my-2"><i class="fas fa-shopping-bag me-1"></i> Tokopedia</a>
                <div class="my-5">
                    <a href="#location" class="btn btn-primary-line icon-container mx-1">
                        <i class="fas fa-chevron-down"></i>
                    </a>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="section py-3" id="location">
    <div class="container" style="height: 100vh;">
        <div class="row align-items-center text-center text-white h-100">
            <div class="col-12">
                <div class="center-heading mb-3">
                    <h2 class="section-title text-white">ALAMAT STORE OFFLINE</h2>
                </div>
                <a target="_blank" href="https://www.google.com/maps/dir/?api=1&destination=-3.351034362128312,114.61648273166458" class="btn-primary-line w-100 my-2"><i class="fas fa-map-marked-alt me-1"></i> Alamat Retail dan Gudang</a>
                <a href="#video-1" class="btn-primary-line w-100 my-2" data-bs-toggle="collapse" role="button" aria-expanded="false"><i class="fas fa-play-circle me-1"></i> Video Retail dan Gudang</a>
                <div class="collapse mt-2" id="video-1">
                    <div class='embed-container'><iframe src='https://www.youtube.com/embed/VH7d-_4za0o' frameborder='0' allowfullscreen></iframe></div>
                </div>
                <div class="my-5"></div>
                <a target="_blank" href="https://www.google.com/maps/dir/?api=1&destination=-3.327111092019475,114.59787828775406" class="btn-primary-line w-100 my-2"><i class="fas fa-map-marked-alt me-1"></i> Alamat Service Centre</a>
                <a href="#video-2" class="btn-primary-line w-100 my-2" data-bs-toggle="collapse" role="button" aria-expanded="false"><i class="fas fa-play-circle me-1"></i> Video Service Centre</a>
                <div class="collapse mt-2" id="video-2">
                    <div class='embed-container'><iframe src='https://www.youtube.com/embed/EK9VmaxDBiY' frameborder='0' allowfullscreen></iframe></div>
                </div>
                <div class="my-5"></div>
                <a href="#video-3" class="btn-primary-line w-100 my-2" data-bs-toggle="collapse" role="button" aria-expanded="false"><i class="fas fa-play-circle me-1"></i> Video Cara Klaim Garansi</a>
                <div class="collapse mt-2" id="video-3">
                    <div class='embed-container'><iframe src='https://www.youtube.com/embed/7PzOLeqsEoY' frameborder='0' allowfullscreen></iframe></div>
                </div>
                <div class="my-5">
                    <a href="#main" class="btn btn-primary-line icon-container mx-1">
                        <i class="fas fa-chevron-up"></i>
                    </a>
                </div>
            </div>
        </div>
    </div>
</section>