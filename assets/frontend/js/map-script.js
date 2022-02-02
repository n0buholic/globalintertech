(function ($) {
  "use strict";

  const lokasi = [
    {
      nama: "Banjarmasin",
      alamat:
        "Jalan Kolonel Sugiono No.78 Banjarmasin, Kalimantan Selatan 14462, Indonesia.",
      lat: "-3.327111092019475",
      long: "114.59787828775406",
    },
    {
      nama: "Pontianak",
      alamat:
        "Jalan Johar No.5B, Bangka Belitung Darat, Kec. Pontianak Tenggara, Kota Pontianak, Kalimantan Barat 78117, Indonesia.",
      lat: "-0.026408303372010975",
      long: "109.33091239472597",
    },
    {
      nama: "Samarinda",
      alamat:
        "Jl. Kardie Oening No.37 Samarinda, Kalimantan Timur 75124, Indonesia.",
      lat: "-0.47222802882744275",
      long: "117.13556593340999",
    },
    {
      nama: "Jakarta",
      alamat:
        "Jalan Kopi Tiang Bendera, Ruko Plaza Kota Blok B.10, DKI Jakarta 11180, Indonesia.",
      lat: "-6.13310703896431",
      long: "106.80725807603008",
    },
  ];

  const mapOptions = {
    zoom: 15,
    scrollwheel: false,
    zoomControl: true,
    draggable: true,
    center: new google.maps.LatLng("-3.327111092019475", "114.59787828775406"),
    mapTypeId: google.maps.MapTypeId.ROADMAP,
  };

  var map = new google.maps.Map($(".map-canvas")[0], mapOptions);

  /* --------------------------------------------
	Google Map
	-------------------------------------------- */

  $(window).on("load", function () {
    GmapInit();
  });

  function GmapInit() {
    lokasi.forEach(function (lok) {
      addMarker(map, lok.nama, lok.alamat, lok.lat, lok.long);
    });
  }

  function addMarker(map, nama, alamat, lat2, long2) {
    var $this = $(this),
      lat = "",
      lng = "",
      zoom = 15,
      scrollwheel = false,
      zoomcontrol = true,
      draggable = true,
      mapType = google.maps.MapTypeId.ROADMAP,
      title = "",
      contentString = "",
      theme_icon_path = "assets/frontend/images/marker-blue.png",
      dataLat = lat2,
      dataLng = long2,
      dataZoom = 17,
      dataType = "roadmap",
      dataScrollwheel = $this.data("scrollwheel"),
      dataZoomcontrol = $this.data("zoomcontrol"),
      dataHue = false,
      dataTitle = nama,
      dataContent = `<br>${alamat}<br><br><a target="_blank" href="https://www.google.com/maps/dir/?api=1&destination=${dataLat},${dataLng}" class="px-3 btn-primary-line btn-mini">Dapatkan Arah <i class="fa ms-1 fa-chevron-right"></i></a>`;

    if (dataZoom !== undefined && dataZoom !== false) {
      zoom = parseFloat(dataZoom);
    }
    if (dataLat !== undefined && dataLat !== false) {
      lat = parseFloat(dataLat);
    }
    if (dataLng !== undefined && dataLng !== false) {
      lng = parseFloat(dataLng);
    }
    if (dataScrollwheel !== undefined && dataScrollwheel !== null) {
      scrollwheel = dataScrollwheel;
    }
    if (dataZoomcontrol !== undefined && dataZoomcontrol !== null) {
      zoomcontrol = dataZoomcontrol;
    }
    if (dataType !== undefined && dataType !== false) {
      if (dataType == "satellite") {
        mapType = google.maps.MapTypeId.SATELLITE;
      } else if (dataType == "hybrid") {
        mapType = google.maps.MapTypeId.HYBRID;
      } else if (dataType == "terrain") {
        mapType = google.maps.MapTypeId.TERRAIN;
      }
    }
    if (dataTitle !== undefined && dataTitle !== false) {
      title = dataTitle;
    }
    if (navigator.userAgent.match(/iPad|iPhone|Android/i)) {
      draggable = false;
    }

    var image = theme_icon_path;

    if (dataContent !== undefined && dataContent !== false) {
      contentString = (`
      <div class="map-data">
        <h6>${title}</h6>
        <div class="map-content">
          ${dataContent}
        </div>
      </div>
      `);
    }
    var infowindow = new google.maps.InfoWindow({
      content: contentString,
    });

    var marker = new google.maps.Marker({
      position: new google.maps.LatLng(lat, lng),
      map: map,
      icon: image,
      title: title,
    });
    if (dataContent !== undefined && dataContent !== false) {
      google.maps.event.addListener(marker, "click", function () {
        infowindow.open(map, marker);
      });
    }
  }
})(window.jQuery);
