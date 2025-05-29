<?php 
// Hook to add meta boxes
add_action('add_meta_boxes', function () {
    add_meta_box(
        'fetch_actors_rating_meta_box',
        __('Fetch Actors & Rating', 'arabic-lang'),
        'render_fetch_actors_rating_meta_box',
        array('movies','seriess'),
        'normal',
        'high'
    );
});

// Render Meta Box
function render_fetch_actors_rating_meta_box($post) {
    wp_nonce_field('fetch_actors_nonce_action', 'fetch_actors_nonce');
    ?>
    <label for="show_id"><?php _e('Enter ID (IMDb or ElCinema):', 'arabic-lang'); ?></label>
    <input type="text" id="show_id" name="show_id" class="widefat" placeholder="e.g., tt1234567 or 12345">

    <label for="selected_source"><?php _e('Select Source:', 'arabic-lang'); ?></label>
    <select id="selected_source" name="selected_source" class="widefat">
        <option value="imdb"><?php _e('IMDb', 'arabic-lang'); ?></option>
        <option value="elcinema"><?php _e('ElCinema', 'arabic-lang'); ?></option>
    </select>

    <label for="rating"><?php _e('Enter Rating Show', 'arabic-lang'); ?></label>
    <input type="text" id="rating" name="rating" class="widefat" value="<?php echo get_post_meta($post->ID,'rating',true)?>">
    <?php
}
?>
