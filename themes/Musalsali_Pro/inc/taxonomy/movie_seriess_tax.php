<?php
// Create a custom taxonomy named "Movie Series"
add_action('init', 'create_movie_series_taxonomy', 0);
function create_movie_series_taxonomy()
{
    $labels = array(
        'name'              => __('Movie Series', 'arabic-lang'),
        'singular_name'     => __('Movie Series','arabic-lang'),
        'search_items'      => __('Search Movie Series', 'arabic-lang'),
        'all_items'         => __('All Movie Series', 'arabic-lang'),
        'parent_item'       => __('Parent Movie Series', 'arabic-lang'),
        'parent_item_colon' => __('Parent Movie Series:', 'arabic-lang'),
        'edit_item'         => __('Edit Movie Series', 'arabic-lang'),
        'update_item'       => __('Update Movie Series', 'arabic-lang'),
        'add_new_item'      => __('Add New Movie Series', 'arabic-lang'),
        'new_item_name'     => __('New Movie Series Name', 'arabic-lang'),
        'menu_name'         => __('Movie Series', 'arabic-lang'),
    );
    

    // Register the taxonomy
    register_taxonomy('movie_series', array("movies"), array(
        'hierarchical' => true,
        'labels' => $labels,
        'show_ui' => true,
        'show_admin_column' => true,
        'query_var' => true,
        'rewrite' => array('slug' => 'movie-series'),
    ));
}

// Add Image Field to Movie Series Taxonomy
add_action('movie_series_add_form_fields', 'movie_series_add_image_field');
function movie_series_add_image_field()
{
   upload_image_field('movie_series_image','taxonomy');
}

// Edit Image Field in Movie Series Taxonomy
add_action('movie_series_edit_form_fields', 'movie_series_edit_image_field');
function movie_series_edit_image_field($term)
{
    upload_image_field('movie_series_image','taxonomy',$term->term_id);
}

// Save Image Field for Movie Series Taxonomy
add_action('created_movie_series', 'save_movie_series_image_meta', 10, 1);
add_action('edited_movie_series', 'save_movie_series_image_meta', 10, 1);
function save_movie_series_image_meta($term_id)
{
    if (isset($_POST['movie_series_image'])) {
        update_term_meta($term_id, 'movie_series_image', esc_url($_POST['movie_series_image']));
    }
}

?>
