(function ($) {
	'use strict';

    $(function() {
        dsalv_init();
    });

    $(document).ready(function() {
        //$('.dsalv-product-search').select2();
        
        $('.dsalv-tag-search').selectWoo();
        $(document).on('change', '.dsalv-source', function() {
            var source = $(this).find(':selected').val();
        
            $(this).closest('.dsalv_link').find('.dsalv-source-hide').hide();
            $(this).closest('.dsalv_link').find('.dsalv-source-' + source).show();
            $('.dsalv-tag-search').selectWoo();
        });
        $(document).on('click', '#dsalv_delete', function() {
          if (confirm('Are you sure what to delete?')) {
              $(this).parents('.dsalv_link').remove();
          } 
        });
        $(document).on('click', '#dsalv_toggle', function() {
          $(this).next('#dsalv_swtich').toggle();
          if( $(this).find('span:visible').attr('class') === 'expand' ){
            $(this).find('.collapse').show();
            $(this).find('.expand').hide();
          }else{
            $(this).find('.expand').show();
            $(this).find('.collapse').hide();
          }
        });
        $(document).on('click', '#dsalv_add_lv', function () {
          var index = $('#dsalv_configuration .form-table tr td .dsalv_links .dsalv_link:last-child').attr('data-index');
          var newIndex = parseInt(index) + 1;
          $.ajax({
            type: 'POST',
            url: coditional_vars.ajaxurl,
            data: {
              'action': 'dsalv_add_new_variation',
              'index': newIndex
            },
            success: function(response) {
              if ( '' !== response ) {
                $('#dsalv_configuration .form-table tr td .dsalv_links').last().append( response );
                dsalv_init();
              }
            },
          });
        });
    });

    // search product and save into hidden field
    $(document).on('change', '.dsalv-product-search', function() {
        var _val = $(this).val();
    
        if (Array.isArray(_val)) {
          $(this).
              closest('.dsalv_link').
              find('.dsalv-products').
              val(_val.join()).trigger('change');
        } else {
          if (_val === null) {
            $(this).
                closest('.dsalv_link').
                find('.dsalv-products').
                val('').trigger('change');
          } else {
            $(this).
                closest('.dsalv_link').
                find('.dsalv-products').
                val(String(_val)).trigger('change');
          }
        }
      });

      // search category and save into hidden field
    $(document).on('change', '.dsalv-category-search', function() {
        var _val = $(this).val();

        if (Array.isArray(_val)) {
        $(this).
            closest('.dsalv_link').
            find('.dsalv-categories').
            val(_val.join()).trigger('change');
        } else {
        if (_val === null) {
            $(this).
                closest('.dsalv_link').
                find('.dsalv-categories').
                val('').trigger('change');
        } else {
            $(this).
                closest('.dsalv_link').
                find('.dsalv-categories').
                val(String(_val)).trigger('change');
        }
        }
    });

      // search tag and save into hidden field
      $(document).on('change', '.dsalv-tag-search', function() {
        var _val = $(this).val();

        if (Array.isArray(_val)) {
        $(this).
            closest('.dsalv_link').
            find('.dsalv-tags').
            val(_val.join()).trigger('change');
        } else {
        if (_val === null) {
            $(this).
                closest('.dsalv_link').
                find('.dsalv-tags').
                val('').trigger('change');
        } else {
            $(this).
                closest('.dsalv_link').
                find('.dsalv-tags').
                val(String(_val)).trigger('change');
        }
        }
    });

      function dsalv_init() {
        $('.dsalv-attributes').sortable({
          items: '.dsalv-attribute',
          cursor: 'move',
          scrollSensitivity: 40,
          forcePlaceholderSize: true,
          forceHelperSize: false,
          helper: 'clone',
          opacity: 0.65,
        });
        
        $('.dsalv-source-hide').hide();
    
        $('.dsalv-source').each(function() {
          var source = $(this).find(':selected').val();
    
          $(this).closest('.dsalv_link').find('.dsalv-source-' + source).show();
        });
      }
})(jQuery);