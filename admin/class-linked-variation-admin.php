<?php

// If this file is called directly, abort.
if ( !defined( 'ABSPATH' ) ) {
    exit;
}
/**
 * The admin-specific functionality of the plugin.
 *
 * @link       http://www.multidots.com
 * @since      1.0.0
 *
 * @package    DSALV_Advanced_Linked_Variations
 * @subpackage DSALV_Advanced_Linked_Variations/admin
 */
/**
 * The admin-specific functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the admin-specific stylesheet and JavaScript.
 *
 * @package    DSALV_Advanced_Linked_Variations
 * @subpackage DSALV_Advanced_Linked_Variations/admin
 * @author     Multidots <inquiry@multidots.in>
 */
if ( !class_exists( 'DSALV_Advanced_Linked_Variations_Admin' ) ) {
    class DSALV_Advanced_Linked_Variations_Admin
    {
        /**
         * The ID of this plugin.
         *
         * @since    1.0.0
         * @access   private
         * @var      string $plugin_name The ID of this plugin.
         */
        private  $plugin_name ;
        /**
         * The version of this plugin.
         *
         * @since    1.0.0
         * @access   private
         * @var      string $version The current version of this plugin.
         */
        private  $version ;
        
        /**
         * Initialize the class and set its properties.
         *
         * @param string $plugin_name The name of this plugin.
         * @param string $version     The version of this plugin.
         *
         * @since    1.0.0
         */
        public function __construct( $plugin_name, $version )
        {
            $this->plugin_name = $plugin_name;
            $this->version = $version;
        }
        /**
         * Register the stylesheets for the admin area.
         *
         * @param string $hook display current page name
         *
         * @since    1.0.0
         *
         */
        public function dsalv_enqueue_styles( $hook )
        {
            $post_type = filter_input( INPUT_GET, 'post_type', FILTER_SANITIZE_FULL_SPECIAL_CHARS );
            if( empty( $post_type ) ){
                $post_type = get_post_type( get_the_ID() );
            }
            if ( false !== strpos( $hook, '_page_alv' ) || ( isset( $post_type ) && 'dsalv' === $post_type )) {
                wp_enqueue_style(
                    $this->plugin_name . 'select2-min-style',
                    plugin_dir_url( __FILE__ ) . 'css/select2.min.css',
                    array(),
                    'all'
                );
                wp_enqueue_style(
                    $this->plugin_name . 'jquery-ui-min-style',
                    plugin_dir_url( __FILE__ ) . 'css/jquery-ui.min.css',
                    array(),
                    'all'
                );
                wp_enqueue_style(
                    $this->plugin_name . 'font-awesome-style',
                    plugin_dir_url( __FILE__ ) . 'css/font-awesome.min.css',
                    array(),
                    'all'
                );
                wp_enqueue_style(
                    $this->plugin_name . 'main-style',
                    plugin_dir_url( __FILE__ ) . 'css/style.css',
                    array(),
                    'all'
                );
                wp_enqueue_style(
                    $this->plugin_name . 'media-style',
                    plugin_dir_url( __FILE__ ) . 'css/media.css',
                    array(),
                    'all'
                );
                wp_enqueue_style(
                    $this->plugin_name . 'notice-css',
                    plugin_dir_url( __FILE__ ) . 'css/notice.css',
                    array(),
                    'all'
                );
            }
        
        }
        
        /**
         * Register the JavaScript for the admin area.
         *
         * @param string $hook display current page name
         *
         * @since    1.0.0
         *
         */
        public function dsalv_enqueue_scripts( $hook )
        {
            $post_type = filter_input( INPUT_GET, 'post_type', FILTER_SANITIZE_FULL_SPECIAL_CHARS );
            if( empty( $post_type ) ){
                $post_type = get_post_type( get_the_ID() );
            }
            if ( false !== strpos( $hook, '_page_alv' ) || ( isset( $post_type ) && 'dsalv' === $post_type ) ) {
                wp_enqueue_script(
                    $this->plugin_name . 'select2',
                    plugin_dir_url( __FILE__ ) . 'js/select2.min.js',
                    array( 'jquery' ),
                    $this->version,
                    true
                );
                wp_enqueue_script(
                    $this->plugin_name . 'admin-js',
                    plugin_dir_url( __FILE__ ) . 'js/linked-variations-admin.js',
                    array(),
                    $this->version,
                    true
                );
                wp_localize_script( $this->plugin_name . 'admin-js', 'coditional_vars', array(
                    'ajaxurl' => admin_url( 'admin-ajax.php' ),
                ) );

                wp_enqueue_script(
                    $this->plugin_name . 'lvg-admin-js',
                    plugin_dir_url( __FILE__ ) . 'js/linked-variations-group-admin.js',
                    array(
						'jquery',
						'wc-enhanced-select',
						'jquery-ui-sortable'
					),
                    $this->version,
                    true
                );
            }
        
        }
        
        /*
         * Shipping method Pro Menu
         *
         * @since    1.0.0
         */
        public function dsalv_admin_menu_intigration()
        {
            global  $GLOBALS ;
            if ( empty($GLOBALS['admin_page_hooks']['dots_store']) ) {
                add_menu_page(
                    'DotStore Plugins',
                    __( 'DotStore Plugins', 'linked-variation' ),
                    'null',
                    'dots_store',
                    'dot_store_menu_page',
                    'dashicons-marker',
                    25
                );
            }
            add_submenu_page(
                'dots_store',
                'Advanced Linked Variations',
                __( 'Advanced Linked Variations', 'linked-variation' ),
                'manage_options',
                'alv-settings',
                array( $this, 'dsalv_admin_settings_page' )
            );
            add_submenu_page(
                'edit.php?post_type=dsalv',
                'Linked Variations Group',
                __( 'Advanced Linked Variations', 'linked-variation' ),
                'manage_options',
                'alv-linked-variations-group',
                array( $this, 'dsalv_admin_variation_group_page' )
            );
            add_submenu_page(
                'dots_store',
                'Getting Started',
                __( 'Getting Started', 'linked-variation' ),
                'manage_options',
                'alv-get-started',
                array( $this, 'dsalv_get_started_page' )
            );
            add_submenu_page(
                'dots_store',
                'Quick info',
                __( 'Quick info', 'linked-variation' ),
                'manage_options',
                'alv-information',
                array( $this, 'dsalv_information_page' )
            );
        }

        /**
         * Add custom css for dotstore icon in admin area
         *
         * @since  1.0.2
         *
         */
        public function dsalv_admin_main_menu_icon_css() {
          echo '<style>
            .toplevel_page_dots_store .dashicons-marker::after{content:"";border:3px solid;position:absolute;top:14px;left:15px;border-radius:50%;opacity: 0.6;}
            li.toplevel_page_dots_store:hover .dashicons-marker::after,li.toplevel_page_dots_store.current .dashicons-marker::after{opacity: 1;}
            @media only screen and (max-width: 960px){
                .toplevel_page_dots_store .dashicons-marker::after{left:14px;}
            }
            </style>';
        }
        
        /**
         * Quick guide page
         *
         * @since    1.0.0
         */
        public function dsalv_get_started_page()
        {
            require_once plugin_dir_path( __FILE__ ) . 'partials/dsalv-get-started-page.php';
        }
        
        /**
         * Plugin information page
         *
         * @since    1.0.0
         */
        public function dsalv_information_page()
        {
            require_once plugin_dir_path( __FILE__ ) . 'partials/dsalv-information-page.php';
        }
        
        /**
         * Plugin information page
         *
         * @since    1.0.0
         */
        public function dsalv_admin_settings_page()
        {
            require_once plugin_dir_path( __FILE__ ) . 'partials/dsalv-admin-settings-page.php';
        }

        /**
         * Plugin variation group page
         *
         * @since    1.0.0
         */
        public function dsalv_admin_variation_group_page()
        {
            require_once plugin_dir_path( __FILE__ ) . 'partials/dsalv-variation-group-page.php';
        }
        
        /**
         * Remove submenu from admin screeen
         *
         * @since    1.0.0
         */
        public function dsalv_remove_admin_submenus()
        {
            remove_submenu_page( 'dots_store', 'alv-get-started' );
            remove_submenu_page( 'dots_store', 'alv-information' );
            remove_submenu_page( 'dots_store', 'alv-linked-variations-group' );
        }

        /**
         * plugin admin review notice.
         */
        public function dsalv_admin_notice_review_callback() {
            $get_post_type = filter_input( INPUT_GET, 'post_type', FILTER_SANITIZE_FULL_SPECIAL_CHARS );
            if( empty( $get_post_type ) ){
                $get_post_type = get_post_type( get_the_ID() );
            }
            if ( isset( $get_post_type ) && $get_post_type === 'dsalv' ) {
                include_once plugin_dir_path( __FILE__ ) . 'partials/header/plugin-header.php';
            }
        }
        
        /**
         * Show admin footer review text.
         *
         * @since    1.0.0
         */
        public function dsalv_admin_footer_review()
        {
            $url = esc_url( 'https://wordpress.org/plugins/linked-variation/#reviews' );
            $html = sprintf( wp_kses( __( '<strong>We need your support</strong> to keep updating and improving the plugin. Please <a href="%1$s" target="_blank">help us by leaving a good review</a> :) Thanks!', 'linked-variation' ), array(
                'strong' => array(),
                'a'      => array(
                    'href'   => array(),
                    'target' => 'blank',
                ),
            ) ), esc_url( $url ) );
            echo wp_kses_post( $html );
        }
        
        /**
         * Save For Later welcome page
         *
         * @since    1.0.0
         */
        public function dsalv_welcome_screen_do_activation_redirect()
        {
            // if no activation redirect
            if ( !get_transient( '_welcome_screen_activation_redirect_ds_advanced_linked_variations' ) ) {
                return;
            }
            // Delete the redirect transient
            delete_transient( '_welcome_screen_activation_redirect_ds_advanced_linked_variations' );
            // Redirect to save for later welcome  page
            wp_safe_redirect( add_query_arg( array(
                'page' => 'alv-get-started',
            ), admin_url( 'admin.php' ) ) );
            exit;
        }

        /**
         * Save settings data
         *
         * @since 1.0.0
         */
        public function dsalv_save_settings(){
            $alv_settings_positions               = filter_input( INPUT_GET, 'alv_settings_positions', FILTER_SANITIZE_FULL_SPECIAL_CHARS );
            $alv_settings_tooltip_pos             = filter_input( INPUT_GET, 'alv_settings_tooltip_pos', FILTER_SANITIZE_FULL_SPECIAL_CHARS );
            $alv_settings_hide_emt_terms          = filter_input( INPUT_GET, 'alv_settings_hide_emt_terms', FILTER_SANITIZE_FULL_SPECIAL_CHARS );
            $alv_settings_exl_hidden_product      = filter_input( INPUT_GET, 'alv_settings_exl_hidden_product', FILTER_SANITIZE_FULL_SPECIAL_CHARS );
            $alv_settings_exl_unpurcha_product    = filter_input( INPUT_GET, 'alv_settings_exl_unpurcha_product', FILTER_SANITIZE_FULL_SPECIAL_CHARS );
            $alv_settings_link_individual_product = filter_input( INPUT_GET, 'alv_settings_link_individual_product', FILTER_SANITIZE_FULL_SPECIAL_CHARS );
            $alv_settings_use_unfollow_links      = filter_input( INPUT_GET, 'alv_settings_use_unfollow_links', FILTER_SANITIZE_FULL_SPECIAL_CHARS );

            $alv_settings_positions = ( !empty($alv_settings_positions) ? sanitize_text_field( wp_unslash( $alv_settings_positions ) ) : '' );
            $alv_settings_tooltip_pos = ( !empty($alv_settings_tooltip_pos) ? sanitize_text_field( wp_unslash( $alv_settings_tooltip_pos ) ) : '' );
            $alv_settings_hide_emt_terms = ( !empty($alv_settings_hide_emt_terms) ? sanitize_text_field( wp_unslash( $alv_settings_hide_emt_terms ) ) : '' );
            $alv_settings_exl_hidden_product = ( !empty($alv_settings_exl_hidden_product) ? sanitize_text_field( wp_unslash( $alv_settings_exl_hidden_product ) ) : '' );
            $alv_settings_exl_unpurcha_product = ( !empty($alv_settings_exl_unpurcha_product) ? sanitize_text_field( wp_unslash( $alv_settings_exl_unpurcha_product ) ) : '' );
            $alv_settings_link_individual_product = ( !empty($alv_settings_link_individual_product) ? sanitize_text_field( wp_unslash( $alv_settings_link_individual_product ) ) : '' );
            $alv_settings_use_unfollow_links = ( !empty($alv_settings_use_unfollow_links) ? sanitize_text_field( wp_unslash( $alv_settings_use_unfollow_links ) ) : '' );

            if ( isset( $alv_settings_positions ) && !empty($alv_settings_positions) ) {
                update_option( 'alv_settings_positions', $alv_settings_positions );
            } else {
                update_option( 'alv_settings_positions', '' );
            }

            if ( isset( $alv_settings_tooltip_pos ) && !empty($alv_settings_tooltip_pos) ) {
                update_option( 'alv_settings_tooltip_pos', $alv_settings_tooltip_pos );
            } else {
                update_option( 'alv_settings_tooltip_pos', '' );
            }

            if ( isset( $alv_settings_hide_emt_terms ) && !empty($alv_settings_hide_emt_terms) ) {
                update_option( 'alv_settings_hide_emt_terms', $alv_settings_hide_emt_terms );
            } else {
                update_option( 'alv_settings_hide_emt_terms', '' );
            }

            if ( isset( $alv_settings_exl_hidden_product ) && !empty($alv_settings_exl_hidden_product) ) {
                update_option( 'alv_settings_exl_hidden_product', $alv_settings_exl_hidden_product );
            } else {
                update_option( 'alv_settings_exl_hidden_product', '' );
            }

            if ( isset( $alv_settings_exl_unpurcha_product ) && !empty($alv_settings_exl_unpurcha_product) ) {
                update_option( 'alv_settings_exl_unpurcha_product', $alv_settings_exl_unpurcha_product );
            } else {
                update_option( 'alv_settings_exl_unpurcha_product', '' );
            }

            if ( isset( $alv_settings_link_individual_product ) && !empty($alv_settings_link_individual_product) ) {
                update_option( 'alv_settings_link_individual_product', $alv_settings_link_individual_product );
            } else {
                update_option( 'alv_settings_link_individual_product', '' );
            }

            if ( isset( $alv_settings_use_unfollow_links ) && !empty($alv_settings_use_unfollow_links) ) {
                update_option( 'alv_settings_use_unfollow_links', $alv_settings_use_unfollow_links );
            } else {
                update_option( 'alv_settings_use_unfollow_links', '' );
            }
        }

        /**
         * 
         * Register post type of linked variations.
         * 
         */
        function dsalv_alv_postype() {
            
            // post type
            $labels = array(
                'name'          => _x( 'Advanced Linked Variations', 'Post Type General Name', 'linked-variation' ),
                'singular_name' => _x( 'Advanced Linked Variation', 'Post Type Singular Name', 'linked-variation' ),
                'add_new_item'  => esc_html__( 'Add New Advanced Linked Variation', 'linked-variation' ),
                'add_new'       => esc_html__( 'Add New', 'linked-variation' ),
                'edit_item'     => esc_html__( 'Edit Advanced Linked Variation', 'linked-variation' ),
                'update_item'   => esc_html__( 'Update Advanced Linked Variation', 'linked-variation' ),
                'search_items'  => esc_html__( 'Search', 'linked-variation' ),
            );

            $args = array(
                'label'               => esc_html__( 'Advanced Linked Variation', 'linked-variation' ),
                'labels'              => $labels,
                'supports'            => array( 'title' ),
                'hierarchical'        => false,
                'public'              => false,
                'show_ui'             => true,
                'show_in_menu'        => false,
                'show_in_nav_menus'   => true,
                'show_in_admin_bar'   => true,
                'menu_position'       => 28,
                'menu_icon'           => 'dashicons-admin-links',
                'can_export'          => true,
                'has_archive'         => false,
                'exclude_from_search' => true,
                'publicly_queryable'  => false,
                'capability_type'     => 'post',
                'show_in_rest'        => false,
            );

            register_post_type( 'dsalv', $args );
        }

        function dsalv_custom_column( $columns ) {
            $columns['dsalv_configuration'] = esc_html__( 'Configuration', 'linked-variation' );

            return $columns;
        }

        function dsalv_custom_column_value( $column, $postid ) {
            if ( $column === 'dsalv_configuration' ) {
                $info = get_post_meta( $postid, 'dsalv_link', true );
                if( is_array( $info ) && !empty( $info ) ){
                    $info = $info[0];
                }
                if ( ! empty( $info ) && isset( $info['source'] ) ) {
                    switch ( $info['source'] ) {
                        case 'products':
                            echo esc_html__( 'Products', 'linked-variation' ) . ': ';

                            if ( ! empty( $info['products'] ) ) {
                                $products = explode( ',', $info['products'] );

                                foreach ( $products as $pid ) {
                                    echo esc_html__( get_the_title( $pid ), 'linked-variation' ) . ', ';
                                }
                            }

                            break;
                        case 'categories':
                            echo esc_html__( 'Categories', 'linked-variation' ) . ': ' . esc_html__( $info['categories'], 'linked-variation' );

                            break;
                        case 'tags':
                            echo esc_html__( 'Tags', 'linked-variation' ) . ': ' . esc_html__( $info['tags'], 'linked-variation' );
                            break;
                    }
                }
            }
        }
        function dsalv_add_meta_boxes() {
            add_meta_box( 'dsalv_configuration', esc_html__( 'Configuration', 'linked-variation' ), array(
                $this,
                'dsalv_meta_box_callback'
            ), 'dsalv', 'advanced', 'low' );
        }

        function dsalv_meta_box_callback( $post ) {
            $post_id = $post->ID;
            $link    = get_post_meta( $post_id, 'dsalv_link', true );
            ?>
            <table class="form-table">
                <tr>
                    <td colspan="2">
                        <div class="dsalv_links">
                            <?php
                            if ( ! empty( $link ) ) {
                                $this->dsalv_link_2( $link );
                            } else {
                                $this->dsalv_link_2();
                            }
                            
                            ?>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td colspan="2">
                        <a href="javascript:void(0);" id="dsalv_add_lv"><?php echo esc_html__( '+ Add Linked Variations', 'linked-variation' ); ?></a>
                    </td>
                </tr>
            </table>
            <?php
        }

        function dsalv_save_meta_boxes( $post_id ) {
            $dsalv_link      = filter_input(INPUT_POST, 'dsalv_link', FILTER_SANITIZE_FULL_SPECIAL_CHARS, FILTER_REQUIRE_ARRAY);
            $dsalv_link_data = isset( $dsalv_link ) ? $dsalv_link : array();
            if ( !empty( $dsalv_link_data ) ) {
                update_post_meta( $post_id, 'dsalv_link', $dsalv_link_data );
            }
        }

        function dsalv_link_2( $link = null ) {
            $all_link = $link;
            
            if( !$all_link && empty( $all_link ) ){
                $all_link = Array ( 0 => Array(
                    'attributes' => array(),
                    'images' => array(),
                    )
                );
            }
            
            foreach ( $all_link as $key=>$link ) {
                
                isset( $link['attributes'] ) ?: $link['attributes'] = array();
                isset( $link['images'] ) ?: $link['images'] = array();

                $link_source     = isset( $link['source'] ) ? $link['source'] : 'products';
                $link_categories = isset( $link['categories'] ) ? $link['categories'] : '';
                $link_tags       = isset( $link['tags'] ) ? $link['tags'] : '';
                $link_prod       = isset( $link['products'] ) ? $link['products'] : '';
                $wc_attributes   = wc_get_attribute_taxonomies();
                $attributes      = array();

                foreach ( $wc_attributes as $wc_attribute ) {
                    $attributes[ 'id:' . $wc_attribute->attribute_id ] = $wc_attribute->attribute_label;
                }
                ?>
                <div class="dsalv_link" data-index="<?php echo esc_attr( $key ); ?>">
                    <div class="dsalv_tr">
                        <div class="dsalv_th">
                            <select class="dsalv-source" name="dsalv_link[<?php echo esc_attr( $key ); ?>][source]">
                                <option value="products" <?php echo( $link_source === 'products' ? 'selected' : '' ); ?>><?php esc_html_e( 'Products', 'linked-variation' ); ?></option>
                                <option value="categories" <?php echo( $link_source === 'categories' ? 'selected' : '' ); ?>><?php esc_html_e( 'Categories', 'linked-variation' ); ?></option>
                                <option value="tags" <?php echo( $link_source === 'tags' ? 'selected' : '' ); ?>><?php esc_html_e( 'Tags', 'linked-variation' ); ?></option>
                            </select>
                        </div>
                        <div class="dsalv_td dsalv_link_td">
                            <div class="dsalv-source-hide dsalv-source-products">
                                <input class="dsalv-products"
                                    name="dsalv_link[<?php echo esc_attr( $key ); ?>][products]" type="hidden"
                                    value="<?php echo esc_attr( $link_prod ); ?>"/>
                                <select class="wc-product-search dsalv-product-search" multiple="multiple"
                                        data-placeholder="<?php esc_attr_e( 'Search for a product&hellip;', 'linked-variation' ); ?>"
                                        data-action="woocommerce_json_search_products">
                                    <?php
                                    $_product_ids = explode( ',', $link_prod );

                                    foreach ( $_product_ids as $_product_id ) {
                                        $_product = wc_get_product( $_product_id );

                                        if ( $_product ) {
                                            echo '<option value="' . esc_attr( $_product_id ) . '" selected="selected">' . wp_kses_post( $_product->get_formatted_name() ) . '</option>';
                                        }
                                    }
                                    ?>
                                </select>
                                <?php echo '<script>jQuery(document.body).trigger( \'wc-enhanced-select-init\' );</script>'; ?>
                            </div>
                            <div class="dsalv-source-hide dsalv-source-categories" style="display:none;">
                                <input class="dsalv-categories"
                                    name="dsalv_link[<?php echo esc_attr( $key ); ?>][categories]" type="hidden"
                                    value="<?php echo esc_attr( $link_categories ); ?>"/>
                                <select class="wc-category-search dsalv-category-search" multiple="multiple"
                                        data-placeholder="<?php esc_attr_e( 'Search for a category&hellip;', 'linked-variation' ); ?>">
                                    <?php
                                    $category_slugs = explode( ',', $link_categories );

                                    if ( count( $category_slugs ) > 0 ) {
                                        foreach ( $category_slugs as $category_slug ) {
                                            $category = get_term_by( 'slug', $category_slug, 'product_cat' );

                                            if ( $category ) {
                                                echo '<option value="' . esc_attr( $category_slug ) . '" selected="selected">' . wp_kses_post( $category->name ) . '</option>';
                                            }
                                        }
                                    }
                                    ?>
                                </select>
                                <?php echo '<script>jQuery(document.body).trigger( \'wc-enhanced-select-init\' );</script>'; ?>
                            </div>
                            <div class="dsalv-source-hide dsalv-source-tags" style="display:none;">
                                <input class="dsalv-tags" name="dsalv_link[<?php echo esc_attr( $key ); ?>][tags]"
                                type="hidden" style="width: 100%"
                                value="<?php echo esc_attr( $link_tags ); ?>"/>
                                <select class="wc-tag-search dsalv-tag-search" multiple="multiple" data-placeholder="<?php esc_attr_e( 'Search for a tags&hellip;', 'linked-variation' ); ?>">
                                        <?php
                                            $link_tags = explode( ',', $link_tags );
                                            $dsalv_source_tags = get_terms( array( 
                                                'hide_empty' => false,
                                                'taxonomy'   => 'product_tag',
                                                )
                                            );
                                            if ( ! empty( $dsalv_source_tags ) && ! is_wp_error( $dsalv_source_tags ) ) {
                                                foreach ( $dsalv_source_tags as $dsalv_cart_tag ) {
                                                    ?>
                                                    <option value="<?php echo esc_attr( $dsalv_cart_tag->slug ); ?>" <?php selected( true, in_array( $dsalv_cart_tag->slug, $link_tags, true ), true ); ?> >
                                                        <?php echo esc_html_e( $dsalv_cart_tag->name, 'linked-variation' ); ?>
                                                    </option>
                                                    <?php
                                                }
                                            }
                                        ?>
                                </select>
                                <?php echo '<script>jQuery(document.body).trigger( \'wc-enhanced-select-init\' );</script>'; ?>
                            </div>
                        </div>
                    </div>
                    <div class="dsalv_tr">
                        <div class="dsalv_th"><?php esc_html_e( 'Linked by (attributes)', 'linked-variation' ); ?></div>
                        <div class="dsalv_td dsalv_link_td dsalv_all_attr">
                            <div id="dsalv_toggle">
                                <span class="expand"><?php esc_html_e( 'Expand+', 'linked-variation' ); ?></span>
                                <span class="collapse" style="display:none;"><?php esc_html_e( 'Collapse-', 'linked-variation' ); ?></span>
                            </div>
                            <div id="dsalv_swtich" style="display:none;">
                                <?php
                                $saved_attributes = $merge_attributes = array();

                                foreach ( $link['attributes'] as $attr ) {
                                    $saved_attributes[ $attr ] = $attributes[ $attr ];
                                }

                                $merge_attributes = array_merge( $saved_attributes, $attributes );

                                if ( $merge_attributes ) {
                                    echo '<div class="dsalv-attributes">';

                                    foreach ( $merge_attributes as $attribute_id => $attribute_label ) {
                                        echo '<div class="dsalv-attribute"><span class="move">' . esc_html__( 'Move', 'linked-variation' ) . '</span><span class="checkbox"><label><input type="checkbox" name="dsalv_link['. esc_attr( $key ) .'][attributes][]" value="' . esc_attr( $attribute_id ) . '" ' . ( is_array( $link['attributes'] ) && in_array( $attribute_id, $link['attributes'], true ) ? 'checked' : '' ) . '/>' . esc_html( $attribute_label ) . '</label></span><span class="display"><label><input type="checkbox" class="dsalv_display_checkbox" name="dsalv_link['. esc_attr( $key ) .'][images][]" value="' . esc_attr( $attribute_id ) . '" ' . ( is_array( $link['images'] ) && in_array( $attribute_id, $link['images'], true ) ? 'checked' : '' ) . '/>' . esc_html__( 'Show images', 'linked-variation' ) . '</label></span></div>';
                                    }

                                    echo '</div>';
                                }
                                ?>
                            </div>
                            <?php if( 0 !== $key ){ ?>
                                <span id="dsalv_delete"><?php esc_html_e( 'Delete', 'linked-variation' ); ?></span>
                            <?php } ?>
                        </div>
                    </div>
                </div>
                <?php
            }
        }
        public static function dsalv_searchalltags(){
            $return = array();
            
            $index = filter_input( INPUT_GET, 'q', FILTER_SANITIZE_FULL_SPECIAL_CHARS );
        

            if( isset( $index ) && !empty( $index ) ){
                $tags = get_tags( ['name__like' => $index] );
                foreach ($tags as $tag) {
                    $return[] = array( $tag->slug, $tag->name );
                }
            }
            
            echo wp_json_encode( $return );
	        die;
        }
        public static function show_link_variations( $product_id = null ) {

            if ( ! $product_id ) {
                global $product;
                $_product   = $product;
                $product_id = $_product->get_id();
            } else {
                $_product = wc_get_product( $product_id );
            }

            if ( ! $_product ) {
                return;
            }

            $link_data = self::get_linked_data( $product_id );
            
            if ( empty( $link_data ) ) {
                return;
            }

            $link_attributes = isset( $link_data['attributes'] ) ? $link_data['attributes'] : array();
            $link_images     = isset( $link_data['images'] ) ? $link_data['images'] : array();

            // get product ids
            $link_products = array();
            $link_source   = isset( $link_data['source'] ) ? $link_data['source'] : 'products';

            if ( ( $link_source === 'products' ) && isset( $link_data['products'] ) && ! empty( $link_data['products'] ) ) {
                $link_products = explode( ',', $link_data['products'] );
            }

            if ( ( $link_source === 'categories' ) && isset( $link_data['categories'] ) && ! empty( $link_data['categories'] ) ) {
                $categories = array_map( 'trim', explode( ',', $link_data['categories'] ) );

                if ( ! empty( $categories ) ) {
                    // phpcs:disable
                    $args = array(
                        'post_type'           => 'product',
                        'post_status'         => 'publish',
                        'ignore_sticky_posts' => 1,
                        'posts_per_page'      => 500,
                        'tax_query'           => array(
                            array(
                                'taxonomy' => 'product_cat',
                                'field'    => 'slug',
                                'terms'    => $categories,
                                'operator' => 'IN',
                            )
                        )
                    );
                    // phpcs:enable

                    $products = new WP_Query( $args );

                    if ( $products->have_posts() ) {
                        while ( $products->have_posts() ) {
                            $products->the_post();
                            $link_products[] = get_the_ID();
                        }
                    }

                    wp_reset_postdata();
                }
            }

            if ( ( $link_source === 'tags' ) && isset( $link_data['tags'] ) && ! empty( $link_data['tags'] ) ) {
                $tags = array_map( 'trim', explode( ',', $link_data['tags'] ) );

                if ( ! empty( $tags ) ) {
                    // phpcs:disable
                    $args = array(
                        'post_type'           => 'product',
                        'post_status'         => 'publish',
                        'ignore_sticky_posts' => 1,
                        'posts_per_page'      => 500,
                        'tax_query'           => array(
                            array(
                                'taxonomy' => 'product_tag',
                                'field'    => 'slug',
                                'terms'    => $tags,
                                'operator' => 'IN',
                            )
                        )
                    );
                    // phpcs:enable

                    $products = new WP_Query( $args );

                    if ( $products->have_posts() ) {
                        while ( $products->have_posts() ) {
                            $products->the_post();
                            $link_products[] = get_the_ID();
                        }
                    }

                    wp_reset_postdata();
                }
            }

            // exclude hidden or unpurchasable
            if ( ( get_option( 'alv_settings_exl_hidden_product', 'no' ) === 'yes' ) || ( get_option( 'alv_settings_exl_unpurcha_product', 'no' ) === 'yes' ) ) {
                foreach ( $link_products as $key => $link_product_id ) {
                    $link_product = wc_get_product( $link_product_id );

                    if ( ! $link_product || ( ! $link_product->is_visible() && ( get_option( 'alv_settings_exl_hidden_product', 'no' ) === 'yes' ) ) || ( ( ! $link_product->is_purchasable() || ! $link_product->is_in_stock() ) && ( get_option( 'alv_settings_exl_unpurcha_product', 'no' ) === 'yes' ) ) ) {
                        unset( $link_products[ $key ] );
                    }
                }
            }

            // exclude current product
            $link_products = array_diff( $link_products, array( $product_id ) );

            if ( empty( $link_products ) ) {
                return;
            }

            $all_taxonomies             = [];
            $filter_assigned_attributes = array_filter( $_product->get_attributes(), 'wc_attributes_array_filter_visible' );
            $assigned_attributes        = array_keys( $filter_assigned_attributes );
            $product_attributes         = [];

            foreach ( $assigned_attributes as $assigned_attribute ) {
                $product_attributes[ $assigned_attribute ] = wc_get_product_terms( $product_id, $assigned_attribute, array( 'fields' => 'slugs' ) );
            }

            if ( ! empty( $link_attributes ) ) { ?>
                <div class="dsalv-attributes">
                    <?php
                    foreach ( $link_attributes as $link_attribute ) {
                        $link_attribute_id = (int) filter_var( $link_attribute, FILTER_SANITIZE_NUMBER_INT );
                        $attribute         = wc_get_attribute( $link_attribute_id );
                        
                        $terms = get_terms( array( 'taxonomy' => $attribute->slug, 'hide_empty' => false ) );
                        $current_terms = wp_get_post_terms( $product_id, $attribute->slug, array( 'fields' => 'ids' ) );
                        array_push( $all_taxonomies, $attribute->slug );
                        ?>
                        <div class="dsalv-attribute">
                        <?php if ( ! empty( $terms ) ) { ?>
                            <div class="dsalv-attribute-label">
                                <?php echo esc_html( $attribute->name ); ?>
                            </div>
                                <div class="dsalv-terms">
                                    <?php foreach ( $terms as $term ) {
                                        if ( in_array( $term->term_id, $current_terms, true ) ) {
                                            if ( in_array( $link_attribute, $link_images, true ) ) {
                                                self::dsalv_term( 'image', $attribute, $term, true, $product_id );
                                            } else {
                                                self::dsalv_term( 'button', $attribute, $term, true, $product_id );
                                            }
                                        } else {
                                            $tax_query = array( 'relation' => 'AND' );

                                            $tax_query_ori = [
                                                'taxonomy' => $term->taxonomy,
                                                'field'    => 'slug',
                                                'terms'    => $term->slug
                                            ];

                                            foreach ( $product_attributes as $product_attribute_key => $product_attribute ) {
                                                if ( $term->taxonomy !== $product_attribute_key ) {
                                                    $tax_query[] = array(
                                                        'taxonomy' => $product_attribute_key,
                                                        'field'    => 'slug',
                                                        'terms'    => $product_attribute
                                                    );
                                                }
                                            }

                                            array_push( $tax_query, $tax_query_ori );

                                            $linked_id = self::get_linked_product_id( $tax_query, $link_products );
                                            
                                            if ( $linked_id ) {
                                                if ( in_array( $link_attribute, $link_images, true ) ) {
                                                    self::dsalv_term( 'image', $attribute, $term, false, $linked_id );
                                                } else {
                                                    self::dsalv_term( 'button', $attribute, $term, false, $linked_id );
                                                }
                                            } else {
                                                $linked_id = self::get_linked_product_id( array( $tax_query_ori ), $link_products );
                                                if ( $linked_id ) {
                                                    if ( in_array( $link_attribute, $link_images, true ) ) {
                                                        self::dsalv_term( 'image', $attribute, $term, false, $linked_id );
                                                    } else {
                                                        self::dsalv_term( 'button', $attribute, $term, false, $linked_id );
                                                    }
                                                } elseif ( get_option( 'alv_settings_hide_emt_terms', 'yes' ) === 'no' ) {
                                                    if ( in_array( $link_attribute, $link_images, true ) ) {
                                                        self::dsalv_term( 'image', $attribute, $term, false );
                                                    } else {
                                                        self::dsalv_term( 'button', $attribute, $term, false );
                                                    }
                                                }
                                            }
                                        }
                                    } ?>
                                </div>
                            <?php } ?>
                        </div>
                    <?php } ?>
                </div>
            <?php }
        }

        public static function dsalv_term( $type, $attribute, $term, $active, $product_id = 0 ) {
            $link       = get_option( 'alv_settings_link_individual_product', 'open_in_the_same_tab' );
            $nofollow   = get_option( 'alv_settings_use_unfollow_links', 'no' ) === 'yes';
            $hint       = get_option( 'alv_settings_tooltip_pos', 'top' );
            $hint_class = $hint !== 'no' ? 'hint--' . $hint : '';
            
            switch ( $type ) {
                case 'image':
                    if ( $product_id && ( $product_thumbnail_id = get_post_thumbnail_id( $product_id ) ) ) { // phpcs:ignore
                        $term_image = '<img src="' . wp_get_attachment_image_url( $product_thumbnail_id ) . '" alt="' . esc_attr( $term->name ) . '"/>';
                    } else {
                        $term_image = wc_placeholder_img();
                    }

                    $html = '<div class="dsalv-term dsalv-term-image ' . $hint_class . ' ' . ( $active ? 'active' : '' ) . '" aria-label="' . esc_attr( apply_filters( 'dsalv_term_label', $term->name, $term, $product_id ) ) . '">';

                    if ( $product_id && ! $active ) {
                        $html .= '<a href="' . ( get_the_permalink( $product_id ) ) . '" ' . ( $nofollow ? 'rel="nofollow"' : '' ) . ' title="' . esc_attr( apply_filters( 'dsalv_term_title', get_the_title( $product_id ), $term, $product_id ) ) . '" ' . ( $link === 'open_in_the_new_tab' ? 'target="_blank"' : '' ) . '>' . $term_image . '</a>';
                    } else {
                        $html .= '<span>' . $term_image . '</span>';
                    }

                    $html .= '</div>';

                    echo wp_kses_post(apply_filters( 'dsalv_term_image', $html ));
                    break;

                case 'button':
                    $html = '<div class="dsalv-term ' . $hint_class . ' ' . ( $active ? 'active' : '' ) . '" aria-label="' . esc_attr( apply_filters( 'dsalv_term_label', $term->name, $term, $product_id ) ) . '">';

                    if ( $product_id && ! $active ) {
                        $html .= '<a href="' . ( get_the_permalink( $product_id ) ) . '" ' . ( $nofollow ? 'rel="nofollow"' : '' ) . ' title="' . esc_attr( apply_filters( 'dsalv_term_title', get_the_title( $product_id ), $term, $product_id ) ) . '" ' . ( $link === 'open_in_the_new_tab' ? 'target="_blank"' : '' ) . '>' . esc_html( $term->name ) . '</a>';
                    } else {
                        $html .= '<span>' . esc_html( $term->name ) . '</span>';
                    }

                    $html .= '</div>';

                    echo wp_kses_post(apply_filters( 'dsalv_term_button', $html ));
                    break;
            }
        }

        public static function get_linked_data( $product_id ) {
            // new data, get the ID only
            $new_links = get_posts( array( // phpcs:ignore
                'post_type'         => 'dsalv',
                'post_status'       => 'publish',
                'posts_per_page'    => - 1,
                'fields'            => 'ids',
                'suppress_filters'  => false
            ) );

            if ( ! empty( $new_links ) ) {
                foreach ( $new_links as $new_link ) {
                    $link = get_post_meta( $new_link, 'dsalv_link', true );

                    if ( ! empty( $link ) ) {
                        foreach ( $link as $link ) {
                            $link_source = isset( $link['source'] ) ? $link['source'] : 'products';

                            if ( ( $link_source === 'products' ) && isset( $link['products'] ) && ! empty( $link['products'] ) ) {
                                $product_ids = array_map( 'intval', explode( ',', $link['products'] ) );

                                if ( in_array( $product_id, $product_ids, true ) ) {
                                    return $link;
                                }
                            }

                            if ( ( $link_source === 'categories' ) && isset( $link['categories'] ) && ! empty( $link['categories'] ) ) {
                                $categories = array_map( 'trim', explode( ',', $link['categories'] ) );

                                if ( has_term( $categories, 'product_cat', $product_id ) ) {
                                    return $link;
                                }
                            }

                            if ( ( $link_source === 'tags' ) && isset( $link['tags'] ) && ! empty( $link['tags'] ) ) {
                                $tags = array_map( 'trim', explode( ',', $link['tags'] ) );

                                if ( has_term( $tags, 'product_tag', $product_id ) ) {
                                    return $link;
                                }
                            }
                        }
                    }
                }
            }

            return false;
        }
        // return post id
        public static function get_linked_product_id( $tax_query, $link_products = [], $order = 'ASC' ) {
            $args = [
                'post_type'         => 'product',
                'posts_per_page'    => - 1,
                'order'             => $order,
                'fields'            => 'ids',
                'suppress_filters'  => false
            ];

            if ( $tax_query ) {
                $args['tax_query'] = $tax_query; // phpcs:ignore
            }

            if ( $link_products ) {
                $args['post__in'] = $link_products;
            }

            $filter_product = get_posts( $args ); // phpcs:ignore

            if ( $filter_product ) {
                return $filter_product[0];
            } else {
                return false;
            }
        }
        public static function dsalv_lv_shortcode( $attrs ) {
            $output = '';
            $attrs  = shortcode_atts( array( 'id' => null ), $attrs );
            
            if ( ! $attrs['id'] ) {
                global $product;

                if ( $product ) {
                    $attrs['id'] = $product->get_id();
                }
            }
            
            if ( $attrs['id'] ) {
                ob_start();
                self::show_link_variations( $attrs['id'] );
                $output = ob_get_clean();
            }

            return $output;
        }
        public static function dsalv_add_new_variation(){
            $link  = array();
            $index = filter_input( INPUT_POST, 'index', FILTER_SANITIZE_FULL_SPECIAL_CHARS );
            isset( $link['attributes'] ) ?: $link['attributes'] = array();
            isset( $link['images'] ) ?: $link['images'] = array();

            $link_source     = isset( $link['source'] ) ? $link['source'] : 'products';
            $link_categories = isset( $link['categories'] ) ? $link['categories'] : '';
            $link_tags       = isset( $link['tags'] ) ? $link['tags'] : '';
            $link_prod       = isset( $link['products'] ) ? $link['products'] : '';
            $wc_attributes   = wc_get_attribute_taxonomies();
            $attributes      = array();

            foreach ( $wc_attributes as $wc_attribute ) {
                $attributes[ 'id:' . $wc_attribute->attribute_id ] = $wc_attribute->attribute_label;
            }
            ?>
            <div class="dsalv_link" data-index="<?php echo esc_attr( $index ); ?>">
                <div class="dsalv_tr">
                    <div class="dsalv_th">
                        <select class="dsalv-source" name="dsalv_link[<?php echo esc_attr( $index ); ?>][source]">
                            <option value="products" <?php echo( $link_source === 'products' ? 'selected' : '' ); ?>><?php esc_html_e( 'Products', 'linked-variation' ); ?></option>
                            <option value="categories" <?php echo( $link_source === 'categories' ? 'selected' : '' ); ?>><?php esc_html_e( 'Categories', 'linked-variation' ); ?></option>
                            <option value="tags" <?php echo( $link_source === 'tags' ? 'selected' : '' ); ?>><?php esc_html_e( 'Tags', 'linked-variation' ); ?></option>
                        </select>
                    </div>
                    <div class="dsalv_td dsalv_link_td">
                        <div class="dsalv-source-hide dsalv-source-products">
                            <input class="dsalv-products"
                                name="dsalv_link[<?php echo esc_attr( $index ); ?>][products]" type="hidden"
                                value="<?php echo esc_attr($link_prod); ?>"/>
                            <select class="wc-product-search dsalv-product-search" multiple="multiple"
                                    data-placeholder="<?php esc_attr_e( 'Search for a product&hellip;', 'linked-variation' ); ?>"
                                    data-action="woocommerce_json_search_products">
                                <?php
                                $_product_ids = explode( ',', $link_prod );

                                foreach ( $_product_ids as $_product_id ) {
                                    $_product = wc_get_product( $_product_id );

                                    if ( $_product ) {
                                        echo '<option value="' . esc_attr( $_product_id ) . '" selected="selected">' . wp_kses_post( $_product->get_formatted_name() ) . '</option>';
                                    }
                                }
                                ?>
                            </select>
                            <?php echo '<script>jQuery(document.body).trigger( \'wc-enhanced-select-init\' );</script>'; ?>
                        </div>
                        <div class="dsalv-source-hide dsalv-source-categories" style="display:none;">
                            <input class="dsalv-categories"
                                name="dsalv_link[<?php echo esc_attr( $index ); ?>][categories]" type="hidden"
                                value="<?php echo esc_attr( $link_categories ); ?>"/>
                            <select class="wc-category-search dsalv-category-search" multiple="multiple"
                                    data-placeholder="<?php esc_attr_e( 'Search for a category&hellip;', 'linked-variation' ); ?>">
                                <?php
                                $category_slugs = explode( ',', $link_categories );

                                if ( count( $category_slugs ) > 0 ) {
                                    foreach ( $category_slugs as $category_slug ) {
                                        $category = get_term_by( 'slug', $category_slug, 'product_cat' );

                                        if ( $category ) {
                                            echo '<option value="' . esc_attr( $category_slug ) . '" selected="selected">' . wp_kses_post( $category->name ) . '</option>';
                                        }
                                    }
                                }
                                ?>
                            </select>
                            <?php echo '<script>jQuery(document.body).trigger( \'wc-enhanced-select-init\' );</script>'; ?>
                        </div>
                        <div class="dsalv-source-hide dsalv-source-tags" style="display:none;">
                            <input class="dsalv-tags" name="dsalv_link[<?php echo esc_attr( $index ); ?>][tags]"
                                type="hidden" style="width: 100%"
                                value="<?php echo esc_attr( $link_tags ); ?>"/>
                            <select class="wc-tag-search dsalv-tag-search" multiple="multiple"
                                    data-placeholder="<?php esc_attr_e( 'Search for a tags&hellip;', 'linked-variation' ); ?>">
                                <?php
                                    $link_tags = explode( ',', $link_tags );
                                    $dsalv_source_tags = get_terms( array( 
                                        'hide_empty' => false,
                                        'taxonomy'   => 'product_tag',
                                        )
                                    );
                                    if ( ! empty( $dsalv_source_tags ) && ! is_wp_error( $dsalv_source_tags ) ) {
                                        foreach ( $dsalv_source_tags as $dsalv_cart_tag ) {
                                            ?>
                                            <option value="<?php echo esc_attr( $dsalv_cart_tag->slug ); ?>" <?php selected( true, in_array( $dsalv_cart_tag->slug, $link_tags, true ), true ); ?> >
                                                <?php echo esc_html_e( $dsalv_cart_tag->name, 'linked-variation' ); ?>
                                            </option>
                                            <?php
                                        }
                                    }
                                ?>
                                
                            </select>
                            <?php echo '<script>jQuery(document.body).trigger( \'wc-enhanced-select-init\' );</script>'; ?>
                        </div>
                    </div>
                </div>
                <div class="dsalv_tr">
                    <div class="dsalv_th"><?php esc_html_e( 'Linked by (attributes)', 'linked-variation' ); ?></div>
                    <div class="dsalv_td dsalv_link_td">
                        <div id="dsalv_toggle">
                            <span class="expand"><?php esc_html_e( 'Expand+', 'linked-variation' ); ?></span>
                            <span class="collapse" style="display:none;"><?php esc_html_e( 'Collapse-', 'linked-variation' ); ?></span>
                        </div>
                        <div id="dsalv_swtich" style="display:none;">
                            <?php
                            $saved_attributes = $merge_attributes = array();

                            foreach ( $link['attributes'] as $attr ) {
                                $saved_attributes[ $attr ] = $attributes[ $attr ];
                            }

                            $merge_attributes = array_merge( $saved_attributes, $attributes );

                            if ( $merge_attributes ) {
                                echo '<div class="dsalv-attributes">';

                                foreach ( $merge_attributes as $attribute_id => $attribute_label ) {
                                    echo '<div class="dsalv-attribute"><span class="move">' . esc_html__( 'Move', 'linked-variation' ) . '</span><span class="checkbox"><label><input type="checkbox" name="dsalv_link['. esc_attr( $index ) .'][attributes][]" value="' . esc_attr($attribute_id) . '" ' . ( is_array( $link['attributes'] ) && in_array( $attribute_id, $link['attributes'], true ) ? 'checked' : '' ) . '/>' . esc_html($attribute_label) . '</label></span><span class="display"><label><input type="checkbox" class="dsalv_display_checkbox" name="dsalv_link['.esc_attr( $index ).'][images][]" value="' . esc_attr($attribute_id) . '" ' . ( is_array( $link['images'] ) && in_array( $attribute_id, $link['images'], true ) ? 'checked' : '' ) . '/>' . esc_html__( 'Show images', 'linked-variation' ) . '</label></span></div>';
                                }

                                echo '</div>';
                            }
                            ?>
                        </div>
                    </div>
                </div>
                <span id="dsalv_delete"><?php esc_html_e( 'Delete', 'linked-variation' ); ?></span>
            </div>
            <?php
            exit();
        }
    }
}