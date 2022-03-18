<!DOCTYPE html>
<html lang="en">
<?= $this->load->view("template/backend/head") ?>
<?= $this->load->view("template/backend/script") ?>

<body>
    <div id="wrapper">
        <div class="main">
            <main class="content">
                <?= $view ?>
            </main>
            <?= $this->load->view("template/backend/footer") ?>
        </div>
    </div>
</body>

</html>