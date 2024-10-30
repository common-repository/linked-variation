<?php

// If this file is called directly, abort.
if ( !defined( 'ABSPATH' ) ) {
    exit;
}
/**
 * The file that defines the core plugin class
 *
 * A class definition that includes attributes and functions used across both the
 * public-facing side of the site and the admin area.
 *
 * @link       http://www.multidots.com
 * @since      1.0.0
 *
 * @package    DSALV_Advanced_Linked_Variations
 * @subpackage DSALV_Advanced_Linked_Variations/includes
 */
/**
 * The core plugin class.
 *
 * This is used to define internationalization, admin-specific hooks, and
 * public-facing site hooks.
 *
 * Also maintains the unique identifier of this plugin as well as the current
 * version of the plugin.
 *
 * @since      1.0.0
 * @package    DSALV_Advanced_Linked_Variations
 * @subpackage DSALV_Advanced_Linked_Variations/includes
 * @author     Multidots <inquiry@multidots.in>
 */
if ( !class_exists( 'DSALV_Advanced_Linked_Variations' ) ) {
    class DSALV_Advanced_Linked_Variations
    {
        /**
         * The loader that's responsible for maintaining and registering all hooks that power
         * the plugin.
         *
         * @since    1.0.0
         * @access   protected
         * @var      DSALV_Advanced_Linked_Variations_Loader $loader Maintains and registers all hooks for the plugin.
         */
        protected  $loader ;
        /**
         * The unique identifier of this plugin.
         *
         * @since    1.0.0
         * @access   protected
         * @var      string $plugin_name The string used to uniquely identify this plugin.
         */
        protected  $plugin_name ;
        /**
         * The current version of the plugin.
         *
         * @since    1.0.0
         * @access   protected
         * @var      string $version The current version of the plugin.
         */
        protected  $version ;
        /**
         * Define the core functionality of the plugin.
         *
         * Set the plugin name and the plugin version that can be used throughout the plugin.
         * Load the dependencies, define the locale, and set the hooks for the admin area and
         * the public-facing side of the site.
         *
         * @since    1.0.0
         */
        public function __construct()
        {
            $this->plugin_name = 'dsalv-linked-variation';
            $this->version = DSALV_PLUGIN_VERSION;
            $this->load_dependencies();
            $this->define_admin_hooks();
            $this->define_public_hooks();

            add_filter( 'plugin_row_meta', array($this, 'plugin_row_meta_action_links'), 20, 3 );
        }
        
        /**
         * Load the required dependencies for this plugin.
         *
         * Include the following files that make up the plugin:
         *
         * - DSALV_Advanced_Linked_Variations_Loader. Orchestrates the hooks of the plugin.
         * - DSALV_Advanced_Linked_Variations_Loader_Admin. Defines all hooks for the admin area.
         *
         * Create an instance of the loader which will be used to register the hooks
         * with WordPress.
         *
         * @since    1.0.0
         * @access   private
         */
        private function load_dependencies()
        {
            /**
             * The class responsible for orchestrating the actions and filters of the
             * core plugin.
             */
            require_once plugin_dir_path( dirname( __FILE__ ) ) . 'includes/class-linked-variation-loader.php';
            /**
             * The class responsible for defining all actions that occur in the admin area.
             */
            require_once plugin_dir_path( dirname( __FILE__ ) ) . 'admin/class-linked-variation-admin.php';
            /**
             * The class responsible for defining all actions that occur in the public-facing
             * side of the site.
             */
            require_once plugin_dir_path( dirname( __FILE__ ) ) . 'public/class-linked-variation-public.php';
            $this->loader = new DSALV_Advanced_Linked_Variations_Loader();
        }
        
        /**
         * Register all of the hooks related to the admin area functionality
         * of the plugin.
         *
         * @since    1.0.0
         * @access   private
         */
        private function define_admin_hooks()
        {
            $page = filter_input( INPUT_GET, 'page', FILTER_SANITIZE_FULL_SPECIAL_CHARS );
            $plugin_admin = new DSALV_Advanced_Linked_Variations_Admin( $this->get_plugin_name(), $this->get_version() );
            $this->loader->add_action( 'admin_enqueue_scripts', $plugin_admin, 'dsalv_enqueue_styles' );
            $this->loader->add_action( 'admin_enqueue_scripts', $plugin_admin, 'dsalv_enqueue_scripts' );
            $this->loader->add_action( 'admin_menu', $plugin_admin, 'dsalv_admin_menu_intigration' );
            $this->loader->add_action( 'admin_head', $plugin_admin, 'dsalv_admin_main_menu_icon_css' );
            $this->loader->add_action( 'admin_head', $plugin_admin, 'dsalv_remove_admin_submenus' );
            $this->loader->add_action( 'wp_ajax_dsalv_save_settings', $plugin_admin, 'dsalv_save_settings' );
            $this->loader->add_action( 'wp_ajax_nopriv_dsalv_save_settings', $plugin_admin, 'dsalv_save_settings' );
            
            if ( !empty($page) && false !== strpos( $page, 'alv' ) ) {
                $this->loader->add_filter( 'admin_footer_text', $plugin_admin, 'dsalv_admin_footer_review' );
            }
            /** Welcome Screen */
            $this->loader->add_action( 'admin_init', $plugin_admin, 'dsalv_welcome_screen_do_activation_redirect' );
            $this->loader->add_action( 'init', $plugin_admin, 'dsalv_alv_postype' );
            $this->loader->add_filter( 'manage_edit-dsalv_columns', $plugin_admin, 'dsalv_custom_column', 10 );
			$this->loader->add_action( 'manage_dsalv_posts_custom_column', $plugin_admin, 'dsalv_custom_column_value', 10, 2 );
            $this->loader->add_action( 'add_meta_boxes', $plugin_admin, 'dsalv_add_meta_boxes'  );
			$this->loader->add_action( 'save_post_dsalv', $plugin_admin, 'dsalv_save_meta_boxes' );
            $this->loader->add_action( 'admin_notices', $plugin_admin, 'dsalv_admin_notice_review_callback' );

            if( !empty( get_option( 'alv_settings_positions') ) ){
                $alv_settings_positions = get_option( 'alv_settings_positions');
                if( 'above_the_add_to_cart_button' === $alv_settings_positions ){
                    $this->loader->add_action( 'woocommerce_single_product_summary', $plugin_admin, 'show_link_variations', 25 );
                }
                if( 'under_the_add_to_cart_button' === $alv_settings_positions ){
                    $this->loader->add_action( 'woocommerce_single_product_summary', $plugin_admin, 'show_link_variations', 35 );
                }
                if( 'under_the_title' === $alv_settings_positions ){
                    $this->loader->add_action( 'woocommerce_single_product_summary', $plugin_admin, 'show_link_variations', 6 );
                }
                if( 'under_the_price' === $alv_settings_positions ){
                    $this->loader->add_action( 'woocommerce_single_product_summary', $plugin_admin, 'show_link_variations', 11 );
                }
                if( 'under_the_excerpt' === $alv_settings_positions ){
                    $this->loader->add_action( 'woocommerce_single_product_summary', $plugin_admin, 'show_link_variations', 21 );
                }
            }
            
            $this->loader->add_action( 'wp_ajax_dsalv_add_new_variation', $plugin_admin, 'dsalv_add_new_variation' );
            $this->loader->add_action( 'wp_ajax_dsalv_searchalltags', $plugin_admin, 'dsalv_searchalltags' );
        }
        
        /**
         * Register all of the hooks related to the public-facing functionality
         * of the plugin.
         *
         * @since    1.0.0
         * @access   private
         */
        private function define_public_hooks()
        {
            $plugin_public = new DSALV_Advanced_Linked_Variations_Public( $this->get_plugin_name(), $this->get_version() );
            
            $this->loader->add_action( 'wp_enqueue_scripts', $plugin_public, 'dsalv_enqueue_public_scripts' );
        }

        /**
         * Add review stars in plugin row meta
         *
         * @since 1.0.3
         */
        public function plugin_row_meta_action_links( $plugin_meta, $plugin_file, $plugin_data ) {
            if ( isset( $plugin_data['TextDomain'] ) && $plugin_data['TextDomain'] !== 'linked-variation' ) {
                return $plugin_meta;
            }

            $url = esc_url( 'https://wordpress.org/plugins/linked-variation/#reviews' );
            $plugin_meta[] = sprintf('<a href="%s" target="_blank" style="color:#f5bb00;">%s</a>', $url, esc_html( '★★★★★' ));

            return $plugin_meta;
        }
        
        /**
         * Run the loader to execute all of the hooks with WordPress.
         *
         * @since    1.0.0
         */
        public function run()
        {
            $this->loader->run();
        }
        
        /**
         * The name of the plugin used to uniquely identify it within the context of
         * WordPress and to define internationalization functionality.
         *
         * @return    string    The name of the plugin.
         * @since     1.0.0
         */
        public function get_plugin_name()
        {
            return $this->plugin_name;
        }
        
        /**
         * The reference to the class that orchestrates the hooks with the plugin.
         *
         * @return    DSALV_Advanced_Linked_Variations_Loader    Orchestrates the hooks of the plugin.
         * @since     1.0.0
         */
        public function get_loader()
        {
            return $this->loader;
        }
        
        /**
         * Retrieve the version number of the plugin.
         *
         * @return    string    The version number of the plugin.
         * @since     1.0.0
         */
        public function get_version()
        {
            return $this->version;
        }
    
    }
}