<?php
// Meta box display callback
function episode_number_meta_callback($post) {
    $episode_number = get_post_meta($post->ID, '_episode_number', true);
    wp_nonce_field('episode_number_nonce', 'episode_number_nonce_field');
    ?>
    <p>
        <label for="episode_number"><?php echo __('Episode Number','arabic-lang')?></label>
        <input type="number" id="episode_number" name="episode_number" value="<?php echo esc_attr($episode_number); ?>" style="width:100%;">
    </p>
    <?php
}

// Save episode number
function save_episode_number_meta($post_id) {
    if (!isset($_POST['episode_number_nonce_field']) || !wp_verify_nonce($_POST['episode_number_nonce_field'], 'episode_number_nonce')) return;
    if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) return;
    if (!current_user_can('edit_post', $post_id)) return;

    if (isset($_POST['episode_number'])) {
        update_post_meta($post_id, '_episode_number', sanitize_text_field($_POST['episode_number']));
    }
}
add_action('save_post', 'save_episode_number_meta');

