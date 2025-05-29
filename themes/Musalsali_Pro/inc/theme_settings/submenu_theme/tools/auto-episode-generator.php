<?php
require_once get_stylesheet_directory() . '/inc/theme_settings/submenu_theme/tools/scrap-vedios-urls.php';

add_action('admin_menu', function () {
    add_submenu_page(
        'theme-settings',
        'Episode Generator',
        'Episode Generator',
        'manage_options',
        'episode-generator',
        'render_episode_generator'
    );
});

function render_episode_generator()
{
    if (isset($_POST['generate_episodes'])) {
        $from = intval($_POST['from_episode']);
        $to = intval($_POST['to_episode']);
        $title_base = sanitize_text_field($_POST['episode_title']);
        $series_id = intval($_POST['series_id']);
        $scrap_method = sanitize_text_field($_POST['scrap_method']);
        $external_urls_json = stripslashes(trim($_POST['external_urls_json']));
        $external_urls = json_decode($external_urls_json, true);

        for ($i = $from; $i <= $to; $i++) {
            $video_sources = [];
            $index = $i - 1;

            if (isset($external_urls[$index])) {
                if ($scrap_method === 'bresteeg') {
                    $video_sources = ScrappingVediosUrls::getUrlsFromBresteeg($external_urls[$index]);
                } elseif ($scrap_method === 'cimaobas') {
                    $video_sources = ScrappingVediosUrls::getUrlsFromCimaobas($external_urls[$index]);
                }
                elseif ($scrap_method === 'cimaclub') {
                    $video_sources = ScrappingVediosUrls::getUrlsFromCimaClub($external_urls[$index]);
                }
            }
            $post_id = wp_insert_post([
                'post_title'   => $title_base . ' ' . $i,
                'post_type'    => 'episodes',
                'post_status'  => 'publish',
                'post_date'    => date('Y-m-d H:i:s', strtotime("+{$i} seconds")),
            ]);

            if ($post_id) {
                update_post_meta($post_id, '_episode_series', $series_id);
                update_post_meta($post_id, '_episode_number', $i);
                update_post_meta($post_id, 'video_sources', $video_sources);
            }
        }
        echo '<div class="updated"><p>Episodes generated!</p></div>';
    }
?>
    <div class="wrap">
        <h1>Auto Episode Generator</h1>
        <form method="post">
            <table class="form-table">
                <tr>
                    <th><label>From Episode</label></th>
                    <td><input type="number" name="from_episode" required></td>
                </tr>
                <tr>
                    <th><label>To Episode</label></th>
                    <td><input type="number" name="to_episode" required></td>
                </tr>
                <tr>
                    <th><label>Episode Title</label></th>
                    <td><input type="text" name="episode_title" placeholder="Episode" required></td>
                </tr>
                <tr>
                    <th><label>Series ID</label></th>
                    <td><input type="number" name="series_id" required></td>
                </tr>
                <tr>
                    <th><label>External URLs (JSON format)</label></th>
                    <td><textarea name="external_urls_json" rows="5" cols="60" placeholder='[ "https://...", "https://..." ]'></textarea></td>
                </tr>
                <tr>
                    <th><label>Scraping Method</label></th>
                    <td>
                        <label><input type="radio" name="scrap_method" value="bresteeg" checked> Bresteeg</label><br>
                        <label><input type="radio" name="scrap_method" value="cimaobas"> Cimaobas</label><br>
                        <label><input type="radio" name="scrap_method" value="cimaclub"> CimaClub</label>
                    </td>
                </tr>
            </table>
            <p><input type="submit" name="generate_episodes" class="button button-primary" value="Generate Episodes"></p>
        </form>
    </div>
<?php
}
?>
