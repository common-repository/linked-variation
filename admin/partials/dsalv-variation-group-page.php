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
    </div>
</div>
<?php 
require_once plugin_dir_path( __FILE__ ) . 'header/plugin-sidebar.php';