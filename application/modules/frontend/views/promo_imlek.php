<style>
    @import url('https://fonts.googleapis.com/css2?family=Satisfy&display=swap');

    .title {
        font-family: 'Satisfy', cursive;
        color: #f0bc59;
        font-size: 45px;
    }

    .desc {
        color: #f0bc59;
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
        background: linear-gradient(135deg, #ce9b33 0%, #e56829 100%);
        border-radius: 40px 40px 40px 40px;
        padding: 30px;
        text-align: center;
        position: relative;
        overflow: hidden;
        margin-bottom: 30px;
        color: white;
    }

    .features-small-item .features-title,
    .features-small-item p {
        color: white;
    }

    .btn-primary-line {
        background: linear-gradient(135deg, #ce9b33 0%, #e56829 100%);
    }

    .btn-primary-line::before {
        background: linear-gradient(135deg, #ce9b33 0%, #e56829 100%);
    }

    .features-small-item p {
        font-size: 18px;
    }

    .card-header {
        background: linear-gradient(135deg, #ce9b33 0%, #e56829 100%);
        color: #fff;
    }

    .features-small-item:before {
        content: "";
        position: absolute;
        width: 100%;
        height: 100%;
        top: 0px;
        left: 0px;
        background: linear-gradient(135deg, #ce9b33 0%, #e56829 100%);
        -webkit-transition: all 0.3s ease 0s;
        -moz-transition: all 0.3s ease 0s;
        -o-transition: all 0.3s ease 0s;
        transition: all 0.3s ease 0s;
        opacity: 0;
    }

    .features-small-item .icon {
        width: 67px;
        height: 67px;
        line-height: 70px;
        margin: auto;
        position: relative;
        margin-bottom: 20px;
        background: #F6F4FD;
        border-radius: 50px;
        color: #c9962f;
        font-weight: bolder;
    }

    .text-gold {
        font-size: 18px;
        color: #f0bc59;
    }

    .double-line-frame {
        border: 6px;
        border-color: #f0bc59;
        border-style: double;
        padding: 40px;
        position: relative;
    }

    .double-line-frame:before {
        content: "PROMO IMLEK 2022";
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
        background: #590b0c;
        background-image: url(<?= base_url("assets/frontend/images/lunar_new_year/bg-01.png") ?>);
        background-size: cover;
        background-position: 100% -15px;
        background-repeat: no-repeat;
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
        background: #500b14;
        color: #ffbbbb !important;
        font-weight: bolder;
    }
</style>

<img class="left d-none d-md-block" src="<?= base_url("assets/frontend/images/lunar_new_year/left.svg") ?>">
<img class="right d-none d-md-block" src="<?= base_url("assets/frontend/images/lunar_new_year/right.svg") ?>">
<section class="page">
    <div class="top-logo">
        <img src="<?= base_url("assets/frontend/images/lunar_new_year/hikvision_logo.svg") ?>">
    </div>
    <div class="page-bottom">
        <div class="container">
            <div class="row justify-content-center text-center mb-5">
                <div class="col-md-8">
                    <h1 class="fw-bold title font-size-20 mt-1">Happy Lunar New Year</h1>
                    <h1 class="fw-bold title x2 font-size-24 mb-2">2022</h1>
                    <img style="width: 500px; max-width: 80%;" src="<?= base_url("assets/frontend/images/lunar_new_year/tiger.svg") ?>">
                    <h1 class="fw-bold desc font-size-20 mt-3">YEAR OF TIGER</h1>
                </div>
            </div>
            <div class="row justify-content-center text-center mt-5">
                <div class="col-md-8">
                    <div class="double-line-frame">
                        <div class="row justify-content-center">
                            <div class="col-lg-4 col-12">
                                <div class="features-small-item">
                                    <div class="icon">
                                        4CH
                                    </div>
                                    <h5 class="features-title fw-bold">HIKVISION 2MP</h5>
                                    <p class="display-5">Rp 3.700.000</p>
                                </div>
                            </div>
                            <div class="col-lg-4 col-12">
                                <div class="features-small-item">
                                    <div class="icon">
                                        8CH
                                    </div>
                                    <h5 class="features-title fw-bold">HIKVISION 2MP</h5>
                                    <p class="display-5">Rp 5.700.000</p>
                                </div>
                            </div>
                            <div class="col-lg-4 col-12">
                                <div class="features-small-item">
                                    <div class="icon">
                                        16CH
                                    </div>
                                    <h5 class="features-title fw-bold">HIKVISION 2MP</h5>
                                    <p class="display-5">Rp 9.899.000</p>
                                </div>
                            </div>
                            <div class="col-12">
                                <img src="<?= base_url("assets/frontend/images/lunar_new_year/hikvision.png") ?>" style="width: 350px; max-width: 80%;">
                            </div>
                        </div>
                        <div class="row mt-4">
                            <div class="col-md-4 my-2">
                                <img src="<?= base_url("assets/frontend/images/lunar_new_year/angpao.png") ?>" style="width: 250px; max-width: 100%;">
                            </div>
                            <div class="col-md-8 align-self-center my-2">
                                <p class="my-0 text-gold x3">Dapatkan juga ANGPAO hingga <span class="fw-bold">Rp 1.000.000!</span></p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-8 mt-5">
                    <div class="alert alert-custom alert-warning">
                        <span class="text-gold">Jika Anda berminat, silahkan isi formulir data diri Anda dibawah ini.</span>
                    </div>
                </div>
            </div>
            <div class="row justify-content-center mb-4">
                <div class="col-md-8">
                    <div class="card">
                        <div class="card-header"><b><i class="fa fa-fw fa-edit"></i> FORMULIR DATA DIRI</b></div>
                        <div class="card-body">
                            <form id="form-promo-imlek" action="<?= base_url("frontend/submit_promo_imlek") ?>" method="POST">
                                <div class="form-group mb-2">
                                    <label for="nama">Nama Lengkap *</label>
                                    <input type="text" class="form-control" id="name" name="name" placeholder="Nama Lengkap" required>
                                </div>
                                <div class="form-group mb-2">
                                    <label for="handphone">No. HP/WhatsApp *</label>
                                    <input type="number" class="form-control" id="handphone" name="handphone" placeholder="No. HP/WhatsApp" required>
                                </div>
                                <div class="form-group mb-2">
                                    <label for="handphone">Alamat Email (opsional)</label>
                                    <input type="email" class="form-control" id="email" name="email" placeholder="Alamat Email">
                                </div>
                                <div class="form-group mb-2">
                                    <label for="package">Paket Promo *</label>
                                    <select class="form-control" name="package" required>
                                        <?php foreach ($product as $p) { ?>
                                            <option value="<?= $p->id ?>"><?= $p->name ?> - <?= $ctr->toRupiah($p->price) ?></option>
                                        <?php } ?>
                                    </select>
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
            <div class="row justify-content-center">
                <div class="col-md-8">
                    <div class="card">
                        <div class="card-header"><b><i class="fa fa-fw fa-bookmark"></i> SYARAT DAN KETENTUAN</b></div>
                        <div class="card-body">
                            <ul>
                                <li>Demi kenyamanan, kami membuat portal untuk registrasi sesuai dengan paket yang diinginkan
                                    <a href="https://www.globalintertech.co.id/promo-imlek">https://www.globalintertech.co.id/promo-imlek</a>
                                </li>
                                <li>
                                    Setiap pembelanjaan Paket Hikvision berhak mendapatkan Angpao dengan mengikuti Lucky Wheel, Cashback
                                    sampai dengan 1 juta Rupiah!
                                </li>
                                <li>Konsumen dapat melakukan transaksi berulang selama periode promo berlangsung</li>
                                <li>Cashback akan langsung dipotong pada saat transaksi</li>
                                <li>Cashback hanya berlaku untuk pembelian paket, tidak bisa digunakan untuk pembelian regular</li>
                                <li>Dengan melakukan transaksi didalam program ini, maka konsumen dianggap mengerti dan menyetujui semua syarat dan ketentuan yang berlaku.</li>
                                <li>Global Integra Technology sewaktu-waktu berhak mengubah syarat dan ketentuan ini yang akan diinformasikan pada website <a href="https://www.globalintertech.co.id/promo-imlek">https://www.globalintertech.co.id/promo-imlek</a></li>
                            </ul>
                            <div class="mt-5 text-center">
                                <p class="my-0">Supported by</p>
                                <img src="<?=base_url("assets/frontend/images/logo_700.png")?>" style="width: 150px;">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<a href="#" class="back-to-top" style="display: block;"><i class="fa fa-chevron-up"></i></a>

<footer>
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <p class="text-center">Global Integra Technology</p>
            </div>
        </div>
    </div>
</footer>