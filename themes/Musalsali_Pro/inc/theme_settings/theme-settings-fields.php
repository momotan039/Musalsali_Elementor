<?php
// Prevent direct access
if (!defined('ABSPATH')) {
    exit;
}

// Register Theme Settings Fields
function custom_theme_settings_init()
{
    // Register settings:that means register all fields I have in the database
    register_setting('theme_settings_group', 'primary_color');
    register_setting('theme_settings_group', 'light_color');
    register_setting('theme_settings_group', 'dark_color');
    register_setting('theme_settings_group', 'wallpaper');
    register_setting('theme_settings_group', 'icon');

    //  add_settings_field('hero_image', 'Hero Image URL', function(){upload_image_callback('hero_image');}, 'theme-settings', 'hero_section');
    // Wallpaper & Icon Section
    add_settings_section('wallpaper_icon_section', __('WallPaper & Icon Settings','arabic-lang'), null, 'theme-settings');
    add_settings_field('icon', __('Icon','arabic-lang'), 'icon_callback', 'theme-settings', 'wallpaper_icon_section');
    add_settings_field('wallpaper', __('Main WallPaper','arabic-lang'), 'wallpaper_callback', 'theme-settings', 'wallpaper_icon_section');
    // Colors Section
    add_settings_section('color_section', __('Colors Settings','arabic-lang'), null, 'theme-settings');
    add_settings_field('primary_color', __('Primary Color','arabic-lang'), 'primary_color_callback', 'theme-settings', 'color_section');
    add_settings_field('light_color',__('Light Color','arabic-lang'), 'light_color_callback', 'theme-settings', 'color_section');
    add_settings_field('dark_color', __('Dark Color','arabic-lang'), 'dark_color_callback', 'theme-settings', 'color_section');
}
add_action('admin_init', 'custom_theme_settings_init');

function icon_callback()
{
    upload_image_field('icon','theme');
}
function wallpaper_callback()
{
    upload_image_field('wallpaper','theme');
}

function primary_color_callback()
{
    $primary_color = get_option('primary_color');
    echo '<input type="color" name="primary_color" value="' . esc_attr($primary_color) . '">';
}

function light_color_callback()
{
    $light_color = get_option('light_color');
    echo '<input type="color" name="light_color" value="' . esc_attr($light_color) . '">';
}

function dark_color_callback()
{
    $dark_color = get_option('dark_color');
    echo '<input type="color" name="dark_color" value="' . esc_attr($dark_color) . '">';
}

function custom_reset_theme_settings()
{
    if (!current_user_can('manage_options')) {
        return;
    }
    // reset theme settings
    update_option('primary_color', '#a20d0d');
    update_option('light_color', '#ffffff');
    update_option('dark_color', '#000000');
    update_option('wallpaper',get_template_directory_uri().'/assets/images/cover.jpg');
    update_option('icon',get_template_directory_uri().'/assets/images/logo.png');
    echo '<script>location.reload();</script>';
    // exit;
}

function initialize_theme_options_on_activation() {
    // Initialize options only if they don't already exist
    if (get_option('primary_color') === false) {
        update_option('primary_color', '#a20d0d');
    }

    if (get_option('light_color') === false) {
        update_option('light_color', '#ffffff');
    }

    if (get_option('dark_color') === false) {
        update_option('dark_color', '#000000');
    }

    if (get_option('wallpaper') === false) {
        update_option('wallpaper', get_template_directory_uri() . '/assets/images/cover.jpg');
    }

    if (get_option('icon') === false) {
        update_option('icon', get_template_directory_uri() . '/assets/images/logo.png');
    }
}
add_action('after_switch_theme', 'initialize_theme_options_on_activation');
