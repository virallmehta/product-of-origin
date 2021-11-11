<?php

/**
 * Fired during plugin activation
 *
 * @link       https://axelerant.com
 * @since      1.0.0
 *
 * @package    Product_Of_Origin
 * @subpackage Product_Of_Origin/includes
 */

/**
 * Fired during plugin activation.
 *
 * This class defines all code necessary to run during the plugin's activation.
 *
 * @since      1.0.0
 * @package    Product_Of_Origin
 * @subpackage Product_Of_Origin/includes
 * @author     Axelerant <viral.mehta@axelerant.com>
 */
class Product_Of_Origin_Activator {

	/**
	 * Short Description. (use period)
	 *
	 * Long Description.
	 *
	 * @since    1.0.0
	 */
	public static function activate() {
		if ( !class_exists( 'WooCommerce' ) ) {
			deactivate_plugins( plugin_basename( __FILE__ ) );

			wp_die( esc_html__( 'This plugin requires WooCommerce. Download it from WooCommerce official website', POO_DOMAIN ) . ' &rarr; https://woocommerce.com' );
			exit;
		}
	}

}
