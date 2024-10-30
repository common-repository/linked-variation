(function ($) {
	'use strict';
    $('.woosq-link').click(function(){
        $(this).magnificPopup({
            items: [
            {
                src: '<div>HTML string</div>',
                type: 'inline'
              },
            ]
        });
    });
})(jQuery);