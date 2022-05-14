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

    .product-name {
        text-overflow: ellipsis;
        white-space: nowrap;
        overflow: hidden;
    }

    .input-group-btn {
        z-index: 0;
    }

    .badge.outline {
        border: 1px solid var(--bs-danger);
    }

    .qty-wrapper {
        width: 90px;
        border-radius: 6px;
        overflow: hidden;
        position: relative;
    }

    .quantity {
        padding: 0;
    }

    .qty-wrapper * {
        border-radius: 0px;
        font-size: 10px;
    }

    .header {
        background-image: url(<?php echo base_url("assets/frontend/images/catalogue/header.jpg") ?>);
        background-position: center center;
        background-size: cover;
        width: 100%;
        height: 360px;
    }

    .close-cart,
    .close-customer-data,
    .close-preview-sales-quote {
        cursor: pointer;
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
        border-bottom: 1px solid #dee8f1;
    }

    .product:last-child {
        border-bottom: 0px;
    }

    .cart-item:last-child {
        border-bottom: 0px !important;
    }

    .header-area .main-nav .nav {
        margin-left: 0px;
        background: #ffffff;
    }

    .back-to-top {
        align-content: center;
        align-items: center;
        width: 40px;
        height: 40px;
        justify-content: center;
        right: 50%;
        transform: translateX(50%);
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
    .customer-data-container,
    .preview-sales-quote-container {
        position: fixed;
        z-index: 999;
        width: 100%;
        height: 100%;
        background: white;
        top: 0;
        left: 0;
        overflow-y: auto;
    }

    .cart-header,
    .customer-data-header,
    .preview-sales-quote-header {
        border-bottom: 1px solid #dddddd;
        box-shadow: 0px 0px 10px rgb(0 0 0 / 25%);
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
    }

    .header-area.header-sticky .nav li a {
        width: max-content;
    }

    .shake {
        animation: shake .7s;
    }

    @keyframes shake {

        0%,
        100% {
            transform: translateX(0px);
        }

        20%,
        80% {
            transform: translateX(-3px) rotate(-7deg);
        }

        40%,
        60% {
            transform: translateX(3px) rotate(7deg);
        }

        50% {
            transform: translateX(0px);
        }
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
        <!-- one page search product mobile -->
        <div class="search-product mobile d-flex d-lg-none">
            <input type="text" placeholder="Cari produk...">
        </div>

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
            <div class="container py-4">
                <div class="row g-3">
                    <?php foreach ($cat->items as $item) {
                        $specification = @explode("<br />", nl2br($item->specification));
                    ?>
                        <div class="col-lg-4 col-6 product-col">
                            <div class="product" data-product='<?= json_encode($item) ?>'>
                                <div class="card" style="border: 1px solid var(--bs-gray-300); box-shadow: 0 2px 10px 0 rgb(0 0 0 / 10%);">
                                    <div class="card-body p-3 row g-3">
                                        <div class="col-12 col-lg-4">
                                            <img src="<?= base_url("assets/frontend/images/uploads/catalogue/" . $item->image) ?>" class="img-fluid">
                                        </div>
                                        <div class="col-12 col-lg-8">
                                            <div class="row g-3">
                                                <div class="col-12">
                                                    <span class="badge bg-light text-danger mb-1 outline" style="font-size: 10px;"><?= $item->brand_name ?></span>
                                                    <p class="fw-bold mb-1 product-name"><?= $item->name ?></p>
                                                    <p class="product-price"><?= $ctr->toRupiah($item->price) ?></p>
                                                </div>
                                                <div class="col-12 action mt-0">
                                                    <button class="btn-primary-line mt-3 add-to-cart" style="padding: 16px;font-size: 10px;padding: 18px; width: 100% !important;" data-product='<?= json_encode($item) ?>'>Tambah</button>
                                                </div>
                                                <div class="col-12 d-none">
                                                    <p class="fw-bold mb-2">Spesifikasi:</p>
                                                    <small class="product-description">
                                                        <?= implode("&nbsp;&nbsp;|&nbsp;&nbsp;", $specification) ?>
                                                    </small>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php } ?>
                </div>
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

<div class="cart-container" style="display: none;">
    <div class="cart-header p-3">
        <h3 class="fw-bold d-flex align-items-center"><i style="font-size: 18px;" class="fa fa-chevron-left close-cart me-3"></i> Produk</h3>
    </div>
    <div class="cart-body p-3">
        <div class="cart-items">
        </div>
    </div>
    <div class="cart-footer border-top p-3">
        <div class="row">
            <div class="col-8 text-end">
                <p class="fw-bold">Total</p>
            </div>
            <div class="col-4 text-end">
                <p class="fw-bold total-price"></p>
            </div>
            <div class="col-12">
                <button class="btn-primary-line mt-4 request-quotation-1 float-end">Selanjutnya</button>
            </div>
        </div>
    </div>
</div>

<div class="customer-data-container" style="display: none;">
    <div class="customer-data-header p-3">
        <h3 class="fw-bold d-flex align-items-center"><i style="font-size: 18px;" class="fa fa-chevron-left close-customer-data me-3"></i> Data Customer</h3>
    </div>
    <div class="customer-data-body p-3 mt-3">
        <div class="row">
            <div class="col-12 mb-3">
                <div class="form-group">
                    <label for="">Nama Lengkap</label>
                    <input type="text" class="form-control" name="name" placeholder="Nama Lengkap">
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
    <div class="customer-data-footer p-3">
        <div class="row">
            <div class="col-12">
                <button class="btn-primary-line request-quotation-2 float-end">Buat Penawaran</button>
            </div>
        </div>
    </div>
</div>

<div class="preview-sales-quote-container" style="display: none;">
    <div class="preview-sales-quote-header p-3">
        <h3 class="fw-bold d-flex align-items-center"><i style="font-size: 18px;" class="fa fa-chevron-left close-preview-sales-quote me-3"></i> Pratinjau Penawaran</h3>
    </div>
    <div class="preview-sales-quote-body p-3 mt-3">
        <div class="row">
            <div class="col-12 mb-3 text-center ">
                <h1 class="text-success display-4 fw-bold mb-4"><i class="fa-solid fa-check-circle"></i> BERHASIL!</h1>
                <p class="mb-4">Pratinjau penawaran berhasil dibuat, silahkan klik tombol <strong>print</strong> untuk mencetak pratinjau penawaran yang sudah dibuat.</p>
                <p class="text-danger"><strong>Note</strong>: <br>Harga di dalam pratinjau penawaran belum termasuk biaya pemasangan dan lain-lain.</p>
            </div>
        </div>
    </div>
    <div class="customer-data-footer p-3">
        <div class="row g-2">
            <div class="col-lg-6 d-grid">
                <button class="btn-primary-line email-preview-sales-quote" style="width: 100% !important;">Kirim ke Email</button>
            </div>
            <div class="col-lg-6 d-grid">
                <button class="btn-primary-line print-preview-sales-quote" style="width: 100% !important;">Print</button>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="modal-product" tabindex="-1">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Detail Produk</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-12">
                        <div>
                            <img src="" alt="" class="img-fluid product-image">
                        </div>
                    </div>
                    <div class="col-12 mb-3">
                        <p>
                            <span class="badge text-danger outline product-brand mb-1"></span>
                            <span class="product-name"></span>
                        </p>
                        <p class="product-price"></p>
                    </div>
                    <div class="col-12">
                        <div>
                            <p class="fw-bold">Deskripsi: </p>
                            <small class="product-description"></small>
                        </div>
                    </div>
                    <div class="col-12">
                        <div>
                            <a class="product-datasheet d-block text-secondary"></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="<?=base_url("assets/frontend/vendor/print-js/dist/print.js")?>"></script>

<script>
    $(document).on("click", ".product", function(e) {
        if (e.target.className.includes("add-to-cart")) return;
        const product = $(this).data("product");
        const product_image = product.image;
        const product_name = product.name;
        const product_price = product.price;
        const product_description = product.specification;
        const product_datasheet = product.datasheet;
        const product_brand = product.brand_name;

        const modal = $("#modal-product");

        modal.find(".product-image").attr("src", "<?= base_url("assets/frontend/images/uploads/catalogue/") ?>" + product_image);
        modal.find(".product-name").text(product_name);
        modal.find(".product-price").text(`Rp ${formatRupiah(product_price)}`);
        modal.find(".product-description").text(product_description);
        if (product_datasheet) {
            modal.find(".product-datasheet").html(`<i class="fa-solid fa-file-lines me-1"></i> Datasheet`).attr("href", product_datasheet).attr("target", "_blank").attr("style", "margin-top: 1rem;");
        } else {
            modal.find(".product-datasheet").html("").attr("src", "#").removeAttr("target").removeAttr("style");
        }
        modal.find(".product-brand").text(product_brand);

        modal.modal("show");
    });

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
        return false;
    }

    function updateCart() {
        $(".cart-container").find(".cart-items").html("");
        const cart = JSON.parse(localStorage.getItem("cart"));
        if (cart && cart.length > 0) {
            cart.forEach(item => {
                $(".cart-container").find(".cart-items").append(`
                <div class="cart-item py-3 border-bottom">
                    <div class="row align-items-center">
                        <div class="col-2">
                            <img src="<?= base_url("assets/frontend/images/uploads/catalogue/") ?>${item.image}" class="img-fluid">
                        </div>
                        <div class="col-10">
                            <p class="mb-0">${item.brand_name} | ${item.name}</p>
                            <p class="fw-bold" style="font-size: 12px;">Rp${formatRupiah(item.price)}</p>
                            <div class="d-flex align-items-center mt-2">
                                <div class="input-group qty-wrapper border">
                                    <span class="input-group-btn">
                                        <button type="button" class="btn btn-light btn-sm btn-number h-100" data-type="minus">
                                            <i class="fa fa-minus"></i>
                                        </button>
                                    </span>
                                    <input type="text" class="form-control form-control-sm input-number quantity text-center" style="height: 15px;" value="${item.qty}" data-id="${item.id}" disabled>
                                    <span class="input-group-btn">
                                        <button type="button" class="btn btn-light btn-sm btn-number h-100" data-type="plus">
                                            <i class="fa fa-plus"></i>
                                        </button>
                                    </span>
                                </div>
                                <i class="fa fa-trash ms-3 text-danger remove-from-cart" data-id="${item.id}"></i>
                            </div>
                        </div>
                    </div>
                </div>`);
            });
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
        }

        updateTotalPrice();
    };

    function updateTotalPrice() {
        const cart = JSON.parse(localStorage.getItem("cart"));
        if (cart && cart.length > 0) {
            $(".cart-container").find(".total-price").text(`Rp${formatRupiah(cart.map(item => item.price * item.qty).reduce((a, b) => a + b, 0))}`);
        } else {
            $(".cart-container").find(".total-price").text(`Rp0`);
        }
    }

    $(".search-product input").keydown(function(e) {
        if (event.keyCode == 13) {
            $(this).trigger('blur');
            e.preventDefault();
            return false;
        }
    });

    $(".search-product input").on("keyup change", function() {
        const matcher = $(this).val();
        $('.product-col, .products').show().not(function() {
            return $(this).find(".product-name, .product-price, .product-description").text().toLocaleLowerCase().includes(matcher.toLowerCase())
        }).hide();
        $(".products").each(function() {
            if ($(this).find(".product-col:visible").length == 0) {
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
        $(".cart-container").effect("slide", {
            direction: "right",
            mode: "show"
        });
        //$("body").addClass("overflow-hidden");
    });

    $(".close-cart").on("click", function() {
        $(".cart-container").effect("slide", {
            direction: "right",
            mode: "hide"
        });
        // $("body").removeClass("overflow-hidden");
    });

    $(".close-customer-data").on("click", function() {
        $(".customer-data-container").effect("slide", {
            direction: "right",
            mode: "hide"
        });
    });

    $(".close-preview-sales-quote").on("click", function() {
        $(".preview-sales-quote-container").effect("slide", {
            direction: "right",
            mode: "hide"
        });
    });

    $(document).on("click", ".add-to-cart", function(e) {
        const fixedCart = $(".fixed-cart");
        const button = $(this);
        const productImage = button.parents(".product").find("img");
        if (productImage) {
            const imgclone = productImage.clone()
                .offset({
                    top: productImage.offset().top,
                    left: productImage.offset().left
                })
                .css({
                    'opacity': '0.5',
                    'position': 'absolute',
                    'height': productImage.height(),
                    'width': productImage.width(),
                    'z-index': '100'
                })
                .appendTo($('body'))
                .animate({
                    'top': fixedCart.offset().top + 10,
                    'left': fixedCart.offset().left + 10,
                    'width': 10,
                    'height': 10
                }, 1000, 'easeInOutExpo');

            setTimeout(function() {
                fixedCart.addClass('shake');
                setTimeout(function() {
                    fixedCart.removeClass('shake');
                }, 700);

                // selesai tambah

                const product = button.data("product");
                product.qty = 1;
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
                updateCart();
            }, 1000);

            imgclone.animate({
                'width': 0,
                'height': 0
            }, function() {
                $(this).detach()
            });
        }
    });

    $(document).on("click", ".print-preview-sales-quote", function() {
        const sq = JSON.parse(localStorage.getItem("sales_quote"));
        if (sq != null) {
            printJS({
                printable: "<?=base_url("sales-quote-preview/view?id=")?>" + sq.id,
                showModal: true,
                modalMessage: "Mengambil File..."
            });
        }
    });

    $(document).on("click", ".email-preview-sales-quote", function() {
        CustomAlert.showLoading();
        const email = JSON.parse(localStorage.getItem("customer")).email;
        const id = JSON.parse(localStorage.getItem("sales_quote")).id;
        const data = new FormData();
        data.append("email", email);
        data.append("id", id);
        $.ajax({
            url: "<?= base_url("api/email_preview_sales_quote") ?>",
            type: "POST",
            data: data,
            processData: false,
            contentType: false,
            success: function(response) {
                if (response.success) {
                    CustomAlert.fire({
                        title: "Berhasil",
                        text: "response.message",
                        icon: "success",
                        showCancelButton: false,
                    })
                } else {
                    CustomAlert.fire({
                        title: "Gagal",
                        text: response.message,
                        icon: "error",
                        showCancelButton: false,
                    })
                }
            }
        });
    });

    $(document).on("click", ".remove-from-cart", function() {
        const id = $(this).data("id");
        let cart = JSON.parse(localStorage.getItem("cart"));
        const findProduct = cart.find(item => item.id == id);
        if (findProduct) {
            cart = cart.filter(item => item.id != id);
            localStorage.setItem("cart", JSON.stringify(cart));
            $(this).parents(".cart-item").fadeOut(200, function() {
                $(this).remove();
                checkCart();
                updateTotalPrice();
                if (cart.length == 0) {
                    $(".cart-container").find(".cart-items").append(`
                    <div class="cart-item">
                        <div class="row align-items-center">
                            <div class="col-12 text-center">
                                <span class="fw-bold">Produk masih kosong</span>
                            </div>
                        </div>
                    </div>
                `);
                }
            });
        }
    });

    $(document).on("click", "[data-type=plus]", function() {
        const cart = JSON.parse(localStorage.getItem("cart"));
        const qty = $(this).parents(".qty-wrapper").find(".quantity");
        const itemId = qty.data("id");
        const findProduct = cart.find(item => item.id == itemId);
        if (findProduct) {
            findProduct.qty = parseInt(findProduct.qty) + 1;
            $(this).parents(".qty-wrapper").find(".quantity").val(findProduct.qty);
        }
        localStorage.setItem("cart", JSON.stringify(cart));
        checkCart();
        updateTotalPrice();
    });

    $(document).on("click", "[data-type=minus]", function() {
        const cart = JSON.parse(localStorage.getItem("cart"));
        const qty = $(this).parents(".qty-wrapper").find(".quantity");
        if (parseInt(qty.val()) > 1) {
            const itemId = qty.data("id");
            const findProduct = cart.find(item => item.id == itemId);
            if (findProduct) {
                findProduct.qty = parseInt(findProduct.qty) - 1;
                $(this).parents(".qty-wrapper").find(".quantity").val(parseInt(qty.val()) - 1);
            }
            localStorage.setItem("cart", JSON.stringify(cart));
            checkCart();
            updateTotalPrice();
        }
    });

    $(".request-quotation-1").on("click", function() {
        if (!localStorage.getItem("cart")) {
            return CustomAlert.fire({
                title: 'Peringatan',
                text: 'Produk masih kosong',
                icon: 'warning'
            }).then(() => {
                $(".cart-container").effect("slide", {
                    direction: "right",
                    mode: "hide"
                });
                // $("body").removeClass("overflow-hidden");
            })
        }

        if (JSON.parse(localStorage.getItem("cart")).length == 0) {
            return CustomAlert.fire({
                title: 'Peringatan',
                text: 'Produk masih kosong',
                icon: 'warning'
            }).then(() => {
                $(".cart-container").effect("slide", {
                    direction: "right",
                    mode: "hide"
                });
                // $("body").removeClass("overflow-hidden");
            })
        }

        const customer = JSON.parse(localStorage.getItem("customer"));
        if (customer) {
            $(".customer-data-container").find("[name=name]").val(customer.name);
            $(".customer-data-container").find("[name=email]").val(customer.email);
            $(".customer-data-container").find("[name=phone]").val(customer.phone);
            $(".customer-data-container").find("[name=address]").val(customer.address);
        }
        $(".customer-data-container").effect("slide", {
            direction: "right",
            mode: "show"
        });
    });

    $(".request-quotation-2").on("click", function() {
        CustomAlert.showLoading();

        const custData = {
            name: $("[name=name]").val(),
            email: $("[name=email]").val(),
            phone: $("[name=phone]").val(),
            address: $("[name=address]").val(),
        }

        if (!localStorage.getItem("cart")) {
            return CustomAlert.fire({
                title: 'Peringatan',
                text: 'Produk masih kosong',
                icon: 'warning'
            }).then(() => {
                $(".customer-data-container").effect("slide", {
                    direction: "right",
                    mode: "hide"
                });
                $(".cart-container").effect("slide", {
                    direction: "right",
                    mode: "hide"
                });
                // $("body").removeClass("overflow-hidden");
            })
        }

        if (JSON.parse(localStorage.getItem("cart")).length == 0) {
            return CustomAlert.fire({
                title: 'Peringatan',
                text: 'Produk masih kosong',
                icon: 'warning'
            }).then(() => {
                $(".customer-data-container").effect("slide", {
                    direction: "right",
                    mode: "hide"
                });
                $(".cart-container").effect("slide", {
                    direction: "right",
                    mode: "hide"
                });
                // $("body").removeClass("overflow-hidden");
            })
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
                    id: item.id,
                    name: `${item.brand_name} | ${item.name}`,
                    description: item.specification,
                    qty: item.qty,
                    price: parseInt(item.price),
                    discount: 0
                }
            })
        ));

        let url;
        const sq = JSON.parse(localStorage.getItem("sales_quote"));

        if (sq == null) {
            url = "<?= base_url("api/request_quotation") ?>"
        } else {
            url = "<?= base_url("api/update_quotation") ?>";
            data.append("id", sq.id);
        }

        $.ajax({
            url: url,
            type: "POST",
            data: data,
            processData: false,
            contentType: false,
            success: function(response) {
                if (response.success) {
                    CustomAlert.close();
                    localStorage.setItem("sales_quote", JSON.stringify(response.data.sales_quote));
                    $(".preview-sales-quote-container").effect("slide", {
                        direction: "right",
                        mode: "show",
                    });
                } else {
                    // tampilkan swal2 error
                    CustomAlert.fire({
                        title: "Gagal",
                        text: response.message,
                        icon: "error",
                    })
                }
            },
        });
    });



    $(function() {
        updateCart();
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