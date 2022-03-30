<?php

namespace TudoClassificados\App\src\Integracoes\Bling;

use TudoClassificados\App\src\Integracoes\Bling\Marketplace\CadastrarProduto;

class Bling
{
    private $produtos;

    public function __construct()
    {
        $this->produtos = [];
    }

    public function buscarPrudutos()
    {
        if (!empty($_GET['token_bling'])) {
            $clsBling = new Requisicao();
            $this->produtos = $clsBling->getProdutos($_GET['token_bling']);
        }

        set_menu_minha_conta('marketplace-integrar-bling');
        return $this->produtos;
    }

    public function cadastrarAnuncios(string $tipo): void
    {
        if (!empty($_POST['checks'])) {
            if (!empty($_POST['integrar_marketplace_bling'])) {
                $cadastrarAnuncio = new CadastrarProduto();
                $cadastrarAnuncio->cadastrar($this->produtos);
            }

            if (!empty($_GET['integrar_afiliado_bling'])) {
                $clsBling = new CadastrarProdutoBling($tipo);
                $clsBling->cadastrar($this->produtos);
            }

            set_menu_minha_conta($tipo);
            wp_redirect('/minha-conta');
            exit();
        }
    }

    public function getProdutos()
    {
        return $this->produtos;
    }
}
