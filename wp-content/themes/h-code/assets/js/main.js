"use strict";
var $portfolio;
var $masonry_block;
var $portfolio_selectors;
var $blog;

var isMobile = false;
var isiPhoneiPad = false;

if (/Android|webOS|iPhone|iPad|iPod|BlackBerry|IEMobile|Opera Mini/i.test(navigator.userAgent)) {
    isMobile = true;
}
if (/iPhone|iPad|iPod/i.test(navigator.userAgent)) {
    isiPhoneiPad = true;
}
/* For remove conflict */
$ = jQuery.noConflict();
$(document).ready(function () {


    /*==============================================================*/
    //Placeholder For IE - START CODE
    /*==============================================================*/

    jQuery('input, textarea').placeholder({customClass:'my-placeholder'});
    
    /*==============================================================*/
    //Placeholder For IE - START CODE
    /*==============================================================*/
    
    /*==============================================================*/
    //Smooth Scroll - START CODE
    /*==============================================================*/
    jQuery('.inner-top').smoothScroll({
        speed: 900,
        offset: -68
    });
    /*==============================================================*/
    //Smooth Scroll - END CODE
    /*==============================================================*/

    /*==============================================================*/
    //Set Resize Header Menu - START CODE
    /*==============================================================*/
    SetResizeHeaderMenu();
    /*==============================================================*/
    //Set Resize Header Menu - END CODE
    /*==============================================================*/

    /*==============================================================*/
    //Ipad And Mobile Icon Hover - START CODE
    /*==============================================================*/
    IpadMobileHover();
    /*==============================================================*/
    //Ipad And Mobile Icon Hover - END CODE
    /*==============================================================*/

    /*==============================================================*/
    //For shopping cart- START CODE
    /*==============================================================*/
    
    if (!isMobile) {
        jQuery(".top-cart a.shopping-cart, .cart-content").hover(function () {
            jQuery(".cart-content").css('opacity', '1');
            jQuery(".cart-content").css('visibility', 'visible');
        }, function () {
            jQuery(".cart-content").css('opacity', '0');
            jQuery(".cart-content").css('visibility', 'hidden');
        });

        jQuery(document).on({
            mouseenter: function() {
                jQuery(".cart-content").css('opacity', '1');
                jQuery(".cart-content").css('visibility', 'visible');
            },
            mouseleave: function() {
                jQuery(".cart-content").css('opacity', '0');
                jQuery(".cart-content").css('visibility', 'hidden');
            }
        }, ".top-cart a.shopping-cart, .cart-content");

    }
    if (isiPhoneiPad) {
        jQuery(".video-wrapper").css('display', 'none');
    }

    jQuery(".top-cart a.shopping-cart").click(function () {
        if(!isMobile){
            var carturl = $(this).attr('href');
            window.location = carturl;
        }
        if ($('.cart-content').css('visibility') == 'visible') {
            jQuery(".cart-content").css('opacity', '0');
            jQuery(".cart-content").css('visibility', 'hidden');
        }
        else {
            jQuery(".cart-content").css('opacity', '1');
            jQuery(".cart-content").css('visibility', 'visible');

        }
    });

    /*==============================================================*/
    //Shrink nav on scroll - START CODE
    /*==============================================================*/

    if ($(window).scrollTop() > 10) {
        $('nav').addClass('shrink-nav');
    } else {
        $('nav').removeClass('shrink-nav');
    }
    /*==============================================================*/
    //Shrink nav on scroll - END CODE
    /*==============================================================*/


    /*==============================================================*/
    //Portfolio - START CODE
    /*==============================================================*/
    if (Modernizr.touch) {
        // show the close overlay button
        $(".close-overlay").removeClass("hidden");
        // handle the adding of hover class when clicked
        $(".porfilio-item").click(function (e) {
            if (!$(this).hasClass("hover")) {
                $(this).addClass("hover");
            }
        });
        // handle the closing of the overlay
        $(".close-overlay").click(function (e) {
            e.preventDefault();
            e.stopPropagation();
            if ($(this).closest(".porfilio-item").hasClass("hover")) {
                $(this).closest(".porfilio-item").removeClass("hover");
            }
        });
    } else {
        // handle the mouseenter functionality
        $(".porfilio-item").mouseenter(function () {
            $(this).addClass("hover");
        })
        // handle the mouseleave functionality
        .mouseleave(function () {
            $(this).removeClass("hover");
        });
    }

    // use for portfolio sotring with masonry

    $portfolio = $('.masonry-items');
    $portfolio.imagesLoaded(function () {
        $portfolio.isotope({
            itemSelector: 'li',
            layoutMode: 'masonry'
        });
    });

    // use for simple masonry ( for example /home-photography page )

    $masonry_block = $('.masonry-block-items');
    $masonry_block.imagesLoaded(function () {
        $masonry_block.isotope({
            itemSelector: 'li',
            layoutMode: 'masonry'
        });
    });

    $portfolio_selectors = $('.portfolio-filter > li > a');
    $portfolio_selectors.on('click', function () {
        $portfolio_selectors.parent().removeClass('active');
        $(this).parent().addClass('active');
        var selector = $(this).attr('data-filter');
        $portfolio.isotope({filter: selector});
        return false;
    });
    $blog = $('.blog-masonry');
    $blog.imagesLoaded(function () {

        //ISOTOPE FUNCTION - FILTER PORTFOLIO FUNCTION
        $blog.isotope({
            itemSelector: '.blog-listing',
            layoutMode: 'masonry'
        });
    });
    $(window).resize(function () {
        setTimeout(function () {
            $portfolio.isotope('layout');
            $blog.isotope('layout');
            $masonry_block.isotope('layout');
        }, 500);
    });
    /*==============================================================*/
    //Portfolio - END CODE
    /*==============================================================*/

    /*==============================================================*/
    //Set Parallax - START CODE
    /*==============================================================*/
    SetParallax();
    /*==============================================================*/
    //Set Parallax - END CODE
    /*==============================================================*/

    /*==============================================================*/
    //Sliders owlCarousel - START CODE
    /*==============================================================*/

    // jQuery use in Post slide loop
    $(".blog-gallery").owlCarousel({
        navigation: true, // Show next and prev buttons
        slideSpeed: 300,
        paginationSpeed: 400,
        singleItem: true,
        navigationText: ["<i class='fa fa-angle-left'></i>", "<i class='fa fa-angle-right'></i>"]
    });
    // jQuery use in hcode_feature_product_shop in Shop top five shortcode
    $("#owl-demo-small").owlCarousel({
        navigation: true, // Show next and prev buttons
        slideSpeed: 300,
        paginationSpeed: 400,
        singleItem: true,
        navigationText: ["<i class='fa fa-angle-left'></i>", "<i class='fa fa-angle-right'></i>"]
    });

    /*==============================================================*/
    //Sliders owlCarousel - END CODE
    /*==============================================================*/

    /*==============================================================*/
    //Stop Closing magnificPopup on selected elements - START CODE
    /*==============================================================*/

    $(".owl-pagination > .owl-page").click(function (e) {
        if ($(e.target).is('.mfp-close'))
            return;
        return false;
    });
    $(".owl-buttons > .owl-prev").click(function (e) {
        if ($(e.target).is('.mfp-close'))
            return;
        return false;
    });
    $(".owl-buttons > .owl-next").click(function (e) {
        if ($(e.target).is('.mfp-close'))
            return;
        return false;
    });
    /*==============================================================*/
    //Stop Closing magnificPopup on selected elements - END CODE
    /*==============================================================*/

    /*==============================================================*/
    // Woocommerce Product Thumbnail Slider - START CODE
    /*==============================================================*/

    
        var sync1 = $(".hcode-single-big-product-thumbnail-carousel");
        var sync2 = $(".hcode-single-product-thumbnail-carousel");

        sync1.owlCarousel({
        singleItem : true,
        slideSpeed : 1000,
        navigation: true,
        pagination:false,
        navigationText: ["<i class='fa fa-angle-left'></i>", "<i class='fa fa-angle-right'></i>"],
        afterAction : syncPosition,
        responsiveRefreshRate : 200,
        });

        sync2.owlCarousel({
        items : 3,
        itemsDesktop      : [1199,3],
        itemsDesktopSmall     : [979,3],
        itemsTablet       : [768,3],
        itemsMobile       : [479,2],
        pagination:false,
        navigation: true,
        navigationText: ["<i class='fa fa-angle-left'></i>", "<i class='fa fa-angle-right'></i>"],
        responsiveRefreshRate : 100,
        afterInit : function(el){
          el.find(".owl-item").eq(0).addClass("active");
        }
        });

        function syncPosition(el){
        var current = this.currentItem;
        $(".hcode-single-product-thumbnail-carousel")
          .find(".owl-item")
          .removeClass("active")
          .eq(current)
          .addClass("active");
        if($(".hcode-single-product-thumbnail-carousel").data("owlCarousel") !== undefined){
          center(current)
        }
        }

        $(".hcode-single-product-thumbnail-carousel").on("click", ".owl-item", function(e){
        e.preventDefault();
        var number = $(this).data("owlItem");
        sync1.trigger("owl.goTo",number);
        });

        function center(number){
        var sync2visible = sync2.data("owlCarousel").owl.visibleItems;
        var num = number;
        var found = false;
        for(var i in sync2visible){
          if(num === sync2visible[i]){
            var found = true;
          }
        }

        if(found===false){
          if(num>sync2visible[sync2visible.length-1]){
            sync2.trigger("owl.goTo", num - sync2visible.length+2)
          }else{
            if(num - 1 === -1){
              num = 0;
            }
            sync2.trigger("owl.goTo", num);
          }
        } else if(num === sync2visible[sync2visible.length-1]){
          sync2.trigger("owl.goTo", sync2visible[1])
        } else if(num === sync2visible[0]){
          sync2.trigger("owl.goTo", num-1)
        }

        }

    /*==============================================================*/
    // Woocommerce Product Thumbnail Slider - End CODE
    /*==============================================================*/
    
    /*==============================================================*/
    // Add "intro-page" Class in Intro Pages  - START CODE
    /*==============================================================*/

    if(jQuery('section').hasClass('intro-page')){
        $('section').removeClass('intro-page');
        $('body').addClass('intro-page');
    }
    /*==============================================================*/
    // Add "intro-page" Class in Intro Pages  - End CODE
    /*==============================================================*/

    /*==============================================================*/
    //WOW Animation  - START CODE
    /*==============================================================*/

    var wow = new WOW({
        boxClass: 'wow',
        animateClass: 'animated',
        offset: 90,
        mobile: false,
        live: true
    });
    wow.init();
    /*==============================================================*/
    //WOW Animation  - END CODE
    /*==============================================================*/

    /*==============================================================*/
    //accordion  - START CODE
    /*==============================================================*/

    $('.collapse').on('show.bs.collapse', function () {
        var id = $(this).attr('id');
        $('a[href="#' + id + '"]').closest('.panel-heading').addClass('active-accordion');
        $('a[href="#' + id + '"] .panel-title span').html('<i class="fa fa-minus"></i>');
    });
    $('.collapse').on('hide.bs.collapse', function () {
        var id = $(this).attr('id');
        $('a[href="#' + id + '"]').closest('.panel-heading').removeClass('active-accordion');
        $('a[href="#' + id + '"] .panel-title span').html('<i class="fa fa-plus"></i>');
    });
    $('.nav.navbar-nav a.inner-link').click(function () {
        $(this).parents('ul.navbar-nav').find('a.inner-link').removeClass('active');
        $(this).addClass('active');
        if ($('.navbar-header .navbar-toggle').is(':visible'))
            $(this).parents('.navbar-collapse').collapse('hide');
    });
    $('.accordion-style2 .collapse').on('show.bs.collapse', function () {
        var id = $(this).attr('id');
        $('a[href="#' + id + '"]').closest('.panel-heading').addClass('active-accordion');
        $('a[href="#' + id + '"] .panel-title span').html('<i class="fa fa-angle-up"></i>');
    });
    $('.accordion-style2 .collapse').on('hide.bs.collapse', function () {
        var id = $(this).attr('id');
        $('a[href="#' + id + '"]').closest('.panel-heading').removeClass('active-accordion');
        $('a[href="#' + id + '"] .panel-title span').html('<i class="fa fa-angle-down"></i>');
    });
    $('.accordion-style3 .collapse').on('show.bs.collapse', function () {
        var id = $(this).attr('id');
        $('a[href="#' + id + '"]').closest('.panel-heading').addClass('active-accordion');
        $('a[href="#' + id + '"] .panel-title span').html('<i class="fa fa-angle-up"></i>');
    });
    $('.accordion-style3 .collapse').on('hide.bs.collapse', function () {
        var id = $(this).attr('id');
        $('a[href="#' + id + '"]').closest('.panel-heading').removeClass('active-accordion');
        $('a[href="#' + id + '"] .panel-title span').html('<i class="fa fa-angle-down"></i>');
    });
    /*==============================================================*/
    //accordion - END CODE
    /*==============================================================*/

    /*==============================================================*/
    //toggles  - START CODE
    /*==============================================================*/

    $('toggles .collapse').on('show.bs.collapse', function () {
        var id = $(this).attr('id');
        $('a[href="#' + id + '"]').closest('.panel-heading').addClass('active-accordion');
        $('a[href="#' + id + '"] .panel-title span').html('<i class="fa fa-minus"></i>');
    });
    $('toggles .collapse').on('hide.bs.collapse', function () {
        var id = $(this).attr('id');
        $('a[href="#' + id + '"]').closest('.panel-heading').removeClass('active-accordion');
        $('a[href="#' + id + '"] .panel-title span').html('<i class="fa fa-plus"></i>');
    });
    $('.toggles-style2 .collapse').on('show.bs.collapse', function () {
        var id = $(this).attr('id');
        $('a[href="#' + id + '"]').closest('.panel-heading').addClass('active-accordion');
        $('a[href="#' + id + '"] .panel-title span').html('<i class="fa fa-angle-up"></i>');
    });
    $('.toggles-style2 .collapse').on('hide.bs.collapse', function () {
        var id = $(this).attr('id');
        $('a[href="#' + id + '"]').closest('.panel-heading').removeClass('active-accordion');
        $('a[href="#' + id + '"] .panel-title span').html('<i class="fa fa-angle-down"></i>');
    });
    /*==============================================================*/
    //toggles  - END CODE
    /*==============================================================*/

    /*==============================================================*/
    //fit video  - START CODE
    /*==============================================================*/
    
    try {
        $(".fit-videos").fitVids();
    }
    catch (err) {

    }

    /*==============================================================*/
    //fit video  - END CODE
    /*==============================================================*/

    /*==============================================================*/
    //google map - mouse scrolling wheel behavior - START CODE
    /*==============================================================*/
    // you want to enable the pointer events only on click;

    $('#map_canvas1').addClass('scrolloff'); // set the pointer events to none on doc ready
    $('#canvas1').on('click', function () {
        $('#map_canvas1').removeClass('scrolloff'); // set the pointer events true on click
    });
    // you want to disable pointer events when the mouse leave the canvas area;

    $("#map_canvas1").mouseleave(function () {
        $('#map_canvas1').addClass('scrolloff'); // set the pointer events to none when mouse leaves the map area
    });
    /*==============================================================*/
    //google map - mouse scrolling wheel behavior - END CODE
    /*==============================================================*/

    /*==============================================================*/
    //Search - START CODE
    /*==============================================================*/
    $("input.search-input").bind("keypress", function (event) {
        if (event.which == 13 && !isMobile) {
            $("button.search-button").click();
            event.preventDefault();
        }
    });
    $("input.search-input").bind("keyup", function (event) {
        if ($(this).val() == null || $(this).val() == "") {
            $(this).css({"border": "none", "border-bottom": "2px solid red"});
        }
        else {
            $(this).css({"border": "none", "border-bottom": "2px solid #000"});
        }
    });
    function validationSearchForm() {
        var error = true;
        $('#search-header input[type=text]').each(function (index) {
            if (index == 0) {
                if ($(this).val() == null || $(this).val() == "") {
                    $("#search-header").find("input:eq(" + index + ")").css({"border": "none", "border-bottom": "2px solid red"});
                    error = false;
                }
                else {
                    $("#search-header").find("input:eq(" + index + ")").css({"border": "none", "border-bottom": "2px solid #000"});
                }
            }
        });
        return error;
    }
    $("form.search-form, form.search-form-result").submit(function (event) {
        var error = validationSearchForm();
        if (error) {
            var action = $(this).attr('action');
            action = action + '?' + $(this).serialize();
            window.location = action;
        }

        event.preventDefault();
    });

    $('.navbar .navbar-collapse a.dropdown-toggle, .accordion-style1 .panel-heading a, .accordion-style2 .panel-heading a, .accordion-style3 .panel-heading a, .toggles .panel-heading a, .toggles-style2 .panel-heading a, .toggles-style3 .panel-heading a, a.carousel-control, .nav-tabs a[data-toggle="tab"], a.shopping-cart').click(function (e) {
        e.preventDefault();
    });
    $('body').on('touchstart click', function (e) {
        if ($(window).width() < 992) {
            if (!$('.navbar-collapse').has(e.target).is('.navbar-collapse') && $('.navbar-collapse').hasClass('in') && !$(e.target).hasClass('navbar-toggle')) {
                $('.navbar-collapse').collapse('hide');
            }
        }
        else {
            if (!$('.navbar-collapse').has(e.target).is('.navbar-collapse') && $('.navbar-collapse ul').hasClass('in')) {
                $('.navbar-collapse').find('a.dropdown-toggle').addClass('collapsed');
                $('.navbar-collapse').find('ul.dropdown-menu').removeClass('in');
                $('.navbar-collapse a.dropdown-toggle').removeClass('active');
            }
        }
    });
    $('.navbar-collapse a.dropdown-toggle').on('touchstart', function (e) {
        $('.navbar-collapse a.dropdown-toggle').not(this).removeClass('active');
        if ($(this).hasClass('active'))
            $(this).removeClass('active');
        else
            $(this).addClass('active');
    });

    $("button.navbar-toggle").click(function () {
        if (isMobile) {
            jQuery(".cart-content").css('opacity', '0');
            jQuery(".cart-content").css('visibility', 'hidden');

        }
    });
    $("a.dropdown-toggle").click(function () {
        if (isMobile) {
            jQuery(".cart-content").css('opacity', '0');
            jQuery(".cart-content").css('visibility', 'hidden');

        }
    });

    /*==============================================================*/
    //Search - END CODE
    /*==============================================================*/

    /*==============================================================*/
    //Parallax - START CODE
    /*==============================================================*/

    var $elem = $('#content');
    $('#scroll_to_top').fadeIn('slow');
    $('#nav_down').fadeIn('slow');
    $(window).bind('scrollstart', function () {
        $('#scroll_to_top,#nav_down').stop().animate({'opacity': '0.2'});
    });
    $(window).bind('scrollstop', function () {
        $('#scroll_to_top,#nav_down').stop().animate({'opacity': '1'});
    });
    $('#nav_down').click(
            function (e) {
                $('html, body').animate({scrollTop: $elem.height()}, 800);
            }
    );
    $('#scroll_to_top').click(
            function (e) {
                $('html, body').animate({scrollTop: '0px'}, 800);
            }
    );
    /*==============================================================*/
    //Parallax - END CODE
    /*==============================================================*/

});

/*==============================================================*/
// Counter Number Appear - START CODE
/*==============================================================*/

$(document).ready(function () {
    // Check counter div is visible then animate counter
    $('.counter-number').appear();
    $(document.body).on('appear', '.counter-number', function (e) {
        // this code is executed for each appeared element
        var element = $(this);
        if (!$(this).hasClass('appear')) {
            animatecounters(element);
            $(this).addClass('appear');
        }
    });

    // Check chart div is visible then animate chart
    $('.chart').appear();
    $(document.body).on('appear', '.chart', function (e) {
        // this code is executed for each appeared element
        var element = $(this);
        if (!$(this).hasClass('appear')) {
            animatecharts(element);
            $(this).addClass('appear');
        }
    });
});

/*==============================================================*/
// Counter Number Appear - END CODE
/*==============================================================*/

/*==============================================================*/
//Counter Number - START CODE
/*==============================================================*/

function animatecounters(element) {
     var getCounterNumber = jQuery(element).attr('data-to');
     jQuery({ ValuerHbcO: 0 }).delay(0).animate({ ValuerHbcO: getCounterNumber },
     {
         duration: 2000,
         easing: "swing",
         step: function (currentLeft) {
             var roundNumber = Math.ceil( currentLeft );
             $(element).text( roundNumber );
         }
     });
}
/*==============================================================*/
//Counter Number - END CODE
/*==============================================================*/

/*==============================================================*/
//Chart Animated - START CODE
/*==============================================================*/

function animatecharts(element) {
    element.data('easyPieChart').update(0);
    element.data('easyPieChart').update(element.attr("data-percent"));
}
/*==============================================================*/
//Chart Animated - END CODE
/*==============================================================*/

/*==============================================================*/
//Navigation - START CODE
/*==============================================================*/
// Shrink nav on scroll
$(window).scroll(function () {
    if ($(window).scrollTop() > 10) {
        $('nav').addClass('shrink-nav');
    } else {
        $('nav').removeClass('shrink-nav');
    }
});
// Resize Header Menu
function SetResizeHeaderMenu() {
    var width = jQuery('nav.navbar').children('div.container').width();
    $("ul.mega-menu-full").each(function () {
        jQuery(this).css('width', width + 'px');
    });
}
/*==============================================================*/
//Navigation - END CODE
/*==============================================================*/


/*==============================================================*/
//Parallax - START CODE
/*==============================================================*/
// Parallax Fix Image Scripts 

$('.parallax-fix').each(function () {
    if ($(this).children('.parallax-background-img').length) {
        var imgSrc = jQuery(this).children('.parallax-background-img').attr('src');
        jQuery(this).css('background', 'url("' + imgSrc + '")');
        jQuery(this).children('.parallax-background-img').remove();
        $(this).css('background-position', '50% 0%');
    }

});
var IsParallaxGenerated = false;
function SetParallax() {
    if ($(window).width() > 1030 && !IsParallaxGenerated) {
        $('.parallax1').parallax("50%", 0.1);
        $('.parallax2').parallax("50%", 0.2);
        $('.parallax3').parallax("50%", 0.3);
        $('.parallax4').parallax("50%", 0.4);
        $('.parallax5').parallax("50%", 0.5);
        $('.parallax6').parallax("50%", 0.6);
        $('.parallax7').parallax("50%", 0.7);
        $('.parallax8').parallax("50%", 0.8);
        $('.parallax9').parallax("50%", 0.05);
        $('.parallax10').parallax("50%", 0.02);
        $('.parallax11').parallax("50%", 0.01);
        $('.parallax12').parallax("50%", 0.099);
        IsParallaxGenerated = true;
    }
}
/*==============================================================*/
//Parallax - END CODE
/*==============================================================*/

/*==============================================================*/
//Mobile Toggle Control - START CODE
/*==============================================================*/

$('.mobile-toggle').click(function () {
    $('nav').toggleClass('open-nav');
});
$('.dropdown-arrow').click(function () {
    if ($('.mobile-toggle').is(":visible")) {
        if ($(this).children('.dropdown').hasClass('open-nav')) {
            $(this).children('.dropdown').removeClass('open-nav');
        } else {
            $('.dropdown').removeClass('open-nav');
            $(this).children('.dropdown').addClass('open-nav');
        }
    }
});
/*==============================================================*/
//Mobile Toggle Control - END CODE
/*==============================================================*/

/*==============================================================*/
//Contact Form Focus Remove Border- START CODE
/*==============================================================*/
$("form.wpcf7-form input").focus(function () {
    if ($(this).hasClass("wpcf7-not-valid")) {
        $(this).removeClass("wpcf7-not-valid");
        $(this).parent().find(".wpcf7-not-valid-tip").remove();
        $(this).parents().find(".wpcf7-validation-errors").css("display", "none"); 
    }
});
/*==============================================================*/
//Contact Form Focus Remove Border- END CODE
/*==============================================================*/

/*==============================================================*/
//Position Fullwidth Subnavs fullwidth correctly - START CODE
/*==============================================================*/
$('.dropdown-fullwidth').each(function () {
    $(this).css('width', $('.row').width());
    var subNavOffset = -($('nav .row').innerWidth() - $('.menu').innerWidth() - 15);
    $(this).css('left', subNavOffset);
});
/*==============================================================*/
//Position Fullwidth Subnavs fullwidth correctly - END CODE
/*==============================================================*/

/*==============================================================*/
//Smooth Scroll - START CODE
/*==============================================================*/
var scrollAnimationTime = 1200,
    scrollAnimation = 'easeInOutExpo';
$('a.scrollto').bind('click.smoothscroll', function (event) {
    event.preventDefault();
    var target = this.hash;
    $('html, body').stop()
            .animate({
                'scrollTop': $(target)
                        .offset()
                        .top
            }, scrollAnimationTime, scrollAnimation, function () {
                window.location.hash = target;
            });
});

// Inner links
$('.inner-link').smoothScroll({
    speed: 900,
    offset: -0
});

// Stop Propagation After Button Click
$('.scrollToDownSection .inner-link, .scrollToDownSection form').click(function(event) {
    event.stopPropagation();
});

$('section.scrollToDownSection').click(function(){
   var section_id = $( $(this).attr('data-section-id') );
   $('html, body').animate({scrollTop: section_id.offset().top}, 800);
});

// Single Product Readmore button link
$('.woo-inner-link').click(function(){
    $(this).attr("data-toggle","tab");
    $("html,body").animate({scrollTop:$(".product-deails-tab").offset().top - 80 }, 1000);
    $(".nav-tabs-light li").removeClass("active");
    $(".nav-tabs-light li.description_tab ").addClass("active");
});

/*==============================================================*/
//Smooth Scroll - END CODE
/*==============================================================*/

/*==============================================================*/
//Full Screen Header - START CODE
/*==============================================================*/

function SetResizeContent() {
     var minheight = $(window).height();
     $(".full-screen").css('min-height', minheight);

     var minwidth = $(window).width();
     $(".full-screen-width").css('min-width', minwidth);

     $('.menu-first-level').each(function () {
         $(this).find('ul.collapse').removeClass('in');
         var menu_link = $(this).children('a');
         var dataurl = menu_link.attr('data-redirect-url');
         var datadefaulturl = menu_link.attr('data-default-url');
         if (minwidth >= 992) {
             $(menu_link).removeAttr('data-toggle');
             $(this).children('a').attr('href', dataurl);
         } else {
             $(menu_link).attr('data-toggle', 'collapse');
             $(this).children('a').attr('href', datadefaulturl);
         }
     });
}


SetResizeContent();
/*==============================================================*/
//Full Screen Header - END CODE
/*==============================================================*/


/*==============================================================*/
//Window Resize Events - START CODE
/*==============================================================*/
$(window).resize(function () {
    //Position Fullwidth Subnavs fullwidth correctly
    $('.dropdown-fullwidth').each(function () {
        $(this).css('width', $('.row').width());
        var subNavOffset = -($('nav .row').innerWidth() - $('.menu').innerWidth() - 15);
        $(this).css('left', subNavOffset);
    });
    SetResizeContent();
    setTimeout(function () {
        SetResizeHeaderMenu();
    }, 200);
    if ($(window).width() >= 992 && $('.navbar-collapse').hasClass('in')) {
        $('.navbar-collapse').removeClass('in');
        //$('.navbar-collapse').removeClass('in').find('ul.dropdown-menu').removeClass('in').parent('li.dropdown').addClass('open');
        $('.navbar-collapse ul.dropdown-menu').each(function () {
            if ($(this).hasClass('in')) {
                $(this).removeClass('in'); //.parent('li.dropdown').addClass('open');
            }
        });
        $('ul.navbar-nav > li.dropdown > a.dropdown-toggle').addClass('collapsed');
        $('.logo').focus();
        $('.navbar-collapse a.dropdown-toggle').removeClass('active');
    }

    setTimeout(function () {
        SetParallax();
    }, 1000);
});
/*==============================================================*/
//Window Resize Events - END CODE
/*==============================================================*/

/*==============================================================*/
//Countdown Timer - START CODE
/*==============================================================*/
if($('.counter-hidden').hasClass('counter-underconstruction-date')){
    
    var $counter_date = $('.counter-underconstruction-date').html();
    $('#counter-underconstruction').countdown($counter_date+' 12:00:00').on('update.countdown', function (event) {
        var $this = $(this).html(event.strftime('' + '<div class="counter-container"><div class="counter-box first"><div class="number">%-D</div><span>Day%!d</span></div>' + '<div class="counter-box"><div class="number">%H</div><span>Hours</span></div>' + '<div class="counter-box"><div class="number">%M</div><span>Minutes</span></div>' + '<div class="counter-box last"><div class="number">%S</div><span>Seconds</span></div></div>'))
    });
}
if($('.counter-hidden').hasClass('hcode-time-counter-date')){
    var $counter_date = $('.hcode-time-counter-date').html();
    $('#hcode-time-counter').countdown($counter_date+' 12:00:00').on('update.countdown', function (event) {
        var $this = $(this).html(event.strftime('' + '<div class="counter-container"><div class="counter-box first"><div class="number">%-D</div><span>Day%!d</span></div>' + '<div class="counter-box"><div class="number">%H</div><span>Hours</span></div>' + '<div class="counter-box"><div class="number">%M</div><span>Minutes</span></div>' + '<div class="counter-box last"><div class="number">%S</div><span>Seconds</span></div></div>'))
    });
}
/*==============================================================*/
//Countdown Timer - END CODE
/*==============================================================*/


/*==============================================================*/
//Scroll To Top - START CODE
/*==============================================================*/
$(window).scroll(function () {
    if ($(this)
            .scrollTop() > 100) {
        $('.scrollToTop')
                .fadeIn();
    } else {
        $('.scrollToTop')
                .fadeOut();
    }
});
//Click event to scroll to top
$('.scrollToTop').click(function () {
    $('html, body').animate({
        scrollTop: 0
    }, 1000);
    return false;
});
/*==============================================================*/
//Scroll To Top - END CODE
/*==============================================================*/

$('nav ul.panel-group li.dropdown a.dropdown-toggle').click(function () {

    if ($(this).parent('li').find('ul.dropdown-menu').length > 0) {
        $(this).parents('ul').find('li.dropdown-toggle').not($(this).parent('li')).removeClass('open');
        if ($(this).parent('li').hasClass('open')) {
            $(this).parent('li').removeClass('open');
        }
        else {
            $(this).parent('li').addClass('open');
        }
    }
});

/*==============================================================*/
//To Make Checkbox/Radio Active/Disabled  - START CODE
/*==============================================================*/

$(".carousel .carousel-indicators > li:first-child").addClass("active");
$(".carousel .carousel-inner > div:first-child").addClass("active");

$('span.optionsradios input[value=Disabled]').attr('disabled', 'disabled');
$('span.optionscheckbox input[value=Disabled]').attr('disabled', 'disabled');
/*==============================================================*/
//To Make Checkbox/Radio Active/Disabled - END CODE
/*==============================================================*/


/*==============================================================*/
// NewsLetter Validation - START CODE
/*==============================================================*/

$('.submit_newsletter').click(function () {
    var reg = /^([A-Za-z0-9_\-\.])+\@([A-Za-z0-9_\-\.])+\.([A-Za-z]{2,4})$/;
    var current = $(this);
    var address = $(this).closest('form').find('.xyz_em_email').val();
    if(reg.test(address) == false) {
        //alert('Please check whether the email is correct.');
        current.closest('form').find('.xyz_em_email').addClass('newsletter-error');
    return false;
    }else{
    //document.subscription.submit();
    return true;
    }
});

$('.xyz_em_email').on('focus', function(){
  $(this).removeClass('newsletter-error');
});

/*==============================================================*/
// NewsLetter Validation - END CODE
/*==============================================================*/

if( $('div').hasClass('feature_nav')){
    $(".feature_nav .next").click(function () {
        $(this).parent().parent().find('.owl-carousel').trigger('owl.next');
    });
    $(".feature_nav .prev").click(function () {
        $(this).parent().parent().find('.owl-carousel').trigger('owl.prev');
    });
}

/*==============================================================*/
// Woocommerce Grid List View - START CODE
/*==============================================================*/
$('.hcode-product-grid-list-wrapper > a').click(function () {
    var set_product_view = $(this);
    var product_type = set_product_view.parents().find('.products');

    if( set_product_view.hasClass('hcode-list-view')){
        product_type.addClass('product-list-view');
        product_type.removeClass('product-grid-view');
    }
    if( set_product_view.hasClass('hcode-grid-view') ){
        product_type.addClass('product-grid-view');
        product_type.removeClass('product-list-view');
    }
    set_product_view.parent().find('.active').removeClass('active');
    set_product_view.addClass('active');

});


/*==============================================================*/
// Woocommerce Grid List View - END CODE
/*==============================================================*/

/*==============================================================*/
// Woocommerce Add Minus Plus Icon In Price Arround - START CODE
/*==============================================================*/
$(document).ready(function () {
    // Quantity buttons remove from 1.5 as button added in woocommerce/global/quantity-input.php
    //$('div.quantity:not(.buttons_added), wc-new td.quantity:not(.buttons_added)').addClass('buttons_added').append('<input type="button" value="+" class="plus" />').prepend('<input type="button" value="-" class="minus" />');

    // Target quantity inputs on product pages
    $('input.qty:not(.product-quantity input.qty)').each(function () {
        var min = parseFloat($(this).attr('min'));

        if (min && min > 0 && parseFloat($(this).val()) < min) {
            $(this).val(min);
        }
    });

    $(document).on('click', '.plus, .minus', function () {

        // when on checkout remove product via ajax. click on plus or minus remove disabled on update button. 
        $( 'div.woocommerce form input[name="update_cart"]' ).prop( 'disabled', false );

        // Get values
        var $qty = $(this).closest('.quantity').find('.qty'),
          currentVal = parseFloat($qty.val()),
          max = parseFloat($qty.attr('max')),
          min = parseFloat($qty.attr('min')),
          step = $qty.attr('step');

        // Format values
        if (!currentVal || currentVal === '' || currentVal === 'NaN') currentVal = 0;
        if (max === '' || max === 'NaN') max = '';
        if (min === '' || min === 'NaN') min = 0;
        if (step === 'any' || step === '' || step === undefined || parseFloat(step) === 'NaN') step = 1;

        // Change the value
        if ($(this).is('.plus')) {

            if (max && (max == currentVal || currentVal > max)) {
                $qty.val(max);
            } else {
                $qty.val(currentVal + parseFloat(step));
            }

        } else {

            if (min && (min == currentVal || currentVal < min)) {
                $qty.val(min);
            } else if (currentVal > 0) {
                $qty.val(currentVal - parseFloat(step));
            }

        }

        // Trigger change event
        $qty.trigger('change');
    });
});
/*==============================================================*/
// Woocommerce Add Minus Plus Icon In Price Arround - END CODE
/*==============================================================*/

/*==============================================================*/
// Checkout Remove Close Event - START CODE
/*==============================================================*/
$(document).ready(function () {
    $(document).on('click', '.checkout-alert-remove', function () {
        var remove_parent = $(this).parent().parent();
        if( remove_parent.hasClass('alert-remove') ){
            remove_parent.remove();
        }
    });
});
/*==============================================================*/
// Checkout Remove Close Event - END CODE
/*==============================================================*/

/*==============================================================*/
// Post Like Dislike Button JQuery - START CODE
/*==============================================================*/
$(document).ready(function () {
    $(document).on('click', '.sl-button', function() {
        var button = $(this);
        var post_id = button.attr('data-post-id');
        var security = button.attr('data-nonce');
        var iscomment = button.attr('data-iscomment');
        var allbuttons;
        if ( iscomment === '1' ) { /* Comments can have same id */
            allbuttons = $('.sl-comment-button-'+post_id);
        } else {
            allbuttons = $('.sl-button-'+post_id);
        }
        var loader = allbuttons.next('#sl-loader');
        if (post_id !== '') {
            $.ajax({
                type: 'POST',
                url: simpleLikes.ajaxurl,
                data : {
                    action : 'process_simple_like',
                    post_id : post_id,
                    nonce : security,
                    is_comment : iscomment
                },
                beforeSend:function(){
                    //loader.html('&nbsp;<div class="loader">Loading...</div>');
                },  
                success: function(response){
                    var icon = response.icon;
                    var count = response.count;
                    allbuttons.html(icon+count);
                    if(response.status === 'unliked') {
                        var like_text = simpleLikes.like;
                        allbuttons.prop('title', like_text);
                        allbuttons.removeClass('liked');
                    } else {
                        var unlike_text = simpleLikes.unlike;
                        allbuttons.prop('title', unlike_text);
                        allbuttons.addClass('liked');
                    }
                    loader.empty();                 
                }
            });
            
        }
        return false;
    });
});
/*==============================================================*/
// Post Like Dislike Button JQuery - END CODE
/*==============================================================*/


/*==============================================================*/
// Menu Icon Click jQuery - START CODE
/*==============================================================*/

$(document).ready(function () {
     $('.menu-first-level a.dropdown-toggle:first-child').bind('click', function (event) {
         var minwidth = $(window).width();
         if (minwidth >= 992) {
             var geturl = $(this).attr('href');
             if (event.ctrlKey || event.metaKey) {
                 if (geturl != '#' && geturl != '') {
                     window.open(geturl, '_blank');
                 }
             } else {
                 if (geturl != '#' && geturl != '') {
                     if ($(this).attr('target') == '_blank') {
                         window.open(geturl, '_blank');
                     } else {
                         window.location.href = geturl;
                     }
                 }
             }
         } else {
             var geturl = $(this).attr('data-redirect-url');
             if (event.ctrlKey || event.metaKey) {
                 if (geturl != '#' && geturl != '') {
                     window.open(geturl, '_blank');
                 }
             } else {
                 if (geturl != '#' && geturl != '') {
                     if ($(this).attr('target') == '_blank') {
                         window.open(geturl, '_blank');
                     } else {
                         window.location.href = geturl;
                     }
                 }
             }
         }
     });
});
/*==============================================================*/
// Menu Icon Click jQuery - END CODE
/*==============================================================*/


/*==============================================================*/
// Menu Icon Add jQuery - START CODE
/*==============================================================*/
$(document).ready(function () {
    if($("li.menu-item-language").find("ul").first().length != 0){
        $("li.menu-item-language a:first").append("<i class='fa fa-angle-down'></i>");
    }
});
/*==============================================================*/
// Menu Icon Add jQuery - END CODE
/*==============================================================*/

/*==============================================================*/
// Comment Validation - START CODE
/*==============================================================*/

$(document).ready(function () {
  
    $(".comment-button").on("click", function () {
        var fields;
            fields = "";
        if($(this).parent().parent().find('#author').length == 1) {
            if ($("#author").val().length == 0 || $("#author").val().value == '')
            {
                fields ='1';
                $("#author").addClass("inputerror");
            }
        }
        if($(this).parent().parent().find('#comment').length == 1) {
            if ($("#comment").val().length == 0 || $("#comment").val().value == '')
            {
                fields ='1';
                $("#comment").addClass("inputerror");
            }
        }
        if($(this).parent().parent().find('#email').length == 1) {
            if ($("#email").val().length == 0 || $("#email").val().length =='')
            {
                fields ='1';
                $("#email").addClass("inputerror");
            }
            else
                {
                    var re = new RegExp();
                    re = /^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/;
                    var sinput ;
                    sinput= "" ;
                    sinput = $("#email").val();
                    if (!re.test(sinput))
                    {
                        fields ='1';
                        $("#email").addClass("inputerror");
                    }
                }
        }
        if(fields !="")
        {
            return false;
        }           
        else
        {
            return true;
        }
    });

});
function inputfocus(id){
    $('#'+id).removeClass('inputerror');
}
/*==============================================================*/
// Comment Validation - END CODE
/*==============================================================*/

var IpadMobileHover = function () {
	if((navigator.userAgent.match(/iPhone/i)) || (navigator.userAgent.match(/iPod/i)) || (navigator.userAgent.match(/iPad/i))) {
	    $('.icon-box > i').on('touchstart', function () {
	        $(this).trigger('hover');
	    }).on('touchend', function () {
	        $(this).trigger('hover');
	    });
	}
};