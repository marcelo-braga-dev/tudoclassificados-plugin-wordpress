<?php

namespace TudoClassificados\App\Views\Pages\Marketplace\Checkouts;

class MercadoPago
{
    public function create()
    {
        $post = get_post($_GET['id']);
        $post_meta = get_post_meta($_GET['id']);

        if ($post->post_type != 'acadp_listings' || $post->post_status != 'publish') return;

        $valorTotal = tc_converter_money_float($post_meta['price'][0]) + tc_converter_money_float($_GET['frete_valor']);
        $valorTotal = tc_converter_float_money($valorTotal);

        include TUDOCLASSIFICADOS_PATH_VIEW . 'pages/marketplace/checkout/create.php';
    }

    public function show($id)
    {
        global $wpdb;

        $post = get_post($_GET['id']);
        $post_meta = get_post_meta($_GET['id']);

        $checkout = new \TudoClassificados\App\src\Marketplace\Checkouts\MercadoPago();
        $preference = $checkout->checkout($post->post_title, $post_meta['price'][0]);

        $dados = $wpdb->get_row("SELECT * FROM `{$checkout->getTable()}` WHERE `id` = '$id'");

        include TUDOCLASSIFICADOS_PATH_VIEW . 'pages/marketplace/checkout/show.php';
    }
}