<?php

/**
 * Plugin Name: Advanced Linked Variations for Woocommerce
 * Plugin URI: https://www.thedotstore.com/
 * Description: Advanced Linked Variation allows users to show various products or product variants as variations of a WooCommerce product, without adding it as that product’s variant in reality.
 * Version: 1.0.3
 * Author: theDotstore
 * Author URI: https://www.thedotstore.com
 * License: GPL-2.0+
 * License URI: http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain: linked-variation
 * Domain Path: /languages/
 * 
 * WC requires at least: 5.1
 * WC tested up to: 9.1.4
 * WP tested up to: 6.6.1
 * Requires PHP: 5.6
 * Requires at least: 4.0
 */
// If this file is called directly, abort.
if ( !defined( 'ABSPATH' ) ) {
    die;
}

if ( !defined( 'DSALV_PLUGIN_VERSION' ) ) {
    define( 'DSALV_PLUGIN_VERSION', '1.0.3' );
}
if ( !defined( 'DSALV_PLUGIN_URL' ) ) {
    define( 'DSALV_PLUGIN_URL', plugin_dir_url( __FILE__ ) );
}
if ( !defined( 'DSALV_PLUGIN_NAME' ) ) {
    define( 'DSALV_PLUGIN_NAME', 'Advanced Linked Variations for Woocommerce' );
}
if ( in_array( 'woocommerce/woocommerce.php', apply_filters( 'active_plugins', get_option( 'active_plugins' ) ), true ) || function_exists( 'is_plugin_active_for_network' ) && is_plugin_active_for_network( 'woocommerce/woocommerce.php' ) ) {
    /**
     * The code that runs during plugin activation.
     * This action is documented in includes/class-linked-variation-activator.php
     */
    if ( !function_exists( 'activate_ds_advanced_linked_variations' ) ) {
        function activate_ds_advanced_linked_variations()
        {
            require plugin_dir_path( __FILE__ ) . 'includes/class-linked-variation-activator.php';
            DSALV_Free_advanced_linked_variations_Activator::activate();
        }
    
    }
    /**
     * The code that runs during plugin deactivation.
     * This action is documented in includes/class-linked-variation-deactivator.php
     */
    if ( !function_exists( 'deactivate_ds_advanced_linked_variations' ) ) {
        function deactivate_ds_advanced_linked_variations()
        {
            require plugin_dir_path( __FILE__ ) . 'includes/class-linked-variation-deactivator.php';
            DSALV_Free_advanced_linked_variations_Deactivator::deactivate();
        }
    }
    register_activation_hook( __FILE__, 'activate_ds_advanced_linked_variations' );
    register_deactivation_hook( __FILE__, 'deactivate_ds_advanced_linked_variations' );
    /**
     * The core plugin class that is used to define internationalization,
     * admin-specific hooks, and public-facing site hooks.
     */
    require plugin_dir_path( __FILE__ ) . 'includes/class-linked-variation.php';
    /**
     * Begins execution of the plugin.
     *
     * Since everything within the plugin is registered via hooks,
     * then kicking off the plugin from this point in the file does
     * not affect the page life cycle.
     *
     * @since    1.0.0
     */
    if ( !function_exists( 'run_ds_free_advanced_linked_variations' ) ) {
        function run_ds_free_advanced_linked_variations()
        {
            $plugin = new DSALV_Advanced_Linked_Variations();
            $plugin->run();
        }
    }
}

/**
 * Check Initialize plugin in case of WooCommerce plugin is missing.
 *
 * @since    1.0.0
 */
if ( !function_exists( 'dsalv_initialize_plugin' ) ) {
    function dsalv_initialize_plugin()
    {
        
        if ( !in_array( 'woocommerce/woocommerce.php', apply_filters( 'active_plugins', get_option( 'active_plugins' ) ), true ) && (!function_exists( 'is_plugin_active_for_network' ) || !is_plugin_active_for_network( 'woocommerce/woocommerce.php' )) ) {
            add_action( 'admin_notices', 'dsalv_plugin_admin_notice' );
        } else {
            run_ds_free_advanced_linked_variations();
        }
        
        // Load the plugin text domain for translation.
        load_plugin_textdomain( 'linked-variation', false, dirname( plugin_basename( __FILE__ ) ) . '/languages/' );
    }

}
add_action( 'plugins_loaded', 'dsalv_initialize_plugin' );

/**
 * Show admin notice in case of WooCommerce plugin is missing.
 *
 * @since    1.0.0
 */
if ( !function_exists( 'dsalv_plugin_admin_notice' ) ) {
    function dsalv_plugin_admin_notice()
    {
        $dsalv_plugin_name = esc_html__( 'Advanced Linked Variations', 'linked-variation' );
        $wc_plugin = esc_html__( 'WooCommerce', 'linked-variation' );
        ?>
        <div class="error">
            <p>
                <?php 
                    echo  sprintf( esc_html__( '%1$s requires %2$s to be installed & activated!', 'linked-variation' ), '<strong>' . esc_html( $dsalv_plugin_name ) . '</strong>', '<a href="' . esc_url( 'https://wordpress.org/plugins/woocommerce/' ) . '" target="_blank"><strong>' . esc_html( $wc_plugin ) . '</strong></a>' ) ;
                ?>
            </p>
        </div>
        <?php 
    }
}

/**
 * Plugin compability with WooCommerce HPOS
 *
 * @since 1.0.2
 */
add_action( 'before_woocommerce_init', function () {
    if ( class_exists( \Automattic\WooCommerce\Utilities\FeaturesUtil::class ) ) {
        \Automattic\WooCommerce\Utilities\FeaturesUtil::declare_compatibility( 'custom_order_tables', __FILE__, true );
    }
} );
