(function( $ ) {
    'use strict';

    hcode_save_option_button();
    
    /* Hide Success Message After 15sec */
    if(jQuery("#run-regenerate-thumbnails").css('display') == 'block'){
        $('#run-regenerate-thumbnails').delay(15000).fadeOut('slow');
    }

    function hcode_save_option_button() {

        var $btns = $( 'input[name="redux_save"]' ),
            $form = $('.redux-container'),
            $savedMessage = $form.find('#redux-sticky');
        
        $btns.click(function (e) {
            $('.redux-save-warn').slideUp();
            var $btn = $(this);
            if ($btn.hasClass('loading')) {
                e.preventDefault();
                return;
            }

            var data = $form.find('input,textarea,select').serialize();
            $form.find('.redux-ajax-loading').show();

            $.ajax({
                url: hcode_ajax_button_save['adminajaxurl'],
                type: 'post',
                data: data,
                success: function (data) {
                    //TODO: Show proper saved message
                    OnSaveComplete();
                    //console.log('Ajax Done');
                },
                error: function (data) {
                    alert('Error occured in saving data');
                }
            });

            function OnSaveComplete() {
                $form.find('.redux-ajax-loading').hide();
                $('.saved_notice.notice-green').slideDown();
                $('.saved_notice.notice-green').delay( 4000 ).slideUp();
            }
            e.preventDefault();
        });
    }

    var stop_ajax_request = false;
    var ajax_call_count = 0;
    var import_completed = false;
    var ajax_import_error = false;

    // Ajax hcode log function to show messages
    var hcode_log = function(msg) {
        $('.import-ajax-message').append(msg);
        $('.import-ajax-message').animate({"scrollTop": $('.import-ajax-message')[0].scrollHeight}, "fast");
    }

    var refresh_ajax_call_to_import_log = function() {
        
        ajax_call_count++;
        
        if (stop_ajax_request) {
            return;
        }
        
        // Stop Ajax clall After 700Sec.
        if (ajax_call_count > 700) {
            hcode_log('Import doesn\'t respond.');
            return;
        }
        
        // Ajax For Refresh Log
        $.ajax({
            url: ajaxurl,
            data: {
                action : 'hcode_refresh_import_log'
            },
            success:function(data) {
                
                if (data.search("ERROR") != -1) {
                    ajax_import_error = true;
                }
                
                $('.import-ajax-message').html(data);
                $('.import-ajax-message').animate({"scrollTop": $('.import-ajax-message')[0].scrollHeight}, "fast");
                
                // Add Error Message In Log
                if (ajax_import_error) {
                    stop_ajax_request = true;
                    hcode_log('Import error!');
                    return;
                }
                
                // Add Completed Message In Log
                if (import_completed) {
                    stop_ajax_request = true;
                    hcode_log('<p>Import Done.</p>');
                    window.location.href = window.location.href + "&show-message=true";
                    return;
                }
            },
            error: function(errorThrown) {
                console.log(errorThrown);
            }
        }).done( function() { 
            
            setTimeout( refresh_ajax_call_to_import_log , 1000) 
        } );
    }

    // Hcode import data script
    jQuery('#hcode-import-sample-data').on('click', function(e) {
        e.preventDefault();
        
        var loading_img = jQuery('#import-loader-img');
        var import_messages = jQuery('.import-ajax-message');

        import_messages.empty();

        var message = confirm('Are you sure you want to proceed? Please note that your existing data will be replaced.');

        if(message == true) {
            jQuery('#hcode-import-sample-data').attr('disabled',true);
            loading_img.show();
            import_messages.show();

            var data = {
                action: 'hcode_import_sample_data'
            };

            jQuery('.importer-notice').hide();

            var request = $.ajax({
              url: ajaxurl,
              type: "POST",
              data: data
            });

            request.success(function(msg) {
                //ajaxmessageend();
                import_completed = true
                loading_img.hide();
                jQuery('#hcode-import-sample-data').attr('disabled',false);
                //console.log( msg );
            });

            request.fail(function(jqXHR, textStatus) {
              alert( "Request failed: " + textStatus );
            });

            setTimeout( refresh_ajax_call_to_import_log , 1000);
        }

    e.preventDefault();
    });
})( jQuery );

jQuery.noConflict();