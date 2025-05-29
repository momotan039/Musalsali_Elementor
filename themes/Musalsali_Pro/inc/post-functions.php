<?php 
// Function to get the post views count
function get_post_views($postID) {
    $count = get_post_meta($postID, 'post_views_count', true);
    return $count ? intval($count) : 0;
}

// Function to increment post views, ensuring each new user view is counted only once
function set_post_views($postID) {
    if (!is_user_logged_in()) { // Count only for guests
        // $transient_key = 'post_viewed_' . $postID . '_' . $_SERVER['REMOTE_ADDR']; // Unique per IP

        // if (!get_transient($transient_key)) { // Check if transient exists
            $count = get_post_meta($postID, 'post_views_count', true);
            $count = ($count) ? $count + 1 : 1;
            update_post_meta($postID, 'post_views_count', $count);

        //     // Set a transient for 1 minute to prevent duplicate views
        //     set_transient($transient_key, true, MINUTE_IN_SECONDS);
        // }
    }
}

// Hook into WordPress to track post views on single post pages
function track_post_views() {
    if (is_single() && !is_user_logged_in()) {
        global $post;
        set_post_views($post->ID);
    }
}
add_action('wp', 'track_post_views'); // Runs before output is sent
?>
