<?php

namespace TudoClassificados\App\src\Integracoes\MercadoPago;

class Autenticacao
{
    public function url()
    {
        $client_id = '463057725192964';
        $redirect_uri = 'https://www.tudoclassificados.com/integracoes/mercadopago/redirect-url';

        $url = "https://auth.mercadopago.com/authorization?client_id=$client_id&response_type=code&platform_id=mp&state=RANDOM_ID&redirect_uri=$redirect_uri";
    }
}