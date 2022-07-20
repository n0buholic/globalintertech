<div class="container-fluid">
    <div class="header">
        <h1 class="header-title">
            Tambah Support Link
        </h1>
    </div>
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <form id="support-link-form" action="<?= base_url("api/add_support_link") ?>" method="POST">
                        <div class="row">
                            <div class="col-md-12">
                                <h5 class="card-title mb-3">Informasi</h5>
                                <div class="form-group mb-3">
                                    <label class="form-label" for="name">Nama</label>
                                    <input type="text" class="form-control" name="name" id="name" placeholder="Nama Link" required>
                                </div>
                                <div class="form-group mb-3">
                                    <label class="form-label" for="url">URL Tujuan</label>
                                    <input type="url" class="form-control" name="url" id="url" placeholder="URL Tujuan" required>
                                </div>
                                <div class="form-group mb-3 float-end">
                                    <button class="btn btn-primary"><i class="fa fa-fw fa-plus me-1"></i>Tambah</button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    $(document).ready(function() {

    });

    $("#support-link-form").on("submit", function(e) {
        e.preventDefault();
        $.ajax({
            url: $(this).attr("action"),
            method: $(this).attr("method"),
            processData: false,
            contentType: false,
            data: new FormData($(this)[0]),
            dataType: "JSON",
            beforeSend: () => $.LoadingOverlay("show"),
            complete: () => $.LoadingOverlay("hide"),
            success: function(data) {
                if (data.success) {
                    Swal.fire(
                        "Berhasil",
                        data.message,
                        "success"
                    )
                } else {
                    Swal.fire(
                        "Gagal",
                        data.message,
                        "error"
                    )
                }

                if (data.data?.redirect) {
                    setTimeout(() => {
                        Swal.close();
                        smoothState.load(data.data.redirect);
                    }, 1000)
                }
            },
            error: function(request, status, error) {
                Swal.fire(
                    "Gagal",
                    request.responseText,
                    "error"
                )
            }
        })
    });
</script>