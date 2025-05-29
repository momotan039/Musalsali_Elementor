<?php 
// register all Hooks
require_once('inc/hooks/all_hooks.php');
// register css and js files
require_once('inc/enqueue.php');

// register theme settings files
require_once('inc/theme_settings/theme-settings.php');

// register all new custom posts type
require_once('inc/custom_post_type/all_custom_post_type.php');

// register all new taxonomies
require_once('inc/taxonomy/all_taxonomies.php');

//register all meta boxs
require_once('inc/meta_box/all_meta_boxs.php');

//register search functions
require_once('inc/search-functions.php');

//register post functions to handle counting posts views
require_once('inc/post-functions.php');

//register term functions to handle counting actors views
require_once('inc/term-functions.php');

//register api functions
require_once('api/init_api.php');

?>