<script src="https://code.jquery.com/jquery-2.2.4.min.js" integrity="sha256-BbhdlvQf/xTY9gja0Dq3HiwQF8LaCRTXxZKRutelT44=" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/smoothstate@0.7.2/src/jquery.smoothState.js"></script>

<script>
    var base_url = "<?= base_url() ?>",
        smoothState,
        sidebarOpened;

    $(function() {
        const options = {
            prefetch: true,
            cacheLength: 0,
            blacklist: '.no-smoothstate',
            forms: 'form.smoothstate',
            repeatDelay: 500,
            onReady: {
                duration: 100,
                render: function($container, $newContent) {
                    sidebarOpened ? $($newContent[0]).addClass("toggled") : null;
                    $container.html($newContent);
                }
            },
            onStart: {
                duration: 0,
                render: function($container) {
                    sidebarOpened = $container.find("#sidebar").hasClass("toggled");
                }
            },
            onAfter: function($container, $newContent) {
                init();
            },
        }
        smoothState = $('#wrapper').smoothState(options).data('smoothState');
    })
</script>

<script src="https://cdn.jsdelivr.net/npm/gasparesganga-jquery-loading-overlay@2.1.7/dist/loadingoverlay.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sortablejs@latest/Sortable.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/jquery-sortablejs@latest/jquery-sortable.js"></script>
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/jquery-mask-plugin@1.14.16/dist/jquery.mask.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/feather-icons/dist/feather.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.11.5/js/dataTables.bootstrap5.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="https://cdn.quilljs.com/1.3.6/quill.js"></script>
<script src="<?= base_url("assets/backend/js/custom.js?v=" . time()) ?>"></script>