<style>
    textarea:hover,
    input:hover,
    textarea:active,
    input:active,
    textarea:focus,
    input:focus,
    button:focus,
    button:active,
    button:hover,
    label:focus,
    .btn:active,
    .btn.active {
        outline: 0px !important;
        -webkit-appearance: none;
        box-shadow: none !important;
    }

    .input-group-btn {
        z-index: 0;
    }

    .qty-wrapper {
        width: 140px;
        border-radius: 6px;
        overflow: hidden;
        position: relative;
    }

    .quantity {
        padding: 0;
    }

    .qty-wrapper * {
        border-radius: 0px;
    }

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

    .back-to-top {
        align-content: center;
        align-items: center;
        width: 40px;
        height: 40px;
        justify-content: center;
        right: 50%;
    }

    .back-to-top.show {
        display: flex !important;
    }

    .fixed-cart {
        position: fixed;
        bottom: 10px;
        right: 10px;
        z-index: 999;
        width: 50px;
        height: 50px;
        background: white;
        border-radius: 4px;
        display: flex;
        justify-content: center;
        align-items: center;
        box-shadow: 2px 2px 12px rgb(0 0 0 / 20%);
        cursor: pointer;
        color: white;
        background-image: linear-gradient(-135deg, #6A30D1 0%, #5C83E3 100%);
    }

    .fixed-cart i {
        font-size: 26px;
    }

    .remove-from-cart {
        cursor: pointer;
    }

    .cart-container,
    .customer-data-container {
        position: fixed;
        z-index: 999;
        width: 100%;
        height: 100%;
        background: white;
        top: 0;
        left: 0;
    }

    .search-product.desktop {
        float: right;
        height: 80px;
        align-items: center;
        margin-left: 1rem;
        margin-right: 1rem;
        align-content: center;
    }

    .search-product.mobile {
        float: left;
        height: 80px;
        align-items: center;
        margin-left: 1rem;
        margin-right: 1rem;
        align-content: center;
    }

    .search-product input {
        padding: 10px 15px;
        border: 2px solid lightgray;
        border-radius: 50px;
    }

    nav.main-nav {
        justify-content: space-between;
        display: flex;
    }

    .header-area.header-sticky .nav li a {
        width: max-content;
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
    <nav class="main-nav">
        <ul class="nav">
            <?php foreach ($categories as $cat) {
                if (count($cat->items) > 0) { ?>
                    <li><a href="#<?= str_replace(" ", "-", strtolower($cat->name)) ?>"><?= $cat->name ?></a></li>
            <?php }
            } ?>
        </ul>
        <!-- one page search product desktop -->
        <div class="search-product desktop d-none d-lg-flex">
            <input type="text" placeholder="Cari produk...">
        </div>

        <!-- one page search product mobile -->
        <div class="search-product mobile d-flex d-lg-none">
            <input type="text" placeholder="Cari produk...">
        </div>
        <a class="menu-trigger">
            <span>Menu</span>
        </a>
    </nav>
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
                    <div class="row product py-5 g-4" data-product='<?= json_encode($item) ?>'>
                        <div class="col-12 col-lg-4">
                            <img src="<?= base_url("assets/frontend/images/uploads/catalogue/" . $item->image) ?>" class="img-fluid">
                        </div>
                        <div class="col-12 col-lg-8">
                            <div class="row g-3">
                                <div class="col-12">
                                    <h3 class="fw-bold mb-1 product-name"><?= $item->brand_name ?> | <?= $item->name ?></h3>
                                    <h5 class="product-price"><?= $ctr->toRupiah($item->price) ?></h5>
                                </div>
                                <div class="col-12 action">
                                    <div class="input-group qty-wrapper border">
                                        <span class="input-group-btn">
                                            <button type="button" class="btn btn-light btn-sm btn-number h-100" data-type="minus">
                                                <i class="fa fa-minus"></i>
                                            </button>
                                        </span>
                                        <input type="text" class="form-control form-control-sm input-number quantity text-center" style="height: 35px;" value="1" disabled>
                                        <span class="input-group-btn">
                                            <button type="button" class="btn btn-light btn-sm btn-number h-100" data-type="plus">
                                                <i class="fa fa-plus"></i>
                                            </button>
                                        </span>
                                    </div>
                                    <button class="btn-primary-line mt-3 add-to-cart mt-4" data-product='<?= json_encode($item) ?>'><i class="fa fa-plus-circle me-1"></i> Tambah</button>
                                </div>
                                <div class="col-12">
                                    <p class="fw-bold mb-2">Spesifikasi:</p>
                                    <small class="product-description">
                                        <?= implode("&nbsp;&nbsp;|&nbsp;&nbsp;", $specification) ?>
                                    </small>
                                </div>
                                <?php if ($item->datasheet) { ?>
                                    <div class="col-12">
                                        <a target="_blank" href="<?= $item->datasheet ?>" class="btn-primary-line mt-3">Datasheet</a>
                                    </div>
                                <?php } ?>
                            </div>
                        </div>
                    </div>
                <?php } ?>
            </div>
        </section>
<?php }
} ?>

<section class="product-not-found py-5" style="display: none;">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <p class="text-center fw-bold">
                    <span>Produk yang Anda cari tidak ditemukan</span>
                </p>
            </div>
        </div>
    </div>
</section>

<a href="#" class="back-to-top" style="display: block;"><i class="fa fa-chevron-up"></i></a>

<div class="fixed-cart">
    <i class="fa fa-shopping-bag"></i>
    <span class="position-absolute top-0 start-0 translate-middle badge rounded-pill bg-danger">0</span>
</div>

<div class="cart-container p-3" style="display: none;">
    <div class="cart-header d-flex justify-content-between align-items-center">
        <h3 class="fw-bold">List Produk</h3>
        <button class="close-cart btn btn-danger"><i class="fa fa-times"></i></button>
    </div>
    <div class="cart-body py-3">
        <div class="cart-items">
        </div>
    </div>
    <div class="cart-footer border-top pt-4">
        <div class="row">
            <div class="col-8 text-end">
                <p class="fw-bold">Total</p>
            </div>
            <div class="col-4 d-flex justify-content-between">
                <p class="fw-bold">Rp</p>
                <p class="fw-bold total-price"></p>
            </div>
            <div class="col-12">
                <button class="btn-primary-line mt-4 request-quotation-1 float-end">Lanjut</button>
            </div>
        </div>
    </div>
</div>

<div class="customer-data-container p-3" style="display: none;">
    <div class="customer-data-header d-flex justify-content-between align-items-center">
        <h3 class="fw-bold">Data Customer</h3>
        <button class="close-customer-data btn btn-danger"><i class="fa fa-times"></i></button>
    </div>
    <div class="customer-data-body py-3">
        <div class="row">
            <div class="col-12 mb-3">
                <div class="form-group">
                    <label for="">Nama Lengkap</label>
                    <input type="text" class="form-control" name="name" placeholder="Nama">
                </div>
            </div>
            <div class="col-12 mb-3">
                <div class="form-group">
                    <label for="">Email</label>
                    <input type="email" class="form-control" name="email" placeholder="Email">
                </div>
            </div>
            <div class="col-12 mb-3">
                <div class="form-group">
                    <label for="">Telepon</label>
                    <input type="text" class="form-control" name="phone" placeholder="Telepon">
                </div>
            </div>

            <div class="col-12 mb-3">
                <div class="form-group">
                    <label for="">Alamat</label>
                    <textarea class="form-control" name="address" placeholder="Alamat"></textarea>
                </div>
            </div>
        </div>
    </div>
    <div class="customer-data-footer">
        <div class="row">
            <div class="col-12">
                <button class="btn-primary-line mt-4 request-quotation-2 float-end">Kirim</button>
            </div>
        </div>
    </div>
</div>

<script>
    function formatRupiah(angka, prefix) {
        var number_string = angka.toString().replace(/[^,\d]/g, '').toString(),
            split = number_string.split(','),
            sisa = split[0].length % 3,
            rupiah = split[0].substr(0, sisa),
            ribuan = split[0].substr(sisa).match(/\d{3}/gi);

        if (ribuan) {
            separator = sisa ? '.' : '';
            rupiah += separator + ribuan.join('.');
        }

        rupiah = split[1] != undefined ? rupiah + ',' + split[1] : rupiah;
        return prefix == undefined ? rupiah : (rupiah ? 'Rp. ' + rupiah : '');
    }

    function checkCart() {
        const cart = JSON.parse(localStorage.getItem("cart"));
        if (cart) {
            const qty = cart.map(item => item.qty).reduce((a, b) => a + b, 0);
            if ($(".fixed-cart .badge").length) {
                $(".fixed-cart .badge").text(qty);
            } else {
                $(".fixed-cart").append(`<span class="position-absolute top-0 start-0 translate-middle badge rounded-pill bg-danger">${qty}</span>`);
            }
        }
    }

    function checkItemInCart() {
        $(".product").each(function() {
            $(this).find(".remove-from-cart").remove();
            const product = $(this).data("product");
            const cart = JSON.parse(localStorage.getItem("cart"));
            if (cart) {
                const item = cart.find(item => item.id == product.id);
                if (item) {
                    $(this).find(".action").append(`<span class="text-danger ms-3 mt-3 remove-from-cart" data-id='${product.id}'><i class="fa fa-times-circle me-1"></i> Hapus</span>`);
                }
            }
        });
    }

    function openCart() {
        $(".cart-container").find(".cart-items").html("");
        const cart = JSON.parse(localStorage.getItem("cart"));
        if (cart && cart.length > 0) {
            $(".cart-container").find(".cart-items").html(`
                <div class="cart-item mb-2">
                    <div class="row fw-bolder">
                        <div class="col-7">
                            Produk
                        </div>
                        <div class="col-1">
                            Qty
                        </div>
                        <div class="col-4">
                            Harga
                        </div>
                    </div>
                </div>
            `);

            cart.forEach(item => {
                $(".cart-container").find(".cart-items").append(`
                <div class="cart-item my-1">
                    <div class="row align-items-center">
                        <div class="col-2">
                            <img src="<?= base_url("assets/frontend/images/uploads/catalogue/") ?>${item.image}" class="img-fluid">
                        </div>
                        <div class="col-5">
                            <span class="fw-bold mb-1">${item.brand_name} | ${item.name}</span>
                        </div>
                        <div class="col-1 text-center">
                            <span class="fw-bold">${item.qty}</span>
                        </div>
                        <div class="col-4 d-flex justify-content-between">
                            <span class="fw-bold">Rp </span>
                            <span class="fw-bold">${formatRupiah(item.price * item.qty)}</span>
                        </div>
                    </div>
                </div>`);
            });

            $(".cart-container").find(".total-price").text(formatRupiah(cart.map(item => item.price * item.qty).reduce((a, b) => a + b, 0)));
        } else {
            $(".cart-container").find(".cart-items").append(`
            <div class="cart-item">
                <div class="row align-items-center">
                    <div class="col-12 text-center">
                        <span class="fw-bold">Produk masih kosong</span>
                    </div>
                </div>
            </div>
            `);

            $(".cart-container").find(".total-price").text(0);
        }
    };

    $(".search-product input").on("keyup change", function() {
        const matcher = new RegExp($(this).val(), 'gi');
        $('.product').show().not(function() {
            return matcher.test($(this).find(".product-name, .product-price, .product-description").text())
        }).hide();
        $(".products").each(function() {
            if ($(this).find(".product:visible").length == 0) {
                $(this).prev().hide();
            } else {
                $(this).prev().show();
            }
        });

        if ($(".product:visible").length == 0) {
            $(".product-not-found").show();
        } else {
            $(".product-not-found").hide();
        }
    });

    $(".fixed-cart").on("click", function() {
        $(".cart-container").fadeIn(200);
        $("body").addClass("overflow-hidden");
        openCart();
    });

    $(".close-cart").on("click", function() {
        $(".cart-container").fadeOut(200);
        $("body").removeClass("overflow-hidden");
    });

    $(".close-customer-data").on("click", function() {
        $(".customer-data-container").fadeOut(200);
    });

    $(".add-to-cart").on("click", function() {
        const product = $(this).data("product");
        product.qty = parseInt($(this).parent().find(".quantity").val());
        let cart = JSON.parse(localStorage.getItem("cart"));
        if (cart) {
            const findProduct = cart.find(item => item.id === product.id);
            if (findProduct) {
                findProduct.qty = parseInt(findProduct.qty) + parseInt(product.qty);
            } else {
                cart.push(product);
            }
        } else {
            cart = [product];
        }
        localStorage.setItem("cart", JSON.stringify(cart));
        checkCart();
        checkItemInCart();
    });

    $(document).on("click", ".remove-from-cart", function() {
        const id = $(this).data("id");
        let cart = JSON.parse(localStorage.getItem("cart"));
        const findProduct = cart.find(item => item.id == id);
        if (findProduct) {
            cart = cart.filter(item => item.id != id);
        }
        localStorage.setItem("cart", JSON.stringify(cart));
        checkCart();
        checkItemInCart();
    });

    $("[data-type=plus]").on("click", function() {
        const qty = $(this).parents(".product").find(".input-number").val();
        $(this).parents(".product").find(".input-number").val(parseInt(qty) + 1);
    });

    $("[data-type=minus]").on("click", function() {
        const qty = $(this).parents(".product").find(".input-number").val();
        if (parseInt(qty) > 1) {
            $(this).parents(".product").find(".input-number").val(parseInt(qty) - 1);
        }
    });

    $(".request-quotation-1").on("click", function() {
        if (!localStorage.getItem("cart")) {
            return CustomAlert.fire({
                title: 'Peringatan',
                text: 'Produk masih kosong',
                icon: 'warning'
            }).then(() => {
                $(".cart-container").fadeOut(200);
                $("body").removeClass("overflow-hidden");
            })
        }

        if (JSON.parse(localStorage.getItem("cart")).length == 0) {
            return CustomAlert.fire({
                title: 'Peringatan',
                text: 'Produk masih kosong',
                icon: 'warning'
            }).then(() => {
                $(".cart-container").fadeOut(200);
                $("body").removeClass("overflow-hidden");
            })
        }

        const customer = JSON.parse(localStorage.getItem("customer"));
        if (customer) {
            $(".customer-data-container").find("[name=name]").val(customer.name);
            $(".customer-data-container").find("[name=email]").val(customer.email);
            $(".customer-data-container").find("[name=phone]").val(customer.phone);
            $(".customer-data-container").find("[name=address]").val(customer.address);
        }
        $(".customer-data-container").fadeIn(200);
    });

    $(".request-quotation-2").on("click", function() {
        CustomAlert.showLoading();

        const custData = {
            name: $("[name=name]").val(),
            email: $("[name=email]").val(),
            phone: $("[name=phone]").val(),
            address: $("[name=address]").val(),
        }

        if (custData.name == "" || custData.email == "" || custData.phone == "" || custData.address == "") {
            // tampilkan error
            return CustomAlert.fire({
                title: 'Peringatan',
                text: 'Data customer tidak lengkap',
                icon: 'warning'
            });
        }

        localStorage.setItem("customer", JSON.stringify(custData));

        const customer = localStorage.getItem("customer");
        const cart = JSON.parse(localStorage.getItem("cart"));

        const data = new FormData();
        data.append("customer", customer);
        data.append("products", JSON.stringify(
            cart.map(item => {
                return {
                    name: `${item.brand_name} | ${item.name}`,
                    qty: item.qty,
                    price: parseInt(item.price),
                    discount: 0
                }
            })
        ));
        $.ajax({
            url: "<?= base_url("api/request_quotation") ?>",
            type: "POST",
            data: data,
            processData: false,
            contentType: false,
            success: function(response) {
                if (response.success) {
                    localStorage.removeItem("cart");
                    // tampilkan swal2 success
                    CustomAlert.fire({
                        title: "Berhasil",
                        text: "Pesanan Anda berhasil dikirim",
                        icon: "success",
                    }).then(function() {
                        window.location.reload();
                    });
                } else {
                    // tampilkan swal2 error
                    CustomAlert.fire({
                        title: "Gagal",
                        text: "Pesanan Anda gagal dikirim",
                        icon: "error",
                    })
                }
            },
        });
    });



    $(function() {
        checkCart();
        checkItemInCart();
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
                    $(".back-to-top").addClass("show").fadeIn("200");
                    $(".header-area").addClass("header-sticky");
                } else {
                    $(".back-to-top").fadeOut("200", function() {
                        $(this).removeClass("show")
                    });
                    $(".header-area").removeClass("header-sticky");
                }
            }
        }
    })
</script>