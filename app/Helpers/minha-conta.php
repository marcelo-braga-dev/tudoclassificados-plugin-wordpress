<?php
if (!function_exists('set_menu_minha_conta')) {
    function set_menu_minha_conta($valor = null)
    {
        if (!empty($_GET['menu_minha_conta'])) {
            $_SESSION['menu_minha_conta'] = $_GET['menu_minha_conta'];
        }

        if (!empty($valor)) {
            $_SESSION['menu_minha_conta'] = $valor;
        }

        if ($valor == 'destroy') {
            $_SESSION['menu_minha_conta'] = '';
        }
    }
}

if (!function_exists('get_menu_minha_conta')) {
    function get_menu_minha_conta($valor = null)
    {

        $session = $_SESSION['menu_minha_conta'];

        if (!empty($session) && !empty($valor)) {
            if ($session != $valor) return false;
        }

        return $session;
    }
}

if (!function_exists('todas_categorias')) {
    function todas_categorias($id_produto)
    { ?>
        <div class="col-12">
            <!-- SELECT CATEGORIA -->
            <?php
            $args = array(
                'show_option_none' => 'Selecione a Categoria',
                'option_none_value' => '',
                'taxonomy' => 'acadp_categories',
                'name' => $id_produto,
                'class' => 'form-control acadp-category-listing',
                'required' => false,
            );

            $args['walker'] = new ACADP_Walker_CategoryDropdown;

            echo acadp_dropdown_terms($args, false); //apply_filters('acadp_listing_form_categories_dropdown', acadp_dropdown_terms($args, false), $post_id = '');
            ?>
        </div>
        <?php
    }
}

if (!function_exists('bs4t_select_categorias')) {
    function bs4t_select_categorias($name, $nameCategoria, $disabled = '')
    {
        $excluir = [27, 32];
        $principais = [];
        $options = [];

        $disabled = $disabled ? '' : 'disabled';

        $todas_categorias = get_terms('acadp_categories');

        foreach ($todas_categorias as $categoria) {
            if ($categoria->parent == '') {
                $principais[] =
                    [
                        'id' => $categoria->term_id,
                        'nome' => $categoria->name
                    ];
            }
        }

        foreach ($todas_categorias as $categoria) {
            foreach ($principais as $principal) {
                $options[$principal['id']]['primario_id'] = $principal['id'];
                $options[$principal['id']]['primario_nome'] = $principal['nome'];
                if ($categoria->parent == $principal['id']) {
                    $options[$principal['id']]['secundario'][] =
                        [
                            'secundario_id' => $categoria->term_id,
                            'secundario_nome' => $categoria->name,
                            'descricao' => $categoria->description
                        ];
                }
            }
        }


        echo
            '<select data-placeholder="Selecione a categoria" 
                class="form-control acadp-category-listing selec t2" 
                name="' . $name . '" ' . $disabled . '>';
        echo
        '<option value="">Selecione a categoria</option>';

        foreach ($options as $option) {
            if (!in_array($option['primario_id'], $excluir)) {
                echo
                    '<optgroup class="border" label="' . $option['primario_nome'] . '">';

                foreach ($option['secundario'] as $secundario) {

                    $selected = bs4t_verifica_categoria($nameCategoria, $secundario['descricao']);

                    echo
                        '<option value="' . $secundario['secundario_id'] . '" style="font-size: 14px" ' . $selected . '>' . $secundario['secundario_nome'] . '</option>';
                }
                echo '</optgroup>';
            }
        }
        echo '<select>';
    }
}

if (!function_exists('bs4t_verifica_categoria')) {
    function bs4t_verifica_categoria($texto, $chave)
    {
        $args = explode(',', $chave);

        foreach ($args as $arg) {

            if ($arg != '' && $arg != ' ') {

                $arg = '/' . trim($arg) . '/i';

                if (preg_match($arg, $texto)) {

                    return 'selected';
                }
            }
        }
    }
}
