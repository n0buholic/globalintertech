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
                                    <th>No</th>
                                    <th>Customer</th>
                                    <th>Total Item</th>
                                    <th>Sub-Total</th>
                                    <th>Tanggal</th>
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
                                            <?php if ($or->status == 2) : ?>
                                                SQ-<?= date("m", strtotime($or->generate_date)) . date("y", strtotime($or->generate_date)) . sprintf('%03d', $counter) ?>
                                            <?php else : ?>
                                                - 
                                            <?php endif ?>
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
                                            <?php if ($or->status == 1) { ?>
                                                <span class="badge bg-warning">Proses</span>
                                            <?php } else if ($or->status == 2) { ?>
                                                <span class="badge bg-success">Selesai</span>
                                            <?php } ?>
                                        </td>
                                        <td>
                                            <div class="float-end">
                                                <?php if ($or->status == 1) { ?>
                                                    <a href="<?= base_url("backend/sales-quote/generate?id=$or->id") ?>" class="btn btn-primary btn-sm"><i class="fa fa-fw fa-edit"></i> Buat</a>
                                                <?php } else if ($or->status == 2) { ?>
                                                    <a href="<?= base_url("backend/sales-quote/generate?id=$or->id") ?>" class="btn btn-primary btn-sm"><i class="fa fa-fw fa-edit"></i> Ubah</a>
                                                    <a target="_blank" href="<?= base_url("sales-quote/view?id=$or->id") ?>" class="btn btn-info btn-sm"><i class="fa fa-fw fa-eye"></i> Lihat</a>
                                                    <a target="_blank" href="<?= base_url("sales-quote/download?id=$or->id") ?>" class="btn btn-success btn-sm"><i class="fa fa-fw fa-download"></i> Unduh</a>
                                                <?php } ?>
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
                targets: [6],
                sortable: false
            }]
        });
    })
</script>