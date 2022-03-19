<div class="container-fluid">
    <div class="header">
        <h1 class="header-title">
            Urut Katalog
        </h1>
    </div>
    <div class="row">
        <div class="col-12">
            <div id="catalogue-list">
                <?php foreach ($catalogue as $cat) {
                    $specification = @explode("<br />", nl2br($cat->specification));
                ?>
                    <div class="card" data-id="<?= $cat->id ?>">
                        <div class="card-body p-3">
                            <div class="row">
                                <div class="col-auto">
                                    <div class="d-flex align-items-center h-100">
                                        <i class="sort-handle fas fa-bars"></i>
                                    </div>
                                </div>
                                <div class="col-2">
                                    <img src="<?= base_url("assets/frontend/images/uploads/catalogue/$cat->image") ?>" style="width: 100%;" class="img-fluid">
                                </div>
                                <div class="col-9">
                                    <div class="row g-3">
                                        <div class="col-12">
                                            <h3 class="fw-bold mb-1"><?= $cat->name ?></h3>
                                            <h4><?= $ctr->toRupiah($cat->price) ?></h4>
                                        </div>
                                        <div class="col-12">
                                            <p class="fw-bold mb-0">Spesifikasi:</p>
                                            <small>
                                                <?= implode("&nbsp;&nbsp;|&nbsp;&nbsp;", $specification) ?>
                                            </small>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php } ?>
            </div>
        </div>
    </div>
</div>

<style>
    .sort-handle {
        cursor: move;
    }

    .sort-handle:active {
        cursor: move;
    }
</style>

<script>
    $(document).ready(function() {
        $("#catalogue-list").sortable({
            handle: ".sort-handle",
            animation: 150,
            dataIdAttr: "data-id",
            draggable: ".card",
            easing: "cubic-bezier(1, 0, 0, 1)",
            dragoverBubble: true,
            onChange: function(e) {
                console.log($("#catalogue-list").sortable('toArray'))
            },
        });
    })
</script>