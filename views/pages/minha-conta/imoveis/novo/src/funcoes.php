<?php

function bs4t_aba_categorias_2($name, $excluir = [])
{
    $principais = [];
    $options = [];

    $args = array(
        'taxonomy' => 'acadp_categories',
        'hide_empty' => false,
        'update_term_meta_cache' => false,
    );

    $todas_categorias = get_terms($args);

    foreach ($todas_categorias as $categoria) {
        if ($categoria->parent < 1) {
            if ($categoria->term_id == 27) {
                $principais[] =
                    [
                        'id' => $categoria->term_id,
                        'nome' => $categoria->name
                    ];
            }

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
                        'secundario_nome' => $categoria->name
                    ];
            }
        }
    }

    foreach ($options as $option) {
        foreach ($option['secundario'] as $secundario) : ?>
            <label class="w-100 p-1">
                <input type="radio" name="<?= $name ?>" class="acadp-category-listing"
                       value="<?= $secundario['secundario_id'] ?>">
                <?= $secundario['secundario_nome'] ?></label>
        <?php endforeach;
    }
    ?>

    <?php
}
