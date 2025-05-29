<?php 
// add movies post type
function movie_project()
{
    $labels = array(
        "name" => __("Movies",'arabic-lang'),
        "menu_name" => __("Movies",'arabic-lang'),
        'singular_name' => __("Movie",'arabic-lang'),
        'add_new' => __("Add New Movie",'arabic-lang'),
        'add_new_item' => __("Add New Movie",'arabic-lang'),
        'edit_item' => __("Edit Movie",'arabic-lang'),
        'new_item' => __("New Movie",'arabic-lang'),
        'view_item' => __("View Movie",'arabic-lang'),
        'search_items' => __("Search for Movie",'arabic-lang'),
        'not_found' => __("no movie is found",'arabic-lang'),
        'not_found_in_trash' => __("no movie is found in trash",'arabic-lang'),
    );
    $labels2 = array(
        "labels" => $labels,
        'public' => true,
        'publicly_queryable' => true,
        'show_ui'            => true,
        'show_in_menu'       => true,
        'query_var'          => true,
        'rewrite'            => array('slug' => 'movies'),
        'capability_type'    => 'post',
        'has_archive'        => true,
        'hierarchical'       => true,
        'menu_position'      => 5,
        "menu_icon"          => "dashicons-format-video",
        'supports'           => array('title', "editor", 'thumbnail'),
        'taxonomies'         => array('category'),
    );
    register_post_type("movies", $labels2);
}
add_action("init", "movie_project");
?>