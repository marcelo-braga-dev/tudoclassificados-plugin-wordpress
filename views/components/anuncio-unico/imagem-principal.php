<div class="row">
    <div class="col-12">
        <div class="card m-0 mb-3 py-2 mt-0">
            <?php
            $images = unserialize($post_meta['images'][0]);

            if (isset($post_meta['images_externa'][0])) {
                $images = unserialize($post_meta['images_externa'][0]);
            }

            if (1 == count($images)) :
                $image_attributes = wp_get_attachment_image_src($images[0], 'large');
                $imagemCarrocel = esc_url($image_attributes[0]);

                $urlExterno = get_post_meta($images[0])['_url_externo'][0];
                if (!empty($urlExterno)) $imagemCarrocel = $urlExterno;
                ?>
                <div class="row justify-content-center">
                    <div class="col-12 mx-auto text-center">
                        <a class="acadp-image-popup" href="<?= $imagemCarrocel ?>">
                            <img src="<?= $imagemCarrocel ?>" style="height:400px; max-width: 100%"/>
                        </a>
                    </div>
                </div>
            <?php else : ?>
                <!-- Slider for -->
                <div class="acadp-slider-for">
                    <?php $i = 0;
                    foreach ($images as $index => $image) : $i++;
                        $image_attributes = wp_get_attachment_image_src($images[$index], 'large');
                        $imagemCarrocel = esc_url($image_attributes[0]);

                        $urlExterno = get_post_meta($images[$index])['_url_externo'][0];
                        if (!empty($urlExterno)) $imagemCarrocel = $urlExterno;
                        ?>
                        <div class="acadp-slider-item">
                            <div class="row justify-content-center">
                                <div class="col-auto">
                                    <img src="<?= $imagemCarrocel ?>"
                                         class="acadp-responsive-item rounded img-principal"
                                         style="height:450px; cursor: zoom-in;<?php if ($i > 1) echo 'display: none' ?>"/>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
                <!-- Slider nav -->
                <div class="acadp-slider-nav" style="margin:5px 15%">
                    <?php
                    $i = 0;
                    foreach ($images as $index => $image) : $i++;
                        $image_attributes = wp_get_attachment_image_src($images[$index]);
                        $imagemCarrocel = esc_url($image_attributes[0]);

                        $urlExterno = get_post_meta($images[$index])['_url_externo'][0];
                        if (!empty($urlExterno)) $imagemCarrocel = $urlExterno;
                        ?>
                        <div class="p-2 img-principal-slider" style="display: none">
                            <picture>
                                <img class="rounded" src="<?= $imagemCarrocel ?>"
                                     style="width: 100px; height:80px; cursor: pointer;"/>
                            </picture>
                        </div>
                    <?php endforeach; ?>
                </div>
            <?php endif; ?>
        </div>
    </div>
</div>

<?php
function tc_anuncio_unico_display_slide_imagem_principal()
{ ?>
    <script>
        $(function () {
            $('.img-principal-slider, .img-principal').css('display', 'block');
        })
    </script>
<?php }

add_action('wp_footer', 'tc_anuncio_unico_display_slide_imagem_principal', 300);