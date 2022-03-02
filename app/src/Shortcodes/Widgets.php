<?php

namespace TudoClassificados\App\src\Shortcodes;

use TudoClassificados\App\Views\Widgets\Categorias;
use TudoClassificados\App\Views\Widgets\GridAunciosHorizontal;

class Widgets
{
    public function __construct()
    {
        add_shortcode("tc_widgets", array($this, "run_shortcode_widgets"));
    }

    public function run_shortcode_widgets($atts)
    {
        if ($atts['chave'] == 'categorias') {
            $categorias = new Categorias();
            return $categorias->execute();
        }

        if ($atts['chave'] == 'grid-anuncios-horizontal') {
            // qtd=""
            $grid = new GridAunciosHorizontal();
            return $grid->index($atts);
        }
    }
}