<div class="container">
    <div class="row rounded m-md-0 mb-5 pt-3">
        <div class="col-md-8 order-md-1 order-2 pb-4">
            <!--IMAGEM PRINCIPAL -->
            <?php $imagensPrincipal->execute($post_meta) ?>

            <!-- Descrição -->
            <?php include 'desc-carac.php' ?>

            <?php include 'videos.php' ?>

            <!-- Comentarios -->
            <?php view('components/anuncio-unico/comentarios.php', ['post' => $post, 'post_meta' => $post_meta]); ?>
        </div>

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
            <!-- Horizontal-1 -->
            <ins class="adsbygoogle" style="display:block" data-ad-client="ca-pub-5788964970631749"
                 data-ad-slot="1820744055" data-ad-format="auto" data-full-width-responsive="true"></ins>
            <script>
                (adsbygoogle = window.adsbygoogle || []).push({});
            </script>
        </div>
    </div>
</div>

<!-- Modal -->
<div class="modal fade" id="modalEscolhaFrete" tabindex="-1" role="dialog" aria-labelledby="TituloModalCentralizado"
     aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="TituloModalCentralizado">Escolha o Frete</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Fechar">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form class="mb-0">
                <div class="modal-body pt-0">
                    <div class="row">
                        <div class="col-12">
                            <p>Escolha o tipo de entrega:</p>
                            <div id="inserir-tabela-frete"></div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-success rounded">Incluir Frete</button>
                </div>
            </form>
        </div>
    </div>
</div>

<?php
    wp_enqueue_script('anuncio-1', plugin_dir_url(__FILE__) . 'assets/js/frete.js', [], false, true);
    wp_enqueue_script('anuncio-2', plugin_dir_url(__FILE__) . 'assets/js/nova_pergunta.js', [], false, true);
    wp_enqueue_script('anuncio-3', plugin_dir_url(__FILE__) . 'assets/js/videos.js', [], false, true);
    wp_enqueue_script('anuncio-4', plugin_dir_url(__FILE__) . 'assets/js/carrocel_destaque.js', [], false, true);
?>