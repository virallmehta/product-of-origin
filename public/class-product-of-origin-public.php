<?php

/**
 * The public-facing functionality of the plugin.
 *
 * @link       https://axelerant.com
 * @since      1.0.0
 *
 * @package    Product_Of_Origin
 * @subpackage Product_Of_Origin/public
 */

/**
 * The public-facing functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the public-facing stylesheet and JavaScript.
 *
 * @package    Product_Of_Origin
 * @subpackage Product_Of_Origin/public
 * @author     Axelerant <viral.mehta@axelerant.com>
 */
class Product_Of_Origin_Public {

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
	 * Store plugin main class to allow public access.
	 *
	 * @since    1.0.0
	 * @var object      The main class.
	 */
	public $main;

	/**
	 * Initialize the class and set its properties.
	 *
	 * @since    1.0.0
	 * @param      string    $plugin_name       The name of the plugin.
	 * @param      string    $version    The version of this plugin.
	 */
	public function __construct( $plugin_name, $version, $plugin_main ) {

		$this->plugin_name = $plugin_name;
		$this->version = $version;
		$this->main = $plugin_main;

	}

	/**
	 * Register the stylesheets for the public-facing side of the site.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_styles() {

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in Product_Of_Origin_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Product_Of_Origin_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_style( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'css/product-of-origin-public.css', array(), $this->version, 'all' );

	}

	/**
	 * Register the JavaScript for the public-facing side of the site.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_scripts() {

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in Product_Of_Origin_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Product_Of_Origin_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_script( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'js/product-of-origin-public.js', array( 'jquery' ), $this->version, false );

	}

	/**
	 * Get Meta for the public-facing side of the site.
	 *
	 * @since    1.0.0
	 */
	function product_of_origin_get_meta() {
		global $product;
		
		$flag = get_post_meta( $product->get_id(), '_chk_show_poo', true);

		if ($flag == 'yes') {
			$country_array = get_countryAll();
			$country = $country_array[get_post_meta( $product->get_id(), '_sel_poo', true )];

			echo apply_filters('product_poo_field', sprintf( '<p><strong>Made in %s</strong></p>', esc_html( $country ) ));			
		} 

	}

	/**
	 * Add cart item data for the public-facing side of the site.
	 *
	 * @since    1.0.0
	 */	
	function product_of_origin_add_cart_item_data( $cart_item_data, $product_id, $variation_id ) {
		global $post;

		$id = $product_id;
		$flag = get_post_meta( $id, '_chk_show_coo', true);

		if ($flag == 'yes') {
			$country_array = get_countryAll();
			$country = $country_array[get_post_meta( $id, '_sel_poo', true )];
			$cart_item_data['product_poo'] = $country;
			return $cart_item_data;
		}

		return $cart_item_data;
	}

	/**
	 * Item data for the public-facing side of the site.
	 *
	 * @since    1.0.0
	 */	
	function product_of_origin_item_data( $item_data, $cart_item ) {

		if ( !empty($cart_item['product_poo']) ) {
		    $item_data[] = array(
		        'key'     => 'Made in ',
	    	    'value'   => $cart_item['product_poo'],
	        	'display' => '',
		    );
		}

	    return $item_data;
	}	

	/**
	 * Order item meta for the public-facing side of the site.
	 *
	 * @since    1.0.0
	 */
	function product_of_origin_order_item_meta($item_id, $values) {
		if (function_exists('woocommerce_add_order_item_meta')) {
			if ( !empty($values['product_poo']) ) {
				woocommerce_add_order_item_meta($item_id, 'Made in', $values['product_poo']);
			}
		}
	}

}
