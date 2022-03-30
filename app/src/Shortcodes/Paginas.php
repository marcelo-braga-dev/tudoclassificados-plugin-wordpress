<?php

namespace TudoClassificados\App\src\Shortcodes;

use TudoClassificados\App\src\Integracoes\MercadoPago\Autorizacao;
use TudoClassificados\App\src\Marketplace\Checkouts\MercadoPago;
use TudoClassificados\App\src\Shortcodes\Anuncios\NovoAnuncio;
use TudoClassificados\App\Views\Pages\Classificados\Anuncios\Index;
use TudoClassificados\App\Views\Pages\MinhaConta\MinhaConta;

class Paginas
{
    public function __construct()
    {
        add_shortcode("tc_paginas", array($this, "run_shortcode_paginas"));
        add_shortcode("tc_lista_anuncios_classificados", [new Index(), "run_shortcode_lista_anuncios_classificados"]);
    }

    public function run_shortcode_paginas($atts)
    {
        if ($atts['pagina'] == 'minha-conta') {
            if (is_user_logged_in()) {
                new NovoAnuncio();

                $minhaConta = new MinhaConta();
                $minhaConta->index();
            }
        }

        if ($atts['pagina'] == 'lista-anuncio') {
            if ($atts['tipo'] == 'marketplace') {
                $pagina = new \TudoClassificados\App\Views\Pages\Marketplace\Anuncios\Index();
                return $pagina->index($atts);
            }
        }

        if ($atts['pagina'] == 'checkout-marketplace-mercadopago') {
            if ($atts['tipo'] == 'create') {
                $pagina = new MercadoPago();

                if ($_SERVER['REQUEST_METHOD'] == 'GET') {
                    $pagina->create();
                }

                if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                    $pagina->store();
                }
            }
        }

        if ($atts['pagina'] == 'redirect-url-mercadopago') {
            $pagina = new Autorizacao();
            $pagina->retorno();
        }
    }
}