<?php 
//add css files
function css_enqueue_styles() {
    // Get the theme directory URL
    $theme_uri = get_stylesheet_directory_uri();

    // Enqueue Styles
    wp_enqueue_style('main', $theme_uri . '/assets/css/main.css');
    wp_enqueue_style('FAPRO5', $theme_uri . '/assets/css/FAPRO5.css');
    wp_enqueue_style('video_style', $theme_uri . '/assets/css/video_style.css');
    // Enqueue WordPress default stylesheet
    wp_enqueue_style('theme-style', get_stylesheet_uri());
}

add_action('wp_enqueue_scripts', 'css_enqueue_styles');

//add js files
function js_enqueue_scripts() {
    $theme_uri = get_stylesheet_directory_uri();
    // Enqueue Scripts
    wp_enqueue_script('main', $theme_uri . '/assets/js/main.js', array(), null, true);
}
add_action('wp_enqueue_scripts', 'js_enqueue_scripts');
?>