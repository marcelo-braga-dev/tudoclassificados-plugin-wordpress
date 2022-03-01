<?php

namespace TudoClassificados\App\src\Shortcodes;

class Paginas
{
    public function __construct()
    {
        add_shortcode("tc_paginas", array($this, "run_shortcode_paginas"));
    }

    public function run_shortcode_paginas($atts)
    {
        if ($atts['pagina'] == 'minha-conta') {
            if (is_user_logged_in()) {
                require_once TUDOCLASSIFICADOS_PATH . 'app/Services/Pages/MinhaConta/index.php';
            }
        }

        if ($atts['pagina'] == 'checkout-marketplace-mercadopago') {
            include TUDOCLASSIFICADOS_PATH_VIEW . 'pages/checkout/marketplace/index.php';
        }
    }
}