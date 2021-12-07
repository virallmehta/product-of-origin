<?php

/**
 * The admin-specific functionality of the plugin.
 *
 * @link       https://axelerant.com
 * @since      1.0.0
 *
 * @package    Product_Of_Origin
 * @subpackage Product_Of_Origin/admin
 */

/**
 * The admin-specific functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the admin-specific stylesheet and JavaScript.
 *
 * @package    Product_Of_Origin
 * @subpackage Product_Of_Origin/admin
 * @author     Axelerant <viral.mehta@axelerant.com>
 */
class Product_Of_Origin_Admin {

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
	 * @param      string    $plugin_name   The name of this plugin.
	 * @param      string    $version       The version of this plugin.
	 * @param      string    $plugin_main   The main class
	 */
	public function __construct( $plugin_name, $version, $plugin_main ) {

		$this->plugin_name = $plugin_name;
		$this->version = $version;
		$this->main = $plugin_main;

	}

	/**
	 * Register the stylesheets for the admin area.
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

		wp_enqueue_style( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'css/product-of-origin-admin.css', array(), $this->version, 'all' );

	}

	/**
	 * Register the JavaScript for the admin area.
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

		wp_enqueue_script( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'js/product-of-origin-admin.js', array( 'jquery' ), $this->version, false );

	}

	/**
	 * Show product of origin data tab for the admin area.
	 *
	 * @since    1.0.0
	 */	
	public function product_of_origin_data_tab( $product_data_tabs ) {

		$product_data_tabs['poo_tab'] = array(
					'label' => esc_html( 'Country of Origin', POO_DOMAIN ),
					'target' => 'poo_tab_content',
					'class' => array( 'show_if_simple', 'show_if_variable' )
			);
        
		return $product_data_tabs;

	}

	/**
	 * Wrap for data tab for the admin area.
	 *
	 * @since    1.0.0
	 */	
	public function product_of_origin_data_panel_wrap() {
		global $woocommerce, $post;
    ?>
		<div id="poo_tab_content" class="panel poo_tab_content woocommerce_options_panel hidden">
			<div class="product_coo_fields">
				<?php 
					woocommerce_wp_checkbox(
						array(
							'id'     => 'poo_chk_show',
							'label'  => 'Show Country of Origin',
						)
					);

					woocommerce_wp_select(
						array(
								'id'      => 'poo_sel_country',
								'label'   => 'Select Country',
								'options' => product_of_origin_country(),
						)
					);
				?>
			</div>
		</div>
		<?php
    }

	/**
	 * Product of origin meta save for the admin area.
	 *
	 * @since    1.0.0
	 */		
	function product_of_origin_meta_save( $post_id ) {

		if ( isset($_POST['poo_chk_show']) ) {
			$show_chk = product_of_origin_sanitize_checkbox( $_POST['poo_chk_show'] );
			update_post_meta($post_id, 'poo_chk_show', $show_chk );
		}
		
		if ( isset($_POST['poo_sel_country']) ) {
			$country_value = sanitize_text_field($_POST['poo_sel_country']);
				update_post_meta($post_id, 'poo_sel_country', $country_value);
		}
	   
	}	

}