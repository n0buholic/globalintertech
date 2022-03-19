<div class="container-fluid">
    <div class="header">
        <h1 class="header-title">
            Tambah Promo
        </h1>
    </div>
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <form id="promo_form" action="<?= base_url("api/add_promo") ?>" method="POST">
                        <div class="row">
                            <div class="col-md-4">
                                <h5 class="card-title mb-3">Gambar Promo</h5>
                                <div class="mb-3">
                                    <img id="preview-image" src="<?= base_url("assets/backend/images/placeholder.jpg") ?>" class="img-fluid">
                                </div>
                                <div class="form-group mb-3">
                                    <label class="form-label" for="image">Gambar</label>
                                    <input type="file" name="image" id="image" class="form-control" accept=".jpg, .png, .jpeg" required>
                                    <small class="form-text d-block text-muted">Maksimal Ukuran: 1 MB</small>
                                </div>
                            </div>
                            <div class="col-md-8">
                                <h5 class="card-title mb-3">Informasi Promo</h5>
                                <div class="form-group mb-3">
                                    <label class="form-label" for="name">Nama Promo</label>
                                    <input type="text" class="form-control" name="name" id="name" placeholder="Nama Produk" required>
                                </div>
                                <div class="form-group mb-3">
                                    <label class="form-label" for="url">URL Tujuan</label>
                                    <input type="url" class="form-control" name="url" id="url" placeholder="URL Tujuan" required>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group mb-3">
                                            <label class="form-label" for="start_date">Mulai Tanggal</label>
                                            <input type="date" class="form-control" name="start_date" id="start_date" placeholder="Mulai Tanggal" required>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                    <div class="form-group mb-3">
                                            <label class="form-label" for="end_date">Berakhir Tanggal</label>
                                            <input type="date" class="form-control" name="end_date" id="end_date" placeholder="Berakhir Tanggal" required>
                                        </div>
                                    </div>
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

    $("#promo_form").on("submit", function(e) {
        e.preventDefault();
        $.ajax({
            url: $(this).attr("action"),
            method: $(this).attr("method"),
            processData: false,
            contentType: false,
            data: new FormData($(this)[0]),
            dataType: "JSON",
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
    })

    $("[name=image]").on('change', function() {
        if (this.files && this.files[0]) {
            var reader = new FileReader();
            reader.onload = function(e) {
                $('#preview-image').attr('src', e.target.result);
            }
            reader.readAsDataURL(this.files[0]);
        }
    });
</script>