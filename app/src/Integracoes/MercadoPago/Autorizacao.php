<?php

namespace TudoClassificados\App\src\Integracoes\MercadoPago;

use GuzzleHttp\Client;
use PHPUnit\Exception;

class Autorizacao extends Dados
{
    public function retorno()
    {
        if (!empty($_GET['code'])) {
            $code = $_GET['code'];
            $state = $_GET['state'];

            $this->autorizar($code);
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

        } catch (Exception $exception) {
            //('erro', 'Ocorreu um erro no cadastro da conta Mercado Livre.');
        }
    }
}