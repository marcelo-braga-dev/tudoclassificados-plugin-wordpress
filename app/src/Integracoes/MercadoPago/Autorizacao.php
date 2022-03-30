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
                'https://api.mercadolibre.com/oauth/token', [
                    'headers' => [
                        'accept' => 'application/json',
                        'content-type' => 'application/x-www-form-urlencoded'
                    ],
                    'form_params' => [
                        'grant_type' => 'authorization_code',
                        'client_id' => $this->appID,
                        'client_secret' => $this->clientSecret,
                        'code' => $code,
                        'redirect_uri' => $this->redirectUri,
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