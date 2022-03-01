<?php

namespace TudoClassificados\App\Views\Pages;

use TudoClassificados\App\src\Shortcodes\Anuncios\Classificados\Templates\AnuncioUnicoClassificados;
use TudoClassificados\App\src\Shortcodes\Anuncios\Imoveis\Templates\AnuncioUnicoImoveis;
use TudoClassificados\App\Views\Pages\Marketplace\Anuncios\Show;

class AnuncioUnico
{
    public function execute($content)
    {
        if (is_singular('acadp_listings') && in_the_loop() && is_main_query()) {
            global $post;

            $postMeta = get_post_meta($post->ID);
            $tipo = $postMeta['tipo'][0];

            if ($tipo == 'classificados') {
                $anuncio = new AnuncioUnicoClassificados();
                return $anuncio->execute($post, $content);
            }

            if ($tipo == 'marketplace') {
                $anuncio = new Show();
                return $anuncio->index($post, $content);
            }

            if ($tipo == 'imoveis') {
                $anuncio = new AnuncioUnicoImoveis();
                return $anuncio->execute($post, $content);
            }
        }

        return $content;
    }
}