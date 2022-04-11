<?php
function view(string $dir, array $vars = [])
{
    $a = '';

    foreach ($vars as $index => $var) {
        $a = $index;
        $$a = $var;
    }

    return require_once TUDOCLASSIFICADOS_PATH_VIEW . $dir;
}

function modalSucesso(string $mensagem)
{
    ?>
    <div class="modal fade" id="modalSucesso" tabindex="-1" role="dialog" aria-labelledby="TituloModalCentralizado"
         aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="TituloModalCentralizado">Título do modal</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Fechar">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <?= $mensagem ?>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
                    <button type="button" class="btn btn-primary">Salvar mudanças</button>
                </div>
            </div>
        </div>
    </div>
    <?php
}

function cepUsuario()
{
    return get_user_meta(get_current_user_id(), 'cep', true);
}

function cadastrarCep(): void
{
    if (!empty($_POST['cep'])) {
        $cep = str_replace('-', '', $_POST['cep']);
        update_user_meta(get_current_user_id(), 'cep', $cep);
        wp_redirect($_SERVER['REQUEST_URI']);
        exit();
    }
    ?>
    <form method="post">
        <div class="row justify-content-center align-items-end py-3">
            <div class="col-8 col-md-3">
                <label for="cep">Insira seu cep:</label>
                <input type="text" class="form-control" id="cep" name="cep" data-mask="00000-000"
                       minlength="9" required>
            </div>
            <div class="col-4 col-md-2">
                <button type="submit" class="btn btn-primary rounded">Salvar</button>
            </div>
        </div>
    </form>
    <?php
}