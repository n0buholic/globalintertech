<header class="header-area header-white">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <nav class="main-nav">
                    <a href="javascript:void()" class="logo">
                        <img src="<?= base_url("assets/frontend/images/logo_700.png") ?>" />
                    </a>

                    <ul class="nav">
                        <li><a href="<?= base_url() ?>">Home</a></li>
                    </ul>
                    <a class="menu-trigger">
                        <span>Menu</span>
                    </a>
                </nav>
            </div>
        </div>
    </div>
</header>

<section class="section padding-bottom-80 padding-top-120" id="support-link">
    <div class="container" data-scroll-reveal="enter bottom move 50px over 0.6s after 0.2s">

        <div class="row mb-3">
            <div class="col-lg-12">
                <div class="center-heading">
                    <h2 class="section-title">Support Link</h2>
                </div>
            </div>
            <div class="col-lg-12 d-none">
                <div class="center-text">
                    <p></p>
                </div>
            </div>
        </div>


        <div class="row">
            <div class="col-lg-12">
                <div class="table-responsive">
                    <table class="table table-striped table-custom nobreak">
                        <thead>
                            <tr>
                                <th>NAMA FILE</th>
                                <th width=1>TOTAL UNDUH</th>
                                <th width=1></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($support as $supp) { ?>
                                <tr>
                                    <td><a target="_blank" href="<?= base_url("download-support-link?id=$supp->id") ?>"><?= $supp->name ?></a></td>
                                    <td class="text-center"><?=$supp->total_click?></td>
                                    <td><a target="_blank" href="<?= base_url("download-support-link?id=$supp->id") ?>" class="btn-primary-line btn-mini"><i class="fa me-1 fa-download"></i> Unduh</a></td>
                                </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</section>

<a href="#" class="back-to-top" style="display: block;"><i class="fa fa-chevron-up"></i></a>