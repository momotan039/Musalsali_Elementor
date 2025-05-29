<?php
// Prevent direct access
if (!defined('ABSPATH')) {
    exit;
}

// Register Theme Settings Fields
function custom_tmdb_settings_init()
{
    // Register settings:that means register all fields I have in the database
    register_setting('tmdb_settings_group', 'tmdb_key');

    // Colors Section
    add_settings_section('tmdb_section', __('Main Configuration','arabic-lang'), null, 'tmdb-settings');
    add_settings_field('tmdb_key', __('Insert Your Key','arabic-lang'), 'tmdb_key_callback', 'tmdb-settings','tmdb_section');
}
add_action('admin_init', 'custom_tmdb_settings_init');

function tmdb_key_callback()
{
    $key = get_option('tmdb_key');
    echo '<input class="regular-text" name="tmdb_key" value="' .$key. '">';
}
