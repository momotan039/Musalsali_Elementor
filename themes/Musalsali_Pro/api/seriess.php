<?php 
function get_series_by_genre($request) {
    $genre_id = isset($request['id']) ? intval($request['id']) : null;
    $page = isset($request['page']) ? max(1, intval($request['page'])) : 1;
    $per_page = isset($request['per_page']) ? max(1, intval($request['per_page'])) : 10;
    $uploading_to_store =get_option('uploading_to_store');

    $args = array(
        'post_type'      => 'seriess',
        'posts_per_page' => $per_page,
        'paged'          => $page,
        'category_name'  => 'مسلسلات رمضان 2025',
    );

    if ($genre_id) {
        $args['tax_query'] = array(
            array(
                'taxonomy' => 'genres',
                'field'    => 'term_id',
                'terms'    => $genre_id,
            )
        );
    }

    $query = new WP_Query($args);
    $data = array();

    foreach ($query->posts as $post) {
        $data[] = array(
            'id'          => $post->ID,
            'name'        => $post->post_title,
            // 'description' => $post->post_content,
            'image'       => $uploading_to_store ? '' : get_the_post_thumbnail_url($post->ID),
        );
    }

    return rest_ensure_response(array(
        'series'       => $data,
        'total_pages'  => $query->max_num_pages,
        'current_page' => $page,
    ));
}

function search_series($request) {
    $page = isset($request['page']) ? max(1, intval($request['page'])) : 1;
    $per_page = isset($request['per_page']) ? max(1, intval($request['per_page'])) : 10;
    $search = isset($request['search']) ? sanitize_text_field($request['search']) : '';
    $uploading_to_store =get_option('uploading_to_store');

    $args = array(
        'post_type'      => 'seriess',
        'posts_per_page' => $per_page,
        'paged'          => $page,
        'category_name'  => 'مسلسلات رمضان 2025',
        's'              => $search
    );

    $query = new WP_Query($args);
    $data = array();

    foreach ($query->posts as $post) {
        $data[] = array(
            'id'          => $post->ID,
            'name'        => $post->post_title,
            // 'description' => $post->post_content,
            'image'       => $uploading_to_store ? '' : get_the_post_thumbnail_url($post->ID),
        );
    }

    return rest_ensure_response(array(
        'series'       => $data,
        'total_pages'  => $query->max_num_pages,
        'current_page' => $page,
    ));
}



add_action('rest_api_init', function() {
    register_rest_route('custom/v1', '/series', array(
        'methods'  => 'GET',
        'callback' => 'get_series_by_genre',
    ));
    register_rest_route('custom/v1', '/search-series', array(
        'methods'  => 'GET',
        'callback' => 'search_series', // New route for search functionality
    ));
});
?>
