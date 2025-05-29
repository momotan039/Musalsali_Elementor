<?php
 //create a custom taxonomy name season_seriess
 add_action('init', 'create_season_seriess_taxonomy', 0);
 function create_season_seriess_taxonomy()
 {
    $labels1 = array(
        'name'              => __('Season Series',  'arabic-lang'),
        'singular_name'     => __('Season Series',  'arabic-lang'),
        'search_items'      => __('Search Season Series', 'arabic-lang'),
        'all_items'         => __('All Season Series', 'arabic-lang'),
        'parent_item'       => __('Parent Season Series', 'arabic-lang'),
        'parent_item_colon' => __('Parent Season Series:', 'arabic-lang'),
        'edit_item'         => __('Edit Season Series', 'arabic-lang'),
        'update_item'       => __('Update Season Series', 'arabic-lang'),
        'add_new_item'      => __('Add New Season Series', 'arabic-lang'),
        'new_item_name'     => __('New Season Series Name', 'arabic-lang'),
        'menu_name'         => __('Season Series', 'arabic-lang'),
    );
    

     // taxonomy register
     register_taxonomy('season_series', array("seriess"), array(
         'hierarchical' => true,
         'labels' => $labels1,
         'show_ui' => true,
         'show_admin_column' => true,
         'query_var' => true,
         'rewrite' => array('slug' => 'season_series'),
     ));
 }
?>