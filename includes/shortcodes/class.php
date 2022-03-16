<?php

new \TudoClassificados\App\src\Shortcodes\Paginas();
new \TudoClassificados\App\src\Shortcodes\Anuncios\CardGerenciarAnuncio();
new \TudoClassificados\App\src\Shortcodes\Widgets();

//
new \TudoClassificados\App\src\Shortcodes\Anuncios\Classificados\Templates\Grid();



require_once TUDOCLASSIFICADOS_PATH . 'includes/classes/Anuncios/Templates/Cards.php';
require_once TUDOCLASSIFICADOS_PATH . 'includes/classes/Anuncios/Templates/Marketplace/ListaAnunciosMarketplace.php';

new TudoClassificados\App\Views\Pages\Imoveis\Anuncios\Index;
new Cards();
new ListaAnunciosMarketplace();