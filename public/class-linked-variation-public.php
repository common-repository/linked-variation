<?php

/**
 * The public-facing functionality of the plugin.
 *
 * @package    DSALV_Advanced_Linked_Variations
 * @subpackage DSALV_Advanced_Linked_Variations/public
 * @link       http://www.multidots.com/
 * @since      1.0.0
 */
/**
 * If this file is called directly, abort.
 */
if ( ! defined( 'WPINC' ) ) {
	die;
}

/**
 * The public-facing functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the admin-specific stylesheet and JavaScript.
 *
 * @package    DSALV_Advanced_Linked_Variations
 * @subpackage DSALV_Advanced_Linked_Variations/public
 * @author     Multidots <inquiry@multidots.in>
 */
class DSALV_Advanced_Linked_Variations_Public {

	/**
	 * The ID of this plugin.
	 *
	 * @since  1.0.0
	 * @access private
	 * @var    string $plugin_name The ID of this plugin.
	 */
	private $plugin_name;

	/**
	 * The version of this plugin.
	 *
	 * @since  1.0.0
	 * @access private
	 * @var    string $version The current version of this plugin.
	 */
	private $version;

	/**
	 * The version of this plugin.
	 *
	 * @since  1.0.0
	 * @access private
	 * @var    string $version The current version of this plugin.
	 */
	private $post_type_name;

	/**
	 * Initialize the class and set its properties.
	 *
	 * @param string $plugin_name The name of the plugin.
	 * @param string $version The version of this plugin.
	 * @param string $post_type_name The post type name of this plugin.
	 *
	 * @since 1.0.0
	 */
	public function __construct( $plugin_name, $version ) {

		$this->plugin_name    = $plugin_name;
		$this->version        = $version;
		
	}

	/**
	 * Get the plugin name.
	 * @return string
	 */
	public function get_plugin_name() {
		return $this->plugin_name;
	}

	/**
	 * Plugin dash name.
	 * @return string
	 */
	public function get_plugin_dash_name() {
		return sanitize_title_with_dashes( $this->get_plugin_name() );
	}

	/**
	 * Get the plugin version.
	 * @return string
	 */
	public function get_plugin_version() {
		return $this->version;
	}

	/**
	 * Register the Style and JavaScript for the public-facing side of the site.
	 *
	 * @since 1.0.0
	 */
	public function dsalv_enqueue_public_scripts() {
		$suffix = defined( 'SCRIPT_DEBUG' ) && SCRIPT_DEBUG ? '' : '.min';

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in DSALV_Advanced_Linked_Variations_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The DSALV_Advanced_Linked_Variations_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */
		if ( is_single() && 'product' === get_post_type() ) {
			// Register styles.
			wp_register_style( $this->get_plugin_dash_name(), plugin_dir_url( __FILE__ ) . 'css/linked-variation-public.css', array(), $this->version, 'all' );
			
			// Enqueue styles.
			wp_enqueue_style( $this->get_plugin_dash_name() );

            if ( get_option( 'alv_settings_tooltip_pos', 'top' ) !== 'no' ) {
                wp_enqueue_style( $this->get_plugin_dash_name() . '-hint', plugin_dir_url( __FILE__ ) . '/css/hint.css', array(), $this->version, 'all' );
            }
			
			/**
			 * This function is provided for demonstration purposes only.
			 *
			 * An instance of this class should be passed to the run() function
			 * defined in DSALV_Advanced_Linked_Variations_Loader as all of the hooks are defined
			 * in that particular class.
			 *
			 * The DSALV_Advanced_Linked_Variations_Loader will then create the relationship
			 * between the defined hooks and the functions defined in this
			 * class.
			 */
			wp_register_script( $this->get_plugin_dash_name(), plugin_dir_url( __FILE__ ) . 'js/linked-variation-public.js', array( 'jquery' ), $this->version, true );
			wp_enqueue_script( $this->get_plugin_dash_name() );
			
		}
	}
}
/** Added new shortcode */

add_shortcode('dsalv', 'dsalv_shortcode' );
function dsalv_shortcode($attrs) {
	ob_start();
		echo wp_kses_post( DSALV_Advanced_Linked_Variations_Admin::dsalv_lv_shortcode($attrs));
	return ob_get_clean();
}