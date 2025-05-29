<?php
require_once get_template_directory() . '/inc/scraping/elcinema.php';
require_once get_template_directory() . '/inc/scraping/tmdb.php';

function add_actor_rating_to_post($post_id, $show_info)
{
    if ($show_info == null) {
        return;
    }

    $actors = $show_info['actors'];

    // Add rating as post meta
    if (!empty($show_info['rating'])) {
        $rating = floatval($show_info['rating']); // Ensure it's a valid number
        update_post_meta($post_id, 'rating', $rating);
    }

    // Loop through the actors array
    foreach ($actors as $actor) {
        $actor_name = sanitize_text_field($actor['name']);
        $actor_image = esc_url($actor['img']);

        // Check if the term already exists by name
        $existing_term = get_term_by('name', $actor_name, 'actors');

        // If the term exists, use it; otherwise, create it
        if ($existing_term) {
            $term_id = $existing_term->term_id;
        } else {
            $new_term = wp_insert_term($actor_name, 'actors');
            if (is_wp_error($new_term)) {
                continue; // Skip if there's an error creating the term
            }
            $term_id = $new_term['term_id'];
        }

        // Add or update the image for the term
        update_term_meta($term_id, 'actor_image', $actor_image);

        // Assign the actor term to the post
        wp_set_object_terms($post_id, $term_id, 'actors', true);
    }
}

add_action('save_post', 'save_fetch_actors_meta_box');

function save_fetch_actors_meta_box($post_id)
{
    // Check if the current post type matches
    if (!in_array(get_post_type($post_id), ['movies', 'seriess'])) {
        return;
    }

    // Check if the nonce is set and valid
    if (!isset($_POST['fetch_actors_nonce']) || !wp_verify_nonce($_POST['fetch_actors_nonce'], 'fetch_actors_nonce_action')) {
        return;
    }

    // Prevent auto-save from triggering this function
    if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) {
        return;
    }

    // Check if the current user has permission to edit the post
    if (!current_user_can('edit_post', $post_id)) {
        return;
    }

    //save the rate if enserted manually
    update_post_meta($post_id, 'rating', $_POST['rating']);

    // Sanitize
    if (isset($_POST['show_id'])) {
        $show_id = sanitize_text_field($_POST['show_id']);
    }
    //check entered show id
    if (empty($show_id)) {
        return;
    }

    // Sanitize
    if (isset($_POST['selected_source'])) {
        $selected_source = sanitize_text_field($_POST['selected_source']);
        // update_post_meta($post_id, '_selected_source', $selected_source);
    }

    // Optional: Fetch actors and save them to the post meta
    if ($selected_source === 'imdb') {
        add_actor_rating_to_post($post_id, getRateAndActors($show_id));
    } elseif ($selected_source === 'elcinema') {
        add_actor_rating_to_post($post_id, getFromElcinema($show_id));
    }
}
