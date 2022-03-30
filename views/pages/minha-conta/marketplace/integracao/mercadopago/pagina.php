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
                            <?php foreach ($contasIntegradasMercadoPago as $item) : ?>
                                <table>
                                    <tr>
                                        <th>ID da Conta</th>
                                        <th>Data da Integração</th>
                                        <th></th>
                                    </tr>
                                    <tr>
                                        <td><?= $item->user_id ?></td>
                                        <td><?= date('d/m/Y H:i:s', strtotime($item->created_at)) ?></td>
                                        <td><span class="text-danger">Remover</span></td>
                                    </tr>
                                </table>
                            <?php endforeach; ?>
                        </div>
                    </div>

                <?php endif; ?>
                <div class="row mb-4">
                    <div class="col">
                        <a class="btn btn-primary"
                           href="https://auth.mercadopago.com/authorization?client_id=463057725192964&response_type=code&platform_id=mp&state=RANDOM_ID&redirect_uri=https://www.tudoclassificados.com/integracoes/mercadopago/redirect-url">
                            Integrar Conta
                        </a>
                    </div><hr>
                </div>
            </div>
        </div>
    </div>
</div>
