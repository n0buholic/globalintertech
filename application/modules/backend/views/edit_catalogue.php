<div class="container-fluid">
    <div class="header">
        <h1 class="header-title">
            Ubah Katalog
        </h1>
    </div>
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <form id="catalogue_form" action="<?= base_url("api/edit_catalogue") ?>" method="POST">
                    <input type="hidden" name="id" value="<?=$catalogue->id?>">
                        <div class="row">
                            <div class="col-md-4">
                                <h5 class="card-title mb-3">Gambar Produk</h5>
                                <div class="mb-3">
                                    <img id="preview-image" src="<?= base_url("assets/frontend/images/uploads/catalogue/$catalogue->image") ?>" class="img-fluid">
                                </div>
                                <div class="form-group mb-3">
                                    <label class="form-label" for="image">Gambar</label>
                                    <input type="file" name="image" id="image" class="form-control" accept=".jpg, .png, .jpeg">
                                    <small class="form-text d-block text-muted">Maksimal Ukuran: 1 MB</small>
                                </div>
                            </div>
                            <div class="col-md-8">
                                <h5 class="card-title mb-3">Informasi Produk</h5>
                                <div class="form-group mb-3">
                                    <label class="form-label" for="name">Nama Produk</label>
                                    <input type="text" class="form-control" name="name" id="name" placeholder="Nama Produk" value="<?= $catalogue->name ?>" required>
                                </div>
                                <div class="form-group mb-3">
                                    <label class="form-label" for="category_id">Kategori</label>
                                    <select class="form-control select2" data-bs-toggle="select2" id="category_id" name="category_id" required>
                                        <option value="<?= $catalogue->category_id ?>" selected><?= $catalogue->category_name ?></option>
                                    </select>
                                </div>
                                <div class="form-group mb-3">
                                    <label class="form-label" for="brand_id">Brand</label>
                                    <select class="form-control select2" data-bs-toggle="select2" id="brand_id" name="brand_id" required>
                                    <option value="<?= $catalogue->brand_id ?>" selected><?= $catalogue->brand_name ?></option>
                                    </select>
                                </div>
                                <div class="form-group mb-3">
                                    <label class="form-label" for="price">Harga Produk</label>
                                    <input type="text" class="form-control mask-rupiah" name="price" id="price" placeholder="Harga Produk" value="<?= $catalogue->price ?>" required>
                                </div>
                                <div class="form-group mb-3">
                                    <label class="form-label" for="specification">Spesifikasi</label>
                                    <textarea class="form-control" name="specification" id="specification" placeholder="Spesifikasi" rowspan="10" required><?= $catalogue->specification ?></textarea>
                                </div>
                                <div class="form-group mb-3">
                                    <label class="form-label" for="price">Link Datasheet</label>
                                    <input type="text" class="form-control" name="datasheet" id="datasheet" placeholder="Link Datasheet" value="<?= $catalogue->datasheet ?>">
                                </div>
                                <div class="form-group mb-3 float-start">
                                    <a href="<?=base_url("api/delete_catalogue?id=$catalogue->id")?>" class="btn btn-danger no-smoothstate"><i class="fa fa-fw fa-trash me-1"></i>Hapus</a>
                                </div>
                                <div class="form-group mb-3 float-end">
                                    <button class="btn btn-primary"><i class="fa fa-fw fa-edit me-1"></i>Ubah</button>
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
        const category = $("[name=category_id]");
        category.select2({
            tags: true,
            placeholder: "Pilih Kategori",
            ajax: {
                url: base_url + "api/fetch_category",
                delay: 250,
                processResults: (data) => {
                    return {
                        results: data.data
                    };
                }
            },
            createTag: function(params) {
                const term = $.trim(params.term);

                if (term === '') {
                    return null;
                }

                return {
                    id: term,
                    text: term,
                    isNew: true
                };
            }
        }).on("select2:selecting", function(selected) {
            selected = selected.params.args.data;
            if (selected.isNew) {
                const select = $(this)
                $.ajax({
                    url: base_url + "api/add_category",
                    method: "POST",
                    data: {
                        dynamic: true,
                        name: selected.text,
                    },
                    success: function(data) {
                        category.find('option[value="' + selected.text + '"]').replaceWith('<option selected value="' + data.data.id + '">' + data.data.text + '</option>');
                    }
                })
            }
        });

        const brand = $("[name=brand_id]");
        brand.select2({
            tags: true,
            placeholder: "Pilih Brand",
            ajax: {
                url: base_url + "api/fetch_brand",
                delay: 250,
                processResults: (data) => {
                    return {
                        results: data.data
                    };
                }
            },
            createTag: function(params) {
                const term = $.trim(params.term);

                if (term === '') {
                    return null;
                }

                return {
                    id: term,
                    text: term,
                    isNew: true
                };
            }
        }).on("select2:selecting", function(selected) {
            selected = selected.params.args.data;
            if (selected.isNew) {
                const select = $(this)
                $.ajax({
                    url: base_url + "api/add_brand",
                    method: "POST",
                    data: {
                        dynamic: true,
                        name: selected.text,
                    },
                    success: function(data) {
                        select.find('[value="' + selected.text + '"]').replaceWith('<option selected value="' + data.data.id + '">' + data.data.text + '</option>');
                    }
                })
            }
        });
    });

    $("#catalogue_form").on("submit", function(e) {
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