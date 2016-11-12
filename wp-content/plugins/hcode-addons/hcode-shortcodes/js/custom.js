!function($) {
	"use strict";
    /* jQuery Enable Click Event For Switch */
    $('.switch-option-enable').on('click',function(){    
      if (!$(this).hasClass('selected')) {
          var c = $(this).parent().find('select');
          $(this).parent().find('.selected').removeClass('selected');
          $(this).addClass('selected');
          c.val(1).trigger('change');
        }
    });

    /* jQuery Disable Click Event For Switch */
    $('.switch-option-disable').on('click',function(){
      if (!$(this).hasClass("selected")) {
          var c = $(this).parent().find('select');
          $(this).parent().find('.selected').removeClass("selected");
          $(this).addClass("selected");
          c.val(0).trigger('change');
        }
    });    

    /* jQuery For Preview Slider Image */
    $('.preview-image-hide').hide();
    $('.preview-image-show').show();
    $('.hcode-preview-image-main').parent().parent().find('.wpb_element_label').hide();

    /* jQuery For add selected class for current type */
    $('.slider_premade_style,.hcode_page_title_premade_style,.tabs_style,.hcode_alert_massage_premade_style,.hcode_team_member_premade_style,.accordian_pre_define_style,.hcode_single_image_premade_style,.button_style,.hcode_feature_type,.hcode_heading_type,.popup_type,.counter_or_chart,.hcode_block_premade_style,.hcode_tab_content_premade_style, .hcode_font_icon_premade_style, .hcode_et_icon_premade_style, .hcode_newsletter_premade_style,.slider_content_premade_style,.show_content,.hcode_parallax_style,.show_blog_slider_style').bind('change keyup', function(e) {
      $(this).parent().parent().parent().find('.hcode_preview_image_select option').removeAttr("selected");
      $(this).parent().parent().parent().find('.preview-image-hide').hide();
      var current_selected = $(this).val();
      if(current_selected){
        $(this).parent().parent().parent().find('.hcode-preview-image-main .'+current_selected).show();
        $(this).parent().parent().parent().find('.hcode_preview_image_select option[class="'+current_selected+'"]').attr('selected', 'selected');
      }
    });

    /* jQuery Click Event For Icon */
    $('.hcode_icon_preview').on('click', function() {
        if( $(this).hasClass('active_icon') ){
          $(this).removeClass('active_icon');
          $(this).parent().parent().find('.hcode_icon_field').val('');
        }else{
          $('.hcode_icon_preview').removeClass('active_icon');
          $(this).addClass('active_icon');
          var selected_icon = $(this).children().attr('data-name');
          $(this).parent().parent().find('.hcode_icon_field').val(selected_icon);
        }
    });

}(window.jQuery);