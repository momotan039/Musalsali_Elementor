<?php
function tmdb_menu_settings_callback()
{
    add_submenu_page(
        'theme-settings',
        'tmdb-settings',
        __('TMDB','arabic-lang'),
        'manage_options',
        'tmdb-settings',
        'custom_tmdb_settings_page'
    );
}
add_action('admin_menu', 'tmdb_menu_settings_callback');

function custom_tmdb_settings_page(){
   ?>
      <div class="wrap">
        <h1><?php echo __('TMDB Settings','arabic-lang')?></h1>
        <form method="post" action="options.php">
            <?php
            settings_fields('tmdb_settings_group');
            do_settings_sections('tmdb-settings');
            submit_button();
            ?>
        </form>
    </div>
   <?php 
}

//register fields
require_once('tmdb_menu_fields.php');
