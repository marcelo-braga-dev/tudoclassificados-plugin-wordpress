<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header bg-white">
                <div class="row justify-content-between align-items-center px-3">
                    <div class="col-auto">
                        <h5 class="mb-0">Integrar Conta Mercado Pago</h5>
                    </div>
                    <div class="col-auto">
                        <div class="icon icon-shape bg-principal text-white rounded-circle shadow">
                            <i class="fas fa-dollar-sign"></i>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <?php if (!empty($contasIntegradasMercadoPago)) : ?>
                    <div class="row">
                        <div class="col">
                            <h5>Conta Mercado Pago Integradas</h5>
                            <p>As transações por venda serão depositas automaticamente na sua conta Mercado Pago.</p>
                            <table>
                                <tr>
                                    <th>ID da Conta</th>
                                    <th>Data da Integração</th>
                                    <th>Validade</th>
                                    <th></th>
                                </tr>
                                <?php foreach ($contasIntegradasMercadoPago as $item) : ?>
                                    <tr>
                                        <td><?= $item->user_id ?></td>
                                        <td><?= date('d/m/Y H:i:s', strtotime($item->created_at)) ?></td>
                                        <td><?= date('d/m/Y H:i:s', strtotime($item->created_at) + $item->expires_in) ?></td>
                                        <td></td>
                                    </tr>
                                <?php endforeach; ?>
                            </table>
                        </div>
                    </div>
                <?php else : ?>
                    <div class="row mb-4">
                        <div class="col">
                            <p>Realize a integração da sua conta Mercado Pago para receber o dinheiro da suas
                                vendas.</p>
                            <p>Todas as transações são realizadas por meio da plataforma oficial do Mercado Pago para
                                Marketplace.</p>
                            <p>Será descontado automaticamente 5% do valor do produto vendido.</p>
                        </div>
                    </div>
                    <div class="row mb-4">
                        <div class="col">
                            <a class="btn btn-primary"
                               href="https://auth.mercadopago.com/authorization?client_id=463057725192964&response_type=code&platform_id=mp&state=RANDOM_ID&redirect_uri=https://www.tudoclassificados.com/integracoes/mercadopago/redirect-url">
                                Integrar Conta
                            </a>
                        </div>
                        <hr>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>
