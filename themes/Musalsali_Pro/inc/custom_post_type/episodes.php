<?php
 //add episodes post type
 function episode_project()
 {
    $labels = array(
        "name" => __("Episodes", 'arabic-lang'),
        "menu_name" => __("Episodes", 'arabic-lang'),
        'singular_name' => __("Episode", 'arabic-lang'),
        'add_new' => __("Add New Episode", 'arabic-lang'),
        'add_new_item' => __("Add New Episode", 'arabic-lang'),
        'edit_item' => __("edit episode", 'arabic-lang'),
        'new_item' => __("new episode", 'arabic-lang'),
        'view_item' => __("view episode", 'arabic-lang'),
        'search_items' => __("Search for Episodes", 'arabic-lang'),
        'not_found' => __("no episode is found", 'arabic-lang'),
        'not_found_in_trash' => __("no episode is found in trash", 'arabic-lang'),
    );
    
     $args = array(
         "labels" => $labels,
         'public' => true,
         'publicly_queryable' => true,
         'show_ui'            => true,
         'show_in_menu'       => true,
         'query_var'          => true,
         'rewrite'            => array('slug' => 'episodes'),
         'capability_type'    => 'post',
         'has_archive'        => true,
         'hierarchical'       => false,
         'menu_position'      => 5,
         "menu_icon"          => "dashicons-format-video",
         'supports'           => array('title'),
     );
     register_post_type("episodes", $args);
 }
 add_action("init", "episode_project");

?>