<?php
// If this file is called directly, abort.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

require_once( plugin_dir_path( __FILE__ ) . 'header/plugin-header.php' );
?>
	<div class="thedotstore-main-table res-cl alv-section-left">
		<h2><?php esc_html_e( 'Thanks For Installing Advanced Linked Variations', 'linked-variation' ); ?></h2>
		<table class="table-outer">
			<tbody>
			<tr>
				<td class="fr-2">
					<p class="block gettingstarted"><strong><?php esc_html_e( 'Getting Started', 'linked-variation' ); ?> </strong></p>
					<p class="block textgetting">
						<?php esc_html_e( 'Allow customers to create diffrent variation of products', 'linked-variation' ); ?>
                    </p>
                    <p class="block textgetting">
						<?php esc_html_e( 'To set the default options click on first tab - Linked Variations Settings', 'linked-variation' ); ?>
						<span class="gettingstarted">
							<img src="<?php echo esc_url( DSALV_PLUGIN_URL . 'admin/images/thedotstore-images/Getting_Started_01.png' ); ?>">
						</span>
                    </p>

                    <p class="block textgetting">
						<?php esc_html_e( 'Linked Variations Group tab is listing of all variations with add new version option.', 'linked-variation' ); ?>
						<span class="gettingstarted">
							<img src="<?php echo esc_url( DSALV_PLUGIN_URL . 'admin/images/thedotstore-images/Getting_Started_02.png' ); ?>">
						</span>
                    </p>
                    
				</td>
			</tr>
			</tbody>
		</table>
	</div>

<?php
require_once( plugin_dir_path( __FILE__ ) . 'header/plugin-sidebar.php' );