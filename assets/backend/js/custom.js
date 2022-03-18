$(function () {
    init();
});

function init() {
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
    })
}