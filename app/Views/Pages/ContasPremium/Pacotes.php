<?php

namespace TudoClassificados\App\Views\Pages\ContasPremium;

class Pacotes
{
    public function execute()
    {
        $pacotes = [];

        \MercadoPago\SDK::setAccessToken('APP_USR-463057725192964-032913-6b7e39d2b40aad90039400c893f0ad56-465347382');

        $pacotes['pct-classi-1'] = $this->getPreference('Anúncio de Classificado', 9.99);
        $pacotes['pct-classi-2'] = $this->getPreference('Pacote de Anúncios de Classificados', 99.99);
        $pacotes['pct-imoveis-1'] = $this->getPreference('Pacote Profissional de Imóveis', 299.99);
        $pacotes['pct-imoveis-2'] = $this->getPreference('Pacote Ilimitado Imóveis', 399.99);

        return $pacotes;
    }

    private function getPreference($titulo, $preco)
    {
        $item = new \MercadoPago\Item();
        $preference = new \MercadoPago\Preference();

        $item->title = $titulo;
        $item->quantity = 1;
        $item->unit_price = $preco;
        $preference->items = array($item);
        $preference->external_reference = $titulo . " - " . get_current_user_id();
        $preference->save();

        return $preference->id;
    }
}