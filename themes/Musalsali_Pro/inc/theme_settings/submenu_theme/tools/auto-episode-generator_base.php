<?php
add_action('admin_menu', function () {
    add_submenu_page(
        'theme-settings', // or replace with your actual theme settings slug
        'Episode Generator',
        'Episode Generator',
        'manage_options',
        'episode-generator',
        'render_episode_generator'
    );
});

function render_episode_generator() {
    if (isset($_POST['generate_episodes'])) {
        $from = intval($_POST['from_episode']);
        $to = intval($_POST['to_episode']);
        $title_base = sanitize_text_field($_POST['episode_title']);
        $series_id = intval($_POST['series_id']);

        for ($i = $from; $i <= $to; $i++) {
        $date = date('Y-m-d H:i:s', strtotime("+{$i} seconds")); // slight difference per post
            $post_id = wp_insert_post([
                'post_title'   => $title_base . ' ' . $i,
                'post_type'    => 'episodes',
                'post_status'  => 'publish',
                'post_date'    => $date,

            ]);

            if ($post_id) {
                update_post_meta($post_id, '_episode_series', $series_id);
                update_post_meta($post_id, '_episode_number', $i);
            }
        }

        echo '<div class="updated"><p>Episodes generated!</p></div>';
    }
    ?>
    <div class="wrap">
        <h1>Auto Episode Generator</h1>
        <form method="post">
            <table class="form-table">
                <tr><th><label>From Episode</label></th><td><input type="number" name="from_episode" required></td></tr>
                <tr><th><label>To Episode</label></th><td><input type="number" name="to_episode" required></td></tr>
                <tr><th><label>Episode Title</label></th><td><input type="text" name="episode_title" placeholder="Episode" required></td></tr>
                <tr><th><label>Series ID</label></th><td><input type="number" name="series_id" required></td></tr>
            </table>
            <p><input type="submit" name="generate_episodes" class="button button-primary" value="Generate Episodes"></p>
        </form>
    </div>
    <?php
}


?>