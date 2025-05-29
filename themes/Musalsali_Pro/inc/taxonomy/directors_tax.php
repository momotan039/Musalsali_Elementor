<?php 
 //create a custom taxonomy name directors
 add_action('init', 'create_directors_taxonomy', 0);

 function create_directors_taxonomy()
 {
    $labels1 = array(
        'name'              => __('director', 'arabic-lang'),
        'singular_name'     => __('director',  'arabic-lang'),
        'search_items'      => __('Search directors', 'arabic-lang'),
        'all_items'         => __('All directors', 'arabic-lang'),
        'parent_item'       => __('Parent director', 'arabic-lang'),
        'parent_item_colon' => __('Parent director:', 'arabic-lang'),
        'edit_item'         => __('Edit director', 'arabic-lang'),
        'update_item'       => __('Update director', 'arabic-lang'),
        'add_new_item'      => __('Add New director', 'arabic-lang'),
        'new_item_name'     => __('New director Name', 'arabic-lang'),
        'menu_name'         => __('Directors', 'arabic-lang'),
    );
    

     // taxonomy register
     register_taxonomy('directors', array("movies", "seriess"), array(
         'hierarchical' => true,
         'labels' => $labels1,
         'show_ui' => true,
         'show_admin_column' => true,
         'query_var' => true,
         'rewrite' => array('slug' => 'director'),
     ));
 }
?>