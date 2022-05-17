<div class="container-fluid">
    <div class="header">
        <h1 class="header-title">
            Selamat datang, <?= $myInfo->name ?>!
        </h1>
    </div>
    <div class="row">
        <div class="col-md-4">
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col mt-0">
                            <h5 class="card-title">Total Katalog</h5>
                        </div>

                        <div class="col-auto">
                            <div class="avatar">
                                <div class="avatar-title rounded-circle bg-primary-dark">
                                <i class="align-middle" data-feather="box"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                    <h1 class="display-5 mt-2 mb-4"><?= $catalogue_count ?></h1>
                    <div class="mb-0">
                        <a href="<?=base_url("backend/add_catalogue")?>" class="btn btn-pill btn-primary"><i class="align-middle me-1" data-feather="plus-circle"></i> <span class="align-middle">Tambah Katalog</span></a>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col mt-0">
                            <h5 class="card-title">Total Promo Landing</h5>
                        </div>

                        <div class="col-auto">
                            <div class="avatar">
                                <div class="avatar-title rounded-circle bg-primary-dark">
                                <i class="align-middle" data-feather="tag"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                    <h1 class="display-5 mt-2 mb-4"><?= $promo_count ?></h1>
                    <div class="mb-0">
                        <a href="<?=base_url("backend/add_promo")?>" class="btn btn-pill btn-primary"><i class="align-middle me-1" data-feather="plus-circle"></i> <span class="align-middle">Tambah Promo</span></a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>