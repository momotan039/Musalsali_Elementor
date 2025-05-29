<?php 
// Function to get views for a specific taxonomy
function get_specific_taxonomy_views($term_id) {
    $count = get_term_meta($term_id, 'taxonomy_views_count', true);
    return $count ? $count : 0; // Return count or 0 if not set
}

// Function to increment views only for a specific taxonomy (e.g., 'category' or 'your_custom_taxonomy')
function set_specific_taxonomy_views($term_id, $current_tax,$intended_tax) {
    if (!is_user_logged_in() && $current_tax === $intended_tax) { // Replace with your taxonomy slug
        $count = get_term_meta($term_id, 'taxonomy_views_count', true);
        $count = ($count) ? $count + 1 : 1;
        update_term_meta($term_id, 'taxonomy_views_count', $count);
    }
}

// Hook into WordPress to track views only for a specific taxonomy
function track_specific_taxonomy_views() {
    if (is_tax('actors')) { // Replace with your taxonomy slug
        $term = get_queried_object();
        if ($term) {
            set_specific_taxonomy_views($term->term_id, $term->taxonomy,'actors');
        }
    }
}
add_action('wp_head', 'track_specific_taxonomy_views'); // Fires when the specific taxonomy page loads
?>