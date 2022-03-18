<!DOCTYPE html>
<html lang="en">
<?= $this->load->view("template/backend/head") ?>
<?= $this->load->view("template/backend/script") ?>

<body>
    <div id="wrapper" class="wrapper">
        <?= $this->load->view("template/backend/side") ?>
        <div class="main">
            <?= $this->load->view("template/backend/nav") ?>
            <main class="content">
                <?= $view ?>
            </main>
            <?= $this->load->view("template/backend/footer") ?>
        </div>
    </div>
</body>

</html>