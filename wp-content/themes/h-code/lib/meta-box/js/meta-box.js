jQuery(document).ready(function($){
	"use strict";
	// Check on load for selected tab when user come before if not it show first one active
	if($.cookie('hcode_metabox_active_id_' + $('#post_ID').val())) {
		var active_class = $.cookie('hcode_metabox_active_id_' + $('#post_ID').val());

		$('#hcode_admin_options').find('.hcode_meta_box_tabs li').removeClass('active');
		$('#hcode_admin_options').find('.hcode_meta_box_tab').removeClass('active').hide();

		$('.'+active_class).addClass('active').fadeIn();
		$('#hcode_admin_options').find('#'+active_class).addClass('active').fadeIn();

	} else {
		$('.hcode_meta_box_tabs li:first-child').addClass('active');
		$('.hcode_meta_box_tab_content .hcode_meta_box_tab:first-child').addClass('active').fadeIn();
	}
	$('.hcode_meta_box_tabs li a').click(function(e) {
		e.preventDefault();

		var tab_click_id = $(this).parent().attr('class').split(' ')[0];
		var tab_main_div = $(this).parents('#hcode_admin_options');

		$.cookie('hcode_metabox_active_id_' + $('#post_ID').val(), tab_click_id, { expires: 7 });
		
		tab_main_div.find('.hcode_meta_box_tabs li').removeClass('active');
		tab_main_div.find('.hcode_meta_box_tab').removeClass('active').hide();

		$(this).parent().addClass('active').fadeIn();
		tab_main_div.find('#'+tab_click_id).addClass('active').fadeIn();

	});

	/* Metabox dependance of fields */
	
    $(".hcode_select_parent").change(function () {
	    var str_selected = $(this).find("option:selected").val();
	    var tab_active_status_main = $(this).parents('#hcode_admin_options');
	    $('.hide_dependent').find('input[type="hidden"]').val('0');
		tab_active_status_main.find('.hide_dependent').addClass('hide_dependency');

		if (tab_active_status_main.find('.hide_dependency').hasClass(str_selected+'_single')){
			tab_active_status_main.find('.'+str_selected+'_single').removeClass('hide_dependency');
			tab_active_status_main.find('.'+str_selected+'_single').find('input[type="hidden"]').val('1');
		}
		
		/* Special case for Both sidebar*/ 
		if(str_selected == 'hcode_layout_both_sidebar'){
			$('.hcode_layout_left_sidebar_single').removeClass('hide_dependency');
			$('.hcode_layout_left_sidebar_single').find('input[type="hidden"]').val('1');
			$('.hcode_layout_right_sidebar_single').removeClass('hide_dependency');
			$('.hcode_layout_right_sidebar_single').find('input[type="hidden"]').val('1');
		}
		
	});
    // Remaining BY Mukesh
    $('#hcode_layout_settings_single').change(function () {
    	var str_selected = $(this).find("option:selected").val();
    	var str_selected_parent = $(this).parents('#hcode_tab_layout_settings');
    	str_selected_parent.find('.hide-child').addClass('hide-children');
    	str_selected_parent.find('.' +str_selected+ '_single_box').removeClass('hide-children');
    	str_selected_parent.find('.' +str_selected+ '_single_box').addClass('show-children');

    	
    });
	/* Metabox Image Upload Button Click*/

	jQuery('.hcode_upload_button').click(function (event) {
        var file_frame;
	  	var button = $(this);

	    var button_parent = $(this).parent();
		var id = button.attr('id').replace('_button', '');
	    event.preventDefault();
	    

	    // If the media frame already exists, reopen it.
	    if ( file_frame ) {
	      file_frame.open();
	      return;
	    }

	    // Create the media frame.
	    file_frame = wp.media.frames.file_frame = wp.media({
	      title: jQuery( this ).data( 'uploader_title' ),
	      button: {
	        text: jQuery( this ).data( 'uploader_button_text' ),
	      },
	      multiple: false  // Set to true to allow multiple files to be selected
	    });

	    // When an image is selected, run a callback.
	    file_frame.on( 'select', function() {
	      // We set multiple to false so only get one image from the uploader
	      var full_attachment = file_frame.state().get('selection').first().toJSON();

	      var attachment = file_frame.state().get('selection').first();

	      var thumburl = attachment.attributes.sizes.thumbnail;
	      var thumb_hidden = button_parent.find('.upload_field').attr('name');

	      if ( thumburl || full_attachment ) {
				button_parent.find("#"+id).val(full_attachment.url);
				button_parent.find("."+thumb_hidden+"_thumb").val(full_attachment.url);
				
				button_parent.find(".upload_image_screenshort").attr("src", full_attachment.url);
				//button_parent.find(".upload_image_screenshort").show();
				button_parent.find(".upload_image_screenshort").slideDown();
			}
	    });

	    // Finally, open the modal
	    file_frame.open();
	});
	
	// Remove button function to remove attach image and hide screenshort Div.
	jQuery('.hcode_remove_button').click(function () {
		var remove_parent = $(this).parent();
		remove_parent.find('.upload_field').val('');
		remove_parent.find('input[type="hidden"]').val('');
		remove_parent.find('.upload_image_screenshort').slideUp();
	});

	// On page load add all image url to show in screenshort.
	$('.upload_field').each(function(){
		if($(this).val()){
			$(this).parent().find('.upload_image_screenshort').attr("src", $(this).parent().find('input[type="hidden"]').val());
		}else{
			$(this).parent().find('.upload_image_screenshort').hide();
		}
	});
	if(jQuery('.post-type-portfolio #post-format-0').is(":checked")){
		if(jQuery("#hcode_hidden_val_select_link").val() == '1'){
			jQuery('.post-type-portfolio #post-format-link').prop('checked', true);
		}else if(jQuery("#hcode_hidden_val_select_gallery").val() == '1'){
			jQuery('.post-type-portfolio #post-format-gallery').prop('checked', true);
		}else if(jQuery("#hcode_hidden_val_select_video").val() == '1'){
			jQuery('.post-type-portfolio #post-format-video').prop('checked', true);
		}else if(jQuery("#hcode_hidden_val_select_image").val() == '1'){
			jQuery('.post-type-portfolio #post-format-image').prop('checked', true);
		}
	}
	/* multiple image upload */

	jQuery('.hcode_upload_button_multiple').click(function (event) {
        var file_frame;
	  	var button = $(this);

	    var button_parent = $(this).parent();
		var id = button.attr('id').replace('_button', '');
	    event.preventDefault();
	    

	    // If the media frame already exists, reopen it.
	    if ( file_frame ) {
	      file_frame.open();
	      return;
	    }

	    // Create the media frame.
	    file_frame = wp.media.frames.file_frame = wp.media({
	      title: jQuery( this ).data( 'uploader_title' ),
	      button: {
	        text: jQuery( this ).data( 'uploader_button_text' ),
	      },
	      multiple: true  // Set to true to allow multiple files to be selected
	    });

	    // When an image is selected, run a callback.
	    file_frame.on( 'select', function() {

	      var thumb_hidden = button_parent.find('.upload_field').attr('name');
	     
			var selection = file_frame.state().get('selection');
				selection.map( function( attachment ) {
				var attachment = attachment.toJSON();
				button_parent.find('.multiple_images').append( '<div id="'+attachment.id+'"><img src="'+attachment.url+'" class="upload_image_screenshort_multiple" alt="" style="width:100px;"/><a href="javascript:void(0)" class="remove">remove</a></div>' );
			});
	    });
	    // Finally, open the modal
	    file_frame.open();
	});

	jQuery(".button-primary, #save-action #save-post").on('click',function(){
		var pr_div;
		jQuery('.multiple_images').each(function(){
			if(jQuery(this).children().length > 0){
				var attach_id = [];
				var pr_div = jQuery(this).parent();
				jQuery(this).children('div').each(function(){
						attach_id.push(jQuery(this).attr('id'));						
				});
				
				pr_div.find('.upload_field').val(attach_id);
			}else{
				jQuery(this).parent().find('.upload_field').val('');
			}
		});		
	});

	jQuery(".multiple_images").on('click','.remove', function() {
		jQuery(this).parent().slideUp();
		jQuery(this).parent().remove();
	});

	/* multiple image upload End */


	/*==============================================================*/
	// Post Format Meta Start
	/*==============================================================*/
	function post_format_selection_options() {
			
			//Hide Link Format in Post type
			jQuery('body.post-type-post #post-format-link, body.post-type-post .post-format-link').hide();
			jQuery('body.post-type-portfolio #post-format-quote, body.post-type-portfolio .post-format-quote').hide();
			jQuery('body.post-type-portfolio .post-format-quote').next('br').hide();
			
			jQuery('body.post-type-post #hcode_admin_options_single').hide();

	        if (jQuery('#post-format-gallery').is(':checked')) {
	        	jQuery('body.post-type-post #hcode_admin_options_single').show();
	            jQuery('.hcode_gallery_single_box').fadeIn();
	            jQuery('.hcode_lightbox_image_single_box').fadeIn();
	            jQuery('.hcode_quote_single_box').hide();
	            jQuery('.hcode_link_type_single_box').hide();
	            jQuery('.hcode_link_single_box').hide();
	            jQuery('.hcode_video_mp4_single_box').hide();
	            jQuery('.hcode_video_ogg_single_box').hide();
	            jQuery('.hcode_video_webm_single_box').hide();
	            jQuery('.hcode_video_single_box').hide();
	            jQuery('.hcode_video_type_single_box').hide();
	            jQuery('.hcode_enable_mute_single_box').hide();
	            jQuery('.hcode_enable_loop_single_box').hide();
	            jQuery('.hcode_enable_autoplay_single_box').hide();
	            jQuery('.hcode_enable_controls_single_box').hide();
	            jQuery('.hcode_image_single_box').hide();
	            jQuery('.hcode_featured_image_single_box').fadeIn();
	            jQuery('.hcode_subtitle_single_box').fadeIn();

	        } else if (jQuery('#post-format-video').is(':checked')) {
	        	jQuery('body.post-type-post #hcode_admin_options_single').show();
	            jQuery('.hcode_gallery_single_box').hide();
	            jQuery('.hcode_lightbox_image_single_box').hide();
	            jQuery('.hcode_quote_single_box').hide();
	            jQuery('.hcode_link_type_single_box').hide();
	            jQuery('.hcode_link_single_box').hide();
	            jQuery('.hcode_video_mp4_single_box').fadeIn();
	            jQuery('.hcode_video_ogg_single_box').fadeIn();
	            jQuery('.hcode_video_webm_single_box').fadeIn();
	            jQuery('.hcode_video_single_box').fadeIn();
	            jQuery('.hcode_video_type_single_box').fadeIn();
	            jQuery('.hcode_enable_mute_single_box').fadeIn();
	            jQuery('.hcode_enable_loop_single_box').fadeIn();
	            jQuery('.hcode_enable_autoplay_single_box').fadeIn();
	            jQuery('.hcode_enable_controls_single_box').fadeIn();
	            jQuery('.hcode_image_single_box').hide();
	            jQuery('.hcode_featured_image_single_box').fadeIn();
	            jQuery('.hcode_subtitle_single_box').fadeIn();


	        }else if (jQuery('#post-format-quote').is(':checked')) {
	        	jQuery('body.post-type-post #hcode_admin_options_single').show();
	            jQuery('.hcode_gallery_single_box').hide();
	            jQuery('.hcode_lightbox_image_single_box').hide();
	            jQuery('.hcode_quote_single_box').fadeIn();
	            jQuery('.hcode_link_type_single_box').hide();
	            jQuery('.hcode_link_single_box').hide();
	            jQuery('.hcode_video_mp4_single_box').hide();
	            jQuery('.hcode_video_ogg_single_box').hide();
	            jQuery('.hcode_video_webm_single_box').hide();
	            jQuery('.hcode_video_single_box').hide();
	            jQuery('.hcode_video_type_single_box').hide();
	            jQuery('.hcode_enable_mute_single_box').hide();
	            jQuery('.hcode_enable_loop_single_box').hide();
	            jQuery('.hcode_enable_autoplay_single_box').hide();
	            jQuery('.hcode_enable_controls_single_box').hide();
	            jQuery('.hcode_image_single_box').hide();
	            jQuery('.hcode_featured_image_single_box').fadeIn();
	            jQuery('.hcode_subtitle_single_box').fadeIn();
	            
	        } else if (jQuery('#post-format-link').is(':checked')) {
	        	jQuery('body.post-type-post #hcode_admin_options_single').show();
	            jQuery('.hcode_gallery_single_box').hide();
	            jQuery('.hcode_lightbox_image_single_box').hide();
	            jQuery('.hcode_quote_single_box').hide();
	            jQuery('.hcode_link_type_single_box').fadeIn();
	            jQuery('.hcode_link_single_box').fadeIn();
	            jQuery('.hcode_video_mp4_single_box').hide();
	            jQuery('.hcode_video_ogg_single_box').hide();
	            jQuery('.hcode_video_webm_single_box').hide();
	            jQuery('.hcode_video_single_box').hide();
	            jQuery('.hcode_video_type_single_box').hide();
	            jQuery('.hcode_enable_mute_single_box').hide();
	            jQuery('.hcode_enable_loop_single_box').hide();
	            jQuery('.hcode_enable_autoplay_single_box').hide();
	            jQuery('.hcode_enable_controls_single_box').hide();
	            jQuery('.hcode_image_single_box').hide();
	            jQuery('.hcode_featured_image_single_box').fadeIn();
	            jQuery('.hcode_subtitle_single_box').fadeIn();
	            
	        }else if (jQuery('#post-format-image').is(':checked')) {
	        	jQuery('body.post-type-post #hcode_admin_options_single').show();
	            jQuery('.hcode_gallery_single_box').hide();
	            jQuery('.hcode_lightbox_image_single_box').hide();
	            jQuery('.hcode_quote_single_box').hide();
	            jQuery('.hcode_image_single_box').fadeIn();
	            jQuery('.hcode_link_type_single_box').hide();
	            jQuery('.hcode_link_single_box').hide();
	            jQuery('.hcode_video_mp4_single_box').hide();
	            jQuery('.hcode_video_ogg_single_box').hide();
	            jQuery('.hcode_video_webm_single_box').hide();
	            jQuery('.hcode_video_single_box').hide();
	            jQuery('.hcode_video_type_single_box').hide();
	            jQuery('.hcode_enable_mute_single_box').hide();
	            jQuery('.hcode_enable_loop_single_box').hide();
	            jQuery('.hcode_enable_autoplay_single_box').hide();
	            jQuery('.hcode_enable_controls_single_box').hide();
	            jQuery('.hcode_featured_image_single_box').hide();
	            jQuery('.hcode_subtitle_single_box').fadeIn();
	            
	        }else {
	        	jQuery('body.post-type-post #hcode_admin_options_single').hide();
	            jQuery('.hcode_gallery_single_box').hide();
	            jQuery('.hcode_lightbox_image_single_box').hide();
	            jQuery('.hcode_quote_single_box').hide();
	            jQuery('.hcode_link_type_single_box').hide();
	            jQuery('.hcode_link_single_box').hide();
	            jQuery('.hcode_video_mp4_single_box').hide();
	            jQuery('.hcode_video_ogg_single_box').hide();
	            jQuery('.hcode_video_webm_single_box').hide();
	            jQuery('.hcode_video_single_box').hide();
	            jQuery('.hcode_video_type_single_box').hide();
	            jQuery('.hcode_enable_mute_single_box').hide();
	            jQuery('.hcode_enable_loop_single_box').hide();
	            jQuery('.hcode_enable_autoplay_single_box').hide();
	            jQuery('.hcode_enable_controls_single_box').hide();
	            jQuery('.hcode_image_single_box').hide();
	            jQuery('.hcode_featured_image_single_box').hide();
	            jQuery('.hcode_subtitle_single_box').fadeIn();

	        }
	    }
	    post_format_selection_options();

	    var select_type = jQuery('#post-formats-select input');
	    

	    jQuery(this).change(function() {
	        post_format_selection_options();
	    });

	    // Remove unselected type meta data for post.
	    post_submit();
	    function post_submit(){
	        jQuery('#publish').click(function(){
	        	if (jQuery('#post-format-gallery').is(':checked')) {
		            jQuery('.hcode_meta_box_tab_content_single .hcode_quote_single_box').find("textarea").val('');
		            jQuery('.hcode_meta_box_tab_content_single .hcode_link_type_single_box').find("select option").val('');
		            jQuery('.hcode_meta_box_tab_content_single .hcode_link_single_box').find("input:first-child").val('');
		            jQuery('.hcode_meta_box_tab_content_single .hcode_video_mp4_single_box').find("input:first-child").val('');
		            jQuery('.hcode_meta_box_tab_content_single .hcode_video_ogg_single_box').find("input:first-child").val('');
		            jQuery('.hcode_meta_box_tab_content_single .hcode_video_webm_single_box').find("input:first-child").val('');
		            jQuery('.hcode_meta_box_tab_content_single .hcode_video_single_box').find("input:first-child").val('');
		            jQuery('.hcode_meta_box_tab_content_single .hcode_video_type_single_box').find("select option").val('');
		            jQuery('.hcode_meta_box_tab_content_single .hcode_enable_mute_single_box').find("select option").val('');
		            jQuery('.hcode_meta_box_tab_content_single .hcode_enable_loop_single_box').find("select option").val('');
		            jQuery('.hcode_meta_box_tab_content_single .hcode_enable_autoplay_single_box').find("select option").val('');
		            jQuery('.hcode_meta_box_tab_content_single .hcode_enable_controls_single_box').find("select option").val('');
		            jQuery('.hcode_meta_box_tab_content_single .hcode_image_single_box').find("select option").val('');

	        	}if (jQuery('#post-format-video').is(':checked')) {
		            jQuery('.hcode_meta_box_tab_content_single .upload_field').val('');
		            jQuery('.hcode_meta_box_tab_content_single .hcode_quote_single_box').find("textarea").val('');
		            jQuery('.hcode_meta_box_tab_content_single .hcode_link_type_single_box').find("select option").val('');
		            jQuery('.hcode_meta_box_tab_content_single .hcode_link_single_box').find("input:first-child").val('');
		            jQuery('.hcode_meta_box_tab_content_single .hcode_image_single_box').find("select option").val('');
		            jQuery('.hcode_meta_box_tab_content_single .hcode_lightbox_image_single_box').find("select option").val('');

	        	}if (jQuery('#post-format-quote').is(':checked')) {
		            jQuery('.hcode_meta_box_tab_content_single .upload_field').val('');
		            jQuery('.hcode_meta_box_tab_content_single .hcode_link_type_single_box').find("select option").val('');
		            jQuery('.hcode_meta_box_tab_content_single .hcode_link_single_box').find("input:first-child").val('');
		            jQuery('.hcode_meta_box_tab_content_single .hcode_video_mp4_single_box').find("input:first-child").val('');
		            jQuery('.hcode_meta_box_tab_content_single .hcode_video_ogg_single_box').find("input:first-child").val('');
		            jQuery('.hcode_meta_box_tab_content_single .hcode_video_webm_single_box').find("input:first-child").val('');
		            jQuery('.hcode_meta_box_tab_content_single .hcode_video_single_box').find("input:first-child").val('');
		            jQuery('.hcode_meta_box_tab_content_single .hcode_video_type_single_box').find("select option").val('');
		            jQuery('.hcode_meta_box_tab_content_single .hcode_enable_mute_single_box').find("select option").val('');
		            jQuery('.hcode_meta_box_tab_content_single .hcode_enable_loop_single_box').find("select option").val('');
		            jQuery('.hcode_meta_box_tab_content_single .hcode_enable_autoplay_single_box').find("select option").val('');
		            jQuery('.hcode_meta_box_tab_content_single .hcode_enable_controls_single_box').find("select option").val('');
		            jQuery('.hcode_meta_box_tab_content_single .hcode_image_single_box').find("select option").val('');
		            jQuery('.hcode_meta_box_tab_content_single .hcode_lightbox_image_single_box').find("select option").val('');
		            
	            
	        	}if (jQuery('#post-format-link').is(':checked')) {
		            jQuery('.hcode_meta_box_tab_content_single .upload_field').val('');
		            jQuery('.hcode_meta_box_tab_content_single .hcode_quote_single_box').find("textarea").val('');
		            jQuery('.hcode_meta_box_tab_content_single .hcode_video_mp4_single_box').find("input:first-child").val('');
		            jQuery('.hcode_meta_box_tab_content_single .hcode_video_ogg_single_box').find("input:first-child").val('');
		            jQuery('.hcode_meta_box_tab_content_single .hcode_video_webm_single_box').find("input:first-child").val('');
		            jQuery('.hcode_meta_box_tab_content_single .hcode_video_single_box').find("input:first-child").val('');
		            jQuery('.hcode_meta_box_tab_content_single .hcode_video_type_single_box').find("select option").val('');
		            jQuery('.hcode_meta_box_tab_content_single .hcode_enable_mute_single_box').find("select option").val('');
		            jQuery('.hcode_meta_box_tab_content_single .hcode_enable_loop_single_box').find("select option").val('');
		            jQuery('.hcode_meta_box_tab_content_single .hcode_enable_autoplay_single_box').find("select option").val('');
		            jQuery('.hcode_meta_box_tab_content_single .hcode_enable_controls_single_box').find("select option").val('');
		            jQuery('.hcode_meta_box_tab_content_single .hcode_image_single_box').find("select option").val('');
		            jQuery('.hcode_meta_box_tab_content_single .hcode_lightbox_image_single_box').find("select option").val('');
	            
	        	}if (jQuery('#post-format-image').is(':checked')) {
		            jQuery('.hcode_meta_box_tab_content_single .upload_field').val('');
		            jQuery('.hcode_meta_box_tab_content_single .hcode_quote_single_box').find("textarea").val('');
		            jQuery('.hcode_meta_box_tab_content_single .hcode_link_type_single_box').find("select option").val('');
		            jQuery('.hcode_meta_box_tab_content_single .hcode_link_single_box').find("input:first-child").val('');
		            jQuery('.hcode_meta_box_tab_content_single .hcode_video_mp4_single_box').find("input:first-child").val('');
		            jQuery('.hcode_meta_box_tab_content_single .hcode_video_ogg_single_box').find("input:first-child").val('');
		            jQuery('.hcode_meta_box_tab_content_single .hcode_video_webm_single_box').find("input:first-child").val('');
		            jQuery('.hcode_meta_box_tab_content_single .hcode_video_single_box').find("input:first-child").val('');
		            jQuery('.hcode_meta_box_tab_content_single .hcode_video_type_single_box').find("select option").val('');
		            jQuery('.hcode_meta_box_tab_content_single .hcode_enable_mute_single_box').find("select option").val('');
		            jQuery('.hcode_meta_box_tab_content_single .hcode_enable_loop_single_box').find("select option").val('');
		            jQuery('.hcode_meta_box_tab_content_single .hcode_enable_autoplay_single_box').find("select option").val('');
		            jQuery('.hcode_meta_box_tab_content_single .hcode_enable_controls_single_box').find("select option").val('');
		            jQuery('.hcode_meta_box_tab_content_single .hcode_lightbox_image_single_box').find("select option").val('');
		            jQuery('.hcode_meta_box_tab_content_single .hcode_featured_image_single_box').find("select option").val('');
	            
	        	}if (jQuery('#post-format-0').is(':checked')) {
		            jQuery('.hcode_meta_box_tab_content_single .upload_field').val('');
		            jQuery('.hcode_meta_box_tab_content_single .hcode_quote_single_box').find("textarea").val('');
		            jQuery('.hcode_meta_box_tab_content_single .hcode_link_type_single_box').find("select option").val('');
		            jQuery('.hcode_meta_box_tab_content_single .hcode_link_single_box').find("input:first-child").val('');
		            jQuery('.hcode_meta_box_tab_content_single .hcode_video_mp4_single_box').find("input:first-child").val('');
		            jQuery('.hcode_meta_box_tab_content_single .hcode_video_ogg_single_box').find("input:first-child").val('');
		            jQuery('.hcode_meta_box_tab_content_single .hcode_video_webm_single_box').find("input:first-child").val('');
		            jQuery('.hcode_meta_box_tab_content_single .hcode_video_single_box').find("input:first-child").val('');
		            jQuery('.hcode_meta_box_tab_content_single .hcode_video_type_single_box').find("select option").val('');
		            jQuery('.hcode_meta_box_tab_content_single .hcode_enable_mute_single_box').find("select option").val('');
		            jQuery('.hcode_meta_box_tab_content_single .hcode_enable_loop_single_box').find("select option").val('');
		            jQuery('.hcode_meta_box_tab_content_single .hcode_enable_autoplay_single_box').find("select option").val('');
		            jQuery('.hcode_meta_box_tab_content_single .hcode_enable_controls_single_box').find("select option").val('');
		            jQuery('.hcode_meta_box_tab_content_single .hcode_image_single_box').find("select option").val('');
		            jQuery('.hcode_meta_box_tab_content_single .hcode_lightbox_image_single_box').find("select option").val('');
		            jQuery('.hcode_meta_box_tab_content_single .hcode_featured_image_single_box').find("select option").val('');
	        	}
	        });
	    }
	/*==============================================================*/
	// Post Format Meta End
	/*==============================================================*/
});
