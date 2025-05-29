<?php

// Meta box display callback
function last_episode_meta_callback($post) {
    $is_last_episode = get_post_meta($post->ID, '_last_episode', true);
    wp_nonce_field('last_episode_nonce', 'last_episode_nonce_field');
    ?>
    <p>
        <input type="checkbox" id="last_episode" name="last_episode" value="1" <?php checked($is_last_episode, 1); ?>>
        <label for="last_episode"><?php echo __('Mark as Last Episode','arabic-lang')?></label>
    </p>
    <?php
}

// Save meta box value
function save_last_episode_meta($post_id) {
    if (!isset($_POST['last_episode_nonce_field']) || !wp_verify_nonce($_POST['last_episode_nonce_field'], 'last_episode_nonce')) return;
    if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) return;
    if (!current_user_can('edit_post', $post_id)) return;

    $is_last_episode = isset($_POST['last_episode']) ? 1 : 0;
    update_post_meta($post_id, '_last_episode', $is_last_episode);
}
add_action('save_post', 'save_last_episode_meta');
