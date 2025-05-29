<?php 
 //create a custom taxonomy name genres
 add_action('init', 'create_genres_taxonomy', 0);

 function create_genres_taxonomy()
 {
    $labels1 = array(
        'name' => __('genre', 'arabic-lang'),
        'singular_name' => __('genre','arabic-lang'),
        'search_items' => __('Search genres', 'arabic-lang'),
        'all_items' => __('All genres', 'arabic-lang'),
        'parent_item' => __('Parent genre', 'arabic-lang'),
        'parent_item_colon' => __('Parent genre:', 'arabic-lang'),
        'edit_item' => __('Edit genre', 'arabic-lang'),
        'update_item' => __('Update genre', 'arabic-lang'),
        'add_new_item' => __('Add New genre', 'arabic-lang'),
        'new_item_name' => __('New genre Name', 'arabic-lang'),
        'menu_name' => __('Genres', 'arabic-lang'),
    );
    

     // taxonomy register
     register_taxonomy('genres', array("movies", "seriess"), array(
         'hierarchical' => true,
         'labels' => $labels1,
         'show_ui' => true,
         'show_admin_column' => true,
         'query_var' => true,
         'rewrite' => array('slug' => 'genre'),
     ));
 }
?>