<?php
   // If this file is called directly, abort.
   if ( !defined( 'ABSPATH' ) ) {
       exit;
   }
   require_once plugin_dir_path( __FILE__ ) . 'header/plugin-header.php';
 	
	$alv_settings_positions               = get_option( 'alv_settings_positions' );
	$alv_settings_tooltip_pos             = get_option( 'alv_settings_tooltip_pos' );
	$alv_settings_hide_emt_terms          = get_option( 'alv_settings_hide_emt_terms' );
	$alv_settings_exl_hidden_product      = get_option( 'alv_settings_exl_hidden_product' );
	$alv_settings_exl_unpurcha_product    = get_option( 'alv_settings_exl_unpurcha_product' );
	$alv_settings_link_individual_product = get_option( 'alv_settings_link_individual_product' );
	$alv_settings_use_unfollow_links      = get_option( 'alv_settings_use_unfollow_links' );
   ?>
	<div class="alv-section-left">
		<div class="notice notice-success is-dismissible" id="succesful_message_alv">
			<p><?php esc_html_e( 'Settings saved succesfully', 'linked-variation' ); ?></p>
		</div>
		<div class="woocommerce-dsalv-setting-content">
			<div class="alv-setting-header alv-setting-wrap">
				<h2><?php esc_html_e( 'Basic Configuration', 'linked-variation' ); ?></h2>
				<div class="alv-save-button">
					<img class="alv-setting-loader" src="<?php echo  esc_url( plugin_dir_url( __FILE__ ) . 'images/ajax-loader.gif' ); ?>" alt="ajax-loader" />
					<input type="button" name="save_dsalv" id="save_top_dsalv_setting" class="button button-primary button-large" value="<?php esc_attr_e( 'Save Changes', 'linked-variation' ); ?>">
				</div>
			</div>
			<div class="alv-section-content">
				<table class="form-table">
					<tbody>
						<tr>
							<th scope="row">
								<label class="alv_leble_setting" for="alv_settings_positions"><?php esc_html_e( 'Position', 'linked-variation' ); ?>
								</label>
							</th>
							<td>
								<select id="alv_settings_positions" name="alv_settings_positions">
									<option value="above_the_add_to_cart_button" <?php echo  ( $alv_settings_positions === 'above_the_add_to_cart_button' ? 'selected' : '' ) ;?>><?php esc_html_e( 'Above the add to cart button', 'linked-variation' ); ?></option>
									<option value="under_the_add_to_cart_button" <?php echo  ( $alv_settings_positions === 'under_the_add_to_cart_button' ? 'selected' : '' ) ;?>><?php esc_html_e( 'Under the add to cart button', 'linked-variation' ); ?></option>
									<option value="under_the_title" <?php echo  ( $alv_settings_positions === 'under_the_title' ? 'selected' : '' ) ;?>><?php esc_html_e( 'Under the title', 'linked-variation' ); ?></option>
									<option value="under_the_price" <?php echo  ( $alv_settings_positions === 'under_the_price' ? 'selected' : '' ) ;?>><?php esc_html_e( 'Under the price', 'linked-variation' ); ?></option>
									<option value="under_the_excerpt" <?php echo  ( $alv_settings_positions === 'under_the_excerpt' ? 'selected' : '' ) ;?>><?php esc_html_e( 'Under the excerpt', 'linked-variation' ); ?></option>
									<option value="no_hide_it" <?php echo  ( $alv_settings_positions === 'no_hide_it' ? 'selected' : '' ) ;?>><?php esc_html_e( 'No (hide it)', 'linked-variation' ); ?></option>
								</select>
								<span class="alv_tooltip_icon"></span>
								<div class="alv-woocommerce-help-tip">
									<p class="alv_tooltip_desc description">
									<?php esc_html_e( 'Choose the position to show the linked variations.', 'linked-variation' ); ?>
									</p>
								</div>
							</td>
						</tr>

						<tr>
							<th scope="row">
								<label class="alv_settings_shortcode" for="alv_settings_shortcode"><?php esc_html_e( 'Shortcode', 'linked-variation' ); ?>
								</label>
							</th>
							<td>
								<span class="alv_copytext"><?php esc_html_e( '[dsalv]', 'linked-variation' ); ?></span>
								<span class="alv_tooltip_icon"></span>
								<div class="alv-woocommerce-help-tip">
									<p class="alv_tooltip_desc description">
									<?php esc_html_e( 'Use this shortcode to show list. ', 'linked-variation' ); ?>
									</p>
								</div>
							</td>
						</tr>

						<tr>
							<th scope="row">
								<label class="alv_settings_tooltip_pos" for="alv_settings_tooltip_pos"><?php esc_html_e( 'Tooltip position', 'linked-variation' ); ?>
								</label>
							</th>
							<td>
								<select id="alv_settings_tooltip_pos" name="alv_settings_tooltip_pos">
									<option value="top" <?php echo  ( $alv_settings_tooltip_pos === 'top' ? 'selected' : '' ) ;?>><?php esc_html_e( 'Top', 'linked-variation' ); ?></option>
									<option value="right" <?php echo  ( $alv_settings_tooltip_pos === 'right' ? 'selected' : '' ) ;?>><?php esc_html_e( 'Right', 'linked-variation' ); ?></option>
									<option value="bottom" <?php echo  ( $alv_settings_tooltip_pos === 'bottom' ? 'selected' : '' ) ;?>><?php esc_html_e( 'Bottom', 'linked-variation' ); ?></option>
									<option value="left" <?php echo  ( $alv_settings_tooltip_pos === 'left' ? 'selected' : '' ) ;?>><?php esc_html_e( 'Left', 'linked-variation' ); ?></option>
									<option value="no_hide_it" <?php echo  ( $alv_settings_tooltip_pos === 'no_hide_it' ? 'selected' : '' ) ;?>><?php esc_html_e( 'No (hide it)', 'linked-variation' ); ?></option>
								</select>
								<span class="alv_tooltip_icon"></span>
								<div class="alv-woocommerce-help-tip">
									<p class="alv_tooltip_desc description">
									<?php esc_html_e( 'Use this option to change the tooltip position', 'linked-variation' ); ?>
									</p>
								</div>
							</td>
						</tr>

						<tr>
							<th scope="row">
								<label class="alv_settings_hide_emt_terms" for="alv_settings_hide_emt_terms"><?php esc_html_e( 'Hide empty terms', 'linked-variation' ); ?>
								</label>
							</th>
							<td>
								<select id="alv_settings_hide_emt_terms" name="alv_settings_hide_emt_terms">
									<option value="yes" <?php echo  ( $alv_settings_hide_emt_terms === 'yes' ? 'selected' : '' ) ;?>><?php esc_html_e( 'Yes', 'linked-variation' ); ?></option>
									<option value="no" <?php echo  ( $alv_settings_hide_emt_terms === 'no' ? 'selected' : '' ) ;?>><?php esc_html_e( 'No', 'linked-variation' ); ?></option>
								</select>
								<span class="alv_tooltip_icon"></span>
								<div class="alv-woocommerce-help-tip">
									<p class="alv_tooltip_desc description">
									<?php esc_html_e( 'Use this option to hide the empty terms from results.', 'linked-variation' ); ?>
									</p>
								</div>
							</td>
						</tr>

						<tr>
							<th scope="row">
								<label class="alv_settings_exl_hidden_product" for="alv_settings_exl_hidden_product"><?php esc_html_e( 'Exclude hidden products', 'linked-variation' ); ?>
								</label>
							</th>
							<td>
								<select id="alv_settings_exl_hidden_product" name="alv_settings_exl_hidden_product">
									<option value="yes" <?php echo  ( $alv_settings_exl_hidden_product === 'yes' ? 'selected' : '' ) ;?>><?php esc_html_e( 'Yes', 'linked-variation' ); ?></option>
									<option value="no" <?php echo  ( $alv_settings_exl_hidden_product === 'no' ? 'selected' : '' ) ;?>><?php esc_html_e( 'No', 'linked-variation' ); ?></option>
								</select>
								<span class="alv_tooltip_icon"></span>
								<div class="alv-woocommerce-help-tip">
									<p class="alv_tooltip_desc description">
									<?php esc_html_e( 'Use this option to exclude hidden products from results.', 'linked-variation' ); ?>
									</p>
								</div>
							</td>
						</tr>

						<tr>
							<th scope="row">
								<label class="alv_settings_exl_unpurcha_product" for="alv_settings_exl_unpurcha_product"><?php esc_html_e( 'Exclude unpurchasable products', 'linked-variation' ); ?>
								</label>
							</th>
							<td>
								<select id="alv_settings_exl_unpurcha_product" name="alv_settings_exl_unpurcha_product">
									<option value="yes" <?php echo  ( $alv_settings_exl_unpurcha_product === 'yes' ? 'selected' : '' ) ;?>><?php esc_html_e( 'Yes', 'linked-variation' ); ?></option>
									<option value="no" <?php echo  ( $alv_settings_exl_unpurcha_product === 'no' ? 'selected' : '' ) ;?>><?php esc_html_e( 'No', 'linked-variation' ); ?></option>
								</select>
								<span class="alv_tooltip_icon"></span>
								<div class="alv-woocommerce-help-tip">
									<p class="alv_tooltip_desc description">
									<?php esc_html_e( 'Use this option to exclude unpurchasable products from results.', 'linked-variation' ); ?>
									</p>
								</div>
							</td>
						</tr>

						<tr>
							<th scope="row">
								<label class="alv_settings_link_individual_product" for="alv_settings_link_individual_product"><?php esc_html_e( 'Link to individual products', 'linked-variation' ); ?>
								</label>
							</th>
							<td>
								<select id="alv_settings_link_individual_product" name="alv_settings_link_individual_product">
									<option value="open_in_the_same_tab" <?php echo  ( $alv_settings_link_individual_product === 'open_in_the_same_tab' ? 'selected' : '' ) ;?>><?php esc_html_e( 'Open in the same tab', 'linked-variation' ); ?></option>
									<option value="open_in_the_new_tab" <?php echo  ( $alv_settings_link_individual_product === 'open_in_the_new_tab' ? 'selected' : '' ) ;?>><?php esc_html_e( 'Open in the new tab', 'linked-variation' ); ?></option>
								</select>
								<span class="alv_tooltip_icon"></span>
								<div class="alv-woocommerce-help-tip">
									<p class="alv_tooltip_desc description">
									<?php esc_html_e( 'Use this option to exclude unpurchasable products from results.', 'linked-variation' ); ?>
									</p>
								</div>
							</td>
						</tr>

						<tr>
							<th scope="row">
								<label class="alv_settings_use_unfollow_links" for="alv_settings_use_unfollow_links"><?php esc_html_e( 'Use unfollow links', 'linked-variation' ); ?>
								</label>
							</th>
							<td>
								<select id="alv_settings_use_unfollow_links" name="alv_settings_use_unfollow_links">
									<option value="yes" <?php echo  ( $alv_settings_use_unfollow_links === 'yes' ? 'selected' : '' ) ;?>><?php esc_html_e( 'Yes', 'linked-variation' ); ?></option>
									<option value="no" <?php echo  ( $alv_settings_use_unfollow_links === 'no' ? 'selected' : '' ) ;?>><?php esc_html_e( 'No', 'linked-variation' ); ?></option>
								</select>
								<span class="alv_tooltip_icon"></span>
								<div class="alv-woocommerce-help-tip">
									<p class="alv_tooltip_desc description">
									<?php esc_html_e( 'Use this option to set product as rel="nofollow" HTML tag.', 'linked-variation' ); ?>
									</p>
								</div>
							</td>
						</tr>

					</tbody>
				</table>
			</div>
			<div class="alv-save-button bottom-save-button">
				<img class="alv-setting-loader" src="<?php echo esc_url( plugin_dir_url( __FILE__ ) . 'images/ajax-loader.gif' ); ?>" alt="ajax-loader" />
				<input type="button" name="save_dsalv" id="save_dsalv_setting" class="button button-primary button-large" value="<?php esc_attr_e( 'Save Changes', 'linked-variation' ); ?>">
			</div>
		</div>
	</div>
<?php 
require_once plugin_dir_path( __FILE__ ) . 'header/plugin-sidebar.php';