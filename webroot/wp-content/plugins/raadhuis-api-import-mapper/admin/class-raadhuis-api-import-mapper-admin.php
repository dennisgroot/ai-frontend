<?php

/**
 * The admin-specific functionality of the plugin.
 *
 * @link       https://raadhuis.com
 * @since      1.0.0
 *
 * @package    Raadhuis_Api_Import_Mapper
 * @subpackage Raadhuis_Api_Import_Mapper/admin
 */

/**
 * The admin-specific functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the admin-specific stylesheet and JavaScript.
 *
 * @package    Raadhuis_Api_Import_Mapper
 * @subpackage Raadhuis_Api_Import_Mapper/admin
 * @author     Raadhuis <ict@raadhuis.com>
 */
class Raadhuis_Api_Import_Mapper_Admin
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
        wp_enqueue_style('raadhuis-api-import-mapper-admin', plugin_dir_url(__FILE__) . 'css/raadhuis-api-import-mapper-admin.css', array(), $this->version, 'all');
    }

    /**
     * Register the JavaScript for the admin area.
     *
     * @since    1.0.0
     */
    public function enqueue_scripts()
    {
        if (isset($_GET['page']) && $_GET['page'] === 'raadhuis-api-import-mapper') {
            wp_enqueue_script('tailwind', 'https://cdn.tailwindcss.com/3.4.16', [], null, true);
            wp_enqueue_script('vimeshui', 'https://unpkg.com/@vimesh/ui@0.12.9/dist/vui.js', [], null, array(
                'strategy' => 'defer'
            ));
            wp_enqueue_script('alpinejs', 'https://unpkg.com/alpinejs@3.14.8/dist/cdn.min.js', [], null, array(
                'strategy' => 'defer'
            ));
        }
        wp_enqueue_script('raadhuis-api-import-mapper-admin', plugin_dir_url(__FILE__) . 'js/raadhuis-api-import-mapper-admin.js', array('jquery'), $this->version, false);
    }

    public function add_plugin_admin_menu()
    {
        add_menu_page(
            __('Import mapper', 'raadhuis'),
            __('Import mapper', 'raadhuis'),
            'manage_options',
            'raadhuis-api-import-mapper',
            array($this, 'display_plugin_admin_interface')
        );
    }

    public function display_plugin_admin_interface()
    {
?>
        <div class="wrap">
            <h1><?php _e('Raadhuis API-import mapper', 'raadhuis'); ?></h1>
            <?php include_once(WP_PLUGIN_DIR . '/raadhuis-api-import-mapper/admin/partials/admin-interface.php') ?>
        </div>
<?php
    }
}
