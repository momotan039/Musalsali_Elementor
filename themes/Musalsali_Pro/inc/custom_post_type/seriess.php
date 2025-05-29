<?php
 //add seriess post type
 function series_project()
 {
    $labels = array(
        "name" => __("Series", 'arabic-lang'),
        "menu_name" => __("Seriess", 'arabic-lang'),
        'singular_name' => __("Series", 'arabic-lang'),
        'add_new' => __("Add New Series", 'arabic-lang'),
        'add_new_item' => __("Add New Series", 'arabic-lang'),
        'edit_item' => __("edit series", 'arabic-lang'),
        'new_item' => __("new series", 'arabic-lang'),
        'view_item' => __("view series", 'arabic-lang'),
        'search_items' => __("search for seriess", 'arabic-lang'),
        'not_found' => __("no series is found", 'arabic-lang'),
        'not_found_in_trash' => __("no series is found in trash", 'arabic-lang'),
    );
    
     $labels2 = array(
         "labels" => $labels,
         'public' => true,
         'publicly_queryable' => true,
         'show_ui'            => true,
         'show_in_menu'       => true,
         'query_var'          => true,
         'rewrite'            => array('slug' => 'seriess'),
         'capability_type'    => 'post',
         'has_archive'        => true,
         'hierarchical'       => true,
         'menu_position'      => 5,
         "menu_icon"          => "dashicons-format-video",
         'supports'           => array("editor", 'title', 'thumbnail'),
         'taxonomies'         => array('category'),
     );
     register_post_type("seriess", $labels2);
 }
 add_action("init", "series_project");

?>