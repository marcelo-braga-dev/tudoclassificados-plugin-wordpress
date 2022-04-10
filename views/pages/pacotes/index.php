<script src="https://www.mercadopago.com/v2/security.js" view="item"></script>
<script src="https://sdk.mercadopago.com/js/v2"></script>

<script>
    // Adicione as credenciais do SDK
    const mp = new MercadoPago('APP_USR-2c5c4854-79f8-4c88-8aa3-d02c052e9c4f', {
        locale: 'pt-BR'
    });

    // Inicialize o checkout
    const pct_classi_1 = mp.checkout({
        preference: {
            id: '<?= $preference['pct-classi-1'] ?>'
        }
    });

    const pct_classi_2 = mp.checkout({
        preference: {
            id: '<?= $preference['pct-classi-2'] ?>'
        }
    });

    const pct_imoveis_1 = mp.checkout({
        preference: {
            id: '<?= $preference['pct-imoveis-1'] ?>'
        }
    });

    const pct_imoveis_2 = mp.checkout({
        preference: {
            id: '<?= $preference['pct-imoveis-2'] ?>'
        }
    });

</script>

<?php
if (!function_exists('tc_checkout_mercadopago_pacotes')){
    function tc_checkout_mercadopago_pacotes()
    {  ?>
        <script>
            $(function () {
                $('#pct-classi-1').click(function () {
                    pct_classi_1.open();
                });
                $('#pct-classi-2').click(function () {
                    pct_classi_2.open();
                });
                $('#pct-imoveis-1').click(function () {
                    pct_imoveis_1.open();
                });
                $('#pct-imoveis-2').click(function () {
                    pct_imoveis_2.open();
                });
            })
        </script>
        <?php
    }
}


add_action('wp_footer', 'tc_checkout_mercadopago_pacotes', 200);
