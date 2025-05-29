<?php 
function register_custom_widgets( $widgets_manager ) {
    require_once get_stylesheet_directory() . '/widgets/Filter_Widget.php';
    $widgets_manager->register( new \Filter_Widget() );
}
add_action('elementor/widgets/register', 'register_custom_widgets');