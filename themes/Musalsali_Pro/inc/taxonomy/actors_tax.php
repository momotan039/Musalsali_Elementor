<?php
//create a custom taxonomy name actors
add_action('init', 'create_actors_taxonomy', 0);
function create_actors_taxonomy()
{
    $labels3 = array(
        'name' => __('actor',  'arabic-lang'),
        'singular_name' => __('actor', 'arabic-lang'),
        'search_items' => __('Search actors', 'arabic-lang'),
        'all_items' => __('All actors', 'arabic-lang'),
        'parent_item' => __('Parent actor', 'arabic-lang'),
        'parent_item_colon' => __('Parent actor:', 'arabic-lang'),
        'edit_item' => __('Edit actor', 'arabic-lang'),
        'update_item' => __('Update actor', 'arabic-lang'),
        'add_new_item' => __('Add New actor', 'arabic-lang'),
        'new_item_name' => __('New actor Name', 'arabic-lang'),
        'menu_name' => __('Actors', 'arabic-lang'),
    );
    
    // taxonomy register
    register_taxonomy('actors', array("movies", "seriess"), array(
        'hierarchical' => true,
        'labels' => $labels3,
        'show_ui' => true,
        'show_admin_column' => true,
        'query_var' => true,
        'rewrite' => array('slug' => 'actor'),
        'supports' => 'thumbnail',
    ));

    
// Add Image Field to Actor Taxonomy
add_action('actors_add_form_fields', 'actors_add_image_field');
function actors_add_image_field()
{
   upload_image_field('actor_image','taxonomy');
}

// Edit Image Field in Actor Taxonomy
add_action('actors_edit_form_fields', 'actors_edit_image_field');
function actors_edit_image_field($term)
{
    upload_image_field('actor_image','taxonomy',$term->term_id);
}

// Save Image Field for Actor Taxonomy
add_action('created_actors', 'save_actor_image_meta', 10, 1);
add_action('edited_actors', 'save_actor_image_meta', 10, 1);
function save_actor_image_meta($term_id)
{
    if (isset($_POST['actor_image'])) {
        update_term_meta($term_id, 'actor_image', esc_url($_POST['actor_image']));
    }
}
}
?>