<?php

namespace TudoClassificados\App\Views\Pages\MinhaConta;

use TudoClassificados\App\Services\Pages\MinhaConta\Classificados\ClassificadosService;
use TudoClassificados\App\Services\Pages\MinhaConta\Imoveis\ImoveisService;
use TudoClassificados\App\Services\Pages\MinhaConta\Marketplace\MarketplaceService;

class MinhaConta
{
    public function index()
    {
        $userId = get_current_user_id();
        $userMeta = get_user_meta($userId);

        require_once TUDOCLASSIFICADOS_PATH . 'app/Helpers/minha-conta.php';

        if ($_POST['editar-premium']) {
            update_post_meta($_POST['post_id'], 'featured', $_POST['valor']);
            print_pre($_POST);
        }

        if (!empty($_POST['cep-usuario'])) {
            set_cep_usuario($_POST['cep-usuario']);
        }

        // Classificados
        if (!empty($_GET['classificados-bling'])) {
            $service = new ClassificadosService();
            $produtosBling = $service->index();
        }

        // Marketplace
        if (!empty($_GET['marketplace-bling'])) {
            $service = new MarketplaceService();
            $produtosBling = $service->index();
        }

        // Imoveis
        if (!empty($_GET['imoveis_ingaia'])) {
            $service = new ImoveisService();
            $imoveisIngaia = $service->index();
        }

        $contasIntegradasMercadoPago = $this->getContasIntegradasMercadoPago();

        $limiteAnunciosPremium = get_limit_anuncios_premium($userId);
        $anunciosImoveisAtivo = get_qtd_anuncios_imoveis_usuario($userId);
        $limitesImovel = tc_limit_imoveis_usuario($limiteAnunciosPremium['imoveis'], $anunciosImoveisAtivo);

        require_once TUDOCLASSIFICADOS_PATH_VIEW . 'pages/minha-conta/minha-conta.php';
        set_menu_minha_conta('destroy');
    }

    private function getContasIntegradasMercadoPago()
    {
        global $wpdb;
        $table = new \TudoClassificados\App\src\Integracoes\MercadoPago\Dados();
        $id = get_current_user_id();

        return $wpdb->get_results("SELECT * FROM `{$table->table}` WHERE `user` = $id");
    }
}