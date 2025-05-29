<?php 
function get_episodes_by_series($request) {
    $series_id = $request['id'];

    $args = array(
        'post_type' => 'episodes', // Assuming 'episode' is the post type
        'meta_query' => array(
            array(
                'key'   => '_episode_series',
                'value' => $series_id,
                'compare' => '='
            )
        ),
        'posts_per_page' => -1
    );

    $episodes = get_posts($args);
    $data = array();

    foreach ($episodes as $episode) {
        $data[] = array(
            'id'    => $episode->ID,
            'name'  => 'الحلقة '.get_post_meta($episode->ID,'_episode_number',true)
        );
    }

    return rest_ensure_response($data);
}

function get_video_sources_by_episode($request) {
    $episode_id = $request['id'];

    // Get video sources meta field (assuming it's an array of objects)
    $video_sources = get_post_meta($episode_id, 'video_sources', true);

    // Ensure it's an array
    if (!is_array($video_sources)) {
        $video_sources = [];
    }

    return rest_ensure_response($video_sources);
}


add_action('rest_api_init', function() {
    register_rest_route('custom/v1', '/episodes/(?P<id>\d+)', array(
        'methods'  => 'GET',
        'callback' => 'get_episodes_by_series',
    ));
    register_rest_route('custom/v1', '/episode-videos/(?P<id>\d+)', array(
        'methods'  => 'GET',
        'callback' => 'get_video_sources_by_episode',
    ));
});
?>