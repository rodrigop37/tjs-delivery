(function( $ ) {
    'use strict';

    /* custom tab jquery*/ 

    $(window).load(function() {
        $('.hcode-admin-tab-slidingdiv').css("display","none");
        
        $('.hcode-admin-tabs > .hcode-admin-title').click(function() {
            $('.hcode-admin-tab-slidingdiv').slideUp();
            $('.hcode-admin-tabs > .hcode-admin-title').find('.el-icon-minus').removeClass('el-icon-minus').addClass('el-icon-plus');
            //$('.hcode-admin-tabs > .hcode-admin-title').find('.el-icon-minus').addClass('el-icon-plus');            
            $('.hcode-admin-title').removeClass("active");

            if($(this).next('.hcode-admin-tab-slidingdiv').css("display") == "none")
            {
                $(this).next('.hcode-admin-tab-slidingdiv').hide().slideDown('500');
                $(this).addClass('active');
                $(this).find('.el-icon-plus').removeClass('el-icon-plus');
                $(this).find('.hcode-icon').addClass('el-icon-minus');
            } 
            else {
                $(this).removeClass("active");         
                $(this).next('.hcode-admin-tab-slidingdiv').slideUp('500');         
                $(this).find('.el-icon-minus').removeClass('el-icon-minus');
                $(this).find('.hcode-icon').addClass('el-icon-plus');
            }

            $.redux.initFields();

        });
    });

})( jQuery );

jQuery.noConflict();