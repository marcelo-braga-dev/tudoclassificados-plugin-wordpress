<div class="row my-3">
    <div class="col-md-8">
        <!-- Dados Comprador -->
        <div class="card">
            <div class="card-header bg-white">
                <div class="row justify-content-between align-items-center px-3">
                    <div>
                        <h4 class="mb-0">Dados do Comprador</h4>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-12">
                        <span>Nome: <?= $dados->nome_comprador ?></span>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-4">
                        <span>CPF: <?= $dados->cpf_comprador ?></span>
                    </div>
                    <div class="col-md-4">
                        <span>Celular: <?= $dados->celular_comprador ?></span>
                    </div>
                    <div class="col-md-4">
                        <span>Telefone: <?= $dados->telefone_comprador ?></span>
                    </div>
                </div>
            </div>
        </div>

        <!-- Frete -->
        <div class="card">
            <div class="card-header bg-white">
                <div class="row justify-content-between align-items-center px-3">
                    <div>
                        <h4 class="mb-0">Endereço de Entrega</h4>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-12">
                        <span>Endereço: <?= $dados->endereco_entrega ?>,
                        n. <?= $dados->numero_entrega ?> <?= $dados->complemento_entrega ?>,
                        Cep: <?= $dados->cep_entrega ?>, Bairro: <?= $dados->bairro_entrega ?></span>
                    </div>
                </div>

                <div class="row">
                    <div class="col-auto">
                        <span>Cidade: <?= $dados->cidade_entrega ?></span>
                    </div>
                    <div class="col-auto">
                        <span>Estado: <?= $dados->estado_entrega ?></span>
                    </div>
                </div>
            </div>
        </div>

        <!-- Finalizar Pagamento -->
        <div class="card">
            <div class="card-header bg-white">
                <div class="row justify-content-between align-items-center px-3">
                    <div>
                        <h4 class="mb-0">Finalizar Compra</h4>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <div class="row mb-3">
                    <div class="col-12">
                        <label>
                            <input type="checkbox"> Confirmo os dados do comprador e o endereço de enrtrega.
                        </label>
                    </div>
                </div>
                <div class="row">
                    <div class="col-auto mx-auto">
                        <?php if (empty($preference['id'])) : ?>
                        <span class="text-danger">O Vendedor ainda não cadastrou uma conta para recebimento.</span>
                        <?php else: ?>
                            <div class="cho-container mb-3"></div>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <!-- Frete -->
        <div class="card">
            <div class="card-header bg-white">
                <div class="row justify-content-between align-items-center px-3">
                    <div>
                        <h4 class="mb-0">Informações do Frete</h4>
                    </div>
                </div>
            </div>
            <div class="card-body p-0 m-0">
                <ul class="list-group list-group-flush p-0 m-0">
                    <li class="list-group-item">Cep da Entrega: <?= $_GET['cep'] ?></li>
                    <li class="list-group-item">Serviço de Frete: <?= $_GET['frete_tipo'] ?></li>
                    <li class="list-group-item">Prezo de Entrega: <?= $_GET['frete_prazo'] ?> dias</li>
                    <li class="list-group-item">Valor do Frete: R$ <?= $_GET['frete_valor'] ?></li>
                </ul>
            </div>
        </div>

        <!-- Pagamento -->
        <div class="card">
            <div class="card-header bg-white">
                <div class="row justify-content-between align-items-center px-3">
                    <div>
                        <h4 class="mb-0">Pagamento</h4>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-12">
                        <h4><?= $post->post_title ?></h4>
                    </div>
                </div>
                <div class="row mb-3">
                    <div class="col-5 col-md-4">
                        <img src="<?php the_acadp_listing_thumbnail($post_meta) ?>" alt="imagem do produto">
                    </div>
                    <div class="col-7 col-md-8 pt-3">
                        <small class="d-block">Preço: R$ <?= acadp_format_amount($post_meta['price'][0]) ?></small>
                        <small class="d-block mb-2">Frete: R$ <?= $_GET['frete_valor'] ?></small>
<!--                        <span>Total: <b>R$ --><?//= $valorTotal ?><!--</b></span>-->
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php
add_action('wp_footer', function () use ($preference) {
    ?>
    <script>
        $('#add_frete').click(function () {

            var emBase64 = btoa('string');

            window.location = window.location.pathname + '?res=' + emBase64;
        })
    </script>

    <script src="https://sdk.mercadopago.com/js/v2"></script>

    <script>
        // Adicione as credenciais do SDK
        const mp = new MercadoPago('<?= $preference['publicKey'] ?>', {
            locale: 'pt-BR'
        });

        // Inicialize o checkout
        mp.checkout({
            preference: {
                id: '<?= $preference['id'] ?>'
            },
            render: {
                container: '.cho-container',
                label: 'Finalizar Compra',
            }
        });

        $('.mercadopago-button').removeClass('mercadopago-button')
            .addClass('btn btn-success btn-block py-1 rounded');
    </script>
    <?php

}, 150);
?>
















