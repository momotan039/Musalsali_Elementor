<?php 
 //create a custom taxonomy name writers
 add_action('init', 'create_writers_taxonomy', 0);

 function create_writers_taxonomy()
 {
    $labels1 = array(
        'name'              => __('writer', 'arabic-lang'),
        'singular_name'     => __('writer', 'arabic-lang'),
        'search_items'      => __('Search writers', 'arabic-lang'),
        'all_items'         => __('All writers', 'arabic-lang'),
        'parent_item'       => __('Parent writer', 'arabic-lang'),
        'parent_item_colon' => __('Parent writer:', 'arabic-lang'),
        'edit_item'         => __('Edit writer', 'arabic-lang'),
        'update_item'       => __('Update writer', 'arabic-lang'),
        'add_new_item'      => __('Add New writer', 'arabic-lang'),
        'new_item_name'     => __('New writer Name', 'arabic-lang'),
        'menu_name'         => __('Writers', 'arabic-lang'),
    );

     // taxonomy register
     register_taxonomy('writers', array("movies", "seriess"), array(
         'hierarchical' => true,
         'labels' => $labels1,
         'show_ui' => true,
         'show_admin_column' => true,
         'query_var' => true,
         'rewrite' => array('slug' => 'writer'),
     ));
 }
?>