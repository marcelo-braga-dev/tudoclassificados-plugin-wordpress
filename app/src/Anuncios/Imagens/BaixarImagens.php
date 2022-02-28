<?php

namespace TudoClassificados\App\src\Anuncios\Imagens;

class BaixarImagens
{
    public function download($link, $titulo, $origem): string
    {
        $repositorio = new RepositorioExterno();
        return $repositorio->download($link, $titulo, $origem);
    }
}