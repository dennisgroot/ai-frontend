<?php

/**
 * The file that defines the core plugin class
 *
 * A class definition that includes attributes and functions used across both the
 * public-facing side of the site and the admin area.
 *
 * @link       https://raadhuis.com
 * @since      1.0.0
 *
 * @package    Raadhuis_Tools
 * @subpackage Raadhuis_Tools/includes
 */

/**
 * The core plugin class.
 *
 * This is used to define internationalization, admin-specific hooks, and
 * public-facing site hooks.
 *
 * Also maintains the unique identifier of this plugin as well as the current
 * version of the plugin.
 *
 * @since      1.0.0
 * @package    Raadhuis_Tools
 * @subpackage Raadhuis_Tools/includes
 * @author     Raadhuis <online@raadhuis.com>
 */
class Raadhuis_Tools
{

    /**
     * The loader that's responsible for maintaining and registering all hooks that power
     * the plugin.
     *
     * @since    1.0.0
     * @access   protected
     * @var      Raadhuis_Tools_Loader    $loader    Maintains and registers all hooks for the plugin.
     */
    protected $loader;

    /**
     * The unique identifier of this plugin.
     *
     * @since    1.0.0
     * @access   protected
     * @var      string    $plugin_name    The string used to uniquely identify this plugin.
     */
    protected $plugin_name;

    /**
     * The current version of the plugin.
     *
     * @since    1.0.0
     * @access   protected
     * @var      string    $version    The current version of the plugin.
     */
    protected $version;

    /**
     * Define the core functionality of the plugin.
     *
     * Set the plugin name and the plugin version that can be used throughout the plugin.
     * Load the dependencies, define the locale, and set the hooks for the admin area and
     * the public-facing side of the site.
     *
     * @since    1.0.0
     */
    public function __construct()
    {
        if (defined('TOOLS_VERSION')) {
            $this->version = TOOLS_VERSION;
        } else {
            $this->version = '1.0.0';
        }
        $this->plugin_name = 'raadhuis-tools';

        $this->load_dependencies();
        $this->set_locale();
        $this->define_admin_hooks();
        $this->define_public_hooks();
    }

    /**
     * Load the required dependencies for this plugin.
     *
     * Include the following files that make up the plugin:
     *
     * - Raadhuis_Tools_Loader. Orchestrates the hooks of the plugin.
     * - Raadhuis_Tools_i18n. Defines internationalization functionality.
     * - Raadhuis_Tools_Admin. Defines all hooks for the admin area.
     * - Raadhuis_Tools_Public. Defines all hooks for the public side of the site.
     *
     * Create an instance of the loader which will be used to register the hooks
     * with WordPress.
     *
     * @since    1.0.0
     * @access   private
     */
    private function load_dependencies()
    {

        /**
         * The class responsible for orchestrating the actions and filters of the
         * core plugin.
         */
        require_once plugin_dir_path(dirname(__FILE__)) . 'includes/loader.php';

        /**
         * The class responsible for defining internationalization functionality
         * of the plugin.
         */
        require_once plugin_dir_path(dirname(__FILE__)) . 'includes/i18n.php';

        /**
         * The class responsible for defining all actions that occur in the admin area.
         */
        require_once plugin_dir_path(dirname(__FILE__)) . 'admin/admin.php';

        /**
         * The class responsible for defining all actions that occur in the public-facing
         * side of the site.
         */
        require_once plugin_dir_path(dirname(__FILE__)) . 'public/public.php';

        $this->loader = new Raadhuis_Tools_Loader();
    }

    /**
     * Define the locale for this plugin for internationalization.
     *
     * Uses the Raadhuis_Tools_i18n class in order to set the domain and to register the hook
     * with WordPress.
     *
     * @since    1.0.0
     * @access   private
     */
    private function set_locale()
    {

        $plugin_i18n = new Raadhuis_Tools_i18n();

        $this->loader->add_action('plugins_loaded', $plugin_i18n, 'load_plugin_textdomain');
    }

    /**
     * Register all of the hooks related to the admin area functionality
     * of the plugin.
     *
     * @since    1.0.0
     * @access   private
     */
    private function define_admin_hooks()
    {

        $plugin_admin = new Raadhuis_Tools_Admin($this->get_plugin_name(), $this->get_version());

        // Create menu
        // $this->loader->add_action('admin_menu', $plugin_admin, 'raadhuis_tools_menu');

        // Settings page shortcut
        $this->loader->add_filter('plugin_action_links', $plugin_admin, 'raadhuis_tools_add_settings_plugin_action_link', 10, 2);

        // JS & CSS
        $this->loader->add_action('admin_enqueue_scripts', $plugin_admin, 'enqueue_styles');
        $this->loader->add_action('admin_enqueue_scripts', $plugin_admin, 'enqueue_scripts');

        $this->loader->add_action('admin_init', $plugin_admin, 'setEnvironmentType'); // set environment type, if not specified
        $this->loader->add_action('admin_init', $plugin_admin, 'noIndexAdmin');
        $this->loader->add_action('admin_init', $plugin_admin, 'removeSubmenuPages', 100);
        $this->loader->add_action('admin_init', $plugin_admin, 'deactivatePlugins');
        // $this->loader->add_action('admin_init', $plugin_admin, 'additionalAdminColorSchemes'); // Change WP admin color scheme
        $this->loader->add_action('admin_init', $plugin_admin, 'autoSetLicenseKeys');
        $this->loader->add_action('admin_init', $plugin_admin, 'editorRoleCapabilities');
        $this->loader->add_action('admin_menu', $plugin_admin, 'disableDefaultDashboardWidgets');
        $this->loader->add_action('admin_head', $plugin_admin, 'hideUpdateNotices', 1);
        $this->loader->add_action('admin_bar_menu', $plugin_admin, 'developmentNotice_admin_bar');
        // $this->loader->add_action('admin_menu', $plugin_admin, 'developmentNotice');
        $this->loader->add_action('admin_footer_text', $plugin_admin, 'customAdminFooter');
        $this->loader->add_action('acf/init', $plugin_admin, 'addACFoptionsPage'); // ACF required!
        $this->loader->add_action('acf/init', $plugin_admin, 'loadACFoptions'); // ACF required!

        // Yoast SEO
        $this->loader->add_filter('wpseo_metabox_prio', $plugin_admin, 'wpSeoMetaboxPriority');

        // Gutenberg/FSE
        // $this->loader->add_action('enqueue_block_editor_assets', $plugin_admin, 'disableEditorFullscreenByDefault');

        // User caps and restrictions
        // $this->loader->add_action('user_register', $plugin_admin, 'setDefaultAdminColor'); // Set WP admin color scheme for new users
        // $this->loader->add_action('get_user_option_admin_color', $plugin_admin, 'changeDashboardColor'); // Change WP admin color scheme for existing users
        $this->loader->add_action('map_meta_cap', $plugin_admin, 'editorManagePrivacyPage', 1, 4);
        $this->loader->add_filter('editable_roles', $plugin_admin, 'editorAddUsers');

        // Page and post and taxonomy columns
        $this->loader->add_filter('manage_posts_columns', $plugin_admin, 'posts_columns_id', 5); // Add ID column to post (post-type)
        $this->loader->add_action('manage_posts_custom_column', $plugin_admin, 'posts_custom_id_columns', 5, 2); // Add ID column to post (post-type)
        $this->loader->add_filter('manage_pages_columns', $plugin_admin, 'posts_columns_id', 5); // Add ID column to pages (post-type)
        $this->loader->add_action('manage_pages_custom_column', $plugin_admin, 'posts_custom_id_columns', 5, 2); // Add ID column to pages (post-type)
        $this->loader->add_filter('manage_edit-category_columns', $plugin_admin, 'taxonomy_columns_id', 10); // Add ID column to default category (taxonomy)
        $this->loader->add_filter('manage_category_custom_column', $plugin_admin, 'taxonomy_custom_id_columns', 10, 3); // Add ID column to default category (taxonomy)
        $this->loader->add_filter('manage_edit-post_tag_columns', $plugin_admin, 'taxonomy_columns_id', 10); // Add ID column to default tags (taxonomy)
        $this->loader->add_filter('manage_post_tag_custom_column', $plugin_admin, 'taxonomy_custom_id_columns', 10, 3); // Add ID column to default tags (taxonomy)

        // Media library
        $this->loader->add_filter('manage_media_columns', $plugin_admin, 'media_columns_alt');
        $this->loader->add_action('manage_media_custom_column', $plugin_admin, 'media_column_alt', 10, 2);;

        // For debugging
        // $this->loader->add_action('admin_init', $plugin_admin, 'raadhuis_tools_admin_init');

        // WordPress plugins & themes:
        $this->loader->add_filter('auto_update_plugin', $plugin_admin, 'auto_update_plugin');
        $this->loader->add_filter('auto_update_theme', $plugin_admin, 'auto_update_theme');
    }

    /**
     * Register all of the hooks related to the public-facing functionality
     * of the plugin.
     *
     * @since    1.0.0
     * @access   private
     */
    private function define_public_hooks()
    {

        $plugin_public = new Raadhuis_Tools_Public($this->get_plugin_name(), $this->get_version());

        // JS & CSS
        $this->loader->add_action('wp_enqueue_scripts', $plugin_public, 'enqueue_styles');
        $this->loader->add_action('wp_enqueue_scripts', $plugin_public, 'enqueue_scripts');

        // Insert head_scripts from the options table into wp_head
        $this->loader->add_action('wp_head', $plugin_public, 'loadHeadScripts');

        // Insert body_scripts from the options table into wp_head
        $this->loader->add_action('wp_body_open', $plugin_public, 'loadBodyScripts');

        // Login page
        $this->loader->add_action('login_enqueue_scripts', $plugin_public, 'loginCss', 10); // Add custom CSS to the login page
        $this->loader->add_action('login_headerurl', $plugin_public, 'loginUrl');
        $this->loader->add_action('login_headertext', $plugin_public, 'loginTitle');

        // Insert functions in the Raadhuis toolbar
        $this->loader->add_action('raadhuis_tools_toolbar', $plugin_public, 'toolsSmoothingButton');

        // Insert footer_scripts from the options table into wp_head
        $this->loader->add_action('wp_footer', $plugin_public, 'toolsToolbar');
        $this->loader->add_action('wp_footer', $plugin_public, 'loadFooterScripts');
    }

    /**
     * Run the loader to execute all of the hooks with WordPress.
     *
     * @since    1.0.0
     */
    public function run()
    {
        $this->loader->run();
    }

    /**
     * The name of the plugin used to uniquely identify it within the context of
     * WordPress and to define internationalization functionality.
     *
     * @since     1.0.0
     * @return    string    The name of the plugin.
     */
    public function get_plugin_name()
    {
        return $this->plugin_name;
    }

    /**
     * The reference to the class that orchestrates the hooks with the plugin.
     *
     * @since     1.0.0
     * @return    Raadhuis_Tools_Loader    Orchestrates the hooks of the plugin.
     */
    public function get_loader()
    {
        return $this->loader;
    }

    /**
     * Retrieve the version number of the plugin.
     *
     * @since     1.0.0
     * @return    string    The version number of the plugin.
     */
    public function get_version()
    {
        return $this->version;
    }
}
