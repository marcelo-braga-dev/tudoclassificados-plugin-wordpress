<?php
include 'imoveis/index.php';

function bs4_script_page_unica_produtos()
{ ?>
    <script src="/wp-content/plugins/tudoclassificados/views/pages/pages/anuncio_unico/produtos/assets/js/carrocel_destaque.js"></script>
    <?php
}

add_action('wp_footer', 'bs4_script_page_unica_produtos', 101);
?>