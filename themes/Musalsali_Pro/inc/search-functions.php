<?php
// Ensure security (prevent direct access)
if (!defined('ABSPATH')) exit;

/**
 * Get the search page URL dynamically.
 */
function get_custom_search_page_url() {
    $search_pages = get_posts(array(
        'post_type'  => 'page',
        'meta_key'   => '_wp_page_template',
        'meta_value' => 'page-pro-search.php', // Ensure correct filename
        'posts_per_page' => 1,
        'suppress_filters' => true
    ));

    if (!empty($search_pages)) {
        return get_permalink($search_pages[0]->ID);
    }
    return home_url('/');
}
