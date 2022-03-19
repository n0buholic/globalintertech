<?php
$uri = $_SERVER['REQUEST_SCHEME'] . '://' . $_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'];
?>
<style>
    .title {
        font-size: 45px;
    }

    .desc {
        word-spacing: 5;
        font-size: 20px;
    }

    .x2 {
        font-size: 70px;
    }

    .x3 {
        font-size: 140px;
    }

    .features-small-item {
        display: block;
        background: linear-gradient(135deg, #6A30D1 0%, #5C83E3 100%);
        border-radius: 40px 40px 40px 40px;
        padding: 30px;
        text-align: center;
        position: relative;
        overflow: hidden;
        margin-bottom: 30px;
        color: white;
    }

    .table-custom thead tr {
        background: linear-gradient(135deg, #6A30D1 0%, #5C83E3 100%);
    }

    .features-small-item .features-title,
    .features-small-item p {
        color: white;
    }

    .btn-primary-line {
        background: linear-gradient(135deg, #6A30D1 0%, #5C83E3 100%);
    }

    .btn-primary-line::before {
        background: linear-gradient(135deg, #6A30D1 0%, #5C83E3 100%);
    }

    .features-small-item p {
        font-size: 18px;
    }

    .card-header {
        background: linear-gradient(135deg, #6A30D1 0%, #5C83E3 100%);
        color: #fff;
    }

    .features-small-item:before {
        content: "";
        position: absolute;
        width: 100%;
        height: 100%;
        top: 0px;
        left: 0px;
        background: linear-gradient(135deg, #6A30D1 0%, #5C83E3 100%);
        -webkit-transition: all 0.3s ease 0s;
        -moz-transition: all 0.3s ease 0s;
        -o-transition: all 0.3s ease 0s;
        transition: all 0.3s ease 0s;
        opacity: 0;
    }

    .features-small-item .icon {
        width: 67px;
        height: 67px;
        margin: auto;
        position: relative;
        margin-bottom: 20px;
        background: #F6F4FD;
        border-radius: 50px;
        color: #c9962f;
        font-weight: bolder;
    }

    .double-line-frame {
        border: 6px;
        border-color: #f0bc59;
        border-style: double;
        padding: 40px;
        position: relative;
    }

    .double-line-frame:before {
        content: "PROMO 2022";
        position: absolute;
        top: -17px;
        background: #f0bc59;
        left: 50%;
        transform: translateX(-50%);
        padding: 0px 12px;
        color: #8b5d06;
        font-weight: bold;
        letter-spacing: 6px;
        width: 20rem;
    }

    .page {
        margin-bottom: -15px;
    }

    .top-logo img {
        width: 65%;
        height: 100%;
    }

    .top-logo {
        position: absolute;
        top: -89px;
        background: white;
        left: 50%;
        transform: translateX(-50%);
        width: 300px;
        height: 150px;
        border-radius: 50%;
        text-align: center;
        padding-top: 65px;
        box-shadow: 0px 2px 8px #00000042;
    }

    .left,
    .right {
        position: absolute;
        width: 200px;
    }

    .left {
        left: 5%;
        top: 0px;
    }

    .right {
        right: 5%;
        top: 0px;
    }

    footer {
        font-weight: bolder;
    }

    .package {
        cursor: pointer;
    }
</style>

<section class="section" style="padding: 35vh 0; background-image: url(<?= base_url("assets/frontend/images/promo/background.jpg") ?>); background-position: center center; background-size: cover;">
    <div class="top-logo">
        <img src="<?= base_url("assets/frontend/images/promo/hikvision_logo.svg") ?>">
    </div>
    <div class="container h-100 d-flex align-items-center">
        <div class="row g-5">
            <div class="col-md-6 text-center text-md-start">
                <div class="row">
                    <div class="col-7 d-flex align-items-center">
                        <img class="w-100" src="<?= base_url("assets/frontend/images/promo/hikvision_bullet.png") ?>">
                    </div>
                    <div class="col-5 d-flex align-items-center">
                        <img class="w-100" src="<?= base_url("assets/frontend/images/promo/hikvision_dome.png") ?>">
                    </div>
                </div>
            </div>
            <div class="col-md-6 d-grid align-content-center text-center text-md-start text-dark">
                <h1 class="display-6 fw-bold">PROMO HIKVISION 2022</h1>
                <p class="text-muted h5">Paket Promo Hikvision 2022</p>
                <div class="mt-4 row g-2">
                    <div class="col-md-auto"><a href="#promo-section" class="btn-primary-line"><i class="fas fa-cube me-1"></i> Lihat Paket</a></div>
                    <div class="col-md-auto"><a href="#form" class="btn-primary-line"><i class="fas fa-edit me-1"></i> Isi Formulir</a></div>
                    <div class="col-md-auto"><a href="#term" class="btn-primary-line"><i class="fas fa-bookmark me-1"></i> Syarat dan Ketentuan</a></div>
                </div>
            </div>
        </div>
    </div>
</section>

<section id="promo-section" class="section">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-12 text-center mb-5">
                <h1 class="display-6 fw-bold">PAKET PROMO</h1>
            </div>
            <?php foreach ($product as $p) { ?>
                <div class="col-md-4">
                    <div class="features-small-item package d-grid align-content-center p-5" data-id="<?= $p->id ?>">
                        <div class="icon">
                            <i class="fas fa-cubes mb-4 h1 text-secondary"></i>
                        </div>
                        <h5 class="features-title fw-bold m-0"><?= $p->name ?></h5>
                        <p class="display-5 m-0"><?= $ctr->toRupiah($p->price) ?></p>
                    </div>
                </div>
            <?php } ?>
            <div class="col-12 text-center mt-5">
                <div class="row text-center g-4">
                    <div class="col-md-4 d-flex align-items-center justify-content-center">
                        <img class="w-100" src="<?= base_url("assets/frontend/images/promo/hikvision_dvr.png") ?>">
                    </div>
                    <div class="col-6 col-md-4 d-flex align-items-center justify-content-center">
                        <img class="w-100" src="<?= base_url("assets/frontend/images/promo/hikvision_bullet.png") ?>">
                    </div>
                    <div class="col-6 col-md-4 d-flex align-items-center justify-content-center">
                        <img class="w-100" src="<?= base_url("assets/frontend/images/promo/hikvision_dome.png") ?>" style="width: 65% !important; object-fit: contain;">
                    </div>
                </div>
            </div>
            <div class="col-12 mt-4 text-center">
                <a href="#form" class="btn-primary-line"><i class="fas fa-edit me-1"></i> Isi Formulir</a>
            </div>
        </div>
    </div>
</section>

<section id="form" class="section padding-bottom-80 colored">
    <div class="container">
        <div class="row justify-content-center mb-4">
            <div class="col-md-12 mt-5">
                <div class="alert alert-custom alert-info">
                    <span class="">Jika Anda berminat, silahkan isi formulir data diri Anda dibawah ini.</span>
                </div>
            </div>
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header"><b><i class="fa fa-fw fa-edit"></i> FORMULIR DATA DIRI</b></div>
                    <div class="card-body">
                        <form id="form-promo-imlek" action="<?= base_url("frontend/submit_promo_imlek") ?>" method="POST">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group mb-2">
                                        <label for="nama">Nama Lengkap *</label>
                                        <input type="text" class="form-control" id="name" name="name" placeholder="Nama Lengkap" required>
                                    </div>
                                    <div class="form-group mb-2">
                                        <label for="handphone">No. HP/WhatsApp *</label>
                                        <input type="number" class="form-control" id="handphone" name="handphone" placeholder="No. HP/WhatsApp" required>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group mb-2">
                                        <label for="handphone">Alamat Email (opsional)</label>
                                        <input type="email" class="form-control" id="email" name="email" placeholder="Alamat Email">
                                    </div>
                                    <div class="form-group mb-2">
                                        <label for="package">Paket Promo *</label>
                                        <select class="form-control" name="package" required>
                                            <option value="">-- PILIH PAKET --</option>
                                            <?php foreach ($product as $p) { ?>
                                                <option value="<?= $p->id ?>"><?= $p->name ?> - <?= $ctr->toRupiah($p->price) ?></option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-lg-12 mt-3 selected-detail" style="display: none;">
                                    <div class="table-responsive">
                                        <table class="table table-striped align-middle table-custom detail">
                                            <thead>
                                                <tr>
                                                    <th>NAMA</th>
                                                    <th>TIPE</th>
                                                    <th>QTY</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group mb-2">
                                <small class="text-danger fw-bold d-block">* Harga yang tertera sudah termasuk instalasi dan waranty product selama 2 tahun</small>
                            </div>
                            <div class="form-group mb-2">
                                <div id="recaptcha"></div>
                            </div>
                            <div class="form-group d-grid mt-4">
                                <button class="btn-primary-line" type="submit">Kirim <i class="ms-2 fa fa-fw fas fa-arrow-right"></i></button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<section id="term" class="section padding-bottom-80">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header"><b><i class="fa fa-fw fa-bookmark"></i> SYARAT DAN KETENTUAN</b></div>
                    <div class="card-body">
                        <ul>
                            <li>Demi kenyamanan, kami membuat portal untuk registrasi sesuai dengan paket yang diinginkan
                                <a href="<?php echo $uri ?>"><?php echo $uri ?></a>
                            </li>
                            <li>
                                Setiap pembelanjaan Paket Hikvision berhak mendapatkan Merchandise menarik dari Hikvision.
                            </li>
                            <li>Program bagi-bagi merchandise hanya berlaku untuk pembelian paket, tidak bisa digunakan untuk pembelian regular</li>
                            <li>Dengan melakukan transaksi didalam program ini, maka konsumen dianggap mengerti dan menyetujui semua syarat dan ketentuan yang berlaku.</li>
                            <li>Global Integra Technology sewaktu-waktu berhak mengubah syarat dan ketentuan ini yang akan diinformasikan pada website <a href="<?php echo $uri ?>"><?php echo $uri ?></a></li>
                        </ul>
                        <div class="mt-5 text-center">
                            <p class="my-0">Supported by</p>
                            <img src="<?= base_url("assets/frontend/images/logo_700.png") ?>" style="width: 150px;">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<a href="#" class="back-to-top" style="display: block;"><i class="fa fa-chevron-up"></i></a>

<div class="modal fade" id="detail-modal" tabindex="-1">
    <div class="modal-dialog modal-md modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title text-dark">Detail Paket</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="table-responsive">
                    <table class="table table-striped align-middle table-custom detail">
                        <thead>
                            <tr>
                                <th>NAMA</th>
                                <th>TIPE</th>
                                <th>QTY</th>
                            </tr>
                        </thead>
                        <tbody>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>