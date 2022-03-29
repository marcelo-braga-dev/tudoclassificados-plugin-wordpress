<?php

/**
 * Plugin Dashboard.
 *
 * @link    http://pluginsware.com
 * @since   1.7.3
 *
 * @package Advanced_Classifieds_And_Directory_Pro
 */
?>

<div id="acadp-dashboard" class="wrap about-wrap full-width-layout acadp-dashboard">
    <h1>Tudo Classificados</h1>

    <h2 class="nav-tab-wrapper wp-clearfix">
        <?php
        foreach ($tabs as $tab => $title) {
            $class = ($tab == $active_tab ? 'nav-tab nav-tab-active' : 'nav-tab');
            $title = esc_html($title);

            if ('issues' == $tab) {
                $class .= ' acadp-text-error';
                $title .= sprintf(' <span class="count">(%d)</span>', count($issues['found']));
            }

            $url = admin_url(add_query_arg('tab', $tab, 'admin.php?page=advanced-classifieds-and-directory-pro'));
            printf(
                '<a href="%s" class="%s">%s</a>',
                esc_url($url),
                $class,
                $title
            );
        }
        ?>
    </h2>

    <?php
    require_once ACADP_PLUGIN_DIR . "admin/partials/dashboard/{$active_tab}.php";
    ?>
</div>