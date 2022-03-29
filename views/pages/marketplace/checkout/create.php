<form method="post">
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
                            <div class="form-group">
                                <label class="form-control-label">Nome</label>
                                <input class="form-control" type="text" name="comprador_nome" value="" required>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="comprador_cpf" class="form-control-label">CPF</label>
                                <input class="form-control" type="text" name="comprador_cpf" id="comprador_cpf"
                                       value="" data-mask="000.000.000-00" required>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="comprador_celular" class="form-control-label">Celular</label>
                                <input class="form-control" type="text" name="comprador_celular" id="comprador_celular"
                                       value="" data-mask="(00) 0 0000-0000" required>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="comprador_telefone" class="form-control-label">Telefone</label>
                                <input class="form-control" type="text" name="comprador_telefone" id="comprador_telefone"
                                       value="" data-mask="(00) 0000-0000">
                            </div>
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
                        <div class="col-md-3">
                            <div class="form-group">
                                <label class="form-control-label" for="cep">Cep</label>
                                <input class="form-control" onblur="pesquisacep(this.value);" type="text" name="cep"
                                       id="cep" value="" data-mask="00000-000" required>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="endereco" class="form-control-label">Endereço</label>
                                <input class="form-control" type="text" name="endereco" id="endereco" value="" required>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="numero" class="form-control-label">Número</label>
                                <input class="form-control" type="text" name="numero" id="numero" value="" required>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="complemento" class="form-control-label">Complemento</label>
                                <input class="form-control" type="text" name="complemento" id="complemento" value="">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="bairro" class="form-control-label">Bairro</label>
                                <input class="form-control" type="text" name="bairro" id="bairro" value="" required>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="cidade" class="form-control-label">Cidade</label>
                                <input class="form-control" type="text" name="cidade" id="cidade" value="" required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="estado" class="form-control-label">Estado</label>
                                <input class="form-control" type="text" name="estado" id="estado" value="" required>
                            </div>
                        </div>
                    </div>

                    <div class="row justify-content-center py-3">
                        <div class="col-auto">
                            <button class="btn btn-success rounded">Avançar</button>
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

                    <!--<div class="row">-->
                    <!--    <div class="col-12">-->
                    <!--        <div class="form-group">-->
                    <!--            <label class="form-control-label">Cep da Entrega</label>-->
                    <!--            <div class="input-group mb-0">-->
                    <!--                <div class="input-group-prepend">-->
                    <!--                    <div class="input-group-text" for="consulta-frete">Cep</div>-->
                    <!--                </div>-->
                    <!--                <input type="text" class="form-control" placeholder="00000-000" aria-label="Recipient's username" aria-describedby="button-addon2">-->
                    <!--                <div class="input-group-append">-->
                    <!--                    <button class="btn btn-primary" type="button" id="button-addon2">-->
                    <!--                        Pesquisar-->
                    <!--<i class="fas fa-search text-white"></i>-->
                    <!--                    </button>-->
                    <!--                </div>-->
                    <!--            </div>-->
                    <!--            <a class="small d-block" target="_blank" href="https://buscacepinter.correios.com.br/app/endereco/index.php">-->
                    <!--                Não sei o CEP-->
                    <!--            </a>-->
                    <!--        </div>-->
                    <!--    </div>-->
                    <!--</div>-->

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
                            <span>Total: <b>R$ <?= $valorTotal ?></b></span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</form>

<script>
    $(function () {
        $('.valor-frete').change(function () {
            console.log('$(this).val()');
        });
    });

    $('#add_frete').click(function () {

        var emBase64 = btoa('string');

        window.location = window.location.pathname + '?res=' + emBase64;
    })
</script>
