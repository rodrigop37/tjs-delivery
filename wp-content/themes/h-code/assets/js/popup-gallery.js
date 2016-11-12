/* =================================
 Popup Gallery
 ==================================== */
"use strict";
function ScrollStop() {
    return false;
}
function ScrollStart() {
    return true;
}
/* For remove conflict */
$ = jQuery.noConflict();

$(document).ready(function () {
    var isMobile = false;
    if (/Android|webOS|iPhone|iPad|iPod|BlackBerry|IEMobile|Opera Mini/i.test(navigator.userAgent)) {
        isMobile = true;
    }

    /*==============================================================*/
    //Lightbox gallery - START CODE
    /*==============================================================*/
    var lightboxgallerygroups = {};
    $('.lightboxgalleryitem').each(function() {
      var id = $(this).attr('data-group');
      if(!lightboxgallerygroups[id]) {
        lightboxgallerygroups[id] = [];
      } 
      
      lightboxgallerygroups[id].push( this );
    });


    $.each(lightboxgallerygroups, function() {
        $(this).magnificPopup({
            type: 'image',
            closeOnContentClick: true,
            closeBtnInside: false,
            gallery: { enabled:true },
            image: {
                titleSrc: function (item) {
                    var title = '';
                    var lightbox_caption = '';
                    if( item.el.attr('title') ){
                        title = item.el.attr('title');
                    }
                    if( item.el.attr('lightbox_caption') ){
                        lightbox_caption = '<span class="hcode-lightbox-caption">'+item.el.attr('lightbox_caption')+'</span>';
                    }
                    return title + lightbox_caption;
                }
            },
            // Remove close on popup bg v1.5
            callbacks: {
                open: function () {
                    $.magnificPopup.instance.close = function() {
                        if (!isMobile){
                            $.magnificPopup.proto.close.call(this);
                        } else {
                            $('button.mfp-close').click(function() {
                                $.magnificPopup.proto.close.call(this);
                            });
                        }
                    }
                }
            }
        });
    });
    
    $('.header-search-form').magnificPopup({
        mainClass: 'mfp-fade',
        closeOnBgClick: false,
        preloader: false,
        // for white backgriund
        whitebg: true,
        fixedContentPos: false,
        callbacks: {
            open: function () {
                setTimeout(function () { $('.search-input').focus(); }, 500);
                
                $('#search-header').parent().addClass('search-popup');
                 
                if (!isMobile) {
                    $('body').addClass('overflow-hidden');
                    document.onmousewheel = ScrollStop;
                } else {
                    $('body, html').on('touchmove', function(e){
                        e.preventDefault();
                    });
                }
                $('#search-header input').on('keydown', function(e) {
                    var $searchval = this.value;
                    $('.main-search input').val($searchval);
                });
            },
            close: function () {
                if(!isMobile){
                    $('body').removeClass('overflow-hidden');
                    $('#search-header input[type=text]').each(function (index) {
                        if (index == 0) {
                            $(this).val('');
                            $("#search-header").find("input:eq(" + index + ")").css({ "border": "none", "border-bottom": "2px solid #000" });
                        }
                    });
                    document.onmousewheel = ScrollStart;
                } else {
                     $('body, html').unbind('touchmove');
                }
            }
        }
    });
    /*==============================================================*/
    //Lightbox gallery - END CODE
    /*==============================================================*/

    /*==============================================================*/
    //Ajax MagnificPopup For Onepage Portfolio - START CODE
    /*==============================================================*/
    $('.simple-ajax-popup-align-top').magnificPopup({
        type: 'ajax',
        alignTop: true,
        overflowY: 'scroll', // as we know that popup content is tall we set scroll overflow by default to avoid jump
        callbacks: {
            open: function () {
                $('.navbar .collapse').removeClass('in');
                $('.navbar a.dropdown-toggle').addClass('collapsed');

                // Remove close on popup bg v1.5
                $.magnificPopup.instance.close = function() {
                    if (!isMobile){
                        $.magnificPopup.proto.close.call(this);
                    } else {
                        $('button.mfp-close').click(function() {
                            $.magnificPopup.proto.close.call(this);
                        });
                    }
                }
            }
        }
    });
    /*==============================================================*/
    //Ajax MagnificPopup For Onepage Portfolio - END CODE
    /*==============================================================*/

    /*==============================================================*/
    //Ajax MagnificPopup For Menu Link - START CODE
    /*==============================================================*/
    $('.hcode-menu-ajax-popup a').magnificPopup({
        type: 'ajax',
        alignTop: true,
        overflowY: 'scroll', // as we know that popup content is tall we set scroll overflow by default to avoid jump
        callbacks: {
            open: function () {
                $('.navbar .collapse').removeClass('in');
                $('.navbar a.dropdown-toggle').addClass('collapsed');

                // Remove close on popup bg v1.5
                $.magnificPopup.instance.close = function() {
                    if (!isMobile){
                        $.magnificPopup.proto.close.call(this);
                    } else {
                        $('button.mfp-close').click(function() {
                            $.magnificPopup.proto.close.call(this);
                        });
                    }
                }
            }
        }
    });
    /*==============================================================*/
    //Ajax MagnificPopup For Menu Link - END CODE
    /*==============================================================*/


    /*==============================================================*/
    //Video MagnificPopup - START CODE
    /*==============================================================*/
    $('.popup-youtube, .popup-vimeo, .popup-gmaps').magnificPopup({
        disableOn: 700,
        type: 'iframe',
        mainClass: 'mfp-fade',
        removalDelay: 160,
        preloader: false,
        fixedContentPos: false,
        callbacks: {
            open: function () {
                if (!isMobile)
                    $('body').addClass('overflow-hidden');

                // Remove close on popup bg v1.5
                $.magnificPopup.instance.close = function() {
                    if (!isMobile){
                        $.magnificPopup.proto.close.call(this);
                    } else {
                        $('button.mfp-close').click(function() {
                            $.magnificPopup.proto.close.call(this);
                        });
                    }
                }
            },
            close: function () {
                if (!isMobile)
                    $('body').removeClass('overflow-hidden');
            }
            // e.t.c.
        }
    });
    /*==============================================================*/
    //Video MagnificPopup - END CODE
    /*==============================================================*/

    /*==============================================================*/
    // magnificPopup - START CODE
    /*==============================================================*/
    $('.popup-youtube-landing').magnificPopup({
        disableOn: 700,
        type: 'iframe',
        mainClass: 'mfp-fade',
        removalDelay: 160,
        preloader: false,
        // for black backgriund
        blackbg: true,
        fixedContentPos: false,
        callbacks: {
            open: function () {
                if (!isMobile)
                    $('body').addClass('overflow-hidden');

                // Remove close on popup bg v1.5
                $.magnificPopup.instance.close = function() {
                    if (!isMobile){
                        $.magnificPopup.proto.close.call(this);
                    } else {
                        $('button.mfp-close').click(function() {
                            $.magnificPopup.proto.close.call(this);
                        });
                    }
                }
            },
            close: function () {
                if (!isMobile)
                    $('body').removeClass('overflow-hidden');
            }
            // e.t.c.
        }
    });
    /*==============================================================*/
    // magnificPopup - END CODE
    /*==============================================================*/

    /*==============================================================*/
    //Single image lightbox - zoom animation - START CODE
    /*==============================================================*/
    $('.image-popup-no-margins').magnificPopup({
        type: 'image',
        closeOnContentClick: true,
        fixedContentPos: true,
        closeBtnInside: false,
        mainClass: 'mfp-no-margins mfp-with-zoom', // class to remove default margin from left and right side
        image: {
            verticalFit: true,
            titleSrc: function (item) {
                    var title = '';
                    var lightbox_caption = '';
                    if( item.el.attr('title') ){
                        title = item.el.attr('title');
                    }
                    if( item.el.attr('lightbox_caption') ){
                        lightbox_caption = '<span class="hcode-lightbox-caption">'+item.el.attr('lightbox_caption')+'</span>';
                    }
                    return title + lightbox_caption;
            }
        },
        zoom: {
            enabled: true,
            duration: 300 // don't foget to change the duration also in CSS
        },
        callbacks: {
            open: function () {
                // Remove close on popup bg v1.5
                $.magnificPopup.instance.close = function() {
                    if (!isMobile){
                        $.magnificPopup.proto.close.call(this);
                    } else {
                        $('button.mfp-close').click(function() {
                            $.magnificPopup.proto.close.call(this);
                        });
                    }
                }
            },
        }
    });
    /*==============================================================*/
    //Single image lightbox - zoom animation - END CODE
    /*==============================================================*/

    /*==============================================================*/
    //Single image -  fits horizontally and vertically - START CODE
    /*==============================================================*/
    $('.image-popup-vertical-fit').magnificPopup({
        type: 'image',
        closeOnContentClick: true,
        mainClass: 'mfp-img-mobile',
        closeBtnInside: false,
        image: {
            verticalFit: true,
            titleSrc: function (item) {
                var title = '';
                var lightbox_caption = '';
                if( item.el.attr('title') ){
                    title = item.el.attr('title');
                }
                if( item.el.attr('lightbox_caption') ){
                    lightbox_caption = '<span class="hcode-lightbox-caption">'+item.el.attr('lightbox_caption')+'</span>';
                }
                return title + lightbox_caption;
            }
        },
        callbacks: {
            open: function () {
                // Remove close on popup bg v1.5
                $.magnificPopup.instance.close = function() {
                    if (!isMobile){
                        $.magnificPopup.proto.close.call(this);
                    } else {
                        $('button.mfp-close').click(function() {
                            $.magnificPopup.proto.close.call(this);
                        });
                    }
                }
            },
        }
    });
    /*==============================================================*/
    //Single image -  fits horizontally and vertically - END CODE
    /*==============================================================*/

    /*==============================================================*/
    //Zoom gallery - START CODE
    /*==============================================================*/
    $('.product-zoom-gallery').magnificPopup({
        delegate: 'a',
        type: 'image',
        mainClass: 'mfp-with-zoom mfp-img-mobile',
        closeBtnInside: false,
        image: {
            verticalFit: true,
            titleSrc: function (item) {
                var title = '';
                var lightbox_caption = '';
                if( item.el.attr('title') ){
                    title = item.el.attr('title');
                }
                if( item.el.attr('lightbox_caption') ){
                    lightbox_caption = '<span class="hcode-lightbox-caption">'+item.el.attr('lightbox_caption')+'</span>';
                }
                return title + lightbox_caption;
            }
        },
        gallery: {
            enabled: true
        },
        callbacks: {
            open: function () {
                // Remove close on popup bg v1.5
                $.magnificPopup.instance.close = function() {
                    if (!isMobile){
                        $.magnificPopup.proto.close.call(this);
                    } else {
                        $('button.mfp-close').click(function() {
                            $.magnificPopup.proto.close.call(this);
                        });
                    }
                }
            },
        }
    });
    /*==============================================================*/
    //Zoom gallery - END CODE
    /*==============================================================*/

    /*==============================================================*/
    //Zoom gallery - START CODE
    /*==============================================================*/
    
    var lightboxzoomgallerygroups = {};
    $('.lightboxzoomgalleryitem').each(function() {
      var id = $(this).attr('data-group');
      if(!lightboxzoomgallerygroups[id]) {
        lightboxzoomgallerygroups[id] = [];
      } 
      
      lightboxzoomgallerygroups[id].push( this );
    });


    $.each(lightboxzoomgallerygroups, function() {
        $(this).magnificPopup({
            type: 'image',
            mainClass: 'mfp-with-zoom mfp-img-mobile',
            closeBtnInside: false,
            image: {
                verticalFit: true,
                titleSrc: function (item) {
                    var title = '';
                    var lightbox_caption = '';
                    if( item.el.attr('title') ){
                        title = item.el.attr('title');
                    }
                    if( item.el.attr('lightbox_caption') ){
                        lightbox_caption = '<span class="hcode-lightbox-caption">'+item.el.attr('lightbox_caption')+'</span>';
                    }
                    return title + lightbox_caption;
                }
            },
            gallery: {
                enabled: true
            },
            zoom: {
                enabled: true,
                duration: 300, // don't foget to change the duration also in CSS
                opener: function (element) {
                    return element.find('img');
                }
            },
            callbacks: {
                open: function () {
                    // Remove close on popup bg v1.5
                    $.magnificPopup.instance.close = function() {
                        if (!isMobile){
                            $.magnificPopup.proto.close.call(this);
                        } else {
                            $('button.mfp-close').click(function() {
                                $.magnificPopup.proto.close.call(this);
                            });
                        }
                    }
                },
            }
        })
    });

    /*==============================================================*/
    //Zoom gallery - END CODE
    /*==============================================================*/

    /*==============================================================*/
    //Popup with form - START CODE
    /*==============================================================*/
    $('.popup-with-form').magnificPopup({
        type: 'inline',
        preloader: false,
        closeBtnInside: true,
        focus: '#name',
        // When elemened is focused, some mobile browsers in some cases zoom in
        // It looks not nice, so we disable it:
        callbacks: {
            beforeOpen: function () {
                if ($(window).width() < 700) {
                    this.st.focus = false;
                } else {
                    this.st.focus = '#name';
                }
            },
            open: function () {
                // Remove close on popup bg v1.5
                $.magnificPopup.instance.close = function() {
                    if (!isMobile){
                        $.magnificPopup.proto.close.call(this);
                    } else {
                        $('button.mfp-close').click(function() {
                            $.magnificPopup.proto.close.call(this);
                        });
                    }
                }
            },
        }
    });
    /*==============================================================*/
    //Popup with form - END CODE
    /*==============================================================*/

    /*==============================================================*/
    //Modal popup - START CODE
    /*==============================================================*/
    $('.modal-popup').magnificPopup({
        type: 'inline',
        preloader: false,
        // modal: true,
        blackbg: true,
        callbacks: {
            open: function () {
                // Remove close on popup bg v1.5
                $.magnificPopup.instance.close = function() {
                    if (!isMobile){
                        $.magnificPopup.proto.close.call(this);
                    } else {
                        $('button.mfp-close').click(function() {
                            $.magnificPopup.proto.close.call(this);
                        });
                    }
                }
            },
        }
    });
    $(document).on('click', '.popup-modal-dismiss', function (e) {
        e.preventDefault();
        $.magnificPopup.close();
    });
    /*==============================================================*/
    //Modal popup - END CODE
    /*==============================================================*/

    /*==============================================================*/
    //Modal popup - zoom animation - START CODE
    /*==============================================================*/
    $('.popup-with-zoom-anim').magnificPopup({
        type: 'inline',
        fixedContentPos: false,
        fixedBgPos: true,
        overflowY: 'auto',
        closeBtnInside: true,
        preloader: false,
        midClick: true,
        removalDelay: 300,
        blackbg: true,
        mainClass: 'my-mfp-zoom-in',
        callbacks: {
            open: function () {
                // Remove close on popup bg v1.5
                $.magnificPopup.instance.close = function() {
                    if (!isMobile){
                        $.magnificPopup.proto.close.call(this);
                    } else {
                        $('button.mfp-close').click(function() {
                            $.magnificPopup.proto.close.call(this);
                        });
                    }
                }
            },
        }
    });

    $('.popup-with-move-anim').magnificPopup({
        type: 'inline',
        fixedContentPos: false,
        fixedBgPos: true,
        overflowY: 'auto',
        closeBtnInside: true,
        preloader: false,
        midClick: true,
        removalDelay: 300,
        blackbg: true,
        mainClass: 'my-mfp-slide-bottom',
        callbacks: {
            open: function () {
                // Remove close on popup bg v1.5
                $.magnificPopup.instance.close = function() {
                    if (!isMobile){
                        $.magnificPopup.proto.close.call(this);
                    } else {
                        $('button.mfp-close').click(function() {
                            $.magnificPopup.proto.close.call(this);
                        });
                    }
                }
            },
        }
    });
    /*==============================================================*/
    //Modal popup - zoom animation - END CODE
    /*==============================================================*/

});