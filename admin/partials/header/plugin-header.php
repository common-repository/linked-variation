<?php

// If this file is called directly, abort.
if ( !defined( 'ABSPATH' ) ) {
    exit;
}
$plugin_name = DSALV_PLUGIN_NAME;
$version_label = __( 'Free Version', 'linked-variation' );
?>
<div id="dotsstoremain">
    <div class="all-pad">
        <header class="dots-header">
            <div class="dots-plugin-details">
                <div class="dots-header-left">
                    <div class="dots-logo-main">
                        <div class="logo-image">
                            <img src="<?php echo  esc_url( DSALV_PLUGIN_URL . 'admin/images/plugin-header-image.png' ) ; ?>">
                        </div>
                        <div class="plugin-version">
                            <span><?php esc_html_e( $version_label, 'linked-variation' ); ?> <?php echo  esc_html( DSALV_PLUGIN_VERSION ); ?></span>
                        </div>
                    </div>
                    <div class="plugin-name">
                        <div class="title"><?php esc_html_e( $plugin_name, 'linked-variation' ); ?></div>
                        <div class="desc"><?php esc_html_e( 'Advanced Linked Variation allows users to show various products or product variants as variations of a WooCommerce product, without adding it as that product’s variant in reality.', 'linked-variation' ); ?></div>
                    </div>
                </div>
                <div class="dots-header-right">
                    <div class="button-group">
                        <div class="button-dots">
                            <span class="support_dotstore_image">
                                <a target="_blank" href="<?php echo  esc_url( 'http://www.thedotstore.com/support/' ) ; ?>">
                                    <span class="dashicons dashicons-sos"></span>
                                    <strong><?php esc_html_e( 'Quick Support', 'linked-variation' ); ?></strong>
                                </a>
                            </span>
                        </div>

                        <div class="button-dots">
                            <span class="support_dotstore_image">
                                <a target="_blank" href="<?php echo  esc_url( 'https://docs.thedotstore.com/collection/492-woocommerce-linked-variations' ) ; ?>">
                                    <span class="dashicons dashicons-media-text"></span>
                                    <strong><?php esc_html_e( 'Documentation', 'linked-variation' ); ?></strong>
                                </a>
                            </span>
                        </div>
                    </div>
                </div>
            </div>
            <?php 
            $current_page = filter_input( INPUT_GET, 'page', FILTER_SANITIZE_FULL_SPECIAL_CHARS );
            $pl_post_type = filter_input( INPUT_GET, 'post_type', FILTER_SANITIZE_FULL_SPECIAL_CHARS );
            if( empty( $pl_post_type ) ){
                $pl_post_type = get_post_type( get_the_ID() );
            }
            $alv_settings_page = ( isset( $current_page ) && 'alv-settings' === $current_page ? 'active' : '' );
            $alv_getting_started = ( isset( $current_page ) && 'alv-get-started' === $current_page ? 'active' : '' );
            $alv_information = ( isset( $current_page ) && 'alv-information' === $current_page ? 'active' : '' );
            $linked_var_group = ( isset( $pl_post_type ) && 'dsalv' === $pl_post_type ? 'active' : '' );

            if ( isset( $current_page ) && 'alv-information' === $current_page || isset( $current_page ) && 'alv-get-started' === $current_page ) {
                $alv_about = 'active';
            } else {
                $alv_about = '';
            }
            ?>
            <div class="dots-menu-main">
                <nav>
                    <ul>
                        <li>
                            <a class="dotstore_plugin <?php 
                                echo  esc_attr( $alv_settings_page ) ;
                                ?>" href="<?php 
                                echo  esc_url( add_query_arg( array(
                                    'page' => 'alv-settings',
                                ), admin_url( 'admin.php' ) ) ) ;
                                ?>"><?php 
                                esc_html_e( 'Linked Variations Settings', 'linked-variation' );
                                ?>
                            </a>
                        </li>
                        <li>
                            <a class="dotstore_plugin <?php 
                                echo  esc_attr( $linked_var_group ) ;
                                ?>" href="edit.php?post_type=dsalv"><?php 
                                esc_html_e( 'Linked Variations Group', 'linked-variation' );
                                ?>
                            </a>
                        </li>
                        <li>
                            <a class="dotstore_plugin <?php 
                                echo  esc_attr( $alv_about ) ;
                                ?>" href="<?php 
                                echo  esc_url( add_query_arg( array(
                                    'page' => 'alv-get-started',
                                ), admin_url( 'admin.php' ) ) ) ;
                                ?>"><?php 
                                esc_html_e( 'About Plugin', 'linked-variation' );
                                ?></a>
                            <ul class="sub-menu">
                                <li><a class="dotstore_plugin <?php 
                                        echo  esc_attr( $alv_getting_started ) ;
                                        ?>" href="<?php 
                                        echo  esc_url( add_query_arg( array(
                                            'page' => 'alv-get-started',
                                        ), admin_url( 'admin.php' ) ) ) ;
                                        ?>"><?php 
                                        esc_html_e( 'Getting Started', 'linked-variation' );
                                        ?></a></li>
                                <li><a class="dotstore_plugin <?php 
                                        echo  esc_attr( $alv_information ) ;
                                        ?>" href="<?php 
                                        echo  esc_url( add_query_arg( array(
                                            'page' => 'alv-information',
                                        ), admin_url( 'admin.php' ) ) ) ;
                                        ?>"><?php 
                                        esc_html_e( 'Quick info', 'linked-variation' );
                                        ?></a></li>
                            </ul>
                        </li>
                        <li>
                            <a class="dotstore_plugin"><?php esc_html_e( 'Dotstore', 'linked-variation' ); ?></a>
                            <ul class="sub-menu">
                                <li><a target="_blank" href="<?php echo  esc_url( 'www.thedotstore.com/woocommerce-plugins' ) ; ?>"><?php esc_html_e( 'WooCommerce Plugins', 'linked-variation' );?></a></li>
                                <li><a target="_blank" href="<?php echo  esc_url( 'www.thedotstore.com/wordpress-plugins' ) ;?>"><?php esc_html_e( 'Wordpress Plugins', 'linked-variation' ); ?></a></li><br>
                                <li><a target="_blank" href="<?php echo  esc_url( 'www.thedotstore.com/support' ); ?>"><?php esc_html_e( 'Contact Support', 'linked-variation' ); ?></a></li>
                            </ul>
                        </li>
                    </ul>
                </nav>
            </div>
        </header>
        <div class="dots-settings-inner-main">
        