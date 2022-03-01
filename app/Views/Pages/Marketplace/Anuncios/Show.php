<?php

namespace TudoClassificados\App\Views\Pages\Marketplace\Anuncios;

use TudoClassificados\App\Views\Components\AnuncioUnico\ImagemPrincipal;
use WP_Query;

class Show
{
    public function index($post, $content)
    {
        acadp_update_listing_views_count($post->ID);

        $general_settings = get_option('acadp_general_settings');
        $recaptcha_settings = get_option('acadp_recaptcha_settings');
        $registration_settings = get_option('acadp_registration_settings');

        $post_meta = get_post_meta($post->ID);

        $description = $content;

        $can_show_date = isset($general_settings['display_options']) && in_array('date', $general_settings['display_options']) ? true : false;
        $can_show_user = isset($general_settings['display_options']) && in_array('user', $general_settings['display_options']) ? true : false;
        $can_show_views = isset($general_settings['display_options']) && in_array('views', $general_settings['display_options']) ? true : false;
        $can_show_contact_form = empty($general_settings['has_contact_form']) ? false : true;
        $can_add_favourites = empty($general_settings['has_favourites']) ? false : true;
        $can_report_abuse = empty($general_settings['has_report_abuse']) ? false : true;
        $has_widgets = acadp_has_active_listing_widgets();
        $has_sidebar = !$has_widgets;

        // $login_url
        $current_page_url = get_permalink();
        $login_url = acadp_get_user_login_page_link($current_page_url);

        // $location
        $has_location = empty($general_settings['has_location']) ? false : true;
        $can_show_location = false;

        if ($has_location) {
            $location = wp_get_object_terms($post->ID, 'acadp_locations');

            if (!empty($location)) {
                $location = $location[0];
                $can_show_location = true;
            }
        }

        // $category
        $has_category = false;
        $can_show_category = isset($general_settings['display_options']) && in_array('category', $general_settings['display_options']) ? true : false;
        $can_show_category_desc = isset($general_settings['display_options']) && in_array('category_desc', $general_settings['display_options']) ? true : false;
        $categories = wp_get_object_terms($post->ID, 'acadp_categories');

        if (empty($categories)) {
            $can_show_category = false;
        } else {
            $category = $categories[0];
            $has_category = true;
        }

        // $can_show_video
        $has_video = empty($general_settings['has_video']) ? false : true;
        $can_show_video = false;
        $video_url = '';

        if ($has_video) {
            if (!empty($post_meta['video'][0])) {
                $video_url = acadp_parse_videos($post_meta['video'][0]);
                $can_show_video = empty($video_url) ? false : true;
            }
        }

        // $can_show_map
        $has_map = !empty($general_settings['has_map']) && empty($post_meta['hide_map'][0]) ? true : false;

        // Get custom fields
        $fields = array();
        $category_ids = array();

        foreach ($categories as $category) {
            $category_ids[] = $category->term_id;
        }

        $custom_field_ids = acadp_get_custom_field_ids($category_ids);

        if (!empty($custom_field_ids)) {
            $args = array(
                'post_type' => 'acadp_fields',
                'post_status' => 'publish',
                'posts_per_page' => 500,
                'post__in' => $custom_field_ids,
                'no_found_rows' => true,
                'update_post_term_cache' => false,
                'meta_key' => 'order',
                'orderby' => 'meta_value_num',
                'order' => 'ASC'
            );

            $acadp_query = new WP_Query($args);

            if ($acadp_query->have_posts()) {
                $fields = $acadp_query->posts;
            }
        }

        $imagensPrincipal = new ImagemPrincipal();

        // Process output
        ob_start();
        include_once TUDOCLASSIFICADOS_PATH_VIEW . 'pages/marketplace/show/index.php';
        return ob_get_clean();
    }
}