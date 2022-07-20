<div class="container-fluid">
    <div class="header">
        <h1 class="header-title">
            Support Link
        </h1>
    </div>
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <div class="card-actions float-end">
                        <a href="<?= base_url("backend/add_support_link") ?>" class="btn btn-primary text-white"><i class="fa fa-fw fa-plus"></i> Tambah</a>
                    </div>
                    <h5 class="card-title">List Support Link</h5>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="support-link-table" class="table border table-striped w-100">
                            <thead>
                                <tr>
                                    <th>Nama</th>
                                    <th>URL</th>
                                    <th>Total Klik</th>
                                    <th width="180"></th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($data as $supp) { ?>
                                    <tr>
                                        <td>
                                            <?= $supp->name ?>
                                        </td>
                                        <td>
                                            <input type="text" class="form-control" value="<?= $supp->url ?>" readonly>
                                        </td>
                                        <td><?= $supp->total_click ?></td>
                                        <td>
                                            <div class="float-end">
                                                <a href="<?= base_url("backend/edit_support_link?id=$supp->id") ?>" class="btn btn-primary btn-sm"><i class="fa fa-fw fa-edit"></i> Ubah</a>
                                                <a href="<?= base_url("api/delete_support_link?id=$supp->id") ?>" class="btn btn-danger btn-sm no-smoothstate"><i class="fa fa-fw fa-trash"></i> Hapus</a>
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
        $("#support-link-table").DataTable({
            columnDefs: [{
                targets: [2],
                sortable: false
            }]
        });
    })
</script>