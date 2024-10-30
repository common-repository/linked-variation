(function ($) {
	'use strict';
	// add currunt menu class in main manu
    jQuery(window).load(function () {
        jQuery('a[href="admin.php?page=alv-settings"]').parents().addClass('current wp-has-current-submenu');
        jQuery('a[href="admin.php?page=alv-settings"]').addClass('current');
    });
    
	$(document).ready(function() {

		// script for the toggle sidebar
		var span_full = $('.toggleSidebar .dashicons');
        var show_sidebar = localStorage.getItem('alv-sidebar-display');
        if( ( null !== show_sidebar || undefined !== show_sidebar ) && ( 'hide' === show_sidebar ) ) {
            $('.all-pad').addClass('hide-sidebar');
            span_full.removeClass('dashicons-arrow-right-alt2').addClass('dashicons-arrow-left-alt2');
        } else {
            $('.all-pad').removeClass('hide-sidebar');
            span_full.removeClass('dashicons-arrow-left-alt2').addClass('dashicons-arrow-right-alt2');
        }
        $(document).on( 'click', '.toggleSidebar', function(){
            $('.all-pad').toggleClass('hide-sidebar');
            if( $('.all-pad').hasClass('hide-sidebar') ){
                localStorage.setItem('alv-sidebar-display', 'hide');
                span_full.removeClass('dashicons-arrow-right-alt2').addClass('dashicons-arrow-left-alt2');
                $('.all-pad .alv-section-right').css({'-webkit-transition': '.3s ease-in width', '-o-transition': '.3s ease-in width',  'transition': '.3s ease-in width'});
                $('.all-pad .alv-section-left').css({'-webkit-transition': '.3s ease-in width', '-o-transition': '.3s ease-in width',  'transition': '.3s ease-in width'});
                setTimeout(function() {
                    $('#dotsstoremain .dotstore_plugin_sidebar').css('display', 'none');
                }, 300);
            } else {
                localStorage.setItem('alv-sidebar-display', 'show');
                span_full.removeClass('dashicons-arrow-left-alt2').addClass('dashicons-arrow-right-alt2');
                $('.all-pad .alv-section-right').css({'-webkit-transition': '.3s ease-out width', '-o-transition': '.3s ease-out width',  'transition': '.3s ease-out width'});
                $('.all-pad .alv-section-left').css({'-webkit-transition': '.3s ease-out width', '-o-transition': '.3s ease-out width',  'transition': '.3s ease-out width'});
                $('#dotsstoremain .dotstore_plugin_sidebar').css('display', 'block');
            }
        });
	
		// js for plugin help tip
		$( 'span.alv_tooltip_icon' ).click( function( event ) {
			event.preventDefault();
			$( this ).next( '.alv-woocommerce-help-tip' ).toggle();
		} );

		// script for plugin rating
		$(document).on('click', '.dotstore-sidebar-section .content_box .et-star-rating label', function(e){
			e.stopImmediatePropagation();
			var rurl = $('#et-review-url').val();
			window.open( rurl, '_blank' );
		});

		// script for save the setting data
		$(document).on('click', '#save_top_dsalv_setting', function () {
			saveLinkedVariationSettings();
			$('html, body').animate({scrollTop: 0}, 2000);
			return false;
		});

		$(document).on('click', '#save_dsalv_setting', function () {
			saveLinkedVariationSettings();
			$('html, body').animate({scrollTop: 0}, 2000);
			return false;
		});

	});

    function saveLinkedVariationSettings() {
    	var alv_settings_positions               = $('#alv_settings_positions').val();
		var alv_settings_tooltip_pos             = $('#alv_settings_tooltip_pos').val();
		var alv_settings_hide_emt_terms          = $('#alv_settings_hide_emt_terms').val();
		var alv_settings_exl_hidden_product      = $('#alv_settings_exl_hidden_product').val();
		var alv_settings_exl_unpurcha_product    = $('#alv_settings_exl_unpurcha_product').val();
		var alv_settings_link_individual_product = $('#alv_settings_link_individual_product').val();
		var alv_settings_use_unfollow_links      = $('#alv_settings_use_unfollow_links').val();

		$('.fps-setting-loader').css('display', 'inline-block');

		$.ajax({
			type: 'GET',
			url: coditional_vars.ajaxurl,
			data: {
				'action': 'dsalv_save_settings',
				'alv_settings_positions':alv_settings_positions,
				'alv_settings_tooltip_pos':alv_settings_tooltip_pos,
				'alv_settings_hide_emt_terms':alv_settings_hide_emt_terms,
				'alv_settings_exl_hidden_product':alv_settings_exl_hidden_product,
				'alv_settings_exl_unpurcha_product':alv_settings_exl_unpurcha_product,
				'alv_settings_link_individual_product':alv_settings_link_individual_product,
				'alv_settings_use_unfollow_links':alv_settings_use_unfollow_links
			},
			success: function() {
				$('.fps-setting-loader').css('display', 'none');
                $('#succesful_message_alv').css('display', 'block');
				setTimeout(function () {
					$('#succesful_message_alv').css('display', 'none');
				},7000);
			}
		});
    }
})(jQuery);