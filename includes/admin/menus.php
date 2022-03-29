<?php

add_action('admin_menu', 'tc_admin_menu');

function tc_admin_menu()
{
    // add_submenu_page(
    //     'advanced-classifieds-and-directory-pro',
    //     'Shortcode de Paginas',
    //     'Shotcodes',
    //     'manage_acadp_options',
    //     'shotcode-pages',
    //     'tc_menu_main_shortcodes'
    // );
}

function tc_menu_main_shortcodes()
{

    $general_settings = get_option('acadp_general_settings');

    // Tabs
    $tabs = array(
        'getting-started' => __('Getting Started', 'advanced-classifieds-and-directory-pro'),
        'shortcode-builder' => __('Shortcode Builder', 'advanced-classifieds-and-directory-pro'),
        'faq' => __('FAQ', 'advanced-classifieds-and-directory-pro')
    );

    $active_tab = isset($_GET['tab']) ? sanitize_text_field($_GET['tab']) : 'getting-started';
?>

<div id="acadp-dashboard" class="wrap about-wrap full-width-layout acadp-dashboard">
    <h1>
        <?php
        esc_html_e('Advanced Classifieds & Directory Pro', 'advanced-classifieds-and-directory-pro');
        ?>
    </h1>

    <p class="about-text">
        <?php
        esc_html_e('Build any kind of directory site: classifieds, cars, bikes & other vehicles dealers site, pets, real estate portal, yellow pages, etc...', 'advanced-classifieds-and-directory-pro');
        ?>
    </p>

    <div class="wp-badge">
        <?php
        printf(esc_html__('Version %s', 'advanced-classifieds-and-directory-pro'), ACADP_VERSION_NUM);
        ?>
    </div>

    <h2 class="nav-tab-wrapper wp-clearfix">
        <?php
        foreach ($tabs as $tab => $title) {
            $class = ($tab == $active_tab ? 'nav-tab nav-tab-active' : 'nav-tab');
            $title = esc_html($title);


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

    <?php //require_once ACADP_PLUGIN_DIR . "admin/partials/dashboard/{$active_tab}.php";
    ?>
</div>
<?php
}
