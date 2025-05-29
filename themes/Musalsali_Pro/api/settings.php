<?php 
function get_api_settings() {
    return [
        'maintenance_mode' => get_option('maintenance_mode', '0'),
        'uploading_to_store' => get_option('uploading_to_store', '0'),
        'maintenance_message' => get_option('maintenance_value', ''),
        'show_ads' => get_option('show_ads', '0'),
        'show_banner_ads' => get_option('show_banner_ads', '0'),
        'show_native_ads' => get_option('show_native_ads', '0'),
        'show_rewarded_ads' => get_option('show_rewarded_ads', '0'),
        'banner_ad_unit' => get_option('banner_ad_unit', ''),
        'native_ad_unit' => get_option('native_ad_unit', ''),
        'rewarded_ad_unit' => get_option('rewarded_ad_unit', ''),
    ];
}

function register_api_settings_route() {
    register_rest_route('app-settings/v1', '/get-settings/', [
        'methods'  => 'GET',
        'callback' => 'get_api_settings',
        'permission_callback' => '__return_true', // Public access
    ]);
}
add_action('rest_api_init', 'register_api_settings_route');

?>