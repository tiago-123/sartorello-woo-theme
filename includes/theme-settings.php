<?php

declare(strict_types=1);
defined('ABSPATH') || exit;

// Constants
const THEME_SETTINGS_GROUP = 'sartorello_woo_theme_settings';
const THEME_SETTINGS_PAGE = 'sartorello-woo-theme-settings';

// Hooks
add_action('admin_menu', 'sartorello_woo_theme_add_admin_menu');
add_action('admin_init', 'sartorello_woo_theme_register_settings');
add_action('admin_enqueue_scripts', 'sartorello_woo_theme_enqueue_admin_scripts');

// Settings configuration
function sartorello_woo_theme_get_settings_config(): array
{
    return [
        'sartorello_woo_theme_logo' => ['sanitize' => 'absint', 'label' => 'Logo', 'type' => 'media'],
        'sartorello_woo_theme_motto' => ['sanitize' => 'sanitize_text_field', 'label' => 'Motto', 'type' => 'text'],
        'sartorello_woo_theme_email' => ['sanitize' => 'sanitize_email', 'label' => 'E-mail', 'type' => 'email'],
        'sartorello_woo_theme_whatsapp' => ['sanitize' => 'sartorello_woo_theme_sanitize_whatsapp', 'label' => 'WhatsApp', 'type' => 'text', 'description' => 'Enter only numbers (e.g., 5511987654321)'],
        'sartorello_woo_theme_facebook' => ['sanitize' => 'esc_url_raw', 'label' => 'Facebook', 'type' => 'url'],
        'sartorello_woo_theme_instagram' => ['sanitize' => 'esc_url_raw', 'label' => 'Instagram', 'type' => 'url'],
        'sartorello_woo_theme_pinterest' => ['sanitize' => 'esc_url_raw', 'label' => 'Pinterest', 'type' => 'url'],
        'sartorello_woo_theme_youtube' => ['sanitize' => 'esc_url_raw', 'label' => 'YouTube', 'type' => 'url'],
        'sartorello_woo_theme_homepage_banner' => ['sanitize' => 'absint', 'label' => 'Homepage Banner', 'type' => 'media'],
        'sartorello_woo_theme_footer_text' => ['sanitize' => 'wp_kses_post', 'label' => 'Footer Text', 'type' => 'editor'],
    ];
}

// Register settings
function sartorello_woo_theme_register_settings()
{
    foreach (sartorello_woo_theme_get_settings_config() as $option_name => $config) {
        register_setting(THEME_SETTINGS_GROUP, $option_name, ['sanitize_callback' => $config['sanitize']]);
    }
}

// Custom sanitize WhatsApp number
function sartorello_woo_theme_sanitize_whatsapp($value)
{
    if (!empty($value) && !ctype_digit($value)) {
        add_settings_error('sartorello_woo_theme_whatsapp', 'invalid_whatsapp_number', 'WhatsApp field must contain only numbers.');
        return get_option('sartorello_woo_theme_whatsapp');
    }
    return $value;
}

// Register admin menu
function sartorello_woo_theme_add_admin_menu()
{
    add_menu_page(
        'Sartorello Woo Theme Settings',
        'Theme Settings',
        'manage_options',
        THEME_SETTINGS_PAGE,
        'sartorello_woo_theme_settings_page',
        'dashicons-admin-generic'
    );
}

// Render field
function sartorello_woo_theme_render_field(string $name, array $config)
{
    $value = get_option($name);

    switch ($config['type']) {
        case 'media':
            echo '<input type="hidden" id="' . esc_attr($name) . '" name="' . esc_attr($name) . '" value="' . esc_attr($value) . '" />';
            echo '<button type="button" class="button upload-media-button" data-target="' . esc_attr($name) . '">' . __('Select image') . '</button>';
            echo '<img class="media-preview" data-field="' . esc_attr($name) . '" src="' . esc_url(wp_get_attachment_url($value)) . '" style="display:inline-block; margin-left:1rem; width:100%; max-width:200px;" />';
            break;
        case 'editor':
            wp_editor($value, $name, ['textarea_rows' => 4, 'default_editor' => 'html']);
            break;
        case 'text':
            $extra = $name === 'sartorello_woo_theme_whatsapp' ? ' inputmode="numeric" pattern="[0-9]+"' : '';
            echo '<input type="text"' . $extra . ' name="' . esc_attr($name) . '" value="' . esc_attr($value) . '" class="regular-text" />';
            if (!empty($config['description'])) {
                echo '<p class="description">' . esc_html($config['description']) . '</p>';
            }
            break;
        default:
            echo '<input type="' . esc_attr($config['type']) . '" name="' . esc_attr($name) . '" value="' . esc_attr($value) . '" class="regular-text" />';
    }
}

// Settings page
function sartorello_woo_theme_settings_page()
{
?>
    <div class="wrap">
        <h1>Theme Settings</h1>
        <?php settings_errors(); ?>
        <form method="post" action="options.php">
            <?php settings_fields(THEME_SETTINGS_GROUP); ?>
            <table class="form-table">
                <?php foreach (sartorello_woo_theme_get_settings_config() as $name => $config): ?>
                    <tr>
                        <th><?php echo esc_html($config['label']); ?></th>
                        <td><?php sartorello_woo_theme_render_field($name, $config); ?></td>
                    </tr>
                <?php endforeach; ?>
            </table>
            <?php submit_button(); ?>
        </form>
    </div>
<?php
}

// Enqueue scripts
function sartorello_woo_theme_enqueue_admin_scripts($hook)
{
    if ($hook !== 'toplevel_page_' . THEME_SETTINGS_PAGE) return;

    wp_enqueue_media();
    wp_enqueue_script('sartorello-woo-theme-admin-js', get_template_directory_uri() . '/assets/admin/js/admin.js', ['jquery'], false, true);
}
