<?php
// Prevent direct access
if (!defined('ABSPATH')) {
    exit;
}

function register_api_settings() {
    register_setting('api_settings_group', 'maintenance_mode');
    register_setting('api_settings_group', 'uploading_to_store');
    register_setting('api_settings_group', 'maintenance_value');
    register_setting('api_settings_group', 'show_ads');
    register_setting('api_settings_group', 'show_banner_ads');
    register_setting('api_settings_group', 'banner_ad_unit');
    register_setting('api_settings_group', 'show_native_ads');
    register_setting('api_settings_group', 'native_ad_unit');
    register_setting('api_settings_group', 'show_rewarded_ads');
    register_setting('api_settings_group', 'rewarded_ad_unit');

    add_settings_section('api_settings_section', 'Main Api Settings', null, 'api-settings');
    add_settings_field('uploading_to_store', 'Is Currently Uplaoding To Play Store', 'uploading_to_store_callback', 'api-settings', 'api_settings_section');
    add_settings_field('maintenance_mode', 'Enable Maintenance Mode', 'maintenance_mode_callback', 'api-settings', 'api_settings_section');
    add_settings_field('maintenance_value', 'Enter Maintenance Message', 'maintenance_value_callback', 'api-settings', 'api_settings_section');
    
    add_settings_section('ads_api_settings_section', 'Ads Api Settings', null, 'api-settings');
    add_settings_field('show_ads', 'Enable Ads', 'show_ads_callback', 'api-settings', 'ads_api_settings_section');
    add_settings_field('show_banner_ads', 'Show Banner Ads', 'show_banner_ads_callback', 'api-settings', 'ads_api_settings_section');
    add_settings_field('banner_ad_unit', 'Banner Ad Unit ID', 'banner_ad_unit_callback', 'api-settings', 'ads_api_settings_section');
    add_settings_field('show_native_ads', 'Show Native Ads', 'show_native_ads_callback', 'api-settings', 'ads_api_settings_section');
    add_settings_field('native_ad_unit', 'Native Ad Unit ID', 'native_ad_unit_callback', 'api-settings', 'ads_api_settings_section');
    add_settings_field('show_rewarded_ads', 'Show Rewarded Ads', 'show_rewarded_ads_callback', 'api-settings', 'ads_api_settings_section');
    add_settings_field('rewarded_ad_unit', 'Rewarded Ad Unit ID', 'rewarded_ad_unit_callback', 'api-settings', 'ads_api_settings_section');
}
add_action('admin_init', 'register_api_settings');

function maintenance_mode_callback() {
    $option = get_option('maintenance_mode');
    echo '<input type="checkbox" name="maintenance_mode" value="1" ' . checked(1, $option, false) . '>';
}

function maintenance_value_callback() {
    $option = get_option('maintenance_value');
    echo '<input type="text" name="maintenance_value" value="' . esc_attr($option) . '" size="40">';
}

function uploading_to_store_callback() {
    $option = get_option('uploading_to_store');
    echo '<input type="checkbox" name="uploading_to_store" value="1" ' . checked(1, $option, false) . '> الاولوية لهذا الوضع';
}

function show_ads_callback() {
    $option = get_option('show_ads');
    echo '<input type="checkbox" name="show_ads" value="1" ' . checked(1, $option, false) . '>';
}

function show_banner_ads_callback() {
    $option = get_option('show_banner_ads');
    echo '<input type="checkbox" name="show_banner_ads" value="1" ' . checked(1, $option, false) . '>';
}

function banner_ad_unit_callback() {
    $option = get_option('banner_ad_unit');
    echo '<input type="text" name="banner_ad_unit" value="' . esc_attr($option) . '" size="40">';
}

function show_native_ads_callback() {
    $option = get_option('show_native_ads');
    echo '<input type="checkbox" name="show_native_ads" value="1" ' . checked(1, $option, false) . '>';
}

function native_ad_unit_callback() {
    $option = get_option('native_ad_unit');
    echo '<input type="text" name="native_ad_unit" value="' . esc_attr($option) . '" size="40">';
}

function show_rewarded_ads_callback() {
    $option = get_option('show_rewarded_ads');
    echo '<input type="checkbox" name="show_rewarded_ads" value="1" ' . checked(1, $option, false) . '>';
}

function rewarded_ad_unit_callback() {
    $option = get_option('rewarded_ad_unit');
    echo '<input type="text" name="rewarded_ad_unit" value="' . esc_attr($option) . '" size="40">';
}
