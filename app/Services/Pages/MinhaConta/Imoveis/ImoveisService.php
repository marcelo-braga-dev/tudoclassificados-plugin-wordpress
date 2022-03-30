<?php

namespace TudoClassificados\App\Services\Pages\MinhaConta\Imoveis;

use TudoClassificados\App\src\Integracoes\Ingaia\Ingaia;

class ImoveisService
{
    public function index()
    {
        if (!empty($_GET['apikey_ingaia'])) {
            set_menu_minha_conta('imoveis-integrar-ingaia');

            $ingaia = new Ingaia();
            $imoveis = $ingaia->getImoveis();

            if (empty($_POST['check_cod_ingaia'])) return $imoveis;

            $this->cadastrar($ingaia, $imoveis);
        }
    }

    private function cadastrar(Ingaia $ingaia, $imoveis): void
    {
        $ingaia->cadastrar($imoveis);

        set_menu_minha_conta('imoveis');
        wp_redirect('/minha-conta');
        exit();
    }
}