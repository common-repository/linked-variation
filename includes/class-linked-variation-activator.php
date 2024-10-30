<?php

// If this file is called directly, abort.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Fired during plugin activation
 *
 * @link       http://www.multidots.com/
 * @since      1.0.0
 *
 * @package    DSALV_Advanced_Linked_Variations
 * @subpackage DSALV_Advanced_Linked_Variations/includes
 */

/**
 * Fired during plugin activation.
 *
 * This class defines all code necessary to run during the plugin's activation.
 *
 * @since      1.0.0
 * @package    DSALV_Advanced_Linked_Variations
 * @subpackage DSALV_Advanced_Linked_Variations/includes
 * @author     Multidots <inquiry@multidots.in>
 */
if ( !class_exists( 'DSALV_Free_advanced_linked_variations_Activator' ) ) {
	class DSALV_Free_advanced_linked_variations_Activator {

		/**
		 * Short Description. (use period)
		 *
		 * Long Description.
		 *
		 * @since    1.0.0
		 */
		public static function activate() {
            global $dsalv_db_version;
			$dsalv_db_version = '1.0.0';
			if (  in_array( 'woocommerce/woocommerce.php', apply_filters( 'active_plugins', get_option( 'active_plugins' ) ), true ) ||  is_plugin_active_for_network( 'woocommerce/woocommerce.php' ) ) {
				set_transient( '_welcome_screen_activation_redirect_ds_advanced_linked_variations', true, 30 );
			} else {
				wp_die( "<strong>Advanced Linked Variations</strong> plugin requires <strong>WooCommerce</strong>. Return to <a href='" . esc_url( get_admin_url( null, 'plugins.php' ) ) . "'>Plugins page</a>." );
			}
			add_option( 'dsalv_db_version', $dsalv_db_version );
			// Default settings.
			update_option( 'alv_settings_positions', 'above_the_add_to_cart_button' );
			update_option( 'alv_settings_tooltip_pos', 'top' );
			update_option( 'alv_settings_hide_emt_terms', 'yes' );
			update_option( 'alv_settings_exl_hidden_product', 'yes' );
			update_option( 'alv_settings_exl_unpurcha_product', 'yes' );
			update_option( 'alv_settings_link_individual_product', 'open_in_the_same_tab' );
			update_option( 'alv_settings_use_unfollow_links', 'yes' );
		}
	}
}