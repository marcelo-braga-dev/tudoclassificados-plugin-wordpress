<?php
$current_user = wp_get_current_user();
$email = $current_user->user_email;

include_once 'src/funcoes.php';

$premium_imoveis = bs4t_user_is_premium('imoveis');
$user_meta = get_user_meta(get_current_user_id());
?>
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header bg-white">
                <div class="row justify-content-between align-items-center px-3">
                    <div>
                        <h3 class="mb-0">Cadastrar novo anúncio de imóvel</h3>
                    </div>
                    <div>
                        <div class="icon icon-shape bg-primary text-white rounded-circle shadow">
                            <i class="fas fa-dollar-sign"></i>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <form action="<?= esc_url(acadp_get_listing_form_page_link()); ?>" method="post">
                    <div class="row">
                        <div class="col-12">
                            <!-- TÍTULO DO ANÚNCIO -->
                            <div class="card mb-3 w-100">
                                <div class="card-body">
                                    <div class="form-group bmd-form-group">
                                        <label class="bmd-label-static">Título do Anúncio</label>
                                        <input type="text" class="form-control" name="title" id="acadp-title"
                                               value="<?php if ($post_id > 0) echo esc_attr($post->post_title); ?>"
                                               required/>
                                    </div>
                                </div>
                            </div>

                            <!-- Categoria -->
                            <div class="card mb-3 w-100">
                                <div class="card-body">
                                    <h5>Categoria do Anúncio</h5>
                                    <?php bs4t_aba_categorias_2('acadp_category') ?>
                                </div>
                            </div>

                            <!-- DESCRICAO DO ANÚNCIO -->
                            <div class="card mb-3 w-100">
                                <div class="card-body">
                                    <h6>Descrição do Anúncio</h6>
                                    <!-- init custon filelds-->
                                    <div class="form-row" id="acadp-custom-fields-listings"
                                         data-post_id="<?= esc_attr($post_id); ?>">
                                        <?php do_action('wp_ajax_acadp_public_custom_fields_listings', $post_id); ?>
                                    </div>

                                    <div class="form-group pt-0">
                                        <span>Descrição</span>

                                        <?php
                                        $post_content = ($post_id > 0) ? $post->post_content : '';

                                        $post_content = strip_tags(preg_replace('/\<br\>|\<\/p\>/', "\n", $post_content));

                                        if (is_admin()) {
                                            $editor = 'textarea';
                                        }

                                        if ('textarea' == $editor) {
                                            printf('<textarea name="%s" class="form-control" rows="13" placeholder="Insira a descrição do anúncio aqui..." required>%s</textarea>', 'description', esc_textarea($post_content));
                                        } else {
                                            wp_editor(
                                                wp_kses_post($post_content),
                                                'description',
                                                array(
                                                    'media_buttons' => false,
                                                    'quicktags' => true,
                                                    'editor_height' => 200
                                                )
                                            );
                                        }
                                        ?>
                                    </div>
                                </div>
                            </div>

                            <!-- PRECO -->
                            <div class="card mb-3 w-100">
                                <div class="card-body">
                                    <div class="form-row">
                                        <div class="col-md-3 mx-4">
                                            <label for="acadp-price">Preço</label>
                                            <div class="input-group mb-2">
                                                <div class="input-group-prepend">
                                                    <div class="input-group-text">R$</div>
                                                </div>
                                                <input type="text" class="form-control" data-type="currency"
                                                       step="0.01" name="price" id="acadp-price" placeholder="0,00"
                                                       style="text-align:right"
                                                       value="<?php if (isset($post_meta['price'])) echo esc_attr(str_replace('.', ',', $post_meta['price'][0])); ?>"
                                                       required/>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <label>Estado</label>
                                            <select name="estado" id="estados2"
                                                    class="form-control select2 estados-imoveis"
                                                    required></select>
                                        </div>

                                        <div class="col-md-4">
                                            <label for="cidades">Cidade</label>
                                            <select name="cidade" id="cidades2"
                                                    class="form-control select2 cidades-imoveis"
                                                    required></select>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- IMAGENS -->
                            <div class="row w-100">
                                <div class="col-12">
                                    <div class="card mb-3 d-block">
                                        <div class="card-body">
                                            <?php if ($can_add_images) : ?>
                                                <!-- Images -->
                                                <div class="panel panel-default">
                                                    <div class="panel-heading bg-white"><?php esc_html_e('Images', 'advanced-classifieds-and-directory-pro'); ?></div>

                                                    <div class="panel-body bg-white">
                                                        <?php if ($images_limit > 0) : ?>
                                                            <p class="help-block">
                                                                <strong>Observações:</strong>:
                                                                <?php printf(esc_html__('You can upload up to %d images', 'advanced-classifieds-and-directory-pro'), $images_limit); ?>
                                                            </p>
                                                        <?php endif; ?>

                                                        <table class="acadp-images bg-white" id="acadp-images-imoveis"
                                                               data-exist="true">
                                                            <tbody>
                                                            <?php
                                                            $disable_image_upload_attr = '';

                                                            if (isset($post_meta['images'])) {
                                                                $images = unserialize($post_meta['images'][0]);
                                                                foreach ($images as $index => $image) {
                                                                    $image_attributes = wp_get_attachment_image_src($images[$index]);

                                                                    if (isset($image_attributes[0])) {
                                                                        echo '<tr class="acadp-image-row">' .
                                                                            '<td class="acadp-handle"><span class="glyphicon glyphicon-th-large"><i class="bi bi-chevron-bar-expand"></i></span></td>' .
                                                                            '<td class="acadp-image">' .
                                                                            '<img src="' . esc_url($image_attributes[0]) . '" />' .
                                                                            '<input type="hidden" class="acadp-image-field-imoveis" name="images[]" value="' . esc_attr($images[$index]) . '" required />' .
                                                                            '</td>' .
                                                                            '<td>' .
                                                                            '<span class="acadp-image-url">' . esc_html($image_attributes[0]) . '</span><br />' .
                                                                            '<a href="javascript:void(0);" class="acadp-delete-image" data-attachment_id="' . esc_attr($images[$index]) . '">' . esc_html__('Delete Permanently', 'advanced-classifieds-and-directory-pro') . '</a>' .
                                                                            '</td>' .
                                                                            '</tr>';
                                                                    }
                                                                }
                                                                if (count($images) >= $images_limit) {
                                                                    $disable_image_upload_attr = ' disabled';
                                                                }
                                                            }
                                                            ?>
                                                            </tbody>
                                                        </table>
                                                        <div id="acadp-progress-image-upload-imoveis"></div>
                                                        <a href="javascript:void(0);" class="btn btn-primary"
                                                           id="acadp-upload-image-imoveis"
                                                           data-limit="<?= esc_attr($images_limit); ?>" <?= $disable_image_upload_attr; ?>>
                                                            <?php esc_html_e('Upload Image', 'advanced-classifieds-and-directory-pro'); ?>
                                                        </a>
                                                    </div>
                                                </div>
                                            <?php endif; ?>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Contato -->
                            <div class="row w-100">
                                <div class="col-12">
                                    <!-- Contato -->
                                    <div class="card mb-3">
                                        <div class="card-body">
                                            <div class="row">
                                                <h6 class="col-12">Contato</h6>
                                                <div class="col-md-6">
                                                    <div class="form-group bmd-form-group">
                                                        <label for="acadp-phone"><small>Whatsapp para contato com
                                                                clientes</small></label>
                                                        <input type="text" name="phone" id="acadp-phone"
                                                               class="form-control" placeholder="(00) 0 0000-0000"
                                                               data-mask="(00) 0 0000-0000"
                                                               value="<?= isset($post_meta['phone']) ? esc_attr($post_meta['phone'][0]) : get_user_meta(get_current_user_id(), 'celular')[0] ?>"
                                                               required/>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group bmd-form-group">
                                                        <label class="control-label"
                                                               for="acadp-email"><small>E-mail</small></label>
                                                        <input type="email" name="email" id="acadp-email"
                                                               class="form-control" value="<?= esc_attr($email); ?>"
                                                               required/>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Video -->
                            <div class="card mb-3 w-100">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group bmd-form-group">
                                                <label class="bmd-label-static"><small>Vídeo</small></label>
                                                <input type="text" name="video" id="acadp-video"
                                                       class="form-control" placeholder="Somente Vídeos do YouTube"
                                                       value="<?php if (isset($post_meta['video'])) echo esc_attr($post_meta['video'][0]); ?>"/>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group bmd-form-group">
                                                <label class="control-label" for="acadp-website">
                                                    <small>Link do Site de Venda</small>
                                                </label>
                                                <input type="text" name="website" id="acadp-website"
                                                       class="form-control" placeholder="https://"
                                                       value="<?php if (isset($post_meta['website'])) echo esc_attr($post_meta['website'][0]); ?>"/>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- MAPA -->
                            <div class="card mb-3 w-100">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-12">
                                            <div class="form-check">
                                                <label class="form-check-label">
                                                    <input type="checkbox" class="form-check-input" name="hide_map"
                                                           value="1" <?php if (isset($post_meta['hide_map'])) checked($post_meta['hide_map'][0], 1); ?>>
                                                    Não inserir mapa no anúncio.
                                                    <span class="form-check-sign">
										<span class="check"></span>
									</span>
                                                </label>
                                            </div>
                                            <div class="acadp-map embed-responsive embed-responsive-16by9 bg-white"
                                                 data-type="form">
                                                <?php
                                                $latitude = isset($post_meta['latitude']) ? esc_attr($post_meta['latitude'][0]) : '-16.46769474828896';
                                                $longitude = isset($post_meta['longitude']) ? esc_attr($post_meta['longitude'][0]) : '-36.826171875';
                                                ?>
                                                <div class="marker" data-latitude="<?= $latitude; ?>"
                                                     data-longitude="<?= $longitude; ?>"></div>
                                            </div>
                                            <input type="hidden" id="acadp-default-location"
                                                   value="<?= esc_attr($default_location); ?>"/>
                                            <input type="hidden" id="acadp-latitude" name="latitude"
                                                   value="<?= $latitude; ?>"/>
                                            <input type="hidden" id="acadp-longitude" name="longitude"
                                                   value="<?= $longitude; ?>"/>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Display errors -->
                            <div class="row alert alert-danger" id="alerta-erros" style="display: none;">
                                <div class="col-auto align-items-center">
                                    <h4><i class="bi bi-exclamation-diamond" style="font-size: 22px;"></i></h4>
                                </div>
                                <div class="col-auto align-items-center" id="mensagem-erro">
                                    <span><b>Anúncio não publicado por falta de imagens.</b></span><br>
                                    <small class="text-white">Insira imagens nesse anúncio, clicando no botão
                                        editar.</small>
                                </div>
                            </div>

                            <!-- BOTOES -->
                            <div class="card w-100">
                                <div class="card-body">
                                    <div class="row justify-content-center">
                                        <div class="panel-body bg-white">
                                            <?php if ($mark_as_sold) : ?>
                                                <div class="checkbox">
                                                    <label>
                                                        <input type="checkbox" name="sold"
                                                               value="1" <?php if (isset($post_meta['sold'])) checked($post_meta['sold'][0], 1); ?>>
                                                        <?php esc_html_e("Mark as", 'advanced-classifieds-and-directory-pro'); ?>
                                                        &nbsp;
                                                        <strong><?= esc_html($general_settings['sold_listing_label']); ?></strong>
                                                    </label>
                                                </div>
                                            <?php endif; ?>

                                            <?= the_acadp_terms_of_agreement(); ?>

                                            <?php if ($post_id == 0) : ?>
                                                <div id="acadp-listing-g-recaptcha"></div>
                                                <div id="acadp-listing-g-recaptcha-message"
                                                     class="help-block text-danger"></div>
                                            <?php endif; ?>

                                            <?php wp_nonce_field('acadp_save_listing', 'acadp_listing_nonce'); ?>
                                            <input type="hidden" name="post_type" value="acadp_listings"/>

                                            <?php /*if ($has_draft) : ?>
						<input type="submit" name="action" class="btn btn-default acadp-listing-form-submit-btn" value="<?php esc_html_e('Save Draft', 'advanced-classifieds-and-directory-pro'); ?>" />
					<?php endif;*/ ?>

                                            <?php if ($post_id > 0) : ?>
                                                <input type="hidden" name="post_id" id="post_id"
                                                       value="<?= esc_attr($post_id); ?>"/>
                                                <!-- <a href="< ?= esc_url(get_permalink($post_id)); ?>" class="btn btn-default" target="_blank"><?php esc_html_e('Preview', 'advanced-classifieds-and-directory-pro'); ?></a> -->
                                            <?php endif; ?>

                                            <?php if ($has_draft) { ?>
                                                <input type="submit" name="action" id="id-avancar"
                                                       class="btn btn-primary pull-right acadp-listing-form-submit-btn"
                                                       value="Publicar Anúncio"/>
                                            <?php } else { ?>
                                                <input type="submit" name="action" id="id-avancar"
                                                       class="btn btn-primary pull-right acadp-listing-form-submit-btn btn-lg"
                                                       value="<?php esc_html_e('Save Changes', 'advanced-classifieds-and-directory-pro'); ?>"/>
                                            <?php } ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <input type="hidden" name="tipo-anuncio" value="imoveis">
                </form>
                <!-- CARREGA IMAGENS -->
                <form id="acadp-form-upload-imoveis" class="hidden" method="post" action="#"
                      enctype="multipart/form-data">
                    <input type="file" multiple name="acadp_image[]" id="acadp-upload-image-hidden-imoveis"
                           style="display: none;"/>
                    <input type="hidden" name="action" value="acadp_public_image_upload"/>
                    <?php wp_nonce_field('acadp_upload_images', 'acadp_images_nonce'); ?>
                </form>

                <div class="acadp acadp-user acadp-post-form"></div>

                <!-- Hook for developers to add new fields -->
                <?php do_action('acadp_listing_form_fields'); ?>
            </div>
        </div>
    </div>
</div>



