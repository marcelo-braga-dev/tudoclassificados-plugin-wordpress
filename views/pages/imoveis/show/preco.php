<?php
function MontarLink($texto)
{
    if (!is_string($texto))
        return $texto;

    $er = "/(https:\/\/(www\.|.*?\/)?|http:\/\/(www\.|.*?\/)?|www\.)([a-zA-Z0-9]+|_|-)+(\.(([0-9a-zA-Z]|-|_|\/|\?|=|&)+))+/i";

    $texto = preg_replace_callback($er, function ($match) {
        $link = $match[0];

        //coloca o 'http://' caso o link não o possua
        $link = (stristr($link, "https") === false && stristr($link, "http") === false) ? "https://" . $link : $link;

        //troca "&" por "&", tornando o link válido pela W3C
        $link = str_replace("&", "&amp;", $link);

        return strtolower($link);
    }, $texto);

    return $texto;
}

?>

<div class="card m-0 p-3 mb-4">
    <div class="d-block text-right">
        <?php the_acadp_social_sharing_buttons(); ?>
    </div>
    <div class="d-block m-0">
        <small><?= get_term($category->term_taxonomy_id)->name; ?></small>
        <small>
            <?php if ($post_meta['price'][0]) echo '| Venda'; ?>
            <?php if ($post_meta['preco_aluguel'][0]) echo '| Aluga'; ?>
        </small>
        <span class="d-block titulo-anuncio">
            <?php echo esc_html($post->post_title); ?>
         </span>
    </div>
    <div class="d-block mb-0">
        <?php the_acadp_listing_labels($post_meta); ?>
    </div>
    <?php if (!empty($post_meta['cidade'][0]) && $post_meta['estado'][0]) : ?>
        <div class="d-block">
            <small><?= $post_meta['cidade'][0] . ' - ' . $post_meta['estado'][0] ?></small>
        </div>
    <?php endif; ?>

    <!-- Precos -->
    <div class="d-block my-3">
        <div class="row">
            <div class="col-auto" style="font-size:30px">
                <?php
                $price = acadp_format_amount($post_meta['price'][0]);
                $precoAluguel = acadp_format_amount($post_meta['preco_aluguel'][0]);
                ?>
                <!-- venda -->
                <?php if ($post_meta['price'][0]) : ?>
                    <p class="lead acadp-no-margin font-weight-normal" style="font-size: 22px">
                        <?= esc_html(acadp_currency_filter($price)); ?>
                    </p>
                <?php endif ?>
                <!-- aluga -->
                <?php if ($post_meta['preco_aluguel'][0]) : ?>
                    <p class="lead acadp-no-margin font-weight-normal" style="font-size: 22px">
                        <?= esc_html(acadp_currency_filter($precoAluguel)) . '<small> /mês </small>'; ?>
                    </p>
                <?php endif ?>
            </div>
            <div class="col-1 align-self-center" style="font-size:24px">
                <span id="" class="acadp-favourites"><?php the_acadp_favourites_link(); ?></span>
            </div>
        </div>
    </div>

    <!-- SITE EXTERNO -->
    <?php if ($post_meta['website'][0]) : ?>
        <a href="<?= MontarLink($post_meta['website'][0]) ?>" target="_blank" style="text-decoration:none;">
            <div class="row rounded align-items-center mx-2 mb-4 text-center btn-info">
                <div class="col-2 p-2 m-0 rounded-left text-white" style="background: rgba(0,0,0,0.1);">
                    <i class="fas fa-external-link" style="font-size: 24px;"></i>
                </div>
                <div class="col-10 rounded-right text-white text-truncate">
                    <span style="font-size: 16px;">VISITAR SITE DO ANÚNCIO</span>
                </div>
            </div>
        </a>
    <?php endif; ?>


    <div class="d-block mb-2">
        <small>
            Anunciado
            por <?php echo '<a href="' . esc_url(acadp_get_user_page_link($post->post_author)) . '" style="color: #1e4b75">' . get_the_author() . '</a>'; ?>
        </small>
    </div>
</div>