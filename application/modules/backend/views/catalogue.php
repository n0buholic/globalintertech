<div class="container-fluid">
    <div class="header">
        <h1 class="header-title">
            Katalog
        </h1>
    </div>
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <div class="card-actions float-end">
                        <a href="<?= base_url("backend/add_catalogue") ?>" class="btn btn-primary text-white"><i class="fa fa-fw fa-plus"></i> Tambah</a>
                    </div>
                    <h5 class="card-title">List Katalog</h5>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="catalogue-table" class="table table-striped w-100">
                            <thead>
                                <tr>
                                    <th>Nama</th>
                                    <th>Brand</th>
                                    <th>Kategori</th>
                                    <th>Harga</th>
                                    <th width="180"></th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($catalogue as $cat) { ?>
                                    <tr>
                                        <td>
                                            <div class="d-flex">
                                                <div style="width: 100px; height: 100px; display: grid;">
                                                    <img class="img-fluid img-thumbnail rounded align-self-center" src="<?= base_url("assets/frontend/images/uploads/catalogue/" . $cat->image) ?>">
                                                </div>
                                                <span class="ms-2 align-self-center fw-bold"><?= $cat->name ?></span>
                                            </div>
                                        </td>
                                        <td><?= $cat->category_name ?></td>
                                        <td><?= $ctr->toRupiah($cat->price) ?></td>
                                        <td>
                                            <div class="float-end">
                                                <a href="<?= base_url("backend/edit_catalogue?id=$cat->id") ?>" class="btn btn-primary btn-sm"><i class="fa fa-fw fa-edit"></i> Ubah</a>
                                                <a href="<?= base_url("api/delete_catalogue?id=$cat->id") ?>" class="btn btn-danger btn-sm no-smoothstate"><i class="fa fa-fw fa-trash"></i> Hapus</a>
                                            </div>
                                        </td>
                                    </tr>
                                <?php } ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    $(document).ready(function() {
        $("#catalogue-table").DataTable({
            columnDefs: [{
                targets: [3],
                sortable: false
            }]
        });
    })
</script>