<?php

// If this file is called directly, abort.
if ( !defined( 'ABSPATH' ) ) {
    exit;
}
$plugin_name = DSALV_PLUGIN_NAME;
$plugin_version = DSALV_PLUGIN_VERSION;
$version_label = __( 'Free Version', 'linked-variation' );
require_once plugin_dir_path( __FILE__ ) . 'header/plugin-header.php';
?>

<div class="alv-section-left">
    <div class="alv-main-table res-cl">
        <h2><?php esc_html_e( 'Quick info', 'linked-variation' ); ?></h2>
        <table class="form-table">
            <tbody>
                <tr>
                    <td class="fr-1"><?php esc_html_e( 'Product Type', 'linked-variation' ); ?></td>
                    <td class="fr-2"><?php esc_html_e( 'WooCommerce Plugin', 'linked-variation' ); ?></td>
                </tr>
                <tr>
                    <td class="fr-1"><?php esc_html_e( 'Product Name', 'linked-variation' ); ?></td>
                    <td class="fr-2"><?php esc_html_e( $plugin_name, 'linked-variation' ); ?></td>
                </tr>
                <tr>
                    <td class="fr-1"><?php esc_html_e( 'Installed Version', 'linked-variation' ); ?></td>
                    <td class="fr-2"><?php esc_html_e( $version_label, 'linked-variation' ); ?> <?php esc_html_e( $plugin_version, 'linked-variation' ); ?></td>
                </tr>
                <tr>
                    <td class="fr-1"><?php esc_html_e( 'License & Terms of use', 'linked-variation' ); ?></td>
                    <td class="fr-2"><a target="_blank"  href="<?php echo  esc_url( 'www.thedotstore.com/terms-and-conditions' ) ; ?>"><?php esc_html_e( 'Click here', 'linked-variation' ); ?></a><?php esc_html_e( ' to view license and terms of use.', 'linked-variation' ); ?></td>
                </tr>
                <tr>
                    <td class="fr-1"><?php esc_html_e( 'Help & Support', 'linked-variation' ); ?></td>
                    <td class="fr-2">
                        <ul>
                            <li><a href="<?php echo  esc_url( add_query_arg( array(
                                                                                'page' => 'alv-get-started'
                                                                            ), admin_url( 'admin.php' ) ) ) ;
                            ?>"><?php esc_html_e( 'Quick Start', 'linked-variation' ); ?></a></li>
                            <li><a target="_blank" href="<?php echo  esc_url( 'https://docs.thedotstore.com/collection/492-woocommerce-linked-variations' ) ; ?>"><?php esc_html_e( 'Guide Documentation', 'linked-variation' ); ?></a></li>
                            <li><a target="_blank" href="<?php echo  esc_url( 'www.thedotstore.com/support' ) ; ?>"><?php esc_html_e( 'Support Forum', 'linked-variation' ); ?></a></li>
                        </ul>
                    </td>
                </tr>
                <tr>
                    <td class="fr-1"><?php esc_html_e( 'Localization', 'linked-variation' ); ?></td>
                    <td class="fr-2"><?php esc_html_e( 'German, French, Polish, Spanish', 'linked-variation' ); ?></td>
                </tr>

            </tbody>
        </table>
    </div>
</div>
<?php 
require_once plugin_dir_path( __FILE__ ) . 'header/plugin-sidebar.php';