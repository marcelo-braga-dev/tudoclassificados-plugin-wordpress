<?php

namespace TudoClassificados\App\src\Integracoes\MercadoPago;

class ArmazenarDados
{
    public function store(array $dados)
    {
        global $wpdb;

        $dados = array_merge($dados, ['user' => get_current_user_id()]);

        $wpdb->insert('class_tc_integracoes_mercadopago', $dados);
    }
}