<?php 
//setup theme
function theme_setup() {
    add_theme_support('post-thumbnails'); // Enable featured images
    register_nav_menu('header-menu','Header Menu');//enable menu ,and create header menu
    // add_filter('acf/settings/show_admin', fn($show_admin)=>false);//hide acf from the admin panel
}
add_action('after_setup_theme', 'theme_setup');

// admin panel settings
function admin_panel_setup(){
     // Hide Posts panel from the admin menu
     remove_menu_page('edit.php'); // Removes the Posts menu
}
add_action('admin_menu','admin_panel_setup');

// adjust which post type to fetch
add_action('pre_get_posts', function ($query) {
    if ($query->is_main_query() && !is_admin()) {
        $post_types=array('movies','seriess');
        if(is_front_page(  )||is_single())
        $query->set('post_type', array(...$post_types,'episodes'));
        elseif(is_page())
        $query->set('post_type','page');
     else
        $query->set('post_type',$post_types);
}});
?>