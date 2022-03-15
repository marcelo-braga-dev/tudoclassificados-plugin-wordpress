<style>
    /*.seleciona-linha-table {*/
    /*    cursor: pointer;*/
    /*}*/

    /*.nav-link nav-lvl-2    /*    !* color: var(--principal) !important; *!*/
    /*    color: #333;*/
    /*    font-size: 14px;*/
    /*    font-weight: 300 !important;*/
    /*}*/

    /*.nav-link nav-lvl-2ive {*/
    /*    color: red !important;*/
    /*}*/

    /*a.active {*/
    /*    color: orange !important;*/
    /*}*/

    /*.text-sub-menu {*/
    /*    font-size: 14px !important;*/
    /*}*/
    .nav-lvl-2.active {
        color: orange;
    }
</style>

<div class="card" style="background-color: #fcfcfc">
    <div class="row m-0">
        <div class="col-md-2 card pt-4 pb-md-9 mb-md-9">

            <ul class="list-group navbar-nav m-0" id="minhaLista" role="tablist" style="font-size: 13px;">
                <!-- Perfil -->
                <li class="nav-item">
                    <a class="nav-link nav-lvl-1" href="#navbar-resumo"
                       data-toggle="collapse" role="button"
                       aria-expanded="false" aria-controls="navbar-resumo">
                        <i class="fas fa-user-alt"></i>
                        <span class="ml-2">
                            Resumo
                        </span>
                    </a>
                    <div class="collapse" id="navbar-resumo">
                        <ul class="nav nav-sm flex-column">
                            <li class="nav-item">
                                <a class="nav-link nav-lvl-2"
                                   data-toggle="list"
                                   href="#resumo" role="tab">
                                    <span class="text-sub-menu">Dados de Contato</span>
                                </a>
                            </li>
                        </ul>
                    </div>
                </li>
                <li class="dropdown-divider pb-2"></li>

                <!-- Classificados -->
                <li class="nav-item">
                    <a class="nav-link nav-lvl-1" href="#navbar-classificados"
                       data-toggle="collapse" role="button"
                       aria-expanded="false" aria-controls="navbar-classificados">
                        <i class="fab fa-dribbble"></i>
                        <span class="ml-2">
                            Classificados
                        </span>
                    </a>
                    <div class="collapse
                        <?= $abaMenu == 'classificados' || $abaMenu == 'classificados-integrar-bling' ? 'show' : '' ?>"
                         id="navbar-classificados">
                        <ul class="nav nav-sm flex-column">
                            <li class="nav-item">
                                <a class="nav-link nav-lvl-2 <?= $abaMenu == 'novo-classificados' ? 'active' : '' ?>"
                                   data-toggle="list" href="#novo-classificados" role="tab">
                                    <span class="text-sub-menu">Novo Anúncio</span>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link nav-lvl-2 <?= $abaMenu == 'classificados' ? 'active' : '' ?>"
                                   data-toggle="list"
                                   href="#anuncios-classificados" role="tab">
                                    <span class="text-sub-menu">Anúncios Classificados</span>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link nav-lvl-2 <?= $abaMenu == 'classificados-integrar-bling' ? 'active' : '' ?>"
                                   id="classificados-integrar-tab" data-toggle="list"
                                   href="#classificados-integrar" role="tab">
                                    <span class="text-sub-menu">Integrar com Bling</span>
                                </a>
                            </li>
                        </ul>
                    </div>
                </li>
                <li class="dropdown-divider pb-2"></li>

                <!-- Marketplace -->
                <li class="nav-item">
                    <a class="nav-link nav-lvl-1" href="#navbar-marketplace"
                       data-toggle="collapse" role="button"
                       aria-expanded="false" aria-controls="navbar-marketplace">
                        <i class="fas fa-store"></i>
                        <span class="ml-2">
                            Marketplace
                        </span>
                    </a>
                    <div class="collapse <?= $abaMenu == 'marketplace' || $abaMenu == 'marketplace-integrar-bling' ? 'show' : '' ?>"
                         id="navbar-marketplace">
                        <ul class="nav nav-sm flex-column">
                            <li class="nav-item">
                                <a class="nav-link nav-lvl-2 <?= $abaMenu == 'marketplace' ? 'active' : '' ?>"
                                   data-toggle="list"
                                   href="#marketplace_anuncios" role="tab">
                                    <span class="text-sub-menu">Anuncios Marketplace</span>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link nav-lvl-2 <?= $abaMenu == 'marketplace-integrar-bling' ? 'active' : '' ?>"
                                   id="classificados-integrar-tab" data-toggle="list"
                                   href="#marketplace_integrar" role="tab">
                                    <span class="text-sub-menu">Integrar com Bling</span>
                                </a>
                            </li>
                        </ul>
                    </div>
                </li>

                <li class="dropdown-divider pb-2"></li>

                <!-- Afiliado -->
                <li class="nav-item">
                    <a class="nav-link nav-lvl-1" href="#navbar-afiliado"
                       data-toggle="collapse" role="button"
                       aria-expanded="false" aria-controls="navbar-afiliado">
                        <i class="fas fa-desktop"></i>
                        <span class="ml-2">
                            Afiliado
                        </span>
                    </a>
                    <div class="collapse" id="navbar-afiliado">
                        <ul class="nav nav-sm flex-column">
                            <li class="nav-item">
                                <a class="nav-link nav-lvl-2"
                                   data-toggle="list"
                                   href="#anuncios_filiado" role="tab">
                                    <span class="text-sub-menu">Anuncios Afiliado</span>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link nav-lvl-2"
                                   id="classificados-integrar-tab" data-toggle="list"
                                   href="#filiado_bling" role="tab">
                                    <span class="text-sub-menu">Integrar com Bling</span>
                                </a>
                            </li>
                        </ul>
                    </div>
                </li>

                <li class="dropdown-divider pb-2"></li>

                <!-- Imoveis -->
                <li class="nav-item">
                    <a class="nav-link nav-lvl-1" href="#navbar-imoveis"
                       data-toggle="collapse" role="button"
                       aria-expanded="false" aria-controls="navbar-imoveis">
                        <i class="fas fa-home"></i>
                        <span class="ml-2">
                            Imóveis
                        </span>
                    </a>
                    <div class="collapse <?= $abaMenu == 'imoveis' || $abaMenu == 'imoveis-integrar-ingaia' ? 'show' : '' ?>"
                         id="navbar-imoveis">
                        <ul class="nav nav-sm flex-column">
                            <li class="nav-item">
                                <a class="nav-link nav-lvl-2 <?= $abaMenu == 'imoveis' ? 'active' : '' ?>"
                                   data-toggle="list"
                                   href="#imoveis_anuncios" role="tab">
                                    <span class="text-sub-menu">Anuncios de Imóveis</span>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link nav-lvl-2 <?= $abaMenu == 'imoveis-integrar-ingaia' ? 'active' : '' ?>"
                                   id="classificados-integrar-tab" data-toggle="list"
                                   href="#imoveis_ingaia" role="tab">
                                    <span class="text-sub-menu">Integrar com inGaia</span>
                                </a>
                            </li>
                        </ul>
                    </div>
                </li>

                <li class="dropdown-divider pb-2"></li>

                <!-- Imoveis -->
                <li class="nav-item">
                    <a class="nav-link nav-lvl-1" href="#navbar-comentarios"
                       data-toggle="collapse" role="button"
                       aria-expanded="false" aria-controls="navbar-comentarios">
                        <i class="fas fa-comment"></i>
                        <span class="ml-2">
                            Comentários
                        </span>
                    </a>
                    <div class="collapse" id="navbar-comentarios">
                        <ul class="nav nav-sm flex-column">
                            <li class="nav-item">
                                <a class="nav-link nav-lvl-2"
                                   data-toggle="list"
                                   href="#comentarios" role="tab">
                                    <span class="text-sub-menu">Perguntas</span>
                                </a>
                            </li>
                        </ul>
                    </div>
                </li>

                <li class="dropdown-divider pb-2"></li>

                <!-- Pagamentos -->
                <li class="nav-item">
                    <a class="nav-link nav-lvl-1" href="#navbar-pagamentos"
                       data-toggle="collapse" role="button"
                       aria-expanded="false" aria-controls="navbar-pagamentos">
                        <i class="fas fa-dollar-sign"></i>
                        <span class="ml-2">
                            Pagamentos
                        </span>
                    </a>
                    <div class="collapse" id="navbar-pagamentos">
                        <ul class="nav nav-sm flex-column">
                            <li class="nav-item">
                                <a class="nav-link nav-lvl-2"
                                   data-toggle="list"
                                   href="#pagamentos" role="tab">
                                    <span class="text-sub-menu">Histórico</span>
                                </a>
                            </li>
                        </ul>
                    </div>
                </li>

                <li class="dropdown-divider pb-2"></li>

                <li class="nav-item">
                    <a class="nav-link nav-lvl-1" href="#navbar-perfil"
                       data-toggle="collapse" role="button"
                       aria-expanded="false" aria-controls="navbar-perfil">
                        <i class="fas fa-user-cog"></i>
                        <span class="ml-2">
                            Minha Conta
                        </span>
                    </a>
                    <div class="collapse" id="navbar-perfil">
                        <ul class="nav nav-sm flex-column">
                            <li class="nav-item">
                                <a class="nav-link nav-lvl-2"
                                   data-toggle="list"
                                   href="#editar-perfil" role="tab">
                                    <span class="text-sub-menu">Editar Perfil</span>
                                </a>
                            </li>
                        </ul>
                    </div>
                </li>
            </ul>
        </div>

        <div class="col-md-10">
            <!-- Painel de abas -->
            <div class="tab-content">
                <!-- Resumo -->
                <div class="tab-pane fade <?php if (empty($abaMenu)) echo 'active show' ?>" id="resumo"
                     role="tabpanel">
                    <?php include 'resumo/resumo.php' ?>
                </div>

                <!-- Anuncios Classificados -->
                <div class="tab-pane fade <?= $abaMenu == 'classificados' ? 'active show' : '' ?>"
                     id="novo-classificados" role="tabpanel">
                    <?php include 'classificados/novo-anuncio/novo-anuncio.php' ?>
                </div>
                <div class="tab-pane fade <?= $abaMenu == 'classificados' ? 'active show' : '' ?>"
                     id="anuncios-classificados" role="tabpanel">
                    <?php include 'classificados/anuncios-classificados.php' ?>
                </div>
                <div class="tab-pane fade <?= $abaMenu == 'classificados-integrar-bling' ? 'active show' : '' ?>"
                     id="classificados-integrar" role="tabpanel">
                    <?php include 'classificados/integrar/integrar.php' ?>
                </div>

                <!-- Marketplace -->
                <div class="tab-pane fade <?= $abaMenu == 'marketplace' ? 'active show' : '' ?>"
                     id="marketplace_anuncios" role="tabpanel">
                    <?php include 'marketplace/anuncios.php' ?>
                </div>
                <div class="tab-pane fade <?= $abaMenu == 'marketplace-integrar-bling' ? 'active show' : '' ?>"
                     id="marketplace_integrar" role="tabpanel">
                    <?php include 'marketplace/integracao/bling/index.php' ?>
                </div>

                <!-- Afiliado -->
                <div class="tab-pane fade" id="anuncios_filiado" role="tabpanel">
                    <?php include 'afiliado/anuncios.php' ?>
                </div>
                <div class="tab-pane fade <?= $abaMenu == 'filiado_bling' ? 'active show' : '' ?>"
                     id="filiado_bling" role="tabpanel">
                    <?php include 'afiliado/bling/index.php' ?>
                </div>

                <!-- Imoveis -->
                <div class="tab-pane fade <?= $abaMenu == 'imoveis' ? 'active show' : '' ?>" id="imoveis_anuncios"
                     role="tabpanel">
                    <?php include 'imoveis/anuncios.php'; ?>
                </div>
                <div class="tab-pane fade <?= $abaMenu == 'imoveis-integrar-ingaia' ? 'active show' : '' ?>"
                     id="imoveis_ingaia" role="tabpanel">
                    <?php include 'imoveis/ingaia/index.php'; ?>
                </div>

                <!-- Comentarios -->
                <div class="tab-pane fade" id="comentarios" role="tabpanel">
                    <?php include 'comentarios/comentarios.php' ?>
                </div>

                <!-- Pagamentos -->
                <div class="tab-pane fade" id="pagamentos" role="tabpanel">
                    <?php include 'pagamentos/pagamentos.php' ?>
                </div>

                <!-- Perfil -->
                <div class="tab-pane fade" id="editar-perfil" role="tabpanel">
                    <?php include 'perfil/editar-perfil.php' ?>
                </div>
            </div>
        </div>
    </div>
</div>

<?php if (!empty($alerta)) : ?>
    <!-- Modal -->
    <div class="modal fade" id="modalAlertSimples" tabindex="-1" role="dialog" aria-labelledby="TituloModalCentralizado"
         aria-hidden="true">
        <div class="modal-dialog modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="TituloModalCentralizado">Aviso</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Fechar">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <?php
                    if (!empty($alerta['sucesso'])) :
                        echo $alerta['sucesso'];
                    endif;
                    ?>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
                </div>
            </div>
        </div>
    </div>
    <script>
        $(function () {
            $('#modalAlertSimples').modal('show');
        })
    </script>
<?php endif ?>


<script>
    let maxPremiumGeral = '<?= bs4t_user_is_premium('geral') ?>';
    let maxPremiumImovel = '<?= bs4t_user_is_premium('imoveis') ?>';
    const qtdImovelAtivo = '<?= $qtdImovelAtivo ?>';
    const qtdGeralAtivo = '<?= $qtdGeralAtivo ?>';

    const abaMeusAnuncios = <?= get_query_var('paged') ?>;
    const abaIntegracaoMinhaConta = '<?= $_POST['buscar-ingaia'] . $_POST['integrar_ingaia'] ?>';
    const abaIntegracaoBling = '<?= $_GET['page_bling'] . $_POST['api-key-bling'] ?>';
</script>


<script>
    let limite_disponivel_imoveis = <?= $limitesImovel['novos'] ?>;
</script>
<?php
function bs4t_nav_minha_conta()
{
    wp_enqueue_script('minha-conta-1', plugin_dir_url(__FILE__) . 'assets/js/main.js', [], false, true);
    ?>
    <script src="<?= plugin_dir_url(__FILE__) . 'assets/js/main.js' ?>"></script>
    <script>
        $(function () {
            $('.nav-lvl-1').click(function () {
                $('.nav-lvl-1').parent().parent().find('.show').toggleClass('show', 5000);
                $('.nav-lvl-2').removeClass('active');
            });
        });
    </script>
    <?php
}

add_action('wp_footer', 'bs4t_nav_minha_conta', 102);


//function bs4t_integracao_ingaia()
//{
//    ?>
<!--    <script src="/wp-content/plugins/tudoclassificados/pages/minha-conta/imoveis/ingaia/principal.js"></script>-->
<!--    --><?php
//}
//
//add_action('wp_footer', 'bs4t_integracao_ingaia', 102);
//?>
<!---->
<?php
//function bs4t_salvar_resposta_comentario()
//{
//    ?>
<!--    <script src="/wp-content/plugins/tudoclassificados/pages/minha-conta/assets/js/comentarios.js?id=--><? // //= uniqid() ?><!--"></script>-->
<!--    --><?php
//}
//
//add_action('wp_footer', 'bs4t_salvar_resposta_comentario', 102);
//?>
