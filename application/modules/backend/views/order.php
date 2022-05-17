<div class="container-fluid">
    <div class="header">
        <h1 class="header-title">
            Pesanan
        </h1>
    </div>
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <div class="card-actions float-end">
                        <a href="<?= base_url("backend/sales-quote") ?>" class="btn btn-primary text-white"><i class="fa fa-fw fa-scroll"></i> Sales Quote</a>
                    </div>
                    <h5 class="card-title">List Pesanan</h5>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="catalogue-table" class="table border table-striped w-100">
                            <thead>
                                <tr>
                                    <th>No. SQ</th>
                                    <th>Customer</th>
                                    <th>Total Item</th>
                                    <th>Sub-Total</th>
                                    <th>Tanggal</th>
                                    <th>Status</th>
                                    <th>Sales</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $i = 1;
                                foreach ($orders as $or) {
                                    $cust = json_decode($or->customer);
                                    $prod = json_decode($or->products);
                                    $counter = $ctr->SQ_Number($or->id);
                                ?>
                                    <tr>
                                        <td>
                                            SQ-<?= $counter ?>
                                        </td>
                                        <td>
                                            <p class="my-0"><?= $cust->name ?></p>
                                            <p class="my-0"><a href="tel:<?= $cust->phone ?>"><?= $cust->phone ?></a></p>
                                        </td>
                                        <td><?= count($prod) ?></td>
                                        <td><?= $ctr->toRupiah(array_sum(array_map(function ($item) {
                                                return $item->price * $item->qty;
                                            }, $prod))) ?>
                                        </td>
                                        <td><?= date("Y-m-d", strtotime($or->created_at)) ?></td>
                                        <td>
                                            <?php if ($or->status == 0) : ?>
                                                <span class="badge bg-info">Baru</span>
                                            <?php elseif ($or->status == 1) : ?>
                                                <span class="badge bg-warning">Proses</span>
                                            <?php elseif ($or->status == 2) : ?>
                                                <span class="badge bg-success">Deal</span>
                                                <span class="badge bg-primary">Selesai</span>
                                            <?php elseif ($or->status == 3) : ?>
                                                <span class="badge bg-danger">Batal</span>
                                                <span class="badge bg-primary">Selesai</span>
                                            <?php endif ?>
                                        </td>
                                        <td>
                                            <?php if ($or->name) : ?>
                                                <?= $or->name ?>
                                            <?php else : ?>
                                                -
                                            <?php endif ?>
                                        </td>
                                        <td>
                                            <div class="d-inline-block dropdown show">
                                                <a href="#" data-bs-toggle="dropdown" data-bs-display="static">
                                                    <i class="align-middle text-dark" data-feather="more-vertical"></i>
                                                </a>

                                                <div class="dropdown-menu dropdown-menu-end">
                                                    <?php if ($or->status == 0) : ?>
                                                        <?php if ($active_sq < $config->max_active_sq) { ?>
                                                            <button class="dropdown-item take-order" data-id="<?= $or->id ?>"><i class="fa fa-fw fa-check"></i> Ambil Pesanan</button>
                                                        <?php } else { ?>
                                                            <button class="dropdown-item" disabled><i class="fa fa-fw fa-check"></i> Ambil Pesanan</button>
                                                        <?php } ?>
                                                    <?php else : ?>
                                                        <button class="dropdown-item" disabled><i class="fa fa-fw fa-check"></i> Ambil Pesanan</button>
                                                    <?php endif; ?>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                <?php $i++;
                                } ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    $(".take-order").click(function() {
        const id = $(this).data("id");
        const url = "<?= base_url("api/take_order") ?>";
        const data = new FormData();
        data.append("id", id);

        $.ajax({
            url: url,
            type: "POST",
            data: data,
            beforeSend: () => $.LoadingOverlay("show"),
            complete: () => $.LoadingOverlay("hide"),
            contentType: false,
            processData: false,
            success: function(data) {
                if (data.success) {
                    Swal.fire({
                        title: "Berhasil",
                        text: data.message,
                        icon: "success",
                        confirmButtonText: "OK",
                    }).then(() => {
                        smoothState.load(data.data.redirect);
                    });
                } else {
                    Swal.fire({
                        title: "Gagal",
                        text: data.message,
                        icon: "error",
                    });
                }
            }
        });
    });


    $(document).ready(function() {
        $("#catalogue-table").DataTable({
            order: [
                [0, "desc"],
            ],
            columnDefs: [{
                targets: [7],
                sortable: false
            }]
        });
    })
</script>