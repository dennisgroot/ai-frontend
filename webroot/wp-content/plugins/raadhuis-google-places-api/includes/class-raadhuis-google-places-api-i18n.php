<?php

/**
 * Define the internationalization functionality
 *
 * Loads and defines the internationalization files for this plugin
 * so that it is ready for translation.
 *
 * @link       https://raadhuis.com
 * @since      1.0.0
 *
 * @package    Raadhuis_Google_Places_Api
 * @subpackage Raadhuis_Google_Places_Api/includes
 */

/**
 * Define the internationalization functionality.
 *
 * Loads and defines the internationalization files for this plugin
 * so that it is ready for translation.
 *
 * @since      1.0.0
 * @package    Raadhuis_Google_Places_Api
 * @subpackage Raadhuis_Google_Places_Api/includes
 * @author     Raadhuis <online@raadhuis.com>
 */
class Raadhuis_Google_Places_Api_i18n {


	/**
	 * Load the plugin text domain for translation.
	 *
	 * @since    1.0.0
	 */
	public function load_plugin_textdomain() {

		load_plugin_textdomain(
			'raadhuis-google-places-api',
			false,
			dirname( dirname( plugin_basename( __FILE__ ) ) ) . '/languages/'
		);

	}



}
