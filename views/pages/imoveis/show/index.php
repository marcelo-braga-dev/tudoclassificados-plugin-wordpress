<?php
include_once 'assets/funcoes.php';
?>
    <div class="container">
        <div class="row rounded m-md-0 mb-5 pt-3">
            <div class="col-md-8 order-md-1 order-2">
                <!--IMAGEM PRINCIPAL -->
                <?php include_once TUDOCLASSIFICADOS_PATH_VIEW . 'components/anuncio-unico/imagem-principal.php' ?>

                <!-- Icones -->
                <?php require_once 'icones.php' ?>

                <!-- Descrição -->
                <?php include 'desc-carac.php' ?>
                <?php include 'videos.php' ?>

                <!-- Comentarios -->
                <?php include_once TUDOCLASSIFICADOS_PATH_VIEW . 'components/anuncio-unico/comentarios.php' ?>
            </div>
            <div style="margin-top:50px"></div>

            <!-- LATERAL ESQUERDA PC-->
            <div class="col-md-4 order-md-2 order-1">
                <!-- Preco -->
                <?php require 'preco.php' ?>

                <!-- Lateral -->
                <?php require 'lateral.php' ?>
            </div>
        </div>
        <div class="row m-3">
            <div class="col-12">
                <?php echo do_shortcode('[acadp_listings view="grid" listings_per_page="20" header="0"]'); ?>
            </div>
        </div>
        <div class="row m-3">
            <div class="col-12">
                <!-- Horizontal-1 -->
                <ins class="adsbygoogle" style="display:block" data-ad-client="ca-pub-5788964970631749"
                     data-ad-slot="1820744055" data-ad-format="auto" data-full-width-responsive="true"></ins>
                <script>
                    (adsbygoogle = window.adsbygoogle || []).push({});
                </script>
            </div>
        </div>
    </div>

<?php
wp_enqueue_script('anuncio-2', plugin_dir_url(__FILE__) . 'assets/js/nova_pergunta.js', [], false, true);
wp_enqueue_script('anuncio-3', plugin_dir_url(__FILE__) . 'assets/js/videos.js', [], false, true);
?>