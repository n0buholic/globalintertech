<div class="container-fluid">
    <div class="header">
        <h1 class="header-title">
            Sales Quote
        </h1>
    </div>
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title">List Sales Quote</h5>
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
                                    <th>Tanggal Pesanan</th>
                                    <th>Tanggal Selesai</th>
                                    <th>Status</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $i = 1;
                                foreach ($orders as $or) {
                                    $cust = json_decode($or->customer);
                                    $prod = json_decode($or->products);
                                    $counter = $ctr->CounterSQ($or->id);
                                ?>
                                    <tr>
                                        <td>
                                            SQ-<?= date("m", strtotime($or->created_at)) . date("y", strtotime($or->created_at)) . sprintf('%03d', $counter) ?>
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
                                        <td><?= date("Y-m-d", strtotime($or->finish_date)) ?></td>
                                        <td>
                                            <?php if ($or->status == 1) { ?>
                                                <span class="badge bg-warning">Proses</span>
                                            <?php } else if ($or->status == 2) { ?>
                                                <span class="badge bg-success">Selesai</span>
                                            <?php } else if ($or->status == 3) { ?>
                                                <span class="badge bg-danger">Batal</span>
                                            <?php } ?>
                                        </td>
                                        <td>
                                            <div class="d-inline-block dropdown show">
                                                <a href="#" data-bs-toggle="dropdown" data-bs-display="static">
                                                    <i class="align-middle text-dark" data-feather="more-vertical"></i>
                                                </a>

                                                <div class="dropdown-menu dropdown-menu-end">
                                                    <a href="<?= base_url("backend/sales-quote/generate?id=$or->id") ?>" class="dropdown-item"><i class="fa fa-fw fa-edit"></i> Ubah</a>
                                                    <a target="_blank" href="<?= base_url("sales-quote/view?id=$or->id") ?>" class="dropdown-item"><i class="fa fa-fw fa-file"></i> PDF</a>
                                                    <div class="dropdown-divider"></div>
                                                    <button class="dropdown-item finish-sales-quote" data-id="<?= $or->id ?>"><i class="fa fa-fw fa-check"></i> Tandai Selesai</button>
                                                    <button class="dropdown-item cancel-sales-quote" data-id="<?= $or->id ?>"><i class="fa fa-fw fa-times"></i> Tandai Batal</button>
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
    $(document).ready(function() {
        $("#catalogue-table").DataTable({
            order: [
                [1, "desc"],
            ],
            columnDefs: [{
                targets: [7],
                sortable: false
            }]
        });
    })
</script>