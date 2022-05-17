<style>
    .activity-content p {
        margin: 0 !important;
    }

    .activity-content {
        display: grid;
        align-items: center;
    }
</style>
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
                                    <th>Aktifitas</th>
                                    <th>Status</th>
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
                                            <button class="btn btn-primary btn-sm activity-log" data-id="<?= $or->id ?>"><i class="fas fa-list me-1"></i> Aktifitas</button>
                                        </td>
                                        <td>
                                            <?php if ($or->status == 1) { ?>
                                                <span class="badge bg-warning">Proses</span>
                                            <?php } else if ($or->status == 2) { ?>
                                                <span class="badge bg-success">Deal</span>
                                                <span class="badge bg-primary">Selesai</span>
                                            <?php } else if ($or->status == 3) { ?>
                                                <span class="badge bg-danger">Batal</span>
                                                <span class="badge bg-primary">Selesai</span>
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
                                                    <button class="dropdown-item finish-sales-quote" data-id="<?= $or->id ?>"><i class="fa fa-fw fa-check"></i> Tandai Deal</button>
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

<div class="modal fade" id="activity-log-modal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Log Aktifitas</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-12 d-flex justify-content-between">
                        <h4 id="sq-no"></h4>
                        <div>
                            <div id="customer" class="text-end"></div>
                        </div>
                    </div>
                </div>
                <button class="btn btn-primary add-activity"><i class="fas fa-plus-circle me-1"></i> Tambah Aktifitas</button>
                <table class="table table-striped table-hover border table-log mt-3">
                    <thead>
                        <tr>
                            <th>Tanggal</th>
                            <th>Aktifitas</th>
                        </tr>
                    </thead>
                    <tbody>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="add-activity-modal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Tambah Aktifitas</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="add-activity-form" action="<?= base_url("api/add_sq_activity") ?>" method="post">
                    <input type="hidden" name="sales_quote_id" id="id">
                    <div class="form-group mb-3">
                        <label for="date" class="form-label">Tanggal</label>
                        <input type="date" class="form-control" disabled value="<?= date("Y-m-d") ?>">
                    </div>
                    <div class="form-group mb-3">
                        <label for="activity" class="form-label">Aktifitas</label>
                        <div class="clearfix">
                            <div id="quill-toolbar">
                                <span class="ql-formats">
                                    <button class="ql-bold"></button>
                                    <button class="ql-italic"></button>
                                    <button class="ql-underline"></button>
                                    <button class="ql-strike"></button>
                                </span>
                                <span class="ql-formats">
                                    <select class="ql-color"></select>
                                    <select class="ql-background"></select>
                                </span>
                                <span class="ql-formats">
                                    <button class="ql-script" value="sub"></button>
                                    <button class="ql-script" value="super"></button>
                                </span>
                                <span class="ql-formats">
                                    <button class="ql-list" value="ordered"></button>
                                    <button class="ql-list" value="bullet"></button>
                                    <button class="ql-indent" value="-1"></button>
                                    <button class="ql-indent" value="+1"></button>
                                </span>
                                <span class="ql-formats">
                                    <button class="ql-clean"></button>
                                </span>
                            </div>
                            <div id="quill-editor"></div>
                        </div>
                    </div>
                    <div class="form-group mb-3">
                        <label for="date" class="form-label">File</label>
                        <input type="file" id="file" name="file" class="form-control" accept=".jpg, .jpeg, .png, .pdf">
                    </div>
                    <div class="form-group d-grid">
                        <button class="btn btn-primary" type="submit"><i class="fas fa-plus-circle me-1"></i> Tambah</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
    var quillActivity;

    async function loadActivity(id) {
        const modal = $("#activity-log-modal");
        modal.find(".table-log tbody").html("");
        modal.find("#customer").html("");
        modal.find("#sq-no").text("");
        modal.find("button.add-activity").hide();
        const activity = await fetch(base_url + "api/sq_activity_log?id=" + id).then(res => res.json());
        modal.find("#sq-no").text(activity.data.info.no);
        modal.find("button.add-activity").show();
        if (parseInt(activity.data.info.status) <= 1) {
            modal.find("button.add-activity").prop("disabled", false)
            modal.find("button.add-activity").attr("data-id", activity.data.info.id);
        } else {
            modal.find("button.add-activity").prop("disabled", true);
            modal.find("button.add-activity").attr("data-id", 0);
        }
        const cust = JSON.parse(activity.data.info.customer);
        modal.find("#customer").html(`${cust.name}<br>${cust.phone}<br>${cust.address}`);
        activity.data.activity.forEach(item => {
            let file = ``;
            if (item?.file) {
                file = `<br><a href="${base_url}assets/backend/uploads/sq_file/${item.file}" target="_blank" class="text-white badge bg-success"><i class="fas fa-download me-1"></i>${item.file}</a>`;
            }
            let removeButton = ``;
            if (activity.data.info.status == 1) {
                if (item.showRemove) {
                    removeButton = `<button class="btn btn-link text-dark" disabled><i class="fas fa-trash"></i></button>`;

                    if (item.removable) {
                        removeButton = `<button class="btn btn-link remove-activity text-danger" data-id="${item.id}"><i class="fas fa-trash"></i></button>`;
                    }
                }
            }
            modal.find(".table-log tbody").append(`<tr>
                <td>${item.date}</td>
                <td>
                    <div class="d-flex justify-content-between">
                        <div class="activity-content">${item.activity}${file}</div>
                        <div class="d-flex align-content-center">
                            ${removeButton}
                        </div>
                    </div>
                </td>
            </tr>`);
        });
    }

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

        quillActivity = new Quill("#quill-editor", {
            modules: {
                toolbar: "#quill-toolbar"
            },
            placeholder: "Ketik sesuatu",
            theme: "snow"
        });
    })
</script>