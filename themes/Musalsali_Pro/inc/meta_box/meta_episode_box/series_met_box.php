<?php

// Callback function to render the meta box
function episode_series_meta_callback($post) {
    // Add a nonce field for security
    wp_nonce_field('episode_series_nonce', 'episode_series_nonce_field');

    // Retrieve the currently selected series (if any)
    $selected_series = get_post_meta($post->ID, '_episode_series', true);
    
    // Create a select field with an empty option (populated dynamically)
    echo '<select id="episode_series" name="episode_series" style="width:100%;">';
    
    // If there's an existing selection, display it
    if ($selected_series) {
        $series_title = get_the_title($selected_series);
        echo "<option value='$selected_series' selected>$series_title</option>";
    }
    echo '</select>';
    
    // JavaScript to initialize Select2 with AJAX search functionality
    echo '<script>
        jQuery(document).ready(function($) {
            $("#episode_series").select2({
                ajax: {
                    url: "' . admin_url('admin-ajax.php') . '", // WordPress AJAX URL
                    dataType: "json",
                    data: function (params) {
                        return { action: "search_series", search: params.term }; // Pass search term
                    },
                    processResults: function (data) {
                        return { results: data }; // Format response data for Select2
                    }
                },
                minimumInputLength: 1 // Require at least one character to start searching
            });
        });
    </script>';
    
    // Enqueue Select2 script and styles
    wp_enqueue_script('select2-js', 'https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/js/select2.min.js', array('jquery'), null, true);
    wp_enqueue_style('select2-css', 'https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/css/select2.min.css');
}

// Save the selected series when the post is saved
function save_episode_series_meta($post_id) {
    // Verify nonce for security
    if (!isset($_POST['episode_series_nonce_field']) || !wp_verify_nonce($_POST['episode_series_nonce_field'], 'episode_series_nonce')) return;

    // Prevent auto-save from interfering
    if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) return;

    // Check user permissions
    if (!current_user_can('edit_post', $post_id)) return;
    
    // Save the selected series ID as post meta
    if (isset($_POST['episode_series'])) {
        update_post_meta($post_id, '_episode_series', sanitize_text_field($_POST['episode_series']));
    }
}
add_action('save_post', 'save_episode_series_meta');

// AJAX handler to search for series dynamically
function search_series_ajax() {
    // Get the search query
    $search = isset($_GET['search']) ? sanitize_text_field($_GET['search']) : '';

    // Query for series posts matching the search term
    $query = new WP_Query([
        'post_type' => 'seriess', // Assuming 'series' is the post type for series
        'posts_per_page' => 10, // Limit results
        's' => $search // Search query
    ]);

    $results = [];

    // Loop through results and format them for Select2
    while ($query->have_posts()) {
        $query->the_post();
        $results[] = [
            'id' => get_the_ID(),
            'text' => get_the_title()
        ];
    }
    wp_reset_postdata();

    // Send JSON response
    wp_send_json($results);
}
add_action('wp_ajax_search_series', 'search_series_ajax'); // Register AJAX action for logged-in users

?>