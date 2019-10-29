<?php

/**
 *
 * @link              https://www.ubazaar.co
 * @since             1.0.0
 * @package           Ultimate_Conversion_Tracking
 *
 * @wordpress-plugin
 * Plugin Name:       Ultimate Conversion Tracking
 * Plugin URI:        https://www.ubazaar.co/ultimate-conversion-tracking
 * Description:       Add conversion tracking to your WordPress website, quickly and easily.
 * Version:           1.0.0
 * Author:            uBazaar Limited
 * Author URI:        https://www.ubazaar.co
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       ultimate-conversion-tracking
 * Domain Path:       /languages
 */

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

/**
 * Currently plugin version.
 * Start at version 1.0.0 and use SemVer - https://semver.org
 * Rename this for your plugin and update it as you release new versions.
 */
define( 'ULTIMATE_CONVERSION_TRACKING_VERSION', '1.0.0' );

/**
 * The code that runs during plugin activation.
 * This action is documented in includes/class-ultimate-conversion-tracking-activator.php
 */
function activate_ultimate_conversion_tracking() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-ultimate-conversion-tracking-activator.php';
	Ultimate_Conversion_Tracking_Activator::activate();
}

/**
 * The code that runs during plugin deactivation.
 * This action is documented in includes/class-ultimate-conversion-tracking-deactivator.php
 */
function deactivate_ultimate_conversion_tracking() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-ultimate-conversion-tracking-deactivator.php';
	Ultimate_Conversion_Tracking_Deactivator::deactivate();
}

register_activation_hook( __FILE__, 'activate_ultimate_conversion_tracking' );
register_deactivation_hook( __FILE__, 'deactivate_ultimate_conversion_tracking' );

/**
 * The core plugin class that is used to define internationalization,
 * admin-specific hooks, and public-facing site hooks.
 */
require plugin_dir_path( __FILE__ ) . 'includes/class-ultimate-conversion-tracking.php';

/**
 * Begins execution of the plugin.
 *
 * Since everything within the plugin is registered via hooks,
 * then kicking off the plugin from this point in the file does
 * not affect the page life cycle.
 *
 * @since    1.0.0
 */
function run_ultimate_conversion_tracking() {

	$plugin = new Ultimate_Conversion_Tracking();
	$plugin->run();

}
run_ultimate_conversion_tracking();
