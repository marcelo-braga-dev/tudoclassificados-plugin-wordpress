<?php

namespace TudoClassificados\App\src\Marketplace\Checkouts;

use MercadoPago\Shipments;

class MercadoPago
{
    private $table;

    public function __construct()
    {
        $this->table = 'class_tc_dados_checkout';
    }

    public function store()
    {
        global $wpdb;

        $wpdb->insert($this->table, [
            'nome_comprador' => $_POST['comprador_nome'],
            'cpf_comprador' => $_POST['comprador_cpf'],
            'celular_comprador' => $_POST['comprador_celular'],
            'telefone_comprador' => $_POST['comprador_telefone'],
            'cep_entrega' => $_POST['cep'],
            'endereco_entrega' => $_POST['endereco'],
            'numero_entrega' => $_POST['numero'],
            'complemento_entrega' => $_POST['complemento'],
            'bairro_entrega' => $_POST['bairro'],
            'cidade_entrega' => $_POST['cidade'],
            'estado_entrega' => $_POST['estado'],
        ]);
        return $wpdb->insert_id;
    }

    public function checkout($post, $postMeta)
    {
        global $wpdb;
        $table = new \TudoClassificados\App\src\Integracoes\MercadoPago\Dados();
        $id = get_current_user_id();

        $res = $wpdb->get_row("SELECT * FROM `{$table->table}` WHERE `user` = $id");

        \MercadoPago\SDK::setAccessToken($res->access_token);
        //TEST-463057725192964-032913-cef7b8e423444949671ba0e259a15376-465347382
        $preco = $postMeta['price'][0];

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
        $preference->marketplace_fee = 5;
        $preference->notification_url = "https://www.tudoclassificados.com/integracoes/mercadopago/webhooks";

        $preference->save();

        return [
            'id' => $preference->id,
            'publicKey' => 'TEST-cd0ff363-ce23-46cd-92ac-591e416c5c55'
        ];
    }

    public function getTable()
    {
        return $this->table;
    }
}