<?php

namespace TudoClassificados\App\src\Shortcodes\Anuncios;

use TudoClassificados\App\src\Shortcodes\Anuncios\Classificados\Cadastrar;
use TudoClassificados\App\src\Shortcodes\Anuncios\Imoveis\CadastrarImovel;

class NovoAnuncio
{
    public function __construct()
    {
        add_shortcode("tc_novo_anuncio", array($this, "run_shortcode_paginas"));
    }

    public function run_shortcode_paginas($attr)
    {
        if ($attr['tipo'] == 'classificados') {
            $tipo = new Cadastrar();
            $tipo->executar();
        }

        if ($attr['tipo'] == 'imoveis') {
            $tipo = new CadastrarImovel();
            $tipo->executar();
        }
    }
}