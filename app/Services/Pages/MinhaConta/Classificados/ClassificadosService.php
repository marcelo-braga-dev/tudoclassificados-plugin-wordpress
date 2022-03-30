<?php

namespace TudoClassificados\App\Services\Pages\MinhaConta\Classificados;

use TudoClassificados\App\src\Integracoes\Bling\CadastrarProdutoBling;
use TudoClassificados\App\src\Integracoes\Bling\Requisicao;

class ClassificadosService
{
    public function index()
    {
        if (!empty($_GET['token_bling'])) {
            $clsBling = new Requisicao();
            $produtosBling = $clsBling->getProdutos($_GET['token_bling']);

            set_menu_minha_conta('classificados-integrar-bling');

            if (empty($_POST['checks'])) return $produtosBling;

            $this->cadastrarAnuncios($produtosBling);
        }
    }

    private function cadastrarAnuncios(array $produtosBling): void
    {
        $clsBling = new CadastrarProdutoBling('classificados');
        $clsBling->cadastrar($produtosBling);

        set_menu_minha_conta('classificados');
        wp_redirect('/minha-conta');
        exit();
    }
}