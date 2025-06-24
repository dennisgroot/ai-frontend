<?php

/**
 * The plugin bootstrap file
 *
 * This file is read by WordPress to generate the plugin information in the plugin
 * admin area. This file also includes all of the dependencies used by the plugin,
 * registers the activation and deactivation functions, and defines a function
 * that starts the plugin.
 *
 * @link              https://raadhuis.com/raadhuis-tools
 * @since             1.0.0
 * @package           Raadhuis_Tools
 *
 * @wordpress-plugin
 * Plugin Name:       Raadhuis Tools
 * Plugin URI:        https://raadhuis.com/raadhuis-tools
 * Description:       Functies en tools voor websites en webshops gemaakt door Raadhuis.
 * Version:           2.0.2
 * Author:            Raadhuis
 * Author URI:        https://raadhuis.com/raadhuis-tools
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       raadhuis-tools
 * Domain Path:       /languages
 */

// If this file is called directly, abort.
if (!defined('WPINC')) {
    die;
}

/**
 * Currently plugin version.
 * Start at version 1.0.0 and use SemVer - https://semver.org
 * Rename this for your plugin and update it as you release new versions.
 */
define('TOOLS_VERSION', '2.0.2');
define('TOOLS_AUTHOR', 'Raadhuis');
define('RAADHUIS_TOOLS_TRANSLATION_GROUP', 'raadhuis-tools');

define('RAADHUISTOOLS_PLUGIN_PATH', plugin_dir_path(__FILE__));
define('RAADHUISTOOLS_PLUGIN_URL', plugin_dir_url(__FILE__));
define('RAADHUISTOOLS_PLUGIN_NAME', dirname(plugin_basename(__FILE__)));

/**
 * The code that runs during plugin activation.
 * This action is documented in includes/activator.php
 */
function activate_raadhuis_tools()
{
    require_once plugin_dir_path(__FILE__) . 'includes/activator.php';
    Raadhuis_Tools_Activator::activate();
}

/**
 * The code that runs during plugin deactivation.
 * This action is documented in includes/deactivator.php
 */
function deactivate_raadhuis_tools()
{
    require_once plugin_dir_path(__FILE__) . 'includes/deactivator.php';
    Raadhuis_Tools_Deactivator::deactivate();
}

// register_activation_hook(__FILE__, 'raadhuis_tools_create_table');
register_activation_hook(__FILE__, 'activate_raadhuis_tools');
register_deactivation_hook(__FILE__, 'deactivate_raadhuis_tools');

/**
 * The core plugin class that is used to define internationalization,
 * admin-specific hooks, and public-facing site hooks.
 */
require plugin_dir_path(__FILE__) . 'includes/manager.php';

/**
 * Begins execution of the plugin.
 *
 * Since everything within the plugin is registered via hooks,
 * then kicking off the plugin from this point in the file does
 * not affect the page life cycle.
 *
 * @since    1.0.0
 */
function run_tools()
{

    $plugin = new Raadhuis_Tools();
    $plugin->run();
}

run_tools();

if (!class_exists('RaadhuisToolsUpdate')) {

    class RaadhuisToolsUpdate
    {
        private static $instance = null;

        public $plugin_slug;
        public $version;
        public $cache_key;
        public $cache_allowed;

        private function __construct()
        {
            $this->plugin_slug = plugin_basename(__DIR__);
            $this->version = TOOLS_VERSION;
            $this->cache_key = 'raadhuis-tools-v2';
            $this->cache_allowed = true;

            add_filter('plugins_api', array($this, 'info'), 20, 3);
            add_filter('site_transient_update_plugins', array($this, 'update'));
            add_action('upgrader_process_complete', array($this, 'purge'), 10, 2);
        }

        public static function getInstance()
        {
            if (self::$instance == null) {
                self::$instance = new RaadhuisToolsUpdate();
            }

            return self::$instance;
        }

        public function request()
        {
            $remote = get_transient($this->cache_key);

            if (false === $remote || !$this->cache_allowed) {
                $remote = wp_remote_get(
                    'https://plugins.raadhuis.com/resources/wordpress/plugins/raadhuis/raadhuis-tools/info.json',
                    array(
                        'timeout' => 10,
                        'headers' => array(
                            'Accept' => 'application/json'
                        )
                    )
                );

                if (
                    is_wp_error($remote)
                    || 200 !== wp_remote_retrieve_response_code($remote)
                    || empty(wp_remote_retrieve_body($remote))
                ) {
                    return false;
                }

                set_transient($this->cache_key, $remote, DAY_IN_SECONDS);
            }

            $remote = json_decode(wp_remote_retrieve_body($remote));

            return $remote;
        }

        function info($res, $action, $args)
        {
            if ('plugin_information' !== $action) {
                return false;
            }

            if ($this->plugin_slug !== $args->slug) {
                return false;
            }

            $remote = $this->request();

            if (!$remote) {
                return false;
            }

            $res = new stdClass();

            $res->name = $remote->name;
            $res->slug = $remote->slug;
            $res->version = $remote->version;
            $res->tested = $remote->tested;
            $res->requires = $remote->requires;
            $res->author = $remote->author;
            $res->author_profile = $remote->author_profile;
            $res->download_link = $remote->download_url;
            $res->trunk = $remote->download_url;
            $res->requires_php = $remote->requires_php;
            $res->last_updated = $remote->last_updated;

            $res->sections = array(
                'description' => $remote->sections->description,
                'installation' => $remote->sections->installation,
                'changelog' => $remote->sections->changelog
            );

            if (!empty($remote->banners)) {
                $res->banners = array(
                    'low' => $remote->banners->low,
                    'high' => $remote->banners->high
                );
            }

            return $res;
        }

        public function update($transient)
        {
            if (empty($transient->checked)) {
                return $transient;
            }

            $remote = $this->request();

            if (
                $remote
                && version_compare($this->version, $remote->version, '<')
                && version_compare($remote->requires, get_bloginfo('version'), '<')
                && version_compare($remote->requires_php, PHP_VERSION, '<')
            ) {
                $res = new stdClass();
                $res->slug = $this->plugin_slug;
                $res->plugin = plugin_basename(__FILE__);
                $res->new_version = $remote->version;
                $res->tested = $remote->tested;
                $res->package = $remote->download_url;

                $transient->response[$res->plugin] = $res;
            }

            return $transient;
        }

        public function purge($upgrader, $options)
        {
            if ($this->cache_allowed && 'update' === $options['action'] && 'plugin' === $options['type']) {
                delete_transient($this->cache_key);
            }
        }
    }

    RaadhuisToolsUpdate::getInstance();
}
