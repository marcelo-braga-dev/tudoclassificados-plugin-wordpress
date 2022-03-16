<?php

namespace TudoClassificados\App\src\Shortcodes;

use TudoClassificados\App\src\Shortcodes\Anuncios\NovoAnuncio;
use TudoClassificados\App\Views\Pages\Classificados\Anuncios\Index;

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
                require_once TUDOCLASSIFICADOS_PATH . 'app/Services/Pages/MinhaConta/index.php';
            }
        }

        if ($atts['pagina'] == 'checkout-marketplace-mercadopago') {
            include TUDOCLASSIFICADOS_PATH_VIEW . 'pages/checkout/marketplace/index.php';
        }
    }
}