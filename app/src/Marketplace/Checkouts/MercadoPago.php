<?php

namespace TudoClassificados\App\src\Marketplace\Checkouts;

use MercadoPago\Shipments;

class MercadoPago
{
    public function execute()
    {
        $post = get_post($_GET['id']);
        $post_meta = get_post_meta($_GET['id']);

        if ($post->post_type != 'acadp_listings' || $post->post_status != 'publish') return;

        $valorTotal = tc_converter_money_float($post_meta['price'][0]) + tc_converter_money_float($_GET['frete_valor']);
        $valorTotal = tc_converter_float_money($valorTotal);

        $preference = $this->checkout($post, $post_meta);

        include TUDOCLASSIFICADOS_PATH_VIEW . 'pages/marketplace/checkout/index.php';
    }

    private function checkout($post, $postMeta)
    {
        \MercadoPago\SDK::setAccessToken('TEST-463057725192964-032913-cef7b8e423444949671ba0e259a15376-465347382');

        $preco = $postMeta['price'][0];
        $preco = 10;

        $preference = new \MercadoPago\Preference();

        $item = new \MercadoPago\Item();
        $item->title = esc_html($post->post_title);
        $item->quantity = 1;
        $item->currency_id = "BRL";
        $item->unit_price = $preco;

        if (!empty($_GET['frete_valor'])) {
            $precoFrete = str_replace(',', '.', $_GET['frete_valor']);

            $shipments = new Shipments();
            $shipments->cost = floatval($precoFrete);
            $shipments->mode = $_GET['frete_tipo'];
            $preference->shipments = $shipments;
        }

        $payer = new \MercadoPago\Payer();

        $preference->items = array($item);
        $preference->payer = $payer;
        $preference->marketplace_fee = 2.5;
        $preference->notification_url = "https://www.tudoclassificados.com/integracoes/mercadopago/webhooks";

        $preference->save();

        return [
            'id' => $preference->id,
            'publicKey' => 'TEST-cd0ff363-ce23-46cd-92ac-591e416c5c55'
        ];
    }
}