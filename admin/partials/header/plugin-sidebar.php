<?php

// Exit if accessed directly
if ( !defined( 'ABSPATH' ) ) {
    exit;
}
?>
<div class="alv-section-right">
    <div class="dots-seperator">
        <button class="toggleSidebar" title="toogle sidebar">
            <span class="dashicons dashicons-arrow-right-alt2"></span>
        </button>
    </div>
    <div class="dotstore_plugin_sidebar">
        <?php 
            $review_url = esc_url( 'https://wordpress.org/support/plugin/linked-variation/reviews/' );
            $changelog_url = esc_url( 'https://wordpress.org/plugins/linked-variation/#developers' );
        ?>
        <div class="dotstore-sidebar-section">
            <div class="content_box">
                <h3><?php esc_html_e( 'Like This Plugin?', 'linked-variation' );?></h3>
                <div class="et-star-rating">
                    <input type="radio" id="5-stars" name="rating" value="5" />
                    <label for="5-stars" class="star"></label>
                    <input type="radio" id="4-stars" name="rating" value="4" />
                    <label for="4-stars" class="star"></label>
                    <input type="radio" id="3-stars" name="rating" value="3" />
                    <label for="3-stars" class="star"></label>
                    <input type="radio" id="2-stars" name="rating" value="2" />
                    <label for="2-stars" class="star"></label>
                    <input type="radio" id="1-star" name="rating" value="1" />
                    <label for="1-star" class="star"></label>
                    <input type="hidden" id="et-review-url" value="<?php echo  esc_url( $review_url ) ;?>">
                </div>
                <p><?php esc_html_e( 'Your Review is very important to us as it helps us to grow more.', 'linked-variation' );?></p>
            </div>
        </div>

        <div class="dotstore-sidebar-section">
            <div class="dotstore-important-link-heading">
                <span class="dashicons dashicons-star-filled"></span>
                <span class="heading-text"><?php esc_html_e( 'Suggest A Feature', 'linked-variation' ); ?></span>
            </div>
            <div class="dotstore-important-link-content">
                <p><?php esc_html_e( 'Let us know how we can improve the plugin experience.', 'linked-variation' ); ?></p>
                <p><?php esc_html_e( 'Do you have any feedback &amp; feature requests?', 'linked-variation' ); ?></p>
                <a target="_blank" href="<?php echo  esc_url( 'https://www.thedotstore.com/feature-requests/' ) ; ?>"><?php esc_html_e( 'Submit Request »', 'linked-variation' ); ?></a>
            </div>
        </div>

        <div class="dotstore-sidebar-section">
            <div class="dotstore-important-link-heading">
                <span class="dashicons dashicons-editor-kitchensink"></span>
                <span class="heading-text"><?php esc_html_e( 'Changelog', 'linked-variation' );?></span>
            </div>
            <div class="dotstore-important-link-content">
                <p><?php esc_html_e( 'We improvise our products on a regular basis to deliver the best results to customer satisfaction.', 'linked-variation' );?></p>
                <a target="_blank" href="<?php echo  esc_url( $changelog_url ) ;?>"><?php esc_html_e( 'Visit Here »', 'linked-variation' );?></a>
            </div>
        </div>

        <!-- html for popular plugin !-->
        <div class="dotstore-important-link dotstore-sidebar-section">
            <div class="dotstore-important-link-heading">
                <span class="dashicons dashicons-plugins-checked"></span>
                <span class="heading-text"><?php esc_html_e( 'Our Popular Plugins', 'linked-variation' );?></span>
            </div>
            <div class="video-detail important-link">
                <ul>
                    <li>
                        <img class="sidebar_plugin_icone" src="<?php echo  esc_url( DSALV_PLUGIN_URL ) . 'admin/images/thedotstore-images/popular-plugins/Advanced-Flat-Rate-Shipping-Method.png' ;?>">
                        <a target="_blank" href="<?php echo  esc_url( 'https://www.thedotstore.com/flat-rate-shipping-plugin-for-woocommerce/' ) ;?> "><?php esc_html_e( 'Flat Rate Shipping Plugin for WooCommerce', 'linked-variation' );?></a>
                    </li> 
                    <li>
                        <img class="sidebar_plugin_icone" src="<?php echo  esc_url( DSALV_PLUGIN_URL ) . 'admin/images/thedotstore-images/popular-plugins/Conditional-Product-Fees-For-WooCommerce-Checkout.png' ;?>">
                        <a  target="_blank" href="<?php echo  esc_url( 'https://www.thedotstore.com/product/woocommerce-extra-fees-plugin/' ) ;?>"><?php esc_html_e( 'Extra Fees Plugin for WooCommerce', 'linked-variation' );?></a>
                    </li>
                    <li>
                        <img class="sidebar_plugin_icone" src="<?php echo  esc_url( DSALV_PLUGIN_URL ) . 'admin/images/thedotstore-images/popular-plugins/Advanced-Product-Size-Charts-for-WooCommerce.png' ;?>">
                        <a  target="_blank" href="<?php echo  esc_url( 'https://www.thedotstore.com/woocommerce-advanced-product-size-charts/' ) ;?>"><?php esc_html_e( 'Product Size Charts Plugin For WooCommerce', 'linked-variation' );?></a>
                    </li>
                    <li>
                        <img  class="sidebar_plugin_icone" src="<?php echo  esc_url( DSALV_PLUGIN_URL ) . 'admin/images/thedotstore-images/popular-plugins/WooCommerce-Blocker-Prevent-Fake-Orders.png' ;?>">
                        <a target="_blank" href="<?php echo  esc_url( 'https://www.thedotstore.com/woocommerce-anti-fraud' ) ;?>"><?php esc_html_e( 'Fraud Prevention Plugin for WooCommerce', 'linked-variation' );?></a>
                    </li>
                    <li>
                        <img  class="sidebar_plugin_icone" src="<?php echo  esc_url( DSALV_PLUGIN_URL ) . 'admin/images/thedotstore-images/popular-plugins/hide-shipping-method-for-woocommerce.png' ;?>">
                        <a target="_blank" href="<?php echo  esc_url( 'https://www.thedotstore.com/hide-shipping-method-for-woocommerce' ) ;?>"><?php esc_html_e( 'Hide Shipping Method For WooCommerce', 'linked-variation' );?></a>
                    </li>
                    <li>
                        <img  class="sidebar_plugin_icone" src="<?php echo  esc_url( DSALV_PLUGIN_URL ) . 'admin/images/thedotstore-images/popular-plugins/Advanced-Product-Sample-for-WooCommerce.png' ;?>">
                        <a target="_blank" href="<?php echo  esc_url( 'https://www.thedotstore.com/product/product-sample-woocommerce/' ) ;?>"><?php esc_html_e( 'Product Sample for WooCommerce', 'linked-variation' );?></a>
                    </li>
                </ul>
            </div>
            <div class="view-button">
                <a class="button button-primary button-large" target="_blank" href="<?php echo  esc_url( 'https://www.thedotstore.com/plugins' ); ?>"><?php esc_html_e( 'VIEW ALL', 'linked-variation' );?></a>
            </div>
        </div>
        <!-- html end for popular plugin !-->
        <div class="dotstore-sidebar-section">
            <div class="dotstore-important-link-heading">
                <span class="dashicons dashicons-sos"></span>
                <span class="heading-text"><?php esc_html_e( 'Five Star Support', 'linked-variation' );?></span>
            </div>
            <div class="dotstore-important-link-content">
                <p><?php esc_html_e( 'Got a question? Get in touch with theDotstore developers. We are happy to help!', 'linked-variation' );?> </p>
                <a target="_blank" href="<?php echo  esc_url( 'https://www.thedotstore.com/support/' ) ;?>"><?php esc_html_e( 'Submit a Ticket »', 'linked-variation' );?></a>
            </div>
        </div>
    </div>
</div>
</div>
</div>
</div>