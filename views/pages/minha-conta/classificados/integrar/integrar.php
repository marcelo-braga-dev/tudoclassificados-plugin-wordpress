<!-- X-----------------------INICIO-----------------------X--->
<div class="row">
    <div class="col-12">
        <?php if (empty($produtosBling['produtos']) && !$_GET['classificados-bling'] || $produtosBling['erro']) { ?>
            <div class="card">
                <div class="card-header bg-white">
                    <div class="row justify-content-between align-items-center px-3">
                        <div class="col-auto">
                            <h5 class="mb-0">Integrar Anúncios para o Classificados de Produtos</h5>
                        </div>
                        <div class="col-auto">
                            <div class="icon icon-shape bg-principal text-white rounded-circle shadow">
                                <i class="fas fa-dollar-sign"></i>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <form action="">
                        <div class="row">
                            <div class="col-12 mb-2">
                                <label>Api Key Bling</label>
                                <input type="text" name="token_bling" class="form-control"
                                       value="<?= $_GET['token_bling'] ?>">
                            </div>
                            <div class="col-12  mb-2">
                                <input type="hidden" name="classificados-bling" value="true">
                                <input type="hidden" name="menu_minha_conta" value="classificados-integrar-bling">
                                <button type="submit" class="btn btn-primary rounded">Pesquisar</button>
                            </div>
                        </div>
                    </form>
                    <?php if ($produtosBling['erro']) : ?>
                        <div class="alert alert-danger mt-3">
                            <?= $produtosBling['erro']['msg'] ?>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
        <?php } else { ?>
            <div class="card">
                <div class="card-header bg-white">
                    <div class="row">
                        <div class="col-12">
                            <hr class="mb-1">
                            <div class="row">
                                <div class="col-12 text-center">
                                    <p>
                                        Selecone os produtos que deseja integrar, preencha as informações e para
                                        finalizar, clique no botão "Integrar".
                                    </p>
                                </div>
                            </div>
                            <form method="POST">
                                <div class="row justify-content-center my-3">
                                    <div class="col-auto">
                                        <input type="hidden" name="integrar_classificados_bling" value="true">
                                        <button type="submit" class="btn btn-success rounded">
                                            Integrar Anúncios Selecionados
                                        </button>
                                    </div>
                                </div>

                                <div class="table-responsive">
                                    <table class="table align-items-center table-flush">
                                        <thead class="thead-light">
                                        <tr>
                                            <th scope="col">Integrar</th>
                                            <th scope="col">Produto</th>
                                        </tr>
                                        </thead>
                                        <tbody class="list">
                                        <?php foreach ($produtosBling['produtos'] as $var) :
                                            $produto = $var->produto;
                                            $anuncioComImagens = count($produto->imagem) ? true : false; ?>
                                            <tr>
                                                <td scope="row" style="width: 2rem;">
                                                    <input type="hidden" name="token_bling" class="form-control"
                                                           value="<?= $_GET['token_bling'] ?>">
                                                    <input type="hidden" name="produto[<?= $produto->id ?>][id]"
                                                           value="<?= $produto->id ?>">
                                                    <label class="custom-toggle">
                                                        <input type="checkbox" id="customCheck<?= $j ?>"
                                                               class="input-check custom-control-input" name="checks[]"
                                                               value="<?= $produto->id ?>" <?= $anuncioComImagens ? '' : 'disabled' ?>>
                                                        <span class="custom-toggle-slider rounded-circle"
                                                              data-label-off="Não" data-label-on="Sim"></span>
                                                    </label>
                                                </td>
                                                <td style="white-space: normal !important;">
                                                    <div class="row">
                                                        <div class="col-12">
                                                            <h4><?= $produto->descricao; ?></h4>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-md-3">
                                                            <label>Preço</label>
                                                            <div class="input-group">
                                                                <div class="input-group-prepend">
                                                                    <small class="input-group-text">R$</small>
                                                                </div>
                                                                <input type="number" step="0.01" class="form-control"
                                                                       name="produto[<?= $produto->id ?>][preco]"
                                                                       placeholder="0,00" aria-label="Preco"
                                                                       value="<?= number_format($produto->preco, 2, '.', ''); ?>" <?= $anuncioComImagens ? '' : 'disabled' ?>>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-5 align-self-end">
                                                            <div class="avatar-group d-block">
                                                                <?php foreach ($produto->imagem as $imagem) : ?>
                                                                    <a class="avatar avatar rounded-circle"
                                                                       data-toggle="tooltip">
                                                                        <img src="<?= $imagem->link ?>"
                                                                             onerror="errorImg(this)">
                                                                    </a>
                                                                <?php endforeach ?>
                                                            </div>

                                                            <?php if (!$anuncioComImagens) : ?>
                                                                <span class="text-danger">Anúncio sem imagens.</span>
                                                            <?php endif ?>
                                                        </div>
                                                        <div class="col-md-4">
                                                            <label>Categoria</label>
                                                            <?=
                                                            bs4t_select_categorias(
                                                                'produto[' . $produto->id . '][categoria]',
                                                                $produto->descricaoCurta . ' ' . $produto->descricao . ' ' . $produto->categoria->descricao,
                                                                $anuncioComImagens
                                                            )
                                                            ?>
                                                        </div>
                                                    </div>
                                                    <hr class="my-2">
                                                    <div class="row">
                                                        <div class="col-md-3">
                                                            <label>Largura</label>
                                                            <div class="input-group">
                                                                <input type="number" class="form-control"
                                                                       name="produto[<?= $produto->id ?>][largura]"
                                                                       placeholder="0,00"
                                                                       value="<?= $produto->larguraProduto; ?>" <?= $anuncioComImagens ? '' : 'disabled' ?>>
                                                                <div class="input-group-append">
                                                                    <small class="input-group-text">cm</small>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-3">
                                                            <label>Altura</label>
                                                            <div class="input-group">
                                                                <input type="number" class="form-control"
                                                                       name="produto[<?= $produto->id ?>][altura]"
                                                                       placeholder="0,00"
                                                                       value="<?= $produto->alturaProduto; ?>" <?= $anuncioComImagens ? '' : 'disabled' ?>>
                                                                <div class="input-group-append">
                                                                    <small class="input-group-text">cm</small>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-3">
                                                            <label>Profundidade</label>
                                                            <div class="input-group">
                                                                <input type="number" class="form-control"
                                                                       name="produto[<?= $produto->id ?>][profundidade]"
                                                                       placeholder="0,00"
                                                                       value="<?= $produto->profundidadeProduto; ?>" <?= $anuncioComImagens ? '' : 'disabled' ?>>
                                                                <div class="input-group-append">
                                                                    <small class="input-group-text">cm</small>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-3">
                                                            <label>Peso</label>
                                                            <div class="input-group">
                                                                <input type="number" class="form-control"
                                                                       name="produto[<?= $produto->id ?>][peso]"
                                                                       placeholder="0,00"
                                                                       value="<?= number_format($produto->pesoBruto, 2, '.', ''); ?>" <?= $anuncioComImagens ? '' : 'disabled' ?>>
                                                                <div class="input-group-append">
                                                                    <small class="input-group-text">kg</small>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </td>
                                            </tr>
                                        <?php endforeach; ?>
                                        </tbody>
                                    </table>
                                </div>
                                <div class="row justify-content-center border-top py-4">
                                    <div class="col-auto">
                                        <button type="submit" class="btn btn-success rounded">
                                            Integrar Anúncios Selecionados
                                        </button>
                                    </div>
                                </div>
                            </form>
                            <?php include TUDOCLASSIFICADOS_PATH_VIEW . 'components/pagination/pagination_1.php' ?>
                            <?php tc_pagination(); ?>
                        </div>
                    </div>
                </div>
            </div>
        <?php } ?>
    </div>
</div>
<!-- X----------------------FIM---------------------X--->
