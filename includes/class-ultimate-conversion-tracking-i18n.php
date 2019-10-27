<?php

/**
 * Define the internationalization functionality
 *
 * Loads and defines the internationalization files for this plugin
 * so that it is ready for translation.
 *
 * @link       https://www.ubazaar.co
 * @since      1.0.0
 *
 * @package    Ultimate_Conversion_Tracking
 * @subpackage Ultimate_Conversion_Tracking/includes
 */

/**
 * Define the internationalization functionality.
 *
 * Loads and defines the internationalization files for this plugin
 * so that it is ready for translation.
 *
 * @since      1.0.0
 * @package    Ultimate_Conversion_Tracking
 * @subpackage Ultimate_Conversion_Tracking/includes
 * @author     uBazaar Limited <ask@ubazaar.co>
 */
class Ultimate_Conversion_Tracking_i18n {


	/**
	 * Load the plugin text domain for translation.
	 *
	 * @since    1.0.0
	 */
	public function load_plugin_textdomain() {

		load_plugin_textdomain(
			'ultimate-conversion-tracking',
			false,
			dirname( dirname( plugin_basename( __FILE__ ) ) ) . '/languages/'
		);

	}



}
