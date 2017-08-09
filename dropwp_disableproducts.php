<?php

if ( ! defined( 'ABSPATH' ) ) exit;

/**
 *
 * @link              http://www.dropshippingwordpress.com/
 * @since             1.0.0
 * @package           Dropwp_DisableProducts
 *
 * @wordpress-plugin
 * Plugin Name:       Dropwp Disable Products
 * Plugin URI:        http://www.dropshippingwordpress.com/
 * Description:       Create products in draft status.
 * Version:           1.0.3
 * Author:            Dropwp
 * Author URI:        http://www.dropshippingwordpress.com/
 * Text Domain:       dropwp_disableproducts
 * Domain Path:       /languages
 */

if ( !defined( 'ABSPATH' ) ) exit; // Exit if accessed directly
if ( !in_array( 'woocommerce/woocommerce.php', apply_filters( 'active_plugins', get_option( 'active_plugins' ) ) ) )
	return;

if ( !class_exists( 'Dropwp_DisableProducts' ) ) {

	final class Dropwp_DisableProducts {

		public $version = '1.0.3';
		
		public $custom_meta = 'dropwp_disableproducts_skip';

		protected static $_instance = null;

		/**
		 * Instance
		 */
		public static function instance() {
			if ( is_null( self::$_instance ) ) {
				self::$_instance = new self();
			}
			return self::$_instance;
		}

		/**
		 * Load textdomain and set initial hooks
		 */
		public function __construct() {
			load_plugin_textdomain( 'dropwp_disableproducts', false, dirname( plugin_basename( __FILE__ ) ) . '/languages/' );
			
			add_action( 'admin_menu', array( $this, 'add_menu' ) );
			add_action( 'admin_init', array( $this, 'register_settings' ) );
			
			$custom_meta = get_option( 'dropwp_disableproducts_custom_meta' );
			if ( $custom_meta )
				$this->custom_meta = $custom_meta;
			
			$this->set_hook();
		}
		
		/**
		 * Hook to hooks :D
		 */ 
		public function set_hook() {
			add_action( 'save_post', array( $this, 'save_post' ), 20 );
		}
		
		/**
		 * Unhook to hook :D
		 */
		public function unset_hook() {
			remove_action( 'save_post', array( $this, 'save_post' ), 20 );	
		}

		/**
		 * Save Post Hook
		 */
		public function save_post( $post_id ) {
			// Only products
			if ( 'product' == get_post_type( $post_id ) ) {
				// Get ignore custom_meta
				$ignore = get_post_meta( $post_id, $this->custom_meta , true);
				
				if ( !$ignore ) {
					// Disable hook
					$this->unset_hook();
					
					// Set status
					wp_update_post( array(
						'ID' => $post_id,
						'post_status'    => 'draft',
					) );
					
					// Enable hook
					$this->set_hook();	
				}				
			}
		}
		
		/********************************************************************************************************/
		
		/**
		 * Add config values
		 */ 
		public function register_settings () {
			add_settings_section(
				'dropwp_disableproducts_settings',
				__( 'Configuration', 'dropwp_bigbuy' ),
				array( $this,'settings_header' ),
				'dropwp_disableproducts_configuration'
			);
			
			add_settings_field(
				'dropwp_disableproducts_custom_meta',
				__( 'Custom meta', 'dropwp_disableproducts' ),
				array( $this, 'field_text'),
				'dropwp_disableproducts_configuration',
				'dropwp_disableproducts_settings',
				array(
					  'name' => 'dropwp_disableproducts_custom_meta',
					  'help' => __( 'Name of the custom meta on the product to ignore the disable process.', 'dropwp_disableproducts' ),
				)
			);
			
			register_setting( 'dropwp_disableproducts_configuration', 'dropwp_disableproducts_custom_meta' );
		}
		
		/**
		* Render a setings text input
		*/
		public function field_text( $params ) {
			$value = get_option( $params['name'] );
			echo '<input type="text" name="' . $params['name'] . '" value="' . $value . '"/>';
			if ( isset( $params['help'] ) && $params['help'] ) {
				echo '<br /><span class="description">' . $params['help'] . '</span>';
			}
		}
		
		/**
		 * Header Function
		 */
		public function settings_header ( $param ) { }
		
		/**
		 * Add menu entry
		 */
		public function add_menu( ) {
			$page_hook_suffix = add_menu_page (
				__( 'Dropwp Disable Products', 'dropwp_disableproducts' ),
				__( 'Dropwp Disable Products', 'dropwp_disableproducts' ),
				'manage_options',
				'dropwp_disableproducts_configuration',
				array( $this, 'callback_settings_page')
			);
	
			add_action( 'admin_print_styles-' . $page_hook_suffix, array( $this, 'enqueue_custom_styles' ) );
		}
		
		/**
		 * Enqueue styles
		 */
		public function enqueue_custom_styles() {
			wp_register_style( 'dropwp_disableproducts', plugin_dir_url( __FILE__ ) . 'css/dropwp_disableproducts_admin.css' );
			wp_enqueue_style( 'dropwp_disableproducts' );
		}
		
		/**
		* Settings page
		*/
		public function callback_settings_page( ) {
			require_once 'includes/class-dropwp-helper.php';
			include( plugin_dir_path( __FILE__ ) . '/views/dropwp-disableproducts-header.php' );
			include( plugin_dir_path( __FILE__ ) . '/views/dropwp-disableproducts-admin-settings.php' );
			include( plugin_dir_path( __FILE__ ) . '/views/dropwp-disableproducts-footer.php' );
		}
	}
}

Dropwp_DisableProducts::instance();
