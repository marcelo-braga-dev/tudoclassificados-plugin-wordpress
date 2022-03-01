<?php

namespace TudoClassificados\App\Views\Components\AnuncioUnico;

class ImagemPrincipal
{
    public function execute($post_meta)
    {
        view('components/anuncio-unico/imagem-principal.php', ['post_meta' => $post_meta]);
    }
}