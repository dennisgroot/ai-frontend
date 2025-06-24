<?php

/**
 * The plugin bootstrap file
 *
 * This file is read by WordPress to generate the plugin information in the plugin
 * admin area. This file also includes all of the dependencies used by the plugin,
 * registers the activation and deactivation functions, and defines a function
 * that starts the plugin.
 *
 * @link              https://raadhuis.com
 * @since             1.0.0
 * @package           Raadhuis_Api_Import_Mapper
 *
 * @wordpress-plugin
 * Plugin Name:       Raadhuis API import mapper
 * Plugin URI:        https://raadhuis.com
 * Description:       Een plugin welke het mogelijk maakt om API data te importeren als posts binnen een (custom) post-type of als post-meta.
 * Version:           1.0.0
 * Author:            Raadhuis
 * Author URI:        https://raadhuis.com/
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       raadhuis-api-import-mapper
 * Domain Path:       /languages
 */

// If this file is called directly, abort.
if (! defined('WPINC')) {
    die;
}

/**
 * Currently plugin version.
 * Start at version 1.0.0 and use SemVer - https://semver.org
 * Rename this for your plugin and update it as you release new versions.
 */
define('RAADHUIS_API_IMPORT_MAPPER_VERSION', '1.0.0');

/**
 * The code that runs during plugin activation.
 * This action is documented in includes/class-raadhuis-api-import-mapper-activator.php
 */
function activate_raadhuis_api_import_mapper()
{
    require_once plugin_dir_path(__FILE__) . 'includes/class-raadhuis-api-import-mapper-activator.php';
    Raadhuis_Api_Import_Mapper_Activator::activate();
}

/**
 * The code that runs during plugin deactivation.
 * This action is documented in includes/class-raadhuis-api-import-mapper-deactivator.php
 */
function deactivate_raadhuis_api_import_mapper()
{
    require_once plugin_dir_path(__FILE__) . 'includes/class-raadhuis-api-import-mapper-deactivator.php';
    Raadhuis_Api_Import_Mapper_Deactivator::deactivate();
}

register_activation_hook(__FILE__, 'activate_raadhuis_api_import_mapper');
register_deactivation_hook(__FILE__, 'deactivate_raadhuis_api_import_mapper');

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
function run_raadhuis_api_import_mapper()
{

    $plugin = new Raadhuis_Api_Import_Mapper();
    $plugin->run();
}
run_raadhuis_api_import_mapper();
