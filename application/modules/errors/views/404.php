<!DOCTYPE html>
<html lang="en">

<head>
  <?php $this->load->view('templates/frontend_header') ?>
</head>

<body class="appear-animate">

  <div class="page" id="top">
    <main id="main">
      <section class="home-section bg-dark-alfa-30 parallax-2" data-background="<?= base_url() ?>assets/themes/images/full-width-images/section-bg-17.jpg">
        <div class="js-height-full container">
          <div class="home-content">
            <div class="home-text">
              <h1 class="hs-line-8 font-alt mb-50 mb-xs-30">
                <?= $site_name ?>
              </h1>
              <h2 class="hs-line-14 font-alt mb-50 mb-xs-30">
                404 Tidak Ditemukan
              </h2>
              <div class="local-scroll">
                <a href="<?= base_url() ?>" class="btn btn-mod btn-border-w btn-medium btn-round" tabindex="0">Kembali</a>
              </div>
            </div>
          </div>

        </div>
      </section>
    </main>
  </div>

  <?php $this->load->view('templates/frontend_js') ?>
</body>

</html>