<?php

namespace TudoClassificados\App\src\Integracoes\MercadoPago;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\ClientException;
use PHPUnit\Exception;

class Autorizacao extends Dados
{
    public function retorno()
    {
        if (!empty($_GET['code'])) {
            $code = $_GET['code']; //TG-624451cedcb154001abd08ec-465347382
            $state = $_GET['state'];

            $this->autorizar($code);
        } else {
            echo 'Pagina de redirect do Mercado Pago';
        }
    }

    public function autorizar(string $code)
    {
        $client = new Client();

        try {
            $requisicao = $client->request('POST',
                'https://api.mercadopago.com/oauth/token', [
                    'headers' => [
                        'Authorization' => 'Bearer ' . 'APP_USR-463057725192964-032913-6b7e39d2b40aad90039400c893f0ad56-465347382',
                        'accept' => 'application/json',
                        'content-type' => 'application/x-www-form-urlencoded'
                    ],
                    'form_params' => [
                        'client_secret' => 'E3wvJ86kDYxCKhTgO6B6ZAGLrlVlTDbk',
                        'client_id' => '463057725192964',
                        'grant_type' => 'authorization_code',
                        'code' => $code,
                        'redirect_uri' => 'https://www.tudoclassificados.com/integracoes/mercadopago/redirect-url',
                    ]
                ]);

            $json = $requisicao->getBody();
            $resposta = json_decode($json, true);
            print_pre($resposta);

        } catch (ClientException $e) {
            echo $e->getMessage();
        }
    }
}
