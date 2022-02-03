(function ($) {
  ("use strict");

  $("[name=package]").on("change", function () {
    const selectedDetail = $(".selected-detail");
    const id = this.value;
    if (id.length > 0) {
      $.getJSON(base_url + "frontend/get_items_promo_imlek/" + id, function (data) {
        selectedDetail.find("table.detail tbody").html("")
        data.data.forEach(function (item) {
          selectedDetail.find("table.detail tbody").append(`
          <tr>
            <td>${item.name}</td>
            <td>${item.type}</td>
            <td>${item.qty}</td>
          </tr>
          `)
        });
        selectedDetail.show();
      });
    } else {
      selectedDetail.hide();
    }
  })

  $(".package").on("click", function () {
    const id = $(this).data("id");
    const modal = $("#detail-modal");
    $.getJSON(base_url + "frontend/get_items_promo_imlek/" + id, function (data) {
      modal.find("table.detail tbody").html("")
      data.data.forEach(function (item) {
        modal.find("table.detail tbody").append(`
        <tr>
          <td>${item.name}</td>
          <td>${item.type}</td>
          <td>${item.qty}</td>
        </tr>
        `)
      });
      modal.modal("show");
    });
  })

  new Swiper(".swiper", {
    loop: true,
    pagination: {
      el: ".swiper-pagination",
    },
    navigation: {
      nextEl: ".swiper-button-next",
      prevEl: ".swiper-button-prev",
    },
    autoplay: {
      delay: 5000,
    },
  });

  var CustomAlert = Swal.mixin({
    customClass: {
      confirmButton: "btn-primary-line",
      cancelButton: "btn-danger-line",
    },
    buttonsStyling: false,
  });

  $(".gallery-view").click(function () {
    var id = $(this).data("id");
    var modal = $("#modalEvent");
    modal.find(".modal-body").html("");
    $.ajax({
      url: "#", // event/form/form_lihat_foto
      beforeSend: function () {
        CustomAlert.showLoading();
      },
      data: "id=" + id,
      cache: false,
      processData: false,
      success: function (data) {
        CustomAlert.close();
        // modal.find(".modal-body").html(data);
        modal.modal("show");
      },
    });
  });

  // Header Scrolling Set White Background
  scrollNavBar();

  // Window Resize Mobile Menu Fix
  mobileNav();

  // Scroll animation init
  window.sr = new scrollReveal();

  // Menu Dropdown Toggle
  if ($(".menu-trigger").length) {
    $(".menu-trigger").on("click", function () {
      $(this).toggleClass("active");
      $(".header-area .nav").slideToggle(200);
    });
  }

  // Menu elevator animation
  $("a[href*=\\#]:not([href=\\#])").on("click", function () {
    if (
      location.pathname.replace(/^\//, "") ==
      this.pathname.replace(/^\//, "") &&
      location.hostname == this.hostname
    ) {
      var target = $(this.hash);
      target = target.length ? target : $("[name=" + this.hash.slice(1) + "]");
      if (target.length) {
        var width = $(window).width();
        if (width < 991) {
          $(".menu-trigger").removeClass("active");
          $(".header-area .nav").slideUp(200);
        }
        $("html,body").animate({
            scrollTop: target.offset().top - 30,
          },
          0
        );
        return false;
      }
    }
  });

  // Home number counterup
  if ($(".count-item").length) {
    $(".count-item strong").counterUp({
      delay: 10,
      time: 1000,
    });
  }

  // Blog cover image
  if ($(".blog-post-thumb").length) {
    $(".blog-post-thumb .img").imgfix();
  }

  // About Us Image
  if ($(".about-image").length) {
    $(".about-image").imgfix({
      scale: 1.1,
    });
  }

  // Home Video
  if ($(".btn-play").length) {
    $(".btn-play").magnificPopup({
      disableOn: 700,
      type: "iframe",
      mainClass: "mfp-fade",
      removalDelay: 160,
      preloader: false,
      fixedContentPos: false,
    });
  }

  // Page standard gallery
  if ($(".page-gallery").length && $(".page-gallery-wrapper").length) {
    $(".page-gallery").imgfix({
      scale: 1.1,
    });

    $(".page-gallery").magnificPopup({
      type: "image",
      gallery: {
        enabled: true,
      },
      zoom: {
        enabled: true,
        duration: 300,
        easing: "ease-in-out",
      },
    });
  }

  // Page loading animation
  $(window).on("load", function () {
    if ($(".cover").length) {
      $(".cover").parallax({
        imageSrc: $(".cover").data("image"),
        zIndex: "1",
      });
    }

    $("#preloader").animate({
        opacity: "0",
      },
      600,
      function () {
        setTimeout(function () {
          // Home Parallax
          if ($("#parallax-text").length) {
            $("#parallax-text").parallax({
              imageSrc: "assets/images/photos/parallax-counter.jpg",
              zIndex: "1",
            });
          }

          // Home Parallax Counter
          if ($("#counter").length) {
            $("#counter").parallax({
              imageSrc: "assets/images/photos/parallax-counter.jpg",
              zIndex: "1",
            });
          }
          $("#preloader").css("visibility", "hidden").fadeOut();
        }, 300);
      }
    );
  });

  // File Button
  $(".custom-file-input").on("change", function () {
    const filename = $("input[type=file]")
      .val()
      .replace(/.*(\/|\\)/, "");
    if (filename.length > 0) {
      $(this).prev().find(".select-file").hide();
      $(this).prev().find(".text-file").text(filename).show();
    } else {
      $(this).prev().find(".select-file").show();
      $(this).prev().find(".text-file").text("").hide();
    }
  });

  // submit form lamaran
  $("#form-lamaran").on("submit", function (e) {
    e.preventDefault();
    CustomAlert.showLoading();
    setTimeout(function () {
      CustomAlert.fire({
        title: "Sukses",
        text: "Lamaran berhasil terkirim",
        icon: "success",
      });
    }, 1000);
  });

  // submit form contact
  $("#form-contact").on("submit", function (e) {
    e.preventDefault();
    const response = grecaptcha.getResponse();
    const form = this;
    if (response) {
      $.ajax({
        url: $(this).attr("action"),
        method: "POST",
        data: new FormData(form),
        dataType: "JSON",
        processData: false,
        contentType: false,
        beforeSend: CustomAlert.showLoading(),
        success: function (data) {
          if (data.success) {
            CustomAlert.fire({
              title: "Sukses",
              text: data.message,
              icon: "success",
            });
            form.reset();
          } else {
            CustomAlert.fire({
              title: "Gagal",
              text: data.message,
              icon: "error",
            });
          }
        },
        error: function () {
          CustomAlert.fire({
            title: "Gagal",
            text: "Terjadi kesalahan",
            icon: "error",
          });
        },
        complete: function () {
          grecaptcha.reset();
        }
      });
    } else {
      CustomAlert.fire({
        title: "Gagal",
        text: "Silahkan selesaikan captcha",
        icon: "error",
      });
    }
  });

  // submit form promo imlek
  $("#form-promo-imlek").on("submit", function (e) {
    e.preventDefault();
    const response = grecaptcha.getResponse();
    const form = this;
    if (response) {
      $.ajax({
        url: $(this).attr("action"),
        method: "POST",
        data: new FormData(form),
        dataType: "JSON",
        processData: false,
        contentType: false,
        beforeSend: CustomAlert.showLoading(),
        success: function (data) {
          if (data.success) {
            CustomAlert.fire({
              title: "Sukses",
              text: data.message,
              icon: "success",
            });
            form.reset();
          } else {
            CustomAlert.fire({
              title: "Gagal",
              text: data.message,
              icon: "error",
            });
          }
        },
        error: function () {
          CustomAlert.fire({
            title: "Gagal",
            text: "Terjadi kesalahan",
            icon: "error",
          });
        },
        complete: function () {
          grecaptcha.reset();
        }
      });
    } else {
      CustomAlert.fire({
        title: "Gagal",
        text: "Silahkan selesaikan captcha",
        icon: "error",
      });
    }
  });

  // Header Scrolling Set White Background
  $(window).on("scroll", function () {
    scrollNavBar();
  });

  // Window Resize Mobile Menu Fix
  $(window).on("resize", function () {
    mobileNav();
  });

  // Window Resize Mobile Menu Fix
  function mobileNav() {
    var width = $(window).width();
    $(".submenu").on("click", function () {
      if (width < 992) {
        $(".submenu ul").removeClass("active");
        $(this).find("ul").toggleClass("active");
      }
    });
  }

  // Navbar Scroll Set White Background Function
  function scrollNavBar() {
    var width = $(window).width();
    if (width > 991) {
      var scroll = $(window).scrollTop();
      if (scroll >= 30) {
        $(".back-to-top").fadeIn("200");
        $(".header-area").addClass("header-sticky");
      } else {
        $(".back-to-top").fadeOut("200");
        $(".header-area").removeClass("header-sticky");
      }
    }
  }

  // imlek popup
  // setTimeout(() => $("#promo").modal("show"), 1 * 1000)
})(window.jQuery);