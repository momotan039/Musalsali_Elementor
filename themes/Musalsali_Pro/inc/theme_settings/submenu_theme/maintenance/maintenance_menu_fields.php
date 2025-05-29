<?php
// Prevent direct access
if (!defined('ABSPATH')) {
    exit;
}

// Register Theme Settings Fields
function custom_maintenance_settings_init()
{
    // Register settings:that means register all fields I have in the database
    register_setting('maintenance_settings_group', 'maintenance_mode');
    register_setting('maintenance_settings_group', 'facebook_link');
    register_setting('maintenance_settings_group', 'instagram_link');
    register_setting('maintenance_settings_group', 'twitter_link');
    register_setting('maintenance_settings_group', 'image_maintenance');
    register_setting('maintenance_settings_group', 'description_maintenance');
    //main section
    add_settings_section('main_maintenance_section', __('Main Configuration','arabic-lang'), null, 'maintenance-settings');
    add_settings_field('maintenance_key', __('Enable Maintenance Mode','arabic-lang'), 'maintenance_key_callback', 'maintenance-settings','main_maintenance_section');
    //social media section
    add_settings_section('social_media_section', __('Social Media Links','arabic-lang'), null, 'maintenance-settings');
    add_settings_field('facebook_link', __('Facebook','arabic-lang'), 'social_media_callback', 'maintenance-settings','social_media_section',['label'=>'facebook_link']);
    add_settings_field('instagram_link', __('Instagram','arabic-lang'), 'social_media_callback', 'maintenance-settings','social_media_section',['label'=>'instagram_link']);
    add_settings_field('twitter_link', __('Twitter(X)','arabic-lang'), 'social_media_callback', 'maintenance-settings','social_media_section',['label'=>'twitter_link']);
    //Image and Info section
    add_settings_section('info_image_fix_section', __('Image & Description','arabic-lang'), null, 'maintenance-settings');
    add_settings_field('image_maintenance', __('Image','arabic-lang'), 'image_maintenance_callback', 'maintenance-settings','info_image_fix_section');
    add_settings_field('description_maintenance', __('Description','arabic-lang'), 'description_maintenance_callback', 'maintenance-settings','info_image_fix_section');

}
add_action('admin_init', 'custom_maintenance_settings_init');

function maintenance_key_callback()
{
    $value = get_option('maintenance_mode');
    echo '<input '.checked(boolval($value),true,false).' type="checkbox" class="regular-text" name="maintenance_mode">';
}

function social_media_callback($args) {
    $option_name = $args['label']; // Dynamically get the field name
    $value = get_option($option_name); // Get the saved value for the option
    echo '<input type="url" id="' . esc_attr($option_name) . '" 
           name="' . esc_attr($option_name) . '" 
           value="' . esc_attr($value) . '" 
           class="regular-text" />';
}

function image_maintenance_callback(){
    upload_image_field('image_maintenance','theme');
}

function description_maintenance_callback(){
    ?>
    <textarea class="regular-text" name="description_maintenance"><?php echo esc_html(get_option('description_maintenance'))?></textarea>
    <?php 
}
function initialize_maintenance_options_on_activation() {
    // Initialize options only if they don't already exist
    if (get_option('image_maintenance') === false) {
        update_option('image_maintenance', get_stylesheet_directory_uri() . '/assets/images/comming.png');
    }
}
add_action('after_switch_theme', 'initialize_maintenance_options_on_activation');
