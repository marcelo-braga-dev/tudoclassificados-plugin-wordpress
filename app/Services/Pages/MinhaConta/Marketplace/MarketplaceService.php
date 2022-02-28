<?php

namespace TudoClassificados\App\Services\Pages\MinhaConta\Marketplace;

use TudoClassificados\App\Integracoes\Bling\Bling;

class MarketplaceService
{
    public function index()
    {
        $bling = new Bling();
        $bling->buscarPrudutos();
        $bling->cadastrarAnuncios('marketplace');

        return $bling->getProdutos();
    }
}