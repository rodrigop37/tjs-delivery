$(document).ready(function () {
    "use strict";
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

SetResizeContent();
});

function SetResizeContent() {
    var minheight = $(window).height();
    $(".full-screen").css('min-height', minheight);
}