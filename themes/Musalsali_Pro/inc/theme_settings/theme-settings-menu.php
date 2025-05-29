<?php
// Prevent direct access
if (!defined('ABSPATH')) {
    exit;
}

// Add Theme Settings page in the Admin menu
function custom_theme_settings_menu()
{
    add_menu_page(
        __('Theme Settings', 'arabic-lang'),
        __('Theme Settings', 'arabic-lang'),
        'manage_options',        // Capability
        'theme-settings',        // Menu slug
        'custom_theme_settings_page', // Callback function
        '', // Icon
        1 // Position in menu
    );
}
add_action('admin_menu', 'custom_theme_settings_menu');

// Callback function for the settings page
function custom_theme_settings_page()
{
?>
    <div class="wrap">
        <h1><?php echo __('Theme Settings','arabic-lang')?></h1>

        <!-- ✅ Success Message (Only Shows If Reset Is Triggered) -->
        <?php if (isset($_GET['reset']) && $_GET['reset'] === 'true') : ?>
            <div class="notice notice-success is-dismissible">
                <p><strong>Theme settings have been reset to default values.</strong></p>
            </div>
        <?php endif; ?>

        <form method="post" action="options.php">
            <?php
            settings_fields('theme_settings_group');
            do_settings_sections('theme-settings');
            submit_button();
            ?>
        </form>

        <!-- Reset Button -->
        <form method="post" action="">
            <input type="hidden" name="reset_theme_settings" value="1">
            <?php submit_button(__('Reset Settings','arabic-lang'), 'secondary'); ?>
        </form>

    </div>
<?php
    // Handle Reset Action
    if (isset($_POST['reset_theme_settings'])) {
        custom_reset_theme_settings();
        echo '<div class="updated notice"><p>✅ Settings saved successfully!</p></div>';
    }
}

// Add the WordPress Media Uploader script to handle image selection.
// --This ensures the media uploader loads only on the "Theme Settings" page
function custom_theme_settings_scripts()
{
    wp_enqueue_media(); // Load WP Media Uploader
    wp_enqueue_script('theme-settings-js', get_stylesheet_directory_uri() . '/inc/theme_settings/theme-settings.js', array('jquery'), null, true);
}
add_action('admin_enqueue_scripts', 'custom_theme_settings_scripts');
