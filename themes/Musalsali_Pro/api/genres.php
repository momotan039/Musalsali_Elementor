<?php 
function get_all_genres_optimized() {
    $terms = get_terms(array(
        'taxonomy'   => 'genres', // Custom taxonomy
        'hide_empty' => false,
    ));

    $data = array();
    foreach ($terms as $term) {
        $data[] = array(
            'id'   => $term->term_id,
            'name' => $term->name
        );
    }

    return rest_ensure_response($data);
}

add_action('rest_api_init', function() {
    register_rest_route('custom/v1', '/genres', array(
        'methods'  => 'GET',
        'callback' => 'get_all_genres_optimized',
    ));
});


?>