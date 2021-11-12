<?php

/**
 * The plugin bootstrap file
 *
 * This file is read by WordPress to generate the plugin information in the plugin
 * admin area. This file also includes all of the dependencies used by the plugin,
 * registers the activation and deactivation functions, and defines a function
 * that starts the plugin.
 *
 * @link              https://axelerant.com
 * @since             1.0.0
 * @package           Product_Of_Origin
 *
 * @wordpress-plugin
 * Plugin Name:       Product of Origin
 * Plugin URI:        https://github.com/virallmehta/product-of-origin
 * Description:       This plugin is to show product of origin on singple product page also, to show on product cart item, product checkout and order page. Is is used along with WooCommerce. Main purpose of the plugin is to show product of origin.
 * Version:           1.0.0
 * Author:            Axelerant
 * Author URI:        https://axelerant.com
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       product-of-origin
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
define( 'PRODUCT_OF_ORIGIN_VERSION', '1.0.0' );
define( 'POO_DOMAIN', 'product_of_origin' );
define( 'POO_PATH',  plugin_dir_path( __FILE__ ) );

/**
 * The code that runs during plugin activation.
 * This action is documented in includes/class-product-of-origin-activator.php
 */
function activate_product_of_origin() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-product-of-origin-activator.php';
	Product_Of_Origin_Activator::activate();
}

/**
 * The code that runs during plugin deactivation.
 * This action is documented in includes/class-product-of-origin-deactivator.php
 */
function deactivate_product_of_origin() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-product-of-origin-deactivator.php';
	Product_Of_Origin_Deactivator::deactivate();
}

register_activation_hook( __FILE__, 'activate_product_of_origin' );
register_deactivation_hook( __FILE__, 'deactivate_product_of_origin' );

/**
 * The core plugin class that is used to define internationalization,
 * admin-specific hooks, and public-facing site hooks.
 */
require plugin_dir_path( __FILE__ ) . 'includes/class-product-of-origin.php';

/**
 * Begins execution of the plugin.
 *
 * Since everything within the plugin is registered via hooks,
 * then kicking off the plugin from this point in the file does
 * not affect the page life cycle.
 *
 * @since    1.0.0
 */
global $plugin_product_of_origin;
$plugin_product_of_origin = new Product_Of_Origin();
$plugin_product_of_origin->run();
