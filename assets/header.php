<?php
function tc_style_main()
{
    wp_enqueue_style('tc-styles-4', TUDOCLASSIFICADOS_URL_ASSETS . 'bootstrap/css/bootstrap.min.css');
    wp_enqueue_style('tc-styles-9', TUDOCLASSIFICADOS_URL_ASSETS . 'argon/argon.css');
    wp_enqueue_style('tc-styles-1', TUDOCLASSIFICADOS_URL_ASSETS . 'carroucel/slick/slick.css');
    wp_enqueue_style('tc-styles-2', TUDOCLASSIFICADOS_URL_ASSETS . 'carroucel/slick/slick-theme.css');
    wp_enqueue_style('tc-styles-5', TUDOCLASSIFICADOS_URL_ASSETS . 'css/principal.css');
    // wp_enqueue_style('tc-styles-6', TUDOCLASSIFICADOS_URL_ASSETS . 'fonts/open-sans.css');

    //wp_enqueue_script('tc-styles-11', "https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js");
}

add_action('wp_enqueue_scripts', 'tc_style_main');
?>