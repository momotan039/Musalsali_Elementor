<?php
function maintenance_menu_settings_callback()
{
    add_submenu_page(
        'theme-settings',
        'maintenance-settings',
        __('Maintenance','arabic-lang'),
        'manage_options',
        'maintenance-settings',
        'custom_maintenance_settings_page'
    );
}
add_action('admin_menu', 'maintenance_menu_settings_callback');

function custom_maintenance_settings_page(){
   ?>
      <div class="wrap">
        <h1><?php echo __('Maintenance','arabic-lang')?></h1>
        <form method="post" action="options.php">
            <?php
            settings_fields('maintenance_settings_group');
            do_settings_sections('maintenance-settings');
            submit_button();
            ?>
        </form>
    </div>
   <?php 
}

//register fields
require_once('maintenance_menu_fields.php');
