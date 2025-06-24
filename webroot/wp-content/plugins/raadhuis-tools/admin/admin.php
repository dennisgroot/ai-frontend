<?php

/**
 * The admin-specific functionality of the plugin.
 *
 * @link       https://raadhuis.com
 * @since      1.0.0
 *
 * @package    Raadhuis_Tools
 * @subpackage Raadhuis_Tools/admin
 */

/**
 * The admin-specific functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the admin-specific stylesheet and JavaScript.
 *
 * @package    Raadhuis_Tools
 * @subpackage Raadhuis_Tools/admin
 * @author     Raadhuis <online@raadhuis.com>
 */
class Raadhuis_Tools_Admin
{

    /**
     * The ID of this plugin.
     *
     * @since    1.0.0
     * @access   private
     * @var      string    $plugin_name    The ID of this plugin.
     */
    private $plugin_name;

    /**
     * The version of this plugin.
     *
     * @since    1.0.0
     * @access   private
     * @var      string    $version    The current version of this plugin.
     */
    private $version;

    /**
     * Initialize the class and set its properties.
     *
     * @since    1.0.0
     * @param      string    $plugin_name       The name of this plugin.
     * @param      string    $version    The version of this plugin.
     */
    public function __construct($plugin_name, $version)
    {

        $this->plugin_name = $plugin_name;
        $this->version = $version;
    }

    /**
     * Register the stylesheets for the admin area.
     *
     * @since    1.0.0
     */
    public function enqueue_styles()
    {
        // $current_screen = get_current_screen();

        // if ($current_screen->base === 'toplevel_page_raadhuis-tools') {
        wp_enqueue_style($this->plugin_name . '-admin-css', plugin_dir_url(__FILE__) . 'dist/css/admin.css', [], $this->version, 'all');
        // }
    }

    /**
     * Register the JavaScript for the admin area.
     *
     * @since    1.0.0
     */
    public function enqueue_scripts()
    {
        // $current_screen = get_current_screen();

        wp_enqueue_script($this->plugin_name . '-admin-js', plugin_dir_url(__FILE__) . 'dist/js/admin.js', array('jquery'), $this->version, array(
            'strategy' => 'defer',
        ));
        wp_localize_script($this->plugin_name . '-admin-js', 'raadhuis_tools_ajax_vars', array(
            'nonce' => wp_create_nonce('raadhuis_tools_nonce'),
            'ajaxurl' => admin_url('admin-ajax.php')
        ));
    }

    // public function raadhuis_tools_menu()
    // {
    //     add_options_page(
    //         'Raadhuis Tools',
    //         'Raadhuis Tools',
    //         'manage_options',
    //         'raadhuis-tools',
    //         array($this, 'raadhuis_tools_dashboard'),
    //         'dashicons-raadhuis-tools'
    //     );
    // }

    // public function raadhuis_tools_dashboard()
    // {
    //     require_once plugin_dir_path(__FILE__) . 'partials/admin-display.php';
    // }

    public function raadhuis_tools_add_settings_plugin_action_link($links, $plugin_file)
    {

        // Controleer of de link wordt toegevoegd aan de juiste plugin
        if ($plugin_file === 'raadhuis-tools-v2/raadhuis-tools.php') {
            // Voeg de aangepaste link toe aan de links-array
            $custom_link = array(
                'settings' => '<a href="' . admin_url('options-general.php?page=raadhuis-tools') . '">Instellingen</a>'
            );

            // Plaats de aangepaste link rechts van de deactiveerlink
            $position = array_search('deactivate', array_keys($links)) + 1;
            array_splice($links, $position, 0, $custom_link);
        }

        return $links;
    }

    public function str($value)
    {
        return __($value, RAADHUIS_TOOLS_TRANSLATION_GROUP);
    }

    /**
     * Disable default dashboard widgets
     */
    public function disableDefaultDashboardWidgets()
    {
        remove_meta_box('dashboard_primary', 'dashboard', 'core');                      // WordPress news
        remove_meta_box('dashboard_activity', 'dashboard', 'core');                     // Activities
        remove_meta_box('dashboard_incoming_links', 'dashboard', 'core');               // Incoming links
        remove_meta_box('dashboard_plugins', 'dashboard', 'core');                      // Plugin news
        remove_meta_box('dashboard_quick_press', 'dashboard', 'core');                  // QuickPress
        remove_meta_box('icl_dashboard_widget', 'dashboard', 'side');                   // WPML
        remove_meta_box('mandrill_widget', 'dashboard', 'side');                        // Mandrill
        remove_action('welcome_panel', 'wp_welcome_panel');                             // Welcome

        // Removing plugin dashboard boxes
        remove_meta_box('yoast_db_widget', 'dashboard', 'normal');                      // Yoast's SEO plugin widget
    }

    /**
     * Remove subpages that don't need to be displayed
     */
    public function removeSubmenuPages()
    {
        $user_id = get_current_user_id();

        if ($user_id == false) {
            return false;
        }

        if ($user_id != '1') {
            remove_submenu_page('themes.php', 'themes.php');
            remove_submenu_page('themes.php', 'theme-editor.php');
        }
    }

    // Load ACF options page
    public function loadACFoptions()
    {
        if (function_exists('acf_add_local_field_group')) :

            acf_add_local_field_group(array(
                'key' => 'group_611a80f401736',
                'title' => 'Raadhuis',
                'fields' => array(
                    array(
                        'key' => 'field_611a8389630e8',
                        'label' => 'Scripts',
                        'name' => '',
                        'aria-label' => '',
                        'type' => 'tab',
                        'instructions' => '',
                        'required' => 0,
                        'conditional_logic' => 0,
                        'wrapper' => array(
                            'width' => '',
                            'class' => '',
                            'id' => '',
                        ),
                        'placement' => 'left',
                        'endpoint' => 0,
                    ),
                    array(
                        'key' => 'field_611a839d630e9',
                        'label' => 'Head scripts',
                        'name' => 'head_scripts',
                        'aria-label' => '',
                        'type' => 'textarea',
                        'instructions' => '',
                        'required' => 0,
                        'conditional_logic' => 0,
                        'wrapper' => array(
                            'width' => '',
                            'class' => '',
                            'id' => '',
                        ),
                        'default_value' => '',
                        'placeholder' => '',
                        'maxlength' => '',
                        'rows' => '',
                        'new_lines' => '',
                    ),
                    array(
                        'key' => 'field_611a872d2210d',
                        'label' => 'Body scripts',
                        'name' => 'body_scripts',
                        'aria-label' => '',
                        'type' => 'textarea',
                        'instructions' => '',
                        'required' => 0,
                        'conditional_logic' => 0,
                        'wrapper' => array(
                            'width' => '',
                            'class' => '',
                            'id' => '',
                        ),
                        'default_value' => '',
                        'placeholder' => '',
                        'maxlength' => '',
                        'rows' => '',
                        'new_lines' => '',
                    ),
                    array(
                        'key' => 'field_611a83ae630ea',
                        'label' => 'Footer scripts',
                        'name' => 'footer_scripts',
                        'aria-label' => '',
                        'type' => 'textarea',
                        'instructions' => '',
                        'required' => 0,
                        'conditional_logic' => 0,
                        'wrapper' => array(
                            'width' => '',
                            'class' => '',
                            'id' => '',
                        ),
                        'default_value' => '',
                        'placeholder' => '',
                        'maxlength' => '',
                        'rows' => '',
                        'new_lines' => '',
                    ),
                    // array(
                    //     'key' => 'field_63f78b6174192',
                    //     'label' => 'Front-end tools',
                    //     'name' => '',
                    //     'aria-label' => '',
                    //     'type' => 'tab',
                    //     'instructions' => '',
                    //     'required' => 0,
                    //     'conditional_logic' => 0,
                    //     'wrapper' => array(
                    //         'width' => '',
                    //         'class' => '',
                    //         'id' => '',
                    //     ),
                    //     'placement' => 'top',
                    //     'endpoint' => 0,
                    // ),
                    // array(
                    //     'key' => 'field_63f8bf1f9facb',
                    //     'label' => 'Back-end tools',
                    //     'name' => '',
                    //     'aria-label' => '',
                    //     'type' => 'tab',
                    //     'instructions' => '',
                    //     'required' => 0,
                    //     'conditional_logic' => 0,
                    //     'wrapper' => array(
                    //         'width' => '',
                    //         'class' => '',
                    //         'id' => '',
                    //     ),
                    //     'placement' => 'top',
                    //     'endpoint' => 0,
                    // ),
                ),
                'location' => array(
                    array(
                        array(
                            'param' => 'options_page',
                            'operator' => '==',
                            'value' => 'raadhuis-tools',
                        ),
                    ),
                ),
                'menu_order' => 0,
                'position' => 'normal',
                'style' => 'default',
                'label_placement' => 'top',
                'instruction_placement' => 'label',
                'hide_on_screen' => '',
                'active' => true,
                'description' => 'Handige scripts en functie voor websites van Raadhuis.',
                'show_in_rest' => 1,
            ));

        endif;
    }

    /**
     * Shorthand for var_dump variable. Dumps all data of given string/array
     */
    public function vd($value)
    {
        var_dump($value);
    }

    /**
     * Shorthand for var_dump variable. Dumps all data of given string/array in a readable way
     */
    public function pr($value)
    {
        echo '<pre>';
        print_r($value);
        echo '</pre>';
    }

    /**
     * Add a define rule to wp-config.php if site development environment and WP_ENVIRONMENT_TYPE is not already defined.
     *
     * @return void
     */
    public function setEnvironmentType()
    {

        // Check if WP_ENVIRONMENT_TYPE is already defined
        if (defined('WP_ENVIRONMENT_TYPE')) {
            return; // Exit if already defined
        }

        $localExtentions = array('test', 'local'); // List of local domains
        // $developmentExtentions = array('raadhuis.com'); // List of development domains
        $stagingExtentions = array('raadhuis.com'); // List of staging domains
        $extension = pathinfo($_SERVER['SERVER_NAME'], PATHINFO_EXTENSION);

        // Check if the current domain is in the list of staging domains

        // Local
        if (in_array($extension, $localExtentions)) {
            define('WP_ENVIRONMENT_TYPE', 'local');
            return;
        }

        // Developement
        // elseif (in_array($extension, $developmentExtentions)) {
        //     define('WP_ENVIRONMENT_TYPE', 'development');
        //     return;
        // } 

        // Staging
        elseif (in_array($extension, $stagingExtentions)) {
            define('WP_ENVIRONMENT_TYPE', 'staging');
            return;
        }

        // Set production environment if extention is not staging, development or local
        define('WP_ENVIRONMENT_TYPE', 'production');
    }

    function developmentNotice_admin_bar($admin_bar)
    {
        $env = wp_get_environment_type(); // production or development

        if ($env === 'staging' && !current_user_can('administrator')) {
            $icon = '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512" width="16" height="16" style="vertical-align: middle; margin-right: 5px;"><path fill="#FFFFFF" d="M256 512A256 256 0 1 0 256 0a256 256 0 1 0 0 512zM216 336h24V272H216c-13.3 0-24-10.7-24-24s10.7-24 24-24h48c13.3 0 24 10.7 24 24v88h8c13.3 0 24 10.7 24 24s-10.7 24-24 24H216c-13.3 0-24-10.7-24-24s10.7-24 24-24zm40-208a32 32 0 1 1 0 64 32 32 0 1 1 0-64z"/></svg>';

            // Run admin bar code here. Will run on both frontend and backend.
            $admin_bar->add_menu(
                array(
                    'id'    => 'staging-omgeving',
                    'title' => $icon . 'Staging omgeving',
                    'parent'  => false, // Indicator only
                    'href'  => false, // Indicator only
                    'meta'  => array(
                        'class' => 'staging-omgeving',
                        'title' => 'Staging omgeving',
                    ),
                )
            );
        }
    }

    /**
     * Deactivate plugins if development site
     *
     * @return string Deactivate plugin
     */
    public function deactivatePlugins()
    {
        $env = wp_get_environment_type(); // production or development

        $plugins_array = array(
            '/wp-rocket/wp-rocket.php', // WP Rocket
            '/wp-rocket-cache-rest-api/wp-rocket-cache-rest-api.php', // WP Rocket Cache REST API
            '/backupbuddy/backupbuddy.php', // BackupBuddy
            '/malcare-security/malcare.php', // Malcare Security
            '/worker/init.php', // ManageWP (worker)
        );


        if ($env === 'development') {
            deactivate_plugins($plugins_array);
        }
    }

    /**
     * Add no-index if is development/staging environment or local environment
     *
     * @return string Deactivate plugin
     */
    public function noIndexAdmin()
    {

        $env = wp_get_environment_type(); // production or development

        if ($env === 'development') {
            update_option('blog_public', 0);
        }
    }

    /**
     * Custom admin footer
     *
     * @return string Text with links
     */
    public function customAdminFooter($text)
    {
        $text = '<span id="footer-thankyou">';
        $text .= __('Ontwikkeld door ', 'raadhuis-tools');
        $text .= '<a href="https://raadhuis.com/" target="_blank">Raadhuis</a>&nbsp;';
        $text .= __('Hulp nodig? Mail naar ', 'raadhuis-tools');
        $text .= '<a href="mailto:online@raadhuis.com">online@raadhuis.com</a></span>.';

        return $text;
    }

    /**
     * Adds a new admin dashboard color scheme
     */
    public function additionalAdminColorSchemes()
    {
        wp_admin_css_color(
            'Raadhuis',
            __('Raadhuis', 'raadhuis'),
            plugins_url('raadhuis-tools/dist/css/raadhuis-tools-admin.css'),
            array('#191919', '#4310E8', '#f4f4f4', '#ffffff')
        );
    }

    /**
     * No WordPress plugin auto-updates. Use with management plugin.
     */
    public function auto_update_plugin()
    {
        return false;
    }

    /**
     * No WordPress theme auto-updates. Use with management plugin.
     */
    public function auto_update_theme()
    {
        return false;
    }

    /**
     * Set the default admin dashboard color
     *
     * @param string $user_id User id
     */
    public function setDefaultAdminColor($user_id)
    {
        $args = array(
            'ID' => $user_id,
            'admin_color' => 'Raadhuis',
        );

        wp_update_user($args);
    }

    /**
     * Change the default dashboard color
     *
     * @param  [type] $result [description]
     * @return string Theme name
     */
    public function changeDashboardColor($result)
    {
        return 'Raadhuis';
    }

    /**
     * Hide update notices from users except Raadhuis users
     *
     * @return [type] [description]
     */
    public function hideUpdateNotices()
    {
        if (!current_user_can('administrator')) {
            remove_action('admin_notices', 'update_nag', 3);
        }
    }

    /**
     * Checks current user email if it's Raadhuis
     *
     * @return [type] [description]
     */
    // public function checkCurrentUserEmail()
    // {
    //     $current_user = wp_get_current_user();

    //     if (!$current_user->exists()) {
    //         return false;
    //     }

    //     $email = explode('@', $current_user->user_email);

    //     if ($email[1] === 'raadhuis.com') {
    //         return true;
    //     }

    //     return false;
    // }

    public function addACFoptionsPage()
    {
        if (function_exists('acf_add_options_page')) {
            acf_add_options_page(array(
                'post_id'           => 'raadhuis-tools',
                'page_title'        => __('Raadhuis tools', 'raadhuis-tools'),
                'menu_title'        => __('Raadhuis', 'raadhuis-tools'),
                'menu_slug'         => 'raadhuis-tools',
                'capability'        => 'edit_posts',
                'redirect'          => false,
                'position'          => 999,
                'parent_slug'       => 'options-general.php', // Toevoegen onder "Instellingen".
                'icon_url'          => 'data:image/svg+xml;base64,' . base64_encode('<svg fill="none" height="40" viewBox="0 0 271 270" width="40" xmlns="http://www.w3.org/2000/svg"><g fill="#000"><path d="m.5 0v90h90v-90z"/><path d="m90.5 90v90h90v-90z"/><path d="m90.5 45c0 24.853 20.147 45 45 45s45-20.147 45-45-20.147-45-45-45-45 20.147-45 45z"/><path d="m.5 180v90h90v-90z"/><path d="m180.5 32.5928v90.0002h90v-90.0002z"/><path d="m90.5 180v90h90v-90z"/><path d="m.5 90v90h90v-90z"/><path d="m180.5 180v90h90v-90z"/></g></svg>'),
            ));
        }
    }

    // Set ACF 5 license key
    public function autoSetLicenseKeys()
    {
        // Check if ACF is running
        if (is_plugin_active('advanced-custom-fields-pro/acf.php')) {
            // Check if ACF License is not empty
            if (get_option('acf_pro_license') != '') {
                return;
            }

            // Check if constant is defined
            if (defined('ACF_PRO_LICENSE') == false) {
                return;
            }

            // Check if constant is not empty
            if (defined('ACF_PRO_LICENSE') != '') {
                return;
            }

            // Loads ACF plugin
            include_once ABSPATH . 'wp-content/plugins/advanced-custom-fields-pro/acf.php';

            // Connect
            $post = array(
                'acf_license' => ACF_PRO_LICENSE,
                'acf_version' => acf_get_setting('version'),
                'wp_name' => get_bloginfo('name'),
                'wp_url' => home_url(),
                'wp_version' => get_bloginfo('version'),
                'wp_language' => get_bloginfo('language'),
                'wp_timezone' => get_option('timezone_string'),
            );

            // Connect
            $response = acf_updates()->request('v2/plugins/activate?p=pro', $post);

            // Ensure response is expected JSON array (not string)
            if (is_string($response)) {
                $response = new WP_Error('server_error', esc_html($response));
            }

            // Success
            if ($response['status'] == 1) {
                acf_pro_update_license($response['license']); // Update license
            }

            // Show message
            echo '<div class="notice notice-success is-dismissible"><p>' . __($response['message'], 'Raadhuis') . '</p></div>';
        } else {
            // Show message if ACF is not active
            echo '<div class="notice error is-dismissible"><p>';
            _e('Advanced Custom Fields Pro is vereist om de Raadhuis - Tools plugin te laten functioneren.', 'raadhuis-tools');
            echo '</p></div>';
        }
    }

    // Yoast block
    public function wpSeoMetaboxPriority()
    {
        return 'low'; // Accepts 'high', 'default', 'low'.
    }

    // Disable Fullscreen Mode Gutenberg
    public function disableEditorFullscreenByDefault()
    {
        $script = "window.onload = function() { const isFullscreenMode = wp.data.select( 'core/edit-post' ).isFeatureActive( 'fullscreenMode' ); if ( isFullscreenMode ) { wp.data.dispatch( 'core/edit-post' ).toggleFeature( 'fullscreenMode' ); } }";

        wp_add_inline_script('wp-blocks', $script);
    }

    // Add capabilities to the editor user role
    public function editorRoleCapabilities()
    {
        $role = get_role('editor');

        // Inclusief de plugin.php bibliotheek als deze nog niet is geladen
        if (!function_exists('is_plugin_active')) {
            include_once(ABSPATH . 'wp-admin/includes/plugin.php');
        }

        // WordPress - Users
        $role->add_cap('add_users', true);
        $role->add_cap('create_users', true);
        $role->add_cap('promote_users', true);
        $role->add_cap('delete_users', true);
        $role->add_cap('list_users', true);
        $role->add_cap('edit_users', true);

        // WordPress - Appearance
        $role->add_cap('edit_theme_options', true);

        // Rank Math SEO
        if (is_plugin_active('seo-by-rank-math/rank-math.php')) {
            // $role->add_cap('rank_math_titles', true);
            $role->add_cap('rank_math_404_monitor', true);
            $role->add_cap('rank_math_redirections', true);
        }

        // Object Cache (Pro)
        // TODO: Testen op Cloudways server:
        if (is_plugin_active('object-cache-pro/object-cache-pro.php')) {
            $role->add_cap('manage_cache', true); // Vervang 'manage_cache' door de juiste capability indien anders
        }

        if (is_plugin_active('fluentformpro/fluentformpro.php') || is_plugin_active('fluentform/fluentform.php')) {
            $role->add_cap('fluentform_create_forms', true);
            $role->add_cap('fluentform_dashboard_access', true);
            $role->add_cap('fluentform_edit_forms', true);
            $role->add_cap('fluentform_entries_viewer', true);
            $role->add_cap('fluentform_forms_manager', true);
            // $role->add_cap('fluentform_full_access', true);
            // $role->add_cap('fluentform_manage_entries', true);
            // $role->add_cap('fluentform_manage_payments', true);
            // $role->add_cap('fluentform_settings_manager', true);
            // $role->add_cap('fluentform_view_payments', true);
        }

        // AdRotate (PRO)
        if (is_plugin_active('adrotate-pro/adrotate-pro.php') || is_plugin_active('adrotate/adrotate.php')) {
            $role->add_cap('adrotate_ad_delete', true);
            $role->add_cap('adrotate_ad_manage', true);
            $role->add_cap('adrotate_advertiser', true);
            $role->add_cap('adrotate_advertiser_manage', true);
            $role->add_cap('adrotate_global_report', true);
            $role->add_cap('adrotate_group_delete', true);
            $role->add_cap('adrotate_group_manage', true);
            $role->add_cap('adrotate_moderate', true);
            $role->add_cap('adrotate_moderate_approve', true);
            $role->add_cap('adrotate_schedule_delete', true);
            $role->add_cap('adrotate_schedule_manage', true);
        }

        // Gravity Forms
        if (is_plugin_active('gravityforms/gravityforms.php')) {
            $role->add_cap('gravityforms_create_form', true);
            $role->add_cap('gravityforms_delete_forms', true);
            $role->add_cap('gravityforms_edit_forms', true);
            $role->add_cap('gravityforms_view_entries', true);
            $role->add_cap('gravityforms_view_entry_notes', true);
            $role->add_cap('gravityforms_edit_entries', true);
            $role->add_cap('gravityforms_edit_entry_notes', true);
            $role->add_cap('gravityforms_export_entries', true);
            $role->add_cap('gravityforms_delete_entries', true);
        }

        // Mailster
        if (is_plugin_active('mailster/mailster.php')) { // Pas de plugin pad aan indien nodig
            $role->add_cap('delete_newsletters', true);
            $role->add_cap('delete_others_newsletters', true);
            $role->add_cap('delete_private_newsletters', true);
            $role->add_cap('delete_published_newsletters', true);
            $role->add_cap('edit_newsletters', true);
            $role->add_cap('edit_others_newsletters', true);
            $role->add_cap('edit_private_newsletters', true);
            $role->add_cap('edit_published_newsletters', true);
            $role->add_cap('publish_newsletters', true);
            $role->add_cap('read_private_newsletters', true);
            $role->add_cap('mailster_manage_subscribers', true);
            $role->add_cap('mailster_export_subscribers', true);
            $role->add_cap('mailster_import_subscribers', true);
            $role->add_cap('mailster_edit_subscribers', true);
            $role->add_cap('mailster_delete_subscribers', true);
            $role->add_cap('mailster_add_subscribers', true);
            $role->add_cap('mailster_bulk_delete_subscribers', true);
            $role->add_cap('mailster_add_lists', true);
            $role->add_cap('mailster_delete_lists', true);
            $role->add_cap('mailster_edit_lists', true);
            $role->add_cap('mailster_dashboard_widget', true);
        }

        // Yoast SEO (premium)
        if (is_plugin_active('wordpress-seo-premium/wp-seo-premium.php')) {
            $role->add_cap('wpseo_manage_redirects', true);
            $role->add_cap('wpseo_edit_advanced_metadata', true);
            $role->add_cap('wpseo_bulk_edit', true);
        }

        // WooCommerce
        if (is_plugin_active('woocommerce/woocommerce.php')) {
            // Voeg de capabilities toe als WooCommerce actief is
            $role->add_cap('assign_product_terms', true);
            $role->add_cap('assign_shop_coupon_terms', true);
            $role->add_cap('assign_shop_order_terms', true);
            $role->add_cap('delete_others_products', true);
            $role->add_cap('delete_others_shop_coupons', true);
            $role->add_cap('delete_others_shop_orders', true);
            $role->add_cap('delete_private_products', true);
            $role->add_cap('delete_private_shop_coupons', true);
            $role->add_cap('delete_private_shop_orders', true);
            $role->add_cap('delete_product', true);
            $role->add_cap('delete_product_terms', true);
            $role->add_cap('delete_products', true);
            $role->add_cap('delete_published_products', true);
            $role->add_cap('delete_published_shop_coupons', true);
            $role->add_cap('delete_published_shop_orders', true);
            $role->add_cap('delete_shop_coupon', true);
            $role->add_cap('delete_shop_coupon_terms', true);
            $role->add_cap('delete_shop_coupons', true);
            $role->add_cap('delete_shop_order', true);
            $role->add_cap('delete_shop_order_terms', true);
            $role->add_cap('delete_shop_orders', true);
            $role->add_cap('edit_others_products', true);
            $role->add_cap('edit_others_shop_coupons', true);
            $role->add_cap('edit_others_shop_orders', true);
            $role->add_cap('edit_private_products', true);
            $role->add_cap('edit_private_shop_coupons', true);
            $role->add_cap('edit_private_shop_orders', true);
            $role->add_cap('edit_product', true);
            $role->add_cap('edit_product_terms', true);
            $role->add_cap('edit_products', true);
            $role->add_cap('edit_published_products', true);
            $role->add_cap('edit_published_shop_coupons', true);
            $role->add_cap('edit_published_shop_orders', true);
            $role->add_cap('edit_shop_coupon', true);
            $role->add_cap('edit_shop_coupon_terms', true);
            $role->add_cap('edit_shop_coupons', true);
            $role->add_cap('edit_shop_order', true);
            $role->add_cap('edit_shop_order_terms', true);
            $role->add_cap('edit_shop_orders', true);
            $role->add_cap('manage_product_terms', true);
            $role->add_cap('manage_shop_coupon_terms', true);
            $role->add_cap('manage_shop_order_terms', true);
            $role->add_cap('manage_woocommerce', true);
            $role->add_cap('publish_products', true);
            $role->add_cap('publish_shop_coupons', true);
            $role->add_cap('publish_shop_orders', true);
            $role->add_cap('read_private_products', true);
            $role->add_cap('read_private_shop_coupons', true);
            $role->add_cap('read_private_shop_orders', true);
            $role->add_cap('read_product', true);
            $role->add_cap('read_shop_coupon', true);
            $role->add_cap('read_shop_order', true);
            $role->add_cap('view_woocommerce_reports', true);
        }

        // WP Rocket
        if (is_plugin_active('wp-rocket/wp-rocket.php')) {
            $role->add_cap('rocket_purge_cache', true);
            $role->add_cap('rocket_purge_opcache', true);
            $role->add_cap('rocket_purge_posts', true);
            $role->add_cap('rocket_purge_terms', true);
        }
    }

    // Allow editor to manage the privacy page
    public function editorManagePrivacyPage($caps, $cap, $user_id, $args)
    {
        if (!is_user_logged_in()) {
            return $caps;
        }

        $user_meta = get_userdata($user_id);
        if (array_intersect(['editor', 'administrator', 'raadhuis_editor'], $user_meta->roles)) {
            if ('manage_privacy_options' === $cap) {
                $manage_name = is_multisite() ? 'manage_network' : 'manage_options';
                $caps = array_diff($caps, [$manage_name]);
            }
        }

        return $caps;
    }

    // Allow editor to add certain users
    public function editorAddUsers($roles)
    {
        $user = wp_get_current_user();
        if (in_array('editor', $user->roles)) {
            $tmp = array_keys($roles);
            foreach ($tmp as $r) {
                if ('subscriber' == $r || 'editor' == $r || 'customer' == $r || 'contributor' == $r || 'author' == $r) continue;
                unset($roles[$r]);
            }
        }
        return $roles;
    }

    // Add a post ID column to every post type
    public function posts_columns_id($defaults)
    {
        $defaults['rh_post_id'] = __('ID');
        return $defaults;
    }

    public function posts_custom_id_columns($column_name, $id)
    {
        if ($column_name === 'rh_post_id') {
            echo '<code>' . $id . '</code>';
        }
    }

    // Add a term ID column to every taxonomy
    public function taxonomy_columns_id($columns)
    {
        $columns['raadhuis_term_id'] = 'ID';
        return $columns;
    }

    public function taxonomy_custom_id_columns($value, $column_name, $tax_id)
    {
        // var_dump($value);
        if ($column_name === 'raadhuis_term_id') {
            $value = '<code>' . $tax_id . '</code>';
        }
        return $value;
    }

    // Add a ALT text column to the media library
    public function media_columns_alt($cols)
    {
        $cols["alt"] = __('ALT tekst', 'raadhuis-tools');
        return $cols;
    }

    public function media_column_alt($column_name, $id)
    {
        if ($column_name == 'alt') {
            echo get_post_meta($id, '_wp_attachment_image_alt', true);
        }
    }
}
