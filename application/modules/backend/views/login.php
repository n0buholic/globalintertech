<div class="container h-100">
    <div class="row h-100">
        <div class="col-sm-10 col-md-8 col-lg-6 mx-auto d-table h-100">
            <div class="d-table-cell align-middle">

                <div class="text-center mt-4">
                    <h1 class="h2">Masuk</h1>
                    <p class="lead">
                        Silahkan masuk untuk melanjutkan
                    </p>
                </div>

                <div class="card">
                    <div class="card-body">
                        <div class="m-sm-4">
                            <form id="login-form" action="<?= base_url("api/login") ?>" method="POST">
                                <div class="mb-3">
                                    <label class="form-label">Username</label>
                                    <input class="form-control form-control-lg" type="text" name="username" placeholder="Masukkan username" />
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Password</label>
                                    <input class="form-control form-control-lg" type="password" name="password" placeholder="Masukkan password" />
                                </div>
                                <div class="text-center mt-3 d-grid">
                                    <button type="submit" class="btn btn-lg btn-primary">Masuk</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    $("#login-form").on("submit", function(e) {
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
                        window.location.href = data.data.redirect;
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
</script>