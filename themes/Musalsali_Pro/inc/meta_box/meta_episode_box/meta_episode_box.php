<?php
require_once('meta_episode_number.php');
require_once('meta_last_episode.php');
require_once('series_met_box.php');
// Add meta box for episode Info
function add_episode_info_meta_box() {
    add_meta_box(
        'episode_info_meta', 
        __('Episode Info','arabic-lang'), 
        'episode_info_meta_callback', 
        'episodes', 
        'side', 
        'high'
    );
}
add_action('add_meta_boxes', 'add_episode_info_meta_box');

// Meta boxs display callback
function episode_info_meta_callback($post) {
    episode_series_meta_callback($post);
    episode_number_meta_callback($post);
    last_episode_meta_callback($post);
}
?>