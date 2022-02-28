<?php

include_once TUDOCLASSIFICADOS_PATH_VIEW . 'pages/pacotes/src/MercadoPago.php';
include_once 'src/AlterarPremium.php';

?>
<?php if ($resposta) : ?>
    <div class="alert alert-success rounded">
        <?= $resposta ?>
    </div>
<?php endif ?>