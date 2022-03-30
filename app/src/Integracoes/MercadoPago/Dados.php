<?php

namespace TudoClassificados\App\src\Integracoes\MercadoPago;

class Dados
{
    public $appID;
    public $clientSecret;
    public $redirectUri;

    public function __construct()
    {
        $this->appID = '463057725192964';
        $this->clientSecret = 'TEST-463057725192964-032913-cef7b8e423444949671ba0e259a15376-465347382';
        $this->redirectUri = 'https://www.tudoclassificados.com/integracoes/mercadopago/redirect-url';
    }
}