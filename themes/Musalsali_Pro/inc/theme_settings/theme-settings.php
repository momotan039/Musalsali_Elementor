<?php
// Prevent direct access
if (!defined('ABSPATH')) {
    exit;
}

// Redirect users to a maintenance page if its enabled
add_action('template_redirect', function () {
    if(!get_option('maintenance_mode'))
    return;

    get_template_part('comming');
    exit; // Stop further execution
}
);

// register arabic translated language for dashboard
function my_theme_load_textdomain() {
    load_theme_textdomain('arabic-lang', get_template_directory() . '/languages');
}
add_action('after_setup_theme', 'my_theme_load_textdomain');

function remove_actors_taxonomy_column($columns) {
    if (isset($columns['taxonomy-actors'])) {
        unset($columns['taxonomy-actors']);
    }
    return $columns;
}

// Apply this to all post types
add_action('admin_init', function() {
    $post_types = get_post_types(); // Get all post types
    foreach ($post_types as $post_type) {
        add_filter("manage_{$post_type}_posts_columns", 'remove_actors_taxonomy_column');
    }
});

function custom_admin_footer_text() {
    echo __('Thank You For Using Musalsali','arabic-lang');
}
add_filter('admin_footer_text', 'custom_admin_footer_text');


// Include settings page & fields
require_once get_template_directory() . '/inc/theme_settings/theme-shared-fields.php';
require_once get_template_directory() . '/inc/theme_settings/theme-settings-menu.php';
require_once get_template_directory() . '/inc/theme_settings/theme-settings-fields.php';
// Include Submenu Settings
require_once 'submenu_theme/submenu_theme.php';
