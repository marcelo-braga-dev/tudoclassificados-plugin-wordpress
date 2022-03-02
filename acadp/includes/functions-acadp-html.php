<?php

/**
 * HTML outputs.
 *
 * @link    https://pluginsware.com
 * @since   1.0.0
 *
 * @package Advanced_Classifieds_And_Directory_Pro
 */

// Exit if accessed directly
if (!defined('WPINC')) {
    die;
}

/**
 * Display user menu links.
 *
 * @since 1.0.0
 */
function the_acadp_user_menu()
{
    $listing_settings = get_option('acadp_listing_settings');
    $registration_settings = get_option('acadp_registration_settings');
    $page_settings = get_option('acadp_page_settings');
    /*
    $links = array();

    if (acadp_current_user_can('edit_acadp_listings') && $page_settings['listing_form'] > 0) {
        $links[] = '<a href="' . esc_url(get_permalink($page_settings['listing_form'])) . '">' . __('Add New Listing', 'advanced-classifieds-and-directory-pro') . '</a>';
    }

    if (acadp_current_user_can('edit_acadp_listings') && $page_settings['manage_listings'] > 0) {
        $links[] = '<a href="' . esc_url(get_permalink($page_settings['manage_listings'])) . '">' . esc_html(get_the_title($page_settings['manage_listings'])) . '</a>';
    }

    if (!empty($listing_settings['has_favourites']) && $page_settings['favourite_listings'] > 0) {
        $links[] = '<a href="' . esc_url(get_permalink($page_settings['favourite_listings'])) . '">' . esc_html(get_the_title($page_settings['favourite_listings'])) . '</a>';
    }

    if (acadp_current_user_can('edit_acadp_listings') && $page_settings['payment_history'] > 0) {
        $links[] = '<a href="' . esc_url(get_permalink($page_settings['payment_history'])) . '">' . esc_html(get_the_title($page_settings['payment_history'])) . '</a>';
    }

    if (!empty($registration_settings['engine']) && 'acadp' == $registration_settings['engine'] && $page_settings['user_account'] > 0) {
        $links[] = '<a href="' . esc_url(get_permalink($page_settings['user_account'])) . '">' . __('User Account', 'advanced-classifieds-and-directory-pro') . '</a>';
    }

    echo '<p class="acadp-no-margin">' . implode(' | ', $links) . '</p>';*/
}

/**
 * Adds "Terms of Agreement" content to the listing form.
 *
 * @since 1.0.0
 */
function the_acadp_terms_of_agreement()
{
    $tos_settings = get_option('acadp_terms_of_agreement');

    if (!empty($tos_settings['show_agree_to_terms']) && !empty($tos_settings['agree_text'])) {
        $agree_text = trim($tos_settings['agree_text']);
        $agree_type = filter_var($agree_text, FILTER_VALIDATE_URL) ? 'url' : 'txt';
        $agree_label = !empty($tos_settings['agree_label']) ? trim($tos_settings['agree_label']) : __('I agree to the terms and conditions', 'advanced-classifieds-and-directory-pro');

        $label = ('url' == $agree_type) ? sprintf('<a href="%s" target="_blank">%s</a>', $agree_text, $agree_label) : $agree_label;
        $text = ('txt' == $agree_type) ? nl2br($agree_text) : '';

        printf('<div class="form-group"><div class="checkbox"><label><input type="checkbox" name="terms_of_agreement" required />%s</label></div>%s</div>', $label, $text);
    }
}

/**
 * Display Social Sharing Buttons.
 *
 * @since 1.0.0
 */
function the_acadp_social_sharing_buttons()
{
    global $post;

    if (!isset($post)) return;

    $page_settings = get_option('acadp_page_settings');
    $socialshare_settings = get_option('acadp_socialshare_settings');

    $page = 'none';

    if ('acadp_listings' == $post->post_type) {
        $page = 'listing';
    }

    if ($post->ID == $page_settings['locations']) {
        $page = 'locations';
    }

    if ($post->ID == $page_settings['categories']) {
        $page = 'categories';
    }

    if (in_array($post->ID, array($page_settings['listings'], $page_settings['location'], $page_settings['category'], $page_settings['search']))) {
        $page = 'listings';
    }

    if (isset($socialshare_settings['pages']) && in_array($page, $socialshare_settings['pages'])) {
        // Get current page URL
        $url = acadp_get_current_url();

        // Get current page title
        $title = esc_html($post->post_title);

        if ($post->ID == $page_settings['location']) {
            if ($slug = get_query_var('acadp_location')) {
                $term = get_term_by('slug', $slug, 'acadp_locations');
                $title = $term->name;
            }
        }

        if ($post->ID == $page_settings['category']) {
            if ($slug = get_query_var('acadp_category')) {
                $term = get_term_by('slug', $slug, 'acadp_categories');
                $title = $term->name;
            }
        }

        if ($post->ID == $page_settings['user_listings']) {
            if ($slug = acadp_get_user_slug()) {
                $user = get_user_by('slug', $slug);
                $title = $user->display_name;
            }
        }

        $title = str_replace(' ', '%20', $title);

        // Get Post Thumbnail
        $thumbnail = '';

        if ('listing' == $page) {
            $images = get_post_meta($post->ID, 'images', true);

            if (!empty($images)) {
                $image_attributes = wp_get_attachment_image_src($images[0], 'full');
                $thumbnail = is_array($image_attributes) ? $image_attributes[0] : '';
            }
        } else {
            $image_attributes = wp_get_attachment_image_src(get_post_thumbnail_id($post->ID), 'full');
            $thumbnail = is_array($image_attributes) ? $image_attributes[0] : '';
        }

        // Construct sharing buttons
        $buttons = array();

        if (isset($socialshare_settings['services'])) {
            if (in_array('facebook', $socialshare_settings['services'])) {
                $facebookURL = 'https://www.facebook.com/sharer/sharer.php?u=' . $url;
                $buttons[] = '<a class="" href="' . $facebookURL . '" target="_blank"><i class="fab fa-facebook" style="color: #2d4372;"></i></a>';
            }

            if (in_array('twitter', $socialshare_settings['services'])) {
                $twitterURL = 'https://twitter.com/intent/tweet?text=' . $title . '&amp;url=' . $url;
                $buttons[] = '<a class="" href="' . $twitterURL . '" target="_blank"><i class="bi bi-twitter"></i></a>';
            }

            if (in_array('linkedin', $socialshare_settings['services'])) {
                $linkedinURL = 'https://www.linkedin.com/shareArticle?url=' . $url . '&amp;title=' . $title;
                $buttons[] = '<a class="" href="' . $linkedinURL . '" target="_blank"><i class="fab fa-twitter"></i></a>';
            }

            if (in_array('pinterest', $socialshare_settings['services'])) {
                $pinterestURL = 'https://pinterest.com/pin/create/button/?url=' . $url . '&amp;media=' . $thumbnail . '&amp;description=' . $title;
                $buttons[] = '<a class="acadp-social-link acadp-social-pinterest" href="' . $pinterestURL . '" target="_blank" style="border-radius:5px">' . __('Pin It', 'advanced-classifieds-and-directory-pro') . '</a>';
            }

            if (in_array('whatsapp', $socialshare_settings['services'])) {
                $whatsappURL = 'https://api.whatsapp.com/send?text=' . $title . '&nbsp;' . $url;
                $buttons[] = '<a class="" href="' . $whatsappURL . '" target="_blank" data-text="' . $title . '" data-link="' . $url . '" style="border-radius:5px"><i class="fab fa-whatsapp" style="color: #12af0a;"></i></a>';
            }
        }

        if (count($buttons)) {
            echo '<small class="text-muted">Compartilhe:</small> ' . implode(' | ', $buttons);
        }
    }
}

/**
 * Display the listing entry classes.
 *
 * @param array $post_meta Post Meta.
 * @param string $class CSS Class Names.
 * @since 1.5.5
 */
function the_acadp_listing_entry_class($post_meta, $class = '')
{
    $class .= ' acadp-entry';

    if (isset($post_meta['featured']) && 1 == (int)$post_meta['featured'][0]) {
        $class .= ' acadp-entry-featured';
    }

    printf('class="%s"', trim($class));
}

/**
 * Display the listing thumbnail.
 *
 * @param array $post_meta Post Meta.
 * @since 1.0.0
 */
function the_acadp_listing_thumbnail($post_meta)
{
    $image = '';

    if (isset($post_meta['images'])) {
        $images = unserialize($post_meta['images'][0]);
        $image_attributes = wp_get_attachment_image_src($images[0], 'medium');
        $image = $image_attributes[0];
    }

    if (isset($post_meta['images_externa'])) {
        $images = unserialize($post_meta['images_externa'][0]);
        $image_attributes = wp_get_attachment_image_src($images[0], 'medium');
        $image = $image_attributes[0];
    }

    $url_externo = get_post_meta($images[0], '_url_externo');
    if (!empty($url_externo) && !$image) {
        $image = $url_externo[0];
    }

    if (!$image) {
        $image = apply_filters('acadp_no_image_file_path', TUDOCLASSIFICADOS_URL_ASSETS . 'imagens/sem-foto.jpg');
    }

    echo $image;
}

/**
 * Display the listing labels.
 *
 * @param array $post_meta Post Meta.
 * @since 1.0.0
 */
function the_acadp_listing_labels($post_meta)
{
    global $post;

    $badges_settings = get_option('acadp_badges_settings');
    $featured_listing_settings = get_option('acadp_featured_listing_settings');

    if (isset($post_meta['frete_gratis']) && $post_meta['frete_gratis'][0] == 'S') {
        echo '<small class="text-info emblema-status pl-2">Frete Grátis</small>&nbsp;';
        $has_badge = 1;
    }

    if (!empty($featured_listing_settings['show_featured_tag'])) {
        if (isset($post_meta['featured']) && 1 == (int)$post_meta['featured'][0]) {
            echo '<small class="text-primary emblema-status pl-2">' . $featured_listing_settings['label'] . '</small>&nbsp;';
            $has_badge = 1;
        }
    }

    if (!empty($badges_settings['show_new_tag'])) {
        $each_hours = 60 * 60 * 24; // seconds in a day
        $s_date1 = strtotime(current_time('mysql')); // seconds for date 1
        $s_date2 = strtotime($post->post_date); // seconds for date 2
        $s_date_diff = abs($s_date1 - $s_date2); // different of the two dates in seconds
        $days = round($s_date_diff / $each_hours); // divided the different with second in a day

        if ($days <= (int)$badges_settings['new_listing_threshold']) {
            echo '<small class="text-primary emblema-status pl-2">' . $badges_settings['new_listing_label'] . '</small>&nbsp;';
            $has_badge = 1;
        }
    }

    if (!empty($badges_settings['show_popular_tag'])) {
        if (isset($post_meta['views']) && (int)$post_meta['views'][0] >= (int)$badges_settings['popular_listing_threshold']) {
            echo '<small class="emblema-status text-success pl-2" style="font-size: 11px">' . $badges_settings['popular_listing_label'] . '</small>&nbsp;';
            $has_badge = 1;
        }
    }

    if (!empty($badges_settings['mark_as_sold'])) {
        if (isset($post_meta['sold']) && 1 == (int)$post_meta['sold'][0]) {
            echo '<small class="text-danger emblema-status pl-2">' . $badges_settings['sold_listing_label'] . '</small>&nbsp;';
            $has_badge = 1;
        }
    }

    if (!$has_badge) echo '&nbsp;';
}

/**
 * Display the listing address.
 *
 * @param array $post_meta Post Meta.
 * @param int $term_id Custom Taxonomy term ID.
 * @since 1.0.0
 */
function the_acadp_address($post_meta, $term_id)
{
    $listing_settings = get_option('acadp_listing_settings');

    // Get all the location term ids
    $locations = array($term_id);
    $ancestors = get_ancestors($term_id, 'acadp_locations');

    $locations = array_merge($locations, $ancestors);

    // Build address vars
    echo '<p class="acadp-address">';

    if (!empty($post_meta['address'][0])) {
        echo '<span class="acadp-street-address">' . $post_meta['address'][0] . '</span>';
    }

    $pieces = array();

    $country = end($locations);

    if (count($locations) > 1) {
        array_pop($locations);

        foreach ($locations as $region) {
            $term = get_term($region, 'acadp_locations');
            if (!empty($term) && !is_wp_error($term)) {
                $pieces[] = '<span class="acadp-locality"><a href="' . esc_url(acadp_get_location_page_link($term)) . '">' . $term->name . '</a></span>';
            }
        }
    }

    $term = get_term($country, 'acadp_locations');
    if (!empty($term) && !is_wp_error($term)) {
        $pieces[] = '<span class="acadp-country-name"><a href="' . esc_url(acadp_get_location_page_link($term)) . '">' . $term->name . '</a></span>';
    }

    if (!empty($post_meta['zipcode'][0])) {
        $pieces[] = $post_meta['zipcode'][0];
    }

    echo implode('<span class="acadp-delimiter">,</span>', $pieces);

    if ('never' != $listing_settings['show_phone_number'] && !empty($post_meta['phone'][0])) {
        echo '<span class="acadp-phone">';
        echo '<span class="glyphicon glyphicon-earphone"></span>&nbsp;';
        if ('open' == $listing_settings['show_phone_number']) {
            echo '<span class="acadp-phone-number"><a href="tel:' . $post_meta['phone'][0] . '">' . $post_meta['phone'][0] . '</a></span>';
        } else {
            echo '<span><a class="acadp-show-phone-number" href="javascript: void(0);">' . __('Show Phone Number', 'advanced-classifieds-and-directory-pro') . '</a></span>';
            echo '<span class="acadp-phone-number" style="display: none;"><a href="tel:' . $post_meta['phone'][0] . '">' . $post_meta['phone'][0] . '</a></span>';
        }
        echo '</span>';
    }

    if ('never' != $listing_settings['show_email_address'] && !empty($post_meta['email'][0])) {
        if ('public' == $listing_settings['show_email_address'] || is_user_logged_in()) {
            echo '<span class="acadp-email"><span class="glyphicon glyphicon-envelope"></span>&nbsp;<a href="mailto:' . $post_meta['email'][0] . '">' . $post_meta['email'][0] . '</a></span>';
        } else {
            echo '<span class="acadp-email"><span class="glyphicon glyphicon-envelope"></span>&nbsp;*****</span>';
        }
    }

    if (!empty($post_meta['website'][0])) {
        echo '<span class="acadp-website"><span class="glyphicon glyphicon-globe"></span>&nbsp;<a href="' . $post_meta['website'][0] . '" target="_blank">' . $post_meta['website'][0] . '</a></span>';
    }

    echo '</p>';
}

/**
 * Get activated payment gateways.
 *
 * @since 1.0.0
 */
function the_acadp_payment_gateways()
{
    $gateways = acadp_get_payment_gateways();
    $settings = get_option('acadp_gateway_settings');

    $list = array();

    if (isset($settings['gateways'])) {
        foreach ($gateways as $key => $label) {
            if (in_array($key, $settings['gateways'])) {
                $gateway_settings = get_option('acadp_gateway_' . $key . '_settings');
                $label = !empty($gateway_settings['label']) ? $gateway_settings['label'] : $label;

                $html = '<li class="list-group-item acadp-no-margin-left">';
                $html .= sprintf('<div class="radio acadp-no-margin"><label><input type="radio" name="payment_gateway" value="%s"%s>%s</label></div>', $key, ($key == end($settings['gateways']) ? ' checked' : ''), $label);

                if (!empty($gateway_settings['description'])) {
                    $html .= '<p class="text-muted acadp-no-margin">' . $gateway_settings['description'] . '</p>';
                }

                $html .= '</li>';

                $list[] = $html;
            }
        }
    }

    if (count($list)) {
        echo '<ul class="list-group">' . implode("\n", $list) . '</ul>';
    }
}

/**
 * Get instructions to do offline payment.
 *
 * @since 1.0.0
 */
function the_acadp_offline_payment_instructions()
{
    $settings = get_option('acadp_gateway_offline_settings');
    echo '<p>' . nl2br($settings['instructions']) . '</p>';
}

/**
 * Retrieve paginated link for listing pages.
 *
 * @param int $numpages The total amount of pages.
 * @param int $pagerange How many numbers to either side of current page.
 * @param int $paged The current page number.
 * @since 1.5.4
 */
function the_acadp_pagination($numpages = '', $pagerange = '', $paged = '')
{
    if (empty($pagerange)) {
        $pagerange = 1;
    }

    /**
     * This first part of our function is a fallback
     * for custom pagination inside a regular loop that
     * uses the global $paged and global $wp_query variables.
     *
     * It's good because we can now override default pagination
     * in our theme, and use this function in default quries
     * and custom queries.
     */
    if (empty($paged)) {
        $paged = acadp_get_page_number();
    }

    if ('' == $numpages) {
        global $wp_query;

        $numpages = $wp_query->max_num_pages;
        if (!$numpages) {
            $numpages = 1;
        }
    }

    /**
     * We construct the pagination arguments to enter into our paginate_links
     * function.
     */
    $arr_params = array('order', 'sort', 'view', 'lang', 'renew', 'cidade', 'estado');

    $base = acadp_remove_query_arg($arr_params, get_pagenum_link(1));

    if (!get_option('permalink_structure') || isset($_GET['q'])) {
        $prefix = strpos($base, '?') ? '&' : '?';
        $format = $prefix . 'paged=%#%';
    } else {
        $prefix = ('/' == substr($base, -1)) ? '' : '/';
        $format = $prefix . 'page/%#%';
    }

    $pagination_args = array(
        'base' => $base . '%_%',
        'format' => $format,
        'total' => $numpages,
        'current' => $paged,
        'show_all' => false,
        'end_size' => 1,
        'mid_size' => $pagerange,
        'prev_next' => true,
        'prev_text' => __('&laquo;'),
        'next_text' => __('&raquo;'),
        'type' => 'array',
        'add_args' => false,
        'add_fragment' => ''
    );

    $paginate_links = acadp_paginate_links_edited($pagination_args);

    if ($paginate_links) {
        ?>
        <style>
            .pagination-inline {
                display: inline-block;
            }
        </style>
        <div class="row justify-content-center">
            <div class="col-auto">
                <nav aria-label="Navegação de página exemplo">
                    <ul class="pagination justify-content-center" style="display: inline-block !important;">

                        <?php
                        foreach ($paginate_links as $key => $page_link) {
                            if (strpos($page_link, 'current') !== false) {
                                echo '<li class="page-item active pagination-inline">' . $page_link . '</li>';
                            } else {
                                echo '<li class="page-item pagination-inline">' . $page_link . '</li>';
                            }
                        }
                        ?>
                    </ul>
                </nav>
            </div>
        </div>
        <?php
    }
}

function acadp_paginate_links_edited($args = '')
{
    global $wp_query, $wp_rewrite;

    // Setting up default values based on the current URL.
    $pagenum_link = html_entity_decode(get_pagenum_link());
    $url_parts = explode('?', $pagenum_link);

    // Get max pages and current page out of the current query, if available.
    $total = isset($wp_query->max_num_pages) ? $wp_query->max_num_pages : 1;
    $current = get_query_var('paged') ? (int)get_query_var('paged') : 1;

    // Append the format placeholder to the base URL.
    $pagenum_link = trailingslashit($url_parts[0]) . '%_%';

    // URL base depends on permalink settings.
    $format = $wp_rewrite->using_index_permalinks() && !strpos($pagenum_link, 'index.php') ? 'index.php/' : '';
    $format .= $wp_rewrite->using_permalinks() ? user_trailingslashit($wp_rewrite->pagination_base . '/%#%', 'paged') : '?paged=%#%';

    $defaults = array(
        'base' => $pagenum_link, // http://example.com/all_posts.php%_% : %_% is replaced by format (below).
        'format' => $format, // ?page=%#% : %#% is replaced by the page number.
        'total' => $total,
        'current' => $current,
        'aria_current' => 'page',
        'show_all' => false,
        'prev_next' => true,
        'prev_text' => __('&laquo; Previous'),
        'next_text' => __('Next &raquo;'),
        'end_size' => 1,
        'mid_size' => 2,
        'type' => 'plain',
        'add_args' => array(), // Array of query args to add.
        'add_fragment' => '',
        'before_page_number' => '',
        'after_page_number' => '',
    );

    $args = wp_parse_args($args, $defaults);

    if (!is_array($args['add_args'])) {
        $args['add_args'] = array();
    }

    // Merge additional query vars found in the original URL into 'add_args' array.
    if (isset($url_parts[1])) {
        // Find the format argument.
        $format = explode('?', str_replace('%_%', $args['format'], $args['base']));
        $format_query = isset($format[1]) ? $format[1] : '';
        wp_parse_str($format_query, $format_args);

        // Find the query args of the requested URL.
        wp_parse_str($url_parts[1], $url_query_args);

        // Remove the format argument from the array of query arguments, to avoid overwriting custom format.
        foreach ($format_args as $format_arg => $format_arg_value) {
            unset($url_query_args[$format_arg]);
        }

        $args['add_args'] = array_merge($args['add_args'], urlencode_deep($url_query_args));
    }

    // Who knows what else people pass in $args.
    $total = (int)$args['total'];
    if ($total < 2) {
        return;
    }
    $current = (int)$args['current'];
    $end_size = (int)$args['end_size']; // Out of bounds? Make it the default.
    if ($end_size < 1) {
        $end_size = 1;
    }
    $mid_size = (int)$args['mid_size'];
    if ($mid_size < 0) {
        $mid_size = 2;
    }

    $add_args = $args['add_args'];
    $r = '';
    $page_links = array();
    $dots = false;

    if ($args['prev_next'] && $current && 1 < $current) :
        $link = str_replace('%_%', 2 == $current ? '' : $args['format'], $args['base']);
        $link = str_replace('%#%', $current - 1, $link);
        if ($add_args) {
            $link = add_query_arg($add_args, $link);
        }
        $link .= $args['add_fragment'];

        $page_links[] = sprintf(
            '<a class="page-link" href="%s" aria-label="Anterior">
                       <span aria-hidden="true">&laquo;</span>
                       <span class="sr-only">Anterior</span>
                   </a>',

            esc_url(apply_filters('paginate_links', $link)),
        //$args['prev_text']
        );
    endif;

    for ($n = 1; $n <= $total; $n++) :
        if ($n == $current) :
            $page_links[] = sprintf(
                '<a class="page-link" href="#" aria-current="%s">%s <span class="sr-only">(current)</span></a>',
                esc_attr($args['aria_current']),
                $args['before_page_number'] . number_format_i18n($n) . $args['after_page_number']
            );

            $dots = true;
        else :
            if ($args['show_all'] || ($n <= $end_size || ($current && $n >= $current - $mid_size && $n <= $current + $mid_size) || $n > $total - $end_size)) :
                $link = str_replace('%_%', 1 == $n ? '' : $args['format'], $args['base']);
                $link = str_replace('%#%', $n, $link);
                if ($add_args) {
                    $link = add_query_arg($add_args, $link);
                }
                $link .= $args['add_fragment'];

                $page_links[] = sprintf(
                    '<a class="page-link" href="%s">%s</a>',
                    /** This filter is documented in wp-includes/general-template.php */
                    esc_url(apply_filters('paginate_links', $link)),
                    $args['before_page_number'] . number_format_i18n($n) . $args['after_page_number']
                );

                $dots = true;
            elseif ($dots && !$args['show_all']) :
                $page_links[] = '<span class="page-link">' . __('&hellip;') . '</span>';

                $dots = false;
            endif;
        endif;
    endfor;

    if ($args['prev_next'] && $current && $current < $total) :
        $link = str_replace('%_%', $args['format'], $args['base']);
        $link = str_replace('%#%', $current + 1, $link);
        if ($add_args) {
            $link = add_query_arg($add_args, $link);
        }
        $link .= $args['add_fragment'];

        $page_links[] = sprintf(
            '<a class="page-link pagination" href="%s" aria-label="Próximo">
                        <span aria-hidden="true">&raquo;</span>
                        <span class="sr-only">Próximo</span>
                    </a>',
            /** This filter is documented in wp-includes/general-template.php */
            esc_url(apply_filters('paginate_links', $link))
        );
    endif;

    switch ($args['type']) {
        case 'array':
            return $page_links;

        case 'list':
            $r .= "<ul class='page-numbers'>\n\t<li>";
            $r .= implode("</li>\n\t<li>", $page_links);
            $r .= "</li>\n</ul>\n";
            break;

        default:
            $r = implode("\n", $page_links);
            break;
    }

    /**
     * Filters the HTML output of paginated links for archives.
     *
     * @param string $r HTML output.
     * @param array $args An array of arguments. See paginate_links()
     *                     for information on accepted arguments.
     * @since 5.7.0
     *
     */
    $r = apply_filters('paginate_links_output', $r, $args);

    return $r;
}

/**
 * Retrieve paginated link for listing pages.
 *
 * @param int $numpages The total amount of pages.
 * @param int $pagerange How many numbers to either side of current page.
 * @param int $paged The current page number.
 * @deprecated 1.5.4
 * @since      1.0.0
 */
function acadp_pagination($numpages = '', $pagerange = '', $paged = '')
{
    the_acadp_pagination($numpages, $pagerange, $paged);
}

/**
 * Outputs the ACADP categories/locations dropdown.
 *
 * @param array $args Array of options to control the field output.
 * @param bool $echo Whether to echo or just return the string.
 * @return string       HTML attribute or empty string.
 * @since  1.5.5
 */
function acadp_dropdown_terms($args = array(), $echo = true)
{
    // Vars
    $args = array_merge(array(
        'show_option_none' => '-- ' . __('Select category', 'advanced-classifieds-and-directory-pro') . ' --',
        'option_none_value' => '',
        'taxonomy' => 'acadp_categories',
        'name' => 'acadp_category',
        'class' => 'form-control',
        'required' => false,
        'base_term' => 0,
        'parent' => 0,
        'orderby' => 'name',
        'order' => 'ASC',
        'selected' => 0
    ), $args);

    if (!empty($args['selected'])) {
        $ancestors = get_ancestors($args['selected'], $args['taxonomy']);
        $ancestors = array_merge(array_reverse($ancestors), array($args['selected']));
    } else {
        $ancestors = array();
    }

    // Build data
    $html = '';

    if (isset($args['walker'])) {
        $selected = count($ancestors) >= 2 ? (int)$ancestors[1] : 0;

        //$html .= '<div class="acadp-terms">';
        $html .= sprintf('<input type="hidden" name="%s" class="acadp-term-hidden" value="%d" />', $args['name'], $selected);

        $term_args = array(
            'show_option_none' => $args['show_option_none'],
            'option_none_value' => $args['option_none_value'],
            'taxonomy' => $args['taxonomy'],
            'child_of' => $args['parent'],
            'orderby' => $args['orderby'],
            'order' => $args['order'],
            'selected' => $selected,
            'hierarchical' => true,
            'depth' => 2,
            'show_count' => false,
            'hide_empty' => false,
            'walker' => $args['walker'],
            'echo' => 0
        );

        unset($args['walker']);

        $select = wp_dropdown_categories($term_args);
        $required = $args['required'] ? ' required' : '';
        $replace = sprintf('<select class="%s" data-taxonomy="%s" data-parent="%d"%s>', $args['class'], $args['taxonomy'], $args['parent'], $required);

        $html .= preg_replace('#<select([^>]*)>#', $replace, $select);

        if ($selected > 0) {
            $args['parent'] = $selected;
            $html .= acadp_dropdown_terms($args, false);
        }

        //$html .= '</div>';
    } else {
        $has_children = 0;
        $child_of = 0;

        $term_args = array(
            'parent' => $args['parent'],
            'orderby' => 'name',
            'order' => 'ASC',
            'hide_empty' => false,
            'hierarchical' => false
        );
        $terms = get_terms($args['taxonomy'], $term_args);

        if (!empty($terms) && !is_wp_error($terms)) {
            if ($args['parent'] == $args['base_term']) {
                $required = $args['required'] ? ' required' : '';

                $html .= '<div class="acadp-terms">';
                $html .= sprintf('<input type="hidden" name="%s" class="acadp-term-hidden" value="%d" />', $args['name'], $args['selected']);
                $html .= sprintf('<select class="%s" data-taxonomy="%s" data-parent="%d"%s>', $args['class'], $args['taxonomy'], $args['parent'], $required);
                $html .= sprintf('<option value="%s">%s</option>', $args['option_none_value'], $args['show_option_none']);
            } else {
                $html .= sprintf('<div class="acadp-child-terms acadp-child-terms-%d">', $args['parent']);
                $html .= sprintf('<select class="%s" data-taxonomy="%s" data-parent="%d" required>', $args['class'], $args['taxonomy'], $args['parent']);
                $html .= sprintf('<option value="">%s</option>', 'Escolha a Região'); //%d, $args['parent']
            }

            foreach ($terms as $term) {
                $selected = '';
                if (in_array($term->term_id, $ancestors)) {
                    $has_children = 1;
                    $child_of = $term->term_id;
                    $selected = ' selected';
                } elseif ($term->term_id == $args['selected']) {
                    $selected = ' selected';
                }
                $html .= sprintf('<option value="%d"%s>%s</option>', $term->term_id, $selected, $term->name);
            }

            $html .= '</select>';
            if ($has_children) {
                $args['parent'] = $child_of;
                $html .= acadp_dropdown_terms($args, false);
            }
            $html .= '</div>';
        } else {
            if ($args['parent'] == $args['base_term']) {
                $required = $args['required'] ? ' required' : '';

                $html .= '<div class="acadp-terms">';
                $html .= sprintf('<input type="hidden" name="%s" class="acadp-term-hidden" value="%d" />', $args['name'], $args['selected']);
                $html .= sprintf('<select class="%s" data-taxonomy="%s" data-parent="%d"%s>', $args['class'], $args['taxonomy'], $args['parent'], $required);
                $html .= sprintf('<option value="%s">%s</option>', $args['option_none_value'], $args['show_option_none']);
                $html .= '</select>';
                $html .= '</div>';
            }
        }
    }

    // Echo or Return
    if ($echo) {
        echo $html;
        return '';
    } else {
        return $html;
    }
}
