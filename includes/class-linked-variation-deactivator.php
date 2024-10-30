<?php

// If this file is called directly, abort.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
/**
 * Fired during plugin deactivation
 *
 * @link       http://www.multidots.com
 * @since      1.0.0
 *
 * @package    DSALV_Advanced_Linked_Variations
 * @subpackage DSALV_Advanced_Linked_Variations/includes
 */

/**
 * Fired during plugin deactivation.
 *
 * This class defines all code necessary to run during the plugin's deactivation.
 *
 * @since      1.0.0
 * @package    DSALV_Advanced_Linked_Variations
 * @subpackage DSALV_Advanced_Linked_Variations/includes
 * @author     Multidots <inquiry@multidots.in>
 */

if ( !class_exists( 'DSALV_Free_advanced_linked_variations_Deactivator' ) ) {
	class DSALV_Free_advanced_linked_variations_Deactivator {

		/**
		 * Short Description. (use period)
		 *
		 * Long Description.
		 *
		 * @since    1.0.0
		 */
		public static function deactivate() {

		}

	}
}