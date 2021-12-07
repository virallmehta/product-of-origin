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
	 * Product of origin get meta for the public-facing side of the site.
	 *
	 * @since    1.0.0
	 */	
	public function product_of_origin_get_meta() {
		global $product;
		
		$flag = get_post_meta( $product->get_id(), 'poo_chk_show', true);

		if ($flag == 'yes') {
			$country_array = product_of_origin_country();
			$country = $country_array[get_post_meta( $product->get_id(), 'poo_sel_country', true )];

			echo apply_filters('poo_field', sprintf( '<p><strong>Made in %s</strong></p>', esc_html( $country ) ));			
		} 

	}

	/**
	 * Add product of origin to cart item data for the public-facing side of the site.
	 *
	 * @since    1.0.0
	 */	
	public function product_of_origin_add_cart_item_data( $cart_item_data, $product_id, $variation_id ) {
		global $post;

		$id = $product_id;
		$flag = get_post_meta( $id, 'poo_chk_show', true);

		if ($flag == 'yes') {
			$country_array = product_of_origin_country();
			$country = $country_array[get_post_meta( $id, 'poo_sel_country', true )];
			$cart_item_data['poo_country'] = $country;
			return $cart_item_data;
		}

		return $cart_item_data;
	}

	/**
	 * Product of origin item data for the public-facing side of the site.
	 *
	 * @since    1.0.0
	 */	
	public function product_of_origin_item_data( $item_data, $cart_item ) {

		if ( !empty($cart_item['poo_country']) ) {
		    $item_data[] = array(
		        'key'     => 'Made in ',
	    	    'value'   => $cart_item['poo_country'],
	        	'display' => '',
		    );
		}

	  return $item_data;
	}

	/**
	 * Product of origin order item meta for the public-facing side of the site.
	 *
	 * @since    1.0.0
	 */
	public function product_of_origin_order_item_meta( $item_id, $values ) {
		
		if (function_exists('woocommerce_add_order_item_meta')) {
			if ( !empty($values['poo_country']) ) {
				woocommerce_add_order_item_meta($item_id, 'Made in', $values['poo_country']);
			}
		}
	}

}