    <?php
    function theme_settings_menu() {
        add_submenu_page(
            'theme-settings',       // Parent menu: "Appearance"
            'API Submenu Settings', // Page title
            'API Settings',         // Menu title
            'manage_options',       // Capability
            'api-settings',         // Menu slug
            'render_api_settings_page' // Callback function
        );
    }
    add_action('admin_menu', 'theme_settings_menu');

    function render_api_settings_page() {
        ?>
        <div class="wrap">
            <h1>API Settings</h1>
            <form method="post" action="options.php">
                <?php
                settings_fields('api_settings_group');
                do_settings_sections('api-settings');
                submit_button();
                ?>
            </form>
        </div>
        <?php
    }

    //register fields
    require_once('api_menu_fields.php');
