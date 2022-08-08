jQuery(document).ready(function($){
    $("#wrapper .col-left").mCustomScrollbar({
        theme:"dark"
    });
    $('.left-menu').meanmenu({
        meanMenuContainer: '#meanmenu',
        meanScreenWidth: "767",
        siteLogo: '<div class="meanheader">Menu</div>'
    });
    $(document).on('click', 'a[href^="#"]', function(e) {
        // target element id
        var id = $(this).attr('href');

        // target element
        var $id = $(id);
        if ($id.length === 0) {
            return;
        }

        // prevent standard hash navigation (avoid blinking in IE)
        e.preventDefault();

        // top position relative to the document
        var pos = $(id).offset().top;

        // animated top scrolling
        $('body, html').animate({scrollTop: pos}, 2000);
    });
});

(function($){
    "use strict";

    // Define the maximum height for mobile menu
    $(window).on('load resize', function () {
        var wHeight = $(window).height();
        wHeight = wHeight - 50;
        $('.mean-container .mean-nav > ul').css('max-height', wHeight + 'px');
    });

})(jQuery);