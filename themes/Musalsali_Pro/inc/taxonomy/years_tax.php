<?php
 //create a custom taxonomy name years
 add_action('init', 'create_years_taxonomy', 0);
 function create_years_taxonomy()
 {
    $labels2 = array(
        'name' => __('release year', 'arabic-lang'),
        'singular_name' => __('release year',  'arabic-lang'),
        'search_items' => __('Search release years', 'arabic-lang'),
        'all_items' => __('All release years', 'arabic-lang'),
        'parent_item' => __('Parent release year', 'arabic-lang'),
        'parent_item_colon' => __('Parent release year:', 'arabic-lang'),
        'edit_item' => __('Edit release year', 'arabic-lang'),
        'update_item' => __('Update release year', 'arabic-lang'),
        'add_new_item' => __('Add New release year', 'arabic-lang'),
        'new_item_name' => __('New release year Name', 'arabic-lang'),
        'menu_name' => __('Release Years', 'arabic-lang'),
    );
    
     // taxonomy register
     register_taxonomy('release_years', array('post', "movies", "seriess"), array(
         'hierarchical' => true,
         'labels' => $labels2,
         'show_ui' => true,
         'show_admin_column' => true,
         'query_var' => true,
         'rewrite' => array('slug' => 'release_year'),
     ));
 }
?>
