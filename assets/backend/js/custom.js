function formatRupiah(angka, prefix) {
    var number_string = angka.toString().replace(/[^,\d]/g, '').toString(),
        split = number_string.split(','),
        sisa = split[0].length % 3,
        rupiah = split[0].substr(0, sisa),
        ribuan = split[0].substr(sisa).match(/\d{3}/gi);

    if (ribuan) {
        separator = sisa ? '.' : '';
        rupiah += separator + ribuan.join('.');
    }

    rupiah = split[1] != undefined ? rupiah + ',' + split[1] : rupiah;
    return prefix == undefined ? rupiah : (rupiah ? 'Rp. ' + rupiah : '');
}

$(function () {
    init();
});

function init() {
    $(document).off();

    feather.replace();

    $.fn.select2.defaults.set("theme","bootstrap4");
    
    $(".sidebar-toggle").on("click touch", function () {
        $(".sidebar").toggleClass("toggled")
    });

    $("#logout").on("click touch", function() {
        $.ajax({
            url: base_url + "api/logout",
            method: "GET",
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
                        window.location.href = data.data.redirect
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

    $(".mask-rupiah").mask("000.000.000.000.000", {reverse: true});

    $(".sidebar-nav .sidebar-item a").each(function() {
        if ($(this).attr("href") === window.location.href) {
            $(this).parent().addClass("active");
        }
    });

    $(document).on("click", ".finish-sales-quote", function() {
        const id = $(this).data("id");
        const data = new FormData();
        data.append("id", id);
        $.ajax({
            url: base_url + "api/finish_sales_quote",
            type: "POST",
            data: data,
            dataType: "JSON",
            processData: false,
            contentType: false,
            cache: false,
            beforeSend: () => $.LoadingOverlay("show"),
            complete: () => $.LoadingOverlay("hide"),
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

    $(document).on("click", ".cancel-sales-quote", function() {
        const id = $(this).data("id");
        const data = new FormData();
        data.append("id", id);
        $.ajax({
            url: base_url + "api/cancel_sales_quote",
            type: "POST",
            data: data,
            dataType: "JSON",
            processData: false,
            contentType: false,
            cache: false,
            beforeSend: () => $.LoadingOverlay("show"),
            complete: () => $.LoadingOverlay("hide"),
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

    $(document).on("click", ".activity-log", function() {
        loadActivity($(this).data("id"));
        $("#activity-log-modal").modal("show");
    });

    $(document).on("click", ".remove-activity", function() {
        const parent = $(this).closest("tr");
        const id = $(this).data("id");
        const data = new FormData();
        data.append("id", id);

        $.ajax({
            url: base_url + "api/remove_sq_activity",
            type: "POST",
            data: data,
            contentType: false,
            processData: false,
            beforeSend: () => $.LoadingOverlay("show"),
            complete: () => $.LoadingOverlay("hide"),
            success: function(response) {
                if (response.success) {
                    parent.remove();
                }
            }
        });
    })

    $(document).on("submit", "#add-activity-form", function(e) {
        e.preventDefault();
        const form = $(this);
        const id = form.find("#id").val();
        const activity = quillActivity.root.innerHTML;
        const activityText = quillActivity.root.innerText
        if (activityText.trim().length == 0) {
            Swal.fire({
                icon: "error",
                title: "Oops...",
                text: "Aktifitas tidak boleh kosong!"
            });
            return;
        }
        const data = new FormData(this);
        data.append("activity", activity);

        $.ajax({
            url: form.attr("action"),
            method: form.attr("method"),
            beforeSend: () => $.LoadingOverlay("show"),
            complete: () => $.LoadingOverlay("hide"),
            data: data,
            contentType: false,
            processData: false,
            dataType: "json",
            success: function(res) {
                if (res.success) {
                    $("#add-activity-modal").find("#activity").val("").trigger("change");
                    $("#add-activity-modal").modal("hide");
                    quillActivity.deleteText(0, quillActivity.getLength());
                    form.find("#file").val("").trigger("change");
                    form.find("#id").val("").trigger("change");
                    loadActivity(id);
                } else {
                    Swal.fire(
                        "Gagal",
                        res.message,
                        "error"
                    )
                }
            }
        });

    });

    $(document).on("click", "button.add-activity", function() {
        const modal = $("#add-activity-modal");
        modal.find("#id").val($(this).data("id"));
        modal.modal("show");
    });
}